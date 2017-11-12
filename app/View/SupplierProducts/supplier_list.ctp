<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
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
        <h1 class="page-header text-overflow">Suppliers</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <button class="btn btn-mint" id="addSupplierBtn" >
                        <i class="fa fa-plus"></i>  Add New Supplier
                    </button> 
                </h3> 
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Supplier  </th>
                            <th>Code / TIN Number</th>
                            <th>Contact Person</th>
                            <th>Contact Number</th>
                            <th>Email</th> 
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Supplier </th>
                            <th>Code / TIN Number</th>
                            <th>Contact Person</th>
                            <th>Contact Number</th>
                            <th>Email</th> 
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($suppliers as $supplier) { ?>
                            <tr>
                                <td><?php echo $supplier['Supplier']['name']; ?></td>
                                <td><?php echo $supplier['Supplier']['code'] . '<small class="text-info">  [' . $supplier['Supplier']['tin_number'] . ']</small>'; ?></td>
                                <td><?php echo $supplier['Supplier']['contact_person']; ?></td>
                                <td><?php echo $supplier['Supplier']['contact_number']; ?></td> 
                                <td><?php echo $supplier['Supplier']['email']; ?></td> 
                                <td>
                                    <?php
                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Update Supplier" data-id="' . $supplier['Supplier']['id'] . '" ><i class="fa fa-edit"></i></a>';
                                    echo '&nbsp;<a class="btn btn-info btn-icon add-tooltip productSupplierBtn" data-toggle="tooltip" href="#" data-original-title="View Products" data-ids="' . $supplier['Supplier']['id'] . '" ><i class="fa fa-eye"></i> </a>';
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
<!--Add New Supplier Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-supplier-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add New Supplier</h4>
            </div> 
            <?php echo $this->Form->create('Supplier', array('role' => 'form', 'url' => array('controller' => 'suppliers', 'action' => 'add'))); ?>
            <div class="modal-body"> 
                <div class="form-group">
                    <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('code', array('class' => 'form-control', 'placeholder' => 'Code')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status', 'value' => 'active', 'type' => 'hidden')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('contact_person', array('class' => 'form-control', 'placeholder' => 'Contact Person')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('contact_number', array('class' => 'form-control', 'placeholder' => 'Contact Number')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('address', array('class' => 'form-control', 'placeholder' => 'Address')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $this->Form->input('tin_number', array('class' => 'form-control', 'placeholder' => 'Tin Number')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('vatable', array('type' => 'select', 'label' => false, 'options' => array('1' => 'Vat Inc', '0' => 'Vat Ex'))); ?>
                    <?php // echo $this->Form->input('vatable', array('class' => 'form-control', 'placeholder' => 'Vatable')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('user_id', array('class' => 'form-control', 'type' => 'hidden', 'value' => $me)); ?>
                </div> 
                <div class="form-group">
                    <?php echo $this->Form->input('type', array('class' => 'form-control', 'type' => 'hidden', 'value' => $type)); ?>
                </div>  
            </div> 
            <div class="modal-footer"> 
                <?php echo $this->Form->submit(__('Add'), array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
        <?php echo $this->Form->end() ?>
    </div>
</div>
<!--===================================================-->
<!--Add New Supplier Modal End--> 
<!--Update Lead Modal Start-->
<!--===================================================-->
<div class="modal fade" id="update-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Supplier</h4>
            </div>  
            <?php echo $this->Form->create('Supplier', array('role' => 'form', 'url' => array('controller' => 'suppliers', 'action' => 'edit'))); ?>

            <div class="modal-body"> 

                <div class="form-group">
                    <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id', 'id' => 'sup_id')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name', 'id' => 'sup_name')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('code', array('class' => 'form-control', 'placeholder' => 'Code', 'id' => 'sup_code')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status', 'value' => 'active', 'type' => 'hidden')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('contact_person', array('class' => 'form-control', 'placeholder' => 'Contact Person', 'id' => 'sup_person')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('contact_number', array('class' => 'form-control', 'placeholder' => 'Contact Number', 'id' => 'sup_number')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email', 'id' => 'sup_email')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('address', array('class' => 'form-control', 'placeholder' => 'Address', 'id' => 'sup_address')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $this->Form->input('tin_number', array('class' => 'form-control', 'placeholder' => 'Tin Number', 'id' => 'sup_tin')); ?>
                </div>
                <div class="form-group">
                    <?php // echo $this->Form->input('vatable', array('class' => 'form-control', 'type' => 'hidden', 'id'=>'sup_vat')); ?>
                    <?php echo $this->Form->input('vatable', array('type' => 'select', 'label' => false, 'id' => 'sup_vat', 'options' => array('1' => 'Vat Inc', '0' => 'Vat Ex'))); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('user_id', array('class' => 'form-control', 'type' => 'hidden', 'value' => $me)); ?>
                </div> 
                <div class="form-group">
                    <?php echo $this->Form->input('type', array('class' => 'form-control', 'type' => 'hidden', 'value' => $type)); ?>
                </div>  

                <div class="modal-footer">
                    <div class="form-group">
                        <?php echo $this->Form->submit(__('Update'), array('class' => 'btn btn-primary')); ?>
                    </div> 
                </div>
            </div>
            <?php echo $this->Form->end() ?>
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

        $('#addSupplierBtn').on("click", function () {
            $('#add-supplier-modal').modal('show');
        });

        $(".updateSupplierBtn").each(function (index) {
            $(this).on("click", function () {
                $('#update-modal').modal('show');
                var id = $(this).data("id");
                $("#sup_id").val(id);
                $.get('/suppliers/get_supplier_info', {
                    id: id,
                }, function (data) {
                    console.log(data['name']);
                    $('#sup_name').val(data['name']);
                    $('#sup_code').val(data['code']);
                    $('#sup_person').val(data['contact_person']);
                    $('#sup_number').val(data['contact_number']);
                    $('#sup_address').val(data['address']);
                    $('#sup_tin').val(data['tin_number']);
                    $('#sup_vat').val(data['vatable']);
                    $('#sup_email').val(data['email']);
                });
            });
        });

    });


    $('.productSupplierBtn').each(function (index) {
        $(this).click(function () {
            var qid = $(this).data("ids");
            window.open("/supplier_products/all_list?id=" + qid, '_blank');
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