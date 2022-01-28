<?php
	include("../includes/dbconnect.php");
?>
<head>
<title>Food Ordering System</title>
<link rel="stylesheet" href="admin.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="card">
			<h3>Add a restaurant</h3>
			<form method="POST" action="AddRestaurant.php" enctype="multipart/form-data">
				<div class="rest_form_group">
					<label>Restaurant Name</label>
					<input type="text" name="restaurantname" value="<?php if(isset($_POST['restaurantname'])) echo $_POST['restaurantname'];	?>" required>	
				</div><br />
				<div class="rest_form_group">
					<label>Owner Name</label>
					<input type="text" name="owner" value="<?php if(isset($_POST['owner'])) echo $_POST['owner'];	?>" required>	
				</div><br />
				<div class="rest_form_group">
					<label>Address</label>
					<input type="text" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address'];	?>" required>	
				</div><br />
				<div class="rest_form_group">
					<label>City</label>
					<input type="text" name="city" value="<?php if(isset($_POST['city'])) echo $_POST['city'];	?>" required>	
				</div>
				<div class="rest_form_group">
					<label>Cost for One Person</label>
					<input type="integer" name="cost_one" value="<?php if(isset($_POST['cost_one'])) echo $_POST['cost_one'];	?>" required>	
				</div>
				<div class="rest_form_group">
					<label>Delivery Time</label>
					<input type="integer" name="delivery_time" value="<?php if(isset($_POST['delivery_time'])) echo $_POST['delivery_time'];	?>"required>	
				</div>
				<div class="rest_form_group">
					<label>Minimum Order</label>
					<input type="integer" name="min_order" value="<?php if(isset($_POST['min_order'])) echo $_POST['min_order'];	?>"required>	
				</div>
				<div class="rest_form_group">
					<label>Image of Restaurant</label>
					<input type="file" name="image">
				</div><br />
				<div class="rest_form_group">
				<label>Cuisine</label><br />
					<div class="check-type">	
						<input type="checkbox" class="form-check-input" value="North Indian" name="cuisine[]">North Indian
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="South Indian" name="cuisine[]">South Indian
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Rajasthani" name="cuisine[]">Rajasthani
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Continental" name="cuisine[]">Continental
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Mexican" name="cuisine[]">Mexican
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Italian" name="cuisine[]">Italian
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Fast Food" name="cuisine[]">Fast Food
					</div>
					<div class="check-type">
					    <input type="checkbox" class="form-check-input" value="Chinese" name="cuisine[]">Chinese
					</div>
					<div class="check-type">
					    <input type="checkbox" class="form-check-input" value="Burger" name="cuisine[]">Burger
					</div>
					<div class="check-type">
					    <input type="checkbox" class="form-check-input" value="Sandwich" name="cuisine[]">Sandwich
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Pizza" name="cuisine[]">Pizza
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Beverages" name="cuisine[]">Beverages
					</div>
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Desserts" name="cuisine[]">Desserts
					</div>
					<div class="check-type">
					    <input type="checkbox" class="form-check-input" value="Icecream" name="cuisine[]">Ice Cream
					</div>	
					<div class="check-type">
						<input type="checkbox" class="form-check-input" value="Cafe" name="cuisine[]">Cafe
					</div>
				</div> <br />
				<div class="form-group">
							<label>Payment Allowed</label>
							<select name="payment"> 
								<option value="Cash">Cash</option>
								<option value="Cash &amp; Online">Cash &amp; Online</option>
							</select>
				</div>
				<div class="form-group">
					<label>Ranking</label>
					<input type="integer" name="ranking" value="<?php if(isset($_POST['ranking'])) echo $_POST['ranking'];	?>"required>	
				</div>							
				<input type="submit" class="btn" name="addrestaurant" value="Add Restaurant" />
			</form>
