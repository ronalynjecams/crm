<?php

App::uses('Controller', 'Controller');
App::import("Vendor","Util/util");

//session_start();
//ob_start();
class AppController extends Controller {

    public $uses = ['User'];
    public $components = array(
        'RequestHandler',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'complete_profile'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
//                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'bootstrap';
        $this->Auth->allow('get_status','load_image','get_product_subcategory','subcat','get_product','index','logout', 'login', 'social_login','social_endpoint', 'adding');

        $this->set('authUser', $this->Auth->user());
        $this->set('UserIn', $this->Auth->user());
        $this->set('userID', $this->Auth->user('id'));
        $this->set('userRole', $this->Auth->user('role'));
        $this->set('userDepartmentId', $this->Auth->user('department_id'));
        
		$img_pp = $this->Auth->user('picture');
		if(!empty($img_pp)){
		    $f = "/img/product-uploads/".$img_pp;
		    $fullpath = APP.'webroot'.$f;
    		if(file_exists($fullpath)){
    			$this->set('img_pp', $f);
			}else{
			    $this->set('img_pp', '');
			}
	    }
	    else {
		    $this->set('img_pp', '');
	    }
        
        // if($this->Auth->user('role') == 'new'){
        //     return $this->redirect('/users/login?profile=incomplete');
        // }
    }
    
    
    public function convertNumber($number)
	{
	    list($integer, $fraction) = explode(".", (string) $number);
	 
	    $output = "";
	 
	    if ($integer{0} == "-")
	    {
	        $output = "negative ";
	        $integer    = ltrim($integer, "-");
	    }
	    else if ($integer{0} == "+")
	    {
	        $output = "positive ";
	        $integer    = ltrim($integer, "+");
	    }
	 
	    if ($integer{0} == "0")
	    {
	        $output .= "zero";
	    }
	    else
	    {
	        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
	        $group   = rtrim(chunk_split($integer, 3, " "), " ");
	        $groups  = explode(" ", $group);
	 
	        $groups2 = array();
	        foreach ($groups as $g)
	        {
	            $groups2[] = $this->convertThreeDigit($g{0}, $g{1}, $g{2});
	        }
	 
	        for ($z = 0; $z < count($groups2); $z++)
	        {
	            if ($groups2[$z] != "")
	            {
	                $output .= $groups2[$z] . $this->convertGroup(11 - $z) . (
	                        $z < 11
	                        && !array_search('', array_slice($groups2, $z + 1, -1))
	                        && $groups2[11] != ''
	                        && $groups[11]{0} == '0'
	                            ? " "//" and "
	                            : " "//", "
	                    );
	            }
	        }
	 
	        $output = rtrim($output, ", ");
	    }
	 
	    if ($fraction > 0)
	    {
	        // $output .= " point";
	        // for ($i = 0; $i < strlen($fraction); $i++)
	        // {
	        //     $output .= " " . convertDigit($fraction{$i});
	        // }
	        $output .= " and ".(string)$fraction."/100";
	    }
	 
	    return $output;
	}
	 
	public function convertGroup($index)
	{
	    switch ($index)
	    {
	        case 11:
	            return " Decillion";
	        case 10:
	            return " Nonillion";
	        case 9:
	            return " Octillion";
	        case 8:
	            return " Septillion";
	        case 7:
	            return " Sextillion";
	        case 6:
	            return " Quintrillion";
	        case 5:
	            return " Quadrillion";
	        case 4:
	            return " Trillion";
	        case 3:
	            return " Billion";
	        case 2:
	            return " Million";
	        case 1:
	            return " Thousand";
	        case 0:
	            return "";
	    }
	}
	 
	public function convertThreeDigit($digit1, $digit2, $digit3)
	{
	    $buffer = "";
	 
	    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
	    {
	        return "";
	    }
	 
	    if ($digit1 != "0")
	    {
	        $buffer .= $this->convertDigit($digit1) . " Hundred";
	        if ($digit2 != "0" || $digit3 != "0")
	        {
	           // $buffer .= " and ";
	              $buffer .= " ";
	        }
	    }
	 
	    if ($digit2 != "0")
	    {
	        $buffer .= $this->convertTwoDigit($digit2, $digit3);
	    }
	    else if ($digit3 != "0")
	    {
	        $buffer .= $this->convertDigit($digit3);
	    }
	 
	    return $buffer;
	}
	 
