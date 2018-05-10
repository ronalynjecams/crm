<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">Add images for <?php echo $product_name; ?></h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div id="err_msg">
                    <p class="text-danger" id="err_txt"></p>
                </div>
                <div id="row">
                    <div id="file">
                        <input id="input_file" type="file" class="form-control" multiple />
                    </div>
                    <div class="col-lg-2" align="center" id="buttons" hidden>
                        <button class="btn btn-primary" id="btn_start_upload"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Start upload">
                            <span class="fa fa-upload"></span>
                        </button>
                        <button class="btn btn-warning" id="btn_cancel_upload"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Cancel upload">
                            <span class="fa fa-close"></span>
                        </button>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div id="div_img_prev">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--JAVASCRIPT-->
<script type="text/javascript">
    var isButtonsVisible = false;
    
    if(isButtonsVisible) {
        $("#row").addClass('row');
        $("#file").addClass('col-lg-10');
        $("#buttons").show();
    }
    else {
        $("#row").removeClass('row');
        $("#file").removeClass('col-lg-10');
        $("#buttons").hide();
    }
    
    var names = [];
    $("#input_file").on('change', function(e) {
        $("html.remove").show();
        $("#div_img_prev").show();
        $("#row").addClass('row');
        $("#file").addClass('col-lg-10');
        $("#buttons").show();
        $("#err_txt").text('');

        names = $(this)[0].files.length;
        
        var files = $(this)[0].files;
        for(var i = 0; i<files.length; i++){
            imagesPreview(this, files[i]);
        }
    });
    

    function imagesPreview(input, object) {
        if (input.files) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var toappend = '<div class="col-lg-3" id="closest_div">'+
                                   '<div id="remove" class="remove pull-right" style="background-color: rgba(255, 255, 255, 0.7);'+
                                                                              'border-radius:50%;'+
                                                                              'width:20px;'+
                                                                              'height:20px;'+
                                                                              'top:24px;'+
                                                                              'position:relative;'+
                                                                              'z-index: 1;">'+
                                        '<center><span class="fa fa-close"></span></center>'+
                                   '</div>'+
                                   '<img style="height:244px; width:244px; z-index: 2;" class="prod_img" data-name="'+object.name+'" '+
                                   'src="'+event.target.result+'" />'+
                                   '<div class="well well-sm">'+object.size+' kB </div>'+
                               '</div>';
                $("div#div_img_prev").append(toappend);
            }

            reader.readAsDataURL(object);
        }
    };
    
    $("#btn_cancel_upload").on('click', function(e) {
        $("#input_file").val('');
        $("#div_img_prev").empty().hide();
        
        $("#input_file").val('');
        
        $("#row").removeClass('row');
        $("#file").removeClass('col-lg-10');
        $("#buttons").hide();
    });
    
    $("#btn_start_upload").on('click', function(e) {
        if(names != 0) {
            $("div.remove").hide();
            $("#input_file").prop('readonly', true);
            $("#btn_start_upload, #btn_cancel_upload").prop('disabled', true);
            $("#err_txt").text('Uploading... Please wait...');
            
            var data = new FormData();
            $('img.prod_img').each(function(e) {
                var src = $(this).attr('src');
                $.ajax({
                    url:"/products/additional_image_upload",
                    data:{
                        "id": "<?= $id; ?>",
                        "base64": src
                    },
                    type:"POST",
                    dataType: 'text',
                    success: function (msg) {
                        console.log(msg+"---Image was uploaded");
                        $("#div_img_prev").empty();
                        $("#input_file").prop('readonly', false).removeClass('col-lg-3');
                        $("#btn_start_upload, #btn_cancel_upload").prop('disabled', false);
                        $("#buttons").hide();
                        $("#err_txt").text('Uploaded succesfully!');
                        $("#input_file").val('');
                        isButtonsVisible = false;
                    },
                    error: function(err) {
                        console.log(err);
                        $("#input_file").prop('readonly', false).removeClass('col-lg-3');
                        $("#btn_start_upload, #btn_cancel_upload").prop('disabled', false);
                        $("#buttons").hide();
                        $("#err_txt").text('');
                        isButtonsVisible = false;
                        
                        swal({
                            title: "Oops!",
                            text: "An error occurred while uploading images.\nPlease try again.",
                            type: "warning"
                        });
                    }
                });
                // var src = $(this).attr('src');
                // var image = new Image();
                // image.src = src;
                // data.append("Image", src);
                
                // var data_name = $(this).data('name');
                // console.log(data_name);
                // var ImageURL = $(this).attr('src');
                // // Split the base64 string in data and contentType
                // var block = ImageURL.split(";");
                // // Get the content type of the image
                // var contentType = block[0].split(":")[1];// In this case "image/gif"
                // // get the real base64 content of the file
                // var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."
                
                // // Convert it to a blob to upload
                // var blob = b64toBlob(realData, contentType);
                
                // // Create a FormData and append the file with "image" as parameter name
                // var formDataToUpload = new FormData();
                // formDataToUpload.append("Image", blob);
                // console.log(formDataToUpload);
        //         $.ajax({  
        //             url: "/products/image_upload",  
        //             type: "POST",  
        //             data:  data,
        // 			processData: false,  
        // 			contentType: false,
        // 			cache: false,
        //             success: function (msg) {
        //                 console.log(msg+"---Image was uploaded");
        //                 $("#div_img_prev").empty();
        //                 $("#input_file").prop('readonly', false).removeClass('col-lg-3');
        //                 $("#btn_start_upload, #btn_cancel_upload").prop('disabled', false).hide();
        //                 $("#err_txt").text('Uploaded succesfully!');
                        
        //                 $("#row").addClass('row');
        //                 $("#file").addClass('col-lg-10');
        //                 $("#buttons").show();
        //             },
        //             error: function(err) {
        //                 console.log(err);
        //                 $("#input_file").prop('readonly', false).removeClass('col-lg-3');
        //                 $("#btn_start_upload, #btn_cancel_upload").prop('disabled', false).hide();
        //                 $("#err_txt").text('');
                        
        //                 swal({
        //                     title: "Oops!",
        //                     text: "An error occurred while uploading images.\nPlease try again.",
        //                     type: "warning"
        //                 });
        //             }
        //         });
            });
        }
        else {
            swal({
                title: "Oops!",
                text: "Please select images.",
                type: "warning;"
            });
        }
    });
    
    $("html").on('click', function(e) {
        var target_close = $(e.target).prop('nodeName');
        if(target_close == "CENTER"
          || target_close == "SPAN") {
            $("#input_file").val('');
            $(e.target).closest('div#closest_div').remove();
            names--;

            if(names == 0) {
                $("#row").removeClass('row');
                $("#file").removeClass('col-lg-10');
                $("#buttons").hide();
            }
            else {
                $("#row").addClass('row');
                $("#file").addClass('col-lg-10');
                $("#buttons").show();
            }
        }
    });
    
    /**
     * Convert a base64 string in a Blob according to the data and contentType.
     * 
     * @param b64Data {String} Pure base64 string without contentType
     * @param contentType {String} the content type of the file i.e (image/jpeg - image/png - text/plain)
     * @param sliceSize {Int} SliceSize to process the byteCharacters
     * @see http://stackoverflow.com/questions/16245767/creating-a-blob-from-a-base64-string-in-javascript
     * @return Blob
     */
    // function b64toBlob(b64Data, contentType, sliceSize) {
    //         contentType = contentType || '';
    //         sliceSize = sliceSize || 512;
    
    //         var byteCharacters = atob(b64Data);
    //         var byteArrays = [];
    
    //         for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
    //             var slice = byteCharacters.slice(offset, offset + sliceSize);
    
    //             var byteNumbers = new Array(slice.length);
    //             for (var i = 0; i < slice.length; i++) {
    //                 byteNumbers[i] = slice.charCodeAt(i);
    //             }
    
    //             var byteArray = new Uint8Array(byteNumbers);
    
    //             byteArrays.push(byteArray);
    //         }
    
    //       var blob = new Blob(byteArrays, {type: contentType});
    //       return blob;
    // }
</script>
<!--END OF JAVASCRIPT-->