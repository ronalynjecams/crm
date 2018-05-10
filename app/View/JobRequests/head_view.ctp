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
        <h1 class="page-header text-overflow"><?php echo ucwords($status); ?> Job Request</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">  
                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Quotation Type</th> 
                            <th align="center">Client<br/>Job Request No.</th>
                            <th align="center">Sales Executive</th>   
                            <th align="center"> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_jrs as $pending_jr) {
                            $Quotation = $pending_jr['Quotation'];
                            $not_specified = "<font class='text-danger'>Not Specified</font>";
                            $unknown = "<font class='text-danger'>Unknown</font>";
                            $type = $unknown;
                            $Quotation_id = 0;
                            if(!empty($Quotation)) {
                                $type = $pending_jr['Quotation'][0]['type'];
                                $Quotation_id = $pending_jr['Quotation'][0]['id'];
                            }
                        ?>
                        <tr>
                            <td data-order="<?php echo $pending_jr['JobRequest']['created']; ?>">
                                <?php 
                                     echo time_elapsed_string($pending_jr['JobRequest']['created']);
                                     echo '<br/><small>' . date('h:i a', strtotime($pending_jr['JobRequest']['created'])) . '</small>';
                                    $clntname = '<font class="text-danger">Unknown</font>';
                                    if(!empty($pending_jr['Quotation'][0]['Client']['name'])) {
                                        $clntname_tmp = $pending_jr['Quotation'][0]['Client']['name'];
                                        if($clntname_tmp!="") {
                                            $clntname = $pending_jr['Quotation'][0]['Client']['name'];
                                        }
                                    }
                                ?>
                            </td> 
                            <td align="center"><?php echo $type; ?></td> 
                            <td align="center"><?php echo $clntname.'<br/>'.$pending_jr['JobRequest']['jr_number']; ?></td>
                            <?php
                                $fname = '';
                                $lname = '';
                                
                                if(!empty($pending_jr['Quotation'][0]['User'])) {
                                    $fname = $pending_jr['Quotation'][0]['User']['first_name'];
                                    $lname = $pending_jr['Quotation'][0]['User']['last_name'];
                                }
                                
                                if($fname == "" && $lname == "") {
                                    $fullname = "Unknown";
                                }
                                else {
                                    $fullname = $fname." ".$lname;
                                }
                            ?>
                            <td align="center"><?= $fullname; ?></td>   
                            <td align="center"> 
                            <?php
                            // echo '<button class="jrupdateBtn btn btn-mint  btn-icon  add-tooltip" data-toggle="tooltip"  data-original-title="Update Job Request"  type="button" data-jobrid="' . $Quotation_id . '"><i class="fa fa-edit"></i></button>';
                            ?>
                            <a href="/job_requests/joupdate?id=<?php echo $Quotation_id; ?>"
                               class="btn btn-mint  btn-icon  add-tooltip"
                               data-toggle="tooltip"
                               data-original-title="Update Job Request"
                               type="button">
                                <i class="fa fa-edit"></i>
                            </a>
                            </td> 
                        </tr>
                        <?php } ?>
                        <?php //foreach ($pending_jrs as $pending_jr) { ?> 
                            <!--<tr>-->
                            <!--    <td >-->
                                    <?php
                            // <!--        echo time_elapsed_string($pending_jr['JobRequest']['created']);-->
                            // <!--        echo '<br/><small>' . date('h:i a', strtotime($pending_jr['JobRequest']['created'])) . '</small>';-->
                                   ?>
                            <!--    </td>-->
                            <!--    <td>-->
                                   <?php
                                //   echo $pending_jr['Quotation']['type']
                                   ?>
                            <!--    </td> -->
                            <!--    <td ><?php //echo $pending_jr['Client']['name']; ?><br/><small>[ <?php echo $pending_jr['JobRequest']['jr_number']; ?> ]</small></td>-->
                            <!--    <td ><?php //echo $pending_jr['User']['first_name']; ?></td>  -->
                                <!--<td> -->
                                    <?php
                            // <!--        echo '<button class="jrupdateBtn btn btn-mint  btn-icon  add-tooltip" data-toggle="tooltip"  data-original-title="Update Job Request"  type="button" data-jobrid="' . $pending_jr['Quotation']['id'] . '"><i class="fa fa-edit"></i></button>';-->
                                    ?>
                            <!--    </td> -->
                            <!--</tr>-->
                        <?php //} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Quotation Type</th> 
                            <th align="center">Client<br/>Job Request No.</th>
                            <th align="center">Sales Executive</th>  
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
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "desc"]],
            "stateSave": true
        });

        // $('.jrupdateBtn').each(function (index) {
        //     $(this).click(function () {
        //         var quote_id = $(this).data("jobrid");
        //         window.location.replace("/job_requests/joupdate?id=" + quote_id);
        //     });
        // });

