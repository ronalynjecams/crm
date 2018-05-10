
    <!--Morris.js [ OPTIONAL ]-->
    <link href="/css/plug/morris-js/morris.min.css" rel="stylesheet">


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
		
		            <!--Morris line chart placeholder-->
		            <div class="panel-body">
		            	<div class="row">
			            	<div id="morris-chart-network" class="row morris-full-content"></div>
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
		                        <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> My Sales</p>
		                        <p class="mar-no">
		                        	<a href="/pdfs/print_sales?range=t&&salesagent=<?php echo $user_id; ?>" target="_blank" style="color:white">
				                        Today:
										&#8369; <?php echo number_format($daily, 2); ?>
									</a>
		                        </p>
		                        <p class="mar-no"><a href="/pdfs/print_sales?range=m&&salesagent=<?php echo $user_id; ?>" target="_blank" style="color:white">  <?php echo 'For the month of '.$month.': &#8369; '.number_format($monthly,2); ?> </a></p>
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
		                        <a href="/pdfs/print_sales?range=y&&salesagent=<?php echo $user_id; ?>" target="_blank" style="color:white">
		                   		<span class="text-2x text-semibold">&#8369; <?php echo number_format($yearly, 2);?></span>
		                        <p class="mar-no">
		                         	For the year <?php echo $year;?>
		                        </p>
		                        </a>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-sm-6 col-lg-6">
		                <!--Sparkline bar chart -->
		                <div class="panel panel-purple panel-colorful">
		                    <div class="pad-all">
		                        <p class="text-lg text-semibold"><i class="demo-pli-bag-coins icon-fw"></i> Sales Reports </p>
		                        
		                   		<div align="center">
			                    	<a id="team_clicked" data-id="<?php echo $team_id; ?>"
				                               data-name="<?php echo ucwords($team_name); ?>"class="btn btn-default btn-sm">
										 Monthly
									</a>
			                    	<a class="btn btn-default btn-sm" href="/pdfs/accounting_print_quote?type=collection_status" target="_blank">For Collection</a>
								</div>
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



<!--JAVASCRIPT FUNCTIONS-->
<script type="text/javascript">
	$("a#team_clicked").on('click', function() {
		$('#date-range-modal').modal('show');
	});
	
	$("#btn_date_range").on('click', function() {
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
		var sales_agent = "<?php echo $user_id; ?>";
		
		if(start_date!="") {
			if(end_date!="") {
				$('#date-range-modal').modal('hide');
				window.open("/pdfs/print_sales?range=m&&salesagent="+sales_agent+
								  "&&sd="+start_date+"&&ed="+end_date, '_blank');
			}
			else {
				$("#end_date").css({'border-color':'red'});
			}
		}
		else {
			$('#start_date').css({'border-color':'red'});
		}
	});
</script>
<!--END OF JAVASCRIPT FUNCTIONS-->