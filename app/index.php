<?php

if(empty($_SERVER['CONTENT_TYPE'])){
       
     $type = "application/x-www-form-urlencoded";
     $_SERVER['CONTENT_TYPE'] = $type;

}

set_include_path(get_include_path() . ':' . realpath('..'));

require_once 'classes/shop/Product.php';
require_once 'classes/shop/ProductEntry.php';
require_once 'classes/shop/ShoppingCart.php';

// Init session
session_start();

// Create product list
$productCatalog = array();
$productCatalog[] = new Product(1, 'Honda Fit', 'Cars');
$productCatalog[] = new Product(2, 'Toyota Vitz', 'Cars');
$productCatalog[] = new Product(3, 'Porsche Carrera', 'Sanjou\'s Cars');
$productCatalog[] = new Product(4, 'Porsche Cayman', 'Sanjou\'s Cars');

function retrieveProduct($id)
{
    global $productCatalog;
    foreach($productCatalog as $product) {
        if ($product->getId() == $id) {
            return $product;
        }
    }
    throw new OutOfRangeException("Cannot find product with id '{$id}'");
}

// Get cart entries from session
$cart = null;
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = new ShoppingCart();
    $_SESSION['cart'] = $cart;
}

// Handle add-to-cart action
foreach($_POST as $paramKey => $paramVal) {
    if (strpos($paramKey, 'add') !== false) {
        $productId = intval(substr($paramKey, strlen('add')));
        $quantity = intval($_POST['q' . $productId]);
        $cart->addProductEntry(retrieveProduct($productId), $quantity);
        break;
    }
}

// TODO - Handle adjust-quantity action

include 'shop_template.php';

