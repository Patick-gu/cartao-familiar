 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Olá, <?= $_SESSION['user_name']; ?>!</h1>
     <?php if (SessionValidator::isAdmin()) : ?>
         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Baixar Relatório</a>
     <?php endif; ?>
 </div>

 <!-- Content Row -->
 <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                             R$ Faturas Geradas (<?= date('M'); ?>)</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800">R$ 4.000,00</div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-calendar fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-success shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                             Recebimentos (<?= date('M'); ?>)</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800">R$ 2.400,00</div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-info shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Recebimentos Completos
                         </div>
                         <div class="row no-gutters align-items-center">
                             <div class="col-auto">
                                 <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">60%</div>
                             </div>
                             <div class="col">
                                 <div class="progress progress-sm mr-2">
                                     <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Pending Requests Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-warning shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                             Clientes Ativos</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800">43</div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>

 <!-- Content Row -->

 <div class="row">

     <!-- Area Chart -->
     <div class="col-xl-8 col-lg-7">
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Cadastro de Clientes em <?= date('Y'); ?></h6>
             </div>
             <!-- Card Body -->
             <div class="card-body">
                 <div class="chart-area">
                     <canvas id="myAreaChart"></canvas>
                 </div>
             </div>
         </div>
     </div>

     <!-- Pie Chart -->
     <div class="col-xl-4 col-lg-5">
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Cadastro de Clientes por Plano</h6>
             </div>
             <!-- Card Body -->
             <div class="card-body">
                 <div class="chart-pie pt-4 pb-2">
                     <canvas id="myPieChart"></canvas>
                 </div>
                 <div class="mt-4 text-center small">
                     <span class="mr-2">
                         <i class="fas fa-circle text-primary"></i> Individual
                     </span>
                     <span class="mr-2">
                         <i class="fas fa-circle text-success"></i> Familiar
                     </span>
                     <span class="mr-2">
                         <i class="fas fa-circle text-info"></i> Master
                     </span>
                 </div>
             </div>
         </div>
     </div>

 </div>

 <!-- Content Row -->
 <div class="row">


 </div>

 <!-- Page level plugins -->
 <script src="assets/vendor/chart.js/Chart.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="assets/js/demo/chart-area-demo.js"></script>
 <script src="assets/js/demo/chart-pie-demo.js"></script>