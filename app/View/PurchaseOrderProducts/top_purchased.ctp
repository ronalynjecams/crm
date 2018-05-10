<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            List of Top Purchased Products
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <?php 
                if ($dept_of_authuser == "Proprietor" || $userRole == "purchasing_supervisor") { ?>
                <div rowspan="2">
                <select class="form-control" id="select_purchasing_dept">
                    <option>Select Purchasing Department</option>
                    <?php 
                        foreach($depts as $dept) {
                            $dept_id = $dept['Department']['id'];
                            $dept_name = $dept['Department']['name'];
                            echo '<option value="'.$dept_id.'">'.$dept_name.'</option>';
                        }
                    ?>
                </select>
                </div>
                <?php } ?>
                <br/>
                <div class="table-responsive">
                    <table id="example"
                           class="table table-striped table-bordered"
					       cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th data-field="no_pur" data-sortable="true">Number of times Purchased</th>
                                <th>Grand Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="here">
                            <?php
                            // echo pr($unique_array_of_products);
                            foreach($get_product as $ret_product) {
                                $product_obj = $ret_product['Product'];
                                $product_id = $product_obj['id'];
                                $product_name = '<font class="text-danger">Unknown</font>';
                                if($unique_array_of_products[$product_id]['name']!="") {
                                    $product_name = $unique_array_of_products[$product_id]['name'];
                                }
                                $count = $unique_array_of_products[$product_id]['count'];
                                $grand_total = "&#8369; ".number_format((float)$unique_array_of_products[$product_id]['grand_total'], 2, '.', ',');
                                
                                echo '<tr>';
                                echo '<td>'.$product_name.'</td>';
                                echo '<td>'.$count.'</td>';
                                echo '<td align="right">'.$grand_total.'</td>';
                                ?>
                                <td>
                                    <a target="_blank" href="/purchase_order_products/ordered_history?id=<?php echo $product_id; ?>"
                                       style="color:white">
                                        <button class="btn btn-primary"
                                            data-toggle="tooltip"
                                            date-placement="left"
                                            title="View Ordered History">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                    </a>
                                </td>
                                <?php
                                echo '</tr>';
                            }
                            ?>
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
        
        $('select option[value="<?php echo $passed_dept; ?>"]').prop("selected", true);
        
        $("#select_purchasing_dept").change(function() {
            var purchasing_dept = $(this).val();
            window.location.replace("/purchase_order_products/top_purchased?dept="+purchasing_dept+"");
        }); 
    });
</script>
<!--END OF JAVASCRIPT METHODS-->