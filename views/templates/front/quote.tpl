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

<div id="bq">

    <hr>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        {l s='Your order will now be converted from a purchase into an official quote. ' mod='businessquotation'}
                    </h3>
                </div>
                <div class="panel-body">
                    <form id="bq_order_form" action="{$link->getModuleLink('businessquotation', 'validation', [], true)|escape:'html':'UTF-8'}" role="form" method="post">
                        
                        <div class="row_group">
                            <div class="col-sm-8">
                                <p class="description_block">{l s='Please select an e-mail address to have this request e-mailed to.' mod='businessquotation'}</p>
                            </div>
                            <div class="col-sm-4 email_wrapper">
                                <div class="input-group">
                                    <div class="input-group-addon">@</div>
                                    <input name="bqemail" type="text" class="form-control" id="bqemail" placeholder="Email" value="{$bqemail}" >
                                </div>
                            </div>
                        </div>
                            
                        <div class="row_group">
                            <div class="col-sm-9">
                                <p class="description_block">Is this quote for a job where the product is specified?</p>
                            </div>
                            <div class="col-sm-3 radio_wrapper">
                                <div class="prof-box prof-radio">
                                    <input id="radio2" class="attribute_radio" type="radio" name="job_specified" value="1">
                                    <span>{l s='No' mod='businessquotation'}</span>
                                    <label for="radio2">
                                        <span>
                                            <span></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="prof-box prof-radio">
                                    <input id="radio1" class="attribute_radio" type="radio" name="job_specified" value="2">
                                    <span>{l s='Yes' mod='businessquotation'}</span>
                                    <label for="radio1">
                                        <span>
                                            <span></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row_group">
                            <div class="col-sm-8">
                                <p class="description_block">{l s='What is the date you anticipate ordering (estimate if necessary)?' mod='businessquotation'}</p>
                            </div>
                            <div class="col-sm-4 date_wrapper">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <input name="estimated_order_date" type="text" class="form-control" id="anticipated_order_date">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row_group">
                            <div class="col-sm-8">
                                <p class="description_block">{l s='What is the approximate date you will require the product to be delivered (estimate if necessary)?' mod='businessquotation'}</p>
                            </div>
                            <div class="col-sm-4 date_wrapper">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <input name="estimated_delivery_date" type="text" class="form-control" id="anticipated_delivery_date">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row_group">
                            <div class="col-sm-8">
                                <p class="description_block">{l s='Rate your confidence that you anticipate placing this order (helps to anticipate production)' mod='businessquotation'}</p>
                            </div>
                            <div class="col-sm-4 select_wrapper">
                                <div class="input-group">
                                    <select name="order_probability" class="">
                                        <option value="">-- --</option>
                                        <option value="1">Very Confident</option>
                                        <option value="2">Confident</option>
                                        <option value="3">Not Confident</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row_group">
                            <button type="submit" class="btn btn-success">{l s='Submit' mod='businessquotation'}</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>