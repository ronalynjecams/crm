<?php

App::uses('AppController', 'Controller');
//App::import('Vendor','Mpdf');

/**
 * JobRequests Controller
 *
 * @property JobRequest $JobRequest
 * @property PaginatorComponent $Paginator
 */
class JobRequestsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Mpdf.Mpdf');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->JobRequest->recursive = 0;
        $this->set('jobRequests', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $params = array(
            'download' => false,
            'name' => 'example.pdf',
            'paperOrientation' => 'portrait',
            'paperSize' => 'legal'
        );
        $this->set($params);
    }

//        if (!$this->JobRequest->exists($id)) {
//            throw new NotFoundException(__('Invalid job request'));
//        }
//        $options = array('conditions' => array('JobRequest.' . $this->JobRequest->primaryKey => $id));
//        $this->set('jobRequest', $this->JobRequest->find('first', $options));
//    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->JobRequest->create();
            if ($this->JobRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The job request has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The job request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $quotations = $this->JobRequest->Quotation->find('list');
        $this->set(compact('quotations'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->JobRequest->exists($id)) {
            throw new NotFoundException(__('Invalid job request'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->JobRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The job request has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The job request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('JobRequest.' . $this->JobRequest->primaryKey => $id));
            $this->request->data = $this->JobRequest->find('first', $options);
        }
        $quotations = $this->JobRequest->Quotation->find('list');
        $this->set(compact('quotations'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->JobRequest->id = $id;
        if (!$this->JobRequest->exists()) {
            throw new NotFoundException(__('Invalid job request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->JobRequest->delete()) {
            $this->Session->setFlash(__('The job request has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The job request could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function saveNewJobRequest() {
        $this->autoRender = false;
        $data = $this->request->data;
        $status = $data['status'];
        $quotation_id = $data['quotation_id'];
        $jr_number = $data['jr_number'];
        $this->loadModel('Quotation');
        $this->JobRequest->create();
        $this->JobRequest->set(array(
            'status' => $status,
            'jr_number' => $jr_number,
        ));
        if ($this->JobRequest->save()) {
            $jr_id = $this->JobRequest->getLastInsertID();
            $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'job_request_id' => $jr_id
            ));
            if ($this->Quotation->save()) {
                echo json_encode($quotation_id);
            }
        }

        exit;
    }

    public function joupdate() {
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('JrProduct');
        $quote_id = $this->params['url']['id'];
        $this->QuotationProduct->recursive = 3;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quote_id, 'Quotation.type !=' => 'supply')
        ));
        ///add muna yung mga products na hindi supply sa jrproducts
        if(count($quote_products)!=0){
        $job_request_id = $quote_products[0]['Quotation']['job_request_id'];
        foreach ($quote_products as $quote_prod) {
            $quotation_product_id = $quote_prod['QuotationProduct']['id'];

            $check = $this->JrProduct->find('all', array(
                'conditions' => array(
                    'JrProduct.job_request_id' => $job_request_id,
                    'JrProduct.quotation_product_id' => $quotation_product_id
            )));
//           pr(count($check));exit;
            if (count($check) == 0) {
                $this->JrProduct->create();
                $this->JrProduct->set(array(
                    'quotation_product_id' => $quotation_product_id,
                    'job_request_id' => $job_request_id,
                    'status' => 'pending'
                ));
                $this->JrProduct->save();
            }
        }
        $this->JrProduct->recursive = 3;
        $jr_products = $this->JrProduct->find('all', array(
            'conditions' => array('JrProduct.job_request_id' => $job_request_id)
        ));
        }else{
            $jr_products = 0;
        }


//        pr($jr_products[0]['QuotationProduct']['Product']);exit;
//        
        $this->set(compact('jr_products'));
        
        $this->set(compact('quote_id'));
//        $quote_data = $this->Quotation->findById($quote_id);
//        $this->set(compact('quote_data'));
//
        $designers = $this->User->find('all', array(
            'conditions' => array(
                'User.department_id' => 5
        )));
        $this->set(compact('designers'));
        
        
        
        $qq = $this->Quotation->findById($quote_id);
        $this->set(compact('qq'));
        $count_floor_plan = $this->JrProduct->find('count',array(
            'conditions' => array('JrProduct.floor_plan_details !=' => NULL, 'JrProduct.job_request_id'=> $qq['Quotation']['job_request_id'])));
        $this->set(compact('count_floor_plan'));
    }

    public function quote_product_info() {
        $this->autoRender = false;
        $this->loadModel('JrProduct');
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->JrProduct->recursive = 3;
            $jrprod = $this->JrProduct->findById(15);
            return (json_encode($jrprod));
            exit;
        }
    }

    public function updateJRProduct() {
        $this->loadModel('JrProduct');
        $this->autoRender = false;
        $data = $this->request->data;
        $usr_typ = $data['usr_typ'];
        $dateToday=date("Y-m-d H:i:s");
        
        $this->JrProduct->id = $data['id'];
        if ($usr_typ == 'agent') {
            $this->JrProduct->set(array(
                'deadline' => $data['deadline']
            ));
        }else if ($usr_typ == 'design_head') {
            $this->JrProduct->set(array(
                'user_id' => $data['user_id'],
                'date_assigned'=>$dateToday
            ));
        }
        if ($this->JrProduct->save()) {
            return (json_encode($data));
            $this->loadModel('User');
            $design_head = $this->User->find('first', array(
                'conditions' => array(
                    'role' => 'design_head',
                    'active' => 1
                )
            ));

            if ($usr_typ == 'agent') {
                $desc = $this->Auth->user('first_name') . ' added deadline for a product in Job Request';
                $this->loadModel('Notification');
                $exist = $this->Notification->find('all', array(
                    'conditions' => array(
                        'Notification.user_id' => $this->Auth->user('id'),
                        'Notification.for_who' => $design_head['User']['id'],
                        'Notification.title' => 'Job Request'
                    )
                ));
                if (count($exist) == 0) {
                    $this->Notification->create();
                    $this->Notification->set(array(
                        'user_id' => $this->Auth->user('id'),
                        'for_who' => $design_head['User']['id'],
                        'title' => 'Job Request',
                        'description' => $desc
                    ));
                    $this->Notification->save();
                }
                //after save, get active design_head user_id then insert to notifications
                //creator, is the agent currently logged in
                //for_id design_head
            }
        }
    }

    public function pending() {
        $this->loadModel('JrProduct');
//        $this->JobRequest->recursive =5;
        $this->loadModel('JobRequest');
        $this->loadModel('Quotation');
        $pending_jrs = $this->JobRequest->Quotation->find('all', array(
        'conditions' => array('JobRequest.status' => 'pending' 
            )));
        
            $this->set(compact('pending_jrs')); 
    }
    
    public function saveFloorPlan(){
        $this->loadModel('JrProduct');
        $this->autoRender = false;
        $data = $this->request->data;  
        $this->JrProduct->create(); 
        if ($this->JrProduct->save($data)) { 
            echo json_encode($this->JrProduct->getLastInsertId()); 
        }

        exit;
    }
    
    
    public function pending_designer() {
        $this->loadModel('JrProduct'); 
        $this->loadModel('JobRequest');
        $this->loadModel('Quotation'); 
         
        $this->JrProduct->recursive=3; 
        $pending_jrs = $this->JrProduct->find('all', array(
            'conditions'=>array('JrProduct.user_id'=>$this->Auth->user('id')),
            'group'=>array('JrProduct.job_request_id')
            ));
            $this->set(compact('pending_jrs'));
         
    }

    public function joupdate_designer() {
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('JrProduct');
        $quote_id = $this->params['url']['id'];
        $this->QuotationProduct->recursive = 3;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quote_id, 'Quotation.type !=' => 'supply')
        ));
        ///add muna yung mga products na hindi supply sa jrproducts
        
        $job_request_id = $quote_products[0]['Quotation']['job_request_id'];
        
        $this->JrProduct->recursive = 3;
        $jr_products = $this->JrProduct->find('all', array(
            'conditions' => array('JrProduct.job_request_id' => $job_request_id,
                'JrProduct.user_id'=>$this->Auth->user('id'))
        ));
        


//        pr($jr_products[0]['QuotationProduct']['Product']);exit;
//        
        $this->set(compact('jr_products'));
        
        $this->set(compact('quote_id'));
//        $quote_data = $this->Quotation->findById($quote_id);
//        $this->set(compact('quote_data'));
//
        $designers = $this->User->find('all', array(
            'conditions' => array(
                'User.department_id' => 5
        )));
        $this->set(compact('designers'));
        
        
        
        $qq = $this->Quotation->findById($quote_id);
        $this->set(compact('qq'));
        $count_floor_plan = $this->JrProduct->find('count',array(
            'conditions' => array('JrProduct.floor_plan_details !=' => NULL, 'JrProduct.job_request_id'=> $qq['Quotation']['job_request_id'])));
        $this->set(compact('count_floor_plan'));
    }
}
