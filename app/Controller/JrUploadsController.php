<?php
App::uses('AppController', 'Controller');
/**
 * JrUploads Controller
 *
 * @property JrUpload $JrUpload
 * @property PaginatorComponent $Paginator
 */
class JrUploadsController extends AppController {

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
		$this->JrUpload->recursive = 0;
		$this->set('jrUploads', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JrUpload->exists($id)) {
			throw new NotFoundException(__('Invalid jr upload'));
		}
		$options = array('conditions' => array('JrUpload.' . $this->JrUpload->primaryKey => $id));
		$this->set('jrUpload', $this->JrUpload->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JrUpload->create();
			if ($this->JrUpload->save($this->request->data)) {
				$this->Session->setFlash(__('The jr upload has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr upload could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$jrProducts = $this->JrUpload->JrProduct->find('list');
		$this->set(compact('jrProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JrUpload->exists($id)) {
			throw new NotFoundException(__('Invalid jr upload'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JrUpload->save($this->request->data)) {
				$this->Session->setFlash(__('The jr upload has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr upload could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JrUpload.' . $this->JrUpload->primaryKey => $id));
			$this->request->data = $this->JrUpload->find('first', $options);
		}
		$jrProducts = $this->JrUpload->JrProduct->find('list');
		$this->set(compact('jrProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JrUpload->id = $id;
		if (!$this->JrUpload->exists()) {
			throw new NotFoundException(__('Invalid jr upload'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JrUpload->delete()) {
			$this->Session->setFlash(__('The jr upload has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The jr upload could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function removeFile(){
        $this->autoRender = false;
        $data = $this->request->data;
        $id = $data['id'];
        
        $ff = $this->JrUpload->findById($id);
//        pr($ff);exit;
        $path = $ff['JrUpload']['file'];
            if (unlink($path)) {
		$this->JrUpload->id = $id;
                if ($this->JrUpload->delete()) {
                    echo json_encode('deleted');
                }
                
            }
        }
}
