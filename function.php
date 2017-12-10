<!DOCTYPE html>
<html>
<head>
	<title>Function here</title>

	<!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
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

		<!-- Add Event Modal -->
    <div class="modal fade" id="popUpWindow">
    	<div class="modal-dialog pt-5" style="margin-top: 150px;">
    		<div class="modal-content">
    			<div class="panel-heading modal-header bg-primary">
    				<h4 class="modal-title text-center">Add New Event</h4>
            	</div>
            	<br>
            	<div class="modal-body">
        			<form class="form-horizontal" action="" method="post">
        					<label>Event Information</label>
                            
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="" type="" class="form-control" placeholder="Event" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="" type="text" class="form-control" placeholder="Organization" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="" type="text" class="form-control" placeholder="Organizer" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="" type="number" class="form-control" placeholder="Contact Number" value="" required="">
                                </div>
                            </div>
                            	
                            <label>[SCHEDULE]</label>
                            <div class="form-group">
                                <div class="col-md-8">
                                	<label>Start</label>
                                    <input name="" type="time" class="form-control" placeholder="Start" value="12:00" required="">

                                    <label>End</label>
                                    <input name="" type="time" class="form-control" placeholder="End" value="12:00" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 offset-4">
                                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                    </form>
      			</div>
            	<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      			</div>
    		</div>
    	</div>
    </div>
	
	    <div class="col-md-10 offset-1">
	            <div class="panel-body">
	                <div class="panel-group" id="accordion">
						<div class="panel">
	                        <div class="panel-heading p-5" style="background-color: #333b44;">
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
				                            		<input class="btn btn-circle btn-primary" type="button" value="View" onclick="document.getElementById('id02').style.display='block'"></input>
				                            		<input class="btn btn-circle btn-success" type="button" value="Edit" onclick="document.getElementById('id01').style.display='block'"></input>
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


	<!-- Modal content-->

  <div id="id01" class="modal">
    <div class="modal-dialog pt-5">
    		<div class="modal-content">
    			<div class="panel-heading modal-header bg-success text-white">
    				<h4 class="modal-title text-center">Edit Event</h4>
            	</div>
            	<br>
            	<div class="modal-body">
        			<form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="" type="" class="form-control" placeholder="Event" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                	<label>Start</label>
                                    <input name="" type="time" class="form-control" placeholder="Start" value="12:00" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                	<label>End</label>
                                    <input name="" type="time" class="form-control" placeholder="End" value="12:00" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 offset-2">
                                    <button type="submit" name="submit" value="Submit" class="btn btn-success">
                                        Edit
                                    </button>
                                </div>
                            </div>
                    </form>
      			</div>
            	<div class="modal-footer">
        			<button onclick="document.getElementById('id01').style.display='none'" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      			</div>
    		</div>
    	</div>
      </div>


      	<!-- Modal content-->

  <div id="id02" class="modal">
    <div class="modal-dialog pt-5">
    		<div class="modal-content">
    			<div class="panel-heading modal-header bg-primary">
    				<h4 class="modal-title text-center">View Details</h4>
            	</div>
            	<div class="modal-body">
        			<form class="form-horizontal" action="" method="post">
        				<label for="idnum">IdNum</label>
                        <input id="idnum" type="" class="form-control" placeholder="Organization" value="1" readonly>
                                
                        <label>Organization</label>
                        <input name="" type="" class="form-control" placeholder="Organization" value="DevCon Philippines" readonly>

                        <label>Name</label>
                        <input name="" type="" class="form-control" placeholder="Name" value="Mr. Right Chu" readonly="">

                        <label>Contact</label>
                        <input name="" type="number" class="form-control" placeholder="Contact number" value="09134568932" readonly="">
                                
                        <label>Event</label>
                        <input name="" type="" class="form-control" placeholder="Event" value="DevCon Summit 2017" readonly="">
                                
                        <label>Start</label>
                        <input name="" type="time" class="form-control" placeholder="Start" value="10:45" readonly="">
                                
                        <label>End</label>
                        <input name="" type="time" class="form-control" placeholder="End" value="11:30" readonly="">
                                
                    </form>
      			</div>
            	<div class="modal-footer">
        			<button onclick="document.getElementById('id02').style.display='none'" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      			</div>
    		</div>
    	</div>
      </div>

        
    </div>
  </div>

	    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>