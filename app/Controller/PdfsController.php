<?php 
App::uses('AppController', 'Controller'); 
class PdfsController extends AppController { 
    public $components = array('Paginator', 'Mpdf.Mpdf');
 
    public function index() {
        $this->Pdf->recursive = 0;
        $this->set('pdfs', $this->Paginator->paginate());
    } 
    public function view($id = null) {
        if (!$this->Pdf->exists($id)) {
            throw new NotFoundException(__('Invalid pdf'));
        }
        $options = array('conditions' => array('Pdf.' . $this->Pdf->primaryKey => $id));
        $this->set('pdf', $this->Pdf->find('first', $options));
    } 
    public function add() {
        if ($this->request->is('post')) {
            $this->Pdf->create();
            if ($this->Pdf->save($this->request->data)) {
                $this->Session->setFlash(__('The pdf has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pdf could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
    }
 
    public function edit($id = null) {
        if (!$this->Pdf->exists($id)) {
            throw new NotFoundException(__('Invalid pdf'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Pdf->save($this->request->data)) {
                $this->Session->setFlash(__('The pdf has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pdf could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Pdf.' . $this->Pdf->primaryKey => $id));
            $this->request->data = $this->Pdf->find('first', $options);
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
        $this->Pdf->id = $id;
        if (!$this->Pdf->exists()) {
            throw new NotFoundException(__('Invalid pdf'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pdf->delete()) {
            $this->Session->setFlash(__('The pdf has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The pdf could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function print_quote() {
//if (($this->Auth->user('id') != $quote_data['Quotation']['user_id']) || ($this->Auth->user('role')!= "sales_coordinator") || ($this->Auth->user('role')!= "sales_manager")) {
//            return $this->redirect('/users/error_page');
//        } else {
        $this->Mpdf->init();

        $quotation_id = $this->params['url']['id'];

        $this->loadModel('Quotation');
        $this->Quotation->recursive = 2;
        $quotation = $this->Quotation->findById($quotation_id);
        $this->set(compact('quotation'));

        $this->Mpdf->SetHTMLHeader('<div style="padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->SetHTMLFooter(' <table style="width: 100%;padding-bottom:-15px;  ">
        <tr>
            <td style="text-align: left;width:70%;font-size:10px;">
                Q ' . $quotation['Quotation']['quote_number'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please review our Terms and Conditions at the last page.</td>
            <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
        </tr>
    </table> ');


        $terms_info = '<p style="margin-top: -5px;"><font size="6">' . $quotation['Quotation']['terms_info'] . '</font></p>';

        $terms = $terms_info;

        $this->set(compact('terms'));

        // get team for this quotation
        $this->loadModel('Team');
        $my_team = $this->Team->findById($quotation['Quotation']['team_id']);
        $my_team_telephone = $my_team['Team']['telephone'];

        if ($my_team['Team']['location'] == '<b>Main:</b> 3 Queen St.Forest Hills, Novaliches Quezon City 1117') {
            $other_teams = $this->Team->find('all', array(
                'conditions' => array('Team.location !=' => '<b>Main:</b> 3 Queen St.Forest Hills, Novaliches Quezon City 1117')));
        } else {
            $other_teams = $this->Team->find('all', array(
                'conditions' => array('Team.location !=' => $my_team['Team']['location'], 'Team.id !=' => 2)));
        }

        $ots = [];
        foreach ($other_teams as $other_team) {

            $ots[] = '<p style="margin-top: -5px;">' . $other_team['Team']['location'] . '</p>';
        }

        $other_team_locations = implode("", $ots);

        /////get sales agent who created the quotation
        $prepared_by = $quotation['User']['first_name'] . '  ' . $quotation['User']['last_name'];
        $agent_signature = $quotation['User']['signature'];
        $this->set(compact('prepared_by'));
        $this->set(compact('agent_signature'));

        $this->loadModel('User');
        $manager = $this->User->findById($my_team['Team']['team_manager']);
        $this->set(compact('manager'));
        $team_manager = $manager['User']['first_name'] . '  ' . $manager['User']['last_name'];
        $this->set(compact('team_manager'));
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
                    $bill_ship_address = ' <p><b>Bill & Ship To:</b> ' . $quotation['Quotation']['bill_geolocation'] . '</p> ';
                } else {
                    $bill_ship_address = ' <p><b>Bill & Ship To:</b> ' . $quotation['Quotation']['bill_address'] . ' ' . $quotation['Quotation']['bill_geolocation'] . '</p> ';
                }
            } else {
                $bill_ship_address = ' <p style="font-size:10px"><b>Bill To:</b> ' . $quotation['Quotation']['bill_address'] . ' ' . $quotation['Quotation']['bill_geolocation'] . '</p> '
                        . ' <p style="font-size:10px"><b>Ship To:</b> ' . $quotation['Quotation']['ship_address'] . ' ' . $quotation['Quotation']['ship_geolocation'] . '</p> ';
            }
        } else {
            $bill_ship_address = '<p><b>Delivery Mode: </b>Pick-up</p>';
        }



        ////// PRODUCT DETAILS START //////

        $this->loadModel('QuotationProduct');
        $this->QuotationProduct->recursive = 2;
        $quote_products = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quotation_id, 'QuotationProduct.deleted' => NULL)
        ));
//        pr($quote_products);
//        exit;

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
        foreach ($quote_products as $quote_prod) {
            $prod_prop = [];
            foreach ($quote_prod['QuotationProductProperty'] as $desc) {
                if (is_null($desc['property'])) {
                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
                } else {
                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['property'] . ' : ' . $desc['value'] . '</li>';
                }
            }

            $product_details[] = '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"><b>' . $quote_prod['Product']['name'] . '</b></td>
                <td width="120" align="center"><img class="img-responsive" src="../product_uploads/' . $quote_prod['Product']['image'] . '" width="100" height="100"></td>
                <td width="200"> 
                      <ul class="list-group">' . implode($prod_prop) . '<li class="list-group-item"> '
                    . ' ' . $quote_prod['QuotationProduct']['other_info'] . '<p>&nbsp;<br/></p><br/></li>
                        </ul>
                        </td>
                <td width="20">' . abs($quote_prod['QuotationProduct']['qty']) . '</td>
                <td width="100" align="right">&#8369;  ' . number_format($quote_prod['QuotationProduct']['edited_amount'], 2) . '</td> 
                <td width="120" align="right">&#8369;  ' . number_format($quote_prod['QuotationProduct']['total'], 2) . '</td></tr>';


            $cnt++;
//            $sub_total = $sub_total + $quote_prod['QuotationProduct']['edited_amount'];
        }

        if ($quotation['Quotation']['installation_charge'] != 0) {
            $installation_charge = '&#8369;  ' . number_format($quotation['Quotation']['installation_charge'], 2);
            $install = '
                 <tr align="right">
                    <td align="right" ><b>Installation charge:</b></td>
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
                    <td style="width:50%" align="right"><b>Delivery charge:</b> </td>
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
                    <td style="width:50%" align="right"><b>Discount:</b> </td>
                    <td  style="text-align:right">' . $discount . ' </td>
                  </tr>';
        } else {
            $discount = "";
            $dis = "";
        }

        if ($quotation['Quotation']['installation_charge'] != 0 || $quotation['Quotation']['delivery_charge'] != 0 || $quotation['Quotation']['discount'] != 0) {
            $sub = '
                <tr  align="right">
                    <td  align="right"><b>Sub total:</b></td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($quotation['Quotation']['sub_total'], 2) . '<br/> <br/> 
                 </td> 
                 </tr>';
        } else {
            $sub = "";
        }



        ////// PRODUCT DETAILS END //////

        $this->Mpdf->WriteHTML(' <div style=" top: 35px; left:18px;  font-size:10px; ">
    <table style="width: 100%; border:1px ">
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
    <table border="0">
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
            <p><b>Date Created:</b> ' . date('F d, Y', strtotime($quotation['Quotation']['created'])) . '</p>
            <p><b>Valid Till:</b> ' . date('F d, Y', strtotime($quotation['Quotation']['validity_date'])) . '</p>
             ' . $bill_ship_address . '
             </font>  
        </td>
    </tr>   
</table>
<br/><br/><br/><br/>
<table border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
    <tr>
        <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
        <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
        <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
        <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
        <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
        <td align="right"  style="font-size:12px;"><b>List Price</b><br/> <br/><br/></td>
        <td   align="right"  style="font-size:12px; "> <b>Total</b><br/> <br/><br/></td>
    </tr>
    ' . implode($product_details) . '
        
 <tr>
        <td colspan="3" >
            <p class="lead" style="font-size:12px;">Payment Methods:</p><br/>
            <img src="../img/jecams/metro.jpg" alt="metrobank" style="width:50px"/>
            <img src="../img/jecams/china.jpg" alt="chinabank" style="width:45px"/>
            <img src="../img/jecams/bdo.jpg" alt="BDO" style="width:45px"/>
            <img src="../img/jecams/bpi.jpg" alt="BPI" style="width:45px"/><br/>
            <img src="../img/jecams/cash.jpg" alt="cash"  style="width:45px" />
            <img src="../img/jecams/check.jpg" alt="check"  style="width:45px" /> 
        </td> 
        <td colspan="4" align="right">
            <table style="font-size:12px;width:250" align="right">
                ' . $sub . '
                ' . $install . '
                ' . $del . '
                ' . $dis . '
                  <tr>
                    <td style="width:50%" align="right"><b>Grand Total:</b><br/> <br/></td>
                    <td  style="text-align:right">&#8369;  ' . number_format($quotation['Quotation']['grand_total'], 2) . ' </td>
                  </tr>
                </table>
            </td> 
    </tr>
</table> 
</table> 
</div>
    ');

        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
                '', '', '', '', 5, // margin_left
                5, // margin right
                15, // margin top
                30, // margin bottom
                10, // margin header
                10);
        $this->layout = 'pdf';
        $this->render('print_quote');
        $this->Mpdf->setFilename('quotation.pdf');

//
//        $this->Mpdf->AddLastPage('
//            <div style="A_CSS_ATTRIBUTE:all;position: absolute;top: 25px; left:10px; font-size:10px; ">
//            <table style="width: 100%; border:1px ">
//                <tr>
//                    <td style="text-align: left;width:25%; font-size:10px;">
//                        <img src="../img/jecams/quotation.png" width="170" height="35">  
//                    </td>
//                    <td style="text-align: right;width:65%; font-size:15px;padding-right:20px;">
//                        <img src="../img/jecams/quotation.png" width="170" height="35"> 
//                    </td> 
//                </tr>
//            </table>    
//        </div>
//        <hr style="margin-top:10px;  "/> 
//        <table border="0">
//            <tr>
//                <td width="320" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
//                    <font style="font-size:12px;">From:</font>
//                    <font style="font-size:10px;">
//                    <p class="marginedQuoteHeaderFirst"><b>JECAMS INC</b></p> 
//
//                        </td>
//            </tr>
//        </table>
//        <hr style="margin-top:25px; "/> 
//');
//$this->Mpdf->SetTopMargin('30%');
//        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
//                '', '', '', '', 5, // margin_left
//                5, // margin right
//                15, // margin top
//                30, // margin bottom
//                10, // margin header
//                10); // margin footer
//         $this->Mpdf->LastPage(-1); 
//         $html = 'asdasdasdasd547987';
//         $this->Mpdf->WriteHTML($html);
//$arr['L']['content'] = 'Chapter 2'; 
//$this->Mpdf->SetHeader($arr, 'O');
//
//$this->Mpdf->AddPage();
//
//$this->Mpdf->WriteHTML('Your Book text');
//$this->Mpdf->AddPage();
//
//
//
//    }
    }

//    
//    
    public function print_po() {


        $this->Mpdf->init();




        $this->loadModel('PurchaseOrder');
        $po_id = $this->params['url']['id'];

        $purchase_order = $this->PurchaseOrder->findById($po_id);
        $this->Mpdf->SetHTMLHeader('<div style="padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');

        $dis = $purchase_order['PurchaseOrder']['discount'];
        if ($dis == 0) {
            $discount = "";
        } else {
            $discount = '
                <tr  align="right">
                    <td  align="right"><b>Discount:</b></td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($dis, 2) . '<br/> <br/> 
                 </td> 
                 </tr>';
        }

        $v = $purchase_order['PurchaseOrder']['vat_amount'];
        if ($v == 0) {
            $vat = "";
        } else {
            $vat = '
                <tr  align="right">
                    <td  align="right"><b>12% Vat:</b></td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($v, 2) . '<br/> <br/> 
                 </td> 
                 </tr>';
        }

        $e = $purchase_order['PurchaseOrder']['ewt_amount'];
        if ($e == 0) {
            $ewt = "";
        } else {
            $ewt = '
                <tr  align="right">
                    <td  align="right"><b>1% EWT:</b></td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($e, 2) . '<br/> <br/> 
                 </td> 
                 </tr>';
        }

        $ewt = $purchase_order['PurchaseOrder']['ewt'];
        $grand_total = $purchase_order['PurchaseOrder']['grand_total'];
        $total_purchased = $purchase_order['PurchaseOrder']['total_purchased'];


        ////// PRODUCT DETAILS START //////

        $this->loadModel('PoProduct');
        $this->PoProduct->recursive = 2;
        $quote_products = $this->PoProduct->find('all', array(
            'conditions' => array('PoProduct.purchase_order_id' => $po_id)
        ));

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
//        foreach ($quote_products as $prod) {
//            $total = $prod['PoProduct']['qty'] * $prod['PoProduct']['price'];
//            $prod_prop = [];
//            foreach ($prod['PoProductProperty'] as $desc) {
////                if (is_null($desc['property'])) {
////                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
////                } else {
//                $prod_prop[] = '<li class="list-group-item"> ' . $desc['property'] . ' : ' . $desc['value'] . '</li>';
////                }
//            }
//            
////            if($cnt == 10){
////                $pp = '<pagebreak>';
////            }else{
////                $pp = '';
////            }
//
//            $product_details[] = '<tr>
//                <td width="15" align="left">' . $cnt . '</td>
//                <td width="140" align="center"><b>' . $prod['Product']['name'] . '</b></td>
//                <td width="120" align="center"><img class="img-responsive" src="../product_uploads/' . $prod['Product']['image'] . '" width="70" height="70"></td>
//                <td width="200"> 
//                      <ul class="list-group">' . implode($prod_prop) . '<li class="list-group-item"> '
//                    . ' <p>&nbsp;<br/></p><br/></li>
//                        </ul>
//                        </td>
//                <td width="20">' . abs($prod['PoProduct']['qty']) . '</td>
//                <td width="100" align="right">&#8369;  ' . number_format($prod['PoProduct']['price'], 2) . '</td> 
//                <td width="120" align="right">&#8369;  ' . number_format($total, 2) . '</td></tr>';
//
//
//            $cnt++;
////            $sub_total = $sub_total + $quote_prod['QuotationProduct']['edited_amount'];
//        }



//        $this->Mpdf->shrink_tables_to_fit = 3;
//<table style="width: 100%; border:1px "  repeat_header="3">

$this->Mpdf->autoPageBreak = true; 
$mpdf->shrink_tables_to_fit = 1;
$this->Mpdf->AddPage();
        $html = ' <div style=" top: 35px; left:18px;  font-size:10px; ">
    <table style="width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
        <tr>
            <td style="text-align: left;width:25%; font-size:10px;">
                <img src="../img/jecams/po.JPG" width="170" height="35">  
            </td>
            <td style="text-align: right;width:40%; font-size:15px;padding-right:20px;">
                PCAB Accredited Contractor
            </td> 
            <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                <p style="margin-top: -5px;">www.jecams.com.ph</p>
            </td> 
        </tr>
    </table>
    <table border="0">
    <tr>
        <td width="320" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
            <font style="font-size:12px;">From:</font>
            <font style="font-size:10px;"> 
            <p class="marginedQuoteHeaderFirst"><b>JECAMS INC.</b></p>
            <p style="margin-top: -5px;">3 Queen St.Forest Hills Novaliches Quezon City 1117</p>  
            <p style="margin-top: -5px;">Tel: 358.8149 / 921.1033</p>   
        </td>

        <td width="240" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
            <font style="font-size:12px;">To:</font>
            <font style="font-size:10px;">
            <p style="margin-top: 2px;"><b>' . strtoupper($purchase_order['Supplier']['name']) . '</b></p> 
            </font> 
        </td> 
        <td width="200" align="left" style="padding-left:5px;padding-right:10px;padding-bottom:-50px;">
            <font style="font-size:11px;">
            <p style="margin-top: -5px;"><b>Purchase Order:</b> ' . $purchase_order['PurchaseOrder']['po_number'] . '</p>  
            <p><b>Date Created:</b> ' . date('F d, Y', strtotime($purchase_order['PurchaseOrder']['created'])) . '</p>
            <p><b>Created By:</b> ' . $purchase_order['User']['first_name'] . '  ' . $purchase_order['User']['last_name'] . '</p>
        
             </font>  
        </td>
    </tr>   
</table>
<br/><br/><br/><br/> 
<br/><br/><br/><br/>
<table border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
    <tr>
        <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
        <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
        <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
        <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
        <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
        <td align="right"  style="font-size:12px;"><b>List Price</b><br/> <br/><br/></td>
        <td   align="right"  style="font-size:12px; "> <b>Total</b><br/> <br/><br/></td>
    </tr>
    ' ;
    $myCtr = 0;
      foreach ($quote_products as $prod) {
            $total = $prod['PoProduct']['qty'] * $prod['PoProduct']['price'];
            $prod_prop = [];
//            foreach ($prod['PoProductProperty'] as $desc) {
////                if (is_null($desc['property'])) {
////                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
////                } else {
//                $prod_prop[] = '<li class="list-group-item"> ' . $desc['property'] . ' : ' . $desc['value'] . '</li>';
////                }
//            }
            
//            if($cnt == 10){
//                $pp = '<pagebreak>';
//            }else{
//                $pp = '';
//            }

            $html .= '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"><b>' . $prod['Product']['name'] . '</b></td>
                <td width="120" align="center"><img class="img-responsive" src="../product_uploads/' . $prod['Product']['image'] . '" width="70" height="70"></td>
                <td width="200"> 
                      <ul class="list-group">' ;
                    foreach ($prod['PoProductProperty'] as $desc) {
//                if (is_null($desc['property'])) {
//                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
//                } else {
                $html .= '<li class="list-group-item"> ' . $desc['property'] . ' : ' . $desc['value'] . '</li>';
//                }
            }
                    $html .= '<li class="list-group-item"> 
                     <p>&nbsp;<br/></p><br/></li>
                        </ul>
                        </td>
                <td width="20">' . abs($prod['PoProduct']['qty']) . '</td>
                <td width="100" align="right">&#8369;  ' . number_format($prod['PoProduct']['price'], 2) . '</td> 
                <td width="120" align="right">&#8369;  ' . number_format($total, 2) . '</td></tr>';


//            $cnt++;
//            $sub_total = $sub_total + $quote_prod['QuotationProduct']['edited_amount'];
//            $myCtr++;
//            if($myCtr >= 10) {
//                $this->Mpdf->AddPage();
//                $myCtr = 0;
//            } 
//            
        }
                
    
 $html .= '
        
 <tr>
        <td colspan="3" >  </td> 
        <td colspan="4" align="right">
            <table style="font-size:12px;width:250" align="right">
                  <tr>
                    <td style="width:50%" align="right"><b>Total Purchased:</b><br/> <br/></td>
                    <td  style="text-align:right">&#8369;  ' . number_format($purchase_order['PurchaseOrder']['total_purchased'], 2) . ' </td>
                  </tr> 
                ' . $discount . '
                ' . $vat . ' 
                ' . $ewt . ' 
                  <tr>
                    <td style="width:50%" align="right"><b>Grand Total:</b><br/> <br/></td>
                    <td  style="text-align:right">&#8369;  ' . number_format($purchase_order['PurchaseOrder']['grand_total'], 2) . ' </td>
                  </tr> 
                </table>
            </td> 
    </tr>
</table> 
</table>
</div>
    ';
 $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
//    pr($html); exit;
    $this->Mpdf->WriteHTML($html);


//        $this->set(compact('purchase_order', 'product_details', 'discount', 'vat', 'ewt'));


//           $ctrProd = count($quote_productsc);
//           $ctrPrd = $ctrProd/6;
//           for($i=1; $i<=$ctrPrd; $i++){
               
//        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
//                '', '', '', '', 5, // margin_left
//                5, // margin right
//                15, // margin top
//                30, // margin bottom
//                10, // margin header
//                10);
////           }

//$this->Mpdf->Output();


        $this->layout = 'pdf';
        $this->render('print_po');
        $this->Mpdf->setFilename('PurchaseOrder.pdf');
    }

    
    public function print_dr() {


        $this->Mpdf->init();



        
        $this->loadModel('DeliverySchedule');
        $dr_id = $this->params['url']['id'];
        $this->DeliverySchedule->recursive = 2;
        $delivery = $this->DeliverySchedule->findById($dr_id);
        $this->Mpdf->SetHTMLHeader('<div style="padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');

       $approved_by = $delivery['DeliverySchedule']['approved_by'];
       
       if($approved_by == 0){
           $approved_by = '<font style="font-size:10px;color:red">Unapproved</font>';
       } else{
           $user = $this->User->findById($approved_by);
           $approved_by = '<font style="font-size:10px;">Approved By : '.$user['User']['first_name'].' '.$user['User']['last_name'].'</font>';
       }
//        pr($delivery); exit;
        $cnt = 1;
        $sub_total = 0;
        $product_details = $delivery['DeliverySchedProduct'];

$this->Mpdf->autoPageBreak = true; 
$mpdf->shrink_tables_to_fit = 1;
$this->Mpdf->AddPage();
        $html = ' <div style=" top: 35px; left:18px;  font-size:10px; ">
    <table style="width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
        <tr>
            <td style="text-align: left;width:25%; font-size:10px;">
                <img src="../img/jecams/dr.png" width="170" height="35">  
            </td>
            <td style="text-align: right;width:40%; font-size:15px;padding-right:20px;">
                PCAB Accredited Contractor
            </td> 
            <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                <p style="margin-top: -5px;">www.jecams.com.ph</p>
            </td> 
        </tr>
    </table>
    <table border="0">
    <tr>
        <td width="300" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
            <font style="font-size:12px;">From:</font>
            <font style="font-size:10px;"> 
            <p class="marginedQuoteHeaderFirst"><b>JECAMS INC.</b></p>
            <p style="margin-top: -5px;">3 Queen St.Forest Hills </p>
            <p style="margin-top: -5px;">Novaliches Quezon City 1117</p>  
            <p style="margin-top: -5px;">Tel: 358.8149 / 921.1033</p>   
        </td>

        <td width="260" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
            <font style="font-size:12px;">To:</font>
            <font style="font-size:10px;"> 
            <p class="marginedQuoteHeaderFirst"><b>' . strtoupper($delivery['Quotation']['Client']['name']) . '</b></p>
            <p style="margin-top: -5px;">Contact Person: ' . strtoupper($delivery['Quotation']['Client']['contact_person']) . ' </p>
            <p style="margin-top: -5px;">Phone: ' . strtoupper($delivery['Quotation']['Client']['contact_number']) . ' </p>  
            <p style="margin-top: -5px;">Address: ' . strtoupper($delivery['Quotation']['Client']['address']) . '</p>
        </td> 
        <td width="200" align="left" style="padding-left:5px;padding-right:10px;padding-bottom:-50px;">
            <font style="font-size:11px;">
            <p style="margin-top: -5px;"><b>DR Number:</b> DR-' . $delivery['DeliverySchedule']['dr_number'] . '</p>  
            <p>' .$approved_by. '</p>
        
             </font>  
        </td>
    </tr>   
</table>
<br/><br/><br/><br/> 
<br/><br/><br/><br/>
<table border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
    <tr>
        <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
        <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
        <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
        <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
        <td   align="right"  style="font-size:12px; "> <b>Staus</b><br/> <br/><br/></td>
    </tr>
    ' ;
    $myCtr = 0;
      foreach ($product_details as $prod) {
        $product_id = $prod['QuotationProduct']['product_id'];
        $quotation_product_id = $prod['QuotationProduct']['id'];
        $this->loadModel('Product');
        $this->Product->recursive = -1;
        $product = $this->Product->find('first', array('conditions' => array('Product.id' => $product_id)));
        
        $this->loadModel('QuotationProductProperty');
        $this->QuotationProductProperty->recursive = -1;
        $quotation_product_properties = $this->QuotationProductProperty->find('all', array('conditions' => array('QuotationProductProperty.id' => $quotation_product_id)));
        
//            $total = $prod['PoProduct']['qty'] * $prod['PoProduct']['price'];
            $prod_prop = [];
//            foreach ($prod['PoProductProperty'] as $desc) {
////                if (is_null($desc['property'])) {
////                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
////                } else {
//                $prod_prop[] = '<li class="list-group-item"> ' . $desc['property'] . ' : ' . $desc['value'] . '</li>';
////                }
//            }
            
//            if($cnt == 10){
//                $pp = '<pagebreak>';
//            }else{
//                $pp = '';
//            }

            $html .= '<tr>
                <td width="120" align="left"><b>' . $product['Product']['name'] . '</b></td>
                <td width="130" align="center"><img class="img-responsive" src="../product_uploads/' . $prod['QuotationProduct']['image'] . '" width="70" height="70"></td>
                <td width="260"> 
                      <ul class="list-group">' ;
                    foreach ($quotation_product_properties as $desc) {
//                if (is_null($desc['property'])) {
//                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
//                } else {
                $html .= '<li class="list-group-item"> ' . $desc['QuotationProductProperty']['property'] . ' : ' . $desc['QuotationProductProperty']['value'] . '</li>';
//                }
            }
                    $html .= '<li class="list-group-item"> 
                     <p>&nbsp;<br/></p><br/></li>
                        </ul>
                        </td>
                <td width="40">' . abs($prod['actual_qty']) . '</td>
                <td width="100" align="right"> ' . $prod['status'] . '</td></tr>';

//            $cnt++;
//            $sub_total = $sub_total + $quote_prod['QuotationProduct']['edited_amount'];
//            $myCtr++;
//            if($myCtr >= 10) {
//                $this->Mpdf->AddPage();
//                $myCtr = 0;
//            } 
//            
        }
                
    
 $html .= '
    
        
</table> 
    <tr>
        <td width="100%">
            <br /><br />
            <p>We are pleased that you chose Jecams Inc. for your furniture purchase. We greatly appreciate your business and the opportunity to assist you. At Jecams, we always strive for the best</p>
            <br />
            <p>We hope to be working with you again soon.</p>
            <br />
            <p><b>__________________________________________________</b></p>
            <p><b>Approved by Accounting</b></p>
            <br />
            <p>Delivered By:__________________________________________________</p>
            <p>Date/Time:__________________________________________________</p>
            <br />
            <p>Received in good condition</p>
            <br />
            <p>__________________________________________________</p>
            <p><b>Signature over printed name</b></p>
            <p>Date/Received:__________________________________________________</p>
            <br />
            <p><b>Receiving Time:</b> 9am-11am</p>
            
        </td>
    </tr>
    
</table>
</div>
    ';
 $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
//    pr($html); exit;
    $this->Mpdf->WriteHTML($html);


//        $this->set(compact('purchase_order', 'product_details', 'discount', 'vat', 'ewt'));


//           $ctrProd = count($quote_productsc);
//           $ctrPrd = $ctrProd/6;
//           for($i=1; $i<=$ctrPrd; $i++){
               
//        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
//                '', '', '', '', 5, // margin_left
//                5, // margin right
//                15, // margin top
//                30, // margin bottom
//                10, // margin header
//                10);
////           }

//$this->Mpdf->Output();


        $this->layout = 'pdf';
        $this->render('print_po');
        $this->Mpdf->setFilename('PurchaseOrder.pdf');
    }
}