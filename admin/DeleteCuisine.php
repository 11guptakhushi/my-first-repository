<?php
	include('../includes/dbconnect.php');
?>
<head>
	<title>Manage Restaurant</title>
	<link rel="stylesheet" href="admin.css" type="text/css" />
</head>
<body>
<form method="post" name="select_rest">
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
			}
		}
	?>
	<div class="card">
		<div class="form_group">
			<h3>2. Delete Cuisine</h3>
			<b><label>Cuisine Name</label></b>
			<select name="cuisine">
				<option hidden value="select">Select Cuisine</option>
			<?php	
				$restname=str_replace(' ','',$rest_name);
				
				$sql="SELECT DISTINCT cuisine FROM $restname";
				$f=$conn->query($sql);
				if($f->num_rows>0)
				{
					while($row=$f->fetch_assoc())
					{
						echo "<option value='".$row['cuisine']."'>".$row['cuisine']."</option>";
					}
				}
		echo '</select>	
			<input type="hidden" name="rest_name" value="'.$restname.'"/>
			<input type="submit" class="btn" value="Manage Cuisine" name="delete_cuisine" id="delete"/><br><br>
		</div>';
		
				$cuisine=isset($_POST['cuisine']) ? $_POST['cuisine'] : "";
				$restname=isset($_POST['rest_name']) ? $_POST['rest_name'] : "";				

				if(isset($_POST['delete_cuisine']))
				{
					if($cuisine=="select")
					{
						echo "<script>alert('Select Cuisine to manage.');</script>";
					}
					else
					{
						echo '
						<div class="form_group">		
						<b><label>Cuisine Type</label></b>
						<select name="cuisine_type">
							<option hidden value="select">Select Cuisine Type</option>';
						
							$sql="SELECT * FROM $restname where cuisine='$cuisine'";
							$f=$conn->query($sql);
							if($f->num_rows>0)
							{
								while($rows=$f->fetch_assoc())
								{
									echo "<option value='".$rows['type']."'>".$rows['type']."</option>";
								}
							}
						
						echo'</select>	
							<input type="hidden" name="rest_name" value="'.$restname.'"/>
						</div>
						<input type="submit" class="btn" value="Delete it" name="delete" id="delete"/>';
					}
				}
				$cuisine_type=isset($_POST['cuisine_type']) ? $_POST['cuisine_type'] : "";
				$restname=isset($_POST['rest_name']) ? $_POST['rest_name'] : "";
					
				if(isset($_POST['delete']))
				{
					if($cuisine_type=="select")
					{
						echo "<script>alert('Select cuisine type to be deleted.');</script>";
					}
					else
					{
						$deldish="DELETE FROM $restname where type='$cuisine_type'";
						if($conn->query($deldish)==true)
						{
							echo "<script>alert('Cuisine type is deleted.');</script>";
						}
						else
						{
							echo "<script>alert('Error in deletion');</script>";
						}
					}
				}
		?>
	</div>
	</form>						
</body>
</html>	
