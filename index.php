<?php
	error_reporting(E_ALL);
	require("db.php");
	$name  = "";
	$address = "";
	$contactno = "";
	
	if(isset($_POST["btnsubmit"]))
	{
		$name = trim($_POST["txtname"]);
		$address = trim($_POST["txtaddress"]);
		$contactno = trim($_POST["txtcontno"]);	
		
		if($name != "")
		{
		    $contacts = DB::transact_db("SELECT * from contacts where name = ?
										", array($name), "SELECT");
		      if(count($contacts) > 0)
			  {
			     
			    echo "ALready Exist!"; 
			  }
			  else
			  {
			  $contacts = DB::transact_db("insert into contacts (name,address,contactno)  values(?,?,?)
										", array($name,$address,$contactno), "INSERT");
			  
			  
			  }
		
		
		
		}
		
		
		
		
		
		
		
		
	}
	
		if(isset($_POST['btndelete']))
			{
		
			     
			   if(isset($_POST['contacts']))
			   {
							$cnt=array();

							$cnt=count($_POST['contacts']);
							for($i=0;$i<$cnt;$i++)
								{
										$del_id=$_POST['contacts'][$i];
										
                                    try{
										$employee = DB::transact_db("delete from contacts where id = ?", 
										array($del_id), 
										"DELETE");
										
										
										}
		

									   catch(Exception $e) 
									   {
											echo "No records Selected!!";
											
									}
										
								}
	
						
				}
		 
								else
		 
								{
		 
								echo "No records Selected!!";
		 
		 
								}
			 
			echo "Deleted Successfully";
			}
	
	
	
?>





<html>
	<head>
		<title>Phonebook</title>
	</head>
	<body>
		<form method="post" action="index.php">
			Name: <br />
			<input type="text" name="txtname" size="50" value="<?php echo $name; ?>" required="required" /> <br /><br />
			Address: <br />
			<input type="text" name="txtaddress" size="50" value="<?php echo $address; ?>" required="required" /> <br /><br />	
			Contact No.: <br />
			<input type="text" name="txtcontno" size="20" value="<?php echo $contactno; ?>" required="required" /> <br /><br />			
			<input type="submit" name="btnsubmit" value="Submit" />
		</form>
		<?php
			$contacts = DB::transact_db("select	*  from	contacts ORDER BY id DESC
															
										", array(), "SELECT");
			
			if(count($contacts) > 0)
			{
			echo "<form method = post >";
			echo "<input type='submit' name='btndelete' value='Delete' />";
				echo "<table border='1'>";
				echo "	<thead>";
				echo "		<tr>";
				echo "			<th>Name</th>";
				echo "			<th>Address</th>";
				echo "			<th>Contact No.</th>";
				echo "			<th ><a href='#' class='selectall'>Select All</a><a href='#' class='deselect'>Deselect All</a></th>";
				echo "		</tr>";
				echo "	</thead>";
				echo "	<tbody>";
				foreach($contacts as $cont)
				{
					echo "<tr>";
					echo "		<td>".$cont["name"]."</td>";
					echo "		<td>".$cont["address"]."</td>";
					echo "		<td>".$cont["contactno"]."</td>";
					echo "		<td align='center'>
										<input type='checkbox'  class='box' name='contacts[]' value='".$cont["id"]."' />
									</td>";
					echo "</tr>";
					echo "</tr>";
				}
				echo "	</tbody>";
				echo "</table>";
				echo "</form>";
			}
			else 
			{
				echo "<br />";
				echo "No records found.";
			}
		?>
	</body>
	<script src="jquery-3.3.1.min.js" ></script>
	
	
	
	
	
	<script type="text/javascript" >
	
	$(document).ready(function(){
	 $('.deselect').hide();
	      $(".selectall").click(function(){
		      $('.box').prop('checked', true);
		      
		      
		       $('.selectall').hide();
			   $('.deselect').show();
		  
		  });
	    
	     $(".deselect").click(function(){
		      $('.box').prop('checked', false);
		      
		      
		       $('.selectall').show();
			   $('.deselect').hide();
		  
		  });
	
	
	
	
	
	
	
	
	
	});
	
	
	
	</script>
</html>