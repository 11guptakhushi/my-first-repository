<?php
	session_start();
	ob_start();
	include("dbconnect.php");
?>	
<head>
<title>Food Ordering System</title>
<style>
body
{
	margin:0;
	width:100%;
}
 .menu
{
	width: 100%;
	height:62px;
	background-color:white;	
	font-family:sans-serif;
	font-size:14px;
	z-index:500;
}
 #logo
{
	width:300px;
	height:62px;
	float:left;
}
 .menu ul
{
	list-style-type:none;
	margin: 0px;
	padding: 0px;
	position: relative;
	float: right;		
}
 .menu ul li
{
	text-align:center;	
	width: 180px;
	height:50px;
	line-height: 62px;
	letter-spacing:1px;
	display:inline-block;
	font-weight:bold;	
}
 .menu ul li a
{
	text-decoration:none;
	display:block;
	color:black;
}
 .menu ul li a:hover 
{
	border-bottom:3px solid #DE1302;
	font-weight:bold;
	color:#DE1302;
}
 .menu ul ul
{
	display:none;
}
 .menu ul li:hover ul
{	
	display:block;
	margin-top: 0px;
	border:1px solid;	
	border-top:1px outset #DE1302;
	z-index:500;
}
 .menu ul li:hover ul li
{
	display:block;
	background:white;
}
 .menu button
{
	border:none;
	background:none;
	width: 180px;
	height:50px;
	cursor:pointer;
}
#profile
{
	vertical-align:middle; 
	border-radius:50%;
}
</style>
</head>
<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
	$user_id=$_SESSION['user_id'];
	$sql="SELECT * from login WHERE user_id='$user_id'";
	$f=$conn->query($sql);
	$user=$f->fetch_assoc();
	
	if($user["User_type"]=="admin")
	{
		echo "
		<div class='menu'>
			<img src='images/logo/logo.jpg'/>
			<ul>
				<li><form method='get'><button type='submit' name='logout'><big>Log Out</big></button></form></li>
			</ul>
		</div>";
	}
	else
	{
		echo "
		<div class='menu'>
			<img src='images/logo/logo.jpg'/>
			<ul>
				<li><a href='homepage.php'>Home</a></li>
				<li><a href=''>About Us</a></li>
				<li><a href='contact_us.php'>Contact Us</a></li>		
				<li><a><img src='images/profile.jpg' width='30px' height='30px' id='profile'> ".$user["Username"]."</a>
					<ul>
						<li><a href=''>My Account</a></li>
						<li><a href=''>My Order</a></li>
						<li><form method='get'><button type='submit' name='logout' style='font-weight:bold;'>Log Out</button></form></li>
					</ul>
				</li>
			</ul>
		</div>";
	}
}
else 
{
	echo "
	<div class='menu'>
		<img src='images/logo/logo.jpg'/>
		<ul>
			<li><a href='homepage.php'>Home</a></li>
			<li><a href='login.php'>Login</a></li>
			<li><a href='registration.php' >Create an Account</a></li>
			<li><a href='about.php'>About Us</a></li>
			<li><a href='contact_us.php'>Contact Us</a></li>
		</ul>
	</div>";		
}

if (isset($_GET['logout'])) 
{							
		session_destroy();
		unset($_SESSION['user']);
		header("location: login.php");
}
?>
</body>
</html>