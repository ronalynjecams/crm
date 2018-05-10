<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<div id="content-container">
    <div id="page-content">
        <h1 class="page-header text-overflow">Welcome Accounting!</h1>
        
        
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
			                       <small>  Daily Schedule</small> 
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
		            </div>
    </div>
</div>
</div>



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
					For Team <font id="team_name"></font>
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

<!--JAVASCIPT FUNCTIONS-->
<script>
$(document).ready(function() {  
	$('#cheque_div').hide();
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
		var team_id = 0;
		$("button#monthly_btn, a#team_clicked").on('click', function() {
			team_id = $(this).data('id');
			var team_name = $(this).data('name');
			$("#team_name").text(team_name);
			$('#date-range-modal').modal('show');
		});
		
		$("#btn_date_range").on('click', function() {
			var start_date = $("#start_date").val();
			var end_date = $("#end_date").val();
			
			if(start_date!="") {
				if(end_date!="") {
					$('#date-range-modal').modal('hide');
					window.open("/pdfs/print_sales?range=m&&team_id="+team_id+
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
		
		
		 
		$(".monitary_requisition_btn ").on('click', function() {
			 
			$('#monitary_title_added').remove();
			$('#monetary_body').remove();
			$('.payee_div').hide();
			$('.bank_div').hide();
			var monitary_type = $(this).data('monitarytype'); 
			$("#selected_type").val(monitary_type);
			// selected_type
			$( "<div id='monitary_title_added'>Select Date Range for "+monitary_type+" Requests</div>" ).appendTo( "#monitary_title" );
			// $( "<div id='monitary_body_added'><select><option></option></select>" ).appendTo( "#monetary_body" );
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
		 
</script>
<!--END OF JAVASCRIPT FUNCTIONS-->