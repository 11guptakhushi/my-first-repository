<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");
	$city=$_SESSION['city'];	
	$user_id=$_SESSION['user_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Food Ordering System</title>
<link rel="stylesheet" href="includes/restaurants.css" type="text/css" />
</head>

<body>
<?php
	include("includes/head.php");	
	echo "
<center>
		<div id='popular'>
			<h2 style='font-size:25px;'>Restaurants in ".$city." </h2>
			<p id='list-content'>Restaurants around you serving delightful food right at your doorstep.</p>
		</div>
</center>";
	echo "<table align='center'><tr><td>";	
	$c=0;
	$allRest = "SELECT * from restaurants WHERE rest_city='$city'";
	$f=$conn->query($allRest);
	if($f->num_rows>0)
	{
		while($row=$f->fetch_assoc())
		{
			$id=$row['rest_id'];
			$name=$row['rest_name'];
			$img=$row['rest_img'];
			$cost_one=$row['cost_for_one'];
			$delivery_time=$row['delivery_time'];
			$cuisine=$row['cuisine'];
			$c++;		
	
			if($c%2==1)
			{
				echo "
				<table align='center'><tr><td>
					<div id='restaurants'>					
						<div class='rest_img'><img src='data:image/jpeg;base64,".base64_encode($img)."' id='rest_img' alt='".$name."' /></div>
						<div id='rest_head' >
							<h2 id='rest_name'>".$name."</h2>
							<div id='rest_ctn' >
								<span id='cuisine' >".$cuisine."</span><br />
								<span id='ctn'>Cost &#8377; ".$cost_one." for one &nbsp; . &nbsp; Upto ".$delivery_time."<br>Accepts cash & online payments</span>
							</div>								
						</div>
						<div id='rest_order' >
						<form method='post'>
							<input type='hidden' name='rest_name' value='".$name."'/>
							<button name='order' value='".$name."' id='order'>Order Now</button>
						</form>
						</div>
					</div>
				</td>";									
			}			
			else
			{
				echo "<td>
				<div id='restaurants'>					
					<div class='rest_img'><img src='data:image/jpeg;base64,".base64_encode($img)."' id='rest_img' alt='".$name."' /></div>
					<div id='rest_head' >
						<h2 id='rest_name'>".$name."</h2>
						<div id='rest_ctn' >
							<span id='cuisine' >".$cuisine."</span><br />
							<span id='ctn'>Cost &#8377; ".$cost_one." for one &nbsp; . &nbsp; Upto ".$delivery_time."<br>Accepts cash & online payments</span>
						</div>								
					</div>
					<div id='rest_order' >
					<form method='post'>
						<input type='hidden' name='rest_name' value='".$name."'/>
						<button name='order' value='".$name."' id='order'>Order Now</button>
					</form>
					</div>
				</div>";
				echo "</td></tr></table>";
			}	
		}	
	}
	echo "</td></tr></table>";
	if(isset($_POST['order']))
	{
		$_SESSION['rest_name']=$_POST['rest_name'];
		header('location: menus.php');
	}
	include("includes/footer.php");
?>
</body>
</html>