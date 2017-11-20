<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>  

<div id="content-container">
	<div>
		<?php echo $this->Session->flash('alertforexisting'); ?>
	</div>
    <div id="page-title">
        <h1 class="page-header text-overflow">
            List of Quotations with SOA for <?php echo $client_name; ?>
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
		                        	$quotation = $each_soa['Quotation'];
		                        	?>
		                            <td><?php echo $c; ?></td>
		                            <td>
		                            	<a style="font-weight:bold;" href="/quotations/view?id=<?php echo $soa['quotation_id']; ?>">
		                            		<?php echo $quotation['quote_number']; ?>
	                            		</a>
	                            	</td>
		                            <td>
		                            	<a style="font-weight:bold;" href="/pdfs/print_soa?id=<?php echo $soa['id']; ?>">
		                            		<?php echo $soa['soa_number']; ?>
		                            	</a>
		                            </td>
		                            <td><?php echo '₱ '.number_format((float)$soa['contract_amount'], 2, '.', ''); ?></td>
		                            <td><?php echo '₱ '.number_format((float)$soa['balance'], 2, '.', ''); ?></td>
		                            
		                            <?php
		                            if($UserIn['User']['role'] == "collection_officer" ||
		                            	$UserIn['User']['role'] == "accounting_assistant" ||
		                            	$UserIn['User']['role'] == "accounting_head") {
		                            ?>
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

<!--JAVASCRIPT METHODS-->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        
        $("button.btn_issue_soa").on('click', function() {
        	var id = $(this).val();
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
						$.get('/statement_of_accounts/add', {id: id}, function(data) {
							console.log(data);
							location.reload();
						})
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        });
		
        $('#example').DataTable({
            "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "orderable": true,
            "order": [[2,"asc"]],
            "stateSave": false
        });
    });
</script>
<!--END OF JAVASCRIPT METHODS-->