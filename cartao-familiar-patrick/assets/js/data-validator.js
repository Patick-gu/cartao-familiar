(function ($) {
    'use strict';

    var DataValidator = {
        validateCPF: function (cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf === '' || cpf.length !== 11) return false;

            var sum = 0, remainder;
            for (var i = 1; i <= 9; i++)
                sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
            remainder = (sum * 10) % 11;

            if ((remainder === 10) || (remainder === 11)) remainder = 0;
            if (remainder !== parseInt(cpf.substring(9, 10))) return false;

            sum = 0;
            for (i = 1; i <= 10; i++)
                sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
            remainder = (sum * 10) % 11;

            if ((remainder === 10) || (remainder === 11)) remainder = 0;
            if (remainder !== parseInt(cpf.substring(10, 11))) return false;
            return true;
        },

        validateEmail: function (email) {
            var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regex.test(email);
        }
    };

    window.DataValidator = DataValidator;

})(jQuery);
