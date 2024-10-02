<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle = 'Title of Page'?></h6>
    </div>
    <div class="card-body">
        <form id="userForm" method="post" action="<?= isset($user) ? 'usuarios/cadastro/edit/' . $user['user_id'] : 'usuarios/cadastro/create'; ?>">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($user) ? $user['name'] : ''; ?>" required>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($user) ? $user['email'] : ''; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="cell_phone">Celular</label>
                    <input type="text" class="form-control cellphone_with_ddd" id="cell_phone" name="cell_phone" value="<?= isset($user) ? $user['cell_phone'] : ''; ?>" required>
                </div>
            </div>
            <?php if (!isset($user)) : ?>
                <div class="form-group row">
                    <div class="col-md-6 position-relative">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-link btn-show-password" data-target="password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="confirm_password">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="btn btn-link btn-show-password" data-target="confirm_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-end">
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Salvar <i class="fas fa-save"></i></button>
                    <a href="usuarios" class="btn btn-secondary">Cancelar <i class="fas fa-times"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Page level plugins -->
<script src="assets/js/users-form.js"></script>