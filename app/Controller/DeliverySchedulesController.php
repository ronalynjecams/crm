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
        $delivered_qty = intval($data['delivered_qty']);
        $date_delivered = $data['date_delivered'];
        $delivery_date = $data['delivery_date'];
        $requested_qty = $data['requested_qty'];
        $product_reference = $data['product_reference'];
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
        if($reference_type=="client_services") {
            $type="demo";
        }
        elseif($reference_type=="pull_out") {
            $type="pull_out";
        }
        else { $type = "dr"; }
        
        // Check if there is an ongoing delivery schedule for QUOTATION
        $check_sched = $this->DeliverySchedule->find('first', ['conditions' => [
                'DeliverySchedule.status' => 'ongoing',
                'DeliverySchedule.reference_number' => $reference_number,
                'DeliverySchedule.reference_type' => $reference_type, 
        ]]);
        
        echo json_encode($check_sched);
        if (count($check_sched) != 0) {
            //add to delivery sched products only
            if($reference_type=="pull_out") {
                $deliverey_sched_product_set = ['delivery_schedule_id' => $check_sched['DeliverySchedule']['id'],
                                                'reference_num' => $product_reference,
                                                'status' => 'delivered',
                                                'pullout_requested_qty' => $requested_qty,
                                                'product_id'=> $product_id,
                                                'delivered_qty'=> $delivered_qty,
                                                'date_delivered'=>$date_delivered];
            }
            else {
                $deliverey_sched_product_set = ['delivery_schedule_id' => $check_sched['DeliverySchedule']['id'],
                                                'reference_num' => $product_reference,
                                                'status' => 'pending',
                                                'requested_qty' => $requested_qty,
                                                'product_id'=> $product_id];
            }
            echo json_encode($deliverey_sched_product_set);
            
            $this->DeliverySchedProduct->create();
            $this->DeliverySchedProduct->set($deliverey_sched_product_set);
            if ($this->DeliverySchedProduct->save()) {
                echo "DeliverySchedProduct save";
                $dsp_id = $this->DeliverySchedule->getLastInsertID();
                if($reference_type == 'quotation'){ 
                    $this->QuotationProduct->id = $product_reference;
                    $this->QuotationProduct->set(array(
                        'dr_requested' => 1
                    ));
                    $this->QuotationProduct->save();
                    echo json_encode($dsp_id);
                }
                else if($reference_type=="client_services" || $reference_type=="pull_out") {
                    $this->loadModel('ClientServiceProduct');
                    $this->ClientServiceProduct->id = $product_reference;
                    $this->ClientServiceProduct->set(['dr_requested'=>1]);
                    $this->ClientServiceProduct->save();
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
            if($reference_type=="client_services") {
                $delivery_schedule_set = array(
                    'dr_number' => 'JEC-DR'.$dr_number,
                    'status' => 'ongoing',
                    'delivery_date' => $delivery_date,
                    'delivery_time' => $delivery_time,
                    'requested_qty' => $requested_qty,
                    'reference_number' => $reference_number,
                    'reference_type' => $reference_type,
                    'type'=>'demo',
                    'mode'=>$mode,
                    'deliver_to' => $deliver_to,
                    'user_id' => $this->Auth->user('id'),
                    'client_id' => $client_id,
                    'supplier_id' => $supplier_id,
                    'shipping_address' => $shipping_address,
                    'g_maps' => $g_maps,
                );
            }
            else {
                $delivery_schedule_set = array(
                    'dr_number' => 'JEC-DR'.$dr_number,
                    'status' => 'ongoing',
                    'delivery_date' => $delivery_date,
                    'delivery_time' => $delivery_time,
                    'requested_qty' => $requested_qty,
                    'reference_number' => $reference_number,
                    'reference_type' => $reference_type,
                    'mode'=>$mode,
                    'type'=>$type,
                    'deliver_to' => $deliver_to,
                    'user_id' => $this->Auth->user('id'),
                    'client_id' => $client_id,
                    'supplier_id' => $supplier_id,
                    'shipping_address' => $shipping_address,
                    'g_maps' => $g_maps,
                );
            }
            
            $this->DeliverySchedule->create();
            $this->DeliverySchedule->set($delivery_schedule_set);
            if ($this->DeliverySchedule->save()) {
                echo "DeliverySchedule saved";
                $ds_id = $this->DeliverySchedule->getLastInsertID();

                if($reference_type=="pull_out") {
                    $del_sched_product_set = ['delivery_schedule_id' => $ds_id,
                                              'reference_num' => $product_reference,
                                              'status' => 'delivered',
                                              'pullout_requested_qty' => $requested_qty,
                                              'product_id'=> $product_id,
                                              'delivered_qty'=> $delivered_qty,
                                              'date_delivered'=>$date_delivered];
                }
                else {
                    $del_sched_product_set = ['delivery_schedule_id' => $ds_id,
                                              'reference_num' => $product_reference,
                                              'status' => 'pending',
                                              'requested_qty' => $requested_qty,
                                              'product_id'=> $product_id ];
                }
                                          
                $this->DeliverySchedProduct->create();
                $this->DeliverySchedProduct->set($del_sched_product_set);
                if ($this->DeliverySchedProduct->save()) {
                    $this->loadModel('ClientServiceProduct');
                    $this->ClientServiceProduct->id = $product_reference;
                    $this->ClientServiceProduct->set(['dr_requested'=>1]);
                    $this->ClientServiceProduct->save();
                }
            }
            else {
                echo "ERROR in DeliverySchedule";
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
        $this->DeliverySchedule->recursive=2;
        $requests = $this->DeliverySchedule->find('all', [
            'conditions' => [
                'DeliverySchedule.status !=' => ['ongoing','pending'],
                'DeliverySchedule.reference_type'=>'quotation']]);

        $arr = [];
        $quotations_grand_totals = [];
        foreach ($requests as $req) {
            $delivery_sched_id = $req['DeliverySchedule']['id'];
            $delProds = $this->DeliverySchedProduct->find('all', ['conditions' => [
                    'DeliverySchedProduct.delivery_schedule_id' => $delivery_sched_id,
            ]]);
            if (!empty(count($delProds))){ 
                array_push($arr, $req);
            }
            
            // GET GRAND TOTAL OF QUOTATIONS FROM DELIVERY SCHEDULE
            if($req['DeliverySchedule']['type']=="dr") {
                $quotation_id = $req['DeliverySchedule']['reference_number'];
                $this->Quotation->recursive = -1;
                $getQuotation = $this->Quotation->findById($quotation_id, ['id', 'grand_total']);
                foreach($getQuotation as $retQuotation) {
                    $quotations_grand_totals[$delivery_sched_id] = $retQuotation['grand_total'];
                }
            }
        }
        
        $this->set(compact('arr','status', 'quotations_grand_totals'));
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
    
    public function cancel_delivery_schedule() {
        $this->autoRender = false;
        $delivery_schedule_id = $this->request->data['delivery_schedule_id'];
        
        $DS_DeliverySchedule = $this->DeliverySchedule->getDataSource();
        $DS_DeliverySchedule->begin();
        
        $this->DeliverySchedule->id=$delivery_schedule_id;
        $this->DeliverySchedule->set(['status'=>'cancelled']);
        
        if($this->DeliverySchedule->save()) {
            echo json_encode('DeliverySchedule saved');
            $this->loadModel('DeliverySchedProduct');
            $DS_DeliverySchedProduct = $this->DeliverySchedProduct->getDataSource();
            $DS_DeliverySchedProduct->begin();
            $del_sched_product = $this->DeliverySchedProduct->findByDeliveryScheduleId($delivery_schedule_id);
            if(!empty($del_sched_product)) {
                $del_sched_product_id = $del_sched_product['DeliverySchedProduct']['id'];
                
                echo json_encode($del_sched_product_id);
                $this->DeliverySchedProduct->id = $del_sched_product_id;
                if($this->DeliverySchedProduct->delete()) {
                    echo json_encode("DeliverySchedProduct deleted");
                    $DS_DeliverySchedule->commit();
                    $DS_DeliverySchedProduct->commit();
                }
                else {
                    $DS_DeliverySchedule->rollback();
                    echo json_encode("Error in DeliverySchedProduct");
                }
            }
            else {
                $DS_DeliverySchedule->commit();
                $DS_DeliverySchedProduct->commit();
            }
        }
    }
    
    public function view() {
        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $type = $this->params['url']['type'];
        $dateToday = date('Y-m-d');

        if($user_role=="sales_executive") {
            if($type=='daily') {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                ['conditions'=>
                    ['delivery_date'=>$dateToday,
                     'user_id'=>$user_id]]);
            }
            else {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                    ['conditions'=>
                        ['user_id'=>$user_id]]);
            }
        }
        elseif($user_role=="sales_manager") {
            $this->loadModel('Team');
            $this->Team->recursive = -1;
            $team_id = 0;
            $team = $this->Team->findByTeamManager($user_id, ('id'));
            if(!empty($team['Team'])) {
                $team_id = $team['Team']['id'];
            }
            
            $this->loadModel('AgentStatus');
            $this->AgentStatus->recursive = -1;
            $agentStatuses = $this->AgentStatus->find('all', 
                ['fields'=>['user_id','team_id']]);

            $userid_topass = [];
            $user_team_obj = [];
            $user_obj = [];
            $team_obj = [];
            foreach($agentStatuses as $i=>$ret_agentStatuses) {
                $agentStatus = $ret_agentStatuses['AgentStatus'];
                $ret_userid = $agentStatus['user_id'];
                $ret_teamid = $agentStatus['team_id']; 

                $user_obj[] = $ret_userid;
                $team_obj[] = $ret_teamid;
            }
            $unique_userid = array_unique($user_obj);
            $user_team_obj = array_combine($user_obj, $team_obj);

            foreach($user_team_obj as $userid_topass_tmp=>$each_user_team) {
                $teamid = $each_user_team;
                if($teamid == $team_id) {
                    $userid_topass[] = $userid_topass_tmp;
                }
            }

            if($type=='daily') {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                    ['conditions'=>
                        ['delivery_date'=>$dateToday,
                         'user_id'=>$userid_topass]]);
            }
            else {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                    ['conditions'=>
                        ['user_id'=>$userid_topass]]);
            }
        }
        elseif($user_role=="proprietor") {
            $this->loadModel('AgentStatus');
            $this->AgentStatus->recursive = -1;
            $agentStatuses = $this->AgentStatus->find('all', 
                ['fields'=>['user_id']]);

            $user_obj = [];
            foreach($agentStatuses as $i=>$ret_agentStatuses) {
                $agentStatus = $ret_agentStatuses['AgentStatus'];
                $ret_userid = $agentStatus['user_id']; 

                $user_obj[] = $ret_userid;
            }
            $unique_userid = array_unique($user_obj);

            if($type=='daily') {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                    ['conditions'=>
                        ['delivery_date'=>$dateToday,
                         'user_id'=>$unique_userid]]);
            }
            else {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                    ['conditions'=>
                        ['user_id'=>$unique_userid]]);
            }
        }
        elseif($user_role=="logistics_head") {
            if($type=='daily') {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                ['conditions'=>
                    ['delivery_date'=>$dateToday,
                     'status'=>'pending']]);
            }
            else {
                $deliverySchedules = $this->DeliverySchedule->find('all',
                    ['conditions'=>
                        ['status'=>'pending']]);
            }
        }
        else {
            $deliverySchedules = [];
        }

        $this->set(compact('type','deliverySchedules','user_role'));
    }
}