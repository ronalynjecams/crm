<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<!--<link href="/css/plug/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 150,
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
        <h1 class="page-header text-overflow"><?php echo ucwords($this->params['url']['status']); ?> Purchase Order</h1>
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
                            data-toggle="tooltip"  data-original-title="Purchase Product" 
                            data-qprdctid="0"  ><i class="fa fa-plus"></i> Add New Purchase Order
                    </button>
                </h3> 
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date Created</th>
                            <th>Supplier</th>
                            <th>Requested Amount / PO Amount</th>
                            <th>PO Number</th>  
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date Created</th>
                            <th>Supplier</th>
                            <th>Requested Amount / PO Amount</th>
                            <th>PO Number</th> 
                            <th>Action</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($pendings as $pending) { ?> 
                            <tr>
                                <td data-order="<?php echo $pending['PurchaseOrder']['created']; ?>">
                                    <?php
                                    echo time_elapsed_string($pending['PurchaseOrder']['created']);
                                    echo '<br/><small>' . date('h:i a', strtotime($pending['PurchaseOrder']['created'])) . '</small>';
                                    ?>
                                </td>
                                <td>
                                    <?php echo $pending['Supplier']['code']; ?>
                                    <br/>
                                    <small>[<?php echo $pending['Supplier']['type']; ?>]</small>
                                </td>
                                <td>
                                    <?php
                                        echo "&#8369; ".number_format((float)$pending['PurchaseOrder']['payment_request'], 2, '.', ',').
                                             " / &#8369; ".number_format((float)$pending['PurchaseOrder']['grand_total'], 2, '.', ',');
                                    ?>
                                </td>
                                <td>
                                    <?php echo $pending['PurchaseOrder']['po_number']; ?>
                                </td> 
                                <td>
                                    <?php
                                    if ($type == 'supply') {
                                        // echo 'request payment';
                                        // echo 'print po';
                                        // echo 'set schedule';
                                        if ($pending['PurchaseOrder']['status'] == 'ongoing') { 
                                            echo '<a class="btn btn-mint btn-sm btn-icon add-tooltip " target="_blank" data-toggle="tooltip" href="/purchase_orders/po_product?id=' . $pending['PurchaseOrder']['id'] . '" data-original-title="Update Purchase Order"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                        } else {
                                            echo '<a class="btn btn-info btn-sm btn-icon add-tooltip " target="_blank" data-toggle="tooltip" href="/purchase_orders/view_po?id=' . $pending['PurchaseOrder']['id'] . '" data-original-title="View Purchase Order"  ><span class="fa fa-eye"></span></a>';
                                           // echo '<a class="btn btn-mint btn-icon add-tooltip " data-toggle="tooltip" href="#" data-original-title="View Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="fa fa-eye"></i></a>';
                                        }
                                    } else if ($type == 'raw') {
                                        if ($pending['PurchaseOrder']['status'] == 'ongoing') {
                                              echo '<a class="btn btn-mint btn-sm btn-icon add-tooltip " target="_blank" data-toggle="tooltip" href="/purchase_orders/po_product?id=' . $pending['PurchaseOrder']['id'] . '" data-original-title="Update Purchase Order"><span class="fa fa-edit"></span></a>';
                                          // echo '<a class="btn btn-mint btn-icon add-tooltip " data-toggle="tooltip" href="#" data-original-title="Update Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                        } else {
                                            echo '<a class="btn btn-info btn-sm btn-icon add-tooltip " target="_blank" data-toggle="tooltip" href="/purchase_orders/view_po?id=' . $pending['PurchaseOrder']['id'] . '" data-original-title="View Purchase Order"  ><span class="fa fa-eye"></span></a>';
                                            //echo '<a class="btn btn-mint btn-icon add-tooltip " data-toggle="tooltip"  href="/purchase_orders/view_po?id=' . $pending['PurchaseOrder']['id'] . '" data-original-title="View Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="fa fa-eye"></i></a>';
                                        }
                                    }else{
                                        echo '<a class="btn btn-info btn-icon btn-sm add-tooltip " target="_blank" data-toggle="tooltip" href="/purchase_orders/view_po?id=' . $pending['PurchaseOrder']['id'] . '" data-original-title="View Purchase Order"  ><span class="fa fa-eye"></span></a>';
                                    }
                                    
                                    if ($pending['PurchaseOrder']['status'] != 'ongoing') {
                                        echo '<button class="btn btn-primary btn-sm btn-icon add-tooltip print_po" data-toggle="tooltip"  data-original-title="Print Purchase Order?" data-printpoid="'.$pending['PurchaseOrder']['id'].'"><span class="fa fa-print"></span> </button>';
                                    }
                                    
                                    if($pending['PurchaseOrder']['payment_request']==0 || $pending['PurchaseOrder']['payment_request']==null ||
                                       $pending['PurchaseOrder']['payment_request']=="") {
                                        echo '
                                        <button class="btn btn-danger btn-sm btn-icon add-tooltip" data-toggle="tooltip"  data-original-title="Cancel P.O."
                                                id="btn_cancel_po"
                                                data-poid="'.$pending['PurchaseOrder']['id'].'">
                                            <span class="fa fa-ban"></span>
                                        </button>';
                                   } ?>
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
<!--                <h4 class="modal-title">Purchase Product</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <div class="row"> -->
<!--                    <input type="hidden" id="sup_pid"/>    -->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label" id="labelSupplier">Select Product Supplier</label> -->
<!--                            <select id="selected_product_supplier" class="form-control" style="width: 100%;"> -->
<!--                                <option>Select Product Supplier</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>  -->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label" id="labelSupplier">Select Supplier</label> -->
<!--                            <select id="selected_supplier" class="form-control" style="width: 100%;"> -->
<!--                                <option>Select Supplier</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
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
<!--                        </div> -->
<!--                    </div> -->
<!--                </div>-->
<!--            </div>-->
            <!--Modal footer-->
<!--            <div class="modal-footer">-->
<!--                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>-->
<!--                <button class="btn btn-primary" id="savesetSupplier">Add</button>-->
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
                    <div class="col-sm-12"id="last_price"></div>
                    <div class="col-sm-12"id="last_supplier"></div>

                    <!--MAE's MODIFICATION-->
                    <div class="col-sm-12">
                        <select class="form-control" id="select_client">
                            <option>---- Select Client ----</option>
                            <?php
                            foreach($get_clients as $ret_clients) {
                                $client_obj = $ret_clients['Client'];
                                $client_id = $client_obj['id'];
                                $name = $client_obj['name'];
                                
                                if($name!="") {
                                    echo '
                                    <option value="'.$client_id.'">'.$name.'</option>
                                    ';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!--END OF MODIFICATION-->
                    
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

<!--CANCEL PO MODAL STARTS HERE-->
<div class="modal fade" id="cancel-po-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Cancel Purchase Order</h4>
            </div>
            <div class="modal-body">
                <label>Reason for cancellation <span class="text-danger">*</span></label>
                <textarea class="form-control" id="textarea_cancel_reason" aria-label="Other Info"></textarea>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="send_cancel_po">Submit</button>
            </div>
        </div>
    </div>
</div> 
<!--CANCEL PO MODAL ENDS HERE-->
<script>
    $(document).ready(function () { 
        $('[data-toggle="tooltip"]').tooltip();
        $("#select_client").select2({
            placeholder: "---- Select Client ----",
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

        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "desc"]],
            "stateSave": true
        }); 
        $('.print_po').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("printpoid");
                window.open("/pdfs/print_po?id=" + qid, '_blank'); 
            });
        });
        
        var clicked_po_id = 0;
        $("button#btn_cancel_po").on('click', function() {
            clicked_po_id = $(this).data('poid');
            $("#cancel-po-modal").modal('show');
        });
        
        $("button#send_cancel_po").on('click', function() {
            var textarea_cancel_reason = tinymce.get('textarea_cancel_reason').getContent();
            if(textarea_cancel_reason!="") {
                $("button#send_cancel_po").prop('disabled', true);
                var data = {"poid": clicked_po_id, 
                            "reason": textarea_cancel_reason};
                $.ajax({
                    url: "/purchase_orders/cancel_po",
                    type: "POST",
                    data: {"data": data},
                    dataType: "text",
                    success: function(success) {
                        console.log(success);
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        swal({
                            title: "Oops!",
                            text: "An error occured. Please try again later.",
                            type: "warning"
                        });
                    }
                });
            }
            else {
                swal({
                    title: "Oops!",
                    text: "Reason for cancellation is required.\n Please add reason and try again.",
                    type: "warning"
                });
            }
        });
    });
    
    


        // $('.additional_po_product').each(function (index) {
            $('.additional_po_product').click(function () {
                var qoute_prod_id = $(this).data("qtprodid");
                $('#purchase-order-product-modal').modal('show');
                $('#quote_product_id').val(qoute_prod_id);

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
                            // $('.added_product_combo_properties_div').each(function (index) {
                            //     $(".added_product_combo_properties_div").remove();
                            // });
                            $('#slctd_prdct_supplier').empty().append('<option></option>');
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_prdct_supplier').append($('<option>', {
                                    value: data[i]['Supplier']['id'],
                                    text: data[i]['Supplier']['name']
                                }));
                                // $('#list_price').val(data[i]['ProductCombo']['SupplierProduct'][0]['supplier_price']);
                                $('#supplier_product_id').val(data[i]['ProductCombo']['SupplierProduct'][0]['id']);
                                // var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty'];

                                // for (v = 0; v < prod_combo_property.length; v++) {
                                //     $('#product_combo_properties_div').append('<div class="col-sm-12 added_product_combo_properties_div">' +
                                //             '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                //             '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                // }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo 
                    }); //end of onchange slctd_prdctcombo 
                }); // end of onchange slctd_prdct 
            }); //end of each po_product_btn
        // });
      ////in here get products for selected profct combo
                    $("#slctd_prdct_supplier").change(function () {
                        var selected_pcid = $("#slctd_prdctcombo").val();
                        var slctd_prdct_supplier_id = $("#slctd_prdct_supplier").val();
                        $.get('/supplier_products/get_prodct_supplier', {
                            id: selected_pcid,
                            supplier_id:slctd_prdct_supplier_id
                        }, function (data) {
                            $('.added_product_combo_properties_div').each(function (index) {
                                $(".added_product_combo_properties_div").remove();
                            }); 
                            for (i = 0; i < data.length; i++) { 
                            console.log(data[i]['ProductCombo']['ProductComboProperty']);
                                $('#list_price').val(data[i]['SupplierProduct']['supplier_price']); 
                                var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty'];

                                for (v = 0; v < prod_combo_property.length; v++) {
                                    $('#product_combo_properties_div').append('<div class="col-sm-12 added_product_combo_properties_div">' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo 
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
            var client = $("#select_client").val();

            if (product_id != "") {
                if (product_combo_id != "") {
                    if (supplier_id != "") {
                        if (po_qty != "" && po_qty != 0 && po_qty >= 1) {
                            if (list_price != "") {
                                $('#added_rqrd_fld').remove();
                                if(client!="---- Select Client ----") {
                                    var data = {
                                        "product_combo_id": product_combo_id,
                                        "product_id": product_id,
                                        "supplier_id": supplier_id,
                                        "quote_product_id": 0,
                                        "po_qty": po_qty,
                                        "list_price": list_price,
                                        "additional": 2,
                                        "supplier_product_id": supplier_product_id,
                                        "inventory_job_order_type": 'po',
                                        "po_raw_request_id":0,
                                        "po_raw_request_qty":0,
                                        "client": client
                                    }
                                    $.ajax({
                                        url: "/purchase_orders/process_new_po",
                                        type: 'POST',
                                        data: {'data': data},
                                        dataType: 'text',
                                        success: function (dd) {
                                            location.reload();
                                            // console.log(dd);
                                        },
                                        error: function (dd) {
                                            // console.log('error' + dd);
                                            location.reload();
                                        }
                                    });
                                }
                                else {
                                    $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Client is required</font></div>');
                                }
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
    
    
    
    
    
    
    
    
    




//             $("#selected_supplier").change(function () {
//                 $('.product_supplier_properties_add').each(function (index) {
//                     $(".product_supplier_properties_add").remove();
//                 });

// //                $("#savesetSupplier").prop('disabled', false);

//                 var supplier_id = $(this).val();
// //                console.log(supplier_id);
//                 $('#selected_product_supplier').empty().append('<option></option>');
//                 $("#selected_product_supplier").select2({
//                     placeholder: "Select Product Supplier",
//                     allowClear: true,
//                 });

//                 $.get('/product_suppliers/get_product_supplier', {
//                     id: supplier_id,
//                 }, function (data) {
// //                        console.log(data);
//                     for (i = 0; i < data.length; i++) {
//                         $('#selected_product_supplier').append($('<option>', {
//                             value: data[i]['ProductSupplier']['id'],
//                             text: data[i]['Product']['name'] + ' [' + data[i]['ProductSupplier']['product_code'] + ']'
//                         }));
//                     }

//                 });

//             });


//             $("#selected_product_supplier").change(function () {

//                 $('.product_supplier_properties_add').each(function (index) {
//                     $(".product_supplier_properties_add").remove();
//                 });

//                 var product_supplier_id = $("#selected_product_supplier").val();
//                 $.get('/product_suppliers/get_product_supplier_properties', {
//                     id: product_supplier_id,
//                 }, function (data) {
//                     for (i = 0; i < data.length; i++) {
//                         $('#product_supplier_properties_div').append('<div  class="col-sm-12 product_supplier_properties_add">' +
//                                 '<div class="col-sm-1">' +
//                                 '<button class="rm_psp_prod btn btn-danger btn-sm">x</button>' +
//                                 '</div>' +
//                                 '<div class="col-sm-4" align="center"> ' +
//                                 '<input type="text" readonly class="form-control psp_property" value="' + data[i]['ProductSupplierProperty']['property'] + '">' +
//                                 ' </div>' +
//                                 '<div class="col-sm-4" align="center"> ' +
//                                 '<input type="text" readonly class="form-control psp_value" value="' + data[i]['ProductSupplierProperty']['value'] + '">' +
//                                 ' </div>' +
//                                 '<div class="col-sm-2">' +
//                                 '<input type="number" class="form-control psp_qty" step="any"></div>' +
//                                 '<input type="hidden" class="form-control psp_price" value="' + data[i]['ProductSupplierProperty']['price'] + '">' +
//                                 '<div class="col-sm-1">' +
//                                 '</div>' +
//                                 '</div>');
//                     }



//                     $('.rm_psp_prod').each(function (index) {
//                         $(this).click(function () {
//                             $(this).closest(".product_supplier_properties_add").remove();
//                         });
//                     });

//                     $('.psp_qty').each(function (index) {
//                         $(this).keyup(function () {
//                             $("#savesetSupplier").prop('disabled', false);
//                         });
//                     });
//                 });
//             });



//         });
//     });

//     $("#savesetSupplier").click(function () {
//         $("#savesetSupplier").prop('disabled', true);
//         var quotation_product_id = $("#sup_pid").val();
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
//         var additional = 2;
// //        var po_prod_qty = $("#po_prod_qty").val();
// //        //process add po product
//         var data = {
//             "quotation_product_id": quotation_product_id,
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

//         console.log(additional);
//         $.ajax({
//             url: "/purchase_orders/setPoProduct",
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


</script>
