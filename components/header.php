<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Mobilyser</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="css/modern-business.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/demo_table.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="row" style="height:149px;">
      <div class="navbar-header col-md-5"><i class="fa fa-mobile fa-5x" style="font-size: 9em!important; float:left; color:#fff;"></i> 
        <a class="navbar-brand" style="margin-top:30px; margin-left:0px; color:#fff;" href="index.php">Mobilyser<br />
        <span style="font-size:12px; font-weight:bold; color:#FFFFFF;">Mobile | Tracking | Analysis</span></a> 
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