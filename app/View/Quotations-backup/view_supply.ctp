<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<link href="/css/sweetalert.css" rel="stylesheet"> 
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script> 
<script src="/js/erp_scripts.js"></script>  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="/js/sweetalert.min.js"></script>  
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
                                            <th>Processed Qty</th> 
                                            <th>Type</th>  
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
                                                                            echo '<li class="list-group-item"><b>' . $desc['ProductProperty']['name'] . '</b> : ' . $desc['ProductValue']['value'] . '</li>';
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
                                                                        <button class="btn btn-sm btn-primary set_supplier" data-supplierprodid="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-supplierprodqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>" data-processesqty>Select Supplier</button>

                                                                        <button class="btn btn-sm btn-warning warehouse_product_btn add-tooltip" data-toggle="tooltip"  data-original-title="Get Product From Inventory" data-qprdctids="<?php echo $quote_prod['QuotationProduct']['id']; ?>" data-qprdctqty="<?php echo $quote_prod['QuotationProduct']['qty']; ?>"><i class="fa fa-cubes"></i></button>
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
                                <h3 class="panel-title"> Purchasing Details </h3>
                            </div>
                            <div id="purchasing-panel-collapse" class="collapse in">
                                <div class="panel-body">
                                     <!--<button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" id="update_quote" data-upquoteid="<?php echo $quote_data['Quotation']['id']; ?>">Move to purchasing</button>-->
                                    this panel should show  if with po soa, dr, transmittal,
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


