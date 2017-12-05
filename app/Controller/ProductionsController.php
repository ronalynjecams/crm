<?php
App::uses('AppController', 'Controller');
/**
 * Productions Controller
 *
 * @property Production $Production
 * @property PaginatorComponent $Paginator
 */
class ProductionsController extends AppController {

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
		$this->Production->recursive = 0;
		$this->set('productions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Production->exists($id)) {
			throw new NotFoundException(__('Invalid production'));
		}
		$options = array('conditions' => array('Production.' . $this->Production->primaryKey => $id));
		$this->set('production', $this->Production->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Production->create();
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash(__('The production has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotationProducts = $this->Production->QuotationProduct->find('list');
		$jrProducts = $this->Production->JrProduct->find('list');
		$clients = $this->Production->Client->find('list');
		$products = $this->Production->Product->find('list');
		$this->set(compact('quotationProducts', 'jrProducts', 'clients', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Production->exists($id)) {
			throw new NotFoundException(__('Invalid production'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash(__('The production has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Production.' . $this->Production->primaryKey => $id));
			$this->request->data = $this->Production->find('first', $options);
		}
		$quotationProducts = $this->Production->QuotationProduct->find('list');
		$jrProducts = $this->Production->JrProduct->find('list');
		$clients = $this->Production->Client->find('list');
		$products = $this->Production->Product->find('list');
		$this->set(compact('quotationProducts', 'jrProducts', 'clients', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Production->id = $id;
		if (!$this->Production->exists()) {
			throw new NotFoundException(__('Invalid production'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Production->delete()) {
			$this->Session->setFlash(__('The production has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The production could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function all_list() {
		$status = $this->params['url']['status'];
		
		$this->loadModel('Production');
		$this->loadModel('ProductionLog');
		$this->loadModel('User');
		$this->loadModel('QuotationProduct');
		$this->loadModel('Quotation');
		$this->loadModel('ProductionSection');
		
		$productions = $this->Production->find('all', ['conditions'=>
			['Production.status'=>$status]]);
		
		$quotation_ids = [];
		foreach($productions as $production_obj) {
			$production = $production_obj['Production'];
			$production_id = $production['id'];
			$jr_product = $production_obj['JrProduct'];
			$jr_product_id = $production['jr_product_id'];
			$jr_product_user_id = $jr_product['user_id'];
			$quotation_product_id = $production['quotation_product_id'];
			$quotation_product = $production_obj['QuotationProduct'];
			
			$this->User->recursive = -1;
			$users[$jr_product_id] = $this->User->find('all', ['conditions'=>
				['id'=>$jr_product_user_id],
				 'fields'=>['last_name','first_name']]);
			
			$this->ProductionLog->recursive = -1;
			$production_logs[$production_id] = $this->ProductionLog->find('all',
				['conditions'=>['ProductionLog.production_id'=>$production_id],
								'fields'=>['created']]);
								
			$quotation_products[$quotation_product_id] = $this->QuotationProduct->find('all',
				['conditions'=>
				['QuotationProduct.id'=>$quotation_product_id]]);
				
			foreach($quotation_products[$quotation_product_id] as $quotation_product_obj) {
				$quotation_product_ret = $quotation_product_obj['QuotationProduct'];
				$quotation_product_ret_id = $quotation_product_ret['id'];
				$quotation_ids[$quotation_product_ret_id] = $quotation_product_ret['quotation_id'];
			}
		}
		
		$quotations = [];
		foreach ($quotation_ids as $quotation_productid=>$quotation_id) {
			$quotations[$quotation_productid] = $this->Quotation->find('all',
				['conditions'=>['Quotation.id'=>$quotation_id]]);
		}
		
		$production_sections = $this->ProductionSection->find('all');
		$this->set(compact('status', 'productions', 'production_logs', 'users',
						   'quotations', 'quotation_products', 'production_sections'));
	}
	
	public function viewed() {
		$this->autoRender = false;
		$id = $this->request->query['id'];
		$userin = $this->Auth->user('id');
		
		$this->loadModel('Production');
		$this->loadModel('ProductionLog');
		
		$DS_Production = $this->Production->getDataSource();
		$DS_ProductionLog = $this->ProductionLog->getDataSource();
		$DS_Production->begin();
		
		$this->Production->id=$id;
		$this->Production->set(['status'=>'viewed']);
		
		if($this->Production->save()) {
			echo json_encode("Production Save");
			$production_log_set = ['production_id'=>$id,
								   'type'=>'production',
								   'status'=>'viewed',
								   'user_id'=>$userin];
			$DS_ProductionLog->begin();
			$this->ProductionLog->create();
			$this->ProductionLog->set($production_log_set);
			
			if($this->ProductionLog->save()) {
				echo json_encode("ProductionLog save");
				$DS_ProductionLog->commit();
				$DS_Production->commit();
			}
			else {
				$DS_Production->rollback();
				return json_encode("Error in ProdcutionLog save");
				exit;
			}
		}
		else {
			return json_encode('Error in updating Production Status to Viewed');
			exit;
		}
		$DS_ProductionLog->commit();
		$DS_Production->commit();
		
		return json_encode('Update Production Status to Viewed');
		exit;
	}
	
	public function update() {
		$this->autoRender = false;
		$data = $this->request->data;
		$production_id = $data['production_id'];
		$section = $data['section'];
		$expected_start = $data['expected_start'];
		$expected_end = $data['expected_end'];
		$userin = $this->Auth->user('id');
		
		$production_set = ['status'=>'ongoing'];
		$production_process_set = ['production_id'=>$production_id,
								   'production_section_id'=>$section,
								   'user_id'=>$userin,
								   'expected_start'=>$expected_start,
								   'expected_end'=>$expected_end,
								   'status'=>'pending'];
		echo json_encode($production_process_set);
		
		$this->loadModel('Production');
		$this->loadModel('ProductionLog');
		$this->loadModel('ProductionProcess');
		
		$DS_Production = $this->Production->getDataSource();
		$DS_ProductionLog = $this->ProductionLog->getDataSource();
		$DS_ProductionProcess = $this->ProductionProcess->getDataSource();
		
		$DS_Production->begin();
		$this->Production->id = $production_id;
		$this->Production->set($production_set);
		
		if($this->Production->save()) {
			echo json_encode("Production saved");
			
			$DS_ProductionProcess->begin();
			$this->ProductionProcess->create();
			$this->ProductionProcess->set($production_process_set);
			
			if($this->ProductionProcess->save()) {
				echo json_encode("ProductionProcess saved");
				$prod_process_id = $this->ProductionProcess->getLastInsertId();
				$production_log_set = ['production_id'=>$production_id,
												   'production_process_id'=>$prod_process_id,
												   'type'=>'production_process',
												   'status'=>'pending',
												   'user_id'=>$userin];
				$DS_ProductionLog->begin();
				$this->ProductionLog->create();
				$this->ProductionLog->set($production_log_set);
				
				if($this->ProductionLog->save()) {
					$DS_ProductionLog->commit();
					$DS_ProductionProcess->commit();
					$DS_Production->commit();
				}
			}
			else {
				$DS_Production->rollback();
				return json_encode("Problem with saving ProductionProcess");
				exit;
			}
		}
		return json_encode($data);
	}
}
