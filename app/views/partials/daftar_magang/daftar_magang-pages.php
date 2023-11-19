    <?php
    $comp_model = new SharedController;
    $view_data = $this->view_data; //array of all  data passed from controller
    $field_name = $view_data['field_name'];
    $field_value = $view_data['field_value'];
    $form_data = $this->form_data; //request pass to the page as form fields values
    $can_view = ACL::is_allowed("daftar_magang/view/$field_value");$can_status_mahasiswa_magang = ACL::is_allowed("daftar_magang/status_mahasiswa_magang/id_akun/$field_value");
    $page_id = random_str(6);
    ?>
    <div class="master-detail-page">
        <div class="card-header p-0 pt-2 px-2">
            <ul class="nav nav-tabs">
                <?php if($can_view){ ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#daftar_magang_daftar_magang_View_<?php echo $page_id ?>" class="nav-link active">
                        View
                    </a>
                </li>
                <?php } ?>
                <?php if($can_status_mahasiswa_magang){ ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#daftar_magang_daftar_magang_Status_Mahasiswa_Magang_<?php echo $page_id ?>" class="nav-link ">
                        Status Mahasiswa Magang
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-content">
            <?php if($can_view){ ?>
            <div class="tab-pane fade show active show" id="daftar_magang_daftar_magang_View_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("daftar_magang/view/$field_value"); ?>
            </div>
            <?php } ?>
            <?php if($can_status_mahasiswa_magang){ ?>
            <div class="tab-pane fade show " id="daftar_magang_daftar_magang_Status_Mahasiswa_Magang_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("daftar_magang/status_mahasiswa_magang/id_akun/$field_value"); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    