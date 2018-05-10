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
        <h1 class="page-header text-overflow">Approved By Accounting Quotations</h1>
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
                            <th align="center">Date Moved</th>  
                            <th align="center">Type</th> 
                            <th align="center">Subject</th>
                            <th align="center">Client</th>
                            <?php
                            if ($userRole != 'supply_staff' && $userRole != 'supply_head' && $userRole  != 'purchasing_supervisor') {
                                ?>

                                <th align="center">Contract aAmount</th>
                            <?php }
                            if($userRole  == 'purchasing_supervisor'){
                            ?>
                                <th align="center">Remarks</th>
                            <?php } ?>
                            <th align="center">
                                <?php
                                if ($userRole == 'sales_executive') {
                                    echo 'Job Request';
                                } else {
                                    echo 'Sales Executive';
                                }
                                ?>

                            </th> 
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
                                    echo time_elapsed_string($pending_quotation['Quotation']['date_moved']);
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_moved'])) . '</small>';
                                    ?> 
                                </td>
                                <td>
                                    <?php
                                    echo $pending_quotation['Quotation']['type'];
                                    echo '<br/><small>[' . $pending_quotation['Quotation']['quote_number'] . ']</small>';
                                    ?> 
                                </td> 
                                <td><?php echo $pending_quotation['Quotation']['subject']; ?></td>
                                <td>
                                    <?php
                                    if ($userRole == 'sales_executive') {
                                        echo $pending_quotation['Client']['name'];
                                        echo '<br/><small>[' . $pending_quotation['Client']['tin_number'] . ']</small>';
                                    } else if ($userRole == 'supply_staff' || $userRole == 'supply_head' || $userRole == 'purchasing_supervisor') {
                                        echo $pending_quotation['Quotation']['Client']['name'];
                                        echo '<br/><small>[' . $pending_quotation['Quotation']['Client']['tin_number'] . ']</small>';
                                    }
                                    ?> 
                                </td> 

                                <?php
                                if ($userRole != 'supply_staff' && $userRole != 'supply_head' && $userRole  != 'purchasing_supervisor') {
                                    ?>

                                    <td align="center">
                                        <?php
                                        echo '&#8369; ' . number_format($pending_quotation['Quotation']['grand_total'], 2);
                                        ?>
                                    </td> 
                                <?php } 
                                if($userRole  == 'purchasing_supervisor'){
                                ?>
                                    <td align="center">
                                        <?php
                                        echo $pending_quotation['Quotation']['purchasing_remarks'];
                                        ?>
                                    </td> 
                                <?php } ?>
                                <td>

                                    <?php if ($userRole == 'sales_executive') { ?>
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
                                        <?php
                                    } else {
                                        echo $pending_quotation['Quotation']['User']['first_name'] . '  ' . $pending_quotation['Quotation']['User']['last_name'];
                                    }
                                    ?>
                                </td> 
                                <td>
                                    <?php if ($userRole == 'sales_executive' ) { ?>
                                     <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-info btn-icon add-tooltip" data-toggle="tooltip" data-original-title="View Quotation?" ><i class="fa fa-eye"></i> </a> 
                                     <a href="/pdfs/print_quote?id=<?php echo $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="Print Quotation?" ><i class="fa fa-print"></i> </a> 
                                     <?php 
                                      if($pending_quotation['Quotation']['discount']!=0){
                                          echo '<a href="/reports/quotation_discount?id='.$pending_quotation['Quotation']['id'].'" target="_blank"  class="btn btn-warning btn-icon add-tooltip" data-toggle="tooltip" data-original-title="Print Quotation Discount?" ><i class="fa fa-print"></i> </a>';
                                      } 
                                    } 
                                     if ($userRole == 'supply_staff' || $userRole == 'supply_head' || $userRole == 'purchasing_supervisor'  || $userRole == 'raw_head') {
                                      if ($pending_quotation['Quotation']['status'] == 'approved') {
                                     ?>  
                                     <a href="/purchase_orders/quotation_view_supply?id=<?php echo $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-info btn-icon add-tooltip" data-toggle="tooltip" data-original-title="View Quotation?" ><i class="fa fa-eye"></i> </a> 
                                  
                                        <button class="btn btn-danger btn-icon add-tooltip processed_quote" data-toggle="tooltip"  data-original-title="Processed Quotation?" data-apquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-usr="supply_staff" >Processed?</button>
                                        <?php 
                                      }   
                                      echo '<a class="btn btn-default btn-icon add-tooltip updatePurchasingStatus " data-toggle="tooltip" href="#" data-original-title="Update Remarks" data-id="' . $pending_quotation['Quotation']['id'] . '" data-rem="' . $pending_quotation['Quotation']['purchasing_remarks'] . '"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                         } ?>
                                </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Date Moved</th> 
                            <th align="center">Type</th> 
                            <th align="center">Subject</th>
                            <th align="center">Client</th>
                            <?php
                            if ($userRole != 'supply_staff' && $userRole != 'supply_head' && $userRole  != 'purchasing_supervisor') {
                                ?>

                                <th align="center">Contract aAmount</th>
                            <?php }
                            if($userRole  == 'purchasing_supervisor'){
                            ?>
                                <th align="center">Remarks</th>
                            <?php } ?>
                            <th align="center"> 
                                <?php
                                if ($userRole == 'sales_executive') {
                                    echo 'Job Request';
                                } else {
                                    echo 'Sales Executive';
                                }
                                ?>
                            </th> 
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
<!--===================================================--> 
<div class="modal fade" id="update-purchasing-status" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <input type="hidden" id="quotation_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Purchasing Status</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body"> 
                 <div class="form-group" >
                    <label>Remarks <span class="text-danger">*</span></label> 
                    <input type="text" id="purchasing_remarks" class="form-control">
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updatePurchasingStatusBtn">Update</button>
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
                var status = 'new';
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
                var jrid = $(this).data("jrid");

                if (jrid == 0) {
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
                } else {
                    swal("Quotation could not be deleted or lost");
                }
            });
        });


        // $('.view_quote').each(function (index) {
        //     $(this).click(function () {
        //         var qid = $(this).data("viewquoteid");
        //         var userrole = $(this).data("userrole");
        //         if((userrole == 'supply_staff')||(userrole == 'supply_head')){
        //             // window.open("/quotations/view_supply?id=" + qid, '_blank');
        //             window.open("/purchase_orders/quotation_view_supply?id=" + qid, '_blank'); 

        //         }else{
        //             window.open("/quotations/view?id=" + qid, '_blank');
        //         }
        //     });
        // });


