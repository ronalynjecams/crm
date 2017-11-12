 
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
        <h1 class="page-header text-overflow">Leads</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if (($UserIn['User']['role'] == 'sales_executive') || ($UserIn['User']['role'] == 'marketing_staff')) { ?>
                        <button class="btn btn-mint" id="addLeadBtn" >
                            <i class="fa fa-plus"></i>  Add New Lead
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
                            <th>Contact Person / Position</th>
                            <th>Contact Number</th>
                            <th>Email</th> 
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Contact Person / Position</th>
                            <th>Contact Number</th>
                            <th>Email</th>  
                            <th> </th>  
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($leads as $lead) { ?>
                            <tr>
                                <td><?php echo $lead['Client']['name'] . '<small class="text-info"><br/>[' . $lead['Client']['tin_number'] . ']</small>'; ?></td>
                                <td><?php echo $lead['Client']['contact_person'] . '<small><br/>' . $lead['Client']['position'] . '</small>'; ?></td>
                                <td><?php echo $lead['Client']['contact_number']; ?></td>
                                <td><?php echo $lead['Client']['email']; ?></td> 
                                <td>
                                    <?php
                                    if (($UserIn['User']['role'] == 'sales_executive') || ($UserIn['User']['role'] == 'marketing_staff')) {
                                        echo '<a class="btn btn-default btn-icon add-tooltip updateLeadBtn" data-toggle="tooltip" href="#" data-original-title="Update Lead" data-id="' . $lead['Client']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                    }
                                    if ($UserIn['User']['role'] == 'marketing_staff') {
                                        echo '&nbsp;<a class="btn btn-danger btn-icon add-tooltip transferLead" data-toggle="tooltip" href="#" data-original-title="Transfer Lead" data-trid="' . $lead['Client']['id'] . '" ><i class="ion-arrow-return-left icon-lg"></i></a>';
                                    }
                                    ?>
                                </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>  
<!--Add New Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-lead-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Lead</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label>Contact Person <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"   id="contact_person">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control"  id="position">
                </div>
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"   id="address">
                </div>
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control"   id="email">
                </div>
                <div class="form-group">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="contact_number">
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="text" class="form-control"  id="tin_number">
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveLead">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Add New Lead Modal End--> 
<!--Update Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="update-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Lead</h4>
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
<!--Update Modal End--> 

<!--Transfer Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="transferLead-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Transfer Lead</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="lead_tr_id">  
                <div class="form-group"> 
                    <p class="text-danger" id="error_agent"></p>
                    <div class="col-lg-12">
                        <select id="agent_id"  style="width: 100%"> 
                            <option></option>
                            <?php foreach ($agents as $agent) { ?>
                                <option value="<?php echo $agent['User']['id']; ?>"><?php echo $agent['User']['first_name'] . '<span class="text-success">   [' . $agent['Team']['display_name'] . ']</span>'; ?></option>
                            <?php } ?> 
                        </select> 
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="transferLeadBtn">Transfer</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Transfer Lead Modal End-->  
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
    
    
    $('#addLeadBtn').on("click", function () {
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
            $('#add-lead-modal').modal('show');
        });


    $('#saveLead').on("click", function () {
        var name = $('#name').val();
        var contact_person = $('#contact_person').val();
        var position = $('#position').val();
        var address = $('#address').val();
        var email = $('#email').val();
        var contact_number = $('#contact_number').val();
        var tin_number = $('#tin_number').val();

        if ((name != "")) {
            if (contact_person != "") {
                if (address != "") {
                    if (email != "") {
                        if (contact_number != "") {
                            var data = {"name": name,
                                "contact_person": contact_person,
                                "position": position,
                                "address": address,
                                "email": email,
                                "contact_number": contact_number,
                                "tin_number": tin_number,
                                "type": 'lead'
                            }
                            $.ajax({
                                url: "/clients/add_leads",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (id) {
                                    location.reload();
                                },
                                erorr: function (id) {
                                    alert('error!');
                                }
                            });
                        } else {
                            document.getElementById('contact_number').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('email').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('address').style.borderColor = "red";
                }
            } else {
                document.getElementById('contact_person').style.borderColor = "red";
            }
        } else {
            document.getElementById('name').style.borderColor = "red";
        }
    });


    $(".updateLeadBtn").each(function (index) {
        $(this).on("click", function () {
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
            var id = $(this).data('id'); //this line gets value of data-id from delete button
            $('#update_lead_id').val(id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
            $('#update-modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal


            $.get('/clients/get_lead_info', {
                id: id,
            }, function (data) {
                console.log(data['name']);
                $('#uname').val(data['name']);
                $('#ucontact_person').val(data['contact_person']);
                $('#uposition').val(data['position']);
                $('#uaddress').val(data['address']);
                $('#uemail').val(data['email']);
                $('#ucontact_number').val(data['contact_number']);
                $('#utin_number').val(data['tin_number']);
            });


        });
    });

    $('#updateLeads').on("click", function () {
        var name = $('#uname').val();
        var contact_person = $('#ucontact_person').val();
        var position = $('#uposition').val();
        var address = $('#uaddress').val();
        var email = $('#uemail').val();
        var contact_number = $('#ucontact_number').val();
        var tin_number = $('#utin_number').val();
        var update_lead_id = $('#update_lead_id').val();

        if ((name != "")) {
            if (contact_person != "") {
                if (address != "") {
                    if (email != "") {
                        if (contact_number != "") {
                            var data = {"name": name,
                                "contact_person": contact_person,
                                "position": position,
                                "address": address,
                                "email": email,
                                "contact_number": contact_number,
                                "id": update_lead_id,
                                "tin_number": tin_number
                            }
                            $.ajax({
                                url: "/clients/update_leads",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (id) {
                                    location.reload();
                                }
                            });
                        } else {
                            document.getElementById('ucontact_number').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('uemail').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('uaddress').style.borderColor = "red";
                }
            } else {
                document.getElementById('ucontact_person').style.borderColor = "red";
            }
        } else {
            document.getElementById('uname').style.borderColor = "red";
        }
    });


    $(".transferLead").each(function (index) {
        $(this).on("click", function () {
            $("#agent_id").select2({
                placeholder: "Select Sales Executive",
                allowClear: true
            });
            var id = $(this).data('trid');
            $('#lead_tr_id').val(id);
            $('#transferLead-modal').modal('show');

        });
    });

    $('#transferLeadBtn').on("click", function () {
        var agent_id = $('#agent_id').val();
        var lead_tr_id = $('#lead_tr_id').val();
        if (agent_id != "") {
            var data = {"agent_id": agent_id,
                "lead_tr_id": lead_tr_id
            }
            console.log(data);
            $.ajax({
                url: "/clients/transfer_leads",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (id) {
                    location.reload();
                }
            });
        } else {
            $("#error_agent").append("Please Select Agent");
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