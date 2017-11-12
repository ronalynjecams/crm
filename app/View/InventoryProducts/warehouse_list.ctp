<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>
<style>
    #add_work{
        margin-top: 10px;
    }

    #add_people{
        margin-top: 10px;
    }

</style>
<!--CONTENT CONTAINER-->

<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow animated fadeInDown">Inventory Products</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
<div id="page-content">

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading" align="right">

                     <div class="panel-control">
                            <?php #if(( $UserIn['User']['role'] == 'fitout_facilitator')){ ?>
                                <button class="btn btn-success add-tooltip btn-md" data-toggle="tooltip" data-placement="top" data-original-title="Add inventory product" id="add_product" tooltip="Add inventory product"><i class="fa fa-plus"></i>&nbsp;Add inventory product</button>
                            <?php #} ?>
                    </div>

                </div>
                
                <div class="panel-body">
                    <div class="table-responsive">
                    <table id="example3" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Quantity for repair</th>
                            <th>Quantity chopped</th>
                            <th>Minimum stock level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Quantity for repair</th>
                            <th>Quantity chopped</th>
                            <th>Minimum stock level</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($selected_prods as $selected_prod){ ?>
                        <tr>
                            <td><?php echo h($selected_prod['ProductCombo']['Product']['name'])." "."[".h($selected_prod['ProductCombo']['ordering'])."]"; ?></td>
                            <td>
                            <?php 
                                foreach($selected_prod['ProductCombo']['ProductComboProperty'] as $combo_property){
                                   
                                        echo h($combo_property['property'])." : ".h($combo_property['value']);
                                }
                            ?>
                            </td>
                            <td><?php echo h($selected_prod['InventoryProduct']['qty']); ?></td>
                            <td><?php echo h($selected_prod['InventoryProduct']['qty_for_repair']); ?></td>
                            <td><?php echo h($selected_prod['InventoryProduct']['qty_chopped']); ?></td>
                            <td><?php echo h($selected_prod['InventoryProduct']['min_stock_level']); ?></td>
                            <td>
                               <?php 
                            //   if(( $UserIn['User']['role'] == 'fitout_facilitator' )){
                            //       if(($fitout_todo['FitoutTodo']['date_started'] == "" )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-xs-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editproductBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="Update" data-id="'.h($selected_prod['InventoryProduct']['id']).'" data-qty="'.h($selected_prod['InventoryProduct']['qty']).'" data-qtyrepair="'.h($selected_prod['InventoryProduct']['qty_for_repair']).'" data-qtychop="'.h($selected_prod['InventoryProduct']['qty_chopped']).'" data-minstock="'.h($selected_prod['InventoryProduct']['min_stock_level']).'"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                         echo"</div>";
                                    echo"</div";

                            //       }else{
                            //             echo h(date('F d, Y h:i:a', strtotime($fitout_todo['FitoutTodo']['date_started'])));
                            //       }
                            //     }else{
                            //         if($fitout_todo['FitoutWork']['date_started'] != ""){
                            //             echo h(date('F d, Y h:i:a', strtotime($fitout_todo['FitoutTodo']['date_started'])));

                            //         }else{
                            //             echo"<p>not available</p>";
                            //         }
                            //     }

                                ?>
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


    </div>
</div>

<!--Add New people Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-product-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add Product</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                   <div class="row">
                       <div class="col-sm-6">
                        <label>Product name</label>
                        <input type="hidden" id="inv_location_id" value="<?php echo $invs['InvLocation']['id']; ?>" >
                        
                        <select class="form-control" id="product">
                            <option value="0">Please select a product name</option>
                            <?php foreach($lists_products as $lists_product){ ?>
                                    <option value="<?php echo $lists_product['Product']['id']; ?>"><?php echo $lists_product['Product']['name']; ?></option>
                            <?php } ?>
                            ?>
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <label>Product Combo</label>
                        <select class="form-control" id="selected_product_combo" >
                            <option value="0">Selected Product combo</option>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-4">
                        <label>Quantity</label>
                            <input type="number" class="form-control" id="quantity" >
                        </div>
                        <div class="col-sm-4">
                        <label>Quantity for repair</label>
                            <input type="number" class="form-control" id="quantity_repair" >
                        </div>
                        <div class="col-sm-4">
                        <label>Quantity Chop</label>
                            <input type="number" class="form-control" id="quantity_chop" >
                        </div>
                    </div>
                     <div class="row">
                         <div class="col-sm-12">
                         <label>Minimum stock level</label>
                             <input type="number" class="form-control" id="min_stock_level">
                         </div>
                     </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="addProduct">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New people Modal End !-->


<!-- Edit product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-product-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit Inventory Product</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                        <div class="col-sm-4">
                             <input type="hidden" class="form-control"  id="u_id">
                             <label>Quantity</label>
                            <input type="number" class="form-control" id="u_qty">
                        </div>

                        <div class="col-sm-4">
                            <label>Quantity repair</label>
                            <input type="number" class="form-control" id="u_qtyrepair">
                        </div>
                        
                        <div class="col-sm-4">
                            <label>Quantity chop</label>
                            <input type="number" class="form-control" id="u_qtychop">
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <label>Min stock</label>
                            <input type="number" class="form-control" id="u_minstock">
                            </div>
                        </div>
                    </div>
                </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="editProduct">Update</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--===================================================-->
<!-- Edit product Modal End!-->


<script>

    $('#add_product').on("click", function () {
        $('#add-product-modal').modal('show');
            
        
    });
    

    $(document).ready(function () {
         var date = new Date();
        date.setDate(date.getDate() - 1);

        // $('#date_need')
        //     .datepicker({
        //         format: 'yyyy-mm-dd',
        //         startDate: date,
        // });
        

        $('#example3').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        

        $("#product").select2({
            placeholder: "Select Product",
            width: '100%',
            allowClear: false
        });


        $("#product").change(function () {
            var product = $("#product").val();
            
            $('#selected_product_combo').empty().append('<option></option>');
            $("#selected_product_combo").select2({
                placeholder: "Select Product combination",
                allowClear: true
            });
            
            $.get("/InventoryProducts/get_product_combination", {product: product},
                function (data) {
                for (i = 0; i < data.length; i++) {
                    $('#selected_product_combo').append($('<option>', {
                        value: data[i]['ProductCombo']['id'],
                        text: data[i]['ProductCombo']['ordering']
                    }))
                }
            });
            
        });
        
    });


        $(".editproductBtn").each(function (index) {
        $(this).on("click", function () {
              var id = $(this).data('id');
              var qty = $(this).data('qty');
              var qtyrepair = $(this).data('qtyrepair');
              var qtychop = $(this).data('qtychop');
              var minstock = $(this).data('minstock');

                $('#u_id').val(id);
                $('#u_qty').val(qty);
                $('#u_qtyrepair').val(qtyrepair);
                $('#u_qtychop').val(qtychop);
                $('#u_minstock').val(minstock);
                
                $('#edit-product-modal').modal('show');
        });
    });

         $('#editProduct').on("click", function () {
            var u_id = $('#u_id').val();
            var u_qty = $('#u_qty').val();
            var u_qtyrepair = $('#u_qtyrepair').val();
            var u_qtychop = $('#u_qtychop').val();
            var u_minstock = $('#u_minstock').val();

            if(( u_qty != "")){
                if(( u_qtyrepair != "" )){
                    if(( u_qtychop != "" )){
                        if(( u_minstock != "" )){
                        
                            var data = { "u_id": u_id, "u_qty": u_qty, "u_qtyrepair": u_qtyrepair, "u_qtychop": u_qtychop, "u_minstock": u_minstock }

                    $.ajax({
                        url: "/InventoryProducts/update_product",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',

                        success: function (id) {
                            location.reload();
                        },
                        erorr: function (id) {
                            alert('error!');
                        }
                    });

            }else{
              document.getElementById('u_minstock').style.borderColor = "red";
            }
            
            }else{
              document.getElementById('u_qtychop').style.borderColor = "red";
            }

            }else{
              document.getElementById('u_qtyrepair').style.borderColor = "red";
            }


            }else{
                document.getElementById('u_qty').style.borderColor = "red";
            }


        });


    $('#addProduct').on("click", function () {
        var inv_location_id = $('#inv_location_id').val();
        var product = $('#product').val();
        var selected_product_combo = $('#selected_product_combo').val();
        var quantity = $('#quantity').val();
        var quantity_repair = $('#quantity_repair').val();
        var quantity_chop = $('#quantity_chop').val();
        var min_stock_level = $('#min_stock_level').val();

        if((product != 0)){
            if((selected_product_combo != 0)){
                if((quantity != 0)){
                                
                                 var data = {"inv_location_id": inv_location_id, "selected_product_combo": selected_product_combo, "quantity": quantity, "quantity_repair": quantity_repair, "quantity_chop": quantity_chop, "min_stock_level": min_stock_level }
                                 
                            $.ajax({
                                url: "/InventoryProducts/add_product",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                    location.reload(true);

                                },
                                error: function() {
                                    swal({title:'Record already exist', text:'duplicate record', type:'warning', timer:'2000'})
                                }
                            });
        
        } else {
            document.getElementById('quantity').style.borderColor = "red";
        }
        
        } else {
            document.getElementById('selected_product_combo').style.borderColor = "red";
        }
        
        } else {
            document.getElementById('product').style.borderColor = "red";
        }
        
    });


</script>
<script>
    function killCopy(e) {
        return false
    }
    function reEnable() {
        return true
    }
    document.onselectstart = new Function("return false")
    if (window.sidebar) {
        document.onmousedown = killCopy
        document.onclick = reEnable
    }
</script>
<!---END OF JAVASCTRIPT FUNCTIONS--->