<!--MAE: 19/04/2018-->

<!--IMPORTS-->
<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<!--END IMPORTS-->

<!--RENDER DATA-->
<?php
    $Quotation_id = 0;
    $Client_id = 0;
    if(!empty($getJobRequest)) {
        // GLOBAL VARIABLES
            $userin = $UserIn['User']['id'];
            $role = $UserIn['User']['role'];
        // END OF GLOBAL VARIABLES
        
        $Client = $getJobRequest['Client'];
        $JobRequest = $getJobRequest['JobRequest'];
        $Quotation = $getJobRequest['Quotation'];
        $SalesAgent = $getJobRequest['User'];
        
        $unknown = "<font style='color:red;'>Unknown</font>";
        $not_specified = "<font style='color:red;'>Not Specified</font>";
        
        $Client_name = $unknown;
        if(!empty($Client)) {
            $Client_name = ucwords($Client['name']);
            $Client_id = $Client['id'];
        }
        
        $JobRequest_jr_number = $unknown;
        $JobRequest_status = $unknown;
        if(!empty($JobRequest)) {
            $JobRequest_jr_number = "<font style='font-weight:bold;'>".
                                        $JobRequest['jr_number'].
                                    "</font>";
            $JobRequest_status = ucwords($JobRequest['status']);
        }
        
        $Quotation_tentative_date = $unknown;
        if(!empty($Quotation)) {
            $Quotation_id = $Quotation['id'];
            $Quotation_tentative_date = date("F d, Y",
                                        strtotime($Quotation['target_delivery']));
        }
        
        $SalesAgent_name = $unknown;
        if(!empty($SalesAgent)) {
            $SalesAgent_name = ucwords($SalesAgent['first_name']." ".
                                       $SalesAgent['last_name']);
        }
    }
?>
<!--END OF DATA RENDERING-->

