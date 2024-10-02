<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center mb-4">
                        <img src="assets/img/logo.webp" alt="Aplicativo Cartão Familiar">
                    </div>
                    <form class="user">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="name" placeholder="Nome Completo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="email" class="form-control form-control-user" id="e-mail" placeholder="E-mail">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="phone" placeholder="Celular">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="cpf" placeholder="CPF">
                            </div>
                            <div class="col-sm-6">
                                <input type="date" class="form-control form-control-user" id="birth_date" placeholder="Data de Nascimento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password" placeholder="Senha">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="repeat_password" placeholder="Confirme sua senha">
                            </div>
                        </div>
                        <a href="login.html" class="btn btn-primary btn-user btn-block">
                            Cadastrar
                        </a>
                        <hr>
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Cadastrar com Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Cadastrar com Facebook
                        </a>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= BASE_URL; ?>login">Já tem uma conta? Entre aqui!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>