<!--IMPORT STARTS HERE-->
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script> 
<!--IMPORT ENDS HERE-->

<!--PHP GLOBALS STARTS HERE-->
<?php
    $not_specified = "<font class='text-danger'>Not Specified</font>";
    $unknown = "<font class='text-danger'>Unknown</font>";
    $role = $UserIn['User']['role'];
?>
<!--PHP GLOBALS ENDS HERE-->

<!--PAGE CONTENT STARTS HERE-->
<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo ucwords($status); ?> Quotations
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <?php if ($UserIn['User']['role'] == 'sales_executive') { ?>
            <div class="panel-heading" align="right">
                <h3 class="panel-title">
                    <a class="btn btn-mint" style="color:white;" href="/quotations/create" >
                        <i class="fa fa-plus"></i>  Add New Quotations
                    </a>
                </h3>
            </div>
            <?php } ?>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped"
                           width="100%" cellspacing="0" id="example">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Type</th>
                                <th>Subject</th>
                                <th>Client</th>
                                <th>Contract Amount</th>
                                <th>Job Request</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            // 'id', 'created', 'type'
                            foreach($getQuotations as $retQuotations) {
                                $Quotation = $retQuotations['Quotation'];
                                $Client = $retQuotations['Client'];
                                $Quotation_created = $unknown;
                                
                                $action = '';
                                $Quotation_id = $Quotation['id'];
                                if($Quotation['created']!="" &&
                                   $Quotation['created']!=null &&
                                   $Quotation['created']!="0000-00-00") {
                                    $Quotation_created = time_elapsed_string($Quotation['created']);
                                }
                                
                                $Quotation_type = $not_specified;
                                if($Quotation['type']!="" &&
                                   $Quotation['type']!=null) {
                                    $Quotation_type = ucwords($Quotation['type']);
                                }
                                
                                $Quotation_subject = $Quotation['subject'];
                                
                                $Client_name = $unknown;
                                if($Client['name']!="") {
                                    $Client_name = $Client['name'];
                                }
                                
                                $Quotation_quote_number = $unknown;
                                if($Quotation['quote_number']!="" &&
                                   $Quotation['quote_number']!=null) {
                                   $Quotation_quote_number = "<small>[ ".$Quotation['quote_number']." ]</small>";
                                }
                                
                                $Quotation_grand_total = '&#8369; '.
                                number_format($Quotation['grand_total'], 2);
                                
                                if($Quotation['job_request_id']!=0) {
                                    $JobRequest = $retQuotations['JobRequest'];
                                    
                                    if(!empty($JobRequest)) {
                                        $JR_id = $JobRequest['id'];
                                        $JR_number = $JobRequest['jr_number'];
                                        $JR_created = $JobRequest['created'];
                                        // =========================> JOB REQUEST REVISION START HERE
                                        $date_up = new DateTime(date('Y-m-d', strtotime("2018-05-03")));
                                        $jo_created = new DateTime(date('Y-m-d', strtotime($JR_created)));
                                        $interval = $date_up->diff($jo_created);
                                        $interval_day = $interval->format('%R%a');
                                        if($interval_day>=0) {
                                            $JR = '  
                                                <div class="input-group mar-btm">
                                                    <input type="text" class="form-control" placeholder="Name" readonly value="' . $JR_number . '">
                                                    <span class="input-group-btn">
                                                        <a href="/job_requests/view_jr?id='.$JR_id.'"
                                                            target="_blank" 
                                                            class="btn btn-primary btn-icon add-tooltip"
                                                            data-toggle="tooltip"
                                                            data-original-title="View Job Request?">
                                                            <i class="fa fa-external-link"></i>
                                                        </a> 
                                                    </span>
                                                </div>';
                                        }
                                        else {
                                            $JR = '
                                                <div class="input-group mar-btm">
                                                    <input type="text" class="form-control" placeholder="Name" readonly value="' . $JR_number . '">
                                                    <span class="input-group-btn">
                                                        <a class="jrupdateBtn btn btn-warning btn-icon add-tooltip"
                                                           data-toggle="tooltip" 
                                                           data-original-title="Update Job Request!" 
                                                           type="button"
                                                           href="/job_requests/joupdate?id='.$Quotation_id.'">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                        </a>
                                                    </span>
                                                </div>';
                                        }
                                        // ======================> JOB REQUEST REVISION END HERE
                                    }
                                    else {
                                        $JR = '
                                            <br/>
                                            <button class="btn btn-default btn-icon add-tooltip jobRequeBtn"
                                                    data-toggle="tooltip"
                                                    data-original-title="With Job Request?"
                                                    type="button" data-quoteid="'.$Quotation_id.'"
                                                    data-jrid="'.$JR_id.'">
                                                <i class="fa fa-plus"></i>
                                            </button>';
                                    }
                                }
                                
                                if($role=="sales_executive") {
                                    $action = '
                                        <a href="/quotations/update_quotation?id='.$Quotation_id.'"
                                           target="_blank" 
                                           class="btn btn-mint btn-icon add-tooltip"
                                           data-toggle="tooltip"
                                           data-original-title="Update Quotation?">
                                           <i class="fa fa-edit"></i>
                                        </a>

                                        <button class="btn btn-danger btn-icon add-tooltip delete_quote"
                                                data-toggle="tooltip"
                                                data-original-title="Delete Quotation?"
                                                data-typo="deleted"
                                                data-delquoteid="'.$Quotation_id.'"
                                                data-jrid="'.$JR_id.'">
                                            <i class="fa fa-window-close"></i>
                                        </button>
                                        
                                        <button class="btn btn-danger btn-icon add-tooltip delete_quote"
                                                data-toggle="tooltip"
                                                data-original-title="Lost Quotation?"
                                                data-typo="lost"
                                                data-delquoteid="'.$Quotation_id.'"
                                                data-jrid="'.$JR_id.'">
                                            <i class="fa fa-thumbs-down"></i>
                                        </button>';
                                }
                                
                                $action .= '
                                    <a href="/quotations/view?id='.$Quotation_id.'"
                                       target="_blank"
                                       class="btn btn-info btn-icon add-tooltip"
                                       data-toggle="tooltip"
                                       data-original-title="View Quotation?">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="/pdfs/print_quote?id='.$Quotation_id.'"
                                       target="_blank"
                                       class="btn btn-primary btn-icon add-tooltip"
                                       data-toggle="tooltip"
                                       data-original-title="Print Quotation?">
                                       <i class="fa fa-print"></i>
                                    </a>';
                                    
                                
                                echo "
                                <tr>
                                    <td data-order='$Quotation_created'>$Quotation_created</td>
                                    <td>$Quotation_type</td>
                                    <td>$Quotation_subject</td>
                                    <td>$Client_name<br/>$Quotation_quote_number</td>
                                    <td align='right'>$Quotation_grand_total</td>
                                    <td>$JR</td>
                                    <td>$action</td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th>Date Created</th>
                                <th>Type</th>
                                <th>Subject</th>
                                <th>Client</th>
                                <th>Contract Amount</th>
                                <th>Job Request</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--PAGE CONTENT ENDS HERE-->

<!--JAVA SCRIPT STARTS HERE-->
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
        "order": [[0, "desc"]],
        "stateSave": true
    });
});
</script>