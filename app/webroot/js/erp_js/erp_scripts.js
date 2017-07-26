/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    
     
            $('#saveLead').on("click", function(){ 
              var name = $('#name').val();   
              var contact_person = $('#contact_person').val();   
              var position = $('#position').val();   
              var address = $('#address').val();   
              var email = $('#email').val();   
              var contact_number = $('#contact_number').val();   
              var tin_number = $('#tin_number').val();   

            if((name!="")){ 
                if(contact_person!=""){
                    if(address!=""){
                        if(email!=""){
                            if(contact_number!=""){
                                        var data = { "name": name, 
                                        "contact_person":contact_person,
                                        "position":position,
                                        "address":address,
                                        "email":email,
                                        "contact_number":contact_number,
                                        "tin_number":tin_number, 
                                        "type":'client'
                                    } 
                                $.ajax({
                                   url: "/clients/add_leads",
                                    type: 'POST', 
                                    data: {'data': data},
                                    dataType: 'json',
                                            success: function(id){
                                             location.reload();  	  
                                            },
                                            erorr: function(id){ 
                                                alert('error!');
                                            }
                                     });
                            }else{
                                document.getElementById('contact_number').style.borderColor = "red";
                            }
                        }else{
                            document.getElementById('email').style.borderColor = "red";
                        }
                    }else{
                        document.getElementById('address').style.borderColor = "red";
                    }
                }else{
                    document.getElementById('contact_person').style.borderColor = "red";
                }
            }else{ 
                document.getElementById('name').style.borderColor = "red";
            }  
            });
    
    
  
    });
