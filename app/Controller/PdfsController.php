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
                    <td align="right"  style="font-size:12px;"><b>List Price</b><br/> <br/><br/></td>
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

        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
                '', '', '', '', '', // margin_left
                '', // margin right
                15, // margin top
                30, // margin bottom
                10, // margin header
                10);
        $this->layout = 'pdf';
        $this->render('print_quote');
        $this->Mpdf->setFilename('quotation.pdf');
    }

//    
//    
    public function print_po() {
        $this->Mpdf->init();

        $this->loadModel('PurchaseOrder');
        $po_id = $this->params['url']['id'];

        $purchase_order = $this->PurchaseOrder->findById($po_id);
        $this->Mpdf->SetHTMLHeader('<div style="font-family:Arial; padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');

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

$this->Mpdf->autoPageBreak = true; 
$mpdf->shrink_tables_to_fit = 1;
$this->Mpdf->AddPage();
// pr($purchase_order);
        $html = ' <div style="font-family:Arial; font-size:14px; top: 35px; left:18px;  font-size:10px; ">
    <table style="font-family:Arial; width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
        <tr>
            <td style="text-align: left;width:25%; font-size:10px;">
                <img src="../img/jecams/po.JPG" width="200" height="35">  
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
            <p style="margin-top: 2px;"><b>'.$purchase_order['Supplier']['name'].'</b></p> 
            </font> 
        </td> 
        <td width="200" align="left" style="padding-left:5px;padding-right:10px;padding-bottom:-50px;">
            <font style="font-size:11px;">
            <p style="margin-top: -5px;">Purchase Order:</b>'.$purchase_order['PurchaseOrder']['po_number'].'</p>  
            <p>Date Created:'.date('F d, Y', strtotime($purchase_order['PurchaseOrder']['created'])) . '</p>
            <p>Created By: ' . $purchase_order['User']['first_name'] . '  ' . $purchase_order['User']['last_name'] . '</p>
        
             </font>  
        </td>
    </tr>   
</table>
<br/><br/><br/><br/> 
<br/><br/><br/><br/>
<table border="0" cellpadding="0" cellspacing="0"  style="font-family:Arial; border-collapse:collapse;font-size:12px; " align="center">
    <tr>
        <td align="left" style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
        <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
        <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
        <td align="left" style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
        <td align="center" style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
        <td align="right" style="font-size:12px;"><b>List Price</b><br/> <br/><br/></td>
        <td   align="right" style="font-size:12px; "> <b>Total</b><br/> <br/><br/></td>
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
            
            $img = $this->thumbnail($prod['ProductCombo']['Product']['image'], 400, 519);
			// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
		
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
			// Echo out a sample image
			//$data[$count][$key] =  '<img src="' . $src . '">';
			//<td width="120" align="center"><img class="img-responsive" src="/img/product-uploads/' . $prod['ProductCombo']['Product']['image'] . '" width="70" height="70"></td>
			//<td width="120" align="center"><img class="img-responsive" src="'.$src.'"></td>
            
            // thumbnail end
            
                // <td width="140" align="center"> ' . $prod['ProductCombo']['Product']['name'] . '/' . $prod['SupplierProduct']['supplier_code']. ' </td>

            $html .= '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"> ' . $prod['SupplierProduct']['supplier_code']. ' </td>
                <td width="200" align="center"><img width="80px;" class="img-responsive" src="'.$src.'"></td>
                <td width="200" > 
                      <div>' ;
                    foreach ($prod['ProductCombo']['ProductComboProperty'] as $desc) {
                        // pr($desc);
//                if (is_null($desc['property'])) {
//                    $prod_prop[] = '<li class="list-group-item"> ' . $desc['ProductProperty']['name'] . ' : ' . $desc['ProductValue']['value'] . '</li>';
//                } else {
                $html .= '<p> ' . ucwords($desc['property']) . ' : ' . $desc['value'] . '</p>';
//                }
            }
                    $html .= ' 
                        </div>
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
        <td colspan="4" >  </td> 
        <td colspan="4" align="right">
            <table style="font-family:Arial; font-size:12px;width:250" align="right">
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
<p>&nbsp;</p> 
 
            
          <hr style="border-top:1px dashed #f2f2f2"/>
              <p class="text-muted" style="margin-top: 10px;font-family:Arial;font-size:10px" >
               <strong>
               Terms and conditions</strong><br/>
                
                <p style="font-size:9px;font-family:Arial;margin-bottom:1px;">1.This order is made in accordance with your quotation and/ or pricing. The full quantity mentioned must be filled at the price and within the delivery stipulated;</p>
                <p style="font-size:9px;font-family:Arial;margin-bottom:1px;">2.This order must accompany the delivery and the corresponding original invoice will be paid only if supported by this order bearing authorised signatures;</p>
                <p style="font-size:9px;font-family:Arial;margin-bottom:1px;">3.Goods supplied hereon are subject to inspection and acceptance by authorised officer of Jecams Inc.;</p>
                 <p style="font-size:9px;font-family:Arial;margin-bottom:1px;">4.It is understood that Jecams Inc., reserves the right to reject the item ordered and delivered if some have hidden defects or would turn out to be poor quality;</p>
    <p style="font-size:9px;margin-bottom:font-family:Arial;1px;">5.Delivered goods which are rejected due to poor quality and/ or other justifiable reasons shall be withdrawn by the supplier from our warehouse and/or premises within
(7)days from date of notice of such rejection, otherwise, storage fee equivalent to 5% of the rejected goods per month or a fraction thereof,shall be charged to the
supplier. Rejected goods not claimed after the period of (3) months fron date of rejection shall be disposed of to defray cost of storage;</p> 

 
       <p style="font-size:9px;margin-bottom:1px;font-family:Arial;">
6.Supplier\'s failure to deliver when due will authorise representative in his discretion,to impose a penalty of a deduction from invoice value, as liquidated damages 1/10 of 1% of the total value of order for each day of delay in delivery, or the total undelivered portion thereof ,or make an open market purchased of the items undelivered and charged the defaulting supplier excess in price, if any. In either case Jecams Inc. reserved the right to rescind and cancel this order.</p>

         </p>

             

              <div class="row" style="margin-top:20px;font-family:Arial;">
                  <div class="col-xs-5">
                    <p style="font-size:10px">Approved By,</p>
                    <img src="img/jecams/Z_Salmorin.png"  class="signature" style="width:150px;margin-top:-10px; margin-left:40px;"/>
                    <p style="margin-top:-65px">________________________________</p>
                    <p style="text-transform:Capitalize;font-weight:bold;font-size:10px;margin-top:-5px; margin-left:65px;" >Zahra Salmorin</p> 
                  </div>
                
              </div>

               <br/>

  ';

//  $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
//    pr($html); exit;
    $this->Mpdf->WriteHTML($html);


//        $this->set(compact('purchase_order', 'product_details', 'discount', 'vat', 'ewt'));


//           $ctrProd = count($quote_productsc);
//           $ctrPrd = $ctrProd/6;
//           for($i=1; $i<=$ctrPrd; $i++){
               
////        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
////                '', '', '', '', 5, // margin_left
////                5, // margin right
////                15, // margin top
////                30, // margin bottom
////                10, // margin header
////                10);
//////           }

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
        $this->Mpdf->SetHTMLHeader('<div style="font-family:Arial; padding-top:-15px;
                                    right:500px; font-size:10px;"
                                    align="right">' . date("F d, Y h:i A") . '</div>');

       $approved_by = $delivery['DeliverySchedule']['approved_by'];
       
       if($approved_by == 0){
           $approved_by = '<font style="font-family:Arial; font-size:10px;color:red">Unapproved</font>';
       } else{
           $user = $this->User->findById($approved_by);
           $approved_by = '<font style="font-family:Arial; font-size:10px;">Approved By : '.$user['User']['first_name'].' '.$user['User']['last_name'].'</font>';
       }
       
       $dr_qid = $delivery['DeliverySchedule']['reference_number'];
       $this->loadModel('Quotation');
       $this->Quotation->recursive = 2;
       $dr_getq = $this->Quotation->findById($dr_qid);
       $dr_qobj = $dr_getq['Quotation'];
       $dr_cobj = $dr_getq['Client'];
       $dr_qpp_obj = $dr_getq['QuotationProduct'];

        $qpp_arr = [];
        foreach($dr_qpp_obj as $dr_qpp) {
            $qpp_arr = $dr_qpp['QuotationProductProperty'];
        }

        $cnt = 1;
        $sub_total = 0;
        $product_details = $delivery['DeliverySchedProduct'];
        
        $this->Mpdf->autoPageBreak = true; 
        $mpdf->shrink_tables_to_fit = 1;
        $this->Mpdf->AddPage();
        $html = ' <div style="font-family:Arial;  top: 35px; left:18px;  font-size:10px; ">
            <table style="font-family:Arial; width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
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
            <table border="0" style="font-family:Arial; ">
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
                    <p class="marginedQuoteHeaderFirst"><b>' . strtoupper($dr_cobj['name']) . '</b></p>
                    <p style="margin-top: -5px;">Contact Person: ' . strtoupper($dr_cobj['contact_person']) . ' </p>
                    <p style="margin-top: -5px;">Phone: ' . strtoupper($dr_cobj['contact_number']) . ' </p>  
                    <p style="margin-top: -5px;">Address: ' . strtoupper($dr_qobj['ship_geolocation']) . '</p>
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
        <table border="0" cellpadding="0" cellspacing="0"  style="font-family:Arial; border-collapse:collapse;font-size:12px; " align="center">
            <tr>
                <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
                <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
                <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
                <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
                <td align="right"  style="font-size:12px; "> <b>Status</b><br/> <br/><br/></td>
            </tr>
            ' ;
        $myCtr = 0;
        $existing_ids = [];
        foreach ($product_details as $prod) {
            $quotation_product_id = $prod['reference_num'];
            if(!in_array($quotation_product_id, $existing_ids)) {
                $existing_ids[] = $quotation_product_id;
            
                $this->loadModel('QuotationProduct');
                $quotation_product = $this->QuotationProduct->find('first', array('conditions' => array('QuotationProduct.id' => $quotation_product_id)));
                $prod_prop = [];
                    
                $img = $this->thumbnail($quotation_product['QuotationProduct']['image'], 400, 519);
        		$imageData = base64_encode($img);
        		$src = 'data: image/jpg;base64,'.$imageData;
                $qother_info = $quotation_product['QuotationProduct']['other_info'];
                $deleted = $prod['date_deleted'];
                if($deleted==null) {
                    $html .= '<tr>
                        <td width="120" align="left"><b>' . $quotation_product['Product']['name'] . '</b></td>
                        <td width="70%" align="center"><img width="80px;" class="img-responsive" src="'.$src.'"></td>
                        <td width="260">
                            <ul>';
                                foreach($qpp_arr as $qp_prop_val) {
                                    $prop_tmp = ucwords(strtolower($qp_prop_val['property']));
                                    $val = ucwords(strtolower($qp_prop_val['value']));
                                    
                                    if($prop!="") {
                                        $html .= '<li id="notbold">'.$prop.': '.$val.'</li>';
                                    }
                                }
                    $html .= '</ul><br/>
                            <p>Other Info:<br/>'.$qother_info.'</p>
                        </td>
                        <td width="40">' . abs($prod['actual_qty']) . '</td>
                        <td width="100" align="right"> ' . $prod['status'] . '</td></tr>';
                }
            }
        }

        $html .= '
            </table>
            <table style="font-family:Arial; font-size:14px;"> 
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
            </div>';
        
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->Mpdf->WriteHTML($html);
    
        $this->layout = 'pdf';
        $this->render('print_dr');
        $this->Mpdf->setFilename('PrintDr.pdf');
    }
    
    
    public function print_soa() {
        $this->Mpdf->init();

        $soa_id = $this->params['url']['id'];

        $this->loadModel('StatementOfAccount');
        $this->loadModel('CollectionPaper');
        $this->loadModel('Collection');
        $this->StatementOfAccount->recursive = 2;
        
        $soa = $this->StatementOfAccount->findById($soa_id);
        // pr($soa);
        if($soa['Quotation']['quotation_term_id']!=0){
            $quote_terms = '<p><b>Terms:</b> '.$soa['Quotation']['QuotationTerm']['name'].'</p>';
        }else{
            $quote_terms = '';
        }
        $collections = $this->Collection->find('all',
                      ['conditions'=>
                        ['quotation_id'=>$soa['StatementOfAccount']['quotation_id'],
                         'Collection.status'=>'verified',
                         'Collection.status !='=>'none'],
                        'fields'=>['Collection.id']]);  
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
          
            $cntercp =  count($collections);
            if($cntercp!=0){
                foreach($collections as $collection) {
                    $collection_id = $collection['Collection']['id'];
                
                    $this->CollectionPaper->recursive = -1;
                    $collection_papers = $this->CollectionPaper->find('all', ['conditions'=>['collection_id'=>$collection_id]]);
                    if(!empty($collection_papers)) {
                        $tbody .= '<tr><td style="border: 1px solid black;padding: 3px;">'.date("F d, Y", strtotime($collection['Collection']['created'])).'</td><td style="border: 1px solid black;padding: 3px;">';
                        $cntercp = count($collection_papers);
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
                }
            }else{
                    $tbody .= '
                    
                            <tr>
                                <td style="border: 1px solid black;padding: 3px;" align="center">'.date("F d, Y", strtotime($soa['StatementOfAccount']['collection_due'])).' </td>
                                <td style="border: 1px solid black;padding: 3px;" align="center"> - </td>
                                <td style="border: 1px solid black;padding: 3px;" align="center"> - </td>
                                <td style="border: 1px solid black;padding: 3px;" align="right">₱ '.number_format($soa['Quotation']['grand_total'],2).'</td>
                            </tr>';
                
            }
        $this->Mpdf->SetHTMLHeader('<div style="font-family:Arial; padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->SetHTMLFooter(' 
                                    <table style="font-family:Arial; width: 100%;padding-bottom:-15px;  ">
                                        <tr>
                                            <td style="text-align: left;width:70%;font-size:10px;">
                                            SOA # ' . $soa['StatementOfAccount']['soa_number'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
                                        </tr>
                                    </table> ');
        $this->Mpdf->autoPageBreak = true; 
        $mpdf->shrink_tables_to_fit = 1;

        $html = '<div style="font-family:Arial;  top: 35px; left:18px;  font-size:16px; ">
                    <table style="font-family:Arial; width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
                        <tr>
                            <td style="text-align: left;width:25%; font-size:10px;">
                                <img src="../img/jecams/logo_full.png" width="170" height="35">  
                            </td>
                            <td style="text-align: right;width:35%; font-size:13px;padding-right:20px;">
                                <p style="margin-top: -5px;">www.jecams.com.ph</p>
                            </td> 
                        </tr>
                    </table>
                    <table style="font-family:Arial; width: 100%" border="0">
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
                                    <p>Contact No.: '.$soa['Client']['contact_number'].'</p>
                                    <p>Email: '.$soa['Client']['email'].'</p>
                                    <p>TIN No.: '.$soa['Client']['tin_number'].'</p>
                                </font> 
                            </td> 
                            <td width="240" align="left" style="padding-left:5px;padding-right:5px;padding-bottom:-20px;"> 
                                <font style="font-size:11px;"> 
                                    '.$quote_terms.'
                                    <p><b>Quotation #:</b> '.$soa['Quotation']['quote_number'].'</p>
                                    <p><b>Sales Executive:</b> '.$soa['Quotation']['User']['first_name'].'  '.$soa['Quotation']['User']['last_name'].'</p>
                                </font>
                            </td>
                        </tr>   
                    </table>
                    
                    <br/><br/><br/>
                    
                    <div>
                        <p align="center"><font style="font-size:16px;">STATEMENT OF ACCOUNT</font></center></p>
                       
                        <table style="font-family:Arial; " border="0" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td width="500" align="left">Contract Amount: ₱  '.number_format($soa['Quotation']['grand_total'],2).'</td>
                                    <td width="500" align="right">Payment Due Date: '.date("F d, Y",strtotime($soa['StatementOfAccount']['collection_due'])).'</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <table style="font-family:Arial; font-size:10px;width: 100%;border-collapse: collapse;">
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
                
                <div  style="font-family:Arial; font-size:10px;" >
                            <h3>I. Notes</h3>
                             <ol> <li><p>A Penalty of <strong>One Percent (1%) monthly</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> 
                                <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> 
                                <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> 
                                <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> 
                                <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> 
                            </ol>
                            <p></p>
                            <h3>II. PAYMENT METHODS</h3>
                             <ol> 
                                <li><b>Cash</b></li>
                                <li><b>Cheque: </b> Make all Cheques payable to JECAMS INC. </li>
                                <li><b>Online: </b>
                                    <ul>BDO: 000528032598</ul>
                                    <ul>BPI: 9773-0634-91</ul>
                                    <ul>MBTC: 007-043-00190-2</ul>
                                    <ul>UNION BANK: 002540006572</ul>
                                    <ul>CHINABANK: 1027-00-00043-2</ul>
                                </li>
                             </ol>
                             <p align="center">Should you have inquiries concerning this statement, please contact  '.$soa['User']['first_name'].'  '.$soa['User']['last_name'].'.</p>
                </div>
                ';
                
                // <div style="font-family:Arial; font-size:9px">
                //     <font style="font-size:15px;font-weight:bold;">Remittance</font><br/>
                //     Customer Name: '.$soa['Client']['name'].'<br/>
                //     Statement #: '.$soa['StatementOfAccount']['soa_number'].'<br/>
                //     Date: '.date("F d, Y").'<br/>
                //     Amount due: ₱ '.number_format($bal, 2).'
                // </div>
                                        
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
        
        $this->Quotation->recursive = 0;
        $title = "";
        $user_id = $this->Auth->user('id');
        $range = $this->params['url']['range'];
        $current_year = date("Y");
        $table_body = '';
        
        $grand_total = 0.000000;
        $col_total = 0.000000;
        $year_contract_total = 0.000000;
        $year_contract_total_c = 0.000000;
        $year_paid_total = 0.000000;
        
        $team_salesagent = [];
        if(array_key_exists("team_id", $this->params['url'])==true) {
            $team_id = $this->params['url']['team_id'];
            $this->loadModel('AgentStatus');
            $get_agent_statuses = $this->AgentStatus->find('all',
                ['conditions'=>
                    ['Team.id'=>$team_id,
                     'AgentStatus.date_to'=>null],
                 'fields'=>['DISTINCT (AgentStatus.user_id)']]);
            
            foreach($get_agent_statuses as $ret_agent_statuses) {
                $team_salesagent[] = $ret_agent_statuses['AgentStatus']['user_id'];
            }
        }
        // echo pr($get_agent_statuses);
        // exit;
        
        if($range == "y") {
            $title = '<div align="center" style="font-family:Arial; ">
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
                                 ['Quotation.status'=>'processed'],
                                 ['Quotation.status'=>'approved_by_proprietor']
                                ]
                            ],
                         'order'=>'Quotation.date_moved DESC'
                        ]);
                    
                    $quotations_c[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.user_id'=>$salesagent,
                             'Quotation.status'=>'cancelled',
                             'AND'=>
                                [['YEAR(Quotation.created)' => date('Y')],
                                 ['MONTH(Quotation.created)' => $m]]]]);
                                 
                    $getusersname = $this->User->findById($salesagent);
                    $objuser = $getusersname['User'];
                    $namef = $objuser['first_name'];
                    $namel = $objuser['last_name'];
                    $namefull = $namef." ".$namel;
                    $title = '<div align="center" style="font-family:aktiv+-grotesk-std,Helvetica Neue,Arial; ">
                        <font style="font-size:15px;">'.$namefull.'</font><br/>
                        <font style="font-size:16px;font-weight:bold;color:#1a1a1a">'.$current_year.' Sales Report<font><br/>
                        <font style="font-size:11px;">Monthly Summary</p>
                    </div>';
                }
                elseif(array_key_exists("team_id", $this->params['url'])==true) {
                    $title = '<div align="center" style="font-family:Arial; ">
                                <font style="font-size:15px;">'.$teamname.'</font><br/>
                                <font style="font-size:16px;font-weight:bold;color:#1a1a1a">'.$current_year.' Sales Report<font><br/>
                                <font style="font-size:11px;">Monthly Summary</font>
                            </div>';
                    $quotations[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.team_id'=>$team_id,
                             'AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                 ['MONTH(date_moved)' => $m]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed'],
                                 ['Quotation.status'=>'approved_by_proprietor']
                                ]
                            ],
                         'order'=>'Quotation.date_moved DESC'
                        ]);
                                 
                    $quotations_c[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.team_id'=>$team_id,
                             'Quotation.status'=>'cancelled',
                             'AND'=>
                                [['YEAR(Quotation.created)' => date('Y')],
                                 ['MONTH(Quotation.created)' => $m]]]]);
                }
                else {
                    $quotations[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                 ['MONTH(date_moved)' => $m]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed'],
                                 ['Quotation.status'=>'approved_by_proprietor']
                                ]
                            ],
                         'order'=>'Quotation.date_moved DESC'
                        ]);

                    $quotations_c[$m] = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.status'=>'cancelled',
                             'AND'=>
                                [['YEAR(Quotation.created)' => date('Y')],
                                 ['MONTH(Quotation.created)' => $m]]]]);                             
                }
                
                $collections = [];
                $tot_grand_total = [];
                $tot_grand_total_c = [];
                $grand_total = 0.000000;
                $grand_total_c = 0.000000;
                $total_paid_amount = 0.000000;

                $tot_grand_total[$m] = 0;
                $tot_grand_total_c[$m] = 0;
                
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
                
                foreach($quotations_c[$m] as $quotation_obj_c) {
                    $quotation_c = $quotation_obj_c['Quotation'];
                    $quotation_id_c = $quotation_c['id'];
                    $grand_total_c += $quotation_c['grand_total'];
    
                    $tot_grand_total_c[$m] = $grand_total_c;
                }
                
                $year_contract_total += $tot_grand_total[$m];
                $year_contract_total_c += $tot_grand_total_c[$m];
                $year_paid_total += $total_paid_amount;
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$month.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$tot_grand_total[$m],2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$total_paid_amount,2,'.',',').'</td>';
                        
                        if($tot_grand_total_c[$m]!=0) {
                            $table_body .= '<td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$tot_grand_total_c[$m],2,'.',',').'</td>';
                        }
                        else {
                            $table_body .= '<td width="25%" style="padding-right:100px;" align="right">&#8369; 0.00</td>';
                        }
                $table_body .= '</tr>';
            }
            // echo pr($quotations_c);
            // exit;
            
            $table = '
                <table width="100%"  style="font-family:Arial; border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Contract Amount</th>
                            <th>Collected Amount</th>
                            <th>Cancelled Quotations</th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$table_body.'
                    
                        <tr>
                            <td width="25%" style="padding-left:105px;font-weight:bold;">Grand Total</td>
                            <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$year_contract_total,2,'.',',').'</td>
                            <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_paid_total,2,'.',',').'</td>
                            <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_contract_total_c,2,'.',',').'</td>
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
                    <div align="center" style="font-family:Arial; ">
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
                                    [['Quotation.team_id'=>$team_id],
                                      'OR'=>
                                        [['Quotation.status'=>'approved'],
                                         ['Quotation.status'=>'processed'],
                                         ['Quotation.status'=>'approved_by_proprietor']
                                        ]
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                    $title .= '
                        <div align="center" style="font-family:Arial; ">
                            <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                            <font style="font-size:11px;">('.date("F d, Y", strtotime($start_date))
                                                           .' - '.date("F d, Y", strtotime($end_date)).')</p>
                        </div>';
                }
                else {
                    $title .= '
                    <div align="center" style="font-family:Arial; ">
                        <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                        <font style="font-size:11px;">('.$full_mo.' '.$current_year.')</font>
                    </div>';
                    $quotations = $this->Quotation->find('all',
                        ['conditions' =>
                            ['Quotation.team_id'=>$team_id,
                             'AND'=>
                                [['YEAR(date_moved)' => date('Y')],
                                ['MONTH(date_moved)' => $current_mo]],
                             'OR'=>
                                [['Quotation.status'=>'approved'],
                                 ['Quotation.status'=>'processed'],
                                 ['Quotation.status'=>'approved_by_proprietor']
                                ]
                            ],
                         'order'=>'Quotation.date_moved DESC'
                        ]);
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
                                         ['Quotation.status'=>'processed'],
                                         ['Quotation.status'=>'approved_by_proprietor']
                                        ]
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);

                        $title = '
                        <div align="center" style="font-family:Arial; ">
                            <font style="font-size:14px;">'.$sales_agent_name.'</p>
                            <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                            <font style="font-size:11px;">('.date("F d, Y", strtotime($start_date))
                                                               .' - '.date("F d, Y", strtotime($end_date)).')</font>
                        </div>';
                    }
                    else {
                        $title = '
                        <div align="center" style="font-family:Arial; ">
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
                                     ['Quotation.status'=>'processed'],
                                     ['Quotation.status'=>'approved_by_proprietor']
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                    }
                }
                else {
                    $title = '
                    <div align="center" style="font-family:Arial; ">
                        <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                        <font style="font-size:11px;">('.$full_mo.' '.$current_year.')</p>
                    </div>';
                    
                    if($this->Auth->user('role')=='sales_executive') {
                        $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['Quotation.user_id'=>$this->Auth->user('id'),
                                 'AND'=>
                                    [['YEAR(date_moved)' => date('Y')],
                                    ['MONTH(date_moved)' => $current_mo]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed'],
                                     ['Quotation.status'=>'approved_by_proprietor']
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                    }
                    else {
                        $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['AND'=>
                                    [['YEAR(date_moved)' => date('Y')],
                                    ['MONTH(date_moved)' => $current_mo]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed'],
                                     ['Quotation.status'=>'approved_by_proprietor']
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                    }
                }
            }
            
            // echo json_encode($quotations);
            // exit;
            $count_monthly_quotation = 0;
            foreach($quotations as $quotation_obj) {
                $count_monthly_quotation++;
                
                $quotation = $quotation_obj['Quotation'];
                $company = [];
                $agent = [];
                if(!empty($quotation_obj['Client'])) {
                    $company = $quotation_obj['Client'];
                }
                if(!empty($quotation_obj['User'])) {
                    $agent = $quotation_obj['User'];
                }
                
                $quotation_id = $quotation['id'];
                if($quotation['date_approved']!="") {
                    $date_moved = date("M. d, Y (h:i A)", strtotime($quotation['date_moved']));
                }
                else {
                    $date_moved = "<font style='color:red'>Not Specified</font>";
                }
                
                if($quotation['quote_number']!="") {
                    $quote_number = $quotation['quote_number'];
                }
                else {
                    $quote_number = "<font style='color:red'>Unknown</font>";
                }
                
                $company_name = "<font style='color:red'>Not Specified</font>";
                
                if(!empty($company)) {
                    if($company['name']!="") {
                        $company_name = $company['name'];
                    }
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
                    ['conditions'=>['Collection.quotation_id'=>$quotation_id,
                                    'Collection.status'=>'verified'],
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
                        <td>'.$date_moved.'</td>
                        <td>'.$quote_number.'</td>
                        <td>'.$company_name.'</td>
                        <td>'.$full_name.'</td>
                        <td align="right">&#8369;  '.$contract_amount.'</td>
                        <td>'.$date_created.'</td>
                        <td align="right">&#8369;  '.number_format((float)$collected_amount,2,'.',',').'</td>
                    </tr>
                ';
            }
            
            $table = '
                <table border="1" width="100%"  style="font-family:Arial; border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Moved</th>
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
                        <td align="right">&#8369;  '.number_format((float)$grand_total,2,'.',',').'</td>
                        <td colspan="2" align="right">&#8369;  '.number_format((float)$col_total,2,'.',',').'</td>
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
                                ['Quotation.user_id'=>$salesagent,
                                 'AND'=>
                                    [['DATE(date_moved)' => date('Y-m-d')]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed'],
                                     ['Quotation.status'=>'approved_by_proprietor']
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                                     
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
                $title = '<div align="center" style="font-family:Arial; ">
                    <font style="font-size:15px;">'.$salesagentname.'</p>
                    <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Sales Report<font><br/>
                    <font style="font-size:11px;">'.$t_date.'</p>
                </div>';
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$datecreated.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$tot_grand_total,2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            
                $table = '
                    <table width="100%" style="font-family:Arial; border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                        <thead>
                            <tr>
                                <th>Date Moved</th>
                                <th>Contract Amount</th>
                                <th>Collected Amount</th>
                                <th>Cancelled Quotations</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$table_body.'
                        
                            <tr>
                                <td width="25%" style="padding-left:105px;font-weight:bold;">Grand Total</td>
                                <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$year_contract_total,2,'.',',').'</td>
                                <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_paid_total,2,'.',',').'</td>
                                <td width="25%"></td>
                            </tr>
                        </tbody>
                    </table>
                    ';
            }
            elseif(array_key_exists("team_id", $this->params['url'])==true) {
                $quotations = $this->Quotation->find('all',
                            ['conditions' =>
                                ['Quotation.team_id'=>$team_id,
                                 'AND'=>
                                    [['DATE(date_moved)' => date('Y-m-d')]],
                                 'OR'=>
                                    [['Quotation.status'=>'approved'],
                                     ['Quotation.status'=>'processed'],
                                     ['Quotation.status'=>'approved_by_proprietor']
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                                     
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
                $title = '<div align="center" style="font-family:Arial; ">
                    <font style="font-size:15px;">'.$teamname.'</p>
                    <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Sales Report<font><br/>
                    <font style="font-size:11px;">'.$t_date.'</p>
                </div>';
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$datecreated.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$tot_grand_total,2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            
                $table = '
                    <table width="100%" style="font-family:Arial; border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                        <thead>
                            <tr>
                                <th>Date Moved</th>
                                <th>Contract Amount</th>
                                <th>Collected Amount</th>
                                <th>Cancelled Quotations</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$table_body.'
                        
                            <tr>
                                <td width="25%" style="padding-left:105px;font-weight:bold;">Grand Total</td>
                                <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$year_contract_total,2,'.',',').'</td>
                                <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_paid_total,2,'.',',').'</td>
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
                                     ['Quotation.status'=>'processed'],
                                     ['Quotation.status'=>'approved_by_proprietor']
                                    ]
                                ],
                             'order'=>'Quotation.date_moved DESC'
                            ]);
                                     
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
                $title = '<div align="center" style="font-family:Arial; ">
                    <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Sales Report<font><br/>
                    <font style="font-size:11px;">'.$t_date.'</p>
                </div>';
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:105px;font-weight:bold;">'.$datecreated.'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$tot_grand_total,2,'.',',').'</td>
                        <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$total_paid_amount,2,'.',',').'</td>
                        <td width="25%"></td>
                    </tr>';
            
                $table = '
                    <table width="100%" style="font-family:Arial; border-collapse:collapse;font-size:12px;border-color:#1a1a1a" align="center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Contract Amount</th>
                                <th>Collected Amount</th>
                                <th>Cancelled Quotations</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$table_body.'
                            <tr>
                                <td width="25%" style="padding-left:105px;font-weight:bold;">Grand Total</td>
                                <td width="25%" style="padding-right:100px;" align="right">&#8369;  '.number_format((float)$year_contract_total,2,'.',',').'</td>
                                <td width="25%" style="padding-right:100px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_paid_total,2,'.',',').'</td>
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
            <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
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
            <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px; " align="right">' . date("F d, Y") . '</div><hr/>');
        // $this->Mpdf->SetHTMLFooter('<hr/><p align="right" style="font-size:10px">w w w . j e c a m s . c o m . p h</p>');
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
        $this->render('print_sales');
        $this->Mpdf->setFilename('sales.pdf');
    }

    public function print_quote_discount() {        
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
        
        
        

        $cnt = 1;
        $sub_total = 0;
        $new_sub_total = 0;
        $product_details = [];
        
        
$percentage_per_item = 0;
$discount_per_item = 0;
$total_discounted_price_per_item = 0;
$discounted_unit_price = 0;
$overall_qty = 0;        
         
        $prod_overall_qty = $this->QuotationProduct->find('all', array(
            'conditions' => array('QuotationProduct.quotation_id' => $quotation_id, 'QuotationProduct.deleted' => NULL),
            'fields' => ['SUM(QuotationProduct.qty) as prod_overall_qty']
        )); 
         $overall_qty = $prod_overall_qty[0][0]['prod_overall_qty'];
      
        
        foreach ($quote_products as $quote_prod) {
            $prod_prop = [];
            foreach ($quote_prod['QuotationProductProperty'] as $i=>$desc) {
                $tmp = strtolower($desc['property']);
                if($tmp == "Material" || $tmp == "Materials" || $tmp == "material"
                   || $tmp == "materials") {
                    $ppn[$i] = '<font >Materials (General Info)</font>';
                }
                else if($tmp == "Dimension" || $tmp == "Dimensions" || $tmp == "dimension"
                   || $tmp == "dimensions") {
                    $ppn[$i] = '<font  >Dimension Info</font>';
                }
                else {
                    $ppn[$i] = ucwords($tmp);
                }
                
                if (is_null($desc['property'])) {
                    $tmp2 = strtolower($desc['ProductProperty']['name']);
                    if($tmp2 == "Material" || $tmp2 == "Materials" || $tmp2 == "material"
                       || $tmp == "materials") {
                        $ppn[$i] = '<font >Materials (General Info)</font>';
                    }
                    else if($tmp2 == "Dimension" || $tmp2 == "Dimensions" || $tmp2 == "dimension"
                       || $tm2p == "dimensions") {
                        $ppn[$i] = '<font  >Dimension Info</font>';
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
            $other_infoes = str_replace('</p>', ' ', $quote_prod['QuotationProduct']['other_info']);
            $other_infoes =  str_replace('<p>', '<br/>', $other_infoes);
            $other_infoes =  str_replace('<strong>', '&nbsp;', $other_infoes);
            $other_info2 =  str_replace('</strong>', '<br/>', $other_infoes); 
            natcasesort($prod_prop);
            
            //thumnail start
            
            $img = $this->thumbnail($quote_prod['Product']['image'], 400, 519); 
		
			$imageData = base64_encode($img);
 
			$src = 'data: image/jpg;base64,'.$imageData;
			
            // thumbnail end
            ///FORMULA FOR QUOTATION DISCOUNT
            // $percent_discount = ($quotation['Quotation']['discount']/$quotation['Quotation']['sub_total'])*100;
            // $dicounted_unit_price = $quote_prod['QuotationProduct']['edited_amount']*$percent_discount;
            // $final_unit_price = $dicounted_unit_price-$quote_prod['QuotationProduct']['edited_amount'];
            // $total_discounted_price = $final_unit_price*$quote_prod['QuotationProduct']['qty'];
            
            
                  ///1st step 
                //   $percentage = $quotation['Quotation']['total']/$quotation['Quotation']['sub_total'];
                //   $item_discount = $percentage*$quotation['Quotation']['discount'];
                //   $total_price = $quote_prod['QuotationProduct']['edited_amount']*$quote_prod['QuotationProduct']['qty'];
                //   $item_discounted_price = $total_price-$item_discount;
                //   $discounted_unit_price = $item_discounted_price/$quote_prod['QuotationProduct']['qty'];
                  
                  
// percentage per item = total price per item /grand total
// discount per item = percentage per item * total discount
// discounted price per item = List price per item - discount per item
// discounted unit price = Discounted price per item/
// $percentage_per_item = $quote_prod['QuotationProduct']['total']/$quotation['Quotation']['grand_total'];
// $discount_per_item = $percentage_per_item * $quotation['Quotation']['discount'];
// $total_discounted_price_per_item = $quote_prod['QuotationProduct']['edited_amount'] - $discount_per_item;
// $discounted_unit_price = $total_discounted_price_per_item*$quote_prod['QuotationProduct']['qty'];

// $total_list_price = $quote_prod['QuotationProduct']['edited_amount'] * $quote_prod['QuotationProduct']['qty'];
                  
// $discount_per_item = $quotation['Quotation']['discount'] / $overall_qty;
// $new_total_list_price = $discount_per_item - $total_list_price;
// $new_price_per_item = abs($new_total_list_price) / $quote_prod['QuotationProduct']['qty'];


// // sir jon formula
// PERCENTAGE_DISCOUNT = (TOTAL DISCOUNT / SUBTOTAL)*100
// DICOUNT PER LIST PRICE = PERCENTAGE DISCOUNT * LIST PRICE 
//NEW LIST PRICE = LIST PRICE - DICOUNT PER LIST PRICE 
 //  TOTAL PER ITEM  = NEW DISCOUNT PRICE * QTY PER ITEM
            
$percentage_discount = ($quotation['Quotation']['discount'] / $quotation['Quotation']['sub_total'] ) * 100;
$discount_per_list_price = $percentage_discount * $quote_prod['QuotationProduct']['edited_amount'];
$new_list_price_per_item = $quote_prod['QuotationProduct']['edited_amount'] - $discount_per_list_price;
$new_total_list_price = $new_list_price_per_item * $quote_prod['QuotationProduct']['qty'];
            
            $product_details[] = '<tr style=" font-family:Arial;  ">
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center">' . $quote_prod['Product']['name'] . '</td>
                
                <td width="" align="center"><img class="img-responsive" style="width:80px;" src="'.$src.'"></td>
                <td width="200">
                    ' . $other_info2 . '
                    <div>' . implode($prod_prop) . '</div>
                </td>
                <td width="20" align="center">' . abs($quote_prod['QuotationProduct']['qty']) . '</td>
                <td width="100" align="right">&#8369;  ' . number_format(abs($new_list_price_per_item) , 2) . ' </td> 
                <td width="120" align="right">&#8369;  ' . number_format(abs($new_total_list_price), 2) . '</td></tr>';

            $cnt++;
            $new_sub_total = $new_sub_total + abs($new_total_list_price);
        }
        $new_grand_total = $new_sub_total + $quotation['Quotation']['installation_charge'] + $quotation['Quotation']['delivery_charge'];

        ////// PRODUCT DETAILS END //////

        $this->Mpdf->WriteHTML('<body style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;
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
                        <p class="marginedQuoteHeaderFirst"><b>JECAMS INC.</b>  </p>
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
            <table border="0"  
                   style="font-family:Arial;width: 100%; border-collapse:collapse;font-size:12px; "
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
                <tr><td colspan="7">&nbsp;</td></tr>
                <tr><td colspan="7">&nbsp;</td></tr>
                <tr>
                    <td colspan="5">
                        <p class="lead" style="font-size:12px;">Payment Methods:</p><br/>
                        <img src="../img/jecams/metro.jpg" alt="metrobank" style="width:50px"/>
                        <img src="../img/jecams/china.jpg" alt="chinabank" style="width:45px"/>
                        <img src="../img/jecams/bdo.jpg" alt="BDO" style="width:45px"/>
                        <img src="../img/jecams/bpi.jpg" alt="BPI" style="width:45px"/>
                        <img src="../img/jecams/cash.jpg" alt="cash"  style="width:45px" />
                        <img src="../img/jecams/check.jpg" alt="check"  style="width:45px" /> 
                    </td> 
                    <td colspan="4" align="right">
                        <table style="font-family:Arial; font-size:12px;width:250" align="right">
                            ' . $new_sub_total. '
                            ' . $install . '
                            ' . $del . ' 
                              <tr>
                                <td style="width:50%" align="right"><b>Grand Total:</b><br/> <br/></td>
                                <td  style="text-align:right">&#8369;  ' . number_format( $new_grand_total, 2) . ' </td>
                              </tr>
                        </table>
                    </td> 
                </tr>
            </table> 
            </div>
            </body>
            ');

        // $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
        //         '', '', '', '', '', // margin_left
        //         '', // margin right
        //         -150, // margin top
        //         30, // margin bottom
        //         0, // margin header
        //         10);
        $this->Mpdf->AddPage('P');
        $this->layout = 'pdf';
        $this->render('print_quote_discount');
        $this->Mpdf->setFilename('quotationDiscount.pdf');
    }
    
    public function try_amount(){
        $amount_in_words = $this->convertNumber('300000.00');
        pr($amount_in_words);
        exit;
    }
    
    public function print_cheque() {
        $this->Mpdf->init();

        $cheque_id = $this->params['url']['id'];
 
        $this->loadModel('PaymentRequestCheque'); 
        $this->loadModel('PaymentRequest'); 
        $this->PaymentRequestCheque->recursive=2; 
        $cheque = $this->PaymentRequestCheque->findById($cheque_id); 
        $payment_req = $this->PaymentRequest->findById($cheque['PaymentRequestCheque']['payment_request_id']);
        // pr($cheque);
        
        $tbody = '';  
        $this->Mpdf->autoPageBreak = true; 
        $mpdf->shrink_tables_to_fit = 1;
        
        $req_amount = number_format((float)$payment_req['PaymentRequest']['requested_amount'], 2, '.', '');
        $amount_in_words = $this->convertNumber($req_amount);

    if($cheque['Bank']['name']=='bdo'){
        
        $html = '<div style="font-family:Arial;  padding-top:-10px; padding-right:25px;  font-size:13px; " align="right">
                 '.date('F d, Y',strtotime($cheque['PaymentRequestCheque']['cheque_date'])).'
                </div> 
                    <table style="font-family:Arial;  padding-top: 10px;padding-left:50px; " width="100%" autosize=�1� >border="1">
                         
                         <tr>
                            <td style="text-align: left;width:75%; font-size:13px;">
                                '.$cheque['Payee']['name'].' 
                            </td>
                            <td style="text-align: right;width:25%; font-size:13px;padding-right:20px;">
                              '.number_format($payment_req['PaymentRequest']['requested_amount'],2).'  
                            </td> 
                        </tr> 
                    </table>  
                    <table style="font-family:Arial;   padding-top: 10px;padding-left:50px; " autosize=�1� >
                         
                <tr>
                            <td style="text-align: left;width:25%; font-size:13px;" colspan="2">
                                '.$amount_in_words.' Pesos Only
                            </td>
                            
                        </tr>
                    </table>  
                <br/><br/><br/><br/> 
                ';
    }
    else
    if($cheque['Bank']['name']=='union'){
        
        $html = '<div style="font-family:Arial;  padding-top:-10px; padding-right:25px;  font-size:13px; " align="right">
                 '.date('F d, Y',strtotime($cheque['PaymentRequestCheque']['cheque_date'])).'
                </div> 
                    <table style="font-family:Arial;  padding-top: 10px;padding-left:50px; " width="100%" autosize=�1� >border="1">
                         
                         <tr>
                            <td style="text-align: left;width:75%; font-size:13px;">
                                '.$cheque['Payee']['name'].'  
                            </td>
                            <td style="text-align: right;width:25%; font-size:13px;padding-right:20px;">
                              '.number_format($payment_req['PaymentRequest']['requested_amount'],2).'  
                            </td> 
                        </tr> 
                    </table>  
                    <table style="font-family:Arial;   padding-top: 10px;padding-left:50px; " autosize=�1� >
                         
                <tr>
                            <td style="text-align: left;width:25%; font-size:13px;" colspan="2">
                                '.$amount_in_words.' Pesos Only
                            </td>
                            
                        </tr>
                    </table>  
                <br/><br/><br/><br/> 
                ';
    }
    else
    if($cheque['Bank']['name']=='china'){
        
        $html = '<div style="font-family:Arial;  padding-top:-15px; padding-right:25px;  font-size:13px; " align="right">
                 '.date('F d, Y',strtotime($cheque['PaymentRequestCheque']['cheque_date'])).'
                </div> 
                    <table style="font-family:Arial;  padding-top: 10px;padding-left:50px; " width="100%" autosize=�1� >border="1">
                         
                         <tr>
                            <td style="text-align: left;width:75%; font-size:13px;">
                                '.$cheque['Payee']['name'].' 
                            </td>
                            <td style="text-align: right;width:25%; font-size:13px;padding-right:20px;">
                              '.number_format($payment_req['PaymentRequest']['requested_amount'],2).'  
                            </td> 
                        </tr> 
                    </table>  
                    <table style="font-family:Arial;   padding-top: 10px;padding-left:50px; " autosize=�1� >
                         
                <tr>
                            <td style="text-align: left;width:25%; font-size:13px;" colspan="2">
                                '.$amount_in_words.' Pesos Only
                            </td>
                            
                        </tr>
                    </table>  
                <br/><br/><br/><br/> 
                ';
    }

    else
    if($cheque['Bank']['name']=='bpi'){
        
        $html = '<div style="font-family:Arial;  padding-top:-15px; padding-right:25px;  font-size:13px; " align="right">
                 '.date('F d, Y',strtotime($cheque['PaymentRequestCheque']['cheque_date'])).'
                </div> 
                    <table style="font-family:Arial;  padding-top: 10px;padding-left:50px; " width="100%" autosize=�1� >border="1">
                         
                         <tr>
                            <td style="text-align: left;width:75%; font-size:13px;">
                                '.$cheque['Payee']['name'].'  
                            </td>
                            <td style="text-align: right;width:25%; font-size:13px;padding-right:20px;">
                               '.number_format($payment_req['PaymentRequest']['requested_amount'],2).'  
                            </td> 
                        </tr> 
                    </table>  
                    <table style="font-family:Arial;   padding-top: 10px;padding-left:50px; " autosize=�1� >
                         
                <tr>
                            <td style="text-align: left;width:25%; font-size:13px;" colspan="2">
                                '.$amount_in_words.' Pesos Only
                            </td>
                            
                        </tr>
                    </table>  
                <br/><br/><br/><br/> 
                ';
    }
    
    
    // comment this out later...
    else {
        $html = '<div style="font-family:Arial;  padding-top:-15px; padding-right:25px;  font-size:13px; " align="right">
                 '.date('F d, Y',strtotime($cheque['PaymentRequestCheque']['cheque_date'])).'
                </div> 
                    <table style="font-family:Arial;  padding-top: 10px;padding-left:50px; " width="100%" autosize=�1� >border="1">
                         
                         <tr>
                            <td style="text-align: left;width:75%; font-size:13px;">
                                '.$cheque['Payee']['name'].' 
                            </td>
                            <td style="text-align: right;width:25%; font-size:13px;padding-right:20px;">
                              '.number_format($payment_req['PaymentRequest']['requested_amount'],2).'  
                            </td> 
                        </tr> 
                    </table>  
                    <table style="font-family:Arial;   padding-top: 10px;padding-left:50px; " autosize=�1� >
                         
                <tr>
                            <td style="text-align: left;width:25%; font-size:13px;" colspan="2">
                                '.$amount_in_words.' Pesos Only
                            </td>
                            
                        </tr>
                    </table>  
                <br/><br/><br/><br/> 
                ';
    }
                                        
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->Mpdf->WriteHTML($html);
        
        $this->layout = 'pdf';
        $this->render('print_cheque');
        $this->Mpdf->setFilename('cheque.pdf');
    }   
    
    public function print_agent_notes() {
        $this->autoRender = false;
        $this->Mpdf->init();
        $stylesheet = file_get_contents('/css/style.css');
        $this->Mpdf->WriteHTML($stylesheet,1);

        $this->loadModel('DeliverySchedule');
        $ds_id = $this->params['url']['id'];
        $delivery = $this->DeliverySchedule->findById($ds_id);
        
        $this->Mpdf->SetHTMLHeader('<div style="font-family:Arial; padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->autoPageBreak = true; 
        $mpdf->shrink_tables_to_fit = 1;
        $this->Mpdf->AddPage();
        $html = ' <div style="font-family:Arial;  top: 35px; left:18px;  font-size:10px; ">
            <table style="font-family:Arial; width: 100%; border:1px; page-break-inside: avoid " autosize=�1� >
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
            <table border="0" style="font-family:Arial; ">
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
                    <p class="marginedQuoteHeaderFirst"><b>' . strtoupper($dr_cobj['name']) . '</b></p>
                    <p style="margin-top: -5px;">Contact Person: ' . strtoupper($dr_cobj['contact_person']) . ' </p>
                    <p style="margin-top: -5px;">Phone: ' . strtoupper($dr_cobj['contact_number']) . ' </p>  
                    <p style="margin-top: -5px;">Address: ' . strtoupper($dr_qobj['ship_geolocation']) . '</p>
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
        <div style="font-size:25px;">';
        $agent_note = '<font style="color:red;">No Notes</font>';
        if($delivery['DeliverySchedule']['agent_note']!='') {
            $agent_note = $delivery['DeliverySchedule']['agent_note'];
        }
        $html .= $agent_note;
        $html .= '</div>';
        
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $this->Mpdf->WriteHTML($html);

        $this->layout = 'pdf';
        $this->render('print_po');
        $this->Mpdf->setFilename('PurchaseOrder.pdf');
    }
    
    public function accounting_print_quote() {
        $department_id = $this->Auth->user('department_id');
        $this->loadModel('Quotation');
        $this->loadModel('Department');
        $this->loadModel('AgentStatus');
        $this->Department->recursive = -2;
        $get_department = $this->Department->findById($department_id, 'name');
        $department_name = strtolower($get_department['Department']['name']);
        $role = $this->Auth->user('role');
        $myuserID = $this->Auth->user('id');
        
        
        $get_team = $this->AgentStatus->find('first', ['conditions'=>
                        [
                            'AgentStatus.user_id'=>$myuserID,
                            'AgentStatus.date_to'=>NULL,
                        ], 
                             'fields'=>'Team.id, Team.name']);
                            //  echo($get_team);
        $team_obj = $get_team['Team'];
        $my_team_id = $team_obj['id'];
        
        $isAuthorized = false;
        $authorizedPersonnel = ['proprietor', 'sales_manager', 'sales_executive', 'sales_coordinator'];
        $authorizedDepartment = "accounting department";
        foreach($authorizedPersonnel as $ret_auth_per) {
            if($role==$ret_auth_per || $department_name==$authorizedDepartment) {
                $isAuthorized = true;
            }
        }
        
        if($isAuthorized) {
            $for_collection = [];
            $with_terms = [];
            $incomplete = [];
            $backjob = [];
            $undelivered = [];
            $pending = [];
            $with_pdc = [];
            $bir2307 = [];
            $paid = [];
            $collection_type = $this->params['url']['type'];
            $this->Quotation->recursive = -1;
            if($role == "proprietor" || $department_name==$authorizedDepartment) {
                if($collection_type=="collection_status") {
                    $collection_name = "Collection Status";
                    // for_collection
                    // with_terms
                    // incomplete
                    // backjob
                    // undelivered
                    // pending
                    $fields = array_keys($this->Quotation->getColumnTypes());
                    $key = array_search('terms_info', $fields);
                    unset($fields[$key]);
                    $fields[] = 'User.*';
                    // $fields[] = 'Collection.*';
                    $fields[] = 'Client.*';
                    $for_collection = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'for_collection',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled'],
                            
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields
                        ]);
                    $with_terms = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'with_terms',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $incomplete = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'incomplete',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $backjob = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'backjob',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $undelivered = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'undelivered',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $pending = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'pending',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                }
                elseif($collection_type=="clearing") {
                    $collection_name = "Clearing";
                    // with_pdc
                    // bir2307
                    
                    $with_pdc = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'with_pdc',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ]]);
                    $bir2307 = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'bir2307',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ]]);
                }
                elseif($collection_type=="collected") {
                    $collection_name = "Collected";
                    // paid
                    
                    $paid = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'paid',
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ]]);
                }
                else {
                    $collection_name = "";
                }
            }
            else if($role=="sales_manager" || $role=="sales_coordinator" ) {
                if($collection_type=="collection_status") {
                    $collection_name = "Collection Status";
                    // for_collection
                    // with_terms
                    // incomplete
                    // backjob
                    // undelivered
                    // pending
                    $fields = array_keys($this->Quotation->getColumnTypes());
                    $key = array_search('terms_info', $fields);
                    unset($fields[$key]);
                    $fields[] = 'User.*';
                    // $fields[] = 'Collection.*';
                    $fields[] = 'Client.*';
                    $for_collection = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'for_collection',
                            'Quotation.team_id'=>$my_team_id,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields
                        ]);
                    $with_terms = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'with_terms',
                            'Quotation.team_id'=>$my_team_id,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $incomplete = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'incomplete',
                            'Quotation.team_id'=>$my_team_id,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $backjob = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'backjob',
                            'Quotation.team_id'=>$my_team_id,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $undelivered = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'undelivered',
                            'Quotation.team_id'=>$my_team_id,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $pending = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'pending',
                            'Quotation.team_id'=>$my_team_id,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    
                }
                else if($collection_type=="clearing") {
                    $collection_name = "Clearing";
                    // with_pdc
                    // bir2307
                    
                }
                elseif($collection_type=="collected") {
                    $collection_name = "Collected";
                    // paid
                    
                }
                else {
                    $collection_name = "";
                }
            }
            else if($role=="sales_executive") {
                if($collection_type=="collection_status") {
                    $collection_name = "Collection Status";
                    // for_collection
                    // with_terms
                    // incomplete
                    // backjob
                    // undelivered
                    // pending
                    $fields = array_keys($this->Quotation->getColumnTypes());
                    $key = array_search('terms_info', $fields);
                    unset($fields[$key]);
                    $fields[] = 'User.*';
                    // $fields[] = 'Collection.*';
                    $fields[] = 'Client.*';
                    $for_collection = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'for_collection',
                            'Quotation.user_id'=>$myuserID,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields
                        ]);
                    $with_terms = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'with_terms',
                            'Quotation.user_id'=>$myuserID,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $incomplete = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'incomplete',
                            'Quotation.user_id'=>$myuserID,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $backjob = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'backjob',
                            'Quotation.user_id'=>$myuserID,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $undelivered = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'undelivered',
                            'Quotation.user_id'=>$myuserID,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']
                            ],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    $pending = $this->Quotation->find('all',
                        ['conditions'=>[
                            'Quotation.collection_status'=>'pending',
                            'Quotation.user_id'=>$myuserID,
                            'Quotation.status !='=>['pending', 'ongoing', 'lost','deleted','void','cancelled']],
                        'contain' => ['User','Collection','Client'],
                        'fields' => $fields]);
                    
                }
                else if($collection_type=="clearing") {
                    $collection_name = "Clearing";
                    // with_pdc
                    // bir2307
                    
                }
                else if($collection_type=="collected") {
                    $collection_name = "Collected";
                    // paid
                    
                }
                else {
                    $collection_name = "";
                }
            }
            
            $not_specified = "<font class='text-danger'>Not Specified</font>";
            $unknown = "<font class='text-danger'>Unknown</font>";
                        
            // =============> FOR COLLECTION
            $date_moved_fc = $unknown;
            $quotation_number_fc = $unknown;
            $company_name_fc = $not_specified;
            $agent_name_fc = $unknown;
            $collected_amount_fc = "&#8369; 0.00";
            $grand_total_fc = "&#8369; 0.00";
            $grand_total_tmp_fc = 0;
            
            $tgrand_total_fc = 0;
            $tcollected_amount_fc = 0;
            $tbalance_fc = 0;
            if(!empty($for_collection)) {
                $tbody_for_collection = '<tbody>';
                $count_fc = 0;
                $collection_status_fc = $not_specified;
                foreach($for_collection as $ret_collection) {
                    $count_fc++;
                    $quotation_obj_fc = $ret_collection['Quotation'];
                    $company_obj_fc = $ret_collection['Client'];
                    $user_obj_fc = $ret_collection['User'];
                    $collection_obj_fc = $ret_collection['Collection'];

                    if($quotation_obj_fc['date_moved']!="") {
                        $date_moved_fc = date("M. d, Y", strtotime($quotation_obj_fc['date_moved']));
                    }
                    if($quotation_obj_fc['quote_number']!="") {
                        $quotation_number_fc =$quotation_obj_fc['quote_number'];
                    }
                    if($company_obj_fc['name']!="") {
                        $company_name_fc = ucwords($company_obj_fc['name']);
                    }
                    if($user_obj_fc['first_name']!="" || $user_obj_fc['last_name']!="") {
                        $agent_name_fc = ucwords(
                                            strtolower($user_obj_fc['first_name'] ));
                    }
                    $total_payment_fc = 0;
                    foreach($collection_obj_fc as $collected_fc){
                        if($collected_fc['status']=='verified'){
                            $payment_fc = $collected_fc['amount_paid'] + $collected_fc['with_held'] + $collected_fc['other_amount'];
                            $total_payment_fc = $total_payment_fc + $payment_fc;
                        }
                    }
                    $collected_amount_fc = "&#8369; ".number_format((float)$total_payment_fc, 2);
                    if($quotation_obj_fc['grand_total']!=null) {
                        $grand_total_tmp_fc = $quotation_obj_fc['grand_total'];
                        $grand_total_fc = "&#8369; ".number_format((float)$grand_total_tmp_fc,2);
                    }
                    $balance_fc = "&#8369; ".number_format((float)$grand_total_tmp_fc-$total_payment_fc,2);
                    if($quotation_obj_fc['collection_remarks']!="") {
                        $collection_status_fc = $quotation_obj_fc['collection_remarks'];
                    }
                    
                    
                    
                    $tgrand_total_fc = $tgrand_total_fc + $grand_total_tmp_fc;
                    $tcollected_amount_fc = $tcollected_amount_fc + $collected_amount_fc;
                    $tbalance_fc = $tbalance_fc + ($grand_total_tmp_fc-$collected_amount_fc);
                    
                    
                    $tbody_for_collection .= '
                    <tr>
                        <td align="center">'.$count_fc.'</td>
                        <td align="center">'.$date_moved_fc.'</td>
                        <td align="center">'.$quotation_number_fc.'</td>
                        <td align="center">'.$company_name_fc.'</td>
                        <td align="center">'.$agent_name_fc.'</td>
                        <td align="right">'.$grand_total_fc.'</td>
                        <td align="right">'.$collected_amount_fc.'</td>
                        <td align="right">'.$balance_fc.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_fc.'</td>
                    </tr>
                    '; 
                }
                
                $tbody_for_collection .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_collection = '<tbody><tr><td>No data for collection.</td></tr></tbody>';
            }
            
            
            // =============> WITH TERMS
            $date_moved_wt = $unknown;
            $quotation_number_wt = $unknown;
            $company_name_wt = $not_specified;
            $agent_name_wt = $unknown;
            $collected_amount_wt = "&#8369; 0.00";
            $grand_total_wt = "&#8369; 0.00";
            $grand_total_tmp_wt = 0;
            
            $tgrand_total_tmp_wt = 0;
            $ttotal_payment_wt = 0;
            $tbalance_wt = 0;
            if(!empty($with_terms)) {
                $tbody_for_with_terms = '<tbody>';
                $count_wt = 0;
                $collection_status_wt = $not_specified;
                foreach($with_terms as $ret_with_terms) {
                    $count_wt++;
                    $quotation_obj_wt = $ret_with_terms['Quotation'];
                    $company_obj_wt = $ret_with_terms['Client'];
                    $user_obj_wt = $ret_with_terms['User'];
                    $collection_obj_wt = $ret_with_terms['Collection'];

                    if($quotation_obj_wt['date_moved']!="") {
                        $date_moved_wt = date("M. d, Y", strtotime($quotation_obj_wt['date_moved']));
                    }
                    if($quotation_obj_wt['quote_number']!="") {
                        $quotation_number_wt =$quotation_obj_wt['quote_number'];
                    }
                    if($company_obj_wt['name']!="") {
                        $company_name_wt = ucwords($company_obj_wt['name']);
                    }
                    if($user_obj_wt['first_name']!="" || $user_obj_wt['last_name']!="") {
                        $agent_name_wt = ucwords(
                                            strtolower($user_obj_wt['first_name'] ));
                    }
                    $total_payment_wt = 0;
                    foreach($collection_obj_wt as $collected_wt){
                        if($collected_wt['status']=='verified'){
                            $payment_wt = $collected_wt['amount_paid'] + $collected_wt['with_held'] + $collected_wt['other_amount'];
                            $total_payment_wt = $total_payment_wt + $payment_wt;
                        }
                    }
                    $collected_amount_wt = "&#8369; ".number_format((float)$total_payment_wt, 2);
                    if($quotation_obj_wt['grand_total']!=null) {
                        $grand_total_tmp_wt = $quotation_obj_wt['grand_total'];
                        $grand_total_wt = "&#8369; ".number_format((float)$grand_total_tmp_wt,2);
                    }
                    $balance_wt = "&#8369; ".number_format((float)$grand_total_tmp_wt-$total_payment_wt,2);
                    if($quotation_obj_wt['collection_remarks']!="") {
                        $collection_status_wt = $quotation_obj_wt['collection_remarks'];
                    }
                    
                        $tgrand_total_tmp_wt = $tgrand_total_tmp_wt + $grand_total_tmp_wt;
                        $ttotal_payment_wt = $ttotal_payment_wt + $total_payment_wt;
                        $tbalance_wt = $tbalance_wt + ($grand_total_tmp_wt-$total_payment_wt);
                        
                        
                    $tbody_for_with_terms .= '
                    <tr>
                        <td align="center">'.$count_wt.'</td>
                        <td align="center">'.$date_moved_wt.'</td>
                        <td align="center">'.$quotation_number_wt.'</td>
                        <td align="center">'.$company_name_wt.'</td>
                        <td align="center">'.$agent_name_wt.'</td>
                        <td align="right">'.$grand_total_wt.'</td>
                        <td align="right">'.$collected_amount_wt.'</td>
                        <td align="right">'.$balance_wt.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_wt.'</td>
                    </tr>
                    ';
                    
                }
                
                $tbody_for_with_terms .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_with_terms = '<tbody><tr><td>No data for quotation with terms.</td></tr></tbody>';
            }
            
            // =============> INCOMPLETE
            $date_moved_ic = $unknown;
            $quotation_number_ic = $unknown;
            $company_name_ic = $not_specified;
            $agent_name_ic = $unknown;
            $collected_amount_ic = "&#8369; 0.00";
            $grand_total_ic = "&#8369; 0.00";
            $grand_total_tmp_ic = 0;
            
            $ttotal_payment_ic = 0;
            $tgrand_total_tmp_ic = 0;
            $tbalance_ic =  0;
            
            if(!empty($incomplete)) {
                $tbody_for_incomplete = '<tbody>';
                $count_ic = 0;
                $collection_status_ic = $not_specified;
                foreach($incomplete as $ret_incomplete) {
                    $count_ic++;
                    $quotation_obj_ic = $ret_incomplete['Quotation'];
                    $company_obj_ic = $ret_incomplete['Client'];
                    $user_obj_ic = $ret_incomplete['User'];
                    $collection_obj_ic = $ret_incomplete['Collection'];

                    if($quotation_obj_ic['date_moved']!="") {
                        $date_moved_ic = date("M. d, Y", strtotime($quotation_obj_ic['date_moved']));
                    }
                    if($quotation_obj_ic['quote_number']!="") {
                        $quotation_number_ic =$quotation_obj_ic['quote_number'];
                    }
                    if($company_obj_ic['name']!="") {
                        $company_name_ic = ucwords($company_obj_ic['name']);
                    }
                    if($user_obj_ic['first_name']!="" || $user_obj_ic['last_name']!="") {
                        $agent_name_ic = ucwords(
                                            strtolower($user_obj_ic['first_name'] ));
                    }
                    $total_payment_ic = 0;
                    foreach($collection_obj_ic as $collected_ic){
                        if($collected_ic['status']=='verified'){
                            $payment_ic = $collected_ic['amount_paid'] + $collected_ic['with_held'] + $collected_ic['other_amount'];
                            $total_payment_ic = $total_payment_ic + $payment_ic;
                        }
                    }
                    $collected_amount_ic = "&#8369; ".number_format((float)$total_payment_ic, 2);
                    if($quotation_obj_ic['grand_total']!=null) {
                        $grand_total_tmp_ic = $quotation_obj_ic['grand_total'];
                        $grand_total_ic = "&#8369; ".number_format((float)$grand_total_tmp_ic,2);
                    }
                    $balance_ic = "&#8369; ".number_format((float)$grand_total_tmp_ic-$total_payment_ic,2);
                    if($quotation_obj_ic['collection_remarks']!="") {
                        $collection_status_ic = $quotation_obj_ic['collection_remarks'];
                    }
                    $ttotal_payment_ic = $ttotal_payment_ic + $total_payment_ic;
                    $tgrand_total_tmp_ic = $tgrand_total_tmp_ic + $grand_total_tmp_ic;
                    $tbalance_ic = $tbalance_ic + ($grand_total_tmp_ic-$total_payment_ic);
                    
                    $tbody_for_incomplete .= '
                    <tr>
                        <td align="center">'.$count_ic.'</td>
                        <td align="center">'.$date_moved_ic.'</td>
                        <td align="center">'.$quotation_number_ic.'</td>
                        <td align="center">'.$company_name_ic.'</td>
                        <td align="center">'.$agent_name_ic.'</td>
                        <td align="right">'.$grand_total_ic.'</td>
                        <td align="right">'.$collected_amount_ic.'</td>
                        <td align="right">'.$balance_ic.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_ic.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_incomplete .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_incomplete = '<tbody><tr><td>No data for incomplete.</td></tr></tbody>';
            }
            
            // =============> BACKJOB
            $date_moved_bkj = $unknown;
            $quotation_number_bkj = $unknown;
            $company_name_bkj = $not_specified;
            $agent_name_bkj = $unknown;
            $collected_amount_bkj = "&#8369; 0.00";
            $grand_total_bkj = "&#8369; 0.00";
            $grand_total_tmp_bkj = 0;
            
            $ttotal_payment_bkj = 0;
            $tgrand_total_tmp_bkj = 0;
            $tbalance_bkj = 0;  
                    
                    
            if(!empty($backjob)) {
                $tbody_for_backjob = '<tbody>';
                $count_bkj = 0;
                $collection_status_bkj = $not_specified;
                foreach($backjob as $ret_backjob) {
                    $count_bkj++;
                    $quotation_obj_bkj = $ret_backjob['Quotation'];
                    $company_obj_bkj = $ret_backjob['Client'];
                    $user_obj_bkj = $ret_backjob['User'];
                    $collection_obj_bkj = $ret_backjob['Collection'];

                    if($quotation_obj_bkj['date_moved']!="") {
                        $date_moved_bkj = date("M. d, Y", strtotime($quotation_obj_bkj['date_moved']));
                    }
                    if($quotation_obj_bkj['quote_number']!="") {
                        $quotation_number_bkj =$quotation_obj_bkj['quote_number'];
                    }
                    if($company_obj_bkj['name']!="") {
                        $company_name_bkj = ucwords($company_obj_bkj['name']);
                    }
                    if($user_obj_bkj['first_name']!="" || $user_obj_bkj['last_name']!="") {
                        $agent_name_bkj = ucwords(
                                            strtolower($user_obj_bkj['first_name'] ));
                    }
                    $total_payment_bkj = 0;
                    foreach($collection_obj_bkj as $collected_bkj){
                        if($collected_bkj['status']=='verified'){
                            $payment_bkj = $collected_bkj['amount_paid'] + $collected_bkj['with_held'] + $collected_bkj['other_amount'];
                            $total_payment_bkj = $total_payment_bkj + $payment_bkj;
                        }
                    }
                    $collected_amount_bkj = "&#8369; ".number_format((float)$total_payment_bkj, 2);
                    if($quotation_obj_bkj['grand_total']!=null) {
                        $grand_total_tmp_bkj = $quotation_obj_bkj['grand_total'];
                        $grand_total_bkj = "&#8369; ".number_format((float)$grand_total_tmp_bkj,2);
                    }
                    $balance_bkj = "&#8369; ".number_format((float)$grand_total_tmp_bkj-$total_payment_bkj,2);
                    if($quotation_obj_bkj['collection_remarks']!="") {
                        $collection_status_bkj = $quotation_obj_bkj['collection_remarks'];
                    }
                    
                    $ttotal_payment_bkj = $ttotal_payment_bkj + $total_payment_bkj;
                    $tgrand_total_tmp_bkj = $tgrand_total_tmp_bkj + $grand_total_tmp_bkj;
                    $tbalance_bkj = $tbalance_bkj + ($grand_total_tmp_bkj-$total_payment_bkj);
                    
                    $tbody_for_backjob .= '
                    <tr>
                        <td align="center">'.$count_bkj.'</td>
                        <td align="center">'.$date_moved_bkj.'</td>
                        <td align="center">'.$quotation_number_bkj.'</td>
                        <td align="center">'.$company_name_bkj.'</td>
                        <td align="center">'.$agent_name_bkj.'</td>
                        <td align="right">'.$grand_total_bkj.'</td>
                        <td align="right">'.$collected_amount_bkj.'</td>
                        <td align="right">'.$balance_bkj.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_bkj.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_backjob .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_backjob = '<tbody><tr><td>No data for backjob.</td></tr></tbody>';
            }

            // =============> UNDELIVERED
            $date_moved_ud = $unknown;
            $quotation_number_ud = $unknown;
            $company_name_ud = $not_specified;
            $agent_name_ud = $unknown;
            $collected_amount_ud = "&#8369;  0.00";
            $grand_total_ud = "&#8369;  0.00";
            $grand_total_tmp_ud = 0;
            
            $tgrand_total_ud = 0;
            $ttotal_payment_ud = 0;
            $tbalance_ud = 0;
            
            if(!empty($undelivered)) {
                $tbody_for_undelivered = '<tbody>';
                $count_ud = 0;
                $collection_status_ud = $not_specified;
                foreach($undelivered as $ret_undelivered) {
                    $count_ud++;
                    $quotation_obj_ud = $ret_undelivered['Quotation'];
                    $company_obj_ud = $ret_undelivered['Client'];
                    $user_obj_ud = $ret_undelivered['User'];
                    $collection_obj_ud = $ret_undelivered['Collection'];

                    if($quotation_obj_ud['date_moved']!="") {
                        $date_moved_ud = date("M. d, Y", strtotime($quotation_obj_ud['date_moved']));
                    }
                    if($quotation_obj_ud['quote_number']!="") {
                        $quotation_number_ud =$quotation_obj_ud['quote_number'];
                    }
                    if($company_obj_ud['name']!="") {
                        $company_name_ud = ucwords($company_obj_ud['name']);
                    }
                    if($user_obj_ud['first_name']!="" || $user_obj_ud['last_name']!="") {
                        $agent_name_ud = ucwords(
                                            strtolower($user_obj_ud['first_name'] ));
                    }
                    $total_payment_ud = 0;
                    foreach($collection_obj_ud as $collected_ud){
                        if($collected_ud['status']=='verified'){
                            $payment_ud = $collected_ud['amount_paid'] + $collected_ud['with_held'] + $collected_ud['other_amount'];
                            $total_payment_ud = $total_payment_ud + $payment_ud;
                        }
                    }
                    $collected_amount_ud = "&#8369; ".number_format((float)$total_payment_ud, 2);
                    if($quotation_obj_ud['grand_total']!=null) {
                        $grand_total_tmp_ud = $quotation_obj_ud['grand_total'];
                        $grand_total_ud = "&#8369; ".number_format((float)$grand_total_tmp_ud,2);
                    }
                    $balance_ud = "&#8369; ".number_format((float)$grand_total_tmp_ud-$total_payment_ud,2);
                    if($quotation_obj_ud['collection_remarks']!="") {
                        $collection_status_ud = $quotation_obj_ud['collection_remarks'];
                    }
                    
                    $tgrand_total_ud = $tgrand_total_ud + $grand_total_tmp_ud;
                    $ttotal_payment_ud = $ttotal_payment_ud + $total_payment_ud;
                    $tbalance_ud = $tbalance_ud + ($grand_total_tmp_ud-$total_payment_ud);
                    
                    $tbody_for_undelivered .= '
                    <tr>
                        <td align="center">'.$count_ud.'</td>
                        <td align="center">'.$date_moved_ud.'</td>
                        <td align="center">'.$quotation_number_ud.'</td>
                        <td align="center">'.$company_name_ud.'</td>
                        <td align="center">'.$agent_name_ud.'</td>
                        <td align="right">'.$grand_total_ud.'</td>
                        <td align="right">'.$collected_amount_ud.'</td>
                        <td align="right">'.$balance_ud.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_ud.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_undelivered .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_undelivered = '<tbody><tr><td>No data for undelivered.</td></tr></tbody>';
            }
            
            // =============> PENDING
            $date_moved_p = $unknown;
            $quotation_number_p = $unknown;
            $company_name_p = $not_specified;
            $agent_name_p = $unknown;
            $collected_amount_p = "&#8369;  0.00";
            $grand_total_p = "&#8369;  0.00";
            $grand_total_tmp_p = 0;
            if(!empty($pending)) {
                $tbody_for_pending = '<tbody>';
                $count_p = 0;
                $collection_status_p = $not_specified;
                foreach($pending as $ret_pending) {
                    $count_p++;
                    $quotation_obj_p = $ret_pending['Quotation'];
                    $company_obj_p = $ret_pending['Client'];
                    $user_obj_p = $ret_pending['User'];
                    $collection_obj_p = $ret_pending['Collection'];

                    if($quotation_obj_p['date_moved']!="") {
                        $date_moved_p = date("M. d, Y", strtotime($quotation_obj_p['date_moved']));
                    }
                    if($quotation_obj_p['quote_number']!="") {
                        $quotation_number_p =$quotation_obj_p['quote_number'];
                    }
                    if($company_obj_p['name']!="") {
                        $company_name_p = ucwords($company_obj_p['name']);
                    }
                    if($user_obj_p['first_name']!="" || $user_obj_p['last_name']!="") {
                        $agent_name_p = ucwords(
                                            strtolower($user_obj_p['first_name'] ));
                    }
                    $total_payment_p = 0;
                    foreach($collection_obj_p as $collected_p){
                        if($collected_p['status']=='verified'){
                            $payment_p = $collected_p['amount_paid'] + $collected_p['with_held'] + $collected_p['other_amount'];
                            $total_payment_p = $total_payment_p + $payment_p;
                        }
                    }
                    $collected_amount_p = "&#8369; ".number_format((float)$total_payment_p, 2);
                    if($quotation_obj_p['grand_total']!=null) {
                        $grand_total_tmp_p = $quotation_obj_p['grand_total'];
                        $grand_total_p = "&#8369; ".number_format((float)$grand_total_tmp_p,2);
                    }
                    $balance_p = "&#8369; ".number_format((float)$grand_total_tmp_p-$total_payment_p,2);
                    if($quotation_obj_p['collection_remarks']!="") {
                        $collection_status_p = $quotation_obj_p['collection_remarks'];
                    }
                    
                    $tbody_for_pending .= '
                    <tr>
                        <td align="center">'.$count_p.'</td>
                        <td align="center">'.$date_moved_p.'</td>
                        <td align="center">'.$quotation_number_p.'</td>
                        <td align="center">'.$company_name_p.'</td>
                        <td align="center">'.$agent_name_p.'</td>
                        <td align="right">'.$grand_total_p.'</td>
                        <td align="right">'.$collected_amount_p.'</td>
                        <td align="right">'.$balance_p.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_p.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_pending .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_pending = '<tbody><tr><td>No data for pending.</td></tr></tbody>';
            }
            
            // =============> WITH PDC
            $date_moved_wpdc = $unknown;
            $quotation_number_wpdc = $unknown;
            $company_name_wpdc = $not_specified;
            $agent_name_wpdc = $unknown;
            $collected_amount_wpdc = "&#8369;  0.00";
            $grand_total_wpdc = "&#8369;  0.00";
            $grand_total_tmp_wpdc = 0;
            
            $ttotal_payment_wpdc = 0;
            $tgrand_total_tmp_wpdc = 0;
            $tbalance_wpdc = 0;
            
            if(!empty($with_pdc)) { //  $with_pdc atadapat to
                $tbody_for_with_wpdc = '<tbody>';
                $count_wpdc = 0;
                $collection_status_wpdc = $not_specified;
                foreach($with_pdc as $ret_with_wpdc) {
                    $count_wpdc++;
                    $quotation_obj_wpdc = $ret_with_wpdc['Quotation'];
                    $company_obj_wpdc = $ret_with_wpdc['Client'];
                    $user_obj_wpdc = $ret_with_wpdc['User'];
                    $collection_obj_wpdc = $ret_with_wpdc['Collection'];

                    if($quotation_obj_wpdc['date_moved']!="") {
                        $date_moved_wpdc = date("M. d, Y", strtotime($quotation_obj_wpdc['date_moved']));
                    }
                    if($quotation_obj_wpdc['quote_number']!="") {
                        $quotation_number_wpdc =$quotation_obj_wpdc['quote_number'];
                    }
                    if($company_obj_wpdc['name']!="") {
                        $company_name_wpdc = ucwords($company_obj_wpdc['name']);
                    }
                    if($user_obj_wpdc['first_name']!="" || $user_obj_wpdc['last_name']!="") {
                        $agent_name_wpdc = ucwords(
                                            strtolower($user_obj_wpdc['first_name'] ));
                    }
                    $total_payment_wpdc = 0;
                    foreach($collection_obj_wpdc as $collected_wpdc){
                        if($collected_wpdc['status']=='verified'){
                            $payment_wpdc = $collected_wpdc['amount_paid'] + $collected_wpdc['with_held'] + $collected_wpdc['other_amount'];
                            $total_payment_wpdc = $total_payment_wpdc + $payment_wpdc;
                        }
                    }
                    $collected_amount_wpdc = "&#8369; ".number_format((float)$total_payment_wpdc, 2);
                    if($quotation_obj_wpdc['grand_total']!=null) {
                        $grand_total_tmp_wpdc = $quotation_obj_wpdc['grand_total'];
                        $grand_total_wpdc = "&#8369; ".number_format((float)$grand_total_tmp_wpdc,2);
                    }
                    $balance_wpdc = "&#8369; ".number_format((float)$grand_total_tmp_wpdc-$total_payment_wpdc,2);
                    if($quotation_obj_wpdc['collection_remarks']!="") {
                        $collection_status_wpdc = $quotation_obj_wpdc['collection_remarks'];
                    }
                    
                    $ttotal_payment_wpdc = $ttotal_payment_wpdc + $total_payment_wpdc;
                    $tgrand_total_tmp_wpdc = $tgrand_total_tmp_wpdc + $grand_total_tmp_wpdc;
                    $tbalance_wpdc = $tbalance_wpdc + ($grand_total_tmp_wpdc-$total_payment_wpdc);
                    
                    
                    $tbody_for_with_wpdc .= '
                    <tr>
                        <td align="center">'.$count_wpdc.'</td>
                        <td align="center">'.$date_moved_wpdc.'</td>
                        <td align="center">'.$quotation_number_wpdc.'</td>
                        <td align="center">'.$company_name_wpdc.'</td>
                        <td align="center">'.$agent_name_wpdc.'</td>
                        <td align="right">'.$grand_total_wpdc.'</td>
                        <td align="right">'.$collected_amount_wpdc.'</td>
                        <td align="right">'.$balance_wpdc.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_wpdc.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_with_wpdc .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_with_wpdc = '<tbody><tr><td>No data for quotation with PDC.</td></tr></tbody>';
            }
            
            // =============> BIR 2307
            $date_moved_bir2307 = $unknown;
            $quotation_number_bir2307 = $unknown;
            $company_name_bir2307 = $not_specified;
            $agent_name_bir2307 = $unknown;
            $collected_amount_bir2307 = "&#8369;  0.00";
            $grand_total_bir2307 = "&#8369;  0.00";
            $grand_total_tmp_bir2307 = 0;
            
            $ttotal_payment_bir2307 = 0;
            $tgrand_total_tmp_bir2307 = 0;
            $tbalance_bir2307 = 0;
            if(!empty($bir2307)) {
                $tbody_for_bir2307 = '<tbody>';
                $count_bir2307 = 0;
                $collection_status_bir2307 = $not_specified;
                foreach($bir2307 as $ret_bir2307) {
                    $count_bir2307++;
                    $quotation_obj_bir2307 = $ret_bir2307['Quotation'];
                    $company_obj_bir2307 = $ret_bir2307['Client'];
                    $user_obj_bir2307 = $ret_bir2307['User'];
                    $collection_obj_bir2307 = $ret_bir2307['Collection'];

                    if($quotation_obj_bir2307['date_moved']!="") {
                        $date_moved_bir2307 = date("M. d, Y", strtotime($quotation_obj_bir2307['date_moved']));
                    }
                    if($quotation_obj_bir2307['quote_number']!="") {
                        $quotation_number_bir2307 =$quotation_obj_bir2307['quote_number'];
                    }
                    if($company_obj_bir2307['name']!="") {
                        $company_name_bir2307 = ucwords($company_obj_bir2307['name']);
                    }
                    if($user_obj_bir2307['first_name']!="" || $user_obj_bir2307['last_name']!="") {
                        $agent_name_bir2307 = ucwords(
                                            strtolower($user_obj_bir2307['first_name'] ));
                    }
                    $total_payment_bir2307 = 0;
                    foreach($collection_obj_bir2307 as $collected_bir2307){
                        if($collected_bir2307['status']=='verified'){
                            $payment_bir2307 = $collected_bir2307['amount_bir2307aid'] + $collected_bir2307['with_held'] + $collected_bir2307['other_amount'];
                            $total_payment_bir2307 = $total_payment_bir2307 + $payment_bir2307;
                        }
                    }
                    $collected_amount_bir2307 = "&#8369; ".number_format((float)$total_payment_bir2307, 2);
                    if($quotation_obj_bir2307['grand_total']!=null) {
                        $grand_total_tmp_bir2307 = $quotation_obj_bir2307['grand_total'];
                        $grand_total_bir2307 = "&#8369; ".number_format((float)$grand_total_tmp_bir2307,2);
                    }
                    $balance_bir2307 = "&#8369; ".number_format((float)$grand_total_tmp_bir2307-$total_payment_bir2307,2);
                    if($quotation_obj_bir2307['collection_remarks']!="") {
                        $collection_status_bir2307 = $quotation_obj_bir2307['collection_remarks'];
                    }
                    
                    $ttotal_payment_bir2307 = $ttotal_payment_bir2307 + $total_payment_bir2307;
                    $tgrand_total_tmp_bir2307 = $tgrand_total_tmp_bir2307 + $grand_total_tmp_bir2307;
                    $tbalance_bir2307 = $tbalance_bir2307 + ($grand_total_tmp_bir2307-$total_payment_bir2307);
                    
                    $tbody_for_bir2307 .= '
                    <tr>
                        <td align="center">'.$count_bir2307.'</td>
                        <td align="center">'.$date_moved_bir2307.'</td>
                        <td align="center">'.$quotation_number_bir2307.'</td>
                        <td align="center">'.$company_name_bir2307.'</td>
                        <td align="center">'.$agent_name_bir2307.'</td>
                        <td align="right">'.$grand_total_bir2307.'</td>
                        <td align="right">'.$collected_amount_bir2307.'</td>
                        <td align="right">'.$balance_bir2307.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_bir2307.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_bir2307 .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_bir2307 = '<tbody><tr><td>No data for BIR 2307.</td></tr></tbody>';
            }
            
            $date_moved_paid = $unknown;
            $quotation_number_paid = $unknown;
            $company_name_paid = $not_specified;
            $agent_name_paid = $unknown;
            $collected_amount_paid = "&#8369;  0.00";
            $grand_total_paid = "&#8369;  0.00";
            $grand_total_tmp_paid = 0;
            
            $tgrand_total_tmp_paid = 0;
            $ttotal_payment_paid = 0;
            $tbalance_paid = 0;
                    
            if(!empty($paid)) {
                $tbody_for_paid = '<tbody>';
                $count_paid = 0;
                $collection_status_paid = $not_specified;
                foreach($paid as $ret_paid) {
                    $count_paid++;
                    $quotation_obj_paid = $ret_paid['Quotation'];
                    $company_obj_paid = $ret_paid['Client'];
                    $user_obj_paid = $ret_paid['User'];
                    $collection_obj_paid = $ret_paid['Collection'];

                    if($quotation_obj_paid['date_moved']!="") {
                        $date_moved_paid = date("M. d, Y", strtotime($quotation_obj_paid['date_moved']));
                    }
                    if($quotation_obj_paid['quote_number']!="") {
                        $quotation_number_paid =$quotation_obj_paid['quote_number'];
                    }
                    if($company_obj_paid['name']!="") {
                        $company_name_paid = ucwords($company_obj_paid['name']);
                    }
                    if($user_obj_paid['first_name']!="" || $user_obj_paid['last_name']!="") {
                        $agent_name_paid = ucwords(
                                            strtolower($user_obj_paid['first_name'] ));
                    }
                    $total_payment_paid = 0;
                    foreach($collection_obj_paid as $collected_paid){
                        if($collected_paid['status']=='verified'){
                            $payment_paid = $collected_paid['amount_paid'] + $collected_paid['with_held'] + $collected_paid['other_amount'];
                            $total_payment_paid = $total_payment_paid + $payment_paid;
                        }
                    }
                    $collected_amount_paid = "&#8369; ".number_format((float)$total_payment_paid, 2);
                    if($quotation_obj_paid['grand_total']!=null) {
                        $grand_total_tmp_paid = $quotation_obj_paid['grand_total'];
                        $grand_total_paid = "&#8369; ".number_format((float)$grand_total_tmp_paid,2);
                    }
                    $balance_paid = "&#8369; ".number_format((float)$grand_total_tmp_paid-$total_payment_paid,2);
                    if($quotation_obj_paid['collection_remarks']!="") {
                        $collection_status_paid = $quotation_obj_paid['collection_remarks'];
                    }
                    
                    $tgrand_total_tmp_paid = $tgrand_total_tmp_paid + $grand_total_tmp_paid;
                    $ttotal_payment_paid = $ttotal_payment_paid + $total_payment_paid;
                    $tbalance_paid = $tbalance_paid + ($grand_total_tmp_paid-$total_payment_paid);
                    
                    
                    $tbody_for_paid .= '
                    <tr>
                        <td align="center">'.$count_paid.'</td>
                        <td align="center">'.$date_moved_paid.'</td>
                        <td align="center">'.$quotation_number_paid.'</td>
                        <td align="center">'.$company_name_paid.'</td>
                        <td align="center">'.$agent_name_paid.'</td>
                        <td align="right">'.$grand_total_paid.'</td>
                        <td align="right">'.$collected_amount_paid.'</td>
                        <td align="right">'.$balance_paid.'</td>
                        <td align="center"></td>
                        <td align="center">'.$collection_status_paid.'</td>
                    </tr>
                    ';
                }
                
                $tbody_for_paid .= '
                </tbody>
                ';
            }
            else {
                $tbody_for_paid = '<tbody><tr><td>No data for paid.</td></tr></tbody>';
            }
            
            $this->Mpdf->init();
            
            $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
                <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px;" align="right">' . date("F d, Y") . '</div><hr/>');
                  $this->Mpdf->SetHTMLFooter('<hr/><table style="width: 100%;padding-bottom:-15px;">
                                    <tr>
                                        <td style="text-align: left;width:70%;font-size:10px;">{PAGENO} / {nbpg} </td>
                                        <td style="text-align: right;width: 30%;font-size:10px;">w w w . j e c a m s . c o m . p h</td> 
                                    </tr>
                                </table> ');
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
                <h3 align="center">'.$collection_name.'</h3>';
                if(!empty($for_collection)) {
          $html .= '<h5 align="center">For Collection</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_collection.' 
                            <tr>
                                <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                <td align="right"><strong>&#8369; '.number_format($tgrand_total_fc,2).'</strong></td>
                                <td align="right"><strong>&#8369; '.number_format($tcollected_amount_fc,2).'</strong></td>
                                <td align="right"><strong>&#8369; '.number_format($tbalance_fc,2).'</strong></td>
                                <td colspan="2"></td>  
                            </tr>
                    </table>';
                }
                if(!empty($with_terms)) {
          $html .= '<h5 align="center">With Terms</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_with_terms.'
                            <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_tmp_wt,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_wt,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_wt,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr>
                    </table>';
                }
                if(!empty($incomplete)) {
          $html .= '<h5 align="center">Incomplete</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_incomplete.'
                        <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_tmp_ic,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_ic,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_ic,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr>
                    </table>';
                }
                if(!empty($backjob)) {
          $html .= '<h5 align="center">Backjob</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_backjob.' 
                        <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_tmp_bkj,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_bkj,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_bkj,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr>
                    </table>';
                }
                if(!empty($undelivered)) {
          $html .= '<h5 align="center">Undelivered</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_undelivered.' 
                        <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_ud,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_ud,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_ud,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr>
                    </table>';
                } 
                if(!empty($pending)) {
          $html .= '<h5 align="center">Pending</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_pending.'
                    </table>';
                }
                if(!empty($with_pdc)) {
          $html .= '<h5 align="center">With PDC</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_with_wpdc.' 
                        <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_tmp_wpdc,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_wpdc,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_wpdc,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr> 
                    </table>';
                }
                if(!empty($bir2307)) {
          $html .= '<h5 align="center">BIR 2307 / BIR 2306</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_bir2307.'
                        <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_tmp_bir2307,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_bir2307,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_bir2307,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr> 
                    </table>';
                }
                if(!empty($paid)) {
          $html .= '<h5 align="center">Paid</h5>
                    <table width="100%"  style="font-family:aktiv-grotesk-std,Helvetica Neue,Arial;line-height: 1.42857143;border-collapse:collapse;font-size:10px;border-color:#1a1a1a" border="1" align="center">
                        <thead>
                            <tr>
                                <th style="font-size:11px;" align="center" width="25">#</th>
                                <th style="font-size:11px;" align="center" width="70">Date Moved</th>
                                <th style="font-size:11px;" align="center" width="95">Quotation #</th>
                                <th style="font-size:11px;" align="center" width="250">Company Name</th>
                                <th style="font-size:11px;" align="center" width="30">Agent</th>
                                <th style="font-size:11px;" align="center" width="150">Contract Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Collected Amount</th>
                                <th style="font-size:11px;" align="center" width="150">Balance</th>
                                <th style="font-size:11px;" align="center" width="25">Days Due</th>
                                <th style="font-size:11px;" align="center" width="150">Remarks</th>
                            </tr>
                        </thead>
                        '.$tbody_for_paid.' 
                        <tr> 
                                    <td colspan="5" style="font-size:11px;padding-right:10px;" align="right" ><strong>Grand Total</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tgrand_total_tmp_paid,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($ttotal_payment_paid,2).'</strong></td>
                                    <td align="right"><strong>&#8369; '.number_format($tbalance_paid,2).'</strong></td>
                                    <td colspan="2"></td>  
                                </tr> 
                    </table>';
                }
  $html .= '</div></body>
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
            $this->render('accounting_print_quote');
            $this->Mpdf->setFilename('Accounting_Quotation.pdf');
        }
        else {
            $warning = "This is a restricted area. Please contact System Administrator.";
            $this->set(compact('warning'));
        }
    }
    
    public function print_collection_schedule() {
        $this->loadModel->CollectionSchedule();
        $this->CollectionSchedule->recursive = 2;
        $type = $this->params['url']['type'];
        
            $dateToday = date("Y-m-d");
                if($type='today'){
                    $collection_schedules = $this->CollectionSchedule->find('all',[
                        'conditions'=>['CollectionSchedule.collection_date LIKE %'=>$dateToday]]);
                }
                // pr($collection_schedules);
                $this->Mpdf->init();
            
            $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
                <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px;" align="right">' . date("F d, Y") . '</div><hr/>');
            // $this->Mpdf->SetHTMLFooter('<hr/><p align="right" style="font-size:10px">w w w . j e c a m s . c o m . p h</p>');
                $this->Mpdf->SetHTMLFooter('<hr/><table style="width: 100%;padding-bottom:-15px;">
                                    <tr>
                                        <td style="text-align: left;width:70%;font-size:10px;">{PAGENO} / {nbpg} </td>
                                        <td style="text-align: right;width: 30%;font-size:10px;">w w w . j e c a m s . c o m . p h</td> 
                                    </tr>
                                </table> ');
            $html = '
            <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
                <tr>
                    <td>
                        <font style="font-weight:bold">Main Office:</font><br/>
                        No. 3 Queen Street Forest Hills, Novaliches, Quezon City 1117<br/><br/>
                        <font style="font-weight:bold">Makati Sales Office:</font><br/>
                        Makati: Ground Floor Erechem Bldg V.A Rufino Corner Salcedo St., Legaspi Village, Makati City
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
            
            <div>
                <h3 align="center">Collection Schedule for '.ucwords($type).'</h3>
                <h5 align="center"></th>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date of Collection</th>
                            <th>Quotation #</th>
                            <th>Company Name</th>
                            <th>Agent</th> 
                            <th>Collected Amount</th>
                            <th>Balance</th>
                            <th>Expected Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
            $this->render('print_collection_schedule');
            $this->Mpdf->setFilename('print_collection_schedule.pdf');
    }
    
    public function print_monetary_report(){
        $type = $this->params['url']['type'];
        $pdc_type = $this->params['url']['pdc_type'];
        $payee_id = $this->params['url']['payee_id'];
        $bank_id = $this->params['url']['bank'];
        $start_date = $this->params['url']['sd'];
        $end_date = $this->params['url']['ed'];
        
        $pretty_start_date = date("F d, Y", strtotime($start_date));
        $pretty_end_date = date("F d, Y", strtotime($end_date));

            $edited_date_start = date('Y-m-d',strtotime($start_date));
            $edited_date_end = date('Y-m-d',strtotime($end_date)); 
			$end_compare = date('Y-m-d',strtotime($end_date."+ 1 day"));
        // QUERY
        // ======================================================================>
        if($type=="cheque") {
            // FOR CHEQUE
            // ======================================================================>
            $this->loadModel('PaymentRequestCheque');
            
            if($pdc_type == 'payee'){
                //payee
                $rpayee = $this->Payee->findById($payee_id); 
                $subtitle = "<br/> [<small>".$rpayee['Payee']['name']."</small>]";
                $table_label = "<th>Bank</th>";
                
                $payment_requests =  $this->PaymentRequestCheque->find('all', [
                    'conditions'=>[
                            'PaymentRequestCheque.status'=>'released',
                            'PaymentRequestCheque.payee_id'=>$payee_id, 
							'PaymentRequestCheque.created >=' => $start_date,
							'PaymentRequestCheque.created <' => $end_compare,
                            //['PaymentRequestCheque.created BETWEEN ? and ?' => [$start_date, $end_date]]
                        ],
                    'order'=>['PaymentRequestCheque.cheque_date ASC']]);
            }else if($pdc_type == 'bank'){
                //bank
                $rbank = $this->Bank->findById($bank_id); 
                $subtitle = "<br/> [<small>".$rbank['Bank']['display_name']."</small>]"; 
                $table_label = "<th>Payee</th>"; 
                
                $payment_requests =  $this->PaymentRequestCheque->find('all', [
                    'conditions'=>[
                        'PaymentRequestCheque.status'=>'released',
                        'PaymentRequestCheque.bank_id'=>$bank_id, 
							'PaymentRequestCheque.created >=' => $start_date,
							'PaymentRequestCheque.created <' => $end_compare,
                        //['PaymentRequestCheque.created BETWEEN ? and ?' => [$start_date, $end_date]]
                        ],
                    'order'=>['PaymentRequestCheque.cheque_date ASC']]);
            }else{ 
                //all
                $subtitle = "";  
                $table_label = "<th>Bank</th><th>Payee</th>"; 
                $payment_requests =  $this->PaymentRequestCheque->find('all', [
                    'conditions'=>[
                        'PaymentRequestCheque.status'=>'released', 
							'PaymentRequestCheque.created >=' => $start_date,
							'PaymentRequestCheque.created <' => $end_compare,
                        //['PaymentRequestCheque.created BETWEEN ? and ?' => [$start_date, $end_date]]
                        ],
                    'order'=>['PaymentRequestCheque.cheque_date DESC']]);
            }
        }
        elseif($type=="cash") {
            // FOR CASH
            // ======================================================================>
            $this->loadModel('PaymentRequest');
            $this->PaymentRequest->recursive = 2;
            if($edited_date_start == $edited_date_end){ 

	            $payment_requests = $this->PaymentRequest->find('all',
	                ['conditions'=>
	                    ['PaymentRequest.type'=>'cash',
	                    'PaymentRequest.status'=>'verified', 
	                        ['PaymentRequest.verified_date LIKE' => '%'.$edited_date_start.'%' ]
	                    ],
					'order'=>['PaymentRequest.created ASC']
					]); 

            }else{ 
	            $payment_requests = $this->PaymentRequest->find('all',
	                ['conditions'=>
	                    ['PaymentRequest.type'=>'cash',
	                    'PaymentRequest.status'=>'verified', 
	                        //['PaymentRequest.verified_date BETWEEN ? and ?' => [$start_date, $end_date]]
							'PaymentRequest.verified_date >=' => $start_date,
							'PaymentRequest.verified_date <' => $end_compare,
	                    ],
					'order'=>['PaymentRequest.created ASC']
					]);
            }

        }
        elseif($type=="pettycash") {
            // FOR PETTY CASH
            // ======================================================================>
            $this->loadModel('PaymentRequest');
            // $this->PaymentRequest->recursive = 2;
            if($edited_date_start == $edited_date_end){
	            $payment_requests = $this->PaymentRequest->find('all',
	                ['conditions'=>
	                    ['PaymentRequest.type'=>'pettycash',
	                        ['PaymentRequest.replenished_date LIKE' => '%'.$edited_date_start.'%' ]
	                    ]
	                ]);
	        }else{
	            $payment_requests = $this->PaymentRequest->find('all',
	                ['conditions'=>
	                    ['PaymentRequest.type'=>'pettycash', 
							'PaymentRequest.replenished_date >=' => $start_date,
							'PaymentRequest.replenished_date <' => $end_compare,
	                        //['PaymentRequest.replenished_date BETWEEN ? and ?' => [$start_date, $end_date]]
	                    ]
	                ]);

	        }
            
            $this->loadModel('CompanyFund');
            $companyFund = $this->CompanyFund->find('first');
        }
        
        // TABLE MANIPULATION
        // ======================================================================>
        if($type=="cheque") {
            // FOR CHEQUE
            // ======================================================================>
            $title = "<b>Released ".ucwords($type)." Request
                     <br/>
                     (".$pretty_start_date.
                     " to ".$pretty_end_date.")<br/>";
            $tr_details = []; 
            $cnt =1; 
            $total_cheque_amnt = 0;
            if($pdc_type == "bank"){
                $table_label_footer = "<td></td>";
            }else if($pdc_type == "payee") {
                $table_label_footer = "<td></td>";
            }else {
                $table_label_footer = "<td></td><td></td>";
            }
            foreach($payment_requests as $payment_request){
                if($pdc_type == "bank"){
                    $table_specific_label = "<td align='center'>".
                        $payment_request['Payee']['name']."</td>";
                }else if($pdc_type == "payee") {
                    $table_specific_label = "<td align='center'>".
                        $payment_request['Bank']['display_name']."</td>";
                }else {
                    $table_specific_label = "<td align='center'>".
                        $payment_request['Bank']['display_name']."</td>
                    <td align='center'>".$payment_request['Payee']['name']."</td>";
                }
                $tr_details[] = '<tr>
                    <td align="center">' . $cnt . '  </td>
                    <td align="center">'.
                        date('M d, Y', strtotime($payment_request['PaymentRequestCheque']['created'])) . '</td> 
                        '.$table_specific_label.'
                    <td align="right">&#8369; '
                        .number_format($payment_request['PaymentRequest']['requested_amount'], 2) . '</td>  
                    <td align="center">'.
                        $payment_request['PaymentRequestCheque']['cheque_number'] . '</td>
                    <td align="right">'.
                        date('M d, Y', strtotime($payment_request['PaymentRequestCheque']['cheque_date'])).'</td></tr>';
                $cnt++; 
                $total_cheque_amnt += $payment_request['PaymentRequest']['requested_amount'];
            }
            
            $table="<table width='100%' 
                           style='font-family:Arial;border-collapse:collapse;font-size:12px;border-color:#1a1a1a'
                           align='center'
                           border='1'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Issued</th>
                                '.$table_label.'
                                <th>Amount</th>
                                <th>Cheque #</th>
                                <th>Cheque Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            ".implode($tr_details)."
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                ".$table_label_footer."
                                <th align='right'>&#8369; ".number_format($total_cheque_amnt,2)."</th>
                                <th>&nbsp;</th> 
                                <th>&nbsp;</th> 
                            </tr> 
                        </tfoot>
                    </table>";
        }
        elseif($type=="cash") {
            // FOR CASH
            // ======================================================================>
            $tr_details = [];
            $requested_amount_total = 0;
            $released_amount_total = 0;
            $liquidated_amount_total = 0;
            $returned_amount_total = 0;
            $reimbursed_amount_total = 0;
            foreach($payment_requests as $payment_request) {
                $PaymentRequest = $payment_request['PaymentRequest'];
                $PaymentInvoice = $payment_request['PaymentInvoice'];
                $PaymentPurchaseOrder = $payment_request['PaymentPurchaseOrder'];
                $User = $payment_request['InsertedBy'];
                
                $po_number = '';
                if(!empty($PaymentPurchaseOrder)) {
                    $po_number = "- ".$PaymentPurchaseOrder[0]['PurchaseOrder']['po_number']." -";
                }
                $reimbursed_amount = "&#8369; ".number_format((float)$PaymentRequest['reimbursed_amount'], 2, '.', ',');
                $released_amount = "&#8369; ".number_format((float)$PaymentRequest['released_amount'], 2, '.', ',');
                $requested_amount = "&#8369; ".number_format((float)$PaymentRequest['requested_amount'], 2, '.', ',');
                $returned_amount = "&#8369; ".number_format((float)$PaymentRequest['returned_amount'], 2, '.', ',');
                $first_name = $User['first_name'];
                $last_name = $User['last_name'];
                $full_name = ucwords($first_name." ".$last_name);
                $liquidated_date = "<font style='color:red'>Not Specified</font>";
                if(is_null($PaymentRequest['replenished_date'])) {
                    $liquidated_date = date("F d, Y", strtotime($PaymentRequest['replenished_date']));
                }
                $liquidated_amount = "&#8369; ".number_format((float)$PaymentRequest['liquidated_amount'], 2, '.', ',');
                $created = '';
                if($PaymentRequest['created']!=null) {
                    $created = date("M d, Y", strtotime($PaymentRequest['created']));
                    $pretty_created = "(".date("M d, Y", strtotime($PaymentRequest['created'])).")";
                }
                
				$verified_dated = "(".date("M d, Y", strtotime($PaymentRequest['verified_date'])).")";
                $requested_amount_total += $PaymentRequest['requested_amount'];
                $released_amount_total += $PaymentRequest['released_amount'];
                $liquidated_amount_total += $PaymentRequest['liquidated_amount'];
                $returned_amount_total += $PaymentRequest['returned_amount'];
                $reimbursed_amount_total += $PaymentRequest['reimbursed_amount'];
                $purpose = $PaymentRequest['purpose'];
                $particulars = [];
                $ref_no_array = [];
                foreach($PaymentInvoice as $payment_invoice) {
                    $ref_type = $payment_invoice['reference_type'];
                    $ref_no = $payment_invoice['reference_number'];
					
					
					$invoice_created = '';
					if(!empty($payment_invoice['created'])) {
						$invoice_created = "(".date("M d, Y", strtotime($payment_invoice['created'])).")";
					}
					$reference_date = '';
					if(!empty($payment_invoice['reference_date'])) {
						$reference_date = "(".date("M d, Y", strtotime($payment_invoice['reference_date'])).")";
					}
                
					
                    $particular_amount = $payment_invoice['amount'] + $payment_invoice['with_held_amount'] + $payment_invoice['ewt_amount'] + $payment_invoice['tax_amount'];
                    
                    $particulars[] = "<p>".$ref_type.
                                     " - ".$ref_no.
                                     " - &#8369; ".number_format($particular_amount,2).
                                     " ".$po_number.
                                     " - ".$reference_date."</p>";
                    $ref_no_array[] = "<p>".$ref_type." - ".$ref_no."</p>";
                }
                $tr_details[] = '
                <tr>
                    <td>'.implode($particulars).'</td> 
                    <td>'.$purpose.'</td>
                    <td style="text-align:center">'.$full_name.'<br/>'.$pretty_created.'</td>
                    <td align="right">'.$requested_amount.'</td>
                    <td align="right">'.$released_amount.'</td>
                    <td align="right">'.$liquidated_amount.'</td>
                    <td align="right">'.$returned_amount.'</td>
                    <td align="right">'.$reimbursed_amount.'</td>
                </tr>
                ';
                
            }
            
            $title="<b>Contingency Fund Liquidation Report
                    <br/>
                    (".$pretty_start_date." to ".$pretty_end_date.")</b>";
                    
                    
            $table="<table width='100%' 
                           style='font-family:Arial;border-collapse:collapse;font-size:12px;border-color:#1a1a1a'
                           align='center'
                           border='1'>
                        <thead>
                            <tr>
                                <th>Particulars</th> 
                                <th>Purpose</th>
                                <th>Requested By / <br/>(Request Date)</th>
                                <th>Amount Requested</th>
                                <th>Amount Released</th>
                                <th>Amount Liquidated</th>
                                <th>Amount Returned</th>
                                <th>Amount Refunded</th>
                            </tr>
                        </thead>
                        <tbody>
                        ".implode($tr_details)."
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan='3' align='right'>Grand Total&nbsp;</th>
                                <th align='right'>&#8369; ".number_format((float)$requested_amount_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$released_amount_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$liquidated_amount_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$returned_amount_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$reimbursed_amount_total, 2, ".", ",")."</th>
                            </tr>
                        </tfoot>
                    </table>";
        }
        elseif($type=="pettycash") {
            // FOR PETTY CASH
            // ======================================================================>
            $requested_amount_total = 0;
            $released_amount_total = 0;
            $liquidated_amount_total = 0;
            $returned_amount_total = 0;
            $reimbursed_amount_total = 0;
            $total_expense_total_tmp = 0;
            $total_expense_total = "&#8369; 0.00";
            $tr_details = [];
            foreach($payment_requests as $payment_request) {
                $payment_request_obj = $payment_request['PaymentRequest'];
                $InsertedBy = $payment_request['InsertedBy'];
                $PaymentInvoice = $payment_request['PaymentInvoice'];
                
                $unknown = "<font style='color:red;'>Unknown</font>";
                $not_specified = "<font style='color:red;'>Not Specified</font>";
                $control_number = "<font style='color:red;'>No Control Number</font>";
                if($payment_request_obj['control_number']!=null) {
                    $control_number = $payment_request_obj['control_number'];
                }
                $requested_by = $unknown;
                if($InsertedBy['first_name']!="" && $InsertedBy['last_name']!="") {
                    $requested_by = ucwords($InsertedBy['first_name']." ".$InsertedBy['last_name']);
                }
                $date_created = $not_specified;
                if($payment_request_obj['created']!=null) {
                    $date_created = time_elapsed_string($payment_request_obj['created']);
                }
                $purpose = $not_specified;
                if($payment_request_obj['purpose']!="" && $payment_request_obj['purpose']!=null) {
                    $purpose = $payment_request_obj['purpose'];
                }
                
                $total_expense_tmp = 0;
                $invoices = [];
                foreach($PaymentInvoice as $payment_invoice) {
                    $ref_type = $payment_invoice['reference_type'];
                    $ref_no = $payment_invoice['reference_number'];
                    if(is_null($payment_invoice['date_deleted'])) {
                        $total_expense_tmp += $payment_invoice['amount']+
                                              $payment_invoice['with_held_amount']+
                                              $payment_invoice['ewt_amount']+
                                              $payment_invoice['tax_amount'];
                        
                        $total_expense_tmp1 = $payment_invoice['amount']+
                                              $payment_invoice['with_held_amount']+
                                              $payment_invoice['ewt_amount']+
                                              $payment_invoice['tax_amount'];
                    }
                    
                    $invoices[] = "<p>".$ref_type."-".$ref_no."(&#8369;".number_format((float)$total_expense_tmp1,2,".",",") .")</p>";
                }
                $total_expense_total_tmp += $total_expense_tmp;
                $total_expense_total = "&#8369; ".number_format((float)$total_expense_total_tmp, 2, ".", ",");
                $total_expense = "&#8369; ".number_format((float)$total_expense_tmp, 2, ".", ",");
                $reimbursed_amount = "&#8369; ".number_format((float)$payment_request_obj['reimbursed_amount'], 2, '.', ',');
                $released_amount = "&#8369; ".number_format((float)$payment_request_obj['released_amount'], 2, '.', ',');
                $requested_amount = "&#8369; ".number_format((float)$payment_request_obj['requested_amount'], 2, '.', ',');
                $returned_amount = "&#8369; ".number_format((float)$payment_request_obj['returned_amount'], 2, '.', ',');
                $requested_amount_total += $payment_request_obj['requested_amount'];
                $released_amount_total += $payment_request_obj['released_amount'];
                $liquidated_amount_total += $payment_request_obj['liquidated_amount'];
                $returned_amount_total += $payment_request_obj['returned_amount'];
                $reimbursed_amount_total += $payment_request_obj['reimbursed_amount'];
                
                $tr_details[] = '
                <tr>
                    <td>'.$control_number.'</td>
                    <td>'.$requested_by.'</td>
                    <td>'.$date_created.'</td>
                    <td align="right">'.$requested_amount.'</td>
                    <td align="right">'.$released_amount.'</td>
                    <td>'.$purpose.'</td>
                    <td>'.implode($invoices).'</td>
                    <td align="right">'.$total_expense.'</td>
                    <td align="right">'.$returned_amount.'</td>
                    <td align="right">'.$reimbursed_amount.'</td>
                </tr>
                ';
            }
            
            $companyFundAmount = $companyFund['CompanyFund']['amount'];
            $title="<b>Petty Cash Reimbursement
                    <br/>
                    (".$pretty_start_date." to ".$pretty_end_date.")</b>";
            $table="<table width='100%' 
                           style='font-family:Arial;border-collapse:collapse;font-size:12px;border-color:#1a1a1a'
                           align='center'
                           border='1'>
                        <thead>
                            <tr>
                                <th colspan='9' align='right'>Available Fund</th>
                                <th align='right'>&#8369; ".number_format((float)$companyFundAmount, 2, ".", ",")."</th>
                            </tr>
                            <tr>
                                <th>Control #</th>
                                <th>Requested By</th>
                                <th>Date Requested</th>
                                <th>Amount Requested</th>
                                <th>Amount Released</th>
                                <th>Purpose</th>
                                <th>Invoices</th>
                                <th>Total Invoices</th>
                                <th>Returned Amount</th>
                                <th>Reimbursed Amount</th>
                            </tr>
                        </thead>
                        <tbody>".implode($tr_details)."</tbody>
                        <tfoot>
                            <tr>
                                <th colspan='3' align='right'>Grand Total&nbsp;</th>
                                <th align='right'>&#8369; ".number_format((float)$requested_amount_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$released_amount_total, 2, ".", ",")."</th>
                                <th colspan='3' align='right'>&#8369; ".number_format((float)$total_expense_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$returned_amount_total, 2, ".", ",")."</th>
                                <th align='right'>&#8369; ".number_format((float)$reimbursed_amount_total, 2, ".", ",")."</th>
                            <tr/>
                        </tfoot>
                    </table>";
        }
        
        // PDFS RENDERING
        // ======================================================================>
		 
		/*<table style="font-family:Arial; font-size:10px;width:100%;" align="center">
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
            </table> */  
        $html = ' 
            <div align="center">'.$title.'</div> 
            '.$table;
        
        $this->Mpdf->init();
        $this->Mpdf->SetHTMLHeader('<img src="../img/jecams/logo_full.png" width="170" height="35">
            <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px; " align="right">' . date("F d, Y ") . '</div><hr/>');
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
        $this->render('print_monetary_report');
        $this->Mpdf->setFilename('monetary_report.pdf');
    }
    
    public function print_delivery_itenerary(){
    $this->loadModel('User');
    $this->loadModel('DeliveryItenerary');
        $start_date = $this->params['url']['start_date'];
        $end_date = $this->params['url']['end_date'];
        $driver_id = rtrim($this->params['url']['driver_id']);
        $type = $this->params['url']['type'];
        
        $pretty_start_date = date("F d, Y", strtotime($start_date));
        $pretty_end_date = date("F d, Y", strtotime($end_date));
        if($type=='all'){
            $title_label = ''; 
            $iteneraries = $this->DeliveryItenerary->find('all', ['conditions' => ['DeliveryItenerary.expected_start BETWEEN ? and ?' => [$start_date, $end_date]]]);
        }else{
            $driver = $this->User->find('first',[
                'conditions' => ['User.first_name LIKE' => '%'.$driver_id.'%']]);
            $title_label = ' for '.$driver['User']['first_name'].'  '.$driver['User']['last_name']; 

        $iteneraries = $this->DeliveryItenerary->find('all', ['conditions' => [
            // 'DeliveryItenerary.driver LIKE'=>'%'.$$driver_id.'%',
            'DeliveryItenerary.expected_start BETWEEN ? and ?' => [$start_date, $end_date]]]);
        }

            



        $itenerary_details = [];
        $cnt = 1;
        foreach ($iteneraries as $data) { 
            $expected_date = date('M. d, Y', strtotime($data['DeliveryItenerary']['expected_start'])).'<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['expected_start'])) . '</small>';

            if ($data['DeliveryItenerary']['delivery_mode'] == 'jecams') {
                $ref_num = $data['Vehicle']['plate_number'];
            }else{
                $ref_num = "";
            }
            if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify' && $data['Vehicle']['plate_number']!=0) {
                $ref_num = $data['Vehicle']['plate_number'];
            }else{
                $ref_num = "";
            }

            if($type=='all'){ 
                $driver_detail = "";
            }else{ 
                $driver_detail = ' - '.$data['DeliveryItenerary']['driver'];
            }

 
            if (!is_null($data['DeliveryItenerary']['departure'])) {
                $departure = date('M. d, Y', strtotime($data['DeliveryItenerary']['departure'])).'<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['departure'])) . '</small>'; 
            } else{
                $departure = "";
            }
            if (!is_null($data['DeliveryItenerary']['arrival'])) {
                $arrival = " - ".date('M. d, Y', strtotime($data['DeliveryItenerary']['arrival'])).'<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['arrival'])) . '</small>'; 
            } else{
                 $arrival = "";
            }
 
            if (!is_null($data['DeliveryItenerary']['actual_start'])) {
                $actual_start = date('M. d, Y', strtotime($data['DeliveryItenerary']['actual_start'])).'<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['actual_start'])) . '</small>'; 
            } else{
                $actual_start = "";
            }
            if (!is_null($data['DeliveryItenerary']['end_work'])) {
                $end_work = " - ".date('M. d, Y', strtotime($data['DeliveryItenerary']['end_work'])).'<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['end_work'])) . '</small>'; 
            } else{
                $end_work = "";
            }
                                    
 
 
            $itenerary_details[] = "
                            <tr>
                                <td width='10' align='center'>".$cnt."</td>
                                <td width='80' align='center'>".$expected_date."</td>
                                <td width='200' align='center'>".$data['Client']['name']."</td>
                                <td width='180' align='center'>".$data['DeliveryItenerary']['shipping_address']."</td>
                                <td width='50' align='center'>".$data['DeliveryItenerary']['delivery_mode']."</td>
                                <td width='50' align='center'>".ucwords($ref_num)." ".$driver_detail." </td>
                                <td width='50' align='center'>".$departure." ".$arrival."</td>
                                <td width='50' align='center'>".$actual_start." ".$end_work."</td>
                            </tr>";

            $cnt++;
        }
 

            $title="<b>Itenerary Report".$title_label ."
                    <br/>
                    (".$pretty_start_date." to ".$pretty_end_date.")</b>";
                    
                    
            $table="<table width='100%' 
                           style='font-family:Arial;border-collapse:collapse;font-size:10px;border-color:#1a1a1a'
                           align='center'
                           border='1'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Address</th>
                                <th>Delivery Mode</th>
                                <th>Vehicle</th>
                                <th>Departure - Arrival</th>
                                <th>Actutal Work - End Work </th> 
                            </tr>
                        </thead>
                        ".implode($itenerary_details)."
                    </table>"; 
        // PDFS RENDERING 
        // ======================================================================>
        $html = '
            <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
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
            
            <div align="center">'.$title.'</div>
            
            <br/><br/>
            
            '.$table;
        
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
        $this->render('print_delivery_itenerary');
        $this->Mpdf->setFilename('print_delivery_itenerary.pdf');
    }
    
    
    public function print_bill_monitoring(){
        $this->Mpdf->init();

        $billFrom = $this->request->data['datefrom'];
		$billTo = $this->request->data['dateto'];
		
		$option['conditions'] = ['billing_date_from BETWEEN ? and ?' => [$billFrom, $billTo]];
		$this->loadModel('BillMonitoring');
		$bills = $this->BillMonitoring->find('all', $option);
		
		$pretty_start_date = date("F d, Y", strtotime($billFrom));
        $pretty_end_date = date("F d, Y", strtotime($billTo));
		

        $title="<b>Bill Monitoring
                    <br/>
                    (".$pretty_start_date." to ".$pretty_end_date.")</b>";
                    
        foreach($bills as $bill){ 
            if($bill['BillMonitoring']['paid'] == 1){
                $paid = "yes";
            }else{
                $paid = "no";
            }
            
            if($bill['BillMonitoring']['receipt_date'] == ""){
                $receipt = "<p>not available</p>";
            }else{
                $receipt = date("F d, Y", strtotime($bill['BillMonitoring']['receipt_date'])); 
            }
        $tr_details[] = '
                <tr>
                    <th>'.date("F d, Y", strtotime($bill['BillMonitoring']['billing_date_from'])).'</th> 
                    <th>'.date("F d, Y", strtotime($bill['BillMonitoring']['billing_date_to'])).'</th>
                    <td>'.h($bill['User']['first_name']).' '.h($bill['User']['last_name']).'</td>
                    <td>'.h($bill['Bill']['BillAccount']['name']).'</td>
                    <td>&#8369;'. number_format($bill['BillMonitoring']['bill_amount'],2).'</td>
                    <td>'. h($bill['BillMonitoring']['receipt_reference_num']).'</td>
                    <td>'. h($bill['BillMonitoring']['payment_mode']).'</td>
                    <td>'.h($bill['User']['first_name'].' '.$bill['User']['last_name']).'</td>
                    <td>'.$paid.'</td>
                    <td>'.$receipt.'</td> 
                </tr>
                ';
        }
                    
        $table="<table width='100%' 
                   style='font-family:Arial;border-collapse:collapse;font-size:12px;border-color:#1a1a1a'
                   align='center'
                   border='1'>
                <thead>
                    <tr>
                        <th>Billing date from</th> 
                        <th>Billing date to</th> 
                        <th>User</th> 
                        <th>Bill account</th> 
                        <th>bill amount</th> 
                        <th>Billing receipt reference</th> 
                        <th>Payment mode</th> 
                        <th>Paid by</th> 
                        <th>Paid</th>
                        <th>Receipt date</th>
                    </tr>
                </thead>
                <tbody>
                ".implode($tr_details)."
                </tbody>
            </table>";

        $html = '
            <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
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
            
            <div align="center">'.$title.'</div>
            
            <br/><br/>
            
            '.$table;
        
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
        $this->render('print_monitoring');
        $this->Mpdf->setFilename('bill_monitoring.pdf'); 
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
}