<?php
	session_start();
	ob_start();
	include("includes/dbconnect.php");
	$rest_name=$_SESSION['rest_name'];
	$restname = str_replace(' ','',$rest_name);
?>
<html>
<head>
<title>Food Ordering System</title>
<style>
body
{
	background-color:#F3F3F3;
	font:message-box;
	font-size:14px;
	line-height: 22px;	
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
#box
{
	background:white;
	margin:10px;	
	border:solid 1px #CCCCCC;
	border-radius:5px;
	box-sizing:border-box;	
	display:block;	
}
.rest-head
{
	color: #33373D;
	padding:5px;
}
.rest-name span
{
	color:#B9BFC7;
	font-size:15px;
}
.rest-head td
{
	width:200px;
}
.rest-rate
{
	background-color:#5BA829;
	color:white;
	text-align:center;
	padding:5px 15px;
	border-radius:4px;
	width:30px;
	cursor:pointer;
}
.menu_category 
{
	overflow: auto;
	white-space: nowrap;
	width:670px;
}
.menu_category a 
{
	display: inline-block;
	text-align: center;
	padding: 14px;
	font-size:16px;
	text-decoration: none;
	color:black;
}
.menu_category a:hover
{
	border-bottom:solid;
	border-color:#DE1302;
	font-weight:bold;	
}
.menu_item
{
	width:670px;
}
.menu_item a
{
	color:#5A5A5C;
	text-decoration:none;	
}
.menu_item h3
{
	padding-left:10px;
	background:#F3F3F3;
	border-bottom:1px solid #f2f2f2;		
	padding:10px;	
}
#menu_head
{
	border-bottom:1px solid #f2f2f2; 
	background:white; 
	padding:5px 2px 2px 5px; 
	line-height: 22px;
}
#category_head
{
	background-color:#F3F3F3;
}
#price
{
	color:black; 
}
#ctn
{
	color: #89959B;
}
#add_item
{
	float:right;
}
#add
{
	background:white;
	cursor: pointer;
	margin: 0 10px 0 0;
	text-align: center;
	text-decoration: none;
	border:1px solid #5BA829;
	border-radius: 5px;
	color:#5BA829;
	padding: 6px 25px;
	text-transform: uppercase;
}
#add :hover
{
	background:#5BA829;
	color:white;
}
.order
{
	padding:15px;
	width:400px;
	position: sticky;
	top:0;
}
.order span
{
	color:#B9BFC7;
	font-size:15px;
}
.inc_dec
{
  display: inline-block;
  border: 1px solid green;
  width: 30px;
  height: 32px;
  text-align: center;
  background: white;
  cursor: pointer;
  color:green;
}
#decrease 
{
  margin-right: -4px;
  border-radius: 8px 0 0 8px;
}
#increase 
{
  margin-left: -4px;
  border-radius: 0 8px 8px 0;
}
#qty 
{
  text-align:right;
  border: none;
  color:white;
  background:green;
  width: 30px;
  height: 30px;
}
.cart
{
	height:300px; 
	overflow-x:hidden; 
	overflow-y:scroll;
}
#total_price
{
	float:right;
	color:black;
}
.continue
{
	cursor: pointer;
	border: none;
	background: #E0E1E2;
	text-align: center;
	text-decoration: none;
	border-radius: 3px;
	width: 100%;
	padding:10px;
	background-color: #099E44;
	color: #FFF;
	font-size: 18px;
}
</style>
</head>

<body>
<?php 
	include("includes/head.php");	
?>
    <section id="inner-headline">
		<marquee behavior="alternate" >Order Food</marquee>
    </section>
	<table align="center">
		<tr><td>
<?php
	$restaurant="SELECT * from restaurants WHERE rest_name='$rest_name'";
	$f=$conn->query($restaurant);
	
	if($f->num_rows>0)
	{
		while($row=$f->fetch_assoc())
		{
	echo "
	<div class='rest-head' id='box'>
	<table>
		<tr>
			<td colspan='3'>
				<div class='rest-name'>
					<span><font size='-1.5'>ORDER FOOD ONLINE FROM</font></span>
					<h2><font size='+3'>".$row['rest_name']."</font></h2>
					<span>".$row['rest_city']." • Costs &#8377 ".$row['cost_for_one']." for one</span>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan='4'>
				<hr />
			</td>
		</tr>
		<tr align='center' >
			<td><font size='-1'>DELIVERY TIME</font></td>
			<td><font size='-1'>MINIMUM ORDER</font></td>
			<td><font size='-1'>PAYMENT METHODS</font></td>
			
		</tr>
		<tr align='center'>
			<td><font size='+1'><b>".$row['delivery_time']."</b></font></td>
			<td><font size='+1'><b>&#8377 ".number_format($row['min_order'],2)."</b></font></td>
			<td><font size='+1'><b>".$row['payment_type']."</b></font></td>
		</tr>

	</table>	
	</div>";
		}
	}
	
	$restname = str_replace(' ','',$rest_name);
	$c=0;
	$category = "SELECT DISTINCT cuisine FROM $restname";
	$f=$conn->query($category);
	if($f->num_rows>0)
	{
		echo "<div id='menu_header'>
			<div class='menu_category' id='box'>";
		while($row=$f->fetch_assoc())
		{
			echo "<a href='#menu_".$c."' >".$row['cuisine']."</a>";
			$c++;
		}
		echo "</div>
			</div>";
	}
	
	$n=0;
	$menu = "SELECT DISTINCT cuisine FROM $restname";
	$f=$conn->query($menu);	
	if($f->num_rows>0)
	{
		while($row=$f->fetch_assoc())
		{
		    echo "<div class='items'>
					<div class='menu_item' id='box'>
						<a name='menu_".$n."'>
							<h3>".$row['cuisine']."</h3>";
							$cuisine=$row['cuisine'];
							$n++;	
			$menu_item = "SELECT * FROM $restname where cuisine='$cuisine'";
			$e=$conn->query($menu_item);
			while($row2=$e->fetch_assoc())
			{
				echo "
				<div id='menu_head' >										
					<div id='add_item'>
						<form method='post'>
							<button name='add' id='add' value='".$row2['dish_id']."'>Add</button>
						</form>
					</div>				
					<h2>".$row2['type']."</h2>
					<div id='item_ctn' >
						<span id='price' >&#8377;".number_format($row2['cost'],2)."</span><br />
						<span id='ctn'>".$row2['detail']."</span>
					</div>
				</div>";	
			}
			echo"</div>
			</div>";
		}
	}
?>
		</td>
		<td valign="top">	
<div class='order' id='box'>
	<h2 style="margin-bottom:0"><font size='+2'>Your order</font></h2>
	<center>
			<img src='images/site/empty-cart.png' width='244px' height='204px' id="empty"/><br />
			<span id="empty_line">Your Cart is empty.<br />Add an item to begin.</span><br />
	</center>
	
	<?php
if(isset($_POST['add']))
{
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
		$user_id=$_SESSION['user_id'];
		echo "<script>
				document.getElementById('empty').style.display='none';
				document.getElementById('empty_line').style.display='none';
			</script>
			<div class='cart'>";
			
		/*ADD ITEM INTO CART TABLE*/
		$dish_id=$_POST['add'];
				
		$dish_selected="SELECT * FROM $restname WHERE dish_id='$dish_id'";
		$f=$conn->query($dish_selected);
		$row=$f->fetch_assoc();
		if(isset($_SESSION['cart']))
		{
			function cart_item_id($element) 
			{
				return $element['item_id'];
			}
			$item_id_array = array_map('cart_item_id', $_SESSION['cart']);
	
			if(!in_array($row['dish_id'],$item_id_array))
			{
				$dish_selected="SELECT * FROM $restname WHERE dish_id='$dish_id'";
				$f=$conn->query($dish_selected);
				$row=$f->fetch_assoc();
				$price=$row['cost'];
				
				$sql="INSERT INTO cart(user_id, item_id, quantity, price, rest_name) values('$user_id','$dish_id','1','$price','$rest_name')";
				if($conn->query($sql)==true)
				{
					echo "<script>alert('Items inserted in cart');</script>";
				}
				else
				{
					echo "<script>alert('Error in insertion');</script>";
				}
			
				$count=count($_SESSION['cart']);
				$item_array=array(
					'item_id'	=>	$row['dish_id'],
					'item_name'	=>	$row['type'],
					'item_price'	=>	$row['cost'],
					'item_quantity'	=>	'1'
				);
				$_SESSION['cart'][$count]=$item_array;
			}
			else
			{
				echo "<script>alert('Item is already added.')</script>";
			}
		}
		else
		{
			$dish_selected="SELECT * FROM $restname WHERE dish_id='$dish_id'";
			$f=$conn->query($dish_selected);
			$row=$f->fetch_assoc();
			$price=$row['cost'];
			$dish_name=$row['type'];
			
			$sql="INSERT INTO cart(user_id, item_id, quantity, price, rest_name) values('$user_id','$dish_id','1','$price','$rest_name')";
			if($conn->query($sql)==true)
			{
				echo "<script>alert('Items inserted in cart');</script>";
			}
			else
			{
				echo "<script>alert('Error in insertion. Please log in first to continue.');</script>";
			}
			
			$item_array=array(
				'item_id'	=>	$row['dish_id'],
				'item_name'	=>	$row['type'],
				'item_price'	=>	$row['cost'],
				'item_quantity'	=>	'1'
			);
			$_SESSION['cart'][0]=$item_array;
		}
		
		if(!empty($_SESSION['cart']))
		{
			$dish_selected="SELECT * FROM $restname WHERE dish_id='$dish_id'";
			$f=$conn->query($dish_selected);
			$row=$f->fetch_assoc();
			$price=$row['cost'];
			
			$total=0;
			foreach($_SESSION['cart'] as $keys =>$values)
			{			
				echo "<table width=100%>
					<tr><td>
					  <h3>".$values['item_name']."</h3>
					  <form method='post'>
						  <input type='hidden' name='dish_id' value='".$values['item_id']."'/>			  
						  <button class='inc_dec' name='decr' id='decrease'>-</button>
						  <input type='number' name='qty' id='qty' value='".$values['item_quantity']."' readonly/>
						  <button class='inc_dec' name='incr' id='increase'>+</button>
						  &nbsp; x &nbsp; &#8377;".number_format($values['item_price'],2)."<span id='total_price'>&#8377;".number_format($values['item_quantity']*$values['item_price'],2)."</span>
					  </form>			  
					</td></tr>";
				
				echo "</table>";
				$total+=($values['item_quantity']*$values['item_price']);
			}
		}
		echo '</div>';
		if($total>0)
		{
			$_SESSION['total']=$total;
			echo "<br /><hr />
			<font size='2'>Total : 
				<span id='total_price'> &#8377;".number_format($total,2)."</span>
			</font>
			<br />
			<form method='post'>
				<button class='continue' name='continue'>Continue</button>
			</form>";	
		}
		else
		{
			echo "<script>
				document.getElementById('empty').style.display='block';
				document.getElementById('empty_line').style.display='block';
			</script>";	
		}
	}
	else
	{
		echo "<script>alert('Please login first to add item into cart.');</script>";
	}
}
if(isset($_POST['incr']))
{
	/*INCREMENT THE QUANTITY OF ITEM*/
	$dish_id=$_POST['dish_id'];
	
	$dish_update="SELECT * FROM $restname WHERE dish_id='$dish_id'";
	$k=$conn->query($dish_update);
	$row1=$k->fetch_assoc();
			
	$cart_update="SELECT * FROM cart WHERE item_id='$dish_id'";
	$k=$conn->query($cart_update);
	$row2=$k->fetch_assoc();
	
	$item_array=array(
		'item_id'	=>	$row1['dish_id'],
		'item_name'	=>	$row1['type'],
		'item_price'	=>	$row1['cost'],
		'item_quantity'	=>	$row2['quantity']
	);

	echo "<br>";
	$key=array_search($item_array,$_SESSION['cart']);
	//echo 'key: '.$key."<br>";
	
	$qty=$row2['quantity'];
	$qty++;
	$price=$qty*$row1['cost'];
	
	$update_dish_cart="UPDATE cart SET quantity='$qty',price='$price' WHERE item_id='$dish_id'";
	if($conn->query($update_dish_cart)==true)
	{
		echo "<script>alert('Dish updated');</script>";
	}
	else
	{
		echo "<script>alert('Dish not updated');</script>";
	}

	/*UPDATE QUANTITY IN SESSION*/
	$item_updated=array(
		'item_id'	=>	$row1['dish_id'],
		'item_name'	=>	$row1['type'],
		'item_price'	=>	$row1['cost'],
		'item_quantity'	=>	$qty
	);
	$_SESSION['cart'][$key]=$item_updated;
	
	
	
	echo "<script>
			document.getElementById('empty').style.display='none';
			document.getElementById('empty_line').style.display='none';
		</script>
		<div class='cart'>";
	
	if(!empty($_SESSION['cart']))
	{
		$total=0;
		foreach($_SESSION['cart'] as $keys =>$values)
		{
			echo "<table width=100%>
				<tr><td>
				  <h3>".$values['item_name']."</h3>
				  <form method='post'>
				  	  <input type='hidden' name='dish_id' value='".$values['item_id']."'/>			  
					  <button class='inc_dec' name='decr' id='decrease'>-</button>
					  <input type='number' name='qty' id='qty' value='".$values['item_quantity']."' readonly/>
					  <button class='inc_dec' name='incr' id='increase'>+</button>
					  &nbsp; x &nbsp; &#8377;".number_format($values['item_price'],2)."<span id='total_price'>&#8377;".number_format($values['item_quantity']*$values['item_price'],2)."</span>
				  </form>			  
			    </td></tr>";
	  		
			echo "</table>";
			$total+=($values['item_quantity']*$values['item_price']);
		}
	}
	echo '</div>';
	if($total>0)
	{
		$_SESSION['total']=$total;	
		echo "<br /><hr />
		<font size='2'>Total : 
			<span id='total_price'> &#8377;".number_format($total,2)."</span>
		</font>";
		echo "<br />
		<form method='post'>
			<button class='continue' name='continue'>Continue</button>
		</form>";
	}
	else
	{
		echo "<script>
			document.getElementById('empty').style.display='block';
			document.getElementById('empty_line').style.display='block';
		</script>";
	}
}//session_destroy();
if(isset($_POST['decr']))
{
	/*DECREMENT THE QUANTITY OF ITEM*/
	$dish_id=$_POST['dish_id'];
	
	$dish_update="SELECT * FROM $restname WHERE dish_id='$dish_id'";
	$k=$conn->query($dish_update);
	$row1=$k->fetch_assoc();
			
	$cart_update="SELECT * FROM cart WHERE item_id='$dish_id'";
	$k=$conn->query($cart_update);
	$row2=$k->fetch_assoc();
	
	$item_array=array(
		'item_id'	=>	$row1['dish_id'],
		'item_name'	=>	$row1['type'],
		'item_price'	=>	$row1['cost'],
		'item_quantity'	=>	$row2['quantity']
	);
	echo "<br>";
	$key=array_search($item_array,$_SESSION['cart']);
	//echo 'key: '.$key."<br>";
	
	$qty=$row2['quantity'];
	$qty--;
	$price=$qty*$row1['cost'];
	
	if($qty>0)
	{
		$update_dish_cart="UPDATE cart SET quantity='$qty',price='$price' WHERE item_id='$dish_id'";
		if($conn->query($update_dish_cart)==true)
		{
			echo "<script>alert('Dish updated');</script>";
		}
		else
		{
			echo "<script>alert('Dish not updated');</script>";
		}
		/*UPDATE QUANTITY IN SESSION*/
		$item_updated=array(
			'item_id'	=>	$row1['dish_id'],
			'item_name'	=>	$row1['type'],
			'item_price'	=>	$row1['cost'],
			'item_quantity'	=>	$qty
		);
		$_SESSION['cart'][$key]=$item_updated;
	}
	else
	{
		$delete_dish_cart="DELETE FROM cart WHERE item_id='$dish_id'";
		if($conn->query($delete_dish_cart)==true)
		{
			echo "<script>alert('Dish deleted');</script>";
		}
		else
		{
			echo "<script>alert('Dish not deleted');</script>";
		}
		unset($_SESSION['cart'][$key]);
	}
	
	
	echo "<script>
			document.getElementById('empty').style.display='none';
			document.getElementById('empty_line').style.display='none';
		</script>
		<div class='cart' id='cart'>";

	if(!empty($_SESSION['cart']))
	{
		$total=0;
		foreach($_SESSION['cart'] as $keys =>$values)
		{
			echo "<table width=100%>
				<tr><td>
				  <h3>".$values['item_name']."</h3>
				  <form method='post'>
				  	  <input type='hidden' name='dish_id' value='".$values['item_id']."'/>			  
					  <button class='inc_dec' name='decr' id='decrease'>-</button>
					  <input type='number' name='qty' id='qty' value='".$values['item_quantity']."' readonly/>
					  <button class='inc_dec' name='incr' id='increase'>+</button>
					  &nbsp; x &nbsp; &#8377;".number_format($values['item_price'],2)."<span id='total_price'>&#8377;".number_format($values['item_quantity']*$values['item_price'],2)."</span>
				  </form>			  
			    </td></tr>";
	  		
			echo "</table>";
			$total+=($values['item_quantity']*$values['item_price']);
		}
	}
	echo '</div>';
	if($total>0)
	{
		$_SESSION['total']=$total;	
		echo "<br /><hr />
		<font size='2'>Total : 
			<span id='total_price'> &#8377;".number_format($total,2)."</span>
		</font>";
		echo "<br />
		<form method='post'>
			<button class='continue' name='continue'>Continue</button>
		</form>";
	}
	else
	{
		echo "<script>
			document.getElementById('empty').style.display='block';
			document.getElementById('empty_line').style.display='block';
			document.getElementById('cart').style.display='none';
		</script>";
	}
}	

if(isset($_POST['continue']))
{
	echo 'Total: '.$_SESSION['total'];
	$min="SELECT min_order from restaurants WHERE rest_name='$rest_name'";
	$f=$conn->query($min);
	$row=$f->fetch_assoc();
	$min_order=$row['min_order'];
	if($_SESSION['total']>$min_order)
	{
		unset($_SESSION['cart']);
		header("location:personal_details.php");
	}
	else
	{
		echo "<script>alert('Minimum cost for order must be Rs.50');</script>";
	}
}
//print_r($_SESSION['cart']);
//session_destroy();
?>	
	
</div>
</td></tr>
	</table>
</body>
</html>
<script>
var header = document.getElementById('menu_header');
var sticky = header.offsetTop;

window.onscroll = function()
{
  if (window.pageYOffset > sticky) 
  {
    header.style.position='sticky';
	header.style.top='0';
  } 
}

</script>  