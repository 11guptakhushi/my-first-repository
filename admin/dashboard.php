<?php
	include("includes/dbconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dashboard</title>
<style>
.count
{
	width:300px;
	display:inline-block;
	background:white;
	border:1px solid grey;
	padding:10px;
	margin:10px;
	box-sizing: border-box;
	border-radius: 5px;
}
img
{
	float:right;
	width:60px;
	padding:10px;
}
</style>
</head>

<body bgcolor="#edf0f5">

<div class="count">
	<img src="images/site/users.svg"/>
	<h2>No. of Users</h2>
	<h1>
		<?php
			$users="SELECT COUNT(user_id) as total_users FROM login";
			$f=$conn->query($users);
			$count_users=$f->fetch_assoc();
			$num_rows=$count_users['total_users'];
			echo $num_rows-1;
		?>
	</h1>
</div>

<div class="count">
	<img src="images/site/users.svg"/>
	<h2>No. of Cities</h2>
	<h1>
		<?php
			$city="SELECT COUNT(DISTINCT rest_city) as total_cities FROM restaurants";
			$f=$conn->query($city);
			$count_city=$f->fetch_assoc();
			$num_rows=$count_city['total_cities'];
			echo $num_rows;	
		?>
	</h1>
</div>

<div class="count">
	<img src="images/site/users.svg"/>
	<h2>No. of Restaurants</h2>
	<h1>
		<?php
			$rest="SELECT COUNT(rest_id) as total_rest FROM restaurants";
			$f=$conn->query($rest);
			$count_rest=$f->fetch_assoc();
			$num_rows=$count_rest['total_rest'];
			echo $num_rows;
		?>
	</h1>
</div>

<div class="count">
	<img src="images/site/orders.svg"/>
	<h2>No. of Orders</h2>
	<h1>
		<?php
			$orders="SELECT COUNT(order_id) as total_orders FROM food_ordering_system.order";
			$f=$conn->query($orders);
			$count_orders=$f->fetch_assoc();
			$num_rows=$count_orders['total_orders'];
			echo $num_rows;
		?>
	</h1>
</div>
</body>
</html>
