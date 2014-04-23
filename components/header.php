<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Mobilyser</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="css/modern-business.css" rel="stylesheet">
<link href="css/flat-ui.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/media-query.css" rel="stylesheet">
<link href="css/demo_table.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="row">
      <div class="navbar-header col-lg-5 col-xs-8">
	  	<a href="index.php"><img class="img-responsive" src="images/image-logo.png" border="0" /></a>
	  </div>
        <?php  
        if(!isset($_SESSION['sess_user_id'])) { 
          include 'components/header-public.php';
        }else{
          include 'components/header-private.php';
        }
        ?>
  </div>
  <!-- /.container -->
</nav>