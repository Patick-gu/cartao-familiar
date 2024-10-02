 <!-- Outer Row -->
 <div class="row justify-content-center align-items-center">

     <div class="col-xl-10 col-lg-12 col-md-9">

         <div class="card o-hidden border-0 shadow-lg my-5">
             <div class="card-body p-0">
                 <!-- Nested Row within Card Body -->
                 <div class="row">
                     <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                     <div class="col-lg-6">
                         <div class="p-5">
                             <div class="text-center mb-4">
                                 <img src="assets/img/logo.webp" alt="Aplicativo Cartão Familiar">
                             </div>
                             <form class="user" id="form-login">
                                 <div class="form-group">
                                     <input type="text" class="form-control form-control-user" name="user" id="user" aria-describedby="emailHelp" placeholder="Seu E-mail ou CPF">
                                 </div>
                                 <div class="form-group">
                                     <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Sua Senha">
                                 </div>
                                 <div class="form-group">
                                     <div class="custom-control custom-checkbox small">
                                         <input type="checkbox" class="custom-control-input" id="remember">
                                         <label class="custom-control-label" for="remember">Lembrar-me</label>
                                     </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary btn-user btn-block">
                                     Entrar
                                 </button>
                                 <hr>
                                 <a href="index.html" class="btn btn-google btn-user btn-block">
                                     <i class="fab fa-google fa-fw"></i> Entrar com Google
                                 </a>
                                 <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                     <i class="fab fa-facebook-f fa-fw"></i> Entrar com Facebook
                                 </a>
                             </form>
                             <hr>
                             <div class="text-center">
                                 <a class="small" href="<?= BASE_URL; ?>esqueci-minha-senha">Esqueceu sua senha?</a>
                             </div>
                             <div class="text-center">
                                 <a class="small" href="<?= BASE_URL; ?>cadastre-se">Crie sua conta!</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

     </div>

 </div>

 <!-- Custom script -->
 <script src="assets/js/login.js"></script>