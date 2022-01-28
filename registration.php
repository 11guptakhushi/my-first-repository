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
/* CSS Document */
body
{
	margin:0;
	padding:0;
	background-image: url("images/11.jpg");
	background-size: cover; 
	background-repeat:no-repeat;
	background-attachment:auto;
	background-position:center;
	font-family:sans-serif;
	z-index:-1;
}
.registerbox
{
	width: 500px;
	background:#000000;
	color:#fff;
	top: 305px;
	left: 80%;
	position: relative;
	transform: translate(-50%,-50%);
	box-sizing: border-box;
	padding: 10px 30px;
}
.registerbox h1
{
	padding:0 0 2px;
	text-align:center;
	font-size:22px;
}
.registerbox .inputbox
{
	position:relative;
}
.registerbox .inputbox input
{
	width: 100%;
	padding-top: 10px;
	margin-bottom:30px;
	border:none;
	outline: none;
	border-bottom:1px solid #fff;
	background: transparent;
	color: #fff;
	font-size:16 px;
}
.registerbox .inputbox label
{
	position: absolute;
	top:0;
	left:0;
	padding:8px 0;
	color:#fff;
	font-size:16 px;
	font-weight:bold;
	pointer-events: none;
	transition: .5s;
}
.registerbox .inputbox input:focus ~ label,
.registerbox .inputbox input:valid ~ label
{
	top:-18px;
	left:0;
	color:#fff;
	font-size:12px;
	font-weight:bold;
}	
.registerbox .inputbox input:focus,
.registerbox .inputbox input:valid
{
	border-bottom: 2px solid #FCB415;
}
.registerbox input[type="submit"]
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
.registerbox input[type="submit"]:hover
{
	cursor: pointer;
	background: #FCB415;
	color: #000;
}
.registerbox a
{
	text-decoration:underline;
	font-size:14px;
	line-height:12px;
	color:#C4FB04;
}
.registerbox a:hover
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
	<div class ="registerbox">
		Already a member? <a href="login.php" >Log in</a>
		<h1>Create A New Account</h1>
		<form method="post">
			<div class ="inputbox">
				<input type="text" name="f_name" value="<?php if(isset($_POST['f_name'])) echo $_POST['f_name'];?>" required/>
				<label>First Name</label>
			</div>

			<div class ="inputbox">
				<input type="text" name="l_name" value="<?php if(isset($_POST['l_name'])) echo $_POST['l_name'];?>"  required />
				<label>Last Name</label>
			</div>

			<div class ="inputbox">
				<input type="text" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>" required/>
				<label>Phone No.</label>
			</div>

			<div class ="inputbox">
				<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"  required/>
				<label>E-mail</label>
			</div>

			<div class ="inputbox">
				<input type="text" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address'];?>"  required/>
				<label>Address</label>
			</div>

			<div class ="inputbox">
				<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>" required/>
				<label>Username</label>
			</div>

			<div class="inputbox">
				<input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>" minlength="8" required  />
				<label>Password</label>
			</div>

			<div class="inputbox">
				<input type="password" name="confirm" value="<?php if(isset($_POST['confirm'])) echo $_POST['confirm'];?>"  required />
				<label>Confirm Password</label>
			</div>

		<input type="submit" name="register" value="Register" />
		
	</form>
	</div>
		<?php 
				if(isset($_POST['register']))
				{
					if(empty($_POST['f_name']))
					{
						echo "<script> alert('First Name is required.'); </script>";
						die();
					}
					if(!preg_match('/^[a-zA-Z]+$/',$_POST['f_name']))
					{
						echo "<script> alert('First Name should contain only letters.'); </script>";
						die();
					}						
				
					if(empty($_POST['l_name']))
					{
						echo "<script> alert('Last Name is required.'); </script>";
						die();
					}
					if(!preg_match('/^[a-zA-Z]+$/',$_POST['l_name']))
					{
						echo "<script> alert('Last Name should contain only letters.'); </script>";
						die();
					}
				
					if(empty($_POST['phone']))
					{
						echo "<script> alert('Phone number is required'); </script>";
						die();
					}
					if(!preg_match('/^[0-9]+$/',$_POST['phone']))
					{
						echo "<script> alert('Phone number should contain only digits.'); </script>";
						die();
					}
					if(strlen($_POST['phone'])!=10)
					{
						echo "<script> alert('Phone number should contain exactly 10 digits.'); </script>";
						die();
					}					
					
					if(empty($_POST['email']))
					{
						echo "<script> alert('Email ID is required'); </script>";
						die();
					}
					if(!preg_match("/^[a-zA-Z0-9\._-]+\@[a-zA-Z0-9]+(\.[a-z]+)$/",$_POST['email']))
					{
						echo "<script> alert('Invalid Email ID format');</script>";
						die();
					}
				
					if(empty($_POST['address']))
					{
						echo "<script> alert('Address is required'); </script>";
						die();
					}
						
					if(empty($_POST['username']))
					{
						echo "<script> alert('Username is required.'); </script>";
						die();
					}
					if(!preg_match('/^[a-zA-Z0-9\._-]+$/',$_POST['username']))
					{
						echo "<script> alert('Username can contain only alphabet, number, special character ( _ or - or . )'); </script>";
						die();
					}						

					if(empty($_POST['password']))
					{
						echo "<script> alert('Password is required'); </script>";
						die();
					}
					else
					{					
						$up_case=preg_match("@[A-Z]@",$_POST['password']);
						$low_case=preg_match("@[a-z]@",$_POST['password']);
						$num=preg_match("@[0-9]@",$_POST['password']);
						$sp_char=preg_match("@[^\w]@",$_POST['password']);
						if(!$up_case||!$low_case||!$num||!$sp_char||strlen($_POST['password'])<8)
						{
							echo "<script> alert('Strong Password should be at least 8 characters in length and must include an uppercase letter, a lowercase letter, a number and a special character.');</script>";							
							die();
						}
					}

					if(empty($_POST['confirm']))
					{
						echo "<script> alert('Please Re-enter your password for confirmation.');</script>";
						die();
					}
					if($_POST['confirm']!==$_POST['password'])
					{
						echo "<script> alert('Please enter correct password for confirmation.');</script>";
						die();
					}
					
					$f_name=$_POST['f_name'];	
					$l_name=$_POST['l_name'];
					$phone=$_POST['phone'];	
					$email=$_POST['email'];
					$address=$_POST['address'];	
					$username=$_POST['username'];
					$pwd=$_POST['password'];
					$confirm=$_POST['confirm'];																																									

				if($username=="admin_kp" && $pwd=="admin_kp")
				{
					echo "<script>alert('Sorry....This username is already registered. Please choose any different username.')</script>";
				}
				else
				{
					$x="SELECT Username FROM login WHERE Username='$username'";					
					$f=$conn->query($x);
					if($f->num_rows>0)
					{
						while($row=$f->fetch_assoc())
						{
								if($row["Username"]==$username)
								{	
									echo "<script>alert('Sorry....This username is already registered. Please choose any different username.')</script>";
									break;
								}
						
						}
					}
					else
					{
						$ins_reg="INSERT INTO registration VALUES('$f_name','$l_name','$phone','$email','$address','$username','$pwd')";
						$ins_log="INSERT INTO login(Username,Password,Email_ID,User_type) VALUES('$username','$pwd','$email','User')";
						/*if($conn->query($ins_reg)==true)
						{
							echo "Record Inserted in registration<br>";	
						}
						else
						{
							echo "Error in registration<br>".$conn->connect_error;
						}
			
						if($conn->query($ins_log)==true)
						{
							echo "Record Inserted in login <br>";	
						}
						else
						{
							echo "Error in login <br>".$conn->connect_error;
						}*/
						if(($conn->query($ins_reg)==true)&&($conn->query($ins_log)==true))
						{
							header("location: login.php");
						}
						else
						{
							echo "Error ";
						}
					}
				}
			}			
	?>
</section>
<section>
<?php
			include("includes/footer.php");
?>
</section>

</body>
</html>
