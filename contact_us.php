<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1" />
<title>Food Ordering</title>
<style>
body {
    font-family: 'Open Sans', Arial, sans-serif;
    font-size: 14px;
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
.contact_form
{
	margin-bottom:30px;
	padding:0 20px 0 20px;
	position:relative;
}
.contact_form h4
{
	font-size:28px;
	font-weight:700;
}
#sendmessage
{
    border: 1px solid #8fc04e;
	color: green;
    border: 1px solid green;
    display: none;
    text-align: center;
    padding: 15px;
    font-weight: 600px;
    margin-bottom: 15px;
}
#errormessage 
{
    color: red;
    display: none;
    border: 1px solid red;
    text-align: center;
    padding: 15px;
    font-weight: 600px;
    margin-bottom: 15px;
}
.field
{
	margin-bottom:30px;
}
input[type="text"] {
    width: 100%;
    min-height: 40px;
    padding-left: 20px;
    font-size: 13px;
    padding-right: 20px;
    box-sizing: border-box;
	background-color: #ffffff;
    border: 1px solid #cccccc;
	display: inline-block;
    height: 20px;
    padding: 4px 6px;
    margin-bottom: 10px;
    line-height: 20px;
    color: #555555;
    vertical-align: middle;
    border-radius: 4px;
}
textarea {
    width: 100%;
    padding-left: 20px;
    padding-top: 10px;
    font-size: 13px;
    padding-right: 20px;
    box-sizing: border-box;
	background-color: #ffffff;
    border: 1px solid #cccccc;
	padding: 4px 6px;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 20px;
    color: #555555;
    vertical-align: middle;
    border-radius: 4px;	
	height:auto;
}
p
{
	margin:0 0 10px;
}
.send
{
	color:#fff;
	border: 1px solid #8fc04e;
    background: #8fc04e;
	margin-top:10px;
	border-radius:4px;
	font-weight:600;
	float:left;
	display: inline-block;
    padding: 4px 12px;
}
.form_info
{
	margin-top:20px;
	float:right;
	color:#aaa;
}
.info
{
	border-left: 1px solid #ddd;
    padding: 0 0 0 30px;
    box-shadow: inset 1px 0 0 0 rgba(0,0,0,.01);
    position: relative;
    margin-bottom: 40px;
    display: block;
}
h5
{
	position: relative;
	font-size:24px;
    font-weight: 600;
    letter-spacing: -1px;
    margin-bottom: 20px;
}
.contact-info
{
	list-style-type:none;
}
.contact-info li
{
	margin:0 0 15px 0;
	list-style:none;
	display:list-item;
}
.contact-info li label
{
	font-weight:700;
	color:#353535;
	font-size:15px;
	display: block;
    margin-bottom: 5px;
}
</style>
</head>

<body>
<center>
<?php 	include("includes/head.php");	?>
<section id="inner-headline">
	<marquee behavior="alternate">Get in touch</marquee>
</section>
<section>
<iframe width="1350" height="380" src="https://maps.google.com/maps?q=vardhman%20girls%20college%2Cbeawar&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="yes"></iframe>
<table>
	<tr>
		<td>	  
		  <div class="contact_form">
			<h4>Get in touch with us by filling contact form below</h4>
			<form id="contactform" action="" method="post" role="form" class="contactForm">
			  <div id="sendmessage">Your message has been sent. Thank you!</div>
			  <div id="errormessage"></div>
			  <div class="field">
				  <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];	?>" placeholder="* Enter your full name" minlen="4" required/>
				  <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];	?>" placeholder="* Enter your email address" required/>
				  <input type="text" name="subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject'];	?>" placeholder="Enter your subject" minlen="4"/>
				  <textarea rows="12" name="message" value="<?php if(isset($_POST['message'])) echo $_POST['message'];	?>" placeholder="* Your message here..." required></textarea>
				  <p>
					<button class="send" name="send_msg" type="submit">Send message</button>
					<span class="form_info">* Please fill all required form field, thanks!</span>
				  </p><br />
			  </div>
			</form>
		  </div>
		</td>
		<td>	  
		  <div class="info">
			<h5>Contact information<span></span></h5>
			<ul class="contact-info">
			  <li><label>Address :</label> Outside Nehru Gate Main Rd, near Krishna Colony,<br /> Beawar, Rajasthan 305901</li>
			  <li><label>Phone :</label>+91 123 456 78 / +91 123 456 79</li>
			  <li><label>Fax : </label>+91 123 456 10 / +91 123 456 11</li>
			  <li><label>Email : </label> yummiieefood@gmail.com</li>
			</ul>
		  </div>
		</td>
	</tr>
  </table>
</section>
<?php include("includes/footer.php"); ?>
 </center>	
</body>
</html>					
<?php
	if(isset($_POST['send_msg']))
	{
		if(empty($_POST['name']))
		{
			echo "<script>alert('Please enter your full name.')</script>";
		}
		if(!preg_match('/^[a-zA-Z ]+$/',$_POST['name']))
		{
			echo "<script> alert('Name should contain only letters.'); </script>";
		}			
		if(empty($_POST['email']))
		{
			echo "<script>alert('Please enter your Email ID.')</script>";			
		}
		if(!preg_match("/^[a-zA-Z0-9\._-]+\@[a-zA-Z0-9]+(\.[a-z]+)$/",$_POST['email']))
		{
			echo "<script> alert('Invalid Email ID format');</script>";			
		}			
		if(empty($_POST['message']))
		{
			echo "<script>alert('Enter your message.')</script>";
		}
		
		$name=$_POST['name'];
		$email=$_POST['email'];
		$subject=$_POST['subject'];
		$msg=$_POST['message'];
		
		$insert_msg="INSERT INTO contact_tbl VALUES('$name','$email','$subject','$msg')";
		if($conn->query($insert_msg)==true)
		{
			echo "<script>alert('Message sent');</script>";
		}
		else
		{
			echo "<script>alert('Message not sent');</script>";
		}
	}
?>			
