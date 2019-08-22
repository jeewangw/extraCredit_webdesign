
<!DOCTYPE html>
<html>
<head>
	<title>Extra Credit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


</head>
<body >
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
   <a class="navbar-brand" href="#ContactMe">
    Sumit Neupane
  </a>

</nav>
	
 <section id="howto" class="bg-primary text-center">
  <article class="py-2">
    <div>
     <h3 class="display-4 text-white">
      Search Student Info
     </h3>  
  </div>
  </article>
 </section>
	
<!-- STUDENT NAME FORM-->
	<div class="row ml-1">
    <div class="col-lg-6 col-md-6 col-12" ><h4>Search Details</h4> <hr>
	<form  method="post" >
    	<div class="form-group">
          <label for="code">First Name:</label>
          <input type="text" name="FName" class="form-control w-25 " id="FName" autocomplete="off" required >
        </div>
         <div class="form-group">
          <label for="code">Last Name:</label>
          <input type="text" name="LName" class="form-control w-25 " id="LName" autocomplete="off" required >
        </div>

        <button name="ASubmit" type="submit" class="btn btn-primary">Search Info</button> 
    </form>
	</div>
	
	<div class="col-lg-6 col-md-6 col-12" ><h4>Insert Details</h4> <hr>
	<form  method="post" >
		<div class="form-group">
          <label for="code">Student ID:</label>
          <input type="text" name="studentid" class="form-control w-25 " id="studentid" autocomplete="off" required >
        </div>
    	<div class="form-group">
          <label for="code">First Name:</label>
          <input type="text" name="first_name" class="form-control w-25 " id="first_name" autocomplete="off"  required >
        </div>
         <div class="form-group">
          <label for="code">Last Name:</label>
          <input type="text" name="last_name" class="form-control w-25 " id="last_name" autocomplete="off" required >
        </div>
		 <div class="form-group">
          <label for="code">Supervisor ID:</label>
          <input type="text" name="supervisor" class="form-control w-25 " id="supervisor" autocomplete="off" required >
        </div>
		
		
		Type Support
		<select class="form-control w-25" name="typss">
 	    <option value="gta">GTA</option>
		<option value="gra">GRA</option>
		<option value="self_support">SELF SUPPORT</option>
		<option value="scholarship_support">SCHOLARSHIP SUPPORT</option>
        </select>
		
		<br>
		
		
        <button name="ISubmit" type="submit" class="btn btn-primary">Insert</button> 
    </form>
	</div>
	
	</div>
	
	<hr w-25 mx-auto pt-5>

	
	<?php
    include("connection.php");
    if(isset($_POST["ASubmit"])){
		$f = $_POST['FName'];
		$l = $_POST['LName'];
          $q = 'SELECT * FROM `phd_student` WHERE `FName` = "'.$f.'" ';
		  $result = mysqli_query($con, $q);
			while($row = mysqli_fetch_array($result)){
			 $fname = $row['FName'];	
			 $lname = $row['LName'];
			 $StudentId = $row['StudentId'];
			 $Supervisor = $row['Supervisor'];
				
			 $q1 = 'SELECT * FROM `instructor` WHERE `InstructorId` = "'.$Supervisor.'" ';
			 $result = mysqli_query($con, $q1);
			 while($row = mysqli_fetch_array($result)){
				 $IFName = $row['FName'];
				 $ILName = $row['LName'];
			 }
			
			 $q2 = 'SELECT * FROM `milestonespassed` WHERE `StudentId` = "'.$StudentId.'" ';
			 $result = mysqli_query($con, $q2);
			 while($row = mysqli_fetch_array($result)){
				 $MId = $row['MId'];
				 $PassDate = $row['PassDate'];
			 }
			
			 $q3 = 'SELECT * FROM `milestone` WHERE `MId` = "'.$MId.'" ';
			 $result = mysqli_query($con, $q3);
			 while($row = mysqli_fetch_array($result)){
				 $MName = $row['MName'];
			 }
				$Type_Support ="";
			
			 $q4 = 'SELECT * FROM `gta` WHERE `StudentId` = "'.$StudentId.'" ';
			 $result = mysqli_query($con, $q4); 
			 if(mysqli_num_rows($result)>0){
				 $Type_Support ="GTA";
			 }
			
			$q5 = 'SELECT * FROM `gra` WHERE `StudentId` = "'.$StudentId.'" ';
			 $result = mysqli_query($con, $q5);
			 if(mysqli_num_rows($result)>0){
				 $Type_Support ="GRA";
			 }
			
			$q5 = 'SELECT * FROM `self_support` WHERE `StudentId` = "'.$StudentId.'" ';
			 $result = mysqli_query($con, $q5); 
			 if(mysqli_num_rows($result)>0){
				 $Type_Support ="SELF SUPPORT";
			 }
			
			$q6 = 'SELECT * FROM `scholarship_support` WHERE `StudentId` = "'.$StudentId.'" ';
			 $result = mysqli_query($con, $q5);
			 if(mysqli_num_rows($result)>0){
				 $Type_Support ="SCHOLARSHIP SUPPORT";
			 }
				
			  echo '<h4 class="text-center bg-primary text-white"> Name: '.$fname.'  '.$lname. ' <br> Student ID: '.$StudentId. ' <br> Supervisor ID: '.$Supervisor.' <br> Supervisor Name: '.$IFName.'  '.$ILName.' <br>
			  Milestone: '.$MId.' ('.$MName.' ) <br> PassDate: '.$PassDate.' <br>
			  Support Type: '.$Type_Support.' </h4>';
			  echo '<hr>';
			}
          
           
          }
          
    ?>

	<?php
	include("connection.php");
	if(isset($_POST["ISubmit"])){
		$studentid = $_POST['studentid'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$supervisor = $_POST['supervisor'];
		
		  if(isset($_POST["typss"])){
          $typss= $_POST["typss"];			  
          }
		 if ($typss == "gta"){
			 $q1= "INSERT INTO gta (StudentId, SectionId, MonthlyPay)  VALUES 
			('".$studentid."','','')"; 
		
		 } 
		if ($typss == "gra"){
			$q1= "INSERT INTO gra (StudentId, Funding, MonthlyPay)  VALUES 
			('".$studentid."','','')";  
		
		 } 
		if ($typss == "self_support"){
			 $q1= "INSERT INTO self_support (StudentId)  VALUES 
			('".$studentid."')"; 
	
		 } 
		if ($typss == "scholarship_support") {
			 $q1= "INSERT INTO scholarship_support (StudentId, Type, Source)  VALUES 
			('".$studentid."','','')";  
	
		 }
		
		
		 mysqli_query($con, $q1);
		
		$q= "INSERT INTO phd_student (StudentId, FName, LName, StSem, StYear, Supervisor)  VALUES 
			('".$studentid."','".$first_name."','".$last_name."','','','".$supervisor."')";
		
		if (mysqli_query($con, $q)){	
			echo"Successfully INSERTED";
		}
			
		 else {
			echo $q;
		}
	}
	
	?>
	
	
	
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
