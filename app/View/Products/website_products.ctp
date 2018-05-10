<!--///////////ADONIS/////////////////     -->
     
     
      <link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
      <link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
      <link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet"> 
      <link href="/css/sweetalert.css" rel="stylesheet">
           
      <script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
      <script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
      <script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
      <script src="/css/plug/select/js/select2.min.js"></script>
      <script src="/js/sweetalert.min.js"></script>  
         
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
          <h1 class="page-header text-overflow">List of Website products</h1>
        </div>
        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
          <!-- Basic Data Tables -->
          <!--===================================================-->
          <div class="panel">
            <div class="panel-heading" align="right">
              <h3 class="panel-title">
                  <button class="btn btn-mint" id="addProductBtn" >
                  <i class="fa fa-plus"></i>  Add New Product
                </button>  
              
              </h3>
              <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
                
            <div class="panel-body">
                
            <div class="table-responsive">
         
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Category [subcategory]</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Action</th> 
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Category [subcategory]</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Action</th> 
                  </tr>
                </tfoot>
                <tbody>
                  
                    <?php  foreach ($productinformations as $productinformation){  ?>
                    
                        <tr>
                          <td><?php echo $productinformation['SubCategory']['Category']['name']."[".$productinformation['SubCategory']['name']."]"; ?></td>
                          <td><?php 
                              $img = $this->requestAction('App/thumbnail/'.$productinformation['Product']['image'].'/150/195'); 
                              $imageData = base64_encode($img);
                              $src = 'data: image/jpg;base64,'.$imageData;
                              echo '<img class="img-responsive" style="width:80px;" src="' . $src . '">';
                          ?></td>
                          <td><?php echo $productinformation['Product']['name']; ?></td>
                         <td> 
                            <?php  
                                    echo '<a class="btn btn-danger add-tooltip product_updateBtn" data-toggle="tooltip" data-productid="'.$productinformation['Product']['id'].'" data-original-title="Delete Product" ><i class="fa fa-window-close "></i></a>';
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
      <div class="modal fade" id="add-product-modal" role="dialog" aria-labelledby="demo-default-modal" >
        <div class="modal-dialog">
          <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <i class="pci-cross pci-circle"></i>
              </button>
              <h4 class="modal-title">Add New Product</h4>
            </div>
                       
                    <div class="col-sm-12" style="padding: 14px;">
                    <select class="form-control selected_products" multiple=""  id="selected_products" style="width:100%">
                       <?php  foreach ($productinformation_selects as $productinformation_select){ ?>
                        <option  value="<?php echo $productinformation_select['Product']['id']; ?>">
                            <?php echo $productinformation_select['Product']['name']; ?>
                            </option>
                        <?php
                    }
                    ?>  
                    </select>
                    </div>
                <!--Modal footer-->
                <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                  <button class="btn btn-primary" id="productaddlead">Add</button>
                </div>
              </div> 
          </div>
          </div>
          <!--===================================================-->
      <!--Add New Lead Modal End--> 
   
        <script> 
            $(document).ready(function() { 
                $("#selected_products").select2();
    
                $('#example').DataTable( {
                    "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                    "order": [[ 0, "asc" ]],
                    "stateSave": true
                });
      
    });
    
    // Click modal div
            $('#addProductBtn').on("click", function () {
                    $('#add-product-modal').modal('show');
                });
           
        //--- modal div ---//
        
  $('#productaddlead').on("click", function(){ 
      var selected_products = $('#selected_products').val();
      console.log(selected_products);
    if((selected_products.length != 0)){   
        
                  $.ajax({
                            url: "/products/update_website_products", //to controller public function
                            type: 'POST',
                            data: { 'id': selected_products}, //from var
                            dataType: 'json',
                            success: function(dd) {
                                location.reload();
                            },
                            error: function(dd) {
                                location.reload();
                            }
                        });
                
                            }else{
                               swal({
                                  title: "Empty",
                                });
                            } 
                        }); 
          
          //pass id by foreach in button
       $('.product_updateBtn').each(function(index) {
              $(this).click(function() {
                var productid = $(this).data("productid");

      //sweetalert 
                swal({
                        title: "Are you sure?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "delete",
                        cancelButtonText: "cancel",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
              
                            $(".confirm").attr('disabled', 'disabled');
        
                            $.ajax({
                                url: "/products/delete_website_products",
                                type: 'POST',
                                data: {
                                    'id': productid
                                },
                                dataType: 'json',
                                success: function(dd) {
                                    location.reload();
                                },
                                error: function(dd) {
                                 
                                     location.reload();
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });
                        // sweetalert --- end --
                    });
                });
       
                   
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
              }//////////////////////////adonis//////////////
</script>
 