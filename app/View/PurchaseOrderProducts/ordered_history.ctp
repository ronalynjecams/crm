<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            Ordered History of <?php $product['Product']['name']; ?>
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">

                <div class="table-responsive">
                    <table id="example"
                           class="table table-striped table-bordered"
                           cellspacing="0" width="100%"
                           data-sort-name="no_pur" data-sort-order="asc">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th data-field="no_pur" data-sortable="true">Product Name</th>
                                <th>Details</th>
                                <th>Quantity</th>
                                <th>Ordered From</th>
                                <th>Ordered For</th>
                            </tr>
                        </thead>
                        <tbody id="here">
                            <?php  foreach($po_products as $po_product): ?>
                            <tr>
                            <td>
                                <?php
                                    $img = $this->requestAction('App/thumbnail/'.$po_product['Product']['image'].'/400/519');
                					// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
                				
                					$imageData = base64_encode($img);
                
                					// Format the image SRC:  data:{mime};base64,{data};
                					$src = 'data: image/jpg;base64,'.$imageData;
                					
                					// Echo out a sample image
                					echo  '<img class="img-responsive" src="' . $src . '" width="20%">';
                                ?>
                            </td>
                            <td><?php echo $po_product['Product']['name']; ?></td>
                            <td>k</td>
                            <td><?php echo $po_product['PurchaseOrderProduct']['qty']; ?></td>
                            <td><?php echo $this->requestAction('App/get_supplier_name/'.$po_product['SupplierProduct']['supplier_id']); ?></td>
                            <td><?php echo $po_product['Client']['name']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--JAVASCRIPT METHODS-->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "orderable": true,
            "order": [[1,"desc"]],
            "stateSave": false
        });
        
    });
</script>
<!--END OF JAVASCRIPT METHODS-->