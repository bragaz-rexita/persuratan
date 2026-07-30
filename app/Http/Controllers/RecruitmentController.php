<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Histories;
use App\Simpegpegawai;
use App\Pendidikan;
use App\Penelitian;
use App\Pengabdian;
use App\Penunjang;
use App\Detailpegawai;
use App\KLasifikasipenelitian;
use App\KLasifikasise;
use App\Rumpunilmu;
use App\Dataajar;
use App\Bidangilmu;
use App\Setting;
use App\Banksoaltest;
use App\Banksoalujian;
use App\Banksoal;
use App\Pengumuman;
use App\Pejabatsurat;
use App\Filess;
use App\Models\MasterPS;
use App\Models\KLasifikasikepakaran;
use App\Models\Detailidentitas;
use App\Models\Detailpendidikan;
use App\Models\Detaildiklat;
use App\Models\Detailasesor;
use App\Models\Detailorganisasi;
use App\Models\Detailseminar;
use App\Models\Detailanggotakeluarga;
use App\Models\Detailmutasi;
use App\Models\Detailsertifikat;
use Validator;
use Session;
use QrCode;
use Auth;
use Hash;
use DateTime;
use FeedReader;
use PDFCREATOR;
use Carbon\Carbon;
define( 'API_ACCESS_RECRUITMEN', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );
function timeAgoREKRUTMEN($time_ago) {
	$time_ago = strtotime($time_ago);
	$cur_time   = time();
	$time_elapsed   = $cur_time - $time_ago;
	$seconds    = $time_elapsed ;
	$minutes    = round($time_elapsed / 60 );
	$hours      = round($time_elapsed / 3600);
	$days       = round($time_elapsed / 86400 );
	$weeks      = round($time_elapsed / 604800);
	$months     = round($time_elapsed / 2600640 );
	$years      = round($time_elapsed / 31207680 );
	
	// Seconds
	if($seconds <= 60){
		return "just now";
	}
	//Minutes
	else if($minutes <=60){
		if($minutes==1){
			return "one minute ago";
		} else{
			return "$minutes minutes ago";
		}
	}
	//Hours
	else if($hours <=24){
		if($hours==1){
			return "an hour ago";
		} else {
			return "$hours hrs ago";
		}
	}
	//Days
	else if($days <= 7){
		if($days==1) {
			return "yesterday";
		} else {
			return "$days days ago";
		}
	}
	//Weeks
	else if($weeks <= 4.3){
		if($weeks==1) {
			return "a week ago";
		} else {
			return "$weeks weeks ago";
		}
	}
	//Months
	else if($months <=12){
		if($months==1){
			return "a month ago";
		} else {
			return "$months months ago";
		}
	}
	//Years
	else{
		if($years==1){
			return "one year ago";
		} else {
			return "$years years ago";
		}
	}
}
define( 'namaapps01', 'Sistem Persuratan Elektronik' );
define( 'domainapps01', 'Rumah Sakit Prima Husada' );
define( 'subdomainapps01', 'RSPHMLG' );
define( 'subsubdomainapps01', 'Prima Husada Group' );
define( 'addressapps01', 'Bajararum Selatan No. 3, Mondoroko' );
define( 'kota01', 'Malang' );
define( 'emailapps01', 'info@rs-primahusada.com' );
define( 'lamanapps01', 'https://rsph.duidev.com/' );
define( 'logofrontapps01', 'https://rsph.duidev.com/duidev-softwarehouse.png' );
class RecruitmentController extends Controller
{
	public function index () {
        $data			= [];
        $domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain		= $cekteks[0];
		}
		$lamanapps01	= url("/");
		$getdomainid 	= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
			$subsubdomainapps01			= $getdomainid->subsubdomainapps;
			$data['namaapps01']  		= $getdomainid->name;
			$data['domainapps01']  		= $getdomainid->domainapps;
			$data['subdomainapps01']  	= $getdomainid->subdomainapps;
			$data['subsubdomainapps01'] = $getdomainid->subsubdomainapps;
			$data['addressapps01']  	= $getdomainid->addressapps;
			$data['kota01']  			= $getdomainid->kota;
			$data['emailapps01']  		= $getdomainid->emailapps;
			$data['lamanapps01']  		= $getdomainid->route;
			$data['logofrontapps01']  	= $getdomainid->logofrontapps;
			$data['lamanportal']		= $lamanportal;
		} else {
			$subsubdomainapps01			= subsubdomainapps01;
			$data['namaapps01']  		= namaapps01;
			$data['domainapps01']  		= domainapps01;
			$data['subdomainapps01']  	= subdomainapps01;
			$data['subsubdomainapps01']	= subsubdomainapps01;
			$data['kota01']  			= kota01;
			$data['addressapps01']  	= addressapps01;
			$data['emailapps01']  		= emailapps01;
			$data['lamanapps01']  		= lamanapps01;
			$data['logofrontapps01']  	= logofrontapps01;
			$data['lamanportal']		= $lamanapps01;
		}
        if (Session('previlage') !== null) {
			return redirect('/profiluser');
        } else {
			$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$groups     = MasterPS::where('kodeps', 'aktif')->orderBy('tanggal', 'DESC')->limit(30)->get();
			$y      	= 0;
			$x      	= 0;
			foreach ($groups as $rowpeng) {
				$id             =   $rowpeng->id;
				$jenis          =   $rowpeng->jenjang;
				$siapa          =   $rowpeng->nosk;
				$nim            =   $rowpeng->kodeps;
				$pengumuman     =   $rowpeng->namaenglish;   
				$created_at     =   $rowpeng->tanggal;
				$kapan          =   timeAgoREKRUTMEN($created_at);
				$nama 			= 	$siapa; 
				$iconne 		= 	'fa-bullhorn';
				$jencolor 		= 	'red';
			
				$data['pengumumans'][$x]['id']          =   $id;
				$data['pengumumans'][$x]['tanggal']     =   $created_at;
				$data['pengumumans'][$x]['kapan']       =   $kapan;
				$data['pengumumans'][$x]['jencolor']    =   $jencolor;
				$data['pengumumans'][$x]['jenis']       =   $jenis;
				$data['pengumumans'][$x]['siapa']       =   'Open Rekrutmen Formasi : <strong>'.$rowpeng->jenjang.'</strong> Formasi <span class="badge badge-info">'.$rowpeng->idpejabat.'</span>';
				$data['pengumumans'][$x]['pengumuman']  =   $pengumuman.'<span class="badge badge-warning">Rentang Pembukaan Pendaftaran : '.$created_at.' s/d '.$rowpeng->tglskijin.'</span>';
				$data['pengumumans'][$x]['icon']        =   $iconne;
				$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];

				if ($y == 9) {
					$y = 0; 
				} else {
					$y++; 
				}
				$x++;
			}
			if ($x == 0){
				$data['pengumumans'][$x]['id']          =   $x;
				$data['pengumumans'][$x]['tanggal']     =   date("Y-m-d");
				$data['pengumumans'][$x]['kapan']       =   'now';
				$data['pengumumans'][$x]['jencolor']    =   'red';
				$data['pengumumans'][$x]['jenis']       =   'System';
				$data['pengumumans'][$x]['siapa']       =   'System';
				$data['pengumumans'][$x]['pengumuman']  =   'No Broadcast Message Yet';
				$data['pengumumans'][$x]['icon']        =   'fa-bullhorn';
				$data['pengumumans'][$x]['urutanwerno'] =   'red';
			}
			$qrcode 			= base64_encode(QrCode::format('png')->size(100)->generate($lamanapps01));
			$data['qrcode'] 	= $qrcode;
            dd(view('rekrutmen.login'));
        	return view('rekrutmen.login', $data);
        }
    }
	public function exResetPerProdi(){
		$homebase		= url("/");
		$id				= Session('iduser');
		if ($id == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			Simpegpegawai::where('id', Session('iduser'))->update([
				'prodihomebase'		=> '', 
				'jenjanghomebase'	=> '', 
				'program_studi'		=> '',
				'status_pegawai'	=> '', 
				'updated_at'		=> date("Y-m-d H:i:s"), 
			]);
			return redirect('profiluser');
		}
	}
	public function exDaftarkanDiri(Request $request) {
		$idprodi  		= $request->input('set01');
		if ($idprodi == ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Program Studi Wajib di Isi']);
			return back();
		} else {
			$hasil		= MasterPS::where('id', $idprodi)->first();
			$cekpenuh 	= Simpegpegawai::where('program_studi', $idprodi)->count();
			if ($cekpenuh > 200){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Formasi ini Telah Mencapai Maksimum Kuota']);
				return back();
			} else {
				$update 	= Simpegpegawai::where('email_ub', Session('email'))->update([
					'prodihomebase'		=> $hasil->nama, 
					'jenjanghomebase'	=> $hasil->jenjang, 
					'program_studi'		=> $idprodi, 
					'updated_at'		=> date("Y-m-d H:i:s"), 
				]);
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Master Biodata Anda Telah terupdate']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada data yang di ubah']);
					return back();
				}
			}
		}
	}
    public function viewPengumumanVerifikasi(){
		$homebase		= url("/");
		$tasks			= [];
		$idne			= Session('iduser');
		if ($idne == null){
			$tasks['sidebar'] 		= 'pengumumanverifikasi';
			$tasks['kalimatheader'] = 'Mohon Maaf Info Verifikasi Berkas Belum Ada';
			$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Verifikasi Berkas Belum Siap, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
			return view('errors.notready', $tasks);
		} else {
			$hasil		= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
			if (isset($hasil->nama_lengkap)){
				if ($hasil->status_pegawai == '' OR $hasil->status_pegawai == null){
					$tasks['sidebar'] 		= 'pengumumanverifikasi';
					$tasks['kalimatheader'] = 'Mohon Maaf Info Verifikasi Berkas Belum Ada';
					$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Verifikasi Berkas Belum Siap, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
					return view('errors.notready', $tasks);
				} else if ($hasil->status_pegawai == 'Terverifikasi' OR $hasil->status_pegawai == 'Diterima'){
					return redirect('karpes/'.$idne);
				} else {
					$tasks['sidebar'] 		= 'pengumumanverifikasi';
					$tasks['kalimatheader'] = 'Pengumuman';
					$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Berkas - berkas bapak ibu telah kami periksa dengan catatan sebagai berikut : <br />'.$hasil->status_pegawai.'<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
					return view('errors.notready', $tasks);
				}
			} else {
				$tasks['sidebar'] 		= 'pengumumanverifikasi';
				$tasks['kalimatheader'] = 'Mohon Maaf Info Verifikasi Berkas Belum Ada';
				$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Verifikasi Berkas Belum Siap, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
				return view('errors.notready', $tasks);
			}
		}
	}
	public function viewPengumumanHasil(){
		$homebase		= url("/");
		$tasks			= [];
		$idne			= Session('iduser');
		if ($idne == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			$hasil		= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
			if (isset($hasil->nama_lengkap)){
				$tasks['sidebar'] 		= 'pengumumanhasil';
				$tasks['kalimatheader'] = 'Mohon Maaf Info Pengumuman Hasil Ujian Belum Ada';
				$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Pengumuman Hasil Ujian Belum Siap, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
				if ($hasil->status_pegawai == '' OR $hasil->status_pegawai == null){
					return view('errors.notready', $tasks);
				} else {
					return redirect('hasilujian/'.$idne);
				}
			} else {
				$tasks['judulpesan']	= 'Restricted Area';
				$tasks['kalimatheader']	= 'ID Tidak Valid';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
				return view('errors.notready', $tasks);
			}
		}
	}
	public function viewHasilUjianKompetensi($id){
		$homebase		= url("/");
		$idne			= Session('iduser');
		$tasks			= [];
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
       	$getdomainid 	= DB::table('app_menu')->where('route', 'LIKE', $homebase.'%')->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
			$tasks['namaapps01']  		= $getdomainid->name;
			$tasks['domainapps01']  	= $getdomainid->domainapps;
			$tasks['subdomainapps01']  	= $getdomainid->subdomainapps;
			$tasks['subsubdomainapps01']= $getdomainid->subsubdomainapps;
			$tasks['addressapps01']  	= $getdomainid->addressapps;
			$tasks['kota01']  			= $getdomainid->kota;
			$tasks['emailapps01']  		= $getdomainid->emailapps;
			$tasks['lamanapps01']  		= $getdomainid->route;
			$tasks['logofrontapps01']  	= $getdomainid->logofrontapps;
			$tasks['lamanportal']		= $lamanportal;
			$tasks['logo']  			= $getdomainid->icon;
			$logo  						= $getdomainid->icon;
			$subdomainapps				= $getdomainid->subdomainapps;
			$subsubdomainapps			= $getdomainid->subsubdomainapps;
		} else {
			$tasks['namaapps01']  		= namaapps01;
			$tasks['domainapps01']  	= domainapps01;
			$tasks['subdomainapps01']  	= subdomainapps01;
			$tasks['subsubdomainapps01']= subsubdomainapps01;
			$tasks['addressapps01']  	= addressapps01;
			$tasks['emailapps01']  		= emailapps01;
			$tasks['lamanapps01']  		= lamanapps01;
			$tasks['logofrontapps01']  	= logofrontapps01;
			$tasks['logo']  			= $homebase.'/mascot.png';
			$logo  						= $homebase.'/mascot.png';
			$subdomainapps				= subdomainapps01;
			$subsubdomainapps			= subsubdomainapps01;
		}
		$alamatweb		= $homebase.'/hasilujian/'.$id;
		$qrcode 		= base64_encode(QrCode::format('png')->size(100)->generate($alamatweb));
		$hasil			= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
		if (isset($hasil->nama_lengkap)){
			$idpeg 			= $hasil->idpeg;
			$programstudi 	= $hasil->program_studi;
			$foto			= $hasil->foto;
			$email			= $hasil->email;
			$user  		 	= User::where('email', $email)->first();
			if (isset($user->id)){
				$idne 			= $user->id;
				$previlage 		= $user->previlage;
				$fakultas 		= $user->fakultas;
				$foto 			= $user->photo;
				$tandatangan 	= $user->tandatangan;
				if ($tandatangan == '' OR is_null($user->tandatangan)){
				} else {
					if (File::exists(public_path().'/'.$tandatangan)) {
						$tandatangan = $homebase.'/'.$tandatangan;
					}
				}
			}
			if (is_null($foto)){ $foto = ''; }
			$ceksekfoto		= explode("/", $foto);
			if (isset($ceksekfoto[2])){ $foto = ''; }
			if ($foto != ''){
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = $homebase.'/images/pegawai/'.$foto;
				} else {
					$foto = $homebase.'/mascot.png';
				}
			} else {
				$foto = $homebase.'/mascot.png';
			}
			$hasilujian	= '';
			$getdatasetting 				= Setting::where('ppabp', $programstudi)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting->isi1)){
				$setttingujian 				= $getdatasetting->isi1;
			} else { $setttingujian = ''; }
			if ( $setttingujian != ''){
				$sql		= Banksoalujian::where('idmahasiswa', $idpeg)->where('namaujian', $programstudi)->orderBy('kode', 'ASC')->orderBy('urutan', 'ASC')->get();
				if (!empty($sql)){
					$hasilujian = '<table width="820" border="1" cellpadding="0" cellspacing="0" id="printiki">';
					$hasilujian	= $hasilujian.'<thead><tr><th>Kode Soal</th><th>Deskripsi Soal</th><th>Jawaban</th><th>Skore</th></tr><tbody>';
					foreach ($sql as $rows){
						$skore = $rows->skore;
						if ($skore == '' OR $skore == 0){
							$skore = '';
						} else {
							$skore = '&#10004;';
						}
						$deskripsi 	= '';
						$getfirst 	= Banksoal::where('id', $rows->idsoal)->first();
						if (isset($getfirst->id)){
							$deskripsi = $getfirst->deskripsi;
						}
						$hasilujian	= $hasilujian.'<tr><td>'.$rows->kode.'</td><td>'.$deskripsi.'</td><td align="center">'.$rows->jawaban.'</td><td align="center">'.$skore.'</td></tr>';
					}
					$hasilujian	= $hasilujian.'</tbody></table>';
				}
			}
			$tasks['qrcode'] 				= $qrcode;
			$tasks['tandatangan'] 			= $tandatangan;
			$tasks['foto'] 					= $foto;
			$tasks['biodata'] 				= $hasil;
			$tasks['hasilujian'] 			= $hasilujian;
			$tasks['sidebar'] 				= 'pengumumanhasil';
			return view('rekrutmen.pengumumanhasilujian', $tasks);
		} else {
			$tasks['judulpesan']	= 'Restricted Area';
			$tasks['kalimatheader']	= 'ID Tidak Valid';
			$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
			return view('errors.notready', $tasks);
		}
	}
	public function viewPortalUjian(){
		$homebase		= url("/");
		$tasks			= [];
		$idne			= Session('iduser');
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid 	= DB::table('app_menu')->where('route', 'LIKE', $homebase.'%')->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
			$tasks['namaapps01']  		= $getdomainid->name;
			$tasks['domainapps01']  	= $getdomainid->domainapps;
			$tasks['subdomainapps01']  	= $getdomainid->subdomainapps;
			$tasks['subsubdomainapps01']= $getdomainid->subsubdomainapps;
			$tasks['addressapps01']  	= $getdomainid->addressapps;
			$tasks['kota01']  			= $getdomainid->kota;
			$tasks['emailapps01']  		= $getdomainid->emailapps;
			$tasks['lamanapps01']  		= $getdomainid->route;
			$tasks['logofrontapps01']  	= $getdomainid->logofrontapps;
			$tasks['lamanportal']		= $lamanportal;
			$tasks['logo']  			= $getdomainid->icon;
			$logo  						= $getdomainid->icon;
			$subdomainapps				= $getdomainid->subdomainapps;
			$subsubdomainapps			= $getdomainid->subsubdomainapps;
		} else {
			$tasks['namaapps01']  		= namaapps01;
			$tasks['domainapps01']  	= domainapps01;
			$tasks['subdomainapps01']  	= subdomainapps01;
			$tasks['subsubdomainapps01']= subsubdomainapps01;
			$tasks['addressapps01']  	= addressapps01;
			$tasks['emailapps01']  		= emailapps01;
			$tasks['lamanapps01']  		= lamanapps01;
			$tasks['logofrontapps01']  	= logofrontapps01;
			$tasks['logo']  			= $homebase.'/mascot.png';
			$logo  						= $homebase.'/mascot.png';
			$subdomainapps				= subdomainapps01;
			$subsubdomainapps			= subsubdomainapps01;
		}
		if ($idne == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			$foto 	= $homebase.'/mascot.png';
			$hasil	= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
			if (isset($hasil->nama_lengkap)){
				$foto 	= $hasil->foto;
				$email 	= $hasil->email;
				if (is_null($foto)){ $foto = ''; }
				$ceksekfoto		= explode("/", $foto);
				if (isset($ceksekfoto[2])){ $foto = ''; }
				if ($foto != ''){
					if (File::exists(public_path() ."/images/pegawai/". $foto)) {
						$foto = $homebase.'/images/pegawai/'.$foto;
					} else {
						$foto = $homebase.'/mascot.png';
					}
				}
				$tandatangan 	= $homebase.'/boxed-bg.png';
				$user  		 	= User::where('email', $email)->first();
				if (isset($user->id)){
					$idne 			= $user->id;
					$previlage 		= $user->previlage;
					$fakultas 		= $user->fakultas;
					$tandatangan 	= $user->tandatangan;
					if ($tandatangan == '' OR is_null($user->tandatangan)){
					} else {
						if (File::exists(public_path().'/'.$tandatangan)) {
							$tandatangan = $homebase.'/'.$tandatangan;
						}
					}
				}
				$alamatcetak	= $homebase.'/hasilujian/'.$hasil->id;
		
				$qrcode 		= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
				$getdatasetting = Setting::where('ppabp', $hasil->program_studi)->where('jenis', 'ujiankompetensi')->first();
				if (isset($getdatasetting->isi1)){
					$setttingujian 		= $getdatasetting->isi1;
				} else { $setttingujian = ''; }
				if ($setttingujian == 'Close'){
					$tasks['judulpesan']	= 'Restricted Area';
					$tasks['kalimatheader']	= 'Ujian Tertutup';
					$tasks['kalimatbody']	= 'Mohon Maaf Ujian Belum di Buka';
					return view('errors.notready', $tasks);
				} else {
					$tasks['sidebar'] 		= 'pengumumanhasil';
					if ($hasil->status_pegawai == '' OR $hasil->status_pegawai == null){
						$tasks['kalimatheader'] = 'Mohon Maaf';
						$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Berkas Administrasi Belum di Verifikasi Oleh Panitia Rekrutmen, Mohon Tunggu Sampai Berkas Bapak/Ibu di Verifikasi Panitia Seleksi.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
						return view('errors.notready', $tasks);
					} else if ($hasil->status_pegawai == 'Terverifikasi' OR $hasil->status_pegawai == 'Diterima'){
						$tasks['qrcode'] 				= $qrcode;
						$tasks['tandatangan'] 			= $tandatangan;
						$tasks['foto'] 					= $foto;
						$tasks['biodata'] 				= $hasil;
						return view('rekrutmen.portalujian', $tasks);
					} else {
						$tasks['sidebar'] 		= 'pengumumanverifikasi';
						$tasks['kalimatheader'] = 'Pengumuman';
						$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Berkas - berkas bapak ibu telah kami periksa dengan catatan sebagai berikut : <br />'.$hasil->status_pegawai.'<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
						return view('errors.notready', $tasks);
					}
				}
			} else {
				$tasks['judulpesan']	= 'Restricted Area';
				$tasks['kalimatheader']	= 'ID Tidak Valid';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
				return view('errors.notready', $tasks);
			}
		}
	}
    public function viewWawancara(){
		$idne		= Session('iduser');
		$homebase	= url("/");
		$tasks		= [];
		$data		= [];
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
       	$getdomainid 	= DB::table('app_menu')->where('route', 'LIKE', $homebase.'%')->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
			$tasks['namaapps01']  		= $getdomainid->name;
			$tasks['domainapps01']  	= $getdomainid->domainapps;
			$tasks['subdomainapps01']  	= $getdomainid->subdomainapps;
			$tasks['subsubdomainapps01']= $getdomainid->subsubdomainapps;
			$tasks['addressapps01']  	= $getdomainid->addressapps;
			$tasks['kota01']  			= $getdomainid->kota;
			$tasks['emailapps01']  		= $getdomainid->emailapps;
			$tasks['lamanapps01']  		= $getdomainid->route;
			$tasks['logofrontapps01']  	= $getdomainid->logofrontapps;
			$tasks['lamanportal']		= $lamanportal;
			$tasks['logo']  			= $getdomainid->icon;
			$logo  						= $getdomainid->icon;
			$subdomainapps				= $getdomainid->subdomainapps;
			$subsubdomainapps			= $getdomainid->subsubdomainapps;
		} else {
			$tasks['namaapps01']  		= namaapps01;
			$tasks['domainapps01']  	= domainapps01;
			$tasks['subdomainapps01']  	= subdomainapps01;
			$tasks['subsubdomainapps01']= subsubdomainapps01;
			$tasks['addressapps01']  	= addressapps01;
			$tasks['emailapps01']  		= emailapps01;
			$tasks['lamanapps01']  		= lamanapps01;
			$tasks['logofrontapps01']  	= logofrontapps01;
			$tasks['logo']  			= $homebase.'/mascot.png';
			$logo  						= $homebase.'/mascot.png';
			$subdomainapps				= subdomainapps01;
			$subsubdomainapps			= subsubdomainapps01;
		}
		$kalender   = array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd         = date("d");
		$mm         = (int)date("m");
		$mm			= $kalender[$mm];
		$tahuniki   = date("Y");
		$tglcetak	= $dd.' '.$mm.' '.$tahuniki;
		$biodata	= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
		if (isset($biodata->idpeg)){
			$foto			= $biodata->foto;
			$id				= $biodata->idpeg;
			$kepakaran		= $biodata->kepakaran;
			$programstudi 	= $biodata->program_studi;
			$email			= $biodata->email;
			if ($kepakaran != ''){
				$gettls = KLasifikasikepakaran::where('id', $kepakaran)->first();
				if (isset($gettls->id)){
					$kepakaran = $gettls->kategori.' '.$gettls->kepakaran;
				}
			}
			$jabatan	= '';
			$tandatangan= '';
			$homebase	= url("/");
			$getjabatan	= User::where('email', $email)->first();
			if (isset($getjabatan->tandatangan)){
				$jabatan	= $getjabatan->privilage;
				$tandatangan= $getjabatan->tandatangan;
			}			
			if ($foto != ''){
				$foto	= str_replace('photo/', '', $foto);
				$foto 	= $homebase.'/images/pegawai/'.$foto;
			} else { $foto 	= $homebase.'/mascot.png'; }
			$getdatasetting 	= Setting::where('ppabp', $programstudi)->where('jenis', 'ujianwawancara')->first();
			if (isset($getdatasetting->isi2)){
				$wawancara 		= $getdatasetting->isi2;
			} else { $wawancara = ''; }
			
			$tahunlulussma 			= date("Y");
			$tahunluluskuliah 		= date("Y-m-d");
			$tasks['kepakaran']		= $kepakaran;
			$tasks['tglcetak']		= $tglcetak;
			$tasks['tandatangan']	= $tandatangan;
			$tasks['biodata']		= $biodata;
			$tasks['foto']			= $foto;
			$tasks['jadwal']		= $wawancara;
			$tasks['sidebar'] 		= 'wawancara';
			return view('rekrutmen.wawancara', $tasks);
		} else {
			$tasks['judulpesan']	= 'Restricted Area';
			$tasks['kalimatheader']	= 'ID Tidak Valid';
			$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
			return view('errors.notready', $tasks);
		}
	}
	public function cetakWawancara($id){
		$homebase		= url("/");
		if ($id == null){
			$id = Session('iduser');
		}
		$alamatweb		= $homebase.'/cetakformwawancara/'.$id;
		if (File::exists(public_path().'/images/'.$id.'/qrwawancara-'.$id.'.png')) {
			$qrcode		= '<img src="'.$homebase.'/images/'.$id.'/qrwawancara-'.$id.'.png" width="100" />';
		} else {
			$qrcode 		= QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(100)->generate($alamatweb);
			$output_file 	= '/images/'.$id.'/qrwawancara-'. $id.'.png';
			Storage::disk('local')->put($output_file, $qrcode);
			$qrcode			= '<img src="'.$homebase.'/images/'.$id.'/qrwawancara-'.$id.'.png" width="100" />';
		}
		$user  		 	= User::where('id', $id)->first();
		$idne 			= $user->id;
		$previlage 		= $user->previlage;
		$fakultas 		= $user->fakultas;
		$foto 			= $user->photo;
		$tandatangan 	= $user->tandatangan;
		$hasil		= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
		if (isset($hasil->nama_lengkap)){
			$foto 			= $hasil->foto;
			$programstudi 	= $hasil->program_studi;
			$email			= $hasil->email;
			$kepakaran		= $hasil->kepakaran;
			if (is_null($foto)){ $foto = ''; }
			$ceksekfoto		= explode("/", $foto);
			if (isset($ceksekfoto[2])){ $foto = ''; }
			if ($foto != ''){
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = $homebase.'/images/pegawai/'.$foto;
				} else {
					$foto = $homebase.'/mascot.png';
				}
			} else {
				$foto = $homebase.'/mascot.png';
			}
			if ($kepakaran != ''){
				$gettls = KLasifikasikepakaran::where('id', $kepakaran)->first();
				if (isset($gettls->id)){
					$kepakaran = $gettls->kategori.' '.$gettls->kepakaran;
				}
			}
			
			$formwawancara 					= '
					<table width="780" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
						<tr>
							<td align="center" valign="top" width="30">NO</td>
							<td align="center" valign="top" width="300">Deskrispi</td>
							<td align="center" valign="top" width="120">Nilai Sikap</td>
							<td align="center" valign="top" width="120">Nilai Jawaban</td>
							<td align="center" valign="top" width="120">Nilai Diskusi</td>
						</tr>
						<tr>
							<td align="center" valign="top">1</td>
							<td align="center" valign="top">2</td>
							<td align="center" valign="top">3</td>
							<td align="center" valign="top">4</td>
							<td align="center" valign="top">5</td>
						</tr>
						<tr>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
						</tr>
					</table>
			';
			$tasks							= [];
			$tasks['qrcode'] 				= $qrcode;
			$tasks['tandatangan'] 			= $tandatangan;
			$tasks['foto'] 					= $foto;
			$tasks['biodata'] 				= $hasil;
			$tasks['formwawancara'] 		= $formwawancara;
			$sco 							= config('global.swandhananama');
			$info = array(
				'Name' 			=> $sco,
				'Location' 		=> config('global.swandhanauniv'),
				'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
				'ContactInfo' 	=> $homebase,
			);
			$text 			= view('cetak.wawancara', $tasks);
			$page_format	= array(
				'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 330),
				'Dur' => 3,
				'PZ' => 1,
			);
			PDFCREATOR::SetProtection(array('modify', 'copy'), '', null, 0, null);
			PDFCREATOR::SetCreator($sco);
			PDFCREATOR::SetAuthor($hasil->nama);
			PDFCREATOR::SetTitle($hasil->jenispeg);
			PDFCREATOR::SetSubject(config('global.swandhanauniv'));
			PDFCREATOR::SetKeywords(config('global.swandhanauniv'));
			PDFCREATOR::setPrintHeader(false);
			PDFCREATOR::setPrintFooter(false);
			PDFCREATOR::SetMargins(5, 0, 5);
			PDFCREATOR::setFontSubsetting(true);
			PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
			PDFCREATOR::AddPage('P', $page_format, false, false);
			PDFCREATOR::setPageMark();
			PDFCREATOR::writeHTML($text, true, 0, true, 0);
			PDFCREATOR::setFooterMargin(0);
			$pdfdoc = PDFCREATOR::Output('', 'S');
			PDFCREATOR::reset();
			$output_file 	= '/images/'.$id.'/formwawancara-'. $id.'.pdf';
			Storage::disk('local')->delete($output_file);
			Storage::disk('local')->put($output_file, $pdfdoc);
			$file =  public_path($output_file);
			return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
		} else {
			$tasks['judulpesan']	= 'Unkown Error';
			$tasks['kalimatheader']	= 'SK Gagal di Generate';
			$tasks['kalimatbody'] 	= 'Mohon Maaf, Sistem Gagal Generate SK . Ulangi Beberapa Saat Lagi<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
			return view('errors.notready', $tasks);
		}
	}
	public function viewSKPegawai(){
		$homebase		= url("/");
		$tasks			= [];
		$idne			= Session('iduser');
		if ($idne == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			$hasil		= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idne)->first();
			if (isset($hasil->nama_lengkap)){
				$statuspegawai			= $hasil->status_pegawai;
				$ppabp					= $hasil->ppabp;
				$tasks['sidebar'] 		= 'skpegawai';
				$tasks['kalimatheader'] = 'Mohon Maaf Info SK Belum Ada';
				$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Pengumuman Hasil Surat Keputusan (SK) Penetapan Pegawai Tetap UB Belum Siap, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
				if ($hasil->status_pegawai == '' OR $hasil->status_pegawai == null){
					return view('errors.notready', $tasks);
				} else if ($statuspegawai == 'Diterima'){
					if ($ppabp == '' OR is_null($ppabp)){
						$tasks['kalimatheader'] = $statuspegawai;
						$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Pengumuman Hasil Surat Keputusan (SK) Penetapan Pegawai Tetap UB Dalam Proses Pengerjaan, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p>Kode Berkas:'.$ppabp.'</p><p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
						return view('errors.notready', $tasks);				
					} else {
						$tasks['url']	= $ppabp;
						return view('rekrutmen.skpegawai', $tasks);
					}
				} else {
					$tasks['kalimatheader'] = 'Hasil Akhir';
					$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br /> Hasil akhir adalah '.$hasil->status_pegawai;
					return view('errors.notready', $tasks);
				}
			} else {
				$tasks['judulpesan']	= 'Restricted Area';
				$tasks['kalimatheader']	= 'ID Tidak Valid';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
				return view('errors.notready', $tasks);
			}
		}
	}
	public function viewMasterProdi(){
		$homebase		= url("/");
		$data			= [];
		$id				= Session('iduser');
		$previlage		= Session('previlage');
		if ($id == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			if ($previlage == 'Operator' OR $previlage == 'PEJABAT' OR $previlage == 'Admin SDM'){
				if (Session('fakultas') == 'DPM'){
					$aktif  			= MasterPS::where('kodeps', 'aktif')->count();
					$arsip  			= MasterPS::where('kodeps', 'arsip')->count();
				} else {
					$aktif  			= MasterPS::where('nmpejabat', Session('email'))->where('kodeps', 'aktif')->count();
					$arsip  			= MasterPS::where('nmpejabat', Session('email'))->where('kodeps', 'arsip')->count();
				}
				$data['arralljabatan'] 	= Simpegpegawai::select('jabatan')->where('ppabp', '!=', 'Rekrutmen PT DPM')->groupBy('jabatan')->get();
				$data['arrjabatan'] 	= Pejabatsurat::select('pejabat')->get();
				$data['kodesoals'] 		= Banksoal::groupBy('ceel')->select('ceel')->get();
				$data['arrsdomain'] 	= DB::table('app_menu')->where('subdomainapps', '!=', 'RKTDPM')->get();
				$data['aktif']  		= $aktif;
				$data['arsip']  		= $arsip;
				$data['sidebar']  		= 'masterprodi';
				return view('rekrutmen.masterprodi-new', $data);
			} else {
				return redirect('/profiluser');
			} 
		}
	}
	public function dataPengumuman(Request $request) {
		$arrayinbox 	= [];
		$previlage		= Session('previlage');
		$jenis   		= $request->input('jenis');
        $valcari   		= $request->input('valcari');
        $homebase		= url("/");
		$totaldata  	= 0;
        $limit         	= 10;
        $limit      	= ($request->input('limit') == null ? $limit : $request->input('limit'));
		$order      	= ($request->input('order') == null ? 'id desc' : $request->input('order'));
        $ceksek 		= explode(" ", $order);
		if (Session('fakultas') == 'DPM'){
			$data 	    	= MasterPS::where('kodeps', $jenis)->select('aka_masterps.*');
		} else if (Session('fakultas') == 'RKTDPM'){
			$data 	    	= MasterPS::where('kodeps', $jenis)->select('aka_masterps.*');
		} else {
			$data 	    	= MasterPS::where('nmpejabat', Session('email'))->where('kodeps', $jenis)->select('aka_masterps.*');
		}
		if (isset($ceksek[1])){
			$variabel 	= $ceksek[0];
			$urutan		= $ceksek[1];
			if ($variabel == 'undefined'){
				$variabel = 'id';
			}
			$order 		= $variabel.' '.$urutan;
		}
		if ($valcari != null AND $valcari != '') $data = $data->where('nama', 'LIKE', '%'.$valcari.'%')->orWhere('namaenglish', 'LIKE', '%'.$valcari.'%');
        $data       	= $data->orderByRaw($order)->paginate($limit);
		$totaldata		= $data->total();
		if (!empty($data)){
			foreach ($data as $hasil){
				$id 	= $hasil->id;
				$kodeps = $hasil->kodeps;
				if ($kodeps == 'aktif'){
					$status = '<span class="badge badge-success">Aktif</span>';
				} else { $status = '<span class="badge badge-danger">Arsip</span>'; }
				$soalkd	= Banksoaltest::where('namaujian', $id)->where('kode', 'KD')->count();
				$soalkb	= Banksoaltest::where('namaujian', $id)->where('kode', 'KB')->count();
				$berkas = Filess::where('url', $id)->where('description', 'REKRUTMEN')->count();
				$terisi	= Simpegpegawai::where('program_studi', $id)->count();
				$arrayinbox[] = array(
					'id' 			=> $hasil->id,	
					'terisi' 		=> $terisi,
					'soalkd' 		=> $soalkd,
					'soalkb' 		=> $soalkb,	
					'berkas' 		=> $berkas,	
					'nama' 			=> $hasil->nama,
					'namaenglish'	=> $hasil->namaenglish,
					'jenjang' 		=> $hasil->jenjang,
					'tanggal' 		=> $hasil->tanggal,
					'namapt' 		=> $hasil->namapt,
					'namafak' 		=> $hasil->namafak,
					'nosk' 			=> $hasil->nosk,
					'idpejabat'		=> $hasil->idpejabat,
					'nmpejabat' 	=> $hasil->nmpejabat,
					'noskijin' 		=> $hasil->noskijin,
					'tglskijin' 	=> $hasil->tglskijin,
					'pejabatijin' 	=> $hasil->pejabatijin,
					'alamatps' 		=> $hasil->alamatps,
					'mulai' 		=> $hasil->blnthnoperasional,
					'telpon' 		=> $hasil->telpon,
					'faksimili' 	=> $hasil->faksimili,
					'website' 		=> $hasil->website,
					'email' 		=> $hasil->email,
					'bloknim' 		=> $hasil->bloknim,
					'fileijin' 		=> $hasil->fileskijin,
					'status' 		=> $status,
				);
			}
		}
        $response = [
            'message'   => 'List Laporan',
            'email'		=> Session('email'),
			'previlage'	=> $previlage,
			'fakultas'	=> Session('fakultas'),
            'data'      => $arrayinbox,
            'total'     => $totaldata
        ];
        return response()->json($response, 200);
	}
	public function exInputPengumuman(Request $request) {
		$idne		= $request->input('set01');
		$set10		= $request->input('set10');
		$jabkajur	= $request->input('set26');
		$vowels 	= array("Ketua ", "Kepala ");
		$jurusan 	= str_replace($vowels, "", $jabkajur);
		$namafak= '-';
		$nama 	= $set10;
		if ($idne == 'hapus'){
			$idne	= $request->input('set02');
			$getdata= MasterPS::where('id', $idne)->first();
			$cekdulu= Simpegpegawai::where('program_studi', $idne)->count();
			if ($cekdulu == 0){
				$input 		= MasterPS::where('id', $idne)->delete();
				$keterangan = 'Delete Data PS '.$getdata->nama.' '.$getdata->jenjang;
			} else {
				$input 	= MasterPS::where('id', $idne)->update([
					'kodeps'			=> 'arsip',
					'updated_at'		=> date("Y-m-d H:i:s")
				]);
				$keterangan = 'Data PS '.$getdata->nama.' '.$getdata->jenjang.' Di Set Sebagai Arsip, Karena Masih Ada Pelamar Yang mengambil Prodi Ini';
			}
			$ceksek = Filess::where('url', $idne)->whereNotNull('size')->get();
			if (!empty($ceksek)){
				foreach ($ceksek as $rmaster){
					$nmfile		= $rmaster->title;
					if ($nmfile != ''){
						if (File::exists(public_path()."/".$nmfile)) {
							File::delete(public_path()."/".$nmfile);
						}
					}
					$input 		= Filess::where('id', $rmaster->id)->delete();
				}
			}
		} else if ($idne == 'new'){
			$input 	= MasterPS::create([
				'namapt'			=> $request->input('set11') != null ? $request->input('set11') : 'Universitas Brawijaya',
				'namafak'			=> $namafak,
				'nama'				=> $nama,
				'kodeps'			=> $request->input('set30') != null ? $request->input('set30') : '-',
				'namaenglish'		=> $request->input('set29') != null ? $request->input('set29') : '-',
				'jurusan'			=> $jurusan,
				'jenjang'			=> $request->input('set07') != null ? $request->input('set07') : '-',
				'tanggal'			=> $request->input('set17') != null ? $request->input('set17') : date("Y-m-d"),
				'nosk'				=> $set10,
				'nmpejabat'			=> Session('email'),
				'noskijin'			=> $request->input('set14') != null ? $request->input('set14') : '-',
				'tglskijin'			=> $request->input('set18') != null ? $request->input('set18') : date("Y-m-d"),
				'pejabatijin'		=> $request->input('set16') != null ? $request->input('set16') : '-',
				'alamatps'			=> $request->input('set06') != null ? $request->input('set06') : '-',
				'idpejabat'			=> $request->input('set31') != null ? $request->input('set31') : '-',
				'namakps'			=> $request->input('set21') != null ? $request->input('set21') : '-',
				'jabkps'			=> $request->input('set22') != null ? $request->input('set22') : '-',
				'jeniskps'			=> $request->input('set23') != null ? $request->input('set23') : '-',
				'nipkps'			=> $request->input('set24') != null ? $request->input('set24') : '-',
				'namakajur'			=> $request->input('set25') != null ? $request->input('set25') : '-',
				'jabkajur'			=> $request->input('set26') != null ? $request->input('set26') : '-',
				'jeniskajur'		=> $request->input('set27') != null ? $request->input('set27') : '-',
				'nipkajur'			=> $request->input('set28') != null ? $request->input('set28') : '-',
				'blnthnoperasional'	=> $request->input('set08') != null ? $request->input('set08') : '-',
				'telpon'			=> $request->input('set19') != null ? $request->input('set19') : '-',
				'faksimili'			=> $request->input('set03') != null ? $request->input('set03') : '-',
				'website'			=> $request->input('set20') != null ? $request->input('set20') : '-',
				'email'				=> $request->input('set02') != null ? $request->input('set02') : '-',
				'bloknim'			=> $request->input('set12') != null ? $request->input('set12') : '-',
				'fileskberdiri'		=> '',
				'fileskijin'		=> '',
			]);
			$idne 	= $input->id;
			$ceksek = Filess::where('url', $idne)->where('description', 'REKRUTMEN')->count();
			if ($ceksek == 0){
				Filess::create([
					'name' 			=> 'Scan Surat Lamaran Kerja',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Curriculum Vitae (Daftar Riwayat Hidup)',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Ijazah terakhir',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Transkrip Nilai Terakhir',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan / Foto KTP',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Pas Foto Berwarna (Ukuran Bebas)',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan STR',
					'size' 			=> 0,
					'type' 			=> 'Bagi Yang Memiliki',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Sertifikat Ukom',
					'size' 			=> 0,
					'type' 			=> 'jika ada STR',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Naskah Sumpah',
					'size' 			=> 0,
					'type' 			=> 'jika ada STR',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Sertifikat Pendukung Lainnya',
					'size' 			=> 0,
					'type' 			=> 'Opsional tidak wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
			}
			$ceksoal= Banksoaltest::where('namaujian', $idne)->count();
			if ($ceksoal == 0){
				$sql= Banksoal::where('active', '1')->get();
				if (!empty($sql)){
					foreach ($sql as $rows){
						Banksoaltest::create([
							'ceel'			=> $rows->ceel,
							'kode'			=> $rows->kode,
							'namaujian'		=> $idne,
							'supervisor'	=> Session('email'),
							'tipe'			=> $rows->jawaban,
							'idsoal'		=> $rows->id,
							'marking'		=> $rows->fullkode,
							'mulai'			=> $request->input('set17') != null ? $request->input('set17') : date("Y-m-d"),
							'selesai'		=> $request->input('set18') != null ? $request->input('set18') : date("Y-m-d"),
							'timer'			=> 120,
						]);
					}
				}
			}
			$keterangan = 'Input Data PS '.$request->input('set10').' '.$request->input('set07');
		} else {
			$getoldata 	= MasterPS::where('id', $idne)->first();
			$statuslama = $getoldata->kodeps;
			$input 		= MasterPS::where('id', $idne)->update([
				'namapt'			=> $request->input('set11') != null ? $request->input('set11') : 'Universitas Brawijaya',
				'namafak'			=> $namafak,
				'nama'				=> $nama,
				'kodeps'			=> $request->input('set30') != null ? $request->input('set30') : '-',
				'namaenglish'		=> $request->input('set29') != null ? $request->input('set29') : '-',
				'jurusan'			=> $jurusan,
				'jenjang'			=> $request->input('set07') != null ? $request->input('set07') : '-',
				'tanggal'			=> $request->input('set17') != null ? $request->input('set17') : '-',
				'nosk'				=> $set10,
				'nmpejabat'			=> Session('email'),
				'noskijin'			=> $request->input('set14') != null ? $request->input('set14') : '-',
				'tglskijin'			=> $request->input('set18') != null ? $request->input('set18') : '-',
				'pejabatijin'		=> $request->input('set16') != null ? $request->input('set16') : '-',
				'alamatps'			=> $request->input('set06') != null ? $request->input('set06') : '-',
				'idpejabat'			=> $request->input('set31') != null ? $request->input('set31') : '-',
				'namakps'			=> $request->input('set21') != null ? $request->input('set21') : '-',
				'jabkps'			=> $request->input('set22') != null ? $request->input('set22') : '-',
				'jeniskps'			=> $request->input('set23') != null ? $request->input('set23') : '-',
				'nipkps'			=> $request->input('set24') != null ? $request->input('set24') : '-',
				'namakajur'			=> $request->input('set25') != null ? $request->input('set25') : '-',
				'jabkajur'			=> $request->input('set26') != null ? $request->input('set26') : '-',
				'jeniskajur'		=> $request->input('set27') != null ? $request->input('set27') : '-',
				'nipkajur'			=> $request->input('set28') != null ? $request->input('set28') : '-',
				'blnthnoperasional'	=> $request->input('set08') != null ? $request->input('set08') : '-',
				'telpon'			=> $request->input('set19') != null ? $request->input('set19') : '-',
				'faksimili'			=> $request->input('set03') != null ? $request->input('set03') : '-',
				'website'			=> $request->input('set20') != null ? $request->input('set20') : '-',
				'email'				=> $request->input('set02') != null ? $request->input('set02') : '-',
				'bloknim'			=> $request->input('set12') != null ? $request->input('set12') : '-',
				'updated_at'		=> date("Y-m-d H:i:s")
			]);
			$ceksek = Filess::where('url', $idne)->where('description', 'REKRUTMEN')->count();
			if ($ceksek == 0){
				Filess::create([
					'name' 			=> 'Scan Surat Lamaran Kerja',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Curriculum Vitae (Daftar Riwayat Hidup)',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Ijazah terakhir',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Transkrip Nilai Terakhir',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan / Foto KTP',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Pas Foto Berwarna (Ukuran Bebas)',
					'size' 			=> 0,
					'type' 			=> 'Wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan STR',
					'size' 			=> 0,
					'type' 			=> 'Bagi Yang Memiliki',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Sertifikat Ukom',
					'size' 			=> 0,
					'type' 			=> 'jika ada STR',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Naskah Sumpah',
					'size' 			=> 0,
					'type' 			=> 'jika ada STR',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				Filess::create([
					'name' 			=> 'Scan Sertifikat Pendukung Lainnya',
					'size' 			=> 0,
					'type' 			=> 'Opsional tidak wajib',
					'url' 			=> $idne,
					'title' 		=> '',
					'description' 	=> 'REKRUTMEN',
				]);
			}
			if ($getoldata->kodeps == 'arsip' AND $request->input('set30') != 'arsip'){
				Simpegpegawai::where('program_studi', $getoldata->id)->where('ppabp', 'Rekrutmen PT DPM')->update([
					'program_studi'	=> 0,
				]);
			}
			$keterangan = 'Update Data PS '.$request->input('set10').' '.$request->input('set07');
		}
		if ($input){
			echo $keterangan;
		} else {
			echo 'Gagal Simpan, Mohon Cek Isian dan Ulangi Beberapa Saat lagi';
		}
	}
	public function getFirstPengumuman(Request $request) {
		$idne		= $request->input('val01');
        $homebase	= url("/");
		$hasil		= MasterPS::where('id', $idne)->first();
		if (isset($hasil->id)){
			$getdatasetting 	= Setting::where('ppabp', $hasil->id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting->isi2)){
				$ujian 			= $getdatasetting->isi2;
			} else { $ujian 	= ''; }
			$getdatasetting2 	= Setting::where('ppabp', $hasil->id)->where('jenis', 'ujianwawancara')->first();
			if (isset($getdatasetting2->isi2)){
				$wawancara 		= $getdatasetting2->isi2;
			} else { $wawancara = ''; }
			
			return response()->json([
				'jadwalwawancara'	=> $wawancara,	
				'jadwalujian' 		=> $ujian,	
				'id' 				=> $hasil->id,	
				'kodeps' 			=> $hasil->kodeps,
				'nama' 				=> $hasil->nama,
				'namaenglish'		=> $hasil->namaenglish,
				'jenjang' 			=> $hasil->jenjang,
				'tanggal' 			=> $hasil->tanggal,
				'namapt' 			=> $hasil->namapt,
				'namafak' 			=> $hasil->namafak,
				'nosk' 				=> $hasil->nosk,
				'nmpejabat' 		=> $hasil->nmpejabat,
				'noskijin' 			=> $hasil->noskijin,
				'tglskijin' 		=> $hasil->tglskijin,
				'pejabatijin' 		=> $hasil->pejabatijin,
				'alamatps' 			=> $hasil->alamatps,
				'idpejabat' 		=> $hasil->idpejabat,
				'mulai' 			=> $hasil->blnthnoperasional,
				'telpon' 			=> $hasil->telpon,
				'faksimili' 		=> $hasil->faksimili,
				'website' 			=> $hasil->website,
				'email' 			=> $hasil->email,
				'bloknim' 			=> $hasil->bloknim,
				'fileijin' 			=> $hasil->fileskijin,
			]);
		}
		return back();
	}
	public function getFirstPeminat(Request $request) {
		$idpeg		= $request->input('val01');
        $homebase	= url("/");
		$tabel 		= '';
		$tandatangan= '';
		$biodata	= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idpeg)->first();
		if (isset($biodata->idpeg)){
			$kepakaran	= $biodata->kepakaran;
			$foto		= $biodata->foto;
			$status		= $biodata->status_pegawai;
			if ($status == '' OR is_null($status)){
				$status	= '<a href="#" class="text-danger btn btn-block btn-info">Un Verified</a>';
			} else {
				if ($status == 'Terverifikasi'){
					$status	= '<a href="#" class="text-danger btn btn-block btn-success">Verified</a>';
				} else {
					$status	= '<a href="#" class="text-success btn btn-block btn-danger">'.$status.'</a>';
				}
			}
			if ($kepakaran != ''){
				$gettls = KLasifikasikepakaran::where('id', $kepakaran)->first();
				if (isset($gettls->id)){
					$kepakaran = $gettls->kategori.' '.$gettls->kepakaran;
				}
			}
			$getjabatan	= User::where('id', $idpeg)->first();
			if (isset($getjabatan->tandatangan)){
				$tandatangan= $getjabatan->tandatangan;
			}			
			if ($foto != ''){
				$foto	= str_replace('photo/', '', $foto);
				$foto 	= $homebase.'/images/pegawai/'.$foto;
			} else { $foto 	= $homebase.'/mascot.png'; }
			$tabel = '
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="30">&nbsp;</td>
						<td width="76">&nbsp;</td>
						<td width="13">&nbsp;</td>
						<td width="167">&nbsp;</td>
						<td width="105">&nbsp;</td>
						<td width="119">&nbsp;</td>
						<td width="81">&nbsp;</td>
						<td width="77">&nbsp;</td>
						<td width="116">&nbsp;</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri" valign="top">1.</td>
						<td colspan="3" class="atas kanan" valign="top">Tempat Lahir / Tgl. Lahir
						</td>
						<td colspan="5" class="atas kanan">'. $biodata->tmpt_lahir .' / '. $biodata->tgl_lahir .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri" valign="top">2.</td>
						<td colspan="3" class="atas kanan" valign="top">Jenis Kelamin</td>
						<td colspan="5" class="atas kanan">'. $biodata->jenis_kelamin .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri" valign="top">3.</td>
						<td colspan="3" class="atas kanan" valign="top">Agama</td>
						<td colspan="5" class="atas kanan">'. $biodata->agama .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri" valign="top">4.</td>
						<td colspan="3" class="atas kanan" valign="top">Status perkawinan</td>
						<td colspan="5" class="atas kanan">'. $biodata->kawin .'</td>
					</tr>
					<tr>
						<td rowspan="5" class="atas kanan kiri" align="center" valign="top">5.</td>
						<td rowspan="5"  class="atas kanan" valign="top">Alamat Rumah</td>
						<td align="center"  class="atas kanan">a.</td>
						<td class="atas kanan" valign="top">Jalan</td>
						<td colspan="5" class="atas kanan">'. $biodata->alamat .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">b.</td>
						<td class="atas kanan" valign="top">Kelurahan</td>
						<td colspan="5" class="atas kanan">'. $biodata->kelurahan .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">c.</td>
						<td class="atas kanan" valign="top">Kecamatan</td>
						<td colspan="5" class="atas kanan">'. $biodata->kecamatan .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">d.</td>
						<td class="atas kanan" valign="top">Kabupaten / Kota</td>
						<td colspan="5" class="atas kanan">'. $biodata->kota .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">e.</td>
						<td class="atas kanan" valign="top">Propinsi</td>
						<td colspan="5" class="atas kanan">'. $biodata->propinsi .'</td>
					</tr>
					<tr>
						<td rowspan="7" class="atas kanan kiri" align="center" valign="top">6.</td>
						<td rowspan="7" class="atas kanan" valign="top">Keterangan Badan</td>
						<td align="center" class="atas kanan">a.</td>
						<td class="atas kanan" valign="top">Tinggi (Cm)</td>
						<td colspan="5" class="atas kanan">'. $biodata->tinggibdn .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">b.</td>
						<td class="atas kanan" valign="top">Berat Badan (Kg)</td>
						<td colspan="5" class="atas kanan">'. $biodata->beratbdn .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">c.</td>
						<td class="atas kanan" valign="top">Rambut</td>
						<td colspan="5" class="atas kanan">'. $biodata->bentukrambut .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">d.</td>
						<td class="atas kanan" valign="top">Bentuk muka</td>
						<td colspan="5" class="atas kanan">'. $biodata->bentukmuka .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">e.</td>
						<td class="atas kanan" valign="top">Warna kulit</td>
						<td colspan="5" class="atas kanan">'. $biodata->warnakulit .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">f.</td>
						<td class="atas kanan" valign="top">Ciri-ciri khas</td>
						<td colspan="5" class="atas kanan">'. $biodata->cirikusus .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan">g.</td>
						<td class="atas kanan" valign="top">Cacat tubuh</td>
						<td colspan="5" class="atas kanan">'. $biodata->cacattubuh .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri bawah">7.</td>
						<td colspan="3" class="atas kanan bawah">Kegemaran (Hobby)</td>
						<td colspan="5" class="atas kanan bawah">'. $biodata->hobi .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri bawah">8.</td>
						<td colspan="3" class="atas kanan bawah">Bidang Ilmu</td>
						<td colspan="5" class="atas kanan bawah">'. $biodata->bidang_ilmu3 .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri bawah">9.</td>
						<td colspan="3" class="atas kanan bawah">Kepakaran</td>
						<td colspan="5" class="atas kanan bawah">'. $kepakaran .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri bawah">9.</td>
						<td colspan="3" class="atas kanan bawah">Status</td>
						<td colspan="5" class="atas kanan bawah">'. $status .'</td>
					</tr>
					<tr>
						<td align="center" class="atas kanan kiri bawah">10.</td>
						<td colspan="3" class="atas kanan bawah">URL</td>
						<td colspan="5" class="atas kanan bawah">'. $biodata->ppabp .'</td>
					</tr>
					<tr>
						<td align="center">&nbsp;</td>
						<td valign="top">&nbsp;</td>
						<td align="center">&nbsp;</td>
						<td valign="top">&nbsp;</td>
						<td colspan="5"  align="center"><img src="'.$tandatangan.'" alt="image" width="100" height="100"></td>
					</tr>
					<tr>
						<td align="center">&nbsp;</td>
						<td valign="top">&nbsp;</td>
						<td align="center">&nbsp;</td>
						<td valign="top">&nbsp;</td>
						<td colspan="5"  align="center">'. $biodata->nama_lengkap .'</td>
					</tr>
				</table>
			';
		}
		echo $tabel;
	}
	public function jsonDataSyaratPelamar(Request $request) {
    	$jenisujian = $request->input('val01');
		$masterno   = $request->input('val02');
		$homebase	= url("/");
		$arraydata	= [];
		if ($masterno == '' OR $masterno == '0' OR is_null($masterno)){
		} else {
			$ceksek  	= Filess::where('size', $masterno)->count();
			if ($ceksek == 0){
				Filess::create([
					'name' 			=> 'Scan Surat Lamaran Kerja',
					'size' 			=> $masterno,
					'type' 			=> 'Wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan Curriculum Vitae (Daftar Riwayat Hidup)',
					'size' 			=> $masterno,
					'type' 			=> 'Wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan Ijazah terakhir',
					'size' 			=> $masterno,
					'type' 			=> 'Wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan Transkrip Nilai Terakhir',
					'size' 			=> $masterno,
					'type' 			=> 'Wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan / Foto KTP',
					'size' 			=> $masterno,
					'type' 			=> 'Wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Pas Foto Berwarna (Ukuran Bebas)',
					'size' 			=> $masterno,
					'type' 			=> 'Wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan STR',
					'size' 			=> $masterno,
					'type' 			=> 'Bagi Yang Memiliki',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan Sertifikat Ukom',
					'size' 			=> $masterno,
					'type' 			=> 'jika ada STR',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan Naskah Sumpah',
					'size' 			=> $masterno,
					'type' 			=> 'jika ada STR',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
				Filess::create([
					'name' 			=> 'Scan Sertifikat Pendukung Lainnya',
					'size' 			=> $masterno,
					'type' 			=> 'Opsional tidak wajib',
					'url' 			=> $jenisujian,
					'title' 		=> '',
					'description' 	=> '',
				]);
			}
		}
		if ($masterno == '' OR $masterno == '0' OR is_null($masterno)){
			$arraydata  	= Filess::where('url', $jenisujian)->where('description', 'REKRUTMEN')->get();
		} else {
			$arraydata  	= Filess::where('size', $masterno)->get();
		}
		echo json_encode($arraydata);
	}
	public function exInputBerkasPelamar(Request $request) {
    	$idne		= $request->input('set01');
		$berkasid	= $request->input('set02');
		$name		= $request->input('set03');
		$type		= $request->input('set04');
		$jenis		= $request->input('set05');
		$sukses		= '';
		$gagal		= '';
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($jenis == 'delete'){
			$rmaster 		= Filess::where('id', $berkasid)->first();
			if (isset($rmaster->title)){
				$nmfile		= $rmaster->title;
			} else { $nmfile = ''; }
			if ($nmfile != ''){
				if (File::exists(public_path()."/".$nmfile)) {
					File::delete(public_path()."/".$nmfile);
				}
			}
			$input 		= Filess::where('id', $berkasid)->delete();	
			if ($input) { $sukses = 'Sukses Menghapus Data'; }
			else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else if ($jenis == 'remove'){
			$rmaster 		= Filess::where('id', $berkasid)->first();
			if (isset($rmaster->description)){
				$nmfile		= $rmaster->description;
			} else { $nmfile = ''; }
			if ($nmfile != ''){
				if (File::exists(public_path()."/".$nmfile)) {
					File::delete(public_path()."/".$nmfile);
				}
			}
			$input 		= Filess::where('id', $berkasid)->update([
				'description'	=> '',
				'updated_at'	=> date("Y-m-d H:i:s")
			]);	
			if ($input) { $sukses = 'Sukses Menghapus Data'; }
			else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else if ($jenis == 'inputberkas'){
			if ($request->hasFile('file')) {
				if($validator->fails()) {
					$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
				} else {
					$nmfile1 = Session('iduser').'-'.$berkasid.'-'.time().'.'.$request->file('file')->getClientOriginalExtension();
					$request->file('file')->move(public_path('images/'.Session('iduser').'/'), $nmfile1);
					$nmfile1 = $homebase.'/images/'.Session('iduser').'/'.$nmfile1;
				}
			} else {
				$nmfile1 = $name;
			}
			if($gagal == '') {
				$rmaster 		= Filess::where('id', $berkasid)->first();
				if (isset($rmaster->description)){
					$nmfile		= $rmaster->description;
				} else { $nmfile = ''; }
				$input = Filess::where('id', $berkasid)->update([
					'description'	=> $nmfile1,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($input) { 
					$sukses = 'Sukses Menambah Data';
					if ($nmfile != ''){
						if (File::exists(public_path()."/".$nmfile)) {
							File::delete(public_path()."/".$nmfile);
						}
					}
				} else { 
					$gagal = 'Gagal Menambah '.$name.', Silahkan Coba Beberapa Saat Lagi';
				}
			}
		} else {
			if ($berkasid == 'new'){
				$input = Filess::create([
					'name'			=> $name,
					'type'			=> $type,
					'size'			=> 0,
					'url'			=> $idne,
					'title'			=> '',
					'description' 	=> 'REKRUTMEN',
				]);
				$berkasid = $input->id;
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb';
					} else {
						$nmfile1 = $idne.'-'.time().'.'.$request->file('file')->getClientOriginalExtension();
						$request->file('file')->move(public_path('download/'), $nmfile1);
						Filess::where('id', $berkasid)->update([
							'size'			=> 1,
							'title'			=> 'download/'.$nmfile1,
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					}
				}
				if ($input) { $sukses = 'Sukses Menambah Data'; }
				else { $gagal = 'Gagal Menambah '.$name.', Silahkan Coba Beberapa Saat Lagi'; }
			} else {
				$rmaster 		= Filess::where('id', $berkasid)->first();
				if (isset($rmaster->title)){
					$nmfile		= $rmaster->title;
				} else { $nmfile = ''; }
				
				$input 		= Filess::where('id', $berkasid)->update([
					'name'			=> $name,
					'type'			=> $type,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb';
					} else {
						if (File::exists(public_path()."/".$nmfile)) {
							File::delete(public_path()."/".$nmfile);
						}
						$nmfile1 = $idne.'-'.time().'.'.$request->file('file')->getClientOriginalExtension();
						$request->file->move(public_path('download/'), $nmfile1);
						Filess::where('id', $berkasid)->update([
							'size'			=> 1,
							'title'			=> 'download/'.$nmfile1,
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					}
				}
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data '.$berkasid.', Silahkan Coba Beberapa Saat Lagi'; }
			}			
		}
		if ($sukses != ''){
			echo $sukses;
		} else {
			echo $gagal;
		}
	}
	public function jsonSetting(Request $request) {
		$arraysurat 	= [];
		$homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		$data 	    	= MasterPS::where('kodeps', '!=', 'arsip')->get();
		if (!empty($data)){
			foreach ($data as $hasil){
				$idsoal 		= $hasil->id;
				$created_by 	= $hasil->created_by;
				$setting 		= '';
				$jadwal 		= '';
				$sekolah 		= '';
				$getdatasetting = Setting::where('ppabp', $hasil->id)->where('jenis', 'ujiankompetensi')->first();
				if (isset($getdatasetting->id)){
					$sekolah 	= $getdatasetting->sekolah;
					$setting 	= $getdatasetting->isi1;
					$jadwal 	= $getdatasetting->isi2;
					$created_by = $getdatasetting->created_by;
				}
				$arraysurat[] = array(
					'idne' 			=> $hasil->id,
					'nama' 			=> $hasil->nama.'( '.$hasil->jenjang.' )',
					'sekolah' 		=> $sekolah,
					'created_by' 	=> $created_by,
					'ujian' 		=> $setting,
					'jadwal' 		=> $jadwal,
					'jumlah'		=> Simpegpegawai::where('program_studi', $hasil->id)->where('ppabp', 'Rekrutmen PT DPM')->count()
				);
			}
		}
		echo json_encode($arraysurat);
    }
	public function exInputSetting(Request $request) {
		$id   		= $request->input('set01');
        $valisi2   	= $request->input('set02');
        $jenis   	= $request->input('set03');
		$pesan		= 'Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
		$input		= null;
        if ($jenis == 'wawancara'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujianwawancara')->first();
			if (isset($getdatasetting2->isi2)){
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujianwawancara')->update([
					'isi2'			=> $valisi2,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujianwawancara',
					'isi1'			=> 'Close',
					'isi2'			=> $valisi2,
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Wawancara Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Wawancara Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'ujian'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi2'			=> $valisi2,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> $valisi2,
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'onoff'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $valisi2,
					'sekolah'		=> $request->input('set04'),
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'sekolah'		=> $request->input('set04'),
					'isi1'			=> $valisi2,
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Berkas Pendidikan'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$isi1 			= $getdatasetting2->isi1;
				if ($isi1 == ''){
					$isi1 = 'Close';
				} else {
					$isi1 = '';
				}
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $isi1,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Berkas Riwayat Kerja'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$isi1 			= $getdatasetting2->isi1;
				if ($isi1 == ''){
					$isi1 = 'Close';
				} else {
					$isi1 = '';
				}
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $isi1,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Berkas Keluarga'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$isi1 			= $getdatasetting2->isi1;
				if ($isi1 == ''){
					$isi1 = 'Close';
				} else {
					$isi1 = '';
				}
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $isi1,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Berkas Diklat'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$isi1 			= $getdatasetting2->isi1;
				if ($isi1 == ''){
					$isi1 = 'Close';
				} else {
					$isi1 = '';
				}
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $isi1,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Berkas Penghargaan'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$isi1 			= $getdatasetting2->isi1;
				if ($isi1 == ''){
					$isi1 = 'Close';
				} else {
					$isi1 = '';
				}
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $isi1,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Berkas Upload'){
			$getdatasetting2 	= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->first();
			if (isset($getdatasetting2->id)){
				$isi1 			= $getdatasetting2->isi1;
				if ($isi1 == ''){
					$isi1 = 'Close';
				} else {
					$isi1 = '';
				}
				$input 		= Setting::where('ppabp', $id)->where('jenis', 'ujiankompetensi')->update([
					'isi1'			=> $isi1,
					'created_by'	=> Session('email'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			} else { 
				$input 		= Setting::create([
					'ppabp'			=> $id,
					'jenis'			=> 'ujiankompetensi',
					'isi1'			=> 'Close',
					'isi2'			=> '',
					'created_by'	=> Session('email'),
				]);
			}
			if ($input){
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Simpan';
			} else {
				$pesan 	= 'Setting Jadwal Ujian Kompetensi Berhasil di Gagal di Simpan';
			}	
		} else if ($jenis == 'Biodata'){
			$status   	= $request->input('set04');
			if ($status == 'Lain' OR $status == 'lain'){
				$status 	= $valisi2;
				$input 		= Simpegpegawai::where('id', $id)->update([
					'status_pegawai'=> $status,
					'keterangan'	=> $valisi2,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$getkode 	= Simpegpegawai::where('id', $id)->first();
				$subject	= 'Gagal Tahap Verifikasi Berkas';
				$note       = 'Mohon Maaf Berkas telah kami periksa dan dinyatakan pending dengan catatan : <p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;">'.$valisi2.'</div></p><p>Ditulis Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p>';
				SendMail::notif($getkode->nama_lengkap, $getkode->email, $subject, $note);
			} else if ($status == 'Diterima'){
				$input 		= Simpegpegawai::where('id', $id)->update([
					'status_pegawai'=> $status,
					'keterangan'	=> $valisi2,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$getkode 	= Simpegpegawai::where('id', $id)->first();
				$subject	= 'Lolos Tahap Seleksi Penerimaan';
				$note       = 'Selamat Bapak/Ibu telah lolos tahap seleksi, silahkan login kembali untuk melihat pengumuman berikutnya.<p>Diverfikasi Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="https://rekrutmen.disaprimamedika.site/" target="_blank">https://rekrutmen.disaprimamedika.site</a></div></p>';
				SendMail::notif($getkode->nama_lengkap, $getkode->email, $subject, $note);
			} else if ($status == 'Lolos Tahap Wawancara'){
				$input 		= Simpegpegawai::where('id', $id)->update([
					'status_pegawai'=> $status,
					'keterangan'	=> $valisi2,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$getkode 	= Simpegpegawai::where('id', $id)->first();
				$subject	= 'Lolos Tahap Wawancara';
				$note       = 'Selamat Bapak/Ibu telah lolos tahap wawancara, Sistem akan mengarahkan anda ke Portal Unit Kerja Yang Baru. Mohon Bersabar kami segera mengirimkan surat keputusan penerimaan staf dan kontrak pertama untuk Bapak/Ibu melalui Aplikasi Ini.<p>Diverfikasi Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p></p>';
				SendMail::notif($getkode->nama_lengkap, $getkode->email, $subject, $note);
			} else if ($status == 'Gagal Tahap Wawancara'){
				$input 		= Simpegpegawai::where('id', $id)->update([
					'status_pegawai'=> $status,
					'keterangan'	=> $valisi2,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$getkode 	= Simpegpegawai::where('id', $id)->first();
				$subject	= 'Gagal Tahap Wawancara';
				$note       = 'Yth. '.$getkode->nama_lengkap.', </p><p>Mohon Maaf, Kami keputusan panitia penerimaan pegawai menyatakan Bapak/Ibu Gagal Tahap Wawancara. Terimakasih telah meluangkan waktu untuk melamar.</p><p>Semoga Bapak/Ibu diterima di tempat lain yang lebih baik. Semoga Sukses dan Sehat Selalu.</p><p>Diverfikasi Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p></p><p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;">'.$valisi2.'</div></p>';
				SendMail::notif($getkode->nama_lengkap, $getkode->email, $subject, $note);
				$rsurat  	= Filess::where('size', $getkode->id)->get();
				if (!empty($rsurat)){
					foreach ($rsurat as $rows){
						$namafile = $rows->description;
						if (File::exists(public_path() ."/images/".$getkode->id."/". $namafile)) {
							File::delete(public_path() ."/images/".$getkode->id."/". $namafile);
						}
						if (File::exists(public_path() ."/scan/files/". $namafile)) {
							File::delete(public_path() ."/scan/files/". $namafile);
						}
						Filess::where('id', $rows->id)->delete();
					}
				}
				$carilagi1 	= Detailpendidikan::where('no', $getkode->id)->get();
				if(!empty($carilagi1)){
					foreach($carilagi1 as $rows){
						$namafile = $rows->bukti;
						if (File::exists(public_path() ."/images/".$getkode->id."/". $namafile)) {
							File::delete(public_path() ."/images/".$getkode->id."/". $namafile);
						}
						if (File::exists(public_path() ."/scan/files/". $namafile)) {
							File::delete(public_path() ."/scan/files/". $namafile);
						}
						Detailpendidikan::where('id', $rows->id)->delete();
					}
				}
				$carilagi2 	= Detailidentitas::where('no', $getkode->id)->get();
				if(!empty($carilagi2)){
					foreach($carilagi2 as $rows){
						$namafile = $rows->bukti;
						if (File::exists(public_path() ."/images/".$getkode->id."/". $namafile)) {
							File::delete(public_path() ."/images/".$getkode->id."/". $namafile);
						}
						if (File::exists(public_path() ."/scan/files/". $namafile)) {
							File::delete(public_path() ."/scan/files/". $namafile);
						}
						Detailidentitas::where('id', $rows->id)->delete();
					}
				}
				$carilagi3 	= Detailsertifikat::where('no', $getkode->id)->get();
				if(!empty($carilagi3)){
					foreach($carilagi3 as $rows){
						$namafile = $rows->nmfile;
						if (File::exists(public_path() ."/images/".$getkode->id."/". $namafile)) {
							File::delete(public_path() ."/images/".$getkode->id."/". $namafile);
						}
						if (File::exists(public_path() ."/scan/files/". $namafile)) {
							File::delete(public_path() ."/scan/files/". $namafile);
						}
						Detailsertifikat::where('id', $rows->id)->delete();
					}
				}
			} else {
				$getkode 	= Simpegpegawai::where('id', $id)->first();
				$kode 		= $getkode->kode;
				if ($kode == ''){
					$kode 	= $id.'-'.time();
				}
				$input 		= Simpegpegawai::where('id', $id)->update([
					'kode'			=> $kode,
					'status_pegawai'=> $status,
					'keterangan'	=> $valisi2,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$subject	= 'Lolos Tahap Seleksi Berkas';
				$note       = 'Selamat Berkas Administrasi Bapak/Ibu telah lolos tahap seleksi, silahkan login kembali untuk tahapan selanjutnya.<p>Diverfikasi Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="https://rekrutmen.disaprimamedika.site/" target="_blank">https://rekrutmen.disaprimamedika.site</a></div></p>';
				SendMail::notif($getkode->nama_lengkap, $getkode->email, $subject, $note);
			}
			if ($input){
				$pesan 	= 'Set Status Ke '.$status;
			} else {
				$pesan 	= 'Set Status Ke '.$status.' Gagal di Simpan';
			}	
		} else if ($jenis == 'resetnilai'){
			$getkode 	= Simpegpegawai::where('id', $id)->first();
			$email 		= $getkode->email;
			$input 		= User::where('email', $email)->update([
				'smt'			=> '',
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($input){
				$marking	= $getkode->id.'-'.$getkode->program_studi;
				Banksoaltest::where('marking', $marking)->delete();
				Banksoalujian::where('idmahasiswa', $id)->delete();
				$pesan 	= 'Set Status Ke Reset';
			} else {
				$pesan 	= 'Set Status Gagal di Simpan';
			}	
		} else if ($jenis == 'interview'){
			$set02	= $request->input('set02') != null ? $request->input('set02') : '-';
			$set04	= $request->input('set04') != null ? $request->input('set04') : '0';
			$set05	= $request->input('set05') != null ? $request->input('set05') : '0';
			$set06	= $request->input('set06') != null ? $request->input('set06') : '0';
			$set07	= $request->input('set07') != null ? $request->input('set07') : '0';
			$set08	= $request->input('set08') != null ? $request->input('set08') : '0';
			$set09	= $request->input('set09') != null ? $request->input('set09') : '0';
			$set10	= $request->input('set10') != null ? $request->input('set10') : '0';
			$set11	= $request->input('set11') != null ? $request->input('set11') : '0';
			$set12	= $request->input('set12') != null ? $request->input('set12') : '0';
			$set13	= $request->input('set13') != null ? $request->input('set13') : '0';
			$tulis	= $set04.'[psh]'.$set05.'[psh]'.$set06.'[psh]'.$set07.'[psh]'.$set08.'[psh]'.$set09.'[psh]'.$set10.'[psh]'.$set11.'[psh]'.$set12.'[psh]'.$set13.'[psh]'.$set02;
			$set04 	= str_replace(',','',$set04);
			$set05 	= str_replace(',','',$set05);
			$set06 	= str_replace(',','',$set06);
			$set07 	= str_replace(',','',$set07);
			$set08 	= str_replace(',','',$set08);
			$set09 	= str_replace(',','',$set09);
			$set10 	= str_replace(',','',$set10);
			$set11 	= str_replace(',','',$set11);
			$set12 	= str_replace(',','',$set12);
			$set13 	= str_replace(',','',$set13);
			$total 	= $set04 + $set05 + $set06 + $set07 + $set08 + $set09 + $set10 + $set11 + $set12;
			$total 	= round(($total/9), 2);
			$input	= Simpegpegawai::where('id', $id)->update([
				'idremun'		=> $total,
				'idregptk'		=> $tulis,
				'keterangan'	=> $set02,
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($input){
				$pesan 	= 'Nilai Interview '.$total.' Saved';
			} else {
				$pesan 	= 'Nilai Interview Gagal di Simpan, Pastikan isian angka tidak ada spasi maupun koma';
			}	
		} else {
			$pesan = 'Setting Verifikasi Untuk '.$jenis.' Belum di Fungsikan';
		}
		if ($input){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $pesan]);
			return back();
		} else { 
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
			return back();
		}
	}
	public function jsonDataPeminat(Request $request) {
    	$idprodi  		= $request->input('val01');
		$pencarian  	= $request->input('val02');
		$arraydata		= [];
		$homebase		= url("/");
		$totaldata  	= 0;
		$filterscount	= 0;
		$limit         	= 10;
		$page			= 0;
		$pimpinan 		= '';
		if ($idprodi == 'Pelamar'){
			$arraydata		= Simpegpegawai::where('jenispeg', 'Pelamar')->where('ppabp', 'Rekrutmen PT DPM')->get();
		} else if ($idprodi == 'Aktif'){
			$arraydata		= Simpegpegawai::where('status_pegawai', '1')->where('ppabp', '!=', 'Rekrutmen PT DPM')->get();
		} else {
			if ($pencarian == 'peminat'){
				$data		= Simpegpegawai::where('program_studi', $idprodi)->whereNotIn('status_pegawai', ['Terverifikasi', 'Diterima', 'Lolos Tahap Wawancara'])->get();
			} else if ($pencarian == 'diterima'){
				$data		= Simpegpegawai::where('program_studi', $idprodi)->whereIn('status_pegawai', ['Terverifikasi', 'Diterima', 'Lolos Tahap Wawancara'])->get();
			} else {
				$data		= Simpegpegawai::where('program_studi', $idprodi)->get();
			}
			$statusopen 	= 'aktif';
			$getstatus		= MasterPS::where('id', $idprodi)->first();
			if (isset($getstatus->id)){
				$statusopen	= $getstatus->kodeps;
			}
			if (!empty($data)) {
				foreach ($data as $hasil) {
					$status     = $hasil->status_pegawai;
					$foto    	= $hasil->foto;
					$prodi    	= $hasil->program_studi;
					$saatdaftar = $hasil->created_at;
					$countkd 	= 0;
					$selesaikd	= 0;
					$nilaikd 	= 0;
					$countkb 	= 0;
					$selesaikb	= 0;
					$nilaikb 	= 0;
					$getnilai	= Banksoalujian::where('idmahasiswa', $hasil->id)->where('marking', $hasil->id.'-'.$prodi)->get();
					if (!empty($getnilai)){
						foreach ($getnilai as $rows){
							$kode 		= $rows->kode;
							$jawaban 	= $rows->jawaban;
							$skore 		= $rows->skore;
							if ($kode == 'KD'){
								$countkd++;
								if ($jawaban != ''){ $selesaikd++; }
								$nilaikd	= $nilaikd + $skore;
							} else {
								$countkb++;
								if ($jawaban != ''){ $selesaikb++; }
								$nilaikb	= $nilaikb + $skore;
							}
						}
					}
					$getnsoal	= Banksoalujian::where('idmahasiswa', $hasil->id)->count();
					$total 		= $nilaikb + $nilaikd;
					$total 		= $total;
					if (is_null($foto) OR $foto == ''){
						$foto 	= '<img width="35" alt="Avatar" class="table-avatar" src="mascot.png">';
						$fotourl= 'mascot.png';
					} else {
						$foto 	= '<img alt="Avatar" width="35" class="table-avatar" src="images/pegawai/'.$foto.'">';
						$fotourl= 'images/pegawai/'.$hasil->foto;
					}
					if ($hasil->status_pegawai == '1' OR $hasil->status_pegawai == '' OR $hasil->status_pegawai == null){
						$tlsstatus = '<span class="badge badge-danger float-right "><i class="fa fa-spinner"></i></span>';
						if ($statusopen == 'arsip'){
							$foto = '/images/pegawai/'.$hasil->foto;
							if (File::exists(public_path()."/".$foto)) {
								File::delete(public_path()."/".$foto);
							}
							$ceksek = Filess::where('size', $hasil->id)->get();
							if (!empty($ceksek)){
								foreach ($ceksek as $rmaster){
									$nmfile		= $rmaster->title;
									if ($nmfile != ''){
										if (File::exists(public_path()."/".$nmfile)) {
											File::delete(public_path()."/".$nmfile);
										}
									}
									Filess::where('id', $rmaster->id)->delete();
								}
							}
							$direktory1 = '/images/'.$hasil->id.'/';
							$direktory2 = '/download/'.$hasil->id.'/';
							Storage::deleteDirectory($direktory1);
							Storage::deleteDirectory($direktory2);
						}
					} else if ($hasil->status_pegawai == 'Terverifikasi'){
						$tlsstatus = '<span class="badge badge-success float-right "><i class="fa fa-check"></i></span>';
					} else if ($hasil->status_pegawai == 'Diterima'){
						$tlsstatus = '<span class="badge badge-info float-right "><i class="fa fa-trophy"></i></span>';
					} else if ($hasil->status_pegawai == 'Lolos Tahap Wawancara'){
						$tlsstatus = '<span class="badge badge-success float-right "><i class="fa fa-graduation-cap"></i></span>';
					} else if ($hasil->status_pegawai == 'Gagal Tahap Wawancara'){
						$foto = '/images/pegawai/'.$hasil->foto;
						if (File::exists(public_path()."/".$foto)) {
							File::delete(public_path()."/".$foto);
						}
						$ceksek = Filess::where('size', $hasil->id)->get();
						if (!empty($ceksek)){
							foreach ($ceksek as $rmaster){
								$nmfile		= $rmaster->title;
								if ($nmfile != ''){
									if (File::exists(public_path()."/".$nmfile)) {
										File::delete(public_path()."/".$nmfile);
									}
								}
								Filess::where('id', $rmaster->id)->delete();
							}
						}
						$direktory1 = '/images/'.$hasil->id.'/';
						$direktory2 = '/download/'.$hasil->id.'/';
						Storage::deleteDirectory($direktory1);
						Storage::deleteDirectory($direktory2);
						$tlsstatus = '<span class="badge badge-danger float-right "><i class="fa fa-times-circle"></i></span>';
					} else {
						if ($statusopen == 'arsip'){
							$foto = '/images/pegawai/'.$hasil->foto;
							if (File::exists(public_path()."/".$foto)) {
								File::delete(public_path()."/".$foto);
							}
							$ceksek = Filess::where('size', $hasil->id)->get();
							if (!empty($ceksek)){
								foreach ($ceksek as $rmaster){
									$nmfile		= $rmaster->title;
									if ($nmfile != ''){
										if (File::exists(public_path()."/".$nmfile)) {
											File::delete(public_path()."/".$nmfile);
										}
									}
									Filess::where('id', $rmaster->id)->delete();
								}
							}
							$direktory1 = '/images/'.$hasil->id.'/';
							$direktory2 = '/download/'.$hasil->id.'/';
							Storage::deleteDirectory($direktory1);
							Storage::deleteDirectory($direktory2);
						}
						$tlsstatus = '<span class="badge badge-danger float-right"><i class="fa fa-info"></i>'.$status.'</span>';
					}
					$setval01	= '';
					$setval02	= '';
					$setval03	= '';
					$setval04	= '';
					$setval05	= '';
					$setval06	= '';
					$setval07	= '';
					$setval08	= '';
					$setval09	= '';
					$setval10	= '';
					$setval11	= '';
					$setval12	= '';
					$setval13	= '';
					$setval14	= '';
					$setval15	= '';
					$setval16	= '';
					$setval17	= '';
					$setval18	= '';
					$setval19	= '';
					$setval20	= '';
					$arrisine 	= explode('[psh]', $hasil->idregptk);
					if(isset($arrisine[0])){ $setval01 = $arrisine[0]; }
					if(isset($arrisine[1])){ $setval02 = $arrisine[1]; }
					if(isset($arrisine[2])){ $setval03 = $arrisine[2]; }
					if(isset($arrisine[3])){ $setval04 = $arrisine[3]; }
					if(isset($arrisine[4])){ $setval05 = $arrisine[4]; }
					if(isset($arrisine[5])){ $setval06 = $arrisine[5]; }
					if(isset($arrisine[6])){ $setval07 = $arrisine[6]; }
					if(isset($arrisine[7])){ $setval08 = $arrisine[7]; }
					if(isset($arrisine[8])){ $setval09 = $arrisine[8]; }
					if(isset($arrisine[9])){ $setval10 = $arrisine[9]; }
					if(isset($arrisine[10])){ $setval11 = $arrisine[10]; }
					if(isset($arrisine[11])){ $setval12 = $arrisine[11]; }
					if(isset($arrisine[12])){ $setval13 = $arrisine[12]; }
					if(isset($arrisine[13])){ $setval14 = $arrisine[13]; }
					if(isset($arrisine[14])){ $setval15 = $arrisine[14]; }
					if(isset($arrisine[15])){ $setval16 = $arrisine[15]; }
					if(isset($arrisine[16])){ $setval17 = $arrisine[16]; }
					if(isset($arrisine[17])){ $setval18 = $arrisine[17]; }
					if(isset($arrisine[18])){ $setval19 = $arrisine[18]; }
					if(isset($arrisine[19])){ $setval20 = $arrisine[19]; }
					
					$arraydata[] = array(
						'getnsoal' 				=> $getnsoal,
						'setval01' 				=> $setval01,
						'setval02' 				=> $setval02,
						'setval03' 				=> $setval03,
						'setval04' 				=> $setval04,
						'setval05' 				=> $setval05,
						'setval06' 				=> $setval06,
						'setval07' 				=> $setval07,
						'setval08' 				=> $setval08,
						'setval09' 				=> $setval09,
						'setval10' 				=> $setval10,
						'setval11' 				=> $setval11,
						'setval12' 				=> $setval12,
						'setval13' 				=> $setval13,
						'setval14' 				=> $setval14,
						'setval15' 				=> $setval15,
						'setval16' 				=> $setval16,
						'setval17' 				=> $setval17,
						'setval18' 				=> $setval18,
						'setval19' 				=> $setval19,
						'setval20' 				=> $setval20,
						'fotourl' 				=> $fotourl,
						'countkd' 				=> $countkd,
						'selesaikd' 			=> $selesaikd,
						'nilaikd' 				=> $nilaikd,
						'countkb' 				=> $countkb,
						'selesaikb' 			=> $selesaikb,
						'nilaikb' 				=> $nilaikb,
						'total' 				=> $total,
						'idne'            		=> $hasil->id,
						'idpeg' 	    		=> $hasil->idpeg,	
						'jenispeg' 				=> $hasil->jenispeg,
						'fungsional' 			=> $hasil->fungsional,
						'nik' 					=> $hasil->nik,
						'nokk' 					=> $hasil->nokk,
						'nama_lengkap' 		 	=> $hasil->nama_lengkap.' '.$tlsstatus,
						'nama' 					=> $hasil->nama,
						'depan'         		=> $hasil->depan,
						'belakang'      		=> $hasil->belakang,
						'depan2'        		=> $hasil->depandinilai,
						'belakang2'     		=> $hasil->belakangdinilai,
						'jenisnip' 				=> $hasil->jenisnip,
						'niplama' 				=> $hasil->nip_lama,
						'nip' 					=> $hasil->nip_baru,
						'nidn'          		=> $hasil->nidn,
						'jenis_kelamin' 		=> $hasil->jenis_kelamin,
						'tmpt_lahir'    		=> $hasil->tmpt_lahir,
						'tgl_lahir' 			=> $hasil->tgl_lahir,
						'usia'          		=> $hasil->usia,
						'pangkat'       		=> $hasil->pangkat,
						'golongan' 				=> $hasil->golongan,
						'namabank' 				=> $hasil->namabank,
						'norek' 				=> $hasil->norek,
						'namapdrek'     		=> $hasil->namapdrekening,
						'gajisesuaisk'  		=> $hasil->gajisesuaisk,
						'kategorigaji'  		=> $hasil->kategorigaji,
						'npwp' 					=> $hasil->npwp,
						'statusnpwp' 			=> $hasil->statusnpwp,
						'status' 				=> $hasil->status,
						'keterangan' 			=> $hasil->keterangan,
						'tmt_golongan'  		=> $hasil->tmt_golongan,
						'jabatan' 				=> $hasil->jabatan,
						'jabfungsional' 		=> $hasil->jab_fungsional,
						'tmt_fungsional' 		=> $hasil->tmt_fungsional,
						'tmt_pensiun'   		=> $hasil->tmt_pensiun,
						'thn_pensiun'   		=> $hasil->thn_pensiun,
						'cpns'      			=> $hasil->cpns,
						'tmt_cpns'      		=> $hasil->tmt_cpns,
						'pns'       			=> $hasil->pns,
						'tmt_pns'       		=> $hasil->tmt_pns,
						'thn_masuk'     		=> $hasil->thn_masuk,
						'unit_kerja'    		=> $hasil->unit_kerja,
						'bidang_ilmu'   		=> $hasil->bidang_ilmu,
						'bidang_ilmu3'   		=> $hasil->bidang_ilmu3,
						'lab'           		=> $hasil->lab,
						'program_studi' 		=> $hasil->program_studi,
						'sertifikasi'   		=> $hasil->sertifikasi,
						'pend_akhir'    		=> $hasil->pend_akhir,
						'ijasah_diakui' 		=> $hasil->ijasah_diakui,
						'status_pegawai' 		=> $hasil->status_pegawai,
						'status_jabatan' 		=> $hasil->status_jabatan,
						'jenjanghomebase' 		=> $hasil->jenjanghomebase,
						'karpeg'        		=> $hasil->karpeg,					
						'agama'         		=> $hasil->agama,
						'alamat' 				=> $hasil->alamat,
						'no_hp'         		=> $hasil->no_hp, 
						'kode'          		=> $hasil->kode,
						'foto' 					=> $foto,
						'tmtgaji'       		=> $hasil->tmtgaji,
						'tmtpangkat'    		=> $hasil->tmtpangkat,
						'angka_kredit'  		=> $hasil->angka_kredit,
						'email_ub'      		=> $hasil->email_ub,
						'email'      			=> $hasil->email,
						'lama_tubel'    		=> $hasil->lama_tubel,
						'lama_kenaikan_pangkat' => $hasil->lama_kenaikan_pangkat,
						'tmt_tubel'     		=> $hasil->lama_tubel,
						'idregptk'      		=> $hasil->idregptk,
						'tinggibdn'				=> $hasil->tinggibdn,
						'beratbdn'				=> $hasil->beratbdn,
						'rambut'				=> $hasil->rambut,
						'muka'					=> $hasil->muka,
						'warnakulit'			=> $hasil->warnakulit,
						'cirikusus'				=> $hasil->cirikusus,
						'cacattubuh'			=> $hasil->cacattubuh,
						'hobi'					=> $hasil->hobi,
						'ppabp'					=> $hasil->ppabp,
						'idremun'				=> $hasil->idremun,
						'tlsstatus' 			=> $tlsstatus,
					);
				}
			}
		}
		echo json_encode($arraydata);
	}
}
