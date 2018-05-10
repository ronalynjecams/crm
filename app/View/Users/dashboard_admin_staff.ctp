 
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/erp_scripts.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Admin</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <!--<div class="panel">-->
        <!--    <div class="panel-heading" align="right">-->
        <!--        <h3 class="panel-title">-->

                    <?php if ($UserIn['User']['role'] == 'admin_staff') { ?>
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
                        
                    <?php } ?>
            <!--    </h3>-->
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            <!--</div>-->
            <!--<div class="panel-body">-->
               
            <!--</div>-->
        </div>
    </div>
</div> 






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

<script>
$(document).ready(function() {  
	$('#cheque_div').hide();
	$('#itenerary_driver_div').hide();
}); ///////////////////////////////////////////
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