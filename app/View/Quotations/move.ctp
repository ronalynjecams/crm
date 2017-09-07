<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script> 
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Move to Purchasing</h1>
    </div>
    <div id="page-content">  
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary moveQuote" data-buttontype="save" >Move to purchasing</button> 
                    <button class="btn btn-danger cancelQuote">Cancel</button> 
                </h3>
                <input type="text" id="quotation_id" value="<?php echo $id; ?>">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#move-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Quotation Details</h3>
                </div>
                <div id="move-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-sm-6"> 
                                <div class="form-group  ">
                                    
                                    
                                    
                                    <label class="control-label">Payment Mode</label>  
                                    <select id="payment_mode" class="form-control"> 
                                        <option value=""> select </option>
                                        <option value="cash"> cash </option>
                                        <option value="online"> online </option>
                                        <option value="check"> check </option> 
                                        <option value="cod"> cod </option>
                                        <option value="terms"> terms </option> 
                                    </select>
                                </div>  
                            </div> 
                            <div class="col-sm-6"> 
                                <div class="form-group  ">
                                    <label class="control-label">Vat Type</label>  
                                    <select id="vat_type" class="form-control"> 
                                        <option value=""> select </option>
                                        <option value="vat inc"> vat inc </option>
                                        <option value="zero rated"> zero rated </option>
                                        <option value="sales to government"> sales to government </option>
                                        <option value="exempt sales reciept"> exempt sales reciept </option> 
                                    </select>
                                </div> 
                            </div> 
                        </div> 
                        <div class="row amount_div">
                            <div class="col-sm-6"> 
                                <div class="form-group ">
                                    <label class="control-label">Amount </label>  
                                    <input type="number" span="any" id="amount_paid" class="form-control">
                                </div>  
                            </div> 
                            <div class="col-sm-6"> 
                                <div class="form-group ">
                                    <label class="control-label">With Held Amount</label>  
                                    <input type="number" span="any" id="with_held" class="form-control">
                                </div> 
                            </div> 
                        </div>   
                        <div class="row">
                            <div class="check_online_mode_div">
                                <div class="col-sm-4"> 
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
                                <div class="col-sm-4"> 
                                    <div class="form-group ">
                                        <label class="control-label">Check Number </label>  
                                        <input type="number" span="any" id="check_number" class="form-control">
                                    </div> 
                                </div>
                                <div class="col-sm-4"> 
                                    <div class="form-group ">
                                        <label class="control-label">Check Date </label>  
                                        <input type="date" id="check_date" class="form-control">
                                    </div> 
                                </div> 
                            </div> 
                        </div>     


                        <div class="row term_id_div">
                            <div class="col-sm-12"> 
                                <div class="form-group ">
                                    <label class="control-label">Payment Terms</label>  
                                    <select id="term_id" class="form-control"> 
                                        <option value=""> select </option>
                                        <?php
                                        foreach ($terms as $term) {
                                            echo '<option value="' . $term['QuotationTerm']['id'] . '"> ' . $term['QuotationTerm']['name'] . ' </option> ';
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div>  
                        </div> 

                        <div class="row delivery_mode_div"> 
                            <div class="col-sm-6">
                                <label>Delivery Mode</label>
                                <select id="delivery_mode" class="form-control">
                                    <?php if (!is_null($quote_data['Quotation']['delivery_mode'])) { ?>
                                        <option value="<?php echo $quote_data['Quotation']['delivery_mode']; ?>">
                                            <?php echo $quote_data['Quotation']['delivery_mode']; ?>
                                        </option>
                                        <?php
                                    } else {
                                        echo '<option>Select</option>';
                                    }
                                    ?>
                                    <option value="pickup"> pickup </option>
                                    <option value="deliver"> deliver </option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <div id="delivery_date_div_value">
                                    <label>Tentative Delivery or Pickup Date</label>
                                    <div class="input-group input-append date" id="datePicker-deliver">
                                        <input type="text" class="form-control" name="date" readonly id="target_delivery" value="<?php if (!is_null($quote_data['Quotation']['target_delivery'])) echo $quote_data['Quotation']['target_delivery']; ?>" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#qInfo-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Quote information</h3>
                </div>
                <div id="qInfo-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <input type="hidden" value="<?php echo $quote_data['Client']['id']; ?>" id="client_id">
                            <div class="col-sm-12"  > <br/><b>Client: </b> <?php echo $quote_data['Client']['name']; ?></div>
                        </div>

                        <div class="row"><br/> 
                            <div class="col-sm-12"> 
                                <label class=" control-label"><b>TIN Number</b></label> 
                                <input type="number" id="tin_number" value="<?php echo $quote_data['Client']['tin_number']; ?>" class="form-control">
                                <div id="require_tin_div"></div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div><div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#delivery-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Delivery information</h3>
                </div>
                <div id="delivery-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div id="addresses"><br/>
                            <?php if ($quote_data['Quotation']['delivery_mode'] == 'deliver') { ?>  
                                <?php if ($quote_data['Quotation']['bill_ship_address'] == 1) { ?> 
                        <small class="text-danger">[Please make sure billing and shipping address are correct.
                            If not, kindly update to avoid delays during delivery of items and collection of payments.]</small>
                                    <div id="bill_ship_div"> 
                                        <div class="col-sm-12">
                                            <b>Billing and Shipping Address</b>   <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['bill_latitude'] . ',' . $quote_data['Quotation']['bill_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                        </div>
                                        <div class="col-sm-12">  
                                            <div id="bill_ship_div_data"> 
                                                <?php
                                                if ((!is_null($quote_data['Quotation']['bill_address'])) && $quote_data['Quotation']['bill_address'] != "") {
                                                    echo $quote_data['Quotation']['bill_address'] . ', ' . $quote_data['Quotation']['bill_geolocation'];
                                                } else {
                                                    echo $quote_data['Quotation']['bill_geolocation'];
                                                }
                                                ?>
                                            </div> 
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-12">
                                            <br/>
                                            <div class="col-sm-12">
                                                <div id="bill_address">
                                                    <label><b>Billing Address</b></label>
                                                    <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['bill_latitude'] . ',' . $quote_data['Quotation']['bill_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                                </div>
                                                <div id="bill_div_data"> 
                                                    <?php
                                                    if ((!is_null($quote_data['Quotation']['bill_address'])) && $quote_data['Quotation']['bill_address'] != "") {
                                                        echo $quote_data['Quotation']['bill_address'] . ', ' . $quote_data['Quotation']['bill_geolocation'];
                                                    } else {
                                                        echo $quote_data['Quotation']['bill_geolocation'];
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div id="ship_address">
                                                    <label><b>Shipping Address</b></label> 
                                                    <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['ship_latitude'] . ',' . $quote_data['Quotation']['ship_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
                                                </div>
                                                <div id="ship_div_data">
                                                    <?php
                                                    if ((!is_null($quote_data['Quotation']['ship_address'])) && $quote_data['Quotation']['ship_address'] != "") {
                                                        echo $quote_data['Quotation']['ship_address'] . ', ' . $quote_data['Quotation']['ship_geolocation'];
                                                    } else {
                                                        echo $quote_data['Quotation']['ship_geolocation'];
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?> 
                            </div>
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

//        $("#with_held, #amount_paid").keyup(function () {
//            $(".term_id_div").show();
//            var with_held = $("#with_held").val();
//            var amount_paid = $("#amount_paid").val();
//            var grand_total = $("#grand_total").val();
//            var total = parseFloat(amount_paid) + parseFloat(with_held);
//            if (total == parseFloat(grand_total)) {
////                console.log('equal'); 
//                $(".term_id_div").hide();
//            } else {
//                console.log('not equal');
//            }
////            alert("Handler for .keyup() called.");
//        });


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
        } else if (payment_mode == 'cod') {
            $(".amount_div").hide();
            $(".check_mode_div").hide();
            $(".check_online_mode_div").hide();
            $(".term_id_div").hide();
        } else if (payment_mode == 'terms') {
            $(".amount_div").hide();
            $(".check_mode_div").hide();
            $(".check_online_mode_div").hide();
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
                                        }else{
                                            document.getElementById('check_date').style.borderColor = "red";
                                        }
                                    }else{
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
</script>