 
<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">
    
      <script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
      <script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
      <script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script> 
<script src="/js/sweetalert.min.js"></script>  
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
          <h1 class="page-header text-overflow">Issued Cheques <small>[ <?php echo ucwords($status); ?> ]</small></h1>
        </div>
        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
          <!-- Basic Data Tables -->
          <!--===================================================-->
          <div class="panel">
            <div class="panel-heading" align="right"> 
              <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Date Issued</th>
                    <th>Bank</th>
                    <th>Payee</th>
                    <th>Amount</th> 
                    <th>Cheque # </th> 
                    <th>Cheque Date </th> 
                    <th> </th> 
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Date Issued</th>
                    <th>Bank</th>
                    <th>Payee</th>
                    <th>Amount</th> 
                    <th>Cheque # </th> 
                    <th>Cheque Date </th> 
                    <th> </th> 
                  </tr>
                </tfoot>
                <tbody>
                    <?php
                    
		                $after_two_days = date('Y-m-d', strtotime('+2 days'));
                    foreach ($cheques as $cheque){ ?>
                        <tr> 
                          <td>
                              <?php
                              echo time_elapsed_string($cheque['PaymentRequestCheque']['created']);
                              echo '<br/><small>' . date('h:i a', strtotime($cheque['PaymentRequestCheque']['created'])) . '</small>';
                              ?> 
                          </td>
                          <td> <?php echo $cheque['Bank']['display_name'];  ?></td>
                          <td> <?php echo $cheque['Payee']['name'];  ?></td>
                          <td> <?php echo '&#8369; ' . number_format($cheque['PaymentRequest']['requested_amount'], 2); ?></td>
                          <td> <?php echo $cheque['PaymentRequestCheque']['cheque_number'];  ?></td>
                          <td> <?php echo date('F d, Y', strtotime($cheque['PaymentRequestCheque']['cheque_date']));
                  					if($cheque['PaymentRequestCheque']['cheque_date']>=$after_two_days ){
                  						echo '<br/><a href="#" class="label label-danger label-tag"> Post Dated</a>';
                  					} ?></td>
                          <td>
                              <?php
                              if($status == 'pending'){
                                  if (AuthComponent::user('role') == 'proprietor') { 
                                  ?>
                                   <button class="btn btn-success btn-icon add-tooltip cleared_cheque" data-toggle="tooltip"  data-original-title="Cleared Check?" data-id="<?php echo $cheque['PaymentRequestCheque']['id']; ?>" >Cleared?</button>
                                  <?php
                                  }
                              }
                              
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
       
        <script> 
            $(document).ready(function() {
                $('#example').DataTable( {
                    "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                    "order": [[ 0, "asc" ]],
                    "stateSave": true
                } );
                
        });

      
        $('.cleared_cheque').each(function (index) {
            $(this).click(function () {
                var id = $(this).data("id");  
                 
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to revert action in this cheque status!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                
                                 $(".confirm").attr('disabled', 'disabled'); 
                                $.ajax({
                                    url: "/payment_request_cheques/issued_cheques_process",
                                    type: 'POST',
                                    data: {'id': id},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();
                                    },
                                    error: function (dd) {
                                        console.log(type);
                                    }
                                });
                            } else {
                                swal("Cancelled", "", "error");
                            }
                        }); 
            });
        });
   
   
        </script> 