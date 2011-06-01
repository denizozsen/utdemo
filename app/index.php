<?php

set_include_path(get_include_path() . ':' . realpath('..'));

require_once 'classes/shop/Product.php';
require_once 'classes/shop/ProductEntry.php';
require_once 'classes/shop/ShoppingCart.php';

// Init session
session_start();

// Create product list
$productCatalog = array();
$i = 1;
$productCatalog[] = new Product($i++, 'Honda Fit', 'Cars');
$productCatalog[] = new Product($i++, 'VW Golf', 'Cars');
$productCatalog[] = new Product($i++, 'Porsche Carrera', 'Sanjou\'s Favourites');
$productCatalog[] = new Product($i++, 'Jeans', 'Clothing');
$productCatalog[] = new Product($i++, 'Shirt', 'Clothing');
$productCatalog[] = new Product($i++, 'Hat', 'Clothing');

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

// Handle actions
if ( 'POST' == strtoupper($_SERVER['REQUEST_METHOD']) ) {
    // Handle add-to-cart action
    foreach($_POST as $paramKey => $paramVal) {
        if (strpos($paramKey, 'add') !== false) {
            
            $rawProductId = trim(substr($paramKey, strlen('add')));
            if ( (string)(int)$rawProductId !== $rawProductId ) {
                $_SESSION['add_to_cart_error']   = true;
                $_SESSION['add_to_cart_message'] = "Product ID is of incorrect format: {$rawProductId}";
                break;
            }
            
            $rawQuantity = trim($_POST['q' . $rawProductId]);
            if ( (string)(int)$rawQuantity !== $rawQuantity ) {
                $_SESSION['add_to_cart_error']   = true;
                $_SESSION['add_to_cart_message'] = "Quantity must be an integer, but was: {$rawQuantity}";
                break;
            }
            
            $cart->addProductEntry(retrieveProduct(intval($rawProductId)), intval($rawQuantity));
            $_SESSION['add_to_cart_message'] = 'Product added to cart';
            break;
        }
    }
    
    // Handle update-cart action
    if (isset($_POST['update_cart'])) {
        foreach($cart->getProductEntries() as $e) {

            $currentQ = $e->getQuantity();
            
            $rawNewQ = trim($_POST['cart_quantity' . $e->getProduct()->getId()]);
            if ( (string)(int)$rawNewQ !== $rawNewQ ) {
                $_SESSION['cart_update_error']   = true;
                $_SESSION['cart_update_message'] = "Quantity must be an integer, but was {$rawNewQ}";
                break;
            }
            
            if ($currentQ != intval($rawNewQ)) {
                $cart->adjustProductQuantity($e->getProduct()->getId(), (intval($rawNewQ)-$currentQ));
            }
        }
        
        if (!isset($_SESSION['cart_update_error'])) {
            $_SESSION['cart_update_message'] = 'Cart updated successfully!';
        }
    }
    
    // Redirect
    header('Location: index.php');
    exit();
}

include 'shop_template.php';

