<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Products Inventory</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <button class="btn btn-mint" id="addInventoryBtn" >
                        <i class="fa fa-plus"></i>  Add Inventory
                    </button> 
                </h3> 
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Location</th>
                            <th>Total Qty</th>
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image  </th>
                            <th>Product Code</th>
                            <th>Location</th>
                            <th>Total Qty</th>
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($inventory as $inv) { ?>
                            <tr>
                                <td><?php '<img class="img-responsive" src="../product_uploads/' . $inv['Product']['image'] . '" width="70" height="70">'; ?></td>
                                <td><?php echo $inv['Product']['name']; ?></td>
                                <td><?php echo $inv['InvLocation']['name']; ?></td>
                                <td><?php //echo $inv['Supplier']['contact_number']; ?></td> 
                                <td>
                                    <?php
//                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Update Supplier" data-id="' . $supplier['ProdInvLocation']['id'] . '" ><i class="fa fa-edit"></i></a>';
                                    echo '&nbsp;<a class="btn btn-info btn-icon add-tooltip productSupplierBtn" data-toggle="tooltip" href="#" data-original-title="View Products" data-ids="' . $inv['ProdInvLocation']['id'] . '" ><i class="fa fa-eye"></i> </a>';
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

<!--Add Inventory Modal Start-->
<!--===================================================-->
<!--===================================================-->
<!--Add New Product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-inventory-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
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
                            <select id="product_id" class="form-control"> 
                                <option>-- select product --</option> 
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['Product']['id']; ?>"> <?php echo $product['Product']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group col-sm-6">
                            <select id="inv_location_id" class="form-control"> 
                                <option>-- select location --</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                        </div> 
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control" placeholder="QTY">
                        </div>
                        <div class="col-sm-12"><div id="prod_inv_location_prop"><h4 align="center">Product Properties</h4>
                                <div class="col-sm-12">
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-5" align="center"><b> Property </b></div>
                                    <div class="col-sm-5" align="center"><b> Value </b></div>
                                    <div class="col-sm-1">
                                        <button id="add_property" class="btn btn-primary btn-sm">+</button>
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
        
        $('#addInventoryBtn').on("click", function () {
            console.log("hey open up");
            $('#add-inventory-modal').modal('show');
        });
      
        $("#product_id").change(function () {
            $('.prod_inv_location_prop_add').each(function (index) {
                $(".prod_inv_location_prop_add").remove();
            });
            var product_id = $("#product_id").val();
            $('#inv_location_id').empty().append('<option>-- select location --</option>');
            $.get('/prod_inv_locations/get_location', {
                id: product_id,
            }, function (data) {
                    console.log(data);
                for (i = 0; i < data.length; i++) {
                    $('#inv_location_id').append($('<option>', {
                        value: data[i]['InvLocation']['id'],
                        text: data[i]['InvLocation']['name']
                    }))
                }
 
            });
        });
        
        $("#add_property").on("click", function () {
            $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
                '<div class="col-sm-1">' +
                '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
                '</div>' +
                '<div class="col-sm-5" align="center"> ' +
                '<input type="text" readonly class="form-control inv_prop" value="">' +
                ' </div>' +
                '<div class="col-sm-5" align="center"> ' +
                '<input type="text" readonly class="form-control inv_val" value="">' +
                ' </div>' +
                '<div class="col-sm-1">' +
                '</div>' +
                '</div>');
        });
        
        $("#inv_location_id").change(function () {
        $('.prod_inv_location_prop_add').each(function (index) {
            $(".prod_inv_location_prop_add").remove();
        });
        var product_id = $("#product_id").val();
        $.get('/prod_inv_locations/get_product_property', {
            id: product_id,
        }, function (data) {
            console.log(data);
            for (i = 0; i < data.length; i++) {
//                console.log(data[i]['ProdInvLocationProperty']['property']);
                $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
                        '<div class="col-sm-1">' +
                        '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
                        '</div>' +
                        '<div class="col-sm-5" align="center"> ' +
                        '<input type="text" readonly class="form-control inv_prop" value="' + data[i]['ProductProperty']['name'] + '">' +
                        ' </div>' +
                        '<div class="col-sm-5" align="center"> ' +
                        '<input type="text" readonly class="form-control inv_val" value="' + data[i]['ProductValue'][0]['value'] + '">' +
                        ' </div>' +
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
      
    });
    
</script>