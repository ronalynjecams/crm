<?php
App::uses('AppController', 'Controller');
/**
 * ProductionProcesses Controller
 *
 * @property ProductionProcess $ProductionProcess
 * @property PaginatorComponent $Paginator
 */
class ProductionProcessesController extends AppController {

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
		$this->ProductionProcess->recursive = 0;
		$this->set('productionProcesses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductionProcess->exists($id)) {
			throw new NotFoundException(__('Invalid production process'));
		}
		$options = array('conditions' => array('ProductionProcess.' . $this->ProductionProcess->primaryKey => $id));
		$this->set('productionProcess', $this->ProductionProcess->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductionProcess->create();
			if ($this->ProductionProcess->save($this->request->data)) {
				$this->Session->setFlash(__('The production process has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production process could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productions = $this->ProductionProcess->Production->find('list');
		$productionSections = $this->ProductionProcess->ProductionSection->find('list');
		$users = $this->ProductionProcess->User->find('list');
		$this->set(compact('productions', 'productionSections', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductionProcess->exists($id)) {
			throw new NotFoundException(__('Invalid production process'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductionProcess->save($this->request->data)) {
				$this->Session->setFlash(__('The production process has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production process could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductionProcess.' . $this->ProductionProcess->primaryKey => $id));
			$this->request->data = $this->ProductionProcess->find('first', $options);
		}
		$productions = $this->ProductionProcess->Production->find('list');
		$productionSections = $this->ProductionProcess->ProductionSection->find('list');
		$users = $this->ProductionProcess->User->find('list');
		$this->set(compact('productions', 'productionSections', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductionProcess->id = $id;
		if (!$this->ProductionProcess->exists()) {
			throw new NotFoundException(__('Invalid production process'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductionProcess->delete()) {
			$this->Session->setFlash(__('The production process has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The production process could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function view_list() {
		$production_id = $this->params['url']['id'];
		
		$this->loadModel('ProductionProcess');
		$this->loadModel('Production');
		$this->loadModel('Client');
		$this->loadModel('Quotation');
		$this->loadModel('QuotationProductProperty');
		$this->loadModel('User');
		$this->loadModel('ProductionCarpenter');
		
		$production = $this->Production->findById($production_id);
		
		$production_processes = $this->ProductionProcess->find('all',
			['conditions'=>
			['ProductionProcess.production_id'=>$production_id]]);
		
		$client = [];
		$section_head_id = 0;
		$production_client_id = 0;
		$production_process_id = 0;
		foreach($production_processes as $production_process_obj) {
			$production_obj = $production_process_obj['Production'];
			$production_client_id = $production_obj['client_id'];
			$section = $production_process_obj['ProductionSection'];
			$section_head_id = $section['user_id'];
			$production_process = $production_process_obj['ProductionProcess'];
			$production_process_id = $production_process['id'];
			
			$this->Client->recursive = -1;
			$client[$production_client_id] = $this->Client->findById($production_client_id,
				['Client.name']);
		}
		
		$quotation_id = $production['QuotationProduct']['quotation_id'];
		$sales_executive = $this->Quotation->findById($quotation_id,
			['User.first_name','User.last_name', 'Quotation.target_delivery']);
		
		
		$designer = [];
		$jrproduct_obj = $production['JrProduct'];
		$designer_id = $jrproduct_obj['user_id'];
		
		$this->User->recursive = -1;
		$designer = $this->User->findById($designer_id,
			['User.first_name', 'User.last_name']);
		$section_head = $this->User->findById($section_head_id,
			['User.first_name', 'User.last_name']);
			
		$q_prod_id = $production['QuotationProduct']['id'];
		$this->QuotationProductProperty->recursive = -1;
		$QuotationProductProperty = $this->QuotationProductProperty->find('all',
			['conditions'=>['quotation_product_id'=>$q_prod_id],
			 'fields'=>['QuotationProductProperty.id',
			 			'QuotationProductProperty.property',
						'QuotationProductProperty.value']]);

		$ProductionCarpenter = $this->ProductionCarpenter->find('all',
			['conditions'=>['production_process_id'=>$production_process_id],
			'fields'=>['ProductionCarpenter.id',
					   'ProductionCarpenter.qty_assigned',
					   'ProductionCarpenter.status',
					   'User.first_name','User.last_name']]);
		
		$carp_opts = $this->User->find('all',
			['User.first_name', 'User.last_name']);
		
		$this->set(compact('production_processes', 'production', 'client',
						   'sales_executive', 'designer', 'section_head',
						   'QuotationProductProperty', 'ProductionCarpenter',
						   'prod_carpenter_obj', 'carp_opts'));
	}
	
	public function add_worker() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$prod_proc_id = $data['production_process_id'];
		$user_id = $data['user_id'];
		$qty_assigned = $data['qty_assigned'];
		$status = 'pending';
		$production_id = $data['production_id'];
		$userin = $this->Auth->user('id');
		
		$ProductionCarpenter_set = ['production_process_id'=>$prod_proc_id,
								  'user_id'=>$user_id,
								  'qty_assigned'=>$qty_assigned,
								  'status'=>$status];
		$ProductionLog_set = ['production_id'=>$production_id,
							  'production_process_id'=>$prod_proc_id,
							  'production_carpenter_id'=>$user_id,
							  'type'=>'production_carpenter',
							  'status'=>'pending',
							  'user_id'=>$userin];
		$ProductionLog_set2 = ['production_id'=>$production_id,
							  'production_process_id'=>$prod_proc_id,
							  'production_carpenter_id'=>$user_id,
							  'type'=>'production_process',
							  'status'=>'ongoing',
							  'user_id'=>$userin];
		
		$this->loadModel('ProductionCarpenter');
		$this->loadModel('ProductionLog');
		$this->loadModel('ProductionProcess');
		
		$DS_ProductionCarpenter = $this->ProductionCarpenter->getDataSource();
		$DS_ProductionLog = $this->ProductionLog->getDataSource();
		$DS_ProductionLog2 = $this->ProductionLog->getDataSource();
		$DS_ProductionProcess = $this->ProductionProcess->getDataSource();
		$DS_ProductionCarpenter->begin();
		
		$this->ProductionCarpenter->create();
		$this->ProductionCarpenter->set($ProductionCarpenter_set);
		
		if($this->ProductionCarpenter->save()) {
			echo json_encode("ProductionCarpenter saved");
			$DS_ProductionLog->begin();
			
			$this->ProductionLog->create();
			$this->ProductionLog->set($ProductionLog_set);
			
			if($this->ProductionLog->save()) {
				echo json_encode("ProductionLog saved");
				$DS_ProductionProcess->begin();
				$this->ProductionProcess->id = $prod_proc_id;
				$this->ProductionProcess->set(['status'=>'ongoing']);
		
				if($this->ProductionProcess->save()) {
					echo json_encode("ProductionProcess saved");
					$DS_ProductionLog2->begin();
					$this->ProductionLog->create();
					$this->ProductionLog->set($ProductionLog_set2);
					
					if($this->ProductionLog->save()) {
						$DS_ProductionLog2->commit();
						$DS_ProductionProcess->commit();
						$DS_ProductionLog->commit();
						$DS_ProductionCarpenter->commit();
					}
					else {
						$DS_ProductionProcess->rollback();
						$DS_ProductionLog->rollback();
						$DS_ProductionCarpenter->rollback();
						return json_encode("Error in ProductionLog2");
						exit;
					}
				}
				else {
					$DS_ProductionLog->rollback();
					$DS_ProductionCarpenter->rollback();
					return json_encode("Error in updating ProductionProcess");
					exit;
				}
			}
			else {
				$DS_ProductionCarpenter->rollback();
				return json_encode("Error in saving ProductionLog 1");
				exit;
			}
		}
		
		return json_encode("Add Worker Done");
		exit;
	}
	
	public function delete_carp() {
		$this->autoRender = false;
		$carp_id = $this->request->query['id'];
		
		$this->loadModel('ProductionCarpenter');
		$DS_ProductionCarpenter = $this->ProductionCarpenter->getDataSource();
		$DS_ProductionCarpenter->begin();
		
		$this->ProductionCarpenter->id = $carp_id;
		if($this->ProductionCarpenter->delete()) {
			echo json_encode("Carpenter Deleted");
			$DS_ProductionCarpenter->commit();	
		}
		else {
			return json_encode("Error in deleting carpenter");
			exit;
		}
		
		return json_encode("Delete Carpenter Done");
		exit;
	}
	
	public function start_accomplished() {
		$this->autoRender = false;
		$data = $this->request->data;
		$prod_proc_id = $data['production_process_id'];
		$carp_id = $data['carp_id'];
		$status = $data['status'];
		$production_id = $data['production_id'];
		$userin = $this->Auth->user('id');
		
		$ProductionLog_set = ['production_id'=>$production_id,
							  'production_process_id'=>$prod_proc_id,
							  'production_carpenter_id'=>$carp_id,
							  'type'=>'production_carpenter',
							  'status'=>$status,
							  'user_id'=>$userin];
		
		$ProductionLog_set2 = ['production_id'=>$production_id,
							  'production_process_id'=>$prod_proc_id,
							  'production_carpenter_id'=>$carp_id,
							  'type'=>'production_process',
							  'status'=>'accomplished',
							  'user_id'=>$userin];
		
		$this->loadModel('ProductionCarpenter');
		$this->loadModel('ProductionLog');
		$this->loadModel('ProductionProcess');
		
		$this->ProductionCarpenter->recursive = -1;
		$all_carpenters = $this->ProductionCarpenter->find('all',
			['conditions'=>
			['ProductionCarpenter.production_process_id'=>$prod_proc_id,
			 'ProductionCarpenter.status'=>'ongoing']]);
		
		$DS_ProductionCarpenter = $this->ProductionCarpenter->getDataSource();
		$DS_ProductionLog = $this->ProductionLog->getDataSource();
		$DS_ProductionLog2 = $this->ProductionLog->getDataSource();
		$DS_ProductionProcess = $this->ProductionProcess->getDataSource();
		$DS_ProductionCarpenter->begin();
		$this->ProductionCarpenter->id = $carp_id;
		$this->ProductionCarpenter->set(['status'=>$status]);
		
		if($this->ProductionCarpenter->save()) {
			echo json_encode("ProductionCarpenter saved");
			$DS_ProductionLog->begin();
			$this->ProductionLog->create();
			$this->ProductionLog->set($ProductionLog_set);
			
			if($this->ProductionLog->save()) {
				echo json_encode("ProductionLog saved");
				
				if(count($all_carpenters)==1) {
					$DS_ProductionProcess->begin();
					$this->ProductionProcess->id = $prod_proc_id;
					$this->ProductionProcess->set(['status'=>'accomplished']);
					
					if($this->ProductionProcess->save()) {
						echo json_encode("ProductionProcess saved");
						$DS_ProductionLog2->begin();
						$this->ProductionLog->create();
						$this->ProductionLog->set($ProductionLog_set2);
						
						if($this->ProductionLog->save()) {
							echo json_encode("ProductionLog2 saved");
							$DS_ProductionLog2->commit();
							$DS_ProductionProcess->commit();
							$DS_ProductionLog->commit();
							$DS_ProductionCarpenter->commit();
						}
						else {
							$DS_ProductionProcess->rollback();
							$DS_ProductionLog->rollback();
							$DS_ProductionCarpenter->rollback();
							return json_encode("Error in saving ProductionLog2");
							exit;
						}
					}
					else {
						$DS_ProductionLog->rollback();
						$DS_ProductionCarpenter->rollback();
						return json_encode("Error in updating ProductionProcess");
						exit;
					}	
				}
				else {
					$DS_ProductionLog->commit();
					$DS_ProductionCarpenter->commit();
				}
			}
			else {
				$DS_ProductionCarpenter->rollback();
				return json_encode("Error in saving ProductionLog");
				exit;
			}
		}
		else {
			return json_encode("Error in updating ProductionCarpenter");
			exit;
		}
		
		return json_encode("Start Accomplished Done");
		exit;
	}
}
