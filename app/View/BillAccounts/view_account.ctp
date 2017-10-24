 
<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Bill Accounts</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if (($UserIn['User']['role'] == 'admin_staff') || ($UserIn['User']['role'] == 'admin_staff')) { ?>
                        <button class="btn btn-mint" id="addBillsBtn" >
                            <i class="fa fa-plus"></i>  Add new bills account
                        </button>
                    <?php } ?>

                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Account Name</th> 
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Account Name</th>
                            <th>Actions</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($bill_accounts as $billAccount){ ?>
                            <tr>
                                <td><?php echo $billAccount['BillAccount']['name']; ?></td>
                                <td>
                            <?php 
                                if($UserIn['User']['role'] == 'admin_staff'){ if($UserIn['User']['role'] == 'admin_staff'){ 
                                    echo"<div class='row'>";
                                        echo"<div class='col-sm-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip editBillsBtn" data-toggle="tooltip" href="#" data-original-title="Update bill account" data-id="'.$billAccount['BillAccount']['id'].'" data-billname="'.$billAccount['BillAccount']['name'].'"><i class="demo-psi-pen-5 icon-lg"></i></a>';
                                         echo"</div>"; 
                                    echo"</div";
                                } } 
                            ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!--Add New Bill Accounts Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-bills-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Bills</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name">
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveBills">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New Bill Accounts Modal End !-->
<!--Update Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="edit-bills-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Bills</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="ubill_account_id">
                <div class="form-group" id="uname_validation">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Bill Name" id="uname">
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateBills">Update Bills</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Update Modal End--> 

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });


        ///// check if lead already exist on other sales executive who are also an active user /////
     $('#name').on('keyup', function (e) {
        var name = $('#name').val();
        $('#name').val($('#name').val().toUpperCase());
 
        });
    
    
    $('#uname').on('keyup', function (e) {
        var uname = $('#uname').val();
        $('#uname').val($('#uname').val().toUpperCase());
 
        });
 
    
    
    $('#addBillsBtn').on("click", function () {
        $('#nameExistDiv').remove();
        $('#add-bills-modal').modal('show');
    });
    
    
    $(".editBillsBtn").each(function (index) {
        $(this).on("click", function () {
             $('#nameExistDiv').remove();
           $('#unameExistDiv').remove();
           
            var id = $(this).data('id'); //this line gets value of data-id from delete button
            var uname = $(this).data('billname');
            
            // alert(uname);
            
            $('#ubill_account_id').val(id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
            $('#uname').val(uname);
            
            $('#edit-bills-modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal


        });
    });
    

    $('#updateBills').on("click", function () {
        var uname = $('#uname').val();
        var update_bill_id = $('#ubill_account_id').val();
        
        if ((uname != "")) {
            var data = {"name": uname, "id":update_bill_id}
                            $.ajax({
                                url: "/bill_accounts/update_account",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (id) {
                                    location.reload();
                                }
                            });
        } else {
            document.getElementById('uname').style.borderColor = "red";
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please enter a bill name',
                showConfirmButton: false,
                timer: 1000
            })
        }
    });

    $('#saveBills').on("click", function () {
        var name = $('#name').val();
        
         if ((name != "")) {
                            var data = {"name": name}
                            $.ajax({
                                url: "/bill_accounts/add_account",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function () {
                                    location.reload();
                                    
                                },
                                error: function () {
                                    swal({
                                        type: 'error',
                                        text: 'message',
                                        title: 'Error',
                                        timer: 1000
                                    })
                                }
                            });
               
        } else {
            document.getElementById('name').style.borderColor = "red";
            swal({
                type: 'warning',
                text: 'message',
                title: 'Please enter bill name',
                timer: 1000
            })
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