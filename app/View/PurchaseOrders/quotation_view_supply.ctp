<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<link href="/css/sweetalert.css" rel="stylesheet"> 
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script> 
<script src="/js/erp_scripts.js"></script>  
<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->  
<script src="/js/sweetalert.min.js"></script>  

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
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
                                <?php
                                if (!empty($DelScheds)) {
                                    ?>

                                    <!--//delivery schedules where status==delivered-->
                                    <div class="col-sm-12">
                                        <hr style="border-top: dotted 1px;" />
                                        <b>Delivery Schedules</b> 
                                        <table class="table table-striped">
                                            <?php
                                            foreach ($DelScheds as $DelSched) {
                                                echo '<tr>';
                                                echo '<td>' . $DelSched['DeliverySchedule']['dr_number'] . '</td>';
                                                echo '<td>' . date('F d, Y', strtotime($DelSched['DeliverySchedule']['delivery_date'])) . ' <small> [' . date('h:i a', strtotime($DelSched['DeliverySchedule']['delivery_time'])) . '] </small></td>';
                                                echo '<td>';
                                                if ($DelSched['DeliverySchedule']['status'] == 'ongoing')
                                                    echo 'Pending';
                                                else
                                                    echo ucwords($DelSched['DeliverySchedule']['status']);

                                                echo '</td>';
                                                echo '<td>';
//                                         if (AuthComponent::user('role') == 'sales_executive') {
                                                echo '<button class="btn btn-dark btn-xs update_delivery_note" data-delscid="' . $DelSched['DeliverySchedule']['id'] . '" data-delscnotes="' . $DelSched['DeliverySchedule']['agent_note'] . '" data-delscstats="' . $DelSched['DeliverySchedule']['status'] . '"><i class="fa fa-book"></i></button>';
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
                                            <th>Processed Qty</th> 
                                            <th>Type</th>
                                            <?php 
                                             if ($UserIn['Department']['name'] == "Purchasing (Supply)" ||
                                                 $UserIn['Department']['name'] == "Purchasing") {
                                                 echo '<th align="right">List Price</td> ';
                                                 echo '<th align="right">Total Price</td> ';
                                             } 
                                             ?>
                                            <th>Action</th>  
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
                                                                            $ppname = '<font class="text-danger">Unknown</font>';
                                                                            if(!empty($desc['ProductProperty'])) {
                                                                                $ppname_tmp = ucwords($desc['ProductProperty']['name']);
                                                                                if($ppname_tmp!="") {
                                                                                    $ppname = $ppname_tmp;
                                                                                }
                                                                            }
                                                                            
                                                                            $pvval = '<font class="text-danger">Not specified</font>';
                                                                            if(!empty($desc['ProductValue'])) {
                                                                                $pvval_tmp = $desc['ProductValue']['value'];
                                                                                if($pvval_tmp != "") {
                                                                                    $pvval = $pvval_tmp;
                                                                                }
                                                                            }
                                                                            
                                                                            if(!empty($desc['ProductProperty'])) {
                                                                                echo '<li class="list-group-item"><b>' . $ppname . '</b> : ' . $pvval . '</li>';
                                                                            }
                                                                        } else {
                                                                            echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php echo '<li class="list-group-item"><b>Other Info : <br/></b>' . $quote_prod['QuotationProduct']['other_info'] . '</li>'; ?>

                                                                </ul>
                                                            </td>
                                                            <td ><?php echo abs($quote_prod['QuotationProduct']['processed_qty']) . ' / ' . abs($quote_prod['QuotationProduct']['qty']); ?></td> 
                                                            <td > <?php echo $quote_prod['QuotationProduct']['type']; ?></td> 
                                                            <?php
                                                            if ($UserIn['Department']['name'] == "Purchasing (Supply)" ||
                                                                $UserIn['Department']['name'] == "Purchasing") {
                                                            ?>
                                                                <td align="right">&#8369; <?php echo number_format($quote_prod['QuotationProduct']['edited_amount'], 2); ?></td> 
                                                                <td align="right">&#8369; <?php echo number_format($quote_prod['QuotationProduct']['total'], 2); ?></td>
                                                            <?php } ?>
                                                            <td >
                                                                <?php
                                                                if ($quote_prod['QuotationProduct']['processed_qty'] < $quote_prod['QuotationProduct']['qty']) {
                                                                    if ($quote_prod['QuotationProduct']['processed_qty'] != $quote_prod['QuotationProduct']['qty'] || $quote_prod['QuotationProduct']['processed_qty'] != 0) {
                                                                        if (count($poprod) != 0) {
//                                                                        pr($poprod);
                                                                            foreach ($poprod as $poproduct) {
                                                                                if (($poproduct['PoProduct']['quotation_product_id'] == $quote_prod['QuotationProduct']['id']) && $poproduct['PoProduct']['additional'] == 0) {
                                                                                    ?>
                                                                                                                                                                                                                                        <!--<button class=" btn btn-mint  btn-icon  add-tooltip" data-toggle="tooltip"  data-original-title="With Job Request"  type="button" ><i class="fa fa-check"></i></button>-->
                                                                                                                                                                                                                                        <!--<button class="btn btn-sm btn-info update_supplier add-tooltip" data-toggle="tooltip"  data-original-title="<?php echo $poproduct['PurchaseOrder']['Supplier']['code']; ?>" data-poproductid="<?php echo $poproduct['PoProduct']['id']; ?>" data-supplierproductid="<?php echo $quote_prod['QuotationProduct']['id']; ?>"data-poproductqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>">Update Supplier</button>-->


                                                                                    <!--meaning, my mga items na composed of multiple items from supplier pero sa jecams one item lang sya-->
                                                                                   <!--<button class="btn btn-sm btn-primary set_supplier" data-supplierprodid="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-supplierprodqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>">Select Supplier</button>-->
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <!--<button class="btn btn-sm btn-primary set_supplier" data-supplierprodid="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-supplierprodqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>">Select Supplier</button>-->
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } else {
                                                                            ?>
                        <!--<button class="btn btn-sm btn-primary set_supplier" data-supplierprodid="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-supplierprodqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>">Select Supplier</button>-->
                                                                            <?php
                                                                        }
                                                                        ?>
                    <!--<button class="btn btn-sm btn-mint additional_po_product add-tooltip" data-toggle="tooltip"  data-original-title="Purchase Additional Product" data-qprdctid="<?php echo $quote_prod['QuotationProduct']['id']; ?>"  ><i class="fa fa-plus"></i></button>-->
                                                                        <button class="btn btn-sm btn-primary po_product_btn"
                                                                                data-client="<?php echo $quote_prod['Quotation']['client_id']; ?>"
                                                                                data-qtprodid="<?php echo $quote_prod['QuotationProduct']['id']; ?>">Select Supplier</button>

                                                                        <button class="btn btn-sm btn-warning inventory_product_btn add-tooltip" data-toggle="tooltip"  data-original-title="Get Product From Inventory" data-qprdctids="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-qprdctqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>"><i class="fa fa-cubes"></i></button>
                                                                        <?php
                                                                    } else {
                                                                        echo '<span class="text-info">Processed<span>';
                                                                    }
                                                                } else {
                                                                    echo '<span class="text-info">Processed<span>';
                                                                }
                                                                ?>
                                                            </td> 

                                                        </tr> 


                                                        <?php
                                                    } else {
                                                        echo '<tr><td>' . $cnt . '</td>'
                                                        . '<td >' . $quote_prod['Product']['name'] . '</td>'
                                                        . '<td colspan="3" class="text-danger"><b>Date Deleted: </b> '
                                                        . date('h:i a', strtotime($quote_prod['QuotationProduct']['deleted'])) . '</td>'
                                                        . '</tr>';
                                                    }
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> 
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

                        if ($userRole == 'supply_staff' && $userRole != 'supply_head') {
                            echo '<button class="btn btn-mint btn-icon add-tooltip view_product_source_btn" >view product sources</button>';
                            echo ' <br/><br/> ';
                        }
                        ?>
                    </h3>
                    <?php
//                                pr($collection);
                    ?>

                    <?php if ($userRole != 'supply_staff' && $userRole != 'supply_head') { ?>
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
                    <?php } else { ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-control">
                                    <button class="btn btn-default" data-target="#purchasing-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                                </div>
                                <h3 class="panel-title"> Collection Documents </h3>
                            </div>
                            <div id="purchasing-panel-collapse" class="collapse in">
                                <div class="panel-body">
                                     <!--<button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" id="update_quote" data-upquoteid="<?php echo $quote_data['Quotation']['id']; ?>">Move to purchasing</button>-->
                                    <!--this panel should show  if with po soa, dr, transmittal,-->


                                    <div class="col-sm-6">
                                        <?php
                                        if (!is_null($CollectPapers)) {
                                            echo '<b>Documents:</b>  ';

                                            foreach ($CollectPapers as $CollectPaper) {
                                                echo '<li>' . $CollectPaper['AccountingPaper']['name'] . '     ' . $CollectPaper['CollectionPaper']['ref_number'] . '</li>';
                                            }
                                        } else {
                                            echo 'No Documents Issued or Received.';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
                                        if (!empty($CollectSched)) {
                                            echo '<hr style="border-top: dotted 1px;" />For collection on ' . date('F d, Y', strtotime($CollectSched['CollectionSchedule']['collection_date'])) . '<small> [' . date('h:i a', strtotime($CollectSched['CollectionSchedule']['collection_date'])) . ']</small>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <div class="col-sm-3"> 
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" data-target="#delivery-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                            </div>
                            <h3 class="panel-title"> Required Documents </h3>
                        </div>
                        <div id="delivery-panel-collapse" class="collapse in">
                            <div class="panel-body">
                                <!--                                if processed na pwede nya na iupdate delivery schedule-->

                                <?php
//                                pr($delivery_papers);
                                foreach ($delivery_papers as $delivery_paper) {
                                    if ($delivery_paper['DeliveryPaper']['date_acquired'] != NULL) {
                                        $del1 = '<del>';
                                        $del2 = '</del>';
                                    } else {
                                        $del1 = '';
                                        $del2 = '';
                                    }
                                    ?>
                                    <div class="col-sm-6"><?php echo $del1 . '' . $delivery_paper['DrPaper']['name']; ?><small> [<?php echo date('M. d, Y', strtotime($delivery_paper['DeliveryPaper']['date_needed'])); ?>]</small><?php echo $del2; ?></div>
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

<!--CREATE PURCHASE ORDER MODAL START-->
<div class="modal fade" id="purchase-order-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Create PO for Product</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="quote_product_id"/>    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product</label> 
                            <select id="slctd_prdct" class="form-control" style="width: 100%;"> 
                                <option></option>
                                <?php
                                foreach ($products as $product) {
                                    echo '<option value="' . $product['Product']['id'] . '">' . $product['Product']['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Combo</label> 
                            <select id="slctd_prdctcombo" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="slctd_prdct_supplier" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" span="any" id="po_qty" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Price</label> 
                            <input type="number" span="any" id="list_price" class="form-control" value="0">
                            <input type="hidden"  id="supplier_product_id"  >
                        </div>
                    </div>
                    <div class="col-sm-12"id="last_supplier"></div>

                    <div class="col-sm-12">
                        <div id="product_combo_properties_div">
                            <h4 align="center">Product Description</h4>
                            <div class="col-sm-12"> 
                                <div class="col-sm-6" align="center"><b> Property </b></div>
                                <div class="col-sm-6" align="center"><b> Value </b></div>  
                            </div>     
                        </div>
                    </div> 
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveNewSupplierProductBtn">Add</button>
            </div>
        </div>
    </div>
</div> 

<!--CREATE PURCHASE ORDER MODAL END-->

<!--GET FROM INVENTORY MODAL START-->
<div class="modal fade" id="get-from-inventory-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Select Product from Inventory</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="inv_quote_product_id"/>    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Location</label> 
                            <select id="slctd_inv_lcation" class="form-control" style="width: 100%;"> 
                                <option></option>
                                <?php
                                foreach ($locations as $location) {
                                    echo '<option value="' . $location['InvLocation']['id'] . '">' . $location['InvLocation']['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product</label> 
                            <select id="slctd_inv_prdct" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Combo</label> 
                            <select id="slctd_inv_prdctcombo" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" span="any" id="po_inv_qty" class="form-control" value="0">
                        </div>
                    </div>

                    <!--<div class="col-sm-12"id="last_supplier"></div>-->
                    <div class="col-sm-6"id="inv_rqrd_fld"></div>

                    <div class="col-sm-12">
                        <div id="inv_product_combo_qtys_div"> 
                        </div>
                    </div> 

                    <div class="col-sm-12">
                        <div id="inv_product_combo_properties_div">
                            <h4 align="center">Product Description</h4>
                            <div class="col-sm-12"> 
                                <div class="col-sm-6" align="center"><b> Property </b></div>
                                <div class="col-sm-6" align="center"><b> Value </b></div>  
                            </div>     
                        </div>
                    </div> 
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveNewInventoryProductBtn">Add</button>
            </div>
        </div>
    </div>
</div> 

<!--GET FROM INVENTORY MODAL END-->
<script type="text/javascript">

    $(document).ready(function () {
        $("#slctd_inv_prdct").select2({
            placeholder: "Select Inventory Product",
            width: '100%',
            allowClear: false
        });
        
        $("#slctd_inv_prdctcombo").select2({
            placeholder: "Select Product Combo",
            width: '100%',
            allowClear: false
        });
        
        $("#slctd_prdct").select2({
            placeholder: "Select Product Code",
            width: '100%',
            allowClear: false
        });
        $("#slctd_prdctcombo").select2({
            placeholder: "Select Product Combo",
            width: '100%',
            allowClear: false
        });
        $("#slctd_prdct_supplier").select2({
            placeholder: "Select Product Supplier",
            width: '100%',
            allowClear: false
        });
        $("#slctd_inv_lcation").select2({
            placeholder: "Select Location",
            width: '100%',
            allowClear: false
        });
        
        
//        $("#slctd_inv_prdct").select2({
//            placeholder: "Select Product",
//            width: '100%',
//            allowClear: false
//        });
//        $("#slctd_inv_prdctcombo").select2({
//            placeholder: "Select Product Combo",
//            width: '100%',
//            allowClear: false
//        });


        var get_passed_client = 0;
        $('.po_product_btn').each(function (index) {
            $(this).click(function () {
                var qoute_prod_id = $(this).data("qtprodid");
                get_passed_client = $(this).data('client');
                $('#purchase-order-product-modal').modal('show');
                $('#quote_product_id').val(qoute_prod_id);

                    $('#slctd_prdctcombo').empty().append('<option></option>');
                $("#slctd_prdct").change(function () {
                    $('#slctd_prdctcombo').empty().append('<option></option>');
                    $('#slctd_prdct_supplier').empty().append('<option></option>');
                    $('.added_product_combo_properties_div').each(function (index) {
                        $(".added_product_combo_properties_div").remove();
                    });
                    $("#slctd_prdctcombo").select2({
                        placeholder: "Select Product Combo",
                        width: '100%',
                        allowClear: false
                    });
                    var selected_product_id = $("#slctd_prdct").val();
                    ////show product combos of selected product
                    $.get('/supplier_products/get_product_combination', {
                        id: selected_product_id,
                    }, function (data) {
                        for (i = 0; i < data.length; i++) {
                            $('#slctd_prdctcombo').append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                            }));
                        }
                    });

                    ////in here get suppliers for selected profct combo
                    $("#slctd_prdctcombo").change(function () {
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $("#slctd_prdct_supplier").select2({
                            placeholder: "Select Product Supplier",
                            width: '100%',
                            allowClear: false
                        });

                        var selected_product_id = $("#slctd_prdct").val();
                        var selected_product_combo_id = $("#slctd_prdctcombo").val();

                        //GET LAST PURCHASED SUPPLIER
                        $.get('/supplier_products/get_po_product_last_supplier', {
                            id: selected_product_combo_id,
                        }, function (data) {
                            $("#added_last_supplier").remove();
                            $("#added_last_price").remove();
                            if($.isEmptyObject(data['PurchaseOrderProduct'])!=true) {
                                if(data['PurchaseOrderProduct']['list_price']!=null) {
                                    var price = data['PurchaseOrderProduct']['list_price'];
                                    $('#last_supplier').append('<div id="added_last_price" class="text-primary"> Last Purchased Price:  &#8369;'+ price + ' </div>');
                                }
                            }
                            if(data['Supplier']!=null) {
                                $('#last_supplier').append('<div id="added_last_supplier" class="text-primary"> Last Purchased:  ' + data['Supplier']['name'] + '  [<small>' + data['created'] + '</small>]</div>');
                            }
                        }); //end of ajax get /supplier_products/get_po_product_last_supplier

                        // $.get('/supplier_products/get_supplier_product_combo', {
                        //     id: selected_product_id,
                        // }, function (data) {
                        //     for (i = 0; i < data.length; i++) {
                        //         $('#slctd_prdctcombo').append($('<option>', {
                        //             value: data[i]['ProductCombo']['id'],
                        //             text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                        //         }));
                        //     }
                        // }); //end of ajax get /supplier_products/get_product_combination

                        $('#slctd_prdct_supplier').empty().append('<option></option>');
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $.get('/supplier_products/get_supplier_product_combo', {
                            id: selected_product_combo_id,
                        }, function (data) {
                            $('.added_product_combo_properties_div').each(function (index) {
                                $(".added_product_combo_properties_div").remove();
                            });
                            $('#slctd_prdct_supplier').empty().append('<option></option>');
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_prdct_supplier').append($('<option>', {
                                    value: data[i]['Supplier']['id'],
                                    text: data[i]['Supplier']['name']
                                }));
                                $('#list_price').val(data[i]['ProductCombo']['SupplierProduct'][0]['supplier_price']);
                                $('#supplier_product_id').val(data[i]['ProductCombo']['SupplierProduct'][0]['id']);
                                var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty'];

                                for (v = 0; v < prod_combo_property.length; v++) {
                                    $('#product_combo_properties_div').append('<div class="col-sm-12 added_product_combo_properties_div">' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo 
                    }); //end of onchange slctd_prdctcombo 
                }); // end of onchange slctd_prdct 
            }); //end of each po_product_btn
        });


        ///SAVE PURCHASE ORDER PRODUCT
        $('#saveNewSupplierProductBtn').click(function () {
            $('#added_rqrd_fld').remove();
            var product_combo_id = $('#slctd_prdctcombo').val();
            var product_id = $("#slctd_prdct").val();
            var supplier_id = $("#slctd_prdct_supplier").val();
            var quote_product_id = $("#quote_product_id").val();
            var po_qty = $("#po_qty").val();
            var list_price = $("#list_price").val();
            var supplier_product_id = $("#supplier_product_id").val();


            if (product_id != "") {
                if (product_combo_id != "") {
                    if (supplier_id != "") {
                        if (po_qty != "" && po_qty != 0 && po_qty >= 1) {
                            if (list_price != "" && list_price != 0 && list_price >= 1) {
                                $('#added_rqrd_fld').remove();
                                var data = {
                                    "product_combo_id": product_combo_id,
                                    "product_id": product_id,
                                    "supplier_id": supplier_id,
                                    "quote_product_id": quote_product_id,
                                    "po_qty": po_qty,
                                    "list_price": list_price,
                                    "additional": 0,
                                    "supplier_product_id": supplier_product_id,
                                    "inventory_job_order_type": 'demo',
                                    "po_raw_request_id":0,
                                    "po_raw_request_qty":0,
                                    "client": get_passed_client
                                    
                                    
                                    // "product_combo_id": product_combo_id,
                                    // "product_id": product_id,
                                    // "supplier_id": supplier_id,
                                    // "quote_product_id": quote_product_id,
                                    // "reference_num": quote_product_id,
                                    // "reference_type": reference_type,
                                    // "po_qty": po_qty,
                                    // "list_price": list_price,
                                    // "additional": 1,
                                    // "supplier_product_id": supplier_product_id,
                                    // "inventory_job_order_type": 'po',
                                    
                                    
                                }
                                $.ajax({
                                    url: "/purchase_orders/process_new_po",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'text',
                                    success: function (dd) {
                                        location.reload();
//                    console.log(dd);
                                    },
                                    error: function (dd) {
                                        location.reload();
                                        // console.log('error' + dd);
                                    }
                                });
                            } else {
                                $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Price is required</font></div>')
                            }
                        } else {
                            $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Quantity is required</font></div>')
                        }
                    } else {
                        $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Supplier is required</font></div>')
                    }
                } else {
                    $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Product Combination is required</font></div>')
                }
            } else {
                $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Product is required</font></div>')
            }
        });


///////////////////////////////////////////////////////////////
///////////////////// GET FROM INVENTORY /////////////////////

        $('.inventory_product_btn').each(function (index) {
            $(this).click(function () {
                var qoute_prod_id = $(this).data("qprdctids");
                $('#get-from-inventory-product-modal').modal('show');
                $('#inv_quote_product_id').val(qoute_prod_id);

                $("#slctd_inv_lcation").change(function () {
                                $('#added_inv_rqrd_fld').remove();
                        $('#added_inv_product_combo_qtys_div').remove();
                $("#slctd_inv_prdct").select2({
                    placeholder: "Select Product",
                    width: '100%',
                    allowClear: false
                });
//                    alert('asd');
                    var slctd_inv_lcation = $("#slctd_inv_lcation").val();
//                    //GET PRODUCTS based from selected location
                    $.get('/inventory_products/get_inventory_products', {
                        id: slctd_inv_lcation,
                    }, function (data) {
                            $('#slctd_inv_prdctcombo').empty().append('<option></option>');
                            $('#slctd_inv_prdct').empty().append('<option></option>');
                            $('#added_inv_product_combo_qtys_div').remove();
                            $('.inv_added_product_combo_properties_div').each(function (index) {
                                $(".inv_added_product_combo_properties_div").remove();
                            }); 
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_inv_prdct').append($('<option>', {
                                    value: data[i]['Product']['id'],
                                    text: data[i]['Product']['name']
                                }));
                            }
                        // console.log(data); 
                    }); //end of ajax get /inventory_products/get_inventory_products
                    
                    
//                    //GET PRODUCT COMBO based from selected product
                    $("#slctd_inv_prdct").change(function () { 
                                $('#added_inv_rqrd_fld').remove();
                        // alert('asd');
                        $('#added_inv_product_combo_qtys_div').remove(); 
                        var selected_product_id = $("#slctd_inv_prdct").val(); 
                        $("#slctd_inv_prdctcombo").select2({
                            placeholder: "Select Product Combo",
                            width: '100%',
                            allowClear: false
                        });
                    $.get('/supplier_products/get_product_combination', {
                        id: selected_product_id,
                    }, function (data) {
                            $('#slctd_inv_prdctcombo').empty().append('<option></option>');
                        for (i = 0; i < data.length; i++) {
                            $('#slctd_inv_prdctcombo').append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                            })); 
                        }
                    });   //end of ajax get /supplier_products/get_product_combination
                    
                    
                    
                    $("#slctd_inv_prdctcombo").change(function () { 
                                $('#added_inv_rqrd_fld').remove();
                        
                        $('#added_inv_product_combo_qtys_div').remove();
                        var slctd_inv_prdctcombo = $('#slctd_inv_prdctcombo').val();
                        $('.inv_added_product_combo_properties_div').each(function (index) {
                            $(".inv_added_product_combo_properties_div").remove();
                        });
                        
                        $('#added_inv_product_combo_qtys_div').remove();
                        
                        
                        $.get('/supplier_products/get_supplier_product_combo', {
                            id: slctd_inv_prdctcombo,
                        }, function (data) {
                            $('.inv_added_product_combo_properties_div').each(function (index) {
                                $(".inv_added_product_combo_properties_div").remove();
                            }); 
                            for (i = 0; i < data.length; i++) { 
                                var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty']; 
                                for (v = 0; v < prod_combo_property.length; v++) {
                                    $('#inv_product_combo_properties_div').append('<div class="col-sm-12 inv_added_product_combo_properties_div">' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo
                        
                         
                        
                        //get counts of product combo
                        $.get('/inventory_products/get_inventory_product_count', {
                            id: slctd_inv_prdctcombo,
                            slctd_inv_lcation:slctd_inv_lcation
                        }, function (data) {
                        
                        // $('#added_inv_product_combo_qtys_div').remove();
                            // console.log('=='+data['inv_qty']+'==');
                            $('#inv_product_combo_qtys_div').append('<div id="added_inv_product_combo_qtys_div">' +
                                            '<label class="col-sm-8" ><b> Available Quantity in Inventory </b></label>' +
                                            '<div class="col-sm-4" align="center">'+data['inv_qty']+'</div> '+ 
                                            '</div>');
                        }); //end of ajax get /supplier_products/get_supplier_product_combo
                        
                        
                        
                                            
                    }); //end of change slctd_inv_prdctcombo
                        
                    
                    
                    });

                });

            });
        });



///SAVE inventory PRODUCT
        $('#saveNewInventoryProductBtn').click(function () {  
            var slctd_inv_lcation = $('#slctd_inv_lcation').val();
            var slctd_inv_prdct = $("#slctd_inv_prdct").val();
            var slctd_inv_prdctcombo = $("#slctd_inv_prdctcombo").val();
            var po_inv_qty = $("#po_inv_qty").val(); 
            var inv_quote_product_id = $("#inv_quote_product_id").val();
            
            
            if (slctd_inv_lcation != "") {
                if (slctd_inv_prdct != "") {
                    if (slctd_inv_prdctcombo != "") {
                        if (po_inv_qty != "" && po_inv_qty != 0 && po_inv_qty >= 1) { 
                                $('#added_inv_rqrd_fld').remove();
                                $(this).attr("disabled", "disabled"); //to disable button
                                var data = {
                                    "slctd_inv_lcation": slctd_inv_lcation,
                                    "slctd_inv_prdct": slctd_inv_prdct,
                                    "slctd_inv_prdctcombo": slctd_inv_prdctcombo,
                                    "po_inv_qty": po_inv_qty,
                                    "inv_quote_product_id": inv_quote_product_id, 
                                    "inventory_job_order_type": 'dr',
                                }
                                $.ajax({
                                    url: "/inventory_job_orders/process_quoted_products",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();  
                                    },
                                    error: function (dd) {
                                        console.log('error' + dd);
                                    }
                                });
                            } else {
                                $('#inv_rqrd_fld').append('<div id="added_inv_rqrd_fld"><font color="red">Quantity is required</font></div>')
                            } 
                    } else {
                        $('#inv_rqrd_fld').append('<div id="added_inv_rqrd_fld"><font color="red">Ptoduct Combo is required</font></div>')
                    }
                } else {
                    $('#inv_rqrd_fld').append('<div id="added_inv_rqrd_fld"><font color="red">Product is required</font></div>')
                }
            } else {
                $('#inv_rqrd_fld').append('<div id="slctd_inv_lcation"><font color="red">Inventory Location is required</font></div>')
            }
            
            
        });
    });//document ready closing
</script>  

