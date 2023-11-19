<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * akun_username_value_exist Model Action
     * @return array
     */
	function akun_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("akun");
		return $exist;
	}

	/**
     * akun_email_value_exist Model Action
     * @return array
     */
	function akun_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("akun");
		return $exist;
	}

	/**
     * daftar_magang_nama_dospem_option_list Model Action
     * @return array
     */
	function daftar_magang_nama_dospem_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT nama AS value,nama AS label FROM dospem WHERE nama LIKE ? ORDER BY nama ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * daftar_magang_nim_default_value Model Action
     * @return Value
     */
	function daftar_magang_nim_default_value(){
		$db = $this->GetModel();
		$sqltext = "select username from akun where id_akun = '". USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * daftar_magang_nama_mahasiswa_default_value Model Action
     * @return Value
     */
	function daftar_magang_nama_mahasiswa_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nama from akun where id_akun = '". USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * daftar_magang_id_jurusan_option_list Model Action
     * @return array
     */
	function daftar_magang_id_jurusan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_jurusan AS value,nama_jurusan AS label FROM jurusan";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * daftar_magang_id_akun_default_value Model Action
     * @return Value
     */
	function daftar_magang_id_akun_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT id_akun FROM akun WHERE id_akun = '". USER_ID . "'"

;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * daftar_magang_username_dospem_option_list Model Action
     * @return array
     */
	function daftar_magang_username_dospem_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT username AS value,nama AS label FROM dospem WHERE nama LIKE ? ORDER BY nama ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * laporan_akhir_id_akun_default_value Model Action
     * @return Value
     */
	function laporan_akhir_id_akun_default_value(){
		$db = $this->GetModel();
		$sqltext = "select id_akun from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * laporan_akhir_id_dospem_default_value Model Action
     * @return Value
     */
	function laporan_akhir_id_dospem_default_value(){
		$db = $this->GetModel();
		$sqltext = "select id_dospem from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * laporan_akhir_nim_default_value Model Action
     * @return Value
     */
	function laporan_akhir_nim_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nim from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * laporan_akhir_nama_mahasiswa_default_value Model Action
     * @return Value
     */
	function laporan_akhir_nama_mahasiswa_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nama_mahasiswa from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * laporan_akhir_nama_dospem_default_value Model Action
     * @return Value
     */
	function laporan_akhir_nama_dospem_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nama_dospem from daftar_magang 
INNER JOIN dospem
ON daftar_magang.id_dospem = dospem.id_dospem
where id_akun = '".USER_ID."'"

;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * laporan_akhir_username_dospem_option_list Model Action
     * @return array
     */
	function laporan_akhir_username_dospem_option_list(){
		$db = $this->GetModel();
		$sqltext = "select username_dospem from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * laporan_akhir_username_dospem_default_value Model Action
     * @return Value
     */
	function laporan_akhir_username_dospem_default_value(){
		$db = $this->GetModel();
		$sqltext = "select username_dospem from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * review_id_dospem_option_list Model Action
     * @return array
     */
	function review_id_dospem_option_list(){
		$db = $this->GetModel();
		$sqltext = "select id_dospem from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * review_id_akun_option_list Model Action
     * @return array
     */
	function review_id_akun_option_list(){
		$db = $this->GetModel();
		$sqltext = "select id_akun from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * review_id_akun_default_value Model Action
     * @return Value
     */
	function review_id_akun_default_value(){
		$db = $this->GetModel();
		$sqltext = "select id_akun from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * review_nim_default_value Model Action
     * @return Value
     */
	function review_nim_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nim from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * review_nama_mahasiswa_default_value Model Action
     * @return Value
     */
	function review_nama_mahasiswa_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nama_mahasiswa from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * review_nama_dospem_default_value Model Action
     * @return Value
     */
	function review_nama_dospem_default_value(){
		$db = $this->GetModel();
		$sqltext = "select nama_dospem from daftar_magang 
INNER JOIN dospem
ON daftar_magang.id_dospem = dospem.id_dospem
where id_akun = '".USER_ID."'"

;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * review_username_dosen_option_list Model Action
     * @return array
     */
	function review_username_dosen_option_list(){
		$db = $this->GetModel();
		$sqltext = "select username_dospem from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * review_username_dosen_default_value Model Action
     * @return Value
     */
	function review_username_dosen_default_value(){
		$db = $this->GetModel();
		$sqltext = "select username_dospem from daftar_magang where id_akun = '".USER_ID."'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * sertifikat_nim_option_list Model Action
     * @return array
     */
	function sertifikat_nim_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT nim AS value,nim AS label FROM daftar_magang WHERE nim LIKE ? LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * sertifikat_nama_mahasiswa_option_list Model Action
     * @return array
     */
	function sertifikat_nama_mahasiswa_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT nama_mahasiswa AS value,nama_mahasiswa AS label FROM daftar_magang WHERE nama_mahasiswa LIKE ? ORDER BY nama_mahasiswa ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * sertifikat_id_daftarmagang_option_list Model Action
     * @return array
     */
	function sertifikat_id_daftarmagang_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_daftarmagang AS value,nama_mahasiswa AS label FROM daftar_magang WHERE status = 'Selesai' ORDER BY nim ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * dospem_username_value_exist Model Action
     * @return array
     */
	function dospem_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("dospem");
		return $exist;
	}

	/**
     * dospem_email_value_exist Model Action
     * @return array
     */
	function dospem_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("dospem");
		return $exist;
	}

	/**
     * getcount_akunmahasiswa Model Action
     * @return Value
     */
	function getcount_akunmahasiswa(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM akun where role = 'Mahasiswa'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_akundospem Model Action
     * @return Value
     */
	function getcount_akundospem(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM akun where role = 'Dosen Pembimbing'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_statusmahasiswamagang Model Action
     * @return Value
     */
	function getcount_statusmahasiswamagang(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM daftar_magang where status = 'Pending Admin'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_mahasiswamagangaktif Model Action
     * @return Value
     */
	function getcount_mahasiswamagangaktif(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM daftar_magang where status = 'Disetujui'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_mahasiswamagangselesai Model Action
     * @return Value
     */
	function getcount_mahasiswamagangselesai(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM daftar_magang where status = 'Selesai'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
