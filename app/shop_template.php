<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Shop Demo Application</title>
</head>

<body>
		
	<form name="product_list" action="/index.php" method="post">
		
		<div>
			<h1>Shop Demo Application</h1>
		</div>
		
		
		<div id="list" style="margin: 40px 0 40px 0;">
			
			<h2>Products</h2>
			
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
							<input type="text" id="q<?php echo $p->getId() ?>" name="q<?php echo $p->getId() ?>" style="width: 15px"></input>
							<input type="submit" id="add<?php echo $p->getId() ?>" name="add<?php echo $p->getId() ?>" value="Add to Cart"></input>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			
		</div>
		
		
		<hr />
		
		
		<div id="cart" style="margin-top: 40px;">
			
			<h2>Shopping Cart</h2>
			
			<?php if (count($cart->getProductEntries()) > 0) : ?>
    			<?php foreach($cart->getProductEntries() as $e) : ?>
    				<div style="margin-bottom: 20px">
    					<div><strong><?php echo $e->getProduct()->getName() ?></strong>
    							(category: <?php echo $e->getProduct()->getCategory() ?>)</div>
    					<div>Quantity: <?php echo $e->getQuantity() ?></div>
    				</div>
    			<?php endforeach; ?>
    		<?php else : ?>
    			<div>The shopping cart is empty.</div>
    		<?php endif; ?>
			
		</div>
		
		
	</form>
		
</body>

</html>
