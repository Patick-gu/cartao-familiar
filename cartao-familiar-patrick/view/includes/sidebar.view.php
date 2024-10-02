 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
         <div class="sidebar-brand-icon">
             <img class="w-90" src="assets/img/logo-white.png" alt="Cartão Familiar">
         </div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Home -->
     <li class="nav-item active">
         <a class="nav-link" href="home">
             <i class="fas fa-house-user"></i>
             <span>Home</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Menu Principal
     </div>


     <?php if (SessionValidator::isAdmin()) : ?>

         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Heading -->
         <div class="sidebar-heading">
             Menu Admin
         </div>

         <!-- Nav Item - Parceiros -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                 <i class="fas fa-users"></i>
                 <span>Usuários</span>
             </a>
             <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="usuarios/cadastro">Cadastro</a>
                     <a class="collapse-item" href="usuarios">Listagem</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - Parceiros -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePartners" aria-expanded="true" aria-controls="collapsePartners">
                 <i class="fas fa-clinic-medical"></i>
                 <span>Parceiros</span>
             </a>
             <div id="collapsePartners" class="collapse" aria-labelledby="headingPartners" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="parceiros/cadastro">Cadastro</a>
                     <a class="collapse-item" href="parceiros">Listagem</a>
                 </div>
             </div>
         </li>

         <!-- Nav Item - clientes -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomers" aria-expanded="true" aria-controls="collapseCustomers">
                 <i class="fas fa-user"></i>
                 <span>Clientes</span>
             </a>
             <div id="collapseCustomers" class="collapse" aria-labelledby="headingCustomers" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="clientes/cadastro">Cadastro</a>
                     <a class="collapse-item" href="clientes">Listagem</a>
                 </div>
             </div>
         </li>

     <?php endif; ?>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">


     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->