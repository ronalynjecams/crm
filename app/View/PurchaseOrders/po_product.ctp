
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="/css/sweetalert.css" rel="stylesheet">
<!--<link href="/css/plug/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
<script src="/js/sweetalert.min.js"></script>  


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo ucwords($po['Supplier']['name']); ?></h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <?php
        if ($po['PurchaseOrder']['status'] == 'ongoing') {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <button class="btn btn-primary saveOngoingPO "  data-savestatus="pending">Save</button> 
                    </h3>
                </div>
            </div>
        <?php } else if ($po['PurchaseOrder']['status'] == 'pending') { 
              
            } 
            
                if($po['PurchaseOrder']['payment_request'] == 0){
                    echo '<p class="text-danger">No Payment Request</p>';
                }else{
                    echo '<p class="text-primary">Payment Requested: &#8369; '.number_format($po['PurchaseOrder']['payment_request'],2).'</p>';
                }
                echo '<p>schedule delivery per product</p>';
            
            ?>
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">
                    <input type="hidden" id="po_idd" value="<?php echo $this->params['url']['id']; ?>">

                    <!--                    <button class="btn btn-mint" id="addSupplierBtn" >
                                            <i class="fa fa-plus"></i>  Add New Purchase Order
                                        </button> -->
                </h3> 
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Date Created</th> 
                            <th>Image</th>
                            <th>Client</th>
                            <th>Product Code</th>
                            <th>Quantity</th> 
                            <th>Price</th>  
                            <th>Total</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        $ctrr = 1;
                        $total_purchased = 0; 
                        foreach ($po['PurchaseOrderProduct'] as $po_products) {
                            $po_products_client_id = $po_products['client_id'];
                            ?>
                            <tr>
                                <td> 
                                    <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') { ?>
                                        <button class=" btn btn-mint  btn-icon  add-tooltip delivery_sched" data-toggle="tooltip"  data-original-title="Schedule Delivery"  data-dspquoteid="<?php echo $po_products['id']; ?>" data-dspquoteqty="<?php echo $po_products['qty']; ?>"><i class="fa fa-calendar"></i></button></td>
                                    <?php }
                                    else {
                                        $id = $po_products['id'];
                                        
                                        if($po['PurchaseOrder']['payment_request']==0) {
                                            $po_id = $po['PurchaseOrder']['id']; ?>
                                            
                                            <button class="btn btn-danger"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Delete"
                                                    id="btn_delete"
                                                    value="<?php echo $id; ?>"
                                                    data-poid = "<?php echo $po_id; ?>">
                                                <span class="fa fa-trash-o"></span>
                                            </button>
                                            <?php
                                        }
                                    }
                                    ?>
                                <td>
                                   
                                    <?php
                                    echo time_elapsed_string($po_products['created']);
                                    echo '<br/><small>' . date('h:i a', strtotime($po_products['created'])) . '</small>';
                                    ?> 
                                </td>

                                <td>
                                    <?php if(!is_null($po_products['ProductCombo']['Product']['image'])){ ?>
                                    <img class="img-responsive" height="70" width="70" src="/img/product-uploads/<?php echo $po_products['ProductCombo']['Product']['image']; ?>" alt="Product Picture">
                                    <?php
                                    }else{ 
                                        echo 'no image';
                                    }?>
                                </td> 
                                
                                <td><?php 
                                        if($po_products['Client']) {
                                            echo $po_products['Client']['name'];
                                        }
                                ?></td>
                                <td><?php
                                    echo $po_products['ProductCombo']['Product']['name'];
                                    if ($type == 'supply') {
                                        if ($po_products['additional'] == 0) {
                                            if ($po_products['PurchaseOrder']['status'] == 'ongoing') {
                                                ?>
                                                <button class="btn btn-sm btn-mint additional_po_product add-tooltip"
                                                        data-toggle="tooltip"
                                                        data-original-title="Purchase Additional Product"
                                                        data-refnum="<?php echo $po_products['reference_num']; ?>"
                                                        data-reftype="<?php echo $po_products['reference_type']; ?>"
                                                        data-clientid="<?php echo $po_products_client_id; ?>">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php 
                                if(!($po_products['reference_num'] == 0 && ($po_products['PurchaseOrder']['status'] == 'ongoing' || $po_products['PurchaseOrder']['status'] == 'pending') && (int)$po['PurchaseOrder']['payment_request']==0)){
                                    echo abs($po_products['qty']);
                                } else{ ?>
                                <input type="text" value="<?php echo abs($po_products['qty']); ?>" class="form-control qty" data-price="<?php echo abs($po_products['list_price']); ?>" data-tid="id_<?php echo $ctrr; ?>" data-poprodid="<?php echo $po_products['id']; ?>"/>
                                <?php } ?>
                                </td> 
                                <td><input type="number" step="any" value="<?php echo abs($po_products['list_price']); ?>" class="form-control price" data-qqty="<?php echo abs($po_products['qty']); ?>" data-tid="id_<?php echo $ctrr; ?>" data-poprodid="<?php echo $po_products['id']; ?>" <?php if (!($po_products['reference_num'] == 0 && ($po_products['PurchaseOrder']['status'] == 'ongoing' || $po_products['PurchaseOrder']['status'] == 'pending') && (int)$po['PurchaseOrder']['payment_request']==0)) echo 'readonly' ?>></td> 
                                <?php
                                $total = $po_products['qty'] * $po_products['list_price'];
                                ?>
                                <td><input type="number" step="any" class="form-control total_price" readonly value="<?php echo abs($total); ?>"></td> 
                            </tr>
                            <?php
                            $total_purchased = $total_purchased + $total;
                            $ctrr++;
                        }
                        ?>

                        <tr >
                            <td colspan="6" align="right"><input id="nodiscount" type="checkbox" <?php if ($po['PurchaseOrder']['discount'] == 0) echo 'checked'; ?> <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'disabled' ?>>Without Discount</td>  
                            <td align="right"><div class="discountDiv"><b>Discount:</b></div></td>  
                            <td>
                                <input type="hidden" step="any"  class="form-control" id="discount_val" value="<?php echo abs($po['PurchaseOrder']['discount']); ?>"/>
                                <div class="discountDiv"><input type="number" step="any"  class="form-control" id="discount" value="<?php echo abs($po['PurchaseOrder']['discount']); ?>" <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'readonly' ?>/></div></td>  

                        </tr> 
                        <tr>
                            <td colspan="7" align="right"><b>Total Purchased</b></td>  
                            <td><input type="hidden" id="total_purchased_val" class="form-control" readonly value="<?php echo abs($total_purchased); ?>"/>
                                <input type="text" id="total_purchased" class="form-control" readonly value="<?php echo abs($po['PurchaseOrder']['total_purchased']); ?>"/></td>  
                        </tr>
                        <tr >
                            <td colspan="6" align="right"><input id="nonvat" type="checkbox"  <?php if ((int)$po['PurchaseOrder']['vat_amount'] == 0) echo 'checked'; ?> <?php if ($po_products['PurchaseOrder']['status'] != 'ongoing') echo 'disabled' ?>> Non Vat</td>  
                            <td align="right"><div class="vatDiv"><b>ADD: 12% VAT:</b></div></td>  
                            <td><input type="hidden"  readonly class="form-control" id="vat_val" value="<?php echo abs($po['PurchaseOrder']['vat_amount']); ?>"/>
                                <div class="vatDiv"><input type="text"  readonly class="form-control" id="vat" value="<?php echo abs($po['PurchaseOrder']['vat_amount']); ?>"/></div></td>  

                        </tr>

<!--                        <tr id="totalTR">
                            <td colspan="5" align="right"><div class="totDiv"><b>Total:</b></div></td>  
                            <td><div class="totDiv"><input type="text" id="total" class="form-control" readonly/></div></td>  
                        </tr>-->

                        <tr>
                            <td colspan="7" align="right">
                                <select id="ewt_type" class="form-control">
                                    <?php if($po['PurchaseOrder']['ewt_type'] == 'one'):?>
                                        <option value="one">LESS: 1% EWT:</option>
                                        <option value="two">LESS: 2% EWT:</option>
                                        <option value="three">No EWT:</option>
                                    <?php elseif($po['PurchaseOrder']['ewt_type'] == 'two'):?>
                                        <option value="two">LESS: 2% EWT:</option>
                                        <option value="one">LESS: 1% EWT:</option>
                                        <option value="three">No EWT:</option>
                                    <?php else: ?>
                                        <option value="three">No EWT:</option>
                                        <option value="one">LESS: 1% EWT:</option>
                                        <option value="two">LESS: 2% EWT:</option>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td><input type="text" id="ewt" class="form-control" readonly value="<?php echo abs($po['PurchaseOrder']['ewt_amount']); ?>"/></td>  
                        </tr>
                        <tr>
                            <td colspan="7" align="right"><b>Total Amount Due:</b></td>  
                            <td><input type="text" id="grand_total" class="form-control" readonly  value="<?php echo abs($po['PurchaseOrder']['grand_total']); ?>"/></td>  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if ($po['PurchaseOrder']['status'] == 'ongoing') {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <button class="btn btn-primary saveOngoingPO "  data-savestatus="pending">Save</button> 
                    </h3>
                </div>
            </div>
<?php } ?>
    </div>
</div>




<!--<div class="modal fade" id="set-supplier-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            Modal header
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Additional PO for Product</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <input type="hidden" id="sup_pid"/>   

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="selected_supplier" class="form-control" style="width: 100%;"> 
                                <option>Select Supplier</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Supplier</label> 
                            <select id="selected_product_supplier" class="form-control" style="width: 100%;"> 
                                <option>Select Product Supplier</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div id="product_supplier_properties_div">
                            <h4 align="center">Available product</h4>
                            <div class="col-sm-12">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-4" align="center"><b> Property </b></div>
                                <div class="col-sm-4" align="center"><b> Value </b></div>
                                <div class="col-sm-2"> Quantity </div> <div class="col-sm-2"> </div>
                                <div class="col-sm-1">
                                </div>
                            </div>     
                        </div></div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label" id="labelSupplier">Quantity</label> 
                                                <input type="number" step="any" id="po_prod_qty" class="form-control">
                                            </div>
                                        </div>
                </div>
            </div>
            Modal footer
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="savesetSupplier">Add</button>
            </div>
        </div>
    </div>
</div>-->


<!--CREATE PURCHASE ORDER MODAL START-->
<div class="modal fade" id="purchase-order-additional-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Create Additional PO for Product</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="reference_number"/>  
                    <input type="hidden" id="reference_type"/>    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product</label> 
                            <select id="slctd_prdct" class="form-control" style="width: 100%;"> 
                                <option></option>
                                <?php
                                foreach ($products as $product) {
                                    echo '<option value="' . $product['Product']['id'] . '">' . $product['Product']['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Combo</label> 
                            <select id="slctd_prdctcombo" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="slctd_prdct_supplier" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" span="any" id="po_qty" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Price</label> 
                            <input type="number" span="any" id="list_price" class="form-control" value="0">
                            <input type="hidden"  id="supplier_product_id"  >
                        </div>
                    </div>
                    <div class="col-sm-12"id="last_supplier"></div>
                    <div class="col-sm-6"id="rqrd_fld"></div>

                    <div class="col-sm-12">
                        <div id="product_combo_properties_div">
                            <h4 align="center">Product Description</h4>
                            <div class="col-sm-12"> 
                                <div class="col-sm-6" align="center"><b> Property </b></div>
                                <div class="col-sm-6" align="center"><b> Value </b></div>  
                            </div>     
                        </div>
                    </div> 
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveNewSupplierProductBtn">Add</button>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="delivery-sched-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Schedule Delivery</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="quotation_product_id"/> 
                    <input type="hidden" id="quotation_id" value="<?php echo $this->params['url']['id']; ?>"/>   
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Delivery Date</label> 
                            <input type="date"  id="delivery_date" class="form-control"  >
                        </div>
                    </div> 
                    <div class="col-sm-6">  
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Delivery Time</label> 
                            <input type="time" id="delivery_time" class="form-control">
                        </div> 
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" step="any" id="requested_qty" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Delivery Mode</label> 
                            <select class="form-control" id="type">
                                 <option value=""></option>
                                 <option value="deliver">deliver</option>
                                <option value="pickup">pickup</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveDeliverySched">Save</button>
            </div>
        </div>
    </div>
</div>

<!--CREATE PURCHASE ORDER MODAL END-->
<script> 
//$( document ).load(function() {

    $(document).ready(function () {
        var po_products_client_id = 0;
        $('[data-toggle="tooltip"]').tooltip();
        
        $("button#btn_delete").on('click', function() {
            var id=$(this).val();
            var poid = $(this).data("poid");
            var data = {"id":id,"poid":poid};
            
            swal({
                title: "Are you sure?",
                text: "This will delete Purchase Order Product.",
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
                        url: '/purchase_orders/delete',
                        type: 'POST',
						data: {'data': data},
						dataType: 'text',
						success: function(id) {
							console.log(id);
							if(id == "empty") {
							    window.location = "/purchase_orders/all_list?status=ongoing";
							}
							else { location.reload(); }
						},
						error: function(err) {
							console.log("AJAX error: " + JSON.stringify(err, null, 2));
						}
                    });
                } else {
                    swal("Cancelled", "", "error");
                }
            });
        });
    
        if ($("#vat").val() == 0) {
            $(".vatDiv").hide();
            $("#vat").val(0);
        }
        if ($("#discount").val() == 0) {
            $(".discountDiv").hide();
            $("#discount").val(0);
        }
        /////////////////////////////////
        $("#slctd_prdct").select2({
            placeholder: "Select Product Code",
            width: '100%',
            allowClear: false
        });
        $("#slctd_prdctcombo").select2({
            placeholder: "Select Product Combo",
            width: '100%',
            allowClear: false
        });
        $("#slctd_prdct_supplier").select2({
            placeholder: "Select Supplier",
            width: '100%',
            allowClear: false
        });


        $("#nonvat").on("click", function () {
            if (this.checked) {
                $(".vatDiv").hide();
                // $("#vat").val(0);
                var discount = $("#discount").val();
                var total_purchased_val = $("#total_purchased_val").val();
                var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
                var ewt = $("#ewt").val();
                var ewt_type = $("#ewt_type").val();
                var grand_total = $("#grand_total").val();
                var po_id = $("#po_idd").val();

                if ($("#nonvat").is(':checked')) {
                    var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                    var new_vat = parseFloat(new_total_purchased) * 0.12;

                    var vat = new_vat;
                } else {
                    var vat = $("#vat").val();
                }
//                console.log(vat);
                var data = {
                    "discount": discount,
                    "vat": parseFloat(vat),
                    "total_purchased_val": total_purchased_val,
                    "total_purchased": total_purchased,
//                    "total": total,
                    "ewt": ewt,
                    "ewt_type": ewt_type,
                    "grand_total": grand_total,
                    "po_id": po_id
                }
                // console.log(data)
                // console.log('if')
                changeAmount(data);
            } else {
                $(".vatDiv").show();


                var discount = $("#discount").val();
                var vat = 0;
                var total_purchased_val = $("#total_purchased_val").val();
                var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
                var ewt = $("#ewt").val();
                var ewt_type = $("#ewt_type").val();
                var grand_total = $("#grand_total").val();
                var po_id = $("#po_idd").val();

                var data = {
                    "discount": discount,
                    "vat": vat,
                    "total_purchased_val": total_purchased_val,
                    "total_purchased": total_purchased,
//                    "total": total,
                    "ewt": ewt,
                    "ewt_type": ewt_type,
                    "grand_total": grand_total,
                    "po_id": po_id
                }
                changeAmount(data);
                // console.log(data)
                // console.log('else')

            }
        });
        
        $("#ewt_type").change(function () {
            var discount = $("#discount").val();
            var total_purchased_val = $("#total_purchased_val").val();
            var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
            var ewt = $("#ewt").val();
            var ewt_type = $("#ewt_type").val();
            var grand_total = $("#grand_total").val();
            var po_id = $("#po_idd").val();

            if ($("#nonvat").is(':checked')) {
                var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                var new_vat = parseFloat(new_total_purchased) * 0.12;

                var vat = new_vat;
            } else {
                var vat = $("#vat").val();
            }
//                console.log(vat);
            var data = {
                "discount": discount,
                "vat": parseFloat(vat),
                "total_purchased_val": total_purchased_val,
                "total_purchased": total_purchased,
//                    "total": total,
                "ewt": ewt,
                "ewt_type": ewt_type,
                "grand_total": grand_total,
                "po_id": po_id
            }
            changeAmount(data);
        
        });
        
        $("#nodiscount").on("click", function () {
            if (this.checked) {
                $(".discountDiv").hide();
                $("#discount").val(0);

                var discount = 0;
                var total_purchased_val = $("#total_purchased_val").val();
                var total_purchased = $("#total_purchased").val();
//                var total = $("#total").val();
                var ewt = $("#ewt").val();
                var ewt_type = $("#ewt_type").val();
                var grand_total = $("#grand_total").val();
                var po_id = $("#po_idd").val();
                if ($("#nonvat").is(':checked')) {
                    var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                    var new_vat = parseFloat(new_total_purchased) * 0.12;

                    var vat = new_vat;
                } else {
                    var vat = $("#vat").val();
                }
                var data = {
                    "discount": discount,
                    "vat": vat,
                    "total_purchased_val": total_purchased_val,
                    "total_purchased": total_purchased,
//                    "total": total,
                    "ewt": ewt,
                    "ewt_type": ewt_type,
                    "grand_total": grand_total,
                    "po_id": po_id
                }
                changeAmount(data);
            } else {
                $(".discountDiv").show();
                var discount_val = $("#discount_val").val();
                $("#discount").val(discount_val);

            }
        });


        $("#discount, #vat").change(function () {
            var discount = $("#discount").val();
            var total_purchased_val = $("#total_purchased_val").val();
            var total_purchased = $("#total_purchased").val();
//            var total = $("#total").val();
            var ewt = $("#ewt").val();
            var ewt_type = $("#ewt_type").val();
            var grand_total = $("#grand_total").val();
            var po_id = $("#po_idd").val();


            if ($("#nonvat").is(':checked')) {
                var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                var new_vat = parseFloat(new_total_purchased) * 0.12;

                var vat = new_vat;
            } else {
                var vat = $("#vat").val();
            }
            var data = {
                "discount": discount,
                "vat": vat,
                "total_purchased_val": total_purchased_val,
                "total_purchased": total_purchased,
//                "total": total,
                "ewt": ewt,
                "ewt_type": ewt_type,
                "grand_total": grand_total,
                "po_id": po_id
            }
            changeAmount(data);
        });

    });

    $('.price').each(function (index) {
        $(this).change(function () {

            var qty = $(this).data("qqty");
            var tid = $(this).data("tid");
            var po_product_id = $(this).data("poprodid");
            var price = $(this).val();

            var total = qty * price;


            var data = {
                "price": price,
                "po_product_id": po_product_id
            }

            $.ajax({
                url: "/purchase_orders/updatePoProductPrice",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
                    var discount = $("#discount").val();
                    var total_purchased_val = $("#total_purchased_val").val();
                    var total_purchased = $("#total_purchased_val").val();
                    //            var total = $("#total").val();
                    var ewt = $("#ewt").val();
                    var ewt_type = $("#ewt_type").val();
                    var grand_total = $("#grand_total").val();
                    var po_id = $("#po_idd").val();

                    if ($("#nonvat").is(':checked')) {
                        var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                        var new_vat = parseFloat(new_total_purchased) * 0.12;

                        var vat = new_vat;
                    } else {
                        var vat = $("#vat").val();
                    }
                    var data = {
                        "discount": discount,
                        "vat": vat,
                        "total_purchased_val": total_purchased_val,
                        "total_purchased": total_purchased_val,
                        //                "total": total,
                        "ewt": ewt,
                        "ewt_type": ewt_type,
                        "grand_total": grand_total,
                        "po_id": po_id
                    }
                    changeAmount(data);
                },
                error: function (dd) {
                    console.log('error');
                }
            });
        });
    });
    
    $('.qty').each(function (index) {
        $(this).change(function () {

            var qty = $(this).val();
            var tid = $(this).data("tid");
            var po_product_id = $(this).data("poprodid");
            var price = $(this).data("price");

            var total = qty * price;


            var data = {
                "qty": qty,
                "po_product_id": po_product_id
            }

            $.ajax({
                url: "/purchase_orders/updatePoProductQty",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
                    var discount = $("#discount").val();
                    var total_purchased_val = $("#total_purchased_val").val();
                    var total_purchased = $("#total_purchased_val").val();
                    //            var total = $("#total").val();
                    var ewt = $("#ewt").val();
                    var ewt_type = $("#ewt_type").val();
                    var grand_total = $("#grand_total").val();
                    var po_id = $("#po_idd").val();

                    if ($("#nonvat").is(':checked')) {
                        var new_total_purchased = parseFloat(total_purchased_val) - parseFloat(discount);
                        var new_vat = parseFloat(new_total_purchased) * 0.12;

                        var vat = new_vat;
                    } else {
                        var vat = $("#vat").val();
                    }
                    var data = {
                        "discount": discount,
                        "vat": vat,
                        "total_purchased_val": total_purchased_val,
                        "total_purchased": total_purchased_val,
                        //                "total": total,
                        "ewt": ewt,
                        "ewt_type": ewt_type,
                        "grand_total": grand_total,
                        "po_id": po_id
                    }
                    changeAmount(data);
                },
                error: function (dd) {
                    console.log('error');
                }
            });
        });
    });
