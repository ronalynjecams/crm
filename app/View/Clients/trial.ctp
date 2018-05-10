
<style>
    table{
        margin-top:1cm;
        margin-left:.5cm;
    }
</style>


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
                <input type="hidden"  id="client_id" >
                <div class="form-group">
                    <label>Client Name</label>
                    <input type="text" class="form-control" placeholder="Enter Client Name" id="client_name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="sample@gmail.com" id="email">
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


<table class="table" >
<?php
        foreach ($clients_lists as $clients_list){
             
            $client_name = $clients_list['Client']['name'];
            $client_email = $clients_list['Client']['email'];
            $date_created = $clients_list['Client']['created'];
            ?>
            <tr>
                <td><?php echo $date_created; ?></td>
                <td><?php echo $client_name; ?></td>
                <td><?php echo $client_email; ?></td>
                <td>
               
               
                    
    <script>
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
                $('#client_id').val(data['id']);
                 $('#client_name').val(data['name']);  
                 $('#email').val(data['email']);   
            });
        
        
    });
  });
  
  

  
  
  
  
  
   $('#updateLeads').on("click", function(){ 
//        alert('asd');
      var name = $('#client_name').val();   
      var email = $('#email').val();   
    if((name!="")){ 
                if(email!=""){
                        
                            var data = { "client_name": name, 
                                "email":email
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
                    document.getElementById('email').style.borderColor = "red";
                }
           
      
    }else{ 
        document.getElementById('client_name').style.borderColor = "red";
    } 
    });
</script>
<a class="btn btn-mint btn-icon add-tooltip updateLeadBtn" data-toggle="tooltip" href="#" data-original-title="Update Information" ><i class="demo-psi-pen-5 icon-lg"></i></a>
</td>
             
            </tr>
            <?php        
        }
?>
</table>

