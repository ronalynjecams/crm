    <!--MAIN NAVIGATION-->
    <!--===================================================-->
    <nav id="mainnav-container">
        <div id="mainnav">
    
            <!--Menu-->
            <!--================================-->
            <div id="mainnav-menu-wrap">
                <div class="nano">
                    <div class="nano-content">
    
                        <!--Profile Widget-->
                        <!--================================-->
                        <div id="mainnav-profile" class="mainnav-profile">
                            <div class="profile-wrap">
                                <div class="pad-btm">
                                    <span class="label label-success pull-right"><?php echo $UserIn['Department']['name']; ?></span>
                                    <?php
                                    if($img_pp!="") {
                                        echo "<img class='img-circle img-sm img-border' src='$img_pp'
                                             alt='Profile Picture'>";
                                    }
                                    else {
                                        echo "<img class='img-circle img-sm img-border' src='/img/profile-photos/1.png'
                                             alt='Profile Picture'>";
                                    } ?>
                                </div>
                                <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                    <p class="mnp-name"><?php echo $UserIn['User']['first_name'] . '  ' . $UserIn['User']['last_name']; ?></p>
                                    <span class="mnp-desc"><?php echo $UserIn['Position']['name']; ?></span>
                                </a>
                            </div>
                        </div>
    
    
                        <!--Shortcut buttons-->
                        <!--================================-->
                        <div id="mainnav-shortcut">
                            <ul class="list-unstyled">
    
    
    
                                <?php if ($UserIn['User']['role'] == 'sales_executive') { ?>
                                    <li class="col-xs-3" data-content="Add New Client">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-male"></i>
                                        </a>
                                    </li>
                                    <li class="col-xs-3" data-content="Create New Lead">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-lock-2"></i>
                                        </a>
                                    </li>
                                    <li class="col-xs-3" data-content="Create Quotation">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-speech-bubble-3"></i>
                                        </a>
                                    </li>
                                    <li class="col-xs-3" data-content="Create New Job Request">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-thunder"></i>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </div>
                        <!--================================-->
                        <!--End shortcut buttons-->
    
    
                        <ul id="mainnav-menu" class="list-group"> 
                            <!-- super_admin -->
    
                            <?php if ($UserIn['User']['role'] == 'super_admin') { ?> 
                                <li class="active-link">
                                    <a href="/users/dashboard"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="ion-ios-people"></i>
                                        <span class="menu-title">
                                            <strong>Employees</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/users/add">New</a></li>
                                        <li><a href="/users/index">List</a></li>
                                        <li><a href="/agent_statuses/index">Agents Status</a></li>
                                        <li><a href="/teams/index">Teams</a></li>
    
                                    </ul>
                                </li> 
                            <?php } ?>
    
    
    
                            <!-- proprietor -->
    
                            <?php if ($UserIn['User']['role'] == 'proprietor') { ?> 
                                <li class="active-link">
                                    <a href="/users/dashboard_proprietor"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong>
                                            <?php if ($this->requestAction('App/moved_edited_quote_count_left_side/moved') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/moved_edited_quote_count_left_side/moved'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected
                                        <?php if ($this->requestAction('App/edited_quote_count_left_side/rejected') != 0) { ?>
                                                    <span class="label label-danger "><?php echo $this->requestAction('App/edited_quote_count_left_side/rejected'); ?></span>
                                                <?php } ?></a></li>
                                        <li><a href="/quotations/proprietor?status=moved">Moved
                                                <?php if ($this->requestAction('App/moved_quote_count_left_side/moved') != 0) { ?>
                                                    <span class="label label-danger "><?php echo $this->requestAction('App/moved_quote_count_left_side/moved'); ?></span>
                                                <?php } ?></a></li>
                                        <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                        <li><a href="/quotations/proprietor?status=processed">Processed</a></li>
    
                                    </ul>
                                </li> 
                                    <li>
                                        <a href="/supplier_products/supplier_product"> 
                                            <i class="fa fa-black-tie"></i>
                                            <span class="menu-title">
                                                <strong>Product Suppliers</strong> 
                                            </span>
                                        </a>
                                    </li>
                                <li>
                                    <a> 
                                        <i class="fa fa-truck"></i>
                                        <span class="menu-title">
                                            <strong>Delivery Schedules</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/delivery_schedules/view?type=all">All</a></li>
                                        <li><a href="/delivery_schedules/view?type=daily">Daily</a></li>
                                    </ul> 
                                </li>
                                
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Collections</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/quotations/quotations_for_accounting?status=for_collection">For Collection</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=with_terms">With Terms</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=incomplete">Incomplete</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=backjob">With Backjob</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=undelivered">Undelivered</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=pdc">With PDC</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=bir2307">BIR 2307</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=paid">Fully Paid</a></li> 
    
                                    </ul>
                                </li> 
                                <li >
                                    <a href="/products/index"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-archive"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Job Requests</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a>-->
    
                                    <!--Submenu-->
                                <!--    <ul class="collapse"> -->
                                <!--        <li><a href="/job_requests/all_lists?status=pending">Pending</a></li>-->
                                <!--        <li><a href="/job_requests/all_lists?status=ongoing">Ongoing</a></li>-->
                                <!--        <li><a href="/job_requests/all_lists?status=accomplished">Accomplished</a></li>-->
    
                                <!--    </ul>-->
                                <!--</li> -->
                                <li>
                                        <a href="/supplier_products/supplier_product"> 
                                            <i class="fa fa-black-tie"></i>
                                            <span class="menu-title">
                                                <strong>Product Suppliers</strong> 
                                            </span>
                                        </a>
                                    </li>
                                <li >
                                    <a href="/products/list_requests"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                            <?php if ($this->requestAction('App/count_product_request/request') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_product_request/request'); ?></span>
                                            <?php } ?>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Bills</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/bill_accounts/view_account">Accounts</a></li>
                                        <li><a href="/bills/view_bills">Billing</a></li>
                                        <li><a href="/bill_monitorings/view_monitoring">Bills Monitoring</a></li>
                                        <!--<li><a href="/fitout_works/project?status=pending">Pending</a></li>   -->
                                        <!--<li><a href="/fitout_works/project?status=accomplished">Accomplished</a></li>  -->
                                    </ul>
                                </li>  
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cash Request</strong>
                                            <?php if ($this->requestAction('App/count_pending_pr/cash/acknowledged') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cash/acknowledged'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cash&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=acknowledged">Acknowledged
                                        <?php if ($this->requestAction('App/count_pending_pr/cash/acknowledged') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cash/acknowledged'); ?></span>
                                            <?php }
                                            ?></a>
                                            </li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Issued Cheques</strong>  
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_request_cheques/issued_cheques?status=pending">Pending</a></li>
                                        <li><a href="/payment_request_cheques/issued_cheques?status=cleared">Cleared</a></li>  
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cheque Request</strong>
                                            <?php if ($this->requestAction('App/count_pending_pr/cheque/pending') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cheque/pending'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=pending">Pending
                                        <?php if ($this->requestAction('App/count_pending_pr/cheque/pending') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cheque/pending'); ?></span>
                                            <?php } ?></a>
                                        </li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Petty Cash Request</strong>
                                            <?php if ($this->requestAction('App/count_pending_pr/pettycash/replenished') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/pettycash/replenished'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=replenished">Replenished</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-check-square"></i>
                                        <span class="menu-title">
                                            <strong>Replenishments</strong>
                                            <?php if ($this->requestAction('App/count_pending_replenishment') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_replenishment'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse">
                                        <li><a href="/payment_requests/replenishments?status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/replenishments?status=acknowledged">Acknowledged</a></li>
                                    </ul>
                                </li>
                                <!--Widget-->
                                    <!--================================-->
                                    <div class="mainnav-widget">
                                        <!-- Hide the content on collapsed navigation -->
                                        <?php
                                        $user_role = $UserIn['User']['role'];
                                        $is_authorized=false;
                                        $authorized_users = ['sales_executive', 'sales_coordinator', 'sales_manager',
                                                             'proprietor'];
                                        foreach($authorized_users as $authorized_user) {
                                            if($authorized_user==$user_role) {
                                                $is_authorized=true;
                                            }
                                        }
                                        if($is_authorized) { ?>
                                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                            <ul class="list-group">
                                                <li class="list-header pad-no pad-ver">Quotation Status</li>
                                                <li class="mar-btm">
                                                    <span class="label label-primary pull-right"><?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%</span>
                                                    <p>Approved</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-primary" style="width:<?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%;">
                                                            <span class="sr-only"><?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-purple pull-right"><?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%</span>
                                                    <p>Pending</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-purple" style="width:<?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%;">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!--================================-->
                                <!--End widget-->
                            <?php } ?>
                            <!-- proprietor -->
                            <!-- sales_executive -->
                            <?php if ($UserIn['User']['role'] == 'sales_executive') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_sales">
                                        <!--<i class="demo-psi-home"></i>-->
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/products/add_temp"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-address-card"></i>
                                        <span class="menu-title">
                                            <strong>Clients</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/clients/leads">Leads</a></li>
                                        <li><a href="/clients/clients">Clients</a></li>
    
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/create">Create</a></li>
                                        <li><a href="/quotations/pending">Pending</a></li>
                                        <li><a href="/quotations/edited">Rejected</a></li>
                                        <li><a href="/quotations/sales_moved">Moved</a></li>
                                        <li><a href="/quotations/accounting_moved">Approved</a></li>
                                        <li><a href="/quotations/approved">Approved By Accounting</a></li>
                                    </ul>
                                </li>
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-file-pdf-o"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Quotations</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a> -->
                                <!--    <ul class="collapse">-->
                                <!--        <li><a href="/quotations/create">Create</a></li>-->
                                <!--        <li><a href="/quotations/all_list?status=pending">Pending</a></li>-->
                                <!--        <li><a href="/quotations/all_list?status=rejected">Rejected</a></li>-->
                                <!--        <li><a href="/quotations/all_list?status=moved">Moved</a></li>-->
                                <!--        <li><a href="/quotations/all_list?status=accounting_moved">Approved</a></li>-->
                                <!--        <li><a href="/quotations/all_list?approved">Approved By Accounting</a></li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-archive"></i>
                                        <span class="menu-title">
                                            <strong>Job Requests</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/job_requests/all_lists?status=new">New</a></li>
                                        <li><a href="/job_requests/all_lists?status=pending">Pending</a></li>
                                        <li><a href="/job_requests/all_lists?status=ongoing">Ongoing</a></li>
                                        <li><a href="/job_requests/all_lists?status=accomplished">Accomplished</a></li>
    
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-send-o"></i>
                                        <span class="menu-title">
                                            <strong>Demo</strong>
                                            <?php  if ($this->requestAction('App/count_demo') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_demo'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/client_services/all_lists?type=demo&&status=newest">New</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=pending">Pending</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=processed">Processed</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=approved">Approved</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=delivered">Delivered</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=pullout">Pullout</a></li>
                                        <li><a href="/client_services/all_lists?type=pull_out&&status=pullout_successful">Pullout Successful</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-taxi"></i>
                                        <span class="menu-title">
                                            <strong>Service Unit</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/client_services/all_lists?type=service_unit&&status=newest">New</a></li>
                                        <li><a href="/client_services/all_lists?type=service_unit&&status=pending">Pending</a></li>
                                        <li><a href="/client_services/all_lists?type=service_unit&&status=processed">Processed</a></li>
                                        <li><a href="/client_services/all_lists?type=service_unit&&status=delivered">Delivered</a></li>
                                        <li><a href="/client_services/all_lists?type=service_unit&&status=pullout">Pullout</a></li>
                                        <li><a href="/client_services/all_lists?type=pull_out&&status=pullout_successful">Pullout Successful</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a> 
                                        <i class="fa fa-truck"></i>
                                        <span class="menu-title">
                                            <strong>Delivery Schedules</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/delivery_schedules/view?type=all">All</a></li>
                                        <li><a href="/delivery_schedules/view?type=daily">Daily</a></li>
                                    </ul> 
                                </li>
                                
                                <!--Widget-->
                                    <!--================================-->
                                    <div class="mainnav-widget">
                                        <!-- Hide the content on collapsed navigation -->
                                        <?php
                                        $user_role = $UserIn['User']['role'];
                                        $is_authorized=false;
                                        $authorized_users = ['sales_executive', 'sales_coordinator', 'sales_manager',
                                        					 'proprietor'];
                                        foreach($authorized_users as $authorized_user) {
                                        	if($authorized_user==$user_role) {
                                        		$is_authorized=true;
                                        	}
                                        }
                                        if($is_authorized) { ?>
                                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                            <ul class="list-group">
                                                <li class="list-header pad-no pad-ver">Quotation Status</li>
                                                <li class="mar-btm">
                                                    <span class="label label-primary pull-right"><?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%</span>
                                                    <p>Approved</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-primary" style="width:<?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%;">
                                                            <span class="sr-only"><?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-purple pull-right"><?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%</span>
                                                    <p>Pending</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-purple" style="width:<?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%;">
                                                            <span class="sr-only"><?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!--================================-->
                                <!--End widget-->
                            <?php } ?>
                            
                            <!-- sales manager start-->
                            <?php if ($UserIn['User']['role'] == 'sales_manager' || $UserIn['User']['role'] == 'sales_coordinator') { ?>
                                <li class="active-link">
                                    <?php if($UserIn['User']['role'] == 'sales_coordinator') { ?>
                                    <a href="/users/dashboard_sales_coordinator">
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                    <?php }
                                    else if($UserIn['User']['role'] == 'sales_manager') { ?>
                                        <a href="/users/dashboard_sales_manager">
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                        </a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <a href="/products/add_temp"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-address-card"></i>
                                        <span class="menu-title">
                                            <strong>Clients</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/clients/leads">Leads</a></li>
                                        <li><a href="/clients/clients">Clients</a></li>
    
                                    </ul>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li>
                                        <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                        <li><a href="/quotations/proprietor?status=processed">Processed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a> 
                                        <i class="fa fa-truck"></i>
                                        <span class="menu-title">
                                            <strong>Delivery Schedules</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/delivery_schedules/view?type=all">All</a></li>
                                        <li><a href="/delivery_schedules/view?type=daily">Daily</a></li>
                                    </ul> 
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-archive"></i>
                                        <span class="menu-title">
                                            <strong>Job Requests</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/job_requests/all_lists?status=new">New</a></li>
                                        <li><a href="/job_requests/all_lists?status=pending">Pending</a></li>
                                        <li><a href="/job_requests/all_lists?status=ongoing">Ongoing</a></li>
                                        <li><a href="/job_requests/all_lists?status=accomplished">Accomplished</a></li>
    
                                    </ul>
                                </li>
                                <!--Widget-->
                                    <!--================================-->
                                    <div class="mainnav-widget">
                                        <!-- Hide the content on collapsed navigation -->
                                        <?php
                                        $user_role = $UserIn['User']['role'];
                                        $is_authorized=false;
                                        $authorized_users = ['sales_executive', 'sales_coordinator', 'sales_manager',
                                                             'proprietor'];
                                        foreach($authorized_users as $authorized_user) {
                                            if($authorized_user==$user_role) {
                                                $is_authorized=true;
                                            }
                                        }
                                        if($is_authorized) { ?>
                                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                            <ul class="list-group">
                                                <li class="list-header pad-no pad-ver">Quotation Status</li>
                                                <li class="mar-btm">
                                                    <span class="label label-primary pull-right"><?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%</span>
                                                    <p>Approved</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-primary" style="width:<?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%;">
                                                            <span class="sr-only"><?php echo $this->requestAction('App/PendingApproved_count/approved_count'); ?>%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-purple pull-right"><?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%</span>
                                                    <p>Pending</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-purple" style="width:<?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%;">
                                                            <span class="sr-only"><?php echo $this->requestAction('App/PendingApproved_count/pending_count'); ?>%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!--================================-->
                                <!--End widget-->
                            <?php } ?>
                            <!-- sales manager end -->
                            <!-- marketing_staff -->
                            <?php if ($UserIn['User']['role'] == 'marketing_staff') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_marketing"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href="/clients/leads"> 
                                        <i class="ion-ios-people"></i>
                                        <span class="menu-title">
                                            <strong>Leads</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href="/clients/clients"> 
                                        <i class="ion-ios-people"></i>
                                        <span class="menu-title">
                                            <strong>Clients</strong>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <!-- marketing_staff -->
                            <!-- it_staff -->
                            <?php if ($UserIn['User']['role'] == 'it_staff') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_it_staff"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href="/products/website_products"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Website Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href="/products/index"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href="/products/list_requests"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                            <?php if ($this->requestAction('App/count_product_request/request') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_product_request/request'); ?></span>
                                            <?php } ?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <!-- it_staff -->
                            <!-- design_head -->
                            <?php if ($UserIn['User']['role'] == 'design_head') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_design_head"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/products/add_temp"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                        </span>
                                    </a>
                                </li>
                                <!--N E W  J O B  R E Q U E S T-->
                                <li>
                                    <a href=""> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>NEW Job Request</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/job_requests/all_lists?status=pending"> Pending </a></li>
                                        <li><a href="/job_requests/all_lists?status=ongoing"> Ongoing </a></li>
                                        <li><a href="/job_requests/all_lists?status=accomplished"> Accomplished </a></li>
    
                                    </ul>
                                </li> 
                                <!--O L D  J O B  R E Q U E S T-->
                                <li>
                                    <a href=""> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>OLD Job Request</strong>
                                            <?php // if ($this->requestAction('App/jr_head_count_left_side/pending') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/jr_head_count_left_side/pending'); ?></span>
                                            <?php // } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/job_requests/head_view?status=pending"> Pending </a></li>
                                        <li><a href="/job_requests/head_view?status=ongoing"> Ongoing </a></li>
                                        <li><a href="/job_requests/head_view?status=accomplished"> Accomplished </a></li>
    
                                    </ul>
                                </li>
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-paint-brush"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Productions</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a>-->
                                    
                                    <!--Submenu-->
                                <!--    <ul class="collapse">-->
                                <!--        <li><a href="/productions/all_list?status=pending">Pending</a></li>-->
                                <!--        <li><a href="/productions/all_list?status=ongoing">Ongoing</a></li>-->
                                <!--        <li><a href="/productions/all_list?status=accomplished">Accomplished</a></li>-->
                                <!--        <li><a href="/productions/all_list?status=viewed">Viewed</a></li>-->
    
                                <!--    </ul>-->
                                <!--</li> -->
                                <!--						            <li >
                                                                                                <a href="/job_requests/pending"> 
                                                                                                    <i class="ion-soup-can"></i>
                                                                                                    <span class="menu-title">
                                                                                                       
                                                                                                        <strong>Pending Job Request</strong>
                                                                                                    </span>
                                                                                                </a>
                                                                                            </li>-->
                            <?php } ?>
                            <!-- design_head -->
                            <!-- designer -->
                            <?php if ($UserIn['User']['role'] == 'designer') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_design_head"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/products/add_temp"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                        </span>
                                    </a>
                                </li>
                                <!--N E W  J O B  R E Q U E S T-->
                                <li>
                                    <a href=""> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>NEW Job Request</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/job_requests/all_lists?status=ongoing"> Ongoing </a></li>
                                        <li><a href="/job_requests/all_lists?status=accomplished"> Accomplished </a></li>
    
                                    </ul>
                                </li>
                                <!--O L D  J O B  R E Q U E S T-->
                                <li>
                                    <a href=""> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>OLD Job Request</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/job_requests/design_product?type=pending"> Pending </a></li>
                                        <li><a href="/job_requests/design_product?type=ongoing"> Ongoing </a></li>
                                        <li><a href="/job_requests/design_product?type=accomplished"> Accomplished </a></li>
    
                                    </ul>
                                </li>
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-archive"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Job Requests</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a>-->
    
                                    <!--Submenu-->
                                <!--    <ul class="collapse">-->
                                <!--        <li><a href="/job_requests/all_lists?status=new">New</a></li>-->
                                <!--        <li><a href="/job_requests/all_lists?status=pending">Pending</a></li>-->
                                <!--        <li><a href="/job_requests/all_lists?status=ongoing">Ongoing</a></li>-->
                                <!--        <li><a href="/job_requests/all_lists?status=accomplished">Accomplished</a></li>-->
    
                                <!--    </ul>-->
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-paint-brush"></i>
                                        <span class="menu-title">
                                            <strong>Productions</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/productions/all_list?status=pending">Pending</a></li>
                                        <li><a href="/productions/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/productions/all_list?status=accomplished">Accomplished</a></li>
                                        <li><a href="/productions/all_list?status=viewed">Viewed</a></li>
    
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- designer -->
                            <!-- supply_staff -->
                            <?php if ($UserIn['User']['role'] == 'supply_staff') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_supply"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href=""> 
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="menu-title">
                                            <strong>Suppliers</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/purchase_order_products/supply_top_purchased?type=<?php echo $UserIn['User']['department_id']; ?>">Top Purchased</a></li>  
                                        <li><a href="/suppliers/supplier_list">All</a></li>
                                    </ul>
                                </li>
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-file-pdf-o"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Quotations</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a> -->
                                <!--    <ul class="collapse">  -->
                                <!--        <li><a href="/quotation_products/purchasing_list">Products</a></li> -->
                                <!--        <li><a href="/quotations/sales_moved">Moved</a></li> -->
                                <!--        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li> -->
                                <!--        <li><a href="/quotations/accounting_moved">Approved</a></li>-->
                                <!--        <li><a href="/quotations/approved">Approved by Accounting</a></li> -->
                                <!--        <li><a href="/quotations/processed">Processed</a></li>  	-->
                                <!--    </ul>-->
                                <!--</li> -->
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong> 
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li>
                                        <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved </a></li>
                                        <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                        <li><a href="/quotations/proprietor?status=processed">Processed</a></li>
    
                                    </ul>
                                </li> 
                                <li >
                                    <a href="/quotation_products/po_products"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Unprocessed Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-send-o"></i>
                                        <span class="menu-title">
                                            <strong>Demo</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/client_services/all_lists?type=demo&&status=newest">New</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=pending">Pending</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=processed">Processed</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=approved">Approved</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=delivered">Delivered</a></li>
                                        <li><a href="/client_services/all_lists?type=demo&&status=pullout">Pullout</a></li>
                                        <li><a href="/client_services/all_lists?type=pull_out&&status=pullout_successful">Pullout Successful</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Purchase Order</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/purchase_order_products/top_purchased?dept=<?php echo $UserIn['User']['department_id']; ?>">Top Purchased</a></li>
                                        <li><a href="/purchase_orders/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/purchase_orders/all_list?status=pending">Pending</a></li>   
                                        <li><a href="/purchase_orders/all_list?status=partial">Partial</a></li>
                                        <li><a href="/purchase_orders/all_list?status=processed">Processed</a></li>   	
                                    </ul>
                                </li> 
                                <li >
                                    <a href=" "> 
                                        <i class="fa fa-dropbox"></i>
                                        <span class="menu-title">
                                            <strong>Inventory</strong>
                                        </span>
                                    </a>
                                </li>  
                                <li >
                                    <a href="/products/index"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Products</strong>
                                        </span>
                                    </a>
                                </li>
    
                            <?php } ?>
                            <!-- supply_staff -->
                            <!-- raw_staff -->
                            <?php if ($UserIn['User']['role'] == 'raw_head') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_supply"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="/products/add_temp"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Request</strong>
                                        </span>
                                    </a>
                                </li>
                                <li >
                                    <a href="/suppliers/supplier_list"> 
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="menu-title">
                                            <strong>Suppliers</strong>
                                        </span>
                                    </a>
                                </li>  
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-file-pdf-o"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Quotations</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a> -->
                                <!--    <ul class="collapse">  -->
                                <!--        <li><a href="/quotation_products/purchasing_list">Products</a></li> -->
                                <!--        <li><a href="/quotations/sales_moved">Moved</a></li> -->
                                <!--        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li> -->
                                <!--        <li><a href="/quotations/accounting_moved">Approved</a></li>-->
                                <!--        <li><a href="/quotations/approved">Approved by Accounting</a></li> -->
                                <!--        <li><a href="/quotations/processed">Processed</a></li>  	-->
                                <!--    </ul>-->
                                <!--</li> -->
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong> 
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li>
                                        <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved </a></li>
                                        <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                        <li><a href="/quotations/proprietor?status=processed">Processed</a></li>
    
                                    </ul>
                                </li> 
                                
                                <li >
                                    <a href="/quotation_products/po_products"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Unprocessed Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-registered"></i>
                                        <span class="menu-title">
                                            <strong>Requests</strong> 
                                            <span class="label label-danger"><?php  echo $this->requestAction('App/approved_po_raw_request_count_lest_side/approved'); ?></span>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">   
                                        <li><a href="/po_raw_requests/list_view?status=pending">Pending</a></li>   
                                        <li><a href="/po_raw_requests/list_view?status=approved">Approved
                                            <span class="label label-danger"><?php  echo $this->requestAction('App/approved_po_raw_request_count_lest_side/approved'); ?></span></a></li>   
                                        <li><a href="/po_raw_requests/list_view?status=processed">Processed</a></li>   	
                                    </ul>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Purchase Order</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/purchase_orders/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/purchase_orders/all_list?status=pending">Pending</a></li>
                                        <li><a href="/purchase_orders/all_list?status=partial">Partial</a></li>   
                                        <li><a href="/purchase_orders/all_list?status=processed">Processed</a></li>   	
                                    </ul>
                                </li> 
                                <li >
                                    <a href=" "> 
                                        <i class="fa fa-dropbox"></i>
                                        <span class="menu-title">
                                            <strong>Inventory</strong>
                                        </span>
                                    </a>
                                </li>  
                                <li >
                                    <a href="/products/index"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/sub_categories/add"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Product Sub Categories</strong>
                                        </span>
                                    </a>
                                </li>
    
                            <?php } ?>
                            
                            <!--FOR HR HEAD SIDE BAR-->
                            <?php
                            if($UserIn['User']['role'] == 'hr_head') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_hr_head"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li >
                                    <a href="/users/incomplete_profile"> 
                                        <i class="fa fa-address-card"></i>
                                        <span class="menu-title">
                                            <strong>Pending Users</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li >
                                    <a href="/employee_details/add"> 
                                        <i class="fa fa-address-card"></i>
                                        <span class="menu-title">
                                            <strong>Employee 201</strong>
                                        </span>
                                    </a>
                                </li> 
                            <?php } ?>
                            <!--END OF HR HEAD SIDE BAR-->
                            
                            <!-- raw_staff -->
                            <!-- warehouse supply-->
                            <?php if ($UserIn['Department']['name'] == 'Logistics - Warehouse (Raw)' || $UserIn['Department']['name'] == 'Logistics - Warehouse (Supply)') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_warehouse"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>       
                                <!--<li>-->
                                <!--    <a href="">  -->
                                <!--        <i class="fa fa-file-pdf-o"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Quotation Requests</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a> -->
                                <!--    <ul class="collapse">   -->
                                <!--        <li><a href="/product_sources/list_view?type=supply&&status=pending&&source=inventory">Pending</a></li>   -->
                                <!--        <li><a href="/product_sources/list_view?type=supply&&status=released&&source=inventory">Released</a></li>   	-->
                                <!--    </ul>-->
                                <!--</li> -->
                                <li>
                                    <a href="/inv_locations/all_list"> 
                                        <i class="fa fa-dropbox"></i>
                                        <span class="menu-title">
                                            <strong>Inventory Locations</strong>
                                        </span>
                                    </a>
                                </li>  
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-file-powerpoint-o"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Inventory Job Order</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a> -->
                                <!--    <li>-->
                                <!--        <a href="#">Third Level<i class="arrow"></i></a> -->
                                <!--        <ul class="collapse">-->
                                <!--            <li><a href="#">Third Level Item</a></li>-->
                                <!--            <li><a href="#">Third Level Item</a></li>-->
                                <!--        </ul>-->
                                <!--    </li>-->
                                <!--</li> -->
                                 <li>
                                    <a href="#">
                                        <i class="demo-psi-tactic"></i>
                                        <span class="menu-title">Inventory Job Orders</span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse">  
                                        <li>
                                            <a href="#">Receive<i class="arrow"></i></a> 
                                            <!--Submenu-->
                                            <ul class="collapse">
                                                <li><a href="/inventory_job_orders/all_list?mode=receive&&status=newest">Pending</a></li> 
                                                <li><a href="/inventory_job_orders/all_list?mode=receive&&status=partial">Partial</a></li> 
                                                <li><a href="/inventory_job_orders/all_list?mode=receive&&status=accomplished">Accomplished</a></li> 
                                            </ul>
                                        </li> 
                                        <li>
                                            <a href="#">Release<i class="arrow"></i></a> 
                                            <!--Submenu-->
                                            <ul class="collapse">
                                                <li><a href="/inventory_job_orders/all_list?mode=release&&status=newest">Pending</a></li> 
                                                <li><a href="/inventory_job_orders/all_list?mode=release&&status=partial">Partial</a></li> 
                                                <li><a href="/inventory_job_orders/all_list?mode=release&&status=accomplished">Accomplished</a></li> 
                                            </ul>
                                        </li> 
                                    </ul>
                                </li>
    
                            <?php } ?>
                            <!-- warehouse_head -->
                            
                            <!--warehouse_head_raw-->
                            <!--end of warehouse_head_raw-->
                            
                            
                            <!-- collection_officer-->
                            <?php if ($UserIn['User']['role'] == 'collection_officer') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_collection_officer"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>   
                                
                                    <li>
                                        <a href="/supplier_products/supplier_product"> 
                                            <i class="fa fa-black-tie"></i>
                                            <span class="menu-title">
                                                <strong>Product Suppliers</strong> 
                                            </span>
                                        </a>
                                    </li>
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong> 
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li>
                                        <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved </a></li>
                                        <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                        <li><a href="/quotations/proprietor?status=processed">Processed</a></li>
    
                                    </ul>
                                </li> 
                                <li>
                                    <a href="">  
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Collection Requests</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">   
                                        <li><a href="/collection_schedules/add_schedule">Add Schedule</a></li>
                                        <li><a href="/collection_schedules/list_view?status=today">Collection For Today</a></li>   
                                        <li><a href="/collection_schedules/list_view?status=for_collection">For Collection</a></li>   
                                        <li><a href="/collection_schedules/list_view?status=collected">Collected</a></li>   	
                                    </ul>
                                </li> 
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Collections</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/quotations/quotations_for_accounting?status=for_collection">For Collection</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=with_terms">With Terms</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=incomplete">Incomplete</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=backjob">With Backjob</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=undelivered">Undelivered</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=pdc">With PDC</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=bir2307">BIR 2307</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=paid">Fully Paid</a></li> 
    
                                    </ul>
                                </li> 
                                <li>
                                    <a href="/collections/all_list?status=unverified"> 
                                        <i class="fa fa-ban"></i>
                                        <span class="menu-title">
                                            <strong>Unverified Collections</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="/statement_of_accounts/all_list"> 
                                        <i class="fa fa-newspaper-o"></i>
                                        <span class="menu-title">
                                            <strong>Statement of accounts</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>For Advance Invoice</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/collection_papers/advance_invoice?status=pending">Pending</a></li>
                                        <li><a href="/collection_papers/advance_invoice?status=served">Served</a></li>
                                    </ul>
                                </li> 
                            <?php } ?>
                            <?php
                                if($UserIn['User']['role']=="accounting_assistant" ||
                                   $UserIn['User']['role']=="proprietor_secretary" ||
                                   $UserIn['User']['role']=="supply_staff" ||
                                   $UserIn['User']['role']=="raw_head") { ?>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cash Request</strong>
                                            <?php if ($this->requestAction('App/count_pending_pr/cash') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cash'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cash&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=acknowledged">Acknowledged</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cheque Request</strong>
                                            <?php if ($this->requestAction('App/count_pending_pr/cheque') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cheque'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Petty Cash Request</strong>
                                            <?php if ($this->requestAction('App/count_pending_pr/pettycash') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/pettycash'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=replenished">Replenished</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php
                                if($UserIn['User']['role']=="accounting_assistant" ||
                                   $UserIn['User']['role']=="proprietor_secretary") { ?>
                                <li>
                                    <a href="">
                                        <i class="fa fa-check-square"></i>
                                        <span class="menu-title">
                                            <strong>Replenishments</strong>
                                            <?php if ($this->requestAction('App/count_pending_replenishment') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_replenishment'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse">
                                        <li><a href="/payment_requests/replenishments?status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/replenishments?status=acknowledged">Acknowledged</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- collection_officer -->
    
                            <!-- production_head -->
                            <?php if ($UserIn['User']['role'] == 'production_head') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_production_head"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>     
                                 <li>
                                    <a href=""> 
                                        <i class="fa fa-paint-brush"></i>
                                        <span class="menu-title">
                                            <strong>Productions</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/productions/all_list?status=pending">Pending</a></li>
                                        <li><a href="/productions/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/productions/all_list?status=accomplished">Accomplished</a></li>
                                        <li><a href="/productions/all_list?status=viewed">Viewed</a></li>
    
                                    </ul>
                                </li>
                                
                                <!--<li>-->
                                <!--    <a href=""> -->
                                <!--        <i class="fa fa-file-powerpoint-o"></i>-->
                                <!--        <span class="menu-title">-->
                                <!--            <strong>Job Requests</strong>-->
                                <!--        </span>-->
                                <!--        <i class="arrow"></i>-->
                                <!--    </a> -->
                                <!--    <ul class="collapse">  -->
                                <!--        <li><a href="/purchase_orders/all_list?status=ongoing">New</a></li>-->
                                <!--        <li><a href="/purchase_orders/all_list?status=ongoing">Ongoing</a></li> -->
                                <!--        <li><a href="/purchase_orders/all_list?status=ongoing">Finished</a></li>  -->
                                <!--    </ul>-->
                                <!--</li> -->
                                <li>
                                    <a href=" "> 
                                        <i class="fa fa-dropbox"></i>
                                        <span class="menu-title">
                                            <strong>Processes</strong>
                                        </span>
                                    </a>
                                </li>  
    
                            <?php } ?>
                            <!-- production_head -->
    
                            <!-- logistics_head -->
                            <?php if ($UserIn['User']['role'] == 'logistics_head') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_logistics_head"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>        
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-clock-o"></i>
                                        <span class="menu-title">
                                            <strong>Schedule Requests</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <!--'ongoing','pending','approved','scheduled','delivered'-->
                                        <li><a href="/delivery_schedules/requests?status=ongoing">Pending</a></li>
                                        <li><a href="/delivery_schedules/requests?status=approved">Approved</a></li> 
                                        <li><a href="/delivery_schedules/requests?status=scheduled">Scheduled</a></li> 
                                        <li><a href="/delivery_schedules/requests?status=delivered">Delivered</a></li>  
    
                                    </ul> 
                                </li>
                                <li>
                                    <a href="/delivery_schedules/drs"> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Delivery Receipts</strong>
                                        </span>
                                        <!--<i class="arrow"></i>-->
                                    </a> 
                                    <!--<ul class="collapse">  -->
                                        <!--pending; meaning d pa naischedule sa delivery itenerary--> 
                                    <!--    <li><a href="/delivery_schedules/drs?status=ongoing">Pending</a></li>-->
                                    <!--    <li><a href="/delivery_schedules/drs?status=scheduled">Scheduled</a></li>  -->
                                    <!--    <li><a href="/delivery_schedules/drs?status=delivered">Delivered</a></li>  -->
                                    <!--</ul> -->
                                </li>  
                                <li>    
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Itenerary</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <!--pending; meaning d pa naischedule sa delivery itenerary--> 
                                        <!--<li><a href="/delivery_iteneraries/new_itenerary">Add</a></li>-->
                                        <li><a href="/delivery_iteneraries/list_view?status=scheduled">Scheduled</a></li>  
                                        <li><a href="/delivery_iteneraries/list_view?status=ongoing">Ongoing Delivery</a></li>
                                        <li><a href="/delivery_iteneraries/list_view?status=delivered">Delivered</a></li>  
                                    </ul> 
                                </li>  
                                <li>
                                    <a href="/vehicles/add"> 
                                        <i class="fa fa-truck"></i>
                                        <span class="menu-title">
                                            <strong>Vehicles</strong>
                                        </span>
                                    </a>
                                </li>  
    
                            <?php } ?> 
                            <!-- logistics_head -->
    
                            <!-- fitout_facilitator -->
                            <?php if ($UserIn['User']['role'] == 'fitout_facilitator') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_fitout"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>        
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Fitout Works</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/fitout_works/project?status=received">Received</a></li>
                                        <li><a href="/fitout_works/project?status=ongoing">Ongoing</a></li>
                                        <li><a href="/fitout_works/project?status=pending">Pending</a></li>   
                                        <li><a href="/fitout_works/project?status=accomplished">Accomplished</a></li>
                                    </ul>
                                </li>
    
                            <?php } ?>
                            <!-- fitout_facilitator -->
    
                            <!-- admin_staff -->
                            <?php if ($UserIn['User']['role'] == 'admin_staff') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_admin_staff"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>        
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Bills</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/bill_accounts/view_account">Accounts</a></li>
                                        <li><a href="/bills/view_bills">Billing</a></li>
                                        <li><a href="/bill_monitorings/view_monitoring">Bills Monitoring</a></li>
                                        <!--<li><a href="/fitout_works/project?status=pending">Pending</a></li>   -->
                                        <!--<li><a href="/fitout_works/project?status=accomplished">Accomplished</a></li>  -->
                                    </ul>
                                </li>  
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-address-card"></i>
                                        <span class="menu-title">
                                            <strong>Clients</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/clients/leads">Leads</a></li>
                                        <li><a href="/clients/clients">Clients</a></li>
    
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- admin_staff -->
    
    
    
                            <!-- accounting_head -->
    
                            <?php if ($UserIn['User']['role'] == 'accounting_head') { ?> 
                                <li class="active-link">
                                    <a href="/users/dashboard_accounting_head"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>
                                
                                    <li>
                                        <a href="/supplier_products/supplier_product"> 
                                            <i class="fa fa-black-tie"></i>
                                            <span class="menu-title">
                                                <strong>Product Suppliers</strong> 
                                            </span>
                                        </a>
                                    </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-registered"></i>
                                        <span class="menu-title">
                                            <strong>Purchase Requests</strong>
                                            <span class="label label-danger"><?php  echo $this->requestAction('App/pending_po_raw_request_count_lest_side/pending'); ?></span>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">   
                                        <li><a href="/po_raw_requests/list_view?status=pending">Pending<span class="label label-danger"><?php  echo $this->requestAction('App/pending_po_raw_request_count_lest_side/pending'); ?></span></a></li>   
                                        <li><a href="/po_raw_requests/list_view?status=approved">Approved</a></li>   
                                        <li><a href="/po_raw_requests/list_view?status=processed">Processed</a></li>   	
                                    </ul>
                                </li> 
                                <li>
                                    <a href="/collections/all_list?status=unverified"> 
                                        <i class="fa fa-ban"></i>
                                        <span class="menu-title">
                                            <strong>Unverified Collections</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong>
                                            <?php if ($this->requestAction('App/count_quotations/approved_by_proprietor') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_quotations/approved_by_proprietor'); ?></span>
                                            <?php } ?>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li>
                                        <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                        <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved
                                                <?php if ($this->RequestAction('App/approved_by_proprietor_quote_count_left_side/approved_by_proprietor') != 0) { ?>
                                                    <span class="label label-danger "><?php echo $this->RequestAction('App/approved_by_proprietor_quote_count_left_side/approved_by_proprietor'); ?></span>
                                                <?php } ?></a></li>
                                        <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                        <li><a href="/quotations/proprietor?status=processed">Processed</a></li>
    
                                    </ul>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cash Request</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cash&&status=pending">Pending
                                            <?php if ($this->requestAction('App/count_pending_pr/cash') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cash'); ?></span>
                                            <?php } ?>
                                        </a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=acknowledged">Acknowledged</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cheque Request</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=pending">Pending
                                            <?php if ($this->requestAction('App/count_pending_pr/cheque') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/cheque'); ?></span>
                                            <?php } ?>
                                        </a></li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Petty Cash Request</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=pending">Pending
                                            <?php if ($this->requestAction('App/count_pending_pr/pettycash') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_pr/pettycash'); ?></span>
                                            <?php } ?>
                                        </a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=replenished">Replenished</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-check-square"></i>
                                        <span class="menu-title">
                                            <strong>Replenishments</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse">
                                        <li><a href="/payment_requests/replenishments?status=pending">Pending
                                            <?php if ($this->requestAction('App/count_pending_replenishment') != 0) { ?>
                                                <span class="label label-danger "><?php echo $this->requestAction('App/count_pending_replenishment'); ?></span>
                                            <?php } ?>
                                        </a></li>
                                        <li><a href="/payment_requests/replenishments?status=acknowledged">Acknowledged</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">  
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Collection Requests</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">   
                                        <li><a href="/collection_schedules/add_schedule">Add Schedule</a></li>
                                        <li><a href="/collection_schedules/list_view?status=today">Collection For Today</a></li>   
                                        <li><a href="/collection_schedules/list_view?status=for_collection">For Collection</a></li>   
                                        <li><a href="/collection_schedules/list_view?status=collected">Collected</a></li>   	
                                    </ul>
                                </li> 
                                
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Collections</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/quotations/quotations_for_accounting?status=for_collection">For Collection</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=with_terms">With Terms</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=incomplete">Incomplete</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=backjob">With Backjob</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=undelivered">Undelivered</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=pdc">With PDC</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=bir2307">BIR 2307</a></li> 
                                        <li><a href="/quotations/quotations_for_accounting?status=paid">Fully Paid</a></li> 
    
                                    </ul>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>For Advance Invoice</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/collection_papers/advance_invoice?status=pending">Pending</a></li>
                                        <li><a href="/collection_papers/advance_invoice?status=served">Served</a></li>
                                    </ul>
                                </li> 
                                <li>
                                    <a href="/statement_of_accounts/all_list"> 
                                        <i class="fa fa-newspaper-o"></i>
                                        <span class="menu-title">
                                            <strong>Statement of accounts</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/payees/add"> 
                                        <i class="fa fa-newspaper-o"></i>
                                        <span class="menu-title">
                                            <strong>Add Payee</strong>
                                        </span>
                                    </a>
                                </li> 
                                
                                <!--Widget-->
                                    <!--================================-->
                                    <div class="mainnav-widget">
                                        <!-- Hide the content on collapsed navigation -->
                                        <?php
                                        $user_role = $UserIn['User']['role'];
                                        $is_authorized=false;
                                        $authorized_users = ['accounting_head'];
                                        foreach($authorized_users as $authorized_user) {
                                        	if($authorized_user==$user_role) {
                                        		$is_authorized=true;
                                        	}
                                        }
                                        if($is_authorized) { ?>
                                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                            <ul class="list-group">
                                                <li class="list-header pad-no pad-ver">Quotation Status</li>
                                                <li class="mar-btm">
                                                    <span class="label label-primary pull-right"><?php echo $this->requestAction('App/ac_approved_count'); ?>%</span>
                                                    <p>Approved</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-primary" style="width:<?php echo $this->requestAction('App/ac_approved_count'); ?>%;">
                                                            <span class="sr-only"><?php echo $this->requestAction('App/ac_approved_count'); ?>%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!--================================-->
                                <!--End widget-->
                            <?php } ?>
                            <!-- accounting_head -->
    
                            <!--<li>-->
                            <!--    <a href=""> -->
                            <!--        <i class="fa fa-tasks"></i>-->
                            <!--        <span class="menu-title">-->
                            <!--            <strong>Task List</strong>-->
                            <!--        </span>-->
                            <!--        <i class="arrow"></i>-->
                            <!--    </a> -->
                            <!--    <ul class="collapse">-->
                            <!--        <li class="list-group-item-heading"><a href="/tasks/add">Add To-do</a></li>-->
                            <!--        <li class="list-divider"></li>-->
                            <!--        <li><a href="/tasks/task_list?status=Ongoing">Ongoing</a></li>-->
                            <!--        <li><a href="/tasks/task_list?status=To-do">To-Do</a></li>  -->
                            <!--        <li><a href="/tasks/task_list?status=Completed">Completed</a></li>  -->
                            <!--        <li><a href="/tasks/task_list?status=Created">Created</a></li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                            
                            
                            <!-- fitout_facilitator -->
                                <?php if ($UserIn['User']['role'] == 'cost_accountant') { ?>
                                    <li class="active-link">
                                        <a href="/users/dashboard_cost_accountant"> 
                                            <i class="ion-home"></i>
                                            <span class="menu-title">
                                                <strong>Dashboard</strong>
                                            </span>
                                        </a>
                                    </li>        
                                    <li>
                                        <a href=""> 
                                            <i class="fa fa-file-pdf-o"></i>
                                            <span class="menu-title">
                                                <strong>Quotations</strong> 
                                            </span>
                                            <i class="arrow"></i>
                                        </a> 
                                        <ul class="collapse">
                                            <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                            <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li>
                                            <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                            <li><a href="/quotations/proprietor?status=approved_by_proprietor">Approved </a></li>
                                            <li><a href="/quotations/proprietor?status=approved">Approved By Accounting</a></li>
                                            <li><a href="/quotations/proprietor?status=processed">Processed</a></li>
        
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="/supplier_products/supplier_product"> 
                                            <i class="fa fa-black-tie"></i>
                                            <span class="menu-title">
                                                <strong>Product Suppliers</strong> 
                                            </span>
                                        </a>
                                    </li>
        
                                <?php } ?>
                                <!-- fitout_facilitator -->
                            
        
                                <!--PLANT MANAGER-->
                                <?php if ($UserIn['User']['role'] == 'plant_manager') { ?>
                                    <li class="active-link">
                                        <a href="/users/dashboard_plant_manager"> 
                                            <i class="ion-home"></i>
                                            <span class="menu-title">
                                                <strong>Dashboard</strong>
                                            </span>
                                        </a>
                                    </li>        
                                    <li>
                                        <a href="">
                                            <i class="fa fa-send-o"></i>
                                            <span class="menu-title">
                                                <strong>Demo</strong>
                                            </span>
                                            <i class="arrow"></i>
                                        </a> 
                                        <ul class="collapse">
                                            <li><a href="/client_services/all_lists?type=demo&&status=processed">Processed</a></li>
                                            <li><a href="/client_services/all_lists?type=demo&&status=delivered">Delivered</a></li>
                                            <li><a href="/client_services/all_lists?type=demo&&status=pullout">Pullout</a></li>
                                            <li><a href="/client_services/all_lists?type=pull_out&&status=pullout_successful">Pullout Successful</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <!--END OF PLANT MANAGER-->
                                
                                <!-- START OF PURCHASING SUPERVISOR -->
                            <?php if ($UserIn['User']['role'] == 'purchasing_supervisor') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_purchasing_supervisor"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>  
                                <li >
                                    <a href=""> 
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="menu-title">
                                            <strong>Suppliers</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/purchase_order_products/supply_top_purchased?type=raw">Top Purchased</a></li>  
                                        <li><a href="/suppliers/supplier_list">All</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-pdf-o"></i>
                                        <span class="menu-title">
                                            <strong>Quotations</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/quotation_products/purchasing_list">Products</a></li> 
                                        <li><a href="/quotations/sales_moved">Moved</a></li> 
                                        <li><a href="/quotations/proprietor?status=rejected">Rejected</a></li> 
                                        <li><a href="/quotations/accounting_moved">Approved</a></li>
                                        <li><a href="/quotations/approved">Approved by Accounting</a></li> 
                                        <li><a href="/quotations/processed">Processed</a></li>  	
                                    </ul>
                                </li> 
                                <li >
                                    <a href="/quotation_products/po_products"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Unprocessed Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Purchase Order</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/purchase_order_products/top_purchased?dept=6">Top Purchased </a></li> 
                                        <li><a href="/purchase_orders/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/purchase_orders/all_list?status=pending">Pending</a></li>   
                                        <li><a href="/purchase_orders/all_list?status=processed">Processed</a></li>   	
                                    </ul>
                                </li>  
                                <li >
                                    <a href="/products/index"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Products</strong>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <!-- END OF PURCHASING SUPERVISOR -->
                                
                                
                            <!-- material_expediter -->
                            <?php if ($UserIn['User']['role'] == 'material_expediter') { ?>
                                <li class="active-link">
                                    <a href="/users/dashboard_material_expediter"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li> 
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-archive"></i>
                                        <span class="menu-title">
                                            <strong>Job Requests</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
    
                                    <!--Submenu-->
                                    <ul class="collapse"> 
                                        <li><a href="/job_requests/all_lists?status=pending">Pending</a></li>
                                        <li><a href="/job_requests/all_lists?status=ongoing">Ongoing</a></li>
                                        <li><a href="/job_requests/all_lists?status=accomplished">Accomplished</a></li>
    
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-paint-brush"></i>
                                        <span class="menu-title">
                                            <strong>Productions</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                    
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="/productions/all_list?status=pending">Pending</a></li>
                                        <li><a href="/productions/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/productions/all_list?status=accomplished">Accomplished</a></li>
                                        <li><a href="/productions/all_list?status=viewed">Viewed</a></li>
    
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- material_expediter -->
                            <!-- subcon_purchasing -->  
                         <?php if ($UserIn['User']['role'] == 'subcon_purchasing') { ?>
                               
                                <li class="active-link">
                                    <a href="/users/dashboard_subcon_purchasing"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>  
                                <li >
                                    <a href=""> 
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="menu-title">
                                            <strong>Suppliers</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">
                                        <li><a href="/purchase_order_products/supply_top_purchased?type=raw">Top Purchased</a></li>  
                                        <li><a href="/suppliers/supplier_list">All</a></li>
                                    </ul>
                                </li>
        
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-file-powerpoint-o"></i>
                                        <span class="menu-title">
                                            <strong>Purchase Order</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/purchase_order_products/top_purchased?dept=6">Top Purchased </a></li> 
                                        <li><a href="/purchase_orders/all_list?status=ongoing">Ongoing</a></li>
                                        <li><a href="/purchase_orders/all_list?status=pending">Pending</a></li>   
                                        <li><a href="/purchase_orders/all_list?status=processed">Processed</a></li>   	
                                    </ul>
                                </li>  
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cash Request</strong> 
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cash&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=acknowledged">Acknowledged </a> </li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Cheque Request</strong> 
                                        </span>
                                        <i class="arrow"></i>
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=pending">Pending </a> </li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=cheque&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> 
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">
                                            <strong>Petty Cash Request</strong> 
                                        </span> 
                                    </a> 
                                    <ul class="collapse">  
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=pending">Pending</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=approved">Approved</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=released">Released</a></li>
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=liquidated">Liquidated</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=verified">Verified</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=replenished">Replenished</a></li> 
                                        <li><a href="/payment_requests/all_list?type=pettycash&&status=closed">Closed</a></li> 
                                    </ul>
                                </li>
                                
                                <?php } ?>
                            <!-- subcon_purchasing -->
                                
                            <!-- quantity_surveyor -->  
                         <?php if ($UserIn['User']['role'] == 'quantity_surveyor') { ?>
                               
                                <li class="active-link">
                                    <a href="/users/dashboard_subcon_purchasing"> 
                                        <i class="ion-home"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                        </span>
                                    </a>
                                </li>  
                                <li>
                                    <a href="/supplier_products/fitout_lists"> 
                                        <i class="ion-soup-can"></i>
                                        <span class="menu-title">
                                            <strong>Products Supplier</strong>
                                        </span>
                                    </a>
                                </li>   
                                <?php } ?>
                            <!-- quantity_surveyor -->
                                
                    </div>
                </div>
            </div>
            <!--================================-->
            <!--End menu-->
    
        </div>
    </nav>
    <!--===================================================-->
    <!--END MAIN NAVIGATION-->
    
    
    <!--</div>--> 