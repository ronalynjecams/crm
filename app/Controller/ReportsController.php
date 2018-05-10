<?php 
App::uses('AppController', 'Controller'); 
class ReportsController extends AppController { 
    public $components = array('Paginator', 'Mpdf.Mpdf'); 
 
    public function trial(){
        
        $html = 'sdfasdf';
        $this->Mpdf->init();
        $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
            <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px; " align="right">' . date("F d, Y") . '</div><hr/>');
        $this->Mpdf->SetHTMLFooter('<hr/><table style="width: 100%;padding-bottom:-15px;">
                                    <tr>
                                        <td style="text-align: left;width:70%;font-size:10px;">{PAGENO} / {nbpg} </td>
                                        <td style="text-align: right;width: 30%;font-size:10px;">w w w . j e c a m s . c o m . p h</td> 
                                    </tr>
                                </table> ');
        $this->Mpdf->AddPage('L', 
                '', '', '', '', 8,
                8, // margin right
                25, // margin top
                30, // margin bottom
                10, // margin header
                10);

        $this->Mpdf->WriteHTML($html);
        $this->layout = 'pdf';
        $this->render('trial');
        $this->Mpdf->setFilename('trial.pdf');
    }
    
    public function collection_schedule(){ 
        $this->loadModel('CollectionSchedule');
        $this->Mpdf->init();
        
        $start = $this->params['url']['start'];
        $end = $this->params['url']['end'];
        
        $end_view = date('Y-m-d',strtotime($end."- 1 day"));
        $end_compare = date('Y-m-d',strtotime($end."+ 1 day"));
        
        if($start == $end){
            $collection_schedule = 'for  '.date('F d, Y',strtotime($start)) ;
        }else{
            $collection_schedule = ' from '.date('F d, Y',strtotime($start)).' to '.date('F d, Y',strtotime($end)) ;
        }

        $date_today = date('Y-m-d');
        $this->CollectionSchedule->recursive = 3;
        $collection_scheds = $this->CollectionSchedule->find('all',[
            'conditions'=>[
                'CollectionSchedule.collection_date >=' => $start,
                'CollectionSchedule.collection_date <' => $end_compare,
                // // 'CollectionSchedule.collection_date' => $date_today,
                'CollectionSchedule.status !=' => 'cancelled'
            ],
            'fields'=>['CollectionSchedule.collection_date', 'CollectionSchedule.agent_instruction', 'CollectionSchedule.status', 'CollectionSchedule.expected_amount', 'CollectionSchedule.officer_remarks','Quotation.client_id','Quotation.user_id','']
            ]);
            
            // echo pr($collection_scheds);exit;
            $total_expected_amount = 0;
            $ctr = 1;
            foreach($collection_scheds as $collection_sched){
                $collection_date = date('F d, Y', strtotime($collection_sched['CollectionSchedule']['collection_date']));
                $client = $collection_sched['Quotation']['Client']['name'];
                $sales_executive = $collection_sched['Quotation']['User']['first_name'];
                $agent_instruction = $collection_sched['CollectionSchedule']['agent_instruction'];
                $expected_amount = $collection_sched['CollectionSchedule']['expected_amount'];
                $officer_remarks = $collection_sched['CollectionSchedule']['officer_remarks'];
                
                $bill_address = $collection_sched['Quotation']['bill_address'];
                $bill_geolocation = $collection_sched['Quotation']['bill_geolocation'];
                $total_expected_amount = $total_expected_amount + $expected_amount;
                
                $tbody .= "<tr>
                    <td align='center'>".$ctr."</td>
                    <td align='center'>".$collection_date."</td>
                    <td align='center'>".$client."</td>
                    <td align='center'>".$sales_executive."</td>
                    <td align='center'>".$agent_instruction."</td>
                    <td align='right' style='padding-right:10px'> &#8369; ".number_format($expected_amount,2)."</td>
                    <<td align='center'>".$bill_address."  " . $bill_geolocation."</td>
                </tr>";
                $ctr++;
            }
                $tfooter .= "<tr>
                    <td align='right' colspan='5' style='padding-right:20px'> <b>Total Expected Amount </b> </td>
                    <td align='right' style='padding-right:10px'> &#8369; ".number_format($total_expected_amount,2)."</td>
                    <td align='center'> </td>
                </tr>";
           
        
        $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
            <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px; " align="right">' . date("F d, Y") . '</div><hr/>');
        $this->Mpdf->SetHTMLFooter('<hr/><table style="width: 100%;padding-bottom:-15px;">
                                    <tr>
                                        <td style="text-align: left;width:70%;font-size:10px;">{PAGENO} / {nbpg} </td>
                                        <td style="text-align: right;width: 30%;font-size:10px;">w w w . j e c a m s . c o m . p h</td> 
                                    </tr>
                                </table> ');
                                
             
        $this->Mpdf->autoPageBreak = true; 
        $mpdf->shrink_tables_to_fit = 1;                   
         $html = '<body style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;
             line-height: 1.42857143; font-size: 11px;
             A_CSS_ATTRIBUTE:all;position: absolute;top: 25px; ">
            <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
                <tr>
                    <td>
                        <font style="font-weight:bold">Main Office:</font><br/>
                        No. 3 Queen Street Forest Hills, Novaliches, Quezon City 1117<br/><br/>
                        <font style="font-weight:bold">Makati Sales Office:</font><br/>
                        Makati: Ground Floor Erechem Bldg V.A Rufino Corner Salcedo St., Legaspi Village, Makati City<br/><br/>
                        <font style="font-weight:bold">BGC Sales Office:</font><br/>
                        6/F, Icon Plaza, 26th St. Bonifacio Global City, Taguig City
                    </td>
                    <td>
                        <font style="font-weight:bold;">Landline:</font><br/>
                        02 921 1033<br/>02 800-8231 | Makati Sales Office<br/>02 710-4575 | BGC Sales Office<br/><br/>
                        <font style="font-weight:bold;">Email:</font><br/>
                        jecamsinc@gmail.com<br/>admin@jecams.com.ph<br/><br/> 
                    </td>
                </tr>
            </table>  
            <div>
                <h3 align="center">Collection Schedule '.$collection_schedule.'</h3>
                
                
            <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                <tr>
                    <td align="center"><b>#</b></td>
                    <td align="center"><b>Collection Date</b></td>
                    <td align="center"><b>Client</b></td>
                    <td align="center"><b>Sales Executive</b></td>
                    <td align="center"><b>Agent Instructions</b></td>
                    <td align="center"><b>Expected Amount for Collection</b></td>
                    <td align="center"><b>Pick-up Address</b></td>
                </tr>
                '.$tbody.'
                '.$tfooter.'
            </table>
                ';
                                
                                
        $this->Mpdf->AddPage('L', 
                '', '', '', '', 8,
                8, // margin right
                25, // margin top
                30, // margin bottom
                10, // margin header
                10);

        $this->Mpdf->WriteHTML($html);
        $this->layout = 'pdf';
        $this->render('collection_schedule');
        $this->Mpdf->setFilename('collection_schedule.pdf');
        
    }
    
    public function print_demo() {
        $this->autoRender = false;
        $this->loadModel('ClientService');
        $this->loadModel('ClientServiceProduct');
        $this->loadModel('ProductProperty');
        $this->loadModel('ProductValues');

        $client_service_id = $this->params['url']['id'];
        $cs_type_tmp = $this->params['url']['type'];
        if($cs_type_tmp == "pull_out") {
            $cs_type = "Pull Out";
        }
        else {
            $cs_type = ucwords($cs_type_tmp);
        }
        $getClientService = $this->ClientService->findById($client_service_id);
        $Client = $getClientService['Client'];
        $ClientService = $getClientService['ClientService'];
        $getClientServiceProduct = $this->ClientServiceProduct->findAllByClientServiceId($client_service_id);
        $User = $getClientService['User'];
        
        $tr_details = [];
        foreach($getClientServiceProduct as $retClientServiceProduct) {
            $ClientServiceProduct = $retClientServiceProduct['ClientServiceProduct'];
            $Product = $retClientServiceProduct['Product'];
            $product_id = $Product['id'];
            $name = "<font style='color:red'>Not Specified</font>";
            $src = "";
        
            if(!empty($Product)) {
                $product_property[] = $this->ProductProperty->findByProductId($product_id);
                foreach($product_property as $ret_product_property) {
                    $ProductProperty = $ret_product_property['ProductProperty'];
                    $ProductValue = $ret_product_property['ProductValue'];
                    
                    $prop = $ProductProperty['name'];
                    foreach($ProductValue as $retProductValue) {
                        $val = $retProductValue['value'];
                    }
                }
                
                $description = $prop." : ".$val."<br/>".$Product['other_info'];
                $name = $Product['name'];
                $img = $this->thumbnail($Product['image'], 400, 519);
    			$imageData = base64_encode($img);
    			$src = 'data: image/jpg;base64,'.$imageData;
            }
            
            $tr_details[] = '
                <tr>
                    <td>'.$name.'</td>
                    <td align="center"><img class="img-responsive" style="width:80px;" src="'.$src.'"></td>
                    <td>'.$description.'</td>
                    <td>'.$ClientServiceProduct['qty'].'</td>
                </tr>';
        }
        
        $table="<table width='90%' 
                      style='font-family:Arial;border-collapse:collapse;font-size:12px;border-color:#1a1a1a'
                      align='center'>
                    <thead>
                        <tr>
                            <th align='left'>Code</th><hr/> 
                            <th>Product</th><hr/> 
                            <th align='left'>Description</th><hr/> 
                            <th align='left'>Quantity</th><hr/> 
                        </tr>
                    </thead>
                    <tbody>
                        ".implode($tr_details)."
                    </tbody>
                </table>";
        
        $this->Mpdf->init();
        $html = '<div style="font-family:Arial;font-size:10px;" align="center">'.$ClientService['service_code'].'</div>
                 <br/><br/><br/>';
        $html .= '<div style="font-family:Arial;  top: 35px; left:18px;">
            <table style="font-family:Arial; width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
                <tr>
                    <td style="text-align:left;font-size:18px;">
                        <img src="../img/jecams/jecams_logo.png" height="30" /> | For '.$cs_type.'
                    </td>
                    <td style="text-align: right;width:40%; font-size:15px;padding-right:20px;">
                        PCAB Accredited Contractor
                    </td> 
                    <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                        <p style="margin-top: -5px;">www.jecams.com.ph</p>
                    </td> 
                </tr>
            </table>
            <table border="0" style="font-family:Arial; ">
            <tr>
                <td width="333" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
                    <font style="font-size:14px;">From:</font>
                    <font style="font-size:12px;"> 
                    <p class="marginedQuoteHeaderFirst"><b>JECAMS INC.</b></p>
                    <p style="margin-top: -5px;">3 Queen St.Forest Hills </p>
                    <p style="margin-top: -5px;">Novaliches Quezon City 1117</p>  
                    <p style="margin-top: -5px;">Tel: 358.8149 / 921.1033</p>   
                </td>
        
                <td width="333" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                    <font style="font-size:14px;">To:</font>
                    <font style="font-size:12px;"> 
                    <p class="marginedQuoteHeaderFirst"><b>' . strtoupper($Client['name']) . '</b></p>
                    <p style="margin-top: -5px;">Contact Person: ' . strtoupper($Client['contact_person']) . ' </p>
                    <p style="margin-top: -5px;">Phone: ' . strtoupper($Client['contact_number']) . ' </p>  
                    <p style="margin-top: -5px;">Address: ' . strtoupper($Client['ship_geolocation']) . '</p>
                    </font>
                </td> 
                <td width="333" align="left" style="padding-left:60px;padding-right:10px;padding-bottom:-50px;">
                    <font style="font-size:14px;font-weight:bold;">Demo Number: '.$ClientService['service_code'].'</font>
                    <font style="font-size:12px;"> 
                    <p style="margin-top: -5px;">Created By: ' . strtoupper($User['first_name']." ".$User['last_name']) . '</p>
                    </font> 
                </td>
            </tr>   
        </table>
        <br/><br/><br/><br/> 
        <div>'.
        
        $table
        
        .'
        <hr width="90%" />
        <br/><br/>
        <font style="font-weight: bold;font-size: 10px;">Terms and Conditions:</font>
        <br/><br/>
        <div style="font-family:Arial;font-size:10px;">
                Jecams Inc. provides Demonstration Unit or Demo unit to our client in order to show them the quality, features, appearance, colors and others of the unit and in turn help them
        decide on their purchase. However, please read first and comply with our terms and condition: Demo unit returned to Jecams Inc. must be in the same working and physical
        condition as it was at the time the unit was delivered to you or your company. Product must be clean and without scratches or usage marks of any kind. If the unit, however, loss
        or damage, the client assumes full payment of the unit.
        <br/><br/>
                We are pleased that you chose Jecams Inc. for your furniture purchase. We greatly appreciate your business and the opportunity to assist you. At Jecams, we always strive for the
        best.<br/><br/>
        We hope to be working with you again soon.
        </div>
        
        <br/><br/><br/>
        <font style="font-weight: bold;font-size: 10px;">__________________________________<br/>
        Approved By Accounting</font>
        <br/>
        <font style="font-size: 10px;">Delivered By:____________________________________<br/>
        Date/Time: _____________________________________<br/><br/>
        Received in good condition;</font><br/><br/>
        <font style="font-weight: bold;font-size: 10px;">__________________________________<br/>
        Signature Over Printed Name</font><br/>
        <font style="font-size: 10px;">Date Received: ___________________________________<br/></font>
        ';
        
        $this->Mpdf->AddPage('P', // L - Landscape, P - Portrait
                '', '', '', '', 8,
                8, // margin right
                10, // margin top
                30, // margin bottom
                10, // margin header
                10);

        $this->Mpdf->WriteHTML($html);
        $this->layout = 'pdf';
        $this->render('print_demo');
        $this->Mpdf->setFilename('print_demo.pdf'); 
    }
    
    public function print_certificate_completion() {
        $this->autoRender = false;
        // LOAD MODELS
        // =================================================================>
            $this->loadModel('DeliverySchedule');
            $this->loadModel('QuotationProduct');
        // =================================================================>
        // END OF LOAD MODELS
        
        // VARIABLES
        // =================================================================>
            $today = date("F d, Y");
            $delivery_schedule_id = $this->params['url']['id'];
            $Product_names = [];
            $tbody = '';
            $count = 1;
        // =================================================================>
        // END OF VARIABLES
        
        // QUERIES
        // =================================================================>
            $getDeliverySchedules = $this->DeliverySchedule->findById($delivery_schedule_id);
            if(!empty($getDeliverySchedules)) {
                $Client_name = $getDeliverySchedules['Client']['name'];
                $DR_number = $getDeliverySchedules['DeliverySchedule']['dr_number'];
                $Quotation_number = $getDeliverySchedules['Quotation']['quote_number'];
            }
            
            if($getDeliverySchedules['DeliverySchedule']['type']=="dr") {
                $quotation_id = $getDeliverySchedules['DeliverySchedule']['reference_number'];
                
                $getQuotationProducts = $this->QuotationProduct->findAllByQuotationId($quotation_id,
                    ['id', 'product_id', 'Product.name', 'image', 'other_info']);
                
        //         foreach($getQuotationProducts as $retQuotationProducts) {
        //             $QuotationProduct = $retQuotationProducts['QuotationProduct'];
        //             $Product = $retQuotationProducts['Product'];
        //             $getQuotationProductProperty = $retQuotationProducts['QuotationProductProperty'];
        //             $qty = $QuotationProduct['qty'];
                    
        //             $img = $this->thumbnail($QuotationProduct['image'], 400, 400);
        // 			$imageData = base64_encode($img);
        // 			$src = 'data: image/jpg;base64,'.$imageData;
                    
        //             $description = "";
        //             foreach($getQuotationProductProperty as $retQuotationProductProperty) {
        //                 $property = $retQuotationProductProperty['property'];
        //                 $value = $retQuotationProductProperty['value'];
                        
        //                 $description .= "
        //                 <p>$property : $value</p>
        //                 ";
        //             }
                    
        //             $tbody .= '
        //             <tr>
        //                 <td>'.$count.'</td>
        //                 <td>'.$Product['name'].'</td>
        //                 <td align="center"><img class="img-responsive" style="width:80px;" src="'.$src.'" /></td>
        //                 <td width="200">'.$description.'</td>
        //                 <td>'.$qty.'</td>
        //             </tr>';
                    
        //             $count++;
        //         }
            }
        // =================================================================>
        // END OF QUERIES
        
        //  <table style='margin-left:60px;font-family:Calibri;border-collapse:collapse;font-size:12px;'
        //               width='92%'>
        //             <thead>
        //                 <tr>
        //                     <th align='left'>#</th>
        //                     <th align='left'>Product Code</th>
        //                     <th align='left'>Image</th>
        //                     <th align='left'>Description</th>
        //                     <th align='left'>Qty</th>
        //                 </tr>
        //             </thead>
        //             <tbody>
        //             $tbody
        //             </tbody>
        //         </table>
                
        //         <br/><br/><br/>
        // HTML
        // =================================================================>
            $html = "
                <div style='text-align:center;font-family:Calibri;'>
                    <font style='font-size:26px;font-weight:bold;'>Certificate of Completion</font>
                </div>
                
                <table style='font-family:Calibri;font-size:14px;margin-left:60px;border-collapse:separate;border-spacing:15px;' width='50%'>
                    <tr>
                        <td>Date</td>
                        <td>: <font style=''>".$today."</font></td>
                    </tr>
                    <tr>
                        <td>Report No.</td>
                        <td>: <font style=''>JI-COC$Quotation_number</font></td>
                    </tr>
                    <tr>
                        <td>Name of Customer</td>
                        <td>: <font style=''>$Client_name</font></td>
                    </tr>
                    <tr>
                        <td>Job Order No.</td>
                        <td>: <font style=''>$DR_number</font></td>
                    </tr>
                </table>
                
                <br/><br/><br/>
                
               
                
                <div style='font-family:Calibri;text-align:justify;font-size:14px;margin-left:60px;' width='85%'>
                    This is to certify that the item/s delivered are complete and work performed is in conformity with all client’s requirement.
                    This certificate of completion is based on performance of required assembly, installation and delivery of all products under
                    QUOTATION Nos: <font style='font-weight:bold'>$Quotation_number</font>.
                    All items are under the warranty provided in the contract and any damage due to usage and tampering are not covered.
                    Technical report and documentation are at customer’s disposal. 

                    
                    <br/><br/><br/>
                    ______________________________________________<br/>
                    Alejandre Bondoc – JECAMS INC. Plant Manager
                   
                    <br/><br/><br/>
                    
                    <div style='margin-left:380px;'>
                        Inspected and Accepted by:<br/><br/>
                        
    			        ______________________________________________<br/>
    			        Name of Customer / Customer Representative
    
                    </div>
                </div>
    
            ";
            
            // <img src='../img/jecams/M_Salmorin.png' width='130px;' style='margin-left:45px;margin-bottom:-45px;' /><br/>
        // END OF HTML
        // =================================================================>
        
        
        // RENDER PDF
        // =================================================================>
            $this->Mpdf->init();
            $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/CERTIFICATE OF COMPLETION-HEADER.jpg"
                                        style="margin-left:40px;margin-right:40px;" />');
            $this->Mpdf->SetHTMLFooter('<img src="../img/jecams/CERTIFICATE OF COMPLETION-FOOTER.jpg" height="" />');
            $this->Mpdf->AddPage('P', // L - Landscape, P - Portrait
                    '', '', '', '', 0,
                    0, // margin right
                    50, // margin top
                    60, // margin bottom
                    10, // margin header
                    0);
            
            $this->Mpdf->WriteHTML($html);
            $this->layout = 'pdf';
            $this->render('print_certificate_completion');
            $this->Mpdf->setFilename('print_certificate_completion.pdf');
        //==================================================================>
        // END OF RENDER PDF
    }
    
    public function print_jr() {
        $this->autoRender = false;
        // VARIABLES
        // =================================================================>
        $job_request_id = $this->params['url']['id'];
        $not_specified = "<font style='color:red;'>Not Specified</font>";
        $unknown = "<font style='color:red;'>Unknown</font>";
        // =================================================================>
        // END OF VARIABLES
        
        
        // MODELS
        // =================================================================>
        $this->loadModel('JobRequest');
        $this->loadModel('JobRequestProduct');
        $this->loadModel('JobRequestRevision');
        $this->loadModel('JobRequestFloorplan');
        $this->loadModel('QuotationProductProperty');
        // =================================================================>
        // END OF MODELS
        
        // QUERY
        // =================================================================>
        // JobRequest.created, Client.name, JobRequestProduct.deadline_date
        // Quotation.target_delivery, JobRequest.user_id, User.first_name,
        // User.last_name, JobRequest.jr_number
        $getAllJobRequest = $this->JobRequest->find('all',
            ['conditions'=>['JobRequest.id'=>$job_request_id],
             'fields'=>['JobRequest.id', 'JobRequest.created', 'JobRequest.client_id',
                        'Client.name', 'JobRequest.quotation_id', 'Quotation.target_delivery',
                        'JobRequest.user_id', 'User.first_name', 'User.last_name',
                        'jr_number']]);
                        
        foreach($getAllJobRequest as $retAllJobRequest) {
            $JobRequest = $retAllJobRequest['JobRequest'];
            $Client = $retAllJobRequest['Client'];
            $AllJobRequestProduct = $retAllJobRequest['JobRequestProduct'];
            $Quotation = $retAllJobRequest['Quotation'];
            $Agent = $retAllJobRequest['User'];
            
            $created = date("F d, Y  - h:m a", strtotime($JobRequest['created']));
            $client_name = $unknown;
            if($Client['name']!="" &&
               $Client['name']!=null) {
                $client_name = $Client['name'];   
            }
            
            $temp_JobRequestProduct_deadline_date = date('Y-m-d', strtotime("1970-01-01"));
            foreach($AllJobRequestProduct as $EachJobRequestProduct) {
                $JobRequestProduct_deadline_date = $EachJobRequestProduct['deadline_date'];
                if($temp_JobRequestProduct_deadline_date < $JobRequestProduct_deadline_date) {
                    $temp_JobRequestProduct_deadline_date = $JobRequestProduct_deadline_date;
                }
            }
            
            $target_delivery = $unknown;
            if($Quotation['target_delivery']!="" &&
               $Quotation['target_delivery']!=null &&
               $Quotation['target_delivery']!="0000-00-00") {
               $target_delivery = $Quotation['target_delivery'];
           }
           
           $sales_executive = $unknown;
           if(!empty($Agent)) {
               $sales_executive = ucwords($Agent['first_name']." ".$Agent['last_name']);
           }
           
           $jr_number = $unknown;
           if($JobRequest['jr_number']!="" && $JobRequest['jr_number']!=null) {
               $jr_number = $JobRequest['jr_number'];
           }
        }
        
        // JobRequestProduct.id, JobRequestProduct.image, Product.id, Product.name,
        // JobRequestProduct.quotation_product_id, QuotationProduct.qty
        $tbody = "";
        $getAllJobRequestProducts = $this->JobRequestProduct->findAllByJobRequestId($job_request_id,
            ['JobRequestProduct.id', 'JobRequestProduct.image', 'Product.id', 'Product.name',
             'JobRequestProduct.quotation_product_id', 'QuotationProduct.qty']);
        foreach($getAllJobRequestProducts as $retAllJobRequestProducts) {
            $JobRequestProduct = $retAllJobRequestProducts['JobRequestProduct'];
            $Product = $retAllJobRequestProducts['Product'];
            $QuotationProduct = $retAllJobRequestProducts['QuotationProduct'];
            $JobRequestProduct_id = $JobRequestProduct['id'];
            
            // JobRequestRevision.id, JobRequestRevision.job_request_product_id,
            // JobRequestRevision.job_request_type_id, JobRequestType.name
            $type = "- ".$unknown;
            $getAllJobRequestRevision = $this->JobRequestRevision->findAllByJobRequestProductId($JobRequestProduct_id,
                ['JobRequestRevision.id', 'JobRequestRevision.job_request_product_id',
                 'JobRequestRevision.job_request_type_id', 'JobRequestType.name']);
            
            $revision = "";
            foreach($getAllJobRequestRevision as $retAllJobRequestRevision) {
                $Designers = [];
                $JobRequestType = $retAllJobRequestRevision['JobRequestType'];
                $JobRequestRevision = $retAllJobRequestRevision['JobRequestRevision'];
                $JobRequestAssignment = $retAllJobRequestRevision['JobRequestAssignment'];
                
                $type = $JobRequestType['name'];
                $revision .= $type;
                foreach($JobRequestAssignment as $eachJobRequestAssignment) {
                    $designer_name = "<p>".$eachJobRequestAssignment['designer_name']."</p>";
                    if(!in_array($designer_name, $Designers)) {
                        $Designers[] = $designer_name;
                        $revision .= $designer_name;
                    }
                }
            }
            
            $src = 'image_placeholder.jpg';
            $img = $this->thumbnail($JobRequestProduct['image'], 400);
			$imageData = base64_encode($img);
			$src = 'data: image/jpg;base64,'.$imageData;
            
            $product_name = $unknown;
            if(!empty($Product)) {
                if($Product['name']!="" || $Product['name']!=null) {
                    $product_name = $Product['name'];
                }
            }
            
            $qty = 0;
            if(!empty($QuotationProduct)) {
                $qty = $QuotationProduct['qty'];
            }
        
            // QuotationProductProperty.id, QuotationProductProperty.property, QuotationProductProperty.value,
            // QuotationProductProperty.quotation_product_id
            $Description = [];
            $getAllQuotationProductProperty = $this->QuotationProductProperty->findAllByQuotationProductId($JobRequestProduct['quotation_product_id'],
                ['QuotationProductProperty.id', 'QuotationProductProperty.property', 'QuotationProductProperty.value', 
                 'QuotationProductProperty.quotation_product_id', 'QuotationProduct.id', 'QuotationProduct.other_info']);
            foreach($getAllQuotationProductProperty as $retAllQuotationProductProperty) {
                $QuotationProductProperty = $retAllQuotationProductProperty['QuotationProductProperty'];
                $QuotationProduct = $retAllQuotationProductProperty['QuotationProduct'];
                $property = ucwords($QuotationProductProperty['property']);
                $value = $QuotationProductProperty['value'];
                $other_info = $QuotationProduct['other_info'];
                
                $Description[] = '<p>'.$property.': '.$value.' '.$other_info.'</p><br/>';
            }
            
            $tbody .= "
                <tr>
                    <td>$revision</td>
                    <td align='center'><img class='img-responsive' style='width:80px;' src='$src'></td>
                    <td>$product_name</td>
                    <td>$qty</td>
                    <td>".implode($Description)."</td>
                </tr>
            ";
        }
        
        // FLOOR PLAN PRINT
        $FP_tbody = "";
        $getAllFloorplan = $this->JobRequestFloorplan->findAllByJobRequestId($job_request_id,
            ['id', 'description']);
        foreach($getAllFloorplan as $retAllFloorplan) {
            $Floorplan = $retAllFloorplan['JobRequestFloorplan'];
            $Floorplan_id = $Floorplan['id'];
            $Floorplan_description = $not_specified;
            if($Floorplan['description']!="") {
                $Floorplan_description = $Floorplan['description'];
            }
            
            $FP_getAllJobRequestRevision = $this->JobRequestRevision->find('all',
                ['conditions'=>['JobRequestRevision.job_request_id'=>$job_request_id, 
                                'JobRequestRevision.job_request_floorplan_id'=>$Floorplan_id],
                 'fields'=>['JobRequestRevision.id', 'JobRequestRevision.job_request_floorplan_id',
                            'JobRequestRevision.job_request_type_id', 'JobRequestRevision.job_request_id',
                            'JobRequestType.id', 'JobRequestType.name']]);
                            
            $FP_revision = "";
            foreach($FP_getAllJobRequestRevision as $FP_retAllJobRequestRevision) {
                $FP_JobRequestType = $FP_retAllJobRequestRevision['JobRequestType'];
                $FP_JobRequestAssignments = $FP_retAllJobRequestRevision['JobRequestAssignment'];
                
                $FP_Designer = [];
                $FP_type = $FP_JobRequestType['name'];
                $FP_revision .= $FP_type;
                foreach($FP_JobRequestAssignments as $FP_eachJobRequestAssignment) {
                    $FP_designer_name = "<p>".$FP_eachJobRequestAssignment['designer_name']."</p>";
                    if(!in_array($FP_designer_name, $FP_Designer)) {
                        $FP_Designer[] = $FP_designer_name;
                        $FP_revision .= $FP_designer_name;
                    }
                }
                
            }
            
            // FP TBODY
            $FP_tbody .= "
                    <tr>
                        <td>$FP_revision</td>
                        <td align='center'><img class='img-responsive' style='width:80px;' src='../img/product-uploads/image_placeholder.jpg'></td>
                        <td>Floor Plan</td>
                        <td>-</td>
                        <td>$Floorplan_description</td>
                    </tr>
                ";
        }
        // =================================================================>
        // END OF QUERY
        
        // HTML
        // =================================================================>
        $html = '
                <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
                    <tr>
                        <td>
                            <font style="font-weight:bold">Main Office:</font><br/>
                            No. 3 Queen Street Forest Hills, Novaliches, Quezon City 1117<br/><br/>
                            <font style="font-weight:bold">Makati Sales Office:</font><br/>
                            Makati: Ground Floor Erechem Bldg V.A Rufino Corner Salcedo St., Legaspi Village, Makati City<br/><br/>
                            <font style="font-weight:bold">BGC Sales Office:</font><br/>
                            6/F, Icon Plaza, 26th St. Bonifacio Global City, Taguig City
                        </td>
                        <td>
                            <font style="font-weight:bold;">Landline:</font><br/>
                            02 921 1033<br/>02 800-8231 | Makati Sales Office<br/>02 710-4575 | BGC Sales Office<br/><br/>
                            <font style="font-weight:bold;">Email:</font><br/>
                            jecamsinc@gmail.com<br/>admin@jecams.com.ph<br/><br/> 
                        </td>
                    </tr>
                </table>
                
                <br/>
                <div align="center" style="font-family:Calibri;font-size:15px;font-weight:bold;">Job Request Form</div>
                <div align="center" style="font-family:Calibri;font-size:16px;font-weight:bold;"></div>
                <br/>
                
                <table width="100%" style="font-size:12px;">
                    <tr>
                        <td>
                            <p><font style="font-weight:bold;">Date-Time of Request:</font> '.$created.'</p>
                            <p><font style="font-weight:bold;">Company:</font> '.$client_name.'</p>
                        </td>
                        <td align="right">
                            <p><font style="font-weight:bold;">Date of Accomplishment:</font> '.$temp_JobRequestProduct_deadline_date.'</p>
                            <p><font style="font-weight:bold;">Tentative Delivery Date:</font> '.$target_delivery.'</p>
                        </td>
                    <tr>
                </table>
                <br/>
                <br/>
                 
                <table border="1" width="100%"  style="font-family:Arial; border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>Designers</th>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$tbody.'
                    '.$FP_tbody.'
                    <tbody>
                </table>
                
                <br/>
                <p style="font-size:12px;"><font style="font-weight: bold;">Agent\'s Name:</font> '.$sales_executive.'</font></p>
                <br/><br/>
                <p style="font-size:12px;"><font style="font-weight: bold;">Approved By:</font>__________________________________</p>
                ';
        // =================================================================>
        // END OF HTML
        
        // RENDER PDF
        // =================================================================>
            $this->Mpdf->init();
            $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
                                        <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px;" align="right">'
                                        . date("F d, Y") . '</div><hr/>');
            
            $this->Mpdf->SetHTMLFooter('<table style="width: 100%;">
                                            <tr>
                                                <td style="text-align: left;width:70%;font-size:10px;">{PAGENO} / {nbpg} </td>
                                                <td style="text-align: right;width: 30%;font-size:10px;">'.$jr_number.'</td> 
                                            </tr>
                                        </table> ');
            $this->Mpdf->AddPage('P', 
                    '', '', '', '', 8,
                    8, // margin right
                    25, // margin top
                    30, // margin bottom
                    10, // margin header
                    10);
            
            $this->Mpdf->WriteHTML($html);
            $this->layout = 'pdf';
            $this->render('print_jr');
            $this->Mpdf->setFilename('prin_jr.pdf');
        //==================================================================>
        // END OF RENDER PDF
    }
    
     public function print_quote_purchasing() {
        $this->Mpdf->init();

        $quotation_id = $this->params['url']['id'];

        $this->loadModel('Quotation');
        $this->Quotation->recursive = 2;
        $quotation = $this->Quotation->findById($quotation_id);
        $this->set(compact('quotation'));
        
        $this->Mpdf->SetHTMLHeader('<div style="font-family:Arial;
                                    padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        

        $terms_info = '<p style="font-family:Arial; margin-top: -5px;"><font size="6">' . $quotation['Quotation']['terms_info'] . '</font></p>';

        $terms = $terms_info;

        $this->set(compact('terms'));

        // get team for this quotation
        $this->loadModel('Team');
        $my_team = $this->Team->findById($quotation['Quotation']['team_id']);
        $my_team_telephone = $my_team['Team']['telephone'];

        if ($my_team['Team']['location'] == 'Main: 3 Queen St.Forest Hills, Novaliches Quezon City 1117') {
            $other_teams = $this->Team->find('all', array(
                'conditions' => array('Team.location !=' => 'Main: 3 Queen St.Forest Hills, Novaliches Quezon City 1117')));
        } else {
            $other_teams = $this->Team->find('all', array(
                'conditions' => array('Team.location !=' => $my_team['Team']['location'], 'Team.id !=' => 2)));
        }
        
        $ots = [];
        foreach ($other_teams as $other_team) {
            $ots[] = '<p style="margin-top: -5px;">' . $other_team['Team']['location'] . '</p>';
        }
        $ots_tmp = array_unique($ots);
        $other_team_locations = implode("", $ots_tmp);

        /////get sales agent who created the quotation
        $prepared_by = $quotation['User']['first_name'] . '  ' . $quotation['User']['last_name'];
        $agent_signature = $quotation['User']['signature'];
        $this->set(compact('prepared_by'));
        $this->set(compact('agent_signature'));

        $this->loadModel('User');
        $quotattion_team_id = $quotation['Quotation']['team_id'];
             
        $this->loadModel('AgentStatus');  
        $manager = $this->AgentStatus->find('first', array(
                    'joins' => array(array('table' => 'users',
                               'alias' => 'Users',
                               'type' => 'INNER', 
                               'conditions' => array('User.id = AgentStatus.user_id'))),
                    'conditions'=>array(
                        'AgentStatus.date_to' => NULL,
                        'User.role' => 'sales_manager',
                        'AgentStatus.team_id' => $quotattion_team_id,
                            ))); 
            
        $this->set(compact('manager'));
        
        $team_manager = $manager['User']['first_name'] . '  ' . $manager['User']['last_name'];
        $team_position_id = $manager['User']['id'];
        
        $this->User->recursive = 2;
        $get_pos = $this->User->findById($team_position_id, 'Position.name');
        $team_position = $get_pos['Position']['name'];
        
        $this->set(compact('team_manager','team_position'));
        $team_signature = $manager['User']['signature'];
        $this->set(compact('team_signature'));


        $client_name = strtoupper($quotation['Client']['name']);
        $contact_person = strtoupper($quotation['Client']['contact_person']);
        $this->set(compact('contact_person'));
        $contact_number = strtoupper($quotation['Client']['contact_number']);
        $email = strtoupper($quotation['Client']['email']);
        $address = strtoupper($quotation['Client']['address']);

        ///bill_ship_address
        if ($quotation['Quotation']['delivery_mode'] == 'deliver') {
            if ($quotation['Quotation']['bill_ship_address'] == 1) {
                if (!is_null($quotation['Quotation']['bill_address'])) {
                    $bill_ship_address = ' <p>Bill & Ship To: ' . $quotation['Quotation']['bill_geolocation'] . '</p> ';
                } else {
                    $bill_ship_address = ' <p>Bill & Ship To: ' . $quotation['Quotation']['bill_address'] . ' ' . $quotation['Quotation']['bill_geolocation'] . '</p> ';
                }
            } else {
                $bill_ship_address = ' <p style="font-size:10px">Bill To: ' . $quotation['Quotation']['bill_address'] . ' ' . $quotation['Quotation']['bill_geolocation'] . '</p> '
                        . ' <p style="font-size:10px">Ship To: ' . $quotation['Quotation']['ship_address'] . ' ' . $quotation['Quotation']['ship_geolocation'] . '</p> ';
            }
        } else {
            $bill_ship_address = '<p>Delivery Mode: Pick-up</p>';
        }



        ////// PRODUCT DETAILS START //////
        $this->loadModel('QuotationProduct');
        $this->QuotationProduct->recursive = 2;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quotation_id, 'QuotationProduct.deleted' => NULL)
        ));

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
        foreach ($quote_products as $quote_prod) {
            $prod_prop = [];
            foreach ($quote_prod['QuotationProductProperty'] as $i=>$desc) {
                $tmp = strtolower($desc['property']);
                if($tmp == "Material" || $tmp == "Materials" || $tmp == "material"
                   || $tmp == "materials") {
                    $ppn[$i] = 'Materials (General Info)';
                }
                else if($tmp == "Dimension" || $tmp == "Dimensions" || $tmp == "dimension"
                   || $tmp == "dimensions") {
                    $ppn[$i] = 'Dimension Info';
                }
                else {
                    $ppn[$i] = ucwords($tmp);
                }
                
                if (is_null($desc['property'])) {
                    $tmp2 = strtolower($desc['ProductProperty']['name']);
                    if($tmp2 == "Material" || $tmp2 == "Materials" || $tmp2 == "material"
                       || $tmp == "materials") {
                        $ppn[$i] = 'Materials (General Info)';
                    }
                    else if($tmp2 == "Dimension" || $tmp2 == "Dimensions" || $tmp2 == "dimension"
                       || $tm2p == "dimensions") {
                        $ppn[$i] = 'Dimension Info';
                    }
                    else {
                        $ppn[$i] = ucwords($tmp2);
                    }
                  
                    if($tmp2!="made in" && $tmp2!="madein") {
                        $prod_prop[] = ''. $ppn[$i] . ' : ' . ucwords($desc['ProductValue']['value']) . '<br/>';
                    }
                } else {
                    if($tmp!="made in" && $tmp!="madein") {
                        $prod_prop[] = '' . $ppn[$i]. ' : ' . ucwords($desc['value']) . '<br/>';
                    }
                }
            }
            $other_infoes = str_replace('</p>', '', $quote_prod['QuotationProduct']['other_info']);
            $other_infoes =  str_replace('<p>', '<br/>', $other_infoes);
            $other_infoes =  str_replace('<strong>', '', $other_infoes);
            $other_info2 =  str_replace('</strong>', '', $other_infoes);
            // ==> UNCOMMENT CODE below to sort properties and values alphabetically.
            // natcasesort($prod_prop);
            // ==> END OF SORT CODE
            
            
            //thumnail start
            
            $img = $this->thumbnail($quote_prod['QuotationProduct']['image'], 400, 519);
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
            // thumbnail end
            $product_details[] = '<tr style=" font-family:Arial; ">
                <td width="15" align="left"><p style="font-size:11px">' . $cnt . '</p></td>
                <td width="140" align="center"><p style="font-size:11px">' . $quote_prod['Product']['name'] . '</p></td>
                
                <td width="" align="center"><img class="img-responsive" style="width:80px;" src="'.$src.'"></td>
                <td width="200"><p style="font-size:11px">
                    ' . $other_info2 . '
                    <div>' . implode($prod_prop) . '</div><br/><br/><br/></font>
                </td>
                <td width="20" align="center"><p style="font-size:11px">' . abs($quote_prod['QuotationProduct']['qty']) . '</p></td>
                <td width="100" align="right"><p style="font-size:11px">&#8369;  ' . number_format($quote_prod['QuotationProduct']['edited_amount'], 2) . '</p></td> 
                <td width="120" align="right"><p style="font-size:11px">&#8369;  ' . number_format($quote_prod['QuotationProduct']['total'], 2) . '</p></td></tr>';

            $cnt++;
        }

        if ($quotation['Quotation']['installation_charge'] != 0) {
            $installation_charge = '&#8369;  ' . number_format($quotation['Quotation']['installation_charge'], 2);
            $install = '
                 <tr align="right">
                    <td align="right" >Installation charge:</td>
                    <td style="text-align:right"> ' . $installation_charge . '</td>
                  </tr>';
        } else {
            $installation_charge = "";
            $install = "";
        }

        if ($quotation['Quotation']['delivery_charge'] != 0) {
            $delivery_charge = '&#8369;  ' . number_format($quotation['Quotation']['delivery_charge'], 2);
            $del = '
                <tr  align="right">
                    <td style="width:50%" align="right">Delivery charge: </td>
                    <td  style="text-align:right">' . $delivery_charge . '</td>
                </tr>';
        } else {
            $delivery_charge = "";
            $del = "";
        }

        if ($quotation['Quotation']['discount'] != 0) {
            $discount = '&#8369;  ' . number_format($quotation['Quotation']['discount'], 2);
            $dis = '
                  <tr align="right">
                    <td style="width:50%" align="right">Discount: </td>
                    <td  style="text-align:right">' . $discount . ' </td>
                  </tr>';
        } else {
            $discount = "";
            $dis = "";
        }

        if ($quotation['Quotation']['installation_charge'] != 0 || $quotation['Quotation']['delivery_charge'] != 0 || $quotation['Quotation']['discount'] != 0) {
            $sub = '
                <tr  align="right">
                    <td  align="right">Sub total:</td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($quotation['Quotation']['sub_total'], 2) . '<br/> <br/></td> 
                 </tr>';
        } else {
            $sub = "";
        }

        ////// PRODUCT DETAILS END //////
        $html = '<body style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;
             line-height: 1.42857143; font-size: 11px;
             A_CSS_ATTRIBUTE:all;position: absolute;top: 25px; ">
            <div style="font-family:Arial; top: 35px;  font-size:14px; ">  
            <table style=" font-family:Arial;  width: 100%; border:1px ">
                <tr>
                    <td style="text-align: left;width:25%; font-size:10px;">
                     
                        <img src="../img/jecams/quotation.png" width="170" height="35">  
                    </td>
                    <td style="text-align: right;width:40%; font-size:15px;padding-right:20px;">
                        PCAB Accredited Contractor
                    </td> 
                    <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                        <p style="margin-top: -5px;">www.jecams.com.ph</p>
                    </td> 
                </tr>
            </table>
            <table style="font-family:Arial; " border="0">
                <tr>
                    <td width="320" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
                        <font style="font-size:12px;">From:</font>
                        <font style="font-size:10px;"> 
                        <p class="marginedQuoteHeaderFirst"><b>JECAMS INC.</b></p>
                        <p style="margin-top: -5px;">' . $my_team['Team']['location'] . '</p> 
                            ' . $other_team_locations . '
                        <p style="margin-top: -5px;">' . $my_team_telephone . '</p>  
                        </font><br/><br/><br/> 
                    </td> 
                </tr>   
            </table>
            <br/><br/><br/><br/>
            <table border="0"   style="font-family:Arial;width: 100%; border-collapse:collapse;font-size:12px; " align="center">
                <tr>
                    <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
                    <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
                    <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
                    <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
                    <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
                    <td align="right"  style="font-size:12px;"><b>List Price</b><br/> <br/><br/></td>
                    <td align="right"  style="font-size:12px; "> <b>Total</b><br/> <br/><br/></td>
                </tr>
                ' . implode($product_details) . '
                <tr><td colspan="7">&nbsp;</td></tr>
                <tr><td colspan="7">&nbsp;</td></tr>
                <tr>
                    <td colspan="4">
                       
                    </td> 
                    <td colspan="3" align="right">
                        <table width="100%" style="font-family:Arial; font-size:12px;">
                            ' . $sub . '
                            ' . $install . '
                            ' . $del . '
                            ' . $dis . '
                              <tr>
                                <td align="right" width="100px"><b>Grand Total:</b><br/> <br/></td>
                                <td style="text-align:right">&#8369; ' . number_format($quotation['Quotation']['grand_total'], 2) . ' </td>
                              </tr>
                        </table>
                    </td> 
                </tr>
            </table> 
            </div>
            </body>
            ';
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->Mpdf->WriteHTML($html);
 
        $this->layout = 'pdf';
        $this->render('print_quote_purchasing');
        $this->Mpdf->setFilename('print_quote_purchasing.pdf');
    }
	 
