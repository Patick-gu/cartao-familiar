(function ($) {
    'use strict';

    var customersModule = {
        initialize: function () {
            this.build();
            this.events();
        },

        build: function () {
            // Initialize DataTableList
            DataTableList.initialize();
        },

        events: function () {
            var _self = this;

            // Event handler for deleting a client
            $(document).on('click', '.delete-customer', function (e) {
                e.preventDefault();
                var customerId = $(this).data('id');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        _self.deleteCustomer(customerId);
                    }
                });
            });
        },

        deleteCustomer: function (customerId) {
            var formData = new FormData();
            formData.append('id', customerId);

            ServerRequest.request('clientes/delete', 'POST', formData, function (err, response) {
                if (err) {
                    Main.showAlert('error', 'Erro!', 'Houve um problema ao tentar excluir o cliente.');
                } else {
                    if (response && response.success) {
                        Swal.fire(
                            'Excluído!',
                            'O cliente foi excluído com sucesso.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Main.showAlert('error', 'Erro!', response.message || 'Houve um problema ao tentar excluir o cliente.');
                    }
                }
            });
        }
    };

    $(function () {
        customersModule.initialize();
    });

})(jQuery);