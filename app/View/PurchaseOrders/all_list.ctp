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
                                    if ($type == 'supply') {
                                        // echo 'request payment';
                                        // echo 'print po';
                                        // echo 'set schedule';
                                        if ($pending['PurchaseOrder']['status'] == 'ongoing') {
                                            echo '<a class="btn btn-mint btn-icon add-tooltip updatePOBtn" data-toggle="tooltip" href="#" data-original-title="Update Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                        } else {
                                            echo '<a class="btn btn-mint btn-icon add-tooltip updatePOBtn" data-toggle="tooltip" href="#" data-original-title="View Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="fa fa-eye"></i></a>';
                                        }
                                    } else if ($type == 'raw') {
                                        if ($pending['PurchaseOrder']['status'] == 'ongoing') {
                                            echo '<a class="btn btn-mint btn-icon add-tooltip updatePOBtn" data-toggle="tooltip" href="#" data-original-title="Update Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                        } else {
                                            echo '<a class="btn btn-mint btn-icon add-tooltip updatePOBtn" data-toggle="tooltip" href="#" data-original-title="View Purchase Order" data-id="' . $pending['PurchaseOrder']['id'] . '" ><i class="fa fa-eye"></i></a>';
                                        }
                                    }
                                    
                                    
                                        if ($pending['PurchaseOrder']['status'] != 'ongoing') {
                                    ?>
                                    <button class="btn btn-primary btn-icon add-tooltip print_po" data-toggle="tooltip"  data-original-title="Print Purchase Order?" data-printpoid="<?php echo $pending['PurchaseOrder']['id']; ?>"><i class="fa fa-print"></i> </button>
                                        <?php } ?>
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


<div class="modal fade" id="set-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Purchase Product</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="sup_pid"/>    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Supplier</label> 
                            <select id="selected_product_supplier" class="form-control" style="width: 100%;"> 
                                <option>Select Product Supplier</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="selected_supplier" class="form-control" style="width: 100%;"> 
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
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="savesetSupplier">Add</button>
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
        $('.print_po').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("printpoid");
                window.open("/pdfs/print_po?id=" + qid, '_blank'); 
            });
        });


        $('.updatePOBtn').each(function (index) {
            $(this).click(function () {
                var id = $(this).data("id");
                window.open("/purchase_orders/po_products?id=" + id, '_blank');
            });
        });
    });




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
