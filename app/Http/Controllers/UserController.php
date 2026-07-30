<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Http\Controllers\SendMail;
use App\Http\Controllers\Sco\NotifikasiController;
use App\Sekolah;
use App\User;
use App\Pejabatsurat;
use App\Histories;
use App\Simpegpegawai;
use App\Filess;
use App\Detailpegawai;
use App\Dataindukstaff;
use App\Datainduk;
use App\Penerimasurat;
use App\WebinarEventlist;
use App\Suratmasuk;
use App\Suratkeluar;
use App\Suratkeluartnpnomor;
use App\Inboxsurat;
use App\Models\Tabelskdanperaturan;
use App\Models\Draftsk;

use App\Models\Golongan;
use App\Models\Kelompoklain;
use App\Models\KLasifikasikepakaran;
use App\Models\Detailpendidikan;
use App\Models\Detaildiklat;
use App\Models\Detailsertifikat;
use App\Models\Detailasesor;
use App\Models\Detailorganisasi;
use App\Models\Detailseminar;
use App\Models\Detailanggotakeluarga;
use App\Models\Detailmutasi;
use App\Models\Detailidentitas;
use App\Models\Detailpangkat;
use App\Models\Detailfungsional;
use App\Models\Detailsertifikasi;
use App\Models\Detailgaji;
use App\Models\Detailpenghargaan;
use App\Models\MasterPS;
use App\Models\Templateskpp;
use Carbon\Carbon;
use Gufy\PdfToHtml\Html;
use Gufy\PdfToHtml\Pdf;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Tcpdf\Fpdi;
use simplehtmldom\HtmlWeb;
use Validator;
use Session;
use QrCode;
use Auth;
use Hash;
use DateTime;
use FeedReader;
use Redirect;
use PDFCREATOR;
use Browser;

