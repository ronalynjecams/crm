<?php
$isAuthorized = 'super_admin';
$userrole = $UserIn['User']['role'];
if($userrole == $isAuthorized) {
?>

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">Update Signature</h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>User <span class="text-danger">*</span></label>
                            <select class="form-control" id="select_users">
                                <option>---- Select Users ----</option>
                                <?php
                                    foreach($get_users as $ret_users) {
                                        $users_obj = $ret_users['User'];
                                        $id = $users_obj['id'];
                                        $namef = $users_obj['first_name'];
                                        $namel = $users_obj['last_name'];
                                        $namefull = ucwords($namef." ".$namel);
                                        ?>
                                        <option value="<?= $id; ?>"><?= $namefull; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button id="updateSigns" class="btn btn-success">Update Signatures</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Signature <span class="text-danger">*</span></label>
                            <input type="file" id="ips" class="form-control" />
                        </div>
                        <div class="form-group img-responsive" id="div_img_preview_sign">
                            <img src="/img/product-uploads/image_placeholder.jpg"
                                 class="img-responsive" id="img_preview_sign" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--JAVASRIPT-->
<script>
$(document).ready(function() {
    $("#select_users").select2({
        allowClear: true,
        width: '100%'
    });
    
    function read(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $("#img_preview_sign").attr('src', e.target.result);
            }
            
            reader.readAsDataURL($("#ips").prop('files')[0]);
        }
    }
    
    $("#ips").on('change', function() {
        read(this);
    });
    
    $('#updateSigns').on("click", function () {
        var user_id = $('#select_users');
        var sign = $("#ips");
        if(user_id.val()!="---- Select Users ----") {
            if(sign.val()!="") {
                var data = new FormData();
                jQuery.each($('input:file')[0].files, function(i, file) {
                    data.append('Image', file);
                });
                
                $.ajax({  
        			url: "/users/sign_upload",  
        			type: "POST",  
        			data: data,  
        			cache: false,
        			processData: false,  
        			contentType: false, 
        			context: $('input:file'),
        			success: function (msg) {
        				console.log(msg+"---Profile Picture was uploaded");
        				var image_tmp_sign = (sign.val()).split('\\');
                	    var image_filename_sign = image_tmp_sign[image_tmp_sign.length-1];
        				var userid = { "user_id": user_id.val(), 'img_sign': image_filename_sign };
                        $.ajax({
                            url: "/users/update_db_sign",
                            type: 'POST',
                            data: {'data': userid},
                            dataType: 'text',
                            success: function (id) {
                                console.log(id);
                                swal({
                                    title: "Success",
                                    text: "Successfully updated signature.",
                                    type: "success"
                                },
                                function (isConfirm) {
                                    if(isConfirm) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(eror) {
                                console.log(error);
                                swal({
                                    title: "Oops!",
                                    text: "An error occurred during role update. \n Please try again.",
                                    type: "warning"
                                });
                            }
                        });
        			},
        			error: function(error) {
        			    console.log("ERROR:"+error);
        			}
                });
            }
            else { sign.css({'border-color':'red'}) };
        }
        else { user_id.css({'border-color':'red'}); }
    });
});
</script>
<!--END OF JAVASCRIPT-->

<?php }
else {
    echo '
    <div id="content-container">
        <div id="page-content">
        This is a restricted area.
        </div>
    </div>
    ';
}
?>