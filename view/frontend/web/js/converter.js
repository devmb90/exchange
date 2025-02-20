define([
    'ko',
    'jquery',
    'uiComponent',
    'mage/translate'
], function (ko, $, Component, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Bonecki_CurrencyExchange/converter',
            loading: ko.observable(false),
            errorMessage: ko.observable(''),
            amount: ko.observable(''),
            convertedAmount: ko.observable(''),
            showResult: ko.observable(false)
        },

        convertManual: function () {
            if (!this.amount() || isNaN(this.amount())) {
                this.errorMessage($t('Please enter a valid number'));
                this.showResult(false);
                return;
            }

            this.loading(true);
            this.errorMessage('');
            this.showResult(false);

            $.ajax({
                url: this.apiUrl+"?param="+this.amount(),
                type: 'GET',
                dataType: 'json'
            }).done(function (response) {
                this.convertedAmount(response);
                this.showResult(true);
            }.bind(this)).fail(function (jqXHR) {
                this.errorMessage($t('Error: ') + (jqXHR.responseJSON.message));
                this.showResult(false);
            }.bind(this)).always(function () {
                this.loading(false);
            }.bind(this));
        }
    });
});
