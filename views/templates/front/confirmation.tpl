{*
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
*}
<hr />
{if (isset($status) == true) && ($status == 'ok')}
<h3 class="successful">{l s='Your quote on %s is complete.' sprintf=$shop_name mod='businessquotation'}</h3>
<p> 
    <br /><br />
    <p>
        <a href="{$link->getModuleLink('businessquotation', 'quote', [], true)|escape:'html':'UTF-8'}?bqreference={$bqreference}">
            {l s='Link to your cart' mod='businessquotation'}
        </a>
    </p>
    <p>
        {l s='Also you will receive an email with link to your cart, so that you can pay your order when you will be ready!' mod='businessquotation'}
    </p>
    <br>
    <p>
        {l s='If you have questions, comments or concerns, please contact our' mod='businessquotation'}
        <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='expert customer support team.' mod='businessquotation'}</a>
    </p>
</p>
{else}
<h3 class="unsuccessful">{l s='Your quote on %s has not been accepted.' sprintf=$shop_name mod='businessquotation'}</h3>
<p>
    <br /><br />{l s='Please, contact to us.' mod='businessquotation'}
    <br /><br />{l s='If you have questions, comments or concerns, please contact our' mod='businessquotation'} 
    <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='expert customer support team.' mod='businessquotation'}</a>
</p>
{/if}
<hr />