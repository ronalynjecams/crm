<?php

App::uses('AppController', 'Controller');

/**
 * ProductSuppliers Controller
 *
 * @property ProductSupplier $ProductSupplier
 * @property PaginatorComponent $Paginator
 */
class ProductSuppliersController extends AppController {

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
        $this->ProductSupplier->recursive = 0;
        $this->set('productSuppliers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->ProductSupplier->exists($id)) {
            throw new NotFoundException(__('Invalid product supplier'));
        }
        $options = array('conditions' => array('ProductSupplier.' . $this->ProductSupplier->primaryKey => $id));
        $this->set('productSupplier', $this->ProductSupplier->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->ProductSupplier->create();
            if ($this->ProductSupplier->save($this->request->data)) {
                $this->Session->setFlash(__('The product supplier has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The product supplier could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $products = $this->ProductSupplier->Product->find('list');
        $suppliers = $this->ProductSupplier->Supplier->find('list');
        $this->set(compact('products', 'suppliers'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->ProductSupplier->exists($id)) {
            throw new NotFoundException(__('Invalid product supplier'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ProductSupplier->save($this->request->data)) {
                $this->Session->setFlash(__('The product supplier has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The product supplier could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('ProductSupplier.' . $this->ProductSupplier->primaryKey => $id));
            $this->request->data = $this->ProductSupplier->find('first', $options);
        }
        $products = $this->ProductSupplier->Product->find('list');
        $suppliers = $this->ProductSupplier->Supplier->find('list');
        $this->set(compact('products', 'suppliers'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->ProductSupplier->id = $id;
        if (!$this->ProductSupplier->exists()) {
            throw new NotFoundException(__('Invalid product supplier'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ProductSupplier->delete()) {
            $this->Session->setFlash(__('The product supplier has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The product supplier could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function get_supplier() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            
            
            
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        //6 supply
        //7 raw
        //
        $me = $this->Auth->user('id');
        $this->set(compact('me'));
        if ($user['User']['department_id'] == 6) {
            $type = 'supply';
            $subcon = 'supplysubcon';
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
            $subcon = 'rawsubcon';
        }
            $this->loadModel('Supplier');
 
        $prod_supplier = $this->Supplier->find('all', array(
            'conditions' => array(
                'Supplier.type' => array($type, $subcon, 'both')
            )
        ));
            
             
            return json_encode($prod_supplier);
            exit;
        }
    }

    public function get_product_supplier() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $supplier_id = $this->request->query['id'];


            $prod_supplier = $this->ProductSupplier->find("all", array(
                'conditions' => array(
                    'ProductSupplier.supplier_id' => $supplier_id
//                    'Quotation.status' => array('approved', 'processed'))
            )));
            return json_encode($prod_supplier);
            exit;
        }
    }

    public function get_product_supplier_properties() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $product_supplier_id = $this->request->query['id'];

            $this->loadModel('ProductSupplierProperty');

            $prod_supplier = $this->ProductSupplierProperty->find("all", array(
                'conditions' => array(
                    'ProductSupplierProperty.product_supplier_id' => $product_supplier_id
            )));
            return json_encode($prod_supplier);
            exit;
        }
    }

    public function all_list() {
        $id = $this->params['url']['id'];
        $this->loadModel('Supplier');
        $this->loadModel('Product');

        $supplier = $this->Supplier->findById($id);
        $this->set(compact('supplier'));

        $products = $this->ProductSupplier->find('all', array(
            'conditions'=>array('ProductSupplier.supplier_id' => $id)
        ));
        $this->set(compact('products'));

        $prods = $this->Product->find('all', array(
            'conditions' => array('Product.type' => array('supply', 'combi', 'chopped'))
        ));
        $this->set(compact('prods'));
    }

    public function get_product_property() {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $this->loadModel('Product');
            $id = $this->request->query['id'];
            $this->Product->recursive = 2;
            $product = $this->Product->findById($id);
            return (json_encode($product));
            exit;
        }
    }

    public function add_new_product() {
        $this->autoRender = false;
        $data = $this->request->data;

        $property = $data['property'];
        $value = $data['value'];
        $price = $data['price'];
        $product_id = $data['product_id'];
        $code = $data['code'];
        if(!empty($data['note'])){
            $note = $data['note'];
        }else{
            $note = 'no notes';
        }
        $supplier_id = $data['supplier_id'];
        $counter = $data['counter'];
//            pr($data);

        $this->ProductSupplier->create();
        $this->ProductSupplier->set(array(
            'product_id' => $product_id,
            'supplier_id' => $supplier_id,
            'note' => $note,
            'product_code' => $code
        ));
        if ($this->ProductSupplier->save()) {
            $ps_id = $this->ProductSupplier->getLastInsertID();
            $this->loadModel('ProductSupplierProperty');

            for ($i = 0; $i <= $counter; $i++) {
                $this->ProductSupplierProperty->create();
                $this->ProductSupplierProperty->set(array(
                    'property' => $property[$i],
                    'value' => $value[$i],
                    'price' => $price[$i],
                    'product_supplier_id' => $ps_id
                ));
                $this->ProductSupplierProperty->save();
            }
            echo json_encode($data);
        }
    }

    public function update_product_property() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];


            $prod_supplier = $this->ProductSupplier->findById($id);
            return json_encode($prod_supplier);
            exit;
        }
    }

    public function update_product() {
        $this->autoRender = false;
        $data = $this->request->data;

        $property = $data['property'];
        $value = $data['value'];
        $price = $data['price']; 
        $code = $data['code'];
        $note = $data['note'];
        $product_supplier_id = $data['product_supplier_id'];
        $counter = $data['counter'];
//            pr($data);

        $this->ProductSupplier->id=$product_supplier_id;
        $this->ProductSupplier->set(array( 
            'note' => $note,
            'product_code' => $code
        ));
        if ($this->ProductSupplier->save()) { 
            //delete muna properties tapos add
            $this->loadModel('ProductSupplierProperty');
            
//            $this->ProductSupplierProperty->id = $id;
//            if ($this->ProductSupplierProperty->delete()) {
//                
//            }
            
            $this->ProductSupplierProperty->deleteAll(array('ProductSupplierProperty.product_supplier_id'=>$product_supplier_id));
//
            for ($i = 0; $i <= $counter; $i++) {
                $this->ProductSupplierProperty->create();
                $this->ProductSupplierProperty->set(array(
                    'property' => $property[$i],
                    'value' => $value[$i],
                    'price' => $price[$i],
                    'product_supplier_id' => $product_supplier_id
                ));
                $this->ProductSupplierProperty->save();
            }
            echo json_encode($data);
        }
    }
    
    public function check_product_supplier(){
        
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $this->loadModel('Product');
            $data = $this->request->query['data'];
            $check = $this->ProductSupplier->find('all',array(
                'conditions'=>array(
                    'ProductSupplier.supplier_id'=>$data['supplier_id'],
                    'ProductSupplier.product_id'=>$data['product_id'],
                    )));
            if(count($check)==0){
                echo json_encode('ok');
            }else{
                echo json_encode('exist');
            }
            
        }
    }

}
