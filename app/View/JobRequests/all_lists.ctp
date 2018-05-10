<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
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
        <h1 class="page-header text-overflow"><?php echo ucwords($status); ?> Job Request</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel"> 
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Client<br/>[Job Request No.]</th>
                            <th align="center">Quotation Type<br/> [Status]</th> 
                            <th align="center">Sales Executive</th>   
                            <th align="center"> </th> 
                        </tr>
                    </thead>
                    <tbody> 
                    <?php 
                        foreach($job_requests as $job_request){
                            $job_request_id = $job_request['JobRequest']['id'];
                            $client = $job_request['Client']['name'];
                            $jr_number = $job_request['JobRequest']['jr_number'];
                            $quotation_type = $job_request['Quotation']['type'];
                            $quotation_status = $job_request['Quotation']['status'];
                            $first_name = $job_request['User']['first_name'];
                            $last_name = $job_request['User']['last_name'];
                            $quotation_number = $job_request['Quotation']['quote_number'];
                            
                    ?> 
                        <tr>
                            <td data-order="<?php echo $job_request['JobRequest']['created']; ?>">
                                <?php echo time_elapsed_string($job_request['JobRequest']['created']);
                                     echo '<br/><small>' . date('h:i a', strtotime($job_request['JobRequest']['created'])) . '</small>'; ?>
                            </td> 
                            <td align="center"><?php echo $client.'<br/>['.$jr_number.']'; ?></td>
                            <td align="center"><?php echo $quotation_number.'-'.$quotation_type.'<br/>['.$quotation_status.']'; ?></td>
                            <td align="center"><?php echo ucwords($first_name.'  '.$last_name); ?></td>   
                            <td align="center">
                                <?php
                                // =========================> JOB REQUEST REVISION START HERE
                                $date_up = new DateTime(date('Y-m-d', strtotime("2018-05-02")));
                                $jo_created = new DateTime(date('Y-m-d', strtotime($job_request['JobRequest']['created'])));
                                $interval = $date_up->diff($jo_created);
                                $interval_day = $interval->format('%R%a');
                                if($interval_day>=0) {
                                    echo '<a href="/job_requests/view_jr?id='.$job_request_id.'"
                                               target="_blank" class="btn btn-primary btn-sm  add-tooltip "
                                               data-toggle="tooltip"  data-original-title="View Job Request" >
                                                <i class="fa fa-eye"></i>
                                            </a>';
                                }
                                else {
                                    echo '<a href="/job_requests/joupdate?id='.$job_request['JobRequest']['quotation_id'].'"
                                               target="_blank" class="btn btn-primary btn-sm  add-tooltip "
                                               data-toggle="tooltip"  data-original-title="View Job Request" >
                                                <i class="fa fa-eye"></i>
                                            </a>';
                                }
                                // ======================> JOB REQUEST REVISION END HERE
                                ?>
                                <a href="/reports/print_jr?id=<?php echo $job_request_id; ?>"
                                   class="btn btn-default btn-sm add-tooltip"
                                   data-original-title="Print JR"
                                   target="_blank">
                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                </a>
                            </td> 
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Client<br/>[Job Request No.]</th>
                            <th align="center">Quotation Type<br/> [Status]</th> 
                            <th align="center">Sales Executive</th>   
                            <th align="center"> </th> 
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--===================================================--> 
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "desc"]],
            "stateSave": true
        });
 
    });
</script>
