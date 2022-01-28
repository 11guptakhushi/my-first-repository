<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");
	$rest_name=$_SESSION['rest_name'];
	$user_id=$_SESSION['user_id'];
	$restname = str_replace(' ','',$rest_name);	
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
	margin:5px;
	border:solid 1px #CCCCCC;
	border-radius:5px;
	box-sizing:border-box;	
	display:block;	
}
.card_in
{
	padding:10px;
}
h2
{ 
	background-color:#F3F3F3;	
	padding:5px 2px 2px 5px; 
}
.cart
{
	height:200px; 
	overflow-x:hidden; 
	overflow-y:scroll;
}
.dark
{
	color: #666666;
	font-size:20px;
}
.light
{

	font-size:15px;
	vertical-align: top;
	margin: 0 0 5px 0;
}
.btn
{
	cursor: pointer;
	border: none;
	background: #E0E1E2;
	text-align: center;
	text-decoration: none;
	border-radius: 3px;
	width: 97%;
	padding:10px;
	background-color: #099E44;
	color: #FFF;
	font-size: 18px;
	margin-top:5px;
}
</style>
</head>

<body>
<?php	include("includes/head.php");	?>
	<div class="card" style="margin:20px 50px;">
		<img src="images/review_order.jpg" width="100%"/>
		<div class="card_in">
		<table width="100%">
			<tr>
				<td rowspan="2">
					<div class="card" style="height:400px;">
						<h2>Your Cart</h2>						
						<div class="card_in">
								<?php
									$total=0;	
									echo "<span class='dark'>
										<table width=100%>
											<tr>
												<td width='200px' align='left'>Item Name</td>
												<td width='100px' align='center'>Quantity</td>
												<td width='100px' align='right'>Price</td>
											</tr>
										</table>
										</span><hr>
									<div class='cart'>";
									$sql="SELECT * from cart inner join $restname on cart.item_id=$restname.dish_id where user_id='$user_id'";
									$f=$conn->query($sql);
									while($row=$f->fetch_assoc())
									{
											echo "<span class='light' style='line-height:30px;'>
											<table style='border-bottom:1px solid #ddd; width:100%;'>
											<tr>
												<td width='200px'>".$row['type']."</td>
												<td width='100px' align='center'>".$row['quantity']."</td>
												<td width='100px' align='right'>&#8377; ".number_format($row['price'],2)."</td>
											</tr>
										</table>
										</span>";
										$total+=$row['price'];
									}							
									echo '</div><hr><b>To Pay:<span style="float:right">&#8377;'.number_format($total,2).'</span></b>';
							?>	
						</div>	
					</div>
				</td>
				<td>
					<div class="card">
						<h2>Restaurant</h2>
						<div class="card_in">						
						<?php
							echo '<span class="dark">'.$rest_name.'</span><br><br>';
							$sql="SELECT * from restaurants where rest_name='$rest_name'";
							$f=$conn->query($sql);
							$row=$f->fetch_assoc();
							echo "<b>".$row['rest_city']."</b><br>"; 
							echo "<img src='images/site/icon_location.svg'> <span class='light'>".$row['rest_address']."</span>"; 							
						?>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="card">
						<h2>Select Payment Method</h2>
						<div class="card_in">						
							<form method="post">
								<span class="light">
									<input type="radio" name="payment" value="CREDIT CARD" />Credit Card<br />
									<input type="radio" name="payment" value="DEBIT CARD" />Debit Card<br />
								</span>
								<input type="submit" class="btn" value="Make Payment" name="pay_mode"/>
							</form>										
						</div>
					</div>
				</td>
			</tr>
		</table>
		</div>		
	</div>
</body>
</html>
<?php
if(isset($_POST['pay_mode']))
{
	if(!empty($_POST['payment']))
	{
		$_SESSION['payment']=$_POST['payment'];
		header("location:payment.php");
	}
	else
	{
		echo "<script>alert('Please select a payment method');</script>";
	}
}
?>
