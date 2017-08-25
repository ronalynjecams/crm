
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link href="../css/sweetalert.css" rel="stylesheet">


<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script> 
<script src="../js/sweetalert.min.js"></script>  
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Job Request</h1>
    </div>
    <div id="page-content">  
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-control">
                    <?php
                    if (AuthComponent::user('role') == 'sales_executive') {
                        if ($qq['Quotation']['status'] == 'pending') {
                            ?>
                            <button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" id="update_quote" data-upquoteid="<?php echo $quote_id; ?>"><i class="fa fa-edit"></i> Update Quotation</button>
                            <?php
                        }
                        if ($count_floor_plan == 0) {
                            ?>
                            <button class="btn btn-mint btn-icon"  data-target="#add-floor-plan" data-toggle="modal" ><i class="fa fa-edit"></i> Add Floor Plan</button>
                            <?php
                        }
                    }

                    echo '<input type="hidden" value="' . $qq['Quotation']['job_request_id'] . '" id="jrId">';
                    ?>
                    <button class="btn btn-default" data-target="#products-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                </div>
                <h3 class="panel-title"> Products Info </h3>
            </div>
            <div id="products-panel-collapse" class="collapse in">
                <div class="panel-body">
<?php if (count($jr_products) != 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Date Created</th>
                                <th>Product Code / Floor Plan</th>
                                <th>Description</th>
                                <th>Qty</th> 
                                <th>Designer</th>  
                                <th>Deadline</th>  
                                <th>Status</th>  
                                <th> </th>  
                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    $cc = 0;
                                    if ($jr_products != 0) {
                                        foreach ($jr_products as $quote_prod) {
//                                        if($quote_prod['JrProduct']['status']!='cancelled'){
                                            ?> 
                                            <tr>
                                                <td > 
                                                    <?php
                                                    echo $quote_prod['JrProduct']['id'];
                                                    echo date('F d, Y', strtotime($quote_prod['JrProduct']['created']));
                                                    echo '<br/><small>' . date('h:i a', strtotime($quote_prod['JrProduct']['created'])) . '</small>';
                                                    ?>  
                                                </td>
                                                <?php
                                                if (is_null($quote_prod['JrProduct']['floor_plan_details'])) {
                                                    echo '<td >';
                                                    echo $quote_prod['QuotationProduct']['Product']['name'];

                                                    echo '</td>
                                            <td >
                                                <ul class="list-group">';

                                                    foreach ($quote_prod['QuotationProduct']['QuotationProductProperty'] as $desc) {
                                                        if (is_null($desc['property'])) {
                                                            echo '<li class="list-group-item"><b>' . $desc['ProductProperty']['name'] . '</b> : ' . $desc['ProductValue']['value'] . '</li>';
                                                        } else {
                                                            echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                                                        }
                                                    }
                                                    echo '     
                                                </ul>
                                            </td>';
                                                } else {
                                                    echo '<td colspan="2"><b>Floor Plan Details:   </b>' . $quote_prod['JrProduct']['floor_plan_details'] . '</td>';
                                                }
                                                ?> 
                                                <td><?php echo abs($quote_prod['QuotationProduct']['qty']); ?></td> 
                                                <td><?php echo $quote_prod['User']['first_name']; ?></td> 
                                                <td>
                                                    <?php
                                                    if ($quote_prod['JrProduct']['deadline'] >= '2017-01-01') {
                                                        echo date('F d, Y', strtotime($quote_prod['JrProduct']['deadline']));
                                                    }
                                                    ?>  </td>
                                                <td><?php echo $quote_prod['JrProduct']['status']; ?></td>
                                                <td> 
                                                    <?php
                                                    if (AuthComponent::user('role') == 'sales_executive') {
                                                        if ($quote_prod['QuotationProduct']['type'] != 'supply') {
                                                            if ($quote_prod['JrProduct']['status'] != 'ongoing' && $quote_prod['JrProduct']['status'] != 'accomplished' && $quote_prod['JrProduct']['status'] != 'cancelled') {
                                                                ?>
                                                                <button class="btn btn-mint btn-icon add-tooltip update_jr_product" data-toggle="tooltip" data-typ="agent"   data-original-title="Update Product"  data-qpid="<?php echo $quote_prod['JrProduct']['id']; ?>"><i class="fa fa-edit"></i></button>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo '<b>supply</b>';
                                                        }
                                                    }
                                                    if (AuthComponent::user('role') == 'design_head') {
                                                        if ((!is_null($quote_prod['JrProduct']['deadline'])) && $quote_prod['JrProduct']['status'] != 'accomplished' && $quote_prod['JrProduct']['status'] != 'cancelled') {
                                                            if ($quote_prod['JrProduct']['status'] == 'pending' || $quote_prod['JrProduct']['status'] == 'revised') {
                                                                ?>
                                                                <button class="btn btn-mint btn-icon add-tooltip update_jr_product" data-typ="design_head" data-toggle="tooltip"  data-original-title="Update Product"  data-qpid="<?php echo $quote_prod['JrProduct']['id']; ?>"><i class="fa fa-edit"></i></button>
                                                            <?php } ?>
                                                            <button class="btn btn-danger btn-icon add-tooltip cancel_jr_product" data-toggle="tooltip"  data-original-title="Cancel Job Request"  data-cancelid="<?php echo $quote_prod['JrProduct']['id']; ?>"><i class="fa fa-window-close"></i></button>
                                                            <button class="btn btn-mint btn-icon add-tooltip add_rawmats"   data-toggle="tooltip"  data-original-title="Identify Raw Materials"  data-rmatsid="<?php echo $quote_prod['JrProduct']['id']; ?>"><i class="fa fa-shopping-cart"></i></button>
                                                                <?php
//                                                              echo 'identify raw mats';
                                                        } else {
                                                            if ($quote_prod['JrProduct']['status'] == 'cancelled') {
                                                                echo '<p class="text-danger">Cancelled</p>';
                                                            }else if ($quote_prod['JrProduct']['status'] == 'accomplished') {
                                                                echo '<p class="text-primary">For Production</p>';
                                                                ?>
                                                            
                                                            <button class="btn btn-mint btn-icon add-tooltip add_rawmats"   data-toggle="tooltip"  data-original-title="Update Raw Materials"  data-rmatsid="<?php echo $quote_prod['JrProduct']['id']; ?>"><i class="fa fa-shopping-cart"></i></button>
                                                            <?php
                                                            
                                                            }else {
                                                                echo '<p class="text-danger">Contact Sales Executive</p>';
                                                            }
                                                            
                                                        }
                                                        
                                                        
                                                    }
                                                    ?>          
                                                </td>
                                            </tr> 


                                            <?php
                                            $cnt++;
                                            $cc++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> 
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div> 



<div class="modal fade" id="add-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Job Request Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="jrprod_id"> 
                        <input type="hidden" id="usr_typ"> 
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <div class="col-sm-12"><div class="product_code_div"></div></div> 
                            <div class="form-group col-sm-12"> 
                                    <?php if (AuthComponent::user('role') == 'design_head') { ?>
                                    <select id="designer_id" class="form-control"> 
                                        <option>Select Designer</option>
                                        <?php foreach ($designers as $designer) { ?>
                                            <option value="<?php echo $designer['User']['id']; ?>"> <?php echo $designer['User']['first_name']; ?></option>
                                    <?php } ?>
                                    </select>
                            <?php } ?>
                            </div> 
<?php if (AuthComponent::user('role') == 'sales_executive') { ?>
                                <div class="form-group col-sm-12">
                                    <label class=" control-label">Deadline Date</label>
                                    <div class=" date">
                                        <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control" name="date" readonly id="deadline_date" value=" " />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
<?php } ?>

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
                <button class="btn btn-primary" id="saveJRProduct">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-floor-plan" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Add Floor Plan</h4>
            </div>

            <!--Modal body-->
            <div class="modal-body"> 
                <div class="form-group">
                    <textarea class="form-control" placeholder="Input Floor Plan Details" id="floor_plan_details"></textarea>
                </div>
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveFloorPlanBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {

        var date = new Date();
        date.setDate(date.getDate() - 1);
        $('#datePicker')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date
                });
        $('.update_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("upquoteid");
                window.location.replace("/quotations/update_quotation?id=" + qid);
            });
        });

        $('.update_jr_product').each(function (index) {
            $(this).click(function () {
                var qpid = $(this).data("qpid");
                var typ = $(this).data("typ");


                $('#add-product-modal').modal('show');
                $('#jrprod_id').val(qpid);
                $('#usr_typ').val(typ);

                $(".prod_details").remove();
                var id = $("#jrprod_id").val();
                $.get('/job_requests/quote_product_info', {
                    id: id,
                }, function (data) {
                    console.log(data);
                    $("#prod_img").remove();
                    $(".initial_product_type_div").remove();
                    $("#prod_image_add_div").append('<div id="prod_img"><img class="img-responsive" src="../product_uploads/' + data['QuotationProduct']['image'] + '"><input type="hidden" id="prdct_image" value="' + data['QuotationProduct']['image'] + '"></div>');

                    $("#product_code").remove();
                    $(".product_code_div").append('<div id="product_code"><h3>' + data['QuotationProduct']['Product']['name'] + '</h3></div>');

                });
            });
        });

        $('#saveJRProduct').click(function () {
            var id = $('#jrprod_id').val();
            var job_request_id = $('#job_request_id').val();
            var deadline = $('#deadline_date').val();
            var user_id = $('#designer_id').val();
            var usr_typ = $('#usr_typ').val();
//alert(user_id);
            if (usr_typ === 'agent') {
                $("#saveJRProduct").prop("disabled", true);
                var data = {
                    "job_request_id": job_request_id,
                    "id": id,
                    "deadline": deadline,
                    "usr_typ": usr_typ
                }

            } else if (usr_typ === 'design_head') {
                var data = {
                    "job_request_id": job_request_id,
                    "id": id,
                    "user_id": user_id,
                    "usr_typ": usr_typ
                }
            }

            console.log(data);

            $.ajax({
                url: "/job_requests/updateJRProduct",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
//                    console.log(dd);
                    location.reload();
                },
                error: function (dd) {
                    console.log(dd);
                }
            });
        });

