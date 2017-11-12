


<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>  

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php if($this->params['url']['status'] == 'accounting_moved'){echo 'Approved by Accounting';}else{echo ucwords($this->params['url']['status']);} ?> Quotations</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel"> 
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date 
                                <?php
                                if($this->params['url']['status'] == 'pending'){
                                    echo 'Created';
                                }else if($this->params['url']['status'] == 'moved' || $this->params['url']['status'] == 'accounting_moved'){
                                    echo 'Moved';
                                }else if($this->params['url']['status'] == 'approved'){
                                    echo 'Approved';
                                }else if($this->params['url']['status'] == 'processed'){
                                    echo 'Processed';
                                }
                                ?>
                                </th> 
                            <th align="center">Type</th> 
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th> 
                            <th align="center"> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // pr($pending_quotations);
                        foreach ($quotations as $pending_quotation) {
                            ?>
                            <tr>
                                <td>
                                    <?php 
                                if($this->params['url']['status'] == 'pending'){
                                    echo date('F d, Y', strtotime($pending_quotation['Quotation']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['created'])) . '</small>';
                                 }else if($this->params['url']['status'] == 'moved'  || $this->params['url']['status'] == 'accounting_moved'){
                                    echo date('F d, Y', strtotime($pending_quotation['Quotation']['date_moved']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_moved'])) . '</small>';
                                 }else if($this->params['url']['status'] == 'approved'){
                                    echo date('F d, Y', strtotime($pending_quotation['Quotation']['date_approved']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_approved'])) . '</small>';
                                 }else if($this->params['url']['status'] == 'processed'){
                                 
                                    echo date('F d, Y', strtotime($pending_quotation['Quotation']['date_processed']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['date_processed'])) . '</small>';
                                 } 
                                    ?> 
                                </td>
                                <td>
                                    <?php 
                                    echo $pending_quotation['Quotation']['type'] ;
                                    ?> 
                                </td> 
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
                                     echo '<i class="fa fa-check text-success"></i>';
                                    } else {
//                                     echo '<i class="fa fa-times"></i>';
                                     
                                    }
                                    ?>
                                </td> 
                                <td>
                                    <button class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </button>
                               
                                    <?php
                                    if (AuthComponent::user('role') == 'proprietor') { 
                                        
                                        if ($this->params['url']['status'] == 'accounting_moved') { ?>
                                            <button class="btn btn-danger btn-icon add-tooltip approve_quote" data-toggle="tooltip"  data-original-title="Approve Quotation?" data-apquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>" data-usr="proprietor" >Approve</button>
                                           <?php
                                        }
                                    }
                                    
                                    if (AuthComponent::user('role') == 'accounting_head') { 
                                        
                                        if ($this->params['url']['status'] == 'moved') { ?>
                                            <button class="btn btn-danger btn-icon add-tooltip approve_quote" data-toggle="tooltip"  data-original-title="Approve Quotation?" data-apquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"  data-usr="accounting">Approve</button>
                                           <?php
                                        }
                                    }
                                     
                                    ?>
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
                                }
                                ?></th> 
                            <th align="center">Type</th> 
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
                        function (isConfirm) {
                            if (isConfirm) {

                                $.ajax({
                                    url: "/job_requests/saveNewJobRequest",
                                    type: 'POST',
                                    data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id},
                                    dataType: 'json',
                                    success: function (dd) {
                                        //redirect to edit of products 
                                        window.location.replace("/job_requests/joupdate?id=" + quotation_id);
                                        console.log(dd);
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


        $('.jrupdateBtn').each(function (index) {
            $(this).click(function () {
                var quote_id = $(this).data("jobrid");
                window.open("/job_requests/joupdate?id=" + quote_id, '_blank'); 
            });
        });





        $('.approve_quote').each(function (index) {
            $(this).click(function () {
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
                        function (isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    url: "/quotations/proprietor_approve",
                                    type: 'POST',
                                    data: {'id': id, 'usr': usr},
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