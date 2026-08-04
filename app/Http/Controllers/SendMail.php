<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Defuse\Crypto\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;
use Spatie\PdfToImage\Pdf;
use App\Suratmasuk;
use App\Suratkeluar;
use App\Suratkeluartnpnomor;
use App\User;
use App\Inboxsurat;
use App\Firebasebank;
use App\Models\Tabelskdanperaturan;
use App\Models\Pesennomor;
use App\Models\Draftsk;
use Mail;
use QrCode;
use PDFCREATOR;

define( 'API_ACCESS_SEND', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );

class SendMail extends Controller
{
    //
    protected static $pass = 'S1v3pY0uB3e';
    protected static function enkrip($string){
        return Crypto::encryptWithPassword($string,self::$pass);
    }
    public static function dekrip($enc){
        try{
	        return Crypto::decryptWithPassword($enc,self::$pass);
		}catch (\Exception $e){
            return false;
		}
    }
    public static function kirim($to_name,$to_email,$forget=false){
        $date=date('YmdHis');
        $cekdata = User::where('email', $to_email)->orderBy('id', 'DESC')->first();
        if (isset($cekdata->id)){
            if($forget){
                $string_enc     = $to_email.'|'.$date.'|FOR';
                $url            = url('/verifikasiemail').'?key='.self::enkrip($string_enc);
                $subject        = 'Ubah Password ('.$cekdata->fakpanjang.')';
                $subjectmail    = 'Ubah Password';
                $note           = 'Anda telah melakukan permohonan ubah password. Silahkan klik link berikut untuk melanjutkan proses.';
                DB::table('password_resets')->insert([
                    'email'     => $to_email,
                    'token'     => self::enkrip($string_enc),
                    'created_at'=> date("Y-m-d H:i:s")
                ]);
            }else{
                $string_enc     = $to_email.'|'.$date.'|VER';
                $url            = url('/verifikasiemail').'?key='.self::enkrip($string_enc);
                $subject        = 'Verifikasi Email ('.$cekdata->fakpanjang.')';
                $subjectmail    = 'Verifikasi Email';
                $note           = 'Email anda telah terdaftar di Aplikasi ('.$cekdata->fakpanjang.') Email ini dapat digunakan jika anda lupa password. Selanjutnya dimohon Bapak/Ibu membuat password untuk login ke aplikasi dengan cara Klik Tombol di bawah ini.';
            }
            $data = array(
                'nama_lengkap'      => $to_name, 
                'fakultas'          => $cekdata->fakpanjang, 
                'url_verifikasi'    => $url,
                'forget'            => $forget,
                'subject'           => $subjectmail, 
                'note'              => $note,
            );
            if ($to_email != 'arsiparis@localhost.com'){
                Mail::send('mail/user', $data, function($message) use ($to_name, $to_email, $subject) {
                    $message->to($to_email, $to_name)->subject($subject);
                    $message->from('swandhana.fp@ub.ac.id','Mail Admin');
                });
            }
        }
    }
    public static function kirimUser($to_name,$to_email,$to_username,$password,$ubahpass=false){
        $date=date('YmdHis');
        $cekdata = User::where('email', $to_email)->first();
        if (isset($cekdata->id)){
            if($ubahpass){
                $subject    = 'Password User Diubah ('.$cekdata->fakpanjang.')';
                $note       = 'Password anda telah diubah oleh admin dengan password berikut:';
            }else{
                $subject    = 'User Didaftarkan ('.$cekdata->fakpanjang.')';
                $note       = 'Email anda telah terdaftar di Aplikasi ('.$cekdata->fakpanjang.'). Email ini dapat digunakan jika anda lupa password. Untuk login silahkan akses dengan user <b>'.$to_username.'</b> atau email ini dan dengan password berikut:';
            }
            $data = array(
                'nama_lengkap'  => $to_name, 
                'password'      => $password,
                'subject'       => $subject,
                'note'          => $note,
            );
            if ($to_email != 'arsiparis@localhost.com'){
                Mail::send('mail/useradmin', $data, function($message) use ($to_name, $to_email, $subject) {
                    $message->to($to_email, $to_name)->subject($subject);
                    $message->from('swandhana.fp@ub.ac.id','Mail Admin');
                });
            }
        }
    }
    public static function notif($to_name,$to_email,$subject,$note){
        $data = array(
            'nama_lengkap'  => $to_name,
            'subject'       => $subject,
            'note'          => $note,
        );
        if ($to_email != 'arsiparis@localhost.com'){
            Mail::send('mail/notif', $data, function($message) use ($to_name, $to_email, $subject) {
                $message->to($to_email, $to_name)->subject($subject);
                $message->from('swandhana.fp@ub.ac.id','Mail Admin');
            });
        }
        $jtokencari 	= User::where('email', $to_email)->whereNotNull('firebaseid')->get();
        if (!empty($jtokencari)){
            foreach ( $jtokencari as $rtokencari ){
                $firebaseid = $rtokencari->firebase;
                $msg = array (
                    'message' 	=> $subject,
                    'title'		=> Session('namaapps01'),
                    'subtitle'	=> Session('fakpanjang'),
                    'tickerText'=> 'Notification Centre',
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
                        "title" => Session('namaapps01'),
                        "sound" => "default",
                        "body" 	=> $subject
                    ],
                    'data'			=> $msg
                    
                );
                $headers = array
                (
                    'Authorization: key=' . API_ACCESS_SEND,
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
    }
    public static function kiriminbox($marking,$pengirim,$penerima,$email,$jenis,$kerja,$catatan,$tanggal){
        $footnote   = $catatan;
        $catatan    = '';
        $jenissrt   = '';
        $perihal    = 'Mail From '.$pengirim;
        $ceksurat 	= Suratkeluar::where('marking', $marking)->count();
        if ($ceksurat == 0){
            $ceksurat 	= Tabelskdanperaturan::where('marking', $marking)->count();
            if ($ceksurat == 0){
                $ceksurat 	= Suratkeluartnpnomor::where('marking', $marking)->count();
                if ($ceksurat == 0){
                    $getdatasurat 	= Draftsk::where('marking', $marking)->first();
                    if (isset($getdatasrt->id)){
                        $jenissrt 		= $getdatasurat->jenissk;
                        $paraf1 		= $getdatasurat->paraf1;
                        $paraf2 		= $getdatasurat->paraf2;
                        $paraf3 		= $getdatasurat->paraf3;
                        $paraf4 		= $getdatasurat->paraf4;	
                        $penandatangan 	= $getdatasurat->penandatangan;
                        $idsurat 	    = $getdatasurat->id;
                        $noagenda       = '';
                        $tglsurat       = $getdatasurat->tanggalsk;
                        $nosurat        = $getdatasurat->nomor.' TAHUN '.$getdatasurat->tahun;
                        $kepada         = $getdatasurat->nama;
                        $perihal        = $getdatasurat->judulsk;
                        $alamat         = $getdatasurat->nip;
                        $lampiran       = '';
                        $kodefak        = '';
                        $klasifikasi    = '';
                        $pembuat        = $getdatasurat->konseptor;
                        $unit           = $getdatasurat->unitkonseptor;
                        $tabel          = 'DRAFTSK';
                    } else {
                        $getdatamsk 	= Suratmasuk::where('marking', $marking)->first();
                        if (isset($getdatamsk->id)){
                            $jenissrt 		= $getdatamsk->bentuk;
                            $paraf1 		= '';
                            $paraf2 		= '';
                            $paraf3 		= '';
                            $paraf4 		= '';
                            $penandatangan 	= '';
                            $idsurat 	    = $getdatamsk->id;
                            $noagenda       = '';
                            $tglsurat       = $getdatamsk->tglsurat;
                            $nosurat        = $getdatamsk->nosurat;
                            $kepada         = $penerima;
                            $perihal        = $getdatamsk->perihal;
                            $alamat         = '';
                            $lampiran       = '';
                            $kodefak        = '';
                            $klasifikasi    = '';
                            $pembuat        = $getdatamsk->pembuat;
                            $unit           = $getdatamsk->fakultas;
                            $tabel          = 'MASUK';
                        } else {
                            $paraf1 		= '';
                            $paraf2 		= 0;
                            $paraf3 		= 0;
                            $paraf4 		= 0;
                            $penandatangan	= 0;
                            $idsurat 	    = 0;
                            $noagenda       = '';
                            $tglsurat       = '';
                            $nosurat        = '';
                            $kepada         = '';
                            $perihal        = '';
                            $alamat         = '';
                            $lampiran       = '';
                            $kodefak        = '';
                            $klasifikasi    = '';
                            $pembuat        = '';
                            $unit           = '';
                            $tabel          = '';
                        }
                    }
                } else {
                    $getdatasurat 	= Suratkeluartnpnomor::where('marking', $marking)->first();
                    $jenissrt 		= $getdatasurat->jenissrt;
                    $paraf1 		= $getdatasurat->paraf1;
                    $paraf2 		= $getdatasurat->paraf2;
                    $paraf3 		= $getdatasurat->paraf3;
                    $paraf4 		= $getdatasurat->paraf4;
                    $penandatangan 	= $getdatasurat->pejabat;
                    $idsurat 	    = $getdatasurat->id;
                    $noagenda       = '';
                    $tglsurat       = $getdatasurat->tglbuat;
                    $nosurat        = $getdatasurat->marking;
                    $kepada         = $getdatasurat->kepada;
                    $perihal        = $getdatasurat->perihal;
                    $alamat         = $getdatasurat->alamat;
                    $lampiran       = '';
                    $kodefak        = $getdatasurat->kodefak;
                    $klasifikasi    = $getdatasurat->faskode;
                    $pembuat        = $getdatasurat->pembuat;
                    $unit           = $getdatasurat->kelompok;
                    $tabel          = 'KELUARNONOMER';
                }	
            } else {
                $getdatasurat 	= Tabelskdanperaturan::where('marking', $marking)->first();
                $paraf1 		= $getdatasurat->paraf1;
                $paraf2 		= $getdatasurat->paraf2;
                $paraf3 		= $getdatasurat->paraf3;
                $paraf4 		= $getdatasurat->paraf4;
                $penandatangan 	= $getdatasurat->penandatangan;
                $jenissrt 	    = $getdatasurat->kelompok;
                $idsurat 	    = $getdatasurat->id;
                $noagenda       = '';
                $tglsurat       = $getdatasurat->tanggal;
                $nosurat        = $getdatasurat->nomor.' TAHUN '.$getdatasurat->tahun;
                $kepada         = $getdatasurat->namaparaf1;
                $perihal        = $getdatasurat->judul;
                $alamat         = $getdatasurat->sparaf1;
                $lampiran       = '';
                $kodefak        = $getdatasurat->kelompok;
                $klasifikasi    = $getdatasurat->kodefas;
                $pembuat        = $getdatasurat->inputor;
                $unit           = $getdatasurat->catatan;
                $tabel          = 'SKDANPERATURAN';
            }
        } else {
            $getdatasurat 	= Suratkeluar::where('marking', $marking)->first();
            $paraf1 		= $getdatasurat->paraf1;
            $paraf2 		= $getdatasurat->paraf2;
            $paraf3 		= $getdatasurat->paraf3;
            $paraf4 		= $getdatasurat->paraf4;
            $penandatangan 	= $getdatasurat->pejabat;
            $jenissrt 	    = $getdatasurat->jenissrt;
            $idsurat 	    = $getdatasurat->id;
            $noagenda       = '';
            $tglsurat       = $getdatasurat->tglsurat;
            $nosurat        = $getdatasurat->nomor.'/'.$getdatasurat->fakultas.'/'.$getdatasurat->kodefak.'/'.$getdatasurat->monsrt.'/'.$getdatasurat->yersrt;
            $kepada         = $getdatasurat->kepada;
            $perihal        = $getdatasurat->perihal;
            $alamat         = $getdatasurat->alamat;
            $lampiran       = '';
            $kodefak        = $getdatasurat->kodefak;
            $klasifikasi    = $getdatasurat->faskode;
            $pembuat        = $getdatasurat->pembuat;
            $unit           = $getdatasurat->kelompok;
            $tabel          = 'KELUAR';
        }
        if ($jenissrt == 'Perjanjian Orientasi Kerja') { $catatan = 'KONTRAK'; }
        try{
	        $idinbox    = Inboxsurat::insertGetId([
                'marking'  		=> $marking,
                'pengirim'  	=> $pengirim,
                'penerima'		=> $penerima,
                'email'			=> $email,
                'status'		=> 'send',
                'sifat'			=> 5,
                'jenis'			=> $jenis,
                'kerja'			=> $kerja,
                'catatan'		=> $catatan,
                'footnote'		=> $footnote,
                'tandatangan'	=> '',
                'tanggal'		=> $tanggal,
            	'idsurat'		=> $idsurat,
                'noagenda'		=> $noagenda,
                'tglsurat'		=> $tglsurat,
                'jenissrt'		=> $jenissrt,
                'nosurat'		=> $nosurat,
                'kepada'		=> $kepada,
                'perihal'		=> $perihal,
                'alamat'		=> $alamat,
                'lampiran'		=> $lampiran,
                'kodefak'		=> $kodefak,
                'klasifikasi'	=> $klasifikasi,
                'pembuat'		=> $pembuat,
                'unit'			=> $unit,
                'tabel'			=> $tabel,
                'penandatangan'	=> $penandatangan,
                'paraf1'	    => $paraf1,
                'paraf2'	    => $paraf2,
                'paraf3'	    => $paraf3,
                'paraf4'	    => $paraf4,
            ]);
            $string_enc = $email.'|'.$idinbox.'|VER';
            $url        = url('/openinbox').'?key='.self::enkrip($string_enc);
            if ($kerja == 'MASUK'){
                if ($penerima == 'Arsiparis'){
                    Suratmasuk::where('marking', $marking)->update([
                        'status'    => 'arsip',
                        'disposisi' => ''
                    ]);
                } else {
                    Suratmasuk::where('marking', $marking)->update([
                        'status'    => 'disposisi',
                        'disposisi' => 'Ke '.$penerima
                    ]);    
                }
            }
            $tuliskirim     = 'Dari '.$pengirim.' '.$jenis.' ('.$kerja.') <p><a href="'.$url.'" style="display:inline-block;background:#e85034;color:#ffffff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:100%;Margin:0;text-decoration:none;text-transform:none;padding:9px 26px 9px 26px;mso-padding-alt:0px;border-radius:24px;" target="_blank">Direct Open Mailbox</a></p> NB : Sebelum membuka link diatas, pastikan Bapak/Ibu sudah login ke aplikasi '.url('/');
            $cariiduser 	= User::where('email', $email)->get();
            if (!empty($cariiduser)){
                foreach($cariiduser as $riduser){
                    $idcaritoken	= $riduser->id;
                    $jtokencari	    = Firebasebank::where('userid', $idcaritoken)->get();
                    if (!empty($jtokencari)){
                        foreach ( $jtokencari as $rtokencari ){
                            $firebaseid = $rtokencari->firebase;
                            $msg        = array (
                                'message' 	=> $tuliskirim,
                                'title'		=> Session('namaapps01'),
                                'subtitle'	=> Session('fakpanjang'),
                                'tickerText'=> 'Notification Centre',
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
                                    "title" => Session('namaapps01'),
                                    "sound" => "default",
                                    "body" 	=> $tuliskirim
                                ],
                                'data'			=> $msg
                            );
                            $headers = array
                            (
                                'Authorization: key=' . API_ACCESS_SEND,
                                'Content-Type: application/json'
                            );
                            $url = 'https://fcm.googleapis.com/fcm/send';
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
                            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                            $result = curl_exec($ch);
                            curl_close($ch);
                        }
                    }
                }
            }
            $data = array(
                'nama_lengkap'  => $penerima, 
                'password'      => '',
                'subject'       => $perihal,
                'note'          => $tuliskirim,
            );
            if ($perihal == null){
                $perihal = 'Mail Service';
            }
            if ($email != 'arsiparis@localhost.com'){
                Mail::send('mail/notif', $data, function($message) use ($penerima, $email, $perihal) {
                    $message->to($email, $penerima)->subject($perihal);
                    $message->from('swandhana.fp@ub.ac.id','Mail Admin');
                });
            }
		} catch (\Exception $e){
            return $e->getMessage();
		}
    }
    public static function genQRCodefile($marking,$nmttd,$konseptor,$tanggalesign, $alamatweb){
        if (File::exists(public_path() ."/scan/generate/bg-". $marking.".png") OR File::exists(base_path() ."/public/scan/generate/bg-". $marking.".png") OR File::exists(base_path() ."/public/scan/generate/bg-". $marking.".png")) {
        } else {
            $page_format	= array(
                'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 356),
                'Dur' => 3,
                'PZ' => 1,
            );
            $qrcode 		= QrCode::format('png')->size(100)->generate($alamatweb);
            Storage::disk('local')->put('/scan/generate/qrimg-'.$marking.'.png', $qrcode);
	        $homebase	    = url("/");
			
            $generatesurat 	=   '<table width="720" border="0" cellpadding="0" cellspacing="0">
                                    <tr><td width="20">&nbsp;</td><td width="80">&nbsp;</td><td width="10">&nbsp;</td><td width="310">&nbsp;</td><td width="300">&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr>
                                        <td width="20">&nbsp;</td>
                                        <td width="80"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="60" /></td>
                                        <td width="10">&nbsp;</td>
                                        <td width="610" colspan="2">
                                        <font size="7" color="blue">Untuk menjadi perhatian :<br />
                                            1. UU ITE Nomor 11 Tahun 2008 Pasal 5 Ayat 1<br />
                                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;"Informasi Elektronik dan/atau Dokumen Elektronik dan/atau hasil cetakannya merupakan alat bukti yang sah"<br />
                                            2. Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik oleh '.$konseptor.' pada '.$tanggalesign.'<br />
                                            3. Hasil cetakan dokumen ini merupakan Salinan dari File di Server '.$homebase.' dan Verifikasi dokumen ini melalui QR Code</font>
                                        </td>
                                    </tr>
                                </table>';
                $data['marking']   	= 'bg-'.$marking.'.png';
				$data['surate']   	= $generatesurat;
				$text 				= view('cetak.qrimage', $data);
                PDFCREATOR::SetCreator(Session('namaapps'));
                PDFCREATOR::SetAuthor(Session('nama'));
                PDFCREATOR::SetTitle('QR Image');
                PDFCREATOR::SetSubject('Kode');
                PDFCREATOR::SetKeywords('-');
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
                Storage::disk('local')->put('/scan/generate/bg-'.$marking.'.pdf', $pdfdoc);
	            $pathToPdf 			= public_path().'/scan/generate/bg-'.$marking.'.pdf';
                $path 				= public_path().'/scan/generate/bg-'.$marking.'.png';
                $pdf                = new Pdf($pathToPdf);
                $pdf->saveImage($path);
        }
    }
    public static function genQRSatuNomor($jumlah){
        $dd 	  		= date("d");
        $mm 	  		= date("m");
        $yy 	  		= date("Y");
        $thncari		= $yy.'-%';
        $tlstgl			= $yy.'-'.$mm.'-'.$dd;
        $fakultas		= Session('fakultas');
        $ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->where('fakultas', $fakultas)->orderBy('nomor', 'DESC')->count();
        if ($ceknomorsrt == 0){
            $nomor 		= 1;
        }else {
            $ceknomorsrt= Suratkeluar::where('yersrt', $yy)->where('fakultas', $fakultas)->orderBy('nomor', 'DESC')->first();
            $lastno		= $ceknomorsrt->nomor;
            $nomor 		= $lastno+1;
        }
        $ceknomormaju		= Suratkeluar::where('tglsurat', $tlstgl)->orderBy('nomor', 'ASC')->where('fakultas', 'ODR-'.$fakultas)->first();
        if (isset($ceknomormaju->nomor)){
            $nomormsdepan	= $ceknomormaju->nomor;
            if ($nomormsdepan == $nomor){
                Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', 'ODR-'.$fakultas)->update([
                    'fakultas'	=> $fakultas
                ]);
            }
            if ($nomor < $nomormsdepan){
                $getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
                $idnomor		= $getid->id;
                $idnomor		= $idnomor + 1;
                while($nomor != $nomormsdepan) {
                    $marking 	= $fakultas.'-OUT-'.$yy.$idnomor;
                    $kerjanya 	= Suratkeluar::insertGetId([
                        'marking' 		=>  $marking,
                        'jenissrt' 		=>  $ceknomormaju->jenissrt,
                        'nomor' 		=>  $nomor,
                        'anakno' 		=>  '',
                        'kodefak' 		=>  $ceknomormaju->kodefak,
                        'unit' 			=>  $ceknomormaju->unit,
                        'tglsurat' 		=>  $tlstgl,
                        'daysrt' 		=>  $dd,
                        'monsrt' 		=>  $mm,
                        'yersrt' 		=>  $yy,
                        'dasarsurat' 	=>  '',
                        'kepada' 		=>  '',
                        'alamat' 		=>  '',
                        'perihal' 		=>  '',
                        'lampiran' 		=>  '',
                        'isisurat' 		=>  $ceknomormaju->isisurat,
                        'idpejabat' 	=>  $ceknomormaju->idpejabat,
                        'pejabat' 		=>  $ceknomormaju->pejabat,
                        'namapejabat' 	=>  $ceknomormaju->namapejabat,
                        'tembusan' 		=>  '',
                        'sifat' 		=>  $ceknomormaju->sifat,
                        'klasifikasi' 	=>  $ceknomormaju->klasifikasi,
                        'pembuat' 		=>  'Slot Nomor Mundur',
                        'kelompok' 		=>  'Tata Usaha',
                        'status' 		=>  'NEW',
                        'arsip' 		=>  '',
                        'footnote' 		=>  '',
                        'tandatangan' 	=>  '',
                        'paraf1' 		=>  '',
                        'paraf2' 		=>  '',
                        'paraf3' 		=>  '',
                        'paraf4' 		=>  '',
                        'ruangarsip' 	=>  '',
                        'ordnerarsip' 	=>  '',
                        'lemariarsip' 	=>  '',
                        'faskode' 		=>  $ceknomormaju->faskode,
                        'fasmasa' 		=>  '',
                        'fasket' 		=>  '',
                        'subkode' 		=>  '',
                        'submasa' 		=>  '',
                        'subket' 		=>  '',
                        'font' 			=>  '',
                        'ukuran' 		=>  '',
                        'lebarttd' 		=>  '',
                        'filelampiran' 	=>  '',
                        'fakultas' 		=>  $fakultas
                    ]);
                    $idnomor++;
                    $nomor++;
                }
                Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', 'ODR-'.$fakultas)->update([
                    'fakultas'	=> $fakultas
                ]);
            }
            //carilagi
            $ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
            if ($ceknomorsrt == 0){
                $nomor 		= 1;
            }else {
                $ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
                $lastno		= $ceknomorsrt->nomor;
                $nomor 		= $lastno+1;
            }
        }
        $getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
        if (isset($getid->id)){
            $idnomor	= $getid->id;
            $idnomor	= $idnomor + 1;	
        } else {
            $idnomor	= 1;
        }
        $ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->where('fakultas', $fakultas)->orderBy('nomor', 'DESC')->count();
        if ($ceknomorsrt == 0){
            $nomor 		= 1;
        }else {
            $ceknomorsrt= Suratkeluar::where('yersrt', $yy)->where('fakultas', $fakultas)->orderBy('nomor', 'DESC')->first();
            $lastno		= $ceknomorsrt->nomor;
            $nomor 		= $lastno+1;
        }
        $cekpesennomor	= Pesennomor::where('nomor', $nomor)->where('fakultas', $fakultas)->count();
        if ($cekpesennomor != 0){
            $allpesenan = Pesennomor::where('fakultas', $fakultas)->get();
            foreach($allpesenan as $pesenan){
                $marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
                Suratkeluar::create([
                    'marking' 		=>  $marking,
                    'jenissrt' 		=>  $jenissrt,
                    'nomor' 		=>  $nomor,
                    'anakno' 		=>  '',
                    'kodefak' 		=>  $pesenan->kodefak,
                    'unit' 			=>  $pesenan->unit,
                    'tglsurat' 		=>  $pesenan->tglsurat,
                    'daysrt' 		=>  $pesenan->daysrt,
                    'monsrt' 		=>  $pesenan->monsrt,
                    'yersrt' 		=>  $pesenan->yersrt,
                    'dasarsurat' 	=>  '',
                    'kepada' 		=>  '',
                    'alamat' 		=>  '',
                    'perihal' 		=>  $pesenan->perihal,
                    'lampiran' 		=>  '',
                    'isisurat' 		=>  '',
                    'idpejabat' 	=>  $pesenan->idpejabat,
                    'pejabat' 		=>  $pesenan->pejabat,
                    'namapejabat' 	=>  $pesenan->namapejabat,
                    'tembusan' 		=>  '',
                    'sifat' 		=>  $pesenan->sifat,
                    'klasifikasi' 	=>  $pesenan->klasifikasi,
                    'pembuat' 		=>  $pesenan->pembuat,
                    'kelompok' 		=>  $pesenan->kelompok,
                    'status' 		=>  'NEW',
                    'arsip' 		=>  '',
                    'footnote' 		=>  '',
                    'tandatangan' 	=>  '',
                    'paraf1' 		=>  '',
                    'paraf2' 		=>  '',
                    'paraf3' 		=>  '',
                    'paraf4' 		=>  '',
                    'ruangarsip' 	=>  '',
                    'ordnerarsip' 	=>  '',
                    'lemariarsip' 	=>  '',
                    'faskode' 		=>  $pesenan->faskode,
                    'fasmasa' 		=>  '',
                    'fasket' 		=>  '',
                    'subkode' 		=>  '',
                    'submasa' 		=>  '',
                    'subket' 		=>  '',
                    'font' 			=>  '',
                    'ukuran' 		=>  '',
                    'lebarttd' 		=>  '',
                    'filelampiran' 	=>  '',
                    'fakultas' 		=>  $pesenan->fakultas,
                    'created_at' 	=>  $pesenan->created_at,
                    'updated_at' 	=>  $pesenan->updated_at
                ]);
                Pesennomor::where('id', $pesenan->id)->delete();
                $idnomor++;
                $nomor++;
            }
        }
        $marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
        $ceksek			= Suratkeluar::where('nomor', $nomor)->where('yersrt', $yy)->where('fakultas', $fakultas)->count();
        if ($ceksek != 0){
            $status 	= 'Gagal';
            $idsurat 	= 0;
            $keterangan = 'Data Double Detected, Ulangi Beberapa Saat Lagi';
        } else {
            try {
                $kerjanya 	= Suratkeluar::insertGetId([
                    'id' 			=>  $idnomor,
                    'marking' 		=>  $marking,
                    'jenissrt' 		=>  'GENERATED',
                    'nomor' 		=>  $nomor,
                    'anakno' 		=>  '',
                    'kodefak' 		=>  '',
                    'unit' 			=>  '',
                    'tglsurat' 		=>  $tlstgl,
                    'daysrt' 		=>  $dd,
                    'monsrt' 		=>  $mm,
                    'yersrt' 		=>  $yy,
                    'dasarsurat' 	=>  '',
                    'kepada' 		=>  '',
                    'alamat' 		=>  '',
                    'perihal' 		=>  '',
                    'lampiran' 		=>  '',
                    'isisurat' 		=>  '',
                    'idpejabat' 	=>  '',
                    'pejabat' 		=>  '',
                    'namapejabat' 	=>  '',
                    'tembusan' 		=>  '',
                    'sifat' 		=>  '',
                    'klasifikasi' 	=>  '',
                    'pembuat' 		=>  '',
                    'kelompok' 		=>  '',
                    'status' 		=>  'NEW',
                    'arsip' 		=>  '',
                    'footnote' 		=>  '',
                    'tandatangan' 	=>  '',
                    'paraf1' 		=>  '',
                    'paraf2' 		=>  '',
                    'paraf3' 		=>  '',
                    'paraf4' 		=>  '',
                    'ruangarsip' 	=>  '',
                    'ordnerarsip' 	=>  '',
                    'lemariarsip' 	=>  '',
                    'faskode' 		=>  '',
                    'fasmasa' 		=>  '',
                    'fasket' 		=>  '',
                    'subkode' 		=>  '',
                    'submasa' 		=>  '',
                    'subket' 		=>  '',
                    'font' 			=>  '',
                    'ukuran' 		=>  '',
                    'lebarttd' 		=>  '',
                    'filelampiran' 	=>  '',
                    'fakultas' 		=>  $fakultas
                ]);
                $status 	= 'Sukses';
                $idsurat	= $kerjanya;
                $keterangan = $nomor.' Tersimpan untuk Tanggal '.$tlstgl;
            } catch (\Exception $e) {
                $kerjanya 	= 0;
                $keterangan = $e->getMessage();
                $status 	= 'Gagal';
                $idsurat 	= 0;
            }
        }
        return response()->json(['idsurat' => $idsurat, 'keterangan' => $keterangan, 'status' => $status]);
        return back();
    }
}
