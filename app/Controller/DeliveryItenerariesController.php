<?php

App::uses('AppController', 'Controller');

/**
 * DeliveryIteneraries Controller
 *
 * @property DeliveryItenerary $DeliveryItenerary
 * @property PaginatorComponent $Paginator
 */
class DeliveryItenerariesController extends AppController {

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
        $this->DeliveryItenerary->recursive = 0;
        $this->set('deliveryIteneraries', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DeliveryItenerary->exists($id)) {
            throw new NotFoundException(__('Invalid delivery itenerary'));
        }
        $options = array('conditions' => array('DeliveryItenerary.' . $this->DeliveryItenerary->primaryKey => $id));
        $this->set('deliveryItenerary', $this->DeliveryItenerary->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->DeliveryItenerary->create();
            if ($this->DeliveryItenerary->save($this->request->data)) {
                $this->Session->setFlash(__('The delivery itenerary has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The delivery itenerary could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $deliverySchedules = $this->DeliveryItenerary->DeliverySchedule->find('list');
        $vehicles = $this->DeliveryItenerary->Vehicle->find('list');
        $clients = $this->DeliveryItenerary->Client->find('list');
        $this->set(compact('deliverySchedules', 'vehicles', 'clients'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->DeliveryItenerary->exists($id)) {
            throw new NotFoundException(__('Invalid delivery itenerary'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->DeliveryItenerary->save($this->request->data)) {
                $this->Session->setFlash(__('The delivery itenerary has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The delivery itenerary could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('DeliveryItenerary.' . $this->DeliveryItenerary->primaryKey => $id));
            $this->request->data = $this->DeliveryItenerary->find('first', $options);
        }
        $deliverySchedules = $this->DeliveryItenerary->DeliverySchedule->find('list');
        $vehicles = $this->DeliveryItenerary->Vehicle->find('list');
        $clients = $this->DeliveryItenerary->Client->find('list');
        $this->set(compact('deliverySchedules', 'vehicles', 'clients'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->DeliveryItenerary->id = $id;
        if (!$this->DeliveryItenerary->exists()) {
            throw new NotFoundException(__('Invalid delivery itenerary'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->DeliveryItenerary->delete()) {
            $this->Session->setFlash(__('The delivery itenerary has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The delivery itenerary could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function new_itenerary() {
        $this->loadModel('DeliverySchedule');
        $this->loadModel('Vehicle');
        $this->DeliverySchedule->recursive = 2;
        $type = $this->params['url']['type'];
        $delivery_schedule_id = $this->params['url']['id'];

        $delivery_schedule = $this->DeliverySchedule->findById($delivery_schedule_id);
//        pr($delivery_schedule['Quotation']['User']);
        $vehicles = $this->Vehicle->find('all', ['conditions' => ['Vehicle.type' => 'jecams']]);

        $installers = $this->User->find('all');
        $this->set(compact('type', 'delivery_schedule', 'vehicles', 'installers'));
    }

    public function addItenerary() {
        $this->loadModel('DeliverySchedule');
        $this->loadModel('DeliveryInstaller');
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $typo = $data['typo'];
        $vehicle_id = $data['vehicle_id'];
        $driver_id = $data['driver_id'];
        $pickup_date = $data['pickup_date'];
        $pickup_time = $data['pickup_time'];
        $people = $data['people'];
        $client_id = $data['client_id'];
        $expected_start_date = $data['expected_start_date'];
        $expected_start_time = $data['expected_start_time'];
        $client_id = $data['client_id'];
        $delivery_schedule_id = $data['delivery_schedule_id'];
        $del_type = $data['del_type'];
        $shipping_address = $data['shipping_address'];
        $g_maps = $data['g_maps'];
        ///merge expected start date and time 

        $combinedDT = date('Y-m-d H:i:s', strtotime("$expected_start_date $expected_start_time"));
//         pr($combinedDT);
        $this->DeliveryItenerary->create();
        $this->DeliveryItenerary->set(array(
            'delivery_schedule_id' => $delivery_schedule_id,
            'vehicle_id' => $vehicle_id,
            'driver' => $driver_id,
            'expected_start' => $combinedDT,
            'delivery_mode' => $typo,
            'type' => $del_type,
            'status' => 'scheduled',
            'client_id' => $client_id,
            'shipping_address' => $shipping_address,
            'g_maps' => $g_maps,
            'processed_by' => $this->Auth->user('id'),
            
        ));
        if ($this->DeliveryItenerary->save()) {
            $delivery_itenerary_id = $this->DeliveryItenerary->getLastInsertID();
            $ctr = count($people);
            for ($i = 0; $i < $ctr; $i++) {
                $this->DeliveryInstaller->create();
                $this->DeliveryInstaller->set(array(
                    'delivery_itenerary_id' => $delivery_itenerary_id,
                    'user_id' => $people[$i]
                ));
                $this->DeliveryInstaller->save();
            }

//            //also update delivery schedule
            $this->DeliverySchedule->id = $delivery_schedule_id;
            $this->DeliverySchedule->set(array(
                'status' => 'scheduled'
            ));
            if ($this->DeliverySchedule->save()) {

                echo json_encode($delivery_schedule_id);
            }
        }
        exit;
    }

    public function list_view() {
        
        $status = $this->params['url']['status'];
        $iteneraries = $this->DeliveryItenerary->find('all', ['conditions' => ['DeliveryItenerary.status' => $status]]);
// pr($iteneraries);
        $this->loadModel("Vehicle");
        $this->Vehicle->recursive = -1;
        $vehicles = $this->Vehicle->find('all');
        $this->loadModel("User");
        $this->User->recursive = -1;
        $users = $this->User->find('all');
        $this->set(compact('iteneraries', 'status', 'vehicles', 'users'));
        
        // $this->loadModel('DeliverySchedProduct');
        //  $drpeods = $this->DeliverySchedProduct->findAllByDeliveryScheduleId(14);
        //  pr($drpeods);
    }

    public function process_update_departure() {
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $delivery_itenerary_id = $data['delivery_itenerary_id'];
        $departure_date = $data['departure_date'];
        $departure_time = $data['departure_time'];

        $combinedDT = date('Y-m-d H:i:s', strtotime("$departure_date $departure_time"));
        
        
        $this->DeliveryItenerary->id = $delivery_itenerary_id;
        $this->DeliveryItenerary->set(array(
            'departure' => $combinedDT
        ));
        if($this->DeliveryItenerary->save()){
                echo json_encode($delivery_itenerary_id);
        }
    }
    
        public function process_update_start() {
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $actual_id = $data['actual_id'];
        $actual_date = $data['actual_date'];
        $actual_time = $data['actual_time'];
        $status = "ongoing";
        

        $combined_DT = date('Y-m-d H:i:s', strtotime("$actual_date $actual_time"));
        
        $this->DeliveryItenerary->id = $actual_id;
        
        $this->DeliveryItenerary->set(array(
            "actual_start" => $combined_DT,
            "status" => $status
        ));
        if($this->DeliveryItenerary->save()){
                echo json_encode($actual_id);
        }
        exit;
    }
    
        public function process_update_end() {
            $this->loadModel('DeliverySchedule');
            $this->loadModel('DeliverySchedProduct');
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $end_id = $data['end_id'];
        $end_date = $data['end_date'];
        $end_time = $data['end_time'];
        $status = $data['status'];
        $remarks = $data['remarks'];
        

        $DIinfo = $this->DeliveryItenerary->findById($end_id);
        
        $combined_EDT = date('Y-m-d H:i:s', strtotime("$end_date $end_time"));
        
        $this->DeliveryItenerary->id = $end_id;
        
        $this->DeliveryItenerary->set(array(
            "end_work" => $combined_EDT,
            "status" => $status,
            "remarks" => $remarks
        ));
        
        if($this->DeliveryItenerary->save()){
            $this->DeliverySchedule->id = $DIinfo['DeliveryItenerary']['delivery_schedule_id'];
            if($status == 'delivered'){
            $this->DeliverySchedule->set(array(
                        'status' => 'delivered', 
                    ));
                    if ($this->DeliverySchedule->save()) {
                        
                        //kapag galing quotation
                        if($DIinfo['DeliveryItenerary']['type']=='dr'){
                            
                        $this->loadModel('DeliverySchedProduct');
                        $this->loadModel('QuotationProduct');
                        $drpeods = $this->DeliverySchedProduct->findAllByDeliveryScheduleId($DIinfo['DeliveryItenerary']['delivery_schedule_id']);
                       
                        foreach($drpeods as $drpeod){
                             pr($drpeod['DeliverySchedProduct']['id']);
                            if($drpeod['DeliverySchedProduct']['actual_qty'] !=0 ){
                            $this->DeliverySchedProduct->id = $drpeod['DeliverySchedProduct']['id'];
                            $this->DeliverySchedProduct->set(array(
                                'delivered_qty' => $drpeod['DeliverySchedProduct']['actual_qty']
                                ));
                            $this->DeliverySchedProduct->save();
                            
                            //update quotation product
                            
                            $this->QuotationProduct->id = $drpeod['DeliverySchedProduct']['reference_num'];
                            $this->QuotationProduct->set(array(
                                'delivered_qty' => $drpeod['DeliverySchedProduct']['actual_qty'],
                                'dr_requested' => 0
                                ));
                            
                            $this->QuotationProduct->save();
                            }
                        }
                        
                            //update quotation product based on delivered quantity from delivery sched product delivered_qty
                            //as of now kung ano ang actual qty yun na muna ang delivered qty
                              
                        }
                    } 
            }
                // echo json_encode($end_id);
        }
        exit;
    }
    
    public function process_update_vehicle(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $vehicle = $data['vehicle'];
        $del_itenerary_id = $data['del_itenerary_id'];
        
        $this->DeliveryItenerary->id = $del_itenerary_id;
        $this->DeliveryItenerary->set(array('vehicle_id' => $vehicle));
        if($this->DeliveryItenerary->save()){
            return json_encode('success');
        } else {
            return json_encode('error');
        }
        
        exit;
        
    }
    
    public function process_update_driver(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $driver = $data['driver'];
        $del_itenerary_id = $data['del_itenerary_id'];
        
        $this->DeliveryItenerary->id = $del_itenerary_id;
        $this->DeliveryItenerary->set(array('driver' => $driver));
        if($this->DeliveryItenerary->save()){
            return json_encode('success');
        } else {
            return json_encode('error');
        }
        
        exit;
        
    }
    
    public function process_update_bookingcode(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $booking_code = $data['booking_code'];
        $del_itenerary_id = $data['del_itenerary_id'];
        
        $this->DeliveryItenerary->id = $del_itenerary_id;
        $this->DeliveryItenerary->set(array('booking_code' => $booking_code));
        if($this->DeliveryItenerary->save()){
            return json_encode('success');
        } else {
            return json_encode('error');
        }
        
        exit;
        
    }

    public function import(){
	
	print("asfd");	 
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                   
    			$csvFile = fopen($_FILES['file']['tmp_name'], 'r'); 
    			$stat = $this->request->data['status'];
    			$matrix = array();
    			while (($row = fgetcsv($csvFile, 1000, ",")) !== FALSE) 
    			{
    			$matrix[] = $row;
    			}
    			           
    // 			pr($matrix);  exit;          
    			$matrix_count = count($matrix) - 1;
    			 
    			for($i=1; $i<=$matrix_count; $i++){ 
    			    $ctr = 0; 
    				$booking_code = $matrix[$i][0];
    				$amount = floatval($matrix[$i][8]);
    				$arrival = $matrix[$i][1];
    				$status = $matrix[$i][9];
    				
    				$this->DeliveryItenerary->recursive = -1;
    				$di = $this->DeliveryItenerary->findByBookingCode($booking_code);
    				
    				if($di && $status == 'Delivery Completed'){
    				    // pr($di); 
    				    $this->DeliveryItenerary->id = $di['DeliveryItenerary']['id'];
    				    $this->DeliveryItenerary->set(array('ammount' => $amount, 'arrival' => $arrival));
    				    $this->DeliveryItenerary->save();
    				}
                }
                fclose($csvFile);
                $qstring = '?status=succ';
                // $this->Session->setFlash(__('Import completed.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect('/delivery_iteneraries/list_view?status='.$stat);
                // return $this->redirect(array('action' => 'list_view'));
            }else{
                $qstring = '?status=err';
            }
        } else{
            echo "error";
            $qstring = '?status=invalid_file';
        } 
        exit;
	}

}
