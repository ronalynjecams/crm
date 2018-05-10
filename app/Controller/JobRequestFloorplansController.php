<?php
App::uses('AppController', 'Controller');
/**
 * JobRequestFloorplans Controller
 *
 * @property JobRequestFloorplan $JobRequestFloorplan
 * @property PaginatorComponent $Paginator
 */
class JobRequestFloorplansController extends AppController {

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
		$this->JobRequestFloorplan->recursive = 0;
		$this->set('jobRequestFloorplans', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequestFloorplan->exists($id)) {
			throw new NotFoundException(__('Invalid job request floorplan'));
		}
		$options = array('conditions' => array('JobRequestFloorplan.' . $this->JobRequestFloorplan->primaryKey => $id));
		$this->set('jobRequestFloorplan', $this->JobRequestFloorplan->find('first', $options));
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequestFloorplan->exists($id)) {
			throw new NotFoundException(__('Invalid job request floorplan'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequestFloorplan->save($this->request->data)) {
				$this->Session->setFlash(__('The job request floorplan has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request floorplan could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequestFloorplan.' . $this->JobRequestFloorplan->primaryKey => $id));
			$this->request->data = $this->JobRequestFloorplan->find('first', $options);
		}
		$quotations = $this->JobRequestFloorplan->Quotation->find('list');
		$clients = $this->JobRequestFloorplan->Client->find('list');
		$users = $this->JobRequestFloorplan->User->find('list');
		$jobRequests = $this->JobRequestFloorplan->JobRequest->find('list');
		$jobRequestTypes = $this->JobRequestFloorplan->JobRequestType->find('list');
		$poRawRequests = $this->JobRequestFloorplan->PoRawRequest->find('list');
		$this->set(compact('quotations', 'clients', 'users', 'jobRequests', 'jobRequestTypes', 'poRawRequests'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequestFloorplan->id = $id;
		if (!$this->JobRequestFloorplan->exists()) {
			throw new NotFoundException(__('Invalid job request floorplan'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequestFloorplan->delete()) {
			$this->Session->setFlash(__('The job request floorplan has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request floorplan could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	// MODIFICATION [ M A E ]
	// ========================================================================>
	public function add() {
		$this->autoRender = false;
		$userin = $this->Auth->user('id');
		$data = $this->request->data;

		$job_request_floorplan_set = [
			'quotation_id'=>$data['quotation_id'],
			'client_id'=>$data['client_id'],
			'user_id'=>$userin,
			'job_request_id'=>$data['job_request_id'],
			'deadline_date'=>$data['deadline_date'],
			'job_request_type_id'=>$data['job_request_type_id'],
			'status'=>$data['status'],
			'description'=>$data['description']];
		
		$DS_JobRequestFloorPlan = $this->JobRequestFloorplan->getDataSource();
		$DS_JobRequestFloorPlan->begin();
		$this->JobRequestFloorplan->create();
		$this->JobRequestFloorplan->set($job_request_floorplan_set);
		if($this->JobRequestFloorplan->save()) {
			echo "JobRequestFloorplan saved";
			$DS_JobRequestFloorPlan->commit();
		}
		else {
			echo "Error in JobRequestFloorplan";
			$DS_JobRequestFloorPlan->rollback();
		}
		
		echo json_encode($job_request_floorplan_set);
		return "Executed Everything";
	}
	// ========================================================================>
	// END OF MODIFICATION [ M A E ]
	
}