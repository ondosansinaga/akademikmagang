<?php 
/**
 * Laporan_akhir Page Controller
 * @category  Controller
 */
class Laporan_akhirController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "laporan_akhir";
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
		$fields = array("id_laporanakhir", 
			"nama_dospem", 
			"file_laporan", 
			"Status", 
			"catatan_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				laporan_akhir.id_laporanakhir LIKE ? OR 
				laporan_akhir.id_akun LIKE ? OR 
				laporan_akhir.id_dospem LIKE ? OR 
				laporan_akhir.nim LIKE ? OR 
				laporan_akhir.nama_mahasiswa LIKE ? OR 
				laporan_akhir.nama_dospem LIKE ? OR 
				laporan_akhir.file_laporan LIKE ? OR 
				laporan_akhir.Status LIKE ? OR 
				laporan_akhir.catatan_dospem LIKE ? OR 
				laporan_akhir.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "laporan_akhir/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("laporan_akhir.id_laporanakhir", ORDER_TYPE);
		}
		$db->where("id_akun ='". USER_ID . "'");
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
		$page_title = $this->view->page_title = "Laporan Akhir";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("laporan_akhir/list.php", $data); //render the full page
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
		$fields = array("id_laporanakhir", 
			"nim", 
			"nama_mahasiswa", 
			"nama_dospem", 
			"file_laporan", 
			"Status", 
			"catatan_dospem");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("laporan_akhir.id_laporanakhir", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Laporan Akhir";
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
		return $this->render_view("laporan_akhir/view.php", $record);
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
			$fields = $this->fields = array("id_akun","id_dospem","nim","nama_mahasiswa","nama_dospem","file_laporan","username_dospem");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_akun' => 'required',
				'id_dospem' => 'required',
				'nim' => 'required',
				'nama_mahasiswa' => 'required',
				'nama_dospem' => 'required',
				'file_laporan' => 'required',
				'username_dospem' => 'required',
			);
			$this->sanitize_array = array(
				'id_akun' => 'sanitize_string',
				'id_dospem' => 'sanitize_string',
				'nim' => 'sanitize_string',
				'nama_mahasiswa' => 'sanitize_string',
				'nama_dospem' => 'sanitize_string',
				'file_laporan' => 'sanitize_string',
				'username_dospem' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("laporan_akhir");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Laporan Akhir";
		$this->render_view("laporan_akhir/add.php");
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
		$fields = $this->fields = array("id_laporanakhir","id_akun","id_dospem","nim","nama_mahasiswa","nama_dospem","file_laporan","Status","catatan_dospem","username_dospem");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_akun' => 'required',
				'id_dospem' => 'required',
				'nim' => 'required',
				'nama_mahasiswa' => 'required',
				'nama_dospem' => 'required',
				'file_laporan' => 'required',
				'Status' => 'required',
				'catatan_dospem' => 'required',
				'username_dospem' => 'required',
			);
			$this->sanitize_array = array(
				'id_akun' => 'sanitize_string',
				'id_dospem' => 'sanitize_string',
				'nim' => 'sanitize_string',
				'nama_mahasiswa' => 'sanitize_string',
				'nama_dospem' => 'sanitize_string',
				'file_laporan' => 'sanitize_string',
				'Status' => 'sanitize_string',
				'catatan_dospem' => 'sanitize_string',
				'username_dospem' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("laporan_akhir.id_laporanakhir", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("laporan_akhir/laporan_akhir_dospem");
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
						return	$this->redirect("laporan_akhir/laporan_akhir_dospem");
					}
				}
			}
		}
		$db->where("laporan_akhir.id_laporanakhir", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Laporan Akhir";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("laporan_akhir/edit.php", $data);
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
		$db->where("laporan_akhir.id_laporanakhir", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("laporan_akhir");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function laporan_akhir_dospem($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_laporanakhir", 
			"nama_dospem", 
			"file_laporan", 
			"Status", 
			"catatan_dospem");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				laporan_akhir.id_laporanakhir LIKE ? OR 
				laporan_akhir.id_akun LIKE ? OR 
				laporan_akhir.id_dospem LIKE ? OR 
				laporan_akhir.nim LIKE ? OR 
				laporan_akhir.nama_mahasiswa LIKE ? OR 
				laporan_akhir.nama_dospem LIKE ? OR 
				laporan_akhir.file_laporan LIKE ? OR 
				laporan_akhir.Status LIKE ? OR 
				laporan_akhir.catatan_dospem LIKE ? OR 
				laporan_akhir.username_dospem LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "laporan_akhir/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("laporan_akhir.id_laporanakhir", ORDER_TYPE);
		}
		$db->where("username_dospem = '". USER_NAME ."'");
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
		$page_title = $this->view->page_title = "Laporan Akhir";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("laporan_akhir/laporan_akhir_dospem.php", $data); //render the full page
	}
}
