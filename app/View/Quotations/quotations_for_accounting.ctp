<?php
$isAuthorized = false;
$department = strtolower($UserIn['Department']['name']);
$role = $UserIn['User']['role'];
if($department == 'accounting department' || $role=="proprietor") {
    $isAuthorized = true;
}

if($isAuthorized) {
?>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="/css/plug/magic-check/css/magic-check.min.css" rel="stylesheet">
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<div id="content-container">
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-control">  
                    <a href="/pdfs/accounting_print_quote?type=collection_status" target="_blank" class="btn btn-danger"
                            id="btn_print"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Print Collection Status">
                        <span class="fa fa-print"> Print Collection Status</span>
                    </a>  
                    <a href="/pdfs/accounting_print_quote?type=clearing" target="_blank" class="btn btn-warning"
                            id="btn_print"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Print  For Clearing">
                        <span class="fa fa-print"> Print  For Clearing</span>
                    </a> 
                    <a href="/pdfs/accounting_print_quote?type=collected" target="_blank" class="btn btn-success"
                            id="btn_print"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Print  For Clearing">
                        <span class="fa fa-print"> Print Collected</span>
                    </a> 
                </div>
                <h3 class="panel-title">Quotation</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"
                           width="100%"
                           id="example">
                        <thead>
                            <tr>
                                <th>Quotation #</th>
                                <th>Subject</th>
                                <th>Client</th>
                                <th>Agent</th>
                                <th>Contract Amount</th>
                                <th>Collected Amount</th>
                                <th>Balance Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($get_quotations as $ret_quotation) {
                                $quotation_obj = $ret_quotation['Quotation'];
                                $client_obj = $ret_quotation['Client'];
                                $user_obj = $ret_quotation['User'];
                                $get_collection = $ret_quotation['Collection'];
                                $quotation_id = $quotation_obj['id'];

                                $unknown = "<font class='text-danger'>Unknown</font>";
                                $not_specified = "<font class='text-danger'>Not Specified</font>";
                                $quote_number = $unknown;
                                $client = $not_specified;
                                $agentname = $unknown;
                                if($quotation_obj['quote_number']!="") {
                                    $quote_number = $quotation_obj['quote_number'];
                                }
                                if($client_obj['name']!="") {
                                    $client = ucwords($client_obj['name']);
                                }
                                if($user_obj['first_name']!="" && $user_obj['last_name']!="") {
                                    $fname = $user_obj['first_name'];
                                    $lname = $user_obj['last_name'];
                                    $agentname = ucwords($fname." ".$lname);
                                }
                                $contract_amount = "&#8369 0.00";
                                $collected_amount = "&#8369 0.00";
                                $balance_amount = "&#8369 0.00";
                                $collected_amount_tmp = 0;
                                if($quotation_obj['grand_total']!=null) {
                                    $contract_amount_tmp = $quotation_obj['grand_total'];
                                    $contract_amount = "&#8369 ".number_format($contract_amount_tmp, 2);
                                }
                                $total_payment = 0;
                                foreach($get_collection as $collected){
                                    if($collected['status']=='verified'){
                                        $payment = $collected['amount_paid'] + $collected['with_held'] + $collected['other_amount'];
                                        $total_payment = $total_payment + $payment;
                                    }
                                }
                                $collected_amount = "&#8369 ".number_format($total_payment, 2);
                                $balance_amount_tmp = $contract_amount_tmp - $total_payment;
                                $balance_amount = "&#8369 ".number_format($balance_amount_tmp, 2);
                                $quotation_subject = $quotation_obj['subject'];
                            ?>
                            <tr>
                                <td><?php echo $quote_number; ?></td>
                                <td><?php echo $quotation_subject; ?></td>
                                <td><?php echo $client; ?></td>
                                <td><?php echo $agentname; ?></td>
                                <td><?php echo $contract_amount; ?></td>
                                <td><?php echo $collected_amount; ?></td>
                                <td><?php echo $balance_amount; ?></td>
                                <th>  
                                <button class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="View Quotation?" data-viewquoteid="<?php echo $quotation_obj['id']; ?>"><i class="fa fa-eye"></i> </button>
                                  
                                    <?php
                                    
                                    if (AuthComponent::user('role') == 'collection_officer' || AuthComponent::user('role') == 'accounting_secretary' || AuthComponent::user('role') == 'accounting_head') { 
                                        if($quotation_obj['collection_status']!='paid'){
                                             echo '<a class="btn btn-default btn-icon add-tooltip updateCollectionStatus " data-toggle="tooltip" href="#" data-original-title="Update Collection Status" data-id="' . $quotation_obj['id'] . '" data-rem="' . $quotation_obj['collection_remarks'] . '"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                             echo '  <a class="btn btn-success btn-icon add-tooltip addCollection" data-toggle="tooltip" href="#" data-original-title="Update Collection" data-idaddcollection="' . $quotation_obj['id'] . '" ><i class="fa fa-money"></i></a>';
                                        }else{
                                            //  echo '<a class="btn btn-default btn-icon add-tooltip updateCollectionStatus " data-toggle="tooltip" href="#" data-original-title="Update Collection Status" data-id="' . $quotation_obj['id'] . '" data-rem="' . $quotation_obj['collection_remarks'] . '"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                                           echo '  <a class="btn btn-success btn-icon add-tooltip addCollection" data-toggle="tooltip" href="#" data-original-title="Update Collection" data-idaddcollection="' . $quotation_obj['id'] . '" ><i class="fa fa-money"></i></a>';
                                    
                                  
                                        }
                                        
                                            //
                                        //update collection status if !=paid
                                    }
                                    ?>
                                </th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!--===================================================--> 
<div class="modal fade" id="update-collection-status" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <input type="hidden" id="quotation_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Collection Status</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                 <div class="form-group">
                    <label>Select Status <span class="text-danger">*</span></label>
                    <select class="form-control" id="collection_status" >
                        <option></option> 
                        <option value="for_collection">For Collection</option>  
                        <option value="with_terms">With Terms</option>  
                        <option value="incomplete">Incomplete</option>  
                        <option value="backjob">With Backjob</option>  
                        <option value="with_pdc">PDC</option>  
                        <option value="bir2307">BIR2307</option>  
                        <option value="undelivered">Undelivered</option>  
                    </select> 
                </div>
                 <div class="form-group" >
                    <label>Remarks <span class="text-danger">*</span></label> 
                    <input type="text" id="collection_remarks" class="form-control">
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateCollectionStatusBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--JAVASCRIPT-->
<script type="text/javascript">

    $(".addCollection").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('idaddcollection');
//            $('#collector_schedule_id').val(id);
//            $('#add-collector').modal('show');
     window.location.replace("/collections/collect?id=" + id);
            

        });
    });
    
