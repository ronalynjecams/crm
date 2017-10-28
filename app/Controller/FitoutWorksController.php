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
    	$this->set(compact('fitout_work_object'));
    	
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
    	$this->response->type('json');
    	
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
            	//-----------------------> PSEUDOCODE
            	// get fitoutquote from db with fitout work id == fitoutworkid
            	// get if old_quotation_id != 0 
            		// compare difference of old_quotation from existing quotation
            		// update
            	//else
            		//if new_quotation_id != 0
            			// compare difference of old_quotation from existing quotation
            			// update
            	
            	//----------------------> IMPLEMENTATION
            	$this->FitoutQoute->recursive = -1;
            	$fitout_quotes = $this->FitoutQoute->find('all', ['conditions'=>['FitoutQoute.fitout_work_id'=>$id]]);
 
				// $count_fitout_qoutes = count($fitout_quotes);
				
				// $DS_FitoutQuote = $this->FitoutQoute->getDataSource();
				// $DS_FitoutQuote->begin();
				
      //      	foreach ($fitout_quotes as $fitout_quote) {
      //      		if (!empty($data['new_quotation_id'])) {
      //      			echo json_encode($data['new_quotation_id']);
						// $count_new_qoutes = count($data['new_quotation_id']);
            			
      //      			foreach($data['new_quotation_id'] as $new_quote) {
      //      				if ($fitout_quote != $new_quote) {
      //      					if ($count_fitout_qoutes > $count_new_qoutes) {
      //      						$this->FitoutQoute->create();
      //      						$this->FitoutQoute->set(['quotation_id'=>$new_quote, 'fitout_work_id'=>$id]);
      //      						$this->FitoutQoute->save();
      //      					}
      //      					else if ($count_fitout_qoutes < $count_new_qoutes) {
      //      						$this->FitoutQoute->delete($fitout_quote['FitoutQoute']['id']);
      //      					}
      //      					else {
      //      						return json_encode($data);
      //      						exit;
      //      					}
      //      				}
      //      			}
      //      		}
      //      		else if (!empty($data['old_quotation_id'])) {
      //  				echo json_encode($data['old_quotation_id']);
						// $count_old_qoutes = count($data['old_quotation_id']);
        				
      //  				foreach($data['old_quotation_id'] as $old_quote) {
      //      				if ($fitout_quote != $old_quote) {
      //      					if ($count_fitout_qoutes > $count_old_qoutes) {
	     //       					$this->FitoutQoute->create();
      //      						$this->FitoutQoute->set(['quotation_id'=>$old_quote, 'fitout_work_id'=>$id]);
      //      						$this->FitoutQoute->save();
      //      					}
      //      					else if ($count_fitout_qoutes < $count_old_qoutes) {
						// 			$this->FitoutQoute->delete($fitout_quote['FitoutQoute']['id']);
      //      					}
      //      					else {
      //      						return json_encode($data);
      //      						exit;
      //      					}
      //      				}
      //      			}
      //  			}
      //  			else {
      //  				echo json_encode('Both old and new consists empty array');
      //  				$DS_FitoutWork->rollback();
      //  				$this->Session->setFlash('No Quotation was selected. Please try again.');
      //  				return
      //  				exit;
      //  			}
      //      	}
            	
      //      	if ($DS_FitoutQuote->commit()) {
      //      		$DS_FitoutWork->commit();
      //      	}
      //      	else {
      //      		$DS_FitoutWork->rollback();
      //      	}
            	
            	//----------------------> Replace this code with new process
            	// get all qoutes with fitoutwork_id
        		// $this->FitoutQoute->recursive = -1;
          //  	$fitout_quotes = $this->FitoutQoute->find('all', ['conditions'=>['FitoutQoute.fitout_work_id'=>$id]]);
        		
    			$DS_FitoutQuote = $this->FitoutQoute->getDataSource();
    			$DS_FitoutQuote->begin();
            	
            	foreach($fitout_quotes as $fitout_quote) {
            		$this->FitoutQoute->delete($fitout_quote['FitoutQoute']['id']);
            	}
            	
            	// save only after confirm_is done or true
            	// if ($confirm_del) {
        			if (!empty($data['new_quotation_id'])) {
            			echo json_encode($data['new_quotation_id']);
            			
            			// $confirm_del = '';
            	
		            	// foreach($fitout_quotes as $fitout_quote) {
		            	// 	if ($this->FitoutQoute->delete($fitout_quote['FitoutQoute']['id'])) {
		            	// 		$confirm_del .= 'true';
		            	// 	}
		            	// }
		            	// echo json_encode($confirm_del);
		            	// if ($confirm_del) {
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
		            	// }
		            	// else {
		            	// 	$DS_FitoutQuote->rollback();
		            	// 	$DS_FitoutWork->rollback();
		            		
		            	// 	echo json_encode("Something went wrong with processing qoutes");
		            	// }
            		}
            		else {
            			if (!empty($data['old_quotation_id'])) {
            				echo json_encode($data['old_quotation_id']);
            				// $confirm_del = '';
            	
		            	// foreach($fitout_quotes as $fitout_quote) {
		            	// 	if ($this->FitoutQoute->delete($fitout_quote['FitoutQoute']['id'])) {
		            	// 		$confirm_del .= 'true';
		            	// 	}
		            	// }
		            	// echo json_encode($confirm_del);
	        				// $ex_qoute_id = [];
	        				// foreach ($fitout_quotes as $fitout_quote) {
	        				// 	$ex_qoute_id[] = $fitout_quote['FitoutQoute']['quotation_id'];
	        				// }
	        				
	        				// $old_quote_diff = Set::diff ($data['old_quotation_id'], $ex_qoute_id);
	        				
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
	        				
	        				$this->Session->setFlash('No Quotation was selected. Please try again.');
	        				return;
	        			}
	        		}
	        			
	    			if ($DS_FitoutQuote->commit()) { $DS_FitoutWork->commit(); }
	    			else { $DS_FitoutWork->rollback(); $DS_FitoutWork->rollback(); }
            	// }
            }
            $DS_FitoutWork->commit();
            
            return json_encode($data);
            exit;
        }
    }

	public function view_works() {
		
		$this->loadModel('FitoutWork');
    	$this->loadModel('Client');
    	$this->loadModel('User');
    	$this->loadModel('DeliverySchedule');
    	$this->loadModel('FitoutPerson');
    	$this->loadModel('FitoutTodo');
    	$this->loadModel('JrProduct');
   
    	$deliviries = $this->DeliverySchedule->find('all');
    	$fitout_work_id = $this->params['url']['id'];
    	$works = $this->FitoutWork->findById($fitout_work_id);
		$clients = $this->Client->find('all', ['conditions'=>['Client.lead'=>0]]);
		$this->User->recursive = -1;
		$users = $this->User->find('all');
		$peoples = $this->FitoutPerson->find('all');
		$fitout_works = $this->FitoutTodo->find('all');
		
		$designers = $this->JrProduct->find('all', ['fields' => ['DISTINCT (JrProduct.user_id)']]);
		// exit;
		
		$this->set(compact('works', 'deliviries', 'clients', 'users', 'peoples', 'fitout_works', 'designers'));

    }
    
    
     public function add_people(){
     	
		$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
            
        $this->loadModel('FitoutPerson');
        
        $employee = $data['employee'];
        $fit_out_id = $data['add_fitout_work_id'];
        
		if($this->request->is('post')){
			$this->FitoutPerson->create();
			$this->FitoutPerson->set(array(
				'user_id' => $employee,
				'fitout_work_id' => $fit_out_id
            ));
            
			if($this->FitoutPerson->save()){
				echo json_encode($this->request->data); 
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
        $deadline_date = $data['deadline_date'];
        $exp_start_date = $data['exp_start_date'];

        
		if($this->request->is('post')){
			
			$this->FitoutTodo->create();
			
			$this->FitoutTodo->set(array(
				'work' => $work_details,
				'user_id' => $user_id,
				'deadline' => $deadline_date,
				'expected_start' => $exp_start_date
            ));
            
			if($this->FitoutTodo->save()){
				echo json_encode($this->request->data); 
			}

		}
		
     }
     
     
     //public function edit_datestart(){
     //	$this->autoRender = false;
     //   header("Content-type:application/json");
     //}
    
}
