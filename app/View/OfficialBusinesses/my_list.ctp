<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>

<!-- REQUIRED FOR MULTIPLE SELECT ON QUOTATION -->
<link href="../plugins/chosen/chosen.min.css" rel="stylesheet">
<script src="../plugins/chosen/chosen.jquery.min.js"></script>

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
                            <th>Expected departure</th>
                            <th>Purpose</th>
                            <th>Report</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date created</th>
                            <th>Expected departure</th>
                            <th>Purpose</th>
                            <th>Report</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($my_official_business_lists as $my_official_business_list){ ?>
                        <tr>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($my_official_business_list['OfficialBusiness']['created']))); ?></td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($my_official_business_list['OfficialBusiness']['expected_departure']))); ?></td>
                            <td>
                            <?php 
                                echo"<p><i class='fa fa-group'></i>&nbsp;<b>".h($my_official_business_list['OfficialBusiness']['Client']['name'])."</b></p>";
                                echo"<p><i class='fa fa-plus'></i>&nbsp;".h($my_official_business_list['OfficialBusiness']['purpose'])."</p>";
                            ?>
                            </td>
                            <td>
                                <?php  
                                    if($my_official_business_list['OfficialBusiness']['status'] == "hr_approved"){
                                ?>
                                        <button class="btn btn-sm btn-primary info add-tooltip btn-report" data-toggle="tooltip"  data-original-title="Report" data-uobid="<?php echo h($my_official_business_list['OfficialBusiness']['id']); ?>" data-uobreport="<?php echo h($my_official_business_list['OfficialBusinessReport']['report']); ?>"><i class="fa fa-eye"></i>&nbsp;</button>
                                <?php   
                                    }else{
                                        echo"<p>Not available</p>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($my_official_business_list['OfficialBusiness']['status'] == "pending"){
                                ?>
                                      <button class="btn btn-sm btn-danger add-tooltip btn-cancel" data-toggle="tooltip"  data-original-title="Cancel" data-dobid="<?php echo h($my_official_business_list['OfficialBusiness']['id']); ?>"><i class="fa fa-remove icon-lg"></i>&nbsp;</button>     
                                <?php    
                                    }else{
                                        echo"<p>Not available</p>";
                                        
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
                <div class="form-group">
                    <input type="hidden" id="o_bid" >
                        <div class="row">
                            <div class="col-sm-12">
                                <p id="report"></p>
                            </div>
                        <div>
                </div>
                </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
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

        $(".btn-report").each(function (index) {
        $(this).on("click", function () {
              var id = $(this).data('uobid');
              var report = $(this).data('uobreport');
            //   var qtyrepair = $(this).data('qtyrepair');
            //   var qtychop = $(this).data('qtychop');
            //   var minstock = $(this).data('minstock');

                $('#o_bid').val(id);
                $('#report').html(report);
            //     $('#u_qtyrepair').val(qtyrepair);
            //     $('#u_qtychop').val(qtychop);
            //     $('#u_minstock').val(minstock);
                
                $('#edit-report-modal').modal('show');
        });
    });
      
    })
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