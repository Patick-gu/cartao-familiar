(function ($) {
    'use strict';

    var UserForm = {
        initialize: function () {
            this.applyMasks();
            this.bindEvents();
        },

        applyMasks: function () {
            $(".cellphone_with_ddd").mask("(00) 00000-0000");
        },

        bindEvents: function () {
            var _self = this;
            $('#userForm').on('submit', function (e) {
                e.preventDefault();
                _self.submitForm();
            });
        },

        submitForm: function () {
            var $form = $('#userForm');
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                Main.showAlert('error', 'Erro!', 'As senhas não coincidem.');
                return;
            }

            var formData = new FormData($form[0]);

            var actionUrl = $form.attr('action');

            ServerRequest.request(actionUrl, 'POST', formData, function (err, response) {
                console.log(err, response)
                if (err) {
                    Main.showAlert('error', 'Erro!', 'Houve um problema ao cadastrar o usuário.');
                } else {
                    if (response && response.success) {
                        Swal.fire(
                            'Cadastrado!',
                            'Operação realizada com sucesso.',
                            'success'
                        ).then(() => {
                            window.location.href = 'usuarios';
                        });
                    } else {
                        Main.showAlert('error', 'Erro!', response.message || 'Houve um problema ao tentar cadastrar o usuário.');
                    }
                }
            });
        }
    };

    $(function () {
        UserForm.initialize();
    });

})(jQuery);
