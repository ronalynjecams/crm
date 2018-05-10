 
     <!--/////////////////////adonis////////-->
      <link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
      <link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
      <link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet"> 
      <link href="/css/sweetalert.css" rel="stylesheet">
           
      <script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
      <script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
      <script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
      <script src="/css/plug/select/js/select2.min.js"></script>
      <script src="/js/sweetalert.min.js"></script> 
      
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
          <h1 class="page-header text-overflow">List of Unprocessed Products</h1>
        </div>
        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
          <!-- Basic Data Tables -->
          <!--===================================================-->
          <div class="panel">
            <div class="panel-body">
            <div class="table-responsive">
              
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Product Code</th>
                    <th>Description</th>
                    <th>Processed Qty</th>
                    <th>Type</th> 
                    <th>Action</th> 
                  
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Product Code</th>
                    <th>Description</th>
                    <th>Processed Qty</th>
                    <th>Type</th> 
                    <th>Action</th> 
                  </tr>
                </tfoot>
       <tbody>
           <?php  foreach ($po_product_infos as $po_product_info){
                   
            if(($po_product_info['QuotationProduct']['qty']!=$po_product_info['QuotationProduct']['processed_qty'])==true){
     
           ?>
               <tr>
                <td><?php echo $po_product_info['Product']['name']; ?></td>
                <td>
                        <ul class="list-group">
                        <li class="list-group-item">Type:<?php echo $po_product_info['QuotationProduct']['type']; ?></li>
                        <?php
                         foreach ($po_product_info['QuotationProductProperty'] as $desc) {
                           if (is_null($desc['property'])) {
                              $ppname = '<font class="text-danger">Unknown</font>';
                            if(!empty($desc['ProductProperty'])) {
                              $ppname_tmp = ucwords($desc['ProductProperty']['name']);
                            if($ppname_tmp!="") {
                              $ppname = $ppname_tmp;
                            }
                        }
                                                                            
                               $pvval = '<font class="text-danger">Not specified</font>';
                             if(!empty($desc['ProductValue'])) {
                               $pvval_tmp = $desc['ProductValue']['value'];
                             if($pvval_tmp != "") {
                               $pvval = $pvval_tmp;
                              }
                          }
                                                                            
                            if(!empty($desc['ProductProperty'])) {
                                echo '<li class="list-group-item"><b>' . $ppname . '</b> : ' . $pvval . '</li>';
                              }
                          } else {
                                echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                              }
                          }
                              ?>
                            <?php echo '<li class="list-group-item"><b>Other Info : <br/></b>' . $po_product_info['QuotationProduct']['other_info'] . '</li>'; ?>

                        </ul>
                </td>
                <td><?php echo abs($po_product_info['QuotationProduct']['processed_qty']) . ' / ' . abs($po_product_info['QuotationProduct']['qty']); ?></td>
                <td><?php echo $po_product_info['QuotationProduct']['type']; ?></td> 
                <td>
                  <button class="btn btn-sm btn-primary po_productinfobtn"
                          data-client="<?php echo $po_product_info['Quotation']['client_id']; ?>"
                          data-qtprodid="<?php echo $po_product_info['QuotationProduct']['id']; ?>">Select Supplier</button>

                 <button class="btn btn-sm btn-warning inventory_productinfobtn add-tooltip" data-toggle="tooltip"  data-original-title="Get Product From Inventory" data-qprdctids="<?php echo $po_product_info['QuotationProduct']['id']; ?>" data-qprdctqty="<?php echo $po_product_info['QuotationProduct']['qty']; ?>"><i class="fa fa-cubes"></i></button>
                </td> 
                        </tr>
 
                       <?php
                                     }
                                       
                                }
                             
                
                         ?>
                     
                            
                    
                 
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
<!--CREATE PURCHASE ORDER MODAL START-->
<div class="modal fade" id="purchase-order-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Create PO for Product</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="quote_product_id"/>    
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




