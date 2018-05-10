<?php
App::uses('AppController', 'Controller');
/**
 * PaymentRequestCheques Controller
 *
 * @property PaymentRequestCheque $PaymentRequestCheque
 * @property PaginatorComponent $Paginator
 */
class PaymentRequestChequesController extends AppController {

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
		$this->PaymentRequestCheque->recursive = 0;
		$this->set('paymentRequestCheques', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentRequestCheque->exists($id)) {
			throw new NotFoundException(__('Invalid payment request cheque'));
		}
		$options = array('conditions' => array('PaymentRequestCheque.' . $this->PaymentRequestCheque->primaryKey => $id));
		$this->set('paymentRequestCheque', $this->PaymentRequestCheque->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentRequestCheque->create();
			if ($this->PaymentRequestCheque->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request cheque has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request cheque could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$paymentRequests = $this->PaymentRequestCheque->PaymentRequest->find('list');
		$payees = $this->PaymentRequestCheque->Payee->find('list');
		$banks = $this->PaymentRequestCheque->Bank->find('list');
		$this->set(compact('paymentRequests', 'payees', 'banks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentRequestCheque->exists($id)) {
			throw new NotFoundException(__('Invalid payment request cheque'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentRequestCheque->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request cheque has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request cheque could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentRequestCheque.' . $this->PaymentRequestCheque->primaryKey => $id));
			$this->request->data = $this->PaymentRequestCheque->find('first', $options);
		}
		$paymentRequests = $this->PaymentRequestCheque->PaymentRequest->find('list');
		$payees = $this->PaymentRequestCheque->Payee->find('list');
		$banks = $this->PaymentRequestCheque->Bank->find('list');
		$this->set(compact('paymentRequests', 'payees', 'banks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentRequestCheque->id = $id;
		if (!$this->PaymentRequestCheque->exists()) {
			throw new NotFoundException(__('Invalid payment request cheque'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentRequestCheque->delete()) {
			$this->Session->setFlash(__('The payment request cheque has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment request cheque could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function issued_cheques(){ 
		$status = $this->params['url']['status'];
		$cheques = $this->PaymentRequestCheque->find('all',[
			'conditions'=>[
				'PaymentRequestCheque.status'=>'released',
				'PaymentRequestCheque.bank_clearing'=>$status]]); 
			
		$this->set(compact('cheques','status')); 
		
	}
	
	public function issued_cheques_process(){
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $id = $data['id'];  
              
            $this->PaymentRequestCheque->id = $id;
            $this->PaymentRequestCheque->set(array(
                'bank_clearing' => 'cleared', 
            )); 
            if ($this->PaymentRequestCheque->save()) {
                return (json_encode($id));
            } else {
                echo json_encode('invalid data');
            }
            exit;
        }
		
	}

	public function pdc_calendar(){
// 		$cheques = $this->PaymentRequestCheque->find('all',[
// 			'conditions'=>['PaymentRequestCheque.status'=>'released']
// 			]);
// 		// pr($cheques);
// 		foreach($cheques as $cheque){
// 			$events[]= [ 
// 				'title'=> $cheque['Payee']['name'],
// 				'start'=> $cheque['PaymentRequestCheque']['cheque_date'],
// 				// 'end'=> $cheque['PaymentRequestCheque']['cheque_date'], 
// 				'className'=>'purple'
// 				];
// 		}
		
// $var = json_encode($events);
// 		$this->set(compact('var')); 
	}
	public function get_issued_cheques_calendar(){
        $this->autoRender = false;
        $this->response->type('json');
		$cheques = $this->PaymentRequestCheque->find('all',[
			'conditions'=>['PaymentRequestCheque.status'=>'released']
			]);
		// pr($cheques);
		// $total = 0;
		$json_dates =[];
		foreach($cheques as $cheque){

			if($cheque['PaymentRequestCheque']['bank_clearing'] == 'pending'){
				$classname_color = 'mint';
			}else if($cheque['PaymentRequestCheque']['bank_clearing'] == 'cleared'){
				$classname_color = 'primary';
			}else{
				$classname_color = 'purple';
			}
			// $json[]= [ 
			// 	'title'=> 'Total: ',
			// 	'start'=> 'sdsdf',
			// 	'url' => 'sdfsdf',
			// 	'className'=>'dark'
			// 	];
			$json[]= [ 
				'id' => $cheque['PaymentRequestCheque']['payment_request_id'],
				'title'=> $cheque['Payee']['name'],
				'start'=> $cheque['PaymentRequestCheque']['cheque_date'],
				'url'=> '/payment_requests/view?id='.$cheque['PaymentRequestCheque']['payment_request_id'].'', 
				'className'=>$classname_color	
				]; 

				// $total = $total + $cheque['PaymentRequest']['released_amount'];

		// array_push(array_unique($json_dates, $cheque['PaymentRequestCheque']['cheque_date']));

    if(!in_array($cheque['PaymentRequestCheque']['cheque_date'], $json_dates, true)){
        array_push($json_dates, $cheque['PaymentRequestCheque']['cheque_date']);
    }
		}
$ct = 0;
		foreach($json_dates as $jdate){

		$cheq = $this->PaymentRequestCheque->find('all',[
			'contain'=>'PaymentRequest',
			'conditions'=>[
				'PaymentRequestCheque.status'=>'released',
				'PaymentRequestCheque.cheque_date'=>$jdate, 
				],
			'fields'=>['SUM(PaymentRequest.requested_amount) AS gtotal']
			]);

		// array_sum

		// foreach ($cheq as $key) {

			$json[]= [ 
				'title'=> 'Total: '.number_format($cheq[0][0]['gtotal'],2),
				'start'=> $jdate, 
				'className'=>'dark'
				]; 

// var_dump($cheq);
		// } 

// // array_merge($jdate,$cheq['gtotal']);
// 			return json_encode($cheq[0][0]['gtotal']);
		// return json_encode(array_merge($jdate,$cheq['gtotal']));
        // array_push($json_dates, $cheque['PaymentRequestCheque']['cheque_date']);

		}
		
			// $json[]= [ 
			// 	'title'=> 'Total: ',
			// 	'start'=> number_format($total,2),
			// 	'className'=>'dark'
			// 	];
			return json_encode($json);
		

    // $this->set('json', json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG));
    // $this->set('_serialize', ['json']);
	}
	public function check_existing() {
		$this->autoRender = false;
		$cheque_number = $this->request->data;
		if(!empty($this->PaymentRequestCheque->findByChequeNumber($cheque_number))) {
			return "yes";
		}
		else {
			return "no";
		}
	}
}