//    cancel_jr_product
        $('.cancel_jr_product').each(function (index) {
            $(this).click(function () {
                var jrprod_id = $(this).data("cancelid");
//                alert(jrprod_id);


                swal({
                    title: "Are you sure?",
                    text: "You will create job request for this quotation?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                        function (isConfirm) {
                            if (isConfirm) {

                                swal("Confirms", "", "error");
//                                $.ajax({
//                                    url: "/job_requests/saveNewJobRequest",
//                                    type: 'POST',
//                                    data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id},
//                                    dataType: 'json',
//                                    success: function (dd) {
//                                        //redirect to edit of products 
//                                        window.location.replace("/job_requests/joupdate?id=" + quotation_id);
//                                        console.log(dd);
//                                    },
//                                    error: function (dd) {
//                                    }
//                                });
                            } else {
                                swal("Cancelled", "", "error");
                            }
                        });

//                window.location.replace("/job_requests/joupdate?id=" + quote_id);
            });
        });



        $('#saveFloorPlanBtn').click(function () {
            var floorplandetails = $("#floor_plan_details").val();
            var jrId = $("#jrId").val();
            if (floorplandetails != "") {

                var job_request_id = $('#job_request_id').val();
                $.ajax({
                    url: "/job_requests/saveFloorPlan",
                    type: 'POST',
                    data: {'floor_plan_details': floorplandetails, 'job_request_id': jrId},
                    dataType: 'json',
                    success: function (dd) {
                        $("#saveFloorPlanBtn").prop("disabled", true);
                        location.reload();
                    },
                    error: function (dd) {
                        console.log('error' + dd);
                    }
                });
            } else {
                document.getElementById('floor_plan_details').style.borderColor = "red";
            }
        });
    }); 

        $('.add_rawmats').each(function (index) {
            $(this).click(function () {
                var id = $(this).data("rmatsid");
                window.location.replace("/purchase_orders/design_raw_mats?id=" + id);
            });
        });


</script>