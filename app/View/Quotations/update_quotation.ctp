<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<link href="/css/sweetalert.css" rel="stylesheet">
<!--<link href="plugins/bootstrap-validator/bootstrapValidator.min.css" rel="stylesheet">-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>
<script src="/css/plug/select/js/select2.min.js"></script>   
    <!--<script src="plugins/masked-input/jquery.maskedinput.min.js"></script>-->
    <!--<script src="plugins/bootstrap-validator/bootstrapValidator.min.js"></script>-->
<script src="/js/erp_scripts.js"></script>  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="/js/sweetalert.min.js"></script>  
<!--===================================================-->
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Update Quotation</h1>
    </div>
    <div id="page-content">  
        <?php
        if($UserIn['User']['role'] == "sales_manager") {
            if($status=="pending" || $status=="rejected" || $status=="edited") { ?>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">
                            <button class="btn btn-primary savePendingQuote" data-buttontype="save" <?php
                            if (count($quote_products) == 0) {
                                echo 'disabled';
                            }
                            ?> >Update</button> 
                            
                            <input type="hidden" readonly value="<?php echo AuthComponent::user('role'); ?>" id="myusrRole">
                        </h3>
                    </div>
                </div> <?php
            }
        }
        else {
            if($status=="pending") {
                ?>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">
                            <button class="btn btn-primary savePendingQuote" data-buttontype="save" <?php
                            if (count($quote_products) == 0) {
                                echo 'disabled';
                            }
                            ?>>Update</button> 
                            
                            <input type="hidden" readonly value="<?php echo AuthComponent::user('role'); ?>" id="myusrRole">
                        </h3>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">  
                            <input type="hidden" id="quotation_id" value="<?php echo $quote_data['Quotation']['id']; ?>">
                            <b><?php if (!is_null($quote_data['Quotation']['quote_number'])) echo $quote_data['Quotation']['quote_number']; ?> </b>

                        </div>
                        <h3 class="panel-title"> Quote information</h3>
                    </div>
                    <div id="qInfo-panel-collapse" class="collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Type</label> 

                                        <select id="type" class="form-control">
                                            <?php if (!is_null($quote_data['Quotation']['type'])) { ?>
                                                <option value="<?php echo $quote_data['Quotation']['type']; ?>">
                                                    <?php echo $quote_data['Quotation']['type']; ?>
                                                </option>
                                                <?php
                                            } else {
                                                echo '<option>Select</option>';
                                            }
                                            ?>
                                            <option value="quotation"> quotation </option>
                                            <option value="fitout"> fitout </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">&nbsp;</label> 
                                        <?php
                                        if ($quote_data['Quotation']['job_request_id'] != 0) {
                                            // =========================> JOB REQUEST REVISION START HERE
                                            $date_up = new DateTime(date('Y-m-d', strtotime("2018-05-03")));
                                            $jo_created = new DateTime(date('Y-m-d', strtotime($quote_data['JobRequest']['created'])));
                                            $interval = $date_up->diff($jo_created);
                                            $interval_day = $interval->format('%R%a');
                                            if($interval_day>=0) {
                                                echo '  
                                                    <div class="input-group mar-btm">
                                                    <input type="text" class="form-control" placeholder="Name" readonly value="' . $quote_data['JobRequest']['jr_number'] . '">
                                                    <span class="input-group-btn">
                                                     <a href="/job_requests/view_jr?id='.$quote_data['JobRequest']['id'].'" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="View Job Request?" ><i class="fa fa-external-link"></i> </a> 
                                                    </span>
                                                </div>';
                                            }
                                            else {
                                                echo '<div class="input-group mar-btm">
                                                    <input type="text" class="form-control" placeholder="Name" readonly value="' . $quote_data['JobRequest']['jr_number'] . '">
                                                    <span class="input-group-btn">
                                                     <a class="jrupdateBtn btn btn-warning btn-icon  add-tooltip"
                                                              data-toggle="tooltip" 
                                                              data-original-title="Update Job Request!"  type="button"
                                                              href="/job_requests/joupdate?id='.$quote_data['Quotation']['id'].'">
                                                                <i class="fa fa-exclamation-triangle"></i>
                                                    </a></span>
                                                </div>';
                                            }
                                            // ======================> JOB REQUEST REVISION END HERE
                                        } else {
                                            echo '<br/><button class="btn btn-dark  add-tooltip" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" id="jobRequestBtn"> Job Request </button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" value="<?php if (!is_null($quote_data['Quotation']['subject'])) echo $quote_data['Quotation']['subject']; ?>" onkeyup="saveSubject()">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class=" control-label">Validity Date</label>
                                        <div class=" date">
                                            <div class="input-group input-append date" id="datePicker">
                                                <input type="text" class="form-control" name="date" readonly id="validity_date" value="<?php if (!is_null($quote_data['Quotation']['validity_date'])) echo $quote_data['Quotation']['validity_date']; ?>" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Client 
                                            <button class="btn btn-primary btn-xs" data-target="#create-client-modal" data-toggle="modal"><i class="fa fa-plus"></i></button></label>
                                        <select id="client_id" class="form-control">
                                            <?php if ($quote_data['Quotation']['client_id'] != 0) {
                                                echo '<option value="'.$quote_data['Quotation']['client_id'].'">'.$quote_data['Client']['name'].'</option>';
                                            } else {
                                                echo '<option></option>';
                                            }
                                            foreach ($clients as $client) {
                                                echo '<option value="'.$client['Client']['id'].'">'.$client['Client']['name'].'</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 client_info">
                                     <?php if ($quote_data['Quotation']['client_id'] != 0) {
                                        $cp = 'N/A'; $cn = 'N/A';
                                        $cp_state = 'disabled'; $cn_state = 'disabled';
                                        if(!empty($quote_data['Client'])) {
                                            $cp = $quote_data['Client']['contact_person'];
                                            $cn = $quote_data['Client']['contact_number'];
                                            $ad = $quote_data['Client']['address'];
                                            $cp_state = 'enabled';
                                            $cn_state = 'enabled';
                                        }
                                        echo '<div class="form-group oldInfo">
                                            <div class="col-sm-6">
                                                <label class="control-label">Contact Person</label>
                                                <input type="text" class="form-control" readonly id="contact_person" value="'.$cp.'" '.$cp_state.'>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label">Contact Number</label>
                                                <input type="text" class="form-control" readonly id="contact_number" value="'.$cn.'" '.$cn_state.'>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="control-label">Address</label>
                                                <input type="text" class="form-control" readonly id="address" value="'.$ad.'" '.$cn_state.'>
                                            </div>
                                        </div>';
                                    } ?>
                                </div>
                            </div>
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
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Delivery Mode</label>
                            <select id="delivery_mode" class="form-control">
                                <?php if (!is_null($quote_data['Quotation']['delivery_mode'])) { ?>
                                    <option value="<?php echo $quote_data['Quotation']['delivery_mode']; ?>">
                                        <?php echo $quote_data['Quotation']['delivery_mode']; ?>
                                    </option>
                                    <?php
                                } else {
                                    echo '<option>Select</option>';
                                }
                                ?>
                                <option value="pickup"> pickup </option>
                                <option value="deliver"> deliver </option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div id="delivery_date_div_value">
                                <label>Tentative Delivery or Pickup Date</label>
                                <div class="input-group input-append date" id="datePicker-deliver">
                                    <input type="text" class="form-control" name="date" readonly id="target_delivery" value="<?php if (!is_null($quote_data['Quotation']['target_delivery'])) echo $quote_data['Quotation']['target_delivery']; ?>" />
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="addresses">
                        <?php
                            $isWithBillShip = 0;
                            $isWithBill = 0;
                            $isWithShip = 0;
                            
                            if ($quote_data['Quotation']['delivery_mode'] == 'deliver') { ?>  
                            <?php if ($quote_data['Quotation']['bill_ship_address'] == 1) { ?> 
                                <div id="bill_ship_div"> 
                                    <div class="col-sm-6">
                                        <b>Billing and Shipping Address</b>   <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['bill_latitude'] . ',' . $quote_data['Quotation']['bill_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div id="bill_ship_div_data"> 
                                            <?php
                                            if($quote_data['Quotation']['bill_geolocation']!="") {
                                                $isWithBillShip = 1;
                                            }
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
                                                if ($quote_data['Quotation']['bill_geolocation']!="") { $isWithBill = 1; }
                                                    
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
                                                if ($quote_data['Quotation']['ship_geolocation']!="") { $isWithShip = 1; }
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
                            }
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel" id="map_div">
            <div class="panel-heading">
                <div class="panel-control">
                    <button class="btn btn-default" data-target="#map-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                </div>
                <h3 class="panel-title"> Google Map </h3>
                <h3 class="panel-title">   </h3>
            </div>
            <div id="map-panel-collapse" class="collapse in">
                <div class="panel-body">
                    <div class="form-group col-sm-6" align="center">
                        <input type="text" class="form-control" placeholder="Building No. / Room No. / Floor No." id="input_bill_address" value="<?php echo $quote_data['Quotation']['bill_address'] ?>"> 
                    </div>
                    <div class="form-group col-sm-6" align="center"> 
                        <input type="text" class="form-control" placeholder="Address here" id="bill_geolocation" value="<?php echo $quote_data['Quotation']['bill_geolocation']?>">
                    </div>
                    <div class="form-group col-sm-12" align="center"> 
                        <input type="text" class="form-control" placeholder="Address here" id="bill_geolocation_newest" readonly >
                    </div>
                    <div class="form-group col-sm-9" align="center">
                        <input id="search-txt" type="text" class="form-control" placeholder="Search for location">
                    </div>
                    <div class="form-group col-sm-3" align="center">
                        <input id="search-btn" type="button" value="Search" class="btn btn-primary"> 
                        <!--<input id="detect-btn" type="button" value="My Location" disabled class="btn btn-info">--> 
                        <!--<span id="map-output"></span>-->
                    </div>
                    <div class="form-group col-sm-12" align="center">
                        <button id="bill_ship_save" class="btn btn-warning btn-xs" <?php
                        if ($quote_data['Quotation']['delivery_mode'] != 'deliver') {
                            echo 'disabled';
                        }
                        ?>> Save Billing and Shipping </button>
                        <button id="bill_save" class="btn btn-info btn-xs" <?php
                        if ($quote_data['Quotation']['delivery_mode'] != 'deliver') {
                            echo 'disabled';
                        }
                        ?>> Save Billing Only </button>
                        <button id="ship_save" class="btn btn-primary btn-xs" <?php
                        if ($quote_data['Quotation']['delivery_mode'] != 'deliver') {
                            echo 'disabled';
                        }
                        ?>> Save Shipping Only </button>
                        <br/>
                    </div>
                    <center>
                        <div id="map-canvas" style="width:90%;height:400px;"></div>
                    </center>
                    <input id="bill_latitude" type="hidden"> <!-- bill_latitude -->
                    <input id="bill_longitude" type="hidden">  <!-- bill_longitude -->
                </div>
            </div>
        </div>  



        <?php if (!is_null($quote_data['Quotation']['delivery_mode'])) { ?>
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">
                        <button id="add_product_btn" class="btn btn-primary"  data-target="#add-product-modal" data-toggle="modal"><i class="fa fa-plus"></i> Add New Product</button>
                        <button class="btn btn-default" data-target="#products-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Products Info </h3>
                </div>
                <div id="products-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <?php if (count($quote_products) != 0) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <!--<thead>-->
                                    <th>#</th>
                                    <th>Product Code</th>
                                    <th>Description</th>
                                    <th>Qty</th> 
                                    <th>List Price</th> 
                                    <th>Total</th> 
                                    <th>Action</th> 
                                    <!--</thead>-->
                                    <tbody>
                                        <?php
                                        $cnt = 1;
                                        $sub_total = 0;
                                        foreach ($quote_products as $quote_prod) {
                                            if($quote_prod['QuotationProduct']['deleted']==null) {
                                            ?>
                                            <tr>
                                                <td ><?php echo $cnt; ?></td>
                                                <td ><?php echo $quote_prod['Product']['name']; ?></td>
                                                <td >
                                                    <ul class="list-group">
                                                        <?php
                                                        foreach ($quote_prod['QuotationProductProperty'] as $desc) {
                                                            if (!is_null($desc['property'])) {
                                                                echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        if($quote_prod['QuotationProduct']['other_info']!="" &&
                                                           $quote_prod['QuotationProduct']['other_info']!=null) {
                                                           echo '<li class="list-group-item"><b>Other Info : <br/></b>' . $quote_prod['QuotationProduct']['other_info'] . '</li>';
                                                        }
                                                        ?>

                                                    </ul>
                                                </td>
                                                <td ><?php echo abs($quote_prod['QuotationProduct']['qty']); ?></td> 
                                                <td >&#8369; <?php echo number_format($quote_prod['QuotationProduct']['edited_amount'], 2); ?></td> 
                                                <td >&#8369; <?php echo number_format($quote_prod['QuotationProduct']['total'], 2); ?></td>
                                                <td>
                                                    <?php
                                                    if($UserIn['User']['role']=="sales_executive" && $quote_data['Quotation']['status'] == "pending") {
                                                        $qpid = $quote_prod['QuotationProduct']['id'];
                                                        if (intval($quote_data['Quotation']['job_request_id']) == 0) {
                                                            echo '
                                                            <button class="btn btn-warning btn-xs add-tooltip"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    title="Edit Item # '.$cnt.'"
                                                                    id="btn_edit_product"
                                                                    data-pid="'.$quote_prod['QuotationProduct']['id'] .'">
                                                                    <span class="fa fa-edit"></span>
                                                            </button>
                                                            ';
                                                        }
                                                    }
                                                    elseif($UserIn['User']['role']=="sales_manager" && $quote_data['Quotation']['status'] == "rejected" || $quote_data['Quotation']['status'] == "pending") {
                                                        if (intval($quote_data['Quotation']['job_request_id']) == 0) {
                                                            echo '
                                                            <button class="btn btn-warning btn-xs add-tooltip"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    title="Edit Item # '.$cnt.'"
                                                                    id="btn_edit_product"
                                                                    data-pid="'.$quote_prod['QuotationProduct']['id'] .'">
                                                                    <span class="fa fa-edit"></span>
                                                            </button>
                                                            ';
                                                        }
                                                    }
                                                    
                                                    echo '
                                                    <button class="btn btn-danger btn-icon btn-xs add-tooltip delete-added-product"
                                                            data-delqprodid="'.$quote_prod['QuotationProduct']['id'].'" data-toggle="tooltip"
                                                            data-quoteid="'.$quote_prod['Quotation']['id'].'"
                                                            data-original-title="Delete Item # '.$cnt.'">
                                                        <i class="fa fa-window-close "></i>
                                                    </button>';
                                                    ?>
                                                </td> 
                                            </tr> 
                                            <?php
                                            } else {
                                                echo '<tr><td>' . $cnt . '</td>'
                                                . '<td >' . $quote_prod['Product']['name'] . '</td>'
                                                . '<td colspan="5" class="text-danger"><b>Date Deleted: </b>'
                                                . time_elapsed_string($quote_prod['QuotationProduct']['deleted']) . '</td>'
                                                . '</tr>';
                                            }
                                            $cnt++;
                                            if($quote_prod['QuotationProduct']['deleted']==null) {
                                                $sub_total = $sub_total + $quote_prod['QuotationProduct']['total'];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>


                            <div class="col-sm-7"></div>
                            <div class="col-sm-5" align="right">
                                <div class="table-responsive">
                                <table>
                                    <tr>
                                        <td><b>Sub Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                        <td>
                                            <div class="form-group"><input value="<?php echo $sub_total; ?>" type="text" id="sub_total" class="form-control" readonly></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Installation Charge: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td>
                                            <div class="form-group"><input type="number" step="any" id="installation_charge" class="form-control" value="<?php echo abs($quote_data['Quotation']['installation_charge']); ?>"></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Delivery Charge: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td>
                                            <div class="form-group"><input  type="number" step="any" id="delivery_charge" class="form-control"  <?php
                                                if ($quote_data['Quotation']['delivery_mode'] != 'deliver') {
                                                    echo 'readonly value="0"';
                                                    
                                                }else{
                                                    ?>
                                                    value="<?php echo abs($quote_data['Quotation']['delivery_charge']); ?>"
                                                    <?php
                                                }
                                                ?>></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Discount: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td>
                                            <div class="form-group"><input  type="number" step="any" id="discount" class="form-control" value="<?php echo abs($quote_data['Quotation']['discount']); ?>"></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Grand Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                        <td>
                                            <div class="form-group"><input type="text" id="grand_total" class="form-control" readonly   ></div> 
                                        </td>
                                    </tr>
                                </table> 
                                </div>
                            </div>



                        <?php } ?>
                    </div>
                    <div class="panel-footer">
                        <div class="panel-control">
                            <button id="add_product_btn" class="btn btn-primary"  data-target="#add-product-modal" data-toggle="modal"><i class="fa fa-plus"></i> Add New Product</button> 
                        </div>
                        <h3 class="panel-title"> Products Info </h3>
                    </div>
                </div>
            </div>
        <?php } ?>










        <div class="panel">
            <div class="panel-heading">
                <div class="panel-control">
                        <!--<button id="add_product_btn" class="btn btn-primary"  data-target="#terms-product-modal" data-toggle="modal"><i class="fa fa-plus"></i> Add New Product</button>-->
                    <button class="btn btn-default" data-target="#terms-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                </div>
                <h3 class="panel-title"> Terms and conditions </h3>
            </div>
            <div id="terms-panel-collapse" class="collapse in">
                <div class="panel-body"> 
                    <textarea id="terms"><?php echo $quote_data['Quotation']['terms_info']; ?></textarea>
                </div>
            </div>
        </div>







    <?php
    if($UserIn['User']['role']=="sales_manager") {
        if($status=="pending" || $status=="rejected" || $status=="edited") {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <button class="btn btn-primary savePendingQuote" data-buttontype="save" <?php
                        if (count($quote_products) == 0) {
                            echo "disabled";
                        }
                        ?>>Update</button> 
                        <!--<button class="btn btn-danger cancelQuote">Cancel</button> -->
                    </h3>
                </div>
            </div> <?php
        }
    }
    else {
        if($status=="pending") { ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <button class="btn btn-primary savePendingQuote" data-buttontype="save" <?php
                        if (count($quote_products) == 0) {
                            echo "disabled";
                        }
                        ?>>Update</button> 
                        <!--<button class="btn btn-danger cancelQuote">Cancel</button> -->
                    </h3>
                </div>
            </div> <?php
        }
    }
    ?>
    </div> 
</div> 
<!--Add New Client Modal Start-->
<!--===================================================-->
<div class="modal fade" id="create-client-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Client</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label>Contact Person <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"   id="contact_person">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control"  id="position">
                </div>
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"   id="address">
                </div>
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control"   id="email">
                </div>
                <div class="form-group">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="contact_number">
                </div>
                <div class="form-group">
                    <label>Industry <span class="text-danger">*</span></label>
                    <select  class="form-control"  id="client_industry_id">
                        <option></option>
                        <?php 
                        foreach($industries as $industry){
                            echo '<option value="'.$industry['ClientIndustry']['id'].'">'.$industry['ClientIndustry']['name'].'</option>';
                        }
                        ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="text" class="form-control"  id="tin_number">
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveLead">Add</button>
            </div>
        </div>
    </div>
</div>






<!--===================================================-->
<!--Add New Product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title title_product">Add New Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="product_id" class="form-control"> 
                                <option>---- Select Product ----</option>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['Product']['id']; ?>"> <?php echo $product['Product']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <div class="product_details_div"></div>
                        </div>
                        
                        <div class="col-lg-12 form-group">
                            <div class="row prod_other_info_div">
                                <textarea id="other_info"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="prod_amount_div"></div>
                        </div> 
                    </div>                   

                    <div class="col-sm-4">
                        <div class="border" id="prod_image_add_div"></div>
                        <div class="form-group" id="div_swatches">
                            <select class="form-control" id="select_swatches">
                                <option>---- Select Swatches ----</option>
                                <?php
                                foreach($swatches as $ret_swatches) {
                                    $product_obj = $ret_swatches['Product'];
                                    $ret_prodid = $product_obj['id'];
                                    $ret_prodname = $product_obj['name'];
                                    
                                    echo '<option value="'.$ret_prodid.'">'.$ret_prodname.'</option>';
                                }
                                ?>
                            </select>
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
<!--End of Add New Product Modal Start-->
<!--===================================================-->

<!--===================================================-->
<!--Edit Product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title title_product">Edit Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="e_product_id" class="form-control" disabled> 
                                <option>---- Select Product ----</option>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['Product']['id']; ?>"> <?php echo $product['Product']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <div class="e_product_details_div"></div>
                        </div>
                        
                        <div class="col-lg-12 form-group">
                            <div class="row e_prod_other_info_div">
                                <textarea id="e_other_info"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="e_prod_amount_div"></div>
                        </div> 
                    </div>                   

                    <div class="col-sm-4">
                        <div class="border" id="e_prod_image_add_div"></div>
                        <div class="form-group" id="e_div_swatches">
                            <select class="form-control" id="e_select_swatches">
                                <option>---- Select Swatches ----</option>
                                <?php
                                foreach($swatches as $ret_swatches) {
                                    $product_obj = $ret_swatches['Product'];
                                    $ret_prodid = $product_obj['id'];
                                    $ret_prodname = $product_obj['name'];
                                    
                                    echo '<option value="'.$ret_prodid.'">'.$ret_prodname.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateProduct">Update</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End of Add New Product Modal Start-->
<!--===================================================-->


<script type="text/javascript">
$(document).ready(function(e) {
    var pid = 0;
    $("button#btn_edit_product").on('click', function(e) {
        pid = $(this).data('pid');
        $("#edit-product-modal").modal('show');

        $.get('/quotations/update_qproduct', {pid:pid},
            function(data) {
                if(data.length != 0) {
                    var qp = JSON.parse(data);
                    // console.log(qp);
                    // testing...
                    var qpid = qp['qproduct']['QuotationProduct']['product_id'];
                    var ppid = qp['ProductProperty'];
                    var qty = qp['qproduct']['QuotationProduct']['qty'];
                    var qprc = qp['qproduct']['QuotationProduct']['edited_amount'];
                    // var qptype = qp['qproduct']['QuotationProduct']['type'];

                    $("#e_product_id").val(qpid);
                    $("#e_product_id").trigger("change");
                    setTimeout('$("body").find("#edit-product-modal input#e_prod_quantity").val('+qty+');', 1000);
                    // setTimeout('$("body").find("#edit-product-modal input#e_initial_prod_type").val('+qptype+');', 1000);
                    setTimeout('$("body").find("#edit-product-modal input#e_edited_amount").val('+qprc+');', 1000);
                }
        });
    });
    
    $('#updateProduct').click(function () {
        if ($('.e_deldetail_new').length == 0) {
            var type = $('#e_initial_prod_type').val();
        } else {
            var type = $('#e_prod_type').val();
        }

        var quotation_id = $("#quotation_id").val();
        var product_id = $("#e_product_id").val();
        var image = $('#e_prdct_image').val();
        var price = $('#e_prod_amount').val();
        var qty = $('#e_prod_quantity').val();
        var other_info = tinyMCE.get('e_other_info').getContent();
        var edited_amount = $('#e_edited_amount').val();
        var sale = $('#e_sale').val();
        var installation_charge = $('#installation_charge').val();
        var delivery_charge = $('#delivery_charge').val();
        var discount = $('#discount').val();
        var type = $("#type").val();
        
        var property = [];
        $('.e_prop_name').each(function (index) {
            property.push($(this).val());
        });
        var value = [];
        $('.e_prod_value').each(function (index) {
            value.push($(this).val());
        });
        
        $('.e_qpp').each(function (index) {
            property.push($(this).val());
        });

        $('.e_qpv').each(function (index) {
            value.push($(this).val());
        });

        var swatch = $("#e_select_swatches option:selected").text();
        if (product_id != "") {
            if(property.length!=0) {
                if (qty != "" && qty != 0) {
                    if(edited_amount!=0) {
            
                        var data1 = {
                            "qpid": pid,
                            "quotation_id": quotation_id,
                            "product_id": product_id,
                            "image": image,
                            "qty": qty,
                            "price": price,
                            "other_info": other_info,
                            "edited_amount": edited_amount,
                            "sale": sale,
                            "swatch": swatch,
                            "property": property,
                            "value": value,
                            "type": type,
                            "installation_charge": installation_charge,
                            "delivery_charge": delivery_charge,
                            "discount": discount,
                        }
                        console.log(data1);
                        $.ajax({
                            url: "/quotation_products/updateProductQuotation",
                            type: 'POST',
                            data: {'data': data1},
                            dataType: 'text',
                            success: function (dd) {
                                console.log(dd);
                                location.reload();
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Oops!",
                            text: "Product price cannot be empty.\n"+
                                  "Please indicate product price and try again.",
                            type: "warning"
                        });
                    }
                } else {
                    swal({
                        title: "Oops!",
                        text: "Quantity cannot be empty.\n"+
                              "Please indicate quantity and try again.",
                        type: "warning"
                    });
                }
            }
            else {
                swal({
                    title: "Oops!",
                    text: "Properties and values cannot be empty.\n"+
                          "Please add properties and values and try again.",
                    type: "warning"
                });
            }
        } else {
            swal({
                title: "Oops!",
                text: "Product code cannot be empty.\n"+
                      "Please select product code and try again.",
                type: "warning"
            });
        }
    });
        
    $("#e_product_id").change(function () {
        $("#e_div_swatches").show();
        $("div.e_prod_other_info_div").show();
        
        $(".e_prod_details").remove();
        var id = $("#e_product_id").val();
        $.get('/quotations/update_qproduct', {
            pid: pid,
        }, function (data_tmp) {
            var data = JSON.parse(data_tmp);
            console.log(data);
            var i;
            var qprod_property = data['qproduct']['QuotationProductProperty'];
            var prod_qp = data['qproduct']['QuotationProduct'];
            var prod_amount = 0;
            var prod_amount_default = 0;
            
            for (i = 0; i < qprod_property.length; i++) {
                if(qprod_property[i]['property']!=null) {
                    $(".e_product_details_div").append('<div class="row form-group e_prod_details">'+
                            '<div class="col-sm-5">'+
                                '<input type="text" class="e_qpp form-control " value="' + qprod_property[i]['property'] + '" readonly>' +
                            '</div>' +
                            '<div class="col-sm-6"><input type="text" class="e_qpv form-control " value="' + qprod_property[i]['value'] + '" readonly>' +
                            '</div>' +
                            '<div class="col-sm-1" style="padding:5px 5px 5px 5px;">'+
                                '<a class="btn btn-xs btn-danger e_deldetail" > <i class="fa fa-minus"></i> </a>'+
                            '</div>' +
                        '</div>');
                }
            }

            $('.e_deldetail').each(function (index) {
                $(this).click(function () {
                    //should update price upon removing specific value 
                    $(this).closest(".e_prod_details").remove();

                    if (data['Product']['sale_price'] == 0) {
                        var total_price = 0;
                        if ($(".e_prod_value_price").length >= 1) {
                            $(".e_prod_value_price").each(function () {
                                total_price = total_price + parseFloat($(this).val());
                                $("#e_edited_amount").val(total_price);
                                $("#e_view_amount").val(total_price);
                                $("#e_prod_amount").val(total_price);
                            });
                        } else {
                            
                            $("#e_edited_amount").val(prod_amount_default);
                            $("#e_view_amount").val(prod_amount_default); 
                            $("#e_prod_amount").val(prod_amount_default);
                        }
                    }
                });
            });

            // TEXTAREA
             tinymce.get('e_other_info').setContent(data['qproduct']['QuotationProduct']['other_info']);

            $("#e_prod_amount_info").remove();
            if (data['qproduct']['Product']['sale_price'] == 0) {
                //total of all product values
                $(".e_prod_amount_div").append('<div class="row" id="e_prod_amount_info">'+
                        '<input type="hidden" id="e_sale" value="0"/>'+
                        '<div class="col-sm-6">' +
                            '<div class="input-group mar-btm">' +
                                '<span class="input-group-btn">' +
                                '<button class="btn btn-default" disabled> Php</button> </span> ' +
                                '<input class="form-control" id="e_view_amount"  value="' + addCommas(truncate(prod_amount, 2)) + '" readonly>' +
                                '<input  type="hidden" class="form-control" id="e_prod_amount" value="' + prod_amount + '" readonly>' +
                            '</div>' +
                        '</div>' + 
                        '<div class="col-sm-6">'+
                            '<input type="number" id="e_prod_quantity" class="form-control" name="integer" placeholder="Quantity" '+
                            'onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">'+
                        '</div>' +
                        '<div class="col-sm-12">'+
                            '<label>Product Price</label>'+
                            '<input type="number" step="any" id="e_edited_amount" class="form-control"  value="' + truncate(prod_amount, 2) + '" >'+
                        '</div>' +
                    '</div>');
            } else {
                var sale_price = parseFloat(data['qproduct']['Product']['sale_price']);
                $(".e_prod_amount_div").append('<div id="e_prod_amount_info">'+
                        '<input type="hidden" id="e_sale" value="1"/>'+
                        '<div class="col-sm-6">' +
                            '<div class="input-group mar-btm">' +
                                '<span class="input-group-btn">' +
                                '<button class="btn btn-default" disabled> Php</button> </span> ' +
                                '<input class="form-control"   value="' + addCommas(truncate(sale_price, 2)) + '" readonly>' +
                                '<input type="hidden" class="form-control" id="e_prod_amount" value="' + sale_price + '" readonly>' +
                                '<span class="input-group-btn">' +
                                '<button class="btn btn-warning" type="button" disabled> <i class="fa fa fa-gift"></i> Sale!</button> </span> ' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-6">'+
                            '<input type="number" id="e_prod_quantity" class="form-control" name="integer" placeholder="Quantity" '+
                            'onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">'+
                        '</div>' +
                        '<div class="col-sm-12">'+
                            '<label>Product Price</label>'+
                            '<input type="number" step="any" id="e_edited_amount" class="form-control"  value="' + truncate(sale_price, 2) + '" >'+
                        '</div>' +
                    '</div>');
            }

            $("#e_prod_img").remove();
            $(".e_initial_product_type_div").remove();
            
            // PRODUCT TYPE
            $("#e_prod_image_add_div").append('<div id="e_prod_img">'+
                    '<img class="img-responsive" src="/img/product-uploads/'+data['qproduct']['Product']['image'] + '">'+
                    '<input type="hidden" id="e_prdct_image" value="' + data['qproduct']['Product']['image'] + '"></div>' +
                    '<div class="e_initial_product_type_div form-group"><br/>'+
                        '<label>Product Type</label>'+
                        '<input type="text" readonly value="' + data['qproduct']['Product']['type'] + '" class="form-control" id="e_initial_prod_type">'+
                    '</div>');
            
            $(".e_add_prod_detail_div").remove();
            $(".e_product_details_div").append('<div class="row form-group e_add_prod_detail_div">'+
                    '<div class="col-sm-11" ></div>'+
                    '<div class="col-sm-1" align="right">'+
                        '<a class="btn btn-xs btn-primary" id="e_add_prod_detail_btn">'+
                            '<i class="fa fa-plus"></i>'+
                        '</a>'+
                    '</div>'+
                '</div>');

            $('#e_add_prod_detail_btn').click(function () {
                $(".e_product_type_div").remove();
                $(".e_initial_product_type_div").hide();
                var product_type = $("#e_initial_prod_type").val();
                if (product_type == 'supply') {
                    var new_type = 'combination';
                } else {
                    var new_type = $("#e_initial_prod_type").val();
                }

                $(".e_initial_product_type_div").hide();
                $("#e_prod_image_add_div").append('<div class="e_product_type_div form-group">'+
                        '<br/><label>Product Type</label>'+
                        '<input type="text" readonly value="' + new_type + '" class="form-control" id="e_prod_type">'+
                    '</div>');
                    //pero kapag tig remove yung newly added properties ng product dapat babalik sya sa supply

                $(".e_product_details_div").append('<div class="e_prod_details_new form-group">'+
                        '<div class="col-sm-5">'+
                            '<input type="text" class="form-control e_prop_name" placeholder="Property" />' +
                            '<input type="hidden">'+
                        '</div>' +
                        '<div class="col-sm-6">'+
                            '<input type="text" class="form-control e_prod_value" placeholder="Value" />' +
                            '<input type="hidden">'+
                        '</div>' +
                        '<div class="col-sm-1">'+
                            '<a class="btn btn-xs btn-danger e_deldetail_new">'+
                                '<i class="fa fa-minus"></i>'+
                            '</a>'+
                        '</div>'+
                    '</div>');

                $('.e_deldetail_new').each(function (index) {
                    $(this).click(function () {
                        $(this).closest(".e_prod_details_new").remove();
                        if ($('.e_deldetail_new').length == 0) {
                            $(".e_initial_product_type_div").show();
                            $(".e_product_type_div").remove();
                        }
                    });
                });
            });
        });
    });
});
    /*
     * Google Maps: Latitude-Longitude Finder Tool
     * http://salman-w.blogspot.com/2009/03/latitude-longitude-finder-tool.html
     */
    function loadmap() {
        ///////////////////////////////////////////////////////////////////
        ///// google map for billing address ////////////////////////////
        // initialize map
        var map = new google.maps.Map(document.getElementById("map-canvas"), {
            center: new google.maps.LatLng(14.71599, 121.042779),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        // initialize marker
        var marker = new google.maps.Marker({
            position: map.getCenter(),
            draggable: true,
            map: map
        });
        // intercept map and marker movements
        google.maps.event.addListener(map, "idle", function () {
            marker.setPosition(map.getCenter());
            //				document.getElementById("map-output").innerHTML = "Latitude:  " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6) + "  <a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank'>    View Map</a>";
//          document.getElementById("map-output").innerHTML = "<a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank' class='btn btn-warning'>    View Map</a>";

            $("#bill_latitude").val(map.getCenter().lat().toFixed(6));
            $("#bill_longitude").val(map.getCenter().lng().toFixed(6));

            /////////////////////////////////////////  

            var lat = map.getCenter().lat().toFixed(6);
            var lng = map.getCenter().lng().toFixed(6);

            var latlng = new google.maps.LatLng(lat, lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, function (results, status) {
                if (status !== google.maps.GeocoderStatus.OK) {
                    alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    //            console.log(results);
                    var address = (results[0].formatted_address);
                    // $("#bill_geolocation").val(address);
                    
                    $("#bill_geolocation_newest").val(address);
                    //                                                console.log(address);
                }
            });
            /////////////////////////////////////////////////////

        });
        google.maps.event.addListener(marker, "dragend", function (mapEvent) {
            map.panTo(mapEvent.latLng);
        });
        //   	// initialize geocoder
        var geocoder = new google.maps.Geocoder();
        google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function () {
            geocoder.geocode({
                address: document.getElementById("search-txt").value
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var result = results[0];
                    document.getElementById("search-txt").value = result.formatted_address;
                    document.getElementById("bill_geolocation").value = result.formatted_address;
                    $("#address").val(result.formatted_address);
                    if (result.geometry.viewport) {
                        map.fitBounds(result.geometry.viewport);
                    } else {
                        map.setCenter(result.geometry.location);
                    }
                } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                    alert("Sorry, geocoder API failed to locate the address.");
                } else {
                    alert("Input Address to search.");
                }
            });
        });
        //   	google.maps.event.addDomListener(document.getElementById("search-txt"), "keydown", function(domEvent) {
        //   		if (domEvent.which === 13 || domEvent.keyCode === 13) {
        //   			google.maps.event.trigger(document.getElementById("search-btn"), "click");
        //   		}
        //   	});
        // initialize geolocation
        if (navigator.geolocation) {
            google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function () {
                navigator.geolocation.getCurrentPosition(function (position) {
                    map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                }, function () {
                    alert("Sorry, geolocation API failed to detect your location.");
                });
            });
            document.getElementById("detect-btn").disabled = false;
        }

    }

</script> 
<script>
    $("#client_industry_id").select2({
        placeholder: "Select Industry",
        width: '100%',
        allowClear: false
    });
    $("#div_swatches").hide();
    $("div.prod_other_info_div").hide();
    
    $("#select_swatches").select2({
        placeholder: "Select Product Code",
        width: '100%',
        allowClear: false
    });
    
    
    
    $("#e_div_swatches").hide();
    $("div.e_prod_other_info_div").hide();
    
    $("#e_select_swatches").select2({
        placeholder: "Select Product Code",
        width: '100%',
        allowClear: false
    });

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
<script>
    $(document).ready(function () {
        $('#saveProduct').click(function () {
            $('#saveProduct').prop("disabled", true);
            if ($('.deldetail_new').length == 0) {
                var type = $('#initial_prod_type').val();
            } else {
                var type = $('#prod_type').val();
            }

            var quotation_id = $("#quotation_id").val();
            var product_id = $("#product_id").val();
            var image = $('#prdct_image').val();
            var price = $('#prod_amount').val();
            var qty = $('#prod_quantity').val();
            var other_info = tinyMCE.get('other_info').getContent();
            var edited_amount = $('#edited_amount').val();
            var sale = $('#sale').val();
            var installation_charge = $('#installation_charge').val();
            var delivery_charge = $('#delivery_charge').val();
            var discount = $('#discount').val();

            var property = [];
            $('.prop_name').each(function (index) {
                property.push($(this).val());
            });
            var value = [];
            $('.prod_value').each(function (index) {
                value.push($(this).val());
            });
            $('.prop_id').each(function (index) {
                property.push($(this).val());
            });
            $('.prod_value_id').each(function (index) {
                value.push($(this).val());
            });

            var swatch = $("#select_swatches option:selected").text();
            if (product_id != "") {
                if(property.length==0) {
                    swal({
                        title: "Oops!",
                        text: "Properties and values cannot be empty.\n"+
                              "Please enter properties and values and try again.",
                        type: "warning"
                    });
                    
                    $('#saveProduct').removeAttr('disabled');
                }
                else {
                    if (qty != "") {
                        var data = {"quotation_id": quotation_id,
                            "product_id": product_id,
                            "image": image,
                            "qty": qty,
                            "price": price,
                            "other_info": other_info,
                            "edited_amount": edited_amount,
                            "sale": sale,
                            "swatch": swatch,
                            "property": property,
                            "value": value,
                            "type": type,
                            "installation_charge": installation_charge,
                            "delivery_charge": delivery_charge,
                            "discount": discount,
                        }
                        $.ajax({
                            url: "/quotation_products/saveProductQuotation",
                            type: 'POST',
                            data: {'data': data},
                            dataType: 'text',
                            success: function (dd) {
                                console.log(dd);
                                location.reload();
                            },
                            error: function (error) {
                                console.log(error);
                                
                                $('#saveProduct').removeAttr('disabled');
                            }
                        });
                    } else {
                        swal({
                            title: "Oops!",
                            text: "Quantity cannot be empty.\n"+
                                  "Please enter quantity and try again.",
                            type: "warning"
                        });
                        
                        $('#saveProduct').removeAttr('disabled');
                    }
                }
            } else {
                swal({
                    title: "Oops!",
                    text: "Quantity cannot be empty.\n"+
                          "Please select product code and try again.",
                    type: "warning"
                });
                
                $('#saveProduct').removeAttr('disabled');
            }
        });

        var sub_total = $('#sub_total').val();
        var installation_charge = parseFloat($('#installation_charge').val());
        var delivery_charge = $('#delivery_charge').val();
        var discount = $('#discount').val();
        var grand_total = parseFloat($('#sub_total').val()) + parseFloat($('#installation_charge').val()) + parseFloat($('#delivery_charge').val()) - parseFloat($('#discount').val());
            $('#grand_total').val(grand_total);
            
            
        $('#installation_charge, #delivery_charge , #discount').on('keyup', function (e) {
            if ($('#installation_charge').val().length == 0) {
                $("#installation_charge").val(0);
            } else {

            }

            if ($('#delivery_charge').val().length == 0) {
                $("#delivery_charge").val(0);
            } else {

            }

            if ($('#discount').val().length == 0) {
                $("#discount").val(0);
            } else {

            }

            var grand_total = parseFloat($('#sub_total').val()) + parseFloat($('#installation_charge').val()) + parseFloat($('#delivery_charge').val()) - parseFloat($('#discount').val());
            $('#grand_total').val(grand_total);

        });

        
        //delete added product
        $('.delete-added-product').each(function (index) {
            $(this).click(function () {
                var qp_id = $(this).data("delqprodid");
                var qid1 = $(this).data('quoteid');
                var installation_charge = $('#installation_charge').val();
                var delivery_charge = $('#delivery_charge').val();
                var discount = $('#discount').val();
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this product!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "/quotation_products/delete",
                            type: 'POST',
                            data: {'id': qp_id,
                                   'quote_id':qid1, 
                                   'grand_total':grand_total,
                                   'sub_total':sub_total,
                                   'delivery_charge': delivery_charge,
                                   'installation_charge': installation_charge,
                                   'discount': discount
                            },
                            dataType: 'text',
                            success: function (success) {
                                console.log("Success return:"+success);
                                location.reload();
                            },
                            error: function (error) {
                                console.log('Error return:'+JSON.stringify(error));
                                swal({
                                    title: "Oops!",
                                    text: "An error occurred. Please try again later.",
                                    type: "warning"
                                });
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
            });
        });

        $('.savePendingQuote').each(function (index) {
            $(this).click(function () {
            var button_type = $(this).data("buttontype");

            var delivery_mode = $("#delivery_mode").val();
            
            var bill_address = $("#input_bill_address").val();
            var bill_geolocation = $("#bill_geolocation").val();
            var bill_latitude = $("#bill_latitude").val();
            var bill_longitude = $("#bill_longitude").val();

            var isWithBillShip = "<?php echo $isWithBillShip; ?>"; 
            var isWithBill = "<?php echo $isWithBill; ?>";
            var isWithShip = "<?php echo $isWithShip; ?>";
            
        // ================================================================>
            var isAllowedToSend = true;
            if(delivery_mode=="deliver") {
                if(bill_geolocation==""
                   || bill_latitude==""
                   || bill_longitude=="") {
                       isAllowedToSend = false;
                }
            }
        // ================================================================>
            var sub_total = $('#sub_total').val();
            var installation_charge = $('#installation_charge').val();
            var delivery_charge = $('#delivery_charge').val();
            var discount = $('#discount').val();
            var grand_total = $('#grand_total').val();
            var terms_info = tinyMCE.get('terms').getContent();
            //let user select if quotation or fitout

            var id = $("#quotation_id").val();
            var type = $("#type").val();
            //get user role
                var usrRle = $("#myusrRole").val();
                if(usrRle === 'sales_executive'){
                    var status = "pending";//edited
                }else{
                    var status = "moved";//edited 
                }

            var data = {"sub_total": sub_total,
                "installation_charge": installation_charge,
                "delivery_charge": delivery_charge,
                "discount": discount,
                "grand_total": grand_total,
                "terms_info": terms_info,
                "type": type,
                "id": id,
                "status": status
            }
            if(delivery_mode=="deliver") {
                if(type!="") {
                    if($("#subject").val()!="") {
                        if($("#validity_date").val()!="") {
                            if($("#client_id").val()!=null && $("#client_id").val()!="") {
                                if($("#target_delivery").val()!="") {
                                    if(isAllowedToSend) {
                                        // alert('allowed to send');
                                        if(isWithBillShip==1) {
                                            // alert('isWithBillShip');
                                            $.ajax({
                                                url: "/quotations/edit",
                                                type: 'POST',
                                                data: {'data': data},
                                                dataType: 'json',
                                                success: function (dd) {
                                                    if (button_type == 'savenew') {
                                                        location.reload();
                                                    } else {
                                                        window.location.href = '/quotations/pending';
                                                    }
                                                },
                                                error: function (dd) {
                                                    console.log(dd);
                                                }
                                            });
                                        }
                                        else {
                                            if(isWithBill==1) {
                                                // alert('isWithBill');
                                                if(isWithShip==1) {
                                                    // alert('isWithShip');
                                                    $.ajax({
                                                        url: "/quotations/edit",
                                                        type: 'POST',
                                                        data: {'data': data},
                                                        dataType: 'json',
                                                        success: function (dd) {
                                                            if (button_type == 'savenew') {
                                                                location.reload();
                                                            } else {
                                                                window.location.href = '/quotations/pending';
                                                            }
                                                        },
                                                        error: function (dd) {
                                                            console.log(dd);
                                                        }
                                                    });
                                                }
                                                else {
                                                    swal({
                                                        title: "Oops!",
                                                        text: "Shipping Address is required.\n"+
                                                              "Please add shipping address and try again.",
                                                        type: "warning"
                                                    });
                                                }
                                            }
                                            else {
                                                swal({
                                                    title: "Oops!",
                                                    text: "Billing Address is required.\n"+
                                                          "Please add billing address and try again.",
                                                    type: "warning"
                                                });
                                            }
                                        }
                                    }
                                    else {
                                        swal({
                                            title: "Oops!",
                                            text: "Billing / shipping adress cannot be empty.\n"+
                                                  "Please add Billing / shipping adress and try again.",
                                            type: "warning"
                                        }); 
                                    }
                                }
                                else {
                                    swal({
                                        title: "Oops!",
                                        text: "Tentative delivery or pickup date cannot be empty.\n"+
                                              "Please add delivery or pickup date and try again.",
                                        type: "warning"
                                    }); 
                                }
                            }
                            else {
                                swal({
                                    title: "Oops!",
                                    text: "Client cannot be empty.\n"+
                                          "Please add client and try again.",
                                    type: "warning"
                                });
                            }
                        }
                        else {
                            swal({
                                title: "Oops!",
                                text: "Validity date cannot be empty.\n"+
                                      "Please add validity date and try again.",
                                type: "warning"
                            }); 
                        }
                    }
                    else {
                        swal({
                            title: "Oops!",
                            text: "Subject cannot be empty.\n"+
                                  "Please add subject and try again.",
                            type: "warning"
                        }); 
                    }
                }
                else {
                    swal({
                        title: "Oops!",
                        text: "Type cannot be empty.\n"+
                              "Please add type and try again.",
                        type: "warning"
                    });
                }
            }
            else {
                // ====> Pickup
                // alert($("#client_id").val());
                if(type!="") {
                    if($("#subject").val()!="") {
                        if($("#validity_date").val()!="") {
                            if($("#client_id").val()!=null && $("#client_id").val()!="") {
                                if($("#target_delivery").val()!="") {
                                    $.ajax({
                                        url: "/quotations/edit",
                                        type: 'POST',
                                        data: {'data': data},
                                        dataType: 'json',
                                        success: function (dd) {
                                            if (button_type == 'savenew') {
                                                location.reload();
                                            } else {
                                                window.location.href = '/quotations/pending';
                                            }
                                        },
                                        error: function (dd) {
                                            console.log(dd);
                                        }
                                    });
                                }
                                else {
                                    swal({
                                        title: "Oops!",
                                        text: "Tentative delivery or pickup date cannot be empty.\n"+
                                              "Please add delivery or pickup date and try again.",
                                        type: "warning"
                                    }); 
                                }
                            }
                            else {
                                swal({
                                    title: "Oops!",
                                    text: "Client cannot be empty.\n"+
                                          "Please add client and try again.",
                                    type: "warning"
                                });
                            }
                        }
                        else {
                            swal({
                                title: "Oops!",
                                text: "Validity date cannot be empty.\n"+
                                      "Please add validity date and try again.",
                                type: "warning"
                            }); 
                        }
                    }
                    else {
                        swal({
                            title: "Oops!",
                            text: "Subject cannot be empty.\n"+
                                  "Please add subject and try again.",
                            type: "warning"
                        }); 
                    }
                }
                else {
                    swal({
                        title: "Oops!",
                        text: "Type cannot be empty.\n"+
                              "Please add type and try again.",
                        type: "warning"
                    });
                }
            }
        });
        });

        $('#type').on('change', function (e) {
            var value = $("#type").val();
            var id = $("#quotation_id").val();
            var Qfield = 'type';
            var data = {"id": id,
                "value": value,
                "Qfield": Qfield
            }
            saveProcess(data);
        });
        
        $('#openJobRequest').on('click', function (e) {
            var jrID = $(this).data('id');
            window.location.href = '/job_requests/view_jr?id='+jrID;            
        })

        $('#jobRequestBtn').on('click', function (e) {
            $("#jobRequestBtn").prop("disabled", true);
            var date = new Date();
            var month = date.getMonth();
            var number = (Math.random() + ' ').substring(2, 5) + (Math.random() + ' ').substring(2, 5);
            var quotation_id = $("#quotation_id").val();
            var status = 'pending';
            var jr_number = 'JECJR-' + month + number;
            $.ajax({
                url: "/job_requests/saveNewJobRequest_newtbl",
                type: 'POST',
                data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id},
                dataType: 'text',
                success: function (dd) {
                    location.reload();
                },
                error: function (dd) {
                    console.log(dd);
                }
            });
        });
        
        $('.cancelQuote').each(function (index) {
            $(this).click(function () {
                window.location.href = '/quotations/pending';
            });
        });
    });
    
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    
    function truncate(num, places) {
        return Math.trunc(num * Math.pow(10, places)) / Math.pow(10, places);
    }
</script>
<script>
    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//
function saveProcess(data) {
//    
    $.ajax({
        url: "/quotations/saveCreateQuotation",
        type: 'POST',
        data: {'data': data},
        dataType: 'json',
        success: function (dd) {
            if (data.Qfield == 'delivery_mode') {
                location.reload();
            } else {
                console.log(data);
            }

        },
        error: function (dd) {
            console.log(dd);
        }
    });
}

$(document).ready(function () {


    var date = new Date();
    date.setDate(date.getDate() - 1);
    $("#product_id").select2({
        placeholder: "Select Product Code",
        width: '100%',
        allowClear: false
    });
    $("#client_id").select2({
        placeholder: "Select Client Name",
        allowClear: true
    });

    $('#datePicker')
            .datepicker({
                format: 'yyyy-mm-dd',
                startDate: date,
                endDate: '+1m'
            });
    $('#datePicker-pickup')
            .datepicker({
                format: 'yyyy-mm-dd',
                startDate: date,
            });
    $('#datePicker-deliver')
            .datepicker({
                format: 'yyyy-mm-dd',
                startDate: date,
            });


    ///// validity_date /////
    $('#validity_date').on('change', function (e) {
        var value = $("#validity_date").val();
        var id = $("#quotation_id").val();
        var Qfield = 'validity_date';

        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });




    ///// CLIENT ///// 
    $("#client_id").change(function () {
        $(".oldInfo").remove();
        $(".cInfo").remove();
        var id = $("#client_id").val();
        $.get('/clients/my_client_info', {
            id: id,
        }, function (data) {
            $(".client_info").append('<div class="form-group cInfo">' +
                    '<div class="col-sm-6">' +
                        '<label class="control-label">Contact Person</label>' +
                        '<input type="text" class="form-control" readonly id="contact_person" value="' + data['contact_person'] + '">' +
                    '</div>' +
                    '<div class="col-sm-6">' +
                        '<label class="control-label">Contact Number</label>' +
                        '<input type="text" class="form-control" readonly id="contact_number" value="' + data['contact_number'] + '">' +
                    '</div>' +
                    '<div class="col-sm-12">' +
                        '<label class="control-label">Address</label>' +
                        '<input type="text" class="form-control" readonly id="address" value="' + data['address'] + '">' +
                    '</div>' +
                '</div>');
        });

        var value = $("#client_id").val();
        var id = $("#quotation_id").val();
        var Qfield = 'client_id';

        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });
    /// DELIVERY MODE ///  
    $("#delivery_mode").change(function () {
        var delivery_mode = $("#delivery_mode").val();
        var id = $("#quotation_id").val();

        $("#addresses").hide();
        if (delivery_mode == 'pickup') {
            $("#addresses").hide();
        } else if (delivery_mode == 'deliver') {
            $("#addresses").show();
        } else {
            $("#addresses").hide();
        }

        var data = {"id": id,
            "value": delivery_mode,
            "Qfield": 'delivery_mode'
        }

        saveProcess(data);

    });


    $('#target_delivery').on('change', function (e) {
        var value = $("#target_delivery").val();
        var id = $("#quotation_id").val();
        var Qfield = 'target_delivery';
        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });



////////// BILLING and SHIPPING ADDRESS ///////

    $("#bill_ship_save").click(function () {
        var id = $("#quotation_id").val();
        var address = $("#input_bill_address").val();
        var geolocation = $("#bill_geolocation").val();
        var latitude = $("#bill_latitude").val();
        var longitude = $("#bill_longitude").val();
        var type = 'bill_ship';

        var data = {"id": id,
            "address": address,
            "geolocation": geolocation,
            "latitude": latitude,
            "longitude": longitude,
            "type": type
        }
        saveBillingShipping(data);
    });

    $("#bill_save").click(function () {
        var id = $("#quotation_id").val();
        var address = $("#input_bill_address").val();
        var geolocation = $("#bill_geolocation").val();
        var latitude = $("#bill_latitude").val();
        var longitude = $("#bill_longitude").val();
        var type = 'bill';

        var data = {"id": id,
            "address": address,
            "geolocation": geolocation,
            "latitude": latitude,
            "longitude": longitude,
            "type": type
        }
        saveBillingShipping(data);
    });

    $("#ship_save").click(function () {
        var id = $("#quotation_id").val();
        var address = $("#input_bill_address").val();
        var geolocation = $("#bill_geolocation").val();
        var latitude = $("#bill_latitude").val();
        var longitude = $("#bill_longitude").val();
        var type = 'ship';

        var data = {"id": id,
            "address": address,
            "geolocation": geolocation,
            "latitude": latitude,
            "longitude": longitude,
            "type": type
        }
        saveBillingShipping(data);
    });


    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function truncate(num, places) {
        return Math.trunc(num * Math.pow(10, places)) / Math.pow(10, places);
    }


    // ------------------------PRODUCT------------------------------------------
    $("#product_id").change(function () {
        $("#div_swatches").show();
        $("div.prod_other_info_div").show();
        
        $(".prod_details").remove();
        var id = $("#product_id").val();
        $.get('/quotations/product_info', {
            id: id,
        }, function (data) {
            console.log(data);
            
            var i;
            var v;
            var prod_property = data['ProductProperty'];
            var prod_amount = 0;
            var prod_amount_default = 0;

            for (i = 0; i < prod_property.length; i++) {
                var prod_value = data['ProductProperty'][i]['ProductValue'];
                for (v = 0; v < prod_value.length; v++) {
                    prod_amount = prod_amount + parseFloat(prod_value[v]['price']);
                    if(prod_value[v]['default']==1){
                         prod_amount_default = prod_amount_default + parseFloat(prod_value[v]['price']);
                    }
                    
                    $(".product_details_div").append('<div class="row form-group prod_details"><div class="col-sm-5">'+
                            '<input type="text" class="form-control prop_id" value="' + prod_property[i]['name'] + '" readonly>' +
                            // '<input type="hidden" class="prop_id" value="' + prod_property[i]['id'] + '">'+
                        '</div>' +
                        '<div class="col-sm-6"><input type="text" class="form-control prod_value_id" value="' + prod_value[v]['value'] + '" readonly>' +
                            // '<input type="hidden" class="prod_value_id" value="' + prod_value[v]['id'] + '">'+
                        '</div>' +
                        '<div class="col-sm-1" style="padding:5px 5px 5px 5px;"><a class="btn btn-xs btn-danger deldetail" > <i class="fa fa-minus"></i> </a></div>' +
                            '<input type="hidden" class="prod_value_price" value="' + prod_value[v]['price'] + '"></div>' +
                        '</div>');
                }
            }

            $('.deldetail').each(function (index) {
                $(this).click(function () {
                    //should update price upon removing specific value 
                    $(this).closest(".prod_details").remove();

                    if (data['Product']['sale_price'] == 0) {
                        var total_price = 0;
                        if ($(".prod_value_price").length >= 1) {
                            $(".prod_value_price").each(function () {
                                total_price = total_price + parseFloat($(this).val());
                                $("#edited_amount").val(total_price);
                                $("#view_amount").val(total_price);
                                $("#prod_amount").val(total_price);
                            });
                        } else {
                            
                            $("#edited_amount").val(prod_amount_default);
                                $("#view_amount").val(prod_amount_default); 
                            $("#prod_amount").val(prod_amount_default);
                        }
                    }
                });
            });

            // TEXTAREA
             tinymce.get('other_info').setContent(data['Product']['other_info']);

            $("#prod_amount_info").remove();
            if (data['Product']['sale_price'] == 0) {
                //total of all product values
                $(".prod_amount_div").append('<div class="row" id="prod_amount_info">'+
                        '<input type="hidden" id="sale" value="0"/>'+
                        '<div class="col-sm-6">' +
                            '<div class="input-group mar-btm">' +
                                '<span class="input-group-btn">' +
                                '<button class="btn btn-default" disabled> Php</button> </span> ' +
                                '<input class="form-control" id="view_amount"  value="' + addCommas(truncate(prod_amount, 2)) + '" readonly>' +
                                '<input  type="hidden" class="form-control" id="prod_amount" value="' + prod_amount + '" readonly>' +
                            '</div>' +
                        '</div>' + 
                        '<div class="col-sm-6">'+
                            '<input type="number" id="prod_quantity" class="form-control" name="integer" placeholder="Quantity" '+
                            'onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">'+
                        '</div>' +
                        '<div class="col-sm-12">'+
                            '<label>Product Price</label>'+
                            '<input type="number" step="any" id="edited_amount" class="form-control"  value="' + truncate(prod_amount, 2) + '" >'+
                        '</div>' +
                    '</div>');
            } else {
                var sale_price = parseFloat(data['Product']['sale_price']);
                $(".prod_amount_div").append('<div id="prod_amount_info">'+
                        '<input type="hidden" id="sale" value="1"/>'+
                        '<div class="col-sm-6">' +
                            '<div class="input-group mar-btm">' +
                                '<span class="input-group-btn">' +
                                '<button class="btn btn-default" disabled> Php</button> </span> ' +
                                '<input class="form-control"   value="' + addCommas(truncate(sale_price, 2)) + '" readonly>' +
                                '<input type="hidden" class="form-control" id="prod_amount" value="' + sale_price + '" readonly>' +
                                '<span class="input-group-btn">' +
                                '<button class="btn btn-warning" type="button" disabled> <i class="fa fa fa-gift"></i> Sale!</button> </span> ' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-6">'+
                            '<input type="number" id="prod_quantity" class="form-control" name="integer" placeholder="Quantity" '+
                            'onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">'+
                        '</div>' +
                        '<div class="col-sm-12">'+
                            '<label>Product Price</label>'+
                            '<input type="number" step="any" id="edited_amount" class="form-control"  value="' + truncate(sale_price, 2) + '" >'+
                        '</div>' +
                    '</div>');
            }

            $("#prod_img").remove();
            $(".initial_product_type_div").remove();
            
            // PRODUCT TYPE
            $("#prod_image_add_div").append('<div id="prod_img">'+
                    '<img class="img-responsive" src="/img/product-uploads/'+data['Product']['image'] + '">'+
                    '<input type="hidden" id="prdct_image" value="' + data['Product']['image'] + '"></div>' +
                    '<div class="initial_product_type_div form-group"><br/>'+
                        '<label>Product Type</label>'+
                        '<input type="text" readonly value="' + data['Product']['type'] + '" class="form-control" id="initial_prod_type">'+
                    '</div>');
            
            $(".add_prod_detail_div").remove();
            $(".product_details_div").append('<div class="row form-group add_prod_detail_div">'+
                    '<div class="col-sm-11" ></div>'+
                    '<div class="col-sm-1" align="right">'+
                        '<a class="btn btn-xs btn-primary" id="add_prod_detail_btn">'+
                            '<i class="fa fa-plus"></i>'+
                        '</a>'+
                    '</div>'+
                '</div>');

            $('#add_prod_detail_btn').click(function () {
                $(".product_type_div").remove();
                $(".initial_product_type_div").hide();
                var product_type = $("#initial_prod_type").val();
                if (product_type == 'supply') {
                    var new_type = 'combination';
                } else {
                    var new_type = $("#initial_prod_type").val();
                }

                $(".initial_product_type_div").hide();
                $("#prod_image_add_div").append('<div class="product_type_div form-group">'+
                        '<br/><label>Product Type</label>'+
                        '<input type="text" readonly value="' + new_type + '" class="form-control" id="prod_type">'+
                    '</div>');
                    //pero kapag tig remove yung newly added properties ng product dapat babalik sya sa supply

                $(".product_details_div").append('<div class="prod_details_new form-group">'+
                        '<div class="col-sm-5">'+
                            '<input type="text" class="form-control prop_name" placeholder="Property" />' +
                            '<input type="hidden">'+
                        '</div>' +
                        '<div class="col-sm-6">'+
                            '<input type="text" class="form-control prod_value" placeholder="Value" />' +
                            '<input type="hidden">'+
                        '</div>' +
                        '<div class="col-sm-1">'+
                            '<a class="btn btn-xs btn-danger deldetail_new">'+
                                '<i class="fa fa-minus"></i>'+
                            '</a>'+
                        '</div>'+
                    '</div>');

                $('.deldetail_new').each(function (index) {
                    $(this).click(function () {
                        $(this).closest(".prod_details_new").remove();
                        if ($('.deldetail_new').length == 0) {
                            $(".initial_product_type_div").show();
                            $(".product_type_div").remove();
                        }
                    });
                });
            });
        });
    });
    
    


    ///// PRODUCT END ///// 


}); ///// end of document ready

function saveSubject() {
    var subject = $("#subject").val();
    var id = $("#quotation_id").val();
    var Qfield = 'subject';

    var data = {"id": id,
        "value": subject,
        "Qfield": Qfield
    }

    saveProcess(data);
}

function saveBillingShipping(data) {
    $.ajax({
        url: "/quotations/saveAddressQuotation",
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
}
$('#saveLead').on("click", function(){  
   
  var name = $('#name').val();   
  var contact_person = $('#contact_person').val();   
  var position = $('#position').val();   
  var address = $('#address').val();   
  var email = $('#email').val();   
  var contact_number = $('#contact_number').val();   
  var tin_number = $('#tin_number').val();  
  var client_industry_id = $('#client_industry_id').val();   

if((name!="")){ 
    if(contact_person!=""){
        if(address!=""){
            if(email!=""){
                if(contact_number!=""){
                    if(client_industry_id!=""){
                            var data = { "name": name, 
                                "contact_person":contact_person,
                                "position":position,
                                "address":address,
                                "email":email,
                                "contact_number":contact_number,
                                "tin_number":tin_number, 
                                "client_industry_id":client_industry_id, 
                                "type":'client'
                            } 
                            $.ajax({
                                url: "/clients/add_leads",
                                type: 'POST', 
                                data: {'data': data},
                                dataType: 'json',
                                        success: function(id){
                                         location.reload();  	  
                                        },
                                        erorr: function(id){ 
                                            alert('error!');
                                        }
                             });
                    }else{
                        alert('Required Industry');
                    }
                }else{
                document.getElementById('contact_number').style.borderColor = "red"; 
                }
            }else{
                document.getElementById('email').style.borderColor = "red";
            }
        }else{
            document.getElementById('address').style.borderColor = "red";
        }
    }else{
        document.getElementById('contact_person').style.borderColor = "red";
    }
}else{ 
    document.getElementById('name').style.borderColor = "red";
}  
});
 
</script>