<?php

App::uses('AppController', 'Controller');

/**
 * DeliverySchedProducts Controller
 *
 * @property DeliverySchedProduct $DeliverySchedProduct
 * @property PaginatorComponent $Paginator
 */
class DeliverySchedProductsController extends AppController {

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
        $this->DeliverySchedProduct->recursive = 0;
        $this->set('deliverySchedProducts', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DeliverySchedProduct->exists($id)) {
            throw new NotFoundException(__('Invalid delivery sched product'));
        }
        $options = array('conditions' => array('DeliverySchedProduct.' . $this->DeliverySchedProduct->primaryKey => $id));
        $this->set('deliverySchedProduct', $this->DeliverySchedProduct->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->DeliverySchedProduct->create();
            if ($this->DeliverySchedProduct->save($this->request->data)) {
                $this->Session->setFlash(__('The delivery sched product has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The delivery sched product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $deliverySchedules = $this->DeliverySchedProduct->DeliverySchedule->find('list');
        $quotationProducts = $this->DeliverySchedProduct->QuotationProduct->find('list');
        $this->set(compact('deliverySchedules', 'quotationProducts'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->DeliverySchedProduct->exists($id)) {
            throw new NotFoundException(__('Invalid delivery sched product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->DeliverySchedProduct->save($this->request->data)) {
                $this->Session->setFlash(__('The delivery sched product has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The delivery sched product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('DeliverySchedProduct.' . $this->DeliverySchedProduct->primaryKey => $id));
            $this->request->data = $this->DeliverySchedProduct->find('first', $options);
        }
        $deliverySchedules = $this->DeliverySchedProduct->DeliverySchedule->find('list');
        $quotationProducts = $this->DeliverySchedProduct->QuotationProduct->find('list');
        $this->set(compact('deliverySchedules', 'quotationProducts'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->DeliverySchedProduct->id = $id;
        if (!$this->DeliverySchedProduct->exists()) {
            throw new NotFoundException(__('Invalid delivery sched product'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->DeliverySchedProduct->delete()) {
            $this->Session->setFlash(__('The delivery sched product has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The delivery sched product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function process() {
        $this->loadModel('DeliverySchedule');
        $this->loadModel('QuotationProduct');
        $delivery_sched_id = $this->params['url']['id'];
        
        

        // $this->DeliverySchedProduct->recursive = 3;
        $sched_products = $this->DeliverySchedProduct->find('all', [
            'conditions' => ['DeliverySchedProduct.delivery_schedule_id' => $delivery_sched_id]
        ]);
        // pr($req);
        
        $this->DeliverySchedule->recursive = 2;
        $req = $this->DeliverySchedule->findById($delivery_sched_id);
        
        if($req['DeliverySchedule']['reference_type'] == 'quotation'){
            $vars = [];
            // $data = [];
            // $propvaluedata = [];
            $propvaluevar = [];
            foreach ($sched_products as $sched_product){
                $prods = $this->QuotationProduct->findById($sched_product['DeliverySchedProduct']['reference_num']);
                // pr($prods);exit;
                // foreach ($prods['QuotationProductProperty'] as $propvalue) {
                // //     $propvaluedata = array_merge($propvaluevar, array(
                // //             "prod_property"=>$propvalue['property'],
                // //             "prod_value"=>$propvalue['value'], 
                // //         )); 
                //      array_push($propvaluevar,$propvalue);  
                    
                // }
                
                
                
                $data = array_merge($vars, array(
                        "prod_image"=>$prods['Product']['image'],
                        "prod_name"=>$prods['Product']['name'], 
                        "requested_qty"=>$sched_product['DeliverySchedProduct']['requested_qty'],
                        "actual_qty"=>$sched_product['DeliverySchedProduct']['actual_qty'],
                        "status"=>$sched_product['DeliverySchedProduct']['status'],
                        "properties"=>$propvaluevar,
                        "other_info"=>$prods['QuotationProduct']['other_info'],
                        "dsproduct_id"=>$sched_product['DeliverySchedProduct']['id'],
                    ));
                     
                 array_push($vars,$data);  
            }
            
           
            
        } 
        $this->set(compact('vars', 'req')); 
    }

    public function saveProductSched() {
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $delivery_sched_product_id = $data['delivery_sched_product_id'];
        $actual_qty = $data['actual_qty'];
//        

        $this->DeliverySchedProduct->id = $delivery_sched_product_id;
        $this->DeliverySchedProduct->set(array(
            'actual_qty' => $actual_qty,
            'status'=>'processed'
        ));
        if ($this->DeliverySchedProduct->save()) {
            echo json_encode($data);
        }
    }

}
