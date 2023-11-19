<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("review/add");
$can_edit = ACL::is_allowed("review/edit");
$can_view = ACL::is_allowed("review/view");
$can_delete = ACL::is_allowed("review/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Review</h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_review']) ? urlencode($data['id_review']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_review">
                                        <th class="title"> Review Ke: </th>
                                        <td class="value"> <?php echo $data['id_review']; ?></td>
                                    </tr>
                                    <tr  class="td-nim">
                                        <th class="title"> Nim: </th>
                                        <td class="value"> <?php echo $data['nim']; ?></td>
                                    </tr>
                                    <tr  class="td-nama_mahasiswa">
                                        <th class="title"> Nama Mahasiswa: </th>
                                        <td class="value"> <?php echo $data['nama_mahasiswa']; ?></td>
                                    </tr>
                                    <tr  class="td-nama_dospem">
                                        <th class="title"> Nama Dospem: </th>
                                        <td class="value"> <?php echo $data['nama_dospem']; ?></td>
                                    </tr>
                                    <tr  class="td-tanggal_review">
                                        <th class="title"> Tanggal Review: </th>
                                        <td class="value"> <?php echo $data['tanggal_review']; ?></td>
                                    </tr>
                                    <tr  class="td-review_mahasiswa">
                                        <th class="title"> Review Mahasiswa: </th>
                                        <td class="value"> <?php echo $data['review_mahasiswa']; ?></td>
                                    </tr>
                                    <tr  class="td-review_dosen">
                                        <th class="title"> Review Dosen: </th>
                                        <td class="value"> <?php echo $data['review_dosen']; ?></td>
                                    </tr>
                                    <tr  class="td-file_review">
                                        <th class="title"> File Review: </th>
                                        <td class="value"><?php Html :: page_link_file($data['file_review']); ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                        </a>
                                        <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                            </a>
                                        </div>
                                    </div>
                                    <?php if($can_edit){ ?>
                                    <a class="btn btn-sm btn-info page-modal"  href="<?php print_link("review/edit/$rec_id"); ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <?php } ?>
                                </div>
                                <?php
                                }
                                else{
                                ?>
                                <!-- Empty Record Message -->
                                <div class="text-muted p-3">
                                    <i class="fa fa-ban"></i> No Record Found
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
