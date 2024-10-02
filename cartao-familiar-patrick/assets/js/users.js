(function ($) {
    'use strict';

    var UsersModule = {
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

            // Event handler for deleting a user
            $(document).on('click', '.delete-user', function (e) {
                e.preventDefault();
                var userId = $(this).data('id');

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
                        _self.deleteUser(userId);
                    }
                });
            });
        },

        deleteUser: function (userId) {
            var formData = new FormData();
            formData.append('id', userId);

            ServerRequest.request('usuarios/delete', 'POST', formData, function (err, response) {
                if (err) {
                    Main.showAlert('error', 'Erro!', 'Houve um problema ao tentar excluir o usuário.');
                } else {
                    if (response && response.success) {
                        Swal.fire(
                            'Excluído!',
                            'O usuário foi excluído com sucesso.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Main.showAlert('error', 'Erro!', response.message || 'Houve um problema ao tentar excluir o usuário.');
                    }
                }
            });
        }
    };

    $(function () {
        UsersModule.initialize();
    });

})(jQuery);
