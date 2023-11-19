<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Laporan Akhir</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="laporan_akhir-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("laporan_akhir/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-id_akun"  value="<?php echo $comp_model->laporan_akhir_id_akun_default_value() ?>" type="hidden" placeholder="Enter Id Akun"  required="" name="id_akun"  class="form-control " />
                                    <input id="ctrl-id_dospem"  value="<?php echo $comp_model->laporan_akhir_id_dospem_default_value() ?>" type="hidden" placeholder="Enter Id Dospem"  required="" name="id_dospem"  class="form-control " />
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="nim">Nim <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-nim"  value="<?php echo $comp_model->laporan_akhir_nim_default_value() ?>" type="text" placeholder="Enter Nim"  readonly required="" name="nim"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="nama_mahasiswa">Nama Mahasiswa <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-nama_mahasiswa"  value="<?php echo $comp_model->laporan_akhir_nama_mahasiswa_default_value() ?>" type="text" placeholder="Enter Nama Mahasiswa"  readonly required="" name="nama_mahasiswa"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="nama_dospem">Nama Dospem <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-nama_dospem"  value="<?php echo $comp_model->laporan_akhir_nama_dospem_default_value() ?>" type="text" placeholder="Enter Nama Dospem"  readonly required="" name="nama_dospem"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="file_laporan">File Laporan <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <div class="dropzone required" input="#ctrl-file_laporan" fieldname="file_laporan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".pdf" filesize="5" maximum="1">
                                                                        <input name="file_laporan" id="ctrl-file_laporan" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('file_laporan',""); ?>" type="text"  />
                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input id="ctrl-username_dospem"  value="<?php echo $comp_model->laporan_akhir_username_dospem_default_value() ?>" type="hidden" placeholder="Enter Username Dospem" list="username_dospem_list"  required="" name="username_dospem"  class="form-control " />
                                                            <datalist id="username_dospem_list">
                                                                <?php 
                                                                $username_dospem_options = $comp_model -> laporan_akhir_username_dospem_option_list();
                                                                if(!empty($username_dospem_options)){
                                                                foreach($username_dospem_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                ?>
                                                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                        <div class="form-group form-submit-btn-holder text-center mt-3">
                                                            <div class="form-ajax-status"></div>
                                                            <button class="btn btn-primary" type="submit">
                                                                Submit
                                                                <i class="fa fa-send"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