<!--CREATE PURCHASE ORDER MODAL END-->
<!--GET FROM INVENTORY MODAL START-->
<div class="modal fade" id="get-from-inventory-product-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Select Product from Inventory</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="inv_quote_product_id"/>    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Location</label> 
                            <select id="slctd_inv_lcation" class="form-control" style="width: 100%;"> 
                                <option></option>
                                <?php
                                foreach ($locations as $location) {
                                    echo '<option value="' . $location['InvLocation']['id'] . '">' . $location['InvLocation']['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product</label> 
                            <select id="slctd_inv_prdct" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Combo</label> 
                            <select id="slctd_inv_prdctcombo" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" span="any" id="po_inv_qty" class="form-control" value="0">
                        </div>
                    </div>

                    <!--<div class="col-sm-12"id="last_supplier"></div>-->
                    <div class="col-sm-6"id="inv_rqrd_fld"></div>

                    <div class="col-sm-12">
                        <div id="inv_product_combo_qtys_div"> 
                        </div>
                    </div> 

                    <div class="col-sm-12">
                        <div id="inv_product_combo_properties_div">
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
                <button class="btn btn-primary" id="saveNewInventoryProductBtn">Add</button>
            </div>
        </div>
    </div>
</div> 
<!--GET FROM INVENTORY MODAL END-->


       
    <script> 
     
          $(document).ready(function () {
        $("#slctd_inv_prdct").select2({
            placeholder: "Select Inventory Product",
            width: '100%',
            allowClear: false
        });
        
        $("#slctd_inv_prdctcombo").select2({
            placeholder: "Select Product Combo",
            width: '100%',
            allowClear: false
        });
        
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
            placeholder: "Select Product Supplier",
            width: '100%',
            allowClear: false
        });
        $("#slctd_inv_lcation").select2({
            placeholder: "Select Location",
            width: '100%',
            allowClear: false
        });
           $(document).ready(function() { 
    
                $('#example').DataTable( {
                    "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                    "order": [[ 0, "asc" ]],
                    "stateSave": true
                } );
           });
           
           
           
           
        ///SAVE PURCHASE ORDER PRODUCT
        $('#saveNewSupplierProductBtn').click(function () {
            $('#added_rqrd_fld').remove();
            var product_combo_id = $('#slctd_prdctcombo').val();
            var product_id = $("#slctd_prdct").val();
            var supplier_id = $("#slctd_prdct_supplier").val();
            var quote_product_id = $("#quote_product_id").val();
            var po_qty = $("#po_qty").val();
            var list_price = $("#list_price").val();
            var supplier_product_id = $("#supplier_product_id").val();


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
                                    "quote_product_id": quote_product_id,
                                    "po_qty": po_qty,
                                    "list_price": list_price,
                                    "additional": 0,
                                    "supplier_product_id": supplier_product_id,
                                    "inventory_job_order_type": 'demo',
                                    "po_raw_request_id":0,
                                    "po_raw_request_qty":0,
                                    "client": get_passed_client
                                    
                                    
                                    // "product_combo_id": product_combo_id,
                                    // "product_id": product_id,
                                    // "supplier_id": supplier_id,
                                    // "quote_product_id": quote_product_id,
                                    // "reference_num": quote_product_id,
                                    // "reference_type": reference_type,
                                    // "po_qty": po_qty,
                                    // "list_price": list_price,
                                    // "additional": 1,
                                    // "supplier_product_id": supplier_product_id,
                                    // "inventory_job_order_type": 'po',
                                    
                                    
                                }
                                $.ajax({
                                    url: "/purchase_orders/process_new_po",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'text',
                                    success: function (dd) {
                                        location.reload();
                                        //console.log(dd);
                                    },
                                    error: function (dd) {
                                        location.reload();
                                        // console.log('error' + dd);
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
           
           var get_passed_client = 0;
        $('.po_productinfobtn').each(function (index) {
            $(this).click(function () {
                var qoute_prod_id = $(this).data("qtprodid");
                get_passed_client = $(this).data('client');
                $('#purchase-order-product-modal').modal('show');
                $('#quote_product_id').val(qoute_prod_id);

                    $('#slctd_prdctcombo').empty().append('<option></option>');
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

                    ////in here get suppliers for selected profct combo
                    $("#slctd_prdctcombo").change(function () {
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $("#slctd_prdct_supplier").select2({
                            placeholder: "Select Product Supplier",
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

                        // $.get('/supplier_products/get_supplier_product_combo', {
                        //     id: selected_product_id,
                        // }, function (data) {
                        //     for (i = 0; i < data.length; i++) {
                        //         $('#slctd_prdctcombo').append($('<option>', {
                        //             value: data[i]['ProductCombo']['id'],
                        //             text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                        //         }));
                        //     }
                        // }); //end of ajax get /supplier_products/get_product_combination

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
        
        
        ///////////////////////////////////////////////////////////////
///////////////////// GET FROM INVENTORY /////////////////////

        $('.inventory_productinfobtn').each(function (index) {
            $(this).click(function () {
                var qoute_prod_id = $(this).data("qprdctids");
                $('#get-from-inventory-product-modal').modal('show');
                $('#inv_quote_product_id').val(qoute_prod_id);

                $("#slctd_inv_lcation").change(function () {
                                $('#added_inv_rqrd_fld').remove();
                        $('#added_inv_product_combo_qtys_div').remove();
                $("#slctd_inv_prdct").select2({
                    placeholder: "Select Product",
                    width: '100%',
                    allowClear: false
                });
//                    alert('asd');
                    var slctd_inv_lcation = $("#slctd_inv_lcation").val();
//                    //GET PRODUCTS based from selected location
                    $.get('/inventory_products/get_inventory_products', {
                        id: slctd_inv_lcation,
                    }, function (data) {
                            $('#slctd_inv_prdctcombo').empty().append('<option></option>');
                            $('#slctd_inv_prdct').empty().append('<option></option>');
                            $('#added_inv_product_combo_qtys_div').remove();
                            $('.inv_added_product_combo_properties_div').each(function (index) {
                                $(".inv_added_product_combo_properties_div").remove();
                            }); 
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_inv_prdct').append($('<option>', {
                                    value: data[i]['Product']['id'],
                                    text: data[i]['Product']['name']
                                }));
                            }
                        // console.log(data); 
                    }); //end of ajax get /inventory_products/get_inventory_products
                    
                    
//                    //GET PRODUCT COMBO based from selected product
                    $("#slctd_inv_prdct").change(function () { 
                                $('#added_inv_rqrd_fld').remove();
                        // alert('asd');
                        $('#added_inv_product_combo_qtys_div').remove(); 
                        var selected_product_id = $("#slctd_inv_prdct").val(); 
                        $("#slctd_inv_prdctcombo").select2({
                            placeholder: "Select Product Combo",
                            width: '100%',
                            allowClear: false
                        });
                    $.get('/supplier_products/get_product_combination', {
                        id: selected_product_id,
                    }, function (data) {
                            $('#slctd_inv_prdctcombo').empty().append('<option></option>');
                        for (i = 0; i < data.length; i++) {
                            $('#slctd_inv_prdctcombo').append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                            })); 
                        }
                    });   //end of ajax get /supplier_products/get_product_combination
                    
                    
                    
                    $("#slctd_inv_prdctcombo").change(function () { 
                                $('#added_inv_rqrd_fld').remove();
                        
                        $('#added_inv_product_combo_qtys_div').remove();
                        var slctd_inv_prdctcombo = $('#slctd_inv_prdctcombo').val();
                        $('.inv_added_product_combo_properties_div').each(function (index) {
                            $(".inv_added_product_combo_properties_div").remove();
                        });
                        
                        $('#added_inv_product_combo_qtys_div').remove();
                        
                        
                        $.get('/supplier_products/get_supplier_product_combo', {
                            id: slctd_inv_prdctcombo,
                        }, function (data) {
                            $('.inv_added_product_combo_properties_div').each(function (index) {
                                $(".inv_added_product_combo_properties_div").remove();
                            }); 
                            for (i = 0; i < data.length; i++) { 
                                var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty']; 
                                for (v = 0; v < prod_combo_property.length; v++) {
                                    $('#inv_product_combo_properties_div').append('<div class="col-sm-12 inv_added_product_combo_properties_div">' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo
                        
                         
                        
                        //get counts of product combo
                        $.get('/inventory_products/get_inventory_product_count', {
                            id: slctd_inv_prdctcombo,
                            slctd_inv_lcation:slctd_inv_lcation
                        }, function (data) {
                        
                        // $('#added_inv_product_combo_qtys_div').remove();
                            // console.log('=='+data['inv_qty']+'==');
                            $('#inv_product_combo_qtys_div').append('<div id="added_inv_product_combo_qtys_div">' +
                                            '<label class="col-sm-8" ><b> Available Quantity in Inventory </b></label>' +
                                            '<div class="col-sm-4" align="center">'+data['inv_qty']+'</div> '+ 
                                            '</div>');
                        }); //end of ajax get /supplier_products/get_supplier_product_combo
                    }); //end of change slctd_inv_prdctcombo
                    });
                });
            });
        });
        ///SAVE inventory PRODUCT
        $('#saveNewInventoryProductBtn').click(function () {  
            var slctd_inv_lcation = $('#slctd_inv_lcation').val();
            var slctd_inv_prdct = $("#slctd_inv_prdct").val();
            var slctd_inv_prdctcombo = $("#slctd_inv_prdctcombo").val();
            var po_inv_qty = $("#po_inv_qty").val(); 
            var inv_quote_product_id = $("#inv_quote_product_id").val();
            
            
            if (slctd_inv_lcation != "") {
                if (slctd_inv_prdct != "") {
                    if (slctd_inv_prdctcombo != "") {
                        if (po_inv_qty != "" && po_inv_qty != 0 && po_inv_qty >= 1) { 
                                $('#added_inv_rqrd_fld').remove();
                                $(this).attr("disabled", "disabled"); //to disable button
                                var data = {
                                    "slctd_inv_lcation": slctd_inv_lcation,
                                    "slctd_inv_prdct": slctd_inv_prdct,
                                    "slctd_inv_prdctcombo": slctd_inv_prdctcombo,
                                    "po_inv_qty": po_inv_qty,
                                    "inv_quote_product_id": inv_quote_product_id, 
                                    "inventory_job_order_type": 'dr',
                                }
                                $.ajax({
                                    url: "/inventory_job_orders/process_quoted_products",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();  
                                    },
                                    error: function (dd) {
                                        console.log('error' + dd);
                                    }
                                });
                            } else {
                                $('#inv_rqrd_fld').append('<div id="added_inv_rqrd_fld"><font color="red">Quantity is required</font></div>')
                            } 
                    } else {
                        $('#inv_rqrd_fld').append('<div id="added_inv_rqrd_fld"><font color="red">Ptoduct Combo is required</font></div>')
                    }
                } else {
                    $('#inv_rqrd_fld').append('<div id="added_inv_rqrd_fld"><font color="red">Product is required</font></div>')
                }
            } else {
                $('#inv_rqrd_fld').append('<div id="slctd_inv_lcation"><font color="red">Inventory Location is required</font></div>')
            }
            
            
        });
          });
/////////////////////adonis////////
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
        
        <!--/////////////////////adonis////////-->
    
        
        
        
 