//         $('.print_quote').each(function (index) {
//             $(this).click(function () {
//                 var qid = $(this).data("printquoteid");
//                 window.open("/pdfs/print_quote?id=" + qid, '_blank');
// //                window.location.replace("/pdfs/print_quote?id=" + qid);
//             });
//         });


        // $('.jrupdateBtn').each(function (index) {
        //     $(this).click(function () {
        //         var quote_id = $(this).data("jobrid");
        //         window.open("/job_requests/joupdate?id=" + quote_id, '_blank');
        //     });
        // });

    });
    
    

        $('.processed_quote').each(function (index) {
            $(this).click(function () {
                var id = $(this).data("apquoteid"); 
                 
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to revert action in this quotation!",
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
                                
                                 $(".confirm").attr('disabled', 'disabled'); 
                                $.ajax({
                                    url: "/quotations/make_processed",
                                    type: 'POST',
                                    data: {'id': id},
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
            });
        });
    $(".updatePurchasingStatus").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('id');
            $('#quotation_id').val(id);
            var rem = $(this).data('rem');
            $('#purchasing_remarks').val(rem);
            $('#update-purchasing-status').modal('show');

        });
    });
     $('#updatePurchasingStatusBtn').on("click", function () {
        var quotation_id = $('#quotation_id').val(); 
        var purchasing_remarks = $('#purchasing_remarks').val();
 
            if ((purchasing_remarks != "")) { 
    
                $("#updatePurchasingStatusBtn").prop("disabled", true);
                var data = {"quotation_id": quotation_id,
                    "purchasing_remarks": purchasing_remarks,  
                } 
                $.ajax({
                    url: "/quotations/updatePurchasingStatus",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (id) {
                        location.reload();
                        // console.log(id);
                    }
                });
            } else {
                document.getElementById('purchasing_remarks').style.borderColor = "red";
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