//    $('.additional_po_product').each(function (index) {
//        $(this).click(function () {
//            $('#set-supplier-modal').modal('show'); 
//        });
//    });



    $("#savesetSupplier").click(function () {
        $("#savesetSupplier").prop('disabled', true);
        var quotation_product_id = $("#sup_pid").val();
        var supplier_id = $("#selected_supplier").val();
        var product_supplier_id = $("#selected_product_supplier").val();

        var property = $('.psp_property').map(function () {
            return $(this).val();
        }).get();
        var value = $('.psp_value').map(function () {
            return $(this).val();
        }).get();
        var qty = $('.psp_qty').map(function () {
            return $(this).val();
        }).get();

        var total_qty = 0;
        $('.psp_qty').each(function (index) {
            var qty = parseFloat($(this).val());
            total_qty = total_qty + qty;
        });

        var total_price = 0;
        $('.psp_price').each(function (index) {
            var price = parseFloat($(this).val());
            total_price = total_price + price;
        });

        var counter = $('.psp_property').length;
        var ctr = counter - 1;
        var additional = 1;
//        var po_prod_qty = $("#po_prod_qty").val();
//        //process add po product
        var data = {
            "quotation_product_id": quotation_product_id,
            "supplier_id": supplier_id,
            "product_supplier_id": product_supplier_id,
            "property": property,
            "value": value,
            "total_qty": total_qty,
            "total_price": total_price,
            "counter": ctr,
            "qty": qty,
            "additional": additional
        }

        console.log(additional);
        $.ajax({
            url: "/purchase_orders/setPoProduct",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                location.reload();
//                console.log(dd);
            },
            error: function (dd) {
                console.log('error');
            }
        });

    });

    function changeAmount(data) {
        $.ajax({
            url: "/purchase_orders/poAmounts",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                // console.log(dd);
                location.reload();
            },
            error: function (dd) {
                console.log('error');
            }
        });

    }


    $('.saveOngoingPO').each(function (index) {
        $(this).click(function () {
            var po_id = $("#po_idd").val();
            var savestatus = $(this).data("savestatus");
            var data = {
                "po_id": po_id,
                "savestatus": savestatus
            }
            swal({
                title: "Are you sure?",
                text: "You will not be able to edit this PO",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, save it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "/purchase_orders/changeStatus",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (dd) {
                                    //                console.log(dd);
//                                        location.reload();
                                    window.location.href = "/purchase_orders/all_list?status=pending";
                                },
                                error: function (dd) {
                                    console.log('error');
                                }
                            });
                        }
                    }
            );
        });
    });
