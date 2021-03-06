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


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $supplier['Supplier']['name']; ?></h1>
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
                        <i class="fa fa-plus"></i>  Add New Product
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
                            <th>Product </th>
                            <th>Code </th>
                            <th>Description</th> 
                            <th>Note</th> 
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Code </th>
                            <th>Product </th>
                            <th>Description</th> 
                            <th>Note</th> 
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($products as $product) { ?> 
                            <tr>
                                <td><?php echo '<img class="img-responsive" src="/img/product-uploads/' . $product['Product']['image'] . '" width="70" height="70">'; ?></td> 
                                <td><?php echo $product['Product']['name']; ?></td> 
                                <td><?php echo $product['ProductSupplier']['product_code']; ?></td> 
                                <td>
                                    <ul class="list-group">
                                        <?php
                                        foreach ($product['ProductSupplierProperty'] as $prod) {
                                            echo '<li class="list-group-item"><b>' . $prod['property'] . '</b> : ' . $prod['value'] . ' ( &#8369; ' . abs($prod['price']) . ' )</li>';
                                        }
                                        ?>
                                    </ul>
                                </td> 
                                <td><?php echo $product['ProductSupplier']['note']; ?></td> 
                                <td>
                                    <?php
//                                if($UserIn['User']['role'] == 'supply_head'){ 
                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Update Supplier" data-ids="' . $product['ProductSupplier']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
//                                } 
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
<!--Add New Supplier Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Product</h4>
            </div> 
            <?php // echo $this->Form->create('Supplier', array('role' => 'form', 'url' => array('controller' => 'suppliers', 'action' => 'add'))); ?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12"> 
                            <span id="prod_exist" class="text-danger"></span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" id="supId" value="<?php echo $this->params['url']['id']; ?>">
                                <select class="form-control" id="pd_id">
                                    <option></option> 
                                    <?php
                                    foreach ($prods as $prod) {
                                        echo '<option value="' . $prod['Product']['id'] . '">' . $prod['Product']['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div> 
                        <div class="col-sm-6"> 
                            <input type="text" class="form-control" placeholder="Product Code" id="code"/>
                        </div>
                        <div class="col-sm-12"> 
                            <textarea class="form-control" placeholder="Notes" id="note"></textarea> 
                        </div>

                        <div class="col-sm-12">
                            <div id="prod_inv_location_prop"><h4 align="center">Available product</h4>
                                <div class="col-sm-12">
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-4" align="center"><b> Property </b></div>
                                    <div class="col-sm-4" align="center"><b> Value </b></div>
                                    <div class="col-sm-2"> Price </div> <div class="col-sm-2"> </div>
                                    <div class="col-sm-1">
                                    </div>
                                </div>     
                            </div>

                        </div>
                    </div>
                </div> 

                <div class="modal-footer"> 
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary" id="saveProductSupplierBtn" disabled>Add</button>
                </div>

            </div> 
        </div>
    </div>
</div>
<!--===================================================-->
<!--Add New Supplier Modal End--> 
<!--Update Lead Modal Start--> 
<!--===================================================-->
<div class="modal fade" id="update-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Product</h4>
            </div> 
            <?php // echo $this->Form->create('Supplier', array('role' => 'form', 'url' => array('controller' => 'suppliers', 'action' => 'add'))); ?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" id="psupId"  >
                                <input type="text" class="form-control" id="prod_name" readonly/>
                            </div> 
                        </div> 
                        <div class="col-sm-6"> 
                            <input type="text" class="form-control" placeholder="Product Code" id="ucode"/>
                        </div>
                        <div class="col-sm-12"> 
                            <textarea class="form-control" placeholder="Notes" id="unote"></textarea> 
                        </div>

                        <div class="col-sm-12">
                            <div id="prod_inv_location_props"><h4 align="center">Available product</h4>
                                <div class="col-sm-12">
                                  
                                    <div class="col-sm-4" align="center"><b> Property </b></div>
                                    <div class="col-sm-4" align="center"><b> Value </b></div>
                                    <div class="col-sm-4"> Price </div> <div class="col-sm-2"> </div> 
                                </div>     
                            </div>

                        </div>
                    </div>
                </div> 

                <div class="modal-footer"> 
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary" id="updateProductSupplierBtn" disabled>Update</button>
                </div>

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

        $("#pd_id").select2({
            placeholder: "Select Product Code",
            width: '100%',
        });

    });

    $('#addSupplierBtn').on("click", function () {
        $('#add-supplier-modal').modal('show');



        $("#pd_id").change(function () {
            var product_id = $("#pd_id").val();
            $('.prod_inv_location_prop_add').each(function (index) {
                $(".prod_inv_location_prop_add").remove();
            });
            
            //check if product already exist in product supplier (supplier_id and product_id)
            
            var supplier_id = $("#supId").val();
            
            var data = {
            "supplier_id": supplier_id,
            "product_id": product_id
        }
        
            $("#existDiv").remove();
                    $("#code").prop("disabled",false);
                    $("#note").prop("disabled",false);
            $.get('/product_suppliers/check_product_supplier', {
                data: data, 
            }, function (dd) {
                if(dd == 'exist'){
                    $("#prod_exist").append('<span id="existDiv">Product already exist</span>');
                    $("#code").prop("disabled",true);
                    $("#note").prop("disabled",true);
                }
//                console.log(dd);
            });
            
            
            $.get('/product_suppliers/get_product_property', {
                id: product_id,
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

                        $('#prod_inv_location_prop').append('<div  class="col-sm-12 prod_inv_location_prop_add">' +
                                '<div class="col-sm-1">' +
                                '<button class="rm_prod_inv btn btn-danger btn-sm">x</button>' +
                                '</div>' +
                                '<div class="col-sm-4" align="center"> ' +
                                '<input type="text" readonly class="form-control property" value="' + prod_property[i]['name'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-4" align="center"> ' +
                                '<input type="text" readonly class="form-control value" value="' + prod_value[v]['value'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-3">' +
                                '<input type="number" class="form-control price" step="any" ></div>' +
                                '</div>');
                    }

                }

                $('.rm_prod_inv').each(function (index) {
                    $(this).click(function () {
                        $(this).closest(".prod_inv_location_prop_add").remove();
                    });
                });


                $('.price').each(function (index) {
                    $(this).keyup(function () {
                        $("#saveProductSupplierBtn").prop('disabled', false);
                        if ($(this).val().length === 0) {
                            $(this).val(0);
                        }
                    });
                });


            });
        });

    });

    $("#saveProductSupplierBtn").on("click", function () {

        var property = $('.property').map(function () {
            return $(this).val();
        }).get();
        var value = $('.value').map(function () {
            return $(this).val();
        }).get();
        var price = $('.price').map(function () {
            return $(this).val();
        }).get();
        var product_id = $("#pd_id").val();
        var code = $("#code").val();
        var note = $("#note").val();
        var supplier_id = $("#supId").val();
        var counter = $('.property').length;
        var ctr = counter - 1;

        var data = {
            "property": property,
            "value": value,
            "price": price,
            "product_id": product_id,
            "code": code,
            "note": note,
            "supplier_id": supplier_id,
            "counter": ctr
        }

        if (code != "") {
            $("#saveProductSupplierBtn").prop('disabled', true);
            $.ajax({
                url: "/product_suppliers/add_new_product",
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
            alert('Product Code is required');
        }

    });


    $('.updateSupplierBtn').each(function (index) {
        $(this).on("click", function () {
            $('#update-supplier-modal').modal('show');
            var id = $(this).data("ids");

                $("#psupId").val(id);
            $.get('/product_suppliers/update_product_property', {
                id: id,
            }, function (data) {
                
                $("#ucode").val(data['ProductSupplier']['product_code']);
                $("#prod_name").val(data['Product']['name']);
                $("#unote").val(data['ProductSupplier']['note']);
                console.log(data);
                var i;
                var v;
                var prod_property = data['ProductSupplierProperty'];
                var prod_amount = 0;
                var prod_amount_default = 0;
                for (i = 0; i < prod_property.length; i++) {   
                        $('#prod_inv_location_props').append('<div  class="col-sm-12 prod_inv_location_prop_adds">' +
                              
                                '<div class="col-sm-4" align="center"> ' +
                                '<input type="text" readonly class="form-control uproperty" value="' + prod_property[i]['property'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-4" align="center"> ' +
                                '<input type="text" readonly class="form-control uvalue" value="' + prod_property[i]['value'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-4">' +
                                '<input type="number" step="any" class="form-control uprice" value="' + prod_property[i]['price'] + '"></div>' +
                                '</div>');
                    
                }
 
                $('.uprice').each(function (index) {
                    $(this).keyup(function () {
                        $("#updateProductSupplierBtn").prop('disabled', false); 
                    });
                });
                
                
                    $("#ucode, #unote").keyup(function () {
                        $("#updateProductSupplierBtn").prop('disabled', false); 
                    });


            });
        });
    });

    $("#updateProductSupplierBtn").on("click", function () {

        var property = $('.uproperty').map(function () { return $(this).val(); }).get();
        var value = $('.uvalue').map(function () { return $(this).val(); }).get();
        var price = $('.uprice').map(function () { return $(this).val(); }).get();
        var code = $("#ucode").val();
        var note = $("#unote").val();
        var product_supplier_id = $("#psupId").val();
        var counter = $('.uproperty').length;
        var ctr = counter - 1;

        var data = {
            "property": property,
            "value": value,
            "price": price, 
            "code": code,
            "note": note,
            "product_supplier_id": product_supplier_id,
            "counter": ctr
        }


        if (code != "") {
            $("#updateProductSupplierBtn").prop('disabled', true);
            $.ajax({
                url: "/product_suppliers/update_product",
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
            alert('Product Code is required');
        }
    });

</script>
