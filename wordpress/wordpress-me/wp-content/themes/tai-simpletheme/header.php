<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <link rel='stylesheet' id='main-style'  href="<?php echo get_stylesheet_uri(); ?>" type='text/css'  />

    <!-- Bootstrap core CSS -->
    <!--link href="../../dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel='stylesheet' id='main-style'  href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css" type='text/css'  />
    
    

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    

    <!-- Custom styles for this template -->
    <!--link href="blog.css" rel="stylesheet" -->
    <link rel='stylesheet' id='main-style'  href="<?php echo get_template_directory_uri() ?>/css/blog.css" type='text/css'  />

    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


<body>
	
			
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <!--a class="blog-nav-item active" href="#">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
	  <a class="blog-nav-item" href="#">About</a-->

	<?php  echo getMaimMenu(); ?>



        </nav>
      </div>
    </div>

