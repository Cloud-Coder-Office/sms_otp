<?php require_once ('Database.php');   ?>

<?php 

if(isset($_GET['submit']))
		{
 $yourString   = $_GET['msg'];
 

 
 //$msg = preg_replace("/(\r?\n){2,}/", "\n\n", $yourString);
			
 //$msg = preg_replace( "/\s+/", "+", $yourString );
 

 $flag = false;
 

	 
 $sql = "SELECT incomming_string, outgoing_string, status FROM otp_string WHERE status ='1'";
 
 $query = mysql_query($sql) or die (mysql_error());
 

	 
 While($row = mysql_fetch_assoc($query)){
	 
	 $incomming_string = $row['incomming_string'];
	 $outgoing_string  = $row['outgoing_string'];
	 
	 
	

	if( strpos( $yourString, $incomming_string ) !== false ) {
		
		$newMsg =  str_replace($incomming_string,$outgoing_string,$yourString);
		echo $newMsg;
	}
		 
 }
 
 
             /* if($flag){
			   echo $newMsg;
			  
		      }
              
			  else 
				 {
				  echo "Not match"; 
				 }  */
	 
 
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