
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<!--<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  


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
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
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
//                        pr($requests[0]);      
                        foreach ($requests as $request) {
                            ?> 
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($request['PoRawRequest']['created']));
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
                                        echo $request['QuotationProduct']['Quotation']['Client']['name'];
                                    } else {
                                        echo 'none';
                                    }
                                    echo '<br/><small>' . $request['User']['first_name'] . '</small>';
                                    ?>  </td> 
                                <td> <?php
                                    if ($request['PoRawRequest']['quotation_product_id'] != 0) {
                                        echo $request['JrProduct']['QuotationProduct']['Product']['name'];
                                    }
                                    ?>  </td>  
                                <td> <?php echo $request['User']['first_name']; ?>  </td> 
                                <td> <?php echo $request['User']['first_name']; ?>  </td> 
                                <td> <?php echo $request['PoRawRequest']['processed_qty'] . '/' . $request['PoRawRequest']['qty']; ?>  </td> 
                                <td>  
                                    <button class="btn btn-sm btn-primary set_supplier" data-supplierprodid="<?php echo $request['QuotationProduct']['id']; ?>" data-supplierprodqty="<?php echo $request['PoRawRequest']['qty']; ?>" >Select Supplier</button>
                                    <button class="btn btn-sm btn-warning warehouse_product_btn add-tooltip" data-toggle="tooltip"  data-original-title="Get Product From Warehouse" data-qprdctids="<?php echo $request['QuotationProduct']['id']; ?>" data-qprdctqty="<?php echo $request['PoRawRequest']['qty']; ?>"><i class="fa fa-cubes"></i></button>
                                </td> 
                            </tr> 
<?php } ?>
                    </tbody>
                </table>
            </div>
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
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="selected_supplier" class="form-control" style="width: 100%;"> 
                                <option>Select Supplier</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Supplier</label> 
                            <select id="selected_product_supplier" class="form-control" style="width: 100%;"> 
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
                        </div>

                    </div> 
                </div>
            </div> 
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="savesetSupplier">Add</button>
            </div>
        </div>
    </div>
</div>



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
                        <input type="text" id="quoted_qty" />
                        <input type="text" id="quoted_prod_id" />
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
                        <div class="col-sm-12"><div id="prod_inv_location_prop"><h4 align="center">Available product</h4>
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
<script>
    $(document).ready(function () {

        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });


//        $('.updatePOBtn').each(function (index) {
//            $(this).click(function () {
//                var id = $(this).data("id");
//                window.open("/purchase_orders/po_products?id=" + id, '_blank');
//            });
//        });
    });

    $('.set_supplier').each(function (index) {
        $(this).click(function () {
            $('#set-supplier-modal').modal('show');
            $("#savesetSupplier").prop('disabled', true);
            $('#selected_supplier').empty().append('<option></option>');
            $("#selected_supplier").select2({
                placeholder: "Select Supplier Name",
                allowClear: true
            });

            var qid = $(this).data("supplierprodid");
            var po_prod_qty = $(this).data("supplierprodqty");
            $('#po_prod_qty').val(po_prod_qty);
            $("#added_suppliers_div").remove();
            $('#sup_pid').val(qid);
            $.get('/product_suppliers/get_supplier', {
                id: qid,
            }, function (data) {
//                console.log(data);
                for (i = 0; i < data.length; i++) {
                    $('#selected_supplier').append($('<option>', {
                        value: data[i]['Supplier']['id'],
                        text: data[i]['Supplier']['name']
                    }));
                }

            });




            $("#selected_supplier").change(function () {
                $('.product_supplier_properties_add').each(function (index) {
                    $(".product_supplier_properties_add").remove();
                });

//                $("#savesetSupplier").prop('disabled', false);

                var supplier_id = $(this).val();
//                console.log(supplier_id);
                $('#selected_product_supplier').empty().append('<option></option>');
                $("#selected_product_supplier").select2({
                    placeholder: "Select Product Supplier",
                    allowClear: true,
                });

                $.get('/product_suppliers/get_product_supplier', {
                    id: supplier_id,
                }, function (data) {
//                        console.log(data);
                    for (i = 0; i < data.length; i++) {
                        $('#selected_product_supplier').append($('<option>', {
                            value: data[i]['ProductSupplier']['id'],
                            text: data[i]['Product']['name'] + ' [' + data[i]['ProductSupplier']['product_code'] + ']'
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
                                '<input type="text" readonly class="form-control psp_value" value="' + data[i]['ProductSupplierProperty']['value'] + '">' +
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
            "additional": additional
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
//                    location.reload();
                    console.log(dd);
                },
                error: function (dd) {
                    console.log('error' + dd);
                }
            });
        }


    });
</script>
