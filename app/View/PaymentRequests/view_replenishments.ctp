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
        <?php
            echo "Replenished &#8369; ".number_format((float)$payment_replenishment['PaymentReplenishment']['amount'], 2, '.',',').
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
                                <th>Invoices</th>
                                <th>Total Invoices</th>
                                <th>Returned Amount</th>
                                <th>Reimbursed Amount</th>
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
                                $PaymentInvoice = $payment_request['PaymentInvoice'];
                                $total_expense_tmp = 0;
                                $payment_invoice_display = "";
                                $requested_amount_total = 0;
                                $released_amount_total = 0;
                                $total_expense_total = 0;
                                $returned_amount_total = 0;
                                $reimbursed_amount_total = 0;
                                
                                if(!empty($PaymentInvoice)) {
                                    foreach($PaymentInvoice as $returnPaymentInvoice) {
                                        $reference_type = $returnPaymentInvoice['reference_type'];
                                        $reference_number = $returnPaymentInvoice['reference_number'];
                                        $payment_invoice_amount = "&#8369;".number_format((float)$returnPaymentInvoice['amount'],2,".",",");
                                        if(is_null($returnPaymentInvoice['date_deleted'])) {
                                            $total_expense_tmp += $returnPaymentInvoice['amount']+
                                                                  $returnPaymentInvoice['with_held_amount']+
                                                                  $returnPaymentInvoice['ewt_amount']+
                                                                  $returnPaymentInvoice['tax_amount'];
                                            $total_expense_tmp1 = $returnPaymentInvoice['amount']+
                                                                  $returnPaymentInvoice['with_held_amount']+
                                                                  $returnPaymentInvoice['ewt_amount']+
                                                                  $returnPaymentInvoice['tax_amount'];
                                        }
                                        // $payment_invoice_display .= "<p>$reference_type-$reference_number($payment_invoice_amount)</p><br/>";
                                        $payment_invoice_display .= "<p>".$reference_type."-".$reference_number."(&#8369;".number_format((float)$total_expense_tmp1,2,".",",").")</p><br/>";
                                    }
                                }
                                else {
                                    $payment_invoice_display = "<font class='text-danger'>No Payment Invoice</font>";
                                }
                                
                                $returned_amount = "&#8369; ".number_format((float)$payment_request['returned_amount'], 2, ".", ",");
                                $reimbursed_amount = "&#8369; ".number_format((float)$payment_request['reimbursed_amount'], 2, ".", ",");
                                $total_expense = "&#8369; ".number_format((float)$total_expense_tmp,2,".",",");
                                
                                $requested_amount_total += $payment_request['requested_amount'];
                                $released_amount_total += $payment_request['released_amount'];
                                $total_expense_total += $total_expense_tmp;
                                $returned_amount_total += $payment_request['returned_amount'];
                                $reimbursed_amount_total += $payment_request['reimbursed_amount'];
                                ?>
                                <tr>
                                    <td><?php echo time_elapsed_string($det['created']); ?></td>
                                    <td align="right"><?php echo "&#8369; ".number_format((float)$payment_request['requested_amount'], 2, '.',','); ?></td>
                                    <td align="right"><?php echo "&#8369; ".number_format((float)$payment_request['released_amount'], 2, '.',','); ?></td>
                                    <td><?php echo $payment_request['purpose']; ?></td>
                                    <td width="150" align="right"><?php echo $payment_invoice_display; ?></td>
                                    <td align="right"><?php echo $total_expense; ?></td>
                                    <td align="right"><?php echo $returned_amount; ?></td>
                                    <td align="right"><?php echo $reimbursed_amount; ?></td>
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
                        <tfoot>
                            <th>Grand Total</th>
                            <th style="text-align: right;"><?php echo "&#8369; ".number_format((float)$requested_amount_total, 2, ".", ","); ?></th>
                            <th style="text-align: right;"><?php echo "&#8369; ".number_format((float)$released_amount_total, 2, ".", ","); ?></th>
                            <th></th>
                            <th></th>
                            <th style="text-align: right;"><?php echo "&#8369; ".number_format((float)$total_expense_total, 2, ".", ","); ?></th>
                            <th style="text-align: right;"><?php echo "&#8369; ".number_format((float)$returned_amount_total, 2, ".", ","); ?></th>
                            <th style="text-align: right;"><?php echo "&#8369; ".number_format((float)$reimbursed_amount_total, 2, ".", ","); ?></th>
                            <th></th>
                        </tfoot>
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