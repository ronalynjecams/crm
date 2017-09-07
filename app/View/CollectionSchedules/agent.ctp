
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
                    <button class="btn btn-primary moveQuote" data-buttontype="save" >Move to purchasing</button> 
                    <button class="btn btn-danger cancelQuote">Cancel</button> 
                </h3>
            </div>
        </div>
        <div class="col-sm-8"> 


            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        
                        <button class="btn btn-default" data-target="#collection-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Collection Schedule </h3>
                </div>
                <div id="collection-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div class="row"><input type="text"  id="quotation_id" value="<?php echo $quote_data['Quotation']['id']; ?>" class="form-control">
                        
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
                    <div class="panel-body">
                        <div class="row">
                            <input type="hidden" value="<?php echo $quote_data['Client']['id']; ?>" id="client_id">
                            <div class="col-sm-12"  > <br/><b>Client: </b> <?php echo $quote_data['Client']['name']; ?></div>
                        </div>

                         
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#delivery-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Billing information</h3>
                </div>
                <div id="delivery-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div id="addresses"><br/>
                            <?php if ($quote_data['Quotation']['delivery_mode'] == 'deliver') { ?>  
                                <?php if ($quote_data['Quotation']['bill_ship_address'] == 1) { ?> 
                                    <small class="text-danger">[Please make sure billing address is correct.
                                        If not, kindly update to avoid delays during collection of payments.]</small>
                                    <div id="bill_ship_div"> 
                                        <div class="col-sm-12">
                                            <b>Billing Address</b>   <a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $quote_data['Quotation']['bill_latitude'] . ',' . $quote_data['Quotation']['bill_longitude']; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>
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
            placeholder: "Select Product Code",
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
        var quotation_id = $("#quotation_id").val();
        
        var collection_date = $("#collection_date").val();
        var collection_date_time = $("#collection_date_time").val();
        var agent_instruction = $("#agent_instruction").val();  
        
        var data = {"quotation_id": quotation_id,  
            "collection_date": collection_date,
            "collection_date_time": collection_date_time,
            "agent_instruction": agent_instruction, 
        }
console.log(data);
 
                if (collection_date != "") {
                    if (collection_date_time != "") {
                        if (agent_instruction != "") { 
                                ///process here
                                approve_quotation(data);
                             
                        } else {
                            $("#agent_instructions").append('<span class="text-danger" id="sgent_error">Instruction is required.</span>')
                        }
                    } else {
                        document.getElementById('collection_date_time').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('collection_date').style.borderColor = "red";
                }
            


    });

    function approve_quotation(data) {

        $(".moveQuote").prop('disabled', true);
        var quotation_id = $("#quotation_id").val();
        $.ajax({
            url: "/collection_schedules/agent_process",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) { 
                window.location.replace("/quotations/view?id="+dd); 
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }
</script>
