<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("review/add");
$can_edit = ACL::is_allowed("review/edit");
$can_view = ACL::is_allowed("review/view");
$can_delete = ACL::is_allowed("review/delete");
?>
<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['id_review']) ? urlencode($data['id_review']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_review'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <td class="td-id_review"><a href="<?php print_link("review/view/$data[id_review]") ?>"><?php echo $data['id_review']; ?></a></td>
        <td class="td-nim"> <?php echo $data['nim']; ?></td>
        <td class="td-nama_mahasiswa"> <?php echo $data['nama_mahasiswa']; ?></td>
        <td class="td-tanggal_review"> <?php echo $data['tanggal_review']; ?></td>
        <td class="td-review_mahasiswa"> <?php echo $data['review_mahasiswa']; ?></td>
        <td class="td-review_dosen"> <?php echo $data['review_dosen']; ?></td>
        <td class="td-file_review"><?php Html :: page_link_file($data['file_review']); ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("review/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("review/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("review/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
    </tr>
    <?php 
    }
    ?>
    <?php
    } else {
    ?>
    <td class="no-record-found col-12" colspan="100">
        <h4 class="text-muted text-center ">
            No Record Found
        </h4>
    </td>
    <?php
    }
    ?>
    