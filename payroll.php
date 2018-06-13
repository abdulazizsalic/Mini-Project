<?php
$message="";
	require_once('connect.php');

	if(isset($_POST['btn']))
	{
		$fname = $_POST['first'];
		$lname = $_POST['last'];
		$mname = $_POST['mid'];
		$address = $_POST['add'];
		$phone = $_POST['num'];
		$email = $_POST['email'];

		if(!empty($fname))
		{
			try{

				$stmt= $con->prepare("INSERT INTO payrolls.emplyee( Firstname, Lastname, Middlename, Address, Phone, Email) 
											VALUES(:fname, :lname, :mname, :address, :phone, :email)");
				$stmt->execute(array(':fname'=>$fname, ':lname'=>$lname, ':mname'=>$mname, ':address'=>$address, ':phone'=>$phone, ':email'=>$email));

				header('Location:payroll.php');
             

			}catch(PDOException $ex){

				echo $ex->getMessage();
			}
        
		}
		else
		{
			 $message="Incomplete Inputs!!!";
			 echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Payroll</title>


</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/myjs.js"></script>

</head>
<body>

<center><h1>Payroll</h1>

<div id="wrapper">
	<h3>Add Employee</h3>
	<form  method = "POST">

		<table cellpadding="5px">
			<tr>
		
   	  
 	  <td><input type="text" class="form-control" name="first" placeholder="Firstname" required autofocus></td>
 	
 </tr>
 <tr>
	 
	  <td><input type="text" class="form-control" name="last" placeholder="Lastname" required></td>
	  
	 </tr> 
	 <tr>
	  
	  <td><input type="text" class="form-control" name="mid" placeholder="Middlename"></td>
	</tr>
	<tr>
	  
	  <td><input type="text" class="form-control"  name="add" placeholder="Address" required></td>
	</tr>
	<tr>
	 
	  <td><input type="text" class="form-control" name="num" placeholder="Phone Number" required></td>
	</tr>
	<tr>
	
	  <td><input type="text" class="form-control"  name="email" placeholder="Email" required><br><br></td>
	</tr>
	<tr>
	
		<td><button type="submit" class = "btn btn-info form-control"  name = "btn" > add </button></td>

			
	
	</tr>
	
</table>
	</form>






<div>
	<h3>Employee List</h3>
	<table class="table table-stripped" border="4">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Middlename</th>
  	<th>Address</th>
  	<th>Phone</th>
  	<th>Mail</th>
  	<th>Action</th>
  </tr>
  <?php
  	$stmt = $con->prepare("SELECT * FROM payrolls.emplyee");
  	$stmt->execute();
  	$results = $stmt->fetchAll();
  	foreach ($results as $row) {
  ?>
  <tr>
  	<td><?=$row['Firstname'];?></td>
  	<td><?=$row['Lastname'];?></td>
  	<td><?=$row['Middlename'];?></td>
  	<td><?=$row['Address'];?></td>
  	<td><?=$row['Phone'];?></td>
  	<td><?=$row['Email'];?></td>
  	<td>
  		<a href="edit.php?id=<?=$row['Emp_no'];?>" ><button class="button">Edit</button></a>
  	<a href="delete.php?id=<?=$row['Emp_no'];?>" onClick="return confirm('Confirm Delete')">	<button class="button">Delete</button></a>
  		
  	</td>

  </tr>
<?php
}
?>
</table>
</div>
</div>


</body>
</html>