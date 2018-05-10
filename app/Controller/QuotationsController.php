<?php
// App::uses('CakeTime', 'Utility');
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
    public $components = array('Paginator', 'Mpdf.Mpdf');

    /**
     * index method
     *
     * @return void
     */
     
    
     
    public function index() {
        $this->Quotation->recursive = -1;
        $this->set('quotations', $this->Paginator->paginate());
        $this->set('_serialize', array('quotations'));
        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view() {
//        $this->loadModel('QuotationProduct');
//
//        $qprod = $this->QuotationProduct->findById(10);
//        pr($qprod);
//        error_reporting(0);
        $id = $this->params['url']['id'];
        $this->Quotation->recursive = 2;
        $quote_data = $this->Quotation->findById($id);
        $quote_number = "";
        if(!empty($quote_data)) {
            $quote_number = $quote_data['Quotation']['quote_number'];
        }
        $this->set(compact('quote_data'));
        
        // pr($quote_data);

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));

        $this->loadModel('DeliveryPaper');
        $delivery_papers = $this->DeliveryPaper->findAllByQuotationId($id);
        
        
        $this->loadModel('DrPaper');
        $drpapers = $this->DrPaper->find('all');
        $this->set(compact('drpapers','delivery_papers'));


        $this->set(compact('clients'));

        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products'));

        $this->loadModel('QuotationProduct');
        $this->QuotationProduct->recursive = 2;
        if ($this->Auth->user('role') != 'supply_staff') {
            $quote_products = [];
            if(!empty($quote_data)) {
                $quote_products = $this->QuotationProduct->find('all',
                    ['conditions' => ['QuotationProduct.quotation_id' => $quote_data['Quotation']['id']]]);
            }
        } else {
            $quote_products = $this->QuotationProduct->find('all', array(
                'conditions' => array(
                    'QuotationProduct.quotation_id' => $quote_data['Quotation']['id'],
                    'QuotationProduct.type' => array('supply', 'combination')
                )
            ));
        }
        $this->set(compact('quote_products'));

        $this->set(compact('quote_number'));

        $this->loadModel('Collection');
        $collections = $this->Collection->find('all', array(
            'conditions' => array('Collection.quotation_id' => $this->params['url']['id'],
                'Collection.status' => 'verified')
        ));
        $this->set(compact('collections'));
        
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
        
        
        $this->loadModel('CollectionSchedule');
        $CollectSched = $this->CollectionSchedule->find('first',['conditions'=>[
            'CollectionSchedule.quotation_id'=>$this->params['url']['id'],
            'CollectionSchedule.status'=>'for_collection'
        ]]);
        $this->set(compact('CollectSched'));
        
        $this->loadModel('CollectionPaper');
        $CollectPapers = $this->CollectionPaper->find('all',['conditions'=>[
            'CollectionPaper.quotation_id'=>$this->params['url']['id'],
            'CollectionPaper.status'=>'onhand'
        ]]);
        $this->set(compact('CollectPapers'));
        
        $this->loadModel('DeliverySchedule');
        $DelScheds = $this->DeliverySchedule->find('all',['conditions'=>[
            'DeliverySchedule.reference_number'=>$this->params['url']['id'],
            'DeliverySchedule.reference_type'=>'quotation'
        ]]);
        $this->set(compact('DelScheds'));
        
        
        
        
