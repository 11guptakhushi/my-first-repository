<?php
	session_start();
	ob_start();
	include("dbconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Food Ordering System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
#footer
{
	width:100%;
	background-color:#343434;
	height:230px;
	font:menu;
}
#head
{
	font:menu;
	color:white;
	font-size:20px;
}
#footer table
{
	margin:0;
}
#footer td
{
	width:500px;
	font-size:18px;
	color:grey;
}
#footer ul li
{
	list-style-type:none;
	padding-right:10px;
	padding-bottom:5px;
	text-decoration:none;
}
#footer ul li a
{
	color:grey;
	text-decoration:none;
}
#footer ul li a:hover
{
	color:white;
	cursor:pointer;
}
#content
{
	border-bottom: 1px solid rgba(255,255,255,0.1);
	padding-bottom:10px;
}
.fa {
  padding: 10px;
  font-size: 20px;
  width: 20px;
  height:20px;
  background-color:#494949;
  color:white;
  text-align: center;
  text-decoration: none;
  border-radius:50%;
}
.social_media ul li
{
	float:left;
}
.fb a:hover {
  background: #3B5998;
}
.insta a:hover {
  background: #994BC3;
}
.pint a:hover {
  background: #EE2D34;
}
.twitter a:hover {
	background:#00ACEE;
}
#content button
{
	border:none;
	background:#343434;
	font-size:18px;
	color:grey;
}
#content button:hover
{
	color:white;
	cursor:pointer;
}
</style>
</head>
	
<body>
<div id="footer">
<table>
 <tr>
  <td id="content">
	<ul>
		<li id="head">Information</li>
		<li><a href="about.php">About Us</a></li>
		<li><a href="contact.php">Contact Us</a></li>
	</ul>
  </td>
  <td id="content">
	<ul>
		<li id="head">My Account</li>
		<li><a>My Orders</a></li>
		<li><a>My Account</a></li>
	</ul>
  </td>
  <td id="content">
	<ul>
		<li id="head">Popular Places</li>
		<li><form method="post"><button type="submit" name="bwr">Beawar</button></form></li>
		<li><form method="post"><button type="submit" name="ajm">Ajmer</button></form></li>
	</ul>
  </td>
 </tr>
 <tr>
  <td class="social_media">
	<ul>
		<li class="fb"><a href="#" class="fa fa-facebook"></a></li>
		<li class="insta"><a href="#" class="fa fa-instagram"></a></li>
		<li class="pint"><a href="#" class="fa fa-pinterest"></a></li>
		<li class="twitter"><a href="#" class="fa fa-twitter"></a></li>
	</ul>
  </td>
  <td >
	&copy;<?php echo date('Y');  ?> yummiieefood
  </td>
  <td>
  	<img src="images/logo/footer_logo.jpg" />
  </td>
 </tr>
</table>
</div>
</body>
</html>
<?php
if(isset($_POST['bwr']))
{
	$_SESSION['city']="Beawar";
	header("location: restaurant_all.php");
}
if(isset($_POST['ajm']))
{
	$_SESSION['city']="Ajmer";
	header("location: restaurant_all.php");
}
?>