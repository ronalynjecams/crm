 
<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="/css/plug/select/js/select2.min.js"></script>
<script src="/js/erp_scripts.js"></script>  
<script src="/js/sweetalert.min.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">For Advance Invoice <?php echo '(<small>'.ucwords($this->params['url']['status']).'</small>)'; ?></h1>
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
            <div class="panel-body table-responsive">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Quotation #</th>
                            <th>Client</th>
                            <th>Agent</th>
                            <th>Contract Amount</th> 
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Quotation #</th>
                            <th>Client</th>
                            <th>Agent</th>
                            <th>Contract Amount</th> 
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($quotations as $list) {
                            ?>
                            <tr>
                                <td><?php echo $list['Quotation']['quote_number']; ?></td>
                                <td><?php echo $list['Client']['name']; ?></td>
                                <td><?php echo $list['User']['first_name'] . ' ' . $list['User']['last_name']; ?></th>
                                <td><?php echo '&#8369; ' . number_format($list['Quotation']['grand_total'], 2); ?></td> 
                                <td>
                                    <?php
                                    if ($this->params['url']['status'] == 'pending') {
                                        //show button for modal
                                        ?>
                                        <button class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="View Quotation?" data-viewquoteid="<?php echo $list['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </button>
                                
                                    <?php
                                     echo '<button class="btn btn-primary btn-icon add-tooltip issue_invoice_btn" data-toggle="tooltip"  data-original-title="Issue Advance Invoice?" data-apquoteid="'.$list['Quotation']['id'].'"  >Issue Invoice</button>';
                                         
                                    }else{
                                        
                                       //show invoice ref number 
                                    }
                                        ?>
                                    </td> 
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
    <div class="modal fade" id="advance_invoice_modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--Modal header-->
                <input type="hidden" id="quota_id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title">Issue Advance Invoice</h4>
                </div>
                <!--Modal body-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6"> 
                            <div class="form-group ">  
                                <label class="control-label">Invoice Number</label> 
                                <input type="text" id="ai_ref_nem" class="form-control">
                            </div> 
                        </div>
                        <div class="col-sm-6"> 
                            <div class="form-group ">  
                                <label class="control-label">Invoice Amount</label> 
                                <input type="number" step="any" id="ai_ref_amount" class="form-control">
                            </div> 
                        </div>
                        <div class="col-sm-12"> 
                            <div class="form-group ">  
                                <label class="control-label">Invoice Date</label> 
                                <input type="date" id="ai_ref_date" class="form-control">
                            </div> 
                        </div>
                    </div>
                </div>
                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary" id="saveAdvanceInvoiceBtn">Issue</button>
                </div>
            </div>
        </div>
    </div>
    <!--===================================================-->
    <!--===================================================--> 
 

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
    });

        $('.view_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("viewquoteid");
                window.open("/quotations/view?id=" + qid, '_blank'); 
            });
        });
    $(".issue_invoice_btn").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('apquoteid');
            $('#quota_id').val(id);
            $('#advance_invoice_modal').modal('show');

        });
    });
 
    $('#saveAdvanceInvoiceBtn').on("click", function () {
        var quotation_id = $('#quota_id').val();
        var ai_ref_nem = $('#ai_ref_nem').val();
        var ai_ref_amount = $('#ai_ref_amount').val();
        var ai_ref_date = $('#ai_ref_date').val();

        if (ai_ref_nem != "") {
            if (ai_ref_amount != "") {
                if (ai_ref_date != "") { 
                    var data = {
                        "quotation_id": quotation_id,
                        "ref_num": ai_ref_nem,
                        "ref_amount": ai_ref_amount,
                        "ref_date": ai_ref_date
                    }
                    
                    $.ajax({
                        url: "/collection_papers/process_advance_invoice",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        success: function (datareturn) {
                            location.reload(); 
                            // console.log(datareturn);
                        }
                    });
                } else {
                    document.getElementById('ai_ref_date').style.borderColor = "red";
                } 
            } else {
                document.getElementById('ai_ref_amount').style.borderColor = "red";
            }
        } else {
            document.getElementById('ai_ref_nem').style.borderColor = "red";
        }
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

