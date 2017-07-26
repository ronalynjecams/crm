
    <!--Morris.js [ OPTIONAL ]-->
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">


    <!--Morris.js [ OPTIONAL ]-->
    <script src="../plugins/morris-js/morris.min.js"></script>
	<script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> 
<!--<div class="boxed">-->      
<!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Dashboard</h1>

                    <!--Searchbox-->
                    <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="demo-pli-magnifi-glass"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					<div class="row">
					    <div class="col-lg-7">
					
					        <!--Network Line Chart-->
					        <!--===================================================-->
					        <div id="demo-panel-network" class="panel">
					            <div class="panel-heading">
					                <div class="panel-control">
<!--					                    <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn"><i class="demo-pli-repeat-2 icon-lg"></i></button>
					                    <div class="btn-group">
					                        <button class="dropdown-toggle btn" data-toggle="dropdown" aria-expanded="false"><i class="demo-pli-gear icon-lg"></i></button>
					                        <ul class="dropdown-menu dropdown-menu-right">
					                            <li><a href="#">Action</a></li>
					                            <li><a href="#">Another action</a></li>
					                            <li><a href="#">Something else here</a></li>
					                            <li class="divider"></li>
					                            <li><a href="#">Separated link</a></li>
					                        </ul>
					                    </div>-->
					                </div>
					                <h3 class="panel-title">Quotation</h3>
					            </div>
					
					            <!--Morris line chart placeholder-->
					            <div id="morris-chart-network" class="morris-full-content"></div>
					
					            <!--Chart information-->
					            <div class="panel-body">
					                <div class="row pad-top">
					                    <div class="col-lg-8">
					                        <div class="media">
					                            <div class="media-left">
					                                <div class="media">
					                                    <p class="text-semibold text-main">Temperature</p>
					                                    <div class="media-left pad-no">
					                                        <span class="text-2x text-semibold text-nowrap text-main">
					                                            <i class="demo-pli-temperature"></i> 43.7
					                                        </span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">°C</p>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="media-body pad-lft">
					                                <div class="pad-btm">
					                                    <p class="text-semibold text-main mar-no">Today Tips</p>
					                                    <small>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</small>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					
					                    <div class="col-lg-4">
					                        <p class="text-semibold text-main">Bandwidth Usage</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main">75.9</span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">Mbps</p>
					                                    </div>
					                                </div>
					                            </li>
					                            <li>
					                                <div class="clearfix">
					                                    <p class="pull-left mar-no">Outcome</p>
					                                    <p class="pull-right mar-no">75%</p>
					                                </div>
					                                <div class="progress progress-xs">
					                                    <div class="progress-bar progress-bar-info" style="width: 75%;">
					                                        <span class="sr-only">75%</span>
					                                    </div>
					                                </div>
					                            </li>
					                        </ul>
					                    </div>
					                </div>
					            </div>
					
					
					        </div>
					        <!--===================================================-->
					        <!--End network line chart-->
					
					    </div>
					    <div class="col-lg-5">
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline Area Chart-->
					                <div class="panel panel-success panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> Reports</p>
					                        <p class="mar-no">  This Month </p>
					                        <p class="mar-no">  Last Month </p>
					                        <p class="mar-no">  Yearly </p>
					                    </div>
					                    <div class="pad-all text-center">
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-area"></div>
					                    </div>
					                </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline Line Chart-->
					                <div class="panel panel-info panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold"><i class="demo-pli-wallet-2 icon-fw"></i> Earning</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$764</span>
					                            Today
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$1,332</span>
					                            Last 7 Day
					                        </p>
					                    </div>
					                    <div class="pad-all text-center">
					
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-line"></div>
					
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline bar chart -->
					                <div class="panel panel-purple panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold"><i class="demo-pli-bag-coins icon-fw"></i> Sales</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$764</span>
					                            Today
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$1,332</span>
					                            Last 7 Day
					                        </p>
					                    </div>
					                    <div class="pad-all text-center">
					
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-bar" class="box-inline"></div>
					
					                    </div>
					                </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline pie chart -->
					                <div class="panel panel-warning panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold"><i class="demo-pli-check icon-fw"></i> Quotation</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">34</span>
					                            Pending
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">79</span>
					                            Approved
					                        </p>
					                    </div>
					                    <div class="pad-all">
					                        <ul class="list-group list-unstyled">
					                            <li class="mar-btm">
					                                <span class="label label-warning pull-right">15%</span>
					                                <p>Progress</p>
					                                <div class="progress progress-md">
					                                    <div style="width: 15%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">15%</span>
					                                    </div>
					                                </div>
					                            </li>
					                        </ul>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
					
				 
					
					 
					
					
					
                </div>
                <!--===================================================-->
                <!--End page content-->


            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
            
            
          