<div class="modal fade" id="set-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
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

                    <input type="hidden" id="sup_pid"/>   


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product</label> 
                            <select id="selected_product_supplier" class="form-control" style="width: 100%;"> 
                                <option>Select Product</option>
                                <?php 
                                foreach ($products as $product) {
                                    echo '<option value="'.$product['Product']['id'].'">'.$product['Product']['name'].' ['.$product['Product']['code'].']</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Supplier</label> 
                            <select id="selected_supplier" class="form-control" style="width: 100%;"> 
                                <option>Select Product Supplier</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div id="product_supplier_properties_div">
                            <h4 align="center">Available product</h4>
                            <div class="col-sm-12">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-4" align="center"><b> Property </b></div>
                                <div class="col-sm-4" align="center"><b> Value </b></div>
                                <div class="col-sm-2"> Quantity </div> <div class="col-sm-2"> </div>
                                <div class="col-sm-1">
                                </div>
                            </div>     
                        </div></div>
                    <!--                    <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label" id="labelSupplier">Quantity</label> 
                                                <input type="number" step="any" id="po_prod_qty" class="form-control">
                                            </div>
                                        </div>-->
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="savesetSupplier">Add</button>
            </div>
        </div>
    </div>
</div>
<!--

<div class="modal fade" id="set-updatesupplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            Modal header
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Supplier</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <input type="hidden" id="po_product_id"/>  

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="supplier_id" class="form-control" style="width: 100%;"> 
                                <option>Select Supplier</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div id="product_supplier_properties_div">
                            <h4 align="center">Available product</h4>
                            <div class="col-sm-12">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-3" align="center"><b> Property </b></div>
                                <div class="col-sm-3" align="center"><b> Value </b></div>
                                <div class="col-sm-2"> Quantity </div> <div class="col-sm-2"> </div>
                                <div class="col-sm-1">
                                </div>
                            </div>     
                        </div></div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label" id="labelSupplier">Quantity</label> 
                                                <input type="number" step="any" id="po_product_qty" class="form-control">
                                            </div>
                                        </div>
                </div>
            </div>
            Modal footer
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveupdateSupplier">Update</button>
            </div>
        </div>
    </div>
</div>-->



<!--===================================================-->
<!--Add New Product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="additional_po_product_modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Additional Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <div class="form-group col-sm-12">
                                <select id="product_id" class="form-control" style="width: 100%;"> 
                                    <option> -- select product --</option>
                                    <?php foreach ($products as $product) { ?>
                                        <option value="<?php echo $product['Product']['id']; ?>"> <?php echo $product['Product']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                            <div class="col-sm-12"><div class="product_details_div "></div></div>
                            <div class="col-sm-12"><div class="prod_other_info_div "></div> </div>
                            <div class="col-sm-12"><div class="prod_amount_div"></div></div> 


                        </div>                   

                        <div class="col-sm-4">
                            <div class="border" id="prod_image_add_div"> </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveProduct">Add</button>
            </div>
        </div>
    </div>
</div>



<!--===================================================-->
<!--Add New Product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="warehouse_product_modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Select Product From Inventory</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="quoted_qty" />
                        <input type="hidden" id="quoted_prod_id" />
                        <!--<div class="col-sm-8">-->
                        <div class="form-group col-sm-6">
                            <select id="inv_location_id" class="form-control"> 
                                <option> -- select location --</option>
                                <?php foreach ($locations as $location) { ?>
                                    <option value="<?php echo $location['InvLocation']['id']; ?>"> <?php echo $location['InvLocation']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group col-sm-6">
                            <select id="prod_inv_location_id" class="form-control"> 
                                <option> -- select product --</option> 
                            </select>
                        </div> 
                        <div class="col-sm-12">
                            <div id="prod_inv_location_prop"><h4 align="center">Available product</h4>
                                <div class="col-sm-12">
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-3" align="center"><b> Property </b></div>
                                    <div class="col-sm-3" align="center"><b> Value </b></div>
                                    <div class="col-sm-2"> Quantity </div> <div class="col-sm-2"> </div>
                                    <div class="col-sm-1">
                                    </div>
                                </div>     
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="border" id="prod_image_add_div"> </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveInventorySourceBtn" disabled>Add</button>
            </div>
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

    $('.set_supplier').each(function (index) {
        $(this).click(function () {
            $('#set-supplier-modal').modal('show');
            $("#savesetSupplier").prop('disabled', true);
            $('#selected_supplier').empty().append('<option></option>');
             $("#selected_product_supplier").select2({
                    placeholder: "Select Product Supplier",
                    allowClear: true,
                });

            var qid = $(this).data("supplierprodid");
            var po_prod_qty = $(this).data("supplierprodqty");
            $('#po_prod_qty').val(po_prod_qty);
            $("#added_suppliers_div").remove();
            $('#sup_pid').val(qid);
//             $.get('/product_suppliers/get_supplier', {
//                 id: qid,
//             }, function (data) {
// //                console.log(data);
//                 for (i = 0; i < data.length; i++) {
//                     $('#selected_supplier').append($('<option>', {
//                         value: data[i]['Supplier']['id'],
//                         text: data[i]['Supplier']['name']
//                     }));
//                 }

//             });




            $("#selected_product_supplier").change(function () {
                
            $('#selected_supplier').empty().append('<option></option>');
                $('.product_supplier_properties_add').each(function (index) {
                    $(".product_supplier_properties_add").remove();
                });

//                $("#savesetSupplier").prop('disabled', false);

                var product_id = $(this).val();
                alert(product_id);
//                console.log(supplier_id);
                // $('#selected_product_supplier').empty().append('<option></option>');
               
                
            $("#selected_supplier").select2({
                placeholder: "Select Supplier Name",
                allowClear: true
            });

                $.get('/product_suppliers/get_prod_suppliers', {
                    id: product_id,
                }, function (data) {
                        console.log(data);
                    for (i = 0; i < data.length; i++) {
                        $('#selected_supplier').append($('<option>', {
                            value: data[i]['ProductSupplier']['id'],
                            text: data[i]['Supplier']['name'] 
                        }));
                    }

                });

            });


            $("#selected_product_supplier").change(function () {

                $('.product_supplier_properties_add').each(function (index) {
                    $(".product_supplier_properties_add").remove();
                });

                var product_supplier_id = $("#selected_product_supplier").val();
                $.get('/product_suppliers/get_product_supplier_properties', {
                    id: product_supplier_id,
                }, function (data) {
                    for (i = 0; i < data.length; i++) {
                        $('#product_supplier_properties_div').append('<div  class="col-sm-12 product_supplier_properties_add">' +
                                '<div class="col-sm-1">' +
                                '<button class="rm_psp_prod btn btn-danger btn-sm">x</button>' +
                                '</div>' +
                                '<div class="col-sm-4" align="center"> ' +
                                '<input type="text" readonly class="form-control psp_property" value="' + data[i]['ProductSupplierProperty']['property'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-4" align="center"> ' +
                                '<input type="text" class="form-control psp_value" value="' + data[i]['ProductSupplierProperty']['value'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-2">' +
                                '<input type="number" class="form-control psp_qty" step="any"></div>' +
                                '<input type="hidden" class="form-control psp_price" value="' + data[i]['ProductSupplierProperty']['price'] + '">' +
                                '<div class="col-sm-1">' +
                                '</div>' +
                                '</div>');
                    }



                    $('.rm_psp_prod').each(function (index) {
                        $(this).click(function () {
                            $(this).closest(".product_supplier_properties_add").remove();
                        });
                    });

                    $('.psp_qty').each(function (index) {
                        $(this).keyup(function () {
                            $("#savesetSupplier").prop('disabled', false);
                        });
                    });
                });
            });



        });
    });


    $("#savesetSupplier").click(function () {
        $("#savesetSupplier").prop('disabled', true);
        var quotation_product_id = $("#sup_pid").val();
        var supplier_id = $("#selected_supplier").val();
        var product_supplier_id = $("#selected_product_supplier").val();

        var property = $('.psp_property').map(function () {
            return $(this).val();
        }).get();
        var value = $('.psp_value').map(function () {
            return $(this).val();
        }).get();
        var qty = $('.psp_qty').map(function () {
            return $(this).val();
        }).get();

        var total_qty = 0;
        $('.psp_qty').each(function (index) {
            var qty = parseFloat($(this).val());
            total_qty = total_qty + qty;
        });

        var total_price = 0;
        $('.psp_price').each(function (index) {
            var price = parseFloat($(this).val());
            total_price = total_price + price;
        });

        var counter = $('.psp_property').length;
        var ctr = counter - 1;
        var additional = 0;
//        var po_prod_qty = $("#po_prod_qty").val();
//        //process add po product
        var additional = 0;
        var data = {
            "quotation_product_id": quotation_product_id,
            "supplier_id": supplier_id,
            "product_supplier_id": product_supplier_id,
            "property": property,
            "value": value,
            "total_qty": total_qty,
            "total_price": total_price,
            "counter": ctr,
            "qty": qty,
            "additional":additional
        }
        $.ajax({
            url: "/purchase_orders/setPoProduct",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                location.reload();
//                console.log(dd);
            },
            error: function (dd) {
                console.log('error');
            }
        });

    });


//                $("#selected_product_supplier").change(function () {
//                    
//                    $.get('/product_suppliers/get_product_supplier', {
//                        id: supplier_id,
//                    }, function (data) {
//                        console.log(data);
//                        for (i = 0; i < data.length; i++) {
//                            $('#selected_product_supplier').append($('<option>', {
//                                value: data[i]['Product']['id'],
//                                text: "adsad"
//                            }));
//                        }
//
//                    }); 
//                });









//                    $.get('/prod_inv_locations/get_product_location_property', {
//                        id: prod_inv_location_id,
//                    }, function (data) {
////                    for (i = 0; i < data.length; i++) {
////                        console.log(data[i]);
////                    $('#product_supplier_properties_div').append('<div  class="col-sm-12 product_supplier_properties_add">' +
////                            '<div class="col-sm-1">' +
////                            '<button class="rm_psp_prod btn btn-danger btn-sm">x</button>' +
////                            '</div>' +
////                            '<div class="col-sm-4" align="center"> ' +
////                            '<input type="text" readonly class="form-control psp_property" value="' + data[i]['ProductSupplierProperty']['property'] + '">' +
//                            ' </div>' +
//                            '<div class="col-sm-4" align="center"> ' +
//                            '<input type="text" readonly class="form-control psp_value" value="' + data[i]['ProductSupplierProperty']['value'] + '">' +
//                            ' </div>' + 
//                            '<div class="col-sm-2">' +
//                            '<input type="number" class="form-control psp_qty" step="any"  ></div>' +
////                            '<div class="col-sm-1">' +
////                            '</div>' +
////                            '</div>');
////                    }
//                    });
//                });





//    $('.update_supplier').each(function (index) {
//        $(this).click(function () {
//            $('#set-updatesupplier-modal').modal('show');
//            $("#saveupdateSupplier").prop('disabled', true);
//
//            $('#supplier_id').empty().append('<option></option>');
//            $("#supplier_id").select2({
//                placeholder: "Select Supplier Name",
//                allowClear: true
//            });
//            $("#supplier_id").change(function () {
//                $("#saveupdateSupplier").prop('disabled', false);
//            });
//            var po_product_id = $(this).data("poproductid");
//            var po_product_qty = $(this).data("poproductqty");
//            $('#po_product_id').val(po_product_id);
//            $('#po_product_qty').val(po_product_qty);
//
//            var qid = $(this).data("supplierproductid");
////            $('#po_product_id').val(qid);
//
//
//            $.get('/product_suppliers/get_supplier', {
//                id: qid,
//            }, function (data) {
//                for (i = 0; i < data.length; i++) {
//                    $('#supplier_id').append($('<option>', {
//                        value: data[i]['Supplier']['id'],
//                        text: data[i]['Supplier']['name']
//                    }))
//                }
//
//            });
//
//        });
//    });
//
//    $("#saveupdateSupplier").click(function () {
//        $("#saveupdateSupplier").prop('disabled', true);
//        var po_product_id = $("#po_product_id").val();
//        var supplier_id = $("#supplier_id").val();
//        var po_product_qty = $("#po_product_qty").val();
//        //process add po product
//        var data = {
//            "po_product_id": po_product_id,
//            "supplier_id": supplier_id,
//            "qty": po_product_qty
//        }
//        $.ajax({
//            url: "/purchase_orders/updatePoProduct",
//            type: 'POST',
//            data: {'data': data},
//            dataType: 'json',
//            success: function (dd) {
//                location.reload();
////                        console.log(dd);
//            },
//            error: function (dd) {
//                console.log('error');
//            }
//        });
//
//    });


    $('.additional_po_product').each(function (index) {
        $(this).click(function () {
            $('#qprdctid').modal('show');
        });
    });
    $('.warehouse_product_btn').each(function (index) {
        $(this).click(function () {

            var quoted_qty = $(this).data("qprdctqty");
            $("#quoted_qty").val(quoted_qty);
            var quoted_prod_id = $(this).data("qprdctids");
            $("#quoted_prod_id").val(quoted_prod_id);
//            console.log('asdasd');
            $('#warehouse_product_modal').modal('show');
            $("#prod_inv_location_id").select2({
                placeholder: "Select Product",
                allowClear: true
            });
            //allow search product
//            alert('input qty');
//            var qid = $(this).data("collectquoteid");
//            window.location.replace("/collection_schedules/agent_move?id=" + qid);
        });
    });
    $("#inv_location_id").change(function () {
        $('.prod_inv_location_prop_add').each(function (index) {
            $(".prod_inv_location_prop_add").remove();
        });
        var inv_location_id = $("#inv_location_id").val();
        $('#prod_inv_location_id').empty().append('<option></option>');
        $.get('/prod_inv_locations/get_product_location', {
            id: inv_location_id,
        }, function (data) {
//                console.log(data);
            for (i = 0; i < data.length; i++) {
                $('#prod_inv_location_id').append($('<option>', {
                    value: data[i]['ProdInvLocation']['id'],
                    text: data[i]['Product']['name']
                }))
            }

        });
    });
    $("#prod_inv_location_id").change(function () {
        $('.prod_inv_location_prop_add').each(function (index) {
            $(".prod_inv_location_prop_add").remove();
        });
        var prod_inv_location_id = $("#prod_inv_location_id").val();
        $.get('/prod_inv_locations/get_product_location_property', {
            id: prod_inv_location_id,
        }, function (data) {
            for (i = 0; i < data.length; i++) {
//                console.log(data[i]['ProdInvLocationProperty']['property']);
                $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
                        '<div class="col-sm-1">' +
                        '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
                        '</div>' +
                        '<div class="col-sm-3" align="center"> ' +
                        '<input type="text" readonly class="form-control inv_prop" value="' + data[i]['ProdInvLocationProperty']['property'] + '">' +
                        ' </div>' +
                        '<div class="col-sm-3" align="center"> ' +
                        '<input type="text" readonly class="form-control inv_val" value="' + data[i]['ProdInvLocationProperty']['value'] + '">' +
                        ' </div>' +
                        '<div class="col-sm-2">' +
                        '<input type="text" readonly class="form-control inv_qty" value="' + data[i]['ProdInvLocationProperty']['qty'] + '">' +
                        '</div>' +
                        '<div class="col-sm-2">' +
                        '<input type="number" class="form-control inv_qty_deduct" step="any" data-invprop="' + data[i]['ProdInvLocationProperty']['qty'] + '"></div>' +
                        '<div class="col-sm-1">' +
                        '</div>' +
                        '</div>');
            }

            $('.rm_prod_inv').each(function (index) {
                $(this).click(function () {
                    $(this).closest(".prod_inv_location_prop_add").remove();
                });
            });
            $('.inv_qty_deduct').each(function (index) {
                $(this).keyup(function () {
                    var qty = parseFloat($(this).val());
                    var invprop = parseFloat($(this).data("invprop"));
                    if (qty > invprop) {
                        alert('Invalid Quantity');
                        $('#saveInventorySourceBtn').prop("disabled", true);
                    } else {
                        $('#saveInventorySourceBtn').prop("disabled", false);
                    }
                });
            });
        });
    });
    $("#saveInventorySourceBtn").click(function () {
//        $('#saveInventorySourceBtn').prop("disabled", true);
        var total_inv_deduct = 0;
        $('.inv_qty_deduct').each(function (index) {
            var inv_qty = parseFloat($(this).val());
            total_inv_deduct = total_inv_deduct + inv_qty;
        });
//    alert(total_inv_deduct);
        var quoted_qty = parseFloat($("#quoted_qty").val());
        if (total_inv_deduct > quoted_qty) {
            alert('Quantity should only be equal or less than' + quoted_qty);
        } else {
            var inv_location_id = $("#inv_location_id").val();
            var prod_inv_location_id = $("#prod_inv_location_id").val();
            var total_inv_deduct = total_inv_deduct;
            var quoted_prod_id = $("#quoted_prod_id").val();
            var inv_prop = $('.inv_prop').map(function () {
                return $(this).val();
            }).get();
            var inv_val = $('.inv_val').map(function () {
                return $(this).val();
            }).get();
            var inv_qty_deduct = $('.inv_qty_deduct').map(function () {
                return $(this).val();
            }).get();
            var counter = $('.inv_prop').length;
            var ctr = counter - 1;
//            console.log(ctr);
            var data = {
                "inv_location_id": inv_location_id,
                "prod_inv_location_id": prod_inv_location_id,
                "quoted_prod_id": quoted_prod_id,
                "inv_prop": inv_prop,
                "inv_val": inv_val,
                "inv_qty_deduct": inv_qty_deduct,
                "total_inv_deduct": total_inv_deduct,
                "counter": ctr
            }
            $.ajax({
                url: "/quotation_products/quoted_product_warehouse_source",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
                    location.reload();
//                    console.log(dd);
                },
                error: function (dd) {
                    console.log('error' + dd);
                }
            });
        }


    });
//    additional_po_product_modal

</script>  