    public function quotation_discount() {
        $this->Mpdf->init();

        $quotation_id = $this->params['url']['id'];

        $this->loadModel('Quotation');
        $this->Quotation->recursive = 2;
        $quotation = $this->Quotation->findById($quotation_id);
        $this->set(compact('quotation'));
        
        $this->Mpdf->SetHTMLHeader('<div style="font-family:Arial;
                                    padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->SetHTMLFooter('<table style="font-family:Arial;
                                    font-size:14px;width: 100%;padding-bottom:-15px;">
                                    <tr>
                                        <td style="text-align: left;width:70%;font-size:10px;">
                                            Q ' . $quotation['Quotation']['quote_number'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please review our Terms and Conditions at the last page.</td>
                                        <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
                                    </tr>
                                </table> ');


        $terms_info = '<p style="font-family:Arial; margin-top: -5px;"><font size="6">' . $quotation['Quotation']['terms_info'] . '</font></p>';

        $terms = $terms_info;

        $this->set(compact('terms'));

        // get team for this quotation
        $this->loadModel('Team');
        $my_team = $this->Team->findById($quotation['Quotation']['team_id']);
        $my_team_telephone = $my_team['Team']['telephone'];

        if ($my_team['Team']['location'] == 'Main: 3 Queen St.Forest Hills, Novaliches Quezon City 1117') {
            $other_teams = $this->Team->find('all', array(
                'conditions' => array('Team.location !=' => 'Main: 3 Queen St.Forest Hills, Novaliches Quezon City 1117')));
        } else {
            $other_teams = $this->Team->find('all', array(
                'conditions' => array('Team.location !=' => $my_team['Team']['location'], 'Team.id !=' => 2)));
        }
        
        $ots = [];
        foreach ($other_teams as $other_team) {
            $ots[] = '<p style="margin-top: -5px;">' . $other_team['Team']['location'] . '</p>';
        }
        $ots_tmp = array_unique($ots);
        $other_team_locations = implode("", $ots_tmp);

        /////get sales agent who created the quotation
        $prepared_by = $quotation['User']['first_name'] . '  ' . $quotation['User']['last_name'];
        $agent_signature = $quotation['User']['signature'];
        $this->set(compact('prepared_by'));
        $this->set(compact('agent_signature'));

        $this->loadModel('User');
        $quotattion_team_id = $quotation['Quotation']['team_id'];
             
        $this->loadModel('AgentStatus');  
        $manager = $this->AgentStatus->find('first', array(
                    'joins' => array(array('table' => 'users',
                               'alias' => 'Users',
                               'type' => 'INNER', 
                               'conditions' => array('User.id = AgentStatus.user_id'))),
                    'conditions'=>array(
                        'AgentStatus.date_to' => NULL,
                        'User.role' => 'sales_manager',
                        'AgentStatus.team_id' => $quotattion_team_id,
                            ))); 
            
        $this->set(compact('manager'));
        
        $team_manager = $manager['User']['first_name'] . '  ' . $manager['User']['last_name'];
        $team_position_id = $manager['User']['id'];
        
        $this->User->recursive = 2;
        $get_pos = $this->User->findById($team_position_id, 'Position.name');
        $team_position = $get_pos['Position']['name'];
        
        $this->set(compact('team_manager','team_position'));
        $team_signature = $manager['User']['signature'];
        $this->set(compact('team_signature'));


        $client_name = strtoupper($quotation['Client']['name']);
        $contact_person = strtoupper($quotation['Client']['contact_person']);
        $this->set(compact('contact_person'));
        $contact_number = strtoupper($quotation['Client']['contact_number']);
        $email = strtoupper($quotation['Client']['email']);
        $address = strtoupper($quotation['Client']['address']);

        ///bill_ship_address
        if ($quotation['Quotation']['delivery_mode'] == 'deliver') {
            if ($quotation['Quotation']['bill_ship_address'] == 1) {
                if (!is_null($quotation['Quotation']['bill_address'])) {
                    $bill_ship_address = ' <p>Bill & Ship To: ' . $quotation['Quotation']['bill_geolocation'] . '</p> ';
                } else {
                    $bill_ship_address = ' <p>Bill & Ship To: ' . $quotation['Quotation']['bill_address'] . ' ' . $quotation['Quotation']['bill_geolocation'] . '</p> ';
                }
            } else {
                $bill_ship_address = ' <p style="font-size:10px">Bill To: ' . $quotation['Quotation']['bill_address'] . ' ' . $quotation['Quotation']['bill_geolocation'] . '</p> '
                        . ' <p style="font-size:10px">Ship To: ' . $quotation['Quotation']['ship_address'] . ' ' . $quotation['Quotation']['ship_geolocation'] . '</p> ';
            }
        } else {
            $bill_ship_address = '<p>Delivery Mode: Pick-up</p>';
        }



        ////// PRODUCT DETAILS START //////
        $this->loadModel('QuotationProduct');
        $this->QuotationProduct->recursive = 2;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quotation_id, 'QuotationProduct.deleted' => NULL)
        ));

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
		
