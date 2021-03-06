

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>  

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Rejected Quotations</h1>
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
                        <a class="btn btn-mint " style="color:white" href="/quotations/create" >
                            <i class="fa fa-plus"></i>  Add New Quotations
                        </a>
                    <?php } ?>
                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Type</th> 
                            <th align="center">Subject</th>
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th> 
                            <th align="center"> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // pr($pending_quotations);
                        foreach ($pending_quotations as $pending_quotation) {
                            ?>
                            <tr>
                                <td data-order="<?php echo $pending_quotation['Quotation']['created']; ?>">
                                    <?php
                                    echo time_elapsed_string($pending_quotation['Quotation']['created']);
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['created'])) . '</small>';
                                    ?> 
                                </td>
                                <td>
                                    <?php 
                                    echo $pending_quotation['Quotation']['type'] ;
                                    ?> 
                                </td> 
                                <td><?php echo $pending_quotation['Quotation']['subject']; ?></td>
                                <td>
                                    <?php
                                    echo $pending_quotation['Client']['name'];
                                    echo '<br/><small>[' . $pending_quotation['Quotation']['quote_number'] . ']</small>';
                                    ?> 
                                </td> 
                                <td align="right">
                                    <?php
                                    echo '&#8369; ' . number_format($pending_quotation['Quotation']['grand_total'], 2);
                                    ?>
                                </td> 
                                <td>
                                    <?php
                                    if ($pending_quotation['Quotation']['job_request_id'] != 0) {
                                        // =========================> JOB REQUEST REVISION START HERE
                                        $date_up = new DateTime(date('Y-m-d', strtotime("2018-05-03")));
                                        $jo_created = new DateTime(date('Y-m-d', strtotime($pending_quotation['JobRequest']['created'])));
                                        $interval = $date_up->diff($jo_created);
                                        $interval_day = $interval->format('%R%a');
                                        if($interval_day>=0) {
                                            echo '  
                                                <div class="input-group mar-btm">
                                                <input type="text" class="form-control" placeholder="Name" readonly value="' . $pending_quotation['JobRequest']['jr_number'] . '">
                                                <span class="input-group-btn">
                                                 <a href="/job_requests/view_jr?id='.$pending_quotation['JobRequest']['id'].'" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="View Job Request?" ><i class="fa fa-external-link"></i> </a> 
                                                </span>
                                            </div>';
                                        }
                                        else {
                                            echo '<div class="input-group mar-btm">
                                                <input type="text" class="form-control" placeholder="Name" readonly value="' . $pending_quotation['JobRequest']['jr_number'] . '">
                                                <span class="input-group-btn">
                                                 <a class="jrupdateBtn btn btn-warning btn-icon  add-tooltip"
                                                          data-toggle="tooltip" 
                                                          data-original-title="Update Job Request!"  type="button"
                                                          href="/job_requests/joupdate?id='.$pending_quotation['Quotation']['id'].'">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                </a></span>
                                            </div>';
                                        }
                                        // ======================> JOB REQUEST REVISION END HERE
                                    } else {
                                        echo '<br/><button  class="btn btn-default  btn-icon  add-tooltip jobRequeBtn" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" data-quoteid="' . $pending_quotation['Quotation']['id'] . '" data-jrid="'.$pending_quotation['Quotation']['job_request_id'].'"><i class="fa fa-plus"></i></button>';
                                    }
                                    ?>
                                </td> 
                                <td>
                                    <?php if (AuthComponent::user('role') == 'sales_executive') { ?>
                                        <button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?"   data-upquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-edit"></i></button>
                                        <?php
//                                        if ($pending_quotation['Quotation']['job_request_id'] == 0) { ?>
                                            <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Delete Quotation?" data-typo="deleted" data-delquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-jrid="<?php echo $pending_quotation['Quotation']['job_request_id']; ?>"><i class="fa fa-window-close"></i> </button>
                                            <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Lost Quotation?" data-typo="lost" data-delquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-jrid="<?php echo $pending_quotation['Quotation']['job_request_id']; ?>"><i class="fa fa-thumbs-down"></i> </button>
                                            <?php
//                                        }
                                    }
                                    ?>
                                    <button class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </button>
                                <button class="btn btn-primary btn-icon add-tooltip print_quote" data-toggle="tooltip"  data-original-title="Print Quotation?" data-printquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-print"></i> </button>
                                </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Type</th> 
                            <th align="center">Subject</th>
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th>  
                            <th> </th>  
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--===================================================--> 
<script>
    $(document).ready(function () {
        $('.jobRequeBtn').each(function (index) {
            $(this).click(function () {
//            $("#jobRequestBtn").prop("disabled", true);
                var date = new Date();
                var month = date.getMonth();
                var number = (Math.random() + ' ').substring(2, 5) + (Math.random() + ' ').substring(2, 5);

                var quotation_id = $(this).data("quoteid");
                var status = 'pending';
                var jr_number = 'JECJR-' + month + number;
                var jr_id = $(this).data('jrid');
                swal({
                    title: "Are you sure?",
                    text: "You will create job request for this quotation?"+
                           "\nPlease make sure that quotation products are NOT supply.",
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
                            url: "/job_requests/saveNewJobRequest_newtbl",
                            type: 'POST',
                            data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id, 'jrid':jr_id},
                            dataType: 'text',
                            success: function (success) {
                                console.log(success);
                                swal({
                                    title: "Success!",
                                    text: "Successfully added Job Request.",
                                    type: "success"
                                },
                                function(isConfirm1) {
                                    if(isConfirm1) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function (error) {
                                console.log(error);
                                swal({
                                    title: "Oops!",
                                    text: "An error occurred. Please try again.",
                                    type: "warning"
                                });
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
            });
        });

        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "desc"]],
            "stateSave": true
        });


        $('.update_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("upquoteid"); 
                window.location.replace("/quotations/update_quotation?id=" + qid);
            });
        });
        $('.delete_quote').each(function (index) {
            $(this).click(function () {
                var id = $(this).data("delquoteid");
                var type = $(this).data("typo");
                var jrid =  $(this).data("jrid");
                
                if(jrid ==0){
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this quotation!",
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
                                    url: "/quotations/delete_lost_pending",
                                    type: 'POST',
                                    data: {'id': id, type: type},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();
                                    },
                                    error: function (dd) {
                                        console.log(type);
                                    }
                                });
                            } else {
                                swal("Cancelled", "", "error");
                            }
                        });
                    }else{
                        swal("Quotation could not be deleted or lost");
                    }
            });
        });


        $('.view_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("viewquoteid");
                window.open("/quotations/view?id=" + qid, '_blank'); 
            });
        });


        $('.print_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("printquoteid");
                window.open("/pdfs/print_quote?id=" + qid, '_blank');
//                window.location.replace("/pdfs/print_quote?id=" + qid);
            });
        });


        // $('.jrupdateBtn').each(function (index) {
        //     $(this).click(function () {
        //         var quote_id = $(this).data("jobrid");
        //         window.open("/job_requests/joupdate?id=" + quote_id, '_blank'); 
        //     });
        // });

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