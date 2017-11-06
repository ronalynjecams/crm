 
<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Bills</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php
                    if (($UserIn['User']['role'] == 'admin_staff') || ($UserIn['User']['role'] == 'admin_staff')) { ?>
                        <button class="btn btn-mint" id="newBillsBtn" >
                            <i class="fa fa-plus"></i>  Add new bills
                        </button>
                    <?php } ?>

                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Account number</th> 
                            <th>Billing status</th> 
                            <th>Amount</th> 
                            <th>Payment type</th> 
                            <th>Bill account</th>
                            <th>Location</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Account number</th> 
                            <th>Billing status</th> 
                            <th>Amount</th> 
                            <th>Payment type</th> 
                            <th>Bill account</th>
                            <th>Location</th>
                            <th>Actions</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($bills as $bill){ ?>
                            <tr>
                                <td><?php echo h($bill['Bill']['account_number']); ?></td>
                                <td><?php echo h($bill['Bill']['billing_status']); ?></td>
                                <td><?php echo '&#8369; ' . number_format($bill['Bill']['jecams_amount']),2; ?></td>
                                <td><?php echo h($bill['Bill']['payment_type']); ?></td>
                                <td><?php echo h($bill['BillAccount']['name']); ?></td>
                                <td><?php echo h($bill['InvLocation']['name']); ?></td>
                                <td>
                            <?php 
                                #if($UserIn['User']['role'] == 'admin_staff'){ if($UserIn['User']['role'] == 'admin_staff'){ 
                                    echo"<div class='row'>";
                                        echo"<div class='col-sm-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editBillsBtn" data-toggle="tooltip" href="#" data-original-title="Update bill account" data-id="'.$bill['Bill']['id'].'" data-accountnumber="'.$bill['Bill']['account_number'].'" data-billingstatus="'.$bill['Bill']['billing_status'].'" data-amount="'.$bill['Bill']['jecams_amount'].'" data-paymenttype="'.$bill['Bill']['payment_type'].'" data-billid="'.$bill['Bill']['bill_account_id'].'" data-locationid="'.$bill['Bill']['inv_location_id'].'"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                         echo"</div>"; 
                                    echo"</div";
                                #} } 
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
<!--Add New Bill Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-bills-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Bills</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                    <label>Account Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="accountnumber" onkeyup="clean('accountnumber')" onkeydown="clean('accountnumber')">
                </div>
                <div class="form-group" id="name_validation">
                    <label>Billing status<span class="text-danger">*</span></label>
                    <select class="form-control" id="bill_stat">
                    <option>Select a billing status</option>
                    <option value="monthly">monthly</option>
                    <option value="semi_monthly">semi monthly</option>
                    <option value="yearly">yearly</option>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>Amount<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="amount">
                </div>
                <div class="form-group" id="name_validation">
                    <label>Payment type<span class="text-danger">*</span></label>
                    <select class="form-control" id="payment_method">
                    <option value="none">Select a payment method</option>
                    <option value="jecams">jecams</option>
                    <option value="employee">employee</option>
                    <option value="partial">partial</option>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>Bill account<span class="text-danger">*</span></label>
                    <select class="form-control" id="billaccount">
                        <option value="0">Select a bill account</option>
                        <?php
                             foreach($billaccounts as $billaccount){
                        ?>
                        <option value="<?php echo h($billaccount['BillAccount']['id']); ?>"><?php echo h($billaccount['BillAccount']['name']);  ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>location<span class="text-danger">*</span></label>
                    <select class="form-control" id="location">
                        <option value="0">Select a location</option>
                        <?php
                             foreach($invs as $inv){
                        ?>
                        <option value="<?php echo h($inv['InvLocation']['id']); ?>"><?php echo h($inv['InvLocation']['name']); ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveBills">Add bills</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New Bill Modal End !-->

<!--Modal edit bill start-->
<div class="modal fade" id="edit-bills-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit Bill</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                     <input type="hidden" class="form-control"  id="uaccountnum">
                    <label>Account Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="uaccountnumber" onkeyup="validate('uaccountnumber')" onkeydown="validate('uaccountnumber')">
                </div>
                <div class="form-group" id="name_validation">
                    <label>Billing status<span class="text-danger">*</span></label>
                    <select class="form-control" id="ubill_stat">
                    <option value="none">Select a billing status</option>
                    <option value="monthly">monthly</option>
                    <option value="semi_monthly">semi monthly</option>
                    <option value="yearly">yearly</option>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>Amount<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="uamount">
                </div>
                <div class="form-group" id="name_validation">
                    <label>Payment type<span class="text-danger">*</span></label>
                    <select class="form-control" id="upayment_method">
                    <option value="none">Select a payment method</option>
                    <option value="jecams">jecams</option>
                    <option value="employee">employee</option>
                    <option value="partial">partial</option>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>Bill account<span class="text-danger">*</span></label>
                    <select class="form-control" id="ubillaccount">
                        <option value="0">Select a bill account</option>
                        <?php
                             foreach($billaccounts as $billaccount){
                        ?>
                        <option value="<?php echo h($billaccount['BillAccount']['id']); ?>"><?php echo h($billaccount['BillAccount']['name']);  ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>location<span class="text-danger">*</span></label>
                    <select class="form-control" id="ulocation">
                        <option value="0">Select a location</option>
                        <?php
                             foreach($invs as $inv){
                        ?>
                        <option value="<?php echo h($inv['InvLocation']['id']); ?>"><?php echo h($inv['InvLocation']['name']); ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="editBills">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit bill end-->

<script>
    $('#newBillsBtn').on("click", function () {
        $('#add-bills-modal').modal('show');
    });
    
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        ///// check if lead already exist on other sales executive who are also an active user /////
        $('#accountnumber').on('keyup', function (e) {
        var accountnumber = $('#accountnumber').val();
        $('#accountnumber').val($('#accountnumber').val().toUpperCase());
        });
        
        $('#uaccountnumber').on('keyup', function (e) {
        var accountnumber = $('#uaccountnumber').val();
        $('#uaccountnumber').val($('#uaccountnumber').val().toUpperCase());
        });
    
    
        $('#saveBills').on("click", function () {
        var accountnumber = $('#accountnumber').val();
        var bill_stat = $('#bill_stat').val();
        var amount = $('#amount').val();
        var payment_method = $('#payment_method').val();
        var billaccount = $('#billaccount').val();
        var location = $('#location').val();
        
         if ((accountnumber != "" )){ 
             if((bill_stat != "none" )){
                 if((amount != "" )){
                     if((payment_method != "none")){
                        if((billaccount != 0)){
                            if((location != 0)){
                                
                            var data = {"accountnumber": accountnumber, "bill_stat": bill_stat, "amount": amount, "payment_method": payment_method, "billaccount": billaccount, "location": location }
                            $.ajax({
                                url: "/bills/add_bills",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                    // location.reload(true);
                                    window.location.replace("/bills/view_bills");
                                },
                                error: function () {
                                    swal({
                                        type: 'warning',
                                        text: 'message',
                                        title: 'Something went wrong..',
                                        timer: 1000
                                    })
                                }
                            });
                            
        } else {
            document.getElementById('location').style.borderColor = "red";
        }
                            
        } else {
            document.getElementById('billaccount').style.borderColor = "red";
        }
                            
        } else {
            document.getElementById('payment_method').style.borderColor = "red";
        }

                            
        } else {
            document.getElementById('amount').style.borderColor = "red";

        }
                            
             } else {
            document.getElementById('bill_stat').style.borderColor = "red";

        }
               
        } else {
            document.getElementById('accountnumber').style.borderColor = "red";

        }
        
    });

    $(".editBillsBtn").each(function (index) {
        $(this).on("click", function () {

           
            var id = $(this).data('id'); //this line gets value of data-id from delete button
            var accountnum = $(this).data('accountnumber');
            var billstat = $(this).data('billingstatus');
            var amount = $(this).data('amount');
            var paymentmethod = $(this).data('paymenttype'); 
            var billaccountid = $(this).data('billid');
            var locationid = $(this).data('locationid');
            
            //alert(id);
            
            $('#uaccountnum').val(id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
            $('#uaccountnumber').val(accountnum);
            $('#ubill_stat').val(billstat);
            $('#uamount').val(amount);
            $('#upayment_method').val(paymentmethod);
            $('#ubillaccount').val(billaccountid);
            $('#ulocation').val(locationid);
            $('#edit-bills-modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal


        });
    });
    
 $('#editBills').on("click", function () {
    
        var uaccountnumber = $('#uaccountnumber').val();
        var ubill_stat = $('#ubill_stat').val();
        var uamount = $('#uamount').val();
        var upayment_method = $('#upayment_method').val();
        var ubillaccount = $('#ubillaccount').val();
        var ulocation = $('#ulocation').val();
        var uaccountnum = $('#uaccountnum').val();
        
      
        
        if ((uaccountnumber != "" )) {
            
            if((ubill_stat != "none" )){
                
                if((uamount != "" )){
                    
                    if((upayment_method != "none")){
                        
                        if((ubillaccount != 0 )){
                            
                            if((ulocation != 0)){
                                
            var data = {"uaccountnumber": uaccountnumber, "ubill_stat": ubill_stat, "uamount": uamount, "upayment_method": upayment_method, "ubillaccount": ubillaccount, "ulocation": ulocation, "id": uaccountnum}
            
                $.ajax({
                    url: "/bills/update_bills",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (id) {
                        window.location.replace("/bills/view_bills");
                        }
                    });
                    
        } else {
            document.getElementById('ulocation').style.borderColor = "red";
        }          
                    
        } else {
            document.getElementById('ubillaccount').style.borderColor = "red";
        }          
          
        } else {
            document.getElementById('upayment_method').style.borderColor = "red";
        }          
                    
        } else {
            document.getElementById('uamount').style.borderColor = "red";
        }
                    
        } else {
            document.getElementById('ubill_stat').style.borderColor = "red";
        }
                    
        } else {
            document.getElementById('uaccountnumber').style.borderColor = "red";

        }
        
    });
    
});
    
</script>
<script>
function clean(accountnumber){
	var accountnumber = document.getElementById(accountnumber);
	var act_regex = /[^A-Z 0-9,-]/gi;
	
	if(accountnumber.value.search(act_regex) > -1) {
		accountnumber.value = accountnumber.value.replace(act_regex, "");
    }

}

function validate(uaccountnumber){
	var uaccountnumber = document.getElementById(uaccountnumber);
	var uact_regex = /[^A-Z 0-9,-]/gi;
	
	if(uaccountnumber.value.search(uact_regex) > -1) {
		uaccountnumber.value = uaccountnumber.value.replace(uact_regex, "");
    }

}
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