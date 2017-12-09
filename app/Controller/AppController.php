<?php

App::uses('Controller', 'Controller');

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
        $this->Auth->allow('add', 'view', 'logout', 'login', 'social_login','social_endpoint');

        $this->set('authUser', $this->Auth->user());
        $this->set('userID', $this->Auth->user('id'));
        $this->set('userRole', $this->Auth->user('role'));

//		if($this->Auth->user('id')) { 
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
        $this->set('UserIn', $this->User->find('first', $options));
//                }
        //count pending and revised job requests group by job_request_id
//                where status != ongoing and !=accomplished
        $this->loadModel('JobRequest');
        $jr_head_count_left_side = $this->JobRequest->find('count', array(
        'conditions' => array('JobRequest.status !=' => 'pending' 
            )));
        $this->set(compact('jr_head_count_left_side'));  
        
        $this->loadModel('Quotation');
        $moved_quote_count_left_side = $this->Quotation->find('count', array(
        'conditions' => array('Quotation.status' => 'moved' 
            )));
        $accounting_moved_quote_count_left_side = $this->Quotation->find('count', array(
        'conditions' => array('Quotation.status' => 'accounting_moved' 
            )));
        $this->set(compact('moved_quote_count_left_side','accounting_moved_quote_count_left_side'));  
        
//        if($this->Auth->user('role') == 'new'){
//            return $this->redirect('/users/login?profile=incomplete');
//        }
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

}
