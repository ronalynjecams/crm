<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />-->

<link href="/css/sweetalert.css" rel="stylesheet">

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="/css/plug/select/js/select2.min.js"></script>    
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="/js/sweetalert.min.js"></script>  

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 100,
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

                        
                        if($job_request_type == 'jrp'){
                            
                            echo '<input type="hidden" id="jr_product_id" value="' . $qprod['JobRequestProduct']['id'] . '">'; 
                            echo '<input type="hidden" id="jr_floorplan_id" value="0">'; 
                            echo '<input type="hidden" id="quotation_product_id" value="' . $qprod['JobRequestProduct']['quotation_product_id'] . '">';
                            echo '<input type="hidden" id="quotation_id" value="' . $qprod['JobRequestProduct']['quotation_id'] . '">';
                            echo '<input type="hidden" id="client_id" value="' . $qprod['JobRequestProduct']['client_id'] . '">';
                            $qprod_data = $qprod['JobRequestProduct'];
                        }else{
                            
                            echo '<input type="hidden" id="jr_product_id" value="0">'; 
                            echo '<input type="hidden" id="jr_floorplan_id" value="' . $qprod['JobRequestFloorplan']['id'] . '">'; 
                            echo '<input type="hidden" id="quotation_product_id" value="0">';
                            echo '<input type="hidden" id="quotation_id" value="' . $qprod['JobRequestFloorplan']['quotation_id'] . '">';
                            echo '<input type="hidden" id="client_id" value="' . $qprod['JobRequestFloorplan']['client_id'] . '">'; 
                            $qprod_data = $qprod['JobRequestFloorplan'];
                        }
                        ?>
                    </h3> 
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-sm btn-primary" id="addProduct">Add Product</button> 
                            </div>
                            <h3 class="panel-title"> Request Raw Materials </h3>
                        </div>
                        <div id="products-panel-collapse" class="collapse in">
                            <div class="panel-body"> 
                                <div class="table-responsive">
                                    <table class="table table-striped"> 
                                        <th>Date Requested</th>
                                        <th>Image</th>
                                        <th>Product Code</th>
                                        <th>Description</th>
                                        <th>Qty</th>    
                                        <th>Action</th>  
                                        <tbody> 
                                            <?php
                                            foreach ($raws as $raw) {
                                                ?>
                                                <tr>
                                                    <td><?php 
                                                        echo time_elapsed_string($raw['PoRawRequest']['created']);
                                                        echo '<br/><small>' . date('h:i a', strtotime($raw['PoRawRequest']['created'])) . '</small>';
                                                        ?>
                                                    </td>
                                                    <td><img class="img-responsive" height="70" width="70" src="/img/product-uploads/<?php echo $raw['Product']['image']; ?>"></td>
                                                    <td><?php echo $raw['Product']['name']; ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($raw['PoRawRequestProperty'] as $desc) {
                                                            echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $raw['PoRawRequest']['qty']; ?></td>  
                                                    <td>
                                                        <?php
                                                        if($raw['PoRawRequest']['status']!="cancelled") {
                                                            if($raw['PoRawRequest']['processed_qty']!=0) {  
                                                                echo '<button class="btn btn-danger btn-icon btn-xs add-tooltip deleteProduct"
                                                                              data-rowid="'.$raw['PoRawRequest']['id'].'"
                                                                              data-toggle="tooltip" data-original-title="Delete Item">
                                                                            <i class="fa fa-trash "></i>
                                                                        </button>';
                                                            }
                                                            else {
                                                                echo '
                                                                    <button class="btn btn-warning btn-icon btn-xs add-tooltip cancelProduct"
                                                                            data-rowid="'.$raw['PoRawRequest']['id'].'"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            data-original-title="Cancel Item">
                                                                        <i class="fa fa-window-close"></i>
                                                                    </button>
                                                                    ';
                                                            }
                                                        }
                                                        else {
                                                            echo "<font class='text-danger'>Cancelled</font>";
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

<div class="modal fade" id="cancelProductModal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Cancel Product</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    </p><label>Remarks</label> <span class="text-danger">*</span></p>
                    <textarea id="cancel_remarks"></textarea>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="cancelProduct">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var cancel_product_id = 0;
        $("button.cancelProduct").on('click', function() {
            cancel_product_id = $(this).data('rowid');
            $("#cancelProductModal").modal('show');
        });
        
        $("#cancelProduct").on('click', function() {
            $("button#cancelProduct").prop('disabled');
            var cancel_remarks = tinymce.get("cancel_remarks").getContent();
            
            if(cancel_remarks!="" && cancel_remarks!=null) {
                $("#cancelProductModal").modal('hide');
                var data = {"id": cancel_product_id,
                            "status": "cancelled",
                            "remarks": cancel_remarks };
                swal({
                    title: "Are you sure?",
                    text: "This will cancel product.",
                    type: "warning",
                    showCancelButton: true,
                    closeOnCancel: true,
                    closeOnConfirm: true
                },
                function (isConfirm) {
                    if(isConfirm) {
                        $.ajax({
                            url: "/po_raw_requests/cancel_product",
                            type: "POST",
                            data: {"data": data},
                            dataType: "text",
                            success: function(success) {
                                console.log(success);
                                location.reload();
                            },
                            error: function(error) {
                                swal({
                                    title: "Oops!",
                                    text: "An error occurred. Please try again later.",
                                    type: "warning"
                                });
                            }
                        });
                    }
                });
            }
            else {
                $("button#cancelProduct").removeAttr('disabled');
                swal({
                    title: "Oops!",
                    text: "Please add remarks and try again.",
                    type: "warning"
                });
            }
        });
        
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
                $("#prod_image_add_div").append('<div id="prod_img"><img class="img-responsive" src="/img/product-uploads/' + data['Product']['image'] + '"><input type="hidden" id="prdct_image" value="' + data['Product']['image'] + '"></div>' +
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
        $("#saveProduct").prop("disabled", true);
        var qty = $("#qty").val();
        var date_needed = $("#date_needed").val();
        var quotation_product_id = $("#quotation_product_id").val();
        var jr_product_id = $("#jr_product_id").val();
        var jr_floorplan_id = $("#jr_floorplan_id").val();
        var product_id = $("#product_id").val();
        var quotation_id = $("#quotation_id").val();
        var client_id = $("#client_id").val();


        var property = [];
        $('.property').each(function (index) {
            property.push($(this).val());
        });
        var value = [];
        $('.value').each(function (index) {
            value.push($(this).val());
        });
        
        
        var added_property = [];
        // $('.added_property').each(function (index) {
        //     added_property.push($(this).val());
        // });
        
        var added_value = [];
        // $('.added_value').each(function (index) {
        //     added_value.push($(this).val());
        // });
        var obj = {};

        for (var i = 0, len = property.length; i < len; i++) {
            obj[property[i]] = value[i];
        }
        
        var objj = {};

        for (var i = 0, len = added_property.length; i < len; i++) {
            objj[added_property[i]] = added_value[i];
        }


        var counter = $('.property').length;
        var ctr = counter - 1;

        var data = {
            "quotation_product_id": quotation_product_id,
            "quotation_id": quotation_id,
            "client_id": client_id,
            "product_id": product_id,
            "jr_product_id": jr_product_id,
            "jr_floorplan_id": jr_floorplan_id,
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
                dataType: 'text',
                success: function (success) { 
                    console.log("success:"+success);
                    swal({
                        title: "Success",
                        text: "Successfully added product.",
                        type: "success"
                    },
                    function(isConfirm) {
                        if(isConfirm) {
                            location.reload();
                        }
                    });
                },
                error: function (error) {
                    console.log("error:"+error);
                    swal({
                        title: "Oops!",
                        text: "An error occured while adding product. \n Please try again.",
                        type: "warning"
                    });
                }
            });
        }
    });



    $('.deleteProduct').each(function (index) {
        $(this).click(function () {
            var id = $(this).data("rowid");

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "/po_raw_requests/delete",
                                type: 'POST',
                                data: {'id': id},
                                dataType: 'json',
                                success: function (dd) {
                                    location.reload();
                                },
                                error: function (dd) {
                                    location.reload();
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });
        })
    });
</script>  
