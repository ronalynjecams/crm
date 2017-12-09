<?php

App::uses('AppController', 'Controller');

/**
 * DeliverySchedules Controller
 *
 * @property DeliverySchedule $DeliverySchedule
 * @property PaginatorComponent $Paginator
 */
class DeliverySchedulesController extends AppController {

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
        $this->DeliverySchedule->recursive = 0;
        $this->set('deliverySchedules', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DeliverySchedule->exists($id)) {
            throw new NotFoundException(__('Invalid delivery schedule'));
        }
        $options = array('conditions' => array('DeliverySchedule.' . $this->DeliverySchedule->primaryKey => $id));
        $this->set('deliverySchedule', $this->DeliverySchedule->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->DeliverySchedule->create();
            if ($this->DeliverySchedule->save($this->request->data)) {
                $this->Session->setFlash(__('The delivery schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The delivery schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $quotations = $this->DeliverySchedule->Quotation->find('list');
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
        if (!$this->DeliverySchedule->exists($id)) {
            throw new NotFoundException(__('Invalid delivery schedule'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->DeliverySchedule->save($this->request->data)) {
                $this->Session->setFlash(__('The delivery schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The delivery schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('DeliverySchedule.' . $this->DeliverySchedule->primaryKey => $id));
            $this->request->data = $this->DeliverySchedule->find('first', $options);
        }
        $quotations = $this->DeliverySchedule->Quotation->find('list');
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
        $this->DeliverySchedule->id = $id;
        if (!$this->DeliverySchedule->exists()) {
            throw new NotFoundException(__('Invalid delivery schedule'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->DeliverySchedule->delete()) {
            $this->Session->setFlash(__('The delivery schedule has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The delivery schedule could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function addSched() {
        $this->loadModel('DeliverySchedProduct');
        $this->loadModel('QuotationProduct');
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $delivery_date = $data['delivery_date'];
        $requested_qty = $data['requested_qty'];
        $product_reference = $data['product_reference'];
      //  $quotation_id = $data['quotation_id'];
        $delivery_time = $data['delivery_time'];
        $mode = $data['mode'];
        $reference_type = $data['reference_type'];
        $reference_number = $data['reference_number'];
        $deliver_to = $data['deliver_to'];
        $product_id = $data['product_id'];
        $client_id = $data['client_id'];
        $supplier_id = $data['supplier_id'];
        $shipping_address = $data['shipping_address'];
        $g_maps = $data['g_maps'];

        //check if there is an ongoing delivery schedule fot the quotation
        $check_sched = $this->DeliverySchedule->find('first', ['conditions' => [
                'DeliverySchedule.status' => 'ongoing',
                'DeliverySchedule.reference_number' => $reference_number,
                'DeliverySchedule.reference_type' => $reference_type, 
        ]]);
//        pr($check_sched);
        if (count($check_sched) != 0) {
            //add to delivery sched products only

            $this->DeliverySchedProduct->create();
            $this->DeliverySchedProduct->set(array(
                'delivery_schedule_id' => $check_sched['DeliverySchedule']['id'],
                'reference_num' => $product_reference,
                'status' => 'pending',
                'requested_qty' => $requested_qty,
                'product_id'=> $product_id,
                
            ));
            if ($this->DeliverySchedProduct->save()) {
                $dsp_id = $this->DeliverySchedule->getLastInsertID();
                if($reference_type == 'quotation'){ 
                    
                    
                    $this->QuotationProduct->id = $product_reference;
                    $this->QuotationProduct->set(array(
                        'dr_requested' => 1
                    ));
                    $this->QuotationProduct->save();
                    echo json_encode($dsp_id);
                    
                }
            }
        } else {
            //create new dr
            $dateToday = date("Hymds");
            $milliseconds = round(microtime(true) * 1000);
            $newstring = substr($milliseconds, -3);
            $dr_number = $newstring . '' . $dateToday;

            $dr_exist = $this->DeliverySchedule->find('count', array(
                'conditions' => array(
                    'DeliverySchedule.dr_number' => 'JEC-DR'.$dr_number
            )));

            if ($dr_exist == 0) {
                $dr_number = $dr_number;
            } else {
                $news = substr($milliseconds, -4);
                $dr_number = $news . '' . $dateToday;
            }
            //create new
            $this->DeliverySchedule->create();
            $this->DeliverySchedule->set(array(
                'dr_number' => 'JEC-DR'.$dr_number,
                'status' => 'ongoing',
                'delivery_date' => $delivery_date,
                'delivery_time' => $delivery_time,
                'requested_qty' => $requested_qty,
                'reference_number' => $reference_number,
                'reference_type' => $reference_type,
                'mode'=>$mode,
                'deliver_to' => $deliver_to,
                'user_id' => $this->Auth->user('id'),
                'client_id' => $client_id,
                'supplier_id' => $supplier_id,
                'shipping_address' => $shipping_address,
                'g_maps' => $g_maps,
            ));
            if ($this->DeliverySchedule->save()) {
                $ds_id = $this->DeliverySchedule->getLastInsertID();

                $this->DeliverySchedProduct->create();
                $this->DeliverySchedProduct->set(array(
                    'delivery_schedule_id' => $ds_id,
                    'reference_num' => $product_reference,
                    'status' => 'pending',
                    'requested_qty' => $requested_qty,
                    'product_id'=> $product_id
                ));
                if ($this->DeliverySchedProduct->save()) {
                    $dsp_id = $this->DeliverySchedule->getLastInsertID();

                    if($reference_type == 'quotation'){
                        $this->QuotationProduct->id = $product_reference;
                        $this->QuotationProduct->set(array(
                            'dr_requested' => 1
                        ));
                        $this->QuotationProduct->save();
                        echo json_encode($dsp_id);
                    }
                }
            }
        }
    }

    public function requests() {
        //pending, processed, delivered
        $this->loadModel('DeliverySchedProduct');
        $status = $this->params['url']['status'];
        $this->DeliverySchedule->recursive=2;
        
         
        if($status=='ongoing'){
             $requests = $this->DeliverySchedule->find('all', ['conditions' => ['DeliverySchedule.status' => [$status,'pending']]]);
        }else{
             $requests = $this->DeliverySchedule->find('all', ['conditions' => ['DeliverySchedule.status' => $status]]);
        }

        $arr = [];
        foreach ($requests as $req) {
            $delProds = $this->DeliverySchedProduct->find('all', ['conditions' => [
                    'DeliverySchedProduct.delivery_schedule_id' => $req['DeliverySchedule']['id'],
                    // 'DeliverySchedProduct.status' => $status,
            ]]);
            if (!empty(count($delProds))){ 
                array_push($arr, $req);
            }
        }
        
//        pr($arr);exit;
        
        $this->set(compact('arr','status'));
        
        
        
        
    }
    
    public function changeStatus(){ 
        $this->loadModel('DeliverySchedProduct');
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data; 
        
        $delivery_schedule_id = $data['delivery_schedule_id'];
        $status = $data['status'];
        // if($status == 'approved'){
            $approved = $this->Auth->user('id');
        // }else{
            // $approved = 0;
        // }
        //get current status 
        // $ds = $this->DeliverySchedule->findById($delivery_schedule_id);
         
        // if($ds['DeliverySchedule']['status']='pending'){
        //         $this->DeliverySchedProduct->recursive=-1;
        //         //check if all products has been processed, all unprocessed products will be cancelled
        //          $alldrsps =  $this->DeliverySchedProduct->find('all',[
        //              'conditions'=>[
        //                  'DeliverySchedProduct.delivery_schedule_id'=>$delivery_schedule_id 
        //                  ]]);
            
        //          $drsps = $this->DeliverySchedProduct->find('all',[
        //              'conditions'=>[
        //                  'DeliverySchedProduct.delivery_schedule_id'=>$delivery_schedule_id,
        //                  'DeliverySchedProduct.status'=>['pending', 'ongoing']
        //                  ]]);
                     
        //         if(count($alldrsps) == count($drsps)){
        //             //kapag my isa pa na hindi naiprocess hindi pwede maiapproved ang schedule
        //                 echo json_encode($data);
        //         }else{
        //             foreach($drsps as $drsp){
        //                  if($drsp['DeliverySchedProduct']['status'] == 'pending' || $drsp['DeliverySchedProduct']['status'] == 'ongoing'){
                             
        //                     $this->DeliverySchedProduct->id = $drsp['DeliverySchedProduct']['id'];
        //                     $this->DeliverySchedProduct->set(array(
        //                         'status' => 'unapproved', 
        //                     ));
        //                     $this->DeliverySchedProduct->save();
        //                  } 
        //             }
                    
                     
        //             $this->DeliverySchedule->id = $delivery_schedule_id;
        //             $this->DeliverySchedule->set(array(
        //                 'status' => $status,
        //                 'approved' => $approved
        //             ));
        //             if ($this->DeliverySchedule->save()) {
        //                 echo json_encode($data);
        //             }
        //         }
        //     } else{
        $this->DeliverySchedule->id = $delivery_schedule_id;
                    $this->DeliverySchedule->set(array(
                        'status' => $status,
                        'approved' => $approved
                    ));
                    if ($this->DeliverySchedule->save()) {
                        echo json_encode($data);
                    }
            // }
    }
    
    public function drs() {
        //pending, processed, delivered
        $this->loadModel('DeliverySchedProduct');
        // $status = $this->params['url']['status'];
        $this->DeliverySchedule->recursive=2;
        // if($status=='ongoing'){
        //      $requests = $this->DeliverySchedule->find('all', ['conditions' => ['DeliverySchedule.status' => [$status,'pending']]]);
        // }else{
             $requests = $this->DeliverySchedule->find('all', [
                 'conditions' => [
                     'DeliverySchedule.status !=' => ['ongoing','pending'],
                     'DeliverySchedule.reference_type'=>'quotation'
                     ]]);
        // }

        $arr = [];
        foreach ($requests as $req) {
            $delProds = $this->DeliverySchedProduct->find('all', ['conditions' => [
                    'DeliverySchedProduct.delivery_schedule_id' => $req['DeliverySchedule']['id'],
                    // 'DeliverySchedProduct.status' => 'pending',
            ]]);
            if (!empty(count($delProds))){ 
                array_push($arr, $req);
            }
        }
        
//        pr($arr);exit;
        
        $this->set(compact('arr','status'));
        
        
    }
    
    public function updateDeliveryAgentNote(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data; 
        
        $delivery_schedule_id = $data['delivery_schedule_id'];
        $agent_note = $data['agent_note'];
        
        
            $dateToday = date("Y-m-d H:i:s");
        $this->DeliverySchedule->id = $delivery_schedule_id;
        $this->DeliverySchedule->set(array(
            'agent_note' => $agent_note,
            'note_date' => $dateToday,
        ));
        if ($this->DeliverySchedule->save()) {
            echo json_encode($data);
        }
    }

}