//additional PO Product

        $('.additional_po_product').each(function (index) {
            $(this).click(function () {
                po_products_client_id = $(this).data('clientid');
                var reference_number = $(this).data("refnum");
                var reference_type = $(this).data("reftype");
                $('#reference_number').val(reference_number);
                $('#reference_type').val(reference_type);
                $('#purchase-order-additional-product-modal').modal('show');

                $("#slctd_prdct").change(function () {
                    $('#slctd_prdctcombo').empty().append('<option></option>');
                    $('#slctd_prdct_supplier').empty().append('<option></option>');
                    $('.added_product_combo_properties_div').each(function (index) {
                        $(".added_product_combo_properties_div").remove();
                    });
                    $("#slctd_prdctcombo").select2({
                        placeholder: "Select Product Combo",
                        width: '100%',
                        allowClear: false
                    });
                    var selected_product_id = $("#slctd_prdct").val();
                    ////show product combos of selected product
                    $.get('/supplier_products/get_product_combination', {
                        id: selected_product_id,
                    }, function (data) {
                        for (i = 0; i < data.length; i++) {
                            $('#slctd_prdctcombo').append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                            }));
                        }
                    });

                    ////in here get suppliers for selected product combo
                    $("#slctd_prdctcombo").change(function () {
                        // $(this).empty().append('<option></option>');
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $("#slctd_prdct_supplier").select2({
                            placeholder: "Select Supplier",
                            width: '100%',
                            allowClear: false
                        });

                        var selected_product_id = $("#slctd_prdct").val();
                        var selected_product_combo_id = $("#slctd_prdctcombo").val();

                        //GET LAST PURCHASED SUPPLIER
                        $.get('/supplier_products/get_po_product_last_supplier', {
                            id: selected_product_combo_id,
                        }, function (data) {
                            $("#added_last_supplier").remove();
                            $("#added_last_price").remove();
                            if($.isEmptyObject(data['PurchaseOrderProduct'])!=true) {
                                if(data['PurchaseOrderProduct']['list_price']!=null) {
                                    var price = data['PurchaseOrderProduct']['list_price'];
                                    $('#last_supplier').append('<div id="added_last_price" class="text-primary"> Last Purchased Price:  &#8369;'+ price + ' </div>');
                                }
                            }
                            if(data['Supplier']!=null) {
                                $('#last_supplier').append('<div id="added_last_supplier" class="text-primary"> Last Purchased:  ' + data['Supplier']['name'] + '  [<small>' + data['created'] + '</small>]</div>');
                            }
                        }); //end of ajax get /supplier_products/get_po_product_last_supplier
                        // $.get('/supplier_products/get_po_product_last_supplier', {
                        //     id: selected_product_combo_id,
                        // }, function (data) {
                        //     var data_supplier_name = ''; 
                        //     if(data[0]['PurchaseOrder']['supplier_id']!=null && data[0]['PurchaseOrder']['supplier_id']!="") {
                        //         data_supplier_name = data[0]['PurchaseOrder']['Supplier']['name'];
                        //     }
                        //     $("#added_last_supplier").remove();
                        //     $('#last_supplier').append('<div id="added_last_supplier" class="text-primary"> Last Purchased:  ' + data_supplier_name + '  [<small>' + data[0]['PurchaseOrder']['created'] + '</small>]</div>')
                        // }); //end of ajax get /supplier_products/get_po_product_last_supplier

                        $.get('/supplier_products/get_supplier_product_combo', {
                            id: selected_product_id,
                        }, function (data) {
                            console.log(data);
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_prdctcombo').append($('<option>', {
                                    value: data[i]['ProductCombo']['id'],
                                    text: data[i]['ProductCombo']['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                                }));
                            }
                        }); //end of ajax get /supplier_products/get_product_combination

                        $('#slctd_prdct_supplier').empty().append('<option></option>');
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $.get('/supplier_products/get_supplier_product_combo', {
                            id: selected_product_combo_id,
                        }, function (data) {
                            $('.added_product_combo_properties_div').each(function (index) {
                                $(".added_product_combo_properties_div").remove();
                            });
                            $('#slctd_prdct_supplier').empty().append('<option></option>');
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_prdct_supplier').append($('<option>', {
                                    value: data[i]['Supplier']['id'],
                                    text: data[i]['Supplier']['name']
                                }));
                                $('#list_price').val(data[i]['ProductCombo']['SupplierProduct'][0]['supplier_price']);
                                $('#supplier_product_id').val(data[i]['ProductCombo']['SupplierProduct'][0]['id']);
                                var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty'];

                                for (v = 0; v < prod_combo_property.length; v++) {
                                    $('#product_combo_properties_div').append('<div class="col-sm-12 added_product_combo_properties_div">' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo 
                    }); //end of onchange slctd_prdctcombo 
                }); // end of onchange slctd_prdct 
            }); //end of each po_product_btn
        });


