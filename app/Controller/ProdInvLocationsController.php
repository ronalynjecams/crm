<?php

App::uses('AppController', 'Controller');

/**

 * ProdInvLocations Controller

 *

 * @property ProdInvLocation $ProdInvLocation

 * @property PaginatorComponent $Paginator

 */

class ProdInvLocationsController extends AppController {



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

            $this->ProdInvLocation->recursive = 0;

            $this->set('inventory', $this->Paginator->paginate());
            
            $this->loadModel('InvLocation');
            $locations = $this->InvLocation->find('all');
            $this->set(compact('locations'));
//            pr($locations); exit;
            $this->loadModel('Product');
            $products = $this->Product->find('all');
            $this->set(compact('products'));
            
            $prod_locations = $this->ProdInvLocation->find('all');
            // pr($prod_locations); exit;
            $products_inv = [];
            $products_combo = [];
            $inv_id = [];
            $ctr  = 0;
            foreach ($prod_locations as $prod_location){
                $pilpid = $prod_location['ProdInvLocation']['product_id'];
                $pilid = $prod_location['ProdInvLocation']['id'];
                if(!in_array($pilpid, $inv_id)) {
//                    pr($prod_location);
                    $products_combo[$pilpid] = [];
                    array_push($inv_id, $pilpid);
                    array_push($products_inv, $prod_location);
                }
                array_push($products_combo[$pilpid], $prod_location['ProdInvCombo']);
                
//                 $this->loadModel('ProdInvCombo');
//                 $combo = $this->ProdInvCombo->find('first', ['conditions' => ['ProdInvCombo.prod_inv_location_id' => $pilid]]);
// //                    pr($combo['ProdInvCombo']['qty']);
//                     $products_inv[$ctr]['ProdInvLocation']['qty'] = $combo['ProdInvCombo']['qty'];
// //                array_push($products_inv ,$this->ProdInvLocation->find('first', array('conditions' => array('ProdInvLocation.id' => $prod_location))));
//             $ctr++;
            }
            
            $this->set(compact('products_inv'));
            $this->set(compact('products_combo'));
// // //            exit;
//             pr($products_inv); 
//             pr($products_combo); exit;
	}



/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function view($id = null) {

		if (!$this->ProdInvLocation->exists($id)) {

			throw new NotFoundException(__('Invalid prod inv location'));

		}

		$options = array('conditions' => array('ProdInvLocation.' . $this->ProdInvLocation->primaryKey => $id));

		$this->set('prodInvLocation', $this->ProdInvLocation->find('first', $options));

	}
    
    public function view_combo(){
        
        $id = $this->params['url']['id'];
        $prod = $this->params['url']['prod'];

		$options = array('conditions' => array('ProdInvLocation.product_id'  => $id));
        // $this->ProdInvLocation->recursive = 0;
		$this->set(array('prodInvCombos' => $this->ProdInvLocation->find('all', $options), 'product' => $prod));
// 		pr($this->ProdInvLocation->find('all', $options));
// 		exit;
    }


