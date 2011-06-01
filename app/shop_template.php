<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Shop Demo Application</title>
</head>

<body>
	
	<form action="/" method="post">
		
		
		<div>
			<h1>Shop Demo Application</h1>
		</div>
		
		
		<div id="list" style="margin: 15px 0 15px 0;">
			
			<h2>Catalog</h2>
			
			<?php if (isset($_SESSION['add_to_cart_message'])) : ?>
				<div style="font-size: smaller; margin-bottom: 5px;
					<?php if (isset($_SESSION['add_to_cart_error'])) : ?>
						background-color: red;
					<?php else : ?>
						background-color: yellow;
					<?php endif; ?>
					">
					<?php
					    echo $_SESSION['add_to_cart_message'];
					    unset($_SESSION['add_to_cart_message']);
					    unset($_SESSION['add_to_cart_error']);
					?>
				</div>
			<?php endif; ?>

			<table>
				<thead style="font-size: x-large;">
					<tr>
						<td>Name</td>
						<td>Category</td>
						<td></td>
					</tr>
				</thead>
				<?php foreach($productCatalog as $p) : ?>
					<tr>
						<td style="padding-right: 50px;"><strong><?php echo $p->getName() ?></strong></td>
						<td style="padding-right: 50px;"><?php echo $p->getCategory() ?></td>
						<td>
							<span style="font-size: smaller;">amount:</span>
							<input type="text"
								id="q<?php echo $p->getId() ?>"
								name="q<?php echo $p->getId() ?>"
								style="width: 25px"></input>
							<input type="submit"
								id="add<?php echo $p->getId() ?>"
								name="add<?php echo $p->getId() ?>"
								value="Add to Cart"></input>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			
		</div>
		
		
		<hr />
		
		
		<div id="cart" style="margin-top: 15px;">
			
			<h2>Shopping Cart</h2>
			
			<?php if (isset($_SESSION['cart_update_message'])) : ?>
				<div style="font-size: smaller; margin-bottom: 5px;
    					<?php if (isset($_SESSION['cart_update_error'])) : ?>
    						background-color: red;
    					<?php else : ?>
    						background-color: yellow;
    					<?php endif; ?>
					">
					<?php
					    echo $_SESSION['cart_update_message'];
					    unset($_SESSION['cart_update_message']);
					    unset($_SESSION['cart_update_error']);
					?>
				</div>
			<?php endif; ?>
			
			<?php if (count($cart->getProductEntries()) > 0) : ?>
    			<?php foreach($cart->getProductEntries() as $e) : ?>
    				<div style="margin-bottom: 15px">
    					<div><strong><?php echo $e->getProduct()->getName() ?></strong>
    							(category: <?php echo $e->getProduct()->getCategory() ?>)</div>
    					<div>
    						Quantity:
    						<input type="text"
    							id="cart_quantity<?php echo $e->getProduct()->getId(); ?>"
    							name="cart_quantity<?php echo $e->getProduct()->getId(); ?>"
    							value="<?php echo $e->getQuantity() ?>"
    							style="width: 25px">
    						</input>
    					</div>
    				</div>
    			<?php endforeach; ?>
    			<div>
    				<input type="submit" id="update_cart" name="update_cart" value="Update Cart"></input>
    			</div>
    		<?php else : ?>
    			<div>The shopping cart is empty.</div>
    		<?php endif; ?>
			
		</div>
		
		
	</form>
	
</body>

</html>
