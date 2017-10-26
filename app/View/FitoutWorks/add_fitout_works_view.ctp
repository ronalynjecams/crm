<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>

<!-- REQUIRED FOR MULTIPLE SELECT ON QUOTATION -->
<link href="../plugins/chosen/chosen.min.css" rel="stylesheet">
<script src="../plugins/chosen/chosen.jquery.min.js"></script>

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Add Fitout Work</h1>
    </div>

        
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class = "panel">
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Client <span class="text-danger">*</span></label>
                        <select id="client_id" class="form-control">
                            <?php if ($clients['Client']['id'] != 0) {
                                ?><option value="<?php echo $clients['Client']['id']; ?>">
                                    <?php echo $clients['Client']['name']; ?>
                                </option><?php
                            }
                            ?>
                            <?php foreach ($clients as $client) {
                                ?>
                                <option value="<?php echo $client['Client']['id']; ?>" >
                                    <?php echo $client['Client']['name']; ?>
                                </option>
                                <?php
                            } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Project Head <span class="text-danger">*</span></label>
                        
                        <select id="project_head_id" class="form-control">
                            <?php if ($users['User']['id'] != 0) {
                                ?>
                                <option value="<?php echo $users['User']['id']; ?>">
                                    <?php echo $users['User']['first_name'].' '.$users['User']['last_name']; ?>
                                </option>
                                <?php
                            }
                            else { echo '<option>Select Project Head</option>'; }
                            ?>
                            <?php foreach ($users as $user) {
                                ?>
                                <option value="<?php echo $user['User']['id']; ?>">
                                    <?php echo $user['User']['last_name']." ".$user['User']['first_name']; ?>
                                </option>
                                <?php
                            } ?>
                        </select>
                    </div> 
                </div>
                <div class="col-lg-6">
                    <div class="form-group quotation_info">
                        <input type="hidden" id="passed_status" value="<?php echo $passed_status; ?>" />
                        
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Quotations</label> 
                            <select class="form-control" id="selected_quotations" style="width: 100%;" multiple> 
                                <option>Select Quotations</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Deadline Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="deadline_date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expected Start <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="expected_start">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel">
            <div class="panel-heading" align="center">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary" id="saveFitoutWork">Add</button>
                </h3>
            </div>
        </div>
    </div>
</div>  



<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
        $('.quotation_info').hide();
        
        $('#client_id').select2({
            allowClear: true
        });
        
        $('#quotation_id').chosen({width: '100%'});
        
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $('#saveFitoutWork').on("click", function () {
            console.log("called from saveFitoutWork");
            
            var passed_status = $('#passed_status').val();
            var quotation_id = $("#selected_quotations").val();
                                // $("#selected_quotations :selected").map(function(i, el) {
                                //     return $(el).val();
                                // });
            var deadline_date = $('#deadline_date').val();
            var expected_start = $('#expected_start').val();
            var project_head_id = $('#project_head_id').val();
            var client_id = $('#client_id').val();
            
            if ((client_id != "Select Client")) {
                if (quotation_id != "") {
                    if (deadline_date != "") {
                        if (expected_start != "") {
                            if (project_head_id != "Select Project Head") {
                                var data = {
                                    "deadline": deadline_date,
                                    "expected_start": expected_start,
                                    "user_id": project_head_id,
                                    "status": passed_status,
                                    "client_id": client_id,
                                    "quotation_id_array": quotation_id
                                }
                                $.ajax({
                                    url: "/fitout_works/add_fitout_works",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (id) {
                                        window.location = "/fitout_works/project?status="+passed_status;
                                    },
                                    erorr: function (id) {
                                        alert('error!');
                                        console.log("Failed to save");
                                    }
                                });
                                console.log(data);
                            } else {
                                document.getElementById('project_head_id').style.borderColor = "red";
                            }
                        } else {
                            document.getElementById('expected_start').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('deadline_date').style.borderColor = "red";
                    }
                }
            } else {
                document.getElementById('client_id').style.borderColor = "red";
            }
        });
        
        //---- this section is required in client and quotation selection ----/
         $('#deadline_date').on('change', function (e) {
            var value = $("#deadline_date").val();
    
        });
        
        // expected_start
        $('#expected_start').on('change', function (e) {
            var value = $("#expected_start").val();
        });
    
        // client
        $("#client_id").change(function () {
            var id = $("#client_id").val();
            
            $('#selected_quotations').empty().append('<option></option>');
            $("#selected_quotations").select2({
                placeholder: "Select Quotations",
                allowClear: true
            });
            
            $.get("/fitout_works/get_client_quotation", {id: id},
                function (data) {
                for (i = 0; i < data.length; i++) {
                    $('#selected_quotations').append($('<option>', {
                        value: data[i]['Quotation']['id'],
                        text: data[i]['Quotation']['quote_number']
                    }))
                }
            });
            
            $('.quotation_info').show();
        });
        //---- end of client and quotation selection ----//
    })
</script>

<script> 
    function killCopy(e) {
        return false
    }
    function reEnable() {
        return true
    }
    document.onselectstart = new Function("return false")
    if (window.sidebar) {
        document.onmousedown = killCopy
        document.onclick = reEnable
    }
</script>
<!---END OF JAVASCTRIPT FUNCTIONS--->