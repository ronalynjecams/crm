<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />-->

<link href="../css/sweetalert.css" rel="stylesheet">
<!--<link href="plugins/bootstrap-validator/bootstrapValidator.min.css" rel="stylesheet">-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>
<script src="../plugins/select2/js/select2.min.js"></script>   
    <!--<script src="plugins/masked-input/jquery.maskedinput.min.js"></script>-->
    <!--<script src="plugins/bootstrap-validator/bootstrapValidator.min.js"></script>-->
<script src="../js/erp_js/quotation.js"></script> 
<script src="../js/erp_js/erp_scripts.js"></script>  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="../js/sweetalert.min.js"></script>

<!--===================================================-->
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Create Quotation</h1>
    </div>
    <div id="page-content">  
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary savePendingQuote" data-buttontype="save" <?php
                    if (count($quote_products) == 0) {
                        echo 'disabled';
                    }
                    ?>>Save</button>
                    <button class="btn btn-info savePendingQuote" data-buttontype="savenew" <?php
                    if (count($quote_products) == 0) {
                        echo 'disabled';
                    }
                    ?>>Save and New</button>
                    <button class="btn btn-danger cancelQuote">Cancel</button> 
                </h3>
            </div>
        </div>
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
                                            ?>
                                            <div class="input-group mar-btm">
                                                <input type="text" class="form-control" placeholder="Name" readonly value="<?php echo $quote_data['JobRequest']['jr_number']; ?>">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-mint add-tooltip" data-toggle="tooltip"  data-original-title="View Job Request"  type="button"><i class="fa fa-external-link"></i></button>
                                                </span>
                                            </div>
                                            <?php
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
                                            <?php if ($quote_data['Quotation']['client_id'] != 0) { ?>
                                                <option value="<?php echo $quote_data['Quotation']['client_id']; ?>"><?php echo $quote_data['Client']['name']; ?></option>
                                                <?php
                                            } else {
                                                echo '<option></option>';
                                            }
                                            foreach ($clients as $client) {
                                                ?>
                                                <option value="<?php echo $client['Client']['id']; ?>"> <?php echo $client['Client']['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 client_info">
                                    <?php if ($quote_data['Quotation']['client_id'] != 0) { ?>
                                        <div class="form-group oldInfo">
                                            <div class="col-sm-6">
                                                <label class="control-label">Contact Person</label>
                                                <input type="text" class="form-control" readonly id="contact_persond" value="<?php echo $quote_data['Client']['contact_person']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label">Contact Number</label>
                                                <input type="text" class="form-control" readonly id="contact_numberd" value="<?php echo $quote_data['Client']['contact_number']; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
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
                        <?php if ($quote_data['Quotation']['delivery_mode'] == 'deliver') { ?>  
                            <?php if ($quote_data['Quotation']['bill_ship_address'] == 1) { ?> 
                                <div id="bill_ship_div"> 
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
                        <input type="text" class="form-control" placeholder="Building No. / Room No. / Floor No." id="bill_address"> 
                    </div>
                    <div class="form-group col-sm-6" align="center"> 
                        <input type="text" class="form-control" placeholder="Address here" id="bill_geolocation" readonly>
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
                                            ?> 
                                            <tr>
                                                <td ><?php echo $cnt; ?></td>
                                                <td ><?php echo $quote_prod['Product']['name']; ?></td>
                                                <td >
                                                    <ul class="list-group">
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
                                                <td><button class="btn btn-danger btn-icon btn-xs add-tooltip delete-added-product" data-delqprodid=<?php echo $quote_prod['QuotationProduct']['id']; ?> data-toggle="tooltip" data-original-title="Delete Item # <?php echo $cnt; ?>"><i class="fa fa-window-close "></i></button></td> 
                                            </tr> 


                                            <?php
                                            $cnt++;
                                            $sub_total = $sub_total + $quote_prod['QuotationProduct']['edited_amount'];
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
                                            <div class="form-group"><input type="number" step="any" id="installation_charge" class="form-control" value="0"></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Delivery Charge: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td>
                                            <div class="form-group"><input  type="number" step="any" id="delivery_charge" class="form-control" value="0" <?php
                                                if ($quote_data['Quotation']['delivery_mode'] != 'deliver') {
                                                    echo 'readonly';
                                                }
                                                ?>></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Discount: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <td>
                                            <div class="form-group"><input  type="number" step="any" id="discount" class="form-control" value="0"></div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Grand Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
                                        <td>
                                            <div class="form-group"><input type="text" id="grand_total" class="form-control" readonly></div> 
                                        </td>
                                    </tr>
                                </table> 
                                </div>
                            </div>



                        <?php } ?>
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

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary savePendingQuote" data-buttontype="save" <?php
                    if (count($quote_products) == 0) {
                        echo 'disabled';
                    }
                    ?>>Save</button>
                    <button class="btn btn-info savePendingQuote" data-buttontype="savenew" <?php
                    if (count($quote_products) == 0) {
                        echo 'disabled';
                    }
                    ?>>Save and New</button>
                    <button class="btn btn-danger cancelQuote">Cancel</button> 
                </h3>
            </div>
        </div>

        <!--===================================================-->
        <!--END CONTENT CONTAINER-->  
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
                <h4 class="modal-title">Add New Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <div class="form-group col-sm-12">
                                <select id="product_id" class="form-control"> 
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

<script type="text/javascript">
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
                    $("#bill_geolocation").val(address);
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
            var other_info = $('#other_info').val();
            var edited_amount = $('#edited_amount').val();
            var sale = $('#sale').val();


            var product_property_id = [];
            $('.prop_id').each(function (index) {
                var value = $(this).val();
                product_property_id.push(value);
            });

            var product_value_id = [];
            $('.prod_value_id').each(function (index) {
                var value = $(this).val();
                product_value_id.push(value);
            });


            var obj_ids = {};

            for (var i = 0, len = product_property_id.length; i < len; i++) {
                obj_ids[product_property_id[i]] = product_value_id[i];
            }

            var property = [];
            $('.prop_name').each(function (index) {
                property.push($(this).val());
            });
            var value = [];
            $('.prod_value').each(function (index) {
                value.push($(this).val());
            });


            var obj = {};

            for (var i = 0, len = property.length; i < len; i++) {
                obj[property[i]] = value[i];
            }


            if (product_id != "") {
                if (qty != "" && qty >= 1) {
                    var data = {"quotation_id": quotation_id,
                        "product_id": product_id,
                        "image": image,
                        "qty": qty,
                        "price": price,
                        "other_info": other_info,
                        "edited_amount": edited_amount,
                        "sale": sale,
                        "product_property_id": product_property_id,
                        "product_value_id": product_value_id,
                        "property": property,
                        "value": value,
                        "type": type,
                        "obj": obj,
                        "obj_ids": obj_ids
                    }
                    $.ajax({
                        url: "/quotation_products/saveProductQuotation",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        success: function (dd) {
                            location.reload();
//                        console.log(dd);
                        },
                        error: function (dd) {
                            console.log(dd);
                        }
                    });
                } else {
                    swal("Please indicate quantity.");
                }
            } else {
                swal("Please select product code.");
            }


        });

        //delete added product
        $('.delete-added-product').each(function (index) {
            $(this).click(function () {
                var qp_id = $(this).data("delqprodid");
//                alert(qp_id);


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
                                    data: {'id': qp_id},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();
                                    },
                                    error: function (dd) {
                                        location.reload();
                                    }
                                });
                            } else {
                                swal("Cancelled", "", "error");
                            }
                        });
            });
        });

        var sub_total = $('#sub_total').val();
        var installation_charge = parseFloat($('#installation_charge').val());
        var delivery_charge = $('#delivery_charge').val();
        var discount = $('#discount').val();
        $('#grand_total').val(sub_total);

        $('#installation_charge, #delivery_charge , #discount').on('keyup', function (e) {

            var grand_total = parseFloat($('#sub_total').val()) + parseFloat($('#installation_charge').val()) + parseFloat($('#delivery_charge').val()) - parseFloat($('#discount').val());
            $('#grand_total').val(grand_total);

        });


        $('.savePendingQuote').each(function (index) {
            $(this).click(function () {
                var button_type = $(this).data("buttontype");

                var sub_total = $('#sub_total').val();
                var installation_charge = $('#installation_charge').val();
                var delivery_charge = $('#delivery_charge').val();
                var discount = $('#discount').val();
                var grand_total = $('#grand_total').val();
                var terms_info = $('#terms').val();
//let user select if quotation or fitout

                var id = $("#quotation_id").val();
                var type = $("#type").val();
                var status = "pending";

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

        $('#jobRequestBtn').on('click', function (e) {

            swal({
                title: "Are you sure?",
                text: "Job request will be also be created for this quotation",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $("#jobRequestBtn").prop("disabled", true);
                            var date = new Date();
                            var month = date.getMonth();
                            var number = (Math.random() + ' ').substring(2, 5) + (Math.random() + ' ').substring(2, 5);
                            var quotation_id = $("#quotation_id").val();
                            var status = 'pending';
                            var jr_number = 'JECJR-' + month + number;
                            $.ajax({
                                url: "/job_requests/saveNewJobRequest",
                                type: 'POST',
                                data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id},
                                dataType: 'json',
                                success: function (dd) {
                                    location.reload();
                                },
                                error: function (dd) {
                                    console.log(dd);
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });

        });











        //delete added product
        $('.cancelQuote').each(function (index) {
            $(this).click(function () {
//                var qp_id = $(this).data("delqprodid");
//                alert(qp_id);

                var id = $("#quotation_id").val();
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this quotation!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, cancel quotation!",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    url: "/quotations/delete",
                                    type: 'POST',
                                    data: {'id': id},
                                    dataType: 'json',
                                    success: function (dd) {
                                        window.location.href = '/quotations/pending';
                                    },
                                    error: function (dd) {
                                        location.reload();
                                    }
                                });
                            } else {
                                swal("Cancelled", "", "error");
                            }
                        });
            });
        });

    });





</script>