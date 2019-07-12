define([
    'Magento_Ui/js/form/element/ui-select'
], function (Select) {
    'use strict';
    return Select.extend({
        /**
         * Parse tag and set it to options.
         *
         * @param {Object} tag - Response tag object.
         * @returns {Object}
         */
        setParsed: function (tag) {
            var option = this.parseData(tag);
            if (tag.error) {
                return this;
            }
            this.options([]);
            this.setOption(option);
            this.set('newOption', option);
            // error_log(print_r($this.options([]), 1));

        },

        /**
         * Normalize option object.
         *
         * @param {Object} tag - Option object.
         * @returns {Object}
         */
        parseData: function (tag) {
            return {
                value: tag.id,
                label: tag.code
            };
        }
    });
});