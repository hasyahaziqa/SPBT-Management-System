<?php
  include 'db.php';

  if (
    (isset($_POST['uname'])) &&
    (isset($_POST['pass']))
  ) {
    foreach ($_POST as $key => $value) {
      $$key = $value;
    }

    $password = $pass;
    include 'include/passrewrite.php';
    
      $query = $db->query("SELECT * FROM user WHERE username = '".$uname."' AND password = '".$password."' AND user_type = 'squad'");
      
    if ($row = mysqli_fetch_array($query)) {
      $_SESSION['AUTHENTIFICATION'] = $row['user_type'];
      $_SESSION['USER_ID'] = $row['id'];
      $output['redirect'] = $DOMAIN;
      $output['pop_success'] = "You've Login Successfully";
      $output['status'] = 'true';
    }else {
      $output['pop_alert'] = 'Invalid Username/Password';
      $output['redirect'] = '';
      $output['status'] = 'false';
    }
    header('location: index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<base href="<?php echo $DOMAIN ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Squad Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	.form-login h2.form-login-heading {
    		background: #ffd777;

    	}

    	.btn-theme {
    		background: #ffd777;
    		border: #000000;
    	}

    	.btn-theme:hover,
		.btn-theme:focus,
		.btn-theme:active,
		.btn-theme.active,
		.open .dropdown-toggle.btn-theme {
			color: #fff;
			background-color: #654321;
			border: #000000;
		}


    </style>
  </head>

  <body>
  	<?php include 'view/message.php'; ?>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <br>
      <br>
      <br>
      <br>
      <br>
      

  
	  <div id="login-page">
	  	<div class="container">
		      <form class="form-login" action="" method="post">
		        <h2 class="form-login-heading">
            <img src="ttdi.jpg" style="width: 55px; float: left;">sign in now <br><br>
                                              (skuad)</h2>
		        <div class="login-wrap">
		            <input id="inp_uname" type="text" name="uname" class="form-control" placeholder="User ID" required>
		            <br>
		            <input id="inp_passw" type="password" name="pass" class="form-control" placeholder="Password" required autocomplete>
		            <br>
                <input type="submit" class="btn btn-theme btn-block" name="loginNow" value="SIGN IN">
		            <hr>
		            
		            		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/books.jpg", {speed: 500});
    </script>

  </body>
</html>
