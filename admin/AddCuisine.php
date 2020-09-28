<?php
	session_start();
	include '../includes/dbconnect.php';
?>
<html>
<head>
	<title>Manage Restaurant</title>
	<link rel="stylesheet" href="admin.css" type="text/css" />
</head>
<body>
	<form method="post">
	<div class="card">
		<div class="rest_form_group">
			<h3>1. Select Restaurant Name</h3>
			<select name="restaurant">
				<option hidden value="select">Select Restaurant</option>
			<?php	
				$sql="SELECT * FROM restaurants";
				$f=$conn->query($sql);
				if($f->num_rows>0)
				{
					while($row=$f->fetch_assoc())
					{
						echo "<option value='".$row['rest_name']."'>".$row['rest_name']."</option>";
					}
				}
			?>
			</select>
		</div>
		<input type="submit" class="btn" value="Manage Restaurant" name="manage" id="manage"/>
	</div>
	<div class="card">
	<h3>2. Add a Cuisine</h3>
		<div class="form-group">
			<label>Cuisine Name</label>
			<input type="text" name="dish" class="form-control"value="<?php echo $_POST["dish"];	?>" >
		</div>
		<div class="form-group">
			<label>Cuisine Type</label>
			<input type="text" name="type" class="form-control"value="<?php echo $_POST["type"];	?>">
		</div>
		<div class="form-group">
			<label>Cuisine Cost</label>
			<input type="integer" name="cost" class="form-control"value="<?php echo $_POST["cost"];	?>" >
		</div>
		<div class="form-group">
			<label>Cuisine Details(if any)</label>
			<input type="integer" name="details" class="form-control"value="<?php echo $_POST["details"];	?>" >
		</div>
		<input type="submit" class="btn" value="Add it" name="addcuisine" id="addcuisine">
	 </div>
	</form>
		
</body>
</html>
<?php
	if(isset($_POST['manage']))
	{
		if($_POST['restaurant']=="select")
		{
			echo "<script>alert('Select Restaurant to manage.');</script>";
		}				
		else
		{
			$rest_name=$_POST['restaurant'];
			$_SESSION['rest_name']=$rest_name;
		}
	}

	if(isset($_POST['addcuisine']))
	{
		if(empty($_POST['dish']))
		{
			echo "<script>alert('Cuisine Name is required.');</script>";
			die();
		}
		if(!preg_match('/^[a-zA-Z ]+$/',$_POST['dish']))
		{
			echo "<script> alert('Cuisine Name can contain only letters.'); </script>";
			die();
		}
		if(empty($_POST['type']))
		{
			echo "<script>alert('Cuisine Type is required.');</script>";
			die();
		}
		if(!preg_match('/^[a-zA-Z ]+$/',$_POST['type']))
		{
			echo "<script> alert('Cuisine Type can contain only letters.'); </script>";
			die();
		}
		if(empty($_POST['cost']))
		{
			echo "<script>alert('Cuisine cost is required.');</script>";
			die();
		}
		if(!preg_match('/^[0-9]+$/',$_POST['cost']))
		{
			echo "<script> alert('Cuisine cost can contain only numbers.'); </script>";
			die();
		}
		
		$cuisinename = $_POST['dish'];
		$type = $_POST['type'];
		$cost = $_POST['cost'];
		$detail = $_POST['details'];
		$restname=str_replace(' ','',$_SESSION['rest_name']);

		$findDish = 'SELECT * from $restname';
		$dishes= $conn->query($findDish);
		if($dishes->num_rows>0)
		{
			while($row=$dishes->fetch_assoc())
			{
				if($row['type']==$type && $row['cost']==$cost)
				{
					echo "<script>alert('This cuisine type is already registered with the specified cost.')</script>";
				}
				else
				{
					$insertdish = "INSERT into $restname(cuisine,type,cost,detail) values ('$cuisinename','$type','$cost','$detail')";
					if($conn->query($insertdish)==true)
					{
						echo "<script>alert('Cuisine Type is inserted.');</script>";
					}
					else
					{
						echo  "<script>alert('Error in insertion.');</script>";
					}
				}
			}
		}
		else
		{
			$insertdish = "INSERT into $restname(cuisine,type,cost,detail) values ('$cuisinename','$type','$cost','$detail')";
			if($conn->query($insertdish)==true)
			{
				echo "<script>alert('Cuisine Type is inserted.');</script>";
			}
			else
			{
				echo  "<script>alert('Error in insertion.');</script>";
			}
		}				
	}
?>