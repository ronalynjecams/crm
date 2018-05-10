 <link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    
      <script src="/css/plug/select/js/select2.min.js"></script>
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
                  
                <?php if($UserIn['User']['role'] == 'sales_executive' || $UserIn['User']['role'] == 'proprietor'){ ?>
                <button class="btn btn-mint" id="addClientBtn" >
                  <i class="fa fa-plus"></i>  Add New Client
                </button>
                <?php } ?>
              </h3>
              <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact Person / Position</th>
                    <th>Contact Number</th>
                    <th>Email</th> 
                    <th>Address</th> 
                    <th>Industry</th> 
                    <th> </th> 
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Contact Person / Position</th>
                    <th>Contact Number</th>
                    <th>Email</th>  
                    <th>Address</th> 
                    <th>Industry</th>
                    <th> </th>  
                  </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($clients as $client){ ?>
                        <tr>
                          <td><?php echo $client['Client']['name'].'<small class="text-info"><br/>['.$client['Client']['tin_number'].']</small>'; ?></td>
                          <td><?php echo $client['Client']['contact_person'].'<small><br/>'.$client['Client']['position'].'</small>'; ?></td>
                          <td><?php echo $client['Client']['contact_number']; ?></td>
                          <td><?php echo $client['Client']['email']; ?></td> 
                          <td><?php echo $client['Client']['address']; ?></td> 
                          <td><?php 
                            if(!is_null($client['ClientIndustry']['name'])){
                                echo $client['ClientIndustry']['name'];
                            }else{
                                echo '<font color="red">Unavailable</font>';
                            }
                          ?></td> 
                          <td>
                            <?php 
                                if($UserIn['User']['role'] == 'sales_executive'){ 
                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateLeadBtn" data-toggle="tooltip" href="#" data-original-title="Update Client" data-id="'.$client['Client']['id'].'" ><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                // }else if($UserIn['User']['role'] == 'sales_manager'){
                                    
                                }else  if($UserIn['User']['role'] == 'admin_staff'){
                                    echo $client['User']['first_name'];
                                }
                                
                                // else{
                                    // echo $client['Client']['user_id'];
                                // }
                            ?>
                          </td> 
                        </tr>
                    <?php  } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Add New Lead Modal Start-->
      <!--===================================================-->
      <div class="modal fade" id="add-client-modal" role="dialog" aria-labelledby="demo-default-modal" aria-hidden="true">
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
                    <!--<input type="text" class="form-control" id="name">-->
                    
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Company Name" id="name">
                      <span class="input-group-btn">
                        <button class="btn btn-secondary btn-primary" id="check_company_btn" type="button"><i class="fa fa-search"></i>  Search</button>
                      </span>
                    </div>
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
                    <label>Industry <span class="text-danger">*</span></label>
                    <select  class="form-control"  id="client_industry_id">
                        <option></option>
                        <?php 
                        foreach($industries as $industry){
                            echo '<option value="'.$industry['ClientIndustry']['id'].'">'.$industry['ClientIndustry']['name'].'</option>';
                        }
                        ?> 
                    </select>
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
      <div class="modal fade" id="update-modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
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
                    <!--<input type="text" class="form-control" placeholder="Name" id="uname">-->
                    
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Company Name" id="uname">
                      <span class="input-group-btn">
                        <button class="btn btn-secondary btn-primary" id="check_update_company_btn" type="button"><i class="fa fa-search"></i>  Search</button>
                      </span>
                    </div>
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
                    <label>Industry <span class="text-danger">*</span></label>
                    <select  class="form-control"  id="uclient_industry_id">
                        <option></option>
                        <?php 
                        foreach($industries as $industry){
                            echo '<option value="'.$industry['ClientIndustry']['id'].'">'.$industry['ClientIndustry']['name'].'</option>';
                        }
                        ?> 
                    </select>
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
                
            $("#client_industry_id").select2({
                placeholder: "Select Industry",
                width: '100%',
                allowClear: false
            });
                
        ///// check if lead already exist on other sales executive who are also an active user /////
        $('#name, #uname').on('keyup', function (e) {
            $('#name').val($('#name').val().toUpperCase());
            $('#uname').val($('#uname').val().toUpperCase());
        });
        $('#check_company_btn').on("click",function() { 
                    $('#nameExistDiv').remove(); 
                    $('#unameExistDiv').remove(); 
            var name = $('#name').val();
            if(name.length >= 4){
                $.post('/clients/check_client_existence', {
                    name: name,
                }, function (data) {  
                    if(data.length !== 0){
                        $('#name_validation').append('<div id="nameExistDiv" class="text-danger">'+data+'</div>'); 
                    } else{
                        $('#name_validation').append('<div id="nameExistDiv" class="text-danger">Could not search for '+name+' from other Sales Executive</div>');   
                    }
                });
            }else{
                        $('#name_validation').append('<div id="nameExistDiv" class="text-danger">Could not search if less than 4 letters</div>'); 
                
            }
 
        });
        
        $('#check_update_company_btn').on("click",function() {  
                    $('#nameExistDiv').remove(); 
                    $('#unameExistDiv').remove(); 
            var name = $('#uname').val();
            if(name.length >= 4){
                $.post('/clients/check_client_existence', {
                    name: name,
                }, function (data) {  
                    if(data.length !== 0){ 
                        $('#uname_validation').append('<div id="unameExistDiv" class="text-danger">'+data+'</div>');
                    } else{
                        $('#uname_validation').append('<div id="unameExistDiv" class="text-danger">Could not search for '+name+' from other Sales Executive</div>');   
                        
                    }
                });
            }else{ 
                        $('#uname_validation').append('<div id="unameExistDiv" class="text-danger">Could not search if less than 4 letters</div>');
                
            }
 
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
                 $('#uclient_industry_id').val(data['client_industry_id']);   
                    
                 
                 
            });
        
        
    });
   });
   
    $('#updateLeads').on("click", function(){   
      var name = $('#uname').val();   
      var contact_person = $('#ucontact_person').val();   
      var position = $('#uposition').val();   
      var address = $('#uaddress').val();   
      var email = $('#uemail').val();   
      var contact_number = $('#ucontact_number').val();   
      var tin_number = $('#utin_number').val();    
      var ulead_id  = $('#ulead_id').val();  
      var client_industry_id = $('#uclient_industry_id').val();    
      
    if((name!="")){ 
        if(contact_person!=""){
            if(address!=""){
                if(email!=""){
                    if(contact_number!=""){
                        if(client_industry_id>=1){
                        
                            var data = { "name": name, 
                                "contact_person":contact_person,
                                "position":position,
                                "address":address,
                                "email":email,
                                "contact_number":contact_number,
                                "id":ulead_id,
                                "tin_number":tin_number,
                                "client_industry_id":client_industry_id, 
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
                                    alert('Required Industry');
                    }
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
   
   
   
            $('#saveLead').on("click", function(){  
               
              var name = $('#name').val();   
              var contact_person = $('#contact_person').val();   
              var position = $('#position').val();   
              var address = $('#address').val();   
              var email = $('#email').val();   
              var contact_number = $('#contact_number').val();   
              var tin_number = $('#tin_number').val();  
              var client_industry_id = $('#client_industry_id').val();   

            if((name!="")){ 
                if(contact_person!=""){
                    if(address!=""){
                        if(email!=""){
                            if(contact_number!=""){
                                if(client_industry_id!=""){
                                        var data = { "name": name, 
                                            "contact_person":contact_person,
                                            "position":position,
                                            "address":address,
                                            "email":email,
                                            "contact_number":contact_number,
                                            "tin_number":tin_number, 
                                            "client_industry_id":client_industry_id, 
                                            "type":'client'
                                        } 
                                        $.ajax({
                                            url: "/clients/add_leads",
                                            type: 'POST', 
                                            data: {'data': data},
                                            dataType: 'json',
                                                    success: function(id){
                                                     location.reload();  	  
                                                    },
                                                    erorr: function(id){ 
                                                        alert('error!');
                                                    }
                                         });
                                }else{
                                    alert('Required Industry');
                                }
                            }else{
                            document.getElementById('contact_number').style.borderColor = "red"; 
                            }
                        }else{
                            document.getElementById('email').style.borderColor = "red";
                        }
                    }else{
                        document.getElementById('address').style.borderColor = "red";
                    }
                }else{
                    document.getElementById('contact_person').style.borderColor = "red";
                }
            }else{ 
                document.getElementById('name').style.borderColor = "red";
            }  
            });
   
        </script>

 