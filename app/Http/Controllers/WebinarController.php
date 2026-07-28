<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SendMail;
use App\User;
use App\Firebasebank;
use App\WebinarEventlist;
use App\WebinarPartisipan;
use App\WebinarJawaban;
use App\WebinarPertanyaan;
use App\Simpegpegawai;
use App\Suratkeluar;
use App\Pejabatsurat;
use App\Chatting;
use App\Suratkeluartnpnomor;
use App\Inboxsurat;
use Validator;
use Session;
use QrCode;
use PDF;
use Auth;
use DateTime;
use Redirect;
use Carbon\Carbon;

class WebinarController extends Controller
{
	public function loginwebinar() {
        $tasks		= [];
		$tasks['sidebar']	= 'frontpage';
		$previlage  =  Session('previlage');
        if ($previlage != '') {
            return redirect('webinar');
        } else {
           return view('webinar.login', $tasks);
        }
    }
	public function viewWebinar() {
		$previlage  =  Session('previlage');
        if ($previlage != '') {
			return redirect('dashboardwebinar');
		} else {
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
			$data		= [];
			$homebase	= url("/");
			$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$jadwals	= WebinarEventlist::where('mulai', '>', 'subdate(current_date, 1)')->orderBy('mulai', 'DESC')->get();
			if (!empty($jadwals)){
				$x 		= 0;
				$y		= 0;
				$from	= Carbon::now();
				foreach ($jadwals as $rowpeng) {
					$mulai     		=   $rowpeng->mulai;
					$created_at     =   $rowpeng->created_at;
					$kapan          =   timeAgo($created_at);
					$to     		=   Carbon::createFromFormat('Y-m-d H:s:i', $mulai);
					$diff_in_days 	= 	$from->diffInDays($to);
					if($to < $from){ $diff_in_days = 0 - $diff_in_days; }
					if ($diff_in_days <= 0){
						$iconne 	= 'fa fa-battery-4';
						$werno	 	= 'red';
						$persen		= '100';
					} else if ($diff_in_days <= 10){
						$iconne 	= 'fa fa-battery-4';
						$werno	 	= 'red';
						$persen		= '90';
					} else if ($diff_in_days <= 30){
						$iconne 	= 'fa fa-battery-2';
						$werno	 	= 'yellow';
						$persen		= '60';
					} else {
						$iconne 	= 'fa fa-battery-empty';
						$werno	 	= 'green';
						$persen		= '30';
					}
					if ($diff_in_days == 1){
						$hari 		= 'will start tomorrow';
					} else if ($diff_in_days == 0){
						$hari 		= 'this day event';
					} else if ($diff_in_days < 0){
						$hari 		= 'already ended';
					} else {
						$hari 		= 'will begin in '.$diff_in_days.' days from now';
					}
					if ($rowpeng->bayar == 0){
						$bayar 		= 'free tickects';
					} else {
						$bayar 		= 'IDR '.$rowpeng->bayar.' for a tickects';
					}
					if ($rowpeng->kapasitas == 0){
						$kapasitas 	= 'unlimited participant';
					} else {
						$kapasitas 	= 'Limited to '.$rowpeng->kapasitas.' participant only';
					}
					$urle								= 	$homebase.'/register/'.$rowpeng->id;
					$data['webinar'][$x]['id']          =   $rowpeng->id;
					$data['webinar'][$x]['urle']        =   $urle;
					$data['webinar'][$x]['nama']     	=   $rowpeng->nama;
					$data['webinar'][$x]['tanggal']     =   $rowpeng->tanggal;
					$data['webinar'][$x]['mulai']       =   $rowpeng->mulai;
					$data['webinar'][$x]['kapan']    	=   $kapan;
					$data['webinar'][$x]['bayar']       =   $bayar;
					$data['webinar'][$x]['persen']      =   $persen;
					$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
					$data['webinar'][$x]['pembicara']   =   $rowpeng->pembicara;
					$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
					$data['webinar'][$x]['kapasitas']  	=   $kapasitas;
					$data['webinar'][$x]['hari']  		=   $hari;
					$data['webinar'][$x]['iconne']		=   $iconne;
					$data['webinar'][$x]['werno'] 		=   $werno;

					if ($y == 9) {
						$y = 0; 
					} else {
						$y++; 
					}
					$x++;
				}
			}
			$data['sidebar']	= 'dashboard';
			return view('webinar.dashbord', $data);
		}
    }
    public function authenticatewebinar(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
        ]);

        if($validator->fails()) {
            Session::flash('message', 'Username dan Password Harus diisi');
            return back();
        } else {
            $username   =   $request->username;
            $password   =   $request->password;
			$firebaseid =   $request->firebaseid;
            $auth = Auth::attempt([
                'username' => $username,
                'password' => $password
            ]);

            if(!$auth) {
				Session::flash('message', 'Username atau password anda salah');
				return back();
            }

            $user  		 	= User::where('username', $request->username)->first();
			$idne 			= $user->id;
			$previlage 		= $user->previlage;
			$fakultas 		= $user->fakultas;
			$foto 			= $user->foto;
			if ($foto == ''){
				$homebase	= url("/");
				$foto 		= $homebase.'/dist/img/admin.png';
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
			session(['id' 			=> $user->id]);
            session(['nama' 		=> $user->nama]);
            session(['username' 	=> $user->username]);
            session(['previlage'	=> $previlage]);
			session(['fakultas' 	=> $fakultas]);
			session(['fakpanjang' 	=> $user->fakpanjang]);
            session(['spesial' 		=> $user->spesial]);
			session(['foto' 		=> $foto]);			
            return redirect('dashboardwebinar');
        }
    }
	public function getKalenderlistwebinar(Request $request) {
		$data       =   [];
		$idne		= 	'';
		$homebase	= 	url("/");
		$jenis   	=   $request->val01;
		$lokasi   	=   $request->val02;
		$nama   	=   $request->val03;
		$tmulai   	=   $request->val04;
		$tselesai  	=   $request->val05;
		if ($tmulai == 'now'){
			$jadwals	= WebinarEventlist::where('mulai', '>', 'subdate(current_date, 1)')
					->orderBy('mulai', 'DESC')
					->get();
		} else {
			$mulai		= $tmulai.' 00:00:00';
			$akhir		= $tselesai.' 23:59:00';
			if ($tselesai == ''){
				$jadwals	= WebinarEventlist::where('mulai', '>', $mulai)
					->orderBy('mulai', 'DESC')
					->get();
			} else {
				$jadwals   	= WebinarEventlist::where('mulai', '>', $mulai)
							->where('akhir', '<', $akhir)
							->orderBy('mulai', 'DESC')
							->get();
			}
		}
		$idne 	= '';
		
		if (!empty($jadwals)){
			foreach ($jadwals as $hcari) {
				$start 		= date("Y-m-d H:i",strtotime($hcari->mulai));
				$end 		= date("Y-m-d H:i",strtotime($hcari->akhir));
				if ($idne == ''){ $idne = 'id1'; }
				else { $idne = $hcari->id; }
				$urle		= $homebase.'/register/'.$hcari->id;
				if (Session('previlage') == null){
					$tulisan 	= $hcari->nama.'<br />'.$hcari->tempat;
				} else {
					$tulisan 	= $hcari->nama.'<br />'.$hcari->tempat.'<br /><p></p><a href="'.$urle.'" class="btn btn-link text-danger text-gradient px-3 mb-0"><i class="fa fa-calendar"></i>REGISTER NOW</a>';
				}
				$data[] 	= array(
					'id' 			=> $idne,
					'description' 	=> $hcari->tempat,
					'location' 		=> $hcari->tanggal,
					'subject' 		=> $tulisan,
					'calendar' 		=> $hcari->tempat,
					'start' 		=> $start,
					'end'			=> $end,
				);
			}
		} else {
			$mulai		= date('Y-m-d H:i:s');
			$tambah		= ' + 360 second';
			$akhir		= date('Y-m-d h:i:s',strtotime($tambah,strtotime($mulai)));
			$tulis 		= 'No Event';
			if ($idne == ''){ $idne = 'id1'; }
			else { $idne = $hcari->id; }
			$data[] 	= array(
				'id' 			=> $idne,
				'description' 	=> 'Duidev Software House',
				'location' 		=> 'Malang',
				'subject' 		=> $tulis,
				'calendar' 		=> 'Duidev Software House',
				'start' 		=> $mulai,
				'end'			=> $akhir,
			);
		}
		
    	echo json_encode($data);
    }
	public function index() {
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
		$data		= [];
		$homebase	= url("/");
		$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		//$jadwals	= WebinarEventlist::orderBy('mulai', 'DESC')->get();
		$jadwals	= WebinarEventlist::where('mulai', '>', 'subdate(current_date, 1)')->orderBy('mulai', 'DESC')->get();
		if (!empty($jadwals)){
			$x 		= 0;
			$y		= 0;
			$from	= Carbon::now();
			foreach ($jadwals as $rowpeng) {
				$mulai     		=   $rowpeng->mulai;
				$created_at     =   $rowpeng->created_at;
				$kapan          =   timeAgo($created_at);
				$to     		=   Carbon::createFromFormat('Y-m-d H:s:i', $mulai);
				$diff_in_days 	= 	$from->diffInDays($to);
				if($to < $from){ $diff_in_days = 0 - $diff_in_days; }
				if ($diff_in_days <= 0){
					$iconne 	= 'fa fa-battery-4';
					$werno	 	= 'red';
					$persen		= '100';
				} else if ($diff_in_days <= 10){
					$iconne 	= 'fa fa-battery-4';
					$werno	 	= 'red';
					$persen		= '90';
				} else if ($diff_in_days <= 30){
					$iconne 	= 'fa fa-battery-2';
					$werno	 	= 'yellow';
					$persen		= '60';
				} else {
					$iconne 	= 'fa fa-battery-empty';
					$werno	 	= 'green';
					$persen		= '30';
				}
				if ($diff_in_days == 1){
					$hari 		= 'will start tomorrow';
				} else if ($diff_in_days == 0){
					$hari 		= 'this day event';
				} else if ($diff_in_days < 0){
					$hari 		= 'already ended';
				} else {
					$hari 		= 'will begin in '.$diff_in_days.' days from now';
				}
				if ($rowpeng->bayar == 0){
					$bayar 		= 'free tickects';
				} else {
					$bayar 		= 'IDR '.$rowpeng->bayar.' for a tickects';
				}
				if ($rowpeng->kapasitas == 0){
					$kapasitas 	= 'unlimited participant';
				} else {
					$kapasitas 	= 'Limited to '.$rowpeng->kapasitas.' participant only';
				}
				$urle								= 	$homebase.'/register/'.$rowpeng->id;
				$data['webinar'][$x]['id']          =   $rowpeng->id;
				$data['webinar'][$x]['urle']        =   $urle;
				$data['webinar'][$x]['nama']     	=   $rowpeng->nama;
				$data['webinar'][$x]['tanggal']     =   $rowpeng->tanggal;
				$data['webinar'][$x]['mulai']       =   $rowpeng->mulai;
				$data['webinar'][$x]['kapan']    	=   $kapan;
				$data['webinar'][$x]['bayar']       =   $bayar;
				$data['webinar'][$x]['persen']      =   $persen;
				$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
				$data['webinar'][$x]['pembicara']   =   $rowpeng->pembicara;
				$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
				$data['webinar'][$x]['kapasitas']  	=   $kapasitas;
				$data['webinar'][$x]['hari']  		=   $hari;
				$data['webinar'][$x]['iconne']        =   $iconne;
				$data['webinar'][$x]['werno'] =   $werno;

				if ($y == 9) {
					$y = 0; 
				} else {
					$y++; 
				}
				$x++;
			}
		}
        
		$data['sidebar']	= 'dashboard';
    	return view('webinar.admin.frontpage', $data);
    }
	public function logoutwebinar(Request $request) {
        Auth::logout();
        $request->session()->regenerate();
        $request->session()->flush();
        return redirect('webinar');
    }
	public function geteventList(Request $request) {
		$arrevent	= array();
		$homebase	= url("/");
		$idevent	= $request->input('val01');
		if ($idevent == 'all'){
			$jevent	= WebinarEventlist::where('created_by', Session('email'))->orwhere('created_by', Session('nama'))->orderBy('mulai', 'DESC')->get();
		} else {
			if (Session('email') !== null){
				if (Session('previlage') == 'administrasi'){
					$jevent		= WebinarEventlist::where('fakultas', Session('fakultas'))->orderBy('mulai', 'DESC')->limit('100')->get();
				} else {
					$jevent		= WebinarEventlist::where('created_by', Session('email'))->orwhere('created_by', Session('nama'))->orderBy('mulai', 'DESC')->limit('100')->get();
				}
			} else {
				$jevent		= WebinarEventlist::where('fakultas', Session('fakultas'))->orderBy('mulai', 'DESC')->limit('100')->get();
			}
		}
		if (!empty($jevent)){
			foreach ($jevent as $revent) {
				$idne 		= $revent->id;
				$nama 		= $revent->nama;
				$urle		= $homebase.'/register/'.$revent->id;
				$url2		= $homebase.'/hadir/'.$revent->id;
				$url3		= $homebase.'/cetaklinkpresensi/'.$revent->id;
				$tlskegiatan= '<a href="'.$urle.'" target="_blank">'.$nama.'</a>';
				$peserta	= WebinarPartisipan::where('idevent', $idne)->count();			
				$arrevent[] = array(
					'idne'			=> $idne,
					'tlskegiatan'	=> $tlskegiatan,
					'peserta'		=> $peserta,
					'nama'			=> $revent->nama, 
					'tempat'		=> $revent->tempat, 
					'kapasitas'		=> $revent->kapasitas, 
					'tanggal'		=> $revent->tanggal, 
					'mulai'			=> $revent->mulai, 
					'akhir'			=> $revent->akhir, 
					'bayar'			=> $revent->bayar, 
					'kontak'		=> $revent->kontak, 
					'pembicara'		=> $revent->pembicara, 
					'daftarmulai'	=> $revent->daftarmulai, 
					'daftarakhir'	=> $revent->daftarakhir, 
					'absenmulai'	=> $revent->absenmulai, 
					'absenakhir'	=> $revent->absenakhir, 
					'created_by'	=> $revent->created_by, 
					'linkwebniar'	=> $revent->linkwebniar
				);
			}
		}
		echo json_encode($arrevent);
	}
	public function getListpartisipan(Request $request) {
    	$idevent	= $request->input('val01');
		$jenis		= $request->input('val02');
		$arrpartis	= array();
		$homebase	= url("/");
		if ($jenis == '' OR $jenis == null){
			$jevent = WebinarPartisipan::where('idevent', $idevent)->orderBy('id', 'ASC')->get();
		} else {
			if ($jenis == 'UNDANGAN'){
				$jevent		= WebinarPartisipan::where('pekerjaan', 'UNDANGAN')->where('idevent', $idevent)->orderBy('id', 'ASC')->get();
			} else if ($jenis == 'notulensi'){
				$arrpartis	= DB::table('dpmtech_dummyproject.webinar_participan')->join('dpmtech_dummyproject.webinar_event', 'dpmtech_dummyproject.webinar_participan.idevent', 'dpmtech_dummyproject.webinar_event.id')->select('dpmtech_dummyproject.webinar_participan.*', 'dpmtech_dummyproject.webinar_event.nama as namaevent', 'dpmtech_dummyproject.webinar_event.tempat as tempatevent', 'dpmtech_dummyproject.webinar_event.tanggal as tglevent', 'dpmtech_dummyproject.webinar_event.mulai as startevent')->where('dpmtech_dummyproject.webinar_participan.email', $request->input('val01'))->orderBy('dpmtech_dummyproject.webinar_event.mulai', 'DESC')->get();
        		$jevent		= [];
			} else {
				$jevent		= WebinarPartisipan::where('pekerjaan', '!=', 'UNDANGAN')->where('idevent', $idevent)->orderBy('id', 'ASC')->get();
			}
		}
		if (!empty($jevent)){
			foreach ($jevent as $revent) {
				$idne 		= $revent->id;
				$foto 		= $revent->foto;
				if ($foto != ''){
					$foto = '<img src="'.$foto.'" height="35" />';
				}
				$sertifikat	= $homebase.'/certificate/'.$idne;
				$daftarhdr	= $homebase.'/presentform/'.$idne;
				$evaluasi	= $homebase.'/evform/'.$idne;
				$info		= $homebase.'/info/'.$idevent;
				//$linke 	= $daftarhdr.'%0A'.$evaluasi;
				$linke		= 'Dear%20Participants,%20This%20is%20reminder%20event.​%0aPlease%20click%20this%20link%20for%20detail​%0a'.$info;
				$linke 		= 'https://api.whatsapp.com/send?phone='.$revent->hape.'&text='.$linke;
				$arrpartis[] = array(
					'idne'			=> $revent->id,
					'linke'			=> $linke,
					'idevent'		=> $idevent, 
					'nama'			=> $revent->nama, 
					'pekerjaan'		=> $revent->pekerjaan, 
					'alamat'		=> $revent->alamat, 
					'negara'		=> $revent->negara, 
					'instansi'		=> $revent->instansi, 
					'email'			=> $revent->email,
					'hape'			=> $revent->hape, 
					'daftar'		=> $revent->daftar, 
					'quiz'			=> $revent->quiz, 
					'presensi'		=> $revent->presensi, 
					'status'		=> $revent->status, 
					'bayar'			=> $revent->bayar, 
					'foto'			=> ''
				);
			}
		}
		echo json_encode($arrpartis);
	}
	public function getListhasilevent(Request $request) {
    	$idevent	= $request->input('val01');
		$arrpartis	= array();
		$homebase	= url("/");
		$jevent		= WebinarPartisipan::where('idevent', $idevent)->orderBy('id', 'ASC')->get();
		if (!empty($jevent)){
			foreach ($jevent as $revent) {
				$idne 		= $revent->id;
				$satu 		= '';
				$dua		= '';
				$tiga 		= '';
				$empat		= '';
				$lima		= '';
				$enam		= '';
				$tujuh		= '';
				$saran		= '';
				$cekjawab	= WebinarJawaban::where('idevent', $idevent)->where('idpeserta', $idne)->count();
				if ($cekjawab != 0){
					$getjwb	= WebinarJawaban::where('idevent', $idevent)->where('idpeserta', $idne)->first();
					$satu 	= $getjwb->satu;
					$dua	= $getjwb->dua;
					$tiga 	= $getjwb->tiga;
					$empat	= $getjwb->empat;
					$lima	= $getjwb->lima;
					$enam	= $getjwb->enam;
					$tujuh	= $getjwb->tujuh;
					$saran	= $getjwb->saran;
				}
				$arrpartis[] = array(
					'idne'			=> $revent->id,
					'idevent'		=> $idevent,
					'nama'			=> $revent->nama, 
					'pekerjaan'		=> $revent->pekerjaan, 
					'alamat'		=> $revent->alamat, 
					'negara'		=> $revent->negara, 
					'instansi'		=> $revent->instansi, 
					'email'			=> $revent->email,
					'hape'			=> $revent->hape, 
					'daftar'		=> $revent->daftar, 
					'quiz'			=> $revent->quiz, 
					'presensi'		=> $revent->presensi, 
					'status'		=> $revent->status, 
					'bayar'			=> $revent->bayar,
					'satu'			=> $satu,
					'dua'			=> $dua, 
					'tiga'			=> $tiga, 
					'empat'			=> $empat, 
					'lima'			=> $lima, 
					'enam'			=> $enam, 
					'tujuh'			=> $tujuh, 
					'saran'			=> $saran, 
				);
			}
		}
		echo json_encode($arrpartis);
	}
	public function getListpartisipanok(Request $request) {
    	$idevent	= $request->input('val01');
		$arrpartis	= array();
		$homebase	= url("/");
		$jevent		= WebinarPartisipan::where('idevent', $idevent)->where('presensi', '!=', '0000-00-00 00:00:00')->orderBy('updated_at', 'DESC')->get();
		if (!empty($jevent)){
			foreach ($jevent as $revent) {
				$idne 		= $revent->id;
				$foto 		= $revent->foto;
				$arrpartis[] = array(
					'idne'			=> $revent->id,
					'idevent'		=> $idevent, 
					'nama'			=> $revent->nama, 
					'pekerjaan'		=> $revent->pekerjaan, 
					'alamat'		=> $revent->alamat, 
					'negara'		=> $revent->negara, 
					'instansi'		=> $revent->instansi, 
					'email'			=> $revent->email,
					'hape'			=> $revent->hape, 
					'daftar'		=> $revent->daftar, 
					'quiz'			=> $revent->quiz, 
					'presensi'		=> $revent->presensi, 
					'status'		=> $revent->status, 
					'bayar'			=> $revent->bayar, 
					'foto'			=> $foto
				);
			}
		}
		echo json_encode($arrpartis);
	}
	public function exSaveevent(Request $request) {
    	$idne	= $request->input('set20');
		if ($idne == 'hapuspeserta'){
			$getdata= WebinarPartisipan::where('id', $request->input('set02'))->first();
			$hapus	= WebinarPartisipan::where('id', $request->input('set02'))->delete();
			if($hapus){
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Remove Panitia an. '.$getdata->nama,
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$getdata->idevent
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Anggota an. '.$request->input('set01').' Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Anggota an. '.$request->input('set01').' with ID '.$request->input('set02').' Cannot be Found']);
				return back();
			}
		} else {
			$nama			= $request->input('set01');
			$tempat			= $request->input('set02');
			$kapasitas		= $request->input('set03');
			$biaya			= $request->input('set04');
			$tglmulai		= $request->input('set05');
			$jammulai		= $request->input('set06');
			$tglakhir		= $request->input('set07');
			$jamakhir		= $request->input('set08');
			$tglmulaidaftar	= $request->input('set09');
			$jammulaidaftar	= $request->input('set10');
			$tglakhirdaftar	= $request->input('set11');
			$jamakhirdaftar	= $request->input('set12');
			$tglmulaiabsen	= $request->input('set13');
			$jammulaiabsen	= $request->input('set14');
			$tglakhirabsen	= $request->input('set15');
			$jamakhirabsen	= $request->input('set16');
			$kontak			= $request->input('set17');
			$pembicara		= $request->input('set18');
			$linkweb		= $request->input('set19');
			$linkmateri		= $request->input('set21');
			if($idne != 'hapus'){
				$arraymulai		= explode(" ", $jammulaiabsen);
				$jmulai 		= $arraymulai[0];
				if (isset($arraymulai[1])){
					$cmulai 		= $arraymulai[1];
					$arrayjmulai	= explode(":", $jmulai);
					$hhmulai		= (int)$arrayjmulai[0];
					$mmmulai		= $arrayjmulai[1];
					if ($cmulai == 'AM'){
						if ($hhmulai < 10){
							$mulaiabsen = $tglmulaiabsen.' 0'.$hhmulai.':'.$mmmulai.':00';
						}else {
							$mulaiabsen = $tglmulaiabsen.' '.$hhmulai.':'.$mmmulai.':00';
						}
					}else {
						$hhmulai 	    = $hhmulai + 12;
						$mulaiabsen 	= $tglmulaiabsen.' '.$hhmulai.':'.$mmmulai.':00';
					}
				} else {
					$mulaiabsen 	= $tglmulaiabsen.' '.$jammulaiabsen;
				}
				$arrayselesai	= explode(" ", $jamakhirabsen);
				$jselesai 		= $arrayselesai[0];
				if (isset($arrayselesai[1])){
					$cselesai 		= $arrayselesai[1];
					$arrayjselesai	= explode(":", $jselesai);
					$hhselesai		= $arrayjselesai[0];
					$mmselesai		= $arrayjselesai[1];
					if ($cselesai == 'AM'){
						if ($hhselesai < 10){
							$akhirabsen = $tglakhirabsen.' 0'.$hhselesai.':'.$mmselesai.':00';
						}else {
							$akhirabsen = $tglakhirabsen.' '.$hhselesai.':'.$mmselesai.':00';
						}
					}else {
						$hhselesai 	    = $hhselesai + 12;
						$akhirabsen 	= $tglakhirabsen.' '.$hhselesai.':'.$mmselesai.':00';
					}
				} else {
					$akhirabsen 	= $tglakhirabsen.' '.$jamakhirabsen;
				}
				$arraymulai		= explode(" ", $jammulaidaftar);
				$jmulai 		= $arraymulai[0];
				if (isset($arraymulai[1])){
					$cmulai 		= $arraymulai[1];
					$arrayjmulai	= explode(":", $jmulai);
					$hhmulai		= (int)$arrayjmulai[0];
					$mmmulai		= $arrayjmulai[1];
					if ($cmulai == 'AM'){
						if ($hhmulai < 10){
							$mulaidaftar = $tglmulaidaftar.' 0'.$hhmulai.':'.$mmmulai.':00';
						}else {
							$mulaidaftar = $tglmulaidaftar.' '.$hhmulai.':'.$mmmulai.':00';
						}
					}else {
						$hhmulai 	     = $hhmulai + 12;
						$mulaidaftar 	 = $tglmulaidaftar.' '.$hhmulai.':'.$mmmulai.':00';
					}
				} else {
					$mulaidaftar 	 = $tglmulaidaftar.' '.$jammulaidaftar;
				}
				$arrayselesai	= explode(" ", $jamakhirdaftar);
				if (isset($arrayselesai[1])){
					$jselesai 		= $arrayselesai[0];
					$cselesai 		= $arrayselesai[1];
					$arrayjselesai	= explode(":", $jselesai);
					$hhselesai		= $arrayjselesai[0];
					$mmselesai		= $arrayjselesai[1];
					if ($cselesai == 'AM'){
						if ($hhselesai < 10){
							$akhirdaftar = $tglakhirdaftar.' 0'.$hhselesai.':'.$mmselesai.':00';
						}else {
							$akhirdaftar = $tglakhirdaftar.' '.$hhselesai.':'.$mmselesai.':00';
						}
					}else {
						$hhselesai 	     = $hhselesai + 12;
						$akhirdaftar     = $tglakhirdaftar.' '.$hhselesai.':'.$mmselesai.':00';
					}
				} else {
					$akhirdaftar     = $tglakhirdaftar.' '.$jamakhirdaftar;
				}
				
				$arraymulai		= explode(" ", $jammulai);
				if (isset($arraymulai[1])){
					$jmulai 		= $arraymulai[0];
					$cmulai 		= $arraymulai[1];
					$arrayjmulai	= explode(":", $jmulai);
					$hhmulai		= (int)$arrayjmulai[0];
					$mmmulai		= $arrayjmulai[1];
					if ($cmulai == 'AM'){
						if ($hhmulai < 10){
							$mulai = $tglmulai.' 0'.$hhmulai.':'.$mmmulai.':00';
						}else {
							$mulai = $tglmulai.' '.$hhmulai.':'.$mmmulai.':00';
						}
					}else {
						$hhmulai 	= $hhmulai + 12;
						$mulai 		= $tglmulai.' '.$hhmulai.':'.$mmmulai.':00';
					}
				} else {
					$mulai 		= $tglmulai.' '.$jammulai;
				}
				$arrayselesai	= explode(" ", $jamakhir);
				if (isset($arrayselesai[1])){
					$jselesai 		= $arrayselesai[0];
					$cselesai 		= $arrayselesai[1];
					$arrayjselesai	= explode(":", $jselesai);
					$hhselesai		= $arrayjselesai[0];
					$mmselesai		= $arrayjselesai[1];
					if ($cselesai == 'AM'){
						if ($hhselesai < 10){
							$akhir = $tglakhir.' 0'.$hhselesai.':'.$mmselesai.':00';
						}else {
							$akhir = $tglakhir.' '.$hhselesai.':'.$mmselesai.':00';
						}
					}else {
						$hhselesai 	= $hhselesai + 12;
						$akhir 		= $tglakhir.' '.$hhselesai.':'.$mmselesai.':00';
					}
				} else {
					$akhir 		= $tglakhir.' '.$jamakhir;
				}
				if ($idne == 'new'){
					$input = WebinarEventlist::create([
						'nama'			=> $nama, 
						'tempat'		=> $tempat, 
						'kapasitas'		=> $kapasitas, 
						'tanggal'		=> $tglmulai, 
						'mulai'			=> $mulai, 
						'akhir'			=> $akhir, 
						'bayar'			=> $biaya, 
						'kontak'		=> $kontak, 
						'pembicara'		=> $pembicara, 
						'daftarmulai'	=> $mulaidaftar, 
						'daftarakhir'	=> $akhirdaftar, 
						'absenmulai'	=> $mulaiabsen, 
						'absenakhir'	=> $akhirabsen, 
						'created_by'	=> Session('email'), 
						'linkwebniar'	=> $linkweb,
						'linkmateri'	=> $linkmateri,
						'fakultas'		=> Session('fakultas'),
					]);
					if($input){
						$idne 		= $input->id;
						$ceksudah 	= WebinarPartisipan::where('idevent', $idne)->where('email', Session('email'))->count();
						if ($ceksudah == 0){
							$absen 	= WebinarPartisipan::insertGetId([
								'idevent'		=> $idne, 
								'nama'			=> Session('nama'),
								'pekerjaan'		=> Session('jabatan'),
								'alamat'		=> Session('fakpanjang'),
								'negara'		=> 'Indonesia',
								'instansi'		=> '',
								'email'			=> Session('email'),
								'hape'			=> '',
								'namabank'		=> '',
								'norek'			=> '',
								'daftar'		=> '0000-00-00 00:00:00',
								'quiz'			=> '0000-00-00 00:00:00',
								'presensi'		=> '0000-00-00 00:00:00',
								'status'		=> 'Creator',
								'bayar'			=> '0',
								'foto'			=> ''
							]);
						}
						if ($request->hasFile('depan')) {						
							$jenfile= $request->file('depan')->getClientOriginalExtension();
							$file   = time().'.'.$request->file('depan')->getClientOriginalExtension();
							$request->file->move(public_path('dist/img/sertifikat'), $file);
							WebinarEventlist::where('id', $idne)->update([
								'sertifikatdepan' => $file
							]);
						}
						if ($request->hasFile('belakang')) {						
							$jenfile= $request->file('belakang')->getClientOriginalExtension();
							$file   = time().'.'.$request->file('belakang')->getClientOriginalExtension();
							$request->file->move(public_path('dist/img/sertifikat'), $file);
							WebinarEventlist::where('id', $idne)->update([
								'sertifikatbelakang' => $file
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Event Tersimpan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
						return back();
					}
				} else {
					$input = WebinarEventlist::where('id', $idne)->update([
						'nama'			=> $nama, 
						'tempat'		=> $tempat, 
						'kapasitas'		=> $kapasitas, 
						'tanggal'		=> $tglmulai, 
						'mulai'			=> $mulai, 
						'akhir'			=> $akhir, 
						'bayar'			=> $biaya, 
						'kontak'		=> $kontak, 
						'pembicara'		=> $pembicara, 
						'daftarmulai'	=> $mulaidaftar, 
						'daftarakhir'	=> $akhirdaftar, 
						'absenmulai'	=> $mulaiabsen, 
						'absenakhir'	=> $akhirabsen, 
						'created_by'	=> Session('email'), 
						'linkwebniar'	=> $linkweb,
						'linkmateri'	=> $linkmateri
					]);
					if($input){
						$ceksudah 	= WebinarPartisipan::where('idevent', $idne)->where('email', Session('email'))->count();
						if ($ceksudah == 0){
							$absen 	= WebinarPartisipan::insertGetId([
								'idevent'		=> $idne, 
								'nama'			=> Session('nama'),
								'pekerjaan'		=> Session('jabatan'),
								'alamat'		=> Session('fakpanjang'),
								'negara'		=> 'Indonesia',
								'instansi'		=> '',
								'email'			=> Session('email'),
								'hape'			=> '',
								'namabank'		=> '',
								'norek'			=> '',
								'daftar'		=> '0000-00-00 00:00:00',
								'quiz'			=> '0000-00-00 00:00:00',
								'presensi'		=> '0000-00-00 00:00:00',
								'status'		=> 'Creator',
								'bayar'			=> '0',
								'foto'			=> ''
							]);
						}
						if ($request->hasFile('depan')) {
							$get 			= WebinarEventlist::where('id', $idne)->first();
							if (isset($get->sertifikatdepan)){
								$sertifikatdepan 	= $get->sertifikatdepan;
								if (File::exists(base_path()) ."/public/dist/img/sertifikat/". $sertifikatdepan) {
								File::delete(base_path() ."/public/dist/img/sertifikat/". $sertifikatdepan);
								}
							}
							$jenfile= $request->file('depan')->getClientOriginalExtension();
							$file   = time().'.'.$request->file('depan')->getClientOriginalExtension();
							$request->file->move(public_path('dist/img/sertifikat'), $file);
							WebinarEventlist::where('id', $idne)->update([
								'sertifikatdepan' => $file
							]);
						}
						if ($request->hasFile('belakang')) {
							$get 			= WebinarEventlist::where('id', $idne)->first();
							if (isset($get->sertifikatbelakang)){
								$sertifikatbelakang 	= $get->sertifikatbelakang;
								if (File::exists(base_path()) ."/public/dist/img/sertifikat/". $sertifikatbelakang) {
								File::delete(base_path() ."/public/dist/img/sertifikat/". $sertifikatbelakang);
								}
							}
							$jenfile= $request->file('belakang')->getClientOriginalExtension();
							$file   = time().'.'.$request->file('belakang')->getClientOriginalExtension();
							$request->file->move(public_path('dist/img/sertifikat'), $file);
							WebinarEventlist::where('id', $idne)->update([
								'sertifikatbelakang' => $file
							]);
						}
						Chatting::insert([
							'kelompok'  	=>  Session('previlage'),
							'nama'  		=>  Session('nama'),
							'pesannya'		=>  'Update Profile Event',
							'ket'			=>  Session('avatar'),
							'id_sekolah'	=>	$idne
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Event Updated']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
						return back();
					}
				}
			} else {
				$hapus 		= WebinarEventlist::where('id', $tempat)->delete();
				$cekpeserta	= WebinarPartisipan::where('idevent', $tempat)->count();
				if ($cekpeserta == 0){
					if($hapus){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Event '.$nama.' Deleted']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Failed to Delete, Please Try Again in a few years']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Event yang sudah ada pesertanya tidak bisa di hapus']);
					return back();
				}
			}
		}
	}
	public function exRegisterevent(Request $request) {
    	$nama		= $request->input('set01');
    	$pekerjaan	= $request->input('set02');
    	$alamat		= $request->input('set03');
    	$negara		= $request->input('set04');
    	$instansi	= $request->input('set05');
    	$email		= $request->input('set06');
    	$idevent	= $request->input('set07');
		$hape		= $request->input('set08');
    	$cekemail 	= WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->count();
		if ($cekemail == 0){
			if ($pekerjaan == ''){ $pekerjaan = '-'; }
			if ($instansi == ''){ $instansi = '-'; }
			if ($alamat == ''){ $alamat = '-'; }
			if ($hape == ''){ $hape = '-'; }
			if($request->hasFile('file')) {
				$ImageExt	= $request->file('file')->getClientOriginalExtension();
				$file_tmp	= $request->file('file');
				$data 		= file_get_contents($file_tmp);
				$foto 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
			} else {
				$foto 		= '';
			}
			$input = WebinarPartisipan::insertGetId([
				'idevent'		=> $idevent, 
				'nama'			=> $nama, 
				'pekerjaan'		=> $pekerjaan, 
				'alamat'		=> $alamat, 
				'negara'		=> $negara, 
				'instansi'		=> $instansi, 
				'email'			=> $email,
				'hape'			=> $hape,
				'daftar'		=> date('Y:m:d H:i'), 
				'quiz'			=> '0000-00-00 00:00:00', 
				'presensi'		=>'0000-00-00 00:00:00', 
				'status'		=> 'new', 
				'bayar'			=> '0', 
				'foto'			=> $foto
			]);
			if($input){
				if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG' OR Session('fakultas') == 'DPM'){
					Chatting::insert([
						'kelompok'  	=>  Session('previlage'),
						'nama'  		=>  Session('nama'),
						'pesannya'		=>  'Add Undangan an. '.$nama.' ( '.$instansi.' )',
						'ket'			=>  Session('avatar'),
						'id_sekolah'	=>	$idevent
					]);
				} else {
					$homebase		= url("/");
					$alamatweb		= $homebase.'/register/'.$idevent;
					$absen			= $homebase.'/presentform/'.$input;
					$getdataeven 	= WebinarEventlist::where('id', $idevent)->first();				
					$emailbody 		= '
						<p>Hi '.$nama.'</p><br />
						<p>Thank you. Registration for "'.$getdataeven->nama.'" Accepted</p>
						<p>Joint From a PC, MAC, IPad, IPhone or Android Device :</p>
							'.$getdataeven->linkwebniar.'
							<p>Webinar Rules (for participants):</p>
							<ol>
								<li>Participants have to register via our webinar registration system <br /> <a href="'.config('global.mrindomain').'">'.config('global.mrindomain').'</a></li>
								<li>Participants join the webinar using the name similar to as registered </li>
								<li>By Default, participants audio are muted during the webinar session</li>
								<li>Participants are only be able to chat with speakers and host</li>
								<li>If participants wish to ask a question, please type in the chat room. The moderator will select the questions to the speakers appointed during discussion session.</li>
								<li>The host will remove non-compliant participants for mutual webinar convenience</li>
								<li>Link of the attendance will be shared during webinar and evaluation forms is 30 minutes before the session end. Both link will be shared at Zoom chat room.</li>
							</ol>
							For your information, please note the links below:
							'.$getdataeven->kontak.'
							<p>Agenda :</p>
						'.$getdataeven->pembicara.'
					';
					$sendstatus	= 'Email Send';
					$perihal	= 'Registration Approved for '.$getdataeven->nama;
					$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
					if ($email != ''){
						try {
							Mail::send('email',
								array(
									'isisurat' => $emailbody,
								), function($message) use ($email, $perihal){
								$message->from('client@duidev.com');
								$message->to($email)->subject($perihal);
							});
						} catch (\Exception $e) {
							$sendstatus = ' Failed Send Email to '.$email;
						}
					}
					WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->update([					
						'status'		=> $sendstatus
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Register Success, Please Cek Your Email']);
				return back();
			} else {
				
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else {
			if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG' OR Session('fakultas') == 'DPM'){
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Add Undangan an. '.$nama.' ( '.$instansi.' )',
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$idevent
				]);
			} else {
				$homebase		= url("/");
				$alamatweb		= $homebase.'/register/'.$idevent;
				$absen			= $homebase.'/presentform/'.$input;
				$getdataeven 	= WebinarEventlist::where('id', $idevent)->first();				
				$emailbody 		= '
					<p>Hi '.$nama.'</p><br />
					<p>Thank you. Registration for "'.$getdataeven->nama.'" Accepted</p>
					<p>Joint From a PC, MAC, IPad, IPhone or Android Device :</p>
						'.$getdataeven->linkwebniar.'
						<p>Webinar Rules (for participants):</p>
						<ol>
							<li>Participants have to register via our webinar registration system <br /> <a href="'.config('global.mrindomain').'">'.config('global.mrindomain').'</a></li>
							<li>Participants join the webinar using the name similar to as registered </li>
							<li>By Default, participants audio are muted during the webinar session</li>
							<li>Participants are only be able to chat with speakers and host</li>
							<li>If participants wish to ask a question, please type in the chat room. The moderator will select the questions to the speakers appointed during discussion session.</li>
							<li>The host will remove non-compliant participants for mutual webinar convenience</li>
							<li>Link of the attendance will be shared during webinar and evaluation forms is 30 minutes before the session end. Both link will be shared at Zoom chat room.</li>
						</ol>
						For your information, please note the links below:
						'.$getdataeven->kontak.'
						<p>Agenda :</p>
					'.$getdataeven->pembicara.'
				';
				$sendstatus	= 'Email Send';
				$perihal	= 'Registration Approved for '.$getdataeven->nama;
				$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
				if ($email != ''){
					try {
						Mail::send('email',
							array(
								'isisurat' => $emailbody,
							), function($message) use ($email, $perihal){
							$message->from('client@duidev.com');
							$message->to($email)->subject($perihal);
						});
					} catch (\Exception $e) {
						$sendstatus = ' Failed Send Email to '.$email;
					}
				}
			}
			
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Email already used for this event']);
			return back();
		}
	}
	public function exMailer(Request $request) {
		ini_set('max_execution_time', 7200);
		set_time_limit(0);
    	$idevent	= $request->input('val01');
    	$jenis		= $request->input('val02');
    	$arridne	= $request->input('val03');
		$sukses		= 0;
		$error		= '';
		$sendstatus	= $jenis;
		$homebase	= url("/");
		$alamatweb	= $homebase.'/register/'.$idevent;
		$getdataeven= WebinarEventlist::where('id', $idevent)->first();
		if (!empty($arridne)){
			foreach($arridne as $rid){
				$getpartisipan	= WebinarPartisipan::where('id', $rid)->first();
				$email			= $getpartisipan->email;
				$absen			= $homebase.'/presentform/'.$rid;
				$certificate 	= $homebase.'/certificate/'.$rid;
				$evaluasi 		= $homebase.'/evform/'.$rid;
				$getdataeven 	= WebinarEventlist::where('id', $idevent)->first();
				if ($jenis == 'undangan'){
					$emailbody 		= '
						<p>Dear '.$getpartisipan->nama.'</p><br />
						<p>Thank you. Registration for "'.$getdataeven->nama.'" </p>
						<p>Joint From a PC, MAC, IPad, IPhone or Android Device :</p>
						'.$getdataeven->linkwebniar.'
						<p>Webinar Rules (for participants):</p>
						<ol>
							<li>Participants have to register via our webinar registration system <br /> <a href="'.config('global.mrindomain').'">'.config('global.mrindomain').'</a></li>
							<li>Participants join the webinar using the name similar to as registered </li>
							<li>By Default, participants audio are muted during the webinar session</li>
							<li>Participants are only be able to chat with speakers and host</li>
							<li>If participants wish to ask a question, please type in the chat room. The moderator will select the questions to the speakers appointed during discussion session.</li>
							<li>The host will remove non-compliant participants for mutual webinar convenience</li>
						</ol>
						For your information, please note the links below:
						'.$getdataeven->kontak.'
						<p>Agenda :</p>
						'.$getdataeven->pembicara;
					$sendstatus	= 'Email Re Send';
					$perihal	= 'Registration Approved for '.$getdataeven->nama;
					$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
				} else if ($jenis == 'evaluasi'){
					$emailbody 		= '
						<p>Dear '.$getpartisipan->nama.'</p><br />
						<p>Thank you for attending '.$getdataeven->nama.'. We Hope you enjoyed our event</p>
						For your information, please note the links below:
						'.$getdataeven->kontak.'
						<p></p>
						We look forward to your valuable feedback, please click on the link to help us understand what we can do better
						<p></p>
						<font color="blue"><b>'.$evaluasi.'</b></font>
						<p></p>
						Thanks
						Team '.config('global.mrinhomename');
					$sendstatus	= 'Evaluasion Send';
					$perihal	= 'We Need Your Feedback for '.$getdataeven->nama;
					$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
				} else if ($jenis == 'reminder'){
					$emailbody 		= '
						<p>Dear '.$getpartisipan->nama.'</p><br />
						<p>This is reminder for '.$getdataeven->nama.'</p>
						<p>Joint From a PC, MAC, IPad, IPhone or Android Device :</p>
						'.$getdataeven->linkwebniar.'
						<p>Webinar Rules (for participants):</p>
						<ol>
							<li>Participants have to register via our webinar registration system <br /> <a href="'.config('global.mrindomain').'">'.config('global.mrindomain').'</a></li>
							<li>Participants join the webinar using the name similar to as registered </li>
							<li>By Default, participants audio are muted during the webinar session</li>
							<li>Participants are only be able to chat with speakers and host</li>
							<li>If participants wish to ask a question, please type in the chat room. The moderator will select the questions to the speakers appointed during discussion session.</li>
							<li>The host will remove non-compliant participants for mutual webinar convenience</li>
						</ol>
						For your information, please note the links below:
						'.$getdataeven->kontak.'
						<p>Agenda :</p>
						'.$getdataeven->pembicara;
					$sendstatus	= 'Reminder Send';
					$perihal	= 'Reminder for '.$getpartisipan->nama;
					$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
				} else {
					$emailbody 		= '
						<p>Dear '.$getpartisipan->nama.'</p><br />
						<p>Hereby we sent to you the certificate of participation in '.$getdataeven->nama.'. The name written on the certificate is the name that you filled in the Registration Form. Please note that the name written on the certificate cannot be revised. </p>
						<p>Please find the webinar presentations in the link below: </p>
						<div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;">'.$getdataeven->linkmateri.'</div>
						<p>and the certificate in the link below: </p>
						<div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;">'.$certificate.'</div>
						<p></p>
						<p>Thank you very much, don’t hesitate to contact us if there is any questions.</p>
						<p></p>
						<p>Kind Regards,</p>
						'.$getdataeven->kontak;
					$sendstatus	= 'e-certificate Send';
					$perihal	= 'Certificate and Presentations:  '.$getdataeven->nama;
					$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
				}
				if ($email != ''){
					try {
						Mail::send('email',
							array(
								'isisurat' => $emailbody,
							), function($message) use ($email, $perihal){
							$message->from('client@duidev.com');
							$message->to($email)->subject($perihal);
						});
					} catch (\Exception $e) {
						dd($e);
						$sendstatus = ' Failed Send '.$jenis.' to '.$email;
					}
				}
				$sukses++;
				WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->update([
					'status'		=> $sendstatus
				]);
			}
		}
    	if ($error == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => $sendstatus.' to '.$sukses.' Email sukses']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => $error]);
			return back();
		}
	}
	public function goRegister($id){
		$homebase	= url("/");
		$alamatweb	= $homebase.'/register/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekrevent	= WebinarEventlist::where('id', $id)->count();
		$data		= [];
		if ($cekrevent == 0){
			return view('errors.missing', $data);
		} else {
			$revent			= WebinarEventlist::where('id', $id)->first();
			$idne			= $revent->id;
			$nama			= $revent->nama; 
			$tempat			= $revent->tempat; 
			$kapasitas		= $revent->kapasitas; 
			$tanggal		= $revent->tanggal; 
			$mulai			= $revent->mulai; 
			$akhir			= $revent->akhir; 
			$bayar			= $revent->bayar; 
			$kontak			= $revent->kontak; 
			$pembicara		= $revent->pembicara; 
			$daftarmulai	= $revent->daftarmulai; 
			$daftarakhir	= $revent->daftarakhir; 
			$absenmulai		= $revent->absenmulai; 
			$absenakhir		= $revent->absenakhir; 
			$created_by		= $revent->created_by; 
			$linkwebniar	= $revent->linkwebniar;
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
			
			$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$jadwals	= WebinarEventlist::where('mulai', '>', 'subdate(current_date, 1)')->orderBy('mulai', 'DESC')->get();
			if (!empty($jadwals)){
				$x 		= 0;
				$y		= 0;
				$from	= Carbon::now();
				foreach ($jadwals as $rowpeng) {
					$mulai     		=   $rowpeng->mulai;
					$created_at     =   $rowpeng->created_at;
					$kapan          =   timeAgo($created_at);
					$to     		=   Carbon::createFromFormat('Y-m-d H:s:i', $mulai);
					$diff_in_days 	= 	$from->diffInDays($to);
					if($to < $from){ $diff_in_days = 0 - $diff_in_days; }
					if ($diff_in_days <= 0){
						$iconne 	= 'fa fa-battery-4';
						$werno	 	= 'red';
						$persen		= '100';
					} else if ($diff_in_days <= 10){
						$iconne 	= 'fa fa-battery-4';
						$werno	 	= 'red';
						$persen		= '90';
					} else if ($diff_in_days <= 30){
						$iconne 	= 'fa fa-battery-2';
						$werno	 	= 'yellow';
						$persen		= '60';
					} else {
						$iconne 	= 'fa fa-battery-empty';
						$werno	 	= 'green';
						$persen		= '30';
					}
					if ($diff_in_days == 1){
						$hari 		= 'will start tomorrow';
					} else if ($diff_in_days == 0){
						$hari 		= 'this day event';
					} else if ($diff_in_days < 0){
						$hari 		= 'already ended';
					} else {
						$hari 		= 'will begin in '.$diff_in_days.' days from now';
					}
					if ($rowpeng->bayar == 0){
						$bayar 		= 'free tickects';
					} else {
						$bayar 		= 'IDR '.$rowpeng->bayar.' for a tickects';
					}
					if ($rowpeng->kapasitas == 0){
						$kapasitas 	= 'unlimited participant';
					} else {
						$kapasitas 	= 'Limited to '.$rowpeng->kapasitas.' participant only';
					}
					$urle								= 	$homebase.'/register/'.$rowpeng->id;
					$data['webinar'][$x]['id']          =   $rowpeng->id;
					$data['webinar'][$x]['urle']        =   $urle;
					$data['webinar'][$x]['nama']     	=   $rowpeng->nama;
					$data['webinar'][$x]['tanggal']     =   $rowpeng->tanggal;
					$data['webinar'][$x]['mulai']       =   $rowpeng->mulai;
					$data['webinar'][$x]['kapan']    	=   $kapan;
					$data['webinar'][$x]['bayar']       =   $bayar;
					$data['webinar'][$x]['persen']      =   $persen;
					$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
					$data['webinar'][$x]['pembicara']   =   $rowpeng->pembicara;
					$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
					$data['webinar'][$x]['kapasitas']  	=   $kapasitas;
					$data['webinar'][$x]['hari']  		=   $hari;
					$data['webinar'][$x]['iconne']      =   $iconne;
					$data['webinar'][$x]['werno'] 		=   $werno;
					if ($y == 9) {
						$y = 0; 
					} else {
						$y++; 
					}
					$x++;
				}
			}
			$data['revent']		= $revent;
			$data['qrcode']		= $qrcode;
			$data['sidebar']	= 'register';
			return view('webinar.register', $data);
		}
	}
	public function goLinkinfo($id){
		$homebase	= url("/");
		$alamatweb	= $homebase.'/info/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekrevent	= WebinarEventlist::where('id', $id)->count();
		$data		= [];
		if ($cekrevent == 0){
			return view('errors.missing', $data);
		} else {
			$revent			= WebinarEventlist::where('id', $id)->first();
			$idne			= $revent->id;
			$nama			= $revent->nama; 
			$tempat			= $revent->tempat; 
			$kapasitas		= $revent->kapasitas; 
			$tanggal		= $revent->tanggal; 
			$mulai			= $revent->mulai; 
			$akhir			= $revent->akhir; 
			$bayar			= $revent->bayar; 
			$kontak			= $revent->kontak; 
			$pembicara		= $revent->pembicara; 
			$daftarmulai	= $revent->daftarmulai; 
			$daftarakhir	= $revent->daftarakhir; 
			$absenmulai		= $revent->absenmulai; 
			$absenakhir		= $revent->absenakhir; 
			$created_by		= $revent->created_by; 
			$linkwebniar	= $revent->linkwebniar;
			if ($pembicara == 'UNDANGANDIGITAL'){
				$getsurat 	= Suratkeluar::where('id', $kontak)->first();
				if (isset($getsurat->id)){
					$linkwebniar	= $homebase.'/viewdocbyname/'.$getsurat->marking.'.pdf';
				}
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
			
			$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$jadwals	= WebinarEventlist::where('mulai', '>', 'subdate(current_date, 1)')->orderBy('mulai', 'DESC')->get();
			if (!empty($jadwals)){
				$x 		= 0;
				$y		= 0;
				$from	= Carbon::now();
				foreach ($jadwals as $rowpeng) {
					$mulai     		=   $rowpeng->mulai;
					$created_at     =   $rowpeng->created_at;
					$kapan          =   timeAgo($created_at);
					$to     		=   Carbon::createFromFormat('Y-m-d H:s:i', $mulai);
					$diff_in_days 	= 	$from->diffInDays($to);
					if($to < $from){ $diff_in_days = 0 - $diff_in_days; }
					if ($diff_in_days <= 0){
						$iconne 	= 'fa fa-battery-4';
						$werno	 	= 'red';
						$persen		= '100';
					} else if ($diff_in_days <= 10){
						$iconne 	= 'fa fa-battery-4';
						$werno	 	= 'red';
						$persen		= '90';
					} else if ($diff_in_days <= 30){
						$iconne 	= 'fa fa-battery-2';
						$werno	 	= 'yellow';
						$persen		= '60';
					} else {
						$iconne 	= 'fa fa-battery-empty';
						$werno	 	= 'green';
						$persen		= '30';
					}
					if ($diff_in_days == 1){
						$hari 		= 'will start tomorrow';
					} else if ($diff_in_days == 0){
						$hari 		= 'this day event';
					} else if ($diff_in_days < 0){
						$hari 		= 'already ended';
					} else {
						$hari 		= 'will begin in '.$diff_in_days.' days from now';
					}
					if ($rowpeng->bayar == 0){
						$bayar 		= 'free tickects';
					} else {
						$bayar 		= 'IDR '.$rowpeng->bayar.' for a tickects';
					}
					if ($rowpeng->kapasitas == 0){
						$kapasitas 	= 'unlimited participant';
					} else {
						$kapasitas 	= 'Limited to '.$rowpeng->kapasitas.' participant only';
					}
					$urle								= 	$homebase.'/register/'.$rowpeng->id;
					$data['webinar'][$x]['id']          =   $rowpeng->id;
					$data['webinar'][$x]['urle']        =   $urle;
					$data['webinar'][$x]['nama']     	=   $rowpeng->nama;
					$data['webinar'][$x]['tanggal']     =   $rowpeng->tanggal;
					$data['webinar'][$x]['mulai']       =   $rowpeng->mulai;
					$data['webinar'][$x]['kapan']    	=   $kapan;
					$data['webinar'][$x]['bayar']       =   $bayar;
					$data['webinar'][$x]['persen']      =   $persen;
					$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
					$data['webinar'][$x]['pembicara']   =   $rowpeng->pembicara;
					$data['webinar'][$x]['kontak']      =   $rowpeng->kontak;
					$data['webinar'][$x]['kapasitas']  	=   $kapasitas;
					$data['webinar'][$x]['hari']  		=   $hari;
					$data['webinar'][$x]['iconne']      =   $iconne;
					$data['webinar'][$x]['werno'] 		=   $werno;
					if ($y == 9) {
						$y = 0; 
					} else {
						$y++; 
					}
					$x++;
				}
			}
			$data['linkwebniar']= $linkwebniar;
			$data['revent']		= $revent;
			$data['qrcode']		= $qrcode;
			$data['sidebar']	= 'info';
			return view('webinar.info', $data);
		}
	}
	public function goAbsen($id){
		$homebase	= url("/");
		$alamatweb	= $homebase.'/presentform/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekpeserta	= WebinarPartisipan::where('id', $id)->count();
		$data		= [];
		if ($cekpeserta == 0){
			$alamatweb	= $homebase.'/hadir/'.$id;
			return Redirect::to($alamatweb);
		} else {
			$getevenid		= WebinarPartisipan::where('id', $id)->first();
			$idne			= $getevenid->id;
			$idevent		= $getevenid->idevent;
			$namapeserta	= $getevenid->nama;
			$presensi		= $getevenid->presensi;
			$cekevent		= WebinarEventlist::where('id', $idevent)->count();
			if ($cekevent == 0){
				$data['errore']		= 'This Event Data is Deleted, Please Re Register to another event';
				$data['judul']		= 'Data Event Missing';
				return view('webinar.errors', $data);
			} else {
				$revent			= WebinarEventlist::where('id', $idevent)->first();
				$nama			= $revent->nama; 
				$tempat			= $revent->tempat; 
				$kapasitas		= $revent->kapasitas; 
				$tanggal		= $revent->tanggal; 
				$mulai			= $revent->mulai; 
				$akhir			= $revent->akhir; 
				$bayar			= $revent->bayar; 
				$kontak			= $revent->kontak; 
				$pembicara		= $revent->pembicara; 
				$daftarmulai	= $revent->daftarmulai; 
				$daftarakhir	= $revent->daftarakhir; 
				$absenmulai		= $revent->absenmulai; 
				$absenakhir		= $revent->absenakhir; 
				$created_by		= $revent->created_by; 
				$linkwebniar	= $revent->linkwebniar;
				$absenmulai     = Carbon::createFromFormat('Y-m-d H:s:i', $absenmulai);
				$absenakhir     = Carbon::createFromFormat('Y-m-d H:s:i', $absenakhir);
				$check 			= Carbon::now()->between($absenmulai,$absenakhir);
				if($check){
					$data['idne']		= $idne;
					$data['presensi']	= $presensi;
					$data['namapeserta']= $namapeserta;
					$data['nama']		= $nama;
					$data['sidebar']	= 'absen';
					return view('webinar.absen', $data);
				} else {
					$now 			= new DateTime();
					$future_date 	= new DateTime($revent->absenmulai);
					$interval 		= $future_date->diff($now);
					$tulis 			= $interval->format("%a days, %h hours, %i minutes, %s seconds");
					if ($now < $future_date){
						$data['errore']		= '<p>This Event Not Started Yet, Come Again at '.$revent->absenmulai.' (UTC + 7)</p><p> Remaining Time : </p>'.$tulis;
						$data['judul']		= 'Event Not Started Yet';
					} else {
						$data['errore']		= '<p>This Event is Ended</p><p> Interval From Ended : </p>'.$tulis;
						$data['judul']		= 'Event is Ended';
					}
					
					return view('webinar.errors', $data);
				}
			}
		}
	}
	public function goQuisioner($id){
		$homebase	= url("/");
		$alamatweb	= $homebase.'/evform/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekpeserta	= WebinarPartisipan::where('id', $id)->count();
		$data		= [];
		if ($cekpeserta == 0){
			$data['errore']		= 'Your Data is Deleted, Please Re Register';
			$data['judul']		= 'Data Participant Missing';
			return view('webinar.errors', $data);
		} else {
			$getevenid		= WebinarPartisipan::where('id', $id)->first();
			$idne			= $getevenid->id;
			$idevent		= $getevenid->idevent;
			$namapeserta	= $getevenid->nama;
			$quiz			= $getevenid->quiz;
			$cekevent		= WebinarEventlist::where('id', $idevent)->count();
			$ceksudah		= WebinarJawaban::where('idpeserta', $idne)->where('idevent', $idevent)->count();
			if ($cekevent == 0){
				$data['errore']		= 'This Event Data is Deleted, Please Re Register to another event';
				$data['judul']		= 'Data Event Missing';
				return view('webinar.errors', $data);
			} else {
				$revent			= WebinarEventlist::where('id', $idevent)->first();
				$nama			= $revent->nama; 
				$tempat			= $revent->tempat; 
				$kapasitas		= $revent->kapasitas; 
				$tanggal		= $revent->tanggal; 
				$mulai			= $revent->mulai; 
				$akhir			= $revent->akhir; 
				$bayar			= $revent->bayar; 
				$kontak			= $revent->kontak; 
				$pembicara		= $revent->pembicara; 
				$daftarmulai	= $revent->daftarmulai; 
				$daftarakhir	= $revent->daftarakhir; 
				$absenmulai		= $revent->absenmulai; 
				$absenakhir		= $revent->absenakhir; 
				$created_by		= $revent->created_by; 
				$linkwebniar	= $revent->linkwebniar;
				$absenmulai     = Carbon::createFromFormat('Y-m-d H:s:i', $absenmulai);
				$absenakhir     = Carbon::createFromFormat('Y-m-d H:s:i', $absenakhir);
				$sekarang		= Carbon::now();
				if($sekarang != '0'){
					$data['idne']		= $idne;
					$data['idevent']	= $idevent;
					$data['ceksudah']	= $ceksudah;
					$data['namapeserta']= $namapeserta;
					$data['nama']		= $nama;
					$data['quiz']		= $quiz;
					$data['sidebar']	= 'absen';
					return view('webinar.kuisioner', $data);
				} else {
					$now 				= new DateTime();
					$future_date 		= new DateTime($revent->absenakhir);
					$interval 			= $future_date->diff($now);
					$tulis 				= $interval->format("%a days, %h hours, %i minutes, %s seconds");
					if ($sekarang < $absenakhir){
						$data['errore']		= '<p>Please Focus to the event, Come Again at '.$revent->absenmulai.' (UTC + 7) to fill this form </p><p> Remaining Time : </p>'.$tulis;
						$data['judul']		= 'Event still on going';
					} else {
						$data['errore']		= '<p>This Event is Ended</p><p> Interval From Ended : </p>'.$tulis;
						$data['judul']		= 'Event is Ended';
					}
					
					return view('webinar.errors', $data);
				}
			}
		}
	}
	public function goQuisionerall($id){
		$homebase		= url("/");
		$alamatweb		= $homebase.'/evaluasi/'.$id;
		$qrcode 		= QrCode::size(150)->generate($alamatweb);		
		$data			= [];
		$idevent		= $id;
		$cekevent		= WebinarEventlist::where('id', $idevent)->count();
		if ($cekevent == 0){
			$data['errore']		= 'This Event Data is Deleted, Please Re Register to another event';
			$data['judul']		= 'Data Event Missing';
			return view('webinar.errors', $data);
		} else {
			$revent				= WebinarEventlist::where('id', $idevent)->first();
			$nama				= $revent->nama; 
			$tempat				= $revent->tempat; 
			$kapasitas			= $revent->kapasitas; 
			$tanggal			= $revent->tanggal; 
			$mulai				= $revent->mulai; 
			$akhir				= $revent->akhir; 
			$bayar				= $revent->bayar; 
			$kontak				= $revent->kontak; 
			$pembicara			= $revent->pembicara; 
			$daftarmulai		= $revent->daftarmulai; 
			$daftarakhir		= $revent->daftarakhir; 
			$absenmulai			= $revent->absenmulai; 
			$absenakhir			= $revent->absenakhir; 
			$created_by			= $revent->created_by; 
			$linkwebniar		= $revent->linkwebniar;
			$absenmulai     	= Carbon::createFromFormat('Y-m-d H:s:i', $absenmulai);
			$absenakhir     	= Carbon::createFromFormat('Y-m-d H:s:i', $absenakhir);
			$sekarang			= Carbon::now();
			$data['idne']		= 'ALL';
			$data['idevent']	= $idevent;
			$data['ceksudah']	= '';
			$data['namapeserta']= '';
			$data['nama']		= $nama;
			$data['quiz']		= '';
			$data['sidebar']	= 'kuisionerall';
			return view('webinar.kuisionerall', $data);
		}
	}
	public function goAbsenall($id){
		$homebase	= url("/");
		$alamatweb	= $homebase.'/hadir/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekevent	= WebinarEventlist::where('id', $id)->count();
		if ($cekevent == 0){
			$data['errore']		= 'This Event Data is Deleted, Please Re Register to another event';
			$data['judul']		= 'Data Event Missing';
			return view('webinar.errors', $data);
		} else {
			$nama_lengkap		= '';
			$email_ub			= '';
			$fakpanjang			= '';
			$tandatangan		= '';
			$setttd				= '';
			$norek				= '';
			$bank				= '';
			$namasaja 			= '';
			$previlage  		=  Session('previlage');
        	if ($previlage != '') {
        		$getfakultas= User::where('id', Session('id'))->first();
				if (isset($getfakultas->nip)){
					$idpeg 			= $getfakultas->nip;
					$fakpanjang 	= $getfakultas->fakpanjang;
					$tandatangan 	= $getfakultas->tandatangan;
					if ($fakpanjang == ''){ $fakpanjang = 'Kantor Pusat'; }
					$users 	= Simpegpegawai::where('id', $idpeg)->first();
					if (isset($users->nama_lengkap)){
						$namasaja		= $users->nama;
						$email_ub		= $users->email_ub;
						$nama_lengkap	= $users->nama_lengkap;	
						$bank			= $users->namabank;
						$norek			= $users->norek;
					}
					$setttd			= 'ada';
				}
			}
			if (is_null($tandatangan) OR $tandatangan == ''){
				$getfakultas= User::where('id', '2')->first();
				if (isset($getfakultas->paraf)){
					$tandatangan 	= $getfakultas->paraf;
					$setttd			= '';
				}
			}
			if (is_null($tandatangan) OR $tandatangan == ''){
				$tandatangan	= $homebase.'/dist/img/boxed-bg.jpg';
				$setttd			= '';
			}
			$revent				= WebinarEventlist::where('id', $id)->first();
			$nama				= $revent->nama; 
			$tempat				= $revent->tempat; 
			$kapasitas			= $revent->kapasitas; 
			$tanggal			= $revent->tanggal; 
			$mulai				= $revent->mulai; 
			$akhir				= $revent->akhir; 
			$bayar				= $revent->bayar; 
			$kontak				= $revent->kontak; 
			$pembicara			= $revent->pembicara; 
			$daftarmulai		= $revent->daftarmulai; 
			$daftarakhir		= $revent->daftarakhir; 
			$absenmulai			= $revent->absenmulai; 
			$absenakhir			= $revent->absenakhir; 
			$created_by			= $revent->created_by; 
			$linkwebniar		= $revent->linkwebniar;
			$pengumumans		= $revent->pengumumans;
			$absenmulai     	= Carbon::createFromFormat('Y-m-d H:s:i', $absenmulai);
			$absenakhir    	 	= Carbon::createFromFormat('Y-m-d H:s:i', $absenakhir);
			$check 				= Carbon::now()->between($absenmulai,$absenakhir);
			$skip				= 0;
			if ($daftarmulai == $daftarakhir){ $skip = 1; }
			if($check OR $skip == 1){
				$data['idne']			= 'ALL';
				$data['presensi']		= '';
				$data['namasaja']		= $namasaja;
				$data['pengumumans']	= $pengumumans;
				$data['bank']			= $bank;
				$data['norek']			= $norek;
				$data['setttd']			= $setttd;
				$data['datane']			= $revent;
				$data['fakpanjang']		= $fakpanjang;
				$data['nama_lengkap']	= $nama_lengkap;
				$data['email_ub']		= $email_ub;
				$data['idevent']		= $id;
				$data['nama']			= $nama;
				$data['tandatangan']	= $tandatangan;
				$data['sidebar']		= 'absenall';
				return view('webinar.absenall', $data);
			} else {
				$now 				= new DateTime();
				$future_date 		= new DateTime($revent->absenmulai);
				$interval 			= $future_date->diff($now);
				$tulis 				= $interval->format("%a days, %h hours, %i minutes, %s seconds");
				if ($now < $future_date){
					$data['errore']		= '<p>This Event Not Started Yet, Come Again at '.$revent->absenmulai.' (UTC + 7)</p><p> Remaining Time : </p>'.$tulis;
					$data['judul']		= 'Event Not Started Yet';
				} else {
					$data['errore']		= '<p>This Event is Ended</p><p> Interval From Ended : </p>'.$tulis;
					$data['judul']		= 'Event is Ended';
				}
				return view('webinar.errors', $data);
			}
			
		}
	}
	public function getuserAdminlist(Request $request) {
		$arrevent	= array();
		$jevent		= User::orderBy('id', 'DESC')->get();
		if (!empty($jevent)){
			foreach ($jevent as $revent) {
				$arrevent[] = array(
					'idne'			=> $revent->id,
					'nama'			=> $revent->nama, 
					'username'		=> $revent->username, 
					'previlage'		=> $revent->previlage, 
					'fakultas'		=> $revent->fakultas, 
					'fakpanjang'	=> $revent->fakpanjang, 
					'merangkap'		=> $revent->merangkap, 
					'nip'			=> $revent->nip, 
					'golongan'		=> $revent->golongan, 
					'email'			=> $revent->email, 
					'spesial'		=> $revent->spesial, 
					'tandatangan'	=> $revent->tandatangan, 
					'paraf'			=> $revent->paraf, 
					'foto'			=> $revent->foto
				);
			}
		}
		echo json_encode($arrevent);
	}
	public function exPresensi(Request $request) {
    	$idne		= $request->input('val01');
    	$waktu		= $request->input('val02');
		$idevent	= $request->input('val03');
		$nama		= $request->input('val04');
		$instansi	= $request->input('val05');
		$email		= $request->input('val06');
		if ($idevent == 'INDIVIDU'){
			$pekerjaan	= $request->input('val07');
			$ttdupload	= $request->input('val08');
			$jenisttd	= $request->input('val09');
			$namabank	= $request->input('val10');
			$norek		= $request->input('val11');
			$satu		= $request->input('val12');
			$dua		= $request->input('val13');
			$tiga		= $request->input('val14');
			$empat		= $request->input('val15');
			$lima		= $request->input('val16');
			$enam		= $request->input('val17');
			$saran		= $request->input('val18');
			$tandatangan= '';
			if ($jenisttd == 'gambar'){
				if($request->hasFile('val08')) {
					$ImageExt	= $request->file('val08')->getClientOriginalExtension();
					$file_tmp	= $request->file('val08');
					$data 		= file_get_contents($file_tmp);
					$tandatangan= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
				}
			} else {
				$tandatangan	= $ttdupload;
			}

			$absen 		= WebinarPartisipan::where('id', $idne)->update([
				'nama'			=> $nama, 
				'pekerjaan'		=> $pekerjaan, 
				'instansi'		=> $instansi, 
				'email'			=> $email,
				'namabank'		=> $namabank,
				'norek'			=> $norek,
				'presensi'		=> date('Y:m:d H:i:s'), 
				'status'		=> 'Absen', 
				'foto'			=> $tandatangan
			]);
			if ($absen){
				$getdata = WebinarPartisipan::where('id', $idne)->first();
				$isikuis = WebinarJawaban::create([
					'idevent' 	=> $getdata->idevent,
					'idpeserta' => $idne,
					'satu' 		=> $satu,
					'dua' 		=> $dua,
					'tiga' 		=> $tiga,
					'empat' 	=> $empat,
					'lima' 		=> $lima,
					'enam' 		=> $enam,
					'tujuh' 	=> '',
					'saran' 	=> $saran
				]);
				
				/*
				$homebase		= url("/");				
				$getevenid		= WebinarPartisipan::where('id', $idne)->first();
				$idevent		= $getevenid->idevent;
				$namapeserta	= $getevenid->nama;
				$presensi		= $getevenid->presensi;
				$email			= $getevenid->email;
				$revent			= WebinarEventlist::where('id', $idevent)->first();
				$nama			= $revent->nama;
				$evaluasi		= $homebase.'/evform/'.$idne;
				$emailbody 		= '
					<p>Dear '.$namapeserta.'</p><br />
					<p>Thank you for attending '.$nama.'. We Hope you enjoyed our event</p>
					<p>Please Submit any question to :</p>
					'.$revent->kontak;
				
				$sendstatus	= 'Attendance  Send';
				$perihal	= 'Attendance  '.$namapeserta;
				$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'sco@ub.ac.id', 'isisurat'=>$emailbody);
				if ($email != ''){
					try {
						Mail::send('email',
							array(
								'isisurat' => $emailbody,
							), function($message) use ($email, $perihal){
							$message->from('sco@ub.ac.id');
							$message->to($email)->subject($perihal);
						});
					} catch (\Exception $e) {
						$sendstatus = 'Failed Send Evaluation to '.$email;
					}
				}
				WebinarPartisipan::where('id', $idne)->update([
					'status'		=> $sendstatus
				]);
				*/
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => ' Saved Time : '.$waktu.' To Your Present Record']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Database Error, Please Try Again a Few Year...!!']);
				return back();
			}
		} else if ($idevent == 'PANITIA'){
			$pekerjaan	= $request->input('val07');
			$nama 		= '';
			$nip_baru	= '';
			$instansi	= '';
			$no_hp		= '';
			$tandatangan= '';
			$users 		= Simpegpegawai::where('email_ub', $email)->first();
			if (isset($users->nama_lengkap)){
				$nama		= $users->nama_lengkap;
				$nip_baru	= $users->nip_baru;
				$jabatan	= $users->jabatan;
				$no_hp		= $users->no_hp;
				$instansi	= $users->ppabp;
				$getjabatan	= User::where('nip', $users->id)->first();
				if (isset($getjabatan->tandatangan)){
					$jabatan	= $getjabatan->privilage;
					$tandatangan= $getjabatan->tandatangan;
				} else {
					$gettandatangan	= Pejabatsurat::where('nip', $nip_baru)->first();
					if (isset($gettandatangan->pejabat)){
						$jabatan	= $gettandatangan->pejabat;
						$tandatangan= $gettandatangan->tandatangan;
					}
				}
			} else {
				$getfakultas= User::where('id', '2')->first();
				if (isset($getfakultas->paraf)){
					$tandatangan = $getfakultas->paraf;
				}
			}
			$ceksudah 	= WebinarPartisipan::where('idevent', $idne)->where('email', $email)->count();
			if ($ceksudah == 0){
				$absen 	= WebinarPartisipan::insertGetId([
					'idevent'		=> $idne, 
					'nama'			=> $nama, 
					'pekerjaan'		=> $pekerjaan, 
					'alamat'		=> $nip_baru, 
					'negara'		=> 'Indonesia', 
					'instansi'		=> $instansi, 
					'email'			=> $email,
					'hape'			=> $no_hp,
					'namabank'		=> '',
					'norek'			=> '',
					'daftar'		=> '0000-00-00 00:00:00', 
					'quiz'			=> '0000-00-00 00:00:00', 
					'presensi'		=> date('Y:m:d H:i:s'), 
					'status'		=> 'Jump to Absen', 
					'bayar'			=> '0', 
					'foto'			=> $tandatangan
				]);
			} else {
				$absen 	= WebinarPartisipan::where('idevent', $idne)->where('email', $email)->update([
					'pekerjaan'		=> $pekerjaan, 
					'presensi'		=> date('Y:m:d H:i:s'), 
				]);
			}
			if ($absen){
				Chatting::insert([
					'kelompok'  	=>  Session('previlage'),
					'nama'  		=>  Session('nama'),
					'pesannya'		=>  'Tambah Panitia an. '.$nama,
					'ket'			=>  Session('avatar'),
					'id_sekolah'	=>	$idne
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'an '.$nama.' Tersimpan Sebagai '.$pekerjaan]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Database Error, Please Try Again a Few Year...!!']);
				return back();
			}
		} else {
			$pekerjaan	= $request->input('val07');
			$ttdupload	= $request->input('val08');
			$jenisttd	= $request->input('val09');
			$namabank	= $request->input('val10');
			$norek		= $request->input('val11');
			$satu		= $request->input('val12');
			$dua		= $request->input('val13');
			$tiga		= $request->input('val14');
			$empat		= $request->input('val15');
			$lima		= $request->input('val16');
			$enam		= $request->input('val17');
			$saran		= $request->input('val18');
			$tandatangan= '';
			if ($jenisttd == 'gambar'){
				if($request->hasFile('val08')) {
					$ImageExt	= $request->file('val08')->getClientOriginalExtension();
					$file_tmp	= $request->file('val08');
					$data 		= file_get_contents($file_tmp);
					$tandatangan= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
				}
			} else {
				$tandatangan	= $ttdupload;
			}
			$idne		= '';
			$cekpeserta = WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->count();
			if ($cekpeserta == 0){
				$nip_baru	= '';
				$users 		= Simpegpegawai::where('email_ub', $email)->first();
				if (isset($users->nama_lengkap)){
					$nip_baru	= $users->nip_baru;
					$jabatan	= $users->jabatan;
					$no_hp		= $users->no_hp;
				} else {
					$nip_baru	= '-';
					$jabatan	= '-';	
					$no_hp		= '';
				}
				if ($tandatangan == ''){
					$users 	= Simpegpegawai::where('email_ub', $email)->first();
					if (isset($users->nama_lengkap)){
						$nip_baru	= $users->nip_baru;
						$jabatan	= $users->jabatan;
						$no_hp		= $users->no_hp;
						$getjabatan	= User::where('nip', $users->id)->first();
						if (isset($getjabatan->tandatangan)){
							$jabatan	= $getjabatan->privilage;
							$tandatangan= $getjabatan->tandatangan;
						} else {
							$gettandatangan	= Pejabatsurat::where('nip', $nip_baru)->first();
							if (isset($gettandatangan->pejabat)){
								$jabatan	= $gettandatangan->pejabat;
								$tandatangan= $gettandatangan->tandatangan;
							}
						}
					} else {
						$getfakultas= User::where('id', '2')->first();
						if (isset($getfakultas->paraf)){
							$tandatangan = $getfakultas->paraf;
						}
					}
				}
				$idne = WebinarPartisipan::insertGetId([
					'idevent'		=> $idevent, 
					'nama'			=> $nama, 
					'pekerjaan'		=> $pekerjaan, 
					'alamat'		=> $nip_baru, 
					'negara'		=> 'Indonesia', 
					'instansi'		=> $instansi, 
					'email'			=> $email,
					'hape'			=> $no_hp,
					'namabank'		=> $namabank,
					'norek'			=> $norek,
					'daftar'		=> '0000-00-00 00:00:00', 
					'quiz'			=> '0000-00-00 00:00:00', 
					'presensi'		=> date('Y:m:d H:i:s'), 
					'status'		=> 'Jump to Absen', 
					'bayar'			=> '0', 
					'foto'			=> $tandatangan
				]);
			} else {
				$getidpartisipan 	= WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->first();
				$idne				= $getidpartisipan->id;
				$update 			= WebinarPartisipan::where('id', $idne)->update([
					'nama'			=> $nama, 
					'pekerjaan'		=> $pekerjaan, 
					'instansi'		=> $instansi, 
					'email'			=> $email,
					'namabank'		=> $namabank,
					'norek'			=> $norek,
					'foto'			=> $tandatangan
				]);
			}
			if ($idne != ''){
				WebinarJawaban::create([
					'idevent' 	=> $idevent,
					'idpeserta' => $idne,
					'satu' 		=> $satu,
					'dua' 		=> $dua,
					'tiga' 		=> $tiga,
					'empat' 	=> $empat,
					'lima' 		=> $lima,
					'enam' 		=> $enam,
					'tujuh' 	=> '',
					'saran' 	=> $saran
				]);
				$homebase		= url("/");	
				$getevenid		= WebinarPartisipan::where('id', $idne)->first();
				$idevent		= $getevenid->idevent;
				$namapeserta	= $getevenid->nama;
				$presensi		= $getevenid->presensi;
				$email			= $getevenid->email;
				/*
				
				$revent			= WebinarEventlist::where('id', $idevent)->first();
				$nama			= $revent->nama;
				$evaluasi		= $homebase.'/evaluasi/'.$idevent;
				$emailbody 		= '
					<p>Dear '.$namapeserta.'</p><br />
					<p>Thank you for attending '.$nama.'. We Hope you enjoyed our event</p>
					<p>Please Submit any question to :</p>
					'.$revent->kontak;
				$sendstatus	= 'Attendance  Send';
				$perihal	= 'Attendance  '.$namapeserta;
				$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'sco@ub.ac.id', 'isisurat'=>$emailbody);
				if ($email != ''){
					try {
						Mail::send('email',
							array(
								'isisurat' => $emailbody,
							), function($message) use ($email, $perihal){
							$message->from('sco@ub.ac.id');
							$message->to($email)->subject($perihal);
						});
					} catch (\Exception $e) {
						$sendstatus = 'Failed Send Evaluation to '.$email;
					}
				}
				WebinarPartisipan::where('id', $idne)->update([
					'status'		=> $sendstatus
				]);
				*/
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Thank You '.$namapeserta.' Present Time : '.$waktu.' To '.$nama]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Database Error, Please Try Again a Few Year...!!']);
				return back();
			}
		}
	}
	public function exKuisioner(Request $request) {
		$homebase	= url("/");
    	$idne		= $request->input('val09');
		if ($idne == 'notulensi'){
			$id				= $request->input('val01');
			$isi			= $request->input('val02');
			$ketua			= $request->input('val03');
			$konseptor		= $request->input('val04');
			$paraf1			= $request->input('val05');
			$namafile1 		= 'boxed-bg.png';
			$namafile2 		= 'boxed-bg.png';
			$namafile3 		= 'boxed-bg.png';
			$namafile4 		= 'boxed-bg.png';
			$namafile5 		= 'boxed-bg.png';
			$namafile6 		= 'boxed-bg.png';
			$getevenid		= WebinarPartisipan::where('id', $id)->first();
			if (isset($getevenid->id)){
				$idevent		= $getevenid->idevent;
				$namapeserta	= $getevenid->nama;
				$presensi		= $getevenid->presensi;
				$negara			= $getevenid->negara;
				$cekgambar 		= explode(';', $negara);
				if (isset($cekgambar[5])){
					$namafile1 		= $cekgambar[0];
					$namafile2 		= $cekgambar[1];
					$namafile3 		= $cekgambar[2];
					$namafile4 		= $cekgambar[3];
					$namafile5 		= $cekgambar[4];
					$namafile6 		= $cekgambar[5];
				}
				$update 		= WebinarPartisipan::where('id', $id)->update([
					'notulensi'	=> $isi,
					'quiz'		=> date('Y-m-d H:i:s') 
				]);
				if ($update){
					$getnamaevent 	= WebinarEventlist::where('id', $idevent)->first();
					if (isset($getnamaevent->id)){
						$namaevent 	= $getnamaevent->nama;
					} else { $namaevent = ''; }
					if ($request->hasFile('file1')) {
						$namafile1  = 'Notulensi-'.$idevent.'-1.'.$request->file('file1')->getClientOriginalExtension();
						$request->file('file1')->move(public_path('images/notulensi'), $namafile1);
					}
					if ($request->hasFile('file2')) {
						$namafile2  = 'Notulensi-'.$idevent.'-2.'.$request->file('file2')->getClientOriginalExtension();
						$request->file('file2')->move(public_path('images/notulensi'), $namafile2);
					}
					if ($request->hasFile('file3')) {
						$namafile3  = 'Notulensi-'.$idevent.'-3.'.$request->file('file3')->getClientOriginalExtension();
						$request->file('file3')->move(public_path('images/notulensi'), $namafile3);
					}
					if ($request->hasFile('file4')) {
						$namafile4  = 'Notulensi-'.$idevent.'-4.'.$request->file('file4')->getClientOriginalExtension();
						$request->file('file4')->move(public_path('images/notulensi'), $namafile4);
					}
					if ($request->hasFile('file5')) {
						$namafile5  = 'Notulensi-'.$idevent.'-5.'.$request->file('file5')->getClientOriginalExtension();
						$request->file('file5')->move(public_path('images/notulensi'), $namafile5);
					}
					if ($request->hasFile('file6')) {
						$namafile6  = 'Notulensi-'.$idevent.'-6.'.$request->file('file6')->getClientOriginalExtension();
						$request->file('file6')->move(public_path('images/notulensi'), $namafile6);
					}
					$arrgambar 	= $namafile1.';'.$namafile2.';'.$namafile3.';'.$namafile4.';'.$namafile5.';'.$namafile6;
					WebinarPartisipan::where('id', $id)->update([
						'negara'	=> $arrgambar,
					]);
					if ($ketua != ''){
						if ($paraf1 == ''){ $paraf1 == 'SELF'; }
						$qnamapjbt		= Pejabatsurat::where('id', $ketua)->first();
						if (isset($qnamapjbt->pejabat)){
							$idpejabat 	= $qnamapjbt->id;
							$pejabat 	= $qnamapjbt->pejabat;
							$kode 		= $qnamapjbt->kode;
							$nama 		= $qnamapjbt->nama;
							$email 		= $qnamapjbt->email;
						} else {
							$idpejabat 	= $ketua;
							$pejabat 	= 'Unkown';
							$kode 		= 'ONK';
							$nama 		= 'Unkown ID '.$ketua;
							$email 		= 'admin@localhost.com';
						}
						$marking	= Session('fakultas').'-NTL-'.$idevent;
						$ceksudah 	= Suratkeluartnpnomor::where('marking', $marking)->count();
						if ($ceksudah == 0){
							$kerjanya 	= Suratkeluartnpnomor::insert([
								'marking' 		=>  $marking,
								'jenissrt' 		=>  'NOTULENSI',
								'kodefak' 		=>  $kode,
								'unit' 			=>  'TU',
								'tglbuat' 		=>  date("Y-m-d"),
								'yersrt' 		=>  date("Y"),
								'dasarsurat' 	=>  '',
								'kepada' 		=>  $konseptor,
								'alamat' 		=>  Session('fakpanjang'),
								'perihal' 		=>  'Notulensi '.$namaevent,
								'lampiran' 		=>  '',
								'isisurat' 		=>  $id,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $pejabat,
								'namapejabat' 	=>  $nama,
								'tembusan' 		=>  '',
								'sifat' 		=>  '',
								'klasifikasi' 	=>  '',
								'pembuat' 		=>  Session('email'),
								'kelompok' 		=>  Session('jabatan'),
								'status' 		=>  'NEW',
								'arsip' 		=>  '',
								'footnote' 		=>  '',
								'tandatangan' 	=>  '',
								'paraf1' 		=>  $paraf1,
								'paraf2' 		=>  '',
								'paraf3' 		=>  '',
								'paraf4' 		=>  '',
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',						
								'faskode' 		=>  '',
								'fasmasa' 		=>  '',
								'fasket' 		=>  '',
								'font' 			=>  '',
								'ukuran' 		=>  '',
								'lebarttd' 		=>  '',
								'fakultas'		=>  Session('fakultas'),
							]);
							if ($paraf1 != 'SELF'){
								$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
								if (isset($qnamapjbt->pejabat)){
									$pejabat 	= $qnamapjbt->pejabat;
									if ($qnamapjbt->email == '' OR $qnamapjbt->email == null){

									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUARNONOMER','PARAF','','1');
									}
								} else {
									if ($email == '' OR $email == null){

									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$email,'KELUARNONOMER','TTD','','1');
									}
								}
							} else if ($paraf1 == 'SELF' AND $kode != 'ONK'){
								if ($email == '' OR $email == null){

								} else {
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$email,'KELUARNONOMER','TTD','','1');
								}
							}
						} else {
							Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
							if ($paraf1 != 'SELF'){
								$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
								if (isset($qnamapjbt->pejabat)){
									$pejabat 	= $qnamapjbt->pejabat;
									if ($qnamapjbt->email == '' OR $qnamapjbt->email == null){

									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUARNONOMER','PARAF','','1');
									}
								} else {
									if ($email == '' OR $email == null){

									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$email,'KELUARNONOMER','TTD','','1');
									}
								}
							} else if ($paraf1 == 'SELF' AND $kode != 'ONK'){
								if ($email == '' OR $email == null){

								} else {
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$email,'KELUARNONOMER','TTD','','1');
								}
							}
						}
						$pesan		= 'Notulensi Kegiatan '.$namaevent.' Telah Kami Kirimkan Ke Pemaraf/Penandatangan';
						$url 		= '<a href="'.$homebase.'/trackingid/srtklr-'.$marking.'" target="_blank">'.$marking.'</a>';
						WebinarPartisipan::where('id', $id)->update([
							'instansi'	=> $url,
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						WebinarPartisipan::where('id', $id)->update([
							'instansi'	=> '',
						]);
					}
					$pesan = 'Notulensi Kegiatan '.$namaevent.' Berhasil di Simpan';
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Notulensi Gagal di Simpan']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Event ID Tidak di temukan']);
				return back();
			}
		} else {
			$satu		= $request->input('val01');
			$dua		= $request->input('val02');
			$tiga		= $request->input('val03');
			$empat		= $request->input('val04');
			$lima		= $request->input('val05');
			$enam		= $request->input('val06');
			$tujuh		= $request->input('val07');
			$saran		= $request->input('val08');
			$idne		= $request->input('val09');
			$idevent	= $request->input('val10');
			$nama		= $request->input('val11');
			$instansi	= $request->input('val12');
			$email		= $request->input('val13');
			$settujuh 	= '';
			if(!empty($tujuh)){
				foreach ($tujuh as $risi){
					if ($settujuh == ''){
						$settujuh = $risi;
					} else {
						$settujuh = $settujuh.'-'.$risi;
					}
				}
			}
			if ($idne == 'ALL'){
				$cekpeserta = WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->count();
				if ($cekpeserta == 0){
					$idne = WebinarPartisipan::insertGetId([
						'idevent'		=> $idevent, 
						'nama'			=> $nama, 
						'pekerjaan'		=> '-', 
						'alamat'		=> '-', 
						'negara'		=> 'Indonesia', 
						'instansi'		=> $instansi, 
						'email'			=> $email,
						'hape'			=> '-',
						'daftar'		=> '0000-00-00 00:00:00', 
						'quiz'			=> date('Y:m:d H:i'), 
						'presensi'		=> '0000-00-00 00:00:00', 
						'status'		=> 'Jump to Quiz', 
						'bayar'			=> '0', 
						'foto'			=> ''
					]);
				} else {
					$getidpartisipan 	= WebinarPartisipan::where('idevent', $idevent)->where('email', $email)->first();
					$idne				= $getidpartisipan->id;
				}
			}
			$isikuis = WebinarJawaban::create([
				'idevent' 	=> $idevent,
				'idpeserta' => $idne,
				'satu' 		=> $satu,
				'dua' 		=> $dua,
				'tiga' 		=> $tiga,
				'empat' 	=> $empat,
				'lima' 		=> $lima,
				'enam' 		=> $enam,
				'tujuh' 	=> $settujuh,
				'saran' 	=> $saran
			]);
			if ($isikuis){
				WebinarPartisipan::where('id', $idne)->update([
					'quiz' => date('Y-m-d H:i')
				]);
				$homebase		= url("/");
				$evaluasi		= $homebase.'/evform/'.$idne;
				$evaluasi		= '';
				$getevenid		= WebinarPartisipan::where('id', $idne)->first();
				$idevent		= $getevenid->idevent;
				$namapeserta	= $getevenid->nama;
				$presensi		= $getevenid->presensi;
				$email			= $getevenid->email;
				$revent			= WebinarEventlist::where('id', $idevent)->first();
				$nama			= $revent->nama;
				$emailbody 		= '
					<p>Dear '.$namapeserta.'</p><br />
					<p>Thank you for your valuable feedback. We Hope you enjoyed our event</p>
					<p>Please Submit any question to '.config('global.mrinhomename').' secretary:</p>
					'.$revent->kontak.'
					<p>We look forward to your valuable feedback, please complete the evaluation form to help us understand what we can do better</p>
					<p><a href="'.$evaluasi.'">Evaluation Link</a></p>
					<p></p>
					<p>Kind regards</p>
					<p></p>
					<p>'.config('global.mrinhomename').'</p>';
				$sendstatus	= 'Evaluation Submit';
				$perihal	= 'Thank you for your valuable feedback';
				$data 		= array('name'=>'Meeting Registration Service', 'email'=> 'client@duidev.com', 'isisurat'=>$emailbody);
				if ($email != ''){
					try {
						Mail::send('email',
							array(
								'isisurat' => $emailbody,
							), function($message) use ($email, $perihal){
							$message->from('client@duidev.com');
							$message->to($email)->subject($perihal);
						});
					} catch (\Exception $e) {
						$sendstatus = ' Thank Feedback Failed to send to '.$email;
					}
				}
				WebinarPartisipan::where('id', $idne)->update([
						'status'		=> $sendstatus
					]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => ' Thank you, see you in next event']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Database Error, Please Try Again a Few Year...!!']);
				return back();
			}
		}
	}
	public function saveEditemail(Request $request) {
    	$idne		= $request->input('set01');
    	$email		= $request->input('set02');
    	$hape		= $request->input('set03');
		if ($email == 'BIASA' OR $email == 'Nota Dinas' OR $email == 'UPLOAD' OR $email == 'UPLQRMAN' OR $email == 'SERTIFIKATTTE'){
			$getpejabat 	= Pejabatsurat::where('kode', $hape)->first();
			$idpejabat		= $getpejabat->id;
			$pejabat		= $getpejabat->pejabat;
			$nmpejabat		= $getpejabat->nama;
			$update 		= Suratkeluar::where('id', $idne)->update([
				'jenissrt'		=> $email,
				'idpejabat' 	=> $idpejabat,
				'pejabat' 		=> $pejabat,
				'namapejabat' 	=> $nmpejabat,
				'kodefak'		=> $hape,
				'status'		=> 'NEW'
			]);
			if ($update){
				$rinbox		= Suratkeluar::where('id', $idne)->first();
				SendMail::notif($rinbox->pembuat,$rinbox->pembuat,'Surat '.$rinbox->perihal,' di Approve Oleh '.Session('nama'));
			}
		} else {
			$input 		= WebinarPartisipan::where('id', $idne)->update([
				'email'     =>  $email,
				'hape' 		=>  $hape,
			]);
			$getidevent	= WebinarPartisipan::where('id', $idne)->first();
			$idevent	= $getidevent->idevent;
			$homebase	= url("/");
			$sertifikat	= $homebase.'/certificate/'.$idne;
			$daftarhdr	= $homebase.'/presentform/'.$idne;
			$evaluasi	= $homebase.'/evform/'.$idne;
			$linke 		= $daftarhdr.'%0A'.$evaluasi;
			$info		= $homebase.'/info/'.$idevent;
			//$linke 	= $daftarhdr.'%0A'.$evaluasi;
			$linke		= 'Dear%20Participants,%20This%20is%20reminder%20event.​%0aPlease%20click%20this%20link%20for%20detail​%0a'.$info;
			$linke 		= 'https://api.whatsapp.com/send?phone='.$hape.'&text='.$linke;
			echo $linke;
		}
	}
	public function exAddAkun(Request $request) {
    	$username	= $request->input('set01');
    	$nama		= $request->input('set02');
    	$email		= $request->input('set03');
		$pass1		= $request->input('set04');
		$pass2		= $request->input('set05');
		$idne		= $request->input('set06');
		if ($nama == 'hapus'){
			$delete = User::where('id', $username)->delete();
			if ($delete){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => ' Account Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Database Error, Please Try Again a Few Year...!!']);
				return back();
			}
		} else {
			if ($pass1 != $pass2){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Password and Confirmation Password Not Match']);
				return back();
			} else if ($username == '' OR $email == ''){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Username, Email and Sure Name Cannot Be Null']);
				return back();
			} else {
				if($request->hasFile('file')) {
					$ImageExt	= $request->file('file')->getClientOriginalExtension();
					$file_tmp	= $request->file('file');
					$data 		= file_get_contents($file_tmp);
					$foto 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
				} else {
					$foto 		= '';
				}
				if ($idne == 'new'){
					$input = User::create([
						'nama'      	=>  $nama,
						'username' 		=>  $username,
						'email' 		=>  $email,
						'password' 		=>  bcrypt($pass1),
						'previlage' 	=> 	'',
						'fakultas' 		=>  $fakultas,
						'foto' 			=>  $foto,
					]);
				} else {
					if ($foto == ''){
						$input = User::where('id', $idne)->update([
							'nama'      	=>  $nama,
							'username' 		=>  $username,
							'email' 		=>  $email,
							'password' 		=>  bcrypt($pass1),
						]);
					} else {
						$input = User::where('id', $idne)->update([
							'nama'      	=>  $nama,
							'username' 		=>  $username,
							'email' 		=>  $email,
							'password' 		=>  bcrypt($pass1),
							'foto' 			=>  $foto,
						]);
					}
				}
				if ($input){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => ' Account Registered']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Failed', 'message' => 'Database Error, Please Try Again a Few Year...!!']);
					return back();
				}
			}
		}
	}
	public function goSertifikat($id){
		$data 			= [];
		$homebase		= url("/");
		$evaluasi		= $homebase.'/certificate/'.$id;
		$getevenid		= WebinarPartisipan::where('id', $id)->first();
		$idevent		= $getevenid->idevent;
		$namapeserta	= $getevenid->nama;
		$cekrevent		= WebinarEventlist::where('id', $idevent)->count();
		if ($cekrevent == 0){
			return view('errors.missing', $data);
		} else {
			$getlinkpic		= WebinarEventlist::where('id', $idevent)->first();
			$sertifikat1	= $getlinkpic->sertifikatdepan;
			$sertifikat2	= $getlinkpic->sertifikatbelakang;
			if (File::exists(base_path()) ."/public/dist/img/sertifikat/". $sertifikat1) {
				$sertifikat1= 'dist/img/sertifikat/'.$sertifikat1;
				$gambar 	= file_get_contents($sertifikat1);
				$base64 	= 'data:image/jpg;base64,' . base64_encode($gambar);
			} else {
				$base64		= '';
			}
			if (File::exists(base_path()) ."/public/dist/img/sertifikat/". $sertifikat2) {
				$sertifikat2= 'dist/img/sertifikat/'.$sertifikat2;
				$sertifikat2= '<img src="'.$sertifikat2.'">';
			} else {
				$sertifikat2= '';
			}
			
			$data['base64'] 		= $base64;
			$data['sertifikat2'] 	= $sertifikat2;
			$data['namapeserta'] 	= $namapeserta;
			//return view('cetak.sertifikat', $data);
			return PDF::loadView('webinar.cetak.sertifikat', $data)->setPaper('a4', 'landscape')->setWarnings(false)->save('sertifikat/'.$id.'.pdf')->stream('sertifikat/'.$id.'.pdf');
			//return PDF::loadHTML($html)->setPaper('legal', 'portrait')->setWarnings(false)->save($id.'.pdf')->stream($id.'.pdf');
		}
	}
	public function goRekap($id){
	    $homebase	= url("/");
		$alamatweb	= $homebase.'/rekap/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekrevent	= WebinarEventlist::where('id', $id)->count();
		$data		= [];
		if ($cekrevent == 0){
			return view('errors.missing', $data);
		} else {
			$revent				= WebinarEventlist::where('id', $id)->first();
			$nama				= $revent->nama;
			$data['idevent']	= $id;
			$data['namaevent']	= $nama;
			$data['sidebar']	= 'rekap';
			return view('webinar.rekap', $data);
		}
	}
	public function goAbsenCetak($id){
		$homebase		= url("/");
		$kementerian	= strtoupper(Session('subdomainapps01'));
		$kota 			= strtoupper(Session('kota01'));
		$universitas 	= strtoupper(Session('domainapps01'));
		$namaapp 		= strtoupper(Session('namaapps01'));
		$fakpanjang		= Session('subsubdomainapps01');
		$mons 			= array(0 => "", 1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
		$kalender		= array(0 => "", 1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$alamatweb		= $homebase.'/hadir/'.$id;
		$qrcode 		= base64_encode(QrCode::format('png')->size(400)->generate($alamatweb));
		$getdata		= WebinarEventlist::where('id', $id)->first();
		$data			= [];
		if (isset($getdata->nama)){
			$nama			= $getdata->nama;
			$tempat			= $getdata->tempat;
			$mulai			= $getdata->mulai;
			$pengumumans	= $getdata->pengumumans;
			$akhir			= $getdata->akhir;
			$fakultas		= $getdata->fakultas;
			$getjam1		= explode(" ", $mulai);
			$jam1			= $getjam1[1];
			$getjam2		= explode(" ", $akhir);
			$jam2			= $getjam2[1];
			$cekhari2 		= DateTime::createFromFormat('Y-m-d', $getdata->tanggal);
			$hari 			= $cekhari2->format('D');
			$hariinggris	= $hari;
			if ($hari == 'Mon'){ $hari = 'Senin'; }
			if ($hari == 'Tue'){ $hari = 'Selasa'; }
			if ($hari == 'Wed'){ $hari = 'Rabu'; }
			if ($hari == 'Thu'){ $hari = 'Kamis'; }
			if ($hari == 'Fri'){ $hari = 'Jumat'; }
			if ($hari == 'Sat'){ $hari = 'Sabtu'; }
			if ($hari == 'Sun'){ $hari = 'Minggu'; }
			$tulisawkt2 	= $hari.', '.$getdata->mulai;
			$tulisawkt1 	= $hariinggris.', '.$getdata->mulai;
			$blniki 		= date("m");
			$tgliki 		= date("d");
			$tahun 			= date("Y");
			$bulaniki 		= (int)$blniki;
			$sakniki 		= $tgliki.' '.$kalender[$bulaniki].' '.$tahun;
			
			$tulisawkt 		= '<div style="line-height:0.9"><font style="font-size:13px">: '.$tulisawkt2.'</font><br /><i style="font-size:x-small">&nbsp;&nbsp;'.$tulisawkt1.'</i></div>';
			$judul 			= '<div style="line-height:0.9"><font style="font-size:20px">Link Presensi<br />'.$nama.'</font></div>';
			$generatetbl	= '
						<table id="printiki" width="640" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td colspan="2" rowspan="4" align="left"><img src="'.Session('logofrontapps01').'" width="80" height="80" alt=""/></td>	  
							<td colspan="9"><b>'.$kementerian.'</b></td>	
							</tr>
							<tr>
								<td colspan="9"><b>'.$universitas.', '.$kota.'</b></td>	  
							</tr>
							<tr>
								<td colspan="9"><b><u>'.$fakpanjang.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>	  
							</tr>
							<tr>
								<td colspan="3" align="center">&nbsp;</td>
								<td width="100">&nbsp;</td>
								<td width="65">&nbsp;</td>
								<td width="67">&nbsp;</td>
								<td width="133">&nbsp;</td>
								<td width="42">&nbsp;</td>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3" align="center">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="11" align="center"><font style="font-size:16px"><b>'.$judul.'</b></font></td>
							</tr>    
							<tr>
								<td colspan="3" align="center">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td align="left" valign="top"><div style="line-height:0.9"><font style="font-size:13px">Tempat</font> <br /><i style="font-size:x-small">Location</i></div></td>
								<td align="left" valign="top">:</td>
								<td colspan="5" align="left" valign="top"><font style="font-size:13px">'.$tempat.'</font></td>
								<td align="left" valign="top">
									<div style="line-height:0.9">
										<font style="font-size:13px">Tanggal dan Jam</font><br />
										<i style="font-size:x-small">Date Time</i>
									</div>      
								</td>
								<td colspan="3" valign="top">'.$tulisawkt.'</td>
							</tr>
							<tr>
								<td align="left">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="4">&nbsp;</td>
							</tr>   
							<tr><td colspan="11" align="center"><img src="data:image/png;base64,'.$qrcode.'" width="240" /></td></tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr><td colspan="11" align="center">Silahkan Gunakan Gawai Bapak/Ibu untuk memindai Kode QR diatas untuk melakukan presensi. Atau Ketik tautan dibawah ini di Laptop / Gawai Bapak/Ibu. Link Presensi :</td></tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr><td colspan="11" align="center"><font color="blue" size="+2">'.$alamatweb.'</font></td></tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr>
								<td align="left">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="4">Malang, '.$sakniki.'</td>
							</tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr><td colspan="11" align="center">&nbsp;</td></tr>
							<tr>
								<td align="left">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="4">'.$getdata->created_by.'</td>
							</tr>
						</table>';
			echo $generatetbl;
		} else {
			echo 'Data Dengan ID => '.$id.' Tidak di Temukan';
		}
	}
	public function getPegawaiWebinar(Request $request) {
    	$email			= $request->input('set01');
		$nama			= '';
		$unitkerja 		= '';
		$bank			= '';
		$norek			= '';
		$tandatangan 	= '';
		$fakpanjang		= '';
		$jabatan		= '';
		$namasaja		= '';
    	$getuser		= User::where('email', 'LIKE', $email.'%')->first();
		if (isset($getuser->nip)){
			$idpeg 			= $getuser->nip;
			$tandatangan 	= $getuser->tandatangan;
			$jabatan 		= $getuser->previlage;
			$fakpanjang 	= $getuser->fakultas;
			if ($fakpanjang == '' OR $fakpanjang == 'KP'){
				$fakpanjang = 'Kantor Pusat';
			}
			$getpeg = Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpeg->id)){
				$namasaja	= $getpeg->nama;
				$nama		= $getpeg->nama_lengkap;
				$unitkerja 	= $getpeg->ppabp;
				$bank		= $getpeg->namabank;
				$norek		= $getpeg->norek;
			}
		} else {
			$getpeg = Simpegpegawai::where('email_ub', 'LIKE', $email.'%')->orwhere('email', 'like', $email.'%')->first();
			if (isset($getpeg->id)){
				$nama		= $getpeg->nama_lengkap;
				$namasaja	= $getpeg->nama;
				$unitkerja 	= $getpeg->ppabp;
				$bank		= $getpeg->namabank;
				$norek		= $getpeg->norek;
				$jabatan 	= $getpeg->jabatan;
				$fakpanjang = $getpeg->ppabp;
				if ($fakpanjang == '' OR $fakpanjang == 'KP'){
					$fakpanjang = 'Kantor Pusat';
				}
			}
		}
		if ($jabatan == ''){ $jabatan = 'PESERTA'; }
		if ($namasaja == '' AND $nama != ''){
			$namasaja = $nama;
		}
		return response()->json(['namasaja' => $namasaja, 'tandatangan' => $tandatangan, 'nama' => $nama, 'unitkerja' => $fakpanjang, 'bank' => $bank, 'norek' => $norek, 'jabatan' => $jabatan]);
		return back();
	}
	public function ctkPresensiWebinar($id){
		$homebase		= url("/");
		$kementerian	= strtoupper(Session('subdomainapps01'));
		$kota 			= strtoupper(Session('kota01'));
		$universitas 	= strtoupper(Session('domainapps01'));
		$namaapp 		= strtoupper(Session('namaapps01'));
		$fakpanjang		= Session('subsubdomainapps01');
		$mons 			= array(0 => "", 1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
		$kalender		= array(0 => "", 1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$alamatweb		= $homebase.'/ctkpesertarapat/'.$id;
		$qrcode 		= QrCode::size(150)->generate($alamatweb);		
		$getdata		= WebinarEventlist::where('id', $id)->first();
		$data			= [];
		if (isset($getdata->nama)){
			$nama			= $getdata->nama;
			$tempat			= $getdata->tempat;
			$mulai			= $getdata->mulai;
			$pengumumans	= $getdata->pengumumans;
			$akhir			= $getdata->akhir;
			$fakultas		= $getdata->fakultas;
			if ($getdata->linkmateri == '' OR $getdata->linkmateri == null){
				$created_by = $getdata->created_by;
			} else {
				$created_by	= $getdata->linkmateri;
			}
			$getjam1		= explode(" ", $mulai);
			$jam1			= $getjam1[1];
			$getjam2		= explode(" ", $akhir);
			$jam2			= $getjam2[1];
			$cekhari2 		= DateTime::createFromFormat('Y-m-d', $getdata->tanggal);
			$hari 			= $cekhari2->format('D');
			$hariinggris	= $hari;
			if ($hari == 'Mon'){ $hari = 'Senin'; }
			if ($hari == 'Tue'){ $hari = 'Selasa'; }
			if ($hari == 'Wed'){ $hari = 'Rabu'; }
			if ($hari == 'Thu'){ $hari = 'Kamis'; }
			if ($hari == 'Fri'){ $hari = 'Jumat'; }
			if ($hari == 'Sat'){ $hari = 'Sabtu'; }
			if ($hari == 'Sun'){ $hari = 'Minggu'; }
			$tulisawkt2 	= $hari.', '.$getdata->mulai;
			$tulisawkt1 	= $hariinggris.', '.$getdata->mulai;
			$tulisawkt 		= '<div style="line-height:0.9">
								<font style="font-size:13px">: '.$tulisawkt2.'</font><br />
								<i style="font-size:x-small">&nbsp;&nbsp;'.$tulisawkt1.'</i>
							</div>';
			$judul 			= '<div style="line-height:0.9">
							<font style="font-size:20px">Daftar Hadir<br />'.$nama.'</font>
						</div>';
			
			
			$fakpanjang		= strtoupper($fakpanjang);
			$blniki 		= date("m");
			$tgliki 		= date("d");
			$tahun 			= date("Y");
			$bulaniki 		= (int)$blniki;
			$sakniki 		= $tgliki.' '.$kalender[$bulaniki].' '.$tahun;
			$ceksek1		= WebinarPartisipan::where('idevent', $id)->count();
			$nomer			= 1;
			$peserta		= '';
			$kelipatan		= 1;
			$gangen 		= 'Ganjil';
			if ($ceksek1 == 0){
				while ($nomer != 41) {
					$peserta = $peserta.'<tr><td align="center" height="30" >'.$nomer.'</td><td style="white-space: nowrap;">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
					$nomer++;
				}
			} else {
				$jjadwal		= WebinarPartisipan::where('idevent', $id)->orderBy('pekerjaan')->get();
				if (!empty($jjadwal)){
					foreach ($jjadwal as $rjadwal) {
						if ($kelipatan == 16){
							$kelipatan 	= 1;
							$gangen		= 'Ganjil';
							$peserta 	= $peserta.'</table></td></tr></table><div style="page-break-before: always">';
							$peserta 	= $peserta.'<table id="printiki" width="640" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td colspan="2" rowspan="4" align="left"><img src="'.Session('logofrontapps01').'" width="80" height="80" alt=""/></td>	  
														<td colspan="9"><b>'.$kementerian.'</b></td>	
													</tr>
													<tr>
														<td colspan="9"><b>'.$universitas.', '.$kota.'</b></td>	  
													</tr>
													<tr>
														<td colspan="9"><b><u>'.$fakpanjang.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>	  
													</tr>
													<tr>
														<td colspan="3" align="center">&nbsp;</td>
														<td width="100">&nbsp;</td>
														<td width="65">&nbsp;</td>
														<td width="67">&nbsp;</td>
														<td width="133">&nbsp;</td>
														<td width="42">&nbsp;</td>
														<td colspan="3">&nbsp;</td>
													</tr>
													<tr>
														<td colspan="3" align="center">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td colspan="3">&nbsp;</td>
													</tr>
													<tr>
														<td colspan="11" align="center"><font style="font-size:16px"><b>'.$judul.'</b></font></td>
													</tr>    
													<tr>
														<td colspan="3" align="center">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td colspan="3">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><div style="line-height:0.9"><font style="font-size:13px">Tempat</font> <br /><i style="font-size:x-small">Location</i></div></td>
														<td align="left" valign="top">:</td>
														<td colspan="5" align="left" valign="top"><font style="font-size:13px">'.$tempat.'</font></td>
														<td align="left" valign="top">
															<div style="line-height:0.9">
																<font style="font-size:13px">Tanggal dan Jam</font><br />
																<i style="font-size:x-small">Date Time</i>
															</div>      
														</td>
														<td colspan="3" valign="top">'.$tulisawkt.'</td>
													</tr>
													<tr>
														<td align="left">&nbsp;</td>
														<td align="left">&nbsp;</td>
														<td align="left">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td colspan="4">&nbsp;</td>
													</tr>   
													<tr>
														<td colspan="11">';
							if ($pengumumans == 'REKENING'){
								$peserta = $peserta.'
												<table width="640" border="1" class="table" cellspacing="0" cellpadding="0">
													<tr>
														<th width="50" align="center">NO</th>
														<th width="200" align="center">NAMA</th>
														<th width="150" align="center">UNIT KERJA</th>
														<th width="100" align="center">NAMA BANK</th>
														<th width="100" align="center">NOMOR REKENING</th>
														<th colspan="2" width="120" align="center">TANDATANGAN</th>
													</tr>';

							} else {
								$peserta = $peserta.'
												<table width="640" border="1" class="table" cellspacing="0" cellpadding="0">
													<tr>
														<th width="50" align="center">NO</th>
														<th width="200" align="center">NAMA</th>
														<th width="150" align="center">UNIT KERJA</th>
														<th width="200" align="center">JABATAN</th>
														<th colspan="2" width="120" align="center">TANDATANGAN</th>
													</tr>';
							}
						}
						if ($pengumumans == 'REKENING'){
							$peserta = $peserta.'<tr><td align="center" height="30" style="white-space: nowrap;">'.$nomer.'</td><td>'.$rjadwal->nama.'</td><td>'.$rjadwal->instansi.' ('.$rjadwal->pekerjaan.')</td><td>'.$rjadwal->namabank.'</td><td>'.$rjadwal->norek.'</td>';
							if ($gangen == 'Ganjil'){
								$peserta = $peserta.'<td width="60" ><img style="margin:2px; margin-left: 10px;" width="60" src="'.$rjadwal->foto.'"></td><td>&nbsp;</td></tr>';
							} else {
								$peserta = $peserta.'<td width="60" >&nbsp;</td><td width="60" ><img style="margin:2px; margin-left: 10px;" width="60" src="'.$rjadwal->foto.'"></td></tr>';
							}
						
						} else {
							$peserta = $peserta.'<tr><td align="center" height="30" style="white-space: nowrap;">'.$nomer.'</td><td>'.$rjadwal->nama.'</td><td>'.$rjadwal->instansi.'</td><td>'.$rjadwal->pekerjaan.'</td>';
							if ($gangen == 'Ganjil'){
								$peserta = $peserta.'<td width="60" ><img style="margin:2px; margin-left: 10px;" width="60" src="'.$rjadwal->foto.'"></td><td>&nbsp;</td></tr>';
							} else {
								$peserta = $peserta.'<td width="60" >&nbsp;</td><td width="60" ><img style="margin:2px; margin-left: 10px;" width="60" src="'.$rjadwal->foto.'"></td></tr>';
							}
						}
						$nomer++;
						$kelipatan++;
						if ($gangen == 'Ganjil'){ $gangen = 'Genap'; }
						else { $gangen = 'Ganjil'; }
					}
				}
			}
			$peserta = $peserta.'</table></td></tr>
				<tr><td colspan="11" align="center">&nbsp;</td></tr>
				<tr>
					<td align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="4">Malang, '.$sakniki.'</td>
				</tr>
				<tr><td colspan="11" align="center">&nbsp;</td></tr>
				<tr><td colspan="11" align="center">&nbsp;</td></tr>
				<tr><td colspan="11" align="center">&nbsp;</td></tr>
				<tr>
					<td align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="4">'.$created_by.'</td>
				</tr>
				</table>
			';
			$generatetbl	= '
			<table id="printiki" width="640" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td colspan="2" rowspan="4" align="left"><img src="'.Session('logofrontapps01').'" width="80" height="80" alt=""/></td>	  
				<td colspan="9"><b>'.$kementerian.'</b></td>	
				</tr>
				<tr>
					<td colspan="9"><b>'.$universitas.', '.$kota.'</b></td>	  
				</tr>
				<tr>
					<td colspan="9"><b><u>'.$fakpanjang.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>	  
				</tr>
				<tr>
					<td colspan="3" align="center">&nbsp;</td>
					<td width="100">&nbsp;</td>
					<td width="65">&nbsp;</td>
					<td width="67">&nbsp;</td>
					<td width="133">&nbsp;</td>
					<td width="42">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" align="center">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="11" align="center"><font style="font-size:16px"><b>'.$judul.'</b></font></td>
				</tr>    
				<tr>
					<td colspan="3" align="center">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td align="left" valign="top"><div style="line-height:0.9"><font style="font-size:13px">Tempat</font> <br /><i style="font-size:x-small">Location</i></div></td>
					<td align="left" valign="top">:</td>
					<td colspan="5" align="left" valign="top"><font style="font-size:13px">'.$tempat.'</font></td>
					<td align="left" valign="top">
						<div style="line-height:0.9">
							<font style="font-size:13px">Tanggal dan Jam</font><br />
							<i style="font-size:x-small">Date Time</i>
						</div>      
					</td>
					<td colspan="3" valign="top">'.$tulisawkt.'</td>
				</tr>
				<tr>
					<td align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="4">&nbsp;</td>
				</tr>   
				<tr>
					<td colspan="11">';
			if ($pengumumans == 'REKENING'){
				$generatetbl = $generatetbl.'
						<table width="720" border="1" class="table" cellspacing="0" cellpadding="0">
							<tr>
								<th width="50" align="center">NO</th>
								<th width="200" align="center">NAMA</th>
								<th width="150" align="center">UNIT KERJA</th>
								<th width="100" align="center">NAMA BANK</th>
								<th width="100" align="center">NOMOR REKENING</th>
								<th colspan="2" width="120" align="center">TANDATANGAN</th>
							</tr>';

			} else {
				$generatetbl = $generatetbl.'
						<table width="640" border="1" class="table" cellspacing="0" cellpadding="0">
							<tr>
								<th width="50" align="center">NO</th>
								<th width="200" align="center">NAMA</th>
								<th width="150" align="center">UNIT KERJA</th>
								<th width="200" align="center">JABATAN</th>
								<th colspan="2" width="120" align="center">TANDATANGAN</th>
							</tr>';
			}
			echo $generatetbl.$peserta;
		} else {
			echo 'Data Dengan ID => '.$id.' Tidak di Temukan';
		}
	}
	public function viewEOMode($id){
		$homebase	= url("/");
		$alamatweb	= $homebase.'/eomode/'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);		
		$cekevent	= WebinarEventlist::where('id', $id)->count();
		if ($cekevent == 0){
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'ID Event '.$id.' is Missing';
            return view('errors.notready', $data);
		} else {
			$nama_lengkap		= Session('nama');
			$fakpanjang			= '';
			$tandatangan		= '';
			$setttd				= '';
			$norek				= '';
			$bank				= '';
			$namasaja 			= '';
			$email  			=  Session('email');
        	if ($email != '') {
        		$getfakultas= User::where('email', $email)->first();
				if (isset($getfakultas->nip)){
					$idpeg 			= $getfakultas->nip;
					$fakpanjang 	= $getfakultas->fakpanjang;
					$tandatangan 	= $getfakultas->tandatangan;
					$namasaja 		= $getfakultas->nama;
					if ($fakpanjang == ''){ $fakpanjang = 'Kantor Pusat'; }
					$users 	= Simpegpegawai::where('id', $idpeg)->first();
					if (isset($users->nama_lengkap)){
						$namasaja		= $users->nama;
						$nama_lengkap	= $users->nama_lengkap;	
						$bank			= $users->namabank;
						$norek			= $users->norek;
					}
				}
			}
			if (is_null($tandatangan) OR $tandatangan == ''){
				$getfakultas= User::where('id', '2')->first();
				if (isset($getfakultas->paraf)){
					$tandatangan 	= $getfakultas->paraf;
				}
			}
			if (is_null($tandatangan) OR $tandatangan == ''){
				$tandatangan	= $homebase.'/dist/img/boxed-bg.jpg';
			}
			$revent				= WebinarEventlist::where('id', $id)->first();
			$nama				= $revent->nama; 
			$tempat				= $revent->tempat; 
			$kapasitas			= $revent->kapasitas; 
			$tanggal			= $revent->tanggal; 
			$mulai				= $revent->mulai; 
			$akhir				= $revent->akhir; 
			$bayar				= $revent->bayar; 
			$kontak				= $revent->kontak; 
			$pembicara			= $revent->pembicara; 
			$daftarmulai		= $revent->daftarmulai; 
			$daftarakhir		= $revent->daftarakhir; 
			$absenmulai			= $revent->absenmulai; 
			$absenakhir			= $revent->absenakhir; 
			$created_by			= $revent->created_by; 
			$linkwebniar		= $revent->linkwebniar;
			$pengumumans		= $revent->pengumumans;
			$ijinkan 			= '';
			$pembuat 			= 'NO';
			if ($created_by == $email){
				$ijinkan 		= 'YES';
				$pembuat 		= 'YES';
			} else {
				$cekpeserta 	= WebinarPartisipan::where('email', $email)->where('idevent', $id)->count();
				if ($cekpeserta != 0){
					$ijinkan 	= 'YES';
				}
			}
			if (Session('username') == 'admin'){ $ijinkan = 'YES'; }
			if ($ijinkan == 'YES'){
				$data['namasaja']		= $namasaja;
				$data['pengumumans']	= $pengumumans;
				$data['bank']			= $bank;
				$data['norek']			= $norek;
				$data['datane']			= $revent;
				$data['fakpanjang']		= $fakpanjang;
				$data['nama_lengkap']	= $nama_lengkap;
				$data['email']			= $email;
				$data['idevent']		= $id;
				$data['nama']			= $nama;
				$data['tandatangan']	= $tandatangan;
				$data['pembuat']		= $pembuat;
				$data['arrallpeg']  	= Simpegpegawai::where('ppabp', '!=', 'Rekrutmen PT DPM')->where('status_pegawai', '1')->get();
				return view('webinar.admin.eomode', $data);
			} else {
				$data['kalimatheader']  	= 'Mohon Maaf';
				$data['kalimatbody']  		= 'Event ini Tertutup Untuk Anda, Mohon Pastikan anda Bagian dari Tim (Di Input Oleh Pembuat Event)';
				return view('errors.notready', $data);
			}
		}
	}
}
