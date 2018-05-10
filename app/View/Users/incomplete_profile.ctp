<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/erp_scripts.js"></script>  
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
                                <td><?php echo $user['User']['first_name'] . '  ' . $user['User']['last_name']; ?></td> 
                                <td><?php echo '<a class="btn btn-mint btn-icon add-tooltip updateUserBtn" data-toggle="tooltip" href="#" data-original-title="Update User" data-id="' . $user['User']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>'; ?></td> 
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
                <div class="form-group row">
                    <div class="col-lg-6">
                        <input type="hidden" class="form-control"  id="user_id">
                        <div class="form-group img-responsive">
                            <label>Profile Picture <span class="text-danger">*</span></label>
                            <!--CHANGE PATH BEFORE UPLOADING TO SERVER-->
                            <!--<img src="/product_uploads/image_placeholder.jpg"-->
                            <!--     class="img-responsive" id="img_preview_pp" />-->
                            <img src="/img/product-uploads/image_placeholder.jpg"
                                 class="img-responsive" id="img_preview_pp" />
                        </div>
                        <div class="form-group">
                            <input type="file" id="img_upload_pp" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Signature <span class="text-danger">*</span></label>
                            <input type="file" id="img_upload_sign" class="form-control" />
                        </div>
                        <div class="form-group img-responsive" id="div_img_preview_sign">
                            <!--CHANGE PATH BEFORE UPLOADING TO SERVER-->
                            <!--<img src="/product_uploads/image_placeholder.jpg"-->
                            <!--     class="img-responsive" id="img_preview_sign" />-->
                            <img src="/img/product-uploads/image_placeholder.jpg"
                                 class="img-responsive" id="img_preview_sign" />
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Role <span class="text-danger">*</span></label>
                    <select id="role" class="form-control">
                        <option></option>
                        <?php
                        foreach ($roles as $role) {
                            $role_tmp = $role['Role']['name'];
                            $rolename = ucwords(str_replace("_"," ",$role_tmp));
                            echo '<option value="' . $role_tmp . '">' . $rolename . '</option>';
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
                            $position_tmp = $position['Position']['name'];
                            $position_name = ucwords(strtolower($position_tmp));
                            echo '<option value="' . $position['Position']['id'] . '">' . $position_name . '</option>';
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

                <div id="div_quota_team">
                    <div class="form-group">
                        <label>Tin Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="000-000-000-000"
                               id="input_tin_number" onkeypress="return validateInput(tinformat)" />
                    </div>
                    <div class="form-group">
                        <label>Quota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="input_quota"
                               onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
                    </div>
                    <div class="form-group">
                        <label>Team <span class="text-danger">*</span></label>
                        <select class="form-control" id="select_team">
                            <option>----Select Team----</option>
                            <?php
                                foreach($teams as $ret_team) {
                                    $team = $ret_team['Team'];
                                    $team_id = $team['id'];
                                    $name = ucwords($team['name']);

                                    echo '
                                        <option value="'.$team_id.'">'.$name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
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

    $("#div_img_preview_sign").hide();
    function readURL(input, type) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                if(type=="pp") {
                    $('#img_preview_pp').attr('src', e.target.result);
                }
                else if(type=="sign") {
                    $("#img_preview_sign").attr('src', e.target.result);
                }
                else {
                    console.log("Preview image holder unidentified.");
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $('#img_upload_pp').change(function(){
    	readURL(this, "pp");
    });
    
    $('#img_upload_sign').change(function(){
        $("#div_img_preview_sign").show();
    	readURL(this, "sign");
    });
    
    $("#role").select2({
        allowClear: true,
        width: '100%'
    });
    
    $("#position_id").select2({
        allowClear: true,
        width: '100%'
    });
    
    $("#department_id").select2({
        allowClear: true,
        width: '100%'
    });
    
    $("#select_team").select2({
        allowClear: true,
        width: '100%'
    });
    
    // var tinformat = new RegExp("[0-9]{3}-[0-9]{3}-[0-9]{3}");
    var tinformat = new RegExp("[0-9-]");
    function validateInput(validChars) {
        var keyChar = String.fromCharCode(event.which || event.keyCode);
        console.log(keyChar);
        console.log(validChars.test(keyChar));
        return validChars.test(keyChar) ? keyChar : false;
    }

    $(".updateUserBtn").each(function (index) {
        $(this).on("click", function () {

            var id = $(this).data('id');
            $('#user_id').val(id);
            $('#update-modal').modal('show');
        });
    });

    // MARK: OFFLINE MODIFICATION
    $("#div_quota_team").hide();

    $("#role").on('change', function() {
        var role = $(this).val();
        if(role == "sales_executive" ||
           role == "sales_manager" || role == "sales_coordinator") {
            $("#div_quota_team").show();
        }
        else {
            $("#div_quota_team").hide();
        }
    });
    
    var quotaval = 0;
    var teamval = 0;
    $('#updateLeads').on("click", function () {
        var role = $('#role').val();
        var position_id = $('#position_id').val();
        var department_id = $('#department_id').val();
        var department_name = $('#department_id option:selected').text();
        var user_id = $('#user_id').val();
        var quota = $("#input_quota");
        var team = $("#select_team");
        var img_pp = $("#img_upload_pp");
        var img_sign = $("#img_upload_sign");
        var tin_number = $("#input_tin_number");
        
        var img_data_pp = new FormData();
        //Append files infos
        jQuery.each($('input:file')[0].files, function(i, file) {
            img_data_pp.append('Image', file);
        });
        
        var img_data_sign = new FormData();
        //Append files infos
        jQuery.each($('input:file')[1].files, function(i, file) {
            img_data_sign.append('Image', file);
        });
        
        $.ajax({  
			url: "/products/image_upload",  
			type: "POST",  
			data: img_data_pp,  
			cache: false,
			processData: false,  
			contentType: false, 
			context: $('input:file'),
			success: function (msg) {
				console.log(msg+"---Profile Picture was uploaded");
			    $.ajax({  
        			url: "/users/sign_upload",  
        			type: "POST",  
        			data: img_data_sign,  
        			cache: false,
        			processData: false,  
        			contentType: false, 
        			context: $('input:file'),
        			success: function (msg) {
        				console.log(msg+"---Signature was uploaded");
        				var image_tmp_pp = (img_pp.val()).split('\\');
                	    var image_filename_pp = image_tmp_pp[image_tmp_pp.length-1];
        				var image_tmp_sign = (img_sign.val()).split('\\');
                	    var image_filename_sign = image_tmp_sign[image_tmp_sign.length-1];
                	    console.log(image_filename_pp);
                	    console.log(image_filename_sign);
        				if(img_pp.val()!="") {
                            if(img_sign.val()!="") {
                                if ((role != "")) {
                                    if (position_id != "") {
                                        if (department_id != "") {
                                            if(department_name == "Sales Department") {
                                                if(tin_number.val()!="") {
                                                    if(quota.val()!="") {
                                                        if(team.val()!="----Select Team----") {
                                                            quotaval = quota.val();
                                                            teamval = team.val();
                            
                                                            var data = {"img_pp": image_filename_pp,
                                                                "img_sign": image_filename_sign,
                                                                "user_id": user_id,
                                                                "role": role,
                                                                "position_id": position_id,
                                                                "department_id": department_id,
                                                                "department_name": department_name,
                                                                "quota": quotaval,
                                                                "team": teamval,
                                                                "tin": tin_number.val()
                                                            }
                                                            console.log(data);
                                                            $.ajax({
                                                                url: "/users/update_role",
                                                                type: 'POST',
                                                                data: {'data': data},
                                                                dataType: 'json',
                                                                success: function (id) {
                                                                    console.log(id);
                                                                    location.reload();
                                                                },
                                                                error: function(eror) {
                                                                    console.log(error);
                                                                    swal({
                                                                        title: "Oops!",
                                                                        text: "An error occurred during role update. \n Please try again.",
                                                                        type: "warning"
                                                                    });
                                                                }
                                                            });
                                                        }
                                                        else {
                                                            swal({
                                                               title: "Oops!",
                                                               text: "Team cannot be empty.\nPlease select team.",
                                                               type: "warning"
                                                            });
                                                        }
                                                    }
                                                    else {
                                                        swal({
                                                           title: "Oops!",
                                                           text: "Quota cannot be empty.\nPlease enter quota.",
                                                           type: "warning"
                                                        });
                                                    }
                                                }
                                                else {
                                                    swal({
                                                        title: "Oops!",
                                                        text: "TIN number cannot be empty.\nPlease Enter TIN number.",
                                                        type: "warning"
                                                    });
                                                }
                                            }
                                            else {
                                                var data = {"img_pp":image_filename_pp,
                                                    "img_sign":image_filename_sign,
                                                    "user_id": user_id,
                                                    "role": role,
                                                    "position_id": position_id,
                                                    "department_id": department_id,
                                                    "department_name": department_name
                                                }
                                                console.log(data);
                                                $.ajax({
                                                    url: "/users/update_role",
                                                    type: 'POST',
                                                    data: {'data': data},
                                                    dataType: 'json',
                                                    success: function (id) {
                                                        console.log(id);
                                                        location.reload();
                                                    }
                                                });
                                            }
                        
                                        } else {
                                            swal({
                                                title: "Oops!",
                                                text: "Department cannot be empty.\nPlease select department",
                                                type: "warning"
                                            });
                                        }
                                    } else {
                                        swal({
                                            title: "Oops!",
                                            text: "Position cannot be empty.\nPlease select position.",
                                            type: "warning"
                                        });
                                    }
                                } else {
                                    swal({
                                        title: "Oops!",
                                        text: "Role cannot be empty.\nPlease select role.",
                                        type: "warning"
                                    });
                                }
                            }
                            else {
                                img_sign.css({'border-color':'red'});
                            }
                        }
                        else {
                            img_pp.css({'border-color':'red'});
                        }
        			},
        			error: function(error) {
        			    swal({
        			        title: "Error!",
        			        text: "There was a problem while uploading signature.\nPlease try again",
        			        type: "warning"
        			    });
        			}
                });
			},
			error: function(error) {
			    swal({
			        title: "Error!",
			        text: "There was a problem while uploading profile picture.\nPlease try again",
			        type: "warning"
			    });
			}
        });
    });
    // MARK: END OF OFFLINE MODIFICATION
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