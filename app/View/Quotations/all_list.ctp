

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
        <h1 class="page-header text-overflow"><?php echo ucwords($quote_status); ?> Quotations</h1>
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
                        <a class="btn btn-mint" style="color:white;" href="/quotations/create" >
                            <i class="fa fa-plus"></i>  Add New Quotations
                        </a>
                    <?php } ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="all_list_quotation_tbl" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Type</th> 
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th> 
                            <th align="center">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Type</th> 
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th>  
                            <th>Action</th>  
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
        //for datatable of quotations
        
    	$('[data-toggle="tooltip"]').tooltip();
        $('#all_list_quotation_tbl').dataTable({
        	"stateSave": true, 
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'Quotations', 'action' => 'all_list_ajax', $quote_status)); ?>"
        });
        
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