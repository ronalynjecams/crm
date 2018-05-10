
<!--<link href="/css/plug/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<script src="/css/plug/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />



<link href="/css/sweetalert.css" rel="stylesheet"> 
<!--MAE: I had to comment,causing errors-->
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script> 
<script src="/js/erp_scripts.js"></script>  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="/js/sweetalert.min.js"></script>  
<script src="/css/plug/select/js/select2.min.js"></script> 


<!--===================================================-->
<div id="content-container" >
	<div>
    	<?php echo $this->Session->flash('alertforexisting'); ?>
	</div>
    <div id="page-title">
    </div>
    <div id="page-content">   
        <div class="row"> 
            <div class="col-sm-12">
                <div class="col-sm-7">
                    <h3 class="page-header text-overflow">
                        <input type="hidden" id="qteidd" value="<?php echo $this->params['url']['id']; ?>"/>
                        <input type="hidden" id="deliver_to" value="<?php echo $quote_data['Client']['name']; ?>"/>
                        <input type="hidden" id="clnt_id" value="<?php echo $quote_data['Client']['id']; ?>"/>
                 
                        <?php echo $quote_data['Client']['name']; ?>
                        <?php if (!empty($quote_data['Client']['tin_number'])) echo '<br/><small>[' . $quote_data['Client']['tin_number'] . ']</small>'; ?>
                        <div class="panel-control">  
                            <input type="hidden" id="quotation_id" value="<?php echo $quote_data['Quotation']['id']; ?>">
                            <b><?php if (!is_null($quote_data['Quotation']['quote_number'])) echo $quote_data['Quotation']['quote_number']; ?> </b>
                        </div>
                    </h3>
                    <?php //if (AuthComponent::user('role') == 'sales_executive') { ?>

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-control">  
                                    <button class="btn btn-default" data-target="#qInfo-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                                </div>
                                <h3 class="panel-title"> Quote information</h3>
                            </div>
                            <div id="qInfo-panel-collapse" class="collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6"> 
                                            <label class="control-label"><b>Status: </b></label>  
                                            <?php echo ucwords($quote_data['Quotation']['status']); ?>   
                                        </div> 
                                        <div class="col-sm-6"> 
                                            <label class="control-label"><b>Job Request:</b> </label> 
                                            <?php
                                            if ($quote_data['Quotation']['job_request_id'] != 0) {
                                                echo $quote_data['JobRequest']['jr_number'];
                                            } else {
                                                echo ' None ';
                                            }
                                            ?> 
                                        </div> 
                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-6"> 
                                            <label class="control-label"><b>Type: </b></label>  
                                            <?php echo ucwords($quote_data['Quotation']['type']); ?>   
                                        </div>
                                        <div class="col-sm-6"> 
                                            <label class="control-label"><b>Date Created: </b></label>  
                                            <?php echo time_elapsed_string($quote_data['Quotation']['created']) . '<small>[' . date('h:i a', strtotime($quote_data['Quotation']['created'])) . ']</small>'; ?>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-6"> 
                                            <label class="control-label"><b>Subject: </b></label>
                                            <?php echo $quote_data['Quotation']['subject']; ?> 

                                        </div>
                                        <div class="col-sm-6"> 
                                            <label class=" control-label"><b>Validity Date: </b></label> 
                                            <?php echo date('F d, Y', strtotime($quote_data['Quotation']['validity_date'])); ?> 

                                        </div>
                                    </div>
                                    <?php if (AuthComponent::user('role') != 'sales_executive') { ?>
                                        <div class="row">
                                            <div class="col-sm-6"> 
                                                <label class="control-label"><b>Created By: </b></label>
                                                <?php echo $quote_data['User']['first_name'] . '  ' . $quote_data['User']['last_name']; ?>
                                            </div> 
                                            <div class="col-sm-6"> 
                                                <label class="control-label"> Updated Last</label>
                                                <?php echo time_elapsed_string($quote_data['Quotation']['modified']) . '<small>[' . date('h:i a', strtotime($quote_data['Quotation']['modified'])) . ']</small>'; ?>
                                            </div> 
                                        </div>
                                    <?php } ?>
                                    <?php if ($userRole == 'sales_executive' || $userRole == 'proprietor' || $userRole == 'collection_officer'  || $userRole == 'accounting_head' || $userRole == 'sales_manager') { ?>
                                     <div class="row">
                                            <div class="col-sm-6">
                                            <label class="control-label"><b>Team:</b></label>
                                             <?php echo ucwords($quote_data['Team']['display_name']); ?>
                                            </div>
                                        <?php if(!is_null($quote_data['Quotation']['vat_type'])){ ?>
                                            <div class="col-sm-6">
                                            <label class="control-label"><b>Vat Type:</b></label>
                                             <?php echo $quote_data['Quotation']['vat_type']; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if(!is_null($quote_data['QuotationTerm']['name'])){ ?>
                                            <div class="col-sm-12">
                                            <label class="control-label"><b>Payment Term:</b></label>
                                             <?php echo $quote_data['QuotationTerm']['name']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    
                                    
                                    <div class="row">
                                        <div class="col-sm-12"  > <br/><b>Client </b> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12"> 
                                            <label class="control-label"><b>Contact Person: </b> </label>
                                            <?php echo $quote_data['Client']['contact_person']; ?>
                                        </div> 
                                        <div class="col-sm-6">
                                            <label class="control-label"><b>Contact Number: </b> </label>
                                            <?php echo $quote_data['Client']['contact_number']; ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label"><b>Email Address:  </b> </label>
                                            <?php echo $quote_data['Client']['email']; ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php //} ?>



                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" data-target="#billing-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                            </div>
                            <h3 class="panel-title"> Delivery / Billing Info </h3>
                        </div>
                        <div id="billing-panel-collapse" class="collapse in">
                            <div class="panel-body"> 
                                <div class="col-sm-6">
                                    <label><b>Delivery Mode: </b></label> 
                                    <?php echo ucwords($quote_data['Quotation']['delivery_mode']); ?> 
                                </div>
                                <div class="col-sm-6">
                                    <div id="delivery_date_div_value">
                                        <?php if($quote_data['Quotation']['delivery_mode']!= 'pickup'){ ?>
                                        <label><b>Tentative Delivery or Pickup Date: </b></label>
                                        <?php echo date('F d, Y', strtotime($quote_data['Quotation']['target_delivery'])); 
                                        }?>                                     
                                    </div>
                                </div> 
                                <?php if ($quote_data['Quotation']['delivery_mode'] != 'pickup') { ?>
                                    <div id="addresses"> 
                                        <div id="bill_ship_div"> 
                                            <?php if ($quote_data['Quotation']['bill_ship_address'] == 1) { ?> 
                                                <div class="col-sm-6">
                                                    <b>Billing and Shipping Address</b>   <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['bill_latitude'] . ',' . $quote_data['Quotation']['bill_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                                </div>
                                                <div class="col-sm-6">  
                                                    <div id="bill_ship_div_data"> 
                                                        <?php
                                                        if ((!is_null($quote_data['Quotation']['bill_address'])) && $quote_data['Quotation']['bill_address'] != "") {
                                                            echo $quote_data['Quotation']['bill_address'] . ', ' . $quote_data['Quotation']['bill_geolocation'];
                                                        } else {
                                                            echo $quote_data['Quotation']['bill_geolocation'];
                                                        }
                                                        ?>
                                                    </div> 
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-sm-12">
                                                    <br/>
                                                    <div class="col-sm-6">
                                                        <div id="bill_address">
                                                            <label><b>Billing Address</b></label>
                                                            <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['bill_latitude'] . ',' . $quote_data['Quotation']['bill_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                                        </div>
                                                        <div id="bill_div_data"> 
                                                            <?php
                                                            if ((!is_null($quote_data['Quotation']['bill_address'])) && $quote_data['Quotation']['bill_address'] != "") {
                                                                echo $quote_data['Quotation']['bill_address'] . ', ' . $quote_data['Quotation']['bill_geolocation'];
                                                            } else {
                                                                echo $quote_data['Quotation']['bill_geolocation'];
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div id="ship_address">
                                                            <label><b>Shipping Address</b></label> 
                                                            <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['ship_latitude'] . ',' . $quote_data['Quotation']['ship_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                                        </div>
                                                        <div id="ship_div_data">
                                                            <?php
                                                            if ((!is_null($quote_data['Quotation']['ship_address'])) && $quote_data['Quotation']['ship_address'] != "") {
                                                                echo $quote_data['Quotation']['ship_address'] . ', ' . $quote_data['Quotation']['ship_geolocation'];
                                                            } else {
                                                                echo $quote_data['Quotation']['ship_geolocation'];
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?> 
                                            <input type="hidden" id="shipping_address" value="<?php echo  $quote_data['Quotation']['ship_address'].', '.$quote_data['Quotation']['ship_geolocation'];  ?>">
                                            <input type="hidden" id="g_maps" value="<?php echo $quote_data['Quotation']['ship_latitude'].'_'.$quote_data['Quotation']['ship_longitude']; ?>">
                                            
                                        </div>
                                    </div>
                                <?php }
                                if(!empty($DelScheds)){
                                ?>
                                
                                <!--//delivery schedules where status==delivered-->
                                <div class="col-sm-12">
                                    <hr style="border-top: dotted 1px;" />
                                    <b>Delivery Schedules</b> 
                                    <table class="table table-striped">
                                    <?php 
                                    foreach($DelScheds as $DelSched){
                                        echo '<tr>';
                                        echo '<td>'.$DelSched['DeliverySchedule']['dr_number'].'</td>';
                                        echo '<td>'.date('F d, Y', strtotime($DelSched['DeliverySchedule']['delivery_date'])).' <small> ['.date('h:i a', strtotime($DelSched['DeliverySchedule']['delivery_time'])).'] </small></td>';
                                        echo '<td>';
                                        if($DelSched['DeliverySchedule']['status'] == 'ongoing') echo 'Pending';  else echo ucwords($DelSched['DeliverySchedule']['status']);
                                   
                                        echo '</td>';
                                        echo '<td>';
//                                         if (AuthComponent::user('role') == 'sales_executive') {
                                             echo '<button class="btn btn-dark btn-xs update_delivery_note" data-delscid="'.$DelSched['DeliverySchedule']['id'].'" data-delscnotes="'.$DelSched['DeliverySchedule']['agent_note'].'" data-delscstats="'.$DelSched['DeliverySchedule']['status'].'"><i class="fa fa-book"></i></button>';
//                                         }else{
//                                             echo '<button class="btn btn-dark btn-xs update_delivery_note" data-delscid="'.$DelSched['DeliverySchedule']['id'].'" data-delscnote="'.$DelSched['DeliverySchedule']['agent_note'].'"><i class="fa fa-book"></i></button>';
//                                         } 
                                        //if hindi agent lalabas lang to kapag my note
                                        //pero kapag agent lagi andto to
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                        </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">

                    <h3 class="page-header text-overflow">
                        <?php if ($userRole == 'sales_executive') { ?>
                            <button class="btn btn-primary btn-icon add-tooltip print_quote" data-toggle="tooltip"  data-original-title="Print Quotation?" data-printquoteid="<?php echo $quote_data['Quotation']['id']; ?>"><i class="fa fa-print"></i> </button>
                            <?php
                        }
                        if ($quote_data['Quotation']['status'] == 'pending') {
                            if (AuthComponent::user('role') == 'sales_executive') {
                                ?>
                                <button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" id="update_quote" data-upquoteid="<?php echo $quote_data['Quotation']['id']; ?>"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-warning btn-icon add-tooltip move_to_purchasing_btn" data-toggle="tooltip"  data-original-title="Move to Purchasing" id="move_to_purchasing" data-moveid="<?php echo $quote_data['Quotation']['id']; ?>">Move to Purchasing</button>
                                <!--<button class="btn btn-dark btn-icon add-tooltip advance_invoice_btn" data-toggle="tooltip"  data-original-title="Advance Invoice" id="advance_invoice_btn" data-advnceid="<?php echo $quote_data['Quotation']['id']; ?>">Advance Invoice</button>-->
                                <?php
                            }
                        } 
                        // else if ($quote_data['Quotation']['status'] == 'approved') {
                            if (AuthComponent::user('role') == 'sales_manager') {
                                ?>
                                <button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" id="update_quote" data-upquoteid="<?php echo $quote_data['Quotation']['id']; ?>"><i class="fa fa-edit"></i></button>
                                <?php
                            }
                        // }
                        ?>
                    </h3> 

                    <?php if ($userRole == 'sales_executive' || $userRole == 'proprietor' || $userRole == 'collection_officer'  || $userRole == 'accounting_head' || $userRole == 'sales_manager') { ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-control">
                                    <button class="btn btn-default" data-target="#payment-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                                </div>
                                <h3 class="panel-title"> Collection Details </h3>
                            </div>
                            <div id="payment-panel-collapse" class="collapse in">
                                <div class="panel-body">
                                    <div class="col-sm-6" align="right">
                                    <?php
                                    echo '<b>Total Contract Price: </b> <br/>&#8369; ' . number_format($quote_data['Quotation']['grand_total'], 2);
                                    $total_collection = 0;
                                    if ($quote_data['Quotation']['status'] != 'pending') {

                                        foreach ($collections as $collection) {
                                            
                                                if ($collection['Collection']['status'] == 'verified') {
                                            $payment = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'] + $collection['Collection']['other_amount'];
                                            $total_collection = $total_collection + $payment;
                                                }
                                        }
                                        if ($total_collection != 0) {
                                            echo '<br/><br/><span class="text-success"><b>Total Amount Paid: </b> <br/>&#8369; ' . number_format($total_collection, 2).'</span>';
                                        }

                                        $balance = $quote_data['Quotation']['grand_total'] - $total_collection;
                                        if($balance>=1){ 
                                            echo '<br/><br/><span class="text-danger"><b>Balance: </b> <br/>&#8369; ' . number_format($balance, 2).'</span>';
                                        }else{
                                             
                                        } 
                                    }

                                    if ($total_collection != $quote_data['Quotation']['grand_total']) {
                                        if (AuthComponent::user('role') == 'sales_executive') {
                                            echo '<br/><br/>';
                                            if ($quote_data['Quotation']['status'] == 'pending') {
                                                ?>
                                                <button class="btn btn-sm btn-info btn-icon add-tooltip move_schedule_collection" data-toggle="tooltip"  data-original-title="Schedule Collection" id="move_schedule_collection" data-collectquoteid="<?php echo $quote_data['Quotation']['id']; ?>">Schedule Collection</button>
                                                <?php
                                            } else {
                                                //check if with for collection schedule
                                                if(empty($CollectSched)){
                                                ?>
                                                <button class="btn btn-sm btn-info btn-icon add-tooltip schedule_collection" data-toggle="tooltip"  data-original-title="Schedule Collection" id="schedule_collection" data-schedquoteid="<?php echo $quote_data['Quotation']['id']; ?>">Schedule Collection</button>

                                                <?php
                                                }
                                            }
                                        }
                                        
                                        
                                        
                                    }
                                    
                                    
                                    ?>
                

                                    </div>    
                                    
                                    <div class="col-sm-6">
                                        <?php if(!is_null($CollectPapers)){ 
                                            echo '<b>Documents:</b>  ';
                                            
                                            foreach($CollectPapers as $CollectPaper){
                                                echo '<li>'.$CollectPaper['AccountingPaper']['name'].'     '.$CollectPaper['CollectionPaper']['ref_number'].'</li>';
                                            }
                                        }else{
                                            echo 'No Documents Issued or Received.';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-12">
                                    <?php  
                                    
                                    
                                    
                                            // ISSUE SOA BUTTON
                                            
                                    if ($total_collection != $quote_data['Quotation']['grand_total']) {
                                            if($UserIn['User']['department_id'] == 10) {
                                                
                                                ?><br/>
        		                                <button class="btn btn-xs btn-mint btn_issue_soa"
        		                                        data-toggle="tooltip"
        		                                        data-placement="top"
        												data-title="Issue SOA"
        												value="<?php echo $quote_data['Quotation']['id']; ?>">
        		                                    <span class="fa fa-plus"></span> Issue SOA
        		                                </button>
        		                                <?php
    		                            	}
    		                            	}
    		                            	
                                         if(!empty($CollectSched)){
                                                    echo '<hr style="border-top: dotted 1px;" />For collection on '.date('F d, Y', strtotime($CollectSched['CollectionSchedule']['collection_date'])) . '<small> [' . date('h:i a', strtotime($CollectSched['CollectionSchedule']['collection_date'])) . ']</small>';
                                                }
                                    ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo '<br/><br/>';
                    }
                    ?>

                </div>

                <div class="col-sm-5"> 
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" data-target="#delivery-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                            </div>
                            <h3 class="panel-title"> Required Documents 
                                <?php if (AuthComponent::user('role') == 'sales_executive') { ?>
                                    <button class="btn btn-primary btn-xs" id="addRequirement"><i class="fa fa-plus"></i></button>
                                <?php } ?> </h3>

                        </div>
                        <div id="delivery-panel-collapse" class="collapse in">
                            <div class="panel-body">
                                <?php
//                                pr($delivery_papers);
                                foreach($delivery_papers as $delivery_paper){ 
                                    if($delivery_paper['DeliveryPaper']['date_acquired']!= NULL){
                                        $del1 = '<del>';
                                        $del2 = '</del>';
                                    }else{
                                        $del1 = '';
                                        $del2 = '';
                                    }
                                    ?>
<!--                                    echo date('F d, Y', strtotime($list['CollectionSchedule']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($list['CollectionSchedule']['created'])) . '</small>';-->
                                    <div class="col-sm-6"><?php echo $del1.''.$delivery_paper['DrPaper']['name']; ?><small> [<?php echo date('M. d, Y', strtotime($delivery_paper['DeliveryPaper']['date_needed'])); ?>]</small><?php echo $del2; ?></div>
                                <?php } ?>
<!--                                <div class="col-sm-6">asdasd<small>[date]</small></div>
                                <div class="col-sm-6">asdasd<small>[date]</small></div>
                                <div class="col-sm-6">asdasd<small>[date]</small></div>
                                <div class="col-sm-6">asdasd<small>[date]</small></div>-->
                            </div>
                        </div>
                    </div>

                </div> 

                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" data-target="#products-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                            </div>
                            <h3 class="panel-title"> Products Info </h3>
                        </div>
                        <div id="products-panel-collapse" class="collapse in">
                            <div class="panel-body">
                                <?php if (count($quote_products) != 0) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped"> 
                                            <td align="center">#</td>
                                            <td align="center">Product Code</td>
                                            <td align="center">Description</td>
                                            <td align="center">Qty</td> 

                                            <?php if ($userRole == 'sales_executive') { ?>
                                                <td align="right">List Price</td> 
                                                <td align="right">Total</td> 
                                            <?php } ?>
                                            <td align="right">Job Request</td> 
                                            <td align="center">
                                                <!-- MARK: OFFLINE MODIFICATION -->
                                                <input type="checkbox" id='input_select_disselect'
                                                       title="Select All" />
                                                <button id="btn_deliver_cb"
                                                        class="btn btn-xs btn-success"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Deliver Checked Products">
                                                    <span class="fa fa-truck"></span>
                                                </button>
                                                Delivery
                                            </td>
                                            <tbody>
                                                <?php
                                                $cnt = 1;
                                                foreach ($quote_products as $quote_prod) {
                                                    if (is_null($quote_prod['QuotationProduct']['deleted'])) {
                                                        ?> 
                                                        <tr>
                                                            <td ><?php echo $cnt; ?></td>
                                                            <td ><?php echo $quote_prod['Product']['name']; ?></td>
                                                            <td >
                                                                <ul class="list-group">
                                                                    <li class="list-group-item">Type:<?php echo $quote_prod['QuotationProduct']['type']; ?></li>
                                                                    <?php
                                                                    foreach ($quote_prod['QuotationProductProperty'] as $desc) {
                                                                        if (is_null($desc['property'])) {
                                                                            echo '<li class="list-group-item"><b>' . $desc['ProductProperty']['name'] . '</b> : ' . $desc['ProductValue']['value'] . '</li>';
                                                                        } else {
                                                                            echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php echo '<li class="list-group-item"><b>Other Info : <br/></b>' . $quote_prod['QuotationProduct']['other_info'] . '</li>'; ?>

                                                                </ul>
                                                            </td>
                                                            <td ><?php echo abs($quote_prod['QuotationProduct']['qty']); ?></td> 

                                                            <?php if ($userRole == 'sales_executive') { ?>
                                                                <td  align="right">&#8369; <?php echo number_format($quote_prod['QuotationProduct']['edited_amount'], 2); ?></td> 
                                                                <td align="right">&#8369; <?php echo number_format($quote_prod['QuotationProduct']['total'], 2); ?></td>
                                                            <?php } ?>
                                                            <td class="td_row">
                                                                <?php
                                                                if($quote_prod['QuotationProduct']['demo']!=0) {
                                                                    if (count($quote_prod['Quotation']['JobRequest']) != 0) {
                                                                        foreach ($quote_prod['Quotation']['JobRequest']['JrProduct'] as $jrprod) {
                                                                            if ($jrprod['quotation_product_id'] == $quote_prod['QuotationProduct']['id']) {
                                                                                echo '<button class=" btn btn-mint  btn-icon  add-tooltip" data-toggle="tooltip"  data-original-title="With Job Request"  type="button" ><i class="fa fa-check"></i></button>';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                }
                                                                else if ($quote_prod['QuotationProduct']['demo']==0) {
                                                                    $name_tmp = $quote_prod['Product']['name'];
                                                                    $id_tmp = $quote_prod['Product']['id'];
                                                                    $client_id = $quote_data['Client']['id'];
                                                                    $quotationproduct_id = $quote_prod['QuotationProduct']['id'];
                                                                    
                                    				                $today=date("myd");
                                    				                $service_code="JECDEMO-".$today;
                                    				                ?>
                                                                    <input type="hidden" id="service_code" value="<?php echo $service_code; ?>" />
                                                                    <input type="hidden" id="client_id" value="<?php echo $client_id; ?>" />
                                                                    <?php if (AuthComponent::user('role') == 'sales_executive') { ?>
                                                                    <a ng-href=""
                                                                        data-target="#add-demo-modal"
                                                                        data-toggle="modal"
                                                                        class="btn btn-info"
                                                                        style="color:white;font-weight:bold;"
                                                                        data-id="<?php echo $id_tmp; ?>"
                                                                        data-qpid="<?php echo $quotationproduct_id; ?>"
                                                                        data-name="<?php echo $name_tmp; ?>">
                                                                        <span class="fa fa-plus"></span>
                                                                        Demo Product
                                                                    </a>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </td > 
                                                            <td align="center" id="check">
                                                                <?php
                                                                    if ($quote_prod['Quotation']['status'] == 'approved' || $quote_prod['Quotation']['status'] == 'processed') {
                                                                        if ($quote_prod['QuotationProduct']['qty'] == $quote_prod['QuotationProduct']['delivered_qty']) {
                                                                            echo abs($quote_prod['QuotationProduct']['delivered_qty']) . ' / ' . abs($quote_prod['QuotationProduct']['qty']);
                                                                        } else {
                                                                            if ($quote_prod['QuotationProduct']['dr_requested'] == 0) {
                                                                                if ($userRole == 'sales_executive') {
                                                                                    ?>
                                                                                    <!-- <button class=" btn btn-mint  btn-icon  add-tooltip delivery_sched" data-toggle="tooltip"  data-original-title="Schedule Delivery"  data-dspquoteid="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-dspquoteqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>"  data-myprodid="<?php echo $quote_prod['QuotationProduct']['product_id']; ?>"><i class="fa fa-calendar"></i></button> -->

                                                                                    <input type="checkbox"
                                                                                           class="CB_delivery_schedule"
                                                                                           data-dspquoteid="<?php echo $quote_prod['QuotationProduct']['id']; ?>"
                                                                                           data-dspquoteqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>" 
                                                                                           data-myprodid="<?php echo $quote_prod['QuotationProduct']['product_id']; ?>"
                                                                                           data-pname="<?php echo $quote_prod['Product']['name']; ?>" />
                                                                                    <!-- MARK: END OF OFFLINE MODIFICATION -->
                                                                                    <?php
                                                                                }
                                                                            } else {
                                                                                echo '<small>Requested</small>';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr> 


                                                        <?php
                                                    } else {
                                                        echo '<tr><td>' . $cnt . '</td>'
                                                        . '<td >' . $quote_prod['Product']['name'] . '</td>'
                                                        . '<td colspan="5" class="text-danger"><b>Date Deleted: </b> '
                                                        . time_elapsed_string($quote_prod['QuotationProduct']['deleted']) . '</td>'
                                                        . '</tr>';
                                                    }
                                                    $cnt++;
                                                }
                                                ?>

                                                <?php
                                                if ($userRole == 'sales_executive') {
                                                    if ($quote_data['Quotation']['installation_charge'] != 0 && $quote_data['Quotation']['delivery_charge'] != 0 && $quote_data['Quotation']['discount'] != 0) {
                                                        echo '<tr>
                                                                <td colspan="4"></td>
                                        <td><b>Sub Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                        <td align="right">
                                           &#8369;  ' . number_format($quote_data['Quotation']['sub_total'], 2) . '
                                        </td>
                                    </tr>';
                                                    }
                                                    if ($quote_data['Quotation']['installation_charge'] != 0) {
                                                        echo ' <tr>
                                                                <td colspan="4"></td>
                                        <td><b>Installation : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td align="right">&#8369; ' . number_format($quote_data['Quotation']['installation_charge'], 2) . '
                                        </td>
                                    </tr>';
                                                    }
                                                    if ($quote_data['Quotation']['delivery_charge'] != 0) {
                                                        echo ' <tr>
                                                                <td colspan="4"></td>
                                        <td><b>Delivery : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td align="right">&#8369; ' . number_format($quote_data['Quotation']['delivery_charge'], 2) . '
                                        </td>
                                    </tr>';
                                                    }
                                                    if ($quote_data['Quotation']['discount'] != 0) {
                                                        echo ' <tr>
                                                                <td colspan="4"></td>
                                        <td><b>Discount : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td align="right">&#8369; ' . number_format($quote_data['Quotation']['discount'], 2) . '
                                        </td>
                                    </tr>';
                                                    }
                                                    ?> 
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td align=""><b>Grand Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                                        <td align="right">
                                                            <?php echo '&#8369; ' . number_format($quote_data['Quotation']['grand_total'], 2); ?>
                                                        </td> 
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->  
        </div> 
    </div> 
</div>  




<!--Schedule Delivery Modal Start-->
<!--===================================================-->
<div class="modal fade" id="sched-del-modal" role="dialog" tabindex="-1"
     aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <i class="pci-cross pci-circle"></i>
              </button>
              <h4 class="modal-title">
                  Schedule Delivery 
              </h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" id="labelSupplier">Delivery Date</label>
                        <input type="text" readonly=""  id="delivery_date" class="form-control delivery_date" value="<?php echo $quote_data['Quotation']['target_delivery']; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" id="labelSupplier">Delivery Time</label>
                        <input type="time" id="delivery_time" class="form-control delivery_time">
                    </div>
                </div>
                <div id="del_sched_target">
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default"
                type="button">Close</button>
              <button class="btn btn-primary" id="saveDeliverySched">Submit</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Schedule Delivery Modal End-->

<div class="modal fade" id="add-requirement-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Select Required Documents</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Document</label> 
                            <select class="form-control" id="dr_paper_id">
                                <option></option>
                                <?php
                                foreach ($drpapers as $drpaper) {
                                    echo '<option value="' . $drpaper['DrPaper']['id'] . '">' . $drpaper['DrPaper']['name'] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Date Needed</label> 
                            <input type="text" readonly=""  id="date_needed" class="form-control" >
                        </div>
                    </div>   
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveDrPaper">Add</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="update_delivery_note_modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Delivery Note</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                <p class="text-danger">Delivery Note could not be edited if schedule was approved by the delivery personnel.</p>
                    <input type="hidden" id="delschedlID"/>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" id="labelDeliveryNote"></label> 
                            <textarea id="agent_note" class="form-control" ></textarea>
                        </div>
                    </div>   
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <?php if (AuthComponent::user('role') == 'sales_executive') { ?>
                <button class="btn btn-primary" id="saveDrNote">Add</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!--Add New Demo Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-demo-modal" role="dialog" tabindex="-1"
     aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Add Demo 
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label id="product_name" style="font-weight:bold;"></label>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                            placeholder="Quantity" id="qty" />
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" id="select_product_combo">
                                <option>Select Product Combination</option>
                                <option style="font-size: 0.5pt; background-color: grey;"
    					    			disabled >&nbsp</option>
                            </select>
                        </div>
                    </div>
                    <br/>
				    <div class="form-group row">
				        <div class="col-lg-6">
				            <label>Expected Delivery Date <span class="text-danger"> *</span></label>
		                    <input type="date" class="form-control"
        				        id="expected_delivery_date"/>
				        </div>
				        <div class="col-lg-6">
				            <label>Expected Delivery Time <span class="text-danger"> *</span></label>
				             <input type="time" class="form-control"
        				        id="expected_delivery_time" />
				        </div>
				    </div>
				    <br/>
				    <div class="form-group row">
				        <div class="col-lg-6">
				            <label>Expected Pull Out Date <span class="text-danger"> *</span></label>
				             <input type="date" class="form-control"
        				        id="expected_pull_out_date"/>
				        </div>
				        <div class="col-lg-6">
				            <label>Expected Pull Out Time <span class="text-danger"> *</span></label>
				             <input type="time" class="form-control"
        				        id="expected_pull_out_time"/>
				        </div>
				    </div>
				    <br/>
                    <div class="form-group row" id="label_here"></div>
                </div>
			</div>
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_add">Add</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Add New Demo Modal End-->

<script>
    tinymce.init({
        selector: 'textarea',
        height: 500, 
        menubar: false,
        plugins: [
            'autolink',
            'link',
            'codesample',
            'lists',
            'searchreplace visualblocks',
            'table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link',
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        // ===================================================> jQuery for Add Demo
        AllAddDemoMethod();
        
        var qty;
        var product;
        var product_combo;
        var expected__delivery_date;
        var expected_pull_out_date;
        var expected__delivery_time;
        var expected_pull_out_time;
        var id_quotation;
        var qpid;
        var type = "Demo";
        var status = "newest";
        var service_code = $("#service_code").val();
        var client = $("#client_id").val();
        var prop_tmp = [];
        var value_tmp = [];
        
        $('[data-toggle="tooltip"]').tooltip();
        
        $('#add-demo-modal').on('shown.bs.modal', function (event) {
            $(":input").val('');
            $("select").change();
            var button = $(event.relatedTarget);
    
            id_quotation = button.data('id');
            qpid = button.data('qpid');
            var name = button.data('name');
    
            var modal = $(this);
            modal.find("#product_name").text(name);
            
            prop_tmp = [];
            value_tmp = [];
            $("#label_here").empty();
            $.get('/client_services/get_prod_combo', {id: id_quotation}, function(data) {
                if(data.length!=0) {
                    $("#select_product_combo").empty().append($('<option>',
                                        {text: "Select Product Combination"}));
                    for(i=0;i<data.length;i++) {
                        $("#select_product_combo").removeAttr('readonly').
                            append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['ProductCombo']['id']
                            }));
                    }
                }
                else {
                    $("#select_product_combo").empty().attr('readonly',true)
                    .append($('<option>', {text: "No Product Combination"}));
                }
            });
        });
        
        function AllAddDemoMethod() {
            $("#select_product_combo").change(function() {
                var id = $(this).val();
                
                prop_tmp = [];
                value_tmp = [];
                $("#label_here").empty();
                $.get('/client_services/get_prod_combo_prop', {id: id}, function(data) {
                    for(i=0;i<data.length;i++) {
                        prop_tmp.push(data[i]['ProductComboProperty']['property']);
                        value_tmp.push(data[i]['ProductComboProperty']['value']);
                        $("#label_here").append('<div class="col-lg-6">'+
    				    '<label class="label_property" id="label_property">'+data[i]['ProductComboProperty']['property']+'</label>'+
                        '</div>'+
                        '<div class="col-lg-6">'+
    				    '<label class="label_value" id="label_value">'+data[i]['ProductComboProperty']['value']+'</label>'+
                        '</div>');
                    }
                });
            });
            
            $("#btn_add").on('click', function(){
                qty = $("#qty").val();
                product = $("#select_product").val();
                product_combo = $("#select_product_combo").val();
                expected_delivery_date = $("#expected_delivery_date").val();
                expected_pull_out_date = $("#expected_pull_out_date").val();
                expected_delivery_time = $("#expected_delivery_time").val();
                expected_pull_out_time = $("#expected_pull_out_time").val();
        
                if(qty!="" && parseInt(qty)) {
                    if(product_combo!="Select Product Combination") {
                        if(product_combo!="No Product Combination") {
                            if(expected_delivery_date!="") {
                                if(expected_pull_out_date!="") {
                                    var data = {
                                        'client_id':client,
                                        'qty':qty,
                                        'product_id':id_quotation,
                                        'product_combo_id':product_combo,
                                        'expected_delivery_date':expected_delivery_date,
                                        'expected_pull_out_date':expected_pull_out_date,
                                        'expected_delivery_time':expected_delivery_time,
                                        'expected_pull_out_time':expected_pull_out_time,
                                        'service_code':service_code,
                                        'type':type,
                                        'status':status,
                                        'property':prop_tmp,
                                        'value':value_tmp,
                                        'quotation_product_id':qpid
                                    };
                                    $.ajax({
            							url: "/client_services/add_demo_or_su",
            							type: 'Post',
            							data: {'data': data},
            							dataType: 'text',
            							success: function(id) {
            								console.log(id);
            								location.reload();
            							},
            							error: function(err) {
            								console.log("AJAX error in add_demo_or_su: " + JSON.stringify(err, null, 2));
            								console.log("error in ajax add_demo_or_su");
            							}
            						});
                                    console.log(data);
                                }
                                else {
                                    $("#expected_pull_out_date").css({'border-color':'red'});
                                }
                            }
                            else {
                                $("#expected_delivery_date").css({'border-color':'red'});
                            }
                        }
                        else {
                            $("#select_product_combo").css({'border-color':'red'});
                        }
                    }
                    else {
                        $("#select_product_combo").css({'border-color':'red'});
                    }
                }
                else {
                    $("#qty").css({'border-color':'red'});
                }
            });
        }
        // ===================================================> End of Add Demo
        
        var date = new Date();
        date.setDate(date.getDate() - 1);
        $('#delivery_date')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });

        $('#date_needed')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });

        // MAE: I had to uncomment, causing errors
        // $('#delivery_time').timepicker();
        
        $('.print_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("printquoteid");
                window.open("/pdfs/print_quote?id=" + qid, '_blank');
            });
        });
        $('.update_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("upquoteid");
                window.location.replace("/quotations/update_quotation?id=" + qid);
            });
        });
        $('.move_to_purchasing_btn').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("moveid");
                window.location.replace("/quotations/move?id=" + qid);
            });
        });
        $('.move_schedule_collection').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("collectquoteid");
                window.location.replace("/collection_schedules/agent_move?id=" + qid);
            });
        });
        $('.schedule_collection').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("schedquoteid");
                window.location.replace("/collection_schedules/agent?id=" + qid);
            });
        });
    
        $('.delivery_sched').each(function (index) {
            $(this).click(function () {
                var pqid = $(this).data("dspquoteid");
                var pqqty = Math.abs($(this).data("dspquoteqty"));
                var myprodid = $(this).data("myprodid"); 
                $('#delivery-sched-modal').modal('show');
                $('#quotation_product_id').val(pqid);
                $('#requested_qty').val(pqqty);
                $('#myprod_id').val(myprodid);
            });
        });
    
    
    
         // MARK: OFFLINE MODIFICATION
        var check_count = 0;
        $('td#check').find('input[type="checkbox"]').each(function () {
            check_count++;
        });
        if(check_count==0) {
            $("#input_select_disselect").hide();
        }
        else {
            $("#input_select_disselect").show();
        }

        if($("#input_select_disselect").is(":checked") ||
           $("input.CB_delivery_schedule:checked").length>=1) {
            $("#btn_deliver_cb").show();   
        }
        else {
            $("#btn_deliver_cb").hide();
        }
        $("#input_select_disselect").on('click', function() {
            var check_all = $(this);

            // CHECK AND UNCHECK ALL
            if(check_all.is(":checked")) {
                $("#btn_deliver_cb").show();
                $('td').find('input[type="checkbox"]').each(function () {
                    $(this).prop('checked',true);
                });
                check_all.removeAttr('title');
                check_all.attr('title', 'Disselect All');
            }
            else {
               $("#btn_deliver_cb").hide();
                $('td').find('input[type="checkbox"]').each(function () {
                    $(this).prop('checked',false);
                });
                check_all.removeAttr('title');
                check_all.attr('title', 'Select All');
            }
            
            // CHECKED OR UNCHECKED INDIVIDUALLY
            $("td").on('change', function() {
                var count_checked = 0;
                var count_all = 0;
                $("td").find('input[type="checkbox"]').each(function() {
                    if($(this).is(":checked")) {
                        count_checked++;
                    }
                    count_all++;
                });
                
                if(count_checked == count_all) {
                    check_all.prop('checked', true);
                    check_all.removeAttr('title');
                    check_all.attr('title', 'Disselect All');
                }
                else {
                    check_all.prop('checked', false);
                    check_all.removeAttr('title');
                    check_all.attr('title', 'Select All');
                }
            });
        });
        
        // CHECKED ALL INDIVIDUALLY
        $("input.CB_delivery_schedule").on('click', function() {
           var c_checked = $("input.CB_delivery_schedule:checked").length;
           var c_all = $("input.CB_delivery_schedule").length;
           var check_all = $("#input_select_disselect");
       
           if(c_checked>=1) {
                $("#btn_deliver_cb").show();
           }
           else {
                $("#btn_deliver_cb").hide();
           }

           if(c_checked==c_all) {
                check_all.prop('checked', true);
                check_all.removeAttr('title');
                check_all.attr('title', 'Disselect All');
           }
           else {
               check_all.prop('checked', false);
                check_all.removeAttr('title');
                check_all.attr('title', 'Select All');
           }
        });
    
        $('#btn_deliver_cb').on('click', function() {
            var CB = $("td input.CB_delivery_schedule").map(function() {
                var val = $(this).is(":checked");
                if(val==true) {
                    var pqid = $(this).data("dspquoteid");
                    var pqqty = Math.abs($(this).data("dspquoteqty"));
                    var myprodid = $(this).data("myprodid");
                    var pname = $(this).data("pname");
                    var obj = pqid+","+myprodid+","+pqqty+","+pname;
                }
                
                return obj;
            }).get();

            var CB_count = $("input.CB_delivery_schedule:checked").length;

            $("#sched-del-modal #del_sched_target").empty();
            for(var i=0;i<CB_count;i++) {
                var CB_array = CB[i].split(',');
                $("#sched-del-modal #del_sched_target").append(
                '<div class="row">'+
                    '<input type="hidden" class="quotation_product_id quotation_product_id'+i+'" '+
                        'id="quotation_product_id" value="'+CB_array[0]+'"/>'+
                    '<input type="hidden" id="myprod_id" class="myprod_id myprod_id'+i+'" value="'+CB_array[1]+'">'+
                    '<input type="hidden" id="quotation_id" class="quotation_id'+i+'" '+
                        'value="<?php echo $this->params['url']['id']; ?>"/>'+
                    '<label class="col-sm-12" align="center" style="font-weight:bold;">For '+CB_array[3]+'</label>'+
                    '<div class="col-sm-6">'+
                        '<div class="form-group">'+
                            '<label class="control-label" id="labelSupplier">Quantity</label>'+
                            '<input type="number" step="any" id="requested_qty" value="'+CB_array[2]+'" class="form-control requested_qty'+i+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<div class="form-group">'+
                            '<label class="control-label" id="labelSupplier">Delivery Mode</label>'+
                            '<select class="form-control type'+i+'" id="type">'+
                                '<option value="<?php echo $quote_data['Quotation']['delivery_mode']; ?>"><?php echo $quote_data['Quotation']['delivery_mode']; ?></option>'+
                                '<option value="deliver">deliver</option>'+
                                '<option value="pickup">pickup</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                '</div><hr/>');
            }
            $("#sched-del-modal").modal('show');
        });

        $('#saveDeliverySched').click(function () {
            var count = $("input.CB_delivery_schedule:checked").length;
            var delivery_time = $("input.delivery_time").val();
            var delivery_date = $('input.delivery_date').val();
            var requested_qty = new Array();
            var myprod_id = new Array();
            var quotation_product_id = new Array();
            var quotation_id = new Array();
            var type = new Array();
            var deliver_to = $('#deliver_to').val();
            var clnt_id = $('#clnt_id').val(); 
            var shipping_address = $('#shipping_address').val(); 
            var g_maps = $('#g_maps').val(); 
    
            for(var i=0;i<count;i++) {
                requested_qty[i] = $('input.requested_qty'+i).val();
                myprod_id[i] = $("input.myprod_id"+i).val();
                quotation_product_id[i] = $("input.quotation_product_id"+i).val();
                quotation_id[i] = $('input.quotation_id'+i).val();
                type[i] = $('select.type'+i).val();

                if (delivery_date!="") {
                    if (requested_qty[i]!="") {
                        if (delivery_time!="") {
                            if (type[i]!="") {
                                var data = {"delivery_date": delivery_date,
                                    "requested_qty": requested_qty[i],
                                    "product_reference": quotation_product_id[i],
                                    "reference_number": quotation_id[i],
                                    "delivery_time": delivery_time,
                                    "mode":type[i],
                                    "product_id":myprod_id[i],
                                    "reference_type":'quotation',
                                    "deliver_to":deliver_to,
                                    "client_id":clnt_id,
                                    "supplier_id":0,
                                    "shipping_address":shipping_address,
                                    "g_maps": g_maps,
                                    "delivered_qty": 0,
                                    "date_delivered": null
                                }

                                $.ajax({
                                    url: "/delivery_schedules/addSched",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();
                                    },
                                    error: function (dd) {
                                        console.log(dd);
                                    }
                                });
                            } else {
                                $("select.type"+i).css({'border-color':'red'});
                            }
                        } else {
                            $("input.delivery_time").css({'border-color':'red'});
                        }
                    } else {
                        $("input.requested_qty"+i).css({'border-color':'red'});
                    }
                } else {
                    $("input.delivery_date").css({'border-color':'red'});
                }
            }
        });
        // MARK: END OF OFFLINE MODIFICATION
    
    
        $('#addRequirement').click(function () {
            $('#add-requirement-modal').modal('show');
        });
    
        $('#saveDrPaper').click(function () {
    //        alert('saveDrPaper');
            var dr_paper_id = $('#dr_paper_id').val();
            var date_needed = $('#date_needed').val();
            var quotation_id = $('#qteidd').val();
    
    
            if (dr_paper_id != '') {
                if (date_needed != '') {
                    var data = {"dr_paper_id": dr_paper_id,
                        "date_needed": date_needed,
                        "quotation_id": quotation_id
                    }
                    $.ajax({
                        url: "/delivery_papers/addPaper",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        success: function (dd) {
                            location.reload();
                        },
                        error: function (dd) {
                            console.log(dd);
                        }
                    });
                } else {
                    document.getElementById('date_needed').style.borderColor = "red";
                }
            } else {
                document.getElementById('dr_paper_id').style.borderColor = "red";
            }
        });
        
        
        $('.update_delivery_note').each(function (index) {
            $(this).click(function () {
                $('#errorNote').remove();
                var delivery_schedule_id = $(this).data("delscid");
                var anote = $(this).data("delscnotes");
                var status = $(this).data("delscstats");
                
                $('#delschedlID').val(delivery_schedule_id);
    //            $('#agent_note').val(anote); 
                tinyMCE.activeEditor.setContent(anote);
                if(status=='scheduled' || status=='delivered'){ 
                    tinymce.activeEditor.setMode('readonly');
                }else{
                    tinymce.activeEditor.setMode('design'); 
                }
                //kapag scheduled na dapat d na pwede iupdate
                
                $('#update_delivery_note_modal').modal('show');
            });
        });
    
        $('#saveDrNote').click(function () {
                $('#errorNote').remove();
    //        alert('saveDrPaper');
            var delivery_schedule_id = $('#delschedlID').val();
            var agent_note = tinyMCE.activeEditor.getContent();
             
                if (agent_note != '') {
                    var data = {"delivery_schedule_id": delivery_schedule_id,
                        "agent_note": agent_note 
                    }
                    $.ajax({
                        url: "/delivery_schedules/updateDeliveryAgentNote",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        success: function (dd) {
                            location.reload();
                        },
                        error: function (dd) {
                            console.log(dd);
                        }
                    });
                } else {
                    $('#labelDeliveryNote').append('<span id="errorNote" class="text-danger"><small> *delivery note is required </small></span>');
    //                document.getElementById('agent_note').style.borderColor = "red";
                }
            
        });
        
        $("button.btn_issue_soa").on('click', function() {
        	var id = $(this).val();
        	swal({
                    title: "Are you sure?",
                    text: "You will issue SOA for this quotation?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
						$.get('/statement_of_accounts/add', {id: id}, function(data) {
							console.log(data);
							location.reload();
						})
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        });
    });

</script>  