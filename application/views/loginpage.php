<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>backend/images/favicon.png">

    <title><?php echo $this->config->item('projectTitle'); ?> | Login</title>

    <!--Core CSS -->
    <link href="<?php echo base_url(); ?>backend/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>backend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>backend/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">
    <div class="container">
		<div id="responseMsg" class="col-md-offset-4 col-md-4"></div>
		<form class="form-signin" id="loginForm">
	        <h2 class="form-signin-heading">
	        	<?php echo $this->config->item('projectTitle'); ?>
	        </h2>
	        <div class="login-wrap">
	            <div class="user-login-info">
	                <input type="text" class="form-control" id="userName" placeholder="User ID" autofocus>
	                <input type="password" class="form-control" id="password" placeholder="Password">
	            </div>
	            <!--<label class="checkbox">
	                <input type="checkbox" value="remember-me"> Remember me
	                <span class="pull-right">
	                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

	                </span>
	            </label>-->
	            <button class="btn btn-lg btn-login btn-block" type="submit">
	            	Sign in
	            </button>
	            <!--<div class="registration">
	                Don't have an account yet?
	                <a class="" href="registration.html">
	                    Create an account
	                </a>
	            </div>-->
	        </div>

	          <!-- Modal -->
	          <!--<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
	              <div class="modal-dialog">
	                  <div class="modal-content">
	                      <div class="modal-header">
	                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                          <h4 class="modal-title">Forgot Password ?</h4>
	                      </div>
	                      <div class="modal-body">
	                          <p>Enter your e-mail address below to reset your password.</p>
	                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

	                      </div>
	                      <div class="modal-footer">
	                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
	                          <button class="btn btn-success" type="button">Submit</button>
	                      </div>
	                  </div>
	              </div>
	          </div>-->
	          <!-- modal -->
		</form>
    </div>
    
    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo base_url(); ?>backend/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>backend/bs3/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/jquery.ajax.js"></script>
    <script src="<?php echo base_url(); ?>backend/jquery.blockUI.js"></script>

<script>

$("#loginForm").submit(function(e)
{
	e.preventDefault();
	
	var userName = $("#userName").val();
	var password = $("#password").val();
	
	if(userName != "" && password != "")
	{
		var req = new Request();
		req.data = 
		{
			"userName" : userName, 
			"password" : password
		};
		req.url = "login/checkLogin";
		RequestHandler(req, showResponse);
	}
	else
	{
		return;
	}
});

function showResponse(data)
{
	data = JSON.parse(data);
	
	var isError = data.isError;
	var msg = data.msg;
	
	var str = '';
	
	if(isError)
	{
		str += '<div class="alert alert-danger fade in">';
        str += '<button data-dismiss="alert" class="close close-sm" type="button">';
        str += '<i class="fa fa-times"></i>';
        str += '</button>';
        str += '<strong>Oops! </strong>'+msg;
        str += '</div>';
	}
	else
	{
		str += '<div class="alert alert-success fade in">';
        str += '<button data-dismiss="alert" class="close close-sm" type="button">';
        str += '<i class="fa fa-times"></i>';
        str += '</button>';
        str += '<strong>Well done! </strong>'+msg;
        str += '</div>';
	}
	$("#responseMsg").html(str);
	$('html,body').animate({scrollTop: 0}, 700);
	
	if(!isError)
	{
		setTimeout(function()
		{
			location.href = '<?php echo base_url(); ?>user';
		}, 1000);
	}
}

</script>

</body>
</html>