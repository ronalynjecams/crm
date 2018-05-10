<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link href="/css/plug/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="/css/plug/select/js/select2.min.js"></script>  
<script src="/css/plug/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

<!--TINYMCE-->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Collection schedule</h1>
    </div>
    <div id="page-content">  
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary addCollectionSchedule" data-buttontype="save" >Collect Payment</button>  
                </h3>
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
                            <div class="col-sm-4">  
                            <?php
                            // pr($collectors);
                            ?>
                                    <label>Select Quotation</label> 
                                    <select class="form-control" id="quotation_id">
                                        <option></option>
                                        <?php 
                                            foreach($quotations as $quotation){
                                                echo '<option value="'.$quotation['Quotation']['id'] .'">'.$quotation['Quotation']['quote_number'] .' - &#8369; '.number_format($quotation['Quotation']['grand_total']) .'</option>';
                                            }
                                        ?>
                                    </select> 
                                </div> 
                            
                            <div class="col-sm-4"> 
                                    <label>Expected Amount to be Collected</label> 
                                        <input type="number" step="any" class="form-control" id="expected_amount" />  
                                </div> 
                                
                            <div class="col-sm-4">  
                                    <label>Select Collector</label> 
                                    <select class="form-control" id="user_id">
                                        <option></option>
                                        <?php 
                                            foreach($collectors as $user){
                                                echo '<option value="'.$user['User']['id'] .'"> '.$user['User']['first_name'] .' '.$user['User']['last_name'] .'</option>';
                                            }
                                        ?>
                                    </select> 
                                </div> 
                            <div class="col-sm-4"> 
                                    <label>Date of Collection</label>
                                    <div class="input-group input-append date" id="datePicker-collection">
                                        <input type="text" class="form-control" name="date" readonly id="collection_date" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div> 
                            </div>
                            <div class="col-sm-4"> 
                                <label>Time of Collection</label>  

                                <div class="input-group date">
                                    <input id="collection_date_time" type="text" readonly class="form-control">
                                    <span class="input-group-addon"  ><i class="demo-pli-clock"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-12" id="agent_instructions"> 
                                <label class=" control-label"><b>Collection Instructions</b><br/>

                                    <small class="text-danger">[Please make sure that all details regarding collection schedule are correct.
                                        <br/>Moreover, instructions should be clear, detailed, and complete to avoid delays during collection. ]</small>
                                </label> 
                                <textarea id="agent_instruction" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
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
<script>
    $(document).ready(function () {

        $("#quotation_id").select2({
            placeholder: "Select Quotation",
            width: '100%',
            allowClear: false
        });
        $("#user_id").select2({
            placeholder: "Select Collector",
            width: '100%',
            allowClear: false
        });

        var date = new Date();
        date.setDate(date.getDate() - 1);
        // $('#datePicker-deliver')
        //         .datepicker({
        //             format: 'yyyy-mm-dd',
        //             startDate: date,
        //         });
        $('#datePicker-collection')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });
        $('#collection_date_time').timepicker();



    });



    $(".addCollectionSchedule").click(function () {
        // $("#tin_error").remove();
        $("#sgent_error").remove();
        // var vat_type = $("#vat_type").val();
        // var term_id = $("#term_id").val();
        // var delivery_mode = $("#delivery_mode").val();
        var user_id = $("#user_id").val();
        var quotation_id = $("#quotation_id").val();
        var expected_amount = $("#expected_amount").val();
        var collection_date = $("#collection_date").val();
        var collection_date_time = $("#collection_date_time").val();
        // var agent_instruction = $("#agent_instruction").val();
        
        
	    var agent_instruction = tinyMCE.get('agent_instruction').getContent();
        // var client_id = $("#client_id").val();
        // var advance_invoice = $("#advance_invoice").val();
        
        // console.log(collection_date_time);

        var data = { 
            "user_id": user_id,
            "expected_amount": expected_amount, 
            "collection_date": collection_date,
            "collection_date_time": collection_date_time,
            "agent_instruction": agent_instruction,
            "quotation_id": quotation_id, 
        }



        if (quotation_id != "") {
            if (user_id != "") {
                if (collection_date != "") {
                if (expected_amount != "") {
                    if (collection_date_time != "") {
                        if (agent_instruction != "") { 
                            
        $(".addCollectionSchedule").prop('disabled', true);
        $.ajax({
            url: "/collection_schedules/add_schedule_process",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                // location.reload();
                window.location.replace("/collection_schedules/list_view?status=for_collection");
//                console.log(dd);
            },
            error: function (dd) {
                console.log(dd);
            }
        });
                        } else {
                            $("#agent_instructions").append('<span class="text-danger" id="sgent_error">Instruction is required.</span>')
                        }
                    } else {
                        document.getElementById('collection_date_time').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('collection_date_time').style.borderColor = "red";
                }
                } else {
                    document.getElementById('collection_date').style.borderColor = "red";
                }
            } else {
                document.getElementById('user_id').style.borderColor = "red";
            }
        } else {
            document.getElementById('quotation_id').style.borderColor = "red";
        }


    });
 
</script>
