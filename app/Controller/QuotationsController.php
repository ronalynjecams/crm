<?php
App::uses('AppController', 'Controller');

/**
 * Quotations Controller
 *
 * @property Quotation $Quotation
 * @property PaginatorComponent $Paginator
 */
class QuotationsController extends AppController {

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
		$this->Quotation->recursive = 0;
		$this->set('quotations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Quotation->exists($id)) {
			throw new NotFoundException(__('Invalid quotation'));
		}
		$options = array('conditions' => array('Quotation.' . $this->Quotation->primaryKey => $id));
		$this->set('quotation', $this->Quotation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Quotation->create();
			if ($this->Quotation->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clients = $this->Quotation->Client->find('list');
		$teams = $this->Quotation->Team->find('list');
		$users = $this->Quotation->User->find('list');
//		$jobRequests = $this->Quotation->JobRequest->find('list');
//		$this->set(compact('clients', 'teams', 'users', 'jobRequests'));
		$this->set(compact('clients', 'teams', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
           $this->autoRender = false;
            $data = $this->request->data;  
            $id = $data['id'];
            
            
                $this->Quotation->id = $id; 
                if($this->Quotation->save($data)){
                    echo json_encode($data);
                }else{
                    echo json_encode('invalid data');
                }
                exit;
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
		$this->Quotation->id = $id;  
		if ($this->Quotation->delete()) { 
                    echo json_encode($data);
                } else {
                    echo json_encode($data);
                    }
                    
	}
        
        public function create(){
            
            //every open of this page dapat magsave na kaagad sa db 
            //search muna if my ongoing quotation sa user_id na ito
            $ongoing = $this->Quotation->find('first',array(
                'conditions'=>array(
                    'Quotation.user_id'=>$this->Auth->user('id'),
                    'Quotation.status'=>'ongoing'
                    )));
            
            $this->loadModel('AgentStatus');
            $agentStat = $this->AgentStatus->find('all',array(
                    'conditions'=>array('AgentStatus.user_id'=>$this->Auth->user('id')),
                    'fields' => array('MAX(AgentStatus.id) AS id')
                ));  
            $current_team = $this->AgentStatus->findById($agentStat[0][0]['id']); 
              
            if(count($ongoing)!=0){
                //retrieve data from quotation
                $quote_data = $ongoing;
            }else{ 
                 $terms_information = ' <ol class="terms-and-condition"> <li> <h3>PRICE</h3> <ol> <li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> </li> <li> <h3>AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> </li> <li> <h3>PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol> </li> <li> <h3>DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMS’ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Client’s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol> </li> <li> <h3>WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturer’s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol> </li> <li> <h3>INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <li> <h3>LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol> </li> <li> <h3>PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol> </li> <li> <h3>NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol> </li> </ol> <br> ';
                $dateToday=date("Hymds");
                $milliseconds = round(microtime(true) * 1000);
                $newstring = substr($milliseconds, -3);         
                $quote_number = $newstring.''.$dateToday;    
                
                $quote_exist = $this->Quotation->find('count',array(
                    'conditions'=>array(
                        'Quotation.quote_number'=>$quote_number
                    )));
                
               if($quote_exist == 0){
                   $quote_no = $quote_number;
               }else{ 
                    $news = substr($milliseconds, -4);
                    $quote_no = $news.''.$dateToday;
               }
                
                $this->Quotation->create();
                $this->Quotation->set(array(
                    'quote_number'=>$quote_no,
                    'user_id'=>$this->Auth->user('id'),
                    'status'=>'ongoing',
                    'terms_info'=>$terms_information,
                    'team_id'=>$current_team['AgentStatus']['team_id']
                    ));
                $this->Quotation->save();
                $id = $this->Quotation->getLastInsertID();
//                $quote_data = $this->Quotation->findById($id);
                $quote_data = $this->Quotation->find('first',array(
                    'conditions'=>array('Quotation.user_id'=>$this->Auth->user('id'), 'Quotation.status'=>'ongoing')
                ));
            } 
            $this->set(compact('quote_data'));
            
            $this->loadModel('Client');
            $clients = $this->Client->find('all', array(
                'conditions'=>array('Client.user_id'=>$this->Auth->user('id'), 'Client.lead'=>0)
            ));
            $this->set(compact('clients'));
            
            $this->loadModel('Product'); 
            $products = $this->Product->find('all');
            $this->set(compact('products'));
            
            $this->loadModel('QuotationProduct'); 
            $this->QuotationProduct->recursive = 2;
            $quote_products = $this->QuotationProduct->find('all',array(
                'conditions'=>array('QuotationProduct.quotation_id'=>$quote_data['Quotation']['id'])
            ));
            $this->set(compact('quote_products'));
            
            
//            pr($quote_products);exit;
            $this->set(compact('quote_number'));
            
        }
        
        public function maps(){
            
        }
        
        public function saveCreateQuotation(){ 
            $this->autoRender = false;
            $data = $this->request->data; 
            $id = $data['id'];
            $Qfield = $data['Qfield'];
            $value = $data['value'];
            
            
                $this->Quotation->id = $id;
                $this->Quotation->set(array( 
                     $Qfield => $value,
                        ));
                if($this->Quotation->save()){
                    echo json_encode($data);
                }else{
                    echo json_encode('invalid data');
                }
                exit;
        } 
        
        public function saveAddressQuotation(){ 
            
            $this->autoRender = false;
            $data = $this->request->data; 
            
            $id = $data['id'];
            $address = $data['address'];
            $geolocation = $data['geolocation'];
            $latitude = $data['latitude'];
            $longitude = $data['longitude'];
            $type = $data['type'];
            
            if($type == 'bill_ship'){
                $bill_ship_address = 1;
                if(is_null($address)){
                    $B_address = NULL;
                }else{
                    $B_address = $address;
                }
                $this->Quotation->id=$id;
                $this->Quotation->set(array(
                    'bill_ship_address'=>$bill_ship_address,
                    'bill_address'=>$B_address,
                    'bill_geolocation'=>$geolocation,
                    'bill_latitude'=>$latitude,
                    'bill_longitude'=>$longitude,
                    'ship_address'=>$B_address,
                    'ship_geolocation'=>$geolocation,
                    'ship_latitude'=>$latitude,
                    'ship_longitude'=>$longitude
                ));
                if($this->Quotation->save()){ 
                    echo json_encode($data);
                } 
            }else if($type == 'bill'){
                $bill_ship_address = 0;
                if(is_null($address)){
                    $B_address = NULL;
                }else{
                    $B_address = $address;
                }
                $this->Quotation->id=$id;
                $this->Quotation->set(array(
                    'bill_ship_address'=>$bill_ship_address,
                    'bill_address'=>$B_address,
                    'bill_geolocation'=>$geolocation,
                    'bill_latitude'=>$latitude,
                    'bill_longitude'=>$longitude 
                ));
                if($this->Quotation->save()){ 
                    echo json_encode($data);
                } 
            } else if($type == 'ship'){
                $bill_ship_address = 0;
                if(is_null($address)){
                    $B_address = NULL;
                }else{
                    $B_address = $address;
                }
                $this->Quotation->id=$id;
                $this->Quotation->set(array(
                    'bill_ship_address'=>$bill_ship_address,
                    'ship_address'=>$B_address,
                    'ship_geolocation'=>$geolocation,
                    'ship_latitude'=>$latitude,
                    'ship_longitude'=>$longitude
                ));
                if($this->Quotation->save()){ 
                    echo json_encode($data);
                } 
            } 
            
            exit;
        }
        
        public function product_info(){ 
            $this->autoRender = false;
            $this->response->type('json'); 
            if( $this->request->is('ajax') ) { 
                $id = $this->request->query['id']; 
                 $this->loadModel('Product');
		$this->Product->recursive = 2;
                $product = $this->Product->findById($id); 
                    return (json_encode($product)); 
                     exit;
               }
        }
        
        public function pending(){ 
            if($this->Auth->user('role') == 'sales_executive'){ 
                $this->Quotation->recursive = 2;
		$options = array('conditions' => array('Quotation.user_id'=>$this->Auth->user('id'), 'Quotation.status' => 'pending'));
		$this->set('pending_quotations', $this->Quotation->find('all', $options));
            } 
        }
        
}
