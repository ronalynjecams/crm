<?php

App::uses('AppController', 'Controller');
//App::import('Vendor','Mpdf');

/**
 * JobRequests Controller
 *
 * @property JobRequest $JobRequest
 * @property PaginatorComponent $Paginator
 */
class JobRequestsController extends AppController {

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
        $this->JobRequest->recursive = 0;
        $this->set('jobRequests', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $params = array(
            'download' => false,
            'name' => 'example.pdf',
            'paperOrientation' => 'portrait',
            'paperSize' => 'legal'
        );
        $this->set($params);
    }

//        if (!$this->JobRequest->exists($id)) {
//            throw new NotFoundException(__('Invalid job request'));
//        }
//        $options = array('conditions' => array('JobRequest.' . $this->JobRequest->primaryKey => $id));
//        $this->set('jobRequest', $this->JobRequest->find('first', $options));
//    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->JobRequest->create();
            if ($this->JobRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The job request has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The job request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $quotations = $this->JobRequest->Quotation->find('list');
        $this->set(compact('quotations'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->JobRequest->exists($id)) {
            throw new NotFoundException(__('Invalid job request'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->JobRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The job request has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The job request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('JobRequest.' . $this->JobRequest->primaryKey => $id));
            $this->request->data = $this->JobRequest->find('first', $options);
        }
        $quotations = $this->JobRequest->Quotation->find('list');
        $this->set(compact('quotations'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->JobRequest->id = $id;
        if (!$this->JobRequest->exists()) {
            throw new NotFoundException(__('Invalid job request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->JobRequest->delete()) {
            $this->Session->setFlash(__('The job request has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The job request could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function saveNewJobRequest() {
        $this->autoRender = false;
        $data = $this->request->data;
        $status = $data['status'];
        $quotation_id = $data['quotation_id'];
        $jr_number = $data['jr_number'];
        $this->loadModel('Quotation');
        $this->JobRequest->create();
        $this->JobRequest->set(array(
            'status' => $status,
            'jr_number' => $jr_number,
        ));
        if ($this->JobRequest->save()) {
            $jr_id = $this->JobRequest->getLastInsertID();
            $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'job_request_id' => $jr_id
            ));
            if ($this->Quotation->save()) {
                echo json_encode($quotation_id);
            }
        }

        exit;
    }

    public function joupdate() {
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('JrProduct');
        $quote_id = $this->params['url']['id'];
        $this->QuotationProduct->recursive = 3;
        $quote_products = $this->QuotationProduct->find('all', array( 
            'conditions' => array(
                'QuotationProduct.quotation_id' => $quote_id, 
                'QuotationProduct.type !=' => 'supply'
                )
        ));
        ///add muna yung mga products na hindi supply sa jrproducts
        if (count($quote_products) != 0) {
            $job_request_id = $quote_products[0]['Quotation']['job_request_id'];
            foreach ($quote_products as $quote_prod) {
                $quotation_product_id = $quote_prod['QuotationProduct']['id'];

                $check = $this->JrProduct->find('all', array(
                    'conditions' => array(
                        'JrProduct.job_request_id' => $job_request_id,
                        'JrProduct.quotation_product_id' => $quotation_product_id
                )));
//           pr(count($check));exit;
                if (count($check) == 0) {
                    $this->JrProduct->create();
                    $this->JrProduct->set(array(
                        'quotation_product_id' => $quotation_product_id,
                        'job_request_id' => $job_request_id,
                        'status' => 'pending'
                    ));
                    $this->JrProduct->save();
                }
            }
            $this->JrProduct->recursive = 3;
            $jr_products = $this->JrProduct->find('all', array(
                'conditions' => array('JrProduct.job_request_id' => $job_request_id)
            ));
        } else {
            $jr_products = 0;
        }


//        pr($jr_products[0]['QuotationProduct']['Product']);exit;
//        
        $this->set(compact('jr_products'));

        $this->set(compact('quote_id'));
//        $quote_data = $this->Quotation->findById($quote_id);
//        $this->set(compact('quote_data'));
//
        $designers = $this->User->find('all', array(
            'conditions' => array(
                'User.department_id' => 5
        )));
        $this->set(compact('designers'));



        $qq = $this->Quotation->findById($quote_id);
        $this->set(compact('qq'));
        $count_floor_plan = $this->JrProduct->find('count', array(
            'conditions' => array('JrProduct.floor_plan_details !=' => NULL, 'JrProduct.job_request_id' => $qq['Quotation']['job_request_id'])));
        $this->set(compact('count_floor_plan'));
    }

    public function quote_product_info() {
        $this->autoRender = false;
        $this->loadModel('JrProduct');
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->JrProduct->recursive = 2;
            $jrprod = $this->JrProduct->findById(15);
            return (json_encode($jrprod));
            exit;
        }
    }

    public function updateJRProduct() {
        $this->loadModel('JrProduct');
        $this->autoRender = false;
        $data = $this->request->data;
        $usr_typ = $data['usr_typ'];
        $select_type = $data['select_type'];
        $userin = $this->Auth->user('id');
        $deadline_date = $data['deadline'];
        $dateToday = date("Y-m-d H:i:s");

        $this->JrProduct->id = $data['id'];
        if ($usr_typ == 'agent') {
            $this->JrProduct->set(array(
                'deadline' => $data['deadline']
            ));
        } else if ($usr_typ == 'design_head') {
            $this->JrProduct->set(array(
                'user_id' => $data['user_id'],
                'date_assigned' => $dateToday
            ));
        }
        if ($this->JrProduct->save()) {
            // return (json_encode($data));
            $this->loadModel('User');
            $design_head = $this->User->find('first', array(
                'conditions' => array(
                    'role' => 'design_head',
                    'active' => 1
                )
            ));

            if ($usr_typ == 'agent') {
                $desc = $this->Auth->user('first_name') . ' added deadline for a product in Job Request';
                $this->loadModel('Notification');
                $exist = $this->Notification->find('all', array(
                    'conditions' => array(
                        'Notification.user_id' => $this->Auth->user('id'),
                        'Notification.for_who' => $design_head['User']['id'],
                        'Notification.title' => 'Job Request'
                    )
                ));
                // if (count($existupdateJRProduct) == 0) {
                    $this->Notification->create();
                    $this->Notification->set(array(
                        'user_id' => $this->Auth->user('id'),
                        'for_who' => $design_head['User']['id'],
                        'title' => 'Job Request',
                        'description' => $desc
                    ));
                    $this->Notification->save();
                // }
                //after save, get active design_head user_id then insert to notifications
                //creator, is the agent currently logged in
                //for_id design_head
            }
            
            // ==============> JR PRODUCT MONITORINGS
            $this->loadModel('JrProductMonitoring');
            $DS_JrProductMonitoring = $this->JrProductMonitoring->getDataSource();
            $DS_JrProductMonitoring->begin();
            $jrproductmonitoring_set = ['user_id'=>$userin,
                                        'type'=>$select_type,
                                        'deadline_date'=>$deadline_date];
            $this->JrProductMonitoring->set($jrproductmonitoring_set);
            if($this->JrProductMonitoring->save()) {
                echo "JrProductMonitoring saved";
                $DS_JrProductMonitoring->commit();
            }
            else {
                echo "ERROR in JrProductMonitoring";
                $DS_JrProductMonitoring->rollback();
            }
            // ==============> END OF JR PRODUCT MONITORINGS
        }
    }

    public function pending() {
        $this->loadModel('JrProduct');
//        $this->JobRequest->recursive =2;
        $this->loadModel('JobRequest');
        $this->loadModel('Quotation');
        $pending_jrs = $this->JobRequest->Quotation->find('all', array(
            'conditions' => array('JobRequest.status' => 'pending'
        )));

        $this->set(compact('pending_jrs'));
    }

    public function saveFloorPlan() {
        $this->loadModel('JrProduct');
        $this->autoRender = false;
        $data = $this->request->data;
        $this->JrProduct->create();
        if ($this->JrProduct->save($data)) {
            echo json_encode($this->JrProduct->getLastInsertId());
        }

        exit;
    }

    public function pending_designer() {
        $this->loadModel('JrProduct');
        $this->loadModel('JobRequest');
        $this->loadModel('Quotation');

        $this->JrProduct->recursive = 2;
        $pending_jrs = $this->JrProduct->find('all', array(
            'conditions' => array('JrProduct.user_id' => $this->Auth->user('id')),
            'group' => array('JrProduct.job_request_id')
        ));
        $this->set(compact('pending_jrs'));
    }

    public function joupdate_designer() {
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('JrProduct');
        $quote_id = $this->params['url']['id'];
        $this->QuotationProduct->recursive = 2;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array(
                'QuotationProduct.quotation_id' => $quote_id, 
                'QuotationProduct.type !=' => 'supply'
                )
        ));
        ///add muna yung mga products na hindi supply sa jrproducts

        $job_request_id = $quote_products[0]['Quotation']['job_request_id'];

        $this->JrProduct->recursive = 2;
        $jr_products = $this->JrProduct->find('all', array(
            'conditions' => array('JrProduct.job_request_id' => $job_request_id,
                'JrProduct.user_id' => $this->Auth->user('id'))
        ));



//        pr($jr_products[0]['QuotationProduct']['Product']);exit;
//        
        $this->set(compact('jr_products'));

        $this->set(compact('quote_id'));
//        $quote_data = $this->Quotation->findById($quote_id);
//        $this->set(compact('quote_data'));
//
        $designers = $this->User->find('all', array(
            'conditions' => array(
                'User.department_id' => 5
        )));
        $this->set(compact('designers'));



        $qq = $this->Quotation->findById($quote_id);
        $this->set(compact('qq'));
//        pr($qq);
        $count_floor_plan = $this->JrProduct->find('count', array(
            'conditions' => array('JrProduct.floor_plan_details !=' => NULL, 'JrProduct.job_request_id' => $qq['Quotation']['job_request_id'])));
        $this->set(compact('count_floor_plan'));
    }

    public function design_product() {
        $this->loadModel('JrProduct');
        $this->loadModel('Quotation');
        $this->JobRequest->recursive = 2;
        $jreqs = $this->JrProduct->find('all',array( 
            'conditions'=>array(
                'JrProduct.user_id'=>$this->Auth->user('id'),
                'JrProduct.status'=>$this->params['url']['type']
            ), 
            'fields'=>array('JrProduct.job_request_id')
        )); 
        
        $arvar = [];
        foreach ($jreqs as $jrprod) {
            if(!in_array($jrprod['JrProduct']['job_request_id'], $arvar, true)){
                array_push($arvar, $jrprod['JrProduct']['job_request_id']);
            }
            // array_push($arvar,$jrprod['JrProduct']['job_request_id']);
        }
        
        $jrprods = $this->JobRequest->find('all',array( 
                'conditions'=>array(
                    'JobRequest.id'=>$arvar,
            ), 
        )); 
        // pr($jrprods);
        
        $this->set(compact('jrprods'));
    }
    
    public function designer_upload(){
        $jrprod_id = $this->params['url']['id'];
        $this->loadModel('JrProduct');
        $this->loadModel('JrUpload');
        $this->JrProduct->recursive=2;
        $data = $this->JrProduct->findById($jrprod_id);
        $this->set(compact('data'));
//        pr($data['QuotationProduct']['Quotation']['id']);
        
        
        $files = $this->JrUpload->findAllByJrProductId($jrprod_id);
        $this->set(compact('files'));
     
    }

    public function head_view() {
        $status = $this->params['url']['status'];
        $this->loadModel('JrProduct');
        // $this->JobRequest->recursive =3;
        $this->loadModel('JobRequest');
        $this->loadModel('Quotation');
        $this->loadModel('QuotationProduct');
        //quotation buda cliet tabi friend thanks :* uki uki
        $this->JobRequest->recursive =2;
        $pending_jrs = $this->JobRequest->find('all', array(
            'conditions' => array('JobRequest.status' => $status,
                                  'JobRequest.created <'=>'2018-05-03'
        )));
        
        // pr($pending_jrs); exit;
        
        $arvar = [];
        foreach ($pending_jrs as $jrs) {
            $count = 0;
            $a = $jrs;
            foreach ($jrs['JrProduct'] as $jrprod) {
                $q_prod_id = $jrprod['quotation_product_id']; 
                $q_prod = $this->QuotationProduct->findById($q_prod_id);
                if($q_prod){
                    if($q_prod['QuotationProduct']['type'] == 'raw' || $q_prod['QuotationProduct']['type'] == 'combination' || $q_prod['QuotationProduct']['type'] == 'customized'){
                        $count += 1;
                    }
                }
            }
            if($count != 0){
                array_push($arvar, $a);
            }
        }
        
        // pr($arvar); exit;
        $this->set(array('pending_jrs' => $arvar));
        $this->set(compact('status'));
    }

    public function add_productions() {
        $this->autoRender = false;
        $data = $this->request->data;
        $qprodid = $data['quotation_product_id'];
        $job_request_product_id = $data['job_request_product_id'];
        $job_request_id = $data['job_request_id'];
        $clientid = $data['client_id'];
        $totalqty = $data['qty'];
        $userin = $this->Auth->user('id');
        
        $production_set = ['quotation_product_id'=>$qprodid,
                           'jr_product_id'=>0,
                           'job_request_product_id'=> $job_request_product_id,
                           'client_id'=>$clientid,
                           'total_qty'=>$totalqty,
                           'status'=>'pending'];
                              
        $this->loadModel('Production');
        $this->loadModel('ProductionLog');
        $this->loadModel('JobRequestProduct');
        $this->loadModel('JobRequestLog');
        
        $DS_Production = $this->Production->getDataSource();
        $DS_ProductionLog = $this->ProductionLog->getDataSource();
        $DS_JrProduct = $this->JobRequestProduct->getDataSource();
        
        $DS_Production->begin();
        $this->Production->create();
        $this->Production->set($production_set);
        
        if($this->Production->save()) {
            echo json_encode("Production saved");
            $production_id = $this->Production->getLastInsertId();
            $ProductionLog_set = ['production_id'=>$production_id,
                                  'production_process_id'=>0,
                                  'production_carpenter_id'=>0,
                                  'type'=>'production',
                                  'status'=>"new",
                                  'user_id'=>$userin];
            $DS_ProductionLog->begin();
            $this->ProductionLog->create();
            $this->ProductionLog->set($ProductionLog_set);
            if($this->ProductionLog->save()) {
                echo json_encode("ProductionLog saved");
                $DS_JrProduct->begin();
                $this->JobRequestProduct->id = $job_request_product_id;
                $this->JobRequestProduct->set(['status'=>'production',
                                               'date_forwarded_production'=>date("Y-m-d H:m:s")]);
                
                if($this->JobRequestProduct->save()) {
                    echo json_encode("JrProduct saved");
                    $job_request_log_set = ['user_id'=>$userin,
                                               'job_request_id'=>$job_request_id,
                                               'job_request_product_id'=>$job_request_product_id,
                                               'status'=>'production',
                                               'activity'=>'Job Request Product - Forwarded to Production',
                                               'quotation_product_id'=>$qprodid];
                    $DS_JobRequestLog = $this->JobRequestLog->getDataSource();
                    $DS_JobRequestLog->begin();
                    $this->JobRequestLog->create();
                    $this->JobRequestLog->set($job_request_log_set);
                    if($this->JobRequestLog->save()) {
                        echo "JobRequestLog saved";
                        $DS_JobRequestLog->commit();
                        $DS_JrProduct->commit();
                        $DS_ProductionLog->commit();
                        $DS_Production->commit();
                    }
                    else {
                        echo "Error in JobRequestLog";
                        $DS_JobRequestLog->rollback();
                        $DS_JrProduct->rollback();
                        $DS_ProductionLog->rollback();
                        $DS_Production->rollback();
                    }
                }
                else {
                    $DS_ProductionLog->rollback();
                    $DS_Production->rollback();
                    return json_encode("Error in updating JrProduct");
                    exit;
                }
            }
            else {
                $DS_Production->rollback();
                return json_encode("Error in saving ProductionLog");
                exit;
            }
        }
        
        return json_encode("Add Productions Done");
        exit;
    }
    ////////////////////// NEW CODES FOR REVISIONS //////////////
    

    public function saveNewJobRequest_newtbl() { 
        $this->autoRender = false;
        
        $this->loadModel('Quotation');
        $this->loadModel('QuotationProduct');
        
        $user_id = $this->Auth->user('id');
        $data = $this->request->data;
        $status = $data['status'];
        $quotation_id = $data['quotation_id'];
        $jr_number = $data['jr_number'];
        echo json_encode($data);
        
        //check if quotation has existing job request,  
        // yung status galing sa view para kapag update quotation,pending;pero kapag add ng job request NEW
        $check_jr_quote = $this->JobRequest->findByQuotationId($quotation_id);
        
        if(count($check_jr_quote) == 0){
            // add job request and job request products   
            $quote = $this->Quotation->find('first',[ 
            'conditions' => ['Quotation.id'=>$quotation_id],
            'fields' => ['Quotation.team_id', 'Quotation.job_request_id', 'Quotation.client_id']
            ]);
            $client_id = $quote['Quotation']['client_id'];
            $team_id = $quote['Quotation']['team_id']; // this should come from quotation team_id  
            
            $this->JobRequest->create();
            $this->JobRequest->set(array(
                'status' => $status,
                'team_id' => $team_id,
                'jr_number' => $jr_number,
                'client_id' => $client_id,
                'user_id' => $user_id,
                'quotation_id' => $quotation_id,
            ));
            if ($this->JobRequest->save()) {
                echo "-JobRequest saved-";
                $jr_id = $this->JobRequest->getLastInsertId();
                $this->Quotation->id = $quotation_id;
                $this->Quotation->set(array('job_request_id' => $jr_id));
                if ($this->Quotation->save()) {
                    echo "-Quotation saved-";
                    //add job request product here 
                    echo $this->save_job_request_product($quotation_id, $jr_id, $client_id); 
                }
                else { echo "-Error in Quotation-"; }
            }
            else { echo "-Error JobRequest-"; }
        } else{
            echo "-JR existing-";
            // add product to existing job request 
            $client_id = $check_jr_quote['JobRequest']['client_id'];
            $team_id = $check_jr_quote['JobRequest']['team_id']; // this should come from quotation team_id
            $jr_id = $check_jr_quote['JobRequest']['id'];
            
            $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array('job_request_id' => $jr_id));
            if ($this->Quotation->save()) {
                echo "-Quotation saved-";
                //add job request product here 
                echo $this->save_job_request_product($quotation_id, $jr_id, $client_id); 
            }
            else { echo "-Error in Quotation-"; }
        }  
        
        return "-Executed everything-";  
    }
    
    public function save_job_request_product($quotation_id=NULL, $job_request_id=NULL, $client_id=NULL){
        $this->autoRender = false;

        $this->loadModel('QuotationProduct');
        $this->loadModel('JobRequestProduct');
        $this->loadModel('JobRequestLog');
        
        $user_id = $this->Auth->user('id');
        
        //get quotation product from quotation
        $quoted_products = $this->QuotationProduct->find('all',[
            'conditions'=>[
                'QuotationProduct.quotation_id' => $quotation_id,
                "NOT" => ['QuotationProduct.type' => 'supply'],
                'QuotationProduct.deleted'=>null
                ]
            ]); 
            
        foreach($quoted_products as $quoted_product) {
            //check if quotation product already exists in job request product and is not deleted, if not insert
            $check_quoted_product = $this->JobRequestProduct->find('all',[
                'conditions' => ['JobRequestProduct.quotation_product_id'=>$quoted_product['QuotationProduct']['id'],
                                 'JobRequestProduct.date_deleted'=>null]
            ]);
            echo json_encode($check_quoted_product);
            // if(is_null($check_quoted_product)){
            if(count($check_quoted_product) == 0) {
                echo "Check Quoted Product == 0";
                //insert to job request
                $this->JobRequestProduct->create();
                $this->JobRequestProduct->set(array(
                    'quotation_product_id'=>$quoted_product['QuotationProduct']['id'],
                    'user_id'=>$user_id,
                    'client_id'=>$client_id,
                    'job_request_id'=>$job_request_id,
                    'status'=>'new',
                    'product_id'=>$quoted_product['QuotationProduct']['product_id'],
                    'quotation_id'=>$quotation_id,
                    'image'=>$quoted_product['QuotationProduct']['image']
                ));
                if($this->JobRequestProduct->save()) {
                    echo "-JobRequestProduct added-";
                    //add job request logs
                    $job_request_product_id = $this->JobRequestProduct->getLastInsertId();
                    $this->JobRequestLog->create();
                    $this->JobRequestLog->set(array(
                        'user_id'=>$user_id,
                        'job_request_id'=>$job_request_id,
                        'job_request_product_id'=>$job_request_product_id,
                        'quotation_product_id'=>$quoted_product['QuotationProduct']['id'], 
                        'status'=>'new',
                        'activity'=>'Job Request Product - ADD', 
                    ));
                    if($this->JobRequestLog->save()){
                        echo "-JobRequestLog saved-";
                    }
                }else{
                    echo "-Error in JobRequestProduct-"; 
                }
            }
            else { echo "-Check quote product != 0-"; }
        }
        
        return "-Executed Everything in Quotation Products-";
    }

    public function all_lists(){
        $status = $this->params['url']['status']; 
        $role = $this->Auth->user('role');
        $my_id = $this->Auth->user('id');
        //design_head
        //designer
        //material_expediter
        //sales_executive
        //sales_manager
        //sales_coordinator
        
        //ACCOMPLISHED ONLY
        //cost_accountant
        //accounting_head
        //proprietor
        //plant_manager
        //production_supervisor
        //quotation_coordinator
        
        if($status == 'accomplished' && ($role=='cost_accountant' || $role=='accounting_head'   || $role=='plant_manager' || $role=='production_supervisor' || $role=='quotation_coordinator' )){
            $job_requests = $this->JobRequest->find('all',[
                'fields'=>['JobRequest.*', 'Client.name', 'Quotation.type', 'Quotation.id', 'Quotation.status', 'User.first_name', 'User.last_name', 'Quotation.quote_number'],
                'conditions'=>['JobRequest.status'=>'accomplished', 'JobRequest.deleted'=>null]
                ]); 
        }else if($role=='sales_executive'){
            $job_requests = $this->JobRequest->find('all',[
                'fields'=>['JobRequest.*', 'Client.name', 'Quotation.type', 'Quotation.id', 'Quotation.status', 'User.first_name', 'User.last_name', 'Quotation.quote_number'],
                'conditions'=>[
                    'JobRequest.status'=>$status,
                    'JobRequest.user_id'=>$my_id, 'JobRequest.deleted'=>null
                    ]
                ]); 
        }else if($role=='sales_manager'){
            
            $this->loadModel('Team'); 
            
            $manager = $this->Team->find('first',
                ['conditions'=>['Team.team_manager'=>$my_id]]
            );
            
            $my_team_id = $manager['Team']['id']; 
            
                                
                $job_requests = $this->JobRequest->find('all',[
                    'fields'=>['JobRequest.*', 'Client.name', 'Quotation.type', 'Quotation.status', 'User.first_name', 'User.last_name', 'Quotation.quote_number'],
                    'conditions'=>[
                        'JobRequest.status'=>$status,
                        'JobRequest.team_id'=>$my_team_id, 'JobRequest.deleted'=>null
                        ]
                    ]); 
        }else{
            if($role=="design_head") {
                $job_requests = $this->JobRequest->find('all',[
                    'fields'=>['JobRequest.*', 'Client.name', 'Quotation.type', 'Quotation.status', 'Quotation.quote_number', 'User.first_name', 'User.last_name'],
                    'conditions'=>['JobRequest.status'=>$status, 'DATE(JobRequest.created) >='=>'2018-05-03',
                                   'JobRequest.deleted'=>null]
                    ]);
            }
            else {
                $getJobRequest = $this->JobRequest->find('all', ['id']);
                $All_Designer_ID = [];
                foreach($getJobRequest as $retJobRequest) {
                    $job_request_id = $retJobRequest['JobRequest']['id'];
                    $this->loadModel('JobRequestProduct');
                    $getJobRequestProducts = $this->JobRequestProduct->find('all',
                        ['conditions'=>['JobRequestProduct.job_request_id'=>$job_request_id],
                         'fields'=>['JobRequestProduct.id']]);
                    
                    foreach($getJobRequestProducts as $retJobRequestProducts) {
                        $JobRequestProducts = $retJobRequestProducts['JobRequestProduct'];
                        $JobRequestAssignments = $retJobRequestProducts['JobRequestAssignment'];
                        
                        foreach($JobRequestAssignments as $JobRequestAssignment) {
                            $ass_id = $JobRequestAssignment['id'];
                            $designer_id = $JobRequestAssignment['designer'];
        
                            $All_Designer_ID[$job_request_id][] = $designer_id;
                        }
                    }
                }
        
                $Designer_validation = [];        
                $userin = $this->Auth->user('id');
                
                foreach($All_Designer_ID as $key => $ids) {
                    if(in_array($userin, $ids)) {
                        $Designer_validation[] = $key;
                    }
                }
                
                $job_requests = $this->JobRequest->find('all',[
                    'fields'=>['JobRequest.*', 'Client.name', 'Quotation.type', 'Quotation.status', 'Quotation.quote_number', 'User.first_name', 'User.last_name'],
                    'conditions'=>['JobRequest.id'=>$Designer_validation,
                                   'JobRequest.status'=>$status,
                                   'DATE(JobRequest.created) >='=>'2018-05-03',
                                   'JobRequest.deleted'=>null]
                    ]);
            }
        } 
        
        $this->set(compact('status', 'job_requests'));
    }
    
    public function view_jr() {
        $id = $this->params['url']['id'];
        $getJobRequest = $this->JobRequest->findById($id);
        
        // TYPE JRP [ J O B  R E Q U E S T  P R O D U C T ]
        // ====================================================================>
        $this->loadModel('JobRequestProduct');
        $this->loadModel('QuotationProductProperty');

        $getJRProduct = $this->JobRequestProduct->findAllByJobRequestId($id);
        
        $this->loadModel('User');
        
        $Designers = [];
        foreach($getJRProduct as $retJRProduct) {
            $JobRequestAssignments = $retJRProduct['JobRequestAssignment'];
            foreach($JobRequestAssignments as $JobRequestAssignment) {
                $JobRequestAssignment_id = $JobRequestAssignment['id'];
                $JobRequestAssignment_designer = $JobRequestAssignment['designer'];
                $this->User->recursive = -1;
                $getDesigners = $this->User->findById($JobRequestAssignment_designer,
                                ['id', 'first_name', 'last_name']);
                
                $Designers[$JobRequestAssignment_id] = $getDesigners;
            }
        }
        
        $QuotationProductProperties = [];
        foreach($getJRProduct as $retJRProduct) {
            $QuotationProduct = $retJRProduct['QuotationProduct'];
            $QuotationProduct_id = $QuotationProduct['id'];
            
            $QuotationProductProperties[$QuotationProduct_id] = $this->QuotationProductProperty->
                                            findAllByQuotationProductId($QuotationProduct_id,
                                                ['QuotationProductProperty.id',
                                                 'QuotationProductProperty.property',
                                                 'QuotationProductProperty.value',
                                                 'QuotationProduct.id',
                                                 'QuotationProduct.other_info']);
        }
        // ====================================================================>
        // END OF TYPE JRP [ J O B  R E Q U E S T  P R O D U C T ]
        
        
        // TYPE FP [ F L O O R  P L A N ]
        // ====================================================================>
        $this->loadModel('JobRequestFloorplan');
        $getJobRequestFloorplan = $this->JobRequestFloorplan->findAllByJobRequestId($id);
        $FP_Designers = [];
        foreach($getJobRequestFloorplan as $retJobRequestFloorplan) {
            $FPAssignments = $retJobRequestFloorplan['JobRequestAssignment'];
            foreach($FPAssignments as $FPAssignment) {
                $FPAssignments_id = $FPAssignment['job_request_floorplan_id'];
                $FPAssignment_designer = $FPAssignment['designer'];
                $this->User->recursive = -1;
                $FP_getDesigners = $this->User->findById($FPAssignment_designer,
                                ['id', 'first_name', 'last_name']);
                
                $FP_Designers[$FPAssignments_id] = $FP_getDesigners;
            }
        }
        // ====================================================================>
        // END OF TYPE FP [ F L O O R  P L A N ]
        
        
        // FOR MODAL
        // ====================================================================>
        $this->loadModel('JobRequestType');
        $JobRequestTypes = $this->JobRequestType->find('all', ['order'=>['name'=>'asc']]);
        // ====================================================================>
        // END OF MODAL
        $this->set(compact('getJobRequest', 'getJRProduct', 'Designers', 'FP_Designers',
                           'QuotationProductProperties', 'getJobRequestFloorplan',
                           'JobRequestTypes'));
    }
}