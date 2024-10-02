(function ($) {
    'use strict';

    var PartnerForm = {
        initialize: function () {
            this.$form = $('#partnerForm');
            this.applyMasks();
            this.bindEvents();
            this.initializeSpecialtySelect();
        },

        applyMasks: function () {
            $(".cellphone_with_ddd").mask("(00) 00000-0000");
            $(".cnpj").mask("00.000.000/0000-00", { reverse: true });
            $(".cpf").mask("000.000.000-00", { reverse: true });
            $(".cep").mask("00000-000");
        },

        bindEvents: function () {
            var _self = this;

            $('#partnerForm').on('submit', function (e) {
                e.preventDefault();
                _self.submitForm();
            });

            $('#type').on('change', function () {
                if (this.value === 'PJ') {
                    $('#cnpjGroup').show();
                    $('#cpfGroup').hide();
                } else if (this.value === 'PF') {
                    $('#cnpjGroup').hide();
                    $('#cpfGroup').show();
                } else {
                    $('#cnpjGroup').hide();
                    $('#cpfGroup').hide();
                }
            }).trigger('change');

            /*start: busca endereço pelo cep */
            this.$form.on('blur', '#zip_code', function (e) {
                var cep = $(this).val().replace(/[^\d]+/g, "");

                if (cep) {
                    $.ajax({
                        url: 'https://viacep.com.br/ws/' + cep + '/json/',
                        contentType: false,
                        processData: false,
                        method: 'GET',
                        headers: {
                            Accept: "application/json",
                        },
                        success: function (response) {
                            if (response && !response.erro) {
                                $('#neighborhood').val(response.bairro ?? '');
                                $('#city').val(response.localidade ?? '');
                                $('#address').val(response.logradouro ?? '');
                                $('#state').val(response.uf ?? '');
                                $('#number').focus();
                            } else {
                                var notice = new PNotify({
                                    title: 'CEP não localizado!',
                                    text: 'CEP ' + cep + ' não localizado, preencha o endereço completo.',
                                    type: 'error',
                                    addclass: 'stack-bottomleft',
                                    stack: stack_bottomleft
                                });
                            }
                        },
                    }).fail(function () {
                        var notice = new PNotify({
                            title: 'CEP não localizado!',
                            text: 'CEP ' + cep + ' não localizado, preencha o endereço completo.',
                            type: 'error',
                            addclass: 'stack-bottomleft',
                            stack: stack_bottomleft
                        });
                    });
                }
            })
            /*end: busca endereço pelo cep */
        },

        initializeSpecialtySelect: function () {
            var _self = this;

            // Inicializar o select2 com busca AJAX
            $('#specialty').select2({
                placeholder: 'Digite para buscar especialidades',
                minimumInputLength: 2,
                ajax: {
                    url: ServerRequest.getBaseUrl() + 'especialidades/find',
                    method: 'POST',
                    dataType: 'json',
                    delay: 250,
                    theme: 'form-control',
                    data: function (params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Adicionar a especialidade selecionada na lista
            $('#specialty').on('select2:select', function (e) {
                var selectedData = e.params.data;
                _self.addSelectedSpecialty(selectedData.id, selectedData.text);
            });
        },

        // Função para adicionar especialidade selecionada na lista
        addSelectedSpecialty: function (id, name) {
            var listItem = `<li class="list-group-item">
                                <input class="form-control" type="hidden" value="${id}" name="specialty_id[]" readonly>
                                ${name}
                                <button type="button" class="btn btn-danger btn-sm float-right remove-specialty">Remover</button>
                            </li>`;

            $('#spec_selected').append(listItem);

            // Função para remover especialidade
            $('.remove-specialty').on('click', function () {
                $(this).closest('li').remove();
            });
        },

        submitForm: function () {
            var $form = $('#partnerForm');
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                Main.showAlert('error', 'Erro!', 'As senhas não coincidem.');
                return;
            }

            var formData = new FormData($form[0]);
            var actionUrl = $form.attr('action');

            ServerRequest.request(actionUrl, 'POST', formData, function (err, response) {
                if (err) {
                    Main.showAlert('error', 'Erro!', 'Houve um problema ao cadastrar o parceiro.');
                } else {
                    if (response && response.success) {
                        Swal.fire(
                            'Cadastrado!',
                            'Operação realizada com sucesso.',
                            'success'
                        ).then(() => {
                            window.location.href = 'parceiros';
                        });
                    } else {
                        Main.showAlert('error', 'Erro!', response.message || 'Houve um problema ao tentar cadastrar o parceiro.');
                    }
                }
            });
        }
    };

    $(function () {
        PartnerForm.initialize();
    });

})(jQuery);
