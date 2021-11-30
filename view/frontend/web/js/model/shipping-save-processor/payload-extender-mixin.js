define([
	'jquery',
    'underscore',
    'mage/utils/wrapper'
], function (
	$,
    _,
    wrapper
) {
    'use strict';

    return function (payloadExtender) {
        return wrapper.wrap(payloadExtender, function (originalPayloadExtender, payload) {
            var newsletter = $('[name="newsletter_subscribe"]').prop("checked") == true ? 1 : 0;
            payload = originalPayloadExtender(payload);
                       
            _.extend(payload.addressInformation,{
                extension_attributes: {
                    'newsletter_subscribe': newsletter
                }   
            });
            return payload
        });
    };
});