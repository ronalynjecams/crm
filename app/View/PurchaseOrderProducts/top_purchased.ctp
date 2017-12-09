<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

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
                if ($dept_of_authuser == "Proprietor") { ?>
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
					       cellspacing="0" width="100%"
    					   data-sort-name="no_pur" data-sort-order="asc">
                        <thead>
                            <tr>
                                <!--<th>#</th>-->
                                <th>Product</th>
                                <th>Description</th>
                                <th data-field="no_pur" data-sortable="true">Number of times Purchased</th>
                            </tr>
                        </thead>
                        <tbody id="here">
                            <?php
                                $count = 0;
                                
                                foreach ($products as $product) {
                                $count++;
                                $pc_id = 0;
                                $product_name = $product['Product']['name'];
                                $product_id = $product['Product']['id'];
                                ?>
                                <tr>
                                    <!--<td><?php //echo $count; ?></td>-->
                                    <td><?php echo $product_name.' <div class="ordering"></div>'; ?></td>
                                    <?php
                                        if(!empty($product_combos[$product_id])) {
                                            foreach($product_combos[$product_id] as $product_combo) {
                                                $pc_id = $product_combo['ProductCombo']['id'];
                                                $ordering = $product_combo['ProductCombo']['ordering'];
                                                $desc = [];
                                                foreach($product_combo['ProductComboProperty'] as $product_combo_prop) {
                                                    $product_combo_prop_prop = $product_combo_prop['property'];
                                                    $product_combo_prop_val = $product_combo_prop['value'];
                                                    $desc[] = "<font style='font-weight:bold'>".ucwords($product_combo_prop_prop)."</font>".' : '.ucwords($product_combo_prop_val);
                                                }
                                            }
                                        }
                                        
                                        if(empty($po_counts[$product_id][$pc_id])) {
                                            $c = 0;
                                        }
                                        else {
                                            $c = count($po_counts[$product_id][$pc_id]);
                                        }
                                        
                                        echo '<td>';
                                        if(!empty($desc)) {
                                            for($i=0;$i<count($desc);$i++) {
                                                if($desc[$i]!="") {
                                                    echo "<p>".$desc[$i]."</p>";
                                                }
                                            }
                                        }
                                        else {
                                            echo 'No Data';
                                        }
                                        echo '</td>';
                                        
                                        echo '<td>'.$c.'</td>';
                                    ?>
                                </tr>
                            <?php } ?>
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
            "order": [[2,"desc"]],
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