<!--START OF CONTAINER-->
<div id="content-container">
    <div id="page-content">
        <?php if(!empty($getJobRequest)): ?>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <h1 class="page-header text-overflow">Client Details</h1>
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <p>Client Name:</p>
                            <p>JR #:</p>
                            <p>Sales Agent:</p>
                            <p>Tentative Delivery Date:</p>
                        </div>
                        <div class="col-lg-10">
                            <p>
                                <?php echo $Client_name;
                                if($role=="proprietor" || $role=="accounting_head"): ?>
                                <a class="btn btn-xs btn-primary"
                                        id="btn_view_quotation"
                                        data-toggle="tooltip"
                                        data-placement="right"
                                        title="View Quotation"
                                        target="_blank"
                                        href="/quotations/view?id=<?php echo $Quotation_id; ?>">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <?php endif; ?>
                            </p>
                            <p><?php echo $JobRequest_jr_number; ?></p>
                            <p><?php echo $SalesAgent_name; ?></p>
                            <p><?php echo $Quotation_tentative_date; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php
        if($role=="sales_executive"):
            echo '
            <div class="col-lg-12" style="margin-bottom: 15px;">
                <div class="pull-right">
                    <a class="btn btn-warning"
                            target="_blank"
                            href="/quotations/update_quotation?id='.$Quotation_id.'">
                        <span class="fa fa-edit"></span>
                        Update Quotation
                    </a>
                    
                    <button class="btn btn-success"
                            id="btn_add_floor_plan"
                            data-type="fp">
                        <span class="fa fa-plus"></span>
                        Add Floor Plan
                    </button>
                </div>
            </div>';
        endif; ?>
        
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
    					<table class="table table-bordered table-striped"
    						   cell-spacing="0" width="100%"
    						   id="example">
    					    <thead>
    					        <tr>
    					            <th>Deadline Date <br/>
    					                [<?php echo $JobRequest_status; ?>]</th>
    					            <th>Product Code / Floor Plan</th>
    					            <th>Image</th>
    					            <th>Description</th>
    					            <th>Status</th>
    					            <th>Quantity</th>
    					            <th>Designers</th>
    					            <?php if($JobRequest_status=="accomplished"): ?>
    					            <th>Date PRS</th>
    					            <th>Date Received by Production</th>
    					            <?php endif; ?>
    					            <th width="120">Action</th>
    					        </tr>
    					    </thead>
    					    <tbody>
                                <?php
                                // TYPE JRP [ J O B  R E Q U E S T  P R O D U C T ];
                                // ================================================================================================>
                                foreach($getJRProduct as $retJRProduct) {
                                    // GET DATA NEEDED
                                    
                                    $JobRequestProduct = $retJRProduct['JobRequestProduct'];
                                    $Product = $retJRProduct['Product'];
                                    $QuotationProduct = $retJRProduct['QuotationProduct'];
                                    $JobRequestAssignment = $retJRProduct['JobRequestAssignment'];
                                    
                                    $JobRequest_client_id = $retJRProduct['JobRequest']['client_id'];
                                    $JobRequestProduct_id = $JobRequestProduct['id'];
                                    $QuotationProduct_id = $QuotationProduct['id'];
                                    $QuotationProduct_qty = $QuotationProduct['qty'];
                                    $JobRequestProduct_status = $JobRequestProduct['status'];
                                    $JobRequestProduct_date_deleted = $JobRequestProduct['date_deleted'];
                                    
                                    $PropVal = $not_specified;
                                    $propsvals = "";
                                    if(array_key_exists($QuotationProduct_id, $QuotationProductProperties)) {
                                        foreach($QuotationProductProperties[$QuotationProduct_id] as $props_and_vals) {
                                            $Prop = $props_and_vals['QuotationProductProperty']['property'];
                                            $Val = $props_and_vals['QuotationProductProperty']['value'];
                                            $propsvals .= "<li class='list-group-item'>
                                                               <font style='font-weight:bold;'>$Prop</font> : $Val
                                                           </li>";
                                        }
                                        
                                        $other_info = "<li class='list-group-item'>".
                                                        $QuotationProductProperties[$QuotationProduct_id][0]['QuotationProduct']['other_info'].
                                                      "</li>";
                                        
                                        $PropVal = "<ul class='list-group'>
                                                        $propsvals
                                                        $other_info
                                                    </ul>";
                                    }
                                    $JobRequestProduct_date_forwarded_production=null;
                                    if($JobRequestProduct['date_forwarded_production']!=null) {
                                        $JobRequestProduct_date_forwarded_production = $JobRequestProduct['date_forwarded_production'];
                                    }
                                    
                                    $JRProduct_production_received = $not_specified;
                                    if($JobRequestProduct['date_received_production']!="0000-00-00" &&
                                       $JobRequestProduct['date_received_production']!=null) {
                                        $JRProduct_production_received = $JobRequestProduct['date_received_production'];
                                    }
                                    
                                    $JRProduct_PRS = $not_specified;
                                    if($JobRequestProduct['date_prs']!="0000-00-00" &&
                                       $JobRequestProduct['date_prs']!=null) {
                                        $JRProduct_PRS = time_elapsed_string($JobRequestProduct['date_prs']);
                                    }
                                    
                                    $JRProduct_image = "image_placeholder.jpg";
                                    if($JobRequestProduct['image']!=null &&
                                       $JobRequestProduct['image']!="") {
                                        $JRProduct_image = $JobRequestProduct['image'];
                                    }
                                    
                                    $JRProduct_deadline_date = $not_specified;
                                    if($JobRequestProduct['deadline_date']!="0000-00-00") {
                                        $JRProduct_deadline_date = date("F d, Y", strtotime($JobRequestProduct['deadline_date']));
                                    }
                                   
                                    $Product_name = $unknown;
                                    if($Product['name']!="") {
                                        $Product_name = $Product['name'];
                                    }
                                   
                                    $QuotationProduct_qty = 0;
                                    if($QuotationProduct['qty']!=null) {
                                        $QuotationProduct_qty = intval($QuotationProduct['qty']);
                                    }
                                    
                                    $Designers_name = $not_specified;
                                    if(!empty($JobRequestAssignment)) {
                                        $Designers_name = "<ul class='list-group'>";
                                        foreach($JobRequestAssignment as $retJobRequestAssignment) {
                                            $assignment_id = $retJobRequestAssignment['id'];
                                            $Designers_name .= "<li class='list-group-item'>".
                                                                $Designers[$assignment_id]['User']['first_name'].
                                                                " ".
                                                                $Designers[$assignment_id]['User']['last_name']."</li>";
                                        }
                                        $Designers_name ."</ul>";
                                    }
                                    
                                    if($JobRequest_status=="accomplished"):
                                        $render_date_prs = '<td>'.$JRProduct_PRS.'</td>
                                                            <td>'.$JRProduct_production_received.'</td>';
                                    else: $render_date_prs = ''; endif;
                                    
                                    if($JobRequestProduct_date_deleted!=null) {
                                        $action = '<font class="text-danger" style="font-weight:bold;">
                                                    Date Deleted: '.time_elapsed_string($JobRequestProduct_date_deleted).
                                                  '</font>';
                                    }
                                    else {
                                        $action = '
                                            <a class="btn btn-primary"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="View Revisions"
                                                    href="/job_request_revisions/view_list?id='.$JobRequestProduct_id.'&&type=jrp">
                                                <span class="fa fa-eye"></span>
                                            </a> ';
                                        if($role=="design_head" ||
                                          $role=="designer"):
                                            if($JobRequestProduct_status=="accomplished") :
                                                if($JobRequestProduct_date_forwarded_production==null):
                                                    $action .=
                                                        '<button class="btn btn-warning"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Forward to Production"
                                                                id="btn_forward_to_production"
                                                                data-jrpid="'.$JobRequestProduct_id.'"
                                                                data-qpid="'.$QuotationProduct_id.'"
                                                                data-qty="'.$QuotationProduct_qty.'"
                                                                data-cid="'.$JobRequest_client_id.'">
                                                            <span class="fa fa-forward"></span>
                                                        </button> ';
                                                endif;
                                            endif;
                                        endif;
                                        if($role=="design_head" ||
                                           $role=="material_expediter"):
                                        $action .= '<a class="btn btn-mint"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Identify Raw Materials"
                                                    id="btn_identify_raw_mats"
                                                    href="/purchase_orders/design_raw_mats?id='.$JobRequestProduct_id.'&&type=jrp">
                                                <span class="fa fa-paperclip">
                                            </a> ';
                                        endif;
                                        if($role=="sales_executive"):
                                        $action .= '<button class="btn btn-success"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Add Type / Revision"
                                                    id="btn_add_type_revision"
                                                    data-id="'.$JobRequestProduct['id'].'"
                                                    data-productid="'.$JobRequestProduct['product_id'].'"
                                                    data-qpid="'.$QuotationProduct_id.'"
                                                    data-type="jrp"
                                                    data-fpid="0">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                            ';
                                        endif;
                                    }
                                    
                                    echo "
                                    <tr>
                                        <td data-order='".$JobRequestProduct['deadline_date']."'>$JRProduct_deadline_date</td>
                                        <td>$Product_name</td>
                                        <td align='center'>
                                            <img class='img-responsive' width='140' src='/img/product-uploads/$JRProduct_image'>
                                        </td>
                                        <td>$PropVal</td>
                                        <td>$JobRequestProduct_status</td>
                                        <td>$QuotationProduct_qty</td>
                                        <td>$Designers_name</td>
                                        $render_date_prs
                                        <td>$action</td>
                                    </tr>
                                    ";
                                }
                                // END OF JRP [ J O B  R E Q U E S T  P R O D U C T ]
                                // ================================================================================================>
                                
                                // TYPE OF FP [ F L O O R  P L A N ]
                                // ================================================================================================>
                                foreach($getJobRequestFloorplan as $retJobRequestFloorplan) {
                                    
                                    $Floorplan = $retJobRequestFloorplan['JobRequestFloorplan'];
                                    $FPAssignment = $retJRProduct['JobRequestAssignment'];
                                    $Floorplan_status = $Floorplan['status'];
                                    $FP_deadline_date = $not_specified;
                                    if($Floorplan['deadline_date']!="" &&
                                       $Floorplan['deadline_date']!=null &&
                                       $Floorplan['deadline_date']!="0000-00-00") {
                                        $FP_deadline_date = date("F d, Y", strtotime($Floorplan['deadline_date']));       
                                    }
                                    
                                    $FP_description = "";
                                    if($Floorplan['description']!="" &&
                                       $Floorplan['description']!=null) {
                                        $FP_description = $Floorplan['description'];       
                                    }
                                    
                                    $FP_image = "image_placeholder.jpg";
                                    if($Floorplan['image']!="" ||
                                       $Floorplan['image']!=null) {
                                        $FP_image = $Floorplan['image'];       
                                    }
                                    
                                    $FP_production_received = $unknown;
                                    if($Floorplan['date_received_production']!="0000-00-00" &&
                                       $Floorplan['date_received_production']!=null) {
                                        $FP_production_received = date("F d, Y", strtotime($Floorplan['date_received_production']));
                                    }
                                    
                                    $FP_date_prs = $not_specified;
                                    if($Floorplan['date_prs']!="" &&
                                       $Floorplan['date_prs']!=null &&
                                       $Floorplan['date_prs']!="0000-00-00") {
                                        $FP_date_prs = time_elapsed_string($Floorplan['date_prs']);
                                    }
                                    
                                    if($JobRequest_status=="accomplished"):
                                        $FP_render_date_prs = '<td>'.$FP_date_prs.'</td>
                                                            <td>'.$FP_production_received.'</td>';
                                    else: $FP_render_date_prs = ''; endif;
                                    
                                    $FP_Designers_name = $not_specified;
                                    
                                    if(!empty($FP_Designers)) {
                                        if(array_key_exists($Floorplan['id'], $FP_Designers)) {
                                            $FP_Designers_name = "<ul class='list-group'>";
                                            foreach($FP_Designers[$Floorplan['id']] as $Designers) {
                                                $FP_Designers_name .= "<li class='list-group-item'>".
                                                                       $Designers['first_name']." ".$Designers['last_name'].
                                                                      "</li>";
                                            }
                                            $FP_Designers_name .= "</ul>";
                                        }
                                    }
                                    
                                    $FP_action = '
                                            <a class="btn btn-primary"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="View Revisions"
                                                    href="/job_request_revisions/view_list?id='.$Floorplan['id'].'&&type=fp">
                                                <span class="fa fa-eye"></span>
                                            </a> ';
                                        if($role=="design_head" ||
                                           $role=="material_expediter"):
                                        $FP_action .= '<a class="btn btn-mint"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Identify Raw Materials"
                                                    id="FP_btn_identify_raw_mats"
                                                    href="/purchase_orders/design_raw_mats?id='.$Floorplan['id'].'&&type=fp">
                                                <span class="fa fa-paperclip">
                                            </a> ';
                                        endif;
                                        if($role=="sales_executive"):
                                        $FP_action .= '<button class="btn btn-success"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Add Type / Revision"
                                                    id="FP_btn_add_type_revision"
                                                    data-type="jrp"
                                                    data-id="0"
                                                    data-productid="0"
                                                    data-qpid="0"
                                                    data-fpid="'.$Floorplan['id'].'">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                            ';
                                        endif;

                                    echo "
                                    <tr>
                                        <td data-order='".$Floorplan['deadline_date']."'>$FP_deadline_date</td>
                                        <td>Floor Plan</td>
                                        <td align='center'><img class='img-responsive' width='140' src='/img/product-uploads/$FP_image'></td>
                                        <td>$FP_description</td>
                                        <td>$Floorplan_status</td>
                                        <td>-</td>
                                        $FP_render_date_prs
                                        <td>$FP_Designers_name</td>
                                        <td>$FP_action</td>
                                    </tr>
                                    ";
                                }
                                // ================================================================================================>
                                // END OF FP [ F L O O R  P L A N ]
                                ?>
    					    </tbody>
    					</table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        else:
            echo "No Job Request Found.";
        endif; ?>
        <!--END OF JOB REQUEST EMPTY VALIDATION-->
    </div>
