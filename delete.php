<?php

	require_once('connect.php');
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		try{
			$stmt = $con->prepare("DELETE FROM payrolls.emplyee WHERE Emp_no = ?");
			$stmt->execute(array($id));
			header('Location:payroll.php');
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}

?>