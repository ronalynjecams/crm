

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  
<script src="../js/erp_js/quotation_list.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Pending Quotations</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if ($UserIn['User']['role'] == 'sales_executive') { ?>
                        <a class="btn btn-mint " href="/quotations/create" >
                            <i class="fa fa-plus"></i>  Add New Quotations
                        </a>
                    <?php } ?>
                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th> 
                            <th align="center"> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php // pr($pending_quotations);
                        foreach ($pending_quotations as $pending_quotation) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($pending_quotation['Quotation']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['created'])) . '</small>';
                                    ?> 
                                </td>
                                <td>
                                    <?php
                                    echo $pending_quotation['Client']['name'];
                                    echo '<br/><small>[' . $pending_quotation['Quotation']['quote_number'] . ']</small>';
                                    ?> 
                                </td> 
                                <td align="right">
                                    <?php
                                    echo '&#8369; ' . number_format($pending_quotation['Quotation']['grand_total'], 2);
                                    ?>
                                </td> 
                                <td>
                                    <?php
                                    if ($pending_quotation['Quotation']['job_request_id'] != 0) {
                                    if(count($pending_quotation['JobRequest']['JrProduct']) != 0) {
                                        ?>
                                        <div class="input-group mar-btm">
                                            <input type="text" class="form-control" placeholder="Name" readonly value="<?php echo $pending_quotation['JobRequest']['jr_number']; ?>">
                                            <span class="input-group-btn">
                                                <a href="/job_requests/view/<?php echo $pending_quotation['Quotation']['job_request_id'];?>" target="_blank" class="btn btn-mint add-tooltip" data-toggle="tooltip"  data-original-title="View Job Request"  type="button"><i class="fa fa-external-link"></i></a>
                                            </span>
                                        </div>
                                        <?php
                                    } else {
                                        echo '<br/><button class="btn btn-danger  add-tooltip" data-toggle="tooltip"  data-original-title="Update Job Request?"  type="button" id="jrupdateBtn" data-jobrid="'.$pending_quotation['Quotation']['job_request_id'].'"><i class="fa fa-exclamation-triangle"></i></button>';
                                    }
                                    }else{
                                       echo '<br/><button id="jobRequeBtn"  class="btn btn-default  add-tooltip" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" data-quoteid="'.$pending_quotation['Quotation']['id'].'"> Job Request ? </button>';
                                    }
                                    ?>
                                </td> 
                                <td> </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th>
                            <th align="center">Quotation</th>
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th> 
                            <th align="center">Job Request</th> 
                            <th> </th>  
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Add New Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Client</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label>Contact Person <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"   id="contact_person">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control"  id="position">
                </div>
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"   id="address">
                </div>
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control"   id="email">
                </div>
                <div class="form-group">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="contact_number">
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="text" class="form-control"  id="tin_number">
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveLead">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Add New Lead Modal End--> 
<!--Update Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="update-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Client</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="text" class="form-control"  id="lead_id">
                <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Name" id="uname">
                </div>
                <div class="form-group">
                    <label>Contact Person <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Contact Person" id="ucontact_person">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control" placeholder="Position" id="uposition">
                </div>
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Address" id="uaddress">
                </div>
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="Email Address" id="uemail">
                </div>
                <div class="form-group">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Contact Number" id="ucontact_number">
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="text" class="form-control" placeholder="TIN" id="utin_number">
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateLeads">Update</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Update Modal End--> 

<script>


 


</script>