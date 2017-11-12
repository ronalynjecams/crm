 
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Clients</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if ($UserIn['User']['role'] == 'sales_executive') { ?>
                        <button class="btn btn-mint" id="addClientBtn" >
                            <i class="fa fa-plus"></i>  Add New Client
                        </button>
                    <?php } ?>
                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
        <!--                    <th>Contact Person / Position</th>
                            <th>Contact Number</th>
                            <th>Email</th> -->
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
        <!--                    <th>Contact Person / Position</th>
                            <th>Contact Number</th>
                            <th>Email</th>  -->
                            <th> </th>  
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <th><?php echo $user['User']['first_name'] . '  ' . $user['User']['last_name']; ?></th> 
                                <th><?php echo '<a class="btn btn-mint btn-icon add-tooltip updateUserBtn" data-toggle="tooltip" href="#" data-original-title="Update User" data-id="' . $user['User']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>'; ?></th> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div> 
<!--Update Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="update-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="user_id">

                <div class="form-group">
                    <label>Role <span class="text-danger">*</span></label>
                    <select id="role" class="form-control">
                        <option></option>
                        <?php
                        foreach ($roles as $role) {
                            echo '<option value="' . $role['Role']['name'] . '">' . $role['Role']['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Position <span class="text-danger">*</span></label>
                    <select id="position_id" class="form-control">
                        <option></option>
                        <?php
                        foreach ($positions as $position) {
                            echo '<option value="' . $position['Position']['id'] . '">' . $position['Position']['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Department <span class="text-danger">*</span></label>
                    <select id="department_id" class="form-control">
                        <option></option>
                        <?php
                        foreach ($departments as $department) {
                            echo '<option value="' . $department['Department']['id'] . '">' . $department['Department']['name'] . '</option>';
                        }
                        ?>
                    </select>
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
<!--Update Modal End--> 

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
    });



    $(".updateUserBtn").each(function (index) {
        $(this).on("click", function () {

            var id = $(this).data('id');
            $('#user_id').val(id);
            $('#update-modal').modal('show');
        });
    });

    $('#updateLeads').on("click", function () {
//        alert('asd');
        var role = $('#role').val();
        var position_id = $('#position_id').val();
        var department_id = $('#department_id').val();
        var user_id = $('#user_id').val();


        if ((role != "")) {
            if (position_id != "") {
                if (department_id != "") {

                    var data = {"user_id": user_id,
                        "role": role,
                        "position_id": position_id,
                        "department_id": department_id 
                    }
                    $.ajax({
                        url: "/users/update_role",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        success: function (id) {
                            location.reload();
                        }
                    });

                } else {
                    document.getElementById('department_id').style.borderColor = "red";
                }
            } else {
                document.getElementById('position_id').style.borderColor = "red";
            }
        } else {
            document.getElementById('role').style.borderColor = "red";
        }
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