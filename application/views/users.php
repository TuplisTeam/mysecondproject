<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        
        <div id="responseMsg"></div>
        
        <?php 
		$displayblock = "style='display:none;'";
		$displaynone = "style='display:block;'";
		
		if($entryId != "")
		{
			$displayblock = "style='display:block;'";
			$displaynone = "style='display:none;'";
		}
		?>
		
        <div class="row" id="listDetails" <?php echo $displaynone; ?>>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        User Details
                        <span class="tools pull-right">
                        	<button class="btn btn-xs btn-warning newEntry">
								Create New
							</button>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
		                    <table class="display table table-bordered table-striped" id="dataTable">
		                    	<thead>
		                    		<tr>
		                    			<th>User Name</th>
		                    			<th>User Email</th>
		                    			<th>Manage</th>
		                    		</tr>
		                    	</thead>
		                    	<tbody>
		                    		<?php
		                    		foreach($allDtls as $row)
		                    		{
									?>
									<tr>
										<td><?php echo $row->firstname; ?></td>
										<td><?php echo $row->email; ?></td>
										<td>
											<button type="button" class="btn btn-xs btn-success editEntry" title="Edit" entryId="<?php echo $row->userid; ?>">
												<i class="fa fa-pencil"></i>
											</button>
											<button type="button" class="btn btn-xs btn-danger delEntry" title="Delete" entryId="<?php echo $row->userid; ?>">
												<i class="fa fa-times"></i>
											</button>
										</td>
									</tr>
									<?php
									}
		                    		?>
		                    	</tbody>
		                    </table>
                    	</div>
                    </div>
                </section>
            </div>
        </div>
        
        <div class="row" id="entryDetails" <?php echo $displayblock; ?>>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        User Form
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:void(0);"></a>
                            <a class="fa fa-times" href="javascript:void(0);"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" id="entryForm">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">
                                    	User Name <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input class="form-control" id="userName" name="userName" type="text" value="<?php echo $userName; ?>" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">
                                    	User Email <span style="color: red;">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input class="form-control" id="userEmail" name="userEmail" type="email" value="<?php echo $userEmail; ?>" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit">
                                        	Save
                                        </button>
                                        <button class="btn btn-default resetBtn" type="button">
                                        	Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<script>
	
	$(document).ready(function()
	{
		$("#dataTable").dataTable();
	});
	
	$(".newEntry").click(function()
	{
		$("#listDetails").css('display', 'none');
		$("#entryDetails").css('display', 'block');
	});
	
	$("#entryForm").submit(function(e)
	{
		e.preventDefault();
		
		$("#entryForm").validate();
		
		var userId = '<?php echo $entryId; ?>';
		var userName = $("#userName").val();
		var userEmail = $("#userEmail").val();
		
		if(userName != "" && userEmail != "")
		{
			var req = new Request();
			req.data = 
			{
				"userId" : userId, 
				"userName" : userName, 
				"userEmail" : userEmail
			};
			req.url = "user/saveUser";
			RequestHandler(req, showResponse);
		}
		else
		{
			alert('Please select User Permissions.');
			return;
		}
	});
	
	$(".editEntry").click(function()
	{
		var entryId = $(this).attr('entryId');
		if(entryId > 0)
		{
			location.href = '<?php echo base_url(); ?>user/users/'+entryId;
		}
	});
	
	$(".delEntry").click(function()
	{
		var entryId = $(this).attr('entryId');
		if(entryId > 0)
		{
			var bool = confirm("Are You Sure Want To Remove This User?");
			if(bool)
			{
				var req = new Request();
				req.data = 
				{
					"entryId" : entryId, 
					"tableName" : "users", 
					"columnName" : "userid"
				};
				req.url = "user/delEntry";
				RequestHandler(req, showResponse);
			}
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
				location.href = '<?php echo base_url(); ?>user/users';
			}, 1000);
		}
	}
	
	$(".resetBtn").click(function()
	{
		location.href = '<?php echo base_url(); ?>user/users';
	});
	
</script>