(function ($) {
    'use strict';

    var ErrorHandler = {
        handle: function (xhr) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response && response.message) {
                    Main.showAlert('error', 'Erro', response.message);
                } else {
                    Main.showAlert('error', 'Erro desconhecido', 'Ocorreu um erro não identificado.');
                }
            } catch (e) {
                Main.showAlert('error', 'Erro', 'Resposta inválida do servidor.');
            }
        }
    };

    window.ErrorHandler = ErrorHandler;

})(jQuery);
