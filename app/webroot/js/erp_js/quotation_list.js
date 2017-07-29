/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    
        $('#jobRequeBtn').on('click', function (e) {
            $("#jobRequestBtn").prop("disabled", true);
            var date = new Date();
            var month = date.getMonth();
            var number = (Math.random() + ' ').substring(2, 5) + (Math.random() + ' ').substring(2, 5);
//            var quotation_id = $("#quotation_id").val();

            var quotation_id = $(this).data("quoteid");
            var status = 'pending';
            var jr_number = 'JECJR-' + month + number;
            $.ajax({
                url: "/job_requests/saveNewJobRequest",
                type: 'POST',
                data: {'status': status, 'jr_number': jr_number, 'quotation_id': quotation_id},
                dataType: 'json',
                success: function (dd) {
                    //redirect to edit of products
                    location.reload();
                },
                error: function (dd) {
                }
            });
        });

        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
    });