	public function convertTwoDigit($digit1, $digit2)
	{
	    if ($digit2 == "0")
	    {
	        switch ($digit1)
	        {
	            case "1":
	                return "Ten";
	            case "2":
	                return "Twenty";
	            case "3":
	                return "Thirty";
	            case "4":
	                return "Forty";
	            case "5":
	                return "Fifty";
	            case "6":
	                return "Sixty";
	            case "7":
	                return "Seventy";
	            case "8":
	                return "Eighty";
	            case "9":
	                return "Ninety";
	        }
	    } else if ($digit1 == "1")
	    {
	        switch ($digit2)
	        {
	            case "1":
	                return "Eleven";
	            case "2":
	                return "Twelve";
	            case "3":
	                return "Thirteen";
	            case "4":
	                return "Fourteen";
	            case "5":
	                return "Fifteen";
	            case "6":
	                return "Sixteen";
	            case "7":
	                return "Seventeen";
	            case "8":
	                return "Eighteen";
	            case "9":
	                return "Nineteen";
	        }
	    } else
	    {
	        $temp = $this->convertDigit($digit2);
	        switch ($digit1)
	        {
	            case "2": 
	                return "Twenty-$temp";
	            case "3":
	                return "Thirty-$temp";
	            case "4":
	                return "Forty-$temp";
	            case "5":
	                return "Fifty-$temp";
	            case "6":
	                return "Sixty-$temp";
	            case "7":
	                return "Seventy-$temp";
	            case "8":
	                return "Eighty-$temp";
	            case "9":
	                return "Ninety-$temp";
	        }
	    }
	}
	 
	public function convertDigit($digit){
	    switch ($digit)
	    {
	        case "0":
	            return "Zero";
	        case "1":
	            return "One";
	        case "2":
	            return "Two";
	        case "3":
	            return "Three";
	        case "4":
	            return "Four";
	        case "5":
	            return "Five";
	        case "6":
	            return "Six";
	        case "7":
	            return "Seven";
	        case "8":
	            return "Eight";
	        case "9":
	            return "Nine";
	    }
	}
	
	
	public function grand_total(){
		$this->loadModel('Quotation');
		
		// $total = $this->Quotation->find('list', array(
		// 		'fields' => 'grand_total',
		// 		'conditions' => array(
		// 			'OR' => array(
		// 				array('status' => 'approved'),
		// 				'status' => 'processed'
		// 				)
		// 			)
		// 		));
		// $total = $this->Quotation->find('list', array(
		// 		'fields' => 'grand_total',
		// 		'conditions' => array(
		// 			'OR' => array(
		// 				array('status' => 'approved'),
		// 				'status' => 'processed'
		// 				)
		// 			)
		// 		));
				
				
			$total = $this->Quotation->find('list', 
				['fields'=>'grand_total',
				 'conditions'=>
					['OR'=>
						[
							['status'=>'approved'],
							['status'=>'processed'],
							['status'=>'approved_by_proprietor']
						]
					]
				]);
			
			$grand_total = array_sum($total);
			
			// return $grand_total;
			return json_encode($grand_total);
			exit;
	}
	
	
	
	
	public function agent_total($type = null, $user_id = null, $team = null){
		
		$this->loadModel('Quotation');
		$this->loadModel('Team');
		
		if($type == 'yearly'){
		$condition['YEAR(date_moved)'] = date('Y');
		}
		
		if($type == 'monthly'){
		$condition['YEAR(date_moved)'] = date('Y');
		$condition['MONTH(date_moved)'] = date('m');
		}
		
		if($type == 'daily'){
		$condition['YEAR(date_moved)'] = date('Y');
		$condition['MONTH(date_moved)'] = date('m');
		$condition['DAY(date_moved)'] = date('d');
		}
		
		if($team != null){
			$condition['Quotation.team_id'] = $team;
		}
		
		$condition['OR'] = array(
						array('Quotation.status' => 'approved'),
						array('Quotation.status' => 'processed'),
						array('Quotation.status' => 'approved_by_proprietor')
					);
		$condition['Quotation.user_id'] = $user_id;
		
		$total = $this->Quotation->find('first', array(
							'fields' => 'sum(Quotation.grand_total) as grand_total_team',
							'recursive' => -1,
							'conditions' => $condition,
						));
						
		return $total[0]['grand_total_team'];
	}
	
