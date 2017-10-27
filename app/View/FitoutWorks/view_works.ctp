<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script>

    tinymce.init({
        selector: 'textarea',
        height: 150,
        menubar: false,
        plugins: [
            'autolink',
            'link',
            'codesample',
            'lists',
            'searchreplace visualblocks',
            'table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link',
    });
</script>

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
        <h1 class="page-header text-overflow">Fitout View Projects</h1>
    </div>

        
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class = "panel">
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="hidden" id="fitout_work_id" value="<?php echo $works['FitoutWork']['id']; ?>" readonly />
                        <br/>
                        
                        <label>Client <span class="text-danger">*</span></label>
                        <select id="client_id" class="form-control" disabled >
                            <option value="<?php echo $works['FitoutWork']['client_id'] ?>">
                                <?php echo $works['Client']['name']; ?>
                            </option>
                            
                            <?php foreach ($clients as $client) {
                                ?>
                                <option value="<?php echo $client['Client']['id']; ?>" >
                                    <?php echo $client['Client']['name']; ?>
                                </option>
                                <?php
                            } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Sales Executive</label>
                        <input type="text" id="sales_exec" class="form-control" value="<?php echo $works['User']['id']; ?>" disabled/>
                    </div>
                    
                   <div class="form-group">
                        <label>Designers</label>
                        <input type="text" id="designer" class="form-control"/>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Deliviries</label>
                        <input type="text" id="deliveries" class="form-control"/>
                    </div>
                    
                    <div class="form-group">
                        <label>Deadline</label>
                        <input type="date" id="deadline" class="form-control" value="<?php echo $works['FitoutWork']['deadline']; ?>" disabled/>
                    </div>
                    
                   <div class="form-group">
                        <label>Project Head <span class="text-danger">*</span></label>
                        
                        <select id="project_head_id" class="form-control" disabled>
                            <option value="<?php echo $works['User']['id'] ?>">
                                <?php echo $works['User']['first_name'].' '.$works['User']['last_name']; ?>
                            </option>
                            
                            <?php foreach ($users as $user) {
                                ?>
                                <option value="<?php echo $user['User']['id']; ?>" >
                                    <?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?>
                                </option>
                                <?php
                            } ?>
                        </select>
                    </div> 
 
                </div>
            </div>
        </div>
            
            
        <div class = "panel">
            <div class="panel-body">
                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Delivery date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Delivery date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
       <div class="panel">

         <div class="panel-heading" align="left">
 
                <div class="col-sm-1">
                    <div class="panel-title">Team</div>
                </div>

                <?php if(( $UserIn['User']['role'] == 'fitout_facilitator')){ ?>
                
                <div class="col-sm-1">
                    <button class="btn btn-success add-tooltip" data-toggle="tooltip" data-placement="right" data-original-title="Add new people involve" id="add_people" tooltip="Add new people involve"><i class="fa fa-plus"></i></button>
                </div>
                
                <?php } ?>
                
       
            </div>

                <div class="panel-body">
                <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php ?>
                    </tbody>
                </table>
            </div>
            </div>
       
    <div class="panel">
         <div class="panel-heading" align="left">
             <div class="col-sm-2">
                <h3 class="panel-title">Scope of work</h3>
            </div>
            <div class="col-sm-2">
                <?php if(( $UserIn['User']['role'] == 'fitout_facilitator')){ ?>
                    <button class="btn btn-success add-tooltip" data-toggle="tooltip" data-placement="right" data-original-title="Add new scope of work" id="add_work" tooltip="Add new scope of work"><i class="fa fa-plus"></i></button>
                <?php } ?>

            </div>
            </div>
            
            <div class="panel-body">
                <table id="example3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Work</th>
                            <th>Deadline</th>
                            <th>Expected Start</th>
                            <th>Date started</th>
                            <th>Date end</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Work</th>
                            <th>Deadline</th>
                            <th>Expected Start</th>
                            <th>Date started</th>
                            <th>Date end</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php ?>
                    </tbody>
                </table>
            </div>
            </div>
        
    </div>
</div>

<!--Add New people Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-people-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add new people involve</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                    <label>Employee<span class="text-danger">*</span></label>
                    <select class="form-control" id="employee">
                        <option value="0">Select an Employee</option>
                            <?php foreach($users as $user) { ?>
                                <option value="<?php echo $user['User']['id']; ?>"><?php echo $user['User']['first_name']." ".$user['User']['last_name']; ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="addPeople">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New people Modal End !-->

<!-- New scope of work Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-work-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add new scope of work</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
    			<div class="form-group">
				<textarea id="work"></textarea>
				</div>
                
                
               
                    <div class="form-group">
                         <label>Deadline</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="departure_date"> 
                    </div>

               
              
                    <div class="form-group">
                        <label>Expected start</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="departure_date"> 
                    </div>

             
                
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="addPeople">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New scope of work Modal End->


<!---JAVASCRIPT FUNCTIONS--->
<script>
    $('#add_people').on("click", function () {
        $('#add-people-modal').modal('show');
    });
    
    $('#add_work').on("click", function () {
        $('#add-work-modal').modal('show');
    });
    
    $(document).ready(function () {
        $('#example1').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $('#example2').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $('#example3').DataTable({
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