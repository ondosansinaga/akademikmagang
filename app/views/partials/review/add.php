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
                    <h4 class="record-title">Add New Review</h4>
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
                        <form id="review-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("review/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-id_dospem"  value="<?php  echo $this->set_field_value('id_dospem',""); ?>" type="hidden" placeholder="Enter Id Dospem" list="id_dospem_list"  readonly required="" name="id_dospem"  class="form-control " />
                                    <datalist id="id_dospem_list">
                                        <?php 
                                        $id_dospem_options = $comp_model -> review_id_dospem_option_list();
                                        if(!empty($id_dospem_options)){
                                        foreach($id_dospem_options as $option){
                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                        ?>
                                        <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </datalist>
                                    <input id="ctrl-id_akun"  value="<?php echo $comp_model->review_id_akun_default_value() ?>" type="hidden" placeholder="Enter Id Akun" list="id_akun_list"  readonly required="" name="id_akun"  class="form-control " />
                                        <datalist id="id_akun_list">
                                            <?php 
                                            $id_akun_options = $comp_model -> review_id_akun_option_list();
                                            if(!empty($id_akun_options)){
                                            foreach($id_akun_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            ?>
                                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </datalist>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="nim">Nim <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-nim"  value="<?php echo $comp_model->review_nim_default_value() ?>" type="text" placeholder="Enter Nim"  readonly required="" name="nim"  class="form-control " />
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
                                                            <input id="ctrl-nama_mahasiswa"  value="<?php echo $comp_model->review_nama_mahasiswa_default_value() ?>" type="text" placeholder="Enter Nama Mahasiswa"  readonly required="" name="nama_mahasiswa"  class="form-control " />
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
                                                                <input id="ctrl-nama_dospem"  value="<?php echo $comp_model->review_nama_dospem_default_value() ?>" type="text" placeholder="Enter Nama Dospem"  readonly required="" name="nama_dospem"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="tanggal_review">Tanggal Review </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input id="ctrl-tanggal_review" class="form-control datepicker  datepicker"  value="<?php  echo $this->set_field_value('tanggal_review',""); ?>" type="datetime" name="tanggal_review" placeholder="Enter Tanggal Review" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="review_mahasiswa">Review Mahasiswa <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <textarea placeholder="Enter Review Mahasiswa" id="ctrl-review_mahasiswa"  required="" rows="5" name="review_mahasiswa" class=" form-control"><?php  echo $this->set_field_value('review_mahasiswa',""); ?></textarea>
                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="file_review">File Review </label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <div class="dropzone " input="#ctrl-file_review" fieldname="file_review"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".pdf" filesize="5" maximum="1">
                                                                            <input name="file_review" id="ctrl-file_review" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('file_review',""); ?>" type="text"  />
                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input id="ctrl-username_dosen"  value="<?php echo $comp_model->review_username_dosen_default_value() ?>" type="hidden" placeholder="Enter Username Dosen" list="username_dosen_list"  required="" name="username_dosen"  class="form-control " />
                                                                <datalist id="username_dosen_list">
                                                                    <?php 
                                                                    $username_dosen_options = $comp_model -> review_username_dosen_option_list();
                                                                    if(!empty($username_dosen_options)){
                                                                    foreach($username_dosen_options as $option){
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
