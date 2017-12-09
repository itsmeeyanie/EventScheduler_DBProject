<!DOCTYPE html>
<html>
<head>
	<title>Function here</title>

	<!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/font-awesome.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />

</head>
<body>
	<!-- /. ROW  -->
	<div class="pt-5 offset-2">
		<a href="#" onclick="history.go(-1)">
			<button class="btn btn-default">Back</button>
		</a>
	</div>

	<div class="container navbar-default p-5">
		<div class="col-md-3 offset-2" style="float: right;">
			<button class="btn btn-primary" data-toggle="modal" data-target="#popUpWindow">+ Add Event</button>
		</div>

    <div class="modal fade" id="popUpWindow">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="panel-heading modal-header">
            		<button type="button" class="btn btn-default close" data-dismiss="modal">&times;</button>
            		<br>
            		<form>
            			
            		</form>
                </div>
    		</div>
    	</div>
    </div>
	
	    <div class="col-md-10 offset-1">
	            <div class="panel-body">
	                <div class="panel-group" id="accordion">
						<div class="panel">
	                        <div class="panel-heading p-5" style="background-color: #17a2b8;">
	                        </div>
	            
	                <div class="panel-body">
	                    <div class="panel panel-default">
	                     <div class="panel-body">
	                        <div class="table-responsive">
	                        	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	                            <thead>
	                                        <tr>
	                                        	<th width="5%">#</th>
	                                            <th width="25%">Time</th>
	                                            <th width="40%">Event</th>
												<th width="25%">Action</th>
												
	                                        </tr>
	                                    </thead>
			                            <tbody class="text-center"> 
			                            	<tr> 
				                            	<td>1</td>
				                            	<td>10:45 - 11:30</td>  
				                            	<td>Meeting!</td>   
				                            	<td>
				                            		<input class="btn btn-circle btn-primary" type="button" value="View"></input>
				                            		<input class="btn btn-circle btn-success" type="button" value="Edit"></input>
				                            		<input class="btn btn-circle btn-danger" type="button" value="Delete"></input>
				                            	</td>  
			                            	</tr> 
			                            </tbody>
		                    </table>	
	                    </div>
	                </div>
	            </div>
			</div>
	    </div>
	</div>
</body>
</html>