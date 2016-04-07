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
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

$(document).ready(function() {
    $('#anticipated_order_date').datepicker({ minDate: 0, maxDate: "+1M" });
    $('#anticipated_delivery_date').datepicker({ minDate: 0, maxDate: "+12M" });
});


//todo: figure out with date validation
/*$.validator.addMethod("dateFormat", function (value, element) {
        return value.match(/^dd?\/dd?\/dddd$/);
    },
    "Please enter a date in the format dd-mm-yyyy."
);*/

$(function () {
    $('#bq_order_form').validate({
        rules: {
            job_specified: {
                required: true
            },
            bqemail: {
                required: true,
                email: true
            },
            order_probability: {
                required: true
            },
            estimated_order_date: {
                /*dateFormat: true,*/
                required: true,
            },
            estimated_delivery_date: {
                /*dateFormat: true,*/
                required: true,
            }
        },
        messages: {
            job_specified: {
                required: "<span class='validation_message'>Please select one of this</span>"
            },
            bqemail: {
                required: "<span class='validation_message'>This field is required</span>"
            },
            order_probability: {
                required: "<span class='validation_message'>Please select one of this</span>"
            },
            estimated_order_date: {
                required: "<span class='validation_message'>This field is required</span>"
            },
            estimated_delivery_date: {
                required: "<span class='validation_message'>This field is required</span>"
            }
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parents('.radio_wrapper'));
            error.appendTo(element.parents('.email_wrapper'));
            error.appendTo(element.parents('.select_wrapper'));
            error.appendTo(element.parents('.date_wrapper'));
        }
    });

});

function addProd2Cart(idProduct, idCombination, qty)
{    
    var result = $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: baseUri + '?rand=' + new Date().getTime(),
        async: false,
        cache: false,
        dataType : "json",
        data: 'controller=cart&add=1&ajax=true&qty=' + ((qty && qty != null) ? qty : '1') + '&id_product=' + idProduct + '&token=' + static_token + ( (parseInt(idCombination) && idCombination != null) ? '&ipa=' + parseInt(idCombination): ''),
        success: function(jsonData)
        {
            if(true == jsonData.hasError) {
                addProdErrors.push({errorMessage: jsonData.errors[0], idProd: idProduct, idAttribute: idCombination});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
            var error = "Impossible to add the product to the cart.<br/>textStatus: '" + textStatus + "'<br/>errorThrown: '" + errorThrown + "'<br/>responseText:<br/>" + XMLHttpRequest.responseText;
            addProdErrors.push({errorMessage: error, idProd: idProduct, idAttribute: idCombination});
        }
    }).responseText;
    result = jQuery.parseJSON(result);
    result = result.hasError;
    return result;
}

function resetCart(resetCartUrl)
{
    $.ajax({
        type: 'POST',
        url: resetCartUrl,
        async: true,
        cache: false,
        success: function()
        {
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
            
        }
    });
}