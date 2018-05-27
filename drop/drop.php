 <?php   
       include_once '../class/config.php';
       $id = $_GET['id'];
	   $name = $_GET['name'];
	   $phone = $_GET['phone'];
            
            $sql = "DELETE FROM user_control WHERE id = '$id' and name = '$name' and phone = '$phone'" ;
            
            $retval = mysql_query($sql);
            
            if(! $retval ) {
             echo "<script>location='../view_member_data.php?sk=1'</script>";
            }
			else{  
			    echo "<script>location='../view_member_data.php?sk=2'</script>";
			
			}
			
		 
		 ?>