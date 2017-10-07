 
<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  
<script src="../js/sweetalert.min.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Collection Schedule (<small><?php echo str_replace('_', ' ', $this->params['url']['status']);?></small>)</h1>
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
            <div class="panel-body table-responsive">
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
                        <?php foreach ($lists as $list) {  
                            
                            ?>
                            <tr>
                                <td> 
                                    <?php
                                    echo date('F d, Y', strtotime($list['CollectionSchedule']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($list['CollectionSchedule']['created'])) . '</small>';
                                    ?> 
                                </td>
                                <td><?php echo $list['Quotation']['Client']['name']; ?></td>
                                <td><?php echo $list['Quotation']['User']['first_name'] . ' ' . $list['Quotation']['User']['last_name']; ?></th>
                                <td><?php echo $list['CollectionSchedule']['agent_instruction']; ?></td> 
                                <td>
                                    <?php
                                    if ($UserIn['User']['role'] == 'collection_officer') {
//                                        if ($list['CollectionSchedule']['user_id'] == 0) {
                                            echo '<a class="btn btn-default btn-icon add-tooltip addCollectorBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="Add Collector" data-id="' . $list['CollectionSchedule']['id'] . '" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
//                                        }else{
                                            echo '     '.$list['User']['first_name'].' '.$list['User']['first_name'];
//                                        }
                                               
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        
                                        echo '<a class="btn btn-danger btn-icon add-tooltip cancelCollectorBtn" data-toggle="tooltip" href="#" data-original-title="Cancel Schedule" data-idcancel="' . $list['CollectionSchedule']['id'] . '"  ><i class="fa fa-window-close"></i></a>';
//                                        echo '  <a class="btn btn-warning btn-icon add-tooltip reschedCollectorBtn" data-toggle="tooltip" href="#" data-original-title="Change Schedule" data-idresched="' . $list['CollectionSchedule']['id'] . '"  ><i class="fa fa-calendar"></i></a>';
                                   
                                        if ($list['CollectionSchedule']['user_id'] != 0) {
                                            echo '  <a class="btn btn-success btn-icon add-tooltip addCollection" data-toggle="tooltip" href="#" data-original-title="Update Collection" data-idaddcollection="' . $list['CollectionSchedule']['quotation_id'] . '" ><i class="fa fa-money"></i></a>';
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

<!--===================================================--> 
<div class="modal fade" id="add-collector" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <input type="hidden" id="collector_schedule_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Select Collector</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                 <div class="form-group" id="collector_validation">
                    <label>List of Collectors <span class="text-danger">*</span></label>
                    <select class="form-control" id="collector_id" >
                        <option></option>
                        <?php foreach ($collectors as $collector) { ?>
                            <option value="<?php echo $collector['Users']['id']; ?>"><?php echo $collector['Users']['first_name'] . ' ' . $collector['Users']['last_name']; ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveCollectorBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--===================================================--> 
<div class="modal fade" id="resched-collection" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <input type="text" id="cllector_sched_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Change Collection Schedule</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                            <div class="col-sm-6">
                                <div id="delivery_date_div_value">
                                    <label>Date of Collection</label>
                                    <div class="input-group input-append date" id="datePicker-collection">
                                        <input type="text" class="form-control" name="date" readonly id="new_collection_date" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                    <label>Time of Collection</label>  

                                <div class="input-group date">
                                    <input id="new_collection_date_time" type="text" readonly class="form-control">
                                    <span class="input-group-addon"  ><i class="demo-pli-clock"></i></span>
                                </div>
                            </div>
<!--                 <div class="form-group" id="collector_validation">
                    <label>List of Collectors <span class="text-danger">*</span></label>
                    <select class="form-control" id="collector_id" >
                        <option></option>
                        <?php foreach ($collectors as $collector) { ?>
                            <option value="<?php echo $collector['Users']['id']; ?>"><?php echo $collector['Users']['first_name'] . ' ' . $collector['Users']['last_name']; ?></option>
                        <?php } ?>
                    </select> 
                </div>-->
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveCollectorBtn">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
    }); 

    $(".addCollectorBtn").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('id');
            $('#collector_schedule_id').val(id);
            $('#add-collector').modal('show');

        });
    });
    

    $(".addCollection").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('idaddcollection');
//            $('#collector_schedule_id').val(id);
//            $('#add-collector').modal('show');
     window.location.replace("/collections/collect?id=" + id);
            

        });
    });
    

    $(".cancelCollectorBtn").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('idcancel');
            
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this process once cancelled.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {

                            $.ajax({
                                url: "/collection_schedules/cancelSched",
                                type: 'POST',
                                data: {'id': id},
                                dataType: 'json',
                                success: function (dd) {
                                    //redirect to edit of products 
                                    location.reload();
//                                        window.location.replace("/job_requests/joupdate?id=" + quotation_id);
//                                    console.log(dd);
                                },
                                error: function (dd) {
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });

        });
    });


    $('#saveCollectorBtn').on("click", function () {
        var collector_id = $('#collector_id').val();
        var collector_schedule_id = $('#collector_schedule_id').val();

        if ((collector_id != "")) { 
            $("#saveCollectorBtn").prop("disabled", true);
            var data = {"collector_id": collector_id,
                "collector_schedule_id": collector_schedule_id, 
            }
//            console.log(data);
            $.ajax({
                url: "/collection_schedules/updateCollector",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (id) {
                    location.reload();
                }
            });

        } else {
            document.getElementById('collector_id').style.borderColor = "red";
        }
    });
    

    $(".reschedCollectorBtn").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('idresched');
            $('#cllector_sched_id').val(id);
            $('#resched-collection').modal('show');

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