</div>
<!--END OF CONTAINER-->

<!--START OF MODALS HERE-->
<!--Add type / revision modal-->
	<!--===================================================-->
    <div class="modal fade" id="add-type-revision-modal" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
			<div class="modal-content">
				<!--Modal header-->
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">
				    <i class="pci-cross pci-circle"></i>
				  </button>
				  <h4 class="modal-title" id="title">
			          Add Type / Revision
		          </h4>
				</div>
				
				<!--Modal body-->
				<div class="modal-body">
				    <div class="row">
				        <div class="col-lg-12">
				            <div class="form-group">
    				            <label>Select Type <span class="text-danger">*</span></label>
    				            <select id="select_type"
    				                    class="form-control">
    				                <option></option>
    				                <?php
    				                foreach($JobRequestTypes as $JobRequestType) {
    				                    $id = $JobRequestType['JobRequestType']['id'];
    				                    $name = ucwords($JobRequestType['JobRequestType']['name']);
    				                    
    				                    echo "
    				                    <option value='".$id."'>$name</option>
    				                    ";
    				                }
    				                ?>
    				            </select>
				            </div>
				            
				            <div class="form-group">
				                <label>Deadline Date <span class="text-danger">*</span></label>
				                <input type="date" class="form-control"
				                       id="input_deadline_date"/>
				            </div>
				            
				            <div class="form-group">
				                <label>Remarks <span class="text-danger">*</span></label>
				                <textarea id="remarks"></textarea>
				            </div>
				        </div>
				    </div>
				</div>
				
				<!--Modal footer-->
				<div class="modal-footer">
				  <button data-dismiss="modal" class="btn btn-default"
				    type="button">Close</button>
				  <button class="btn btn-primary" id="send_add_type_revision">Add</button>
				</div>
			</div>
    	</div>
	</div>
