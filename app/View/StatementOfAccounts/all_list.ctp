<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow">
			Clients with Statement of Accounts
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
	                                <th>Client Name</th>
	                                <th>Sales Executive</th>
	                                <th>Actions</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php
	                        	$count = 0;
	                        	foreach($soas as $soa) {
	                        		$count++;
	                        		$client = $soa['Client'];
	                        		$user = $soa['User'];
	                        		?>
	                        		<tr>
	                        			<td><?php echo $count; ?></td>
	                        			<td><?php echo $client['name']; ?></td>
	                        			<td><?php echo $user['username']; ?></td>
	                        			<td align="center">
	                        				<a href="/statement_of_accounts/quotation_list?id=<?php echo $client['id']; ?>">
	                        					<button class="btn btn-info">
		                        					<span class="fa fa-eye"></span>
		                        				</button>
	                        				</a>
	                        			</td>
	                        		</tr>
	                        		<?php
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
        $('#example').DataTable({
            "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "orderable": true,
            "order": [[0,"asc"]],
            "stateSave": false
        });
    });
</script>
<!--END OF JAVASCRIPT METHODS-->
