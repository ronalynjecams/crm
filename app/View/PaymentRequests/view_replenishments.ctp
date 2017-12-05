<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
        <?php
            echo "₱ ".number_format((float)$payment_replenishment['PaymentReplenishment']['amount'], 2, '.',',').
                 " for ".date("F d, Y [h:i A]", strtotime($payment_replenishment['PaymentReplenishment']['created']));
        ?>
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped"
                           cell-spacing="0" width="100%"
                           id="example">
                        <thead>
                            <tr>
                                <th>Date of Request</th>
                                <th>Amount Requested</th>
                                <th>Amount Released</th>
                                <th>Purpose</th>
                                <?php
                                    if($payment_replenishment['PaymentReplenishment']['acknowledged_date']==null &&
                                       $payment_replenishment['PaymentReplenishment']['user_id']) {
                                        echo '<th>Action</th>';
                                   }
                               ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($payment_replenished_detail as $detail) {
                                $det = $detail['PaymentReplenishedDetail'];
                                $payment_request = $detail['PaymentRequest'];
                                ?>
                                <tr>
                                    <td><?php echo date("F d, Y [h:i A]", strtotime($det['created'])); ?></td>
                                    <td><?php echo "₱ ".number_format((float)$payment_request['requested_amount'], 2, '.',','); ?></td>
                                    <td><?php echo "₱ ".number_format((float)$payment_request['released_amount'], 2, '.',','); ?></td>
                                    <td><?php echo $payment_request['purpose']; ?></td>
                                    <?php
                                    if($payment_replenishment['PaymentReplenishment']['acknowledged_date']==null &&
                                       $payment_replenishment['PaymentReplenishment']['user_id']) {
                                        ?>
                                        <td>
                                            <button class="btn btn-danger"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Delete"
                                                    value="<?php echo $det['id']; ?>"
                                                    id="btn_delete">
                                                <span class="fa fa-close"></span>
                                            </button>
                                        </td>
                                        <?php
                                    }
                                    ?>
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
    
    $("#btn_delete").on('click', function() {
        var id = $(this).val();
        swal({
            title: "Are you sure?",
            text: "This will permanently delete replenishment detail.",
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
				$.get('/payment_requests/delete_replenishment', {id: id}, function(data) {
					console.log(data);
					location.reload();
				})
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
});
</script>
<!--END OF JAVASCRIPT METHODS-->