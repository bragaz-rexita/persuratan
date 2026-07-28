<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\User;
use App\Chatting;
use App\Pengumuman;
use App\Sekolah;
use App\Firebasebank;
use App\Jadwalkuliah;
use App\Simpegpegawai;
use App\Models\Golongan;
use App\Models\Unitsurat;
use App\Tujuandisposisi;
use App\Models\Kelompoklain;
use App\Models\Jenissurat;
use App\Inboxsurat;
use App\Pejabatsurat;
use App\Layanan;
use App\Jadwal;
use App\Gedung;
use App\Ruang;
use App\Kendaraan;
use App\Penerimasurat;
use App\Models\Macamdisposisi;
use App\Models\Tugasdeveloper;
use App\Models\AntrianTTE;
use App\Models\Ecekdata;
use App\Models\AntrianUjian;
use App\Models\Dokarkgb;
use App\Suratkeluar;
use App\WebinarEventlist;

use Auth;
use Redirect;
use Validator;
use Session;
use DateTime;
use Carbon\Carbon;
function timeAgoF($time_ago) {
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
define( 'namaapps04', 'Penyusunan Profile Gender' );
define( 'domainapps04', 'Pemerintah Daerah' );
define( 'subdomainapps04', 'Kabupaten Pasangkayu' );
define( 'subsubdomainapps04', 'Sulawesi Barat' );
define( 'addressapps04', 'Kantor Kominfo Jalan Masjid Al Madania Jl.Ir. Soekarno Pasangkayu 91571' );
define( 'emailapps04', 'kominfo@pasangkayukab.go.id' );
define( 'lamanapps04', 'https://pasangkayu.duidev.com' );
define( 'logofrontapps04', 'logo/logofrontpasangkayu.png' );

class FrontpageController extends Controller
{
	public function AllPortal ($id){
		$homebase			= url("/");
		$data				= [];
		$data['sidebar']	= 'frontpage';
		$data['klients']	= DB::table('app_menu')->where('is_visible', '1')->get();
    	$data['firebaseid']	= $id;
		$data['welcome']	= 'Portal All Apps On Duidev Software House';
		return view('landingapps', $data);
	}
	public function viewLandingApps ($id){
		$previlage  = Session('previlage');
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		$homebase	= url("/");
		$data 		= [];
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$data['firebaseid']	= $id;
		$data['sidebar']	= 'frontpage';
		$getklien			= DB::table('app_menu')->where('is_visible', '1')->get();
    	$data['welcome']	= 'Portal All Apps On Duidev Software House';
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
			$data['namaapps01']  		= 'Software House';
			$data['domainapps01']  		= 'Duidev Software House';
			$data['subdomainapps01']  	= 'DUIDEV';
			$data['subsubdomainapps01'] = 'CV SWANDHANA';
			$data['addressapps01']  	= 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang';
			$data['kota01']  			= 'Indonesia';
			$data['emailapps01']  		= 'swandhana17@gmail.com';
			$data['lamanapps01']  		= 'https://duidev.com/';
			$data['logofrontapps01']  	= 'https://duidev.com/public/dist/img/logokecil.png';
			$data['lamanportal']		= 'https://duidev.com/';
		}
		$x      	= 0;
		if (!empty($getklien)){
			foreach ($getklien as $rows){
				$ceklaman 					= $rows->sequence;
				if ($ceklaman == 2){
					$lamanportal			= $rows->route.$rows->created_by.$rows->updated_at;
				} else if ($ceklaman == 1){
					$lamanportal			= $rows->route.$rows->updated_at;
				} else {
					$lamanportal			= $rows->route;
				}
				$data['klients'][$x]['icon']				= $rows->icon;
				$data['klients'][$x]['name']				= $rows->name;
				$data['klients'][$x]['domainapps']			= $rows->domainapps;
				$data['klients'][$x]['logofrontapps']		= $rows->logofrontapps;
				$data['klients'][$x]['subdomainapps']		= $rows->subdomainapps;
				$data['klients'][$x]['subsubdomainapps']	= $rows->subsubdomainapps;
				$data['klients'][$x]['addressapps']			= $rows->addressapps;
				$data['klients'][$x]['kota']				= $rows->kota;
				$data['klients'][$x]['emailapps']			= $rows->emailapps;
				$data['klients'][$x]['domain']				= $rows->domain;
				$data['klients'][$x]['lamanportal']			= $lamanportal;
				$x++;
			}
		}
		return view('landingapps', $data);
	}
	public function getFirebaseaccount($id){
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
		$fakultas   = $subdomainapps01;
		
		$user  		 	= User::where('firebaseid', $id)->first();
		if (isset($user->id)){
			Auth::login($user, true);
			$tokenResult    = $user->createToken('Personal Access Token');
			$token          = $tokenResult->token;
			
			$token->expires_at = Carbon::now()->addDay(1);
			$token->save();
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
			return redirect('/');
		} else {
			$jfirebase 		= Firebasebank::where('firebase', $id)->first();
			if (isset($jfirebase->id)){
				$userid 	= $jfirebase->userid;
				$user  		= User::where('id', $userid)->first();
				if (isset($user->id)){
					Auth::login($user, true);
					$tokenResult    = $user->createToken('Personal Access Token');
					$token          = $tokenResult->token;
					
					$token->expires_at = Carbon::now()->addDay(1);
					$token->save();
					User::where('id', $user->id)->update([
						'firebaseid' => $id
					]);
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
					return redirect('/');
				} else {
					return redirect('/');
				}
			} else {
				return redirect('/');
			}
		}
		
    }
	public function pasangkayuindex() {
		$previlage  = Session('previlage');
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$data 							= [];
		$getdomainid 					= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
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
			$data['namaapps01']  		= namaapps04;
			$data['domainapps01']  		= domainapps04;
			$data['subdomainapps01']  	= subdomainapps04;
			$data['subsubdomainapps01'] = subsubdomainapps04;
			$data['addressapps01']  	= addressapps04;
			$data['emailapps01']  		= emailapps04;
			$data['lamanapps01']  		= lamanapps04;
			$data['sidebar']  			= 'profil';
		}
		if ($domain == 'project.duidev.com' OR $domain == 'pasangkayu.duidev.com') {
			if ($previlage == 'warga'){
				return redirect('/profiluser');
			} else if ($previlage == 'Operator'){
				return redirect('/frontpageipm');
			} else {
				$homebase					= url("/");
				$i          				= 0;
				if ($domain == 'localhost' OR $domain == 'rita.swandhana.test/pasangkayu' OR $domain == 'rita.swandhana.test/pasangkayu#' OR $domain == 'rita.swandhana.test'){
					$f 			= FeedReader::read('https://pasangkayukab.go.id/feed/');
					foreach ($f as $item){
						$f->get_title();
						if ($i != 10){
							if (isset($f->get_items()[$i])){
								$gambar         = $f->get_image_link();
								$conten         = $f->get_items()[$i]->get_content();
								$getarrkonten   = explode("</div>", $conten);
								$konten         = $getarrkonten[0];
								if ($gambar == '' OR $gambar == 'https://pasangkayukab.go.id/'){
									$gambar = $homebase.'/dist/assets/media/bg/400.jpg';
								} else {
									$pisahg = explode('src="', $gambar);
									if (isset($pisahg[1])){
										$gambar = $pisahg[1];
										$pisahn = explode('"', $gambar);
										$gambar = $pisahn[0];
									}
								}
								$berita[$i]['title']    = $f->get_items()[$i]->get_title();
								$berita[$i]['conten']   = $f->get_items()[$i]->get_content();
								$berita[$i]['deskripsi']= $f->get_items()[$i]->get_description();
								$berita[$i]['tanggal']  = $f->get_items()[$i]->get_local_date();
								$berita[$i]['gambar']   = $gambar;
								$berita[$i]['link']     = $f->get_items()[$i]->get_link();
								$i++;
							}
						}
					}
					$data['berita']  	= $berita;
					return view('projectipm.dashboard-local', $data);
				}else {
					$data['berita']  	= null;
					return view('projectipm.dashboard-rita', $data);
				}
			}
		} else {
			return Redirect::to('/');
		}
	}
	public function lamonganindex() {
		$previlage  = Session('previlage');
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$data 							= [];
		$getdomainid 					= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
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
			$data['namaapps01']  		= namaapps04;
			$data['domainapps01']  		= domainapps04;
			$data['subdomainapps01']  	= subdomainapps04;
			$data['subsubdomainapps01'] = subsubdomainapps04;
			$data['addressapps01']  	= addressapps04;
			$data['emailapps01']  		= emailapps04;
			$data['lamanapps01']  		= lamanapps04;
			$data['sidebar']  			= 'profil';
		}
		if ($domain == 'lamongan.duidev.com') {
			if ($previlage == 'warga'){
				return redirect('/profiluser');
			} else if ($previlage == 'Operator'){
				return redirect('/frontpageipm');
			} else {
				$homebase					= url("/");
				$i          				= 0;
				if ($domain == 'localhost' OR $domain == 'rita.swandhana.test/pasangkayu' OR $domain == 'rita.swandhana.test/pasangkayu#' OR $domain == 'rita.swandhana.test'){
					$f 			= FeedReader::read('https://pasangkayukab.go.id/feed/');
					foreach ($f as $item){
						$f->get_title();
						if ($i != 10){
							if (isset($f->get_items()[$i])){
								$gambar         = $f->get_image_link();
								$conten         = $f->get_items()[$i]->get_content();
								$getarrkonten   = explode("</div>", $conten);
								$konten         = $getarrkonten[0];
								if ($gambar == '' OR $gambar == 'https://pasangkayukab.go.id/'){
									$gambar = $homebase.'/dist/assets/media/bg/400.jpg';
								} else {
									$pisahg = explode('src="', $gambar);
									if (isset($pisahg[1])){
										$gambar = $pisahg[1];
										$pisahn = explode('"', $gambar);
										$gambar = $pisahn[0];
									}
								}
								$berita[$i]['title']    = $f->get_items()[$i]->get_title();
								$berita[$i]['conten']   = $f->get_items()[$i]->get_content();
								$berita[$i]['deskripsi']= $f->get_items()[$i]->get_description();
								$berita[$i]['tanggal']  = $f->get_items()[$i]->get_local_date();
								$berita[$i]['gambar']   = $gambar;
								$berita[$i]['link']     = $f->get_items()[$i]->get_link();
								$i++;
							}
						}
					}
					$data['berita']  	= $berita;
					return view('projectipm.dashboard-local', $data);
				}else {
					$data['berita']  	= null;
					return view('projectipm.dashboard-rita', $data);
				}
			}
		} else {
			return Redirect::to('/');
		}
	}
	public function login(Request $request) {
        $tasks				= [];
		$tasks['sidebar']	= 'frontpage';
		$previlage  		=  Session('previlage');
        if ($previlage != '') {
            return redirect('dashbord');
        } else {
			$id 		= $request->input('id');
			$firebaseid = $request->input('firebaseid');
			if ($firebaseid == null OR $firebaseid == ''){
				$ceksek = explode("?firebaseid=", $id);
				if (isset($ceksek[1])){
					$firebaseid = $ceksek[1];
				}
			}
			$sql = Sekolah::find($id);
			if(!$sql){
				$data['kalimatheader']  	= 'Mohon Maaf';
				$data['kalimatbody']  		= 'Session Not Valid. Please Refresh This Page Or Click This URL';
				return view('errors.419', $data);
			}

			$data					= [];
			$data['sidebar']		= 'frontpage';
			$data['firebaseid']		= $firebaseid;
			$data['id_sekolah']		= $id;
			$data['nama_yayasan']	= $sql->nama_yayasan;
			$data['nama_sekolah']	= $sql->nama_sekolah;
			$data['kode_sekolah']	= $sql->kode_sekolah;
			$data['nis']			= $sql->nis;
			$data['nss']			= $sql->nss;
			$data['npsn']			= $sql->npsn;
			$data['alamat']			= $sql->alamat;
			$data['kota']			= $sql->kota;
			$data['telp']			= $sql->telp;
			$data['email']			= $sql->email;
			$data['slogan']			= $sql->slogan;
			$data['logo']			= $sql->logo;
			$data['frontpage']		= $sql->frontpage;

			return view('login', $data);
        }
    }
	public function forgotpass(){
        return view('resetpassword');
    }
    public function index() {
		$data 		= [];
		$tahun		= date("Y");
		$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$groups     = Pengumuman::where('id_sekolah', Session('sekolah_id_sekolah'))->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
		$y      	= 0;
		$x      	= 0;
		foreach ($groups as $group) {
			$tanggal    = $group->tanggal;
			$rsurat     = Pengumuman::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
			foreach ($rsurat as $rowpeng) {
				$id             =   $rowpeng->id;
				$jenis          =   $rowpeng->jenis;
				$siapa          =   $rowpeng->siapa;
				$nim            =   $rowpeng->nim;
				$pengumuman     =   $rowpeng->pengumuman;   
				$created_at     =   $rowpeng->kapan;
				$kapan          =   timeAgoF($created_at);
				if ($jenis == 'mahasiswa') { 
					$nama = $siapa.'('.$nim.')';
					$iconne = 'fa-user';
					$jencolor = 'green';
				} else { 
					$nama = $siapa; 
					$iconne = 'fa-bullhorn';
					$jencolor = 'red';
				}
				
				$data['pengumumans'][$x]['id']          =   $id;
				$data['pengumumans'][$x]['tanggal']     =   $tanggal;
				$data['pengumumans'][$x]['kapan']       =   $kapan;
				$data['pengumumans'][$x]['jencolor']    =   $jencolor;
				$data['pengumumans'][$x]['jenis']       =   $jenis;
				$data['pengumumans'][$x]['siapa']       =   $siapa;
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
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01'] = Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= Session('sekolah_logo');
		$data['sidebar']		    = 'dashbord';
		return view('simaster.index', $data);
    }
	public function SiapdokIndex() {
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		$homebase	= url("/");
		$data 		= [];
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
			$data['namaapps01']  		= $getdomainid->name;
			$data['domainapps01']  		= $getdomainid->domainapps;
			$data['subdomainapps01']  	= $getdomainid->subdomainapps;
			$data['subsubdomainapps01'] = $getdomainid->subsubdomainapps;
			$data['addressapps01']  	= $getdomainid->addressapps;
			$data['kota01']  			= $getdomainid->kota;
			$data['emailapps01']  		= $getdomainid->emailapps;
			$data['lamanapps01']  		= $getdomainid->route;
			$data['icon01']  			= $getdomainid->icon;
			$data['logofrontapps01']  	= $getdomainid->logofrontapps;
			$data['lamanportal']		= $lamanportal;
		} else {
			$data['namaapps01']  		= 'Software House';
			$data['domainapps01']  		= 'Duidev Software House';
			$data['subdomainapps01']  	= 'DUIDEV';
			$data['subsubdomainapps01'] = 'CV SWANDHANA';
			$data['addressapps01']  	= 'Jalan Sebuku X/18 Bunulrejo Blimbing Malang';
			$data['kota01']  			= 'Indonesia';
			$data['emailapps01']  		= 'swandhana17@gmail.com';
			$data['icon01']  			= 'https://duidev.com/public/duidev-softwarehouse.png';
			$data['lamanapps01']  		= 'https://duidev.com/';
			$data['logofrontapps01']  	= 'https://duidev.com/public/dist/img/logokecil.png';
			$data['lamanportal']		= 'https://duidev.com/';
		}
        $previlage  =  Session('previlage');
		$fakultas  	=  Session('fakultas');
		if ($fakultas == 'FV'){
			return redirect('frontpagevokasi'); 
		} elseif ($fakultas == 'Safehouse'){
			if (Session('firebaseid') !== null AND Session('nama') != 'Visitor'){
				return redirect('/safehome/'.Session('firebaseid'));
			} else {
				Auth::logout();
				return view('siapdoklogin', $data);
        	}
		} elseif ($fakultas == 'Bazis UB'){
			Auth::logout();
			return view('siapdoklogin', $data);
		} elseif ($fakultas == 'PASCAUB'){
			return redirect('frontpagepps');
		} elseif ($fakultas == 'FMIPA'){
			return redirect('frontpagemipa');
		} else {
			if ($previlage != '') {
				if ($previlage == 'Peserta Ujian Dinas' OR $previlage == 'Peserta Pelatihan Dasar (LATSAR)') {
					return redirect('portaludin');
				} elseif ($previlage == 'mahasiswa magister') {
					return redirect('dashboardmhs');
				} elseif ($previlage == 'mahasiswa magister') {
					return redirect('dashboardmhs');
				} elseif ($previlage == 'mahasiswa doktoral') {
					return redirect('dashboardmhs');
				} elseif ($previlage == 'developer') {
					return redirect('frontpage2');
				} else if ($previlage == 'admin') {
					return redirect('user');
				} else if ($previlage == 'PEJABAT') {
					if (Session('idjabatan') == '1005'){
						return redirect('dashbordktusekun');
					} else {
						return redirect('dashboardpimpinan');
					}
				} else if ($previlage == 'Sekretaris Wakil Rektor Bidang Akademik' OR $previlage == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $previlage == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $previlage == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $previlage == 'Sekretaris Rektor' OR $previlage == 'Sekretaris' OR $previlage == 'Sekretaris Dekan' OR $previlage == 'Sekretaris WD I' OR $previlage == 'Sekretaris WD II' OR $previlage == 'Sekretaris WD III' OR $previlage == 'Sekretaris Senat UB') {
					return redirect('dashbordsurat');
				} else if ($previlage == 'Agendaris Umum' OR $previlage == 'Tata Usaha') {
					return redirect('dashboardagendaris');
				} else if ($previlage == 'Arsiparis Umum') {
					return redirect('dashboardarsiparis');
				} else if ($previlage == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR $previlage == 'Sekretaris Ka.Biro Keuangan' OR $previlage == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR $previlage == 'Sekretaris Bagian Akutansi') {
					return redirect('dashboardsekbiro');
				} else if ($previlage == 'level1' OR $previlage == 'level2' OR $previlage == 'level3') {
					return redirect('dashboard');
				} else {
					if (Session('spesial') == 'Bendahara Jurusan'){
						return redirect('dashboardbendaharajurusan');
					} else {
						return redirect('dashboardstaf');
					}
				}
			} else {
				return view('siapdoklogin', $data);
			}
        }
    }
	public function SCOFrontpage() {
        $tasks					= [];
		$iduser					= Session('id');
		$previlage				= Session('previlage');
		$ceknip					= User::where('username', Session('username'))->count();
		if ($ceknip != 0){
			$getnip				= User::where('username', Session('username'))->first();
			$idpeg				= $getnip->nip;
		} else { $idpeg = ''; }
		$ruangs 				= Ruang::where('marking', 'OK')->get();
		$kendaraans				= Kendaraan::where('marking', 'OK')->get();
		$countmailbox 			= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
		$counttugas1			= Tugasdeveloper::where('status', '!=', 'DONE')->count();
		$counttugas2			= Inboxsurat::where('penerima', 'Dwi Swandhana')->where('status', 'send')->count();
		$counttugas3			= Inboxsurat::where('penerima', 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik')->where('status', 'send')->count();
		$counttugas				= $counttugas1 + $counttugas2 + $counttugas3;
		$tasks['countantritte']	= AntrianTTE::whereNull('keterangan')->count();
    	$tasks['counttugas']	= $counttugas;
    	$tasks['countmailbox']	= $countmailbox;
    	$tasks['ruangs'] 		= $ruangs;
		$tasks['kendaraans']	= $kendaraans;
		$tasks['sidebar']		= 'frontpage';
    	return view('frontpage', $tasks);
	}
	public function eRental() {
		$fakultas  			=  Session('fakultas');
		if ($fakultas !== null){
			$ruangs 		= 	Ruang::whereIn('pinjam', ['Di Sewa/Pinjamkan untuk umum', 'Di Sewa/Pinjamkan untuk kalangan internal'])->get();
			$kendaraans		= 	Kendaraan::whereIn('statpinjam', ['Di Sewa/Pinjamkan untuk umum', 'Di Sewa/Pinjamkan untuk kalangan internal'])->get();
			$gedungs		= 	Gedung::whereIn('statpinjam', ['Di Sewa/Pinjamkan untuk umum', 'Di Sewa/Pinjamkan untuk kalangan internal'])->get();
		} else {
			$ruangs 		= 	Ruang::where('pinjam', 'Di Sewa/Pinjamkan untuk umum')->get();
			$kendaraans		= 	Kendaraan::where('statpinjam', 'LIKE', 'Di Sewa/Pinjamkan untuk umum')->get();
			$gedungs		= 	Gedung::where('statpinjam', 'LIKE', 'Di Sewa/Pinjamkan untuk umum')->get();
		}
    	$data 				= 	[];
    	$data['ruangs'] 	= 	$ruangs;
		$data['gedungs'] 	= 	$gedungs;
		$data['kendaraans'] = 	$kendaraans;
    	return view('simpen.dashboard', $data);
    }
	public function risPortal ($id){
		if (is_null($id) OR $id == ''){
			$id = time();
		}
		return redirect('landingapps/'.$id);
	}
	public function FrontPageindex(Request $request) {
		$id 			= $request->input('id');
		$firebaseid 	= $request->input('firebaseid');
		$sql 			= Sekolah::find($id);
		if(!$sql){
			return view('accessdenided');	
		}
		$previlage  =  Session('previlage');
		if ($firebaseid == null OR $firebaseid == ''){
			$ceksek = explode("?firebaseid=", $id);
			if (isset($ceksek[1])){
				$firebaseid = $ceksek[1];
			}
		}
        if ($previlage != '') {
			if ($previlage == 'adminwebinar'){
				return redirect('dashboardwebinar');
			} else {
				return redirect('dashbord');
			}
        } else {
			if ($firebaseid == null OR $firebaseid == ''){
				$profile 				= '';
				$visimisi 				= '';
				$strukturorganisasi 	= '';
				$pendidik 				= '';
				$jadwal 				= '';
				$kontak 				= '';
				$sertamerta 			= '';
				$setiapsaat 			= '';
				$pengumuman 			= '';
				$getdata 				= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id)->get();
				if (!empty($getdata)){
					foreach ($getdata as $rlayanan){
						$status 		= $rlayanan->status;
						$layanan 		= $rlayanan->layanan;
						if ($layanan == 'profile') { $profile = $status; }
						if ($layanan == 'visimisi') { $visimisi = $status; }
						if ($layanan == 'strukturorganisasi') { $strukturorganisasi = $status; }
						if ($layanan == 'pendidik') { $pendidik = $status; }
						if ($layanan == 'jadwal') { $jadwal = $status; }
						if ($layanan == 'kontak') { $kontak = $status; }
						if ($layanan == 'sertamerta') { $sertamerta = $status; }
						if ($layanan == 'setiapsaat') { $setiapsaat = $status; }
					}
				}
				$pengumuman 				= $sql->pengumuman;
				$data						= [];
				$data['sidebar']			= 'frontpage';
				$data['firebaseid']			= '';
				$data['profile']			= $profile;
				$data['visimisi']			= $visimisi;
				$data['strukturorganisasi']	= $strukturorganisasi;
				$data['pendidik']			= $pendidik;
				$data['jadwal']				= $jadwal;
				$data['kontak']				= $kontak;
				$data['sertamerta']			= $sertamerta;
				$data['setiapsaat']			= $setiapsaat;
				$data['pengumuman']			= $pengumuman;
				$data['id_sekolah']			= $id;
				$data['nama_yayasan']		= $sql->nama_yayasan;
				$data['nama_sekolah']		= $sql->nama_sekolah;
				$data['kode_sekolah']		= $sql->kode_sekolah;
				$data['nis']				= $sql->nis;
				$data['nss']				= $sql->nss;
				$data['npsn']				= $sql->npsn;
				$data['alamat']				= $sql->alamat;
				$data['kota']				= $sql->kota;
				$data['telp']				= $sql->telp;
				$data['email']				= $sql->email;
				$data['slogan']				= $sql->slogan;
				$data['logo']				= $sql->logo;
				$data['frontpage']			= $sql->frontpage;

				return view('simaster.frontpage', $data);
			} else {
				$user  		 	= User::where('firebaseid', $firebaseid)->first();
				if (isset($user->previlage)){
					$previlage 			= $user->previlage;
					$idsekolah 			= $user->id_sekolah;
					$idne 				= $user->id;
					$fakultas 			= $user->fakultas;
					session(['id' 		=> $user->id]);
					session(['nama' 	=> $user->nama]);
					session(['username' => $user->username]);
					session(['previlage'=> $previlage]);
					session(['fakultas' => $fakultas]);
					session(['nip'		=> $user->nip]);
					session(['spesial' 	=> $user->spesial]);
					$sql = Sekolah::find($idsekolah);
					session(['sekolah_nama_aplikasi'=> 'SIMASTER']);
					session(['sekolah_id_sekolah'	=> $idsekolah]);
					session(['sekolah_level'		=> $sql->level]);
					session(['sekolah_nama_yayasan'	=> $sql->nama_yayasan]);
					session(['sekolah_nama_sekolah'	=> $sql->nama_sekolah]);
					session(['sekolah_kode_sekolah'	=> $sql->kode_sekolah]);
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
					return redirect('dashbord');
				} else {
					$profile 				= '';
					$visimisi 				= '';
					$strukturorganisasi 	= '';
					$pendidik 				= '';
					$jadwal 				= '';
					$kontak 				= '';
					$sertamerta 			= '';
					$setiapsaat 			= '';
					$pengumuman 			= '';
					$getdata 				= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id)->get();
					if (!empty($getdata)){
						foreach ($getdata as $rlayanan){
							$status 		= $rlayanan->status;
							$layanan 		= $rlayanan->layanan;
							if ($layanan == 'profile') { $profile = $status; }
							if ($layanan == 'visimisi') { $visimisi = $status; }
							if ($layanan == 'strukturorganisasi') { $strukturorganisasi = $status; }
							if ($layanan == 'pendidik') { $pendidik = $status; }
							if ($layanan == 'jadwal') { $jadwal = $status; }
							if ($layanan == 'kontak') { $kontak = $status; }
							if ($layanan == 'sertamerta') { $sertamerta = $status; }
							if ($layanan == 'setiapsaat') { $setiapsaat = $status; }
						}
					}
					$pengumuman 				= $sql->pengumuman;
					$data						= [];
					$data['firebaseid']			= $firebaseid;
					$data['sidebar']			= 'frontpage';
					$data['profile']			= $profile;
					$data['visimisi']			= $visimisi;
					$data['strukturorganisasi']	= $strukturorganisasi;
					$data['pendidik']			= $pendidik;
					$data['jadwal']				= $jadwal;
					$data['kontak']				= $kontak;
					$data['sertamerta']			= $sertamerta;
					$data['setiapsaat']			= $setiapsaat;
					$data['pengumuman']			= $pengumuman;
					$data['id_sekolah']			= $id;
					$data['nama_yayasan']		= $sql->nama_yayasan;
					$data['nama_sekolah']		= $sql->nama_sekolah;
					$data['kode_sekolah']		= $sql->kode_sekolah;
					$data['nis']				= $sql->nis;
					$data['nss']				= $sql->nss;
					$data['npsn']				= $sql->npsn;
					$data['alamat']				= $sql->alamat;
					$data['kota']				= $sql->kota;
					$data['telp']				= $sql->telp;
					$data['email']				= $sql->email;
					$data['slogan']				= $sql->slogan;
					$data['logo']				= $sql->logo;
					$data['frontpage']			= $sql->frontpage;
					return view('simaster.frontpage', $data);
				}
			}
        }
	}
	public function bukuTamu() {
    	$data 				= [];
		$pejabats			= User::orderBy('nama', 'ASC')->groupBy('previlage')->get();
    	$data['pejabats'] 	= $pejabats;
    	$data['fakultas'] 	= User::where('fakpanjang', 'LIKE', 'Fakultas%')->groupBy('fakpanjang')->get();
    	return view('tamu', $data);
	}
	public function viewTracerstudy() {
    	$pejabats			= User::where('fakpanjang', '!=', '')->groupBy('fakultas')->orderBy('fakultas', 'ASC')->get();
    	$data 				= [];
		$data['pejabats'] 	= $pejabats;
    	return view('tracerstudy', $data);
	}
	public function viewVokasi() {
		$fakultas	= 'FV';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('frontpagevokasi');
        } else {
			$urutanwerno = array('red','green','blue','black','navy','teal','orange','maroon','black','aqua');
			$groups     =   Pengumuman::where('fakultas', $fakultas)->select('tanggal')->where('jenis', '!=', 'mahasiswa')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
			$y      	=   0;
			$x      	=   0;
			$data   	=   [];
			foreach ($groups as $group) {
				$tanggal    = $group->tanggal;
				$rsurat     = Pengumuman::where('fakultas', $fakultas)->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
				foreach ($rsurat as $rowpeng) {
					$id             =   $rowpeng->id;
					$jenis          =   $rowpeng->jenis;
					$siapa          =   $rowpeng->siapa;
					$nim            =   $rowpeng->nim;
					$pengumuman     =   $rowpeng->pengumuman;   
					$created_at     =   $rowpeng->kapan;
					$kapan          =   timeAgo($created_at);
					if ($jenis == 'mahasiswa') { 
						$nama = $siapa.'('.$nim.')';
						$iconne = 'fa-user';
						$jencolor = 'green';
					} else { 
						$nama = $siapa; 
						$iconne = 'fa-bullhorn';
						$jencolor = 'red';
					}
					
					$data['pengumumans'][$x]['id']          =   $id;
					$data['pengumumans'][$x]['tanggal']     =   $tanggal;
					$data['pengumumans'][$x]['kapan']       =   $kapan;
					$data['pengumumans'][$x]['jencolor']    =   $jencolor;
					$data['pengumumans'][$x]['jenis']       =   $jenis;
					$data['pengumumans'][$x]['siapa']       =   $siapa;
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
			$jadwal 	= Jadwalkuliah::where('fakultas', $fakultas)->where('jenis', 'Kegiatan')->orderBy('mulai', 'DESC')->limit(100)->get();
			$i 			= 0;
			foreach($jadwal as $hcari) {
				$ruang     	= $hcari->ruang;
				$gedung    	= '';
				$mulai    	= $hcari->mulai;
				$akhir    	= $hcari->akhir;
				$peminjam   = addslashes($hcari->namadosen);
				$keperluan  = addslashes($hcari->semester);
				$arrayttl 	= explode(" ", $mulai);
				$tanggal	= $arrayttl[0];
				$jam 		= $arrayttl[1];
				
				$arraytgl 	= explode(" ", $akhir);
				$dd 		= $arraytgl[0];
				$akhir 		= $arraytgl[1];
				
				$keperluan 	= str_replace(array("\r", "\n"), '', $keperluan);
				$keperluan 	= str_replace('"', '\"', $keperluan);
				$keperluan 	= str_replace("'", "\'", $keperluan);
				$keperluan 	= str_replace("<ol>", "", $keperluan);
				$keperluan 	= str_replace("<li>", "-", $keperluan);
				$keperluan 	= str_replace("</li>", "", $keperluan);
				$keperluan 	= str_replace("</ol>", "", $keperluan);
				if ($ruang == ''){
					$judul		= $peminjam.' Nama Kegiatan : '.$keperluan;
				}else {
					$judul		= $peminjam.' Mengadakan kegiatan di Ruang '.$ruang.' Nama Kegiatan : '.$keperluan;
				}
				$start		= $tanggal.'T'.$jam;
				$end		= $dd.'T'.$akhir;
				$data['kalender'][$i]['title']	=   $judul;
				$data['kalender'][$i]['start']	=   $start;
				$data['kalender'][$i]['end']	=   $end;
				
				$i++;
			}
			if ($i == 0){
				$mulai = date("Y-m-d");
				$data['kalender'][$i]['title']	=   'Add Some Schedule';
				$data['kalender'][$i]['start']	=   $mulai;
				$data['kalender'][$i]['end']	=   $mulai;
			}
			$data['sekarang'] 	= 	date('Y-m-d');
            return view('vokasi.login', $data);
        }
	}
	public function viewPpsUB() {
		$fakultas	= 'PASCAUB';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$urutanwerno = array('red','green','blue','black','navy','teal','orange','maroon','black','aqua');
			$groups     =   Pengumuman::where('fakultas', $fakultas)->select('tanggal')->where('jenis', '!=', 'mahasiswa')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
			$y      	=   0;
			$x      	=   0;
			$data   	=   [];
			foreach ($groups as $group) {
				$tanggal    = $group->tanggal;
				$rsurat     = Pengumuman::where('fakultas', $fakultas)->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
				foreach ($rsurat as $rowpeng) {
					$id             =   $rowpeng->id;
					$jenis          =   $rowpeng->jenis;
					$siapa          =   $rowpeng->siapa;
					$nim            =   $rowpeng->nim;
					$pengumuman     =   $rowpeng->pengumuman;   
					$created_at     =   $rowpeng->kapan;
					$kapan          =   timeAgo($created_at);
					if ($jenis == 'mahasiswa') { 
						$nama = $siapa.'('.$nim.')';
						$iconne = 'fa-user';
						$jencolor = 'green';
					} else { 
						$nama = $siapa; 
						$iconne = 'fa-bullhorn';
						$jencolor = 'red';
					}
					
					$data['pengumumans'][$x]['id']          =   $id;
					$data['pengumumans'][$x]['tanggal']     =   $tanggal;
					$data['pengumumans'][$x]['kapan']       =   $kapan;
					$data['pengumumans'][$x]['jencolor']    =   $jencolor;
					$data['pengumumans'][$x]['jenis']       =   $jenis;
					$data['pengumumans'][$x]['siapa']       =   $siapa;
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
			$jadwal 	= Jadwalkuliah::where('fakultas', $fakultas)->where('jenis', 'Kegiatan')->orderBy('mulai', 'DESC')->limit(100)->get();
			$i 			= 0;
			foreach($jadwal as $hcari) {
				$ruang     	= $hcari->ruang;
				$gedung    	= '';
				$mulai    	= $hcari->mulai;
				$akhir    	= $hcari->akhir;
				$peminjam   = addslashes($hcari->namadosen);
				$keperluan  = addslashes($hcari->semester);
				$arrayttl 	= explode(" ", $mulai);
				$tanggal	= $arrayttl[0];
				$jam 		= $arrayttl[1];
				
				$arraytgl 	= explode(" ", $akhir);
				$dd 		= $arraytgl[0];
				$akhir 		= $arraytgl[1];
				
				$keperluan 	= str_replace(array("\r", "\n"), '', $keperluan);
				$keperluan 	= str_replace('"', '\"', $keperluan);
				$keperluan 	= str_replace("'", "\'", $keperluan);
				$keperluan 	= str_replace("<ol>", "", $keperluan);
				$keperluan 	= str_replace("<li>", "-", $keperluan);
				$keperluan 	= str_replace("</li>", "", $keperluan);
				$keperluan 	= str_replace("</ol>", "", $keperluan);
				if ($ruang == ''){
					$judul		= $peminjam.' Nama Kegiatan : '.$keperluan;
				}else {
					$judul		= $peminjam.' Mengadakan kegiatan di Ruang '.$ruang.' Nama Kegiatan : '.$keperluan;
				}
				$start		= $tanggal.'T'.$jam;
				$end		= $dd.'T'.$akhir;
				$data['kalender'][$i]['title']	=   $judul;
				$data['kalender'][$i]['start']	=   $start;
				$data['kalender'][$i]['end']	=   $end;
				
				$i++;
			}
			if ($i == 0){
				$mulai = date("Y-m-d");
				$data['kalender'][$i]['title']	=   'Add Some Schedule';
				$data['kalender'][$i]['start']	=   $mulai;
				$data['kalender'][$i]['end']	=   $mulai;
			}
			$data['sekarang'] 	= 	date('Y-m-d');
            return view('pps.login', $data);
        }
    }
	public function viewEvaluasiperkuliahanvokasi() {
		$data 			= [];
		$fakultas 		= 'FV';
		$semester		= Jadwalkuliah::where('fakultas', $fakultas)->groupBy('semester')->orderBy('semester', 'ASC')->get();
    	$j 				= 0;
		$jsonprodi		= Jadwalkuliah::where('fakultas', $fakultas)->groupBy('prodi')->get();
		foreach ($jsonprodi as $rprodi) {
			$idprodi	= $rprodi->prodi;
			$cekdataps 	= MasterPS::where('id', $idprodi)->count();
			if ($cekdataps == 0){
				$tlsps		= 'Deleted Prodi';
				$namafak	= '';
				$namapees	= '';
			} else {
				$getdataps 	= MasterPS::where('id', $idprodi)->first();
				$namapees	= $getdataps->nama;
				$namafak	= $getdataps->namafak;
				$jenjangps	= $getdataps->jenjang;
				$tlsps		= $namafak.' PS. '.$namapees.' ( '.$jenjangps.' )';
			}
			$data['jprodi'][$j]['tulis']	= $tlsps;
			$data['jprodi'][$j]['namaps']	= $namapees;
			$data['jprodi'][$j]['namafak']	= $namafak;
			$data['jprodi'][$j]['id']		= $idprodi;
			$j++;
		}
		if ($j == 0){
			$data['jprodi'][$j]['tulis']	= 'Belum Ada Jadwal';
			$data['jprodi'][$j]['namaps']	= 'Belum Ada Jadwal';
			$data['jprodi'][$j]['namafak']	= '0';
			$data['jprodi'][$j]['id']		= '0';
		}
		$data['pertanyaan'] = Evaluasikuestion::all();
    	$data['semester'] 	= $semester;
    	$data['alamatawal'] = '/sivoka';
    	$data['fakultas'] 	= 'Fakultas Vokasi';
    	return view('evaluasiperkuliahan', $data);
	}
	public function viewEvaluasiperkuliahanpps() {
    	$data 			= [];
		$fakultas 		= 'PASCAUB';
		$semester		= Jadwalkuliah::where('fakultas', $fakultas)->groupBy('semester')->orderBy('semester', 'ASC')->get();
    	$j 				= 0;
		$jsonprodi		= Jadwalkuliah::where('fakultas', $fakultas)->groupBy('prodi')->get();
		foreach ($jsonprodi as $rprodi) {
			$idprodi	= $rprodi->prodi;
			$cekdataps 	= MasterPS::where('id', $idprodi)->count();
			if ($cekdataps == 0){
				$tlsps		= 'Deleted Prodi';
				$namafak	= '';
				$namapees	= '';
			} else {
				$getdataps 	= MasterPS::where('id', $idprodi)->first();
				$namapees	= $getdataps->nama;
				$namafak	= $getdataps->namafak;
				$jenjangps	= $getdataps->jenjang;
				$tlsps		= $namafak.' PS. '.$namapees.' ( '.$jenjangps.' )';
			}
			$data['jprodi'][$j]['tulis']	= $tlsps;
			$data['jprodi'][$j]['namaps']	= $namapees;
			$data['jprodi'][$j]['namafak']	= $namafak;
			$data['jprodi'][$j]['id']		= $idprodi;
			$j++;
		}
		if ($j == 0){
			$data['jprodi'][$j]['tulis']	= 'Belum Ada Jadwal';
			$data['jprodi'][$j]['namaps']	= 'Belum Ada Jadwal';
			$data['jprodi'][$j]['namafak']	= '0';
			$data['jprodi'][$j]['id']		= '0';
		}
		$data['pertanyaan'] = Evaluasikuestion::all();
    	$data['semester'] 	= $semester;
    	$data['alamatawal'] = '/pps';
    	$data['fakultas'] 	= 'Program Pascasarjana';
    	return view('evaluasiperkuliahan', $data);
	}
	public function viewTugas() {
        $tasks		= [];
		$mnama		= Session('nama');
		$mkelompok	= Session('jabatan');
		$iduser		= Session('id');
		$i 			= 0;
		$jmerangkap	= User::where('username', Session('username'))->first();
		if (isset($jmerangkap->merangkap)){
			$merangkap		= $jmerangkap->merangkap;
			if (is_null($jmerangkap->nip)){
				$idpeg		= 0;
			} else {
				$idpeg		= $jmerangkap->nip;
			}
			if (is_null($jmerangkap->nik)){
				$nik		= '';
			} else {
				$nik		= $jmerangkap->nik;
			}
		} else { $merangkap = '';  $idpeg = 0; $nik = ''; }
		$cinbox 	= 0;
		$coutbox 	= 0;
		if ($mkelompok != 'Arsiparis Umum'){
			if ($merangkap != ''){
				$ceksrtmasuk	= Inboxsurat::whereIn('penerima', [$mkelompok, $merangkap])
								->where('jenis', 'MASUK')
								->where('status', '!=', 'reply')
								->groupBy('marking')
								->get();
				$ceksrtkeluar	= Inboxsurat::whereIn('penerima', [$mkelompok, $merangkap])
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->get();
			} else {
				$ceksrtmasuk	= Inboxsurat::where('penerima', $mkelompok)
								->where('jenis', 'MASUK')
								->where('status', '!=', 'reply')
								->groupBy('marking')
								->get();
				$ceksrtkeluar	= Inboxsurat::where('penerima', $mkelompok)
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->get();
			}
			if (!empty($ceksrtmasuk)){
				foreach ($ceksrtmasuk as $rinbox){
					$cinbox++;
				}
			}
			if (!empty($ceksrtkeluar)){
				foreach ($ceksrtkeluar as $rinbox){
					$coutbox++;
				}
			}
		} else {
			$ceksrtmasuk	= Inboxsurat::where('penerima', $mkelompok)
								->where('jenis', 'MASUK')
								->where('status', '!=', 'reply')
								->groupBy('marking')
								->count();
			$ceksrtkeluar	= Inboxsurat::where('penerima', $mkelompok)
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->count();
		}
		$tahunini			= date('Y');
		$cekmari			= DB::table('tbl_inbox')
								->join('tbl_suratmasuk', 'tbl_inbox.marking', 'tbl_suratmasuk.marking')
								->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')
								->where('tbl_inbox.penerima', $mkelompok)
								->where('tbl_suratmasuk.status', 'LIKE', '%'.'arsip'.'%')
								->whereYear('tbl_suratmasuk.tglmasuk', $tahunini)
								->orderBy('tbl_inbox.marking', 'DESC')
								->count();
		$cekrungmari		= DB::table('tbl_inbox')
								->join('tbl_suratmasuk', 'tbl_suratmasuk.marking', 'tbl_inbox.marking')
								->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')
								->where('tbl_inbox.penerima', $mkelompok)
								->where('tbl_suratmasuk.status', 'NOT LIKE', '%'.'arsip'.'%')
								->whereYear('tbl_suratmasuk.tglmasuk', $tahunini)
								->orderBy('tbl_inbox.marking', 'DESC')
								->count();
		$countveri			= 0;
		$totalnotif			= 0;
		$countujians3		= 0;
		$countujians2		= 0;
		$countujians1		= 0;
		$countujiandiploma	= 0;
		$spesial			= Session('spesial');
		if (isset($spesial)){
			$ceksek = explode(" Jurusan ", $spesial);
			if (isset($ceksek[1])){
				$jurusan 			= $ceksek[1];
				$ujians   			= AntrianUjian::where('jurusan', 'LIKE', '%'.$jurusan.'%')->where('fakultas', Session('fakultas'))->where('marking', '')->groupBy('jenis')->get();
				if (!empty($ujians)){
					foreach ($ujians as $rujian){
						$jenis 	= $rujian->jenis;
						if ($jenis != ''){
							$laman 	= '#';
							if($jenis == 'Diseminasi Hasil'){ $laman = 's3wisuda'; }
							if($jenis == 'judul'){ $laman = 'judul'; }
							if($jenis == 'Pelaksanaan Penelitian Tesis'){ $laman = 'penelitiantesis'; }
							if($jenis == 'Penilaian Penelitian Disertasi'){ $laman = 's3ujianevaluasi'; }
							if($jenis == 'Penilaian Publikasi Ilmiah'){ $laman = 's3publikasi'; }
							if($jenis == 'Penilaian Seminar Ilmiah Internasional'){ $laman = 's3seminter'; }
							if($jenis == 'Promotor'){ $laman = 's3pengajuanpromotor'; }
							if($jenis == 'Publikasi Tesis'){ $laman = 's3publikasi'; }
							if($jenis == 'semhas'){ $laman = 'semhas'; }
							if($jenis == 'Seminar Hasil'){ $laman = 's3semhas'; }
							if($jenis == 'Seminar Kemajuan I'){ $laman = 's3kompengesahan'; }
							if($jenis == 'Seminar Kemajuan II'){ $laman = 's3kemajuan2'; }
							if($jenis == 'Seminar Pra Proposal 1'){ $laman = 's3sidangkomisi'; }
							if($jenis == 'Seminar Pra Proposal 2'){ $laman = 's3sidangkomhas'; }
							if($jenis == 'Seminar Proposal Disertasi'){ $laman = 's3sidangkomisi'; }
							if($jenis == 'sempro'){ $laman = 'sempro'; }
							if($jenis == 'Sidang Komisi Proposal'){ $laman = 's3sidangkomisi'; }
							if($jenis == 'ujian'){ $laman = 'ujian'; }
							if($jenis == 'Ujian Akhir Disertasi'){ $laman = 's3uad'; }
							if($jenis == 'Ujian Kelayakan Naskah'){ $laman = 's3kelayakanuad'; }
							if($jenis == 'Ujian Kualifikasi'){ $laman = 's3ujiankualifikasi'; }
							if($jenis == 'Ujian Proposal Disertasi'){ $laman = 's3ujianevaluasi'; }
							if($jenis == 'yudisium'){ $laman = 'yudisium'; }
							$jumlah = AntrianUjian::where('jurusan', 'LIKE', '%'.$jurusan.'%')->where('fakultas', Session('fakultas'))->where('marking', '')->where('jenis', $jenis)->count();
							$tasks['allujian'][$i]['url']		= $laman;
							$tasks['allujian'][$i]['jenis']		= $jenis;
							$tasks['allujian'][$i]['jumlah']	= $jumlah;
							$totalnotif = $totalnotif + $jumlah;
						}
						$i++;
					}
				}
			} else {
				$countujians3   	= AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Doktor S3')->where('marking', '')->count();
				$countujians2   	= AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Magister S2')->where('marking', '')->count();
				$countujians1   	= AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Sarjana S1')->where('marking', '')->count();
				$countujiandiploma  = AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Diploma')->where('marking', '')->count();
			}
		} else {
			if (Session('jabatan') == 'Ketua Jurusan Biologi' OR Session('jabatan') == 'Sekretaris Jurusan Biologi' OR Session('jabatan') == 'Ketua Program Studi S1 Biologi' OR Session('jabatan') == 'Ketua Program Studi S2 Biologi' OR Session('jabatan') == 'Ketua Program Studi S3 Biologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Dasar' OR Session('jabatan') == 'Kepala Laboratorium Mikrobiologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Seluler dan Molekuler'){
				$countujians3   	= AntrianUjian::where('jurusan', 'Jurusan Biologi')->where('fakultas', Session('fakultas'))->where('jenjang', 'Doktor S3')->where('marking', '')->count();
				$countujians2   	= AntrianUjian::where('jurusan', 'Jurusan Biologi')->where('fakultas', Session('fakultas'))->where('jenjang', 'Magister S2')->where('marking', '')->count();
				$countujians1   	= AntrianUjian::where('jurusan', 'Jurusan Biologi')->where('fakultas', Session('fakultas'))->where('jenjang', 'Sarjana S1')->where('marking', '')->count();
			} else {
				$countujians3   	= AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Doktor S3')->where('marking', '')->count();
				$countujians2   	= AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Magister S2')->where('marking', '')->count();
				$countujians1   	= AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Sarjana S1')->where('marking', '')->count();
				$countujiandiploma  = AntrianUjian::where('fakultas', Session('fakultas'))->where('jenjang', 'Diploma')->where('marking', '')->count();
			}
		}
		if ($idpeg != 0){
			$countmailbox 		= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$jecek				= Ecekdata::where('idpejabat1', $idpeg)->orWhere('idpejabat2', $idpeg)->groupBy('progres')->get();
			if (!empty($jecek)) {
				foreach ($jecek as $runit) {
					$idpejabat1		= $runit->idpejabat1;
					$ttdpejabat1	= $runit->ttdpejabat1;
					$idpejabat2		= $runit->idpejabat2;
					$ttdpejabat2	= $runit->ttdpejabat2;
					if ($idpejabat1 == $idpeg AND is_null($ttdpejabat1)){
						$countveri++;
					} 
					if ($idpejabat2 == $idpeg AND is_null($ttdpejabat2)){
						$countveri++;
					}
				}
			}
		}{ $countmailbox = 0; }
		$countsidokar				= Dokarkgb::where('paraf1', $mkelompok)->where('status', 'Paraf 1')->count();
		$counttugas1				= Tugasdeveloper::where('status', '!=', 'DONE')->count();
		$counttugas2				= Inboxsurat::where('penerima', 'Dwi Swandhana')->where('status', 'send')->count();
		$counttugas3				= Inboxsurat::where('penerima', 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik')->where('status', 'send')->count();
		$counttugas					= $counttugas1 + $counttugas2 + $counttugas3;
		$totalnotif					= $countveri + $countsidokar + $countmailbox + $countujians3 + $countujians2 + $countujians1 + $countujiandiploma;
		$tasks['totalnotif']     	= $totalnotif;
		$tasks['countujians3']     	= $countujians3;
		$tasks['countujians2']     	= $countujians2;
		$tasks['countujians1']     	= $countujians1;
		$tasks['countujiandiploma'] = $countujiandiploma;
		$tasks['countsendnd']      	= Suratkeluar::where('fakultas', Session('fakultas'))->where('pembuat', 'LIKE', Session('nama'))->where('status', 'NEW')->where('jenissrt', 'Nota Dinas')->count();
		$tasks['countantritte']		= AntrianTTE::whereNull('keterangan')->count();
    	$tasks['counttugas']		= $counttugas;
    	$tasks['countvercek']      	= $countveri;
		$tasks['countsidokar']      = $countsidokar;
		$tasks['countmailbox']      = $countmailbox;
		$tasks['countinbox']   		= $ceksrtmasuk;
		$tasks['sountrungmari']  	= $cekrungmari;
		$tasks['sountmari']   		= $cekmari;
		$tasks['countinboxmasuk']   = $cinbox;
		$tasks['countinboxkeluar']  = $coutbox;
		$tasks['countinbox']   		= $cinbox;
		$tasks['counttandatangan']  = $coutbox;
		$tasks['nik']  				= $nik;
		$tasks['alluser']			= User::all();
    	$tasks['sidebar']			= 'frontpage';
    	return view('tugaskoe', $tasks);
	}
	public function exTaskadd(Request $request) {
		$idne			= $request->input('val01');
		$deskripsi		= $request->input('val02');
		$keterangan		= $request->input('val03');
		$homebase		= url("/");
		if ($idne == 'TASKNEW'){
			$mulai		= $request->input('val03');
			$akhir		= $request->input('val04');
			$arrkepada 	= $request->input('val05');
			$idne		= $request->input('val06');
			$arkepada   = json_decode($arrkepada);
			if ($idne == 'TASKNEW'){
				$ceksek 	= Tugasdeveloper::where('created_by', Session('id'))->where('deskripsi', $deskripsi)->count();
			} else {
				$ceksek 	= Tugasdeveloper::where('id', '!=', $idne)->where('created_by', Session('id'))->where('deskripsi', $deskripsi)->count();
			}
			if ($ceksek == 0){
				$kepada		= '';
				$cekisikpd 	= 0;
				if (!empty($arkepada)){
					foreach ($arkepada as $tujuan ){
						$tujuanne 	= $tujuan->id;
						if ($tujuanne != '' AND $tujuanne != Session('previlage')){
							if ($kepada == ''){ $kepada = $tujuanne; }
							else { $kepada = $kepada.'; '.$tujuanne; }
							$cekisikpd++;
						}
					}
				} else { $cekisikpd = 0; }
				$filelama 	= '';
				if ($idne == 'TASKNEW'){
					$input = Tugasdeveloper::insertGetId([
						'deskripsi'		=> $deskripsi,
						'keterangan'	=> $kepada,
						'status'		=> 'NEW',
						'datadukung'	=> '',
						'mulai'			=> $mulai,
						'akhir'			=> $akhir,
						'created_by'	=> Session('id'),
						'updated_by'	=> Session('nama'),
					]);
					$idne 		= $input;
				} else {
					$input = Tugasdeveloper::where('id', $idne)->update([
						'deskripsi'		=> $deskripsi,
						'keterangan'	=> $kepada,
						'status'		=> 'NEW',
						'mulai'			=> $mulai,
						'akhir'			=> $akhir,
						'updated_by'	=> Session('nama'),
					]);
					$getfile = Tugasdeveloper::where('id', $idne)->first();
					if (isset($getfile->datadukung)){
						$filelama 	= $getfile->datadukung;
					}
					Jadwal::where('jenisjadwal', '10')->where('biaya', $idne)->delete();
				}
				if ($input){
					if ($filelama != ''){
						File::delete(base_path() ."/public/download/". $filelama);
						$filelama = '';
					}
					if($request->hasFile('file')) {
						$file = time().'.'.$request->file->getClientOriginalExtension();
						$request->file->move(public_path('download/'), $file);
						Tugasdeveloper::where('id', $input)->update([
							'datadukung'  =>  $file
						]);
						$filelama = $homebase.'/download/'.$file;
					}
					if (!empty($arkepada)){
						foreach ( $arkepada as $tujuan ){
							$tujuanne 	= $tujuan->id;
							if ($tujuanne != '' AND $tujuanne != Session('previlage')){
								$getnama = User::where('previlage', $tujuanne)->first();
								if (isset($getnama->nama)){
									$tujuanne = $getnama->nama;
								}
								Jadwal::create([
									'jenisjadwal'      	=>  '10',
									'ruang'         	=>  '',
									'gedung'         	=>  '',
									'tglmulai'			=> 	$mulai,
									'tglakhir'			=> 	$akhir,
									'jammulai'			=> 	date('H:i:s'),
									'jamakhir'			=> 	date('H:i:s'),
									'mulai'    			=>  $mulai.' '.date('H:i:s'),
									'akhir'     		=>  $akhir.' '.date('H:i:s'),
									'peminjam'      	=>  Session('nama'),
									'keperluan'     	=>  $deskripsi,
									'keterangan'		=>  $kepada,
									'suratpermohonan'	=>  $filelama,
									'inputor' 			=>  $tujuanne,
									'biaya' 			=>  $idne,
									'status' 			=>  'new',
									'fakultas'			=> 	Session('fakultas'),
									'fakpanjang'		=> 	Session('fakpanjang')
    							]);
							}
						}
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task Added']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Task Ini Sudah Ada, Mohon Mengubah Isi Tugas dengan Data Lain ( Bedakan dengan Data Sebelumnya dengan memberikan Tanggal Tugas )']);
				return back();
			
			}
		} else if ($idne == 'TASKEO'){
			$kelompok	= $request->input('val03');
			$idne		= $request->input('val04');
			$idevent 	= $request->input('val05');
			if ($idne == 'new'){
				$input = Tugasdeveloper::insertGetId([
					'deskripsi'		=> $deskripsi,
					'keterangan'	=> '',
					'status'		=> 'EOMODE',
					'datadukung'	=> '',
					'mulai'			=> date('Y-m-d H:i:s'),
					'akhir'			=> null,
					'created_by'	=> $kelompok,
					'updated_by'	=> $idevent,
				]);
				$idne 		= $input;
				$filelama	= '';
			} else {
				$ceksek 	= Tugasdeveloper::where('id', $idne)->update([
					'status'		=> 'EOMODE',
					'akhir'			=> date('Y-m-d H:i:s'),
					'created_by'	=> $kelompok,
					'deskripsi'		=> $deskripsi,
				]);
				$getfile = Tugasdeveloper::where('id', $idne)->first();
				if (isset($getfile->datadukung)){
					$filelama 	= $getfile->datadukung;
				}
			}
			if ($input){
				if($request->hasFile('file')) {
					if ($filelama != ''){
						File::delete(base_path() ."/public/download/". $filelama);
						$filelama = '';
					}
					$file = time().'.'.$request->file->getClientOriginalExtension();
					$request->file->move(public_path('download/'), $file);
					Tugasdeveloper::where('id', $input)->update([
						'datadukung'  =>  $file
					]);
					$filelama = $homebase.'/download/'.$file;
				}
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Tugas Baru Untuk '.$kelompok.' telah ditambahkan',
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$idevent
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task Added']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($idne == 'TASKEOCATATAN'){
			$keterangan	= '';
			$getfile 	= Tugasdeveloper::where('id', $request->input('val04'))->first();
			if (isset($getfile->datadukung)){
				$keterangan = $getfile->keterangan;
			}
			if ($keterangan == '' or is_null($keterangan)){
				$keterangan = 'Catatan Dari '.Session('nama').' '.date('Y-m-d H:i:s').': <br />'.$request->input('val02');
			} else {
				$keterangan = $keterangan.' Catatan Dari '.Session('nama').' '.date('Y-m-d H:i:s').': <br />'.$request->input('val02');
			}
			$input 		= Tugasdeveloper::where('id', $request->input('val04'))->update([
				'keterangan'	=> $keterangan
			]);
			if ($input){
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Catatan Dari '.Session('nama').' '.date('Y-m-d H:i:s').': <br />'.$request->input('val02'),
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$getfile->updated_by
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task Updated']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($idne == 'TASKEODEL'){
			$filelama	= '';
			$getfile 	= Tugasdeveloper::where('id', $request->input('val02'))->first();
			if (isset($getfile->datadukung)){
				$filelama 	= $getfile->datadukung;
			}
			$input 		= Tugasdeveloper::where('id', $request->input('val02'))->delete();
			if ($input){
				if ($filelama != ''){
					File::delete(base_path() ."/public/download/". $filelama);
				}
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Tugas Untuk '.$getfile->created_by.' telah dihapus',
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$getfile->updated_by
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($idne == 'TASKEOLAYOUT'){
			$ImageExt	= $request->file('file')->getClientOriginalExtension();
			$file_tmp	= $request->file('file');
			$data 		= file_get_contents($file_tmp);
			$layout 	= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
			$input 		= WebinarEventlist::where('id', $request->input('val05'))->update([
				'sertifikatdepan' => $layout
			]);
			if ($input){
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Layout di Ubah',
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$request->input('val05')
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Layout Saved']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($idne == 'new'){
			$ceksek 	= Tugasdeveloper::where('deskripsi', $deskripsi)->count();
			if ($ceksek == 0){
				$input = Tugasdeveloper::insertGetId([
					'deskripsi'		=> $deskripsi,
					'keterangan'	=> $keterangan,
					'status'		=> 'NEW',
					'datadukung'	=> '',
					'created_by'	=> Session('nama'),
					'updated_by'	=> Session('fakultas'),
				]);
				if ($input){
					if($request->hasFile('file')) {
						$file = time().'.'.$request->file->getClientOriginalExtension();
						$request->file->move(public_path('download/'), $file);
						Tugasdeveloper::where('id', $input)->update([
							'datadukung'  =>  $file
						]);
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task Added']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			}
		} else if ($idne == 'delete'){
			$ceksek 	= Tugasdeveloper::where('id', $deskripsi)->first();
			if (isset($ceksek->id)){
				$datadukung = $ceksek->datadukung;
				$input 	= Tugasdeveloper::where('id', $deskripsi)->delete();
				if ($input){
					File::delete(base_path() ."/public/download/". $datadukung);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task Deleted']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			}
		} else {
			$input = Tugasdeveloper::where('id', $idne)->update([
				'keterangan'	=> $keterangan,
				'status'		=> $deskripsi,
				'updated_by'	=> Session('nama'),
			]);
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Task '.$deskripsi]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		}
	}
	public function getTasklist(Request $request) {
		$arraygambar 	= [];
		$homebase		= url("/");
		$status			= $request->input('val01');
		if ($status == 'ALL'){
			$jpenerima		= Tugasdeveloper::whereNotIn('status', ['DONE', 'EOMODE'])->whereNotNull('datadukung')->get();
		} else if ($status == 'EOMODE'){
			$jpenerima		= Tugasdeveloper::where('status', 'EOMODE')->where('updated_by', $request->input('val02'))->get();
		} else if ($status == 'template'){
			$jpenerima		= Tugasdeveloper::where('keterangan', $status)->whereNotIn('status', ['DONE', 'EOMODE'])->whereNotNull('datadukung')->get();
		} else {
			$jpenerima		= Tugasdeveloper::where('status', $status)->get();
		}
		if (!empty($jpenerima)){
			foreach ($jpenerima as $result) {
				$datadukung	= $result->datadukung;
				if ($datadukung != ''){
					$datadukung = '<a href="'.$homebase.'/download/'.$datadukung.'"><span class="label bg-green">VIEW</span></a>';
				}
				$arraygambar[] = array(
					'idne' 			=> $result->id,
					'keterangan'	=> $result->keterangan,
					'deskripsi'		=> $result->deskripsi,
					'status'		=> $result->status,
					'datadukung'	=> $datadukung,
					'created_by'	=> $result->created_by,
					'updated_by'	=> $result->updated_by,
					'created_at'	=> $result->created_at->tostring(),
					'updated_at'	=> $result->updated_at->tostring(),
				);
			}
			echo json_encode($arraygambar);
		}
	}
	public function getRekaptask() {
		$arraygambar 	= [];
		$jpenerima		= Tugasdeveloper::groupBy('status')->get();
		if (!empty($jpenerima)){
			foreach ($jpenerima as $result) {
				$status	= $result->status;
				$jumlah	= Tugasdeveloper::where('status', $status)->count();
				$arraygambar[] = array(
					'kelompok'	=> $status,
					'jumlah'	=> $jumlah,
				);
			}
			echo json_encode($arraygambar);
		}
    }
	public function mailbox() {
        $data				= [];
        $previlage			= Session('jabatan');
		$idusername			= Session('id');
		$iduser				= $idusername;
		$jmerangkap			= User::where('username', Session('username'))->first();
		if (isset($jmerangkap->merangkap)){
			$merangkap		= $jmerangkap->merangkap;
			$idpeg			= $jmerangkap->nip;
		} else { $merangkap = '';  $idpeg = 0; }
		
		
		if ($idpeg == ''){
			$golongan 			= Golongan::orderBy('id', 'ASC')->get();
			$data['fakultass'] 	= User::whereNotIn('fakultas', ['KP', 'XX', 'Safehouse'])->orderBy('fakpanjang', 'ASC')->groupBy('fakultas')->get();
			$data['idpeg'] 		= $idpeg;
			$data['nip'] 		= $idpeg;
			$data['golongan'] 	= $golongan;
			$data['semula'] 	= 'mailbox';
			return view('anyari', $data);
		} else {
			$cekinbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$jpegawai 				= Simpegpegawai::all();
			$data 					= [];
			$cekprevilage			= Pejabatsurat::where('pejabat', $previlage)->count();
			if ($cekprevilage != 0){
				$i 			= 0;
				$data		= [];
				$mcmdispo	= [];
				$fakultas	= Session('fakultas');
				$units		= Unitsurat::all();
				$mcmdispo	= Macamdisposisi::where('fakultas', $fakultas)->get();
				$mkelompok 	= Session('jabatan');
				if ($merangkap == null OR $merangkap == ''){
					$cdatane			= Tujuandisposisi::where('kelompok', 'LIKE', $mkelompok)->count();
					if ($cdatane != 0){
						$jdatane		= Tujuandisposisi::where('kelompok', 'LIKE', $mkelompok)->orderBy('tabel', 'ASC')->orderBy('kodeunit', 'ASC')->get();
						foreach ($jdatane as $result) {
							$idtujuan 	= $result->idtujuan;
							$tabel 		= $result->tabel;
							if ($tabel == 'Pejabat'){
								$cekpjbt 	= Pejabatsurat::where('id', $idtujuan)->count();
								if ($cekpjbt == 0){
									$pejabat = $idtujuan.' => Deleted';
								}else {
									$qpejabat 	= Pejabatsurat::where('id', $idtujuan)->first();
									$pejabat 	= $qpejabat->pejabat;
									$data['pejabat'][$i]['kode']	=   $pejabat;
									$data['pejabat'][$i]['nama']	=   $pejabat;
									$i++;
								}
								
							} else {
								$cekpjbt 	= Kelompoklain::where('id', $idtujuan)->count();
								if ($cekpjbt == 0){
									$pejabat = $idtujuan.' => Non Pejabat Deleted';
								}else {
									$qpejabat 		= Kelompoklain::where('id', $idtujuan)->first();
									$kodekelompok 	= $qpejabat->namakelompok;
									$jklmplaindet 	= User::where('previlage', $kodekelompok)->where('fakultas', $fakultas)->get();
									foreach($jklmplaindet as $rklmplaindet) {
										$tulisanne 	= $kodekelompok.' ( '.$rklmplaindet->nama.' )';
										$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
										$data['pejabat'][$i]['nama']	=   $tulisanne;
										$i++;
									}
								}
							}
							
						}
					}
				} else {
					$cdatane			= Tujuandisposisi::whereIn('kelompok', [$mkelompok, $merangkap])->count();
					if ($cdatane != 0){
						$jdatane		= Tujuandisposisi::whereIn('kelompok', [$mkelompok, $merangkap])->orderBy('tabel', 'ASC')->orderBy('kodeunit', 'ASC')->groupBy('idtujuan')->get();
						foreach ($jdatane as $result) {
							$idtujuan 	= $result->idtujuan;
							$tabel 		= $result->tabel;
							if ($tabel == 'Pejabat'){
								$cekpjbt 	= Pejabatsurat::where('id', $idtujuan)->count();
								if ($cekpjbt == 0){
									$pejabat = $idtujuan.' => Deleted';
								}else {
									$qpejabat 	= Pejabatsurat::where('id', $idtujuan)->first();
									$pejabat 	= $qpejabat->pejabat;
									$data['pejabat'][$i]['kode']	=   $pejabat;
									$data['pejabat'][$i]['nama']	=   $pejabat;
									$i++;
								}
								
							} else {
								$cekpjbt 	= Kelompoklain::where('id', $idtujuan)->count();
								if ($cekpjbt == 0){
									$pejabat = $idtujuan.' => Non Pejabat Deleted';
								}else {
									$qpejabat 		= Kelompoklain::where('id', $idtujuan)->first();
									$kodekelompok 	= $qpejabat->namakelompok;
									$jklmplaindet 	= User::where('previlage', $kodekelompok)->where('fakultas', $fakultas)->groupBy('nama')->get();
									foreach($jklmplaindet as $rklmplaindet) {
										$tulisanne 	= $kodekelompok.' ( '.$rklmplaindet->nama.' )';
										$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
										$data['pejabat'][$i]['nama']	=   $tulisanne;
										$i++;
									}
								}
							}
							
						}
					}
				}
				if ($i == 0){
					if ($merangkap == null OR $merangkap == ''){
						
					} else {
						$getdatamerangkap = Pejabatsurat::where('pejabat', $merangkap)->first();
						if (isset($getdatamerangkap->fakultas)){
							$fakmerangkap = $getdatamerangkap->fakultas;
							$jklmplaindet 	= User::where('fakultas', $fakmerangkap)->whereNotIn('previlage', [$merangkap, 'mahasiswa', 'mahasiswa magister', 'mahasiswa doktoral', 'admin'])->orderBy('previlage', 'ASC')->get();
							foreach($jklmplaindet as $rklmplaindet) {
								$cekjenise  = Pejabatsurat::where('pejabat', $rklmplaindet->previlage)->count();
								if ($cekjenise != 0){
									$data['pejabat'][$i]['kode']	=   $rklmplaindet->previlage;
									$data['pejabat'][$i]['nama']	=   $rklmplaindet->previlage;
								} else {
									$tulisanne 	= $rklmplaindet->previlage.' ( '.$rklmplaindet->nama.' )';
									$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
									$data['pejabat'][$i]['nama']	=   $tulisanne;	
								}
								$i++;
							}
						}
					}
					$jklmplaindet 	= User::where('fakultas', $fakultas)->whereNotIn('previlage', [$mkelompok, $merangkap, 'mahasiswa', 'mahasiswa magister', 'mahasiswa doktoral', 'admin'])->orderBy('previlage', 'ASC')->get();
					foreach($jklmplaindet as $rklmplaindet) {
						$cekjenise  = Pejabatsurat::where('pejabat', $rklmplaindet->previlage)->count();
						if ($cekjenise != 0){
							$data['pejabat'][$i]['kode']	=   $rklmplaindet->previlage;
							$data['pejabat'][$i]['nama']	=   $rklmplaindet->previlage;
						} else {
							$tulisanne 	= $rklmplaindet->previlage.' ( '.$rklmplaindet->nama.' )';
							$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
							$data['pejabat'][$i]['nama']	=   $tulisanne;	
						}
						$i++;
					}
				}
				$data['pejabat'][$i]['kode']	=   'Arsiparis Umum';
				$data['pejabat'][$i]['nama']	=   'Arsiparis Umum';
				$jgrpklas	= Jenissurat::where('status', '1')->groupBy('klasifikasi')->select('klasifikasi')->orderBy('klasifikasi')->get();
				$i			= 0;
				foreach ($jgrpklas as $rgrpklas) {
					$j  		= 0;
					$klasifikasi= $rgrpklas->klasifikasi;
					$jklas  	= Jenissurat::where('klasifikasi', $klasifikasi)->where('status', '1')->get();
					foreach ($jklas as $rklas) {
						$data['klasifs'][$i][$j]['jenis']	=   $rklas->jenis;
						$data['klasifs'][$i][$j]['kode']	=   $rklas->kode;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgrpklas as $kgrpklas) {
					$data['klasifikasi'][$x]  =   $kgrpklas->klasifikasi;
					$x++;
				}
				if ($merangkap != ''){
					$ceksrtmasuk	= Inboxsurat::whereIn('penerima', [$mkelompok, $merangkap])
									->where('jenis', 'MASUK')
									->where('status', '!=', 'reply')
									->groupBy('marking')
									->get();
					$ceksrtkeluar	= Inboxsurat::whereIn('penerima', [$mkelompok, $merangkap])
									->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
									->where('status', 'send')
									->groupBy('marking')
									->get();
				} else {
					$ceksrtmasuk	= Inboxsurat::where('penerima', $mkelompok)
									->where('jenis', 'MASUK')
									->where('status', '!=', 'reply')
									->groupBy('marking')
									->get();
					$ceksrtkeluar	= Inboxsurat::where('penerima', $mkelompok)
									->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
									->where('status', 'send')
									->groupBy('marking')
									->get();
				}
				$cinbox = 0;
				if (!empty($ceksrtmasuk)){
					foreach ($ceksrtmasuk as $rinbox){
						$cinbox++;
					}
				}
				$coutbox = 0;
				if (!empty($ceksrtkeluar)){
					foreach ($ceksrtkeluar as $rinbox){
						$coutbox++;
					}
				}
				
				$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
				$data['countmailbox']      	= $countmailbox;
				$data['countinboxmasuk']    = $cinbox;
				$data['countinboxkeluar']   = $coutbox;
				$data['pegawaine']			= $jpegawai;
				$data['countmailbox']		= $cekinbox;
				$data['sidebar']			= 'mailbox';
				$data['units']      		= $units;
				$data['mcmdispo']   		= $mcmdispo;
				return view('mailboxpimpinan', $data);
			} else {
				$data['pegawaine']		= $jpegawai;
				$data['countmailbox']	= $cekinbox;
				$data['sidebar']		= 'mailbox';
				return view('mailbox', $data); 
			}
			
		}
    }
	public function profile() {
        $data			= [];
        $iduser			= Session('id');
		$previlage		= Session('previlage');
		$idpeg			= 0;
		if ($previlage == 'mahasiswa' OR $previlage == 'mahasiswa magister' OR $previlage == 'mahasiswa doktoral'){
			return redirect('profileuser'); 
		} else if ($previlage == 'Peserta Ujian Dinas'){
			return redirect('portaludin');
		} else {
			$ceknip			= User::where('username', Session('username'))->count();
			if ($ceknip != 0){
				$getnip		= User::where('username', Session('username'))->first();
				$idpeg		= $getnip->nip;
				$getpegawai	= Simpegpegawai::where('id', $idpeg)->first();
				if (isset($getpegawai->nip_baru)){
					$nip 	= $getpegawai->nip_baru;
					$email 	= $getpegawai->email_ub;
				} else { $nip = ''; }
			} else { $idpeg = ''; $nip = ''; $email = ''; }
			
			$golongan 			= Golongan::orderBy('id', 'ASC')->get();
			$data['fakultass'] 	= User::whereNotIn('fakultas', ['KP', 'XX', 'Safehouse'])->orderBy('fakpanjang', 'ASC')->groupBy('fakultas')->get();
			$data['idpeg'] 		= $idpeg;
			$data['nip'] 		= $nip;
			$data['golongan'] 	= $golongan;
			$data['sidebar']	= 'frontpage';
			return view('anyari', $data);
		}
    }
	public function manualbook() {
        $data			= [];
        $iduser			= Session('id');
		$previlage		= Session('previlage');
		$ceknip			= User::where('username', Session('username'))->count();
		$homebase		= url("/");
		$data['sidebar']= 'manualbook';
		return view('manualbook', $data); 
    }
    public function viewTemplatesurat() {
        $data			= [];
        $iduser			= Session('id');
		$previlage		= Session('previlage');
		$ceknip			= User::where('username', Session('username'))->count();
		$homebase		= url("/");
		$data['sidebar']= 'templatesurat';
		return view('templatesurat', $data); 
    }
    public function bukutamuadmin() {
    	$pejabats			= User::orderBy('nama', 'ASC')->get();
    	$data 				= [];
		$data['sidebar'] 	= 'bukutamuadmin';
		$data['pejabats'] 	= $pejabats;
    	return view('bukutamuadmin', $data);
    }
	public function viewTodolist() {
    	$data 				= [];
		$i 					= 0;
		$fakultas			= Session('fakultas');
		$mkelompok 			= Session('jabatan');
		$tempnama 			= array("Plt. ", "Plh. ");
        $mkelompok 			= str_replace($tempnama, "", $mkelompok);
		$cdatane			= Tujuandisposisi::where('kelompok', 'LIKE', $mkelompok)->count();
		if ($cdatane != 0){
			$jdatane		= Tujuandisposisi::where('kelompok', 'LIKE', $mkelompok)->orderBy('tabel', 'ASC')->orderBy('idtujuan', 'ASC')->get();
			foreach ($jdatane as $result) {
				$idtujuan 	= $result->idtujuan;
				$tabel 		= $result->tabel;
				if ($tabel == 'Pejabat'){
					$cekpjbt 	= Pejabatsurat::where('id', $idtujuan)->count();
					if ($cekpjbt == 0){
						$pejabat = $idtujuan.' => Deleted';
					}else {
						$qpejabat 	= Pejabatsurat::where('id', $idtujuan)->first();
						$pejabat 	= $qpejabat->pejabat;
						$data['pejabat'][$i]['kode']	=   $pejabat;
						$data['pejabat'][$i]['nama']	=   $pejabat;
						$i++;
					}
				} else {
					$cekpjbt 	= Kelompoklain::where('id', $idtujuan)->count();
					if ($cekpjbt == 0){
						$pejabat = $idtujuan.' => Non Pejabat Deleted';
					}else {
						$qpejabat 		= Kelompoklain::where('id', $idtujuan)->first();
						$kodekelompok 	= $qpejabat->namakelompok;
						$jklmplaindet 	= User::where('previlage', $kodekelompok)->where('fakultas', $fakultas)->get();
						foreach($jklmplaindet as $rklmplaindet) {
							$tulisanne 	= $kodekelompok.' ( '.$rklmplaindet->nama.' )';
							$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
							$data['pejabat'][$i]['nama']	=   $tulisanne;
							$i++;
						}
					}
				}
				
			}
		}
		if ($i == 0){
			$jklmplaindet 	= User::where('fakultas', $fakultas)->where('previlage', '!=', $mkelompok)->get();
			foreach($jklmplaindet as $rklmplaindet) {
				$cekjenise  = Pejabatsurat::where('pejabat', $rklmplaindet->previlage)->count();
				if ($cekjenise != 0){
					$data['pejabat'][$i]['kode']	=   $rklmplaindet->previlage;
					$data['pejabat'][$i]['nama']	=   $rklmplaindet->previlage;
				} else {
					$tulisanne 	= $rklmplaindet->previlage.' ( '.$rklmplaindet->nama.' )';
					$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
					$data['pejabat'][$i]['nama']	=   $tulisanne;	
				}
				$i++;
			}
			$data['pejabat'][$i]['kode']	=   'Arsiparis Umum';
			$data['pejabat'][$i]['nama']	=   'Arsiparis Umum';
		}
		$data['sidebar'] 	= 'todolist';
		$data['pengumumans']= Tugasdeveloper::where('created_by', Session('id'))->get();
		return view('todo', $data);
    }
	public function viewMipa() {
		$fakultas	= 'FMIPA';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$urutanwerno = array('red','green','blue','black','navy','teal','orange','maroon','black','aqua');
			$groups     =   Pengumuman::where('fakultas', $fakultas)->select('tanggal')->where('jenis', '!=', 'mahasiswa')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
			$y      	=   0;
			$x      	=   0;
			$data   	=   [];
			foreach ($groups as $group) {
				$tanggal    = $group->tanggal;
				$rsurat     = Pengumuman::where('fakultas', $fakultas)->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
				foreach ($rsurat as $rowpeng) {
					$id             =   $rowpeng->id;
					$jenis          =   $rowpeng->jenis;
					$siapa          =   $rowpeng->siapa;
					$nim            =   $rowpeng->nim;
					$pengumuman     =   $rowpeng->pengumuman;   
					$created_at     =   $rowpeng->kapan;
					$kapan          =   timeAgo($created_at);
					if ($jenis == 'mahasiswa') { 
						$nama = $siapa.'('.$nim.')';
						$iconne = 'fa-user';
						$jencolor = 'green';
					} else { 
						$nama = $siapa; 
						$iconne = 'fa-bullhorn';
						$jencolor = 'red';
					}
					
					$data['pengumumans'][$x]['id']          =   $id;
					$data['pengumumans'][$x]['tanggal']     =   $tanggal;
					$data['pengumumans'][$x]['kapan']       =   $kapan;
					$data['pengumumans'][$x]['jencolor']    =   $jencolor;
					$data['pengumumans'][$x]['jenis']       =   $jenis;
					$data['pengumumans'][$x]['siapa']       =   $siapa;
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
			$jadwal 	= Jadwalkuliah::where('fakultas', $fakultas)->where('jenis', 'Kegiatan')->orderBy('mulai', 'DESC')->limit(100)->get();
			$i 			= 0;
			foreach($jadwal as $hcari) {
				$ruang     	= $hcari->ruang;
				$gedung    	= '';
				$mulai    	= $hcari->mulai;
				$akhir    	= $hcari->akhir;
				$peminjam   = addslashes($hcari->namadosen);
				$keperluan  = addslashes($hcari->semester);
				$arrayttl 	= explode(" ", $mulai);
				$tanggal	= $arrayttl[0];
				$jam 		= $arrayttl[1];
				
				$arraytgl 	= explode(" ", $akhir);
				$dd 		= $arraytgl[0];
				$akhir 		= $arraytgl[1];
				
				$keperluan 	= str_replace(array("\r", "\n"), '', $keperluan);
				$keperluan 	= str_replace('"', '\"', $keperluan);
				$keperluan 	= str_replace("'", "\'", $keperluan);
				$keperluan 	= str_replace("<ol>", "", $keperluan);
				$keperluan 	= str_replace("<li>", "-", $keperluan);
				$keperluan 	= str_replace("</li>", "", $keperluan);
				$keperluan 	= str_replace("</ol>", "", $keperluan);
				if ($ruang == ''){
					$judul		= $peminjam.' Nama Kegiatan : '.$keperluan;
				}else {
					$judul		= $peminjam.' Mengadakan kegiatan di Ruang '.$ruang.' Nama Kegiatan : '.$keperluan;
				}
				$start		= $tanggal.'T'.$jam;
				$end		= $dd.'T'.$akhir;
				$data['kalender'][$i]['title']	=   $judul;
				$data['kalender'][$i]['start']	=   $start;
				$data['kalender'][$i]['end']	=   $end;
				
				$i++;
			}
			if ($i == 0){
				$mulai = date("Y-m-d");
				$data['kalender'][$i]['title']	=   'Add Some Schedule';
				$data['kalender'][$i]['start']	=   $mulai;
				$data['kalender'][$i]['end']	=   $mulai;
			}
			$data['sekarang'] 	= 	date('Y-m-d');
            return view('mipa.login', $data);
        }
    }
	public function viewPertanian() {
		$fakultas	= 'FP';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$urutanwerno = array('red','green','blue','black','navy','teal','orange','maroon','black','aqua');
			$groups     =   Pengumuman::where('fakultas', $fakultas)->select('tanggal')->where('jenis', '!=', 'mahasiswa')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
			$y      	=   0;
			$x      	=   0;
			$data   	=   [];
			foreach ($groups as $group) {
				$tanggal    = $group->tanggal;
				$rsurat     = Pengumuman::where('fakultas', $fakultas)->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
				foreach ($rsurat as $rowpeng) {
					$id             =   $rowpeng->id;
					$jenis          =   $rowpeng->jenis;
					$siapa          =   $rowpeng->siapa;
					$nim            =   $rowpeng->nim;
					$pengumuman     =   $rowpeng->pengumuman;   
					$created_at     =   $rowpeng->kapan;
					$kapan          =   timeAgo($created_at);
					if ($jenis == 'mahasiswa') { 
						$nama = $siapa.'('.$nim.')';
						$iconne = 'fa-user';
						$jencolor = 'green';
					} else { 
						$nama = $siapa; 
						$iconne = 'fa-bullhorn';
						$jencolor = 'red';
					}
					
					$data['pengumumans'][$x]['id']          =   $id;
					$data['pengumumans'][$x]['tanggal']     =   $tanggal;
					$data['pengumumans'][$x]['kapan']       =   $kapan;
					$data['pengumumans'][$x]['jencolor']    =   $jencolor;
					$data['pengumumans'][$x]['jenis']       =   $jenis;
					$data['pengumumans'][$x]['siapa']       =   $siapa;
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
			$jadwal 	= Jadwalkuliah::where('fakultas', $fakultas)->where('jenis', 'Kegiatan')->orderBy('mulai', 'DESC')->limit(100)->get();
			$i 			= 0;
			foreach($jadwal as $hcari) {
				$ruang     	= $hcari->ruang;
				$gedung    	= '';
				$mulai    	= $hcari->mulai;
				$akhir    	= $hcari->akhir;
				$peminjam   = addslashes($hcari->namadosen);
				$keperluan  = addslashes($hcari->semester);
				$arrayttl 	= explode(" ", $mulai);
				$tanggal	= $arrayttl[0];
				$jam 		= $arrayttl[1];
				
				$arraytgl 	= explode(" ", $akhir);
				$dd 		= $arraytgl[0];
				$akhir 		= $arraytgl[1];
				
				$keperluan 	= str_replace(array("\r", "\n"), '', $keperluan);
				$keperluan 	= str_replace('"', '\"', $keperluan);
				$keperluan 	= str_replace("'", "\'", $keperluan);
				$keperluan 	= str_replace("<ol>", "", $keperluan);
				$keperluan 	= str_replace("<li>", "-", $keperluan);
				$keperluan 	= str_replace("</li>", "", $keperluan);
				$keperluan 	= str_replace("</ol>", "", $keperluan);
				if ($ruang == ''){
					$judul		= $peminjam.' Nama Kegiatan : '.$keperluan;
				}else {
					$judul		= $peminjam.' Mengadakan kegiatan di Ruang '.$ruang.' Nama Kegiatan : '.$keperluan;
				}
				$start		= $tanggal.'T'.$jam;
				$end		= $dd.'T'.$akhir;
				$data['kalender'][$i]['title']	=   $judul;
				$data['kalender'][$i]['start']	=   $start;
				$data['kalender'][$i]['end']	=   $end;
				
				$i++;
			}
			if ($i == 0){
				$mulai = date("Y-m-d");
				$data['kalender'][$i]['title']	=   'Add Some Schedule';
				$data['kalender'][$i]['start']	=   $mulai;
				$data['kalender'][$i]['end']	=   $mulai;
			}
			$data['sekarang'] 	= 	date('Y-m-d');
            return view('pertanian.login', $data);
        }
    }
	public function viewTeknik() {
		$fakultas	= 'FT';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewFilkom() {
		$fakultas	= 'FILKOM';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewHukum() {
		$fakultas	= 'FH';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewFadministrasi() {
		$fakultas	= 'FIA';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewKedokteran() {
		$fakultas	= 'FK';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewBudaya() {
		$fakultas	= 'FIB';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewPerikanan() {
		$fakultas	= 'FPIK';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewEkonomi() {
		$fakultas	= 'FEB';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewKedokteranGigi() {
		$fakultas	= 'FKG';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewPeternakan() {
		$fakultas	= 'FAPET';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewPsikologi() {
		$fakultas	= 'FISIP';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewKedokteranHewan() {
		$fakultas	= 'FKH';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewTeknologiPertanian() {
		$fakultas	= 'FTP';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewFikes() {
		$fakultas	= 'FIKES';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewUBKediri() {
		$fakultas	= 'PSLKU';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewUBJakarta() {
		$fakultas	= 'PSDKUJAKARTA';
        $group 	 	= Session('previlage');
        if ($group != '') {
            return redirect('dashboardmhs');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$data['register'] 	= 	'register'.$fakultas;
            $data['fakultas'] 	= 	$fakultas;
            $data['fakpanjang'] = 	$fakpanjang;
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('loginmhs', $data);
        }
    }
	public function viewRegMHSFT(Request $request){
		$fakultas	= 'FT';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFILKOM(Request $request){
		$fakultas	= 'FILKOM';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFIA(Request $request){
		$fakultas	= 'FIA';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFK(Request $request){
		$fakultas	= 'FK';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFIB(Request $request){
		$fakultas	= 'FIB';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFPIK(Request $request){
		$fakultas	= 'FPIK';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFEB(Request $request){
		$fakultas	= 'FEB';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFKG(Request $request){
		$fakultas	= 'FKG';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFAPET(Request $request){
		$fakultas	= 'FAPET';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFISIP(Request $request){
		$fakultas	= 'FISIP';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFKH(Request $request){
		$fakultas	= 'FKH';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFTP(Request $request){
		$fakultas	= 'FTP';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFH(Request $request){
		$fakultas	= 'FH';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFMIPA(Request $request){
		$fakultas	= 'FMIPA';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	'mipa';
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFP(Request $request){
		$fakultas	= 'FP';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSPPS(Request $request){
		$fakultas	= 'PASCAUB';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	'pps';
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSVokasi(Request $request){
		$fakultas	= 'FV';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSFIKES(Request $request){
		$fakultas	= 'FIKES';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSPSLKU(Request $request){
		$fakultas	= 'PSLKU';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }

			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSPSDKUJAKARTA(Request $request){
		$fakultas	= 'PSDKUJAKARTA';
        $group 	 	= Session('previlage');
        $data 		= [];
		if ($group != '') {
            return redirect('frontpagepps');
        } else {
			$getfakpanjang		= 	User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
			if (isset($getfakpanjang->fakpanjang)){
				$fakpanjang		= $getfakpanjang->fakpanjang;
			} else { $fakpanjang = config('global.Title'); }
			$jgroupps	= MasterPS::where('namafak', $fakpanjang)->groupBy('jenjang')->select('jenjang')->orderBy('jenjang')->get();
			$i			= 0;
			if (!empty($jgroupps)){
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', $fakpanjang)->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$data['klasifps'][$i][$j]['nama']	=   $rklas->nama.' ( '.$rklas->namafak.' )';
						$data['klasifps'][$i][$j]['id']		=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  = 0;
				foreach ($jgroupps as $kgrpklas) {
					$data['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
			}
			if ($i == 0){
				$data['klasifikasips'][0]  		=   'No Data';
				$data['klasifps'][0][0]['nama']	=   'No Data';
				$data['klasifps'][0][0]['id']	=   0;
			}
			$data['kembali'] 	= 	strtolower($fakultas);
            $data['sekarang'] 	= 	date('Y-m-d');
            return view('register', $data);
        }
    }
	public function viewRegMHSALL(Request $request){
		$getfakpanjang		= 	User::where('fakultas', 'PASCAUB')->orWhere('fakultas', 'LIKE', 'F%')->groupBy('fakultas')->get();
		$data['fakultas'] 	= 	$getfakpanjang;
		$data['sekarang'] 	= 	date('Y-m-d');
		return view('registerall', $data);
    }
	public function chatGetlist(Request $request) {
		$idevent		= $request->input('val02');
		
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		if (Session('sekolah_id_sekolah') !== null){
			$idsekolah 	= Session('sekolah_id_sekolah');
			$logo 		= Session('sekolah_logo');
		} else {
			$idsekolah	= Session('fakultas');
			$logo 		= Session('avatar');
		}
		$isipesan		= '';
		$getdata 		= User::where('username', Session('username'))->first();
		if (isset($getdata->id)){
			$klsajar 	= $getdata->klsajar;
		} else { $klsajar = ''; }
	    if ($klsajar == 'test'){
			$qcatting	= null;
			echo '
			<div class="direct-chat-msg left">
				<div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-right">Waktu Terlarang</span>
					<span class="direct-chat-timestamp pull-left">Now</span>
				</div><!-- /.direct-chat-info -->
				<img class="direct-chat-img" src="/mascot.png" alt="message user image" />
				<div class="direct-chat-text">
					No Chat While On Test Mode
				</div>
			</div>';
		} else {
			if ($idevent == '' OR $idevent == '0' OR $idevent == null){
				$qcatting	= Chatting::where('id_sekolah', $idsekolah)->orderBy('id', 'DESC')->limit(100)->get();
			} else {
				$qcatting	= Chatting::where('id_sekolah', $idevent)->orderBy('id', 'DESC')->limit(100)->get();
			}
		}
		if (!empty($qcatting)){
			foreach ($qcatting as $chat) {
				$pesan 		= $chat->pesannya;				
				$waktu 		= $chat->created_at;
				$nama 		= $chat->nama;
				$ket 		= $chat->ket;
				if ($ket == '' OR is_null($ket)){
					if ($logo == ''){
						$gravatar1 	= url('/mascot.png');
						$gravatar2 	= url('/duidev-softwarehouse.png');
					} else {
						$gravatar1 	= $logo;
						$gravatar2	= $logo;
					}
				} else {
					$gravatar1 = $ket;
					$gravatar2 = $ket;
				}
				if ($nama == $nmlengkap){
					echo '<div class="direct-chat-msg left">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">'.$nama.'</span>
								<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
							</div>
							<img class="direct-chat-img" src="'.$gravatar1.'" alt="message user image" />
							<div class="direct-chat-text">
								'.$pesan.'
							</div>
						</div>';
				} else {
					echo '<div class="direct-chat-msg right">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">'.$nama.'</span>
								<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
							</div>
							<img class="direct-chat-img" src="'.$gravatar2.'" alt="message user image" />
							<div class="direct-chat-text">
								'.$pesan.'
							</div>
						</div>';
				}
			}
		}
    }
	public function cattingSurat(Request $request) {
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		$pesan		= $request->input('val01');
		$idevent	= $request->input('idevent');
		$getdata 	= User::where('username', Session('username'))->first();
		if (isset($getdata->id)){
			$klsajar 	= $getdata->klsajar;
		} else { $klsajar = ''; }
		if ($idevent == '' OR $idevent == '0' OR $idevent == null){
			if (Session('sekolah_id_sekolah') !== null){
				$idsekolah 	= Session('sekolah_id_sekolah');
				$logo 		= Session('sekolah_logo');
			} else {
				$idsekolah	= Session('fakultas');
				$logo 		= Session('avatar');
			}
		} else {
			$idsekolah 	= $idevent;
			$logo 		= $request->input('val03');
		}
		if ($logo == ''){
			$gravatar 	= url('/duidev-softwarehouse.png');
		} else {
			$gravatar	= $logo;
		}
		if ($pesan != ''){
			$pesan			= str_replace(':)', '&#128522;', $pesan);
			$pesan			= str_replace('T_T', '&#128557;', $pesan);
			$pesan			= str_replace('>.<', '&#128518;', $pesan);
			$pesan			= str_replace('^_v', '&#128540;', $pesan);
			$pesan			= str_replace('<', '&#60;', $pesan);
			$pesan			= str_replace('>', '&#62;', $pesan);
			$pesan			= str_replace('.', '&#46;', $pesan);
			$pesan			= str_replace('"', '&#34;', $pesan);
			$pesan			= str_replace('#', '&#35;', $pesan);
			$pesan			= str_replace('$', '&#36;', $pesan);
			$pesan			= str_replace('%', '&#37;', $pesan);
			$pesan			= str_replace('&', '&#38;', $pesan);
			$pesan			= str_replace('+', '&#43;', $pesan);
			$pesan			= str_replace('@', '&#64;', $pesan);
			$pesan			= str_replace('?', '&#63;', $pesan);
			$pesan			= str_replace('^', '&#94;', $pesan);
			$pesan			= str_replace('{', '&#123;', $pesan);
			$pesan			= str_replace('}', '&#125;', $pesan);
			$pesan			= str_replace('`', '&#96;', $pesan);
			$pesan			= str_replace("'", "&#39;", $pesan);
			$pesan			= str_replace("(", "&#40;", $pesan);
			$pesan			= str_replace(")", "&#41;", $pesan);
			if ($klsajar == 'test'){
			} else {
				$input = Chatting::insert([
					'kelompok'  	=>  $kelompok,
					'nama'  		=>  $nmlengkap,
					'pesannya'		=>  $pesan,
					'ket'			=>  $gravatar,
					'id_sekolah'	=>	$idsekolah
				]);
			}
		}
		
		$logo 		= Session('sekolah_logo');
		$isipesan	= '';
		if ($klsajar == 'test'){
			$qcatting	= null;
			if (Session('fakultas') == 'iwis'){
				echo '<table class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Chatting Yet</th></tr></thead></table>';
			} else {
			echo '
				<div class="direct-chat-msg left">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">Waktu Terlarang</span>
						<span class="direct-chat-timestamp pull-left">Now</span>
					</div><!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="/mascot.png" alt="message user image" />
					<div class="direct-chat-text">
						No Chat While On Test Mode
					</div>
				</div>';
			}
		} else {
			$qcatting	= Chatting::where('id_sekolah', $idsekolah)->orderBy('id', 'DESC')->limit(100)->get();
    	}
		if (!empty($qcatting)){
			if (Session('fakultas') == 'iwis'){
				echo '<table class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Chatting Yet</th></tr></thead></table>';
			}
			foreach ($qcatting as $chat) {
				$pesan 		= $chat->pesannya;				
				$waktu 		= $chat->created_at;
				$nama 		= $chat->nama;
				$ket 		= $chat->ket;
				if ($ket == '' OR is_null($ket)){
					if ($logo == ''){
						$gravatar1 	= url('/mascot.png');
						$gravatar2 	= url('/duidev-softwarehouse.png');
					} else {
						$gravatar1 	= $logo;
						$gravatar2	= $logo;
					}
				} else {
					$gravatar1 = $ket;
					$gravatar2 = $ket;
				}
				if ($nama == $nmlengkap){
					echo '<div class="direct-chat-msg left">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">'.$nama.'</span>
								<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
							</div>
							<img class="direct-chat-img" src="'.$gravatar1.'" alt="message user image" />
							<div class="direct-chat-text">
								'.$pesan.'
							</div>
						</div>';
				} else {
					echo '<div class="direct-chat-msg right">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">'.$nama.'</span>
								<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
							</div>
							<img class="direct-chat-img" src="'.$gravatar2.'" alt="message user image" />
							<div class="direct-chat-text">
								'.$pesan.'
							</div>
						</div>';
				}
			}
		}
    }
	
}
