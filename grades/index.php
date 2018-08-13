<?php
	error_reporting(E_ALL);
	require("db.php");
	
	$subjectdetails = "";
	$students = null;
	$disable_fields = "";
	
	
	if(isset($_POST["btnSearch"]))
	{
		$subject = $_POST["subject"];
		$selected_subject = DB::transact_db("select
																					*
																				  from	
																					subjects
																		where
																				edpcode = ?
																", array($subject), "SELECT");	
																
																
																
		if(count($selected_subject) > 0)
		{
			//get only the first record
			$selected_subject = $selected_subject[0];
			$subjectdetails = "{$selected_subject["subject"]} - {$selected_subject["schedule"]} {$selected_subject["days"]}";
			
			$students = DB::transact_db("select
																st.idno,
																st.lastname,
																st.firstname,
																st.mi,
																st.courseyr,
																su.edpcode,
																su.subject,
																g.midtermgrade,
																g.finalgrade
															from
																grades g inner join students st
																	on g.idno = st.idno
																			inner join subjects su
																	on g.edpcode = su.edpcode
															where
																g.edpcode = ?
										", array($subject), "SELECT");		

			if(count($students) > 0)
			{
				$disable_fields = "disabled='true'";
			}
			
			
			
			
		
		
		}
		
	
	}
	
	
	if(isset($_POST["btnSave"]))
				{
				
				
				$mg=array();
				$mg = count($_POST['midtermgrades']);
				$fg=array();
				$fg = count($_POST['finalgrades']);
				$studid=array();
				$studid = count($_POST['studid']);
				$subcode=array();
				$subcode = count($_POST['edcode']);
				
				
				for($i=0;$i<$studid;$i++)
								{
								
										$up_id=$_POST['studid'][$i];
										$up_edp=$_POST['edcode'][$i];
										$mgs = $_POST['midtermgrades'][$i];
										$fgs = $_POST['finalgrades'][$i];
										
										
										$selected = DB::transact_db("UPDATE grades set midtermgrade = ?, finalgrade = ?
																		WHERE idno = ? and edpcode = ?
																			
																", array($mgs,$fgs,$up_id,$up_edp), "UPDATE");	
										
									
		

									   
								
								
				
				
				
				
				}
	
	}
	
?>
<html>
	<head>
		<title>Grades</title>
	</head>
	<body>
		<form method="post" action="index.php">
			Select Subject: 
		<?php
			$subjects = DB::transact_db("select
															*
														  from	
															subjects
										", array(), "SELECT");
			
			if(count($subjects) > 0)
			{
				echo "<select name='subject' style='font-family: courier; font-size: 11px;' {$disable_fields}>";
				foreach($subjects as $sub)
				{
					echo "<option value='{$sub["edpcode"]}'>{$sub["edpcode"]} - {$sub["subject"]} </option>";
				}				
				echo "</select>";				
			}
			else 
			{
				echo "<br />";
				echo "No records found.";
			}
		?>
		<input type="submit" value="Search" name="btnSearch" <?php echo $disable_fields; ?> />
		<br />
		<?php
			echo $subjectdetails;
			echo "<br />";
			if(count($students) > 0)
			{
				echo "<table>";
				echo "	<thead>";
				echo "			<tr>";
				echo "				<td>I.D. No.</td>";
				echo "				<td>Name</td>";
				echo "				<td>Course & Yr</td>";
				echo "				<td>Midterm Grade</td>";
				echo "				<td>Final Grade</td>";
				echo "			</tr>";
				echo "	</thead>";
				echo "	<tbody>";
				foreach($students as $stud)
				{
					echo "<tr>";
						echo "<td>{$stud["idno"]}</td>";
						echo "<td>{$stud["lastname"]}, {$stud["firstname"]} {$stud["mi"]}.</td>";
						echo "<td>{$stud["courseyr"]}</td>";
						echo "<td>";
						echo "		<input type='text' name='midtermgrades[]' value='{$stud["midtermgrade"]}' size='3' required/>";
						echo "</td>";
						echo "<td>";
						echo "		<input type='text' name='finalgrades[]' value='{$stud["finalgrade"]}' size='3' required/>";
						echo "</td>";		
						echo "		<td align='center'>
										<input type='hidden'   name='studid[]' value='".$stud["idno"]."' />
									</td>";
									
						echo "		<td align='center'>
										<input type='hidden'   name='edcode[]' value='".$stud["edpcode"]."' />
									</td>";
					echo "</tr>";
				}
				
				echo "	</tbody>";
				echo "</table>";			
				echo "<input type='submit' name='btnSave' value='Save' />";
			}
		?>
		
		
		</form>
<button id="aw">aw</button>
	</body>
		<script type="text/javascript" src="jquery.js" ></script>
	<script type="text/javascript" >

	</script>
</html>