<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="../css/sweetalert.css" rel="stylesheet">
<!--<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
<script src="../js/sweetalert.min.js"></script>  


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
                        <?php foreach ($inventory as $data) { ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($data['InventoryJobOrder']['created']));
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
                                    <?php echo $data['InventoryJobOrder']['processed_qty']; ?>
                                </td>
                                <td>
                                    <?php
                                    if (!is_null($data['DeliveryItenerary']['departure'])) {
                                        if (!is_null($data['DeliveryItenerary']['actual_start'])) {
                                            echo'<div class="col-md-6">';
                                            echo date('F d, Y', strtotime($data['DeliveryItenerary']['actual_start']));
                                            echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['actual_start'])) . '</small>';
                                            echo'</div>';
                                            if (!is_null($data['DeliveryItenerary']['end_work'])) {
                                                echo'<div class="col-md-6">';
                                                echo ' to ';
                                                echo date('F d, Y', strtotime($data['DeliveryItenerary']['end_work']));
                                                echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['end_work'])) . '</small>';
                                                echo'</div>';
                                            } else {
                                                echo'<div class="col-md-6">';
                                                echo '<button class="btn btn-xs btn-default update_end" data-toggle="tooltip"  data-original-title="Update end date" data-endid="' . $data['DeliveryItenerary']['id'] . '" data-buttontype="end"><i class="fa fa-calendar-plus-o"></i></button>';
                                                echo'</div>';
                                            }
                                        } else {
                                            
                                            //update actual start
                                            if( $data['DeliveryItenerary']['actual_start'] == "" ){
                                                echo '<button class="btn btn-xs btn-success update_actualstart" data-toggle="tooltip"  data-original-title="Update actual start date" data-actid="' . $data['DeliveryItenerary']['id'] . '" data-buttontype="start"><i class="fa fa-calendar-plus-o"></i></button>';
                                            }
                                        }
                                    } else {
                                        echo '<small>Waiting to depart</small>';
                                    }
                                    ?>  
                                </td> 
                                <td>
                                    
                                    
                                    <?php
                                    if ($data['DeliveryItenerary']['delivery_mode'] == 'jecams') {
                                        //change vehicle_id ( select vehicle , value should be brand - plate number)
                                        //change driver (query users, value of option should be first name and last name)
                                    } else if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify') {
                                       //update booking code
                                    }
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
<!-- UPDATE MODAL ACTUAL START-->
<div class="modal fade" id="updateActualstart-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Actual Start</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                <input type="text" class="form-control"  id="actual_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-6">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="actual_date"> 
                    </div>
                    <div class="col-sm-6"> 
                        <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="actual_time">
                    </div>
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateActualBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL ACTUAL START END-->



<!-- UPDATE MODAL  END-->
<div class="modal fade" id="updateEnd-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update End work</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                <input type="hidden" class="form-control"  id="end_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-6">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="end_date"> 
                    </div>
                    <div class="col-sm-6"> 
                        <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="end_time">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="status">
                    <option value="none">Please select a status</option>
                    <option value="delivered">delivered</option>
                    <option value="cancelled">cancelled</option>
                    <option value="backjob">backjob</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea id="remarks" row="40" class="form-control"></textarea>
                </div>
                
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateEndBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL END-->



<!-- UPDATE MODAL DEPARTURE START-->
<div class="modal fade" id="updateDeparture-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Departure</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="dep_itenerary_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-6">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="departure_date"> 
                    </div>
                    <div class="col-sm-6"> 
                        <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="departure_time">
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateDepartureBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL DEPARTURE END-->

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true

        });
    });
</script>