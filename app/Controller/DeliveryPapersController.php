<?php
App::uses('AppController', 'Controller');
/**
 * DeliveryPapers Controller
 *
 * @property DeliveryPaper $DeliveryPaper
 * @property PaginatorComponent $Paginator
 */
class DeliveryPapersController extends AppController {

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
		$this->DeliveryPaper->recursive = 0;
		$this->set('deliveryPapers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DeliveryPaper->exists($id)) {
			throw new NotFoundException(__('Invalid delivery paper'));
		}
		$options = array('conditions' => array('DeliveryPaper.' . $this->DeliveryPaper->primaryKey => $id));
		$this->set('deliveryPaper', $this->DeliveryPaper->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DeliveryPaper->create();
			if ($this->DeliveryPaper->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery paper has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery paper could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$deliverySchedules = $this->DeliveryPaper->DeliverySchedule->find('list');
		$quotations = $this->DeliveryPaper->Quotation->find('list');
		$this->set(compact('deliverySchedules', 'quotations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DeliveryPaper->exists($id)) {
			throw new NotFoundException(__('Invalid delivery paper'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DeliveryPaper->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery paper has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery paper could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('DeliveryPaper.' . $this->DeliveryPaper->primaryKey => $id));
			$this->request->data = $this->DeliveryPaper->find('first', $options);
		}
		$deliverySchedules = $this->DeliveryPaper->DeliverySchedule->find('list');
		$quotations = $this->DeliveryPaper->Quotation->find('list');
		$this->set(compact('deliverySchedules', 'quotations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DeliveryPaper->id = $id;
		if (!$this->DeliveryPaper->exists()) {
			throw new NotFoundException(__('Invalid delivery paper'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DeliveryPaper->delete()) {
			$this->Session->setFlash(__('The delivery paper has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The delivery paper could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function addPaper(){               
                
        $this->autoRender = false;
        $data = $this->request->data;
        $dr_paper_id = $data['dr_paper_id'];
        $date_needed = $data['date_needed']; 
        $quotation_id = $data['quotation_id']; 
 
        $this->DeliveryPaper->create();
        $this->DeliveryPaper->set(array(
            "dr_paper_id" => $dr_paper_id,
            "date_needed" => $date_needed,
            "quotation_id" => $quotation_id,
            "user_id" => $this->Auth->user('id')
        ));
        if ($this->DeliveryPaper->save()) {
            echo json_encode($data);
        } else {
            echo json_encode('invalid data');
        }
        exit;
        }
}