		//formula for discount
		$percentage_discount = ($quotation['Quotation']['discount'] / $quotation['Quotation']['sub_total']);
		$new_sub_total = 0;
		
        foreach ($quote_products as $quote_prod) {
			
		//formula for discount
			$item_discount = $quote_prod['QuotationProduct']['edited_amount'] * $percentage_discount;
			$discounted_item_price = $quote_prod['QuotationProduct']['edited_amount'] - $item_discount;
			$total_discounted_item_price = $quote_prod['QuotationProduct']['qty'] * $discounted_item_price;
			
			
            $prod_prop = [];
            foreach ($quote_prod['QuotationProductProperty'] as $i=>$desc) {
                $tmp = strtolower($desc['property']);
                if($tmp == "Material" || $tmp == "Materials" || $tmp == "material"
                   || $tmp == "materials") {
                    $ppn[$i] = 'Materials (General Info)';
                }
                else if($tmp == "Dimension" || $tmp == "Dimensions" || $tmp == "dimension"
                   || $tmp == "dimensions") {
                    $ppn[$i] = 'Dimension Info';
                }
                else {
                    $ppn[$i] = ucwords($tmp);
                }
                
                if (is_null($desc['property'])) {
                    $tmp2 = strtolower($desc['ProductProperty']['name']);
                    if($tmp2 == "Material" || $tmp2 == "Materials" || $tmp2 == "material"
                       || $tmp == "materials") {
                        $ppn[$i] = 'Materials (General Info)';
                    }
                    else if($tmp2 == "Dimension" || $tmp2 == "Dimensions" || $tmp2 == "dimension"
                       || $tm2p == "dimensions") {
                        $ppn[$i] = 'Dimension Info';
                    }
                    else {
                        $ppn[$i] = ucwords($tmp2);
                    }
                  
                    if($tmp2!="made in" && $tmp2!="madein") {
                        $prod_prop[] = ''. $ppn[$i] . ' : ' . ucwords($desc['ProductValue']['value']) . '<br/>';
                    }
                } else {
                    if($tmp!="made in" && $tmp!="madein") {
                        $prod_prop[] = '' . $ppn[$i]. ' : ' . ucwords($desc['value']) . '<br/>';
                    }
                }
            }
            $other_infoes = str_replace('</p>', '', $quote_prod['QuotationProduct']['other_info']);
            $other_infoes =  str_replace('<p>', '<br/>', $other_infoes);
            $other_infoes =  str_replace('<strong>', '', $other_infoes);
            $other_info2 =  str_replace('</strong>', '', $other_infoes);
            // ==> UNCOMMENT CODE below to sort properties and values alphabetically.
            // natcasesort($prod_prop);
            // ==> END OF SORT CODE
            
            
            //thumnail start
            
            $img = $this->thumbnail($quote_prod['QuotationProduct']['image'], 400, 519);
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
            // thumbnail end
            $product_details[] = '<tr style=" font-family:Arial; ">
                <td width="15" align="left"><p style="font-size:11px">' . $cnt . '</p></td>
                <td width="140" align="center"><p style="font-size:11px">' . $quote_prod['Product']['name'] . '</p></td>
                
                <td width="" align="center"><img class="img-responsive" style="width:80px;" src="'.$src.'"></td>
                <td width="200"><p style="font-size:11px">
                    ' . $other_info2 . '
                    <div>' . implode($prod_prop) . '</div><br/><br/><br/></font>
                </td>
                <td width="20" align="center"><p style="font-size:11px">' . abs($quote_prod['QuotationProduct']['qty']) . '</p></td>
                <td width="100" align="right"><p style="font-size:11px">&#8369;  ' . number_format($discounted_item_price, 2) . '</p></td> 
                <td width="120" align="right"><p style="font-size:11px">&#8369;  ' . number_format($total_discounted_item_price, 2) . '</p></td></tr>';

            $cnt++;
			$new_sub_total = $new_sub_total + $total_discounted_item_price;
        }
		
		
		$new_grand_total =  $new_sub_total + ($quotation['Quotation']['installation_charge'] + $quotation['Quotation']['delivery_charge']);
		
