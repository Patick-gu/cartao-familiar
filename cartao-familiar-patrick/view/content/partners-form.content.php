<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle; ?></h6>
    </div>
    <div class="card-body">
        <form id="partnerForm" method="post" action="<?= isset($partner) ? 'parceiros/cadastro/edit/' . $partner['partner_id'] : 'parceiros/cadastro/create'; ?>">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($partner) ? $partner['name'] : ''; ?>" required placeholder="Nome">
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($partner) ? $partner['email'] : ''; ?>" required placeholder="E-mail">
                </div>
                <div class="col-md-6">
                    <label for="phone">Celular</label>
                    <input type="text" class="form-control cellphone_with_ddd" id="phone" name="phone" value="<?= isset($partner) ? $partner['phone'] : ''; ?>" required placeholder="Celular">
                </div>
            </div>
            <?php if (!isset($partner)) : ?>
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
                    <label for="type">Tipo</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">Selecione o tipo</option>
                        <option value="PJ" <?= isset($partner) && $partner['type'] == 'PJ' ? 'selected' : ''; ?>>CNPJ</option>
                        <option value="PF" <?= isset($partner) && $partner['type'] == 'PF' ? 'selected' : ''; ?>>CPF</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="cnpjGroup" <?= isset($partner) && !empty($partner['cnpj']) ? 'style="display: none;"' : ''; ?>>
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?= isset($partner) ? $partner['cnpj'] : ''; ?>" placeholder="CNPJ">
                    </div>
                    <div class="form-group" id="cpfGroup" <?= isset($partner) && !empty($partner['cpf']) ? 'style="display: none;"' : ''; ?>>
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?= isset($partner) ? $partner['cpf'] : ''; ?>" placeholder="CPF">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="zip_code">CEP</label>
                    <input type="text" class="form-control cep" id="zip_code" name="zip_code" value="<?= isset($partner) ? $partner['zip_code'] : ''; ?>" required placeholder="CEP">
                </div>
                <div class="col-md-6">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= isset($partner) ? $partner['address'] : ''; ?>" required placeholder="Endereço">
                </div>
                <div class="col-md-2">
                    <label for="number">Número</label>
                    <input type="text" class="form-control" id="number" name="number" value="<?= isset($partner) ? $partner['number'] : ''; ?>" required placeholder="Número">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="neighborhood">Bairro</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="<?= isset($partner) ? $partner['neighborhood'] : ''; ?>" required placeholder="Bairro">
                </div>
                <div class="col-md-5">
                    <label for="city">Cidade</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?= isset($partner) ? $partner['city'] : ''; ?>" required placeholder="Cidade">
                </div>
                <div class="col-md-2">
                    <label for="state">Estado</label>
                    <select class="form-control populate select2 uf" id="state" name="state">
                        <?= Helper::generateUfOptions(isset($partner) ? $partner['state'] : ''); ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex flex-column">
                    <div class="specialities">
                        <label for="specialty">Especialidades</label>
                        <select class="form-control populate select2 specialty" id="specialty" <?= $query= "SELECT * FROM`specialties` ORDER BY `name`"?> >
                        </select>

                    </div>
                    <div class="selected-specs mt-3">
                        <label for="spec_selected">Selecionadas</label>
                        <ul class="list-group" id="spec_selected">
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="services">
                        <label for="specialty">Exames & Serviços</label>
                        <select class="form-control populate select2 service" id="service">
                        </select>
                    </div>
                    <div class="selected-serv mt-3">
                        <label for="spec_selected">Selecionados</label>
                        <ul class="list-group" id="spec_selected">
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                            <li class="list-group-item"><input class="form-control" type="hidden" value="id" name="specialty_id[]" readonly>Teste</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Salvar <i class="fas fa-save"></i></button>
                    <a href="parceiros" class="btn btn-secondary">Cancelar <i class="fas fa-times"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Page level plugins -->
<script src="assets/js/partners-form.js"></script>