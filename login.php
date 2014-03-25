<?php include ('header.php')?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Login</h1>
      <!--<ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Full Width Page</li>
          </ol>-->
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form class="form-horizontal">
        <fieldset>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="Email">Email</label>
            <div class="col-md-5">
              <input id="Email" name="Email" type="text" placeholder="Email" class="form-control input-md" required="">
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Password</label>
            <div class="col-md-5">
              <input id="textinput" name="textinput" type="text" placeholder="Password" class="form-control input-md" required="">
            </div>
          </div>
          <!-- Button -->
          <div class="form-group">
            <div class="col-md-3 col-md-push-5">
              <button id="btn-login" name="btn-login" class="btn btn-primary" style="width:100%">Login</button>
            </div>
          </div>
          <div class="col-md-3 col-md-push-5" style="text-align:center;"><a href="register.php">Register</a> | <a href="#">Forgot Password</a></div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
<!-- /.container -->
<?php include ('footer.php')?>