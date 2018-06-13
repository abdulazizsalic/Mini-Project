<?php

	require_once('connect.php');

	if(isset($_POST['btn']))
	{
		$id = $_POST['txt_id'];
		$fname = $_POST['first'];
		$lname = $_POST['last'];
		$mname = $_POST['mid'];
		$address = $_POST['add'];
		$phone = $_POST['num'];
		$email = $_POST['email'];

		if(!empty($fname))
		{
			try{

				$stmt= $con->prepare("UPDATE payrolls.emplyee set Firstname = :fname,
																 Lastname = :lname,
																 Middlename = :mname,
																 Address = :address,
																 Phone = :phone,
																 Email = :email
									  WHERE Emp_no = :id
																			 ");
				$stmt->execute(array(':fname'=>$fname, ':lname'=>$lname, ':mname'=>$mname, ':address'=>$address, ':phone'=>$phone, ':email'=>$email,    				':id'=>$id));

				if($stmt){
					header('Location:payroll.php');
				}

			}catch(PDOException $ex){

				echo $ex->getMessage();
			}
		}
		else
		{
			echo "Input Firstname";
		}


	}

	$emp_no = 0;
		$fname = "";
		$lname = "";
		$mname = "";
		$address = "";
		$phone = 0;
		$email = "";

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$stmt = $con->prepare('SELECT * FROM payrolls.emplyee WHERE Emp_no = :id');
			$stmt->execute(array(':id'=>$id));
			$row = $stmt->fetch();
			$emp_no = $row['Emp_no'];
			$fname = $row['Firstname'];
			$lname = $row['Lastname'];
			$mname = $row['Middlename'];
			$address = $row['Address'];
			$phone = $row['Phone'];
			$email = $row['Email'];
		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Payroll</title>

<style>


</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/myjs.js"></script>
</head>
<body>
<center><h1>Payroll</h1>


<div id="wrapper">
	<h3>Edit Employee</h3>
	<form action = "" method = "post">
		<table cellpadding="5px">
			<tr>
		
   	 
 	  <td><input type="text" class="form-control" name="first" value="<?=$fname;?>" required></td>
 	
 </tr>
 <tr>
	  
	  <td><input class="form-control" type="text" name="last" value="<?=$lname;?>" required></td>
	  
	 </tr> 
	 <tr>
	  
	  <td><input class="form-control" type="text" name="mid" value="<?=$mname;?>"></td>
	</tr>
	<tr>
	  
	  <td><input class="form-control" type="text" name="add" value="<?=$address;?>" required></td>
	</tr>
	<tr>
	
	  <td><input class="form-control" type="text" name="num" value="<?=$phone;?>" required></td>
	</tr>
	<tr>
	 
	  <td><input class="form-control" type="text" name="email" value="<?=$email;?>" required><br><br></td>
	</tr>
	
		 <td><input type="hidden" name="txt_id" value="<?=$emp_no;?>"></td>
	
	<tr>
		
		<td>
			<button type="submit" class = "btn btn-success form-control" name = "btn">Save</button>
			<hr>
			<button type="button" class = "btn btn-info form-control"  onclick="window.location.href='payroll.php'" >Back</button>
		</td>

	</tr>
	
</table>
	</form>

<br>
<br>
<br>





</div>
</body>
</html>