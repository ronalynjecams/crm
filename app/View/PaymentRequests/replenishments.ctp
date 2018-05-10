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
        <h1 class="page-header text-overflow">
            Petty Cash Replenishments
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <a href="/payment_requests/all_list?type=pettycash&&status=verified">
                    <h3 class="panel-title" align="right">
                        <button class="btn btn-danger"
                                id="btn_replenish"
                                data-action="replenished">
                            <span class="fa fa-check-square"></span>
                            Replenish
                        </button>
                    </h3>
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"
                           cell-spacing="0" width="100%"
                           id="example">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Requested By</th>
                                <th>Amount Replenished</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($payment_replenishments as $payment_replenishment) {
                                $user = $payment_replenishment['User'];
                                $replenishment = $payment_replenishment['PaymentReplenishment'];
                                ?>
                                <tr>
                                    <td><?php echo time_elapsed_string($replenishment['created']); ?></td>
                                    <td><?php echo ucwords($user['first_name']." ".$user['last_name']); ?></td>
                                    <td align="right"><?php echo "&#8369; ".number_format((float)$replenishment['amount'], 2, ".", ","); ?></td>
                                    <td>
                                        <a href="/payment_requests/view_replenishments?id=<?php echo $replenishment['id']; ?>">
                                            <button class="btn btn-info"
                                                    id="btn_view"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="View">
                                                    <span class="fa fa-eye"></span>
                                            </button>
                                        </a>
                                        <?php
                                        if($UserIn['User']['role']=="proprietor" && $status=="pending") {
                                            ?>
                                            <button class="btn btn-warning"
                                                    id="btn_acknowledge"
                                                    value="<?php echo $replenishment['id']; ?>">
                                                <span class="fa fa-certificate"></span>
                                                Acknowledge
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--JAVASCRIPT METHODS-->
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#example').DataTable({
        "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        "orderable": true,
        "order": [[0,"asc"]],
        "stateSave": false
    });
    
    $("#btn_acknowledge").on('click', function() {
        var id = $(this).val();
        swal({
            title: "Are you sure?",
            text: "This will acknowledge replenishment.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '/payment_requests/acknowledge_replenishment',
                    type: "POST",
                    data: {"data": id},
                    dataType: "text",
                    success: function(success) {
                        console.log(success);
                        swal({
                            title: "Success!",
                            text: "Successfully acknowledged replenishment.",
                            type: "success"
                        },
                        function(isConfirm2) {
                            location.reload();
                        });
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
});
</script>
<!--END OF JAVASCRIPT METHODS-->