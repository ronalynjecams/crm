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
            My Payment Request List
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped"
                           cell-spacing=0
                           width="100%"
                           id="example">
                        <thead>
                            <tr>
                                <th>Date <?php echo ucwords($type); ?></th>
                                <th>Requested Amount</th>
                                <th>Released Details</th>
                                <?php
                                if($status=="pending" || $status=="acknowledged"
                                    || $status=="approved" || $status=="released") {
                                    echo '<th>Purpose</th>';
                                }
                                ?>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($my_payment_requests as $my_payment_request) {
                                $payment_request = $my_payment_request['PaymentRequest'];
                                $payment_request_id = $payment_request['id'];
                                
                                $created_log = '';
                                foreach($payment_request_logs[$payment_request_id] as $payment_request_log) {
                                    $created_log = date("F d, Y [h:i a]", strtotime($payment_request_log['PaymentRequestLog']['created']));
                                }
                                
                                if ($status=="pending") {
                                    $created = date("F d, Y [h:i a]", strtotime($payment_request['created']));
                                }
                                else {
                                    $created = '[ '.$created_log.' ]';
                                }
                                
                                if($type!="cheque") {
                                    $released_details = $payment_request['released_amount'].' '.$created_log;
                                }
                                else {
                                    foreach($payment_request_cheques[$payment_request_id] as $each_payment_request_cheque) {
                                        $payment_request_cheque = $each_payment_request_cheque['PaymentRequestCheque'];
                                        $bank = $each_payment_request_cheque['Bank'];
                                        $bank_name = $bank['name'];
                                        $cheque_number = $payment_request_cheque['cheque_number'];
                                        $cheque_date = $payment_request_cheque['cheque_date'];
                                    }
                                    
                                    $released_details = '<div class="col-lg-6">'.$created_log.'<br/>'.$bank_name.' '.$cheque_number.' [ '.$cheque_date.' ]</div>
                                      <div class="col-lg-5">( '.$status.' )</div>';
                                }
                                
                                echo '<td>'.$created.'</td>
                                      <td> ₱ '.number_format((float)$payment_request['requested_amount'],2,'.',',').'</td>
                                      <td>'.$released_details.'</td>
                                      <td>'.$payment_request['purpose'].'</td>'; ?>
                                      <td>
                                        <button class="btn btn-primary"
                                            data-toggle="tooltip"
                                            date-placement="left"
                                            title="View Details Avalailable for All Status">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                        
                                        <?php
                                        if($status=="pending" || $status=="acknowledged" ||
                                            $status=="approved") { ?>
                                            <button class="btn btn-warning"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Reject Request">
                                                <span class="fa fa-close"></span>
                                            </button>
                                        <?php
                                        }
                                        
                                        if($status=="pending") {
                                            if($type=="cash") {
                                                if($UserIn['User']['role']=="accounting_head" ||
                                                   $UserIn['User']['role']=="accounting_assistant") {
                                                       ?>
                                                   <button class="btn btn-danger">
                                                       <span class="fa fa-check"></span>
                                                       Acknowledge
                                                   </button>
                                                   <?php
                                               }
                                            }
                                            else if($type=="cheque") {
                                                if($UserIn['User']['role']=="proprietor" ||
                                                   $UserIn['User']['role']=="proprietor_secretary") {
                                                    ?>
                                                    <button class="btn btn-warning">
                                                        <span class="fa fa-check"></span>
                                                        Approve
                                                    </button>
                                                    <?php
                                                }
                                            }
                                        }
                                        else if($status=="acknowledged") {
                                            if($type=="cash") {
                                                if($UserIn['User']['role']=="proprietor" ||
                                                   $UserIn['User']['role']=="proprietor_secretary") {
                                                   ?>
                                                   <button class="btn btn-danger">
                                                       <span class="fa fa-check"></span>
                                                       Approve
                                                   </button>
                                                   <?php
                                               }
                                            }
                                        }
                                        else if($status=="approved") {
                                            if($UserIn['User']['role']=="accounting_head" ||
                                               $UserIn['User']['role']=="accounting_assistant") {
                                                ?>
                                                <a ng-href=""
                                                    data-target="#release-modal"
                                                    data-toggle="modal"
                                                    class="btn btn-danger"
                                                    style="color:white;font-weight:bold;"
                                                    data-id="<?php echo $payment_request_obj['id']; ?>">
                                                    Release
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                      </td>
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
    });
</script>
<!--END JAVASCRIPT METHODS-->