/**

 * add method

 *

 * @return void

 */

	public function add() {

		if ($this->request->is('post')) {

			$this->ProdInvLocation->create();

			if ($this->ProdInvLocation->save($this->request->data)) {

				$this->Session->setFlash(__('The prod inv location has been saved.'), 'default', array('class' => 'alert alert-success'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The prod inv location could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));

			}

		}

		$invLocations = $this->ProdInvLocation->InvLocation->find('list');

		$products = $this->ProdInvLocation->Product->find('list');

		$this->set(compact('invLocations', 'products'));

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function edit($id = null) {

		if (!$this->ProdInvLocation->exists($id)) {

			throw new NotFoundException(__('Invalid prod inv location'));

		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->ProdInvLocation->save($this->request->data)) {

				$this->Session->setFlash(__('The prod inv location has been saved.'), 'default', array('class' => 'alert alert-success'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The prod inv location could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));

			}

		} else {

			$options = array('conditions' => array('ProdInvLocation.' . $this->ProdInvLocation->primaryKey => $id));

			$this->request->data = $this->ProdInvLocation->find('first', $options);

		}

		$invLocations = $this->ProdInvLocation->InvLocation->find('list');

		$products = $this->ProdInvLocation->Product->find('list');

		$this->set(compact('invLocations', 'products'));

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->ProdInvLocation->id = $id;

		if (!$this->ProdInvLocation->exists()) {

			throw new NotFoundException(__('Invalid prod inv location'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->ProdInvLocation->delete()) {

			$this->Session->setFlash(__('The prod inv location has been deleted.'), 'default', array('class' => 'alert alert-success'));

		} else {

			$this->Session->setFlash(__('The prod inv location could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));

		}

		return $this->redirect(array('action' => 'index'));

	}

        public function get_location(){
        $this->autoRender = false;

        $this->response->type('json');

            if ($this->request->is('ajax')) {

                $id = $this->request->query['id']; 

//                $this->ProdInvLocation->recursive = 2;
//
//                $product_locations = $this->ProdInvLocation->find('all',array(
//
//                    'conditions'=>array('ProdInvLocation.inv_location_id'=>$id)));
//
//                return (json_encode($product_locations));
                $this->loadModel('InvLocation');
                $locations = $this->InvLocation->find('all');
                $this->ProdInvLocation->recursive = -1;
                $final_location = [];
                foreach ($locations as $location){
                    $option = array(
                        'conditions' => array('ProdInvLocation.inv_location_id' => $location["InvLocation"]["id"],
                                              'ProdInvLocation.product_id' => $id));
                    $prod_inv = $this->ProdInvLocation->find("first", $option);
                    if(count($prod_inv) == 0){
                        array_push($final_location , $location);
                    }
                }
                
                return (json_encode($final_location));

                exit;

            }

        }
        
        public function get_product_property(){
            $this->autoRender = false;

        $this->response->type('json');

            if ($this->request->is('ajax')) {

                $this->loadModel('ProductProperty');

                $id = $this->request->query['id']; 

                $this->ProductProperty->recursive = 1;

                $product_properties = $this->ProductProperty->find('all',array(

                    'conditions'=>array('ProductProperty.product_id'=>$id)));

                return (json_encode($product_properties));

                exit;

            }
        }


        public function get_product_location(){

        $this->autoRender = false;

        $this->response->type('json');

            if ($this->request->is('ajax')) {

                $id = $this->request->query['id']; 

                $this->ProdInvLocation->recursive = 2;

                $product_locations = $this->ProdInvLocation->find('all',array(

                    'conditions'=>array('ProdInvLocation.inv_location_id'=>$id)));

                return (json_encode($product_locations));

                exit;

            }

        }

        

        public function get_product_location_property(){

        $this->autoRender = false;

        $this->response->type('json');

            if ($this->request->is('ajax')) {

                $this->loadModel('ProdInvLocationProperty');

                $id = $this->request->query['id']; 

                $this->ProdInvLocationProperty->recursive = 2;

                $product_location_properties = $this->ProdInvLocationProperty->find('all',array(

                    'conditions'=>array('ProdInvLocationProperty.prod_inv_location_id'=>$id)));

                return (json_encode($product_location_properties));

                exit;

            }

            

        }
        
        public function addInventory(){
            $this->autoRender = false;

            header("Content-type:application/json");

            $data = $this->request->data;
            
            $this->loadModel('ProdInvLocationProperty');
            $this->loadModel('ProdInvCombo');
            
            $product_id = $data['product_id'];
            $location_id = $data['location_id'];
            $counter = $data['counter'];
            $inv_prop = $data['inv_prop'];
            $inv_val = $data['inv_val'];
            $quantity = $data['quantity'];
            
            $this->ProdInvLocation->recursive = -1;
//            $query = mysql_query("SELECCT * FROM ")
            $prod_inv = $this->ProdInvLocation->find('first', array(
                'conditions' => array('ProdInvLocation.inv_location_id' => $location_id, 'ProdInvLocation.product_id' => $product_id)
            ));
            
            if(count($prod_inv) < 1){
                $this->ProdInvLocation->set(array('inv_location_id' => $location_id, 'product_id' => $product_id));
                if($this->ProdInvLocation->save($data)){
                    $prod_inv_id = $this->ProdInvLocation->getLastInsertID();
                    $this->ProdInvCombo->set(array(
                        'prod_inv_location_id' => $prod_inv_id,
                        'qty' => $quantity
                    ));
                    
                    if($this->ProdInvCombo->save()){
                        $prod_combo_id = $this->ProdInvCombo->getLastInsertID();
                        for($i=0; $i < $counter ; $i++){
                            $this->ProdInvLocationProperty->create();
                            $this->ProdInvLocationProperty->set(array(
                                'prod_inv_location_id' => $prod_inv_id, 
                                'qty' => $quantity,
                                'property' => $inv_prop[$i], 
                                'value' => $inv_val[$i], 
                                'prod_inv_combo_id' => $prod_combo_id
                            ));
                            $this->ProdInvLocationProperty->save();
                        }
                        echo json_encode("saved");
                    }
                }
            } else {
                $combo_count = 0;
                for($i=0; $i < $counter ; $i++){
                    $options = array(
                        'property' => $inv_prop[$i], 
                        'value' => $inv_val[$i]
                    );
                    $p = $this->ProdInvLocationProperty->find('first', $options );
                    if(count($p) > 0){
                        $combo_count += 1;
                    }
                }
                
                if($counter != $combo_count){
                    $this->ProdInvCombo->set(array(
                        'prod_inv_location_id' => $prod_inv['ProdInvLocation']['id'],
                        'qty' => $quantity
                    ));

                    if($this->ProdInvCombo->save()){
                        $prod_combo_id = $this->ProdInvCombo->getLastInsertID();
                        $this->ProdInvLocationProperty->create();
                        for($i=0; $i < $counter ; $i++){
                            $this->ProdInvLocationProperty->set(array(
                                'prod_inv_location_id' => $prod_inv_id, 
                                'qty' => $quantity,
                                'property' => $inv_prop[$i], 
                                'value' => $inv_val[$i], 
                                'prod_inv_combo_id' => $prod_combo_id
                            ));
                            $this->ProdInvLocationProperty->save();
                        }
                        echo json_encode("saved");
                    }
                } else{
                    echo json_encode("already saved");
                }
            }
        }

}