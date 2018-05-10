<?php
App::uses('AppController', 'Controller');
/**
 * JobRequestProducts Controller
 *
 * @property JobRequestProduct $JobRequestProduct
 * @property PaginatorComponent $Paginator
 */
class JobRequestProductsController extends AppController {

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
		$this->JobRequestProduct->recursive = 0;
		$this->set('jobRequestProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequestProduct->exists($id)) {
			throw new NotFoundException(__('Invalid job request product'));
		}
		$options = array('conditions' => array('JobRequestProduct.' . $this->JobRequestProduct->primaryKey => $id));
		$this->set('jobRequestProduct', $this->JobRequestProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobRequestProduct->create();
			if ($this->JobRequestProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The job request product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotationProducts = $this->JobRequestProduct->QuotationProduct->find('list');
		$users = $this->JobRequestProduct->User->find('list');
		$clients = $this->JobRequestProduct->Client->find('list');
		$jobRequests = $this->JobRequestProduct->JobRequest->find('list');
		$jobRequestTypes = $this->JobRequestProduct->JobRequestType->find('list');
		$poRawRequests = $this->JobRequestProduct->PoRawRequest->find('list');
		$quotations = $this->JobRequestProduct->Quotation->find('list');
		$products = $this->JobRequestProduct->Product->find('list');
		$this->set(compact('quotationProducts', 'users', 'clients', 'jobRequests', 'jobRequestTypes', 'poRawRequests', 'quotations', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequestProduct->exists($id)) {
			throw new NotFoundException(__('Invalid job request product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequestProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The job request product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequestProduct.' . $this->JobRequestProduct->primaryKey => $id));
			$this->request->data = $this->JobRequestProduct->find('first', $options);
		}
		$quotationProducts = $this->JobRequestProduct->QuotationProduct->find('list');
		$users = $this->JobRequestProduct->User->find('list');
		$clients = $this->JobRequestProduct->Client->find('list');
		$jobRequests = $this->JobRequestProduct->JobRequest->find('list');
		$jobRequestTypes = $this->JobRequestProduct->JobRequestType->find('list');
		$poRawRequests = $this->JobRequestProduct->PoRawRequest->find('list');
		$quotations = $this->JobRequestProduct->Quotation->find('list');
		$products = $this->JobRequestProduct->Product->find('list');
		$this->set(compact('quotationProducts', 'users', 'clients', 'jobRequests', 'jobRequestTypes', 'poRawRequests', 'quotations', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequestProduct->id = $id;
		if (!$this->JobRequestProduct->exists()) {
			throw new NotFoundException(__('Invalid job request product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequestProduct->delete()) {
			$this->Session->setFlash(__('The job request product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function add_type_revision() {
		$this->autoRender = false;
		$this->loadModel('JobRequestRevision');
		$this->loadModel('JobRequestLog');
		$this->loadModel('JobRequestFloorplan');
		// GLOBALS
		$userin = $this->Auth->user('id');
		
		// RENDER DATA
		$data = $this->request->data;
		$job_request_id = $data['job_request_id'];
		$job_request_product_id = $data['job_request_product_id'];
		$job_request_type_id = $data['job_request_type_id'];
		$deadline_date = $data['deadline_date'];
		$product_id = $data['product_id'];
		$job_request_floor_plan_id = $data['job_request_floor_plan_id'];
		$quotation_product_id = $data['quotation_product_id'];
		$remarks = $data['remarks'];
		$JobRequestRevision_set = [
									"job_request_id"=>$job_request_id,
									"job_request_product_id"=>$job_request_product_id,
									"job_request_type_id"=>$job_request_type_id,
									"deadline_date"=>$deadline_date,
									"product_id"=>$product_id,
									"job_request_floorplan_id"=>$job_request_floor_plan_id,
									"quotation_product_id"=>$quotation_product_id,
									"remarks"=>$remarks
								  ];
								  
		echo json_encode($data);
		
		// JOB REQUEST REVISION
		$DS_JobRequestRevision = $this->JobRequestRevision->getDataSource();
		$DS_JobRequestRevision->begin();
		
		$this->JobRequestRevision->create();
		$this->JobRequestRevision->set($JobRequestRevision_set);
		if($this->JobRequestRevision->save()) {
			echo "JobRequestRevision save";
			$job_request_revision_id = $this->JobRequestRevision->getLastInsertId();
			
			// JOB REQUEST PRODUCT
	    	// ===================================================================>
	    	if($job_request_floor_plan_id==0) {
				$DS_JobRequestProduct = $this->JobRequestProduct->getDataSource();
				$DS_JobRequestProduct->begin();
				$this->JobRequestProduct->id = $job_request_product_id;
				$this->JobRequestProduct->set(['status'=>'pending',
											   'deadline_date'=>$deadline_date]);
				if($this->JobRequestProduct->save()) {
					// JOB REQUEST
			    	// ===================================================================>
					$DS_JobRequest = $this->JobRequest->getDataSource();
					$DS_JobRequest->begin();
					
					$this->JobRequest->id = $job_request_id;
					$this->JobRequest->set(['status'=>'pending']);
					if($this->JobRequest->save()) {
						$job_request_log_set = ['user_id'=>$userin,
												'job_request_id', $job_request_id,
												'job_request_floorplan_id'=>$job_request_floor_plan_id,
												'job_request_product_id'=>$job_request_product_id,
												'job_request_assignment_id'=>0,
												'status'=>'new',
												'activity'=>'Job Request Revision - ADD',
												'quotation_product_id'=>$quotation_product_id,
												'job_request_revision_id'=>$job_request_revision_id ];
						
						// JOB REQUEST LOG
				    	// ===================================================================>
						$DS_JobRequestLog = $this->JobRequestLog->getDataSource();
						$DS_JobRequestLog->begin();
						
						$this->JobRequestLog->create();
						$this->JobRequestLog->set($job_request_log_set);
						if($this->JobRequestLog->save()) {
							echo "JobRequestLog save";
							$DS_JobRequestProduct->commit();
							$DS_JobRequestRevision->commit();
							$DS_JobRequest->commit();
							$DS_JobRequestLog->commit();
						}
						else {
							echo "Error in JobRequestLog";
							$DS_JobRequestLog->rollback();
							$DS_JobRequestProduct->rollback();
							$DS_JobRequestRevision->rollback();
							$DS_JobRequest->rollback();
						}
					}
					else {
						echo "Error in JobRequest";
						$DS_JobRequestProduct->rollback();
						$DS_JobRequestRevision->rollback();
						$DS_JobRequest->rollback();
					}
				}
				else {
					echo "Error in JobRequestProduct";
					$DS_JobRequestProduct->rollback();
				   	$DS_JobRequestRevision->commit();
				}
	    	}
	    	else {
				$DS_JobRequestFloorplan = $this->JobRequestFloorplan->getDataSource();
				$DS_JobRequestFloorplan->begin();
				$this->JobRequestFloorplan->id = $job_request_floor_plan_id;
				$this->JobRequestFloorplan->set(['status'=>'pending',
											     'deadline_date'=>$deadline_date]);
				if($this->JobRequestFloorplan->save()) {
					// JOB REQUEST
			    	// ===================================================================>
					$DS_JobRequest = $this->JobRequest->getDataSource();
					$DS_JobRequest->begin();
					
					$this->JobRequest->id = $job_request_id;
					$this->JobRequest->set(['status'=>'pending']);
					if($this->JobRequest->save()) {
						$job_request_log_set = ['user_id'=>$userin,
												'job_request_id', $job_request_id,
												'job_request_floorplan_id'=>$job_request_floor_plan_id,
												'job_request_product_id'=>$job_request_product_id,
												'job_request_assignment_id'=>0,
												'status'=>'new',
												'activity'=>'Job Request Floorplan - ADD',
												'quotation_product_id'=>$quotation_product_id,
												'job_request_revision_id'=>$job_request_revision_id ];
						
						// JOB REQUEST LOG
				    	// ===================================================================>
						$DS_JobRequestLog = $this->JobRequestLog->getDataSource();
						$DS_JobRequestLog->begin();
						
						$this->JobRequestLog->create();
						$this->JobRequestLog->set($job_request_log_set);
						if($this->JobRequestLog->save()) {
							echo "JobRequestLog save";
							$DS_JobRequestFloorplan->commit();
							$DS_JobRequestRevision->commit();
							$DS_JobRequest->commit();
							$DS_JobRequestLog->commit();
						}
						else {
							echo "Error in JobRequestLog";
							$DS_JobRequestLog->rollback();
							$DS_JobRequestFloorplan->rollback();
							$DS_JobRequestRevision->rollback();
							$DS_JobRequest->rollback();
						}
					}
					else {
						echo "Error in JobRequest";
						$DS_JobRequestFloorplan->rollback();
						$DS_JobRequestRevision->rollback();
						$DS_JobRequest->rollback();
					}
				}
				else {
					echo "Error in JobRequestFloorplan";
					$DS_JobRequestFloorplan->rollback();
				   	$DS_JobRequestRevision->commit();
				}
	    	}
		}
		else {
			echo "Error in JobRequestRevision";
			$DS_JobRequestRevision->rollback();
		}
		
		return "Everything was executed!";
	}
}