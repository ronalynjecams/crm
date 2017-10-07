<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script> 
<script src="../js/sweetalert.min.js"></script>  
<div id="content-container" >
    <div id="page-title">
        <h4 class="  text-overflow">Collections for <b><?php echo $quote_data['Client']['name']; ?></b> with a total contract of &#8369; <?php echo number_format($quote_data['Quotation']['grand_total'],2); ?></h4>
        <input type="hidden" id="quotation_id" value="<?php echo $id; ?>">
    </div>
    <div id="page-content">  
        <!--        <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">
                            <button class="btn btn-primary moveQuote" data-buttontype="save" >Move to purchasing</button> 
                            <button class="btn btn-danger cancelQuote">Cancel</button> 
                        </h3>
                    </div>
                </div>-->
        <div class="col-sm-3">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#move-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Collection Form</h3>
                </div>
                <div id="move-panel-collapse" class="collapse in">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12"> 
                                <div class="form-group  "> 
                                    <label class="control-label">Payment Mode</label>  
                                    <select id="payment_mode" class="form-control"> 
                                        <option value=""> select </option>
                                        <option value="cash"> cash </option>
                                        <option value="online"> online </option>
                                        <option value="check"> check </option>  
                                    </select>
                                </div>  
                            </div>  
                        </div> 
                        <div class="row amount_div">
                            <div class="col-sm-12"> 
                                <div class="form-group ">
                                    <label class="control-label">Amount </label>  
                                    <input type="number" span="any" id="amount_paid" class="form-control">
                                </div>  
                            </div> 
                            <div class="col-sm-12"> 
                                <div class="form-group ">
                                    <label class="control-label">With Held Amount</label>  
                                    <input type="number" span="any" id="with_held" class="form-control">
                                </div> 
                            </div> 
                        </div>   
                        <div class="row">
                            <div class="check_online_mode_div">
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Bank </label>  
                                        <select id="bank_id" class="form-control"> 
                                            <option value=""> select </option>
                                            <?php
                                            foreach ($banks as $bank) {
                                                echo '<option value="' . $bank['Bank']['id'] . '"> ' . $bank['Bank']['display_name'] . ' </option> ';
                                            }
                                            ?>
                                        </select>
                                    </div>  
                                </div> 
                            </div> 
                            <div class="check_mode_div">
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Check Number </label>  
                                        <input type="number" span="any" id="check_number" class="form-control">
                                    </div> 
                                </div>
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Check Date </label>  
                                        <input type="date" id="check_date" class="form-control">
                                    </div> 
                                </div> 
                            </div> 

                            <div class="col-sm-12" align="right">
                                <button class="btn btn-primary moveQuote" data-buttontype="save" >Add Collection</button> 
                            </div>
                        </div>     


                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-9">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#qInfo-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Collection information</h3>
                </div>
                <div id="qInfo-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <tr>
                                    <th>Date Created</th>
                                    <th>Collected Amount</th>
                                    <th>With Held Amount</th>
                                    <th>Bank</th>
                                    <th>Check Number</th>
                                    <th>Check Date</th>
                                    <th>Status</th>
                                </tr>
                                <?php
