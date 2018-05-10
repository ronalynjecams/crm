<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            List of Top Purchased Supplier
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div rowspan="2">
                    <p>Select Type</p>
                    <select class="form-control" id="select_purchasing_dept">
                        <option value="raw">Raw</option>
                        <option value="supply">Supply</option>
                    </select>
                </div>
                <br/>

                <div class="table-responsive">
                    <table id="example"
                           class="table table-striped table-bordered"
                           cellspacing="0" width="100%"
                           data-sort-name="no_pur" data-sort-order="asc">
                        <thead>
                            <tr>
                                <th>Supplier</th>
                                <th data-field="no_pur" data-sortable="true">Number of times Purchased</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody id="here">
                            <?php
                            foreach($unique_array as $i=>$supplier) {
                                $id = $i;
                                $name = "<p class='text-danger'>Unknown</p>";
                                if($supplier['name']!="") {
                                    $name = $supplier['name'];
                                }
                                $grand_total = "&#8369; ".number_format((float)$supplier['grand_total'], 2, '.', ',');
                                $count = $supplier['count'];

                                echo '
                                    <tr>
                                        <td>'.$name.'</td>
                                        <td>'.$count.'</td>
                                        <td align="right">'.$grand_total.'</td>
                                    </tr>';
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
        
        $('select option[value="<?php echo $type; ?>"]').prop("selected", true);
        
        $("#select_purchasing_dept").change(function() {
            var purchasing_dept = $(this).val();
            window.location.replace("/purchase_order_products/supply_top_purchased?type="+purchasing_dept+"");
        }); 
    });
</script>
<!--END OF JAVASCRIPT METHODS-->