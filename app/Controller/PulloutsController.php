<?php
App::uses('AppController', 'Controller');
/**
 * Pullouts Controller
 *
 * @property Pullout $Pullout
 * @property PaginatorComponent $Paginator
 */
class PulloutsController extends AppController {

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
		$this->Pullout->recursive = 0;
		$this->set('pullouts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pullout->exists($id)) {
			throw new NotFoundException(__('Invalid pullout'));
		}
		$options = array('conditions' => array('Pullout.' . $this->Pullout->primaryKey => $id));
		$this->set('pullout', $this->Pullout->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pullout->create();
			if ($this->Pullout->save($this->request->data)) {
				$this->Session->setFlash(__('The pullout has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pullout could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clientServices = $this->Pullout->ClientService->find('list');
		$clientServiceProducts = $this->Pullout->ClientServiceProduct->find('list');
		$this->set(compact('clientServices', 'clientServiceProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pullout->exists($id)) {
			throw new NotFoundException(__('Invalid pullout'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pullout->save($this->request->data)) {
				$this->Session->setFlash(__('The pullout has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pullout could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Pullout.' . $this->Pullout->primaryKey => $id));
			$this->request->data = $this->Pullout->find('first', $options);
		}
		$clientServices = $this->Pullout->ClientService->find('list');
		$clientServiceProducts = $this->Pullout->ClientServiceProduct->find('list');
		$this->set(compact('clientServices', 'clientServiceProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pullout->id = $id;
		if (!$this->Pullout->exists()) {
			throw new NotFoundException(__('Invalid pullout'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pullout->delete()) {
			$this->Session->setFlash(__('The pullout has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The pullout could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function pullout_add() {
		$this->autoRender = false;
		$data = $this->request->data;

		$type = $data["type"];
        $status = $data["status"];
        $pullout_qty = $data["pullout_qty"];
        $expected_pullout_date = $data["expected_pullout_date"];
        $expected_pullout_time = $data["expected_pullout_time"];
        $delivery_mode = $data["delivery_mode"];
        $reference_number = $data["reference_number"];
        $reference_product_number = $data["reference_product_number"];
        
        // GET DELIVERED DATE
        // GET DELIVERED QUANTITY
        $this->loadModel('DeliverySchedProduct');
        $get_delivered_qty = $this->DeliverySchedProduct->findByReferenceNum($reference_product_number);
        $DeliverySchedules = $get_delivered_qty['DeliverySchedule'];
        $DeliverySchedProduct = $get_delivered_qty['DeliverySchedProduct'];
        $delivered_qty = $DeliverySchedProduct['delivered_qty'];
        $date_delivered_raw = $DeliverySchedules['delivery_date'];
        $date_delivered = date("Y-m-d H:m:s", strtotime($date_delivered_raw));
        $expected_pullout_datetime = date("Y-m-d H:m:s", strtotime($expected_pullout_date." ".$expected_pullout_time));
        
        // CHECK IF THERE IS AN EXISTING PULLOUT DELIVERY
        
        $DS_Pullout = $this->Pullout->getDataSource();
        $DS_Pullout->begin();
        
        $this->Pullout->create();
        $this->Pullout->set(['type'=>$type,
	        				 'status'=>$status,
	        				 'delivered_qty'=>$delivered_qty,
	        				 'date_delivered'=>$date_delivered,
	        				 'pullout_qty'=>$pullout_qty,
	        				 'expected_pullout_date'=>$expected_pullout_datetime,
	        				 'delivery_mode'=>$delivery_mode,
	        				 'reference_product_number'=>$reference_product_number,
	        				 'reference_number'=>$reference_number]);
        if($this->Pullout->save()) {
        	// PULL OUT SAVED
        	$pullout_id = $this->Pullout->getLastInsertId();
	        $pullout_log_set = ['pullout_id'=> $pullout_id, 'status'=> $status];
	        
	        $this->loadModel('PulloutLog');
	        $DS_PulloutLog = $this->PulloutLog->getDataSource();
	        $DS_PulloutLog->begin();
	        
	        $this->PulloutLog->create();
	        $this->PulloutLog->set($pullout_log_set);
	        if($this->PulloutLog->save()) {
	        	// PULL OUT LOG SAVED
		        $DS_PulloutLog->commit();
		        $DS_Pullout->commit();
		        
		        return $pullout_id;
	        }
	        else {
	        	// ERROR IN SAVING PULL OUT LOG
	        	$DS_PulloutLog->rollback();
	        	$DS_Pullout->rollback();
	        	
	        	return "ERROR";
	        }
        }
        else {
        	// ERROR IN PULL OUT
        	$DS_Pullout->rollback();
        	return "ERROR";
        }
	}
}
