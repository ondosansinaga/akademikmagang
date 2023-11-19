<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="my-1">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_akunmahasiswa();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("akun/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-group "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Akun Mahasiswa</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_akundospem();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("dospem/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-user-secret "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Akun DosPem</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_statusmahasiswamagang();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("daftar_magang/Status_Mahasiswa_Magang") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-star-half-empty "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Status Mahasiswa Magang</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_mahasiswamagangaktif();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark p-4"  href="<?php print_link("daftar_magang/Mahasiswa_Magang_Aktif") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Mahasiswa Magang Aktif</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_mahasiswamagangselesai();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("daftar_magang/Mahasis_Telah_Selesai/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Mahasiswa Magang Selesai</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
