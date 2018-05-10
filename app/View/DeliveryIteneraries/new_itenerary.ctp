<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script> 

<!--SELECT2-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<!--CHOSEN-->
<link href="/css/plug/chosen/chosen.min.css" rel="stylesheet">
<script src="/css/plug/chosen/chosen.jquery.min.js"></script>


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Create Itenerary</h1>
    </div>
    <?php echo '<input type="hidden" id="del_type" value="'.$this->params['url']['type'].'">' ?>
    

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================--> 
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Client Details</b></h3> 
            </div>
            <div class="panel-body">
                <?php
                echo '<input type="hidden" id="client_id" value="' . $delivery_schedule['DeliverySchedule']['client_id'] . '">';
                echo '<input type="hidden" id="delivery_schedule_id" value="' . $this->params['url']['id'] . '">';
                echo '<input type="hidden" id="delivery_type" value="' . $this->params['url']['type'] . '">';
                if ($type != 'pickup') {
                    echo '
                <div class="col-sm-6"><b>Deliver To:</b> ' . $delivery_schedule['DeliverySchedule']['deliver_to'] . '</div>
                <div class="col-sm-6"><b>Agent:</b> ' . $delivery_schedule['User']['first_name'] . '  ' . $delivery_schedule['User']['last_name'] . '</div>
                <div class="col-sm-6"><b>Delivery Mode:</b> ' . $delivery_schedule['DeliverySchedule']['mode'] . '</div>
                <div class="col-sm-6">';
                    ?>
                    <b>Shipping Address:</b> 
                    <?php
                        echo '<input type="hidden" id="g_maps" value="'.$delivery_schedule['DeliverySchedule']['g_maps'].'">';
                    $maps = explode("_",$delivery_schedule['DeliverySchedule']['g_maps']);//split string
                    // pr();
                    ?>
                    
                    <?php
                        echo $delivery_schedule['DeliverySchedule']['shipping_address'];
                        echo '<input type="hidden" id="shipping_address" value="'.$delivery_schedule['DeliverySchedule']['shipping_address'].'">';
                        $map_final = "<font class='text-danger'>Not Specified</font>";
                        if(!empty($maps)) {
                            $maps0 = '';
                            $maps1 = '';
                            
                            if(count($maps)>1) {
                                $maps0 = $maps[0];
                                $maps1 = $maps[1];
                            }
                            
                            $map_final = $maps0 . ',' . $maps1;
                        }
                    ?><a class="btn btn-xs btn-pink" id="bill_ship_direction" href="http://maps.google.com/?q=<?php echo $map_final; ?>" target="_blank"> <i class="fa fa-external-link"></i> </a>

                </div> 
                <?php
                ?> 
                <?php
            } else {
                echo '<div class="col-sm-12"><b>Supplier</b></div> 
                      <div class="col-sm-12"><b>Pickup Address</b></div>';
            }
            ?>
            <div class="col-sm-6"><b>DR #: </b> <?php echo $delivery_schedule['DeliverySchedule']['dr_number']; ?></div>
            <div class="col-sm-6"><b>Delivery Request Schedule: </b><?php echo date('F d, Y', strtotime($delivery_schedule['DeliverySchedule']['delivery_date'])) . ' <small> [' . date('h:i a', strtotime($delivery_schedule['DeliverySchedule']['delivery_time'])) . '] </small>'; ?></div>
        </div>
    </div> 
    <div class="panel">
        <div class="panel-heading" align="right">
            <h3 class="panel-title">  
            </h3>  
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <label><b>Type:</b></label>
                    <select id="typo" class="form-control">
                        <option value=""></option>
                        <option value="jecams">Jecams</option>
                        <option value="transportify">Transportify</option>
                    </select>



                    <div id="jecamsDiv">
                        <br/>
                        <!--jecams-->
                        <!--<div class="col-sm-12">--> 
                        <label><b>Select Vehicle</b></label>
                        <select class="form-control" id="vehicle_id">
                            <option>---- Select Vehicle ----</option> 
                            <?php
                            foreach ($vehicles as $vehicle) {
                                echo '<option value="' . $vehicle['Vehicle']['id'] . '">' . $vehicle['Vehicle']['plate_number'] . ' - ' . $vehicle['Vehicle']['brand'] . '</option>';
                            }
                            ?>
                        </select>


                        <label><b>Select Driver</b></label>
                        <select class="form-control" id="driver_id">
                            <option>---- Select Driver ----</option>
                            <?php
                            foreach ($installers as $intaller) {
                                echo '<option value="' . $intaller['User']['first_name'] . ' ' . $intaller['User']['last_name'] . '">' . $intaller['User']['first_name'] . ' ' . $intaller['User']['last_name'] . '</option>';
                            }
                            ?>
                        </select> 
                        <!--</div>-->
                    </div>

                    <div id="transportifyDiv">
                        <br/>
                        <!--transportify-->
                        <label><b>Pick-up Date</b></label>
                        <input type="date" id="pickup_date" class="form-control">

                        <label><b>Pick-up Time</b></label>
                        <input type="time" id="pickup_time" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">


                    <label id="people_label"><b>Select Installers/Passengers</b></label>
                    <select class="form-control people_id" multiple  id="people_ids"  data-placeholder="Select Installers/Passengers">
                        <option></option>
                        <?php
                        foreach ($installers as $intaller) {
                            echo '<option value="' . $intaller['User']['id'].'">' . $intaller['User']['first_name'] . ' ' . $intaller['User']['last_name'] . '</option>';
                        }
                        ?>
                    </select>
                    <br/>
                    <br/>
                    <label><b>Expected Start Date</b></label>
                    <input type="date" id="expected_start_date" class="form-control">

                    <label><b>Expected Start Time</b></label>
                    <input type="time" id="expected_start_time" class="form-control">

                </div>
            </div>
        </div>
    </div>


    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">
                <button class="btn btn-primary saveDeliveryIteneray"  data-savestatus="pending" disabled="">Save</button> 
            </h3>
        </div>
    </div> 
