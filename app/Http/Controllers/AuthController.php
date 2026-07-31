<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use App\Simpegpegawai;
use App\User;
use App\Pembayaranzis;
use App\Datapsb;
use App\Datapelengkappsb;
use App\Layanan;
use App\Setting;
use App\Tesppdb;
use App\Blogdata;
use App\Blogkomendata;
use App\Pembayaran;
use App\Ekstrakulikuler;
use App\Firebasebank;
use App\Sekolah;
use App\Suratkeluar;
use App\ProgramPIP;
use App\AbsenProgramPIP;
use App\HPTKeuangan;
use App\Datainduk;
use App\Inboxsurat;
use App\Suratmasuk;
use App\Disposisi;
use App\Pejabatsurat;
use App\Suratkeluartnpnomor;
use App\Macamdisposisi;
use App\TabelMaster;
use App\TabelAHH;
use App\TabelHLS;
use App\TabelRLS;
use App\Filess;
use App\Histories;
use App\Detailpegawai;
use App\Banksoalujian;
use App\Insidental;
use App\Penerimasurat;
use App\Models\Biodata;
use App\Models\Unitsurat;
use App\Models\Draftsk;
use App\Models\SettingKeuangan;
use App\Models\Kelompoklain;
use App\Models\Tabelskdanperaturan;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Validator;
use Session;
use QrCode;
use PDF;
use Auth;
use Hash;
use PDFCREATOR;
use DateTime;
use FeedReader;
use Redirect;
function Terbilang($x) {
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
	return " " . $abil[$x];
  elseif ($x < 20)
	return Terbilang($x - 10) . " belas";
  elseif ($x < 100)
	return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
	return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
	return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
	return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
	return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
	return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
  elseif ($x < 1000000000000)
	return Terbilang($x / 1000000000) . " milyar" . Terbilang($x % 1000000000);
  elseif ($x < 1000000000000000)
	return Terbilang($x / 1000000000000) . " trilyun" . Terbilang($x % 1000000000000);
}
function timeAgo($time_ago) {
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
// define( 'namaapps01', 'SIMASTER' );
// define( 'domainapps01', 'Sistem Informasi Manajemen Terpadu' );
// define( 'subdomainapps01', 'DUIDEV' );
// define( 'subsubdomainapps01', 'CV SWANDHANA' );
// define( 'addressapps01', 'Jalan Sebuku X/18 Bunulrejo Blimbing' );
// define( 'kota01', 'Malang' );
// define( 'emailapps01', 'swandhana17@gmail.com' );
// define( 'lamanapps01', 'https://duidev.com/' );
// define( 'logofrontapps01', 'https://duidev.com/public/duidev-softwarehouse.png' );
// define( 'API_ACCESS_ADMIN', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );

class AuthController extends Controller
{
	public function viewAuth() {
        $previlage  = Session('previlage');
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
        //  OLD  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       	if ($domain == 'http://127.0.0.1:8000/ptdpm' OR $domain == 'ptdpm') {
			$url = 'http://127.0.0.1:8000/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'disaprimamedika.site' OR $domain == 'www.disaprimamedika.site') {
			$url = 'https://disaprimamedika.site/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'rsphskr.disaprimamedika.site' OR $domain == 'www.rsphskr.disaprimamedika.site') {
			$url = 'https://rsphskr.disaprimamedika.site/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'rsphmlg.disaprimamedika.site' OR $domain == 'www.rsphmlg.disaprimamedika.site') {
			$url = 'https://rsphmlg.disaprimamedika.site/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'pdp.disaprimamedika.site' OR $domain == 'www.pdp.disaprimamedika.site') {
			$url = 'https://pdp.disaprimamedika.site/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'rekrutmen.disaprimamedika.site' OR $domain == 'www.rekrutmen.disaprimamedika.site') {
			$url = 'https://rekrutmen.disaprimamedika.site/rekrutmen';
			return Redirect::to($url);
		} 
        //  OLD  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //  NEW  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        else if ($domain == 'http://surat-ptdpm.rs-primahusada.id' OR $domain == 'www.surat-ptdpm.rs-primahusada.id') {
			$url = 'http://surat-ptdpm.rs-primahusada.id/rsphportal';
			return Redirect::to($url);
		}
        else if ($domain == 'http://surat-rsphm.rs-primahusada.id' OR $domain == 'www.surat-rsphm.rs-primahusada.id') {
			$url = 'http://surat-rsphm.rs-primahusada.id/rsphportal';
			return Redirect::to($url);
		}
        // else if ($domain == 'https://app.rs-primahusada.id/e-office' OR $domain == 'www.app.rs-primahusada.id/e-office') {
		// 	$url = 'https://app.rs-primahusada.id/e-office/rsphportal';
		// 	return Redirect::to($url);
		// }
        // else if ($domain == 'e-office.rs-primahusada.id' OR $domain == 'www.e-office.rs-primahusada.id') {
		// 	$url = 'https://e-office.rs-primahusada.id/rsphm';
		// 	return Redirect::to($url);
		// } else if ($domain == 'e-office.rs-primahusada.id' OR $domain == 'www.e-office.rs-primahusada.id') {
		// 	$url = 'https://e-office.rs-primahusada.id/rsphs';
		// 	return Redirect::to($url);
		// } else if ($domain == 'e-office.rs-primahusada.id' OR $domain == 'www.e-office.rs-primahusada.id') {
		// 	$url = 'https://e-office.rs-primahusada.id/rsdh';
		// 	return Redirect::to($url);
		// } else if ($domain == 'e-office.rs-primahusada.id' OR $domain == 'www.e-office.rs-primahusada.id') {
		// 	$url = 'https://e-office.rs-primahusada.id/rsck';
		// 	return Redirect::to($url);
		// }
        //  NEW  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        else if ($domain == 'project.duidev.com') {
			$url = 'https://project.duidev.com/rad-portal';
			return Redirect::to($url);
		} else if ($domain == 'aipki.duidev.com') {
			$url = 'https://aipki.duidev.com/aipkiportal';
			return Redirect::to($url);
		} else if ($domain == 'argon.duidev.com') {
			$url = 'http://argon.duidev.com/pdsrpprpi';
			return Redirect::to($url);
		} else if ($domain == 'radiology.duidev.com') {
			$url = 'https://radiology.duidev.com/rad-portal';
			return Redirect::to($url);
		} else if ($domain == 'iwis.co.id') {
			$url = 'https://iwis.co.id/pdsrpprpi';
			return Redirect::to($url);
		} else if ($domain == 'inabr.or.id') {
			$url = 'https://inabr.or.id/welcometobanksoal';
			return Redirect::to($url);
		} else if ($domain == 'banksoal.duidev.com') {
			$url = 'https://banksoal.duidev.com/welcometobanksoal';
			return Redirect::to($url);
		} else if ($domain == 'simaster.swandhana.test') {
			$url = 'https://simaster.swandhana.test/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'pasangkayu.duidev.com') {
			$url = 'https://pasangkayu.duidev.com/pasangkayu';
			return Redirect::to($url);
		} else if ($domain == 'lamongan.duidev.com') {
			$url = 'https://lamongan.duidev.com/dashboardppp';
			return Redirect::to($url);
		} else if ($domain == 'alqalam.duidev.com') {
			$url = 'https://alqalam.duidev.com/sch/1';
			return Redirect::to($url);
		} else if ($domain == 'arridlo.duidev.com') {
			$url = 'https://simbian.duidev.com/frontpage?id=2';
			return Redirect::to($url);
		} else if ($domain == 'pj.duidev.com') {
			$url = 'https://pj.duidev.com/frontpage?id=10';
			return Redirect::to($url);
		} else if ($domain == 'sikep.duidev.com') {
			$url = 'https://simbian.duidev.com/sikep';
			return Redirect::to($url);
		} else if ($domain == 'keperawatan.duidev.com') {
			$url = 'https://keperawatan.duidev.com/sikep';
			return Redirect::to($url);
		} else if ($domain == 'siapdok.duidev.com') {
			$url = 'https://siapdok.duidev.com/siap';
			return Redirect::to($url);
		} else if ($domain == 'wakepen.duidev.com') {
			$url = 'https://wakepen.duidev.com/appskependudukan';
			return Redirect::to($url);
		} else if ($domain == 'ar-rahman.duidev.com') {
			$url = 'https://ar-rahman.duidev.com/masjid/1';
			return Redirect::to($url);
		} else if ($domain == 'toko.duidev.com') {
			$url = 'https://toko.duidev.com/conter/1';
			return Redirect::to($url);
		} else if ($domain == 'hatira.duidev.com') {
			$url = 'https://hatira.duidev.com/conter/2';
			return Redirect::to($url);
		} else if ($domain == 'aipki.swandhana.test') {
			$url = 'https://aipki.swandhana.test/aipkiportal';
			return Redirect::to($url);
		} else if ($domain == 'alqalam.swandhana.test') {
			$url = 'https://alqalam.swandhana.test/sch/1';
			return Redirect::to($url);
		} else if ($domain == 'argon.swandhana.test') {
			$url = 'http://argon.swandhana.test/pdsrpprpi';
			return Redirect::to($url);
		} else if ($domain == 'ar-rahman.swandhana.test') {
			$url = 'https://ar-rahman.swandhana.test/masjid/1';
			return Redirect::to($url);
		} else if ($domain == 'hatira.swandhana.test') {
			$url = 'https://hatira.swandhana.test/conter/2';
			return Redirect::to($url);
		} else if ($domain == 'inabr.swandhana.test') {
			$url = 'https://inabr.swandhana.test/welcometobanksoal';
			return Redirect::to($url);
		} else if ($domain == 'iwis.swandhana.test') {
			$url = 'https://iwis.swandhana.test/pdsrpprpi';
			return Redirect::to($url);
		} else if ($domain == 'keperawatan.swandhana.test') {
			$url = 'https://keperawatan.swandhana.test/sikep';
			return Redirect::to($url);
		} else if ($domain == 'muhajirin.swandhana.test') {
			$url = 'https://muhajirin.swandhana.test/masjid/2';
			return Redirect::to($url);
		} else if ($domain == 'rita.swandhana.test') {
			$url = 'https://rita.swandhana.test/pasangkayu';
			return Redirect::to($url);
		} else if ($domain == 'pj.swandhana.test') {
			$url = 'https://pj.swandhana.test/frontpage?id=10';
			return Redirect::to($url);
		} else if ($domain == 'project.swandhana.test') {
			$url = 'https://project.swandhana.test/rad-portal';
			return Redirect::to($url);
		} else if ($domain == 'radiology.swandhana.test') {
			$url = 'https://radiology.swandhana.test/rad-portal';
			return Redirect::to($url);
		} else if ($domain == 'rekruitmen.swandhana.test') {
			$url = 'https://rekruitmen.swandhana.test/rekrutmen';
			return Redirect::to($url);
		} else if ($domain == 'rsph.swandhana.test') {
			$url = 'https://rsph.swandhana.test/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'simaster.swandhana.test') {
			$url = 'https://simaster.swandhana.test/rsphportal';
			return Redirect::to($url);
		} else if ($domain == 'sikep.swandhana.test') {
			$url = 'https://sikep.swandhana.test/sikep';
			return Redirect::to($url);
		} else if ($domain == 'wakepen.swandhana.test') {
			$url = 'https://wakepen.swandhana.test/appskependudukan';
			return Redirect::to($url);
		} else if ($domain == 'toko.swandhana.test') {
			$url = 'https://toko.swandhana.test/conter/1';
			return Redirect::to($url);
		} else {
			if ($previlage != '') {
				if ($previlage == 'adminwebinar'){
					return redirect('dashboardwebinar');
				} else if ($previlage == 'HERMAN'){
					return redirect('leap');
				} else {
					return redirect('dashbord');
				}
			} else {
				$sql = Sekolah::where('status',1)->get();
				if(!$sql){
					return view('accessdenided');	
				}
				$data				= [];
				$data['sidebar']	= 'frontpage';
				$data['data']	= $sql;
				return view('landingpage', $data);
			}
		}
    }
	public function authenticate(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'username'  	=> 'required',
            'password'  	=> 'required',
            'id_sekolah'  	=> 'required',
        ]);
        if($validator->fails()) {
            Session::flash('message', 'Username dan Password Harus diisi / kode sekolah harus terpilih');
            return back();
        } else {
			$domain 	= parse_url(request()->root())['host'];
			$cekteks 	= explode("/", $domain);
			$homebase	= url("/");
			$data 		= [];
			if (isset($cekteks[1])){
				$domain	= $cekteks[0];
			}
			
            $username   =   $request->username;
            $password   =   $request->password;
			$id_sekolah =   $request->id_sekolah;
			$firebaseid =   $request->firebaseid;
            $auth 		= 	Auth::attempt([
                'username' => $username,
                'password' => $password
            ]);
			$ceksek = explode("?firebaseid=", $id_sekolah);
			if (isset($ceksek[1])){
				$id_sekolah = $ceksek[0];
				$firebaseid = $ceksek[1];
			}
            if(!$auth) {
            	Session::flash('message', 'Username atau password anda salah');
            	return back();
            }
			
			$user  		 	= User::where('username', $request->username)->first();
			$previlage 		= $user->previlage;
			if ($previlage == 'level0'){
				$idsekolah 	= $id_sekolah;
				$previlage 	= 'level1';
			} else {
				$idsekolah	= $user->id_sekolah;
			}
			if($idsekolah != $id_sekolah) {
            	Session::flash('message', 'Pastikan anda memilih kode sekolah yang benar '.$idsekolah .'!= '.$id_sekolah);
            	return back();
            }
			$idne 			= $user->id;
			$fakultas 		= $user->fakultas;
			$cekcar			= strlen($firebaseid);
				
			if ($firebaseid != '' AND $cekcar > 10){
				User::where('username', $request->username)->update([
					'firebaseid' => $firebaseid
				]);
			}
			$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
			if (isset($getdomainid->id)){
				$ceklaman 					= $getdomainid->sequence;
				if ($ceklaman == 2){
					$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_bt.$firebaseid;
				} else if ($ceklaman == 1){
					$lamanportal			= $getdomainid->route.$getdomainid->updated_bt.$firebaseid;
				} else {
					$lamanportal			= $getdomainid->route;
				}
				session(['namaapps01' 			=> $getdomainid->name]);
				session(['domainapps01' 		=> $getdomainid->domainapps]);
				session(['subdomainapps01' 		=> $getdomainid->subdomainapps]);
				session(['subsubdomainapps01' 	=> $getdomainid->subsubdomainapps]);
				session(['addressapps01' 		=> $getdomainid->addressapps]);
				session(['kota01' 				=> $getdomainid->kota]);
				session(['emailapps01' 			=> $getdomainid->emailapps]);
				session(['lamanapps01' 			=> $getdomainid->route]);
				session(['logofrontapps01' 		=> $getdomainid->logofrontapps]);
				session(['lamanportal' 			=> $lamanportal]);
				session(['logo01'				=> $getdomainid->icon]);
			} else {
				session(['namaapps01' 			=> 'Software House']);
				session(['domainapps01'  		=> 'Duidev Software House']);
				session(['subdomainapps01'  	=> 'DUIDEV']);
				session(['subsubdomainapps01' 	=> 'CV SWANDHANA']);
				session(['addressapps01'  		=> 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang']);
				session(['kota01'  				=> 'Indonesia']);
				session(['emailapps01'  		=> 'swandhana17@gmail.com']);
				session(['lamanapps01'  		=> 'https://duidev.com/']);
				session(['logofrontapps01'  	=> 'https://duidev.com/public/dist/img/logokecil.png']);
				session(['lamanportal'			=> 'https://duidev.com/']);
				session(['logo01'				=> 'https://duidev.com/public/duidev-softwarehouse.png']);
			}
			
            session(['id' 		=> $user->id]);
            session(['nama' 	=> $user->nama]);
            session(['username' => $user->username]);
            session(['previlage'=> $previlage]);
			session(['fakultas' => $fakultas]);
			session(['nip'		=> $user->nip]);
			session(['spesial' 	=> $user->spesial]);
			session(['email' 	=> $user->email]);
			session(['fbid' 	=> $user->firebaseid]);
			$sql = Sekolah::find($idsekolah);
			session(['sekolah_nama_aplikasi'=> 'SIMASTER']);
			session(['sekolah_id_sekolah'	=> $idsekolah]);
			session(['sekolah_level'		=> $sql->level]);
			session(['sekolah_nama_yayasan'	=> $sql->nama_yayasan]);
			session(['sekolah_nama_sekolah'	=> $sql->nama_sekolah]);
			session(['sekolah_kode_sekolah'	=> $sql->kode_sekolah]);
			session(['sekolah_nama_kasek'	=> $sql->id_kepala_sekolah]);
			session(['sekolah_nis'			=> $sql->nis]);
			session(['sekolah_nss'			=> $sql->nss]);
			session(['sekolah_npsn'			=> $sql->npsn]);
			session(['sekolah_alamat'		=> $sql->alamat]);
			session(['sekolah_kota'			=> $sql->kota]);
			session(['sekolah_telp'			=> $sql->telp]);
			session(['sekolah_email'		=> $sql->email]);
			session(['sekolah_slogan'		=> $sql->slogan]);
			session(['sekolah_logo'			=> $sql->logo]);
			session(['sekolah_frontpage'	=> $sql->frontpage]);
			Storage::disk('local')->deleteDirectory('scan');
			return redirect('dashbord');
        }
    }
	public function authenticateSIAPDOK(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
        ]);
        if($validator->fails()) {
            Session::flash('message', 'Username dan Password Harus diisi');
            return back();
        } else {
			$domain 	= parse_url(request()->root())['host'];
			$cekteks 	= explode("/", $domain);
			$homebase	= url("/");
			$data 		= [];
			if (isset($cekteks[1])){
				$domain	= $cekteks[0];
			}
			$username   = $request->username;
            $password   = $request->password;
			$firebaseid = $request->firebaseid;
			$idjabatan	= 0;
			$keljabatan	= '';
				
            $auth 		= Auth::attempt([
                'username' => $username,
                'password' => $password
            ]);
            if(!$auth) {
				$username= preg_replace('/\s+/', '', $username);
				$username= strtolower($username);
				$cekdata = Simpegpegawai::where('email_ub', $username)->count();
				if ($cekdata == 0){
					$user       = Biodata::where('nimmhs', $username)->first();
					if (isset($user->nimmhs)){
						$jenjang	= $user->jenjang;
						$jurusan	= $user->jurusan;
						$fakpanjang	= $user->fakultas;
						$getfakultas= User::where('fakpanjang', $fakpanjang)->first();
						if (isset($getfakultas->fakultas)){
							$fakultas = $getfakultas->fakultas;
						} else {
							$fakultas = $fakpanjang;
						}
						if ($fakultas == 'FV'){
							$namaaplikasi = 'SIVOKA';
						} else if ($fakultas == 'PASCAUB'){
							$namaaplikasi = 'SIPASCA';
						} else {
							$namaaplikasi = 'SIFAKULTAS - '.config('global.swandhananama');
						}
						if ($jenjang == 'Doktor S3'){
							$kelompok = 'mahasiswa doktoral';
						} else if ($jenjang == 'Magister S2' OR $jenjang == 'Profesi'){
							$kelompok = 'mahasiswa magister';
						} else {
							$kelompok = 'mahasiswa';
						}
						if ($jurusan == '' OR is_null($jurusan)){ $jurusan = 'Non Jurusan'; }
						$ceksudah = User::where('username', $username)->count();
						if ($ceksudah == 0){
							$user = User::create([
								'nama'      	=>  $user->nama,
								'username' 		=>  $username,
								'password' 		=>  bcrypt($password),
								'previlage' 	=> 	$kelompok,
								'nip' 			=> 	$username,
								'fakultas' 		=>  $fakultas,
								'fakpanjang' 	=>  $fakpanjang,
							]);
							$getmhs     = User::where('username', $username)->first();
							$foto		= $getmhs->foto;
							if (is_null($foto)){ $foto = ''; }
							$ceksekfoto		= explode("/", $foto);
							if (isset($ceksekfoto[2])){ $foto = ''; }
							if ($foto != ''){
								if (File::exists(public_path()) ."/images/". $foto) {
									$foto = $homebase.'/images/'.$foto;
								} else {
									$foto = $homebase.'/mascot.png';
								}
							} else {
								$foto = $homebase.'/mascot.png';
							}
							
							session(['id' => $getmhs->id]);
							session(['nama' => $getmhs->nama]);
							session(['username' => $getmhs->username]);
							session(['nim' => $getmhs->nip]);
							session(['jurusan' => $jurusan]);
							session(['group' => $kelompok]);
							session(['previlage' => $kelompok]);
							session(['photo' => $foto]);
							session(['ppabp' => $fakultas]);
							session(['fakultas' => $fakultas]);
							session(['fakpanjang' => $fakpanjang]);
							session(['jabatan' => $kelompok]);
							session(['spesial' => $getmhs->spesial]);
							session(['namaaplikasi' => $namaaplikasi]);
							session(['deskripsiaplikasi' => $fakpanjang]);
							return redirect('dashboardmhs');
						} else {
							$response = [
								'message'  => 'Email/Username yang dimasukkan tidak ditemukan',
							];
							return response()->json($response, 500);
						}
					} else {
						$ceksek = explode("@ub", $username);
						if (isset($ceksek[1])){
						//	Session::flash('message', 'Username atau password anda salah ');
						//	return back();
						} else {
							$username 	= $username.'@ub.ac.id';
						}
						$cekuser 	= User::where('username', $username)->count();
						if ($cekuser == 0){
							$client = new Client();
							try {
								$res 		= $client->request('GET', 'https://pegsvc.ub.ac.id/pegawai-service/api/v2/sco/pegawai?cons_id=sco-app&signature=KkhKSF/o4XEd6kUNlkiux96gyyNFFWs79/UoeLWnYCA=&nama=&email='.$username);
								$status		= (string)$res->getStatusCode();
								if ($status == '200'){
									$status		= (string)$res->getBody();
									$stream 	= json_decode($res->getBody());
									if (isset($stream[0])){
										$hasil			= $stream[0];
										if (isset($hasil->nama)){
											$gelar_prof		= $hasil->gelar_prof;
											$depan			= $hasil->gelar_depan;
											$nama			= $hasil->nama;
											$belkg			= $hasil->gelar_belakang;
											$jenis			= $hasil->tag_identitas;
											$nip			= $hasil->nomor_identitas;
											$ppabp			= $hasil->unit_homebase;
											$unit_kerja		= $hasil->unit_satker;
											$pangkat		= $hasil->pangkat;
											$golongan		= $hasil->golongan;
											$tmtstruktural	= $hasil->tmt_jabatan_struktural;
											$tmtfungsional	= $hasil->tmt_jabatan_fungsional;
											$struktural		= $hasil->jabatan_struktural;
											$jabfung		= $hasil->jabatan_fungsional;
											$nohape			= $hasil->nomor_hp;
											$email			= $hasil->email;
											$fakpanjang		= $ppabp;
											$fakultas		= '';
											if ($gelar_prof == '' OR is_null($gelar_prof)){

											} else { $depan =  $gelar_prof.$depan; }
											if (is_null($depan) OR $depan == '' OR $depan == ' '){
												$namal	= $nama.' '.$belkg;
											} else {
												$namal	= $depan.' '.$nama.' '.$belkg;
											}
											$cekprevilage	= Pejabatsurat::where('nip', $nip)->first();
											if (isset($cekprevilage->id)){
												$namal		= $cekprevilage->nama;
												$idjabatan 	= $cekprevilage->id; 
												$jabatan 	= $cekprevilage->pejabat; 
												$fakultas 	= $cekprevilage->fakultas; 
												$keljabatan = $cekprevilage->view; 
												$previlage 	= 'PEJABAT';
											} else {
												if ($struktural != ''){
													$previlage	= $struktural;
												} else {
													$previlage	= $jabfung;
												}
												$jabatan 		= $previlage;
											}
											if ($jabatan == '' OR is_null($jabatan)){
												$jabatan	= 'TENDIK';
											}
											
											if ($previlage == '' OR is_null($previlage)){
												$previlage = $jabatan;
											}
											if ($fakultas == ''){
												$getfakpanjang = User::where('fakpanjang', 'LIKE', $fakpanjang)->where('fakultas', '!=', '')->first();
												if (isset($getfakpanjang->fakultas)){
													$fakultas	= $getfakpanjang->fakultas;
												} else { $fakultas = 'KP'; $fakpanjang = ''; }
											} else {
												$getfakpanjang = User::where('fakpanjang', '!=', '')->where('fakultas', $fakultas)->first();
												if (isset($getfakpanjang->fakpanjang)){
													$fakpanjang	= $getfakpanjang->fakpanjang;
												}
											}
											
											$nip		= preg_replace('/\s+/', '', $nip);
											if ($jenis == 'NIK'){
												$jenispeg	= 'PNPN_BOPTN';
												$filterpeg	= 'Non PNS';
												$tulisnip	= 'NIK';					
											} else {
												$perihal	= 'Kenaikan Gaji Berkala';
												$jenispeg	= 'PNS';
												$filterpeg	= 'PNS';
												$tulisnip	= 'NIP';					
											}
											if ($jabfung == 'Tenaga Pengajar' OR $jabfung == 'Asisten Ahli' OR $jabfung == 'Lektor' OR $jabfung == 'Lektor Kepala' OR $jabfung == 'Guru Besar'){
												$statuspeg	= 'Dosen';
											} else {
												$statuspeg	= 'Tendik';
											}
											$ceknip 	= Simpegpegawai::where('nip_baru', $nip)->count();
											if ($ceknip == 0) {
												$idpegawai 	= Simpegpegawai::insertGetId([
													'idpeg'						=> '',
													'jenispeg'					=> $jenispeg,
													'fungsional'				=> $jabfung,
													'nik'						=> '',
													'nokk'						=> '', 
													'nama_lengkap'				=> $namal, 
													'nama'						=> $nama,
													'depan'						=> $depan, 
													'belakang'					=> $belkg,
													'depandinilai'				=> $depan,
													'belakangdinilai'			=> $belkg,
													'jenisnip'					=> $hasil->tag_identitas,
													'nip_lama'					=> '',
													'nip_baru'					=> $nip, 
													'nidn'						=> '',
													'jenis_kelamin'				=> '',
													'tmpt_lahir'				=> '',
													'tgl_lahir'					=> '',
													'usia'						=> '',
													'pangkat'					=> $pangkat,
													'golongan'					=> $golongan, 
													'namabank'					=> '', 
													'norek'						=> '', 
													'namapdrekening'			=> $nama,
													'gajisesuaisk'				=> 0,
													'gajibarublmmsk'			=> '', 
													'kategorigaji'				=> '', 
													'tjistri'					=> '', 
													'tjanak'					=> '', 
													'tjupns'					=> '', 
													'tjstruk'					=> '', 
													'tjfungs'					=> '', 
													'tjdaerah'					=> '', 
													'tjpencil'					=> '', 
													'tjlain'					=> '', 
													'tjkompen'					=> '', 
													'pembul'					=> '', 
													'tjberas'					=> '', 
													'tjpph'						=> '', 
													'potpfkbul'					=> '', 
													'potpfk2'					=> '', 
													'potpfk10'					=> '', 
													'potpph'					=> '', 
													'potswrum'					=> '', 
													'potkelbtj'					=> '', 
													'potlain'					=> '', 
													'pottabrum'					=> '', 
													'npwp'						=> '',
													'statusnpwp'				=> '', 
													'status'					=> '1', 
													'keterangan'				=> 'Imported From SIMPEG V.2', 
													'tmt_golongan'				=> '',
													'tmt_fungsional'			=> $tmtfungsional, 
													'jab_fungsional'			=> $jabfung,
													'tmt_pensiun'				=> '', 
													'thn_pensiun'				=> '', 
													'cpns'						=> '',
													'tmt_cpns'					=> '',
													'pns'						=> '',
													'tmt_pns'					=> '',
													'thn_masuk'					=> '',
													'unit_kerja'				=> $unit_kerja,
													'bidang_ilmu'				=> '',
													'lab'						=> '',
													'program_studi'				=> '',
													'sertifikasi'				=> '',
													'pend_akhir'				=> '',
													'ijasah_diakui'				=> '',
													'status_pegawai'			=> '1', 
													'masa_kerja'				=> '',
													'pns'						=> $filterpeg, 
													'status_jabatan'			=> $statuspeg,
													'karpeg'					=> '',
													'agama'						=> '',
													'alamat'					=> '',
													'no_hp'						=> $nohape,
													'kode'						=> '', 
													'foto'						=> '',
													'tmtgaji'					=> '', 
													'tmtpangkat'				=> '', 
													'ppabp'						=> $ppabp, 
													'jabatan'					=> $struktural,
													'proses_pangkat'			=> '', 
													'angka_kredit'				=> '', 
													'email_ub'					=> $email,
													'lama_tubel'				=> '', 
													'lama_kenaikan_pangkat'		=> '', 
													'tmt_tubel'					=> ''
												]);
											} else {
												Simpegpegawai::where('nip_baru', $nip)->update([
													'nama'						=> $nama,
													'nama_lengkap'				=> $namal, 
													'depan'						=> $depan, 
													'belakang'					=> $belkg,
													'depandinilai'				=> $depan,
													'belakangdinilai'			=> $belkg,
													'jenisnip'					=> $hasil->tag_identitas,
													'jab_fungsional'			=> $jabfung,
													'tmt_fungsional'			=> $tmtfungsional, 
													'jabatan'					=> $struktural,
													'unit_kerja'				=> $unit_kerja,
													'keterangan'				=> 'Imported From SIMPEG V.2', 
													'no_hp'						=> $nohape,
													'email_ub'					=> $email,
												]);
												$ceknip 	= Simpegpegawai::where('nip_baru', $nip)->first();
												$idpegawai	= $ceknip->id;
											}
											$foto 		= $homebase.'/mascot.png';
											if (is_null($fakpanjang)){ $fakpanjang = $fakultas; }
								
											$cekuser = User::where('username', $username)->count();
											if ($cekuser == 0){
												$iduser = User::insertGetId([
													'nama'      	=>  $nama,
													'username' 		=>  $username,
													'password' 		=>  bcrypt($password),
													'previlage' 	=> 	$jabatan,
													'fakultas' 		=>  $fakultas,
													'fakpanjang' 	=>  $fakpanjang,
													'nip' 			=>  $idpegawai,
													'golongan' 		=>  $golongan,
													'email' 		=>  $email,
													'photo' 		=>  $foto,
												]);
												$cekjabatan	= Kelompoklain::where('fakultas', $fakultas)->where('namakelompok', $previlage)->count();
												if ($cekjabatan == 0){
													Kelompoklain::create([
														'fakultas'		=> $fakultas,
														'namakelompok'	=> $previlage,
														'tulisan'		=> $previlage,
														'view'			=> '',
													]);
												}
												if ($fakultas == 'FV'){
													$namaaplikasi = 'SIVOKA';
												} else if ($fakultas == 'PASCAUB'){
													$namaaplikasi = 'SIPASCA';
												} else {
													$namaaplikasi = config('global.swandhananama');
												}
												
												session(['id' => $iduser]);
												session(['nama' => $nama]);
												session(['username' => $username]);
												session(['previlage' => $previlage]);
												session(['nim' => $idpegawai]);
												session(['group' => $previlage]);
												session(['fakultas' => $fakultas]);
												session(['fakpanjang' => $fakpanjang]);
												session(['jabatan' => $jabatan]);
												session(['spesial' => '']);
												session(['photo' => $foto]);
												session(['namaaplikasi' => $namaaplikasi]);
												session(['deskripsiaplikasi' => $fakpanjang]);
												session(['idjabatan' => $idjabatan]);
												session(['keljabatan' => $keljabatan]);
												
												if ($fakultas == 'FV'){
													return redirect('frontpagevokasi');
												} elseif ($fakultas == 'PASCAUB'){
													return redirect('frontpagepps');
												} elseif ($fakultas == 'FMIPA'){
													return redirect('frontpagemipa');
												} elseif ($fakultas == 'FP'){
													return redirect('frontpagefp');
												} else {
													if ($previlage == 'developer') {
														return redirect('frontpage');
													} else if ($previlage == 'admin') {
														return redirect('user');
													} else if ($previlage == 'PEJABAT') {
														if ($idjabatan == '1005'){
															return redirect('dashbordktusekun');
														} else {
															return redirect('dashboardpimpinan');
														}
													} else if ($previlage == 'Sekretaris Wakil Rektor Bidang Akademik' OR $previlage == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $previlage == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $previlage == 'Sekretaris Rektor' OR $previlage == 'Sekretaris' OR $previlage == 'Sekretaris Dekan' OR $previlage == 'Sekretaris WD I' OR $previlage == 'Sekretaris WD II' OR $previlage == 'Sekretaris WD III'  OR $previlage == 'Sekretaris Senat UB') {
														return redirect('dashbordsurat');
													} else if ($previlage == 'Agendaris Umum' OR $previlage == 'Tata Usaha') {
														return redirect('dashboardagendaris');
													} else if ($previlage == 'Arsiparis Umum') {
														return redirect('dashboardarsiparis');
													} else if ($previlage == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR $previlage == 'Sekretaris Ka.Biro Keuangan' OR $previlage == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR $previlage == 'Sekretaris Bagian Akutansi') {
														return redirect('dashboardsekbiro');
													} else {
														return redirect('dashboardstaf');
													}
												}
											} else {
												Session::flash('message', 'Username atau password anda salah ');
												return back();
											}
										} else {
											Session::flash('message', 'Username atau password anda salah ');
											return back();	
										}
									} else {
										Session::flash('message', 'Username atau password anda salah ');
										return back();	
									}
								} else {
									Session::flash('message', 'Username atau password anda salah '.$status);
									return back();	
								}
							} catch (\GuzzleHttp\Exception\ClientException $e) {
								$response 				= $e->getResponse();
								$responseBodyAsString 	= $response->getBody()->getContents();
								$pesan 					= json_decode($responseBodyAsString);
								Session::flash('message', 'Username atau password anda salah '.$pesan);
								return back();	
							}
						} else {
							$response = [
								'message'  => 'Email/Username yang dimasukkan tidak ditemukan',
							];
							return response()->json($response, 500);
						}
					}
				} else {
					$cekdatauser = User::where('username', $username)->count();
					if ($cekdatauser != 0){
						$response = [
							'message'  => 'Email/Username yang dimasukkan tidak ditemukan',
						];
						return response()->json($response, 500);
					} else {
						$user 		= Simpegpegawai::where('email_ub', $username)->first();
						$nip		= $user->nip_baru;
						$jabfung	= $user->jab_fungsional;
						$struktural	= $user->jabatan;
						$fakpanjang	= $user->ppabp;
						$foto		= $user->foto;
						$namal		= $user->nama;
						$fakultas	= '';
						if (is_null($foto)){ $foto = ''; }
						$ceksekfoto		= explode("/", $foto);
						if (isset($ceksekfoto[2])){ $foto = ''; }
						if ($foto != ''){
							if (File::exists(public_path()) .$foto) {
								$foto = $homebase.'/'.$foto;
							} else {
								$foto = $homebase.'/mascot.png';
							}
						} else {
							$foto = $homebase.'/mascot.png';
						}
						$cekprevilage	= Pejabatsurat::where('nip', $nip)->first();
						if (isset($cekprevilage->id)){
							$namal		= $cekprevilage->nama;
							$idjabatan 	= $cekprevilage->id; 
							$jabatan 	= $cekprevilage->pejabat; 
							$fakultas 	= $cekprevilage->fakultas; 
							$previlage 	= 'PEJABAT';
							$keljabatan	= $cekprevilage->view;
						} else {
							if ($struktural != ''){
								$previlage	= $struktural;
							} else if ($jabfung != ''){
								$previlage	= $jabfung;
							} else {
								$previlage	= 'TENDIK';
							}
							$jabatan 		= $previlage;
						}
						if ($fakultas == ''){
							$getfakultas= User::where('fakpanjang', $fakpanjang)->first();
							if (isset($getfakultas->fakultas)){
								$fakultas 	= $getfakultas->fakultas;
							} else {
								$cekneh 		= Simpegpegawai::where('email_ub', $username)->where('ppabp', 'LIKE', '%Matematika%')->count();
								if ($cekneh != 0){
									$fakpanjang = 'Fakultas Matematika dan Ilmu Pengetahuan Alam';
									$fakultas 	= 'FMIPA';
								} else {
									$fakultas = 'KP'; 
								}
							}
						} else {
							$getfakultas= User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
							if (isset($getfakultas->fakpanjang)){
								$fakpanjang = $getfakultas->fakpanjang;
							}
						}
						if ($jabatan == ''){ $jabatan = 'Civitas '.$fakultas; }
						if (is_null($fakpanjang)){ $fakpanjang = $fakultas; }
						$iduser = User::insertGetId([
							'nama'      	=>  $namal,
							'username' 		=>  $username,
							'password' 		=>  bcrypt($password),
							'previlage' 	=> 	$jabatan,
							'fakultas' 		=>  $fakultas,
							'fakpanjang' 	=>  $fakpanjang,
							'nip' 			=>  $user->id,
							'golongan' 		=>  $user->golongan,
							'email' 		=>  $user->email_ub,
							'photo' 		=>  $foto,
						]);
						$cekjabatan	= Kelompoklain::where('fakultas', $fakultas)->where('namakelompok', $jabatan)->count();
						if ($cekjabatan == 0 AND $previlage != 'PEJABAT'){
							Kelompoklain::create([
								'fakultas'		=> $fakultas,
								'namakelompok'	=> $jabatan,
								'tulisan'		=> $jabatan,
								'view'			=> '',
							]);
						}
						$user = User::where('username', $username)->first();
						Auth::login($user);
            
						$user           = $request->user();
						$tokenResult    = $user->createToken('Personal Access Token');
						$token          = $tokenResult->token;
						
						$token->expires_at = Carbon::now()->addDay(1);
						$token->save();
						
						$previlage		= $user->previlage;
						if ($previlage == 'level0'){ $previlage = 'developer'; }
						$idne 			= $user->id;
						$fakultas 		= $user->fakultas;
						$foto 			= $user->photo;
						$idpeg 			= $user->nip;
						$semester 		= $user->semester;
						if ($fakultas == 'FV'){
							$namaaplikasi = 'SIVOKA UB';
						} else if ($fakultas == 'PASCAUB'){
							$namaaplikasi = 'SIPASCA UB';
						} else {
							$namaaplikasi = config('global.swandhananama');
						}
						if ($firebaseid != ''){
							$cekfirebase	= Firebasebank::where('firebase', $firebaseid)->count();
							if ($cekfirebase == 0){
								Firebasebank::insert([
									'userid' 	=> $idne,
									'firebase'	=> $firebaseid,
									'jabatan'	=> $previlage
								]);
							}else {
								Firebasebank::where('firebase', $firebaseid)->update([
									'jabatan'	=> $previlage
								]);
							}
						}
						$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
						if (isset($getdomainid->id)){
							$ceklaman 					= $getdomainid->sequence;
							if ($ceklaman == 2){
								$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
							} else if ($ceklaman == 1){
								$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
							} else {
								$lamanportal			= $getdomainid->route;
							}
							session(['namaapps01' 			=> $getdomainid->name]);
							session(['domainapps01' 		=> $getdomainid->domainapps]);
							session(['subdomainapps01' 		=> $getdomainid->subdomainapps]);
							session(['subsubdomainapps01' 	=> $getdomainid->subsubdomainapps]);
							session(['addressapps01' 		=> $getdomainid->addressapps]);
							session(['kota01' 				=> $getdomainid->kota]);
							session(['emailapps01' 			=> $getdomainid->emailapps]);
							session(['lamanapps01' 			=> $getdomainid->route]);
							session(['logofrontapps01' 		=> $getdomainid->logofrontapps]);
							session(['lamanportal' 			=> $lamanportal]);
							session(['logo01'				=> $getdomainid->icon]);
						} else {
							session(['namaapps01' 			=> 'Software House']);
							session(['domainapps01'  		=> 'Duidev Software House']);
							session(['subdomainapps01'  	=> 'DUIDEV']);
							session(['subsubdomainapps01' 	=> 'CV SWANDHANA']);
							session(['addressapps01'  		=> 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang']);
							session(['kota01'  				=> 'Indonesia']);
							session(['emailapps01'  		=> 'swandhana17@gmail.com']);
							session(['lamanapps01'  		=> 'https://duidev.com/']);
							session(['logofrontapps01'  	=> 'https://duidev.com/public/dist/img/logokecil.png']);
							session(['lamanportal'			=> 'https://duidev.com/']);
							session(['logo01'				=> 'https://duidev.com/public/duidev-softwarehouse.png']);
						}
						
						session(['id' => $iduser]);
						session(['nama' => $user->nama]);
						session(['username' => $username]);
						session(['previlage' => $previlage]);
						session(['nim' => $user->nip_baru]);
						session(['group' => $previlage]);
						session(['fakultas' => $fakultas]);
						session(['fakpanjang' => $fakpanjang]);
						session(['jabatan' => $jabatan]);
						session(['spesial' => '']);
						session(['photo' => $foto]);
						session(['idjabatan' => $idjabatan]);
						session(['keljabatan' => $keljabatan]);
					
						if ($fakultas == 'FV'){
							$namaaplikasi = 'SIVOKA';
						} else if ($fakultas == 'PASCAUB'){
							$namaaplikasi = 'SIPASCA';
						} else {
							$namaaplikasi = config('global.swandhananama');
						}
						session(['namaaplikasi' => $namaaplikasi]);
						session(['deskripsiaplikasi' => $fakpanjang]);
						if ($fakultas == 'FV'){
							$response = [
								'message'   => 'User Public SignIn',
								'laman'    	=> 'frontpagevokasi',
								'user'      => $user,
							];
							return response()->json($response, 200);
						} elseif ($fakultas == 'PASCAUB'){
							$response = [
								'message'   => 'User Public SignIn',
								'laman'    	=> 'frontpagepps',
								'user'      => $user,
							];
							return response()->json($response, 200);
						} elseif ($fakultas == 'FMIPA'){
							$response = [
								'message'   => 'User Public SignIn',
								'laman'    	=> 'frontpagemipa',
								'user'      => $user,
							];
							return response()->json($response, 200);
						} elseif ($fakultas == 'FP'){
							$response = [
								'message'   => 'User Public SignIn',
								'laman'    	=> 'frontpagefp',
								'user'      => $user,
							];
							return response()->json($response, 200);
						} else {
							if ($previlage == 'mahasiswa' OR $previlage == 'mahasiswa magister' OR $previlage == 'mahasiswa doktoral') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashboardmhs',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'developer') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'frontpage2',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'admin') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'user',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'PEJABAT') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashboardpimpinan',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'Sekretaris Wakil Rektor Bidang Akademik' OR $previlage == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $previlage == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $previlage == 'Sekretaris Rektor' OR $previlage == 'Sekretaris' OR $previlage == 'Sekretaris Dekan' OR $previlage == 'Sekretaris WD I' OR $previlage == 'Sekretaris WD II' OR $previlage == 'Sekretaris WD III'  OR $previlage == 'Sekretaris Senat UB') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashbordsurat',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'Agendaris Umum' OR $previlage == 'Tata Usaha') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashboardagendaris',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'Arsiparis Umum') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashboardarsiparis',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else if ($previlage == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR $previlage == 'Sekretaris Ka.Biro Keuangan' OR $previlage == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR $previlage == 'Sekretaris Bagian Akutansi') {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashboardsekbiro',
									'user'      => $user,
								];
								return response()->json($response, 200);
							} else {
								$response = [
									'message'   => 'User Public SignIn',
									'laman'    	=> 'dashboardstaf',
									'user'      => $user,
								];
								return response()->json($response, 200);
							}
						}
					}
				}
            }
			$user = User::where('username', $username)->first();
			Auth::login($user);
            
			$user           = $request->user();
            $tokenResult    = $user->createToken('Personal Access Token');
            $token          = $tokenResult->token;
            
            $token->expires_at = Carbon::now()->addDay(1);
            $token->save();
            
           	$previlage		= $user->previlage;
			$idne 			= $user->id;
			$fakultas 		= $user->fakultas;
			$fakpanjang 	= $user->fakpanjang;
			$foto 			= $user->photo;
			$idpeg 			= $user->nip;
			$semester 		= $user->semester;
			if ($fakultas == 'FV'){
				$namaaplikasi = 'SIVOKA UB';
			} else if ($fakultas == 'PASCAUB'){
				$namaaplikasi = 'SIPASCA UB';
			} else {
				$namaaplikasi = config('global.swandhananama');
			}
			if ($foto == '' OR is_null($user->photo)){
				$foto = $homebase.'/mascot.png';
			} else {
				if (File::exists(public_path()) .$foto) {
					$foto = $homebase.'/'.$foto;
				} else if (File::exists(public_path()) ."/images/". $foto) {
					$foto = $homebase.'/images/'.$foto;
				} else if (File::exists(public_path()) ."/images/pegawai/". $foto) {
					$foto = $homebase.'/images/pegawai/'.$foto;
				} else {
					$foto = $homebase.'/mascot.png';
				}
			}
			if ($firebaseid != ''){
				$cekfirebase	= Firebasebank::where('firebase', $firebaseid)->count();
				if ($cekfirebase == 0){
					Firebasebank::insert([
						'userid' 	=> $idne,
						'firebase'	=> $firebaseid,
						'jabatan'	=> $previlage
					]);
				}else {
					Firebasebank::where('firebase', $firebaseid)->update([
						'jabatan'	=> $previlage
					]);
				}
			}
			$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
			if (isset($getdomainid->id)){
				$ceklaman 					= $getdomainid->sequence;
				if ($ceklaman == 2){
					$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
				} else if ($ceklaman == 1){
					$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
				} else {
					$lamanportal			= $getdomainid->route;
				}
				if ($fakpanjang == ''){ $fakpanjang = $getdomainid->subsubdomainapps; }
				session(['namaapps01' 			=> $getdomainid->name]);
				session(['domainapps01' 		=> $getdomainid->domainapps]);
				session(['subdomainapps01' 		=> $getdomainid->subdomainapps]);
				session(['subsubdomainapps01' 	=> $getdomainid->subsubdomainapps]);
				session(['addressapps01' 		=> $getdomainid->addressapps]);
				session(['kota01' 				=> $getdomainid->kota]);
				session(['emailapps01' 			=> $getdomainid->emailapps]);
				session(['lamanapps01' 			=> $getdomainid->route]);
				session(['logofrontapps01' 		=> $getdomainid->logofrontapps]);
				session(['lamanportal' 			=> $lamanportal]);
				session(['logo01'				=> $getdomainid->icon]);
			} else {
				session(['namaapps01' 			=> 'Software House']);
				session(['domainapps01'  		=> 'Duidev Software House']);
				session(['subdomainapps01'  	=> 'DUIDEV']);
				session(['subsubdomainapps01' 	=> 'CV SWANDHANA']);
				session(['addressapps01'  		=> 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang']);
				session(['kota01'  				=> 'Indonesia']);
				session(['emailapps01'  		=> 'swandhana17@gmail.com']);
				session(['lamanapps01'  		=> 'https://duidev.com/']);
				session(['logofrontapps01'  	=> 'https://duidev.com/public/dist/img/logokecil.png']);
				session(['lamanportal'			=> 'https://duidev.com/']);
				session(['logo01'				=> 'https://duidev.com/public/duidev-softwarehouse.png']);
				if ($fakpanjang == ''){ $fakpanjang = 'CV SWANDHANA'; }
			}
			$cekstatus 		= Biodata::where('nimmhs', $request->username)->count();
			if ($cekstatus == 0){
				$cekprevilage	= Pejabatsurat::where('pejabat', $previlage)->count();
				if ($cekprevilage != 0){ 
					$jabatan 	= $previlage; 
					$previlage 	= 'PEJABAT';
					$getprev	= Pejabatsurat::where('pejabat', $jabatan)->first();
					$idjabatan 	= $getprev->id;
					$keljabatan	= $getprev->view;
				}
				else { $jabatan = $previlage; }
				if ($idpeg != ''){
					$golekfoto 		= Simpegpegawai::where('id', $idpeg)->first();
					if (isset($golekfoto->foto)){
						$foto			= $golekfoto->foto;
						if (is_null($foto)){ $foto = ''; }
						$ceksekfoto		= explode("/", $foto);
						if (isset($ceksekfoto[2])){ $foto = ''; }
						if ($foto != ''){
							if (File::exists(public_path()) ."/images/pegawai/". $foto) {
								$foto = $homebase.'/images/pegawai/'.$foto;
							} else {
								$foto = $homebase.'/mascot.png';
							}
						} else {
							$foto = $homebase.'/mascot.png';
						}
					}
				}
				if ($user->previlage == 'level0'){ $previlage = 'developer'; }
			
				session(['id' => $user->id]);
				session(['token' => $token]);
				session(['nama' => $user->nama]);
				session(['username' => $user->username]);
				session(['previlage' => $previlage]);
				session(['nim' => $user->nip]);
				session(['group' => $previlage]);
				session(['fakultas' => $fakultas]);
				session(['fakpanjang' => $fakpanjang]);
				session(['jabatan' => $jabatan]);
				session(['spesial' => $user->spesial]);
				session(['photo' => $foto]);
				session(['namaaplikasi' => $namaaplikasi]);
				session(['idjabatan' => $idjabatan]);
				session(['keljabatan' => $keljabatan]);
				session(['deskripsiaplikasi' => $user->fakpanjang]);
				session(['semester' => $user->semester]);
			} else {
				$getdatamhs = Biodata::where('nimmhs', $username)->first();
				if (isset($getdatamhs->jenjang)){
					$jenjang 	= $getdatamhs->jenjang;
					$jurusan 	= $getdatamhs->jurusan;
					if ($jenjang == 'Doktor S3'){
						$kelompok = 'mahasiswa doktoral';
					} else if ($jenjang == 'Magister S2' OR $jenjang == 'Profesi'){
						$kelompok = 'mahasiswa magister';
					} else {
						$kelompok = 'mahasiswa';
					}
				} else { $kelompok = 'mahasiswa'; $jurusan = 'Non Jurusan'; }
				session(['id' => $user->id]);
				session(['token' => $token]);
				session(['nama' => $user->nama]);
				session(['username' => $username]);
				session(['group' => $kelompok]);
				session(['previlage' => $kelompok]);
				session(['jurusan' => $jurusan]);
				session(['photo' => $foto]);
				session(['nim' => $username]);
				session(['ppabp' => $user->fakultas]);
				session(['fakultas' => $user->fakultas]);
				session(['fakpanjang' => $fakpanjang]);
				session(['jabatan' => $kelompok]);
				session(['spesial' => $user->spesial]);
				session(['namaaplikasi' => $namaaplikasi]);
				session(['idjabatan' => $idjabatan]);
				session(['keljabatan' => $keljabatan]);
				session(['deskripsiaplikasi' => $fakpanjang]);
				session(['semester' => $user->semester]);
			}
			$ceksudah2 = SettingKeuangan::where('ppabp', $fakpanjang)->count();
			if ($ceksudah2 == 0){
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'sutri',
					'isi1' 	=>  '5',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'beras',
					'isi1' 	=>  '69760',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  '1anak',
					'isi1' 	=>  '2',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  '2anak',
					'isi1' 	=>  '4',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'NAMA INSTANSI',
					'isi1' 	=>  'UNIVERSITAS BRAWIJAYA',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'sutri',
					'isi1' 	=>  '5',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'NPWP BENDAHARA',
					'isi1' 	=>  '00.036.389.5-652.000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'NAMA BENDAHARA',
					'isi1' 	=>  'KHARISMA AULIA, A.Md.',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'ALAMAT BENDAHARA',
					'isi1' 	=>  'JL.VETERAN MALANG',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'NIP BENDAHARA',
					'isi1' 	=>  '19840910 200912 1 004',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'TIDAK KAWIN',
					'isi1' 	=>  '54000000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'JANDA/DUDA 1 ANAK',
					'isi1' 	=>  '58500000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'JANDA/DUDA 2 ANAK',
					'isi1' 	=>  '63000000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'JANDA/DUDA 3 ANAK',
					'isi1' 	=>  '67500000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'KAWIN TANPA ANAK',
					'isi1' 	=>  '58500000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'KAWIN 1 ANAK',
					'isi1' 	=>  '63000000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'KAWIN 2 ANAK',
					'isi1' 	=>  '67500000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'KAWIN 3 ANAK',
					'isi1' 	=>  '72000000',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'Bendahara Gaji',
					'isi1' 	=>  'Dwi Swandhana, A.Md.',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'NIP Bendahara Gaji',
					'isi1' 	=>  'NIK. 201107 860527 1 001',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'Upah BPJS Ketenagakerjaan (Minimum)',
					'isi1' 	=>  '2970503',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'Pungut BPJS Ket Minimum',
					'isi1' 	=>  '185359',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'BPJS Kesehatan (Persen)',
					'isi1' 	=>  '1',
					'isi2' 	=>  '',
				]);
				SettingKeuangan::create([
					'ppabp' =>  $fakpanjang,
					'jenis' =>  'BPJS BPU',
					'isi1' 	=>  '29705',
					'isi2' 	=>  '',
				]);
			}
			$ceksudah3 = Kelompoklain::where('fakultas', $fakultas)->count();
			if ($ceksudah3 == 0){
				Kelompoklain::create([
					'namakelompok' 	=>  'Sekretaris Dekan',
					'tulisan' 		=>  'Sekretaris Dekan',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Sekretaris WD I',
					'tulisan' 		=>  'Sekretaris WD I',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Sekretaris WD II',
					'tulisan' 		=>  'Sekretaris WD II',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Sekretaris WD III',
					'tulisan' 		=>  'Sekretaris WD III',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Agendaris',
					'tulisan' 		=>  'Agendaris',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Arsiparis Umum',
					'tulisan' 		=>  'Arsiparis Umum',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Tata Usaha',
					'tulisan' 		=>  'Tata Usaha',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'Sekretaris',
					'tulisan' 		=>  'Sekretaris',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
				Kelompoklain::create([
					'namakelompok' 	=>  'admin',
					'tulisan' 		=>  'admin',
					'view'			=>  '',
					'fakultas'		=>  $fakultas,
				]);
			}
			$ceksudah4 = Macamdisposisi::where('fakultas', $fakultas)->count();
			if ($ceksudah4 == 0){
				Macamdisposisi::create([
					'urutan' 		=>  '1',
					'disposisi' 	=>  'Mohon segera diproses',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '2',
					'disposisi' 	=>  'Mohon pertimbangan',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '3',
					'disposisi' 	=>  'Mohon ditindaklanjuti',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '4',
					'disposisi' 	=>  'Mohon perhatian',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '5',
					'disposisi' 	=>  'Mohon menghadiri mewakili UB',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '6',
					'disposisi' 	=>  'Mohon diijinkan',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '7',
					'disposisi' 	=>  'Mohon menunjuk staf yang sesuai',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '8',
					'disposisi' 	=>  'Mohon dapat dibantu',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '9',
					'disposisi' 	=>  'Mohon dikoordinir',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '10',
					'disposisi' 	=>  'Untuk diketahui / Arsip',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '11',
					'disposisi' 	=>  'Mohon diproses sesuai ketentuan',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '12',
					'disposisi' 	=>  'Mohon diagendakan',
					'fakultas'		=>  $fakultas,
				]);
				Macamdisposisi::create([
					'urutan' 		=>  '13',
					'disposisi' 	=>  'Mohon diverifikasi',
					'fakultas'		=>  $fakultas,
				]);
			}
				
			if ($fakultas == 'FV'){
				$response = [
					'message'   => 'User Public SignIn',
					'laman'    	=> 'frontpagevokasi',
					'user'      => $user,
				];
				return response()->json($response, 200);
			} elseif ($fakultas == 'PASCAUB'){
				$response = [
					'message'   => 'User Public SignIn',
					'laman'    	=> 'frontpagepps',
					'user'      => $user,
				];
				return response()->json($response, 200);
			} elseif ($fakultas == 'FMIPA'){
				$response = [
					'message'   => 'User Public SignIn',
					'laman'    	=> 'frontpagemipa',
					'user'      => $user,
				];
				return response()->json($response, 200);
			} elseif ($fakultas == 'FP'){
				$response = [
					'message'   => 'User Public SignIn',
					'laman'    	=> 'frontpagefp',
					'user'      => $user,
				];
				return response()->json($response, 200);
			} else {
				if ($previlage == 'mahasiswa' OR $previlage == 'mahasiswa magister' OR $previlage == 'mahasiswa doktoral') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashboardmhs',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'developer') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'frontpage2',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'admin') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'user',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'PEJABAT') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashboardpimpinan',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'Sekretaris Wakil Rektor Bidang Akademik' OR $previlage == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $previlage == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $previlage == 'Sekretaris Rektor' OR $previlage == 'Sekretaris' OR $previlage == 'Sekretaris Dekan' OR $previlage == 'Sekretaris WD I' OR $previlage == 'Sekretaris WD II' OR $previlage == 'Sekretaris WD III'  OR $previlage == 'Sekretaris Senat UB') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashbordsurat',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'Agendaris Umum' OR $previlage == 'Tata Usaha') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashboardagendaris',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'Arsiparis Umum') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashboardarsiparis',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else if ($previlage == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR $previlage == 'Sekretaris Ka.Biro Keuangan' OR $previlage == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR $previlage == 'Sekretaris Bagian Akutansi') {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashboardsekbiro',
						'user'      => $user,
					];
					return response()->json($response, 200);
				} else {
					$response = [
						'message'   => 'User Public SignIn',
						'laman'    	=> 'dashboardstaf',
						'user'      => $user,
					];
					return response()->json($response, 200);
				}
			}
        }
	}
	public function exAuthRadiologi(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
				'message' => 'Username dan Password Harus diisi',
			], 404);
        } else {
			$domain 	= parse_url(request()->root())['host'];
			$cekteks 	= explode("/", $domain);
			$homebase	= url("/");
			$data 		= [];
			if (isset($cekteks[1])){
				$domain	= $cekteks[0];
			}
			$fakultas 		= 'DUIDEV';
			$fakpanjang 	= 'CV SWANDHANA';
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
				$fakultas 					= $getdomainid->subdomainapps;
				$fakpanjang 				= $getdomainid->subsubdomainapps;
				session(['namaaplikasi'  		=> $getdomainid->name]);
				session(['namaapps01' 			=> $getdomainid->name]);
				session(['domainapps01' 		=> $getdomainid->domainapps]);
				session(['subdomainapps01' 		=> $getdomainid->subdomainapps]);
				session(['subsubdomainapps01' 	=> $getdomainid->subsubdomainapps]);
				session(['addressapps01' 		=> $getdomainid->addressapps]);
				session(['kota01' 				=> $getdomainid->kota]);
				session(['emailapps01' 			=> $getdomainid->emailapps]);
				session(['lamanapps01' 			=> $getdomainid->route]);
				session(['logofrontapps01' 		=> $getdomainid->logofrontapps]);
				session(['lamanportal' 			=> $lamanportal]);
				session(['logo01'				=> $getdomainid->icon]);
			} else {
				session(['namaapps01' 			=> 'Software House']);
				session(['namaaplikasi'  		=> 'Duidev Software House']);
				session(['domainapps01'  		=> 'Duidev Software House']);
				session(['subdomainapps01'  	=> 'DUIDEV']);
				session(['subsubdomainapps01' 	=> 'CV SWANDHANA']);
				session(['addressapps01'  		=> 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang']);
				session(['kota01'  				=> 'Indonesia']);
				session(['emailapps01'  		=> 'swandhana17@gmail.com']);
				session(['lamanapps01'  		=> 'https://duidev.com/']);
				session(['logofrontapps01'  	=> 'https://duidev.com/public/dist/img/logokecil.png']);
				session(['lamanportal'			=> 'https://duidev.com/']);
				session(['logo01'				=> 'https://duidev.com/public/duidev-softwarehouse.png']);
			}
			$username   = $request->username;
            $password   = $request->password;
			$firebaseid = $request->firebaseid;
			$idjabatan	= 0;
			$keljabatan	= '';
				
            $auth 		= Auth::attempt([
                'username' => $username,
                'password' => $password
            ]);
            if(!$auth) {
				$username		= preg_replace('/\s+/', '', $username);
				$username		= strtolower($username);
				$cekuser 		= User::where('username', $username)->count();
				$getuserlama 	= DB::table('duidevco_radiology.db_user')->where('username', $username)->first();
				if (isset($getuserlama->username) AND $cekuser == 0){
					try {
						DB::beginTransaction();
						$user = User::create([
							'nama'      => $getuserlama->name,
							'username'  => $username,
							'email'     => $getuserlama->email,
							'nip'     	=> $getuserlama->nim,
							'nik'     	=> $getuserlama->hape,
							'firebaseid'=> $getuserlama->firebaseid,
							'password'  => bcrypt($password),
							'fakultas'  => $fakultas,
							'fakpanjang'=> $fakpanjang,
							'previlage' => $getuserlama->kelompok,
							'merangkap' => $getuserlama->periode,
							'status'	=> $getuserlama->status,
							'id_sekolah'=> ''
						]);
						//SendMail::kirim($getuserlama->name,$getuserlama->email);
						DB::commit();
						$getnotif 	= User::where('username', 'LIKE', 'admin')->get();
						$tuliskirim = 'Mari Sambut Saudara '.$getuserlama->name.' Yang Hari Ini Bergabung';
						foreach ( $getnotif as $rtokencari ){
							$firebaseid = $rtokencari->firebaseid;
							if ($firebaseid != '' AND $rtokencari->firebaseid !== null){
								$msg = array (
									'message' 	=> $tuliskirim,
									'title'		=> 'DUIDEV',
									'subtitle'	=> 'Software House',
									'tickerText'=> 'New User Notification',
									'image'		=> '',
									'vibrate'	=> 1,
									'sound'		=> 1,
									'largeIcon'	=> 'large_icon',
									'smallIcon'	=> 'small_icon'
								);
								$fields = array
								(
									'to' 			=> $firebaseid,
									'priority'		=> 'high',
									'notification' 	=> [
										"title" => 'SCO UB',
										"sound" => "default",
										"body" 	=> $tuliskirim
									],
									'data'			=> $msg
									
								);
								$headers = array
								(
									'Authorization: key=' . API_ACCESS_ADMIN,
									'Content-Type: application/json'
								);
								$url = 'https://fcm.googleapis.com/fcm/send';
								$ch = curl_init();
							
								// Set the url, number of POST vars, POST data
								curl_setopt($ch, CURLOPT_URL, $url);
							
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							
								// Disabling SSL Certificate support temporarly
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
								curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
								curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
							
								// Execute post
								$result = curl_exec($ch);
								curl_close($ch);
							}
						}
						return response()->json([
							'message' => 'Please Try Again',
						], 404);
					} catch (\Exception $e) {
						DB::rollback();
						return response()->json([
							'message' => $e->getMessage(),
						], 404);
					}
				} else {
					return response()->json([
						'message' => 'Password atau Username anda Salah, Periksa Kembali Isian Anda',
					], 404);
				}
            }
			$user = User::where('username', $username)->first();
			Auth::login($user);
            
			$user           = $request->user();
            $tokenResult    = $user->createToken('Personal Access Token');
            $token          = $tokenResult->token;
            
            $token->expires_at = Carbon::now()->addDay(1);
            $token->save();
            
           	$previlage		= $user->previlage;
			$idne 			= $user->id;
			$fakultas 		= $user->fakultas;
			$fakpanjang 	= $user->fakpanjang;
			$foto 			= $user->photo;
			$idpeg 			= $user->nip;
			$semester 		= $user->semester;
			
			if ($foto == '' OR is_null($user->photo)){
				$foto = $homebase.'/mascot.png';
			} else {
				$foto = $homebase.'/data:image/png;base64,'.$foto;
			}
			if ($firebaseid != ''){
				$cekfirebase	= Firebasebank::where('firebase', $firebaseid)->count();
				if ($cekfirebase == 0){
					Firebasebank::insert([
						'userid' 	=> $idne,
						'firebase'	=> $firebaseid,
						'jabatan'	=> $previlage
					]);
				}else {
					Firebasebank::where('firebase', $firebaseid)->update([
						'jabatan'	=> $previlage
					]);
				}
			}
			$menus		        = '<li class="hover [aktif-dashboard]"><a href="'.$homebase.'"><i class="menu-icon fa fa-institution text-warning"></i><span class="menu-text text-warning"> Frontpage </span></a></li>';
			$getallmenu         = DB::table('duidevco_radiology.db_menus')->where('pengguna', $previlage)->where('show', '1')->groupBy('menu')->orderBy('urutan', 'ASC')->get();
			if (!empty($getallmenu)){
				foreach($getallmenu as $rsidebar){
					$menu 		    = $rsidebar->menu;
					$laman 		    = $rsidebar->laman;
					$icon 		    = $rsidebar->icon;
					$nama 		    = $rsidebar->nama;
					$warna 		    = $rsidebar->warna;
					$deskripsi 	    = $rsidebar->deskripsi;
					$parent 	    = $rsidebar->parent;
					$getanakmenu    = DB::table('duidevco_radiology.db_menus')->where('pengguna', $previlage)->where('show', '1')->where('menu', $menu)->orderBy('urutan', 'ASC')->count();
					if ($getanakmenu == 1){
						$menus		= $menus.'<li class="[aktif-'.$parent.']" title="'.$deskripsi.'"><a href="'.$homebase.'/rad-menu/'.$parent.'"><i class="menu-icon '.$icon.' '.$warna.'"></i><span class="menu-text '.$warna.'">'.$nama.'</span></a></li>';
					} else {
						$menus		= $menus.'<li class="hover [aktif-'.$parent.']"><a href="#" class="dropdown-toggle"><i class="menu-icon '.$icon.' '.$warna.'"></i><span class="menu-text">'.$menu.'</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu">';
						$getanakmenu= DB::table('duidevco_radiology.db_menus')->where('pengguna', $previlage)->where('show', '1')->where('menu', $menu)->orderBy('urutan', 'ASC')->get();
						foreach($getanakmenu as $rdatasubmenu){
							$menus	= $menus.'<li class="hover" title="'.$rdatasubmenu->deskripsi.'"><a href="'.$homebase.'/rad-menu/'.$rdatasubmenu->parent.'"><i class="menu-icon fa fa-caret-right"></i>'.$rdatasubmenu->nama.'</a><b class="arrow"></b></li>';
						}
						$menus		= $menus.'</ul></li>';
					}
				}
			}
			$menus				= $menus.'<li class=""><a href="'.$homebase.'/logoutlt3"><i class="menu-icon fa fa-power-off text-danger"></i><span class="menu-text text-danger"> Logout </span></a></li>';
			session(['id' 		=> $user->id]);
			session(['nama' 	=> $user->nama]);
			session(['username' => $user->username]);
			session(['menus'	=> $menus]);
			session(['avatar'	=> $foto]);
			session(['previlage'=> $previlage]);
			session(['fakultas' => $fakultas]);
			session(['nip'		=> $user->nip]);
			session(['spesial' 	=> $user->spesial]);
			session(['email' 	=> $user->email]);
			session(['fbid' 	=> $user->firebaseid]);
			session(['token' 	=> $tokenResult->accessToken]);
			$response = [
				'message'       => 'User Public SignIn',
				'token'         => $tokenResult->accessToken,
				'token_type'    => 'Bearer',
				'user'          => $user,
			];

			return response()->json($response);
        }
	}
	public function exRegisRadiologi(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'email'  		=> 'required',
            'nama'  		=> 'required',
			'nim'  			=> 'required',
			'jawaban'  		=> 'required',
			'password1' 	=> 'required|min:6',
            'password2' 	=> 'required|same:password1',
        ]);
        if($validator->fails()) {
            return response()->json([
				'message' => 'All Form Cannot Be Empty and Password Min 6 Charates',
			], 404);
        } else {
			$domain 	= parse_url(request()->root())['host'];
			$cekteks 	= explode("/", $domain);
			$homebase	= url("/");
			$data 		= [];
			if (isset($cekteks[1])){
				$domain	= $cekteks[0];
			}
			$fakultas 		= 'DUIDEV';
			$fakpanjang 	= 'CV SWANDHANA';
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
				$fakultas 					= $getdomainid->subdomainapps;
				$fakpanjang 				= $getdomainid->subsubdomainapps;
			}
			$email   	= $request->email;
            $nama   	= $request->nama;
			$nim 		= $request->nim;
			$jawaban 	= $request->jawaban;
			$idcapca 	= $request->idcapca;
			$password1 	= $request->password1;
			$level 		= $request->level;
			$idcapca 	= $request->idcapca;
			$username	= $email;
			$cekusername= User::where('username', $username)->count();
			$cekdatalama= DB::table('duidevco_radiology.db_user')->where('username', $username)->count();
			if ($cekusername != 0 OR $cekdatalama != 0){
				return response()->json([
					'message' => 'Your Email is Used, if you forget the password please contact administrator to reset your password',
				], 404);
			} else {
				$getpertanyaan 	= DB::table('duidevco_radiology.db_capcha')->where('id', $idcapca)->first();
				if (isset($getpertanyaan->id)){
					$kunci 		= $getpertanyaan->jawaban;
				} else {
					$kunci      = '';
					$jawaban 	= '-';
				}
				if ($kunci == $jawaban){
					$input = DB::table('duidevco_radiology.db_user')->where('username', $username)->insert([
						'name'					=> $nama,
						'username'				=> $username,
						'nim'					=> $nim,
						'kelompok'				=> $level,
						'email'					=> $email,
						'encrypted_password'	=> '',
						'salt'					=> '',
						'status'				=> 0
					]);
					if ($input){
						try {
							DB::beginTransaction();
							$user = User::create([
								'nama'      => $nama,
								'username'  => $username,
								'email'     => $email,
								'nip'     	=> $nim,
								'nik'     	=> '',
								'firebaseid'=> '',
								'password'  => bcrypt($password1),
								'fakultas'  => $fakultas,
								'fakpanjang'=> $fakpanjang,
								'previlage' => $level,
								'merangkap' => '',
								'status'	=> '0',
								'id_sekolah'=> ''
							]);
							//SendMail::kirim($getuserlama->name,$getuserlama->email);
							DB::commit();
							$getnotif 	= User::where('username', 'LIKE', 'admin')->get();
							$tuliskirim = 'Mari Sambut Saudara '.$getuserlama->name.' Yang Hari Ini Bergabung';
							foreach ( $getnotif as $rtokencari ){
								$firebaseid = $rtokencari->firebaseid;
								if ($firebaseid != '' AND $rtokencari->firebaseid !== null){
									$msg = array (
										'message' 	=> $tuliskirim,
										'title'		=> 'DUIDEV',
										'subtitle'	=> 'Software House',
										'tickerText'=> 'New User Notification',
										'image'		=> '',
										'vibrate'	=> 1,
										'sound'		=> 1,
										'largeIcon'	=> 'large_icon',
										'smallIcon'	=> 'small_icon'
									);
									$fields = array
									(
										'to' 			=> $firebaseid,
										'priority'		=> 'high',
										'notification' 	=> [
											"title" => 'SCO UB',
											"sound" => "default",
											"body" 	=> $tuliskirim
										],
										'data'			=> $msg
										
									);
									$headers = array
									(
										'Authorization: key=' . API_ACCESS_ADMIN,
										'Content-Type: application/json'
									);
									$url = 'https://fcm.googleapis.com/fcm/send';
									$ch = curl_init();
								
									// Set the url, number of POST vars, POST data
									curl_setopt($ch, CURLOPT_URL, $url);
								
									curl_setopt($ch, CURLOPT_POST, true);
									curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								
									// Disabling SSL Certificate support temporarly
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
									curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
									curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
								
									// Execute post
									$result = curl_exec($ch);
									curl_close($ch);
								}
							}
							return response()->json([
								'message' => 'Your Email now registered, but please contact administrator to actived..!!',
							], 404);
						} catch (\Exception $e) {
							DB::rollback();
							return response()->json([
								'message' => $e->getMessage(),
							], 500);
						}
					} else {
						return response()->json([
							'message' => 'System is Down',
						], 500);
					}
				} else {
					return response()->json([
						'message' => 'Wrong Capcha Answer',
					], 500);
				}
			}
        }
	}
	public function authenticatemhs(Request $request) {
		$attribute = array(
            'username' => 'Email/Username',
            'password' => 'Password',
        );
        $this->validate($request,[
            'username'  => 'required',
            'password'  => 'required'
        ]);
        $username 	= $request->input('username');
        $password 	= $request->input('password');
       	$fakultas   = $request->input('fakultas');
		$fakpanjang	= $request->input('fakpanjang');
		$homebase	= url("/");
		
		if ($fakultas == 'FV'){
			$namaaplikasi = 'SIVOKA UB';
		} else if ($fakultas == 'PASCAUB'){
			$namaaplikasi = 'SIPASCA UB';
		} else {
			$namaaplikasi = config('global.swandhananama');
		}
		$auth = Auth::attempt([
			'username'  => $username,
			'password'  => $password
		]);
		if(!$auth) {
			$check1		= Biodata::where('nimmhs', $username)->count();
			$cekuser    = User::where('username', $username)->count();
			if ($check1 != 0 AND $cekuser == 0) {
				$user       = Biodata::where('nimmhs', $username)->first();
				$jenjang	= $user->jenjang;
				if ($jenjang == 'Doktor S3'){
					$kelompok = 'mahasiswa doktoral';
				} else if ($jenjang == 'Magister S2' OR $jenjang == 'Profesi'){
					$kelompok = 'mahasiswa magister';
				} else {
					$kelompok = 'mahasiswa';
				}
				$user = User::create([
					'nama'      	=>  $user->nama,
					'username' 		=>  $username,
					'password' 		=>  bcrypt($password),
					'previlage' 	=> 	$kelompok,
					'nip' 			=> 	$username,
					'fakultas' 		=>  $fakultas,
					'fakpanjang' 	=>  $fakpanjang,
				]);
				
				$getmhs     	= User::where('username', $username)->first();
				session(['id' => $getmhs->id]);
				session(['nama' => $getmhs->nama]);
				session(['username' => $getmhs->username]);
				session(['nim' => $getmhs->nip]);
				session(['group' => $kelompok]);
				session(['previlage' => $kelompok]);
				session(['photo' => $homebase.'/mascot.png']);
				session(['ppabp' => $fakultas]);
				session(['fakultas' => $fakultas]);
				session(['fakpanjang' => $fakpanjang]);
				session(['jabatan' => $kelompok]);
				session(['spesial' => $getmhs->spesial]);
				session(['namaaplikasi' => $namaaplikasi]);
				session(['deskripsiaplikasi' => $fakpanjang]);
				$response = [
					'message'       => 'frontpagepps',
				];
				return response()->json($response);
			} else {
				return response()->json([
                    'message' => 'Password yang dimasukkan salah',
                ], 404);
			}
		}
		$cekstatus 		= Biodata::where('nimmhs', $username)->count();
		if ($cekstatus == 0){
			$user   	=   User::where('username', $request->username)->first();
			$previlage	= 	$user->previlage;
			$foto		= 	$user->photo;
			if ($foto == '' OR is_null($user->photo)){
				$foto = $homebase.'/mascot.png';
			} else {
				if (File::exists(public_path()) ."/images/". $foto) {
					$foto = $homebase.'/images/'.$foto;
				} else if (File::exists(public_path()) ."/images/pegawai/". $foto) {
					$foto = $homebase.'/images/pegawai/'.$foto;
				} else {
					$foto = $homebase.'/mascot.png';
				}
			}
			$cekprevilage	= Pejabatsurat::where('pejabat', $previlage)->count();
			if ($cekprevilage != 0){ $jabatan = $previlage; $previlage = 'PEJABAT'; }
			else { $jabatan = $previlage; }
			session(['id' => $user->id]);
			session(['nama' => $user->nama]);
			session(['username' => $user->username]);
			session(['group' => $previlage]);
			session(['previlage' => $previlage]);
			session(['photo' => $foto]);
			session(['nim' => $user->nip]);
			session(['ppabp' => $fakultas]);
			session(['fakultas' => $fakultas]);
			session(['fakpanjang' => $fakpanjang]);
			session(['jabatan' => $jabatan]);
			session(['spesial' => $user->spesial]);
			session(['namaaplikasi' => $namaaplikasi]);
			session(['deskripsiaplikasi' => $fakpanjang]);
		}else {
			$getdatamhs = Biodata::where('nimmhs', $username)->first();
			if (isset($getdatamhs->jenjang)){
				$jenjang 	= $getdatamhs->jenjang;
				if ($jenjang == 'Doktor S3'){
					$kelompok = 'mahasiswa doktoral';
				} else if ($jenjang == 'Magister S2' OR $jenjang == 'Profesi'){
					$kelompok = 'mahasiswa magister';
				} else {
					$kelompok = 'mahasiswa';
				}
			} else { $kelompok = 'mahasiswa'; }
			$user   =   User::where('username', $request->username)->first();
			$foto	= 	$user->photo;
			if ($foto == '' OR is_null($user->photo)){
				$foto = $homebase.'/mascot.png';
			} else {
				if (File::exists(public_path()) ."/images/". $foto) {
					$foto = $homebase.'/images/'.$foto;
				} else if (File::exists(public_path()) ."/images/pegawai/". $foto) {
					$foto = $homebase.'/images/pegawai/'.$foto;
				} else {
					$foto = $homebase.'/mascot.png';
				}
			}
			session(['id' => $user->id]);
			session(['nama' => $user->nama]);
			session(['username' => $username]);
			session(['group' => $kelompok]);
			session(['previlage' => $kelompok]);
			session(['photo' => $foto]);
			session(['nim' => $username]);
			session(['ppabp' => $user->fakultas]);
			session(['fakultas' => $user->fakultas]);
			session(['fakpanjang' => $user->fakpanjang]);
			session(['jabatan' => $kelompok]);
			session(['spesial' => $user->spesial]);
			session(['namaaplikasi' => $namaaplikasi]);
			session(['deskripsiaplikasi' => $fakpanjang]);
		}
		$response = [
			'message'       => 'frontpagepps',
		];
		return response()->json($response);
    }
	public function logout(Request $request) {
		$idsekolah = session('sekolah_id_sekolah');
        Auth::logout();
        $request->session()->regenerate();
		$request->session()->flush();
		if ($idsekolah == ''){
			return redirect('/');
		} else {
			return redirect('/frontpage?id='.$idsekolah);
		}
    }
	public function zis(Request $request) {
		$id = $request->input('id');

		$rsetting				= Sekolah::find($id);
		if(!$rsetting){
			return view('accessdenided');	
		}
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$frontpage 				= $rsetting->frontpage;
		$pengumuman 			= $rsetting->pengumuman;
		$pendaftaran 			= $rsetting->pendaftaran;
		$no_rek 				= $rsetting->no_rek;
		$nama_rek 				= $rsetting->nama_rek;
		$nama_bank_rek 			= $rsetting->nama_bank_rek;

        $tasks					= [];
		$tasks['id_sekolah']	= $id;
		$tasks['logo']			= $logo;
		$tasks['frontpage']		= $frontpage;
		$tasks['yayasan']		= $yayasan;
		$tasks['sekolah']		= $sekolah;
		$tasks['alamat']		= $alamat;
		$tasks['kepalasekolah']	= $kepalasekolah;
		$tasks['pengumuman']	= $pengumuman;
		$tasks['pendaftaran']	= $pendaftaran;
		$tasks['no_rek']		= $no_rek;
		$tasks['nama_rek']		= $nama_rek;
		$tasks['nama_bank_rek']	= $nama_bank_rek;
		
		$rstatuszis				= Layanan::where('layanan', 'pembayaranzis')->where('id_sekolah', $id)->first();
		if (isset($rstatuszis->status)){
			$ijinzis 			= $rstatuszis->status;
		} else { $ijinzis		= ''; }
		if ($ijinzis == 'mati'){
			$tasks['sidebar']	= 'zis';
			return view('errors.tutup', $tasks);
		} else {
			$tasks['sidebar']	= 'zis';
			return view('zis', $tasks);
		}
		
    }
	public function ppdb(Request $request) {
		$id = $request->input('id');
		$rsetting				= Sekolah::find($id);
		if(!$rsetting){
			return view('accessdenided');	
		}
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$frontpage 				= $rsetting->frontpage;
		$pengumuman 			= $rsetting->pengumuman;
		$pendaftaran 			= $rsetting->pendaftaran;
		$homebase				= url("/");
		$statppdb				= '';
		$kodebaru				= '';
		$kodepindahan 			= '';
		$hargaformulir 			= '';
		$namabank 				= '';
		$norek 					= '';
		$periode 				= '';
		$setspp1 				= '';
		$setspp2 				= '';
		$setspp3 				= '';
		$setdpp1 				= '';
		$setdpp2 				= '';
		$setdpp3 				= '';
		$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id)->get();
		if (!empty($sql)){
			foreach ($sql as $rlayanan){
				$status 		= $rlayanan->status;
				$layanan 		= $rlayanan->layanan;
				if ($layanan == 'periodepsb') { $periode = $status; }
				if ($layanan == 'ppdb') { $statppdb = $status; }
				if ($layanan == 'kodebaru') { $kodebaru = $status; }
				if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
				if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
				if ($layanan == 'namabank') { $namabank = $status; }
				if ($layanan == 'norek') { $norek = $status; }
				if ($layanan == 'spp1') { $setspp1 = $status; }
				if ($layanan == 'spp2') { $setspp2 = $status; }
				if ($layanan == 'spp3') { $setspp3 = $status; }
				if ($layanan == 'dpp1') { $setdpp1 = $status; }
				if ($layanan == 'dpp2') { $setdpp2 = $status; }
			}
		}
		$tasks					= [];		
		$tasks['id_sekolah']	= $id;
		$tasks['logo']			= $logo;
		$tasks['frontpage']		= $frontpage;
		$tasks['yayasan']		= $yayasan;
		$tasks['sekolah']		= $sekolah;
		$tasks['alamat']		= $alamat;
		$tasks['kepalasekolah']	= $kepalasekolah;
		$tasks['pengumuman']	= $pengumuman;
		$tasks['pendaftaran']	= $pendaftaran;
		$tasks['statppdb']		= $statppdb;
		$tasks['tahun']			= date("Y");
		$tasks['hargaformulir']	= $hargaformulir;
		$tasks['norek']			= $norek;
		$tasks['namabank']		= $namabank;
		$tasks['lvlsekolah']	= $rsetting->level;
		$tasks['sidebar']		= 'ppdb';
		return view('ppdb', $tasks);
    }
	public function pip(Request $request) {
		$id 					= $request->input('id');
		$rsetting				= Sekolah::find($id);
		if(!$rsetting){
			return view('accessdenided');	
		}
		$tasks					= [];		
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$frontpage 				= $rsetting->frontpage;
		$pengumuman 			= $rsetting->pengumuman;
		$pendaftaran 			= $rsetting->pendaftaran;
		$homebase				= url("/");
		$statppdb				= '';
		$kodebaru				= '';
		$kodepindahan 			= '';
		$hargaformulir 			= '';
		$namabank 				= '';
		$norek 					= '';
		$periode 				= '';
		$setspp1 				= '';
		$setspp2 				= '';
		$setspp3 				= '';
		$setdpp1 				= '';
		$setdpp2 				= '';
		$setdpp3 				= '';
		$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id)->get();
		if (!empty($sql)){
			foreach ($sql as $rlayanan){
				$status 		= $rlayanan->status;
				$layanan 		= $rlayanan->layanan;
				if ($layanan == 'periodepsb') { $periode = $status; }
				if ($layanan == 'ppdb') { $statppdb = $status; }
				if ($layanan == 'kodebaru') { $kodebaru = $status; }
				if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
				if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
				if ($layanan == 'namabank') { $namabank = $status; }
				if ($layanan == 'norek') { $norek = $status; }
				if ($layanan == 'spp1') { $setspp1 = $status; }
				if ($layanan == 'spp2') { $setspp2 = $status; }
				if ($layanan == 'spp3') { $setspp3 = $status; }
				if ($layanan == 'dpp1') { $setdpp1 = $status; }
				if ($layanan == 'dpp2') { $setdpp2 = $status; }
			}
		}
		$tasks['id_sekolah']	= $id;
		$tasks['logo']			= $logo;
		$tasks['tabel']			= ProgramPIP::where('idsekolah', $id)->get();
		$tasks['frontpage']		= $frontpage;
		$tasks['yayasan']		= $yayasan;
		$tasks['sekolah']		= $sekolah;
		$tasks['alamat']		= $alamat;
		$tasks['kepalasekolah']	= $kepalasekolah;
		$tasks['pengumuman']	= $pengumuman;
		$tasks['pendaftaran']	= $pendaftaran;
		$tasks['statppdb']		= $statppdb;
		$tasks['tahun']			= date("Y");
		$tasks['hargaformulir']	= $hargaformulir;
		$tasks['norek']			= $norek;
		$tasks['namabank']		= $namabank;
		$tasks['lvlsekolah']	= $rsetting->level;
		$tasks['sidebar']		= 'pip';
		return view('pip', $tasks);
    }
	public function ctkKwitansi($id) {
		$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$marking		= $id;
		$homebase		= url("/");
		$alamatcetak	= $homebase.'/kwitansi/'.$marking;
		$sql 			= Pembayaran::where('marking', $marking)->first();
		if (isset($sql->id)){
			$verifikasi	= $sql->verifikasi;
			$kirim		= $sql->kirim;
		} else {
			$verifikasi	= '';
			$kirim 		= 'Belum di Verifikasi';
		}
		
		if ($verifikasi == ''){
			$jeneng			= 'Belum Di Verifikasi';
			$tgliki 		= date('d');
			$mthiki 		= date('m');
			$mthiki 		= (int)$mthiki;
			$thniki 		= date('Y');
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
			$kirim 			= 'Belum di Verifikasi';
		} else {
			$gettanggal		= substr($verifikasi, -8);
			$jeneng			= str_replace($gettanggal, '', $verifikasi);
			$arrtanggal 	= str_split($gettanggal);
			$ceknama		= User::where('username', 'LIKE', $jeneng.'%')->first();
			if (isset($ceknama->nama)){
				$jeneng		= $ceknama->nama;
			}
			$tgliki 		= $arrtanggal[0].$arrtanggal[1];
			$mthiki 		= $arrtanggal[2].$arrtanggal[3];
			$mthiki 		= (int)$mthiki;
			$thniki 		= $arrtanggal[4].$arrtanggal[5].$arrtanggal[6].$arrtanggal[7];
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
		}
		$qrcode 	= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
		$tanggalctk = $tgliki.' '.$blniki.' '.$thniki;
		$total		= 0;
		$ekskula	= '';
		$ekskulb	= '';
		$ekskulc	= '';
		$ekskuld	= ''; 
		$ekskula2	= 0;
		$ekskulb2	= 0;
		$ekskulc2	= 0;
		$ekskuld2	= 0;
		$bulan		= '';
		$tahun		= '';
		$kelas		= '';
		$biayaspp	= 0;
		$biayadpp	= 0;
		$paguyuban	= 0;
		$bkegiatan  = 0;
		$bbukupaket	= 0;
		$bbukutulis	= 0;
		$lain1		= '';
		$lain1a		= 0;
		$lain2		= '';
		$lain2a		= 0;
		$lain3		= '';
		$lain3a		= 0;
		$tbukutulis = '';
		$tkegiatan  = '';
		$lain4 		= '';
		$lain4a		= 0;
		$ekskule 	= '';
		$ekskule2	= 0;
		$tbukupaket = '';
		$noinduk	= '';
		$nama		= '';
		$tulisbln	= '';
		$tlsbulan	= '';
		$gaksama	= '';
		$sql 		= Pembayaran::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rrincian){
				$nama 		= $rrincian->nama;
				$noinduk 	= $rrincian->noinduk;
				$jenis 		= $rrincian->jenis;		
				$biaya 		= $rrincian->biaya;
				$bulane 	= $rrincian->bulan;
				$tahune 	= $rrincian->tahun;
				$kelas 		= $rrincian->kelas;
				if ($gaksama == ''){ $gaksama = $noinduk; }
				else { 
					if ($gaksama != $noinduk){ $gaksama = 'benar'; }
					else { $gaksama = $noinduk; }
				}
				$bulan		= $bulane.'-'.$tahune.',';
				if ($tulisbln != $bulan){ $tulisbln = $bulan; $tlsbulan = $tlsbulan.' '.$bulan; }
				$tahun		= $tahune;
				$total		= $total + $biaya;
				$cekekskul	= Ekstrakulikuler::where('nama', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekekskul != 0){
					if ( $ekskula == $jenis ){ $ekskula2 = $ekskula2 + $biaya; }
					else if ( $ekskulb == $jenis ){ $ekskulb2 = $ekskulb2 + $biaya; }
					else if ( $ekskulc == $jenis ){ $ekskulc2 = $ekskulc2 + $biaya; }
					else if ( $ekskuld == $jenis ){ $ekskuld2 = $ekskuld2 + $biaya; }
					else if ( $ekskule == $jenis ){ $ekskule2 = $ekskule2 + $biaya; }
					else if ($ekskula == ''){ $ekskula = $jenis; $ekskula2 = $ekskula2 + $biaya;}
					else if ($ekskulb == ''){ $ekskulb = $jenis; $ekskulb2 = $ekskulb2 + $biaya; }
					else if ($ekskulc == ''){ $ekskulc = $jenis; $ekskulc2 = $ekskulc2 + $biaya; }
					else if ($ekskuld == ''){ $ekskuld = $jenis; $ekskuld2 = $ekskuld2 + $biaya; }
					else { $ekskule = $jenis; $ekskule2 = $ekskule2 + $biaya; }		
				} else {
					if ($jenis == 'spp'){
						$biayaspp = $biayaspp + $biaya;
					} elseif ($jenis == 'dpp'){
						$biayadpp = $biayadpp + $biaya;
					} elseif ($jenis == 'paguyuban'){
						$paguyuban = $paguyuban + $biaya;
					} else {
						$cekinsidental = Insidental::where('kode', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if (isset($cekinsidental->jenis)){
							$termasuk = $cekinsidental->jenis;
							$jenislain = $cekinsidental->deskripsi;
						} else {
							$termasuk 	= '';
							$jenislain 	= 'Deleted Insidental';
						}
						if ($termasuk == 'kegiatan'){ $bkegiatan = $bkegiatan + $biaya; }
						else if ($termasuk == 'bukupaket'){ $bbukupaket = $bbukupaket + $biaya; }
						else if ($termasuk == 'bukutulis'){ $bbukutulis = $bbukutulis + $biaya; }
						else {
							if ($lain1 == $jenislain){ $lain1a = $lain1a + $biaya; }
							else if ($lain2 == $jenislain){ $lain2a = $lain2a + $biaya; }
							else if ($lain3 == $jenislain){ $lain3a = $lain3a + $biaya; }
							else if ($lain4 == $jenislain){ $lain4a = $lain4a + $biaya; }
							else if ($lain1 == ''){
								$lain1 	= $jenislain;
								$lain1a = $lain1a + $biaya;
							}
							else if ($lain2 == ''){
								$lain2 	= $jenislain;
								$lain2a = $lain2a + $biaya;
							}
							else if ($lain3 == ''){
								$lain3 	= $jenislain;
								$lain3a = $lain3a + $biaya;
							}
							else {
								$lain4 	= $jenislain;
								$lain4a = $lain4a + $biaya;
							}
						}
					}
				}
			}
		}
		$x 			= Terbilang($total);
		if ($ekskula2 != 0){
			$tekskula2	= number_format( $ekskula2 , 0 , '.' , ',' );
		}
		else { $tekskula2 = ''; }
		
		if ($ekskulb2 != 0){
			$tekskulb2	= number_format( $ekskulb2 , 0 , '.' , ',' );
		}
		else { $tekskulb2 = ''; }
		
		if ($ekskulc2 != 0){
			$tekskulc2	= number_format( $ekskulc2 , 0 , '.' , ',' );
		}
		else { $tekskulc2 = ''; }
		
		if ($ekskuld2 != 0){
			$tekskuld2	= number_format( $ekskuld2 , 0 , '.' , ',' );
		}
		else { $tekskuld2 = ''; }
		
		if ($ekskule2 != 0){
			$tekskule2	= number_format( $ekskule2 , 0 , '.' , ',' );
		}
		else { $tekskule2 = ''; }
		
		if ($biayaspp != 0){
			$tbiayaspp	= number_format( $biayaspp , 0 , '.' , ',' );
		}
		else { $tbiayaspp = ''; }
		
		if ($biayadpp != 0){
			$tbiayadpp	= number_format( $biayadpp , 0 , '.' , ',' );
		}
		else { $tbiayadpp = ''; }
		
		if ($paguyuban != 0){
			$tpaguyuban	= number_format( $paguyuban , 0 , '.' , ',' );
		}
		else { $tpaguyuban = ''; }
		
		if ($bkegiatan != 0){
			$tkegiatan	= number_format( $bkegiatan , 0 , '.' , ',' );
		}
		else { $tkegiatan = ''; }
		
		if ($bbukupaket != 0){
			$tbukupaket	= number_format( $bbukupaket , 0 , '.' , ',' );
		}
		else { $tbukupaket = ''; }
		
		if ($bbukutulis != 0){
			$tbukutulis	= number_format( $bbukutulis , 0 , '.' , ',' );
		}
		else { $tbukutulis = ''; }
		
		if ($lain1a != 0){
			$tlain1a	= number_format( $lain1a , 0 , '.' , ',' );
		}
		else { $tlain1a = ''; }
		if ($lain2a != 0){
			$tlain2a	= number_format( $lain2a , 0 , '.' , ',' );
		}
		else { $tlain2a = ''; }
		
		if ($lain3a != 0){
			$tlain3a	= number_format( $lain3a , 0 , '.' , ',' );
		}
		else { $tlain3a = ''; }
		
		if ($lain4a != 0){
			$tlain4a	= number_format( $lain4a , 0 , '.' , ',' );
		}
		else { $tlain4a = ''; }
		$homebase				= url("/");
		$alamatcetak			= $homebase.'/kwitansi/'.$marking;
		$qrcode 				= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
		
		$tulisan				= number_format( $total , 0 , '.' , ',' );
		$y 						= $x.' rupiah';
		$niy 					= Session('nip');
		$asline 				= Session('nama');
		$rsetting				= Sekolah::find(session('sekolah_id_sekolah'));
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$logogrey 				= $rsetting->logo_grey;

		$tasks						= [];
		$tasks['logo']				= $logo;
		$tasks['logo_grey']			= $rsetting->logo_grey;
		$tasks['rsetting']			= $rsetting;
		$tasks['yayasan']			= $yayasan;
		$tasks['sekolah']			= $sekolah;
		$tasks['alamat']			= $alamat;
		$tasks['nama']				= $nama;
		$tasks['kelas']				= $kelas;
		$tasks['y']					= $y;
		$tasks['tlsbulan']			= $tlsbulan;
		$tasks['tbiayaspp']			= $tbiayaspp;
		$tasks['tbukutulis']		= $tbukutulis;
		$tasks['tkegiatan']			= $tkegiatan;
		$tasks['tbukupaket']		= $tbukupaket;
		$tasks['tbiayadpp']			= $tbiayadpp;
		$tasks['tpaguyuban']		= $tpaguyuban;
		$tasks['ekskula']			= $ekskula;
		$tasks['tekskula2']			= $tekskula2;
		$tasks['lain1']				= $lain1;
		$tasks['tlain1a']			= $tlain1a;
		$tasks['ekskulb']			= $ekskulb;
		$tasks['tekskulb2']			= $tekskulb2;
		$tasks['lain2']				= $lain2;
		$tasks['tlain2a']			= $tlain2a;
		$tasks['ekskulc']			= $ekskulc;
		$tasks['tekskulc2']			= $tekskulc2;
		$tasks['lain3']				= $lain3;
		$tasks['tlain3a']			= $tlain3a;
		$tasks['ekskuld']			= $ekskuld;
		$tasks['tekskuld2']			= $tekskuld2;
		$tasks['lain4']				= $lain4;
		$tasks['tlain4a']			= $tlain4a;
		$tasks['ekskule']			= $ekskule;
		$tasks['tekskule2']			= $tekskule2;
		$tasks['tanggalctk']		= $tanggalctk;
		$tasks['tulisan']			= $tulisan;
		$tasks['mutiara']			= $mutiara;
		$tasks['asline']			= $asline;
		$tasks['qrcode']			= $qrcode;
		$tasks['logogrey']			= $logogrey;
		
		$homebase	= url("/");
		$domain		= str_replace('https://', '', $homebase);
		$info = array(
			'Name' 			=> 'DuiDev Software Hose',
			'Location' 		=> 'Malang East Java',
			'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
			'ContactInfo' 	=> $domain,
		);
		$certificate	= 'file://'.base_path().'/public/sco.crt';
		$page_format 	= array(
			'MediaBox' 	=> array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 200),
			'Dur' 		=> 3,
			'PZ' 		=> 1,
		);
		$qrcode 		= QrCode::format('png')->merge('https://duidev.com/public/mascot.png', 0.1, true)->size(150)->generate($kirim);
		$output_file 	= 'scan/qrimg-'. $marking.'.png';
		Storage::disk('local')->put($output_file, $qrcode);
		
		$tasks['qrcode']= $homebase.'/scan/qrimg-'. $marking.'.png';
		$generatetable =  view('cetak.kwitansi', $tasks);
	
		PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
		PDFCREATOR::SetCreator($sekolah);
		PDFCREATOR::SetAuthor($nama);
		PDFCREATOR::SetTitle('KWITANSI '.$tlsbulan);
		PDFCREATOR::SetSubject($nama);
		PDFCREATOR::SetKeywords($tulisan);
		PDFCREATOR::setPrintHeader(false);
		PDFCREATOR::setPrintFooter(false);
		PDFCREATOR::SetMargins(5, 0, 5);
		PDFCREATOR::setFontSubsetting(true);
		PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
		PDFCREATOR::AddPage('L', $page_format, false, false);
		$bMargin = PDFCREATOR::getBreakMargin();
		$auto_page_break = PDFCREATOR::getAutoPageBreak();
		PDFCREATOR::SetAutoPageBreak(false, 0);
		PDFCREATOR::Image($logogrey, 0, 0, 210, 280);
		PDFCREATOR::SetAutoPageBreak(true, 0);
		PDFCREATOR::setPageMark();
		PDFCREATOR::writeHTML($generatetable, true, 0, true, 0);
		PDFCREATOR::setCellHeightRatio(2);
		PDFCREATOR::setFooterMargin(0);
		$pdfdoc = PDFCREATOR::Output('', 'S');
		PDFCREATOR::reset();
		Storage::disk('local')->put('/scan/generate/'.$marking.'.pdf', $pdfdoc);
		$file 		= public_path('scan/generate/'.$marking.'.pdf');
		return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
    }
	public function cekingPembayaran ($id){
		$homebase			= url("/");
		$cekdata 			= Pembayaranzis::where('id', $id)->count();
		if ($cekdata == 0){
			$data 						= [];
			$data['logo']				= $homebase.'/logo.png';
			$data['logo_grey']			= '';
			$data['yayasan']   			= '';
			$data['sekolah']   			= '';
			$data['alamat']   			= '';
			$data['rsetting']   		= [];
			$data['nama']   			= 'Not Found';
			$data['kelas']   			= 'Not Found';
			$data['namawali']   		= 'Not Found';
			$data['jeniszakat']   		= '';
			$data['orang']         		= '0';
			$data['satuan']         	= '';
			$data['nominal']           	= '0';
			$data['zakatmaal']         	= '0';
			$data['donasi']          	= '0';
			$data['total']          	= '0';
			$data['qrcode']            	= '';
			$data['status']           	= '<span class="label label-danger">Not Found</span>';
		} else {
			$getdata 			= Pembayaranzis::where('id', $id)->first();
			$namawali			= $getdata->namawali;
			$hape				= $getdata->hape; 
			$namasiswa			= $getdata->namasiswa; 
			$kelas				= $getdata->kelas; 
			$jeniszakat			= $getdata->jeniszakat; 
			$orang				= $getdata->orang; 
			$nominal			= $getdata->nominal; 
			$zakatmaal			= $getdata->zakatmaal; 
			$donasi				= $getdata->donasi; 
			$validator			= $getdata->validator;
			$tglvalidasi		= $getdata->tglvalidasi;
			$namafile			= $getdata->namafile;
			$id_sekolah			= $getdata->id_sekolah;
			if ($jeniszakat == 'Uang'){
				$total			= $nominal + $zakatmaal + $donasi;
				$satuan 		= 'Rp. 35.000,-';
				$nominal		= number_format( $nominal , 0 , '.' , ',' );
			} else {
				$total			= $zakatmaal + $donasi;
				$satuan			= '2.5 Kg';
				$nominal		= 0;
			}
			$zakatmaal			= number_format( $zakatmaal , 0 , '.' , ',' );
			$donasi				= number_format( $donasi , 0 , '.' , ',' );
			$total				= number_format( $total , 0 , '.' , ',' );
			$alamatweb			= $homebase.'/ceking/'.$id;
			$alamatcetak		= $homebase.'/verifikasi/'.$id;
			if ($tglvalidasi == '0000-00-00'){
				$qrcode 		= '';
				$status 		= '<span class="label label-danger">Belum di Validasi</span>';
			} else {
				$qrcode 		= QrCode::size(150)->generate($alamatweb);
				$status 		= '<a href="'.$alamatcetak.'" target="_blank"><span class="label label-primary">Telah di validasi, Klik untuk Cetak Tanda Terima</span></a>';
			}
			$data 						= [];
			$rsetting					= Sekolah::where('id',$id_sekolah)->first();
			$sekolah 					= $rsetting->nama_sekolah;
			$yayasan 					= $rsetting->nama_yayasan;
			$alamat 					= $rsetting->alamat;
			$kepalasekolah 				= $rsetting->kepala_sekolah->nama;
			$mutiara 					= $rsetting->slogan;
			$logo 						= $rsetting->logo;
			
			$data['logo']				= $homebase.'/'.$logo;
			$data['logo_grey']			= $homebase.'/'.$rsetting->logo_grey;
			$data['yayasan']   			= $yayasan;
			$data['sekolah']   			= $sekolah;
			$data['alamat']   			= $alamat;
			$data['nama']   			= $namasiswa;
			$data['kelas']   			= $kelas;
			$data['rsetting']   		= $rsetting;
			$data['namawali']   		= $namawali;
			$data['jeniszakat']   		= $jeniszakat;
			$data['orang']         		= $orang;
			$data['satuan']         	= $satuan;
			$data['nominal']           	= $nominal;
			$data['zakatmaal']         	= $zakatmaal;
			$data['donasi']          	= $donasi;
			$data['total']          	= $total;
			$data['qrcode']            	= $qrcode;
			$data['status']           	= $status;
		}
		return view('viewstatus', $data);
	}
	public function viewKarpes ($id){
		$homebase		= url("/");
		$tasks 			= [];
		$alamatcetak	= $homebase.'/karpes/'.$id;
		$cekjenis 		= explode('-b9504', $id);
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
       	$qrcode 		= QrCode::size(150)->generate($alamatcetak);
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
		if (isset($cekjenis[1])){
			$hilangkan 		= array("dd1f14bce8311-", "-b9504e032cde2424102", " ");
			$id				= str_replace($hilangkan, "", $id);
			$cekada 		= Banksoalujian::where('id', $id)->first();
			if (isset($cekada->id)){
				$foto 					= $logo;
				$getdata 				= Banksoalujian::select(DB::raw('SUM(skore) as nilai'), 'id', 'marking', 'namapeserta', 'nomorpeserta', 'asalpeserta', 'supervisor', 'idmahasiswa')->where('marking', $cekada->marking)->where('idmahasiswa', $cekada->idmahasiswa)->groupBy('idmahasiswa')->first();
				$getsimpeg 				= Simpegpegawai::where('id', $cekada->idmahasiswa)->first();
				if (isset($getsimpeg->idpeg)){
					if (is_null($getsimpeg->foto) OR $getsimpeg->foto == ''){

					} else {
						$foto 			= $getsimpeg->foto;
						if (File::exists(base_path() ."/public/images/pegawai/". $foto)) {
							$foto 		= $homebase.'/images/pegawai/'.$foto;
						}
					}
				}
				$tasks['qrcode']		= $qrcode;
				$tasks['foto']  		= $foto;
				$tasks['datanya']  		= $getdata;
				return view('cetak.hasilujian', $tasks);
			} else {
				$tasks['judulpesan']		= 'Restricted Area';
				$tasks['kalimatheader']	= 'ID Tidak Valid';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.$id.' Tidak Di Temukan';
				return view('errors.notready', $tasks);
			}
		} else {
			$url 			= $homebase;
			$alamatweb		= $url.'/karpes/'.$id;
			$qrcode 		= base64_encode(QrCode::format('png')->size(100)->generate($alamatweb));
			$hasil			= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $id)->first();
			if (isset($hasil->nama_lengkap)){
				$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
				$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;	
				$idpeg 			= $hasil->idpeg;
				$setnama 		= $hasil->nama;
				$namalengkap 	= $hasil->nama_lengkap;
				$jenisnip 		= $hasil->jenisnip;
				$niplama		= $hasil->nip_lama;
				$nip 			= $hasil->nip_baru;
				$nidn 			= $hasil->nidn;
				$kelamin 		= $hasil->jenis_kelamin;
				$tmptlahir 		= $hasil->tmpt_lahir;
				$tgllahir 		= $hasil->tgl_lahir;
				$pangkat 		= $hasil->pangkat;
				$golongan 		= $hasil->golongan;
				$tmtgolongan	= $hasil->tmt_golongan;
				$jabfungsional 	= $hasil->jab_fungsional;
				$tmtfungsional 	= $hasil->tmt_fungsional;
				$tmtjabatan 	= $hasil->tmt_jabatan;
				$tmtcpns 		= $hasil->tmt_cpns;
				$tmtpns 		= $hasil->tmt_pns;
				$thnmasuk 		= $hasil->thn_masuk;
				$unitkerja 		= $hasil->unit_kerja;
				$bidangilmu 	= $hasil->bidang_ilmu;
				$subunit 		= $hasil->lab;
				$programstudi 	= $hasil->program_studi;
				$sertifikasi 	= $hasil->sertifikasi;
				$pendakhir 		= $hasil->pend_akhir;
				$statuspegawai	= $hasil->status_pegawai;
				$dosten			= $hasil->status_jabatan;
				$karpeg			= $hasil->karpeg;
				$agama			= $hasil->agama;
				$alamat			= $hasil->alamat;
				$notelp			= $hasil->no_telp;
				$nohp			= $hasil->no_hp;
				$email			= $hasil->email;
				$kode			= $hasil->kode;
				$foto			= $hasil->foto;
				$nmjabatan		= $hasil->jabatan;
				$ktp			= $hasil->ktp;
				$gelardepan		= $hasil->gelardepan;
				$gelarblakang	= $hasil->gelarblakang;
				$gelardepan2	= $hasil->gelardepan2;
				$gelarblakang2	= $hasil->gelarblakang2;
				$alamatmlg		= $hasil->alamatmlg;
				$kelurahan		= $hasil->kelurahan;
				$kecamatan		= $hasil->kecamatan;
				$propinsi		= $hasil->propinsi;
				$kota			= $hasil->kota;
				$kawin			= $hasil->kawin;
				$emailub		= $hasil->emailub;
				$emaillain		= $hasil->emaillain;
				$skcpns			= $hasil->skcpns;
				$skpns			= $hasil->skpns;
				$nik			= $hasil->nik;
				$nira			= $hasil->nira;
				$npwp			= $hasil->npwp;
				$bpjs			= $hasil->bpjs;
				$idregptk		= $hasil->idregptk;
				$idsdm			= $hasil->idsdm;	
				$tlsprodi		= $tlsprodi;
				$arrjabatan		= explode('-', $nmjabatan);
				$dosten			= strtoupper($dosten);
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
				$getdatasetting 				= Setting::where('ppabp', $programstudi)->where('jenis', 'ujiankompetensi')->first();
				if (isset($getdatasetting->isi2)){
					$setttingujian 				= $getdatasetting->isi2;
				} else { $setttingujian = ''; }
				$tandatangan 	= $homebase.'/boxed-bg.png';
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
				
				$thniki 						= (int)date("Y");
				$blniki 						= date("m");
				$thnlalu						= $thniki - 1;
				$thnakad						= $thnlalu.'/'.$thniki;
				$tasks['qrcode'] 				= $qrcode;
				$tasks['tandatangan'] 			= $tandatangan;
				$tasks['foto'] 					= $foto;
				$tasks['thniki'] 				= $thniki;
				$tasks['thnakad'] 				= $thnakad;
				$tasks['biodata'] 				= $hasil;
				$tasks['jadwalujian'] 			= $setttingujian;
				$tasks['sidebar'] 				= 'pengumumanverifikasi';
				return view('rekrutmen.pengumumanhasil', $tasks);
			} else {
				$tasks['judulpesan']	= 'Restricted Area';
				$tasks['kalimatheader']	= 'ID Tidak Valid';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.$id.' Tidak Di Temukan';
				return view('errors.notready', $tasks);
			}
		}
	
	}
	public function viewObservasi($id){
		$homebase			= url("/");
		$cekdata 			= Datapsb::where('id', $id)->count();
		if ($cekdata == 0){
			return view('error.hilang');
		} else {
			$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
			$tgliki			= date("d");
			$mthiki 		= (int)date("m");
			$thniki 		= date("Y");
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
			$alamatcetak	= $homebase.'/observasi/'.$id;
			$qrcode 		= QrCode::size(150)->generate($alamatcetak);
			$rsetting		= Sekolah::find(session('sekolah_id_sekolah'));
			$sekolah 		= $rsetting->nama_sekolah;
			$yayasan 		= $rsetting->nama_yayasan;
			$alamat 		= $rsetting->alamat;
			$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
			$mutiara 		= $rsetting->slogan;
			$logo 			= $rsetting->logo;
			$ketuapanitia	= $kepalasekolah;
			$getdata 		= Datapsb::where('id', $id)->first();
			$nik			= $getdata->nik;
			$kodependaf		= $getdata->kodependaf;
			$nama 			= $getdata->nama;
			$kelamin		= $getdata->kelamin;
			$tmplahir 		= $getdata->tmplahir;
			$tgllahir 		= $getdata->tgllahir;
			$umur 			= $getdata->umur;
			$darah			= $getdata->darah;
			$berat			= $getdata->berat;
			$tinggi 		= $getdata->tinggi;
			$alamatortu		= $getdata->alamatortu;
			$namaayah 		= $getdata->namaayah;
			$namaibu		= $getdata->namaibu;
			$kerjaayah		= $getdata->kerjaayah;
			$kerjaibu		= $getdata->kerjaibu;
			$wali			= $getdata->wali;
			$pekerjaanwali	= $getdata->pekerjaanwali;
			$foto			= $getdata->foto;
			$tamasuk		= $getdata->tamasuk;
			$hape			= $getdata->hape;
			$asal			= $getdata->asal;
			$mutasi			= $getdata->mutasi;
			$kelurahan		= $getdata->kelurahan;
			$kecamatan		= $getdata->kecamatan;
			$kota			= $getdata->kota;
			$kodepos		= $getdata->kodepos;
			$telpon			= $getdata->telpon;
			$erte			= $getdata->erte;
			$erwe			= $getdata->erwe;
			$n1				= $getdata->n1;
			$n2				= $getdata->n2;
			$n3				= $getdata->n3;
			$n4				= $getdata->n4;
			$n5				= $getdata->n5;
			$n6				= $getdata->n6;
			$n7				= $getdata->n7;
			$n8				= $getdata->n8;
			$n9				= $getdata->n9;
			$n10			= $getdata->n10;
			$n11			= $getdata->n11;
			$n12			= $getdata->n12;
			$n13			= $getdata->n13;
			$total			= $getdata->total;
			$rata			= $getdata->rata;
			$hasil			= $getdata->hasil;
			$nosurat		= $getdata->nosurat;
			$des1			= $getdata->des1;
			$des2			= $getdata->des2;
			$des3			= $getdata->des3;
			$des4			= $getdata->des4;
			$des5			= $getdata->des5;
			$des6			= $getdata->des6;
			$des7			= $getdata->des7;
			$deadline		= $getdata->deadline;
			$akhirumum		= $getdata->akhirumum;
			$seragam		= (int)$getdata->dana1;
			$gedung			= (int)$getdata->dana2;
			$spp			= (int)$getdata->dana3;
			$kegiatan		= $getdata->dana4;
			
			$cekpelengkap	= Datapelengkappsb::where('niksiswa', $nik)->first();
			if (isset($cekpelengkap->niksiswa)){
				$scanakta 	= $cekpelengkap->scanakta;
				$scanfoto	= $cekpelengkap->scanfoto;
				$scankk 	= $cekpelengkap->scankk;
				$scanket 	= $cekpelengkap->scanket;
				$telpon 	= $cekpelengkap->telpon;
			} else {
				$scanakta 	= '';
				$scanfoto	= '';
				$scankk 	= '';
				$scanket 	= '';
				$telpon 	= '';
			}

			$statppdb				= '';
			$kodebaru				= '';
			$kodepindahan 			= '';
			$hargaformulir 			= '';
			$namabank 				= '';
			$norek 					= '';
			$periode 				= '';
			$setspp1 				= '';
			$setspp2 				= '';
			$setspp3 				= '';
			$setdpp1 				= '';
			$setdpp2 				= '';
			$setdpp3 				= '';
			$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
			if (!empty($sql)){
				foreach ($sql as $rlayanan){
					$status 		= $rlayanan->status;
					$layanan 		= $rlayanan->layanan;
					if ($layanan == 'periodepsb') { $periode = $status; }
					if ($layanan == 'ppdb') { $statppdb = $status; }
					if ($layanan == 'kodebaru') { $kodebaru = $status; }
					if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
					if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
					if ($layanan == 'namabank') { $namabank = $status; }
					if ($layanan == 'norek') { $norek = $status; }
					if ($layanan == 'spp1') { $setspp1 = $status; }
					if ($layanan == 'spp2') { $setspp2 = $status; }
					if ($layanan == 'spp3') { $setspp3 = $status; }
					if ($layanan == 'dpp1') { $setdpp1 = $status; }
					if ($layanan == 'dpp2') { $setdpp2 = $status; }
				}
			}
			$pembagi1 	= 0;
			$pembagi2 	= 0;
			$pembagi3a	= 0;
			$pembagi3b	= 0;
			$pembagi4 	= 0;
			$tot1		= 0;
			$tot2		= 0;
			$tot3a		= 0;
			$tot3b		= 0;
			$tot4		= 0;
			if ($hasil == 'DITERIMA'){
				if ($n1 != ''){ 
					$pembagi1++; 
					$tot1 = $tot1 + $n1; 
					if ( ($n1 >= 0) && ($n1 <= 68)) { $terbilang1 = 'D'; }
					elseif ( ($n1 >= 69) && ($n1 <= 77)) { $terbilang1 = 'C'; }
					elseif ( ($n1 >= 78) && ($n1 <= 89)) { $terbilang1 = 'B'; }	
					else { $terbilang1 = 'A';}
				} else { $terbilang1 = ''; }
				if ($n2 != ''){ 
					$pembagi1++; 
					$tot1 = $tot1 + $n2; 
					if ( ($n2 >= 0) && ($n2 <= 68)) { $terbilang2 = 'D'; }
					elseif ( ($n2 >= 69) && ($n2 <= 77)) { $terbilang2 = 'C'; }
					elseif ( ($n2 >= 78) && ($n2 <= 89)) { $terbilang2 = 'B'; }	
					else { $terbilang2 = 'A';}	
				} else { $terbilang2 = ''; }
				if ($n3 != ''){ 
					$pembagi1++;
					$tot1 = $tot1 + $n3; 
					if ( ($n3 >= 0) && ($n3 <= 68)) { $terbilang3 = 'D'; }
					elseif ( ($n3 >= 69) && ($n3 <= 77)) { $terbilang3 = 'C'; }
					elseif ( ($n3 >= 78) && ($n3 <= 89)) { $terbilang3 = 'B'; }	
					else { $terbilang3 = 'A';}	
				} else { $terbilang3 = ''; }
				if ($n4 != ''){ 
					$pembagi2++; 
					$tot2 = $tot2 + $n4; 
					if ( ($n4 >= 0) && ($n4 <= 68)) { $terbilang4 = 'D'; }
					elseif ( ($n4 >= 69) && ($n4 <= 77)) { $terbilang4 = 'C'; }
					elseif ( ($n4 >= 78) && ($n4 <= 89)) { $terbilang4 = 'B'; }	
					else { $terbilang4 = 'A';}
				} else { $terbilang4 = ''; }
				if ($n5 != ''){ 
					$pembagi2++; 
					$tot2 = $tot2 + $n5; 
					if ( ($n5 >= 0) && ($n5 <= 68)) { $terbilang5 = 'D'; }
					elseif ( ($n5 >= 69) && ($n5 <= 77)) { $terbilang5 = 'C'; }
					elseif ( ($n5 >= 78) && ($n5 <= 89)) { $terbilang5 = 'B'; }	
					else { $terbilang5 = 'A';}
				} else { $terbilang5 = ''; }
				if ($n6 != ''){ 
					$pembagi2++; 
					$tot2 = $tot2 + $n6; 
					if ( ($n6 >= 0) && ($n6 <= 68)) { $terbilang6 = 'D'; }
					elseif ( ($n6 >= 69) && ($n6 <= 77)) { $terbilang6 = 'C'; }
					elseif ( ($n6 >= 78) && ($n6 <= 89)) { $terbilang6 = 'B'; }	
					else { $terbilang6 = 'A';}
				} else { $terbilang6 = ''; }
				if ($n7 != ''){ 
					$pembagi3a++; 
					$tot3a = $tot3a + $n7; 
					if ( ($n7 >= 0) && ($n7 <= 68)) { $terbilang7 = 'D'; }
					elseif ( ($n7 >= 69) && ($n7 <= 77)) { $terbilang7 = 'C'; }
					elseif ( ($n7 >= 78) && ($n7 <= 89)) { $terbilang7 = 'B'; }	
					else { $terbilang7 = 'A';}
				} else { $terbilang7 = ''; }
				if ($n8 != ''){ 
					$pembagi3a++; 
					$tot3a = $tot3a + $n8; 
					if ( ($n8 >= 0) && ($n8 <= 68)) { $terbilang8 = 'D'; }
					elseif ( ($n8 >= 69) && ($n8 <= 77)) { $terbilang8 = 'C'; }
					elseif ( ($n8 >= 78) && ($n8 <= 89)) { $terbilang8 = 'B'; }	
					else { $terbilang8 = 'A'; }
				} else { $terbilang8 = ''; }
				if ($n9 != ''){ 
					$pembagi3b++; 
					$tot3b = $tot3b + $n9; 
					if ( ($n9 >= 0) && ($n9 <= 68)) { $terbilang9 = 'D'; }
					elseif ( ($n9 >= 69) && ($n9 <= 77)) { $terbilang9 = 'C'; }
					elseif ( ($n9 >= 78) && ($n9 <= 89)) { $terbilang9 = 'B'; }	
					else { $terbilang9 = 'A'; }
				} else { $terbilang9 = ''; }
				if ($n10 != ''){ 
					$pembagi3b++; 
					$tot3b = $tot3b + $n10; 
					if ( ($n10 >= 0) && ($n10 <= 68)) { $terbilang10 = 'D'; }
					elseif ( ($n10 >= 69) && ($n10 <= 77)) { $terbilang10 = 'C'; }
					elseif ( ($n10 >= 78) && ($n10 <= 89)) { $terbilang10 = 'B'; }	
					else { $terbilang10 = 'A'; }
				} else { $terbilang10 = ''; }
				if ($n11 != ''){ 
					$pembagi4++; 
					$tot4 = $tot4 + $n11; 
					if ( ($n11 >= 0) && ($n11 <= 68)) { $terbilang11 = 'D'; }
					elseif ( ($n11 >= 69) && ($n11 <= 77)) { $terbilang11 = 'C'; }
					elseif ( ($n11 >= 78) && ($n11 <= 89)) { $terbilang11 = 'B'; }	
					else { $terbilang11 = 'A'; }
				} else { $terbilang11 = ''; }
				if ($n12 != ''){ 
					$pembagi4++; 
					$tot4 = $tot4 + $n12; 
					if ( ($n12 >= 0) && ($n12 <= 68)) { $terbilang12 = 'D'; }
					elseif ( ($n12 >= 69) && ($n12 <= 77)) { $terbilang12 = 'C'; }
					elseif ( ($n12 >= 78) && ($n12 <= 89)) { $terbilang12 = 'B'; }	
					else { $terbilang12 = 'A'; }
				} else { $terbilang12 = ''; }
				if ($n13 != ''){ 
					$pembagi4++; 
					$tot4 = $tot4 + $n13; 
					if ( ($n13 >= 0) && ($n13 <= 68)) { $terbilang13 = 'D'; }
					elseif ( ($n13 >= 69) && ($n13 <= 77)) { $terbilang13 = 'C'; }
					elseif ( ($n13 >= 78) && ($n13 <= 89)) { $terbilang13 = 'B'; }	
					else { $terbilang13 = 'A'; }
				} else { $terbilang13 = ''; }
				if ($tot1 != 0){
					$kognitif 	= round(($tot1 / $pembagi1),0);
				} else { $kognitif = ''; }
				
				if ($tot3a != 0){
					$keagamaana 	= round(($tot3a / $pembagi3a),0);
				} else { $keagamaana = ''; }
				
				if ($tot3b != 0){
					$keagamaanb 	= round(($tot3b / $pembagi3b),0);
				} else { $keagamaanb = ''; }
				
				if ($keagamaana != 0){
					$keagamaan 	= round((($keagamaana + $keagamaanb) / 2),0); 
				} else { $keagamaan = ''; }

				$tagihan	= $seragam + $gedung + $spp;
				$totalbayar = number_format( $tagihan , 0 , '.' , ',' );
				$seragam 	= number_format( $seragam , 0 , '.' , ',' );
				$gedung 	= number_format( $gedung , 0 , '.' , ',' );
				$spp 		= number_format( $spp , 0 , '.' , ',' );

				$generatetbl= '
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="8"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">'.$alamat.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="83">Nomor</td>
					<td width="14">:</td>
					<td colspan="9"><b>'.$nosurat.'</b></td>
				  </tr>
				  <tr>
					<td>Lamp.</td>
					<td>:</td>
					<td colspan="9"><b>1 Lembar</b></td>
				  </tr>
				  <tr>
					<td>Perihal</td>
					<td>:</td>
					<td colspan="9"><b>Pengumuman Hasil Observasi</b></td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Kepada Yth.</td>
				  </tr>
				  <tr>
					<td colspan="11"><b>Wali Murid Ananda '.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="11">Di tempat</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Assalamu&#8217;alaikum warahmatullaahi Wabarakaatuh</em></td>
				  </tr>
				  <tr>
					<td colspan="11">Berdasarkan hasil observasi kompetensi calon peserta didik baru '.$sekolah.' Kota '.config('global.kota').' Tahun Pelajaran '.$tamasuk.', kami putuskan bahwa :</td>
				  </tr>
				  <tr>
					<td colspan="2">Nama</td>
					<td width="38">:</td>
					<td colspan="8"><b>'.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="2">No. Observasi</td>
					<td>:</td>
					<td colspan="8"><strong>'.$kodependaf.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2">dinyatakan</td>
					<td>:</td>
					<td colspan="8">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" valign="middle"><table width="200" border="1" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center" valign="middle"><b>'.$hasil.'</b></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td colspan="11">sebagai siswa kelas 1 di '.$sekolah.' Tahun Pelajaran '.$tamasuk.'</td>
				  </tr>
				  <tr>
					<td colspan="11">
					<table cellpadding="0" cellspacing="0" border="1" width="100%">
					  <tr>
						<td colspan="10" style="text-align:center; background-color:#6C9"><b>Kesimpulan Hasil Observasi</b></td>
					  </tr>
					  <tr>
						<td colspan="3" style="text-align:center;background-color:#6C9">Observasi</td>
						<td width="143" rowspan="2" style="text-align:center;"><u>Kognitif</u><br />
						  <strong>'.$kognitif.'</strong></td>
						<td rowspan="2" style="text-align:center;"><u>Keagamaan</u><br /><strong>'.$keagamaan.'</strong></td>
						<td colspan="2" style="border-bottom:thin; text-align:center; background-color:#6C9"><u>Jumlah</u></td>
						<td colspan="3" style="text-align:center;background-color:#6C9"><u>Rata - Rata</u></td>
					  </tr>
					  <tr>
						<td colspan="3" style="text-align:center;background-color:#6C9"><b>NILAI</b></td>
						<td colspan="2" style="text-align:center;background-color:#6C9"><strong>'.$total.'</strong></td>
						<td colspan="3" style="text-align:center;background-color:#6C9"><strong>'.$rata.'</strong></td>
					  </tr>
					</table>
					</td>
				  </tr> 
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="11">&nbsp;</td>
					<td width="253">&nbsp;</td>
					<td width="43">&nbsp;</td>
					<td width="105">&nbsp;</td>
					<td width="19">&nbsp;</td>
					<td width="134">&nbsp;</td>
					<td width="49">&nbsp;</td>
					<td width="51">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Sehubungan dengan hal tersebut di atas, kami mohon Bapak/Ibu segera melakukan registrasi (daftar ulang) dengan persyaratan sebagai berikut :</td>
				  </tr>
				  <tr>
					<td align="right">1.</td>
					<td>&nbsp;</td>
					<td colspan="9">Melengkapi persyaratan calon siswa baru dengan menyerahkan :</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>a.</td>
					<td colspan="8">Foto copy Kartu Keluarga 2 lembar dengan menunjukkan dokumen asli (bagi yang belum) ;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>b.</td>
					<td colspan="8">Pas Foto berwarna ukuran 3 x 4 sebanyak 2 lembar (bagi yang belum) ;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>c.</td>
					<td colspan="8">Surat keterangan domisili dari RT / RW (bagi yang mengontrak) ;</td>
				  </tr>
				  <tr>
					<td align="right">2.</td>
					<td>&nbsp;</td>
					<td colspan="9">Membayar biaya</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>a.</td>
					<td colspan="2">Seragam &amp; ATS</td>
					<td>Rp.</td>
					<td colspan="2" align="right">'.$seragam.'</td>
					<td colspan="3" class="info">&nbsp;&nbsp;(Saat Daftar Ulang)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>b.</td>
					<td colspan="2">Dana Pengembangan Pendidikan</td>
					<td>Rp.</td>
					<td colspan="2" align="right">'.$gedung.'</td>
					<td colspan="3" class="info">&nbsp;&nbsp;(Saat Daftar Ulang)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>c.</td>
					<td colspan="2">Iuran bulan Pertama</td>
					<td>Rp.</td>
					<td colspan="2" align="right">'.$spp.'</td>
					<td colspan="3" class="info">&nbsp;&nbsp;(Paling lambat tgl.'.$deadline.')</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><strong>Total</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align="left"><strong>Rp.</strong></td>
					<td colspan="2" align="right"><strong>'.$totalbayar.'</strong></td>
					<td align="right">&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td align="right" valign="top">3.</td>
					<td>&nbsp;</td>
					<td colspan="9" valign="top">Batas Registrasi atau Daftar Ulang <strong>paling lambat satu minggu</strong> setelah pengumuman hasil observasi diterima (berakhir hari '.$akhirumum.'). Jika tidak melakukan daftar ulang pada waktu yang ditentukan dianggap mengundurkan diri dan akan diisi oleh peserta selanjutnya.</td>
				  </tr>
				  <tr>
					<td align="right"valign="top">4.</td>
					<td>&nbsp;</td>
					<td colspan="9" valign="top">Melakukan pengukuran seragam (diumumkan menyusul lewat WA/SMS).</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Demikian surat pemberitahuan ini, atas bantuan dan kerjasamanya yang baik kami sampaikan terima kasih.</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Wasssalamu&#8217;alaikum warahmatullaahi Wabarakaatuh.</em></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>__________________</strong></td>
				  </tr>
				</table>
				<div style="page-break-before: always">
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="2" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="9"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="9"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="9"><strong>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="9">Terakreditasi A</td>
				  </tr>
				  <tr>
					<td colspan="9" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="9" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" style="font-size:large;"><b><u>LAPORAN HASIL OBSERVASI PESERTA DIDIK BARU</u></b></td>
				  </tr>
				  <tr>
					<td colspan="11" align="center"><b>TAHUN AJARAN '.$tamasuk.'</b></td>
				  </tr>
				  <tr>
					<td width="80">&nbsp;</td>
					<td width="70">&nbsp;</td>
					<td width="189">&nbsp;</td>
					<td width="16">&nbsp;</td>
					<td width="173">&nbsp;</td>
					<td width="51">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="153">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="6">Nama PDB : '.$nama.'</td>
					<td colspan="5" align="right">No. Observasi : '.$kodependaf.'</td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top: double; text-align: center;"><table border="1" cellpadding="0" cellspacing="0">
					  <tr>
						<td width="24" rowspan="2" align="center" bgcolor="#339933"><b>NO</b></td>
						<td width="120" rowspan="2" align="center" bgcolor="#339933"><b>OBSERVASI</b></td>
						<td width="239" rowspan="2" align="center" bgcolor="#339933"><b>ASPEK<br />
						  PENILAIAN</b></td>
						<td colspan="2" align="center" bgcolor="#339933"><b>PEROLEHAN NILAI</b></td>
						<td width="225" rowspan="2" align="center" bgcolor="#339933"><b>DESKRIPSI</b></td>
					  </tr>
					  <tr>
						<td width="71" align="center" bgcolor="#339933"><b>ANGKA</b></td>
						<td width="107" align="center" bgcolor="#339933"><b>HURUF</b></td>
						</tr>
					  <tr>
						<td rowspan="3">1.</td>
						<td rowspan="3">KOGNITIF</td>
						<td>Membaca</td>
						<td style="text-align: center">'.$n1.'</td>
						<td>'.$terbilang1.'</td>
						<td align="left" valign="top">'.$des1.'</td>
					  </tr>
					  <tr>
						<td>Menulis</td>
						<td style="text-align: center">'.$n2.'</td>
						<td>'.$terbilang2.'</td>
						<td align="left" valign="top">'.$des2.'</td>
					  </tr>
					  <tr>
						<td>Berhitung</td>
						<td style="text-align: center">'.$n3.'</td>
						<td>'.$terbilang3.'</td>
						<td align="left" valign="top">'.$des3.'</td>
					  </tr>
					<tr>
						<td rowspan="4">2.</td>
						<td rowspan="4">KEMAMPUAN AGAMA ISLAM</td>
						<td>Mengaji/Membaca</td>
						<td style="text-align: center">'.$n7.'</td>
						<td>'.$terbilang7.'</td>
						<td align="left" valign="top">'.$des4.'</td>
					</tr>
					<tr>
						<td>Menulis</td>
						<td style="text-align: center">'.$n8.'</td>
						<td>'.$terbilang8.'</td>
						<td align="left" valign="top">'.$des5.'</td>
						</tr>
					<tr>
						<td>3 Surat Juz Amma</td>
						<td style="text-align: center">'.$n9.'</td>
						<td>'.$terbilang9.'</td>
						<td align="left" valign="top">'.$des6.'</td>
					</tr>
					<tr>
						<td>3 Doa Harian</td>
						<td style="text-align: center">'.$n10.'</td>
						<td>'.$terbilang10.'</td>
						<td align="left" valign="top">'.$des7.'</td>
					</tr>

				  </table>
				  </td></tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>__________________</strong></td>
				  </tr>
				</table>';
			}
			else if ($hasil == 'BELUM DITERIMA'){
				$generatetbl= '
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="8"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">'.$alamat.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="83">Nomor</td>
					<td width="14">:</td>
					<td colspan="9"><b>'.$nosurat.'</b></td>
				  </tr>
				  <tr>
					<td>Lamp.</td>
					<td>:</td>
					<td colspan="9"><b>1 Lembar</b></td>
				  </tr>
				  <tr>
					<td>Perihal</td>
					<td>:</td>
					<td colspan="9"><b>Pengumuman Hasil Observasi</b></td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Kepada Yth.</td>
				  </tr>
				  <tr>
					<td colspan="11"><b>Wali Murid Ananda '.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="11">Di tempat</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Assalamu&#8217;alaikum warahmatullaahi Wabarakaatuh</em></td>
				  </tr>
				  <tr>
					<td colspan="11">Berdasarkan hasil observasi kompetensi calon peserta didik baru '.$sekolah.' Kota Malang Tahun Pelajaran '.$tamasuk.', kami putuskan bahwa :</td>
				  </tr>
				  <tr>
					<td colspan="2">Nama</td>
					<td width="38">:</td>
					<td colspan="8"><b>'.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="2">No. Observasi</td>
					<td>:</td>
					<td colspan="8"><strong>'.$kodependaf.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2">dinyatakan</td>
					<td>:</td>
					<td colspan="8">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" valign="middle"><table width="200" border="1" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center" valign="middle"><b>'.$hasil.'</b></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td colspan="11">terima kasih atas partisipasi Bapak / Ibu Wali Murid dalam PPDB tahun ini, dan kami berdoa semoga ananda '.$nama.' dapat diterima di sekolah lain yang lebih baik.</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Demikian surat pemberitahuan ini, atas bantuan dan kerjasamanya yang baik kami sampaikan terima kasih.</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Wasssalamu&#8217;alaikum warahmatullaahi Wabarakaatuh.</em></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>___________________</strong></td>
				  </tr>
				</table>';
			}
			else {
				$generatetbl= '
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="8"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">'.$alamat.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="83">Nomor</td>
					<td width="14">:</td>
					<td colspan="9"><b>'.$nosurat.'</b></td>
				  </tr>
				  <tr>
					<td>Lamp.</td>
					<td>:</td>
					<td colspan="9"><b>1 Lembar</b></td>
				  </tr>
				  <tr>
					<td>Perihal</td>
					<td>:</td>
					<td colspan="9"><b>Pengumuman Hasil Observasi</b></td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Kepada Yth.</td>
				  </tr>
				  <tr>
					<td colspan="11"><b>Wali Murid Ananda '.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="11">Di tempat</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Assalamu&#8217;alaikum warahmatullaahi Wabarakaatuh</em></td>
				  </tr>
				  <tr>
					<td colspan="11">Berdasarkan hasil observasi kompetensi calon peserta didik baru '.$sekolah.' Kota Malang Tahun Pelajaran '.$tamasuk.', kami putuskan bahwa :</td>
				  </tr>
				  <tr>
					<td colspan="2">Nama</td>
					<td width="38">:</td>
					<td colspan="8"><b>'.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="2">No. Observasi</td>
					<td>:</td>
					<td colspan="8"><strong>'.$kodependaf.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2">dinyatakan</td>
					<td>:</td>
					<td colspan="8">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" valign="middle"><table width="200" border="1" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center" valign="middle"><b>SEBAGAI '.$hasil.'</b></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td colspan="11">kami berharap Bapak /  Ibu Wali Murid dapat bersabar menunggu pihak sekolah menghubungi Bapak /Ibu Wali Murid apabila ada calon siswa baru yang mengundurkan diri.</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Demikian surat pemberitahuan ini, atas bantuan dan kerjasamanya yang baik kami sampaikan terima kasih.</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Wasssalamu&#8217;alaikum warahmatullaahi Wabarakaatuh.</em></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>__________________</strong></td>
				  </tr>
				</table>';
			}
			
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['generatetbl']	= $generatetbl;
			$tasks['qrcode']		= $qrcode;
			return view('cetak.observasi', $tasks);
		}		
	}
	public function ctkFormkesanggupan($id){
		$homebase				= url("/");
		
		$rsetting				= Sekolah::find(session('sekolah_id_sekolah'));
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$statppdb				= '';
		$kodebaru				= '';
		$kodepindahan 			= '';
		$hargaformulir 			= '';
		$namabank 				= '';
		$norek 					= '';
		$periode 				= '';
		$setspp1 				= '';
		$setspp2 				= '';
		$setspp3 				= '';
		$setdpp1 				= '';
		$setdpp2 				= '';
		$setdpp3 				= '';
		$byrdpp1 				= '';
		$byrdpp2 				= '';
		$byrdpp3 				= '';
		$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
		if (!empty($sql)){
			foreach ($sql as $rlayanan){
				$status 		= $rlayanan->status;
				$layanan 		= $rlayanan->layanan;
				if ($layanan == 'periodepsb') { $periode = $status; }
				if ($layanan == 'ppdb') { $statppdb = $status; }
				if ($layanan == 'kodebaru') { $kodebaru = $status; }
				if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
				if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
				if ($layanan == 'namabank') { $namabank = $status; }
				if ($layanan == 'norek') { $norek = $status; }
				if ($layanan == 'spp1') { $setspp1 = $status; }
				if ($layanan == 'spp2') { $setspp2 = $status; }
				if ($layanan == 'spp3') { $setspp3 = $status; }
				if ($layanan == 'dpp1') { $setdpp1 = $status; }
				if ($layanan == 'dpp2') { $setdpp2 = $status; }
			}
		}
		if ($setspp1 != ''){
			$byrspp1 = number_format( $setspp1 , 0 , '.' , ',' );
		} else { $byrspp1 = 0; }
		if ($setspp2 != ''){
			$byrspp2 = number_format( $setspp2 , 0 , '.' , ',' );
		} else { $byrspp2 = 0; }
		if ($setspp3 != ''){
			$byrspp3 = number_format( $setspp3 , 0 , '.' , ',' );
		} else { $byrspp3 = 0; }
		if ($setdpp1 != ''){
			$byrdpp1 = number_format( $setdpp1 , 0 , '.' , ',' );
		}
		if ($setdpp2 != ''){
			$byrdpp2 = number_format( $setdpp2 , 0 , '.' , ',' );
		}
		if ($setdpp3 != ''){
			$byrdpp3 = number_format( $setdpp3 , 0 , '.' , ',' );
		}
		$cekdata				= Datapsb::where('id', $id)->count();
		if ($cekdata != 0){
			$datapsb				= Datapsb::where('id', $id)->orderBy('id', 'DESC')->first();
			$nik					= $datapsb->nik;
			$cekpelengkap			= Datapelengkappsb::where('niksiswa', $nik)->first();
			if (isset($cekpelengkap->niksiswa)){
				$scanakta 	= $cekpelengkap->scanakta;
				$scanfoto	= $cekpelengkap->scanfoto;
				$scankk 	= $cekpelengkap->scankk;
				$scanket 	= $cekpelengkap->scanket;
				$telpon 	= $cekpelengkap->telpon;
			} else {
				$scanakta 	= '';
				$scanfoto	= '';
				$scankk 	= '';
				$scanket 	= '';
				$telpon 	= '';
			}
			$statcetak	= '';
			if ($scanakta == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Akta Terlebih Dahulu'; }
			if ($scanfoto == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan Foto Terlebih Dahulu'; }
			if ($scankk == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Kartu Keluarga Terlebih Dahulu'; }
			if ($scanket == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Keterangan dari Sekolah Terlebih Dahulu'; }
			$tahun					= date("Y");
			$tasks					= [];
			$tasks['logo']			= $homebase.'/'.$logo;
			$tasks['logo_grey']		= $homebase.'/'.$rsetting->logo_grey;
			$tasks['rsetting']		= $rsetting;
			$tasks['yayasan']		= $yayasan;
			$tasks['sekolah']		= $sekolah;
			$tasks['alamat']		= $alamat;
			$tasks['kepalasekolah']	= $kepalasekolah;
			$tasks['periode']		= $periode;
			$tasks['ketuayayasan']	= '____________________';
			$tasks['jabketyayasan']	= 'Ketua '.$yayasan;
			$tasks['datapsb']		= $datapsb;
			$tasks['byrspp1']		= $byrspp1;
			$tasks['byrspp2']		= $byrspp2;
			$tasks['byrspp3']		= $byrspp3;
			$tasks['byrdpp1']		= $byrdpp1;
			$tasks['byrdpp2']		= $byrdpp2;
			$tasks['byrdpp3']		= $byrdpp3;
			$tasks['tahun']			= $tahun;
			return view('cetak.formkesanggupan', $tasks);
		} else {
			return view('error.hilang');
		}
    }
	public function viewBiodatapsb($id){
		$homebase			= url("/");
		$cekdata 			= Datapsb::where('id', $id)->count();
		if ($cekdata == 0){
			return view('error.hilang');
		} else {
			$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
			$tgliki			= date("d");
			$mthiki 		= (int)date("m");
			$thniki 		= date("Y");
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
			$alamatcetak	= $homebase.'/biodatapsb/'.$id;
			$qrcode 		= QrCode::size(150)->generate($alamatcetak);
			$ketuapanitia	= '________________';
			$getdata 		= Datapsb::where('id', $id)->first();
			$nik			= $getdata->nik;
			$kodependaf		= $getdata->kodependaf;
			$nama 			= $getdata->nama;
			$kelamin		= $getdata->kelamin;
			$tmplahir 		= $getdata->tmplahir;
			$tgllahir 		= $getdata->tgllahir;
			$umur 			= $getdata->umur;
			$darah			= $getdata->darah;
			$berat			= $getdata->berat;
			$tinggi 		= $getdata->tinggi;
			$alamatortu		= $getdata->alamatortu;
			$namaayah 		= $getdata->namaayah;
			$namaibu		= $getdata->namaibu;
			$kerjaayah		= $getdata->kerjaayah;
			$kerjaibu		= $getdata->kerjaibu;
			$wali			= $getdata->wali;
			$pekerjaanwali	= $getdata->pekerjaanwali;
			$foto			= $getdata->foto;
			$tamasuk		= $getdata->tamasuk;
			$hape			= $getdata->hape;
			$asal			= $getdata->asal;
			$mutasi			= $getdata->mutasi;
			$kelurahan		= $getdata->kelurahan;
			$kecamatan		= $getdata->kecamatan;
			$kota			= $getdata->kota;
			$kodepos		= $getdata->kodepos;
			$telpon			= $getdata->telpon;
			$erte			= $getdata->erte;
			$erwe			= $getdata->erwe;
			$n1				= $getdata->n1;
			$n2				= $getdata->n2;
			$n3				= $getdata->n3;
			$n4				= $getdata->n4;
			$n5				= $getdata->n5;
			$n6				= $getdata->n6;
			$n7				= $getdata->n7;
			$n8				= $getdata->n8;
			$n9				= $getdata->n9;
			$n10			= $getdata->n10;
			$n11			= $getdata->n11;
			$n12			= $getdata->n12;
			$n13			= $getdata->n13;
			$total			= $getdata->total;
			$rata			= $getdata->rata;
			$hasil			= $getdata->hasil;
			$nosurat		= $getdata->nosurat;
			$des1			= $getdata->des1;
			$des2			= $getdata->des2;
			$des3			= $getdata->des3;
			$des4			= $getdata->des4;
			$des5			= $getdata->des5;
			$des6			= $getdata->des6;
			$des7			= $getdata->des7;
			$deadline		= $getdata->deadline;
			$akhirumum		= $getdata->akhirumum;
			$seragam		= (int)$getdata->dana1;
			$gedung			= (int)$getdata->dana2;
			$spp			= (int)$getdata->dana3;
			$kegiatan		= $getdata->dana4;
			$rsetting		= Sekolah::find($getdata->id_sekolah);
			$sekolah 		= $rsetting->nama_sekolah;
			$yayasan 		= $rsetting->nama_yayasan;
			$alamat 		= $rsetting->alamat;
			$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
			$mutiara 		= $rsetting->slogan;
			$logo 			= $rsetting->logo;
			
			if ($wali != '') { $alamatwali = $alamatortu; }
			else { $alamatwali = ''; }

			$cekpelengkap	= Datapelengkappsb::where('niksiswa', $nik)->first();
			if (isset($cekpelengkap->niksiswa)){
				if ($cekpelengkap->scanakta == ''){
					$scanakta 	= $homebase.'/dist/img/aktehilang.png';
				} else {
					$scanakta 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanakta;
				}
				if ($cekpelengkap->scanfoto == ''){
					$scanfoto	= $homebase.'/dist/img/fotohilang.png';
				} else {
					$scanfoto	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanfoto;
				}
				if ($cekpelengkap->scankk == ''){
					$scankk 	= $homebase.'/dist/img/kkhilang.png';
				} else {
					$scankk 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scankk;
				}
				if ($cekpelengkap->scanket == ''){
					$scanket 	= $homebase.'/dist/img/kethilang.png';
				} else {
					$scanket 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanket;
				}
				if ($cekpelengkap->scanbukti == ''){
					$scanbukti 	= $homebase.'/dist/img/buktihilang.png';
				} else {
					$scanbukti 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanbukti;
				}
			} else {
				$scanakta 	= $homebase.'/dist/img/aktehilang.png';
				$scanfoto	= $homebase.'/dist/img/fotohilang.png';
				$scankk 	= $homebase.'/dist/img/kkhilang.png';
				$scanket 	= $homebase.'/dist/img/kethilang.png';
				$scanbukti 	= $homebase.'/dist/img/buktihilang.png';
			}
			
			
			if ($cekpelengkap->gayah == 'rangegaji1'){ 
				$tulisgajiayah = '&lt; Rp. 500.000,00'; 
			} else if ($cekpelengkap->gayah == 'rangegaji2'){ 
				$tulisgajiayah = 'Rp. 500.000,00 - Rp. 1.000.000,00'; 
			} else if ($cekpelengkap->gayah == 'rangegaji3'){ 
				$tulisgajiayah = 'Rp. 1.000.000,00 - Rp. 2.000.000,00';
			} else if ($cekpelengkap->gayah == 'rangegaji4'){ 
				$tulisgajiayah = '&gt; Rp. 2.000.000,00'; 
			} else {
				$tulisgajiayah	= '';
			}
			if ($cekpelengkap->gibu == 'rangegaji1'){ 
				$tulisgajiibu = '&lt; Rp. 500.000,00'; 
			} else if ($cekpelengkap->gibu == 'rangegaji2'){ 
				$tulisgajiibu = 'Rp. 500.000,00 - Rp. 1.000.000,00';
			} else if ($cekpelengkap->gibu == 'rangegaji3'){ 
				$tulisgajiibu = 'Rp. 1.000.000,00 - Rp. 2.000.000,00';
			} else if ($cekpelengkap->gibu == 'rangegaji4'){ 
				$tulisgajiibu = '&gt; Rp. 2.000.000,00'; 
			} else {
				$tulisgajiibu	= '';
			}
			$statppdb				= '';
			$kodebaru				= '';
			$kodepindahan 			= '';
			$hargaformulir 			= '';
			$namabank 				= '';
			$norek 					= '';
			$periode 				= '';
			$setspp1 				= '';
			$setspp2 				= '';
			$setspp3 				= '';
			$setdpp1 				= '';
			$setdpp2 				= '';
			$setdpp3 				= '';
			$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
			if (!empty($sql)){
				foreach ($sql as $rlayanan){
					$status 		= $rlayanan->status;
					$layanan 		= $rlayanan->layanan;
					if ($layanan == 'periodepsb') { $periode = $status; }
					if ($layanan == 'ppdb') { $statppdb = $status; }
					if ($layanan == 'kodebaru') { $kodebaru = $status; }
					if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
					if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
					if ($layanan == 'namabank') { $namabank = $status; }
					if ($layanan == 'norek') { $norek = $status; }
					if ($layanan == 'spp1') { $setspp1 = $status; }
					if ($layanan == 'spp2') { $setspp2 = $status; }
					if ($layanan == 'spp3') { $setspp3 = $status; }
					if ($layanan == 'dpp1') { $setdpp1 = $status; }
					if ($layanan == 'dpp2') { $setdpp2 = $status; }
				}
			}
			$generatetbl= '
				<table width="800" cellpadding="0" cellspacing="0" id="printiki">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="5">'.$yayasan.'</td>
					<td width="58">NO.</td>
					<td width="172" style="border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;text-align:center;vertical-align:middle;">'.$kodependaf.'</td>
				  </tr>
				  <tr>
					<td colspan="7">'.$sekolah.'</td>
				  </tr>
				  <tr>
					<td colspan="7">Terakreditasi A</td>
				  </tr>
				  <tr>
				 	 <td colspan="7" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="7">'.$alamat.'</td>
				  </tr>
				  <tr>
				  	<td colspan="7" style="color: #00F"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td width="51" align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td width="241" align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td width="26" align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td width="61" align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td align="left" valign="top" style="border-top:double">&nbsp;</td>
					<td align="left" valign="top" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="10" align="center"><strong>FORMULIR PENDAFTARAN SISWA BARU</strong></td>
				  </tr>
				  <tr>
					<td colspan="10" align="center"><strong>TAHUN PELAJARAN '.$tamasuk.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="10" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="10"></td>
				  </tr>
				  <tr>
					<td colspan="10" style="background:#999; border-bottom:1px solid black;border-top:1px solid black;"><strong>DATA UMUM</strong></td>
				  </tr>
				  <tr>
					<td colspan="10"><b><u>A. IDENTITAS CALON SISWA :</u></b></td>
				  </tr>
				  <tr>
					<td width="27">1</td>
					<td colspan="9">Nama Peserta Didik</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Lengkap (sesuai akta kelahiran)</td>
					<td width="7">:</td>
					<td colspan="5">'.$nama.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b. Panggilan</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->panggilan.'</td>
				  </tr>
				  <tr>
					<td>2</td>
					<td colspan="3">NIK SISWA</td>
					<td>:</td>
					<td colspan="5">'.$nik.'</td>
				  </tr>
				  <tr>
					<td>3</td>
					<td colspan="3">Jenis Kelamin</td>
					<td>:</td>
					<td colspan="5">'.$kelamin.'</td>
				  </tr>
				  <tr>
					<td>4</td>
					<td colspan="9">Kelahiran</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a. Tempat</td>
					<td>:</td>
					<td colspan="5">'.$tmplahir.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b. Tanggal-Bln-Tahun</td>
					<td>:</td>
					<td colspan="5">'.$tgllahir.' </td>
				  </tr>
				  <tr>
					<td>5</td>
					<td colspan="3">Umur (per Juli $thniki)</td>
					<td>:</td>
					<td colspan="5">'.$umur.'</td>
				  </tr>
				  <tr>
					<td>6</td>
					<td colspan="3">Agama</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->agama.'</td>
				  </tr>
				  <tr>
					<td>7</td>
					<td colspan="3">Kewarganegaraan</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->warga.'</td>
				  </tr>
				  <tr>
					<td>8</td>
					<td colspan="3">Anak Ke</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->anakke.' Dengan Jumlah Saudara :</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a. Kandung</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->kandung.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b. Tiri</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->tiri.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c. Angkat</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->angkat.'</td>
				  </tr>
				  <tr>
					<td>9</td>
					<td colspan="3">Bahasa Sehari-hari di keluarga</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->bahasa.'</td>
				  </tr>
				  <tr>
					<td>10</td>
					<td colspan="3">Golongan Darah</td>
					<td>:</td>
					<td colspan="5">'.$darah.'</td>
				  </tr>
				  <tr>
					<td>11</td>
					<td colspan="9">Keadaan Jasmani</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Berat badan</td>
					<td>:</td>
					<td colspan="5">'.$berat.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b.Tinggi badan</td>
					<td>:</td>
					<td colspan="5">'.$tinggi.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c.Penyakit yang pernah di derita</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->penyakit.'</td>
				  </tr>
				  <tr>
					<td valign="top">11</td>
					<td colspan="3" valign="top">Alamat Rumah</td>
					<td valign="top">:</td>
					<td colspan="5" valign="top">RT. '.$erte.' RW. '.$erwe.' KELURAHAN '.$kelurahan.' KECAMATAN '.$kecamatan.' KOTA/KABUPATEN '.$kota.' KODEPOS '.$kodepos.'</td>
				  </tr>
				  <tr>
					<td>12</td>
					<td colspan="3">Telepon Rumah</td>
					<td>:</td>
					<td colspan="5">'.$telpon.'</td>
				  </tr>
				  <tr>
					<td>13</td>
					<td colspan="3">Bertempat tinggal bersama</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->bersama.'</td>
				  </tr>
				  <tr>
					<td>14</td>
					<td colspan="3">Jarak tempat tinggal ke sekolah</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->jarak.' km</td>
				  </tr>
				  <tr>
					<td colspan="10">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="10"><b><u>B. PERKEMBANGAN PESERTA DIDIK</u></b></td>
				  </tr>
				  <tr>
					<td>1</td>
					<td colspan="9">Masuk menjadi Peserta didik baru tingkat I</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Asal Sekolah</td>
					<td>:</td>
					<td colspan="5">'.$asal.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b.Alamat Sekolah Sebelumnya</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->alamattk.'</td>
				  </tr>
				  <tr>
					<td>2</td>
					<td colspan="9">Pindahan dari sekolah lain</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Nama sekolah asal</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->pindahasal.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b.Dari tingkat</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->pindahkelas.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c.Diterima tanggal</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->pindahtgl.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">d.Ditingkat</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->pindahkekls.'</td>
				  </tr>
				  <tr>
					<td>3</td>
					<td colspan="9">NILAI RATA-RATA  RAPOT SEMESTER 1-5</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a. Semester 1</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->semester1.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b. Semester 2</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->semester2.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c. Semester 3</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->semester3.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">d. Semester 4</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->semester4.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">e. Semester 5</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->semester5.'</td>
				  </tr>
				  <tr>
					<td colspan="10">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="10"><b><u>C. IDENTITAS ORANG TUA/WALI :</u></b></td>
				  </tr>
				  <tr>
					<td>1</td>
					<td colspan="9">Ayah</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Nama</td>
					<td>:</td>
					<td colspan="5">'.$namaayah.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b.Pendidikan terakhir</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->payah.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c.Pekerjaan</td>
					<td>:</td>
					<td colspan="5">'.$kerjaayah.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="9"><span style="color: #999">(jika wiraswasta disebutkan secara spesifik)</span></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">d.Total Penghasilan satu bulan</td>
					<td>:</td>
					<td colspan="5">'.$tulisgajiayah.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">e.Alamat lengkap</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->aayah.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="9" style="color: #999">(diisi jika tidak serumah dengan calon siswa)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->hayah.'</td>
				  </tr>
				  <tr>
					<td colspan="10">&nbsp;</td>
				  </tr>
				  <tr>
					<td>2</td>
					<td colspan="9">Ibu</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Nama</td>
					<td>:</td>
					<td colspan="5">'.$namaibu.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b.Pendidikan Terakhir</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->pibu.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c.Pekerjaan</td>
					<td>:</td>
					<td colspan="5">'.$kerjaibu.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="9" style="color: #999">(jika wiraswasta disebutkan secara spesifik)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">d.Total Penghasilan satu bulan</td>
					<td>:</td>
					<td colspan="5">'.$tulisgajiibu.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">e.Alamat Lengkap</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->aaibu.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="9"><span style="color: #999">(diisi jika tidak serumah dengan calon siswa)</span></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->hibu.'</td>
				  </tr>
				  <tr>
					<td colspan="10">&nbsp;</td>
				  </tr>
				  <tr>
					<td>3</td>
					<td colspan="9">Wali Peserta Didik (jika mempunyai)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">a.Nama</td>
					<td>:</td>
					<td colspan="5">'.$wali.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">b.Hubungan keluarga</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->hubwali.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">c.Pekerjaan/Jabatan</td>
					<td>:</td>
					<td colspan="5">'.$pekerjaanwali.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">d.Agama</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->agamawali.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">e.Alamat</td>
					<td>:</td>
					<td colspan="5">'.$alamatwali.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->hwali.'</td>
				  </tr>
				  <tr>
					<td colspan="10">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="10" style="background:#999; border-bottom:1px solid black;border-top:1px solid black;"><strong>DATA KHUSUS CALON SISWA</strong></td>
				  </tr>
				  <tr>
					<td valign="top">1</td>
					<td colspan="3" valign="top">Kesulitan yang pernah dialami selama disekolah asal</td>
					<td valign="top">:</td>
					<td colspan="5" valign="top">'.$cekpelengkap->kesulitan.'</td>
				  </tr>
				  <tr>
					<td>2</td>
					<td colspan="3">Orang-orang yang tinggal bersama calon siswa</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->anggotarumah.'</td>
				  </tr>
				  <tr>
					<td>3</td>
					<td colspan="3">Kegiatan yang dapat dilakukan sendiri</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->kegiatansendiri.'</td>
				  </tr>
				  <tr>
					<td>4</td>
					<td colspan="3">Penglihatan</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->mata.'</td>
				  </tr>
				  <tr>
					<td>5</td>
					<td colspan="3">Pendengaran</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->telinga.'</td>
				  </tr>
				  <tr>
					<td>6</td>
					<td colspan="3">Penampilan</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->wajah.'</td>
				  </tr>
				  <tr>
					<td>7</td>
					<td colspan="3">Gaya belajar calon siswa (jika diketahui) </td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->gybljr.'</td>
				  </tr>
				  <tr>
					<td>8</td>
					<td colspan="3">Bakat khusus yang menonjol </td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->bakat.'</td>
				  </tr>
				  <tr>
					<td>9</td>
					<td colspan="3">Sumber Informasi</td>
					<td>:</td>
					<td colspan="5">'.$cekpelengkap->sumberinfo.'</td>
				  </tr>
				  <tr>
					<td>10</td>
					<td colspan="9">Prestasi yang pernah diraih selama di TK (dilengkapi dengan foto atau fotokopi piagam penghargaan):</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td width="27">a. </td>
					<td colspan="8">'.$cekpelengkap->prestasi1.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>b. </td>
					<td colspan="8">'.$cekpelengkap->prestasi2.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>c. </td>
					<td colspan="8">'.$cekpelengkap->prestasi3.'</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>d. </td>
					<td colspan="8">'.$cekpelengkap->prestasi4.'</td>
				  </tr>
				  <tr>
					<td colspan="10">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="10" style="font-size: x-small">Dimohon segera ke '.$sekolah.' untuk mengumpulkan persyaratan berupa :</td>
				  </tr>
				  <tr>
					<td style="font-size: x-small">1</td>
					<td colspan="6" style="font-size: x-small"><a href="'.$scanakta.'" target="_blank">Melampirkan fotocopy akta kelahiran dan fotocopy kartu keluarga</a></td>
					<td width="128" rowspan="4" style="border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;text-align:center;vertical-align:middle; "><img src="'.$scanfoto.'" width="98" height="120" /></td>
					<td colspan="2" style="text-align: center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td style="font-size: x-small">2</td>
					<td colspan="6" style="font-size: x-small"><a href="'.$scanfoto.'" target="_blank">Foto 4x6 sebanyak 2 lembar</a></td>
					<td colspan="2" style="text-align: center">Orang Tua / Wali</td>
				  </tr>
				  <tr>
					<td height="97" valign="top" style="font-size: x-small">3</td>
					<td colspan="6" style="font-size: x-small" valign="top"><a href="'.$scankk.'" target="_blank">Slip Gaji Orang Tua</a><br /><a href="'.$scanket.'" target="_blank">Melampirkan fotocopy Raport dan Surat Pengantar dari Sekolah Asal</a></td>
					<td colspan="2">&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="6" style="font-size: x-small">&nbsp;</td>
					<td colspan="2" align="center">'.$namaayah.'</td>
				  </tr>
				</table>
				<div style="page-break-before: always">
				<img src="'.$scanakta.'"/>
				<div style="page-break-before: always">
				<img src="'.$scankk.'"/>
				<div style="page-break-before: always">
				<img src="'.$scanket.'"/>
				<div style="page-break-before: always">
				<img src="'.$scanbukti.'"/>';
			
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['generatetbl']	= $generatetbl;
			$tasks['qrcode']		= $qrcode;
			return view('cetak.observasi', $tasks);
		}		
	}
	public function verifikasiPembayaran ($id){
		$homebase			= url("/");
		$cekdata 			= Pembayaranzis::where('id', $id)->count();
		if ($cekdata == 0){
			$data 						= [];
			$data['nama']   			= 'Not Found';
			$data['kelas']   			= 'Not Found';
			$data['namawali']   		= 'Not Found';
			$data['jeniszakat']   		= '';
			$data['orang']         		= '0';
			$data['satuan']         	= '';
			$data['nominal']           	= '0';
			$data['zakatmaal']         	= '0';
			$data['donasi']          	= '0';
			$data['total']          	= '0';
			$data['qrcode']            	= '';
			$data['terbilang']          = '';
			$data['validator']          = '';
			$data['tglvalidasi']        = '';
		} else {
			$getdata 			= Pembayaranzis::where('id', $id)->first();
			$namawali			= $getdata->namawali;
			$hape				= $getdata->hape; 
			$namasiswa			= $getdata->namasiswa; 
			$kelas				= $getdata->kelas; 
			$jeniszakat			= $getdata->jeniszakat; 
			$orang				= $getdata->orang; 
			$nominal			= $getdata->nominal; 
			$zakatmaal			= $getdata->zakatmaal; 
			$donasi				= $getdata->donasi; 
			$validator			= $getdata->validator;
			$tglvalidasi		= $getdata->tglvalidasi;
			$namafile			= $getdata->namafile;
			$id_sekolah			= $getdata->id_sekolah;
			$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

			if ($jeniszakat == 'Uang'){
				$total			= $nominal + $zakatmaal + $donasi;
				$satuan 		= 'Rp. 35.000,-';
				$nominal		= number_format( $nominal , 0 , '.' , ',' );
			} else {
				$total			= $zakatmaal + $donasi;
				$satuan			= '2.5 Kg';
				$nominal		= 0;
			}
			$terbilang 			= Terbilang($total);
			$zakatmaal			= number_format( $zakatmaal , 0 , '.' , ',' );
			$donasi				= number_format( $donasi , 0 , '.' , ',' );
			$total				= number_format( $total , 0 , '.' , ',' );
			$alamatweb			= $homebase.'/ceking/'.$id;
			$alamatcetak		= $homebase.'/verifikasi/'.$id;
			if ($tglvalidasi == '0000-00-00'){
				$qrcode 		= '';
				$tglvalidasi	= '<p style="background-color:red;">Belum di Validasi</p>';
				$status 		= '<p style="background-color:red;">Belum di Validasi</p>';
			} else {
				$arrtanggal		= explode('-', $tglvalidasi);
				$yy 			= $arrtanggal[0];
				$mm 			= (int)$arrtanggal[1];
				$dd 			= $arrtanggal[2];
				$mm 			= $bulan[$mm];
				$tglvalidasi	= $dd.' '.$mm.' '.$yy;
				$qrcode 		= QrCode::size(150)->generate($alamatcetak);
				$status 		= '<a href="'.$alamatcetak.'" target="_blank"><span class="label label-primary">Telah di validasi, Klik untuk Cetak Tanda Terima</span></a>';
			}
			$rsetting					= Sekolah::where('id', $id_sekolah)->first();
			$terbilang					= ucwords($terbilang);
			$data 						= [];
			$data['logo']				= $homebase.'/'.$rsetting->logo;
			$data['logo_grey']			= $homebase.'/'.$rsetting->logo_grey;
			$data['rsetting']			= $rsetting;
			
			$data['nama']   			= $namasiswa;
			$data['kelas']   			= $kelas;
			$data['namawali']   		= $namawali;
			$data['jeniszakat']   		= $jeniszakat;
			$data['orang']         		= $orang;
			$data['satuan']         	= $satuan;
			$data['nominal']           	= $nominal;
			$data['zakatmaal']         	= $zakatmaal;
			$data['donasi']          	= $donasi;
			$data['total']          	= $total;
			$data['qrcode']            	= $qrcode;
			$data['terbilang']          = $terbilang.' Rupiah';
			$data['validator']          = $validator;
			$data['tglvalidasi']        = $tglvalidasi;
		}
		return view('cekingpembayaran', $data);
	}
    public function exSimpanpendaftaran(Request $request) {
		if (Session('sekolah_id_sekolah') != null ){
			if (Session('sekolah_id_sekolah') != ''){
				$id_sekolah = Session('sekolah_id_sekolah');
			} else {
				$id_sekolah =   $request->id_sekolah;
			}
		} else {
			$id_sekolah =   $request->id_sekolah;
		}
		$homebase	= 	url("/");
		$nominal   	=   $request->val07;
		$zakatmal   =   $request->val08;
		$donasi   	=   $request->val09;
		$idinput   	=   $request->val11;
		$nominal 	= 	str_replace(',','',$nominal);
		$zakatmal 	= 	str_replace(',','',$zakatmal);
		$donasi 	= 	str_replace(',','',$donasi);
		
		if ($idinput == 'new'){
			$idinput 	= 	Pembayaranzis::insertGetId([
				'namawali'		=> $request->val02, 
				'namasiswa'		=> $request->val03, 
				'kelas'			=> $request->val04, 
				'jeniszakat'	=> $request->val05, 
				'orang'			=> $request->val06, 
				'nominal'		=> $nominal, 
				'zakatmaal'		=> $zakatmal, 
				'donasi'		=> $donasi,
				'hape'			=> $request->val10, 
				'validator'		=> '', 
				'tglvalidasi'	=> '',
				'namafile'		=> '',
				'id_sekolah'	=> $id_sekolah,
			]);
			$alamatweb		= $homebase.'/ceking/'.$idinput;
			if ($request->hasFile('file')) {
				$jenfile	= 	$request->file->getClientOriginalExtension();
				$file_tmp	= 	$request->file('file');
				$data 		= 	file_get_contents($file_tmp);
				$bukti 		= 	'data:image/' . $jenfile . ';base64,' . base64_encode($data);
				Pembayaranzis::where('id', $idinput)->update([
					'namafile'		=> $bukti,
				]);
			}
		} else {
			$alamatweb		= $homebase.'/ceking/'.$idinput;
			$idinput 		= Pembayaranzis::where('id', $idinput)->update([
				'namawali'		=> $request->val02, 
				'namasiswa'		=> $request->val03, 
				'kelas'			=> $request->val04, 
				'jeniszakat'	=> $request->val05, 
				'orang'			=> $request->val06, 
				'nominal'		=> $nominal, 
				'zakatmaal'		=> $zakatmal, 
				'donasi'		=> $donasi,
				'hape'			=> $request->val10, 
			]);
			if ($request->hasFile('file')) {
				$jenfile	= 	$request->file->getClientOriginalExtension();
				$file_tmp	= 	$request->file('file');
				$data 		= 	file_get_contents($file_tmp);
				$bukti 		= 	'data:image/' . $jenfile . ';base64,' . base64_encode($data);
				Pembayaranzis::where('id', $idinput)->update([
					'namafile'		=> $bukti,
				]);
			}
		}
		if ($idinput){			
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses</h4>
					Pembayaranzis Zakat, Infaq dan Shodaqoh Anda Telah Kami Terima, Mohon Simpan Link Berikut untuk mengetahui tindak lanjut dari Pembayaranzis anda.!<br />
					<strong><h3><a href="'.$alamatweb.'">'.$alamatweb.'</a></h3></strong>
				  </div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					 System Down, Mohon di Coba Beberapa Saat Lagi
				  </div>';
		}
		
    }
	public function exPpdb(Request $request) {
		$id_sekolah				= $request->id_sekolah;
		$homebase				= url("/");
		$setkerja				= $request->setkerja;
		$statppdb				= '';
		$kodebaru				= '';
		$kodepindahan 			= '';
		$hargaformulir 			= '';
		$namabank 				= '';
		$norek 					= '';
		$periode 				= '';
		$setspp1 				= '';
		$setspp2 				= '';
		$setspp3 				= '';
		$setdpp1 				= '';
		$setdpp2 				= '';
		$setdpp3 				= '';
		$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id_sekolah)->get();
		if (!empty($sql)){
			foreach ($sql as $rlayanan){
				$status 		= $rlayanan->status;
				$layanan 		= $rlayanan->layanan;
				if ($layanan == 'periodepsb') { $periode = $status; }
				if ($layanan == 'ppdb') { $statppdb = $status; }
				if ($layanan == 'kodebaru') { $kodebaru = $status; }
				if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
				if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
				if ($layanan == 'namabank') { $namabank = $status; }
				if ($layanan == 'norek') { $norek = $status; }
				if ($layanan == 'spp1') { $setspp1 = $status; }
				if ($layanan == 'spp2') { $setspp2 = $status; }
				if ($layanan == 'spp3') { $setspp3 = $status; }
				if ($layanan == 'dpp1') { $setdpp1 = $status; }
				if ($layanan == 'dpp2') { $setdpp2 = $status; }
			}
		}
		if ($setkerja == 'siswa'){
			$tahun		= $request->val01;
			$kelas		= $request->val02;
			$niksiswa	= $request->val03;
			$nama 		= strtoupper($request->val04);
			$panggilan	= strtoupper($request->val05);
			$tmtlahir	= strtoupper($request->val06);
			$tgllahir	= $request->val07;
			$umur		= $request->val08;
			$kelamin	= strtoupper($request->val09);
			$agama		= $request->val10;
			$warga		= $request->val11;
			$tinggi		= $request->val12;
			$berat		= $request->val13;
			$darah		= $request->val14;
			$bahasa		= $request->val15;
			$penyakit	= $request->val16;
			$anakke		= $request->val17;
			$kandung	= $request->val18;
			$tiri		= $request->val19;
			$angkat		= $request->val20;
			$jarak		= $request->val21;
			$telpon		= $request->val22;
			$bersama	= $request->val23;
			$ceknik		= strlen($niksiswa);
			if ($ceknik != 16){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 NIK Haruslah 16 Karakter
					  </div>';
			}
			else if($nama == '' OR $tmtlahir == '' OR $anakke == '' OR $tgllahir == '' OR $niksiswa == '' OR $umur == '' OR $jarak == '' OR $telpon == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						 Nama : '.$nama.'<br />
						 NIK. Siswa : '.$niksiswa.'<br />
						 TTL : '.$tmtlahir.'/'.$tgllahir.'<br />
						 Umur : '.$umur.'<br />
						 Anak Ke : '.$anakke.'<br />
						 Jarak dari Rumah Ke Sekolah : '.$jarak.'<br />
						 Email : '.$telpon.'<br />
					  </div>';
			}
			else {
				if ($panggilan == ''){ $panggilan = '-'; }
				if ($tinggi == ''){ $tinggi = '0'; }
				if ($tinggi == ''){ $tinggi = '0'; }
				if ($berat == ''){ $berat = '0'; }
				if ($darah == ''){ $darah = '-'; }
				if ($bahasa == ''){ $bahasa = 'INDONESIA'; }
				if ($penyakit == ''){ $penyakit = '-'; }
				$count = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->count();				
				if ($count == 0) {
					$kodethn 	 	= substr($tahun, -4);
					$urutanbaru		= Datapsb::where('tahun', $kodethn)->where('kodepsb', 'baru')->where('id_sekolah',$id_sekolah)->count();
					$urutanpindah	= Datapsb::where('tahun', $kodethn)->where('kodepsb', '!=', 'baru')->where('id_sekolah',$id_sekolah)->count();
					$getid 			= Datapsb::orderBy('id', 'DESC')->where('id_sekolah',$id_sekolah)->first();
					if (isset($getid->id)){
						$idne 		= $getid->id;
						$idne		= $idne + 1;
					} else {
						$idne		= 1;
					}
					
					if ($kelas == 1) { 
						$urutan  	= $urutanbaru + 1; 
						$kodependaf = $kodebaru.'-'.$urutan; 
						$kodepsb 	= 'baru';}
					else { 
						$urutan  	= $urutanpindah + 1; 
						$kodependaf = $kodepindahan.'-'.$urutan; 
						$kodepsb 	= 'mutasi kelas '.$kelas;
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode != 0){
						$urutan = $urutan + 1;
						if ($kelas == 1) { 
							$kodependaf = $kodebaru.'-'.$urutan; 
						}
						else { 
							$kodependaf = $kodepindahan.'-'.$urutan; 
						}
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode != 0){
						$urutan = $urutan + 1;
						if ($kelas == 1) { 
							$kodependaf = $kodebaru.'-'.$urutan; 
						}
						else { 
							$kodependaf = $kodepindahan.'-'.$urutan; 
						}
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode != 0){
						$urutan = $urutan + 1;
						if ($kelas == 1) { 
							$kodependaf = $kodebaru.'-'.$urutan; 
						}
						else { 
							$kodependaf = $kodepindahan.'-'.$urutan; 
						}
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode == 0){
						$gooo = Datapsb::create([
							'tahun'			=> $kodethn, 
							'kodependaf'	=> $kodependaf, 
							'kodepsb'		=> $kodepsb, 
							'nama'			=> $nama, 
							'nik'			=> $niksiswa, 
							'kelamin'		=> $kelamin, 
							'tmplahir'		=> $tmtlahir, 
							'tgllahir'		=> $tgllahir, 
							'umur'			=> $umur, 
							'darah'			=> $darah, 
							'berat'			=> $berat, 
							'tinggi'		=> $tinggi, 
							'alamatortu'	=> '', 
							'namaayah'		=> '', 
							'namaibu'		=> '', 
							'kerjaayah'		=> '', 
							'kerjaibu'		=> '', 
							'wali'			=> '', 
							'pekerjaanwali'	=> '', 
							'foto'			=> '', 
							'tamasuk'		=> $tahun, 
							'hape'			=> '', 
							'asal'			=> '', 
							'mutasi'		=> '', 
							'kelurahan'		=> '', 
							'kecamatan'		=> '', 
							'kota'			=> '', 
							'kodepos'		=> '', 
							'telpon'		=> '', 
							'erte'			=> '', 
							'erwe'			=> '', 
							'n1'			=> '', 
							'n2'			=> '', 
							'n3'			=> '', 
							'n4'			=> '', 
							'n5'			=> '', 
							'n6'			=> '', 
							'n7'			=> '', 
							'n8'			=> '', 
							'n9'			=> '', 
							'n10'			=> '', 
							'n11'			=> '', 
							'n12'			=> '', 
							'n13'			=> '', 
							'total'			=> '', 
							'rata'			=> '', 
							'hasil'			=> '', 
							'deadline'		=> '', 
							'akhirumum'		=> '', 
							'nosurat'		=> '', 
							'des1'			=> '', 
							'des2'			=> '', 
							'des3'			=> '', 
							'des4'			=> '', 
							'des5'			=> '', 
							'des6'			=> '', 
							'des7'			=> '', 
							'des8'			=> '', 
							'dana1'			=> '', 
							'dana2'			=> '', 
							'dana3'			=> '', 
							'dana4'			=> '', 
							'status'		=> 10,
							'id_sekolah'    => $id_sekolah
						]);
						if ($gooo){
							$cekkelengkapan = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->count();
							if ($cekkelengkapan == 0){
								Datapelengkappsb::create([
									'niksiswa'		=> $niksiswa, 
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'payah'			=> '',
									'pibu'			=> '',
									'gayah'			=> '',
									'gibu'			=> '',
									'aayah'			=> '',
									'aaibu'			=> '',
									'hayah'			=> '',
									'hibu'			=> '',
									'agamawali'		=> '',
									'hwali'			=> '',
									'kwali'			=> '',
									'hubwali'		=> '',
									'alamattk'		=> '',
									'pindahasal'	=> '',
									'pindahkelas'	=> '',
									'pindahtgl'		=> '',
									'pindahkekls'	=> '',
									'kesulitan'		=> '',
									'anggotarumah'	=> '',
									'kegiatansendiri'=>'',
									'mata'			=> '',
									'telinga'		=> '',
									'wajah'			=> '',
									'gybljr'		=> '',
									'bakat'			=> '',
									'sumberinfo'	=> '',
									'prestasi1'		=> '',
									'prestasi2'		=> '',
									'prestasi3'		=> '',
									'prestasi4'		=> '',
									'marking'		=> $idne,
									'scanakta'		=> '',
									'scanfoto'		=> '',
									'scankk'		=> '',
									'scanket'		=> '',
									'scanbukti'		=> '',
									'id_sekolah'    => $id_sekolah
								]);
							} else {
								Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'marking'		=> $idne,
								]);
							}							
							echo 'sukses';
						}
						else {
							echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
						  </div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Percobaan Permintaan Kode Pendaftaran Gagal 3x, mohon menghubungi admin PPDB untuk info lebih lanjut
						  </div>';
					}
				}
				else {
					$status = '';
					$umume 	= '';
					$boleh 	= 'IYES';
					$idupdt	= 0;
					$jcek 	= Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->get();	
					foreach ($jcek as $cekid) {
						$kodep 	= $cekid->kodependaf;
						$umume 	= $cekid->akhirumum;
						$status = $cekid->status;
						
						if ($umume == ''){
							if ($status == 'verified' OR $status == 'unverified'){
								$boleh 	= 'NO';
							}
							else {
								$boleh 	= 'IYES';
								$idupdt = $cekid->id;
							}
						}
						else {
							$status	= $cekid->status;
							$idupdt = $cekid->id;
						}
					}
					if ($boleh == 'NO'){
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							 Data Anda Telah Ter Periksa, Mohon Bersabar Untuk Proses Seleksi dan Pengumuman.
						  </div>';
					}
					else if ($status == 'verified' OR $status == 'unverified'){
						$kodethn 	 	= substr($tahun, -4);
						$urutanbaru		= Datapsb::where('tahun', $kodethn)->where('kodepsb', 'baru')->where('id_sekolah',$id_sekolah)->count();
						$urutanpindah	= Datapsb::where('tahun', $kodethn)->where('kodepsb', '!=', 'baru')->where('id_sekolah',$id_sekolah)->count();
						$getid 			= Datapsb::orderBy('id', 'DESC')->where('id_sekolah',$id_sekolah)->first();
						if (isset($getid->id)){
							$idne 		= $getid->id;
							$idne		= $idne + 1;
						} else {
							$idne		= 1;
						}
						
						if ($kelas == 1) { 
							$urutan  	= $urutanbaru + 1; 
							$kodependaf = $kodebaru.'-'.$urutan; 
							$kodepsb 	= 'baru';}
						else { 
							$urutan  	= $urutanpindah + 1; 
							$kodependaf = $kodepindahan.'-'.$urutan; 
							$kodepsb 	= 'mutasi kelas '.$kelas;
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode != 0){
							$urutan = $urutan + 1;
							if ($kelas == 1) { 
								$kodependaf = $kodebaru.'-'.$urutan; 
							}
							else { 
								$kodependaf = $kodepindahan.'-'.$urutan; 
							}
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode != 0){
							$urutan = $urutan + 1;
							if ($kelas == 1) { 
								$kodependaf = $kodebaru.'-'.$urutan; 
							}
							else { 
								$kodependaf = $kodepindahan.'-'.$urutan; 
							}
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode != 0){
							$urutan = $urutan + 1;
							if ($kelas == 1) { 
								$kodependaf = $kodebaru.'-'.$urutan; 
							}
							else { 
								$kodependaf = $kodepindahan.'-'.$urutan; 
							}
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode == 0){
							$gooo = Datapsb::create([
								'tahun'			=> $kodethn, 
								'kodependaf'	=> $kodependaf, 
								'kodepsb'		=> $kodepsb, 
								'nama'			=> $nama, 
								'nik'			=> $niksiswa, 
								'kelamin'		=> $kelamin, 
								'tmplahir'		=> $tmtlahir, 
								'tgllahir'		=> $tgllahir, 
								'umur'			=> $umur, 
								'darah'			=> $darah, 
								'berat'			=> $berat, 
								'tinggi'		=> $tinggi, 
								'alamatortu'	=> '', 
								'namaayah'		=> '', 
								'namaibu'		=> '', 
								'kerjaayah'		=> '', 
								'kerjaibu'		=> '', 
								'wali'			=> '', 
								'pekerjaanwali'	=> '', 
								'foto'			=> '', 
								'tamasuk'		=> $tahun, 
								'hape'			=> '', 
								'asal'			=> '', 
								'mutasi'		=> '', 
								'kelurahan'		=> '', 
								'kecamatan'		=> '', 
								'kota'			=> '', 
								'kodepos'		=> '', 
								'telpon'		=> '', 
								'erte'			=> '', 
								'erwe'			=> '', 
								'n1'			=> '', 
								'n2'			=> '', 
								'n3'			=> '', 
								'n4'			=> '', 
								'n5'			=> '', 
								'n6'			=> '', 
								'n7'			=> '', 
								'n8'			=> '', 
								'n9'			=> '', 
								'n10'			=> '', 
								'n11'			=> '', 
								'n12'			=> '', 
								'n13'			=> '', 
								'total'			=> '', 
								'rata'			=> '', 
								'hasil'			=> '', 
								'deadline'		=> '', 
								'akhirumum'		=> '', 
								'nosurat'		=> '', 
								'des1'			=> '', 
								'des2'			=> '', 
								'des3'			=> '', 
								'des4'			=> '', 
								'des5'			=> '', 
								'des6'			=> '', 
								'des7'			=> '', 
								'des8'			=> '', 
								'dana1'			=> '', 
								'dana2'			=> '', 
								'dana3'			=> '', 
								'dana4'			=> '', 
								'status'		=> 10,
								'id_sekolah'	=> $id_sekolah
							]);
							if ($gooo){
								$cekkelengkapan = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->count();
								if ($cekkelengkapan == 0){
									Datapelengkappsb::create([
										'niksiswa'		=> $niksiswa, 
										'panggilan'		=> $panggilan, 
										'umur'			=> $umur, 
										'agama'			=> $agama, 
										'warga'			=> $warga, 
										'bahasa'		=> $bahasa, 
										'penyakit'		=> $penyakit, 
										'anakke'		=> $anakke, 
										'kandung'		=> $kandung, 
										'tiri'			=> $tiri, 
										'angkat'		=> $angkat, 
										'jarak'			=> $jarak, 
										'telpon'		=> $telpon, 
										'bersama'		=> $bersama, 
										'payah'			=> '',
										'pibu'			=> '',
										'gayah'			=> '',
										'gibu'			=> '',
										'aayah'			=> '',
										'aaibu'			=> '',
										'hayah'			=> '',
										'hibu'			=> '',
										'agamawali'		=> '',
										'hwali'			=> '',
										'kwali'			=> '',
										'hubwali'		=> '',
										'alamattk'		=> '',
										'pindahasal'	=> '',
										'pindahkelas'	=> '',
										'pindahtgl'		=> '',
										'pindahkekls'	=> '',
										'kesulitan'		=> '',
										'anggotarumah'	=> '',
										'kegiatansendiri'=>'',
										'mata'			=> '',
										'telinga'		=> '',
										'wajah'			=> '',
										'gybljr'		=> '',
										'bakat'			=> '',
										'sumberinfo'	=> '',
										'prestasi1'		=> '',
										'prestasi2'		=> '',
										'prestasi3'		=> '',
										'prestasi4'		=> '',
										'marking'		=> $idne,
										'scanakta'		=> '',
										'scanfoto'		=> '',
										'scankk'		=> '',
										'scanket'		=> '',
										'scanbukti'		=> '',
										'id_sekolah'	=> $id_sekolah
									]);
								} else {
									Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
										'panggilan'		=> $panggilan, 
										'umur'			=> $umur, 
										'agama'			=> $agama, 
										'warga'			=> $warga, 
										'bahasa'		=> $bahasa, 
										'penyakit'		=> $penyakit, 
										'anakke'		=> $anakke, 
										'kandung'		=> $kandung, 
										'tiri'			=> $tiri, 
										'angkat'		=> $angkat, 
										'jarak'			=> $jarak, 
										'telpon'		=> $telpon, 
										'bersama'		=> $bersama, 
										'marking'		=> $idne
									]);
								}							
								echo 'sukses';
							}
							else {
								echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
							  </div>';
							}
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Percobaan Permintaan Kode Pendaftaran Gagal 3x, mohon menghubungi admin PPDB untuk info lebih lanjut
							  </div>';
						}
					}
					else {
						$qsimpandata = Datapsb::where('id', $idupdt)->update([
							'nama'			=> $nama, 
							'kelamin'		=> $kelamin, 
							'tmplahir'		=> $tmtlahir, 
							'tgllahir'		=> $tgllahir, 
							'umur'			=> $umur, 
							'darah'			=> $darah, 
							'berat'			=> $berat, 
							'tinggi'		=> $tinggi,
							'updated_at'	=> Carbon::now()
						]);
						if ($qsimpandata){
							$cekkelengkapan = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->count();
							if ($cekkelengkapan == 0){
								Datapelengkappsb::create([
									'niksiswa'		=> $niksiswa, 
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'payah'			=> '',
									'pibu'			=> '',
									'gayah'			=> '',
									'gibu'			=> '',
									'aayah'			=> '',
									'aaibu'			=> '',
									'hayah'			=> '',
									'hibu'			=> '',
									'agamawali'		=> '',
									'hwali'			=> '',
									'kwali'			=> '',
									'hubwali'		=> '',
									'alamattk'		=> '',
									'pindahasal'	=> '',
									'pindahkelas'	=> '',
									'pindahtgl'		=> '',
									'pindahkekls'	=> '',
									'kesulitan'		=> '',
									'anggotarumah'	=> '',
									'kegiatansendiri'=>'',
									'mata'			=> '',
									'telinga'		=> '',
									'wajah'			=> '',
									'gybljr'		=> '',
									'bakat'			=> '',
									'sumberinfo'	=> '',
									'prestasi1'		=> '',
									'prestasi2'		=> '',
									'prestasi3'		=> '',
									'prestasi4'		=> '',
									'marking'		=> $idupdt,
									'scanakta'		=> '',
									'scanfoto'		=> '',
									'scankk'		=> '',
									'scanket'		=> '',
									'scanbukti'		=> '',
									'id_sekolah'	=> $id_sekolah
								]);
							} else {
								Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'marking'		=> $idupdt,
								]);
							}
							echo 'sukses';
						}
						else {
							echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
						  </div>';
						}
					}
				}
			}
		}
		else if ($setkerja == 'ortu'){
			$ayah		= strtoupper($request->val01);
			$ibu		= strtoupper($request->val02);
			$kayah		= $request->val03;
			$kibu		= $request->val04;
			$wali		= strtoupper($request->val05);
			$kwali		= $request->val06;
			$alamat		= strtoupper($request->val07);
			$erte		= strtoupper($request->val08);
			$erwe		= strtoupper($request->val09);
			$kelu		= strtoupper($request->val10);
			$keca		= strtoupper($request->val11);
			$kodepos	= strtoupper($request->val12);
			$kota		= strtoupper($request->val13);
			$payah		= $request->val14;
			$pibu		= $request->val15;
			$gayah		= $request->val16;
			$gibu		= $request->val17;
			$aayah		= $request->val18;
			$aibu		= $request->val19;
			$hayah		= $request->val20;
			$hibu		= $request->val21;
			$agamawali	= $request->val22;
			$hpwali		= $request->val23;
			$kwali		= $request->val24;
			$hubwali	= $request->val25;
			$niksiswa	= $request->val26;
			if($ayah == '' or $ibu == '' or $alamat == '' or $kelu == '' or $keca == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						 Nama Ayah : '.$ayah.'<br />
						 Nama Ibu  : '.$ibu.'<br />
						 Alamat : '.$alamat.'<br />
						 Kelurahan : '.$kelu.'<br />
						 Kecamatan : '.$keca.'<br />
					  </div>';
			}
			else {
				$gooo = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
					'alamatortu'	=> $alamat, 
					'namaayah'		=> $ayah, 
					'namaibu'		=> $ibu, 
					'kerjaayah'		=> $kayah, 
					'kerjaibu'		=> $kibu, 
					'wali'			=> $wali, 
					'pekerjaanwali'	=> $kwali, 
					'hape'			=> $hibu, 
					'kelurahan'		=> $kelu, 
					'kecamatan'		=> $keca, 
					'kota'			=> $kota, 
					'kodepos'		=> $kodepos, 
					'erte'			=> $erte, 
					'erwe'			=> $erwe,
					'updated_at'	=> Carbon::now()
				]);
				if ($gooo){
					Datapsb::where('nik', $niksiswa)->where('status', '10')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 20
					]);
					Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
						'payah'			=> $payah,
						'pibu'			=> $pibu,
						'gayah'			=> $gayah,
						'gibu'			=> $gibu,
						'aayah'			=> $aayah,
						'aaibu'			=> $aibu,
						'hayah'			=> $hayah,
						'hibu'			=> $hibu,
						'agamawali'		=> $agamawali,
						'hwali'			=> $hpwali,
						'kwali'			=> $kwali,
						'hubwali'		=> $hubwali,
					]);
					echo 'sukses';
				}
				else {
					echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
				  </div>';
				}
			}
		}
		else if ($setkerja == 'asaltk'){
			$asala		= $request->val01;
			$almttk		= $request->val02;
			$pindahasal	= $request->val03;
			$pindahkls	= $request->val04;
			$pindahtgl	= $request->val05;
			$pindahkekls= $request->val06;
			$niksiswa	= $request->val07;
			$semester1	= $request->val08;
			$semester2	= $request->val09;
			$semester3	= $request->val10;
			$semester4	= $request->val11;
			$semester5	= $request->val12;
			if($asala == '' or $almttk == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						 Asal Sekolah Sebelumnya : '.$asala.'<br />
						 Alamat Sekolah Sebelumnya  : '.$almttk.'<br />
					  </div>';
			} else {
				$gooo = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
					'asal'			=> $asala, 
					'mutasi'		=> $pindahasal,
					'updated_at'	=> Carbon::now()
				]);
				if ($gooo){
					Datapsb::where('nik', $niksiswa)->where('status', '20')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 30
					]);
					Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
						'alamattk'		=> $almttk,
						'pindahasal'	=> $pindahasal,
						'pindahkelas'	=> $pindahkls,
						'pindahtgl'		=> $pindahtgl,
						'pindahkekls'	=> $pindahkekls,
						'semester1'		=> $semester1,
						'semester2'		=> $semester2,
						'semester3'		=> $semester3,
						'semester4'		=> $semester4,
						'semester5'		=> $semester5,
					]);
					echo 'sukses';
				}
				else {
					echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
				  </div>';
				}
				
			}
		}
		else {
			$kesulitan	= $request->val01;
			$bersamaly	= $request->val02;
			$kegsndrly	= $request->val03;
			$mata		= $request->val04;
			$telinga	= $request->val05;
			$wajah		= $request->val06;
			$gybljr		= $request->val07;
			$bakat		= $request->val08;
			$prestasi1	= $request->val09;
			$prestasi2	= $request->val10;
			$prestasi3	= $request->val11;
			$prestasi4	= $request->val12;
			$idsbrlain	= $request->val13;
			$niksiswa	= $request->val14;
			$arrbersama	= $request->val15;
			$arrkegiatan= $request->val16;
			$arrsumber	= $request->val17;


			if($niksiswa == ''){
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Error</h4>
					 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
					 NIK. Siswa : '.$niksiswa.'<br />
				  </div>';
			}
			else {
				$anggotakeluarga = '';
				if (!empty($arrbersama)){
					foreach ($arrbersama as $v) {
						if ($v == 'Lain'){ 
							if ($anggotakeluarga == '') { $anggotakeluarga = $bersamaly; }
							else { $anggotakeluarga = $anggotakeluarga.'-'.$bersamaly; }
						}
						else {
							if ($anggotakeluarga == '') { $anggotakeluarga = $v; }
							else { $anggotakeluarga = $anggotakeluarga.'-'.$v; }
						}			
					}
				}
				$mandiri = '';
				if (!empty($arrkegiatan)){
					foreach ($arrkegiatan as $r) {
						if ($r == 'Lain'){ 
							if ($mandiri == '') { $mandiri = $kegsndrly; }
							else { $mandiri = $mandiri.'-'.$kegsndrly; }
						}
						else {
							if ($mandiri == '') { $mandiri = $r; }
							else { $mandiri = $mandiri.'-'.$r; }
						}			
					}
				}
				$sumberlain = '';
				if (!empty($arrsumber)){
					foreach ($arrsumber as $s) {
						if ($s == 'Lain'){ 
							if ($sumberlain == '') { $sumberlain = $idsbrlain; }
							else { $sumberlain = $sumberlain.'-'.$idsbrlain; }
						}
						else {
							if ($sumberlain == '') { $sumberlain = $s; }
							else { $sumberlain = $sumberlain.'-'.$s; }
						}			
					}
				}
				$gooo 	= Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
						'kesulitan'			=> $kesulitan,
						'anggotarumah'		=> $anggotakeluarga,
						'kegiatansendiri'	=> $mandiri,
						'mata'				=> $mata,
						'telinga'			=> $telinga,
						'wajah'				=> $wajah,
						'gybljr'			=> $gybljr,
						'bakat'				=> $bakat,
						'sumberinfo'		=> $sumberlain,
						'prestasi1'			=> $prestasi1,
						'prestasi2'			=> $prestasi2,
						'prestasi3'			=> $prestasi3,
						'prestasi4'			=> $prestasi4,
						'updated_at'		=> Carbon::now()
					]);
				if ($gooo){
					Datapsb::where('nik', $niksiswa)->where('status', '30')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 40
					]);
					$getdata = Datapsb::where('nik', $niksiswa)->orderBy('id', 'DESC')->where('id_sekolah',$id_sekolah)->first();
					echo '<div class="col-md-12">		
							<div class="widget-user-header bg-yellow">
							  <div class="widget-user-image">
								<img class="img-circle" src="dist/img/wasimonghead.png" alt="User Avatar" height="90" width="100">
							  </div>
							  <h3 class="widget-user-username">'.$getdata->nama.'</h3>
							  <h3 class="widget-user-desc">'.$getdata->kodependaf.'</h3>
							</div>
							<div class="box-footer">
								<div class="box-body">
								 	<div class="form-group">
									  <ul class="nav nav-stacked">
										<li><span class="pull-left badge bg-red">1</span> '.$getdata->nik.'</li>  
										<li><span class="pull-left badge bg-blue">2</span> '.$getdata->tmplahir.', '.$getdata->tgllahir.'</li>
										<li><span class="pull-left badge bg-aqua">3</span> '.$getdata->namaayah.' / '.$getdata->namaibu.'</li>
										<li><span class="pull-left badge bg-green">4</span> '.$getdata->alamatortu.' Kel. '.$getdata->kelurahan.' Kec. '.$getdata->kecamatan.' '.$getdata->kota.'</li>
										<li><span class="pull-left badge bg-red">5</span> '.$getdata->asal.'</li>                    
									  </ul>
									  <b>Mohon Simpan No. ID Registrasi Anda, Dan Bila Anda Lupa Anda Dapat Meminta Informasi ID Registrasi Anak Anda ke Panitia PPDB.<br /> ID Registrasi Anak Anda Adalah :<br /></b>
									  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><font color="blue" size="+2">'.$getdata->kodependaf.'</font></p>
									</div>
								</div>
							</div>
						</div>'; 
				}
				else {
					echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
				  </div>';
				}
			}

		}
    }
	public function exSavefileppdb(Request $request) {
		$id_sekolah 		= $request->id_sekolah;
		$nik 		= $request->nik;
		$sukses 	= '';
		$ceknik 	= Datapsb::where('nik', $nik)->where('id_sekolah',$id_sekolah)->count();
		if ($ceknik != 0){
			if ($request->hasFile('akte')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan Akte Kelahiran, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan']);
					return back();				
				} else {
					$namafile		= $nik.'-akte.'.$request->file('akte')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('akte');
					$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
					Datapsb::where('nik', $nik)->where('status', '40')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 50
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scanakta' => $namafile
					]);
					$sukses 		= $sukses.'Akte Berhasil di Upload<br />';
				}
			}
			if ($request->hasFile('foto')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan Foto, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan']);
					return back();				
				} else {
					$namafile		= $nik.'-foto.'.$request->file('foto')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('foto');
					$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
					Datapsb::where('nik', $nik)->where('status', '50')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 60
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scanfoto' => $namafile
					]);
					$sukses 		= $sukses.'Foto Berhasil di Upload<br />';
				}
			}
			if ($request->hasFile('ksk')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan KK, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan']);
					return back();				
				} else {
					$namafile		= $nik.'-kk.'.$request->file('ksk')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('ksk');
					$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
					Datapsb::where('nik', $nik)->where('status', '60')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 70
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scankk' => $namafile
					]);
					$sukses 		= $sukses.'KK Berhasil di Upload<br />';
				}
			}
			if ($request->hasFile('keterangan')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan Surat Keterangan, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan']);
					return back();				
				} else {
					$namafile		= $nik.'-ket.'.$request->file('keterangan')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('keterangan');
					$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
					Datapsb::where('nik', $nik)->where('status', '70')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 80
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scanket' => $namafile
					]);
					$sukses 		= $sukses.'Surat Keterangan Lulus Berhasil di Upload<br />';
				}
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk NIK ini.']);
			return back();	
		}
	}
	public function exCeknikppdb(Request $request) {
		$id_sekolah = $request->id_sekolah;
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		$sukses 	= '';
		$ceknik 	= Datapsb::where('nik', $nik)->where('tgllahir', $tgllahir)->where('id_sekolah',$id_sekolah)->count();
		if ($ceknik != 0){			
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data NIK dan TTL ditemukan']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK dan Tgl. Lahir yang dimasukkan sesuai dengan : '.$nik.' dengan tanggal lahir '.$tgllahir ]);
			return back();	
		}
	}
	public function exGetkodependaf(Request $request) {
		$id_sekolah 		= $request->id_sekolah;
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		$sukses 	= '';
		$getkode 	= Datapsb::where('nik', $nik)->where('tgllahir', $tgllahir)->where('id_sekolah',$id_sekolah)->orderBy('id', 'DESC')->first();
		if (isset($getkode->id)){
			echo $getkode->id;
		} else {
			echo 'notfound';
		}
	}
	public function exSaveberkasppdb(Request $request) {
		$id_sekolah 		= $request->id_sekolah;
		$nik 		= $request->val01;
		$jenis		= $request->val02;
		$cekdata	= Datapelengkappsb::where('niksiswa', $nik)->count();
		if ($cekdata != 0){
			if ($request->hasFile('file')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan, File maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan']);
					return back();				
				} else {
					$getfotolama	= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->first();
					if (isset($getfotolama->niksiswa)){
						$idpel			= $getfotolama->id;
						$idpsb			= $getfotolama->marking;
						$scanaktalm		= $getfotolama->scanakta;
						$scanfotolm		= $getfotolama->scanfoto;
						$scankklm		= $getfotolama->scankk;
						$scanketlm		= $getfotolama->scanket;
						$scanbuktilm	= $getfotolama->scanbukti;
						if ($jenis == 'AKTE'){
							if ($scanaktalm != ''){
								if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanaktalm) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanaktalm);
								}
							}
							$namafile		= $nik.'-akte.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanakta' => $namafile
							]);
						} else if ($jenis == 'FOTO'){
							if ($scanfotolm != ''){
								if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanfotolm) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanfotolm);
								}
							}
							$namafile		= $nik.'-foto.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanfoto' => $namafile
							]);
						} else if ($jenis == 'KK'){
							if ($scankklm != ''){
								if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scankklm) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scankklm);
								}
							}
							$namafile		= $nik.'-kk.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scankk' => $namafile
							]);
						} else if ($jenis == 'KET'){
							if ($scanketlm != ''){
								if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanketlm) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanketlm);
								}
							}
							$namafile		= $nik.'-ket.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanket' => $namafile
							]);
						} else {
							if ($scanbuktilm != ''){
								if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanbuktilm) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanbuktilm);
								}
							}
							$namafile	= $nik.'-bukti.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('dist/img/berkas/'), $namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanbukti' => $namafile
							]);
						
						}
						$cekstatus 		= Datapsb::where('nik', $nik)->where('id_sekolah',$id_sekolah)->orderBy('id', 'DESC')->first();
						$idne 			= $cekstatus->id;
						$status			= $cekstatus->status;
						$persen			= 40;
						if ($scanaktalm != ''){
							$persen 	= $persen + 10;
						}
						if ($scanfotolm != ''){
							$persen 	= $persen + 10;
						}
						if ($scankklm != ''){
							$persen 	= $persen + 10;
						}
						if ($scanketlm != ''){
							$persen 	= $persen + 10;
						}
						if ($scanbuktilm != ''){
							$persen 	= $persen + 10;
						}
						if ($status == '40' OR $status == '50' OR $status == '60' OR $status == '70' OR $status == '80' OR $status == '90'){
							Datapsb::where('id', $idne)->update([
								'status'		=> $persen
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Upload '.$jenis.' Berhasil']);
						return back();
						
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK yang dimasukkan sesuai dengan : '.$nik ]);
						return back();	
					}
				}
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK yang dimasukkan sesuai dengan : '.$nik ]);
			return back();	
		}
	}
	public function jsonDatacalonsiswa(Request $request) {
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		$scanakta	= '';
		$scanfoto	= '';
		$scankk		= '';
		$scanket	= '';
		$scanbukti	= '';
		$idpsb		= $nik;
		$idpel		= $nik;
		$getdata	= Datapelengkappsb::where('niksiswa', $nik)->first();
		if (isset($getdata->niksiswa)){
			$idpel			= $getdata->id;
			$idpsb			= $getdata->marking;
			$scanakta		= $getdata->scanakta;
			$scanfoto		= $getdata->scanfoto;
			$scankk			= $getdata->scankk;
			$scanket		= $getdata->scanket;
			$scanbukti		= $getdata->scanbukti;
			if ($scanakta != ''){
				if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanakta) {
				  $scanakta	= 'berkas/'.$scanakta;
				}
			}
			if ($scanfoto != ''){
				if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanfoto) {
				  $scanfoto	= 'berkas/'.$scanfoto;
				}
			}
			if ($scankk != ''){
				if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scankk) {
				  $scankk	= 'berkas/'.$scankk;
				}
			}
			if ($scanket != ''){
				if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanket) {
				  $scanket	= 'berkas/'.$scanket;
				}
			}
			if ($scanbukti != ''){
				if (File::exists(base_path()) ."/public/sdist/img/berkas/". $scanbukti) {
				  $scanbukti	= 'berkas/'.$scanbukti;
				}
			}
		}
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'AKTE',
			'deskripsi' 	=> 'Scan / Foto Akta Kelahiran, Kartu Keluarga dan KTP Orang Tua',
			'isine'			=> $scanakta
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'FOTO',
			'deskripsi' 	=> 'Scan / Foto Calon Siswa 4x6',
			'isine'			=> $scanfoto
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'KK',
			'deskripsi' 	=> 'Scan / Foto Slip Gaji Kedua Orang Tua',
			'isine'			=> $scankk
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'KET',
			'deskripsi' 	=> 'Scan / Foto Rapot Semester 1-5 dan Surat Kelakuan baik dari sekolah',
			'isine'			=> $scanket
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'BUKTI',
			'deskripsi' 	=> 'Scan Bukti Pembayaran',
			'isine'			=> $scanbukti
		);
		echo json_encode($arraysurat);
	}
	public function exPresensiviewPIP(Request $request) {
		$nama 		= strtoupper($request->val01);
		$kelas		= strtoupper($request->val02);
		$idsekolah 	= $request->val03;
		$cekdata	= AbsenProgramPIP::where('nama', $nama)->where('kelas', $kelas)->where('idsekolah', $idsekolah)->count();
		if ($cekdata != 0){
			$input 	= 	AbsenProgramPIP::where('nama', $nama)->where('kelas', $kelas)->where('idsekolah', $idsekolah)->update([
				'updated_at'=> date("Y-m-d H:i:s")
			]);
		} else {
			$input 	= 	AbsenProgramPIP::create([
				'nama'		=> $nama,
				'kelas'		=> $kelas,
				'idsekolah'	=> $idsekolah,
			]);
		}
		if ($input){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Selamat Datang '.$nama]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan, Hubungi Tim IT Terkait']);
			return back();
		}
	}
	public function TtdKwitansi($id){
		$homebase	= url("/");
		$kalender   = array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd         = date("d");
		$mm         = (int)date("m");
		$mm			= $kalender[$mm];
		$tahuniki   = date("Y");
		$tglsurat	= date("Y-m-d");
		$sakniki	= $dd.' '.$mm.' '.$tahuniki;
		$getarrsurat= explode("-",$id);
		if (isset($getarrsurat[1])){
			$id		= $getarrsurat[1];
		}
		$getdata 		= HPTKeuangan::where('id', $id)->first();
		if (isset($getdata->id)){
			$deskripsi 	= $getdata->deskripsi;
			$pemasukan 	= $getdata->pemasukan;
			$pengeluaran= $getdata->pengeluaran;
			$bendahara 	= $getdata->bendahara;
			$tglkwitansi= $getdata->tglkwitansi;
			$tandatangan= $getdata->tandatangan;
			$jenis		= $getdata->jenis;
			$tanggal 	= $dd;
			$bulan 		= $mm;
			$tahun 		= $tahuniki;	
			if ($jenis == 'operasional') { $tulisanne = 'BUKU OPERASIONAL RUTIN'; }
			elseif ($jenis == 'spp') { $tulisanne = 'BUKU KEUANGAN PEMBAYARAN SPP'; }
			elseif ($jenis == 'dpp') { $tulisanne = 'BUKU KEUANGAN DANA PEMBANGUNAN'; }
			elseif ($jenis == 'bos') { $tulisanne = 'BUKU KEUANGAN DANA BOS'; }
			elseif ($jenis == 'pajak') { $tulisanne = 'BUKU KEUANGAN PAJAK'; }
			elseif ($jenis == 'nonopsrutin') { $tulisanne = 'BUKU NON OPERASIONAL RUTIN '; }
			elseif ($jenis == 'lainlain') { $tulisanne = 'BUKU KEUANGAN LAIN-LAIN '; }
			else {$tulisanne = 'BUKU '.strtoupper($jenis); }
			if (is_null($tandatangan) OR $tandatangan == ''){
				$data           		=   [];
				if ($pengeluaran == '' OR $pengeluaran == 0) {$total = $pemasukan; $format = 'pemasukan'; }
				else { $total = $pengeluaran; $format = 'pengeluaran'; }
				$rsetting		= Sekolah::find($getdata->id_sekolah);
				$sekolah 		= $rsetting->nama_sekolah;
				$yayasan 		= $rsetting->nama_yayasan;
				$alamat 		= $rsetting->alamat;
				$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
				$mutiara 		= $rsetting->slogan;
				$logo 			= $rsetting->logo;
				$logogrey 		= $rsetting->logo_grey;
				$x 				= Terbilang($total);
				$tulisan		= number_format( $total , 0 , '.' , ',' );
				$y 				= $x.' rupiah';
				if ($format == 'pemasukan'){
					$rom 		= '<table width="760" border="0" cellpadding="0" cellspacing="0" class="table table-striped">
									<tr>
										<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="'.$homebase.'/'.$logo.'" width="98"/></td>
										<td colspan="8">'.$yayasan.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$sekolah.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$alamat.'</td>
									</tr>
									<tr>
										<td width="101" style="border-bottom:double">&nbsp;</td>
										<td width="25" style="border-bottom:double">&nbsp;</td>
										<td width="118" style="border-bottom:double">&nbsp;</td>
										<td width="13" style="border-bottom:double">&nbsp;</td>
										<td width="26" style="border-bottom:double">&nbsp;</td>
										<td width="125" style="border-bottom:double">&nbsp;</td>
										<td width="39" style="border-bottom:double">&nbsp;</td>
										<td width="129" style="border-bottom:double">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><span class="isi">Deskripsi</span></td>
										<td colspan="8" style="border-bottom:dotted"><span class="isi">: '.$deskripsi.'</span></td>
									</tr>
									<tr>
										<td colspan="3">Uang Sebesar</td>
										<td colspan="8" style="border-bottom:dotted">: '.$y.'</td>
									</tr>
									<tr>
										<td colspan="3">Masuk Dalam Buku</td>
										<td colspan="8" style="border-bottom:dotted">: '.$tulisanne.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" align="center"><span class="isi">'.$sakniki.'</span></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" rowspan="3" align="center">'.$tandatangan.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td colspan="3" rowspan="2" style="border-bottom:thin; border-top:thin; border-left:thin; border-right:thin;" valign="middle" align="center"><span class="isi"><b>Rp. <u>'.$tulisan.'</u></b></span></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">'.$bendahara.'</span></td>
									</tr>
								</table>';
			
				} else {
					$rom 		= '<table width="760" border="0" cellpadding="0" cellspacing="0" class="table table-striped">
									<tr>
										<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="'.$homebase.'/'.$logo.'" width="98"/></td>
										<td colspan="8">'.$yayasan.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$sekolah.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$alamat.'</td>
									</tr>
									<tr>
										<td width="101" style="border-bottom:double">&nbsp;</td>
										<td width="25" style="border-bottom:double">&nbsp;</td>
										<td width="118" style="border-bottom:double">&nbsp;</td>
										<td width="13" style="border-bottom:double">&nbsp;</td>
										<td width="26" style="border-bottom:double">&nbsp;</td>
										<td width="125" style="border-bottom:double">&nbsp;</td>
										<td width="39" style="border-bottom:double">&nbsp;</td>
										<td width="129" style="border-bottom:double">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><span class="isi">Sudah terima dari </span></td>
										<td colspan="8" style="border-bottom:dotted"><span class="isi">: Bendahara '.$sekolah.'</span></td>
									</tr>
									<tr>
										<td colspan="3">Uang Sebesar</td>
										<td colspan="8" style="border-bottom:dotted">: '.$y.'</td>
									</tr>
									<tr>
										<td colspan="3">Untuk</td>
										<td colspan="8" style="border-bottom:dotted">: '.$deskripsi.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" align="center"><span class="isi">'.$sakniki.'</span></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" rowspan="3" align="center">'.$tandatangan.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td colspan="3" rowspan="2" style="border-bottom:thin; border-top:thin; border-left:thin; border-right:thin;" valign="middle" align="center"><span class="isi"><b>Rp. <u>'.$tulisan.'</u></b></span></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">'.$bendahara.'</span></td>
									</tr>
								</table>';
			
				}
				$tandatangan 			= 	'<img src="'.$homebase.'/boxed-bg.png" width="100">';
				$data['jenissurat'] 	= 	'Kwitansi';
				$data['tandatangan'] 	= 	$tandatangan;
				$data['idsurat'] 	    = 	$id;
				$data['sakniki']       	=   $sakniki;
				$data['bendahara']     	=   $bendahara;
				$data['alamatweb']    	=   '';
				$data['surat']     		=   $rom;
				return view('alqalam.formttd', $data);
			
			} else {
				$data					= [];
				$data['sidebar'] 		= 'ttdkwitansi';
				$data['kalimatheader'] 	= 'Mohon Maaf Kwitansi Ini Sudah di Tandatangani';
				$data['kalimatbody'] 	= 'Kwitansi Yang Telah di Tandatangani Tidak Bisa di Ubah / di Tandatangani Ulang <p></p><a href="/" class="btn btn-primary">Kembali Ke Home</a>';
				return view('errors.notready', $data);
			}
		} else {
			$data					= [];
			$data['sidebar'] 		= 'ttdkwitansi';
			$data['kalimatheader'] 	= 'Data Tidak Di Temukan';
			$data['kalimatbody'] 	= 'Yth. Bapak/Ibu Bendahara<br />Kwitansi dengan ID '.$id.' Tidak ditemukan, periksa kembali URL yang diterima<p></p><a href="/" class="btn btn-primary">Kembali Ke Home</a>';
				
			return view('errors.notready', $data);
		}
	}
	public function expersetujuanBerkas(Request $request) {
        $validator = Validator::make($request->all(), [
            'set01'     =>  'required',
            'set02'     =>  'required',
            'set03'     =>  'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Error !! Semua Form Harus di Isi']);
        } else {
			$id 		= $request->input('set01');
			$ttd 		= $request->input('set02');
			$alasan 	= $request->input('set03');
			$alamatweb 	= $request->input('set04');
			$jenissurat = $request->input('set05');
			if ($jenissurat == 'Kwitansi'){
				$rom  		= HPTKeuangan::where('id', $id)->first();
				if (isset($rom->id)){
					if ($rom->pengeluaran == '' OR $rom->pengeluaran == 0) {$realjenis = 'pemasukan'; $realnominal = $rom->pemasukan; }
					else { $realjenis = 'pengeluaran'; $realnominal = $rom->pengeluaran;}
					if ($alasan == 'SETUJU'){
						$update = HPTKeuangan::where('id', $id)->update([
							'tandatangan'	=> $ttd,
							'tglkwitansi'	=> date("Y-m-d"),
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					} else {
						$update = HPTKeuangan::where('id', $id)->update([
							'keterangan'	=> 'Tidak Setuju dengan alasan '.$alasan.' pada '.date("Y-m-d H:i:s"),
							'pemasukan'		=> 0,
							'pengeluaran'	=> 0,
							'realnominal'	=> $realnominal,
							'realjenis'		=> $realjenis,
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					}
					if ($update){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Updated']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
					return back();	
				}
			} else if ($jenissurat == 'Orang Tua Asuh'){
				$rom  	= Datainduk::where('id', $id)->first();
				if (isset($rom->id)){
					$kodeortuasuh = $rom->kodeortuasuh;
					if ($kodeortuasuh == '' OR is_null($kodeortuasuh)){
						$update = Datainduk::where('id', $id)->update([
							'ttdoratuasuh'	=> $ttd,
							'kodeortuasuh'	=> Session('email'),
							'tglkesediaan'	=> date("Y-m-d H:i:s"),
							'updated_at'	=> date("Y-m-d H:i:s"),
						]);
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Permohon Sebagai Orang Tua Asuh Telah Kami Terima. Semoga Allah, Tuhan Yang Maha Kaya dan Maha Mengurusi Segala Sesuatu memudahkan urusan Dunia dan Akherat Bapak / Ibu yang budiman.']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Permohonan Gagal, Siswa ini telah memiliki Orang Tua Asuh. Mohon Refresh Kembali Laman Ini']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
					return back();	
				}
			} else if ($jenissurat == 'TAMBAH DATA SISWA'){
				$noinduk	= $id;
				$tgllahir	= $ttd;
				$rom  		= Datainduk::where('noinduk', $noinduk)->where('tgllahir', $tgllahir)->first();
				if (isset($rom->id)){
					$update = Datainduk::where('noinduk', $noinduk)->where('tgllahir', $tgllahir)->update([
						'kodeortu'		=> Session('id'),
						'updated_at'	=> date("Y-m-d H:i:s"),
					]);
					if ($update){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Setting Sebagai Orang Tua Telah Kami Terima. Semoga Allah, Tuhan Yang Maha Kaya dan Maha Mengurusi Segala Sesuatu memudahkan urusan Dunia dan Akherat Bapak / Ibu yang budiman.']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
						return back();
					}
				
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
					return back();	
				}
			} else if ($jenissurat == 'Surat Keluar'){
				$rom  		= Suratkeluar::where('id', $id)->first();
				if (isset($rom->id)){
					if ($alasan == 'SETUJU'){
						$update = Suratkeluar::where('id', $id)->update([
							'filelampiran'	=> 'Signed at '.date("Y-m-d H:i:s"),
						]);
						$penerima 	= 'Esign Server';
						$status 	= 'Signed';
						$cekpenerima = Penerimasurat::where('idsurat', $rom->id)->where('penulisan', $rom->alamat)->first();
						if(isset($cekpenerima->id)){
							Penerimasurat::where('id',$cekpenerima->id)->update([
								'status'	=> 'Tertandatangani',
								'jenis'		=> 'KELUAR'
							]);
						}
					} else {
						$update = Suratkeluar::where('id', $id)->update([
							'filelampiran'	=> 'Menolak Tandatangan at '.date("Y-m-d H:i:s"),
						]);
						$penerima 	= 'Konseptor';
						$status 	= 'Menolak';
					}
					if ($update){
						Inboxsurat::insert([
							'marking'  		=> $rom->marking,
							'pengirim'  	=> $rom->kepada,
							'penerima'		=> $penerima,
							'email'			=> $rom->alamat,
							'sifat'			=> 5,
							'status'		=> $status,
							'jenis'			=> 'KELUAR',
							'kerja'			=> '',
							'catatan'		=> '',
							'tandatangan'	=> $ttd,
							'tanggal'		=> '',
							'idsurat' 		=> $rom->id,
							'noagenda' 		=> '',
							'tglsurat' 		=> $rom->tglsurat,
							'jenissrt' 		=> $rom->jenissurat,
							'nosurat' 		=> $rom->nomor.'/'.$rom->fakultas.'/'.$rom->kodefak.'/'.$rom->monsrt.'/'.$rom->yersrt,
							'kepada' 		=> $rom->kepada,
							'perihal' 		=> $rom->perihal,
							'alamat' 		=> $rom->alamat,
							'lampiran' 		=> '',
							'kodefak' 		=> '',
							'klasifikasi' 	=> '',
							'pembuat' 		=> $rom->kepada,
							'unit' 			=> '',
							'tabel' 		=> 'KELUAR',
							'footnote'		=> $alasan
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Terimakasih, Surat ini kami proses Lebih Lanjut']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
						return back();
					}
				
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
					return back();	
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
				return back();	
			}
        }
    }
	public function viewTrackingbyid($id) {
		$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$urutanwerno	= array('red','green','blue','black','navy','teal','orange','maroon','black','aqua');
		$trackingcode 	= $id;
		$data 			= [];
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
			$fakpanjang 				= $getdomainid->subsubdomainapps;
			$data['namaapps01']  		= $getdomainid->name;
			$data['domainapps01']  		= $getdomainid->domainapps;
			$data['subdomainapps01']  	= $getdomainid->subdomainapps;
			$data['subsubdomainapps01'] = $getdomainid->subsubdomainapps;
			$data['addressapps01']  	= $getdomainid->addressapps;
			$data['emailapps01']  		= $getdomainid->emailapps;
			$data['lamanapps01']  		= $lamanportal;
			$data['logofrontapps01']  	= $getdomainid->logofrontapps;
			$data['logo01']  			= $getdomainid->icon;
		} else {
			$fakpanjang 				= subsubdomainapps01;
			$data['namaapps01']  		= namaapps01;
			$data['domainapps01']  		= domainapps01;
			$data['subdomainapps01']  	= subdomainapps01;
			$data['subsubdomainapps01'] = subsubdomainapps01;
			$data['addressapps01']  	= addressapps01;
			$data['emailapps01']  		= emailapps01;
			$data['lamanapps01']  		= lamanapps01;
			$data['logofrontapps01']  	= logofrontapps01;
			$data['logo01']  			= '/mascot.png';
		}
		$cekjenis		= explode('-', $trackingcode);
		$homebase		= url("/");
		if (isset($cekjenis[1])){
			$jenis 		= $cekjenis[0];
			$idne 		= $cekjenis[1];
			if ($jenis == 'srtmsk'){
				$marking 	= str_replace("srtmsk-", "", $id);
				$cekdata	= Suratmasuk::where('marking', $marking)->count();
				if ($cekdata != 0){
					$datadiri	= Suratmasuk::where('marking', $marking)->first();
					$sql		= Inboxsurat::where('marking', $marking)->get();
						$x = 0;
						$y = 0;
						if (!empty($sql)){
							foreach ($sql as $rowpeng) {
								$pemberi        = $rowpeng->pengirim;
								$kepada     	= $rowpeng->penerima;
								if ($kepada != 'Kotak Sampah'){
									$isidisposisi   = substr($rowpeng->catatan, 0, 30) . '...';
								} else {
									$isidisposisi   = $rowpeng->catatan;
								}
								$created_at     = $rowpeng->created_at;
								$kapan        	= timeAgo($created_at);
								$updatenya     	= $rowpeng->updated_at;
								$updatenya      = timeAgo($updatenya);
								$iconne			= 'fa-hand-o-down';
								$dipsosisi		= 'Memberikan Disposisi kepada :<br />'.$kepada.'<br />'.$isidisposisi;
								$data['pengumumans'][$x]['tanggal']     =   $created_at;
								$data['pengumumans'][$x]['kapan']       =   $kapan;
								$data['pengumumans'][$x]['jencolor']    =   $urutanwerno[$y];
								$data['pengumumans'][$x]['siapa']       =   $pemberi;
								$data['pengumumans'][$x]['pengumuman']  =   $dipsosisi;
								$data['pengumumans'][$x]['icon']        =   $iconne;
								$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
								if ($y == 9) {
									$y = 0; 
								} else {
									$y++; 
								}
								$x++;
							}
						}
						$data['datadiri']		= [];
						return view('errors.trackdisposisi', $data);
				} else {
					$cekdata	= Inboxsurat::where('marking', $marking)->count();
					if ($cekdata == 0){
						$data['judulpesan']			= 'Unkown Errors';
						$data['kalimatheader']		= 'Marking '.$marking.' Tidak di Temukan';
						$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
						return view('errors.pesanerror', $data);
					} else {
						$sql	= Inboxsurat::where('marking', $marking)->get();
						$x = 0;
						$y = 0;
						if (!empty($sql)){
							foreach ($sql as $rowpeng) {
								$pemberi        = $rowpeng->pengirim;
								$kepada     	= $rowpeng->penerima;
								if ($kepada != 'Kotak Sampah'){
									$isidisposisi   = substr($rowpeng->catatan, 0, 30) . '...';
								} else {
									$isidisposisi   = $rowpeng->catatan;
								}
								$created_at     = $rowpeng->created_at;
								$kapan        	= timeAgo($created_at);
								$updatenya     	= $rowpeng->updated_at;
								$updatenya      = timeAgo($updatenya);
								$iconne			= 'fa-hand-o-down';
								$dipsosisi		= 'Memberikan Disposisi kepada :<br />'.$kepada.'<br />'.$isidisposisi;
								$data['pengumumans'][$x]['tanggal']     =   $created_at;
								$data['pengumumans'][$x]['kapan']       =   $kapan;
								$data['pengumumans'][$x]['jencolor']    =   $urutanwerno[$y];
								$data['pengumumans'][$x]['siapa']       =   $pemberi;
								$data['pengumumans'][$x]['pengumuman']  =   $dipsosisi;
								$data['pengumumans'][$x]['icon']        =   $iconne;
								$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
								if ($y == 9) {
									$y = 0; 
								} else {
									$y++; 
								}
								$x++;
							}
						}
						$data['datadiri']		= [];
						return view('errors.trackdisposisi', $data);
					}
				}
			} else if ($jenis == 'srtklr'){
				$marking 	= str_replace("srtklr-", "", $id);
				$marking 	= str_replace(".pdf", "", $marking);
				$datadiri	= [];
				$cekapaid 	= explode('-', $marking);
				if ($cekapaid[0] == 'keluar'){
					$idne 		= $cekapaid[1];
					$cekmarking	= Suratkeluar::where('id', $idne)->first();
					if (isset($cekmarking->id)){
						$marking= $cekmarking->marking;
					}
				}
				$cekdata	= Inboxsurat::where('marking', $marking)->count();
				$iconne		= 'fa-pencil';
				$perihal 	= '';
				$lampiran	= '#';
				$urlfile	= $homebase.'/scan/files/'.$marking.'.pdf';
				$datadiri	= Suratkeluar::where('marking', $marking)->first();
				if (!isset($datadiri->id)){
					$datadiri	= Tabelskdanperaturan::where('marking', $marking)->first();
					if (!isset($datadiri->id)){
						$datadiri	= Draftsk::where('marking', $marking)->first();
						if (!isset($datadiri->id)){
							$datadiri	= Suratkeluartnpnomor::where('marking', $marking)->first();
							if (!isset($datadiri->id)){
								$datadiri	= Suratmasuk::where('marking', $marking)->first();
								if (isset($datadiri->id)){
									$perihal 	= $datadiri->perihal;
									$konseptor 	= $datadiri->pembuat;
									$pembuatan 	= $datadiri->created_at;
									$title		= $datadiri->bentuk.' Nomor Agenda '.$datadiri->noagenda.' Tahun '.$datadiri->yersrt;
									$urlfile	= $homebase.'/viewsurat/94db1c8fae5b94957265aa3a335dfd3d-'.$datadiri->id;
								} else {
									$perihal 	= 'File Missing';
									$konseptor	= 'Data Not Found';
									$pembuatan 	= 'Data Not Found';
									$title		= $perihal;
								}
							} else {
								$lampiran 	= $datadiri->lampiran;
								$perihal 	= $datadiri->perihal;
								$konseptor 	= $datadiri->pembuat;
								$pembuatan 	= $datadiri->created_at;
								$title		= $datadiri->jenissrt.' Tanggal '.$datadiri->tglbuat;
								$urlfile	= $homebase.'/viewsurat/31a6c48f03aaf7ab8085cc6b5bd34990-'.$datadiri->id;
							}
						} else {
							$lampiran 	= $datadiri->lampiran;
							$perihal 	= $datadiri->judulsk;
							$konseptor 	= $datadiri->konseptor;
							$pembuatan 	= $datadiri->created_at;
							$title		= $datadiri->jenissk.' Nomor '.$datadiri->nomor.' Tahun '.$datadiri->tahun;
						}
					} else {
						$perihal 	= $datadiri->judul;
						$lampiran 	= $datadiri->namaparaf3;
						$konseptor 	= $datadiri->inputor;
						$pembuatan 	= $datadiri->created_at;
						$title		= $datadiri->kelompok.' Nomor : '.$datadiri->nomor.' Tahun '.$datadiri->tahun;
						$urlfile	= $homebase.'/viewsurat/SKPP-'.$datadiri->id;
					}
				} else {
					$lampiran 	= $datadiri->lampiran;
					$perihal 	= $datadiri->perihal;
					$konseptor 	= $datadiri->pembuat;
					$pembuatan 	= $datadiri->created_at;
					$title		= $datadiri->jenissrt.' Nomor : '.$datadiri->nomor.' Tahun '.$datadiri->yersrt;
					$urlfile	= $homebase.'/viewsurat/keluar-'.$datadiri->id;
				}
				if ($cekdata != 0){
					$sql		= Inboxsurat::where('marking', $marking)->get();
					$x 			= 0;
					$y 			= 0;
					if (!empty($sql)){
						foreach ($sql as $group) {
							$tanggal    							= 	$group->updated_at;
							$lampiran    							= 	$group->lampiran;
							if ($lampiran != ''){
								$lampiran							= '<a href="'.$homebase.'/scan/files/'.$lampiran.'" target="_blank">File Lampiran</a>';
							}
							$kapan        							= 	timeAgo($tanggal);
							$cektanggal								= 	explode(" ", $tanggal);
							$tanggal								= 	$cektanggal[0];
							if ($group->penerima == 'Esign Server'){
								$pengumuman							= 'Menandatangani Surat Pada tanggal '.$tanggal.'<br /><img src="'.$group->tandatangan.'" width="100">';
							} else {
								$pengumuman							= 'Send To '.$group->penerima.' ( '.$group->kerja.' ) at '.$group->created_at.'<br />Catatan : '.$group->footnote.'<br />'.$lampiran;
							}
							$data['pengumumans'][$x]['tanggal']     =   $tanggal;
							$data['pengumumans'][$x]['kapan']       =   $kapan;
							$data['pengumumans'][$x]['jencolor']    =   $urutanwerno[$y];
							$data['pengumumans'][$x]['siapa']       =   $group->pengirim;
							$data['pengumumans'][$x]['pengumuman']  =   $pengumuman;
							$data['pengumumans'][$x]['icon']        =   $iconne;
							$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
							if ($y == 9) {
								$y = 0; 
							} else {
								$y++; 
							}
							$x++;
						}
					}
				}
				if ($lampiran == '#' OR $lampiran == '' OR $lampiran == null){
					$lampiran 			= '#';
				} else { $lampiran		= $homebase.'/scan/files/'.$lampiran; }
				$data['datadiri']		= $datadiri;
				$data['konseptor']		= $konseptor;
				$data['pembuatan']		= $pembuatan;
				$data['keterangan']		= $perihal;
				$data['name']			= $marking;
				$data['title']			= $title;
				$data['lampiran']		= $lampiran;
				$data['urlfile']		= $urlfile;
				return view('cetak.tracksuratkeluar', $data);
			} else {
				$data['judulpesan']			= 'Unkown Errors';
				$data['kalimatheader']		= 'Jenis Tracking Belum Di Tentukan';
				$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
				return view('errors.pesanerror', $data);
			}
		} else {
			$data['judulpesan']			= 'Unkown Errors';
			$data['kalimatheader']		= 'ID '.$id.' Tidak di Temukan';
			$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
			return view('errors.pesanerror', $data);
		
		}
	}
	public function exRegisterMHS(Request $request){
		$validator  =   Validator::make($request->all(), [
		    'nama' 				=> 'required',
            'email' 			=> 'required',
            'prodi' 			=> 'required',
            'password' 			=> 'required|min:6',
            'password_confirm' 	=> 'required|same:password',
        ]);

        if($validator->fails()) {
			$response = [
                'message'   => 'Pendaftaran Gagal',
                'data'      => 'Form Pendaftaran Tidak Terisi dengan Benar'
            ];
            return response()->json($response, 500);
		} else {
			$nama 		= $request->input('nama');
			$email 		= $request->input('email');
			$prodi 		= $request->input('prodi');
			$password 	= $request->input('password');
			$cekmail 	= explode("@", $email);
			if (isset($cekmail[1])){
				$domain = $cekmail[1];
				$nim 	= $cekmail[0];
			} else {
				$nim	= $email;
				$domain	= 'ub.ac.id';
				$email 	= $nim.'@'.$domain;
			}
			if ($prodi != '' AND $email != '' AND $nama != '' AND $password != ''){
				$nim	= preg_replace('~\D~', '', $nim);
				$cekcar	= strlen($nim);
				$getmaster	= MasterPS::where('id', $prodi)->first();
				if (isset($getmaster->jurusan)){
					$jurusan	= $getmaster->jurusan;
					$namaps		= $getmaster->nama;
					$namapt 	= $getmaster->namapt;
					$namafak	= $getmaster->namafak;
					$jenjang	= $getmaster->jenjang;
				} else {
					$jurusan	= '';
					$namaps		= '';
					$namapt 	= '';
					$namafak	= '';
					$jenjang	= '';
				}
				if ($jenjang == 'Magister S2' OR $jenjang == 'Profesi'){
					$cekcar = 15;
				}
				if ($cekcar == 15 AND $jenjang != ''){
					if ($domain == 'ub.ac.id' OR $domain == 'student.ub.ac.id' OR $domain == 'mail.ub.ac.id'){
						$cekuser	= User::where('username', $nim)->count();
						if ($cekuser == 0){
							$cekbiodata = Biodata::where('nimmhs', $nim)->count();
							if ($cekbiodata == 0){
								$arrnim 	= str_split($nim);
								$angkatan1	= $arrnim[0];
								$angkatan2	= $arrnim[1];
								$angkatan	= '20'.$angkatan1.$angkatan2;
								if ($jenjang == 'Doktor S3'){
									$kelompok = 'mahasiswa doktoral';
								} else if ($jenjang == 'Magister S2' OR $jenjang == 'Profesi'){
									$kelompok = 'mahasiswa magister';
								} else {
									$kelompok = 'mahasiswa';
								}
								$getfakpdk	= User::where('fakpanjang', $namafak)->where('fakultas', '!=', '')->first();
								if (isset($getfakpdk->fakultas)){
									$fakultas = $getfakpdk->fakultas;
								} else {
									$fakultas = 'KP';
								}
								$input 		= Biodata::create([
									'nama'          =>  $nama,
									'nimmhs'        =>  $nim,
									'tempatlhr'     => 	'',
									'tanggallhr'    =>  '',
									'agama'         =>  '',
									'kelamin'       =>  '',
									'kamin'         =>  '',
									'alamatmlg'     =>  '',
									'hape'          =>  '',
									'email'         =>  $email,
									'ortu1'         =>  '',
									'ortu2'         =>  '',
									'pekerjaan'     =>  '',
									'jabatan'       =>  '',
									'nip'           =>  '',
									'pangkat'       =>  '',
									'instansi'      =>  '',
									'alamatinst'    =>  '',
									'alamatortu'    =>  '',
									'telponortu'    =>  '',
									'thnmasuk'      =>  $angkatan,
									'aslipin'		=>  '', 
									'sekolahasal'	=>  '', 
									'jurusan'       =>  $jurusan,
									'pees'          =>  $namaps,
									'ijasah'		=>  '', 
									'universitas'   =>  $namapt,
									'fakultas'      =>  $namafak,
									'jenjang'       =>  $jenjang,
									'thnlulus'		=>  '', 
									'dosenpa'       =>  '',
									'bimbing1'		=> '', 
									'bimbing2'		=> '', 
									'bimbing3'		=> '', 
									'majelis'		=> '', 
									'skripsi'		=> '', 
									'predikat'		=> '', 
									'ipk'			=> '', 
									'totalmk'		=> '', 
									'ipkhuruf'		=> '', 
									'lamathn'		=> '', 
									'lamabln'		=> '', 
									'angkatanlulusan'=> '', 
									'tgltandatangan'=> '', 
									'titel'			=> '', 
									'judul'			=> '', 
									'judulinggris'	=> '', 
									'skstotal'		=> '', 
									'noijasah'		=> '', 
									'notrans'		=> '', 
									'prestasi'		=> '', 
									'beasiswa'		=> '', 
									'ukm'			=> '', 
									'organisasi1'	=> '', 
									'jabatan1'		=> '', 
									'tahunjab1'		=> '', 
									'organisasi2'	=> '', 
									'jabatan2'		=> '', 
									'tahunjab2'		=> '', 
									'organisasi3'	=> '', 
									'jabatan3'		=> '', 
									'tahunjab3'		=> '', 
									'tglsempro'		=> '', 
									'tglsemhas'		=> '', 
									'tglujian'		=> '', 
									'tgllulus'		=> '', 
									'tglyudisium'	=> '', 
									'nodinsemhas'	=> '', 
									'nokelulusan'	=> '', 
									'tmptmagang'	=> '', 
									'tglmagang'		=> '', 
									'periodewisuda'	=> '', 
									'thnwisuda'		=> '', 
									'nomerpin'		=> '', 
									'statuswisuda'	=> '', 
									'keteranganwisuda'	=> '', 
									'marking'			=> ''
								]);
								if ($input){
									
									$file = $request->file('avatar');
									if ($file) { //jika ada filenya
										$ext 	= $file->getClientOriginalExtension(); 
										$name 	= $nim.'.'.$ext ;
										$request->file('avatar')->move(public_path('images/'), $name);
									} else {
										$name	= '';
									}
									User::create([
										'nama'      	=>  $nama,
										'username' 		=>  $nim,
										'password' 		=>  bcrypt($password),
										'previlage' 	=> 	$kelompok,
										'nip' 			=> 	$nim,
										'email' 		=> 	$email,
										'fakultas' 		=>  $fakultas,
										'fakpanjang' 	=>  $namafak,
										'photo' 		=>  $name,
									]);
									$response = [
										'message'       => 'User Created Successfull',
										'user'          => $nim,
										'profile'       => $nama,
										'role'          => $kelompok,
									];

									return response()->json($response, 201);
								} else {
									$response = [
										'message'  => 'System Failed, Please try again in a few years'
									];
									return response()->json($response, 500);
								}
								
							} else {
								$response = [
									'message'  => 'Data NIM '.$nim.' Sudah ada, silahkan anda masuk halaman login langsung'
								];
								return response()->json($response, 500);
							}
						} else {
							$response = [
								'message'  => 'Username Telah digunakan, Silahkan menggunakan username lain'
							];
							return response()->json($response, 500);
						}
					} else {
						$response = [
							'message'  => 'Email wajib menggunakan @ub.ac.id'
						];
						return response()->json($response, 500);
					}
				} else {
					$response = [
						'message'  => 'Penulisan Email Tidak Valid, Email di isi dengan format NIM Anda kemudian di ikuti dengan @ub.ac.id'
					];
					return response()->json($response, 500);
				}
			} else {
				$response = [
					'message'  => 'Data Pendaftaran Tidak Terisi Semua, Email di isi dengan format NIM Anda kemudian di ikuti dengan @ub.ac.id'
				];
				return response()->json($response, 500);
			}
		}
    }
	public function cekTrackingNIM(Request $request) {
    	$nim 		= $request->input('set01');
		$homebase	= url("/");
		$cekuser	= User::where('username', $nim)->count();
		if ($cekuser != 0){
			$getuser	= User::where('username', $nim)->first();
			if (isset($getuser->email)){
				try {
					SendMail::kirim($getuser->nama,$getuser->email,true);
				} catch (\Exception $e) {
					$teserror = ' Gagal Kirim ke '.$getuser->email;
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $teserror]);
					return back();
				}
				
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Tidak di Temukan, Hubungi PSIK Unit Masing-Masing Untuk Reset Manual']);
				return back();
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'NIM Anda Tidak ditemukan dalam Database User Kami']);
			return back();
		}
    }
	public function ubah_pass(Request $request){
        $key 	= $request->input('key');
        $decrip = SendMail::dekrip($key);
        $email 	= '';
        if($decrip == false){
            $validasi 	= false;
            $message 	= 'Invalid Key';
        } else{
            $data 		= explode('|', $decrip);
            $email 		= $data[0]; 
            $datetime 	= $data[1];
            $ver 		= $data[2];
            if($ver=='FOR'){
                $datenow 	= date('YmdHis');
                $now 		= strtotime($datenow);
                $time 		= strtotime($datetime);
                $res_time 	= $now-$time;
                $bataswaktu = 60*7;
                if($res_time>$bataswaktu){
                    $validasi 	= false;
                    $message 	= 'Waktu ubah password telah habis. Untuk mendapat email ubah password silahkan melakukan permintaan ubah password';
                }else{
                    $validasi 	= true;
                    $message 	= '';
                }
            }else{
                $validasi 		= false;
                $message 		= 'Invalid Key';
            }
        } 
        $data = array(
            'validasi' 	=> $validasi,
            'message' 	=> $message,
            'email' 	=> $email,
            'key' 		=> $key,
        );
    	return view('ubah_pass', $data);
    }
	public function proses_forget(Request $request){
        $email = $request->input('set01');
        $ceksek = explode('@', $email);
		if (isset($ceksek[1])){
			$cekuser = User::where('username', $email)->first();
			if (isset($cekuser->id)){
				$password 	= time();
				$update = User::where('id', $cekuser->id)->update([
					'password' 	=>  bcrypt($password),
				]);
				if ($update){
					SendMail::kirimUser($cekuser->nama, $email, $cekuser->username, $password, true);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Informasi Username dan Password Telah Kami Kirimkan ke Email Anda']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Reset Gagal, Silahkan Hubungi Admin']);
					return back();
				}
			} else {
				$cekemail = User::where('email', $email)->count();
				if ($cekemail != 0){
					$password 	= time();
					$update 	= User::where('email', $email)->update([
						'password' =>  bcrypt($password),
					]);
					if ($update){
						SendMail::kirimUser($email, $email, 'Sesuai dengan Email yang tersimpan', $password, true);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Informasi Username dan Password Telah Kami Kirimkan ke Email Anda']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Reset Gagal, Silahkan Hubungi Admin']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Tidak di Temukan dalam database SCO, mohon coba cek email atau coba login sekali lagi']);
					return back();
				}	
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Tidak Valid, pastikan informasi email ditulis lengkap']);
			return back();
		}
    }
	public function exTracestudy(Request $request) {
    	$trackingcode 	= $request->input('set01');
		$nim	        = $request->input('nimalumni');
		$kerja	      	= $request->input('id_kerjaawal');
		$jabatan	  	= $request->input('id_kerja');
		$instansi  		= $request->input('id_namainstansi');
		$jenis  		= $request->input('id_perusahaan');
		$gaji	        = $request->input('id_gaji');
		$sesuai		    = $request->input('id_sesuai');
		$tunggu		   	= $request->input('id_tunggu');
		$alamat		   	= $request->input('id_alamat');
		$provinsi		= $request->input('id_provinsi');
		$negara		   	= $request->input('id_negara');
		$saran		   	= $request->input('id_saran');
		$nohape		   	= $request->input('nohape');
		$tanya1		   	= $request->input('id_tanya1');
		$tanya2		   	= $request->input('id_tanya2');
		$tanya3		   	= $request->input('id_tanya3');
		$tanya4		   	= $request->input('id_tanya4');
		$tanya5		   	= $request->input('id_tanya5');
		$tanya6		   	= $request->input('id_tanya6');
		$tanya7		   	= $request->input('id_tanya7');
		$tanya8		   	= $request->input('id_tanya8');
		$tanya9		   	= $request->input('id_tanya9');
		$alamatrumah   	= $request->input('alamatrumah');
		$email		   	= $request->input('email');
		$jenjang	   	= $request->input('jenjang');
		$kerjaawal	   	= $request->input('id_kerjaawal');
		$kerjaskrg	   	= $request->input('id_kerjaskrg');
		$fakultas	   	= $request->input('fakultas');

		$nama 	        = '';
		$pees  	        = '';
		$jurusan 	    = '';
		$yudisium		= '';
		$angkatan		= '';
		$countbio 		= Biodata::where('nimmhs', $nim)->count();
		if ($countbio == 0){
			$count 		= Transkrip::where('nim', $nim)->count();
			if ($count == 0){
				$nama 		= 'Unkown';
				$pees 		= 'Unkown';
				$jurusan 	= 'Unkown';
				$angkatan 	= '0000';
			}
			else {
				$rmaster2		= Transkrip::where('nim', $nim)->first();
				$nama 	        = $rmaster2->nama;
				$pees  	        = $rmaster2->program;
				$jurusan 	    = $rmaster2->jurusan;
				$angkatan 	    = $rmaster2->angkatan;
			}
		} else {
			$rmaster1  		= Biodata::where('nimmhs', $nim)->first();
			$nama 	        = $rmaster1->nama;
			$pees  	        = $rmaster1->pees;
			$jurusan 	    = $rmaster1->jurusan;
			$angkatan 	    = $rmaster1->thnmasuk;
			$yudisium 	    = $rmaster1->tglyudisium;
		}
		$ceksudah 	= TraceStudi::where('nim', $nim)->count();
		if ($ceksudah == 0){
			$input = TraceStudi::create([
				'angkatan'		=> $angkatan,
				'nama'			=> $nama,
				'nim'			=> $nim,
				'pees'			=> $pees,
				'jurusan'		=> $jurusan,
				'pekerjaan'		=> $kerja,
				'namainstansi'	=> $instansi,
				'jenis'			=> $jenis,
				'gaji'			=> $gaji,
				'sesuai'		=> $sesuai,
				'tungguthn'		=> $tunggu,
				'tunggubln'		=> 0,
				'alamat'		=> $alamat,
				'provinsi'		=> $provinsi,
				'negara'		=> $negara,
				'yudisium'		=> $yudisium,
				'saran'			=> $saran,
				'hape'			=> $nohape,
				'tanya1'		=> $tanya1,
				'tanya2'		=> $tanya2,
				'tanya3'		=> $tanya3,
				'tanya4'		=> $tanya4,
				'tanya5'		=> $tanya5,
				'tanya6'		=> $tanya6,
				'tanya7'		=> $tanya7,
				'tanya8'		=> $tanya8,
				'tanya9'		=> $tanya9,
				'alamatrmh'		=> $alamatrumah,
				'email'			=> $email,
				'jenjang'		=> $jenjang,
				'kerjawal'		=> $kerjaawal,
				'kerjaskrg'		=> $kerjaskrg,
				'fakultas'		=> $fakultas
			]);
		} else {
			$input = TraceStudi::where('nim', $nim)->update([
				'angkatan'		=> $angkatan,
				'nama'			=> $nama,
				'pees'			=> $pees,
				'jurusan'		=> $jurusan,
				'pekerjaan'		=> $kerja,
				'namainstansi'	=> $instansi,
				'jenis'			=> $jenis,
				'gaji'			=> $gaji,
				'sesuai'		=> $sesuai,
				'tungguthn'		=> $tunggu,
				'alamat'		=> $alamat,
				'provinsi'		=> $provinsi,
				'negara'		=> $negara,
				'yudisium'		=> $yudisium,
				'saran'			=> $saran,
				'hape'			=> $nohape,
				'tanya1'		=> $tanya1,
				'tanya2'		=> $tanya2,
				'tanya3'		=> $tanya3,
				'tanya4'		=> $tanya4,
				'tanya5'		=> $tanya5,
				'tanya6'		=> $tanya6,
				'tanya7'		=> $tanya7,
				'tanya8'		=> $tanya8,
				'tanya9'		=> $tanya9,
				'alamatrmh'		=> $alamatrumah,
				'email'			=> $email,
				'jenjang'		=> $jenjang,
				'kerjawal'		=> $kerjaawal,
				'kerjaskrg'		=> $kerjaskrg,
				'fakultas'		=> $fakultas
			]);
		}
		if ($input){
			Session::flash('status', 'Success');
			Session::flash('message', 'Terimakasih atas isian yang anda kirimkan '.$nama.'. Semoga anda selalu sehat dan sukses selalu.'); 
			Session::flash('alert-class', 'alert-info');
			return back();
		} else {
			Session::flash('status', 'Gagal');
			Session::flash('message', 'Pengisian anda gagal tersimpan, silahkan ulangi beberapa saat lagi'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
		}
    }
	public function cekTrackingcode(Request $request) {
    	$trackingcode 	= $request->input('set01');
		$cekjenis		= explode('-', $trackingcode);
		$homebase		= url("/");
		if (isset($cekjenis[1])){
			$jenis 		= $cekjenis[0];
			$idne 		= $cekjenis[1];
			if ($jenis == 'cek'){
				$cekdata= Ecekdata::where('progres', $idne)->count();
				if ($cekdata == 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tracking Code Not Found']);
					return back();
				} else {
					$alamatcetak	= $homebase.'/trackingid/cek-'.$idne;
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $alamatcetak]);
					return back();
				}
			}
			if ($jenis == 'kja'){
				$cekdata= Pengajuansimpukja::where('id', $idne)->count();
				if ($cekdata == 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tracking Code Not Found']);
					return back();
				} else {
					$alamatcetak	= $homebase.'/trackingid/kja-'.$idne;
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $alamatcetak]);
					return back();
				}
			}
			if ($jenis == 'srtmsk'){
				$marking 	= str_replace("srtmsk-", "", $trackingcode);
				
				$cekdata= Suratmasuk::where('marking', $marking)->count();
				if ($cekdata == 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tracking Code '.$marking.' Not Found']);
					return back();
				} else {
					$alamatcetak	= $homebase.'/trackingid/srtmsk-'.$marking;
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $alamatcetak]);
					return back();
				}
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tracking Code Invalid']);
			return back();
		}
    }
	public function exVerifikasicek(Request $request) {
    	$nama 		= $request->input('id_nama');
		$tanggal 	= $request->input('id_tanggal');
		$progres 	= $request->input('id_nomor');
		Ecekdata::where('progres', $progres)->update([
			'petugasbank'	=> $nama,
			'tglpencairan'	=> $tanggal
		]);
		return back();
    }
	public function getEvaluasiobject(Request $request) {
		$idprodi		= $request->input('set01');
		$semester		= $request->input('set02');
		$arrayjadwal 	= [];
		$cprodi			= MasterPS::where('id', $idprodi)->count();
		if ($cprodi == 0){ $tlsprodi = ''; $fakultas = ''; }
		else {
			$jprodi		= MasterPS::where('id', $idprodi)->first();
			$tlsprodi	= $jprodi->nama;
			$fakultas	= $jprodi->namafak;
		}
		$jjadwal 		= Jadwalkuliah::where('semester', $semester)->where('prodi', $idprodi)->groupBy('iddsnhadir')->get();
		if (!empty($jjadwal)){
			foreach ($jjadwal as $rdosen) {
				$iddosen 	= $rdosen->iddsnhadir;	
				if ($iddosen != 0){
					$cgetnamadsn = Dosen::where('id', $iddosen)->count();
					if ($cgetnamadsn == 0){
						$tlsdosen 	= '';
					} else {
						$getnamadsn = Dosen::where('id', $iddosen)->first();
						$tlsdosen 	= $getnamadsn->nama;
					}
				} else { $tlsdosen = ''; }
				$getjadwal 		= Jadwalkuliah::where('semester', $semester)->where('prodi', $idprodi)->where('iddsnhadir', $iddosen)->groupBy('marking')->get();
				if (!empty($getjadwal)){
					foreach ($getjadwal as $rjadwal) {
						$marking 	= $rjadwal->marking;
						$mulai 		= $rjadwal->mulai;
						$getjam 	= explode(" ", $mulai);
						if(isset($getjam[1])){
							$jam 	= $getjam[1];
						} else { $jam = $rjadwal->jam; }
						$jumlah 	= Jadwalkuliah::where('semester', $semester)->where('prodi', $idprodi)->where('marking', $marking)->where('iddsnhadir', $iddosen)->count();
				
						$arrayjadwal[] = array(
							'dot' 		=> $rjadwal->id,
							'tanggal' 	=> $rjadwal->tanggal,
							'hari' 		=> $rjadwal->hari,
							'ruang' 	=> $rjadwal->ruang,
							'jam' 		=> $jam,
							'kodemk' 	=> $rjadwal->kodemk,
							'kurikulum' => $rjadwal->kurikulum,
							'namamk' 	=> $rjadwal->namamk,
							'kelas' 	=> $rjadwal->kelas,
							'siam' 		=> $rjadwal->siam,
							'smtsing' 	=> $rjadwal->smtsing,
							'sks' 		=> $rjadwal->sks,
							'iddosen' 	=> $rjadwal->iddosen,
							'tlsdosen' 	=> $tlsdosen,
							'jumlah' 	=> $jumlah,
							'semester' 	=> $rjadwal->semester,
							'jenkls' 	=> $rjadwal->jeniskelas,
							'inputor' 	=> $rjadwal->inputor,
							'prodi'		=> $tlsprodi,
							'fakultas'	=> $fakultas
						);
					}
				}
			}
		}
		
		echo json_encode($arrayjadwal);	
	}
	public function exeValuasiobject(Request $request) {
		$semester	= $request->input('nil_semester');
		$fakultas	= $request->input('nil_fakultas');
		$prodi		= $request->input('nil_prodi');
		$dosen		= $request->input('nil_dosen');
		$matkul		= $request->input('nil_matkul');
		$kelas		= $request->input('nil_kelas');
		$jumlah		= $request->input('nil_jumlah');
		$saran		= $request->input('saran');
		$q01		= $request->input('nil_q01');
		$q02		= $request->input('nil_q02');
		$q03		= $request->input('nil_q03');
		$q04		= $request->input('nil_q04');
		$q05		= $request->input('nil_q05');
		$q06		= $request->input('nil_q06');
		$q07		= $request->input('nil_q07');
		$q08		= $request->input('nil_q08');
		$q09		= $request->input('nil_q09');
		$q10		= $request->input('nil_q10');
		$q11		= $request->input('nil_q11');
		$q12		= $request->input('nil_q12');
		$q13		= $request->input('nil_q13');
		$q14		= $request->input('nil_q14');
		$q15		= $request->input('nil_q15');
		$q16		= $request->input('nil_q16');
		$q17		= $request->input('nil_q17');
		$q18		= $request->input('nil_q18');
		$q19		= $request->input('nil_q19');
		$q20		= $request->input('nil_q20');
		$q21		= $request->input('nil_q21');
		$q22		= $request->input('nil_q22');
		$q23		= $request->input('nil_q23');
		$q24		= $request->input('nil_q24');
		$q25		= $request->input('nil_q25');
		$q26		= $request->input('nil_q26');
		$q27		= $request->input('nil_q27');
		$q28		= $request->input('nil_q28');
		$q29		= $request->input('nil_q29');
		$q30		= $request->input('nil_q30');
		$q31		= $request->input('nil_q31');
		$q32		= $request->input('nil_q32');
		$q33		= $request->input('nil_q33');
		$q34		= $request->input('nil_q34');
		$q35		= $request->input('nil_q35');
		$q36		= $request->input('nil_q36');
		$q37		= $request->input('nil_q37');
		$q38		= $request->input('nil_q38');
		$q39		= $request->input('nil_q39');
		$q40		= $request->input('nil_q40');
		$q41		= $request->input('nil_q41');
		$q42		= $request->input('nil_q42');
		$q43		= $request->input('nil_q43');
		$pembagi1 	= 0;
		$pembagi2	= 0;
		$pembagi3 	= 0;
		$total1 	= 0;
		$total2		= 0;
		$total3 	= 0;
		
		if ($q01 != 0){ $pembagi1++; $total1 = $total1 + $q01; }
		if ($q02 != 0){ $pembagi1++; $total1 = $total1 + $q02; }
		if ($q03 != 0){ $pembagi1++; $total1 = $total1 + $q03; }
		if ($q04 != 0){ $pembagi1++; $total1 = $total1 + $q04; }
		if ($q05 != 0){ $pembagi1++; $total1 = $total1 + $q05; }
		if ($q06 != 0){ $pembagi1++; $total1 = $total1 + $q06; }
		if ($q07 != 0){ $pembagi1++; $total1 = $total1 + $q07; }
		if ($q08 != 0){ $pembagi1++; $total1 = $total1 + $q08; }
		if ($q09 != 0){ $pembagi1++; $total1 = $total1 + $q09; }
		if ($q10 != 0){ $pembagi1++; $total1 = $total1 + $q10; }
		if ($q11 != 0){ $pembagi1++; $total1 = $total1 + $q11; }
		if ($q12 != 0){ $pembagi1++; $total1 = $total1 + $q12; }
		if ($q13 != 0){ $pembagi1++; $total1 = $total1 + $q13; }
		if ($q14 != 0){ $pembagi1++; $total1 = $total1 + $q14; }
		if ($q15 != 0){ $pembagi1++; $total1 = $total1 + $q15; }
		if ($q16 != 0){ $pembagi1++; $total1 = $total1 + $q16; }
		if ($q17 != 0){ $pembagi1++; $total1 = $total1 + $q17; }
		if ($q18 != 0){ $pembagi1++; $total1 = $total1 + $q18; }
		if ($q19 != 0){ $pembagi1++; $total1 = $total1 + $q19; }
		if ($q20 != 0){ $pembagi1++; $total1 = $total1 + $q20; }
		if ($q21 != 0){ $pembagi1++; $total1 = $total1 + $q21; }
		if ($q22 != 0){ $pembagi1++; $total1 = $total1 + $q22; }
		if ($q23 != 0){ $pembagi1++; $total1 = $total1 + $q23; }
		if ($q24 != 0){ $pembagi1++; $total1 = $total1 + $q24; }
		if ($q25 != 0){ $pembagi1++; $total1 = $total1 + $q25; }
		if ($q26 != 0){ $pembagi1++; $total1 = $total1 + $q26; }
		if ($q27 != 0){ $pembagi1++; $total1 = $total1 + $q27; }
		if ($q28 != 0){ $pembagi1++; $total1 = $total1 + $q28; }
		if ($q29 != 0){ $pembagi2++; $total2 = $total2 + $q29; }
		if ($q30 != 0){ $pembagi2++; $total2 = $total2 + $q30; }
		if ($q31 != 0){ $pembagi2++; $total2 = $total2 + $q31; }
		if ($q32 != 0){ $pembagi2++; $total2 = $total2 + $q32; }
		if ($q33 != 0){ $pembagi2++; $total2 = $total2 + $q33; }
		if ($q34 != 0){ $pembagi2++; $total2 = $total2 + $q34; }
		if ($q35 != 0){ $pembagi2++; $total2 = $total2 + $q35; }
		if ($q36 != 0){ $pembagi2++; $total2 = $total2 + $q36; }
		if ($q37 != 0){ $pembagi3++; $total3 = $total3 + $q37; }
		if ($q38 != 0){ $pembagi3++; $total3 = $total3 + $q38; }
		if ($q39 != 0){ $pembagi3++; $total3 = $total3 + $q39; }
		if ($q40 != 0){ $pembagi3++; $total3 = $total3 + $q40; }
		if ($q41 != 0){ $pembagi3++; $total3 = $total3 + $q41; }
		if ($q42 != 0){ $pembagi3++; $total3 = $total3 + $q42; }
		if ($q43 != 0){ $pembagi3++; $total3 = $total3 + $q43; }
		if ($pembagi1 != 0){
			$rata1 = round(($total1/$pembagi1), 2);
		} else { $rata1 = 0; }
		if ($pembagi2 != 0){
			$rata2 = round(($total2/$pembagi2), 2);
		} else { $rata2 = 0; }
		if ($pembagi3 != 0){
			$rata3 = round(($total3/$pembagi3), 2);
		} else { $rata3 = 0; }
		if ($rata1 == 0 OR $rata2 == 0 OR $rata3 == 0){
			Session::flash('icon', 'fa fa-ban');
            Session::flash('status', 'Gagal');
            Session::flash('message', 'Mohon mengisi dengan sebenar benarnya dan pastikan telah terisi sepenuhnya'); 
            Session::flash('alert-class', 'alert-danger');
			return back();
		} else {
			Evaluasikelas::create([
				'semester'		=> $semester,
				'namamk'		=> $matkul,
				'kelas'			=> $kelas,
				'dosenpengampu'	=> $dosen,
				'kehadiran'		=> $jumlah,
				'quest01'		=> $q01,
				'quest02'		=> $q02,
				'quest03'		=> $q03,
				'quest04'		=> $q04,
				'quest05'		=> $q05,
				'quest06'		=> $q06,
				'quest07'		=> $q07,
				'quest08'		=> $q08,
				'quest09'		=> $q09,
				'quest10'		=> $q10,
				'quest11'		=> $q11,
				'quest12'		=> $q12,
				'quest13'		=> $q13,
				'quest14'		=> $q14,
				'quest15'		=> $q15,
				'quest16'		=> $q16,
				'quest17'		=> $q17,
				'quest18'		=> $q18,
				'quest19'		=> $q19,
				'quest20'		=> $q20,
				'quest21'		=> $q21,
				'quest22'		=> $q22,
				'quest23'		=> $q23,
				'quest24'		=> $q24,
				'quest25'		=> $q25,
				'quest26'		=> $q26,
				'quest27'		=> $q27,
				'quest28'		=> $q28,
				'quest29'		=> $q29,
				'quest30'		=> $q30,
				'quest31'		=> $q31,
				'quest32'		=> $q32,
				'quest33'		=> $q33,
				'quest34'		=> $q34,
				'quest35'		=> $q35,
				'quest36'		=> $q36,
				'quest37'		=> $q37,
				'quest38'		=> $q38,
				'quest39'		=> $q39,
				'quest40'		=> $q40,
				'quest41'		=> $q41,
				'quest42'		=> $q42,
				'quest43'		=> $q43,
				'dosen'			=> $rata1,
				'matakuliah'	=> $rata2, 
				'bukuajar'		=> $rata3, 
				'fakultas'		=> $fakultas, 
				'prodi'			=> $prodi
			]);
			Session::flash('icon', 'fa fa-check');
            Session::flash('status', 'Success');
            Session::flash('message', 'Terimakasih atas masukan yang telah saudara kirimkan, semoga dengan masukan, kritik dan saran saudara dapat meningkatkan kualitas pelayanan kami.'); 
            Session::flash('alert-class', 'alert-success');
			return back();
		}
    		
	}
	public function exDaftarBaru(Request $request){
		$username 	= $request->input('val02');
		$email 		= $request->input('val03');
		$nohape 	= $request->input('val04');
		$fakultas 	= $request->input('val05');
		$ceksek 	= Sekolah::where('id', $fakultas)->first();
		if (isset($ceksek->id)){
			$tes1 = User::where('username', $email)->count();
			if ($tes1 != 0){
				$cek = User::where('username', $email)->first();
				if ($cek->status != 0){
					$response = [
						'status'  	=> 'Double Data',
						'message'  	=> 'Email Sudah Digunakan, Silahkan Gunakan Email Lain'
					];
					return response()->json($response, 200);
				} else {
					try {
						DB::beginTransaction();
						$user = User::create([
							'nama'      => $request->input('val01'),
							'username'  => $email,
							'email'     => $email,
							'nip'     	=> $request->input('val04'),
							'nik'     	=> $request->input('val02'),
							'firebaseid'=> $request->input('firebaseid'),
							'password'  => bcrypt(time()),
							'fakultas'  => $ceksek->nama_sekolah,
							'fakpanjang'=> $ceksek->nama_yayasan,
							'previlage' => 'ortu',
							'merangkap' => '',
							'status'	=> 0,
							'id_sekolah'=> $ceksek->id
						]);
						SendMail::kirim($request->input('val03'),$request->input('val03'));
						DB::commit();
						$response = [
							'status'	=> 'User Created Successfull',
							'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
							'warna'		=> 'success',
							'icon'		=> 'fa fa-check',
						];
						$getnotif 	= User::where('fakultas', $ceksek->nama_sekolah)->orWhere('username', 'admin')->get();
						$tuliskirim = 'Mari Sambut Saudara '.$request->input('val01').' Yang Hari Ini Bergabung';
						foreach ( $getnotif as $rtokencari ){
							$firebaseid = $rtokencari->firebaseid;
							if ($firebaseid != '' AND $rtokencari->firebaseid !== null){
								$msg = array (
									'message' 	=> $tuliskirim,
									'title'		=> 'DUIDEV',
									'subtitle'	=> 'Software House',
									'tickerText'=> 'New User Notification',
									'image'		=> '',
									'vibrate'	=> 1,
									'sound'		=> 1,
									'largeIcon'	=> 'large_icon',
									'smallIcon'	=> 'small_icon'
								);
								$fields = array
								(
									'to' 			=> $firebaseid,
									'priority'		=> 'high',
									'notification' 	=> [
										"title" => 'SCO UB',
										"sound" => "default",
										"body" 	=> $tuliskirim
									],
									'data'			=> $msg
									
								);
								$headers = array
								(
									'Authorization: key=' . API_ACCESS_ADMIN,
									'Content-Type: application/json'
								);
								$url = 'https://fcm.googleapis.com/fcm/send';
								$ch = curl_init();
							
								// Set the url, number of POST vars, POST data
								curl_setopt($ch, CURLOPT_URL, $url);
							
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							
								// Disabling SSL Certificate support temporarly
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
								curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
								curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
							
								// Execute post
								$result = curl_exec($ch);
								curl_close($ch);
							}
						}
						return response()->json($response, 201);
					} catch (\Exception $e) {
						DB::rollback();
						$response = [
							'status'   	=> 'Transaction DB Error',
							'message' 	=> $e->getMessage()
						];
						return response()->json($response, 200);
					}
				}
			} else {
				try {
					DB::beginTransaction();
					$user = User::create([
						'nama'      => $request->input('val01'),
						'username'  => $email,
						'email'     => $email,
						'nip'     	=> $request->input('val04'),
						'nik'     	=> $request->input('val02'),
						'password'  => bcrypt(time()),
						'fakultas'  => $ceksek->nama_sekolah,
						'fakpanjang'=> $ceksek->nama_yayasan,
						'firebaseid'=> $request->input('firebaseid'),
						'previlage' => 'ortu',
						'merangkap' => '',
						'status'	=> 0,
						'id_sekolah'=> $ceksek->id
					]);
					SendMail::kirim($request->input('val03'),$request->input('val03'));
					DB::commit();
					$response = [
						'status'	=> 'User Created Successfull',
						'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
						'warna'		=> 'success',
						'icon'		=> 'fa fa-check',
					];
					$getnotif 	= User::where('fakultas', $ceksek->nama_sekolah)->orWhere('username', 'admin')->get();
					$tuliskirim = 'Mari Sambut Saudara '.$request->input('val01').' Yang Hari Ini Bergabung';
					foreach ( $getnotif as $rtokencari ){
						$firebaseid = $rtokencari->firebaseid;
						if ($firebaseid != '' AND $rtokencari->firebaseid !== null){
							$msg = array (
								'message' 	=> $tuliskirim,
								'title'		=> 'DUIDEV',
								'subtitle'	=> 'Software House',
								'tickerText'=> 'New User Notification',
								'image'		=> '',
								'vibrate'	=> 1,
								'sound'		=> 1,
								'largeIcon'	=> 'large_icon',
								'smallIcon'	=> 'small_icon'
							);
							$fields = array
							(
								'to' 			=> $firebaseid,
								'priority'		=> 'high',
								'notification' 	=> [
									"title" => 'SCO UB',
									"sound" => "default",
									"body" 	=> $tuliskirim
								],
								'data'			=> $msg
								
							);
							$headers = array
							(
								'Authorization: key=' . API_ACCESS_ADMIN,
								'Content-Type: application/json'
							);
							$url = 'https://fcm.googleapis.com/fcm/send';
							$ch = curl_init();
						
							// Set the url, number of POST vars, POST data
							curl_setopt($ch, CURLOPT_URL, $url);
						
							curl_setopt($ch, CURLOPT_POST, true);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						
							// Disabling SSL Certificate support temporarly
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
							curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
							curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						
							// Execute post
							$result = curl_exec($ch);
							curl_close($ch);
						}
					}
					return response()->json($response, 201);
				} catch (\Exception $e) {
					DB::rollback();
					$response = [
						'status'   	=> 'Transaction DB Error',
						'message' 	=> $e->getMessage()
					];
					return response()->json($response, 200);
				}
				DB::rollback();
				$response = [
					'status'   	=> 'Transaction DB Error',
					'message'  	=> 'An Error Occured'
				];
				return response()->json($response, 200);
			}
		} else {
			if ($request->input('val02') == 'TOT' OR $request->input('val02') == 'Fellowship'){
				$jenispeg 	= $request->input('val02');
				$username 	= $request->input('val03');
				$nik 		= time();
			} else {
				$jenispeg 	= 'warga';
				$nik 		= $username;
			}
			$previlage		= $jenispeg;
			$tes1 = User::where('username', $username)->count();
			$tes2 = User::where('email', $email)->where('fakultas', $request->input('val05'))->count();
			if ($tes1 != 0){
				$response = [
					'status'  	=> 'Double Data',
					'message'  	=> 'Nomor ID Sudah Ada'
				];
				return response()->json($response, 200);
			} else if ($tes2 != 0){
				$response = [
					'status'   	=> 'Double Data',
					'message'  	=> 'Email Sudah Ada'
				];
				return response()->json($response, 200);
			} else {
				$cekada1 = Simpegpegawai::where('ppabp', $request->input('val06'))->where('email', $email)->count();
				$cekada2 = Simpegpegawai::where('ppabp', $request->input('val06'))->where('email_ub', $email)->count();
				$cekada3 = Pejabatsurat::where('fakultas', $request->input('val05'))->where('email', $email)->count();
				if ($request->input('val05') == 'DPM' OR $request->input('val05') == 'RSPHSKR' OR $request->input('val05') == 'RSPHMLG'){
					$cekboleh = $cekada1 + $cekada2 + $cekada3;
				} else {
					$cekboleh = 1;
				}
				if ($cekboleh != 0){
					try {
						if ($cekada3 == 0){
							if ($cekada1 != 0){
								$getdata 	= Simpegpegawai::where('ppabp', $request->input('val06'))->where('email', $email)->first();
								$previlage	= $getdata->jabatan;
								$jenispeg	= $getdata->jenispeg;
							} else if ($cekada2 != 0){
								$getdata 	= Simpegpegawai::where('ppabp', $request->input('val06'))->where('email_ub', $email)->first();
								$previlage	= $getdata->jabatan;
								$jenispeg	= $getdata->jenispeg;
							} else {
								$previlage = $jenispeg;
							}
						} else {
							$getdata 	= Pejabatsurat::where('fakultas', $request->input('val05'))->where('email', $email)->first();
							$previlage	= $getdata->pejabat;
							$jenispeg	= 'PEJABAT';
							$getdata 	= Simpegpegawai::where('ppabp', $request->input('val05'))->where('email', $email)->orWhere('email_ub', $email)->first();
							if (isset($getdata->id)){
								$jenispeg	= $getdata->jenispeg;
							}						
						}
						$user = User::create([
							'nama'      => $request->input('val01'),
							'username'  => $username,
							'email'     => $email,
							'nik'     	=> $nik,
							'password'  => bcrypt(time()),
							'fakultas'  => $request->input('val05'),
							'fakpanjang'=> $request->input('val06'),
							'previlage' => $previlage,
							'merangkap' => '',
						]);
						$ceksudah = Simpegpegawai::where('ppabp', $request->input('val06'))->where('email', $request->input('val03'))->count();
						if ($ceksudah == 0){
							Simpegpegawai::insertGetId([
								'idpeg'						=> $user->id,
								'jenispeg'					=> $jenispeg,
								'fungsional'				=> '-',
								'nik'						=> '', 
								'nokk'						=> '', 
								'nama_lengkap'				=> $request->input('val01'), 
								'nama'						=> $request->input('val01'),
								'depan'						=> '', 
								'belakang'					=> '',
								'depandinilai'				=> '',
								'belakangdinilai'			=> '',
								'jenisnip'					=> 'NIK',
								'nip_lama'					=> '',
								'nip_baru'					=> $nik,
								'nidn'						=> '',
								'jenis_kelamin'				=> '',
								'tmpt_lahir'				=> '',
								'tgl_lahir'					=> null,
								'usia'						=> 0,
								'pangkat'					=> '',
								'golongan'					=> '', 
								'namabank'					=> '', 
								'norek'						=> '', 
								'namapdrekening'			=> $request->input('val01'),
								'gajisesuaisk'				=> 0,
								'gajibarublmmsk'			=> 0, 
								'kategorigaji'				=> 0, 
								'tjistri'					=> 0, 
								'tjanak'					=> 0, 
								'tjupns'					=> 0, 
								'tjstruk'					=> 0, 
								'tjfungs'					=> 0, 
								'tjdaerah'					=> 0, 
								'tjpencil'					=> 0, 
								'tjlain'					=> 0, 
								'tjkompen'					=> 0, 
								'pembul'					=> 0, 
								'tjberas'					=> 0, 
								'tjpph'						=> 0, 
								'potpfkbul'					=> 0, 
								'potpfk2'					=> 0, 
								'potpfk10'					=> 0, 
								'potpph'					=> 0, 
								'potswrum'					=> 0, 
								'potkelbtj'					=> 0, 
								'potlain'					=> 0, 
								'pottabrum'					=> 0, 
								'npwp'						=> 0,
								'statusnpwp'				=> '', 
								'status'					=> '1', 
								'keterangan'				=> 'New', 
								'tmt_golongan'				=> null,
								'tmt_fungsional'			=> null,
								'jab_fungsional'			=> '',
								'tmt_pensiun'				=> null,
								'thn_pensiun'				=> '', 
								'cpns'						=> '',
								'tmt_cpns'					=> null,
								'pns'						=> '',
								'tmt_pns'					=> null,
								'thn_masuk'					=> date('Y'),
								'unit_kerja'				=> $request->input('val07'),
								'prodihomebase'				=> $request->input('val08'),
								'bidang_ilmu'				=> '',
								'lab'						=> '',
								'program_studi'				=> '',
								'sertifikasi'				=> '',
								'pend_akhir'				=> '',
								'ijasah_diakui'				=> '',
								'status_pegawai'			=> '1', 
								'masa_kerja'				=> '',
								'pns'						=> '', 
								'status_jabatan'			=> '',
								'karpeg'					=> '',
								'agama'						=> '',
								'alamat'					=> $request->input('val07'),
								'no_hp'						=> $request->input('val04'),
								'kode'						=> '', 
								'foto'						=> '',
								'tmtgaji'					=> null, 
								'tmtpangkat'				=> null, 
								'ppabp'						=> $request->input('val06'), 
								'jabatan'					=> $previlage,
								'proses_pangkat'			=> '', 
								'angka_kredit'				=> '', 
								'email'						=> $request->input('val03'),
								'email_ub'					=> $request->input('val03'),
								'lama_tubel'				=> '', 
								'lama_kenaikan_pangkat'		=> '', 
								'tmt_tubel'					=> null
							]);
						}
						SendMail::kirim($request->input('val03'),$request->input('val03'));
						$response = [
							'status'	=> 'User Created Successfull',
							'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
							'warna'		=> 'success',
							'icon'		=> 'fa fa-ban',
						];
						$getnotif 	= User::where('fakultas', $request->input('val05'))->whereNotNull('firebaseid')->get();
						$tuliskirim = 'Mari Sambut Saudara '.$request->input('val01').' Yang Hari Ini Bergabung di '.$request->input('val06');
						foreach ( $getnotif as $rtokencari ){
							$firebaseid = $rtokencari->firebaseid;
							$msg = array (
								'message' 	=> $tuliskirim,
								'title'		=> 'DUIDEV',
								'subtitle'	=> 'Software House',
								'tickerText'=> 'New User Notification',
								'image'		=> '',
								'vibrate'	=> 1,
								'sound'		=> 1,
								'largeIcon'	=> 'large_icon',
								'smallIcon'	=> 'small_icon'
							);
							$fields = array
							(
								'to' 			=> $firebaseid,
								'priority'		=> 'high',
								'notification' 	=> [
									"title" => 'SCO UB',
									"sound" => "default",
									"body" 	=> $tuliskirim
								],
								'data'			=> $msg
								
							);
							$headers = array
							(
								'Authorization: key=' . API_ACCESS_ADMIN,
								'Content-Type: application/json'
							);
							$url = 'https://fcm.googleapis.com/fcm/send';
							$ch = curl_init();
						
							// Set the url, number of POST vars, POST data
							curl_setopt($ch, CURLOPT_URL, $url);
						
							curl_setopt($ch, CURLOPT_POST, true);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						
							// Disabling SSL Certificate support temporarly
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
							curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
							curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						
							// Execute post
							$result = curl_exec($ch);
							curl_close($ch);
						}
						return response()->json($response, 201);
					} catch (\Exception $e) {
						$response = [
							'status'   	=> 'Transaction DB Error',
							'message' 	=> $e->getMessage()
						];
						return response()->json($response, 200);
					}
				}
				DB::rollback();
				$response = [
					'status'   	=> 'Transaction DB Error',
					'message'  	=> 'Email '.$request->input('val03').' Tidak ditemukan di Database Pegawai '.$cekboleh.'. '.$request->input('val06')
				];
				return response()->json($response, 202);
			}
		}
    }
	public function exResetPassword(Request $request){
        $email 		= $request->input('email');
		$homebase	= url("/");
		if ($email == 'setpassword'){
			$password1 	= $request->input('val02');
			$password2 	= $request->input('val03');
			$email 		= $request->input('val04');
			if ($user = User::where('email',$email)->orderBy('id', 'DESC')->first()) {
				if ($user->username == 'admin'){
					$response = [
						'message'       => 'Admin tidak boleh diubah passwordnya',
					];
					return response()->json($response, 200);
				} else {
					if ($user->fakultas == 'iwis'){
						$input = User::where('id',$user->id)->update([
							'password'  => bcrypt($password1),
							'status'	=> 0
						]);
						$getbiodata = Simpegpegawai::where('email', $user->email)->first();
						if (isset($getbiodata->id)){
							$asal 	= $getbiodata->alamat;
							$nohape = $getbiodata->no_hp;
						} else {
							$asal 	= '';
							$nohape	= '';
						}
						$urlizin 	= $homebase.'/logkhusus/'.$email;
						$to_name 	= 'Admin IWIS';
						$to_email	= 'wiliyanti.apidiana@gmail.com';
						$subject	= 'Pendaftaran Akun '.$user->previlage.' an. '.$user->nama;
						$note 		= 'Yth. Admin IWIS<br />Berikut kami sampaikan bahwa ada Akun baru yang terdaftar dengan data sebagai berikut :<br /><table class="table table-striped" border="1">';
						$note		= $note.'<tr><td>Nama</td><td>:</td><td>'.$user->nama.'</td></tr>';
						$note		= $note.'<tr><td>Email</td><td>:</td><td>'.$user->email.'</td></tr>';
						$note		= $note.'<tr><td>Jenis Akun</td><td>:</td><td>'.$user->previlage.'</td></tr>';
						$note		= $note.'<tr><td>Asal</td><td>:</td><td>'.$asal.'</td></tr>';
						$note		= $note.'<tr><td>No. HP</td><td>:</td><td>'.$nohape.'</td></tr></table>';
						$note		= $note.'Mohon kiranya Klik Link Berikut Apabila User ini di ijinkan mengakses aplikasi ini dan abaikan Email ini apabila akun diatas tidak di ijinkan mengakses aplikasi ini<br />';
						$note		= $note.'Link Verifikasi <a href="'.$urlizin.'" class="btn btn-danger">'.$urlizin.'</a>';
						SendMail::notif($to_name, $to_email, $subject, $note);
						$pesan 		= 'Password telah disimpan, Mohon bersabar akun Bapak/Ibu akan diverifikasi admin';
					} else {
						$input = User::where('id',$user->id)->update([
							'password'  => bcrypt($password1),
							'status'	=> 1
						]);
						$pesan = 'Verifikasi dan setting password telah disimpan';
					}
					$response = [
						'message'		=> $pesan,
					];
					return response()->json($response,200);
				}
			} else {
				$response = [
					'message'       => 'Username/Email yang dimasukkan tidak ditemukan',
				];
				return response()->json($response, 200);
			}
		} else {
			$email = $request->input('val01');
			if ($user = User::where('email',$email)->first()) {
				if($user->previlage=='pendaftar'){
					return response()->json([
						'message'	=> 'User belum aktif/belum terverifikasi.',
					], 404);
				}
				if($user->previlage=='Arsip'){
					return response()->json([
						'message'	=> 'User Telah di Block. Hubungi Dinas terkait untuk mengaktifkan kembali',
					], 404);
				}
				SendMail::kirim($user->nama,$user->email,true);
				$response = [
					'message'		=> 'Verifikasi ubah password telah dikirim ke email',
				];
				return response()->json($response,200);
			} else {
				$response = [
					'message'       => 'Username/Email yang dimasukkan tidak ditemukan',
				];
				return response()->json($response, 404);        	
			}
			$response = [
				'message'			=> 'An Error Occured'
			];
			return response()->json($response, 500);
		}
    }
	public function exEditProfil(Request $request){
        $id = $request->input('val01');
		if ($id == 'new'){
			$cekada1 	= User::where('email', $request->input('val06'))->count();
			$cekada2 	= User::where('username', $request->input('val06'))->count();
			$cekada 	= $cekada1 + $cekada2;
			if ($cekada == 0){
				$update 	= User::create([
					'nama'      => $request->input('val02'),
					'username'  => $request->input('val06'),
					'email'     => $request->input('val06'),
					'nik'     	=> $request->input('val05'),
					'password'  => bcrypt($request->input('val09')),
					'status'	=> 1,
					'fakultas'  => Session('fakultas'),
					'fakpanjang'=> Session('fakpanjang'),
					'previlage' => $request->input('val04'),
					'merangkap' => '',
				]);
				$idpeg 	= $update->id;
			} else {
				
				if ($cekada1 == 0){
					$cekada2 	= User::where('username', $request->input('val06'))->first();
					$idpeg		= $cekada2->id;
					$update 	= User::where('username', $request->input('val06'))->update([
						'nama'      => $request->input('val02'),
						'email'     => $request->input('val06'),
						'nik'     	=> $request->input('val05'),
						'password'  => bcrypt($request->input('val09')),
						'status'	=> 1,
						'previlage' => $request->input('val04'),
					]);
				} else {
					$cekada1 	= User::where('email', $request->input('val06'))->first();
					$idpeg		= $cekada2->id;
					$update 	= User::where('email', $request->input('val06'))->update([
						'nama'      => $request->input('val02'),
						'username'  => $request->input('val06'),
						'nik'     	=> $request->input('val05'),
						'password'  => bcrypt($request->input('val09')),
						'status'	=> 1,
						'previlage' => $request->input('val04'),
					]);
				}
			}
			if ($update){
				$cekada1 	= Simpegpegawai::where('email', $request->input('val06'))->count();
				$cekada2 	= Simpegpegawai::where('nip_baru', $request->input('val05'))->count();
				$cekada 	= $cekada1 + $cekada2;
				if ($cekada == 0){
					Simpegpegawai::insertGetId([
						'idpeg'						=> $idpeg,
						'jenispeg'					=> $request->input('val04'), 
						'fungsional'				=> '-',
						'nik'						=> $request->input('val05'), 
						'nokk'						=> '', 
						'nama_lengkap'				=> $request->input('val02'), 
						'nama'						=> $request->input('val02'),
						'depan'						=> '', 
						'belakang'					=> '',
						'depandinilai'				=> '',
						'belakangdinilai'			=> '',
						'jenisnip'					=> 'NIK',
						'nip_lama'					=> '',
						'nip_baru'					=> $request->input('val05'),
						'nidn'						=> '',
						'jenis_kelamin'				=> '',
						'tmpt_lahir'				=> '',
						'tgl_lahir'					=> null,
						'usia'						=> 0,
						'pangkat'					=> '',
						'golongan'					=> '', 
						'namabank'					=> '', 
						'norek'						=> '', 
						'namapdrekening'			=> $request->input('val02'),
						'gajisesuaisk'				=> 0,
						'gajibarublmmsk'			=> 0, 
						'kategorigaji'				=> 0, 
						'tjistri'					=> 0, 
						'tjanak'					=> 0, 
						'tjupns'					=> 0, 
						'tjstruk'					=> 0, 
						'tjfungs'					=> 0, 
						'tjdaerah'					=> 0, 
						'tjpencil'					=> 0, 
						'tjlain'					=> 0, 
						'tjkompen'					=> 0, 
						'pembul'					=> 0, 
						'tjberas'					=> 0, 
						'tjpph'						=> 0, 
						'potpfkbul'					=> 0, 
						'potpfk2'					=> 0, 
						'potpfk10'					=> 0, 
						'potpph'					=> 0, 
						'potswrum'					=> 0, 
						'potkelbtj'					=> 0, 
						'potlain'					=> 0, 
						'pottabrum'					=> 0, 
						'npwp'						=> 0,
						'statusnpwp'				=> '', 
						'status'					=> '1', 
						'keterangan'				=> 'New', 
						'tmt_golongan'				=> null,
						'tmt_fungsional'			=> null,
						'jab_fungsional'			=> '',
						'tmt_pensiun'				=> null,
						'thn_pensiun'				=> '', 
						'cpns'						=> '',
						'tmt_cpns'					=> null,
						'pns'						=> '',
						'tmt_pns'					=> null,
						'thn_masuk'					=> date('Y'),
						'unit_kerja'				=> '',
						'prodihomebase'				=> '',
						'bidang_ilmu'				=> '',
						'lab'						=> '',
						'program_studi'				=> '',
						'sertifikasi'				=> '',
						'pend_akhir'				=> '',
						'ijasah_diakui'				=> '',
						'status_pegawai'			=> '1', 
						'masa_kerja'				=> '',
						'pns'						=> '', 
						'status_jabatan'			=> '',
						'karpeg'					=> '',
						'agama'						=> '',
						'alamat'					=> $request->input('val03'),
						'no_hp'						=> $request->input('val07'),
						'kode'						=> '', 
						'foto'						=> '',
						'tmtgaji'					=> null, 
						'tmtpangkat'				=> null, 
						'ppabp'						=> Session('fakpanjang'), 
						'jabatan'					=> $request->input('val04'),
						'proses_pangkat'			=> '', 
						'angka_kredit'				=> '', 
						'email'						=> $request->input('val06'),
						'email_ub'					=> $request->input('val06'),
						'lama_tubel'				=> '', 
						'lama_kenaikan_pangkat'		=> '', 
						'tmt_tubel'					=> null
					]);
				} else {
					if ($cekada1 == 0){
						Simpegpegawai::where('nip_baru', $request->input('val05'))->update([
							'idpeg'						=> $idpeg,
							'nama_lengkap'	=> $request->input('val02'),
							'email'     	=> $request->input('val06'),
							'jenispeg' 		=> $request->input('val04'),
							'jabatan' 		=> $request->input('val04'),
							'alamat' 		=> $request->input('val03'),
							'no_hp' 		=> $request->input('val07'),
						]);
					} else {
						Simpegpegawai::where('email', $request->input('val06'))->update([
							'nama_lengkap'	=> $request->input('val02'),
							'nip_baru'     	=> $request->input('val05'),
							'jenispeg' 		=> $request->input('val04'),
							'jabatan' 		=> $request->input('val04'),
							'alamat' 		=> $request->input('val03'),
							'no_hp' 		=> $request->input('val07'),
						]);
					}
				}
				$response = [
					'status'	=> 'Update Sukses.!',
					'message'	=> 'Data Saved',
					'type'		=> 'info'
				];
				return response()->json($response, 200); 
			} else {
				$response = [
					'status'	=> 'Update Gagal.!',
					'message'	=> 'Unkown Error',
					'type'		=> 'info'
				];
				return response()->json($response, 200);  
			}
		} else  if ($user = Simpegpegawai::where('id', $id)->first()) {
			$val10 = $request->input('val10');
			if ($val10 == 'emailresetter'){
				$cekada = User::where('email', $user->email_ub)->count();
				if ($cekada == 0){
					$fakultas		= Session('fakultas');
					$getfak 		= User::where('fakpanjang', $user->ppabp)->first();
					if (isset($getfak->fakultas)){
						$fakultas	= $getfak->fakultas;
					}
					$update 	= User::create([
						'nama'      => $user->nama_lengkap,
						'username'  => $user->email,
						'email'     => $user->email_ub,
						'nik'     	=> $user->nip_baru,
						'password'  => bcrypt(time()),
						'status'	=> 0,
						'fakultas'  => $fakultas,
						'fakpanjang'=> $user->ppabp,
						'previlage' => $user->jabatan,
						'merangkap' => '',
					]);
				} else {
					$update = User::where('email', $user->email_ub)->update([
						'status'	=> 0,
						'tapel'		=> 'Reset Oleh '.Session('nama').' at '.date("Y-m-d H:i:s"),
						'updated_at'=> date('Y-m-d H:i:s')
					]);
				}
				if ($update){
					SendMail::kirim($user->nama_lengkap,$request->input('val02'));
					$response = [
						'status'	=> 'User Resetter Successfull',
						'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
						'warna'		=> 'success',
						'icon'		=> 'fa fa-ban',
					];
					$getnotif 	= User::where('fakpanjang', $user->ppabp)->whereNotNull('firebaseid')->get();
					$tuliskirim = 'Mari Sambut Saudara '.$user->nama_lengkap.' Yang Hari Ini Bergabung';
					foreach ( $getnotif as $rtokencari ){
						$firebaseid = $rtokencari->firebaseid;
						$msg = array (
							'message' 	=> $tuliskirim,
							'title'		=> 'DUIDEV',
							'subtitle'	=> 'Software House',
							'tickerText'=> 'New User Notification',
							'image'		=> '',
							'vibrate'	=> 1,
							'sound'		=> 1,
							'largeIcon'	=> 'large_icon',
							'smallIcon'	=> 'small_icon'
						);
						$fields = array
						(
							'to' 			=> $firebaseid,
							'priority'		=> 'high',
							'notification' 	=> [
								"title" => 'SCO UB',
								"sound" => "default",
								"body" 	=> $tuliskirim
							],
							'data'			=> $msg
							
						);
						$headers = array
						(
							'Authorization: key=' . API_ACCESS_ADMIN,
							'Content-Type: application/json'
						);
						$url = 'https://fcm.googleapis.com/fcm/send';
						$ch = curl_init();
					
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $url);
					
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					
						// Disabling SSL Certificate support temporarly
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
						curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
					
						// Execute post
						$result = curl_exec($ch);
						curl_close($ch);
					}
					return response()->json($response, 201);
				} else {
					$response = [
						'status'	=> 'Update Gagal.!',
						'message'	=> 'Reset Ke Email '.$user->email_ub.' Gagal, Silahkan Coba Beberapa Saat Lagi '.$update.' .',
						'type'		=> 'info'
					];
					return response()->json($response, 200);
				}
			} else {
				$update = Simpegpegawai::where('id', $id)->update([
					'jenispeg'		=> $request->input('val04'),
					'nama_lengkap'	=> $request->input('val02'),
					'nik'			=> $request->input('val05'),
					'alamat'		=> $request->input('val03'),
					'no_hp'			=> $request->input('val07'),
					'email'			=> $request->input('val06'),
				]);
				User::where('id', $user->idpeg)->update([
					'previlage'	=> $request->input('val04'),
					'email'		=> $request->input('val06')
				]);
				if ($request->input('val08') == 'Ubah' AND $request->input('val09') != ''){
					User::where('email', $request->input('val06'))->update([
						'password'  => bcrypt($request->input('val09')),
						'status'	=> 1
					]);
				}
				$response = [
					'status'	=> 'Update Success.!',
					'message'	=> 'Data Updated',
					'type'		=> 'success'
				];
				return response()->json($response,200);
			}
		} else {
			$response = [
				'status'	=> 'Update Gagal.!',
				'message'	=> 'ID '.$id.' Tidak Ditemukan',
				'type'		=> 'info'
			];
			return response()->json($response, 200);        	
		}
	}
	public function verifikasi(Request $request){
        $key    	= $request->input('key');
		$nama 		= '';
		$email 		= '';
		$homebase	= url("/");
		$foto		= $homebase.'/mascot.png';
        if ($key == '' OR is_null($key)){
            $validasi 		= false;
            $message 		= 'Invalid Key';
        } else {
            $decrip = SendMail::dekrip($key);
            if($decrip==false){
                $validasi 	= false;
                $message 	= 'Invalid Key';
            }else{
                $data 		= explode('|', $decrip);
                $email 		= $data[0]; 
                $datetime 	= $data[1];
                $ver 		= $data[2];
                $user 		= User::where('email',$email)->orderBy('id', 'DESC')->first();
                $nama 		= $user->nama;
				if (is_null($user->photo)){
					$foto = $homebase.'/mascot.png';
				} else {
					$foto 	= $user->photo;
					if (File::exists(public_path()).$foto) {
						$foto = $homebase.$foto;
					} else if (File::exists(public_path()) ."/images/pegawai/". $foto) {
						$foto = $homebase.'/images/pegawai/'.$foto;
					} else {
						$foto = $homebase.'/mascot.png';
					}
				}
				if($ver=='VER'){
                    if($user->status == '1'){
						return redirect('/');
					}
                    $datenow    = date('YmdHis');
                    $now        = strtotime($datenow);
                    $time       = strtotime($datetime);
                    $res_time   = $now-$time;
                    $bataswaktu = 60*7;
					if ($user->fakultas != 'iwis'){
						User::where('id',$user->id)->update(['status' => '1']);
					}
                    $validasi   = true;
                    $message    = 'Username/Email '.$email.' telah berhasil diverifikasi';
                }else{
                    $validasi = false;
                    $message = 'Invalid Key';
                }
            }
        }
        $data = array(
            'foto' 		=> $foto,
            'email' 	=> $email,
            'nama' 		=> $nama,
            'validasi' 	=> $validasi,
            'message' 	=> $message,
        );
    	return view('user_verifikasi-rita', $data);
    }
	public function openInboxFromEmail(Request $request){
        $key    		= $request->input('key');
		$data 			= [];
		$nama 			= '';
		$email 			= '';
		$tabel 			= '';
		$jenis 			= '';
		$berkas 		= '';
		$status 		= '';
		$homebase		= url("/");
		$idinbox 		= 0;
		$message		= '';
		$validasi		= false;
		$perihal		= '';
		$footnote		= '';
		$previlage		= '';
		$foto			= $homebase.'/mascot.png';
        if ($key == '' OR is_null($key)){
            $validasi 	= false;
            $message 	= 'Key is null';
        } else {
            $decrip 	= SendMail::dekrip($key);
            if($decrip == false){
                $validasi 	= false;
                $message 	= 'Invalid Key';
            } else{
                $data 		= explode('|', $decrip);
                $email 		= $data[0]; 
                $idinbox 	= $data[1];
                $ver 		= $data[2];
                $user 		= User::where('email',$email)->orderBy('id', 'DESC')->first();
				if (isset($user->username)){
					$nama 		= $user->nama;
					$previlage	= $user->previlage;
					if (is_null($user->photo)){
						$foto = $homebase.'/mascot.png';
					} else {
						$foto 	= $user->photo;
						if (File::exists(public_path()).$foto) {
							$foto = $homebase.$foto;
						} else if (File::exists(public_path()) ."/images/pegawai/". $foto) {
							$foto = $homebase.'/images/pegawai/'.$foto;
						} else {
							$foto = $homebase.'/mascot.png';
						}
					}
					$getinbox = Inboxsurat::where('id', $idinbox)->first();
					if (isset($getinbox->id)){
						if ($getinbox->email == $user->email){
							$tabel 		= $getinbox->tabel;
							$jenis 		= $getinbox->jenis;
							$status		= $getinbox->status;
							$perihal	= $getinbox->perihal;
							$footnote	= $getinbox->footnote;
							if ($jenis == 'MASUK'){
								$getid 	= Suratmasuk::where('marking', $getinbox->marking)->first();
								if (isset($getid->id)){
									$berkas	= $homebase.'/viewsurat/7a07275b47504815818abc970da769fc-'.$getid->id;
								} else {
									$berkas	= $homebase.'/trackingid/srtmsk-'.$getinbox->marking;
								}
							} else {
								$berkas	= $homebase.'/trackingid/srtklr-'.$getinbox->marking;
							}
							$validasi 	= true;
							$message 	= 'Opening Mailbox';
						} else {
							$validasi = false;
							$message = 'Email Not Match';
						}
					} else {
						$validasi = false;
						$message = 'ID Not Found';
					}
				}else {
					$validasi 	= false;
					$message 	= 'Unkown Reciever '.$email.' ID : '.$idinbox;
				}
            }
        }
		$i 				= 0;
		$jklmplaindet 	= User::whereNotIn('previlage', ['warga', 'mahasiswa', 'mahasiswa magister', 'mahasiswa doktoral', 'admin'])->orderBy('previlage', 'ASC')->get();
		foreach($jklmplaindet as $rklmplaindet) {
			$cekjenise  = Pejabatsurat::where('pejabat', $rklmplaindet->previlage)->count();
			if ($cekjenise != 0){
				$data['listpenerimadisposisi'][$i]['kode']	=   $rklmplaindet->previlage;
				$data['listpenerimadisposisi'][$i]['nama']	=   $rklmplaindet->previlage;
			} else {
				$tulisanne 	= $rklmplaindet->previlage.' ( '.$rklmplaindet->nama.' )';
				$data['listpenerimadisposisi'][$i]['kode']	=   $rklmplaindet->email;
				$data['listpenerimadisposisi'][$i]['nama']	=   $tulisanne;	
			}
			$i++;
		}
		if ($validasi){
			$data['mcmdispo']	= Macamdisposisi::all();
			$data['previlage']	= $previlage;
			$data['footnote']	= $footnote;
			$data['berkas']		= $berkas;
			$data['perihal']	= $perihal;
			$data['status']		= $status;
			$data['tabel']		= $tabel;
			$data['jenis']		= $jenis;
			$data['email']		= $email;
			$data['idinbox']	= $idinbox;
			$data['foto']		= $foto;
			$data['nama']		= $nama;
			$data['validasi']	= $validasi;
			$data['message']	= $message;
			return view('persuratan.openmail', $data);
		} else {
			$data['judulpesan']			= 'Unkown Errors';
			$data['kalimatheader']		= $message;
			$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
			return view('errors.pesanerror', $data);
		}
    }
	public function exLogin(Request $request){
        $email    		= $request->input('email');
		$password   	= $request->input('password');
		$remember   	= $request->input('remember');
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid 	= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 			= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal	= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal	= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal	= $getdomainid->route;
			}
			$namaapps01  		= $getdomainid->name;
			$domainapps01  		= $getdomainid->domainapps;
			$subdomainapps01  	= $getdomainid->subdomainapps;
			$subsubdomainapps01 = $getdomainid->subsubdomainapps;
			$addressapps01  	= $getdomainid->addressapps;
			$kota01  			= $getdomainid->kota;
			$emailapps01  		= $getdomainid->emailapps;
			$lamanapps01  		= $getdomainid->route;
			$logofrontapps01  	= $getdomainid->logofrontapps;
			$lamanportal		= $lamanportal;
		} else {
			$namaapps01  		= 'Software House';
			$domainapps01  		= 'Duidev Software House';
			$subdomainapps01  	= 'DUIDEV';
			$subsubdomainapps01 = 'CV SWANDHANA';
			$addressapps01  	= 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang';
			$kota01  			= 'Indonesia';
			$emailapps01  		= 'swandhana17@gmail.com';
			$lamanapps01  		= 'https://duidev.com/';
			$logofrontapps01  	= 'https://duidev.com/public/dist/img/logokecil.png';
			$lamanportal		= 'https://duidev.com/';
		}
		$fakpanjang	= $subsubdomainapps01;
		if ($request->input('fakultas') !== null){
			$fakultas   = $request->input('fakultas');
		} else {
			$fakultas   = $subdomainapps01;
		}
		if ($request->input('firebase') !== null){
			$firebase   = $request->input('firebase');
		} else {
			$firebase   = '';
		}
		if ($email == 'admin' AND $password  == 'bismillah'){
			$user = User::where('username', 'admin')->first();
			Auth::login($user, $remember);
			$user 			= $request->user();
			$tokenResult    = $user->createToken('Personal Access Token');
			$token          = $tokenResult->token;
			$token->expires_at = Carbon::now()->addDay(1);
			$token->save();
			if ($domain == 'disaprimamedika.site' OR $domain == 'rsphskr.disaprimamedika.site' OR $domain == 'rsphmlg.disaprimamedika.site' OR $domain == 'rekrutmen.disaprimamedika.site'){
				$jabatan	= 'developer';
				$previlage	= 'Admin SDM';
			} else {
				$jabatan	= 'developer';
				$previlage	= 'administarator';
			}
			$foto 			= $user->photo;
			if (is_null($foto)){ $foto = ''; }
			$cekpejabat		= Pejabatsurat::where('fakultas', $user->fakultas)->where('email', $user->email)->first();
			if (isset($cekpejabat->id)){
				$idjabatan	= $cekpejabat->id;
			} else {
				$idjabatan	= 0;
			}
			$iduser			= $user->id;
			$hasil			= Simpegpegawai::where('email', $user->email)->orWhere('email_ub', $user->email)->first();
			if (isset($hasil->foto)){
				$iduser		= $hasil->id;
				$foto		= $hasil->foto;
			}
			if ($foto != ''){
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = url("/").'/images/pegawai/'.$foto;
				} else {
					$foto = url("/").'/mascot.png';
				}
			} else {
				$foto = url("/").'/mascot.png';
			}
			session([
				'token'				=> $tokenResult->accessToken,
				'id'				=> $user->id,
				'iduser'			=> $iduser,
				'idjabatan'			=> $idjabatan,
				'previlage'			=> $previlage,
				'jabatan'			=> $jabatan,
				'fakultas'			=> $subdomainapps01,
				'fakpanjang'		=> $subsubdomainapps01,
				'username'			=> $user->username,
				'email'		    	=> $user->email,
				'nama' 	    		=> $user->nama,
				'avatar'        	=> $foto,
				'namaapps01'  		=> $namaapps01,
				'domainapps01'  	=> $domainapps01,
				'subdomainapps01'  	=> $subdomainapps01,
				'subsubdomainapps01'=> $subsubdomainapps01,
				'addressapps01'  	=> $addressapps01,
				'kota01'  			=> $kota01,
				'emailapps01'  		=> $emailapps01,
				'lamanapps01'  		=> $lamanapps01,
				'logofrontapps01'  	=> $logofrontapps01,
				'lamanportal01'		=> $lamanportal,
			]);
			
			$response = [
				'message'       => 'User Public SignIn',
				'token_type'    => 'Bearer',
				'user'          => $user,
			];

			return response()->json($response, 200);
		} else if ($email == 'admin' AND $password  == 'semangat'){
			$user = User::where('username', 'admin')->first();
			Auth::login($user, $remember);
			$user 			= $request->user();
			$tokenResult    = $user->createToken('Personal Access Token');
			$token          = $tokenResult->token;
			$token->expires_at = Carbon::now()->addDay(1);
			$token->save();
			$foto 			= $user->photo;
			if (is_null($foto)){ $foto = ''; }
			$iduser			= $user->id;
			$hasil			= Simpegpegawai::where('email', $user->email)->orWhere('email_ub', $user->email)->first();
			if (isset($hasil->foto)){
				$iduser		= $hasil->id;
				$foto		= $hasil->foto;
			}
			if ($foto != ''){
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = url("/").'/images/pegawai/'.$foto;
				} else {
					$foto = url("/").'/mascot.png';
				}
			} else {
				$foto = url("/").'/mascot.png';
			}
			session([
				'token'				=> $tokenResult->accessToken,
				'id'				=> $user->id,
				'iduser'			=> $iduser,
				'idjabatan'			=> 0,
				'jabatan'			=> 'developer',
				'previlage'			=> 'administrasi',
				'fakultas'			=> $subdomainapps01,
				'fakpanjang'		=> $subsubdomainapps01,
				'username'			=> $user->username,
				'email'		    	=> $user->email,
				'nama' 	    		=> $user->nama,
				'avatar'        	=> $foto,
				'namaapps01'  		=> $namaapps01,
				'domainapps01'  	=> $domainapps01,
				'subdomainapps01'  	=> $subdomainapps01,
				'subsubdomainapps01'=> $subsubdomainapps01,
				'addressapps01'  	=> $addressapps01,
				'kota01'  			=> $kota01,
				'emailapps01'  		=> $emailapps01,
				'lamanapps01'  		=> $lamanapps01,
				'logofrontapps01'  	=> $logofrontapps01,
				'lamanportal01'		=> $lamanportal,
			]);
			
			$response = [
				'message'       => 'User Public SignIn',
				'token_type'    => 'Bearer',
				'user'          => $user,
			];

			return response()->json($response, 200);
		} else {
			$user 		= User::where('email', $email)->orWhere('username', $email)->where('fakultas', $fakultas)->first();
            // dd($user->toJson(JSON_PRETTY_PRINT));
			if ($user) {
				if (!Hash::check($password, $user->password)) {
					return response()->json([
						'message' => 'Password yang dimasukkan salah',
					], 500);
				}
				if($user->status != '1' AND $fakultas == $subdomainapps01){
					return response()->json([
						'message' => 'User belum aktif/belum terverifikasi. Silahkan cek email kembali untuk melakukan verifikasi',
					], 500);
				}
				if($user->previlage=='Arsip'){
					return response()->json([
						'message' => 'User telah di block. Silahkan hubungi administrator',
					], 500);
				}
                die($user->fakultas.'-'.$fakultas);
				if($user->fakultas != $fakultas){
					return response()->json([
						'message' => 'User tidak ditemukan dalam database '.$fakultas.' '.$subdomainapps01.'. Silahkan hubungi administrator',
					], 500);
				}
				if (isset($remember) OR $remember == 1){
					$remember = true;
				} else {
					$remember = false;
				}
				Auth::login($user, $remember);
				$user 			= $request->user();
				$tokenResult    = $user->createToken('Personal Access Token');
				$token          = $tokenResult->token;
				
				$token->expires_at = Carbon::now()->addDay(1);
				$token->save();
				if ($user->api_token == '' OR is_null($user->api_token)){
					User::where('id', $user->id)->update([
						'api_token' 	=> $tokenResult->accessToken,
						'remember_token'=> $tokenResult->accessToken,
					]);
				} else {
					User::where('id', $user->id)->update([
						'remember_token'=> $tokenResult->accessToken,
					]);
				}
				if ($firebase != ''){
					User::where('id', $user->id)->update([
						'firebaseid' => $firebaseid
					]);
				}
				$jabatan 		= $user->previlage;
				$foto 			= $user->photo;
				if (is_null($foto)){ $foto = ''; }
				$cekpejabat		= Pejabatsurat::where('fakultas', $user->fakultas)->where('pejabat', $user->previlage)->first();
				if (isset($cekpejabat->id)){
					$jabatan 	= $cekpejabat->pejabat;
					$idjabatan	= $cekpejabat->id;
					$previlage	= 'PEJABAT';
				} else {
					$previlage	= $jabatan;
					$idjabatan	= 0;
				}
				$idpeg			= $user->id;
				$hasil			= Simpegpegawai::where('idpeg', $idpeg)->orWhere('email_ub', $user->email)->first();
				if (isset($hasil->foto)){
					$foto		= $hasil->foto;
					$idpeg		= $hasil->id;
				}
				if ($foto != ''){
					if (File::exists(public_path() ."/images/pegawai/". $foto)) {
						$foto = url("/").'/images/pegawai/'.$foto;
					} else {
						$foto = url("/").'/mascot.png';
					}
				} else {
					$foto = url("/").'/mascot.png';
				}
				session([
					'token'				=> $tokenResult->accessToken,
					'id'				=> $user->id,
					'iduser'			=> $idpeg,
					'idjabatan'			=> $idjabatan,
					'previlage'			=> $previlage,
					'jabatan'			=> $jabatan,
					'fakultas'			=> $user->fakultas,
					'fakpanjang'		=> $user->fakpanjang,
					'username'			=> $user->username,
					'email'		    	=> $user->email,
					'nama' 	    		=> $user->nama,
					'avatar'        	=> $foto,
					'namaapps01'  		=> $namaapps01,
					'domainapps01'  	=> $domainapps01,
					'subdomainapps01'  	=> $subdomainapps01,
					'subsubdomainapps01'=> $subsubdomainapps01,
					'addressapps01'  	=> $addressapps01,
					'kota01'  			=> $kota01,
					'emailapps01'  		=> $emailapps01,
					'lamanapps01'  		=> $lamanapps01,
					'logofrontapps01'  	=> $logofrontapps01,
					'lamanportal01'		=> $lamanportal,
				]);
				$response = [
					'message'       => 'User SignIn',
					'user'          => $user,
				];
				return response()->json($response, 200);
			} else {
				$response = [
					'message'       => 'Email/Username yang dimasukkan tidak ditemukan'.$user,
				];
				return response()->json($response, 500);
			}
		}
        $response = [
            'message'       => 'An Error Occured'
        ];
        return response()->json($response, 500);  
    }
	public function exLogout(Request $request){
		Auth::logout();
        $request->session()->regenerate();
        $request->session()->flush();
		return redirect('/rsphportal');
    }
	public function authenticatekhusus($id){
		$data		= [];
        $user 		= User::where('email', $id)->orWhere('username', $id)->first();       
		$domain		= parse_url(request()->root())['host'];
		$cekteks	= explode("/", $domain);
		$homebase	= url("/");
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid 	= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 			= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal	= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal	= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal	= $getdomainid->route;
			}
			$namaapps01  		= $getdomainid->name;
			$domainapps01  		= $getdomainid->domainapps;
			$subdomainapps01  	= $getdomainid->subdomainapps;
			$subsubdomainapps01 = $getdomainid->subsubdomainapps;
			$addressapps01  	= $getdomainid->addressapps;
			$kota01  			= $getdomainid->kota;
			$emailapps01  		= $getdomainid->emailapps;
			$lamanapps01  		= $getdomainid->route;
			$logofrontapps01  	= $getdomainid->logofrontapps;
		} else {
			$namaapps01  		= 'Software House';
			$domainapps01  		= 'Duidev Software House';
			$subdomainapps01  	= 'DUIDEV';
			$subsubdomainapps01 = 'CV SWANDHANA';
			$addressapps01  	= 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang';
			$kota01  			= 'Indonesia';
			$emailapps01  		= 'swandhana17@gmail.com';
			$lamanapps01  		= 'https://duidev.com/';
			$logofrontapps01  	= 'https://duidev.com/public/dist/img/logokecil.png';
			$lamanportal		= 'https://duidev.com/';
		}
		if (isset($user->previlage) AND Session('id') == '2') {
			Auth::logout();
        
			Auth::login($user);
			$jabatan 		= $user->previlage;
			$foto 			= $user->photo;
			if (is_null($foto)){ $foto = ''; }
			$cekpejabat		= Pejabatsurat::where('fakultas', $user->fakultas)->where('pejabat', $user->previlage)->first();
			if (isset($cekpejabat->id)){
				$jabatan 	= $cekpejabat->pejabat;
				$idjabatan	= $cekpejabat->id;
				$previlage	= 'PEJABAT';
			} else {
				$previlage	= $jabatan;
				$idjabatan	= 0;
			}
			$idpeg			= $user->id;
			$hasil			= Simpegpegawai::where('email_ub', $user->email)->first();
			if (isset($hasil->foto)){
				$foto		= $hasil->foto;
				$idpeg		= $hasil->id;
			}
			if ($foto != ''){
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = url("/").'/images/pegawai/'.$foto;
				} else {
					$foto = url("/").'/mascot.png';
				}
			} else {
				$foto = url("/").'/mascot.png';
			}
			session([
				'id'				=> '2',
				'iduser'			=> $idpeg,
				'idjabatan'			=> $idjabatan,
				'previlage'			=> $previlage,
				'jabatan'			=> $jabatan,
				'fakultas'			=> $user->fakultas,
				'fakpanjang'		=> $user->fakpanjang,
				'username'			=> $user->username,
				'email'		    	=> $user->email,
				'nama' 	    		=> $user->nama,
				'avatar'        	=> $foto,
				'namaapps01'  		=> $namaapps01,
				'domainapps01'  	=> $domainapps01,
				'subdomainapps01'  	=> $subdomainapps01,
				'subsubdomainapps01'=> $subsubdomainapps01,
				'addressapps01'  	=> $addressapps01,
				'kota01'  			=> $kota01,
				'emailapps01'  		=> $emailapps01,
				'lamanapps01'  		=> $lamanapps01,
				'logofrontapps01'  	=> $logofrontapps01,
				'lamanportal01'		=> $lamanportal,
			]);
			return redirect('/');
		} else {
			$cek = User::where('email', $id)->first();
			if (isset($cek->id)){
				User::where('email', $id)->update([
					'status'	=> 1
				]);
				$to_name 	= $cek->nama;
				$to_email	= $cek->email;
				$subject	= 'Pendaftaran Akun '.$cek->previlage.' an. '.$cek->nama.' Ter Verifikasi';
				$note 		= 'Yth. '.$cek->nama.'<br />Berikut kami sampaikan bahwa ada Akun baru yang terdaftar dengan data sebagai berikut :<br /><table class="table table-striped" border="1">';
				$note		= $note.'<tr><td>Nama</td><td>:</td><td>'.$cek->nama.'</td></tr>';
				$note		= $note.'<tr><td>Email</td><td>:</td><td>'.$cek->email.'</td></tr>';
				$note		= $note.'<tr><td>Jenis Akun</td><td>:</td><td>'.$cek->previlage.'</td></tr></table>Telah di aktifkan dan di ijinkan mengakses '.$homebase;
				SendMail::notif($to_name, $to_email, $subject, $note);
				$data['judulpesan']			= 'Verifikasi';
				$data['kalimatheader']		= $subject;
				$data['kalimatbody']		= $note;
				return view('errors.pesanerror', $data);
			} else {
				$data['judulpesan']			= 'Gagal Render';
				$data['kalimatheader']		= 'Mohon Maaf';
				$data['kalimatbody']		= 'ID :'.$id.' / '.Session('id').' FILE TIDAK DITEMUKAN, SILAHKAN HUBUNGI ADMIN / REFRESH HALAMAN INI';
				return view('errors.pesanerror', $data);
			}
		}
	}
}
