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
        $sched_products = $this->DeliverySchedProduct->find('all', [
            'conditions' => ['DeliverySchedProduct.delivery_schedule_id' => $delivery_sched_id,
                             'DeliverySchedProduct.deleted'=>null]
        ]);
        
        $this->DeliverySchedule->recursive = 2;
        $req = $this->DeliverySchedule->findById($delivery_sched_id);
        
        $vars = [];
        $propvaluevar = [];
        $existing_ids = [];
        
        // FROM QUOTATION
        if($req['DeliverySchedule']['reference_type'] == 'quotation'){
            foreach ($sched_products as $sched_product) {
                $prods = $this->QuotationProduct->findById($sched_product['DeliverySchedProduct']['reference_num']);
                $date_deleted = $prods['QuotationProduct']['deleted'];
                // if($date_deleted==null) {
                    $approved_qty=0;
                    $data = array_merge($vars, array(
                            "reference_type"=>$req['DeliverySchedule']['reference_type'],
                            "prod_image"=>$prods['Product']['image'],
                            "prod_name"=>$prods['Product']['name'], 
                            "requested_qty"=>$sched_product['DeliverySchedProduct']['requested_qty'],
                            "pullout_requested_qty"=>$sched_product['DeliverySchedProduct']['pullout_requested_qty'],
                            "pullout_approved_qty"=>0,
                            "actual_qty"=>$sched_product['DeliverySchedProduct']['actual_qty'],
                            "client_service_product_id"=>0,
                            "client_service_id"=>0,
                            "approved_qty"=>$approved_qty,
                            "status"=>$sched_product['DeliverySchedProduct']['status'],
                            "properties"=>$propvaluevar,
                            "other_info"=>$prods['QuotationProduct']['other_info'],
                            "dsproduct_id"=>$sched_product['DeliverySchedProduct']['id']
                        ));
                    $quote_prod_id = $prods['QuotationProduct']['id'];
                    
                    if(!in_array($quote_prod_id, $existing_ids)) {
                        $existing_ids[] = $quote_prod_id;
                        array_push($vars,$data);
                    }
                // }
            }
        } 
        // FROM CLIENT SERVICES
        else if($req['DeliverySchedule']['reference_type'] == 'client_services' ||
                $req['DeliverySchedule']['reference_type'] == 'pull_out') {
            foreach ($sched_products as $sched_product) {
                $this->loadModel('ClientServiceProduct');
                $getClientServiceProduct = $this->ClientServiceProduct->findById($sched_product['DeliverySchedProduct']['reference_num']);
                $ClientServiceProduct = $getClientServiceProduct['ClientServiceProduct'];
                $Product = $getClientServiceProduct['Product'];
                $image = "";
                if($Product['image']!="") {
                    $image = $Product['image'];
                }
                $prod_name="<font class='text-danger'>Unknown</font>";
                if($Product['name']!="") {
                    $prod_name = $Product['name'];
                }
                // insert if date_deleted == null validation
                $vars[] = ["reference_type"=>$req['DeliverySchedule']['reference_type'],
                           "prod_image"=>$image,
                           "prod_name"=>$prod_name,
                           "requested_qty"=>$sched_product['DeliverySchedProduct']['requested_qty'],
                           "pullout_requested_qty"=>$sched_product['DeliverySchedProduct']['pullout_requested_qty'],
                           "delivered_qty"=>$sched_product['DeliverySchedProduct']['delivered_qty'],
                           "actual_qty"=>$ClientServiceProduct['qty'],
                           "client_service_product_id"=>$ClientServiceProduct['id'],
                           "client_service_id"=>$ClientServiceProduct['client_service_id'],
                           "approved_qty"=>intval($ClientServiceProduct['approved_qty']),
                           "pullout_approved_qty"=>intval($ClientServiceProduct['pullout_approved_qty']),
                           "status"=>$sched_product['DeliverySchedProduct']['status'],
                           "properties"=>$propvaluevar,
                           "other_info"=>$ClientServiceProduct['other_info'],
                           "dsproduct_id"=>$sched_product['DeliverySchedProduct']['id']];
            }
        } 
        $this->set(compact('vars', 'req')); 
    }

    public function saveProductSched() {
        $this->autoRender = false;
        
        $this->loadModel('ClientServiceProduct');
        $this->loadModel('ClientServiceLog');
        $this->loadModel('ClientService');
        $this->loadModel('DeliverySchedule');
        
        $userin = $this->Auth->user('id');
        $data = $this->request->data;
        $delivery_sched_product_id = $data['delivery_sched_product_id'];
        $actual_qty = $data['process_qty'];
        $type = $data['type'];
        $demoprodid = $data['demoprodid'];
        $demo_pullout_approved_qty = $data['demo_pullout_approved_qty'];
        $demoapproved_qty = $data['demoapproved_qty'];
        $demoprodqty = $data['demoprodqty'];
        $demoid = $data['demoid'];
        $total_processed_qty = $demoapproved_qty+$actual_qty;
        $pullout_total_processed_qty = $demo_pullout_approved_qty+$actual_qty;
        $today = date("Y-m-d H:m:s");
        
        if($type=="pull_out") {
            $set_delivery_sched_product_1 = [
                'pullout_actual_qty' => $total_processed_qty,
                'status'=>'processed'];
        }
        else {
            $set_delivery_sched_product_1 = [
                'actual_qty' => $total_processed_qty,
                'status'=>'processed'];
        }
        
        $this->DeliverySchedProduct->id = $delivery_sched_product_id;
        $this->DeliverySchedProduct->set($set_delivery_sched_product_1);
        
        if ($this->DeliverySchedProduct->save()) {
            if($type=="client_services" || $type=="pull_out") {
                
                if($type=="pull_out") {
                    $set_cs = ['status'=>'pullout'];
                }
                else {
                    $set_cs = ['status'=>'processed', 'processed_by'=>$userin];
                }
                
                $getCS = $this->ClientService->findById($demoid, 'status');
                $CS_status = $getCS['ClientService']['status'];
                $this->ClientService->id = $demoid;
                $this->ClientService->set($set_cs);
                if($this->ClientService->save()) {
                    $this->ClientServiceProduct->id=$demoprodid;
                    if($type=="pull_out") {
                        $this->ClientServiceProduct->set(['pullout_approved_qty'=>$pullout_total_processed_qty,
                                                          'dr_requested'=>0,
                                                          'processed_date'=>$today,
                                                          'status'=>'pending']);
                    }
                    else {
                        $this->ClientServiceProduct->set(['approved_qty'=>$total_processed_qty,
                                                          'dr_requested'=>0,
                                                          'processed_date'=>$today,
                                                          'status'=>'processed']);
                    }
                    
                    if($this->ClientServiceProduct->save()) {
                        if($CS_status=="pending") {
                            $this->ClientServiceLog->create();
                            $this->ClientServiceLog->set(['client_service_id'=>$demoid,
                                                          'user_id'=>$userin,
                                                          'status'=>'processed']);
                            $this->ClientServiceLog->save();
                        }
                    }
                }
                
                if($type=="client_services") { 
                    // FOR DEMO
                    // do not include cancelled quotation product
                    $isProcessed = [];
                    $get_processed_cs_prods = $this->ClientServiceProduct->find('all',
                                              ['conditions'=>['client_service_id'=>$demoid,
                                                              'NOT'=>['ClientServiceProduct.status'=>['cancelled']]]]);
                    foreach($get_processed_cs_prods as $ret_processed_cs_prods) {
                        $ClientServiceProduct = $ret_processed_cs_prods['ClientServiceProduct'];
                        $qty = $ClientServiceProduct['qty'];
                        $approved_qty = $ClientServiceProduct['approved_qty'];
                        echo intval($qty)."=".intval($approved_qty);
                        if(intval($qty) > intval($approved_qty)) { $isProcessed[] = "no"; }
                        else { $isProcessed[] = "yes"; }
                    }
                    
                    if(in_array("no", $isProcessed)) {
                        echo "Not Processed. Do not Approve.";
                    }
                    else {
                        if($demoprodqty<=$total_processed_qty) {
                            foreach($get_processed_cs_prods as $ret_processed_cs_prods) {
                                $ClientServiceProduct = $ret_processed_cs_prods['ClientServiceProduct'];
                                $dpid = $ClientServiceProduct['id'];
                                $this->ClientServiceProduct->id=$dpid;
                                $this->ClientServiceProduct->set(['status'=>'approved',
                                                                  'processed_date'=>$today]);
                                $this->ClientServiceProduct->save();
                            }
                            $this->ClientService->id = $demoid;
                            $this->ClientService->set(['processed_by'=>$userin,
                                                       'status'=>'approved']);
                            if($this->ClientService->save()) {
                                $this->ClientServiceLog->create();
                                $this->ClientServiceLog->set(['client_service_id'=>$demoid,
                                                              'user_id'=>$userin,
                                                              'status'=>'approved']);
                                $this->ClientServiceLog->save();
                            }
                        }
                    }
                }
                elseif($type=="pull_out") {
                    $deliver_schedule_ids = [];
                    // FOR PULLOUT
                    // ===========================================================>
                    $isPulloutSuccessful = [];
                    $get_all_delivery_schedule = $this->DeliverySchedule->find('all',
                                              ['conditions'=>['reference_number'=>$demoid,
                                                              'reference_type'=>'pull_out'],
                                               'fields'=>['id']]);
                    
                    foreach($get_all_delivery_schedule as $ret_all_delivery_schedule) {
                        $DeliverySchedule = $ret_all_delivery_schedule['DeliverySchedule'];
                        $deliver_schedule_ids[] = $DeliverySchedule['id'];
                    }
                    
                    $get_delivery_schedule_product = $this->DeliverySchedProduct->find('all',
                                                      ['conditions'=>['delivery_schedule_id'=>$deliver_schedule_ids]]);
                    foreach($get_delivery_schedule_product as $ret_delivery_schedule_product) {
                        $delivered_qty = $ret_delivery_schedule_product['DeliverySchedProduct']['delivered_qty'];
                        $pullout_requested_by = $ret_delivery_schedule_product['DeliverySchedProduct']['pullout_actual_qty'];
                        if($delivered_qty>$pullout_requested_by) {
                            $isPulloutSuccessful[] = "yes";
                        }
                        else { $isPulloutSuccessful[] = "no"; }
                    }
                    
                    if(in_array("no", $isPulloutSuccessful)) {
                        echo "No! Don't pull out.";
                    }
                    else {
                        foreach($get_processed_cs_prods as $ret_processed_cs_prods) {
                            $ClientServiceProduct = $ret_processed_cs_prods['ClientServiceProduct'];
                            $dpid = $ClientServiceProduct['id'];
                            $this->ClientServiceProduct->id=$dpid;
                            $this->ClientServiceProduct->set(['status'=>'pullout_successful']);
                            $this->ClientServiceProduct->save();
                        }
                        $this->ClientService->id = $demoid;
                        $this->ClientService->set(['processed_by'=>$userin,
                                                   'status'=>'pullout_successful']);
                        if($this->ClientService->save()) {
                            $this->ClientServiceLog->create();
                            $this->ClientServiceLog->set(['client_service_id'=>$demoid,
                                                          'user_id'=>$userin,
                                                          'status'=>'pullout_successful']);
                            $this->ClientServiceLog->save();
                        }
                    }
                    // END OF PULL OUT
                    // ===========================================================>
                }
            }
        }
        
        return json_encode($data);
    }
    
    public function get_delivery_date_qty() {
        // GET DELIVERED DATE
        // GET DELIVERED QUANTITY
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $reference_product_number = $data['id'];
        $get_delivered_qty = $this->DeliverySchedProduct->findById($reference_product_number);
        $DeliverySchedules = $get_delivered_qty['DeliverySchedule'];
        $DeliverySchedProduct = $get_delivered_qty['DeliverySchedProduct'];
        $delivered_qty = $DeliverySchedProduct['delivered_qty'];
        $date_delivered_raw = $DeliverySchedules['delivery_date'];
        $date_delivered = date("Y-m-d H:m:s", strtotime($date_delivered_raw));
        
        $date_and_qty = ['delivered_qty'=>$delivered_qty,
                         'date_delivered'=>$date_delivered];
        return json_encode($date_and_qty);
    }
}
