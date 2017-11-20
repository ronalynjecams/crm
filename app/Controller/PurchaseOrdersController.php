<?php

App::uses('AppController', 'Controller');

/**
 * PurchaseOrders Controller
 *
 * @property PurchaseOrder $PurchaseOrder
 * @property PaginatorComponent $Paginator
 */
class PurchaseOrdersController extends AppController {

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
        $this->PurchaseOrder->recursive = 0;
        $this->set('purchaseOrders', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->PurchaseOrder->exists($id)) {
            throw new NotFoundException(__('Invalid purchase order'));
        }
        $options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
        $this->set('purchaseOrder', $this->PurchaseOrder->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PurchaseOrder->create();
            if ($this->PurchaseOrder->save($this->request->data)) {
                $this->Session->setFlash(__('The purchase order has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $suppliers = $this->PurchaseOrder->Supplier->find('list');
        $users = $this->PurchaseOrder->User->find('list');
        $this->set(compact('suppliers', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->PurchaseOrder->exists($id)) {
            throw new NotFoundException(__('Invalid purchase order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PurchaseOrder->save($this->request->data)) {
                $this->Session->setFlash(__('The purchase order has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
            $this->request->data = $this->PurchaseOrder->find('first', $options);
        }
        $suppliers = $this->PurchaseOrder->Supplier->find('list');
        $users = $this->PurchaseOrder->User->find('list');
        $this->set(compact('suppliers', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->PurchaseOrder->id = $id;
        if (!$this->PurchaseOrder->exists()) {
            throw new NotFoundException(__('Invalid purchase order'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PurchaseOrder->delete()) {
            $this->Session->setFlash(__('The purchase order has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The purchase order could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function quotation_view_supply() {
        
        $this->loadModel('Quotation');
        $id = $this->params['url']['id'];
        $quote_data = $this->Quotation->findById($id);
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));

        $this->set(compact('clients'));

        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products'));

        $this->loadModel('QuotationProduct');
         
        $this->QuotationProduct->recursive = 3;
        if ($this->Auth->user('role') != 'supply_staff') {
            $quote_products = $this->QuotationProduct->find('all', array(
                'conditions' => array('QuotationProduct.quotation_id' => $quote_data['Quotation']['id'])
            ));
        } else {
            $quote_products = $this->QuotationProduct->find('all', array(
                'conditions' => array(
                    'QuotationProduct.quotation_id' => $quote_data['Quotation']['id'],
                    'QuotationProduct.type' => array('supply', 'combination')
                )
            ));
            
            // pr($quote_products);
        }
        $this->set(compact('quote_products'));

        $this->set(compact('quote_number'));

//        $this->loadModel('Collection');
//        $collections = $this->Collection->find('all', array(
//            'conditions' => array('Collection.quotation_id' => $this->params['url']['id'],
//                'Collection.status' => 'verified')
//        ));
//        $this->set(compact('collections'));


        $this->loadModel('PoProduct');
        $this->PoProduct->recursive = 2;
        $poprod = $this->PoProduct->find('all', array(
            'conditions' => array(
                'PoProduct.quotation_id' => $this->params['url']['id'],
                'PoProduct.additional' => 0)
        ));
        $this->set(compact('poprod'));

        $this->loadModel('InvLocation');
        $locations = $this->InvLocation->find('all');
        $this->set(compact('locations'));

        $this->loadModel('DeliverySchedule');
        $DelScheds = $this->DeliverySchedule->find('all', ['conditions' => [
                'DeliverySchedule.quotation_id' => $this->params['url']['id']
        ]]);
        $this->set(compact('DelScheds'));

        $this->loadModel('CollectionPaper');
        $CollectPapers = $this->CollectionPaper->find('all', ['conditions' => [
                'CollectionPaper.quotation_id' => $this->params['url']['id'],
                'CollectionPaper.status' => 'onhand'
        ]]);
        $this->set(compact('CollectPapers'));

        $this->loadModel('CollectionSchedule');
        $CollectSched = $this->CollectionSchedule->find('first', ['conditions' => [
                'CollectionSchedule.quotation_id' => $this->params['url']['id'],
                'CollectionSchedule.status' => 'for_collection'
        ]]);
        $this->set(compact('CollectSched'));

        $this->loadModel('DeliveryPaper');
        $delivery_papers = $this->DeliveryPaper->findAllByQuotationId($id);


        $this->loadModel('DrPaper');
        $drpapers = $this->DrPaper->find('all');
        $this->set(compact('drpapers', 'delivery_papers'));
// pr($this->QuotationProduct->findById(62));
//        $this->loadModel('SupplierProduct');
//        $this->SupplierProduct->recursive=-1;
//        $product_supplier = $this->SupplierProduct->findAllByProductComboId(1);
//        pr($product_supplier);
//        $this->loadModel('PurchaseOrderProduct');
//        $this->loadModel('PurchaseOrder');
//        $this->loadModel('InventoryProduct');
//            pr($product_combo_properties);
        
//        $inv_products = $this->InventoryProduct->find('all', [
//                'conditions' => ['InventoryProduct.inv_location_id' => 4],
////                'fields' => ['MAX(PurchaseOrder.id) as po_id', 'PurchaseOrder.*']
//            ]);
//        pr($inv_products); 
    }

    /////////////////new codes as of 11-04-2017
    public function process_new_po() {
        $this->autoRender = false;
        $data = $this->request->data;
        $product_combo_id = $data['product_combo_id'];
        $product_id = $data['product_id'];
        $supplier_id = $data['supplier_id'];
        $quotation_product_id = $data['quote_product_id'];
        $qty = $data['po_qty'];
        $price = $data['list_price'];
        $additional = $data['additional'];
        $supplier_product_id = $data['supplier_product_id'];
        $inventory_job_order_type = $data['inventory_job_order_type'];

        
//        pr($inventory_job_order_type);exit;
        //check if with existing ongoing purchase order
        $check_po = $this->PurchaseOrder->find('first', [
            'conditions' => [
                'PurchaseOrder.supplier_id' => $supplier_id,
                'PurchaseOrder.status' => 'ongoing'
        ]]);
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        $this->loadModel('PurchaseOrderProduct');
        $this->loadModel('InventoryJobOrder');
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('TransactionSource');

        if ($quotation_product_id != 0 && (!empty($quotation_product_id))) {
            $qprod = $this->QuotationProduct->findById($quotation_product_id);
            $product_id = $qprod['QuotationProduct']['product_id'];
            $quotation_product_id = $qprod['QuotationProduct']['id'];
            $quotation_id = $qprod['Quotation']['id'];
            //get processed qty in quote product  
            $processed_qty = $qprod['QuotationProduct']['processed_qty'];
            $pro_qty = $processed_qty + $qty;
            $reference_num = $quotation_product_id;
            $reference_type = 'quotation';
            $transaction_num = $quotation_id;
        } else {
            $quotation_product_id = 0;
            $quotation_id = 0;
            $reference_num = 0;
            $reference_type = 'none';
            $transaction_num = 0;
        }



        if (count($check_po) == 0) {
            //create new purchase order
            if ($user['User']['department_id'] == 6) {
                $type = 'supply';
            } else if ($user['User']['department_id'] == 7) {
                $type = 'raw';
            }

            $dateToday = date("hmdsi");
            $po_number = 'JEC-' . $dateToday;

            $this->PurchaseOrder->create();
            $this->PurchaseOrder->set(array(
                'supplier_id' => $supplier_id,
                'user_id' => $this->Auth->user('id'),
                'po_number' => $po_number,
                'status' => 'ongoing',
                'type' => $type
            ));
            if ($this->PurchaseOrder->save()) {
                //add poProduct
                $po_id = $this->PurchaseOrder->getLastInsertID();
                //price of item should be from 
                $this->PurchaseOrderProduct->create();
                $this->PurchaseOrderProduct->set(array(
                    'product_combo_id' => $product_combo_id,
                    'purchase_order_id' => $po_id,
                    'qty' => $qty,
                    'list_price' => $price,
                    'user_id' => $this->Auth->user('id'),
                    'quotation_id' => $quotation_id,
                    'additional' => $additional,
                    'reference_num' => $reference_num,
                    'reference_type' => $reference_type,
                    'transaction_num' => $transaction_num,
                    'supplier_product_id' => $supplier_product_id
                ));
                if ($this->PurchaseOrderProduct->save()) {
                    $po_product_id = $this->PurchaseOrderProduct->getLastInsertID();
                }
            }
        } else {
            //get purchase order number then add the po product
            $po_id = $check_po['PurchaseOrder']['id'];
            $this->PurchaseOrderProduct->create();
            $this->PurchaseOrderProduct->set(array(
                'product_combo_id' => $product_combo_id,
                'purchase_order_id' => $po_id,
                'qty' => $qty,
                'list_price' => $price,
                'quotation_product_id' => $quotation_product_id,
                'user_id' => $this->Auth->user('id'),
                'quotation_id' => $quotation_id,
                'additional' => $additional,
                'reference_num' => $reference_num,
                'reference_type' => $reference_type,
                'transaction_num' => $transaction_num,
                'supplier_product_id' => $supplier_product_id
            ));
            if ($this->PurchaseOrderProduct->save()) {
                $po_product_id = $this->PurchaseOrderProduct->getLastInsertID();
            }
        }
        
        
        if ($quotation_product_id != 0 && (!empty($quotation_product_id))) {
                $dateToday = date("Y-m-d H:i:s");
            $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'status' => 'processed',
                'date_processed' => $dateToday
            ));
            $this->Quotation->save();

            $this->QuotationProduct->id = $quotation_product_id;
            $this->QuotationProduct->set(array(
                'processed_qty' => $pro_qty
            ));
            if($this->QuotationProduct->save()){ 
                $this->TransactionSource->create;
                $this->TransactionSource->set(array(
                    'reference_num'=>$quotation_id,
                    'reference_type'=>'quotation', 
                    'mode'=>'po',
                    'mode_num'=>$po_id,
                    'product_combo_id'=>$product_combo_id,
                    'product_source'=>$quotation_product_id,
                    'type'=>$qprod['Product']['type'], 
                )); 
                $this->TransactionSource->save();
            }
        }
         
            $this->InventoryJobOrder->create;
            $this->InventoryJobOrder->set(array(
                'product_combo_id'=>$product_combo_id,
                'qty'=>$qty,
                'processed_qty'=>0,
                'reference_num'=>$po_id,
                'reference_type'=>$inventory_job_order_type,
                'mode'=>'receive',
                'status'=>'newest'
            )); 
            if($this->InventoryJobOrder->save()){
                    echo json_encode($data); 
            } 
    }
    
    

    public function design_raw_mats() {
        $this->loadModel('QuotationProduct');
        $this->loadModel('JrProduct');
        $this->loadModel('Product');
        $id = $this->params['url']['id'];
        $this->JrProduct->recursive = 2;
        $qprod = $this->JrProduct->findById($id);
        $this->set(compact('qprod'));


        $this->loadModel('Product');
        $products = $this->Product->find('all', array(
            'conditions' => array('Product.type' => array('supply', 'customized', 'combination', 'raw'))
        ));
        $this->set(compact('products'));

        $this->loadModel('PoRawRequest');
//        $this->PoRawRequest->recursive = 2;
        $raws = $this->PoRawRequest->findAllByJrProductId($id);
        $this->set(compact('raws'));


//         pr($raws);
//       
//        error_reporting(0);
//        $this->loadModel('Quotation');
//        $id = $this->params['url']['id'];
//        $quote_data = $this->Quotation->findById($id);
//        $quote_number = $quote_data['Quotation']['quote_number'];
//        $this->set(compact('quote_data'));
//
//        $this->loadModel('Client');
//        $clients = $this->Client->find('all', array(
//            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
//        ));
//
//
//        $this->set(compact('clients'));
//
//        $this->loadModel('Product');
//        $products = $this->Product->find('all');
//        $this->set(compact('products'));
//
//        $this->loadModel('QuotationProduct');
//        $this->QuotationProduct->recursive = 3;
//        if ($this->Auth->user('role') != 'supply_staff') {
//            $quote_products = $this->QuotationProduct->find('all', array(
//                'conditions' => array('QuotationProduct.quotation_id' => $quote_data['Quotation']['id'])
//            ));
//        } else {
//            $quote_products = $this->QuotationProduct->find('all', array(
//                'conditions' => array(
//                    'QuotationProduct.quotation_id' => $quote_data['Quotation']['id'],
//                    'QuotationProduct.type' => array('supply', 'combination')
//                )
//            ));
//        }
//        $this->set(compact('quote_products'));
//
//        $this->set(compact('quote_number'));
//
//        $this->loadModel('Collection');
//        $collections = $this->Collection->find('all', array(
//            'conditions' => array('Collection.quotation_id' => $this->params['url']['id'],
//                'Collection.status' => 'verified')
//        ));
//        $this->set(compact('collections'));
//
//
//        $this->loadModel('PoProduct');
//        $this->PoProduct->recursive = 2;
//        $poprod = $this->PoProduct->find('all', array(
//            'conditions' => array(
//                'PoProduct.quotation_id' => $this->params['url']['id'],
//                'PoProduct.additional' => 0)
//        ));
//        $this->set(compact('poprod'));
//
//        $this->loadModel('InvLocation');
//        $locations = $this->InvLocation->find('all');
//        $this->set(compact('locations'));
//            pr($poprod);
//        $additional_products = $this->Product->find()
    }
    
    public function edit_inquired($id=null){
        $this->loadModel('QuotationProduct');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $quotation_product_id = $data['id'];
        
        $edit_TS = $this->QuotationProduct->getDataSource();
        $edit_TS->begin();
        
        $this->QuotationProduct->id = $quotation_product_id;
        
        $this->QuotationProduct->set(array(
            "inquired" => 1
        ));
        
        $edit_start = $this->QuotationProduct->save();
        if($edit_start){
            $edit_TS->commit();
            echo json_encode($quotation_product_id);
        }else{
            $edit_TS->rollback();
        }
        exit;
        
    }
    
    public function all_list(){
        
        $status = $this->params['url']['status'];

        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        if ($user['User']['department_id'] == 6) {
            $type = 'supply';
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
        }
        $pendings = $this->PurchaseOrder->find('all', array(
            'conditions' => array(
                'PurchaseOrder.status' => $status,
                'PurchaseOrder.type' => $type,
            )
        ));
        $this->set(compact('pendings', 'type'));
    }

}