class UserController extends Controller
{
	public function viewUser() {
		$data   				= [];
		$iduser					= Session('id');
		$getdatauser			= User::where('id', $iduser)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		$data['datauser']		= $getdatauser;
		$data['jpegawai']		= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->get();
		$data['tahunne']		= date("Y");
		$data['tanggal']		= date("Y-m-d");
		
		if (Session('previlage') == 'level1' OR Session('previlage') == 'adminzis'){
			$data['sidebar']	= 'useranyar';
			return view('simaster.useranyar', $data);
		} else {
			$data['sidebar']	= 'profile';
			return view('profile', $data);
		}
    }
	public function viewProfile() {
		$data   				= [];
		$iduser					= Session('id');
		$getdatauser			= User::where('id', $iduser)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		$data['datauser']		= $getdatauser;
		$data['tahunne']		= date("Y");
		$data['tanggal']		= date("Y-m-d");
		$data['sidebar']		= 'profile';
    	return view('profile', $data);
    }
	public function getAllusername() {
		$arrrekap 	= [];
		if (Session('previlage') == 'adminzis'){
			$getallthn 	= User::where('previlage', 'adminzis')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		} else if (Session('previlage') == 'ortu'){
			$getallthn 	= User::where('previlage', 'ortu')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		} else {
			if (Session('username') == 'admin'){
				$getallthn 	= User::all();
			} else {
				if (session('sekolah_id_sekolah') !== null AND session('sekolah_id_sekolah') != '0'){
					$getallthn 	= User::where('previlage', '!=', 'level0')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				} else {
					$getallthn 	= User::where('fakultas', Session('fakultas'))->get();
				}
			}
		}
		echo json_encode($getallthn);
	}
	public function exUsername(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'val01' =>  'required',
			'val02' =>  'required',
			'val04' =>  'required',
        ]);
        if($validator->fails()) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Semua Form Wajib Terisi']);
			return back();
        } else {
			$idne 		= $request->input('val01');
			$nama 		= $request->input('val02');
			$password	= $request->input('val03');
			$username	= $request->input('val04');
			$password2	= $request->input('val05');
			$level		= $request->input('val06');
			if ($username == 'hapus'){
				$cekuser 	= User::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Penghapusan Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
				return back();
				
			} else if ($username == 'paguyuban'){
				$cekuser 	= User::where('id', $idne)->first();
				if (isset($cekuser->id)){
					$spesial 	= $cekuser->spesial;
					if ($spesial == '' OR is_null($spesial)){
						$spesial = 'paguyuban';
					} else {
						$spesial = '';
					}
					$update 	= User::where('id', $idne)->update([
						'spesial'	=> $spesial
					]);
					if ($update){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Update Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ada yg diubah']);
						return back(); 	
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ditemukan']);
					return back();
				}
			} else if ($username == 'lupa'){
				$cekuser 	= User::where('id', $idne)->first();
				if (isset($cekuser->id)){
					$update = User::where('id', $idne)->update([
						'status'	=> 2
					]);
					if ($update){
						SendMail::kirim($cekuser->nama,$cekuser->email);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Link Password an. '.$nama.' Dengan Username '.$username.' Sukses di kirim ke email']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ada yg diubah']);
						return back(); 	
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ditemukan']);
					return back();
				}
			} else {
				if ($password == '' OR $username == '' OR $nama == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Semua Form Wajib di Isi']);
					return back(); 
				} else if ($password != $password2){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Password Pertama dan Kedua Tidak Cocok']);
					return back(); 
				} else {
					$getnama 	= Dataindukstaff::where('niy', $nama)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($getnama->nama)){
						$niy 	= $nama;
						$nama 	= $getnama->nama;						
					} else {
						$niy 	= '123456789';
					}
					if ($idne == 'new'){
						$cekuser 	= User::where('username', $username)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					} else {
						$cekuser 	= User::where('username', $username)->where('id', '!=', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					}
					if ($cekuser == 0){
						if ($idne == 'new'){
							if (Session('previlage') == 'level1'){
								$user = User::create([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'previlage' 	=> 	$level,
									'nip' 			=> 	$niy,
									'fakultas' 		=>  config('global.singkatan'),
									'fakpanjang' 	=>  config('global.sekolah'),
									'id_sekolah'	=>  Session('sekolah_id_sekolah')
									]);
									return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pendaftaran Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
									return back();
							} else if (Session('previlage') == 'adminzis'){
									$user = User::create([
										'nama'      	=>  $nama,
										'username' 		=>  $username,
										'password' 		=>  bcrypt($password),
										'previlage' 	=> 	'adminzis',
										'nip' 			=> 	$niy,
										'fakultas' 		=>  config('global.singkatan'),
										'fakpanjang' 	=>  config('global.sekolah'),
										'id_sekolah'	=>  Session('sekolah_id_sekolah')
										]);
										return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pendaftaran Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Anda Tidak Berhak Menambahkan Akun']);
								return back();
							}
						} else {
							if (Session('previlage') == 'level1'){
								User::where('id', $idne)->update([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'previlage' 	=> 	$level,
									'nip' 			=> 	$niy,
								]);
							} else {
								User::where('id', $idne)->update([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'nip' 			=> 	$niy,
								]);
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pendaftaran Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Ubah']);
							return back();
						}						
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Username telah digunakan, silahkan gunakan username yang lain.']);
						return back(); 
					}
				}
			}
        }
    }
	public function exDaftarortu(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'nama' 		=>  'required',
			'set01' 	=>  'required',
			'set02' 	=>  'required',
			'set03' 	=>  'required',
			'id_sekolah'=>  'required',
        ]);
		if($validator->fails()) {
			return response(['status' => true, 'icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Form Wajib (Nama, Email, Password) Tidak Boleh Kosong']);
		} else {
			$email 		= $request->input('set01');
			$pass1 		= $request->input('set02');
			$pass2		= $request->input('set03');
			$noinduk1	= $request->input('set04');
			$noinduk2	= $request->input('set05');
			$noinduk3	= $request->input('set06');
			$noinduk4	= $request->input('set07');
			$noinduk5	= $request->input('set08');
			$noinduk6	= $request->input('set09');
			$ttl1		= $request->input('set10');
			$ttl2		= $request->input('set11');
			$ttl3		= $request->input('set12');
			$ttl4		= $request->input('set13');
			$ttl5		= $request->input('set14');
			$ttl6		= $request->input('set15');
			$nama		= $request->input('nama');
			$boleh 		= 0;
			if ($noinduk1 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk1)->where('tgllahir', $ttl1)->count();
			}
			if ($noinduk2 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk2)->where('tgllahir', $ttl2)->count();
			}
			if ($noinduk3 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk3)->where('tgllahir', $ttl3)->count();
			}
			if ($noinduk4 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk4)->where('tgllahir', $ttl4)->count();
			}
			if ($noinduk5 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk5)->where('tgllahir', $ttl5)->count();
			}
			if ($noinduk6 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk6)->where('tgllahir', $ttl6)->count();
			}
			if ($boleh == 0){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon masukkan Noinduk dan Tanggal Lahir anak anda dengan benar.'], 500);
			} else if ($pass1 != $pass2){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Password Pertama dan Kedua Tidak Cocok'], 500);
			} else {
				$sql 		= Sekolah::find($request->input('id_sekolah'));
				$cekuser 	= User::where('username', $email)->count();
				if ($cekuser == 0 AND isset($sql->id)){
					$getid 	= User::orderBy('id', 'DESC')->first();
					$idne 	= $getid->id;
					$idne 	= $idne + 1;
					try {
						$input 	= User::create([
							'id'			=> 	$idne,
							'nama'      	=>  $nama,
							'username' 		=>  $email,
							'password' 		=>  bcrypt($pass1),
							'previlage' 	=> 	'ortu',
							'nip' 			=> 	$idne,
							'fakultas' 		=>  $sql->nama_sekolah,
							'fakpanjang' 	=>  $sql->nama_yayasan,
							'email' 		=>  $email,
							'status'		=> 	1,
							'merangkap' 	=> 	'',
							'id_sekolah'	=>  $request->input('id_sekolah'),
							'firebaseid'	=>  $request->input('firebaseid'),
						]);
						if ($input){
							$pesan = '';
							if ($noinduk1 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk1)->where('tgllahir', $ttl1)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk1)->where('tgllahir', $ttl1)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk1.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk2 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk2)->where('tgllahir', $ttl2)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk2)->where('tgllahir', $ttl2)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk2.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk3 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk3)->where('tgllahir', $ttl3)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk3)->where('tgllahir', $ttl3)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk3.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk4 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk4)->where('tgllahir', $ttl4)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk4)->where('tgllahir', $ttl4)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk4.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk5 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk5)->where('tgllahir', $ttl5)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk5)->where('tgllahir', $ttl5)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk5.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk6 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk6)->where('tgllahir', $ttl6)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk6)->where('tgllahir', $ttl6)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk6.' Telah terhubung dengan akun anda<br />';
								}
							}
							$getnotif 	= User::where('fakultas', $sql->nama_sekolah)->orWhere('username', 'admin')->get();
							$tuliskirim = 'Mari Sambut Saudara '.$nama.' Yang Hari Ini Bergabung';
							foreach ( $getnotif as $rtokencari ){
								$firebaseid = $rtokencari->firebaseid;
								if ($firebaseid != '' AND !is_null($firebaseid)){
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
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Pendaftaran Sukses, silahkan anda login.<br />'.$pesan], 200);
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database error, silahkan coba beberapa saat lagi'], 500);
						}
					} catch (\Exception $e) {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $e->getMessage()], 500);
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email sudah terdaftar, silahkan gunakan email lain atau gunakan fasilitas recovery password atau hubungi tim TI untuk reset password'], 200);
				}
			}
        }
    }
	public function exProfileupdate(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'val01' =>  'required',
			'val02' =>  'required',
			'val03' =>  'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi']);
			return back();
        } else {
			$nip 		= $request->input('val01');
			$gol 		= $request->input('val02');
			$email		= $request->input('val03');
			$username	= $request->input('val08');
			$pass1		= $request->input('val09');
			$pass2		= $request->input('val10');
			$nama		= $request->input('val11');
			$nip 		= preg_replace('/\s+/', '', $nip);
			$cekttd		= $request->input('val06');
			$cekparaf	= $request->input('val07');
			$idne		= Session('id');
			$getalldata = User::where('id', $idne)->first();
			$idpeg		= $getalldata->id;
			$jabatan	= $getalldata->previlage;
			$fakultas	= $getalldata->fakultas;
			$fakpanjang	= $getalldata->fakpanjang;
			if ($cekttd == 'uploadttd'){
				if($request->hasFile('val04')) {
					$ImageExt	= $request->file('val04')->getClientOriginalExtension();
					$file_tmp	= $request->file('val04');
					$data 		= file_get_contents($file_tmp);
					$ttd 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
				} else {
					$ttd 		= '';
				}
			} else {
				$ttd		= $request->input('val04');
			}
			if ($cekparaf == 'uploadparaf'){
				if($request->hasFile('val05')) {
					$ImageExt	= $request->file('val05')->getClientOriginalExtension();
					$file_tmp2	= $request->file('val05');
					$data2 		= file_get_contents($file_tmp2);
					$paraf 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data2);
				} else {
					$paraf 		= '';
				}
			} else {
				$paraf		= $request->input('val05');
			}
			if ($ttd != ''){
				User::where('id', $idne)->update([
					'tandatangan'	=> $ttd,
				]);
			}
			if ($paraf != ''){
				User::where('id', $idne)->update([
					'paraf'			=> $paraf
				]);
			}
			$bolehganti = 'YES';
			if ($username != ''){
				$cekuser 	= User::where('username', $username)->where('id', '!=', $idne)->count();
				if ($cekuser == 0){
					$bolehganti = 'YES';
				} else {
					$bolehganti = 'NO';
				}
			} else {
				$bolehganti = 'NO';
			}
			if ($bolehganti == 'YES'){
				if ($pass1 != ''){
					if ($pass1 == $pass2){
						$bolehganti = 'YES';
					} else {
						$bolehganti = 'NO';
					}
				} else {
					$bolehganti = 'NO';
				}
			}
			if ($nama == ''){
				$bolehganti == 'NO';
			}
			if ($bolehganti == 'NO'){
				return response()->json(['status' => 'error', 'message' => 'Nama, Username dan Password Anda Belum di isi']);
				return back();
			} else {
				User::where('id', $idne)->update([
					'nama' 			=> $nama,
					'username' 		=> $username,
					'password' 		=> bcrypt($pass1),
					'nip' 			=> $nip,
					'golongan' 		=> $gol,
					'email'			=> $email,
				]);
				$cekdata 	= User::where('id', $idne)->first();
				$nama 		= $cekdata->nama;
				$nip 		= $cekdata->nip;
				$golongan	= $cekdata->golongan;
				$email		= $cekdata->email;
				$tandatangan= $cekdata->tandatangan;
				$paraf		= $cekdata->paraf;
				if ($nip == ''){
					return response()->json(['status' => 'error', 'message' => 'NIP Anda Belum di isi']);
					return back();
				} else if ($email == ''){
					return response()->json(['status' => 'error', 'message' => 'Email Anda Belum di isi']);
					return back();
				} else {
					return response()->json(['status' => 'Success.!', 'message' => 'Update Data Induk Sukses']);
					return back();
				}
			}
        }
    }
	public function viewUserAdmin(){
		$homebase	= url("/");
		$data		= [];
		$id			= Session('iduser');
		$previlage	= Session('previlage');
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid= DB::table('app_menu')->where('domain', $domain)->first();
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
			$data['logofrontapps04']  	= $getdomainid->logofrontapps;
			$data['lamanportal']		= $lamanportal;
		} else {
			$data['namaapps01']  		= Session('namaapps01');
			$data['domainapps01']  		= Session('domainapps01');
			$data['subdomainapps01']  	= Session('subdomainapps01');
			$data['subsubdomainapps01'] = Session('subsubdomainapps01');
			$data['addressapps01']  	= Session('addressapps01');
			$data['emailapps01']  		= Session('emailapps01');
			$data['lamanapps01']  		= Session('lamanapps01');
			$data['kota01']				= Session('kota01');
			$data['lamanportal']		= $domain;
			$data['logofrontapps01']  	= Session('logofrontapps01');
			$data['logofrontapps04']  	= Session('logofrontapps01');
		}
			$data['firebaseid']			= '';
		if (Session('previlage') == null){
			return redirect('/');
		} else {
			if ($previlage == 'administarator' OR $previlage == 'administrasi' OR $previlage == 'Operator' OR $previlage == 'Admin SDM'  OR $previlage == 'PEJABAT'){
				$data['firebaseid']	= '';
				$data['pejabat']  		= Pejabatsurat::where('fakultas', Session('fakultas'))->get();
				$data['kelompoklain']  	= Kelompoklain::where('fakultas', Session('fakultas'))->get();
				if (Session('id') == '2'){
					return view('admin.usersadminkhusus', $data);
				} else {
					return view('admin.usersadmin', $data);
				}
			} else {
				return redirect('/profiluser');
			}
		}
	}
	public function viewUserAdminArgonThem(){
		$homebase	= url("/");
		$data		= [];
		$id			= Session('iduser');
		$previlage	= Session('previlage');
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid= DB::table('app_menu')->where('domain', $domain)->first();
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
			$data['logofrontapps04']  	= $getdomainid->logofrontapps;
			$data['lamanportal']		= $lamanportal;
		} else {
			$data['namaapps01']  		= Session('namaapps01');
			$data['domainapps01']  		= Session('domainapps01');
			$data['subdomainapps01']  	= Session('subdomainapps01');
			$data['subsubdomainapps01'] = Session('subsubdomainapps01');
			$data['addressapps01']  	= Session('addressapps01');
			$data['emailapps01']  		= Session('emailapps01');
			$data['lamanapps01']  		= Session('lamanapps01');
			$data['kota01']				= Session('kota01');
			$data['lamanportal']		= $domain;
			$data['logofrontapps01']  	= Session('logofrontapps01');
			$data['logofrontapps04']  	= Session('logofrontapps01');
		}
			$data['firebaseid']			= '';
		if (Session('previlage') == null){
			return redirect('/');
		} else {
			if ($previlage == 'administarator' OR $previlage == 'administrasi' OR $previlage == 'Operator' OR $previlage == 'Admin SDM'){
				$data['firebaseid']	= '';
				$data['pejabat']  		= Pejabatsurat::where('fakultas', Session('fakultas'))->get();
				$data['kelompoklain']  	= Kelompoklain::where('fakultas', Session('fakultas'))->get();
				if (Session('id') == '2'){
					//return view('admin.usersadminkhusus', $data);
					return view('argon.auth.useradmin', $data);
				} else {
					return view('argon.auth.useradmin', $data);
				}
			} else {
				return redirect('/argonprofil');
			}
		}
	}
	public function dataUserAll(Request $request) {
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$arrayinbox 	= [];
		$previlage		= Session('previlage');
		$jenispeg   	= $request->input('jenispeg');
        $nama_lengkap   = $request->input('nama_lengkap');
        $nik   			= $request->input('nik');
        $alamat    		= $request->input('alamat');
        $email   		= $request->input('email');
        $no_hp    		= $request->input('no_hp');
		$tmt_golongan   = $request->input('tmt_golongan');
		$thn_masuk    	= $request->input('thn_masuk');
        $homebase		= url("/");
		$totaldata  	= 0;
        $limit         	= 10;
        $limit      	= ($request->input('limit') == null ? $limit : $request->input('limit'));
		$order      	= ($request->input('order') == null ? 'nip_baru desc' : $request->input('order'));
        $ceksek 		= explode(" ", $order);
		if (Session('fakultas') == 'DPM' AND Session('previlage') == 'Admin SDM'){
			$data  		= Simpegpegawai::where('ppabp', '!=', 'Rekrutmen PT DPM');
		} elseif (Session('previlage') == 'PEJABAT' OR Session('previlage') == 'administarator' OR  Session('previlage') == 'Admin SDM'){
			$data  		= Simpegpegawai::where('ppabp', '!=', 'Rekrutmen PT DPM');
		} else {
			$data 	    = Simpegpegawai::where('id', Session('iduser'));
		}
		if (isset($ceksek[1])){
			$variabel 	= $ceksek[0];
			$urutan		= $ceksek[1];
			if ($variabel == 'undefined'){
				$variabel = 'id';
			}
			$order 		= $variabel.' '.$urutan;
		} else {
			$order 		= 'nip_baru DESC';
			
		}
		if ($nama_lengkap != null AND $nama_lengkap != '') $data = $data->where('nama_lengkap', 'LIKE', '%'.$nama_lengkap.'%');
        if ($jenispeg != null AND $jenispeg != '') $data = $data->where('jenispeg', 'LIKE', '%'.$jenispeg.'%');
        if ($nik != null AND $nik != '') $data = $data->where('nik', 'LIKE', '%'.$nik.'%');
        if ($alamat != null AND $alamat != '') $data = $data->where('alamat', 'LIKE', '%'.$alamat.'%');
        if ($no_hp != null AND $no_hp != '') $data = $data->where('no_hp', 'LIKE', '%'.$no_hp.'%');
        if ($email != null AND $email != '') $data = $data->where('email', 'LIKE', '%'.$email.'%');
		if ($tmt_golongan != null AND $tmt_golongan != '') $data = $data->where('tmt_golongan', 'LIKE', '%'.$tmt_golongan.'%');
		if ($thn_masuk != null AND $thn_masuk != '') $data = $data->where('thn_masuk', 'LIKE', '%'.$thn_masuk.'%');
		if ($email == '' AND $no_hp == '' AND $alamat == '' AND $nik == '' AND $jenispeg == '' AND $nama_lengkap == '') $data = $data->whereIn('status_pegawai', ['1', 'Aktif']);
        $data       	= $data->orderByRaw($order)->paginate($limit);
		$totaldata		= $data->total();
		if (!empty($data)){
			foreach ($data as $rpegawai){
				$ceksek		= Detailpegawai::where('no', $rpegawai->id)->count();
				if ($ceksek == 0){
					Detailpegawai::create([
						'no'			=> $rpegawai->id, 
						'ktp'			=> $rpegawai->nik, 
						'emaillain'		=> $rpegawai->email,
						'gelardepan2'	=> $rpegawai->depandinilai, 
						'gelarblakang2'	=> $rpegawai->belakangdinilai, 
						'gelardepan'	=> $rpegawai->depan,
						'gelarblakang'	=> $rpegawai->belakang,
						'bidangilmu'	=> $rpegawai->bidang_ilmu,
						'alamatmlg'		=> '', 
						'kelurahan'		=> '', 
						'kecamatan'		=> '', 
						'propinsi'		=> '', 
						'kota'			=> '', 
						'kawin'			=> '', 
						'emailub'		=> $rpegawai->email_ub,
						'skcpns'		=> '', 
						'tmtcpns'		=> '', 
						'skpns'			=> '', 
						'tmtpns'		=> '', 
						'nira'			=> '', 
						'npwp'			=> $rpegawai->npwp, 
						'bpjs'			=> '', 
						'bentukrambut'	=> $rpegawai->rambut,
						'bentukmuka'	=> $rpegawai->muka,
						'warnakulit'	=> $rpegawai->warnakulit,
						'cirikusus'		=> $rpegawai->cirikusus,
						'cacattubuh'	=> $rpegawai->cacattubuh,
						'hobi'			=> $rpegawai->hobi,
						'timestamp'		=> date('Y-m-d H:i')
					]);
				}
				if ($rpegawai->email == '' OR $rpegawai->email == '-' OR $rpegawai->email == null){
					$ceksek			= DB::table('temp_email')->where('nik', $rpegawai->nip_baru)->first();
					if (isset($ceksek->id)){
						Simpegpegawai::where('id', $rpegawai->id)->update([
							'email'	=> $ceksek->email
						]);
					} else {
						if ($rpegawai->email_ub == '' OR $rpegawai->email_ub == '-' OR $rpegawai->email_ub == null){
							$email = $rpegawai->id.'@'.$domain;
						} else { $email = $rpegawai->email_ub; }
						Simpegpegawai::where('id', $rpegawai->id)->update([
							'email'	=> $email
						]);
					}
				}
				$arrayinbox[] = array(
					'id'            		=> $rpegawai->id,
					'idpeg' 	    		=> $rpegawai->idpeg,	
					'jenispeg' 				=> $rpegawai->jenispeg,
					'fungsional' 			=> $rpegawai->fungsional,
					'nik' 					=> $rpegawai->nik,
					'nokk' 					=> $rpegawai->nokk,
					'nama_lengkap' 		 	=> $rpegawai->nama_lengkap,
					'nama' 					=> $rpegawai->nama,
					'depan'         		=> $rpegawai->depan,
					'belakang'      		=> $rpegawai->belakang,
					'depan2'        		=> $rpegawai->depandinilai,
					'belakang2'     		=> $rpegawai->belakangdinilai,
					'jenisnip' 				=> $rpegawai->jenisnip,
					'niplama' 				=> $rpegawai->nip_lama,
					'nip' 					=> $rpegawai->nip_baru,
					'nidn'          		=> $rpegawai->nidn,
					'kelamin' 				=> $rpegawai->jenis_kelamin,
					'tmpt_lahir'    		=> $rpegawai->tmpt_lahir,
					'tgllahir' 				=> $rpegawai->tgl_lahir,
					'usia'          		=> $rpegawai->usia,
					'pangkat'       		=> $rpegawai->pangkat,
					'golongan' 				=> $rpegawai->golongan,
					'namabank' 				=> $rpegawai->namabank,
					'norek' 				=> $rpegawai->norek,
					'namapdrek'     		=> $rpegawai->namapdrekening,
					'gajisesuaisk'  		=> $rpegawai->gajisesuaisk,
					'kategorigaji'  		=> $rpegawai->kategorigaji,
					'npwp' 					=> $rpegawai->npwp,
					'statusnpwp' 			=> $rpegawai->statusnpwp,
					'status' 				=> $rpegawai->status,
					'keterangan' 			=> $rpegawai->keterangan,
					'tmt_golongan'  		=> $rpegawai->tmt_golongan,
					'jabatan' 				=> $rpegawai->jabatan,
					'jabfungsional' 		=> $rpegawai->jab_fungsional,
					'tmt_fungsional' 		=> $rpegawai->tmt_fungsional,
					'tmt_pensiun'   		=> $rpegawai->tmt_pensiun,
					'thn_pensiun'   		=> $rpegawai->thn_pensiun,
					'cpns'      			=> $rpegawai->cpns,
					'tmt_cpns'      		=> $rpegawai->tmt_cpns,
					'pns'       			=> $rpegawai->pns,
					'tmt_pns'       		=> $rpegawai->tmt_pns,
					'thn_masuk'     		=> $rpegawai->thn_masuk,
					'unit_kerja'    		=> $rpegawai->unit_kerja,
					'bidang_ilmu'   		=> $rpegawai->bidang_ilmu,
					'lab'           		=> $rpegawai->lab,
					'program_studi' 		=> $rpegawai->program_studi,
					'sertifikasi'   		=> $rpegawai->sertifikasi,
					'pend_akhir'    		=> $rpegawai->pend_akhir,
					'ijasah_diakui' 		=> $rpegawai->ijasah_diakui,
					'status_pegawai' 		=> $rpegawai->status_pegawai,
					'status_jabatan' 		=> $rpegawai->status_jabatan,
					'karpeg'        		=> $rpegawai->karpeg,					
					'agama'         		=> $rpegawai->agama,
					'alamat' 				=> $rpegawai->alamat,
					'no_hp'         		=> $rpegawai->no_hp, 
					'kode'          		=> $rpegawai->kode,
					'foto' 					=> $rpegawai->foto,
					'tmtgaji'       		=> $rpegawai->tmtgaji,
					'tmtpangkat'    		=> $rpegawai->tmtpangkat,
					'angka_kredit'  		=> $rpegawai->angka_kredit,
					'email'      			=> $rpegawai->email,
					'lama_tubel'    		=> $rpegawai->lama_tubel,
					'lama_kenaikan_pangkat' => $rpegawai->lama_kenaikan_pangkat,
					'tmt_tubel'     		=> $rpegawai->lama_tubel,
					'idregptk'      		=> $rpegawai->idregptk,
					'tinggibdn'				=> $rpegawai->tinggibdn,
					'beratbdn'				=> $rpegawai->beratbdn,
					'rambut'				=> $rpegawai->rambut,
					'muka'					=> $rpegawai->muka,
					'warnakulit'			=> $rpegawai->warnakulit,
					'cirikusus'				=> $rpegawai->cirikusus,
					'cacattubuh'			=> $rpegawai->cacattubuh,
					'hobi'					=> $rpegawai->hobi,
				);
			}
		}
        $response = [
            'message'   => 'List Laporan',
            'previlage'	=> $previlage,
            'data'      => $arrayinbox,
            'total'     => $totaldata
        ];
        return response()->json($response, 200);
	}
	public function viewDataInduk(){
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		$homebase		= url("/");
		$data 			= [];
		$tasks			= [];
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$id			= Session('iduser');
		if (Session('id') !== null){
			$id			= Session('id');
		}
		if ($id == null){
            $tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
            if (Session('fakultas') == 'radiology' OR Session('fakultas') == 'Radiology Departement FKUB-RSSA') {
                $url = 'rad-portal';
				return Redirect::to($url);
            } else {
				$user  		 	= User::where('id', $id)->first();
				if (isset($user->id)){
					$idne 			= $user->id;
					$previlage 		= $user->previlage;
					$fakultas 		= $user->fakultas;
					$foto 			= $user->photo;
					$tandatangan 	= $user->tandatangan;
					if ($tandatangan == '' OR is_null($user->tandatangan)){
						$tandatangan = $homebase.'/boxed-bg.png';
					} else {
						if (File::exists(public_path().'/'.$tandatangan)) {
							$tandatangan = $homebase.'/'.$tandatangan;
						} else {
							$tandatangan = $homebase.'/boxed-bg.png';
						}
					}
					$jabatan 	= $previlage;
					$golekfoto	= Simpegpegawai::where('email', $user->email)->orWhere('email_ub', $user->email)->first();
					if (isset($golekfoto->id)){
						$iduser			= $golekfoto->id;
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
					} else {
						$iduser 	= Simpegpegawai::insertGetId([
							'idpeg'						=> $idne,
							'jenispeg'					=> $user->previlage,
							'fungsional'				=> '-',
							'nik'						=> $user->username, 
							'nokk'						=> '', 
							'nama_lengkap'				=> $user->nama, 
							'nama'						=> $user->nama,
							'depan'						=> '', 
							'belakang'					=> '',
							'depandinilai'				=> '',
							'belakangdinilai'			=> '',
							'jenisnip'					=> 'NIK',
							'nip_lama'					=> '',
							'nip_baru'					=> $idne.time(),
							'nidn'						=> '',
							'jenis_kelamin'				=> '',
							'tmpt_lahir'				=> '',
							'tgl_lahir'					=> '',
							'usia'						=> '',
							'pangkat'					=> '',
							'golongan'					=> '', 
							'namabank'					=> '', 
							'norek'						=> '', 
							'namapdrekening'			=> $user->nama,
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
							'keterangan'				=> 'New', 
							'tmt_golongan'				=> '',
							'tmt_fungsional'			=> '', 
							'jab_fungsional'			=> '',
							'tmt_pensiun'				=> '', 
							'thn_pensiun'				=> '', 
							'cpns'						=> '',
							'tmt_cpns'					=> '',
							'pns'						=> '',
							'tmt_pns'					=> '',
							'thn_masuk'					=> '',
							'unit_kerja'				=> $user->fakultas,
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
							'alamat'					=> $user->username,
							'no_hp'						=> $user->nik,
							'kode'						=> '', 
							'foto'						=> '',
							'tmtgaji'					=> '', 
							'tmtpangkat'				=> '', 
							'ppabp'						=> $user->fakpanjang, 
							'jabatan'					=> '',
							'proses_pangkat'			=> '', 
							'angka_kredit'				=> '', 
							'email'						=> $user->email,
							'lama_tubel'				=> '', 
							'lama_kenaikan_pangkat'		=> '', 
							'tmt_tubel'					=> ''
						]);
					}
					$ceksek		= Detailpegawai::where('no', $iduser)->count();
					if ($ceksek == 0){
						Detailpegawai::create([
							'no'			=> $iduser, 
							'ktp'			=> $user->username, 
							'emaillain'		=> $user->email,
							'gelardepan'	=> '', 
							'gelarblakang'	=> '', 
							'gelardepan2'	=> '', 
							'gelarblakang2'	=> '', 
							'bidangilmu'	=> '', 
							'alamatmlg'		=> '', 
							'kelurahan'		=> '', 
							'kecamatan'		=> '', 
							'propinsi'		=> '', 
							'kota'			=> '', 
							'kawin'			=> '', 
							'emailub'		=> '', 
							'emaillain'		=> '', 
							'skcpns'		=> '', 
							'tmtcpns'		=> '', 
							'skpns'			=> '', 
							'tmtpns'		=> '', 
							'nira'			=> '', 
							'npwp'			=> '', 
							'bpjs'			=> '', 
							'tinggibdn'		=> 0, 
							'beratbdn'		=> 0, 
							'bentukrambut'	=> '', 
							'bentukmuka'	=> '', 
							'warnakulit'	=> '', 
							'cirikusus'		=> '', 
							'cacattubuh'	=> '', 
							'hobi'			=> '', 
							'timestamp'		=> date('Y-m-d H:i')
						]);
					}
					$hasil		= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $iduser)->first();
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
						$thniki 						= (int)date("Y");
						$blniki 						= date("m");
						$thnlalu						= $thniki - 1;
						$thnakad						= $thnlalu.'/'.$thniki;
						if (Session('fakpanjang') == 'Sulawesi Barat'){
							$tasks['settings'] 			= TabelMaster::where('provinsi', Session('fakpanjang'))->get();
						}
						$tasks['tandatangan'] 			= $tandatangan;
						$tasks['foto'] 					= $foto;
						$tasks['thniki'] 				= $thniki;
						$tasks['thnakad'] 				= $thnakad;
						$tasks['tlsprodi'] 				= $tlsprodi;
						$tasks['tlsjabatan'] 			= $tlsjabatan;
						$tasks['biodata'] 				= $hasil;
						$tasks['sidebar'] 				= 'profiluser';
						if ($domain == 'rekrutmen.disaprimamedika.site' OR $domain == 'www.rekrutmen.disaprimamedika.site'){
							if ($programstudi == '' OR is_null($programstudi)){
								return view('rekrutmen.prodipick', $tasks);
							} else {
								$qklasif		= KLasifikasikepakaran::groupBy('kategori')->select('kategori')->orderBy('kategori', 'ASC')->get();
								$i				= 0;
								foreach ($qklasif as $rklasif) {
									$j  		= 0;
									$kategori	= $rklasif->kategori;
									$jklas  	= KLasifikasikepakaran::where('kategori', $kategori)->orderBy('kode', 'ASC')->get();
									foreach ($jklas as $rklas) {
										$kode 		= $rklas->kode;
										$tulispak 	= $rklas->kepakaran;
										$tulispak	= $kode.' - '.$tulispak;
										$tasks['klasifkepakaran'][$i][$j]['tulispak']	=   $tulispak;
										$tasks['klasifkepakaran'][$i][$j]['id']			=   $rklas->id;
										$j++;
									}
									$i++;
								}
								$x  			= 0;
								foreach ($qklasif as $rgklasif) {
									$tasks['klasifikasikepakaran'][$x]  =   $rgklasif->kategori;
									$x++;
								}
								
								$grouptombol = '<a href="'.$homebase.'/profiluser" class="btn btn-app bg-primary"><i class="fa fa-user"></i> Update Curiculum Vitae</a>
										<a href="'.$homebase.'/berkaspelamar" class="btn btn-app bg-grey"><i class="fa fa-arrow-circle-right"></i> Verifikasi Berkas</a>
										<a href="'.$homebase.'/pengumumanverifikasi" class="btn btn-app bg-grey"><i class="fa fa-arrow-circle-right"></i> Pengumuman Verifikasi</a>
										<a href="'.$homebase.'/teskompetensi" class="btn btn-app bg-grey"><i class="fa fa-arrow-circle-right"></i> Ujian Kompetensi</a>
										<a href="'.$homebase.'/pengumumanhasil" class="btn btn-app bg-grey"><i class="fa fa-arrow-circle-right"></i> Pengumuman Hasil Ujian</a>
										<a href="'.$homebase.'/wawancara" class="btn btn-app bg-grey"><i class="fa fa-arrow-circle-right"></i> Wawancara</a>
										<a href="'.$homebase.'/skpegawai" class="btn btn-app bg-grey"><i class="fa fa-arrow-circle-right"></i> SK Penerimaan Karyawan</a>';
						
								$tasks['grouptombol'] 			= $grouptombol;
								return view('rekrutmen.riwayat', $tasks);
							}
						} else {
							if ($hasil->jenispeg == 'Arsip'){
								$tasks['judulpesan']		= 'Restricted Area';
								$tasks['kalimatheader']		= 'Account Disabled';
								$tasks['kalimatbody']		= 'Mohon Maaf Akun Anda Telah Menjadi Arsip dan Tidak di Perkenankan untuk login kembali, silahkan hubungi Admin apabila Anda ingin meng aktifkan kembali akun ini';
								return view('errors.notready', $tasks);
							} else {
								return view('users.profil', $tasks);
							}
						}
					} else {
						$tasks['judulpesan']	= 'Restricted Area';
						$tasks['kalimatheader']	= 'ID Tidak Valid';
						$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
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
	}
	public function viewDataIndukArgonThem(){
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		$homebase		= url("/");
		$data 			= [];
		$tasks			= [];
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$id			= Session('iduser');
		if (Session('id') !== null){
			$id			= Session('id');
		}
		if ($id == null){
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		} else {
			$user  		 	= User::where('id', $id)->first();
			$idne 			= $user->id;
			$previlage 		= $user->previlage;
			$fakultas 		= $user->fakultas;
			$foto 			= $user->photo;
			$tandatangan 	= $user->tandatangan;
			if ($tandatangan == '' OR is_null($user->tandatangan)){
				$tandatangan = $homebase.'/boxed-bg.png';
			} else {
				if (File::exists(public_path().'/'.$tandatangan)) {
					$tandatangan = $homebase.'/'.$tandatangan;
				} else {
					$tandatangan = $homebase.'/boxed-bg.png';
				}
			}
			$jabatan = $previlage;
			if ($idne != ''){
				$golekfoto			= Simpegpegawai::where('email', $user->email)->orWhere('email_ub', $user->email)->first();
				if (isset($golekfoto->id)){
					$iduser			= $golekfoto->id;
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
				} else {
					$iduser 	= Simpegpegawai::insertGetId([
						'idpeg'						=> $idne,
						'jenispeg'					=> $user->previlage,
						'fungsional'				=> '-',
						'nik'						=> $user->username, 
						'nokk'						=> '', 
						'nama_lengkap'				=> $user->nama, 
						'nama'						=> $user->nama,
						'depan'						=> '', 
						'belakang'					=> '',
						'depandinilai'				=> '',
						'belakangdinilai'			=> '',
						'jenisnip'					=> 'NIK',
						'nip_lama'					=> '',
						'nip_baru'					=> $idne.time(),
						'nidn'						=> '',
						'jenis_kelamin'				=> '',
						'tmpt_lahir'				=> '',
						'tgl_lahir'					=> '',
						'usia'						=> '',
						'pangkat'					=> '',
						'golongan'					=> '', 
						'namabank'					=> '', 
						'norek'						=> '', 
						'namapdrekening'			=> $user->nama,
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
						'keterangan'				=> 'New', 
						'tmt_golongan'				=> '',
						'tmt_fungsional'			=> '', 
						'jab_fungsional'			=> '',
						'tmt_pensiun'				=> '', 
						'thn_pensiun'				=> '', 
						'cpns'						=> '',
						'tmt_cpns'					=> '',
						'pns'						=> '',
						'tmt_pns'					=> '',
						'thn_masuk'					=> '',
						'unit_kerja'				=> $user->fakultas,
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
						'alamat'					=> $user->username,
						'no_hp'						=> $user->nik,
						'kode'						=> '', 
						'foto'						=> '',
						'tmtgaji'					=> '', 
						'tmtpangkat'				=> '', 
						'ppabp'						=> $user->fakpanjang, 
						'jabatan'					=> '',
						'proses_pangkat'			=> '', 
						'angka_kredit'				=> '', 
						'email'						=> $user->email,
						'lama_tubel'				=> '', 
						'lama_kenaikan_pangkat'		=> '', 
						'tmt_tubel'					=> ''
					]);
				}
			}
			$ceksek		= Detailpegawai::where('no', $iduser)->count();
			if ($ceksek == 0){
				Detailpegawai::create([
					'no'			=> $iduser, 
					'ktp'			=> $user->username, 
					'emaillain'		=> $user->email,
					'gelardepan'	=> '', 
					'gelarblakang'	=> '', 
					'gelardepan2'	=> '', 
					'gelarblakang2'	=> '', 
					'bidangilmu'	=> '', 
					'alamatmlg'		=> '', 
					'kelurahan'		=> '', 
					'kecamatan'		=> '', 
					'propinsi'		=> '', 
					'kota'			=> '', 
					'kawin'			=> '', 
					'emailub'		=> '', 
					'emaillain'		=> '', 
					'skcpns'		=> '', 
					'tmtcpns'		=> '', 
					'skpns'			=> '', 
					'tmtpns'		=> '', 
					'nira'			=> '', 
					'npwp'			=> '', 
					'bpjs'			=> '', 
					'tinggibdn'		=> 0, 
					'beratbdn'		=> 0, 
					'bentukrambut'	=> '', 
					'bentukmuka'	=> '', 
					'warnakulit'	=> '', 
					'cirikusus'		=> '', 
					'cacattubuh'	=> '', 
					'hobi'			=> '', 
					'timestamp'		=> date('Y-m-d H:i')
				]);
			}
			$hasil		= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $iduser)->first();
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
				$thniki 						= (int)date("Y");
				$blniki 						= date("m");
				$thnlalu						= $thniki - 1;
				$thnakad						= $thnlalu.'/'.$thniki;
				if (Session('fakpanjang') == 'Sulawesi Barat'){
					$tasks['settings'] 			= TabelMaster::where('provinsi', Session('fakpanjang'))->get();
				}
				$routeName= FacadesRequest::route()->getName();
				$type = in_array($routeName, ['user','group'])
					? $routeName
					: 'user';
				$tasks['id'] = $id ?? 0;
				$tasks['type'] = $type ?? 'user';
				$tasks['messengerColor'] 		= Auth::user()->messenger_color ?? $this->messengerFallbackColor;
				$tasks['dark_mode'] 			= Auth::user()->dark_mode < 1 ? 'light' : 'dark';
				$tasks['tandatangan'] 			= $tandatangan;
				$tasks['foto'] 					= $foto;
				$tasks['thniki'] 				= $thniki;
				$tasks['thnakad'] 				= $thnakad;
				$tasks['tlsprodi'] 				= $tlsprodi;
				$tasks['tlsjabatan'] 			= $tlsjabatan;
				$tasks['biodata'] 				= $hasil;
				$tasks['sidebar'] 				= 'profiluser';
				return view('argon.auth.profil', $tasks);
			} else {
				$tasks['judulpesan']	= 'Restricted Area';
				$tasks['kalimatheader']	= 'ID Tidak Valid';
				$tasks['kalimatbody']	= 'Mohon Maaf ID '.$idne.' Tidak Di Temukan';
				return view('errors.notready', $tasks);
			}
		}
	}
	public function viewBerkasPelamar(){
		$data		= [];
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$idpeg				= Session('iduser');
		$kalender   		= array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd        		 	= date("d");
		$mm         		= (int)date("m");
		$mm					= $kalender[$mm];
		$tahuniki   		= date("Y");
		$tahunlulussma 		= date("Y");
		$tahunluluskuliah 	= date("Y-m-d");
		$tglcetak			= $dd.' '.$mm.' '.$tahuniki;
		$jabatan			= '';
		$tandatangan		= '';
		$homebase			= url("/");
		$biodata			= DB::table('kp_pegawai')->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')->where('kp_pegawai.id', $idpeg)->first();
		if (isset($biodata->idpeg)){
			$foto			= $biodata->foto;
			$id				= $biodata->id;
			$kepakaran		= $biodata->kepakaran;
			$getjabatan		= User::where('id', $idpeg)->first();
			if (isset($getjabatan->tandatangan)){
				$jabatan	= $getjabatan->privilage;
				$tandatangan= $getjabatan->tandatangan;
			}			
			if ($foto != ''){
				$foto		= str_replace('photo/', '', $foto);
				$foto 		= $homebase.'/images/pegawai/'.$foto;
			} else { $foto 	= $homebase.'/mascot.png'; }
			$pendidikan         =   [];
			$getpendidikan      =   Detailpendidikan::where('no', $id)->orderBy('tahunmsk', 'ASC')->get();
			$key 				= 	0;
			if (!empty($getpendidikan)){
				$i = 1;
				foreach($getpendidikan as $key => $row) {
					if ($row->jenjang == 'SD' OR $row->jenjang == 'SMP' OR $row->jenjang == 'SMA'){
						//nothing
					} else if ($row->jenjang == 'S1'){
						//nothing
					} 
					$pendidikan[$key]['nomer']   			=   $i;
					$pendidikan[$key]['tingkat']   			=   $row->jenjang;
					$pendidikan[$key]['nama']  				=   $row->sekolah;
					$pendidikan[$key]['jurusan']   			=   $row->minat;
					$pendidikan[$key]['tgllulus'] 			=   $row->tglijasah;
					$pendidikan[$key]['tempat'] 			=   $row->negara;
					$pendidikan[$key]['namakepalasekolah'] 	=   $row->keterangan;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$pendidikan[$key]['nomer']   			=   '&nbsp;';
				$pendidikan[$key]['tingkat']   			=   '&nbsp;-';
				$pendidikan[$key]['nama']  				=   '&nbsp;-';
				$pendidikan[$key]['jurusan']   			=   '&nbsp;-';
				$pendidikan[$key]['tgllulus'] 			=   '&nbsp;-';
				$pendidikan[$key]['tempat'] 			=   '&nbsp;-';
				$pendidikan[$key]['namakepalasekolah'] 	=   '&nbsp;-';
			}
			
			$getdiklat      	=   Detaildiklat::where('no', $id)->orderBy('mulai', 'ASC')->get();
			$diklat         	=   [];
			$key 				= 	0;
			if (!empty($getdiklat)){
				$i 				= 1;
				foreach($getdiklat as $key => $row) {
					$diklat[$key]['nomer']   			=   $i;
					$diklat[$key]['namadiklat']   		=   $row->namadiklat;
					$diklat[$key]['tanggal']  			=   $row->mulai.' s/d '.$row->lulus;
					$diklat[$key]['nodoc']   			=   $row->nodoc;
					$diklat[$key]['tempat'] 			=   $row->tempat;
					$diklat[$key]['keterangan'] 		=   $row->keterangan;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$diklat[$key]['nomer']   			=   '&nbsp;';
				$diklat[$key]['namadiklat']   		=   '&nbsp;-';
				$diklat[$key]['tanggal']  			=   '&nbsp;-';
				$diklat[$key]['nodoc']   			=   '&nbsp;-';
				$diklat[$key]['tempat'] 			=   '&nbsp;-';
				$diklat[$key]['keterangan'] 		=   '&nbsp;-';
			}

			$getpangkat      	=   Detailpangkat::where('no', $id)->orderBy('tmtpangkat', 'ASC')->get();
			$pangkat         	=   [];
			$key 				= 	0;
			if (!empty($getpangkat)){
				$i 	= 1;
				foreach($getpangkat as $key => $row) {
					$golongan 	= $row->golongan;
					$cekpangkat	= Golongan::where('golongan', $golongan)->first();
					if (isset($cekpangkat->pangkat)){
						$tlspangkat= $cekpangkat->pangkat;
					} else { $tlspangkat = ''; }
					$pangkat[$key]['nomer']   			=   $i;
					$pangkat[$key]['pangkat']   		=   $tlspangkat;
					$pangkat[$key]['golongan']  		=   $golongan;
					$pangkat[$key]['tmtpangkat']   		=   $row->tmtpangkat;
					$pangkat[$key]['gajipokok'] 		=   $row->gajipokok;
					$pangkat[$key]['nosk'] 				=   $row->nosk;
					$pangkat[$key]['asalsk'] 			=   $row->asalsk;
					$pangkat[$key]['tglsk'] 			=   $row->tglsk;
					$pangkat[$key]['keterangan'] 		=   $row->keterangan;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$pangkat[$key]['nomer']   				=   '&nbsp;';
				$pangkat[$key]['pangkat']   			=   '&nbsp;-';
				$pangkat[$key]['golongan']  			=   '&nbsp;-';
				$pangkat[$key]['tmtpangkat']   			=   '&nbsp;-';
				$pangkat[$key]['gajipokok'] 			=   '&nbsp;-';
				$pangkat[$key]['nosk'] 					=   '&nbsp;-';
				$pangkat[$key]['asalsk'] 				=   '&nbsp;-';
				$pangkat[$key]['tglsk'] 				=   '&nbsp;-';
				$pangkat[$key]['keterangan'] 			=   '&nbsp;-';
			}
			
			$getfungsional      =   Detailfungsional::where('no', $id)->orderBy('tmt', 'ASC')->get();
			$fungsional       	=   [];
			$key 				= 	0;
			if (!empty($getfungsional)){
				$i 	= 1;
				foreach($getfungsional as $key => $row) {
					$fungsional[$key]['nomer']   			=   $i;
					$fungsional[$key]['jabatan']   			=   $row->jabatan;
					$fungsional[$key]['tmt']  				=   $row->tmt;
					$fungsional[$key]['tunjangan']   		=   $row->tunjangan;
					$fungsional[$key]['angkakredit']   		=   $row->angkakredit;
					$fungsional[$key]['asalsk'] 			=   $row->asalsk;
					$fungsional[$key]['penandatangan'] 		=   $row->penandatangan;
					$fungsional[$key]['nosk'] 				=   $row->nosk;
					$fungsional[$key]['tglsk'] 				=   $row->tglsk;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$fungsional[$key]['nomer']   				=   '&nbsp;';
				$fungsional[$key]['jabatan']   				=   '&nbsp;-';
				$fungsional[$key]['tmt']  					=   '&nbsp;-';
				$fungsional[$key]['tunjangan']   			=   '&nbsp;-';
				$fungsional[$key]['angkakredit']   			=   '&nbsp;-';
				$fungsional[$key]['asalsk'] 				=   '&nbsp;-';
				$fungsional[$key]['penandatangan'] 			=   '&nbsp;-';
				$fungsional[$key]['nosk'] 					=   '&nbsp;-';
				$fungsional[$key]['tglsk'] 					=   '&nbsp;-';
			}
			$getpenghargaan      =   Detailpenghargaan::where('no', $id)->orderBy('tanggal', 'ASC')->get();
			$penghargaan       	=   [];
			$key 				= 	0;
			if (!empty($getpenghargaan)){
				$i = 1;
				foreach($getpenghargaan as $key => $row) {
					$penghargaan[$key]['nomer']   			=   $i;
					$penghargaan[$key]['penghargaan']   	=   $row->penghargaan;
					$penghargaan[$key]['tanggal']  			=   $row->tanggal;
					$penghargaan[$key]['pemberi']   		=   $row->pemberi;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$penghargaan[$key]['nomer']   				=   '&nbsp;';
				$penghargaan[$key]['penghargaan']   		=   '&nbsp;-';
				$penghargaan[$key]['tanggal']  				=   '&nbsp;-';
				$penghargaan[$key]['pemberi']   			=   '&nbsp;-';
			}
			$getkeluarga	=   Detailanggotakeluarga::where('no', $id)->orderBy('hubklg', 'ASC')->get();
			$sutri       	=   [];
			$ortu       	=   [];
			$mertua       	=   [];
			$anak       	=   [];
			$saudara       	=   [];
			$keysutri 		= 	0;
			$keyortu 		= 	0;
			$keyanak 		= 	0;
			$keymertua 		= 	0;
			$keysaudara 	= 	0;
			if (!empty($getkeluarga)){
				foreach($getkeluarga as $key => $row) {
					$hubklg 	= $row->hubklg;
					if ($hubklg == 'Suami' OR $hubklg == 'Isteri'){
						$sutri[$keysutri]['nomer']   				=   $keysutri + 1;
						$sutri[$keysutri]['nama']   				=   $row->nama;
						$sutri[$keysutri]['tmplahir']  				=   $row->tmplahir;
						$sutri[$keysutri]['tgllahir']  				=   $row->tgllahir;
						$sutri[$keysutri]['tglnikah']  				=   $row->tglmenikah;
						$sutri[$keysutri]['pekerjaan']   			=   $row->pekerjaan;
						$sutri[$keysutri]['keterangan']   			=   $row->status;
						$keysutri++;
					}
					if ($hubklg == 'Anak'){
						$anak[$keyanak]['nomer']   					=   $keyanak + 1;
						$anak[$keyanak]['nama']   					=   $row->nama;
						$anak[$keyanak]['tmplahir']  				=   $row->tmplahir;
						$anak[$keyanak]['tgllahir']  				=   $row->tgllahir;
						$anak[$keyanak]['kelamin']  				=   $row->kelamin;
						$anak[$keyanak]['pekerjaan']   				=   $row->pekerjaan;
						$anak[$keyanak]['keterangan']   			=   $row->status;
						$keyanak++;
					}
					if ($hubklg == 'Ayah' OR $hubklg == 'Ibu' OR $hubklg == 'Orang Tua'){
						$ortu[$keyortu]['nomer']   					=   $keyortu + 1;
						$ortu[$keyortu]['nama']   					=   $row->nama;
						$ortu[$keyortu]['tgllahir']  				=   $row->tgllahir;
						$ortu[$keyortu]['pekerjaan']   				=   $row->pekerjaan;
						$ortu[$keyortu]['keterangan']   			=   $row->status;
						$keyortu++;
					}
					if ($hubklg == 'Mertua'){
						$mertua[$keymertua]['nomer']   				=   $keymertua + 1;
						$mertua[$keymertua]['nama']   				=   $row->nama;
						$mertua[$keymertua]['tgllahir']  			=   $row->tgllahir;
						$mertua[$keymertua]['pekerjaan']   			=   $row->pekerjaan;
						$mertua[$keymertua]['keterangan']   		=   $row->status;
						$keymertua++;
					}
					if ($hubklg == 'Saudara'){
						$saudara[$keysaudara]['nomer']   			=   $keysaudara + 1;
						$saudara[$keysaudara]['nama']   			=   $row->nama;
						$saudara[$keysaudara]['tgllahir']  			=   $row->tgllahir;
						$saudara[$keysaudara]['kelamin']  			=   $row->kelamin;
						$saudara[$keysaudara]['pekerjaan']  		=   $row->pekerjaan;
						$saudara[$keysaudara]['keterangan']   		=   $row->status;
						$keysaudara++;
					}
				}
			}
			if ($keysutri == 0){
				$sutri[$keysutri]['nomer']   				=   '&nbsp;';
				$sutri[$keysutri]['nama']   				=   '&nbsp;-';
				$sutri[$keysutri]['tmplahir']  				=   '&nbsp;-';
				$sutri[$keysutri]['tgllahir']  				=   '&nbsp;-';
				$sutri[$keysutri]['tglnikah']  				=   '&nbsp;-';
				$sutri[$keysutri]['pekerjaan']   			=   '&nbsp;-';
				$sutri[$keysutri]['keterangan']   			=   '&nbsp;-';
			}
			if ($keyortu == 0){
				$ortu[$keyortu]['nomer']   					=   '&nbsp;';
				$ortu[$keyortu]['nama']   					=   '&nbsp;-';
				$ortu[$keyortu]['tgllahir']  				=   '&nbsp;-';
				$ortu[$keyortu]['pekerjaan']   				=   '&nbsp;-';
				$ortu[$keyortu]['keterangan']   			=   '&nbsp;-';
			}
			if ($keymertua == 0){
				$mertua[$keymertua]['nomer']   				=   '&nbsp;';
				$mertua[$keymertua]['nama']   				=   '&nbsp;-';
				$mertua[$keymertua]['tgllahir']  			=   '&nbsp;-';
				$mertua[$keymertua]['pekerjaan']   			=   '&nbsp;-';
				$mertua[$keymertua]['keterangan']   		=   '&nbsp;-';
			}
			if ($keyanak == 0){
				$anak[$keyanak]['nomer']   					=   '&nbsp;';
				$anak[$keyanak]['nama']   					=   '&nbsp;-';
				$anak[$keyanak]['kelamin']   				=   '&nbsp;-';
				$anak[$keyanak]['tgllahir']  				=   '&nbsp;-';
				$anak[$keyanak]['tmplahir']  				=   '&nbsp;-';
				$anak[$keyanak]['pekerjaan']   				=   '&nbsp;-';
				$anak[$keyanak]['keterangan']   			=   '&nbsp;-';
			}
			if ($keysaudara == 0){
				$saudara[$keysaudara]['nomer']   			=   '&nbsp;';
				$saudara[$keysaudara]['nama']   			=   '&nbsp;-';
				$saudara[$keysaudara]['kelamin']   			=   '&nbsp;-';
				$saudara[$keysaudara]['tgllahir']  			=   '&nbsp;-';
				$saudara[$keysaudara]['pekerjaan']   		=   '&nbsp;-';
				$saudara[$keysaudara]['keterangan']   		=   '&nbsp;-';
			}
			$organisasi       							=   [];
			$key 										= 	0;
			$i 											= 	1;
			$getdataorganisasi							=   Detailorganisasi::where('no', $id)->orderBy('id', 'ASC')->get();
			if (!empty($getdataorganisasi)){
				foreach($getdataorganisasi as $key => $row) {
					$organisasi[$key]['nomer']   		=   $i;
					$organisasi[$key]['nama']   		=   $row->nama;
					$organisasi[$key]['kedudukan']  	=   $row->kedudukan;
					$organisasi[$key]['mulai']   		=   $row->mulai;
					$organisasi[$key]['selesai']   		=   $row->selesai;
					$organisasi[$key]['namapejabat']   	=   $row->namapejabat;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$organisasi[$key]['nomer']   			=   '&nbsp;';
				$organisasi[$key]['nama']   			=   '&nbsp;-';
				$organisasi[$key]['kedudukan']  		=   '&nbsp;-';
				$organisasi[$key]['mulai']   			=   '&nbsp;-';
				$organisasi[$key]['selesai']   			=   '&nbsp;-';
				$organisasi[$key]['namapejabat']   		=   '&nbsp;-';	
			}
			$berkassyarat       						= 	[];
			$key 										= 	0;
			$i 											= 	1;
			$getdataberkas								=   Filess::where('size', $id)->orderBy('id', 'ASC')->get();
			if (!empty($getdataberkas)){
				foreach($getdataberkas as $key => $row) {
					$cekberkas 							= 	$row->description;
					if ($cekberkas == ''){
						$keterangan = '';
					} else {
						$keterangan = '<a href="'.$homebase.'/'.$row->description.'" target="_blank">Download</a>';
					}
					$berkassyarat[$key]['nomer']   		=   $i;
					$berkassyarat[$key]['name']   		=   $row->name;
					$berkassyarat[$key]['type']  		=   $row->type;
					$berkassyarat[$key]['url']   		=   $row->url;
					$berkassyarat[$key]['title']   		=   $row->title;
					$berkassyarat[$key]['description']  =  	$row->description;
					$berkassyarat[$key]['keterangan']  	=   $keterangan;
					$key++;
					$i++;
				}
			}
			if ($key == 0){
				$berkassyarat[$key]['nomer']   			=   '&nbsp;';
				$berkassyarat[$key]['name']   			=   '&nbsp;-';
				$berkassyarat[$key]['type']  			=   '&nbsp;-';
				$berkassyarat[$key]['url']   			=   '&nbsp;-';
				$berkassyarat[$key]['title']   			=   '&nbsp;-';
				$berkassyarat[$key]['description']  	=   '&nbsp;-';
				$berkassyarat[$key]['keterangan']  		=   '&nbsp;-';
				
			}
			$data['tulispangkat']						= $biodata->pangkat;
			$data['tulisgolongan']						= $biodata->golongan;	
			$data['kepakaran']							= $kepakaran;
			$data['tandatangan']						= $tandatangan;
			$data['jabatan']							= $jabatan;
			$data['tglcetak']							= $tglcetak;
			$data['biodata']							= $biodata;
			$data['pendidikan']							= $pendidikan;
			$data['diklat']								= $diklat;
			$data['pangkat']							= $pangkat;
			$data['fungsional']							= $fungsional;
			$data['penghargaan']						= $penghargaan;
			$data['sutri']								= $sutri;
			$data['ortu']								= $ortu;
			$data['anak']								= $anak;
			$data['mertua']								= $mertua;
			$data['saudara']							= $saudara;
			$data['organisasi']							= $organisasi;
			$data['berkassyarat']						= $berkassyarat;
			$data['kursus']								= [];
			$data['foto']								= $foto;
			$data['sidebar'] 							= 'berkaspelamar';
			return view('rekrutmen.berkas', $data);
		} else {
			$tasks['judulpesan']	= 'IDlE TIMEOUT';
			$tasks['kalimatheader']	= 'Mohon Relogin';
			$tasks['kalimatbody']	= 'Mohon Maaf ID Tidak Di Temukan';
			return view('errors.notready', $tasks);
		}
	}
	public function cekNotifikasi(Request $request) {
		$textnotif						= '';
		$countsuratmasuk				= 0;
		$countsuratkeluar				= 0;
		$countskdanperaturan			= 0;
		$efent							= 0;
		$countmohonttd					= 0;
		$countnotadinas					= 0;
		$countmemo						= 0;
		$cekmari						= 0;
		$cekrungmari					= 0;
		$totalform 						= 0;
		$notifcutitahunan				= 0;
		$notifcutiagama					= 0;
		$notifijinplgcepat				= 0;
		$notifijinkeluarkantor			= 0;
		$notifpermintaanpegawai			= 0;
		$notifmutasirotasi				= 0;
		$notifkomunikasi				= 0;
	    $notifpengangkatanjabatan		= 0;
		$notifpemberhentianjabatan		= 0;
		$notifpegawaitetap				= 0;
		$notifdoktertetap				= 0;
		$notifpenerimaanstaf			= 0;
		$notifpenonaktifanstaf			= 0;
		$notifpengaktifanstaf			= 0;
		$notifmutasi					= 0;
		$notifpenonaktifandokter		= 0;
		$notiforientasikerja			= 0;
		$notifpkwt						= 0;
		$notifpkwtt						= 0;
		$notifspo						= 0;
		$notifedaran					= 0;
		$notifperingatan				= 0;
		$notifbalasanpenambahanstaf		= 0;
		$notifpermohonan				= 0;
		$notiftugas						= 0;
		$notifpemberitahuan				= 0;
		$notiftanggapanresign			= 0;
		$notifreferensikerja			= 0;
		$notifketeranganaktif			= 0;
		$notifpemutusanhubungan			= 0;
		$notifpemanggilancalonkaryawan	= 0;
		$notiflolosseleksi				= 0;
		$notifpemberitahuanmcu			= 0;
		$notifundangan					= 0;
		$notifpemanggilankie			= 0;
		$notifketerangantidakbekerja	= 0;
		$notifformrs01 					= 0;
		$notifformrs02 					= 0;
		$notifformrs03 					= 0;
		$notifformrs04 					= 0;
		$notifformrs05 					= 0;
		$notifformrs06 					= 0;
		$notifformrs07 					= 0;
		$notifformrs08 					= 0;
		$notifformrs09 					= 0;
		$notifformrs10 					= 0;
		$notifformrs11 					= 0;
		$notifformrs12 					= 0;
		$notifformrs13 					= 0;
		$notifformrs14 					= 0;
		$notifformrs15 					= 0;
		$notifformrs16 					= 0;
		$notifformrs17 					= 0;
		$notifformrs18 					= 0;
		$notifformrs19 					= 0;
		$persuratanptform 				= 0;
		$persuratanptkd 				= 0;
		$persuratanptkk 				= 0;
		$persuratanptss 				= 0;
		$persuratanrs 					= 0;
		$markingname 					= Session('id').'-'.time();
		$markingname					= md5($markingname);
		$homebase						= url("/");
		$idusername						= Session('id');
		$fakultas						= Session('fakultas');
		$fakpanjang						= Session('fakpanjang');
		$namaapps 						= Session('namaapps01');
		$swandhanafak       			= Session('fakultas');
		$swandhanaalamat    			= Session('addressapps01');
		$swandhanakemen     			= Session('subdomainapps01');
		$swandhanauniv      			= Session('subsubdomainapps01');
		$mkelompok						= Session('previlage');
		$pembuat						= Session('nama');
		$fakultas						= Session('fakultas');
		$swandhanakota    				= Session('kota01');
		$swandhanaemail					= Session('emailapps01');
		$ttd 							= 'SIgned With TTE'; 
		$encoded_image 					= 'SIgned With TTE';
		$benergak						= 'TIDAK';
		$textsamplesalah				= 'Password Anda Salah';
		$noselanjutnya					= 0;
		$error							= '';
		$certificate					= 'file://'.base_path().'/public/sco.crt';
		$page_format 					= array(
											'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
											'Dur' 			=> 3,
											'PZ' 			=> 1,
		);
		$info 							= array(
											'Name' 			=> $namaapps,
											'Location' 		=> $swandhanauniv,
											'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
											'ContactInfo' 	=> $homebase,
		);
		$sql							= Inboxsurat::where('terjadwal', '1')->orderBy('updated_at', 'ASC')->get();
		$countsql 						= count($sql);
		$parafcount 					= 0;
		$ttecount 						= 0;
		if (!empty($sql)){
			foreach ($sql as $rinbox){
				$idne 					= $rinbox->id;
				$marking 				= $rinbox->marking;
				$kerjalm				= $rinbox->kerja;
				$kerja					= $rinbox->kerja;
				$penerima				= $rinbox->penerima;
				$catatan				= $rinbox->catatan;
				$tabele					= $rinbox->jenis;
				$ctanggal				= $rinbox->tanggal;
				$paraf1 				= $rinbox->paraf1;
				$paraf2 				= $rinbox->paraf2;
				$paraf3 				= $rinbox->paraf3;
				$paraf4 				= $rinbox->paraf4;
				$penandatangan 			= $rinbox->penandatangan;
				$masterjenissurat		= $rinbox->jenissrt;
				$jenissrt 				= $rinbox->jenissrt;
				$footnote				= $rinbox->footnote;
				$komputer				= $rinbox->komputer;
				$email					= $rinbox->email;
				$pembuat 				= $rinbox->pembuat;
				$perihal 				= $rinbox->perihal;
				$kepada					= $rinbox->kepada;
				$serttte 				= md5($email);
				$ceksertifikatpribadi 	= $serttte.'.crt';
				$sertifikatpribadi 		= $serttte.'.csr';
				$kelompok 				= $penerima;
				if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
				} else if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
					$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
				} else {
					$getpejabat = Pejabatsurat::where('email', $rinbox->email)->first();
					if (isset($getpejabat->pejabat)){
						$namapejabat = $getpejabat->nama;
					} else {
						$namapejabat = $rinbox->penerima;
					}
					$dn = array(
						"countryName" 			=> "IN",
						"stateOrProvinceName" 	=> "East Java Indonesia",
						"localityName" 			=> $penerima,
						"organizationName" 		=> $swandhanauniv,
						"organizationalUnitName"=> $swandhanafak,
						"commonName" 			=> $namapejabat,
						"emailAddress" 			=> $email
					);
					$privkey = openssl_pkey_new(array(
						"private_key_bits" => 2048,
						"private_key_type" => OPENSSL_KEYTYPE_RSA,
					));
					$csr = openssl_csr_new($dn, $privkey, array('digest_alg' => 'RSA-SHA256'));
					$sscert = openssl_csr_sign($csr, null, $privkey, 365);
					openssl_csr_export($csr, $csrout);
					openssl_x509_export($sscert, $certout);
					openssl_pkey_export($privkey, $pkeyout);
					Storage::disk('local')->put('/tte/'.$ceksertifikatpribadi, $pkeyout);
					file_put_contents(public_path()."/tte/".$ceksertifikatpribadi, $certout, FILE_APPEND | LOCK_EX);
					if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
						$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
					} else if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
						$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
					}
				}
				if ($rinbox->kerja == 'PARAF'){
					$noselanjutnya = 2;
					if ($rinbox->tanggal == '1'){ $penandatangan = $paraf2; $noselanjutnya = 2; }
					if ($rinbox->tanggal == '2'){ $penandatangan = $paraf3; $noselanjutnya = 3; }
					if ($rinbox->tanggal == '3'){ $penandatangan = $paraf4; $noselanjutnya = 4; }
					if ($rinbox->tanggal == '4'){ $noselanjutnya = 5; }
					if ($penandatangan == 0){ $penandatangan = $rinbox->penandatangan; }
					Inboxsurat::where('id', $idne)->update([
						'terjadwal'		=> 	$noselanjutnya
					]);
					$parafcount++;
					$getpejabat = Pejabatsurat::where('id', $penandatangan)->first();
					if (isset($getpejabat->id)){
						SendMail::kiriminbox($rinbox->marking,$rinbox->penerima,$getpejabat->pejabat,$getpejabat->email,'KELUAR','PARAF',$footnote,$noselanjutnya);
					} else {
						$getpejabat = Pejabatsurat::where('pejabat', 'LIKE', $penandatangan)->first();
						if (isset($getpejabat->id)){
							SendMail::kiriminbox($rinbox->marking,$rinbox->penerima,$getpejabat->pejabat,$getpejabat->email,'KELUAR','TTD',$footnote,$noselanjutnya);
						} else {
							Inboxsurat::where('id', $idne)->update([
								'kerja'		=> 	'TTD'
							]);
						}
					}
				} else {
					$cekbentuk 		= Templateskpp::where('namask', $masterjenissurat)->count();
					if ($cekbentuk == 0){
						$tanggalesign	= date('Y-m-d H:i:s');
						if ($ctanggal == ''){
							$ctanggal	= 0;
						} else {
							$ctanggal	= (int)$ctanggal;
						}
						$noselanjutnya	= $ctanggal++;
						$alamatweb		= $homebase.'/trackingid/srtklr-'.$marking;
						$bgbssn			= '';
						if ($masterjenissurat == 'UPLQRMAN' OR $masterjenissurat == 'SKDANPERATURANTTEMAN' OR $masterjenissurat == 'PERATURANTTEMAN' OR $masterjenissurat == 'INSTRUKSITTEMAN'){
							try {
								$pdf 	= new Fpdi('P','mm',array(210,330));
								$pages 	= $pdf->setSourceFile(public_path().'/scan/files/'.$marking.'.pdf');
								for ($i = 1; $i <= $pages; $i++)
								{
									$page = $pdf->importPage($i);
									$pdf->AddPage();
									$pdf->useTemplate($page, ['adjustPageSize' => true]);
									$pdf->setSignature($certificate, $certificate, $marking, '', 2, $info);
									$pdf->setPageMark();
								}
								$pdf->Output(public_path().'/scan/files/'.$marking.'.pdf', 'F');
								Inboxsurat::where('id', $idne)->update([
									'terjadwal' =>  6,
								]);
								$ttecount++;
							} catch (\Exception $e) {
								$footnote = $footnote.$e->getMessage();
							}
							if ($rinbox->tabel == 'DRAFTSK'){
								Draftsk::where('marking', $marking)->update([
									'status'		=> 'Signed',
									'tandatangan'	=> 'Signed By '.$penerima,
									'catatan'		=> $footnote
								]);
							} else if ($rinbox->tabel == 'SKDANPERATURAN'){
								Tabelskdanperaturan::where('marking', $marking)->update([
									'tandatangan'	=> 'Signed By '.$penerima,
									'catatan'		=> $footnote
								]);
							} else if ($rinbox->tabel == 'KELUARNONOMER'){
								Suratkeluartnpnomor::where('marking', $marking)->update([
									'status'		=> 'Signed',
									'tandatangan'	=> 'Signed By '.$penerima,
									'footnote'		=> $footnote
								]);
							} else {
								Suratkeluar::where('marking', $marking)->update([
									'tandatangan'	=> 'Signed By '.$penerima,
									'status'		=> 'Signed',
									'footnote'		=> $footnote
								]);
							}
						} else {
							SendMail::genQRCodefile($marking,$penerima,$penerima,$tanggalesign,$alamatweb);
							if (File::exists(base_path() ."/public/scan/generate/bg-". $marking.".png")) {
								$bgbssn 	= base_path('/public/scan/generate/bg-'.$marking.'.png');
							}
							if (File::exists(public_path() ."/scan/generate/bg-". $marking.".png")) {
								$bgbssn 	= public_path('/scan/generate/bg-'.$marking.'.png');
							}
							if ($bgbssn != '') {
								$file 	= public_path('scan/files/'.$marking.'.pdf');
								if (file_exists($file)){
									try {
										$pdf 	= new Fpdi('P','mm',array(210,330));
										$pages 	= $pdf->setSourceFile(public_path().'/scan/files/'.$marking.'.pdf');
										for ($i = 1; $i <= $pages; $i++)
										{
											$page = $pdf->importPage($i);
											$pdf->AddPage();
											$pdf->useTemplate($page, ['adjustPageSize' => true]);
											$pdf->setSignature($certificate, $certificate, $marking, '', 2, $info);
											$pdf->setPageMark();
										}
										$pdf->Output(public_path().'/scan/files/'.$marking.'.pdf', 'F');
									} catch (\Exception $e) {
										$footnote = $footnote.$e->getMessage();
									}
									Inboxsurat::where('id', $idne)->update([
										'terjadwal'	=> 7,
										'footnote'	=> $footnote
									]);
									$file1 			=  'scan/generate/bg-'.$marking.'.png';
									$file2 			=  'scan/generate/qrimg-'.$marking.'.png';
									$file3 			=  'scan/generate/qrimg-'.$marking.'.pdf';
									Storage::disk('local')->delete($file1);
									Storage::disk('local')->delete($file2);
									Storage::disk('local')->delete($file3);
									if ($rinbox->tabel == 'DRAFTSK'){
										Draftsk::where('marking', $marking)->update([
											'status'		=> 'Signed',
											'tandatangan'	=> 'Signed By '.$penerima,
											'catatan'		=> $footnote
										]);
									} else if ($rinbox->tabel == 'SKDANPERATURAN'){
										Tabelskdanperaturan::where('marking', $marking)->update([
											'tandatangan'	=> 'Signed By '.$penerima,
											'catatan'		=> $footnote
										]);
									} else if ($rinbox->tabel == 'KELUARNONOMER'){
										Suratkeluartnpnomor::where('marking', $marking)->update([
											'status'		=> 'Signed',
											'tandatangan'	=> 'Signed By '.$penerima,
											'footnote'		=> $footnote
										]);
									} else {
										Suratkeluar::where('marking', $marking)->update([
											'tandatangan'	=> 'Signed By '.$penerima,
											'status'		=> 'Signed',
											'footnote'		=> $footnote
										]);
									}
								} else {
									if ($rinbox->tabel == 'SKDANPERATURAN'){
										$ceksek 	= Tabelskdanperaturan::where('marking', $marking)->first();
										if (isset($ceksek->marking)){
											$file 	= 'scan/files/'.$ceksek->marking.'.pdf';
											Storage::disk('local')->delete($file);
											Tabelskdanperaturan::where('id', $ceksek->id)->update([
												'tandatangan'		=> 	$ttd,
												'updated_at'		=> 	date('Y-m-d H:i:s')
											]);
											
											$img_file 	= public_path('kopfooterdpm.png');
											$text		= NotifikasiController::getTextExternal('formb',$ceksek->id);
											$marking 	= $ceksek->marking;
											if (isset($ceksek->pembuat)){ $pembuat = $ceksek->pembuat; }
											if (isset($ceksek->kelompok)){ $kelompok = $ceksek->kelompok; }
											if (isset($ceksek->jenissrt)){ $jenissrt = $ceksek->jenissrt; }
											if (isset($ceksek->kepada)){ $kepada = $ceksek->kepada; }
											if (isset($ceksek->perihal)){ $perihal = $ceksek->perihal; }
											
											if (isset($ceksek->inputor)){ $pembuat = $ceksek->inputor; }
											if (isset($ceksek->fakultas)){ $kelompok = $ceksek->fakultas; }
											if (isset($ceksek->kelompok)){ $jenissrt = $ceksek->kelompok; }
											if (isset($ceksek->namaparaf4)){ $kepada = $ceksek->namaparaf4; }
											if (isset($ceksek->judul)){ $perihal = $ceksek->judul; }
											$gethalaman 	= explode('<div style="page-break-before: always"></div>', $text);
											try {
												PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
												PDFCREATOR::SetProtection(array('modify', 'copy'), '', null, 0, null);
												PDFCREATOR::SetCreator($pembuat);
												PDFCREATOR::SetAuthor($kelompok);
												PDFCREATOR::SetTitle($jenissrt);
												PDFCREATOR::SetSubject($kepada);
												PDFCREATOR::SetKeywords($perihal);
												PDFCREATOR::setPrintHeader(false);
												PDFCREATOR::setPrintFooter(false);
												PDFCREATOR::SetMargins(5, 0, 5);
												PDFCREATOR::setFontSubsetting(true);
												PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
												foreach($gethalaman as $halaman){
													PDFCREATOR::AddPage('P', $page_format, false, false);
													$bMargin = PDFCREATOR::getBreakMargin();
													$auto_page_break = PDFCREATOR::getAutoPageBreak();
													PDFCREATOR::SetAutoPageBreak(false, 0);
													PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
													PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
													PDFCREATOR::setPageMark();
													PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
													PDFCREATOR::setFooterMargin(0);	
												}
												$pdfdoc = PDFCREATOR::Output('', 'S');
												PDFCREATOR::reset();
												Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
											} catch (\Exception $e) {
												$footnote = $footnote.$e->getMessage();
											}
											
											Inboxsurat::where('id', $rinbox->id)->update([
												'terjadwal'	=> 8,
												'footnote'	=> $footnote
											]);
											$text = null;
										}
									} else {
										$ceksek 	= Suratkeluar::where('marking', $marking)->first();
										if (isset($ceksek->marking)){
											$file 	= 'scan/files/'.$ceksek->marking.'.pdf';
											Storage::disk('local')->delete($file);
										
											Suratkeluar::where('id', $ceksek->id)->update([
												'tandatangan'		=> 	$ttd,
												'status'			=> 	$ttd
											]);
											if ($ceksek->fakultas == 'RSPHSKR'){
												$img_file = public_path('kopfooterrsphs.png');
											} else if ($ceksek->fakultas == 'RSPHMLG'){
												$img_file = public_path('kopfooterrsphm.png');
											} else if ($ceksek->fakultas == 'PDP'){
												$img_file = public_path('kopfooterpdp.png');
											} else {
												$img_file = public_path('kopfooterdpm.png');
											}
											$text		= NotifikasiController::getTextExternal('formc',$ceksek->id);
											$marking 	= $ceksek->marking;
											$gethalaman = explode('<div style="page-break-before: always"></div>', $text);
											if (isset($ceksek->pembuat)){ $pembuat = $ceksek->pembuat; }
											if (isset($ceksek->kelompok)){ $kelompok = $ceksek->kelompok; }
											if (isset($ceksek->jenissrt)){ $jenissrt = $ceksek->jenissrt; }
											if (isset($ceksek->kepada)){ $kepada = $ceksek->kepada; }
											if (isset($ceksek->perihal)){ $perihal = $ceksek->perihal; }
											
											if (isset($ceksek->inputor)){ $pembuat = $ceksek->inputor; }
											if (isset($ceksek->fakultas)){ $kelompok = $ceksek->fakultas; }
											if (isset($ceksek->kelompok)){ $jenissrt = $ceksek->kelompok; }
											if (isset($ceksek->namaparaf4)){ $kepada = $ceksek->namaparaf4; }
											if (isset($ceksek->judul)){ $perihal = $ceksek->judul; }
											try {
												PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
												PDFCREATOR::SetCreator($pembuat);
												PDFCREATOR::SetAuthor($kelompok);
												PDFCREATOR::SetTitle($jenissrt);
												PDFCREATOR::SetSubject($kepada);
												PDFCREATOR::SetKeywords($perihal);
												PDFCREATOR::setPrintHeader(false);
												PDFCREATOR::setPrintFooter(false);
												PDFCREATOR::SetMargins(5, 0, 5);
												PDFCREATOR::setFontSubsetting(true);
												PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
												foreach($gethalaman as $halaman){
													PDFCREATOR::AddPage('P', $page_format, false, false);
													$bMargin = PDFCREATOR::getBreakMargin();
													$auto_page_break = PDFCREATOR::getAutoPageBreak();
													PDFCREATOR::SetAutoPageBreak(false, 0);
													PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
													PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
													PDFCREATOR::setPageMark();
													PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
													PDFCREATOR::setFooterMargin(0);	
												}
												$pdfdoc = PDFCREATOR::Output('', 'S');
												PDFCREATOR::reset();
												Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
											} catch (\Exception $e) {
												$footnote = $footnote.$e->getMessage();
											}
											
											Inboxsurat::where('id', $rinbox->id)->update([
												'terjadwal'	=> 9,
												'footnote'	=> $footnote
											]);
											$text = null;
										} else {
											$gceksrtklr 	= Suratkeluartnpnomor::where('marking', $marking)->first();
											if (isset($gceksrtklr->marking)){
												$idsurat 	= $gceksrtklr->id;
												$jenissrt	= $gceksrtklr->jenissrt;
												$status 	= $gceksrtklr->status;
												$marking 	= $gceksrtklr->marking;
												$perihal 	= $gceksrtklr->perihal;
												$kelompok 	= $gceksrtklr->kelompok;
												if ($status == 'MANUAL' OR $jenissrt == 'SPO'){
													try {
														$pdf 	= new Fpdi('P','mm',array(210,330));
														$pages 	= $pdf->setSourceFile(public_path().'/scan/files/'.$marking.'.pdf');
														for ($i = 1; $i <= $pages; $i++)
														{
															$page = $pdf->importPage($i);
															$pdf->AddPage();
															$pdf->useTemplate($page, ['adjustPageSize' => true]);
															$pdf->setSignature($certificate, $certificate, $marking, '', 2, $info);
															$pdf->setPageMark();
														}
														$pdf->Output(public_path().'/scan/files/'.$marking.'.pdf', 'F');
													} catch (\Exception $e) {
														$footnote = $footnote.$e->getMessage();
													}
													Inboxsurat::where('id', $rinbox->id)->update([
														'terjadwal'	=>  22,
														'footnote'	=> 	$footnote
													]);
												} else {
													$text		= NotifikasiController::getTextExternal('srtklrtnpnomor',$gceksrtklr->id);
													try {
														PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
														PDFCREATOR::SetCreator($pembuat);
														PDFCREATOR::SetAuthor($kelompok);
														PDFCREATOR::SetTitle($jenissrt);
														PDFCREATOR::SetSubject($gceksrtklr->kepada);
														PDFCREATOR::SetKeywords($perihal);
														PDFCREATOR::setPrintHeader(false);
														PDFCREATOR::setPrintFooter(false);
														PDFCREATOR::SetMargins(5, 0, 5);
														PDFCREATOR::setFontSubsetting(true);
														PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
														PDFCREATOR::AddPage('L', $page_format, false, false);
														PDFCREATOR::writeHTML($text, true, false, true, false, '');
														PDFCREATOR::setFooterMargin(0);
														$pdfdoc = PDFCREATOR::Output('', 'S');
														PDFCREATOR::reset();
														Storage::disk('local')->put('/scan/files/'.$idsurat.'.pdf', $pdfdoc);
														$text = null;
													} catch (\Exception $e) {
														$footnote = $footnote.$e->getMessage();
														$text = null;
													}
													Inboxsurat::where('id', $rinbox->id)->update([
														'terjadwal'	=>  23,
														'footnote'	=> 	$footnote
													]);
												}
											}
										}
									}
								}
							}
						}
					} else {
						if ($rinbox->tabel == 'SKDANPERATURAN'){
							$ceksek 	= Tabelskdanperaturan::where('marking', $marking)->first();
							if (isset($ceksek->marking)){
								$file 	= 'scan/files/'.$ceksek->marking.'.pdf';
								Storage::disk('local')->delete($file);
								Tabelskdanperaturan::where('id', $ceksek->id)->update([
									'tandatangan'		=> 	$ttd,
									'updated_at'		=> 	date('Y-m-d H:i:s')
								]);
								$text		= NotifikasiController::getTextExternal('formb',$ceksek->id);
								$marking 	= $ceksek->marking;
								$img_file 	= public_path('kopfooterdpm.png');
								$gethalaman = explode('<div style="page-break-before: always"></div>', $text);
								if (isset($ceksek->pembuat)){ $pembuat = $ceksek->pembuat; }
								if (isset($ceksek->kelompok)){ $kelompok = $ceksek->kelompok; }
								if (isset($ceksek->jenissrt)){ $jenissrt = $ceksek->jenissrt; }
								if (isset($ceksek->kepada)){ $kepada = $ceksek->kepada; }
								if (isset($ceksek->perihal)){ $perihal = $ceksek->perihal; }
								
								if (isset($ceksek->inputor)){ $pembuat = $ceksek->inputor; }
								if (isset($ceksek->fakultas)){ $kelompok = $ceksek->fakultas; }
								if (isset($ceksek->kelompok)){ $jenissrt = $ceksek->kelompok; }
								if (isset($ceksek->namaparaf4)){ $kepada = $ceksek->namaparaf4; }
								if (isset($ceksek->judul)){ $perihal = $ceksek->judul; }
								try {
									PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
									PDFCREATOR::SetProtection(array('modify', 'copy'), '', null, 0, null);
									PDFCREATOR::SetCreator($pembuat);
									PDFCREATOR::SetAuthor($kelompok);
									PDFCREATOR::SetTitle($jenissrt);
									PDFCREATOR::SetSubject($kepada);
									PDFCREATOR::SetKeywords($perihal);
									PDFCREATOR::setPrintHeader(false);
									PDFCREATOR::setPrintFooter(false);
									PDFCREATOR::SetMargins(5, 0, 5);
									PDFCREATOR::setFontSubsetting(true);
									PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
									foreach($gethalaman as $halaman){
										PDFCREATOR::AddPage('P', $page_format, false, false);
										$bMargin = PDFCREATOR::getBreakMargin();
										$auto_page_break = PDFCREATOR::getAutoPageBreak();
										PDFCREATOR::SetAutoPageBreak(false, 0);
										PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
										PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
										PDFCREATOR::setPageMark();
										PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
										PDFCREATOR::setFooterMargin(0);	
									}
									$pdfdoc = PDFCREATOR::Output('', 'S');
									PDFCREATOR::reset();
									Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
									$ttecount++;
								} catch (\Exception $e) {
									$footnote = $footnote.$e->getMessage();
								}
								
								Inboxsurat::where('id', $rinbox->id)->update([
									'terjadwal'	=>  10,
									'footnote'	=> 	$footnote
								]);
								$text = null;
							}
						} else {
							$ceksek 	= Suratkeluar::where('marking', $marking)->first();
							if (isset($ceksek->marking)){
								$file 	= 'scan/files/'.$ceksek->marking.'.pdf';
								Storage::disk('local')->delete($file);
								Suratkeluar::where('id', $ceksek->id)->update([
									'tandatangan'		=> 	$ttd,
									'status'			=> 	$ttd
								]);
								if ($ceksek->fakultas == 'RSPHSKR'){
									$img_file = public_path('kopfooterrsphs.png');
								} else if ($ceksek->fakultas == 'RSPHMLG'){
									$img_file = public_path('kopfooterrsphm.png');
								} else if ($ceksek->fakultas == 'PDP'){
									$img_file = public_path('kopfooterpdp.png');
								} else {
									$img_file = public_path('kopfooterdpm.png');
								}
								$text		= NotifikasiController::getTextExternal('formc',$ceksek->id);
								$marking 	= $ceksek->marking;
								$gethalaman = explode('<div style="page-break-before: always"></div>', $text);
								if (isset($ceksek->pembuat)){ $pembuat = $ceksek->pembuat; }
								if (isset($ceksek->kelompok)){ $kelompok = $ceksek->kelompok; }
								if (isset($ceksek->jenissrt)){ $jenissrt = $ceksek->jenissrt; }
								if (isset($ceksek->kepada)){ $kepada = $ceksek->kepada; }
								if (isset($ceksek->perihal)){ $perihal = $ceksek->perihal; }
								
								if (isset($ceksek->inputor)){ $pembuat = $ceksek->inputor; }
								if (isset($ceksek->fakultas)){ $kelompok = $ceksek->fakultas; }
								if (isset($ceksek->kelompok)){ $jenissrt = $ceksek->kelompok; }
								if (isset($ceksek->namaparaf4)){ $kepada = $ceksek->namaparaf4; }
								if (isset($ceksek->judul)){ $perihal = $ceksek->judul; }
								try {
									PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
									PDFCREATOR::SetCreator($pembuat);
									PDFCREATOR::SetAuthor($kelompok);
									PDFCREATOR::SetTitle($jenissrt);
									PDFCREATOR::SetSubject($kepada);
									PDFCREATOR::SetKeywords($perihal);
									PDFCREATOR::setPrintHeader(false);
									PDFCREATOR::setPrintFooter(false);
									PDFCREATOR::SetMargins(5, 0, 5);
									PDFCREATOR::setFontSubsetting(true);
									PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
									foreach($gethalaman as $halaman){
										PDFCREATOR::AddPage('P', $page_format, false, false);
										$bMargin = PDFCREATOR::getBreakMargin();
										$auto_page_break = PDFCREATOR::getAutoPageBreak();
										PDFCREATOR::SetAutoPageBreak(false, 0);
										PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
										PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
										PDFCREATOR::setPageMark();
										PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
										PDFCREATOR::setFooterMargin(0);	
									}
									$pdfdoc = PDFCREATOR::Output('', 'S');
									PDFCREATOR::reset();
									Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
									$ttecount++;
								} catch (\Exception $e) {
									$footnote = $footnote.$e->getMessage();
								}
								Inboxsurat::where('id', $rinbox->id)->update([
									'terjadwal'	=> 11,
									'footnote'	=> $footnote
								]);
								$text = null;
							} else {
								$gceksrtklr	= Suratkeluartnpnomor::where('marking', $marking)->first();
								if (isset($gceksrtklr->id)){
									$idsurat 	= $gceksrtklr->id;
									$jenissrt	= $gceksrtklr->jenissrt;
									$status 	= $gceksrtklr->status;
									$marking 	= $gceksrtklr->marking;
									$perihal 	= $gceksrtklr->perihal;
									$kelompok 	= $gceksrtklr->kelompok;
									if ($status == 'MANUAL' OR $jenissrt == 'SPO'){
										try {
											$pdf 	= new Fpdi('P','mm',array(210,330));
											$pages 	= $pdf->setSourceFile(public_path().'/scan/files/'.$marking.'.pdf');
											for ($i = 1; $i <= $pages; $i++)
											{
												$page = $pdf->importPage($i);
												$pdf->AddPage();
												$pdf->useTemplate($page, ['adjustPageSize' => true]);
												$pdf->setSignature($certificate, $certificate, $marking, '', 2, $info);
												$pdf->setPageMark();
											}
											$pdf->Output(public_path().'/scan/files/'.$marking.'.pdf', 'F');
											$ttecount++;
										} catch (\Exception $e) {
											$footnote = $footnote.$e->getMessage();
										}
										Inboxsurat::where('id', $rinbox->id)->update([
											'terjadwal'	=> 12,
											'footnote'	=> $footnote
										]);
									} else {
										$text		= NotifikasiController::getTextExternal('srtklrtnpnomor',$gceksrtklr->id);
										try {
											PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
											PDFCREATOR::SetCreator($pembuat);
											PDFCREATOR::SetAuthor($kelompok);
											PDFCREATOR::SetTitle($jenissrt);
											PDFCREATOR::SetSubject($gceksrtklr->kepada);
											PDFCREATOR::SetKeywords($perihal);
											PDFCREATOR::setPrintHeader(false);
											PDFCREATOR::setPrintFooter(false);
											PDFCREATOR::SetMargins(5, 0, 5);
											PDFCREATOR::setFontSubsetting(true);
											PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
											PDFCREATOR::AddPage('L', $page_format, false, false);
											PDFCREATOR::writeHTML($text, true, false, true, false, '');
											PDFCREATOR::setFooterMargin(0);
											$pdfdoc = PDFCREATOR::Output('', 'S');
											PDFCREATOR::reset();
											Storage::disk('local')->put('/scan/files/'.$idsurat.'.pdf', $pdfdoc);
											$text = null;
											$ttecount++;
										} catch (\Exception $e) {
											$footnote = $footnote.$e->getMessage();
											$text = null;
										}
										Inboxsurat::where('id', $rinbox->id)->update([
											'terjadwal'	=>  13,
											'footnote'	=> $footnote
										]);
									}
								}
							}
						}
					}
				}
			}
		}
		$alamatweb					= $homebase.'/trackingid/marking-'.$markingname;
		//$qrcode 					= base64_encode(QrCode::format('png')->size(100)->generate($alamatweb));
		$qrcode 					= '';
		if(Session('previlage') == 'administrasi'){
			$countsuratmasuk  		= Suratmasuk::where('fakultas', Session('fakultas'))->where('status', '!=', 'arsip')->count();
			$countsuratkeluar  		= Suratkeluar::where('fakultas', Session('fakultas'))->where('ruangarsip', '')->count();
			$countskdanperaturan  	= Tabelskdanperaturan::where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$efent  				= WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('created_by', Session('email'))->where('mulai', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->count();
			$jevent					= WebinarEventlist::where('fakultas', Session('fakultas'))->orderBy('mulai', 'DESC')->count();
			$efent					= $efent + $jevent;
		}
		if(Session('previlage') == 'Admin SDM'){
			$notifcutitahunan				= Suratkeluartnpnomor::where('jenissrt', 'Cuti Tahunan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifcutiagama					= Suratkeluartnpnomor::where('jenissrt', 'Cuti Keagamaan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifijinplgcepat				= Suratkeluartnpnomor::where('jenissrt', 'Ijin Pulang Cepat')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifijinkeluarkantor			= Suratkeluartnpnomor::where('jenissrt', 'Ijin Keluar Kantor')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpermintaanpegawai			= Suratkeluartnpnomor::where('jenissrt', 'Permintaan Pegawai')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifmutasirotasi				= Suratkeluartnpnomor::where('jenissrt', 'Mutasi Rotasi')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifkomunikasi				= Suratkeluartnpnomor::where('jenissrt', 'Komunikasi')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpengangkatanjabatan		= Tabelskdanperaturan::where('kelompok', 'Pengangkatan Jabatan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpemberhentianjabatan		= Tabelskdanperaturan::where('kelompok', 'Pemberhentian Jabatan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpegawaitetap				= Tabelskdanperaturan::where('kelompok', 'Pegawai Tetap')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifdoktertetap				= Tabelskdanperaturan::where('kelompok', 'Dokter Tetap')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpenerimaanstaf			= Tabelskdanperaturan::where('kelompok', 'Penerimaan Staf')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpenonaktifanstaf			= Tabelskdanperaturan::where('kelompok', 'Penonaktifan Staf')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpengaktifanstaf			= Tabelskdanperaturan::whereIn('kelompok', ['Pengaktifan Staf', 'Penempatan Administrasi Pendaftaran', 'Penempatan Analis Kesehatan', 'Penempatan Perawat', 'Penempatan Perekam Medik', 'Penempatan Security'])->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifmutasi					= Tabelskdanperaturan::where('kelompok', 'Mutasi')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpenonaktifandokter		= Tabelskdanperaturan::where('kelompok', 'Penonaktifan Dokter Tetap')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notiforientasikerja			= Suratkeluar::where('jenissrt', 'Perjanjian Orientasi Kerja')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpkwt						= Suratkeluar::where('jenissrt', 'PKWT')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpkwtt						= Suratkeluar::where('jenissrt', 'PKWTT')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifspo						= Suratkeluartnpnomor::where('jenissrt', 'SPO')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifedaran					= Suratkeluar::where('jenissrt', 'Edaran')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifperingatan				= Suratkeluar::where('jenissrt', 'Peringatan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifbalasanpenambahanstaf		= Suratkeluar::where('jenissrt', 'Balasan Penambahan Staf')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpermohonan				= Suratkeluar::where('jenissrt', 'Permohonan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notiftugas						= Suratkeluar::where('jenissrt', 'Tugas')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpemberitahuan				= Suratkeluar::where('jenissrt', 'Pemberitahuan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notiftanggapanresign			= Suratkeluar::where('jenissrt', 'Tanggapan Resign')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifreferensikerja			= Suratkeluar::where('jenissrt', 'Referensi Kerja')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifketeranganaktif			= Suratkeluar::where('jenissrt', 'Keterangan Aktif Bekerja')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpemutusanhubungan			= Suratkeluar::where('jenissrt', 'Pemutusan Hubungan Kerja')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpemanggilancalonkaryawan	= Suratkeluar::where('jenissrt', 'Pemanggilan Calon Karyawan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notiflolosseleksi				= Suratkeluar::where('jenissrt', 'Pemberitahuan Lolos Seleksi')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpemberitahuanmcu			= Suratkeluar::where('jenissrt', 'Pemberitahuan MCU')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifundangan					= Suratkeluar::where('jenissrt', 'Undangan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifpemanggilankie			= Suratkeluar::where('jenissrt', 'Pemanggilan KIE Staf')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifketerangantidakbekerja	= Suratkeluar::where('jenissrt', 'Keterangan Tidak Bekerja')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs01 					= Suratkeluartnpnomor::where('jenissrt', 'Tanda Terima Titipan Ijasah')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs02 					= Suratkeluartnpnomor::where('jenissrt', 'Visitor Tamu')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs03 					= Suratkeluartnpnomor::where('jenissrt', 'Konseling Staf')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs04 					= Suratkeluartnpnomor::where('jenissrt', 'Libur Akreditasi')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs05 					= Suratkeluartnpnomor::where('jenissrt', 'Serah Terima')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs06 					= Suratkeluartnpnomor::where('jenissrt', 'Riwayat Pelatihan')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs07 					= Suratkeluartnpnomor::where('jenissrt', 'Pengajuan RS')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs08 					= Suratkeluartnpnomor::where('jenissrt', 'Penyelesaian Kewajiban')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs09 					= Suratkeluartnpnomor::where('jenissrt', 'Penggabungan Libur')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs10 					= Suratkeluartnpnomor::where('jenissrt', 'Cuti MS')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs11 					= Suratkeluartnpnomor::where('jenissrt', 'Infus On Call')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs12 					= Suratkeluartnpnomor::where('jenissrt', 'Lembur')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs13 					= Suratkeluartnpnomor::where('jenissrt', 'Finger Print')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs14 					= Suratkeluartnpnomor::where('jenissrt', 'Perintah On Call')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs15 					= Suratkeluartnpnomor::where('jenissrt', 'Ijin Dokter')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs16 					= Suratkeluartnpnomor::where('jenissrt', 'Ijin Staf')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs17 					= Suratkeluartnpnomor::where('jenissrt', 'Tukar Jadwal')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs18 					= Suratkeluartnpnomor::where('jenissrt', 'Pendelegasian Tugas')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$notifformrs19 					= Suratkeluartnpnomor::where('jenissrt', 'Permohonan Karyawan Baru')->where('fakultas', Session('fakultas'))->where('arsip', '')->count();
			$persuratanptform 				= $notifcutitahunan	+ $notifcutiagama + $notifijinplgcepat + $notifijinkeluarkantor	+ $notifpermintaanpegawai + $notifmutasirotasi + $notifkomunikasi;
			$persuratanptkd 				= $notifpengangkatanjabatan + $notifpemberhentianjabatan + $notifpegawaitetap + $notifdoktertetap + $notifpenerimaanstaf + $notifpenonaktifanstaf + $notifpengaktifanstaf + $notifmutasi + $notifpenonaktifandokter;
			$persuratanptkk 				= $notiforientasikerja + $notifpkwt + $notifpkwtt;
			$persuratanptss 				= $notifedaran + $notifperingatan + $notifbalasanpenambahanstaf + $notifpermohonan + $notiftugas + $notifpemberitahuan + $notiftanggapanresign + $notifreferensikerja + $notifketeranganaktif + $notifpemutusanhubungan + $notifpemanggilancalonkaryawan + $notiflolosseleksi + $notifpemberitahuanmcu + $notifundangan + $notifpemanggilankie + $notifketerangantidakbekerja;
			$persuratanrs 					= $notifformrs01 + $notifformrs02 + $notifformrs03 + $notifformrs04 + $notifformrs05 + $notifformrs06 + $notifformrs07 + $notifformrs08 + $notifformrs09 + $notifformrs10 + $notifformrs11 + $notifformrs12 + $notifformrs13 + $notifformrs14 + $notifformrs15 + $notifformrs16 + $notifformrs17 + $notifformrs18 + $notifformrs19;
				
		}
		if (Session('previlage') == 'PEJABAT'){
			$cekselesai	= 0;
			$jmerangkap	= User::where('username', Session('username'))->first();
			if (isset($jmerangkap->merangkap)){
				$merangkap		= $jmerangkap->merangkap;
				if (is_null($merangkap)){ $merangkap = ''; }
			} else { $merangkap = ''; }
			$ceksrtmasuk	= Inboxsurat::Where('email', 'LIKE', Session('email'))->where('jenis', 'MASUK')->whereNotIn('status', ['reply', 'deleted'])->groupBy('marking')->get();
			if ($merangkap != ''){
				$countmemo		= Inboxsurat::whereIn('pengirim', [Session('jabatan'), $merangkap])->where('jenis', 'MASUK')->whereNotIn('status', ['reply', 'deleted'])->where('jenissrt', 'MEMO')->count();
				$countnotadinas	= Inboxsurat::whereIn('pengirim', [Session('jabatan'), $merangkap])->where('jenis', 'MASUK')->whereNotIn('status', ['reply', 'deleted'])->where('jenissrt', 'NOTA DINAS')->count();
				
				$ceksrtkeluar	= Inboxsurat::whereIn('penerima', [Session('jabatan'), $merangkap])
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->get();
				$cekmari		= DB::table('tbl_inbox')
								->join('tbl_suratmasuk', 'tbl_inbox.marking', 'tbl_suratmasuk.marking')
								->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')
								->whereIn('tbl_inbox.penerima', [Session('jabatan'), $merangkap])
								->where('tbl_suratmasuk.status', 'LIKE', '%'.'arsip'.'%')
								->whereYear('tbl_suratmasuk.tglmasuk', date('Y'))
								->orderBy('tbl_inbox.marking', 'DESC')
								->count();
				$cekrungmari	= DB::table('tbl_inbox')
								->join('tbl_suratmasuk', 'tbl_suratmasuk.marking', 'tbl_inbox.marking')
								->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')
								->whereIn('tbl_inbox.penerima', [Session('jabatan'), $merangkap])
								->where('tbl_suratmasuk.status', 'NOT LIKE', '%'.'arsip'.'%')
								->whereYear('tbl_suratmasuk.tglmasuk', date('Y'))
								->orderBy('tbl_inbox.marking', 'DESC')
								->count();
			} else {
				$countmemo		= Inboxsurat::where('pengirim', Session('jabatan'))->where('jenis', 'MASUK')->whereIn('status', ['send', 'read'])->where('jenissrt', 'MEMO')->count();
				$countnotadinas	= Inboxsurat::where('pengirim', Session('jabatan'))->where('jenis', 'MASUK')->whereIn('status', ['send', 'read'])->where('jenissrt', 'NOTA DINAS')->count();
				
				$ceksrtkeluar	= Inboxsurat::where('penerima', Session('jabatan'))
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->get();
				$cekmari		= DB::table('tbl_inbox')
								->join('tbl_suratmasuk', 'tbl_inbox.marking', 'tbl_suratmasuk.marking')
								->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')
								->where('tbl_inbox.penerima', Session('jabatan'))
								->where('tbl_suratmasuk.status', 'LIKE', '%'.'arsip'.'%')
								->whereYear('tbl_suratmasuk.tglmasuk', date('Y'))
								->orderBy('tbl_inbox.marking', 'DESC')
								->count();
				$cekrungmari	= DB::table('tbl_inbox')
								->join('tbl_suratmasuk', 'tbl_suratmasuk.marking', 'tbl_inbox.marking')
								->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')
								->where('tbl_inbox.penerima', Session('jabatan'))
								->where('tbl_suratmasuk.status', 'NOT LIKE', '%'.'arsip'.'%')
								->whereYear('tbl_suratmasuk.tglmasuk', date('Y'))
								->orderBy('tbl_inbox.marking', 'DESC')
								->count();
		
			}
			$mailbox 		= count($ceksrtmasuk);
			$countmohonttd 	= count($ceksrtkeluar);
		} else {
			$mailbox			= Inboxsurat::where('email', 'LIKE', Session('email'))->where('status', 'send')->where('jenis', 'MASUK')->count();
			$cekselesai 		= Suratkeluar::where('pembuat', Session('email'))->where('arsip', '')->where('tandatangan', 'SIgned With TTE')->count();
			$cekditolak 		= Inboxsurat::where('pembuat', Session('email'))->where('jenis', 'KELUAR')->where('status', 'Ditolak')->get();
			if (!empty($cekditolak)){
				foreach($cekditolak as $rtolak){
					$textnotif 	= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-arrow-circle-right"></i> '.$rtolak->nosurat.' Mohon di Koreksi</a>';
				}
			}
		}
		$penerimasurat			= Penerimasurat::where('penulisan', Session('email'))->where('status', 'SEND')->count();
		$mailbox				= $mailbox + $penerimasurat;
		if ($mailbox != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-book mr-2"></i> '.$mailbox.' new messages</a>';
		}
		if ($cekselesai != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-trophy mr-2"></i> '.$cekselesai.' Surat Keluar di Tandatangani dan Belum di Arsip</a>';
		}
		if ($countmohonttd != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-paper-plane-o mr-2"></i> '.$countmohonttd.' Surat Perlu Paraf/TTE</a>';
		}
		if ($countnotadinas != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-paper-plane-o mr-2"></i> '.$countnotadinas.' Nota Dinas Belum di Arsip</a>';
		}
		if ($countmemo != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-paper-plane-o mr-2"></i> '.$countmemo.' Memo Belum di Arsip</a>';
		}
		if ($countsuratmasuk != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-envelope mr-2"></i> '.$countsuratmasuk.' Surat Masuk</a>';
		}
		if ($countsuratkeluar != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-paper-plane-o mr-2"></i> '.$countsuratkeluar.' Surat Keluar</a>';
		}
		if ($countskdanperaturan != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-clone mr-2"></i> '.$countskdanperaturan.' SK dan Peraturan</a>';
		}
		if ($efent != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-calendar-plus-o mr-2"></i> '.$efent.' Kegiatan</a>';
		}
		if ($persuratanptform != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-book mr-2"></i> '.$persuratanptform.' Form Persuratan PT Belum di Arsip</a>';
		}
		if ($persuratanptkd != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-book mr-2"></i> '.$persuratanptkd.' Keputusan Direktur Belum di Arsip</a>';
		}
		if ($persuratanptkk != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-book mr-2"></i> '.$persuratanptkk.' Kontrak Kerja Belum di Arsip</a>';
		}
		if ($persuratanptss != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-book mr-2"></i> '.$persuratanptss.' Surat Belum di Arsip</a>';
		}
		if ($persuratanrs != 0){
			$textnotif 			= $textnotif.'<div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-book mr-2"></i> '.$persuratanrs.' Form Persuratan RS Belum di Arsip</a>';
		}
		$counttotalnotif		= $persuratanrs + $persuratanptss + $persuratanptkk + $persuratanptform + $persuratanptkd + $mailbox + $countsuratmasuk + $countsuratkeluar + $countskdanperaturan + $efent + $countmohonttd;
		return response()->json([
			'markingname' 					=> $markingname, 
			'qrcode' 						=> $countsql.' => '.$ttecount.' (TTE) '.$parafcount.' (PARAF)',
			'textnotif' 					=> $textnotif, 
			'counttotalnotif' 				=> $counttotalnotif, 
			'countmailbox' 					=> $mailbox, 
			'countmohonttd' 				=> $countmohonttd, 
			'countnotadinas' 				=> $countnotadinas, 
			'countmemo' 					=> $countmemo, 
			'countsuratmasuk' 				=> $countsuratmasuk, 
			'countsuratkeluar' 				=> $countsuratkeluar, 
			'countsk' 						=> $countskdanperaturan, 
			'countevent' 					=> $efent,
			'notifcutitahunan' 				=> $notifcutitahunan,
			'notifcutiagama' 				=> $notifcutiagama,
			'notifijinplgcepat' 			=> $notifijinplgcepat,
			'notifijinkeluarkantor' 		=> $notifijinkeluarkantor,
			'notifpermintaanpegawai' 		=> $notifpermintaanpegawai,
			'notifmutasirotasi' 			=> $notifmutasirotasi,
			'notifkomunikasi' 				=> $notifkomunikasi,
			'notifpengangkatanjabatan' 		=> $notifpengangkatanjabatan,
			'notifpemberhentianjabatan'		=> $notifpemberhentianjabatan,
			'notifpegawaitetap' 			=> $notifpegawaitetap,
			'notifdoktertetap' 				=> $notifdoktertetap,
			'notifpenerimaanstaf' 			=> $notifpenerimaanstaf,
			'notifpenonaktifanstaf' 		=> $notifpenonaktifanstaf,
			'notifpengaktifanstaf' 			=> $notifpengaktifanstaf,
			'notifmutasi' 					=> $notifmutasi,
			'notifpenonaktifandokter'		=> $notifpenonaktifandokter,
			'notiforientasikerja' 			=> $notiforientasikerja,
			'notifpkwt' 					=> $notifpkwt,
			'notifpkwtt' 					=> $notifpkwtt,
			'notifspo' 						=> $notifspo,
			'notifedaran' 					=> $notifedaran,
			'notifperingatan' 				=> $notifperingatan,
			'notifbalasanpenambahanstaf'	=> $notifbalasanpenambahanstaf,
			'notifpermohonan' 				=> $notifpermohonan,
			'notiftugas' 					=> $notiftugas,
			'notifpemberitahuan' 			=> $notifpemberitahuan,
			'notiftanggapanresign' 			=> $notiftanggapanresign,
			'notifreferensikerja' 			=> $notifreferensikerja,
			'notifketeranganaktif' 			=> $notifketeranganaktif,
			'notifpemutusanhubungan' 		=> $notifpemutusanhubungan,
			'notifpemanggilancalonkaryawan'	=> $notifpemanggilancalonkaryawan,
			'notiflolosseleksi' 			=> $notiflolosseleksi,
			'notifpemberitahuanmcu' 		=> $notifpemberitahuanmcu,
			'notifundangan' 				=> $notifundangan,
			'notifpemanggilankie' 			=> $notifundangan,
			'notifketerangantidakbekerja'	=> $notifketerangantidakbekerja,
			'notifformrs01'					=> $notifformrs01,
			'notifformrs02'					=> $notifformrs02,
			'notifformrs03'					=> $notifformrs03,
			'notifformrs04'					=> $notifformrs04,
			'notifformrs05'					=> $notifformrs05,
			'notifformrs06'					=> $notifformrs06,
			'notifformrs07'					=> $notifformrs07,
			'notifformrs08'					=> $notifformrs08,
			'notifformrs09'					=> $notifformrs09,
			'notifformrs10'					=> $notifformrs10,
			'notifformrs11'					=> $notifformrs11,
			'notifformrs12'					=> $notifformrs12,
			'notifformrs13'					=> $notifformrs13,
			'notifformrs14'					=> $notifformrs14,
			'notifformrs15'					=> $notifformrs15,
			'notifformrs16'					=> $notifformrs16,
			'notifformrs17'					=> $notifformrs17,
			'notifformrs18'					=> $notifformrs18,
			'notifformrs19'					=> $notifformrs19,
		]);
		return back();
	
    }
	public function simpanDatadiri(Request $request) {
		$jenisnip 		= '';
		$bidangilmu2	= '';
		$pangkat 		= '';
		$statjabatan 	= 'Tendik';
		$status_pegawai	= '';
		$masterno  		= $request->input('val01');
		$nip    		= $request->input('val02');
		$nama    		= $request->input('val03');
		$tmplhr    		= $request->input('val04');
		$tgllhr    		= $request->input('val05');
		$ktp    		= $request->input('val06');
		$kelamin    	= $request->input('val07');
		$glrdepan    	= $request->input('val08');
		$glrblakang    	= $request->input('val09');
		$glrdepan2    	= $request->input('val10');
		$glrblakang2    = $request->input('val11');
		$bidangilmu    	= $request->input('val12');
		$alamatmlg    	= $request->input('val13');
		$alamatasal    	= $request->input('val14');
		$propinsi    	= $request->input('val15');
		$kota    		= $request->input('val16');
		$agama    		= $request->input('val17');
		$kawin    		= $request->input('val18');
		$status_jabatan	= $request->input('val19');
		$hape    		= $request->input('val20');
		$emailub    	= $request->input('val21');
		$emaillain    	= $request->input('val22');
		$unitkerja    	= $request->input('val23');
		$laborat    	= $request->input('val24');
		$status    		= $request->input('val25');
		$jenispeg    	= $request->input('val26');
		$nidn    		= $request->input('val27');
		$tahunmsk    	= $request->input('val28');
		$cpns    		= $request->input('val29');
		$tmtcpns    	= $request->input('val30');
		$pns    		= $request->input('val31');
		$tmtpns    		= $request->input('val32');
		$jenis    		= $request->input('val33');
		$niplama    	= $request->input('val34');
		$karpeg    		= $request->input('val35');
		$nira    		= $request->input('val36');
		$npwp    		= $request->input('val37');
		$bpjs    		= $request->input('val38');
		$homebase    	= $request->input('val39');
		$kelurahan    	= $request->input('val40');
		$kecamatan    	= $request->input('val41');
		$jabfungsional	= $request->input('val42');
		$golongan    	= $request->input('val43');
		$tmtgolongan    = $request->input('val44');
		$tmtjabatan    	= $request->input('val45');
		$jabatan  		= $request->input('val46');
		$tmtfungsional  = $request->input('val47');
		$kode    		= $request->input('val48');
		$tinggibdn    	= $request->input('val49');
		$beratbdn    	= $request->input('val50');
		$warnakulit   	= $request->input('val51');
		$rambut    		= $request->input('val52');
		$muka    		= $request->input('val53');
		$cirikusus    	= $request->input('val54');
		$cacattubuh   	= $request->input('val55');
		$hobi    		= $request->input('val56');
		$kepakaran    	= $request->input('val57');
		$nokk  			= $request->input('val58');
		$bidangilmu3  	= $request->input('val59');
		$kelas    		= $request->input('val61');
		$gaji    		= $request->input('val62');
		$tmtgaji    	= $request->input('val63');
		$ppabp    		= $request->input('val64');
		$telpon			= $hape;
		$skpns			= $pns;
		$getps 			= MasterPS::where('id', $homebase)->first();
		if(isset($getps->nama)){
			$prodi 		= $getps->nama;
			$jenjang 	= $getps->jenjang;
		} else {
			$prodi		= $homebase;
			$jenjang	= '-';
		}
		$getnamagol 	= Golongan::where('kode', $golongan)->first();
		if (isset($getnamagol->id)){
			$golongan	= $getnamagol->golongan;
			$pangkat 	= $getnamagol->kode;
		}
		$nmlengkap		= $nama;
		if ($glrdepan == '' OR is_null($glrdepan)){
			
		} else {
			$nmlengkap	= $glrdepan.' '.$nmlengkap;
		}
		if ($glrblakang == '' OR is_null($glrblakang)){
			
		} else {
			$nmlengkap	= $nmlengkap.', '.$glrblakang;
		}
		if ($ktp == '' OR $ktp == Session('username')){ $ktp = $nip; }
		if ($nip == '' AND $ktp != ''){ $nip = $ktp; }
		if ($emailub == '' AND $emaillain != ''){ $emailub = $emaillain; }
		if ($nip == '' OR $emailub == '' OR $nama == ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Wajib Terisi : Nama, Email, Nomor Induk Kepegawaian']);
			return back();
		} else {
			
			if ($masterno == 'new'){
				$cekemail 	= Simpegpegawai::where('email_ub', $emailub)->count();
				$ceknip 	= Simpegpegawai::where('nik', $ktp)->count();
			} else {
				$cekemail 	= Simpegpegawai::where('id','!=', $masterno)->where('email_ub', $emailub)->count();
				$ceknip 	= Simpegpegawai::where('id','!=', $masterno)->where('nik', $ktp)->count();
			}
			if ($cekemail != 0){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Terdeteksi Double di Pegawai lain']);
				return back();
			} else {
				if ($ceknip != 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Nomor Induk Kepegawaian Terdeteksi Double di Pegawai lain']);
					return back();
				} else {
					if ($masterno == 'new'){
						$update 	= Simpegpegawai::create([
							'jenispeg'					=> $jenispeg,
							'fungsional'				=> '',
							'nik'						=> $ktp,
							'nokk'						=> $nokk, 
							'nama_lengkap'				=> $nmlengkap, 
							'nama'						=> $nama,
							'depan'						=> $glrdepan, 
							'belakang'					=> $glrblakang,
							'depandinilai'				=> $glrdepan2,
							'belakangdinilai'			=> $glrblakang2,
							'jenisnip'					=> $jenis,
							'nip_lama'					=> $niplama,
							'nip_baru'					=> $nip, 
							'nidn'						=> $nidn,
							'jenis_kelamin'				=> $kelamin,
							'tmpt_lahir'				=> $tmplhr,
							'tgl_lahir'					=> $tgllhr,
							'usia'						=> 0,
							'pangkat'					=> $pangkat,
							'golongan'					=> $golongan, 
							'namabank'					=> '', 
							'norek'						=> '', 
							'namapdrekening'			=> $nama, 
							'gajisesuaisk'				=> $gaji,
							'gajibarublmmsk'			=> $gaji, 
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
							'npwp'						=> $npwp, 
							'statusnpwp'				=> $kawin,
							'status'					=> $status,
							'keterangan'				=> '', 
							'tmt_golongan'				=> $tmtgolongan,
							'jab_fungsional'			=> $jabfungsional,
							'tmt_fungsional'			=> $tmtfungsional, 
							'tmt_pensiun'				=> null,
							'thn_pensiun'				=> null,
							'cpns'						=> $cpns,
							'pns'						=> $pns,
							'tmt_cpns'					=> $tmtcpns,
							'tmt_pns'					=> $tmtpns,
							'thn_masuk'					=> $tahunmsk,
							'unit_kerja'				=> $unitkerja,
							'bidang_ilmu'				=> $bidangilmu,
							'lab'						=> $laborat,
							'program_studi'				=> $homebase,
							'sertifikasi'				=> '', 
							'pend_akhir'				=> '',
							'ijasah_diakui'				=> '',
							'status_pegawai'			=> $status,
							'masa_kerja'				=> '', 
							'status_jabatan'			=> $status_jabatan, 
							'karpeg'					=> $karpeg,
							'agama'						=> $agama,
							'alamat'					=> $alamatasal,
							'no_hp'						=> $hape,
							'kode'						=> $kode, 
							'foto'						=> '', 
							'tmtgaji'					=> $tmtgaji,
							'tmtpangkat'				=> $tmtjabatan, 
							'ppabp'						=> $ppabp, 
							'jabatan'					=> $jabatan, 
							'proses_pangkat'			=> '', 
							'angka_kredit'				=> '', 
							'email'						=> $emaillain,
							'email_ub'					=> $emailub,
							'lama_tubel'				=> '', 
							'lama_kenaikan_pangkat'		=> '', 
							'tmt_tubel'					=> '',
							'tinggibdn'					=>	$tinggibdn,
							'beratbdn'					=>	$beratbdn,
							'rambut'					=>	$rambut,
							'muka'						=>	$muka,
							'warnakulit'				=>	$warnakulit,
							'cirikusus'					=>	$cirikusus,
							'cacattubuh'				=>	$cacattubuh,
							'hobi'						=>	$hobi,
							'idremun'					=> 	$kelas,
						]);
						$masterno	= $update->id;
						$emaillama	= $emailub;
					} else {
						$getdatalm	= Simpegpegawai::where('id', $masterno)->first();
						$id			= $getdatalm->id;
						$namalama	= $getdatalm->nama_lengkap;
						$emaillama	= $getdatalm->email_ub;
						$update		= Simpegpegawai::where('id', $masterno)->update([
							'jenispeg'					=> $jenispeg,
							'nik'						=> $ktp,
							'nokk'						=> $nokk, 
							'nama_lengkap'				=> $nmlengkap, 
							'nama'						=> $nama,
							'depan'						=> $glrdepan, 
							'belakang'					=> $glrblakang,
							'depandinilai'				=> $glrdepan2,
							'belakangdinilai'			=> $glrblakang2,
							'jenisnip'					=> $jenis,
							'nip_lama'					=> $niplama,
							'nip_baru'					=> $nip, 
							'nidn'						=> $nidn,
							'jenis_kelamin'				=> $kelamin,
							'tmpt_lahir'				=> $tmplhr,
							'tgl_lahir'					=> $tgllhr,
							'pangkat'					=> $pangkat,
							'golongan'					=> $golongan, 
							'namapdrekening'			=> $nama, 
							'gajisesuaisk'				=> $gaji,
							'npwp'						=> $npwp, 
							'statusnpwp'				=> $kawin,
							'status'					=> $status,
							'tmt_golongan'				=> $tmtgolongan,
							'jab_fungsional'			=> $jabfungsional,
							'tmt_fungsional'			=> $tmtfungsional, 
							'cpns'						=> $cpns,
							'pns'						=> $pns,
							'tmt_cpns'					=> $tmtcpns,
							'tmt_pns'					=> $tmtpns,
							'thn_masuk'					=> $tahunmsk,
							'unit_kerja'				=> $unitkerja,
							'bidang_ilmu'				=> $bidangilmu,
							'lab'						=> $laborat,
							'program_studi'				=> $homebase,
							'status_pegawai'			=> $status,
							'status_jabatan'			=> $status_jabatan, 
							'karpeg'					=> $karpeg,
							'agama'						=> $agama,
							'alamat'					=> $alamatasal,
							'no_hp'						=> $hape,
							'kode'						=> $kode, 
							'tmtgaji'					=> $tmtgaji,
							'tmtpangkat'				=> $tmtjabatan, 
							'ppabp'						=> $ppabp, 
							'jabatan'					=> $jabatan, 
							'email'						=> $emaillain,
							'email_ub'					=> $emailub,
							'tinggibdn'					=> $tinggibdn,
							'beratbdn'					=> $beratbdn,
							'rambut'					=> $rambut,
							'muka'						=> $muka,
							'warnakulit'				=> $warnakulit,
							'cirikusus'					=> $cirikusus,
							'cacattubuh'				=> $cacattubuh,
							'hobi'						=> $hobi,
							'idremun'					=> $kelas,
							'updated_at'				=> date("Y-m-d H:i:s"), 
						]);
					}
					if ($update){
					    $getfakultas 	= User::where('fakpanjang', $ppabp)->first();
						if (isset($getfakultas->fakultas)){
							$fakultas	= $getfakultas->fakultas;
						} else {
							$fakultas	= '';
						}
						if ($emaillama != $emailub){
							if ($fakultas != ''){
								User::where('email', $emaillama)->update([
									'nama'			=> $nmlengkap,
									'email'			=> $emailub,
									'fakpanjang'	=> $ppabp,
									'fakultas'		=> $fakultas
								]);
							} else {
								User::where('email', $emaillama)->update([
									'nama'			=> $nmlengkap,
									'email'			=> $emailub,
								]);
							}
							User::where('username', $emaillama)->update([
								'username'	=> $emailub
							]);
							Inboxsurat::where('email', $emaillama)->update([
								'penerima' 	=> $nmlengkap,
								'email'		=> $emailub
							]);
							Suratkeluar::where('pembuat', $emaillama)->update([
								'pembuat'		=> $emailub
							]);
							Suratkeluartnpnomor::where('pembuat', $emaillama)->update([
								'pembuat'		=> $emailub
							]);
							Tabelskdanperaturan::where('inputor', $emaillama)->update([
								'inputor'		=> $emailub
							]);
							Draftsk::where('konseptor', $emaillama)->update([
								'konseptor'		=> $emailub
							]);
						} else {
							if ($fakultas != ''){
								User::where('email', $emaillama)->update([
									'nama'			=> $nmlengkap,
									'fakpanjang'	=> $ppabp,
									'fakultas'		=> $fakultas
								]);
							} else {
								User::where('email', $emaillama)->update([
									'nama'			=> $nmlengkap,
								]);
							}
							Inboxsurat::where('email', $emailub)->update([
								'penerima' 	=> 	$nmlengkap
							]);
						}
						
						if($request->hasFile('file')) {
							$getfotolama 	= Simpegpegawai::where('id', $masterno)->first();
							if (isset($getfotolama->foto)){
								$fotolama		= $getfotolama->foto;
								if (File::exists(base_path()) ."/public/images/pegawai/". $fotolama) {
								File::delete(base_path() ."/public/images/pegawai/". $fotolama);
								}
							}
							$ekstensi 	= strtolower($request->file->getClientOriginalExtension());
							if ($ekstensi == 'jpg' OR $ekstensi == 'png' OR $ekstensi == 'jpeg'){
								$file 		= time().'.'.$ekstensi;
								$request->file->move(public_path('images/pegawai'), $file);	
							}
							Simpegpegawai::where('id', $masterno)->update([
								'foto'  =>  $file
							]);
							User::where('id', Session('id'))->update([
								'photo'  =>  $file
							]);
						}
						$cekdatalama 	= Detailpegawai::where('no', $masterno)->count();
						if ($cekdatalama == 0){
							Detailpegawai::create([
								'no'			=> $masterno, 
								'ktp'			=> $ktp, 
								'gelardepan'	=> $glrdepan, 
								'gelarblakang'	=> $glrblakang, 
								'gelardepan2'	=> $glrdepan2, 
								'gelarblakang2'	=> $glrblakang2, 
								'bidangilmu'	=> $bidangilmu, 
								'alamatmlg'		=> $alamatmlg, 
								'kelurahan'		=> $kelurahan, 
								'kecamatan'		=> $kecamatan, 
								'propinsi'		=> $propinsi, 
								'kota'			=> $kota, 
								'kawin'			=> $kawin, 
								'emailub'		=> $emailub, 
								'emaillain'		=> $emaillain, 
								'skcpns'		=> $cpns, 
								'tmtcpns'		=> $tmtcpns, 
								'skpns'			=> $skpns, 
								'tmtpns'		=> $tmtpns, 
								'nira'			=> $nira, 
								'npwp'			=> $npwp, 
								'bpjs'			=> $bpjs, 
								'tinggibdn'		=> $tinggibdn, 
								'beratbdn'		=> $beratbdn, 
								'bentukrambut'	=> $rambut, 
								'bentukmuka'	=> $muka, 
								'warnakulit'	=> $warnakulit, 
								'cirikusus'		=> $cirikusus, 
								'cacattubuh'	=> $cacattubuh, 
								'hobi'			=> $hobi, 
								'nomoridi'			=> $request->input('val65'), 
								'keanggotaanprofesi'=> $request->input('val66'), 
								'nomorstr'			=> $request->input('val67'), 
								'nomorsip1'			=> $request->input('val68'), 
								'nomorsip2'			=> $request->input('val69'), 
								'nomorsip3'			=> $request->input('val70'), 
								'google'			=> $request->input('val71'), 
								'shinta'			=> $request->input('val72'), 
								'scopus'			=> $request->input('val73'), 
								'orcid'				=> $request->input('val74'), 
								'timestamp'			=> date('Y-m-d H:i')
							]);
						} else {
							Detailpegawai::where('no', $masterno)->update([
								'no'			=> $masterno, 
								'ktp'			=> $ktp, 
								'gelardepan'	=> $glrdepan, 
								'gelarblakang'	=> $glrblakang, 
								'gelardepan2'	=> $glrdepan2, 
								'gelarblakang2'	=> $glrblakang2, 
								'bidangilmu'	=> $bidangilmu, 
								'alamatmlg'		=> $alamatmlg, 
								'kelurahan'		=> $kelurahan, 
								'kecamatan'		=> $kecamatan, 
								'propinsi'		=> $propinsi, 
								'kota'			=> $kota, 
								'kawin'			=> $kawin, 
								'emailub'		=> $emailub, 
								'emaillain'		=> $emaillain, 
								'skcpns'		=> $cpns, 
								'tmtcpns'		=> $tmtcpns, 
								'skpns'			=> $skpns, 
								'tmtpns'		=> $tmtpns, 
								'nira'			=> $nira, 
								'npwp'			=> $npwp, 
								'bpjs'			=> $bpjs, 
								'tinggibdn'		=> $tinggibdn, 
								'beratbdn'		=> $beratbdn, 
								'bentukrambut'	=> $rambut, 
								'bentukmuka'	=> $muka,  
								'warnakulit'	=> $warnakulit, 
								'cirikusus'		=> $cirikusus, 
								'cacattubuh'	=> $cacattubuh, 
								'hobi'			=> $hobi, 
								'nomoridi'			=> $request->input('val65'), 
								'keanggotaanprofesi'=> $request->input('val66'), 
								'nomorstr'			=> $request->input('val67'), 
								'nomorsip1'			=> $request->input('val68'), 
								'nomorsip2'			=> $request->input('val69'), 
								'nomorsip3'			=> $request->input('val70'), 
								'google'			=> $request->input('val71'), 
								'shinta'			=> $request->input('val72'), 
								'scopus'			=> $request->input('val73'), 
								'orcid'				=> $request->input('val74'), 
								'timestamp'			=> date('Y-m-d H:i')
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Master Biodata Anda Telah terupdate']);
						return back();
					}
					else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada data yang di ubah']);
						return back();
					}
				}
			}
		}
	}
}
