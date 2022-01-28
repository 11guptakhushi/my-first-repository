<?php
	include('../includes/dbconnect.php');
?>
<head>
	<title>Manage Cuisine</title>
	<link rel="stylesheet" href="admin.css" type="text/css" />
</head>
<body>
<form method="post" name="select_rest">
	<div class="card">
		<div class="rest_form_group">
			<h3>1. Select City</h3>
			<select name="city_name">
				<option hidden value="select">Select City</option>
			<?php	
				$sql="SELECT DISTINCT rest_city FROM restaurants";
				$f=$conn->query($sql);
				if($f->num_rows>0)
				{
					while($row=$f->fetch_assoc())
					{
						echo "<option value='".$row['rest_city']."'>".$row['rest_city']."</option>";
					}
				}				
			?>
			</select>
		</div>
		<input type="submit" class="btn" value="OK" name="city" id="manage"/>				
	</div>
	<?php
		if(isset($_POST['city']))
		{
			if($_POST['city_name']=="select")
			{
				echo "<script>alert('Select city of the restaurant');</script>";
			}				
			else
			{
				echo '<div class="card">
				<div class="form_group">
					<h3>2. Delete Restaurant</h3>
					<b><label>Restaurant Name</label></b>
					<select name="restaurant">
						<option hidden value="select">Select Restaurant</option>';
					
						$city=str_replace(' ','',$_POST['city_name']);

						$sql="SELECT rest_name FROM restaurants WHERE rest_city='$city'";
						$f=$conn->query($sql);
						if($f->num_rows>0)
						{
							while($row=$f->fetch_assoc())
							{
								echo "<option value='".$row['rest_name']."'>".$row['rest_name']."</option>";
							}
						}
				echo '</select>	
					<input type="submit" class="btn" value="Delete Restaurant" name="delete_rest" id="delete"/>
				</div>
				</div>';
			}
		}
		if(isset($_POST['delete_rest']))
		{
			$rest_name=$_POST['restaurant'];
			$restname=str_replace(' ','',$rest_name);
			if($rest_name=="select")
			{
				echo "<script>alert('Select cuisine type to be deleted.');</script>";
			}
			else
			{
				$delrestname="DELETE FROM restaurants where rest_name='$rest_name'";
				$delrest="DROP TABLE IF EXISTS $restname";
				if($conn->query($delrestname)==true and $conn->query($delrest)==true)
				{
					echo "<script>alert('Restaurant is deleted.');</script>";
				}
				else
				{
					echo "<script>alert('Error in deletion');</script>";
				}
			}
		}
	?>
	</form>						
</body>
</html>	
