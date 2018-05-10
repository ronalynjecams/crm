<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="/css/plug/select/js/select2.min.js"></script>
<script src="/js/erp_scripts.js"></script>

<!-- REQUIRED FOR MULTIPLE SELECT ON QUOTATION -->
<link href="/css/plug/chosen/chosen.min.css" rel="stylesheet">
<script src="/css/plug/chosen/chosen.jquery.min.js"></script>

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Official Businesses</h1>
    </div>

        
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
            <div class="row">
        <div class="col-sm-12">
            <div class="panel">

             <div class="panel-heading" align="left">
                 <div class="panel-control">
                        <?php #if ($UserIn['User']['role'] == 'fitout_facilitator') { ?>
                           
                        <?php #} ?> </h3>
                     
                </div>
                
            </div>
           
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date created</th>
                            <th>Requested By</th>
                            <th>Purpose</th>
                            <th>Expected Departure</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date created</th>
                            <th>Requested By</th>
                            <th>Purpose</th>
                            <th>Expected Departure</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($all_official_business_lists as $all_official_business_list){ ?>
                        <tr>
                            <td><?php echo time_elapsed_string($all_official_business_list['OfficialBusiness']['created']); ?></td>
                            <td>
                            <?php echo h($all_official_business_list['OfficialBusiness']['User']['first_name'])." ".h($all_official_business_list['OfficialBusiness']['User']['last_name']) ?>
                            </td>
                            <td>
                            <?php
                                echo"<p><i class='fa fa-group'></i>&nbsp;<b>".h($all_official_business_list['OfficialBusiness']['company_name'])."</b></p>"; //or $my_official_business_list['OfficialBusiness']['company_name'] name of company
                                echo"<p><i class='fa fa-plus'></i>&nbsp;".h($all_official_business_list['OfficialBusiness']['purpose'])."</p>";
                            ?>
                            </td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($all_official_business_list['OfficialBusiness']['expected_departure']))); ?></td>
                            <td>
                                <?php  
                                    if($all_official_business_list['OfficialBusiness']['status'] == "pending"){
                                ?>
                                        <button class="btn btn-sm btn-primary info add-tooltip updateBtn" data-toggle="tooltip"  data-original-title="Update" data-uid="<?php echo h($all_official_business_list['OfficialBusiness']['id']); ?>"><i class="fa fa-edit"></i>&nbsp;</button>
                                        <button class="btn btn-sm btn-danger info add-tooltip rejectBtn" data-toggle="tooltip"  data-original-title="reject" data-rid="<?php echo h($all_official_business_list['OfficialBusiness']['id']); ?>"><i class="fa fa-remove"></i>&nbsp;</button>
                                <?php   
                                    }else if($all_official_business_list['OfficialBusiness']['status'] == "approved"){
                                ?>
                                        <button class="btn btn-sm btn-primary info add-tooltip approveBtn" data-toggle="tooltip"  data-original-title="Approved" data-aid="<?php echo h($all_official_business_list['OfficialBusiness']['id']); ?>"><i class="fa fa-check"></i>&nbsp;Approve</button>
                                <?php 
                                    }else{
                                        echo"Not available";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>

</div>
<!-- Edit product Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-report-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Report</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                       
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



<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
        
        $('#example1').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });

        $(".updateBtn").each(function (index) {
        $(this).on("click", function () {
                var id = $(this).data('uid');

                    var data = { "id":id } 

                        $.ajax({
                            url: "/OfficialBusinesses/update_status",
                            type: 'POST',
                            data: {'data': data},
                            dataType: 'json',
                                success: function (id) {
                                    location.reload();

                            }
                    });
        });
    });
    
    $(".approveBtn").each(function (index) {
        $(this).on("click", function () {
                var id = $(this).data('aid');

                    var data = { "id":id } 

                        $.ajax({
                            url: "/OfficialBusinesses/approve",
                            type: 'POST',
                            data: {'data': data},
                            dataType: 'json',
                                success: function (id) {
                                    location.reload();

                            }
                    });
                
        });
    });
      
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