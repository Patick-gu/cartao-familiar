(function ($) {
    'use strict';


    var ServerRequest = {
        // Função para verificar se está no localhost e definir a base URL
        getBaseUrl: function () {
            var hostname = window.location.hostname;
            if (hostname === 'localhost') {
                return 'http://localhost/TRABALHOS/cartao-familiar-patrick/';
            } else {
                // Defina aqui a URL base para o ambiente de produção
                return 'https://www.app.cartaofamiliar.com/';
            }
        },

        request: function (url, method, formData, callback) {
            // Prefixa a URL com a base URL
            var fullUrl = this.getBaseUrl() + url;

            $.ajax({
                url: fullUrl,
                method: method,
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    if (callback) callback(null, response);
                },
                error: function (xhr) {
                    ErrorHandler.handle(xhr);
                }
            });
        }
    };

    window.ServerRequest = ServerRequest;

})(jQuery);
