<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<script src="/js/erp_scripts.js"></script>

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
                           <button class="btn btn-success btn-sm add-tooltip" id="addOB" data-toggle="tooltip" data-placement="left" data-original-title="Add official business"><i class="fa fa-plus"></i>&nbsp;Add official business</button>
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
                            <td><?php echo time_elapsed_string($my_official_business_list['OfficialBusiness']['created']); ?></td>
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
<!-- Add Modal for Start -->
<!--===================================================-->
<div class="modal fade" id="add-ob-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add Official Business</h4>
            </div>
            <!--Modal body-->
             <div class="modal-body">
                <div class="row">
                    <div class="form-group">

                        <div class="col-sm-6">
                            <label>Mode</label>
                            <select class="form-control" id="mode">
                                <option value="none">Select a mode</option>
                                <option value="ob">ob</option>
                                <option value="gate_pass">gate_pass</option>
                                <option value="site_visit">site_visit</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label>Companion</label>
                            
                            <select class="form-control selectpicker" id="user" multiple >
                               <?php
                                    foreach($users as $user){ 
                                ?>
                                        <option value="<?php echo $user['User']['id'] ?>">
                                            <?php echo $user['User']['first_name']." ".$user['User']['last_name']; ?>
                                        </option>
                                <?php
                                    }
                                ?>

                            </select>
                            
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Expected Departure Date</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="exp_date">
                        </div>
                        <div class="col-sm-6">
                            <label>Expected Departure Time</label>
                            <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="exp_time">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" >
                        
                        <?php if( $UserIn['User']['role'] == 'sales_executive' ){ ?>
                        <div class="col-sm-12">
                            <label>Client</label>
                            <select class="form-control" id="client">
                                <option value="0">Select a client</option>
                                <?php foreach ($my_official_business_lists as $client) {?>
                                    <option value="<?php echo $client['OfficialBusiness']['Client']['id']; ?>"><?php echo $client['OfficialBusiness']['Client']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php }else if( $UserIn['User']['role'] == 'sales_manager' ){ ?>
                        <div class="col-sm-12">
                            <label>Client</label>
                            <select class="form-control" id="client">
                                <option value="0">Select a client</option>
                                <?php foreach ($my_official_business_lists as $client) {?>
                                    <option value="<?php echo $client['OfficialBusiness']['Client']['team_id']; ?>"><?php echo $client['OfficialBusiness']['Client']['team_id']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <?php }else{ ?>
                            <div class="col-sm-12">
                                <label>Company Name</label>
                                <input type="text" class="form-control" id="company">
                            </div> 
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-6">
                        <input type="checkbox" id="svrequest"> check for service request
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label>Purpose</label></label>
                        <textarea class="form-control" id="purpose"></textarea>
                        </div>
                    </div>
                </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="addOBProcess">Add</button>
            </div>
        </div>
    </div>
</div>
</div>

<!--===================================================-->
<!-- Add Modal End!-->
<!-- Edit Modal Start-->
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
<!-- Edit Modal End!-->

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
        $('#addOB').on("click", function () {
            $('#add-ob-modal').modal('show');
        });
    
         $('.selectpicker').selectpicker('deselectAll');
         
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
      
    });
    
</script>
<?php
if($UserIn['User']['role'] == 'sales_executive'){
?>
<script>
    $('#addOBProcess').on("click", function () {
        var mode = $('#mode').val();
        var user = $('.selectpicker').val();
        var exp_date = $('#exp_date').val();
        var exp_time = $('#exp_time').val();
        var client=$('#client').val();
        
        if ($('#svrequest').is(":checked")){
             var svrequest = 1;
        }else{
            var svrequest = 0;
        }
        
        var purpose = $('#purpose').val();
        
         if ((mode != "none" )){ 
                 if((exp_date != "" )){
                     if((exp_time != "")){
                          if((client != 0)){
                            if((purpose != "")){
                                
                            var data = {"mode": mode, "user": user, "exp_date": exp_date, "exp_time": exp_time, "client": client, "svrequest": svrequest, "purpose": purpose }
                            
                            $.ajax({
                                url: "/official_businesses/add_ob_sales",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                  location.reload(true);
                                    
                                },
                                error: function () {
                                    alert('error')
                                    console.log(data);
                                }
                            });
                            
        } else {
            document.getElementById('purpose').style.borderColor = "red";
        }
        
                         
        } else {
            document.getElementById('client').style.borderColor = "red";

        }
        
        } else {
            document.getElementById('exp_time').style.borderColor = "red";
        }

                            
        } else {
            document.getElementById('exp_date').style.borderColor = "red";

        }
                            
        } else {
            document.getElementById('mode').style.borderColor = "red";

        }
            
        });
</script>
<?php }else if($UserIn['User']['role'] == 'sales_manager'){ ?>
<script>
   $('#addOBProcess').on("click", function () {
        var mode = $('#mode').val();
        var user = $('.selectpicker').val();
        var exp_date = $('#exp_date').val();
        var exp_time = $('#exp_time').val();
        var client=$('#client').val();
       
        if ($('#svrequest').is(":checked")){
             var svrequest = 1;
        }else{
            var svrequest = 0;
        }
        
        var purpose = $('#purpose').val();
        
         if ((mode != "none" )){ 
                 if((exp_date != "" )){
                     if((exp_time != "")){
                            if((purpose != "")){
                                
                            var data = {"mode": mode, "user": user, "exp_date": exp_date, "exp_time": exp_time, "client": client, "svrequest": svrequest, "purpose": purpose }
                            
                            $.ajax({
                                url: "/official_businesses/add_ob_sales",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                    location.reload(true);
                                },
                                error: function () {
                                    alert('error')
                                }
                            });
                            
        } else {
            document.getElementById('purpose').style.borderColor = "red";
        }
                            
        } else {
            document.getElementById('exp_time').style.borderColor = "red";
        }

                            
        } else {
            document.getElementById('exp_date').style.borderColor = "red";

        }
                            
        } else {
            document.getElementById('mode').style.borderColor = "red";

        }
            
        });
</script>
<?php }else{ ?>
<script>
       $('#addOBProcess').on("click", function () {
        var mode = $('#mode').val();
        var user = $('.selectpicker').val();   //.val();

        var exp_date = $('#exp_date').val();
        var exp_time = $('#exp_time').val();
        var company = $('#company').val();
       
        if ($('#svrequest').is(":checked")){
             var svrequest = 1;
        }else{
            var svrequest = 0;
        }
        
        var purpose = $('#purpose').val();
        
         if ((mode != "none" )){ 
             
            if((exp_date != "" )){
                
                if((exp_time != "")){
                    
                    if((company != "")){
                            
                        if((purpose != "")){
                                
                            var data = {"mode": mode, "user": user, "exp_date": exp_date, "exp_time": exp_time, "company": company, "svrequest": svrequest, "purpose": purpose }
                            console.log(data);
                            
                            $.ajax({
                                url: "/official_businesses/add_ob_users",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (data) {
                                    location.reload(true);
                                },
                                error: function () {
                                    alert('error')
                                }
                             
                             
                            });
                            
        } else {
            document.getElementById('purpose').style.borderColor = "red";
        }
        
        } else {
            document.getElementById('company').style.borderColor = "red";
        }
                            
        } else {
            document.getElementById('exp_time').style.borderColor = "red";
        }

                            
        } else {
            document.getElementById('exp_date').style.borderColor = "red";

        }
                            
        } else {
            document.getElementById('mode').style.borderColor = "red";

        }
            
        });
</script>
<?php } ?>
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