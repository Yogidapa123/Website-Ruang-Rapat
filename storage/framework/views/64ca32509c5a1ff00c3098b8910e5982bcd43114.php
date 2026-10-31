 <!--====== HEADER PART START ======-->
 <header class="header_area">
     <div id="header_navbar" class="header_navbar">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-xl-12">
                     <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.html">
                            <img id="logo" class="logo-pemkab" src="<?php echo e(asset('assets/images/Logo Pemkab Malang.png')); ?>" alt="Logo">
                        </a>
                         <a class="navbar-brand" href="index.html">
                             <img id="logo" src="<?php echo e(asset('assets/images/Logo Malang Makmur.png')); ?>" alt="Logo">
                         </a>
                        
                         <button class="navbar-toggler" type="button" data-toggle="collapse"
                             data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                             aria-expanded="false" aria-label="Toggle navigation">
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                         </button>
                         <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a href="/" class="text-red">Home</a>
                                </li>
                                <?php if(auth()->guard()->check()): ?>
                                    <li class="nav-item">
                                        <a href="/daftarruang" class="text-red">Daftar Ruang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/daftarpinjam" class="text-red">Daftar Peminjaman</a>
                                    </li>
                                    <form action="/logout" method="post">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn border border-white rounded-pill text-red">
                                            <i class="bi bi-box-arrow-right">Logout</i> 
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <li class="nav-item">
                                        <a class="header-btn btn-hover text-red" href="/login">Login</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                         </div> <!-- navbar collapse -->
                     </nav> <!-- navbar -->
                 </div>
             </div> <!-- row -->
         </div> <!-- container -->
     </div> <!-- header navbar -->
 </header>
 <!--====== HEADER PART ENDS ======-->
 
<?php /**PATH C:\laragon\www\web-pinjam-ruang-main-20250923T141746Z-1-001\web-pinjam-ruang-main\web-pinjam-ruang-main\resources\views/partials/navbar.blade.php ENDPATH**/ ?>