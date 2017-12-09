 
<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

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
        <h1 class="page-header text-overflow">Bill Monitoring</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if (($UserIn['User']['role'] == 'admin_staff') || ($UserIn['User']['role'] == 'admin_staff')) { ?>
                        <button class="btn btn-mint" id="addBillsMonitoringBtn" >
                            <i class="fa fa-plus"></i>  Add new bills monitoring
                        </button>
                    <?php }
                    //$this->Auth->user('id')
                    
                    ?>

                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Billing date from</th> 
                            <th>Billing date to</th> 
                            <th>user</th> 
                            <th>Bill account</th> 
                            <th>bill amount</th> 
                            <th>Billing receipt reference</th> 
                            <th>Payment mode</th> 
                            <th>Paid by</th> 
                            <th>Paid</th>
                            <th>Receipt date</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Billing date from</th> 
                            <th>Billing date to</th> 
                            <th>user</th> 
                            <th>Bill account</th> 
                            <th>Bill amount</th> 
                            <th>Billing receipt reference</th> 
                            <th>Payment mode</th> 
                            <th>Paid by</th> 
                            <th>Paid</th>
                            <th>Receipt date</th> 
                            <th>Action</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($monitorings as $monitoring){ ?>
                            <tr>
                                <td><?php echo h(date('F d, Y', strtotime($monitoring['BillMonitoring']['billing_date_from']))); ?></td>
                                <td><?php echo h(date('F d, Y', strtotime($monitoring['BillMonitoring']['billing_date_to']))); ?></td>
                                <td><?php echo h($monitoring['User']['first_name'])." ".h($monitoring['User']['last_name']); ?></td>
                                <td><?php echo h($monitoring['Bill']['id']); ?></td>
                                <td><?php echo '&#8369; ' . number_format($monitoring['BillMonitoring']['bill_amount'],2); ?></td>
                                <td><?php echo h($monitoring['BillMonitoring']['receipt_reference_num']); ?></td>
                                <td><?php echo h($monitoring['BillMonitoring']['payment_mode']); ?></td>
                                <td>
                                <?php 
                                echo h($monitoring['BillMonitoring']['paid_by']); 
                                
                                ?>
                                </td>
                                <td>
                                    <?php 
                                        if($monitoring['BillMonitoring']['paid'] == 1){
                                            echo "yes";
                                        }else{
                                            echo "no";
                                        }
                                        
                                    ?>
                                </td>
                                <td>
                                <?php 
                                
                                if($monitoring['BillMonitoring']['receipt_date'] == ""){
                                    echo"<p>not available</p>";
                                }else{
                                    echo h(date('F d, Y', strtotime($monitoring['BillMonitoring']['receipt_date']))); 
                                }
                                ?></td>
                                
                                <td>
                                <?php 
                                    if($UserIn['User']['role'] == 'admin_staff'){ if($UserIn['User']['role'] == 'admin_staff'){ 
                                    
                                    echo"<div class='row'>";
                                
                                        if($monitoring['BillMonitoring']['payment_mode'] == ""){                                         
                                            echo"<div class='col-sm-6'>";
                                                echo'<a class="btn btn-default btn-icon add-tooltip requestBtn" data-toggle="tooltip" data-placement="top" href="#" data-original-title="Request payment" data-rid="'.$monitoring['BillMonitoring']['id'].'"><i class="fa fa-money large"></i></a>';
                                            echo"</div>"; 
                                        }else{
                                            echo"<div class='col-sm-6'>";
                                                echo'<a class="btn btn-default btn-icon add-tooltip editBtn" data-toggle="tooltip" data-placement="top" href="#" data-original-title="Edit payment" data-id="'.$monitoring['BillMonitoring']['id'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                                            echo"</div>"; 
                                        }

                                         
                                    echo"</div";
                                        } 
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
<!--Add New Bill Accounts Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-monitoring-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Bill Monitoring</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                 
                    <div class="col-md-6">
                        <div class='form-group' id='name_validation'>
                        <label>Billing date from<span class="text-danger">*</span></label>
                        <input type='date' class="form-control" id="datefrom" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group' id='name_validation'>
                            <label>Billing date to<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="dateto">
                        </div>
                    </div>
            
                <div class="form-group" id="name_validation">
                    <label>Billing account from<span class="text-danger">*</span></label>
                    <select class="form-control" id="billaccount" >
                        <option value="0">Select an account name</option>
                        <?php 
                            foreach($billaccounts as $billaccount){
                        ?>
                        <option value="<?php echo h($billaccount['Bill']['id']); ?>"><?php echo h($billaccount['Bill']['bill_account_id']); ?></option>
                        <?php 
                            } 
                        ?>
                    </select>
                </div>
                <div class='form-group' id="name_validation">
                    <label>Bill Amount<span class="text-danger">*</span></label>
                    <input type='number' class="form-control" id="billamount" />
                </div>
                <div class='form-group' id="name_validation">
                    <label>Bill receipt reference number<span class="text-danger">*</span></label>
                    <input type='text' class="form-control" id="bill_ref_no" onkeyup="clean('bill_ref_no')" onkeydown="clean('bill_ref_no')"  />
                </div>
                <div class='form-group' id="name_validation">
                    <label>Payment mode<span class="text-danger">*</span></label>
                    <select class="form-control" id="payment_mode" >
                    <option value="none">Please Select a payment mode</option>
                    <option value="cash">cash</option>
                    <option value="check">check</option>
                    <option value="online">online</option>
                    </select>
                </div>
                
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveMonitoring">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New Bill Accounts Modal End !-->
<!--Modal edit bill start-->
<div class="modal fade" id="edit-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                <div class="form-group" id="name_validation">
                     <input type="hidden" class="form-control"  id="uid">
                    <label>Bill receipt reference number<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ubill_ref_no" onkeyup="validate('ubill_ref_no')" onkeydown="validate('ubill_ref_no')">
                </div>
                <div class="form-group" id="name_validation">
                    <label>Payment method<span class="text-danger">*</span></label>
                    <select class="form-control" id="upayment_mode">
                    <option value="none">Please Select a payment mode</option>
                    <option value="cash">cash</option>
                    <option value="check">check</option>
                    <option value="online">online</option>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>Paid by: <span class="text-danger">*</span></label>
                    <select class="form-control" id="upaid_by" >
                        <option value="0">Select a name</option>
                        <?php 
                            foreach($users as $user){
                        ?>
                        <option value="<?php echo h($user['User']['id']); ?>"><?php echo h($user['User']['first_name'])." ".h($user['User']['last_name']); ?></option>
                        <?php 
                            } 
                        ?>
                    </select>
                </div>
                <div class="form-group" id="name_validation">
                    <label>Receipt date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="ureceipt_date">
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
        
    $('#bill_ref_no').on('keyup', function (e) {
        var name = $('#name').val();
        $('#bill_ref_no').val($('#bill_ref_no').val().toUpperCase());
 
    });
    
    $('#ubill_ref_no').on('keyup', function (e) {
        var name = $('#name').val();
        $('#ubill_ref_no').val($('#ubill_ref_no').val().toUpperCase());
 
    });

        
    $('#addBillsMonitoringBtn').on("click", function () {
        $('#add-monitoring-modal').modal('show');
    });
    
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
            //"scrollX": true
        });
        
        
       $(".editBtn").each(function (index) {
        $(this).on("click", function () {
           
            var u_id = $(this).data('id'); //this line gets value of data-id from delete button
            $('#uid').val(u_id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
            $('#edit-modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal

        });
    });
    
    
        $('#editBills').on("click", function () {
        var ubill_ref_no = $('#ubill_ref_no').val();
        var upayment_mode = $('#upayment_mode').val();
        var upaid_by = $('#upaid_by').val();
        var ureceipt_date = $('#ureceipt_date').val();
        var id = $('#uid').val();
        
        
        if ((ubill_ref_no != "")) {
            
                 if ((upayment_mode != "none")) {
                     
                     if((upaid_by != 0)){
                     
                        if((ureceipt_date != "")){
                         
                        var data = {"ubill_ref_no": ubill_ref_no, "upayment_mode": upayment_mode, "upaid_by": upaid_by, "ureceipt_date": ureceipt_date, "id": id }
                        
                            $.ajax({
                                url: "/bill_monitorings/edit_payment",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (id) {
                                    location.reload();
                                }
                            });
                            
        } else {
            document.getElementById('ureceipt_date').style.borderColor = "red";
        }
        
        } else {
            document.getElementById('upaid_by').style.borderColor = "red";
        }
                            
        } else {
            document.getElementById('upayment_mode').style.borderColor = "red";
        }

        } else {
            document.getElementById('ubill_ref_no').style.borderColor = "red";
        }
        
    });
  
     $('#saveMonitoring').on("click", function () {
        var datefrom = $('#datefrom').val();
        var dateto = $('#dateto').val();
        var billaccount = $('#billaccount').val();
        var billamount = $('#billamount').val();
        var bill_ref_no = $('#bill_ref_no').val();
        var payment_mode = $('#payment_mode').val();
       
        
         if ((datefrom != "" )) {
             if((dateto != "" )){
                 if((billaccount != 0 )){
                     if((billamount != "")){
                         
                            var data = {
                                "datefrom": datefrom,
                                "dateto": dateto, 
                                "billaccount": billaccount, 
                                "billamount": billamount, 
                                "bill_ref_no": bill_ref_no,
                                "payment_mode": payment_mode
                            }
                            
                            $.ajax({
                                url: "/bill_monitorings/add_monitoring",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                
                                success: function (data) {
                                    location.reload();
                                },
                                error: function () {
                                   alert('error')
                                }
                            });
                            

        } else {
            document.getElementById('billamount').style.borderColor = "red";
            
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please enter a bill amount',
                timer: 1000
            })
        }
                            
                 } else {
            document.getElementById('billaccount').style.borderColor = "red";
            
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please enter billaccount',
                timer: 1000
            })
        }
             } else {
            document.getElementById('dateto').style.borderColor = "red";
            
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please enter date to value',
                timer: 1000
            })
        }
               
        } else {
            document.getElementById('datefrom').style.borderColor = "red";
            
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please complete enter date from value',
                timer: 1000
            })
        }
        
        
     });
        
     
    });
</script>
<script>

function clean(bill_ref_no){
	var bill_ref_no = document.getElementById(bill_ref_no);
	var act_regex = /[^A-Z 0-9,-]/gi;
	
	if(bill_ref_no.value.search(act_regex) > -1) {
		bill_ref_no.value = bill_ref_no.value.replace(act_regex, "");
    }

}

function validate(ubill_ref_no){
	var ubill_ref_no = document.getElementById(ubill_ref_no);
	var uact_regex = /[^A-Z 0-9,-]/gi;
	
	if(ubill_ref_no.value.search(uact_regex) > -1) {
		ubill_ref_no.value = ubill_ref_no.value.replace(uact_regex, "");
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