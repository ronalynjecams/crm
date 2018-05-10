<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Product Suppliers</h1>
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
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Suppliers Price</th>
                            <th>Product Details</th> 
                            <th>Supplier Name</th> 
                            <th>Supplier Contact Person</th> 
                            <th>Supplier Contact</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Suppliers Price</th>
                            <th>Product Details</th> 
                            <th>Supplier Name</th> 
                            <th>Supplier Contact Person</th> 
                            <th>Supplier Contact</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php //foreach($products as $product_each) {
                            foreach($product_suppliers as $product_supplier) { 
                                
                                if($product_supplier['Supplier']['type'] != 'supply' ||$product_supplier['Supplier']['type'] == 'customized' || $product_supplier['Supplier']['type'] == 'combination'){
                         //       if($product_supplier['ProductCombo']['Product']['type'] != 'supply' || $product_supplier['ProductCombo']['Product']['type'] == 'customized' || $product_supplier['ProductCombo']['Product']['type'] == 'combination'){
                            ?> 
                            <tr>
                                <td><?php echo '<img class="img-responsive" src="/img/product-uploads/' . h($product_supplier['ProductCombo']['Product']['image']) . '" width="70" height="70">'; ?></td> 
                                <td><?php echo h($product_supplier['ProductCombo']['Product']['name']); ?></td>  
                                <td><?php echo '&#8369; ' . number_format($product_supplier['SupplierProduct']['supplier_price'],2); ?></td> 
                                <td>
                                    <ul class="list-group">
                                        <?php
                                        foreach ($product_supplier['ProductCombo']['ProductComboProperty'] as $prod) {
                                            echo '<li class="list-group-item"><b>' . h($prod['property']) . '</b> : ' . h($prod['value']) . ' </li>';
                                        }
                                        ?>
                                    </ul>
                                </td>  
                                <td><?php  echo $product_supplier['Supplier']['name']; ?></td>
                                <td><?php echo $product_supplier['Supplier']['contact_person']; ?></td>
                                <td><?php  echo $product_supplier['Supplier']['contact_number']." "."[".$product_supplier['Supplier']['email']."]"; ?></td>
                            </tr>
                        <?php } 
                        
                        }
                        
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
    });
</script>

