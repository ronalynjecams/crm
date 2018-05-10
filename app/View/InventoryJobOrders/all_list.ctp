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
        <h1 class="page-header text-overflow"><?php echo ucwords($mode.' Inventory Products[<small>'.$status.'</small>]'); ?></h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->

        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                </h3>  
            </div>
            <div class="panel-body">
 
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date Created</th> 
                            <th>Product Name</th>  
                            <th>Product Description</th>
                            <th>Qty. to Process</th>
                            <th>Processed Qty.</th>
                            <th>Company Name</th>
                            <th>Control Number</th>
                            <th>Action</th>  
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($inventory as $data) { 
                            $inv = json_encode($inventory);
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    echo time_elapsed_string($data['InventoryJobOrder']['created']);
                                    // echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['expected_start'])) . '</small>';
                                    ?>  
                                </td> 
                                <td>
                                    <?php
                                    echo $data['ProductCombo']['Product']['name'];
                                    ?>  
                                </td>
                                <td><?php foreach ($data['ProductCombo']['ProductComboProperty'] as $data2) {
                                    echo $data2['property'].' : '.$data2['value'];
                                }?>
                                </td>
                                <?php if($data['InventoryJobOrder']['created'] != "accomplished"){ ?>
                                <td>
                                    <?php echo $data['InventoryJobOrder']['qty']; ?>
                                </td>
                                <?php } ?>
                                <td>
                                    <?php echo $data['InventoryJobOrder']['processed_qty']; ?>
                                </td>
                                <td>
                                    <?php 
                                        $ref_type = $data['InventoryJobOrder']['reference_type'];
                                        
                                        if($ref_type == 'po') {
                                            echo $data['PurchaseOrder']['Supplier']['name'];
                                        } else if($ref_type == 'dr') {
                                            echo $data['Quotation']['Client']['name']; 
                                        } else if($ref_type == 'demo' || $ref_type == 'service_unit') {
                                            echo $data['ClientService']['Client']['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                   <?php 
                                        $ref_type = $data['InventoryJobOrder']['reference_type'];
                                        
                                        if($ref_type == 'po') {
                                            echo $data['PurchaseOrder']['po_number'];
                                        } else if($ref_type == 'dr') {
                                            echo $data['Quotation']['quote_number']; 
                                        } else if($ref_type == 'demo' || $ref_type == 'service_unit') {
                                            echo $data['ClientService']['service_code'];
                                        }
                                    ?>
                                </td> 
                                <td>
                                    <button class="btn btn-xs btn-success open_modal" data-toggle="tooltip"  data-original-title="Update actual start date" data-actid="<?php echo $data['InventoryJobOrder']['id']; ?>" data-prodname="<?php echo $data['ProductCombo']['Product']['name']; ?>" data-invarr='<?php echo $inv; ?>' data-buttontype="start"><i class="fa fa-calendar-plus-o"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- UPDATE MODAL ACTUAL START-->
<div class="modal fade" id="release-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title"><?php echo ucwords($mode); ?></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6">
                        <select id="location_id" class="form-control" style="width: 100%;"> 
                            <option> -- Location --</option>
                            <?php foreach ($locations as $location) { ?>
                                <option value="<?php echo $location['InvLocation']['id']; ?>"> <?php echo $location['InvLocation']['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" step="any" id="prod_qty" class="form-control" placeholder="Quantity">
                        <input type="hidden" id="reference_type"/>
                        <input type="hidden" id="reference_num"/>
                        <input type="hidden" id="prod_combo_id"/>
                        <input type="hidden" id="invjo_qty"/>
                        <input type="hidden" id="invjo_pqty"/>
                        <input type="hidden" id="invjo_id"/>
                    </div>
                
                <div class="col-sm-12">
                    <div id="prod_description">
                        <h4 id="product_name" align="center">Available product</h4>
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
                <button class="btn btn-primary" id="updateInventory"><?php echo ucwords($mode); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL ACTUAL START END-->

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true

        });
    });
    
    $(".open_modal").each(function (index) {
        $(this).on("click", function () {
            var invarr = new Array();
            var id = $(this).data('deptid');
            var prodname = $(this).data('prodname');
            invarr = $(this).data('invarr');
            console.log(invarr);
            console.log(invarr[0]['InventoryJobOrder']);
            
            var inv_jo = invarr[0]['InventoryJobOrder'];
            var product_combo = invarr[0]['ProductCombo']['ProductComboProperty'];
            
            $('#inv_id').val(id);
            $('#reference_type').val(inv_jo['reference_type']);
            $('#reference_num').val(inv_jo['reference_num']);
            $('#prod_combo_id').val(inv_jo['product_combo_id']);
            $('#invjo_qty').val(inv_jo['qty']);
            $('#invjo_pqty').val(inv_jo['processed_qty']);
            $('#invjo_id').val(inv_jo['id']);
            $('#release-modal').modal('show');
            $('#product_name').text(prodname);
            
            $('#prod_qty').append('<tr><td></td>'+
                 '<td></td>'+
                 '<td></td>'+
                 '</tr>');
            
            $('.prod_description_add').each(function (index) {
                $(".prod_description_add").remove();
            });
            
            $.each(product_combo, function(index, value){
                $('#prod_description').append('<div  class="col-sm-12 prod_description_add">' +
                    '<div class="col-sm-6" align="center">' + value['property'] + '</div>' +
                    '<div class="col-sm-6" align="center"> ' + value['value'] + ' </div>' +
                    '</div>');
            });
            
        });
    });
    
    $("#updateInventory").click(function () {
        var location = $("#location_id").val();
        var qty = $("#prod_qty").val();
        var ref_type = $("#reference_type").val();
        var ref_num = $("#reference_num").val();
        var prod_combo_id = $("#prod_combo_id").val();
        var invjo_qty = $("#invjo_qty").val();
        var invjo_pqty = $("#invjo_pqty").val();
        var invjo_id = $("#invjo_id").val();
        
        var total_pqty = parseFloat(qty)+parseFloat(invjo_pqty);
        var status = "";
        
        if(parseFloat(total_pqty) < parseFloat(invjo_qty)){
            status = "partial";
        } 
        if(parseFloat(total_pqty) == parseFloat(invjo_qty)){
            status = "accomplished";
        }
        
        console.log(status);
        if(status == 'partial' || status == 'accomplished'){
            var data = {
                "location": location,
                "qty": qty,
                "ref_type": ref_type,
                "ref_num": ref_num,
                "prod_combo_id": prod_combo_id,
                "status": status,
                "invjo_id": invjo_id,
                "invjo_pqty": invjo_pqty
            }
            $.ajax({
                url: "/inventory_job_orders/save_inventory",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
                    // location.reload();
                        console.log(dd);
                },
                error: function (dd) {
                    console.log('error' + dd);
                }
            });
        } else{
            alert("error");
        }
        
    });
</script>