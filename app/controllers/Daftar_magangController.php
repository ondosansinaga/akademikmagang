<?php 
/**
 * Daftar_magang Page Controller
 * @category  Controller
 */
class Daftar_magangController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "daftar_magang";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("daftar_magang.id_daftarmagang", 
			"daftar_magang.nim", 
			"daftar_magang.nama_mahasiswa", 
			"daftar_magang.id_jurusan", 
			"jurusan.nama_jurusan AS jurusan_nama_jurusan", 
			"daftar_magang.mitra_perusahaan", 
			"daftar_magang.posisi", 
			"daftar_magang.sertifikat_terima", 
			"daftar_magang.status", 
			"daftar_magang.tanggal_masuk", 
			"daftar_magang.tanggal_keluar", 
			"daftar_magang.nama_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				daftar_magang.id_daftarmagang LIKE ? OR 
				daftar_magang.nim LIKE ? OR 
				daftar_magang.nama_mahasiswa LIKE ? OR 
				daftar_magang.id_jurusan LIKE ? OR 
				daftar_magang.mitra_perusahaan LIKE ? OR 
				daftar_magang.posisi LIKE ? OR 
				daftar_magang.sertifikat_terima LIKE ? OR 
				daftar_magang.status LIKE ? OR 
				daftar_magang.tanggal_masuk LIKE ? OR 
				daftar_magang.tanggal_keluar LIKE ? OR 
				daftar_magang.id_akun LIKE ? OR 
				daftar_magang.id_dospem LIKE ? OR 
				daftar_magang.nama_dospem LIKE ? OR 
				daftar_magang.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "daftar_magang/search.php";
		}
		$db->join("jurusan", "daftar_magang.id_jurusan = jurusan.id_jurusan", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("daftar_magang.id_daftarmagang", ORDER_TYPE);
		}
		$db->where("id_akun = '". USER_ID . "'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Daftar Magang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("daftar_magang/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("daftar_magang.id_daftarmagang", 
			"daftar_magang.nim", 
			"daftar_magang.nama_mahasiswa", 
			"daftar_magang.id_jurusan", 
			"jurusan.nama_jurusan AS jurusan_nama_jurusan", 
			"daftar_magang.mitra_perusahaan", 
			"daftar_magang.posisi", 
			"daftar_magang.sertifikat_terima", 
			"daftar_magang.status", 
			"daftar_magang.tanggal_masuk", 
			"daftar_magang.tanggal_keluar", 
			"daftar_magang.id_akun", 
			"daftar_magang.id_dospem", 
			"akun.nama AS akun_nama", 
			"daftar_magang.nama_dospem", 
			"daftar_magang.username_dospem", 
			"akun.username AS akun_username");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("daftar_magang.id_daftarmagang", $rec_id);; //select record based on primary key
		}
		$db->join("jurusan", "daftar_magang.id_jurusan = jurusan.id_jurusan", "INNER");
		$db->join("akun", "daftar_magang.id_dospem = akun.id_dospem", "INNER");
		$db->join("akun", "daftar_magang.id_dospem = akun.id_dospem", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Daftar Magang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("daftar_magang/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("nim","nama_mahasiswa","id_jurusan","mitra_perusahaan","posisi","sertifikat_terima","tanggal_masuk","tanggal_keluar","id_akun");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nim' => 'required',
				'nama_mahasiswa' => 'required',
				'id_jurusan' => 'required',
				'mitra_perusahaan' => 'required',
				'posisi' => 'required',
				'sertifikat_terima' => 'required',
				'tanggal_masuk' => 'required',
				'tanggal_keluar' => 'required',
				'id_akun' => 'required',
			);
			$this->sanitize_array = array(
				'nim' => 'sanitize_string',
				'nama_mahasiswa' => 'sanitize_string',
				'id_jurusan' => 'sanitize_string',
				'mitra_perusahaan' => 'sanitize_string',
				'posisi' => 'sanitize_string',
				'sertifikat_terima' => 'sanitize_string',
				'tanggal_masuk' => 'sanitize_string',
				'tanggal_keluar' => 'sanitize_string',
				'id_akun' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("daftar_magang");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Daftar Magang";
		$this->render_view("daftar_magang/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_daftarmagang","nim","nama_mahasiswa","id_jurusan","mitra_perusahaan","posisi","sertifikat_terima","status","id_akun","nama_dospem","username_dospem");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nim' => 'required',
				'nama_mahasiswa' => 'required',
				'id_jurusan' => 'required',
				'mitra_perusahaan' => 'required',
				'posisi' => 'required',
				'sertifikat_terima' => 'required',
				'status' => 'required',
				'id_akun' => 'required',
				'nama_dospem' => 'required',
				'username_dospem' => 'required',
			);
			$this->sanitize_array = array(
				'nim' => 'sanitize_string',
				'nama_mahasiswa' => 'sanitize_string',
				'id_jurusan' => 'sanitize_string',
				'mitra_perusahaan' => 'sanitize_string',
				'posisi' => 'sanitize_string',
				'sertifikat_terima' => 'sanitize_string',
				'status' => 'sanitize_string',
				'id_akun' => 'sanitize_string',
				'nama_dospem' => 'sanitize_string',
				'username_dospem' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("daftar_magang.id_daftarmagang", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("daftar_magang");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("daftar_magang");
					}
				}
			}
		}
		$db->where("daftar_magang.id_daftarmagang", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Daftar Magang";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("daftar_magang/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_daftarmagang","nim","nama_mahasiswa","id_jurusan","mitra_perusahaan","posisi","sertifikat_terima","status","id_akun","nama_dospem","username_dospem");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'nim' => 'required',
				'nama_mahasiswa' => 'required',
				'id_jurusan' => 'required',
				'mitra_perusahaan' => 'required',
				'posisi' => 'required',
				'sertifikat_terima' => 'required',
				'status' => 'required',
				'id_akun' => 'required',
				'nama_dospem' => 'required',
				'username_dospem' => 'required',
			);
			$this->sanitize_array = array(
				'nim' => 'sanitize_string',
				'nama_mahasiswa' => 'sanitize_string',
				'id_jurusan' => 'sanitize_string',
				'mitra_perusahaan' => 'sanitize_string',
				'posisi' => 'sanitize_string',
				'sertifikat_terima' => 'sanitize_string',
				'status' => 'sanitize_string',
				'id_akun' => 'sanitize_string',
				'nama_dospem' => 'sanitize_string',
				'username_dospem' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("daftar_magang.id_daftarmagang", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("daftar_magang.id_daftarmagang", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("daftar_magang");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function status_mahasiswa_magang($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("daftar_magang.id_daftarmagang", 
			"daftar_magang.nim", 
			"daftar_magang.nama_mahasiswa", 
			"daftar_magang.id_jurusan", 
			"jurusan.nama_jurusan AS jurusan_nama_jurusan", 
			"daftar_magang.mitra_perusahaan", 
			"daftar_magang.posisi", 
			"daftar_magang.sertifikat_terima", 
			"daftar_magang.status", 
			"daftar_magang.tanggal_masuk", 
			"daftar_magang.tanggal_keluar", 
			"daftar_magang.nama_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				daftar_magang.id_daftarmagang LIKE ? OR 
				daftar_magang.nim LIKE ? OR 
				daftar_magang.nama_mahasiswa LIKE ? OR 
				daftar_magang.id_jurusan LIKE ? OR 
				daftar_magang.mitra_perusahaan LIKE ? OR 
				daftar_magang.posisi LIKE ? OR 
				daftar_magang.sertifikat_terima LIKE ? OR 
				daftar_magang.status LIKE ? OR 
				daftar_magang.tanggal_masuk LIKE ? OR 
				daftar_magang.tanggal_keluar LIKE ? OR 
				daftar_magang.id_akun LIKE ? OR 
				daftar_magang.id_dospem LIKE ? OR 
				daftar_magang.nama_dospem LIKE ? OR 
				daftar_magang.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "daftar_magang/search.php";
		}
		$db->join("jurusan", "daftar_magang.id_jurusan = jurusan.id_jurusan", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("daftar_magang.id_daftarmagang", ORDER_TYPE);
		}
		$db->where("status = 'Pending Admin'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Status Mahasiswa Magang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "daftar_magang/ajax-status_mahasiswa_magang.php" : "daftar_magang/status_mahasiswa_magang.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function bimbingan($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("daftar_magang.id_daftarmagang", 
			"daftar_magang.nim", 
			"daftar_magang.nama_mahasiswa", 
			"daftar_magang.id_jurusan", 
			"jurusan.nama_jurusan AS jurusan_nama_jurusan", 
			"daftar_magang.mitra_perusahaan", 
			"daftar_magang.posisi", 
			"daftar_magang.sertifikat_terima", 
			"daftar_magang.status", 
			"daftar_magang.tanggal_masuk", 
			"daftar_magang.tanggal_keluar", 
			"daftar_magang.nama_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				daftar_magang.id_daftarmagang LIKE ? OR 
				daftar_magang.nim LIKE ? OR 
				daftar_magang.nama_mahasiswa LIKE ? OR 
				daftar_magang.id_jurusan LIKE ? OR 
				daftar_magang.mitra_perusahaan LIKE ? OR 
				daftar_magang.posisi LIKE ? OR 
				daftar_magang.sertifikat_terima LIKE ? OR 
				daftar_magang.status LIKE ? OR 
				daftar_magang.tanggal_masuk LIKE ? OR 
				daftar_magang.tanggal_keluar LIKE ? OR 
				daftar_magang.id_akun LIKE ? OR 
				daftar_magang.id_dospem LIKE ? OR 
				daftar_magang.nama_dospem LIKE ? OR 
				daftar_magang.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "daftar_magang/search.php";
		}
		$db->join("jurusan", "daftar_magang.id_jurusan = jurusan.id_jurusan", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("daftar_magang.id_daftarmagang", ORDER_TYPE);
		}
		$db->where("username_dospem = '" .USER_NAME. "'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Daftar Magang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("daftar_magang/bimbingan.php", $data); //render the full page
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function mahasiswa_magang_aktif($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("daftar_magang.id_daftarmagang", 
			"daftar_magang.nim", 
			"daftar_magang.nama_mahasiswa", 
			"daftar_magang.id_jurusan", 
			"jurusan.nama_jurusan AS jurusan_nama_jurusan", 
			"daftar_magang.mitra_perusahaan", 
			"daftar_magang.posisi", 
			"daftar_magang.sertifikat_terima", 
			"daftar_magang.status", 
			"daftar_magang.tanggal_masuk", 
			"daftar_magang.tanggal_keluar", 
			"daftar_magang.nama_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				daftar_magang.id_daftarmagang LIKE ? OR 
				daftar_magang.nim LIKE ? OR 
				daftar_magang.nama_mahasiswa LIKE ? OR 
				daftar_magang.id_jurusan LIKE ? OR 
				daftar_magang.mitra_perusahaan LIKE ? OR 
				daftar_magang.posisi LIKE ? OR 
				daftar_magang.sertifikat_terima LIKE ? OR 
				daftar_magang.status LIKE ? OR 
				daftar_magang.tanggal_masuk LIKE ? OR 
				daftar_magang.tanggal_keluar LIKE ? OR 
				daftar_magang.id_akun LIKE ? OR 
				daftar_magang.id_dospem LIKE ? OR 
				daftar_magang.nama_dospem LIKE ? OR 
				daftar_magang.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "daftar_magang/search.php";
		}
		$db->join("jurusan", "daftar_magang.id_jurusan = jurusan.id_jurusan", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("daftar_magang.id_daftarmagang", ORDER_TYPE);
		}
		$db->where("status = 'Disetujui'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Status Mahasiswa Magang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "daftar_magang/ajax-mahasiswa_magang_aktif.php" : "daftar_magang/mahasiswa_magang_aktif.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function mahasis_telah_selesai($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("daftar_magang.id_daftarmagang", 
			"daftar_magang.nim", 
			"daftar_magang.nama_mahasiswa", 
			"daftar_magang.id_jurusan", 
			"jurusan.nama_jurusan AS jurusan_nama_jurusan", 
			"daftar_magang.mitra_perusahaan", 
			"daftar_magang.posisi", 
			"daftar_magang.sertifikat_terima", 
			"daftar_magang.status", 
			"daftar_magang.tanggal_masuk", 
			"daftar_magang.tanggal_keluar", 
			"daftar_magang.nama_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				daftar_magang.id_daftarmagang LIKE ? OR 
				daftar_magang.nim LIKE ? OR 
				daftar_magang.nama_mahasiswa LIKE ? OR 
				daftar_magang.id_jurusan LIKE ? OR 
				daftar_magang.mitra_perusahaan LIKE ? OR 
				daftar_magang.posisi LIKE ? OR 
				daftar_magang.sertifikat_terima LIKE ? OR 
				daftar_magang.status LIKE ? OR 
				daftar_magang.tanggal_masuk LIKE ? OR 
				daftar_magang.tanggal_keluar LIKE ? OR 
				daftar_magang.id_akun LIKE ? OR 
				daftar_magang.id_dospem LIKE ? OR 
				daftar_magang.nama_dospem LIKE ? OR 
				daftar_magang.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "daftar_magang/search.php";
		}
		$db->join("jurusan", "daftar_magang.id_jurusan = jurusan.id_jurusan", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("daftar_magang.id_daftarmagang", ORDER_TYPE);
		}
		$db->where("status = 'Selesai'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Daftar Magang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("daftar_magang/mahasis_telah_selesai.php", $data); //render the full page
	}
}
