/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/*global define*/
define(
    [
        'ko',
        'Magento_Checkout/js/model/checkout-data-resolver'
    ],
    function (ko, checkoutDataResolver) {
        "use strict";
        var shippingRates = ko.observableArray([]);
        return {
            isLoading: ko.observable(false),
            /**
             * Set shipping rates
             *
             * @param ratesData
             */
            setShippingRates: function(ratesData) {
                shippingRates(ratesData);
                shippingRates.valueHasMutated();
                checkoutDataResolver.resolveShippingRates(ratesData);
                jQuery("form#co-shipping-method-form input:radio" ).trigger('click');
            },

            /**
             * Get shipping rates
             *
             * @returns {*}
             */
            getShippingRates: function() {
                return shippingRates;
            }
        };
    }
);
