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

    /*.table-condensed{*/
    /*  font-size: 12px;*/
    /*}*/
</style>
<!--CONTENT CONTAINER-->

<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow animated fadeInDown">Inventory Locations</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
<div id="page-content">


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">

                 <div class="panel-heading" align="right">
                    <h3 class="panel-title">
                        <?php #if(( $UserIn['User']['role'] == 'fitout_facilitator')){ ?>
                            <button class="btn btn-success add-tooltip btn-md" data-toggle="tooltip" data-placement="top" data-original-title="Add new people involve" id="add_location" tooltip="Add new people involve"><i class="fa fa-plus"></i>&nbsp;Add Location</button>
                        <?php #} ?>
                    </h3>
               </div>


            <div class="panel-body">
                <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php foreach($locations as $location){ ?>
                        <tr>
                            <td><?php echo h($location['InvLocation']['name']); ?></td>
                            <td>
                             <?php
                                #if(( $UserIn['User']['role'] == 'fitout_facilitator' )){
                                    echo"<div class='row'>";
                                        echo"<div class='col-sm-1'>";
                                            echo '<a class="btn btn-default btn-icon add-tooltip viewBtn btn-xs" data-toggle="tooltip" href="/InventoryProducts/warehouse_list?id='.$location['InvLocation']['id'].'" data-original-title="view" ><i class="fa fa-eye"></i></a>';
                                         echo"</div>";
                                    echo"</div";
                                #}
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
</div>

<!--Add New people Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-location-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Add Location</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group" id="name_validation">
                    <form>
                      <input type="text" class="form-control" id="location" placeholder="Location name"/>
                  </form>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="addLocation">Add</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--New people Modal End !-->


<script>
    $('#add_location').on("click", function () {
        $('#add-location-modal').modal('show');
    });

    $(document).ready(function () {

        $('#example2').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });

    $('#addLocation').on("click", function () {
        var location = $('#location').val();

            if((location != "")){

                var data = {"location": location }
                            $.ajax({
                                url: "/InvLocations/add_location",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'json',
                                success: function (id) {
                                    // location.reload();
                                    window.location.replace("/InvLocations/all_list");
                                },
                                error: function() {
                                    swal({title:'Location already exist', text:'duplicate record', type:'info', timer:'2000'})
                                }
                            });

        } else {
            document.getElementById('location').style.borderColor = "red";
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