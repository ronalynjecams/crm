<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        height: 50,
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

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo ucwords($status); ?> Request Materials</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title"> 
                    <button class="btn btn-sm btn-mint additional_po_product add-tooltip" 
                            data-toggle="tooltip"  data-original-title="Request Raw Material" 
                            data-qprdctid="0"  ><i class="fa fa-plus"></i> Add New Request
                    </button>
                </h3>  
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date of Request</th>
                            <th>Date Needed</th>
                            <th>Client <br/><small>Requested By</small></th> 
                            <th>Job Request Product</th> 
                            <th>Requested Product</th> 
                            <th>Product Properties</th> 
                            <th>Quantity</th> 
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date of Request</th>
                            <th>Date Needed</th>
                            <th>Client <br/><small>Requested By</small></th> 
                            <th>JR Product</th> 
                            <th>Requested Product</th> 
                            <th>Product Properties</th> 
                            <th>Quantity</th> 
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
//                        pr($requests[0]['PoRawRequest']['PoRawRequestProperty']);      
                        foreach ($requests as $request) {
//                            pr($request['PoRawRequestProperty']);
                            ?> 
                            <tr>
                                <td>
                                    <?php echo $request['PoRawRequest']['id'];
                                    echo time_elapsed_string($request['PoRawRequest']['created']);
                                    echo '<br/><small>' . date('h:i a', strtotime($request['PoRawRequest']['created'])) . '</small>';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($request['PoRawRequest']['date_needed']));
                                    echo '<br/><small>' . date('h:i a', strtotime($request['PoRawRequest']['date_needed'])) . '</small>';
                                    ?> 
                                </td>
                                <td> <?php
                                    if ($request['PoRawRequest']['quotation_product_id'] != 0) {
                                        $client_name = "<font class='text-danger'>Not Specified</font>";
                                        if(array_key_exists('Quotation', $request['QuotationProduct'])) {
                                            if(array_key_exists('Client', $request['QuotationProduct']['Quotation'])) {
                                                $client_name = $request['QuotationProduct']['Quotation']['Client']['name'];
                                            }
                                        }
                                        echo ucwords($client_name);
                                    } else {
                                        echo 'none';
                                    }
                                    echo '<br/><small>' . $request['User']['first_name'] . '</small>';
                                    ?>  </td> 
                                <td> <?php
                                    if ($request['PoRawRequest']['quotation_product_id'] != 0) {
                                        $product_name = "<font class='text-danger'>Unknown</font>";
                                        if(array_key_exists('QuotationProduct', $request['JrProduct'])) {
                                            if(array_key_exists('Product', $request['QuotationProduct'])) {
                                                $product_name_tmp = $request['JrProduct']['QuotationProduct']['Product']['name'];
                                                if($product_name_tmp!="") {
                                                    $product_name = $product_name_tmp;
                                                }
                                            }
                                        }
                                        
                                        echo $product_name;
                                    }
                                    ?>  </td>  
                                <td> <?php echo $request['Product']['name']; ?>  </td> 
                                <td>
                                    <?php 
                                        echo "<p>";
                                        foreach($request['PoRawRequestProperty'] as $rawprop){
                                            echo $rawprop['property'].':'.$rawprop['value'].'<br/> ';
                                        }
                                        echo "</p>";
                                        
                                        if(!empty($request['Product'])) {
                                            if($request['Product']['other_info']!="") {
                                                echo "<p><b>Other Info:</b><p>".$request['Product']['other_info']."</p></p>";
                                            }
                                        }
                                    ?>
                                </td> 
                                <td> <?php echo abs($request['PoRawRequest']['processed_qty']) . '/' . abs($request['PoRawRequest']['qty']); ?>  </td> 
                                <td>  
                                    <?php 
                                    $date_processed = "";
                                    if(!is_null($request['PoRawRequest']['date_processed'])){ 
                                        $date_processed = date('F d, Y', strtotime($request['PoRawRequest']['date_processed'])).'<br/><small>' . date('h:i a', strtotime($request['PoRawRequest']['date_processed'])) . '</small>';  
                                    }  
                                    
                                    
                                    if($userRole != 'accounting_head'){
                                        if ($status == 'approved' || $status == 'processed' ) {  ?>
                                            <button class="btn btn-sm btn-primary set_supplier"
                                                    data-client="<?php echo $request['PoRawRequest']['client_id']; ?>"
                                                    data-quotationid="<?php echo $request['PoRawRequest']['quotation_id']; ?>"
                                                    data-porawrequestid="<?php echo $request['PoRawRequest']['id']; ?>"
                                                    data-porawrequestqty="<?php echo $request['PoRawRequest']['processed_qty']; ?>"
                                                    data-rawquoteprodid="<?php echo $request['PoRawRequest']['quotation_product_id']; ?>">Select Supplier</button>
                                            <!--<button class="btn btn-sm btn-warning warehouse_product_btn add-tooltip" data-toggle="tooltip"  data-original-title="Get Product From Warehouse" data-qprdctids="<?php echo $request['PoRawRequest']['id']; ?>" data-qprdctqty="<?php echo $request['PoRawRequest']['qty']; ?>"><i class="fa fa-cubes"></i></button>-->
                                            <button class="btn btn-sm btn-warning inventory_product_btn add-tooltip"
                                            data-toggle="tooltip"  data-original-title="Get Product From Inventory"
                                            data-porawrequestids="<?php echo $request['PoRawRequest']['id']; ?>"
                                            data-porawrequestclients="<?php echo $request['PoRawRequest']['client_id']; ?>"
                                            data-porawrequestquotationids="<?php echo $request['PoRawRequest']['quotation_id']; ?>"
                                            data-porawrequestqtys="<?php echo $request['PoRawRequest']['processed_qty']; ?>" 
                                            data-rawquoteprodids="<?php echo $request['PoRawRequest']['quotation_product_id']; ?>"><i class="fa fa-cubes"></i></button>
                                            <?php
                                        } else {
    
                                            echo $date_processed; 
                                        }
                                    }else{
                                        if ($status == 'pending') {
                                        ?>
                                        <button class="btn btn-danger btn-icon add-tooltip approve_po_raw_request" data-toggle="tooltip" data-original-title="Approve Request?" data-porawrequestid="<?php echo $request['PoRawRequest']['id']; ?>" data-usr="accounting">Approve</button>
                             
                                        <?php
                                        }else{
                                            
                                            echo $date_processed; 
                                        }
                                    }
                                    
                                    ?>

                                </td> 
                            </tr> 
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<div class="modal fade" id="set-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
            <!--Modal header-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">-->
