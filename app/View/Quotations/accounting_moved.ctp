<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>  

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header page-title">
            Approved Quotations
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th align="center">Date Created</th> 
                                <th align="center">Type</th> 
                                <th align="center">Subject</th>
                                <th align="center">Client</th>
                                <?php if($userRole != "purchasing_supervisor"):?>
                                <th align="center">Contract Amount</th> 
                                <th align="center">Job Request</th> 
                                <?php endif; ?>
                                <th align="center">Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($get_ac_approved as $ret_ac_approved) {
                            $unknown = 'Not Specified';
                            $quotation_obj = $ret_ac_approved['Quotation'];
                            $id = $quotation_obj['id'];
                            $jr_id = $quotation_obj['job_request_id'];
                            $date_created = $unknown;
                            if($quotation_obj['created']!=null || $quotation_obj!="") {
                                $date_created = time_elapsed_string($quotation_obj['created']);
                            }
                            $type = $unknown;
                            if($quotation_obj['type']!=null || $quotation_obj['type']!="") {
                                $type = ucwords($quotation_obj['type']);
                            }
                            $client_name = $unknown;
                            if(!empty($ret_ac_approved['Client'])) {
                                $client_obj = $ret_ac_approved['Client'];
                                $client_name_tmp = $client_obj['name'];
                            }
                            if($client_name_tmp != "") {
                                $client_name = $client_name_tmp;
                            }
                            $quote_number = $unknown;
                            if($quotation_obj['quote_number']!=null || $quotation_obj['quote_number']!="") {
                                $quote_number = $quotation_obj['quote_number'];
                            }
                            $contract_amount = '&#8369; ' . number_format($quotation_obj['grand_total'], 2);
                            $jr_number = $unknown;
                            $jr_obj = $ret_ac_approved['JobRequest'];
                            if($jr_obj['jr_number']!=null || $jr_obj['jr_number']!="") {
                                $jr_number = $jr_obj['jr_number'];
                            }
                            $job_request = $unknown;
                            if ($quotation_obj['job_request_id'] != 0) {
                                // ======> JOB REQUEST REVISION START
                                $date_up = new DateTime(date('Y-m-d', strtotime("2018-05-03")));
                                $jo_created = new DateTime(date('Y-m-d', strtotime($jr_obj['created'])));
                                $interval = $date_up->diff($jo_created);
                                $interval_day = $interval->format('%R%a');
                                if($interval_day>=0) {
                                    $job_request = '  
                                        <div class="input-group mar-btm">
                                            <input type="text" class="form-control" placeholder="Name" readonly value="' . $jr_number . '">
                                            <span class="input-group-btn">
                                             <a href="/job_requests/view_jr?id='.$jr_id.'" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="View Job Request?" ><i class="fa fa-external-link"></i> </a> 
                                            </span>
                                        </div>';
                                }
                                else {
                                    $job_request = '<div class="input-group mar-btm">
                                            <input type="text" class="form-control" placeholder="Name" readonly value="' . $jr_number . '">
                                            <span class="input-group-btn">
                                             <a class="jrupdateBtn btn btn-warning btn-icon  add-tooltip"
                                                      data-toggle="tooltip" 
                                                      data-original-title="Update Job Request!"  type="button"
                                                      href="/job_requests/joupdate?id='.$id.'">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                            </a></span>
                                        </div>';
                                }
                                // ======> JOB REQUEST REVISION END
                            } else {
                                $job_request = '<br/><button  class="btn btn-default  btn-icon  add-tooltip jobRequeBtn" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" data-quoteid="' . $id . '" data-jrid="'.$jr_id.'"><i class="fa fa-plus"></i></button>';
                            }
                            $action = '';
                            if (AuthComponent::user('role') == 'sales_executive') {
                                if($quotation_obj['status']=="pending" || $quotation_obj['status']=="edited"):
                                 $action = '
                                 <a href="/quotations/update_quotation?id='.$id.'" target="_blank"  class="btn btn-mint btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="Update Quotation?" ><i class="fa fa-edit"></i> </a> 
                                    <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Delete Quotation?" data-typo="deleted" data-delquoteid="'.$id.'" data-jrid="'.$jr_id.'"><i class="fa fa-window-close"></i> </button>
                                    <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Lost Quotation?" data-typo="lost" data-delquoteid="'.$id.'" data-jrid="'.$jr_id.'"><i class="fa fa-thumbs-down"></i> </button>';
                                endif;
                            }
                            
                            $action .= ' <a href="/quotations/view?id='.$id.'" target="_blank"  class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="View Quotation?" ><i class="fa fa-eye"></i> </a>';
                            if($userRole != "purchasing_supervisor")
                            $action .= '<button class="btn btn-primary btn-icon add-tooltip print_quote" data-toggle="tooltip"  data-original-title="Print Quotation?" data-printquoteid="'.$id.'"><i class="fa fa-print"></i> </button>';
                            
                            if($quotation_obj['discount']!=0) {
                                $action .= '<a href="/reports/quotation_discount?id='.$quotation_obj['id'].'" target="_blank" class="btn btn-warning btn-icon add-tooltip" data-toggle="tooltip"
                                         data-original-title="Print Quotation Discount?"><i class="fa fa-print"></i></a>';
                            }
                             ?>
                                <tr>
                                    <td data-order="<?php echo $quotation_obj['created']; ?>">
                                        <?php echo $date_created; ?>
                                        <br/><small><?php echo date('h:i a', strtotime($quotation_obj['created'])); ?></small>
                                    </td>
                                    <td><?php echo $type; ?></td>
                                    <td><?php echo $quotation_obj['subject']; ?></td>
                                    <td>
                                        <?php echo $client_name; ?>
                                        <br/><small><?php echo $quote_number; ?></small>
                                    </td>
                                    <?php if($userRole != "purchasing_supervisor"):?>
                                        <td><?php echo $contract_amount; ?></td>
                                        <td><?php echo $job_request; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo $action; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--JAVASCRIPT-->
<script type="text/javascript">
$(document).ready(function () {
    $('.jobRequeBtn').each(function (index) {
        $(this).click(function () {
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
                        data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id, 'jr_id':jr_id},
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


    // $('.update_quote').each(function (index) {
    //     $(this).click(function () {
    //         var qid = $(this).data("upquoteid"); 
    //         window.location.replace("/quotations/update_quotation?id=" + qid);
    //     });
    // });
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


    // $('.view_quote').each(function (index) {
    //     $(this).click(function () {
    //         var qid = $(this).data("viewquoteid");
    //         window.open("/quotations/view?id=" + qid, '_blank'); 
    //     });
    // });


    $('.print_quote').each(function (index) {
        $(this).click(function () {
            var qid = $(this).data("printquoteid");
            window.open("/pdfs/print_quote?id=" + qid, '_blank');
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
<!--END OF JAVASCRIPT-->