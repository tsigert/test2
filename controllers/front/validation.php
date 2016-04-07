<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

require_once dirname(__FILE__).'/../../class/BusinessQuote.php';
require_once dirname(__FILE__).'/../../class/BqCart.php';
require_once dirname(__FILE__).'/../../class/Utility.php';

class BusinessquotationValidationModuleFrontController extends ModuleFrontController
{
    use MixedConstruct
    {
        MixedConstruct::__construct as private __mcConstruct;
    }
    
    public function __construct()
    {
        parent::__construct();
        $this->__mcConstruct();
    }
    
    /**
     * This class should be use by your Instant Payment
     * Notification system to validate the order remotely
     */
    public function postProcess()
    {
        
        //todo: make form validation
        
        /**
         * If the module is not active anymore, no need to process anything.
         */
        if ($this->module->active == false) {
            die;
        }
        
        $id_cart = $this->context->cookie->id_cart;
        $status = $this->isValidOrder($id_cart);
        $estimated_order_date = $this->utility->jqueryDate2MysqlDate(Tools::getValue('estimated_order_date'));
        $estimated_delivery_date = $this->utility->jqueryDate2MysqlDate(Tools::getValue('estimated_delivery_date'));
        
        $bqData = [
            'bqreference' => base64_encode($id_cart),
            'id_customer' => $this->context->cookie->id_customer,
            'id_cart' => $id_cart,
            'bqemail' => Tools::getValue('bqemail'),
            'job_specified' => Tools::getValue('job_specified'),
            'estimated_order_date' => $estimated_order_date,
            'estimated_delivery_date' => $estimated_delivery_date,
            'order_probability' => Tools::getValue('order_probability'),
            'bq_cart' => serialize($this->bqCart),
            'date_add' => date('Y-m-d H:i:s', time()),
            'date_upd' => date('Y-m-d H:i:s', time()),
        ];
        if ($status === true) {
            //$status = $this->businessQuote->saveQuote($bqData);
            //$this->context->cookie->__set('id_cart', '');
            $mailVars = array(
                '{customer}' => $this->context->customer->firstname . ' ' . $this->context->customer->lastname,
                '{content}' => Configuration::get('CONTENT_INVOICE_EMAIL')
            );
            $pdf = new PDF('', PDF::TEMPLATE_INVOICE, $this->context->smarty);
            $file_attachment['content'] = $pdf->render(false);
            //$inFilename = $order->getFilename('IN');
            $inFilename = 'someNameOfFile';
            $file_attachment['name'] = $inFilename . '.pdf';
            $file_attachment['mime'] = 'application/pdf';
            $res = Mail::Send(
                (int)$this->context->cart->id_lang,
                'invoice',
                Configuration::get('SUBJECT_INVOICE_EMAIL'),
                $mailVars,
                $this->context->customer->email,
                $this->context->customer->firstname  . ' ' . $this->context->customer->lastname,
                null,
                null,
                $file_attachment,
                null,
                _PS_MODULE_DIR_ . Configuration::get('BUSINESS2BUSINESS_NAME') . '/mails/',
                true,
                null
            );
        }
        
        
        $this->context->smarty->assign(array(
            'bqreference' => base64_encode($id_cart),
            'status' => $status,
        ));
        
        return $this->setTemplate('confirmation.tpl');
    }

    protected function isValidOrder($id_cart)
    {
        $result = true;
        if (!$id_cart) {
            $result = false;
        }
        
        return $result;
    }
}

trait MixedConstruct {
    
    protected $utility;
    protected $bqCart;
    protected $businessQuote;
    
    public function __construct() {
        $this->businessQuote = new BusinessQuote();
        $this->utility = new Utility();
        $cart = new Cart($this->context->cookie->id_cart);
        $summaryCart = $cart->getSummaryDetails();
        $this->bqCart = new BqCart($summaryCart);
        
    }
}