<!--===================================================-->
<!--End of add new type / revision modal -->
<!--END OF MODALS HERE-->

<!--JAVASCRIPT FUNCTIONS-->
<script type="text/javascript">
    $(document).ready(function() {
        $("[data-toggle=tooltip]").tooltip();
        
        $('#example').DataTable({
            "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
            "orderable": true,
            "order": [[0,"desc"]],
            "stateSave": true
        });
        
        $("#select_type").select2({
            placeholder: "Type",
            allowClear: true,
            width: '100%'
        });
        
        tinymce.init({
            selector: 'textarea',
            height: 70,
            menubar: false,
            plugins: [
                'autolink',
                'link',
                'codesample',
                'lists',
                'searchreplace visualblocks',
                'table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link',
        });
        
        var jrp_id = 0;
        var product_id = 0;
        var job_request_floor_plan_id = 0;
        var quotation_product_id = 0;
        var type="jrp";
        $("button#btn_add_type_revision, button#FP_btn_add_type_revision, #btn_add_floor_plan").on('click',
        function() {
            jrp_id = $(this).data('id');
            product_id = $(this).data('productid');
            job_request_floor_plan_id = $(this).data('fpid');
            quotation_product_id = $(this).data('qpid');
            type = $(this).data('type');
            if(type=="fp") { $("#title").text("Add Floor Plan"); }
            else { $("#title").text("Add Type / Revision"); }
            $("#send_add_type_revision").removeAttr('disabled');
            $("#add-type-revision-modal").modal('show');
        });
        
        $("#send_add_type_revision").on('click', function() {
            $(this).prop('disabled', true);
            var select_type = $("#select_type");
            var input_deadline_date = $("#input_deadline_date");
            var remarks = tinymce.get('remarks').getContent();
            
            if(select_type.val()!="") {
                if(input_deadline_date.val()!="") {
                    if(remarks!="") {
                        if(type=="jrp") {
                            var url = "/job_request_products/add_type_revision";
                            var type_added = "type / revision";
                            var data = {
                                "job_request_id":parseInt("<?php echo $this->params['url']['id']; ?>"),
                                "job_request_type_id":select_type.val(),
                                "deadline_date": input_deadline_date.val(),
                                "job_request_product_id": jrp_id,
                                "product_id": product_id,
                                "job_request_floor_plan_id": job_request_floor_plan_id,
                                "quotation_product_id": quotation_product_id,
                                "remarks": remarks
                               };
                              
                        }
                        else {
                            var url = "/job_request_floorplans/add";
                            var type_added = "floor plan";
                            var data = {
                                "quotation_id":parseInt("<?php echo $Quotation_id; ?>"),
                                "client_id":parseInt("<?php echo $Client_id; ?>"),
                                "job_request_id":parseInt("<?php echo $this->params['url']['id']; ?>"),
                                "deadline_date":input_deadline_date.val(),
                                "job_request_type_id":select_type.val(),
                                "status":'new',
                                "description":remarks
                            }
                        }
                        
                        var today = new Date();
                        today.setDate(today.getDate() -1);
                        var input_deadline_date_tmp = new Date(input_deadline_date.val());
                        
                        if(today.getTime() <= input_deadline_date_tmp.getTime()) {
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: {"data": data},
                                dataType: "text",
                                success: function(success) {
                                    console.log(success);
                                   
                                   swal({
                                       title: "Success!",
                                       text: "Successfully added "+type_added+".",
                                       type: "success"
                                   },
                                   function (isConfirm) {
                                       if(isConfirm) {
                                          location.reload();
                                       }
                                   });
                                },
                                error: function(error) {
                                    console.log(error);
                                    $("#send_add_type_revision").removeAttr('disabled');
                                    swal({
                                        title: "Oops!",
                                        text: "An error occured. Please try again later",
                                        type: "warning"
                                    });
                                }
                            });
                        }
                        else {
                            $("#send_add_type_revision").removeAttr('disabled');
                            swal({
                                title: "Oops!",
                                text: "Deadline date is invalid."+
                                      "\nPlease select date from today and onwards, and try again.",
                                type: "warning"
                            });
                        }
                    }
                    else {
                        $("#send_add_type_revision").removeAttr('disabled'); 
                        swal({
                            title: "Oops!",
                            text: "Add remarks and try again.",
                            type: "warning"
                        });
                    }
                }
                else {
                    $("#send_add_type_revision").removeAttr('disabled'); 
                    swal({
                        title: "Oops!",
                        text: "Select deadline date and try again.",
                        type: "warning"
                    });
                    input_deadline_date.css({'border-color':'red'});
                }
            }
            else {
                $("#send_add_type_revision").removeAttr('disabled');
                swal({
                    title: "Oops!",
                    text: "Select type and try again.",
                    type: "warning"
                });
                select_type.css({'border-color':'red'});
            }
        });
        
        
        // FORWARD TO PRODUCTION
        $("button#btn_forward_to_production").on('click', function() {
            var id = $(this).data('id');
            var jrpid = $(this).data('jrpid');
            var qpid = $(this).data('qpid');
            var qty = $(this).data('qty');
            var cid = $(this).data('cid');
            var jrid = parseInt("<?php echo $this->params['url']['id']; ?>");
            
            swal({
                title: "Are you sure?",
                text: "This will be forwarded to production.",
                type: "warning",
                showCancelButton: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if(isConfirm) {
                    var data={"quotation_product_id":qpid,
                              "job_request_product_id":jrpid,
                              "client_id":cid,
                              "qty":qty,
                              "job_request_id": jrid};
                    $.ajax({
                        url: "/job_requests/add_productions",
                        type: "POST",
                        data: {"data": data},
                        dataType: "text",
                        success: function(success) {
                            console.log(success);
                            swal({
                                title: "Success!",
                                text: "Successfully forwarded to production.",
                                type: "success"
                            },
                            function(isConfirm1) {
                                if(isConfirm1) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(error) {
                            console.log(error);
                            swal({
                                title: "Oops!",
                                text: "An error occurred. Please try again later.",
                                type: "error"
                            });
                        }
                    });
                }
            })
        });
    });
</script>
<!--END OF JAVASCRIPT-->