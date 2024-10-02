(function ($) {
    'use strict';

    var FormLogin = {

        initialize: function () {
            this.$form = $('#form-login');
            this.$userInput = $('#user');
            this.$passwordInput = $('#password');
            this.$rememberCheckbox = $('#remember');

            this.loadCredentials();
            this.build();
        },

        build: function () {
            this.formEvents();
            this.autoMaskInput();
        },

        formEvents: function () {
            var _self = this;

            /** start: envio do formulario */
            this.$form.on('submit', function (event) {
                event.preventDefault();

                var emailOrCpf = _self.$userInput.val();
                var password = _self.$passwordInput.val();

                if (!emailOrCpf || !password) {
                    Main.showAlert('error', 'Erro!', 'Por favor, preencha todos os campos.');
                    return;
                }

                if (emailOrCpf.includes('@')) {
                    if (!DataValidator.validateEmail(emailOrCpf)) {
                        Main.showAlert('error', 'Erro!', 'E-mail inválido.');
                        return;
                    }
                } else {
                    if (!DataValidator.validateCPF(emailOrCpf)) {
                        Main.showAlert('error', 'Erro!', 'CPF inválido.');
                        return;
                    }
                }

                var formData = new FormData();
                formData.append('emailOrCpf', emailOrCpf);
                formData.append('password', password);

                ServerRequest.request('login/do', 'POST', formData, function (err, response) {
                    if (err) {
                        Main.showAlert('error', 'Erro!', 'Houve um problema ao fazer login.');
                    } else {
                        if (response && response.success) {
                            window.location.href = 'home';
                        } else {
                            Main.showAlert('error', 'Erro!', response.message || 'Erro ao fazer login.');
                        }
                    }
                });
            });
            /** end: envio do formulario */

            this.$rememberCheckbox.on('change', function () {
                if ($(this).is(':checked')) {
                    localStorage.setItem('userEmailOrCpf', _self.$userInput.val());
                    localStorage.setItem('userPassword', _self.$passwordInput.val());
                    localStorage.setItem('rememberMe', 'true');
                } else {
                    localStorage.removeItem('userEmailOrCpf');
                    localStorage.removeItem('userPassword');
                    localStorage.removeItem('rememberMe');
                }
            });
        },

        loadCredentials: function () {
            if (localStorage.getItem('rememberMe') === 'true') {
                this.$userInput.val(localStorage.getItem('userEmailOrCpf'));
                this.$passwordInput.val(localStorage.getItem('userPassword'));
                this.$rememberCheckbox.prop('checked', true);
            }
        },

        autoMaskInput: function () {
            this.$userInput.on('input', function () {
                var value = $(this).val().replace(/\D/g, '');
                if (value.length <= 11) {
                    if (value.length === 0) {
                        $(this).unmask();
                    } else {
                        $(this).mask('000.000.000-00', { reverse: false });
                    }
                } else {
                    $(this).unmask();
                }
            });
        },

        destroy: function () {
            var _self = this;
            let $formLogin = this.$form;

            $formLogin.trigger('reset');
        },

    };

    $(function () {
        FormLogin.initialize();
    });

})(jQuery);
