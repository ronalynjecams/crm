<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script> 
<script src="../js/sweetalert.min.js"></script>  
<div id="content-container" >
    <div id="page-title">
        <h4 class="  text-overflow">Collections for <b><?php echo $quote_data['Client']['name']; ?></b> with a total contract of &#8369; <?php echo number_format($quote_data['Quotation']['grand_total'], 2); ?></h4>
        <input type="hidden" id="quotation_id" value="<?php echo $id; ?>">
    </div>
    <div id="page-content">  
        <!--        <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">
                            <button class="btn btn-primary moveQuote" data-buttontype="save" >Move to purchasing</button> 
                            <button class="btn btn-danger cancelQuote">Cancel</button> 
                        </h3>
                    </div>
                </div>-->
        <div class="col-sm-3">
            <div class="panel" id="withbalance">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#move-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Collection Form</h3>
                </div>
                <div id="move-panel-collapse" class="collapse in">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12"> 
                                <div class="form-group  "> 
                                    <label class="control-label">Payment Mode</label>  
                                    <select id="payment_mode" class="form-control"> 
                                        <option value=""> select </option>
                                        <option value="cash"> cash </option>
                                        <option value="online"> online </option>
                                        <option value="check"> check </option> 
                                        <option value="documents"> documents </option>  
                                    </select>
                                </div>  
                            </div>  
                        </div> 
                        <div class="row amount_div">
                            <div class="col-sm-12"> 
                                <div class="form-group ">
                                    <label class="control-label">Amount </label>  
                                    <input type="number" span="any" id="amount_paid" class="form-control">
                                </div>  
                            </div> 
                            <div class="col-sm-12"> 
                                <div class="form-group ">
                                    <label class="control-label">With Held Amount</label>  
                                    <input type="number" span="any" id="with_held" class="form-control" value="0">
                                </div> 
                            </div> 
                            <div class="col-sm-12"> 
                                <div class="form-group ">
                                    <label class="control-label">Other Amount</label>  
                                    <input type="number" span="any" id="other_amount" class="form-control" value="0">
                                </div> 
                            </div> 
                        </div>   
                        <div class="row">
                            <div class="check_online_mode_div">
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Bank </label>  
                                        <select id="bank_id" class="form-control"> 
                                            <option value=""> select </option>
                                            <?php
                                            foreach ($banks as $bank) {
                                                echo '<option value="' . $bank['Bank']['id'] . '"> ' . $bank['Bank']['display_name'] . ' </option> ';
                                            }
                                            ?>
                                        </select>
                                    </div>  
                                </div> 
                            </div> 
                            <div class="check_mode_div">
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Check Number </label>  
                                        <input type="number" span="any" id="check_number" class="form-control">
                                    </div> 
                                </div>
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Check Date </label>  
                                        <input type="date" id="check_date" class="form-control">
                                    </div> 
                                </div> 
                            </div> 
                            <div class="document_div">
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Select Document </label>   
                                        <select class="form-control" id="accounting_paper">
                                            <option></option>
                                            <?php
                                            foreach ($papers as $paper) {
                                                echo '<option value=' . $paper['AccountingPaper']['id'] . ' data-papertype=' . $paper['AccountingPaper']['type'] . '>' . $paper['AccountingPaper']['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                </div> 
                            </div> 
                            <div class="document_data_div">
                                <div class="document_data_div_amount">
                                    <div class="col-sm-12"> 
                                        <div class="form-group ">  
                                            <label class="control-label">Amount </label>  
                                            <input type="number" span="any" id="amount_paper" class="form-control">
                                        </div> 
                                    </div> 
                                </div>  
                                <div class="document_data_div_ref">
                                    <div class="col-sm-12"> 
                                        <div class="form-group ">  
                                            <label class="control-label">Reference # </label>  
                                            <input type="number" id="ref_num" class="form-control">
                                        </div> 
                                    </div> 
                                    <div class="col-sm-12"> 
                                        <div class="form-group ">  
                                            <label class="control-label">Date</label>  
                                            <input type="date" id="ref_date" class="form-control">
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 

                            <div class="col-sm-12" align="right">
                                <button class="btn btn-primary moveQuote" data-buttontype="save" >Add Collection</button> 
                            </div>
                        </div>     


                    </div>
                </div>
            </div>


            <!--this panel will shoe if fully paid-->

            <div class="panel" id="withNObalance">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#move-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Documents</h3>
                </div>
                <div id="move-panel-collapse" class="collapse in">
                    <div class="panel-body">

                        <div class="row"> 
                            <div class="">
                                <div class="col-sm-12"> 
                                    <div class="form-group ">
                                        <label class="control-label">Select Document </label>   
                                        <select class="form-control" id="paidaccounting_paper">
                                            <option></option>
                                            <?php
                                            foreach ($papers as $paper) {
                                                echo '<option value=' . $paper['AccountingPaper']['id'] . ' data-papertype=' . $paper['AccountingPaper']['type'] . '>' . $paper['AccountingPaper']['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                </div> 
                            </div> 
                            <div class="document_data_div">
                                <div class=" ">
                                    <div class="col-sm-12"> 
                                        <div class="form-group ">  
                                            <label class="control-label">Amount </label>  
                                            <input type="number" span="any" id="paidamount_paper" class="form-control">
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="document_data_div_ref">
                                    <div class="col-sm-12"> 
                                        <div class="form-group ">  
                                            <label class="control-label">Reference # </label>  
                                            <input type="number" id="paidref_num" class="form-control">
                                        </div> 
                                    </div> 
                                    <div class="col-sm-12"> 
                                        <div class="form-group ">  
                                            <label class="control-label">Date</label>  
                                            <input type="date" id="paidref_date" class="form-control">
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 

                            <div class="col-sm-12" align="right">
                                <button class="btn btn-primary " id="moveQuotePaid" data-buttontype="save" >Add Document</button> 
                            </div>
                        </div>     


                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-9">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">  
                        <button class="btn btn-default" data-target="#qInfo-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                    </div>
                    <h3 class="panel-title"> Collection information <span id="paymentStats" class="text-success"></span></h3>
                </div>
                <div id="qInfo-panel-collapse" class="collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <tr>
                                    <th>Date Created</th>
                                    <th>Collected Amount</th>
                                    <th>With Held Amount</th>
                                    <th>Other Amount</th>
                                    <th>Bank</th>
                                    <th>Check Number</th>
                                    <th>Check Date</th>
                                    <th>Status</th>
                                </tr>
                                <?php
//                                pr($collection_data);
                                $grand_total = 0;
                                foreach ($collection_data as $collection) {
                                    if ($collection['Collection']['type'] != 'bir2307' && $collection['Collection']['type'] != 'none') {
                                        ?>
                                        <tr>
                                            <td>

                                                <?php
                                                echo date('F d, Y', strtotime($collection['Collection']['created']));
                                                echo '<br/><small>' . date('h:i a', strtotime($collection['Collection']['created'])) . '</small>';
                                                ?>  
                                            </td>
                                            <td align="right">
                                                <?php
                                                echo '&#8369; ' . number_format($collection['Collection']['amount_paid'], 2);
                                                ?> 
                                            </td>
                                            <td align="right">
                                                <?php
                                                if ($collection['Collection']['with_held'] != 0) {
                                                    echo '&#8369; ' . number_format($collection['Collection']['with_held'], 2);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td align="right">
                                                <?php
                                                if ($collection['Collection']['other_amount'] != 0) {
                                                    echo '&#8369; ' . number_format($collection['Collection']['other_amount'], 2);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                if ($collection['Collection']['bank_id'] != 0) {
                                                    echo $collection['Bank']['name'];
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                if ($collection['Collection']['bank_id'] != 0) {
                                                    echo $collection['Collection']['check_number'];
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td> 
                                                <?php
                                                if (!is_null($collection['Collection']['check_date'])) {
                                                    echo date('F d, Y', strtotime($collection['Collection']['check_date']));
                                                    echo '<br/><small>' . date('h:i a', strtotime($collection['Collection']['check_date'])) . '</small>';
                                                } else {
                                                    echo '-';
                                                }
                                                ?> 
                                            </td>
                                            <td>
                                                <?php
                                                if ($collection['Collection']['status'] == 'verified') {
                                                    $total = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'] + $collection['Collection']['other_amount'];
                                                    $grand_total = $grand_total + $total;
                                                    echo '<p class="text-success">Verified</p>';
//                                                    if ($collection['Collection']['type']
                                                    //only accounting head or proprietor could void any collection
//                                                    if ($userRole == 'accounting_head' || $userRole == 'proprietor') {
//                                                        echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collection" data-toggle="tooltip"  data-original-title="Delete Collection" data-collectionid="' . $collection['Collection']['id'] . '" data-stats="void"><i class="fa fa-close"></i></button>';
//                                                    }
                                                } else if ($collection['Collection']['status'] == 'void') {
                                                    echo '<p class="text-danger">Void</p>';
                                                } else {
                                                    echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collection" data-toggle="tooltip"  data-original-title="Delete Collection" data-collectionid="' . $collection['Collection']['id'] . '" data-quotecollectionid="' . $collection['Collection']['quotation_id'] . '" data-stats="void"><i class="fa fa-close"></i></button>';
                                                    echo '&nbsp; <button class="btn btn-xs btn-success add-tooltip updateStatus_collection"  data-toggle="tooltip"  data-original-title="Verify Collection" data-collectionid="' . $collection['Collection']['id'] . '" data-quotecollectionid="' . $collection['Collection']['quotation_id'] . '"data-stats="verified"><i class="fa fa-check"></i></button>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        
                                    }
                                }
                                ?>
                                <tr>
                                    <td><b>Grand Total:</b></td> 
                                    <td colspan="3" align="right"><b><?php echo '&#8369; ' . number_format($grand_total); ?></b></td>
                                    <td colspan="4"></td>
                                </tr>
                            </table> 
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <?php if (count($collection_papers) != 0) { ?> 
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">  
                            <button class="btn btn-default" data-target="#qInfo-panel-collapse" data-toggle="collapse"><i class="demo-pli-arrow-down"></i></button>
                        </div>
                        <h3 class="panel-title"> Collection Documents</h3>
                    </div>
                    <div id="qInfo-panel-collapse" class="collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Document</th>
                                        <th>Amount</th>
                                        <th>Reference Number</th>
                                        <th>Reference Date</th> 
                                        <th>Status</th>
                                    </tr>
                                    <?php
                                    foreach ($collection_papers as $collection_paper) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo date('F d, Y', strtotime($collection_paper['CollectionPaper']['created']));
                                                echo '<br/><small>' . date('h:i a', strtotime($collection_paper['CollectionPaper']['created'])) . '</small>';
                                                ?> 
                                            </td>
                                            <td> <?php echo $collection_paper['AccountingPaper']['name']; ?>  </td> 
                                            <td> <?php echo '&#8369; ' . number_format($collection_paper['CollectionPaper']['amount'], 2); ?>  </td> 
                                            <td> <?php echo $collection_paper['CollectionPaper']['ref_number']; ?>  </td> 
                                            <td> <?php if(!is_null($collection_paper['CollectionPaper']['ref_date']))echo date('F d, Y', strtotime($collection_paper['CollectionPaper']['ref_date'])); ?>  </td> 
                                            <td> <?php
                                                if ($collection_paper['CollectionPaper']['status'] == 'onhand') {
                                                    echo '<p class="text-success">Onhand</p>';
                                                    //only accounting head or proprietor could void any collection paper
                                                    if ($userRole == 'accounting_head' || $userRole == 'proprietor') {
                                                        echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collectionPaper" data-toggle="tooltip"  data-original-title="Delete Document" data-collectionpaperid="' . $collection_paper['CollectionPaper']['id'] . '" data-statspaper="deleted" data-typepaper="' . $collection_paper['AccountingPaper']['type'] . '">delete</button>';
                                                        echo ' <button class="btn btn-xs btn-warning add-tooltip updateStatus_collectionPaper" data-toggle="tooltip"  data-original-title="Void Document" data-collectionpaperid="' . $collection_paper['CollectionPaper']['id'] . '" data-statspaper="void" data-typepaper="' . $collection_paper['AccountingPaper']['type'] . '">void</button>';
                                                    }
                                                } else if ($collection_paper['CollectionPaper']['status'] == 'void') {
                                                    echo '<p class="text-danger">Void</p>';
                                                } else {
                                                    echo ' <button class="btn btn-xs btn-warning add-tooltip updateStatus_collectionPaper" data-toggle="tooltip"  data-original-title="Void Document" data-collectionpaperid="' . $collection_paper['CollectionPaper']['id'] . '" data-statspaper="void" data-typepaper="' . $collection_paper['AccountingPaper']['type'] . '"><i class="fa fa-close"></i></button>';
                                                    echo '&nbsp; <button class="btn btn-xs btn-success updateStatus_collectionPaper add-tooltip"  data-toggle="tooltip"  data-original-title="Onhand Document" data-collectionpaperid="' . $collection_paper['CollectionPaper']['id'] . '" data-statspaper="onhand" data-typepaper="' . $collection_paper['AccountingPaper']['type'] . '"><i class="fa fa-check"></i></button>';
                                                }
                                                ?>  </td> 
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div> 
    </div> 
    <?php
    $balance = $quote_data['Quotation']['grand_total'] - $grand_total;
    number_format($balance, 2);
    echo '<input type="hidden" value="' . $balance . '" id="balance_amount">';
    echo '<input type="hidden" value="' . $quote_data['Quotation']['grand_total'] . '" id="gtTotal">';
    echo '<input type="hidden" value="' . $grand_total . '" id="TotalPaidAmount">';
    ?>
</div>  
<script>
    $(document).ready(function () {
        $('#withNObalance').hide();
        var bal = $("#balance_amount").val();
        if (bal <= 0) {
            console.log('fully paid');
            $('#withbalance').hide();
            $('#withNObalance').show();
//            $1('#payment_mode').prop('disabled', true);
            $(".updateStatus_collection").each(function (index) {
                $(this).prop('disabled', true);
            });
            $("#paymentStats").append('[ Fully Paid ]');
            //.each updateStatus_collection
        }

        $("#term_id").select2({
            placeholder: "Select Term",
            width: '100%',
            allowClear: false
        });


        $("#amount_paid").val(bal);
        $("#amount_paper").val(bal);
        $(".check_online_mode_div").hide();
        $(".check_mode_div").hide();
        $(".amount_div").hide();
        $(".term_id_div").hide();
        $(".document_div").hide();
        $(".document_data_div_amount").hide();
        $(".document_data_div_ref").hide();




        var date = new Date();
        date.setDate(date.getDate() - 1);
        $('#datePicker-deliver')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });

    });



    $("#payment_mode").change(function () {
        $(".check_online_mode_div").show();
        $(".check_mode_div").show();
        $(".amount_div").show();
        $(".term_id_div").show();
        $(".document_div").show();
        var payment_mode = $("#payment_mode").val();
        if (payment_mode == 'cash') {
            $(".check_online_mode_div").hide();
            $(".check_mode_div").hide();
            $(".document_div").hide();
            $(".document_data_div_ref").hide();
            $(".document_data_div_amount").hide();
        } else if (payment_mode == 'online') {
            $(".check_mode_div").hide();
            $(".document_div").hide();
            $(".document_data_div_ref").hide();
            $(".document_data_div_amount").hide();
        } else if (payment_mode == 'check') {
            $(".amount_div").show();
            $(".check_mode_div").show();
            $(".check_online_mode_div").show();
            $(".document_div").hide();
            $(".document_data_div_ref").hide();
            $(".document_data_div_amount").hide();
        } else if (payment_mode == 'documents') {
            $(".document_div").show();
            $(".document_data_div_amount").show();
            $(".check_mode_div").hide();
            $(".amount_div").hide();
            $(".check_online_mode_div").hide();

            $("#accounting_paper").change(function () {
                var paper_type = $(this).find(':selected').data('papertype');

                if (paper_type == 'invoice' || paper_type == 'cr') {
                    $(".document_data_div_ref").show();
                } else {
                    $(".document_data_div_ref").hide();
                }
            });
        }
    });


    $(".moveQuote").click(function () {
        var payment_mode = $("#payment_mode").val();
        var amount_paid = $("#amount_paid").val();
        var with_held = $("#with_held").val();
        var other_amount = $("#other_amount").val();
        var bank_id = $("#bank_id").val();
        var check_number = $("#check_number").val();
        var check_date = $("#check_date").val();
        var quotation_id = $("#quotation_id").val();
        var amount_paper = $("#amount_paper").val();
        var ref_num = $("#ref_num").val();
        var ref_date = $("#ref_date").val();
        var accounting_paper = $("#accounting_paper").val();
        var gtTotal = $("#gtTotal").val();
        var balance_amount = $("#balance_amount").val();
        var TotalPaidAmount = $("#TotalPaidAmount").val();
        var paperType = $("#accounting_paper").find(':selected').data('papertype');



        var data = {"quotation_id": quotation_id,
            "payment_mode": payment_mode,
            "amount_paid": amount_paid,
            "with_held": with_held,
            "other_amount": other_amount,
            "bank_id": bank_id,
            "check_number": check_number,
            "check_date": check_date,
            "amount_paper": amount_paper,
            "ref_num": ref_num,
            "ref_date": ref_date,
            "accounting_paper": accounting_paper,
            "gtTotal": gtTotal,
            "balance_amount": balance_amount,
            "TotalPaidAmount": TotalPaidAmount,
            "paperType": paperType,
        }



        if (payment_mode == 'cash') {
            if (amount_paid != "") {
                if (with_held != "") { 
                    if (other_amount != "") { 
                        approve_quotation(data);
                    } else {
                        document.getElementById('other_amount').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('with_held').style.borderColor = "red";
                }
            } else {
                document.getElementById('amount_paid').style.borderColor = "red";
            }

        } else if (payment_mode == 'online') {
            if (amount_paid != "") {
                if (with_held != "") {
                    if (bank_id != "") {
                        if (other_amount != "") { 
                            approve_quotation(data);
                        } else {
                            document.getElementById('other_amount').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('bank_id').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('with_held').style.borderColor = "red";
                }
            } else {
                document.getElementById('amount_paid').style.borderColor = "red";
            }
        } else if (payment_mode == 'check') {

            if (amount_paid != "") {
                if (with_held != "") {
                    if (bank_id != "") {
                        if (check_number != "") {
                            if (check_date != "") {
                                ///process here
                                // approve_quotation(data);
                                
                                if (other_amount != "") { 
                                    approve_quotation(data);
                                } else {
                                    document.getElementById('other_amount').style.borderColor = "red";
                                }
                            } else {
                                document.getElementById('check_date').style.borderColor = "red";
                            }
                        } else {
                            document.getElementById('check_number').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('bank_id').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('with_held').style.borderColor = "red";
                }
            } else {
                document.getElementById('amount_paid').style.borderColor = "red";
            }
        } else if (payment_mode == 'documents') {

            var paper_types = $("#accounting_paper").find(':selected').data('papertype');
            if (paper_types == 'invoice' || paper_types == 'cr') {
//                 console.log(paper_types);

                if (accounting_paper != "") {
                    if (amount_paper != "") {
                        if (ref_num != "") {
                            if (ref_date != "") {
                                approve_quotation(data);
                            } else {
                                document.getElementById('ref_date').style.borderColor = "red";
                            }
                        } else {
                            document.getElementById('ref_num').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('amount_paper').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('accounting_paper').style.borderColor = "red";
                }
            } else {
                if (accounting_paper != "") {
                    if (amount_paper != "") {
                        approve_quotation(data);
                    } else {
                        document.getElementById('amount_paper').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('accounting_paper').style.borderColor = "red";
                }

            }
        }
    });







    $("#paidaccounting_paper").change(function () {
        var paper_type = $(this).find(':selected').data('papertype');

        if (paper_type == 'invoice' || paper_type == 'cr') {
            $(".document_data_div_ref").show();
        } else {
            $(".document_data_div_ref").hide();
        }
    });

    $("#moveQuotePaid").click(function () {
        var quotation_id = $("#quotation_id").val();
        var amount_paper = $("#paidamount_paper").val();
        var ref_num = $("#paidref_num").val();
        var ref_date = $("#paidref_date").val();
        var accounting_paper = $("#paidaccounting_paper").val();
        var gtTotal = $("#gtTotal").val();
        var balance_amount = $("#balance_amount").val();
        var TotalPaidAmount = $("#TotalPaidAmount").val();
        var paperType = $("#paidaccounting_paper").find(':selected').data('papertype');
        
        
        var data = {"quotation_id": quotation_id, 
            "amount_paper": amount_paper,
            "ref_num": ref_num,
            "ref_date": ref_date,
            "accounting_paper": accounting_paper,
            "gtTotal": gtTotal,
            "balance_amount": balance_amount,
            "TotalPaidAmount": TotalPaidAmount,
            "paperType": paperType,
        }
//        
//        
//    
        var paper_types = $("#paidaccounting_paper").find(':selected').data('papertype');
        if (paper_types == 'invoice' || paper_types == 'cr') {
//                 console.log(paper_types);

            if (accounting_paper != "") {
                if (amount_paper != "") {
                    if (ref_num != "") {
                        if (ref_date != "") {
                            approve_quotationPaid(data); 
                        } else {
                            document.getElementById('paidref_date').style.borderColor = "red";
                        }
                    } else {
                        document.getElementById('paidref_num').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('paidamount_paper').style.borderColor = "red";
                }
            } else {
                document.getElementById('paidaccounting_paper').style.borderColor = "red";
            }
        } else {
            if (accounting_paper != "") { 
                            approve_quotationPaid(data);  
            } else {
                document.getElementById('paidaccounting_paper').style.borderColor = "red";
            }

        }
    });



    function approve_quotationPaid(data) { 
        $("#moveQuotePaid").prop('disabled', true);
        $.ajax({
            url: "/collections/process_collectPaid",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                location.reload(); 
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }



    function approve_quotation(data) {
        $(".moveQuote").prop('disabled', true);
        $.ajax({
            url: "/collections/process_collect",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                location.reload();
//                window.location.replace("/quotations/pending");
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }




    $(".updateStatus_collection").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('collectionid');
            var quotation_id = $(this).data('quotecollectionid');
            
            var status = $(this).data('stats');
            if (status == 'void') {
                var warn = "You will not be able to retrieve after this confirmation!";
                var titl = "Are you sure to delete this payment?";
            } else {
                var warn = "You will not be able to revert transaction after this confirmation!";
                var titl = "Are you sure that this is a verified payment?";
            }
            swal({
                title: titl,
                text: warn,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, confirm!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "/collections/viodPayment",
                                type: 'POST',
                                data: {'id': id, 'status': status, 'quotation_id':quotation_id},
                                dataType: 'json',
                                success: function (dd) {
                                    location.reload();
                                },
                                error: function (dd) {
//                                location.reload();
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });



        });
    });




    $(".updateStatus_collectionPaper").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('collectionpaperid');
            var status = $(this).data('statspaper'); 
            var typepaper = $(this).data('typepaper'); 
            console.log(typepaper);
            var quotation_id = $("#quotation_id").val();
            if (status == 'void') {
                var warn = "You will not be able to retrieve after this confirmation!";
                var titl = "Are you sure to delete this document?";
            } else if (status == 'void') {
                var warn = "You will not be able to revert transaction after this confirmation!";
                var titl = "Are you sure that this document is void?";
            } else {
                var warn = "You will not be able to revert transaction after this confirmation!";
                var titl = "Are you sure that this document is onhand?";
            }
            swal({
                title: titl,
                text: warn,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, confirm!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "/collections/viodPaper",
                                type: 'POST',
                                data: {'id': id, 'status': status, 'quotation_id':quotation_id,'typepaper':typepaper},
                                dataType: 'json',
                                success: function (dd) {
                                    location.reload();
                                },
                                error: function (dd) {
//                                location.reload();
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });



        });
    });
</script>