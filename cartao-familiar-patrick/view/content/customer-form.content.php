<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle; ?></h6>
    </div>
    <div class="card-body">
        <form id="customerForm" method="post" action="<?= isset($customer) ? 'clientes/cadastro/edit/' . $customer['customer_id'] : 'clientes/cadastro/create'; ?>">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($customer) ? $customer['name'] : ''; ?>" required placeholder="Nome">
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($customer) ? $customer['email'] : ''; ?>" required placeholder="E-mail">
                </div>
                <div class="col-md-6">
                    <label for="phone">Celular</label>
                    <input type="text" class="form-control cellphone_with_ddd" id="phone" name="phone" value="<?= isset($customer) ? $customer['phone'] : ''; ?>" required placeholder="Celular">
                </div>
            </div>
            <?php if (!isset($customer)) : ?>
                <div class="form-group row">
                    <div class="col-md-6 position-relative">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Senha">
                        <button type="button" class="btn btn-link btn-show-password" data-target="password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="confirm_password">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Confirmar Senha">
                        <button type="button" class="btn btn-link btn-show-password" data-target="confirm_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-group" id="cpfGroup" <?= isset($customer) && !empty($customer['cpf']) ? 'style="display: none;"' : ''; ?>>
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?= isset($customer) ? $customer['cpf'] : ''; ?>" placeholder="CPF">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="birthGroup" <?= isset($customer) && !empty($customer['birth_id']) ? 'style="display: none;"' : ''; ?>>
                        <label for="date">Data de Nascimento</label>
                        <input type="date" class="form-control date" id="date" name="date" value="<?= isset($customer) ? $customer['birth_id'] : ''; ?>" placeholder="data">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="zip_code">CEP</label>
                    <input type="text" class="form-control cep" id="zip_code" name="zip_code" value="<?= isset($customer) ? $customer['zip_code'] : ''; ?>" required placeholder="CEP">
                </div>
                <div class="col-md-6">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= isset($customer) ? $customer['address'] : ''; ?>" required placeholder="Endereço">
                </div>
                <div class="col-md-2">
                    <label for="number">Número</label>
                    <input type="text" class="form-control" id="number" name="number" value="<?= isset($customer) ? $customer['number'] : ''; ?>" required placeholder="Número">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="neighborhood">Bairro</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="<?= isset($customer) ? $customer['neighborhood'] : ''; ?>" required placeholder="Bairro">
                </div>
                <div class="col-md-5">
                    <label for="city">Cidade</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?= isset($customer) ? $customer['city'] : ''; ?>" required placeholder="Cidade">
                </div>
                <div class="col-md-2">
                    <label for="state">Estado</label>
                    <select class="form-control populate select2 uf" id="state" name="state">
                        <?= Helper::generateUfOptions(isset($customer) ? $customer['state'] : ''); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="plan">PLANO</label>
                    <select class="form-control populate select2" id="plan" name="plan">
                        <?= Helper::getAllPlans(isset($customer) ? $customer['plan_id'] : ''); ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="neighborhood">instagram</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?= isset($customer) ? $customer['instagram'] : ''; ?>" required placeholder="instagram">
                </div>
                <div class="col-md-3">
                    <label for="facebook">facebook</label>
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?= isset($customer) ? $customer['facebook'] : ''; ?>" required placeholder="facebook">
                </div>
                <div class="col-md-3">
                    <label for="tiktok">tiktok</label>
                    <input type="text" class="form-control" id="tiktok" name="tiktok" value="<?= isset($customer) ? $customer['tiktok'] : ''; ?>" required placeholder="tiktok">
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Salvar <i class="fas fa-save"></i></button>
                    <a href="homer" class="btn btn-secondary">Cancelar <i class="fas fa-times"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Page level plugins -->
<script src="assets/js/customer-form.js"></script>