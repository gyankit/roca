<?php 
	include("config.php");
	include("check.php");

	$sql="SHOW TABLES LIKE 'books_tbl'";
	$sr=mysqli_query($cn,$sql);

	if(mysqli_num_rows($sr)==0)
	{
		$sql1="CREATE TABLE `id8469611_clubroca`.`books_tbl` ( `id` INT(10) NOT NULL AUTO_INCREMENT , `department` VARCHAR(3) NOT NULL , `year` VARCHAR(3) NOT NULL , `semester` VARCHAR(3) NOT NULL , `code` VARCHAR(10) NOT NULL , `subject` VARCHAR(100) NOT NULL , `book` TEXT NOT NULL , `link` TEXT NOT NULL , PRIMARY KEY (`id`))";
		$sr1=mysqli_query($cn,$sql1);
		if($sr1==false)
		{
			header("location: error.php");
		}
	}

	$msg="";
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$dept=$_POST['department'];
		$year=$_POST['year'];
		$sem=$_POST['semester'];
		$code=$_POST['code'];
		$subject=$_POST['subject'];
		$link=$_POST['link'];
		
		$fil=$_FILES['fil'];
		
		if($fil=="" and $link=="")
		{
			$msg="Provide either book or book link";
		}
		elseif($link=="")
		{
			$fname=$fil['name'];
			$old=$fil['tmp_name'];
			$new="../images/books/".$fname;
			move_uploaded_file($old,$new);

			$sql="INSERT INTO books_tbl VALUES(NULL, '$dept', '$year', '$sem', '$code', '$subject', '$fname', '')";
		}
		elseif($fil=="")
		{
			$sql="INSERT INTO books_tbl VALUES(NULL, '$dept', '$year', '$sem', '$code', '$subject', '', '$link')";
		}
		else
		{
			$fname=$fil['name'];
			$old=$fil['tmp_name'];
			$new="../images/books/".$fname;
			move_uploaded_file($old,$new);
			
			$sql="INSERT INTO books_tbl VALUES(NULL, '$dept', '$year', '$sem', '$code', '$subject', '$fname', '$link')";
		}
		
		$rs=mysqli_query($cn,$sql);
		if ($rs)
		{
			$msg="Uploaded Successfully";
		}
		else
		{
			$msg="Error Occur....Try after some time...!!!";
		}
	}
?>

<html lang="en">
<head>
	<?php include("css.php"); ?>
	<title>R O C A</title>
</head>
	
<body>
	<?php include("header.php"); ?>
	
	<div class="container">
		<div class="jumbotron">
			<div class="card-title text-capitalize text-center h2">
				Add Books
			</div>
			<div class="alert text-danger text-center font-weight-bold">
				<?php echo $msg; ?>
			</div>
			<form role="form" class="form-submit" method="post" action="" enctype="multipart/form-data">
				<div class="form-group">
					<label for="Department"><strong class="admin_label text-left">Department :</strong></label>
					<select name="department" class="form-control" required>
						<option value=""><b>Select</b></option>
						<option value="CSE"><b>CSE</b></option>
						<option value="ME"><b>ME</b></option>
						<option value="IT"><b>IT</b></option>
						<option value="EE"><b>EE</b></option>
						<option value="ECE"><b>ECE</b></option>
					</select>
				</div>
				<div class="form-group">
					<label for="Year"><strong class="admin_label text-left">Year :</strong></label>
					<select name="year" class="form-control" required>
						<option value=""><b>Select</b></option>
						<option value="1st"><b>1st</b></option>
						<option value="2nd"><b>2nd</b></option>
						<option value="3rd"><b>3rd</b></option>
						<option value="4th"><b>4th</b></option>
					</select>
				</div>
				<div class="form-group">
					<label for="Semester"><strong class="admin_label text-left">Semester :</strong></label>
					<select name="semester" class="form-control" required>
						<option value=""><b>Select</b></option>
						<option value="1st"><b>1st</b></option>
						<option value="2nd"><b>2nd</b></option>
						<option value="3rd"><b>3rd</b></option>
						<option value="4th"><b>4th</b></option>
						<option value="5th"><b>5th</b></option>
						<option value="6th"><b>6th</b></option>
						<option value="7th"><b>7th</b></option>
						<option value="8th"><b>8th</b></option>
					</select>
				</div>
				<div class="form-group">
					<label for="Subjectcode"><strong class="admin_label text-left">Subject Code :</strong></label>
					<input type="text" class="form-control" name="code" placeholder="Subject Code" required>
				</div>
				<div class="form-group">
					<label for="Subject"><strong class="admin_label text-left">Subject :</strong></label>
					<input type="text" class="form-control" name="subject" placeholder="Subject" required>
				</div>
				<div class="form-group">
					<label for="Material"><strong class="admin_label text-left">Books :</strong></label>
					<input type="file" name="fil" class="form-control-file" accept="application/*">
				</div>
				<div class="form-group">
					<label for="Link"><strong class="admin_label text-left">Book's Link :</strong></label>
					<input type="text" class="form-control" name="link" placeholder="Link of Books">
				</div>
				<button class="btn btn-info btn-lg">Submit</button>
			</form>
		</div>
	</div>
	<?php include("javascript.php"); ?>
</body>
</html>