<!--                    <i class="pci-cross pci-circle"></i>-->
<!--                </button>-->
<!--                <h4 class="modal-title">Create PO for Product</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <div class="row"> -->
<!--                    <input type="hidden" id="sup_pid"/>    -->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label" id="labelSupplier">Select Supplier</label> -->
<!--                            <select id="selected_supplier" class="form-control" style="width: 100%;"> -->
<!--                                <option>Select Supplier</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div> -->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label" id="labelSupplier">Select Product Supplier</label> -->
<!--                            <select id="selected_product_supplier" class="form-control" style="width: 100%;"> -->
<!--                                <option>Select Product Supplier</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div> -->
<!--                    <div class="col-sm-12">-->
<!--                        <div id="product_supplier_properties_div">-->
<!--                            <h4 align="center">Available product</h4>-->
<!--                            <div class="col-sm-12">-->
<!--                                <div class="col-sm-1">-->
<!--                                </div>-->
<!--                                <div class="col-sm-4" align="center"><b> Property </b></div>-->
<!--                                <div class="col-sm-4" align="center"><b> Value </b></div>-->
<!--                                <div class="col-sm-2"> Quantity </div> <div class="col-sm-2"> </div>-->
<!--                                <div class="col-sm-1">-->
<!--                                </div>-->
<!--                            </div>     -->
<!--                        </div>-->