//        $('.jobRequeBtn').each(function (index) {
//            $(this).click(function () {
////            $("#jobRequestBtn").prop("disabled", true);
//                var date = new Date();
//                var month = date.getMonth();
//                var number = (Math.random() + ' ').substring(2, 5) + (Math.random() + ' ').substring(2, 5);
//
//                var quotation_id = $(this).data("quoteid");
//                var status = 'pending';
//                var jr_number = 'JECJR-' + month + number;
//
//                swal({
//                    title: "Are you sure?",
//                    text: "You will create job request for this quotation?",
//                    type: "warning",
//                    showCancelButton: true,
//                    confirmButtonClass: "btn-danger",
//                    confirmButtonText: "Yes",
//                    cancelButtonText: "No!",
//                    closeOnConfirm: false,
//                    closeOnCancel: false
//                },
//                        function (isConfirm) {
//                            if (isConfirm) {
//
//                                $.ajax({
//                                    url: "/job_requests/saveNewJobRequest",
//                                    type: 'POST',
//                                    data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id},
//                                    dataType: 'json',
//                                    success: function (dd) {
//                                        //redirect to edit of products 
//                                        window.location.replace("/job_requests/joupdate?id=" + quotation_id);
//                                        console.log(dd);
//                                    },
//                                    error: function (dd) {
//                                    }
//                                });
//                            } else {
//                                swal("Cancelled", "", "error");
//                            }
//                        });
//
//            });
//        });
//
//
//
//        $('.update_quote').each(function (index) {
//            $(this).click(function () {
//                var qid = $(this).data("upquoteid");
////            alert(qid);
//                window.location.replace("/quotations/update_quotation?id=" + qid);
//            });
//        });
//        $('.delete_quote').each(function (index) {
//            $(this).click(function () {
//                var id = $(this).data("delquoteid");
//                var type = $(this).data("typo");
//                var jrid =  $(this).data("jrid");
//                
//                if(jrid ==0){
//                swal({
//                    title: "Are you sure?",
//                    text: "You will not be able to recover this quotation!",
//                    type: "warning",
//                    showCancelButton: true,
//                    confirmButtonClass: "btn-danger",
//                    confirmButtonText: "Yes",
//                    cancelButtonText: "No!",
//                    closeOnConfirm: false,
//                    closeOnCancel: false
//                },
//                        function (isConfirm) {
//                            if (isConfirm) {
//                                $.ajax({
//                                    url: "/quotations/delete_lost_pending",
//                                    type: 'POST',
//                                    data: {'id': id, type: type},
//                                    dataType: 'json',
//                                    success: function (dd) {
//                                        location.reload();
//                                    },
//                                    error: function (dd) {
//                                        console.log(type);
//                                    }
//                                });
//                            } else {
//                                swal("Cancelled", "", "error");
//                            }
//                        });
//                    }else{
//                        swal("Quotation could not be deleted or lost");
//                    }
//            });
//        });
//
//
//        $('.view_quote').each(function (index) {
//            $(this).click(function () {
//                var qid = $(this).data("viewquoteid");
//                window.location.replace("/quotations/view_quotation?id=" + qid);
//            });
//        });
//
//
//        $('.print_quote').each(function (index) {
//            $(this).click(function () {
//                var qid = $(this).data("printquoteid");
//                window.location.replace("/pdfs/print_quote?id=" + qid);
//            });
//        });
//
//
//        $('.jrupdateBtn').each(function (index) {
//            $(this).click(function () {
//                var quote_id = $(this).data("jobrid");
//                window.location.replace("/job_requests/joupdate?id=" + quote_id);
//            });
//        });
//
    });
</script>
