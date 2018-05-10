<?php

App::uses('AppController', 'Controller');

/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 * @property PaginatorComponent $Paginator
 */
class SuppliersController extends AppController {

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
        $this->Supplier->recursive = 0;
        $this->set('suppliers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Supplier->exists($id)) {
            throw new NotFoundException(__('Invalid supplier'));
        }
        $options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
        $this->set('supplier', $this->Supplier->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $user = $this->Auth->user('id');
        $this->set(compact('user'));
        if ($this->request->is('post')) {
            $this->Supplier->create();
            if ($this->Supplier->save($this->request->data)) {
//                $this->Session->setFlash(__('The supplier has been saved.'), 'default', array('class' => 'supplier'), 'supplier');
//                $this->Session->setFlash(__('The supplier has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'supplier_list'));
            } else {
//                $this->Session->setFlash(__('The supplier could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
//    public function edit($id = null) {
//        if (!$this->Supplier->exists($id)) {
//            throw new NotFoundException(__('Invalid supplier'));
//        }
//        if ($this->request->is(array('post', 'put'))) {
//            if ($this->Supplier->save($this->request->data)) {
//                $this->Session->setFlash(__('The supplier has been saved.'), 'default', array('class' => 'alert alert-success'));
//                return $this->redirect(array('action' => 'index'));
//            } else {
//                $this->Session->setFlash(__('The supplier could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
//            }
//        } else {
//            $options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
//            $this->request->data = $this->Supplier->find('first', $options);
//        }
//    }

    public function edit() {
        $data = $this->request->data;
//        if (!$this->Supplier->exists($data['id'])) {
//            throw new NotFoundException(__('Invalid supplier'));
//        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Supplier->id = $data['id'];
            if ($this->Supplier->save($this->request->data)) {
//                $this->Session->setFlash(__('The supplier has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'supplier_list'));
            } else {
//                $this->Session->setFlash(__('The supplier could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
            $this->request->data = $this->Supplier->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Supplier->id = $id;
        if (!$this->Supplier->exists()) {
            throw new NotFoundException(__('Invalid supplier'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Supplier->delete()) {
            $this->Session->setFlash(__('The supplier has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The supplier could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    // public function supplier_list() {
    //     $this->loadModel('User');
    //     $user = $this->User->findById($this->Auth->user('id'));
    //     //6 supply
    //     //7 raw
    //     //
    //     $me = $this->Auth->user('id');
    //     $this->set(compact('me'));
    //     if ($user['User']['department_id'] == 6) {
    //         $type = 'supply';
    //         $subcon = 'supplysubcon';
    //     } else if ($user['User']['department_id'] == 7) {
    //         $type = 'raw';
    //         $subcon = 'rawsubcon';
    //     }

    //     $this->set(compact('type'));
    //     $suppliers = $this->Supplier->find('all', array(
    //         'conditions' => array(
    //             'Supplier.type' => array($type, $subcon, 'both')
    //         )
    //     ));

    //     $this->set(compact('suppliers'));
    //     //check if what department is the user
    // }
    
/*
    public function supplier_list() {
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
            $suppliers = $this->Supplier->find('all', array(
                'conditions' => array(
                    'Supplier.type' => array($type, $subcon, 'both')
                )
            ));
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
            $subcon = 'rawsubcon';
            $suppliers = $this->Supplier->find('all', array(
                'conditions' => array(
                    'Supplier.type' => array($type, $subcon, 'both')
                )
            ));
        } else if ($user['User']['role'] == 'purchasing_supervisor') {
            $type = 'raw';
            $subcon = 'rawsubcon';
            $suppliers = $this->Supplier->find('all');
        }

        $this->set(compact('type'));
        // $suppliers = $this->Supplier->find('all', array(
        //     'conditions' => array(
        //         'Supplier.type' => array($type, $subcon, 'both')
        //     )
        // ));

        $this->set(compact('suppliers'));
        //check if what department is the user
    }*/
	
	

    public function add_supplier() {
        $this->autoRender = false;
        $data = $this->request->data;

        // pr($this->request->data);
        // exit;
        $name = $data['name'];
        $contact_person = $data['contact_person'];
        $code = $data['code'];
        $address = $data['address']; 
        $email = $data['email']; 
        $contact_number = $data['contact_number']; 
        $vatable = $data['vatable']; 
        $tin_number = $data['tin_number'];  
        $status = 'active';
        $user_id = $this->Auth->user('id');
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        //6 supply
        //7 raw
//        //
        if ($user['User']['department_id'] == 6) {
			if($user['User']['role'] == 'subcon_purchasing'){
				$type = 'jecams_subcon';
			}else{
				$type = 'supply';
			}
				
        } else if ($user['User']['department_id'] == 7) {
			if($user['User']['role'] == 'subcon_purchasing'){
				$type = 'jecams_subcon';
			}else{
            $type = 'raw';
			}
        }
        
        
        $this->Supplier->create();
        $this->Supplier->set(array(
          'name' => $name,
            'contact_person' => $contact_person,
            'code' => $code,
            'address' => $address,
            'email' => $email,
            'contact_number' => $contact_number,
            'contact_number' => $type,
            'vatable' => 1,
            'tin_number' => 1,
            'status' => 'active',
            'user_id' => 1 
        ));
        if($this->Supplier->save()){ 
            echo json_encode($data);
        }else{
            echo json_encode('error');
        }
    }
    public function get_supplier_info() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->Supplier->recursive = -1;
            $lead = $this->Supplier->findById($id);
            return (json_encode($lead['Supplier']));
            exit;
        }
    }
	
	
    public function supplier_list() {
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        //6 supply
        //7 raw
        $me = $this->Auth->user('id');
        /////////////////ADONIS ARRIOLA/////////////////
       
        $this->set(compact('me'));
		//var_dump($this->Auth->user('role'));exit;
      
        if ($user['User']['department_id'] == 6) {
                if($this->Auth->user('role') == 'subcon_purchasing'){
                    $type = 'jecams_subcon';
                    $suppliers = $this->Supplier->find('all', array(
                    'conditions' => array(
                        'Supplier.type' => ($type),
                        'Supplier.user_id'=> ($me)
                    )
                ));
                    
                }else if($user['User']['role'] == 'supply_staff'){
    
                        $type = 'supply';
                        $subcon = 'supplysubcon';
                        $suppliers = $this->Supplier->find('all', array(
                        'conditions' => array(
                            'Supplier.type' => array($type, $subcon, 'both'),
                            // 'Supplier.user_id'=> ($id_user),
                        )
                    ));
                }else{
                     $type = 'supply';
                        $subcon = 'supplysubcon';
                        $suppliers = $this->Supplier->find('all', array(
                        'conditions' => array(
                           'Supplier.type' => array($type, $subcon, 'both'),
                            // 'Supplier.user_id'=> ($id_user),
                        )
                    ));
                }
        } else if ($user['User']['role'] == 'purchasing_supervisor') { 
            $suppliers = $this->Supplier->find('all');
        }  else if($user['User']['department_id'] == 7){
            
             if($this->Auth->user('role') == 'subcon_purchasing'){
                    $type = 'jecams_subcon';
                    $suppliers = $this->Supplier->find('all', array(
                    'conditions' => array(
                        'Supplier.type' => ($type),
                        'Supplier.user_id'=> ($me)
                    )
                ));
                    
                }else{
                    $type = 'raw';
                    $subcon = 'rawsubcon';
                    $suppliers = $this->Supplier->find('all', array(
                        'conditions' => array(
                            'Supplier.type' => array($type, $subcon, 'both'),
                            // 'Supplier.user_id'=> ($id_user)
                        )
                    ));
                }
            
            
        }
        ///////////////ADONIS ARRIOLA//////////

        $this->set(compact('type'));
        // $suppliers = $this->Supplier->find('all', array(
        //     'conditions' => array(
        //         'Supplier.type' => array($type, $subcon, 'both')
        //     )
        // ));
        $this->set(compact('suppliers'));
        //check if what department is the user
    }

}
