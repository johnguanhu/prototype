<nav class="navbar-top">
    <div class="nav-wrapper">

        <!-- Sidebar toggle -->
        <a href="#" class="yay-toggle">
            <div class="burg1"></div>
            <div class="burg2"></div>
            <div class="burg3"></div>
        </a>
        <!-- Sidebar toggle -->

        <!-- Logo -->
        <a href="index.html" class="brand-logo"><h4>DataDunk</h4>
        </a>
        <!-- /Logo -->

        <!-- Menu -->
        <ul>            
            <li class="user">
                <a class="dropdown-button" data-activates="user-dropdown" href="#!">
                    <img src="<?php print _MEDIA_URL ?>assets/_con/images/user.jpg" alt="John Doe" class="circle"> John <i class="mdi-navigation-expand-more right"></i>
                </a>

                <ul id="user-dropdown" class="dropdown-content">
                    <li>
                        <a href="page-profile.html">
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="mail-inbox.html">
                            <i class="fa fa-envelope"></i> Messages
                            <span class="badge new">2 new</span>
                        </a>
                    </li>
                    <li>
                        <a href="#!">
                            <i class="fa fa-cogs"></i> Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="page-sign-in.html">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /Menu -->

    </div>
</nav>