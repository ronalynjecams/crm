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

                    <button class="btn btn-mint" id="addSupplierBtn" >
                        <i class="fa fa-plus"></i>  Add New Purchase Order
                    </button> 
                </h3> 
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date Created</th>
                            <th>Supplier</th>
                            <th>PO Number</th> 
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date Created</th>
                            <th>Supplier</th>
                            <th>PO Number</th> 
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($pendings as $pending) { ?> 
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($pending['PurchaseOrder']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending['PurchaseOrder']['created'])) . '</small>';
                                    ?>
                                </td>
                                <td>
                                    <?php echo $pending['Supplier']['code']; ?>
                                </td>
                                <td>
                                    <?php echo $pending['PurchaseOrder']['po_number']; ?>
                                </td> 
                                <td> 
                                    <?php 
                                    if($type == 'supply'){
                                        echo 'request payment';
                                        echo 'print po';
                                        echo 'set schedule';
//                                        echo '<a class="btn btn-mint btn-icon add-tooltip updatePOBtn" data-toggle="tooltip" href="#" data-original-title="Update Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                    }else if($type == 'raw'){
                                    
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

<script>
    $(document).ready(function () {

        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
  
    });


        $('.updatePOBtn').each(function (index) {
            $(this).click(function () {
                var id = $(this).data("id"); 
                    window.open("/purchase_orders/po_products?id=" + id, '_blank'); 
            });
        });
//
//    $('#addSupplierBtn').on("click", function () {
//        $('#add-supplier-modal').modal('show');
//
//
//
//        $("#pd_id").change(function () {
//            var product_id = $("#pd_id").val();
//            $('.prod_inv_location_prop_add').each(function (index) {
//                $(".prod_inv_location_prop_add").remove();
//            });
//            $.get('/product_suppliers/get_product_property', {
//                id: product_id,
//            }, function (data) {
//
//                var i;
//                var v;
//                var prod_property = data['ProductProperty'];
//                var prod_amount = 0;
//                var prod_amount_default = 0;
//                for (i = 0; i < prod_property.length; i++) {
//                    var prod_value = data['ProductProperty'][i]['ProductValue'];
//                    for (v = 0; v < prod_value.length; v++) {
//                        prod_amount = prod_amount + parseFloat(prod_value[v]['price']);
//
//                        $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
//                                '<div class="col-sm-1">' +
//                                '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
//                                '</div>' +
//                                '<div class="col-sm-4" align="center"> ' +
//                                '<input type="text" readonly class="form-control property" value="' + prod_property[i]['name'] + '">' +
//                                ' </div>' +
//                                '<div class="col-sm-4" align="center"> ' +
//                                '<input type="text" readonly class="form-control value" value="' + prod_value[v]['value'] + '">' +
//                                ' </div>' +
//                                '<div class="col-sm-3">' +
//                                '<input type="number" class="form-control price" step="any" ></div>' +
//                                '</div>');
//                    }
//
//                }
//
//                $('.rm_prod_inv').each(function (index) {
//                    $(this).click(function () {
//                        $(this).closest(".prod_inv_location_prop_add").remove();
//                    });
//                });
//
//
//                $('.price').each(function (index) {
//                    $(this).keyup(function () {
//                        $("#saveProductSupplierBtn").prop('disabled', false);
//                        if ($(this).val().length === 0) {
//                            $(this).val(0);
//                        }
//                    });
//                });
//
//
//            });
//        });
//
//    });
//
//    $("#saveProductSupplierBtn").on("click", function () {
//
//        var property = $('.property').map(function () {
//            return $(this).val();
//        }).get();
//        var value = $('.value').map(function () {
//            return $(this).val();
//        }).get();
//        var price = $('.price').map(function () {
//            return $(this).val();
//        }).get();
//        var product_id = $("#pd_id").val();
//        var code = $("#code").val();
//        var note = $("#note").val();
//        var supplier_id = $("#supId").val();
//        var counter = $('.property').length;
//        var ctr = counter - 1;
//
//        var data = {
//            "property": property,
//            "value": value,
//            "price": price,
//            "product_id": product_id,
//            "code": code,
//            "note": note,
//            "supplier_id": supplier_id,
//            "counter": ctr
//        }
//
//        if (code != "") {
//            $("#saveProductSupplierBtn").prop('disabled', true);
//            $.ajax({
//                url: "/product_suppliers/add_new_product",
//                type: 'POST',
//                data: {'data': data},
//                dataType: 'json',
//                success: function (dd) {
//                    location.reload();
//                },
//                error: function (dd) {
//                    console.log('error' + dd);
//                }
//            });
//        } else {
//            alert('Product Code is required');
//        }
//
//    });
//
//
//    $('.updateSupplierBtn').each(function (index) {
//        $(this).on("click", function () {
//            $('#update-supplier-modal').modal('show');
//            var id = $(this).data("ids");
//
//                $("#psupId").val(id);
//            $.get('/product_suppliers/update_product_property', {
//                id: id,
//            }, function (data) {
//                
//                $("#ucode").val(data['ProductSupplier']['product_code']);
//                $("#prod_name").val(data['Product']['name']);
//                $("#unote").val(data['ProductSupplier']['note']);
//                console.log(data);
//                var i;
//                var v;
//                var prod_property = data['ProductSupplierProperty'];
//                var prod_amount = 0;
//                var prod_amount_default = 0;
//                for (i = 0; i < prod_property.length; i++) {   
//                        $('#prod_inv_location_props').append('<div  class="col-sm-12 prod_inv_location_prop_adds">' +
//                              
//                                '<div class="col-sm-4" align="center"> ' +
//                                '<input type="text" readonly class="form-control uproperty" value="' + prod_property[i]['property'] + '">' +
//                                ' </div>' +
//                                '<div class="col-sm-4" align="center"> ' +
//                                '<input type="text" readonly class="form-control uvalue" value="' + prod_property[i]['value'] + '">' +
//                                ' </div>' +
//                                '<div class="col-sm-4">' +
//                                '<input type="number" step="any" class="form-control uprice" value="' + prod_property[i]['price'] + '"></div>' +
//                                '</div>');
//                    
//                }
// 
//                $('.uprice').each(function (index) {
//                    $(this).keyup(function () {
//                        $("#updateProductSupplierBtn").prop('disabled', false); 
//                    });
//                });
//                
//                
//                    $("#ucode, #unote").keyup(function () {
//                        $("#updateProductSupplierBtn").prop('disabled', false); 
//                    });
//
//
//            });
//        });
//    });
//
//    $("#updateProductSupplierBtn").on("click", function () {
//
//        var property = $('.uproperty').map(function () { return $(this).val(); }).get();
//        var value = $('.uvalue').map(function () { return $(this).val(); }).get();
//        var price = $('.uprice').map(function () { return $(this).val(); }).get();
//        var code = $("#ucode").val();
//        var note = $("#unote").val();
//        var product_supplier_id = $("#psupId").val();
//        var counter = $('.uproperty').length;
//        var ctr = counter - 1;
//
//        var data = {
//            "property": property,
//            "value": value,
//            "price": price, 
//            "code": code,
//            "note": note,
//            "product_supplier_id": product_supplier_id,
//            "counter": ctr
//        }
//
//
//        if (code != "") {
//            $("#updateProductSupplierBtn").prop('disabled', true);
//            $.ajax({
//                url: "/product_suppliers/update_product",
//                type: 'POST',
//                data: {'data': data},
//                dataType: 'json',
//                success: function (dd) {
//                    location.reload();
//                },
//                error: function (dd) {
//                    console.log('error' + dd);
//                }
//            });
//        } else {
//            alert('Product Code is required');
//        }
//    });

</script>
