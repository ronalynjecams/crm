<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<!--Morris.js [ OPTIONAL ]-->
<link href="/css/plug/morris-js/morris.min.css" rel="stylesheet" />

<!--Morris.js [ OPTIONAL ]-->
<script src="/css/plug/morris-js/morris.min.js"></script>
<script src="/css/plug/morris-js/raphael-js/raphael.min.js"></script>

<script>            
$(window).on('load', function() {
    // Network chart ( Morris Line Chart )
    // =================================================================
    // Require MorrisJS Chart
    // -----------------------------------------------------------------
    // http://morrisjs.github.io/morris.js/
    // =================================================================

    var graph_data_str = '<?php echo $json_graph_data; ?>';
    var graph_data = JSON.parse(graph_data_str);
    var chart = Morris.Area({
        element : 'morris-chart-network',
        data: graph_data,
        axes:false,
        xkey: 'elapsed',
        ykeys: ['pending', 'approved'],
        labels: ['Pending', 'Approved'],
        yLabelFormat :function (y) { return y.toString() },
        gridEnabled: false,
        gridLineColor: 'transparent',
        lineColors: ['#82c4f8','#0d92fc'],
        lineWidth:[0,0],
        pointSize:[0,0],
        fillOpacity: 1,
        gridTextColor:'#999',
        parseTime: false,
        resize:true,
        behaveLikeLine : true,
        hideHover: 'auto'
    });
});
</script>


<!--FLOT PIE CHART-->
<script src="/css/plug/flot-charts/jquery.flot.min.js"></script>
<script src="/css/plug/flot-charts/jquery.flot.resize.min.js"></script>
<script src="/css/plug/flot-charts/jquery.flot.pie.min.js"></script>
<script src="/js/agent_status.js"></script>

