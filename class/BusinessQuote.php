<?php
/**
 * 2015 - 2016 ProfSolution
 *
 * MODULE Business2Business
 *
 * @version   1.0.0
 * @author    ProfSolution <b2b@profsolution.net>
 * @link      http://profsolution.net
 * @copyright Copyright (c) permanent, ProfSolution
 * @license   Addons PrestaShop license limitation
 *
 * NOTICE OF LICENSE
 *
 * Don't use this module on several shops. The license provided by PrestaShop Addons
 * for all its modules is valid only once for a single shop.
 */

require_once dirname(__FILE__).'/BqCart.php';

class BusinessQuote extends ObjectModel
{
    public $context;
    
    public $productErrors = [];
    
    private $id_quote = '';
    private $bqreference = '';
    private $id_customer = '';
    private $id_cart = '';
    private $bqemail = '';
    private $job_specified = '';
    private $estimated_order_date = '';
    private $estimated_delivery_date = '';
    private $order_probability = '';
    private $date_add = '';
    private $date_upd = '';
    
    /**
     * Serialized
     * 
     * @var string
     */
    private $bq_cart = '';

    /**
     * Unserialized
     * 
     * @var string
     */
    private $bqCart = '';
    
    public function __construct($bqreference = '', $id_quote = '')
    {
        $this->context = Context::getContext();
        if ($bqreference) {
            $quote = $this->getQuoteByReference($bqreference);
        } elseif ($id_quote) {
            $quote = $this->getQuoteById($id_quote);
        }
        if (!empty($quote)) {
            foreach ($quote as $key => $value) {
                $this->$key = $value;
            }
            $this->bqCart = new BqCart(unserialize($this->bq_cart));
        }
    }
    
    public function saveQuote(array $bqData)
    {
        return Db::getInstance()->insert('module_quotes', $bqData);
    }
    
    private function getQuoteByReference($bqreference)
    {
        $sql = 'SELECT * FROM '._DB_PREFIX_.'module_quotes WHERE bqreference = "'.pSQL($bqreference).'" ORDER BY id_quote DESC';
        $result = DB::getInstance()->getRow($sql);
        return $result;
    }
    
    private function getQuoteById($id_quote)
    {
        $sql = 'SELECT * FROM '._DB_PREFIX_.'module_quotes WHERE id_quote = "'.pSQL($id_quote).'" ORDER BY id_quote DESC';
        $result = DB::getInstance()->getRow($sql);
        return $result;       
    }
    
    public function setCart($bqreference)
    {
        $id_cart = base64_decode($bqreference);
        if (!$this->checkCart($id_cart)) {
            return false;
        }
        $this->context->cookie->__set('id_cart', $id_cart);
        return true;
    }
    
    public function checkCart($id_cart)
    {
        $sql = 'SELECT id_cart FROM '._DB_PREFIX_.'cart WHERE id_cart = '.pSQL($id_cart);
        if (DB::getInstance()->getValue($sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getBqProducts()
    {        
        $bqProducts = $this->bqCart->products;
        
        $this->checkProductsChanges($bqProducts);
        if ($this->productErrors) {
            return false;
        }
        
        return $bqProducts;
    }
    
    public function checkProductsChanges($bqProducts)
    {
        
    }
}