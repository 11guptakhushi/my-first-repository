<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Food Ordering System</title>
<style>
body
{
	font-family:sans-serif;
	background-color:#de1302;
}
.card
{
	background:white;
	margin:20px 50px;	
	border:solid 1px #CCCCCC;
	border-radius:5px;
	box-sizing:border-box;	
	display:block;	
}
.loginbox
{
	width: 320px;
	background:black;
	color:white;
	top: 300px;
	left: 50%;
	position: relative;
	transform: translate(-50%,-60%);	
	box-sizing: border-box;
	padding: 50px 30px;
	margin-bottom:105px;
	margin-top:15px;		
	border-radius:2%;
}
.profile
{
	width:100px;
	height: 100px;
	border-radius: 50%;
	position: absolute;
	top: -50px;
	left: calc(50% - 50px);
}
.loginbox h1
{
	padding:0 0 20px;
	text-align:center;
	font-size:22px;
}
.loginbox .inputbox
{
	position:relative;
}
.loginbox .inputbox input
{
	width:100%;
	padding: 10px 0;
	margin-bottom:30px;
	border:none;
	outline: none;
	border-bottom:1px solid white;
	background: transparent;
	color: white;
	font-size:16 px;
}
.loginbox .inputbox label
{
	position: absolute;
	top:0;
	left:0;
	padding:10px 0;
	color:white;
	font-size:16 px;
	font-weight:bold;
	pointer-events: none;
	transition: .5s;
}
.loginbox .inputbox input:focus ~ label,
.loginbox .inputbox input:valid ~ label
{
	top:-18px;
	left:0;
	color:white;
	font-size:12px;
	font-weight:bold;
}	
.loginbox .inputbox input:focus,
.loginbox .inputbox input:valid
{
	border-bottom: 2px solid #FCB415;
}
.loginbox input[type="submit"]
{
	border:none;
	outline:none;
	height:40px;
	width:100%;
	background:#DE1302;
	color:#fff;
	font-size:18px;
	border-radius: 20px;
}
.loginbox input[type="submit"]:hover
{
	cursor: pointer;
	background: #FCB415;
	color: #000;
}
.loginbox a
{
	text-decoration:underline;
	line-height:12px;
	color:darkgrey;
}
.loginbox a:hover
{
	color: #FCB415;
}
</style>
</head>
<body>
<?php	include("includes/head.php");	?>
<div class="card">
	<img src="images/personal_details.jpg" width="100%"/>
	<div class="loginbox">
		<img src="images/profile.jpg" class="profile" />
		<label style="color:white; text-align:center;">
		Hi <?php
				$user_id=$_SESSION['user_id'];
				$sql="SELECT * FROM login WHERE user_id='$user_id'";
				$f=$conn->query($sql);
				$row=$f->fetch_assoc();	
				$username=$row["Username"];
				echo $username;	
			?>,
		</label>
		<h1>Login Here</h1>
		<form method="post">
			<div class="inputbox">
				<input type="password" name="Password" value="<?php echo $_POST['Password'];?>" required />
				<label>Enter Password</label>
			</div>
			<div class="inputbox">
				<input type="text" name="email" value="<?php echo $_POST['email'];?>" required />
				<label>Enter Email ID</label>
			</div>
			<input type="submit" name="login" value="Login" />
		</form>
	</div>
</div>
</body>
</html>	
<?php
if(isset($_POST['login']))
{
	if(empty($_POST['Password']))
	{
		echo "<script> alert('Password is required.'); </script>";
	}
	if(empty($_POST['email']))
	{
		echo "<script> alert('Email ID is required.'); </script>";
	}
	$pwd=$_POST['Password'];
	$email=$_POST['email'];

	$sql="SELECT * from login where Username='$username'";
	$f=$conn->query($sql);
	$row=$f->fetch_assoc();
	if($row["Password"]==$pwd || $row["Email_ID"]==$email)
	{	
		header("location: confirm_order.php");
	}
	else
	{
		echo "<script> alert('Either you have entered wrong password or wrong Email ID.'); </script>";
	}
}
?>				
