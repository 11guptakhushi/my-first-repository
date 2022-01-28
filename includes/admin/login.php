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
	margin:0;
	padding:0;
	background-image:url("images/10.jpg");
	background-position:center;
	font-family:sans-serif;
	z-index:-1;
	font-size:14px;	
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
<section>
<?php
	include("includes/head.php");
?>
</section>
<section>
	<div class="loginbox">
				<img src="images/profile.jpg" class="profile" />	
				<h1>Login Here</h1>
				<form method="post">
					<div class="inputbox">
						<input type="text" name="ID" value="<?php echo $_POST['ID'];?>" required/>
						<label>Enter Username</label>
					</div>
					<div class="inputbox">
						<input type="password" name="Password" value="<?php echo $_POST['Password'];?>" required />
						<label>Enter Password</label>
					</div>
					<input type="submit" name="login" value="Login" /><br /><br />
					<a href="" >Forgot Password</a><br /><br />
					Don't have an account? <a href="registration.php">Sign Up</a>
				</form>
			</div>
</section>
<section>
			<?php	include("includes/footer.php");		?>
</section>
</body>
</html>
<?php
				
	if(isset($_POST['login']))
	{	
		if(empty($_POST['ID']))
		{
			echo "<script> alert('Username is required.'); </script>";
		}
		else
		{
			$username=$_POST['ID'];
		}
			
		if(empty($_POST['Password']))
		{
			echo "<script> alert('Password is required.'); </script>";
		}
		else
		{
			$pwd=$_POST['Password'];
		}

	$e="SELECT * from login where Username='$username'";
	$f=$conn->query($e);
	
	if($f->num_rows>0)
	{
		while($row=$f->fetch_assoc())
		{
			if($row["Username"]==$username)
			{	
				if($row["Password"]==$pwd)
				{
					$c=1;
					$_SESSION['user_id']=$row["user_id"];
					$_SESSION['user_type']=$row["User_type"];
				}
				else
				{
					$c=2;
				}
			}
			else
			{
				$c=3;
			}
		}
		if($c==1)
		{
			echo "<script> alert('Login Successful....!!'); </script>";
			$_SESSION['loggedin'] = true;
			if($_SESSION['user_type']=="admin")
			{
				header('location: admin/admin.html');
			}
			else
			{
				header('location: homepage.php');
			}
		}
		elseif($c==2)
		{
			echo "<script> alert('Incorrect Password'); </script>";
		}
	 }
	 else
	 {
	 	echo "<script> alert('This username is not Registered'); </script>";
	 }
	}
?>
