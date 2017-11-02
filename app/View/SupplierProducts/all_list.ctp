
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<!--<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">-->
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
                            <th>Suppliers Code </th>
                            <th>Suppliers Price </th>
                            <th>Jecams Code </th> 
                            <th>Description</th> 
                            <th>Note</th> 
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Suppliers Code </th>
                            <th>Suppliers Price </th>
                            <th>Jecams Code </th> 
                            <th>Description</th> 
                            <th>Note</th> 
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($products as $product) { ?> 
                            <tr>
                                <td><?php echo '<img class="img-responsive" src="../product_uploads/' . $product['ProductCombo']['Product']['image'] . '" width="70" height="70">'; ?></td> 
                                <td><?php echo $product['SupplierProduct']['supplier_code']; ?></td> 
                                <td><?php echo '&#8369; ' . number_format($product['SupplierProduct']['supplier_price'],2); ?></td> 
                                <td><?php echo $product['ProductCombo']['Product']['name']; ?></td>  
                                <td>
                                    <ul class="list-group">
                                        <?php
                                        foreach ($product['ProductCombo']['ProductComboProperty'] as $prod) {
                                            echo '<li class="list-group-item"><b>' . $prod['property'] . '</b> : ' . $prod['value'] . ' </li>';
                                        }
                                        ?>
                                    </ul>
                                </td> 
                                <td><?php echo $product['SupplierProduct']['note']; ?></td> 
                                <td>
                                    <?php
//                                if($UserIn['User']['role'] == 'supply_head'){ 
                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Update Suppliers\' Product" data-ids="' . $product['SupplierProduct']['id'] . '" ><i class="fa fa-edit"></i></a> ';
                                     echo '<a class="btn btn-danger btn-icon add-tooltip removeSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Remove Suppliers\' Product" data-ids="' . $product['SupplierProduct']['id'] . '" ><i class="fa fa-window-close"></i></a>';
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
<!--Add New Supplier Product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Product for <?php echo $supplier['Supplier']['name']; ?></h4>
            </div> 
            <div class="modal-body"> 
                <div class="row"> 
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
                            <div class="form-group"> 
                                <select class="form-control" id="pdc_id">
                                    <option></option> 
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-6"> 
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Suppliers Product Code" id="supplier_code"/>
                            </div>
                        </div>
                        <div class="col-sm-6"> 
                            <div class="form-group">
                                <input type="number" span="any" class="form-control" placeholder="Suppliers Price" id="supplier_price"/>
                            </div>
                        </div>
                        <div class="col-sm-12"> 
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Notes" id="note"></textarea> 
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div id="product_combo_property_div"><h4 align="center">Product Description</h4> 
                                    <div class="col-sm-6" align="center"><b> Property </b></div>
                                    <div class="col-sm-6" align="center"><b> Value </b></div>  
                            </div> 
                        </div> 
                    
                </div> 

                <div class="modal-footer"> 
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary" id="saveProductSupplierBtn">Add</button>
                </div>

            </div> 
        </div>
    </div>
</div>
<!--===================================================-->
<!--Add New Supplier Product Modal End--> 
<!--Update Lead Modal Start--> 
<!--===================================================-->
 

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

        $("#pdc_id").select2({
            placeholder: "Select Product Combination",
            width: '100%',
        });

    });

    $('#addSupplierBtn').on("click", function () {

        $('.product_supplier_properties_add').each(function (index) {
            $(".product_supplier_properties_add").remove();
        }); 
        $('#add-supplier-modal').modal('show');
 
        $("#pd_id").change(function () {

            $('.product_supplier_properties_add').each(function (index) {
                $(".product_supplier_properties_add").remove();
            }); 

            var product_id = $("#pd_id").val();
            var supplier_id = $("#supId").val();

            $('#pdc_id').empty().append('<option></option>');

            ////show product combos of selected product
            $.get('/supplier_products/get_product_combination', {
                id: product_id,
            }, function (data) {
                for (i = 0; i < data.length; i++) {
                    $('#pdc_id').append($('<option>', {
                        value: data[i]['ProductCombo']['id'],
                        text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                    }));
                }

            });

            $("#pdc_id").change(function () { 
                $('.product_supplier_properties_add').each(function (index) {
                    $(".product_supplier_properties_add").remove();
                });

                var product_combo_id = $("#pdc_id").val();
                //check if product combo already exist in  supplier_products table (supplier_id and product_combo_id)

                var data = {
                    "supplier_id": supplier_id,
                    "product_combo_id": product_combo_id
                }

                $("#existDiv").remove();
                $("#code").prop("disabled", false);
                $("#note").prop("disabled", false);
                $.get('/supplier_products/check_supplier_product', {
                    data: data,
                }, function (dd) {
                    if (dd == 'exist') {
                        $("#prod_exist").append('<span id="existDiv">Product Combination already exist</span>');
                        $("#code").prop("disabled", true);
                        $("#note").prop("disabled", true);
                    }
                });

                ///get properties of selected product_combo 
                $.get('/supplier_products/get_product_combo_properties', {
                    id: product_combo_id,
                }, function (data) {

                    $('.product_supplier_properties_add').each(function (index) {
                        $(".product_supplier_properties_add").remove();
                    }); 
                    for (i = 0; i < data.length; i++) {
                        $('#product_combo_property_div').append('<div  class="col-sm-12 product_supplier_properties_add">' +
                                '<div class="col-sm-6" align="center"> ' +
                                '<input type="text" readonly class="form-control psp_property" value="' + data[i]['ProductComboProperty']['property'] + '">' +
                                ' </div>' +
                                '<div class="col-sm-6" align="center"> ' +
                                '<input type="text" readonly class="form-control psp_value" value="' + data[i]['ProductComboProperty']['value'] + '">' +
                                ' </div>' +
                                '</div>');
                    } 
                });

            }); 
        });  
    });

    $("#saveProductSupplierBtn").on("click", function () {
 
        var product_id = $("#pd_id").val();
        var product_combo_id = $("#pdc_id").val();
        var code = $("#supplier_code").val();
        var price = $("#supplier_price").val();
        var note = $("#note").val();
        var supplier_id = $("#supId").val();  
        
        var data = {
            "product_id": product_id,
            "product_combo_id": product_combo_id,
            "code": code,
            "price": price, 
            "note": note,
            "supplier_id": supplier_id
        }
        
        if (product_id != "") {
            if(product_combo_id!=""){ 
                if(code!=""){ 
                    if(price!=""){
                        if(note!=""){ 
                            $("#saveProductSupplierBtn").prop('disabled', true);
                            $.ajax({
                                url: "/supplier_products/add_new_supplier_product",
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
                        }else{
                            document.getElementById('note').style.borderColor = "red";
                        }
                    }else{
                        document.getElementById('supplier_price').style.borderColor = "red";
                    }
                }else{
                    document.getElementById('supplier_code').style.borderColor = "red";
                }
            }else{
                document.getElementById('pdc_id').style.borderColor = "red";
            }
        } else {
            document.getElementById('pd_id').style.borderColor = "red";
        } 
    });


</script>