//        pr($CollectSched);
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

        if($this->Auth->user('role') == 'sales_manager'){
            $this->loadModel('QuotationUpdateLog');
            
            $this->QuotationUpdateLog->create();
            $this->QuotationUpdateLog->set([
                "user_id"=>$this->Auth->user('id'),
                "quotation_id"=>$id
                ]);
            $this->QuotationUpdateLog->save();
        } 

        $this->Quotation->id = $id;
        if ($this->Quotation->save($data)) {
            echo json_encode($data);
        } else {
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

    public function create() {
        $this->loadModel('SubCategory');
        $this->SubCategory->recursive = 0;
        $subcategories = $this->SubCategory->find('all',
            ['conditions'=>['Category.name'=>'SWATCHES'],
                            'fields'=>['SubCategory.id']]);
        $subcategories_array = [];
        foreach($subcategories as $each_subcategories) {
            $subcategories_array[] = $each_subcategories['SubCategory']['id'];
        }
        
        $this->loadModel('Product');
        $this->Product->recursive = -1;
        // $swatches = $this->Product->find('all',
        //     ['conditions'=>['Product.sub_category_id']]);
        
        $swatches = $this->Product->find('all',
            ['conditions'=>['OR'=>[['Product.type' => 'swatches'], ['Product.type' => 'SWATCHES']]]]);
        $this->set(compact('swatches'));
        
        $this->Quotation->recursive = 2;
        $ongoing = $this->Quotation->find('first', array(
            'conditions' => array(
                'Quotation.user_id' => $this->Auth->user('id'),
                'Quotation.status' => 'ongoing'
        )));

        $this->loadModel('AgentStatus');
        $agentStat = $this->AgentStatus->find('all', array(
            'conditions' => array(
                'AgentStatus.user_id' => $this->Auth->user('id'),
                'AgentStatus.date_to' => NULL),
            'fields' => array('MAX(AgentStatus.id) AS id')
        ));
        $current_team = $this->AgentStatus->findById($agentStat[0][0]['id']);
        // pr($current_team);
        if (count($ongoing) != 0) {
            //retrieve data from quotation
            $quote_data = $ongoing;
        } else {
            $terms_information = ' '
                    . '<h3>I. PRICE</h3> '
                    . '<ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> '
                    . '<li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> '
                    . '<li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> '
                    . '</ol> '
                    . '<h3>II. AVAILABILITY OF STOCKS</h3> '
                    . '<ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> '
                    . '</ol> '
                    . '<h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> '
                    . '<li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> '
                    . '<li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> '
                    . '<li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> '
                    . '<li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> '
                    . '</ol>'
                    . '<h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> '
                    . '<li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> '
                    . '<li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMS’ delivery of such items in good order condition.</p></li> '
                    . '<li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> '
                    . '<li><p>In case of delay in the installation due to the Client’s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> '
                    . '<li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> '
                    . '</ol>'
                    . '<h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> '
                    . '<ol> <li><p>A Standard <strong>One (1) Year Manufacturer’s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> '
                    . '<li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> '
                    . '</ol>'
                    . '<h3>VI. INCLUSIONS</h3> '
                    . '<ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> '
                    . '<h3>VII. LIMITATIONS</h3> <ol> '
                    . '<li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> '
                    . '</ol>'
                    . '<h3>VIII. PENALTY</h3> '
                    . '<ol> <li><p>A Penalty of <strong>One Percent (1%) monthly</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> '
                    . '<li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> '
                    . '<li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> '
                    . '<li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> '
                    . '<li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> '
                    . '</ol>'
                    . '<h3>IX. NON - DISCLOSURE</h3> '
                    . '<ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> '
                    . '<li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> '
                    . '</ol><br> ';
            $dateToday = date("Hymds");
            $milliseconds = round(microtime(true) * 1000);
            $newstring = substr($milliseconds, -3);
            $quote_number = $newstring . '' . $dateToday;

            $quote_exist = $this->Quotation->find('count', array(
                'conditions' => array(
                    'Quotation.quote_number' => $quote_number
            )));

            if ($quote_exist == 0) {
                $quote_no = $quote_number;
            } else {
                $news = substr($milliseconds, -4);
                $quote_no = $news . '' . $dateToday;
            }

            $this->Quotation->create();
            $this->Quotation->set(array(
                'quote_number' => $quote_no,
                'user_id' => $this->Auth->user('id'),
                'status' => 'ongoing',
                'terms_info' => $terms_information,
                'team_id' => $current_team['AgentStatus']['team_id']
            ));
            $this->Quotation->save();
            $id = $this->Quotation->getLastInsertID();
//                $quote_data = $this->Quotation->findById($id);
            $quote_data = $this->Quotation->find('first', array(
                'conditions' => array('Quotation.user_id' => $this->Auth->user('id'), 'Quotation.status' => 'ongoing')
            ));
        }
        $this->set(compact('quote_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));
        $this->set(compact('clients'));

        $this->loadModel('Product');
        $products = $this->Product->find('all', array(
            'conditions' => array('Product.type' => array('supply', 'customized', 'combination', 'raw'))
        ));
        $this->set(compact('products'));

        $this->loadModel('QuotationProduct');
        $this->QuotationProduct->recursive = 2;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quote_data['Quotation']['id'], 'QuotationProduct.deleted' => NULL)
        ));
        $this->set(compact('quote_products'));


        $this->set(compact('quote_number'));
        
        $this->loadModel('ClientIndustry');
        $industries = $this->ClientIndustry->find('all');
        $this->set(compact('industries'));
    }

    public function maps() {
        
    }

    public function saveCreateQuotation() {
        $this->autoRender = false;
        $data = $this->request->data;
        $id = $data['id'];
        $Qfield = $data['Qfield'];
        $value = $data['value'];


        $this->Quotation->id = $id;
        $this->Quotation->set(array(
            $Qfield => $value,
        ));
        if ($this->Quotation->save()) {
            echo json_encode($data);
        } else {
            echo json_encode('invalid data');
        }
        exit;
    }

    public function saveAddressQuotation() {

        $this->autoRender = false;
        $data = $this->request->data;

        $id = $data['id'];
        $address = $data['address'];
        $geolocation = $data['geolocation'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $type = $data['type'];

        if ($type == 'bill_ship') {
            $bill_ship_address = 1;
            if (is_null($address)) {
                $B_address = NULL;
            } else {
                $B_address = $address;
            }
            $this->Quotation->id = $id;
            $this->Quotation->set(array(
                'bill_ship_address' => $bill_ship_address,
                'bill_address' => $B_address,
                'bill_geolocation' => $geolocation,
                'bill_latitude' => $latitude,
                'bill_longitude' => $longitude,
                'ship_address' => $B_address,
                'ship_geolocation' => $geolocation,
                'ship_latitude' => $latitude,
                'ship_longitude' => $longitude
            ));
            if ($this->Quotation->save()) {
                echo json_encode($data);
            }
        } else if ($type == 'bill') {
            $bill_ship_address = 0;
            if (is_null($address)) {
                $B_address = NULL;
            } else {
                $B_address = $address;
            }
            $this->Quotation->id = $id;
            $this->Quotation->set(array(
                'bill_ship_address' => $bill_ship_address,
                'bill_address' => $B_address,
                'bill_geolocation' => $geolocation,
                'bill_latitude' => $latitude,
                'bill_longitude' => $longitude
            ));
            if ($this->Quotation->save()) {
                echo json_encode($data);
            }
        } else if ($type == 'ship') {
            $bill_ship_address = 0;
            if (is_null($address)) {
                $B_address = NULL;
            } else {
                $B_address = $address;
            }
            $this->Quotation->id = $id;
            $this->Quotation->set(array(
                'bill_ship_address' => $bill_ship_address,
                'ship_address' => $B_address,
                'ship_geolocation' => $geolocation,
                'ship_latitude' => $latitude,
                'ship_longitude' => $longitude
            ));
            if ($this->Quotation->save()) {
                echo json_encode($data);
            }
        }

        exit;
    }

    public function product_info() {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->loadModel('Product');
            $this->Product->recursive = 2;
            $product = $this->Product->findById($id);
            
            return (json_encode($product));
            exit;
        }
    }
    
    public function product_info2() {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->loadModel('TempProduct');
            $this->TempProduct->recursive = 2;
            $product = $this->TempProduct->findById($id);
            
            return (json_encode($product));
            exit;
        }
    }

    public function delete_lost_pending() {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $id = $data['id'];
            $type = $data['type'];

            $dateToday = date("Y-m-d H:i:s");
            $this->Quotation->id = $id;
            $this->Quotation->set(array(
                'status' => $type,
                'date_deleted_lost' => $dateToday,
                'collection_status'=>'none'
            ));
            if ($this->Quotation->save()) {
                return (json_encode($id));
            } else {
                echo json_encode('invalid data');
            }
            exit;
        }
    }

    public function pending() {
        if ($this->Auth->user('role') == 'sales_executive') {
            $this->Quotation->recursive = 2;
            $options = array('conditions' => array(
                    'Quotation.user_id' => $this->Auth->user('id'),
                    'Quotation.status' => 'pending'),
                'order' => 'Quotation.created DESC');
            $this->set('pending_quotations', $this->Quotation->find('all', $options));
        }
        else {
            $pending_quotations = [];
            $this->set(compact('pending_quotations'));
        }
    }
    
    public function edited() {
        if ($this->Auth->user('role') == 'sales_executive') {
            $this->Quotation->recursive = 2;
            $options = array('conditions' => array(
                    'Quotation.user_id' => $this->Auth->user('id'),
                    'Quotation.status' => 'rejected'),
                'order' => 'Quotation.created DESC');
            $this->set('pending_quotations', $this->Quotation->find('all', $options));
        }
    }
    
    public function pending_ajax() {
        $this->layout = "ajax";
	    $this->modelClass = "Quotation";
	    $this->autoRender = false;    
	    
	    $user_id = $this->Auth->user('id');
	//
	    $model = 'quotations';
	    $columns = array('created', 'type', 'client_id', 'quote_number', 'grand_total', 'job_request_id', 'id');
	    $where = "status = 'pending' && user_id = '$user_id'";
	    
	    $output = $this->Quotation->GetMyData($model, $columns, $where); 
        
        $data = $output['data'];
		$res = [];
		$count = 0;
		foreach($data as $items){
		    $this->loadModel('Client', 'JobRequest');
		    
		    $this->Client->recursive = -1;
		    $client = $this->Client->findById($items[2]);
		    $this->JobRequest->recursive = -1;
		    $jr = $this->JobRequest->findById($items[5]);
		    foreach($items as $key => $item){
		        if($key == 0){
		            $data[$count][$key] = time_elapsed_string($item).'<br/><small>'. date('h:i a', strtotime($item)) . '</small>';
		        }
		        if($key == 3){
		            $data[$count][$key] = $client['Client']['name'].'<br/><small>[' . $item . ']</small>';
		        }
		        if($key == 4){
		            $data[$count][$key] = '&#8369; ' . number_format($item, 2);
		        }
		        if($key == 5){
		            if($item != 0){
		                $data[$count][$key] = '<div class="input-group mar-btm">
                                                <input type="text" class="form-control" placeholder="Name" readonly value="'.$jr['JobRequest']['jr_number'].'">
                                                <span class="input-group-btn"><button class="btn btn-mint add-tooltip jrupdateBtn" data-toggle="tooltip"  data-original-title="View Job Request"  type="button"data-jobrid="' . $items[6] . '"><i class="fa fa-external-link"></i></button></span>
                                            </div>';
		            } else{
		                $data[$count][$key] = '<br/><button  class="btn btn-default  btn-icon  add-tooltip jobRequeBtn" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" data-quoteid="' . $items[6] . '"><i class="fa fa-plus"></i></button>';
		            }
		        }
		        if($key == 6){
		            if($this->Auth->user('role') == 'sales_executive'){
		                $data[$count][$key] = '<button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?"   data-upquoteid="'.$item.'"><i class="fa fa-edit"></i></button>
		                <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Delete Quotation?" data-typo="deleted" data-delquoteid="'.$item.'" data-jrid="'.$jr['JobRequest']['id'].'"><i class="fa fa-window-close"></i> </button>
                        <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Lost Quotation?" data-typo="lost" data-delquoteid="'.$item.'" data-jrid="'.$jr['JobRequest']['id'].'"><i class="fa fa-thumbs-down"></i> </button>';
		            }
		        }
		        unset($data[$count][2]);
		    }
		$count++;    
		}         
		$output['data'] = $data;
	    echo json_encode($output);
	    exit;
    }

    public function update_quotation() {
        // ---------- FOR SWATCHES ---------- //
        $this->loadModel('SubCategory');
        $this->SubCategory->recursive = 0;
        $subcategories = $this->SubCategory->find('all',
            ['conditions'=>['Category.name'=>'SWATCHES'],
                            'fields'=>['SubCategory.id']]);
        $subcategories_array = [];
        foreach($subcategories as $each_subcategories) {
            $subcategories_array[] = $each_subcategories['SubCategory']['id'];
        }
        
        $this->loadModel('Product');
        $this->Product->recursive = -1;
        // $swatches = $this->Product->find('all',
        //     ['conditions'=>['Product.sub_category_id']]);
        
        // $swatches = $this->Product->find('all',
        //     ['conditions'=>['Product.sub_category_id']]);
        
        // $swatches = $this->Product->find('all',
        //     ['conditions'=>['Product.type' => 'raw']]);
        // $this->set(compact('swatches'));
        
        $swatches = $this->Product->find('all',
            ['conditions'=>['OR'=>[['Product.type' => 'swatches'], ['Product.type' => 'SWATCHES']]]]);
        $this->set(compact('swatches'));
        // ---------- END FOR SWATCHED ---------- //
        
        $id = $this->params['url']['id'];
        $this->Quotation->recursive = 2;
        $quote_data = $this->Quotation->findById($id);
        // pr($this->Auth->user('id'));exit;
        if (($this->Auth->user('id') != $quote_data['Quotation']['user_id']) && ($this->Auth->user('role')!= "sales_coordinator") && ($this->Auth->user('role')!= "sales_manager")) {
            return $this->redirect('/users/error_page');
        } else {
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
            $this->QuotationProduct->recursive = 2;
            $quote_products = $this->QuotationProduct->find('all',
                ['conditions' => ['QuotationProduct.quotation_id' => $quote_data['Quotation']['id']]]
            );
            
            $status = $quote_data['Quotation']['status'];
            $this->set(compact('quote_products', 'status'));

            $this->set(compact('quote_number'));
        }
        $this->loadModel('ClientIndustry');
        $industries = $this->ClientIndustry->find('all');
        $this->set(compact('industries'));
    }
    
    public function update_qproduct() {
        $this->autoRender = false;
        $qpid = $this->request->query['pid'];
        $this->loadModel('QuotationProduct');
        
        $qproduct = $this->QuotationProduct->findById($qpid);
        
        // the process below is to return the product property by getting product_id;
        $this->loadModel('ProductProperty');
        $get_pp = [];
        $product_id = $qproduct['Product']['id'];
            
        $get_pp = $this->ProductProperty->findAllByProductId($product_id);
        
        $retval = ["qproduct"=>$qproduct,
                  "prod_property"=>$get_pp];
        return json_encode($retval);
    }

     public function move() {
        $id = $this->params['url']['id'];
        $this->loadModel('Bank');
        $this->loadModel('QuotationTerm');
        $this->loadModel('AgentStatus');
        $this->Quotation->recursive = 2; 
        $quote_data = $this->Quotation->findById($id);
        $uid = $this->Auth->user('id');
        // $quote_data = $this->Quotation->find('all',array(
        //     'conditions' => array('id' => $id)));
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $uid, 'Client.lead' => 0)
        ));


        $banks = $this->Bank->find('all');
        
        $this->QuotationTerm->recursive = -1;
        $terms = $this->QuotationTerm->find('all', ['conditions' => ['name !=' => 'Full Payment']]);
        
        // $terms = $this->QuotationTerm->find('all', array(
        //     'conditions' => array('QuotationTerm.id >=' => 3)
        // ));
        
        //get agent status where date_to is null kasi ibig sabihin yun yung current team nya
        // $this->AgentStatus->recursive = -1; 
        $agent_status = $this->AgentStatus->find('first',
            ['conditions'=>
                ['AgentStatus.date_to'=>NULL],
                ['AgentStatus.user_id'=>$uid]]);
        // pr($agent_status);
        $this->set(compact('clients', 'quote_number', 'banks', 'terms','id','agent_status'));
    }

    public function move_to_purchasing() {
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $this->loadModel('Collection');
        $this->loadModel('Client');

        $q = $this->Quotation->findById($data['quotation_id']);
        $grand_total = $q['Quotation']['grand_total'];


        $dateToday = date("Y-m-d H:i:s");

        if ($data['payment_mode'] == 'cash') {
            $bank_id = 0;
            $amount_paid = $data['amount_paid'];
            $with_held = $data['with_held'];
            $check_number = 0;
            $check_date = NULL;

            $payment = $amount_paid + $with_held;
            $half = $grand_total / 2;

            if ($payment == $half) {
                $type = 'partial';
            } else if ($payment < $half) {
                $type = 'initial';
            } else if ($payment > $half) {
                $type = 'dp';
            } else if ($payment == $grand_total) {
                $type = 'full';
            }


            if ($payment == $grand_total) {
                $term_id = 2;
            } else {
                $term_id = $data['term_id'];
            }
        } else if ($data['payment_mode'] == 'check') {
            $bank_id = $data['bank_id'];
            $amount_paid = $data['amount_paid'];
            $with_held = $data['with_held'];
            $check_number = $data['check_number'];
            $check_date = $data['check_date'];

            $payment = $amount_paid + $with_held;
            $half = $grand_total / 2;

            if ($payment == $half) {
                $type = 'partial';
            } else if ($payment < $half) {
                $type = 'initial';
            } else if ($payment > $half) {
                $type = 'dp';
            } else if ($payment == $grand_total) {
                $type = 'full';
            }



            if ($payment == $grand_total) {
                $term_id = 2;
            } else {
                $term_id = $data['term_id'];
            }
        } else if ($data['payment_mode'] == 'online') {
            $amount_paid = $data['amount_paid'];
            $bank_id = $data['bank_id'];
            $with_held = $data['with_held'];
            $check_number = 0;
            $check_date = NULL;

            $payment = $amount_paid + $with_held;
            $half = $grand_total / 2;

            if ($payment == $half) {
                $type = 'partial';
            } else if ($payment < $half) {
                $type = 'initial';
            } else if ($payment > $half) {
                $type = 'dp';
            } else if ($payment == $grand_total) {
                $type = 'full';
            }


            if ($payment == $grand_total) {
                $term_id = 2;
            } else {
                $term_id = $data['term_id'];
            }
        } else if ($data['payment_mode'] == 'cod') {
            $bank_id = 0;
            $amount_paid = 0;
            $with_held = 0;
            $check_number = 0;
            $check_date = NULL;
            $type = 'none';
            $term_id = 1;
        } else if ($data['payment_mode'] == 'terms') {
            $bank_id = 0;
            $amount_paid = 0;
            $with_held = 0;
            $check_number = 0;
            $check_date = NULL;
            $type = 'none';
            $term_id = $data['term_id'];
        }


        $this->Collection->create();
        $this->Collection->set(array(
            'quotation_id' => $data['quotation_id'],
            'user_id' => $this->Auth->user('id'),
            'payment_mode' => $data['payment_mode'],
            'bank_id' => $bank_id,
            'amount_paid' => $amount_paid,
            'with_held' => $with_held,
            'check_number' => $check_number,
            'check_date' => $check_date,
            'type' => $type,
            'status' => 'unverified',
            
        ));
        $this->Collection->save();


        $this->Client->id = $data['client_id'];
        $this->Client->set(array(
            'tin_number' => $data['tin_number']
        ));
        $this->Client->save();

        $quotation_id = $data['quotation_id'];
        $this->Quotation->id = $quotation_id;
        $this->Quotation->set(array(
            'status' => 'moved',
            'vat_type' => $data['vat_type'],
            'quotation_term_id' => $term_id,
            'delivery_mode' => $data['delivery_mode'],
            'target_delivery' => $data['target_delivery'],
            'date_moved' => $dateToday,
            'advance_invoice' => $data['advance_invoice'],
            'collection_status' => 'undelivered'
        ));
        $this->Quotation->save();




        echo json_encode($data);
    }

    public function approved() {
        if ($this->Auth->user('role') == 'sales_executive') {

            $this->Quotation->recursive = 2;
            $options = array('conditions' => array(
                    'Quotation.user_id' => $this->Auth->user('id'),
                    'Quotation.status' => array('approved', 'processed')),
                'order' => 'Quotation.created DESC');
            $this->set('pending_quotations', $this->Quotation->find('all', $options));
        } else if (($this->Auth->user('role') == 'supply_staff') || ($this->Auth->user('role') == 'supply_head') || ($this->Auth->user('role') == 'purchasing_supervisor')) {
            //kapag my supply or combination na product sa quotation, saka lang lalabas dito sa list ng supply purchasing
//            $this->Quotation->recursive = 2;
//            $options = array('conditions' => array( 
//                    'Quotation.status' => array('approved')), 
//                'order' => 'Quotation.created DESC');
//            $this->set('pending_quotations', $this->Quotation->find('all', $options));
            $this->loadModel('QuotationProduct');
            $this->QuotationProduct->recursive = 2;
            $options = array('conditions' => array(
                    'Quotation.status' => 'approved',
                    // 'QuotationProduct.type' => array('supply', 'combination')
                ),
                'group' => 'QuotationProduct.quotation_id'
            );
            $pending_quotations = $this->QuotationProduct->find('all', $options);

            // pr($pending_quotations); exit;
            $this->set(compact('pending_quotations'));
//            exit;
        } else if (($this->Auth->user('role') == 'raw_head') ) {
            //if with all products except supply saka lang lalabas dito sa list ng supply purchasing 
            $this->loadModel('QuotationProduct');
            $this->QuotationProduct->recursive = 2;
            $options = array('conditions' => array(
                    'Quotation.status' => array('approved','processed'),
                    'QuotationProduct.type !=' => array('supply')
                ),
                'group' => 'QuotationProduct.quotation_id'
            );
            $pending_quotations = $this->QuotationProduct->find('all', $options);

//            pr($pending_quotations);
            $this->set(compact('pending_quotations'));
//            exit;
        }
    }

    public function processed() {

        $this->loadModel('QuotationProduct');
        $this->QuotationProduct->recursive = 2;
        $options = array('conditions' => array(
                'Quotation.status' => 'processed',
                'QuotationProduct.type' => array('supply', 'combination')
            ),
            'group' => 'QuotationProduct.quotation_id'
        );
        $processed_quotes = $this->QuotationProduct->find('all', $options);

//            $options = array('conditions' => array(
//                    'Quotation.status' => 'processed',
////                    'QuotationProduct.type' => array('supply', 'combination')
//                )
////                'group' => 'QuotationProduct.quotation_id'
//            );
//            $processed_quotes = $this->Quotation->find('all', $options);
// pr(count($approved_quotations));
        $this->set(compact('processed_quotes'));
    }

    public function view_supply() {
//        $this->loadModel('QuotationProduct');
//
//        $qprod = $this->QuotationProduct->findById(10);
//        pr($qprod);
        // error_reporting(0);
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
        }
        $this->set(compact('quote_products'));

        $this->set(compact('quote_number'));

        $this->loadModel('Collection');
        $collections = $this->Collection->find('all', array(
            'conditions' => array('Collection.quotation_id' => $this->params['url']['id'],
                'Collection.status' => 'verified')
        ));
        $this->set(compact('collections'));


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
//            pr($poprod);
//        $additional_products = $this->Product->find()
         
    }
    
    public function proprietor() {
        if ($this->Auth->user('role') == 'proprietor' || $this->Auth->user('role') == 'accounting_head' || $this->Auth->user('role') == 'collection_officer' || $this->Auth->user('role') == 'cost_accountant' || $this->Auth->user('department_id') ==  6 ||  $this->Auth->user('department_id') ==  7 ||  $this->Auth->user('department_id') ==  17) {
            $quote_status = $this->params['url']['status'];
            $fields = array_keys($this->Quotation->getColumnTypes());
            $key = array_search('terms_info', $fields);
            unset($fields[$key]);
            $fields[] = 'User.*';
            $fields[] = 'Client.*';
            $fields[] = 'JobRequest.*';
            
            $options = array('conditions' => array( 
                    'Quotation.status' => $quote_status),
                    'contain' => array('User','Collection','Client','JobRequest'),
                    'order' => 'Quotation.created DESC',
                    'fields' => $fields);
            $this->set('quotations', $this->Quotation->find('all', $options));
        } else if($this->Auth->user('role') == 'sales_manager'){
            $this->loadModel('AgentStatus');
            $stats = $this->AgentStatus->find('first',[
                'conditions'=>[
                    'AgentStatus.user_id' => $this->Auth->user('id'),
                    'AgentStatus.date_to' => NULL
                    ]
                ]);
                
            $quote_status = $this->params['url']['status'];
            $fields = array_keys($this->Quotation->getColumnTypes());
            $key = array_search('terms_info', $fields);
            unset($fields[$key]);
            $fields[] = 'User.*';
            $fields[] = 'Client.*';
            
            $options = array('conditions' => array( 
                    'Quotation.status' => $quote_status,
                    'Quotation.team_id'=>$stats['AgentStatus']['team_id']),
                    'contain' => array('User','Collection','Client'),
                    'order' => 'Quotation.created DESC',
                    'fields' => $fields);
            $this->set('quotations', $this->Quotation->find('all', $options));
        }
    }
    
    
    // public function proprietor() {
    //     if ($this->Auth->user('role') == 'proprietor' || $this->Auth->user('role') == 'accounting_head') {
            
    //     $quote_status = $this->params['url']['status'];
    //         $this->Quotation->recursive = 2;
    //         $options = array('conditions' => array( 
    //                 'Quotation.status' => $quote_status),
    //             'order' => 'Quotation.created DESC');
    //         $this->set('quotations', $this->Quotation->find('all', $options));
    //         // pr($this->Quotation->find('all', $options));
    //     } else if($this->Auth->user('role') == 'sales_manager'){
            
    //         $this->loadModel('AgentStatus');
    //         $stats = $this->AgentStatus->find('first',[
    //             'conditions'=>[
    //                 'AgentStatus.user_id' => $this->Auth->user('id'),
    //                 'AgentStatus.date_to' => NULL
                    
    //                 ]
    //             ]);
    //     $quote_status = $this->params['url']['status'];
    //         $this->Quotation->recursive = 2;
    //         $options = array('conditions' => array( 
    //                 'Quotation.status' => $quote_status,
    //                 'Quotation.team_id'=>$stats['AgentStatus']['team_id']
    //                 ),
    //             'order' => 'Quotation.created DESC');
    //         $this->set('quotations', $this->Quotation->find('all', $options));
    //     }
    // }
    
    public function proprietor_approve(){
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $id = $data['id']; 
            $usr = $data['usr']; 
            
            
            
            if($usr == 'proprietor'){
                $dateA = 'date_approved';
                $apprval = 'approved_by';
                $stts = 'approved_by_proprietor'; //   accounting_moved
            }else if($usr == 'accounting'){
                $dateA = 'accounting_approved_date';
                $apprval = 'accounting_approved';
                $stts = 'approved';
            }
             
            $dateToday = date("Y-m-d H:i:s");
            $this->Quotation->id = $id;
            $this->Quotation->set(array(
                'status' => $stts,
                $dateA => $dateToday,
                $apprval => $this->Auth->user('id'),
            )); 
            if ($this->Quotation->save()) {
                return (json_encode($id));
            } else {
                echo json_encode('invalid data');
            }
            exit;
        }
        
    }
    
    
    public function sales_moved() {
    
        $this->Quotation->recursive = 2;
        if($this->Auth->user('role') == 'sales_executive') {
            $pending_quotations = $this->Quotation->find('all',array(
                'conditions'=>[
                    'Quotation.user_id' => $this->Auth->user('id'),
                    'Quotation.status' => 'moved'
                    ]
                ));
                $this->set(compact('pending_quotations'));
            // $options = array('conditions' => array(
            //         'Quotation.user_id' => $this->Auth->user('id'),
            //         'Quotation.status' => 'moved'),
            //     'order' => 'Quotation.created DESC');
            // $this->set('pending_quotations', $this->Quotation->find('all'));
        }
        // if($this->Auth->user('role') == 'supply_staff'
        //   || $this->Auth->user('role') == 'raw_head') {
    if (($this->Auth->user('role') == 'supply_staff') || ($this->Auth->user('role') == 'supply_head') || ($this->Auth->user('role') == 'purchasing_supervisor') || ($this->Auth->user('role') == 'raw_head')) {
       
               
            $pending_quotations = $this->Quotation->find('all',array(
                'conditions'=>[ 
                    'Quotation.status' => 'moved'
                    ]
                ));
                $this->set(compact('pending_quotations'));
            // $options = ['conditions' => ['Quotation.status' => 'moved']];
            // $pending_quotations = $this->Quotation->find('all', $options);
            // $this->set(compact('pending_quotations'));
        }
    }


    public function get_prod_price() {
        $this->autoRender = false;
        $swatch_id = $this->request->data;
        
        $this->loadModel('Product');
        $this->loadModel('ProductProperty');
        $this->loadModel('ProductValue');
        
        $this->ProductProperty->recursive = -1;
        $get_pprop = $this->ProductProperty->find('all',
            ['conditions'=>['product_id'=>$swatch_id],
                'fields'=>['id']]);
                
        $pprop_ids = [];
        foreach($get_pprop as $ret_pprop) {
            $pprop_obj = $ret_pprop['ProductProperty'];
            $pprop_ids[] = $pprop_obj['id'];
        }
        
        $this->ProductValue->recursive = -1;
        $get_pval = $this->ProductValue->find('all',
            ['conditions'=>['product_property_id'=>$pprop_ids],
                'fields'=>['price']]);
                
        $pprice = 0;
        foreach($get_pval as $ret_pval) {
            $pval_obj = $ret_pval['ProductValue'];
            $pprice += $pval_obj['price'];
        }
        
        return $pprice;
    }
    
    public function accounting_moved() {
        $this->Quotation->recursive = 2;
        if($this->Auth->user('role') == 'sales_executive') {
            $get_ac_approved = $this->Quotation->find('all',array(
                'conditions'=>[
                    'Quotation.user_id' => $this->Auth->user('id'),
                    'Quotation.status' => 'approved_by_proprietor'
                    ]
                ));
                $this->set(compact('get_ac_approved')); 
        }
        // if($this->Auth->user('role') == 'supply_staff'
        //   || $this->Auth->user('role') == 'raw_head') {
               if (($this->Auth->user('role') == 'supply_staff') || ($this->Auth->user('role') == 'supply_head') || ($this->Auth->user('role') == 'purchasing_supervisor') || ($this->Auth->user('role') == 'raw_head')) {
     
            $get_ac_approved = $this->Quotation->find('all',array(
                'conditions'=>[ 
                    'Quotation.status' => 'approved_by_proprietor'
                    ]
                ));
                $this->set(compact('get_ac_approved')); 
        
        }
    }

    public function quotations_for_accounting() {
        $status =  $this->params['url']['status'];
        
        
        $fields = array_keys($this->Quotation->getColumnTypes());
            $key = array_search('terms_info', $fields);
            unset($fields[$key]);
            $fields[] = 'User.*';
            $fields[] = 'Client.*';
            $options = array('conditions' => array( 
                    'Quotation.collection_status'=>$status),
                    'contain' => array('User','Collection','Client'),
                'order' => 'Quotation.created DESC',
                'fields' => $fields);
        // $this->Quotation->recursive=2;
        $get_quotations = $this->Quotation->find('all', $options);
        
        $this->set(compact('get_quotations'));
    }
    
    public function updateCollectionStatus(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $quotation_id = $data['quotation_id'];
        $collection_status = $data['collection_status'];
        $collection_remarks = $data['collection_remarks'];  
         
         $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'collection_status' => $collection_status,
                'collection_remarks' => $collection_remarks, 
            ));
            if ($this->Quotation->save()) {
                echo json_encode($data);
            }
        
        
    }
    public function make_processed(){
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
            $dateToday = date("Y-m-d H:i:s");
        
        $quotation_id = $data['id']; 
         
         $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'status' => 'processed',
                'date_processed' => $dateToday, 
            ));
            if ($this->Quotation->save()) {
                echo json_encode($data);
            }
        
    }
    
    public function updatePurchasingStatus(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $quotation_id = $data['quotation_id']; 
        $purchasing_remarks = $data['purchasing_remarks'];  
         
         $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array( 
                'purchasing_remarks' => $purchasing_remarks, 
            ));
            if ($this->Quotation->save()) {
                echo json_encode($data);
            }
    }
    
    public function proprietor_reject(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
            $dateToday = date("Y-m-d H:i:s");
        
        $quotation_id = $data['id']; 
         
         $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'status' => 'rejected', 
            ));
            if ($this->Quotation->save()) {

                    $this->loadModel('QuotationUpdateLog');
                    
                    $this->QuotationUpdateLog->create();
                    $this->QuotationUpdateLog->set([
                        "user_id"=>$this->Auth->user('id'),
                        "quotation_id"=>$quotation_id,
                        "status"=>'rejected'
                        ]);
                    if($this->QuotationUpdateLog->save()){
                        echo json_encode($data);
                    }
            }
    }
    
    public function all_list(){
        
        $quote_status = $this->params['url']['status'];
        
        // if ($this->Auth->user('role') == 'sales_executive' && $quote_status=='pending') {
        //     $this->Quotation->recursive = 2;
        //     $options = array('conditions' => array(
        //             'Quotation.user_id' => $this->Auth->user('id'),
        //             'Quotation.status' => 'pending'),
        //         'order' => 'Quotation.created DESC');
        //     $this->set('quotations', $this->Quotation->find('all', $options));
        // }
        
        
        $this->set(compact('quote_status'));
    }
    
    public function all_list_ajax($quote_status = null) {
        $this->layout = "ajax";
	    $this->modelClass = "Quotation";
	    $this->autoRender = false;  
	    
	    $user_id = $this->Auth->user('id');

	    $model = 'quotations';
	    $columns = array('created', 'type', 'client_id', 'quote_number', 'grand_total', 'job_request_id', 'id');
	     if ($this->Auth->user('role') == 'sales_executive') {
	        $where = "status = '$quote_status' && user_id = $user_id";
	     }else{ 
	       // $where = "status = '$quote_status' && user_id = $user_id";
	     }
	    
	    $output = $this->Quotation->GetMyData($model, $columns, $where); 
	    
        $data = $output['data'];
		$res = [];
		$count = 0;
		foreach($data as $items){
		    $this->loadModel('Client', 'JobRequest');
		    
		    $this->Client->recursive = -1;
		    $client = $this->Client->findById($items[2]);
		    $this->JobRequest->recursive = -1;
		    $jr = $this->JobRequest->findById($items[5]);
		    foreach($items as $key => $item){
		        if($key == 0){
		            $data[$count][$key] = time_elapsed_string($item).'<br/><small>'. date('h:i a', strtotime($item)) . '</small>';
		        }
		        if($key == 3){
		            $data[$count][$key] = $client['Client']['name'].'<br/><small>[' . $item . ']</small>';
		        }
		        if($key == 4){
		            $data[$count][$key] = '&#8369; ' . number_format($item, 2);
		        }
		        if($key == 5){
		            if($item != 0){
		                $data[$count][$key] = '<div class="input-group mar-btm">
                                                <input type="text" class="form-control" placeholder="Name" readonly value="'.$jr['JobRequest']['jr_number'].'">
                                                <span class="input-group-btn"><button class="btn btn-mint add-tooltip jrupdateBtn" data-toggle="tooltip"  data-original-title="View Job Request"  type="button"data-jobrid="' . $items[6] . '"><i class="fa fa-external-link"></i></button></span>
                                            </div>';
		            } else{
		                $data[$count][$key] = '<br/><button  class="btn btn-default  btn-icon  add-tooltip jobRequeBtn" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" data-quoteid="' . $items[6] . '"><i class="fa fa-plus"></i></button>';
		            }
		        }
		        if($key == 6){
		            if($this->Auth->user('role') == 'sales_executive'){
		                $data[$count][$key] = '<button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?"   data-upquoteid="'.$item.'"><i class="fa fa-edit"></i></button>
		                <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Delete Quotation?" data-typo="deleted" data-delquoteid="'.$item.'" data-jrid="'.$jr['JobRequest']['id'].'"><i class="fa fa-window-close"></i> </button>
                        <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Lost Quotation?" data-typo="lost" data-delquoteid="'.$item.'" data-jrid="'.$jr['JobRequest']['id'].'"><i class="fa fa-thumbs-down"></i> </button>';
		            }
		        }
		        unset($data[$count][2]);
		    }
		$count++;    
		}         
		$output['data'] = $data;
	    echo json_encode($output);
	    exit;
    }

    
    public function update_tin() {
        $this->autoRender = false;
        $this->loadModel('QuotationUpdateLog');
        $this->loadModel('Client');
        $data = $this->request->data;
        $userin = $this->Auth->user('id');
        $DS_Quotations = $this->Quotation->getDataSource();
        $DS_Quotations->begin();
        $this->Quotation->id = $data['qid'];
        $this->Quotation->set(['tin_number'=>$data['tin_number']]);
        if($this->Quotation->save()) {
            echo "Quotation saved";
            $quotation_update_log_set = ['user_id'=>$userin,
                                         'quotation_id'=>$data['qid'],
                                         'status'=>"tin_number_update",
                                         'quotation_product_id'=>0,
                                         'tin_number'=>$data['tin_number']];
            $DS_QuotationUpdateLogs = $this->QuotationUpdateLog->getDataSource();
            $DS_QuotationUpdateLogs->begin();
            $this->QuotationUpdateLog->create();
            $this->QuotationUpdateLog->set($quotation_update_log_set);
            if($this->QuotationUpdateLog->save()) {
                echo "QuotationUpdateLog save";
                
                $DS_Client = $this->Client->getDataSource();
                $DS_Client->begin();
                $this->Client->id = $data['client_id'];
                $this->Client->set(['tin_number'=>$data['tin_number']]);
                if($this->Client->save()) {
                    echo "Client saved";
                    $DS_Client->commit();
                    $DS_QuotationUpdateLogs->commit();
                    $DS_Quotations->commit();
                }
                else {
                    echo "Error in Client";
                    $DS_Client->rollback();
                    $DS_QuotationUpdateLogs->rollback();
                    $DS_Quotations->rollback();
                }
            }
            else {
                echo "Error in QuotationUpdateLog";
                $DS_QuotationUpdateLogs->rollback();
                $DS_Quotations->rollback();
            }
        }
        else {
            echo "Error in Quotation";
            $DS_Quotations->rollback();
        }
        return "Everything executed";
    }
    
	public function try2(){
	    $this->loadModel('SupplierProduct');
	    $this->SupplierProduct->recursive = -1;
	    pr($this->SupplierProduct->find('all',
	    							['contain' => ['Supplier' => ['User']]]));
	    							exit;
	    
	}
	
	public function quote_records() {
	    $status = $this->params['url']['status'];
	    
	    $this->Quotation->contain(['Client', 'JobRequest']);
	    $getQuotations = $this->Quotation->find('all',
	        ['conditions'=>
	            ['Quotation.status'=>$status],
	         'fields'=>
	            ['Quotation.id', 'Quotation.created', 'Quotation.type',
	             'Quotation.grand_total', 'Quotation.quote_number',
	             'Quotation.job_request_id', 'Quotation.subject',
	             'Quotation.client_id', 'Client.name',
	             'JobRequest.jr_number', 'JobRequest.created']]);
	    $this->set(compact('status', 'getQuotations'));
	}
}