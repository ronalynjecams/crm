<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
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

    .table-condensed{
      font-size: 12px;
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

    <div class="row">
        <div class="col-sm-6">
            <div class = "panel">
                <div class="panel-body">
                    <h3><strong>Project Information</strong></h3>
                    <hr>
                    <div class="form-group">
                        <input type="hidden" id="fitout_work_id" value="<?php echo $works['FitoutWork']['id']; ?>" readonly />
                        <label><b>Client: </b></label>
                        <?php echo h($works['Client']['name']); ?>
                    </div>

                    <div class="form-group">
                        <label><b>Sales Executive: </b></label>
                        <?php foreach($selected_quotations as $selected_quotation){ ?>
                         <?php echo h($selected_quotation['User']['first_name'])." ". h($selected_quotation['User']['last_name']); ?>
                        <?php } ?>
                    </div>

                   <div class="form-group">
                        <label><b>Designers: </b></label>
                         <?php foreach($designers as $designer){ ?>
                         <?php echo h($designer['User']['first_name'])." ". h($designer['User']['last_name']); ?>
                        <?php } ?>

                    </div>

                    <div class="form-group">
                        <label><b>Deadline: </b></$selected_quotation)>
                       <?php echo h($works['FitoutWork']['deadline']); ?>
                    </div>

                   <div class="form-group">
                        <label><b>Project Head: </b></label>
                        <?php echo h($works['User']['first_name']).' '.h($works['User']['last_name']); ?>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel">

                <div class="panel-heading" align="left">
                    <div class="panel-control">
                        <button class="btn btn-default" data-target="#delivery-panel-collapse" data-toggle="collapse"><i class="glyphicon glyphicon-chevron-down"></i></button>
                    </div>
                    <h3 class="panel-title">Delivery details</h3>

                </div>
                <div id="delivery-panel-collapse" class="collapse out">
                <div class="panel-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Quotation id</th>
                            <th>Quotation number</th>
                            <th>Delivery date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Quotation id</th>
                            <th>Quotation number</th>
                            <th>Delivery date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($delivery_schedules as $delivery_schedule){ ?>
                        <tr>
                            <td><?php echo h($delivery_schedule['Quotation']['id']); ?></td>
                            <td><?php echo h($delivery_schedule['Quotation']['quote_number']); ?></td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($delivery_schedule['DeliverySchedule']['delivery_date']))); ?></td>
                            <td><?php echo h($delivery_schedule['DeliverySchedule']['type']); ?></td>
                            <td><?php echo h($delivery_schedule['DeliverySchedule']['status']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel">

                 <div class="panel-heading" align="left">
                    <div class="panel-control">
                            <?php if(( $UserIn['User']['role'] == 'fitout_facilitator')){ ?>
                            <button class="btn btn-success add-tooltip btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Add new people involve" id="add_people" tooltip="Add new people involve"><i class="fa fa-plus"></i></button>
                            <?php } ?>

                            <button class="btn btn-default" data-target="#team-panel-collapse" data-toggle="collapse"><i class="glyphicon glyphicon-chevron-down"></i></button>
                    </div>
                    <h3 class="panel-title">Team</h3>
               </div>

            <div id="team-panel-collapse" class="collapse out">
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
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
                                            echo '<a class="btn btn-default btn-icon add-tooltip removeBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="remove" data-id="'.h($people['User']['id']).'"><i class="fa fa-remove"></i></a>';
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading" align="left">

                     <div class="panel-control">
                            <?php if(( $UserIn['User']['role'] == 'fitout_facilitator')){ ?>
                                <button class="btn btn-success add-tooltip btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Add new scope of work" id="add_work" tooltip="Add new scope of work"><i class="fa fa-plus"></i></button>
                            <?php } ?>
                            <button class="btn btn-default" data-target="#work-panel-collapse" data-toggle="collapse"><i class="glyphicon glyphicon-chevron-down"></i></button>
                    </div>

                    <h3 class="panel-title">Scope of work</h3>
                </div>
                <div id="work-panel-collapse" class="collapse out">
                <div class="panel-body">
                    <div class="table-responsive">
                    <table id="example3" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" width="100%">
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
                        <?php foreach($fitout_todos as $fitout_todo){ ?>
                        <tr>
                            <td><?php echo $fitout_todo['FitoutTodo']['work']; ?></td>
                            <td><?php echo h(date('F d, Y', strtotime($fitout_todo['FitoutTodo']['deadline']))); ?></td>
                            <td><?php echo h(date('F d, Y', strtotime($fitout_todo['FitoutTodo']['expected_start']))); ?></td>
                            <td>
                               <?php if(( $UserIn['User']['role'] == 'fitout_facilitator' )){
                                   if(($fitout_todo['FitoutTodo']['date_started'] == "" )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-xs-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editstartBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="Update date started" data-sid="'.h($fitout_todo['FitoutTodo']['id']).'"><i class="fa fa-calendar icon-lg btn-primary"></i></a>';
                                         echo"</div>";
                                    echo"</div";

                                   }else{
                                        echo h(date('F d, Y h:i:a', strtotime($fitout_todo['FitoutTodo']['date_started'])));
                                   }
                                }else{
                                    if($fitout_todo['FitoutWork']['date_started'] != ""){
                                        echo h(date('F d, Y h:i:a', strtotime($fitout_todo['FitoutTodo']['date_started'])));

                                    }else{
                                        echo"<p>not available</p>";
                                    }
                                }

                                ?>
                            </td>
                            <td>
                                <?php
                                    if(( $UserIn['User']['role'] == 'fitout_facilitator' )){

                                        if(( $fitout_todo['FitoutTodo']['date_started'] != "" )){

                                            if($fitout_todo['FitoutTodo']['end_date'] == ""){
                                                echo"<div class='col-md-6'>";
                                                    echo"<div class='row'>";
                                                        echo"<div class='col-xs-1'>";
                                                            echo '<a class="btn btn-default btn-icon btn-sm add-tooltip editendBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="Update date ended" data-eid="'.h($fitout_todo['FitoutTodo']['id']).'"><i class="fa fa-calendar btn-danger"></i></a>';
                                                        echo"</div>";
                                                    echo"</div>";
                                                echo"</div>";
                                            }else{
                                                echo h(date('F d, Y h:i:a', strtotime($fitout_todo['FitoutTodo']['end_date'])));
                                            }

                                        }else{
                                          echo"<p>not available</p>";
                                        }

                                    }else{

                                        if($fitout_todo['FitoutTodo']['end_date'] != ""){
                                                echo h(date('F d, Y h:i:a', strtotime($fitout_todo['FitoutTodo']['end_date'])));

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
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">

             <div class="panel-heading" align="left">
                 <div class="panel-control">
                        <?php if ($UserIn['User']['role'] == 'fitout_facilitator') { ?>
                            <button class="btn btn-success btn-sm add-tooltip" id="addReqdoc" data-toggle="tooltip" data-placement="bottom" data-original-title="Add required documents"><i class="fa fa-plus"></i></button>
                        <?php } ?> </h3>
                     <button class="btn btn-default" data-target="#documents-panel-collapse" data-toggle="collapse"><i class="glyphicon glyphicon-chevron-down"></i></button>
                </div>
                <h3 class="panel-title">Documents required</h3>
            </div>
            <div id="documents-panel-collapse" class="collapse out">
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Document title</th>
                            <th>Quotation number</th>
                            <th>Date needed</th>
                            <th>Date acquired</th>
                            <th>Date processed</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Document title</th>
                            <th>Quotation number</th>
                            <th>Date needed</th>
                            <th>Date acquired</th>
                            <th>Date processed</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($required_docs as $required_doc){ ?>
                        <tr>
                            <td><?php echo h($required_doc['DrPaper']['name']); ?></td>
                            <td><?php echo h($required_doc['Quotation']['quote_number']); ?></td>
                            <td><?php echo h(date('F d, Y h:i:a', strtotime($required_doc['DeliveryPaper']['date_needed']))); ?></td>
                            <td>
                               <?php
                                if(( $UserIn['User']['role'] == 'fitout_facilitator' )){
                                   if(($required_doc['DeliveryPaper']['date_acquired'] == "" )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-xs-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editdaBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="Update date acquired" data-daid="'.h($required_doc['DeliveryPaper']['id']).'"><i class="fa fa-calendar icon-lg btn-primary"></i></a>';
                                         echo"</div>";
                                    echo"</div";

                                   }else{
                                        echo h(date('F d, Y h:i:a', strtotime($required_doc['DeliveryPaper']['date_acquired'])));
                                   }
                                }else{
                                    if($required_doc['DeliveryPaper']['date_acquired'] != ""){
                                        echo h(date('F d, Y h:i:a', strtotime($required_doc['DeliveryPaper']['date_acquired'])));

                                    }else{
                                        echo"<p>not available</p>";
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(( $UserIn['User']['role'] == 'fitout_facilitator' )){

                                        if(( $required_doc['DeliveryPaper']['date_acquired'] != "" )){

                                            if($required_doc['DeliveryPaper']['date_processed'] == ""){
                                                echo"<div class='col-md-6'>";
                                                    echo"<div class='row'>";
                                                        echo"<div class='col-xs-1'>";
                                                            echo '<a class="btn btn-default btn-icon btn-sm add-tooltip editdpBtn btn-xs" data-toggle="tooltip" href="#" data-original-title="Update date processed" data-dpid="'.h($required_doc['DeliveryPaper']['id']).'"><i class="fa fa-calendar btn-danger"></i></a>';
                                                        echo"</div>";
                                                    echo"</div>";
                                                echo"</div>";
                                            }else{
                                                echo h(date('F d, Y h:i:a', strtotime($required_doc['DeliveryPaper']['date_processed'])));
                                            }

                                        }else{
                                          echo"<p>not available</p>";
                                        }

                                    }else{

                                        if($required_doc['DeliveryPaper']['date_processed'] != ""){
                                                echo h(date('F d, Y h:i:a', strtotime($required_doc['DeliveryPaper']['date_processed'])));

                                        }else{
                                            echo"<p>not available</p>";
                                        }

                                    }

                                ?>
                            </td>
                            <td><?php echo h($required_doc['DeliveryPaper']['status']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
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
                    <form id="add_p">
                    <input type="hidden" id="add_fitout_work_id" value="<?php echo h($works['FitoutWork']['id']); ?>" readonly />
                    <label>Employee<span class="text-danger">*</span></label>
                    <select class="form-control" id="employee">
                        <option value="0">Select an Employee</option>

                    </select>
                  </form>
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
<!-- Edit date_end Modal End!-->
<!-- doc required modal start !-->
<div class="modal fade" id="add-docrequirement-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add required documents</h4>
            </div>
            <div class="modal-body">
             <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Document</label>
                            <select class="form-control" id="dr_paper_id">
                                <option value="0">Please select a document</option>
                                <?php foreach ($documents as $document) {
                                    echo '<option value="' . h($document['DrPaper']['id']) . '">' . h($document['DrPaper']['name']) . '</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quotation</label>
                                <select class="form-control" id="quotation_id">
                                    <option value="0">Please select a quotation number</option>
                                    <?php foreach ($quotations as $quotation) {
                                        echo '<option value="' . h($quotation['Quotation']['id']) . '">' . h($quotation['Quotation']['quote_number']) . '</option>';
                                    }?>
                                </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label" id="labelSupplier">Date Needed</label>
                        <input type="text" readonly=""  id="date_need" class="form-control" >
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveDrPaper">Add</button>
            </div>
        </div>
    </div>
</div>
<!--doc required modal end !-->
<!-- Edit date_acquired Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-dateacquired-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit acquired date</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">

                        <div class="col-sm-6">
                             <input type="hidden" class="form-control"  id="da_id">
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date_acquired">
                        </div>

                        <div class="col-sm-6">
                            <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="time_acquired">
                        </div>

                    </div>
                </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="editdateAcquired">Add</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--===================================================-->
<!-- Edit date_acquired Modal End!-->
<!-- Edit date_acquired Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-processed-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Edit processed date</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">

                        <div class="col-sm-6">
                             <input type="hidden" class="form-control"  id="dp_id">
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date_processed">
                        </div>

                        <div class="col-sm-6">
                            <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="time_processed">
                        </div>

                    </div>
                </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="editdateProcessed">Add</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--===================================================-->
<!-- Edit date_processed Modal End!-->
<script>
    $('#add_people').on("click", function () {
        $('#add-people-modal').modal('show');
    });

    $('#add_work').on("click", function () {
        $('#add-work-modal').modal('show');
    });

    $('#addReqdoc').on("click", function() {
        $('#add-docrequirement-modal').modal('show');
    });

    $(document).ready(function () {
         var date = new Date();
        date.setDate(date.getDate() - 1);

        $('#date_need')
            .datepicker({
                format: 'yyyy-mm-dd',
                startDate: date,
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
                                    swal({title:'Names already exist', text:'Duplicate record!', type:'info', timer:'2000'})
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
                            swal('Oops...', 'Something went wrong!', 'error')
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

            /* simple javascript confirmation dialog
             var result = confirm("Are you sure to delete this record?")
             if (result) {
                         var data = { "id":id }

                        $.ajax({
                            url: "/fitout_works/delete_people",
                            type: 'POST',
                            data: {'data': data},
                            dataType: 'json',
                                success: function (id) {
                                    location.reload();

                            }
                        });

             }
             */

                swal({
                    title: 'Are you sure to delete this record?',
                    text: "This action cannot be revert!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'

                }).then(function () {
                    var data = { "id":id }

                        $.ajax({
                            url: "/fitout_works/delete_people",
                            type: 'POST',
                            data: {'data': data},
                            dataType: 'json',
                                success: function (id) {
                                    location.reload();

                        }
                    });
            })
        });
    });


       $('#saveDrPaper').on("click", function () {

            var dr_paper_id= $('#dr_paper_id').val();
            var quotation_id = $('#quotation_id').val();
            var date_need = $('#date_need').val();

            if(( dr_paper_id != 0 )){

                if(( quotation_id != 0 )){

                    if(( date_need != "" )){

                        var data = { "dr_paper_id": dr_paper_id, "quotation_id": quotation_id, "date_need": date_need }

                    $.ajax({
                        url: "/fitout_works/add_document",
                        type: 'POST',
                        data: {'data': data},
                        dataType: 'json',

                        success: function (id) {
                            location.reload();
                        },
                        erorr: function (id) {
                            swal('Oops...', 'Something went wrong!', 'error')
                        }
                    });

            }else{
               document.getElementById('date_need').style.borderColor = "red";
            }

            }else{
                document.getElementById('quotation_id').style.borderColor = "red";
            }

            }else{
                document.getElementById('dr_paper_id').style.borderColor = "red";
            }

        });


        $(".editdaBtn").each(function (index) {
        $(this).on("click", function () {
              var id = $(this).data('daid');

                $('#da_id').val(id);
                $('#edit-dateacquired-modal').modal('show');
        });

    });

         $('#editdateAcquired').on("click", function () {
            var da_id = $('#da_id').val();
            var date_acquired = $('#date_acquired').val();
            var time_acquired = $('#time_acquired').val();

            if(( date_acquired != "")){
                if(( time_acquired != "" )){

                            var data = { "da_id": da_id, "date_acquired": date_acquired, "time_acquired": time_acquired }

                    $.ajax({
                        url: "/fitout_works/edit_dateacquired",
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
               document.getElementById('time_acquired').style.borderColor = "red";
            }

            }else{
                document.getElementById('date_acquired').style.borderColor = "red";
            }


        });

    $(".editdpBtn").each(function (index) {
        $(this).on("click", function () {
              var id = $(this).data('dpid');
                $('#dp_id').val(id);
                $('#edit-processed-modal').modal('show');
        });

    });

        $('#editdateProcessed').on("click", function () {
            var dp_id = $('#dp_id').val();
            var date_processed = $('#date_processed').val();
            var time_processed = $('#time_processed').val();

            if(( date_processed != "")){
                if(( time_processed != "" )){

                    var data = { "dp_id": dp_id, "date_processed": date_processed, "time_processed": time_processed }

                    $.ajax({
                        url: "/fitout_works/edit_dateprocessed",
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
               document.getElementById('time_processed').style.borderColor = "red";
            }

            }else{
                document.getElementById('date_processed').style.borderColor = "red";
            }

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