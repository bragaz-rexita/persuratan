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
use App\Bankjawaban;
use App\Banksoal;
use App\Banksoalujian;
use App\Banksoaltest;
use App\Banksoalkelompok;
use App\Simpegpegawai;
use App\Banksoalaktif;
use App\Pengumuman;
use App\Setting;
use App\Models\MasterPS;
use Validator;
use Session;
use QrCode;
use Auth;
use Hash;
use DateTime;
use FeedReader;
use Carbon\Carbon;
define( 'API_ACCESS_SOAL', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );
define( 'namaapps07', 'Bank Soal' );
define( 'domainapps07', 'Kolegium Radiologi Indonesia' );
define( 'subdomainapps07', 'BS' );
define( 'subsubdomainapps07', 'Komisi Ujian Nasional Kompetensi Radiologi' );
define( 'addressapps07', 'Jl. Pangeran Diponegoro No.5, RW.5, Kenari, Kec. Senen, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10430, Indonesia' );
define( 'emailapps07', 'kunkri2022@gmail.com' );
define( 'lamanapps07', 'https://inabr.or.id/' );
define( 'logofrontapps07', 'frontpage.png' );
function timeAgoBS($time_ago) {
	$time_ago 		= strtotime($time_ago);
	$cur_time   	= time();
	$time_elapsed   = $cur_time - $time_ago;
	$seconds    	= $time_elapsed ;
	$minutes    	= round($time_elapsed / 60 );
	$hours      	= round($time_elapsed / 3600);
	$days       	= round($time_elapsed / 86400 );
	$weeks      	= round($time_elapsed / 604800);
	$months     	= round($time_elapsed / 2600640 );
	$years      	= round($time_elapsed / 31207680 );

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
class BankSoalController extends Controller
{
    public function index() {
        $data                       = [];
        $homebase					= url("/");
		$getdomainid 				= DB::table('app_menu')->where('route', 'LIKE', $homebase.'%')->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_bt.$id;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_bt.$id;
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
			$data['namaapps01']  		= namaapps07;
			$data['domainapps01']  		= domainapps07;
			$data['subdomainapps01']  	= subdomainapps07;
			$data['subsubdomainapps01'] = subsubdomainapps07;
			$data['addressapps01']  	= addressapps07;
			$data['emailapps01']  		= emailapps07;
			$data['lamanapps01']  		= lamanapps07;
			$data['logofrontapps01']  	= logofrontapps07;
			$data['lamanportal']		= $homebase;
		}
        $data['sidebar']			= 'frontpage';
		$data['firebaseid']			= '';
		if (Session('previlage') !== null AND Session('fakultas') == 'BS') {
            if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator' OR Session('previlage') == 'inputor' OR Session('previlage') == 'penguji'){
				if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator'){
					$soalterverifikasi 	   	= Banksoal::where('active', 1)->where('view', '1')->count();
					$soaltidakterverikasi 	= Banksoal::where('active', 1)->where('view', '0')->count();
					$data['mohonverifikasi']= Banksoal::where('active', 1)->where('view', '0')->orderBy('id', 'DESC')->count();
					$data['ujian']   		= Banksoaltest::where('status', 1)->groupBy('marking')->count();
					$data['kodelist']   	= Banksoal::where('active', 1)->groupBy('kode')->get();
					$data['pesertas']   	= Simpegpegawai::whereIn('jenispeg', ['peserta', 'warga'])->where('ppabp', Session('fakpanjang'))->get();
					$data['kelompokspv']   	= Simpegpegawai::whereIn('jenispeg', ['verifikator', 'inputor', 'administarator'])->where('ppabp', Session('fakpanjang'))->get();
				} else {
					$soalterverifikasi 	   	= Banksoal::where('created_by', Session('email'))->where('view', '1')->where('active', 1)->count();
					$soaltidakterverikasi	= Banksoal::where('created_by', Session('email'))->where('view', '0')->where('active', 1)->count();
					$data['ujian']   		= Banksoaltest::where('created_by',Session('email'))->groupBy('marking')->count();
					$data['kodelist']   	= Banksoal::where('active', 1)->groupBy('kode')->get();
					$data['mohonverifikasi']= Banksoal::where('active', 1)->where('view', '0')->where('verified_by', Session('email'))->orderBy('id', 'DESC')->count();
				}
				$cekstatus 							= User::where('email', Session('email'))->first();
				if (isset($cekstatus->merangkap)){
					$merangkap 						= $cekstatus->merangkap;
				} else { $merangkap 				= ''; }
				$email 			= Session('email');
				if ($email == 'admin@banksoal.duidev.com'){ $email = 'admin@inabr.or.id'; }
				$getfakultas 	= Simpegpegawai::where('email', $email)->first();
				if (isset($getfakultas->id)){
					$idpeg 	= $getfakultas->id;
				} else {
					$idpeg 	= Session('id');
				}
				$koreksi 	= 0;
				$sql 		= Banksoaltest::where('idsupervisor', $idpeg)->where('status', '1')->get();
				if (!empty($sql)){
					foreach ($sql as $rows){
						$marking 		= $rows->marking;
						$namaujian 		= $rows->namaujian;
						$supervisor 	= $rows->supervisor;
						$idsoal 		= $rows->idsoal;
						$getmahasiswa 	= Banksoalujian::where('marking', $marking)->where('idsoal', $idsoal)->get();
						if (!empty($getmahasiswa)){
							foreach($getmahasiswa as $rmhs){
								$koreksi++;
							}
						}
					}
				}
				$data['koreksi']   					= $koreksi;
				$data['soalterverifikasi']       	= $soalterverifikasi;
				$data['soaltidakterverikasi']    	= $soaltidakterverikasi;
				$data['merangkap']    				= $merangkap;
				if (Session('previlage') == 'penguji'){
					return view('banksoal.pengujilisan', $data);
				} else {
					return view('banksoal.dashboard', $data);
				}
			} else {
				return redirect('profiluser');
			}
        } else {
			$i 				= 0;
			$berita			= [];
			$urutanwerno	= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$cekpengumuman  = Pengumuman::where('id_sekolah', Session('fakpanjang'))->where('kapan', '>=', Carbon::yesterday())->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->count();
			if ($cekpengumuman == 0){
				$f 			= FeedReader::read('https://www.jvir.org/current.rss');
				foreach ($f as $item){
					$f->get_title();
					if ($i != 10){
						if (isset($f->get_items()[$i])){
							$gambar         = $f->get_image_link();
							$conten         = $f->get_items()[$i]->get_content();
							$getarrkonten   = explode("</div>", $conten);
							$konten         = $getarrkonten[0];
							if ($gambar == '' OR $gambar == 'https://www.jvir.org' OR $gambar == 'www.jvir.org'){
								$gambar = $homebase.'/mascot.png';
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
			} else {
				$groups     = Pengumuman::where('id_sekolah', Session('fakpanjang'))->where('kapan', '>=', Carbon::yesterday())->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
				$y      	= 0;
				$x      	= 0;
				foreach ($groups as $group) {
					$tanggal    = $group->tanggal;
					$rsurat     = Pengumuman::where('id_sekolah', Session('fakpanjang'))->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
					foreach ($rsurat as $rowpeng) {
						$id             =   $rowpeng->id;
						$jenis          =   $rowpeng->jenis;
						$siapa          =   $rowpeng->siapa;
						$pengumuman     =   $rowpeng->pengumuman;   
						$created_at     =   $rowpeng->kapan;
						$kapan          =   timeAgoBS($created_at);
						if ($jenis == 'mahasiswa') { 
							$nama 		= $siapa.'('.$nim.')';
							$iconne 	= 'fa-user';
							$jencolor 	= 'green';
						} else { 
							$nama 		= $siapa; 
							$iconne 	= 'fa-bullhorn';
							$jencolor 	= 'red';
						}
						$data['berita'][$x]['title']     	=   $jenis;
						$data['berita'][$x]['conten']      	=   $siapa;
						$data['berita'][$x]['deskripsi']  	=   $pengumuman;
						$data['berita'][$x]['tanggal']      =   $kapan;
						$data['berita'][$x]['gambar']       =   $homebase.'/mascot.png';
						$data['berita'][$x]['link'] 		=   '/';
						if ($y == 9) {
							$y = 0; 
						} else {
							$y++; 
						}
						$x++;
					}
				}
			}
			return view('banksoal.login', $data);
        }
    }
	public function viewBankSoal() {
        $homebase		= url("/");
		$data			= [];
		$id				= Session('iduser');
		$previlage		= Session('previlage');
		$vowels 		= array("/r", "/r/n");
		if (Session('previlage') == 'PEJABAT' OR Session('previlage') == 'Admin SDM'){
			$skd  				= Banksoal::where('active', '1')->where('kode', 'KD')->count();
			$skb  				= Banksoal::where('active', '1')->where('kode', 'KB')->count();
			$arsip  			= Banksoal::where('active', '!=', '1')->count();
			$data['skd']  		= $skd;
			$data['skb']  		= $skb;
			$data['arsip']  	= $arsip;
			$data['sidebar']  	= 'banksoal';
			$data['users']  	= User::orderBy('id', 'DESC')->limit(10)->get();
			$data['pengumuman'] = MasterPS::orderBy('blnthnoperasional', 'DESC')->orderBy('created_at', 'DESC')->limit(10)->get();
			$data['rekap'] 		= Banksoal::where('active', '1')->select('ceel', 'kode', DB::Raw('COUNT(id) as jumlah'))->groupBy('ceel')->get();
			return view('banksoal.soalrekrutmen', $data);
		} else {
			return redirect('profiluser');
		}
    }
	public function exInputBankSoal(Request $request) {
		$idne		= $request->input('set01');
		$keterangan	= '';
		$idsoal		= 0;
		if ($idne == 'hapus'){
			$idne		= $request->input('set02');
			$getdata 	= Banksoal::where('id', $idne)->first();
			if (isset($getdata->id)){
				$lampiran 	= $getdata->lampiran;
				$cekdulu 	= Banksoalujian::where('idsoal', $idne)->count();
				if ($cekdulu == 0){
					if ($lampiran != ''){
						if (File::exists(public_path()."/".$lampiran)) {
							File::delete(public_path()."/".$lampiran);
						}
					}
					$input 		= Banksoal::where('id', $idne)->delete();
					$input 		= Bankjawaban::where('idsoal', $idne)->delete();
					$keterangan = 'Delete Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
				} else {
					if ($lampiran != ''){
						if (File::exists(public_path()."/".$lampiran)) {
							File::delete(public_path()."/".$lampiran);
						}
					}
					Banksoal::where('id', $idne)->update([
						'active'	=> 0
					]);
					$keterangan = 'Marking Non Aktif Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
				}
			} else {
				$keterangan = 'Delete Soal Dengan ID '.$idne.' Tidak ditemukan';
			}
		} else if ($idne == 'akhiriujian'){
			$idne		= $request->input('set02');
			if (Session('fakpanjang') == 'Rekrutmen PT DPM'){
				$keterangan = 'Back Home';
			} else {
				$update 	= User::where('username', Session('username'))->update([
					'klsajar'	=> '',
					'smt'		=> null,
					'updated_at'=> date("Y-m-d H:i:s")
				]);
				if ($update){
					$keterangan = 'Back Home';
				} else {
					$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
				}
			}
			
		} else if ($idne == 'onofpengumuman'){
			$marking	= $request->input('set02');
			$ceksek 	= Banksoaltest::where('marking', $marking)->first();
			if (isset($ceksek->id)){
				$pengumuman = $ceksek->pengumuman;
				if ($pengumuman == '0'){ $pengumuman = '1'; }
				else { $pengumuman = '0'; }
				$update 	= Banksoaltest::where('marking', $marking)->update([
					'pengumuman'	=> $pengumuman,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($update){
					Banksoalujian::where('marking', $ceksek->marking)->update([
						'pengumuman'	=> $pengumuman
					]);
					$keterangan = 'Pengumuman Telah di Update';
				} else {
					$keterangan = 'Marking Pengumuman Gagal dilakukan, silahkan ulangi beberapa saat lagi';
				}
			} else {
				$keterangan = 'Marking Tidak ditemukan';
			}

		} else if ($idne == 'hakpewancara'){
			$email		= $request->input('set02');
			$marking	= $request->input('set03');
			$ceksek 	= User::where('email', $email)->first();
			if (isset($ceksek->id)){
				$update 	= User::where('email', $email)->update([
					'merangkap'	=> 'Penguji Lisan',
					'smt'		=> $marking,
					'updated_at'=> date("Y-m-d H:i:s")
				]);
				if ($update){
					$keterangan = 'Hak Pewancara Berhasil di Tambahkan';
				} else {
					$keterangan = 'Gagal Menambahkan Hak Akses, Silahkan Ulangi Beberapa saat lagi';
				}
			} else {
				$keterangan = 'Email '.$email.' Tidak ditemukan';
			}
		} else if ($idne == 'removepeserta'){
			$idmahasiswa	= $request->input('set02');
			$marking		= $request->input('set03');
			$cekjawaban 	= Banksoalujian::where('marking', $marking)->where('idmahasiswa', $idmahasiswa)->where('jawaban', '!=', '')->count();
			if ($cekjawaban == 0){
				$update 	= Banksoalujian::where('marking', $marking)->where('idmahasiswa', $idmahasiswa)->delete();
				$keterangan = 'Peserta terhapus dari List';
			} else {
				$update 	= Banksoalujian::where('marking', $marking)->where('idmahasiswa', $idmahasiswa)->update([
					'status'		=> 3, //disable
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$keterangan = 'Peserta terset arsip dari List';
			}
			if ($update){
			} else {
				$keterangan = 'Remove Peserta Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'ubahspv'){
			$idspv			= $request->input('set02');
			$idujian		= $request->input('set03');
			$idsoal			= $request->input('set04');
			$getfakultas 	= Simpegpegawai::where('id', $idspv)->first();
			if (isset($getfakultas->id)){
				$inputor 	= $getfakultas->nama_lengkap;
			} else {
				$inputor 	= Session('nama');
			}
			$input 	= Banksoaltest::where('id', $idujian)->where('idsoal', $idsoal)->update([
				'idsupervisor'	=> $idspv,
				'supervisor'	=> $inputor,
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($input){
				$keterangan = 'Setting SPV an '.$inputor;
			} else {
				$keterangan = 'Update SPV an '.$inputor.' Gagal, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'tryout'){
			$idne		= $request->input('set02');
			$getidpeg 	= Simpegpegawai::where('email', Session('email'))->first();
			if (isset($getidpeg->id)){
				Banksoalujian::where('idmahasiswa', $getidpeg->id)->where('marking', $idne)->delete();
			}
			$update 	= User::where('username', Session('username'))->update([
				'klsajar'	=> 'tryout',
				'smt'		=> $idne,
				'updated_at'=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Lets Get Started';
			} else {
				$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'setujian'){
			$idne		= $request->input('set02');
			$update 	= User::where('username', Session('username'))->update([
				'klsajar'	=> 'test',
				'smt'		=> $idne,
				'updated_at'=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Lets Get Started';
			} else {
				$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'verifikasimulti'){
			$arrid		= $request->input('set02');
			foreach ($arrid as $idne){
				$getdata 	= Banksoal::where('id', $idne)->first();
				$inputor 	= 'Verified By '.Session('nama').' at '.date("Y-m-d H:i:s");
				$update 	= Banksoal::where('id', $idne)->update([
					'inputor'		=> $inputor,
					'verified_by'	=> Session('email'),
					'view'			=> 1,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($update){
					$keterangan = $keterangan.'ID '.$idne.' Activated; ';
				} else {
					$keterangan = $keterangan.'ID '.$idne.' Failed To Activated; ';
				}
			}
		} else if ($idne == 'verifikasi'){
			$idne		= $request->input('set02');
			if ($request->input('set03') !== null){
				$komen	= $request->input('set03');
			} else {
				$komen 	= '';
			}
			$getdata 	= Banksoal::where('id', $idne)->first();
			$inputor 	= $komen.' Verified By '.Session('nama').' at '.date("Y-m-d H:i:s");
			$update 	= Banksoal::where('id', $idne)->update([
				'inputor'		=> $inputor,
				'verified_by'	=> Session('email'),
				'view'			=> 1,
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Marking Aktif Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
			} else {
				$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'tolakverifikasi'){
			$idne		= $request->input('set02');
			if ($request->input('set03') !== null){
				$komen	= $request->input('set03');
			} else {
				$komen 	= '';
			}
			$getdata 	= Banksoal::where('id', $idne)->first();
			$inputor 	= 'Rejected by '.Session('nama').' at '.date("Y-m-d H:i:s").', notes: '.$komen;
			$update 	= Banksoal::where('id', $idne)->update([
				'inputor'	=> $inputor,
				'view'		=> 0,
				'updated_at'=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Marking Soal Dengan ID '.$idne.' Sukses, dengan komentar '.$komen;
			} else {
				$keterangan = 'Marking Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'setverifikator'){
			$getnama 	= Simpegpegawai::where('id', $request->input('set03'))->first();
			if (isset($getnama->email)){
				$email 	= $getnama->email;
			} else { $email = $request->input('set03'); }
			$arrid		= $request->input('set02');
			foreach ($arrid as $idne){
				$update 	= Banksoal::where('id', $idne)->update([
					'verified_by'	=> $email,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($update){
					$keterangan = $keterangan.'Verfikator for '.$idne.' Saved; ';
				} else {
					$keterangan = $keterangan.'ID '.$idne.' Failed To Activated; ';
				}
			}
		} else if ($idne == 'new'){
			$opsib		= $request->input('set06');
			$opsic		= $request->input('set07');
			$opsid		= $request->input('set08');
			$opsie		= $request->input('set09');
			if (is_null($opsib) OR $opsib == ''){ $opsib = '-'; }
			if (is_null($opsic) OR $opsic == ''){ $opsic = '-'; }
			if (is_null($opsid) OR $opsid == ''){ $opsid = '-'; }
			if (is_null($opsie) OR $opsie == ''){ $opsie = '-'; }
			$getfakultas = Simpegpegawai::where('email', Session('email'))->first();
			if (isset($getfakultas->id)){
				$fakultas 	= $getfakultas->unit_kerja;
				$fakpanjang	= $getfakultas->prodihomebase;
			} else {
				$fakultas	= Session('fakultas');
				$fakpanjang	= Session('fakpanjang');
			}
			$cekdeskripsi = Banksoal::where('deskripsi', $request->input('set04'))->where('jawaban', $request->input('set11'))->where('kunci', $request->input('set10'))->count();
			if ($cekdeskripsi == 0){
				$input 	= Banksoal::create([
					'kode'					=> $request->input('set02'),
					'ceel'					=> $request->input('set03'),
					'deskripsi'				=> $request->input('set04'),
					'deskripsitambahan'		=> '',
					'lampiran'				=> '',
					'lampiran2' 			=> '',
					'lampiran3' 			=> '',
					'lampiran4' 			=> '',
					'lampiran5' 			=> '',
					'lampiran6' 			=> '',
					'jawaban'				=> $request->input('set11'),
					'opsia' 				=> $request->input('set05'),
					'opsib' 				=> $opsib,
					'opsic' 				=> $opsic,
					'opsid' 				=> $opsid,
					'opsie' 				=> $opsie,
					'kunci' 				=> $request->input('set10'),
					'active'				=> 1,
					'inputor'				=> '',
					'fakultas' 				=> $fakultas,
					'fakpanjang' 			=> $fakpanjang,
					'view'					=> 0,
					'created_by'			=> Session('email')
				]);
				$idsoal 	= $input->id;
				$fullkode 	= date("y").'-'.$request->input('set02').'-'.$request->input('set03').'-'.$idsoal;
				Banksoal::where('id', $idsoal)->update([
					'fullkode'	=> $fullkode
				]);
				$keterangan = 'Tambah Soal Dengan ID '.$fullkode.' Kode '.$request->input('set02').' Sukses';
			} else {
				$keterangan = 'Soal Dengan Deskripsi '.$request->input('set04').' Tedeteksi Double, Mohon Ubah Deskripsi atau pilihan jawaban';
			}
		} else if ($idne == 'upload'){
			$path 			= $_FILES['file']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$xx 			= '-';
			$marking 		= date("y").'-'.Session('nim');
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				if(is_null($val['I']) OR $val['I'] == 'KONTRIBUTOR' OR $val['I'] == ''){
					//
				} else {
					$email 			= $val['I'];
					$getfakultas 	= Simpegpegawai::where('email', $email)->first();
					if (isset($getfakultas->id)){
						$fakultas 	= $getfakultas->unit_kerja;
						$fakpanjang	= $getfakultas->prodihomebase;
						$inputor 	= $getfakultas->nama_lengkap;
					} else {
						$fakultas 	= subdomainapps07;
						$fakpanjang	= subsubdomainapps07;
						$inputor 	= Session('nama');
					}
					$cekdeskripsi = Banksoal::where('deskripsi', $val['B'])->where('jawaban', $val['M'])->where('kunci', $val['H'])->count();
					if ($cekdeskripsi == 0){
						$input 	= Banksoal::create([
							'kode'					=> $val['L'],
							'ceel'					=> $val['J'],
							'deskripsi'				=> $val['B'],
							'deskripsitambahan'		=> '',
							'lampiran'				=> $val['N'],
							'lampiran2' 			=> '',
							'lampiran3' 			=> '',
							'lampiran4' 			=> '',
							'lampiran5' 			=> '',
							'lampiran6' 			=> '',
							'jawaban'				=> $val['M'],
							'opsia' 				=> $val['C'],
							'opsib' 				=> $val['D'],
							'opsic' 				=> $val['E'],
							'opsid' 				=> $val['F'],
							'opsie' 				=> $val['G'],
							'kunci' 				=> $val['H'],
							'fakultas' 				=> $fakultas,
							'fakpanjang' 			=> $fakpanjang,
							'active'				=> 1,
							'inputor'				=> '',
							'view'					=> 1,
							'created_by'			=> $email
						]);
						if ($input){
							$idsoal 	= $input->id;
							$fullkode 	= date("y").'-'.$val['L'].'-'.$val['J'].'-'.$val['K'].'-'.$idsoal;
							Banksoal::where('id', $idsoal)->update([
								'fullkode'	=> $fullkode
							]);
							$sukses++;
						} else {
							$error 		= $error.'; Gagal Input Nomor '.$val['A'];
						}
					} else {
						$error 		= $error.'; Tedeteksi Double Input Nomor '.$val['A'];
					}
				}
			}
			$keterangan = 'Upload Soal Sejumlah '.$sukses.'; Keterangan '.$error;
		} else if ($idne == 'editnilai'){
			$update = Banksoalujian::where('id', $request->input('set02'))->update([
				'skore'			=> $request->input('set03'),
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Skore Set To '.$request->input('set03');
			} else {
				$keterangan = 'Skoring Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'nilaiwawancara'){
			$nama	= $request->input('set02');
			$id		= $request->input('set03');
			$nilai	= $request->input('set04');
			$ceksudah = Pengumuman::where('jenis', 'Interview')->where('siapa', Session('email'))->where('nim', $id)->first();
			if (isset($ceksudah->id)){
				$input 		= Pengumuman::where('id', $ceksudah->id)->update([
					'id_sekolah'=> $nilai,
					'pengumuman'=> 'Nilai Ujian Lisan Tersimpan pada '.date("Y-m-d H:i:s"),
					'tanggal'	=> date('d-m-Y'),
					'kapan'		=> date('Y-m-d H:i:s'),
				]);
			} else {
				Pengumuman::create([
					'jenis'		=> 'Interview',
					'siapa'		=> Session('email'),
					'nim'		=> $id,
					'pengumuman'=> 'Nilai Ujian Lisan Tersimpan pada '.date("Y-m-d H:i:s"),
					'tanggal'	=> date('d-m-Y'),
					'kapan'		=> date('Y-m-d H:i:s'),
					'id_sekolah'=> $nilai
				]);
			}
			if ($input){
				$pembagi 	= 0;
				$nilai 		= 0;
				$keterangan	= '';
				$getallnilai = Pengumuman::where('jenis', 'Interview')->where('nim', $id)->get();
				if (!empty($getallnilai)){
					foreach($getallnilai as $rows){
						if ($rows->id_sekolah == '' OR $rows->id_sekolah == null OR $rows->id_sekolah == '0'){

						} else {
							$pembagi++;
							$nilai 		= $nilai + $rows->id_sekolah;
							$keterangan	= $keterangan.'Nilai Dari '.$rows->siapa.' : '.$rows->id_sekolah.'; ';
						}
					}
				}
				if ($pembagi == 0){
					$rata = 0;
				} else {
					$rata = round(($nilai/$pembagi), 2);
				}
				$keterangan = $keterangan.' Total Nilai => '.$nilai.' / '.$pembagi.' = '.$rata;
				$input 	= Simpegpegawai::where('id', $id)->update([
					'usia'			=> $rata,
					'keterangan'	=> $keterangan
				]);
				$keterangan = 'Nilai Ujian Lisan Tersimpan pada '.date("Y-m-d H:i:s");
			} else {
				$keterangan = 'Input Nilai Ujian Lisan Gagal, silahkan ulangi beberapa saat lagi';
			}
		} else {
			$opsib		= $request->input('set06');
			$opsic		= $request->input('set07');
			$opsid		= $request->input('set08');
			$opsie		= $request->input('set09');
			$cekfile01	= $request->input('set19');
			$cekfile02	= $request->input('set20');
			$cekfile03	= $request->input('set21');
			$cekfile04	= $request->input('set22');
			$cekfile05	= $request->input('set23');
			$cekfile06	= $request->input('set24');
			if (is_null($cekfile01)){ $cekfile01 = ''; }
			if (is_null($cekfile02)){ $cekfile02 = ''; }
			if (is_null($cekfile03)){ $cekfile03 = ''; }
			if (is_null($cekfile04)){ $cekfile04 = ''; }
			if (is_null($cekfile05)){ $cekfile05 = ''; }
			if (is_null($cekfile06)){ $cekfile06 = ''; }
			if (is_null($opsib) OR $opsib == ''){ $opsib = '-'; }
			if (is_null($opsic) OR $opsic == ''){ $opsic = '-'; }
			if (is_null($opsid) OR $opsid == ''){ $opsid = '-'; }
			if (is_null($opsie) OR $opsie == ''){ $opsie = '-'; }
			$getdata 	= Banksoal::where('id', $idne)->first();
			if (isset($getdata->id)){
				$ceksudahvalid 	= $getdata->view;
				if ($cekfile01 == '' AND $getdata->lampiran != ''){
					if (File::exists(public_path()."/".$getdata->lampiran)) {
						File::delete(public_path()."/".$getdata->lampiran);
					}
				}
				if ($cekfile02 == '' AND $getdata->lampiran2 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran2)) {
						File::delete(public_path()."/".$getdata->lampiran2);
					}
				}
				if ($cekfile03 == '' AND $getdata->lampiran3 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran3)) {
						File::delete(public_path()."/".$getdata->lampiran3);
					}
				}
				if ($cekfile04 == '' AND $getdata->lampiran4 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran4)) {
						File::delete(public_path()."/".$getdata->lampiran4);
					}
				}
				if ($cekfile05 == '' AND $getdata->lampiran5 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran5)) {
						File::delete(public_path()."/".$getdata->lampiran5);
					}
				}
				if ($cekfile06 == '' AND $getdata->lampiran6 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran6)) {
						File::delete(public_path()."/".$getdata->lampiran6);
					}
				}
				if ($cekfile01 == 'ada'){ $cekfile01 = $getdata->lampiran; }
				if ($cekfile02 == 'ada'){ $cekfile02 = $getdata->lampiran2; }
				if ($cekfile03 == 'ada'){ $cekfile03 = $getdata->lampiran3; }
				if ($cekfile04 == 'ada'){ $cekfile04 = $getdata->lampiran4; }
				if ($cekfile05 == 'ada'){ $cekfile05 = $getdata->lampiran5; }
				if ($cekfile06 == 'ada'){ $cekfile06 = $getdata->lampiran6; }
				$cekdeskripsi 	= Banksoal::where('id', '!=', $idne)->where('deskripsi', $request->input('set04'))->where('jawaban', $request->input('set11'))->where('kunci', $request->input('set10'))->count();
				if ($cekdeskripsi == 0){
					if ($ceksudahvalid == 1){
						$input 	= Banksoal::where('id', $idne)->update([
							'kode'					=> $request->input('set02'),
							'ceel'					=> $request->input('set03'),
							'deskripsi'				=> $request->input('set04'),
							'opsia' 				=> $request->input('set05'),
							'opsib' 				=> $opsib,
							'opsic' 				=> $opsic,
							'opsid' 				=> $opsid,
							'opsie' 				=> $opsie,
							'kunci' 				=> $request->input('set10'),
							'jawaban'				=> $request->input('set11'),
							'view'					=> 0,
							'active'				=> 1,
							'lampiran'				=> $cekfile01,
							'lampiran2' 			=> $cekfile02,
							'lampiran3' 			=> $cekfile03,
							'lampiran4' 			=> $cekfile04,
							'lampiran5' 			=> $cekfile05,
							'lampiran6' 			=> $cekfile06,
							'updated_at'			=> date("Y-m-d H:i:s")
						]);
						$idsoal = $idne;
						$keterangan = 'Update Soal Dengan ID '.$idsoal.' Kode '.$request->input('set01').' Sukses Namun harus di Validasi Ulang, karena telah di validasi sebelumnya';
					} else {
						$input 	= Banksoal::where('id', $idne)->update([
							'kode'					=> $request->input('set02'),
							'ceel'					=> $request->input('set03'),
							'deskripsi'				=> $request->input('set04'),
							'opsia' 				=> $request->input('set05'),
							'opsib' 				=> $opsib,
							'opsic' 				=> $opsic,
							'opsid' 				=> $opsid,
							'opsie' 				=> $opsie,
							'lampiran'				=> $cekfile01,
							'lampiran2' 			=> $cekfile02,
							'lampiran3' 			=> $cekfile03,
							'lampiran4' 			=> $cekfile04,
							'lampiran5' 			=> $cekfile05,
							'lampiran6' 			=> $cekfile06,
							'kunci' 				=> $request->input('set10'),
							'jawaban'				=> $request->input('set11'),
							'active'				=> 1,
							'updated_at'			=> date("Y-m-d H:i:s")
						]);
						$idsoal = $idne;
						$keterangan = 'Update Soal Dengan ID '.$idsoal.' Kode '.$request->input('set01').' Sukses';
					}
				} else {
					$keterangan = 'Soal Dengan Deskripsi '.$request->input('set04').' Tedeteksi Double, Mohon Ubah Deskripsi atau pilihan jawaban';
				}
			} else {
				$keterangan = 'Soal Dengan ID '.$idne.' Tidak di Temukan';
			}
		}
		if ($idsoal != 0){
			if ($request->hasFile('file')) {
				$nmfile1 = 'Pic01-'.$idsoal.'.'.$request->file('file')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile1)) {
					File::delete(public_path()."/".$nmfile1);
				}
				$request->file->move(public_path('images/soal/'), $nmfile1);
				Banksoal::where('id', $idsoal)->update([
					'lampiran'	=> 'images/soal/'.$nmfile1,
				]);
			}
			if ($request->hasFile('file2')) {
				$nmfile2 = 'Pic02-'.$idsoal.'.'.$request->file('file2')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile2)) {
					File::delete(public_path()."/".$nmfile2);
				}
				$request->file('file2')->move(public_path('images/soal/'), $nmfile2);
				Banksoal::where('id', $idsoal)->update([
					'lampiran2'	=> 'images/soal/'.$nmfile2,
				]);
			}
			if ($request->hasFile('file3')) {
				$nmfile3 = 'Pic03-'.$idsoal.'.'.$request->file('file3')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile3)) {
					File::delete(public_path()."/".$nmfile3);
				}
				$request->file('file3')->move(public_path('images/soal/'), $nmfile3);
				Banksoal::where('id', $idsoal)->update([
					'lampiran3'	=> 'images/soal/'.$nmfile3,
				]);
			}
			if ($request->hasFile('file4')) {
				$nmfile4 = 'Pic04-'.$idsoal.'.'.$request->file('file4')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile4)) {
					File::delete(public_path()."/".$nmfile4);
				}
				$request->file('file4')->move(public_path('images/soal/'), $nmfile4);
				Banksoal::where('id', $idsoal)->update([
					'lampiran4'	=> 'images/soal/'.$nmfile4,
				]);
			}
			if ($request->hasFile('file5')) {
				$nmfile5 = 'Pic05-'.$idsoal.'.'.$request->file('file5')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile5)) {
					File::delete(public_path()."/".$nmfile5);
				}
				$request->file('file5')->move(public_path('images/soal/'), $nmfile5);
				Banksoal::where('id', $idsoal)->update([
					'lampiran5'	=> 'images/soal/'.$nmfile5,
				]);
			}
			if ($request->hasFile('file6')) {
				$nmfile6 = 'Pic06-'.$idsoal.'.'.$request->file('file6')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile6)) {
					File::delete(public_path()."/".$nmfile6);
				}
				$request->file('file6')->move(public_path('images/soal/'), $nmfile6);
				Banksoal::where('id', $idsoal)->update([
					'lampiran6'	=> 'images/soal/'.$nmfile6,
				]);
			}
		}
		echo $keterangan;
	}
	public function getBankSoal(Request $request) {
		$arraysurat 	= [];
		$previlage		= Session('previlage');
		$jenis   		= $request->input('jenis');
        $valcari   		= $request->input('valcari');
        $view   		= $request->input('view');
        $homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		$totaldata  	= 0;
        $limit         	= 10;
        $limit      	= ($request->input('limit') == null ? $limit : $request->input('limit'));
		$order      	= ($request->input('order') == null ? 'id desc' : $request->input('order'));
        $ceksek 		= explode(" ", $order);
		if (Session('previlage') == 'administarator'){
			if ($jenis == '1' OR $jenis == '0'){
				$data 	    = Banksoal::where('active', $jenis)->where('view', $view)->select('bs_banksoal.*');
			} else if ($jenis == '2'){
				$data 	    = Banksoal::where('active', '1')->where('view', '0')->select('bs_banksoal.*');
			} else {
				$data 	    = Banksoal::where('kode', $jenis)->where('view', $view)->select('bs_banksoal.*');
			}
		} else {
			if (Session('fakultas') == 'DPM' AND Session('previlage') == 'Admin SDM'){
				if ($jenis == '1' OR $jenis == '0'){
					$data 	    = Banksoal::where('active', $jenis)->where('view', $view)->select('bs_banksoal.*');
				} else if ($jenis == '2'){
					$data 	    = Banksoal::where('active', '1')->where('view', '0')->select('bs_banksoal.*');
				} else {
					$data 	    = Banksoal::where('kode', $jenis)->where('view', $view)->select('bs_banksoal.*');
				}
			} else {
				if ($jenis == '1' OR $jenis == '0'){
					$data 	    = Banksoal::where('created_by', Session('email'))->where('active', $jenis)->where('view', $view)->select('bs_banksoal.*');
				} else if ($jenis == '2'){
					$data 	    = Banksoal::where('created_by', Session('email'))->where('active', '1')->where('view', '0')->select('bs_banksoal.*');
				} else {
					$data 	    = Banksoal::where('created_by', Session('email'))->where('kode', $jenis)->where('view', $view)->select('bs_banksoal.*');
				}	
			}
		}
		if (isset($ceksek[1])){
			$variabel 	= $ceksek[0];
			$urutan		= $ceksek[1];
			if ($variabel == 'undefined'){
				$variabel = 'id';
			}
			$order 		= $variabel.' '.$urutan;
		}
		if ($valcari != null AND $valcari != '') $data = $data->where('deskripsi', 'LIKE', '%'.$valcari.'%')->orWhere('kode', 'LIKE', '%'.$valcari.'%');
        $data       	= $data->orderByRaw($order)->paginate($limit);
		$totaldata		= $data->total();
		if (!empty($data)){
			foreach ($data as $hasil){
				$idsoal 	= $hasil->id;
				$tlssoale	= $hasil->deskripsi;
				$alasan		= $hasil->deskripsitambahan;
				$kode		= $hasil->kode;
				$ceel		= $hasil->ceel;
				$aktif		= $hasil->active;
				$tipesoal	= $hasil->jawaban;
				$view		= $hasil->view;
				$tahun		= $hasil->created_at->year;
				$lampiran	= $hasil->lampiran;
				$fullkode	= $hasil->fullkode;
				$nilai01	= $hasil->nilai01;
				if (is_null($fullkode) OR $fullkode == ''){
					$fullkode = $tahun.'-'.$kode.'-'.$ceel.$idsoal;
					Banksoal::where('id', $idsoal)->update([
						'fullkode'	=> $fullkode
					]);
				}
				if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
				$showjawab	= '';	
				$deskripsi 	= str_replace("</p><p>", "<br />", $hasil->deskripsi);
				$opsia 		= str_replace("</p><p>", "<br />", $hasil->opsia);
				$opsib 		= str_replace("</p><p>", "<br />", $hasil->opsib);
				$opsic 		= str_replace("</p><p>", "<br />", $hasil->opsic);
				$opsid 		= str_replace("</p><p>", "<br />", $hasil->opsid);
				$opsie 		= str_replace("</p><p>", "<br />", $hasil->opsie);
				$kunci 		= str_replace("</p><p>", "<br />", $hasil->kunci);
				$deskripsi 	= str_replace($vowels, "", $deskripsi);
				$opsia 		= str_replace($vowels, "", $opsia);
				$opsib 		= str_replace($vowels, "", $opsib);
				$opsic 		= str_replace($vowels, "", $opsic);
				$opsid 		= str_replace($vowels, "", $opsid);
				$opsie 		= str_replace($vowels, "", $opsie);
				$kunci 		= str_replace($vowels, "", $kunci);
				$kunci 		= preg_replace('/\s+/', '', $kunci);
				$kunci 		= strtoupper($kunci);
				Banksoal::where('id', $idsoal)->update([
					'opsia'		=> $opsia,
					'opsib'		=> $opsib,
					'opsic'		=> $opsic,
					'opsid'		=> $opsid,
					'opsie'		=> $opsie,
					'kunci'		=> $kunci,
					'deskripsi'	=> $deskripsi,
				]);
				if ($tipesoal == 'Labelled Case'){
					$showjawab	= '<table border="0" width="100%"><tr><td width="5%"><strong>Point A</strong></td><td>'.$opsia.'</td><td width="5%"><strong>Point B</strong></td><td>'.$opsib.'</td></tr><tr><td><strong>Point C</strong></td><td>'.$opsic.'</td><td><strong>Point D</strong></td><td>'.$opsid.'</td></tr><tr><td><strong>Point E</strong></td><td>'.$opsie.'</td><td colspan="2"><i><u>Soal Label Dengan Masing-Masing Jawaban di atas</u></i></td></tr></table>';
				} else if ($tipesoal == 'esay'){
					$showjawab	= '<table border="0" width="100%"><tr><td><strong>Esay Case With Answer Deskription Like :</strong><br />'.$opsia.'</td></tr></table>';
				} else {
					$showjawab	= '<table border="0" width="100%"><tr><td width="5%"><strong>A</strong></td><td>'.$opsia.'</td><td width="5%"><strong>B</strong></td><td>'.$opsib.'</td></tr><tr><td><strong>C</strong></td><td>'.$opsic.'</td><td><strong>D</strong></td><td>'.$opsid.'</td></tr><tr><td><strong>E</strong></td><td>'.$opsie.'</td><td colspan="2"><strong><font color=blue>Keys : </font></strong><span class="badge badge-primary"> '.$kunci.'</span></td></tr></table>';
				}
				$keterangan	= '<strong>Inputor : </strong>'.$hasil->inputor.'<br /><strong>Used On :</strong>'.$hasil->deskripsitambahan.'<br />Facility : '.$hasil->nilai01.' ( '.$hasil->keterangan01.' )<br />Discrimination : '.$hasil->nilai02.' ( '.$hasil->keterangan02.' )<br />so the question is : '.$hasil->kesimpulan.'<p></p>';
				$arraysurat[] = array(
					'idsoal' 			=> $idsoal,
					'tipesoal' 			=> $tipesoal,	
					'jawaban' 			=> $hasil->jawaban,
					'showjawab' 		=> $showjawab,
					'keterangan' 		=> $keterangan,
					'kode' 				=> $kode,
					'fullkode' 			=> $hasil->fullkode,
					'ceel' 				=> $ceel,	
					'inputor' 			=> $hasil->inputor,
					'aktif' 			=> $hasil->active,
					'aktifview' 		=> $view,
					'lampiran' 			=> $hasil->lampiran,
					'alasan' 			=> $alasan,
					'deskripsi' 		=> $deskripsi,
					'jawaba' 			=> $opsia,
					'jawabb' 			=> $opsib,
					'jawabc' 			=> $opsic,
					'jawabd' 			=> $opsid,
					'jawabe' 			=> $opsie,
					'kuncie' 			=> $kunci,
					'tahun' 			=> $hasil->created_at->year,
					'deskripsitambahan' => $hasil->deskripsitambahan,
					'created_by' 		=> $hasil->created_by,
					'fakultas' 			=> $hasil->fakultas,
					'fakpanjang' 		=> $hasil->fakpanjang,
				);
			}
		}
        $response = [
            'message'   => 'List Laporan',
            'previlage'	=> $previlage,
            'data'      => $arraysurat,
            'total'     => $totaldata
        ];
        return response()->json($response, 200);
	}
	public function jsonGetSoalAktif() {
		$arraysurat 	= [];
		$homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		if (Session('previlage') == 'administarator'){
			$data 	    = Banksoal::where('view', 1)->get();
		} else {
			$data 	    = Banksoal::where('created_by', 'LIKE', Session('email'))->where('view', 1)->get();
		}
		if (!empty($data)){
			foreach ($data as $hasil){
				$idsoal 	= $hasil->id;
				$tlssoale	= $hasil->deskripsi;
				$alasan		= $hasil->deskripsitambahan;
				$kode		= $hasil->kode;
				$ceel		= $hasil->ceel;
				$aktif		= $hasil->active;
				$tipesoal	= $hasil->jawaban;
				$view		= $hasil->view;
				$tahun		= $hasil->created_at->year;
				$lampiran	= $hasil->lampiran;
				$fullkode	= $hasil->fullkode;
				$nilai01	= $hasil->nilai01;
				if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
				$showjawab	= '';	
				$deskripsi 	= str_replace("</p><p>", "<br />", $hasil->deskripsi);
				$opsia 		= str_replace("</p><p>", "<br />", $hasil->opsia);
				$opsib 		= str_replace("</p><p>", "<br />", $hasil->opsib);
				$opsic 		= str_replace("</p><p>", "<br />", $hasil->opsic);
				$opsid 		= str_replace("</p><p>", "<br />", $hasil->opsid);
				$opsie 		= str_replace("</p><p>", "<br />", $hasil->opsie);
				$kunci 		= str_replace("</p><p>", "<br />", $hasil->kunci);
				$deskripsi 	= str_replace($vowels, "", $deskripsi);
				$opsia 		= str_replace($vowels, "", $opsia);
				$opsib 		= str_replace($vowels, "", $opsib);
				$opsic 		= str_replace($vowels, "", $opsic);
				$opsid 		= str_replace($vowels, "", $opsid);
				$opsie 		= str_replace($vowels, "", $opsie);
				$kunci 		= str_replace($vowels, "", $kunci);
				$kunci 		= preg_replace('/\s+/', '', $kunci);
				$kunci 		= strtoupper($kunci);
				$arraysurat[] = array(
					'idsoal' 			=> $idsoal,
					'tipesoal' 			=> $tipesoal,	
					'kode' 				=> $kode,
					'ceel' 				=> $ceel,	
					'inputor' 			=> $hasil->inputor,
					'aktif' 			=> $hasil->active,
					'aktifview' 		=> $view,
					'lampiran' 			=> $hasil->lampiran,
					'deskripsi' 		=> $deskripsi,
					'jawaba' 			=> $opsia,
					'jawabb' 			=> $opsib,
					'jawabc' 			=> $opsic,
					'jawabd' 			=> $opsid,
					'jawabe' 			=> $opsie,
					'kuncie' 			=> $kunci,
					'tahun' 			=> $hasil->created_at->year,
					'deskripsitambahan' => $hasil->deskripsitambahan,
				);
			}
		}
		echo json_encode($arraysurat);
    }
	public function dataJsonaktiftest(Request $request) {
		$arraysurat = [];
		$nomor		= 1;
		$masterno  	= $request->input('set01');
        $valcari   	= $request->input('set02');
		$getid 		= Simpegpegawai::where('idpeg', $request->input('set01'))->first();
		if (isset($getid->id)){
			$masterno = $getid->id;
		}
		if ($valcari == 'cariujian'){
			$sql 	= Banksoalujian::where('idmahasiswa', $masterno)->where('status', 1)->groupBy('marking')->get();
			if (!empty($sql)){
				foreach ($sql as $hasil){
					$mulai 			= $hasil->created_at;
					$akhir 			= $hasil->updated_at;
					$jumlah 		= Banksoalujian::where('marking', $hasil->marking)->where('idmahasiswa', $masterno)->where('status', 1)->count();
					$timer 			= 0;
					if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator' OR Session('previlage') == 'inputor'){
						$kunci 		= $hasil->kunci;
						$skore 		= $hasil->skore;
					} else {
						$kunci		= 'hidden';
						$skore		= 'hidden';
					}
					$getdata 		= Banksoaltest::where('id', $hasil->idtest)->first();
					if (isset($getdata->id)){
						$mulai		= date('m/d/Y H:i:s', strtotime($getdata->mulai));
						$akhir		= date('m/d/Y H:i:s', strtotime($getdata->selesai));
						$timer		= $getdata->timer;
					}
					
					$arraysurat[] = array(
						'id' 			=> $hasil->id,
						'ceel' 			=> $hasil->ceel,
						'kode' 			=> $hasil->kode,
						'tanggal' 		=> $hasil->tanggal,
						'namaujian' 	=> $hasil->namaujian,
						'supervisor' 	=> $hasil->supervisor,
						'namapeserta' 	=> $hasil->namapeserta,
						'asalpeserta' 	=> $hasil->asalpeserta,
						'nomorpeserta' 	=> $hasil->nomorpeserta,
						'idmahasiswa' 	=> $hasil->idmahasiswa,
						'idtest' 		=> $hasil->idtest,
						'idsoal' 		=> $hasil->idsoal,
						'urutan' 		=> $hasil->urutan,
						'jawaban' 		=> $hasil->jawaban,
						'kunci' 		=> $kunci,
						'skore' 		=> $skore,
						'marking' 		=> $hasil->marking,
						'pengumuman' 	=> $hasil->pengumuman,
						'status' 		=> $hasil->status,
						'created_at' 	=> $mulai,
						'updated_at' 	=> $akhir,
						'mulai' 		=> $mulai,
						'selesai' 		=> $akhir,
						'timer' 		=> $timer,
						'jumlah' 		=> $jumlah,
					);
				}
			}
		} else if ($valcari == 'Pengumuman'){
			$arraysurat = Banksoalujian::where('idmahasiswa', $masterno)->where('pengumuman', 1)->groupBy('marking')->get();
		} else {
			if (Session('email') == 'admin@inabr.or.id' OR Session('email') == 'admin@banksoal.duidev.com'){
				if ($valcari == 'Arsip'){
					$sql 	= Banksoaltest::where('status', '0')->groupBy('marking')->orderBy('id', 'DESC')->get();
				} else {
					$sql 	= Banksoaltest::where('status', '1')->groupBy('marking')->orderBy('id', 'DESC')->get();
				}
			} else {
				if ($valcari == 'Arsip'){
					$sql 	= Banksoaltest::where('created_by', Session('username'))->where('status', '0')->groupBy('marking')->orderBy('id', 'DESC')->get();
				} else {
					$sql 	= Banksoaltest::where('created_by', Session('username'))->where('status', '1')->groupBy('marking')->orderBy('id', 'DESC')->get();
				}
			}
			if (!empty($sql)){
				foreach ($sql as $hasil){
					$jumlah 		= Banksoaltest::where('marking', $hasil->marking)->count();
					$idtes 			= $hasil->id;
					$kode			= $hasil->kode;
					$ceel			= $hasil->ceel;
					$tanggal		= $hasil->tanggal;
					$namaujian		= $hasil->namaujian;
					$supervisor		= $hasil->supervisor;
					$tipe			= $hasil->tipe;
					$status			= $hasil->status;
					$mulai			= $hasil->mulai;
					$selesai		= $hasil->selesai;
					$marking		= $hasil->marking;
					$timer			= $hasil->timer;
					$pengumuman		= $hasil->pengumuman;
					$tlssupervisor 	= $hasil->created_by;
					$arrmulai 		= explode(" ",$mulai);
					$tglmulai		= $arrmulai[0];
					$jammulai		= $arrmulai[1];
					$arrakhir 		= explode(" ",$selesai);
					$tglselesai		= $arrakhir[0];
					$jamselesai		= $arrakhir[1];
					$peserta 		= Banksoalujian::where('marking', $marking)->where('status', '!=', '3')->groupBy('idmahasiswa')->count();
			
					if ($pengumuman == '1'){ 
						$pengumuman = '&#10004;';
					} else {$pengumuman = '';}
					$arraysurat[] = array(
						'id' 			=> $idtes,
						'peserta' 		=> $peserta,
						'tglmulai' 		=> $tglmulai,
						'jammulai' 		=> $jammulai,
						'tglselesai' 	=> $tglselesai,
						'jamselesai' 	=> $jamselesai,
						'jumlah' 		=> $jumlah,	
						'nomor' 		=> $nomor,
						'kode' 			=> $kode,
						'ceel' 			=> $ceel,
						'tanggal' 		=> $tanggal,
						'mulai' 		=> $mulai,
						'selesai' 		=> $selesai,
						'namaujian' 	=> $namaujian,	
						'supervisor' 	=> $supervisor,
						'tlssupervisor' => $tlssupervisor,
						'tipe' 			=> $tipe,
						'status' 		=> $hasil->status,
						'timer' 		=> $timer,
						'marking' 		=> $marking,
						'pengumuman' 	=> $pengumuman,
						'tahun' 		=> $hasil->created_at->year,
					);
					$nomor++;
				}
			}
		}
    	echo json_encode($arraysurat);	
	}
	public function getDetailSoal(Request $request) {
		$arraysurat 	= [];
		$homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		$idprodi   		= $request->input('val01');
        $valjenis   	= $request->input('val02');
        $sql			= Banksoaltest::where('namaujian', $idprodi)->where('kode', $valjenis)->get();
		if (!empty($sql)){
			foreach ($sql as $rows){
				$idsoal = $rows->idsoal;
				$hasil 	= Banksoal::where('id', $idsoal)->first();
				if (isset($hasil->id)){
					$idsoal 	= $hasil->id;
					$tlssoale	= $hasil->deskripsi;
					$alasan		= $hasil->deskripsitambahan;
					$kode		= $hasil->kode;
					$ceel		= $hasil->ceel;
					$aktif		= $hasil->active;
					$tipesoal	= $hasil->jawaban;
					$view		= $hasil->view;
					$tahun		= $hasil->created_at->year;
					$lampiran	= $hasil->lampiran;
					$fullkode	= $hasil->fullkode;
					$nilai01	= $hasil->nilai01;
					if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
					$showjawab	= '';	
					$deskripsi 	= str_replace("</p><p>", "<br />", $hasil->deskripsi);
					$opsia 		= str_replace("</p><p>", "<br />", $hasil->opsia);
					$opsib 		= str_replace("</p><p>", "<br />", $hasil->opsib);
					$opsic 		= str_replace("</p><p>", "<br />", $hasil->opsic);
					$opsid 		= str_replace("</p><p>", "<br />", $hasil->opsid);
					$opsie 		= str_replace("</p><p>", "<br />", $hasil->opsie);
					$kunci 		= str_replace("</p><p>", "<br />", $hasil->kunci);
					$deskripsi 	= str_replace($vowels, "", $deskripsi);
					$opsia 		= str_replace($vowels, "", $opsia);
					$opsib 		= str_replace($vowels, "", $opsib);
					$opsic 		= str_replace($vowels, "", $opsic);
					$opsid 		= str_replace($vowels, "", $opsid);
					$opsie 		= str_replace($vowels, "", $opsie);
					$kunci 		= str_replace($vowels, "", $kunci);
					$kunci 		= preg_replace('/\s+/', '', $kunci);
					$kunci 		= strtoupper($kunci);
					$arraysurat[] = array(
						'id' 				=> $rows->id,
						'idsoal' 			=> $idsoal,
						'tipesoal' 			=> $tipesoal,	
						'kode' 				=> $kode,
						'ceel' 				=> $ceel,	
						'inputor' 			=> $hasil->inputor,
						'aktif' 			=> $hasil->active,
						'aktifview' 		=> $view,
						'lampiran' 			=> $hasil->lampiran,
						'deskripsi' 		=> $deskripsi,
						'jawaba' 			=> $opsia,
						'jawabb' 			=> $opsib,
						'jawabc' 			=> $opsic,
						'jawabd' 			=> $opsid,
						'jawabe' 			=> $opsie,
						'kuncie' 			=> $kunci,
						'tahun' 			=> $hasil->created_at->year,
						'deskripsitambahan' => $hasil->deskripsitambahan,
					);
				}
			}
		}
		echo json_encode($arraysurat);
    }
	public function jsonRekapSoal(Request $request) {
		$alldata 		= [];
		$previlage		= Session('previlage');
		$idprodi   		= $request->input('val01');
        $valjenis   	= $request->input('val02');
        $homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		if ($valjenis == 'rekap'){
			$countkb		= Banksoaltest::where('namaujian', $idprodi)->where('kode', 'KB')->count();
			$countkd		= Banksoaltest::where('namaujian', $idprodi)->where('kode', 'KD')->count();
			$alldata[] = array(
				'jumlah'		=> $countkd,
				'idprodi'		=> $idprodi,
				'kodesoal'		=> 'KD',
				'tuliskode'		=> 'Soal Kompetensi Dasar',
			);
			$alldata[] = array(
				'jumlah'		=> $countkb,
				'idprodi'		=> $idprodi,
				'kodesoal'		=> 'KB',
				'tuliskode'		=> 'Soal Kompetensi Bidang',
			);
		}
		echo json_encode($alldata);
	}
	public function getFirstSoal(Request $request) {
		$idne		= $request->input('val01');
        $homebase	= url("/");
		$hasil		= Banksoal::where('id', $idne)->first();
		if (isset($hasil->id)){
			return response()->json([
				'idsoal' 	=> $hasil->id,
				'deskripsi'	=> $hasil->deskripsi,
				'alasan'	=> $hasil->deskripsitambahan,
				'kode'		=> $hasil->kode,
				'ceel'		=> $hasil->ceel,
				'aktif'		=> $hasil->active,
				'dosen'		=> $hasil->inputor,
				'tipesoal'	=> $hasil->jawaban,
				'view'		=> $hasil->view,
				'tahun'		=> $hasil->created_at->year,
				'lampiran'	=> $hasil->lampiran,
				'lampiran2'	=> $hasil->lampiran2,
				'lampiran3'	=> $hasil->lampiran3,
				'lampiran4'	=> $hasil->lampiran4,
				'lampiran5'	=> $hasil->lampiran5,
				'lampiran6'	=> $hasil->lampiran6,
				'fullkode'	=> $hasil->fullkode,
				'nilai01'	=> $hasil->nilai01,
				'opsia'		=> $hasil->opsia,
				'opsib'		=> $hasil->opsib,
				'opsic'		=> $hasil->opsic,
				'opsid'		=> $hasil->opsid,
				'opsie'		=> $hasil->opsie,
				'kunci'		=> $hasil->kunci,
			]);
		} else {
			$nama 		= $idne;
			$getnama 	= Simpegpegawai::where('email', $idne)->first();
			if (isset($getnama->nama)){
				$nama 	= $getnama->nama;
			}
			$counta1= Banksoal::where('ceel', 'Neuroradiologi dan Head &amp; Neck')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$counta2= Banksoal::where('ceel', 'Neuroradiologi dan Head &amp; Neck')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$counta3= Banksoal::where('ceel', 'Neuroradiologi dan Head &amp; Neck')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$counta4= Banksoal::where('ceel', 'Neuroradiologi dan Head &amp; Neck')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$countb1= Banksoal::where('ceel', 'Toraks')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countb2= Banksoal::where('ceel', 'Toraks')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$countb3= Banksoal::where('ceel', 'Toraks')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countb4= Banksoal::where('ceel', 'Toraks')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$countc1= Banksoal::where('ceel', 'Abdomen (Gastro dan Urogenital)')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countc2= Banksoal::where('ceel', 'Abdomen (Gastro dan Urogenital)')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$countc3= Banksoal::where('ceel', 'Abdomen (Gastro dan Urogenital)')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countc4= Banksoal::where('ceel', 'Abdomen (Gastro dan Urogenital)')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$countd1= Banksoal::where('ceel', 'Pediatrik')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countd2= Banksoal::where('ceel', 'Pediatrik')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$countd3= Banksoal::where('ceel', 'Pediatrik')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countd4= Banksoal::where('ceel', 'Pediatrik')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$counte1= Banksoal::where('ceel', 'Muskuloskeletal')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$counte2= Banksoal::where('ceel', 'Muskuloskeletal')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$counte3= Banksoal::where('ceel', 'Muskuloskeletal')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$counte4= Banksoal::where('ceel', 'Muskuloskeletal')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$countf1= Banksoal::where('ceel', 'Payudara dan Reproduksi Perempuan')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countf2= Banksoal::where('ceel', 'Payudara dan Reproduksi Perempuan')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$countf3= Banksoal::where('ceel', 'Payudara dan Reproduksi Perempuan')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countf4= Banksoal::where('ceel', 'Payudara dan Reproduksi Perempuan')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$countg1= Banksoal::where('ceel', 'Radiologi Intervensi')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countg2= Banksoal::where('ceel', 'Radiologi Intervensi')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$countg3= Banksoal::where('ceel', 'Radiologi Intervensi')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$countg4= Banksoal::where('ceel', 'Radiologi Intervensi')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			
			$counth1= Banksoal::where('ceel', 'Kedokteran Nuklir')->where('jawaban','choice')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$counth2= Banksoal::where('ceel', 'Kedokteran Nuklir')->where('jawaban','choice')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$counth3= Banksoal::where('ceel', 'Kedokteran Nuklir')->where('jawaban','esay')->where('kode', 'LIKE', '%Canggih')->where('active', '1')->where('created_by', $idne)->count();
			$counth4= Banksoal::where('ceel', 'Kedokteran Nuklir')->where('jawaban','esay')->where('kode', 'LIKE', '%Konvensional')->where('active', '1')->where('created_by', $idne)->count();
			$total1	= $counta1 + $countb1 + $countc1 + $countd1 + $counte1 + $countf1 + $countg1 + $counth1;
			$total2	= $counta2 + $countb2 + $countc2 + $countd2 + $counte2 + $countf2 + $countg2 + $counth2;
			$total3	= $counta3 + $countb3 + $countc3 + $countd3 + $counte3 + $countf3 + $countg3 + $counth3;
			$total4	= $counta4 + $countb4 + $countc4 + $countd4 + $counte4 + $countf4 + $countg4 + $counth4;
			$total12= $total1 + $total2;
			$total34= $total3 + $total4;
			
			return response()->json([
				'nama' 		=> $nama,
				'total1' 	=> $total1,
				'total2' 	=> $total2,
				'total3' 	=> $total3,
				'total4' 	=> $total4,
				'total12' 	=> $total12,
				'total34' 	=> $total34,
				'counta1' 	=> $counta1,
				'counta2' 	=> $counta2,
				'counta3' 	=> $counta3,
				'counta4' 	=> $counta4,
				'countb1' 	=> $countb1,
				'countb2' 	=> $countb2,
				'countb3' 	=> $countb3,
				'countb4' 	=> $countb4,
				'countc1' 	=> $countc1,
				'countc2' 	=> $countc2,
				'countc3' 	=> $countc3,
				'countc4' 	=> $countc4,
				'countd1' 	=> $countd1,
				'countd2' 	=> $countd2,
				'countd3' 	=> $countd3,
				'countd4' 	=> $countd4,
				'counte1' 	=> $counte1,
				'counte2' 	=> $counte2,
				'counte3' 	=> $counte3,
				'counte4' 	=> $counte4,
				'countf1' 	=> $countf1,
				'countf2' 	=> $countf2,
				'countf3' 	=> $countf3,
				'countf4' 	=> $countf4,
				'countg1' 	=> $countg1,
				'countg2' 	=> $countg2,
				'countg3' 	=> $countg3,
				'countg4' 	=> $countg4,
				'counth1' 	=> $counth1,
				'counth2' 	=> $counth2,
				'counth3' 	=> $counth3,
				'counth4' 	=> $counth4,
			]);
		}
		return back();
	}
	public function getFirstDataUjian(Request $request) {
		$idne		= $request->input('val01');
        $homebase	= url("/");
		$getid		= Banksoalujian::where('id', $idne)->first();
		if (isset($getid->id)){
			$idne 		= $getid->idsoal;
			$jawaban 	= $getid->jawaban;
			$hasil		= Banksoal::where('id', $idne)->first();
			if (isset($hasil->id)){
				$opsia 		= $hasil->opsia;
				$opsib 		= $hasil->opsib;
				$opsic 		= $hasil->opsic;
				$opsid 		= $hasil->opsid;
				$opsie 		= $hasil->opsie;
				if ($hasil->jawaban == 'esay'){
					$opsia	= $jawaban;
					$opsib	= '';
					$opsic 	= '';
					$opsid 	= '';
					$opsie	= '';
				} else {
					if ($jawaban == 'A'){ $opsia = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsia.'</div></div>'; }
					if ($jawaban == 'B'){ $opsib = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsib.'</div></div>'; }
					if ($jawaban == 'C'){ $opsic = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsic.'</div></div>'; }
					if ($jawaban == 'D'){ $opsid = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsid.'</div></div>'; }
					if ($jawaban == 'E'){ $opsie = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsie.'</div></div>'; }
				}
				return response()->json([
					'deskripsi'	=> $hasil->deskripsi,
					'lampiran'	=> $hasil->lampiran,
					'lampiran2'	=> $hasil->lampiran2,
					'lampiran3'	=> $hasil->lampiran3,
					'lampiran4'	=> $hasil->lampiran4,
					'lampiran5'	=> $hasil->lampiran5,
					'lampiran6'	=> $hasil->lampiran6,
					'jenissoal'	=> $hasil->jawaban,
					'opsia'		=> $opsia,
					'opsib'		=> $opsib,
					'opsic'		=> $opsic,
					'opsid'		=> $opsid,
					'opsie'		=> $opsie,
				]);
			} else {
				return response()->json([
					'deskripsi'	=> 'Deleted Data',
					'lampiran'	=> '',
					'lampiran2'	=> '',
					'lampiran3'	=> '',
					'lampiran4'	=> '',
					'lampiran5'	=> '',
					'lampiran6'	=> '',
					'jenissoal'	=> '',
					'opsia'		=> '',
					'opsib'		=> '',
					'opsic'		=> '',
					'opsid'		=> '',
					'opsie'		=> '',
				]);
			}
		}
		return back();
	}
	public function exaddtotxt(Request $request) {
		$tabel 		= '';
		$marking	= $request->input('set01');
		$homebase	= url("/");
		$data		= [];
		$i			= 0;
		$dilarang 	= array("<p>","</p>","<br />","<br>");
		if ($marking == 'activeonly'){
			$jjadwal 	= Banksoalaktif::where('created_by', Session('username'))->orderBy('id', 'DESC')->get();
			if (!empty($jjadwal)){
				foreach ($jjadwal as $rows){
					$idsoal		= $rows->active;
					$rmaster1 	= Banksoal::where('id', $idsoal)->first();
					if (isset($rmaster1->id)){
						$soal	    = $rmaster1->deskripsi;
						$jensoal	= $rmaster1->jawaban;
						$kode	    = $rmaster1->kode;
						$ceel	    = $rmaster1->ceel;
						$idne	    = $rmaster1->id;
						$tahun		= $rmaster1->created_at->year;
						$kunci		= $rmaster1->kunci;
						$lampiran	= $rmaster1->lampiran;
						if ($lampiran == null){ $lampiran = ''; }
						$kunci 		= preg_replace('/\s+/', '', $kunci);
						$tuliskode  = '<br />'.md5($tahun.'-'.$kode.'-'.$ceel.$idne);
						$soal 	    = str_replace($dilarang, "", $soal);
						$data['tabel'][$i]['kode'] 	= $tuliskode;
						$data['tabel'][$i]['soal'] 	= $soal;
						$data['tabel'][$i]['opsia'] = str_replace($dilarang, "", $rmaster1->opsia);
						$data['tabel'][$i]['opsib'] = str_replace($dilarang, "", $rmaster1->opsib);
						$data['tabel'][$i]['opsic'] = str_replace($dilarang, "", $rmaster1->opsic);
						$data['tabel'][$i]['opsid'] = str_replace($dilarang, "", $rmaster1->opsid);
						$data['tabel'][$i]['opsie'] = str_replace($dilarang, "", $rmaster1->opsie);
						$data['tabel'][$i]['kunci'] = $kunci;
						if ($lampiran != ''){
							if (file_exists(public_path('images/ujian/'.$lampiran))){
								$data['tabel'][$i]['gambar'] = '<img src="'.$homebase.'/images/ujian/'.$lampiran.'" /><br />';
							} else {
								$data['tabel'][$i]['gambar'] = '';
							}
						} else {
							$data['tabel'][$i]['gambar'] = '';
						}
						$i++;
					}
				}
			}
		} else {
			$ceksek 	= Banksoaltest::where('marking', $marking)->orderBy('id', 'DESC')->count();
			$jjadwal 	= Banksoaltest::where('marking', $marking)->orderBy('id', 'DESC')->get();
			if ($ceksek != 0){
				foreach ($jjadwal as $rows){
					$idsoal		= $rows->idsoal;
					$rmaster1 	= Banksoal::where('id', $idsoal)->first();
					if (isset($rmaster1->id)){
						$soal	    = $rmaster1->deskripsi;
						$jensoal	= $rmaster1->jawaban;
						$kode	    = $rmaster1->kode;
						$ceel	    = $rmaster1->ceel;
						$idne	    = $rmaster1->id;
						$tahun		= $rmaster1->created_at->year;
						$kunci		= $rmaster1->kunci;
						$lampiran	= $rmaster1->lampiran;
						if ($lampiran == null){ $lampiran = ''; }
						$kunci 		= preg_replace('/\s+/', '', $kunci);
						$tuliskode  = '<br />'.md5($tahun.'-'.$kode.'-'.$ceel.$idne);
						$soal 	    = str_replace($dilarang, "", $soal);
						$data['tabel'][$i]['kode'] 	= $tuliskode;
						$data['tabel'][$i]['soal'] 	= $soal;
						$data['tabel'][$i]['opsia'] = str_replace($dilarang, "", $rmaster1->opsia);
						$data['tabel'][$i]['opsib'] = str_replace($dilarang, "", $rmaster1->opsib);
						$data['tabel'][$i]['opsic'] = str_replace($dilarang, "", $rmaster1->opsic);
						$data['tabel'][$i]['opsid'] = str_replace($dilarang, "", $rmaster1->opsid);
						$data['tabel'][$i]['opsie'] = str_replace($dilarang, "", $rmaster1->opsie);
						$data['tabel'][$i]['kunci'] = $kunci;
						if ($lampiran != ''){
							if (file_exists(public_path('images/ujian/'.$lampiran))){
								$data['tabel'][$i]['gambar'] = '<img src="'.$homebase.'/images/ujian/'.$lampiran.'" /><br />';
							} else {
								$data['tabel'][$i]['gambar'] = '';
							}
						} else {
							$data['tabel'][$i]['gambar'] = '';
						}
						$i++;
					}
				}
			} else {
				$jjadwal = Banksoal::where('kode', $marking)->where('view', '1')->orderBy('id', 'DESC')->get();
				if (!empty($jjadwal)){
					$nomor = 1;
					foreach ($jjadwal as $rmaster1){
						$soal	    = $rmaster1->deskripsi;
						$jensoal	= $rmaster1->jawaban;
						$kode	    = $rmaster1->kode;
						$ceel	    = $rmaster1->ceel;
						$idne	    = $rmaster1->id;
						$tahun		= $rmaster1->created_at->year;
						$kunci		= $rmaster1->kunci;
						$lampiran	= $rmaster1->lampiran;
						if ($lampiran == null){ $lampiran = ''; }
						$kunci 		= preg_replace('/\s+/', '', $kunci);
						$tuliskode  = '<br />'.md5($tahun.'-'.$kode.'-'.$ceel.$idne);
						$soal 	    = str_replace($dilarang, "", $soal);
						$data['tabel'][$i]['kode'] 	= $nomor.'. ';
						$data['tabel'][$i]['soal'] 	= $soal;
						$data['tabel'][$i]['opsia'] = str_replace($dilarang, "", $rmaster1->opsia);
						$data['tabel'][$i]['opsib'] = str_replace($dilarang, "", $rmaster1->opsib);
						$data['tabel'][$i]['opsic'] = str_replace($dilarang, "", $rmaster1->opsic);
						$data['tabel'][$i]['opsid'] = str_replace($dilarang, "", $rmaster1->opsid);
						$data['tabel'][$i]['opsie'] = str_replace($dilarang, "", $rmaster1->opsie);
						$data['tabel'][$i]['kunci'] = $kunci;
						if ($lampiran != ''){
							if (file_exists(public_path('images/ujian/'.$lampiran))){
								$data['tabel'][$i]['gambar'] = '<img src="'.$homebase.'/images/ujian/'.$lampiran.'" /><br />';
							} else {
								$data['tabel'][$i]['gambar'] = '';
							}
						} else {
							$data['tabel'][$i]['gambar'] = '';
						}
						$i++;
						$nomor++;
					}
				} 
			}
		}
		return view('cetak.soal', $data);
	}
	public function exCeksoalkembar(Request $request) {
		$tabel 		= '';
		$homebase	= url("/");
		$dilarang 	= array("<p>","</p>","<br />", ",", "?", "!");
		$marking	= Session('id').time();
		$soale		= $request->input('set01');
		$soale 	    = str_replace($dilarang, "", $soale);
		$arrsoal	= explode(" ", $soale);
		if (isset($arrsoal[5])){
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			$kata03			= $arrsoal[2];
			$kata04			= $arrsoal[3];
			$kata05			= $arrsoal[4];
			$kata06			= $arrsoal[5];
			$kombinasi01	= $kata01.' '.$kata02.' '.$kata03.' '.$kata04;
			$kombinasi02	= $kata02.' '.$kata03.' '.$kata04.' '.$kata05;
			$kombinasi03	= $kata03.' '.$kata04.' '.$kata05.' '.$kata06;

		} else if (isset($arrsoal[4])){
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			$kata03			= $arrsoal[2];
			$kata04			= $arrsoal[3];
			$kata05			= $arrsoal[4];
			$kombinasi01	= $kata01.' '.$kata02.' '.$kata03;
			$kombinasi02	= $kata02.' '.$kata03.' '.$kata04;
			$kombinasi03	= $kata03.' '.$kata04.' '.$kata05;
		} else if (isset($arrsoal[3])){
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			$kata03			= $arrsoal[2];
			$kata04			= $arrsoal[3];
			$kombinasi01	= $kata01.' '.$kata02;
			$kombinasi02	= $kata02.' '.$kata03;
			$kombinasi03	= $kata03.' '.$kata04;
		} else {
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			if (isset($arrsoal[2])){
				$kata03			= $arrsoal[2];
				$kombinasi01	= $kata01.' '.$kata02;
				$kombinasi02	= $kata02.' '.$kata03;
				$kombinasi03	= $kata03;		
			} else {
				$kombinasi01	= $kata01.' '.$kata02;
				$kombinasi02	= $kata01;
				$kombinasi03	= $kata02;
			}
		}
		$ceksql1	= Banksoal::where('view', '!=', '0')->where('deskripsi', 'LIKE', '%'.$kombinasi01.'%')->get();
		if (!empty($ceksql1)){
			foreach ($ceksql1 as $getdata){
				Banksoalaktif::create([
					'kode'					=> $getdata->kode,
					'ceel'					=> $getdata->ceel,
					'deskripsi'				=> $getdata->deskripsi,
					'deskripsitambahan'		=> $getdata->deskripsitambahan,
					'lampiran'				=> $getdata->lampiran,
					'jawaban'				=> $getdata->jawaban,
					'opsia' 				=> $getdata->opsia,
					'opsib' 				=> $getdata->opsib,
					'opsic' 				=> $getdata->opsic,
					'opsid' 				=> $getdata->opsid,
					'opsie' 				=> $getdata->opsie,
					'kunci' 				=> $getdata->kunci,
					'active'				=> $getdata->id,
					'inputor'				=> $getdata->inputor,
					'view'					=> 1,
					'created_by'			=> $marking
				]);
			}
		}
		$ceksql2	= Banksoal::where('view', '!=', '0')->where('deskripsi', 'LIKE', '%'.$kombinasi02.'%')->get();
		if (!empty($ceksql2)){
			foreach ($ceksql2 as $getdata){
				Banksoalaktif::create([
					'kode'					=> $getdata->kode,
					'ceel'					=> $getdata->ceel,
					'deskripsi'				=> $getdata->deskripsi,
					'deskripsitambahan'		=> $getdata->deskripsitambahan,
					'lampiran'				=> $getdata->lampiran,
					'jawaban'				=> $getdata->jawaban,
					'opsia' 				=> $getdata->opsia,
					'opsib' 				=> $getdata->opsib,
					'opsic' 				=> $getdata->opsic,
					'opsid' 				=> $getdata->opsid,
					'opsie' 				=> $getdata->opsie,
					'kunci' 				=> $getdata->kunci,
					'active'				=> $getdata->id,
					'inputor'				=> $getdata->inputor,
					'view'					=> 1,
					'created_by'			=> $marking
				]);
			}
		}
		$ceksql3	= Banksoal::where('view', '!=', '0')->where('deskripsi', 'LIKE', '%'.$kombinasi03.'%')->get();
		if (!empty($ceksql3)){
			foreach ($ceksql3 as $getdata){
				Banksoalaktif::create([
					'kode'					=> $getdata->kode,
					'ceel'					=> $getdata->ceel,
					'deskripsi'				=> $getdata->deskripsi,
					'deskripsitambahan'		=> $getdata->deskripsitambahan,
					'lampiran'				=> $getdata->lampiran,
					'jawaban'				=> $getdata->jawaban,
					'opsia' 				=> $getdata->opsia,
					'opsib' 				=> $getdata->opsib,
					'opsic' 				=> $getdata->opsic,
					'opsid' 				=> $getdata->opsid,
					'opsie' 				=> $getdata->opsie,
					'kunci' 				=> $getdata->kunci,
					'active'				=> $getdata->id,
					'inputor'				=> $getdata->inputor,
					'view'					=> 1,
					'created_by'			=> $marking
				]);
			}
		}
		$rekap 	= Banksoalaktif::where('created_by',$marking)->select('id', 'active', 'kode', 'ceel', 'deskripsi', 'inputor', 'opsia', 'opsib', 'opsic', 'opsid', 'opsie', 'kunci', DB::Raw('COUNT(active) as jumlah'))->groupBy('active')->orderBy('jumlah', 'DESC')->get();
		$tabel	= '';
		$i		= 1;
		if (!empty($rekap)){
			$tabel = '<table border="1" cellpadding="1" cellspacing="1"><tr><th align="center">NO</th><th align="center">CODE</th><th align="center">Category</th><th align="center">DESCRIPTION</th><th align="center">CONTRIBUTOR</th><th align="center">COUNT</th></tr>';
			foreach ($rekap as $hasil){
				$opsia		= $hasil->opsia;
				$opsib		= $hasil->opsib;
				$opsic		= $hasil->opsic;
				$opsid		= $hasil->opsid;
				$opsie		= $hasil->opsie;
				$kunci		= $hasil->kunci;
				$kunci 		= preg_replace('/\s+/', '', $kunci);
				$showjawab	= '<table border="0"><tr><td>A</td><td>'.$opsia.'</td></tr><tr><td>B</td><td>'.$opsib.'</td></tr><tr><td>C</td><td>'.$opsic.'</td></tr><tr><td>D</td><td>'.$opsid.'</td></tr><tr><td>E</td><td>'.$opsie.'</td></tr><tr><td>Keys:</td><td>'.$kunci.'</td></tr></table>';
				$tabel = $tabel.'
					<tr>
						<td align="center">'.$i.'</td>
						<td align="center">'.$hasil->kode.'</td>
						<td align="center">'.$hasil->ceel.'</td>
						<td align="left">'.$hasil->deskripsi.'<br />'.$showjawab.'</td>
						<td align="center">'.$hasil->inputor.'</td>
						<td align="center">'.$hasil->jumlah.'</td>
					</tr>
				';
				$i++;
			}
			$tabel = $tabel.'</table>';
		}
		Banksoalaktif::where('created_by',$marking)->delete();
		echo $tabel;
	}
	public function exAddTest(Request $request) {
		$idne   	= $request->input('val07');
       	$homebase	= url("/");
		$keterangan	= '';
		$idsoal		= 0;
		if ($idne == 'hapus'){
			$idne		= $request->input('val01');
			$update 	= Banksoaltest::where('id', $idne)->update([
				'status'		=> 0,
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Non Akifkan']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($idne == 'new'){
			$nama   		= $request->input('val01');
			$dmulai   		= $request->input('val02');
			$tmulai   		= $request->input('val03');
			$dselesai   	= $request->input('val04');
			$tselesai   	= $request->input('val05');
			$status   		= $request->input('val06');
			$arridsoal		= $request->input('lists');
			$timer   		= $request->input('val08');
			$kodeujian   	= $request->input('val09');
			$ceel 			= 'I';
			$kode 			= 'UJ';
			if ($kodeujian == '' OR is_null($kodeujian)){ $kodeujian = 'UK'; }
			$arraymulai		= explode(" ", $tmulai);
			$jmulai 		= $arraymulai[0];
			$cmulai 		= $arraymulai[1];
			$arrayjmulai	= explode(":", $jmulai);
			$hhmulai		= (int)$arrayjmulai[0];
			$mmmulai		= $arrayjmulai[1];
			$marking		= $kodeujian.'-'.time();
			if ($cmulai == 'AM'){
				if ($hhmulai < 10){
					$mulai 	= $dmulai.' 0'.$hhmulai.':'.$mmmulai.':00';
				} else {
					$mulai 	= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
				}
			} else {
				if ($hhmulai ==  12){
					$hhmulai= 12;
				} else {
					$hhmulai= $hhmulai + 12;
				}
				$mulai 		= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
			}
			$arrayselesai	= explode(" ", $tselesai);
			$jselesai 		= $arrayselesai[0];
			$cselesai 		= $arrayselesai[1];
			$arrayjselesai	= explode(":", $jselesai);
			$hhselesai		= $arrayjselesai[0];
			$mmselesai		= $arrayjselesai[1];
			if ($cselesai == 'AM'){
				if ($hhselesai < 10){
					$akhir = $dselesai.' 0'.$hhselesai.':'.$mmselesai.':00';
				} else {
					$akhir = $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
				}
			} else {
				if ($hhselesai ==  12){
					$hhselesai 	= 12;
				} else {
					$hhselesai 	= $hhselesai + 12;
				}			
				$akhir 		= $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
			}
			$ceksudah 		= Banksoaltest::where('namaujian', $nama)->count();
			if ($ceksudah == 0){
				$i 			= 0;
				Banksoaltest::create([
					'ceel'			=> $ceel,
					'kode'			=> $kode,
					'namaujian'		=> $nama,
					'supervisor'	=> Session('nama'),
					'tipe'			=> '',
					'idsoal'		=> 0,
					'status'		=> $status,
					'mulai'			=> $mulai,
					'selesai'		=> $akhir,
					'timer'			=> $timer,
					'marking'		=> $marking,
					'created_by'	=> Session('username')
				]);
				Banksoalujian::where('marking', $marking)->update([
					'status'	=> $status
				]);
				return response()->json(['marking' => $marking, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Input Sejumlah '.$i.' Soal']);
				return back();
			} else {
				return response()->json(['marking' => $marking, 'icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Nama Ujian Sudah Ada, Mohon Membuat Nama Ujian dengan Nama Yang Unik (Lengkapi dengan Kode, tahun yang unik)']);
				return back();
			}
		} else {
			$nama   		= $request->input('val01');
			$dmulai   		= $request->input('val02');
			$tmulai   		= $request->input('val03');
			$dselesai   	= $request->input('val04');
			$tselesai   	= $request->input('val05');
			$status   		= $request->input('val06');
			$arridsoal		= $request->input('lists');
			$timer   		= $request->input('val08');
			if (is_null($status)){ $status = 1; }
			$arraymulai		= explode(" ", $tmulai);
			$jmulai 		= $arraymulai[0];
			if (isset($arraymulai[1])){
				$cmulai 	= $arraymulai[1];
			} else { $cmulai = ''; }
			$arrayjmulai	= explode(":", $jmulai);
			$hhmulai		= (int)$arrayjmulai[0];
			$mmmulai		= $arrayjmulai[1];
			if ($cmulai == 'AM'){
				if ($hhmulai < 10){
					$mulai = $dmulai.' 0'.$hhmulai.':'.$mmmulai.':00';
				}else {
					$mulai = $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
				}
			}else {
				if ($hhmulai ==  12){
					$hhmulai 	= 12;
				} else {
					$hhmulai 	= $hhmulai + 12;
				}
				$mulai 		= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
			}
			$arrayselesai	= explode(" ", $tselesai);
			$jselesai 		= $arrayselesai[0];
			if (isset($arrayselesai[1])){
				$cselesai 	= $arrayselesai[1];
			} else { $cselesai = ''; }
			$arrayjselesai	= explode(":", $jselesai);
			$hhselesai		= $arrayjselesai[0];
			$mmselesai		= $arrayjselesai[1];
			if ($cselesai == 'AM'){
				if ($hhselesai < 10){
					$akhir = $dselesai.' 0'.$hhselesai.':'.$mmselesai.':00';
				}else {
					$akhir = $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
				}
			}else {
				if ($hhselesai ==  12){
					$hhselesai 	= 12;
				} else {
					$hhselesai 	= $hhselesai + 12;
				}			
				$akhir 		= $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
			}
			if ($request->input('lists') !== null){
				$count	= count($arridsoal);
			} else {
				$count 	= 0;
			}
			if ($count == 0){
				$update = Banksoaltest::where('marking', $idne)->update([
					'namaujian'		=> $nama,
					'status'		=> $status,
					'pengumuman'	=> 0,
					'mulai'			=> $mulai,
					'selesai'		=> $akhir,
					'timer'			=> $timer,
					'created_by'	=> Session('username'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				Banksoalujian::where('marking', $idne)->update([
					'status'	=> $status
				]);
				
				return response()->json(['marking' => $idne, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Input']);
				return back();
			} else {
				Banksoaltest::where('marking', $idne)->delete();
				$i 			= 0;
				$marking	= 'UD-'.time();
				foreach ($arridsoal as $idsoal){
					$ceksek = Banksoal::where('id', $idsoal)->first();
					if (isset($ceksek->id)){
						$ceel = $ceksek->ceel;
						$kode = $ceksek->kode;
						$tipe = $ceksek->jawaban;
					} else { $ceel = 'I'; $kode = 'UD'; $tipe = 'choice';}
					Banksoaltest::create([
						'ceel'			=> $ceel,
						'kode'			=> $kode,
						'namaujian'		=> $nama,
						'supervisor'	=> Session('nama'),
						'tipe'			=> $tipe,
						'idsoal'		=> $idsoal,
						'status'		=> $status,
						'pengumuman'	=> 0,
						'mulai'			=> $mulai,
						'selesai'		=> $akhir,
						'timer'			=> $timer,
						'marking'		=> $marking,
						'created_by'	=> Session('username')
					]);
					$i++;
				}
				Banksoalujian::where('marking', $marking)->update([
					'status'	=> $status
				]);
				return response()->json(['marking' => $marking, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Update']);
				return back();
			}
		}
	}
	public function exAddPesertaTest(Request $request) {
		$idne   	= $request->input('val01');
		$marking   	= $request->input('val02');
		$jenis   	= $request->input('val03');
       	$homebase	= url("/");
		$update 	= null;
		$pesan		= '';
		$tanggal 	= date("Y-m-d H:i:s");
		$mulai 		= date("Y-m-d H:i:s");
		$akhir 		= date("Y-m-d H:i:s");
		$urutan 	= 1;
		$jumlah 	= 0;
		$tahun		= date("Y");
		$keterangan	= '';
		if ($idne == 'all'){
			$getallpeserta = Simpegpegawai::where('created_at', 'LIKE', $tahun.'-%')->get();
			if (!empty($getallpeserta)){
				foreach($getallpeserta as $getpeserta){
					$idpeserta 		= $getpeserta->id;
					$namapeserta	= $getpeserta->nama_lengkap;
					$nomorpeserta 	= $getpeserta->nip_baru;
					$asalpeserta 	= $getpeserta->prodihomebase;
					$urutan 		= 1;
					$jumlah			= 0;
					$getujian 		= Banksoaltest::where('marking', $marking)->orderByRaw("RAND()")->get();
					if (!empty($getujian)){
						foreach ($getujian as $rows){
							$timer 		= $rows->timer;
							$mulai 		= $rows->mulai;
							$akhir 		= $rows->selesai;
							$ceksek 	= Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->first();
							if (isset($ceksek->id)){
								Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->update([
									'status'	=> 1
								]);
								$jumlah++;
							} else {
								$input = Banksoalujian::create([
									'ceel'			=> $rows->ceel,
									'kode'			=> $rows->kode,
									'tanggal'		=> $tanggal,
									'namaujian'		=> $rows->namaujian,
									'supervisor'	=> $rows->supervisor,
									'idmahasiswa'	=> $idpeserta,
									'namapeserta'	=> $namapeserta,
									'asalpeserta'	=> $asalpeserta,
									'nomorpeserta'	=> $nomorpeserta,
									'idtest'		=> $rows->id,
									'idsoal'		=> $rows->idsoal,
									'tipe'			=> $rows->tipe,
									'urutan'		=> $urutan,
									'jawaban'		=> '',
									'skore'			=> 0,
									'status'		=> 1,
									'marking'		=> $marking,
									'created_at'	=> $tanggal
								]);
								$jumlah++;
							}
							$urutan++;
						}
					}
					$keterangan		= $keterangan.'Set Ujian an. '.$namapeserta.' Sejumlah '.$jumlah.' Soal;<br /> ';
				}
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Info', 'message' => $keterangan]);
			return back();
		} else {
			$getpeserta = Simpegpegawai::where('id', $idne)->first();
			if (isset($getpeserta->id)){
				$idpeserta 		= $getpeserta->id;
				$namapeserta	= $getpeserta->nama_lengkap;
				$nomorpeserta 	= $getpeserta->nip_baru;
				$asalpeserta 	= $getpeserta->prodihomebase;
				$getujian 		= Banksoaltest::where('marking', $marking)->orderByRaw("RAND()")->get();
				if (!empty($getujian)){
					foreach ($getujian as $rows){
						$timer 		= $rows->timer;
						$mulai 		= $rows->mulai;
						$akhir 		= $rows->selesai;
						$ceksek 	= Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->first();
						if (isset($ceksek->id)){
							Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->update([
								'status'	=> 1
							]);
							$jumlah++;
						} else {
							$input = Banksoalujian::create([
								'ceel'			=> $rows->ceel,
								'kode'			=> $rows->kode,
								'tanggal'		=> $tanggal,
								'namaujian'		=> $rows->namaujian,
								'supervisor'	=> $rows->supervisor,
								'idmahasiswa'	=> $idpeserta,
								'namapeserta'	=> $namapeserta,
								'asalpeserta'	=> $asalpeserta,
								'nomorpeserta'	=> $nomorpeserta,
								'idtest'		=> $rows->id,
								'idsoal'		=> $rows->idsoal,
								'tipe'			=> $rows->tipe,
								'urutan'		=> $urutan,
								'jawaban'		=> '',
								'skore'			=> 0,
								'status'		=> 1,
								'marking'		=> $marking,
								'created_at'	=> $tanggal
							]);
							$jumlah++;
						}
						$urutan++;
					}
				}
				if ($jumlah != 0){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $namapeserta.' Set Ujian Sejumlah '.$jumlah.' Soal']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Soal Tidak Ditemukan, Mohon Input Soal Terlebih Dahulu']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Peserta Tidak Valid']);
				return back();
			}
		}
	}
	public function viewUjianKompetensi() {
		$homebase		= url("/");
		$getdomainid 	= DB::table('app_menu')->where('route', 'LIKE', $homebase.'%')->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_bt.$id;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_bt.$id;
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
			$subdomainapps				= $getdomainid->subdomainapps;
			$subsubdomainapps			= $getdomainid->subsubdomainapps;
		} else {
			$data['namaapps01']  		= namaapps07;
			$data['domainapps01']  		= domainapps07;
			$data['subdomainapps01']  	= subdomainapps07;
			$data['subsubdomainapps01'] = subsubdomainapps07;
			$data['addressapps01']  	= addressapps07;
			$data['emailapps01']  		= emailapps07;
			$data['lamanapps01']  		= lamanapps07;
			$data['logofrontapps01']  	= logofrontapps07;
			$subdomainapps				= subdomainapps07;
			$subsubdomainapps			= subsubdomainapps07;
		}
		$idujian		= Session('id');
		$idpeg			= Session('idpeg');
		$data			= [];
		$semester 		= '';
		$prodi			= 0;
		$tandatangan 	= $homebase.'/boxed-bg.png';
		$foto 			= $homebase.'/mascot.png';
        $getdata 		= User::where('email', Session('email'))->first();
		if (isset($getdata->id)){
			$idne 		= $getdata->id;
			$marking 	= $getdata->smt;
			$hasil		= Simpegpegawai::where('email', Session('email'))->first();
			if (isset($hasil->nama_lengkap)){
				$listsoalkb		= [];
				$urutan 		= 1;
				$i 				= 0;
				$namaujian 		= '';
				$timer 			= 0;
				$tanggal 		= date("Y-m-d H:i:s");
				$mulai 			= date("Y-m-d H:i:s");
				$akhir 			= date("Y-m-d H:i:s");
				$idpeserta 		= $hasil->id;
				$namapeserta	= $hasil->nama_lengkap;
				$nomorpeserta 	= $hasil->nip_baru;
				$asalpeserta 	= $hasil->prodihomebase;
				$ppabp 			= $hasil->ppabp;
				$idpeg			= $idpeserta;
				$programstudi 	= $hasil->program_studi;
				if (Session('fakpanjang') == 'Rekrutmen PT DPM'){
					$marking	= $hasil->id.'-'.$hasil->program_studi;
				}
				$sql			= Banksoaltest::where('marking', $marking)->where('status', '1')->orderByRaw("RAND()")->get();
				if (!empty($sql)){
					foreach ($sql as $rows){
						$timer 		= $rows->timer;
						$mulai 		= $rows->mulai;
						$akhir 		= $rows->selesai;
						$ceksek = Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->first();
						if (isset($ceksek->id)){
							$id = $ceksek->id;
						} else {
							$input = Banksoalujian::create([
								'ceel'			=> $rows->ceel,
								'kode'			=> $rows->kode,
								'tanggal'		=> $tanggal,
								'namaujian'		=> $rows->namaujian,
								'supervisor'	=> $rows->supervisor,
								'idmahasiswa'	=> $idpeserta,
								'namapeserta'	=> $namapeserta,
								'asalpeserta'	=> $asalpeserta,
								'nomorpeserta'	=> $nomorpeserta,
								'idtest'		=> $rows->id,
								'idsoal'		=> $rows->idsoal,
								'tipe'			=> $rows->tipe,
								'urutan'		=> $urutan,
								'jawaban'		=> '',
								'skore'			=> 0,
								'status'		=> 1,
								'marking'		=> $marking,
								'created_at'	=> $tanggal
							]);
							$id = $input->id;
						}
						$urutan++;
					}
				}
				$absenmulai = Carbon::createFromFormat('Y-m-d H:i:s', $mulai);
				$absenakhir = Carbon::createFromFormat('Y-m-d H:i:s', $akhir);
				$check 		= Carbon::now()->between($absenmulai,$absenakhir);
				if ($check){
					$urutan 	= 1;
					$i 			= 0;
					$sql		= Banksoalujian::where('idmahasiswa', $idpeserta)->where('marking', $marking)->orderBy('urutan', 'ASC')->get();
					if (!empty($sql)){
						foreach ($sql as $rows){
							$listsoalkb[$i]['id']   	= $rows->id;
							$listsoalkb[$i]['sudah']   	= $rows->jawaban;
							$listsoalkb[$i]['urutan']  	= $urutan;
							$i++;
							$urutan++;
						}
					}
					if ($i == 0){
						$listsoalkb[$i]['id']   	= 0;
						$listsoalkb[$i]['sudah']   	= '';
						$listsoalkb[$i]['urutan']  	= 0;
					}
					$data['idmahasiswa']	= $idpeserta;
					$data['tlsprodi']		= $subdomainapps;
					$data['programstudi']	= $subsubdomainapps;
					$data['listsoalkb']		= $listsoalkb;
					$data['mulai']			= $mulai;
					$data['akhir']			= $akhir;
					$data['timer']			= $timer;
					$data['jenisujian']		= 'ujian';
					return view('banksoal.ujian', $data);
				} else {
					if (Session('fakpanjang') == 'Rekrutmen PT DPM'){

					} else {
						User::where('username', Session('username'))->update([
							'klsajar'	=> '',
							'smt'		=> null,
							'updated_at'=> date("Y-m-d H:i:s")
						]);	
					}
					$data['judulpesan']			= 'Restricted Area';
					$data['kalimatheader']		= 'Waktu '.date("Y-m-d H:i:s").' Diluar Rentang Setting '.$marking;
					$data['kalimatbody']		= 'Ujian Ini di Setting Mulai '.$mulai.' s/d '.$akhir.' <br /> <a href="profiluser">Kembali Ke Laman Biodata</a>';
					return view('errors.notready', $data);
				}
			
			} else {
				$data['judulpesan']			= 'Restricted Area';
				$data['kalimatheader']		= 'ID Tidak Valid';
				$data['kalimatbody']		= 'Mohon Maaf ID '.$idpeg.' Tidak Di Temukan';
				return view('errors.notready', $data);
			}
		} else {
			$data['judulpesan']			= 'Restricted Area';
			$data['kalimatheader']		= 'Session Expired';
			$data['kalimatbody']		= 'Mohon Maaf Laman Ini tidak dapat diakses, Data Tidak Valid, Silahkan Relogin';
			return view('errors.notready', $data);
		}
	}
	public function viewTryOut() {
		$homebase		= url("/");
		$data			= [];
		$getdomainid 	= DB::table('app_menu')->where('route', 'LIKE', $homebase.'%')->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_bt.$id;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_bt.$id;
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
			$subdomainapps				= $getdomainid->subdomainapps;
			$subsubdomainapps			= $getdomainid->subsubdomainapps;
		} else {
			$data['namaapps01']  		= namaapps07;
			$data['domainapps01']  		= domainapps07;
			$data['subdomainapps01']  	= subdomainapps07;
			$data['subsubdomainapps01'] = subsubdomainapps07;
			$data['addressapps01']  	= addressapps07;
			$data['emailapps01']  		= emailapps07;
			$data['lamanapps01']  		= lamanapps07;
			$data['logofrontapps01']  	= logofrontapps07;
			$subdomainapps				= subdomainapps07;
			$subsubdomainapps			= subsubdomainapps07;
		}
		$getdata 		= User::where('username', Session('username'))->first();
		if (isset($getdata->smt)){
			$idne 		= $getdata->id;
			$hasil		= Simpegpegawai::where('idpeg', $idne)->first();
			if (isset($hasil->nama_lengkap)){
				$listsoalkb	= [];
				$urutan 	= 1;
				$i 			= 0;
				$namaujian 	= '';
				$timer 		= 0;
				$tanggal 	= date("Y-m-d H:i:s");
				$mulai 		= date("Y-m-d H:i:s");
				$akhir 		= date("Y-m-d H:i:s");
				$sql		= Banksoaltest::where('marking', $getdata->smt)->where('status', '1')->orderByRaw("RAND()")->get();
				if (!empty($sql)){
					foreach ($sql as $rows){
						$timer 		= $rows->timer;
						$mulai 		= $rows->mulai;
						$akhir 		= $rows->selesai;
						$ceksek = Banksoalujian::where('idmahasiswa', $hasil->id)->where('idtest', $rows->id)->first();
						if (isset($ceksek->id)){
							$id = $ceksek->id;
						} else {
							$input = Banksoalujian::create([
								'ceel'			=> $rows->ceel,
								'kode'			=> $rows->kode,
								'tanggal'		=> $tanggal,
								'namaujian'		=> 'Try Out',
								'supervisor'	=> $rows->supervisor,
								'idmahasiswa'	=> $hasil->id,
								'idtest'		=> $rows->id,
								'idsoal'		=> $rows->idsoal,
								'tipe'			=> $rows->tipe,
								'urutan'		=> $urutan,
								'jawaban'		=> '',
								'skore'			=> 0,
								'status'		=> 1,
								'marking'		=> $getdata->smt,
								'created_at'	=> $tanggal
							]);
							$id = $input->id;
						}
						$urutan++;
					}
				}
				$urutan 	= 1;
				$i 			= 0;
				$sql		= Banksoalujian::where('idmahasiswa', $hasil->id)->where('marking', $getdata->smt)->orderBy('urutan', 'ASC')->get();
				if (!empty($sql)){
					foreach ($sql as $rows){
						$listsoalkb[$i]['id']   	= $rows->id;
						$listsoalkb[$i]['sudah']   	= $rows->jawaban;
						$listsoalkb[$i]['urutan']  	= $urutan;
						$i++;
						$urutan++;
					}
				}
				if ($i == 0){
					$listsoalkb[$i]['id']   	= 0;
					$listsoalkb[$i]['sudah']   	= '';
					$listsoalkb[$i]['urutan']  	= 0;
				}
				$data['idmahasiswa']		= $hasil->id;
				$data['tlsprodi']			= $subdomainapps;
				$data['programstudi']		= $subsubdomainapps;
				$data['listsoalkb']			= $listsoalkb;
				$data['mulai']				= $mulai;
				$data['akhir']				= $akhir;
				$data['timer']				= $timer;
				$data['jenisujian']			= 'tryout';
				return view('banksoal.ujian', $data);
			} else {
				$data['judulpesan']			= 'Restricted Area';
				$data['kalimatheader']		= 'Session Un Valid';
				$data['kalimatbody']		= 'Please try to relogin';
				return view('errors.notready', $data);
			}
		} else {
			$data['judulpesan']			= 'Restricted Area';
			$data['kalimatheader']		= 'Unkown Try Out Ticket';
			$data['kalimatbody']		= 'Please try to select test mark again';
			return view('errors.notready', $data);
		}
	}
	public function exSimpanJawaban(Request $request) {
    	$idujian		= $request->input('set01');
		$idmahasiswa	= $request->input('set02');
		$jawaban		= $request->input('set03');
        $getdata 		= Banksoalujian::where('id', $idujian)->first();
        if (isset($getdata->id)){
            $idtest 	= $getdata->idtest;
            $namaujian 	= $getdata->namaujian;
            $getdatatest= Banksoaltest::where('id', $idtest)->first();
            if (isset($getdatatest->id)){
                $mulai 		= $getdatatest->mulai;
                $akhir 		= $getdatatest->selesai;
                $namaujian 	= $getdatatest->namaujian;
            } else {
                $mulai 		= date("Y-m-d H:i:s");
                $akhir 		= date("Y-m-d H:i:s");
            }
            $absenmulai = Carbon::createFromFormat('Y-m-d H:i:s', $mulai);
            $absenakhir = Carbon::createFromFormat('Y-m-d H:i:s', $akhir);
            $check 		= Carbon::now()->between($absenmulai,$absenakhir);
            $skore 		= 0;
            $kunci		= '';
            $getskore 	= Banksoal::where('id', $getdata->idsoal)->first();
            if (isset($getskore->kunci)){
                $kunci 	= $getskore->kunci;
                if ($kunci == $jawaban){
                    $skore = 1;
                }
            }
			if (Session('fakpanjang') == 'Rekrutmen PT DPM'){
				$setttingujian 		= 'Close';
				$hasil				= Simpegpegawai::where('email', Session('email'))->first();
				if (isset($hasil->nama_lengkap)){
					$programstudi 	= $hasil->program_studi;
				}
				$getdatasetting 	= Setting::where('ppabp', $programstudi)->where('jenis', 'ujiankompetensi')->first();
				if (isset($getdatasetting->isi1)){
					$setttingujian 	= $getdatasetting->isi1;
				}
				if ($setttingujian == ''){
					$namaujian = 'Try Out';
				}
			}
				
			if ($namaujian == 'Try Out'){
				Banksoalujian::where('id', $idujian)->update([
					'jawaban'	=> $jawaban,
					'skore'		=> $skore,
					'kunci'		=> $kunci,
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Try Out Test.!! Answer Saved']);
				return back();
			} else {
				if($check){
					Banksoalujian::where('id', $idujian)->update([
						'jawaban'	=> $jawaban,
						'skore'		=> $skore,
						'kunci'		=> $kunci,
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Answer Saved']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Close', 'message' => 'Ujian Telah di Tutup, Jawaban Tidak Lagi Bisa di Simpan karena diluar rentang '.$mulai.' s/d '.$akhir]);
					return back();
				}
			}
        } else {
            return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idujian.' Tidak Valid, Hubungi TIM IT atau Refresh Laman Ini']);
            return back();
        }
    
	}
	public function jsonallcase(Request $request) {
		$arraysurat 	= [];
		$tahun			= $request->input('set01');
		$inputor		= $request->input('set02');
		$kode			= $request->input('set03');
		if ($tahun == 'soalaktif' OR $tahun == 'carisoal'){
			$markingtes = $kode;
			$jjadwal = Banksoal::where('view', '!=', '0')->orderBy('created_by', 'DESC')->get();
			if (!empty($jjadwal)){
				foreach ($jjadwal as $hasil) {
					$idsoal 	= $hasil->id;
					$ceksudah 	= Banksoaltest::where('marking', $markingtes)->where('idsoal', $hasil->id)->count();
					$tulis 		= '';
					if ($tahun == 'soalaktif' AND $ceksudah != 0){ $tulis = 'YES'; }
					if ($tahun == 'carisoal' AND $ceksudah == 0){ $tulis = 'YES'; }
					if ($tulis == 'YES'){
						$tlssoale	= $hasil->deskripsi;
						$alasan		= $hasil->deskripsitambahan;
						$kode		= $hasil->kode;
						$ceel		= $hasil->ceel;
						$aktif		= $hasil->active;
						$dosen		= $hasil->inputor;
						$tipesoal	= $hasil->jawaban;
						$view		= $hasil->view;
						$lampiran	= $hasil->lampiran;
						$fullkode	= $hasil->fullkode;
						$nilai01	= $hasil->nilai01;
						$inputor	= $dosen;
						if ($aktif == 1){ 
							$aktif 		= '&#10004;';
							$tlssoale	= '<font color="green">'.$tlssoale.'</font>';
						} else { $aktif = ''; }
						if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
						$showjawab	= '';	
						$opsia		= $hasil->opsia;
						$opsib		= $hasil->opsib;
						$opsic		= $hasil->opsic;
						$opsid		= $hasil->opsid;
						$opsie		= $hasil->opsie;
						$kunci		= $hasil->kunci;
						$kunci 		= preg_replace('/\s+/', '', $kunci);
						$showjawab	= '<table border="0"><tr><td>A</td><td>'.$opsia.'</td></tr><tr><td>B</td><td>'.$opsib.'</td></tr><tr><td>C</td><td>'.$opsic.'</td></tr><tr><td>D</td><td>'.$opsid.'</td></tr><tr><td>E</td><td>'.$opsie.'</td></tr><tr><td>Keys : </td><td>'.$kunci.'</td></tr></table>';
						if ($lampiran == ''){
							$lampiran = '';
						} else {
							if (file_exists(public_path('images/ujian/'.$lampiran))){
								$tlssoale = '<table border="0"><tr><td><a href="images/ujian/'.$lampiran.'" target="_blank"><img src="images/ujian/'.$lampiran.'" width="150" /></a></td><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
							} else {
								$tlssoale = '<table border="0"><tr><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
								$lampiran = '';
							}
						}
						$keterangan		= '<strong>Kontributor : </strong>'.$inputor.'<br /><strong>Used On :</strong>'.$hasil->deskripsitambahan.'<br />Facility : '.$hasil->nilai01.' ( '.$hasil->keterangan01.' )<br />Discrimination : '.$hasil->nilai02.' ( '.$hasil->keterangan02.' )<br />so the question is : '.$hasil->kesimpulan;
						$arraysurat[] = array(
							'idsoal' 			=> $idsoal,
							'markingtes' 		=> $markingtes,
							'fullkode' 			=> $hasil->fullkode,
							'tipesoal' 			=> $tipesoal,	
							'tlssoale' 			=> $tlssoale,
							'keterangan' 		=> $keterangan,
							'lampiran' 			=> $hasil->lampiran,
							'lampiran2' 		=> $hasil->lampiran2,
							'lampiran3' 		=> $hasil->lampiran3,
							'lampiran4' 		=> $hasil->lampiran4,
							'lampiran5' 		=> $hasil->lampiran5,
							'lampiran6' 		=> $hasil->lampiran6,
							'kode' 				=> $kode,
							'ceel' 				=> $ceel,	
							'inputor' 			=> $inputor,
							'deskripsi' 		=> $hasil->deskripsi,
							'jawaba' 			=> $hasil->opsia,
							'jawabb' 			=> $hasil->opsib,
							'jawabc' 			=> $hasil->opsic,
							'jawabd' 			=> $hasil->opsid,
							'jawabe' 			=> $hasil->opsie,
							'kuncie' 			=> $kunci,
							'tahun' 			=> $hasil->created_at->year,
							'deskripsitambahan' => $hasil->deskripsitambahan,
							'created_by' 		=> $hasil->created_by,
						);
					}
				}
			}
		} else if ($tahun == 'statistik') {
			$arraysurat 	= Banksoaltest::where('marking', $kode)->select('kesimpulan', DB::Raw('COUNT(id) as jumlah'))->groupBy('kesimpulan')->get();
		} else if ($tahun == 'rekap') {
			$arraysurat 	= Banksoal::where('view', '1')->select('ceel', 'kode', DB::Raw('COUNT(id) as jumlah'))->groupBy('ceel')->get();
		} else if ($tahun == 'listpewancara') {
			$arraysurat 	= User::where('merangkap', 'Penguji Lisan')->where('smt', $kode)->get();
		} else if ($tahun == 'caripeserta') {
			$arraysurat 	= Banksoalujian::where('marking', $kode)->where('status', '!=', '3')->groupBy('idmahasiswa')->get();
		} else if ($tahun == 'koreksipeserta') {
			$email 			= Session('email');
			if ($email == 'admin@banksoal.duidev.com'){ $email = 'admin@inabr.or.id'; }
			$getfakultas 	= Simpegpegawai::where('email', $email)->first();
			if (isset($getfakultas->id)){
				$idpeg 	= $getfakultas->id;
			} else {
				$idpeg 	= Session('id');
			}
			$sql 		= Banksoaltest::where('idsupervisor', $idpeg)->where('status', '1')->get();
			if (!empty($sql)){
				foreach ($sql as $rows){
					$marking 		= $rows->marking;
					$namaujian 		= $rows->namaujian;
					$supervisor 	= $rows->supervisor;
					$idsoal 		= $rows->idsoal;
					$getmahasiswa 	= Banksoalujian::where('marking', $marking)->where('idsoal', $idsoal)->get();
					if (!empty($getmahasiswa)){
						foreach($getmahasiswa as $rmhs){
							$cekjawaban = $rmhs->jawaban;
							if ($cekjawaban == ''){
								$skore = '<font color=grey>'.$rmhs->skore.'</font>';
							} else {
								if ($rmhs->skore == 0){
									$skore = '<font color=yellow>'.$rmhs->skore.'</font>';
								} else {
									$skore = '<font color=green>'.$rmhs->skore.'</font>';
								}
							}
							$arraysurat[] = array(
								'id' 			=> $rmhs->id,
								'namapeserta' 	=> $rmhs->namapeserta,
								'nomorpeserta' 	=> $rmhs->nomorpeserta,
								'asalpeserta' 	=> $rmhs->asalpeserta,
								'supervisor' 	=> $supervisor,
								'idtest' 		=> $rmhs->idtest,
								'idsoal' 		=> $rmhs->idsoal,
								'idmahasiswa' 	=> $rmhs->idmahasiswa,
								'nilai' 		=> $rmhs->skore,
								'viewnilai' 	=> $skore,
								'jawaban' 		=> $rmhs->jawaban,
								'tanggal' 		=> $rmhs->tanggal,
								'namaujian' 	=> $namaujian,
							);
						}
					}
				}
			}
		} else if ($tahun == 'koreksilist') {
			$arraysurat 	= Banksoalujian::where('idmahasiswa', $request->input('set02'))->where('marking', $request->input('set03'))->orderBy('idsoal', 'ASC')->get();
		} else if ($tahun == 'esaionly') {
			$getallsoal 	= Banksoaltest::where('marking', $kode)->get();
			if (!empty($getallsoal)){
				foreach($getallsoal as $hasil){
					$tipe 		= $hasil->tipe;
					$idsoal		= $hasil->idsoal;
					$ceel		= $hasil->ceel;
					$kode		= $hasil->kode;
					$deskripsi	= '';
					$caritipe 	= Banksoal::where('id', $idsoal)->first();
					if (isset($caritipe->jawaban)){
						$tipe 		= $caritipe->jawaban;
						$deskripsi 	= $caritipe->deskripsi;
						$ceel 		= $caritipe->ceel;
						$kode 		= $caritipe->kode;
					}
					if ($tipe == 'esay'){
						$arraysurat[] 	= array(
							'id' 				=> $hasil->id,
							'ceel' 				=> $ceel,
							'kode' 				=> $kode,
							'namaujian' 		=> $hasil->namaujian,
							'supervisor' 		=> $hasil->supervisor,
							'idsupervisor' 		=> $hasil->idsupervisor,
							'tipe' 				=> $tipe,
							'idsoal' 			=> $hasil->idsoal,
							'status' 			=> $hasil->status,
							'pengumuman' 		=> $hasil->pengumuman,
							'mulai' 			=> $hasil->mulai,
							'selesai' 			=> $hasil->selesai,
							'timer' 			=> $hasil->timer,
							'marking' 			=> $hasil->marking,
							'created_by' 		=> $hasil->created_by,
							'tahun' 			=> $hasil->created_at->year,
							'deskripsi' 		=> $deskripsi,
						);
					}
				}
			}
		} else {
			if ($kode != '' OR $request->input('set03') !== null){
				if ($tahun == 'activeonly'){
					$jjadwal = Banksoal::where('kode', $kode)->where('created_by', Session('username'))->orderBy('id', 'DESC')->get();
				} else if ($tahun == 'Deleted'){
					$jjadwal = Banksoal::where('kode', $kode)->where('view', '0')->orderBy('created_by', 'DESC')->get();
				} else if ($tahun == 'all'){
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('kode', $kode)->where('created_by', Session('username'))->where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				} else {
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('kode', $kode)->where('created_by', Session('username'))->where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->whereYear('created_at', $tahun)->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				}
			} else {
				if ($tahun == 'activeonly'){
					$jjadwal = Banksoal::where('created_by', Session('username'))->orderBy('id', 'DESC')->get();
				} else if ($tahun == 'unverfied'){
					if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator') {
						$jjadwal = Banksoal::where('active', 1)->where('view', '0')->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('active', 1)->where('view', '0')->where('verified_by', Session('email'))->orderBy('id', 'DESC')->get();
					}
				} else if ($tahun == 'Deleted'){
					$jjadwal = Banksoal::where('view', '0')->orderBy('created_by', 'DESC')->get();
				} else if ($tahun == 'all'){
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('created_by', Session('username'))->where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('view', '!=', '0')->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				} else {
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('created_by', Session('username'))->where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('view', '!=', '0')->whereYear('created_at', $tahun)->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				}
			}
			if (!empty($jjadwal)){
				foreach ($jjadwal as $hasil) {
					$idsoal 	= $hasil->id;
					$tlssoale	= $hasil->deskripsi;
					$alasan		= $hasil->deskripsitambahan;
					$kode		= $hasil->kode;
					$ceel		= $hasil->ceel;
					$aktif		= $hasil->active;
					$dosen		= $hasil->inputor;
					$tipesoal	= $hasil->jawaban;
					$view		= $hasil->view;
					$tahun		= $hasil->created_at->year;
					$lampiran	= $hasil->lampiran;
					$fullkode	= $hasil->fullkode;
					$nilai01	= $hasil->nilai01;
					if (is_null($alasan)){ $alasan = ''; }
					if (is_null($nilai01)){ $nilai01 = ''; }
					if (is_null($fullkode) OR $fullkode == ''){
						$getnama	= Pegawai::where('email', $hasil->created_by)->first();
						if (isset($getnama->nama_lengkap)){
							$idpegawai = $getnama->no;
						} else { $idpegawai = $idsoal; }
						$fullkode = $tahun.'-'.$kode.'-'.$idpegawai.'-'.$idsoal;
						Banksoal::where('id', $idsoal)->update([
							'fullkode'	=> $fullkode
						]);
					}
					if (is_null($nilai01) OR $nilai01 == '' AND $request->input('set01') != 'activeonly'){
						$fullkode 	= $tahun.'-'.$kode.'-'.$ceel.$idsoal;
						if ($request->input('set01') != 'unverfied'){
							$getrating	= Banksoalrating::where('kodesoal', $fullkode)->first();
							if (isset($getrating->id)){
								Banksoal::where('id', $idsoal)->update([
									'nilai01'		=> $getrating->facility,
									'nilai02'		=> $getrating->discrimination,
									'keterangan01'	=> $getrating->facilitytext,
									'keterangan02'	=> $getrating->discriminationtext,
									'kesimpulan'	=> $getrating->kesimpulan,
								]);	
							}
						}
					}
					$inputor	= $dosen;
					if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
					$opsia		= $hasil->opsia;
					$opsib		= $hasil->opsib;
					$opsic		= $hasil->opsic;
					$opsid		= $hasil->opsid;
					$opsie		= $hasil->opsie;
					$kunci		= $hasil->kunci;
					$kunci 		= preg_replace('/\s+/', '', $kunci);
					if ($tipesoal == 'esay'){
						$showjawab	= 'Kunci Jawaban : <pre>'.$opsia.'</pre>';
					
					} else {
						$showjawab	= '<table border="0"><tr><td>A</td><td>'.$opsia.'</td></tr><tr><td>B</td><td>'.$opsib.'</td></tr><tr><td>C</td><td>'.$opsic.'</td></tr><tr><td>D</td><td>'.$opsid.'</td></tr><tr><td>E</td><td>'.$opsie.'</td></tr><tr><td>Keys : </td><td>'.$kunci.'</td></tr></table>';
					
					}
					if ($lampiran == ''){
						$tlssoale = '<table border="0"><tr><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
					} else {
						if (file_exists(public_path('images/ujian/'.$lampiran))){
							$tlssoale = '<table border="0"><tr><td><a href="images/ujian/'.$lampiran.'" target="_blank"><img src="images/ujian/'.$lampiran.'" width="150" /></a></td><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
						} else {
							$tlssoale = '<table border="0"><tr><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
							$lampiran = '';
						}
					}
					$keterangan		= '<strong>Kontributor : </strong>'.$inputor;
					if ($alasan != ''){
						$keterangan = $keterangan.'<br /><strong>Used On :</strong>'.$hasil->deskripsitambahan;
					}
					if ($nilai01 != ''){
						$keterangan = $keterangan.'<br />Facility : '.$hasil->nilai01.' ( '.$hasil->keterangan01.' )<br />Discrimination : '.$hasil->nilai02.' ( '.$hasil->keterangan02.' )<br />so the question is : '.$hasil->kesimpulan;
					}
					
					$arraysurat[] = array(
						'idsoal' 			=> $idsoal,
						'tipesoal' 			=> $tipesoal,	
						'jawaban' 			=> $hasil->jawaban,
						'tlssoale' 			=> $tlssoale,
						'keterangan' 		=> $keterangan,
						'kode' 				=> $kode,
						'fullkode' 			=> $hasil->fullkode,
						'lampiran' 			=> $hasil->lampiran,
						'lampiran2' 		=> $hasil->lampiran2,
						'lampiran3' 		=> $hasil->lampiran3,
						'lampiran4' 		=> $hasil->lampiran4,
						'lampiran5' 		=> $hasil->lampiran5,
						'lampiran6' 		=> $hasil->lampiran6,
						'ceel' 				=> $ceel,	
						'inputor' 			=> $inputor,
						'aktif' 			=> $aktif,
						'aktifview' 		=> $view,
						'alasan' 			=> $alasan,
						'deskripsi' 		=> $hasil->deskripsi,
						'jawaba' 			=> $hasil->opsia,
						'jawabb' 			=> $hasil->opsib,
						'jawabc' 			=> $hasil->opsic,
						'jawabd' 			=> $hasil->opsid,
						'jawabe' 			=> $hasil->opsie,
						'kuncie' 			=> $kunci,
						'tahun' 			=> $hasil->created_at->year,
						'created_by' 		=> $hasil->created_by,
						'verified_by' 		=> $hasil->verified_by,
						'fakultas' 			=> $hasil->fakultas,
						'fakpanjang' 		=> $hasil->fakpanjang,
						'deskripsitambahan' => $hasil->deskripsitambahan,
					);
				}
			}
		}
		echo json_encode($arraysurat);	
	}
	public function aktifet(Request $request) {
		$idsoal		= $request->input('val01');
		$kerja		= $request->input('val02');
		$marking	= $request->input('val03');
		if ($kerja == 'removespv'){
			$input 	= User::where('id', $idsoal)->update([
				'merangkap'	=> ''
			]);
			if ($input){
				echo 'Hak Pewancara Telah Kami Hilangkan';
			} else {
				echo 'ID Tidak Valid / Hak Pewancara Telah Tercabut Sebelumnya';
			}
		} else {
			$getdata 	= Banksoal::where('id', $idsoal)->first();
			if (isset($getdata->id)){
				if ($kerja == 'input'){
					$cekid 	= Banksoaltest::where('marking', $marking)->first();
					if (isset($cekid->id)){
						$cekwes = Banksoaltest::where('marking', $marking)->where('idsoal', $idsoal)->count();
						if ($cekwes == 0){
							$cekidkosong 	= Banksoaltest::where('marking', $marking)->where('idsoal', 0)->first();
							if (isset($cekidkosong->id)){
								$update 	= Banksoaltest::where('id', $cekidkosong->id)->update([
									'kode'			=> $getdata->kode,
									'idsoal'		=> $idsoal,
									'tipe'			=> $getdata->tipe,
									'created_by'	=> Session('username'),
									'updated_at'	=> date("Y-m-d H:i:s")
								]);
							} else {
								$update = Banksoaltest::create([
									'ceel'			=> $cekid->ceel,
									'kode'			=> $getdata->kode,
									'namaujian'		=> $cekid->namaujian,
									'supervisor'	=> $cekid->supervisor,
									'tipe'			=> $getdata->tipe,
									'idsoal'		=> $idsoal,
									'status'		=> 1,
									'pengumuman'	=> 0,
									'marking'		=> $cekid->marking,
									'mulai'			=> $cekid->mulai,
									'selesai'		=> $cekid->selesai,
									'timer'			=> $cekid->timer,
									'created_by'	=> Session('username')
								]);
							}
							if ($update){
								$keterangan	= '';
								$getujian	= Banksoaltest::where('idsoal', $idsoal)->groupBy('marking')->get();
								if (!empty($getujian)){
									$keterangan = '<ol>';
									foreach ($getujian as $rujian){
										$keterangan = $keterangan.'<li>'.$rujian->namaujian.'</li>';
									}
									$keterangan = $keterangan.'</ol>';
								}
								Banksoal::where('id', $idsoal)->update([
									'deskripsitambahan'	=> $keterangan
								]);
								echo '<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-check"></i> Sucess.!</h4>
										Case Added to '.$cekid->namaujian.' ( '.$cekid->tipe.' )
									</div>';
							} else {
								echo '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-ban"></i> Error</h4>
										System Error, Please Try Again in a few minutes
									</div>';
							}
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Case ID =>, '.$idsoal.' Already Set
							</div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Error, '.$marking.' Marking Not Valid
							</div>';	
					}
				} else {
					$cekid 	= Banksoaltest::where('marking', $marking)->first();
					if (isset($cekid->id)){
						$cekwes = Banksoaltest::where('marking', $marking)->count();
						if ($cekwes == 1){
							$update = Banksoaltest::where('marking', $marking)->where('idsoal', $idsoal)->update([
								'idsoal'	=> 0,
								'kode'		=> ''
							]);
						} else {
							$update = Banksoaltest::where('marking', $marking)->where('idsoal', $idsoal)->delete();
						}
						if ($update){
							$keterangan	= '';
							$getujian	= Banksoaltest::where('idsoal', $idsoal)->groupBy('marking')->get();
							if (!empty($getujian)){
								$keterangan = '<ol>';
								foreach ($getujian as $rujian){
									$keterangan = $keterangan.'<li>'.$rujian->namaujian.'</li>';
								}
								$keterangan = $keterangan.'</ol>';
							}
							Banksoal::where('id', $idsoal)->update([
								'deskripsitambahan'	=> $keterangan
							]);
							echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Sucess.!</h4>
									Case Remove From '.$cekid->namaujian.' ( '.$cekid->tipe.' )
								</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error</h4>
									System Error, Please Try Again in a few minutes
								</div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Error, '.$marking.' Marking Not Valid
							</div>';	
					}
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error</h4>
						Error, '.$idsoal.' ID Not Valid
					</div>';	
			}
		}
	}
	public function jsonallInterviewer(Request $request) {
		$arrayiuser		= [];
		$homebase		= url("/");
		$totaldata  	= 0;
        $pagenum  		= 0;
        $filterscount  	= 0;
        $limit         	= 10;
		$tabel         	= '';
		$marking        = '';
		$sortdatafield	= 'id';
		$sortorder		= 'DESC';
		$tahun 			= date('Y');
        $limit      	= ($request->input('pagesize') == null ? $limit : $request->input('pagesize'));
		$pagenum    	= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  	= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  = ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  	= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
		$tahun  		= ($request->input('tahun') == null ? $tahun : $request->input('tahun'));
		$marking  		= ($request->input('marking') == null ? $marking : $request->input('marking'));
		$tabel  		= ($request->input('tabel') == null ? $tabel : $request->input('tabel'));
		if ($tabel == 'Aktif' OR $tabel == 'Arsip'){
			$data 		= Banksoalujian::where('marking', $marking)->where('status', '!=', '3')->groupBy('idmahasiswa');
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'nama_lengkap'){ $filterdatafield = 'namapeserta'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			if ($sortdatafield == 'nama_lengkap'){ $sortdatafield = 'namapeserta'; }
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $rows){
					$idmahasiswa	= $rows->idmahasiswa;
					$nama_lengkap	= $rows->namapeserta;
					$unit_kerja		= $rows->asalpeserta;
					$status			= '';
					$keterangan		= '';
					$getfakultas 	= Simpegpegawai::where('id', $idmahasiswa)->first();
					if (isset($getfakultas->id)){
						$id 		= $getfakultas->id;
						$foto		= $getfakultas->foto;
						$unit_kerja	= $getfakultas->unit_kerja;
					} else {
						$foto		= '';
						$id 		= $idmahasiswa;
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
					$pgskore 	= 0;
					$esaiskore 	= 0;
					$oral01 	= '';
					$oral02 	= '';
					$oral03 	= '';
					$oral04 	= '';
					$oral05 	= '';
					if ($tabel == 'Aktif'){
						$pgskore 		= 0;
						$esaiskore 		= 0;
						$pembagiesai 	= 0;
						
						$getallujian 	= Banksoalujian::where('idmahasiswa', $idmahasiswa)->where('status', '1')->get();
						if (!empty($getallujian)){
							foreach($getallujian as $rhitung){
								$markingcari 	= $rhitung->marking;
								$tipe 			= $rhitung->tipe;
								if ($tipe == '' OR is_null($tipe)){
									$caritipe 	= Banksoal::where('id', $rhitung->idsoal)->first();
									if (isset($caritipe->jawaban)){
										$tipe 		= $caritipe->jawaban;
										Banksoalujian::where('id', $rhitung->id)->update([
											'tipe'	=> $tipe,
										]);
									}
								}
								if ($tipe == 'choice'){ $pgskore = $pgskore + $rhitung->skore; }
								if ($tipe == 'esay'){
									if ($rhitung->skore == '' OR is_null($rhitung->skore)){

									} else {
										$esaiskore = $esaiskore + $rhitung->skore;
										$pembagiesai++;
									}
								}
							}
						}
						$pembagi 	= 0;
						$nilai 		= 0;
						$keterangan	= '';
						$getallnilai = Pengumuman::where('jenis', 'Interview')->where('nim', $idmahasiswa)->get();
						if (!empty($getallnilai)){
							foreach($getallnilai as $rpengum){
								if ($rpengum->id_sekolah == '' OR $rpengum->id_sekolah == null OR $rpengum->id_sekolah == '0'){

								} else {
									$pembagi++;
									$nilai 		= $nilai + $rpengum->id_sekolah;
									if ($oral01 == ''){ $oral01 = $rpengum->id_sekolah; }
									else if ($oral02 == ''){ $oral02 = $rpengum->id_sekolah; }
									else if ($oral03 == ''){ $oral03 = $rpengum->id_sekolah; }
									else if ($oral04 == ''){ $oral04 = $rpengum->id_sekolah; }
									else { $oral05 = $rpengum->id_sekolah; }
									$keterangan	= $keterangan.'Nilai Dari '.$rpengum->siapa.' : '.$rpengum->id_sekolah.'; ';
								}
							}
						}
						if ($pembagi == 0){
							$rata = 0;
						} else {
							$rata = round(($nilai/$pembagi), 2);
						}
						if ($pembagiesai == 0){
						} else {
							$esaiskore = round(($esaiskore/$pembagiesai), 2);
						}
						$status = (($pgskore * 0.3) + ($esaiskore * 0.2) + ($rata * 0.5));
						$status = round($status, 2);
						if ($status != 0){
							Simpegpegawai::where('id', $id)->update([
								'usia'			=> $status,
								'keterangan'	=> $keterangan.'; Skore PG = '.$pgskore.' (0.3); Skore Esai : '.$esaiskore.' (0.2) '
							]);
						}
						Banksoalujian::where('idmahasiswa', $idmahasiswa)->where('status', '1')->update([
							'pgskore'		=> $pgskore,
							'esaiskore'		=> $esaiskore,
							'lisanskore'	=> $rata,
							'bobotpg'		=> 30,
							'bobotesai'		=> 20,
							'bobotlisan'	=> 50,
						]);
					} else if ($tabel == 'Arsip'){
						$pgskore 		= $rows->pgskore;
						$esaiskore 		= $rows->esaiskore;
						$status 		= $rows->lisanskore;
					} else {
						$jumlah1 		= 0;
						$jumlah2 		= 0;
						$pembagiesai 	= 0;
						$hitungjson		= Banksoalujian::where('idmahasiswa', $idmahasiswa)->where('marking', $tabel)->get();
						if (!empty($hitungjson)){
							foreach ($hitungjson as $rhitung){
								$tipe 	= $rhitung->tipe;
								if ($tipe == '' OR is_null($tipe)){
									$caritipe 	= Banksoal::where('id', $rhitung->idsoal)->first();
									if (isset($caritipe->jawaban)){
										$tipe 		= $caritipe->jawaban;
										Banksoalujian::where('id', $rhitung->id)->update([
											'tipe'	=> $tipe,
										]);
									}
								}
								if ($tipe == 'choice'){ $jumlah1 = $jumlah1 + $rhitung->skore; }
								if ($tipe == 'esai'){
									if ($rhitung->skore == '' OR is_null($rhitung->skore)){

									} else {
										$jumlah2 = $jumlah2 + $rhitung->skore;
										$pembagiesai++;
									}
								}
							}
						}
						$pgskore 	= $jumlah1;
						$esaiskore 	= $jumlah2;
						$pembagi 	= 0;
						$nilai 		= 0;
						$keterangan	= '';
						$getallnilai = Pengumuman::where('jenis', 'Interview')->where('nim', $idmahasiswa)->get();
						if (!empty($getallnilai)){
							foreach($getallnilai as $rpengum){
								if ($rpengum->id_sekolah == '' OR $rpengum->id_sekolah == null OR $rpengum->id_sekolah == '0'){

								} else {
									$pembagi++;
									$nilai 		= $nilai + $rpengum->id_sekolah;
									if ($oral01 == ''){ $oral01 = $rpengum->id_sekolah; }
									else if ($oral02 == ''){ $oral02 = $rpengum->id_sekolah; }
									else if ($oral03 == ''){ $oral03 = $rpengum->id_sekolah; }
									else if ($oral04 == ''){ $oral04 = $rpengum->id_sekolah; }
									else { $oral05 = $rpengum->id_sekolah; }
									$keterangan	= $keterangan.'Nilai Dari '.$rpengum->siapa.' : '.$rpengum->id_sekolah.'; ';
								}
							}
						}
						if ($pembagi == 0){
							$rata = 0;
						} else {
							$rata = round(($nilai/$pembagi), 2);
						}
						$status = (($pgskore * 0.3) + ($esaiskore * 0.2) + ($rata * 0.5));
						$status = round($status, 2);
						if ($status != 0){
							Simpegpegawai::where('id', $id)->update([
								'usia'			=> $status,
								'keterangan'	=> $keterangan.'; Skore PG = '.$pgskore.' (0.3); Skore Esai : '.$esaiskore.' (0.2) '
							]);
						}
					}
					$arrayiuser[] = array(
						'id' 			=> $id,
						'nama_lengkap' 	=> $rows->namapeserta,
						'unit_kerja' 	=> $unit_kerja,
						'email' 		=> $rows->nomorpeserta,
						'status' 		=> $status,
						'keterangan' 	=> $keterangan,
						'foto' 			=> $foto,
						'fotourl' 		=> '<img src="'.$foto.'" height="35" />',
						'pgskore' 		=> $pgskore,
						'esaiskore' 	=> $esaiskore,
						'oral01' 		=> $oral01,
						'oral02' 		=> $oral02,
						'oral03' 		=> $oral03,
						'oral04' 		=> $oral04,
						'oral05' 		=> $oral05,
						'marking' 		=> $marking,
					);
				}
			}
		} else {
			$data 		= Simpegpegawai::where('jenispeg', 'warga');
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			} else {
				$data 					= $data->where('created_at', 'LIKE', $tahun.'%');
				
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $rows){
					$id				= $rows->id;
					$nama_lengkap	= $rows->nama_lengkap;
					$foto			= $rows->foto;
					$status			= $rows->usia;
					$keterangan		= $rows->keterangan;
					if ($foto != ''){
						if (File::exists(public_path() ."/images/pegawai/". $foto)) {
							$foto = url("/").'/images/pegawai/'.$foto;
						} else {
							$foto = url("/").'/mascot.png';
						}
					} else {
						$foto = url("/").'/mascot.png';
					}
					$pgskore 	= 0;
					$esaiskore 	= 0;
					$oral01 	= '';
					$oral02 	= '';
					$oral03 	= '';
					$oral04 	= '';
					$oral05 	= '';
					$ceksudah = Pengumuman::where('jenis', 'Interview')->where('siapa', Session('email'))->where('nim', $id)->first();
					if (isset($ceksudah->id)){
						$status 	= $ceksudah->id_sekolah;
						$keterangan	= $ceksudah->pengumuman;
					} else {
						$status			= '';
						$keterangan		= '';
						Pengumuman::create([
							'jenis'		=> 'Interview',
							'siapa'		=> Session('email'),
							'nim'		=> $id,
							'pengumuman'=> '',
							'tanggal'	=> '',
							'kapan'		=> '',
							'id_sekolah'=> 0
						]);
					}
					$arrayiuser[] = array(
						'id' 			=> $rows->id,
						'nama_lengkap' 	=> $rows->nama_lengkap,
						'unit_kerja' 	=> $rows->unit_kerja,
						'status' 		=> $status,
						'keterangan' 	=> $keterangan,
						'email' 		=> $rows->email,
						'foto' 			=> $foto,
						'fotourl' 		=> '<img src="'.$foto.'" height="35" />',
						'pgskore' 		=> $pgskore,
						'esaiskore' 	=> $esaiskore,
						'oral01' 		=> $oral01,
						'oral02' 		=> $oral02,
						'oral03' 		=> $oral03,
						'oral04' 		=> $oral04,
						'oral05' 		=> $oral05,
					);
				}
			}
		}
		$response = [
            'message'   => 'List Laporan',
            'data'      => $arrayiuser,
            'total'     => $totaldata
        ];
        return response()->json($response, 200);
    }
	//untuk_rekrutmen
	public function exSetSoalProdi(Request $request) {
		$id   		= $request->input('val01');
        $idsoal   	= $request->input('val02');
        $jenis   	= $request->input('val03');
		$pesan		= 'Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
		$eksek		= null;
        if ($jenis == 'remove'){
			$getdata 	= Banksoaltest::where('id', $id)->first();
			$cekada		= Banksoalujian::where('idsoal', $getdata->idsoal)->where('namaujian', $getdata->namaujian)->orderBy('urutan', 'ASC')->count();
			if ($cekada == 0){
				$eksek 	= Banksoaltest::where('id', $id)->delete();
				$pesan 	= 'Remove Soal Berhasil di lakukan';	
			} else {
				$pesan 	= 'Remove Soal Gagal, Soal ini telah di kerjakan';	
			}	
		} else {
			$ceksek = Banksoaltest::where('idsoal', $idsoal)->where('namaujian', $id)->count();
			if ($ceksek == 0){
				$rows = Banksoal::where('id', $idsoal)->first();
				if (isset($rows->id)){
					$eksek = Banksoaltest::create([
						'ceel'			=> $rows->ceel,
						'kode'			=> $rows->kode,
						'namaujian'		=> $id,
						'supervisor'	=> Session('email'),
						'tipe'			=> $rows->jawaban,
						'idsoal'		=> $rows->id,
						'marking'		=> $rows->fullkode,
						'mulai'			=> date("Y-m-d"),
						'selesai'		=> date("Y-m-d"),
						'timer'			=> 120,
					]);
					$pesan = 'Import Soal Berhasil di lakukan';
				} else {
					$pesan = 'Import Soal Gagal, ID Tidak Valid';
				}
			} else {
				$pesan = 'Import Soal Gagal, Soal ini Sudah Ada';
			}
		}
		if ($eksek){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $pesan]);
			return back();
		} else { 
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
			return back();
		}
	}
	public function exStartUjianRekrutmen(){
		$homebase		= url("/");
		$id				= Session('iduser');
		if ($id == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			$getpeserta = Simpegpegawai::where('id', Session('iduser'))->first();
			if (isset($getpeserta->id)){
				$idpeserta 		= $getpeserta->id;
				$namapeserta	= $getpeserta->nama_lengkap;
				$nomorpeserta 	= $getpeserta->nip_baru;
				$asalpeserta 	= $getpeserta->prodihomebase;
				$idtest 		= $getpeserta->program_studi;
				$kode 			= $getpeserta->kode;
				$namaujian 		= $getpeserta->jenjanghomebase;
				
				if ($kode == '' OR is_null($kode)){
					$kode 		= $idpeserta.'-'.time();
				}
				$marking		= '';
				if ($getpeserta->status_pegawai == '' OR $getpeserta->status_pegawai == null){
					$tasks['sidebar'] 		= 'pengumumanverifikasi';
					$tasks['kalimatheader'] = 'Mohon Maaf Info Verifikasi Berkas Belum Ada';
					$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Informasi Terkait Verifikasi Berkas Belum Siap, Informasi Terkait Verifikasi Berkas Ini Akan Kami Infokan Kembali Melalui Email Terdaftar Bapak/Ibu atau melalui laman ini.<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
					return view('errors.notready', $tasks);
				} else if ($getpeserta->status_pegawai == 'Terverifikasi' OR $getpeserta->status_pegawai == 'Diterima'){
					$timer 		= 30;
					$tanggal 	= date("Y-m-d");
					$mulai		= date("Y-m-d H:i:s");
					$mulai		= strtotime($mulai);
					$tambah		= ' + 2100 second';
					$akhir		= date('Y-m-d H:i:s',strtotime($tambah,$mulai));
					$urutan		= 0;
					$jumlah		= 0;
					$ceksudah 	= User::where('username', Session('username'))->first();
					if (isset($ceksudah->smt)){
						$smt 	= $ceksudah->smt;
					} else {
						$smt 	= '';
					}
					$getdatasetting = Setting::where('ppabp', $getpeserta->program_studi)->where('jenis', 'ujiankompetensi')->first();
					if (isset($getdatasetting->id)){
						$ceel 		= $getdatasetting->sekolah;
					} else { $ceel = ''; }
					
					if ($smt == '' OR is_null($smt)){
						$marking	= $idpeserta.'-'.$idtest;
						$getujian 	= Banksoal::where('ceel', $ceel)->where('active', '1')->get();
						if (!empty($getujian)){
							foreach ($getujian as $ceksek){
								$urutan++;
								$ceel = $ceksek->ceel;
								$kode = $ceksek->kode;
								$tipe = $ceksek->jawaban;
								$sudahkah = Banksoaltest::where('marking', $marking)->where('idsoal', $ceksek->id)->count();
								if ($sudahkah == 0){
									Banksoaltest::create([
										'ceel'			=> $ceel,
										'kode'			=> $kode,
										'namaujian'		=> $namaujian,
										'supervisor'	=> null,
										'tipe'			=> $ceksek->jawaban,
										'idsoal'		=> $ceksek->id,
										'status'		=> 1,
										'pengumuman'	=> 0,
										'mulai'			=> date("Y-m-d H:i:s"),
										'selesai'		=> $akhir,
										'timer'			=> $timer,
										'marking'		=> $marking,
										'created_by'	=> Session('email')
									]);
								}
								
								$jumlah++;
							}
						}
					} else {
						$jumlah 	= 1;
					}
					if ($jumlah != 0){
						User::where('email', $getdatasetting->email)->update([
							'smt' 	=> $marking
						]);
						return redirect('ujiankompetensi');
					} else {
						$tasks['judulpesan']	= 'Unkown Error';
						$tasks['kalimatheader']	= 'Ujian Gagal di Generate '.$ceel.'/'.$smt;
						$tasks['kalimatbody'] 	= 'Mohon Maaf, Sistem Gagal Generate Soal Ujian. Ulangi Beberapa Saat Lagi<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
						return view('errors.notready', $tasks);
					}
				} else {
					$tasks['judulpesan']	= 'Restricted Area';
					$tasks['kalimatheader']	= 'ID Tidak Valid';
					$tasks['kalimatbody'] 	= 'Yth. Bapak/Ibu Pelamar<br />Berkas - berkas bapak ibu telah kami periksa dengan catatan sebagai berikut : <br />'.$hasil->status_pegawai.'<p></p><a href="/profiluser" class="btn btn-primary">Kembali Ke Profil</a>';
					return view('errors.notready', $tasks);
				}
			} else {
				$tasks['judulpesan']	= 'Unkown Error';
				$tasks['kalimatheader']	= 'Mohon Relogin';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.Session('iduser').' Tidak Di Temukan';
				return view('errors.notready', $tasks);
					
			}
		}
	}
}
