
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="../css/sweetalert.css" rel="stylesheet">
<!--<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
<script src="../js/sweetalert.min.js"></script>  


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo ucwords($po['Supplier']['name']); ?></h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <?php
        if ($po['PurchaseOrder']['status'] == 'ongoing') {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <button class="btn btn-primary saveOngoingPO "  data-savestatus="pending">Save</button> 
                    </h3>
                </div>
            </div>
        <?php } else if ($po['PurchaseOrder']['status'] == 'pending') { ?>
            request payment
        <?php } ?>
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">
                    <input type="hidden" id="po_idd" value="<?php echo $this->params['url']['id']; ?>">

                    <!--                    <button class="btn btn-mint" id="addSupplierBtn" >
                                            <i class="fa fa-plus"></i>  Add New Purchase Order
                                        </button> -->
                </h3> 
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date Created</th> 
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Quantity</th> 
                            <th>Price</th>  
                            <th>Total</th>  
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        $ctrr = 1;
                        $total_purchased = 0; 
                        foreach ($po['PoProduct'] as $po_products) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($po_products['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($po_products['created'])) . '</small>';
                                    ?> 
                                </td>

                                <td>
                                    <?php if(!is_null($po_products['Product']['image'])){ ?>
                                    <img class="img-responsive" height="70" width="70" src="../product_uploads/<?php echo $po_products['Product']['image']; ?>" alt="Product Picture">
                                    <?php
                                    }else{ 
                                        echo 'no image';
                                    }?>
                                </td> 
                                <td><?php
                                    echo $po_products['Product']['name'];

                                    if ($type == 'supply') {
                                        if ($po_products['additional'] == 0) {
                                            if ($po_products['PurchaseOrder']['status'] == 'ongoing') {
                                                ?>

                                                <button class="btn btn-sm btn-mint additional_po_product add-tooltip" data-toggle="tooltip"  data-original-title="Purchase Additional Product" data-qprdctid="<?php echo $po_products['QuotationProduct']['id']; ?>"  ><i class="fa fa-plus"></i></button>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php echo abs($po_products['qty']); ?>
                                <!--<input type="text" value="<?php echo abs($po_products['qty']); ?>" class="qty"/>-->
                                </td> 
                                <td><input type="number" step="any" value="<?php echo abs($po_products['price']); ?>" class="form-control price" data-qqty="<?php echo abs($po_products['qty']); ?>" data-tid="id_<?php echo $ctrr; ?>" data-poprodid="<?php echo $po_products['id']; ?>" <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'readonly' ?>></td> 
                                <?php
                                $total = $po_products['qty'] * $po_products['price'];
                                ?>
                                <td><input type="number" step="any" class="form-control total_price" readonly value="<?php echo abs($total); ?>"></td> 

                            </tr>
                            <?php
                            $total_purchased = $total_purchased + $total;
                            $ctrr++;
                        }
                        ?>

                        <tr >
                            <td colspan="4" align="right"><input id="nodiscount" type="checkbox" <?php if ($po['PurchaseOrder']['discount'] == 0) echo 'checked'; ?> <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'disabled' ?>>Without Discount</td>  
                            <td align="right"><div class="discountDiv"><b>Discount:</b></div></td>  
                            <td>
                                <input type="hidden" step="any"  class="form-control" id="discount_val" value="<?php echo abs($po['PurchaseOrder']['discount']); ?>"/>
                                <div class="discountDiv"><input type="number" step="any"  class="form-control" id="discount" value="<?php echo abs($po['PurchaseOrder']['discount']); ?>" <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'readonly' ?>/></div></td>  

                        </tr> 
                        <tr>
                            <td colspan="5" align="right"><b>Total Purchased</b></td>  
                            <td><input type="hidden" id="total_purchased_val" class="form-control" readonly value="<?php echo abs($total_purchased); ?>"/>
                                <input type="text" id="total_purchased" class="form-control" readonly value="<?php echo abs($po['PurchaseOrder']['total_purchased']); ?>"/></td>  
                        </tr>
                        <tr >
                            <td colspan="4" align="right"><input id="nonvat" type="checkbox"  <?php if ($po['PurchaseOrder']['vat_amount'] != 0) echo 'checked'; ?> <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'disabled' ?>> Non Vat</td>  
                            <td align="right"><div class="vatDiv"><b>ADD: 12% VAT:</b></div></td>  
                            <td><input type="hidden"  readonly class="form-control" id="vat_val" value="<?php echo abs($po['PurchaseOrder']['vat_amount']); ?>"/>
                                <div class="vatDiv"><input type="text"  readonly class="form-control" id="vat" value="<?php echo abs($po['PurchaseOrder']['vat_amount']); ?>"/></div></td>  

                        </tr>

<!--                        <tr id="totalTR">
                            <td colspan="5" align="right"><div class="totDiv"><b>Total:</b></div></td>  
                            <td><div class="totDiv"><input type="text" id="total" class="form-control" readonly/></div></td>  
                        </tr>-->

                        <tr>
                            <td colspan="5" align="right"><b>LESS: 1% EWT:</b></td>  
                            <td><input type="text" id="ewt" class="form-control" readonly value="<?php echo abs($po['PurchaseOrder']['ewt_amount']); ?>"/></td>  
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><b>Total Amount Due:</b></td>  
                            <td><input type="text" id="grand_total" class="form-control" readonly  value="<?php echo abs($po['PurchaseOrder']['grand_total']); ?>"/></td>  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if ($po['PurchaseOrder']['status'] == 'ongoing') {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <button class="btn btn-primary saveOngoingPO "  data-savestatus="pending">Save</button> 
                    </h3>
                </div>
            </div>
<?php } ?>
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
                <h4 class="modal-title">Additional PO for Product</h4>
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
<script>
//$( document ).load(function() {

    $(document).ready(function () {
        if ($("#vat").val() == 0) {
            $(".vatDiv").hide();
            $("#vat").val(0);
        }
        if ($("#discount").val() == 0) {
            $(".discountDiv").hide();
            $("#discount").val(0);
        }
        /////////////////////////////////


        $("#nonvat").on("click", function () {
            if (this.checked) {
                $(".vatDiv").hide();
                $("#vat").val(0);
                var discount = $("#discount").val();
                var total_purchased_val = $("#total_purchased_val").val();
                var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
                var ewt = $("#ewt").val();
                var grand_total = $("#grand_total").val();
                var po_id = $("#po_idd").val();

                if ($("#nonvat").is(':checked')) {
                    var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                    var new_vat = parseFloat(new_total_purchased) * 0.12;

                    var vat = new_vat;
                } else {
                    var vat = $("#vat").val();
                }
//                console.log(vat);
                var data = {
                    "discount": discount,
                    "vat": parseFloat(vat),
                    "total_purchased_val": total_purchased_val,
                    "total_purchased": total_purchased,
//                    "total": total,
                    "ewt": ewt,
                    "grand_total": grand_total,
                    "po_id": po_id
                }
                changeAmount(data);
            } else {
                $(".vatDiv").show();


                var discount = $("#discount").val();
                var vat = 0;
                var total_purchased_val = $("#total_purchased_val").val();
                var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
                var ewt = $("#ewt").val();
                var grand_total = $("#grand_total").val();
                var po_id = $("#po_idd").val();

                var data = {
                    "discount": discount,
                    "vat": vat,
                    "total_purchased_val": total_purchased_val,
                    "total_purchased": total_purchased,
//                    "total": total,
                    "ewt": ewt,
                    "grand_total": grand_total,
                    "po_id": po_id
                }
                changeAmount(data);

            }
        });
        $("#nodiscount").on("click", function () {
            if (this.checked) {
                $(".discountDiv").hide();
                $("#discount").val(0);

                var discount = 0;
                var total_purchased_val = $("#total_purchased_val").val();
                var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
                var ewt = $("#ewt").val();
                var grand_total = $("#grand_total").val();
                var po_id = $("#po_idd").val();
                if ($("#nonvat").is(':checked')) {
                    var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                    var new_vat = parseFloat(new_total_purchased) * 0.12;

                    var vat = new_vat;
                } else {
                    var vat = $("#vat").val();
                }
                var data = {
                    "discount": discount,
                    "vat": vat,
                    "total_purchased_val": total_purchased_val,
                    "total_purchased": total_purchased,
//                    "total": total,
                    "ewt": ewt,
                    "grand_total": grand_total,
                    "po_id": po_id
                }
                changeAmount(data);
            } else {
                $(".discountDiv").show();
                var discount_val = $("#discount_val").val();
                $("#discount").val(discount_val);

            }
        });


        $("#discount, #vat").change(function () {
            var discount = $("#discount").val();
            var total_purchased_val = $("#total_purchased_val").val();
            var total_purchased = $("#total_purchased").val();
//            var total = $("#total").val();
            var ewt = $("#ewt").val();
            var grand_total = $("#grand_total").val();
            var po_id = $("#po_idd").val();


            if ($("#nonvat").is(':checked')) {
                var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                var new_vat = parseFloat(new_total_purchased) * 0.12;

                var vat = new_vat;
            } else {
                var vat = $("#vat").val();
            }
            var data = {
                "discount": discount,
                "vat": vat,
                "total_purchased_val": total_purchased_val,
                "total_purchased": total_purchased,
//                "total": total,
                "ewt": ewt,
                "grand_total": grand_total,
                "po_id": po_id
            }
            changeAmount(data);
        });

    });

    $('.price').each(function (index) {
        $(this).change(function () {

            var qty = $(this).data("qqty");
            var tid = $(this).data("tid");
            var po_product_id = $(this).data("poprodid");
            var price = $(this).val();

            var total = qty * price;


            var data = {
                "price": price,
                "po_product_id": po_product_id
            }

            $.ajax({
                url: "/purchase_orders/updatePoProductPrice",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
                    var discount = $("#discount").val();
                    var total_purchased_val = $("#total_purchased_val").val();
                    var total_purchased = $("#total_purchased_val").val();
                    //            var total = $("#total").val();
                    var ewt = $("#ewt").val();
                    var grand_total = $("#grand_total").val();
                    var po_id = $("#po_idd").val();

                    if ($("#nonvat").is(':checked')) {
                        var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                        var new_vat = parseFloat(new_total_purchased) * 0.12;

                        var vat = new_vat;
                    } else {
                        var vat = $("#vat").val();
                    }
                    var data = {
                        "discount": discount,
                        "vat": vat,
                        "total_purchased_val": total_purchased_val,
                        "total_purchased": total_purchased_val,
                        //                "total": total,
                        "ewt": ewt,
                        "grand_total": grand_total,
                        "po_id": po_id
                    }
                    changeAmount(data);
                },
                error: function (dd) {
                    console.log('error');
                }
            });
        });
    });
    $('.additional_po_product').each(function (index) {

        $(this).click(function () {
            $('#set-supplier-modal').modal('show');
            $("#savesetSupplier").prop('disabled', true);
            $('#selected_supplier').empty().append('<option></option>');
            $("#selected_supplier").select2({
                placeholder: "Select Supplier Name",
                allowClear: true
            });

            var qid = $(this).data("qprdctid");
            var po_prod_qty = $(this).data("supplierprodqty");
            $('#po_prod_qty').val(po_prod_qty);
            $("#added_suppliers_div").remove();
            $('#sup_pid').val(qid);
            $.get('/product_suppliers/get_supplier', {
                id: qid,
            }, function (data) {

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
        var additional = 1;
//        var po_prod_qty = $("#po_prod_qty").val();
//        //process add po product
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

        console.log(additional);
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

    function changeAmount(data) {
        $.ajax({
            url: "/purchase_orders/poAmounts",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
//                console.log(dd);
                location.reload();
            },
            error: function (dd) {
                console.log('error');
            }
        });

    }


    $('.saveOngoingPO').each(function (index) {
        $(this).click(function () {
            var po_id = $("#po_idd").val();
            var savestatus = $(this).data("savestatus");
            var data = {
                "po_id": po_id,
                "savestatus": savestatus
            }
            swal({
                title: "Are you sure?",
                text: "You will not be able to edit this PO",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, save it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "/purchase_orders/changeStatus",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (dd) {
                                    //                console.log(dd);
//                                        location.reload();
                                    window.location.href = "/purchase_orders/po?status=pending";
                                },
                                error: function (dd) {
                                    console.log('error');
                                }
                            });
                        }
                    }
            );
        });
    });

</script>