	public function my_monthly_total($user_id){
		$this->loadModel('Quotation');
		
		$total = $this->Quotation->find('list', array(
					'fields' => 'grand_total',
					'recursive' => -1,
					'conditions' => array(
						'MONTH(date_moved)' => date('m'),
						'YEAR(date_moved)' => date('Y'),
						'user_id' => $user_id,
						'OR' =>
						array(
							array('Quotation.status' => 'approved'),
							array('Quotation.status' => 'processed'),
							array('Quotation.status' => 'approved_by_proprietor')
						)
					)
				));
			
		$grand_total = array_sum($total);
		
		return $grand_total;
		exit;
	}
	
	/* CSV Import functionality for all controllers
	*     
	*/
	// function import() {
	//     $modelClass = $this->modelClass;
	//     if ( $this->request->is('POST') ) {
	//         $records_count = $this->$modelClass->find( 'count' );
	//         try {
	//             $this->$modelClass->importCSV( $this->request->data[$modelClass]['CsvFile']['tmp_name']  );
	//         } catch (Exception $e) {
	//             $import_errors = $this->$modelClass->getImportErrors();
	//             $this->set( 'import_errors', $import_errors );
	//             $this->Session->setFlash( __('Error Importing') . ' ' . $this->request->data[$modelClass]['CsvFile']['name'] . ', ' . __('column name mismatch.')  );
	//             $this->redirect( array('action'=>'import') );
	//         }
	         
	//         $new_records_count = $this->$modelClass->find( 'count' ) - $records_count;
	//         $this->Session->setFlash(__('Successfully imported') . ' ' . $new_records_count .  ' records from ' . $this->request->data[$modelClass]['CsvFile']['name'] );
	//         $this->redirect( array('action'=>'index') );
	//     }
	//     $this->set('modelClass', $modelClass );
	//     $this->render('../Common/import');
	// } //end import()
	
	public function count_pending_approved($user_id, $user_role) {
		$ret_quotations = [];
		$this->loadModel('Quotation');
		$this->Quotation->recursive = -1;
		
		$get_quotation_moved = [];
		$get_quotation_pending_accounting = [];
		if($user_role == 'sales_executive') {
			$get_quotation_pending = $this->Quotation->find('all',
				['conditions'=>['status'=>'pending','user_id'=>$user_id],
				 'fields'=>'created']);
			$get_quotation_approved = $this->Quotation->find('all',
				['conditions'=>['OR'=>[['status'=>'approved_by_proprietor'],['status'=>'approved'],['status'=>'processed']],
				 'user_id'=>$user_id],
				 'fields'=>'created']);
		}
		elseif($user_role == 'sales_manager' || $user_role == 'sales_coordinator') {
			$this->loadModel('Team');
	        $user_id = $this->Auth->user('id');
	        $user_role = $this->Auth->user('role');
	        
	        $team_id = 0;
	        $this->Team->recursive = -1;
	        $myteam = $this->Team->findByTeamManager($user_id);
	        if(!empty($myteam)) { $team_id = $myteam['Team']['id']; }
	
			$month = date('F');
	        $year = date('Y');
	        $today = date('F d, Y');
	        
	        $yearly = $this->team_total('yearly', $team_id);
	        $monthly = $this->team_total('monthly', $team_id);
	        $daily = $this->team_total('daily', $team_id);
	        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily',
	                           'myteam'));
	        
	        $this->loadModel('AgentStatus');
	        $get_agent_statuses = $this->AgentStatus->find('all');
	        
	        $this->loadModel('User');
	        $get_users_tmp = $this->User->find('all',
	            ['conditions'=>['active'=>1,
	                            'role'=>'sales_executive']]);
	        
	        $sales_agents = [];          
	        foreach($get_agent_statuses as $ret_agent_statuses) {
	            $agent_status = $ret_agent_statuses['AgentStatus'];
	            $team = $ret_agent_statuses['Team'];
	            $team_sales_manager_id = $team['team_manager'];
	            
	            if($team_sales_manager_id==$user_id) {
	                $sales_agents[] = $agent_status['user_id'];
	            }
	        }
	        
	        $get_users = [];
	        $this->User->recursive = -1;
	        foreach($get_users_tmp as $ret_users_tmp) {
	            $user_tmp = $ret_users_tmp['User'];
	            $ret_users_tmp_id = $user_tmp['id'];
	            
	            if(in_array($ret_users_tmp_id, $sales_agents)) {
	                $get_users[] = $this->User->findById($ret_users_tmp_id);
	            }
	        }
	        
