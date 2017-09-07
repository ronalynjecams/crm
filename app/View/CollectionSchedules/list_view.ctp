 
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
        <h1 class="page-header text-overflow">Collection Schedule</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if (($UserIn['User']['role'] == 'collection_officer')) { ?>
                        <button class="btn btn-mint" id="addLeadBtn" >
                            <i class="fa fa-print"></i>  Print
                        </button>
                    <?php } ?>

                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date of Collection</th>
                            <th>Client</th>
                            <th>Agent</th>
                            <th>Notes</th> 
                            <th>Collector</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date of Collection</th>
                            <th>Client</th>
                            <th>Agent</th>
                            <th>Notes</th> 
                            <th>Collector</th>
                            <th></th>  
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($lists as $list) { ?>
                            <tr>
                                <th><?php echo $list['CollectionSchedule']['created']; ?></th>
                                <th><?php echo $list['Quotation']['Client']['name']; ?></th>
                                <th><?php echo $list['Quotation']['User']['first_name']. ' ' .$list['Quotation']['User']['last_name'] ; ?></th>
                                <th><?php echo $list['CollectionSchedule']['agent_instruction']; ?></th> 
                                <th>
                                    <?php
                                    if ($UserIn['User']['role'] == 'collection_officer') {
                                        echo '<a class="btn btn-default btn-icon add-tooltip addCollectorBtn" data-toggle="tooltip" href="#" data-original-title="Add Collector" data-id="' . $list['CollectionSchedule']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                    }
//                                    if ($UserIn['User']['role'] == 'marketing_staff') {
//                                        echo '&nbsp;<a class="btn btn-danger btn-icon add-tooltip transferLead" data-toggle="tooltip" href="#" data-original-title="Transfer Lead" data-trid="' . $lead['Client']['id'] . '" ><i class="ion-arrow-return-left icon-lg"></i></a>';
//                                    }
                                    ?>
                                </th>
                                <th></th>
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
<div class="modal fade" id="add-collector" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Select Collector</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="update_lead_id">
                <div class="form-group" id="collector_validation">
                    <label>List of Collectors <span class="text-danger">*</span></label>
                    <select class="form-control" id="collector" >
                        <?php foreach ($collectors as $collector){ ?>
                        <option><?php echo $collector['Users']['first_name']. ' ' .$collector['Users']['last_name']; ?></option>
                        <?php } ?>
                    </select>
                    <!--<input type="text" class="form-control" placeholder="Name" id="uname">-->
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
    
    
    $('#addCollerBtn').on("click", function () {
//            $('#nameExistDiv').remove();
//            $('#unameExistDiv').remove();
            $('#add-collector').modal('show');
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


    $(".addCollectorBtn").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('id');
            $('#update_lead_id').val(id);
            $('#add-collector').modal('show');

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
