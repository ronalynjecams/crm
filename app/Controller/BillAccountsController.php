<?php
App::uses('AppController', 'Controller');
/**
 * BillAccounts Controller
 *
 * @property BillAccount $BillAccount
 * @property PaginatorComponent $Paginator
 */
class BillAccountsController extends AppController {

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
		$this->BillAccount->recursive = 0;
		$this->set('billAccounts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BillAccount->exists($id)) {
			throw new NotFoundException(__('Invalid bill account'));
		}
		$options = array('conditions' => array('BillAccount.' . $this->BillAccount->primaryKey => $id));
		$this->set('billAccount', $this->BillAccount->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BillAccount->create();
			if ($this->BillAccount->save($this->request->data)) {
				$this->Session->setFlash(__('The bill account has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill account could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BillAccount->exists($id)) {
			throw new NotFoundException(__('Invalid bill account'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BillAccount->save($this->request->data)) {
				$this->Session->setFlash(__('The bill account has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill account could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('BillAccount.' . $this->BillAccount->primaryKey => $id));
			$this->request->data = $this->BillAccount->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BillAccount->id = $id;
		if (!$this->BillAccount->exists()) {
			throw new NotFoundException(__('Invalid bill account'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BillAccount->delete()) {
			$this->Session->setFlash(__('The bill account has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The bill account could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function view_account(){

		$bill_accounts = $this->BillAccount->find('all');
        $this->set(compact('bill_accounts'));
	}


	public function add_account(){
		$this->autoRender = false;
        header("Content-type:application/json");
            
			if($this->request->is('post')){
			$this->BillAccount->create();
			
			if($this->BillAccount->save($this->request->data)){
				echo json_encode("Save");

			}
		}
		
	}
	
	 public function update_account() {
        $this->autoRender = false;
        $this->response->type('json');
        
        $dd = $this->request->data;
        $id = $dd['id'];

        if ($this->request->is(array('post', 'put'))) {
            if ($this->BillAccount->save($this->request->data)) {
                return (json_encode($this->request->data));
            } else {
                return (json_encode($this->request->data));
            }
        } else {
            return (json_encode($this->request->data));
        }
        exit;
    }
    
    
    public function get_bill_info() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
        	
            $id = $this->request->query['id'];
            
            $this->BillAccount->recursive = -1;
            
            $bill = $this->BillAccount->findById($id);
            return (json_encode($bill['BillAccount']['name']));
            exit;
        }
    }
	

}
