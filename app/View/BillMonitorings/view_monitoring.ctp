 
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
                                <td><?php echo $monitoring['BillMonitoring']['billing_date_from']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['billing_date_to']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['user_id']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['bill_id']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['bill_amount']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['receipt_reference_num']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['payment_mode']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['paid_by']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['paid']; ?></td>
                                <td><?php echo $monitoring['BillMonitoring']['receipt_date']; ?></td>
                                
                                <td>
                                <?php 
                                    if($UserIn['User']['role'] == 'admin_staff'){ if($UserIn['User']['role'] == 'admin_staff'){ 
                                    
                                    echo"<div class='row'>";
                                
                                        if($monitoring['BillMonitoring']['payment_mode'] == ""){                                         
                                            echo"<div class='col-sm-6'>";
                                                echo'<a class="btn btn-default btn-icon add-tooltip editBillsBtn" data-toggle="tooltip" data-placement="left" href="#" data-original-title="Request payment" data-id="'.$monitoring['BillMonitoring']['id'].'"><i class="fa fa-money large"></i></a>';
                                            echo"</div>"; 
                                        }else{
                                            echo"<div class='col-sm-6'>";
                                                echo'<a class="btn btn-default btn-icon add-tooltip editBillsBtn" data-toggle="tooltip" data-placement="left" href="#" data-original-title="Edit payment" data-uid="'.$monitoring['BillMonitoring']['id'].'"><i class="glyphicon glyphicon-edit"></i></a>';
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
                        <option value="<?php echo $billaccount['BillAccount']['id']; ?>"><?php echo $billaccount['BillAccount']['name']; ?></option>
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
                    <input type='text' class="form-control" id="bill_ref_no" />
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
<div class="modal fade" id="edit-bills-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
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
                     <input type="hidden" class="form-control"  id="monitor_id">
                    <label>Bill receipt reference number<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ubill_ref_no">
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

        
    $('#addBillsMonitoringBtn').on("click", function () {
        $('#add-monitoring-modal').modal('show');
    });
    
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true,
            "scrollX": true
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

    /*


    
    
    $(".editBillsBtn").each(function (index) {
        $(this).on("click", function () {
             $('#nameExistDiv').remove();
           $('#unameExistDiv').remove();
           
            var id = $(this).data('id'); //this line gets value of data-id from delete button
            var uname = $(this).data('billname');
            
            // alert(uname);
            
            $('#ubill_account_id').val(id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
            $('#uname').val(uname);
            
            $('#edit-bills-modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal


        });
    });
    

    $('#updateBills').on("click", function () {
        var uname = $('#uname').val();
        var update_bill_id = $('#ubill_account_id').val();
        
        if ((uname != "")) {
            var data = {"name": uname, "id":update_bill_id}
                            $.ajax({
                                url: "/bill_accounts/update_account",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (id) {
                                    location.reload();
                                }
                            });
        } else {
            document.getElementById('name').style.borderColor = "red";
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please enter a bill name',
                showConfirmButton: false,
                timer: 1000
            })
        }
    });
    
    */

</script>
<script>

function clean(accountnumber){
	var accountnumber = document.getElementById(accountnumber);
	var act_regex = /[^A-Z 0-9,-]/gi;
	
	if(accountnumber.value.search(act_regex) > -1) {
		accountnumber.value = accountnumber.value.replace(act_regex, "");
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