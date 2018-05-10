<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>  

<div id="content-container">
	<div>
		<?php echo $this->Session->flash('alertforexisting'); ?>
	</div>
    <div id="page-title">
        <h1 class="page-header text-overflow">
            List of Quotations with SOA for <?php echo $client_name; ?>
	        <p><?php echo $agent; ?></p>
        </h1>
    </div>
    
    <div id="page-content">
		<?php if($UserIn['Department']['name'] == 'Accounting Department') { ?>
		<div class="panel">
			<div class="panel-body">
				<div class="table-responsive">
	                    <table id="example"
	                           class="table table-striped table-bordered"
						       cellspacing="0" width="100%"
	    					   data-sort-name="no_pur" data-sort-order="asc">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Quotation Number</th>
	                                <th>Statement of Accounts</th>
	                                <th>Contract Amount</th>
	                                <th>Balance</th>
	                                <?php
		                            if($UserIn['User']['role'] == "collection_officer" ||
		                            	$UserIn['User']['role'] == "accounting_assistant" ||
		                            	$UserIn['User']['role'] == "accounting_head") {
		                            ?>
	                                <th>Payment Due Date</th>
	                                <th>Actions</th>
	                                <?php
	                            	}
	                            	?>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php
	                        	$c=0;
	                        	foreach($soas as $each_soa) {
	                        		$c++;
		                        	$soa = $each_soa['StatementOfAccount'];
		                      //  	var_dump($soa);
		                        	$quotation = $each_soa['Quotation'];
		                        	?>
		                        	<tr>
		                            <td><?php echo $c; ?></td>
		                            <td>
		                            	<a style="font-weight:bold;" href="/quotations/view?id=<?php echo $soa['quotation_id']; ?>">
		                            		<?php echo $quotation['quote_number']; ?>
	                            		</a>
	                            	</td>
		                            <td>
		                            	<a target="_blank" style="font-weight:bold;" href="/pdfs/print_soa?id=<?php echo $soa['id']; ?>">
		                            		<?php echo $soa['soa_number']; ?>
		                            		<i class="fa fa-print"></i>
		                            	</a>
		                            </td>
		                            <td><?php echo '₱ '.number_format((float)$soa['contract_amount'], 2, '.', ''); ?></td>
		                            <td><?php echo '₱ '.number_format((float)$soa['balance'], 2, '.', ''); ?></td>
		                            
		                            <?php
		                            if($UserIn['User']['role'] == "collection_officer" ||
		                            	$UserIn['User']['role'] == "accounting_assistant" ||
		                            	$UserIn['User']['role'] == "accounting_head") {
		                            ?>
		                            <td>
		                            <?php 
		                            // if(is_null($soa['collection_due'])){
		                            	// }else{
		                        		echo date('F d, Y',strtotime($soa['collection_due']));
		                        			echo '    <a class="btn btn-default btn-sm add-tooltip updateCollectionDue" data-toggle="tooltip" href="#" data-original-title="Update Collection Due" data-id="' .$soa['id'] . '" ><i class="fa fa-edit"></i></a>';
		                        
		                            	
		                            // }
		                             ?>
		                            </td>
		                            <td align="center">
		                            	<?php
		                            	if($soa['balance']!=0) {
		                            	?>
		                                <button class="btn btn-mint btn_issue_soa"
		                                        data-toggle="tooltip"
		                                        data-placement="top"
												data-title="Issue SOA"
												value="<?php echo $soa['quotation_id']; ?>">
		                                    <span class="fa fa-plus"></span>
		                                </button>
		                                <?php 
		                            	}
		                            	else {
		                            		?>
	                            		<button class="btn btn-mint" disabled>
		                                    <span class="fa fa-plus"></span>
		                                </button>
		                            		<?php
		                            	}
		                            	?>
		                            </td>
		                            </tr>
		                            <?php 
	                            	}
	                        	}
	                            ?>
	                        </tbody>
	                   </table>
	               </div>
               </div>
           </div>
		<?php
		}
		else {
			echo 'This is a restricted area.';
		}
		?>
	</div>
</div>




<!--===================================================--> 
<div class="modal fade" id="update-collection-due" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <input type="hidden" id="soa_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Collection Due</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body"> 
                 <div class="form-group" >
                    <label>Date Due <span class="text-danger">*</span></label> 
                    <input type="date" id="collection_due" class="form-control">
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateCollectionDueBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->



<!--JAVASCRIPT METHODS-->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        
     //   $("button.btn_issue_soa").on('click', function() {
     //   	var id = $(this).val();
     //   	swal({
     //           title: "Are you sure?",
     //           text: "You will issue SOA for this quotation?",
     //           type: "warning",
     //           showCancelButton: true,
     //           confirmButtonClass: "btn-danger",
     //           confirmButtonText: "Yes",
     //           cancelButtonText: "No",
     //           closeOnConfirm: false,
     //           closeOnCancel: false
     //       },
     //       function (isConfirm) {
     //           if (isConfirm) {
					// $.get('/statement_of_accounts/add', {id: id}, function(data) {
					// 	console.log(data);
					// 	location.reload();
					// })
     //           } else {
     //               swal("Cancelled", "", "error");
     //           }
     //       });
     //   });
		
        $('#example').DataTable({
            "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "orderable": true,
            "order": [[2,"asc"]],
            "stateSave": false
        });
    });
    
        $("button.btn_issue_soa").on('click', function() {
        	var id = $(this).val();
        	var data = {"id":id};
        	swal({
                    title: "Are you sure?",
                    text: "You will issue SOA for this quotation?",
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
                            url: "/statement_of_accounts/add",
                            data: {"data":data},
                            type: "POST",
                            dataType: "text",
                            success: function(success) {
                                console.log(success);
                                location.reload();
                            },
                            error: function(error) {
                               console.log(error);
                                swal("Cancelled", "", "error"); 
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        }); 
    //soa means Statement of Account
    $(".updateCollectionDue").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('id');
            $('#soa_id').val(id);  
            $('#update-collection-due').modal('show');

        });
    });
    
    
    
     $('#updateCollectionDueBtn').on("click", function () {
        var soa_id = $('#soa_id').val();
        var collection_due = $('#collection_due').val(); 
// console.log(collection_due);
        if ((collection_due != "")) {   
    
                $("#updateCollectionDueBtn").prop("disabled", true);
                var data = {"soa_id": soa_id,
                    "collection_due": collection_due,  
                }
    //            console.log(data);
                $.ajax({
                    url: "/statement_of_accounts/updateCollectionDue",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (id) {
                        location.reload();
                        // console.log(id);
                    }
                }); 
        } else {
            document.getElementById('collection_due').style.borderColor = "red";
        }
    });
    
</script>
<!--END OF JAVASCRIPT METHODS-->