define([
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils',
    'Magento_Checkout/js/model/totals'

], function (ko, Component, quote, priceUtils, totals) {
    'use strict';

    return Component.extend({
        totals: quote.getTotals(),

        getValue: function () {
            var price = 0;

            if (this.totals()) {
                price = totals.getSegment('donate').value;
            }

            return priceUtils.formatPrice(price, quote.getPriceFormat());
        },
        isDisplayed: function () {
            return this.getValue() != 0;
        },
    });
});