$(document).ready(function(e) {
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#example').DataTable({
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
        "order": [[0, "desc"]],
        "stateSave": true
    });
});


        $('.view_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("viewquoteid");
                window.open("/quotations/view?id=" + qid, '_blank'); 
            });
        });
        
        
    $(".updateCollectionStatus").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('id');
            $('#quotation_id').val(id);
            var rem = $(this).data('rem');
            $('#collection_remarks').val(rem);
            $('#update-collection-status').modal('show');

        });
    });
    
    
    
    
    
    
     $('#updateCollectionStatusBtn').on("click", function () {
        var quotation_id = $('#quotation_id').val();
        var collection_status = $('#collection_status').val();
        var collection_remarks = $('#collection_remarks').val();

        if ((collection_status != "")) {  
            if ((collection_remarks != "")) { 
    
                $("#updateCollectionStatusBtn").prop("disabled", true);
                var data = {"quotation_id": quotation_id,
                    "collection_status": collection_status, 
                    "collection_remarks": collection_remarks, 
                }
    //            console.log(data);
                $.ajax({
                    url: "/quotations/updateCollectionStatus",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (id) {
                        location.reload();
                        // console.log(id);
                    }
                });
            } else {
                document.getElementById('collection_remarks').style.borderColor = "red";
            } 
        } else {
            document.getElementById('collection_status').style.borderColor = "red";
        }
    });
    
</script>
<!--END OF JAVASCRIPT-->

<?php
}
else {
    echo '
    <div id="content-container">
        <div id="page-content">This is a restricted area. Please contact System Administrator.</div>
    </div>';
}
?>