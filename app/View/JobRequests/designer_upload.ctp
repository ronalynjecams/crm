 
<link href="/css/plug/dropzone/dropzone.min.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">
<!--Dropzone [ OPTIONAL ]-->
<script src="/css/plug/dropzone/dropzone.min.js"></script>
<script src="/js/sweetalert.min.js"></script>
<div id="content-container" >
    <div id="page-title">
        <h1 class="page-header text-overflow">Job Request <small>[<?php echo $data['QuotationProduct']['Quotation']['Client']['name']; ?>]</small></h1>
        <h5 class=" text-overflow"><?php echo $data['QuotationProduct']['Quotation']['User']['first_name']; ?></h5>
    </div>
    <div id="page-content"> 




        <div class="row"> 
            <div class="panel">
                <!--<div class="panel-heading">-->
                <!--<h3 class="panel-title">Bootstrap theme</h3>-->
                <!--</div>-->
                <div class="panel-body"> 
                    <div align="right">
                        <a class="btn btn-info" href="/job_requests/joupdate_designer?id=<?php echo $data['QuotationProduct']['Quotation']['id']; ?>">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <?php echo '<input type="hidden" id="idd" value="' . $this->params['url']['id'] . '">'; ?>
                    <!--Dropzonejs using Bootstrap theme-->
                    <!--===================================================-->
                    <p>Upload necessary files for production of product designed.</p>
                    <p><small class="text-danger">Reminder: Once product is verified by your head, this will be automatically be received by the Production Department. 
                            <br/>Any changes will not be accepted by the system once production started. 
                            <br/>Make sure to finalize and acquire clients' approval before uploading any file.</small></p>

                    <div class="bord-top pad-ver">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button dz-clickable">
                            <i class="fa fa-plus"></i>
                            <span>Add files...</span>
                        </span>

                        <div class="btn-group pull-right">
                            <button id="dz-upload-btn" class="btn btn-primary" type="submit" disabled>
                                <i class="fa fa-upload"></i> Upload
                            </button>
                            <button id="dz-remove-btn" class="btn btn-danger cancel" type="reset" disabled>
                                <i class="demo-pli-cross"></i> Remove all
                            </button>
                        </div>
                    </div>
                    <?php
                    // pr($files);
                    if (!empty(count($files))) {

                        foreach ($files as $file) {
                            $path = $file['JrUpload']['file'];
                            $data = explode($this->params['url']['id'] . '/', $path);
                            // pr($data);
                            ?>

                            <div  >
                                <div  class="pad-top bord-top">
                                    <div class="media">
                                        <div class="media-body">
                                            <!--This is used as the file preview template-->
                                            <div class="media-block">
                                                <div class="media-left">

                                                </div>
                                                <div class="media-body"> 
                                                    <p class="text-main text-bold mar-no text-overflow" ><?php echo $path; ?></p>
                                                    <span class="dz-error text-danger text-sm" ></span>
                                                    <p class="text-sm" ></p>
                                                    <div id="dz-total-progress" style="opacity:0">
                                                        <div class="progress progress-xs active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-right">
                                            <button class="btn btn-xs btn-danger remove-uploaded" data-id="<?php echo $file['JrUpload']['id']; ?>"><i class="demo-pli-cross"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <?php
                        }
                    }
                    ?>
                    <div id="dz-previews">
                        <div id="dz-template" class="pad-top bord-top">
                            <div class="media">
                                <div class="media-body">
                                    <!--This is used as the file preview template-->
                                    <div class="media-block">
                                        <div class="media-left">
                                            <img class="dz-img" data-dz-thumbnail>
                                        </div>
                                        <div class="media-body"> 
                                            <p class="text-main text-bold mar-no text-overflow" data-dz-name></p>
                                            <span class="dz-error text-danger text-sm" data-dz-errormessage></span>
                                            <p class="text-sm" data-dz-size></p>
                                            <div id="dz-total-progress" style="opacity:0">
                                                <div class="progress progress-xs active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-right">
                                    <button data-dz-remove class="btn btn-xs btn-danger dz-cancel"><i class="demo-pli-cross"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End Dropzonejs using Bootstrap theme-->


                </div>
            </div>
        </div>
    </div>
</div> 
<script>

    $(document).ready(function () {

        // DROPZONE.JS
        // =================================================================
        // Require Dropzone
        // http://www.dropzonejs.com/
        // =================================================================
        Dropzone.options.demoDropzone = {// The camelized version of the ID of the form element
            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            //parallelUploads: 25,
            //maxFiles: 25,

            // The setting up of the dropzone
            init: function () {
                var myDropzone = this;
                //  Here's the change from enyo's tutorial...
                //  $("#submit-all").click(function (e) {
                //  e.preventDefault();
                //  e.stopPropagation();
                //  myDropzone.processQueue();
                //
                //}
                //    );

            }

        }



        // DROPZONE.JS WITH BOOTSTRAP'S THEME
        // =================================================================
        // Require Dropzone
        // http://www.dropzonejs.com/
        // =================================================================
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#dz-template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var id = $("#idd").val();
        var uplodaBtn = $('#dz-upload-btn');
        var removeBtn = $('#dz-remove-btn');
        var myDropzone = new Dropzone(document.body, {// Make the whole body a dropzone
            url: "/jr_products/uploadFiles/" + id, // Set the url
            thumbnailWidth: 50,
            thumbnailHeight: 50,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#dz-previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        });


        myDropzone.on("addedfile", function (file) {
            // Hookup the button
            uplodaBtn.prop('disabled', false);
            removeBtn.prop('disabled', false);

        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            $("#dz-total-progress .progress-bar").css({'width': progress + "%"});
        });

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            document.querySelector("#dz-total-progress").style.opacity = "1";
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#dz-total-progress").style.opacity = "0";

        });


        // Setup the buttons for all transfers
        uplodaBtn.on('click', function () {
            //Upload all files
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));


            $(".dz-cancel").each(function (index) {
                $(this).hide();
            });
            removeBtn.hide();
            uplodaBtn.hide();
//            $(".dz-clickable").hide();


        });

        removeBtn.on('click', function () {
            myDropzone.removeAllFiles(true);
            uplodaBtn.prop('disabled', true);
            removeBtn.prop('disabled', true);
        });

    });



    $(".remove-uploaded").each(function (index) {
        $(this).click(function () {
            var jr_upload_id = $(this).data("id");
//            alert(jr_upload_id);
//                $(this).hide();

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file.",
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

                            $.ajax({
                                url: "/jr_uploads/removeFile",
                                type: 'POST',
                                data: {'id': jr_upload_id},
                                dataType: 'json',
                                success: function (dd) { 
                                    location.reload();
//                                        window.location.replace("/job_requests/joupdate?id=" + quotation_id);
//                                    console.log(dd);
                                },
                                error: function (dd) {
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });
        });
    });
</script>