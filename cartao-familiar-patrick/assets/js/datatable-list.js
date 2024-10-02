(function ($) {
    'use strict';

    var DataTableList = {
        initialize: function () {
            this.initDataTable();
            this.bindCustomControls();
        },

        initDataTable: function () {
            var table = $('#dataTableList').DataTable({
                dom: 'rt<"bottom"ip><"clear">',
                language: {
                    "decimal": "",
                    "emptyTable": "Nenhum dado disponível na tabela",
                    "info": "Mostrando _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "search": "Pesquisar:",
                    "zeroRecords": "Nenhum registro encontrado",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": ativar para classificar a coluna em ordem crescente",
                        "sortDescending": ": ativar para classificar a coluna em ordem decrescente"
                    }
                },
                responsive: true,
                pagingType: 'simple_numbers',
                info: true, // Enable the info
                lengthChange: false // Disable the default length change
            });

            this.table = table;

            // Move the pagination and info after table initialization
            this.movePaginationAndInfo();

            // Trigger initial draw to populate custom controls
            table.draw();
        },

        bindCustomControls: function () {
            var table = this.table;

            // Custom length menu change
            $('#dataTableList_length_custom select').on('change', function () {
                table.page.len($(this).val()).draw();
            });

            // Custom search
            $('#dataTableList_filter_custom input').on('keyup', function () {
                table.search($(this).val()).draw();
            });
        },

        movePaginationAndInfo: function () {
            var $pagination = $('#dataTableList_paginate');
            var $info = $('#dataTableList_info');

            if ($pagination.length) {
                $pagination.appendTo('#dataTableList_paginate_custom');
            }

            if ($info.length) {
                $info.appendTo('#dataTableList_info_custom');
            }
        }
    };

    window.DataTableList = DataTableList;

})(jQuery);