///SAVE PURCHASE ORDER PRODUCT
        $('#saveNewSupplierProductBtn').click(function () {
            $('#added_rqrd_fld').remove();
            var product_combo_id = $('#slctd_prdctcombo').val();
            var product_id = $("#slctd_prdct").val();
            var supplier_id = $("#slctd_prdct_supplier").val();
            var reference_number = $("#reference_number").val();
            var reference_type = $("#reference_type").val();
            var po_qty = $("#po_qty").val();
            var list_price = $("#list_price").val();
            var supplier_product_id = $("#supplier_product_id").val();
            //console.log(reference_num);

            if (product_id != "") {
                if (product_combo_id != "") {
                    if (supplier_id != "") {
                        if (po_qty != "" && po_qty != 0 && po_qty >= 1) {
                            if (list_price != "" && list_price != 0 && list_price >= 1) {
                                $('#added_rqrd_fld').remove();
                                var data = {
                                    "product_combo_id": product_combo_id,
                                    "product_id": product_id,
                                    "supplier_id": supplier_id,
                                    "quote_product_id": reference_number,
                                    "reference_num": reference_number,
                                    "reference_type": reference_type,
                                    "po_qty": po_qty,
                                    "list_price": list_price,
                                    "additional": 1,
                                    "supplier_product_id": supplier_product_id,
                                    "inventory_job_order_type": 'po',
                                    "po_raw_request_id":0,
                                    "po_raw_request_qty":0,
                                    "client": po_products_client_id    
                                }
                                $.ajax({
                                    url: "/purchase_orders/process_new_po",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'text',
                                    success: function (dd) {
                                        console.log('SUCCESS \n' + dd);
                                        location.reload();
                                    },
                                    error: function (dd) {
                                        console.log('ERROR \n' + JSON.stringify(dd));
                                        location.reload();
                                    }
                                });
                            } else {
                                $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Price is required</font></div>')
                            }
                        } else {
                            $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Quantity is required</font></div>')
                        }
                    } else {
                        $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Supplier is required</font></div>')
                    }
                } else {
                    $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Product Combination is required</font></div>')
                }
            } else {
                $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Product is required</font></div>')
            }
        });
        
        $('.delivery_sched').each(function (index) {
            $(this).click(function () {
                var pqid = $(this).data("dspquoteid");
                var pqqty = Math.abs($(this).data("dspquoteqty"));
                $('#delivery-sched-modal').modal('show');
                $('#quotation_product_id').val(pqid);
                $('#requested_qty').val(pqqty);
            });
        });
    
        $('#saveDeliverySched').click(function () {
            var delivery_date = $('#delivery_date').val();
            var delivery_time = $('#delivery_time').val();
            var requested_qty = $('#requested_qty').val();
            var myprod_id = $("#myprod_id").val();
            var quotation_product_id = $('#quotation_product_id').val();
            var quotation_id = $('#quotation_id').val();
            var type = $('#type').val();
            var deliver_to = $('#deliver_to').val();
            var clnt_id = $('#clnt_id').val(); 
            var shipping_address = $('#shipping_address').val(); 
            var g_maps = $('#g_maps').val(); 
    
            if (delivery_date != '') {
                if (requested_qty != '') {
                    if (delivery_time != '') {
                        if (type != '') {
                            var data = {"delivery_date": delivery_date,
                                "requested_qty": requested_qty,
                                "product_reference": quotation_product_id,
                                "reference_number": quotation_id,
                                "delivery_time": delivery_time,
                                "mode":type,
                                "reference_type":'quotation',
                                "deliver_to":deliver_to,
                                "product_id":myprod_id,
                                "client_id":clnt_id,
                                "supplier_id":0,
                                "shipping_address":shipping_address,
                                "g_maps": g_maps,
                                "delivered_qty": 0,
                                "date_delivered": null
                            }
                            // console.log(data);
                            $.ajax({
                                url: "/delivery_schedules/addSched",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (dd) {
                                    location.reload();
                                },
                                error: function (dd) {
                                    console.log(dd);
                                }
                            });
                        } else {
                            document.getElementById('type').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('delivery_time').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('requested_qty').style.borderColor = "red";
                }
            } else {
                document.getElementById('delivery_date').style.borderColor = "red";
            }
        });
</script>
