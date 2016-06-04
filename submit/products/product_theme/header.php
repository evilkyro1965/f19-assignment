<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php bloginfo("stylesheet_directory");?>/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php bloginfo("stylesheet_directory");?>/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php bloginfo("stylesheet_directory");?>/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script src="<?php bloginfo("stylesheet_directory");?>/js/jquery-1.7.2.min.js"></script>
		<script src="<?php bloginfo("stylesheet_directory");?>/js/script.js"></script>
		
  </head>  
	
  <body>
	
	<header>
		<a href="#" class="headerLogo">
			<img src="<?php bloginfo("stylesheet_directory");?>/i/small_placeholder.png" alt="Image"/>
		</a>
		
		<?php
			$menus = wp_get_nav_menu_items( "top" ); 
		?>	
		<ul class="menuSmall">
		<?php
			if($menus != null) :
				foreach($menus as $index=>$menu) :
					$class= $menu->object_id == $postId ? "active" : "";
					$separator = $index > 0 ? " | " : "";
		?>
				<li><?php echo $separator;?><a href="<?php echo $menu->url;?>" class=""><?php echo $menu->title;?></a></li>
		<?php 
				endforeach;
			endif;
		?>
		</ul>
		
		<?php
			$menus = wp_get_nav_menu_items( "main" ); 
		?>	
		<ul class="menuBig">
		<?php
			if($menus != null) :
				foreach($menus as $index=>$menu) :
					$class= $menu->object_id == $postId ? "active" : "";
					$separator = $index > 0 ? " | " : "";
		?>
				<li><?php echo $separator;?><a href="<?php echo $menu->url;?>" class=""><?php echo $menu->title;?></a></li>
		<?php 
				endforeach;
			endif;
		?>
		</ul>
		
	</header>
