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
                <div class="col-sm-9">
                    <h3 class="page-header text-overflow">
                       
                        <?php echo $quote_data['Client']['name']; ?>
                        <?php if (!empty($quote_data['Client']['tin_number'])) echo '<br/><small>[' . $quote_data['Client']['tin_number'] . ']</small>'; ?>
                        <div class="panel-control">  
                            <input type="hidden" id="quotation_id" value="<?php echo $quote_data['Quotation']['id']; ?>">
                            <b><?php if (!is_null($quote_data['Quotation']['quote_number'])) echo $quote_data['Quotation']['quote_number']; ?> </b>
                        </div>
                    </h3>
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
                            </div>
                        </div>
                    </div>
 
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
                                                <th>#</th>
                                                <th>Product Code</th>
                                                <th>Description</th>
                                                <th>Qty</th> 
                                                <th>List Price</th> 
                                                <th>Total</th> 
                                                <th>Job Request</th>  
                                                <tbody>
                                                    <?php
//                                        pr($quote_products);
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
                                                                <td >&#8369; <?php echo number_format($quote_prod['QuotationProduct']['edited_amount'], 2); ?></td> 
                                                                <td >&#8369; <?php echo number_format($quote_prod['QuotationProduct']['total'], 2); ?></td>
                                                                <td>
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
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="col-sm-5"></div>
                                        <div class="col-sm-5" align="right">
                                            <table>
                                                <?php
                                                if ($quote_data['Quotation']['installation_charge'] != 0 && $quote_data['Quotation']['delivery_charge'] != 0 && $quote_data['Quotation']['discount'] != 0) {
                                                    echo '<tr>
                                        <td><b>Sub Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                        <td align="right">
                                           &#8369;  ' . number_format($quote_data['Quotation']['sub_total'], 2) . '
                                        </td>
                                    </tr>';
                                                }
                                                if ($quote_data['Quotation']['installation_charge'] != 0) {
                                                    echo ' <tr>
                                        <td><b>Installation : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td align="right">&#8369; ' . number_format($quote_data['Quotation']['installation_charge'], 2) . '
                                        </td>
                                    </tr>';
                                                }
                                                if ($quote_data['Quotation']['delivery_charge'] != 0) {
                                                    echo ' <tr>
                                        <td><b>Delivery : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td align="right">&#8369; ' . number_format($quote_data['Quotation']['delivery_charge'], 2) . '
                                        </td>
                                    </tr>';
                                                }
                                                if ($quote_data['Quotation']['discount'] != 0) {
                                                    echo ' <tr>
                                        <td><b>Discount : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td align="right">&#8369; ' . number_format($quote_data['Quotation']['discount'], 2) . '
                                        </td>
                                    </tr>';
                                                }
                                                ?> 
                                                <tr>
                                                    <td><b>Grand Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                                    <td>
                                                        <?php echo '&#8369; ' . number_format($quote_data['Quotation']['grand_total'], 2); ?>
                                                    </td>
                                                </tr>
                                            </table> 
                                        </div>
                                        <div class="col-sm-2"></div>


                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                  



                </div> 
                <div class="col-sm-3">

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
                   
                </div>

                <div class="col-sm-3"> 
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" data-target="#delivery-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                            </div>
                            <h3 class="panel-title"> Delivery Details </h3>
                        </div>
                        <div id="delivery-panel-collapse" class="collapse in">
                            <div class="panel-body">
                                if processed na pwede nya na iupdate delivery schedule
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

 
 
<script type="text/javascript">



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
 
 
 
</script>  