</div>
</div>


<script>
//$( document ).load(function() {

    $(document).ready(function () {

        $("#typo").select2({
            width: '100%',
            allowClear: false
        });
        
        $("#vehicle_id").select2({
            width: '100%',
            allowClear: false
        });
        
        $("#driver_id").select2({
            width: '100%',
            allowClear: false
        });
        
        $("#people_ids").select2({
            width: '100%',
            allowClear: false
        });

        $("#error_pips").remove();

        $('#transportifyDiv').hide();
        $('#jecamsDiv').hide();
        $("#typo").on("change", function () {
            $("#error_pips").remove();
            var typo = $(this).val();
//            alert(type);
            if (typo == 'jecams') {
                $('.saveDeliveryIteneray').prop("disabled", false);
                $('#transportifyDiv').hide();
                $('#jecamsDiv').show();
            } else if (typo == 'transportify') {
                $('.saveDeliveryIteneray').prop("disabled", false);
                $('#transportifyDiv').show();
                $('#jecamsDiv').hide();
            } else {
                $('.saveDeliveryIteneray').prop("disabled", true);
                $('#transportifyDiv').hide();
                $('#jecamsDiv').hide();
            }
        });

        $(".saveDeliveryIteneray").on("click", function () {
            $("#error_pips").remove();
//            var countries = [];
//        $.each($(".people_id option:selected"), function(){            
//            countries.push($('#people_ids').val());
//        });
//        alert("You have selected the country - " + countries.join(", "));
//            console.log($('#people_ids').val());
            
            var people = $('#people_ids').val();
            var typo = $('#typo').val();
            var vehicle_id = 0;
            var driver_id = 0;
            if(typo=="jecams") {
                vehicle_id = $('#vehicle_id').val();
                driver_id = $('#driver_id').val();
            }
            var pickup_date = $('#pickup_date').val();
            var pickup_time = $('#pickup_time').val();
            var expected_start_date = $('#expected_start_date').val();
            var expected_start_time = $('#expected_start_time').val();
            var client_id = $('#client_id').val();
            var delivery_type = $('#delivery_type').val();
            var delivery_schedule_id = $('#delivery_schedule_id').val();
            var del_type = $('#del_type').val();
            var shipping_address = $('#shipping_address').val();
            var g_maps = $('#g_maps').val();

            var data = {"typo": typo,
                "vehicle_id": vehicle_id,
                "driver_id": driver_id,
                "pickup_date": pickup_date,
                "pickup_time": pickup_time,
                "people": people,
                "client_id": client_id,
                "expected_start_date": expected_start_date,
                "expected_start_time": expected_start_time,
                "client_id": client_id,
                "delivery_type": delivery_type,
                "delivery_schedule_id": delivery_schedule_id,
                "del_type": del_type,
                "shipping_address": shipping_address,
                "g_maps":g_maps
            }
            if (people.length === 0) {
                people = 0;
                $("#people_label").append('<span class="text-danger" id="error_pips"><small>*Required</small></span>')
            } else {
                if (expected_start_date == "") {
                    expected_start_date = null;
                    document.getElementById('expected_start_date').style.borderColor = "red";
                } else {
                    if (expected_start_time == "") {
                        expected_start_time = null;
                        swal({
                            title: "Oops!",
                            text: "Time cannot be empty. Please indicate time and try again.",
                            type: "warning"
                        });
                    } else {
                        if (typo == 'jecams') {
                            if (vehicle_id == "---- Select Vehicle ----") {
                                vehicle_id = 0;
                                swal({
                                    title: "Oops!",
                                    text: "Vehicle cannot be empty. Please indicate vehicle and try again.",
                                    type: "warning"
                                });
                            } else {

                                if (driver_id == "---- Select Driver ----") {
                                    driver_id = 0;
                                    swal({
                                        title: "Oops!",
                                        text: "Driver cannot be empty. Please indicate driver and try again.",
                                        type: "warning"
                                    });
                                } else {
                                    ///process jecams
//                                    console.log('process jecams');
                                    saveItenerary(data);
                                }
                            }

                        } else if (typo == 'transportify') {
                            if (pickup_date == "") {
                                pickup_date = null;
                                document.getElementById('pickup_date').style.borderColor = "red";
                            } else {
                                if (pickup_time == "") {
                                    pickup_time = null;
                                    document.getElementById('pickup_time').style.borderColor = "red";
                                } else {
                                    ///process trans
//                                    console.log('process trans');
                                    saveItenerary(data);
                                }
                            }
                        }
                    }
                }
            }

        });
        
        function saveItenerary(data) {  
            console.log(data);
            
                $.ajax({
                    url: "/delivery_iteneraries/addItenerary",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'text',
                    success: function (dd) {
//                        location.reload();
                        window.location.replace("/delivery_iteneraries/list_view?status=scheduled" );
                            // console.log(dd);
                    },
                    error: function (dd) {
                        console.log('error'+dd);
                    }
                });
        }
    });
</script>