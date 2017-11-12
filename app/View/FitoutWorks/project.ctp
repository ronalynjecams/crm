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

<!--CONTENT CONTAINER-->

<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Fitout Work Projects</h1>
    </div>

        
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">
                    <?php if (($UserIn['User']['role'] == 'fitout_facilitator')) { ?>
                    
                    <a style="color:white;font-weight:bold;" href="/fitout_works/add_fitout_works_view?status=<?php echo $passed_status; ?>"
                        class="btn btn-mint">
                        <i class="fa fa-plus"></i>  Add New Fitout Work
                    </a>
                    <?php } ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Deadline Date</th>
                            <th>Expected Start</th>
                            <th>Project Head</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Deadline Date</th>
                            <th>Expected Start</th>
                            <th>Project Head</th>
                            <th>Status</th>  
                            <th>Action</th>  
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fitoutworks as $fitoutwork) { ?>
                        <tr>
                            <td><?php echo $fitoutwork['FitoutWork']['deadline']; ?></td>
                            <td><?php echo $fitoutwork['FitoutWork']['expected_start']; ?></td>
                            <td><?php echo $fitoutwork['User']['last_name'].' '.$fitoutwork['User']['first_name']; ?></td>
                            <td><?php echo ucwords($fitoutwork['FitoutWork']['status']); ?></td>
                            <td class='text-center'>
                                <a style="color:white;font-weight:bold;" href="/fitout_works/view_works?id=<?php echo $fitoutwork['FitoutWork']['id']; ?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                               
                                <a style="color:white;font-weight:bold;" href="/fitout_works/edit_fitout_works?id=<?php echo $fitoutwork['FitoutWork']['id']; ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                
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

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
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