        if ($quotation['Quotation']['installation_charge'] != 0) {
            $installation_charge = '&#8369;  ' . number_format($quotation['Quotation']['installation_charge'], 2);
            $install = '
                 <tr align="right">
                    <td align="right" >Installation charge:</td>
                    <td style="text-align:right"> ' . $installation_charge . '</td>
                  </tr>';
        } else {
            $installation_charge = "";
            $install = "";
        }

        if ($quotation['Quotation']['delivery_charge'] != 0) {
            $delivery_charge = '&#8369;  ' . number_format($quotation['Quotation']['delivery_charge'], 2);
            $del = '
                <tr  align="right">
                    <td style="width:50%" align="right">Delivery charge: </td>
                    <td  style="text-align:right">' . $delivery_charge . '</td>
                </tr>';
        } else {
            $delivery_charge = "";
            $del = "";
        }

        if ($quotation['Quotation']['discount'] != 0) {
            /*$discount = '&#8369;  ' . number_format($quotation['Quotation']['discount'], 2);
            $dis = '
                  <tr align="right">
                    <td style="width:50%" align="right">Discount: </td>
                    <td  style="text-align:right">' . $discount . ' </td>
                  </tr>';*/
				  
            $discount = "";
            $dis = "";
        } else {
            $discount = "";
            $dis = "";
        }

