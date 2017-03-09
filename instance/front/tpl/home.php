<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m12 l12">
                <div>
                    <div style="float:left;font-size: 20px;"><img style="height: 100px;" src="<?= _MEDIA_URL . "images/Golden_State_Warriors_logo.png"; ?>" /></div>
                    <div style="float: left; font-size: 22px; margin: 27px 0px 0px 27px; color: #297ab4;">Golden State Warriors</div>

                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="row card-panel">
        <div class="col l4 m4 s12">
            <h3>Summary Statistics</h3>
        </div>
        <div class="col l4 m4 s12">
            <center><h5>Current Record</h5></center>
            <center><h4>32W - 2L - 1T</h4></center>
        </div>
        <div class="col l4 m4 s12">
            <center><h5>Projected Record</h5></center>
            <center><h4>62W - 8L - 1T</h4></center>
        </div>
        <hr>
        <div id="test1" class="col s12">
            <div class="col l4 m4 s12">
                <ul class="collapsible" data-collapsible="accordion" style="margin-top: 0px;">
                    <li>
                        <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>Current Interesting Facts</div>
                        <div class="collapsible-body"><p>Here is Current Interesting Facts.</p></div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="mdi-maps-place"></i>Cool Observation</div>
                        <div class="collapsible-body"><p>Here is Cool Observation</p></div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="mdi-social-whatshot"></i>Observation 2</div>
                        <div class="collapsible-body"><p>Here is Observation.</p></div>
                    </li>
                </ul>
            </div>
            <div class="col l4 m4 s12">     
                <div class="card-panel stats-card blue lighten-2 blue-text text-lighten-5">                    
                    <span class="count">99%</span>
                    <span class="count" style="font-size: 18px; font-weight: normal;">chance of winning next game vs team Y</span>
                </div>
            </div>
            <div class="col l4 m4 s12">                

                <div class="card-panel stats-card red lighten-2 blue-text text-lighten-5">                    
                    <span class="count">98%</span>
                    <span class="count" style="font-size: 18px; font-weight: normal;">chance of winning winning championship</span>
                </div>
            </div>
        </div>        
    </div>


    <div class="row">
        <!--  Line Chart  -->
        <div class="col s12 l7">
            <div class="card">
                <div class="title">
                    <h5>Power Ranking Over Time</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <div id="flotLineChart" style="height: 300px"></div>
                </div>
            </div>
        </div>
        <!--  /Line Chart  -->

        <!--  Pie Chart  -->
        <div class="col s12 l5">
            <div class="card">
                <div class="title">
                    <h5>Point BreakDown</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <div id="chart2" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <!--  /Pie Chart  -->
    </div>

    <div class="row">
        <div class="card-panel">
            <div class="l12">
                <a class="btn"><i class="fa fa-share-square-o"></i>&nbsp;Export Data</a>
            </div>
        </div>
    </div>



</section>
<!-- /Main Content -->
