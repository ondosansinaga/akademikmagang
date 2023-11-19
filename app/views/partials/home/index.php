<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-6 order-12 order-md-1 px-5 px-md-2 comp-grid">
                    <div class=""><div class="class">
                        <!-- PAGE TITLE AND SUB -->
                        <h1 class="display-4 bold mb-3"><?php echo SITE_NAME;?></h1>
                        <h4 class="mb-4">Selamat Datang di <?php echo SITE_NAME;?></h4>
                        <div class="font-nm mb-4">
                            Dengan magang anda mendapat pengalaman dalam berkiprah di dunia kerja.Bukan 
                            hanya itu saja melainkan mendapat banyak koneksi. Yuk tunggu apalagi !
                        </div>
                        <!-- BUTTON PAGE -->
                        <div>
                            <a href="daftar_magang" class="btn btn-lg rounded btn-primary">Daftar Magang</a>
                        </div>
                    </div></div>
                </div>
                <div class="col-md-6 order-11 comp-grid">
                    <div class=""><div class="col-12">
                        <img src="assets/images/image1.png" height="100%" width="100%">
                        </div></div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <div class=""><div class="col-12 my-5">
                            <h4 class="display-4 bold mb-3 text-center">PROGRAM FAKULTAS SAINS & TEKNOLOGI</h4>
                            <h4 class="mb-4 text-center">Berikut daftar program yang dapat anda lakukan guna menunjang Mata Kuliah</h4>
                            <p class="text-center font-nm">
                                Program ini didukung penuh oleh fakultas dan begitu juga dengan Pemerintah seperti KEMDIKBUD dan jajaran-jajarannya.
                            </p>     
                        </div></div>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class=""><div class="col-12 row mt-4">
                            <!-- CARD HOLDER -->
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                    <div class="mt-3 mb-4">
                                        <img class="icon-user p-3 alert-warning rounded-circle"
                                            src="assets/images/kampus_merdeka_logo.png" height="50%" width="50%"style="object-fit: cover;" >
                                        </div>
                                        <div class="bold font-nm">PROGRAM MBKM</div>
                                        <div class="mb-4">Kampus Merdeka adalah program yang dicanangkan oleh Menteri Pendidikan dan Kebudayaan yang bertujuan mendorong mahasiswa untu menguasai berbagai keilmuan untuk bekal memasuki dunia kerja.</div>
                                        <div class=""style="padding-bottom: 20px;">
                                            <a href="https://kampusmerdeka.kemdikbud.go.id/web/about/latar-belakang" target="_blank" class="btn btn-outline-warning">Lebih Lanjut</a>
                                        </div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