<?php
if(isset($_POST['addrestaurant']))
{
	if(empty($_POST['restaurantname']))
	{
		echo "<script>alert('Restaurant Name is required.');</script>";
		die();
	}
	if(!preg_match('/^[a-zA-Z ]+$/',$_POST['restaurantname']))
	{
		echo "<script> alert('Restaurant Name can contain only letters.'); </script>";
		die();
	}
	if(empty($_POST['owner']))
	{
		echo "<script>alert('Restaurant Owner Name is required.');</script>";
		die();
	}
	if(empty($_POST['address']))
	{
		echo "<script>alert('Restaurant Address is required.');</script>";
		die();
	}
	if(!preg_match('/^[a-zA-Z ]+$/',$_POST['restaurantname']))
	{
		echo "<script> alert('Restaurant Owner Name can contain only letters.'); </script>";
		die();
	}
	if(empty($_POST['city']))
	{
		echo "<script>alert('City Name is required.');</script>";
		die();
	}
	if(!preg_match('/^[a-zA-Z ]+$/',$_POST['city']))
	{
		echo "<script> alert('City Name can contain only letters.'); </script>";
		die();
	}
	if(empty($_POST['cost_one']))
	{
		echo "<script>alert('Cost per person is required.');</script>";
		die();
	}
	if(!preg_match('/^[0-9]+$/',$_POST['cost_one']))
	{
		echo "<script> alert('Cost can contain only numbers.'); </script>";
		die();
	}
	if(empty($_POST['delivery_time']))
	{
		echo "<script>alert('Delivery time field is mandatory.');</script>";
		die();
	}
	if(!preg_match('/^[a-zA-Z0-9 ]+$/',$_POST['delivery_time']))
	{
		echo "<script> alert('Enter correct delivery time.'); </script>";
		die();
	}
	if(empty($_POST['min_order']))
	{
		echo "<script>alert('Minimum order field is mandatory.');</script>";
		die();
	}
	if(!preg_match('/^[0-9]+$/',$_POST['min_order']))
	{
		echo "<script> alert('Minimum order can contain only numbers.'); </script>";
		die();
	}
	if(empty($_POST['ranking']))
	{
		echo "<script>alert('Ranking is required.');</script>";
		die();
	}
	if(!preg_match('/^[0-9]+$/',$_POST['ranking']))
	{
		echo "<script> alert('Ranking can contain only numbers.'); </script>";
		die();
	}
	
	$name = mysql_real_escape_string($_POST['restaurantname']);
	$owner = mysql_real_escape_string($_POST['owner']);
	$address = mysql_real_escape_string($_POST['address']);
	$city = mysql_real_escape_string($_POST['city']);
	$cuisine='';
	if(!empty($_POST['cuisine']))
	{
		foreach ($_POST['cuisine'] as $key) 
		{
			$cuisine.=','.$key;
		}
	}
	$cuisine = substr($cuisine, 1);
	$cost_one = mysql_real_escape_string($_POST['cost_one']);
	$delivery_time = mysql_real_escape_string($_POST['delivery_time']);	
	$min_order = mysql_real_escape_string($_POST['min_order']);	
	$payment = mysql_real_escape_string($_POST['payment']);
	$ranking = mysql_real_escape_string($_POST['ranking']);	

	if(empty($_POST['image']))
	{
		$img=addslashes(file_get_contents("images/site/placeholder.jpg"));
		
	    $sqlInsert = "INSERT INTO restaurants(rest_name,owner_name,rest_img,rest_address,rest_city,cost_for_one,delivery_time,min_order,cuisine,payment_type,ranking) VALUES('$name','$owner','$img','$address','$city','$cost_one','$delivery_time','$min_order','$cuisine','$payment','$ranking')";
		
		if($conn->query($sqlInsert)==true)
		{
			echo "<script>alert('Restaurant is added')</script>";
		}
		else
		{
			echo "<br>Restaurant is not added";
		}

		$restname = str_replace(' ','',$name);
		$addRest="CREATE table $restname(
			dish_id int(100) Auto_increment primary key,
			cuisine varchar(50),
			type varchar(50),
			cost int(100),
			detail varchar(500)
		)";
		if($conn->query($addRest)==true)
		{
			echo "<script>alert('Table of Restaurant is created')</script>";
		}
		else
		{
			echo "<br>Table of Restaurant is not created";
		}		
	}
	else
	{
		if(isset($_FILES['image']))
		{
			$image =  $_FILES['image'];
			//print_r($image);
			$imagename = $_FILES['image']['name'];	//contains the original name of the uploaded file from the user's computer
		
			// Check file size
			if ($_FILES["image"]["size"] > 65536) 
			{
				echo "<script>alert('Sorry, your file is too large.');</script>";
				die();
			}
			
			$fileExtension = explode('.', $imagename);
			$fileCheck = strtolower(end($fileExtension));
			$fileExtensionStored = array('jpg','jpeg');
			if(in_array($fileCheck, $fileExtensionStored))		// Allow certain file formats
			{
				$img=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	   
				$sqlInsert = "INSERT INTO restaurants(rest_name,owner_name,rest_img,rest_address,rest_city,cost_for_one,delivery_time,min_order,cuisine,payment_type,ranking) VALUES('$name','$owner','$img','$address','$city','$cost_one','$delivery_time','$min_order','$cuisine','$payment','$ranking')";
				
				if($conn->query($sqlInsert)==true)
				{
					echo "<script>alert('Restaurant is added')</script>";
				}
				else
				{
					echo "<br>Restaurant is not added";
				}
	
				$restname = str_replace(' ','',$name);
				$addRest="CREATE table $restname(
					dish_id int(100) Auto_increment primary key,
					cuisine varchar(50),
					type varchar(50),
					cost int(100),
					detail varchar(500)
				)";
				if($conn->query($addRest)==true)
				{
					echo "<script>alert('Table of Restaurant is created')</script>";
				}
				else
				{
					echo "<br>Table of Restaurant is not created";
				}
	
			}
			else
			{
				echo "<script>alert('Sorry, only JPG/JPEG files are allowed.')</script>";
				die();
			}			
		}
	}
}
?>				
		</div>	
	</div>
</body>
</html>