//                                pr($collection_data);
                                $grand_total = 0;
                                foreach ($collection_data as $collection) {
                                    if ($collection['Collection']['type'] != 'bir2307' && $collection['Collection']['type'] != 'none') {
                                        ?>
                                        <tr>
                                            <td>

                                                <?php
                                                echo date('F d, Y', strtotime($collection['Collection']['created']));
                                                echo '<br/><small>' . date('h:i a', strtotime($collection['Collection']['created'])) . '</small>';
                                                ?>  
                                            </td>
                                            <td align="right">
                                                <?php
                                                echo '&#8369; ' . number_format($collection['Collection']['amount_paid'], 2);
                                                ?> 
                                            </td>
                                            <td align="right">
                                                <?php
                                                if($collection['Collection']['with_held'] != 0){
                                                echo '&#8369; ' . number_format($collection['Collection']['with_held'], 2);
                                                }else{
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                if($collection['Collection']['bank_id'] != 0){
                                                echo $collection['Bank']['name'];
                                                }else{
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                if($collection['Collection']['bank_id'] != 0){
                                                echo $collection['Collection']['check_number'];
                                                }else{
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td> 
                                                <?php
                                                if(!is_null($collection['Collection']['check_date'])){
                                                    echo date('F d, Y', strtotime($collection['Collection']['check_date']));
                                                    echo '<br/><small>' . date('h:i a', strtotime($collection['Collection']['check_date'])) . '</small>';
                                                }else{
                                                    echo '-';
                                                }
                                                ?> 
                                            </td>
                                            <td>
                                                <?php  
                                                if($collection['Collection']['status'] == 'verified'){
                                                    $total = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'];
                                                    $grand_total = $grand_total + $total;
                                                    echo '<p class="text-success">Verified</p>';
//                                                    if ($collection['Collection']['type']
                                                    //only accounting head or proprietor could void any collection
                                                    if($userRole=='accounting_head' || $userRole=='proprietor'){
                                                     echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collection" data-toggle="tooltip"  data-original-title="Delete Collection" data-collectionid="'.$collection['Collection']['id'].'" data-stats="void"><i class="fa fa-close"></i></button>';
                                                    }
                                                }else if($collection['Collection']['status'] == 'void'){
                                                    echo '<p class="text-danger">Void</p>';
                                                }else{
                                                    echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collection" data-toggle="tooltip"  data-original-title="Delete Collection" data-collectionid="'.$collection['Collection']['id'].'" data-stats="void"><i class="fa fa-close"></i></button>';
                                                    echo '&nbsp; <button class="btn btn-xs btn-success updateStatus_collection"  data-toggle="tooltip"  data-original-title="Verify Collection" data-collectionid="'.$collection['Collection']['id'].'" data-stats="verified"><i class="fa fa-check"></i></button>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        
                                    }
                                }
                                
                                ?>
                                        <tr>
                                            <td><b>Grand Total:</b></td> 
                                            <td colspan="2" align="right"><b><?php echo '&#8369; '.number_format($grand_total); ?></b></td>
                                            <td colspan="4"></td>
                                        </tr>
                            </table> 
                        </div> 
                    </div>
                </div>
            </div>

        </div> 
    </div> 
</div>  
<script>
    $(document).ready(function () {

        $("#term_id").select2({
            placeholder: "Select Term",
            width: '100%',
            allowClear: false
        });
        $(".check_online_mode_div").hide();
        $(".check_mode_div").hide();
        $(".amount_div").hide();
        $(".term_id_div").hide();

        var date = new Date();
        date.setDate(date.getDate() - 1);
        $('#datePicker-deliver')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });

    });



    $("#payment_mode").change(function () {
        $(".check_online_mode_div").show();
        $(".check_mode_div").show();
        $(".amount_div").show();
        $(".term_id_div").show();
        var payment_mode = $("#payment_mode").val();
        if (payment_mode == 'cash') {
            $(".check_online_mode_div").hide();
            $(".check_mode_div").hide();
        } else if (payment_mode == 'online') {
            $(".check_mode_div").hide();
        } else if (payment_mode == 'check') {
            $(".amount_div").show();
            $(".check_mode_div").show();
            $(".check_online_mode_div").show();
        }
    });


    $(".moveQuote").click(function () {
        $("#tin_error").remove();
        var payment_mode = $("#payment_mode").val();
        var vat_type = $("#vat_type").val();
        var amount_paid = $("#amount_paid").val();
        var with_held = $("#with_held").val();
        var bank_id = $("#bank_id").val();
        var check_number = $("#check_number").val();
        var check_date = $("#check_date").val();
        var term_id = $("#term_id").val();
        var delivery_mode = $("#delivery_mode").val();
        var tin_number = $("#tin_number").val();
        var target_delivery = $("#target_delivery").val();
        var quotation_id = $("#quotation_id").val();
        var client_id = $("#client_id").val();


        var data = {"quotation_id": quotation_id,
            "client_id": client_id,
            "payment_mode": payment_mode,
            "vat_type": vat_type,
            "amount_paid": amount_paid,
            "with_held": with_held,
            "bank_id": bank_id,
            "check_number": check_number,
            "check_date": check_date,
            "term_id": term_id,
            "delivery_mode": delivery_mode,
            "tin_number": tin_number,
            "target_delivery": target_delivery,
        }



        if (payment_mode == 'cash') {
            if (vat_type != "") {
                if (amount_paid != "") {
                    if (with_held != "") {
                        if (term_id != "") {
//                            if (tin_number != "" && tin_number != 00000000000000 && tin_number >= 1000) {
                                ///process here
                                approve_quotation(data);
//                            } else {
//                                document.getElementById('tin_number').style.borderColor = "red";
//                                $("#require_tin_div").append('<span class="text-danger" id="tin_error">Tin Number is required</span>')
//                            }
                        } else {
                            document.getElementById('term_id').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('with_held').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('amount_paid').style.borderColor = "red";
                }
            } else {
                document.getElementById('vat_type').style.borderColor = "red";
            }

        } else if (payment_mode == 'online') {
            if (vat_type != "") {
                if (amount_paid != "") {
                    if (with_held != "") {
                        if (bank_id != "") {
                            if (term_id != "") {
                                if (tin_number != "" && tin_number != 00000000000000 && tin_number >= 1000) {
                                    ///process here
                                    approve_quotation(data);
                                } else {
                                    document.getElementById('tin_number').style.borderColor = "red";
                                    $("#require_tin_div").append('<span class="text-danger" id="tin_error">Tin Number is required</span>')
                                }
                            } else {
                                document.getElementById('term_id').style.borderColor = "red";
                            }
                        } else {
                            document.getElementById('bank_id').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('with_held').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('amount_paid').style.borderColor = "red";
                }
            } else {
                document.getElementById('vat_type').style.borderColor = "red";
            }
        } else if (payment_mode == 'cod') {
            if (vat_type != "") {
                if (term_id != "") {
                    if (tin_number != "" && tin_number != 00000000000000 && tin_number >= 1000) {
                        ///process here
                        approve_quotation(data);
                    } else {
                        document.getElementById('tin_number').style.borderColor = "red";
                        $("#require_tin_div").append('<span class="text-danger" id="tin_error">Tin Number is required</span>')
                    }
                } else {
                    document.getElementById('term_id').style.borderColor = "red";
                }

            } else {
                document.getElementById('vat_type').style.borderColor = "red";
            }
        } else if (payment_mode == 'terms') {
            if (vat_type != "") {
                if (term_id != "") {
                    if (tin_number != "" && tin_number != 00000000000000 && tin_number >= 1000) {
                        ///process here
                        approve_quotation(data);
                    } else {
                        document.getElementById('tin_number').style.borderColor = "red";
                        $("#require_tin_div").append('<span class="text-danger" id="tin_error">Tin Number is required</span>')
                    }
                } else {
                    document.getElementById('term_id').style.borderColor = "red";
                }

            } else {
                document.getElementById('vat_type').style.borderColor = "red";
            }
        } else if (payment_mode == 'check') {

            if (vat_type != "") {
                if (amount_paid != "") {
                    if (with_held != "") {
                        if (bank_id != "") {
                            if (term_id != "") {
                                if (tin_number != "" && tin_number != 00000000000000 && tin_number >= 1000) {
                                    if (check_number != "") {
                                        if (check_date != "") {
                                            ///process here
                                            approve_quotation(data);
                                        } else {
                                            document.getElementById('check_date').style.borderColor = "red";
                                        }
                                    } else {
                                        document.getElementById('check_number').style.borderColor = "red";
                                    }
                                } else {
                                    document.getElementById('tin_number').style.borderColor = "red";
                                    $("#require_tin_div").append('<span class="text-danger" id="tin_error">Tin Number is required</span>')
                                }
                            } else {
                                document.getElementById('term_id').style.borderColor = "red";
                            }
                        } else {
                            document.getElementById('bank_id').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('with_held').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('amount_paid').style.borderColor = "red";
                }
            } else {
                document.getElementById('vat_type').style.borderColor = "red";
            }
        }
    });

    function approve_quotation(data) {
        $(".moveQuote").prop('disabled', true);
        $.ajax({
            url: "/quotations/move_to_purchasing",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
//                location.reload();
                window.location.replace("/quotations/pending");
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }
    
    
    
    
    $(".updateStatus_collection").each(function (index) {
        $(this).on("click", function () { 
            var id = $(this).data('collectionid');
            var status = $(this).data('stats');
            swal({
            title: "Are you sure to delete this payment?",
            text: "You will not be able to retrieve after this confirmation!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, confirm!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "/collections/viodPayment",
                            type: 'POST',
                            data: {'id': id, 'status':status},
                            dataType: 'json',
                            success: function (dd) {
                                location.reload();
                            },
                            error: function (dd) {
//                                location.reload();
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
            
            
            
        });
    });
</script>