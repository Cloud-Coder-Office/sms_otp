<?php require_once ('Database.php');   ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Send SMS</title>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<div  class="row col-md-offset-0">
<?php 

if(isset($_GET['submit']))
		{
$yourString   = strtoupper($_GET['msg']);
 

 
 //$msg = preg_replace("/(\r?\n){2,}/", "\n\n", $yourString);
			
 //$msg = preg_replace( "/\s+/", "+", $yourString );
 

 $flag = false;
 

	 
 $sql = "SELECT incomming_string, outgoing_string, status FROM otp_string WHERE status ='1'";
 
 $query = mysql_query($sql) or die (mysql_error());
 

	 
 While($row = mysql_fetch_assoc($query)){
	 
	   $incomming_string = $row['incomming_string'];
	   $outgoing_string  = $row['outgoing_string'];
	 
	 
	

	if( strpos( $yourString, $incomming_string ) !== false ) {
	
		  $flag = true;
		  $message = explode(',', $outgoing_string);
		  $list = list($first_string,$second_string) = $message;
		  //echo $first_string;
		  echo "<br>";
		  //echo $second_string;
		  shuffle($message);
		  print_r ($message);
		  echo "<br>";
		  $msg = $message['0'];
		  echo $msg;
		  //print_r($message);
		  $yourString =  str_replace("G-"," ",$yourString);
		  $Msg    =  str_replace($incomming_string ,$outgoing_string,$yourString);
		 //echo $Msg;
		
	}
	 
 }
 
  	
           if($flag){
			   //echo $Msg;
			  
		      }
              
			  else 
				 {
				  echo "Not match"; 
				 }  
	 
 
}
?>
<form id="sms_sender" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="form-horizontal">
<div class="form-group">
						<label for="msg" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-6">
							<input name="msg" type="text" class="form-control" id="msg" placeholder="Message">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-6">
							<input type="submit" name="submit" class="btn btn-success btn-block" value="Submit">
						</div>
					</div>
					</form>	
					
					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<!-- Latest compiled and minified JavaScript -->
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	
    </body>
    </html>