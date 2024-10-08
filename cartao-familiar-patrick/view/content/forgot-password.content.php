 <!-- Outer Row -->
 <div class="row justify-content-center">

     <div class="col-xl-10 col-lg-12 col-md-9">

         <div class="card o-hidden border-0 shadow-lg my-5">
             <div class="card-body p-0">
                 <!-- Nested Row within Card Body -->
                 <div class="row">
                     <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                     <div class="col-lg-6">
                         <div class="p-5">
                             <div class="text-center mb-4">
                                 <img src="assets/img/logo.webp" alt="Aplicativo Cartão Familiar">
                             </div>
                             <div class="text-center">
                                 <h1 class="h4 text-gray-900 mb-2">Esqueceu sua senha?</h1>
                                 <p class="mb-4">Basta inserir seu endereço de e-mail abaixo e enviaremos um link para você redefinir sua senha!</p>
                             </div>
                             <form class="user">
                                 <div class="form-group">
                                     <input type="email" class="form-control form-control-user" id="e-mail" aria-describedby="emailHelp" placeholder="Seu E-mail">
                                 </div>
                                 <a href="login.html" class="btn btn-primary btn-user btn-block">
                                     Redefinir Senha
                                 </a>
                             </form>
                             <hr>
                             <div class="text-center">
                                 <a class="small" href="<?= BASE_URL; ?>cadastre-se">Crie sua conta!</a>
                             </div>
                             <div class="text-center">
                                 <a class="small" href="<?= BASE_URL; ?>login">Já tem uma conta? Entre aqui!</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

     </div>

 </div>