        if ($quotation['Quotation']['installation_charge'] != 0 || $quotation['Quotation']['delivery_charge'] != 0 ) {
            $sub = '
                <tr  align="right">
                    <td  align="right">Sub total:</td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($new_sub_total, 2) . '<br/> <br/></td> 
                 </tr>';
        } else {
            $sub = "";
        }

        ////// PRODUCT DETAILS END //////
        $html = '<body style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;
             line-height: 1.42857143; font-size: 11px;
             A_CSS_ATTRIBUTE:all;position: absolute;top: 25px; ">
            <div style="font-family:Arial; top: 35px;  font-size:14px; ">  
            <table style=" font-family:Arial;  width: 100%; border:1px ">
                <tr>
                    <td style="text-align: left;width:25%; font-size:10px;">
                     
                        <img src="../img/jecams/quotation.png" width="170" height="35">  
                    </td>
                    <td style="text-align: right;width:40%; font-size:15px;padding-right:20px;">
                        PCAB Accredited Contractor
                    </td> 
                    <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                        <p style="margin-top: -5px;">www.jecams.com.ph</p>
                    </td> 
                </tr>
            </table>
            <table style="font-family:Arial; " border="0">
                <tr>
                    <td width="320" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
                        <font style="font-size:12px;">From:</font>
                        <font style="font-size:10px;"> 
                        <p class="marginedQuoteHeaderFirst"><b>JECAMS INC.</b></p>
                        <p style="margin-top: -5px;">' . $my_team['Team']['location'] . '</p> 
                            ' . $other_team_locations . '
                        <p style="margin-top: -5px;">' . $my_team_telephone . '</p> 
                        <p style="margin-top: -5px;"><b>Prepared By: </b>' . $prepared_by . '</p> 
                        </font><br/><br/><br/> 
                    </td>
            
