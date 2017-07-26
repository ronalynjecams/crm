<?php
App::uses('AppController', 'Controller');

/**
 * Quotations Controller
 *
 * @property Quotation $Quotation
 * @property PaginatorComponent $Paginator
 */
class QuotationsController extends AppController {

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
		$this->Quotation->recursive = 0;
		$this->set('quotations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Quotation->exists($id)) {
			throw new NotFoundException(__('Invalid quotation'));
		}
		$options = array('conditions' => array('Quotation.' . $this->Quotation->primaryKey => $id));
		$this->set('quotation', $this->Quotation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Quotation->create();
			if ($this->Quotation->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clients = $this->Quotation->Client->find('list');
		$teams = $this->Quotation->Team->find('list');
		$users = $this->Quotation->User->find('list');
//		$jobRequests = $this->Quotation->JobRequest->find('list');
//		$this->set(compact('clients', 'teams', 'users', 'jobRequests'));
		$this->set(compact('clients', 'teams', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
           $this->autoRender = false;
            $data = $this->request->data;  
            $id = $data['id'];
            
            
                $this->Quotation->id = $id; 
                if($this->Quotation->save($data)){
                    echo json_encode($data);
                }else{
                    echo json_encode('invalid data');
                }
                exit;
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Quotation->id = $id;
		if (!$this->Quotation->exists()) {
			throw new NotFoundException(__('Invalid quotation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quotation->delete()) {
			$this->Session->setFlash(__('The quotation has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The quotation could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function create(){
            
            //every open of this page dapat magsave na kaagad sa db 
            //search muna if my ongoing quotation sa user_id na ito
            $ongoing = $this->Quotation->find('first',array(
                'conditions'=>array(
                    'Quotation.user_id'=>$this->Auth->user('id'),
                    'Quotation.status'=>'ongoing'
                    )));
            
            $this->loadModel('AgentStatus');
            $agentStat = $this->AgentStatus->find('all',array(
                    'conditions'=>array('AgentStatus.user_id'=>$this->Auth->user('id')),
                    'fields' => array('MAX(AgentStatus.id) AS id')
                ));  
            $current_team = $this->AgentStatus->findById($agentStat[0][0]['id']); 
              
            if(count($ongoing)!=0){
                //retrieve data from quotation
                $quote_data = $ongoing;
            }else{ 
                
                $dateToday=date("Hymds");
                $milliseconds = round(microtime(true) * 1000);
                $newstring = substr($milliseconds, -3);         
                $quote_number = $newstring.''.$dateToday;    
                
                $quote_exist = $this->Quotation->find('count',array(
                    'conditions'=>array(
                        'Quotation.quote_number'=>$quote_number
                    )));
                
               if($quote_exist == 0){
                   $quote_no = $quote_number;
               }else{ 
                    $news = substr($milliseconds, -4);
                    $quote_no = $news.''.$dateToday;
               }
                
                $this->Quotation->create();
                $this->Quotation->set(array(
                    'quote_number'=>$quote_no,
                    'user_id'=>$this->Auth->user('id'),
                    'status'=>'ongoing',
                    'team_id'=>$current_team['AgentStatus']['team_id']
                    ));
                $this->Quotation->save();
                $id = $this->Quotation->getLastInsertID();
//                $quote_data = $this->Quotation->findById($id);
                $quote_data = $this->Quotation->find('first',array(
                    'conditions'=>array('Quotation.user_id'=>$this->Auth->user('id'), 'Quotation.status'=>'ongoing')
                ));
            } 
            $this->set(compact('quote_data'));
            
            $this->loadModel('Client');
            $clients = $this->Client->find('all', array(
                'conditions'=>array('Client.user_id'=>$this->Auth->user('id'), 'Client.lead'=>0)
            ));
            $this->set(compact('clients'));
            
            $this->loadModel('Product'); 
            $products = $this->Product->find('all');
            $this->set(compact('products'));
            
            $this->loadModel('QuotationProduct'); 
            $this->QuotationProduct->recursive = 2;
            $quote_products = $this->QuotationProduct->find('all',array(
                'conditions'=>array('QuotationProduct.quotation_id'=>$quote_data['Quotation']['id'])
            ));
            $this->set(compact('quote_products'));
            
            
//            pr($quote_products);exit;
            $this->set(compact('quote_number'));
            
        }
        
        public function maps(){
            
        }
        
        public function saveCreateQuotation(){ 
            $this->autoRender = false;
            $data = $this->request->data; 
            $id = $data['id'];
            $Qfield = $data['Qfield'];
            $value = $data['value'];
            
            
                $this->Quotation->id = $id;
                $this->Quotation->set(array( 
                     $Qfield => $value,
                        ));
                if($this->Quotation->save()){
                    echo json_encode($data);
                }else{
                    echo json_encode('invalid data');
                }
                exit;
        } 
        
        public function saveAddressQuotation(){ 
            
            $this->autoRender = false;
            $data = $this->request->data; 
            
            $id = $data['id'];
            $address = $data['address'];
            $geolocation = $data['geolocation'];
            $latitude = $data['latitude'];
            $longitude = $data['longitude'];
            $type = $data['type'];
            
            if($type == 'bill_ship'){
                $bill_ship_address = 1;
                if(is_null($address)){
                    $B_address = NULL;
                }else{
                    $B_address = $address;
                }
                $this->Quotation->id=$id;
                $this->Quotation->set(array(
                    'bill_ship_address'=>$bill_ship_address,
                    'bill_address'=>$B_address,
                    'bill_geolocation'=>$geolocation,
                    'bill_latitude'=>$latitude,
                    'bill_longitude'=>$longitude,
                    'ship_address'=>$B_address,
                    'ship_geolocation'=>$geolocation,
                    'ship_latitude'=>$latitude,
                    'ship_longitude'=>$longitude
                ));
                if($this->Quotation->save()){ 
                    echo json_encode($data);
                } 
            }else if($type == 'bill'){
                $bill_ship_address = 0;
                if(is_null($address)){
                    $B_address = NULL;
                }else{
                    $B_address = $address;
                }
                $this->Quotation->id=$id;
                $this->Quotation->set(array(
                    'bill_ship_address'=>$bill_ship_address,
                    'bill_address'=>$B_address,
                    'bill_geolocation'=>$geolocation,
                    'bill_latitude'=>$latitude,
                    'bill_longitude'=>$longitude 
                ));
                if($this->Quotation->save()){ 
                    echo json_encode($data);
                } 
            } else if($type == 'ship'){
                $bill_ship_address = 0;
                if(is_null($address)){
                    $B_address = NULL;
                }else{
                    $B_address = $address;
                }
                $this->Quotation->id=$id;
                $this->Quotation->set(array(
                    'bill_ship_address'=>$bill_ship_address,
                    'ship_address'=>$B_address,
                    'ship_geolocation'=>$geolocation,
                    'ship_latitude'=>$latitude,
                    'ship_longitude'=>$longitude
                ));
                if($this->Quotation->save()){ 
                    echo json_encode($data);
                } 
            } 
            
            exit;
        }
        
        public function product_info(){ 
            $this->autoRender = false;
            $this->response->type('json'); 
            if( $this->request->is('ajax') ) { 
                $id = $this->request->query['id']; 
                 $this->loadModel('Product');
		$this->Product->recursive = 2;
                $product = $this->Product->findById($id); 
                    return (json_encode($product)); 
                     exit;
               }
        }
        
}
