<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<!--Morris.js [ OPTIONAL ]-->
<link href="/css/plug/morris-js/morris.min.css" rel="stylesheet" />

<!--Morris.js [ OPTIONAL ]-->
<script src="/css/plug/morris-js/morris.min.js"></script>
<script src="/css/plug/morris-js/raphael-js/raphael.min.js"></script>




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
		                            <span class="pull-right text-bold"><?php //echo $this->requestAction('App/edited_quote_count_left_side/moved');
		                            echo $this->requestAction('App/edited_quote_count_left_side/moved'); ?></span>
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
	                        	<span class="text-2x text-semibold">
	                        		<a href="/pdfs/print_sales?range=m" target="_blank" style="color:white">
	                        			&#8369; <font id="monthly">0.00</font>
	                        		</a>
	                        	</span>
		                          
		                        <p class="mar-no">
		                        	<a href="/pdfs/print_sales?range=t" target="_blank" style="color:white">
				                        Today:
										&#8369; <font id="today">0.00</font>
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
		                        <div id="team_monthly"></div>
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
		                   		<span class="text-2x text-semibold">&#8369; <font id="yearly">0.00</font></span>
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