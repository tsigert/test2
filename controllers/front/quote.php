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

require_once _PS_MODULE_DIR_.'businessquotation/class/BusinessQuote.php';

class BusinessquotationQuoteModuleFrontController extends ModuleFrontController
{
    
    public function __construct($moduleName)
    {
        parent::__construct($moduleName);
    }
    
    public function postProcess()
    {
        if (Tools::getValue('action') == 'error') {
            return $this->displayError('An error occurred while trying to redirect the customer');
        } elseif (Tools::getValue('reset_cart')) {
            $this->context->cookie->__set('id_cart', '');
        } elseif (Tools::getValue('bqreference')) {
            $quote = new BusinessQuote(Tools::getValue('bqreference'));
            $bqProducts = $quote->getBqProducts();
            
            $this->context->smarty->assign(array(
                'bqproducts' => $bqProducts,
            ));
            return $this->setTemplate('addproducts.tpl');
        } else {
            $this->context->smarty->assign(array(
                'cart_id' => Context::getContext()->cart->id,
                'secure_key' => Context::getContext()->customer->secure_key,
                'bqemail' => Context::getContext()->customer->email,
            ));

            return $this->setTemplate('quote.tpl');
        }
    }

    protected function displayError($message, $description = false)
    {
        /**
         * Create the breadcrumb for your ModuleFrontController.
         */
        $this->context->smarty->assign('path', '
            <a href="'.$this->context->link->getPageLink('order', null, null, 'step=3').'">'.$this->module->l('Payment').'</a>
            <span class="navigation-pipe">&gt;</span>'.$this->module->l('Error'));

        /**
         * Set error message and description for the template.
         */
        array_push($this->errors, $this->module->l($message), $description);

        return $this->setTemplate('error.tpl');
    }
}
