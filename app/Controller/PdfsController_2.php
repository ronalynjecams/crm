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
        $this->Mpdf->init();

        $quotation_id = $this->params['url']['id'];

        $this->loadModel('Quotation');
        $this->Quotation->recursive = 2;
        $quotation = $this->Quotation->findById($quotation_id);
        $this->set(compact('quotation'));
        
        $this->Mpdf->SetHTMLHeader('<div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;
                                    padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->SetHTMLFooter('<table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;
                                    font-size:14px;width: 100%;padding-bottom:-15px;">
                                    <tr>
                                        <td style="text-align: left;width:70%;font-size:10px;">
                                            Q ' . $quotation['Quotation']['quote_number'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please review our Terms and Conditions at the last page.</td>
                                        <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
                                    </tr>
                                </table> ');


        $terms_info = '<p style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;margin-top: -5px;"><font size="6">' . $quotation['Quotation']['terms_info'] . '</font></p>';

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

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
        foreach ($quote_products as $quote_prod) {
            $prod_prop = [];
            foreach ($quote_prod['QuotationProductProperty'] as $i=>$desc) {
                $tmp = ucwords(strtolower($desc['property']));
                if($tmp == "Material" || $tmp == "Materials" || $tmp == "material"
                   || $tmp == "materials") {
                    $ppn[$i] = '<font style="font-weight:bold">Materials (General Info)</font>';
                }
                else if($tmp == "Dimension" || $tmp == "Dimensions" || $tmp == "dimension"
                   || $tmp == "dimensions") {
                    $ppn[$i] = '<font style="font-weight:bold">Dimension Info</font>';
                }
                else {
                    $ppn[$i] = $tmp;
                }
                if (is_null($desc['property'])) {
                    $tmp2 = $desc['ProductProperty']['name'];
                    if($tmp2 == "Material" || $tmp2 == "Materials" || $tmp2 == "material"
                       || $tmp == "materials") {
                        $ppn[$i] = '<font style="font-weight:bold">Materials (General Info)</font>';
                    }
                    else if($tmp2 == "Dimension" || $tmp2 == "Dimensions" || $tmp2 == "dimension"
                       || $tm2p == "dimensions") {
                        $ppn[$i] = '<font style="font-weight:bold">Dimension Info</font>';
                    }
                    else {
                        $ppn[$i] = $tmp2;
                    }
                    
                    if($tmp!="Made In") {
                        $prod_prop[] = '<li class="list-group-item"> '. $ppn[$i] . ' : ' . ucwords($desc['ProductValue']['value']) . '</li>';
                    }
                } else {
                    if($tmp!="Made In") {
                        $prod_prop[] = '<li class="list-group-item"> ' . $ppn[$i]. ' : ' . ucwords($desc['value']) . '</li>';
                    }
                }
            }
            $other_infoes = str_replace('</p>', ' ', $quote_prod['QuotationProduct']['other_info']);
            $other_info2 =  str_replace('<p>', '<br/>', $other_infoes);
            natcasesort($prod_prop);
            
            //thumnail start
            
            $img = $this->thumbnail($quote_prod['Product']['image'], 120, 120);
			// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
		
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
			// Echo out a sample image
			//$data[$count][$key] =  '<img src="' . $src . '">';
			//<td width="120" align="center"><img class="img-responsive" src="../img/product-uploads/' . $quote_prod['Product']['image'] . '" width="20%"></td>
            //<td width="120" align="center"><img class="img-responsive" src="'.$src.'"></td>
            
            // thumbnail end
            
            $product_details[] = '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"><b>' . $quote_prod['Product']['name'] . '</b></td>
                
                <td width="120" align="center"><img class="img-responsive" src="'.$src.'"></td>
                <td width="200"> <br/><br/>
                      <ul class="list-group">' . implode($prod_prop) . ' 
                        </ul>
                         ' . $other_info2 . '
                        </td>
                <td width="20" align="center">' . abs($quote_prod['QuotationProduct']['qty']) . '</td>
                <td width="100" align="right">&#8369;  ' . number_format($quote_prod['QuotationProduct']['edited_amount'], 2) . '</td> 
                <td width="120" align="right">&#8369;  ' . number_format($quote_prod['QuotationProduct']['total'], 2) . '</td></tr>';

            $cnt++;
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
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($quotation['Quotation']['sub_total'], 2) . '<br/> <br/></td> 
                 </tr>';
        } else {
            $sub = "";
        }
        ////// PRODUCT DETAILS END //////

        $this->Mpdf->WriteHTML('<div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;top: 35px; left:18px;  font-size:14px; ">
            <table style=" font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143; width: 100%; border:1px ">
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
            <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;" border="0">
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
            <table border="0" cellpadding="0" cellspacing="0" 
                   style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px; "
                   align="center">
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
                        <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:12px;width:250" align="right">
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
        $this->Mpdf->SetHTMLHeader('<div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');

        $dis = $purchase_order['PurchaseOrder']['discount'];
        
        // pr($dis); exit;
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

        // $ewt = $purchase_order['PurchaseOrder']['ewt'];
        $grand_total = $purchase_order['PurchaseOrder']['grand_total'];
        $total_purchased = $purchase_order['PurchaseOrder']['total_purchased'];


        ////// PRODUCT DETAILS START //////

        // $this->loadModel('PoProduct');
        $this->loadModel('PurchaseOrderProduct');
        $this->PurchaseOrderProduct->recursive = 2;
        $quote_products = $this->PurchaseOrderProduct->find('all', array(
            'conditions' => array('PurchaseOrderProduct.purchase_order_id' => $po_id)
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
//                <td width="120" align="center"><img class="img-responsive" src="/img/product-uploads/' . $prod['Product']['image'] . '" width="70" height="70"></td>
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
        $html = ' <div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:14px; top: 35px; left:18px;  font-size:10px; ">
    <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
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
    <table border="0" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
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
<table border="0" cellpadding="0" cellspacing="0"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px; " align="center">
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
    // pr($quote_products);exit;
      foreach ($quote_products as $prod) {
        //   pr($prod);
            $total = $prod['PurchaseOrderProduct']['qty'] * $prod['PurchaseOrderProduct']['list_price'];
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

            //thumnail start
            
            $img = $this->thumbnail($prod['ProductCombo']['Product']['image'], 120, 120);
			// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
		
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
			// Echo out a sample image
			//$data[$count][$key] =  '<img src="' . $src . '">';
			//<td width="120" align="center"><img class="img-responsive" src="/img/product-uploads/' . $prod['ProductCombo']['Product']['image'] . '" width="70" height="70"></td>
			//<td width="120" align="center"><img class="img-responsive" src="'.$src.'"></td>
            
            // thumbnail end

            $html .= '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"><b>' . $prod['ProductCombo']['Product']['name'] . '</b></td>
                <td width="120" align="center"><img class="img-responsive" src="'.$src.'"></td>
                <td width="200"> 
                      <ul class="list-group">' ;
                    foreach ($prod['ProductCombo']['ProductComboProperty'] as $desc) {
                        // pr($desc);
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
                <td width="20">' . abs($prod['PurchaseOrderProduct']['qty']) . '</td>
                <td width="100" align="right">&#8369;  ' . number_format($prod['PurchaseOrderProduct']['list_price'], 2) . '</td> 
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
            <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:12px;width:250" align="right">
                ' . $discount . '
                  <tr>
                    <td style="width:50%" align="right"><b>Total Purchased:</b><br/> <br/></td>
                    <td  style="text-align:right">&#8369;  ' . number_format($purchase_order['PurchaseOrder']['total_purchased'], 2) . ' </td>
                  </tr> 
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
        $stylesheet = file_get_contents('/css/style.css');
        $this->Mpdf->WriteHTML($stylesheet,1);


        
        $this->loadModel('DeliverySchedule');
        $dr_id = $this->params['url']['id'];
        $this->DeliverySchedule->recursive = 2;
        $delivery = $this->DeliverySchedule->findById($dr_id);
        $this->Mpdf->SetHTMLHeader('<div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');

       $approved_by = $delivery['DeliverySchedule']['approved_by'];
       
       if($approved_by == 0){
           $approved_by = '<font style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:10px;color:red">Unapproved</font>';
       } else{
           $user = $this->User->findById($approved_by);
           $approved_by = '<font style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:10px;">Approved By : '.$user['User']['first_name'].' '.$user['User']['last_name'].'</font>';
       }
//        pr($delivery); exit;
        $cnt = 1;
        $sub_total = 0;
        $product_details = $delivery['DeliverySchedProduct'];
        // pr($product_details); exit;

$this->Mpdf->autoPageBreak = true; 
$mpdf->shrink_tables_to_fit = 1;
$this->Mpdf->AddPage();
        $html = ' <div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143; top: 35px; left:18px;  font-size:10px; ">
    <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
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
    <table border="0" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
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
            <p style="margin-top: -5px;"><b>DR Number:</b>'. $delivery['DeliverySchedule']['dr_number'] . '</p>  
            <p>' .$approved_by. '</p>
        
             </font>  
        </td>
    </tr>   
</table>
<br/><br/><br/><br/> 
<br/><br/><br/><br/>
<table border="0" cellpadding="0" cellspacing="0"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px; " align="center">
    <tr>
        <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
        <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
        <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
        <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
        <td   align="right"  style="font-size:12px; "> <b>Status</b><br/> <br/><br/></td>
    </tr>
    ' ;
    $myCtr = 0;
      foreach ($product_details as $prod) {
        // $product_id = $prod['QuotationProduct']['product_id'];
        $quotation_product_id = $prod['reference_num'];
        
        $this->loadModel('QuotationProduct');
        // $this->QuotationProduct->recursive = -1;
        $quotation_product = $this->QuotationProduct->find('first', array('conditions' => array('QuotationProduct.id' => $quotation_product_id)));
        
        // pr($quotation_product); exit;
        
        // $this->loadModel('Product');
        // $this->Product->recursive = -1;
        // $product = $this->Product->find('first', array('conditions' => array('Product.id' => $product_id)));
        
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

            //thumnail start
            
            $img = $this->thumbnail($quotation_product['Product']['image'], 120, 120);
			// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
		
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
			// Echo out a sample image
			//$data[$count][$key] =  '<img src="' . $src . '">';
			//<td width="130" align="center"><img class="img-responsive" src="/img/product-uploads/' . $quotation_product['Product']['image'] . '" width="70" height="70"></td>
            //<td width="120" align="center"><img class="img-responsive" src="'.$src.'"></td>
            
            // thumbnail end
            
            $html .= '<tr>
                <td width="120" align="left"><b>' . $quotation_product['Product']['name'] . '</b></td>
                <td width="130" align="center"><img class="img-responsive" src="'.$src.'"></td>
                <td width="260"> 
                      <ul class="list-group">' ;
                    foreach ($quotation_product['QuotationProductProperty'] as $desc) {
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
<table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:14px;"> 
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
    
    
    public function print_soa() {
        $this->Mpdf->init();

        $soa_id = $this->params['url']['id'];

        $this->loadModel('StatementOfAccount');
        $this->loadModel('CollectionPaper');
        $this->loadModel('Collection');
        
        $soa = $this->StatementOfAccount->findById($soa_id);
        $collections = $this->Collection->find('all',
                      ['conditions'=>
                        ['quotation_id'=>$soa['StatementOfAccount']['quotation_id'],
                         'Collection.status'=>'verified',
                         'Collection.type !='=>'none'],
                        ['fields'=>['Collection.id']]]); 
        //mae ids lang kukunin mo sa query na to?yaan iespecify mo TAMA!
        // :D //patapos ka na pakatapos kaini pahingaluan mo naman ta sa aga naman achan pag turog ka na isend ko ang task mo kay para hanggang next week na ini hahahaha
        //hahaha sige po salamat ate Ron. aayusin ko na po to ok
        
        $tbody = '';
        // foreach($collections as $collection) {
        //     $tbody .= '<tr><td style="border: 1px solid black;padding: 3px;">'.date("F d, Y", strtotime($collection['Collection']['created'])).'</td><td style="border: 1px solid black;padding: 3px;">';
        //     $collection_id = $collection['Collection']['id'];
        
        //     $this->CollectionPaper->recursive = -1;
        //     $collection_papers = $this->CollectionPaper->find('all', ['conditions'=>['collection_id'=>$collection_id]]);
        //     foreach($collection_papers as $collection_paper) {
        //         $ref_num = $collection_paper['CollectionPaper']['ref_number'];
        //         $tbody .= $ref_num;
        //     }
        //     $tbody .= '     </td>
        //                     <td style="border: 1px solid black;padding: 3px;" align="right"> ₱ '.number_format((float)$soa['StatementOfAccount']['collected_amount'], 2, '.', '').'</td>
        //                     <td style="border: 1px solid black;padding: 3px;" align="right"> ₱ '.number_format((float)$soa['StatementOfAccount']['balance'], 2, '.', '').'</td>
        //               </tr>';
        // }
        
        
        
        foreach($collections as $collection) {
            $tbody .= '<tr><td style="border: 1px solid black;padding: 3px;">'.date("F d, Y", strtotime($collection['Collection']['created'])).'</td><td style="border: 1px solid black;padding: 3px;">';
            $collection_id = $collection['Collection']['id'];
        
            $this->CollectionPaper->recursive = -1;
            $collection_papers = $this->CollectionPaper->find('all', ['conditions'=>['collection_id'=>$collection_id]]);
            foreach($collection_papers as $collection_paper) {
                $ref_num = $collection_paper['CollectionPaper']['ref_number'];
                $tbody .= $ref_num;
            }
            $paid = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'] + $collection['Collection']['other_amount'];
            $bal = $soa['Quotation']['grand_total'] - $paid;
            $tbody .= '     </td>
                            <td style="border: 1px solid black;padding: 3px;" align="right"> ₱ '.number_format($paid, 2).'</td>
                            <td style="border: 1px solid black;padding: 3px;" align="right"> ₱ '.number_format($bal, 2).'</td>
                       </tr>';
        }
        
        $this->Mpdf->SetHTMLHeader('<div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->SetHTMLFooter(' <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;width: 100%;padding-bottom:-15px;  ">
                                        <tr>
                                            <td style="text-align: left;width:70%;font-size:10px;">
                                                SOA # ' . $soa['StatementOfAccount']['soa_number'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
                                        </tr>
                                    </table> ');
        $this->Mpdf->autoPageBreak = true; 
        $mpdf->shrink_tables_to_fit = 1;

        $html = '<div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143; top: 35px; left:18px;  font-size:16px; ">
                    <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
                        <tr>
                            <td style="text-align: left;width:25%; font-size:10px;">
                                <img src="../img/jecams/logo_full.png" width="170" height="35">  
                            </td>
                            <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                                <p style="margin-top: -5px;">www.jecams.com.ph</p>
                            </td> 
                        </tr>
                    </table>
                    <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;width: 100%" border="0">
                        <tr>
                            <td width="320" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
                                <font style="font-size:12px;">From:</font>
                                <font style="font-size:10px;"> 
                                    <p style="font-weight:bold">JECAMS INC.</p>
                                    <p style="margin-top: -5px;">3 Queen St.Forest Hills Novaliches Quezon City 1117</p>  
                                    <p style="margin-top: -5px;">Tel: 358.8149 / 921.1033</p>
                                    <p>Website: www.jecams.com.ph</p>
                                </font>
                            </td>
                    
                            <td width="240" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                                <font style="font-size:12px;">To:</font>
                                <font style="font-size:10px;">
                                    <p style="font-weight:bold">'.$soa['Client']['name'].'</p>
                                    <p>Bill to: '.$soa['Client']['address'].'</p>
                                    <p>Phone: '.$soa['Client']['contact_number'].'</p>
                                    <p>Email: '.$soa['Client']['email'].'</p>
                                </font> 
                            </td> 
                            <td width="240" align="left" style="padding-left:5px;padding-right:5px;padding-bottom:-20px;">
                                <font style="font-size:13px;">Statement of Account</font>
                                <font style="font-size:11px;">
                                    <p style="font-weight:bold">Statement number: '.$soa['StatementOfAccount']['soa_number'].'</p>
                                    <p><b>Quotation #:</b> '.$soa['Quotation']['quote_number'].'</p>
                                </font>
                            </td>
                        </tr>   
                    </table>
                    
                    <br/><br/><br/>
                    
                    <div>
                        <font style="font-size:12px;">STATEMENT OF ACCOUNT</font><br/>
                        <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;" border="0" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td width="500" align="left">Contract Amount: '.number_format($soa['Quotation']['grand_total'],2).'</td>
                                    <td width="500" align="right">Payment Due Date: '.date("F d, Y",strtotime($soa['Quotation']['collection_due'])).'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:12px;width: 100%;border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;padding: 3px;">Date</th>
                                <th style="border: 1px solid black;padding: 3px;">References</th>
                                <th style="border: 1px solid black;padding: 3px;">Payment</th>
                                <th style="border: 1px solid black;padding: 3px;">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        '.$tbody.'
                        </tbody>
                    </table>
                </div>
                <br/><br/><br/><br/>
                <div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:9px">
                    <font style="font-size:15px;font-weight:bold;">Remittance</font><br/>
                    Customer Name: '.$soa['Client']['name'].'<br/>
                    Statement #: '.$soa['StatementOfAccount']['soa_number'].'<br/>
                    Date: '.date("F d, Y").'<br/>
                    Amount due: ₱ '.number_format($bal, 2).'
                </div>
                ';
                                        
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->Mpdf->WriteHTML($html);
        
        $this->layout = 'pdf';
        $this->render('print_soa');
        $this->Mpdf->setFilename('soa.pdf');
    }
    
    public function print_sales() {
        $this->loadModel('Quotation');
        $this->loadModel('Collection');
        $this->loadModel('Team');
        $this->loadModel('User');
        
        $title = "";
        $user_id = $this->Auth->user('id');
        $range = $this->params['url']['range'];
        $current_year = date("Y");
        $table_body = '';
        
        $grand_total = 0.000000;
        $col_total = 0.000000;
        $year_contract_total = 0.000000;
        $year_paid_total = 0.000000;
        
        if(array_key_exists("team_id", $this->params['url'])==true) {
            $team_id = $this->params['url']['team_id'];
            $this->loadModel('AgentStatus');
            $get_agent_statuses = $this->AgentStatus->find('all');
            
            $get_users_tmp = $this->User->find('all',
                ['conditions'=>['active'=>1,
                                'role'=>'sales_executive']]);
            
            $teamname = '';
            $sales_agents = [];          
            foreach($get_agent_statuses as $ret_agent_statuses) {
                $agent_status = $ret_agent_statuses['AgentStatus'];
                $team = $ret_agent_statuses['Team'];
                $team_sales_manager_id = $team['team_manager'];
                
                if($team_sales_manager_id==$user_id) {
                    $sales_agents[] = $agent_status['user_id'];
                }
                
                if($team['id']==$team_id) {
                    $teamname = ucwords('Team '.$team['name']);
                }
            }
            
            $get_users = [];
            $this->User->recursive = -1;
            foreach($get_users_tmp as $ret_users_tmp) {
                $user_tmp = $ret_users_tmp['User'];
                $ret_users_tmp_id = $user_tmp['id'];
                
                if(in_array($ret_users_tmp_id, $sales_agents)) {
                    $this->User->recursive = -1;
                    $get_users[] = $this->User->findById($ret_users_tmp_id, 'id');
                }
            }
            
            $team_salesagent = [];
            foreach($get_users as $ret_users) {
                $u_obj = $ret_users['User'];
                $u_id = $u_obj['id'];
                $team_salesagent[] = $u_id;
            }
        }
        
        if($range == "y") {

            $title = '<div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                <font style="font-size:16px;font-weight:bold;color:#1a1a1a">'.$current_year.' Sales Report<font><br/>
                <font style="font-size:11px;">Monthly Summary</p>
            </div>';
            
            for($m=1;$m<=12;$m++) {
                $month = date("F",mktime(0, 0, 0, $m));
                if(array_key_exists("salesagent", $this->params['url'])==true) {
                    $salesagent = $this->params['url']['salesagent'];
                    $quotations[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.user_id'=>$salesagent,
                             'AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                 ['MONTH(date_moved)' => $m]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed']]]]);
                }
                elseif(array_key_exists("team_id", $this->params['url'])==true) {
                    $title = '<div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                                <font style="font-size:15px;">'.$teamname.'</p>
                                <font style="font-size:16px;font-weight:bold;color:#1a1a1a">'.$current_year.' Sales Report<font><br/>
                                <font style="font-size:11px;">Monthly Summary</p>
                            </div>';
                    $quotations[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.user_id'=>$team_salesagent,
                             'AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                 ['MONTH(date_moved)' => $m]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed']]]]);
                }
                else {
                    $quotations[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                 ['MONTH(date_moved)' => $m]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed']]]]);
                }
                $collections = [];
                $tot_grand_total = [];
                $grand_total = 0.000000;
                $total_paid_amount = 0.000000;
                if(!empty($quotations[$m])) {
                    foreach($quotations[$m] as $quotation_obj) {
                        $quotation = $quotation_obj['Quotation'];
                        $quotation_id = $quotation['id'];
                        $grand_total += $quotation['grand_total'];
        
                        $tot_grand_total[$m] = $grand_total;
                        
                        $this->Collection->recursive = -1;
                        $collections[$quotation_id] = $this->Collection->find('all',
                            ['conditions'=>['Collection.quotation_id'=>$quotation_id]]);
                                            
                        foreach($collections[$quotation_id] as $collection_obj) {
                            $collection = $collection_obj['Collection'];
                            $total_paid_amount += $collection['amount_paid'];
                        }
                    }
                }
                else {
                    $tot_grand_total[$m] = 0;
                }
                $year_contract_total += $tot_grand_total[$m];
                $year_paid_total += $total_paid_amount;
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$month.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$tot_grand_total[$m],2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            }
            
            $table = '
                <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Contract Amount</th>
                            <th>Grand Total</th>
                            <th>Cancelled Quotations</th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$table_body.'
                    
                        <tr>
                            <td width="25%"></td>
                            <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$year_contract_total,2,'.',',').'</td>
                            <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">Php '.number_format((float)$year_paid_total,2,'.',',').'</td>
                            <td width="25%"></td>
                        </tr>
                    </tbody>
                </table>
                ';
        }
        elseif($range == "m") {
            
            $current_mo = date("m");
            $full_mo = date("F");
            $tbody = 'No Sales Report';
            
            if(array_key_exists("team_id", $this->params['url'])==true) {
                $team_id = $this->params['url']['team_id'];
                $this->Team->recursive = -1;
                $get_team = $this->Team->findById($team_id, 'team_manager');
                $team_manager_id = $get_team['Team']['team_manager'];
                $this->User->recursive = -1;
                $get_team_manager = $this->User->findById($team_manager_id,
                    'first_name, last_name');
                $user_obj = [];
                $manager_name_tmp = "";
                if(!empty($get_team_manager['User'])) {
                    $user_obj = $get_team_manager['User'];
                    $first_name = ucwords($user_obj['first_name']);
                    $last_name = ucwords($user_obj['last_name']);
                    $manager_name_tmp = $first_name." ".$last_name;
                }
                
                if($manager_name_tmp != "") { $manager_name = $manager_name_tmp; }
                else { $manager_name = "<font style='color:red'>Unknown</font>"; }
                
                $title .= '
                    <div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                        <font style="font-size:11px;">Manager: '.$manager_name.'</font>
                    </div>
                ';
                
                if(array_key_exists("sd", $this->params['url'])==true && array_key_exists("ed", $this->params['url'])==true) {
                    $start_date = $this->params['url']['sd'];
                    $end_date = $this->params['url']['ed'];
                    
                    $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['DATE(date_moved) BETWEEN ? AND ?'=>[$start_date, $end_date],
                                 'AND'=>
                                    [['Quotation.user_id'=>$team_salesagent],
                                      'OR'=>
                                        [['Quotation.status'=>'approved'],
                                         ['Quotation.status'=>'processed']]]]]);
                    $title .= '
                        <div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                            <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                            <font style="font-size:11px;">('.date("F d, Y", strtotime($start_date))
                                                           .' - '.date("F d, Y", strtotime($end_date)).')</p>
                        </div>';
                }
                else {
                    $title .= '
                    <div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                        <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                        <font style="font-size:11px;">('.$full_mo.' '.$current_year.')</font>
                    </div>';
                    $quotations = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.user_id'=>$team_salesagent,
                             'AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                ['MONTH(date_moved)' => $current_mo]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed']]]]);
                }
            }
            else {
                if(array_key_exists("salesagent", $this->params['url'])==true) {
                    $salesagent = $this->params['url']['salesagent'];

                    $this->User->recursive = -1;
                    $get_user = $this->User->findById($salesagent);
                    $user_obj = $get_user['User'];
                    $sales_agent_name_tmp = ucwords($user_obj['first_name']." ".$user_obj['last_name']);
                    if($sales_agent_name_tmp!="") {
                        $sales_agent_name = $sales_agent_name_tmp;
                    }
                    else {
                        $sales_agent_name = "<font style='color:red'>Unknown</font>";
                    }
                    
                    if(array_key_exists("sd", $this->params['url'])==true
                       && array_key_exists("ed", $this->params['url'])==true) {
                        $start_date = $this->params['url']['sd'];
                        $end_date = $this->params['url']['ed'];

                        $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['DATE(date_moved) BETWEEN ? AND ?'=>[$start_date, $end_date],
                                 'AND'=>
                                    [['Quotation.user_id'=>$salesagent],
                                      'OR'=>
                                        [['Quotation.status'=>'approved'],
                                         ['Quotation.status'=>'processed']]]]]);

                        $title = '
                        <div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                            <font style="font-size:14px;">'.$sales_agent_name.'</p>
                            <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                            <font style="font-size:11px;">('.date("F d, Y", strtotime($start_date))
                                                               .' - '.date("F d, Y", strtotime($end_date)).')</font>
                        </div>';
                    }
                    else {
                        $title = '
                        <div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                            <font style="font-size:14px;">'.$sales_agent_name.'</p>
                            <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                            <font style="font-size:11px;">('.$full_mo.' '.$current_year.')</p>
                        </div>';
                        $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['Quotation.user_id'=>$salesagent,
                                 'AND'=>
                                    [['YEAR(date_moved)' => date('Y')],
                                    ['MONTH(date_moved)' => $current_mo]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed']]]]);
                    }
                }
                else {
                    $title = '
                    <div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                        <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                        <font style="font-size:11px;">('.$full_mo.' '.$current_year.')</p>
                    </div>';
                    $quotations = $this->Quotation->find('all',
                        ['conditions' =>
                            ['AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                ['MONTH(date_moved)' => $current_mo]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed']]]]);
                }
            }
            
            $count_monthly_quotation = 0;
            foreach($quotations as $quotation_obj) {
                $count_monthly_quotation++;
                
                $quotation = $quotation_obj['Quotation'];
                $company = $quotation_obj['Client'];
                $agent = $quotation_obj['User'];
                
                $quotation_id = $quotation['id'];
                if($quotation['date_approved']!=null ||
                   $quotation['date_approved']!="0000-00-00") {
                    $date_approved = date("M. d, Y (h:i A)", strtotime($quotation['date_approved']));
                }
                else {
                    $date_approved = "<font style='color:red'>Not Specified</font>";
                }
                
                if($quotation['quote_number']!="") {
                    $quote_number = $quotation['quote_number'];
                }
                else {
                    $quote_number = "<font style='color:red'>Unknown</font>";
                }
                
                if($company['name']!="") {
                    $company_name = $company['name'];
                }
                else {
                    $company_name = "<font style='color:red'>No Specified</font>";
                }
                
                if(!empty($agent)) {
                    $fname = $agent['first_name'];
                    $lname = $agent['last_name'];
                    $full_name = $fname.' '.$lname;

                    if($full_name=="") {
                        $full_name = "<font style='color:red'>Unknown</font>";
                    }
                }
                else {
                    $full_name = "<font style='color:red'>Unknown</font>";
                }
                
                $contract_amount = number_format((float)$quotation['grand_total'],2,'.',',');
                $grand_total += $quotation['grand_total'];
                $date_created = date("F d, Y", strtotime($quotation['created']));
                
                $colls[$quotation_id] = $this->Collection->find('all',
                    ['conditions'=>['Collection.quotation_id'=>$quotation_id],
                                    'fields'=>['Collection.amount_paid']]);
                $collected_amount = 0;
                foreach($colls[$quotation_id] as $col_obj) {
                    $col = $col_obj['Collection'];
                    $collected_amount += $col['amount_paid'];
                }
                $col_total += $collected_amount;
                $tbody .= '
                    <tr>
                        <td>'.$count_monthly_quotation.'</td>
                        <td>'.$date_approved.'</td>
                        <td>'.$quote_number.'</td>
                        <td>'.$company_name.'</td>
                        <td>'.$full_name.'</td>
                        <td align="right">Php '.$contract_amount.'</td>
                        <td>'.$date_created.'</td>
                        <td align="right">Php '.number_format((float)$collected_amount,2,'.',',').'</td>
                    </tr>
                ';
            }
            
            $table = '
                <table border="1" width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Approved</th>
                            <th>Quotation #</th>
                            <th>Company Name</th>
                            <th>Agent Name</th>
                            <th>Contract Amount</th>
                            <th>Date Created</th>
                            <th>Collected Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$tbody.'
                    <tr>
                        <td colspan="5" align="right"
                            style="font-weight:bold">Grand Total:</td>
                        <td align="right">Php '.number_format((float)$grand_total,2,'.',',').'</td>
                        <td colspan="2" align="right">Php '.number_format((float)$col_total,2,'.',',').'</td>
                    </tr>
                    </tbody>
                </table>
            ';
        }
        elseif($range == "t") {
            if(array_key_exists("salesagent", $this->params['url'])==true) {
                $salesagent = $this->params['url']['salesagent'];
                $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['Quotation.user_id'=>$team_salesagent,
                                 'AND'=>
                                    [['DATE(date_moved)' => date('Y-m-d')]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed']]]]);
                                     
                $collections = [];
                $tot_grand_total = [];
                $grand_total = 0.000000;
                $total_paid_amount = 0.000000;
                if(!empty($quotations)) {
                    foreach($quotations as $quotation_obj) {
                        $quotation = $quotation_obj['Quotation'];
                        $quotation_id = $quotation['id'];
                        $datecreated = date("F d, Y", strtotime($quotation['created']));
                        $grand_total += $quotation['grand_total'];
        
                        $tot_grand_total = $grand_total;
                        
                        $this->Collection->recursive = -1;
                        $collections[$quotation_id] = $this->Collection->find('all',
                            ['conditions'=>['Collection.quotation_id'=>$quotation_id]]);
                                            
                        foreach($collections[$quotation_id] as $collection_obj) {
                            $collection = $collection_obj['Collection'];
                            $total_paid_amount += $collection['amount_paid'];
                        }
                    }
                }
                else {
                    $tot_grand_total = 0;
                    $datecreated = date("F d, Y");
                }
                $year_contract_total += $tot_grand_total;
                $year_paid_total += $total_paid_amount;
                
                $this->User->recursive = -1;
                $get_agentname = $this->User->findById($salesagent);
                $userobj = $get_agentname['User'];
                $fn = $userobj['first_name'];
                $ln = $userobj['last_name'];
                $salesagentname = ucwords($fn." ".$ln);
                $t_date = date("F d, Y");
                $title = '<div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                    <font style="font-size:15px;">'.$salesagentname.'</p>
                    <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Sales Report<font><br/>
                    <font style="font-size:11px;">'.$t_date.'</p>
                </div>';
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$datecreated.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$tot_grand_total,2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            
                $table = '
                    <table width="100%" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Contract Amount</th>
                                <th>Grand Total</th>
                                <th>Cancelled Quotations</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$table_body.'
                        
                            <tr>
                                <td width="25%"></td>
                                <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$year_contract_total,2,'.',',').'</td>
                                <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">Php '.number_format((float)$year_paid_total,2,'.',',').'</td>
                                <td width="25%"></td>
                            </tr>
                        </tbody>
                    </table>
                    ';
            }
            elseif(array_key_exists("team_id", $this->params['url'])==true) {
                $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['Quotation.user_id'=>$team_salesagent,
                                 'AND'=>
                                    [['DATE(date_moved)' => date('Y-m-d')]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed']]]]);
                                     
                $collections = [];
                $tot_grand_total = [];
                $grand_total = 0.000000;
                $total_paid_amount = 0.000000;
                if(!empty($quotations)) {
                    foreach($quotations as $quotation_obj) {
                        $quotation = $quotation_obj['Quotation'];
                        $quotation_id = $quotation['id'];
                        $datecreated = date("F d, Y", strtotime($quotation['created']));
                        $grand_total += $quotation['grand_total'];
        
                        $tot_grand_total = $grand_total;
                        
                        $this->Collection->recursive = -1;
                        $collections[$quotation_id] = $this->Collection->find('all',
                            ['conditions'=>['Collection.quotation_id'=>$quotation_id]]);
                                            
                        foreach($collections[$quotation_id] as $collection_obj) {
                            $collection = $collection_obj['Collection'];
                            $total_paid_amount += $collection['amount_paid'];
                        }
                    }
                }
                else {
                    $tot_grand_total = 0;
                    $datecreated = date("F d, Y");
                }
                $year_contract_total += $tot_grand_total;
                $year_paid_total += $total_paid_amount;
                
                $t_date = date("F d, Y");
                $title = '<div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                    <font style="font-size:15px;">'.$teamname.'</p>
                    <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Sales Report<font><br/>
                    <font style="font-size:11px;">'.$t_date.'</p>
                </div>';
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$datecreated.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$tot_grand_total,2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            
                $table = '
                    <table width="100%" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Contract Amount</th>
                                <th>Grand Total</th>
                                <th>Cancelled Quotations</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$table_body.'
                        
                            <tr>
                                <td width="25%"></td>
                                <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$year_contract_total,2,'.',',').'</td>
                                <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">Php '.number_format((float)$year_paid_total,2,'.',',').'</td>
                                <td width="25%"></td>
                            </tr>
                        </tbody>
                    </table>
                    ';
            }
            else {
                $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['DATE(date_moved)' => date('Y-m-d'),
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed']]]]);
                                     
                $collections = [];
                $tot_grand_total = [];
                $grand_total = 0.000000;
                $total_paid_amount = 0.000000;
                if(!empty($quotations)) {
                    foreach($quotations as $quotation_obj) {
                        $quotation = $quotation_obj['Quotation'];
                        $quotation_id = $quotation['id'];
                        $datecreated = date("F d, Y", strtotime($quotation['created']));
                        $grand_total += $quotation['grand_total'];
        
                        $tot_grand_total = $grand_total;
                        
                        $this->Collection->recursive = -1;
                        $collections[$quotation_id] = $this->Collection->find('all',
                            ['conditions'=>['Collection.quotation_id'=>$quotation_id]]);
                                            
                        foreach($collections[$quotation_id] as $collection_obj) {
                            $collection = $collection_obj['Collection'];
                            $total_paid_amount += $collection['amount_paid'];
                        }
                    }
                }
                else {
                    $tot_grand_total = 0;
                    $datecreated = date("F d, Y");
                }
                $year_contract_total += $tot_grand_total;
                $year_paid_total += $total_paid_amount;
                
                $t_date = date("F d, Y");
                $title = '<div align="center" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;">
                    <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Sales Report<font><br/>
                    <font style="font-size:11px;">'.$t_date.'</p>
                </div>';
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$datecreated.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$tot_grand_total,2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            
                $table = '
                    <table width="100%" style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Contract Amount</th>
                                <th>Grand Total</th>
                                <th>Cancelled Quotations</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$table_body.'
                        
                            <tr>
                                <td width="25%"></td>
                                <td width="25%" style="padding-right:100px;" align="right">Php '.number_format((float)$year_contract_total,2,'.',',').'</td>
                                <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">Php '.number_format((float)$year_paid_total,2,'.',',').'</td>
                                <td width="25%"></td>
                            </tr>
                        </tbody>
                    </table>
                    ';
            }
        }
        else {
            echo "Invalid Sales Report";
            $table = '';
        }
        
        $this->set(compact('quotations'));
        // ==============================
        // ALL MPDF RELATED CODES
        // ==============================
        $html = '
            <table style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;font-size:10px;width:100%;" align="center">
                <tr>
                    <td>
                        <font style="font-weight:bold">Main Office:</font><br/>
                        No. 3 Queen Street Forest Hills, Novaliches, Quezon City 1117<br/><br/>
                        <font style="font-weight:bold">Makati Sales Office:</font><br/>
                        Unit 4B Trans-Phil Building, 1177 Chino Roces Ave. corner Bagtikan St., San Antonio, Makati City BGC Sales<br/><br/>
                        <font style="font-weight:bold">BGC Sales Office:</font><br/>
                        6/F, Icon Plaza, 26th St. Bonifacio Global City, Taguig City
                    </td>
                    <td>
                        <font style="font-weight:bold;">Landline:</font><br/>
                        02 921 1033<br/>02 800-8231 | Makati Sales Office<br/>02 710-4575 | BGC Sales Office<br/><br/>
                        <font style="font-weight:bold;">Email:</font><br/>
                        jecamsinc@gmail.com<br/>admin@jecams.com.ph<br/><br/>
                        <font style="font-weight:bold;">Website:</font><br/>
                        www.jecams.com.ph
                    </td>
                </tr>
            </table>
            
            <br/><br/>
            
            '.$title.'
            
            <br/><br/>
            ';
            
        $html .= $table;

        $this->Mpdf->init();
        
        $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
            <div style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;padding-top:-15px;padding-right:20px; font-size:10px; " align="right">' . date("F d, Y") . '</div><hr/>');
        $this->Mpdf->SetHTMLFooter('<hr/><p align="right" style="font-size:10px">w w w . j e c a m s . c o m . p h</p>');
        
        $this->Mpdf->AddPage('L', 
                '', '', '', '', 8,
                8, // margin right
                25, // margin top
                30, // margin bottom
                10, // margin header
                10);

        $this->Mpdf->WriteHTML($html);
        $this->layout = 'pdf';
        $this->render('print_sales');
        $this->Mpdf->setFilename('sales.pdf');
    }
}