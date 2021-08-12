
define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals',

    ], function (ko, Component, quote, priceUtils, totals) {
        'use strict';

        var quoteTotals = quote.getTotals();
        var amount = quoteTotals() && totals.getSegment('donate') ? totals.getSegment('donate').value : 0;
        var donateAmount = ko.observable(amount);
        var formattedDonateAmount = ko.computed(function () {
            return priceUtils.formatPrice(donateAmount(), quote.getPriceFormat())
        });

        return Component.extend({
            defaults: {
                template: 'HanhBT_Donate/checkout/shipping/donate-amount'
            },
            donateAmount,
            formattedDonateAmount,
            removeDonate: function () {
                donateAmount(0);
            },
        });
    });
