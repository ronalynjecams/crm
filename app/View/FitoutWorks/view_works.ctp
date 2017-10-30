<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>
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
        width: 100%;
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
                        <label><b>Client</b></label>
                        <p><?php echo h($works['Client']['name']); ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label><b>Sales Executive</b></label>
                         <p><?php echo h($works['User']['id']); ?></p>
                    </div>
                    
                   <div class="form-group">
                        <label><b>Designers</b></label>
                        <?php foreach($designers as $designer){ ?>
                          <p><?php echo h($designer['User']['first_name'])." ". h($designer['User']['last_name']); ?></p>
                        <?php } ?>
                    </div>
                    
                    <div class="form-group">
                        <label><b>Deadline</b></label>
                       <p><?php echo h($works['FitoutWork']['deadline']); ?></p>
                    </div>
                    
                   <div class="form-group">
                        <label><b>Project Head</b></label>
                            <p><?php echo h($works['User']['first_name']).' '.h($works['User']['last_name']); ?></p>
                    </div> 
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><b>Deliviries</b></label>
                            <?php foreach($quotations as $quotation){ ?>
                                    <p><li><?php echo $quotation['Quotation']['subject']; ?></li></p>
                            <?php } ?>
                    </div>
                
                </div>
            </div>
        </div>
            
            
        <div class = "panel">
            <div class="panel-body">
                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Quotation number</th>
                            <th>Delivery date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Quotation number</th>
                            <th>Delivery date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($deliviries as $delivery){ ?>
                        <tr>
                            <td><?php echo h($delivery['Quotation']['quote_number']); ?></td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($delivery['DeliverySchedule']['delivery_date']))); ?></td>
                            <td><?php echo h($delivery['DeliverySchedule']['type']); ?></td>
                            <td><?php echo h($delivery['DeliverySchedule']['status']); ?></td>
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
                            <td><?php echo h($people['User']['first_name']); ?></td>
                            <td><?php echo h($people['User']['last_name']); ?></td>
                            <td>
                             <?php 
                                if(( $UserIn['User']['role'] == 'fitout_facilitator' )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-sm-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip removeBtn" data-toggle="tooltip" href="#" data-original-title="remove" data-id="'.h($people['FitoutPerson']['id']).'"><i class="fa fa-remove"></i></a>';
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
                            <td><?php echo $fitout_work['FitoutTodo']['work']; ?></td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($fitout_work['FitoutTodo']['deadline']))); ?></td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($fitout_work['FitoutTodo']['expected_start']))); ?></td>
                            <td>
                               <?php if(( $UserIn['User']['role'] == 'fitout_facilitator' )){ 
                                   if(($fitout_work['FitoutTodo']['date_started'] == "" )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-xs-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editstartBtn" data-toggle="tooltip" href="#" data-original-title="Update date started" data-sid="'.h($fitout_work['FitoutTodo']['id']).'"><i class="fa fa-calendar icon-lg btn-primary"></i></a>';
                                         echo"</div>"; 
                                    echo"</div";
                                    
                                   }else{
                                        echo h(date('F d, Y h:i:a', strtotime($fitout_work['FitoutTodo']['date_started'])));
                                   }
                                }else{
                                    if($fitout_work['FitoutTodo']['date_started'] != ""){
                                        echo h(date('F d, Y h:i:a', strtotime($fitout_work['FitoutTodo']['date_started'])));

                                    }else{
                                        echo"<p>not available</p>";
                                    }
                                }
                                
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(( $UserIn['User']['role'] == 'fitout_facilitator' )){ 
                                    
                                        // if(( $fitout_work['FitoutTodo']['date_started'] != "" )){
                                        //     // echo"<div class='col-md-6'>";     
                                        //     //     echo h($fitout_work['FitoutTodo']['end_date']);
                                        //     // echo"</div>";

                                        // }
                                        
                                        if($fitout_work['FitoutTodo']['end_date'] == ""){
                                            echo"<div class='col-md-6'>";    
                                                echo"<div class='row'>";
                                                    echo"<div class='col-xs-1'>";
                                                        echo '<a class="btn btn-default btn-icon btn-sm add-tooltip editendBtn" data-toggle="tooltip" href="#" data-original-title="Update date ended" data-eid="'.h($fitout_work['FitoutTodo']['id']).'"><i class="fa fa-calendar btn-danger"></i></a>';
                                                    echo"</div>"; 
                                                echo"</div>";
                                            echo"</div>";
                                        }else{
                                            echo h(date('F d, Y h:i:a', strtotime($fitout_work['FitoutTodo']['end_date'])));
                                        }
              
                                    }else{
                                        if($fitout_work['FitoutTodo']['end_date'] != ""){
                                                echo h(date('F d, Y h:i:a', strtotime($fitout_work['FitoutTodo']['end_date'])));
                                           
                                        }else{
                                            echo"<p>not available</p>";
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
                    <input type="hidden" id="add_fitout_work_id" value="<?php echo h($works['FitoutWork']['id']); ?>" readonly />
                    <label>Employee<span class="text-danger">*</span></label>
                    <select class="form-control" id="employee">
                        <option value="0">Select an Employee</option>
                            <?php foreach($users as $user) { ?>
                                <option value="<?php echo h($user['User']['id']); ?>"><?php echo h($user['User']['first_name'])." ".h($user['User']['last_name']); ?></option>
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
<div class="modal fade" id="edit-datestart-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
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
</div>
<!--===================================================-->
<!-- Edit date_start Modal End->

<!-- Edit date_end Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-dateend-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit end date</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        
                        <div class="col-sm-6">
                             <input type="hidden" class="form-control"  id="e_id">  
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date_end"> 
                        </div>
                       
                        <div class="col-sm-6"> 
                            <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="time_end">
                        </div>
                        
                    </div>
                </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="editEnd">Add</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--===================================================-->
<!-- Edit date_end Modal End->

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
                $('#edit-datestart-modal').modal('show');

        });
        
    });
    
         $('#editStart').on("click", function () {
            var s_id = $('#s_id').val();
            var date_start = $('#date_start').val();
            var time_start = $('#time_start').val();

            if(( date_start != "")){
                if(( time_start != "" )){
                
                            var data = { "s_id": s_id, "date_start": date_start, "time_start": time_start }
                            
                    $.ajax({
                        url: "/fitout_works/edit_datestart",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        
                        success: function (id) {
                            location.reload();
                        },
                        erorr: function (id) {
                            alert('error!');
                        }
                    });
            
            }else{
               document.getElementById('date_start').style.borderColor = "red";
            }
            
            }else{
                document.getElementById('time_start').style.borderColor = "red";
            }
            
            
        });
        
        
        $(".editendBtn").each(function (index) {
        $(this).on("click", function () {
              var id = $(this).data('eid');
                
                $('#e_id').val(id);
                $('#edit-dateend-modal').modal('show');

        });
        
    });
    
         $('#editEnd').on("click", function () {
            var e_id = $('#e_id').val();
            var date_end = $('#date_end').val();
            var time_end = $('#time_end').val();

            if(( date_end != "")){
                if(( time_end != "" )){
                
                            var data = { "e_id": e_id, "date_end": date_end, "time_end": time_end }
                            
                    $.ajax({
                        url: "/fitout_works/edit_dateend",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',
                        
                        success: function (id) {
                            location.reload();
                        },
                        erorr: function (id) {
                            alert('error!');
                        }
                    });
            
            }else{
               document.getElementById('time_end').style.borderColor = "red";
            }
            
            }else{
                document.getElementById('date_end').style.borderColor = "red";
            }
            
            
        });




    $(".removeBtn").each(function (index) {
        $(this).on("click", function () {
           
            var id = $(this).data('id'); //this line gets value of data-id from delete button
            //alert(id)
            

            swal({
                title: "Confirmation message?",
                text: "Are you sure to delete this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            },

    //         function(isConfirm) {
    //             if (isConfirm) {
                    
    //                  var id = $(this).data('id'); 
                     
    //                 var data = {"id":id}
    //                 alert(data)

    //                     $.ajax({
    //                         url: "/fitout_works/delete_people",
    //                         type: 'POST',
    //                         data: {'data': data},
    //                         dataType: 'json',
    //                             success: function (id) {
    //                                 //location.reload();
    //                                 alert(id)
    //                         }
    //                     });
    //     } else {
    //         swal("Cancelled", " Action has been cancelled ", "error");
    //     }
        
    // });
    
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