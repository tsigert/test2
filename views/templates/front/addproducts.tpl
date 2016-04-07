<script type="text/javascript">
    addProdErrors = new Array();
    $(document).ready(function() {
        {foreach $bqproducts as $bqproduct}
        var idProduct = "{$bqproduct['id_product']}";
        var idCombination = "{$bqproduct['id_product_attribute']}";
        var qty = "{$bqproduct['quantity']}";
        addProd2Cart(idProduct, idCombination, qty);
        {/foreach}
    });
    
    window.onload = function() {
        var index;
        var errorMessage = '';
        var endOfLine = ($.prototype.fancybox) ? "<br>" : "\n";
        for (index = 0; index < addProdErrors.length; index++) {
            errorMessage = errorMessage + 'Product: ' + addProdErrors[index].idProd + ', Attribute: ' + addProdErrors[index].idAttribute + ' - ' + addProdErrors[index].errorMessage + endOfLine;
            
        }
        
        if (errorMessage) {
            var resetCartUrl = "{$link->getModuleLink('businessquotation', 'quote', [], true)|escape:'html':'UTF-8'}?reset_cart=1"
            resetCart(resetCartUrl);
            if ($.prototype.fancybox) {
                $.fancybox.open([
                    {
                        type: 'inline',
                        autoScale: true,
                        minHeight: 300,
                        content: '<p class="fancybox-error">' + errorMessage + '</p>'
                    }],
                    {
                        padding: 20
                    });
            } else {
                alert(errorMessage);
            }
        }
            
        $( location ).attr("href", "/order");
    }
</script>