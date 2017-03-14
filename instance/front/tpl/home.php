<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m12 l4">
                <div class="logo-img-block"><img src="<?= _MEDIA_URL . "images/Golden_State_Warriors_logo.png"; ?>" /></div>
                <div class="logo-text-block">Golden State Warriors</div>
                <div style="clear: both;"></div>
            </div>
            <div class="col s12 m12 l8">


                <div class="logo-subscribe-team">
                    <button type="button" class="btn">Subscribe to Team</button>
                </div>
                <div class="projected-record">
                    <center><h5>Projected Record</h5></center>
                    <center><h4>65W - 17L</h4></center>
                </div>
                <div class="current-record">
                    <center><h5>Current Record</h5></center>
                    <center><h4>52W - 13L</h4></center>
                </div>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="row card-panel summary-statistics">
        <div class="col l12 m12 s12 summary-statistics-head">
            <h3>Summary Statistics</h3>
        </div>
        <div class="col l4 m4 s12 summary-statistics-body">
            <ul class="collapsible" data-collapsible="accordion" style="margin-top: 0px;">
                <li>
                    <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>Fact of the Day</div>
                    <div class="collapsible-body"><p>Daily / Weekly Observation Here</p></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="mdi-maps-place"></i>Editor's Opinion</div>
                    <div class="collapsible-body"><p>What's Our Outlook?</p></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="mdi-social-whatshot"></i>Hot News</div>
                    <div class="collapsible-body"><p>TheSkimm Meets Sports</p></div>
                </li>
            </ul>
        </div>
        <div class="col l4 m4 s12 summary-statistics-body">     
            <div class="card-panel stats-card blue lighten-2 blue-text text-lighten-5">                    
                <span class="count">78%</span>
                <span class="count" style="font-size: 18px; font-weight: normal;">chance of winning next game vs team Y</span>
            </div>
        </div>
        <div class="col l4 m4 s12 summary-statistics-body">                

            <div class="card-panel stats-card red lighten-2 blue-text text-lighten-5">                    
                <span class="count">99%</span>
                <span class="count" style="font-size: 18px; font-weight: normal;">chance of making the playoffs</span>
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
                    <div id="flotLineChart" style="height: 400px"></div>
                </div>
            </div>
        </div>
        <!--  /Line Chart  -->

        <!--  Pie Chart  -->
        <div class="col s12 l5">
            <div class="card">
                <div class="title">
                    <h5>Team Roster</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content auto-overflow">
                    <select multiple>
                        <option value="" disabled selected>Choose Player</option>
                        <option value="1" selected>Player 1</option>
                        <option value="2" selected>Player 2</option>
                        <option value="3" selected>Player 3</option>
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="title">
                    <h5>Point Breakdown</h5>
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
    <div style="clear:both;"></div>
    <div class="row card-panel key-payers">
        <div class="col l12 m12 s12 key-payers-head">
            <h3>Key Players</h3>
        </div>
        <div class="col l4 m4 s12 key-payers-body">
            <div class="key-player-profile">
                <img src="<?= _MEDIA_URL."assets/_con/images/user7.jpg" ?>" />
            </div>
            <div class="key-player-detail">
                <table>
                    <tr><th colspan="2" style="text-align: center;font-size: 15px;">Player 1</th></tr>
                    <tr><th>Position</th><td>#2</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>Age</th><td>30</td></tr>
                    <tr><th>Height</th><td>6'</td></tr>
                    <tr><th>Weight</th><td>200lbs</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>2pt FG Efficiency</th><td>90%</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>PPG</th><td>10</td></tr>
                    <tr><th>APG</th><td>20</td></tr>
                    <tr><th>RPG</th><td>30</td></tr>                    
                </table>
            </div>
        </div>
        <div class="col l4 m4 s12 key-payers-body">     
            <div class="key-player-profile">
                <img src="<?= _MEDIA_URL."assets/_con/images/user.jpg" ?>" />
            </div>
            <div class="key-player-detail">
                <table>
                    <tr><th colspan="2" style="text-align: center;font-size: 15px;">Player 2</th></tr>
                    <tr><th>Position</th><td>#5</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>Age</th><td>30</td></tr>
                    <tr><th>Height</th><td>6'</td></tr>
                    <tr><th>Weight</th><td>200lbs</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>2pt FG Efficiency</th><td>90%</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>PPG</th><td>10</td></tr>
                    <tr><th>APG</th><td>20</td></tr>
                    <tr><th>RPG</th><td>30</td></tr>                    
                </table>
            </div>
        </div>
        <div class="col l4 m4 s12 key-payers-body">                
            <div class="key-player-profile">
                <img src="<?= _MEDIA_URL."assets/_con/images/user9.jpg" ?>" />
            </div>
            <div class="key-player-detail">
                <table>
                    <tr><th colspan="2" style="text-align: center;font-size: 15px;">Player 3</th></tr>
                    <tr><th>Position</th><td>#8</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>Age</th><td>30</td></tr>
                    <tr><th>Height</th><td>6'</td></tr>
                    <tr><th>Weight</th><td>200lbs</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>2pt FG Efficiency</th><td>90%</td></tr>
                    <tr><th colspan="10" style='font-size: 4px;'>&nbsp;</th></tr>
                    <tr><th>PPG</th><td>10</td></tr>
                    <tr><th>APG</th><td>20</td></tr>
                    <tr><th>RPG</th><td>30</td></tr>                    
                </table>
            </div>
        </div>
        
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
