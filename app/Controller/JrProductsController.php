<?php

App::uses('AppController', 'Controller');

/**
 * JrProducts Controller
 *
 * @property JrProduct $JrProduct
 * @property PaginatorComponent $Paginator
 */
class JrProductsController extends AppController {

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
        $this->JrProduct->recursive = 0;
        $this->set('jrProducts', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->JrProduct->exists($id)) {
            throw new NotFoundException(__('Invalid jr product'));
        }
        $options = array('conditions' => array('JrProduct.' . $this->JrProduct->primaryKey => $id));
        $this->set('jrProduct', $this->JrProduct->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->JrProduct->create();
            if ($this->JrProduct->save($this->request->data)) {
                $this->Session->setFlash(__('The jr product has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The jr product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $quotationProducts = $this->JrProduct->QuotationProduct->find('list');
        $users = $this->JrProduct->User->find('list');
        $jobRequests = $this->JrProduct->JobRequest->find('list');
        $this->set(compact('quotationProducts', 'users', 'jobRequests'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->JrProduct->exists($id)) {
            throw new NotFoundException(__('Invalid jr product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->JrProduct->save($this->request->data)) {
                $this->Session->setFlash(__('The jr product has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The jr product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('JrProduct.' . $this->JrProduct->primaryKey => $id));
            $this->request->data = $this->JrProduct->find('first', $options);
        }
        $quotationProducts = $this->JrProduct->QuotationProduct->find('list');
        $users = $this->JrProduct->User->find('list');
        $jobRequests = $this->JrProduct->JobRequest->find('list');
        $this->set(compact('quotationProducts', 'users', 'jobRequests'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->JrProduct->id = $id;
        if (!$this->JrProduct->exists()) {
            throw new NotFoundException(__('Invalid jr product'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->JrProduct->delete()) {
            $this->Session->setFlash(__('The jr product has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The jr product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function uploadFiles($id) {
        $this->autoRender = false;

        $target_path_pdf = WWW_ROOT . 'job_request_product/' . $id . '/';   //2
        if (!is_dir($target_path_pdf)) {
            $storeFolder = mkdir($target_path_pdf, 0777, true);
        } else {
            $storeFolder = $target_path_pdf;
        }

        $tempFile = $_FILES['file']['tmp_name'];          //3             

        $targetFile = $storeFolder . date('d_m_Y_H_i_s') . '_' . $_FILES['file']['name'];  //5

        if (move_uploaded_file($tempFile, $targetFile)) {
            $this->loadModel('JrUpload');
            $this->JrUpload->create();
            $this->JrUpload->set(array(
                'jr_product_id' => $id,
                'file' => $targetFile,
                'viewed' => 0
            ));
            if ($this->JrUpload->save()) {
                pr('save');
            } else {
                pr('failed');
            }
        }
    }

    public function work_status() {
        $this->autoRender = false;
        $data = $this->request->data;

        $jr_product_id = $data['id'];
        $status = $data['status'];

        $this->loadModel('JrWorkStatus');
        $this->JrWorkStatus->create();
        $this->JrWorkStatus->set(array(
            'status' => $status,
            'minutes' => 0,
            'jr_product_id' => $jr_product_id
        ));
        if ($this->JrWorkStatus->save()) {
            $this->JrProduct->id = $jr_product_id;
            $this->JrProduct->set(array(
                'status' => $status
            ));
            if ($this->JrProduct->save()) {
                    $this->loadModel('JobRequest');
                    $jrprod = $this->JrProduct->findById($jr_product_id);
                    $job_request_id = $jrprod['JrProduct']['job_request_id'];
                if($status == 'accomplished'){
                    //count all jr_products  for the specific job request, 
                    //compare total jr product to total accomplished product
//                    if equal, then job request is accomplished
                    
                    $jrs_accomp = $this->JrProduct->find('all',array(
                        'status'=>'accomplished'
                    ));
                    
                    $jrs_all = $this->JrProduct->find('all',array(
                        'job_request_id'=>$job_request_id
                    )); 
                    
                    if(count($jrs_accomp) == count($jrs_all)){
                        $this->JobRequest->id = $job_request_id;
                        $this->JobRequest->set(array(
                            'status' =>'accomplished'
                        ));
                        $this->JobRequest->save();
                    }
                }
                
                
                echo json_encode($data);
            } else if($status == 'ongoing'){
                        $this->JobRequest->id = $job_request_id;
                        $this->JobRequest->set(array(
                            'status' =>'ongoing'
                        ));
                        $this->JobRequest->save();
                
            }
        } 



//        id
//        status
    }

}