<!--                    </div> -->
<!--                </div>-->
<!--            </div> -->
<!--            <div class="modal-footer">-->
<!--                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>-->
<!--                <button class="btn btn-primary" id="savesetSupplier">Add</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->



<!--<div class="modal fade" id="warehouse_product_modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-lg">-->
<!--        <div class="modal-content">-->
            <!--Modal header-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">-->
<!--                    <i class="pci-cross pci-circle"></i>-->
<!--                </button>-->
<!--                <h4 class="modal-title">Select Product From Inventory</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <div class="row">-->
<!--                    <div class="col-sm-12">-->
<!--                        <input type="text" id="po_raw_qty" />-->
<!--                        <input type="text" id="po_raw_id" />-->
                        <!--<div class="col-sm-8">-->
<!--                        <div class="form-group col-sm-6">-->
<!--                            <select id="inv_location_id" class="form-control"> -->
<!--                                <option> -- select location --</option>-->
<!--                                <?php foreach ($locations as $location) { ?>-->
<!--                                    <option value="<?php echo $location['InvLocation']['id']; ?>"> <?php echo $location['InvLocation']['name']; ?></option>-->
<!--                                <?php } ?>-->
<!--                            </select>-->
<!--                        </div> -->
<!--                        <div class="form-group col-sm-6">-->
<!--                            <select id="prod_inv_location_id" class="form-control"> -->
<!--                                <option> -- select product --</option> -->
<!--                            </select>-->
<!--                        </div> -->
<!--                        <div class="col-sm-12"><div id="prod_inv_location_prop"><h4 align="center">Available product</h4>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="col-sm-1">-->
<!--                                    </div>-->
<!--                                    <div class="col-sm-3" align="center"><b> Property </b></div>-->
<!--                                    <div class="col-sm-3" align="center"><b> Value </b></div>-->
<!--                                    <div class="col-sm-2"> Quantity </div> <div class="col-sm-2"> </div>-->
<!--                                    <div class="col-sm-1">-->
<!--                                    </div>-->
<!--                                </div>     -->
<!--                            </div></div>-->


<!--                        <div class="col-sm-4">-->
<!--                            <div class="border" id="prod_image_add_div"> </div>-->
<!--                        </div> -->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <!--Modal footer-->
<!--            <div class="modal-footer">-->
<!--                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>-->
<!--                <button class="btn btn-primary" id="saveInventorySourceBtn" disabled>Add</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->



<!--CREATE PURCHASE ORDER MODAL START-->
<div class="modal fade" id="purchase-order-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Create Purchase Order</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="quote_product_id"/>   
                    <input type="hidden" id="po_raw_request_id"/>   
                    <input type="hidden" id="po_raw_request_qty"/>  
                    <input type="hidden" id="po_raw_request_client_id"/>  
                    <input type="hidden" id="po_raw_request_quotation_id"/>    
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
                    <div class="col-sm-6"id="rqrd_fld"></div>

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
                    <!--<input type="hidden" id="inv_quote_product_id"/>    -->
                    <input type="hidden" id="inv_quote_product_id"/>   
                    <input type="hidden" id="inv_po_raw_request_id"/>   
                    <input type="hidden" id="inv_po_raw_request_qty"/> 
                    <input type="hidden" id="inv_po_raw_request_client_id"/> 
                    <input type="hidden" id="inv_po_raw_request_quotation_id"/> 
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


