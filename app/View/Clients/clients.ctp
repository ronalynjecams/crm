 
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    
      <script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
      <script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
      <script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="../js/erp_js/erp_scripts.js"></script>  
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
          <h1 class="page-header text-overflow">Clients</h1>
        </div>
        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
          <!-- Basic Data Tables -->
          <!--===================================================-->
          <div class="panel">
            <div class="panel-heading" align="right">
              <h3 class="panel-title">
                  
                <?php if($UserIn['User']['role'] == 'sales_executive'){ ?>
                <button class="btn btn-mint" id="addClientBtn" >
                  <i class="fa fa-plus"></i>  Add New Client
                </button>
                <?php } ?>
              </h3>
              <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact Person / Position</th>
                    <th>Contact Number</th>
                    <th>Email</th> 
                    <th> </th> 
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Contact Person / Position</th>
                    <th>Contact Number</th>
                    <th>Email</th>  
                    <th> </th>  
                  </tr>
                </tfoot>
                <tbody>
                    <?php  foreach ($clients as $client){ ?>
                        <tr>
                          <th><?php echo $client['Client']['name'].'<small class="text-info"><br/>['.$client['Client']['tin_number'].']</small>'; ?></th>
                          <th><?php echo $client['Client']['contact_person'].'<small><br/>'.$client['Client']['position'].'</small>'; ?></th>
                          <th><?php echo $client['Client']['contact_number']; ?></th>
                          <th><?php echo $client['Client']['email']; ?></th> 
                          <th>
                            <?php 
                                if($UserIn['User']['role'] == 'sales_executive'){ 
                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateLeadBtn" data-toggle="tooltip" href="#" data-original-title="Update Client" data-id="'.$client['Client']['id'].'" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                } 
                            ?>
                          </th> 
                        </tr>
                    <?php  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--Add New Lead Modal Start-->
      <!--===================================================-->
      <div class="modal fade" id="add-client-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
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
                <div class="form-group" id="name_validation">
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
                    <input type="hidden" class="form-control"  id="ulead_id">
                <div class="form-group" id="uname_validation">
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
            $(document).ready(function() {
                $('#example').DataTable( {
                    "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                    "order": [[ 0, "asc" ]],
                    "stateSave": true
                } );
                
        ///// check if lead already exist on other sales executive who are also an active user /////
        $('#name, #uname').on('keyup', function (e) {
            var name = $('#name').val();
            $('#name').val($('#name').val().toUpperCase());
            $('#uname').val($('#uname').val().toUpperCase());
            $.get('/clients/check_client_existence', {
                name: name,
            }, function (data) { 
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
                    if(data.length != 0){
                        $('#name_validation').append('<div id="nameExistDiv" class="text-danger">This client is also owned by '+data+'</div>');
                        $('#uname_validation').append('<div id="unameExistDiv" class="text-danger">This client is also owned by '+data+'</div>');
                    } 
            });
 
        });
    });
    
    
    $('#addClientBtn').on("click", function () {
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
            $('#add-client-modal').modal('show');
        });
             
    
    
   $(".updateLeadBtn").each(function(index) {
    $(this).on("click", function(){
            $('#nameExistDiv').remove();
            $('#unameExistDiv').remove();
      var id = $(this).data('id');  
      $('#ulead_id').val(id); 
        $('#update-modal').modal('show');  
        

            $.get('/clients/get_lead_info', {
                id: id, 
            },function(data){
                console.log(data['name']); 
                 $('#uname').val(data['name']);   
                 $('#ucontact_person').val(data['contact_person']);   
                 $('#uposition').val(data['position']);   
                 $('#uaddress').val(data['address']);   
                 $('#uemail').val(data['email']);   
                 $('#ucontact_number').val(data['contact_number']);   
                 $('#utin_number').val(data['tin_number']);     
            });
        
        
    });
   });
   
    $('#updateLeads').on("click", function(){ 
//        alert('asd');
      var name = $('#uname').val();   
      var contact_person = $('#ucontact_person').val();   
      var position = $('#uposition').val();   
      var address = $('#uaddress').val();   
      var email = $('#uemail').val();   
      var contact_number = $('#ucontact_number').val();   
      var tin_number = $('#utin_number').val();    
      var ulead_id  = $('#ulead_id').val();  
    if((name!="")){ 
        if(contact_person!=""){
            if(address!=""){
                if(email!=""){
                    if(contact_number!=""){
                        
                            var data = { "name": name, 
                                "contact_person":contact_person,
                                "position":position,
                                "address":address,
                                "email":email,
                                "contact_number":contact_number,
                                "id":ulead_id,
                                "tin_number":tin_number
                            }
                            $.ajax({
                               url: "/clients/update_leads",
                                type: 'POST', 
                                data: {'data': data},
                                dataType: 'json',
                                        success: function(id){
                                         location.reload();  	  
                                     } 
                                 });
                          
                    }else{
                        document.getElementById('ucontact_number').style.borderColor = "red";
                    }
                }else{
                    document.getElementById('uemail').style.borderColor = "red";
                }
            }else{
                document.getElementById('uaddress').style.borderColor = "red";
            }
        }else{
            document.getElementById('ucontact_person').style.borderColor = "red";
        }
    }else{ 
        document.getElementById('uname').style.borderColor = "red";
    } 
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