<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script>  
<script src="../plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Collection schedule</h1>
    </div>
    <div id="page-content">  
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary moveQuote" data-buttontype="save" >Collect Payment</button> 
                    <button class="btn btn-danger cancelQuote">Cancel</button> 
                </h3>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <input type="hidden"  id="quotation_id" value="<?php echo $quote_data['Quotation']['id']; ?>" class="form-control">
                        <button class="btn btn-default" data-target="#move-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Quotation Details</h3>
                </div>
                <div id="move-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div class="row"> 
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
                            <div class="col-sm-6"> 
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


            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#collection-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Collection Schedule </h3>
                </div>
                <div id="collection-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="delivery_date_div_value">
                                    <label>Date of Collection</label>
                                    <div class="input-group input-append date" id="datePicker-collection">
                                        <input type="text" class="form-control" name="date" readonly id="collection_date" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <label>Time of Collection</label>  

                                <div class="input-group date">
                                    <input id="collection_date_time" type="text" readonly class="form-control">
                                    <span class="input-group-addon"  ><i class="demo-pli-clock"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-12" id="agent_instructions"> 
                                <label class=" control-label"><b>Instructions</b><br/>

                                    <small class="text-danger">[Please make sure that all details regarding collection schedule are correct.
                                        <br/>Moreover, instructions should be clear, detailed, and complete to avoid delays during collection. ]</small>
                                </label> 
                                <textarea id="agent_instruction" class="form-control" placehoder="Instructions should include persons to look for, and other important details regarding collection"></textarea>
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
                    <!--                    <div class="panel-body">
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
                                        </div>-->

                    <div class="panel-body">
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label class=" control-label"><b>Assigned TIN Number</b></label> 
                            </div>
                            <div class="col-sm-6"> 
                                <input type="number" readonly id="my_tin" value="<?php echo $agent_status['AgentStatus']['tin_number']; ?>" class="form-control">
                            </div>
                        </div> 
                        <div class="row">
                            <input type="hidden" value="<?php echo $quote_data['Client']['id']; ?>" id="client_id">
                            <div class="col-sm-12"  > <br/><b>Client: </b> <?php echo $quote_data['Client']['name']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> 
                                <label class=" control-label"><b>TIN Number</b></label> 
                                <input type="number" id="tin_number" value="<?php echo $quote_data['Client']['tin_number']; ?>" class="form-control">
                                <div id="require_tin_div"></div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label class=" control-label"><b>With Advance Invoice?</b></label> 
                            </div>
                            <div class="col-sm-6">  
                                <select id="advance_invoice" class="form-control">
                                    <option value="0">no</option>
                                    <option value="1">yes</option>
                                </select>
                            </div>
                        </div>  

                    </div>
                </div>
            </div>
            <div class="panel">
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

        var date = new Date();
        date.setDate(date.getDate() - 1);
        $('#datePicker-deliver')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });
        $('#datePicker-collection')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });
        $('#collection_date_time').timepicker();



    });



    $(".moveQuote").click(function () {
        $("#tin_error").remove();
        $("#sgent_error").remove();
        var vat_type = $("#vat_type").val();
        var term_id = $("#term_id").val();
        var delivery_mode = $("#delivery_mode").val();
        var tin_number = $("#tin_number").val();
        var target_delivery = $("#target_delivery").val();
        var quotation_id = $("#quotation_id").val();
        var collection_date = $("#collection_date").val();
        var collection_date_time = $("#collection_date_time").val();
        var agent_instruction = $("#agent_instruction").val();
        var client_id = $("#client_id").val();
        var advance_invoice = $("#advance_invoice").val();
        
        console.log(collection_date_time);

        var data = {"quotation_id": quotation_id,
            "client_id": client_id,
            "vat_type": vat_type,
            "term_id": term_id,
            "delivery_mode": delivery_mode,
            "tin_number": tin_number,
            "collection_date": collection_date,
            "collection_date_time": collection_date_time,
            "agent_instruction": agent_instruction,
            "target_delivery": target_delivery,
            "advance_invoice": advance_invoice
        }



        if (vat_type != "") {
            if (term_id != "") {
                if (collection_date != "") {
                    if (collection_date_time != "") {
                        if (agent_instruction != "") {
                            if (tin_number != "" && tin_number != 00000000000000 && tin_number >= 1000) {
                                ///process here
                                approve_quotation(data);
                            } else {
                                document.getElementById('tin_number').style.borderColor = "red";
                                $("#require_tin_div").append('<span class="text-danger" id="tin_error">Tin Number is required</span>')
                            }
                        } else {
                            $("#agent_instructions").append('<span class="text-danger" id="sgent_error">Instruction is required.</span>')
                        }
                    } else {
                        document.getElementById('collection_date_time').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('collection_date').style.borderColor = "red";
                }
            } else {
                document.getElementById('term_id').style.borderColor = "red";
            }
        } else {
            document.getElementById('vat_type').style.borderColor = "red";
        }


    });

    function approve_quotation(data) {

        $(".moveQuote").prop('disabled', true);
        $.ajax({
            url: "/collection_schedules/agent_move_process",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
//                location.reload();
                window.location.replace("/quotations/pending");
//                console.log(dd);
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }
</script>
