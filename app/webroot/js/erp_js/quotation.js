/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */    
//
function saveProcess(data){
//    
    $.ajax({
        url: "/quotations/saveCreateQuotation",
        type: 'POST', 
        data: {'data': data},
        dataType: 'json',
        success: function(dd){ 
            if(data.Qfield == 'delivery_mode'){
                location.reload();
            }else{
                console.log(data);
            }
            
        },
        error: function(dd){
            console.log(dd);
        }
    }); 
}

$(document).ready(function() {
    
    
       var date = new Date();
       date.setDate(date.getDate()-1);
       $("#product_id").select2({
           placeholder: "Select Product Code", 
           width: '100%',
           allowClear: false
       }); 
       $("#client_id").select2({
           placeholder: "Select Client Name",
           allowClear: true
       }); 
        
       $('#datePicker')
           .datepicker({
               format: 'yyyy-mm-dd',
               startDate: date,
               endDate: '+1m'
        });
       $('#datePicker-pickup')
           .datepicker({
               format: 'yyyy-mm-dd',
               startDate: date, 
        });
       $('#datePicker-deliver')
           .datepicker({
               format: 'yyyy-mm-dd',
               startDate: date, 
        });
   
    
    ///// validity_date /////
    $('#validity_date').on('change',function(e){  
        var value = $("#validity_date").val(); 
        var id = $("#quotation_id").val();
        var Qfield = 'validity_date';

            var data = { "id": id,
                "value":value,
                "Qfield":Qfield
            } 
            saveProcess(data);
    });
    
    
   
    
    ///// CLIENT ///// 
           $("#client_id").change(function() { 
               $(".oldInfo").remove();
               $(".cInfo").remove();
               var id = $("#client_id").val(); 
                   $.get('/clients/my_client_info', {
                                   id: id, 
                               },function(data){ 
                   $(".client_info").append('<div class="form-group cInfo">'+
                                       '<div class="col-sm-6">'+
                                          '<label class="control-label">Contact Person</label>'+
                                               '<input type="text" class="form-control" readonly id="contact_person" value="'+data['contact_person']+'">'+
                                       '</div>'+
                                       '<div class="col-sm-6">'+
                                           '<label class="control-label">Contact Number</label>'+
                                               '<input type="text" class="form-control" readonly id="contact_number" value="'+data['contact_number']+'">'+
                                       '</div>'+
                                   '</div>'); 
                       });
   
                var value = $("#client_id").val(); 
                var id = $("#quotation_id").val();
                var Qfield = 'client_id';

                    var data = { "id": id,
                        "value":value,
                        "Qfield":Qfield
                    } 
                    saveProcess(data);
           }); 
    /// DELIVERY MODE ///  
    $("#delivery_mode").change(function() {
        var delivery_mode = $("#delivery_mode").val(); 
        var id = $("#quotation_id").val();
         
            $("#addresses").hide();
        if(delivery_mode == 'pickup'){ 
            $("#addresses").hide();  
        }else if(delivery_mode == 'deliver'){ 
            $("#addresses").show();  
        } else{ 
            $("#addresses").hide();  
        }

            var data = { "id": id,
                "value":delivery_mode,
                "Qfield":'delivery_mode'
            } 

            saveProcess(data);
        
    });
    
    
    $('#target_delivery').on('change',function(e){  
        var value = $("#target_delivery").val();  
        var id = $("#quotation_id").val();
        var Qfield = 'target_delivery'; 
            var data = { "id": id,
                "value":value,
                "Qfield":Qfield
            } 
            saveProcess(data);
    });
    
    
    
////////// BILLING and SHIPPING ADDRESS ///////

    $( "#bill_ship_save" ).click(function() { 
        var id = $("#quotation_id").val(); 
        var address = $("#bill_address").val(); 
        var geolocation = $("#bill_geolocation").val(); 
        var latitude = $("#bill_latitude").val(); 
        var longitude = $("#bill_longitude").val();  
        var type = 'bill_ship'; 
        
        var data = { "id": id,
            "address":address,
            "geolocation":geolocation,
            "latitude":latitude,
            "longitude":longitude, 
            "type":type
        }  
        saveBillingShipping(data);
    });

    $( "#bill_save" ).click(function() { 
        var id = $("#quotation_id").val(); 
        var address = $("#bill_address").val(); 
        var geolocation = $("#bill_geolocation").val(); 
        var latitude = $("#bill_latitude").val(); 
        var longitude = $("#bill_longitude").val();  
        var type = 'bill'; 
        
        var data = { "id": id,
            "address":address,
            "geolocation":geolocation,
            "latitude":latitude,
            "longitude":longitude, 
            "type":type
        }  
        saveBillingShipping(data);
    });

    $( "#ship_save" ).click(function() { 
        var id = $("#quotation_id").val(); 
        var address = $("#bill_address").val(); 
        var geolocation = $("#bill_geolocation").val(); 
        var latitude = $("#bill_latitude").val(); 
        var longitude = $("#bill_longitude").val();  
        var type = 'ship'; 
        
        var data = { "id": id,
            "address":address,
            "geolocation":geolocation,
            "latitude":latitude,
            "longitude":longitude, 
            "type":type
        }  
        saveBillingShipping(data);
    });



    ///// PRODUCT ///// 
           $("#product_id").change(function() {
                 
//     $("#saveProduct").prop("disabled",true);
//                $("#saveProduct").prop("disabled",false);
               $(".prod_details").remove();
               var id = $("#product_id").val(); 
               $.get('/quotations/product_info', {
                id: id, 
            },function(data){ 
                    var i; 
                    var v;
                    var prod_property = data['ProductProperty']; 
                    var prod_amount = 0;
                    for (i = 0; i < prod_property.length; i++) { 
                                var prod_value = data['ProductProperty'][i]['ProductValue'];
                                    for(v = 0; v < prod_value.length; v++){ 
                                        prod_amount = prod_amount + parseFloat(prod_value[v]['price']);
                                        $(".product_details_div").append('<div class="prod_details"><div class="col-sm-5"><input type="text" class="form-control " value="'+prod_property[i]['name']+'" readonly>'+
                                            '<input type="hidden" class="prop_id" value="'+prod_property[i]['id']+'"></div>'+
                                            '<div class="col-sm-6"><input type="text" class="form-control " value="'+prod_value[v]['value']+'" readonly>'+
                                            '<input type="hidden" class="prod_value_id" value="'+prod_value[v]['id']+'"></div>'+
                                            '<div class="col-sm-1"><a class="btn btn-xs btn-danger deldetail" > <i class="fa fa-minus"></i> </a></div></div>');
                                    }
                                     
                    } 
                   
                    $('.deldetail').each( function(index) {        
                        $(this).click( function() {   
                            $(this).closest(".prod_details").remove();
                        });
                   });
                   
                   $("#prod_other_info").remove();
                   $(".prod_other_info_div").append('<br/><div id="prod_other_info" class="form-group"><textarea id="other_info" rows="4" cols="70">'+data['Product']['other_info']+'</textarea></div>');
                   
                     function addCommas(nStr) {
                            nStr += '';
                            x = nStr.split('.');
                            x1 = x[0];
                            x2 = x.length > 1 ? '.' + x[1] : '';
                            var rgx = /(\d+)(\d{3})/;
                            while (rgx.test(x1)) {
                                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                            }
                            return x1 + x2;
                    }
                    
                    function truncate (num, places) {
                        return Math.trunc(num * Math.pow(10, places)) / Math.pow(10, places);
                      }
                     
                    $("#prod_amount_info").remove(); 
                   if(data['Product']['sale_price']==0){
                       //total of all product values
                       
//                    console.log(prod_amount);
                        $(".prod_amount_div").append('<div id="prod_amount_info" class="col-sm-12"><input type="hidden" id="sale" value="0"/><div class=" col-sm-6">'+  
                                '<div class="input-group mar-btm">'+
                                '<span class="input-group-btn">'+
                                '<button class="btn btn-default" disabled> Php</button> </span> '+
                                '<input class="form-control"  value="'+addCommas(truncate(prod_amount, 2))+'" readonly>'+    
                                '<input  type="hidden" class="form-control" id="prod_amount" value="'+prod_amount+'" readonly>'+    
                                '</div>'+  
                                '</div>'+ 
                                '<div class="col-sm-6"> <input type="number" id="prod_quantity" class="form-control" name="integer" placeholder="Quantity"></div>'+
                                '<div class="col-sm-12"><label>Product Price</label><input type="number" step="any" id="edited_amount" class="form-control"  value="'+truncate(prod_amount, 2)+'" > </div>'+
                                '</div>');
                   }else{
                       var sale_price = parseFloat(data['Product']['sale_price']); 
//                    console.log(sale_price);
//                        $('#edited_amount').mask('99-9999999');
                        $(".prod_amount_div").append('<div id="prod_amount_info" class="col-sm-12"><input type="hidden" id="sale" value="1"/><div class=" col-sm-6">'+
                                '<div class="input-group mar-btm">'+
                                '<span class="input-group-btn">'+
                                '<button class="btn btn-default" disabled> Php</button> </span> '+
                                '<input class="form-control"   value="'+addCommas(truncate(sale_price, 2))+'" readonly>'+  
                                '<input type="hidden" class="form-control" id="prod_amount" value="'+sale_price+'" readonly>'+   
                                '<span class="input-group-btn">'+
                                '<button class="btn btn-warning" type="button" disabled> <i class="fa fa fa-gift"></i> Sale!</button> </span> '+
                                '</div>'+ 
                                '</div>'+
                                '<div class="col-sm-6"> <input type="number" id="prod_quantity" class="form-control" name="integer" placeholder="Quantity"></div>'+
                                '<div class="col-sm-12"><label>Product Price</label><input type="number" step="any" id="edited_amount" class="form-control"  value="'+truncate(sale_price, 2)+'" > </div>'+
                                '</div>');
                   }
                   
                   
                   
                    $("#prod_img").remove(); 
                    $(".initial_product_type_div").remove(); 
                        $("#prod_image_add_div").append('<div id="prod_img"><img class="img-responsive" src="../product_uploads/'+data['Product']['image']+'"><input type="hidden" id="prdct_image" value="'+data['Product']['image']+'"></div>'+
                                                        '<div class="initial_product_type_div form-group"><br/><label>Product Type</label><input type="text" readonly value="'+data['Product']['type']+'" class="form-control" id="initial_prod_type"></div>');

            
                    $(".add_prod_detail_div").remove();
                        $(".product_details_div").append('<div class="add_prod_detail_div"><div class="col-sm-11" > </div><div class="col-sm-1" align="right"><a class="btn btn-xs btn-primary" id="add_prod_detail_btn"> <i class="fa fa-plus"></i> </a></div></div>');
                
                 
                 
                    $('#add_prod_detail_btn').click( function() { 
                        
                    $(".product_type_div").remove(); 
                    $(".initial_product_type_div").hide();
                        var product_type = $("#initial_prod_type").val();
                        if(product_type == 'supply'){
                            var new_type = 'combination';
                        }else{
                            var new_type = $("#initial_prod_type").val();
                        }
//                        
                    $(".initial_product_type_div").hide(); 
                    $("#prod_image_add_div").append('<div class="product_type_div form-group"><br/><label>Product Type</label><input type="text" readonly value="'+new_type+'" class="form-control" id="prod_type"></div>');
//pero kapag tig remove yung newly added properties ng product dapat babalik sya sa supply

                        $(".product_details_div").append('<div class="prod_details_new"><div class="col-sm-5"><input type="text" class="form-control prop_name"   >'+
                            '<input type="hidden"></div>'+
                            '<div class="col-sm-6"><input type="text" class="form-control prod_value"    >'+
                            '<input type="hidden"></div>'+
                            '<div class="col-sm-1"><a class="btn btn-xs btn-danger deldetail_new" > <i class="fa fa-minus"></i> </a></div></div>');
                    
                        $('.deldetail_new').each( function(index) {        
                            $(this).click( function() {    
                                $(this).closest(".prod_details_new").remove(); 
                                if($('.deldetail_new').length == 0){
                                    $(".initial_product_type_div").show(); 
                                    $(".product_type_div").remove(); 
                                } 
                            });
                        });

                   }); 
                    
                 
            });
           }); 
    
    
    ///// PRODUCT END ///// 
    
    
}); ///// end of document ready

function saveSubject(){
    var subject = $("#subject").val(); 
    var id = $("#quotation_id").val();
    var Qfield = 'subject';
    
    var data = { "id": id,
        "value":subject,
        "Qfield":Qfield
    } 
    
    saveProcess(data);
}

function saveBillingShipping(data){  
    $.ajax({
        url: "/quotations/saveAddressQuotation",
        type: 'POST', 
        data: {'data': data},
        dataType: 'json',
        success: function(dd){   
            location.reload();
        },
        error: function(dd){
            console.log(dd);
        }
    }); 
}

 