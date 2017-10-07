<?php
App::uses('AppController', 'Controller');
/**
 * AgentStatuses Controller
 *
 * @property AgentStatus $AgentStatus
 * @property PaginatorComponent $Paginator
 */
class AgentStatusesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
//	public $uses = ['User', 'Team', 'Position', 'Department'];

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AgentStatus->recursive = 0;
		$this->set('agentStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AgentStatus->exists($id)) {
			throw new NotFoundException(__('Invalid agent status'));
		}
		$options = array('conditions' => array('AgentStatus.' . $this->AgentStatus->primaryKey => $id));
		$this->set('agentStatus', $this->AgentStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AgentStatus->create();
			if ($this->AgentStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The agent status has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => '/index'));
			} else {
				$this->Session->setFlash(__('The agent status could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->AgentStatus->User->find('list');
		$teams = $this->AgentStatus->Team->find('list');
		$this->set(compact('users', 'teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AgentStatus->exists($id)) {
			throw new NotFoundException(__('Invalid agent status'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AgentStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The agent status has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The agent status could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('AgentStatus.' . $this->AgentStatus->primaryKey => $id));
			$this->request->data = $this->AgentStatus->find('first', $options);
		}
		$users = $this->AgentStatus->User->find('list');
		$teams = $this->AgentStatus->Team->find('list');
		$this->set(compact('users', 'teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AgentStatus->id = $id;
		if (!$this->AgentStatus->exists()) {
			throw new NotFoundException(__('Invalid agent status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AgentStatus->delete()) {
			$this->Session->setFlash(__('The agent status has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The agent status could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
