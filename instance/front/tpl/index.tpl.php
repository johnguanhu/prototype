<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="_nK">
        <link rel="icon" href="assets/_con/images/icon.png">

        <title> Data Dunk | <?php print _cg("page_title"); ?></title>

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

        <!-- nanoScroller -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/nanoscroller/bin/css/nanoscroller.css" />

        <!-- FontAwesome -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/fontawesome/css/font-awesome.min.css" />

        <!-- Material Design Icons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/material-design-icons/css/material-design-icons.min.css" />

        <!-- IonIcons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/ionicons/css/ionicons.min.css" />

        <!-- WeatherIcons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/weather-icons/css/weather-icons.min.css" />



        <!-- nvd3 -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/nvd3/build/nv.d3.min.css" />










        <!-- Main -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/css/con-base.css" />       
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>custom.css" />       

    </head>
    <body>
        <?php if ($no_visible_elements) : ?>
            <?php include $modulePage; ?>
            <?php
        else:
            include_once('navbar-menu.php');
            include_once('left.php');
            ?>

            <?php if (!(@include $modulePage)) : ?>
                <?php include "404.php"; ?>
            <?php endif; ?>
        <?php endif; ?>

        <footer>&copy; 2017
            <strong>DataDunk</strong>. All rights reserved. 
            <div class='social-media'>
                <span><i class="fa fa-3x fa-facebook-square"></i></span>
                <span><i class="fa fa-3x fa-twitter-square"></i></span>
                <span><i class="fa fa-3x fa-google-plus-square"></i></span>
                <span><i class="fa fa-3x fa-linkedin-square"></i></span>
                <span><i class="fa fa-3x fa-pinterest-square"></i></span>
            </div></footer>

        <!-- DEMO [REMOVE IT ON PRODUCTION] -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/_con/js/_demo.js"></script>

        <!-- jQuery -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery/dist/jquery.min.js"></script>

        <!-- jQuery RAF (improved animation performance) -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery-requestAnimationFrame/dist/jquery.requestAnimationFrame.min.js"></script>

        <!-- nanoScroller -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>

        <!-- Materialize -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/materialize/bin/materialize.js"></script>







        <!-- d3 -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/d3/d3.min.js"></script>

        <!-- nvd3 -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/nvd3/build/nv.d3.min.js"></script>










        <!-- Sortable -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/Sortable/Sortable.min.js"></script>

        <!-- Main -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/_con/js/_con.js"></script>

        <!-- Google Prettify -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/code-prettify/src/prettify.js"></script>


        <script>
            /*
             * Line Chart
             */
            
        </script>

        <?php include "scripts.php"; ?>
        <?php include "message.php"; ?>
        <?php include $jsInclude; ?>

        <?php if ($error): ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    setTimeout(function () {
                        $('#error_msg_div').fadeOut(1200);
                    }, 3500);
                });
            </script>
        <?php endif; ?>

        <?php if ($greetings): ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    setTimeout(function () {
                        $('#success_msg_div').fadeOut(1200);
                    }, 3500);
                });
            </script>
        <?php endif; ?>
    </body>
</html>










