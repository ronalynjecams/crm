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
        <h1 class="page-header text-overflow"><?php if($this->params['url']['status'] == 'approved_by_proprietor'){echo 'Approved by Proprietor';}else{echo ucwords($this->params['url']['status']);} ?> Quotations</h1>
    </div>
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped ">
                        <thead>
                            <tr>
                                <th align="center">Date
                                    <?php
                                if($this->params['url']['status'] == 'pending'){
                                    echo 'Created';
                                }else if($this->params['url']['status'] == 'moved' || $this->params['url']['status'] == 'approved_by_proprietor'){
                                    echo 'Moved';
                                }else if($this->params['url']['status'] == 'approved'){
                                    echo 'Approved';
                                }else if($this->params['url']['status'] == 'processed'){
                                    echo 'Processed';
                                }else if($this->params['url']['status'] == 'rejected'){
                                    echo 'Moved';
                                }
                                ?>
                                </th>
                                <th align="center">Type/Agent</th>
                                <th align="center">Subject</th>
                                <th align="center">Client</th>
                                <th align="center">
                                    <?php 
                                    if (AuthComponent::user('role') == 'supply_staff' || AuthComponent::user('role') == 'supply_head' || AuthComponent::user('role') == 'purchasing_supervisor'  || AuthComponent::user('role') == 'raw_head') {
                                        echo 'Remarks';
                                    }else{
                                        echo 'Contract Amount [Collection Status]';
                                    }
                                    ?>
                                </th>
                                <th align="center">Job Request</th>
                                <th align="center"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        // pr($quotations);
                        foreach ($quotations as $pending_quotation) {
                            ?>
                                <tr>
                                    <td
                                    <?php 
                                    if($this->params['url']['status'] == 'pending'){
                                        echo "data-order='".$pending_quotation['Quotation']['created']."'";
                                    }else if($this->params['url']['status'] == 'moved'  || $this->params['url']['status'] == 'approved_by_proprietor'){
                                        echo "data-order='".$pending_quotation['Quotation']['date_moved']."'";
                                    }else if($this->params['url']['status'] == 'approved'){
                                        echo "data-order='".$pending_quotation['Quotation']['date_approved']."'";
                                    }else if($this->params['url']['status'] == 'processed'){
                                        echo "data-order='".$pending_quotation['Quotation']['date_processed']."'";
                                    }
                                    ?>
                                    >
                                    <?php 
                                    if($this->params['url']['status'] == 'pending'){
                                        echo time_elapsed_string($pending_quotation['Quotation']['created']);
                                        echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['created'])) . '</small>';
                                    }else if($this->params['url']['status'] == 'moved'  || $this->params['url']['status'] == 'approved_by_proprietor'){
                                        echo time_elapsed_string($pending_quotation['Quotation']['date_moved']);
                                        echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_moved'])) . '</small>';
                                    }else if($this->params['url']['status'] == 'approved'){
                                        echo time_elapsed_string($pending_quotation['Quotation']['date_approved']);
                                        echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_approved'])) . '</small>';
                                    }else if($this->params['url']['status'] == 'processed'){
                                        if($pending_quotation['Quotation']['date_processed']!=null){
                                            echo time_elapsed_string($pending_quotation['Quotation']['date_processed']);
                                            echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_processed'])) . '</small>';
                                        }
                                        else { echo "<font class='text-danger'>No processed date</font>"; }
                                    } else if($this->params['url']['status'] == 'rejected'){
                                        echo time_elapsed_string($pending_quotation['Quotation']['created']);
                                        echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['created'])) . '</small>';
                                    } 
                                    ?>
                                    </td>
                                    <td>
                                        <?php 
                                    echo $pending_quotation['Quotation']['type'].' / '.$pending_quotation['User']['first_name'] ;
                                    ?>
                                    </td>
                                    <td><?php echo $pending_quotation['Quotation']['subject']; ?></td>
                                    <td>
                                        <?php
                                    echo $pending_quotation['Client']['name'];
                                    echo ' <small>[' . $pending_quotation['Quotation']['quote_number'] . ']</small>';
                                    ?>
                                    </td>
                                    <td>
                                        <?php
                                        
                                    if (AuthComponent::user('role') == 'supply_staff' || AuthComponent::user('role') == 'supply_head' || AuthComponent::user('role') == 'purchasing_supervisor'  || AuthComponent::user('role') == 'raw_head') {
                                    echo $pending_quotation['Quotation']['purchasing_remarks'];
                                        
                                    }else{
                                    echo '&#8369; ' . number_format($pending_quotation['Quotation']['grand_total'], 2);
                                    $total_collection = 0;
                                    $unverified_total_collection = 0;
                                    foreach ($pending_quotation['Collection'] as $collection) {
                                        
                                        if ($collection['status'] == 'verified') {
                                            $payment = $collection['amount_paid'] + $collection['with_held'] + $collection['other_amount'];
                                            $total_collection = $total_collection + $payment;
                                        }
                                        if ($collection['status'] != 'verified') {
                                            $unverified_payment = $collection['amount_paid'] + $collection['with_held'] + $collection['other_amount'];
                                            $unverified_total_collection = $unverified_total_collection + $unverified_payment;
                                        }
                                        
                                    }
                                        // echo $total_collection;
                                        // if ($total_collection != 0) {
                                        //     echo '<span class="text-success"> <small> [ <b> Fully Paid </b> ] </small></span>';
                                        // }

                                        $balance = $pending_quotation['Quotation']['grand_total'] - $total_collection;
                                        if($balance>=1){
                                            if($balance == $pending_quotation['Quotation']['grand_total']){
                                                if($unverified_total_collection!=0){
                                                    echo '<span class="text-warning"> <small> [ <b> Unverified: </b> &#8369; ' . number_format($unverified_total_collection, 2).' ] </small></span>';
                                                }else{
                                                    echo '<span class="text-danger"> <small> [ <b> No Payment </b>  ] </small></span>';
                                                }
                                            }else{
                                                echo '<span class="text-danger"><small> [ <b>Balance: </b>  &#8369; ' . number_format($balance, 2).'] </small></span>';
                                            }
                                        }else{
                                             echo '<span class="text-success"> <small> [ <b> Fully Paid </b> ] </small></span>';
                                        }
                                    // echo '&#8369; ' . number_format($pending_quotation['Quotation']['grand_total'], 2);
                                    }
                                    ?>
                                    </td>
                                    <td>
                                        <?php
                                    if ($pending_quotation['Quotation']['job_request_id'] != 0) {
                                    //  echo '<i class="fa fa-check text-success"></i>';
                                    echo  $pending_quotation['JobRequest']['jr_number'];
                                    } else {
//                                     echo '<i class="fa fa-times"></i>';
                                     
                                    }
                                    ?>
                                    </td>
                                    <td>
                                        <?php
                                        
                                         if (AuthComponent::user('role') == 'raw_head' || AuthComponent::user('role') == 'purchasing_supervisor') { 
                                             echo '<a href="/reports/print_quote_purchasing?id='.$pending_quotation['Quotation']['id'].'" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="Print Quotation?" ><i class="fa fa-print"></i> </a>';
                                 
                                         }
                                         
                                         
                                    if (AuthComponent::user('role') == 'accounting_head' || AuthComponent::user('role') == 'collection_officer') { 
                                        if($pending_quotation['Quotation']['discount']!=0){  
                                            ?>
                                            <a href="/reports/quotation_discount?id=<?php echo  $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="Print Quotation Discount?" ><i class="fa fa-print"></i> </a>
                                 
                                            <?php
                                         }
                                        ?> 
                                                <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id'];  ?>" target="_blank" class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip" data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </a>
                                      
                                        <?php
                                        if ($this->params['url']['status'] == 'approved_by_proprietor') { ?>
                                            <button class="btn btn-danger btn-icon add-tooltip approve_quote" data-toggle="tooltip" data-original-title="Approve Quotation?" data-apquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-usr="accounting">Approve</button>
                                      <?php
                                        }
                                    }
                                    
                                    if (AuthComponent::user('role') == 'proprietor') { 
                                        //if ($this->params['url']['status'] == 'moved') { ?>
                                                <button class="btn btn-danger btn-icon add-tooltip reject_quote" data-toggle="tooltip" data-original-title="Reject Quotation?" data-requoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-rusr="proprietor"><i class="fa fa-remove"></i></button>
                                                 <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id'];  ?>" target="_blank" class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip" data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </a>
                                       <?php
                                       // } 
                                        
                                        if ($this->params['url']['status'] == 'moved' || $this->params['url']['status'] == 'rejected') { ?>
                                                    <button class="btn btn-success btn-icon add-tooltip approve_quote" data-toggle="tooltip" data-original-title="Approve Quotation?" data-apquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-usr="proprietor"><i class="fa fa-check"></i></button>
                                                     <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id'];  ?>" target="_blank" class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip" data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </a>
                                       <?php
                                        } 
                                        
                                    }
                                    if (AuthComponent::user('role') == 'collection_officer') { 
                                                 echo '  <a class="btn btn-success btn-icon add-tooltip addCollection" data-toggle="tooltip" href="#" data-original-title="Update Collection" data-idaddcollection="' . $pending_quotation['Quotation']['id'] . '" ><i class="fa fa-money"></i></a>';
                                   ?>
                                          <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id'];  ?>" target="_blank" class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip" data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </a>
                                       <button class="btn btn-primary btn-icon add-tooltip print_quote_discount" data-toggle="tooltip" data-original-title="Print Quotation Discount?" data-printquotediscountid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-money"></i> </button>
                                
                                   <?php 
                                    }
                                     
                                    ?>
                                     <?php 
                                     if (AuthComponent::user('role') == 'supply_staff' || AuthComponent::user('role') == 'supply_head' || AuthComponent::user('role') == 'purchasing_supervisor'  || AuthComponent::user('role') == 'raw_head') {
                                      if ($pending_quotation['Quotation']['status'] == 'approved' || $pending_quotation['Quotation']['status'] == 'processed') {
                                     ?>  
                                     <a href="/purchase_orders/quotation_view_supply?id=<?php echo $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-info btn-icon add-tooltip" data-toggle="tooltip" data-original-title="View Quotation?" ><i class="fa fa-eye"></i> </a> 
                                  
                                        <button class="btn btn-danger btn-icon add-tooltip processed_quote" data-toggle="tooltip"  data-original-title="Processed Quotation?" data-apquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-usr="supply_staff" >Processed?</button>
                                        <?php 
                                      }else{
                                          ?>
                                           <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id'];  ?>" target="_blank" class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip" data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </a>
                                          <?php
                                      }
                                      echo '<a class="btn btn-default btn-icon add-tooltip updatePurchasingStatus " data-toggle="tooltip" href="#" data-original-title="Update Remarks" data-id="' . $pending_quotation['Quotation']['id'] . '" data-rem="' . $pending_quotation['Quotation']['purchasing_remarks'] . '"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                         } ?>
                                         
                                    <?php if (AuthComponent::user('role') == 'sales_manager'){ 
									if ($this->params['url']['status'] == 'moved' || $this->params['url']['status'] == 'rejected') { ?>
                                        <a href="/quotations/update_quotation?id=<?php echo  $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-warning btn-icon add-tooltip" data-toggle="tooltip" data-original-title="Edit Quotation?" ><i class="fa fa-edit"></i> </a>
									<?php } ?>                                       
									   <a href="/quotations/view?id=<?php echo $pending_quotation['Quotation']['id'];  ?>" target="_blank" class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip" data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </a>
                                        <a href="/pdfs/print_quote?id=<?php echo  $pending_quotation['Quotation']['id']; ?>" target="_blank"  class="btn btn-primary btn-icon add-tooltip" data-toggle="tooltip" data-original-title="Print Quotation?" ><i class="fa fa-print"></i> </a>
                                    <?php } ?>
                                    
                                    
                                    </td>
                                </tr>
                                <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th align="center">Date
                                    <?php
                                if($this->params['url']['status'] == 'pending'){
                                    echo 'Created';
                                }else if($this->params['url']['status'] == 'moved'){
                                    echo 'Moved';
                                }else if($this->params['url']['status'] == 'approved'){
                                    echo 'Approved';
                                }else if($this->params['url']['status'] == 'processed'){
                                    echo 'Processed';
                                }else if($this->params['url']['status'] == 'rejected'){
                                    echo 'Rejected';
                                }
                                ?>
                                </th>
                                <th align="center">Type</th>
                                <th align="center">Subject</th>
                                <th align="center">Client</th>
                                <th align="center">
                                    <?php 
                                    if (AuthComponent::user('role') == 'supply_staff' || AuthComponent::user('role') == 'supply_head' || AuthComponent::user('role') == 'purchasing_supervisor'  || AuthComponent::user('role') == 'raw_head') {
                                        echo 'Remarks';
                                    }else{
                                        echo 'Contract Amount [Collection Status]';
                                    }
                                    ?>
                                </th>
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
$('.print_quote_discount').each(function(index) {
    $(this).click(function() {
        var qid = $(this).data("printquotediscountid");
        window.open("/pdfs/print_quote_discount?id=" + qid, '_blank');
        //                window.location.replace("/pdfs/print_quote?id=" + qid);
    });
});

$(".addCollection").each(function(index) {
    $(this).on("click", function() {
        var id = $(this).data('idaddcollection');
        //            $('#collector_schedule_id').val(id);
        //            $('#add-collector').modal('show');
        window.location.replace("/collections/collect?id=" + id);


    });
});
$(document).ready(function() {
    $('.jobRequeBtn').each(function(index) {
        $(this).click(function() {
            //            $("#jobRequestBtn").prop("disabled", true);
            var date = new Date();
            var month = date.getMonth();
            var number = (Math.random() + ' ').substring(2, 5) + (Math.random() + ' ').substring(2, 5);

            var quotation_id = $(this).data("quoteid");
            var status = 'pending';
            var jr_number = 'JECJR-' + month + number;

            swal({
                    title: "Are you sure?",
                    text: "You will create job request for this quotation?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $(".confirm").attr('disabled', 'disabled');
                        $.ajax({
                            url: "/job_requests/saveNewJobRequest",
                            type: 'POST',
                            data: { 'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id },
                            dataType: 'json',
                            success: function(dd) {
                                //redirect to edit of products 
                                // window.location.replace("/job_requests/joupdate?id=" + quotation_id);
                                location.reload();
                                console.log(dd);
                            },
                            error: function(dd) {}
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });

        });
    });

    $('#example').DataTable({
        "lengthMenu": [
            [50, 100, 200, -1],
            [50, 100, 200, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "stateSave": true
    });


    $('.update_quote').each(function(index) {
        $(this).click(function() {
            var qid = $(this).data("upquoteid");
            window.location.replace("/quotations/update_quotation?id=" + qid);
        });
    });
    $('.delete_quote').each(function(index) {
        $(this).click(function() {
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
                    function(isConfirm) {
                        if (isConfirm) {
                            $(".confirm").attr('disabled', 'disabled');
                            $.ajax({
                                url: "/quotations/delete_lost_pending",
                                type: 'POST',
                                data: { 'id': id, type: type },
                                dataType: 'json',
                                success: function(dd) {
                                    location.reload();
                                },
                                error: function(dd) {
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


    // $('.view_quote').each(function(index) {
    //     $(this).click(function() {
    //         var qid = $(this).data("viewquoteid");
    //         window.open("/quotations/view?id=" + qid, '_blank');
    //     });
    // });


    $('.print_quote').each(function(index) {
        $(this).click(function() {
            var qid = $(this).data("printquoteid");
            window.open("/pdfs/print_quote?id=" + qid, '_blank');
            //                window.location.replace("/pdfs/print_quote?id=" + qid);
        });
    });


    $('.jrupdateBtn').each(function(index) {
        $(this).click(function() {
            var quote_id = $(this).data("jobrid");
            window.open("/job_requests/joupdate?id=" + quote_id, '_blank');
        });
    });





    $('.approve_quote').each(function(index) {
        $(this).click(function() {
            var id = $(this).data("apquoteid");
            var usr = $(this).data("usr");

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
                function(isConfirm) {
                    if (isConfirm) {

                        $(".confirm").attr('disabled', 'disabled');
                        $.ajax({
                            url: "/quotations/proprietor_approve",
                            type: 'POST',
                            data: { 'id': id, 'usr': usr },
                            dataType: 'json',
                            success: function(dd) {
                                location.reload();
                            },
                            error: function(dd) {
                                console.log(type);
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        });
    });

    $('.reject_quote').each(function(index) {
        $(this).click(function() {
            var id = $(this).data("requoteid");
            var usr = $(this).data("rusr");

            swal({
                    title: "Reject Quotation?",
                    text: "You will not be able to revert action in this quotation!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $(".confirm").attr('disabled', 'disabled');
                        $.ajax({
                            url: "/quotations/proprietor_reject",
                            type: 'POST',
                            data: { 'id': id, 'usr': usr },
                            dataType: 'json',
                            success: function(dd) {
                                location.reload();
                            },
                            error: function(dd) {
                                console.log(type);
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        });
    });



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