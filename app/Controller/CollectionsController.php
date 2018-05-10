<?php

App::uses('AppController', 'Controller');

/**
 * Collections Controller
 *
 * @property Collection $Collection
 * @property PaginatorComponent $Paginator
 */
class CollectionsController extends AppController {

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
        $this->Collection->recursive = 0;
        $this->set('collections', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Collection->exists($id)) {
            throw new NotFoundException(__('Invalid collection'));
        }
        $options = array('conditions' => array('Collection.' . $this->Collection->primaryKey => $id));
        $this->set('collection', $this->Collection->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Collection->create();
            if ($this->Collection->save($this->request->data)) {
                $this->Session->setFlash(__('The collection has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The collection could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $quotations = $this->Collection->Quotation->find('list');
        $users = $this->Collection->User->find('list');
        $banks = $this->Collection->Bank->find('list');
        $this->set(compact('quotations', 'users', 'banks'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Collection->exists($id)) {
            throw new NotFoundException(__('Invalid collection'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Collection->save($this->request->data)) {
                $this->Session->setFlash(__('The collection has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The collection could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Collection.' . $this->Collection->primaryKey => $id));
            $this->request->data = $this->Collection->find('first', $options);
        }
        $quotations = $this->Collection->Quotation->find('list');
        $users = $this->Collection->User->find('list');
        $banks = $this->Collection->Bank->find('list');
        $this->set(compact('quotations', 'users', 'banks'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Collection->id = $id;
        if (!$this->Collection->exists()) {
            throw new NotFoundException(__('Invalid collection'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Collection->delete()) {
            $this->Session->setFlash(__('The collection has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The collection could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function collect() {

        $id = $this->params['url']['id'];
        $this->loadModel('Bank');
        $this->loadModel('Quotation');
        $this->loadModel('QuotationTerm');
        $this->loadModel('AccountingPaper');
        $this->loadModel('CollectionPaper');
        $this->Quotation->recursive = 2;
        $quote_data = $this->Quotation->findById($id);
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));

//        pr($quote_data);
//        $collection_data = $this->Collection->findAllByQuotationId($id);
        $collection_data = $this->Collection->find('all', [
            'conditions' => ['Collection.quotation_id' => $id],
            'order' => 'Collection.status DESC'
        ]);



//        $collection_data = $this->Collection->find('all',['conditions'=>['Collection.status'=>'verified']]);
        $this->set(compact('collection_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));


        $banks = $this->Bank->find('all');
        $terms = $this->QuotationTerm->find('all', array(
            'conditions' => array('QuotationTerm.id >=' => 3)
        ));


        $papers = $this->AccountingPaper->find('all', ['conditions' => ['AccountingPaper.type !=' => 'soa']]);

        $collection_papers = $this->CollectionPaper->find('all', ['conditions' => [
                'CollectionPaper.quotation_id' => $id,
                'CollectionPaper.status !=' => 'deleted',
        ]]);
//         $this->loadModel('CollectionSchedule');
//                $collectionSched = $this->CollectionSchedule->find('first', ['conditions' => [
//                        'CollectionSchedule.quotation_id' => $id,
//                        'CollectionSchedule.status' => 'for_collection',
//                ]]);
//        pr($collectionSched['CollectionSchedule']['id']);
//        $this->loadModel('CollectionPaper');
//        $mypeps = $this->CollectionPaper->find('all',[
//            'conditions'=>[
//                'CollectionPaper.quotation_id'=>$id,
//                'AccountingPaper.type'=>'invoice',
//                'CollectionPaper.status'=>'onhand',
//                ]
//        ]);
//        pr($mypeps);
        $this->set(compact('clients', 'quote_number', 'banks', 'terms', 'id', 'papers', 'collection_papers'));

//        
//            $collections = $this->Collection->findAllByQuotationId($id);
//            $quote = $this->Quotation->findById($id);
//
//            $grand_total = $quote['Quotation']['grand_total'];
//            $total_collection = 0;
//            foreach ($collections as $collection) { 
//                if ($collection['Collection']['status'] == 'verified') {
//                    $total = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'];
//                    $total_collection = $total_collection + $total;
//                }
//            }
//            
//            pr($total_collection);
    }

    public function process_collect() {

        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $amount_paid = $data['amount_paid'];
        $payment_mode = $data['payment_mode'];
        $with_held = $data['with_held'];
        $other_amount = $data['other_amount'];
        $other_amount = $data['other_amount'];
        $bank_id = $data['bank_id'];
        $check_number = $data['check_number'];
        $check_date = $data['check_date'];
        $amount_paper = $data['amount_paper'];
        $ref_num = $data['ref_num'];
        $ref_date = $data['ref_date'];
        $accounting_paper = $data['accounting_paper'];
        $grand_total = $data['gtTotal'];
        $balance_amount = $data['balance_amount'];
        $TotalPaidAmount = $data['TotalPaidAmount'];

        $dateToday = date("Y-m-d H:i:s");

        if ($payment_mode == 'cash') {
            $bank_id = 0;
            $amount_paid = $data['amount_paid'];
            $with_held = $data['with_held'];
            $other_amount = $data['other_amount'];
            $check_number = 0;
            $check_date = NULL;

            $payment = $amount_paid + $with_held + $other_amount + $TotalPaidAmount;
            $half = $grand_total / 2;

            if ($payment == $half) {
                $type = 'partial';
            } else if ($payment < $half) {
                $type = 'initial';
            } else if ($payment > $half) {
                $type = 'dp';
            } else if ($payment == $grand_total) {
                $type = 'full';
            }
        } else if ($data['payment_mode'] == 'check') {
            $bank_id = $data['bank_id'];
            $amount_paid = $data['amount_paid'];
            $with_held = $data['with_held'];
            $other_amount = $data['other_amount'];
            $check_number = $data['check_number'];
            $check_date = $data['check_date'];

            $payment = $amount_paid + $with_held + $other_amount + $TotalPaidAmount;
            $half = $grand_total / 2;

            if ($payment == $half) {
                $type = 'partial';
            } else if ($payment < $half) {
                $type = 'initial';
            } else if ($payment > $half) {
                $type = 'dp';
            } else if ($payment == $grand_total) {
                $type = 'full';
            }
        } else if ($data['payment_mode'] == 'online') {
            $amount_paid = $data['amount_paid'];
            $bank_id = $data['bank_id'];
            $with_held = $data['with_held'];
            $other_amount = $data['other_amount'];
            $check_number = 0;
            $check_date = NULL;

            $payment = $amount_paid + $with_held + $other_amount + $TotalPaidAmount;
            $half = $grand_total / 2;

            if ($payment == $half) {
                $type = 'partial';
            } else if ($payment < $half) {
                $type = 'initial';
            } else if ($payment > $half) {
                $type = 'dp';
            } else if ($payment == $grand_total) {
                $type = 'full';
            }
        } else if ($data['payment_mode'] == 'documents') {

            if ($data['paperType'] == 'invoice' || $data['paperType'] == 'cr') {
                $type = 'none';
                $amount_paid = 0;
                $bank_id = 0;
                $with_held = 0;
                $check_number = 0;
                $check_date = NULL;
            } else {

                $payment = $amount_paper + $with_held + $TotalPaidAmount;
                if ($payment == $grand_total) {
                    $type = 'full';
                } else {
                    $type = 'collection';
                }


                $amount_paid = $amount_paper;
                $bank_id = 0;
                $with_held = 0;
                $check_number = 0;
                $check_date = NULL;
            }
        }


        $this->Collection->create();
        $this->Collection->set(array(
            'quotation_id' => $data['quotation_id'],
            'user_id' => $this->Auth->user('id'),
            'payment_mode' => $data['payment_mode'],
            'bank_id' => $bank_id,
            'amount_paid' => $amount_paid,
            'with_held' => $with_held,
            'other_amount' => $other_amount,
            'check_number' => $check_number,
            'check_date' => $check_date,
            'type' => $type,
            'status' => 'unverified',
        ));
        if ($this->Collection->save()) {
            $collection_id = $this->Collection->getLastInsertID();
            if ($data['payment_mode'] == 'documents') {
                if ($data['paperType'] == 'invoice' || $data['paperType'] == 'cr') {
                    $amount_paper = $data['amount_paper'];
                    $ref_num = $data['ref_num'];
                    $ref_date = date('Y-m-d', strtotime($data['ref_date']));
                    $accounting_paper = $data['accounting_paper'];
                } else {
                    $amount_paper = $data['amount_paper'];
                    $ref_num = NULL;
                    $ref_date = NULL;
                    $accounting_paper = $data['accounting_paper'];
                }

                $this->loadModel('CollectionPaper');

                $this->CollectionPaper->create();
                $this->CollectionPaper->set(array(
                    'ref_number' => $ref_num,
                    'ref_date' => $ref_date,
                    'amount' => $amount_paper,
                    'accounting_paper_id' => $accounting_paper,
                    'status' => 'pending',
                    'quotation_id' => $data['quotation_id'],
                    'user_id' => $this->Auth->user('id'),
                    'collection_id' => $collection_id,
                ));
                $this->CollectionPaper->save();
            }




// check if with pending collection schedule for this quotation to  if meron update to collected 
            $this->loadModel('CollectionSchedule');
            $collectionSched = $this->CollectionSchedule->find('first', ['conditions' => [
                    'CollectionSchedule.quotation_id' => $data['quotation_id'],
                    'CollectionSchedule.status' => 'for_collection',
            ]]);
            if ($collectionSched) {
                $this->CollectionSchedule->id = $collectionSched['CollectionSchedule']['id'];
                $this->CollectionSchedule->set(array(
                    'status' => 'collected',
                    'collection_id' => $collection_id,
                ));
                $this->CollectionSchedule->save();
            }

            if ($type == 'full') {
//                collection_status = paid
                $this->loadModel('Quotation');
                $this->Quotation->id = $data['quotation_id'];
                $this->Quotation->set([
                    'collection_status'=>'paid'
                    ]);
                $this->Quotation->save();
            }
            return (json_encode($data['payment_mode']));
        }
    }

    public function process_collectPaid() {

        $this->loadModel('CollectionPaper');
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $amount_paper = $data['amount_paper'];
        $ref_num = $data['ref_num'];
        $ref_date = $data['ref_date'];
        $accounting_paper = $data['accounting_paper'];
        $grand_total = $data['gtTotal'];
        $balance_amount = $data['balance_amount'];
        $TotalPaidAmount = $data['TotalPaidAmount'];

        $dateToday = date("Y-m-d H:i:s");

        if ($data['paperType'] == 'invoice' || $data['paperType'] == 'cr') {
            $amount_paper = $data['amount_paper'];
            $ref_num = $data['ref_num'];
            $ref_date = date('Y-m-d', strtotime($data['ref_date']));
            $accounting_paper = $data['accounting_paper'];
        } else {
            $amount_paper = $data['amount_paper'];
            $ref_num = NULL;
            $ref_date = NULL;
            $accounting_paper = $data['accounting_paper'];
        }

        $this->CollectionPaper->create();
        $this->CollectionPaper->set(array(
            'ref_number' => $ref_num,
            'ref_date' => $ref_date,
            'amount' => $amount_paper,
            'accounting_paper_id' => $accounting_paper,
            'status' => 'pending',
            'quotation_id' => $data['quotation_id'],
            'user_id' => $this->Auth->user('id'),
            'collection_id' => 0,
        ));
        if ($this->CollectionPaper->save()) {

            return (json_encode($data['quotation_id']));
        }
    }

    public function viodPayment() {

        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $this->loadModel('Quotation');
        $id = $data['id'];
        $status = $data['status'];
        $quotation_id = $data['quotation_id'];

        $this->Collection->id = $id;
        $this->Collection->set(array(
            'status' => $status
        ));
        if ($this->Collection->save()) {
            if ($status == 'verified') {

                $collections = $this->Collection->findAllByQuotationId($quotation_id);
                $quote = $this->Quotation->findById($quotation_id);
                $total_collection = 0;
                $grand_total = $quote['Quotation']['grand_total'];

                foreach ($collections as $collection) {
                    if ($collection['Collection']['status'] == 'verified') {
                        $total = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'];
                        $total_collection = $total_collection + $total;
                    }
                }
                $balance = $grand_total - $total_collection;
                $this->Quotation->id = $quotation_id;
                if ($balance >= 1) {
                    $this->Quotation->set(array(
                        'collection_status' => 'undelivered'
                    ));
                } else if ($balance <= 0) {
                    $this->Quotation->set(array(
                        'collection_status' => 'paid'
                    ));
                    
                }
                $this->Quotation->save();
            }

//            pr($total_collection);
            echo json_encode($data);
        }
    }

    public function accounting() {
        $status = $this->params['url']['status'];

//        if ($status == 'pending') {
//            
//        } else if ($status == 'for_collection') {
//            
//        } else if ($status == 'full') {
//            
//        }
        $this->loadModel('Quotation');
        $this->Quotation->recursive = 1;
        $collections = $this->Quotation->find('all', ['conditions' => [
                'Quotation.collection_status' => $status
        ]]);
        // pr($collections);
        
        $this->set(compact('collections'));
    }

    public function viodPaper() {

        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $this->loadModel('CollectionPaper');
        $this->loadModel('Quotation');
        $id = $data['id'];
        $status = $data['status'];


        $mypeps = $this->CollectionPaper->find('all', [
            'conditions' => [
                'CollectionPaper.quotation_id' => $data['quotation_id'],
                'AccountingPaper.type' => 'invoice',
                'CollectionPaper.status' => 'onhand',
            ]
        ]);
        $quote = $this->Quotation->findById($data['quotation_id']);

        $this->CollectionPaper->id = $id;
        $this->CollectionPaper->set(array(
            'status' => $status
        ));
        if ($this->CollectionPaper->save()) {

            $collection_paper_id = $this->CollectionPaper->getLastInsertID();
            if ($status == 'onhand' && $data['typepaper'] == 'invoice') {
//count     collection paper wherein type == invoice
//update collection_paper_id in quotations table 
                if ($quote['Quotation']['advance_invoice'] == 1) {
//                    if (empty($mypeps)) {
                    $this->loadModel('Quotation');
                    $this->Quotation->id = $data['quotation_id'];
                    $this->Quotation->set(array(
                        'collection_paper_id' => $collection_paper_id
                    ));
                    $this->Quotation->save();
//                    }
                }
            }
            echo json_encode($data);
        }
    }
    
    
    public function all_list(){
        $status = $this->params['url']['status'];
        $this->Collection->recursive = 2;
        $collections = $this->Collection->find('all',[
            'conditions'=>['Collection.status'=>$status],
            'fields'=>['Collection.*','Quotation.grand_total','Quotation.quote_number','Quotation.client_id','User.first_name','Bank.*']
            ]);
        
        // pr($collections);exit;
        
        $this->set(compact('collections'));
        
    }

}
