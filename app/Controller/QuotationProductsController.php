<?php

App::uses('AppController', 'Controller');

/**
 * QuotationProducts Controller
 *
 * @property QuotationProduct $QuotationProduct
 * @property PaginatorComponent $Paginator
 */
class QuotationProductsController extends AppController {

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
        $this->QuotationProduct->recursive = 0;
        $this->set('quotationProducts', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->QuotationProduct->exists($id)) {
            throw new NotFoundException(__('Invalid quotation product'));
        }
        $options = array('conditions' => array('QuotationProduct.' . $this->QuotationProduct->primaryKey => $id));
        $this->set('quotationProduct', $this->QuotationProduct->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->QuotationProduct->create();
            if ($this->QuotationProduct->save($this->request->data)) {
                $this->Session->setFlash(__('The quotation product has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The quotation product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $quotations = $this->QuotationProduct->Quotation->find('list');
        $products = $this->QuotationProduct->Product->find('list');
        $this->set(compact('quotations', 'products'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->QuotationProduct->exists($id)) {
            throw new NotFoundException(__('Invalid quotation product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->QuotationProduct->save($this->request->data)) {
                $this->Session->setFlash(__('The quotation product has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The quotation product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('QuotationProduct.' . $this->QuotationProduct->primaryKey => $id));
            $this->request->data = $this->QuotationProduct->find('first', $options);
        }
        $quotations = $this->QuotationProduct->Quotation->find('list');
        $products = $this->QuotationProduct->Product->find('list');
        $this->set(compact('quotations', 'products'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete() {

        $this->autoRender = false;
        $data = $this->request->data;
        $id = $data['id'];
        $this->loadModel('JrProduct');
        $this->loadModel('JobRequest');
        $this->loadModel('Quotation');

        $jr_prod = $this->JrProduct->find('first', array('conditions' => array('JrProduct.quotation_product_id' => $id)));
        $check_jr_products = $this->JrProduct->find('all', array(
            'conditions' => array('JrProduct.job_request_id' => $jr_prod['JrProduct']['job_request_id'])));

        $quote_det = $this->QuotationProduct->findById($id);
        if (count($check_jr_products) == 1) {
            $this->Quotation->id = $quote_det['QuotationProduct']['quotation_id'];
            $this->Quotation->set(array('job_request_id' => 0));
            $this->Quotation->save();


            $this->JobRequest->id = $jr_prod['JrProduct']['job_request_id'];
            $this->JobRequest->delete();
        }
        if (count($jr_prod) != 0) {
            $this->JrProduct->id = $jr_prod['JrProduct']['id'];
            $this->JrProduct->delete();
        }

        //if 1 lang ang product sa job request na yun automatic cancelled na status ng jobrequest
        $this->QuotationProduct->id = $id;
//		if (!$this->QuotationProduct->exists()) {
//			throw new NotFoundException(__('Invalid quotation product'));
//		}
//        $this->request->onlyAllow('post', 'delete');
        if ($this->QuotationProduct->delete()) {
            echo json_encode($id);
//			$this->Session->setFlash(__('The quotation product has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            echo json_encode($id);
//			$this->Session->setFlash(__('The quotation product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        echo json_encode($id);
//		return $this->redirect(array('action' => 'index'));
    }

    public function add_quote_product() {
        $this->autoRender = false;
        $c = ["1", "2"];
        if (!is_null($c)) {
            foreach ($c as $key => $property_id) {
                pr($property_id);
            }
        } else {
            pr('asd');
        }
    }

    public function saveProductQuotation() {

        $this->autoRender = false;
        $data = $this->request->data;


        $quotation_id = $data['quotation_id'];
        $product_id = $data['product_id'];
        $image = $data['image'];
        $qty = $data['qty'];
        $price = $data['price'];
        $type = $data['type'];
        $other_info = $data['other_info'];
        $edited_amount = $data['edited_amount'];
        $sale = $data['sale'];

        $total = $qty * $edited_amount;

        $dif = $price - $edited_amount;
        if ($edited_amount > $price) {
            $discount = 0;
            $additional = $dif;
        } else if ($edited_amount < $price) {
            $discount = $dif;
            $additional = 0;
        } else {
            $discount = 0;
            $additional = 0;
        }

        $this->QuotationProduct->create();
        $this->QuotationProduct->set(array(
            "quotation_id" => $quotation_id,
            "product_id" => $product_id,
            "image" => $image,
            "qty" => $qty,
            "price" => $price,
            "other_info" => $other_info,
            "edited_amount" => $edited_amount,
            "sale" => $sale,
            "total" => $total,
            "discount" => $discount,
            "additional" => $additional,
            "type" => $type
        ));
        if ($this->QuotationProduct->save()) {

            $this->loadModel('QuotationProductProperty');
            $quotation_product_id = $this->QuotationProduct->getLastInsertID();

            if (count(@$data['obj']) != 0) {
                foreach ($data['obj'] as $key => $value) {
                    $this->QuotationProductProperty->create();
                    $this->QuotationProductProperty->set(array(
                        "quotation_product_id" => $quotation_product_id
                    ));
                    $this->QuotationProductProperty->save();

                    $qpp_id = $this->QuotationProductProperty->getLastInsertID();

                    $this->QuotationProductProperty->id = $qpp_id;
                    $this->QuotationProductProperty->set(array(
                        "property" => $key,
                        "value" => $value
                    ));
                    $this->QuotationProductProperty->save();
                }
            }

            if (count(@$data['obj_ids']) != 0) {
                foreach ($data['obj_ids'] as $key => $value) {
                    $this->QuotationProductProperty->create();
                    $this->QuotationProductProperty->set(array(
                        "quotation_product_id" => $quotation_product_id
                    ));
                    $this->QuotationProductProperty->save();

                    $qpp_id = $this->QuotationProductProperty->getLastInsertID();

                    $this->QuotationProductProperty->id = $qpp_id;
                    $this->QuotationProductProperty->set(array(
                        "product_property_id" => $key,
                        "product_value_id" => $value
                    ));
                    $this->QuotationProductProperty->save();
                }
            }

            echo json_encode($data);
        }
    }

    public function quoted_product_warehouse_source() {
        $this->autoRender = false; 
        header("Content-type:application/json");
        $data = $this->request->data;
 
        $this->loadModel('ProductSource');
        $this->loadModel('ProductSourceProperty');
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation'); 
            $inv_location_id = $data['inv_location_id'];
            $prod_inv_location_id = $data['prod_inv_location_id'];
            $quoted_prod_id = $data['quoted_prod_id'];
            $inv_prop = $data['inv_prop'];
            $inv_val = $data['inv_val'];
            $inv_qty_deduct = $data['inv_qty_deduct'];
            $total_inv_deduct = $data['total_inv_deduct'];
            $counter = $data['counter'];

            $quote_prod = $this->QuotationProduct->findById($quoted_prod_id); 
            $tt_qty = 0;
            foreach($inv_qty_deduct as $inv_qty){
                $tt_qty = $tt_qty + $inv_qty;
            }
            
            $processed_qty = floatval($quote_prod['QuotationProduct']['processed_qty']) + floatval($tt_qty);
            
//             echo json_encode($processed_qty);exit;
            $this->ProductSource->create();
            $this->ProductSource->set(array(
                "quotation_product_id" => $quoted_prod_id,
                "product_id" => $quote_prod['Product']['id'],
                "source" => 'inventory',
                "quotation_id" => $quote_prod['Quotation']['id'],
                "prod_inv_location_id" => $prod_inv_location_id,
                "status" => "pending",
                "qty" => $total_inv_deduct
            ));
            if ($this->ProductSource->save()) { 
                $product_source_id = $this->ProductSource->getLastInsertID();
 
                 for($i=0; $i<=$counter; $i++){ 
                     $this->ProductSourceProperty->create();
                     $this->ProductSourceProperty->set(array(
                        'property'=> $inv_prop[$i],
                        'value'=> $inv_val[$i],
                        'qty'=> $inv_qty_deduct[$i],
                         'product_source_id'=>$product_source_id
                     ));
                     $this->ProductSourceProperty->save();
                 }
                 
                 $this->QuotationProduct->id=$quoted_prod_id;
                 $this->QuotationProduct->set(array(
                     'processed_qty'=>$processed_qty
                 ));
                 $this->QuotationProduct->save();
                 
                        $dateToday = date("Y-m-d H:i:s");
                        $this->Quotation->id = $quote_prod['Quotation']['id'];
                        $this->Quotation->set(array(
                            'status' => 'processed',
                            'date_processed' => $dateToday
                        ));
                        $this->Quotation->save();
                        
                  echo json_encode($product_source_id);
            } 
    }

}
