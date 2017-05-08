<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>backend/images/favicon.png">

    <title><?php echo $this->config->item('projectTitle'); ?> | Change Password</title>

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
		
		<form class="form-signin" id="changePasswordForm">
	        <h2 class="form-signin-heading">
	        	<?php echo $this->config->item('projectTitle'); ?>
	        </h2>
	        <div class="login-wrap">
	            <div class="user-login-info">
	                <input type="password" class="form-control" id="oldPassword" placeholder="Old Password" required="" autofocus>
	                <input type="password" class="form-control" id="newPassword" placeholder="New Password" required="">
	                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required="">
	            </div>
	            <button class="btn btn-lg btn-login btn-block" type="submit">
	            	Change Password
	            </button>
	        </div>
		</form>

    </div>
    
    <!--Core js-->
    <script src="<?php echo base_url(); ?>backend/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>backend/bs3/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/jquery.ajax.js"></script>
    <script src="<?php echo base_url(); ?>backend/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/jquery.validate.min.js"></script>
<script>

$(document).ready(function()
{
});

$("#changePasswordForm").submit(function(e)
{
	e.preventDefault();
	
	$("#changePasswordForm").validate();
	
	var oldPassword = $("#oldPassword").val();
	var newPassword = $("#newPassword").val();
	var confirmPassword = $("#confirmPassword").val();
	
	var str = '';
	
	if(oldPassword != "" && newPassword != "")
	{
		if(newPassword == confirmPassword)
		{
			var req = new Request();
			req.data = 
			{
				"oldPassword" : oldPassword, 
				"newPassword" : newPassword
			};
			req.url = "user/updatePassword";
			RequestHandler(req, showResponse);
		}
		else
		{
			str += '<div class="alert alert-danger fade in">';
	        str += '<strong>Oops! </strong>New Password and Confirm Password Must Match';
	        str += '</div>';
		}
	}
	else
	{
		str += '<div class="alert alert-danger fade in">';
        str += '<strong>Oops! </strong>Please Fill All Fields.';
        str += '</div>';
	}
	$("#responseMsg").html(str);
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
        str += '<strong>Oops! </strong>'+msg;
        str += '</div>';
	}
	else
	{
		str += '<div class="alert alert-success fade in">';
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