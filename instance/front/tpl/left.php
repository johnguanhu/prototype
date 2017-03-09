<!--
  Yay Sidebar
  Options [you can use all of theme classnames]:
    .yay-hide-to-small         - no hide menu, just set it small with big icons
    .yay-static                - stop using fixed sidebar (will scroll with content)
    .yay-gestures              - to show and hide menu using gesture swipes
    .yay-light                 - light color scheme
    .yay-hide-on-content-click - hide menu on content click

  Effects [you can use one of these classnames]:
    .yay-overlay  - overlay content
    .yay-push     - push content to right
    .yay-shrink   - shrink content width
-->
    <aside class="yaybar yay-shrink yay-hide-to-small yay-gestures">

        <div class="top">
            <div>
                <!-- Sidebar toggle -->
                <a href="#" class="yay-toggle">
                    <div class="burg1"></div>
                    <div class="burg2"></div>
                    <div class="burg3"></div>
                </a>
                <!-- Sidebar toggle -->

                <!-- Logo -->
                <a href="#!" class="brand-logo">
                    <img src="<?php print _MEDIA_URL ?>assets/_con/images/logo-white.png" alt="Con">
                </a>
                <!-- /Logo -->
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">

                <ul>
                    <li class="yay-user-info">
                        <a href="page-profile.html">
                            <img src="<?php print _MEDIA_URL ?>assets/_con/images/user.jpg" alt="John Doe" class="circle">
                            <h3 class="yay-user-info-name">Dave Jay</h3>
                            <div class="yay-user-location">
                                <i class="fa fa-map-marker"></i> Las Vegas, NV
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?php print _MEDIA_URL ?>angularjs/" class=" waves-effect waves-blue"> <i class="fa fa-cubes"></i> Teams </a>

                    </li>
                    <li>
                        <a href="<?php print _MEDIA_URL ?>angularjs/" class=" waves-effect waves-blue"> <i class="fa fa-users"></i> Players </a>

                    </li>
                    <li>
                        <a href="<?php print _MEDIA_URL ?>angularjs/" class=" waves-effect waves-blue"> <i class="fa fa-rss"></i> Blog </a>

                    </li>

                    <li class="label">Extra</li>
                    <li>
                        <a href="<?php print _MEDIA_URL ?>angularjs/" class=" waves-effect waves-blue"> <i class="fa fa-map-marker"></i> Contact Us </a>

                    </li>
                    <li>
                        <a href="<?php print _MEDIA_URL ?>angularjs/" class=" waves-effect waves-blue"> <i class="fa fa-cog"></i> Settings </a>

                    </li>


                </ul>

            </div>
        </div>
    </aside>
    <!-- /Yay Sidebar -->