<?php
$curpage = $this->uri->uri_string;
$editpage = explode('/',$curpage);
if(count($editpage) > 0)
{
	$curpage = $editpage[0].'/'.$editpage[1];
}
?>

<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
			<ul class="sidebar-menu" id="nav-accordion">
				<li>
	                <a class="" href="<?php echo base_url(); ?>">
	                    <i class="fa fa-dashboard"></i>
	                    <span>Dashboard</span>
	                </a>
	            </li>
	            <li>
	                <a class="" href="<?php echo base_url().'user/users'; ?>">
	                    <i class="fa fa-users"></i>
	                    <span>Users</span>
	                </a>
	            </li>
	            <li>
	                <a class="" href="<?php echo base_url().'user/inbox'; ?>">
	                    <i class="fa fa-inbox"></i>
	                    <span>Inbox</span>
	                </a>
	            </li>
	        </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->