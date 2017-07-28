<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3, minimum-scale=0.5" />
  <meta name="description" content="<?php bloginfo('description'); ?>" />
    <?php wp_head(); ?>
  <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
  <!--Resetting whole css !-->
  <!--Including our own style css!-->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/assets/css/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
  <!-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato"> -->
  <title><?php bloginfo('name'); ?> <?php wp_title('-'); ?></title>

  <script src="https://code.jquery.com/jquery.js"></script>
  <script src="<?php bloginfo('template_directory') ?>/assets/javascript/projectscript.js"></script>
</head>

<body data-spy="scroll" data-offset="0" data-target="#navbar-main">

<!-- ==== MENU ==== -->
<div id="navigation">
  <nav> <!-- <ul class="headerList"> !-->
     <li> <a href="#home"> <div class="element"> Home</div><img id="homeImg"  src="<?php bloginfo('template_directory') ?>/assets/img/icons/menu-home.png" width="50px" height="50px"></a></li>
     <li> <a href="#about"><div class="element"> About Me</div><img id="aboutImg" src="<?php bloginfo('template_directory') ?>/assets/img/icons/menu-about.png" width="50px" height="50px"></a></li>
     <li> <a href="#portfolio"><div class="element"> Portfolio</div><img id="portfolioImg" src="<?php bloginfo('template_directory') ?>/assets/img/icons/menu-portfolio.png" width="50px" height="50px"></a></li>
     <li> <a href="#blog"><div class="element"> Blog</div><img id="blogImg" src="<?php bloginfo('template_directory') ?>/assets/img/icons/menu-blog.png" width="50px" height="50px"></a></li>
     <li> <a href="#contact"><div class="element"> Contact</div><img id="contactImg" src="<?php bloginfo('template_directory') ?>/assets/img/icons/menu-contact.png" width="50px" height="50px"></a></li>
  </nav>
</div>
