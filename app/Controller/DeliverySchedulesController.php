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
        $quotation_product_id = $data['quotation_product_id'];
        $quotation_id = $data['quotation_id'];
        $delivery_time = $data['delivery_time'];

        //check if there is an ongoing delivery schedule fot the quotation
        $check_sched = $this->DeliverySchedule->find('first', ['conditions' => [
                'DeliverySchedule.status' => 'ongoing',
                'DeliverySchedule.quotation_id' => $quotation_id,
        ]]);
//        pr($check_sched);
        if (count($check_sched) != 0) {
            //add to delivery sched products only
            
                $this->DeliverySchedProduct->create();
                $this->DeliverySchedProduct->set(array(
                    'delivery_schedule_id' => $check_sched['DeliverySchedule']['id'],
                    'quotation_product_id' => $quotation_product_id,
                    'status' => 'pending',
                    'requested_qty' => $requested_qty,
                ));
                if ($this->DeliverySchedProduct->save()) { 
                $dsp_id = $this->DeliverySchedule->getLastInsertID();
                    $this->QuotationProduct->id = $quotation_product_id;
                    $this->QuotationProduct->set(array(
                        'dr_requested' => 1
                    ));
                    $this->QuotationProduct->save();
                    echo json_encode($dsp_id);
                }
        } else {
            //create new dr
            $dateToday = date("Hymds");
            $milliseconds = round(microtime(true) * 1000);
            $newstring = substr($milliseconds, -3);
            $dr_number = $newstring . '' . $dateToday;

            $dr_exist = $this->DeliverySchedule->find('count', array(
                'conditions' => array(
                    'DeliverySchedule.dr_number' => $dr_number
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
                'dr_number' => $dr_number,
                'status' => 'ongoing',
                'delivery_date' => $delivery_date,
                'delivery_time' => $delivery_time,
                'requested_qty' => $requested_qty,
                'quotation_id' => $quotation_id
            ));
            if ($this->DeliverySchedule->save()) {
                $ds_id = $this->DeliverySchedule->getLastInsertID();

                $this->DeliverySchedProduct->create();
                $this->DeliverySchedProduct->set(array(
                    'delivery_schedule_id' => $ds_id,
                    'quotation_product_id' => $quotation_product_id,
                    'status' => 'pending',
                    'requested_qty' => $requested_qty,
                ));
                if ($this->DeliverySchedProduct->save()) { 
                $dsp_id = $this->DeliverySchedule->getLastInsertID();
                
                    $this->QuotationProduct->id = $quotation_product_id;
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
