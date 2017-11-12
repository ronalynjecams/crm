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
        <h1 class="page-header text-overflow">Edit Fitout Work</h1>
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
                        <input type="hidden" id="fitout_work_id" value="<?php echo $fitout_work_object['FitoutWork']['id']; ?>" readonly />
                        <br/>
                        
                        <label>Client <span class="text-danger">*</span></label>
                        <select id="client_id" class="form-control">
                            <option value="<?php echo $fitout_work_object['FitoutWork']['client_id'] ?>">
                                <?php echo $fitout_work_object['Client']['name']; ?>
                            </option>
                            
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
                            <option value="<?php echo $fitout_work_object['User']['id'] ?>">
                                <?php echo $fitout_work_object['User']['first_name'].' '.$fitout_work_object['User']['last_name']; ?>
                            </option>
                            
                            <?php foreach ($users as $user) {
                                ?>
                                <option value="<?php echo $user['User']['id']; ?>" >
                                    <?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?>
                                </option>
                                <?php
                            } ?>
                        </select>
                    </div> 
                </div>
                <div class="col-lg-6">
                    <div class="form-group quotation_info">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Quotations</label> 
                            
                            <div id="old_selected">
                            <select class="form-control old_selected_quotations" style="width: 100%;" multiple> 
                                <?php
                                    foreach($fitout_quote_object as $fitout_quote) {
                                        echo '<option selected = "selected" value="'.$fitout_quote['FitoutQoute']['quotation_id'].'">
                                        '.$fitout_quote['Quotation']['quote_number'].'
                                        </option>';
                                    }
                                ?>
                                <?php 
                                    foreach($quotations as $quotation) {
                                        echo '<option value="'.$quotation['Quotation']['quotation_id'].'">
                                        '.$quotation['Quotation']['quote_number'].'
                                        </option>';
                                    }
                                ?>
                            </select>
                            </div>
                            <div id="new_selected">
                                <select class="form-control new_selected_quotations" style="width: 100%;" multiple> 
                                    <option>Select New sets of Quotations</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Deadline Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="deadline_date"
                                     value="<?php echo $fitout_work_object['FitoutWork']['deadline'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expected Start <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="expected_start"
                                    value="<?php echo $fitout_work_object['FitoutWork']['expected_start']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel">
            <div class="panel-heading" align="center">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary" id="updateFitoutWork">Update</button>
                </h3>
            </div>
        </div>
    </div>
</div>  



<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
        $('#client_id').select2({
            allowClear: true
        });
        
        $('.old_selected_quotations').chosen({
            allowClear: true
        });
        
        $("#new_selected").hide();
        $("#old_selected").show();
        
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $('#updateFitoutWork').on("click", function () {
            console.log("called from editFitoutWork");
            
            var id = $("#fitout_work_id").val();
            
            var old_quotation_id = $(".old_selected_quotations").val();
            var new_quotation_id = $(".new_selected_quotations").val();
       
            console.log(new_quotation_id);
            console.log(old_quotation_id);
            
            var deadline_date = $('#deadline_date').val();
            var expected_start = $('#expected_start').val();
            var project_head_id = $('#project_head_id').val();
            var client_id = $('#client_id').val();
            var status = $("#status").val();
            
            if ((client_id != "Select Client")) {
                // if (quotation_id != "") {
                    if (deadline_date != "") {
                        if (expected_start != "") {
                            if (project_head_id != "Select Project Head") {
                                var data = {
                                    "id": id,
                                    "deadline": deadline_date,
                                    "expected_start": expected_start,
                                    "user_id": project_head_id,
                                    "status": status,
                                    "client_id": client_id,
                                    "old_quotation_id": old_quotation_id,
                                    "new_quotation_id": new_quotation_id
                                }
                                $.ajax({
                                    url: "/fitout_works/update_fitout_works",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (id) {
                                        window.location = "/fitout_works/project?status="+status;
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
                // } else {
                //       document.getElementById('uselected_quotations').style.borderColor = "red";
                //     }
            } else {
                document.getElementById('client_id').style.borderColor = "red";
            }
        });           
 
        //---- this section is required in client and quotation selection ----/
        
        // client
        $("#client_id").change(function () {
            $("#new_selected").show();
            $("#old_selected").hide(); 
            $(".old_selected").empty().append('<option></option>');
            
            var id = $("#client_id").val();
            
            $(".new_selected_quotations").empty().append('<option></option>');
            $(".new_selected_quotations").select2({
                placeholder: "Select Quotations",
                allowClear: true
            });
            
            $.get("/fitout_works/get_client_quotation", {id: id},
                function (data) {
                for (i = 0; i < data.length; i++) {
                    $('.new_selected_quotations').append($('<option>', {
                        value: data[i]['Quotation']['id'],
                        text: data[i]['Quotation']['quote_number']
                    }))
                }
            });
        });
    });
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