	        $teamsalesagent = [];
	        foreach($get_users as $retusers) {
	        	$userobj = $retusers['User'];
	        	$teamsalesagent[] = $userobj['id'];
	        }
			$get_quotation_pending = $this->Quotation->find('all',
				['conditions'=>['status'=>'pending','user_id'=>$teamsalesagent],
				 'fields'=>['created', 'user_id']
				]);
			$get_quotation_approved = $this->Quotation->find('all',
				['conditions'=>['OR'=>[['status'=>'approved_by_proprietor'],['status'=>'approved'],['status'=>'processed']],
				 'user_id'=>$teamsalesagent],
				 'fields'=>['created','user_id']]);
				 
		}
		elseif($user_role == 'proprietor') {
			$get_quotation_pending = $this->Quotation->find('all',
				[
					'conditions'=>[
							'status'=>'pending'
							],
					'fields'=>'created'
				]);
			$get_quotation_approved = $this->Quotation->find('all',
				[
					'conditions'=>[
							'OR'=>[['status'=>'approved'],['status'=>'processed'],['status'=>'approved_by_proprietor']]
							],
					'fields'=>'created'
				]);
			
			$get_quotation_moved = $this->Quotation->find('all',
				[
					'conditions'=>[
							'status'=>'moved'
							],
					'fields'=>'created'
				]);
			$get_quotation_pending_accounting = $this->Quotation->find('all',
				[
					'conditions'=>[
							'status'=>'approved_by_proprietor'
							],
					'fields'=>'created'
				]);;
		}
		else {
			$ret_quotations = [];
		}
		
		$moved_count = count($get_quotation_moved);
		$pending_accounting = count($get_quotation_pending_accounting);
		$pending_count = count($get_quotation_pending);
		$approved_count = count($get_quotation_approved);
		$ret_quotations = [$pending_count, $approved_count, $get_quotation_pending, $get_quotation_approved,
						   $moved_count, $pending_accounting];

		return $ret_quotations;
	}
	
	public function count_ac_approved($user_role) {
		$this->loadModel('Quotation');
		$this->Quotation->recursive = -1;
		
		if($user_role=="accounting_head") {
			$get_ac_approved = $this->Quotation->find('all',
				['conditions'=>['OR'=>[['status'=>'approved_by_proprietor'],['status'=>'approved'],['status'=>'processed']]],
				 'fields'=>'accounting_approved']);
			$all = $this->Quotation->find('count', 'accounting_approved');
			
			$ac_approved_count = 0;
			foreach($get_ac_approved as $ret_ac_approved) {
				$q_obj = $ret_ac_approved['Quotation'];
				$ac_approved = $q_obj['accounting_approved'];
				
				if($ac_approved!=null || $ac_approved!="") {
					$ac_approved_count++;
				}
			}
			
			return [$ac_approved_count, $all];
		}
	}
	
	public function team_count_quotes($status=NULL, $team_id=NULL){
        $this->autoRender = false;
		$this->loadModel('Quotation');
	    //status == pending || moved
	    //$date_today = date('Y-m-d');
	    $date_compare = '';
	    
	    if(!is_null($status) && !is_null($team_id)){
			 
		    if($status == 'pending'){
		        // $date_compare = 'Quotation.created LIKE';
				$condition['YEAR(Quotation.created)'] = date('Y');
				$condition['MONTH(Quotation.created)'] = date('m');
				$condition['DAY(Quotation.created)'] = date('d');
		    	$condition['status'] = ['pending'];
		    }else{
		    	//$condition['status'] = ['approved_by_proprietor'];
				$condition['YEAR(Quotation.date_moved)'] = date('Y');
				$condition['MONTH(Quotation.date_moved)'] = date('m');
				$condition['DAY(Quotation.date_moved)'] = date('d');
		    	$condition['status'] = ['approved','processed','approved_by_proprietor'];
			}
			
		    	$condition['team_id'] = $team_id;
		    
		    
	        $ccounts = $this->Quotation->find('count',[
	            'conditions'=>[$condition]
	            ]);
	            
		return $ccounts;
	    }
	}
	public function thumbnail($path = null,$w = null,$h = null){
		if(empty($path)){
// 			exit;
            return "";
		}
		// $images = $this->Item->Image->findByItemId($item_id);
		$img = null;
		// if(count($images)>0){
			if($w == null || $h == null){
				$w = 90;
				$h = 90;
			}
				
			$thumb_folder = APP.'webroot'."/img/product-uploads/".$w.'x'.$h.'/';
			$folder = APP.'webroot'."/img/product-uploads/";
			// $f = substr($f,1);
			
			if(!file_exists($thumb_folder)){
				mkdir($thumb_folder);
			}
			$f = $folder.''.$path;
			$fullpath = $f;
			$thumb_fullpath = $thumb_folder.''.$path.'.thumb';
			// $thumbnail = $fullpath';
			if(file_exists($fullpath)){
    				
				if(file_exists($thumb_fullpath)){
					$img = file_get_contents($thumb_fullpath);
				}else{
					make_thumb($fullpath,$thumb_fullpath, $w , $h);
					$img = file_get_contents($thumb_fullpath);
				}
			}
			// else{
			// 	make_thumb($fullpath,$thumb_fullpath,$w == null ? 90 : $w , $h == null ? 90 : $h);
			// 	$img = file_get_contents($thumb_fullpath);
			// 	// return "";
			// }
			//header("Content-Type: image/jpeg");
			return $img;
			// exit;
		// }
		
	}
	
	public function load_image($product){
		$img = $this->thumbnail($product, 400, 519);
				// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
		$imageData = base64_encode($img);

		// // Format the image SRC:  data:{mime};base64,{data};
		$src = 'data: image/jpg;base64,'.$imageData;
// 		echo "ksds";
		// $products[$count]['Product']['image'] = $src;
		// header("Content-Type: image/jpeg");
		return $src;
		// exit;
	} 
	
	public function count_pending_pr($type = null, $status = null){
		$this->autoRender = false;
		$this->loadModel('PaymentRequest');
		$this->PaymentRequest->recursive = -1;
		
		$payment_requests = $this->PaymentRequest->find('all', ['conditions'=>
									['PaymentRequest.type'=>$type,
									 'PaymentRequest.status'=>$status]]);
									 
		return count($payment_requests);
	}
	
	public function count_pending_replenishment(){
		$this->autoRender = false;
		$this->loadModel('PaymentReplenishment');
		$this->PaymentReplenishment->recursive = -1;
		
			$payment_replenishments = $this->PaymentReplenishment->find('all',
				['conditions'=>['acknowledged_date'=>null]]);
				
		return count($payment_replenishments);
	}
	
	
	public function count_quotations($status = null){
		$this->loadModel('Quotation');
		$this->Quotation->recursive = -1;
		
			$quotations = $this->Quotation->find('all',
				['conditions'=>['status'=>$status]]);
				
		return count($quotations);
	}
	
	public function count_product_request($status = null){
		$this->autoRender = false;
		$this->loadModel('TempProduct');
		$this->TempProduct->recursive = -1;
		
			$products = $this->TempProduct->find('all',
				['conditions'=>['status'=>$status]]);
// 			pr($products); exit;	
		return count($products);
	}
	
	public function count_demo(){
		$this->loadModel('ClientService');
		$this->ClientService->recursive = -1;
		
		$role = $this->Auth->user('role');
		$id = $this->Auth->user('id');
		
		if($role=="sales_executive") {
			$client_services = $this->ClientService->find('all', ['conditions'=>
										['status'=>'pending',
										 'agent_id'=>$id]]);
		}
		elseif($role=="supply_purchasing") {
			$client_services = $this->ClientService->find('all', ['conditions'=>
										['status'=>'pending']]);
		}
		else { $client_services=[]; }
									 
		return count($client_services);
	}
	
	public function get_supplier_name($id = null){
    	if($id){
    		$this->loadModel('Supplier');
    		$this->Supplier->recursive = -1;
    		$supplier = $this->Supplier->findById($id);
    		return $supplier['Supplier']['name'];
    	}else{
    		return "";
    	}
    	exit;
    }
    
    
    public function add_api($data = null){
		
		// $data = $this->request->data;
		
		// $data = ['InventoryTransaction' => 
		// 			['id' => 8,'reference_num' => 1, 'reference_type' => 'po', 'type' => 'quotations', 'type_num' => 1],
		// 		'InventoryProductLog' => 
		// 			['inventory_status_id' => 1, 'inventory_transaction_id' => 1],
		// 		'InventoryProductDetail' =>
		// 			['product_combo_id' => 1, 'inv_location_id' => 1, 'inventory_status_id' => 1, 'supplier_id' => 1]
		// 		];
				
		
		$data_details['InventoryProductDetail'] = $data['InventoryProductDetail'];
		unset($data['InventoryProductDetail']);
		
		$inv_trans_id = "";
		$for_commit = [];
		$ds_key = [];
		
		foreach($data as $key => $d){
			$this->loadModel($key);
			// print($key);
			$db_columns = array_keys($this->$key->getColumnTypes());
			$columns = [];
			$options = [];
			$stat = '';
			
			foreach ($d as $k => $value) {
				if(in_array($k, $db_columns)){
					$columns[$k] = $value;
				}
			}
			
			$DS = $this->$key->getDataSource();
			$DS->begin();
			
			if(!array_key_exists('id',$columns)){
				$this->$key->create();
				$stat = 'create';
			}else{
				$inv_trans_id = $columns['id'];
				$stat = 'update';
				
			}
			
			echo 'tansaction '.$inv_trans_id;
			
			if($key == 'InventoryProductLog'){
				if(!array_key_exists('inventory_product_details_id',$columns)){
					foreach($data_details['InventoryProductDetail'] as $k => $value){
						$options['conditions'][$k] = $value;
					}
					$this->loadModel('InventoryProductDetail');
					$this->InventoryProductDetail->recursive = -1;
					$detail = $this->InventoryProductDetail->find('first', $options);
					// echo 'This is detail';
					// pr($detail);
					if($detail){
						if(array_key_exists('inventory_status_id',$columns)){
							// echo "honey";
							// pr($this->get_inv_status($columns['inventory_status_id']));
							$columns['inventory_status_id'] = $this->get_inv_status($columns['inventory_status_id']);
						}
						$columns['inventory_product_details_id'] = $detail['InventoryProductDetail']['id'];
						$data_details = [];
						$data_details['id'] = $detail['InventoryProductDetail']['id'];
						$data_details['inventory_status_id'] = $columns['inventory_status_id'];
						// pr($data_details);
					}
				}
				// echo 'tansaction '.$inv_trans_id;
				// $inv_trans_id = "";
				$columns['inventory_transaction_id'] = ($inv_trans_id!='') ? $inv_trans_id : '';
				
			}
			pr($key);
			pr($columns);
			pr($data);
			pr($options); 
			
			echo $stat;
			$this->$key->set($columns);
			if($this->$key->save()){
				if($key == 'InventoryTransaction' && $stat == 'create'){
					$inv_trans_id = $this->$key->getLastInsertId();
					// $data['InventoryProductLog']['inventory_transaction_id'] = $inv_trans_id;
				}
				
				$columns = [];
				$for_commit[] = $DS;
			}
		}
		
		if(count($for_commit) == count($data)){
			if(!empty($data_details['InventoryProductDetail'])){
			$this->update_inventory($data_details, $for_commit);
			} else{
				$this->process_db($for_commit, 'commit');
				echo 'commited';
			}
		} else{
			$this->process_db($for_commit, 'rollback');
			echo 'rollback';
		}
		
		return "from add api";
		
	}
	
	
	public function update_inventory($conditions = null, $for_commit = null){
		
		$this->loadModel('InventoryProductDetail');
		$DS = $this->InventoryProductDetail->getDataSource();
		$DS->begin();
		$this->InventoryProductDetail->id = $conditions['id'];
		$data = array('InventoryProductDetail.qty'=>'InventoryProductDetail.qty+1');
		
		
		if($this->InventoryProductDetail->updateAll($data)){
			$for_commit[] = $DS;
			$this->process_db($for_commit, 'commit');
		} else{
			$this->process_db($for_commit, 'rollback');
		}
		
		
		return "";
	}
	
	public function process_db($data = null, $process = null){
		
		foreach($data as $DS){
			if($process == 'commit'){
				$DS->commit();
			} else{
				$DS->rollback();
			}
		}
		return "";
	}
	
	public function get_inv_status($status = null){
		$this->autoRender  = false;
    	$ret = 0;
    	
    	$this->loadModel('InventoryStatus');
		$this->InventoryStatus->recursive = -1;
		$status = $this->InventoryStatus->findByName($status, array('id'));
		if($status){
			$ret =  $status['InventoryStatus']['id'];
		}
		
		return $ret;
		// exit;
    }
    
    public function jr_head_count_left_side($status = null) {
    	$this->autoRender  = false;
	    $this->loadModel('JobRequest');
        $jr_head_count_left_side = $this->JobRequest->find('count', array(
	        'conditions' => array('JobRequest.status !=' => $status 
        )));
        
        return $jr_head_count_left_side;
    }
    
    public function moved_quote_count_left_side($status = null) {
    	$this->autoRender  = false;
	    $this->loadModel('Quotation');
        $moved_quote_count_left_side = $this->Quotation->find('count', array(
	        'conditions' => array('Quotation.status' => $status 
	            )));
	    return $moved_quote_count_left_side;
    }
    
    public function edited_quote_count_left_side($status = null) {
    	$this->autoRender  = false;
    	$this->loadModel('Quotation');
	    $edited_quote_count_left_side = $this->Quotation->find('count', array(
	    	'conditions' => array('Quotation.status' => $status // rejected
	        )));
	    return $edited_quote_count_left_side;
    }
    
    public function moved_edited_quote_count_left_side($status = null) {
    	$this->autoRender = false;
    	$this->loadModel('Quotation');
	    $moved_edited_quote_count_left_side = $this->Quotation->find('count', array(
	        'conditions' => array('Quotation.status' => $status
	            )));
    	return $moved_edited_quote_count_left_side;																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															
    }
    
    public function approved_by_proprietor_quote_count_left_side($status = null) {
    	$this->autoRender  = false;
    	$this->loadModel('Quotation');
        $approved_by_proprietor_quote_count_left_side = $this->Quotation->find('count', array(
        'conditions' => array('Quotation.status' => $status //'approved_by_proprietor' 
            )));
        return $approved_by_proprietor_quote_count_left_side;
    }
    
    public function pending_po_raw_request_count_lest_side($status = null) {
    	$this->autoRender  = false;
	    $this->loadModel('PoRawRequest');
        $pending_po_raw_request_count_lest_side =  $this->PoRawRequest->find('count', array(
        'conditions' => array('PoRawRequest.status' => $status 
            )));
        return $pending_po_raw_request_count_lest_side;
    }
    
    public function approved_po_raw_request_count_lest_side($status = null) {
    	$this->autoRender  = false;
    	$this->loadModel('PoRawRequest');
	    $approved_po_raw_request_count_lest_side =  $this->PoRawRequest->find('count', array(
	        'conditions' => array('PoRawRequest.status' => $status 
            )));
        return $approved_po_raw_request_count_lest_side;
    }
    
    public function PendingApproved_count($type = null) {
    	$this->autoRender  = false;
   	$user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $is_authorized=false;
        
        $authorized_users = ['sales_executive', 'sales_manager', 'sales_coordinator', 'proprietor'];
        foreach($authorized_users as $authorized_user) {
        	if($authorized_user==$user_role) {
        		$is_authorized=true;
        	}
        }
        if($is_authorized) {
	        $count_pending_approved = $this->count_pending_approved($user_id, $user_role);
        	$pc = $count_pending_approved[0];
        	$ac = $count_pending_approved[1];
        	$pac_tmp = $pc+$ac;
        	if($pac_tmp!=0) {
        		$pac = $pac_tmp;
        	}
        	else {
        		$pac = 1;
        	}
        	
        	if($type == "pending_count") {
	        	return $this->set('pending_count', number_format((float)($pc/$pac)*100, 2));
        	}
        	elseif($type == "approved_count") {
		        return $this->set('approved_count', number_format((float)($ac/$pac)*100, 2));
        	}
    	}
    	else {
    		return 0;
    	}
   }
   
   public function ac_approved_count() {
   	$this->autoRender  = false;
        $user_role = $this->Auth->user('role');
		if($user_role=="accounting_head") {
			$ac_approved_obj = $this->count_ac_approved($user_role);
	    	$ac = $ac_approved_obj[0];
	    	$all = $ac_approved_obj[1];
	    	if($all!=0) {
	    		$acc = ($ac/$all)*100;
	    	}
	    	else {
	    		$acc = 0;
	    	}
	    	return $this->set('ac_approved_count', number_format((float)$acc,2));
    	}
    	else {
		return 0;
    	}
   }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    $retval = $string ? implode(', ', $string) . ' ago' : 'Just now';
    return date("F d, Y", strtotime($datetime)) .' <br/><small>[ '. $retval .' ]</small>';
}