<!--Sparkline [ OPTIONAL ]-->
<script src="/css/plug/sparkline/jquery.sparkline.min.js"></script> 
<!--<div class="boxed">-->      


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Dashboard</h1>

        <!--Searchbox-->
        <div class="searchbox">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search..">
                <span class="input-group-btn">
                    <button class="text-muted" type="button"><i class="demo-pli-magnifi-glass"></i></button>
                </span>
            </div>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        
		<div class="row">
		    <div class="col-lg-7">
		
		        <!--Network Line Chart-->
		        <!--===================================================-->
		        <div id="demo-panel-network" class="panel">
		            <div class="panel-heading">
		                <h3 class="panel-title">Quotation</h3>
		            </div>
		
					<div class="panel-body">
						<div class="row">
				            <!--Morris line chart placeholder-->
				            <div id="morris-chart-network" class="morris-full-content"></div>
				        </div>
				    </div>
		        </div>
				
				<?php foreach($tteams as $tteam){ ?>	 
		            <div class="col-sm-2"> 
		                <div class="panel panel-info ">
		                    <div class="pad-all">
		                        <p class="text-sm text-semibold"> <?php echo $tteam['Team']['display_name']; ?> <br/>[Daily]</p> 
		                        	<!--<span class="text-2x text-semibold"><a href="/pdfs/print_sales?range=m" target="_blank" style="color:white"> <?php echo '&#8369; '.number_format($monthly,2); ?> </a></span>-->
		                        <p class="mar-no">
		                        	<?php  
		                        	$variable = new AppController();
									$pending_ccount = $variable->team_count_quotes('pending', $tteam['Team']['id']);
									$approved_ccount = $variable->team_count_quotes('moved', $tteam['Team']['id']);
		                        	// echo $this->team_total('daily', $tteam['Team']['id']);
		                        	echo 'Pending:'.$pending_ccount.'<br/>Moved: '.$approved_ccount.'' ;
		                        	
		                        	?>
		                        	
		                        	
		                        </p>
		                    </div> 
		                </div> 
				    </div> 
				    <?php } ?>
		        <!--===================================================-->
		        <!--End network line chart-->
		
		    </div>
		    <div class="col-lg-5">
		        <div class="row"> 
		            <div class="col-sm-6 col-lg-6">
		                <!--Sparkline pie chart -->
		                <div class="panel panel-warning panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold"> Quotations </p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $pending_counts; ?></span>
		                            Pending
		                        </p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $edited_quote_count_left_side; ?></span>
		                            Rejected
		                        </p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $moved_counts; ?></span>
		                            Moved
		                        </p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $approved_counts; ?></span>
		                            Approved
		                        </p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $pending_accounting_counts; ?></span>
		                            Pending Accounting
		                        </p>
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline Area Chart-->
		                <div class="panel panel-success panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> Sales  [<?php echo $month; ?>]</p>
		                        <!--<p class="mar-no"> <?php //echo 'For the month of '.$month; ?>  </p>-->
		                        	<span class="text-2x text-semibold"><a href="/pdfs/print_sales?range=m" target="_blank" style="color:white"> <?php echo '&#8369; '.number_format($monthly,2); ?> </a></span>
		                          
		                        <p class="mar-no">
		                        	<a href="/pdfs/print_sales?range=t" target="_blank" style="color:white">
				                        Today:
										&#8369; <?php echo number_format($daily, 2); ?>
									</a>
		                        </p>
		                    </div>
		                    <!--<div class="pad-all text-center">-->
		                        <!--Placeholder-->
		                    <!--    <div id="demo-sparkline-area"></div>-->
		                    <!--</div>-->
		                </div>
		            </div>
		            
		        </div>
		        <div class="row">
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline bar chart -->
		                <div class="panel panel-purple panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold"><i class="demo-pli-bag-coins icon-fw"></i>Team Sales [<?php echo $month;?>]</p>
		                        <?php foreach($team_monthly as $data):
		                        	$team_id = $data['id'];
		                        ?>
			                        <p class="mar-no">
			                            <span class="pull-right text-bold">&#8369; <?php if(!empty($data['grand_total_team'])) echo number_format($data['grand_total_team'],2); else echo 0;?></span>
			                            <a id="team_clicked" data-id="<?php echo $team_id; ?>"
			                               data-name="<?php echo $data['display_name']; ?>"
			                               style="color:white;cursor:pointer;">
			                            		[<?php echo $data['display_name']; ?>]
			                            </a> =>
			                        </p>
		                        <?php endforeach; ?>
		                    </div>
		                    <!--<div class="pad-all text-center">-->
		                        <!--Placeholder-->
		                    <!--    <div id="demo-sparkline-bar" class="box-inline"></div>-->
		
		                    <!--</div>-->
		                </div>
		            </div>
		            
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline Line Chart-->
		                <div class="panel panel-info panel-colorful">
		                    <div class="pad-all">
		                    	
		                        <p class="text-lg text-semibold"><i class="demo-pli-wallet-2 icon-fw"></i> Earning</p>
		                        <a href="/pdfs/print_sales?range=y" target="_blank" style="color:white">
		                   		<span class="text-2x text-semibold">&#8369; <?php echo number_format($yearly, 2);?></span>
		                        <p class="mar-no">
		                         	For the year <?php echo $year;?>
		                        </p>
		                        </a> 
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div> 
		<div class="row">
			<div class="col-sm-12">
					<h2 id="page-header text-overflow" align="center">Reports</h2>
		            	
		            <div class="col-sm-6 col-lg-2">
		                <!--Sparkline pie chart -->
		                <div class="panel panel-default panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold">Accounting</p>  
		                    </p>
		                    <p>
		                    	 <button id="" data-monitarytype="Cheque" class="btn btn-default monitary_requisition_btn"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print Collection Status">
			                       <small> Issued Cheques  </small>
			                    </button>  
		                    </p>
		                    <p>
		                    	<a  id="" data-monitarytype="Cash" class="btn btn-default monitary_requisition_btn"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print  For Clearing">
			                       <small>  Issued Cash </small> 
			                    </a> 
		                    </p>
		                    <p>
		                    	<a  id="" data-monitarytype="Petty Cash" class="btn btn-default monitary_requisition_btn"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print For Clearing">
			                       <small>  Issued Petty Cash </small> 
			                    </a> 
		                    </p>
		                    <p>
		                    	<a href="/payment_request_cheques/pdc_calendar" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="PDC Calendar">
			                       <small>  PDC Calendar </small> 
			                    </a> 
		                    </p>
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-6 col-lg-2"> 
		                <div class="panel panel-default panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold">Collection</p> 
		                        
		                    <p>
		                    	<a href="/pdfs/accounting_print_quote?type=collected" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print  For Clearing">
			                        <small> Collected </small>
			                    </a>
			                    
		                    </p>
		                    <p>
		                    	<a href="/pdfs/accounting_print_quote?type=clearing" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print  For Clearing">
			                        <small> For Clearing </small>
			                    </a> 
		                    </p>
		                    <p>
		                    	 <a href="/pdfs/accounting_print_quote?type=collection_status" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print Collection Status">
			                       <small>Collection Status</small> 
			                    </a>  
		                    </p> 
		                    <p>
		                    	 <a href="/reports/collection_schedule?start=<?php echo date('Y-m-d'); ?>&&end=<?php echo date('Y-m-d'); ?>" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print Collection Schedule">
			                       <small><?php echo '<span class="label label-danger ">'.$daily_collection_schedule.' </span> '; ?>&nbsp; Daily Schedule</small> 
			                    </a>  
		                    </p> 
		                    <p>
		                    	 <a href="/calendars/collection_schedules" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Collection Schedule Calendar">
			                       <small>Schedule Calendar</small> 
			                    </a>  
		                    </p> 
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-6 col-lg-2">
		                <!--Sparkline pie chart -->
		                <div class="panel panel-default panel-colorful">
		                    <div class="pad-all">
		                    <!--    <p class="text-lg text-semibold">Purchasing</p>  -->
		                    <!--</p>-->
		                    <p class="text-lg text-semibold">Top Purchased</p>
		                    <p>
		                    	 <a href="/purchase_order_products/supply_top_purchased?type=supply" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print Collection Status">
			                       <small>Suppliers  </small>
			                    </a>  
		                    </p>
		                    <p>
		                    	<a href="/purchase_order_products/top_purchased?dept=6" target="_blank" class="btn btn-default"
			                            id="btn_print"
			                            data-toggle="tooltip"
			                            data-placement="top"
			                            title="Print  For Clearing">
			                       <small> Products </small> 
			                    </a> 
		                    </p>
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-6 col-lg-2">
		                <!--Sparkline pie chart -->
		                <div class="panel panel-default panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold">Delivery</p>  
		                    </p>
		                    <!--<p>-->
		                    <!--	 <a href="/purchase_order_products/supply_top_purchased?type=supply" target="_blank" class="btn btn-default"-->
			                   <!--         id="btn_print"-->
			                   <!--         data-toggle="tooltip"-->
			                   <!--         data-placement="top"-->
			                   <!--         title="Print Collection Status">-->
			                   <!--    <small> Top Purchased Suppliers  </small>-->
			                   <!-- </a>  -->
		                    <!--</p>-->
		                    <p>
		                      <button class="btn btn-default" id="print_itenerary" data-toggle="tooltip"  data-original-title="Print Itenerary" data-buttontype="start">Retrieve Itenerary</button>
             
		                    </p>
		                    </div>
		                </div>
		            </div>
			</div>
		</div>
	 
		
	 <!--AGENT STATUS-------------------------------------->
	 <?php
		$mo_now = date("F");
		$yr_now = date("Y");
		if(!empty($get_users)) {
 	 ?>
	 <div class="col-lg-12" style="margin-bottom:30px;">
	 	<h2 id="page-header text-overflow" align="center">
 			Agents' Status (<?php echo $mo_now.", ".$yr_now; ?>)
 		</h2>
 		
 		<div class="row" id="sort_divs">
 			<?php
 			$c=0;
 			foreach($get_users as $ret_user) {
 				$c++;
 				$user = $ret_user['User'];
 				$user_id = $user['id'];
 				$first_name_tmp = $user['first_name'];
 				
 				if($first_name_tmp != "") {
 					$first_name = ucwords(strtolower($first_name_tmp));
 				}
 				else {
 					$first_name = "<font style='color:red'>Unknown</font>";
 				}
 				
 				$pending_count = 0;
 				$approved_count = 0;
 				$tot_contract_amount_tmp = 0;
 				$tot_contract_amount = 0;
 				
 				foreach($get_quotations[$user_id] as $ret_quotations) {
 					$quotations = $ret_quotations['Quotation'];
 					$status = $quotations['status'];
 					$contract_amount_tmp = $quotations['grand_total'];
 					
 					if($status == "approved" || $status == "processed") {
 						$tot_contract_amount_tmp+=$contract_amount_tmp;
 						$approved_count++;
 					}
 					else if($status == "pending") {
 						$pending_count++;
 					}
 					$tot_contract_amount = number_format((float)$tot_contract_amount_tmp,2,'.',',');
 					 
 				}
 				
 				$team_name = "<font class='text-danger'>Unknown</font>";
 				$agent_status_quota = 0;
 				$team_id = 0;
 				foreach($get_agent_status[$user_id] as $ret_agent_status) {
 					$agent_status = $ret_agent_status['AgentStatus'];
 					$team = $ret_agent_status['Team'];

 					$team_id = $team['id'];
 					$team_name = ucwords(strtolower($team['name']));
 					$agent_status_quota = $agent_status['quota'];
 				}
 			?>
 			<div class="box">
 			<div class="col-sm-2 eq-box-sm">
 				<div class="panel panel-default">
 					<div class="panel-heading">
 						<a href="/pdfs/print_sales?range=m&&salesagent=<?php echo $user_id; ?>"
 						   class="panel-title text-primary"
 						   target="_blank"
 						   style="font-size:12px;margin-left:-1em;">
 							<?php echo $first_name." [".$team_name."]"; ?>
 						</a>
 					</div>
 					<div class="panel-body"> 
 						<input id="tot_amount_id" value="<?php echo $tot_contract_amount_tmp; ?>" hidden /> 
                                        
                                        
						<p id="tot_amount"><small>Yearly: &#8369 <?php echo $tot_contract_amount; ?> </small></p>
						<p>[<small>Quota &#8369 <?php echo number_format((float)$agent_status_quota,2,'.',','); ?> </small>]</p>
						<?php if ($this->requestAction('App/my_monthly_total/'.$user_id.'') != 0) { ?>
							 
						<p><small><?php
								echo date('F'); ?>: &#8369 <?php echo number_format($this->requestAction('App/my_monthly_total/'.$user_id.''),2); 
								if((floatval($this->requestAction('App/my_monthly_total/'.$user_id.''))) >= $agent_status_quota){
									echo '<i class="fa fa-check text-success></i>';
								} 
						?> </small></p>
						<?php
							}else{
								 ?>
							 
						<p><small><?php
								echo date('F').': &#8369  0.00';
						?> </small></p>
						<?php
								
							}
						?>
						
						<p><small><i class="fa fa-circle" style="color: #009933;"></i> Approved: </small> <?php echo $approved_count; ?></p>
						<p><small><i class="fa fa-circle" style="color: #3399ff;"></i> Pending: </small> <?php echo $pending_count; ?></p>
						
						<!--Flot Donut Chart placeholder -->
				        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
				        <div class="PiePendingApproved" style="height:180px">
				        	<?php
				        		$datatopass = [["label"=>"Approved","data"=>$approved_count,"color"=>"#009933"],
				        					   ["label"=>"Pending","data"=>$pending_count,"color"=>"#3399ff" ]];
				        	?>
				        	<textarea class="data" hidden><?php echo json_encode($datatopass); ?></textarea>
				        	
				        </div>
				        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
				         
					</div>
					
					<div class="panel-footer">
						<div align="right">
							<a href="/pdfs/print_sales?range=y&&salesagent=<?php echo $user_id; ?>" target="_blank" class="btn btn-default btn-xs">Yearly</a>
 							
 							<?php
 							if($team_name!="<font class='text-danger'>Unknown</font>") {
 								?>
 								<button id="monthly_btn"
 										target="_blank"
 										class="btn btn-default btn-xs"
 										data-id="<?php echo $user_id; ?>"
 										data-name="<?php echo $first_name; ?>">Monthly</button>
 							<?php
 							}
 							else {
 								echo '<button disabled style="cursor:not-allowed;" class="btn btn-default btn-xs">Monthly</button>';
 							}
 							?>
						</div>
					</div>
 				</div>
 			</div>
 			</div>
 			<?php }
 			} ?>
 		</div>
	 </div>
	 <!--END of AGENT STATUS------------------------------->
		
		
    </div>
    <!--===================================================-->
    <!--End page content-->


</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
            
            
       

<!--Date Range Modal Start-->
<!--===================================================-->
<div class="modal fade" id="date-range-modal" role="dialog" tabindex="-1"
     aria-labelledby="date-range-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Select Sales Report Range
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
				<p style="font-size:25px;" align="center">
					For <font id="sales_name"></font>
				</p>
				
			
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							Start Date
							<input type="date" class="form-control" id="start_date" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							End Date
							<input type="date" class="form-control" id="end_date" />
						</div>
					</div>
					<div id="monetary_body"></div>
				</div>
			</div>
			
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_date_range">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Date Range Modal End-->       
    
<!--Monitary Requisition Modal Start-->
<!--===================================================--> 
	
<div class="modal fade" id="monitary-requisition-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <div class="modal-title" id="monitary_title">
	          </div>
			</div>
			<!--Modal body-->
			<div class="modal-body">  
			<input type="text" id="selected_type" hidden>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							Start Date <span class="text-danger"> * </span>
							<input type="date" class="form-control" id="monetary_start_date" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							End Date <span class="text-danger"> * </span>
							<input type="date" class="form-control" id="monetary_end_date" />
						</div>
					</div>
				</div>
				
				<div class="row" id="cheque_div">
					<div class="col-lg-6">
						<div class="form-group">
							Select Type <span class="text-danger"> * </span>
							<select class="form-control" id="monetary_pdc_type">
								<option value=""></option>
								<option value="payee">Per Payee</option>
								<option value="bank">Bank</option>
								<option value="all">ALL</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group payee_div">
							Select Payee <span class="text-danger"> * </span>
							<select class="form-control" id="monetary_payee_id">
								<option></option> 
								<?php
								foreach($payees as $payee){
									echo '<option value="'.$payee['Payee']['id'].'">'.$payee['Payee']['name'].'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group bank_div">
							Select Bank <span class="text-danger"> * </span>
							<select class="form-control" id="monetary_bank_id">
								<option></option>  
								<option value="1">BDO</option>  
								<option value="12">Union Bank</option>  
								<option value="2">Metrobank</option>  
								<option value="3">BPI</option>  
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_monetary_date_range">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================--> 
<!--Monitary Requisition Modal End-->

<!--Itenerary Date Range Modal Start-->
<!--===================================================-->
<div class="modal fade" id="print-itenerary-modal" role="dialog" tabindex="-1"
     aria-labelledby="date-range-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Select Date Range for Itenerary
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">  
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							Start Date
							<input type="date" class="form-control" id="itenerary_start_date" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							End Date
							<input type="date" class="form-control" id="itenerary_end_date" />
						</div>
					</div> 
					<div class="col-lg-6">
						<div class="form-group">
							Select Type
							<select class="form-control" id="itenerary_type">
							    <option value="all">ALL</option>
							    <option value="per_driver">Per Driver</option>
							</select>
						</div>
					</div> 
					<div class="col-lg-6" id="itenerary_driver_div">
						<div class="form-group">
							Select Driver
							<select class="form-control" id="itenerary_driver">
                            <option value="">Select Driver</option>
                            <?php foreach($drivers as $user){ ?>
                            <option value="<?php echo $user['User']['id'].' '.$user['User']['last_name'];?>"><?php echo $user['User']['first_name'].' '.$user['User']['last_name'];?></option>
                            <?php } ?>
							</select>
						</div>
					</div> 
					
					
			<div id="print_itenerary_error"></div>
				</div>
			</div> 
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_print_itenerary">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!-- Itenerary Date Range Modal End-->      
<!--JAVASCIPT FUNCTIONS-->
<script>
$(document).ready(function() {  
	$('#cheque_div').hide();
	$('#itenerary_driver_div').hide();

	// alert('asdasd');
	
	$('div.box').sort(function(a, b) {
		// alert(parseInt($(a).find("#tot_amount_id").val()));
		if (parseInt($(a).find("#tot_amount_id").val()) > parseInt($(b).find("#tot_amount_id").val()))
			{ return -1; }
		else { return 1; }
	}).appendTo('#sort_divs');
	
	
	$( "#monetary_pdc_type" ).change(function() {
		var money = $("#monetary_pdc_type").val();
		
		if(money == 'payee'){
			$('.payee_div').show();
			$('.bank_div').hide();
		}else if(money  == 'bank'){
			$('.payee_div').hide();
			$('.bank_div').show();
		} else{  
			$('.payee_div').hide();
			$('.bank_div').hide();
		}
	});
	
	
					// $('.payee_div').hide();
	$("#monetary_payee_id").select2({
	    placeholder: "Select Payee",
	    width: '100%',
	    allowClear: true
	});
	
});

	// $(document).ready(function() {
		var salesagent = 0;
		var type = "sales";
		var team = 0;
		$("button#monthly_btn").on('click', function() {
			salesagent = $(this).data('id');
			var sales_name = $(this).data('name');
			$("#sales_name").text(sales_name);
			$('#date-range-modal').modal('show');
		});
		
		$("a#team_clicked").on('click', function() {
			type="team";
			team = $(this).data('id');
			var team_name = $(this).data('name');
			$("#sales_name").text("Team "+team_name);
			$('#date-range-modal').modal('show');
		});
		
		$("#btn_date_range").on('click', function() {
			var start_date = $("#start_date").val();
			var end_date = $("#end_date").val();
			
			if(start_date!="") {
				if(end_date!="") {
					$('#date-range-modal').modal('hide');
					if(type=="sales") {
						window.open("/pdfs/print_sales?range=m&&salesagent="+salesagent+
									  "&&sd="+start_date+"&&ed="+end_date, '_blank');
					}
					else if(type=="team") {
						window.open("/pdfs/print_sales?range=m&&team_id="+team+
									  "&&sd="+start_date+"&&ed="+end_date, '_blank');
					}
					else {
						location.reload();
					}
				}
				else {
					$("#end_date").css({'border-color':'red'});
				}
			}
			else {
				$('#start_date').css({'border-color':'red'});
			}
		});
		
		 
		$(".monitary_requisition_btn ").on('click', function() {
			 
			$('#monitary_title_added').remove();
			$('#monetary_body').remove();
			$('.payee_div').hide();
			$('.bank_div').hide();
			var monitary_type = $(this).data('monitarytype'); 
			$("#selected_type").val(monitary_type);
			$( "<div id='monitary_title_added'>Select Date Range for "+monitary_type+" Requests</div>" ).appendTo( "#monitary_title" );
			var sel_val = $("#selected_type").val();
				if( sel_val === 'Cash' || sel_val === 'Petty Cash'){
					$('#cheque_div').hide();
				}else{
					$('#cheque_div').show();
				} 
			$('#monitary-requisition-modal').modal('show');
		});
		
		
		
		$("#btn_monetary_date_range").on('click', function() {
			var start_date = $("#monetary_start_date").val();
			var end_date = $("#monetary_end_date").val();
			var pdc_type = $("#monetary_pdc_type").val();
			var payee_id = $("#monetary_payee_id").val();
			var bank_id = $("#monetary_bank_id").val();
			var selected_type = $("#selected_type").val();
			
				
				
			if(start_date!="") {
				if(end_date!="") {
						if(selected_type === 'Cheque'){
							//require payee if selected pdc_type == 'pdc'  
							if(pdc_type==="payee") {
								if(payee_id==="") {
									$("#monetary_payee_id").css({'border-color':'red'}); 
								}else{
								//go to print page 
									var bank_id = "none";
									$('#monitary-requisition-modal').modal('hide'); 
									window.open("/pdfs/print_monetary_report?bank="+bank_id+"&&type=cheque&&pdc_type="+pdc_type+"&&payee_id="+payee_id+
													  "&&sd="+start_date+"&&ed="+end_date, '_blank');
									
								}
								
							}else if(pdc_type==="bank") {
								var payee_id = "none";
								if(bank_id==="") {
									$("#monetary_bank_id").css({'border-color':'red'}); 
								}else{
								//go to print page 
									$('#monitary-requisition-modal').modal('hide'); 
									window.open("/pdfs/print_monetary_report?bank="+bank_id+"&&type=cheque&&pdc_type="+pdc_type+"&&payee_id="+payee_id+
													  "&&sd="+start_date+"&&ed="+end_date, '_blank');
									
								}
							}else{
								var payee_id = "none";
								var bank_id = "none";
								//go to print page 
									$('#monitary-requisition-modal').modal('hide'); 
									window.open("/pdfs/print_monetary_report?bank="+bank_id+"&&type=cheque&&pdc_type="+pdc_type+"&&payee_id="+payee_id+
													  "&&sd="+start_date+"&&ed="+end_date, '_blank');
							}
							
							location.reload();
						}else{
							//go to print page
							var pdc_type = "none";
							var payee_id = "none";
							var bank_id = "none";
							if(selected_type=="Cash") {
								window.open("/pdfs/print_monetary_report?bank="+bank_id+"&&type=cash&&pdc_type="+pdc_type+"&&payee_id="+payee_id+
												  "&&sd="+start_date+"&&ed="+end_date, '_blank');
							}
							else {
								window.open("/pdfs/print_monetary_report?bank="+bank_id+"&&type=pettycash&&pdc_type="+pdc_type+"&&payee_id="+payee_id+
												  "&&sd="+start_date+"&&ed="+end_date, '_blank');
							}
						} 
				}
				else {
					$("#end_date").css({'border-color':'red'});
				}
			}
			else {
				$('#start_date').css({'border-color':'red'});
			}
		});
		 ///////////////////////////////////////////
		 //PRINT ITENERARY START
		 

        $("#print_itenerary").on("click", function () { 
                $('#print-itenerary-modal').modal('show'); 
        });

                $("#itenerary_type").change(function () {
                    var itenerary_type = $("#itenerary_type").val();
                    if(itenerary_type == 'per_driver'){
                        $('#itenerary_driver_div').show();
                    }else{
                        $('#itenerary_driver_div').hide();
                    }
                });
                
                
        $("#btn_print_itenerary").on("click", function () { 
            $( "#print_itenerary_error_added" ).remove();
            var end_date = $('#itenerary_end_date').val();
            var start_date = $('#itenerary_start_date').val();
            var itenerary_type = $("#itenerary_type").val();
            var itenerary_driver = $("#itenerary_driver").val();
            
            
            if (start_date==="" || end_date===""){
                $( "#print_itenerary_error" ).append('<div class="col-sm-12" id="print_itenerary_error_added"><p class="text-danger">Date Could not be empty</p></div>');
            } else if((new Date(start_date).getTime() > new Date(end_date).getTime())) { 
                // print_itenerary_error
                $( "#print_itenerary_error" ).append('<div class="col-sm-12"  id="print_itenerary_error_added"><p class="text-danger">Invalid Date Range</p></div>');
            }else{
                if(itenerary_type === 'per_driver'){
                    //check if huser has selected driver
                    if(itenerary_driver===""){
                        $( "#print_itenerary_error" ).append('<div class="col-sm-12"  id="print_itenerary_error_added"><p class="text-danger">Please Select Driver</p></div>');
                    }else{
                        window.open("/pdfs/print_delivery_itenerary?start_date="+start_date+"&&end_date="+end_date+"&&type="+itenerary_type+"&&driver_id="+itenerary_driver, '_blank');
                    }
                }else{
                        window.open("/pdfs/print_delivery_itenerary?start_date="+start_date+"&&end_date="+end_date+"&&type="+itenerary_type+"&&driver_id=0", '_blank');
                  
                }
            }
            // window.open("/pdfs/print_delivery_itenerary?start_date="+start_date+"&&end_date="+end_date, '_blank');
        });
		 //PRINT ITENERARY END
</script>
<!--END OF JAVASCRIPT FUNCTIONS-->