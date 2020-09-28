<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");	
	if(isset($_POST['find']))
	{
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
		{
			$user_id=$_SESSION['user_id'];
		}
		else
		{
			echo "<script>alert('Please log in first to continue.');</script>";
		}
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1" />
<title>Food Ordering System</title>
<style>
body
{
	margin:0;
	font-family:sans-serif;
	font-size: 14px;
	font-weight: 300;
}
#inner-headline 
{
    background: #DE1302;
    color: #fff;	
    font-size: 24px;	
	font-weight:bold;
	text-align:left;
	padding-left:20px;
}
.slider
{
	width: 100%;
	height: 500px;
	overflow: hidden;
}
.slider figure img
{
	width:20%;
	height:500px;
	float:left;
}
.slider figure
{
	position: relative;
	width: 500%;
	margin: 0px;
	left: 0px;
	animation: slide 20s infinite linear;
}
@keyframes slide
{
	0%{ left: 0%;}
	15%{ left: 0%;}
	25%{ left: -100%;}
	35%{ left: -100%;}
	45%{ left: -200%;}
	55%{ left: -200%;}
	65%{ left: -300%;}
	75%{ left: -300%;}
	85%{ left: -400%;}
	100%{ left: -400%;}
}
.search_box
{
	padding:15px;
	width:350px;
	position:absolute;
	background-image: url('images/site/6.jpg');
	background-position:center;
	left:100px;
	top:200px;
	font-family: sans-serif;
	box-sizing:border-box;
	outline:none;
 	line-height: 20px;
	z-index:1;
}
ul
{
	list-style-type:none;
}
li
{
	padding-bottom:8px;
}
select
{
	padding:10px;
	width: 225px;
}
input
{
	padding:10px;
	width: 200px;
}
.find
{
	padding:10px;
	width: 200px;
	font:15px arial;
	font-weight:bold;
	width:225px;
	color:white;
	background-color:#4ca146;
	border:none;
}
.work
{
	background:#F0F0F0; 
	width:100%;
}
.work h2
{
	font-size:25px;
	padding:10px;	
}
#list
{
	font-style:normal;
	font-size:20px;
}
#list-content
{
	font-style:normal;
	font-size:15px;
	font-family: sans-serif;
	color:gray;
}
#view_all
{
	cursor:pointer;
}
</style>
<link rel="stylesheet" href="includes/restaurants.css" type="text/css" />
</head>

<body>
	<?php	include("includes/head.php");	?>
	<section id="inner-headline">
		<marquee behavior="alternate" ><font face="Arial, Helvetica, sans-serif">Welcome In Yummiieefood</font></marquee>
    </section>
	<!--LOCATION BASED SEARCH AND SLIDER-->
	<section>
		<div class="slider">		
			<figure>
				<img src="images\site\8.jpg"/>
				<img src="images\site\9.jpg"/>
				<img src="images\site\12.jpeg"/>				
				<img src="images\site\10.jpg"/>
				<img src="images\site\11.jpg"/>
			</figure>
			<div class="search_box">
				<h2>Restaurants Near By</h2>
				<div>
					<form method="post">
						<ul>
							<li><select name="city">
								<option hidden >Select City</option>
								<?php	
									$city="SELECT DISTINCT rest_city FROM restaurants ORDER BY rest_city ASC";
									$f=$conn->query($city);
									if($f->num_rows>0)
									{
										while($row=$f->fetch_assoc())
										{
											echo "<option value='".$row['rest_city']."'>".$row['rest_city']."</option>";
										}
									}
								?>
								</select>
							</li>
							<li><input placeholder="Select Area" type="text" name="region"  value="<?php echo $_POST['region']; ?>" /></li>
							<li><a href="#found"><input type="submit" name="find" class="find" value="Find Now"/></a></li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="work">
			<table align="center">
				<tr>
					<td colspan="4" align="center">
						<h2 > How It Works</h2>
					</td>
				</tr>
				<tr>
					<td align="center" width="300px">
						<img src='images/site/8.png' />
						<p id="list"> 1. Search</p>
						<p id="list-content" > Find your restaurant using location based search filter.</p>
					</td>
					<td align="center" width="300px">
						<img src='images/site/9.png' />
						<p id="list"> 2. Choose</p>
						<p id="list-content" > Select a best fit appropriate restaurant which fulfills your binge and taste buds.</p>
					</td>
					<td align="center" width="300px">
						<img src='images/site/10.png' />
						<p id="list"> 3. Pay</p>
						<p id="list-content" > Make payment using instant and secured online process.</p>
					</td>
					<td align="center" width="300px">
						<img src='images/site/11.png' />
						<p id="list"> 4. Enjoy</p>
						<p id="list-content"> Celebrate and have a good time enjoying your chosen delicacy.</p>
					</td>
				</tr>		
			</table>
		</div>
	</section>
	<section>
<?php
	if(isset($_POST['find']))
	{
		if($_POST['city']=="Select City" && empty($_POST['region']))
		{
			echo "<script> alert('Please select city and region.'); </script>";
		}
		elseif($_POST['city']=="Select City")
		{
			echo "<script> alert('Please select a city.'); </script>";
		}
		elseif(empty($_POST['region']))
		{
			echo "<script> alert('Please enter your region.'); </script>";
		}	
		else
		{
			$city=$_POST['city'];
			$_SESSION['city']=$city;											
		}
		
		echo "<center>
			<div id='popular'>
				<h2 style='font-size:25px;'>Popular Restaurants</h2>
				<p id='list-content'>Popular this month. Top Restaurants around you serving delightful food right at your doorstep.</p>
			</div>";
		echo "<table align='center'><tr><td>";	
		$c=0;
		$topRest = "SELECT * from restaurants WHERE rest_city='$city' AND (ranking='1' OR ranking='2')";
		$f=$conn->query($topRest);
		if($f->num_rows>0)
		{
			while($row=$f->fetch_assoc())
			{
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
					</div>
				</td></tr></table>";	
				}	
			}
		}
		echo "</td></tr></table>";	
		echo "<a href='restaurant_all.php' style='text-decoration:none;' name='found'>
			<button class='view_all' id='view_all'>VIEW ALL RESTAURANTS</button>
		  </a>
		 </center>";
	}		 	 
	if(isset($_POST['order']))
	{
		$_SESSION['rest_name']=$_POST['rest_name'];
		header('location: menus.php');
	}
?>	
	</section>
	<?php	include("includes/footer.php");	?>
	
</body>
</html>