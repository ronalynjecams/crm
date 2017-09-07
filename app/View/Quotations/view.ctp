
<!--<link href="../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<script src="../plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />



<link href="../css/sweetalert.css" rel="stylesheet"> 
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script> 
<script src="../js/erp_js/erp_scripts.js"></script>  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="../js/sweetalert.min.js"></script>  
<script src="../plugins/select2/js/select2.min.js"></script> 


<!--===================================================-->
<div id="content-container" >
    <div id="page-title">
    </div>
    <div id="page-content">   
        <div class="row"> 
            <div class="col-sm-12">
                <div class="col-sm-7">
                    <h3 class="page-header text-overflow">
                        <input type="hidden" id="qteidd" value="<?php echo $this->params['url']['id']; ?>"/>
                 
                        <?php echo $quote_data['Client']['name']; ?>
                        <?php if (!empty($quote_data['Client']['tin_number'])) echo '<br/><small>[' . $quote_data['Client']['tin_number'] . ']</small>'; ?>
                        <div class="panel-control">  
                            <input type="hidden" id="quotation_id" value="<?php echo $quote_data['Quotation']['id']; ?>">
                            <b><?php if (!is_null($quote_data['Quotation']['quote_number'])) echo $quote_data['Quotation']['quote_number']; ?> </b>
                        </div>
                    </h3>
                    <?php if (AuthComponent::user('role') == 'sales_executive') { ?>

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
                                            <?php echo date('F d, Y', strtotime($quote_data['Quotation']['created'])) . '<small>[' . date('h:i a', strtotime($quote_data['Quotation']['created'])) . ']</small>'; ?>
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
                                                <?php echo date('F d, Y', strtotime($quote_data['Quotation']['modified'])) . '<small>[' . date('h:i a', strtotime($quote_data['Quotation']['modified'])) . ']</small>'; ?>
                                            </div> 
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-sm-12"  > <br/><b>Client </b> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4"> 
                                            <label class="control-label"><b>Contact Person: </b> </label>
                                            <?php echo $quote_data['Client']['contact_person']; ?>
                                        </div> 
                                        <div class="col-sm-4">
                                            <label class="control-label"><b>Contact Number: </b> </label>
                                            <?php echo $quote_data['Client']['contact_number']; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="control-label"><b>Email Address:  </b> </label>
                                            <?php echo $quote_data['Client']['email']; ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php } ?>



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
                                        <label><b>Tentative Delivery or Pickup Date: </b></label>
                                        <?php echo date('F d, Y', strtotime($quote_data['Quotation']['target_delivery'])); ?>                                     
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
                                        </div>
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
                                <?php
                            }
                        } else if ($quote_data['Quotation']['status'] == 'approved') {
                            if (AuthComponent::user('role') == 'sales_manager') {
                                ?>
                                <button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" id="update_quote" data-upquoteid="<?php echo $quote_data['Quotation']['id']; ?>"><i class="fa fa-edit"></i></button>
                                <?php
                            }
                        }
                        ?>
                    </h3> 

                    <?php if ($userRole == 'sales_executive') { ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-control">
                                    <button class="btn btn-default" data-target="#payment-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                                </div>
                                <h3 class="panel-title"> Payment Details </h3>
                            </div>
                            <div id="payment-panel-collapse" class="collapse in">
                                <div class="panel-body" align="right">
                                    <?php
                                    echo '<b>Total Contract Price: </b> <br/>&#8369; ' . number_format($quote_data['Quotation']['grand_total'], 2);
                                    $total_collection = 0;
                                    if ($quote_data['Quotation']['status'] != 'pending') {

                                        foreach ($collections as $collection) {
                                            $payment = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'];
                                            $total_collection = $total_collection + $payment;
                                        }
                                        if ($total_collection != 0) {
                                            echo '<br/><br/><b>Total Amount Paid: </b> <br/>&#8369; ' . number_format($total_collection, 2);
                                        }

                                        $balance = $quote_data['Quotation']['grand_total'] - $total_collection;
                                        echo '<br/><br/><b>Balance: </b> <br/>&#8369; ' . number_format($balance, 2);
                                    }

                                    if ($total_collection != $quote_data['Quotation']['grand_total']) {
                                        if (AuthComponent::user('role') == 'sales_executive') {
                                            echo '<br/><br/>';
                                            if ($quote_data['Quotation']['status'] == 'pending') {
                                                ?>
                                                <button class="btn btn-sm btn-info btn-icon add-tooltip move_schedule_collection" data-toggle="tooltip"  data-original-title="Schedule Collection" id="move_schedule_collection" data-collectquoteid="<?php echo $quote_data['Quotation']['id']; ?>">Schedule Collection</button>
                                                <?php
                                            } else {
                                                ?>
                                                <button class="btn btn-sm btn-info btn-icon add-tooltip schedule_collection" data-toggle="tooltip"  data-original-title="Schedule Collection" id="schedule_collection" data-schedquoteid="<?php echo $quote_data['Quotation']['id']; ?>">Schedule Collection</button>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>



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
                                foreach($delivery_papers as $delivery_paper){ ?>
                                    <div class="col-sm-6"><?php// echo $delivery_paper['DrPaper']['name']; ?><small>[<?php //echo $delivery_paper['DeliveryPaper']['date_needed']; ?>]</small></div>
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
                                            <td align="right">Delivery</td>  
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
                                                            <td align="right">
                                                                <?php
                                                                if (count($quote_prod['Quotation']['JobRequest']) != 0) {
                                                                    foreach ($quote_prod['Quotation']['JobRequest']['JrProduct'] as $jrprod) {
                                                                        if ($jrprod['quotation_product_id'] == $quote_prod['QuotationProduct']['id']) {
                                                                            echo '<button class=" btn btn-mint  btn-icon  add-tooltip" data-toggle="tooltip"  data-original-title="With Job Request"  type="button" ><i class="fa fa-check"></i></button>';
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                                ?>
                                                            </td > 
                                                            <td align="right">
                                                                <?php
                                                                if ($quote_prod['Quotation']['status'] == 'approved' || $quote_prod['Quotation']['status'] == 'processed') {
                                                                    if ($quote_prod['QuotationProduct']['qty'] == $quote_prod['QuotationProduct']['delivered_qty']) {
                                                                        echo abs($quote_prod['QuotationProduct']['delivered_qty']) . ' / ' . abs($quote_prod['QuotationProduct']['qty']);
                                                                    } else {
                                                                        if ($quote_prod['QuotationProduct']['dr_requested'] == 0) {
                                                                            if ($userRole == 'sales_executive') {
                                                                                ?>
                                                                                <button class=" btn btn-mint  btn-icon  add-tooltip delivery_sched" data-toggle="tooltip"  data-original-title="Schedule Delivery"  data-dspquoteid="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-dspquoteqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>"><i class="fa fa-calendar"></i></button>
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
                                                        . '<td colspan="5" class="text-danger"><b>Date Deleted: </b> ' . date('F d, Y', strtotime($quote_prod['QuotationProduct']['deleted'])) . ''
                                                        . '<small>[' . date('h:i a', strtotime($quote_prod['QuotationProduct']['deleted'])) . ']</small>' . '</td>'
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
                                                        <td align="right"><b>Grand Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
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




<div class="modal fade" id="delivery-sched-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Schedule Delivery</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="quotation_product_id"/> 
                    <input type="hidden" id="quotation_id" value="<?php echo $this->params['url']['id']; ?>"/>   
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Delivery Date</label> 
                            <input type="text" readonly=""  id="delivery_date" class="form-control" value="<?php echo $quote_data['Quotation']['target_delivery']; ?>">
                        </div>
                    </div> 
                    <div class="col-sm-6">  
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Delivery Time</label> 
                            <input type="time" id="delivery_time" class="form-control">
                        </div>
                        <!--                        <div class="form-group">
                                                    <label class="control-label" id="labelSupplier">Delivery Time</label>  
                                                    <input id="delivery_time" type="time"  class="form-control"> 
                                                </div>-->

                        <!--                        <label>Delivery Time</label>  
                        
                                                <input id="delivery_time" type="time" class="form-control"> -->
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" step="any" id="requested_qty" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Delivery Mode</label> 
                            <select class="form-control" id="type">
                                <option value="<?php echo $quote_data['Quotation']['delivery_mode']; ?>"><?php echo $quote_data['Quotation']['delivery_mode']; ?></option>
                                <option value="deliver">deliver</option>
                                <option value="pickup">pickup</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveDeliverySched">Save</button>
            </div>
        </div>
    </div>
</div>



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

<script type="text/javascript">


    $(document).ready(function () {
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

        $('#delivery_time').timepicker();
    });
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
            $('#delivery-sched-modal').modal('show');
            $('#quotation_product_id').val(pqid);
            $('#requested_qty').val(pqqty);
        });
    });



    $('#saveDeliverySched').click(function () {
        var delivery_date = $('#delivery_date').val();
        var delivery_time = $('#delivery_time').val();
        var requested_qty = $('#requested_qty').val();
        var quotation_product_id = $('#quotation_product_id').val();
        var quotation_id = $('#quotation_id').val();
        var type = $('#type').val();

        if (delivery_date != '') {
            if (requested_qty != '') {
                if (delivery_time != '') {
                    if (type != '') {
                        var data = {"delivery_date": delivery_date,
                            "requested_qty": requested_qty,
                            "quotation_product_id": quotation_product_id,
                            "quotation_id": quotation_id,
                            "delivery_time": delivery_time
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
                        document.getElementById('type').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('delivery_time').style.borderColor = "red";
                }
            } else {
                document.getElementById('requested_qty').style.borderColor = "red";
            }
        } else {
            document.getElementById('delivery_date').style.borderColor = "red";
        }
    });


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



</script>  