<!--===================================================-->
<!--Add New Raw Materials Modal Start-->
<!--===================================================--> 
<div class="modal fade" id="addProductModal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Raw Materials</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="client_id" class="form-control">
                                <option>---- Select Client ----</option>
                                <?php
                                foreach($get_clients as $ret_clients) {
                                    $client_obj = $ret_clients['Client'];
                                    $client_id = $client_obj['id'];
                                    $client_name = ucwords(strtolower($client_obj['name']));
                                    
                                    if($client_name!="") {
                                        echo '
                                        <option value="'.$client_id.'">'.$client_name.'</option>
                                        ';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="div_product_id" hidden>
                            <select id="product_id" class="form-control"> 
                                <option>---- Select Product ----</option>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['Product']['id']; ?>"> <?php echo ucwords($product['Product']['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <div class="product_details_div"></div>
                        </div> 
                        <div class="form-group">
                            <div id="prod_exp"></div>
                        </div>  
                        
                        <div class="form-group" id="div_select_requestor" hidden>
                            <select id="select_requestor" class="form-control">
                                <option>---- Select Requestor</option>
                                <?php
                                foreach($get_users as $ret_users) {
                                    $user_obj = $ret_users['User'];
                                    $uid = $user_obj['id'];
                                    $fname = $user_obj['first_name'];
                                    $lname = $user_obj['last_name'];
                                    
                                    echo '
                                    <option value="'.$uid.'">'.$fname.' '.$lname.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>          
                    <div class="col-sm-4">
                        <div class="border" id="prod_image_add_div"> </div>
                    </div>
                    <div class="col-sm-12" id="div_ta_purpose" hidden>
                        <textarea id="ta_purpose"></textarea>
                    </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveProduct" disabled>Add</button>
            </div>
        </div>
    </div>
</div>
<!--END OF NEW MATERIALS MODAL-->

<script>
$(document).ready(function () {
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

    $('#example').DataTable({
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
        "order": [[0, "asc"]],
        "stateSave": true
    });
    
    $("#product_id").select2({
        placeholder: "---- Select Product ----",
        width: '100%',
        allowClear: false
    });
    
    $("#client_id").select2({
        placeholder: "---- Select Client ----",
        width: '100%',
        allowClear: false
    });
    
    $("#select_requestor").select2({
        placeholder: "---- Select Requestor ----",
        width: '100%',
        allowClear: false
    });

    $("#client_id").on('change', function() {
        $("#div_product_id").show();
        $("#div_ta_purpose").show();
        $("#div_select_requestor").show();
    });
    
    $('.additional_po_product').each(function (index) {
        $(this).click(function () {
            $('#addProductModal').modal('show');
        });
    });
    
    $("#product_id").change(function () {
        $("#saveProduct").prop("disabled", false);
        $(".prod_details").remove();
        var id = $("#product_id").val();
        $.get('/quotations/product_info', {
            id: id,
        }, function (data) {
            var i;
            var v;
            var prod_property = data['ProductProperty'];
            var prod_amount = 0;
            var prod_amount_default = 0;
            for (i = 0; i < prod_property.length; i++) {
                var prod_value = data['ProductProperty'][i]['ProductValue'];
                for (v = 0; v < prod_value.length; v++) {
                    prod_amount = prod_amount + parseFloat(prod_value[v]['price']);
                    if (prod_value[v]['default'] == 1) {
                        prod_amount_default = prod_amount_default + parseFloat(prod_value[v]['price']);
                    }

                    $(".product_details_div").append('<div class="prod_details"><div class="col-sm-5"><input type="text" class="form-control property" value="' + prod_property[i]['name'] + '" readonly>' +
                            ' </div>' +
                            '<div class="col-sm-6"><input type="text" class="form-control value" value="' + prod_value[v]['value'] + '" readonly>' +
                            ' </div>' +
                            '<div class="col-sm-1"><a class="btn btn-xs btn-danger deldetail" > <i class="fa fa-minus"></i> </a></div>' +
                            '</div>');
                }
            }

            $('.deldetail').each(function (index) {
                $(this).click(function () {
                    //should update price upon removing specific value 
                    $(this).closest(".prod_details").remove();
                });
            });

            $("#prod_exp_add").remove();
            $("#prod_exp").append('<div id="prod_exp_add" class="row"><div class="col-sm-4">' +
                    '<label>Quantity</label>' +
                    '<input type="number" id="qty" step="any" class="form-control"/></div>' +
                    '<div class="col-sm-8">' +
                    '<label>Date Needed</label>' +
                    '<input type="date" id="date_needed" class="form-control"/></div>' +
                    '</div>');
            $("#prod_img").remove();
            $(".initial_product_type_div").remove();
            $("#prod_image_add_div").append('<div id="prod_img"><img class="img-responsive" src="/img/product-uploads/' + data['Product']['image'] + '"><input type="hidden" id="prdct_image" value="' + data['Product']['image'] + '"></div>' +
                    '<div class="initial_product_type_div form-group"><br/><label>Product Type</label><input type="text" readonly value="' + data['Product']['type'] + '" class="form-control" id="initial_prod_type"></div>');
            $(".add_prod_detail_div").remove();
            $(".product_details_div").append('<div class="add_prod_detail_div"><div class="col-sm-11" > </div><div class="col-sm-1" align="right"><a class="btn btn-xs btn-primary" id="add_prod_detail_btn"> <i class="fa fa-plus"></i> </a></div></div>');
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
                $("#prod_image_add_div").append('<div class="product_type_div form-group"><br/><label>Product Type</label><input type="text" readonly value="' + new_type + '" class="form-control" id="prod_type"></div>');
                $(".product_details_div").append('<div class="prod_details_new"><div class="col-sm-5"><input type="text" class="form-control property"   >' +
                        '<input type="hidden"></div>' +
                        '<div class="col-sm-6"><input type="text" class="form-control value"    >' +
                        '<input type="hidden"></div>' +
                        '<div class="col-sm-1"><a class="btn btn-xs btn-danger deldetail_new" > <i class="fa fa-minus"></i> </a></div></div>');
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
    }); // <========= END OF PRODUCT CHANGE
    
    $("#saveProduct").on('click', function () {
        var product_id = $("#product_id").val();
        var client_id = $("#client_id").val();
        var select_requestor = $("#select_requestor").val();
        var purpose = tinymce.get('ta_purpose').getContent();
        var date_needed = $("#date_needed");
        var qty = $("#qty");

        var property = [];
        $('.property').each(function (index) {
            property.push($(this).val());
        });
        
        var value = [];
        $('.value').each(function (index) {
            value.push($(this).val());
        });
        var obj = {};

        for (var i = 0, len = property.length; i < len; i++) {
            obj[property[i]] = value[i];
        }

        var counter = $('.property').length;
        var ctr = counter - 1;

        var data = {
            "user_id": select_requestor,
            "client_id": client_id,
            "quotation_id": quotation_id,
            "purpose": purpose,
            "product_id": product_id,
            "date_needed": date_needed.val(),
            "qty": qty.val(),
            "property": property,
            "value": value,
            "counter": ctr
        }

        if(client_id!="---- Select Client ----") {
            if(product_id!="---- Select Product ----") {
                if(qty.val()!="") {
                    if(date_needed.val()!="") {
                        if(select_requestor!="---- Select Requestor ----") {
                            $.ajax({
                                url: "/po_raw_requests/addRaw",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'text',
                                success: function (success) {
                                    console.log("success:"+success);
                                    swal({
                                        title: "Success",
                                        text: "Successfully added product.",
                                        type: "success"
                                    },
                                    function(isConfirm) {
                                        if(isConfirm) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function (error) {
                                    console.log("error:"+error);
                                    swal({
                                        title: "Oops!",
                                        text: "An error occured while adding product. \n Please try again.",
                                        type: "warning"
                                    });
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Oops!",
                                text: "Requestor cannot be empty. \n Please try again.",
                                type: "warning"
                            });
                        }
                    }
                    else {
                        swal({
                            title: "Oops!",
                            text: "Date cannot be empty. \n Please try again.",
                            type: "warning"
                        });
                    }
                }  
                else {
                    swal({
                        title: "Oops!",
                        text: "Quantity cannot be empty. \n Please try again.",
                        type: "warning"
                    });
                }
            }
            else {
                swal({
                    title: "Oops!",
                    text: "Product cannot be empty. \n Please try again.",
                    type: "warning"
                });
            }
        }
        else {
            swal({
                title: "Oops!",
                text: "Client cannot be empty. \n Please try again.",
                type: "warning"
            });
        }
    });
});


// ===========================================> END OF MAE CODE FOR NEW RAW MATS

    var get_passed_client = 0;
    var get_passed_quotation = 0;
    $('.set_supplier').each(function (index) {
        $(this).click(function () {
                var get_passed_client = $(this).data('client');
                var qoute_prod_id = $(this).data("rawquoteprodid");
                var porawrequestqty = $(this).data("porawrequestqty");
                var porawrequestid = $(this).data("porawrequestid");
                var get_passed_quotation = $(this).data("quotationid");
                
                $('#purchase-order-product-modal').modal('show');
                $('#quote_product_id').val(qoute_prod_id);
                $('#po_raw_request_qty').val(porawrequestqty);
                $('#po_raw_request_id').val(porawrequestid);
                $('#po_raw_request_client_id').val(get_passed_client);
                $('#po_raw_request_quotation_id').val(get_passed_quotation);
                 

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


        });
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
            var po_raw_request_qty = $("#po_raw_request_qty").val();
            var po_raw_request_id = $("#po_raw_request_id").val(); 
            var po_raw_request_client_id = $("#po_raw_request_client_id").val(); 
            var po_raw_request_quotation_id = $("#po_raw_request_quotation_id").val(); 


            if (product_id != "") {
                if (product_combo_id != "") {
                    if (supplier_id != "") {
                        if (po_qty != "" && po_qty != 0 && po_qty >= 1) {
                            if (list_price != "" && list_price != 0 && list_price >= 1) {
                                $('#added_rqrd_fld').remove();
                                var data = {
                                    "client": po_raw_request_client_id,
                                    "quotation_id": po_raw_request_quotation_id,
                                    "product_combo_id": product_combo_id,
                                    "product_id": product_id,
                                    "supplier_id": supplier_id,
                                    "quote_product_id": 0,
                                    "reference_num": quote_product_id,
                                    "reference_type": 'quotation',
                                    "po_qty": po_qty,
                                    "list_price": list_price,
                                    "additional": 3,
                                    "supplier_product_id": supplier_product_id,
                                    "inventory_job_order_type": 'po',
                                    "po_raw_request_id":po_raw_request_id,
                                    "po_raw_request_qty":po_raw_request_qty
                                    
                                }
                                // console.log(data);exit();
                                $.ajax({
                                    url: "/purchase_orders/process_new_po",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'text',
                                    success: function (success) {
                                        location.reload();
                                    },
                                    error: function (error) {
                                        location.reload();
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
                var qoute_prod_id = $(this).data("rawquoteprodids");
                var porawrequestqty = $(this).data("porawrequestqtys");
                var porawrequestid = $(this).data("porawrequestids");
                var porawrequestclientid = $(this).data("porawrequestclients");
                var porawrequestquotationid = $(this).data("porawrequestquotationids");
                $('#get-from-inventory-product-modal').modal('show');
                
                $('#inv_quote_product_id').val(qoute_prod_id);
                $('#inv_po_raw_request_qty').val(porawrequestqty);
                $('#inv_po_raw_request_id').val(porawrequestid);
                $('#inv_po_raw_request_client_id').val(porawrequestclientid);
                $('#inv_po_raw_request_quotation_id').val(porawrequestquotationid);
                
                 

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
            var inv_po_raw_request_qty = $("#inv_po_raw_request_qty").val();
            var inv_po_raw_request_id = $("#inv_po_raw_request_id").val();
            var inv_po_raw_request_client_id = $("#inv_po_raw_request_client_id").val();
            var inv_po_raw_request_quotation_id = $("#inv_po_raw_request_quotation_id").val();
            
             
            
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
                                    "inv_po_raw_request_qty": inv_po_raw_request_qty,
                                    "inv_po_raw_request_id": inv_po_raw_request_id,
                                    "inv_po_raw_request_client_id": inv_po_raw_request_client_id,
                                    "inv_po_raw_request_quotation_id": inv_po_raw_request_quotation_id,
                                }
            // console.log('asdads');
                                $.ajax({
                                    url: "/inventory_job_orders/process_po_raw_products",
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



//     $("#savesetSupplier").click(function () {
//         $("#savesetSupplier").prop('disabled', true);
//         var po_raw_request_id = $("#sup_pid").val();
//         var supplier_id = $("#selected_supplier").val();
//         var product_supplier_id = $("#selected_product_supplier").val();

//         var property = $('.psp_property').map(function () {
//             return $(this).val();
//         }).get();
//         var value = $('.psp_value').map(function () {
//             return $(this).val();
//         }).get();
//         var qty = $('.psp_qty').map(function () {
//             return $(this).val();
//         }).get();

//         var total_qty = 0;
//         $('.psp_qty').each(function (index) {
//             var qty = parseFloat($(this).val());
//             total_qty = total_qty + qty;
//         });

//         var total_price = 0;
//         $('.psp_price').each(function (index) {
//             var price = parseFloat($(this).val());
//             total_price = total_price + price;
//         });

//         var counter = $('.psp_property').length;
//         var ctr = counter - 1;
// //        var additional = 0;
// //        var po_prod_qty = $("#po_prod_qty").val();
// //        //process add po product
//         var additional = 0;
//         var data = {
//             "po_raw_request_id": po_raw_request_id,
//             "supplier_id": supplier_id,
//             "product_supplier_id": product_supplier_id,
//             "property": property,
//             "value": value,
//             "total_qty": total_qty,
//             "total_price": total_price,
//             "counter": ctr,
//             "qty": qty,
//             "additional": additional
//         }
//         $.ajax({
//             url: "/purchase_orders/setPoProductRaw",
//             type: 'POST',
//             data: {'data': data},
//             dataType: 'json',
//             success: function (dd) {
//                 location.reload();
// //                console.log(dd);
//             },
//             error: function (dd) {
//                 console.log('error');
//             }
//         });

//     });
//     $('.warehouse_product_btn').each(function (index) {
//         $(this).click(function () { 
//             var quoted_qty = $(this).data("qprdctqty");
//             $("#po_raw_qty").val(quoted_qty);
//             var quoted_prod_id = $(this).data("qprdctids");
//             $("#po_raw_id").val(quoted_prod_id);
// //            console.log('asdasd');
//             $('#warehouse_product_modal').modal('show');
//             $("#prod_inv_location_id").select2({
//                 placeholder: "Select Product",
//                 allowClear: true
//             });
//             //allow search product
// //            alert('input qty');
// //            var qid = $(this).data("collectquoteid");
// //            window.location.replace("/collection_schedules/agent_move?id=" + qid);
//         });
//     });
//     $("#inv_location_id").change(function () {
//         $('.prod_inv_location_prop_add').each(function (index) {
//             $(".prod_inv_location_prop_add").remove();
//         });
//         var inv_location_id = $("#inv_location_id").val();
//         $('#prod_inv_location_id').empty().append('<option></option>');
//         $.get('/prod_inv_locations/get_product_location', {
//             id: inv_location_id,
//         }, function (data) {
// //                console.log(data);
//             for (i = 0; i < data.length; i++) {
//                 $('#prod_inv_location_id').append($('<option>', {
//                     value: data[i]['ProdInvLocation']['id'],
//                     text: data[i]['Product']['name']
//                 }))
//             }

//         });
//     });
//     $("#prod_inv_location_id").change(function () {
//         $('.prod_inv_location_prop_add').each(function (index) {
//             $(".prod_inv_location_prop_add").remove();
//         });
//         var prod_inv_location_id = $("#prod_inv_location_id").val();
//         $.get('/prod_inv_locations/get_product_location_property', {
//             id: prod_inv_location_id,
//         }, function (data) {
//             for (i = 0; i < data.length; i++) {
// //                console.log(data[i]['ProdInvLocationProperty']['property']);
//                 $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
//                         '<div class="col-sm-1">' +
//                         '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
//                         '</div>' +
//                         '<div class="col-sm-3" align="center"> ' +
//                         '<input type="text" readonly class="form-control inv_prop" value="' + data[i]['ProdInvLocationProperty']['property'] + '">' +
//                         ' </div>' +
//                         '<div class="col-sm-3" align="center"> ' +
//                         '<input type="text" readonly class="form-control inv_val" value="' + data[i]['ProdInvLocationProperty']['value'] + '">' +
//                         ' </div>' +
//                         '<div class="col-sm-2">' +
//                         '<input type="text" readonly class="form-control inv_qty" value="' + data[i]['ProdInvLocationProperty']['qty'] + '">' +
//                         '</div>' +
//                         '<div class="col-sm-2">' +
//                         '<input type="number" class="form-control inv_qty_deduct" step="any" data-invprop="' + data[i]['ProdInvLocationProperty']['qty'] + '"></div>' +
//                         '<div class="col-sm-1">' +
//                         '</div>' +
//                         '</div>');
//             }

//             $('.rm_prod_inv').each(function (index) {
//                 $(this).click(function () {
//                     $(this).closest(".prod_inv_location_prop_add").remove();
//                 });
//             });
//             $('.inv_qty_deduct').each(function (index) {
//                 $(this).keyup(function () {
//                     var qty = parseFloat($(this).val());
//                     var invprop = parseFloat($(this).data("invprop"));
//                     if (qty > invprop) {
//                         alert('Invalid Quantity');
//                         $('#saveInventorySourceBtn').prop("disabled", true);
//                     } else {
//                         $('#saveInventorySourceBtn').prop("disabled", false);
//                     }
//                 });
//             });
//         });
//     });
//     $("#saveInventorySourceBtn").click(function () {
// //        $('#saveInventorySourceBtn').prop("disabled", true);
//         var total_inv_deduct = 0;
//         $('.inv_qty_deduct').each(function (index) {
//             var inv_qty = parseFloat($(this).val());
//             total_inv_deduct = total_inv_deduct + inv_qty;
//         });
// //    alert(total_inv_deduct);

 
//         var quoted_qty = parseFloat($("#po_raw_qty").val());
//         if (total_inv_deduct > quoted_qty) {
//             alert('Quantity should only be equal or less than' + quoted_qty);
//         } else {
//             var inv_location_id = $("#inv_location_id").val();
//             var prod_inv_location_id = $("#prod_inv_location_id").val();
//             var total_inv_deduct = total_inv_deduct;
//             var po_raw_id = $("#po_raw_id").val();
//             var inv_prop = $('.inv_prop').map(function () {
//                 return $(this).val();
//             }).get();
//             var inv_val = $('.inv_val').map(function () {
//                 return $(this).val();
//             }).get();
//             var inv_qty_deduct = $('.inv_qty_deduct').map(function () {
//                 return $(this).val();
//             }).get();
//             var counter = $('.inv_prop').length;
//             var ctr = counter - 1;
// //            console.log(ctr);
//             var data = {
//                 "inv_location_id": inv_location_id,
//                 "prod_inv_location_id": prod_inv_location_id,
//                 "po_raw_id": po_raw_id,
//                 "inv_prop": inv_prop,
//                 "inv_val": inv_val,
//                 "inv_qty_deduct": inv_qty_deduct,
//                 "total_inv_deduct": total_inv_deduct,
//                 "counter": ctr
//             }
//             $.ajax({
//                 url: "/quotation_products/Rawrequest_product_warehouse_source",
//                 type: 'POST',
//                 data: {'data': data},
//                 dataType: 'json',
//                 success: function (dd) {
//                     location.reload();
// //                    console.log(dd);
//                 },
//                 error: function (dd) {
//                     console.log('error' + dd);
//                 }
//             });
//         }


//     });



    $('.approve_po_raw_request').each(function(index) {
        $(this).click(function() {
            var id = $(this).data("porawrequestid"); 

            swal({
                    title: "Are you sure?",
                    text: "You will not be able to revert action in this Request!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $(".confirm").attr('disabled', 'disabled');
                        $.ajax({
                            url: "/po_raw_requests/approve_request",
                            type: 'POST',
                            data: { 'id': id },
                            dataType: 'json',
                            success: function(dd) {
                                location.reload();
                            },
                            error: function(dd) {
                                console.log(type);
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        });
    });

    
</script>
    