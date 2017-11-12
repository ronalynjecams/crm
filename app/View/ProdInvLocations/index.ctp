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
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Total Qty</th>
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image  </th>
                            <th>Product Code</th>
                            <th>Total Qty</th>
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($products_inv as $inv) { ?>
                            <tr>
                                <td><?php echo '<img class="img-responsive" src="../product_uploads/' . $inv['Product']['image'] . '" width="70" height="70">'; ?></td>
                                <td><?php echo $inv['Product']['name']; ?></td>
                                <td><?php
                                    $total_qty = 0;
                                    foreach ($products_combo[$inv['Product']['id']] as $combo) {
                                        $total_qty += $combo['qty'];
                                        // echo $inv['ProdInvLocation']['qty']; 
                                    }
                                    
                                    echo $total_qty; 
                                ?></td> 
                                <td>
                                    <?php
//                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Update Supplier" data-id="' . $supplier['ProdInvLocation']['id'] . '" ><i class="fa fa-edit"></i></a>';
                                    echo '&nbsp;<a class="btn btn-info btn-icon add-tooltip productSupplierBtn" data-toggle="tooltip" href="/prod_inv_locations/view_combo?id='. $inv['Product']['id'] .'&prod='. $inv['Product']['name'] .'" data-original-title="View Combinations"><i class="fa fa-eye"></i> </a>';
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
                                <?php foreach ($locations as $location) { ?>
                                    <option value="<?php echo $location['InvLocation']['id']; ?>"> <?php echo $location['InvLocation']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                        </div> 
                        <div class="form-group col-sm-6">
                            <input type="text" id="quantity" class="form-control" placeholder="QTY">
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
                <button class="btn btn-primary" id="saveInventoryBtn">Add</button>
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

        
        $('#addInventoryBtn').on("click", function () {
            console.log("hey open up");
            $('#add-inventory-modal').modal('show');
        });
      
        $("#product_id").change(function () {
            $('.prod_inv_location_prop_add').each(function (index) {
                $(".prod_inv_location_prop_add").remove();
            });
            var product_id = $("#product_id").val();
            $.get('/prod_inv_locations/get_product_property', {
                id: product_id
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
            });
        });
        
        $("#add_property").on("click", function () {
            $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
                '<div class="col-sm-1">' +
                '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
                '</div>' +
                '<div class="col-sm-5" align="center"> ' +
                '<input type="text" class="form-control inv_prop" value="">' +
                ' </div>' +
                '<div class="col-sm-5" align="center"> ' +
                '<input type="text" class="form-control inv_val" value="">' +
                ' </div>' +
                '<div class="col-sm-1">' +
                '</div>' +
                '</div>');
        
            $('.rm_prod_inv').click(function () {
                $(this).closest(".prod_inv_location_prop_add").remove();
            });
        });
        
        
      
    });
    
    $("#saveInventoryBtn").click(function () {
//        $('#saveInventorySourceBtn').prop("disabled", true);
        var check_inv_prop = 0;
        var check_inv_val = 0;
        $('.inv_val').each(function (index) {
            var value = $(this).val();
                if(value === ""){
                    check_inv_val += 1;
                }
        });
        
        $('.inv_prop').each(function (index) {
            var value = $(this).val();
                if(value === ""){
                    check_inv_prop += 1;
                }
        });
//    alert(total_inv_deduct);
        var quantity = $("#quantity").val();
        if(quantity <= 0 || quantity === ""){
            alert("quantity is required");
        } else if(check_inv_prop !== 0){
            alert("please fill up blank fields on item property");
        } else if(check_inv_val !== 0){
            alert("please fill up blank fields on property value");
        } else {
//            var quoted_qty = parseFloat($("#quoted_qty").val());
//            if (total_inv_deduct > quoted_qty) {
//                alert('Quantity should only be equal or less than' + quoted_qty);
//            } else {
                var inv_location_id = $("#inv_location_id").val();
                var product_id = $("#product_id").val();
//                var quoted_prod_id = $("#quoted_prod_id").val();
                var inv_prop = $('.inv_prop').map(function () {
                    return $(this).val();
                }).get();
                var inv_val = $('.inv_val').map(function () {
                    return $(this).val();
                }).get();
                var counter = $('.inv_prop').length;
                var ctr = counter;
                console.log(ctr);
                var data = {
                    "location_id": inv_location_id,
                    "product_id": product_id,
                    "quantity": quantity,
                    "inv_prop": inv_prop,
                    "inv_val": inv_val,
                    "counter": ctr
                }
                console.log(data);
                $.ajax({
                    url: "/prod_inv_locations/addInventory",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (dd) {
                        
                        if(dd == "already saved"){
                            alert("Combination already exist");
                        } else {
                            location.reload();
                        }
                    },
                    error: function (dd) {
                        console.log(dd);
                    }
                });
//            }
        }


    });
        
</script>