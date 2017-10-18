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
            'processed_by' => $this->Auth->user('id')
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

        $this->set(compact('iteneraries', 'status'));
    }

    public function process_update_departure() {
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $delivery_itenerary_id = $data['delivery_itenerary_id'];
        $departure_date = $data['departure_date'];
        $departure_time = $data['departure_time'];

        $combinedDT = date('Y-m-d H:i:s', strtotime("$departure_date $departure_time"));
//
        $this->DeliveryItenerary->id = $delivery_itenerary_id;
        $this->DeliveryItenerary->set(array(
            'departure' => $combinedDT
        ));
        if($this->DeliveryItenerary->save()){
                echo json_encode($delivery_itenerary_id);
        }
    }

}
