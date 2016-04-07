<?php
/**
 * Created by PhpStorm.
 * User: tsiger
 * Date: 02.04.16
 * Time: 11:23
 */

class BqCart
{
    public $products = '';
    public $gift_products = '';
    public $discounts = '';
    public $total_discounts = '';
    public $total_discounts_tax_exc = '';
    public $total_wrapping = '';
    public $total_wrapping_tax_exc = '';
    public $total_shipping = '';
    public $total_shipping_tax_exc = '';
    public $total_products_wt = '';
    public $total_products = '';
    public $total_price = '';
    public $total_tax = '';
    public $total_price_without_tax = '';
    public $free_ship = '';
    
    public function __construct($summaryCart = null)
    {
        if ($summaryCart) {
            $this->summaryCart2BqCart($summaryCart);
        }
    }
    
    private function summaryCart2BqCart($summaryCart)
    {
        foreach($summaryCart as $key => $value)
        {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
    
    public function getProducts()
    {
        return $this->products;
    }
    
}