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
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Fitout Work Projects</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">
                    <?php if (($UserIn['User']['role'] == 'fitout_facilitator')) { ?>
                    <button class="btn btn-mint" id="addFitoutWorkBtn" >
                        <i class="fa fa-plus"></i>  Add New Fitout Work
                    </button>
                    <?php } ?>
                </h3>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Deadline Date</th>
                            <th>Expected Start</th>
                            <th>Project Head</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Deadline Date</th>
                            <th>Expected Start</th>
                            <th>Project Head</th>
                            <th>Status</th>  
                            <th>Action</th>  
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fitoutworks as $fitoutwork) { ?>
                        <tr>
                            <th><?php echo $fitoutwork['FitoutWork']['deadline']; ?></th>
                            <th><?php echo $fitoutwork['FitoutWork']['expected_start']; ?></th>
                            <th><?php echo $fitoutwork['User']['last_name'].' '.$fitoutwork['User']['first_name']; ?></th>
                            <th><?php echo ucwords($fitoutwork['FitoutWork']['status']); ?></th>
                            <th class='text-center'>
                                <button class="btn btn-primary btn-sm" id="viewFitoutWork" >
                                    <i class="fa fa-eye"></i>
                                </button>
                            </th>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  

<!--Add New Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-fitout-work-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Fitout Work</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group">
                    <label>Select Quotation <span class="text-danger">*</span></label>
                    
                    <select id="qoutation_id" class="form-control">
                        <option>Select Quotation</option>
                    <?php foreach ($quotations as $q) {
                         echo $q['Quotation']['subject']; 
                        ?>
                        <option value="<?php echo $q['Quotation']['id']; ?>"><?php echo $q['Quotation']['subject']; ?></option>
                        <?php
                    } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deadline Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="deadline_date">
                </div>
                <div class="form-group">
                    <label>Expected Start <span class="text-danger">*</span></label>
                    <input type="date" class="form-control"   id="expected_start">
                </div>
                <div class="form-group">
                    <label>Project Head <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="project_head">
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveFitoutWork">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Add New Lead Modal End--> 
<!--Update Fir Modal Start-->
<!--===================================================-->
<div class="modal fade" id="update-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class"modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Fitout Work</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="update_lead_id">
                <div class="form-group" id="uname_validation">  
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Name" id="uname">
                </div>
                <div class="form-group">
                    <label>Contact Person <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Contact Person" id="ucontact_person">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control" placeholder="Position" id="uposition">
                </div>
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Address" id="uaddress">
                </div>
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="Email Address" id="uemail">
                </div>
                <div class="form-group">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Contact Number" id="ucontact_number">
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="text" class="form-control" placeholder="TIN" id="utin_number">
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateLeads">Update</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->


<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });


        ///// check if lead already exist on other sales executive who are also an active user /////
        $('#name, #uname').on('keyup', function (e) {
            var name = $('#name').val();
            $('#name').val($('#name').val().toUpperCase());
            $('#uname').val($('#uname').val().toUpperCase());
            $.get('/clients/check_client_existence', {
                name: name,
            }, function (data) { 
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
                    if(data.length != 0){
                        $('#name_validation').append('<div id="nameExistDiv" class="text-danger">This lead is also owned by '+data+'</div>');
                        $('#uname_validation').append('<div id="unameExistDiv" class="text-danger">This lead is also owned by '+data+'</div>');
                    } 
            });
 
        });
    });

    $('#addFitoutWorkBtn').on("click", function () {
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
            $('#add-fitout-work-modal').modal('show');
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