<?php
App::uses('AppController', 'Controller');
/**
 * TransactionSources Controller
 *
 * @property TransactionSource $TransactionSource
 * @property PaginatorComponent $Paginator
 */
class TransactionSourcesController extends AppController {

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
		$this->TransactionSource->recursive = 0;
		$this->set('transactionSources', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TransactionSource->exists($id)) {
			throw new NotFoundException(__('Invalid transaction source'));
		}
		$options = array('conditions' => array('TransactionSource.' . $this->TransactionSource->primaryKey => $id));
		$this->set('transactionSource', $this->TransactionSource->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TransactionSource->create();
			if ($this->TransactionSource->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction source has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction source could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
	public function edit($id = null) {
		if (!$this->TransactionSource->exists($id)) {
			throw new NotFoundException(__('Invalid transaction source'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TransactionSource->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction source has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction source could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('TransactionSource.' . $this->TransactionSource->primaryKey => $id));
			$this->request->data = $this->TransactionSource->find('first', $options);
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
		$this->TransactionSource->id = $id;
		if (!$this->TransactionSource->exists()) {
			throw new NotFoundException(__('Invalid transaction source'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TransactionSource->delete()) {
			$this->Session->setFlash(__('The transaction source has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The transaction source could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function view_source(){
		$id = $this->params['url']['id'];
		$ref_type = $this->params['url']['reference_type'];
		
		$this->TransactionSource->recursive = 2;
		$sources = $this->TransactionSource->findAllByReferenceNumAndReferenceType($id,$ref_type);
		// pr($sources); exit;
		
		$this->set(['ref_type' => $ref_type]);
		$this->set(compact('sources'));
	}
	
	
	public function delete_ts(){
		$this->autoRender = false;
		
		$data = $this->request->data['src'];
		// $id = $data['TransactionSource']['id']
		if($data['TransactionSource']['reference_type'] == 'quotation'){
			$id = $data['TransactionSource']['id'];
			$mode_num = $data['TransactionSource']['mode_num'];
			$pcombo_id = $data['TransactionSource']['product_combo_id'];
			$ref_num = $data['TransactionSource']['reference_num'];
			if($data['TransactionSource']['mode'] == 'po'){
				$this->loadModel('PurchaseOrderProduct');
				$this->PurchaseOrderProduct->recursive = 0;
				
				$po_prod = $this->PurchaseOrderProduct->findByPurchaseOrderIdAndProductComboId($mode_num, $pcombo_id);
				
				if($po_prod){
					$po_prod_id = $po_prod['PurchaseOrderProduct']['id'];
					$update_po_prod = $this->update_po_prod($po_prod_id, 'deleted');
					if($update_po_prod['status'] == 'success'){
						$this->loadModel('InventoryJobOrder');
						$this->InventoryJobOrder->recursive = 0;
						
						if($update_po_prod['po_prod_count'] == 0){
							if($this->update_status($mode_num, 'cancelled', 'PurchaseOrder') == 'success'){
								$inv_jo = $this->InventoryJobOrder->findByProductComboIdAndReferenceNumAndMode($pcombo_id, $ref_num, 'receive');
								if($inv_jo){
									if($this->update_status($inv_jo['InventoryJobOrder']['id'], 'cancelled', 'InventoryJobOrder') == 'success'){
										if($this->update_status($id, 'deleted', 'TransactionSource')){
											return "success";
										}
									} else{
										return "error 1";
									}
								} else{
									return "error 2";
								}
							} else{
								return "error 3";
							}
						} else{
							$inv_jo = $this->InventoryJobOrder->findByProductComboIdAndReferenceNumAndMode($pcombo_id, $ref_num, 'receive');
							if($inv_jo){
								if($this->update_status($inv_jo['InventoryJobOrder']['id'], 'cancelled', 'InventoryJobOrder') == 'success'){
									if($this->update_status($id, 'deleted', 'TransactionSource')){
										return "success";
									} else{
										return "error";
									}
								} else{
									return "error";	
								}
							} else{
								return "error";
							}
						}	
					} else{
						return "error";
					}
					exit;
				}
			}	
			if($data['TransactionSource']['mode'] == 'inventory'){
				$this->loadModel('InventoryJobOrder');
				$this->InventoryJobOrder->recursive = 0;
				$this->TransactionSource->recursive = 0;
				$inv_jo = $this->InventoryJobOrder->findByProductComboIdAndReferenceNumAndMode($pcombo_id, $ref_num, 'receive');
				if($inv_jo){
					if($this->update_status($inv_jo['InventoryJobOrder']['id'], 'cancelled', 'InventoryJobOrder') == 'success'){
						if($this->update_status($id, 'deleted', 'TransactionSource') == 'success'){
							$trans_source = $this->TransactionSource->findByReferenceNumAndStatus($ref_num, "");
							if(count($trans_source) == 0){
								$this->loadModel('Quotation');
								if($this->update_status($ref_num, 'approved', 'Quotation') == 'success'){
									return "success";		
								} else{
									return "error 1";
								}								
							} else{
								return "success";
							}
						} else{
							return "error 2";
						}
					} else{
						return "error 3";	
					}
				} else{
					return "error 4";
				}
			}	
		}
		
		
	}
	
	public function update_po_prod($id, $status){
		$this->loadModel('PurchaseOrderProduct');
		$this->PurchaseOrderProduct->recursive = -1;
		
		$this->PurchaseOrderProduct->id = $id;
		$this->PurchaseOrderProduct->set(array('status' => $status));
		
		if($this->PurchaseOrderProduct->save()){
			$po_p = $this->PurchaseOrderProduct->find('all', array('conditions' => array('PurchaseOrderProduct.id' => $id, 'PurchaseOrderProduct.status !=' => 'deleted')));
			return json_encode(array("status" => "success", "po_prod_count" => count($po_p)));
		} else {
			return "error";
		}
			
		exit;
	}
	
	public function update_status($id, $status, $model){
		$this->loadModel($model);
		
		$this->$model->id = $id;
		$this->$model->set(array('status' => $status));
		
		if($this->$model->save()){
			return "success";
		} else{
			return "error";
		}
	}
	
}
