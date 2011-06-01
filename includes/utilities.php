<?php

function sendEmailToCustomer($customer, $subject, $body)
{
	// TODO - implement
}

function sendOrderConfirmationEmail($customer, $order, $subject, $body)
{
	// TODO - implement
}

function sendPromotionEmail($customer, $products, $subject, $body)
{
	// TODO - implement
}

function removeHyperlinks($html)
{
    // First attempt
    $newHtml = preg_replace('<a href=".*">', '', $html);
    $newHtml = str_replace('</a>', '', $newHtml);
    
    return $newHtml;
}









function MORE_removeHyperlinks($html)
{
    // First attempt
    $newHtml = preg_replace('<a href=".*">', '', $html);
    $newHtml = str_replace('</a>', '', $newHtml);
    
	// Fixed?
    $newHtml = preg_replace('/<a href=".*">/', '', $html);
    $newHtml = str_replace('</a>', '', $newHtml);
    
	// Fixed
    $newHtml = preg_replace('/<(a.*?)>/', '', $html);
    $newHtml = str_replace('</a>', '', $newHtml);
    
    // Improve?
	$newHtml = preg_replace('/<(a.*?)>(.*)</a>/is', '$2', $html);
    
	// Fix improved version
	$newHtml = preg_replace('/<(a.*?)>(.*)<\/a>/is', '$2', $html);
}
