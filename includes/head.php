<?php
	session_start();
	ob_start();
	include("dbconnect.php");
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<title>Food Ordering System</title>
<style>
body
{
	margin:0;
}
.menu{
	background-color:white;
}
.sidebar{
	background-color: #de1302;
	max-width:400px;
	width:100%;
	height:100vh;
	
	position:fixed;
	top:0px;
	right:0;
	
	display:flex;
	flex-direction: column;
	align-items:center;
	justify-content:center;
	
	color:white;
	transform: translateX(100%);
	transition:transform 0.24s ease-in;
	
	z-index:1;
}
.sidebar.active{
	transform: translateX(0%);
}
.close{
	position:absolute;
	top:30px;
	right:40px;
	font-size: 30px;
	color: white;
	float:right;
	line-height: 80px;
	margin:20px 40px;
	cursor: pointer;
}

.menu .button{
	font-size: 30px;
	color: black;
	float:right;
	line-height: 80px;
	margin:20px 40px;
	cursor: pointer;
}
 #logo
{
	width:300px;
	height:62px;
}
 .menu ul
{
	list-style-type:none;
	margin: 0px;
	padding: 0px;
	position: relative;
	float: right;		
	font-family:sans-serif;
	font-size:16px;
	position:relative;
	z-index:500;
	font-weight:600;	
}
 .menu ul li
{
	text-align:center;	
	width: 100%;
	height:50px;
	line-height: 62px;
	letter-spacing:1px;
	display:inline-block;
}
 .menu ul li a
{
	color:white;
	text-decoration:none;
	display:block;
}
 .menu ul li a.active, a:hover 
{
	color:white;
	border-bottom:3px solid white;
	font-weight:bold;
}
#profile
{
	vertical-align:middle; 
	border-radius:50%;
}
 .menu button
{
	border:none;
	background:none;
	width: 100%;
	height:50px;
	cursor:pointer;
	font-size:16px;
	color:white;	
}
.menu button:hover{
	border-bottom:3px solid white;
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
			<div class='button' onclick='toggleSidebar()'>
				<i class='fas fa-bars'></i>
			</div>
			<div class='sidebar'>
				<div class='close' onclick='toggleSidebar()'>
					<i class='fas fa-close'></i>
				</div>
				<div>
					<ul>
						<li style='color:black'>Hi, ".$user["Username"]."</li>
						<li><a href='homepage.php'>Home</a></li>					
						<li><a href='about.php'>About Us</a></li>
						<li><a href='contact_us.php'>Contact Us</a></li>
						<li><form method='get'><button type='submit' name='logout' style='font-weight:bold;'>Log Out</button></form></li>
					</ul>	
				</div>
			</div>
			<img src='images/logo/logo.jpg'/>
		</div>";
	}
}
else 
{
	echo "
	<div class='menu'>
		<div class='button' onclick='toggleSidebar()'>
			<i class='fas fa-bars'></i>
		</div>
		<div class='sidebar'>
			<div class='close' onclick='toggleSidebar()'>
				<i class='fas fa-close'></i>
			</div>
			<div>
				<ul>
					<li><a href='homepage.php'>Home</a></li>
					<li><a href='login.php'>Login</a></li>
					<li><a href='registration.php' >Create an Account</a></li>
					<li><a href='about.php'>About Us</a></li>
					<li><a href='contact_us.php'>Contact Us</a></li>
				</ul>	
			</div>
		</div>
		<img src='images/logo/logo.jpg'/>
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
<script>
	function toggleSidebar(){
		const sidebar = document.querySelector(".sidebar");
		sidebar.classList.toggle("active");
	}
</script>