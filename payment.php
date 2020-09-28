<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");
	$pay_mode=$_SESSION['payment'];
	$user_id=$_SESSION['user_id'];
	$rest_name=$_SESSION['rest_name'];	
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
	margin:20px 50px;	
	border:solid 1px #CCCCCC;
	border-radius:5px;
}
.card_in
{
	padding:10px 200px;
	width:600px;
}
h1
{
	padding:0 0 20px;
	text-align:center;
	font-size:22px;
}
.inputbox
{
	position:relative;
}
.inputbox input
{
	width:100%;
	padding: 10px 0;
	margin-bottom:30px;
	border:none;
	outline: none;
	border-bottom:1px solid black;
	background: transparent;
	color:black;
	font-size:16 px;
}
.inputbox label
{
	position: absolute;
	top:0;
	left:0;
	padding:10px 0;
	color:gray;
	font-size:16 px;
	font-weight:bold;
	pointer-events: none;
	transition: .5s;
}
.inputbox input:focus ~ label,
.inputbox input:valid ~ label
{
	top:-18px;
	left:0;
	font-size:14px;
	color:#de1302;
	font-weight:bold;
}	
.inputbox input:focus,
.inputbox input:valid
{
	border-bottom: 2px solid #FCB415;
}
.btn
{
	cursor: pointer;
	border: none;
	background: #E0E1E2;
	text-align: center;
	text-decoration: none;
	border-radius: 3px;
	width: 50%;
	padding:10px;
	background-color: #099E44;
	color: #FFF;
	font-size: 18px;
	margin-top:5px;
	margin-left:150px;
}
</style>
</head>

<body>
<?php	include("includes/head.php");	?>
	<div class="card" id='pay_detail' style="margin:20px 50px;">
		<img src="images/place_order.jpg" width="100%"/>
		<div class="card_in" style="display:block;">
			<h1><?php	echo $pay_mode;	?> DETAILS</h1>
			<form method="post">
				<div class="inputbox">
					<input type="text" name="card_no" value="<?php echo $_POST['card_no'];?>" required />
					<label><?php	echo $pay_mode;	?> Number</label>
				</div>
				<label style="color:gray; font-weight:bold;">Select Expiry Date</label>
				<div class="inputbox">
					<input type="month" name="date" value="<?php echo $_POST['date'];?>" required />
				</div>
				<div class="inputbox">
					<input type="password" name="cvv" value="<?php echo $_POST['cvv'];?>" required />
					<label>CVV</label>
				</div>
				<div class="inputbox">
					<input type="text" name="name" value="<?php echo $_POST['name'];?>" required />
					<label>Cardholder's Name</label>
				</div>
				<button type="submit" name="pay" class="btn">Pay
				<?php	
					$total=0;
					$sql="SELECT * from cart where user_id='$user_id'";
					$f=$conn->query($sql);
					while($row=$f->fetch_assoc())
					{
						$total+=$row['price'];
					}				
					$total_price=number_format($total,2);			
					echo ' &#8377;'.$total_price;
					
					$order_id=rand();
					$orderID="SELECT order_id FROM order";
					$f=$conn->query($orderID);
					if($f->num_rows>0)
					{
						while($row=$f->fetch_assoc())
						{
							if($row['order_id']==$order_id)
							{
								$order_id=rand();
							}
						}
					}

				?>
				</button>
			</form>
		</div>
	</div>
	<div class="card" id="Thank" style="margin:20px 50px;display:none;">
		<center>
			<b><font face="Monotype Corsiva" color="#de1302" size="100px">Thank You</font></b><br />
		   	<b>Your Order No. is <?php	echo $order_id;	?></b>
		</center>		
	</div>
</body>
</html>
<?php
if(isset($_POST['pay']))
{
	if(empty($_POST['card_no']))
	{
		echo "<script> alert('Card number is required.'); </script>";
		die();
	}
	if(!preg_match('/^[0-9]+$/',$_POST['card_no']))
	{
		echo "<script> alert('Card number should contain only digits.'); </script>";
		die();
	}
	if(strlen($_POST['card_no'])!=16)
	{
		echo "<script> alert('Card number should contain exactly 16 digits.'); </script>";
		die();
	}
						
	if(empty($_POST['date']))
	{
		echo "<script> alert('Expiry date is required.'); </script>";
		die();		
	}
	
	if(empty($_POST['cvv']))
	{
		echo "<script> alert('CVV of card is required.'); </script>";
		die();		
	}
	if(!preg_match('/^[0-9]+$/',$_POST['cvv']))
	{
		echo "<script> alert('CVV of card should contain only digits.'); </script>";
		die();
	}
	if(strlen($_POST['cvv'])!=3)
	{
		echo "<script> alert('CVV of card should contain exactly 3 digits.'); </script>";
		die();
	}
						
	if(empty($_POST['name']))
	{
		echo "<script> alert('Cardholder Name is required.'); </script>";
		die();		
	}
	if(!preg_match('/^[a-zA-Z ]+$/',$_POST['name']))
	{
		echo "<script> alert('Cardholder Name should contain only letters.'); </script>";
		die();
	}

	$card_no=$_POST['card_no'];
	$date=$_POST['date'];
	$cvv=$_POST['cvv'];
	$name=$_POST['name'];

	$item_ordered="SELECT * from cart inner join $restname on cart.item_id=$restname.dish_id where user_id='$user_id'";
	$f=$conn->query($item_ordered);
	while($row=$f->fetch_assoc())
	{
		$item=$row['type'];
		$qty=$row['quantity'];
		$c=0;
		$order_items="INSERT INTO order_items(order_id,user_id,item_name,quantity) VALUES ('$order_id','$user_id','$item','$qty')";
		if($conn->query($order_items)==true)
		{
			$c=1;
		}
	}
	if($c==1)
	{
		$order="INSERT INTO food_ordering_system.order VALUES('$order_id','$user_id',CURRENT_TIMESTAMP,'$total_price','$rest_name')";
		$pay="INSERT INTO payment VALUES('$order_id','$user_id','$pay_mode','$card_no','$date','$cvv','$name')";
		$empty_cart="DELETE FROM cart where user_id='$user_id'";
		if($conn->query($pay)==true && $conn->query($order)==true && $conn->query($empty_cart)==true)
		{
			echo "<script> 
					alert('Order Successful'); 
					document.getElementById('pay_detail').style.display='none';				
					document.getElementById('Thank').style.display='block';
				 </script>";
		}	
	}
	else
	{
		echo "<script>alert('There is nothing in your cart.');	</script>";
	}
}
?>