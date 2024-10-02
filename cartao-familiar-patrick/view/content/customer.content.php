<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-end mb-4">
    <?php if (SessionValidator::isAdmin()) : ?>
        <a href="clientes/cadastro" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-users fa-sm text-white-50"></i> Novo Cliente</a>
    <?php endif; ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista Completa</h6>
    </div>
    <div class="card-body">
        <!-- Custom DataTable Controls -->
        <div class="row mb-3">
            <div class="col-sm-12 col-md-2">
                <div class="dataTables_length d-flex flex-row align-items-center" id="dataTableList_length_custom">
                    <label class="m-0 mr-2">Mostrar</label>
                    <select name="dataTableList_length" aria-controls="dataTableList" class="custom-select custom-select-sm form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 offset-md-6 col-md-4 text-right">
                <div id="dataTableList_filter_custom" class="dataTables_filter d-flex flex-row align-items-center">
                    <label class="m-0 mr-2">Pesquisar: </label>
                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTableList">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableList" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Celular</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= $customer['customer_id']; ?></td>
                        <td><?= $customer['name']; ?></td>
                        <td><?= $customer['phone']; ?></td>
                        <td><?= $customer['email']; ?></td>
                        <td>
                            <a href="clientes/cadastro/<?= $customer['customer_id']; ?>" class="btn btn-warning btn-sm">Editar <i class="fas fa-pencil-alt"></i></a>
                            <a href="#" data-id="<?= $customer['customer_id']; ?>" class="btn btn-danger btn-sm delete-customer">Excluir <i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Celular</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <!-- Custom DataTable Pagination and Info -->
        <div class="row mt-3 datatables-header-footer-wrapper">
            <div class="col-sm-12 col-md-6">
                <div class="dataTables_info" id="dataTableList_info_custom" role="status" aria-live="polite"></div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                <div class="dataTables_paginate paging_simple_numbers pagination-wrapper" id="dataTableList_paginate_custom"></div>
            </div>
        </div>
    </div>
</div>

<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/datatable-list.js"></script>
<script src="assets/js/customers.js"></script>