<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>backend/images/favicon.png">
    <title><?php echo $this->config->item('projectTitle'); ?> | Dashboard</title>
    
    <!--Core CSS -->
    <link href="<?php echo base_url(); ?>backend/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>backend/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>backend/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>backend/js/data-tables/DT_bootstrap.css" rel="stylesheet" />
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>backend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/css/style-responsive.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>backend/css/table-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/selectize/css/selectize.css" />
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>backend/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    
    <script src="<?php echo base_url(); ?>backend/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>backend/bs3/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/jquery.ajax.js"></script>
    <script src="<?php echo base_url(); ?>backend/jquery.blockUI.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/jquery.validate.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/advanced-datatable/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/data-tables/DT_bootstrap.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>backend/plugins/selectize/js/selectize.js"></script>
    
    <style>
    	.form-control, h1, h2, h3, h4, h5, h6, label
    	{
			color: #555555;
		}
    </style>
</head>

<body>
	<section id="container">
		<!--header start-->
		<header class="header fixed-top clearfix">
		<!--logo start-->
		<div class="brand">

		    <a href="<?php echo base_url(); ?>" class="logo">
		        <img src="<?php echo base_url(); ?>backend/images/venpep_logo_white.png" alt="">
		    </a>
		    <div class="sidebar-toggle-box">
		        <div class="fa fa-bars"></div>
		    </div>
		</div>
		<!--logo end-->

		<div class="top-nav clearfix">
		    <!--search & user info start-->
		    <ul class="nav pull-right top-menu">
		        <li>
		            <input type="text" class="form-control search" placeholder=" Search">
		        </li>
		        <!-- user login dropdown start-->
		        <li class="dropdown">
		            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
		                <img alt="" src="<?php echo base_url(); ?>backend/images/avatar1_small.jpg">
		                <span class="username">
		                	<?php echo $this->session->userdata('firstname'); ?>
		                </span>
		                <b class="caret"></b>
		            </a>
		            <ul class="dropdown-menu extended logout">
		                <li>
		                	<a href="<?php echo base_url(); ?>user/changepassword">
		                		<i class="fa fa-lock"></i> Change Password
		                	</a>
		                </li>
		                <li>
		                	<a href="<?php echo base_url(); ?>user/logout">
		                		<i class="fa fa-key"></i> Log Out
		                	</a>
		                </li>
		            </ul>
		        </li>
		        <!-- user login dropdown end -->
		    </ul>
		    <!--search & user info end-->
		</div>
		</header>
		<!--header end-->
		
		<?php $this->load->view('sidebar'); ?>