                    <td width="240" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                        <font style="font-size:12px;">To:</font>
                        <font style="font-size:10px;">
                        <p style="margin-top: 2px;"><b>' . $client_name . '</b></p>
                        <p style="margin-top: -5px;">Contact person:' . ucwords($contact_person) . '</p>
                        <p style="margin-top: -5px;">Phone:' . $contact_number . '</p>
                        <p style="margin-top: -5px;">Email:' . $email . '</p>
                        <p style="margin-top: -5px;">Address:' . ucwords($address) . '</p>
                        </font> 
                    </td> 
                    <td width="200" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                        <font style="font-size:11px;">
                        <p style="margin-top: -5px;"><b>Quotation No.:</b> ' . $quotation['Quotation']['quote_number'] . '</p>  
                        <p>Date Created: ' . date('F d, Y', strtotime($quotation['Quotation']['created'])) . '</p>
                        <p>Valid Till: ' . date('F d, Y', strtotime($quotation['Quotation']['validity_date'])) . '</p>
                         ' . $bill_ship_address . '
                         </font>  
                    </td>
                </tr>   
            </table>
            <br/><br/><br/><br/>
            <table border="0"   style="font-family:Arial;width: 100%; border-collapse:collapse;font-size:12px; " align="center">
                <tr>
                    <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
                    <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
                    <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
                    <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
                    <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
                    <td align="center"  style="font-size:11px;">&nbsp;&nbsp;&nbsp;<b>Discounted Price</b></td>
                    <td align="right"  style="font-size:12px; "> <b>Total</b><br/> <br/><br/></td>
                </tr>
                ' . implode($product_details) . '
                <tr><td colspan="7">&nbsp;</td></tr>
                <tr><td colspan="7">&nbsp;</td></tr>
                <tr>
                    <td colspan="4">
                        <p class="lead" style="font-size:12px;">Payment Methods:</p><br/>
                        <img src="../img/jecams/metro.jpg" alt="metrobank" style="width:50px"/>
                        <img src="../img/jecams/china.jpg" alt="chinabank" style="width:45px"/>
                        <img src="../img/jecams/bdo.jpg" alt="BDO" style="width:45px"/>
                        <img src="../img/jecams/bpi.jpg" alt="BPI" style="width:45px"/>
                        <img src="../img/jecams/cash.jpg" alt="cash"  style="width:45px" />
                        <img src="../img/jecams/check.jpg" alt="check"  style="width:45px" /> 
                    </td> 
                    <td colspan="3" align="right">
                        <table width="100%" style="font-family:Arial; font-size:12px;">
                            ' . $sub . '
                            ' . $install . '
                            ' . $del . '
                            ' . $dis . '
                              <tr>
                                <td align="right" width="100px"><b>Grand Total:</b><br/> <br/></td>
                                <td style="text-align:right">&#8369; ' . number_format($new_grand_total, 2) . ' </td>
                              </tr>
                        </table>
                    </td> 
                </tr>
            </table> 
            </div>
            </body>
            ';
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->Mpdf->WriteHTML($html);

        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
                '', '', '', '', '', // margin_left
                '', // margin right
                15, // margin top
                30, // margin bottom
                10, // margin header
                10);
        $this->layout = 'pdf';
        $this->render('quotation_discount');
        $this->Mpdf->setFilename('quotation_discount.pdf');
    }

}