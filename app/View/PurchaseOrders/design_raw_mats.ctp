<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />-->

<link href="../css/sweetalert.css" rel="stylesheet">
<!--<link href="plugins/bootstrap-validator/bootstrapValidator.min.css" rel="stylesheet">-->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script>   
   <!--<script src="plugins/masked-input/jquery.maskedinput.min.js"></script>-->
   <!--<script src="plugins/bootstrap-validator/bootstrapValidator.min.js"></script>-->
<!--<script src="../js/erp_js/quotation.js"></script>--> 
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="../js/sweetalert.min.js"></script>  
<!--===================================================-->
<div id="content-container" >
    <div id="page-title">
    </div>
    <div id="page-content">   
        <div class="row"> 
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <h3 class="page-header text-overflow"> 
                        <?php 
                            echo $qprod['QuotationProduct']['Product']['name']; 
                            
                            echo '<input type="hidden" id="quotation_product_id" value="'.$qprod['QuotationProduct']['id'].'">';
                            echo '<input type="hidden" id="jr_product_id" value="'.$qprod['JrProduct']['id'].'">'; 
//                            echo '<input type="hidden" id="product_id" value="'.$qprod['QuotationProduct']['Product']['id'].'">'; 
                        
                        ?>
                    </h3> 
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-sm btn-primary" id="addProduct">Add Product</button>
                                <!--<button class="btn btn-default" data-target="#products-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>-->
                            </div>
                            <h3 class="panel-title"> Raw Materials </h3>
                        </div>
                        <div id="products-panel-collapse" class="collapse in">
                            <div class="panel-body"> 
                                <div class="table-responsive">
                                    <table class="table table-striped"> 
                                        <th>#</th>
                                        <th>Product Code</th>
                                        <th>Description</th>
                                        <th>Qty</th>    
                                        <th>Action</th>  
                                        <tbody> 
                                            <?php foreach($raws as $raw){ ?>
                                            <tr>
                                                <td>#</td>
                                                <td>Product Code</td>
                                                <td>Description</td>
                                                <td>Qty</td>  
                                                <td>Action</td> 
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>
                    </div> 



                </div> 



            </div>

            <!--===================================================-->
            <!--END CONTENT CONTAINER-->  
        </div> 
    </div> 
</div>  




<!--===================================================-->
<!--Add New Product Modal Start-->
<!--===================================================--> 
<div class="modal fade" id="addProductModal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <div class="form-group col-sm-12">
                                <select id="product_id" class="form-control"> 
                                    <option> -- select product --</option>
                                    <?php foreach ($products as $product) { ?>
                                        <option value="<?php echo $product['Product']['id']; ?>"> <?php echo $product['Product']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                            <div class="col-sm-12"><div class="product_details_div "></div></div> 
                            <div class="col-sm-12">
                                <div id="prod_exp"></div>
                            </div>  
                        </div>          
                        <div class="col-sm-4">
                            <div class="border" id="prod_image_add_div"> </div>
                        </div> 
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
<script type="text/javascript">

    $(document).ready(function () {
        $("#product_id").select2({
            placeholder: "Select Product Code",
            width: '100%',
            allowClear: false
        });

        $('#addProduct').each(function (index) {
            $(this).click(function () {
                $('#addProductModal').modal('show');
            });
        });

        ///// PRODUCT ///// 
        $("#product_id").change(function () {
            $("#saveProduct").prop("disabled", false);
//                $("#saveProduct").prop("disabled",false);
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
                $("#prod_exp").append('<div id="prod_exp_add"><div class="col-sm-4">' +
                        '<label>Quantity</label>' +
                        '<input type="number" id="qty" step="any" class="form-control"/></div>' +
                        '<div class="col-sm-8">' +
                        '<label>Date Needed</label>' +
                        '<input type="date" id="date_needed" class="form-control"/></div>' +
                        '</div>');



                $("#prod_img").remove();
                $(".initial_product_type_div").remove();
                $("#prod_image_add_div").append('<div id="prod_img"><img class="img-responsive" src="../product_uploads/' + data['Product']['image'] + '"><input type="hidden" id="prdct_image" value="' + data['Product']['image'] + '"></div>' +
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
//                        
                    $(".initial_product_type_div").hide();
                    $("#prod_image_add_div").append('<div class="product_type_div form-group"><br/><label>Product Type</label><input type="text" readonly value="' + new_type + '" class="form-control" id="prod_type"></div>');
//pero kapag tig remove yung newly added properties ng product dapat babalik sya sa supply

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
        });


    });


    $("#saveProduct").click(function () {
        var qty = $("#qty").val();
        var date_needed = $("#date_needed").val();
        var quotation_product_id = $("#quotation_product_id").val();
        var jr_product_id = $("#jr_product_id").val();
        var product_id = $("#product_id").val();


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
        var ctr = counter;

        var data = {
            "quotation_product_id": quotation_product_id,
            "product_id": product_id,
            "jr_product_id": jr_product_id,
            "date_needed": date_needed,
            "qty": qty,
            "property": property,
            "value": value,
            "counter": ctr
        }
 

        if (qty == "" || date_needed == "") {
            alert("Invalid Quantity or Date Needed");
        } else {
            $.ajax({
                url: "/po_raw_requests/addProduct",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) { 
                    console.log(dd);
                },
                error: function (dd) {
                    console.log('error' + dd);
                }
            });
        }
    });
</script>  