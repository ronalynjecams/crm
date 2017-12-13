<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Progfdfile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap">
                            <div class="pad-btm">
                                <span class="label label-success pull-right"><?php echo $UserIn['Department']['name']; ?></span>
                                <img class="img-circle img-sm img-border" src="../img/profile-photos/1.png" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
<!--                                            <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>-->
                                <p class="mnp-name"><?php echo $UserIn['User']['first_name'] . '  ' . $UserIn['User']['last_name']; ?></p>
                                <span class="mnp-desc"><?php echo $UserIn['Position']['name']; ?></span>
                            </a>
                        </div>
                        <!--                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                                                <a href="#" class="list-group-item">
                                                                    <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                                                                </a>
                                                                <a href="#" class="list-group-item">
                                                                    <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                                                                </a>
                                                                <a href="#" class="list-group-item">
                                                                    <i class="demo-pli-information icon-lg icon-fw"></i> Help
                                                                </a>
                                                                <a href="users/login" class="list-group-item">
                                                                    <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                                                </a>
                                                            </div>-->
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
                                <a href="/users/dashboard_accounting_head"> 
                                    <i class="ion-home"></i>
                                    <span class="menu-title">
                                        <strong>Dashboard</strong>
                                    </span>
                                </a>
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
                                    </span>
                                    <i class="arrow"></i>
                                </a>
                                <ul class="collapse">
                                    <li><a href="/payment_requests/replenishments?status=pending">Pending</a></li>
                                    <li><a href="/payment_requests/replenishments?status=acknowledged">Acknowledged</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""> 
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span class="menu-title">
                                        <strong>Quotations</strong>
                                        <?php if ($accounting_moved_quote_count_left_side != 0) { ?>
                                            <span class="label label-danger "><?php echo $accounting_moved_quote_count_left_side; ?></span>
                                        <?php } ?>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">
                                    <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                    <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                    <li><a href="/quotations/proprietor?status=accounting_moved">Approved By Accounting
                                            <?php if ($accounting_moved_quote_count_left_side != 0) { ?>
                                                <span class="label label-danger "><?php echo $accounting_moved_quote_count_left_side; ?></span>
                                            <?php } ?></a></li>
                                    <li><a href="/quotations/proprietor?status=approved">Approved</a></li>
                                    <li><a href="/quotations/proprietor?status=processed">Processed</a></li>

                                </ul>
                            </li> 
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
                                    <li><a href="/quotations/sales_moved">Moved</a></li>
                                    <li><a href="/quotations/approved">Approved</a></li>
                                    <!--                                                                    <li><a href="/quotations/lost">Lost</a></li> 
                                                                                                        <li><a href="/quotations/void">Void</a></li> -->

                                </ul>
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
                                    <li><a href="/client_services/all_lists?type=demo&&status=delivered">Delivered</a></li>
                                    <li><a href="/client_services/all_lists?type=demo&&status=pullout">Pullout</a></li>
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
                                </ul>
                            </li>
                        <?php } ?>
                        <!-- sales manager start-->
                        <?php if ($UserIn['User']['role'] == 'sales_manager') { ?>
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
                                    <li><a href="/quotations/proprietor?status=moved">Moved</a></li>
                                    <li><a href="/quotations/proprietor?status=accounting_moved">Approved By Accounting</a></li>
                                    <li><a href="/quotations/proprietor?status=approved">Approved</a></li>
                                    <li><a href="/quotations/proprietor?status=processed">Processed</a></li> 
                                </ul>
                            </li>
                            
                            
                        <?php } ?>
                        <!-- sales manage end -->
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
                                <a href="/products/index"> 
                                    <i class="ion-soup-can"></i>
                                    <span class="menu-title">
                                        <strong>Products</strong>
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
                            <li>
                                <a href=""> 
                                    <i class="ion-soup-can"></i>
                                    <span class="menu-title">
                                        <strong>Job Request</strong>
                                        <?php if ($jr_head_count_left_side != 0) { ?>
                                            <span class="label label-danger "><?php echo $jr_head_count_left_side; ?></span>
                                        <?php } ?>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">
                                    <li><a href="/job_requests/head_view?status=pending"> Pending </a></li>
                                    <li><a href="/job_requests/head_view?status=ongoing"> Ongoing </a></li>
                                    <li><a href="/job_requests/head_view?status=accomplished"> Accomplished </a></li>

                                </ul>
                            </li>   
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
                            <li>
                                <a href=""> 
                                    <i class="ion-soup-can"></i>
                                    <span class="menu-title">
                                        <strong>Job Request</strong>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">
                                    <li><a href="/job_requests/design_product?type=pending"> Pending </a></li>
                                    <li><a href="/job_requests/design_product?type=ongoing"> Ongoing </a></li>
                                    <li><a href="/job_requests/design_product?type=accomplished"> Accomplished </a></li>

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
                                <a href="/suppliers/supplier_list"> 
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">
                                        <strong>Suppliers</strong>
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
                                    <li><a href="/quotations/approved">Approved</a></li>
                                    <li><a href="/quotations/processed">Processed</a></li>   	
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
                            <li >
                                <a href="/suppliers/supplier_list"> 
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">
                                        <strong>Suppliers</strong>
                                    </span>
                                </a>
                            </li>  
                            <li >
                                <a  href="/quotations/approved"> 
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span class="menu-title">
                                        <strong>Quotations</strong>
                                    </span>
                                </a>
                            </li>   
                            <li>
                                <a href=""> 
                                    <i class="fa fa-registered"></i>
                                    <span class="menu-title">
                                        <strong>Requests</strong>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">   
                                    <li><a href="/po_raw_requests/list_view?status=pending">Pending</a></li>   
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

                        <?php } ?>
                        
                        <!--FOR HR HEAD SIDE BAR-->
                        <?php
                        if($UserIn['User']['role'] == 'hr_head') { ?>
                        <?php } ?>
                        <!--END OF HR HEAD SIDE BAR-->
                        
                        <!-- raw_staff -->
                        <!-- warehouse supply-->
                        <?php if ($UserIn['User']['department_id'] == 9) { ?>
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
                        <!-- collection_officer-->
                        <?php if ($UserIn['User']['role'] == 'collection_officer') { ?>
                            <li class="active-link">
                                <a href="/users/dashboard_warehouse"> 
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
                                        <strong>Collection Requests</strong>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">   
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
                                    <li><a href="/collections/accounting?status=pending">Pending</a></li>
                                    <li><a href="/collections/accounting?status=for_collection">For Collection</a></li>
                                    <li><a href="/collections/accounting?status=paid">Fully Collected</a></li> 

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
                               $UserIn['User']['role']=="proprietor_secretary") {
                                   ?>
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
                            
                            <li>
                                <a href=""> 
                                    <i class="fa fa-file-powerpoint-o"></i>
                                    <span class="menu-title">
                                        <strong>Job Requests</strong>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">  
                                    <li><a href="/purchase_orders/all_list?status=ongoing">New</a></li>
                                    <li><a href="/purchase_orders/all_list?status=ongoing">Ongoing</a></li> 
                                    <li><a href="/purchase_orders/all_list?status=ongoing">Finished</a></li>  
                                </ul>
                            </li> 
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
                        <?php } ?>
                        <!-- admin_staff -->



                        <!-- accounting_head -->

                        <?php if ($UserIn['User']['role'] == 'accounting_head') { ?> 
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
                                    <i class="fa fa-money"></i>
                                    <span class="menu-title">
                                        <strong>Cash Request</strong>
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
                                    </span>
                                    <i class="arrow"></i>
                                </a>
                                <ul class="collapse">
                                    <li><a href="/payment_requests/replenishments?status=pending">Pending</a></li>
                                    <li><a href="/payment_requests/replenishments?status=acknowledged">Acknowledged</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""> 
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span class="menu-title">
                                        <strong>Quotations</strong>
                                        <?php if ($moved_quote_count_left_side != 0) { ?>
                                            <span class="label label-danger "><?php echo $moved_quote_count_left_side; ?></span>
                                        <?php } ?>
                                    </span>
                                    <i class="arrow"></i>
                                </a> 
                                <ul class="collapse">
                                    <li><a href="/quotations/proprietor?status=pending">Pending</a></li>
                                    <li><a href="/quotations/proprietor?status=moved">Moved
                                            <?php if ($moved_quote_count_left_side != 0) { ?>
                                                <span class="label label-danger "><?php echo $moved_quote_count_left_side; ?></span>
                                            <?php } ?></a></li>
                                    <li><a href="/quotations/proprietor?status=accounting_moved">Approved By Accounting</a></li>
                                    <li><a href="/quotations/proprietor?status=approved">Approved</a></li>
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
                                    <li><a href="/collections/accounting?status=pending">Pending</a></li>
                                    <li><a href="/collections/accounting?status=for_collection">For Collection</a></li>
                                    <li><a href="/collections/accounting?status=paid">Fully Collected</a></li> 

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
                        <?php } ?>
                        <!-- accounting_head -->


                        <!--Widget-->
                        <!--================================-->
                        <div class="mainnav-widget">


                            <!-- Hide the content on collapsed navigation -->
                            <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                <ul class="list-group">
                                    <li class="list-header pad-no pad-ver">Quotation Status</li>
                                    <li class="mar-btm">
                                        <span class="label label-primary pull-right">15%</span>
                                        <p>Approved</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-primary" style="width: 15%;">
                                                <span class="sr-only">15%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mar-btm">
                                        <span class="label label-purple pull-right">75%</span>
                                        <p>Pending</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-purple" style="width: 75%;">
                                                <span class="sr-only">75%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--================================-->
                        <!--End widget-->

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



