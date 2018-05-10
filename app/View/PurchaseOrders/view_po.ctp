
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
        echo time_elapsed_string($po['PurchaseOrder']['created']);
        echo '<p><small> ' . date('h:i a', strtotime($po['PurchaseOrder']['created'])) . '</small></p>';
            
                // if($po['PurchaseOrder']['payment_request'] == 0){
                //     echo '<p class="text-danger">No Payment Request</p>';
                // }else{
                //     echo '<p class="text-primary">Payment Requested: &#8369; '.number_format($po['PurchaseOrder']['payment_request'],2).'</p>';
                // }
                // echo '<p>schedule delivery per product</p>';
            
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
                            <th>Client</th>
                            <th>Date Created</th> 
                            <th>Image</th>
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
                        // pr($po['PurchaseOrderProduct'] );
                        foreach ($po['PurchaseOrderProduct'] as $po_products) {
                            $po_products_client_id = $po_products['client_id'];
                            ?>
                            <tr>
                                <td> 
                                    <?php
                                    if(!is_null($po_products_client_id) || $po_products_client_id!=0){
                                        echo $po_products['Client']['name'];
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
                                    echo $po_products['ProductCombo']['Product']['name']; 
                                    ?>
                                </td>
                                <td><?php echo abs($po_products['qty']); ?> 
                                </td> 
                                <td> <?php echo '&#8369; ' .number_format($po_products['list_price'],2); ?> </td> 
                                <?php
                                $total = $po_products['qty'] * $po_products['list_price'];
                                ?>
                                <td> <?php echo '&#8369; ' .number_format($total,2); ?></td> 
                            </tr>
                            <?php
                            $total_purchased = $total_purchased + $total;
                            $ctrr++;
                        }
                        ?>

                        <tr >
                            <td colspan="5" align="right"> </td>  
                            <td align="right"><div class="discountDiv"><b>Discount:</b></div></td>  
                            <td align="right"> 
                                <div class="discountDiv"><?php echo '&#8369; ' .number_format($po['PurchaseOrder']['discount'],2); ?> </div></td>  

                        </tr> 
                        <tr>
                            <td colspan="6" align="right"><b>Total Purchased</b></td>   
                             <td align="right">   <?php echo '&#8369; ' .number_format($po['PurchaseOrder']['total_purchased'],2); ?> </td>  
                        </tr>
                        <tr >
                            <td colspan="5" align="right"> </td>  
                            <td align="right">VAT </td>  
                            <td align="right"> 
                                <?php echo '&#8369; ' .number_format($po['PurchaseOrder']['vat_amount'],2); ?> </td>  

                        </tr>

<!--                        <tr id="totalTR">
                            <td colspan="5" align="right"><div class="totDiv"><b>Total:</b></div></td>  
                            <td><div class="totDiv"><input type="text" id="total" class="form-control" readonly/></div></td>  
                        </tr>-->

                        <tr>
                            <td colspan="6" align="right">
                                EWT
                            </td>
                            <td align="right">
                                <?php echo '&#8369; ' .number_format($po['PurchaseOrder']['ewt_amount'],2); ?></td>  
                        </tr>
                        <tr>
                            <td colspan="6" align="right"><b>Total Amount Due:</b></td>  
                            <td align="right"> <?php echo '&#8369; ' .number_format($po['PurchaseOrder']['grand_total'],2); ?> </td>  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         
    </div>
</div>
</div>


 