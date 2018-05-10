<?php
App::uses('AppController', 'Controller');
/**
 * FitoutWorks Controller
 *
 * @property FitoutWork $FitoutWork
 * @property PaginatorComponent $Paginator
 */
class FitoutWorksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	#'Security' => array('csrfExpires' => '+1 hour' )


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FitoutWork->recursive = 0;
		$this->set('fitoutWorks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutWork->exists($id)) {
			throw new NotFoundException(__('Invalid fitout work'));
		}
		$options = array('conditions' => array('FitoutWork.' . $this->FitoutWork->primaryKey => $id));
		$this->set('fitoutWork', $this->FitoutWork->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutWork->create();
			if ($this->FitoutWork->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout work has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout work could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clients = $this->FitoutWork->Client->find('list');
		$users = $this->FitoutWork->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FitoutWork->exists($id)) {
			throw new NotFoundException(__('Invalid fitout work'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutWork->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout work has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout work could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutWork.' . $this->FitoutWork->primaryKey => $id));
			$this->request->data = $this->FitoutWork->find('first', $options);
		}
		$clients = $this->FitoutWork->Client->find('list');
		$users = $this->FitoutWork->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FitoutWork->id = $id;
		if (!$this->FitoutWork->exists()) {
			throw new NotFoundException(__('Invalid fitout work'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutWork->delete()) {
			$this->Session->setFlash(__('The fitout work has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout work could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
    public function project() {
        //load models
        $this->loadModel('Quotation');
        
        //get parameter status from url
        //query fitoutwork status
        $passed_status = $this->params['url']['status'];
        $options = ['conditions'=>['FitoutWork.status'=>$passed_status]];
        $this->set(['fitoutworks'=>$this->FitoutWork->find('all', $options), 'passed_status'=>$passed_status]);
    }
    
    public function add_fitout_works() {
    	// disable auto render of view
        $this->autoRender = false;
        $this->response->type('json');
        
    	// load FitoutQoute
    	$this->loadModel('FitoutQoute');
        
        // get data from request
        $data = $this->request->data;
        
        $status = $data['status'];
        $deadline = $data['deadline'];
        $expected_start = $data['expected_start'];
        $user_id = $data['user_id'];
        $client_id = $data['client_id'];
        $quotation_id_array = $data['quotation_id_array'];
        
        // prepare and begin database for transaction for FitoutWork
        $FitoutWork_DS = $this->FitoutWork->getDataSource();
        $FitoutWork_DS->begin();
        
        // prepare for Create, then set values to be created
		$this->FitoutWork->create();
		$this->FitoutWork->set(['status'=>$status,
								'deadline'=>$deadline,
								'expected_start'=>$expected_start,
								'user_id'=>$user_id,
								'client_id'=>$client_id]);
								
		// initialize saving of fitoutwork for checking
		$save_FitoutWork = $this->FitoutWork->save();
		
		// check saved fitoutwork
		if ($save_FitoutWork) {
			// get id of last inserted id in database
			$last_inserted_id = $this->FitoutWork->getLastInsertID();
    		
    		// prepare and begin database for transaction for FitoutQoute
    		$FitoutQuote_DS = $this->FitoutQoute->getDataSource();
    		$FitoutQuote_DS->begin();
    		
			// loop through quotation array
			foreach($quotation_id_array as $quotation_id) {
		    	// prepare to Create and set values to be created
	    		$this->FitoutQoute->create();
	    		$this->FitoutQoute->set(['quotation_id'=>$quotation_id, 'fitout_work_id'=>$last_inserted_id]);
	    		
	    		// initialize saving of FitoutQoute for checking
	    		$save_FitoutQuote = $this->FitoutQoute->save();
	    		
	    		// check for saved FitoutQuote then commit
	    		if ($save_FitoutQuote) {
	    			$FitoutQuote_DS->commit();
	    			$FitoutWork_DS->commit();
				}
	    		else {
	    			// rollback FitoutWork at Failure
	    			$FitoutWork_DS->rollback();
	    			return json_encode("Cannot save FitoutQoute. Please try again.");
	    		}
			}							
		}
		else {
			// provide indication that an error occured
			return json_encode("Cannot save FitoutWork. Please try again.");
		}
		
		return json_encode($data);
		exit;
    }
    
    public function add_fitout_works_view() {
    	//load models
        $this->loadModel('Quotation');
        $this->loadModel('Client');
        
        //get parameter status from url
        //query fitoutwork status
        $passed_status = $this->params['url']['status'];
        $this->set('passed_status',$passed_status);
        
        //get quotations
        $quotations = $this->Quotation->find('all');
        $this->set(compact('quotations'));
        
        //get users
        $users = $this->User->find('all');
        $this->set(compact('users'));
        
        //get clients with lead = 0
		$clients = $this->Client->find('all', ['conditions'=>['Client.lead'=>0]]);
		$this->set(compact('clients'));
    }
    
    public function get_client_quotation() {
    	// disable auto rendering of view
    	$this->autoRender = false;
    	$this->response->type('json');
    	
    	// load models
    	$this->loadModel('Quotation');
    	
    	// check request type
    	if ($this->request->is('ajax')) {
    		// get passed id
    		$client_id = $this->request->query['id'];
    		
    		// lazy load table
    		$this->Quotation->recursive = -1;
    		
    		// filter quotations with client_id
        	$client_quotes = $this->Quotation->find('all', ['conditions'=>['Quotation.client_id'=>$client_id]]);
        	
        	// return data acquired
			return json_encode($client_quotes);

        	exit;
    	}
    }
    
    public function edit_fitout_works() {
    	$this->loadModel('FitoutWork');
    	$this->loadModel('FitoutQoute');
    	$this->loadModel('Client');
    	$this->loadModel('User');
    	$this->loadModel('Quotation');
    	
    	$fitout_work_id = $this->params['url']['id'];
    	$fitout_work_object = $this->FitoutWork->findById($fitout_work_id);
    	$fo_work_status = $fitout_work_object['FitoutWork']['status'];
    	$this->set(compact('fitout_work_object', 'fo_work_status'));
    	
		$clients = $this->Client->find('all', ['conditions'=>['Client.lead'=>0]]);
		$this->set(compact('clients'));
		
		$fitout_quote_object = $this->FitoutQoute->find('all', ['conditions'=>
			['FitoutQoute.fitout_work_id'=>$fitout_work_id]]);
		$this->set(compact('fitout_quote_object'));
		
		$this->User->recursive = -1;
		$users = $this->User->find('all');
		$this->set(compact('users'));
		
		$this->Quotation->recursive = -1;
		$quotations = $this->Quotation->find('all', ['conditions'=>
			['Quotation.client_id'=>$fitout_work_object['FitoutWork']['client_id']]]);
		$this->set(compact('quotations'));
    }
    
    public function update_fitout_works() {
    	$this->autoRender = false;
    	$this->response->type('text');
    	
    	$this->loadModel('FitoutWork');
    	$this->loadModel('FitoutQoute');
		
    	if ($this->request->is('ajax')) {
    		$data = $this->request->data;
    		$id = $data['id'];
    		$status = $data['status'];
    		$expected_start = $data['expected_start'];
    		$deadline = $data['deadline'];
    		$client_id = $data['client_id'];
    		$user_id = $data['user_id'];
    		
    		$DS_FitoutWork = $this->FitoutWork->getDataSource();
    		$DS_FitoutWork->begin();
    		
    		$this->FitoutWork->id = $id;
    		$this->FitoutWork->set(['id'=>$id,
    								'status'=>$status,
    								'expected_start'=>$expected_start,
    								'deadline'=>$deadline,
    								'client_id'=>$client_id,
    								'user_id'=>$user_id]);

            if ($this->FitoutWork->save()) {
            	echo json_encode("Fitout work saved");
            	$this->FitoutQoute->recursive = -1;
            	$fitout_quotes = $this->FitoutQoute->find('all', ['conditions'=>['FitoutQoute.fitout_work_id'=>$id]]);
 
    			$DS_FitoutQuote = $this->FitoutQoute->getDataSource();
    			$DS_FitoutQuote->begin();
            	
            	foreach($fitout_quotes as $fitout_quote) {
            		$this->FitoutQoute->delete($fitout_quote['FitoutQoute']['id']);
            	}
            	
        			if (!empty($data['new_quotation_id'])) {
            			echo json_encode($data['new_quotation_id']);
            			
	            			foreach($data['new_quotation_id'] as $new_quote) {
	    						$this->FitoutQoute->create();
	    						$this->FitoutQoute->set(['quotation_id'=>$new_quote, 'fitout_work_id'=>$id]);
	    						$this->FitoutQoute->save();
	            			}
	            			
	            			if ($DS_FitoutQuote->commit()) { $DS_FitoutWork->commit(); }
	            			else {
	            				$DS_FitoutQuote->rollback();
	            				$DS_FitoutQuote->rollback();
	            				
	            			}
            		}
            		else {
            			if (!empty($data['old_quotation_id'])) {
	        				foreach($data['old_quotation_id'] as $old_quote) {
	        					$this->FitoutQoute->create();
	    						$this->FitoutQoute->set(['quotation_id'=>$old_quote, 'fitout_work_id'=>$id]);
	    						$this->FitoutQoute->save();
	            			}
	            			
	            			if ($DS_FitoutQuote->commit()) {
	            				$DS_FitoutQuote->rollback();
	            				$DS_FitoutWork->rollback();
	            			} 
	        			}
	        			else {
	        				echo json_encode('Both old and new consists empty array');
	        				
	        				$DS_FitoutWork->rollback();
	        				$DS_FitoutWork->rollback();
        					$this->Session->setFlash('No Quotation was selected. Please try again.',
							'default', array('class' => 'alert alert-danger'), 'alertforexisting');
	        				return json_encode('No Quotation was selected. Please try again.');
	        				exit;
	        			}
	        		}
	        			
	    			if ($DS_FitoutQuote->commit()) { $DS_FitoutWork->commit(); }
	    			else { $DS_FitoutWork->rollback(); $DS_FitoutWork->rollback(); }
            }
            $DS_FitoutWork->commit();
        }
        return json_encode($data);
        exit;
    }

	public function view_works() {
		
    	$this->loadModel('User');
    	$this->loadModel('DeliverySchedule');
    	$this->loadModel('FitoutPerson');
    	$this->loadModel('FitoutTodo');
    	$this->loadModel('JrProduct');
    	$this->loadModel('JobRequest');
    	$this->loadModel('Quotation');
		$this->loadModel('DrPaper');   
		$this->loadModel('DeliveryPaper');   
    		
    	$fitout_work_id = $this->params['url']['id'];
    	// $this->FitoutWork->recursive=2;
    	$works = $this->FitoutWork->findById($fitout_work_id);
    	
    	$arr = [];
    	foreach($works['FitoutQoute'] as $work){
    		array_push($arr, $work['quotation_id']);
    	}

    	
    	// $this->Quotation->recursive=2; 
    	$selected_quotations = $this->JobRequest->Quotation->find('all',[
    		'conditions'=>['Quotation.id'=>$arr]]);
    	$jr_arr = [];
    	foreach($selected_quotations as $sel_quote){ 
    		if(!in_array($sel_quote['JobRequest']['id'], $jr_arr)){
    		array_push($jr_arr, $sel_quote['JobRequest']['id']); 
    		#pr($jr_arr);
    		}
    	} 
    	
    	$designers = $this->JrProduct->find('all', [
    		'conditions'=>['JrProduct.job_request_id'=>$jr_arr],
    		'fields' => ['DISTINCT User.first_name, User.last_name']
    		
    	]);
    	
        $delivery_schedules = $this->DeliverySchedule->find('all',['conditions'=>[
            'DeliverySchedule.quotation_id'=>$arr
        ]]);
        
    	 $prr = [];
    	foreach($works['FitoutPerson'] as $sel_fitout_id){
    		array_push($prr , $sel_fitout_id['fitout_work_id']);
    	}
    	$this->FitoutPerson->recursive=2;
    	$peoples = $this->FitoutPerson->find('all', ['conditions'=>['FitoutPerson.fitout_work_id'=>$prr]]);
    	
    	$client = $works['Client'];
    	$project_head = $works['User'];
    	$fitout_quotations = $works['FitoutQoute'];
    	
    	$wrr = [];
    	foreach($works['FitoutTodo'] as $selected_fitout_work){
    		array_push($wrr , $selected_fitout_work['fitout_work_id']);
    	}
    	
    	$this->FitoutTodo->recursive=2;
    	$fitout_todos = $this->FitoutTodo->find('all', 
    	['conditions'=> ['FitoutTodo.fitout_work_id'=>$wrr] ]
    	);
        
        $users = $this->User->find('all'); 
        $papers = $this->DrPaper->find('all');

		$required_docs = $this->DeliveryPaper->find('all',
        	['conditions'=>['DeliveryPaper.quotation_id'=>$arr]]
        );
        

		$this->set(compact('works', 'delivery_schedules', 'peoples', 'designers', 'selected_quotations', 'required_docs', 'fitout_todos', 'users', 'papers'));

    }
    
    
     public function add_people(){
     	
		$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
            
        $this->loadModel('FitoutPerson');
        
        $employee = $data['employee'];
        $fit_out_id = $data['add_fitout_work_id'];

		if($this->request->is('post')){
			
			$people_TS = $this->FitoutPerson->getDataSource();
			$people_TS->begin();
			
			$this->FitoutPerson->create();
			$this->FitoutPerson->set(array(
				'user_id' => $employee,
				'fitout_work_id' => $fit_out_id
            ));
            
            $check_duplicates = $this->FitoutPerson->find('first', array(
            	'conditions' => array(
            		'FitoutPerson.user_id' => $employee
            		)
            	));

			if(!$check_duplicates){
            
            $save_people = $this->FitoutPerson->save();
			if($save_people){
				$people_TS->commit();
				echo json_encode($this->request->data); 
			
			}else{
				$people_TS->rollback();
			}
			
			}else{
				//echo name already exist
			}

		}
     }
  
     public function add_work(){
     	
     	$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
    
        $this->loadModel('FitoutTodo');
        
        $work_details = $data['work_details'];
        $user_id = $this->Auth->user('id');
        $fitout_work_id = $data['fitout_work_id'];
        $deadline_date = $data['deadline_date'];
        $exp_start_date = $data['exp_start_date'];

        
		if($this->request->is('post')){
			
			$work_TS = $this->FitoutTodo->getDataSource();
			$work_TS->begin();
			
			$this->FitoutTodo->create();
			
			$this->FitoutTodo->set(array(
				'work' => $work_details,
				'user_id' => $user_id,
				'fitout_work_id' => $fitout_work_id,
				'deadline' => $deadline_date,
				'expected_start' => $exp_start_date
            ));
            
            $save_work = $this->FitoutTodo->save();
            
			if($save_work){
				$work_TS->commit();
				echo json_encode($this->request->data); 
			}else{
				$work_TS->rollback();
			}

		}
		
     }
     
     
	public function edit_datestart($id = null){
        $this->loadModel('FitoutTodo');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $fitout_id = $data['s_id'];
        $date_start = $data['date_start'];
        $time_start = $data['time_start'];
        
        $combined_SDT = date('Y-m-d H:i:s', strtotime("$date_start $time_start"));
        
        $editds_TS = $this->FitoutTodo->getDataSource();
        $editds_TS->begin();
        
        $this->FitoutTodo->id = $fitout_id;
        
        $this->FitoutTodo->set(array(
            "date_started" => $combined_SDT
        ));
        
        $edit_start = $this->FitoutTodo->save();
        if($edit_start){
            $editds_TS->commit();
            echo json_encode($fitout_id);
        }else{
            $editds_TS->rollback();
        }
        exit;
        
     }
     
     public function edit_dateend($id = null){
     	$this->loadModel('FitoutTodo');
     	
     	$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $fitout_id = $data['e_id'];
        $date_end = $data['date_end'];
        $time_end = $data['time_end'];
        
        $combined_EDT = date('Y-m-d H:i:s', strtotime("$date_end $time_end"));
        
        $edited_TS = $this->FitoutTodo->getDataSource();
        $edited_TS->begin();
        
        $this->FitoutTodo->id = $fitout_id;
        
        $this->FitoutTodo->set(array(
            "end_date" => $combined_EDT
        ));
        
        $edit_end = $this->FitoutTodo->save();
        
        if($edit_end){
        	$edited_TS->commit();
            echo json_encode($fitout_id);
        }else{
        	$edited_TS->rollback();
        }
        exit;
        
     }
     
     public function delete_people($id = null){
        
        $this->loadModel('FitoutPerson');
     	$this->autoRender = false;
        header("Content-type:application/json");

        $deletepeople_TS = $this->FitoutPerson->getDataSource();
        $deletepeople_TS->begin();
        
        $data = $this->request->data;
         
        $id = $data['id'];
        
		if($this->request->is('post', 'put')){
			$this->FitoutPerson->id = $id;
			     
			$del_people = $this->FitoutPerson->delete();   
			if ($del_people) {
				$deletepeople_TS->commit();
				echo json_encode($id);
			}else{
				$deletepeople_TS->rollback();
			} 
		}

     }
     
     public function add_document(){
     	
     	$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
            
        $this->loadModel('DeliveryPaper');
        
        $dr_paper_id = $data['dr_paper_id'];
        $quotation_id = $data['quotation_id'];
        $date_need = $data['date_need'];
        $user_id = $this->Auth->user('id');
        
		if($this->request->is('post')){
			
			$work_TS = $this->DeliveryPaper->getDataSource();
			$work_TS->begin();
			
			$this->DeliveryPaper->create();
			
			$this->DeliveryPaper->set(array(
				'dr_paper_id' => $dr_paper_id,
				'quotation_id' => $quotation_id,
				'date_needed' => $date_need,
				'user_id' => $user_id,
            ));
            
            $save_work = $this->DeliveryPaper->save();
            
			if($save_work){
				$work_TS->commit();
				echo json_encode($this->request->data); 
			}else{
				$work_TS->rollback();
			}

		}
		
     }
     
    public function edit_dateacquired($id = null){
        $this->loadModel('DeliveryPaper');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $da_id = $data['da_id'];
        $date_acquired = $data['date_acquired'];
        $time_acquired = $data['time_acquired'];
        
        $combined_SDT = date('Y-m-d H:i:s', strtotime("$date_acquired $time_acquired"));
        
        $editds_TS = $this->DeliveryPaper->getDataSource();
        $editds_TS->begin();
        
        $this->DeliveryPaper->id = $da_id;
        
        $this->DeliveryPaper->set(array(
            "date_acquired" => $combined_SDT,
            "status" => "acquired"
        ));
        
        $edit_acquired = $this->DeliveryPaper->save();
        if($edit_acquired){
            $editds_TS->commit();
            echo json_encode($da_id);
        }else{
            $editds_TS->rollback();
        }
        exit;
        
     }
     
     public function edit_dateprocessed($id = null){
     	$this->loadModel('DeliveryPaper');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $dp_id = $data['dp_id'];
        $date_processed = $data['date_processed'];
        $time_processed = $data['time_processed'];
        
        $combined_SDT = date('Y-m-d H:i:s', strtotime("$date_processed $time_processed"));
        
        $editds_TS = $this->DeliveryPaper->getDataSource();
        $editds_TS->begin();
        
        $this->DeliveryPaper->id = $dp_id;
        
        $this->DeliveryPaper->set(array(
            "date_processed" => $combined_SDT,
            "status" => "processed"
        ));
        
        $edit_processed = $this->DeliveryPaper->save();
        if($edit_processed){
            $editds_TS->commit();
            echo json_encode($dp_id);
        }else{
            $editds_TS->rollback();
        }
        exit;
        
     }
    
}
