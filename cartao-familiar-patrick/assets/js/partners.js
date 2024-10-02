(function ($) {
    'use strict';

    var PartnersModule = {
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

            // Event handler for deleting a partner
            $(document).on('click', '.delete-partner', function (e) {
                e.preventDefault();
                var partnerId = $(this).data('id');

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
                        _self.deletePartner(partnerId);
                    }
                });
            });
        },

        deletePartner: function (partnerId) {
            var formData = new FormData();
            formData.append('id', partnerId);

            ServerRequest.request('parceiros/delete', 'POST', formData, function (err, response) {
                if (err) {
                    Main.showAlert('error', 'Erro!', 'Houve um problema ao tentar excluir o parceiro.');
                } else {
                    if (response && response.success) {
                        Swal.fire(
                            'Excluído!',
                            'O parceiro foi excluído com sucesso.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Main.showAlert('error', 'Erro!', response.message || 'Houve um problema ao tentar excluir o parceiro.');
                    }
                }
            });
        }
    };

    $(function () {
        PartnersModule.initialize();
    });

})(jQuery);
