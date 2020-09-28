<?php
	session_start();
?>
<html>
<head>
<title>Food Ordering System</title>
<style>
body
{
	background:url(images/site/placeholder.jpg);
	font-family:sans-serif;
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
p
{
	font-size:20px;
}
</style>
</head>

<body>
<?php 
	include("includes/head.php");	
?>
    <section id="inner-headline">
		<marquee behavior="alternate" >About Us</marquee>
    </section>
	<table>
	<tr><td>
<p>Online Food Ordering System is a part of e-commerce. E-commerce or business through net means distributing, buying, selling, marketing, and servicing of products or services over electronic systems such as the Internet and other computer networks.
Internet has seen a tremendous growth in terms of coverage and awareness. So giving the business an online presence has become very crucial and important. With this System, we can set up restaurant menu online and the customers can easily place order with a simple mouse click.</p>

<p>The main objective of this project is to develop an application which gives provision to the restaurant owners to flourish their business by uploading menus at no cost and the ability to increase sales and expand their business by giving customers the facility to order food online.
The main objective of the application is to understand the basics of PHP, JavaScript and MySQL. <br>
Moreover, I value recent learning about the PHP Programming language as well as seeing how powerful and dynamic they are when it comes to web designing and applications.</p>

<p>This online website enables the end users to register online, select the food from the e-menu card, read the E-menu card and order food online. By just selecting the food that the user want to have. By using this application the work of the Waiter is reduced and we can also say that the work is nullified.  The benefit of this is that if there is rush in the Restaurant then there will be chances that the waiters will be unavailable and the users can directly order the food online by using this application.</p>
</td>
<td>
<img src="images/swiggy.jpg">
</td></tr>
</table>

<?php 
	include("includes/footer.php");	
?>
</body>
</html>
