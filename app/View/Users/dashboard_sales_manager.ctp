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

<!--Morris.js [ OPTIONAL ]-->
<link href="/css/plug/morris-js/morris.min.css" rel="stylesheet">


<!--Morris.js [ OPTIONAL ]-->
<script src="/css/plug/morris-js/morris.min.js"></script>
<script src="/css/plug/morris-js/raphael-js/raphael.min.js"></script>

<!--Sparkline [ OPTIONAL ]-->
<script src="/css/plug/sparkline/jquery.sparkline.min.js"></script> 


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
		                <div class="panel-control">
<!--					                    <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn"><i class="demo-pli-repeat-2 icon-lg"></i></button>
		                    <div class="btn-group">
		                        <button class="dropdown-toggle btn" data-toggle="dropdown" aria-expanded="false"><i class="demo-pli-gear icon-lg"></i></button>
		                        <ul class="dropdown-menu dropdown-menu-right">
		                            <li><a href="#">Action</a></li>
		                            <li><a href="#">Another action</a></li>
		                            <li><a href="#">Something else here</a></li>
		                            <li class="divider"></li>
		                            <li><a href="#">Separated link</a></li>
		                        </ul>
		                    </div>-->
		                </div>
		                <h3 class="panel-title">Quotation</h3>
		            </div>
					
					<div class="panel-body">
						<div class="row">
				            <!--Morris line chart placeholder-->
				            <div id="morris-chart-network" class="morris-full-content"></div>
				        </div>
		            </div>
	
		        </div>
		        <!--===================================================-->
		        <!--End network line chart-->
		
		    </div>
		    <div class="col-lg-5">
		        <div class="row">
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline Area Chart-->
		                <div class="panel panel-success panel-colorful">
		                    <div class="pad-all">
		                    	<?php
		                    		$team_name = "Unknown";
		                    		$team_id = 0;
		                    		$daily_gt = 0.00;
		                    		$mo_to = 0.00;
		                    		$yr_to = 0.00;
		                    		if(!empty($getteam['Team'])) {
	        							$team_name = ucwords($getteam['Team']['name']);
	        							$team_id = $getteam['Team']['id'];
	        							if(!empty($monthly['grand_total_team'])) {
		        							$mo_to = $monthly['grand_total_team'];
	        							}
	        							if(!empty($yearly['grand_total_team'])) {
		        							$yr_to = $yearly['grand_total_team'];
	        							}
		                    		}
		                    		
		                    		if(!empty($daily['grand_total_team'])) {
		                    			$daily_gt = number_format($daily['grand_total_team'], 2);
		                    		}
		                    	?>
		                        <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> Team <?php echo $team_name; ?> Sales</p>
		                        <p class="mar-no">
		                        	<a href="/pdfs/print_sales?range=t&&team_id=<?php echo $team_id; ?>"
		                        	   target="_blank"
		                        	   style="color:white">
				                        Today:
										&#8369; <?php echo $daily_gt; ?>
									</a>
		                        </p>
		                        <p class="mar-no"><a href="/pdfs/print_sales?range=m&&team_id=<?php echo $team_id; ?>" target="_blank" style="color:white">  <?php echo 'For the month of '.$month.': &#8369; '.number_format($mo_to,2); ?> </a></p>
		                    </div>
		                    <div class="pad-all text-center">
		                        <!--Placeholder-->
		                        <div id="demo-sparkline-area"></div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline Line Chart-->
		                <div class="panel panel-info panel-colorful">
		                    <div class="pad-all">
		                    	
		                        <p class="text-lg text-semibold"><i class="demo-pli-wallet-2 icon-fw"></i> Earning</p>
		                        <a href="/pdfs/print_sales?range=y&&team_id=<?php echo $team_id; ?>" target="_blank" style="color:white">
		                        <?php
		                        if(!empty($yearly['grand_total_team'])) {
		                        	$yr2 = number_format($yearly['grand_total_team'], 2);
		                        }
		                        else { $yr2 = "0.00"; }
		                        ?>
		                   		<span class="text-2x text-semibold">&#8369; <?php echo $yr2; ?></span>
		                        <p class="mar-no">
		                         	For the year <?php echo $year;?>
		                        </p>
		                        </a>
		                        <p>	</p>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline bar chart -->
		                <div class="panel panel-purple panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold"><i class="demo-pli-bag-coins icon-fw"></i> Team Sales [<?php echo date("F"); ?>]</p>
		                    </div>
		                    <div class="pad-all text-center">
		                        <!--Placeholder-->
 								<?php
 									$teamname = ucwords($team_name);
 									$teamid = $team_id;
 								?>
		                        <a id="team_clicked1" data-id="<?php echo $teamid; ?>"
			                               data-name="<?php echo ucwords($teamname); ?>">
									<button class="btn btn-default btn-sm">Monthly</button>
								</a>
								
			                    	<a class="btn btn-default btn-sm" href="/pdfs/accounting_print_quote?type=collection_status" target="_blank">For Collection</a>
								
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-6 col-lg-6">
		
		                <!--Sparkline pie chart -->
		                <div class="panel panel-warning panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold"><i class="demo-pli-check icon-fw"></i> Quotation</p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $approved_counts; ?></span>
		                            Approved
		                        </p>
		                        <p class="mar-no">
		                            <span class="pull-right text-bold"><?php echo $pending_counts; ?></span>
		                            Pending
		                        </p>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		
	 
		
	<!--AGENT STATUS-------------------------------------->
	 <?php
		$mo_now = date("F");
		$yr_now = date("Y");
		
		if($userRole == "sales_manager") {
			if(!empty($get_users)) {
 	 ?>
	 <div class="col-lg-12" style="margin-bottom:30px;">
	 	<h1 id="page-header text-overflow" align="center">
 			Agents' Status (<?php echo $mo_now.", ".$yr_now; ?>)
 		</h1>
 		
        <div class="row" id="sort_divs">
 			<?php
 			foreach($get_users as $ret_user) {
 				$user = $ret_user['User'];
 				$user_id = $user['id'];
 				$first_name_tmp = $user['first_name'];
 				$last_name = $user['last_name'];
 				$sales_name_tmp = $first_name_tmp;
 				
 				if($sales_name_tmp != "") {
 					$sales_name = $sales_name_tmp;
 				}
 				else {
 					$sales_name = "<font style='color:red'>Unknown</font>";
 				}
 				
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
 				$team_name = "";
 				if(!empty($getteam['Team'])) {
	 				$team_id = $getteam['Team']['id'];
	 				$team_name = ucwords(strtolower($getteam['Team']['name']));
 				}
 				
 				foreach($get_agent_status[$user_id] as $ret_agent_status) {
 					$agent_status = $ret_agent_status['AgentStatus'];
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
						   style="font-size:12px;margin-left:-1em">
							<?php echo $first_name." [".$team_name."]"; ?>
						</a>
					</div>
	
					<div class="panel-body"> 
 						<input id="tot_amount_id" value="<?php echo $tot_contract_amount_tmp; ?>" hidden />
						<p> &#8369 <?php echo $tot_contract_amount; ?> </p>
						<p>[<small>Quota &#8369 <?php echo number_format((float)$agent_status_quota,2,'.',','); ?> </small>]</p>  <!--this is the latest amount of quota of ronalyn-->
						
						<p><small><i class="fa fa-circle" style="color:#009933"></i> Approved: </small> <?php echo $approved_count; ?></p>
						<p><small><i class="fa fa-circle" style="color:#3399ff"></i> Pending: </small> <?php echo $pending_count; ?></p>
						
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
							<a href="/pdfs/print_sales?range=y&&salesagent=<?php echo $user_id; ?>"
 							   class="btn btn-default btn-xs"
 							   target="_blank">
 								Yearly
 							</a>
 							<button id="monthly_btn"
 								target="_blank"
 								class="btn btn-default btn-xs"
 								data-id="<?php echo $user_id; ?>"
 								data-name="<?php
 									if($sales_name != "<font style='color:red'>Unknown</font>") {
 										echo $sales_name;
 									}
 									else {
 										echo 'Unknown';
 									}
 								?>">Monthly</button>
 								
 								
						</div>
					</div>
 				</div>
 			</div>
 			</div>
 			<?php }
 			} ?>
 		</div>
	 </div>
	 <?php } ?>
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
				<div class="row">
					<div class="form-group">
						<p style="font-size:25px;" align="center">
							For <font id="sales_name"></font>
						</p>
					</div>
					
					<div class="col-lg-6 form-group">
						<label>From <span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="start_date" />
					</div>
					
					<div class="col-lg-6 form-group">
						<label>To <span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="end_date" />
					</div>
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

<!--JAVASCIPT FUNCTIONS-->
<script>
$(document).ready(function() { 
	$('div.box').sort(function(a, b) {
		if (parseInt($(a).find("#tot_amount_id").val()) > parseInt($(b).find("#tot_amount_id").val()))
			{ return -1; }
		else { return 1; }
	}).appendTo('#sort_divs');
});

	$(document).ready(function() {
		var salesagent = 0;
		var type = "sales";
		var team = 0;
		$("button#monthly_btn, a#team_clicked").on('click', function() {
			salesagent = $(this).data('id');
			var sales_name = $(this).data('name');
			$("#sales_name").text(sales_name);
			$('#date-range-modal').modal('show');
		});
		
		$("a#team_clicked1").on('click', function() {
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
	});
</script>
<!--END OF JAVASCRIPT FUNCTIONS-->