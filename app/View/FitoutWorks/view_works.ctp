<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
<style>
    #add_work{
        margin-top: 10px;
    }
    
    #add_people{
        margin-top: 10px;
    }
</style>
<!--CONTENT CONTAINER-->

<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow animated fadeInDown">Fitout View Projects</h1>
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
                        <select id="designers" class="form-control">
                        <option value="0">Please select a designer</option>
                        <?php foreach($designers as $designer){ ?>
                        <option value="<?php echo $designer['JrProduct']['user_id']; ?>"><?php echo  $designer['JrProduct']['user_id']; ?></option>
                        <?php } ?>
                        </select>
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
                        <?php foreach($deliviries as $delivery){ ?>
                        <tr>
                            <td><?php echo $delivery['DeliverySchedule']['delivery_date']; ?></td>
                            <td><?php echo $delivery['DeliverySchedule']['type']; ?></td>
                            <td><?php echo $delivery['DeliverySchedule']['status']; ?></td>
                        </tr>
                        <?php } ?>
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
                        <?php foreach($peoples as $people){ ?>
                        <tr>
                            <td><?php echo $people['User']['first_name']; ?></td>
                            <td><?php echo $people['User']['last_name']; ?></td>
                            <td>
                             <?php 
                                if(( $UserIn['User']['role'] == 'fitout_facilitator' )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-sm-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip removeBtn" data-toggle="tooltip" href="#" data-original-title="remove" data-id="'.$works['FitoutWork']['id'].'"><i class="fa fa-remove"></i></a>';
                                         echo"</div>"; 
                                    echo"</div";
                                } 
                            ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </div>
       
    <div class="panel">
         <div class="panel-heading" align="left">

             <div class="col-sm-2">
                <h3 class="panel-title">Scope of work</h3>
            </div>
            <div class="col-sm-1">
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
                        <?php foreach($fitout_works as $fitout_work){ ?>
                        <tr>
                            <td><?php echo $fitout_work['FitoutTodo']['work'] ?></td>
                            <td><?php echo $fitout_work['FitoutTodo']['deadline'] ?></td>
                            <td><?php echo $fitout_work['FitoutTodo']['expected_start'] ?></td>
                            <td>
                               <?php if(( $UserIn['User']['role'] == 'fitout_facilitator' )){ 
                                    echo"<div class='row'>";
                                        echo"<div class='col-sm-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editstartBtn" data-toggle="tooltip" href="#" data-original-title="Update date started" data-sid="'.$fitout_work['FitoutTodo']['id'].'"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                         echo"</div>"; 
                                    echo"</div";
                                } ?>
                            </td>
                            <td>
                                <?php 
                                    if(( $UserIn['User']['role'] == 'fitout_facilitator' )){ 
                                    
                                        if(( $fitout_work['FitoutTodo']['date_started'] != "" )){
                                            echo"<div class='row'>";
                                                echo"<div class='col-sm-1'>";
                                                    echo '<a class="btn btn-default btn-icon add-tooltip editendBtn" data-toggle="tooltip" href="#" data-original-title="Update date ended" data-eid="'.$fitout_work['FitoutTodo']['id'].'"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                                echo"</div>"; 
                                            echo"</div";
                                        }
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
                    <input type="hidden" id="add_fitout_work_id" value="<?php echo $works['FitoutWork']['id']; ?>" readonly />
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
    			    <label>Work</label>
				<textarea id="work_details"></textarea>
				</div>
                
                    <div class="form-group">
                         <label>Deadline</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="deadline_date"> 
                    </div>

                    <div class="form-group">
                        <label>Expected start</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="exp_start_date"> 
                    </div>
                
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="addWork">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New scope of work Modal End->


<!-- Edit date_start Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-date-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit start date</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        
                        <div class="col-sm-6">
                             <input type="hidden" class="form-control"  id="s_id">  
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date_start"> 
                        </div>
                       
                        <div class="col-sm-6"> 
                            <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="time_start">
                        </div>
                        
                    </div>
                </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="editStart">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!-- Edit date_start Modal End->


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
        
        
    $('#addPeople').on("click", function () {
        var employee = $('#employee').val();
        var add_fitout_work_id = $('#add_fitout_work_id').val();

            if((employee != 0)){
                                
                var data = {"employee": employee, "add_fitout_work_id": add_fitout_work_id }
                            $.ajax({
                                url: "/fitout_works/add_people",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                    location.reload(true);

                                },
                                error: function() {
                                    alert('error!')
                                }
                            });
                            
        } else {
            document.getElementById('employee').style.borderColor = "red";
        }
        
    });
    
    
     $('#addWork').on("click", function () {
        var work_details = tinymce.get('work_details').getContent();
        var deadline_date = $('#deadline_date').val();
        var exp_start_date = $('#exp_start_date').val();
                                
                                
            if((work_details != '' )){
                 if((deadline_date != '' )){
                      if((exp_start_date != '' )){
                        var data = {"work_details": work_details, "deadline_date": deadline_date, "exp_start_date": exp_start_date }

                            $.ajax({
                                url: "/fitout_works/add_work",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                    location.reload(true);
                                },
                                error: function() {
                                    alert('error!')
                                }
                            });
            }else{
                document.getElementById('exp_start_date').style.borderColor = "red";
            }
            
            }else{
                document.getElementById('deadline_date').style.borderColor = "red";
            }
            
            }else{
                alert('please enter work details')
            }

    });

        $(".editstartBtn").each(function (index) {
        $(this).on("click", function () {
              var id = $(this).data('sid');
                
                $('#s_id').val(id);
                $('#edit-date-modal').modal('show');

        });
        
        });

/*
    $(".removeBtn").each(function (index) {
        $(this).on("click", function () {

          //AJAX CALL TO DELETE RECORDS FROM DATABASE


        });*/
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