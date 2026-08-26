<?php

namespace App\Http\Controllers\Sco;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Pejabatsurat;
use App\Suratmasuk;
use App\Suratkeluar;
use App\Suratkeluartnpnomor;
use App\Inboxsurat;
use App\Disposisi;
use App\Macamdisposisi;
use App\Tujuandisposisi;
use App\Chatting;
use App\User;
use App\Jadwal;
use App\Histories;
use App\Firebasebank;
use App\Simpegpegawai;
use App\Detailpegawai;
use App\Penerimasurat;
use App\Files;
use App\Filess;
use App\Pengumuman;
use App\WebinarPartisipan;
use App\WebinarEventlist;
use App\JadwalPiket;

use App\Models\Hakaksess;
use App\Models\Klasifikasi;
use App\Models\Kelompoklain;
use App\Models\Jenissurat;
use App\Models\Unitsurat;
use App\Models\Tabelskdanperaturan;
use App\Models\Simsppdpengikut;
use App\Models\Simsppdbiayaperjalanan;
use App\Models\Kelasremun;
use App\Models\Golongan;
use App\Models\Draftsk;
use App\Models\Arsipsurat;
use App\Models\Templateskpp;
use App\Models\TblGaji;
use App\Models\Dokarkgb;
use App\Models\DraftRemunerasi;
use App\Models\DraftKenaikanpangkat;
use App\Models\Drafttubel;
use App\Models\Draftpemberhentian;
use App\Models\Draftjabakad;
use App\Models\DraftpengangkatanPNS;
use App\Models\Tblemailkepegkeu;
use App\Models\Ecekdata;
use App\Models\Antrian;
use App\Models\AntrianUjian;
use App\Models\AntrianMagang;
use App\Models\Jadwalkuliah;
use App\Models\Biodata;
use App\Models\Settingcuti;
use App\Models\Bantuansyarat;
use App\Models\Bantuanpenerima;
use App\Models\Pesennomor;
use App\Models\Ekspedisi;
use App\Models\Penerimabeasiswa;
use App\Models\Pengajuansimpukja;
use App\Models\AntrianTTE;
use App\Models\Tugasdeveloper;
use App\Models\Dosen;
use App\Models\Detailidentitas;
use App\Models\Detailpendidikan;
use App\Models\Detaildiklat;
use App\Models\Detailasesor;
use App\Models\Detailorganisasi;
use App\Models\Detailseminar;
use App\Models\Detailanggotakeluarga;
use App\Models\Detailmutasi;
use App\Models\Detailsertifikat;

use Spatie\Browsershot\Browsershot;
use VerumConsilium\Browsershot\Facades\Screenshot;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use Gufy\PdfToHtml\Html;
use Gufy\PdfToHtml\Pdf;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Tcpdf\Fpdi;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Validator;
use Session;
use Notification;
use QrCode;
use Response;
Use Exception;
use Hash;
use PDFCREATOR;
use Browser;
use DateTime;
define( 'API_ACCESS_KEY2', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );
class DashbordsuratController extends Controller
{
	public function viewSerfitikatsetting($id) {
		$i 			= 0;
		$fakultas	= Session('fakultas');
		$data		= [];
		$pejabats	= [];
		$getsurat	= Suratkeluar::where('id', $id)->first();
		if (isset($getsurat->id)){
			$jenissrt	= $getsurat->jenissrt;
			if ($jenissrt == 'SERTIFIKATTTE'){
				$allpeg		= Simpegpegawai::all();
				if ($fakultas == 'KP'){
					$pejabats	= Pejabatsurat::where('fakultas', 'LIKE', 'KP%')->get();
				} else {
					$pejabats	= Pejabatsurat::whereIn('fakultas', [$fakultas, 'KP-'.$fakultas])->get();
				}
				$jklmplain 	= Kelompoklain::where('fakultas', $fakultas)->get();
				foreach($jklmplain as $rklmplain) {
					$kodekelompok	= $rklmplain->namakelompok;
					$jklmplaindet 	= User::where('previlage', $kodekelompok)->get();
					foreach($jklmplaindet as $rklmplaindet) {
						$data['pejabat'][$i]['kode']	=   $rklmplaindet->nama;
						$data['pejabat'][$i]['nama']	=   $rklmplaindet->nama;
						$i++;
					}
				}
				$jklmpjabat 	= Pejabatsurat::where('fakultas', 'LIKE', '%'.$fakultas)->get();
				foreach($jklmpjabat as $rklmpjabat) {
					$kodekelompok	= $rklmpjabat->pejabat;
					$data['pejabat'][$i]['kode']	=   $kodekelompok;
					$data['pejabat'][$i]['nama']	=   $kodekelompok;
					$i++;
				}
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
				$isisurat		= $getsurat->isisurat;
				$getpartialisi	= explode(";", $isisurat);
				$baris			= 31;
				$kolom			= 5;
				$lebar			= 0;
				$halaman		= 1;
				$filedepan		= '-';
				$filebelakang	= '-';
				$posnama		= 12;
				$posstatus		= 8;
				$posqrcode		= 1;
				$mergenama		= 5;
				$mergestatus	= 5;
				$mergeqrcode	= 3;
				$layout			= 'L';
				if (!empty($getpartialisi)){
					foreach ($getpartialisi as $risi){
						$cekneh = explode(":", $risi);
						if (isset($cekneh[1])){
							$jenis 			= $cekneh[0];
							$variabel		= $cekneh[1];
							if ($jenis == 'baris'){ $baris = $variabel; }
							if ($jenis == 'kolom'){ $kolom = $variabel; }
							if ($jenis == 'lebar'){ $lebar = $variabel; }
							if ($jenis == 'halaman'){ $halaman = $variabel; }
							if ($jenis == 'filedepan'){ $filedepan = $variabel; }
							if ($jenis == 'filebelakang'){ $filebelakang = $variabel; }
							if ($jenis == 'posnama'){ $posnama = $variabel; }
							if ($jenis == 'posstatus'){ $posstatus = $variabel; }
							if ($jenis == 'posqrcode'){ $posqrcode = $variabel; }
							if ($jenis == 'mergenama'){ $mergenama = $variabel; }
							if ($jenis == 'mergestatus'){ $mergestatus = $variabel; }
							if ($jenis == 'mergeqrcode'){ $mergeqrcode = $variabel; }
							if ($jenis == 'layout'){ $layout = $variabel; }
						}
					}
				}
				$data['allpejabat']			= Pejabatsurat::orderBy('id', 'ASC')->orderBy('pejabat', 'ASC')->get();
				$data['getsurat']      		= $getsurat;
				$data['tahunini']      		= date("Y");
				$data['arrallpeg']      	= $allpeg;
				$data['pejabats']   		= $pejabats;
				$data['baris']   			= $baris;
				$data['baris']   			= $baris;
				$data['kolom']   			= $kolom;
				$data['lebar']   			= $lebar;
				$data['halaman']   			= $halaman;
				$data['filedepan']   		= $filedepan;
				$data['filebelakang']   	= $filebelakang;
				$data['posnama']   			= $posnama;
				$data['posstatus']   		= $posstatus;
				$data['posqrcode']   		= $posqrcode;
				$data['mergenama']   		= $mergenama;
				$data['mergestatus']   		= $mergestatus;
				$data['mergeqrcode']   		= $mergeqrcode;
				$data['layout']   			= $layout;
				$data['idne']   			= $getsurat->id;
				$data['sidebar']			= 'serfitikatwithtte';
				return view('persuratan.sertifikateditor', $data);
			} else {
				$data['pesanerror']		= 'Jenis Surat :'.$jenissrt.' TIDAK MEMERLUKAN SETTING TATA LETAK';
				return view('vokasi.gakboleh', $data);
			}
		} else {
			$data['pesanerror']		= 'ID :'.$id.' TIDAK LAGI DITEMUKAN, SILAHKAN KEMBALI KE HALAMAN MUKA';
			return view('vokasi.gakboleh', $data);
		}
    }
	public function viewSertifikat($id) {
		$cekid				= explode("-", $id);
		$homebase			= url("/");
		$certificate 		= 'file://'.base_path().'public/sco.crt';
		$sco 				= Session('fakpanjang');
		$swandhanafak       = Session('domainapps01');
		$swandhanaalamat    = Session('addressapps01');
		$swandhanakemen     = Session('subsubdomainapps01');
		$swandhanauniv      = Session('subdomainapps01');
		$swandhanatelpon    = Session('addressapps01');
		$swandhanaemail		= Session('emailapps01');
		$kalender 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$fontstyle			= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"';
		$jenisfontte		= '<font size="7" color="blue">';
		$marking			= '';
		$status				= '';
		$info 				= array(
			'Name' 			=> Session('namaapps01'),
			'Location' 		=> Session('subsubdomainapps01'),
			'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
			'ContactInfo' 	=> $homebase,
		);
		$page_format	= array(
			'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 330),
			'Dur' => 3,
			'PZ' => 1,
		);
		
		if (isset($cekid[1])){
			$id			= $cekid[0];
			$klien		= $cekid[1];
			$status		= '';
			$alamatweb	= $homebase.'/sertifikat/'.$id.'-'.$klien;
			$ceknama	= WebinarPartisipan::where('id', $klien)->first();
			if (isset($ceknama->id)){
				$partisipan = $ceknama->nama;
				$pekerjaan	= $ceknama->pekerjaan;
				$status		= $ceknama->status;
				$marking	= 'SERTIFIKAT-'.$klien;
			} else {
				$partisipan = '___________[namapeserta]__________';
				$pekerjaan	= '_________[statuspeserta]__________';
			}
		} else {
			$klien		= '';
			$alamatweb	= $homebase.'/sertifikat/'.$id;
			$partisipan = '___________[namapeserta]__________';
			$pekerjaan	= '_________[statuspeserta]__________';
		}
		$pekerjaan			= str_replace("<font color=white>1</font>", "", $pekerjaan);
		$pekerjaan			= str_replace("<font color=white>2</font>", "", $pekerjaan);
		$pekerjaan			= str_replace("<font color=white>3</font>", "", $pekerjaan);
		$pekerjaan			= str_replace("<font color=white>4</font>", "", $pekerjaan);
				
		$arrid		= explode("-SCO-", $status);
		if (isset($arrid[1])){
			$iddokumen 	= $arrid[0];
			$username 	= 'esign';
			$password 	= 'qwerty';
			$letakfile 	= public_path('scan/files/'.$marking.'.pdf');
			Storage::disk('local')->delete($letakfile);
								
			$toFile		= fopen($letakfile,'w');
			$authHeader = [
				'auth'    	=> ['esign', 'qwerty'],
				'sink'		=> $toFile
			];
			$fromUrl 	= 'https://esign.ub.ac.id/api/sign/download/'.$iddokumen;
			$client 	= new Client();
			$response 	= $client->get($fromUrl, $authHeader);
			fclose($toFile);
			WebinarPartisipan::where('id', $klien)->update([
				'status' => 'Sign With TTE'
			]);
		} else if ($status == 'Sign With TTE'){
			if (file_exists(public_path('scan/files/'.$marking.'.pdf'))){
				$file = public_path('scan/files/'.$marking.'.pdf');
				return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
			} else {
				WebinarPartisipan::where('id', $klien)->update([
					'status' => 'File Missing'
				]);
				$data['judulpesan']			= 'Gagal Render';
				$data['kalimatheader']		= 'Mohon Maaf';
				$data['kalimatbody']		= 'ID :'.$klien.' FILE TIDAK DITEMUKAN, SILAHKAN HUBUNGI ADMIN / REFRESH HALAMAN INI';
				return view('errors.pesanerror', $data);
			}	
		} else {
			$getsurat	= Suratkeluar::where('id', $id)->first();
			if (isset($getsurat->id)){
				$perihal		= $getsurat->perihal;
				$jenissrt		= $getsurat->jenissrt;
				$isisurat		= $getsurat->isisurat;
				$setttd			= $getsurat->namapejabat;
				$tandatangan	= $getsurat->tandatangan;
				$tgl			= $getsurat->daysrt;
				$tlsbln			= (int)$getsurat->monsrt;
				$thn			= $getsurat->yersrt;
				$tlsbln			= $kalender[$tlsbln];
				$tglsurat		= $tgl.' '.$tlsbln.' '.$thn;
				if ($marking == ''){
					$marking	= $getsurat->marking;
				}
				$getpartialisi	= explode(";", $isisurat);
				$baris			= 31;
				$kolom			= 5;
				$lebar			= 0;
				$halaman		= 1;
				$filedepan		= '-';
				$filebelakang	= '';
				$posnama		= 12;
				$posstatus		= 8;
				$posqrcode		= 1;
				$mergenama		= 5;
				$mergestatus	= 5;
				$mergeqrcode	= 3;
				$layout			= 'L';
				if (!empty($getpartialisi)){
					foreach ($getpartialisi as $risi){
						$cekneh = explode(":", $risi);
						if (isset($cekneh[1])){
							$jenis 			= $cekneh[0];
							$variabel		= $cekneh[1];
							if ($jenis == 'baris'){ $baris = $variabel; }
							if ($jenis == 'kolom'){ $kolom = $variabel; }
							if ($jenis == 'lebar'){ $lebar = $variabel; }
							if ($jenis == 'halaman'){ $halaman = $variabel; }
							if ($jenis == 'filedepan'){ $filedepan = $variabel; }
							if ($jenis == 'filebelakang'){ $filebelakang = $variabel; }
							if ($jenis == 'posnama'){ $posnama = $variabel; }
							if ($jenis == 'posstatus'){ $posstatus = $variabel; }
							if ($jenis == 'posqrcode'){ $posqrcode = $variabel; }
							if ($jenis == 'mergenama'){ $mergenama = $variabel; }
							if ($jenis == 'mergestatus'){ $mergestatus = $variabel; }
							if ($jenis == 'mergeqrcode'){ $mergeqrcode = $variabel; }
							if ($jenis == 'layout'){ $layout = $variabel; }
						}
					}
				}
				$rnamapjbt			= Pejabatsurat::where('id', $getsurat->idpejabat)->first();
				if (isset($rnamapjbt->id)){
					$pejabat 			= $rnamapjbt->pejabat;
					$namapjbt 			= $rnamapjbt->nama;
					$nippjbt 			= $rnamapjbt->nip;
					$kodefakultas 		= $rnamapjbt->kode;
					$jenisnip 			= $rnamapjbt->jenis;
					$tandatangan 		= $rnamapjbt->tandatangan;
					$getnama 			= Simpegpegawai::where('nip_baru', $nippjbt)->first();
					if (isset($getnama->nama)){
						$namasaja		= $getnama->nama;
						$emailpejabat	= $getnama->email_ub;
					} else { $namasaja = $namapjbt; $emailpejabat = $nippjbt.'@ub.ac.id'; }
				} else {
					$pejabat			= 'No Name';
					$nippjbt			= 'No Name';
					$namapjbt			= 'No Name';
					$kodefakultas		= 'No Name';
					$jenisnip			= 'No Name';
					$tandatangan		= 'No Name';
					$namasaja			= 'No Name';
					$emailpejabat		= 'No Name';
				}
				$qrcode 		= QrCode::format('png')->size(150)->generate($alamatweb);
				$output_file 	= 'scan/generate/qrimg-'. $marking.'.png';
				Storage::disk('local')->put($output_file, $qrcode);
				$jamtte			= date("H:m:i");
				$tulisttd		= '
						<table width="300" border="0" cellpadding="0" cellspacing="0"> 
								<tr>
									<td width="100"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="90" /></td>
									<td align="left" valign="center">
										'.$jenisfontte.'<br />
											TTE oleh :<br />
											<strong>'.$namasaja.'</strong><br />
											'.$tglsurat.' '.$jamtte.'<br /><br />
											Verifikasi melalui<br />https://tte.kominfo.go.id/verifyPDF
										</font>
									</td>
								</tr>
							</table>';
				if ($filedepan != '-'){
					$img_file = $homebase.'/images/sertifikat/'.$filedepan;
				} else {
					$img_file = $homebase.'/images/sertifikat/default.png';
				}
				if ($pejabat == 'No Name'){
					if ($layout == 'L'){
						$generatesurat 	= '<table width="1118" border="1" cellpadding="0" cellspacing="0">';
					} else {
						$generatesurat 	= '<table width="720" border="1" cellpadding="0" cellspacing="0">';
					}
				} else {
					if ($layout == 'L'){
						$generatesurat 	= '<table width="1118" border="0" cellpadding="0" cellspacing="0">';
					} else {
						$generatesurat 	= '<table width="720" border="0" cellpadding="0" cellspacing="0">';
					}
				}
				while ($baris != 0){
					$generatesurat	= $generatesurat.'<tr>';
					$i 				= $kolom;
					if ($posnama == $baris){
						$slip1		= $kolom - $mergenama;
						if ($slip1 <= 0){
							$generatesurat	= $generatesurat.'<td colspan="'.$kolom.'" align="center"><font size="18">'.$partisipan.'</font></td>';
						} else {
							$generatesurat	= $generatesurat.'<td colspan="'.$slip1.'">&nbsp;</td><td colspan="'.$mergenama.'" align="center"><font size="18">'.$partisipan.'</font></td>';
						}
					} elseif ($posqrcode == $baris){
						$slip2		= round(($kolom - $mergeqrcode),0);
						while ($slip2 != 0){
							$generatesurat	= $generatesurat.'<td>&nbsp;</td>';
							$slip2--;
						}
						$generatesurat	= $generatesurat.'<td align="center">'.$tulisttd.'</td>';
					} elseif ($posstatus == $baris){
						$slip3		= $kolom - $mergestatus;
						if ($slip3 <= 0){
							$generatesurat	= $generatesurat.'<td colspan="'.$kolom.'" align="center"><font size="16">'.$pekerjaan.'</font></td>';
						} else {
							$generatesurat	= $generatesurat.'<td colspan="'.$slip3.'">&nbsp;</td><td colspan="'.$mergestatus.'" align="center"><font size="16">'.$pekerjaan.'</font></td>';
						}
					} else {
						while ($i != 0){
							if ($lebar == '0'){
								$generatesurat	= $generatesurat.'<td>&nbsp;</td>';
							} else {
								$generatesurat	= $generatesurat.'<td width="'.$lebar.'">&nbsp;</td>';
							}
							$i--;
						}
					}
					$generatesurat	= $generatesurat.'</tr>';
					$baris--;
				}
				$generatesurat	= $generatesurat.'</table>';
				if ($filebelakang != ''){
					$generatesurat	= $generatesurat.'<img src="'.$homebase.'/images/sertifikat/'.$filebelakang.'" />';
				}
				$data['perihal']   		= $perihal;
				$data['surate']   		= $generatesurat;
				$data['catatankaki']   	= '';
				$text 					= view('cetak.suratkeluar', $data);
				PDFCREATOR::SetCreator($sco);
				PDFCREATOR::SetAuthor($getsurat->pembuat);
				PDFCREATOR::SetTitle($perihal);
				PDFCREATOR::SetSubject($partisipan);
				PDFCREATOR::SetKeywords($jenissrt);
				PDFCREATOR::setPrintHeader(false);
				PDFCREATOR::setPrintFooter(false);
				PDFCREATOR::SetMargins(5, 0, 5);
				PDFCREATOR::setFontSubsetting(true);
				PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
				if ($layout == 'P'){
					PDFCREATOR::AddPage('P', $page_format, false, false);
					$bMargin = PDFCREATOR::getBreakMargin();
					$auto_page_break = PDFCREATOR::getAutoPageBreak();
					PDFCREATOR::SetAutoPageBreak(false, 0);
					PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
					PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
					PDFCREATOR::setPageMark();
				} else {
					PDFCREATOR::AddPage('L', $page_format, false, false);
					$bMargin = PDFCREATOR::getBreakMargin();
					$auto_page_break = PDFCREATOR::getAutoPageBreak();
					PDFCREATOR::SetAutoPageBreak(false, 0);
					PDFCREATOR::Image($img_file, 0, 0, 330, 210, '', '', '', false, 300, '', false, false, 0);
					PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
					PDFCREATOR::setPageMark();
				}
				try {
					if ($getsurat->tandatangan == 'Signed Using TTE'){
						$getnonik	= AntrianTTE::where('idsurat', $getsurat->id)->where('jenis', 'KELUAR')->first();
						if (isset($getnonik->id)){
							$nonik		= $getnonik->nonik;
							$passphare	= $getnonik->passphare;
							$passphare	= Crypt::decryptString($passphare);
						} else {
							$nonik		= '';
							$passphare	= '';
						}
						if ($nonik == '' OR is_null($nonik)){
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->delete('/scan/generate/qrimg-'. $marking.'.png');
							Storage::disk('local')->delete('/scan/generate/'.$marking.'.pdf');
							Storage::disk('local')->put('/scan/generate/'.$marking.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$marking.'.pdf');
						} else {
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->delete('scan/generate/qrimg-'. $marking.'.png');
							Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
							$file 		= public_path('scan/files/'.$marking.'.pdf');
							$client 	= new Client();
							$authHeader = [
								'auth'    		=> ['esign', 'qwerty'],
								'multipart'    	=> [
									[
										'name'		=> 'file',
										'contents'	=> fopen($file, 'r')
									],
									[
										'name'		=> 'nik',
										'contents'	=> $nonik
									],
									[
										'name'		=> 'passphrase',
										'contents'	=> $passphare
									],
									[
										'name'		=> 'tampilan',
										'contents'	=> 'invisible'
									],
								],
							];
							try {
								$response 	= $client->post('https://esign.ub.ac.id/api/sign/pdf', $authHeader);
								$status		= (string)$response->getStatusCode();
								$body		= (string)$response->getBody();
								$hasil		= json_decode($body, true);
								$tgltte		= date("Y-m-d H:i:s");
								$waktutte	= 0;
								$iddok		= '';
								$waktutte 	= $response->getHeader('signing_time');
								$waktutte	= $waktutte[0];
								$tgltte 	= $response->getHeader('Date');
								$tgltte		= $tgltte[0];
								$iddok		= $response->getHeader('id_dokumen');
								$iddok		= $iddok[0];
								$errorupload = 'Signed at '.$tgltte.'<br />Signing Time: '.$waktutte.'<br />ID Dokumen: '.$iddok;
								if ($klien != ''){
									WebinarPartisipan::where('id', $klien)->update([
										'status' => $iddok.'-SCO-DOWNLOAD'
									]);
									$letakfile 	= public_path('scan/files/'.$marking.'.pdf');
									Storage::disk('local')->delete($letakfile);
														
									$toFile		= fopen($letakfile,'w');
									$authHeader = [
										'auth'    	=> ['esign', 'qwerty'],
										'sink'		=> $toFile
									];
									$fromUrl 	= 'https://esign.ub.ac.id/api/sign/download/'.$iddok;
									$client 	= new Client();
									$response 	= $client->get($fromUrl, $authHeader);
									fclose($toFile);
									WebinarPartisipan::where('id', $klien)->update([
										'status' => 'Sign With TTE'
									]);
									
								}
							} catch (\GuzzleHttp\Exception\ClientException $e) {
								$response 				= $e->getResponse();
								$responseBodyAsString 	= $response->getBody()->getContents();
								$pesan 					= json_decode($responseBodyAsString);
								$pesan 					= $pesan->error;
								$errorupload 			= '<font color="red">Generate Signed PDF Failed with status : '.$pesan.'</font>';
								WebinarPartisipan::where('id', $klien)->update([
									'status' => $pesan
								]);
							}
						}
					} else {
						PDFCREATOR::writeHTML($text, true, 0, true, 0);
						PDFCREATOR::setFooterMargin(0);
						$pdfdoc = PDFCREATOR::Output('', 'S');
						PDFCREATOR::reset();
						Storage::disk('local')->put('/scan/generate/'.$marking.'.pdf', $pdfdoc);
						$file =  public_path('scan/generate/'.$marking.'.pdf');
						File::delete(base_path() ."public/scan/generate/qrimg-". $marking.'.png');
					}
					return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
				} catch (\Exception $e) {
					$pesan 						= $e->getMessage();
					$data['judulpesan']			= 'Gagal Render';
					$data['kalimatheader']		= 'Mohon Maaf';
					$data['kalimatbody']		= 'Mohon Ubah File Background dengan ukuran lebih kecil / ubah ke format PNG<br />'.$pesan;
					return view('errors.pesanerror', $data);
				}
			} else {
				$data['judulpesan']			= 'Gagal Render';
				$data['kalimatheader']		= 'Mohon Maaf';
				$data['kalimatbody']		= 'ID :'.$id.' TIDAK LAGI DITEMUKAN, SILAHKAN KEMBALI KE HALAMAN MUKA';
				return view('errors.pesanerror', $data);
			}
		}
    }
	public function lastNumsrtmasuk() {
		$arraylastnmsrt = [];
		$fakultas		= Session('fakultas');
		$tahun			= date("Y");
		$jklmplastnmsrt	= Suratmasuk::where('fakultas', $fakultas)->orderBy('id', 'DESC')->limit(20)->get();
		if (!empty($jklmplastnmsrt)){
			foreach ($jklmplastnmsrt as $result) {
				$arraylastnmsrt[] = array(
					'nomor' 	=> $result->noagenda,
					'tanggal' 	=> $result->tglmasuk,
				);
			}
		} 
		echo json_encode($arraylastnmsrt);	
    }
	public function getNoagenda(Request $request) {
		$marking 		= $request->input('val01');
		$fakultas		= Session('fakultas');
		$tahun			= date("Y");
		$jklmplastnmsrt	= Suratmasuk::where('yersrt', $tahun)->where('fakultas', $fakultas)->orderBy('noagenda', 'DESC')->first();
		if (isset($jklmplastnmsrt->noagenda)){
			$noagenda 		= $jklmplastnmsrt->noagenda;
			$nomere			= $noagenda + 1;
		}else {
			$nomere 		= '1';
		}
		return response()->json(['status' => 'Info', 'message' => $nomere]);
		return back();
    }
	public function inboxSuratmasukPaged(Request $request) {
		$arrayinbox 	= [];
		$mnama			= Session('nama');
		$mkelompok		= Session('jabatan');
		$fakultas		= Session('fakultas');
		$fakpanjang		= Session('fakpanjang');
		$dari  			= $request->input('dari');
        $jenis   		= $request->input('jenis');
		$totaldata  	= 0;
        $pagenum  		= 0;
        $filterscount  	= 0;
        $lm         	= 10;
		$sortdatafield	= 'id';
		$sortorder		= 'DESC';
        $limit      	= ($request->input('pagesize') == null ? $limit : $request->input('pagesize'));
		$pagenum    	= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  	= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  = ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  	= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
		if ($jenis == 'arsip'){
			$data 		= Inboxsurat::where('email', Session('email'))->where('jenis', 'MASUK')->where('status', 'reply');
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderBy($sortdatafield, $sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $result) {
					$footnote 		= '';
					$penerima 		= $result->penerima;
					$kepada 		= $result->kepada;
					$cekdispo 		= Inboxsurat::where('pengirim', $penerima)->where('penerima', $kepada)->where('marking', $result->marking)->orderBy('id', 'DESC')->first();
					if (isset($cekdispo->id)){
						$footnote 	= $cekdispo->footnote;
					}
					$arrayinbox[] = array(
						'id' 				=> $result->id,
						'idsurat' 			=> $result->idsurat,
						'nosurat' 			=> $result->nosurat,
						'perihal' 			=> $result->perihal,
						'noagenda' 			=> $result->noagenda,
						'footnote' 			=> $footnote,
						'kepada' 			=> $result->kepada,
						'tglsurat' 			=> $result->tglsurat,
						'created_at' 		=> $result->created_at,
					);
				}
			}
		} else {
			$data 	    = Suratmasuk::where('fakultas', Session('fakultas'));
			if ($dari != null AND $dari != '') {
				if ($jenis == 'tahun'){
					$data = $data->where('yersrt', $dari);
				}
				if ($jenis == 'koreksi'){
					$data = $data->where('yersrt', date("Y"))->where('status', 'Koreksi');
				}
				if ($jenis == 'agenda'){
					$data = $data->where('noagenda', $dari);
				}
				if ($jenis == 'nomer'){
					$data = $data->where('nosurat', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'tglmasuk'){
					$data = $data->where('tglmasuk', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'tglsurat'){
					$data = $data->where('tglsurat', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'perihal'){
					$data = $data->where('perihal', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'ringkasan'){
					$data = $data->where('ringkasan', 'LIKE', '%'.$dari.'%')->orWhere('ringkasan2', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'pengirim'){
					$data = $data->where('asalsurat', 'LIKE', '%'.$dari.'%');
				}
			} else {
				if ($jenis == 'koreksi'){
					$data = $data->where('status', 'Koreksi');
				} else {
					$data = $data->where('yersrt', date("Y"));
				}
			}
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'jenis'){ $filterdatafield = 'jenissurat'; }
					if ($filterdatafield == 'tulistatus'){ $filterdatafield = 'status'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $result) {
					$idsurat 	= $result->id;
					$jen 		= $result->jenissurat;
					$noagenda 	= $result->noagenda;
					$marking 	= $result->marking;
					$ringkasan 	= $result->ringkasan;
					$tglsurat 	= $result->tglsurat;
					$sifat 		= $result->sifat;
					$nosurat 	= $result->nosurat;
					$perihal 	= $result->perihal;
					$ringkasan2 = $result->ringkasan2;
					$scansurat 	= $result->scansurat;
					$kepada 	= $result->kepada;
					$setstatus 	= $result->status;
					$pengirim 	= $result->asalsurat;
					$penerima 	= $kepada;
					$timestamp	= $result->created_at;
					$inbstatus	= '';
					$idmarking	= '';
					if ($sifat == 1){ $tulissifat = '<small class="badge badge-danger">KILAT</small>'; }
					else if ($sifat == 2){ $tulissifat = '<small class="badge badge-success">SANGAT SEGERA</small>'; }
					else if ($sifat == 3){ $tulissifat = '<small class="badge badge-info">SEGERA</small>'; }
					else if ($sifat == 4){ $tulissifat = '<small class="badge badge-warning">BIASA</small>'; }
					else{ $tulissifat = '<small class="badge badge-primary">LAINNYA</small>'; }
					if ($setstatus == 'Koreksi'){ $tulistatus = '<small class="badge badge-danger">Koreksi</small>'; }
					else if ($setstatus == 'Checked'){ $tulistatus = '<small class="badge badge-success">Checked</small>'; }
					else if ($setstatus == '') { $tulistatus = '<small class="badge badge-warning">New</small>'; }
					else { $tulistatus = '<small class="badge badge-primary">'.$setstatus.'</small>'; }
					if ($ringkasan != ''){
						$tlsagenda 		= $noagenda;
						$tlsnosurat 	= $nosurat;
						$tlspengirim 	= $pengirim;
						$tlspenerima 	= $penerima;
						$tlsperihal 	= $perihal;
						$tlswaktu 		= $timestamp;
						$arrcekringkan	= explode(' ', $ringkasan);
						if (isset($arrcekringkan[0])){ $kata1 = $arrcekringkan[0]; } else { $kata1 = ''; }
						if (isset($arrcekringkan[1])){ $kata2 = $arrcekringkan[1]; } else { $kata2 = ''; }
						if (isset($arrcekringkan[2])){ $kata3 = $arrcekringkan[2]; } else { $kata3 = ''; }
						
						$cekkata 		= $kata1.' '.$kata2.' '.$kata3;
						if ($cekkata == 'Telah di Periksa'){
							$tlsringkasan 	= '<font color=green><strong>'.$ringkasan.'</strong></font>';
						} else {
							$tlsringkasan 	= '<font color=red><strong>'.$ringkasan.'</strong></font>';
						}
					} else {
						$tlsringkasan 	= '<strong>'.$ringkasan.'</strong>';
						$tlsagenda 		= '<strong>'.$noagenda.'</strong>';
						$tlsnosurat 	= '<strong>'.$nosurat.'</strong>';
						$tlspengirim 	= '<strong>'.$pengirim.'</strong>';
						$tlspenerima 	= $penerima;
						$tlsperihal 	= '<strong>'.$perihal.'</strong>';
						$tlswaktu 		= '<strong>'.$timestamp.'</strong>';
					}
					if ($scansurat == ''){
						$scansurat	= 'hilang.png';
					}
					else {
						$scansurat	= rawurlencode ($scansurat);
					}
					$arrayinbox[] = array(
						'id' 				=> $idsurat,
						'tulistatusinbox'	=> $inbstatus,
						'tulistatus'		=> $tulistatus,
						'idmarking'			=> $idmarking,
						'tlsagenda'			=> $tlsagenda,
						'tlsnosurat'		=> $tlsnosurat,
						'tlspengirim'		=> $tlspengirim,
						'tlspenerima'		=> $tlspenerima,
						'tlsperihal'		=> $tlsperihal,
						'tlswaktu'			=> $tlswaktu,
						'tlssifat' 			=> $tulissifat,
						'jenis' 			=> $jen,
						'marking' 			=> $marking,
						'noagenda' 			=> $noagenda,
						'tlsringkasan' 		=> $tlsringkasan,
						'nosurat' 			=> $nosurat,
						'tglmasuk' 			=> $result->tglmasuk,
						'tglsurat' 			=> $tglsurat,
						'kepada' 			=> $result->kepada,
						'asalsurat' 		=> $result->asalsurat,
						'perihal' 			=> $perihal,
						'nmfile' 			=> $result->scansurat,
						'ringkasan' 		=> $ringkasan,
						'scansurat' 		=> $scansurat,
						'klasifikasi' 		=> $result->klasifikasi,
						'lampiran' 			=> $result->lampiran,
						'ringkasan2' 		=> $result->ringkasan2,
						'sifat' 			=> $result->sifat,
						'bentuk' 			=> $result->bentuk,
						'pembuat' 			=> $result->pembuat,
						'status' 			=> $result->status,
						'subyek' 			=> $result->subyek,
						'disposisi' 		=> $result->disposisi,
						'faskode' 			=> $result->faskode,
						'subkode' 			=> $result->subkode,
					);
				}
			}
		}
		$response = [
            'message'   => 'List Laporan',
            'dari'      => $dari,
            'jenis'     => $jenis,
            'data'      => $arrayinbox,
            'total'     => $totaldata
        ];
        return response()->json($response, 200);
    }
	public function inboxUserpaginated(Request $request) {
		$arrayiuser		= [];
		$homebase		= url("/");
		$totaldata  	= 0;
        $pagenum  		= 0;
        $filterscount  	= 0;
        $lm         	= 10;
		$sortdatafield	= 'id';
		$sortorder		= 'DESC';
		$dari  			= $request->input('dari');
        $jenis   		= $request->input('jenis');
        $limit      	= ($request->input('pagesize') == null ? $limit : $request->input('pagesize'));
		$pagenum    	= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  	= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  = ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  	= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
		if ($jenis == 'penerimasurat'){
			if ($request->input('jenis') == 'internal'){
				$data		= Penerimasurat::where('penulisan', Session('email'))->where('status', 'SEND')->where('tabel', 'LIKE', '%'.$homebase.'%');
			} else if ($request->input('jenis') == 'external'){
				$data		= Penerimasurat::where('penulisan', Session('email'))->where('status', 'SEND')->where('tabel', 'NOT LIKE', '%'.$homebase.'%');
			} else {
				$data		= Penerimasurat::where('penulisan', Session('email'))->where('status', 'SEND');
			}
			if ($dari == null OR $dari == ''){
				if ($filterscount > 0){
					for ($i = 0; $i < $filterscount; $i++){
						$filtervalue		= $request->input('filtervalue'.$i);
						$filterdatafield  	= $request->input('filterdatafield'.$i);
						$data 				= $data->where('perihal', 'LIKE', '%'.$filtervalue.'%');
						
					}
				}
			} else {
				$data = $data->where('perihal', 'LIKE', '%'.$dari.'%');
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $rows){
					$idsurat	= $rows->idsurat;
					$jenis		= $rows->jenis;
					$tulis 		= 'NO';
					if ($jenis == 'KELUAR'){
						$cekdata	= Suratkeluar::where('id', $idsurat)->first();
						if (isset($cekdata->id)){
							$arrayiuser[] = array(
								'id' 			=> $rows->id,
								'marking' 		=> $cekdata->marking,
								'pengirim' 		=> $rows->created_by,
								'penerima' 		=> $rows->nama,
								'email' 		=> $rows->penulisan,
								'status' 		=> $rows->status,
								'sifat' 		=> 5,
								'idsurat' 		=> $homebase.'/viewsurat/keluar-'.$idsurat,
								'noagenda' 		=> $cekdata->nomor.'/'.$cekdata->kodefak.'/'.$cekdata->unit.'/'.$cekdata->yersrt,
								'tglsurat' 		=> $cekdata->tglsurat,
								'jenissrt' 		=> $cekdata->jenissrt,
								'nosurat' 		=> $cekdata->nomor,
								'kepada' 		=> $cekdata->kepada,
								'perihal' 		=> $cekdata->perihal,
								'asalsurat' 	=> $cekdata->kelompok,
								'footnote' 		=> $cekdata->keterangan,
								'created_at' 	=> $rows->created_at,
								'kelompok'		=> 'Penerima Surat'
							);
							$totaldata++;
						}
					} else if ($jenis == 'SKDANPERATURAN'){
						$cekdata	= Tabelskdanperaturan::where('id', $idsurat)->first();
						if (isset($cekdata->id)){
							$arrayiuser[] = array(
								'id' 			=> $rows->id,
								'marking' 		=> $cekdata->marking,
								'pengirim' 		=> $rows->created_by,
								'penerima' 		=> $rows->nama,
								'email' 		=> $rows->penulisan,
								'status' 		=> $rows->status,
								'sifat' 		=> 5,
								'idsurat' 		=> $homebase.'/viewsurat/SKPP-'.$idsurat,
								'noagenda' 		=> $cekdata->nomor.' TAHUN '.$cekdata->tahun,
								'tglsurat' 		=> $cekdata->tanggal,
								'jenissrt' 		=> $cekdata->kelompok,
								'nosurat' 		=> $cekdata->nomor,
								'kepada' 		=> $rows->nama,
								'perihal' 		=> $cekdata->judul,
								'asalsurat' 	=> $cekdata->penandatangan,
								'footnote' 		=> $rows->keterangan,
								'created_at' 	=> $rows->created_at,
								'kelompok'		=> 'Penerima Surat'
							);
							$totaldata++;
						}
					}
				}
			}
			$response 	= [
				'message'   => 'List Laporan',
				'data'      => $arrayiuser,
				'total'     => $totaldata
			];
			return response()->json($response, 200);
		} else {
			if ($request->input('jenis') == 'internal'){
				$data		= Inboxsurat::where('marking', 'LIKE', Session('fakultas').'%')->where('email', 'LIKE', Session('email'))->where('status', 'send')->where('jenis', 'MASUK');
			} else if ($request->input('jenis') == 'external'){
				$data		= Inboxsurat::where('marking', 'LIKE', '%-'.Session('fakultas').'-%')->where('email', 'LIKE', Session('email'))->where('status', 'send')->where('jenis', 'MASUK');
			} else {
				$data		= Inboxsurat::where('email', 'LIKE', Session('email'))->where('status', 'send')->where('jenis', 'MASUK');
			}
			if ($dari == null OR $dari == ''){
				if ($filterscount > 0){
					for ($i = 0; $i < $filterscount; $i++){
						$filtervalue		= $request->input('filtervalue'.$i);
						$filterdatafield  	= $request->input('filterdatafield'.$i);
						$data 				= $data->where('perihal', 'LIKE', '%'.$filtervalue.'%');
					}
				}
			} else {
				if ($jenis == 'tahun'){
					$data = $data->where('created_at', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'agenda'){
					$data = $data->where('noagenda',  'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'nomer'){
					$data = $data->where('nosurat', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'tglsurat'){
					$data = $data->where('tglsurat', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'perihal'){
					$data = $data->where('perihal', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'ringkasan'){
					$data = $data->where('footnote', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'pengirim'){
					$data = $data->where('pengirim', 'LIKE', '%'.$dari.'%');
				}
				if ($jenis == 'asalsurat'){
				}
			}
			if ($sortdatafield == 'asalsurat'){ $sortdatafield = 'id'; }
			$pagenum++;
			$data       = $data->groupBy('marking')->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $rows){
					$idsurat	= $rows->idsurat;
					$noagenda	= $rows->noagenda;
					$jenissrt	= $rows->jenissrt;
					$tglsurat	= $rows->tglsurat;
					$nosurat	= $rows->nosurat;
					$kepada		= $rows->kepada;
					$perihal	= $rows->perihal;
					$asalsurat	= $rows->unit;
					$getmark1 	= explode('-', $rows->marking);
					$mark1 		= $getmark1[0];
					if (is_null($idsurat) OR $idsurat == '' OR $idsurat == 0){
						$cekdata	= Suratmasuk::where('marking', $rows->marking)->first();
						if (isset($cekdata->id)){
							$idsurat	= $cekdata->id;
							$noagenda	= $cekdata->noagenda;
							$jenissrt	= $cekdata->jenissurat;
							$tglsurat	= $cekdata->tglsurat;
							$nosurat	= $cekdata->nosurat;
							$kepada		= $cekdata->kepada;
							$perihal	= $cekdata->perihal;
							$asalsurat	= $cekdata->asalsurat;
							Inboxsurat::where('id', $rows->id)->update([
								'idsurat' 		=> $cekdata->idsurat,
								'noagenda' 		=> $cekdata->noagenda,
								'tglsurat' 		=> $cekdata->tglsurat,
								'jenissrt' 		=> $cekdata->jenissurat,
								'nosurat' 		=> $cekdata->nosurat,
								'kepada' 		=> $cekdata->kepada,
								'perihal' 		=> $cekdata->perihal,
								'alamat' 		=> '',
								'lampiran' 		=> $cekdata->lampiran,
								'kodefak' 		=> $cekdata->subyek,
								'klasifikasi' 	=> $cekdata->klasifikasi,
								'pembuat' 		=> $cekdata->pembuat,
								'unit' 			=> $cekdata->asalsurat,
								'tabel' 		=> $cekdata->fakultas,
							]);
						} else {
							$ceksebelumnya = Inboxsurat::where('marking', $rows->marking)->where('idsurat', '!=', '0')->orderBy('id', 'DESC')->first();
							if (isset($ceksebelumnya->id)){
								Inboxsurat::where('id', $rows->id)->update([
									'idsurat' 		=> $ceksebelumnya->idsurat,
									'noagenda' 		=> $ceksebelumnya->noagenda,
									'tglsurat' 		=> $ceksebelumnya->tglsurat,
									'jenissrt' 		=> $ceksebelumnya->jenissrt,
									'nosurat' 		=> $ceksebelumnya->nosurat,
									'kepada' 		=> $ceksebelumnya->kepada,
									'perihal' 		=> $ceksebelumnya->perihal,
									'alamat' 		=> $ceksebelumnya->alamat,
									'lampiran' 		=> $ceksebelumnya->lampiran,
									'kodefak' 		=> $ceksebelumnya->kodefak,
									'klasifikasi' 	=> $ceksebelumnya->klasifikasi,
									'pembuat' 		=> $ceksebelumnya->pembuat,
									'unit' 			=> $ceksebelumnya->unit,
									'tabel' 		=> $ceksebelumnya->tabel,
								]);
							}
						}
					}
					if (is_null($idsurat) OR $idsurat == '' OR $idsurat == 0){
						Inboxsurat::where('id', $rows->id)->update([
							'status' 		=> 'reply',
							'footnote'		=> 'Missing ID Surat'
						]);
					} else {
						$arrayiuser[] = array(
							'id' 			=> $rows->id,
							'marking' 		=> $rows->marking,
							'pengirim' 		=> $rows->pengirim,
							'penerima' 		=> $rows->penerima,
							'email' 		=> $rows->email,
							'status' 		=> $rows->status,
							'sifat' 		=> $rows->sifat,
							'idsurat' 		=> $homebase.'/viewsurat/7a07275b47504815818abc970da769fc-'.$idsurat,
							'noagenda' 		=> $noagenda,
							'tglsurat' 		=> $tglsurat,
							'jenissrt' 		=> $jenissrt,
							'nosurat' 		=> $nosurat,
							'kepada' 		=> $kepada,
							'perihal' 		=> $perihal,
							'asalsurat' 	=> $asalsurat,
							'footnote' 		=> $rows->footnote,
							'created_at' 	=> $rows->created_at,
							'kelompok'		=> 'Surat Masuk'
						);
					}
					
				}
			}
			$response 	= [
				'message'   => 'List Laporan',
				'data'      => $arrayiuser,
				'total'     => $totaldata
			];
			return response()->json($response, 200);
		}
    }
	public function inboxOutuserPaged(Request $request) {
		$homebase			= url("/");
		$arrayouser 		= [];
		$totaldata  		= 0;
        $filterscount		= 0;
		$limit         		= 10;
		$page				= 0;
		$pimpinan  			= '';
		$jenissuratklr  	= '';
		$merangkap			= '';
		$sortdatafield		= 'id';
		$sortorder			= 'DESC';
        $limit      		= ($request->input('pagesize') == null ? $limit : $request->input('pagesize'));
		$pagenum    		= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  		= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  	= ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  		= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
	    $pimpinan  			= ($request->input('val01') == null ? $pimpinan : $request->input('val01'));
		$jenissuratklr  	= ($request->input('val02') == null ? $jenissuratklr : $request->input('val02'));
		$cekmerangkap		= User::where('previlage', $pimpinan)->first();
		if (isset($cekmerangkap->merangkap)){
			$merangkap		= $cekmerangkap->merangkap;
		}
		$cekemail			= User::where('previlage', $pimpinan)->count();
		if ($cekemail == 0){
			if ($jenissuratklr == 'memo'){
				$data = Inboxsurat::where('email', Session('email'))->where('jenissrt', 'MEMO');
					
			} else if ($jenissuratklr == 'notadinas'){
				$data = Inboxsurat::where('email', Session('email'))->where('jenissrt', 'NOTA DINAS');
			} else {
				$data = Inboxsurat::where('email', Session('email'))->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])->groupBy('marking');
			}
		} else {
			if ($jenissuratklr == 'memo'){
				if ($merangkap != ''){
					$data = Inboxsurat::whereIn('pengirim', [$pimpinan, $merangkap])->where('jenissrt', 'MEMO');
				} else {
					$data = Inboxsurat::where('pengirim', $pimpinan)->where('jenissrt', 'MEMO');
				}	
			} else if ($jenissuratklr == 'notadinas'){
				if ($merangkap != ''){
					$data = Inboxsurat::whereIn('pengirim', [$pimpinan, $merangkap])->where('jenissrt', 'NOTA DINAS');
				} else {
					$data = Inboxsurat::where('pengirim', $pimpinan)->where('jenissrt', 'NOTA DINAS');
				}
			} else {
				if ($merangkap != ''){
					$data = Inboxsurat::whereIn('penerima', [$pimpinan, $merangkap])->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])->groupBy('marking');
				} else {
					$data = Inboxsurat::where('penerima', $pimpinan)->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])->groupBy('marking');
				}
			}
		}
		if ($filterscount > 0){
			for ($i = 0; $i < $filterscount; $i++){
				$filtervalue		= $request->input('filtervalue'.$i);
				$filterdatafield  	= $request->input('filterdatafield'.$i);
				if ($filterdatafield == 'pemberi' ) { $filterdatafield = 'pengirim'; }
				if ($filterdatafield == 'perihal' ) { $filterdatafield = 'perihal'; }
				$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
			}
			$data = $data->where('status', '!=', 'deleted');
		} else {
			$data = $data->whereIn('status', ['send', 'read']);
		}
		
		$pagenum++;
		$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
		$total1		= $data->total();
		$totaldata 	= $totaldata + $total1;
		if(!empty($data)){
			foreach ($data as $result) {
				$idinbox 		= $result->id;
				$marking 		= $result->marking;
				$pemberi 		= $result->pengirim;
				$kerja 			= $result->kerja;
				$keterangan 	= $result->jenis;
				$status 		= $result->status;
				$catatan 		= $result->catatan;
				$idsurat		= $result->idsurat;
				$noagenda		= $result->noagenda;
				$tglsurat		= $result->tglsurat;
				$jenissrt		= $result->jenissrt;
				$nosurat		= $result->nosurat;
				$kepada			= $result->kepada;
				$perihal		= $result->perihal;
				$alamat			= $result->alamat;
				$lampiran		= $result->lampiran;
				$kodefak		= $result->kodefak;
				$klasifikasi	= $result->klasifikasi;
				$pembuat		= $result->pembuat;
				$unit			= $result->unit;
				$tabel			= $result->tabel;
				if ($jenissrt == 'PKWT'){ $perihal = $perihal.' an. '.$kepada; }

				if ($tabel == 'KELUARNONOMER'){ $catatan = $tabel;}
				if ($tabel == 'ALIHSTATUS'){ $catatan = 'ALIHSTATUS';}
				$kerja			= '<a target="_blank" href="'.$homebase.'/trackingid/srtklr-'.$marking.'">'.$kerja.'</a>';
				if ($status == 'send'){$status='<small class="badge badge-danger">SEND</small>';}
				if ($status == 'read'){$status='<small class="badge badge-warning">READ</small>';}
				if ($idsurat == '0' OR $idsurat == '' OR is_null($idsurat)){
					if ($keterangan == 'KELUAR'){
						if ($catatan == 'REMUNERASI' OR 
							$catatan == 'TUBEL' OR 
							$catatan == 'JABAKAD' OR 
							$catatan == 'JABPELAKSANA' OR 
							$catatan == 'BERHENTI' OR
							$catatan == 'DRAFTSK' OR
							$catatan == 'PENGPNS' OR
							$catatan == 'PangkatNONPNS'){
							$gceksrtklr		= Draftsk::where('marking', $marking)->first();
							if (isset($gceksrtklr->id)){
								$idsurat		= $gceksrtklr->id;
								$noagenda		= '';
								$tglsurat		= $gceksrtklr->tmt;
								$jenissrt		= $gceksrtklr->jenissk;
								$nosurat		= $gceksrtklr->nomor.' Tahun '.$gceksrtklr->tahun;
								$kepada			= $gceksrtklr->nama;
								$perihal		= $gceksrtklr->menetapkan;
								$alamat			= '';
								$lampiran		= '';
								$kodefak		= '';
								$klasifikasi	= '';
								$pembuat		= $gceksrtklr->konseptor;
								$unit			= $gceksrtklr->unitkonseptor;
								$tabel			= '';
								$marking		= $idsurat;
							} else {
								Inboxsurat::where('id', $idinbox)->update([
									'status' => 'reply'
								]);
							}
						} else if ($catatan == 'SKDANPERATURAN' OR $catatan == 'SKDOSPEM' OR $catatan == 'SKDOSPENGUJI'){
							$gceksrtklr	= Tabelskdanperaturan::where('marking', $result->marking)->first();
							if (isset($gceksrtklr->id)){
								$idsurat		= $gceksrtklr->id;
								$noagenda		= '';
								$tglsurat		= $gceksrtklr->tanggal;
								$jenissrt		= $gceksrtklr->judul;
								$nosurat		= $gceksrtklr->nomor.' Tahun '.$gceksrtklr->tahun;
								$kepada			= '';
								$perihal		= $gceksrtklr->judul;
								$alamat			= '';
								$lampiran		= '';
								$kodefak		= '';
								$klasifikasi	= '';
								$pembuat		= $gceksrtklr->inputor;
								$unit			= '';
								$tabel			= '';
								$marking		= $idsurat;
							} else {
								Inboxsurat::where('id', $idinbox)->update([
									'status' => 'reply'
								]);
							}
						} else if ($catatan == 'ANTRIAN'){
							$getmarking = Antrian::where('keterangan', $marking)->first();
							if (isset($getmarking->id)){
								$idsurat		= $getmarking->id;
								$noagenda		= '';
								$tglsurat		= $getmarking->tglsurat;
								$jenissrt		= $getmarking->kodjenis;
								$nosurat		= $getmarking->pada;
								$kepada			= $getmarking->nama;
								$perihal		= $getmarking->kodjenis;
								$alamat			= $getmarking->alamat;
								$lampiran		= $getmarking->lokasi;
								$kodefak		= $getmarking->pejabat;
								$klasifikasi	= $getmarking->whatfor;
								$pembuat		= $getmarking->nmpejabat;
								$unit			= $getmarking->jenis;
								$tabel			= 'ANTRIAN';
							} else {
								Inboxsurat::where('id', $idinbox)->update([
									'status' => 'reply'
								]);
							}
						} else {
							$gceksrtklr	= Suratkeluar::where('marking', $marking)->first();
							if (isset($gceksrtklr->id)){
								$yy 		= $gceksrtklr->yersrt;
								$nomor 		= $gceksrtklr->nomor;
								$kodefak	= $gceksrtklr->kodefak;
								$jenissrt	= $gceksrtklr->jenissrt;
								$unit 		= $gceksrtklr->unit;
								$tglsurat	= $gceksrtklr->tglsurat;
								$faskode	= $gceksrtklr->faskode;
								if (is_null($faskode) OR $faskode == ''){
									$nomorsrt	= $nomor.'/'.$kodefak.'/'.$unit.'/'.$yy;
								} else {
									$nomorsrt	= $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yy;
								}
								$idsurat	= $gceksrtklr->id;
								$noagenda	= '';
								$nosurat	= $nomorsrt;
								$kepada		= $gceksrtklr->kepada;
								$perihal	= $gceksrtklr->perihal;
								$alamat		= $gceksrtklr->alamat;
								$lampiran	= $gceksrtklr->lampiran;
								$kodefak	= $gceksrtklr->kodefak;
								$klasifikasi= $gceksrtklr->klasifikasi;
								$pembuat	= $gceksrtklr->pembuat;
								$unit		= $gceksrtklr->unit;
								$tabel		= 'KELUAR';
								if ($jenissrt == 'PKWT'){ $perihal = $perihal.' an. '.$kepada; }
							} else {
								Inboxsurat::where('id', $idinbox)->update([
									'status' => 'reply'
								]);
							}
						}
					} else if ($keterangan == 'MASUK'){
						$gceksrtklr	= Suratmasuk::where('marking', $marking)->first();
						if (isset($gceksrtklr->id)){
							$yy 		= $gceksrtklr->yersrt;
							$nomor 		= $gceksrtklr->nosurat;
							$kodefak	= $gceksrtklr->subyek;
							$jenissrt	= $gceksrtklr->jenissurat;
							$unit 		= $gceksrtklr->asalsurat;
							$tglsurat	= $gceksrtklr->tglmasuk;
							$idsurat	= $gceksrtklr->id;
							$noagenda	= $gceksrtklr->noagenda;
							$nosurat	= $gceksrtklr->nosurat;
							$kepada		= $gceksrtklr->kepada;
							$perihal	= $gceksrtklr->perihal;
							$alamat		= '';
							$lampiran	= $gceksrtklr->lampiran;
							$klasifikasi= $gceksrtklr->faskode;
							$pembuat	= $gceksrtklr->pembuat;
							$tabel		= 'MASUK';
						} else {
							Inboxsurat::where('id', $idinbox)->update([
								'status' => 'reply'
							]);
						}
					} else {
						$gceksrtklr	= Suratkeluartnpnomor::where('marking', $marking)->first();
						if (isset($gceksrtklr->id)){
							$yy 		= $gceksrtklr->yersrt;
							$nomor 		= $gceksrtklr->nomor;
							$kodefak	= $gceksrtklr->kodefak;
							$jenissrt	= $gceksrtklr->jenissrt;
							$unit 		= $gceksrtklr->unit;
							$tglsurat	= $gceksrtklr->tglbuat;
							$idsurat	= $gceksrtklr->id;
							$noagenda	= '';
							$tglsurat	= '';
							$jenissrt	= $gceksrtklr->judul;
							$nosurat	= '';
							$kepada		= $gceksrtklr->kepada;
							$perihal	= $gceksrtklr->perihal;
							$alamat		= $gceksrtklr->alamat;
							$lampiran	= $gceksrtklr->lampiran;
							$kodefak	= $gceksrtklr->kodefak;
							$klasifikasi= $gceksrtklr->klasifikasi;
							$pembuat	= $gceksrtklr->pembuat;
							$unit		= $gceksrtklr->unit;
							$tabel		= 'KELUARNONOMER';
						} else {
							Inboxsurat::where('id', $idinbox)->update([
								'status' => 'reply'
							]);
						}
					}
					Inboxsurat::where('id', $result->id)->update([
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
						'tabel'			=> $tabel
					]);
				}

				$arrayouser[] = array(
					'id' 			=> $idsurat,
					'idinbox' 		=> $idinbox,
					'marking' 		=> $marking,
					'pemberi' 		=> $pemberi,
					'kerja' 		=> $kerja,
					'keterangan' 	=> $keterangan,
					'noagenda' 		=> '',
					'tglsurat' 		=> $tglsurat,
					'jenissrt' 		=> $jenissrt,
					'nosurat' 		=> $nosurat,
					'kepada' 		=> $kepada,
					'perihal' 		=> $perihal,
					'alamat' 		=> $alamat,
					'lampiran' 		=> $lampiran,
					'kodefak' 		=> $kodefak,
					'klasifikasi' 	=> $klasifikasi,
					'pembuat' 		=> $pembuat,
					'unit' 			=> $unit,
					'tabel' 		=> $catatan,
					'catatan' 		=> $catatan,
					'status' 		=> $status,
				);
			}
		}
		
		$kumpulandata = [
			'message'   	=> 'List Laporan',
			'data'      	=> $arrayouser,
			'mkelompok' 	=> $pimpinan,
			'merangkap' 	=> $merangkap,
			'jenissuratklr' => $jenissuratklr,
			'total'     	=> $totaldata
		];
        return response()->json($kumpulandata, 200);
    }
	public function datapermohonanNomorPaged(Request $request) {
		$arraypermohonannomor 	= [];
		$bulan 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$mnama			= Session('nama');
		$fakultas		= Session('fakultas');
		$petugas		= Session('jabatan');
		$idjabatan		= Session('idjabatan');
		$homebase		= url("/");
		$totaldata  	= 0;
        $pagenum  		= 0;
        $filterscount  	= 0;
        $limit         	= 10;
		$tahun			= date('Y');
		$sortdatafield	= 'id';
		$sortorder		= 'DESC';
        $limit      	= ($request->input('pagesize') == null ? $limit : $request->input('pagesize'));
		$pagenum    	= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  	= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  = ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  	= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
		$jenissurat 	= ($request->input('jenissurat') == null ? '' : $request->input('jenissurat'));
        $petugas 		= ($request->input('petugas') == null ? Session('email') : $request->input('petugas'));
        $tahun 			= ($request->input('tahun') == null ? date('Y') : $request->input('tahun'));
        $kelompok 		= ($request->input('kelompok') == null ? Session('jabatan') : $request->input('kelompok'));
		if ($kelompok == 'Suratkeluarnonomer'){
			$getprevilage = User::where('email', $petugas)->first();
			if (isset($getprevilage->id)){
				$petugas = $getprevilage->previlage;
			}
			if ( $petugas == 'developer' OR $petugas == 'Tata Usaha' OR  $petugas == 'Admin SDM' OR $petugas == 'administrasi' OR $petugas == 'developer' OR $petugas == 'Sekretaris' OR $petugas == 'admin'){
				$data 	    = Suratkeluartnpnomor::where('fakultas', $fakultas);
			} else {
				$data 	    = Suratkeluartnpnomor::where('pembuat', 'LIKE', Session('email'))->where('fakultas', $fakultas);
			}
			if ($sortdatafield == 'tlsnomor') { $sortdatafield = 'id'; }
		} else {
			if ($tahun == 'peremail'){
				if ($jenissurat == 'Pemanggilan KIE Staf'){
					$data 	    = Suratkeluar::where('jenissrt', 'LIKE', $jenissurat.'%')->where('alamat', $petugas);
				} else {
					$data 	    = Suratkeluar::where('jenissrt', 'LIKE', '%'.$jenissurat.'%')->where('kepada', $petugas);
				}
			} else {
				$getprevilage = User::where('email', $petugas)->first();
				if (isset($getprevilage->id)){
					$petugas = $getprevilage->previlage;
				} { $petugas = Session('previlage'); }
				if ( $petugas == 'developer' OR $petugas == 'Tata Usaha' OR  $petugas == 'Admin SDM' OR $petugas == 'administrasi' OR $petugas == 'Sekretaris' OR $petugas == 'admin'){
					$data 	    = Suratkeluar::where('nomor', '!=', '0')->where('fakultas', $fakultas);
				} else {
					$data 	    = Suratkeluar::where('pembuat', 'LIKE', Session('email'))->where('fakultas', $fakultas);
				}
			}
			if ($sortdatafield == 'tlsnomor') { $sortdatafield = 'nomor'; }
		}
		if ($tahun == 'peremail'){
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'tlsnomor') { $filterdatafield = 'nomor'; }
					if ($filterdatafield == 'tulisorg') { $filterdatafield = 'kelompok'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
		} else {
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'tlsnomor') { $filterdatafield = 'nomor'; }
					if ($filterdatafield == 'tulisorg') { $filterdatafield = 'kelompok'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			} else {
				$data = $data->where('yersrt', $tahun);
			}
			if ($jenissurat != ''){
				$data = $data->where('jenissrt', $jenissurat)->where('pembuat', 'LIKE', Session('email'))->where('arsip', '');
			}
		}
		if ($sortdatafield == 'tulisorg') { $sortdatafield = 'kelompok'; }
		if ($sortdatafield == 'status') { $sortdatafield = 'jenissrt'; }
		$pagenum++;
		$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
		$totaldata	= $data->total();
        if (!empty($data)){
			foreach ($data as $hasil) {
				$idsurat 	= $hasil->id;
				$marking 	= $hasil->marking;
				$status 	= $hasil->status;
				$nomor 		= $hasil->nomor;
				$klasifikasi= $hasil->klasifikasi;
				$jenissrt	= $hasil->jenissrt;
				$perihal	= $hasil->perihal;
				$dasarsurat	= $hasil->dasarsurat;
				$daysrt 	= $hasil->daysrt;
				$isisurat 	= $hasil->isisurat;
				$monsrt 	= (int)$hasil->monsrt;
				$yersrt		= $hasil->yersrt;
				$pembuat	= $hasil->pembuat;
				$kelompok	= $hasil->kelompok;
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
				$arrisine 	= explode('[psh]', $isisurat);
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
				$tulisorg	= $kelompok.' ( '.$pembuat.' )';
				if (isset($bulan[$monsrt])){
					$bulane		= $bulan[$monsrt];
				} else { $bulanne = ''; }
				$tglsurat	= $hasil->tglsurat;
				if ($tglsurat == '0000-00-00'){
					Suratkeluar::where('id', $hasil->id)->update([
						'tglsurat'	=> $hasil->yersrt.'-'.$hasil->monsrt.'-'.$hasil->daysrt
					]);
				}
				if ($jenissrt == 'REQUEST' AND $status == 'NEW'){
					Suratkeluar::where('id', $hasil->id)->update([
						'status'	=> 'PERMOHONAN NOMOR STAF'
					]);
				}
				$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;

				if ($status != 'MANUAL'){
					$tabel = 'KELUAR';
				} else { $tabel = $status; }
				if ($hasil->anakno != ''){ $nomor = $nomor.'.'.$hasil->anakno; }
				if ($hasil->tandatangan == ''){
					$cekstatus 	= Inboxsurat::where('marking', $hasil->marking)->where('status', 'SIgned With TTE')->whereIn('kerja', ['TTD', 'Mohon TTD'])->count();
					if ($cekstatus != 0){
						Suratkeluar::where('id', $hasil->id)->update([
							'tandatangan'	=> 'SIgned With TTE'
						]);
					}
					if ($jenissrt == 'Tugas' OR 
						$jenissrt == 'Undangan' OR 
						$jenissrt == 'Edaran' OR 
						$jenissrt == 'Referensi Kerja' OR 
						$jenissrt == 'Perjanjian Orientasi Kerja' OR 
						$jenissrt == 'PKWT' OR 
						$jenissrt == 'PKWTT' OR 
						$jenissrt == 'Keterangan Tidak Bekerja' OR 
						$jenissrt == 'Keterangan Aktif Bekerja' OR 
						$jenissrt == 'Pemberitahuan Sekretaris' OR 
						$jenissrt == 'Pemberitahuan Mutasi' OR 
						$jenissrt == 'Pemberitahuan Tidak Memperpanjang Kontrak' OR 
						$jenissrt == 'Tanggapan Pengunduran Diri Masa Orientasi' OR $jenissrt == 'Tanggapan Permohonan Tidak Memperpanjang Kontrak' OR $jenissrt == 'Tanggapan Pengunduran Diri Pegawai Tetap' OR $jenissrt == 'Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak' OR $jenissrt == 'Tanggapan Pengunduran Diri' OR $jenissrt == 'Tanggapan Pengunduran Diri Dokter Umum/Spesialis' OR
						$jenissrt == 'Balasan Penambahan Staf' OR 
						$jenissrt == 'Peringatan' OR 
						$jenissrt == 'Edaran' OR 
						$jenissrt == 'Pemanggilan KIE Staf' OR 
						$jenissrt == 'Pegawai Tetap' OR 
						$jenissrt == 'Pengangkatan Jabatan' OR 
						$jenissrt == 'Pemberhentian Jabatan' OR 
						$jenissrt == 'Dokter Tetap' OR 
						$jenissrt == 'Penerimaan Staf' OR 
						$jenissrt == 'Penonaktifan Staf' OR 
						$jenissrt == 'Pengaktifan Staf' OR 
						$jenissrt == 'Penempatan Administrasi Pendaftaran' OR
						$jenissrt == 'Penempatan Analis Kesehatan' OR
                        $jenissrt == 'Penempatan Perawat' OR
						$jenissrt == 'Penempatan Perekam Medik' OR
                        $jenissrt == 'Penempatan Security' OR
						$jenissrt == 'Permohonan' OR
						$jenissrt == 'Mutasi' OR 
						$jenissrt == 'Penonaktifan Dokter Tetap'){
						if ($jenissrt == 'Referensi Kerja'){
							$isisurat	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge pull-left badge-info">Surat Belum di TTE</small></a>';
						} else {
							$isisurat	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge pull-left badge-info">Surat Belum di TTE</small></a>';
						}
						$tlsnomor	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge badge-info">'.$nomor.'</small></a>';
						$tlsnomor	= '<small class="badge badge-info">'.$nomor.'</small>';
						$tulisorg	= '<small class="badge badge-info">'.$tulisorg.'</small>';
						$perihal	= '<small class="badge badge-info">'.$perihal.'</small>';
						$tglsurat	= '<small class="badge badge-info">'.$tglsurat.'</small>';
					} else if ($jenissrt == 'SERTIFIKATTTE'){
						$isisurat	= '<a href="'.$homebase.'/serfitikat/'.$hasil->id.'" target="_blank"><small class="badge pull-left badge-info">Setting Sertifikat</small></a>';
						$tlsnomor	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge badge-info">'.$nomor.'</small></a>';
						$tulisorg	= '<small class="badge badge-info">'.$tulisorg.'</small>';
						$perihal	= '<small class="badge badge-info">'.$perihal.'</small>';
						$tglsurat	= '<small class="badge badge-info">'.$tglsurat.'</small>';
					} else if ($jenissrt == 'UPLOAD'){
						$isisurat	= '<a href="'.$homebase.'/viewsurat/keluar-'.$hasil->id.'" target="_blank"><small class="badge pull-left badge-info">Surat Belum di TTE</small></a>';
						$tlsnomor	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge badge-info">'.$nomor.'</small></a>';
						$tulisorg	= '<small class="badge badge-info">'.$tulisorg.'</small>';
						$perihal	= '<small class="badge badge-info">'.$perihal.'</small>';
						$tglsurat	= '<small class="badge badge-info">'.$tglsurat.'</small>';
					} else {
						if (File::exists(public_path() ."/scan/files/". $hasil->marking.'.pdf') OR File::exists(base_path() ."/public/scan/files/".$hasil->marking.'.pdf') OR File::exists(base_path() ."public/scan/files/".$hasil->marking.'.pdf')) {
							$isisurat	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge pull-left badge-danger">Belum di Setujui, Klik Untuk Melihat</small></a>';	
							$tlsnomor	= '<small class="badge badge-success">'.$nomor.'</small>';
							$tulisorg	= '<small class="badge badge-success">'.$tulisorg.'</small>';
							$perihal	= '<small class="badge badge-success">'.$perihal.'</small>';
							$tglsurat	= '<small class="badge badge-success">'.$tglsurat.'</small>';
						} else {
							if ($jenissrt == 'REQUEST'){
								$isisurat	= '<small class="badge pull-left badge-danger">PERMOHONAN NOMOR STAF</small>';
								$tlsnomor	= '<small class="badge badge-danger">'.$nomor.'</small>';
								$tulisorg	= '<small class="badge badge-danger">'.$tulisorg.'</small>';
								$perihal	= '<small class="badge badge-danger">'.$perihal.'</small>';
								$tglsurat	= '<small class="badge badge-danger">'.$tglsurat.'</small>';
							} else {
								$isisurat	= '<small class="badge pull-left badge-danger">Belum Upload File</small>';
								$tlsnomor	= '<small class="badge badge-danger">'.$nomor.'</small>';
								$tulisorg	= '<small class="badge badge-danger">'.$tulisorg.'</small>';
								$perihal	= '<small class="badge badge-danger">'.$perihal.'</small>';
								$tglsurat	= '<small class="badge badge-danger">'.$tglsurat.'</small>';
							}
						}
					}
				} else {
					if (File::exists(public_path() ."/scan/files/". $hasil->marking.'.pdf') OR File::exists(base_path() ."/public/scan/files/".$hasil->marking.'.pdf') OR File::exists(base_path() ."public/scan/files/".$hasil->marking.'.pdf')) {
						if ($hasil->tandatangan == 'Antri TTE'){
							$isisurat	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge pull-left badge-info">Proses TTE</small></a>';	
							$tlsnomor	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge badge-info">'.$nomor.'</small></a>';
							$tulisorg	= '<small class="badge badge-info">'.$tulisorg.'</small>';
							$perihal	= '<small class="badge badge-info">'.$perihal.'</small>';
							$tglsurat	= '<small class="badge badge-info">'.$tglsurat.'</small>';
						} else {
							$isisurat	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge pull-left badge-success">'.$hasil->tandatangan.', Klik Untuk Melihat</small></a>';	
							$tlsnomor	= '<a href="'.$homebase.'/trackingid/srtklr-'.$hasil->marking.'" target="_blank"><small class="badge badge-success">'.$nomor.'</small></a>';
							$tulisorg	= '<small class="badge badge-success">'.$tulisorg.'</small>';
							$perihal	= '<small class="badge badge-success">'.$perihal.'</small>';
							$tglsurat	= '<small class="badge badge-success">'.$tglsurat.'</small>';
						}
					} else {
						$isisurat	= '<small class="badge pull-left badge-danger">File Arsip Tidak ditemukan</small>';
						$tlsnomor	= '<small class="badge badge-danger">'.$nomor.'</small>';
						$tulisorg	= '<small class="badge badge-danger">'.$tulisorg.'</small>';
						$perihal	= '<small class="badge badge-danger">'.$perihal.'</small>';
						$tglsurat	= '<small class="badge badge-danger">'.$tglsurat.'</small>';
					}
				}
				$cekdisposisi	= Suratmasuk::where('marking', 'LIKE', '%'.$marking)->count();
				if ($cekdisposisi != 0){
					if ($cekdisposisi == 1){
						$getsrtmasuk= Suratmasuk::where('marking', 'LIKE', '%'.$marking)->first();
						$isisurat	= $isisurat.'<br /><a href="'.$homebase.'/trackingid/srtmsk-'.$getsrtmasuk->marking.'" target="_blank"><small class="label pull-left bg-green">Proses, Klik Untuk Melihat Tindaklanjut</small></a>';
					} else {
						$getsrtmasuk= Suratmasuk::where('marking', 'LIKE', '%'.$marking)->get();
						foreach ($getsrtmasuk as $rtracking){
							$isisurat = $isisurat.'<a href="'.$homebase.'/trackingid/srtmsk-'.$rtracking->marking.'" target="_blank"><small class="label pull-left bg-green">Tracking di '.$rtracking->fakultas.'</small></a><br />';
						}
					}
				}
				$pembuat		= $hasil->pembuat;
				$arraypermohonannomor[] = array(
					'id' 			=> $idsurat,	
					'nomor' 		=> $nomor,
					'tlsnomor' 		=> $tlsnomor,
					'marking' 		=> $hasil->marking,
					'kodefak' 		=> $hasil->kodefak,
					'unit' 			=> $hasil->unit,
					'tglsurat' 		=> $tglsurat,
					'plaintglsurat'	=> $hasil->tglsurat,
					'kepada' 		=> $hasil->kepada,
					'alamat' 		=> $hasil->alamat,
					'perihal' 		=> $perihal,
					'plainperihal' 	=> $hasil->perihal,
					'lampiran' 		=> $hasil->lampiran,
					'isisurat' 		=> $hasil->isisurat,
					'paraf1' 		=> $hasil->paraf1,
					'pejabat' 		=> $hasil->pejabat,
					'idpejabat' 	=> $hasil->idpejabat,
					'namapejabat' 	=> $hasil->namapejabat,
					'tembusan' 		=> $hasil->tembusan,
					'sifat' 		=> $hasil->sifat,
					'klasifikasi' 	=> $hasil->klasifikasi,
					'pembuat' 		=> $hasil->pembuat,
					'footnote' 		=> $hasil->footnote,
					'jenissrt' 		=> $hasil->jenissrt,
					'faskode' 		=> $hasil->faskode,
					'subkode' 		=> $hasil->subkode,
					'selesai' 		=> $hasil->updated_at,
					'dsrsrt' 		=> $dasarsurat,
					'status' 		=> $isisurat,
					'tabel' 		=> $tabel,
					'setval01' 		=> $setval01,
					'setval02' 		=> $setval02,
					'setval03' 		=> $setval03,
					'setval04' 		=> $setval04,
					'setval05' 		=> $setval05,
					'setval06' 		=> $setval06,
					'setval07' 		=> $setval07,
					'setval08' 		=> $setval08,
					'setval09' 		=> $setval09,
					'setval10' 		=> $setval10,
					'setval11' 		=> $setval11,
					'setval12' 		=> $setval12,
					'setval13' 		=> $setval13,
					'setval14' 		=> $setval14,
					'setval15' 		=> $setval15,
					'setval16' 		=> $setval16,
					'setval17' 		=> $setval17,
					'setval18' 		=> $setval18,
					'setval19' 		=> $setval19,
					'setval20' 		=> $setval20,
					'tulisorg'		=> $tulisorg
				);
			}
		}
		$response = [
            'message'   => 'List Laporan',
            'data'      => $arraypermohonannomor,
            'fakultas'  => $fakultas,
            'tahun'     => $tahun,
            'total'     => $totaldata,
            'pembuat'   => $petugas,
            'kelompok' 	=> $kelompok,
			'jenissurat'=> $jenissurat
        ];
        return response()->json($response, 200);
    }
	public function exSetnomorterbaru(Request $request) {
		$fakultas	= Session('fakultas');
		$tahun		= date("Y");
		$cekdatasrt	= Suratkeluar::where('yersrt', $tahun)->where('fakultas', $fakultas)->where('nomor', '!=', 0)->orderBy('nomor', 'DESC')->count();
		if ($cekdatasrt != 0){
			$getdatasrt	= Suratkeluar::where('yersrt', $tahun)->where('fakultas', $fakultas)->where('nomor', '!=', 0)->orderBy('nomor', 'DESC')->first();
			$nomor 		= $getdatasrt->nomor;
			$kodefak 	= $getdatasrt->kodefak;
			$tanggal 	= $getdatasrt->tglsurat;
			$unit 		= $getdatasrt->unit;
			$tahun 		= $getdatasrt->yersrt;
			$nomor 		= $nomor+1;
		} else {
			$nomor 		= 1;
			$tanggal	= date("Y-m-d");
			$getkode 	= Pejabatsurat::where('fakultas','LIKE', '%'.Session('fakultas').'%')->first();
			if (isset($getkode->kode)){
				$kodefak= $getkode->kode;
			} else { $kodefak = ''; }
			$unit 		= 'TU';
		}
		return response()->json([
			'nomor' 	=> $nomor, 
			'kodett' 	=> $kodefak, 
			'kodepp' 	=> $unit, 
			'tahun' 	=> $tahun, 
			'tanggal'	=> $tanggal
		]);
		return back();
    }
	public function getskDanperaturan(Request $request) {
		$arrayskper 	= [];
		$fakultas		= Session('fakultas');
		$homebase		= url("/");
		$totaldata  	= 0;
        $pagenum  		= 0;
        $filterscount  	= 0;
        $limit         	= 10;
		$sortdatafield	= 'id';
		$sortorder		= 'DESC';
		$tahun			= date('Y');
        $limit      	= ($request->input('pagesize') == null ? 10 : $request->input('pagesize'));
		$pagenum    	= ($request->input('pagenum') == null ? 0 : $request->input('pagenum'));
		$filterscount  	= ($request->input('filterscount') == null ? 0 : $request->input('filterscount'));
		$sortdatafield  = ($request->input('sortdatafield') == null ? 'id' : $request->input('sortdatafield'));
		$sortorder  	= ($request->input('sortorder') == null ? 'DESC' : $request->input('sortorder'));
		$tahun  		= ($request->input('tahun') == null ? $tahun : $request->input('tahun'));
		$jenissurat 	= ($request->input('jenissurat') == null ? '-' : $request->input('jenissurat'));
		$petugas 		= ($request->input('petugas') == null ? '-' : $request->input('petugas'));
		$kelompok 		= ($request->input('kelompok') == null ? '-' : $request->input('kelompok'));
		if ($jenissurat == '-'){ $jenissurat = ''; }
		if ($jenissurat == '-' OR $jenissurat == ''){
			$data		= Tabelskdanperaturan::where('fakultas', $fakultas);
		} else {
			if ($tahun == 'peremail'){
				$data 	= Tabelskdanperaturan::where('kelompok', 'LIKE', $jenissurat.'%')->where('sparaf1', $petugas);
			} else {
				$data 	= Tabelskdanperaturan::where('kelompok', $jenissurat)->where('fakultas', $fakultas);
			}
		}
		if ($tahun == 'peremail'){
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			} 
		} else {
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			} else {
				$data 		= $data->where('tahun', $tahun)->where('arsip', '');
			}
		}
		
		$pagenum++;
		$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
		$totaldata	= $data->total();
		if (!empty($data)){
			foreach ($data as $getdatasrt) {
				$nomor				= $getdatasrt->nomor;
				$tahunsk			= $getdatasrt->tahun;
				$tlsnomor			= $nomor.' Tahun '.$tahunsk;
				if ($getdatasrt->kelompok == 'SKDANPERATURAN') { 
					$tlskelompok = 'Surat Keputusan';
				} else if ($getdatasrt->kelompok == 'PERATURAN') { 
					$tlskelompok = 'Surat Keputusan';
				} else {
					$tlskelompok = $getdatasrt->kelompok;
				}
				
				if ($getdatasrt->tandatangan == 'Tandatangan Manual'){
					if (File::exists(public_path() ."/scan/files/". $getdatasrt->scansurat) OR File::exists(base_path() ."/public/scan/files/". $getdatasrt->scansurat) OR File::exists(base_path() ."public/scan/files/". $getdatasrt->scansurat)) {
						$status		= '<a href="'.$homebase.'/trackingid/srtklr-'.$getdatasrt->marking.'" target="_blank"><small class="badge pull-left badge-info">Tandatangan Manual</small></a>';	
						$tlsnomor	= '<a href="'.$homebase.'/viewsurat/SKPP-'.$getdatasrt->id.'" target="_blank"><small class="badge badge-info">'.$tlsnomor.'</small></a>';
						$tlstanggal	= '<small class="badge badge-info">'.$getdatasrt->tanggal.'</small>';
						$tlsjudul	= '<small class="badge badge-info">'.$getdatasrt->judul.'</small>';
						$tlskelompok= '<small class="badge badge-info">'.$tlskelompok.'</small>';
					} else {
						$status		= '<small class="badge pull-left badge-danger">Belum Menyerahkan Arsip</small>';
						$tlsnomor	= '<small class="badge badge-danger">'.$tlsnomor.'</small>';
						$tlstanggal	= '<small class="badge badge-danger">'.$getdatasrt->tanggal.'</small>';
						$tlsjudul	= '<small class="badge badge-danger">'.$getdatasrt->judul.'</small>';
						$tlskelompok= '<small class="badge badge-danger">'.$tlskelompok.'</small>';
					}
				} else if ($getdatasrt->tandatangan == 'Auto'){
					$status		= '<a href="'.$homebase.'/trackingid/srtklr-'.$getdatasrt->marking.'" target="_blank"><small class="badge pull-left badge-info">Siap Kirim</small></a>';	
					$tlsnomor	= '<a href="'.$homebase.'/viewsurat/SKPP-'.$getdatasrt->id.'" target="_blank"><small class="badge badge-info">'.$tlsnomor.'</small></a>';
					$tlstanggal	= '<small class="badge badge-info">'.$getdatasrt->tanggal.'</small>';
					$tlsjudul	= '<small class="badge badge-info">'.$getdatasrt->judul.'</small>';
					$tlskelompok= '<small class="badge badge-info">'.$tlskelompok.'</small>';
				} else if ($getdatasrt->tandatangan == 'Proses'){
					$status		= '<a href="'.$homebase.'/trackingid/srtklr-'.$getdatasrt->marking.'" target="_blank"><small class="badge pull-left badge-info">Proses TTE</small></a>';	
					$tlsnomor	= '<a href="'.$homebase.'/viewsurat/SKPP-'.$getdatasrt->id.'" target="_blank"><small class="badge badge-info">'.$tlsnomor.'</small></a>';
					$tlstanggal	= '<small class="badge badge-info">'.$getdatasrt->tanggal.'</small>';
					$tlsjudul	= '<small class="badge badge-info">'.$getdatasrt->judul.'</small>';
					$tlskelompok= '<small class="badge badge-info">'.$tlskelompok.'</small>';
				} else {
					if (File::exists(public_path() ."/scan/files/". $getdatasrt->marking.".pdf") OR File::exists(public_path() ."/public/scan/files/". $getdatasrt->marking.".pdf") OR File::exists(base_path() ."/public/scan/files/". $getdatasrt->marking.".pdf") OR File::exists(base_path() ."public/scan/files/". $getdatasrt->marking.".pdf")) {
						$status		= '<a href="'.$homebase.'/trackingid/srtklr-'.$getdatasrt->marking.'" target="_blank"><small class="badge pull-left badge-success">'.$getdatasrt->tandatangan.'</small></a>';	
						$tlsnomor	= '<a href="'.$homebase.'/viewsurat/SKPP-'.$getdatasrt->id.'" target="_blank"><small class="badge badge-success">'.$tlsnomor.'</small></a>';
						$tlstanggal	= '<small class="badge badge-success">'.$getdatasrt->tanggal.'</small>';
						$tlsjudul	= '<small class="badge badge-success">'.$getdatasrt->judul.'</small>';
						$tlskelompok= '<small class="badge badge-success">'.$tlskelompok.'</small>';
					} else if (File::exists(public_path() ."/scan/files/". $getdatasrt->scansurat) OR File::exists(public_path() ."/public/scan/files/". $getdatasrt->scansurat) OR File::exists(base_path() ."/public/scan/files/". $getdatasrt->scansurat) OR File::exists(base_path() ."public/scan/files/". $getdatasrt->scansurat)) {
						if ($getdatasrt->tandatangan == ''){
							$status		= '<a href="'.$homebase.'/trackingid/srtklr-'.$getdatasrt->marking.'" target="_blank"><small class="badge pull-left badge-warning">Proses TTE</small></a>';	
							$tlsnomor	= '<a href="'.$homebase.'/viewsurat/SKPP-'.$getdatasrt->id.'" target="_blank"><small class="badge badge-warning">'.$tlsnomor.'</small></a>';
							$tlstanggal	= '<small class="badge badge-warning">'.$getdatasrt->tanggal.'</small>';
							$tlsjudul	= '<small class="badge badge-warning">'.$getdatasrt->judul.'</small>';
							$tlskelompok= '<small class="badge badge-warning">'.$tlskelompok.'</small>';
						} else {
							$status		= '<a href="'.$homebase.'/trackingid/srtklr-'.$getdatasrt->marking.'" target="_blank"><small class="badge pull-left badge-success">'.$getdatasrt->tandatangan.'</small></a>';	
							$tlsnomor	= '<a href="'.$homebase.'/viewsurat/SKPP-'.$getdatasrt->id.'" target="_blank"><small class="badge badge-success">'.$tlsnomor.'</small></a>';
							$tlstanggal	= '<small class="badge badge-success">'.$getdatasrt->tanggal.'</small>';
							$tlsjudul	= '<small class="badge badge-success">'.$getdatasrt->judul.'</small>';
							$tlskelompok= '<small class="badge badge-success">'.$tlskelompok.'</small>';
						}
					} else {
						$status		= '<small class="badge pull-left badge-danger">Belum Menyerahkan Arsip</small>';
						$tlsnomor	= '<small class="badge badge-danger">'.$tlsnomor.'</small>';
						$tlstanggal	= '<small class="badge badge-danger">'.$getdatasrt->tanggal.'</small>';
						$tlsjudul	= '<small class="badge badge-danger">'.$getdatasrt->judul.'</small>';
						$tlskelompok= '<small class="badge badge-danger">'.$tlskelompok.'</small>';
					}
				}
				$cekdisposisi	= Suratmasuk::where('marking', 'LIKE', '%'.$getdatasrt->marking)->count();
				if ($cekdisposisi != 0){
					if ($cekdisposisi == 1){
						$getsrtmasuk= Suratmasuk::where('marking', 'LIKE', '%'.$getdatasrt->marking)->first();
						$status		= $status.'<br /><a href="'.$homebase.'/trackingid/srtmsk-'.$getsrtmasuk->marking.'" target="_blank"><small class="label pull-left bg-green">Proses, Klik Untuk Melihat Tindaklanjut</small></a>';
					} else {
						$getsrtmasuk= Suratmasuk::where('marking', 'LIKE', '%'.$getdatasrt->marking)->get();
						foreach ($getsrtmasuk as $rtracking){
							$status = $status.'<a href="'.$homebase.'/trackingid/srtmsk-'.$rtracking->marking.'" target="_blank"><small class="label pull-left bg-green">Tracking di '.$rtracking->fakultas.'</small></a><br />';
						}
					}
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
				$arrisine 	= explode('[psh]', $getdatasrt->scansurat);
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
				$arrayskper[] 	= array(
					'status' 			=> $status,
					'tlsnomor' 			=> $tlsnomor,
					'tlstanggal' 		=> $tlstanggal,
					'tlsjudul' 			=> $tlsjudul,
					'tlskelompok' 		=> $tlskelompok,
					'id' 				=> $getdatasrt->id,
					'kelompok' 			=> $getdatasrt->kelompok,
					'marking' 			=> $getdatasrt->marking,
					'nomor' 			=> $getdatasrt->nomor,
					'tahun' 			=> $getdatasrt->tahun,
					'tanggal' 			=> $getdatasrt->tanggal,
					'penandatangan' 	=> $getdatasrt->penandatangan,
					'idpejabat' 		=> $getdatasrt->idpejabat,
					'nmpejabat' 		=> $getdatasrt->nmpejabat,
					'nippejabat' 		=> $getdatasrt->nippejabat,
					'pjbtperundang' 	=> $getdatasrt->pjbtperundang,
					'idpjbperundang'	=> $getdatasrt->idpjbperundang,
					'nmpjbtperundang' 	=> $getdatasrt->nmpjbtperundang,
					'nippjbperundang' 	=> $getdatasrt->nippjbperundang,
					'tglpjbperundang' 	=> $getdatasrt->tglpjbperundang,
					'judul' 			=> $getdatasrt->judul,
					'scansurat' 		=> $getdatasrt->scansurat,
					'uraian1' 			=> $getdatasrt->uraian1,
					'uraian2' 			=> $getdatasrt->uraian2,
					'uraian3' 			=> $getdatasrt->uraian3,
					'dasarsurat' 		=> $getdatasrt->dasarsurat,
					'dasarsuratno' 		=> $getdatasrt->dasarsuratno,
					'dasarsuratyy' 		=> $getdatasrt->dasarsuratyy,
					'kodefas' 			=> $getdatasrt->kodefas,
					'kodesub' 			=> $getdatasrt->kodesub,
					'paraf1' 			=> $getdatasrt->paraf1,
					'paraf2' 			=> $getdatasrt->paraf2,
					'paraf3' 			=> $getdatasrt->paraf3,
					'paraf4' 			=> $getdatasrt->paraf4,
					'catatan' 			=> $getdatasrt->catatan,
					'inputor' 			=> $getdatasrt->inputor,
					'setval01' 			=> $setval01,
					'setval02' 			=> $setval02,
					'setval03' 			=> $setval03,
					'setval04' 			=> $setval04,
					'setval05' 			=> $setval05,
					'setval06' 			=> $setval06,
					'setval07' 			=> $setval07,
					'setval08' 			=> $setval08,
					'setval09' 			=> $setval09,
					'setval10' 			=> $setval10,
					'setval11' 			=> $setval11,
					'setval12' 			=> $setval12,
					'setval13' 			=> $setval13,
					'setval14' 			=> $setval14,
					'setval15' 			=> $setval15,
					'setval16' 			=> $setval16,
					'setval17' 			=> $setval17,
					'setval18' 			=> $setval18,
					'setval19' 			=> $setval19,
					'setval20' 			=> $setval20,
				);
			}
		}
    	$response = [
            'message'   => 'List Laporan',
            'data'      => $arrayskper,
            'fakultas'  => $fakultas,
            'tahun'     => $tahun,
            'total'     => $totaldata,
            'pembuat'   => $petugas,
            'kelompok' 	=> $kelompok,
			'jenissurat'=> $jenissurat
        ];
        return response()->json($response, 200);	
	}
	public function exCreatedisposisi(Request $request) {
		$err 			= array();
		$kepada   		= '';
		$keterangan 	= '';
		$disposisi 		= '';
		$tulisnomor		= '';
		$tglsurat		= date("Y-m-d");
		$homebase		= url("/");
    	$disposisi 		= $request->input('id_disposisi');
		$idmailbox 		= $request->input('id_surid');
		$idsurat 		= $request->input('id_marking');
		$arrkepada 		= $request->input('kepada');
		$formDoor 		= $request->input('formDoor');
		$sifatdispo		= $request->input('id_sifatdiposisi');
		$cekkembar		= '';
		$pemberi 		= Session('jabatan');
		$pejabat		= Session('jabatan');
		$pembuat 		= Session('nama');
		$perihal		= 'Mailbox';
		if (!empty($arrkepada)){
			foreach ( $arrkepada as $tujuan )
			{
				if ($tujuan == $pejabat){ $cekkembar = 'Ada'; }
				if ($kepada == ''){ $kepada = $tujuan; }
				else { $kepada = $kepada.'-'.$tujuan; }
			}
		}
		if (!empty($formDoor)){
			foreach ( $formDoor as $valket )
			{
				if ($valket != ''){
					if ($keterangan == '') {$keterangan = '<ul><li>'.$valket.'</li>';}
					else {$keterangan = $keterangan.'<li>'.$valket.'</li>'; }
				}
			}
		}
		$namafile 		= '';
		$oklanjut 		= 'NO';
		if ($keterangan != '') { $keterangan = $keterangan.'</ul>';}
		$setdisposisi = '';
		if ($disposisi == '' and $keterangan != ''){ $setdisposisi = $keterangan; }
		if ($disposisi != '' and $keterangan == ''){ $setdisposisi = $disposisi; }
		if ($disposisi != '' and $keterangan != ''){ $setdisposisi = $keterangan.'<br />Catatan : '.$disposisi; }
		if ($request->hasFile('file')) {
			$validator = Validator::make($request->all(), [
				'file' =>  'mimes:pdf,PDF|max:20000'
			]);
			if ($validator->fails()) {
				$oklanjut 		= 'NO';
			} else {
				$oklanjut 		= 'OK';
			}
		} else { $oklanjut 		= 'OK'; }
		if ($idmailbox == '' OR is_null($idmailbox)){ $oklanjut = 'NO'; }
		if ($setdisposisi != '' and $idsurat != ''  and $kepada != '' and $oklanjut == 'OK' AND $cekkembar == '') {
			$tahun 			= date("Y");
			$fakultas		= Session('fakultas');
			$subyek			= '';
			$lampiran		= '';
			$filelampiran	= '';
			$faskode		= '';
			$nomor 			= '';
			$tulisnomor 	= '';
				
			$getnoagenda 	= Suratmasuk::where('fakultas', Session('fakultas'))->where('yersrt', $tahun)->orderBy('noagenda', 'DESC')->first();
			if (isset($getnoagenda->noagenda)){
				$noagenda 	= $getnoagenda->noagenda;
				$noagenda	= $noagenda + 1;
			} else { $noagenda = 1; }
			$marking 		= $fakultas.'-'.$tahun.$noagenda;
			$gettanggal 	= explode("-", $tglsurat);
			$daysrt			= $gettanggal[2];
			$monsrt			= $gettanggal[1];
			
			$getmailbox		= Penerimasurat::where('id', $idmailbox)->first();
			if (isset($getmailbox->jenis)){
				$jenissrt 	= $getmailbox->jenis;
				$keterangan = $getmailbox->keterangan;
				$isisrt 	= $getmailbox->tabel;
				$fasmasa 	= $getmailbox->idpegawai;
				if ($jenissrt == 'KELUAR'){
					if ($keterangan == 'SKDANPERATURAN'){
						$gceksrtklr = Tabelskdanperaturan::where('id', $idsurat)->first();
						if (isset($gceksrtklr->nomor)){
							$marking 			= $gceksrtklr->marking;
							$nomor 				= $gceksrtklr->nomor;
							$tahunsk 			= $gceksrtklr->tahun;
							$tglsurat			= $gceksrtklr->tanggal;
							$penandatangan 		= $gceksrtklr->penandatangan;
							$perihal			= $gceksrtklr->judul;
							$scansurat 			= $gceksrtklr->scansurat;
							$dasarsurat 		= $gceksrtklr->dasarsurat;
							$klasifikasi 		= $gceksrtklr->kodefas;
							$kodesub			= $gceksrtklr->kodesub;
							$pembuat 			= $gceksrtklr->inputor;
							$tulisnomor 		= $nomor.' Tahun '.$tahunsk;
							$subyek				= '';
							$lampiran			= '';
							$filelampiran		= '';
							$faskode			= '';
						}
					} else {
						$gceksrtklr = Suratkeluar::where('id', $idsurat)->first();
						if (isset($gceksrtklr->status)){
							$nomor 				= $gceksrtklr->nomor;
							$anakno				= $gceksrtklr->anakno;
							$kodefak			= $gceksrtklr->kodefak;
							$jenissrt			= $gceksrtklr->jenissrt;
							$unit 				= $gceksrtklr->unit;
							$tglsurat			= $gceksrtklr->tglsurat;
							$klasifikasi 		= $gceksrtklr->klasifikasi;
							$pembuat			= $gceksrtklr->pembuat;
							$perihal 			= $gceksrtklr->perihal;
							$subyek 			= $gceksrtklr->unit;
							$filelampiran		= $gceksrtklr->filelampiran;
							$lampiran 			= $gceksrtklr->lampiran;
							$daysrt 			= $gceksrtklr->daysrt;
							$monsrt 			= $gceksrtklr->monsrt;
							$yersrt 			= $gceksrtklr->yersrt;
							$faskode			= $gceksrtklr->faskode;
							$fasmasa			= $gceksrtklr->fasmasa;
							$marking 			= $gceksrtklr->marking;
							if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
							/*	
							if ($klasifikasi == 'Biasa'){
								$nomor = 'B/'.$nomor;
							} else if ($klasifikasi == 'Rahasia'){
								$nomor = 'R/'.$nomor;
							} else if ($klasifikasi == 'Sangat Rahasia'){
								$nomor = 'SR/'.$nomor;
							} else if ($klasifikasi == 'Terbatas'){
								$nomor = 'T/'.$nomor;
							} else if ($klasifikasi == 'Lainnya'){
								$nomor = 'L/'.$nomor;
							} else {
								$nomor = $nomor;
							}
							*/
							if ($faskode == ''){
								//$tulisnomor = $nomor.' / '.$kodefak.' / '.$unit.' / '.$yersrt;
								$tulisnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
							} else {
								$tulisnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
							}
						}
					}
				} else if ($jenissrt == 'SK' OR $jenissrt == 'Draft SK'){
					$gceksrtklr = Draftsk::where('id', $idsurat)->first();
					if (isset($gceksrtklr->nomor)){
						$nomor 				= $gceksrtklr->nomor;
						$tahunsk 			= $gceksrtklr->tahun;
						$tglsurat			= $gceksrtklr->tmt;
						$penandatangan 		= $gceksrtklr->penandatangan;
						$perihal			= $gceksrtklr->jenissk;
						$marking 			= $gceksrtklr->marking;
						$klasifikasi 		= 'Biasa';
						$pembuat 			= $gceksrtklr->konseptor;
						$tulisnomor 		= $nomor.' Tahun '.$tahunsk;
						$gettanggal 		= explode("-", $tglsurat);
						$daysrt				= $gettanggal[2];
						$monsrt				= $gettanggal[1];
						$subyek				= '';
						$lampiran			= '';
						$filelampiran		= '';
						$faskode			= '';
					}
				} else {
					$nomor 				= '';
					$tahunsk 			= date("Y");
					$tglsurat			= date("Y-m-d");
					$perihal			= $jenissrt;
					$klasifikasi 		= 'Biasa';
					$tulisnomor 		= '';
					$gettanggal 		= explode("-", $tglsurat);
					$daysrt				= $gettanggal[2];
					$monsrt				= $gettanggal[1];
					$subyek				= '';
					$lampiran			= '';
					$filelampiran		= '';
					$faskode			= '';
				}
			} else {
				$tahunsk 			= date("Y");
				$tglsurat			= date("Y-m-d");
				$klasifikasi 		= 'Biasa';
				$gettanggal 		= explode("-", $tglsurat);
				$daysrt				= $gettanggal[2];
				$monsrt				= $gettanggal[1];
			}
			if ($marking == ''){
				$marking 	= $fakultas.'-'.$tahun.$noagenda;
			}
			$ceknomorawal 	= Suratmasuk::where('nosurat', $tulisnomor)->where('perihal', 'LIKE', $perihal)->count();
			if ($ceknomorawal != 0){
				$ceksek 	= Suratmasuk::where('nosurat', $tulisnomor)->where('perihal', 'LIKE', $perihal)->first();
				$idne		= $ceksek->id;
			} else {
				$ceksek 		= Suratmasuk::where('marking', $marking)->count();
				if ($ceksek == 0){
					$idne 		= Suratmasuk::insertGetId([
						'marking' 		=>  $marking,
						'noagenda' 		=>  $noagenda,
						'tglmasuk' 		=>  date("Y-m-d"),
						'tglsurat' 		=>  $tglsurat,
						'daysrt' 		=>  $daysrt,
						'monsrt' 		=>  $monsrt,
						'yersrt' 		=>  $tahun,
						'jenissurat' 	=>  $jenissrt,
						'nosurat' 		=>  $tulisnomor,
						'asalsurat' 	=>  $pembuat,
						'kepada' 		=>  $kepada,
						'perihal' 		=>  $perihal,
						'subyek' 		=>  $subyek,
						'ringkasan' 	=>  '',
						'ringkasan2' 	=>  $isisrt,
						'lampiran' 		=>  $lampiran,
						'scansurat' 	=>  $filelampiran,
						'sifat' 		=>  'Biasa',
						'bentuk' 		=>  Session('namaapps01'),
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('nama'),
						'status' 		=>  '',
						'disposisi' 	=>  '',
						'arsip' 		=>  '',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
						'faskode' 		=>  $faskode,
						'fasmasa' 		=>  $fasmasa,
						'fasket' 		=>  '',
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  '',
						'fakultas' 		=>  Session('fakultas'),
					]);
				} else {
					$ceksek 	= Suratmasuk::where('marking', $marking)->first();
					$idne		= $ceksek->id;
				}
			}
			$jceksrtmsk		= Suratmasuk::where('id', $idne)->first();
			$noagenda		= $jceksrtmsk->noagenda;
			$tglmasuk		= $jceksrtmsk->tglmasuk;
			$dislws			= $jceksrtmsk->disposisi;
			$marking		= $jceksrtmsk->marking;
			$sifat			= $jceksrtmsk->sifat;
			$fakultas		= $jceksrtmsk->fakultas;
			$subyek			= $jceksrtmsk->subyek;
			$statuslm		= $jceksrtmsk->status;
			$idsuratfk		= $idne;
			$tujuanfk		= '';
			$lihaterror		= '';
			if ($namafile != ''){
				$inputdisposisi = Disposisi::insert([
					'idsurat'  		=>  $idne,
					'pemberi'  		=>  $pemberi,
					'isidisposisi'	=>  $setdisposisi,
					'kepada'		=>  $kepada,
					'lampiran'		=>  $namafile,
					'keterangan'	=>  'Surat Masuk',
					'ordner'		=>  '',
					'lemari'		=>  $sifatdispo,
				]);
			} else {
				$inputdisposisi = Disposisi::insert([
					'idsurat'  		=>  $idne,
					'pemberi'  		=>  $pemberi,
					'isidisposisi'	=>  $setdisposisi,
					'kepada'		=>  $kepada,
					'lampiran'		=>  '',
					'keterangan'	=>  'Surat Masuk',
					'ordner'		=>  '',
					'lemari'		=>  $sifatdispo,
				]);
			}
			foreach ( $arrkepada as $tujuan ){
				if ($tujuan != ''){
					if ($statuslm != 'arsip'){
						if ($tujuan == 'Arsiparis Umum' OR $tujuan == 'Arsiparis'){
							Suratmasuk::where('id', $idne)->update([
								'status' => 'arsip'
							]);
						} else {
							if ($pemberi == 'Kasubbag Akademik' OR $pemberi == 'Direktur Direktorat Administrasi dan Layanan Akademik'){
								Suratmasuk::where('id', $idne)->update([
									'status' =>  'AKAD'
								]);
							}
							else if ($pemberi == 'Kasubbag Kemahasiswaan' OR $pemberi == 'Direktur Direktorat Kemahasiswaan'){
								Suratmasuk::where('id', $idne)->update([
									'status' =>  'KMH'
								]);
							}
							else if ($pemberi == 'Kasubbag Keuangan & Kepegawaian' OR $pemberi == 'Direktur Direktorat Anggaran dan Perbendaharaan'){
								Suratmasuk::where('id', $idne)->update([
									'status' =>  'KEU'
								]);
							}
							else if ($pemberi == 'Kasubbag Umum & BMN' OR $pemberi == 'Direktur Direktorat Aset'){
								Suratmasuk::where('id', $idne)->update([
									'status' =>  'UMUM'
								]);
							}
							else {
								Suratmasuk::where('id', $idne)->update([
									'status' =>  'disposisi'
								]);
							}
						}
					}
					$getemail = Pejabatsurat::where('pejabat', $tujuan)->first();
					if (isset($getemail->pejabat)){
						$email = $getemail->email;
					} else {
						$email = $tujuan;
					}
					SendMail::kiriminbox($marking,$pemberi,$tujuan,$email,'MASUK','DISPOSISI','','1');
				
				}
			}
			if ($tujuan == 'Dekan Fakultas Kedokteran' OR $tujuan == 'Wakil Dekan Bidang Umum dan Keuangan FK' OR $tujuan == 'Semua Dekan' OR $tujuan == 'Semua Wakil Dekan II'){
				if ($namafile != ''){
					Disposisifk::insert([
						'idsurat'  		=>  $idsuratfk,
						'pemberi'  		=>  $pemberi,
						'isidisposisi'	=>  $setdisposisi,
						'kepada'		=>  $kepada,
						'lampiran'		=>  $namafile,
						'keterangan'	=>  'Surat Masuk',
						'ordner'		=>  '',
						'lemari'		=>  $sifatdispo,
					]);
				}else {
					Disposisifk::insert([
						'idsurat'  		=>  $idsuratfk,
						'pemberi'  		=>  $pemberi,
						'isidisposisi'	=>  $setdisposisi,
						'kepada'		=>  $kepada,
						'lampiran'		=>  '',
						'keterangan'	=>  'Surat Masuk',
						'ordner'		=>  '',
						'lemari'		=>  $sifatdispo,
					]);
				}
			}
			if ($inputdisposisi){
				$getmailbox		= Penerimasurat::where('id', $idmailbox)->update([
					'status' => 'Telah ditindaklanjuti'
				]);
				if ($jenissrt == 'KELUAR'){
					if ($keterangan == 'SKDANPERATURAN'){
						Tabelskdanperaturan::where('id', $idsurat)->update([
							'catatan' => '<a href="'.$homebase.'/trackingid/srtmsk-'.$marking.'" target="_blank">Telah ditindaklanjuti</a>'		
						]);
					} else {
						Suratkeluar::where('id', $idsurat)->update([
							'status' => '<a href="'.$homebase.'/trackingid/srtmsk-'.$marking.'" target="_blank">Telah ditindaklanjuti</a>'		
						]);
					}
				}
				Session::flash('status', 'Success');
				Session::flash('message', 'Pesan anda telah kami sampaikan ke '.$kepada); 
				Session::flash('alert-class', 'alert-success');
				return back();
			} else {
				Session::flash('status', 'Gagal!');
				Session::flash('message', 'Pesan anda gagal kami sampaikan ke '.$kepada.' mohon ulangi beberapa saat lagi'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			}
		} else {
			Session::flash('status', 'Gagal!');
			Session::flash('message', 'Mohon Periksa isi Tujuan dan Isi Disposisi; Dan apabila anda upload file, File yang bisa di Upload hanyalah PDF dengan ukuran kurang dari 20Mb'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
		}
    }
	public function exCreatedisposisiMulti(Request $request) {
		$err 			= array();
		$kepada   		= '';
		$keterangan 	= '';
		$disposisi 		= '';
		$tulisnomor		= '';
		$tglsurat		= date("Y-m-d");
		$homebase		= url("/");
    	$disposisi 		= $request->input('val02');
		$arridsrt 		= $request->input('val04');
		$arrkepada 		= $request->input('val01');
		$formDoor 		= $request->input('val03');
		$sifatdispo		= $request->input('val05');
		$cekkembar		= '';
		$pemberi 		= Session('jabatan');
		$pejabat		= Session('jabatan');
		$pembuat 		= Session('nama');
		$perihal		= 'Mailbox';
		if (!empty($arrkepada)){
			foreach ( $arrkepada as $tujuan )
			{
				if ($tujuan == $pejabat){ $cekkembar = 'Ada'; }
				if ($kepada == ''){ $kepada = $tujuan; }
				else { $kepada = $kepada.'-'.$tujuan; }
			}
		}
		if (!empty($formDoor)){
			foreach ( $formDoor as $valket )
			{
				if ($valket != ''){
					if ($keterangan == '') {$keterangan = '<ul><li>'.$valket.'</li>';}
					else {$keterangan = $keterangan.'<li>'.$valket.'</li>'; }
				}
			}
		}
		$namafile 		= '';
		$oklanjut 		= 'NO';
		if ($keterangan != '') { $keterangan = $keterangan.'</ul>';}
		$setdisposisi = '';
		if ($disposisi == '' and $keterangan != ''){ $setdisposisi = $keterangan; }
		if ($disposisi != '' and $keterangan == ''){ $setdisposisi = $disposisi; }
		if ($disposisi != '' and $keterangan != ''){ $setdisposisi = $keterangan.'<br />Catatan : '.$disposisi; }
		if ($request->hasFile('file')) {
			$validator = Validator::make($request->all(), [
				'file' =>  'mimes:pdf,PDF|max:20000'
			]);
			if ($validator->fails()) {
				$oklanjut 		= 'NO';
			} else {
				$oklanjut 		= 'OK';
			}
		} else { $oklanjut 		= 'OK'; }
		if ($setdisposisi != '' and $kepada != '' AND $cekkembar == '') {
			$tahun 			= date("Y");
			$fakultas		= Session('fakultas');
			foreach ( $arridsrt as $idmailbox ){
				$subyek			= '';
				$lampiran		= '';
				$filelampiran	= '';
				$faskode		= '';
				$nomor 			= '';
				$tulisnomor 	= '';
					
				$getnoagenda 	= Suratmasuk::where('fakultas', Session('fakultas'))->where('yersrt', $tahun)->orderBy('noagenda', 'DESC')->first();
				if (isset($getnoagenda->noagenda)){
					$noagenda 	= $getnoagenda->noagenda;
					$noagenda	= $noagenda + 1;
				} else { $noagenda = 1; }
				$marking 		= $fakultas.'-'.$tahun.$noagenda;
				$gettanggal 	= explode("-", $tglsurat);
				$daysrt			= $gettanggal[2];
				$monsrt			= $gettanggal[1];
				
				$getmailbox		= Penerimasurat::where('id', $idmailbox)->first();
				if (isset($getmailbox->jenis)){
					$idsurat 	= $getmailbox->idsurat;
					$jenissrt 	= $getmailbox->jenis;
					$keterangan = $getmailbox->keterangan;
					$isisrt 	= $getmailbox->tabel;
					$fasmasa 	= $getmailbox->idpegawai;
					if ($jenissrt == 'KELUAR'){
						if ($keterangan == 'SKDANPERATURAN'){
							$gceksrtklr = Tabelskdanperaturan::where('id', $idsurat)->first();
							if (isset($gceksrtklr->nomor)){
								$marking 			= $gceksrtklr->marking;
								$nomor 				= $gceksrtklr->nomor;
								$tahunsk 			= $gceksrtklr->tahun;
								$tglsurat			= $gceksrtklr->tanggal;
								$penandatangan 		= $gceksrtklr->penandatangan;
								$perihal			= $gceksrtklr->judul;
								$scansurat 			= $gceksrtklr->scansurat;
								$dasarsurat 		= $gceksrtklr->dasarsurat;
								$klasifikasi 		= $gceksrtklr->kodefas;
								$kodesub			= $gceksrtklr->kodesub;
								$pembuat 			= $gceksrtklr->inputor;
								$tulisnomor 		= $nomor.' Tahun '.$tahunsk;
								$subyek				= '';
								$lampiran			= '';
								$filelampiran		= '';
								$faskode			= '';
							}
						} else {
							$gceksrtklr = Suratkeluar::where('id', $idsurat)->first();
							if (isset($gceksrtklr->status)){
								$nomor 				= $gceksrtklr->nomor;
								$anakno				= $gceksrtklr->anakno;
								$kodefak			= $gceksrtklr->kodefak;
								$jenissrt			= $gceksrtklr->jenissrt;
								$unit 				= $gceksrtklr->unit;
								$tglsurat			= $gceksrtklr->tglsurat;
								$klasifikasi 		= $gceksrtklr->klasifikasi;
								$pembuat			= $gceksrtklr->pembuat;
								$perihal 			= $gceksrtklr->perihal;
								$subyek 			= $gceksrtklr->unit;
								$filelampiran		= $gceksrtklr->filelampiran;
								$lampiran 			= $gceksrtklr->lampiran;
								$daysrt 			= $gceksrtklr->daysrt;
								$monsrt 			= $gceksrtklr->monsrt;
								$yersrt 			= $gceksrtklr->yersrt;
								$faskode			= $gceksrtklr->faskode;
								$fasmasa			= $gceksrtklr->fasmasa;
								$marking 			= $gceksrtklr->marking;
								if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
								if ($faskode == ''){
									$tulisnomor = $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yersrt;
								} else {
									$tulisnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
								}
							}
						}
					} else if ($jenissrt == 'SK' OR $jenissrt == 'Draft SK'){
						$gceksrtklr = Draftsk::where('id', $idsurat)->first();
						if (isset($gceksrtklr->nomor)){
							$nomor 				= $gceksrtklr->nomor;
							$tahunsk 			= $gceksrtklr->tahun;
							$tglsurat			= $gceksrtklr->tmt;
							$penandatangan 		= $gceksrtklr->penandatangan;
							$perihal			= $gceksrtklr->jenissk;
							$marking 			= $gceksrtklr->marking;
							$klasifikasi 		= 'Biasa';
							$pembuat 			= $gceksrtklr->konseptor;
							$tulisnomor 		= $nomor.' Tahun '.$tahunsk;
							$gettanggal 		= explode("-", $tglsurat);
							$daysrt				= $gettanggal[2];
							$monsrt				= $gettanggal[1];
							$subyek				= '';
							$lampiran			= '';
							$filelampiran		= '';
							$faskode			= '';
						}
					} else {
						$nomor 				= '';
						$tahunsk 			= date("Y");
						$tglsurat			= date("Y-m-d");
						$perihal			= $jenissrt;
						$klasifikasi 		= 'Biasa';
						$tulisnomor 		= '';
						$gettanggal 		= explode("-", $tglsurat);
						$daysrt				= $gettanggal[2];
						$monsrt				= $gettanggal[1];
						$subyek				= '';
						$lampiran			= '';
						$filelampiran		= '';
						$faskode			= '';
					}
					if ($marking == ''){
						$marking 	= $fakultas.'-'.$tahun.$noagenda;
					}
					$ceknomorawal 	= Suratmasuk::where('nosurat', $tulisnomor)->where('perihal', 'LIKE', $perihal)->count();
					if ($ceknomorawal != 0){
						$ceksek 	= Suratmasuk::where('nosurat', $tulisnomor)->where('perihal', 'LIKE', $perihal)->first();
						$idne		= $ceksek->id;
					} else {
						$ceksek 		= Suratmasuk::where('marking', $marking)->count();
						if ($ceksek == 0){
							$idne 		= Suratmasuk::insertGetId([
								'marking' 		=>  $marking,
								'noagenda' 		=>  $noagenda,
								'tglmasuk' 		=>  date("Y-m-d"),
								'tglsurat' 		=>  $tglsurat,
								'daysrt' 		=>  $daysrt,
								'monsrt' 		=>  $monsrt,
								'yersrt' 		=>  $tahun,
								'jenissurat' 	=>  $jenissrt,
								'nosurat' 		=>  $tulisnomor,
								'asalsurat' 	=>  $pembuat,
								'kepada' 		=>  $kepada,
								'perihal' 		=>  $perihal,
								'subyek' 		=>  $subyek,
								'ringkasan' 	=>  '',
								'ringkasan2' 	=>  $isisrt,
								'lampiran' 		=>  $lampiran,
								'scansurat' 	=>  $filelampiran,
								'sifat' 		=>  'Biasa',
								'bentuk' 		=>  Session('namaapps01'),
								'klasifikasi' 	=>  'Biasa',
								'pembuat' 		=>  Session('nama'),
								'status' 		=>  '',
								'disposisi' 	=>  '',
								'arsip' 		=>  '',
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',
								'faskode' 		=>  $faskode,
								'fasmasa' 		=>  $fasmasa,
								'fasket' 		=>  '',
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'fakultas' 		=>  Session('fakultas'),
							]);
						} else {
							$ceksek 	= Suratmasuk::where('marking', $marking)->first();
							$idne		= $ceksek->id;
						}
					}
					$jceksrtmsk		= Suratmasuk::where('id', $idne)->first();
					$noagenda		= $jceksrtmsk->noagenda;
					$tglmasuk		= $jceksrtmsk->tglmasuk;
					$dislws			= $jceksrtmsk->disposisi;
					$marking		= $jceksrtmsk->marking;
					$sifat			= $jceksrtmsk->sifat;
					$fakultas		= $jceksrtmsk->fakultas;
					$subyek			= $jceksrtmsk->subyek;
					$statuslm		= $jceksrtmsk->status;
					$idsuratfk		= $idne;
					$tujuanfk		= '';
					$lihaterror		= '';
					if ($namafile != ''){
						$inputdisposisi = Disposisi::insert([
							'idsurat'  		=>  $idne,
							'pemberi'  		=>  $pemberi,
							'isidisposisi'	=>  $setdisposisi,
							'kepada'		=>  $kepada,
							'lampiran'		=>  $namafile,
							'keterangan'	=>  'Surat Masuk',
							'ordner'		=>  '',
							'lemari'		=>  $sifatdispo,
						]);
					} else {
						$inputdisposisi = Disposisi::insert([
							'idsurat'  		=>  $idne,
							'pemberi'  		=>  $pemberi,
							'isidisposisi'	=>  $setdisposisi,
							'kepada'		=>  $kepada,
							'lampiran'		=>  '',
							'keterangan'	=>  'Surat Masuk',
							'ordner'		=>  '',
							'lemari'		=>  $sifatdispo,
						]);
					}
					foreach ( $arrkepada as $tujuan ){
						if ($tujuan != ''){
							if ($statuslm != 'arsip'){
								if ($tujuan == 'Arsiparis Umum' OR $tujuan == 'Arsiparis'){
									Suratmasuk::where('id', $idne)->update([
										'status' => 'arsip'
									]);
								} else {
									if ($pemberi == 'Kasubbag Akademik' OR $pemberi == 'Direktur Direktorat Administrasi dan Layanan Akademik'){
										Suratmasuk::where('id', $idne)->update([
											'status' =>  'AKAD'
										]);
									}
									else if ($pemberi == 'Kasubbag Kemahasiswaan' OR $pemberi == 'Direktur Direktorat Kemahasiswaan'){
										Suratmasuk::where('id', $idne)->update([
											'status' =>  'KMH'
										]);
									}
									else if ($pemberi == 'Kasubbag Keuangan & Kepegawaian' OR $pemberi == 'Direktur Direktorat Anggaran dan Perbendaharaan'){
										Suratmasuk::where('id', $idne)->update([
											'status' =>  'KEU'
										]);
									}
									else if ($pemberi == 'Kasubbag Umum & BMN' OR $pemberi == 'Direktur Direktorat Aset'){
										Suratmasuk::where('id', $idne)->update([
											'status' =>  'UMUM'
										]);
									}
									else {
										Suratmasuk::where('id', $idne)->update([
											'status' =>  'disposisi'
										]);
									}
								}
							}
							$getemail = Pejabatsurat::where('pejabat', $tujuan)->first();
							if (isset($getemail->pejabat)){
								$email = $getemail->email;
							} else {
								$email = $tujuan;
							}
							SendMail::kiriminbox($marking,$pemberi,$tujuan,$email,'MASUK','DISPOSISI','','1');
						
						}
					}
					if ($inputdisposisi){
						$getmailbox		= Penerimasurat::where('id', $idmailbox)->update([
							'status' => 'Telah ditindaklanjuti'
						]);
						if ($jenissrt == 'KELUAR'){
							if ($keterangan == 'SKDANPERATURAN'){
								Tabelskdanperaturan::where('id', $idsurat)->update([
									'catatan' => '<a href="'.$homebase.'/trackingid/srtmsk-'.$marking.'" target="_blank">Telah ditindaklanjuti</a>'		
								]);
							} else {
								Suratkeluar::where('id', $idsurat)->update([
									'status' => '<a href="'.$homebase.'/trackingid/srtmsk-'.$marking.'" target="_blank">Telah ditindaklanjuti</a>'		
								]);
							}
						}
					}
				}
			}
			return response()->json(['status' => 'Sukses!', 'message' => 'Pesan telah kami sampaikan ke tujuan disposisi']);
			return back();
		
		} else {
			return response()->json(['status' => 'Gagal!', 'message' => 'Mohon di isi Tujuan dan Isi Disposisi']);
			return back();
		}
    }
	public function exDisposisi(Request $request) {
		$err 			= array();
		$homebase		= url("/");
    	$kepada   		= '';
		$keterangan 	= '';
		$disposisi 		= '';
		$cekkembar		= '';
		$disposisi 		= $request->input('id_disposisi');
		$idne 			= $request->input('id_surid');
		$idmarking 		= $request->input('id_marking');
		$arrkepada 		= $request->input('kepada');
		$formDoor 		= $request->input('formDoor');
		$sifatdispo		= $request->input('id_sifatdiposisi');
		$nippenerima	= $request->input('id_nippenerima');
		$jcekinboxmsk	= Inboxsurat::where('id', $idmarking)->first();
		if (isset($jcekinboxmsk->id)){
			$idinbox	= $jcekinboxmsk->id;
			$penerima	= $jcekinboxmsk->penerima;
			$pemberi 	= $jcekinboxmsk->penerima;
		} else {
			$idinbox	= 0;
			$penerima 	= '';
			$pemberi	= '';
		}
		$cekkembar		= '';
		$pejabat		= Session('jabatan');
		if (!empty($arrkepada)){
			foreach ( $arrkepada as $tujuan )
			{
				if ($tujuan == $pejabat){ $cekkembar = 'Ada'; }
				if ($kepada == ''){ $kepada = $tujuan; }
				else { $kepada = $kepada.'-'.$tujuan; }
			}
		}
		if (!empty($formDoor)){
			foreach ( $formDoor as $valket )
			{
				if ($valket != ''){
					if ($keterangan == '') {$keterangan = '<ul><li>'.$valket.'</li>';}
					else {$keterangan = $keterangan.'<li>'.$valket.'</li>'; }
				}
			}
		}
		$namafile 		= '';
		$oklanjut 		= 'NO';
		if ($keterangan != '') { $keterangan = $keterangan.'</ul>';}
		$setdisposisi = '';
		if ($disposisi == '' and $keterangan != ''){ $setdisposisi = $keterangan; }
		if ($disposisi != '' and $keterangan == ''){ $setdisposisi = $disposisi; }
		if ($disposisi != '' and $keterangan != ''){ $setdisposisi = $keterangan.'<br />Catatan : '.$disposisi; }
		$jceksrtmsk		= Suratmasuk::where('id', $idne)->first();
		if (isset($jceksrtmsk->noagenda)){
			$noagenda		= $jceksrtmsk->noagenda;
			$tglmasuk		= $jceksrtmsk->tglmasuk;
			$dislws			= $jceksrtmsk->disposisi;
			$marking		= $jceksrtmsk->marking;
			$sifat			= $jceksrtmsk->sifat;
			$fakultas		= $jceksrtmsk->fakultas;
			$subyek			= $jceksrtmsk->subyek;
			$statuslm		= $jceksrtmsk->status;
			$idsuratfk		= $idne;
			$tujuanfk		= '';
			$lihaterror		= '';
			if ($sifatdispo == 'Segera'){ $sifat = 2; $sifatdispo = ''; }
			if ($sifatdispo == 'Sangat Segera'){ $sifat = 1; $sifatdispo = ''; }
			if ($request->hasFile('file')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:pdf,PDF|max:20000'
				]);
				if ($validator->fails()) {
					Session::flash('status', 'Error');
					Session::flash('message', 'File Format Harus PDF dan tidak melebihi dari 20mb.'); 
					Session::flash('alert-class', 'alert-danger');
					$oklanjut 		= 'NO';
					return back();
				} else {
					$namafile 		= $fakultas.'-TMBHSURATMASUK'.$noagenda.$tglmasuk.$subyek;
					$namafile		= md5($namafile);
					$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
					$uploadedFile 	= $request->file('file');
					$request->file->move(public_path('scan/files'), $namafile);
					$oklanjut 		= 'OK';
				}
			} else { $oklanjut 		= 'OK'; }
			if ($setdisposisi != '' and $idne != '' and $pemberi != '' and $kepada != '' and $oklanjut == 'OK' AND $cekkembar == '') {
				if ($namafile != ''){
					$inputdisposisi = Disposisi::insert([
						'idsurat'  		=>  $idne,
						'pemberi'  		=>  $pemberi,
						'isidisposisi'	=>  $setdisposisi,
						'kepada'		=>  $kepada,
						'lampiran'		=>  $namafile,
						'keterangan'	=>  'Surat Masuk',
						'ordner'		=>  '',
						'lemari'		=>  $sifatdispo,
					]);
				} else {
					$inputdisposisi = Disposisi::insert([
						'idsurat'  		=>  $idne,
						'pemberi'  		=>  $pemberi,
						'isidisposisi'	=>  $setdisposisi,
						'kepada'		=>  $kepada,
						'lampiran'		=>  '',
						'keterangan'	=>  'Surat Masuk',
						'ordner'		=>  '',
						'lemari'		=>  $sifatdispo,
					]);
				}
				foreach ( $arrkepada as $tujuan ){
					if ($tujuan != ''){
						if ($statuslm != 'arsip'){
							if ($tujuan == 'Arsiparis Umum' OR $tujuan == 'Arsiparis'){
								Suratmasuk::where('id', $idne)->update([
									'status' => 'arsip'
								]);
							} else {
								Suratmasuk::where('id', $idne)->update([
									'status' =>  'disposisi'
								]);
							}
						}
						$getemail = Pejabatsurat::where('pejabat', $tujuan)->first();
						if (isset($getemail->pejabat)){
							$email = $getemail->email;
						} else {
							$email = $tujuan;
						}
						SendMail::kiriminbox($marking,$pemberi,$tujuan,$email,'MASUK','DISPOSISI','','1');
					}
				}
				if ($inputdisposisi){
					Inboxsurat::where('penerima', $penerima)->where('marking', $marking)->where('jenis', 'MASUK')->update(['status' =>  'reply']);
				
					Session::flash('status', 'Success');
					Session::flash('message', 'Pesan anda telah kami sampaikan ke '.$kepada); 
					Session::flash('alert-class', 'alert-success');
		
					return back();
			
				} else {
					Session::flash('status', 'Gagal!');
					Session::flash('message', 'Pesan anda gagal kami sampaikan ke '.$kepada.' mohon ulangi beberapa saat lagi'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				}
			} else {
				Session::flash('status', 'Gagal!');
				Session::flash('message', 'Mohon Periksa isi Tujuan dan Isi Disposisi; Dan apabila anda upload file, File yang bisa di Upload hanyalah PDF dengan ukuran kurang dari 20Mb'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			}
		} else {
			Inboxsurat::where('id', $idinbox)->update([
				'status'	=> 'reply'
			]);
			Session::flash('status', 'Gagal!');
			Session::flash('message', 'ID Inbox '.$idmarking.' ID Surat '.$idne.' Tidak Ditemukan, Surat ini akan kami mark sebagai surat kosong'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
		}
    }
	public function exdisposisiMulti(Request $request) {
		$err 		= array();
		$pemberi	= Session('jabatan');
    	$arrkepada 	= $request->input('val01');
		$disposisi 	= $request->input('val02');
		$formDoor 	= $request->input('val03');
		$arridsrt 	= $request->input('val04');
		$sifatdispo = $request->input('val05');
		$keterangan	= '';
		$cekkembar	= '';
		$kepada		= '';
		$kepadafk	= '';
		$sifat		= 5;
		$homebase	= url("/");
    	if ($sifatdispo == 'Biasa'){ $sifat = 3; $sifatdispo = ''; }
		if ($sifatdispo == 'Segera'){ $sifat = 2; $sifatdispo = ''; }
		if ($sifatdispo == 'Sangat Segera' OR $sifatdispo == 'Rahasia'){ $sifat = 1; $sifatdispo = ''; }
		
		$cekisikpd 	= 0;
		if (!empty($arrkepada)){
			foreach ( $arrkepada as $tujuan ){
				if ($tujuan != ''){
					if ($kepada == ''){ $kepada = $tujuan; }
					else { $kepada = $kepada.'-'.$tujuan; }
					$cekisikpd++;
				}
			}
		}else { $cekisikpd = 0; }
		if (!empty($formDoor)){
			foreach ( $formDoor as $valket ){
				if ($valket != ''){
					if ($keterangan == '') {$keterangan = '<ul><li>'.$valket.'</li>';}
					else {$keterangan = $keterangan.'<li>'.$valket.'</li>'; }
				}
			}
		}
		$cekisiidne = 0;
		if (!empty($arridsrt)){
			$cekisiidne = 1;
		}
		if ($keterangan != '') { $keterangan = $keterangan.'</ul>';}
		$setdisposisi = '';
		if ($disposisi == '' and $keterangan != ''){ $setdisposisi = $keterangan; }
		if ($disposisi != '' and $keterangan == ''){ $setdisposisi = $disposisi; }
		if ($disposisi != '' and $keterangan != ''){ $setdisposisi = $keterangan.'<br />Catatan : '.$disposisi; }
		
		if ($setdisposisi != '' and $cekisiidne != 0 and $cekisikpd != 0) {
			foreach ( $arridsrt as $idsurat ){
				$jceksrtmsk		= Suratmasuk::where('id', $idsurat)->first();
				$dislws			= $jceksrtmsk->disposisi;
				$marking		= $jceksrtmsk->marking;
				$noagenda		= $jceksrtmsk->noagenda;
				$fakultas		= $jceksrtmsk->fakultas;
				$statuslm		= $jceksrtmsk->status;
				$lihaterror		= '';
				$inputdisposisi = Disposisi::insert([
					'idsurat'  		=>  $idsurat,
					'pemberi'  		=>  $pemberi,
					'isidisposisi'	=>  $setdisposisi,
					'kepada'		=>  $kepada,
					'keterangan'	=>  'Surat Masuk',
					'ordner'		=>  '',
					'lemari'		=>  $sifatdispo,
				]);
				foreach ( $arrkepada as $tujuan ){
					if ($tujuan != ''){
						if ($tujuan == 'Semua Dekan'){
							$kepadafk = 'Dekan';
							$getsemuadekan = Pejabatsurat::where('view', 'Semua Dekan')->get();
							foreach($getsemuadekan as $getdekan){
								$jabdekan = $getdekan->pejabat;
								SendMail::kiriminbox($marking,$pemberi,$jabdekan,$getdekan->email,'MASUK','DISPOSISI','','1');
							}
						} else if ($tujuan == 'Semua Wakil Dekan II'){
							$kepadafk = 'Wakil Dekan Bidang Umum dan Keuangan';
							$getsemuadekan = Pejabatsurat::where('view', 'WD2')->get();
							foreach($getsemuadekan as $getdekan){
								$jabdekan = $getdekan->pejabat;
								SendMail::kiriminbox($marking,$pemberi,$jabdekan,$getdekan->email,'MASUK','DISPOSISI','','1');
							}
						} else {
							if ($statuslm != 'arsip'){
								if ($tujuan == 'Arsiparis Umum'){
									Suratmasuk::where('id', $idsurat)->update([
										'status' => 'arsip'
									]);
								} else {
									if ($pemberi == 'Kasubbag Akademik' OR $pemberi == 'Direktur Direktorat Administrasi dan Layanan Akademik'){
										Suratmasuk::where('id', $idsurat)->update([
											'status' =>  'AKAD'
										]);
									}
									else if ($pemberi == 'Kasubbag Kemahasiswaan' OR $pemberi == 'Direktur Direktorat Kemahasiswaan'){
										Suratmasuk::where('id', $idsurat)->update([
											'status' =>  'KMH'
										]);
									}
									else if ($pemberi == 'Kasubbag Keuangan & Kepegawaian' OR $pemberi == 'Direktur Direktorat Anggaran dan Perbendaharaan'){
										Suratmasuk::where('id', $idsurat)->update([
											'status' =>  'KEU'
										]);
									}
									else if ($pemberi == 'Kasubbag Umum & BMN' OR $pemberi == 'Direktur Direktorat Aset'){
										Suratmasuk::where('id', $idsurat)->update([
											'status' =>  'UMUM'
										]);
									}
									else {
										Suratmasuk::where('id', $idsurat)->update([
											'status' =>  'disposisi'
										]);
									}
								}
							}
							$getemail = Pejabatsurat::where('pejabat', $tujuan)->first();
							if (isset($getemail->pejabat)){
								$email = $getemail->email;
							} else {
								$email = $tujuan;
							}
							SendMail::kiriminbox($marking,$pemberi,$jabdekan,$email,'MASUK','DISPOSISI','','1');
						}
					}
				}
				if ($inputdisposisi){
					Inboxsurat::where('penerima', $pemberi)
								->where('marking', $marking)
								->where('jenis', '=', 'MASUK')->
								update([
									'status' =>  'reply'
								]);
				}
	
			}
			return response()->json(['status' => 'Sukses!', 'message' => 'Pesan anda telah kami sampaikan ke tujuan disposisi']);
			return back();
		}else if ($cekkembar == 'kembar'){
			return response()->json(['status' => 'Gagal!', 'message' => 'Cek Kembali Tujuan Disposisi Anda, Karena Masih ada tujuan yang sama dengan pengirim']);
			return back();
		}else {
			return response()->json(['status' => 'Gagal!', 'message' => 'Mohon di isi Tujuan dan Isi Disposisi']);
			return back();
		}
    }
	public function exdisposisiReminder(Request $request) {
		$err 		= array();
		$pemberi	= Session('jabatan');
    	$arrkepada 	= $request->input('val01');
		$disposisi 	= $request->input('val02');
		$formDoor 	= $request->input('val03');
		$idsurat 	= $request->input('val04');
		$keterangan	= '';
		$cekkembar	= '';
		$kepada		= '';
		$cekisikpd 	= 0;
		if (!empty($arrkepada)){
			foreach ( $arrkepada as $tujuan ){
				if ($tujuan != ''){
					if ($kepada == ''){ $kepada = $tujuan; }
					else { $kepada = $kepada.'-'.$tujuan; }
					$cekisikpd++;
				}
			}
		}else { $cekisikpd = 0; }
		if (!empty($formDoor)){
			foreach ( $formDoor as $valket ){
				if ($valket != ''){
					if ($keterangan == '') {$keterangan = '<ul><li>'.$valket.'</li>';}
					else {$keterangan = $keterangan.'<li>'.$valket.'</li>'; }
				}
			}
		}
		
		if ($keterangan != '') { $keterangan = $keterangan.'</ul>';}
		$setdisposisi = '';
		if ($disposisi == '' and $keterangan != ''){ $setdisposisi = $keterangan; }
		if ($disposisi != '' and $keterangan == ''){ $setdisposisi = $disposisi; }
		if ($disposisi != '' and $keterangan != ''){ $setdisposisi = $keterangan.'<br />Catatan : '.$disposisi; }
		
		if ($setdisposisi != '' and $idsurat != 0 and $cekisikpd != 0) {
			$jceksrtmsk		= Suratmasuk::where('id', $idsurat)->first();
			$dislws			= $jceksrtmsk->disposisi;
			$marking		= $jceksrtmsk->marking;
			$noagenda		= $jceksrtmsk->noagenda;
			$sifat			= $jceksrtmsk->sifat;
			$fakultas		= $jceksrtmsk->fakultas;
			$lihaterror		= '';
			foreach ( $arrkepada as $tujuan ){
				if ($tujuan != ''){
					if ($tujuan ==  'Semua Dekan'){
						$getsemuadekan = Pejabatsurat::where('view', 'Semua Dekan')->get();
						foreach($getsemuadekan as $getdekan){
							$jabdekan = $getdekan->pejabat;
							SendMail::kiriminbox($marking,$pemberi,$jabdekan,$getdekan->email,'MASUK','DISPOSISI','','1');
						}
					} else if ($tujuan ==  'Semua Wakil Dekan II'){
						$getsemuadekan = Pejabatsurat::where('view', 'WD2')->get();
						foreach($getsemuadekan as $getdekan){
							$jabdekan = $getdekan->pejabat;
							SendMail::kiriminbox($marking,$pemberi,$jabdekan,$getdekan->email,'MASUK','DISPOSISI','','1');
						}
					} else {
						$getdekan = Pejabatsurat::where('pejabat', $tujuan)->first();
						if (isset($getdekan->pejabat)){
							$email = $getdekan->email;
						} else {
							$email = $tujuan;
						}
						SendMail::kiriminbox($marking,$pemberi,$tujuan,$email,'MASUK','DISPOSISI','','1');
					}
				}
			}
			Disposisi::insert([
				'idsurat'  		=>  $idsurat,
				'pemberi'  		=>  $pemberi,
				'isidisposisi'	=>  $setdisposisi,
				'kepada'		=>  $kepada,
				'keterangan'	=>  'Surat Masuk',
				'ordner'		=>  '',
				'lemari'		=>  '',
			]);
			return response()->json(['status' => 'Sukses!', 'message' => 'Pesan anda telah kami sampaikan ke tujuan disposisi']);
			return back();
		}else if ($cekkembar == 'kembar'){
			return response()->json(['status' => 'Gagal!', 'message' => 'Cek Kembali Tujuan Disposisi Anda, Karena Masih ada tujuan yang sama dengan pengirim']);
			return back();
		}else {
			return response()->json(['status' => 'Gagal!', 'message' => 'Mohon di isi Tujuan dan Isi Disposisi']);
			return back();
		}
    }
	public function viewDisposisi(Request $request) {
		$idne			= $request->input('val01');
		$idmarking		= $request->input('val02');
		$homebase		= url("/");
		$cekdata		= Suratmasuk::where('id', $idne)->count();
		if($cekdata != 0){
			$jinboxsrt		= Suratmasuk::where('id', $idne)->first();
			$idsurat		= $idne;
			$noagenda		= $jinboxsrt->noagenda;
			$tglmasuk		= $jinboxsrt->tglmasuk;
			$jenissurat		= $jinboxsrt->jenissurat;
			$nosurat		= $jinboxsrt->nosurat;
			$asalsurat		= $jinboxsrt->asalsurat;
			$kepada			= $jinboxsrt->kepada;
			$perihal		= $jinboxsrt->perihal;
			$subyek			= $jinboxsrt->subyek;
			$ringkasan		= $jinboxsrt->ringkasan;
			$ringkasan2		= $jinboxsrt->ringkasan2;
			$lampiran		= $jinboxsrt->lampiran;
			$sifat			= $jinboxsrt->sifat;
			$bentuk			= $jinboxsrt->bentuk;
			$klasifikasi	= $jinboxsrt->klasifikasi;
			$pembuat		= $jinboxsrt->pembuat;
			$disposisi		= $jinboxsrt->disposisi;
			$tglsurat		= $jinboxsrt->tglsurat;
			$scansurat		= $jinboxsrt->scansurat;
			
			if($ringkasan == $ringkasan2){
				$ringkasan	= '';
			} else {
				if(is_null($ringkasan2)){
					$arrringkasan= explode(" ", $ringkasan);
					if (isset($arrringkasan[1])){
						$katapertama 	= $arrringkasan[0];
						$katakedua		= $arrringkasan[1];
						
						$cekkalimat 	= $katapertama.' '.$katakedua;
						if ($cekkalimat != 'Telah di'){
							$ringkasan2	= $ringkasan;
							$ringkasan	= '';
						}
					}
				} else {
					$ringkasan2 = $ringkasan;
					$ringkasan	= '';
				}
			}
			$jjensurat		= Unitsurat::where('kode', $subyek)->first();
			if (isset($jjensurat->deskripsi)){
				$kodesubdeskripsi= $jjensurat->deskripsi;
			} else { $kodesubdeskripsi = ''; }
			$mkelompok		= Session('jabatan');
			$cekprevilage	= Pejabatsurat::where('pejabat', $mkelompok)->count();
			if ($cekprevilage == 0){ $mkelompok = Session('nama'); }
			$cekdispoakhir	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'DESC')->count();
			if ($cekdispoakhir != 0){
				$rdispoakhir	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'DESC')->first();
				$isidispoakhir	= $rdispoakhir->isidisposisi;
			}else { $isidispoakhir	= ''; }
			$tulisdisposisi	= '';
			$cekdisposisi	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'ASC')->count();
			if ($cekdisposisi != 0){
				$getdisposisi	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'ASC')->get();
				foreach($getdisposisi as $rdisposisi) {
					$pemberi			= $rdisposisi->pemberi;
					$isidisposisi		= $rdisposisi->isidisposisi;
					$disposisikpd		= $rdisposisi->kepada;
					$lampiran			= $rdisposisi->lampiran;
					$timestamp			= $rdisposisi->updated_at;
					$sifat				= $rdisposisi->lemari;
					if ($lampiran != ''){
						$isidisposisi 	= $isidisposisi.'<blockquote><p>Lampiran File :</p><a href="'.$homebase.'/viewdocbyname/'.$lampiran.'">Download File Lampiran</a></blockquote>';
					}
					if ($sifat == 'Rahasia'){
						$cekorange = Inboxsurat::where('pengirim', $pemberi)
										->where('penerima', $mkelompok)
										->count();
						if ($cekorange == 0 OR $pemberi != $mkelompok){
							$tulisdisposisi		= $tulisdisposisi.'
							<tr>
							  <td align="left" class="kiri atas kanan">'.$timestamp.'</td>
							  <td colspan="3" align="left" class="kanan atas">Rahasia</td>
							  <td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
							  <td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
							</tr>';
						}else {
							$tulisdisposisi		= $tulisdisposisi.'
							<tr>
							  <td align="left" class="kiri atas kanan">'.$timestamp.'</td>
							  <td colspan="3" align="left" class="kanan atas">'.$isidisposisi.'</td>
							  <td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
							  <td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
							</tr>';
						}
					}else {
						$tulisdisposisi		= $tulisdisposisi.'
						<tr>
						  <td align="left" class="kiri atas kanan">'.$timestamp.'</td>
						  <td colspan="3" align="left" class="kanan atas">'.$isidisposisi.'</td>
						  <td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
						  <td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
						</tr>';
					}				
				}
			}
			$swandhanafak       		= config('global.swandhanafak');
			$swandhanaalamat    		= config('global.swandhanaalamat');
			$swandhanakemen      		= config('global.swandhanakemen');
			$swandhanauniv      		= config('global.swandhanauniv');
			$data['universitas']   		= $swandhanauniv;
			$data['kementerian']   		= $swandhanakemen;
			$data['fakultas']   		= $swandhanafak;
			$data['kodesubdeskripsi']   = $kodesubdeskripsi;
			$data['subyek']         	= $subyek;
			$data['tglmasuk']         	= $tglmasuk;
			$data['noagenda']           = $noagenda;
			$data['perihal']         	= $perihal;
			$data['ringkasan']          = $ringkasan;
			$data['ringkasan2']         = $ringkasan2;
			$data['asalsurat']          = $asalsurat;
			$data['kepada']            	= $kepada;
			$data['tglsurat']           = $tglsurat;
			$data['nosurat']           	= $nosurat;
			$data['tulisdisposisi']   	= $tulisdisposisi;
			return view('cetak.disposisi', $data);
		} else { 
			$data = [];
			$data['judulpesan'] 	= 'Mohon Maaf Surat Telah di Hapus';
			$data['kalimatheader'] 	= 'Surat Tidak Valid';
			$data['kalimatbody'] 	= 'Mohon Maaf, Surat ini telah dihapus oleh pengirim surat, Bapak/Ibu pimpinan bisa mendisposisikan ke Arsiparis Umum untuk mengarsipkan';
			return view('errors.surathilang', $data);
		}
    }
	public function pingInbox(Request $request) {
		$idne 	= $request->input('val01');
		$kerja 	= Inboxsurat::where('id', $idne)->update([
			'status' 	=>  'send',
			'catatan' 	=>  'ping',
		]);
		return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Pinged..!!']);
		return back();
	}
	public function exMarkingmailbox(Request $request) {
		$idne 		= $request->input('val01');
		$cekdatane 	= Penerimasurat::where('id', $idne)->first();
		$isisurat	= '';
		if (isset($cekdatane->idsurat)){
			$idsurat 	= $cekdatane->idsurat;
			$jenis 		= $cekdatane->jenis;
			$cekpdf		= explode(".pdf", $cekdatane->tabel);
			if (isset($cekpdf[1])){
				$isisurat	= str_replace('<iframe src="https://sco.ub.ac.id/viewdocbyname/','https://sco.ub.ac.id/pdftohtml/',$cekdatane->tabel);
				$isisurat	= str_replace('.pdf" width="100%" height="780" style="border: none;" id="document-preview"></iframe>','.pdf',$isisurat);
			} else {
				$isisurat	= str_replace('<iframe src="','',$cekdatane->tabel);
				$isisurat	= str_replace('" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>','',$isisurat);
			}
			if ($jenis == 'KELUAR'){
				Suratkeluar::where('id', $idsurat)->update([
					'status' => 'Telah di Baca'
				]);
			}
		}
	
		return response()->json(['isisurat' => $isisurat, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Pinged..!!']);
		return back();
    }
	public function updSuratmasuk(Request $request) {
		$validator = Validator::make($request->all(), [
          'id_noagenda' 	=>  'required',
          'id_tglmasuk' 	=> 	'required',
          'id_tglsurat' 	=> 	'required',
          'id_jenissurat' 	=> 	'required',
          'id_asalsurat' 	=> 	'required',
          'id_subyek' 		=> 	'required',
          'set_kepada' 		=> 	'required',
        ]);
		if($validator->fails()) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Form Anda']);
			return back();
        } else {
			$homebase	= url("/");
			$noagenda 	= $request->input('id_noagenda');
			$tglmasuk 	= $request->input('id_tglmasuk');
			$tglsurat 	= $request->input('id_tglsurat');
			$nosurat  	= $request->input('id_nosurat');
			$jenissrt 	= $request->input('id_jenissurat');
			$asalsrt  	= $request->input('id_asalsurat');
			$perihal  	= $request->input('id_perihal');
			$isisrt   	= $request->input('id_ringkasan');
			$sifat 	  	= $request->input('id_sifat');
			$bentuk   	= $request->input('id_bentuk');
			$klasif   	= $request->input('id_klasifikasi');
			$surid    	= $request->input('id_idsurat');
			$subyek   	= $request->input('id_subyek');
			$lampiran 	= $request->input('id_lampiran');
			$tes		= $request->input('set_kepada');
			
			$kepada   	= json_decode($tes['0']);
			$kodearsip 	= $request->input('id_klasifikasiarsip');
			if ($lampiran == ''){ $lampiran = '-'; }
			$mkelompok	= Session('jabatan');
			$pembuat	= Session('nama');
			$fakultas	= Session('fakultas');
			if ($surid == 'baru'){
				if ($request->hasFile('file')) {
					$validator = Validator::make($request->all(), [
						'file' =>  'mimes:pdf,PDF|max:2000000'
					]);
					if ($validator->fails()) {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'File Format Harus PDF dan tidak melebihi dari 20mb.']);
						return back();
					} else {
						$tlskepada = '';
						foreach ( $kepada as $tujuan )
						{
							$tujuanne 	= $tujuan->id;
							if ($tlskepada == '') {$tlskepada = $tujuanne;}
							else {$tlskepada = $tlskepada.'-'.$tujuanne; }
						}
						$yy 			= substr($tglmasuk, 0, 4);
						$mm 			= substr($tglmasuk, 5, 2);
						$dd 			= substr($tglmasuk, 8, 2);
						$marking 		= $fakultas.'-'.$yy.$noagenda;
						$nomerganda 	= '';
						if ($nosurat == ''){ $nosurat = '-'; }
						if ($nosurat != '-'){
							$ceknomersrt = Suratmasuk::where('nosurat', $nosurat)->where('fakultas', $fakultas)->count();
							if ($ceknomersrt != 0){
								$nomerganda = 'Detected';
							}
						}
						$ceksrtnoagenda	= Suratmasuk::where('marking', $marking)->count();
						$ceknoagenda	= Suratmasuk::where('noagenda', $noagenda)->where('yersrt', $yy)->where('fakultas', $fakultas)->count();
						if ($ceksrtnoagenda != 0 OR $ceknoagenda != 0){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No. Agenda '.$noagenda.' Telah digunakan']);
							return back();
						}else if ($nomerganda != ''){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No. Surat '.$nosurat.' Telah Masuk Dalam Daftar Sebelumnya']);
							return back();
						}else {							
							$namafile		= $marking.'.'.$request->file->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('scan/files'), $namafile);
							$kerjanya = Suratmasuk::insert([
								'marking' 		=>  $marking,
								'noagenda' 		=>  $noagenda,
								'tglmasuk' 		=>  $tglmasuk,
								'tglsurat' 		=>  $tglsurat,
								'daysrt' 		=>  $dd,
								'monsrt' 		=>  $mm,
								'yersrt' 		=>  $yy,
								'jenissurat' 	=>  $jenissrt,
								'nosurat' 		=>  $nosurat,
								'asalsurat' 	=>  $asalsrt,
								'kepada' 		=>  $tlskepada,
								'perihal' 		=>  $perihal,
								'subyek' 		=>  $subyek,
								'ringkasan' 	=>  '',
								'ringkasan2' 	=>  $isisrt,
								'lampiran' 		=>  $lampiran,
								'scansurat' 	=>  $namafile,
								'sifat' 		=>  $sifat,
								'bentuk' 		=>  $bentuk,
								'klasifikasi' 	=>  $klasif,
								'pembuat' 		=>  Session('email'),
								'status' 		=>  '',
								'disposisi' 	=>  '',
								'arsip' 		=>  '',
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',
								'faskode' 		=>  $kodearsip,
								'fasmasa' 		=>  '',
								'fasket' 		=>  '',
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'fakultas' 		=>  $fakultas,
							]);
							$getidne = Suratmasuk::where('marking', $marking)->first();
							$idsurat = $getidne->id;
							if ($kerjanya){
								$mkelompok = 'Sekretariat '.Session('fakpanjang');
								Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->delete();
								foreach ( $kepada as $tujuan ){
									$tujuanne 	= $tujuan->id;
									$faktujuan	= $fakultas;
									$getemail 	= Pejabatsurat::where('pejabat', $tujuanne)->first();
									if (isset($getemail->id)){
										$email 		= $getemail->email;
										$faktujuan 	= $getemail->fakultas;
									} else { $email = $tujuanne; }
									if ($faktujuan == 'DPM' AND Session('previlage') != 'administrasi'){
										$getemail 	= User::where('email', '!=', '')->where('previlage', 'administrasi')->where('fakultas', $faktujuan)->first();
										if (isset($getemail->email)){
											SendMail::kiriminbox($marking,Session('nama'),$mkelompok,$getemail->email,'MASUK','PEMERIKSAAN','','1');
										} else {
											SendMail::kiriminbox($marking,Session('nama'),$mkelompok,$email,'MASUK','PEMERIKSAAN','','1');
										}
									} else {
										SendMail::kiriminbox($marking,$mkelompok,$tujuanne,$email,'MASUK','DISPOSISI','','1');
									}
								}
								$arrnosurat	= explode("/", $nosurat);
								$nosurat	= $nosurat[0];
								$pesan		= 'Surat Dari '.$asalsrt.' Dengan Nomor '.$nosurat.' Sukses di Input, dengan Tracking ID : <a href="'.$homebase.'/trackingid/srtmsk-'.$marking.'"  target="_blank">'.$homebase.'/trackingid/srtmsk-'.$marking.'</a>';
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
								return back();
							}else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
								return back();
							}
						}
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Upload Scan Surat Anda']);
					return back();
				}
			} else {
				if ($request->hasFile('file')) {
					$validator = Validator::make($request->all(), [
						'file' =>  'mimes:pdf,PDF|max:2000000'
					]);
					$yy 			= substr($tglmasuk, 0, 4);
					$mm 			= substr($tglmasuk, 5, 2);
					$dd 			= substr($tglmasuk, 8, 2);
					$nomerganda 	= '';
					if ($nosurat == ''){ $nosurat = '-'; }
					if ($nosurat != '-'){
						$ceknomersrt 	= Suratmasuk::where('nosurat', $nosurat)->where('perihal', $perihal)->where('id', '!=', $surid)->count();
						$ceknoagenda	= Suratmasuk::where('id', '!=', $surid)->where('noagenda', $noagenda)->where('yersrt', $yy)->where('fakultas', $fakultas)->count();
						if ($ceknoagenda != 0){
							$nomerganda = 'Detected';
						}
					}
						
					if ($nomerganda != ''){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No. Surat '.$nosurat.' Telah Masuk Dalam Daftar Sebelumnya']);
						return back();
					} else if ($validator->fails()) {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No. Surat '.$nosurat.' File Format Harus PDF dan tidak melebihi dari 20mb.']);
						return back();
					} else if ($isisrt == ''){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Ringkasan tidak boleh kosong']);
						return back();
					} else {
						$jceksrtmsk		= Suratmasuk::where('id', $surid)->first();
						$markinglawas	= $jceksrtmsk->marking;
						$kepadalawas	= $jceksrtmsk->kepada;
						$lampiranlawas	= $jceksrtmsk->scansurat;
						if ($lampiranlawas != ''){
							if (File::exists(base_path() ."/public/scan/files/". $lampiranlawas)) {
							  File::delete(base_path() ."/public/scan/files/". $lampiranlawas);
							}
						}
						$namafile		= $markinglawas.'.'.$request->file->getClientOriginalExtension();
						$uploadedFile 	= $request->file('file');
						$uploadedFile->move(public_path('scan/files'), $namafile);
						if ($fakultas == 'KP'){
							$tlskepada 	= '';
							
						} else {
							$arrkpd	= explode("-", $kepadalawas);
							foreach ( $arrkpd as $tujuan ) {
								Inboxsurat::where('marking', $markinglawas)->where('penerima', $tujuan)->where('jenis', 'MASUK')->delete();
							}
							$tlskepada 		= '';
							foreach ( $kepada as $tujuan ){
								$tujuanbaru 	= $tujuan->id;
								if ($tujuanbaru != ''){
									if ($tlskepada == ''){
										$tlskepada = $tujuanbaru;
									} else { $tlskepada = $tlskepada.'-'.$tujuanbaru; }
									$getemail 	= Pejabatsurat::where('fakultas', Session('fakultas'))->where('pejabat', $tujuanbaru)->first();
									if (isset($getemail->id)){
										$email 	= $getemail->email;
									} else { $email = $tujuanbaru; }
									SendMail::kiriminbox($markinglawas,$mkelompok,$tujuanbaru,$email,'MASUK','DISPOSISI','','1');
									
								}
							}
						}
						$kerjanya = Suratmasuk::where('id', $surid)->update([
							'noagenda' 		=>  $noagenda,
							'tglmasuk' 		=>  $tglmasuk,
							'tglsurat' 		=>  $tglsurat,
							'jenissurat' 	=>  $jenissrt,
							'nosurat' 		=>  $nosurat,
							'asalsurat' 	=>  $asalsrt,
							'kepada' 		=>  $tlskepada,
							'perihal' 		=>  $perihal,
							'ringkasan' 	=>  $isisrt,
							'ringkasan2' 	=>  $isisrt,
							'lampiran' 		=>  $lampiran,
							'sifat' 		=>  $sifat,
							'bentuk' 		=>  $bentuk,
							'scansurat' 	=>  $namafile,
							'klasifikasi' 	=>  $klasif,
							'faskode' 		=>  $kodearsip,
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat Dari '.$asalsrt.' Dengan Nomor '.$nosurat.' Sukses di Update']);
						return back();
					}
				} else {
					if ($isisrt == ''){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Ringkasan tidak boleh kosong']);
						return back();
					}else {
						$jceksrtmsk		= Suratmasuk::where('id', $surid)->first();
						$markinglawas	= $jceksrtmsk->marking;
						$kepadalawas	= $jceksrtmsk->kepada;
						$arrkpd			= explode("-", $kepadalawas);
						if ($fakultas == 'KP'){
							$tlskepada = '';
							foreach ( $arrkpd as $tujuan )
							{
								if ($tlskepada == '') {$tlskepada = $tujuan;}
								else {$tlskepada = $tlskepada.'-'.$tujuan; }
							}
							$tujuanbaru = 'Kepala Subdivisi Tata Usaha dan Protokol';
							$getemail 	= Pejabatsurat::where('fakultas', Session('fakultas'))->where('pejabat', $tujuanbaru)->first();
							if (isset($getemail->id)){
								$email 	= $getemail->email;
							} else { $email = $tujuanbaru; }
							SendMail::kiriminbox($markinglawas,$mkelompok,$tujuanbaru,$email,'PEMERIKSAAN','PEMERIKSAAN',$tlskepada,'1');
							
						} else {
							Inboxsurat::where('marking', $markinglawas)->where('jenis', 'MASUK')->delete();
							$tlskepada 		= '';
							$mkelompok 		= 'Sekretariat '.Session('fakpanjang');
							foreach ( $kepada as $tujuan ){
								$tujuanbaru 	= $tujuan->id;
								$faktujuan		= $fakultas;
								if ($tujuanbaru != ''){
									if ($tlskepada == ''){
										$tlskepada = $tujuanbaru;
									} else { $tlskepada = $tlskepada.'-'.$tujuanbaru; }
									$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $tujuanbaru)->first();
									if (isset($getemail->id)){
										$email 	= $getemail->email;
										$faktujuan 	= $getemail->fakultas;
									} else { $email = $tujuanbaru; }
									if ($faktujuan == 'DPM' AND Session('previlage') != 'administrasi'){
										$getemail 	= User::where('email', '!=', '')->where('previlage', 'administrasi')->where('fakultas', $faktujuan)->first();
										if (isset($getemail->email)){
											SendMail::kiriminbox($markinglawas,Session('nama'),$mkelompok,$getemail->email,'MASUK','PEMERIKSAAN','','1');
										} else {
											SendMail::kiriminbox($markinglawas,Session('nama'),$mkelompok,$email,'MASUK','PEMERIKSAAN','','1');
										}
									} else {
										SendMail::kiriminbox($markinglawas,$mkelompok,$tujuanbaru,$email,'MASUK','DISPOSISI','','1');
									}
								}
							}
						}
						$kerjanya = Suratmasuk::where('id', $surid)->update([
							'noagenda' 		=>  $noagenda,
							'tglmasuk' 		=>  $tglmasuk,
							'tglsurat' 		=>  $tglsurat,
							'jenissurat' 	=>  $jenissrt,
							'nosurat' 		=>  $nosurat,
							'asalsurat' 	=>  $asalsrt,
							'kepada' 		=>  $tlskepada,
							'perihal' 		=>  $perihal,
							'ringkasan' 	=>  $isisrt,
							'lampiran' 		=>  $lampiran,
							'sifat' 		=>  $sifat,
							'bentuk' 		=>  $bentuk,
							'klasifikasi' 	=>  $klasif,
							'faskode' 		=>  $kodearsip,
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat Dari '.$asalsrt.' Dengan Nomor '.$nosurat.' Sukses di Update']);
						return back();
					}
				}
			}
		}
    }
	public function detailPenerimasurat(Request $request) {
		$arraypenerimasurat = [];
		$idsurat 			= $request->input('val01');
		$jenissurat 		= $request->input('val02');
		$kelompok 			= $request->input('val03');
		if ($jenissurat == 'SK'){
			$jpenerima		= Penerimasurat::where('idsurat', $idsurat)->where('jenis', 'SK')->orderBy('id', 'ASC')->get();
		} else if ($jenissurat == 'SKDANPERATURAN'){
			$jpenerima		= Penerimasurat::where('idsurat', $idsurat)->where('jenis', 'SKDANPERATURAN')->orderBy('id', 'ASC')->get();
		} else {
			if ($kelompok == 'SKDANPERATURAN'){
				$jpenerima	= Penerimasurat::where('idsurat', $idsurat)->where('keterangan', 'SKDANPERATURAN')->orderBy('id', 'ASC')->get();
			} else {
				$jpenerima	= Penerimasurat::where('idsurat', $idsurat)->orderBy('id', 'ASC')->get();
			}
		}
		if (!empty($jpenerima)){
			foreach ($jpenerima as $result) {
				$idpegawai 		= $result->idpegawai;
				$pengikut		= Simsppdpengikut::where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
				$cekdatane		= Simsppdbiayaperjalanan::where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
				if ($cekdatane != 0){
					$getnominal 	= Simsppdbiayaperjalanan::select(DB::raw("SUM(usulan) as jumlah"))->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->groupBy('idsurat')->first();
					$nominalusulan	= $getnominal->jumlah;
				}else {
					$nominalusulan	= 0;
				}
				$arraypenerimasurat[] = array(
					'idne' 				=> $result->id,
					'idsurat' 			=> $idsurat,
					'idpegawai' 		=> $idpegawai,
					'pejabat' 			=> $result->nama,
					'jabatan' 			=> $result->jabatan,
					'fakultas' 			=> $result->penulisan,
					'keterangan'		=> $result->keterangan,
					'statusremunerasi'	=> $result->statusremunerasi,
					'bulanstart'		=> $result->bulanstart,
					'tahunstart'		=> $result->tahunstart,
					'bulanend'			=> $result->bulanend,
					'tahunend'			=> $result->tahunend,
					'penulisanbulan'	=> $result->penulisanbulan,
					'created_unit'		=> $result->fakultas,
					'created_by'		=> $result->created_by,
					'updated_by'		=> $result->updated_by,
					'status'			=> $result->status.' On '.$result->updated_at,
					'pengikut' 			=> $pengikut,
					'biaya' 			=> $nominalusulan,
				);
			}
			echo json_encode($arraypenerimasurat);
		}
    }
	public function extbhPenerimasurat(Request $request) {
		$homebase			= url("/");
		$idsurat			= $request->input('set01');
		$idpegawai			= $request->input('set02');
		$isundangan			= $request->input('set03');
		$kelompok			= $request->input('set10');
		$nama				= '';
		$jabatan			= '';
		$penulisan			= '';
		$marking			= '';
		$jenissrt			= '';
		$jenissk 			= '';
		$nosurat			= '';
		$asalsrt			= '';
		$perihal			= '';
		$tglsurat			= date('Y-m-d');
		$alamat 			= Session('fakpanjang');
		$update				= null;
		if ($request->input('set10') == 'KELUAR'){
			$ceksuratkeluar = Suratkeluar::where('id', $idsurat)->first();
			if (isset($ceksuratkeluar->id)){
				$marking		= $ceksuratkeluar->marking;
				$tglsurat		= $ceksuratkeluar->tglsurat;
				$jenissrt		= $ceksuratkeluar->jenissrt;
				$nosurat		= $ceksuratkeluar->nomor.'/'.$ceksuratkeluar->kodefak.'/'.$ceksuratkeluar->yersrt;
				$asalsrt		= $ceksuratkeluar->pejabat;
				$perihal		= $ceksuratkeluar->perihal;
				$generatesurat 	= '<iframe src="'.$homebase.'/trackingid/srtklr-'.$ceksuratkeluar->marking.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
				$alamatsurat	= $homebase.'/trackingid/srtklr-'.$ceksuratkeluar->marking;
				$getpegawai 	= Simpegpegawai::where('id', $idpegawai)->first();
				if (isset($getpegawai->id)){
					$email 			= $getpegawai->email;
					$emailub 		= $getpegawai->email_ub;
					$ppabp 			= $getpegawai->ppabp;
					$jabatan 		= $getpegawai->jabatan;
					if (is_null($email) OR $email == ''){
						$email 		= $emailub;
					}
					if ($isundangan == 'Ya'){
						$ceksudah = WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $idsurat)->count();
						if ($ceksudah == 0){
							$input = WebinarEventlist::create([
								'nama'			=> $request->input('set04'),
								'tempat'		=> Session('fakpanjang'), 
								'kapasitas'		=> 0, 
								'tanggal'		=> $request->input('set05'),
								'mulai'			=> $request->input('set05').' '.$request->input('set06'), 
								'akhir'			=> $request->input('set07').' '.$request->input('set08'),
								'bayar'			=> 0,
								'kontak'		=> $idsurat,
								'pembicara'		=> 'UNDANGANDIGITAL', 
								'daftarmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'daftarakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'absenmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'absenakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'created_by'	=> Session('email'), 
								'linkwebniar'	=> $homebase.'/viewsurat/keluar-'.$idsurat,
								'linkmateri'	=> '',
								'fakultas'		=> Session('fakultas')
							]);
							$idkegiatan = $input->id;
						} else {
							$input = WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $idsurat)->update([
								'nama'			=> $request->input('set04'),
								'tanggal'		=> $request->input('set05'),
								'mulai'			=> $request->input('set05').' '.$request->input('set06'), 
								'akhir'			=> $request->input('set07').' '.$request->input('set08'),
								'daftarmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'daftarakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'absenmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'absenakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'created_by'	=> Session('email'), 
								'linkwebniar'	=> $homebase.'/viewsurat/keluar-'.$idsurat,
								'updated_at'	=> date("Y-m-d H:i:s")
							]);
							$getkegid 	= WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $idsurat)->first();
							$idkegiatan	= $getkegid->id;
						}
						if ($input){
							$ceksudah 		= Penerimasurat::where('jenis', $kelompok)->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
							if ($ceksudah == 0){
								Penerimasurat::insert([
									'asalsurat' => $alamat, 
									'perihal' 	=> $request->input('set04'), 
									'idsurat' 	=> $idsurat, 
									'jenis'		=> $kelompok, 
									'keterangan'=> 'Undangan Elektronik',
									'idpegawai'	=> $idpegawai, 
									'nama'		=> $getpegawai->nama_lengkap, 
									'jabatan'	=> $getpegawai->jabatan, 
									'penulisan'	=> $email, 
									'tabel'		=> $generatesurat,
									'status'	=> 'SEND',
									'fakultas'	=> Session('fakultas'),
									'created_by'=> Session('nama'),
									'updated_by'=> Session('nama'),
								]);
							}
							$ceksudahterjadwal = Jadwal::where('peminjam', $email)->where('inputor', $idkegiatan)->count();
							if ($ceksudahterjadwal == 0){
								$update = Jadwal::create([
									'jenisjadwal'      	=>  '0',
									'ruang'         	=>  '',
									'gedung'         	=>  '',
									'tglmulai'    		=>  $request->input('set05'),
									'jammulai'    		=>  $request->input('set06'),
									'tglakhir'    		=>  $request->input('set07'),
									'jamakhir'    		=>  $request->input('set08'),
									'mulai'    			=>  $request->input('set05').' '.$request->input('set06'),
									'akhir'     		=>  $request->input('set07').' '.$request->input('set08'),
									'peminjam'      	=>  $email,
									'keterangan'     	=>  'Undangan Elektronik',
									'keperluan'			=>  $request->input('set04').'<br /><a href="'.$homebase.'/viewsurat/keluar-'.$idsurat.'" target="_blank">Download Undangan</a>',
									'suratpermohonan'	=>  $idsurat,
									'inputor' 			=>  $idkegiatan,
									'biaya' 			=>  0,
									'fakultas'			=> 	Session('fakultas'),
									'fakpanjang'		=> 	Session('fakpanjang')
								]);
							} else {
								$update = Jadwal::where('peminjam', $email)->where('inputor', $idkegiatan)->update([
									'mulai'    			=>  $request->input('set05').' '.$request->input('set06'),
									'akhir'     		=>  $request->input('set07').' '.$request->input('set08'),
									'peminjam'      	=>  $email,
									'keperluan'			=>  $request->input('set04').'<br /><a href="'.$homebase.'/viewsurat/keluar-'.$idsurat.'" target="_blank">Download Undangan</a>',
									'suratpermohonan'	=>  $idsurat,
									'inputor' 			=>  $idkegiatan,
									'updated_at'		=> 	date('Y-m-d H:i:s')
								]);
							}
							if ($update){
								$cekemail 	= explode('@', $email);
								if (isset($cekemail[1])){
									$subject    = $request->input('set04');
									$note       = 'Berikut Kami Kirimkan Surat Undangan '.$request->input('set04').' Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$homebase.'/viewsurat/keluar-'.$idsurat.'" target="_blank">DOWNLOAD SURAT</a></div></p>';
									SendMail::notif($getpegawai->nama_lengkap, $email, $subject, $note);
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Gagal Input Penerima Silahkan Ulangi Beberapa Saat Lagi']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Gagal Input Kegiatan Silahkan Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						$cekpejabat 	= Pejabatsurat::where('email', $email)->first();
						if (isset($cekpejabat->id)){
							$ppabptujuan= $cekpejabat->fakultas;
							$tujuan		= $cekpejabat->pejabat;
							$pejabat 	= 'YES';
						} else { $pejabat = 'NO'; $ppabptujuan = ''; }
						if ($pejabat == 'YES' AND $ppabptujuan != Session('fakultas') AND $marking != ''){
							$ceksudah 		= Suratmasuk::where('marking', Session('fakultas').'-'.$marking)->count();
							if ($ceksudah == 0){
								$getnoagenda = Suratmasuk::where('fakultas', Session('fakultas'))->where('yersrt', date('Y'))->orderBy('noagenda', 'DESC')->first();
								if (isset($getnoagenda->id)){
									$noagenda = $getnoagenda->noagenda;
									$noagenda++;
								} else {
									$noagenda = 1;
								}
								$kerjanya = Suratmasuk::insert([
									'marking' 		=>  Session('fakultas').'-'.$marking,
									'noagenda' 		=>  $noagenda,
									'tglmasuk' 		=>  date('Y-m-d'),
									'tglsurat' 		=>  $tglsurat,
									'daysrt' 		=>  date('d'),
									'monsrt' 		=>  date('m'),
									'yersrt' 		=>  date('Y'),
									'jenissurat' 	=>  $jenissrt,
									'nosurat' 		=>  $nosurat,
									'asalsurat' 	=>  $asalsrt,
									'kepada' 		=>  $tujuan,
									'perihal' 		=>  $perihal,
									'subyek' 		=>  'AUTO',
									'ringkasan' 	=>  $marking,
									'ringkasan2' 	=>  $perihal,
									'lampiran' 		=>  '-',
									'scansurat' 	=>  Session('fakultas').'-'.$marking.'.pdf',
									'sifat' 		=>  '4',
									'bentuk' 		=>  'Surat Elektronik',
									'klasifikasi' 	=>  'Biasa',
									'pembuat' 		=>  Session('email'),
									'status' 		=>  '',
									'disposisi' 	=>  '',
									'arsip' 		=>  '',
									'ruangarsip' 	=>  '',
									'ordnerarsip' 	=>  '',
									'lemariarsip' 	=>  '',
									'faskode' 		=>  'TU.00.1',
									'fasmasa' 		=>  '',
									'fasket' 		=>  '',
									'subkode' 		=>  '',
									'submasa' 		=>  '',
									'subket' 		=>  '',
									'fakultas' 		=>  Session('fakultas'),
								]);
								if ($kerjanya){
									$ceksudah 		= Penerimasurat::where('jenis', $kelompok)->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
									if ($ceksudah == 0){
										$update 		= Penerimasurat::insert([
											'asalsurat' => $alamat, 
											'perihal' 	=> $ceksuratkeluar->perihal, 
											'idsurat' 	=> $idsurat, 
											'jenis'		=> $kelompok, 
											'keterangan'=> '',
											'idpegawai'	=> $idpegawai, 
											'nama'		=> $getpegawai->nama_lengkap, 
											'jabatan'	=> $getpegawai->jabatan, 
											'penulisan'	=> $email, 
											'tabel'		=> $generatesurat,
											'status'	=> 'Disposisi',
											'fakultas'	=> Session('fakultas'),
											'created_by'=> Session('nama'),
											'updated_by'=> Session('nama'),
										]);
									}
									$ceksudahinbox 		= Inboxsurat::where('marking', $marking)->where('email', $email)->count();
									if ($ceksudahinbox == 0){
										SendMail::kiriminbox(Session('fakultas').'-'.$marking,Session('nama'),$getpegawai->nama_lengkap,$email,'MASUK','DISPOSISI','','1');
									}
									return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
									return back();
								} else {
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Input Surat Masuk, Silahkan Ulangi Beberapa Saat Lagi']);
									return back();
								}
							} else {
								$ceksudah 		= Penerimasurat::where('jenis', $kelompok)->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
								if ($ceksudah == 0){
									$update 		= Penerimasurat::insert([
										'asalsurat' => $alamat, 
										'perihal' 	=> $ceksuratkeluar->perihal, 
										'idsurat' 	=> $idsurat, 
										'jenis'		=> $kelompok, 
										'keterangan'=> '',
										'idpegawai'	=> $idpegawai, 
										'nama'		=> $getpegawai->nama_lengkap, 
										'jabatan'	=> $getpegawai->jabatan, 
										'penulisan'	=> $email, 
										'tabel'		=> $generatesurat,
										'status'	=> 'DISPOSISI',
										'fakultas'	=> Session('fakultas'),
										'created_by'=> Session('nama'),
										'updated_by'=> Session('nama'),
									]);
								}
								$ceksudahinbox 		= Inboxsurat::where('marking', $marking)->where('email', $email)->count();
								if ($ceksudahinbox == 0){
									SendMail::kiriminbox(Session('fakultas').'-'.$marking,Session('nama'),$getpegawai->nama_lengkap,$email,'MASUK','DISPOSISI','','1');
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
								return back();
							}
						} else {
							$ceksudah 		= Penerimasurat::where('jenis', $kelompok)->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
							if ($ceksudah == 0){
								$update 		= Penerimasurat::insert([
									'asalsurat' => $alamat, 
									'perihal' 	=> $ceksuratkeluar->perihal, 
									'idsurat' 	=> $idsurat, 
									'jenis'		=> $kelompok, 
									'keterangan'=> '',
									'idpegawai'	=> $idpegawai, 
									'nama'		=> $getpegawai->nama_lengkap, 
									'jabatan'	=> $getpegawai->jabatan, 
									'penulisan'	=> $email, 
									'tabel'		=> $generatesurat,
									'status'	=> 'SEND',
									'fakultas'	=> Session('fakultas'),
									'created_by'=> Session('nama'),
									'updated_by'=> Session('nama'),
								]);
								if ($update){
									$note		= 'Sending To Apps but failed to email';
									$cekemail 	= explode('@', $email);
									if (isset($cekemail[1])){
										$subject    = $ceksuratkeluar->perihal;
										$note       = 'Berikut Kami Kirimkan Surat '.$ceksuratkeluar->jenissrt.' Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$homebase.'/viewsurat/keluar-'.$ceksuratkeluar->id.'" target="_blank">DOWNLOAD SURAT</a></div></p>';
										SendMail::notif($getpegawai->nama_lengkap, $email, $subject, $note);
									}
									return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $note]);
									return back();
								} else {
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Kirim Ke Inbox Pribadi Penerima, Silahkan Ulangi Beberapa Saat Lagi']);
									return back();
								}
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data Sudah Ada']);
								return back();
							}
						}
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Pegawai '.$idpegawai.' Tidak Valid']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Surat '.$idsurat.' Tidak Valid']);
				return back();
			}
		} else {
			if ($request->input('set02') == 'HAPUS'){
				if ($request->input('set03') == 'SAYA YAKIN'){
					$getdata 	= Penerimasurat::where('id', $idsurat)->first();
					$keterangan = $getdata->keterangan;
					$email 		= $getdata->penulisan;
					$hapus 		= Penerimasurat::where('id', $idsurat)->delete();
					if ($hapus){
						if ($keterangan == 'Undangan Elektronik'){
							Jadwal::where('peminjam', $email)->where('suratpermohonan', $getdata->idsurat)->delete();
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Hapus Data Penerima Sukses']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Ulangi Beberapa Saat Lagi']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sepertinya anda kurang yakin.!']);
					return back();
				}
			} else {
				if ($request->input('set02') == 'SKDANPERATURAN' OR $kelompok == 'SKDANPERATURAN'){
					$ceksuratkeluar = Tabelskdanperaturan::where('id', $idsurat)->first();
					if (isset($ceksuratkeluar->id)){
						$marking		= $ceksuratkeluar->marking;
						$tglsurat		= $ceksuratkeluar->tanggal;
						$jenissrt		= $ceksuratkeluar->kelompok;
						$nosurat		= $ceksuratkeluar->nomor.' TAHUN '.$ceksuratkeluar->tahun;
						$asalsrt		= $ceksuratkeluar->penandatangan;
						$perihal		= $ceksuratkeluar->judul;
						$alamatsurat	= $homebase.'/trackingid/srtklr-'.$ceksuratkeluar->marking;
						if ($ceksuratkeluar->kelompok == 'Pengangkatan Jabatan'){
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
							$arrisine 	= explode('[psh]', $ceksuratkeluar->scansurat);
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
							$nama_lengkap 	= $setval01;
							$jabatan 		= $setval02;
							$ppabp 			= $setval03;
							$sifat 			= $setval04;
							$kepdir_nomor 	= $setval05;
							$tmt 			= $setval06;
							$mulai 			= $setval07;
							$akhir 			= $setval08;
							$tanggal 		= $setval09;
							$idpeg 			= $setval10;
							if ($akhir == '' OR $akhir == $mulai OR is_null($akhir) OR $akhir == '0000-00-00'){
								$periode	= 'Definitif';
							} else {
								$periode 	= $mulai.' s/d '.$akhir;
							}
							$keputusandirektur_jenis = $setval01;
							$getpegawai		= Simpegpegawai::where('id', $idpeg)->first();
							if (isset($getpegawai->id)){
								$input 		= Detailidentitas::create([
									'no'		=> $idpeg,
									'aktif'		=> $tmt,
									'jenisid'	=> $ceksuratkeluar->kelompok,
									'nomer'		=> $ceksuratkeluar->nomor.' Tahun '.$ceksuratkeluar->tahun,
									'bukti'		=> '/viewsurat/SKPP-'.$ceksuratkeluar->id,
									'timestamp'	=> date("Y-m-d H:i:s")
								]);
								Simpegpegawai::where('id', $idpeg)->update([
									'nama_lengkap' 		=> $nama_lengkap,
									'jabatan' 			=> $jabatan,
									'ppabp' 			=> $ppabp,
									'tmt_jabatan' 		=> $tmt,
								]);
								Pejabatsurat::where('pejabat', $jabatan)->update([
									'nama'			=> $nama_lengkap,
									'nip'			=> $getpegawai->nip_baru,
									'email'			=> $getpegawai->email_ub,
									'nik'			=> $getpegawai->nik,
									'npwp'			=> $getpegawai->npwp,
									'nohape'		=> $getpegawai->no_hp,
									'penandatangan' => $ceksuratkeluar->penandatangan,
									'nomersk' 		=> $ceksuratkeluar->nomor,
									'tglsk' 		=> $ceksuratkeluar->tanggal,
									'periode' 		=> $periode,
									'awalberlaku' 	=> $mulai,
									'akhirberlaku' 	=> $akhir,
									'tglpelantikan'	=> $tanggal,
									'keterangan' 	=> $sifat,
								]);
								$cekfakultas = User::where('fakpanjang', $ppabp)->first();
								if (isset($cekfakultas->fakultas)){
									User::where('email', $getpegawai->email)->update([
										'fakultas'		=> $cekfakultas->fakultas,
										'fakpanjang'	=> $cekfakultas->fakpanjang,
										'nama'			=> $nama_lengkap,
										'previlage'		=> $jabatan
									]);
								}
							}
						} else if ($ceksuratkeluar->kelompok == 'Mutasi'){
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
							$arrisine 	= explode('[psh]', $ceksuratkeluar->scansurat);
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
							$nama_lengkap 	= $setval01;
							$jabatan 		= $setval02;
							$ppabp 			= $setval03;
							$ppabptujuan 	= $setval04;
							$kepdir_nomor 	= $setval05;
							$tmt 			= $setval06;
							$tanggal 		= $setval07;
							$idpeg 			= $setval08;
							$getpegawai		= Simpegpegawai::where('id', $idpeg)->first();
							if (isset($getpegawai->id)){
								$input 		= Detailidentitas::create([
									'no'		=> $idpeg,
									'aktif'		=> $tmt,
									'jenisid'	=> $ceksuratkeluar->kelompok,
									'nomer'		=> $ceksuratkeluar->nomor.' Tahun '.$ceksuratkeluar->tahun,
									'bukti'		=> '/viewsurat/SKPP-'.$ceksuratkeluar->id,
									'timestamp'	=> date("Y-m-d H:i:s")
								]);
								Simpegpegawai::where('id', $idpeg)->update([
									'nama_lengkap' 		=> $nama_lengkap,
									'jabatan' 			=> $jabatan,
									'ppabp' 			=> $ppabptujuan,
									'tmt_jabatan' 		=> $tmt,
								]);
								$cekfakultas = User::where('fakpanjang', $ppabptujuan)->first();
								if (isset($cekfakultas->fakultas)){
									User::where('email', $getpegawai->email)->update([
										'fakultas'		=> $cekfakultas->fakultas,
										'fakpanjang'	=> $cekfakultas->fakpanjang,
										'nama'			=> $nama_lengkap,
										'previlage'		=> $jabatan
									]);
								}
							}
						} else if ($ceksuratkeluar->kelompok == 'Pemberhentian Jabatan'){
							$setval01	= '';
							$setval02	= '';
							$setval03	= '';
							$setval04	= '';
							$setval05	= '';
							$setval06	= '';
							$setval07	= '';
							$setval08	= '';
							$arrisine 	= explode('[psh]', $ceksuratkeluar->scansurat);
							if(isset($arrisine[0])){ $setval01 = $arrisine[0]; }
							if(isset($arrisine[1])){ $setval02 = $arrisine[1]; }
							if(isset($arrisine[2])){ $setval03 = $arrisine[2]; }
							if(isset($arrisine[3])){ $setval04 = $arrisine[3]; }
							if(isset($arrisine[4])){ $setval05 = $arrisine[4]; }
							if(isset($arrisine[5])){ $setval06 = $arrisine[5]; }
							if(isset($arrisine[6])){ $setval07 = $arrisine[6]; }
							if(isset($arrisine[7])){ $setval08 = $arrisine[7]; }
							if(isset($arrisine[8])){ $setval09 = $arrisine[8]; }
							$nama_lengkap 				= $setval01;
							$jabatan 					= $setval02;
							$ppabp 						= $setval03;
							$kepdir_nomor 				= $setval04;
							$tmt 						= $setval05;
							$tanggal 					= $setval06;
							$idpeg 						= $setval07;
							$keputusandirektur_jenis 	= $setval08;
							$getpegawai					= Simpegpegawai::where('id', $idpeg)->first();
							if (isset($getpegawai->id)){
								$input 		= Detailidentitas::create([
									'no'		=> $idpeg,
									'aktif'		=> $tmt,
									'jenisid'	=> $ceksuratkeluar->kelompok,
									'nomer'		=> $ceksuratkeluar->nomor.' Tahun '.$ceksuratkeluar->tahun,
									'bukti'		=> '/viewsurat/SKPP-'.$ceksuratkeluar->id,
									'timestamp'	=> date("Y-m-d H:i:s")
								]);
								Simpegpegawai::where('id', $idpeg)->update([
									'nama_lengkap' 		=> $nama_lengkap,
									'jabatan' 			=> 'Staf',
									'tmt_jabatan' 		=> $tmt,
								]);
								$cekfakultas = User::where('fakpanjang', $ppabptujuan)->first();
								if (isset($cekfakultas->fakultas)){
									User::where('email', $getpegawai->email)->update([
										'fakultas'		=> $cekfakultas->fakultas,
										'fakpanjang'	=> $cekfakultas->fakpanjang,
										'nama'			=> $nama_lengkap,
										'previlage'		=> 'Staf'
									]);
								}
								$cekdatajabatan 	= Pejabatsurat::where('pejabat', $jabatan)->first();
								if (isset($cekdatajabatan->pejabat)){
									if ($cekdatajabatan->nip == $getpegawai->nip_baru){
										Pejabatsurat::where('pejabat', $jabatan)->update([
											'nama'			=> '',
											'nip'			=> '',
											'email'			=> '',
											'nik'			=> '',
											'npwp'			=> '',
											'nohape'		=> '',
										]);
									}
								}
							}
							
							
						} else if ($ceksuratkeluar->kelompok == 'Pegawai Tetap' OR $ceksuratkeluar->kelompok == 'Dokter Tetap'){
							$setval01	= '';
							$setval02	= '';
							$setval03	= '';
							$setval04	= '';
							$setval05	= '';
							$setval06	= '';
							$setval07	= '';
							$setval08	= '';
							$arrisine 	= explode('[psh]', $ceksuratkeluar->scansurat);
							if(isset($arrisine[0])){ $setval01 = $arrisine[0]; }
							if(isset($arrisine[1])){ $setval02 = $arrisine[1]; }
							if(isset($arrisine[2])){ $setval03 = $arrisine[2]; }
							if(isset($arrisine[3])){ $setval04 = $arrisine[3]; }
							if(isset($arrisine[4])){ $setval05 = $arrisine[4]; }
							if(isset($arrisine[5])){ $setval06 = $arrisine[5]; }
							if(isset($arrisine[6])){ $setval07 = $arrisine[6]; }
							if(isset($arrisine[7])){ $setval08 = $arrisine[7]; }
							if(isset($arrisine[8])){ $setval09 = $arrisine[8]; }
							$nama_lengkap 				= $setval01;
							$jabatan 					= $setval02;
							$ppabp 						= $setval03;
							$kepdir_nomor 				= $setval04;
							$tmt 						= $setval05;
							$tanggal 					= $setval06;
							$idpeg 						= $setval07;
							$keputusandirektur_jenis 	= $setval08;
							$getpegawai					= Simpegpegawai::where('id', $idpeg)->first();
							if (isset($getpegawai->id)){
								$input 		= Detailidentitas::create([
									'no'		=> $idpeg,
									'aktif'		=> $tmt,
									'jenisid'	=> $ceksuratkeluar->kelompok,
									'nomer'		=> $ceksuratkeluar->nomor.' Tahun '.$ceksuratkeluar->tahun,
									'bukti'		=> '/viewsurat/SKPP-'.$ceksuratkeluar->id,
									'timestamp'	=> date("Y-m-d H:i:s")
								]);
							}
						} else {
							$setval01	= '';
							$setval02	= '';
							$setval03	= '';
							$setval04	= '';
							$setval05	= '';
							$setval06	= '';
							$setval07	= '';
							$setval08	= '';
							$arrisine 	= explode('[psh]', $ceksuratkeluar->scansurat);
							if(isset($arrisine[0])){ $setval01 = $arrisine[0]; }
							if(isset($arrisine[1])){ $setval02 = $arrisine[1]; }
							if(isset($arrisine[2])){ $setval03 = $arrisine[2]; }
							if(isset($arrisine[3])){ $setval04 = $arrisine[3]; }
							if(isset($arrisine[4])){ $setval05 = $arrisine[4]; }
							if(isset($arrisine[5])){ $setval06 = $arrisine[5]; }
							if(isset($arrisine[6])){ $setval07 = $arrisine[6]; }
							if(isset($arrisine[7])){ $setval08 = $arrisine[7]; }
							if(isset($arrisine[8])){ $setval09 = $arrisine[8]; }
							$nama_lengkap 				= $setval01;
							$jabatan 					= $setval02;
							$ppabp 						= $setval03;
							$kepdir_nomor 				= $setval04;
							$tmt 						= $setval05;
							$tanggal 					= $setval06;
							$status_jabatan 			= $setval07;
							$idpeg 						= $setval08;
							$keputusandirektur_jenis 	= $setval09;
							$getpegawai					= Simpegpegawai::where('id', $idpeg)->first();
							if (isset($getpegawai->id)){
								$input 		= Detailidentitas::create([
									'no'		=> $idpeg,
									'aktif'		=> $tmt,
									'jenisid'	=> $ceksuratkeluar->kelompok,
									'nomer'		=> $ceksuratkeluar->nomor.' Tahun '.$ceksuratkeluar->tahun,
									'bukti'		=> '/viewsurat/SKPP-'.$ceksuratkeluar->id,
									'timestamp'	=> date("Y-m-d H:i:s")
								]);
							}
						}
					} else {
						$alamatsurat = $homebase.'/viewsurat/SKPP-'.$idsurat;
					}
					$generatesurat 	= '<iframe src="'.$alamatsurat.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
				} else {
					$ceksuratkeluar = Suratkeluar::where('id', $idsurat)->first();
					if (isset($ceksuratkeluar->id)){
						$alamatsurat 	= $homebase.'/trackingid/srtklr-'.$ceksuratkeluar->marking;
						$marking		= $ceksuratkeluar->marking;
						$tglsurat		= $ceksuratkeluar->tglsurat;
						$jenissrt		= $ceksuratkeluar->jenissrt;
						$nosurat		= $ceksuratkeluar->nomor.'/'.$ceksuratkeluar->kodefak.'/'.$ceksuratkeluar->yersrt;
						$asalsrt		= $ceksuratkeluar->pejabat;
						$perihal		= $ceksuratkeluar->perihal;
					} else {
						$alamatsurat = $homebase.'/viewsurat/keluar-'.$idsurat;
					}
					$generatesurat 	= '<iframe src="'.$alamatsurat.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
				}
				$getpegawai 	= Simpegpegawai::where('id', $idpegawai)->first();
				if (isset($getpegawai->id)){
					$email 			= $getpegawai->email;
					$emailub 		= $getpegawai->email_ub;
					$tujuan			= $getpegawai->nama_lengkap;
					if (is_null($email) OR $email == ''){
						$email 		= $emailub;
					}
					if ($isundangan == 'Ya'){
						$ceksudah = WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $idsurat)->count();
						if ($ceksudah == 0){
							$input = WebinarEventlist::create([
								'nama'			=> $request->input('set04'),
								'tempat'		=> Session('fakpanjang'), 
								'kapasitas'		=> 0, 
								'tanggal'		=> $request->input('set05'),
								'mulai'			=> $request->input('set05').' '.$request->input('set06'), 
								'akhir'			=> $request->input('set07').' '.$request->input('set08'),
								'bayar'			=> 0,
								'kontak'		=> $idsurat,
								'pembicara'		=> 'UNDANGANDIGITAL', 
								'daftarmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'daftarakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'absenmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'absenakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'created_by'	=> Session('email'), 
								'linkwebniar'	=> $alamatsurat,
								'linkmateri'	=> '',
								'fakultas'		=> Session('fakultas')
							]);
							$idkegiatan = $input->id;
						} else {
							$input = WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $idsurat)->update([
								'nama'			=> $request->input('set04'),
								'tanggal'		=> $request->input('set05'),
								'mulai'			=> $request->input('set05').' '.$request->input('set06'), 
								'akhir'			=> $request->input('set07').' '.$request->input('set08'),
								'daftarmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'daftarakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'absenmulai'	=> $request->input('set05').' '.$request->input('set06'),
								'absenakhir'	=> $request->input('set07').' '.$request->input('set08'),
								'created_by'	=> Session('email'), 
								'linkwebniar'	=> $alamatsurat,
								'updated_at'	=> date("Y-m-d H:i:s")
							]);
							$getkegid 	= WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $idsurat)->first();
							$idkegiatan	= $getkegid->id;
						}
						if ($input){
							$ceksudah 		= Penerimasurat::where('jenis', $kelompok)->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
							if ($ceksudah == 0){
								Penerimasurat::insert([
									'asalsurat' => $alamat, 
									'perihal' 	=> $request->input('set04'), 
									'idsurat' 	=> $idsurat, 
									'jenis'		=> $kelompok, 
									'keterangan'=> 'Undangan Elektronik',
									'idpegawai'	=> $idpegawai, 
									'nama'		=> $getpegawai->nama_lengkap, 
									'jabatan'	=> $getpegawai->jabatan, 
									'penulisan'	=> $email, 
									'tabel'		=> $generatesurat,
									'status'	=> 'SEND',
									'fakultas'	=> Session('fakultas'),
									'created_by'=> Session('nama'),
									'updated_by'=> Session('nama'),
								]);
							}
							$ceksudahterjadwal = Jadwal::where('peminjam', $email)->where('inputor', $idkegiatan)->count();
							if ($ceksudahterjadwal == 0){
								$update = Jadwal::create([
									'jenisjadwal'      	=>  '0',
									'ruang'         	=>  '',
									'gedung'         	=>  '',
									'tglmulai'    		=>  $request->input('set05'),
									'jammulai'    		=>  $request->input('set06'),
									'tglakhir'    		=>  $request->input('set07'),
									'jamakhir'    		=>  $request->input('set08'),
									'mulai'    			=>  $request->input('set05').' '.$request->input('set06'),
									'akhir'     		=>  $request->input('set07').' '.$request->input('set08'),
									'peminjam'      	=>  $email,
									'keterangan'     	=>  'Undangan Elektronik',
									'keperluan'			=>  $request->input('set04').'<br /><a href="'.$alamatsurat.'" target="_blank">Download Undangan</a>',
									'suratpermohonan'	=>  $idsurat,
									'inputor' 			=>  $idkegiatan,
									'biaya' 			=>  0,
									'fakultas'			=> 	Session('fakultas'),
									'fakpanjang'		=> 	Session('fakpanjang')
								]);
							} else {
								$update = Jadwal::where('peminjam', $email)->where('inputor', $idkegiatan)->update([
									'mulai'    			=>  $request->input('set05').' '.$request->input('set06'),
									'akhir'     		=>  $request->input('set07').' '.$request->input('set08'),
									'peminjam'      	=>  $email,
									'keperluan'			=>  $request->input('set04').'<br /><a href="'.$alamatsurat.'" target="_blank">Download Undangan</a>',
									'suratpermohonan'	=>  $idsurat,
									'inputor' 			=>  $idkegiatan,
									'updated_at'		=> 	date('Y-m-d H:i:s')
								]);
							}
							if ($update){
								$cekemail 	= explode('@', $email);
								if (isset($cekemail[1])){
									$subject    = $request->input('set04');
									$note       = 'Berikut Kami Kirimkan Surat Undangan '.$request->input('set04').' Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$alamatsurat.'" target="_blank">DOWNLOAD SURAT</a></div></p>';
									SendMail::notif($getpegawai->nama_lengkap, $email, $subject, $note);
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Gagal Input Penerima Silahkan Ulangi Beberapa Saat Lagi']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Gagal Input Kegiatan Silahkan Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						$cekpejabat 	= Pejabatsurat::where('email', $email)->first();
						if (isset($cekpejabat->id)){
							$ppabptujuan= $cekpejabat->fakpanjang;
							$tujuan		= $cekpejabat->pejabat;
							$pejabat 	= 'YES';
						} else { $pejabat = 'NO'; $ppabptujuan = ''; }
						if ($pejabat == 'YES' AND $ppabptujuan != Session('fakpanjang') AND $marking != ''){
							$ceksudah 		= Suratmasuk::where('marking', Session('fakultas').'-'.$marking)->count();
							if ($ceksudah == 0){
								$kerjanya = Suratmasuk::insert([
									'marking' 		=>  Session('fakultas').'-'.$marking,
									'noagenda' 		=>  $noagenda,
									'tglmasuk' 		=>  date('Y-m-d'),
									'tglsurat' 		=>  $tglsurat,
									'daysrt' 		=>  date('d'),
									'monsrt' 		=>  date('m'),
									'yersrt' 		=>  date('Y'),
									'jenissurat' 	=>  $jenissrt,
									'nosurat' 		=>  $nosurat,
									'asalsurat' 	=>  $asalsrt,
									'kepada' 		=>  $tujuan,
									'perihal' 		=>  $perihal,
									'subyek' 		=>  'AUTO',
									'ringkasan' 	=>  $marking,
									'ringkasan2' 	=>  $perihal,
									'lampiran' 		=>  '-',
									'scansurat' 	=>  Session('fakultas').'-'.$marking.'.pdf',
									'sifat' 		=>  '4',
									'bentuk' 		=>  'Surat Elektronik',
									'klasifikasi' 	=>  'Biasa',
									'pembuat' 		=>  Session('email'),
									'status' 		=>  '',
									'disposisi' 	=>  '',
									'arsip' 		=>  '',
									'ruangarsip' 	=>  '',
									'ordnerarsip' 	=>  '',
									'lemariarsip' 	=>  '',
									'faskode' 		=>  'TU.00.1',
									'fasmasa' 		=>  '',
									'fasket' 		=>  '',
									'subkode' 		=>  '',
									'submasa' 		=>  '',
									'subket' 		=>  '',
									'fakultas' 		=>  Session('fakultas'),
								]);
								if ($update){
									SendMail::kiriminbox(Session('fakultas').'-'.$marking,Session('nama'),$tujuan,$email,'MASUK','DISPOSISI','','1');
									$cekemail 	= explode('@', $email);
									if (isset($cekemail[1])){
										$subject    = $request->input('set04');
										$note       = 'Berikut Kami Kirimkan Surat '.$request->input('set04').' Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$alamatsurat.'" target="_blank">DOWNLOAD SURAT</a></div></p>';
										SendMail::notif($getpegawai->nama_lengkap, $email, $subject, $note);
									}
									return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
									return back();
								} else {
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Ulangi Beberapa Saat Lagi']);
									return back();
								}
							} else {
								SendMail::kiriminbox(Session('fakultas').'-'.$marking,Session('nama'),$tujuan,$email,'MASUK','DISPOSISI','','1');
								$cekemail 	= explode('@', $email);
								if (isset($cekemail[1])){
									$subject    = $request->input('set04');
									$note       = 'Berikut Kami Kirimkan Surat '.$request->input('set04').' Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$alamatsurat.'" target="_blank">DOWNLOAD SURAT</a></div></p>';
									SendMail::notif($getpegawai->nama_lengkap, $email, $subject, $note);
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
								return back();
							}
						} else {
							$ceksudah 		= Penerimasurat::where('jenis', $kelompok)->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
							if ($ceksudah == 0){
								$email 			= $getpegawai->email;
								$emailub 		= $getpegawai->email_ub;
								if (is_null($email) OR $email == ''){
									$email 		= $emailub;
								}
								$update 		= Penerimasurat::insert([
									'asalsurat' => $alamat, 
									'perihal' 	=> $request->input('set04'), 
									'idsurat' 	=> $idsurat, 
									'jenis'		=> $kelompok, 
									'keterangan'=> '',
									'idpegawai'	=> $idpegawai, 
									'nama'		=> $getpegawai->nama_lengkap, 
									'jabatan'	=> $getpegawai->jabatan, 
									'penulisan'	=> $email, 
									'tabel'		=> $generatesurat,
									'status'	=> 'SEND',
									'fakultas'	=> Session('fakultas'),
									'created_by'=> Session('nama'),
									'updated_by'=> Session('nama'),
								]);
								if ($update){
									$cekemail 	= explode('@', $email);
									if (isset($cekemail[1])){
										$subject    = $request->input('set04');
										$note       = 'Berikut Kami Kirimkan Surat '.$request->input('set04').' Pada Tanggal '.date('Y-m-d H:i:s').' Oleh '.Session('nama').'<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$alamatsurat.'" target="_blank">DOWNLOAD SURAT</a></div></p>';
										SendMail::notif($getpegawai->nama_lengkap, $email, $subject, $note);
									}
									return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
									return back();
								} else {
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Ulangi Beberapa Saat Lagi']);
									return back();
								}
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data Sudah Ada']);
								return back();
							}
						}
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Pegawai '.$idpegawai.' Tidak Valid']);
					return back();
				}
			}
		}
    }
	public function sampaikanSrtmsk(Request $request) {
		$idne		= $request->input('val01');
		$catatan	= $request->input('val02');
		$perihal	= $request->input('val03');
		$tes		= $request->input('val04');
		$tlskepada 	= '';
		if ($catatan == 'SUDAHOK'){
			$kepada   	= json_decode($tes['0']);
			foreach ( $kepada as $tujuan )
			{
				$tujuanne 	= $tujuan->id;
				if ($tlskepada == '') {$tlskepada = $tujuanne;}
				else {$tlskepada = $tlskepada.'-'.$tujuanne; }
			}
		}
		$gceksrtmsk	= Suratmasuk::where('id', $idne)->count();
		if ($gceksrtmsk != 0){
			if ($tlskepada == ''){
				Suratmasuk::where('id', $idne)->update([
					'perihal'	=> $perihal,
				]);
			} else {
				Suratmasuk::where('id', $idne)->update([
					'kepada'	=> $tlskepada,
					'perihal'	=> $perihal,
				]);
			}
			$jceksrtmsk		= Suratmasuk::where('id', $idne)->first();
			$marking		= $jceksrtmsk->marking;
			$sifat			= $jceksrtmsk->sifat;
			$fakultas		= $jceksrtmsk->fakultas;
			$noagenda		= $jceksrtmsk->noagenda;
		} else {
			$marking		= '';
		}
		if ($catatan == 'SUDAHOK'){
			if($tlskepada != ''){
				Inboxsurat::where('marking', $marking)->where('jenis', 'PEMERIKSAAN')->delete();
				$arrkepada = explode('-', $tlskepada);
				foreach ( $arrkepada as $tujuan )
				{
					$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $tujuan)->first();
					if (isset($getemail->id)){
						$email 	= $getemail->email;
					} else { $email = $tujuan; }
					SendMail::kiriminbox($marking,'Kepala Subdivisi Tata Usaha dan Protokol',$tujuan,$email,'MASUK','DISPOSISI','','1');
				}
				$mytime 	= Carbon::now();
				$tanggal 	= $mytime->toDateTimeString();
				$tulis 		= 'Telah di Periksa Oleh Kepala Subdivisi Tata Usaha dan Protokol Pada Tanggal '.$tanggal;
				Suratmasuk::where('id', $idne)->update([
					'ringkasan'	=> $tulis,
					'status'	=> 'Checked'
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sended']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Return', 'message' => 'Penerima tidak boleh kosong']);
				return back();
			}
		} else {
			if ($marking != ''){
				Inboxsurat::where('marking', $marking)->where('jenis', 'PEMERIKSAAN')->delete();
			}
			Suratmasuk::where('id', $idne)->update([
				'ringkasan' => $catatan,
				'status'	=> 'Koreksi'
			]);
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Return', 'message' => 'Data Surat di Kembalikan Ke TU']);
			return back();
		}
    }
	public function updsuratkeluar(Request $request) {
		$validator = Validator::make($request->all(), [
          'id_sifat' 			=>  'required',
          'idparaf1' 			=> 	'required',
          'id_lampiran' 		=> 	'required',
          'id_hal' 				=> 	'required',
          'id_namapenandatangan'=> 	'required',
		  'id_konseptor' 		=> 	'required',
		  'id_penandatangan' 	=> 	'required',
		  'id_kodepjbt' 		=> 	'required',
        ]);
		if($validator->fails()) {
			Session::flash('status', 'Error');
			Session::flash('message', 'Mohon Lengkapi Isian Form Anda'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
        } else {
			$kodefas		= $request->input('id_klasifikasiarsip');
			$tanggal		= $request->input('id_tanggal');
			$unit			= $request->input('id_jenissurat');
			$lampiran		= $request->input('id_lampiran');
			$perihal		= $request->input('id_hal');
			$tertuju		= $request->input('id_tertuju');
			$alamat			= $request->input('id_alamat');
			$isi_surat		= $request->input('isi_surat');
			$nmttd			= $request->input('id_namapenandatangan');
			$konseptor		= $request->input('id_konseptor');
			$tembusan		= $request->input('id_tembusan');
			$penandatangan	= $request->input('id_penandatangan');
			$sifat			= $request->input('id_sifat');
			$klasifikasi	= $request->input('id_klasifikasi');
			$idsurat		= $request->input('id_surat');
			$kodefakultas	= $request->input('id_kodepjbt');
			$thndasar		= $request->input('id_dasartahun');
			$dasar			= $request->input('id_dasar');
			$paraf1			= $request->input('idparaf1');
			$paraf2			= $request->input('idparaf2');
			$paraf3			= $request->input('idparaf3');
			$paraf4			= $request->input('idparaf4');
			$font			= $request->input('id_font');
			$ukuran			= $request->input('id_ukuran');
			$lebar			= $request->input('id_lebar');
			if ($unit == '' OR is_null($unit)){ $unit = 'TU'; }
			if ($lebar == ''){ $lebar = '40'; }
			$tgl 			= '';
			$bln 			= '';
			$thn 			= date("Y");
			if ($paraf2 == ''){ $paraf2 = '0'; }
			if ($paraf3 == ''){ $paraf3 = '0'; }
			if ($paraf4 == ''){ $paraf4 = '0'; }
			$mkelompok		= Session('previlage');
			$pembuat		= Session('nama');
			$fakultas		= Session('fakultas');
			$rnamapjbt		= Pejabatsurat::where('id', $nmttd)->first();
			$pejabat 		= $rnamapjbt->pejabat;
			$namapjbt 		= $rnamapjbt->nama;
			$nippjbt 		= $rnamapjbt->nip;
			$kodefakultas 	= $rnamapjbt->kode;
			$idpejabat 		= $rnamapjbt->id;
			$jenisnip 		= $rnamapjbt->jenis;
			$emailpenerima 	= $rnamapjbt->email;
			if ($kodefas != ''){
				$qklasifikasi	= Klasifikasi::where('kodesurat', 'LIKE', $kodefas.'%')->first();
				$klasaktif 		= $qklasifikasi->aktif;
				$klasinaktif 	= $qklasifikasi->inaktif;
				$klasket 		= $qklasifikasi->keterangan;
			} else {
				$klasaktif 		= '';
				$klasinaktif 	= '';
				$klasket 		= '';
			}
			if ($namapjbt == 'Dekan' OR $namapjbt == 'Rektor' or $namapjbt == 'Wakil Rektor Bidang Akademik' or $namapjbt == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' or $namapjbt == 'Wakil Rektor Bidang Kemahasiswaan, Alumni dan Kewirausahaan Mahasiswa' or $namapjbt == 'Wakil Rektor Bidang Perencanaan, Kerjasama dan Internasionalisasi'){ $bolehdewe = 'NO'; }
			else { $bolehdewe = 'YES'; }
			if ($bolehdewe == 'NO' and $paraf1 == 'SELF'){
				Session::flash('status', 'Error');
				Session::flash('message', 'Mohon Maaf, Paraf Sendiri Hanya Boleh Bila Yang Menandatanganinya Selain Rektor / Wakil Rektor'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else {
				$setttd = $namapjbt.'<br />NIP. '.$nippjbt;
				if ($request->hasFile('id_uploaddasar')) {
					$validator = Validator::make($request->all(), [
						'id_uploaddasar' =>  'mimes:jpeg,jpg,pdf,png,JPEG,JPG,PNG,PDF|max:20000'
					]);
					if ($validator->fails()) {
						Session::flash('status', 'Error');
						Session::flash('message', 'File harus sesuai format(JPG/JPEG/PNG/PDF) dan tidak melebihi dari 20mb.'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else {
						if ($idsurat == 'new'){
							$cekmarking		= Suratkeluar::orderBy('id', 'DESC')->count();
							if ($cekmarking == 0){
								$nomor 		= 1;
								$marking 	= $fakultas.'-OUT-'.$thn.$nomor;
							}else {
								$cekmarking	= Suratkeluar::orderBy('id', 'DESC')->first();
								$lastid		= $cekmarking->id;
								$nomor 		= $lastid+1;
								$marking 	= $fakultas.'-OUT-'.$thn.$nomor;
							}
							$namafile 		= $fakultas.'-DSR-'.$thn.$nomor;
							$namafile		= $namafile.'.'.$request->file('id_uploaddasar')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('id_uploaddasar');
							$request->file('id_uploaddasar')->move(public_path('scan/files'), $namafile);
							$kerjanya = Suratkeluar::insert([
								'id' 			=>  $nomor,
								'marking' 		=>  $marking,
								'jenissrt' 		=>  'BIASA',
								'nomor' 		=>  '0',
								'kodefak' 		=>  $kodefakultas,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tanggal,
								'daysrt' 		=>  $tgl,
								'monsrt' 		=>  $bln,
								'yersrt' 		=>  $thn,
								'dasarsurat' 	=>  $namafile,
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  $lampiran,
								'isisurat' 		=>  $isi_surat,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  $tembusan,
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
								'status' 		=>  'NEW',
								'arsip' 		=>  '',
								'footnote' 		=>  '',
								'tandatangan' 	=>  '',
								'paraf1' 		=>  $paraf1,
								'paraf2' 		=>  $paraf2,
								'paraf3' 		=>  $paraf3,
								'paraf4' 		=>  $paraf4,
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',
								'faskode' 		=>  $kodefas,
								'fasmasa' 		=>  '',
								'fasket' 		=>  '',
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'font' 			=>  $font,
								'ukuran' 		=>  $ukuran,
								'lebarttd' 		=>  $lebar,
								'fakultas' 		=>  $fakultas,
							]);
							if ($kerjanya){
								if ($request->hasFile('id_filelampiran')) {
									$validator = Validator::make($request->all(), [
										'id_filelampiran' =>  'mimes:pdf,PDF|max:200000'
									]);
									if ($validator->fails()) {
										Session::flash('status', 'Success With Notice');
										Session::flash('message', 'Input Surat Keluar Sukses. Namun gagal saat proses input file lampiran. File Lampiran Wajib PDF dan tidak melebihi dari 20mb. Mohon ulangi upload file lampiran anda'); 
										Session::flash('alert-class', 'alert-info');
										return back();
									}else {
										$namafilelampiran 	= $fakultas.'-Lampiran-'.$thn.$nomor;
										$namafilelampiran	= $namafilelampiran.'.'.$request->file('id_filelampiran')->getClientOriginalExtension();
										$request->file('id_filelampiran')->move(public_path('scan/files'), $namafilelampiran);
										Suratkeluar::where('id', $nomor)->update([
											'filelampiran' 	=>  $namafilelampiran,
										]);
										$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
										if (isset($qnamapjbt->pejabat)){
											$pejabat = $qnamapjbt->pejabat;
											SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
										} else {
											SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
										}
										Session::flash('status', 'Success');
										Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input  Beserta Lampiran'); 
										Session::flash('alert-class', 'alert-success');
										return back();
									}
								} else {
									$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
									if (isset($qnamapjbt->pejabat)){
										$pejabat = $qnamapjbt->pejabat;
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
									}
									
									Session::flash('status', 'Success');
									Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input'); 
									Session::flash('alert-class', 'alert-success');
									return back();
								}
							}else{
								Session::flash('status', 'Error');
								Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							}
						} else {
							$qdislws		= Suratkeluar::where('id', $idsurat)->first();
							$statsurat 		= $qdislws->status;
							$nomor 			= $qdislws->nomor;
							$marking 		= $qdislws->marking;
							$dasarsurat		= $qdislws->dasarsurat;
							$filelampiran	= $qdislws->filelampiran;
							if ($statsurat == 'NEW' OR $mkelompok == 'Sekretaris Rektor' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $mkelompok == 'Sekretaris' OR $mkelompok == 'Sekretaris Dekan' OR $mkelompok == 'Sekretaris WD I' OR $mkelompok == 'Sekretaris WD II' OR $mkelompok == 'Sekretaris WD III' OR $mkelompok == 'Sekretaris Senat UB'  OR $mkelompok == 'developer' OR Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
								if ($dasarsurat != ''){
									$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
									if ($qcekdasar == 0){
										if (File::exists(base_path() ."/public/scan/files/". $dasarsurat)) {
										  File::delete(base_path() ."/public/scan/files/". $dasarsurat);
										}
									}
									$getnamadasar	= explode(".",$dasarsurat);
									$namafile		= $getnamadasar[0];
								} else {
									$namafile 		= $fakultas.'-DSR-'.$thn.$idsurat;
								}
								
								$namafile		= $namafile.'.'.$request->file('id_uploaddasar')->getClientOriginalExtension();
								$request->file('id_uploaddasar')->move(public_path('scan/files'), $namafile);
								$kerjanya = Suratkeluar::where('id', $idsurat)->update([
									'kodefak' 		=>  $kodefakultas,
									'unit' 			=>  $unit,
									'tglsurat' 		=>  $tanggal,
									'dasarsurat' 	=>  $namafile,
									'perihal' 		=>  $perihal,
									'lampiran' 		=>  $lampiran,
									'isisurat' 		=>  $isi_surat,
									'idpejabat' 	=>  $idpejabat,
									'pejabat' 		=>  $penandatangan,
									'namapejabat' 	=>  $setttd,
									'tembusan' 		=>  $tembusan,
									'sifat' 		=>  $sifat,
									'klasifikasi' 	=>  $klasifikasi,
									'pembuat' 		=>  $konseptor,
									'kelompok' 		=>  $mkelompok,
									'paraf1' 		=>  $paraf1,
									'paraf2' 		=>  $paraf2,
									'paraf3' 		=>  $paraf3,
									'paraf4' 		=>  $paraf4,
									'font' 			=>  $font,
									'ukuran' 		=>  $ukuran,
									'lebarttd' 		=>  $lebar,
									'faskode' 		=>  $kodefas,
								]);
								if ($kerjanya){
									if ($request->hasFile('id_filelampiran')) {
										$validator = Validator::make($request->all(), [
											'id_filelampiran' =>  'mimes:pdf,PDF|max:200000'
										]);
										if ($validator->fails()) {
											Session::flash('status', 'Success With Notice');
											Session::flash('message', 'Update Surat Keluar Sukses. Namun gagal saat proses input file lampiran. File Lampiran Wajib PDF dan tidak melebihi dari 20mb. Mohon ulangi upload file lampiran anda'); 
											Session::flash('alert-class', 'alert-info');
											return back();
										}else {
											if (File::exists(base_path() ."/public/scan/files/". $filelampiran)) {
											  File::delete(base_path() ."/public/scan/files/". $filelampiran);
											}
											$namafilelampiran 	= $fakultas.'-Lampiran-'.$thn.$nomor;
											$namafilelampiran	= $namafilelampiran.'.'.$request->file('id_filelampiran')->getClientOriginalExtension();
											$request->file('id_filelampiran')->move(public_path('scan/files'), $namafilelampiran);
											Suratkeluar::where('id', $nomor)->update([
												'filelampiran' 	=>  $namafilelampiran,
											]);
											Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
											$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
											if (isset($qnamapjbt->pejabat)){
												$pejabat 	= $qnamapjbt->pejabat;
												SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
											} else {
												SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
											}
											
											Session::flash('status', 'Success');
											Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
											Session::flash('alert-class', 'alert-info');
											return back();
										}
									}else {
										Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
										$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
										if (isset($qnamapjbt->pejabat)){
											$pejabat 	= $qnamapjbt->pejabat;
											SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
										} else {
											SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
										}
										Session::flash('status', 'Success');
										Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
										Session::flash('alert-class', 'alert-info');
										return back();
									}
								}else{
									Session::flash('status', 'Error');
									Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
									Session::flash('alert-class', 'alert-danger');
									return back();
								}
							}else {
								Session::flash('status', 'Error');
								Session::flash('message', 'Hanya Sekpim yang diperbolehkan mengubah data yang sudah diperiksa pimpinan'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							}
						}
					}
				} else {
					$marking1 = $fakultas.'-'.$thndasar.$dasar;
					$marking2 = $thndasar.$dasar;
					$datalm1  = Suratmasuk::where('marking', $marking1)->count();
					$datalm2  = Suratmasuk::where('marking', $marking2)->count();
					if ($datalm1 != 0){
						$ceksrtnoagenda	= Suratmasuk::where('marking', $marking1)->first();
						$namafile		= $ceksrtnoagenda->scansurat;
					} else if ($datalm2 != 0){
						$ceksrtnoagenda	= Suratmasuk::where('marking', $marking2)->first();
						$namafile		= $ceksrtnoagenda->scansurat;
					} else {
						$namafile 		= $fakultas.'-'.$thn.'-TnpDasar';
					}
					if ($idsurat == 'new'){
						$cekmarking		= Suratkeluar::orderBy('id', 'DESC')->count();
						if ($cekmarking == 0){
							$nomor 		= 1;
							$marking 	= $fakultas.'-OUT-'.$thn.$nomor;
						}else {
							$cekmarking	= Suratkeluar::orderBy('id', 'DESC')->first();
							$lastid		= $cekmarking->id;
							$nomor 		= $lastid+1;
							$marking 	= $fakultas.'-OUT-'.$thn.$nomor;
						}
						$setttd = $namapjbt.'<br />NIP. '.$nippjbt;
						$kerjanya = Suratkeluar::insert([
							'id' 			=>  $nomor,
							'marking' 		=>  $marking,
							'jenissrt' 		=>  'BIASA',
							'nomor' 		=>  '0',
							'anakno' 		=>  '',
							'kodefak' 		=>  $kodefakultas,
							'unit' 			=>  $unit,
							'tglsurat' 		=>  $tanggal,
							'daysrt' 		=>  $tgl,
							'monsrt' 		=>  $bln,
							'yersrt' 		=>  $thn,
							'dasarsurat' 	=>  $namafile,
							'kepada' 		=>  '',
							'alamat' 		=>  '',
							'perihal' 		=>  $perihal,
							'lampiran' 		=>  $lampiran,
							'isisurat' 		=>  $isi_surat,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $penandatangan,
							'namapejabat' 	=>  $setttd,
							'tembusan' 		=>  $tembusan,
							'sifat' 		=>  $sifat,
							'klasifikasi' 	=>  $klasifikasi,
							'pembuat' 		=>  $konseptor,
							'kelompok' 		=>  $mkelompok,
							'status' 		=>  'NEW',
							'arsip' 		=>  '',
							'footnote' 		=>  '',
							'tandatangan' 	=>  '',
							'paraf1' 		=>  $paraf1,
							'paraf2' 		=>  $paraf2,
							'paraf3' 		=>  $paraf3,
							'paraf4' 		=>  $paraf4,
							'ruangarsip' 	=>  '',
							'ordnerarsip' 	=>  '',
							'lemariarsip' 	=>  '',
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  '',
							'fasket' 		=>  '',
							'subkode' 		=>  '',
							'submasa' 		=>  '',
							'subket' 		=>  '',
							'font' 			=>  $font,
							'ukuran' 		=>  $ukuran,
							'lebarttd' 		=>  $lebar,
							'filelampiran' 	=>  '',
							'fakultas' 		=>  $fakultas
						]);
						if ($kerjanya){
							if ($request->hasFile('id_filelampiran')) {
								$validator = Validator::make($request->all(), [
									'id_filelampiran' =>  'mimes:pdf,PDF|max:200000'
								]);
								if ($validator->fails()) {
									Session::flash('status', 'Success With Notice');
									Session::flash('message', 'Input Surat Keluar Sukses. Namun gagal saat proses input file lampiran. File Lampiran Wajib PDF dan tidak melebihi dari 20mb. Mohon ulangi upload file lampiran anda'); 
									Session::flash('alert-class', 'alert-info');
									return back();
								}else {
									$namafilelampiran 	= $fakultas.'-Lampiran-'.$thn.$nomor;
									$namafilelampiran	= $namafilelampiran.'.'.$request->file('id_filelampiran')->getClientOriginalExtension();
									$request->file('id_filelampiran')->move(public_path('scan/files'), $namafilelampiran);
									Suratkeluar::where('id', $nomor)->update([
										'filelampiran' 	=>  $namafilelampiran,
									]);
									$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
									if (isset($qnamapjbt->pejabat)){
										$pejabat 	= $qnamapjbt->pejabat;
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
									}
									Session::flash('status', 'Success');
									Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input  Beserta Lampiran'); 
									Session::flash('alert-class', 'alert-success');
									return back();
								}
							}else {
								$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
								if (isset($qnamapjbt->pejabat)){
									$pejabat 	= $qnamapjbt->pejabat;
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
								} else {
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
								}
								Session::flash('status', 'Success');
								Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input'); 
								Session::flash('alert-class', 'alert-success');
								return back();
							}
						} else{
							Session::flash('status', 'Error');
							Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						}
					} else {
						$qdislws	= Suratkeluar::where('id', $idsurat)->first();
						$statsurat 	= $qdislws->status;
						$nomor 		= $qdislws->nomor;
						$marking 	= $qdislws->marking;
						$dasarsurat	= $qdislws->dasarsurat;
						if ($statsurat == 'NEW' OR $mkelompok == 'Sekretaris Rektor' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $previlage == 'Sekretaris' OR $previlage == 'Sekretaris Dekan' OR $previlage == 'Sekretaris WD I' OR $previlage == 'Sekretaris WD II' OR $previlage == 'Sekretaris WD III' OR $previlage == 'Sekretaris Senat UB'){
							if ($dasarsurat != ''){
								$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
								if ($qcekdasar == 0){
									if (File::exists(base_path() ."/public/scan/files/". $dasarsurat)) {
									  File::delete(base_path() ."/public/scan/files/". $dasarsurat);
									}
								}
							}
							$setttd = $namapjbt.'<br />NIP. '.$nippjbt;
							$kerjanya = Suratkeluar::where('id', $idsurat)->update([
								'kodefak' 		=>  $kodefakultas,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tanggal,
								'daysrt' 		=>  $tgl,
								'monsrt' 		=>  $bln,
								'yersrt' 		=>  $thn,
								'dasarsurat' 	=>  $namafile,
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  $lampiran,
								'isisurat' 		=>  $isi_surat,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  $tembusan,
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
								'paraf1' 		=>  $paraf1,
								'paraf2' 		=>  $paraf2,
								'paraf3' 		=>  $paraf3,
								'paraf4' 		=>  $paraf4,
								'faskode' 		=>  $kodefas,
								'font' 			=>  $font,
								'ukuran' 		=>  $ukuran,
								'lebarttd' 		=>  $lebar,
								'fakultas' 		=>  $fakultas
							]);
							
							if ($kerjanya){
								if ($request->hasFile('id_filelampiran')) {
									$validator = Validator::make($request->all(), [
										'id_filelampiran' =>  'mimes:pdf,PDF|max:200000'
									]);
									if ($validator->fails()) {
										Session::flash('status', 'Success With Notice');
										Session::flash('message', 'Update Surat Keluar Sukses. Namun gagal saat proses input file lampiran. File Lampiran Wajib PDF dan tidak melebihi dari 20mb. Mohon ulangi upload file lampiran anda'); 
										Session::flash('alert-class', 'alert-info');
										return back();
									} else {
										if (File::exists(base_path() ."/public/scan/files/". $filelampiran)) {
										  File::delete(base_path() ."/public/scan/files/". $filelampiran);
										}
										$namafilelampiran 	= $fakultas.'-Lampiran-'.$thn.$nomor;
										$namafilelampiran	= $namafilelampiran.'.'.$request->file('id_filelampiran')->getClientOriginalExtension();
										
										$request->file('id_filelampiran')->move(public_path('scan/files'), $namafilelampiran);
										Suratkeluar::where('id', $nomor)->update([
											'filelampiran' 	=>  $namafilelampiran,
										]);
										Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
										$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
										if (isset($qnamapjbt->email)){
											$pejabat 	= $qnamapjbt->pejabat;
											SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
										} else {
											SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
										}
										Session::flash('status', 'Success');
										Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
										Session::flash('alert-class', 'alert-info');
										return back();
									}
								} else {
									Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
									$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
									if (isset($qnamapjbt->pejabat)){
										$pejabat 	= $qnamapjbt->pejabat;
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
										
									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
									}
									Session::flash('status', 'Success');
									Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
									Session::flash('alert-class', 'alert-info');
									return back();
								}
							} else{
								Session::flash('status', 'Error');
								Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							}
						} else {
							Session::flash('status', 'Error');
							Session::flash('message', 'Hanya Sekpim yang diperbolehkan mengubah data yang sudah diperiksa pimpinan'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						}
					}
				}
			}
		}
	}
	public function exRekuesnomor(Request $request) {
		$validator 	= Validator::make($request->all(), [
          'set01' 	=>  'required',
          'set02' 	=> 	'required',
        ]);
		if($validator->fails()) {
			echo '<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Something is missing</h4>
						Mohon Lengkapi Data Dasarnya
				</div>';
        } else {
			$jumlah				= $request->input('set01');
			$klasifikasi		= $request->input('set02');
			$klasifikasiarsip	= $request->input('set03');
			$kodepjbt			= $request->input('set04');
			$sifat				= $request->input('set05');
			$konseptor			= $request->input('set06');
			$mkelompok			= $request->input('set07');
			$sendstatus			= '';
			if ($request->input('set08') !== null ){
				$perihal		= $request->input('set08');
			} else {
				$perihal 		= '';
			}
			$ceksek 			= User::where('email', $konseptor)->count();
			if ($ceksek != 0){
				$konseptor 		= 'suratdinas';
			}
			$fakultas 			= Session('fakultas');
			if ($kodepjbt == ''){ $kodepjbt = 'UN10'; }
			$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			if ($klasifikasiarsip != ''){
				$arrkode 		= explode(".", $klasifikasiarsip);
				$unit 			= $arrkode[0];
				$klasifikasiarsip= '';
				if(isset($arrkode[1])){ $klasifikasiarsip = $unit.'.'.$arrkode[1]; }
				if(isset($arrkode[2])){
					if ($arrkode[2] != ''){
						$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[2];
					}
				}
				if(isset($arrkode[3])){
					if ($arrkode[3] != ''){
						$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[3];
					}
				}
				if(isset($arrkode[4])){
					if ($arrkode[4] != ''){
						$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[4];
					}
				}
				
				$getperihal		= Klasifikasi::where('kodesurat', 'LIKE', $klasifikasiarsip.'%')->orderBy('id', 'ASC')->first();
				$primer			= $getperihal->primer;
				$sekunder		= $getperihal->sekunder;
				$tersier		= $getperihal->tersier;
				$series			= $getperihal->series;
				if ($perihal == ''){
					if ($series != ''){
						$perihal 	= $sekunder.' '.$tersier.' '.$series;
					} else {
						if ($tersier != ''){
							$perihal 	= $sekunder.' '.$tersier;
						} else {
							if ($sekunder != ''){
								$perihal 	= $sekunder;
							} else {
								$perihal 	= $primer;
							}
						}
					}
				}
			} else { $unit = 'TU'; }
			if ($konseptor == 'editredaksisk'){
				$nomor			= $request->input('set01');
				$tanggal		= $request->input('set02');
				$idne			= $request->input('set03');
				$judul			= $request->input('set05');
				$gettahun		= explode('-', $tanggal);
				$tahun			= $gettahun[0];
				$kerjanya 		= Tabelskdanperaturan::where('id', $idne)->update([
					'nomor'		=> $nomor,
					'tahun'		=> $tahun,
					'tanggal'	=> $tanggal,
					'judul'		=> $judul,
					'updated_at'=> date("Y-m-d H:i:s")
				]);
				if ($kerjanya){
					echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
							Redaksi Updated
					</div>';
					
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
							Sistem Error, mohon ulangi beberapa saat lagi
					</div>';
				}
			} elseif ($konseptor == 'suratdinas'){
				$jenissrt			= '';
				if ($request->input('set09') !== null ){
					$jenissrt		= $request->input('set09');
				}
				if ($jenissrt == ''){
					$jenissrt		= 'BIASA';
				}
				$dd 	  		= date("d");
				$mm 	  		= date("m");
				$yy 	  		= date("Y");
				$thncari		= $yy.'-%';
				$tlstgl			= $yy.'-'.$mm.'-'.$dd;
				$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
				if ($ceknomorsrt == 0){
					$nomor 		= 1;
				}else {
					$ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
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
				if ($jumlah < 0) { $jumlah = 1; }
				if ($jumlah == 1){
					$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
					if (isset($getid->id)){
						$idnomor		= $getid->id;
						$idnomor		= $idnomor + 1;	
					} else {
						$idnomor		= 1;
					}
					$cgetpejabat	= Pejabatsurat::where('kode', $kodepjbt)->count();
					if ($cgetpejabat != 0){
						$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
						$idpejabat		= $getpejabat->id;
						$penandatangan	= $getpejabat->pejabat;
						$setttd			= $getpejabat->nama;
					} else {
						$idpejabat		= '0';
						$penandatangan	= '-';
						$setttd			= '-';
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
					if ($mkelompok == 'nomortte'){
						$jenissrt 	= 'UPLOAD';
						$isisurat	= $marking;
						$konseptor	= Session('email');
						$mkelompok	= Session('jabatan');
						$pemohon	= $konseptor;
					} else if ($mkelompok == 'sertifikattte'){
						$jenissrt 	= 'SERTIFIKATTTE';
						$isisurat	= $marking;
						$konseptor	= Session('email');
						$mkelompok	= Session('jabatan');
						$pemohon	= $konseptor;
					} else {
						$isisurat	= '';
						$pemohon	= $konseptor;
					}
					if ($pemohon == 'suratdinas'){ $pemohon = Session('email'); }
					if ($mkelompok == ''){ $mkelompok = Session('jabatan'); }
					$ceksek			= Suratkeluar::where('nomor', $nomor)->where('yersrt', $yy)->where('fakultas', 'LIKE', 'ODR-'.$fakultas)->count();
					if ($ceksek != 0){
						Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', 'ODR-'.$fakultas)->update([
							'fakultas'	=> $fakultas
						]);
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
									Sistem Error, mohon ulangi beberapa saat lagi
							</div>';
					} else {
						try {
							$kerjanya 	= Suratkeluar::insertGetId([
								'id' 			=>  $idnomor,
								'marking' 		=>  $marking,
								'jenissrt' 		=>  $jenissrt,
								'nomor' 		=>  $nomor,
								'anakno' 		=>  '',
								'kodefak' 		=>  $kodepjbt,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tlstgl,
								'daysrt' 		=>  $dd,
								'monsrt' 		=>  $mm,
								'yersrt' 		=>  $yy,
								'dasarsurat' 	=>  '',
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  '',
								'isisurat' 		=>  $isisurat,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  '',
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $pemohon,
								'kelompok' 		=>  $mkelompok,
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
								'faskode' 		=>  $klasifikasiarsip,
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
						} catch (\Exception $e) {
							$kerjanya = 0;
							$sendstatus = $sendstatus.$e->getMessage();
						}
						if ($kerjanya != 0){
							$monsrt			= (int)$mm;
							$bln 			= $bulan[$monsrt];
							$tlstanggal		= $dd.' '.$bln.' '.$yy;
							if ($klasifikasiarsip != ''){
								$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
							} else {
								$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
							}
							if ($jenissrt == 'SERTIFIKATTTE'){
								WebinarEventlist::create([
									'id'			=> $kerjanya, 
									'nama'			=> $perihal, 
									'tempat'		=> Session('fakpanjang'), 
									'kapasitas'		=> 0, 
									'tanggal'		=> $tlstgl, 
									'mulai'			=> $tlstgl.' '.date("H:i:s"), 
									'akhir'			=> $tlstgl.' '.date("H:i:s"),
									'bayar'			=> 0, 
									'kontak'		=> Session('nama'), 
									'pembicara'		=> '-', 
									'daftarmulai'	=> $tlstgl.' '.date("H:i:s"),
									'daftarakhir'	=> $tlstgl.' '.date("H:i:s"),
									'absenmulai'	=> $tlstgl.' '.date("H:i:s"),
									'absenakhir'	=> $tlstgl.' '.date("H:i:s"),
									'created_by'	=> Session('nama'), 
									'linkwebniar'	=> '-',
									'linkmateri'	=> '-',
									'fakultas'		=> Session('fakultas'),
								]);
							}
							echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
									<table class="table table-bordered">
										<tr>
											<td>Tanggal</td>
											<td>Nomor</td>
											<td>Penulisan Nomor</td>
											<td>Pemohon</td>
										</tr>
										<tr>
											<td>'.$tlstanggal.'</td>
											<td>'.$nomor.'</td>
											<td>'.$tlsnomor.'</td>
											<td>'.$pemohon.'</td>
										</tr>
									</table>
							</div>';
							
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
									Sistem Error, mohon ulangi beberapa saat lagi<br />'.$sendstatus.'
							</div>';
						}
					}
				} else {
					$monsrt			= (int)$mm;
					$bln 			= $bulan[$monsrt];
					$tlstanggal		= $dd.' '.$bln.' '.$yy;
					
					$cgetpejabat	= Pejabatsurat::where('kode', $kodepjbt)->count();
					if ($cgetpejabat != 0){
						$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
						$idpejabat		= $getpejabat->id;
						$penandatangan	= $getpejabat->pejabat;
						$setttd			= $getpejabat->nama;
					} else {
						$idpejabat		= '0';
						$penandatangan	= '-';
						$setttd			= '-';
					}
					$idnomor		= 0;
					
					$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
					if (isset($getid->id)){
						$idnomor		= $getid->id;
						$idnomor		= $idnomor + 1;	
					} else {
						$idnomor		= 1;
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
					$hasile				= '<table class="table table-bordered"><tr><td>No</td><td>No.Surat</td><td>Tanggal</td><td>Penulisan Nomor</td></tr>';
					$i					= 0;
					if ($mkelompok == 'nomortte'){
						$jenissrt 	= 'UPLOAD';
						$pemohon	= Session('email');
						$kelompok	= Session('jabatan');
						$konseptor	= $pemohon;
					} else if ($mkelompok == 'sertifikattte'){
						$jenissrt 	= 'SERTIFIKATTTE';
						$pemohon	= Session('email');
						$kelompok	= Session('jabatan');
						$konseptor	= $pemohon;
					} else {
						$isisurat	= '';
						$kelompok	= $mkelompok;
						$pemohon	= $konseptor;
					}
					if ($pemohon == 'suratdinas'){ $pemohon = Session('email'); }
					if ($kelompok == ''){ $kelompok = Session('jabatan'); }
					
					while($i != $jumlah) {
						$marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
						if ($mkelompok == 'nomortte' OR $mkelompok == 'sertifikattte'){
							$isisurat	= $marking;
						}
						$ceksek			= Suratkeluar::where('nomor', $nomor)->where('yersrt', $yy)->where('fakultas', 'ODR-'.$fakultas)->count();
						if ($ceksek != 0){
							Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', 'ODR-'.$fakultas)->update([
								'fakultas'	=> $fakultas
							]);
						} else {
							try {
								$kerjanya 	= Suratkeluar::insertGetId([
									'id' 			=>  $idnomor,
									'marking' 		=>  $marking,
									'jenissrt' 		=>  $jenissrt,
									'nomor' 		=>  $nomor,
									'anakno' 		=>  '',
									'kodefak' 		=>  $kodepjbt,
									'unit' 			=>  $unit,
									'tglsurat' 		=>  $tlstgl,
									'daysrt' 		=>  $dd,
									'monsrt' 		=>  $mm,
									'yersrt' 		=>  $yy,
									'dasarsurat' 	=>  '',
									'kepada' 		=>  '',
									'alamat' 		=>  '',
									'perihal' 		=>  $perihal,
									'lampiran' 		=>  '',
									'isisurat' 		=>  $isisurat,
									'idpejabat' 	=>  $idpejabat,
									'pejabat' 		=>  $penandatangan,
									'namapejabat' 	=>  $setttd,
									'tembusan' 		=>  '',
									'sifat' 		=>  $sifat,
									'klasifikasi' 	=>  $klasifikasi,
									'pembuat' 		=>  $pemohon,
									'kelompok' 		=>  $kelompok,
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
									'faskode' 		=>  $klasifikasiarsip,
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
							} catch (\Exception $e) {
								$kerjanya = 0;
								$sendstatus = $sendstatus.'<br />'.$e->getMessage();
							}
						}
						if ($kerjanya != 0){
							if ($jenissrt == 'SERTIFIKATTTE'){
								WebinarEventlist::create([
									'id'			=> $kerjanya, 
									'nama'			=> $perihal, 
									'tempat'		=> config('global.swandhanaalamat'), 
									'kapasitas'		=> 0, 
									'tanggal'		=> $tlstgl, 
									'mulai'			=> $tlstgl.' '.date("H:i:s"), 
									'akhir'			=> $tlstgl.' '.date("H:i:s"),
									'bayar'			=> 0, 
									'kontak'		=> Session('nama'), 
									'pembicara'		=> '-', 
									'daftarmulai'	=> $tlstgl.' '.date("H:i:s"),
									'daftarakhir'	=> $tlstgl.' '.date("H:i:s"),
									'absenmulai'	=> $tlstgl.' '.date("H:i:s"),
									'absenakhir'	=> $tlstgl.' '.date("H:i:s"),
									'created_by'	=> Session('nama'), 
									'linkwebniar'	=> '-',
									'linkmateri'	=> '-',
									'fakultas'		=> Session('fakultas'),
								]);
							}
							if ($klasifikasiarsip != ''){
								$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
							} else {
								$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
							}
							$hasile = $hasile.'<tr><td>'.$i.'</td><td>'.$nomor.'</td><td>'.$tlstanggal.'</td><td>'.$tlsnomor.'</td></tr>';
						} else {
							$hasile = $hasile.'<tr><td>'.$i.'</td><td>'.$nomor.'</td><td>'.$tlstanggal.'</td><td>Gagal Input</td></tr>';
						}
						$i++;
						$idnomor++;
						$nomor++;
						
					}
					$hasile = $hasile.'</table>';
					echo '<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
								'.$hasile.' '.$sendstatus.'
						</div>';
				}
			} elseif ($konseptor == 'ubahttepejabat'){
				$getsurat 		= Suratkeluar::where('id', $jumlah)->first();
				$statfile		= $getsurat->paraf1;
				$ceksurat		= explode("-SCO-", $statfile);
				if (isset($ceksurat[1])){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
					return back();
				} else {
					$ceksurat		= explode("-OUT-", $statfile);
					if (isset($ceksurat[1])){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
						return back();
					} else {
						$idpejabat 	= $request->input('set02');
						$cgetpejabat= Pejabatsurat::where('id', $idpejabat)->count();
						if ($cgetpejabat != 0){
							$getpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
							$kode			= $getpejabat->kode;
							$penandatangan	= $getpejabat->pejabat;
							$setttd			= $getpejabat->nama;
						} else {
							$kode			= '-';
							$penandatangan	= '-';
							$setttd			= '-';
						}
						$kerjanya = Suratkeluar::where('id', $jumlah)->update([
							'kodefak' 		=>  $kode,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $penandatangan,
							'namapejabat' 	=>  $setttd,
							'updated_at'	=> 	date("Y-m-d H:i:s")
						]);
						if ($kerjanya){
							echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
									<table class="table table-bordered">
										<tr>
											<td>Tanggal</td>
											<td>Nomor</td>
											<td>Status</td>
										</tr>
										<tr>
											<td>'.$getsurat->tglsurat.'</td>
											<td>'.$getsurat->nomor.'</td>
											<td>Telah di Ubah Ke '.$penandatangan.'</td>
										</tr>
									</table>
							</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
									Sistem Error, mohon ulangi beberapa saat lagi
							</div>';
						}
					}
				}
			} else {
				$nomor				= $request->input('set01');
				$tanggal			= $request->input('set02');
				$klasifikasiarsip	= $request->input('set03');
				$kodepjbt			= $request->input('set04');
				$judul				= $request->input('set05');
				$jenis				= $request->input('set06');
				$tglpjbperundang	= $request->input('set08');
				$idpjbperundang		= $request->input('set09');
				$nmpjbtperundang	= '';
				$nippjbperundang	= '';
				$pjbtperundang		= '';
				$ahrf 				= explode("-", $tanggal);
				$yy 	  			= $ahrf[0];
				$mm 	  			= $ahrf[1];
				$dd 	  			= $ahrf[2];
				$rnamapjbt			= Pejabatsurat::where('id', $kodepjbt)->first();
				if (isset($rnamapjbt->pejabat)){
					$pejabat 			= $rnamapjbt->pejabat;
					$namapjbt 			= $rnamapjbt->nama;
					$nippjbt 			= $rnamapjbt->nip;
					$kodefakultas 		= $rnamapjbt->kode;
					$idpejabat 			= $rnamapjbt->id;
					$jenisnip 			= $rnamapjbt->jenis;
				} else {
					$rnamapjbt			= Pejabatsurat::where('fakultas', 'LIKE', '%'.Session('fakultas').'%')->first();
					$pejabat 			= $rnamapjbt->pejabat;
					$namapjbt 			= $rnamapjbt->nama;
					$nippjbt 			= $rnamapjbt->nip;
					$kodefakultas 		= $rnamapjbt->kode;
					$idpejabat 			= $rnamapjbt->id;
					$jenisnip 			= $rnamapjbt->jenis;
				}
				if ($idpjbperundang != ''){
					$rnamapjbt2			= Pejabatsurat::where('id', $idpjbperundang)->first();
					if (isset($rnamapjbt2->nama)){
						$nmpjbtperundang= $rnamapjbt2->nama;
						$nippjbperundang= $rnamapjbt2->nip;
						$pjbtperundang 	= $rnamapjbt2->pejabat;
					}
				}
				$cekmarking			= Tabelskdanperaturan::orderBy('id', 'DESC')->count();
				if ($cekmarking == 0){
					$setidne		= 1;
				}else {
					$cekmarking		= Tabelskdanperaturan::orderBy('id', 'DESC')->first();
					$lastid			= $cekmarking->id;
					$setidne 		= $lastid+1;
				}
				if ($jenis == 'instruksi'){
					$marking 		= $fakultas.'-INST-'.$yy.$setidne;
					$kelompok		= 'INSTRUKSI';
				} else if ($jenis == 'skdanperaturanrektor'){
					$marking 		= $fakultas.'-PERTOR-'.$yy.$setidne;
					$kelompok		= 'PERATURAN';
				} else {
					$marking 		= $fakultas.'-SKPP-'.$yy.$setidne;
					$kelompok		= 'KEPUTUSAN';
				}
				$ceksek 			= Tabelskdanperaturan::where('kelompok', $kelompok)->where('fakultas', Session('fakultas'))->where('nomor', $nomor)->where('tahun', $yy)->count();
				if ($ceksek == 0){
					$kerjanya 		= Tabelskdanperaturan::insert([
						'id'				=> $setidne,
						'kelompok'			=> $kelompok,
						'marking'			=> $marking,
						'nomor'				=> $nomor,
						'tahun'				=> $yy, 
						'tanggal'			=> $tanggal,
						'penandatangan'		=> $pejabat,
						'idpejabat'			=> $kodepjbt,
						'nmpejabat'			=> $namapjbt,
						'nippejabat'		=> $nippjbt,
						'judul'				=> $judul,
						'scansurat'			=> $marking,
						'idpjbperundang'	=> $idpjbperundang,
						'pjbtperundang'		=> $pjbtperundang,
						'nmpjbtperundang'	=> $nmpjbtperundang,
						'nippjbperundang'	=> $nippjbperundang,
						'tglpjbperundang'	=> $tglpjbperundang,
						'dasarsurat'		=> '',
						'paraf1'			=> '',
						'kodefas'			=> $klasifikasiarsip,
						'kodesub'			=> '',
						'fakultas' 			=> Session('fakultas'),
						'inputor' 			=> Session('id'),
					]);
					if ($kerjanya){
						$monsrt			= (int)$mm;
						$bln 			= $bulan[$monsrt];
						$tlstanggal		= $dd.' '.$bln.' '.$yy;
						$tlsnomor 		= $nomor.' Tahun '.$yy;
						echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
								<table class="table table-bordered">
									<tr>
										<td>Tanggal</td>
										<td>Nomor</td>
										<td>Penulisan Nomor</td>
										<td>Pemohon</td>
									</tr>
									<tr>
										<td>'.$tlstanggal.'</td>
										<td>'.$nomor.'</td>
										<td>'.$tlsnomor.'</td>
										<td>'.Session('nama').'</td>
									</tr>
								</table>
						</div>';
						
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
								Sistem Error, mohon ulangi beberapa saat lagi
						</div>';
					}
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Double..!!</h4>
								Nomor Surat Ganda Terdeteksi, Mohon Ubah Penulisan Nomor Anda (Tambahkan titik/strip) Bila Anda Yakin Menggunakan Nomor Yang sama 
							</div>';
				}
			}
		}
	}
	public function exNomordepan(Request $request) {
		$validator 	= Validator::make($request->all(), [
          'val01' 	=>  'required',
          'val02' 	=> 	'required',
          'val03' 	=> 	'required',
          'val04' 	=> 	'required',
        ]);
		if($validator->fails()) {
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Jumlah, Tanggal, Pejabat, dan Jenis Wajib di Isi']);
			return back();
        } else {
			$idkonseptor		= $request->input('val01');
			$tanggal			= $request->input('val02');
			$jumlah				= $request->input('val03');
			$kodepjbt			= $request->input('val04');
			$sifat				= $request->input('val05');
			$spare				= $request->input('val06');
			$klasifikasiarsip	= $request->input('val07');
			$pemohon			= $request->input('val08');
			$jenissrt			= $request->input('val09');
			$fakultas 			= Session('fakultas');
			$dd1 	  			= date("d");
			$mm1 	  			= date("m");
			$yy1 	  			= date("Y");
			$tlstgl				= $yy1.'-'.$mm1.'-'.$dd1;
			$arrtanggal			= explode("-", $tanggal);
			$yy 				= $arrtanggal[0];
			$mm 				= $arrtanggal[1];
			$dd 				= $arrtanggal[2];
			$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			if ($tlstgl == $tanggal){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tanggal Masa Depan Tidak Boleh Sama dengan Tanggal Hari Ini']);
				return back();
			} else if ($tanggal < $tlstgl){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tanggal Masa Depan Tidak Kurang dari Tanggal Hari Ini']);
				return back();
			} else {
				if ($kodepjbt == ''){ $kodepjbt = 'UN10'; }
				if ($jumlah < 0){$jumlah = 1; }
				if ($klasifikasiarsip != ''){
					$arrkode 		= explode(".", $klasifikasiarsip);
					$unit 			= $arrkode[0];
					$klasifikasiarsip= '';
					if(isset($arrkode[1])){ $klasifikasiarsip = $unit.'.'.$arrkode[1]; }
					if(isset($arrkode[2])){
						if ($arrkode[2] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[2];
						}
					}
					if(isset($arrkode[3])){
						if ($arrkode[3] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[3];
						}
					}
					if(isset($arrkode[4])){
						if ($arrkode[4] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[4];
						}
					}
					
					$perihal		= '';
					$getperihal		= Klasifikasi::where('kodesurat', 'LIKE', $klasifikasiarsip.'%')->orderBy('id', 'ASC')->first();
					$primer			= $getperihal->primer;
					$sekunder		= $getperihal->sekunder;
					$tersier		= $getperihal->tersier;
					$series			= $getperihal->series;
					if ($series != ''){
						$perihal 	= $sekunder.' '.$tersier.' '.$series;
					} else {
						if ($tersier != ''){
							$perihal 	= $sekunder.' '.$tersier;
						} else {
							if ($sekunder != ''){
								$perihal 	= $sekunder;
							} else {
								$perihal 	= $primer;
							}
						}
					}
				} else { $unit = 'TU'; $perihal = ''; }
				$cgetpejabat	= Pejabatsurat::where('kode', $kodepjbt)->count();
				if ($cgetpejabat != 0){
					$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
					$idpejabat		= $getpejabat->id;
					$penandatangan	= $getpejabat->pejabat;
					$setttd			= $getpejabat->nama;
				} else {
					$idpejabat		= '0';
					$penandatangan	= '-';
					$setttd			= '-';
				}
				$ceknomorsrt		= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
				if ($ceknomorsrt == 0){
					$nomor 			= 1;
				} else {
					$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
					$lastno			= $ceknomorsrt->nomor;
					$nomor 			= $lastno+1;
				}
				$ceknomormaju		= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', 'ODR-'.$fakultas)->first();
				if (isset($ceknomormaju->nomor)){
					$nomor			= $ceknomormaju->nomor;
					$nomor 			= $nomor+1;
				} else {
					$nomor 			= $nomor + $spare;
				}
				$i					= 0;
				$idnomor			= 0;
				$hasil				= '';
				$pemohon			= Session('nama');
				$mkelompok			= Session('jabatan');
				$getuser			= User::where('id', $idkonseptor)->first();
				if (isset($getuser->id)){
					$pemohon		= $getuser->nama;
					$mkelompok		= $getuser->previlage;
				}
				$getnomor			= Suratkeluar::orderBy('id', 'DESC')->first();
				if (isset($getnomor->id)){
					$idnomor		= $getnomor->id;
				}
				$idnomor++;
				while($i != $jumlah) {
					$marking 		= $fakultas.'-OUT-'.$yy.$nomor;
					$kerjanya 		= Suratkeluar::insertGetId([
						'marking' 		=>  $marking,
						'jenissrt' 		=>  $jenissrt,
						'nomor' 		=>  $nomor,
						'anakno' 		=>  '',
						'kodefak' 		=>  $kodepjbt,
						'unit' 			=>  $unit,
						'tglsurat' 		=>  $tanggal,
						'daysrt' 		=>  $dd,
						'monsrt' 		=>  $mm,
						'yersrt' 		=>  $yy,
						'dasarsurat' 	=>  '',
						'kepada' 		=>  '',
						'alamat' 		=>  '',
						'perihal' 		=>  $perihal,
						'lampiran' 		=>  '',
						'isisurat' 		=>  $marking.'.pdf',
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $penandatangan,
						'namapejabat' 	=>  $setttd,
						'tembusan' 		=>  '',
						'sifat' 		=>  4,
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  $pemohon,
						'kelompok' 		=>  $mkelompok,
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
						'faskode' 		=>  $klasifikasiarsip,
						'fasmasa' 		=>  '',
						'fasket' 		=>  '',
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  '',
						'font' 			=>  '',
						'ukuran' 		=>  '',
						'lebarttd' 		=>  '',
						'filelampiran' 	=>  '',
						'fakultas' 		=>  'ODR-'.$fakultas
					]);
					$idnomor++;
					$i++;
					$nomor++;
				}
				return response()->json(['status' => 'Sukses', 'message' => 'Simpan Data Pemesanan Nomor Sejumlah '.$jumlah]);
				return back();
			}
		}
    }
	public function updsuratst(Request $request) {
		$validator = Validator::make($request->all(), [
          'stparaf1' 				=>  'required',
          'st_isisurat' 			=> 	'required',
          'st_namapenandatangan' 	=> 	'required',
          'st_konseptor' 			=> 	'required',
          'st_penandatangan' 		=> 	'required',
          'st_kodepjbt' 			=> 	'required',
          'st_jenissurat'			=> 	'required',
        ]);
		if($validator->fails()) {
			Session::flash('status', 'Error');
			Session::flash('message', 'Mohon Lengkapi Isian Form Anda'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
        } else {
			$tanggal		= $request->input('st_tanggal');
			$kodefakultas	= $request->input('st_kodepjbt');
			$unit			= $request->input('st_jenissurat');
			$nmttd			= $request->input('st_namapenandatangan');
			$konseptor		= $request->input('st_konseptor');
			$isisurat		= $request->input('st_isisurat');
			$tembusan		= $request->input('st_tembusan');
			$penandatangan	= $request->input('st_penandatangan');
			$idsurat		= $request->input('st_idsurat');
			$judul			= $request->input('st_judul');
			$dasarthn		= $request->input('st_dasartahun');
			$dasar			= $request->input('st_dasar');
			$paraf1			= $request->input('stparaf1');
			$paraf2			= $request->input('stparaf2');
			$paraf3			= $request->input('stparaf3');
			$paraf4			= $request->input('stparaf4');
			$font			= $request->input('st_font');
			$ukuran			= $request->input('st_ukuran');
			$lebar			= $request->input('st_lebar');
			$kodefas		= $request->input('st_klasifikasiarsip');
			if ($lebar == ''){ $lebar = '40'; }
			$dilarang 		= array("<p>");
			$isisurat 		= str_replace($dilarang, "", $isisurat);
			$dilarang 		= array("</p>");
			$isisurat 		= str_replace($dilarang, "<br />", $isisurat);
			$tgl 			= '';
			$bln 			= '';
			$thn 			= date("Y");
			$mkelompok		= Session('jabatan');
			$pembuat		= Session('nama');
			$fakultas		= Session('fakultas');
			if ($paraf2 == ''){ $paraf2 = '0'; }
			if ($paraf3 == ''){ $paraf3 = '0'; }
			if ($paraf4 == ''){ $paraf4 = '0'; }
			if ($nmttd == 'Rektor' or $nmttd == 'Wakil Rektor Bidang Akademik' or $nmttd == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' or $nmttd == 'Wakil Rektor Bidang Kemahasiswaan, Alumni dan Kewirausahaan Mahasiswa' or $nmttd == 'Wakil Rektor Bidang Perencanaan, Kerjasama dan Internasionalisasi'){ $bolehdewe = 'NO'; }
			else { $bolehdewe = 'YES'; }
			if ($bolehdewe == 'NO' and $paraf1 == 'SELF'){
				Session::flash('status', 'Error');
				Session::flash('message', 'Mohon Maaf, Paraf Sendiri Hanya Boleh Bila Yang Menandatanganinya Selain Rektor / Wakil Rektor'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else {
				$klasaktif 		= '';
				$klasinaktif 	= '';
				$klasket 		= '';
				if ($kodefas != ''){
					$qklasifikasi	= Klasifikasi::where('kodesurat', 'LIKE', $kodefas.'%')->first();
					if (isset($qklasifikasi->aktif)){
						$klasaktif 		= $qklasifikasi->aktif;
						$klasinaktif 	= $qklasifikasi->inaktif;
						$klasket 		= $qklasifikasi->keterangan;
					}
				}
				$rnamapjbt		= Pejabatsurat::where('id', $nmttd)->first();
				$pejabat 		= $rnamapjbt->pejabat;
				$namapjbt 		= $rnamapjbt->nama;
				$nippjbt 		= $rnamapjbt->nip;
				$kodefakultas 	= $rnamapjbt->kode;
				$idpejabat 		= $rnamapjbt->id;
				$jenisnip 		= $rnamapjbt->jenis;
				$emailpenerima 	= $rnamapjbt->email;
				$setttd 		= $namapjbt.'<br />'.$jenisnip.'. '.$nippjbt;
				if ($request->hasFile('st_uploaddasar')) {
					$validator = Validator::make($request->all(), [
						'st_uploaddasar' =>  'mimes:jpeg,jpg,pdf,png,JPEG,JPG,PNG,PDF|max:20000'
					]);
					if ($validator->fails()) {
						Session::flash('status', 'Error');
						Session::flash('message', 'File harus sesuai format(JPG/JPEG/PNG/PDF) dan tidak melebihi dari 20mb.'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}else {
						if ($idsurat == 'new'){
							$cekmarking		= Suratkeluar::orderBy('id', 'DESC')->count();
							if ($cekmarking == 0){
								$nomor 		= 1;
								$marking 	= $fakultas.'-ST-'.$thn.$nomor;
							}else {
								$cekmarking	= Suratkeluar::orderBy('id', 'DESC')->first();
								$lastid		= $cekmarking->id;
								$nomor 		= $lastid+1;
								$marking 	= $fakultas.'-ST-'.$thn.$nomor;
							}
							
							$namafile 		= $fakultas.'-DSR-'.$thn.$nomor;
							$namafile		= $namafile.'.'.$request->file('st_uploaddasar')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('st_uploaddasar');
							$request->file('st_uploaddasar')->move(public_path('scan/files'), $namafile);
							$kerjanya = Suratkeluar::insert([
								'marking' 		=>  $marking,
								'jenissrt' 		=>  $judul,
								'nomor' 		=>  '0',
								'kodefak' 		=>  $kodefakultas,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tanggal,
								'daysrt' 		=>  $tgl,
								'monsrt' 		=>  $bln,
								'yersrt' 		=>  $thn,
								'dasarsurat' 	=>  $namafile,
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  '',
								'lampiran' 		=>  '',
								'isisurat' 		=>  $isisurat,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $pejabat,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  $tembusan,
								'sifat' 		=>  '',
								'klasifikasi' 	=>  '',
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
								'status' 		=>  'NEW',
								'arsip' 		=>  '',
								'footnote' 		=>  '',
								'tandatangan' 	=>  '',
								'paraf1' 		=>  $paraf1,
								'paraf2' 		=>  $paraf2,
								'paraf3' 		=>  $paraf3,
								'paraf4' 		=>  $paraf4,
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',
								'faskode' 		=>  $kodefas,
								'fasmasa' 		=>  $klasaktif,
								'fasket' 		=>  $klasket,
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'font' 			=>  $font,
								'ukuran' 		=>  $ukuran,
								'lebarttd' 		=>  $lebar,
								'fakultas' 		=>  $fakultas,
							]);
							if ($kerjanya){
								$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
								if (isset($qnamapjbt->pejabat)){
									$pejabat 	= $qnamapjbt->pejabat;
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
								} else {
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
								}
								Session::flash('status', 'Success');
								Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input'); 
								Session::flash('alert-class', 'alert-success');
								return back();
							}else{
								Session::flash('status', 'Error');
								Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							}
						}
						else {
							$qdislws	= Suratkeluar::where('id', $idsurat)->first();
							$statsurat 	= $qdislws->status;
							$nomor 		= $qdislws->nomor;
							$marking 	= $qdislws->marking;
							$dasarsurat	= $qdislws->dasarsurat;
							if ($statsurat == 'NEW' OR $mkelompok == 'Sekretaris Rektor' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi'){
								if ($dasarsurat != ''){
									$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
									if ($qcekdasar == 0){
										if (File::exists(base_path() ."/public/scan/files/". $dasarsurat)) {
											File::delete(base_path() ."/public/scan/files/". $dasarsurat);
										}
									}
								}
								$namafile 		= $dasarsurat;
								$namafile		= $namafile.'.'.$request->file('st_uploaddasar')->getClientOriginalExtension();
								$request->file('st_uploaddasar')->move(public_path('scan/files'), $namafile);
								$kerjanya 		= Suratkeluar::where('id', $idsurat)->update([
									'kodefak' 		=>  $kodefakultas,
									'unit' 			=>  $unit,
									'tglsurat' 		=>  $tanggal,
									'daysrt' 		=>  $tgl,
									'monsrt' 		=>  $bln,
									'yersrt' 		=>  $thn,
									'dasarsurat' 	=>  $namafile,
									'isisurat' 		=>  $isisurat,
									'idpejabat' 	=>  $idpejabat,
									'pejabat' 		=>  $pejabat,
									'namapejabat' 	=>  $setttd,
									'tembusan' 		=>  $tembusan,
									'pembuat' 		=>  $konseptor,
									'kelompok' 		=>  $mkelompok,
									'paraf1' 		=>  $paraf1,
									'paraf2' 		=>  $paraf2,
									'paraf3' 		=>  $paraf3,
									'paraf4' 		=>  $paraf4,
									'font' 			=>  $font,
									'ukuran' 		=>  $ukuran,
									'lebarttd' 		=>  $lebar,
								]);
								if ($kerjanya){
									Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
									$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
									if (isset($qnamapjbt->pejabat)){
										$pejabat 	= $qnamapjbt->pejabat;
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
										
									} else {
										SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
									}
									Session::flash('status', 'Success');
									Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
									Session::flash('alert-class', 'alert-info');
									return back();
								}else{
									Session::flash('status', 'Error');
									Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
									Session::flash('alert-class', 'alert-danger');
									return back();
								}
							}else {
								Session::flash('status', 'Error');
								Session::flash('message', 'Hanya Sekpim yang diperbolehkan mengubah data yang sudah diperiksa pimpinan'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							}
						}
					}
				} else {
					$marking1 = $fakultas.'-'.$dasarthn.$dasar;
					$marking2 = $dasarthn.$dasar;
					$datalm1  = Suratmasuk::where('marking', $marking1)->count();
					$datalm2  = Suratmasuk::where('marking', $marking2)->count();
					if ($datalm1 != 0){
						$ceksrtnoagenda	= Suratmasuk::where('marking', $marking1)->first();
						$namafile		= $ceksrtnoagenda->scansurat;
					} else if ($datalm2 != 0){
						$ceksrtnoagenda	= Suratmasuk::where('marking', $marking2)->first();
						$namafile		= $ceksrtnoagenda->scansurat;
					} else {
						$namafile 		= $fakultas.'-'.$thn.'-TnpDasar';
					}
					if ($idsurat == 'new'){
						$cekmarking		= Suratkeluar::orderBy('id', 'DESC')->count();
						if ($cekmarking == 0){
							$nomor 		= 1;
							$marking 	= $fakultas.'-ST-'.$thn.$nomor;
						}else {
							$cekmarking	= Suratkeluar::orderBy('id', 'DESC')->first();
							$lastid		= $cekmarking->id;
							$nomor 		= $lastid+1;
							$marking 	= $fakultas.'-ST-'.$thn.$nomor;
						}
						$kerjanya = Suratkeluar::insert([
							'marking' 		=>  $marking,
							'jenissrt' 		=>  $judul,
							'nomor' 		=>  '0',
							'kodefak' 		=>  $kodefakultas,
							'unit' 			=>  $unit,
							'tglsurat' 		=>  $tanggal,
							'daysrt' 		=>  $tgl,
							'monsrt' 		=>  $bln,
							'yersrt' 		=>  $thn,
							'dasarsurat' 	=>  $namafile,
							'kepada' 		=>  '',
							'alamat' 		=>  '',
							'perihal' 		=>  '',
							'lampiran' 		=>  '',
							'isisurat' 		=>  $isisurat,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $pejabat,
							'namapejabat' 	=>  $setttd,
							'tembusan' 		=>  $tembusan,
							'sifat' 		=>  '',
							'klasifikasi' 	=>  '',
							'pembuat' 		=>  $konseptor,
							'kelompok' 		=>  $mkelompok,
							'status' 		=>  'NEW',
							'arsip' 		=>  '',
							'footnote' 		=>  '',
							'tandatangan' 	=>  '',
							'paraf1' 		=>  $paraf1,
							'paraf2' 		=>  $paraf2,
							'paraf3' 		=>  $paraf3,
							'paraf4' 		=>  $paraf4,
							'ruangarsip' 	=>  '',
							'ordnerarsip' 	=>  '',
							'lemariarsip' 	=>  '',
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  '',
							'fasket' 		=>  '',
							'subkode' 		=>  '',
							'submasa' 		=>  '',
							'subket' 		=>  '',
							'font' 			=>  $font,
							'ukuran' 		=>  $ukuran,
							'lebarttd' 		=>  $lebar,
							'fakultas'		=>	Session('fakultas')
						]);
						if ($kerjanya){
							$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
							if (isset($qnamapjbt->pejabat)){
								$pejabat 	= $qnamapjbt->pejabat;
								SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
							} else {
								SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
							}
							Session::flash('status', 'Success');
							Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input'); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}else{
							Session::flash('status', 'Error');
							Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						}
					}else {
						$qdislws	= Suratkeluar::where('id', $idsurat)->first();
						$statsurat 	= $qdislws->status;
						$nomor 		= $qdislws->nomor;
						$marking 	= $qdislws->marking;
						$dasarsurat	= $qdislws->dasarsurat;
						if ($statsurat == 'NEW' OR $mkelompok == 'Sekretaris Rektor' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi'){
							if ($dasarsurat != ''){
								$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
								if ($qcekdasar == 0){
									if (File::exists(base_path() ."/public/scan/files/". $dasarsurat)) {
									  File::delete(base_path() ."/public/scan/files/". $dasarsurat);
									}
								}
							}
							$kerjanya 			= Suratkeluar::where('id', $idsurat)->update([
								'kodefak' 		=>  $kodefakultas,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tanggal,
								'daysrt' 		=>  $tgl,
								'monsrt' 		=>  $bln,
								'yersrt' 		=>  $thn,
								'dasarsurat' 	=>  $namafile,
								'isisurat' 		=>  $isisurat,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $pejabat,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  $tembusan,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
								'paraf1' 		=>  $paraf1,
								'paraf2' 		=>  $paraf2,
								'paraf3' 		=>  $paraf3,
								'paraf4' 		=>  $paraf4,
								'font' 			=>  $font,
								'ukuran' 		=>  $ukuran,
								'lebarttd' 		=>  $lebar,
							]);
							if ($kerjanya){
								Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
								$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
								if (isset($qnamapjbt->pejabat)){
									$pejabat 	= $qnamapjbt->pejabat;
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
								} else {
									SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUAR','TTD','','1');
								}
								Session::flash('status', 'Success');
								Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
								Session::flash('alert-class', 'alert-info');
								return back();
							}else{
								Session::flash('status', 'Error');
								Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							}
						}else {
							Session::flash('status', 'Error');
							Session::flash('message', 'Hanya Sekpim yang diperbolehkan mengubah data yang sudah diperiksa pimpinan'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						}
					}
				}
			}
		}
    }
	public function updsuratsp(Request $request) {
		$validator = Validator::make($request->all(), [
          'spparaf1' 			=>  'required',
          'sp_isisurat' 		=> 	'required',
          'sp_nama' 			=> 	'required',
          'sp_nip' 				=> 	'required',
          'sp_unit' 			=> 	'required',
        ]);
		if($validator->fails()) {
			Session::flash('status', 'Error');
			Session::flash('message', 'Mohon Lengkapi Isian Form Anda'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
        } else {
			$nama			= $request->input('sp_nama');
			$jenis			= $request->input('sp_jenis');
			$nip			= $request->input('sp_nip');
			$unit			= $request->input('sp_unit');
			$isisurat		= $request->input('sp_isisurat');
			$mengetahui		= $request->input('sp_mengetahui');
			$idsurat		= $request->input('sp_idsurat');
			$paraf1			= $request->input('spparaf1');
			$paraf2			= $request->input('spparaf2');
			$paraf3			= $request->input('spparaf3');
			$paraf4			= $request->input('spparaf4');
			$font			= $request->input('sp_font');
			$ukuran			= $request->input('sp_ukuran');
			$lebar			= $request->input('sp_lebar');
			$kodefas		= $request->input('sp_klasifikasiarsip');
			$sifat			= 'Biasa';
			$konseptor		= Session('nama');
			if ($kodefas != ''){
				$qklasifikasi	= Klasifikasi::where('kodesurat', 'LIKE', $kodefas.'%')->first();
				$klasaktif 		= $qklasifikasi->aktif;
				$klasinaktif 	= $qklasifikasi->inaktif;
				$klasket 		= $qklasifikasi->keterangan;
			} else {
				$klasaktif 		= '';
				$klasinaktif 	= '';
				$klasket 		= '';
			}
			$thn 			= date("Y");
			$dilarang 		= array("<p>");
			$isisurat 		= str_replace($dilarang, "", $isisurat);
			$dilarang 		= array("</p>");
			$isisurat 		= str_replace($dilarang, "<br />", $isisurat);
			$mkelompok		= Session('jabatan');
			$pembuat		= Session('nama');
			$fakultas		= Session('fakultas');
			if ($lebar == ''){ $lebar = '40'; }
			if ($paraf2 == ''){ $paraf2 = '0'; }
			if ($paraf3 == ''){ $paraf3 = '0'; }
			if ($paraf4 == ''){ $paraf4 = '0'; }
			if ($mengetahui != ''){
				$rnamapjbt		= Pejabatsurat::where('id', $mengetahui)->first();
				$pejabat 		= $rnamapjbt->pejabat;
				$namapjbt 		= $rnamapjbt->nama;
				$nippjbt 		= $rnamapjbt->nip;
				$kodefakultas 	= $rnamapjbt->kode;
				$jenisnip 		= $rnamapjbt->jenis;
				$emailpenerima	= $rnamapjbt->email;
				$setttd 		= $namapjbt.'<br />'.$jenisnip.'. '.$nippjbt;
				$bolehdewe 		= 'YES';
			} else { 
				$bolehdewe 		= 'YES';
				$pejabat		= '';
				$namapjbt 		= '';
				$nippjbt 		= '';
				$kodefakultas 	= '';
				$setttd			= '';
				$emailpenerima	= '';
			}
			if ($bolehdewe == 'NO' and $paraf1 == 'SELF'){
				Session::flash('status', 'Error');
				Session::flash('message', 'Mohon Maaf, Paraf Sendiri Hanya Boleh Bila Yang Menandatanganinya Selain Rektor / Wakil Rektor'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else {
				if ($idsurat == 'new'){
					$cekmarking		= Suratkeluartnpnomor::orderBy('id', 'DESC')->count();
					if ($cekmarking == 0){
						$nomor 		= 1;
						$marking 	= $fakultas.'-SP-'.$thn.$nomor;
					}else {
						$cekmarking	= Suratkeluartnpnomor::orderBy('id', 'DESC')->first();
						$lastid		= $cekmarking->id;
						$nomor 		= $lastid+1;
						$marking 	= $fakultas.'-SP-'.$thn.$nomor;
					}
					$kerjanya 	= Suratkeluartnpnomor::insert([
						'marking' 		=>  $marking,
						'jenissrt' 		=>  'SURAT PERNYATAAN',
						'kodefak' 		=>  $kodefakultas,
						'unit' 			=>  $unit,
						'tglbuat' 		=>  date("Y-m-d"),
						'yersrt' 		=>  $thn,
						'dasarsurat' 	=>  $jenis,
						'kepada' 		=>  $nama,
						'alamat' 		=>  $nip,
						'perihal' 		=>  'SURAT PERNYATAAN',
						'lampiran' 		=>  '',
						'isisurat' 		=>  $isisurat,
						'idpejabat' 	=>  $mengetahui,
						'pejabat' 		=>  $pejabat,
						'namapejabat' 	=>  $setttd,
						'tembusan' 		=>  '',
						'sifat' 		=>  '',
						'klasifikasi' 	=>  '',
						'pembuat' 		=>  $pembuat,
						'kelompok' 		=>  $mkelompok,
						'status' 		=>  'NEW',
						'arsip' 		=>  '',
						'footnote' 		=>  '',
						'tandatangan' 	=>  '',
						'paraf1' 		=>  $paraf1,
						'paraf2' 		=>  $paraf2,
						'paraf3' 		=>  $paraf3,
						'paraf4' 		=>  $paraf4,
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',						
						'faskode' 		=>  $kodefas,
						'fasmasa' 		=>  $klasaktif,
						'fasket' 		=>  $klasket,
						'font' 			=>  $font,
						'ukuran' 		=>  $ukuran,
						'lebarttd' 		=>  $lebar,
						'fakultas'		=>  $fakultas,
					]);
					if ($kerjanya){
						$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
						if (isset($qnamapjbt->pejabat)){
							$pejabat 	= $qnamapjbt->pejabat;
							SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUARNONOMER','PARAF','','1');
						} else {
							SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUARNONOMER','TTD','','1');
						}
						Session::flash('status', 'Success');
						Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Input'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					}else{
						Session::flash('status', 'Error');
						Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				}else {
					$qdislws	= Suratkeluartnpnomor::where('id', $idsurat)->first();
					$statsurat 	= $qdislws->status;
					$marking 	= $qdislws->marking;
					$konseptorlm= $qdislws->pembuat;
					if ($konseptorlm == $pembuat OR $statsurat == 'NEW' OR $mkelompok == 'Sekretaris Rektor' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi'){
						$kerjanya = Suratkeluartnpnomor::where('id', $idsurat)->update([
							'kodefak' 		=>  $kodefakultas,
							'unit' 			=>  $unit,
							'dasarsurat' 	=>  $jenis,
							'kepada' 		=>  $nama,
							'alamat' 		=>  $nip,
							'isisurat' 		=>  $isisurat,
							'idpejabat' 	=>  $mengetahui,
							'pejabat' 		=>  $pejabat,
							'namapejabat' 	=>  $setttd,
							'paraf1' 		=>  $paraf1,
							'paraf2' 		=>  $paraf2,
							'paraf3' 		=>  $paraf3,
							'paraf4' 		=>  $paraf4,
							'font' 			=>  $font,
							'ukuran' 		=>  $ukuran,
							'lebarttd' 		=>  $lebar,							
						]);
						if ($kerjanya){
							Inboxsurat::where('marking', $marking)->where('jenis', 'KELUARNONOMER')->delete();
							$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
							if (isset($qnamapjbt->pejabat)){
								$pejabat 	= $qnamapjbt->pejabat;
								SendMail::kiriminbox($marking,$konseptor,$pejabat,$qnamapjbt->email,'KELUARNONOMER','PARAF','','1');
							} else {
								SendMail::kiriminbox($marking,$konseptor,$pejabat,$emailpenerima,'KELUARNONOMER','TTD','','1');
							}
							Session::flash('status', 'Success');
							Session::flash('message', 'Surat Keluar Dengan Marking ID '.$marking.' Sukses di Update'); 
							Session::flash('alert-class', 'alert-info');
							return back();
						}else{
							Session::flash('status', 'Error');
							Session::flash('message', 'Sistem Down, Coba Beberapa Saat Lagi'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						}
					}else {
						Session::flash('status', 'Error');
						Session::flash('message', 'Hanya Sekpim yang diperbolehkan mengubah data yang sudah diperiksa pimpinan'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				}
			}
		}
    }
	public function view($id){
		$ceksrtmasuk		= Suratmasuk::where('id', $id)->count();
		if ($ceksrtmasuk != 0){
			$jceksrtmsk		= Suratmasuk::where('id', $id)->first();
			$document_name	= $jceksrtmsk->scansurat;
			$bentuk			= $jceksrtmsk->bentuk;
			if ($bentuk == Session('namaapps01')){
				return $jceksrtmsk->ringkasan2;
			} else {
				$file 			= base_path().'/public/scan/files/'.$document_name;
				if (file_exists($file)){
					$ext =File::extension($file);
					if($ext=='pdf'){
						$content_types='application/pdf';
					}elseif ($ext=='PDF') {
						$content_types='application/pdf';
					}elseif ($ext=='docx') {
						$content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';  
					}elseif ($ext=='xls') {
						$content_types='application/vnd.ms-excel';  
					}elseif ($ext=='xlsx') {
						$content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';  
					}elseif ($ext=='jpg') {
						$content_types='image/jpg';  
					}elseif ($ext=='jpeg') {
						$content_types='image/jpeg';  
					}elseif ($ext=='png') {
						$content_types='image/png';  
					}elseif ($ext=='PNG') {
						$content_types='image/png';  
					}elseif ($ext=='txt') {
						$content_types='application/octet-stream';  
					}else {
						$content_types='application/octet-stream';
					}
					return response(file_get_contents($file),200)->header('Content-Type',$content_types);
				}else{
					return redirect('trackingid/srtmsk-'.$jceksrtmsk->marking); 
				}
			}
		} else{
			$file =  base_path().'/public/dist/img/hilang.png';
			$content_types='image/png';
			return response(file_get_contents($file),200)->header('Content-Type',$content_types);
		}
    }
	public function viewbyName($id){
		$output_file 	= '/scan/files/'.$id;
		$output_file2 	= '/scan/generate/'.$id;
		
		$cekmarking 	= str_replace(".pdf", "", $id);
		if (file_exists(public_path($output_file))){
			if (Browser::isAndroid()) {
				return redirect('pdftohtml/'.$id);
			} else {
				$file =  public_path('scan/files/'.$id);
				return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
			}
		} else if (file_exists(public_path($output_file2))){
			$file =  public_path('scan/generate/'.$id);
			return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
		} else {
			$cekjenis 	= explode('-', $id);
			if(isset($cekjenis[3])){
				$output_tes1 	= '/scan/files/'.$cekjenis[1].'-'.$cekjenis[2].'-'.$cekjenis[3].'.pdf';
				$output_tes2 	= '/scan/files/'.$cekjenis[1].'-'.$cekjenis[2].'-'.$cekjenis[3];
				if (file_exists(public_path($output_tes1))){
					$file 		=  public_path($output_tes1);
					return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
				} else if (file_exists(public_path($output_tes2))){
					$file 		=  public_path($output_tes2);
					return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
				} else {
					$url		= 'srtklr-'.$cekjenis[1].'-'.$cekjenis[2].'-'.$cekjenis[3].'.pdf';
					return redirect('trackingid/'.$url);
				}
			} else if(isset($cekjenis[2])){
				$output_tes1 	= '/scan/files/'.$cekjenis[1].'-'.$cekjenis[2].'.pdf';
				$output_tes2 	= '/scan/files/'.$cekjenis[1].'-'.$cekjenis[2];
				$output_tes3 	= '/images/'.$cekjenis[1].'/'.$id;
				if (file_exists(public_path($output_tes1))){
					$file 		=  public_path($output_tes1);
					return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
				} else if (file_exists(public_path($output_tes2))){
					$file 		=  public_path($output_tes2);
					return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
				} else if (file_exists($output_tes3)){
					return Storage::download($output_tes3);
				} else {
					$url		= 'srtklr-'.$cekmarking;
					return redirect('trackingid/'.$url);
				}
			} else {
				$url		= 'srtklr-'.$cekmarking;
				return redirect('trackingid/'.$url); 
			}
		}
    }
	public function savebyName($id){
		$output_file 	= '/scan/files/'. $id;
		$headers 		= ['application/pdf'];
		if (file_exists(public_path($output_file))){
			$marking 	= str_replace(".pdf", "", $id);
			$paraf5		= '';
			$getnama 	= Tabelskdanperaturan::where('marking', $marking)->first();
			if (isset($getnama->judul)){
				$marking= $getnama->judul;
			}
			$getnama 	= Suratkeluar::where('marking', $marking)->first();
			if (isset($getnama->perihal)){
				$marking= $getnama->perihal;
				$paraf5	= $getnama->paraf5;
			}
			if ($marking == 'SURAT PERNYATAAN RENCANA PENEMPATAN'){
				$marking = 'SPRP_'.$paraf5;
			}
			$marking 	= str_replace(":", "", $marking);
			$marking 	= str_replace("/", "", $marking);
			$marking 	= str_replace("'", "", $marking);
			$marking	= rawurlencode ($marking);
			$file 		= public_path('scan/files/'.$id);
			return response()->download($file, $marking.'.pdf', $headers);
		} else {
			$marking 	= str_replace(".pdf", "", $id);
			$url		= 'srtklr-'.$marking;
			return redirect('trackingid/'.$url); 
		}
    }
	public function pdfTohtml($id){
		$pdf 		= public_path().'/scan/files/'.$id;
		$headers 	= ['application/pdf'];
		$homebase	= url("/");
		$data 		= [];
		if (file_exists($pdf)){
			$pdf 		= $homebase.'/scan/files/'.$id;
			$tabel 		= '<iframe src="https://docs.google.com/gview?url='.$pdf.'&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>';
			$data['filespdf']	= $tabel;
			return view('cetak.scansurat', $data);
		} else{
			$marking 	= str_replace(".pdf", "", $id);
			$url		= 'srtklr-'.$marking;
			return redirect('trackingid/'.$url); 
		}
    }
	public function getQRCodefile($id){
		$homebase	= url("/");
		$kalender 	= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$ceksek 	= explode("=", $id);
		$namasaja	= '';
		$alamatweb	= $homebase.'/trackingid/srtklr-'.$id;
		if (Session('fakultas') == 'DPM'){
			$qrcode = QrCode::format('png')->merge('https://disaprimamedika.site/dist/img/pt.png', 0.2, true)->size(150)->generate($alamatweb);
		} else if (Session('fakultas') == 'PDP'){
			$qrcode = QrCode::format('png')->merge('https://disaprimamedika.site/dist/img/pdp.png', 0.2, true)->size(150)->generate($alamatweb);
		} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
			$qrcode = QrCode::format('png')->merge('https://disaprimamedika.site/dist/img/rs.png', 0.2, true)->size(150)->generate($alamatweb);
		} else {
			$qrcode = QrCode::format('png')->size(150)->generate($alamatweb);
		}
		$qrcode 	= base64_encode($qrcode);
		$tte		= '<img src="data:image/png;base64,'.$qrcode.'" width="100" height="100"/>';
		$tulisttd= '
			<table width="300" border="0" cellpadding="2" cellspacing="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"> 
				<tr>
					<td width="100">'.$tte.'</td>
					<td width="200" align="left" valign="center">
						<font color="blue">
							Dokumen ditandatangi secara elektronik. Gunakan Pembaca Tandatangan Elektronik Untuk Verifikasi Dokumen Ini
						</font>
					</td>
				</tr>
			</table>';
		$data['marking']   	= $id.'.png';
		$data['surate']   	= $tulisttd;
		return view('cetak.qrimage', $data);
    }
	public function ctkDisposisi(Request $request) {
		$idne			= $request->input('val01');
		$ringkasan2		= '';
		$cinboxsrt		= Suratmasuk::where('id', $idne)->count();
		if ($cinboxsrt != 0){		
			$jinboxsrt		= Suratmasuk::where('id', $idne)->first();
			$noagenda		= $jinboxsrt->noagenda;
			$tglmasuk		= $jinboxsrt->tglmasuk;
			$jenissurat		= $jinboxsrt->jenissurat;
			$nosurat		= $jinboxsrt->nosurat;
			$asalsurat		= $jinboxsrt->asalsurat;
			$kepada			= $jinboxsrt->kepada;
			$perihal		= $jinboxsrt->perihal;
			$subyek			= $jinboxsrt->subyek;
			$ringkasan		= $jinboxsrt->ringkasan;
			$ringkasan2		= $jinboxsrt->ringkasan2;
			$lampiran		= $jinboxsrt->lampiran;
			$sifat			= $jinboxsrt->sifat;
			$bentuk			= $jinboxsrt->bentuk;
			$klasifikasi	= $jinboxsrt->klasifikasi;
			$pembuat		= $jinboxsrt->pembuat;
			$disposisi		= $jinboxsrt->disposisi;
			$tglsurat		= $jinboxsrt->tglsurat;
			$scanfile		= $jinboxsrt->scansurat;
			$homebase		= url("/");
			$jjensurat		= Unitsurat::where('kode', $subyek)->first();
			if (isset($jjensurat->deskripsi)){
				$kodesubdeskripsi= $jjensurat->deskripsi;
			} else {
				$kodesubdeskripsi= $subyek;
			}
			if ($jinboxsrt->bentuk == Session('namaapps01')){
				$ringkasan 	= $jenissurat;
				$ringkasan2 = '';
			} else {
				if($ringkasan == $ringkasan2){
					$ringkasan	= '';
				} else {
					if(is_null($ringkasan2)){
						$arrringkasan= explode(" ", $ringkasan);
						if (isset($arrringkasan[1])){
							$katapertama 	= $arrringkasan[0];
							$katakedua		= $arrringkasan[1];					
							$cekkalimat 	= $katapertama.' '.$katakedua;
							if ($cekkalimat != 'Telah di'){
								$ringkasan2	= $ringkasan;
								$ringkasan	= '';
							}
						}
					} else {
						$ringkasan2 = $ringkasan;
						$ringkasan	= '';
					}
				}
			}
			$isidispoakhir	= '';
			$tulisdisposisi	= '';
			$mkelompok		= Session('jabatan');
			$cekprevilage	= Pejabatsurat::where('pejabat', $mkelompok)->count();
			if ($cekprevilage == 0){ $mkelompok = Session('nama'); }
			$bulan 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			$cekdisposisi	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'ASC')->count();
			if ($cekdisposisi != 0){
				$rdispoakhir	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'DESC')->first();
				$isidispoakhir	= $rdispoakhir->isidisposisi;
				$getdisposisi	= Disposisi::where('idsurat', $idne)->where('keterangan', 'Surat Masuk')->orderby('id', 'ASC')->get();
				foreach($getdisposisi as $rdisposisi) {
					$pemberi			= $rdisposisi->pemberi;
					$isidisposisi		= $rdisposisi->isidisposisi;
					$disposisikpd		= $rdisposisi->kepada;
					$lampiran			= $rdisposisi->lampiran;
					$timestamp			= $rdisposisi->updated_at;
					$sifat				= $rdisposisi->lemari;
					if ($lampiran != ''){
						$isidisposisi 	= $isidisposisi.'<blockquote><p>Lampiran File :</p><a href="'.$homebase.'/viewdocbyname/'.$lampiran.'">Download File Lampiran</a></blockquote>';
					}
					if ($sifat == 'Rahasia'){
						$cekorange = Inboxsurat::where('pengirim', $pemberi)
										->where('penerima', $mkelompok)
										->count();
						if ($cekorange == 0 OR $pemberi != $mkelompok){
							$tulisdisposisi		= $tulisdisposisi.'
							<tr>
							<td align="left" class="kiri atas kanan">'.$timestamp.'</td>
							<td colspan="3" align="left" class="kanan atas">Rahasia</td>
							<td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
							<td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
							</tr>';
						}else {
							$tulisdisposisi		= $tulisdisposisi.'
							<tr>
							<td align="left" class="kiri atas kanan">'.$timestamp.'</td>
							<td colspan="3" align="left" class="kanan atas">'.$isidisposisi.'</td>
							<td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
							<td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
							</tr>';
						}
					}else {
						$tulisdisposisi		= $tulisdisposisi.'
						<tr>
						<td align="left" class="kiri atas kanan">'.$timestamp.'</td>
						<td colspan="3" align="left" class="kanan atas">'.$isidisposisi.'</td>
						<td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
						<td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
						</tr>';
					}
				}
			}else{
				$tulisdisposisi	= '
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>
				<tr>
				<td align="left" class="kiri atas kanan">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td colspan="3" align="left" class="kanan atas">&nbsp;</td>
				<td align="left" class="kanan atas">&nbsp;</td>
				<td align="center" class="kanan atas">&nbsp;</td>
				</tr>';
			}
			$macamdisposisi = '';
			$pindahbaris	= '';
			$nomerdisposisi	= 1;
			$ganapdisposisi	= 1;
			$fakultas		= Session('fakultas');
			$getmacamdispo	= Macamdisposisi::where('fakultas', $fakultas)->orderby('id', 'ASC')->get();
			foreach($getmacamdispo as $rmacamdispo) {
				$tlsdisposisi		= $rmacamdispo->disposisi;
				if ($ganapdisposisi == 1){
					$macamdisposisi	= $macamdisposisi.'<tr><td colspan="3" align="left">'.$nomerdisposisi.'. '.$tlsdisposisi.'</td>';
					$ganapdisposisi = 2;
				} else {
					$macamdisposisi	= $macamdisposisi.'<td align="right">'.$nomerdisposisi.'.&nbsp;</td><td colspan="5" align="left">'.$tlsdisposisi.'</td></tr>';
					$ganapdisposisi = 1;
				}
				$nomerdisposisi++;
			}
			if ($ganapdisposisi == 2){$macamdisposisi = $macamdisposisi.'<td align="right">&nbsp;</td><td colspan="5" align="left">&nbsp;</td></tr>';}
			if ($jinboxsrt->bentuk == Session('namaapps01')){
				$totalcek 					= 0;
			} else {
				$cekhasilkeluar 			= Suratkeluar::where('dasarsurat', $scanfile)->count();
				$cekhasilkeluartnpnomor		= Suratkeluartnpnomor::where('dasarsurat', $scanfile)->count();
				$cekhasilsk 				= Tabelskdanperaturan::where('dasarsurat', $scanfile)->count();
				$totalcek					= $cekhasilkeluar + $cekhasilkeluartnpnomor + $cekhasilsk;
			}
			if ($totalcek == 0){
				$tuliscatatan 			= '
				<tr>
				<td align="left"><strong>Catatan</strong></td>
				<td align="left">:</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				<tr>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
				</tr>
				';
			} 
			else {
				$i 						= 1;
				$tuliscatatan 			= '
				<tr>
				<td align="left"><strong>Catatan</strong></td>
				<td align="left">:</td>
				<td colspan="7" align="left"><strong>Surat Balasan / Tindak Lanjut</strong></td>
				</tr>';
				if ($cekhasilkeluar != 0){
					$hasilkeluar	= Suratkeluar::where('dasarsurat', $scanfile)->get();
					foreach($hasilkeluar as $rhasil){
						$nomor 		= $rhasil->nomor;
						$anakno 	= $rhasil->anakno;
						$kodefak 	= $rhasil->kodefak;
						$unit 		= $rhasil->unit;
						$dd 		= $rhasil->daysrt;
						$mm 		= (int)$rhasil->monsrt;
						$yy			= $rhasil->yersrt;
						$faskode	= $rhasil->faskode;
						$subkode	= $rhasil->subkode;
						$klasifikasi= $rhasil->klasifikasi;
						$perihal	= $rhasil->perihal;
						$bulanne	= $bulan[$mm];
						$tlstanggal	= $dd.' '.$bulanne.' '.$yy;
						if ($anakno != ''){
							$nomor	= $nomor.'.'.$anakno;
						}
						$tlsnomor	= '';
						if ($klasifikasi != ''){
							if ($klasifikasi == 'Biasa'){ $klasifikasi = 'B'; }
							else if ($klasifikasi == 'Rahasia'){ $klasifikasi = 'R'; }
							else if ($klasifikasi == 'Sangat Rahasia'){ $klasifikasi = 'SR'; }
							else if ($klasifikasi == 'Terbatas'){ $klasifikasi = 'T'; }
							else { $klasifikasi = 'L'; }
							$tlsnomor = $klasifikasi.'/'.$nomor.'/'.$kodefak.'/';
						} else {
							$tlsnomor = $nomor.'/'.$kodefak.'/';
						}
						if ($faskode != ''){
							$tlsnomor = $tlsnomor.$faskode.'/'.$yy;
						} else if ($subkode != ''){
							$tlsnomor = $tlsnomor.$subkode.'/'.$yy;
						} else {
							$tlsnomor = $tlsnomor.$unit.'/'.$yy;
						}
						$tuliscatatan	= $tuliscatatan.'
						<tr>
						<td align="left">&nbsp;</td>
						<td align="left" valign="top">'.$i.'. </td>
						<td colspan="7" align="left" valign="top">Surat No. '.$tlsnomor.' Tanggal '.$tlstanggal.' Perihal : '.$perihal.'</td>
						</tr>
						';
						$i++;
					}
				}
				if ($cekhasilsk != 0){
					$jsonskper		= Tabelskdanperaturan::where('dasarsurat', $scanfile)->get();
					foreach($jsonskper as $rhasil2){
						$nomor 			= $rhasil2->nomor;
						$tahunsk		= $rhasil2->tahun;
						$tanggal 		= $rhasil2->tanggal;
						$judul 			= $rhasil2->judul;
						$arrtgl			= explode("-",$tanggal);
						$yy 			= $arrtgl[0];
						$mm				= (int)$arrtgl[1];
						$dd 			= $arrtgl[2];
						$bulanne		= $bulan[$mm];
						$tlstanggal		= $dd.' '.$bulanne.' '.$yy;
						$tuliscatatan	= $tuliscatatan.'
						<tr>
						<td align="left">&nbsp;</td>
						<td align="left" valign="top">'.$i.'. </td>
						<td colspan="7" align="left" valign="top">SK No. '.$nomor.' Tahun '.$tahunsk.' Tanggal '.$tlstanggal.' Tentang '.$judul.'</td>
						</tr>
						';
						$i++;
					}
				}
				if ($cekhasilkeluartnpnomor != 0){
					$jsonsrttnpno		= Suratkeluartnpnomor::where('dasarsurat', $scanfile)->get();
					foreach($jsonsrttnpno as $rhasil3){
						$jenissrt 		= $rhasil3->jenissrt;
						$perihal 		= $rhasil3->perihal;
						$tuliscatatan	= $tuliscatatan.'
						<tr>
						<td align="left">&nbsp;</td>
						<td align="left" valign="top">'.$i.'. </td>
						<td colspan="7" align="left" valign="top">Surat Dinas Tanpa Nomor Perihal '.$perihal.'</td>
						</tr>
						';
						$i++;
					}
				}
			}
			$alamatweb					= $homebase.'/viewsurat/94db1c8fae5b94957265aa3a335dfd3d-'.$idne;
			$printqrcode 				= QrCode::size(150)->generate($alamatweb);
			$swandhanafak       		= Session('fakpanjang');
			$swandhanaalamat    		= config('global.swandhanaalamat');
			$swandhanakemen      		= config('global.swandhanakemen');
			$swandhanauniv      		= config('global.swandhanauniv');
			$data['universitas']   		= $swandhanauniv;
			$data['kementerian']   		= $swandhanakemen;
			$data['fakultas']   		= $swandhanafak;
			$data['kodesubdeskripsi']   = $kodesubdeskripsi;
			$data['subyek']         	= $subyek;
			$data['tglmasuk']         	= $tglmasuk;
			$data['noagenda']           = $noagenda;
			$data['perihal']         	= $perihal;
			$data['ringkasan']          = $ringkasan;
			$data['ringkasan2']         = $ringkasan2;
			$data['asalsurat']          = $asalsurat;
			$data['kepada']            	= $kepada;
			$data['tglsurat']           = $tglsurat;
			$data['nosurat']           	= $nosurat;
			$data['tulisdisposisi']   	= $tulisdisposisi;
			$data['macamdisposisi']   	= $macamdisposisi;
			$data['printqrcode']   		= $printqrcode;
			$data['scanfile']   		= '';
			$data['tuliscatatan']   	= $tuliscatatan;
			return view('cetak.templatedisposisi', $data);
		} else {
			$data = [];
			return view('errors', $data);
		}
    }
	public function ctkKendaliarsip(Request $request) {
		$bulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$idne		= $request->input('val01');
		$hasil		= Suratkeluar::where('id', $idne)->first();
		$marking 	= $hasil->marking;
		$status 	= $hasil->status;
		$nomor 		= $hasil->nomor;
		$klasifikasi= $hasil->klasifikasi;
		$jenissrt	= $hasil->jenissrt;
		$perihal	= $hasil->perihal;
		$dasarsurat	= $hasil->dasarsurat;
		$daysrt 	= $hasil->daysrt;
		$isisurat 	= $hasil->isisurat;
		$unit 		= $hasil->unit;
		$monsrt 	= (int)$hasil->monsrt;
		$yersrt		= $hasil->yersrt;
		$faskode	= $hasil->faskode;
		$kepada		= $hasil->kepada;
		$alamat		= $hasil->alamat;
		$kepada		= $kepada.'<br />'.$alamat;
		$bulane		= $bulan[$monsrt];
		$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
		$jjensurat	= Unitsurat::where('kode', $unit)->count();
		if ($jjensurat != 0){
			$jjensurat	= Unitsurat::where('kode', $unit)->first();
			$deskunit	= $jjensurat->deskripsi;
		} else {
			if ($faskode != ''){ $unitcari = $faskode; }
			else { $unitcari = $unit; }
			$ceklain = Klasifikasi::where('kodesurat', 'LIKE', $unitcari.'%')->count();
			if ($ceklain != 0){
				$getlain = Klasifikasi::where('kodesurat', 'LIKE', $unitcari.'%')->first();
				$deskunit= $getlain->primer;
			} else { $deskunit = $unit; }
		}
		if ($hasil->anakno != ''){ $nomor = $nomor.'.'.$hasil->anakno; }
		if ($klasifikasi == 'Biasa'){
			$tlsnomor = 'B/'.$nomor;
		} else if ($klasifikasi == 'Rahasia'){
			$tlsnomor = 'R/'.$nomor;
		} else if ($klasifikasi == 'Sangat Rahasia'){
			$tlsnomor = 'SR/'.$nomor;
		} else if ($klasifikasi == 'Terbatas'){
			$tlsnomor = 'T/'.$nomor;
		} else if ($klasifikasi == 'Lainnya'){
			$tlsnomor = 'L/'.$nomor;
		} else {
			$tlsnomor = $nomor;
		}
		if ($hasil->faskode != ''){
			$tlsnomor = $nomor.'/'.$hasil->kodefak.'/'.$hasil->faskode.'/'.$yersrt;
		} else {
			$tlsnomor = $nomor.'/'.$hasil->kodefak.'/'.$hasil->unit.'/'.$yersrt;
		}
		$tuliscatatan 			= '
			<tr>
			  <td align="left"><strong>Catatan</strong></td>
			  <td align="left">:</td>
			  <td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
			</tr>
			<tr>
			  <td align="left">&nbsp;</td>
			  <td align="left">&nbsp;</td>
			  <td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td>
			</tr>
			';
		$homebase					= url("/");
		$alamatweb					= $homebase.'/viewsurat/01c6da6fc99433f846fc567b20f02f3a-'.$idne;
		$printqrcode 				= QrCode::size(150)->generate($alamatweb);
		$swandhanafak       		= Session('fakpanjang');
        $swandhanaalamat    		= config('global.swandhanaalamat');
        $swandhanakemen      		= config('global.swandhanakemen');
        $swandhanauniv      		= config('global.swandhanauniv');
		$data['universitas']   		= $swandhanauniv;
		$data['kementerian']   		= $swandhanakemen;
		$data['fakultas']   		= $swandhanafak;
		$data['kodesubdeskripsi']   = $deskunit;
		$data['subyek']         	= $unit;
		$data['nomor']           	= $nomor;
		$data['perihal']         	= $perihal;
		$data['asalsurat']          = $hasil->pejabat;
		$data['lampiran']          	= $hasil->lampiran;
		$data['kepada']            	= $kepada;
		$data['konseptor']          = $hasil->pembuat;
		$data['tglsurat']           = $tglsurat;
		$data['nosurat']           	= $tlsnomor;
		$data['printqrcode']   		= $printqrcode;
		$data['tuliscatatan']   	= $tuliscatatan;
		return view('cetak.kendalikeluar', $data);
    }
	public function chatGetlist(Request $request) {
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		$gravatar1 	= Session('photo');
		$gravatar1	= str_replace("https://sco.ub.ac.id/", "", $gravatar1);
		$gravatar1	= str_replace("http://sco.swandhana.test/", "", $gravatar1);
	    
		$gravatar2 	= 'logo-ub.png';
		$isipesan	= '';
		if ($kelompok == 'mahasiswa' OR $kelompok == 'mahasiswa magister' OR $kelompok == 'mahasiswa doktoral'){
			$qcatting	= Chatting::where('nama', 'mahasiswa')->orderBy('id', 'DESC')->limit(100)->get();
		} else {
			$qcatting	= Chatting::where('nama', '!=', 'mahasiswa')->orderBy('id', 'DESC')->limit(100)->get();
		}
		
		foreach ($qcatting as $chat) {
    		$pesan 		= $chat->pesannya;
			$waktu 		= $chat->created_at;
			$nama 		= $chat->email;
			$gravatar 	= $chat->gravatar;
			$nama		= str_replace("@ub.ac.id", "", $nama);
			$gravatar	= str_replace("https://sco.ub.ac.id/", "", $gravatar);
			$gravatar	= str_replace("http://sco.swandhana.test/", "", $gravatar);
	    	if ($nama == $nmlengkap){
				if ($gravatar != ''){ $gravatar1 = $gravatar;}
				$isipesan = $isipesan.'<div class="direct-chat-msg left">
				  <div class="direct-chat-success clearfix">
					<span class="direct-chat-name pull-right">'.$nama.'</span>
					<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
				  </div>
				  <img class="direct-chat-img" src="/'.$gravatar1.'" alt="message user image" />
				  <div class="direct-chat-text">
					'.$pesan.'
				  </div>
				</div>';
			} else {
				if ($gravatar != ''){ $gravatar2 = $gravatar;}
				$isipesan = $isipesan.'<div class="direct-chat-msg right">
				  <div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-right">'.$nama.'</span>
					<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
				  </div>
				  <img class="direct-chat-img" src="/'.$gravatar2.'" alt="message user image" />
				  <div class="direct-chat-text">
					'.$pesan.'
				  </div>
				</div>';
			}
    	}
		echo $isipesan;
    }
	public function cattingSurat(Request $request) {
		$nmlengkap	= Session('nama');
		$pesan		= $request->input('val01');
		$kelompok	= $request->input('val02');
		if ($kelompok != 'mahasiswa'){
			$kelompok	= Session('jabatan');
		}
		if ($pesan != ''){
			$pesan			= str_replace(':)', '&#128522;', $pesan);
			$pesan			= str_replace('T_T', '&#128557;', $pesan);
			$pesan			= str_replace('>.<', '&#128518;', $pesan);
			$pesan			= str_replace('^_v', '&#128540;', $pesan);
			$pesan			= str_replace('<', '&le;', $pesan);
			$pesan			= str_replace('>', '&ge;', $pesan);
			$pesan			= str_replace('.', '&sdot;', $pesan);
			Chatting::insert([
				'email'  		=>  $nmlengkap,
				'nama'  		=>  $kelompok,
				'pesannya'		=>  $pesan.'<br />'.Session('fakpanjang').' - '.Session('jabatan'),
				'gravatar'		=>  Session('photo'),
			]);
		}
		$gravatar1 	= Session('photo');
		$gravatar1	= str_replace("https://sco.ub.ac.id/", "", $gravatar1);
	    $gravatar1	= str_replace("http://sco.swandhana.test/", "", $gravatar1);
	    $gravatar2 	= 'logo-ub.png';
		$isipesan	= '';
		if ($kelompok == 'mahasiswa'){
			$qcatting	= Chatting::where('nama', 'mahasiswa')->orderBy('id', 'DESC')->limit(100)->get();
		} else {
			$qcatting	= Chatting::where('nama', '!=', 'mahasiswa')->orderBy('id', 'DESC')->limit(100)->get();
		}
		$isipesan = $isipesan.'<div class="direct-chat-msg left">
				<div class="direct-chat-success clearfix">
				  <span class="direct-chat-name pull-right">SCO - BOT</span>
				  <span class="direct-chat-timestamp pull-left">now</span>
				</div>
				<img class="direct-chat-img" src="/'.$gravatar2.'" alt="message user image" />
				<div class="direct-chat-text">
				  Terimakasih, Obrolan ini tidak difungsikan untuk menyampaikan informasi ke Staf Administrasi manapun, dan hanya digunakan untuk obrolan santai saja.
				</div>
			  </div>';
		foreach ($qcatting as $chat) {
    		$pesan 		= $chat->pesannya;				
			$waktu 		= $chat->created_at;
			$nama 		= $chat->nama;
			$gravatar 	= $chat->gravatar;
			$gravatar	= str_replace("https://sco.ub.ac.id/", "", $gravatar);
			$gravatar	= str_replace("http://sco.swandhana.test/", "", $gravatar);
	    	if ($nama == $nmlengkap){
				if ($gravatar != ''){ $gravatar1 = $gravatar;}
				$isipesan = $isipesan.'<div class="direct-chat-msg left">
				  <div class="direct-chat-success clearfix">
					<span class="direct-chat-name pull-right">'.$nama.'</span>
					<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
				  </div>
				  <img class="direct-chat-img" src="/'.$gravatar1.'" alt="message user image" />
				  <div class="direct-chat-text">
					'.$pesan.'
				  </div>
				</div>';
			} else {
				if ($gravatar != ''){ $gravatar2 = $gravatar;}
				$isipesan = $isipesan.'<div class="direct-chat-msg right">
				<div class="direct-chat-info clearfix">
				  <span class="direct-chat-name pull-right">'.$nama.'</span>
				  <span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
				</div>
				<img class="direct-chat-img" src="/'.$gravatar2.'" alt="message user image" />
				<div class="direct-chat-text">
				  '.$pesan.'
				</div>
			  </div>';
			}
    	}
		echo $isipesan;
    }
	public function deleteSrtmasuk(Request $request) {
    	$idne       = $request->input('val01');
		$jenis 		= '';
		$jenis      = ($request->input('val02') == null ? $jenis : $request->input('val02'));
		$datalm   	= Suratmasuk::where('id', $idne)->first();
		if (isset($datalm->noagenda)){
			$noagenda	= $datalm->noagenda;
			$marking	= $datalm->marking;
			$nosurat	= $datalm->nosurat;
			$asalsurat	= $datalm->asalsurat;
			$nmfilelm	= $datalm->scansurat;
			$pembuat	= $datalm->pembuat;
			$lampiran	= $datalm->lampiran;
			if ($jenis == 'undo'){
				$cekdata = Inboxsurat::where('marking', $marking)->where('email', Session('email'))->orderBy('id', 'DESC')->first();
				if (isset($cekdata->id)){
					$lampiran = $cekdata->lampiran;
					Inboxsurat::where('id', $cekdata->id)->update([
						'status'		=> 'send',
					]);
					File::delete(public_path() ."/scan/files/". $lampiran);
					$kepada 	= $cekdata->kepada;
					$penerima 	= $cekdata->penerima;
					$cekada 	= Inboxsurat::where('id', '>', $cekdata->id)->where('marking', $marking)->where('pengirim', $penerima)->where('penerima', $kepada)->first();
					if (isset($cekada->id)){
						Inboxsurat::where('id', $cekada->id)->delete();
					}
					return response()->json(['status' => 'Success.!', 'message' => 'Surat Dengan ID : '.$idne.' kami kembalikan ke atas']);
				} else {
					return response()->json(['status' => 'Error.!', 'message' => 'Surat Dengan ID : '.$idne.' Tidak ditemukan dalam inbox']);
				}
			} else {
				if ($pembuat == Session('email')){
					File::delete(public_path() ."/scan/files/". $nmfilelm);
					File::delete(public_path() ."/scan/files/". $lampiran);
					$deldata   	= Suratmasuk::find($idne);
					$deldata->delete();
					$nmlengkap	= Session('nama');
					$kelakuan 	= 'Delete Surat Masuk No. Agenda '.$noagenda.' Nomor Surat '.$nosurat.' Kode Marking '.$marking;
					Inboxsurat::where('marking', $marking)->update([
						'status'		=> 'deleted',
					]);
					Inboxsurat::insert([
						'marking'  		=> $marking,
						'pengirim'  	=> Session('jabatan'),
						'penerima'		=> 'Trash Bin',
						'email'			=> $pembuat,
						'sifat'			=> 5,
						'status'		=> 'deleted',
						'jenis'			=> 'MASUK',
						'kerja'			=> '',
						'catatan'		=> '',
						'tandatangan'	=> '',
						'tanggal'		=> '',
						'idsurat' 		=> $datalm->id,
						'noagenda' 		=> $datalm->noagenda,
						'tglsurat' 		=> date("Y-m-d"),
						'jenissrt' 		=> $datalm->jenissurat,
						'nosurat' 		=> '',
						'kepada' 		=> '',
						'perihal' 		=> $datalm->perihal,
						'alamat' 		=> '',
						'lampiran' 		=> '',
						'kodefak' 		=> '',
						'klasifikasi' 	=> '',
						'pembuat' 		=> $pembuat,
						'unit' 			=> '',
						'tabel' 		=> $datalm->fakultas,
						'footnote'		=> $kelakuan
					]);
					return response()->json(['status' => 'Success', 'message' => 'Surat Dengan No. Agenda : '.$noagenda.' Dengan No. Surat : '.$nosurat.' Dari : '. $asalsurat.' Berhasil di Hapus']);
				
				} else {
					$cekinboxsrt= Inboxsurat::where('marking', $marking)->where('jenis', '=', 'MASUK')->orderBy('id', 'DESC')->count();
					if ($cekinboxsrt > 1){
						return response()->json(['status' => 'GAGAL..!!!', 'message' => 'Surat Dengan No. Agenda : '.$noagenda.' Dengan No. Surat : '.$nosurat.' Dari : '. $asalsurat.' Sudah di Disposisi Pimpinan, Sehingga tidak boleh dihapus']);
					} else {
						if ($nmfilelm == ''){
							$ceksek 	= Suratmasuk::where('ringkasan2', $datalm->ringkasan2)->where('id', '!=', $idne)->count();
						} else {
							$ceksek 	= Suratmasuk::where('scansurat', $nmfilelm)->where('id', '!=', $idne)->count();
							$cekarray	= explode('-', $marking);
							if (isset($cekarray[1])){
								$fakpenerima 	= $cekarray[0];
								$fakpengirim 	= $cekarray[1];
								$ceksek 		= Suratmasuk::where('fakultas', $fakpengirim)->count();
							}
						}
						if ($ceksek == 0 AND $nmfilelm != ''){
							$cekmarking = explode("-", $marking);
							if (isset($cekmarking[1])){
								$fakultaspengirim 	= $cekmarking[1];
								$ceksekpengirim 	= User::where('fakultas', $fakultaspengirim)->count();
							} else {
								$ceksekpengirim		= 0;
							}
							if ($ceksekpengirim == 0){
								if (File::exists(public_path() ."/scan/files/". $nmfilelm)) {
									File::delete(public_path() ."/scan/files/". $nmfilelm);
								}
							}
						}
						$deldata   	= Suratmasuk::find($idne);
						$deldata->delete();
						$nmlengkap	= Session('nama');
						$kelakuan 	= 'Delete Surat Masuk No. Agenda '.$noagenda.' Nomor Surat '.$nosurat.' Kode Marking '.$marking;
						Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->delete();
						Histories::insert([
							'siapa'		=> $nmlengkap,
							'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
						]);
						return response()->json(['status' => 'Success', 'message' => 'Surat Dengan No. Agenda : '.$noagenda.' Dengan No. Surat : '.$nosurat.' Dari : '. $asalsurat.' Berhasil di Hapus']);
					}
				}
			}
		} else {
			return response()->json(['status' => 'Error.!', 'message' => 'Surat Dengan ID : '.$idne.' Tidak ditemukan']);
				
		}
    }
	public function deleteInbox(Request $request) {
    	$idne       = $request->input('val01');
		$cekinboxsrt= Inboxsurat::where('id', $idne)->first();
		if (isset($cekinboxsrt->marking)){
			$marking	= $cekinboxsrt->marking;
			$jenis		= $cekinboxsrt->jenis;
			$pengirim	= $cekinboxsrt->pengirim;
			$penerima	= $cekinboxsrt->penerima;
			if ($jenis == 'MASUK' OR $jenis == 'PEMERIKSAAN'){
				$ceksrte = Suratmasuk::where('marking', $marking)->count();
				if ($ceksrte != 0){
					$mkelompok		= Session('jabatan');
					$cekprevilage	= Pejabatsurat::where('pejabat', $mkelompok)->count();
					if ($cekprevilage == 0){ $mkelompok = Session('nama'); }
					$cekinbox		= Inboxsurat::where('marking', $marking)->where('pengirim', $mkelompok)->count();
					
					$jceksrtmsk	= Suratmasuk::where('marking', $marking)->first();
					$idsurat	= $jceksrtmsk->id;
					$jcekdispo	= Disposisi::where('idsurat', $idsurat)
									->where('kepada', 'LIKE', '%'.$mkelompok.'%')
									->where('keterangan', 'Surat Masuk')
									->count();
					if ($cekinbox != 0){
						Inboxsurat::where('marking', $marking)->where('penerima', $mkelompok)->update([
							'status' => 'reply'
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses..!!!', 'message' => 'Inbox Mark as Reply']);
					} else if ($jcekdispo == 0 AND $pengirim != 'Tata Usaha'){
						Inboxsurat::where('marking', $marking)->where('penerima', $mkelompok)->delete();
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses..!!!', 'message' => 'Inbox Deleted']);
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Kami masih membutuhkan disposisi anda.']);
					}
				} else {
					$deletesrt = Inboxsurat::where('id', $idne)->delete();
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses..!!!', 'message' => 'Inbox Deleted']);
				}
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'ID '.$idne.' Tidak Valid, Mohon Menyegarkan kembali tampilan laman ini']);		
		}
    }
	public function hapussrtKeluar(Request $request) {
    	$idne       = $request->input('val01');
		$jensrt     = $request->input('val02');
		$tabel      = $request->input('val03');
		$previlage	= Session('previlage');
		if ($tabel == 'KELUARNONOMER'){
			$qdislws		= Suratkeluartnpnomor::where('id', $idne)->first();
			if (isset($qdislws->id)){
				$tandatangan 	= $qdislws->tandatangan;
				$marking 		= $qdislws->marking;
				$dasarsurat		= $qdislws->dasarsurat;
				if ($jensrt == 'TTE' AND $qdislws->tandatangan != ''){
					Suratkeluartnpnomor::where('id', $idne)->update([
						'status'	=> 'Arsip',
						'arsip'		=> 'Archieved By '.Session('nama').' at '.date("Y-m-d H:i:s"),
					]);
					return response()->json(['status' => 'Success', 'message' => 'Surat Dengan Marking ID : '.$marking.' Berhasil di Arsipkan']);
					return back();
				
				} else {
					if ($dasarsurat != ''){
						$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
						if ($qcekdasar == 0){
							if (File::exists(base_path() ."/public/scan/files/". $dasarsurat)) {
								File::delete(base_path() ."/public/scan/files/". $dasarsurat);
							}
						}
					}
					Suratkeluartnpnomor::where('id', $idne)->delete();
					Inboxsurat::where('marking', $marking)->where('jenis', 'KELUARNONOMER')->delete();
					$nmlengkap	= Session('nama');
					$kelakuan 	= 'Delete Surat Keluar Tanpa Nomor Kode Marking '.$marking;
					Histories::insert([
						'siapa'		=> $nmlengkap,
						'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
					]);
					return response()->json(['status' => 'Success', 'message' => 'Surat Dengan Marking ID : '.$marking.' Berhasil di Hapus']);
					return back();
				}
			} else {
				return response()->json(['status' => 'Success', 'message' => 'Surat Dengan Marking ID : '.$idne.' Tidak di temukan']);
				return back();
			}
			
		} else if ($tabel == 'skdanperaturan' OR $tabel == 'SKDANPERATURAN'){
			$qdislws	= Tabelskdanperaturan::where('id', $idne)->first();
			if (isset($qdislws->nomor)){
				$marking 	= $qdislws->marking;
				$nomor 		= $qdislws->nomor;
				$tahun 		= $qdislws->tahun;
				$tandatangan= $qdislws->tandatangan;
				if ($tandatangan == 'Auto' OR $tandatangan == 'Proses' OR $tandatangan == ''){
					Tabelskdanperaturan::where('id', $idne)->delete();
					Inboxsurat::where('marking', $marking)->where('jenis', $tabel)->delete();
					$nmlengkap	= Session('nama');
					$kelakuan 	= 'Delete SK Nomor'.$nomor.' Tahun '.$tahun;
					Histories::insert([
						'siapa'		=> $nmlengkap,
						'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
					]);
					if (File::exists(base_path() ."/public/scan/files/".$marking.'.pdf')) {
						File::delete(base_path() ."/public/scan/files/".$marking.'.pdf');
					}
					if (File::exists(base_path() ."/public/scan/asli/".$marking.'.pdf')) {
						File::delete(base_path() ."/public/scan/asli/".$marking.'.pdf');
					}
					
					return response()->json(['status' => 'Success', 'message' => $kelakuan.' Berhasil']);
					return back();
				} else {
					$pesan = 'Delete';
					if ($jensrt == 'TTE'){
						Tabelskdanperaturan::where('id', $idne)->update([
							'arsip'		=> 'Archieved By '.Session('nama').' at '.date("Y-m-d H:i:s"),
							'updated_at'=> date("Y-m-d H:i:s")
						]);
						$pesan = 'Archieved';
					} else {
						Tabelskdanperaturan::where('id', $idne)->update([
							'inputor' 	=> Session('nama'),
							'fakultas'	=> 'DELETED',
							'catatan'	=> 'Dihapus Oleh '.Session('nama').' Pada '.date("Y-m-d H:i:s"),
							'updated_at'=> date("Y-m-d H:i:s")
						]);
						Inboxsurat::insert([
							'marking'  		=>  $marking,
							'pengirim'  	=>  Session('nama'),
							'penerima'		=>  'Trash Bin',
							'email'			=> 	'Arsip',
							'status'		=>  'Deleted',
							'sifat'			=>  '0',
							'jenis'			=>  'MASUK',
							'kerja'			=>  'PENGHAPUSAN',
							'catatan'		=>  $tabel,
							'tandatangan'	=>  '',
							'tanggal'		=>  '',
						]);
						if (File::exists(base_path() ."/public/scan/files/".$marking.'.pdf')) {
							File::delete(base_path() ."/public/scan/files/".$marking.'.pdf');
						}
						if (File::exists(base_path() ."/public/scan/asli/".$marking.'.pdf')) {
							File::delete(base_path() ."/public/scan/asli/".$marking.'.pdf');
						}
					}
					return response()->json(['status' => 'Success', 'message' => $pesan.' SK '.$qdislws->judul]);
					return back();
				}
			} else {
				return response()->json(['status' => 'Success', 'message' => 'Delete Draft SK Gagal, ID SK '.$idne.' Tidak di Temukan']);
				return back();
			}
		} else if ($tabel == 'MANUAL'){
			$qdislws		= Suratkeluar::where('id', $idne)->first();
			$tandatangan 	= $qdislws->tandatangan;
			$marking 		= $qdislws->marking;
			$isisurat		= $qdislws->isisurat;
			$dasarsurat		= $qdislws->dasarsurat;
			$nomor			= $qdislws->nomor;
			$nomorlanjut	= $nomor + 1;
			if (File::exists(base_path() ."/public/scan/files/".$marking.".pdf")) {
				File::delete(base_path() ."/public/scan/files/".$marking.".pdf");
			}
			if (File::exists(base_path() ."/public/scan/generate/".$marking.".pdf")) {
				File::delete(base_path() ."/public/scan/generate/".$marking.".pdf");
			}
			if (File::exists(base_path() ."/public/scan/asli/".$marking.".pdf")) {
				File::delete(base_path() ."/public/scan/asli/".$marking.".pdf");
			}
			if (File::exists(base_path() ."/public/scan/files/".$isisurat)) {
				File::delete(base_path() ."/public/scan/files/".$isisurat);
			}
			if ($dasarsurat != ''){
				$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
				if ($qcekdasar == 0){
					if (File::exists(base_path() ."/public/scan/files/".$dasarsurat)) {
						File::delete(base_path() ."/public/scan/files/".$dasarsurat);
					}
				}
			}
			$ceksek 	= Suratkeluar::where('fakultas', Session('fakultas'))->where('nomor', $nomorlanjut)->where('yersrt', $qdislws->yersrt)->count();
			$nmlengkap	= Session('nama');
			$kelakuan 	= 'Delete Surat Keluar Kode Nomor '.$nomor.' Tahun '.$qdislws->yersrt.' Perihal : '.$qdislws->perihal;
			
			if ($ceksek != 0){
				if (Session('previlage') == 'Tata Usaha' OR Session('spesial') == 'Admin SIDOKAR' OR Session('previlage') == 'Sekretaris'){
					Suratkeluar::where('id', $idne)->update([
						'jenissrt'		=> 'UPLOAD',
						'perihal'		=> '',
						'paraf1'		=> '',
						'paraf2'		=> '',
						'paraf3'		=> '',
						'paraf4'		=> '',
						'tandatangan'	=> '',
						'status'		=> 'NEW',
						'isisurat'		=> '',
						'arsip'			=> '',
						'dasarsurat'	=> ''
					]);
				} else {
					Suratkeluar::where('id', $idne)->update([
						'jenissrt'		=> 'UPLOAD',
						'pembuat' 		=> 'Slot Nomor Mundur',
						'kelompok'		=> 'Tata Usaha',
						'perihal'		=> '',
						'paraf1'		=> '',
						'paraf2'		=> '',
						'paraf3'		=> '',
						'paraf4'		=> '',
						'tandatangan'	=> '',
						'status'		=> 'NEW',
						'arsip'			=> '',
						'isisurat'		=> '',
						'dasarsurat'	=> ''
					]);
				}
			} else {
				Suratkeluar::where('id', $idne)->delete();
			}
			Penerimasurat::where('idsurat', $idne)->where('jenis', 'KELUAR')->delete();
			Inboxsurat::insert([
				'marking'  		=>  $marking,
				'pengirim'  	=>  Session('nama'),
				'penerima'		=>  'Trash Bin',
				'email'			=> 	'Arsip',
				'status'		=>  'Deleted',
				'sifat'			=>  '0',
				'jenis'			=>  'MASUK',
				'kerja'			=>  'PENGHAPUSAN',
				'footnote'		=>  $kelakuan,
				'catatan'		=>  '',
				'tandatangan'	=>  '',
				'tanggal'		=>  '',
			]);
			Histories::insert([
				'siapa'		=> $nmlengkap,
				'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
			]);
			return response()->json(['status' => 'Success', 'message' => 'Surat Dengan Marking ID : '.$marking.' Berhasil di Hapus']);
			return back();
		} else if ($tabel == 'draftskdanperaturan'){
			$qdislws	= Draftsk::where('id', $idne)->first();
			if (isset($qdislws->jenissk)){
				$jenissk 	= $qdislws->jenissk;
				$arsip 		= $qdislws->arsip;
				$marking 	= $qdislws->marking;
				$konseptor 	= $qdislws->konseptor;
				$paraf1 	= $qdislws->paraf1;
				$ceksudah	= explode("-SCO-", $paraf1);
				$ttd		= 'Belum';
				$hakaksess	= 'Tidak';
				if (isset($ceksudah[1])){
					$ttd	= 'Sudah';
				}
				if ($konseptor == Session('nama')){ $hakaksess = 'Boleh'; }
				if ($konseptor == Session('previlage')){ $hakaksess = 'Boleh'; }
				if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){ $hakaksess = 'Boleh'; }
				if (Session('previlage') == 'developer'){ $hakaksess = 'Boleh'; }
				$cekkirim	= Penerimasurat::where('keterangan', 'LIKE', $jenissk)->where('idsurat', $qdislws->id)->count();
				if ($cekkirim != 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Draft SK  '.$jenissk.' sudah di kirim ke penerima, mohon menghapus terlebih dahulu di penerima surat']);
					return back();
				}else {
					if ($ttd == 'Sudah' AND $hakaksess == 'Tidak'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Draft SK  '.$jenissk.' sudah di tandatangani dan hanya konseptor surat yang berhak menghapus data ini']);
						return back();
					} else {
						$kelakuan 	= Session('nama').' Delete Draft SK '.$jenissk.' Nomor SK '.$qdislws->nomor.' Tentang '.$qdislws->jenissk.' an. '.$qdislws->nama.' NIP/NIK : '.$qdislws->nip.' Pada Tanggal '.date("Y-m-d H:i:s");
						Draftsk::where('id', $idne)->update([
							'jenissk'		=> $jenissk.'-deleted',
							'nomor'			=> '0',
							'tahun'			=> '0000',
							'tanggalsk'		=> '0000-00-00',
							'arsip'			=> '1',
							'status'		=> 'ARSIP',
							'idpeg'			=> '0',
							'catatan'		=> $kelakuan,
						]);
						Inboxsurat::insert([
							'marking'  		=>  $marking,
							'pengirim'  	=>  Session('nama'),
							'penerima'		=>  'Trash Bin',
							'email'			=> 	'Arsip',
							'status'		=>  'Deleted',
							'sifat'			=>  '0',
							'jenis'			=>  'MASUK',
							'kerja'			=>  'PENGHAPUSAN',
							'catatan'		=>  $tabel,
							'tandatangan'	=>  '',
							'tanggal'		=>  '',
						]);
						if (File::exists(base_path() ."/public/scan/files/".$marking.'.pdf')) {
							File::delete(base_path() ."/public/scan/files/".$marking.'.pdf');
						}
						if (File::exists(base_path() ."/public/scan/asli/".$marking.'.pdf')) {
							File::delete(base_path() ."/public/scan/asli/".$marking.'.pdf');
						}
						Histories::insert([
							'siapa'		=> Session('nama'),
							'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
						]);
						
						return response()->json(['status' => 'Success', 'message' => 'Delete Draft SK '.$jenissk.' Berhasil di Hapus']);
						return back();
					}
				}
			} else {
				return response()->json(['status' => 'Success', 'message' => 'Delete Draft SK Gagal, ID SK '.$idne.' Tidak di Temukan']);
				return back();
			}
		} else {
			$qdislws	= Suratkeluar::where('id', $idne)->first();
			if (isset($qdislws->marking)){
				$statsurat 	= $qdislws->status;
				$nomor 		= $qdislws->nomor;
				$marking 	= $qdislws->marking;
				$kepada 	= $qdislws->kepada;
				$dasarsurat	= $qdislws->dasarsurat;
				$isisurat	= $qdislws->isisurat;
				$status		= $qdislws->status;
				$filelamp	= $qdislws->filelampiran;
				$kelompoklm	= $qdislws->kelompok;
				if ($jensrt == 'TTE' AND $qdislws->tandatangan != ''){
					Suratkeluar::where('id', $idne)->update([
						'arsip'		=> 'Archieved By '.Session('nama').' at '.date("Y-m-d H:i:s"),
					]);
					return response()->json(['status' => 'Success', 'message' => 'Surat Dengan Marking ID : '.$marking.' Berhasil di Arsipkan']);
					return back();
				
				} else {
					$nomorlanjut= $nomor + 1;
					if ($dasarsurat != ''){
						$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarsurat)->count();
						if ($qcekdasar == 0){
							if (File::exists(base_path() ."/public/scan/files/".$dasarsurat)) {
								File::delete(base_path() ."/public/scan/files/".$dasarsurat);
							}
						}
					}
					if ($filelamp != ''){
						if (File::exists(base_path() ."/public/scan/files/".$filelamp)) {
							File::delete(base_path() ."/public/scan/files/".$filelamp);
						}
					}
					if (File::exists(base_path() ."/public/scan/files/".$marking.'.pdf')) {
						File::delete(base_path() ."/public/scan/files/".$marking.'.pdf');
					}
					if (File::exists(base_path() ."/public/scan/asli/".$marking.'.pdf')) {
						File::delete(base_path() ."/public/scan/asli/".$marking.'.pdf');
					}
					$ceksek = Suratkeluar::where('fakultas', Session('fakultas'))->where('nomor', $nomorlanjut)->where('yersrt', $qdislws->yersrt)->count();
					if ($ceksek != 0){
						if (Session('previlage') == 'Tata Usaha' OR Session('spesial') == 'Admin SIDOKAR' OR Session('previlage') == 'Sekretaris'){
							if ($kelompoklm == 'Tata Usaha'){
								Suratkeluar::where('id', $idne)->update([
									'pembuat' 		=> 'Slot Nomor Mundur',
									'kelompok'		=> 'Tata Usaha',
									'perihal'		=> '',
									'paraf1'		=> '',
									'paraf2'		=> '',
									'paraf3'		=> '',
									'paraf4'		=> '',
									'tandatangan'	=> '',
									'status'		=> 'NEW',
									'arsip'			=> '',
									'isisurat'		=> '',
									'dasarsurat'	=> ''
								]);
							} else {
								Suratkeluar::where('id', $idne)->update([
									'perihal'		=> '',
									'paraf1'		=> '',
									'paraf2'		=> '',
									'paraf3'		=> '',
									'paraf4'		=> '',
									'tandatangan'	=> '',
									'status'		=> 'NEW',
									'arsip'			=> '',
									'isisurat'		=> '',
									'dasarsurat'	=> ''
								]);
							}
						} else {
							Suratkeluar::where('id', $idne)->update([
								'pembuat' 		=> 'Slot Nomor Mundur',
								'kelompok'		=> 'Tata Usaha',
								'perihal'		=> '',
								'paraf1'		=> '',
								'paraf2'		=> '',
								'paraf3'		=> '',
								'paraf4'		=> '',
								'tandatangan'	=> '',
								'status'		=> 'NEW',
								'isisurat'		=> '',
								'dasarsurat'	=> ''
							]);
						}
					} else {
						Suratkeluar::where('id', $idne)->delete();
					}
					Suratmasuk::where('marking', $marking)->where('kepada', $kepada)->delete();
					Penerimasurat::where('idsurat', $idne)->where('jenis', 'KELUAR')->delete();
					AntrianTTE::where('idsurat', $idne)->where('jenis', 'KELUAR')->delete();
					Inboxsurat::where('marking', $marking)->delete();
					$nmlengkap	= Session('nama');
					$kelakuan 	= 'Delete Surat Keluar Kode Nomor '.$nomor.' Tahun '.$qdislws->yersrt.' Perihal : '.$qdislws->perihal;
					Histories::insert([
						'siapa'		=> $nmlengkap,
						'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
					]);
					return response()->json(['status' => 'Success', 'message' => 'Surat Dengan Marking ID : '.$marking.' Berhasil di Hapus']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
				return back();
			}
		}
    }
	public function undoDisposisi(Request $request) {
    	$idsurat    = $request->input('val01');
		$idinbox    = $request->input('val02');
		$marking    = $request->input('val03');
		if ($marking == 'KELUAR'){
			if ($idinbox == 'nama'){
				$cekinbox= Inboxsurat::where('marking', $marking)->where('penerima', Session('jabatan'))->count();
				if ($cekinbox != 0){
					$kerjanya 	= Inboxsurat::where('penerima', Session('jabatan'))
									->where('marking', $marking)
									->update([
										'status' 		=>  'send',
										'catatan' 		=>  'undo',
										'updated_at' 	=>  date("Y-m-d H:i:s"),
									]);
					if ($kerjanya){
						return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
						return back();
					}
				} else {
					$cekinbox= Inboxsurat::where('marking', $marking)->where('penerima', Session('nama'))->count();
					if ($cekinbox != 0){
						$kerjanya 	= Inboxsurat::where('penerima', Session('nama'))
										->where('marking', $marking)
										->update([
											'status' 		=>  'send',
											'catatan' 		=>  'undo',
											'updated_at' 	=>  date("Y-m-d H:i:s"),
										]);
						if ($kerjanya){
							return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Surat dengan ID '.$idsurat.' Penerima '.Session('nama').' Tidak di Temukan']);
						return back();
					}
				}
			} else {
				$datalm   	= Inboxsurat::where('id', $idinbox)->first();
				$pengirim	= $datalm->pengirim;
				$penerima	= $datalm->penerima;
				$kerjanya 	= Inboxsurat::where('penerima', $penerima)
								->where('marking', $datalm->marking)
								->update([
									'status' 		=>  'send',
									'catatan' 		=>  'undo',
									'updated_at' 	=>  date("Y-m-d H:i:s"),
								]);
				if ($kerjanya){
					return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
					return back();
				}	
			}
		} else {
			if ($idinbox == 'nama'){
				$kerjanya = null; 
				$cekinbox= Inboxsurat::where('marking', $marking)->where('penerima', Session('jabatan'))->count();
				if ($cekinbox != 0){
					$datalm   	= Inboxsurat::where('marking', $marking)->where('penerima', Session('jabatan'))->first();
					$pengirim	= $datalm->pengirim;
					$penerima	= $datalm->penerima;
					$kerjanya 	= Inboxsurat::where('penerima', Session('jabatan'))
									->where('marking', $marking)
									->update([
										'status' 		=>  'send',
										'catatan' 		=>  'undo',
										'updated_at' 	=>  date("Y-m-d H:i:s"),
									]);
				} else {
					$cekinbox	= Inboxsurat::where('marking', $marking)->where('penerima', Session('nama'))->count();
					if ($cekinbox != 0){
						$datalm   	= Inboxsurat::where('marking', $marking)->where('penerima', Session('nama'))->first();
						$pengirim	= $datalm->pengirim;
						$penerima	= $datalm->penerima;
						$kerjanya 	= Inboxsurat::where('penerima', Session('nama'))
										->where('marking', $marking)
										->update([
											'status' 		=>  'send',
											'catatan' 		=>  'undo',
											'updated_at' 	=>  date("Y-m-d H:i:s"),
										]);
						
					} else {
						$pengirim 	= '';
						$penerima	= '';
					}
				}
				if ($kerjanya){
					if ($penerima == 'Rektor'){
						Disposisi::where('idsurat', $idsurat)
								->where('keterangan', 'Surat Masuk')
								->delete();
						Inboxsurat::where('marking', $marking)
									->where('penerima', '!=', $penerima)
									->where('jenis', 'MASUK')
									->delete();
	
					} else if ( $penerima == 'Wakil Rektor Bidang Akademik' OR $penerima == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' OR $penerima == 'Wakil Rektor Bidang Kemahasiswaan, Alumni dan Kewirausahaan Mahasiswa' OR $penerima == 'Wakil Rektor Bidang Perencanaan, Kerjasama dan Internasionalisasi'){
						$getalldispo = Inboxsurat::where('marking', $marking)
									->where('pengirim', $penerima)
									->where('jenis', 'MASUK')
									->get();
						if (!empty($getalldispo)){
							foreach($getalldispo as $rdispo){
								$valkirim	= $rdispo->pengirim;
								$valterima	= $rdispo->penerima;
								Disposisi::where('idsurat', $idsurat)
									->where('pemberi', $valkirim)
									->where('keterangan', 'Surat Masuk')
									->delete();
								Inboxsurat::where('marking', $marking)
									->where('pengirim', $valkirim)
									->where('jenis', 'MASUK')
									->delete();
								$getalldispoterima1 = Inboxsurat::where('marking', $marking)
									->where('pengirim', $valterima)
									->where('jenis', 'MASUK')
									->get();
								if (!empty($getalldispoterima1)){
									foreach($getalldispoterima1 as $rdispoterima1){
										$setkirim1	= $rdispoterima1->pengirim;
										$setterima1	= $rdispoterima1->penerima;
										Disposisi::where('idsurat', $idsurat)
											->where('pemberi', $setkirim1)
											->where('keterangan', 'Surat Masuk')
											->delete();
										Inboxsurat::where('marking', $marking)
											->where('pengirim', $setkirim1)
											->where('jenis', 'MASUK')
											->delete();
										$getalldispoterima2 = Inboxsurat::where('marking', $marking)
											->where('pengirim', $setterima1)
											->where('jenis', 'MASUK')
											->get();
										if (!empty($getalldispoterima2)){
											foreach($getalldispoterima2 as $rdispoterima2){
												$setkirim2	= $rdispoterima2->pengirim;
												$setterima2	= $rdispoterima2->penerima;
												Disposisi::where('idsurat', $idsurat)
													->where('pemberi', $setkirim2)
													->where('keterangan', 'Surat Masuk')
													->delete();
												Inboxsurat::where('marking', $marking)
													->where('pengirim', $setkirim2)
													->where('jenis', 'MASUK')
													->delete();
											}
										}
									}
								}
							}
						}
					} else {
						Disposisi::where('idsurat', $idsurat)
									->where('pemberi', $penerima)
									->where('keterangan', 'Surat Masuk')
									->delete();
						Inboxsurat::where('marking', $marking)
									->where('pengirim', $penerima)
									->where('jenis', 'MASUK')
									->delete();
					}
					return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Surat dengan ID '.$idsurat.' Marking '.$marking.' Penerima '.Session('nama').' ('.Session('jabatan').') Tidak di Temukan']);
					return back();
				}
			} else {
				$datalm   	= Inboxsurat::where('id', $idinbox)->first();
				if (isset($datalm->pengirim)){
					$pengirim	= $datalm->pengirim;
					$penerima	= $datalm->penerima;
					$kerjanya 	= Inboxsurat::where('marking', $marking)
									->where('penerima', $penerima)
									->where('jenis', 'MASUK')
									->update([
										'status' 		=>  'send',
										'catatan' 		=>  'undo',
										'updated_at' 	=>  date("Y-m-d H:i:s"),
									]);
					if ($kerjanya){
						if ($penerima == 'Rektor'){
							Disposisi::where('idsurat', $idsurat)
									->where('keterangan', 'Surat Masuk')
									->delete();
							Inboxsurat::where('marking', $marking)
										->where('penerima', '!=', $penerima)
										->where('jenis', 'MASUK')
										->delete();
		
						} else if ( $penerima == 'Wakil Rektor Bidang Akademik' OR $penerima == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' OR $penerima == 'Wakil Rektor Bidang Kemahasiswaan, Alumni dan Kewirausahaan Mahasiswa' OR $penerima == 'Wakil Rektor Bidang Perencanaan, Kerjasama dan Internasionalisasi'){
							$getalldispo = Inboxsurat::where('marking', $marking)
										->where('pengirim', $penerima)
										->where('jenis', 'MASUK')
										->get();
							if (!empty($getalldispo)){
								foreach($getalldispo as $rdispo){
									$valkirim	= $rdispo->pengirim;
									$valterima	= $rdispo->penerima;
									Disposisi::where('idsurat', $idsurat)
										->where('pemberi', $valkirim)
										->where('keterangan', 'Surat Masuk')
										->delete();
									Inboxsurat::where('marking', $marking)
										->where('pengirim', $valkirim)
										->where('jenis', 'MASUK')
										->delete();
									$getalldispoterima1 = Inboxsurat::where('marking', $marking)
										->where('pengirim', $valterima)
										->where('jenis', 'MASUK')
										->get();
									if (!empty($getalldispoterima1)){
										foreach($getalldispoterima1 as $rdispoterima1){
											$setkirim1	= $rdispoterima1->pengirim;
											$setterima1	= $rdispoterima1->penerima;
											Disposisi::where('idsurat', $idsurat)
												->where('pemberi', $setkirim1)
												->where('keterangan', 'Surat Masuk')
												->delete();
											Inboxsurat::where('marking', $marking)
												->where('pengirim', $setkirim1)
												->where('jenis', 'MASUK')
												->delete();
											$getalldispoterima2 = Inboxsurat::where('marking', $marking)
												->where('pengirim', $setterima1)
												->where('jenis', 'MASUK')
												->get();
											if (!empty($getalldispoterima2)){
												foreach($getalldispoterima2 as $rdispoterima2){
													$setkirim2	= $rdispoterima2->pengirim;
													$setterima2	= $rdispoterima2->penerima;
													Disposisi::where('idsurat', $idsurat)
														->where('pemberi', $setkirim2)
														->where('keterangan', 'Surat Masuk')
														->delete();
													Inboxsurat::where('marking', $marking)
														->where('pengirim', $setkirim2)
														->where('jenis', 'MASUK')
														->delete();
												}
											}
										}
									}
								}
							}
						} else {
							Disposisi::where('idsurat', $idsurat)
										->where('pemberi', $penerima)
										->where('keterangan', 'Surat Masuk')
										->delete();
							Inboxsurat::where('marking', $marking)
										->where('pengirim', $penerima)
										->where('jenis', 'MASUK')
										->delete();
						}
						return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
					}
				} else {
					$datalm   	= Inboxsurat::where('marking', $marking)->first();
					if (isset($datalm->pengirim)){
						$cekinbox= Inboxsurat::where('marking', $marking)->where('penerima', Session('jabatan'))->count();
						if ($cekinbox != 0){
							$kerjanya 	= Inboxsurat::where('penerima', Session('jabatan'))
											->where('marking', $marking)
											->update([
												'status' 		=>  'send',
												'catatan' 		=>  'undo',
												'updated_at' 	=>  date("Y-m-d H:i:s"),
											]);
							if ($kerjanya){
								return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
								return back();
							}
						} else {
							$cekinbox= Inboxsurat::where('marking', $marking)->where('penerima', Session('nama'))->count();
							if ($cekinbox != 0){
								$kerjanya 	= Inboxsurat::where('penerima', Session('nama'))
												->where('marking', $marking)
												->update([
													'status' 		=>  'send',
													'catatan' 		=>  'undo',
													'updated_at' 	=>  date("Y-m-d H:i:s"),
												]);
								if ($kerjanya){
									return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox ']);
									return back();
								} else {
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, Silahkan coba beberapa saat lagi']);
									return back();
								}
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Surat dengan ID '.$idsurat.' Penerima '.Session('nama').' Tidak di Temukan']);
								return back();
							}
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, ID Tidak Valid '.$idinbox.', Silahkan refresh kembali halaman ini']);
					}
				}
			}
			
		}
    }
	public function goAntrinomor(Request $request) {
		$bulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    	$idsurat    = $request->input('val01');
		$konseptor  = $request->input('val02');
		$tabel  	= $request->input('val03');
		$fakultas	= Session('fakultas');
		$datalm   	= Suratkeluar::where('id', $idsurat)->first();
		$nomor		= $datalm->nomor;
		if ($nomor != 0){
			return response()->json(['status' => 'Info', 'message' => 'Surat Sudah ada Nomornya, Silahkan Cetak / Arsipkan']);
		}else if ($tabel == 'KELUARNONOMER'){
			return response()->json(['status' => 'Info', 'message' => 'Surat ini tidak perlu diberi nomor, silahkan arsipkan']);
		}else {
			$dd 	  		= date("d");
			$mm 	  		= date("m");
			$yy 	  		= date("Y");
			$thncari		= $yy.'-%';
			$tlstgl			= $yy.'-'.$mm.'-'.$dd;
		
			$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
			if ($ceknomorsrt == 0){
				$nomor 		= 1;
			}else {
				$ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
				$lastno		= $ceknomorsrt->nomor;
				$nomor 		= $lastno+1;
			}
			$kerjanya = Suratkeluar::where('id', $idsurat)->update([
				'nomor' 		=>  $nomor,
				'anakno' 		=>  '',
				'tglsurat' 		=>  $tlstgl,
				'daysrt' 		=>  $dd,
				'monsrt' 		=>  $mm,
				'yersrt' 		=>  $yy,
			]);
			$gceksrtklr		= Suratkeluar::where('id', $idsurat)->first();
			$marking 		= $gceksrtklr->marking;
			$daysrt 		= $gceksrtklr->daysrt;
			$monsrt 		= (int)$gceksrtklr->monsrt;
			$yersrt			= $gceksrtklr->yersrt;
			$nomor 			= $gceksrtklr->nomor;
			$anakno			= $gceksrtklr->anakno;
			$kodefak		= $gceksrtklr->kodefak;
			$unit 			= $gceksrtklr->unit;
			$klasifikasi 	= $gceksrtklr->klasifikasi;
			$faskode		= $gceksrtklr->faskode;
			$bulan 			= $bulan[$monsrt];
			$tlstanggal		= $daysrt.' '.$bulan.' '.$yersrt;
			if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
			/*
			if ($klasifikasi == 'Biasa'){
				$nomor = 'B/'.$nomor;
			} else if ($klasifikasi == 'Rahasia'){
				$nomor = 'R/'.$nomor;
			} else if ($klasifikasi == 'Sangat Rahasia'){
				$nomor = 'SR/'.$nomor;
			} else if ($klasifikasi == 'Terbatas'){
				$nomor = 'T/'.$nomor;
			} else if ($klasifikasi == 'Lainnya'){
				$nomor = 'L/'.$nomor;
			} else {
				$nomor = $nomor;
			}
			*/
			if ($faskode != ''){
				//$tlsnomor = $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yersrt;
				$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
			} else {
				$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
			}
			if ($kerjanya){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Register Surat Keluar Berhasil dengan Nomor : '.$tlsnomor.' Tanggal '.$tlstanggal]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Penomoran Gagal, Silahkan Coba Beberapa Saat Lagi']);
				return back();
			}
		}
    }
	public function cekDasarsurat(Request $request) {
    	$nomer    = $request->input('val01');
		$tahun    = $request->input('val02');
		$fakultas = Session('fakultas');
		$homebase = url("/");
		$marking1 = $fakultas.'-'.$tahun.$nomer;
		$marking2 = $tahun.$nomer;
		$datalm1  = Suratmasuk::where('marking', $marking1)->count();
		$datalm2  = Suratmasuk::where('marking', $marking2)->count();
		if ($datalm1 != 0){
			$jceksrtmsk		= Suratmasuk::where('marking', $marking1)->first();
			$document_name	= $jceksrtmsk->scansurat;
			echo $homebase.'/viewdocbyname/'.$document_name;
		}else if ($datalm2 != 0){
			$jceksrtmsk		= Suratmasuk::where('marking', $marking2)->first();
			$document_name	= $jceksrtmsk->scansurat;
			echo $homebase.'/viewdocbyname/'.$document_name;
		}else {
			echo $homebase.'/dist/img/hilang.png';
		}
    }
	public function genNomorsrtklr(Request $request) {
		$idsurat	= $request->input('val01');
		$iddispos	= $request->input('val02');
		$kerja		= $request->input('val03');
		$fakultas	= Session('fakultas');
		$ceksurate	= Suratkeluar::where('id', $idsurat)->first();
		$nmlama		= $ceksurate->nomor;
		$tglsuratlm	= $ceksurate->tglsurat;
		$perihallm	= $ceksurate->perihal;
		$bulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			
		if ($nmlama	!= 0){
			if ($iddispos != 'URUT'){
				$ahrf 		= explode("-", $kerja);
				$iddispos	= (int)$iddispos;
				if(isset($ahrf[0])){ $yy = $ahrf[0]; } else { $yy == ''; }
				if(isset($ahrf[1])){ $mm = $ahrf[1]; } else { $mm == ''; }
				if(isset($ahrf[2])){ $dd = $ahrf[2]; } else { $dd == ''; }
				if ($yy == '' OR $mm == '' OR $dd == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Cek Tanggal Anda dan Pastikan Formatnya adalah YYYY-MM-DD']);
					return back();
				} else if ($iddispos == 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Nomor Tidak Boleh di Set 0']);
					return back();
				} else {
					$cektanggal	= Suratkeluar::where('id', '!=', $idsurat)->where('nomor', $iddispos)->where('yersrt', $yy)->where('fakultas', $fakultas)->count();
					if ($cektanggal == 0){
						$nmlengkap	= Session('nama');
						$kelakuan 	= 'Edit Nomor '.$nmlama.' Tanggal '.$tglsuratlm.' Tentang '.$perihallm.' Menjadi Nomor '.$iddispos.' Tertanggal '.$kerja;
						Histories::insert([
							'siapa'		=> $nmlengkap,
							'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
						]);
						$kerjanya = Suratkeluar::where('id', $idsurat)->update([
							'nomor' 		=>  $iddispos,
							'tglsurat' 		=>  $kerja,
							'daysrt' 		=>  $dd,
							'monsrt' 		=>  $mm,
							'yersrt' 		=>  $yy,
						]);
						$getsuratdata	= Suratkeluar::where('id', $idsurat)->first();
						$marking 		= $gceksrtklr->marking;
						$daysrt 		= $gceksrtklr->daysrt;
						$monsrt 		= (int)$gceksrtklr->monsrt;
						$yersrt			= $gceksrtklr->yersrt;
						$nomor 			= $gceksrtklr->nomor;
						$anakno			= $gceksrtklr->anakno;
						$kodefak		= $gceksrtklr->kodefak;
						$unit 			= $gceksrtklr->unit;
						$klasifikasi 	= $gceksrtklr->klasifikasi;
						$faskode		= $gceksrtklr->faskode;
						$bulan 			= $bulan[$monsrt];
						$tlstanggal		= $daysrt.' '.$bulan.' '.$yersrt;
						if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
						if ($klasifikasi == 'Biasa'){
							$snomor = 'B/'.$nomor;
						} else if ($klasifikasi == 'Rahasia'){
							$snomor = 'R/'.$nomor;
						} else if ($klasifikasi == 'Sangat Rahasia'){
							$snomor = 'SR/'.$nomor;
						} else if ($klasifikasi == 'Terbatas'){
							$snomor = 'T/'.$nomor;
						} else if ($klasifikasi == 'Lainnya'){
							$snomor = 'L/'.$nomor;
						} else {
							$snomor = $nomor;
						}
						if ($faskode != ''){
							//$tlsnomor = $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yersrt;
							//nek sido pake yg atas maka nomor = snomor
							$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
						} else {
							$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Register Surat Keluar Berhasil dengan Nomor : '.$tlsnomor.' Tanggal '.$tlstanggal]);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Nomor Sudah di Gunakan']);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Surat ini telah dinomor i sebelumnya']);
				return back();
			}
		}else {
			if ($kerja == 'AUTO'){
				$dd 	  	= date("d");
				$mm 	  	= date("m");
				$yy 	  	= date("Y");
				$thncari	= $yy.'-%';
				$tlstgl		= $yy.'-'.$mm.'-'.$dd;
				$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
				if ($ceknomorsrt == 0){
					$nomor 		= 1;
				}else {
					$ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
					$lastno		= $ceknomorsrt->nomor;
					$nomor 		= $lastno+1;
				}
				$kerjanya = Suratkeluar::where('id', $idsurat)->update([
					'nomor' 		=>  $nomor,
					'anakno' 		=>  '',
					'tglsurat' 		=>  $tlstgl,
					'daysrt' 		=>  $dd,
					'monsrt' 		=>  $mm,
					'yersrt' 		=>  $yy,
				]);
				$gceksrtklr		= Suratkeluar::where('id', $idsurat)->first();
				$marking 		= $gceksrtklr->marking;
				$daysrt 		= $gceksrtklr->daysrt;
				$monsrt 		= (int)$gceksrtklr->monsrt;
				$yersrt			= $gceksrtklr->yersrt;
				$nomor 			= $gceksrtklr->nomor;
				$anakno			= $gceksrtklr->anakno;
				$kodefak		= $gceksrtklr->kodefak;
				$unit 			= $gceksrtklr->unit;
				$klasifikasi 	= $gceksrtklr->klasifikasi;
				$faskode		= $gceksrtklr->faskode;
				$bulan 			= $bulan[$monsrt];
				$tlstanggal		= $daysrt.' '.$bulan.' '.$yersrt;
				if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
				if ($klasifikasi == 'Biasa'){
					$snomor = 'B/'.$nomor;
				} else if ($klasifikasi == 'Rahasia'){
					$snomor = 'R/'.$nomor;
				} else if ($klasifikasi == 'Sangat Rahasia'){
					$snomor = 'SR/'.$nomor;
				} else if ($klasifikasi == 'Terbatas'){
					$snomor = 'T/'.$nomor;
				} else if ($klasifikasi == 'Lainnya'){
					$snomor = 'L/'.$nomor;
				} else {
					$snomor = $nomor;
				}
				if ($faskode != ''){
					//$tlsnomor = $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yersrt;
					//nek sido pake yg atas maka nomor = snomor
					$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
				} else {
					$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Register Surat Keluar Berhasil dengan Nomor : '.$tlsnomor.' Tanggal '.$tlstanggal]);
				return back();
			}else {
				$ahrf 		= explode("-", $kerja);
				$yy 	  	= $ahrf[0];
				$mm 	  	= $ahrf[1];
				$dd 	  	= $ahrf[2];
				$cektanggal	= Suratkeluar::where('tglsurat', $kerja)->where('fakultas', $fakultas)->count();
				if ($cektanggal != 0){
					$ceknomorsrt	= Suratkeluar::where('tglsurat', $kerja)->where('fakultas', $fakultas)->first();
					$nomor 			= $ceknomorsrt->nomor;
					$cekanaknomer	= Suratkeluar::where('tglsurat', $tlstgl)->where('anakno', '!=', '')->where('fakultas', $fakultas)->count();
					if ($cekanaknomer == 0){
						$anakno 	= $cekanaknomer + 1;
					}else {
						$ranaknomer	= Suratkeluar::where('tglsurat', $tlstgl)->where('anakno', '!=', '')->where('fakultas', $fakultas)->orderBy('anakno', 'DESC')->first();
						$cekanaknmr	= $ranaknomer->anakno;
						$anakno 	= $cekanaknmr + 1;
					}
					$tulisnomor		= $nomor.'.'.$anakno;
					
					$kerjanya = Suratkeluar::where('id', $idsurat)->update([
						'nomor' 		=>  $nomor,
						'anakno' 		=>  $anakno,
						'tglsurat' 		=>  $kerja,
						'daysrt' 		=>  $dd,
						'monsrt' 		=>  $mm,
						'yersrt' 		=>  $yy,
					]);
					$getsuratdata	= Suratkeluar::where('id', $idsurat)->first();
					$marking 		= $gceksrtklr->marking;
					$daysrt 		= $gceksrtklr->daysrt;
					$monsrt 		= (int)$gceksrtklr->monsrt;
					$yersrt			= $gceksrtklr->yersrt;
					$nomor 			= $gceksrtklr->nomor;
					$anakno			= $gceksrtklr->anakno;
					$kodefak		= $gceksrtklr->kodefak;
					$unit 			= $gceksrtklr->unit;
					$klasifikasi 	= $gceksrtklr->klasifikasi;
					$faskode		= $gceksrtklr->faskode;
					$bulan 			= $bulan[$monsrt];
					$tlstanggal		= $daysrt.' '.$bulan.' '.$yersrt;
					if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
					if ($klasifikasi == 'Biasa'){
						$snomor = 'B/'.$nomor;
					} else if ($klasifikasi == 'Rahasia'){
						$snomor = 'R/'.$nomor;
					} else if ($klasifikasi == 'Sangat Rahasia'){
						$snomor = 'SR/'.$nomor;
					} else if ($klasifikasi == 'Terbatas'){
						$snomor = 'T/'.$nomor;
					} else if ($klasifikasi == 'Lainnya'){
						$snomor = 'L/'.$nomor;
					} else {
						$snomor = $nomor;
					}
					if ($faskode != ''){
						//$tlsnomor = $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yersrt;
						//nek sido pake yg atas maka nomor = snomor
						$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
					} else {
						$tlsnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Register Surat Keluar Berhasil dengan Nomor : '.$tlsnomor.' Tanggal '.$tlstanggal]);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Nomor Mundur hanya berlaku untuk tanggal yang pernah memproses surat keluar']);
					return back();
				}
			}
		}
    }
	public function exmanualsrtklrmaju(Request $request) {
    	$validator = Validator::make($request->all(), [
			'edit_perihal' 		=>  'required',
			'edit_jenissurat' 	=> 	'required',
			'edit_idne' 		=> 	'required',
        ]);
		if($validator->fails()) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Perihal dan Jenis Surat Wajib di Isi']);
			return back();
        }else {
			$mnama				= Session('nama');
			$mkelompok			= Session('previlage');
			$fakultas			= Session('fakultas');
			$idne				= $request->input('edit_idne');
			$sifat				= $request->input('edit_sifat');
			$klasifikasi		= $request->input('edit_klasifikasi');
			$kodeunit			= $request->input('edit_unit');
			$idpejabat			= $request->input('edit_pejabat');
			$perihal			= $request->input('edit_perihal');
			$klasifikasiarsip	= $request->input('edit_jenissurat');
			$dasarnomor			= $request->input('edit_dasar');
			$dasartahun			= $request->input('edit_dasartahun');
			$kepada				= $request->input('edit_kepada');
			$alamat				= $request->input('edit_alamat');
			$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			$dasarsurat			= '';
			$gagal2				= '';
			$gagal3				= '';
			 
			
			if ($request->hasFile('edit_scanid')) {
				$validator = Validator::make($request->all(), [
					'edit_scanid' =>  'mimes:pdf,PDF|max:20000'
				]);
				if ($validator->fails()) {
					$gagal2 = 'YES';
				}
			} else { $gagal2 = 'NO'; }
			if ($request->hasFile('edit_scanlampiran')) {
				$validator = Validator::make($request->all(), [
					'edit_scanlampiran' =>  'mimes:pdf,PDF|max:20000'
				]);
				if ($validator->fails()) {
					$gagal3 = 'YES';
				}
			}  else { $gagal3 = 'NO'; }
			if ($dasarnomor != '' AND $dasartahun != ''){
				$marking1 = $fakultas.'-'.$dasartahun.$dasarnomor;
				$marking2 = $dasartahun.$dasarnomor;
				$datalm1  = Suratmasuk::where('marking', $marking1)->count();
				$datalm2  = Suratmasuk::where('marking', $marking2)->count();
				if ($datalm1 != 0){
					$jceksrtmsk		= Suratmasuk::where('marking', $marking1)->first();
					$dasarsurat		= $jceksrtmsk->scansurat;
					Suratkeluar::where('id', $idne)->update([
						'dasarsurat' =>  $dasarsurat,
					]);
				} else if ($datalm2 != 0){
					$jceksrtmsk		= Suratmasuk::where('marking', $marking2)->first();
					$dasarsurat		= $jceksrtmsk->scansurat;
					Suratkeluar::where('id', $idne)->update([
						'dasarsurat' =>  $dasarsurat,
					]);
				} else { $dasarsurat = 'GAGAL'; }
			} else { 
				if ($request->hasFile('edit_uploaddasar')) {
					$validator = Validator::make($request->all(), [
						'edit_uploaddasar' =>  'mimes:jpeg,jpg,pdf,png,JPEG,JPG,PNG,PDF|max:20000'
					]);
					if ($validator->fails()) {
						$dasarsurat = 'GAGAL';
					} else { $dasarsurat = 'OK'; }
				} else { $dasarsurat = 'OK'; }
			}
			if ($dasarsurat == 'GAGAL'){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Dasar yang berasal dari surat masuk tidak ditemukan ']);
				return back();
			} else if ($gagal2 == 'YES'){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Scan Fisik Surat Wajib diupload dalam format PDF']);
				return back();
			} else if ($gagal3 == 'YES'){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Scan Lampiran Surat Bila diupload mohon diubah kedalam format PDF']);
				return back();
			} else {
				$getdatasurat 	= Suratkeluar::where('id', $idne)->first();
				$dd 			= $getdatasurat->daysrt;
				$mm 			= $getdatasurat->monsrt;
				$yy 			= $getdatasurat->yersrt;
				$fakultas		= $getdatasurat->fakultas;
				$status			= $getdatasurat->status;
				$isisurat		= $getdatasurat->isisurat;
				$dasarlama		= $getdatasurat->dasarsurat;
				$lampiranlm		= $getdatasurat->lampiran;
				$idpejabatlm	= $getdatasurat->idpejabat;
				if ($status == 'MANUAL'){
					if ($request->hasFile('edit_scanid')) {
						if ($isisurat != ''){
							if (File::exists(base_path() ."/public/scan/files/". $isisurat)) {
							  File::delete(base_path() ."/public/scan/files/". $isisurat);
							}
						}
						$namafile		= $fakultas.'-OUT-'.$yy.$idne;
						$namafile		= $namafile.'.'.$request->file('edit_scanid')->getClientOriginalExtension();
						$uploadedFile 	= $request->file('edit_scanid');
						$request->file('edit_scanid')->move(public_path('scan/files'), $namafile);
						Suratkeluar::where('id', $idne)->update([
							'isisurat' 		=>  $namafile,
						]);
					}
				} else {
					if ($request->hasFile('edit_scanid')) {
						$namafile		= $fakultas.'-OUT-'.$yy.$idne;
						$namafile		= $namafile.'.'.$request->file('edit_scanid')->getClientOriginalExtension();
						$uploadedFile 	= $request->file('edit_scanid');
						$request->file('edit_scanid')->move(public_path('scan/files'), $namafile);
						Suratkeluar::where('id', $idne)->update([
							'isisurat' 		=>  $namafile,
						]);
					}
				}
				if ($request->hasFile('edit_uploaddasar')) {
					if ($dasarlama != ''){
						$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarlama)->count();
						if ($qcekdasar == 0){
							if (File::exists(base_path() ."/public/scan/files/". $dasarlama)) {
							  File::delete(base_path() ."/public/scan/files/". $dasarlama);
							}
						}
					}
					$dasarsurat		= $fakultas.'-DSR-'.$yy.$idne;
					$dasarsurat		= $dasarsurat.'.'.$request->file('edit_uploaddasar')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('edit_uploaddasar');
					$request->file('edit_uploaddasar')->move(public_path('scan/files'), $dasarsurat);
					Suratkeluar::where('id', $idne)->update([
						'dasarsurat' =>  $dasarsurat,
					]);
				}
				if ($request->hasFile('edit_scanlampiran')) {
					if ($lampiranlm != ''){
						if (File::exists(base_path() ."/public/scan/files/". $lampiranlm)) {
						  File::delete(base_path() ."/public/scan/files/". $lampiranlm);
						}
					}
					$lampiransrt	= $fakultas.'-Lampiran-'.$yy.$idne;
					$lampiransrt	= $lampiransrt.'.'.$request->file('edit_scanlampiran')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('edit_scanlampiran');
					$request->file('edit_scanlampiran')->move(public_path('scan/files'), $lampiransrt);
					Suratkeluar::where('id', $idne)->update([
						'lampiran' =>  $lampiransrt,
					]);
				}
				if ($idpejabatlm != $idpejabat AND $idpejabat != ''){
					$getpejabat 	= Pejabatsurat::where('id', $idpejabat)->first();
					$pejabat		= $getpejabat->pejabat;
					$nmpejabat		= $getpejabat->nama;
					Suratkeluar::where('id', $idne)->update([
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $pejabat,
						'namapejabat' 	=>  $nmpejabat,
					]);
				}
				if ($klasifikasiarsip != ''){
					$arrkode 		= explode(".", $klasifikasiarsip);
					$unit 			= $arrkode[0];
					$klasifikasiarsip= '';
					if(isset($arrkode[1])){ $klasifikasiarsip = $unit.'.'.$arrkode[1]; }
					if(isset($arrkode[2])){
						if ($arrkode[2] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[2];
						}
					}
					if(isset($arrkode[3])){
						if ($arrkode[3] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[3];
						}
					}
					if(isset($arrkode[4])){
						if ($arrkode[4] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[4];
						}
					}
					$kerjanya = Suratkeluar::where('id', $idne)->update([
						'kodefak' 		=>  $kodeunit,
						'unit' 			=>  $unit,
						'perihal' 		=>  $perihal,
						'kepada' 		=>  $kepada,
						'alamat' 		=>  $alamat,
						'sifat' 		=>  $sifat,
						'klasifikasi' 	=>  $klasifikasi,						
						'kelompok' 		=>  $mkelompok,
						'status' 		=>  'MANUAL',
						'faskode' 		=>  $klasifikasiarsip,
						'arsip'			=>  'arsip',
						'updated_at'	=> 	date("Y-m-d H:i:s")
					]);
				} else {
					$kerjanya = Suratkeluar::where('id', $idne)->update([
						'kodefak' 		=>  $kodeunit,
						'perihal' 		=>  $perihal,
						'kepada' 		=>  $kepada,
						'alamat' 		=>  $alamat,
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $pejabat,
						'namapejabat' 	=>  $nmpejabat,
						'sifat' 		=>  $sifat,
						'klasifikasi' 	=>  $klasifikasi,						
						'kelompok' 		=>  $mkelompok,
						'status' 		=>  'MANUAL',
						'arsip'			=>  'arsip',
						'updated_at'	=> 	date("Y-m-d H:i:s")
					]);
				}
				if ($kerjanya){
					$ceksudahtte = AntrianTTE::where('idsurat', $idne)->where('jenis', 'KELUAR')->first();
					if (isset($ceksudahtte->id)){
						$nonik		= $ceksudahtte->nonik;
						$passphare	= $ceksudahtte->passphare;
						if ($nonik == '' OR is_null($nonik)){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat Berhasil di Arsipkan tanpa TTE']);
							return back();
						} else {
							$output_file 	= '/scan/files/'. $getdatasurat->marking.'.pdf';
							
							$namafile	= $getdatasurat->marking.'.pdf';
							if (file_exists(public_path($output_file))){
								$error		= '';
								$pesan		= '';
								$file 		= public_path($output_file);
								$passphare	= Crypt::decryptString($passphare);
								$client 	= new Client();
								$authHeader = [
									'auth'    		=> ['esign', 'qwerty'],
									'multipart'    	=> [
										[
											'name'		=> 'file',
											'contents'	=> fopen($file, 'r')
										],
										[
											'name'		=> 'nik',
											'contents'	=> $nonik
										],
										[
											'name'		=> 'passphrase',
											'contents'	=> $passphare
										],
										[
											'name'		=> 'tampilan',
											'contents'	=> 'invisible'
										],
									],
								];
								try {
									$response 	= $client->post('https://esign.ub.ac.id/api/sign/pdf', $authHeader);
									$status		= (string)$response->getStatusCode();
									$body		= (string)$response->getBody();
									$hasil		= json_decode($body, true);
									$tgltte		= date("Y-m-d H:i:s");
									$waktutte	= 0;
									$iddok		= '';
									$waktutte 	= $response->getHeader('signing_time');
									$waktutte	= $waktutte[0];
									$tgltte 	= $response->getHeader('Date');
									$tgltte		= $tgltte[0];
									$iddok		= $response->getHeader('id_dokumen');
									$iddok		= $iddok[0];
									$error		= 'Signed at '.$tgltte.' Signing Time: '.$waktutte.' ID Dokumen: '.$iddok;
									Suratkeluar::where('marking', $getdatasurat->marking)->update([
										'status' 		=>  'Force TTE',
										'tandatangan' 	=>  'Signed Using TTE',
										'paraf1' 		=>  $iddok.'-SCO-DOWNLOAD',
									]);
								} catch (\GuzzleHttp\Exception\ClientException $e) {
									$response 				= $e->getResponse();
									$responseBodyAsString 	= $response->getBody()->getContents();
									$pesan 					= json_decode($responseBodyAsString);
									if ($pesan->error !== null){
										$pesan 				= $pesan->error;
									} else {
										$pesan				= 'gagal - 413 Request Entity Too Large';
									}
									$error		= $error.$pesan.' Untuk ID '.$namafile.'<br />';
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => $error]);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Update Surat Keluar,File Surat Keluar Gagal di Unggah']);
								return back();
							}
						}
					} else {
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat Berhasil di Arsipkan']);
						return back();
					}
				}else{
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Update Surat Keluar, Pastikan Semua Isian Telah anda isi sesuai dengan Form. Bila Masih tidak bisa silahkan hubungi PSIK terkait']);
					return back();
				}
			}
		}
    }
	public function experaturansk(Request $request) {
    	$validator = Validator::make($request->all(), [
          'id_nomor' 		=>  'required',
		  'id_tahun' 		=>  'required',
          'id_tanggal' 		=> 	'required',
          'id_kodepjbt' 	=> 	'required',
		  'id_perihal' 		=> 	'required',
        ]);
		if($validator->fails()) {
			Session::flash('status', 'Error');
			Session::flash('message', 'Mohon Lengkapi Isian Form Anda'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
        }else {
			$nama		= Session('nama');
			$unit		= Session('previlage');
			$mkelompok	= $unit;
			$fakultas	= Session('fakultas');
			$nomor		= $request->input('id_nomor');
			$tahun		= $request->input('id_tahun');
			$tanggal	= $request->input('id_tanggal');
			$perihal	= $request->input('id_perihal');
			$kodepjbt	= $request->input('id_kodepjbt');
			$kodearsip	= $request->input('id_klasifikasiarsip');
			$dasarsurat	= $request->input('id_dasar');
			$dasartahun	= $request->input('id_dasartahun');
			$idne		= $request->input('id_idsurat');
			$ahrf 		= explode("-", $tanggal);
			$yy 	  	= $ahrf[0];
			$mm 	  	= $ahrf[1];
			$dd 	  	= $ahrf[2];
			$gagal1		= '';
			$gagal2		= '';
			if ($request->hasFile('id_uploaddasar')) {
				$validator = Validator::make($request->all(), [
					'id_uploaddasar' =>  'mimes:jpeg,jpg,pdf,png,JPEG,JPG,PNG,PDF|max:20000'
				]);
				if ($validator->fails()) {
					$gagal1 = 'YES';
				}
			} else { $gagal1 = 'YES'; }
			if ($request->hasFile('id_scanid')) {
				$validator = Validator::make($request->all(), [
					'id_scanid' =>  'mimes:pdf,PDF|max:20000'
				]);
				if ($validator->fails()) {
					$gagal2 = 'YES';
				}
			} else { $gagal2 = 'YES'; }
			
			if ($dasarsurat != '' AND $dasartahun != ''){
				$marking1 = $fakultas.'-'.$dasartahun.$dasarsurat;
				$marking2 = $dasartahun.$dasarsurat;
				$datalm1  = Suratmasuk::where('marking', $marking1)->count();
				$datalm2  = Suratmasuk::where('marking', $marking2)->count();
				if ($datalm1 != 0){
					$jceksrtmsk		= Suratmasuk::where('marking', $marking1)->first();
					$dasarsurat		= $jceksrtmsk->scansurat;
				} else if ($datalm2 != 0){
					$jceksrtmsk		= Suratmasuk::where('marking', $marking2)->first();
					$dasarsurat		= $jceksrtmsk->scansurat;
				} else { $dasarsurat = ''; }
			}
			if ($idne == 'new'){
				$ceknomorsrt	= Tabelskdanperaturan::where('fakultas', $fakultas)->where('nomor', $nomor)->where('tahun', $tahun)->count();
			}else {
				$ceknomorsrt	= Tabelskdanperaturan::where('id', '!=', $idne)->where('fakultas', $fakultas)->where('tahun', $tahun)->where('nomor', $nomor)->count();
			}
			
			if ($ceknomorsrt != 0){
				Session::flash('status', 'Error');
				Session::flash('message', 'Nomor Surat Terdeteksi Ganda'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else if ($dasarsurat == '' AND $gagal1 == 'YES'){ 
				Session::flash('status', 'Error');
				Session::flash('message', 'Dasar Surat Tidak di Temukan, Mohon Cek Nomor Agenda dan Tahun Agendanya'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else if ($gagal2 == 'YES'){ 
				Session::flash('status', 'Error');
				Session::flash('message', 'Scan Peraturan / Keputusan Wajib di Upload'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else {
				if ($idne == 'new'){
					$cekmarking		= Tabelskdanperaturan::orderBy('id', 'DESC')->count();
					if ($cekmarking == 0){
						$setidne	= 1;
						$marking 	= $fakultas.'-SKPP-'.$yy.$setidne;
					}else {
						$cekmarking	= Tabelskdanperaturan::orderBy('id', 'DESC')->first();
						$lastid		= $cekmarking->id;
						$setidne 	= $lastid+1;
						$marking 	= $fakultas.'-SKPP-'.$yy.$setidne;
					}
					if ($request->hasFile('id_scanid')) {
						$namafile		= $marking.'.'.$request->file('id_scanid')->getClientOriginalExtension();
						$uploadedFile 	= $request->file('id_scanid');
						$request->file('id_scanid')->move(public_path('scan/files'), $namafile);
					}
					if ($request->hasFile('id_uploaddasar') AND $dasarsurat == '') {
						$dasarsurat 	= $fakultas.'-DASARSKdanPERATURAN-'.$yy.$setidne;
						$dasarsurat		= $dasarsurat.'.'.$request->file('id_uploaddasar')->getClientOriginalExtension();
						$uploadedFile 	= $request->file('id_uploaddasar');
						$request->file('id_uploaddasar')->move(public_path('scan/files'), $dasarsurat);
					}
					
					$kerjanya = Tabelskdanperaturan::insert([
						'id'			=> $setidne,
						'marking'		=> $marking,
						'kelompok'		=> 'KEPUTUSAN',
						'nomor'			=> $nomor,
						'tahun'			=> $tahun, 
						'tanggal'		=> $tanggal,
						'penandatangan'	=> $kodepjbt,
						'judul'			=> $perihal,
						'scansurat'		=> $namafile,
						'dasarsurat'	=> $dasarsurat,
						'kodefas'		=> $kodearsip,
						'kodesub'		=> '',
						'fakultas' 		=> $fakultas,
						'inputor' 		=> $nama,
					]);
					if ($kerjanya){
						Session::flash('status', 'Success');
						Session::flash('message', 'SK / Peraturan Nomor '.$nomor.' Tahun '.$tahun.' Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					}else{
						Session::flash('status', 'Failed');
						Session::flash('message', 'SK / Peraturan Nomor '.$nomor.' Tahun '.$tahun.' Gagal Tersimpan, Mohon Refresh Halaman Anda'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				} else {
					$getdatalm 	= Tabelskdanperaturan::where('id', $idne)->first();
					$dasarlama	= $getdatalm->dasarsurat;
					$scanlama	= $getdatalm->scansurat;
					$tahun		= $getdatalm->tahun;
					$namafile	= $getdatalm->scansurat;
					
					if ($dasarlama != ''){
						$qcekdasar	= Suratmasuk::where('scansurat', 'LIKE', $dasarlama)->count();
						if ($qcekdasar == 0){
							if (File::exists(base_path() ."/public/scan/files/". $dasarlama)) {
							  File::delete(base_path() ."/public/scan/files/". $dasarlama);
							}
						}
					}
					if ($scanlama != ''){
						if (File::exists(base_path() ."/public/scan/files/". $scanlama)) {
						  File::delete(base_path() ."/public/scan/files/". $scanlama);
						}
						$namafile = '';
					}
					if ($request->hasFile('id_scanid')) {
						$uploadedFile 	= $request->file('id_scanid');
						$request->file('id_scanid')->move(public_path('scan/files'), $getdatalm->scansurat);
						$namafile		= $getdatalm->scansurat;
					}
					if ($request->hasFile('id_uploaddasar') AND $dasarsurat == '') {
						$dasarsurat 	= $fakultas.'-DASARSKdanPERATURAN-'.$tahun.$idne;
						$dasarsurat		= $dasarsurat.'.'.$request->file('id_uploaddasar')->getClientOriginalExtension();
						$uploadedFile 	= $request->file('id_uploaddasar');
						$request->file('id_uploaddasar')->move(public_path('scan/files'), $dasarsurat);
					}
					$kerjanya = Tabelskdanperaturan::where('id', $idne)->update([
						'nomor'			=> $nomor,
						'tahun'			=> $tahun, 
						'tanggal'		=> $tanggal,
						'penandatangan'	=> $kodepjbt,
						'judul'			=> $perihal,
						'scansurat'		=> $namafile,
						'dasarsurat'	=> $dasarsurat,
						'kodefas'		=> $kodearsip,
						'kodesub'		=> '',
						'fakultas' 		=> $fakultas,
						'inputor' 		=> $nama,
						'updated_at'	=> date("Y-m-d H:i:s")
					]);
					if ($kerjanya){
						Session::flash('status', 'Success');
						Session::flash('message', 'SK / Peraturan Nomor '.$nomor.' Tahun '.$yy.' Telah Terupdate'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					}else{
						Session::flash('status', 'Failed');
						Session::flash('message', 'SK / Peraturan Nomor '.$nomor.' Tahun '.$yy.' Gagal Update, Mohon Refresh Halaman Anda'); 
						Session::flash('alert-class', 'alert-info');
						return back();
					}
				}
			}
		}
    }
	public function exmanualsrtklrmundur(Request $request) {
    	$validator 	= Validator::make($request->all(), [
          'set01' 	=>  'required',
          'set02' 	=> 	'required',
        ]);
		if($validator->fails()) {
			echo '<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Something is missing</h4>
						Mohon Lengkapi Data Dasarnya
				</div>';
        } else {
			$tlstgl				= $request->input('set01');
			$klasifikasi		= $request->input('set02');
			$klasifikasiarsip	= $request->input('set03');
			$kodepjbt			= $request->input('set04');
			$sifat				= $request->input('set05');
			$konseptor			= $request->input('set06');
			$mkelompok			= $request->input('set07');
			$jenissrt			= $request->input('set08');
			if (is_null($jenissrt) OR $jenissrt == ''){
				$jenissrt		= 'BIASA';
			}
			$fakultas 			= Session('fakultas');
			$dd1 	  			= date("d");
			$mm1 	  			= date("m");
			$yy1 	  			= date("Y");
			$tlstgl1			= $yy1.'-'.$mm1.'-'.$dd1;
			$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			if ($tlstgl == $tlstgl1){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
							No.Mundur Khusus untuk Tanggal yang Telah Lalu
					</div>';
			} else if ($tlstgl > $tlstgl1){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
							No.Mundur Khusus untuk Tanggal yang Telah Lalu
					</div>';
			} else {
				if ($kodepjbt == ''){ $kodepjbt = 'UN10'; }
				if ($klasifikasiarsip != ''){
					$arrkode 		= explode(".", $klasifikasiarsip);
					$unit 			= $arrkode[0];
					$klasifikasiarsip= '';
					if(isset($arrkode[1])){ $klasifikasiarsip = $unit.'.'.$arrkode[1]; }
					if(isset($arrkode[2])){
						if ($arrkode[2] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[2];
						}
					}
					if(isset($arrkode[3])){
						if ($arrkode[3] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[3];
						}
					}
					if(isset($arrkode[4])){
						if ($arrkode[4] != ''){
							$klasifikasiarsip = $klasifikasiarsip.'.'.$arrkode[4];
						}
					}
					$perihal		= '';
					$getperihal		= Klasifikasi::where('kodesurat', 'LIKE', $klasifikasiarsip.'%')->orderBy('id', 'ASC')->first();
					$primer			= $getperihal->primer;
					$sekunder		= $getperihal->sekunder;
					$tersier		= $getperihal->tersier;
					$series			= $getperihal->series;
					if ($series != ''){
						$perihal 	= $sekunder.' '.$tersier.' '.$series;
					} else {
						if ($tersier != ''){
							$perihal 	= $sekunder.' '.$tersier;
						} else {
							if ($sekunder != ''){
								$perihal 	= $sekunder;
							} else {
								$perihal 	= $primer;
							}
						}
					}
				} else { $unit = 'TU'; $perihal = ''; }
				$arrtgl			= explode("-", $tlstgl);
				if (isset($arrtgl[2])){
					$dd 	  	= $arrtgl[2];
					$mm 	  	= $arrtgl[1];
					$yy 	  	= $arrtgl[0];
				} else {
					$tlstgl		= date('Y-m-d');
					$arrtgl		= explode("-", $tlstgl);
					$dd 	  	= $arrtgl[2];
					$mm 	  	= $arrtgl[1];
					$yy 	  	= $arrtgl[0];
				}
				if ($mm == 12){
					$tahunskrg = date("Y");
					if ($tahunskrg == $yy){
						$cekslot	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('pembuat', 'LIKE', '%mundur%')->count();
						$cektanggal	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->count();
						if ($cekslot != 0){
							$ceknomorsrt	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('pembuat', 'LIKE', '%mundur%')->first();
							$idsurat		= $ceknomorsrt->id;
							$nomor			= $ceknomorsrt->nomor;
							
							$cgetpejabat		= Pejabatsurat::where('kode', $kodepjbt)->count();
							if ($cgetpejabat != 0){
								$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
								$idpejabat		= $getpejabat->id;
								$penandatangan	= $getpejabat->pejabat;
								$setttd			= $getpejabat->nama;
							} else {
								$idpejabat		= '0';
								$penandatangan	= '-';
								$setttd			= '-';
							}
							$marking 		= $fakultas.'-OUT-'.$yy.$idsurat;
							$kerjanya 		= Suratkeluar::where('id', $idsurat)->update([
								'jenissrt' 		=>  $jenissrt,
								'kodefak' 		=>  $kodepjbt,
								'unit' 			=>  $unit,
								'perihal' 		=>  $perihal,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
								'status' 		=>  'NEW',
								'faskode' 		=>  $klasifikasiarsip,
								'fakultas' 		=>  $fakultas
							]);
							if ($kerjanya){
								$monsrt			= (int)$mm;
								$bln 			= $bulan[$monsrt];
								$tlstanggal		= $dd.' '.$bln.' '.$yy;
								if ($klasifikasiarsip != ''){
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
								} else {
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
								}
								echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
										<table class="table table-bordered">
											<tr>
												<td>Tanggal</td>
												<td>Nomor</td>
												<td>Penulisan Nomor</td>
												<td>Pemohon</td>
											</tr>
											<tr>
												<td>'.$tlstanggal.'</td>
												<td>'.$nomor.'</td>
												<td>'.$tlsnomor.'</td>
												<td>'.$konseptor.'</td>
											</tr>
										</table>
								</div>';
								
							} else {
								echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
										Sistem Error, mohon ulangi beberapa saat lagi
								</div>';
							}
						} else if ($cektanggal != 0){
							$thncari		= $yy.'-%';
							$anakno			= 0;
							$dapatdi		= 'awal';
							$ceknomorsrt	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->orderByRaw('RAND()')->get();
							foreach ($ceknomorsrt as $ranakno){
								$nomor			= $ranakno->nomor;
								$ceknomoranak	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->count();
								if ($ceknomoranak == 1){
									$anakno		= 1;
									$ceknomoranaklast	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->orderBy('anakno', 'DESC')->count();
									if ($ceknomoranaklast != 0){
										$anakno	= 0;
									}
									$dapatdi	= 'firststep '.$ceknomoranaklast;
								} else {
									if ($ceknomoranak >= 9){
										$ceknomoranak2	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', '!=', $nomor)->count();
										if ($ceknomoranak2 == 0){
											$ceknomoranak2	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->orderBy('anakno', 'DESC')->first();
											$anakno			= (int)$ceknomoranak2->anakno;
											$anakno			= $anakno+1;
											$ceknomoranaklast	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->orderBy('anakno', 'DESC')->count();
											if ($ceknomoranaklast > 0){
												$anakno		= 0;
											}
											$dapatdi	= '2ndstep '.$ceknomoranaklast;
										}
									} else {
										$ceknomoranak2	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->orderBy('anakno', 'DESC')->first();
										$anakno			= (int)$ceknomoranak2->anakno;
										$anakno			= $anakno+1;
										$ceknomoranaklast	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->orderBy('anakno', 'DESC')->count();
										if ($ceknomoranaklast > 0){
											$anakno			= 0;
										}
										$dapatdi	= 'thirdstep '.$ceknomoranaklast;
									}
								}
							}
							if ($anakno == 0){
								echo '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
											Sistem Error, mohon ulangi beberapa saat lagi
									</div>';
							} else {
								$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
								$idnomor		= $getid->id;
								$idnomor		= $idnomor + 1;
								
								$cgetpejabat		= Pejabatsurat::where('kode', $kodepjbt)->count();
								if ($cgetpejabat != 0){
									$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
									$idpejabat		= $getpejabat->id;
									$penandatangan	= $getpejabat->pejabat;
									$setttd			= $getpejabat->nama;
								} else {
									$idpejabat		= '0';
									$penandatangan	= '-';
									$setttd			= '-';
								}
								$marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
								$kerjanya 		= Suratkeluar::insert([
									'id' 			=>  $idnomor,
									'marking' 		=>  $marking,
									'jenissrt' 		=>  $jenissrt,
									'nomor' 		=>  $nomor,
									'anakno' 		=>  $anakno,
									'kodefak' 		=>  $kodepjbt,
									'unit' 			=>  $unit,
									'tglsurat' 		=>  $tlstgl,
									'daysrt' 		=>  $dd,
									'monsrt' 		=>  $mm,
									'yersrt' 		=>  $yy,
									'dasarsurat' 	=>  '',
									'kepada' 		=>  '',
									'alamat' 		=>  '',
									'perihal' 		=>  $perihal,
									'lampiran' 		=>  '',
									'isisurat' 		=>  '',
									'idpejabat' 	=>  $idpejabat,
									'pejabat' 		=>  $penandatangan,
									'namapejabat' 	=>  $setttd,
									'tembusan' 		=>  '',
									'sifat' 		=>  $sifat,
									'klasifikasi' 	=>  $klasifikasi,
									'pembuat' 		=>  $konseptor,
									'kelompok' 		=>  $mkelompok,
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
									'faskode' 		=>  $klasifikasiarsip,
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
								if ($kerjanya){
									$monsrt			= (int)$mm;
									$bln 			= $bulan[$monsrt];
									$tlstanggal		= $dd.' '.$bln.' '.$yy;
									if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
									if ($klasifikasiarsip != ''){
										$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
									} else {
										$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
									}
									echo '<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
											<table class="table table-bordered">
												<tr>
													<td>Tanggal</td>
													<td>Nomor</td>
													<td>Penulisan Nomor</td>
													<td>Pemohon</td>
												</tr>
												<tr>
													<td>'.$tlstanggal.'</td>
													<td>'.$nomor.'</td>
													<td>'.$tlsnomor.'</td>
													<td>'.$konseptor.' '.$dapatdi.'</td>
												</tr>
											</table>
									</div>';
									
								} else {
									echo '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
											Sistem Error, mohon ulangi beberapa saat lagi
									</div>';
								}
							}
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
										Nomor Mundur Hanya Berlaku untuk Tanggal yang sudah ada nomor di dalamnya
								</div>';
						}
					} else {
						$cekslot	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('pembuat', 'LIKE', '%mundur%')->count();
						$cektanggal	= Suratkeluar::where('yersrt', $yy)->where('fakultas', $fakultas)->count();
						if ($cekslot != 0){
							$ceknomorsrt	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('pembuat', 'LIKE', '%mundur%')->first();
							$idsurat		= $ceknomorsrt->id;
							$nomor			= $ceknomorsrt->nomor;
							
							$cgetpejabat		= Pejabatsurat::where('kode', $kodepjbt)->count();
							if ($cgetpejabat != 0){
								$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
								$idpejabat		= $getpejabat->id;
								$penandatangan	= $getpejabat->pejabat;
								$setttd			= $getpejabat->nama;
							} else {
								$idpejabat		= '0';
								$penandatangan	= '-';
								$setttd			= '-';
							}
							$kerjanya 		= Suratkeluar::where('id', $idsurat)->update([
								'jenissrt' 		=>  $jenissrt,
								'dasarsurat' 	=>  '',
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  '',
								'isisurat' 		=>  '',
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  '',
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
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
								'faskode' 		=>  $klasifikasiarsip,
								'fasmasa' 		=>  '',
								'fasket' 		=>  '',
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'font' 			=>  '',
								'ukuran' 		=>  '',
								'lebarttd' 		=>  '',
								'filelampiran' 	=>  '',
							]);
							if ($kerjanya){
								$monsrt			= (int)$mm;
								$bln 			= $bulan[$monsrt];
								$tlstanggal		= $dd.' '.$bln.' '.$yy;
								if ($klasifikasiarsip != ''){
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
								} else {
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
								}
								echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
										<table class="table table-bordered">
											<tr>
												<td>Tanggal</td>
												<td>Nomor</td>
												<td>Penulisan Nomor</td>
												<td>Pemohon</td>
											</tr>
											<tr>
												<td>'.$tlstanggal.'</td>
												<td>'.$nomor.'</td>
												<td>'.$tlsnomor.'</td>
												<td>'.$konseptor.'</td>
											</tr>
										</table>
								</div>';
								
							} else {
								echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
										Sistem Error, mohon ulangi beberapa saat lagi
								</div>';
							}
						} else if ($cektanggal == 0){
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
									Nomor Mundur Hanya Berlaku untuk Tanggal yang sudah ada nomor di dalamnya
							</div>';
						} else {
							$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->where('fakultas', $fakultas)->orderBy('nomor', 'DESC')->first();
							$nomor			= $ceknomorsrt->nomor;
							$nomor 			= $nomor + 1;
							$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
							$idnomor		= $getid->id;
							$idnomor		= $idnomor + 1;
							
							$cgetpejabat		= Pejabatsurat::where('kode', $kodepjbt)->count();
							if ($cgetpejabat != 0){
								$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
								$idpejabat		= $getpejabat->id;
								$penandatangan	= $getpejabat->pejabat;
								$setttd			= $getpejabat->nama;
							} else {
								$idpejabat		= '0';
								$penandatangan	= '-';
								$setttd			= '-';
							}
							$marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
							$kerjanya 		= Suratkeluar::insert([
								'id' 			=>  $idnomor,
								'marking' 		=>  $marking,
								'jenissrt' 		=>  $jenissrt,
								'nomor' 		=>  $nomor,
								'anakno' 		=>  '',
								'kodefak' 		=>  $kodepjbt,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tlstgl,
								'daysrt' 		=>  $dd,
								'monsrt' 		=>  $mm,
								'yersrt' 		=>  $yy,
								'dasarsurat' 	=>  '',
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  '',
								'isisurat' 		=>  '',
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  '',
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
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
								'faskode' 		=>  $klasifikasiarsip,
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
							if ($kerjanya){
								$monsrt			= (int)$mm;
								$bln 			= $bulan[$monsrt];
								$tlstanggal		= $dd.' '.$bln.' '.$yy;
								if ($klasifikasiarsip != ''){
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
								} else {
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
								}
								echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
										<table class="table table-bordered">
											<tr>
												<td>Tanggal</td>
												<td>Nomor</td>
												<td>Penulisan Nomor</td>
												<td>Pemohon</td>
											</tr>
											<tr>
												<td>'.$tlstanggal.'</td>
												<td>'.$nomor.'</td>
												<td>'.$tlsnomor.'</td>
												<td>'.$konseptor.'</td>
											</tr>
										</table>
								</div>';
								
							} else {
								echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
										Sistem Error, mohon ulangi beberapa saat lagi
								</div>';
							}
						}
					}
				} else {
					$cekslot	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('pembuat', 'LIKE', '%mundur%')->count();
					$cektanggal	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->count();
					if ($cekslot != 0){
						$ceknomorsrt	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('pembuat', 'LIKE', '%mundur%')->first();
						$idsurat		= $ceknomorsrt->id;
						$nomor			= $ceknomorsrt->nomor;
						
						$cgetpejabat		= Pejabatsurat::where('kode', $kodepjbt)->count();
						if ($cgetpejabat != 0){
							$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
							$idpejabat		= $getpejabat->id;
							$penandatangan	= $getpejabat->pejabat;
							$setttd			= $getpejabat->nama;
						} else {
							$idpejabat		= '0';
							$penandatangan	= '-';
							$setttd			= '-';
						}
						$kerjanya 		= Suratkeluar::where('id', $idsurat)->update([
							'jenissrt' 		=>  $jenissrt,
							'dasarsurat' 	=>  '',
							'kepada' 		=>  '',
							'alamat' 		=>  '',
							'perihal' 		=>  $perihal,
							'lampiran' 		=>  '',
							'isisurat' 		=>  '',
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $penandatangan,
							'namapejabat' 	=>  $setttd,
							'tembusan' 		=>  '',
							'sifat' 		=>  $sifat,
							'klasifikasi' 	=>  $klasifikasi,
							'pembuat' 		=>  $konseptor,
							'kelompok' 		=>  $mkelompok,
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
							'faskode' 		=>  $klasifikasiarsip,
							'fasmasa' 		=>  '',
							'fasket' 		=>  '',
							'subkode' 		=>  '',
							'submasa' 		=>  '',
							'subket' 		=>  '',
							'font' 			=>  '',
							'ukuran' 		=>  '',
							'lebarttd' 		=>  '',
							'filelampiran' 	=>  '',
						]);
						if ($kerjanya){
							$monsrt			= (int)$mm;
							$bln 			= $bulan[$monsrt];
							$tlstanggal		= $dd.' '.$bln.' '.$yy;
							if ($klasifikasiarsip != ''){
								$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
							} else {
								$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
							}
							echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
									<table class="table table-bordered">
										<tr>
											<td>Tanggal</td>
											<td>Nomor</td>
											<td>Penulisan Nomor</td>
											<td>Pemohon</td>
										</tr>
										<tr>
											<td>'.$tlstanggal.'</td>
											<td>'.$nomor.'</td>
											<td>'.$tlsnomor.'</td>
											<td>'.$konseptor.'</td>
										</tr>
									</table>
							</div>';
							
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
									Sistem Error, mohon ulangi beberapa saat lagi
							</div>';
						}
					} else if ($cektanggal != 0){
						$thncari		= $yy.'-%';
						$anakno			= 0;
						$dapatdi		= 'awal';
						$step			= 0;
						$ceknomorsrt	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->orderByRaw('RAND()')->get();
						foreach ($ceknomorsrt as $ranakno){
							$step++;
							$nomor			= $ranakno->nomor;
							$ceknomoranak	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->count();
							if ($ceknomoranak == 1){
								$anakno	= 1;
								$ceknomoranaklast	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->orderBy('anakno', 'DESC')->count();
								if ($ceknomoranaklast != 0){
									$anakno	= 0;
								}
								$dapatdi	= 'firststep '.$ceknomoranaklast;
							} else {
								if ($ceknomoranak >= 9){
									$ceknomoranak2	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', '!=', $nomor)->count();
									if ($ceknomoranak2 == 0){
										$ceknomoranak2	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->orderBy('anakno', 'DESC')->first();
										$anakno			= (int)$ceknomoranak2->anakno;
										$anakno			= $anakno+1;
										$ceknomoranaklast	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->orderBy('anakno', 'DESC')->count();
										if ($ceknomoranaklast > 0){
											$anakno		= 0;
										}
										$dapatdi	= '2ndstep '.$ceknomoranaklast;
									}
								} else {
									$ceknomoranak2	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->orderBy('anakno', 'DESC')->first();
									$anakno			= (int)$ceknomoranak2->anakno;
									$anakno			= $anakno+1;
									$ceknomoranaklast	= Suratkeluar::where('tglsurat', $tlstgl)->where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->orderBy('anakno', 'DESC')->count();
									if ($ceknomoranaklast > 0){
										$anakno			= 0;
									}
									$dapatdi	= 'thirdstep '.$ceknomoranaklast;
								}
							}
						}
						if ($anakno == 0){
							echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
										Sistem Error, mohon ulangi beberapa saat lagi '.$step.' Looping Pencarian
								</div>';
						} else {
							$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
							$idnomor		= $getid->id;
							$idnomor		= $idnomor + 1;
							
							$cgetpejabat		= Pejabatsurat::where('kode', $kodepjbt)->count();
							if ($cgetpejabat != 0){
								$getpejabat		= Pejabatsurat::where('kode', $kodepjbt)->first();
								$idpejabat		= $getpejabat->id;
								$penandatangan	= $getpejabat->pejabat;
								$setttd			= $getpejabat->nama;
							} else {
								$idpejabat		= '0';
								$penandatangan	= '-';
								$setttd			= '-';
							}
							$marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
							$kerjanya 		= Suratkeluar::insert([
								'id' 			=>  $idnomor,
								'marking' 		=>  $marking,
								'jenissrt' 		=>  $jenissrt,
								'nomor' 		=>  $nomor,
								'anakno' 		=>  $anakno,
								'kodefak' 		=>  $kodepjbt,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tlstgl,
								'daysrt' 		=>  $dd,
								'monsrt' 		=>  $mm,
								'yersrt' 		=>  $yy,
								'dasarsurat' 	=>  '',
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  '',
								'isisurat' 		=>  '',
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  '',
								'sifat' 		=>  $sifat,
								'klasifikasi' 	=>  $klasifikasi,
								'pembuat' 		=>  $konseptor,
								'kelompok' 		=>  $mkelompok,
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
								'faskode' 		=>  $klasifikasiarsip,
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
							if ($kerjanya){
								$monsrt			= (int)$mm;
								$bln 			= $bulan[$monsrt];
								$tlstanggal		= $dd.' '.$bln.' '.$yy;
								if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
								if ($klasifikasiarsip != ''){
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$klasifikasiarsip.'/'.$yy;
								} else {
									$tlsnomor = $nomor.'/'.$kodepjbt.'/'.$unit.'/'.$yy;
								}
								echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Review Permohonan Anda</h4>
										<table class="table table-bordered">
											<tr>
												<td>Tanggal</td>
												<td>Nomor</td>
												<td>Penulisan Nomor</td>
												<td>Pemohon</td>
											</tr>
											<tr>
												<td>'.$tlstanggal.'</td>
												<td>'.$nomor.'</td>
												<td>'.$tlsnomor.'</td>
												<td>'.$konseptor.' '.$dapatdi.'</td>
											</tr>
										</table>
								</div>';
								
							} else {
								echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
										Sistem Error, mohon ulangi beberapa saat lagi
								</div>';
							}
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error..!!</h4>
									Nomor Mundur Hanya Berlaku untuk Tanggal yang sudah ada nomor di dalamnya
							</div>';
					}
				}
			}
		}
	}
	public function exmanualsrtklredit(Request $request) {
    	$validator = Validator::make($request->all(), [
		  'edit_perihal' 		=> 	'required',
		  'edit_kodepjbt' 		=> 	'required', 
		  'edit_kodesurat' 		=> 	'required', 
		  'edit_jenissurat' 	=> 	'required', 
        ]);
		if($validator->fails()) {
			Session::flash('nomore', '');
			Session::flash('pesanne', '<font size="+2"; color="red">Mohon Lengkapi Isian Form Anda, Pastikan Jenis, Kode Surat, Kode Klasifikasi, Perihal Sudah anda Isi</font>'); 
			Session::flash('tanggale', '');
			return back();
        }else {
			$nama		= Session('nama');
			$unit		= Session('jabatan');
			$mkelompok	= $unit;
			$fakultas	= Session('fakultas');
			$nomor		= $request->input('edit_nomor');
			$kode		= $request->input('edit_kodesurat');
			$jenis		= $request->input('edit_jenissurat');
			$tanggal	= $request->input('edit_tanggal');
			$sifat		= $request->input('edit_sifat');
			$perihal	= $request->input('edit_perihal');
			$klasifikasi= $request->input('edit_klasifikasi');
			$kodepjbt	= $request->input('edit_kodepjbt');
			$idne		= $request->input('edit_idne');
			$bulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			$ahrf 		= explode("-", $tanggal);
			$yy 	  	= $ahrf[0];
			$mm 	  	= $ahrf[1];
			$dd 	  	= $ahrf[2];
			$thncari	= $yy.'-%';
			$tlstgl		= $tanggal;
			$cektanggal	= Suratkeluar::where('fakultas', $fakultas)->where('tglsurat', $tlstgl)->count();
			if ($cektanggal == 0) {
				Session::flash('pesanne', '<font size="+2"; color="red">Nomor Mundur Hanya Berlaku Untuk Tanggal Yang Telah Mengeluarkan Nomor Surat</font>'); 
				return back();
			} else {
				$ceksuratlm		= Suratkeluar::where('id', $idne)->first();
				$ddlm			= $ceksuratlm->daysrt;
				$mmlm			= $ceksuratlm->monsrt;
				$yylm			= $ceksuratlm->yersrt;
				$anaknolm		= $ceksuratlm->anakno;
				$nomorlm		= $ceksuratlm->nomor;
				$tgllama		= $yylm.'-'.$mmlm.'-'.$ddlm;
				if ($tgllama != $tanggal){
					$ceknomorsrt	= Suratkeluar::where('fakultas', $fakultas)->where('tglsurat', $tlstgl)->first();
					$nomor 			= $ceknomorsrt->nomor;
					$cekanaknomer	= Suratkeluar::where('fakultas', $fakultas)->where('tglsurat', $tlstgl)->where('anakno', '!=', '')->count();
					if ($cekanaknomer == 0){
						$anakno 	= $cekanaknomer + 1;
					}else {
						$ranaknomer	= Suratkeluar::where('fakultas', $fakultas)->where('tglsurat', $tlstgl)->where('anakno', '!=', '')->orderBy('anakno', 'DESC')->first();
						$cekanaknmr	= $ranaknomer->anakno;
						$anakno 	= $cekanaknmr + 1;
					}
					$tulisnomor	= $nomor.'.'.$anakno;
				} else {
					$anakno 	= $anaknolm;
					$nomor 		= $nomorlm;
					$dd 		= $ddlm;
					$mm			= $mmlm;
					$yy			= $yylm;
					$tlstgl		= $tgllama;
					$tulisnomor	= $nomor.'.'.$anakno;
				}
				
				$kerjanya = Suratkeluar::where('id', $idne)->update([
					'jenissrt' 		=>  $jenis,
					'nomor' 		=>  $nomor,
					'anakno' 		=>  $anakno,
					'kodefak' 		=>  $kodepjbt,
					'unit' 			=>  $kode,
					'tglsurat' 		=>  $tlstgl,
					'daysrt' 		=>  $dd,
					'monsrt' 		=>  $mm,
					'yersrt' 		=>  $yy,
					'perihal' 		=>  $perihal,
					'pembuat' 		=>  $nama,
					'kelompok' 		=>  $mkelompok,
					'arsip' 		=>  $tlstgl,
				]);
				if ($kerjanya){
					Session::flash('nomore', $tulisnomor);
					Session::flash('pesanne', '<font size="+2"; color="green">Surat Keluar Dengan Marking Nomor '.$tulisnomor.' Sukses di Update</font>'); 
					Session::flash('tanggale', $tlstgl);
					return back();
				}else{
					Session::flash('pesanne', '<font size="+2"; color="yellow">Sistem Down, Coba Beberapa Saat Lagi..!!!</font>'); 
					return back();
				}
			}
		}
    }
	public function exUploadSuratTTE(Request $request) {
		$nomor			= $request->input('val02');
		$tanggal		= $request->input('val03');
		$kepada			= $request->input('val04');
		$nmttd			= $request->input('val05');
		$paraf1			= $request->input('val06');
		$paraf2			= $request->input('val07');
		$paraf3			= $request->input('val08');
		$paraf4			= $request->input('val09');
		$marking		= $request->input('val10');
		$idsurat		= $request->input('val11');
		$perihal		= $request->input('val12');
		$thnagenda		= $request->input('val13');
		$noagenda		= $request->input('val14');
		$alamat 		= Session('addressapps01');
		$swandhanakota	= Session('kota01');
		$universitas 	= Session('subsubdomainapps01');
		$konseptor		= Session('email');
		$homebase		= url("/");
		$kalender 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$dasarsurat		= '';
		if ($thnagenda != '' AND $noagenda != ''){
			$datalm1  = Suratmasuk::where('noagenda', $noagenda)->where('yersrt', $thnagenda)->where('fakultas', Session('fakultas'))->first();
			if (isset($datalm1->scansurat)){
				$dasarsurat = $datalm1->scansurat;
			}
		}
		if ($paraf2 == ''){ $paraf2 = ''; }
		if ($paraf3 == ''){ $paraf3 = ''; }
		if ($paraf4 == ''){ $paraf4 = ''; }
		if ($nmttd == 'materai') {
			if ($request->hasFile('file')) {
				$getsurat 		= Suratkeluar::where('marking', $marking)->first();
				if (isset($getsurat->id)){
					$ceksudahtte = AntrianTTE::where('idsurat', $getsurat->id)->where('jenis', 'KELUAR')->first();
					if (isset($ceksudahtte->id)){
						$nonik		= $ceksudahtte->nonik;
						$passphare	= $ceksudahtte->passphare;
						if ($nonik == '' OR is_null($nonik)){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pejabat : '.$ceksudahtte->pejabat.' Tidak Menggunakan TTE Tersertifikasi']);
							return back();
						} else {
							$output_file 	= '/scan/files/'. $getsurat->marking.'.pdf';
							try {
								Storage::disk('local')->delete($output_file);
							} catch (\Exception $e) {
							}
							$namafile	= $getsurat->marking.'.pdf';
							$request->file('file')->move(public_path('scan/files'), $namafile);
							if (file_exists(public_path($output_file))){
								$error		= '';
								$pesan		= '';
								$file 		= public_path($output_file);
								$passphare	= Crypt::decryptString($passphare);
								$client 	= new Client();
								$authHeader = [
									'auth'    		=> ['esign', 'qwerty'],
									'multipart'    	=> [
										[
											'name'		=> 'file',
											'contents'	=> fopen($file, 'r')
										],
										[
											'name'		=> 'nik',
											'contents'	=> $nonik
										],
										[
											'name'		=> 'passphrase',
											'contents'	=> $passphare
										],
										[
											'name'		=> 'tampilan',
											'contents'	=> 'invisible'
										],
									],
								];
								try {
									$response 	= $client->post('https://esign.ub.ac.id/api/sign/pdf', $authHeader);
									$status		= (string)$response->getStatusCode();
									$body		= (string)$response->getBody();
									$hasil		= json_decode($body, true);
									$tgltte		= date("Y-m-d H:i:s");
									$waktutte	= 0;
									$iddok		= '';
									$waktutte 	= $response->getHeader('signing_time');
									$waktutte	= $waktutte[0];
									$tgltte 	= $response->getHeader('Date');
									$tgltte		= $tgltte[0];
									$iddok		= $response->getHeader('id_dokumen');
									$iddok		= $iddok[0];
									$error		= 'Signed at '.$tgltte.' Signing Time: '.$waktutte.' ID Dokumen: '.$iddok;
									Suratkeluar::where('marking', $marking)->update([
										'status' 		=>  'Final Form',
										'tandatangan' 	=>  'Signed Using TTE',
										'paraf1' 		=>  $iddok.'-SCO-DOWNLOAD',
									]);
								} catch (\GuzzleHttp\Exception\ClientException $e) {
									$response 				= $e->getResponse();
									$responseBodyAsString 	= $response->getBody()->getContents();
									$pesan 					= json_decode($responseBodyAsString);
									if ($pesan->error !== null){
										$pesan 				= $pesan->error;
									} else {
										$pesan				= 'gagal - 413 Request Entity Too Large';
									}
									$error		= $error.$pesan.' Untuk ID '.$getsurat->id.'<br />';
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => $error]);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat : '.$output_file.' Gagal di Upload']);
								return back();
							}
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Belum dengan ID : '.$getsurat->id.' Belum Masuk Antrian TTE']);
						return back();
					}
					
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Marking : '.$marking.' Tidak di temukan']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'File Tidak di Pilih']);
				return back();
			}
		} else if ($nmttd == 'nonomor') {
			$getpejabat			= Pejabatsurat::where('id', $kepada)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;
				$email			= $getpejabat->email;
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
				$email			= '';
			}
			$getdatalama = Suratkeluartnpnomor::where('marking', $marking)->first();
			if (isset($getdatalama->id)){
				if ($getdatalama->tandatangan == ''){
					$input = Suratkeluartnpnomor::where('marking', $marking)->update([
						'isisurat'		=> 	$namafile,
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $penandatangan,
						'namapejabat' 	=>  $setttd,
						'paraf1' 		=>  $paraf1,
						'paraf2' 		=>  $paraf2,
						'paraf3' 		=>  $paraf3,
						'paraf4' 		=>  $paraf4,
						'updated_at'	=> 	date('Y-m-d H:i:s')
					]);
					if ($input){
						$teks = '';
						Inboxsurat::where('marking', $marking)->where('jenis', 'KELUARNONOMER')->delete();
						if ($paraf1 != 'SELF'){
							$qnamapjbt	= Pejabatsurat::where('pejabat', $paraf1)->first();
							if (isset($qnamapjbt->pejabat)){
								$pejabat 	= $qnamapjbt->pejabat;
								SendMail::kiriminbox($marking,Session('nama'),$pejabat,$qnamapjbt->email,'KELUARNONOMER','PARAF','','1');
								$teks 		= 'Surat telah kami kirimkan ke '.$pejabat.' untuk di periksa (paraf)';
							} else {
								SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'KELUARNONOMER','TTD','','1');
								$teks 		= 'Surat telah kami kirimkan ke '.$penandatangan.' untuk di tandatangani secara elektronik';
							}
						} else {
							SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'KELUARNONOMER','TTD','','1');
							$teks 		= 'Surat telah kami kirimkan ke '.$penandatangan.' untuk di tandatangani secara elektronik';
						}
						if ($teks != ''){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => $teks]);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal menemukan Key : '.$marking]);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Update Gagal, Silahkan coba beberapa saat lagi']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat yang telah ditandatangani tidak bisa di ubah']);
					return back();
				}
				
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Marking Tidak diTemukan']);
				return back();
			}
		} else if ($nmttd == 'changesif') {
			$getdatalama = JadwalPiket::where('id', $idsurat)->first();
			if (isset($getdatalama->id)){
				$start_date 	= $getdatalama->tanggal;
				$presensimulai 	= $getdatalama->presensimulai;
				$presensiakhir 	= $getdatalama->presensiakhir;
				$ktl 			= $getdatalama->ktl;
				$psw 			= $getdatalama->psw;
				$getarrjam 		= explode('-', $perihal);
				$mulaikerja		= $start_date.' '.$getarrjam[0].':00';
				if ($perihal == '21:00-07:00' OR $perihal == '22:00-06:00'){
					$start_time = strtotime($start_date);
					$end_time 	= date('Y-m-d', strtotime("+1 day", $start_time));
					$akhirkerja	= $end_time.' '.$getarrjam[1].':00';
				} else {
					$akhirkerja	= $start_date.' '.$getarrjam[1].':00';
				}
				$update = JadwalPiket::where('id', $idsurat)->update([
					'shift'			=> $perihal,
					'mulaikerja'	=> $mulaikerja,
					'akhirkerja'	=> $akhirkerja,
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($update){
					$pesan 	= '';
					if ($thnagenda != $ktl){
						JadwalPiket::where('id', $idsurat)->update([
							'ktl'	=> $thnagenda,
						]);
						$ktl	= $thnagenda;
						$pesan 	= $pesan.' Data Keterlambatan di Hitung Manual';
					} else {
						if ($presensimulai == '0000-00-00 00:00:00' OR $presensimulai == null OR $presensimulai == ''){

						} else {
							$from	= strtotime($mulaikerja);
							$to		= strtotime($presensimulai);
							if ($to > $from){
								$from	= Carbon::createFromFormat('Y-m-d H:s:i', $mulaikerja);
								$to		= Carbon::createFromFormat('Y-m-d H:s:i', $presensimulai);
								$ktl 	= $from->DiffInSeconds($to);
							} else {
								$ktl = 0;
							}
						}
						JadwalPiket::where('id', $idsurat)->update([
							'ktl'	=> $ktl,
						]);
						$pesan 	= $pesan.' Data Keterlambatan di Hitung Otomatis';
					}
					if ($noagenda != $psw){
						JadwalPiket::where('id', $idsurat)->update([
							'psw'	=> $noagenda,
						]);
						$psw 	= $noagenda;
						$pesan 	= $pesan.' Data Pulang Sebelum Waktunya di Hitung Manual';
					} else {
						if ($presensiakhir == '0000-00-00 00:00:00' OR $presensiakhir == null OR $presensiakhir == ''){

						} else {
							$from	= strtotime($akhirkerja);
							$to		= strtotime($presensiakhir);
							if ($to < $from){
								$from	= Carbon::createFromFormat('Y-m-d H:s:i', $akhirkerja);
								$to		= Carbon::createFromFormat('Y-m-d H:s:i', $presensiakhir);
								$psw 	= $from->DiffInSeconds($to);
							} else {
								$psw = 0;
							}
						}
						JadwalPiket::where('id', $idsurat)->update([
							'psw'	=> $psw,
						]);
						$pesan 	= $pesan.' Data Pulang Sebelum Waktunya di Hitung Otomatis';
					}
					$total 	= $ktl + $psw;
					JadwalPiket::where('id', $idsurat)->update([
						'total'	=> $total,
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => $pesan]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Update Gagal, Silahkan coba beberapa saat lagi']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Marking Tidak diTemukan']);
				return back();
			}
		} else if ($nmttd == 'emeterai') {
			$namafile 		= 'bermeterai-'.$marking.'.pdf';
			$input = null;
			$datadiri	= Suratkeluar::where('marking', $marking)->first();
			if (!isset($datadiri->id)){
				$datadiri	= Tabelskdanperaturan::where('marking', $marking)->first();
				if (!isset($datadiri->id)){
					$datadiri	= Draftsk::where('marking', $marking)->first();
					if (!isset($datadiri->id)){
						$datadiri	= Suratkeluartnpnomor::where('marking', $marking)->first();
						if (isset($datadiri->id)){
							$input = Suratkeluartnpnomor::where('marking', $marking)->update([
								'lampiran'	=> $namafile,
								'arsip'		=> 'Archive By '.Session('nama').' at '.date('Y-m-d H:i:s')
							]);
						}
					} else {
						$input = Draftsk::where('marking', $marking)->update([
							'lampiran'	=> $namafile,
							'arsip'		=> 'Archive By '.Session('nama').' at '.date('Y-m-d H:i:s')
						]);
					}
				} else {
					$input = Tabelskdanperaturan::where('marking', $marking)->update([
						'namaparaf3'	=> $namafile,
						'arsip'			=> 'Archive By '.Session('nama').' at '.date('Y-m-d H:i:s')
					]);
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'lampiran'	=> $namafile,
					'arsip'		=> 'Archive By '.Session('nama').' at '.date('Y-m-d H:i:s')
				]);
			}
			if ($input){
				$output_file 	= '/scan/files/'. $namafile;
				try {
					Storage::disk('local')->delete($output_file);
				} catch (\Exception $e) {

				}
				$request->file('file')->move(public_path('scan/files'), $namafile);
				
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Upload Mark '.$marking.' Success']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal menemukan Key : '.$marking]);
				return back();
			}
		} else if ($nmttd == 'custom') {
			$namafile 	= $marking.'.pdf';
			$input 		= null;
			$teks		= '';
			$output_file= '/scan/files/'. $namafile;
			try {
				Storage::disk('local')->delete($output_file);
			} catch (\Exception $e) {

			}
			$request->file('file')->move(public_path('scan/files'), $namafile);
			$getpejabat			= Pejabatsurat::where('pejabat', $kepada)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;
				$email			= $getpejabat->email;
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
				$email			= '';
			}
			if ($paraf1 == '' OR is_null($paraf1)){ $paraf1 = 'SELF'; }
			if ($idsurat == 'KELUARNONOMER'){
				$input = Suratkeluartnpnomor::where('marking', $marking)->update([
					'isisurat'		=> 	$namafile,
					'idpejabat' 	=>  $idpejabat,
					'pejabat' 		=>  $penandatangan,
					'namapejabat' 	=>  $setttd,
					'pembuat' 		=>  Session('email'),
					'kelompok' 		=>  Session('jabatan'),
					'tandatangan' 	=>  'Antri TTE',
					'paraf1' 		=>  $paraf1,
					'updated_at'	=> 	date('Y-m-d H:i:s')
				]);
				Inboxsurat::where('marking', $marking)->where('jenis', 'KELUARNONOMER')->delete();
				if ($paraf1 != 'SELF'){
					$qnamapjbt	= Pejabatsurat::where('pejabat', $paraf1)->first();
					if (isset($qnamapjbt->pejabat)){
						$pejabat 	= $qnamapjbt->pejabat;
						SendMail::kiriminbox($marking,Session('nama'),$pejabat,$qnamapjbt->email,'KELUARNONOMER','PARAF','','1');
						$teks 		= 'Surat telah kami kirimkan ke '.$pejabat.' untuk di periksa (paraf)';
					} else {
						SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'KELUARNONOMER','TTD','','1');
						$teks 		= 'Surat telah kami kirimkan ke '.$penandatangan.' untuk di tandatangani secara elektronik';
					}
				} else {
					SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'KELUARNONOMER','TTD','','1');
					$teks 		= 'Surat telah kami kirimkan ke '.$penandatangan.' untuk di tandatangani secara elektronik';
				}
			}
			if ($teks != ''){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => $teks]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal menemukan Key : '.$marking]);
				return back();
			}
		} else {
			$rnamapjbt		= Pejabatsurat::where('id', $nmttd)->first();
			$pejabat 		= $rnamapjbt->pejabat;
			$nmpejabat 		= $rnamapjbt->nama;
			$nippejabat 	= $rnamapjbt->nip;
			$kodefakultas 	= $rnamapjbt->kode;
			$idpejabat 		= $rnamapjbt->id;
			$jenisnip 		= $rnamapjbt->jenis;
			$emailpenerima 	= $rnamapjbt->email;
			if ($jenisnip == '' OR $jenisnip == '-' OR is_null($jenisnip)){
				$jenisnip 	= 'NIP';
			}
			
			$periksa = '';
			if ($pejabat == $paraf1){ $periksa = 'KEMBAR'; }
			if ($pejabat == $paraf2){ $periksa = 'KEMBAR'; }
			if ($pejabat == $paraf3){ $periksa = 'KEMBAR'; }
			if ($pejabat == $paraf4){ $periksa = 'KEMBAR'; }
			if ($periksa == 'KEMBAR'){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Penandatangan Tidak Boleh Ikut memaraf..!!']);
				return back();
			} else {
				$nippejabat 	= preg_replace('/\s+/', '', $nippejabat);
				$setttd			= $nmpejabat.'<br />'.$jenisnip.''.$nippejabat;
				if ($kepada == 'SKDANPERATURAN'){
					$jenis			= $request->input('val02');
					$tanggal		= $request->input('val03');
					$dasarsuratyy	= $request->input('val10');
					$idsurat		= $request->input('val11');
					$judul			= $request->input('val12');
					$tanggalundang	= $request->input('val13');
					$idpjbperundang	= $request->input('val14');
					$nomor			= $request->input('val15');
					$dasarsuratno	= $request->input('val16');
					$pjbtperundang	= '';
					$nmpjbtperundang= '';
					$nippjbperundang= '';
					
					if ($idpjbperundang != ''){
						$getpengundang	= Pejabatsurat::where('id', $idpjbperundang)->first();
						if (isset($getpengundang->id)){
							$pjbtperundang 		= $getpengundang->pejabat;
							$nmpjbtperundang 	= $getpengundang->nama;
							$nippjbperundang 	= $getpengundang->nip;
						}
					}
					
					$dasarsurat		= '';
					$ceksuratmasuk	= Suratmasuk::where('noagenda', $dasarsuratno)->where('yersrt', $dasarsuratyy)->where('fakultas', Session('fakultas'))->first();
					if (isset($ceksuratmasuk->id)){
						$dasarsurat	= $ceksuratmasuk->scansurat;
					}
					$tahun			= date("Y");
					$getarrsurat	= explode('-', $tanggal);
					if (isset($getarrsurat[2])){
						$tahun 		= $getarrsurat[0];
					}
					$kelompok		= $jenis;
					$kode			= 'SKPP';
					if ($jenis == 'SKDANPERATURAN' OR $jenis == 'SKDANPERATURANTTE'){
						$kelompok 	= 'SKDANPERATURAN';
						$kode 		= 'SK';
					}
					if ($jenis == 'PERATURANTTE' OR $jenis == 'PERATURAN'){
						$kelompok 	= 'PERATURAN';
						$kode 		= 'PP';
					}
					if ($jenis == 'INSTRUKSITTE' OR $jenis == 'INSTRUKSI'){
						$kelompok 	= 'INSTRUKSI';
						$kode 		= 'INS';
					}
					if ($jenis == 'PERATURANTTE' OR $jenis == 'SKDANPERATURANTTE' OR $jenis == 'INSTRUKSITTE'){
						$jenissrt = 'TTE';
					} else {
						$jenissrt = 'BIASA';
					}
					if ($idsurat == 'new'){
						$ceksudah = Tabelskdanperaturan::where('kelompok', $kelompok)->where('tanggal', $tanggal)->where('nomor', $nomor)->where('fakultas', Session('fakultas'))->count();
					} else {
						$ceksudah = Tabelskdanperaturan::where('id', '!=', $idsurat)->where('kelompok', $kelompok)->where('tanggal', $tanggal)->where('nomor', $nomor)->where('fakultas', Session('fakultas'))->count();
					}
					if ($ceksudah == 0){
						$marking	= Session('fakultas').'-'.$kode.'-'.$tahun.$nomor;
						if ($idsurat == 'new'){
							$input	= Tabelskdanperaturan::create([
								'kelompok'			=> $kelompok,
								'marking'			=> $marking,
								'nomor'				=> $nomor,
								'tahun'				=> $tahun,
								'tanggal'			=> $tanggal,
								'penandatangan'		=> $pejabat,
								'idpejabat'			=> $nmttd,
								'nmpejabat'			=> $nmpejabat,
								'nippejabat'		=> $nippejabat,
								'pjbtperundang'		=> $pjbtperundang,
								'idpjbperundang'	=> $idpjbperundang,
								'nmpjbtperundang'	=> $nmpjbtperundang,
								'nippjbperundang'	=> $nippjbperundang,
								'tglpjbperundang'	=> $tanggalundang,
								'judul'				=> $judul,
								'scansurat'			=> '',
								'dasarsurat'		=> $dasarsurat,
								'dasarsuratno'		=> $dasarsuratno,
								'dasarsuratyy'		=> $dasarsuratyy,
								'kodefas'			=> 'TU.00.00.1',
								'kodesub'			=> '',
								'paraf1'			=> $paraf1,
								'paraf2'			=> $paraf2,
								'paraf3'			=> $paraf3,
								'paraf4'			=> $paraf4,
								'tandatangan'		=> 'Tandatangan Manual',
								'fakultas'			=> Session('fakultas'),
								'inputor'			=> Session('email'),
								'arsip'				=> '',
								'catatan'			=> '',
							]);
							$idsurat= $input->id;
						} else {
							$input	= Tabelskdanperaturan::where('id', $idsurat)->update([
								'marking'			=> $marking,
								'tahun'				=> $tahun,
								'penandatangan'		=> $pejabat,
								'idpejabat'			=> $nmttd,
								'nmpejabat'			=> $nmpejabat,
								'nippejabat'		=> $nippejabat,
								'pjbtperundang'		=> $pjbtperundang,
								'idpjbperundang'	=> $idpjbperundang,
								'nmpjbtperundang'	=> $nmpjbtperundang,
								'nippjbperundang'	=> $nippjbperundang,
								'tglpjbperundang'	=> $tanggalundang,
								'judul'				=> $judul,
								'dasarsurat'		=> $dasarsurat,
								'dasarsuratno'		=> $dasarsuratno,
								'dasarsuratyy'		=> $dasarsuratyy,
								'paraf1'			=> $paraf1,
								'paraf2'			=> $paraf2,
								'paraf3'			=> $paraf3,
								'paraf4'			=> $paraf4,
								'inputor'			=> Session('email'),
								'updated_at'		=> date("Y-m-d H:i:s")
							]);
						}
						if ($input){
							if ($request->hasFile('file')) {
								if ($request->input('val11') != 'new'){
									$getdata = Tabelskdanperaturan::where('id', $idsurat)->first();
									if (isset($getdata->scansurat)){
										$output_file 	= '/scan/files/'. $scansurat;
										if (file_exists(public_path($output_file))){
											Storage::disk('local')->delete($output_file);
										}
									}
								}
								$namafile		= $marking.'.pdf';
								$request->file('file')->move(public_path('scan/files'), $namafile);
								Tabelskdanperaturan::where('id', $idsurat)->update([
									'scansurat'	=> $namafile
								]);
							}
							if ($jenissrt == 'TTE'){
								$qnamapjbt	= Pejabatsurat::where('pejabat', $request->input('val06'))->first();
								if (isset($qnamapjbt->pejabat)){
									SendMail::kiriminbox($marking,Session('nama'),$qnamapjbt->pejabat,$qnamapjbt->email,'KELUAR','PARAF','SKDANPERATURAN','1');
								} else {
									SendMail::kiriminbox($marking,Session('nama'),$pejabat,$emailpenerima,'KELUAR','TTD','SKDANPERATURAN','1');
								}
								Tabelskdanperaturan::where('id', $idsurat)->update([
									'tandatangan'	=> ''
								]);
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tahun '.$tahun.' Tanggal Penetapan '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Nomor SK '.$nomor.' Sudah ada, Cek Isian Anda']);
						return back();
					}
				} else if ($kepada == 'RIWAYATSK'){
					$jenis			= $request->input('val02');
					$tanggal		= $request->input('val03');
					$dasarsuratyy	= $request->input('val10');
					$idsurat		= $request->input('val11');
					$judul			= $request->input('val12');
					$tanggalundang	= $request->input('val13');
					$idpjbperundang	= $request->input('val14');
					$nomor			= $request->input('val15');
					$kepada			= $request->input('val16');
					$pjbtperundang	= '';
					$nmpjbtperundang= '';
					$nippjbperundang= '';
					$dasarsuratno	= '';
					$dasarsurat		= '';
					$tahun			= date("Y");
					$getarrsurat	= explode('-', $tanggal);
					if (isset($getarrsurat[2])){
						$tahun 		= $getarrsurat[0];
					}
					$kelompok		= $jenis;
					$kode			= 'SKPP';
					if ($idsurat == 'new'){
						$ceksudah = Tabelskdanperaturan::where('kelompok', $kelompok)->where('tanggal', $tanggal)->where('nomor', $nomor)->where('fakultas', Session('fakultas'))->count();
					} else {
						$ceksudah = Tabelskdanperaturan::where('id', '!=', $idsurat)->where('kelompok', $kelompok)->where('tanggal', $tanggal)->where('nomor', $nomor)->where('fakultas', Session('fakultas'))->count();
					}
					if ($ceksudah == 0){
						$marking	= Session('fakultas').'-'.$kode.'-'.$tahun.$nomor;
						if ($idsurat == 'new'){
							$input	= Tabelskdanperaturan::create([
								'kelompok'			=> $kelompok,
								'marking'			=> $marking,
								'nomor'				=> $nomor,
								'tahun'				=> $tahun,
								'tanggal'			=> $tanggal,
								'penandatangan'		=> $pejabat,
								'idpejabat'			=> $nmttd,
								'nmpejabat'			=> $nmpejabat,
								'nippejabat'		=> $nippejabat,
								'pjbtperundang'		=> '',
								'idpjbperundang'	=> '',
								'nmpjbtperundang'	=> '',
								'nippjbperundang'	=> '',
								'tglpjbperundang'	=> '',
								'judul'				=> $judul,
								'scansurat'			=> '',
								'dasarsurat'		=> '',
								'dasarsuratno'		=> '',
								'dasarsuratyy'		=> '',
								'kodefas'			=> 'TU.00.00.1',
								'kodesub'			=> '',
								'paraf1'			=> 'SELF',
								'paraf2'			=> '',
								'paraf3'			=> '',
								'paraf4'			=> '',
								'tandatangan'		=> 'Tandatangan Manual',
								'fakultas'			=> Session('fakultas'),
								'inputor'			=> Session('email'),
								'arsip'				=> '',
								'catatan'			=> '',
								'sparaf1'			=> $kepada,
							]);
							$idsurat= $input->id;
						} else {
							$input	= Tabelskdanperaturan::where('id', $idsurat)->update([
								'marking'			=> $marking,
								'tahun'				=> $tahun,
								'penandatangan'		=> $pejabat,
								'idpejabat'			=> $nmttd,
								'nmpejabat'			=> $nmpejabat,
								'nippejabat'		=> $nippejabat,
								'judul'				=> $judul,
								'inputor'			=> Session('email'),
								'updated_at'		=> date("Y-m-d H:i:s"),
								'sparaf1'			=> $kepada,
							]);
						}
						if ($input){
							if ($request->hasFile('file')) {
								if ($request->input('val11') != 'new'){
									$getdata = Tabelskdanperaturan::where('id', $idsurat)->first();
									if (isset($getdata->scansurat)){
										$output_file 	= '/scan/files/'. $scansurat;
										if (file_exists(public_path($output_file))){
											Storage::disk('local')->delete($output_file);
										}
									}
								}
								$namafile		= $marking.'.pdf';
								$request->file('file')->move(public_path('scan/files'), $namafile);
								Tabelskdanperaturan::where('id', $idsurat)->update([
									'scansurat'	=> $namafile
								]);
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tahun '.$tahun.' Tanggal Penetapan '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Nomor SK '.$nomor.' Sudah ada, Cek Isian Anda']);
						return back();
					}
				} else if ($kepada == 'RIWAYATSURAT'){
					$jenis			= $request->input('val02');
					$tanggal		= $request->input('val03');
					$idsurat		= $request->input('val11');
					$perihal		= $request->input('val12');
					$nomor			= $request->input('val15');
					$kepada			= $request->input('val16');
					$tahun			= date("Y");
					$getarrsurat	= explode('-', $tanggal);
					if (isset($getarrsurat[2])){
						$tahun 		= $getarrsurat[0];
						$mm			= $getarrsurat[1];
						$dd			= $getarrsurat[2];
					} else {
						$tahun 		= date('Y');
						$mm			= date('m');
						$dd			= date('d');
					}
					
					if ($idsurat == 'new'){
						$ceksudah = Suratkeluar::where('nomor', $nomor)->where('tanggal', $tanggal)->where('fakultas', Session('fakultas'))->count();
					} else {
						$ceksudah = Suratkeluar::where('id', '!=', $idsurat)->where('nomor', $nomor)->where('tanggal', $tanggal)->where('fakultas', Session('fakultas'))->count();
					}
					if ($ceksudah == 0){
						$marking	= Session('fakultas').'-'.$kodefakultas.'-'.$tahun.'.'.$nomor;
						if ($idsurat == 'new'){
							$input 		= Suratkeluar::create([
								'marking' 		=>  $marking,
								'jenissrt' 		=>  'BIASA',
								'nomor' 		=>  $nomor,
								'anakno' 		=>  '',
								'kodefak' 		=>  $kodefakultas,
								'unit' 			=>  $unit,
								'tglsurat' 		=>  $tanggal,
								'daysrt' 		=>  $dd,
								'monsrt' 		=>  $mm,
								'yersrt' 		=>  $tahun,
								'dasarsurat' 	=>  '',
								'kepada' 		=>  $kepada,
								'alamat' 		=>  '',
								'perihal' 		=>  $perihal,
								'lampiran' 		=>  '',
								'isisurat' 		=>  '',
								'idpejabat' 	=>  $nmttd,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  '',
								'sifat' 		=>  'Biasa',
								'klasifikasi' 	=>  'Biasa',
								'pembuat' 		=>  Session('email'),
								'kelompok' 		=>  Session('previlage'),
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
								'fakultas' 		=>  Session('fakultas')
							]);
							$idsurat	= $input->id;
						} else {
							$getkepadalm= Suratkeluar::where('id', $idsurat)->first();
							if (isset($getkepadalm->kepada)){
								$kpdlm 	= $getkepadalm->kepada; 
							} else {
								$kpdlm	= '';
							}
							$input 		= Suratkeluar::where('id', $idsurat)->update([
								'kepada' 		=>  $kepada,
								'alamat' 		=>  $kpdlm,
								'pembuat'		=> 	Session('email'),
								'kelompok'		=> 	Session('previlage'),
								'updated_at'	=>	date("Y-m-d H:i:s")
							]);
						}
						if ($input){
							if ($request->hasFile('file')) {
								if ($request->input('val11') != 'new'){
									$getdata = Suratkeluar::where('id', $idsurat)->first();
									if (isset($getdata->isisurat)){
										$output_file 	= '/scan/files/'. $isisurat;
										if (file_exists(public_path($output_file))){
											Storage::disk('local')->delete($output_file);
										}
									}
								}
								$namafile		= $marking.'.pdf';
								$request->file('file')->move(public_path('scan/files'), $namafile);
								Suratkeluar::where('id', $idsurat)->update([
									'isisurat'	=> $namafile
								]);
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tahun '.$tahun.' Tanggal Penetapan '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						if ($idsurat == 'new'){
							$getkepadalm= Suratkeluar::where('nomor', $nomor)->where('tanggal', $tanggal)->where('fakultas', Session('fakultas'))->first();
							if (isset($getkepadalm->kepada)){
								$kpdlm 	= $getkepadalm->kepada; 
							} else {
								$kpdlm	= '';
							}
							Suratkeluar::where('nomor', $nomor)->where('tanggal', $tanggal)->where('fakultas', Session('fakultas'))->update([
								'kepada'		=> 	$email,
								'alamat' 		=> 	$kpdlm,
								'pembuat'		=> 	Session('email'),
								'kelompok'		=> 	Session('previlage'),
								'updated_at'	=>	date("Y-m-d H:i:s")
							]);
						} else {
							$getkepadalm= Suratkeluar::where('id', $idsurat)->first();
							if (isset($getkepadalm->kepada)){
								$kpdlm 	= $getkepadalm->kepada; 
							} else {
								$kpdlm	= '';
							}
							Suratkeluar::where('id', $idsurat)->update([
								'kepada'		=> 	$email,
								'alamat' 		=> 	$kpdlm,
								'pembuat'		=> 	Session('email'),
								'kelompok'		=> 	Session('previlage'),
								'updated_at'	=>	date("Y-m-d H:i:s")
							]);
						}
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Nomor Surat '.$nomor.' Sudah ada, Surat Akan Kami Linkkan dengan Email '.$email]);
						return back();
					}
				} else if ($kepada == 'SKDOSPEM'){
					$rom  				= Antrian::where('id', $idsurat)->first();
					$jenjang			= $rom->jenis;
					$nama				= $rom->instansi;
					$alamat				= $rom->alamat;
					$kota				= $rom->kota;
					$mhs 				= $rom->nama;
					$nim 				= $rom->nim;
					$ps 				= $rom->ps;
					$hape 				= $rom->hape;
					$smt				= $rom->smt;
					$judul				= $rom->judul;
					$dos1 				= $rom->dos1;
					$dos2 				= $rom->dos2;
					$jur 				= $rom->jurusan;
					$lokasi				= $rom->lokasi;
					$bulan				= $rom->bulan;
					$whatfor			= $rom->whatfor;
					$whatfor2			= $rom->whatfor2;
					$kodjenis			= $rom->kodjenis;
					$ket				= $rom->ket;
					$ortu				= $rom->ortu;
					$jabortu			= $rom->jabortu;
					$golortu			= $rom->golortu;
					$niportu			= $rom->niportu;
					$kerjaortu			= $rom->kerjaortu;
					$tmpkrjortu			= $rom->tmpkrjortu;
					$tmplahir			= $rom->tmplahir;
					$tgllahir			= $rom->tgllahir;
					$pada				= $rom->pada;
					$alasan				= $rom->alasan;
					$dosen				= $rom->dosen;
					$matkul				= $rom->matkul;
					$cutismt			= $rom->cutismt;
					$cutislm			= $rom->cutislm;
					$cutita				= $rom->cutita;
					$asal				= $rom->asal;
					$tembusan1			= $rom->tembusan1;
					$tembusan2			= $rom->tembusan2;
					$tembusan3			= $rom->tembusan3;
					$tembusan4			= $rom->tembusan4;
					$tembusan5			= $rom->tembusan5;
					$nosurat			= $rom->nosurat;
					$tglsurat			= $rom->tglsurat;
					$tandatangan		= $rom->tandatangan;
					$aktife				= $rom->aktife;
					$tglttd				= $rom->updated_at;
					$fakultas			= $rom->fakultas;
					$keterangan			= $rom->keterangan;
					$namasaja			= $nmpejabat;
					$ceksurat			= explode("-SCO-", $tandatangan);
					if (isset($ceksurat[1]) OR $tandatangan == 'SIgned With TTE'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
						return back();
					} else {
						if ($tglsurat == $tanggal AND file_exists(public_path('scan/files/'.$keterangan))){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali, Bila Ingin Memperbaharui, Ubah Tanggal SK ini']);
							return back();
						} else {
							if ($fakultas == 'Vokasi' OR $fakultas == 'PASCAUB'){
								$dekan = 'Direktur';
							} else {
								$dekan = 'Dekan';
							}
							$getnamafakultas	= 	User::where('fakultas', $rom->fakultas)->where('fakpanjang', '!=', '')->first();
							if (isset($getnamafakultas->fakpanjang)){
								$fakpanjang 	= 	$getnamafakultas->fakpanjang;
							} else { $fakpanjang = ''; }
							if ($tglsurat == '0000-00-00' OR is_null($tglsurat) OR $tglsurat == ''){
								$tglsurat 	= $tanggal;
							}
							$arrytgl	= explode("-", $tglsurat);
							$yy			= $arrytgl[0];
							$mm			= $arrytgl[1];
							$dd			= $arrytgl[2];
							$mmsk		= (int)$mm;
							$mmsk		= $kalender[$mmsk];
							$tglsurat	= $dd.' '.$mmsk.' '.$yy;
							if ($jenjang == 'Doktor S3'){
								$setjen		= 'Disertasi';
								$jenjang	= 'Doktor';
								$kodejenjang= 'S-3';
							} else if ($jenjang == 'Magister S2'){
								$setjen		= 'Tesis';
								$jenjang	= 'Magister';
								$kodejenjang= 'S-2';
							} else if ($jenjang == 'Sarjana S1'){
								$setjen		= 'Skripsi';
								$jenjang	= 'Sarjana';
								$kodejenjang= 'S-1';
							} else {
								$setjen		= 'Tugas Akhir';
								$jenjang	= 'Diploma';
								$kodejenjang= 'D-3';	
							}
							$angkatan1	= '';
							$angkatan2	= '';
							$arrnime 	= str_split($nim);
							foreach($arrnime as $rnim){
								if ($angkatan1 == ''){ $angkatan1 = $rnim; }
								if ($angkatan2 == ''){ $angkatan2 = $rnim; }
							}
							$angkatan 	= $angkatan1.$angkatan2;
							$intangkatan= (int)$angkatan;
							$angkatan3 	= $intangkatan + 1;
							if ($intangkatan < 10){
								$angkatan= '200'.$intangkatan.'/200'.$angkatan3;
							} else {
								$angkatan= '20'.$intangkatan.'/20'.$angkatan3;
							}
							$pbimbing1		= '';
							$pbimbing2		= '';
							$pbimbing3		= '';
							$nipbimbing1	= '';
							$nipbimbing2	= '';
							$nipbimbing3	= '';
							$jabakademik1	= '';
							$jabakademik2	= '';
							$jabakademik3	= '';
							$tulispbimbing3	= '';
							$getpersetujuan	= Antrian::where('nim', $nim)->where('ket', $ket)->where('kerjaortu', 'SETUJU')->groupBy('dos1')->get();
							if (!empty($getpersetujuan)){
								foreach ($getpersetujuan as $rowdos){
									if ($rowdos->pada == 'Ketua Komisi Pembimbing'){
										$pbimbing1 	= $rowdos->dos1;
										$nipbimbing1= $rowdos->dos2;
									} else {
										if ($pbimbing2 == ''){
											$pbimbing2 	= $rowdos->dos1;
											$nipbimbing2= $rowdos->dos2;			
										} else {
											$pbimbing3 	= $rowdos->dos1;
											$nipbimbing3= $rowdos->dos2;	
										}
									}
								}
							}
							if ($nipbimbing1 != ''){
								$getjab1		= Dosen::where('nip', $nipbimbing1)->where('fakultas', $fakultas)->first();
								if (isset($getjab1->fungsional)){
									$pbimbing1 		= $getjab1->gelar;
									$jabakademik1 	= $getjab1->fungsional;
								}
							}
							if ($nipbimbing2 != ''){
								$getjab2		= Dosen::where('nip', $nipbimbing2)->where('fakultas', $fakultas)->first();
								if (isset($getjab2->fungsional)){
									$pbimbing2 		= $getjab2->gelar;
									$jabakademik2 	= $getjab2->fungsional;
								}
							}
							if ($nipbimbing3 != ''){
								$getjab3		= Dosen::where('nip', $nipbimbing3)->where('fakultas', $fakultas)->first();
								if (isset($getjab3->fungsional)){
									$pbimbing3 		= $getjab3->gelar;
									$jabakademik3 	= $getjab3->fungsional;
								}
								$tulispbimbing3	= '
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>3.</td>
									<td colspan="4">'.$pbimbing3.'</td>
									</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan="4">( '.$jabakademik3.' ) sebagai Anggota</td>
								</tr>';
							}
							$marking		= $fakultas.'-SKDOSPEM-'.$idsurat;
							$output_file 	= '/scan/files/'. $marking.'.pdf';
							if (file_exists(public_path($output_file))){
								Storage::disk('local')->delete($output_file);
							}
							$namafile		= $marking.'.pdf';
							$alamatweb		= $homebase.'/viewdocbyname/'.$marking.'.pdf';
							$setview		= 'DOWNLOAD';
							$spasi			= '';
							$ukuranfont		= '12';
							$jenisfontte	= '<font size="7" color="blue">';
							$fontstyle		= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"';
							$qrcode 		= QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($alamatweb);
							$qrimage 		= 'scan/generate/qrimg-'. $marking.'.png';
							Storage::disk('local')->put($qrimage, $qrcode);
							$jamtte			= date("H:m:i");
							$lebarttd 		= '50%';
							$getnamasaja 	= Simpegpegawai::where('nip_baru', $nippejabat)->first();
							if (isset($getnamasaja->nama)){
								$namasaja	= $getnamasaja->nama;
							}
							$tuliskodettd	= '<table width="300" border="0" cellpadding="0" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
								<tr><td colspan="2">Ditetapkan di '.$swandhanakota.'</td></tr>
								<tr><td colspan="2">pada tanggal '.$tglsurat.'</td></tr>
								<tr><td colspan="2">'.$pejabat.',</td> </tr>
								<tr>
									<td width="100"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="100" /></td>
									<td align="left" valign="center" width="150">
										<font color="white">&nbsp;</font>'.$jenisfontte.'<br />
											TTE oleh :<br />
											<strong>'.$namasaja.'</strong><br />
											'.$tanggal.' '.$jamtte.'<br /><br />
											Verifikasi melalui<br /> https://tte.kominfo.go.id/verifyPDF
										</font>
									</td>
								</tr>
								<tr><td colspan="2">'.$nmpejabat.'</td></tr>
								<tr><td colspan="2">NIP'.$nippejabat.'</td></tr>
							</table>';
						
							$info = array(
								'Name' 			=> 'Smart and Collaborative Office',
								'Location' 		=> config('global.swandhanauniv'),
								'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
								'ContactInfo' 	=> $homebase,
							);
							$page_format	= array(
								'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 330),
								'Dur' => 3,
								'PZ' => 1,
							);
							$data['judul']    			= $rom->judul;
							$data['universitasbesar']   = strtoupper($universitas);
							$data['universitas']        = $universitas;
							$data['nomor']          	= $nomor;
							$data['tahun']          	= $yy;
							$data['jenjangbesar']       = strtoupper($jenjang);
							$data['jenjang']          	= $jenjang;
							$data['peesbesar']          = strtoupper($ps);
							$data['pees']          		= $ps;
							$data['angkatan']          	= $angkatan;
							$data['pbimbing1']          = $pbimbing1;
							$data['jabakademik1']       = $jabakademik1;
							$data['pbimbing2']          = $pbimbing2;
							$data['jabakademik2']       = $jabakademik2;
							$data['tulispbimbing3']     = $tulispbimbing3;
							$data['nama']          		= $mhs;
							$data['nim']          		= $nim;
							$data['kodejenjang']        = $kodejenjang;
							$data['tandatangan']        = $tuliskodettd;
							$data['setjen']				= $setjen;
							$data['setjenbesar']		= strtoupper($setjen);
							$data['dekanbesar']			= strtoupper($dekan);
							if ($fakultas == 'FMIPA'){
								$data['fakpanjang']     = 'Fakultas MIPA';
								$data['fakultasbesar']  = 'FAKULTAS MIPA';
								$text 					= view('cetak.akademik.skdospem', $data);
							} else {
								$data['fakpanjang']     = $fakpanjang;
								$data['fakultasbesar']  = strtoupper($fakpanjang);
								$text 					= view('vokasi.cetak.sempro.skdospem', $data);
							}
							PDFCREATOR::SetCreator(Session('nama'));
							PDFCREATOR::SetAuthor(Session('previlage'));
							PDFCREATOR::SetTitle($kodjenis);
							PDFCREATOR::SetSubject($mhs);
							PDFCREATOR::SetKeywords($nim);
							PDFCREATOR::setPrintHeader(false);
							PDFCREATOR::setPrintFooter(false);
							PDFCREATOR::SetMargins(5, 0, 5);
							PDFCREATOR::setFontSubsetting(true);
							PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							$img_file = 'bgbssn.png';
							PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->delete($output_file);
							Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
							$ceksek 	= Tabelskdanperaturan::where('marking', $marking)->count();
							if ($ceksek == 0){
								$kerjanya = Tabelskdanperaturan::create([
									'kelompok'			=> 	'KEPUTUSAN',
									'marking'			=> 	$marking,
									'nomor' 			=>  $request->input('val02'),
									'tahun' 			=>  $tahun,
									'tanggal' 			=>  $request->input('val03'),
									'penandatangan' 	=>  $pejabat,
									'nmpejabat' 		=>  $nmpejabat,
									'nippejabat' 		=>  $nippejabat,
									'judul' 			=>  $rom->kodjenis.' an. '.$rom->nama.' NIM '.$rom->nim,
									'scansurat' 		=>  $marking,
									'kodefas' 			=>  'HK.04.03',
									'kodesub' 			=>  'TD.06.01',
									'paraf1' 			=>  $request->input('val06'),
									'paraf2' 			=>  $paraf2,
									'paraf3' 			=>  $paraf3,
									'paraf4' 			=>  $paraf4,
									'fakultas' 			=>  Session('fakultas'),
									'inputor' 			=>  Session('email'),
									'updated_at'		=>	date("Y-m-d H:i:s")
								]);
							} else {
								$kerjanya = Tabelskdanperaturan::where('marking', $marking)->update([
									'kelompok'			=> 	'KEPUTUSAN',
									'marking'			=> 	$marking,
									'nomor' 			=>  $request->input('val02'),
									'tahun' 			=>  $tahun,
									'tanggal' 			=>  $request->input('val03'),
									'penandatangan' 	=>  $pejabat,
									'nmpejabat' 		=>  $nmpejabat,
									'nippejabat' 		=>  $nippejabat,
									'judul' 			=>  $rom->kodjenis.' an. '.$rom->nama.' NIM '.$rom->nim,
									'scansurat' 		=>  $marking,
									'kodefas' 			=>  'HK.04.03',
									'kodesub' 			=>  'TD.06.01',
									'paraf1' 			=>  $request->input('val06'),
									'paraf2' 			=>  $paraf2,
									'paraf3' 			=>  $paraf3,
									'paraf4' 			=>  $paraf4,
									'fakultas' 			=>  Session('fakultas'),
									'inputor' 			=>  Session('email'),
									'updated_at'		=>	date("Y-m-d H:i:s")
								]);
							}
							if ($kerjanya){
								Antrian::where('id', $idsurat)->update([
									'nosurat'		=> $nomor,
									'tglsurat'		=> $request->input('val03'),
									'pejabat'		=> $pejabat,
									'nmpejabat'		=> $nmpejabat,
									'nippejabat'	=> $nippejabat,
									'keterangan'	=> $marking.'.pdf'
								]);
								Inboxsurat::where('marking', $marking)->where('catatan', 'SKDANPERATURAN')->delete();
								$qnamapjbt	= Pejabatsurat::where('pejabat', $request->input('val06'))->first();
								if (isset($qnamapjbt->pejabat)){
									SendMail::kiriminbox($marking,Session('nama'),$qnamapjbt->pejabat,$qnamapjbt->email,'KELUAR','PARAF','SKDANPERATURAN','1');
								} else {
									SendMail::kiriminbox($marking,Session('nama'),$pejabat,$emailpenerima,'KELUAR','TTD','SKDANPERATURAN','1');
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tahun '.$tahun.' Tanggal Penetapan '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
								return back();
							}else{
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
								return back();
							}
						}
					}
				} else if ($kepada == 'SKDOSPENGUJI'){
					$rom  				= Antrian::where('id', $idsurat)->first();
					$jenjang			= $rom->jenis;
					$nama				= $rom->instansi;
					$alamat				= $rom->alamat;
					$kota				= $rom->kota;
					$mhs 				= $rom->nama;
					$nim 				= $rom->nim;
					$ps 				= $rom->ps;
					$hape 				= $rom->hape;
					$smt				= $rom->smt;
					$judul				= $rom->judul;
					$dos1 				= $rom->dos1;
					$dos2 				= $rom->dos2;
					$jur 				= $rom->jurusan;
					$lokasi				= $rom->lokasi;
					$bulan				= $rom->bulan;
					$whatfor			= $rom->whatfor;
					$whatfor2			= $rom->whatfor2;
					$kodjenis			= $rom->kodjenis;
					$ket				= $rom->ket;
					$ortu				= $rom->ortu;
					$jabortu			= $rom->jabortu;
					$golortu			= $rom->golortu;
					$niportu			= $rom->niportu;
					$kerjaortu			= $rom->kerjaortu;
					$tmpkrjortu			= $rom->tmpkrjortu;
					$tmplahir			= $rom->tmplahir;
					$tgllahir			= $rom->tgllahir;
					$pada				= $rom->pada;
					$alasan				= $rom->alasan;
					$dosen				= $rom->dosen;
					$matkul				= $rom->matkul;
					$cutismt			= $rom->cutismt;
					$cutislm			= $rom->cutislm;
					$cutita				= $rom->cutita;
					$asal				= $rom->asal;
					$tembusan1			= $rom->tembusan1;
					$tembusan2			= $rom->tembusan2;
					$tembusan3			= $rom->tembusan3;
					$tembusan4			= $rom->tembusan4;
					$tembusan5			= $rom->tembusan5;
					$nosurat			= $rom->nosurat;
					$tglsurat			= $rom->tglsurat;
					$tandatangan		= $rom->tandatangan;
					$keterangan			= $rom->keterangan;
					$aktife				= $rom->aktife;
					$tglttd				= $rom->updated_at;
					$fakultas			= $rom->fakultas;
					$namasaja			= $nmpejabat;
					$ceksurat			= explode("-SCO-", $tandatangan);
					if (isset($ceksurat[1]) OR $tandatangan == 'SIgned With TTE'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
						return back();
					} else {
						if ($tglsurat == $tanggal AND file_exists(public_path('scan/files/'.$keterangan))){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali, Bila Ingin Memperbaharui, Ubah Tanggal SK ini']);
							return back();
						} else {
							if ($fakultas == 'Vokasi' OR $fakultas == 'PASCAUB'){
								$dekan = 'Direktur';
							} else {
								$dekan = 'Dekan';
							}
							$periode			= 	'';
							$jenis				= 	'';
							$tglujian			= 	'';
							$getjenisujian		= 	AntrianUjian::where('id', $ket)->first();
							if (isset($getjenisujian->id)){
								$jenis			= 	$getjenisujian->jenis;
								$tglujian		= 	$getjenisujian->tanggal;
								if ($tglujian == '0000-00-00' OR is_null($tglujian) OR $tglujian == ''){
									$tglujian 	= $tanggal;
								}
								$arrytgl		= explode("-", $tglujian);
								$yy				= $arrytgl[0];
								$mm				= $arrytgl[1];
								$dd				= $arrytgl[2];
								$mmsk			= (int)$mm;
								$mmsk			= $kalender[$mmsk];
								$tglujian		= $dd.' '.$mmsk.' '.$yy;
								$periode		= strtoupper($mmsk);
								$periode		= $periode.' '.$yy; 
							}
							$getnamafakultas	= 	User::where('fakultas', $rom->fakultas)->where('fakpanjang', '!=', '')->first();
							if (isset($getnamafakultas->fakpanjang)){
								$fakpanjang 	= 	$getnamafakultas->fakpanjang;
							} else { $fakpanjang = ''; }
							if ($tglsurat == '0000-00-00' OR is_null($tglsurat) OR $tglsurat == ''){
								$tglsurat 	= $tanggal;
							}
							$arrytgl	= explode("-", $tglsurat);
							$yy			= $arrytgl[0];
							$mm			= $arrytgl[1];
							$dd			= $arrytgl[2];
							$mmsk		= (int)$arrytgl[1];
							$mmsk		= $kalender[$mmsk];
							$tglsurat	= $dd.' '.$mmsk.' '.$yy;
							if ($rom->jenis == 'Doktor S3'){
								$setjen		= 'Disertasi';
								$jenjang	= 'Doktor';
								$kodejenjang= 'S-3';
							} else if ($rom->jenis == 'Magister S2'){
								$setjen		= 'Tesis';
								$jenjang	= 'Magister';
								$kodejenjang= 'S-2';
							} else if ($rom->jenis == 'Sarjana S1'){
								$setjen		= 'Skripsi';
								$jenjang	= 'Sarjana';
								$kodejenjang= 'S-1';
							} else {
								$setjen		= 'Tugas Akhir';
								$jenjang	= 'Diploma';
								$kodejenjang= 'D-3';	
							}
							if ($jenis == 'sempro'){
								$setjen = 'Proposal '.$setjen;
							} else if ($jenis == 'semhas'){
								$setjen = 'Seminar Hasil Penelitian '.$setjen;
							} else if ($jenis == 'ujian'){
								//tetap
							} else {
								if ($jenis != ''){
									$setjen = $jenis;
								}
							}
							
							$angkatan1	= '';
							$angkatan2	= '';
							$arrnime 	= str_split($nim);
							foreach($arrnime as $rnim){
								if ($angkatan1 == ''){ $angkatan1 = $rnim; }
								if ($angkatan2 == ''){ $angkatan2 = $rnim; }
							}
							$angkatan 	= $angkatan1.$angkatan2;
							$intangkatan= (int)$angkatan;
							$angkatan3 	= $intangkatan + 1;
							if ($intangkatan < 10){
								$angkatan= '200'.$intangkatan.'/200'.$angkatan3;
							} else {
								$angkatan= '20'.$intangkatan.'/20'.$angkatan3;
							}
							if ($rom->jenis == 'Doktor S3'){
								$getpembimbing	= Biodata::where('nimmhs', $nim)->first();
								if (isset($getpembimbing->id)){
									$bimbing1	= $getpembimbing->bimbing1;
									$bimbing2	= $getpembimbing->bimbing2;
									$bimbing3	= $getpembimbing->bimbing3;
									$getbimb1	= Dosen::where('id', $bimbing1)->first();
									if (isset($getbimb1->gelar)){
										$bimbing1 = $getbimb1->gelar;
									}
									$getbimb2	= Dosen::where('id', $bimbing2)->first();
									if (isset($getbimb2->gelar)){
										$bimbing2 = $getbimb2->gelar;
									}
									$getbimb3	= Dosen::where('id', $bimbing3)->first();
									if (isset($getbimb3->gelar)){
										$bimbing3 = $getbimb3->gelar;
									}
								} else {
									$bimbing1	= '';
									$bimbing2	= '';
									$bimbing3	= '';
								}
								$tulispbimbing2	= '';
								$nomor			= 1;
								$getpersetujuan	= Antrian::where('nim', $nim)->where('ket', $ket)->where('kodjenis', 'Nilai Ujian')->groupBy('dos1')->orderBy('id', 'ASC')->get();
								if (!empty($getpersetujuan)){
									foreach ($getpersetujuan as $rowdos){
										if ($rowdos->dos1 == $bimbing1 OR $bimbing1 == '' OR is_null($bimbing1) OR $rowdos->lokasi == 'KETUA'){
											$bimbing1 = $rowdos->dos1;
										} else if ($rowdos->dos1 == $bimbing2 OR $bimbing2 == '' OR is_null($bimbing2)){
											$bimbing2 = $rowdos->dos1;
										} else if ($rowdos->dos1 == $bimbing3 OR $bimbing3 == '' OR is_null($bimbing3)){
											$bimbing3 = $rowdos->dos1;
										} else {
											$tulispbimbing2	= $tulispbimbing2.'
												<tr>
													<td>Penguji '.$nomor.'</td>
													<td>'.$rowdos->dos1.'</td>
												</tr>';
											$nomor++;
										}
									}
								}
								$tulispbimbing	= '<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan="5">
										<table border="1" width="450" cellpadding="0" cellspacing="0">
											<tr>
												<td width="200" align="center">Promotor dan Penguji</td>
												<td width="250" align="center">Nama</td>
											</tr>
											<tr>
												<td width="200">Promotor</td>
												<td width="250">'.$bimbing1.'</td>
											</tr>
											<tr>
												<td>Ko-Promotor 1</td>
												<td>'.$bimbing2.'</td>
											</tr>
											<tr>
												<td>Ko-Promotor 2</td>
												<td>'.$bimbing3.'</td>
											</tr>'.$tulispbimbing2.'</table></td></tr>';
							} else {
								$pbimbing1		= '';
								$nipbimbing1	= '';
								$tulispbimbing2	= '';
								$nomor			= 2;
								$getpersetujuan	= Antrian::where('nim', $nim)->where('ket', $ket)->where('kodjenis', 'Nilai Ujian')->groupBy('dos1')->orderBy('lokasi', 'DESC')->get();
								if (!empty($getpersetujuan)){
									foreach ($getpersetujuan as $rowdos){
										if ($rowdos->lokasi == 'KETUA' OR $pbimbing1 == ''){
											$pbimbing1 	= $rowdos->dos1;
											$nipbimbing1= $rowdos->dos2;
										} else {
											$tulispbimbing2	= $tulispbimbing2.'
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>'.$nomor.'.</td>
													<td colspan="4">'.$rowdos->dos1.'</td>
													</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td colspan="4">sebagai Anggota</td>
												</tr>';
											$nomor++;
										}
									}
								}
								$tulispbimbing	= '
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>1.</td>
													<td colspan="4">'.$pbimbing1.'</td>
													</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td colspan="4">sebagai Ketua</td>
												</tr>'.$tulispbimbing2;
							}
							$marking		= $fakultas.'-SKDOSPENGUJI-'.$idsurat;
							$output_file 	= '/scan/files/'. $marking.'.pdf';
							if (file_exists(public_path($output_file))){
								Storage::disk('local')->delete($output_file);
							}
							$namafile		= $marking.'.pdf';
							$alamatweb		= $homebase.'/viewdocbyname/'.$marking.'.pdf';
							$setview		= 'DOWNLOAD';
							$spasi			= '';
							$ukuranfont		= '12';
							$jenisfontte	= '<font size="7" color="blue">';
							$fontstyle		= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"';
							$qrcode 		= QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($alamatweb);
							$qrimage 		= 'scan/generate/qrimg-'. $marking.'.png';
							Storage::disk('local')->put($qrimage, $qrcode);
							$jamtte			= date("H:m:i");
							$lebarttd 		= '50%';
							$getnamasaja 	= Simpegpegawai::where('nip_baru', $nippejabat)->first();
							if (isset($getnamasaja->nama)){
								$namasaja	= $getnamasaja->nama;
							}
							$info = array(
								'Name' 			=> 'Smart and Collaborative Office',
								'Location' 		=> config('global.swandhanauniv'),
								'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
								'ContactInfo' 	=> $homebase,
							);
							$page_format	= array(
								'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 330),
								'Dur' => 3,
								'PZ' => 1,
							);
							if ($fakultas == 'FMIPA'){
								$data['fakpanjang']     = 'Fakultas MIPA';
								$data['fakultasbesar']  = 'FAKULTAS MIPA';
								$tuliskodettd	= '<table width="300" border="0" cellpadding="0" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
														<tr><td colspan="2">Ditetapkan di '.$swandhanakota.'</td></tr>
														<tr><td colspan="2">pada tanggal '.$tglsurat.'</td></tr>
														<tr><td colspan="2">Dekan Fakultas MIPA,</td> </tr>
														<tr>
															<td width="100"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="100" /></td>
															<td align="left" valign="center" width="150">
																<font color="white">&nbsp;</font>'.$jenisfontte.'<br />
																	TTE oleh :<br />
																	<strong>'.$namasaja.'</strong><br />
																	'.$tanggal.' '.$jamtte.'<br /><br />
																	Verifikasi melalui<br /> https://tte.kominfo.go.id/verifyPDF
																</font>
															</td>
														</tr>
														<tr><td colspan="2">'.$nmpejabat.'</td></tr>
														<tr><td colspan="2">NIP'.$nippejabat.'</td></tr>
													</table>';
							} else {
								$data['fakpanjang']     = $fakpanjang;
								$data['fakultasbesar']  = strtoupper($fakpanjang);
								$tuliskodettd	= '<table width="300" border="0" cellpadding="0" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
														<tr><td colspan="2">Ditetapkan di '.$swandhanakota.'</td></tr>
														<tr><td colspan="2">pada tanggal '.$tglsurat.'</td></tr>
														<tr><td colspan="2">'.$pejabat.',</td> </tr>
														<tr>
															<td width="100"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="100" /></td>
															<td align="left" valign="center" width="150">
																<font color="white">&nbsp;</font>'.$jenisfontte.'<br />
																	TTE oleh :<br />
																	<strong>'.$namasaja.'</strong><br />
																	'.$tanggal.' '.$jamtte.'<br /><br />
																	Verifikasi melalui<br /> https://tte.kominfo.go.id/verifyPDF
																</font>
															</td>
														</tr>
														<tr><td colspan="2">'.$nmpejabat.'</td></tr>
														<tr><td colspan="2">NIP'.$nippejabat.'</td></tr>
													</table>';
							}
							$data['judul']    			= $rom->judul;
							$data['universitasbesar']   = strtoupper($universitas);
							$data['universitas']        = $universitas;
							$data['nomor']          	= $nomor;
							$data['tahun']          	= $yy;
							$data['jenjangbesar']       = strtoupper($jenjang);
							$data['jenjang']          	= $jenjang;
							$data['peesbesar']          = strtoupper($ps);
							$data['pees']          		= $ps;
							$data['angkatan']          	= $angkatan;
							$data['tulispbimbing']     	= $tulispbimbing;
							$data['nama']          		= $mhs;
							$data['nim']          		= $nim;
							$data['kodejenjang']        = $kodejenjang;
							$data['tandatangan']        = $tuliskodettd;
							$data['setjen']				= $setjen;
							$data['periode']			= $periode;
							$data['tglujian']			= $tglujian;
							$data['setjenbesar']		= strtoupper($setjen);
							$data['dekanbesar']			= strtoupper($dekan);
							if ($jenjang == 'Doktor S3'){
								$text 					= view('cetak.akademik.skdospengujis3', $data);
							} else {
								$text 					= view('cetak.akademik.skdospenguji', $data);
							}
							PDFCREATOR::SetCreator(Session('nama'));
							PDFCREATOR::SetAuthor(Session('previlage'));
							PDFCREATOR::SetTitle($kodjenis);
							PDFCREATOR::SetSubject($mhs);
							PDFCREATOR::SetKeywords($nim);
							PDFCREATOR::setPrintHeader(false);
							PDFCREATOR::setPrintFooter(false);
							PDFCREATOR::SetMargins(5, 0, 5);
							PDFCREATOR::setFontSubsetting(true);
							PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							$img_file = 'bgbssn.png';
							PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->delete($output_file);
							Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
							$ceksek 	= Tabelskdanperaturan::where('marking', $marking)->count();
							if ($ceksek == 0){
								$kerjanya = Tabelskdanperaturan::create([
									'kelompok'			=> 	'KEPUTUSAN',
									'marking'			=> 	$marking,
									'nomor' 			=>  $request->input('val02'),
									'tahun' 			=>  $yy,
									'tanggal' 			=>  $request->input('val03'),
									'penandatangan' 	=>  $pejabat,
									'nmpejabat' 		=>  $nmpejabat,
									'nippejabat' 		=>  $nippejabat,
									'judul' 			=>  $rom->kodjenis.' an. '.$rom->nama.' NIM '.$rom->nim,
									'scansurat' 		=>  $marking,
									'kodefas' 			=>  'HK.04.03',
									'kodesub' 			=>  'TD.06.01',
									'paraf1' 			=>  $request->input('val06'),
									'paraf2' 			=>  $paraf2,
									'paraf3' 			=>  $paraf3,
									'paraf4' 			=>  $paraf4,
									'fakultas' 			=>  Session('fakultas'),
									'inputor' 			=>  Session('email'),
									'updated_at'		=>	date("Y-m-d H:i:s")
								]);
							} else {
								$kerjanya = Tabelskdanperaturan::where('marking', $marking)->update([
									'kelompok'			=> 	'KEPUTUSAN',
									'marking'			=> 	$marking,
									'nomor' 			=>  $request->input('val02'),
									'tahun' 			=>  $yy,
									'tanggal' 			=>  $request->input('val03'),
									'penandatangan' 	=>  $pejabat,
									'nmpejabat' 		=>  $nmpejabat,
									'nippejabat' 		=>  $nippejabat,
									'judul' 			=>  $rom->kodjenis.' an. '.$rom->nama.' NIM '.$rom->nim,
									'scansurat' 		=>  $marking,
									'kodefas' 			=>  'HK.04.03',
									'kodesub' 			=>  'TD.06.01',
									'paraf1' 			=>  $request->input('val06'),
									'paraf2' 			=>  $paraf2,
									'paraf3' 			=>  $paraf3,
									'paraf4' 			=>  $paraf4,
									'fakultas' 			=>  Session('fakultas'),
									'inputor' 			=>  Session('email'),
									'updated_at'		=>	date("Y-m-d H:i:s")
								]);
							}
							if ($kerjanya){
								Antrian::where('id', $idsurat)->update([
									'nosurat'		=> $nomor,
									'tglsurat'		=> $request->input('val03'),
									'pejabat'		=> $pejabat,
									'nmpejabat'		=> $nmpejabat,
									'nippejabat'	=> $nippejabat,
									'keterangan'	=> $marking.'.pdf'
								]);
								Inboxsurat::where('marking', $marking)->where('catatan', 'SKDANPERATURAN')->delete();
								$qnamapjbt	= Pejabatsurat::where('pejabat', $request->input('val06'))->first();
								if (isset($qnamapjbt->pejabat)){
									SendMail::kiriminbox($marking,Session('nama'),$qnamapjbt->pejabat,$qnamapjbt->email,'KELUAR','PARAF','SKDANPERATURAN','1');
								} else {
									SendMail::kiriminbox($marking,Session('nama'),$pejabat,$emailpenerima,'KELUAR','TTD','SKDANPERATURAN','1');
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tahun '.$yy.' Tanggal Penetapan '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
								return back();
								
							} else{
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
								return back();
							}
						}
					}
				} else {
					if ($pejabat == 'DEKAN' AND $paraf1 == 'SELF'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Dekan Tidak Boleh di Paraf Sendiri']);
						return back();
					} else if ($pejabat == 'WAKIL DEKAN' AND $paraf1 == 'SELF'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Wakil Dekan Tidak Boleh di Paraf Sendiri']);
						return back();
					} else if ($pejabat == 'REKTOR' AND $paraf1 == 'SELF'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Rektor Tidak Boleh di Paraf Sendiri']);
						return back();
					} else if ($pejabat == 'WAKIL REKTOR' AND $paraf1 == 'SELF'){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Wakil Rektor Tidak Boleh di Paraf Sendiri']);
						return back();
					} else {
						$sudah 			= '';
						$qdislws		= Suratkeluar::where('id', $idsurat)->first();
						$marking		= $qdislws->marking;
						$statfile		= $qdislws->paraf1;
						$fakultas		= $qdislws->fakultas;
						
						$kerjanya 		= Suratkeluar::where('id', $idsurat)->update([
							'jenissrt'		=> 	$request->input('val02'),
							'perihal' 		=>  $perihal,
							'dasarsurat' 	=>  $dasarsurat,
							'kodefak' 		=>  $kodefakultas,
							'kepada' 		=>  $kepada,
							'alamat' 		=>  $alamat,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $pejabat,
							'namapejabat' 	=>  $setttd,
							'paraf1' 		=>  $paraf1,
							'paraf2' 		=>  $paraf2,
							'paraf3' 		=>  $paraf3,
							'paraf4' 		=>  $paraf4,
							'pembuat'		=> 	Session('email'),
							'kelompok'		=> 	Session('previlage'),
							'updated_at'	=>	date("Y-m-d H:i:s")
						]);
						if ($perihal == 'SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR' OR $perihal == 'PERPANJANGAN SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR' OR $perihal =='SURAT KETERANGAN JAMINAN PEMBIAYAAN STUDI' OR $perihal == 'SURAT KETERANGAN PERPANJANGAN JAMINAN PEMBIAYAAN STUDI' OR $perihal == 'SURAT JAMINAN PEMBIAYAAN PERPANJANGAN MASA STUDI'){
							if ($request->hasFile('file')) {
								$ceksurat		= explode("-SCO-", $statfile);
								if (isset($ceksurat[1])){
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
									return back();
								} else {
									$ceksurat		= explode("-OUT-", $statfile);
									if (isset($ceksurat[1])){
										return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
										return back();
									} else {
										$output_file 	= '/scan/files/'. $marking.'.pdf';
										if (file_exists(public_path($output_file))){
											Storage::disk('local')->delete($output_file);
										}
										$namafile		= $marking.'.'.$request->file('file')->getClientOriginalExtension();
										$request->file('file')->move(public_path('scan/files'), $namafile);
										if ($kerjanya){
											if (file_exists(public_path($output_file))){
												if ($request->input('val02') != 'BIASA'){
													Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
													$qnamapjbt	= Pejabatsurat::where('pejabat', $paraf1)->first();
													if (isset($qnamapjbt->pejabat)){
														SendMail::kiriminbox($marking,Session('nama'),$qnamapjbt->pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
													} else {
														SendMail::kiriminbox($marking,Session('nama'),$pejabat,$emailpenerima,'KELUAR','TTD','','1');
													}
												}
												return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tanggal '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
												return back();
											} else {
												return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
												return back();		
											}
										}else{
											return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
											return back();
										}
									}
								}			
							} else {
								$ceksurat		= explode("-SCO-", $statfile);
								if (isset($ceksurat[1])){
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
									return back();
								} else {
									$ceksurat		= explode("-OUT-", $statfile);
									if (isset($ceksurat[1])){
										return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
										return back();
									} else {
										Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
										$qnamapjbt	= Pejabatsurat::where('pejabat', $paraf1)->first();
										if (isset($qnamapjbt->pejabat)){
											SendMail::kiriminbox($marking,Session('nama'),$qnamapjbt->pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
										} else {
											SendMail::kiriminbox($marking,Session('nama'),$pejabat,$emailpenerima,'KELUAR','TTD','','1');
										}
										return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tanggal '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
										return back();
									}
								}
							}
						} else {
							$output_file 	= '/scan/generate/qrimg-'.$marking.'.png';
							Storage::disk('local')->delete($output_file);
							if ($request->hasFile('file')) {
								$ceksurat		= explode("-SCO-", $qdislws->paraf1);
								if (isset($ceksurat[1])){
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
									return back();
								} else {
									$ceksurat		= explode("-OUT-", $statfile);
									if (isset($ceksurat[1])){
										return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
										return back();
									} else {
										$output_file 	= '/scan/files/'. $marking.'.pdf';
										if (file_exists(public_path($output_file))){
											Storage::disk('local')->delete($output_file);
										}
										$namafile		= $marking.'.'.$request->file('file')->getClientOriginalExtension();
                                        dd([
                                            'php_user' => get_current_user(),
                                            'posix_uid' => function_exists('posix_geteuid') ? posix_geteuid() : 'N/A',
                                            'posix_gid' => function_exists('posix_getegid') ? posix_getegid() : 'N/A',
                                            'destination' => public_path('scan/files'),
                                            'exists' => file_exists(public_path('scan/files')),
                                            'is_dir' => is_dir(public_path('scan/files')),
                                            'is_writable' => is_writable(public_path('scan/files')),
                                            'permissions' => substr(sprintf('%o', fileperms(public_path('scan/files'))), -4),
                                            'acl_test' => @file_put_contents(
                                                public_path('scan/files/test-from-php.txt'),
                                                'TEST PHP'
                                            ),
                                        ]);
										$request->file('file')->move(public_path('scan/files'), $namafile);
										if ($kerjanya){
											if ($request->input('val02') != 'BIASA'){
												Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
												$qnamapjbt	= Pejabatsurat::where('pejabat', $paraf1)->first();
												if (isset($qnamapjbt->pejabat)){
													SendMail::kiriminbox($marking,Session('nama'),$qnamapjbt->pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
												} else {
													SendMail::kiriminbox($marking,Session('nama'),$pejabat,$emailpenerima,'KELUAR','TTD','','1');
												}
											}
											return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$nomor.' Tanggal '.$tanggal.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
											return back();
										} else {
											return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
											return back();
										}
									}
								}
							} else {
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Berhasil di Update, Tanpa File Upload']);
								return back();
							}
						}
					}
				}
			}
		}
	}
	public function exUploadKopsurat(Request $request) {
		$jenis			= $request->input('val02');
		if ($request->hasFile('file')) {
			$jenisfile		= $request->file('file')->getClientOriginalExtension();
			$jenisfile		= strtolower($jenisfile);
			if ($jenisfile == 'png'){
				$namafile		= Session('fakultas').'.'.$jenisfile;
				if ($jenis == 'stempel'){
					$request->file('file')->move(public_path('images/stempel'), $namafile);
				} else {
					$request->file('file')->move(public_path('images/kopsurat'), $namafile);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => $jenis.' Updated; Halaman akan di refresh dalam 3 detik' ]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $jenis.' yang di upload wajib ber ekstensi png, dengan backgroun transparant']);
				return back();
			}			
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'File Wajib di Isi']);
			return back();
		}
	}
	public function viewPermohonantte() {
		$i 				= 0;
		$data			= [];
		$iduser			= Session('id');
		$mkelompok		= Session('jabatan');
		$fakultas		= Session('fakultas');
		$homebase		= url("/");
		$urutanwerno	= array('red','green','blue','navy','teal','orange','maroon','black');
		$ceknip			= User::where('username', Session('username'))->first();
		if (isset($ceknip->nip)){
			$idpeg					= $ceknip->nip;
			$kapan					= $ceknip->update_at;
			if (is_null($ceknip->nik)){
				$masternik			= '';
			} else {
				$masternik			= $ceknip->nik;
			}
		} else { $idpeg = 0; $masternik = ''; $kapan = ''; }
		$getkepeg					= Simpegpegawai::where('id', $idpeg)->first();
		if (isset($getkepeg->id)){
			$namasaja				= strtoupper($getkepeg->nama);
			$namalengkap			= $getkepeg->nama_lengkap;
			$nik					= $getkepeg->nik;
			$nip_baru				= $getkepeg->nip_baru;
			$golongan				= $getkepeg->golongan;
			$jabatan				= $getkepeg->jabatan;
			$email_ub				= $getkepeg->email_ub;
			$ppabp					= $getkepeg->ppabp;
			$no_hp					= $getkepeg->no_hp;
			$namasaja 				= substr($namasaja, 0, 25) . '';
			$jabatan 				= substr($jabatan, 0, 25) . '';
			$nip_baru 				= preg_replace('/\s+/', '', $nip_baru);
		} else {
			$namasaja				= '';
			$namalengkap			= '';
			$nik					= '';
			$nip_baru				= '';
			$golongan				= '';
			$jabatan				= '';
			$email_ub				= '';
			$ppabp					= '';
			$no_hp					= '';
		}
		$y      		= 0;
		$x      		= 0;
		if ($masternik != ''){
			$data['pengumumans'][$x]['tanggal']     =   'Sertifikat Elektronik Telah Terbit';
			$data['pengumumans'][$x]['kapan']       =   $kapan;
			$data['pengumumans'][$x]['jencolor']    =   'green';
			$data['pengumumans'][$x]['siapa']       =   $namalengkap;
			$data['pengumumans'][$x]['pengumuman']  =   'Sertifikat Elektronik Telah Terbit, Masa Berlaku Terhitung 2 Tahun dari Penerbitan Sertifikat Elektronik Anda';
			$data['pengumumans'][$x]['icon']        =   'fa-graduation-cap';
			$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
			$x++;
			$y++;
		} else {
			if ($nik != ''){
				$ceksek = Suratkeluar::where('isisurat', 'LIKE', '%'.$nik.'%')->count();
				if ($ceksek != 0){
					$ceksek = Suratkeluar::where('isisurat', 'LIKE', '%'.$nik.'%')->orderBy('id', 'DESC')->first();
					$status = $ceksek->status;
					$arsip 	= $ceksek->arsip;
					if ($status == 'NEW'){
						$data['pengumumans'][$x]['tanggal']     =   'Menunggu Verifikasi Ka.TIK';
						$data['pengumumans'][$x]['kapan']       =   $ceksek->created_at;
						$data['pengumumans'][$x]['jencolor']    =   'green';
						$data['pengumumans'][$x]['siapa']       =   $ceksek->namapejabat;
						$data['pengumumans'][$x]['pengumuman']  =   'Menunggu Verifikasi Ka.TIK';
						$data['pengumumans'][$x]['icon']        =   'fa-a-hourglass-o';
						$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
						$x++;
						$y++;
					} else if ($status == 'Signed'){
						$data['pengumumans'][$x]['tanggal']     =   'Menunggu Verifikasi Ka.TIK';
						$data['pengumumans'][$x]['kapan']       =   $ceksek->created_at;
						$data['pengumumans'][$x]['jencolor']    =   'green';
						$data['pengumumans'][$x]['siapa']       =   $ceksek->namapejabat;
						$data['pengumumans'][$x]['pengumuman']  =   'Menunggu Verifikasi Ka.TIK. Berikut Surat Bapak / Ibu <a href="'.$homebase.'/viewsurat/keluar-'.$ceksek->id.'" target="_blank">DOWNLOAD</a>';
						$data['pengumumans'][$x]['icon']        =   'fa fa-a-hourglass-o';
						$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
						$x++;
						$y++;
						if ($arsip == ''){
							$data['pengumumans'][$x]['tanggal']     =   'Form Telah Terverifikasi';
							$data['pengumumans'][$x]['kapan']       =   $ceksek->updated_at;
							$data['pengumumans'][$x]['jencolor']    =   'green';
							$data['pengumumans'][$x]['siapa']       =   $ceksek->namapejabat;
							$data['pengumumans'][$x]['pengumuman']  =   'Verifikasi Ka.TIK telah selesai dan Proses Pengiriman ke Aplikasi Manajemen Sertifikat Elektronik';
							$data['pengumumans'][$x]['icon']        =   'fa fa-hourglass-1';
							$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
							$x++;
							$y++;	
						} else {
							$data['pengumumans'][$x]['tanggal']     =   'Form Telah Terverifikasi';
							$data['pengumumans'][$x]['kapan']       =   $ceksek->updated_at;
							$data['pengumumans'][$x]['jencolor']    =   'green';
							$data['pengumumans'][$x]['siapa']       =   $ceksek->namapejabat;
							$data['pengumumans'][$x]['pengumuman']  =   'Verifikasi Ka.TIK telah selesai dan Proses Pengiriman ke Aplikasi Manajemen Sertifikat Elektronik';
							$data['pengumumans'][$x]['icon']        =   'fa fa-hourglass-1';
							$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
							$x++;
							$y++;	
							$data['pengumumans'][$x]['tanggal']     =   'Verifikasi by Email';
							$data['pengumumans'][$x]['kapan']       =   $ceksek->updated_at;
							$data['pengumumans'][$x]['jencolor']    =   'green';
							$data['pengumumans'][$x]['siapa']       =   $ceksek->namapejabat;
							$data['pengumumans'][$x]['pengumuman']  =   'Pengiriman ke Aplikasi Manajemen Sertifikat Elektronik telah dilakukan, mohon Bapak/Ibu memeriksa Email Bapak/Ibu Masing-Masing';
							$data['pengumumans'][$x]['icon']        =   'fa fa-hourglass-2';
							$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
							$x++;
							$y++;
						}
						
					}
				}
			}
		}
		$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
		$data['golongans'] 			= Golongan::orderBy('id', 'ASC')->get();
		$data['unitkerja'] 			= User::where('fakpanjang', '!=', '')->groupBy('fakultas')->orderBy('fakultas', 'DESC')->get();
		$data['countsendnd']      	= Suratkeluar::where('fakultas', Session('fakultas'))->where('pembuat', 'LIKE', Session('nama'))->where('status', 'NEW')->where('jenissrt', 'Nota Dinas')->count();
		$data['countmailbox']      	= $countmailbox;
		$data['namasaja']      		= $namasaja;
		$data['namalengkap']      	= $namalengkap;
		$data['nik']      			= $nik;
		$data['nip_baru']      		= $nip_baru;
		$data['golongan']      		= $golongan;
		$data['jabatan']      		= $jabatan;
		$data['email_ub']      		= $email_ub;
		$data['ppabp']      		= $ppabp;
		$data['no_hp']      		= $no_hp;
		$data['tahun']      		= date("Y");
		$data['tanggal']      		= date("Y-m-d");
		$data['sidebar']			= 'dashboardpimpinan';
    	return view('surat.permohonantte', $data);
	}
	public function exDaftarTTE(Request $request) {
		$namalengkap	= $request->input('val01');
		$nama			= $request->input('val02');
		$golongan		= $request->input('val03');
		$nipbaru		= $request->input('val04');
		$email			= $request->input('val05');
		$nik			= $request->input('val06');
		$hape			= $request->input('val07');
		$jabatan		= $request->input('val08');
		$unitkerja		= $request->input('val09');
		$idne			= $request->input('val10');
		$nipbaru 		= preg_replace('/\s+/', '', $nipbaru);
		$sertifikat 	= $nipbaru.'.crt';
		if (file_exists(public_path('tte/'.$sertifikat))){
			$sertifikat = 'sudah';
		} else {
			$dn = array(
				"countryName" 			=> "IN",
				"stateOrProvinceName" 	=> "East Java Indonesia",
				"localityName" 			=> "Malang",
				"organizationName" 		=> "Universitas Brawijaya",
				"organizationalUnitName"=> "Smart and Collaborative Office",
				"commonName" 			=> $nama,
				"emailAddress" 			=> "sco@ub.ac.id"
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
			file_put_contents(base_path()."/public/tte/".$nipbaru.".crt", $pkeyout);
			file_put_contents(base_path()."/public/tte/".$nipbaru.".crt", $certout, FILE_APPEND | LOCK_EX);
			$sertifikat = 'sudah';
		}
		$getidpeg 		= Simpegpegawai::where('nip_baru', $nipbaru)->first();
		if (isset($getidpeg->id)){
			$idpeg 		= $getidpeg->id;
			User::where('username', Session('username'))->update([
				'nip'		=> $idpeg,
				'golongan'	=> $golongan,
				'email'		=> $email
			]);
			Simpegpegawai::where('nip_baru', $nipbaru)->update([
				'nik'						=> $nik, 
				'nama_lengkap'				=> $namalengkap, 
				'nama'						=> $nama, 
				'golongan'					=> $golongan, 
				'no_hp'						=> $hape, 
				'ppabp'						=> $unitkerja, 
				'jabatan'					=> $jabatan, 
				'email_ub'					=> $email,
			]);
		} else {
			$idpeg 	= Simpegpegawai::insertGetId([
				'idpeg'						=> 0,
				'jenispeg'					=> 'PNPN_BOPTN', 
				'fungsional'				=> 'Kependidikan', 
				'nik'						=> $nik, 
				'nokk'						=> '', 
				'nama_lengkap'				=> $namalengkap, 
				'nama'						=> $nama, 
				'nip_lama'					=> '', 
				'nip_baru'					=> $nipbaru, 
				'nidn'						=> '', 
				'jenis_kelamin'				=> '', 
				'tmpt_lahir'				=> 'Malang', 
				'tgl_lahir'					=> date("Y-m-d"), 
				'usia'						=> '', 
				'pangkat'					=> '', 
				'golongan'					=> $golongan, 
				'namabank'					=> '', 
				'norek'						=> '', 
				'namapdrekening'			=> '', 
				'gajisesuaisk'				=> '', 
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
				'keterangan'				=> 'Daftar via TTE', 
				'tmt_golongan'				=> '', 
				'jab_fungsional'			=> '', 
				'tmt_fungsional'			=> '', 
				'tmt_pensiun'				=> '', 
				'thn_pensiun'				=> '', 
				'tmt_cpns'					=> '', 
				'tmt_pns'					=> '', 
				'thn_masuk'					=> '', 
				'unit_kerja'				=> '', 
				'bidang_ilmu'				=> '', 
				'lab'						=> '', 
				'program_studi'				=> '', 
				'sertifikasi'				=> '', 
				'pend_akhir'				=> '', 
				'ijasah_diakui'				=> '', 
				'status_pegawai'			=> 1, 
				'masa_kerja'				=> '', 
				'pns'						=> '', 
				'status_jabatan'			=> 'Dosen', 
				'karpeg'					=> '', 
				'agama'						=> '', 
				'alamat'					=> '', 
				'no_hp'						=> $hape, 
				'kode'						=> '', 
				'foto'						=> '', 
				'tmtgaji'					=> '', 
				'tmtpangkat'				=> '', 
				'ppabp'						=> $unitkerja, 
				'jabatan'					=> $jabatan, 
				'proses_pangkat'			=> '', 
				'angka_kredit'				=> '', 
				'email_ub'					=> $email, 
				'lama_tubel'				=> '', 
				'lama_kenaikan_pangkat'		=> '', 
				'tmt_tubel'					=> ''
			]);
			User::where('username', Session('username'))->update([
				'nip'		=> $idpeg,
				'golongan'	=> $golongan,
				'email'		=> $email
			]);
		}
		$ceksurat =  Suratkeluar::where('isisurat', 'LIKE', '%'.$nik.'%')->count();
		if ($ceksurat == 0){
			$getgolongan = Golongan::where('kode', $golongan)->first();
			if (isset($getgolongan->golongan)){ $golongan = $getgolongan->golongan; } else { $golongan = ''; }
			if (isset($getgolongan->pangkat)){ $pangkat = $getgolongan->pangkat; } else { $pangkat = ''; }
			$golongan		= $pangkat.', '.$golongan;
			$getfakpanjang	= User::where('fakultas', $unitkerja)->first();
			if (isset($getfakpanjang->fakpanjang)){
				$unitkerja	= $getfakpanjang->fakpanjang;
				if ($unitkerja == '' OR $unitkerja == 'Kantor Pusat'){
					$unitkerja 	= Session('fakpanjang');		
				}
			} else {
				$unitkerja 	= Session('fakpanjang');
			}
			$generatesurat = '<table border="0" cellpadding="1" cellspacing="1" style="width:720px">
								<tbody>
									<tr>
										<td width="20">&nbsp;</td>
										<td width="150">&nbsp;</td>
										<td width="10">&nbsp;</td>
										<td width="440">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">Saya yang bertanda tangan di bawah ini sebagai penanggungjawab bidang TI di instansi :</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
									<tr>
										<td>1.</td>
										<td>Nama Lengkap</td>
										<td>:</td>
										<td>Raden Arief Setyawan, ST., MT.</td>
									</tr>
									<tr>
										<td>2.</td>
										<td>NIP</td>
										<td>:</td>
										<td>197508191999031001</td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Pangkat / Golongan</td>
										<td>:</td>
										<td>Penata Tk. I, III/d</td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Jabatan</td>
										<td>:</td>
										<td>Kepala UPT Teknologi dan Informasi</td>
									</tr>
									<tr>
										<td>5.</td>
										<td>Jabatan</td>
										<td>:</td>
										<td>UPT Teknologi dan Informasi</td>
									</tr>
									<tr>
										<td>6.</td>
										<td>Instansi</td>
										<td>:</td>
										<td>Universitas Brawijaya</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">Dengan ini memberikan rekomendasi kepada :</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
									<tr>
										<td>1.</td>
										<td>Nama</td>
										<td>:</td>
										<td>'.$namalengkap.'</td>
									</tr>
									<tr>
										<td>2.</td>
										<td>NIP</td>
										<td>:</td>
										<td>'.$nipbaru.'</td>
									</tr>
									<tr>
										<td>3.</td>
										<td>NIK</td>
										<td>:</td>
										<td>'.$nik.'</td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Pangkat / Golongan</td>
										<td>:</td>
										<td>'.$golongan.'</td>
									</tr>
									<tr>
										<td>5.</td>
										<td>Jabatan</td>
										<td>:</td>
										<td>'.$jabatan.'</td>
									</tr>
									<tr>
										<td>6.</td>
										<td>Unit Kerja</td>
										<td>:</td>
										<td>'.$unitkerja.'</td>
									</tr>
									<tr>
										<td>7.</td>
										<td>Instansi</td>
										<td>:</td>
										<td>Universitas Brawijaya</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td>Kota Malang</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td>Provinsi Jawa Timur</td>
									</tr>
									<tr>
										<td>8.</td>
										<td>Alamat Email</td>
										<td>:</td>
										<td>'.$email.'</td>
									</tr>
									<tr>
										<td>9.</td>
										<td>No. Telpon</td>
										<td>:</td>
										<td>'.$hape.'</td>
									</tr>
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">Untuk melakukan pendaftaran sebagai Pengguna Sertifikat Elektronik di Instansi. Dengan ini, Pengguna dinyatakan telah setuju untuk menjalankan tugas dan fungsinya sesuai dengan Perjanjian Pengguna Sertifikat Elektronik yang ditetapkan oleh BSrE.<br />
										Demikian surat rekomendasi ini saya buat, agar dapat digunakan sebagaimana mestinya</td>
									</tr>
								</tbody>
							</table>';
			$dd 	  		= date("d");
			$mm 	  		= date("m");
			$yy 	  		= date("Y");
			$kodepjbt		= 'UN10.D50';
			$thncari		= $yy.'-%';
			$tlstgl			= $yy.'-'.$mm.'-'.$dd;
			$fakultas		= 'TIK';
			$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
			$idnomor		= $getid->id;
			$idnomor		= $idnomor + 1;
			$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
			if ($ceknomorsrt == 0){
				$nomor 		= 1;
			} else {
				$ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
				$lastno		= $ceknomorsrt->nomor;
				$nomor 		= $lastno+1;
			}
			$idpejabat		= '35';
			$getpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
			if (isset($getpejabat->id)){
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
                $kodepjbt		= $getpejabat->kode;
            } else {
				$kodepjbt		= 'UN10.D50';
                $penandatangan	= 'Kepala UPT Teknologi Informasi dan Komunikasi';
				$setttd			= 'Raden Arief Setyawan , ST., MT.';
			}
			
			$marking 		= $fakultas.'-OUT-'.$yy.$idnomor;
			$input 			= Suratkeluar::create([
				'id' 			=>  $idnomor,
				'marking' 		=>  $marking,
				'jenissrt' 		=>  'SURAT REKOMENDASI',
				'nomor' 		=>  $nomor,
				'anakno' 		=>  '',
				'kodefak' 		=>  $kodepjbt,
				'unit' 			=>  'TI',
				'tglsurat' 		=>  $tlstgl,
				'daysrt' 		=>  $dd,
				'monsrt' 		=>  $mm,
				'yersrt' 		=>  $yy,
				'dasarsurat' 	=>  'TIK-DSR-202135291.png',
				'kepada' 		=>  '',
				'alamat' 		=>  '',
				'perihal' 		=>  'Surat Rekomendasi Penerbitan Tanda Tangan Elektronik',
				'lampiran' 		=>  '',
				'isisurat' 		=>  $generatesurat,
				'idpejabat' 	=>  $idpejabat,
				'pejabat' 		=>  $penandatangan,
				'namapejabat' 	=>  $setttd,
				'tembusan' 		=>  '',
				'sifat' 		=>  '',
				'klasifikasi' 	=>  '',
				'pembuat' 		=>  'Admin TIK',
				'kelompok' 		=>  'admin',
				'status' 		=>  'NEW',
				'arsip' 		=>  '',
				'footnote' 		=>  'TTE an. '.$nik,
				'tandatangan' 	=>  '',
				'paraf1' 		=>  'SELF',
				'paraf2' 		=>  '0',
				'paraf3' 		=>  '0',
				'paraf4' 		=>  '0',
				'ruangarsip' 	=>  '',
				'ordnerarsip' 	=>  '',
				'lemariarsip' 	=>  '',
				'faskode' 		=>  'BU.03',
				'fasmasa' 		=>  '2',
				'fasket' 		=>  'Permanen',
				'subkode' 		=>  '',
				'submasa' 		=>  '',
				'subket' 		=>  '',
				'font' 			=>  'ARL',
				'ukuran' 		=>  '14',
				'lebarttd' 		=>  '50',
				'filelampiran' 	=>  '',
				'fakultas' 		=>  $fakultas,
			]);
			if ($input){
				$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $penandatangan)->first();
				if (isset($getemail->id)){
					$email 	= $getemail->email;
				} else { $email = $penandatangan; }
				SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'KELUAR','TTD','TTE','1');
				Pejabatsurat::where('nip', $nipbaru)->update([
					'pemaraf' => 'Rekom TTE Done'
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat dengan NIK => '.$nik.' Sukses di Antrikan ke '.$penandatangan.' Untuk di Tanda Tangani']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat dengan NIK => '.$nik.' Gagal di Tambahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat dengan NIK => '.$nik.' Sudah Ada']);
			return back();
		}
	}
	public function exSetSertifikat(Request $request) {
		$kolom			= $request->input('val01');
		$baris			= $request->input('val02');
		$lebar			= $request->input('val03');
		$posnama		= $request->input('val04');
		$mergenama		= $request->input('val05');
		$posstatus		= $request->input('val06');
		$mergestatus	= $request->input('val07');
		$posqrcode		= $request->input('val08');
		$mergeqrcode	= $request->input('val09');
		$bgdepan		= $request->input('val10');
		$bgbelakang		= $request->input('val11');
		$perihal		= $request->input('val12');
		$nmttd			= $request->input('val13');
		$paraf1			= $request->input('val14');
		$paraf2			= $request->input('val15');
		$paraf3			= $request->input('val16');
		$paraf4			= $request->input('val17');
		$kerjane		= $request->input('val19');
		$idsurat		= $request->input('val20');
		$jnupload		= $request->input('val21');
		$layout			= $request->input('val22');
		if ($jnupload == 'peserta'){
			if ($request->hasFile('val18')) {
				$path 			= $_FILES['val18']['tmp_name'];
				$sukses 		= 0;
				$error  		= '';
				$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$spreadsheet 	= $reader->load($path);
				$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				$hilangkan 		= array(",", ".", " ");
				foreach($getalldata as $val){
					if(is_null($val['A']) OR $val['A'] == 'NAMA LENGKAP'){
						//
					} else {
						if (isset($val['A'])){
							$nama = $val['A'];
							if (isset($val['B'])){
								$pekerjaan = $val['B'];
							} else { $pekerjaan = 'PESERTA'; }
							if (isset($val['C'])){
								$hape = $val['C'];
							} else { $hape = ''; }
							if (isset($val['D'])){
								$email = $val['D'];
							} else { $email = ''; }
							$ceksek = WebinarPartisipan::where('idevent', $idsurat)->where('nama', $nama)->where('pekerjaan', $pekerjaan)->count();
							if ($ceksek == 0){
								$input = WebinarPartisipan::insertGetId([
									'idevent'		=> $idsurat, 
									'nama'			=> $nama, 
									'pekerjaan'		=> $pekerjaan, 
									'alamat'		=> config('global.swandhanaalamat'), 
									'negara'		=> 'Indonesia', 
									'instansi'		=> config('global.swandhanauniv'), 
									'email'			=> $email,
									'hape'			=> $hape,
									'daftar'		=> date('Y:m:d H:i'), 
									'quiz'			=> '0000-00-00 00:00:00', 
									'presensi'		=> '0000-00-00 00:00:00', 
									'status'		=> 'new', 
									'bayar'			=> '0', 
									'foto'			=> ''
								]);
								if ($input){
									$sukses++;
								} else {
									$error = $error.' Gagal Input Untuk '.$nama;
								}
							}
						}
					}
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses Import Sejumlah '.$sukses.' '.$error]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else {
			if ($kerjane == 'send'){
				if ($paraf2 == ''){ $paraf2 = '0'; }
				if ($paraf3 == ''){ $paraf3 = '0'; }
				if ($paraf4 == ''){ $paraf4 = '0'; }
				$paraf5 		= 0;
				$rnamapjbt		= Pejabatsurat::where('id', $nmttd)->first();
				$pejabat 		= $rnamapjbt->pejabat;
				$nmpejabat 		= $rnamapjbt->nama;
				$nippejabat 	= $rnamapjbt->nip;
				$kodefakultas 	= $rnamapjbt->kode;
				$idpejabat 		= $rnamapjbt->id;
				$jenisnip 		= $rnamapjbt->jenis;
				$nippejabat 	= preg_replace('/\s+/', '', $nippejabat);
				if ($jenisnip == '' OR $jenisnip == '-' OR is_null($jenisnip)){
					$jenisnip 	= 'NIP';
				}
				$getnamasaja			= Simpegpegawai::where('nip_baru', $nippejabat)->first();
				if (isset($getnamasaja->nama)){
					$namasaja			= $getnamasaja->nama;
					$emailpejabat		= $getnamasaja->email_ub;
				} else {
					$emailpejabat		= $nippejabat.'@ub.ac.id';
					$namasaja			= $nmpejabat;
				}
				$setttd			= $nmpejabat.'<br />'.$jenisnip.''.$nippejabat;
				$getkelompok	= explode(" ", $pejabat);
				$kelompok		= $getkelompok[0];
				if (isset($kelompok[1])){
					$kelompok2	= $kelompok.' '.$kelompok[1];
				} else {
					$kelompok2	= '-';
				}
				$kelompok		= strtoupper($kelompok);
				$kelompok2		= strtoupper($kelompok2);
				$ring1			= '';
				if ($kelompok == 'REKTOR'){ $ring1 = 'yes'; }
				if ($kelompok2 == 'WAKIL REKTOR'){ $ring1 = 'yes'; }
					
				if ($paraf1 == ''){ $paraf1 = 'SELF'; }
				if ($kelompok == 'DEKAN' AND $paraf1 == 'SELF'){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Dekan Tidak Boleh di Paraf Sendiri']);
					return back();
				} else if ($kelompok2 == 'WAKIL DEKAN' AND $paraf1 == 'SELF'){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Wakil Dekan Tidak Boleh di Paraf Sendiri']);
					return back();
				} else if ($kelompok == 'REKTOR' AND $paraf1 == 'SELF'){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Rektor Tidak Boleh di Paraf Sendiri']);
					return back();
				} else if ($kelompok2 == 'WAKIL REKTOR' AND $paraf1 == 'SELF'){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Yang ditandatangani Wakil Rektor Tidak Boleh di Paraf Sendiri']);
					return back();
				} else {
					$certificate 		= 'file://'.base_path().'/public/sco.crt';
					$sco 				= 'Smart and Collaborative Office UB';
					$swandhanafak       = config('global.swandhanafak');
					$swandhanaalamat    = config('global.swandhanaalamat');
					$swandhanakemen     = config('global.swandhanakemen');
					$swandhanauniv      = config('global.swandhanauniv');
					$swandhanatelpon    = config('global.swandhanatelpon');
					$swandhanaemail		= config('global.swandhanaemail');
					$kalender 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
					$fontstyle			= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"';
					$jenisfontte		= '<font size="7" color="blue">';
					$sudah 				= '';
					$homebase			= url("/");
					$partisipan 		= '';
					$pekerjaan			= '';
				
					$getsurat			= Suratkeluar::where('id', $idsurat)->first();
					$marking			= $getsurat->marking;
					$statfile			= $getsurat->paraf1;
					$fakultas			= $getsurat->fakultas;
					$ceksurat			= explode("-SCO-", $statfile);
					if (isset($ceksurat[1])){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
						return back();
					} else {
						$ceksurat		= explode("-OUT-", $statfile);
						if (isset($ceksurat[1])){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat Telah ditandatangani dan tidak bisa diubah kembali']);
							return back();
						} else {
							$variabel 	= 'kolom:'.$kolom.';baris:'.$baris.';lebar:'.$lebar.';halaman:1;filedepan:'.$bgdepan.';filebelakang:'.$bgbelakang.';posnama:'.$posnama.';posstatus:'.$posstatus.';mergeqrcode:'.$mergeqrcode.';posqrcode:'.$posqrcode.';mergenama:'.$mergenama.';mergestatus:'.$mergestatus.';layout:'.$layout;
							$kerjanya 	= Suratkeluar::where('id', $idsurat)->update([
								'perihal' 		=>  $perihal,
								'isisurat' 		=>  $variabel,
								'idpejabat' 	=>  $nmttd,
								'pejabat' 		=>  $pejabat,
								'namapejabat' 	=>  $setttd,
								'paraf1' 		=>  $paraf1,
								'paraf2' 		=>  $paraf2,
								'paraf3' 		=>  $paraf3,
								'paraf4' 		=>  $paraf4,
								'updated_at'	=>	date("Y-m-d H:i:s")
							]);
							if ($kerjanya){
								$perihal		= $getsurat->perihal;
								$jenissrt		= $getsurat->jenissrt;
								$isisurat		= $getsurat->isisurat;
								$setttd			= $getsurat->namapejabat;
								$tandatangan	= $getsurat->tandatangan;
								$tgl			= $getsurat->daysrt;
								$tlsbln			= (int)$getsurat->monsrt;
								$thn			= $getsurat->yersrt;
								$tlsbln			= $kalender[$tlsbln];
								$tglsurat		= $tgl.' '.$tlsbln.' '.$thn;
								if ($marking == ''){
									$marking	= $getsurat->marking;
								}
								$alamatweb		= $homebase.'/viewdocbyname/'.$marking.'.pdf';
								$qrcode 		= QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($alamatweb);
								$output_file 	= 'scan/generate/qrimg-'. $marking.'.png';
								Storage::disk('local')->put($output_file, $qrcode);
								$jamtte			= date("H:m:i");
								$tulisttd		= '
										<table width="300" border="0" cellpadding="0" cellspacing="0"> 
												<tr>
													<td width="100"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="70" /></td>
													<td align="left" valign="center">
														'.$jenisfontte.'<br />
															TTE oleh :
															<strong>'.$namasaja.'</strong><br />
															'.$tglsurat.' '.$jamtte.'<br /><br />
															Verifikasi melalui<br /> https://tte.kominfo.go.id/verifyPDF
														</font>
													</td>
												</tr>
											</table>';
								if ($bgdepan != '-'){
									$img_file = $homebase.'/images/sertifikat/'.$bgdepan;
								} else {
									$img_file = $homebase.'/bgbssn.png';
								}
								if ($layout == 'L'){
									$generatesurat 	= '<table width="1118" border="0" cellpadding="0" cellspacing="0">';
								} else {
									$generatesurat 	= '<table width="720" border="0" cellpadding="0" cellspacing="0">';
								}
								while ($baris != 0){
									$generatesurat	= $generatesurat.'<tr>';
									$i 				= $kolom;
									if ($posnama == $baris){
										$slip1		= $kolom - $mergenama;
										if ($slip1 <= 0){
											$generatesurat	= $generatesurat.'<td colspan="'.$kolom.'" align="center"><font size="18">'.$partisipan.'</font></td>';
										} else {
											$generatesurat	= $generatesurat.'<td colspan="'.$slip1.'">&nbsp;</td><td colspan="'.$mergenama.'" align="center"><font size="18">'.$partisipan.'</font></td>';
										}
									} elseif ($posqrcode == $baris){
										$slip2		= round(($kolom - $mergeqrcode),0);
										while ($slip2 != 0){
											$generatesurat	= $generatesurat.'<td>&nbsp;</td>';
											$slip2--;
										}
										$generatesurat	= $generatesurat.'<td align="center">'.$tulisttd.'</td>';
									} elseif ($posstatus == $baris){
										$slip3		= $kolom - $mergestatus;
										if ($slip3 <= 0){
											$generatesurat	= $generatesurat.'<td colspan="'.$kolom.'" align="center"><font size="16">'.$pekerjaan.'</font></td>';
										} else {
											$generatesurat	= $generatesurat.'<td colspan="'.$slip3.'">&nbsp;</td><td colspan="'.$mergestatus.'" align="center"><font size="16">'.$pekerjaan.'</font></td>';
										}
									} else {
										while ($i != 0){
											if ($lebar == '0'){
												$generatesurat	= $generatesurat.'<td>&nbsp;</td>';
											} else {
												$generatesurat	= $generatesurat.'<td width="'.$lebar.'">&nbsp;</td>';
											}
											$i--;
										}
									}
									$generatesurat	= $generatesurat.'</tr>';
									$baris--;
								}
								$generatesurat	= $generatesurat.'</table>';
								if ($bgbelakang != ''){
									$generatesurat	= $generatesurat.'<img src="'.$homebase.'/images/sertifikat/'.$bgbelakang.' />';
								}
								$data['perihal']   		= $perihal;
								$data['surate']   		= $generatesurat;
								$data['catatankaki']   	= '';
								$info = array(
									'Name' 			=> 'Smart and Collaborative Office',
									'Location' 		=> config('global.swandhanauniv'),
									'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
									'ContactInfo' 	=> $homebase,
								);
								$text 			= view('cetak.suratkeluar', $data);
								$page_format	= array(
									'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 330),
									'Dur' => 3,
									'PZ' => 1,
								);
								PDFCREATOR::SetCreator($sco);
								PDFCREATOR::SetAuthor($getsurat->pembuat);
								PDFCREATOR::SetTitle($getsurat->perihal);
								PDFCREATOR::SetSubject('Sertifikat dengan TTE');
								PDFCREATOR::SetKeywords($getsurat->jenissrt);
								PDFCREATOR::setPrintHeader(false);
								PDFCREATOR::setPrintFooter(false);
								PDFCREATOR::SetMargins(5, 0, 5);
								PDFCREATOR::setFontSubsetting(true);
								PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
								if ($layout == 'P'){
									PDFCREATOR::AddPage('P', $page_format, false, false);
									$bMargin = PDFCREATOR::getBreakMargin();
									$auto_page_break = PDFCREATOR::getAutoPageBreak();
									PDFCREATOR::SetAutoPageBreak(false, 0);
									PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
									PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
									PDFCREATOR::setPageMark();
								} else {
									PDFCREATOR::AddPage('L', $page_format, false, false);
									$bMargin = PDFCREATOR::getBreakMargin();
									$auto_page_break = PDFCREATOR::getAutoPageBreak();
									PDFCREATOR::SetAutoPageBreak(false, 0);
									PDFCREATOR::Image($img_file, 0, 0, 330, 210, '', '', '', false, 300, '', false, false, 0);
									PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
									PDFCREATOR::setPageMark();
								}
								PDFCREATOR::writeHTML($text, true, 0, true, 0);
								PDFCREATOR::setFooterMargin(0);
								$pdfdoc = PDFCREATOR::Output('', 'S');
								PDFCREATOR::reset();
								Storage::disk('local')->delete('/scan/files/'.$marking.'.pdf');
								Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
								Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
								$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
								if (isset($qnamapjbt->pejabat)){
									$pejabat= $qnamapjbt->pejabat;
									SendMail::kiriminbox($marking,Session('nama'),$pejabat,$qnamapjbt->email,'KELUAR','PARAF','','1');
								} else {
									$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $pejabat)->first();
									if (isset($getemail->id)){
										$email 	= $getemail->email;
									} else { $email = $pejabat; }
									SendMail::kiriminbox($marking,Session('nama'),$pejabat,$email,'KELUAR','TTD','','1');
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Nomor '.$getsurat->nomor.' Tanggal '.$getsurat->tglsurat.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
								return back();
							} else{
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
								return back();
							}
						}
					}
				}
			} else {
				if ($request->hasFile('val18')) {
					$validator = Validator::make($request->all(), [
						'val18' =>  'mimes:png,PNG,jpg,jpeg,JPG,JPEG|max:20000'
					]);
					if ($validator->fails()) {
						$oklanjut 		= 'NO';
					} else {
						$oklanjut 			= 'OK';
						if ($jnupload == 'bgdepan'){
							$namafilelampiran 	= Session('fakultas').'-D-'.$idsurat;
							$namafilelampiran	= $namafilelampiran.'.'.$request->file('val18')->getClientOriginalExtension();
							$bgdepan			= $namafilelampiran;
						} else {
							$namafilelampiran 	= Session('fakultas').'-B-'.$idsurat;
							$namafilelampiran	= $namafilelampiran.'.'.$request->file('val18')->getClientOriginalExtension();
							$bgbelakang			= $namafilelampiran;
						}
						if (File::exists(base_path() ."/public/images/sertifikat/". $namafilelampiran)) {
							File::delete(base_path() ."/public/images/sertifikat/". $namafilelampiran);
						}
						$request->file('val18')->move(public_path('images/sertifikat'), $namafilelampiran);	
						
					}
				} else { $oklanjut 		= 'OK'; }
				if ($oklanjut == 'NO'){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Bg. Image harus PNG dan dibawah 20Mb']);
					return back();
				} else {
					$variabel 	= 'kolom:'.$kolom.';baris:'.$baris.';lebar:'.$lebar.';halaman:1;filedepan:'.$bgdepan.';filebelakang:'.$bgbelakang.';posnama:'.$posnama.';posstatus:'.$posstatus.';mergeqrcode:'.$mergeqrcode.';posqrcode:'.$posqrcode.';mergenama:'.$mergenama.';mergestatus:'.$mergestatus.';layout:'.$layout;
					$update 	= Suratkeluar::where('id', $idsurat)->update([
						'isisurat' 		=>  $variabel,
						'perihal' 		=>  $perihal,
						'updated_at'	=>	date("Y-m-d H:i:s")
					]);
					if ($update){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses Update Sertifikat']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Gagal Upload File, Ulangi Beberapa Saat Lagi']);
						return back();
					}
				}
			}
		}
	}
	public function exCekstatusTTE(Request $request) {
		$marking 	= $request->input('val01');
		$file 		= public_path('scan/files/'.$marking.'.pdf');
		if (file_exists($file)){
			$client 	= new Client();
			$authHeader = [
				'auth'    		=> ['esign', 'qwerty'],
				'multipart'    	=> [
					[
						'name'		=> 'signed_file',
						'contents'	=> fopen($file, 'r')
					],
				],
			];
			try {
				$response 	= $client->post('https://esign.ub.ac.id/api/sign/verify', $authHeader);
				$status		= (string)$response->getStatusCode();
				$body		= (string)$response->getBody();
				$body 		= json_decode($body);
				$summary	= $body->summary;
				$notes		= $body->notes;
				$details	= $body->details;
				if ($details == null){
					$summary	= 'Gagal';
					$notes		= 'File Tidak Valid / Belum Di Tandatangani';
					$icon		= 'error';
					$ceksurat	= Suratkeluar::where('marking', $marking)->first();
					if (isset($ceksurat->id)){
						AntrianTTE::where('idsurat', $ceksurat->id)->where('jenis', 'KELUAR')->update([
							'keterangan' => null
						]);
					} else {
						$ceksurat	= Draftsk::where('marking', $marking)->first();
						if (isset($ceksurat->id)){
							AntrianTTE::where('idsurat', $ceksurat->id)->whereNotIn('jenis', ['KELUAR', 'DOUBLE', 'SKDANPERATURAN'])->update([
								'keterangan' => null
							]);
						} else {
							$ceksurat	= Tabelskdanperaturan::where('marking', $marking)->first();
							if (isset($ceksurat->id)){
								$update = AntrianTTE::where('idsurat', $ceksurat->id)->where('jenis', 'DOUBLE')->update([
									'keterangan' => null
								]);
								if ($update){
									//nothing
								} else {
									$update = AntrianTTE::where('idsurat', $ceksurat->id)->where('jenis', 'SKDANPERATURAN')->update([
										'keterangan' => null
									]);
								}
							}	
						}
					}
				} else {
					$icon 		= 'success';
					$details 	= json_decode(json_encode($details));
					if (isset($details[0])){
						$signername	= $details[0]->signature_document;
						$signedin	= $details[0]->info_signer;
						$signer_name= json_decode(json_encode($signername));
						$signed_in1	= $signer_name->signed_in;
						$signed_in 	= json_decode(json_encode($signedin));
						$signer_name= $signed_in->signer_name;
						$notes		= $notes.' Oleh '.$signer_name.' Timestamp '.$signed_in1;
						if (isset($details[1])){
							$signername	= $details[1]->signature_document;
							$signedin	= $details[1]->info_signer;
							$signer_name= json_decode(json_encode($signername));
							$signed_in1	= $signer_name->signed_in;
							$signed_in 	= json_decode(json_encode($signedin));
							$signer_name= $signed_in->signer_name;
							$notes		= $notes.' TTE Kedua Oleh '.$signer_name.' Timestamp '.$signed_in1;
						}
					}
				}
			} catch (\GuzzleHttp\Exception\ClientException $e) {
				$response 	= $e->getResponse();
				$icon 		= 'error';
				$summary	= 'File Tidak di Temukan';
				$notes		= 'System Error, Sampaikan kepada Tim IT';
			}
		} else {
			$icon 		= 'info';
			$summary	= 'Pesan';
			$notes		= 'Fitur Ini Hanya Untuk Melakukan Pengecekan Terhadap Surat Yang sudah di Tandatangani dan Berstatus "On Internal Server"';
		}
		return response()->json(['summary' => $summary, 'notes' => $notes, 'icon' => $icon]);
		return back();
    }
	public function exsafeCuti(Request $request) {
		$homebase		= url("/");
		$idpeg			= $request->input('val01');
		$nip			= $request->input('val02');
		$jabatan		= $request->input('val03');
		$unitkerja		= $request->input('val04');
		$tandatangan	= $request->input('val05');
		$alamat			= $request->input('val06');
		$jenis			= $request->input('val07');
		$hari			= $request->input('val08');
		$mulai			= $request->input('val09');
		$akhir			= $request->input('val10');
		$alasan			= $request->input('val11');
		$nohape			= $request->input('val12');
		$idatasan		= $request->input('val13');
		$idpejabat		= $request->input('val14');
		$idne			= $request->input('val15');
		$fakultas		= Session('fakultas');
		if ($idne == 'Setting'){
			$idne		= $request->input('val01');
			$tahun		= $request->input('val02');
			$jumlah		= $request->input('val03');
			if ($idne == 'new'){
				$ceksek = Settingcuti::where('fakultas', $fakultas)->where('tahun', $tahun)->count();
				if ($ceksek == 0){
					$input = Settingcuti::create([
						'fakultas'	=> $fakultas,
						'tahun'		=> $tahun,
						'jumlah'	=> $jumlah,
						'inputor'	=> Session('nama'),
						'keterangan'=> ''
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tahun '.$tahun.' Sukses di Tambahkan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Tahun '.$tahun.' gagal di tambahkan']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Tahun '.$tahun.' sudah ada, silahkan gunakan fasilitas edit']);
					return back();
				}
			} else {
				$ceksek = Settingcuti::where('id', '!=', $idne)->where('fakultas', $fakultas)->where('tahun', $tahun)->count();
				if ($ceksek == 0){
					$getdatalm		= Settingcuti::where('id', $idne)->first();
					$inputor		= $getdatalm->inputor;
					$keterangan		= $getdatalm->keterangan;
					if ($inputor != Session('nama')){
						$keterangan	= $keterangan.' di Update Oleh '.Session('nama').' pada '.date("Y-m-d H:i:s");
					}
					$input = Settingcuti::where('id', $idne)->update([
						'fakultas'	=> $fakultas,
						'tahun'		=> $tahun,
						'jumlah'	=> $jumlah,
						'inputor'	=> Session('nama'),
						'keterangan'=> $keterangan
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tahun '.$tahun.' Sukses di update']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Tahun '.$tahun.' gagal di update']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Tahun '.$tahun.' sudah ada, silahkan gunakan fasilitas edit']);
					return back();
				}
			}
		} else if ($idne == 'simpansaja'){
			$idpejabat		= $request->input('val01');
			$idparaf1		= $request->input('val02');
			$idparaf2		= $request->input('val03');
			$idparaf3		= $request->input('val04');
			$idparaf4		= $request->input('val05');
			$alamat			= $request->input('val06');
			$jenis			= $request->input('val07');
			$hari			= $request->input('val08');
			$mulai			= $request->input('val09');
			$akhir			= $request->input('val10');
			$alasan			= $request->input('val11');
			$idne			= $request->input('val12');
			$input 			= Suratkeluartnpnomor::where('id', $idne)->update([
				'tglbuat' 		=>  $mulai,
				'dasarsurat' 	=>  $akhir,
				'alamat' 		=>  $alamat,
				'perihal' 		=>  $jenis,
				'kelompok' 		=>  $hari,
				'footnote' 		=>  $alasan,
				'updated_at'	=> 	date("Y-m-d H:i:s")
			]);
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat '.$jenis.' Sukses di update']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenissrt.' tertanggal mulai cuti '.$mulai.' gagal di update']);
				return back();
			}
		} else if ($idne == 'createsurat'){
			$idpejabat		= $request->input('val01');
			$idparaf1		= $request->input('val02');
			$idparaf2		= $request->input('val03');
			$idparaf3		= $request->input('val04');
			$idparaf4		= $request->input('val05');
			$alamat			= $request->input('val06');
			$jenis			= $request->input('val07');
			$hari			= $request->input('val08');
			$mulai			= $request->input('val09');
			$akhir			= $request->input('val10');
			$alasan			= $request->input('val11');
			$idne			= $request->input('val12');
			$getdata 		= Suratkeluartnpnomor::where('id', $idne)->first();
			if (isset($getdata->marking)){
				$dd 	  		= date("d");
				$mm 	  		= date("m");
				$yy 	  		= date("Y");
				$thncari		= $yy.'-%';
				$tanggal		= $yy.'-'.$mm.'-'.$dd;
				$fakultas		= Session('fakultas');
				$getpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
				$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
				$idnomor		= $getid->id;
				$idnomor		= $idnomor + 1;
				$markingsrt		= $fakultas.'-OUT-'.$yy.$idnomor;
				$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
				if ($ceknomorsrt == 0){
					$nomor 		= 1;
				}else {
					$ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
					$lastno		= $ceknomorsrt->nomor;
					$nomor 		= $lastno+1;
				}
				$nippegawai		= $getdata->lampiran;
				$getidpegawai	= Simpegpegawai::where('nip_baru', $nippegawai)->first();
				if (isset($getidpegawai->id)){
					$idpegawai	= $getidpegawai->id;
				} else { $idpegawai = 0; }
				$ceksudah 		= Suratkeluar::where('jenissrt', 'CUTI')->where('isisurat', $getdata->id)->count();
				if ($ceksudah == 0){
					$input 		= Suratkeluar::insertGetId([
						'marking' 		=>  $markingsrt,
						'jenissrt' 		=>  'CUTI',
						'nomor' 		=>  $nomor,
						'anakno' 		=>  '',
						'kodefak' 		=>  $getpejabat->kode,
						'unit' 			=>  'KP',
						'tglsurat' 		=>  $tanggal,
						'daysrt' 		=>  $dd,
						'monsrt' 		=>  $mm,
						'yersrt' 		=>  $yy,
						'dasarsurat' 	=>  '',
						'kepada' 		=>  $getdata->pembuat,
						'alamat' 		=>  $getdata->namapejabat,
						'perihal' 		=>  'CUTI',
						'lampiran' 		=>  '',
						'isisurat' 		=>  $getdata->id,
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $getpejabat->pejabat,
						'namapejabat' 	=>  $getpejabat->nama.'<br />NIP'.$getpejabat->nip,
						'tembusan' 		=>  '',
						'sifat' 		=>  '4',
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('nama'),
						'kelompok' 		=>  Session('previlage'),
						'status' 		=>  'NEW',
						'arsip' 		=>  '',
						'footnote' 		=>  '',
						'tandatangan' 	=>  '',
						'paraf1' 		=>  $idparaf1,
						'paraf2' 		=>  $idparaf2,
						'paraf3' 		=>  $idparaf3,
						'paraf4' 		=>  $idparaf4,
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
						'faskode' 		=>  'KP.10.01.2',
						'fasmasa' 		=>  '1',
						'fasket' 		=>  'Masuk berkas perseorangan',
						'subkode' 		=>  '',
						'submasa' 		=>  '0',
						'subket' 		=>  '',
						'font' 			=>  'ARL',
						'ukuran' 		=>  '11',
						'lebarttd' 		=>  '40',
						'filelampiran' 	=>  '',
						'fakultas' 		=>  $fakultas
					]);
					$idsurat = $input;
				} else {
					$getidsurat = Suratkeluar::where('jenissrt', 'CUTI')->where('isisurat', $getdata->id)->first();
					$idsurat	= $getidsurat->id;
					$input 		= Suratkeluar::where('id', $idsurat)->update([
						'jenissrt' 		=>  'CUTI',
						'marking' 		=>  $markingsrt,
						'nomor' 		=>  $nomor,
						'kodefak' 		=>  $getpejabat->kode,
						'tglsurat' 		=>  $tanggal,
						'daysrt' 		=>  $dd,
						'monsrt' 		=>  $mm,
						'yersrt' 		=>  $yy,
						'kepada' 		=>  $getdata->pembuat,
						'alamat' 		=>  $getdata->namapejabat,
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $getpejabat->pejabat,
						'namapejabat' 	=>  $getpejabat->nama.'<br />NIP'.$getpejabat->nip,
						'pembuat' 		=>  Session('nama'),
						'kelompok' 		=>  Session('previlage'),
						'paraf1' 		=>  $idparaf1,
						'paraf2' 		=>  $idparaf2,
						'paraf3' 		=>  $idparaf3,
						'paraf4' 		=>  $idparaf4,
						'updated_at' 	=>  date("Y-m-d H:i:s")
					]);
				}
				if ($input){
					if ($idparaf1 == 'SELF'){
						$kirimke	= $idpejabat;
					} else {
						$kirimke	= $idparaf1;
					}
					Inboxsurat::where('marking', $markingsrt)->delete();
					$getpejabat		= Pejabatsurat::where('id', $kirimke)->first();
					if (isset($getpejabat->pejabat)){
						if ($idparaf1 == 'SELF'){
							SendMail::kiriminbox($marking,Session('jabatan'),$getpejabat->pejabat,$getpejabat->email,'KELUAR','TTD','','1');
						} else {
							SendMail::kiriminbox($marking,Session('jabatan'),$getpejabat->pejabat,$getpejabat->email,'KELUAR','PARAF','','1');
						}
					}
					if ($idpegawai != 0){
						$cekdisek 	= Penerimasurat::where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
						if ($cekdisek == 0){
							Penerimasurat::insert([
								'idsurat' 	=> $idsurat, 
								'jenis'		=> 'KELUAR', 
								'keterangan'=> 'CUTI',
								'idpegawai'	=> $idpegawai, 
								'nama'		=> $getdata->pembuat, 
								'jabatan'	=> $getdata->pejabat, 
								'penulisan'	=> $getdata->pembuat, 
								'tabel'		=> $homebase.'/viewsurat/keluar-'.$idsurat,
								'status'	=> 'SEND',
								'fakultas'	=> Session('fakultas')
							]);
						}
					}
					Suratkeluartnpnomor::where('id', $idne)->update([
						'tandatangan'	=> $homebase.'/viewsurat/keluar-'.$idsurat,
						'status'		=> 'SELESAI'
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat '.$getdata->perihal.' an. '.$getdata->pembuat.' Telah di buat dengan nomor : '.$nomor.' dan kami kirimke '.$getpejabat->pejabat]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenissrt.' tertanggal mulai cuti '.$mulai.' gagal di update']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenissrt.' tertanggal mulai cuti '.$mulai.' gagal di buatkan surat cutinya']);
				return back();
			}
		} else if ($idne == 'Verifikasi'){
			$marking		= $request->input('val01');
			$persetujuan	= $request->input('val02');
			$catatan		= $request->input('val03');
			$arrkepada		= $request->input('val04');
			$jenis			= $request->input('val05');
			$hari			= $request->input('val06');
			$mulai			= $request->input('val07');
			$akhir			= $request->input('val08');
			if ($catatan == ''){ $catatan = $persetujuan; }
			$input			= Inboxsurat::where('marking', $marking)->where('status', 'send')->update([
				'status'		=>  'reply',
				'catatan'		=>  $persetujuan,
				'tandatangan'	=>  $catatan,
				'tanggal'		=>  date("Y-m-d H:i:s"),
			]);
			if ($input){
				$cekdatalm			= Suratkeluartnpnomor::where('marking', $marking)->first();
				$status				= $cekdatalm->status;
				if ($status == 'NEW'){
					$status = 'ATASAN';
				} else if ($status == 'ATASAN'){
					$status = 'PEJABAT';
				} else {
					$status = 'PETUGAS SK';
				}
				Suratkeluartnpnomor::where('marking', $marking)->update([
					'status' 		=>  $status,
					'perihal' 		=>  $jenis,
					'tglbuat' 		=>  $mulai,
					'dasarsurat' 	=>  $akhir,
					'kelompok' 		=>  $hari,
					'updated_at'	=> 	date("Y-m-d H:i:s")
				]);
				foreach ( $arrkepada as $tujuan ){
					if ($tujuan != ''){
						$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $tujuan)->first();
						if (isset($getemail->id)){
							$email 	= $getemail->email;
						} else { $email = $tujuan; }
						SendMail::kiriminbox($marking,Session('jabatan'),$tujuan,$email,'MASUK','DISPOSISI','','1');
					}
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat '.$jenis.' Sukses di Verifikasi']);
				return back();
			
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenis.' tertanggal mulai cuti '.$mulai.' gagal di verifikasi']);
				return back();
			}
		} else {
			$nip 			= preg_replace('/\s+/', '', $nip);
			Simpegpegawai::where('id', $idpeg)->update([
				'jabatan'		=> $jabatan, 
				'unit_kerja'	=> $unitkerja, 
				'alamat'		=> $alamat, 
				'no_hp'			=> $nohape,
			]);
			User::where('nip', $idpeg)->update([
				'tandatangan'	=> $tandatangan
			]);
			$getpegawai		= Simpegpegawai::where('id', $idpeg)->first();
			$fakultas		= Session('fakultas');
			if ($idne == 'new'){
				$ceksurat =  Suratkeluartnpnomor::where('pembuat', $nip)->where('jenissrt', $jenis)->where('tglbuat', $mulai)->count();
			} else {
				$ceksurat =  Suratkeluartnpnomor::where('id', '!=', $idne)->where('pembuat', $nip)->where('jenissrt', $jenis)->where('tglbuat', $mulai)->count();
			}
			if ($ceksurat == 0){
				if ($idne == 'new'){
					$dd 	  			= date("d");
					$mm 	  			= date("m");
					$yy 	  			= date("Y");
					$getid 				= Suratkeluartnpnomor::orderBy('id', 'DESC')->first();
					$idnomor			= $getid->id;
					$idnomor			= $idnomor + 1;
					$getpejabat			= Pejabatsurat::where('id', $idatasan)->first();
					$idpejabat			= $getpejabat->id;
					$penandatangan		= $getpejabat->pejabat;
					$setttd				= $getpejabat->nama;
					$kodepjbt			= $getpejabat->kode;
					$marking 			= $fakultas.'-NON-'.$yy.$idnomor;
					if ($jenis == 'Cuti Tahunan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan'; }
					else if ($jenis == 'Cuti Besar'){ $kodeklasifikasi = 'KP.10.00.1'; $masa = '2'; $fasket = 'Masuk berkas perseorangan';}
					else if ($jenis == 'Cuti Sakit'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
					else if ($jenis == 'Cuti Melahirkan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
					else if ($jenis == 'Cuti Karena Alasan Penting'){ $kodeklasifikasi = 'KP.10.02.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
					else { $kodeklasifikasi = 'KP.10.03.1'; $masa = '3'; $fasket = 'Masuk berkas perseorangan';}
					$input 			= Suratkeluartnpnomor::create([
						'id' 			=>  $idnomor,
						'marking' 		=>  $marking,
						'jenissrt' 		=>  'CUTI',
						'kodefak' 		=>  $kodepjbt,
						'unit' 			=>  'KP',
						'tglbuat' 		=>  $mulai,
						'yersrt' 		=>  $yy,
						'dasarsurat' 	=>  $akhir,
						'kepada' 		=>  $penandatangan,
						'alamat' 		=>  $request->input('val13'),
						'perihal' 		=>  $jenis,
						'lampiran' 		=>  $nip,
						'isisurat' 		=>  $tandatangan,
						'idpejabat' 	=>  $request->input('val14'),
						'pejabat' 		=>  $jabatan,
						'namapejabat' 	=>  $unitkerja,
						'tembusan' 		=>  $alamat,
						'sifat' 		=>  'Biasa',
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('nama'),
						'kelompok' 		=>  $hari,
						'status' 		=>  'NEW',
						'arsip' 		=>  '',
						'footnote' 		=>  $alasan,
						'tandatangan' 	=>  '',
						'paraf1' 		=>  $getpegawai->nama_lengkap,
						'paraf2' 		=>  '0',
						'paraf3' 		=>  '0',
						'paraf4' 		=>  '0',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
						'faskode' 		=>  $kodeklasifikasi,
						'fasmasa' 		=>  $masa,
						'fasket' 		=>  $fasket,
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  '',
						'font' 			=>  'ARL',
						'ukuran' 		=>  $nohape,
						'lebarttd' 		=>  '50',
						'fakultas' 		=>  $fakultas,
					]);
					if ($input){
						$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $penandatangan)->first();
						if (isset($getemail->id)){
							$email 	= $getemail->email;
						} else { $email = $penandatangan; }
						SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'MASUK','CUTI','','1');
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat '.$jenis.' Sukses di Antrikan ke '.$penandatangan.' Untuk di Periksa']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat '.$jenis.' Gagal di Tambahkan Ulangi Beberapa Saat Lagi']);
						return back();
					}
				} else {
					$cekdatalm			= Suratkeluartnpnomor::where('id', $idne)->first();
					$marking			= $cekdatalm->marking;
					$status				= $cekdatalm->status;
					if ($status == 'NEW' OR $status == 'ATASAN'){
						$getpejabat			= Pejabatsurat::where('id', $idatasan)->first();
						$idpejabat			= $getpejabat->id;
						$penandatangan		= $getpejabat->pejabat;
						$setttd				= $getpejabat->nama;
						$kodepjbt			= $getpejabat->kode;
						if ($jenis == 'Cuti Tahunan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan'; }
						else if ($jenis == 'Cuti Besar'){ $kodeklasifikasi = 'KP.10.00.1'; $masa = '2'; $fasket = 'Masuk berkas perseorangan';}
						else if ($jenis == 'Cuti Sakit'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
						else if ($jenis == 'Cuti Melahirkan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
						else if ($jenis == 'Cuti Karena Alasan Penting'){ $kodeklasifikasi = 'KP.10.02.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
						else { $kodeklasifikasi = 'KP.10.03.1'; $masa = '3'; $fasket = 'Masuk berkas perseorangan';}
						$input 			= Suratkeluartnpnomor::where('id', $idne)->update([
							'kodefak' 		=>  $kodepjbt,
							'tglbuat' 		=>  $mulai,
							'dasarsurat' 	=>  $akhir,
							'kepada' 		=>  $penandatangan,
							'alamat' 		=>  $request->input('val13'),
							'perihal' 		=>  $jenis,
							'lampiran' 		=>  $nip,
							'isisurat' 		=>  $tandatangan,
							'idpejabat' 	=>  $request->input('val14'),
							'paraf1' 		=>  $getpegawai->nama_lengkap,
							'status' 		=>  'NEW',
							'pejabat' 		=>  $jabatan,
							'namapejabat' 	=>  $unitkerja,
							'tembusan' 		=>  $alamat,
							'kelompok' 		=>  $hari,
							'footnote' 		=>  $alasan,
							'faskode' 		=>  $kodeklasifikasi,
							'fasmasa' 		=>  $masa,
							'fasket' 		=>  $fasket,
							'ukuran' 		=>  $nohape,
							'updated_at'	=> 	date("Y-m-d H:i:s")
						]);
						if ($input){
							Inboxsurat::where('marking', $marking)->delete();
							$getemail 	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $penandatangan)->first();
							if (isset($getemail->id)){
								$email 	= $getemail->email;
							} else { $email = $penandatangan; }
							SendMail::kiriminbox($marking,Session('nama'),$penandatangan,$email,'MASUK','CUTI','','1');
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat '.$jenis.' Sukses di update']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenissrt.' tertanggal mulai cuti '.$mulai.' gagal di update']);
							return back();
						}
					} else {
						$getpejabat			= Pejabatsurat::where('id', $idpejabat)->first();
						$penandatangan		= $getpejabat->pejabat;
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenissrt.' tertanggal mulai cuti '.$mulai.' sudah masuk ke inbox '.$penandatangan.' dan tidak bisa diubah kembali']);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Surat => '.$jenissrt.' tertanggal mulai cuti '.$mulai.' sudah ada, gunakan fasilitas edit / delete untuk melakukan perubahan']);
				return back();
			}
		}
	}
	public function viewsuratCuti($id){
		$data		= [];
		$homebase	= url("/");
		$alamatweb	= $homebase.'/viewsurat/keluarnonomer-'.$id;
		$qrcode 	= QrCode::size(150)->generate($alamatweb);
		$kalender   = array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd         = date("d");
		$mm         = (int)date("m");
		$mm			= $kalender[$mm];
		$tahuniki   = date("Y");
		$tglsurat	= date("Y-m-d");
		$sakniki	= $dd.' '.$mm.' '.$tahuniki;
		$getdata	= Suratkeluartnpnomor::where('marking', $id)->first();
		if (isset($getdata->id)){
			if (Session('previlage') == 'PEJABAT'){
				$fakultas			= Session('fakultas');
				$units				= Unitsurat::all();
				$mcmdispo			= Macamdisposisi::where('fakultas', $fakultas)->orderBy('urutan', 'ASC')->get();
				$mkelompok 			= Session('jabatan');
				$tempnama 			= array("Plt. ", "Plh. ");
				$mkelompok 			= str_replace($tempnama, "", $mkelompok);
				$i					= 0;
				$jklmplaindet 		= User::where('fakultas', $fakultas)->where('previlage', '!=', $mkelompok)->get();
				foreach($jklmplaindet as $rklmplaindet) {
					$cekjenise  = Pejabatsurat::where('pejabat', $rklmplaindet->previlage)->first();
					if (isset($cekjenise->id)){
						$data['pejabats'][$i]['idne']	=   $cekjenise->id;
						$data['pejabats'][$i]['kode']	=   $rklmplaindet->previlage;
						$data['pejabats'][$i]['nama']	=   $rklmplaindet->previlage;
					} else {
						$tulisanne 	= $rklmplaindet->previlage.' ( '.$rklmplaindet->nama.' )';
						$data['pejabats'][$i]['idne']	=   '0';
						$data['pejabats'][$i]['kode']	=   $rklmplaindet->nama;
						$data['pejabats'][$i]['nama']	=   $tulisanne;	
					}
					$i++;
				}
				$data['pejabats'][$i]['idne']	=   '0';
				$data['pejabats'][$i]['kode']	=   'Arsiparis Umum';
				$data['pejabats'][$i]['nama']	=   'Arsiparis Umum';
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
				$idusername			= Session('id');
				$jmerangkap			= User::where('username', Session('username'))->first();
				if (isset($jmerangkap->merangkap)){
					$merangkap		= $jmerangkap->merangkap;
					$idpeg			= $jmerangkap->nip;
					$email			= $jmerangkap->email;
					$notifikasiemail= $jmerangkap->notifikasiemail;
				} else { $merangkap = '';  $idpeg = 0; $email = ''; $notifikasiemail = 0;}
				if ($notifikasiemail == 1){
					$teksnotif 	= 'AKTIF';
				} else {
					$teksnotif	= 'Tidak Aktif';
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
					$cdatane	= Tujuandisposisi::where('kelompok', 'LIKE', $merangkap)->count();
					if ($cdatane != 0){
						$jdatane		= Tujuandisposisi::where('kelompok', 'LIKE', $merangkap)->orderBy('tabel', 'ASC')->orderBy('idtujuan', 'ASC')->get();
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
								
							}else {
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
				$countmailbox 			= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
				$data['countsendnd']    = Suratkeluar::where('fakultas', Session('fakultas'))->where('pembuat', 'LIKE', Session('nama'))->where('status', 'NEW')->where('jenissrt', 'Nota Dinas')->count();
				$nip 					= $getdata->lampiran;
				$getpegawai				= Simpegpegawai::where('nip_baru', $nip)->first();
				if (isset($getpegawai->id)){
					$nama				= $getpegawai->nama_lengkap;
					$masakerjapeg		= $getpegawai->thn_masuk;
					$datetime   		= new DateTime($masakerjapeg);
					$today      		= new DateTime();
					$diff       		= $today->diff($datetime);
					$mkgthn      		= $diff->y;
					$mkgbln      		= $diff->m;
					if ($mkgthn ==0) {
						$masakerja   	= $mkgbln." Bulan";
					} else {
						$masakerja   	= $mkgthn." Tahun, ". $mkgbln. " Bulan";
					}
				} else {
					$masakerja			= '';
					$nama 				= '';
				}
				$mulai 			= $getdata->tglbuat;
				$akhir 			= $getdata->dasarsurat;
				$arrmulai		= explode('-', $mulai);
				$arrakhir		= explode('-', $akhir);
				if (isset($arrmulai[2])){
					$yy			= $arrmulai[0];
					$mm			= (int)$arrmulai[1];
					$dd			= $arrmulai[2];
					$mm			= $kalender[$mm];
					$mulai		= $dd.' '.$mm.' '.$yy;
				}
				if (isset($arrakhir[2])){
					$yy			= $arrakhir[0];
					$mm			= (int)$arrakhir[1];
					$dd			= $arrakhir[2];
					$mm			= $kalender[$mm];
					$akhir		= $dd.' '.$mm.' '.$yy;
				}
				$tanggal				= $mulai.' s/d '.$akhir;
				$idatasanlangsung		= $getdata->alamat;
				$idpejabat				= $getdata->idpejabat;
				$cekpejabat1			= Pejabatsurat::where('id', $idatasanlangsung)->first();
				if (isset($cekpejabat1->pejabat)){
					$jabatasanlangsung	= $cekpejabat1->pejabat;
					$namatasanlangsung	= $cekpejabat1->nama;
					$nipatasanlangsung	= $cekpejabat1->nip;
				} else {
					$jabatasanlangsung	= '';
					$namatasanlangsung	= '';
					$nipatasanlangsung	= '';
				}
				$cekpejabat2			= Pejabatsurat::where('id', $idpejabat)->first();
				if (isset($cekpejabat2->pejabat)){
					$jabpejabat			= $cekpejabat2->pejabat;
					$nampejabat			= $cekpejabat2->nama;
					$nippejabat			= $cekpejabat2->nip;
				} else {
					$jabpejabat			= '';
					$nampejabat			= '';
					$nippejabat			= '';
				}
				$tabeldataverifikator1	= '';
				$tabeldataverifikator2	= '';
				$statverifikator2a		= '&nbsp;';
				$statverifikator2b		= '&nbsp;';
				$statverifikator2c		= '&nbsp;';
				$statverifikator2d		= '&nbsp;';
				$statverifikator2alasan	= '&nbsp;';
				$statverifikator1a		= '&nbsp;';
				$statverifikator1b		= '&nbsp;';
				$statverifikator1c		= '&nbsp;';
				$statverifikator1d		= '&nbsp;';
				$statverifikator1alasan	= '&nbsp;';
				$verifikatorselanjutnya	= '';
				$tahunini				= date('Y');
				$tahunlalu				= $tahunini - 1;
				$duatahunlalu			= $tahunini - 2;
				$jatahtahunini			= 0;
				$jatahtahunlalu			= 0;
				$jatahduatahunlalu		= 0;
				$counttahunini			= Suratkeluartnpnomor::whereYear('tglbuat', $tahunini)->where('lampiran', $getdata->lampiran)->where('perihal', 'Cuti Tahunan')->where('jenissrt', 'CUTI')->count();
				$counttahunlalu			= Suratkeluartnpnomor::whereYear('tglbuat', $tahunlalu)->where('lampiran', $getdata->lampiran)->where('perihal', 'Cuti Tahunan')->where('jenissrt', 'CUTI')->count();
				$countduatahunlalu		= Suratkeluartnpnomor::whereYear('tglbuat', $duatahunlalu)->where('lampiran', $getdata->lampiran)->where('perihal', 'Cuti Tahunan')->where('jenissrt', 'CUTI')->count();
				$gettahun1				= Settingcuti::where('fakultas', Session('fakultas'))->where('tahun', $tahunini)->first();
				if (isset($gettahun1->jumlah)){
					$jatahtahunini		= $gettahun1->jumlah;
				}
				$gettahun2				= Settingcuti::where('fakultas', Session('fakultas'))->where('tahun', $tahunlalu)->first();
				if (isset($gettahun2->jumlah)){
					$jatahtahunlalu		= $gettahun2->jumlah;
				}
				$gettahun3				= Settingcuti::where('fakultas', Session('fakultas'))->where('tahun', $duatahunlalu)->first();
				if (isset($gettahun3->jumlah)){
					$jatahduatahunlalu	= $gettahun3->jumlah;
				}
				if ($getdata->status == 'NEW'){
					$verifikatortext					= 'VII. PERTIMBANGAN ATASAN LANGSUNG';
					$verifikatorid						= $idatasanlangsung;
					$verifikatornama					= $namatasanlangsung;
					$verifikatorjabatan					= $jabatasanlangsung;
					$verifikatornip						= $nipatasanlangsung;
					$verifikatorselanjutnya				= $idpejabat;
					$persetujuanatasanlangsung			= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
					$persetujuanpejabat					= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
				} else if ($getdata->status == 'ATASAN'){
					$cekinboxatasan						= Inboxsurat::where('marking', $getdata->marking)->where('penerima', $jabatasanlangsung)->first();
					if (isset($cekinboxatasan->id)){
						if ($cekinboxatasan->catatan == 'DISETUJUI'){ $statverifikator1a = '&radic;'; }
						if ($cekinboxatasan->catatan == 'PERUBAHAN'){ $statverifikator1a = '&radic;'; }
						if ($cekinboxatasan->catatan == 'DITANGGUHKAN'){ $statverifikator1a = '&radic;'; }
						if ($cekinboxatasan->catatan == 'TIDAK DISETUJUI'){ $statverifikator1a = '&radic;'; }
						$statverifikator1alasan = $cekinboxatasan->tandatangan;
						$persetujuan1					= $cekinboxatasan->catatan.' Oleh '.$jabatasanlangsung.' Pada '.$cekinboxatasan->created_at;
						$qrcode1 						= base64_encode(QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($persetujuan1));
						$persetujuanatasanlangsung		= '<img src="data:image/png;base64,'.$qrcode1.'" width="100" height="100"/>';
					} else {
						$persetujuanatasanlangsung		= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
					}
					$verifikatortext					= 'VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI';
					$verifikatorid						= $idpejabat;
					$verifikatornama					= $nampejabat;
					$verifikatorjabatan					= $jabpejabat;
					$verifikatornip						= $nippejabat;
					$persetujuanpejabat					= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
					$tabeldataverifikator1				= '
						<tr><td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 height="21" align="left" valign="top">VII. PERTIMBANGAN ATASAN LANGSUNG**</td></tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; " colspan=2 height="21" align="center" valign="top">DISETUJUI</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">PERUBAHAN</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">DITANGGUHKAN</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">TIDAK DISETUJUI</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; " colspan=2 height="21" align="center" valign="top">'.$statverifikator1a.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">'.$statverifikator1b.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$statverifikator1c.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">'.$statverifikator1d.'</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; border-bottom: 1px solid #000000; " colspan=6 rowspan=4 align="center" valign="top">'.$statverifikator1alasan.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$jabatasanlangsung.'</td>
						</tr>
						<tr><td style="border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$persetujuanatasanlangsung.'</td></tr>
						<tr><td style="border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$namatasanlangsung.'</td></tr>
						<tr><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">NIP. '.$nipatasanlangsung.'</td></tr>';
				} else {
					$cekinboxatasan						= Inboxsurat::where('marking', $getdata->marking)->where('penerima', $jabatasanlangsung)->first();
					if (isset($cekinboxatasan->id)){
						if ($cekinboxatasan->catatan == 'DISETUJUI'){ $statverifikator1a = '&radic;'; }
						if ($cekinboxatasan->catatan == 'PERUBAHAN'){ $statverifikator1a = '&radic;'; }
						if ($cekinboxatasan->catatan == 'DITANGGUHKAN'){ $statverifikator1a = '&radic;'; }
						if ($cekinboxatasan->catatan == 'TIDAK DISETUJUI'){ $statverifikator1a = '&radic;'; }
						$statverifikator1alasan = $cekinboxatasan->tandatangan;
						$persetujuan1					= $cekinboxatasan->catatan.' Oleh '.$jabatasanlangsung.' Pada '.$cekinboxatasan->created_at;
						$qrcode1 						= base64_encode(QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($persetujuan1));
						$persetujuanatasanlangsung		= '<img src="data:image/png;base64,'.$qrcode1.'" width="100" height="100"/>';
					} else {
						$persetujuanatasanlangsung		= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
					}
					$cekinboxpejabat					= Inboxsurat::where('marking', $getdata->marking)->where('penerima', $jabpejabat)->first();
					if (isset($cekinboxpejabat->id)){
						if ($cekinboxpejabat->catatan == 'DISETUJUI'){ $statverifikator2a = '&radic;'; }
						if ($cekinboxpejabat->catatan == 'PERUBAHAN'){ $statverifikator2b = '&radic;'; }
						if ($cekinboxpejabat->catatan == 'DITANGGUHKAN'){ $statverifikator2c = '&radic;'; }
						if ($cekinboxpejabat->catatan == 'TIDAK DISETUJUI'){ $statverifikator2d = '&radic;'; }
						$statverifikator2alasan = $cekinboxpejabat->tandatangan;
						$persetujuan2					= $cekinboxatasan->catatan.' Oleh '.$jabpejabat.' Pada '.$cekinboxatasan->created_at;
						$qrcode2 						= base64_encode(QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($persetujuan2));
						$persetujuanpejabat				= '<img src="data:image/png;base64,'.$qrcode2.'" width="100" height="100"/>';
					} else {
						$persetujuanpejabat				= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';	
					}
					$tabeldataverifikator1				= '
						<tr><td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 height="21" align="left" valign="top">VII. PERTIMBANGAN ATASAN LANGSUNG**</td></tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; " colspan=2 height="21" align="center" valign="top">DISETUJUI</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">PERUBAHAN</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">DITANGGUHKAN</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">TIDAK DISETUJUI</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; " colspan=2 height="21" align="center" valign="top">'.$statverifikator1a.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">'.$statverifikator1b.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$statverifikator1c.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">'.$statverifikator1d.'</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; border-bottom: 1px solid #000000; " colspan=6 rowspan=4 align="center" valign="top">'.$statverifikator1alasan.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$jabatasanlangsung.'</td>
						</tr>
						<tr><td style="border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$persetujuanatasanlangsung.'</td></tr>
						<tr><td style="border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$namatasanlangsung.'</td></tr>
						<tr><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">NIP. '.$nipatasanlangsung.'</td></tr>';
					$tabeldataverifikator2				= '
						<tr><td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 height="21" align="left" valign="top">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</td></tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; " colspan=2 height="21" align="center" valign="top">DISETUJUI</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">PERUBAHAN</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">DITANGGUHKAN</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">TIDAK DISETUJUI</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; " colspan=2 height="21" align="center" valign="top">'.$statverifikator2a.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">'.$statverifikator2b.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$statverifikator2c.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="top">'.$statverifikator2d.'</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; border-bottom: 1px solid #000000; " colspan=6 rowspan=4 align="center" valign="top">'.$statverifikator2alasan.'</td>
							<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$jabpejabat.'</td>
						</tr>
						<tr><td style="border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$persetujuanpejabat.'</td></tr>
						<tr><td style="border-right: 1px solid #000000" colspan=3 align="center" valign="top">'.$nampejabat.'</td></tr>
						<tr><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign="top">NIP. '.$nippejabat.'</td></tr>';
				}
				$data['jatahtahunini']  			= $jatahtahunini;
				$data['jatahduatahunlalu']  		= $jatahduatahunlalu;
				$data['jatahtahunlalu']  			= $jatahtahunlalu;
				$data['counttahunini']  			= $counttahunini;
				$data['counttahunlalu']  			= $counttahunlalu;
				$data['countduatahunlalu']  		= $countduatahunlalu;
				$data['verifikatorselanjutnya']  	= $verifikatorselanjutnya;
				$data['tabeldataverifikator1']  	= $tabeldataverifikator1;
				$data['tabeldataverifikator2']  	= $tabeldataverifikator2;
				$data['jabatasanlangsung']  		= $jabatasanlangsung;
				$data['namatasanlangsung']  		= $namatasanlangsung;
				$data['nipatasanlangsung']  		= $nipatasanlangsung;
				$data['persetujuanatasanlangsung'] 	= $persetujuanatasanlangsung;
				$data['jabpejabat']   				= $jabpejabat;
				$data['nampejabat']   				= $nampejabat;
				$data['nippejabat']   				= $nippejabat;
				$data['persetujuanpejabat'] 		= $persetujuanpejabat;
				$data['nama']   					= $nama;
				$data['tanggal']   					= $tanggal;
				$data['tglsurat']   				= $tglsurat;
				$data['masakerja']   				= $masakerja;
				$data['perihal']   					= $getdata->jenissrt;
				$data['surate']   					= $getdata;
				$data['emailnotif']      			= $email;
				$data['emailstatus']      			= $teksnotif;
				$data['countmailbox']      			= $countmailbox;
				$data['countinboxmasuk']    		= $cinbox;
				$data['countinboxkeluar']   		= $coutbox;
				$data['units']      				= $units;
				$data['mcmdispo']   				= $mcmdispo;
				$data['sidebar']					= 'disposisi';
				return view('surat.vercuti', $data);
			} else {
				$data['surate']   	= $getdata;
				$data['marking']   	= $getdata->marking;
				$data['arrallpeg']	= Simpegpegawai::all();
				$data['pejabats']	= Pejabatsurat::whereIn('fakultas', [Session('fakultas'), 'KP-'.Session('fakultas')])->get();
				return view('surat.admincuti', $data);
			}
		} else {
			$data['surate']  	= $id;
			$data['marking']  	= $id;
			$data['arrallpeg']	= Simpegpegawai::all();
			$data['pejabats']	= Pejabatsurat::whereIn('fakultas', [Session('fakultas'), 'KP-'.Session('fakultas')])->get();
			return view('surat.admincuti', $data);
		}
	}
	public function getlistkuotacuti() {
		$arraysuratkeluaruser = [];
		$homebase		= url("/");
		$fakultas		= Session('fakultas');
		$jsurat			= Settingcuti::where('fakultas', $fakultas)->orderBy('tahun', 'DESC')->get();
		if (!empty($jsurat)){
			foreach ($jsurat as $hasil) {
				$arraysuratkeluaruser[] = array(
					'idne' 			=> $hasil->id,
					'tahun' 		=> $hasil->tahun,
					'jumlah' 		=> $hasil->jumlah,
					'inputor' 		=> $hasil->inputor,
					'keterangan' 	=> $hasil->keterangan,
					'fakultas' 		=> $hasil->fakultas,
				);
			}
		}
    	echo json_encode($arraysuratkeluaruser);	
    }
	public function exAddmemo(Request $request) {
		$validator = Validator::make($request->all(), [
          'id_sifat' 			=>  'required',
          'idparaf1' 			=> 	'required',
          'id_lampiran' 		=> 	'required',
          'id_hal' 				=> 	'required',
          'id_namapenandatangan'=> 	'required',
		  'id_konseptor' 		=> 	'required',
		  'id_penandatangan' 	=> 	'required',
		  'id_kodepjbt' 		=> 	'required',
        ]);
		if($validator->fails()) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi']);
			return back();
        } else {
			$certificate 		= 'file://'.base_path().'/public/sco.crt';
			$namaapps 			= Session('namaapps01');
			$swandhanafak       = Session('fakultas');
			$swandhanaalamat    = Session('addressapps01');
			$swandhanakemen     = Session('subdomainapps01');
			$swandhanauniv      = Session('subsubdomainapps01');
			$mkelompok			= Session('previlage');
			$pembuat			= Session('nama');
			$fakultas			= Session('fakultas');
			$swandhanakota    	= Session('kota01');
			$swandhanaemail		= Session('emailapps01');
			$homebase			= url("/");
			$kalender 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			$namafilelampiran	= '';
			$kodefas			= 'TU.00.00';
			$tanggal			= $request->input('id_tanggal');
			$unit				= $request->input('id_jenissurat');
			$lampiran			= $request->input('id_lampiran');
			$perihal			= $request->input('id_hal');
			$idpejabat			= $request->input('id_tertuju');
			$alamat				= $request->input('id_alamat');
			$isi_surat			= $request->input('isi_surat');
			$nmttd				= $request->input('id_namapenandatangan');
			$konseptor			= $request->input('id_konseptor');
			$tembusan			= $request->input('id_tembusan');
			$penandatangan		= $request->input('id_penandatangan');
			$sifat				= $request->input('id_sifat');
			$klasifikasi		= $request->input('id_klasifikasi');
			$idsurat			= $request->input('id_surat');
			$kodefakultas		= $request->input('id_kodepjbt');
			$thndasar			= $request->input('id_dasartahun');
			$dasar				= $request->input('id_dasar');
			$paraf1				= $request->input('idparaf1');
			$paraf2				= $request->input('idparaf2');
			$paraf3				= $request->input('idparaf3');
			$paraf4				= $request->input('idparaf4');
			$font				= $request->input('id_font');
			$ukuran				= $request->input('id_ukuran');
			$lebar				= $request->input('id_lebar');
			$nonik 				= $request->input('username');
			$passphare 			= $request->input('password');
			$jenissrt 			= $request->input('id_lebar');
			$user 				= User::find(Session('id'));
			if (Hash::check($passphare, $user->password)) {
				$benergak			= 'BENER';
				$cekparaf			= 'BENER';
				$tanggalesign 		= date('Y-m-d H:i:s');
				$username 			= 'esign';
				$password 			= 'qwerty';
				$klasaktif 			= 1;
				$klasinaktif 		= 2;
				$klasket 			= 'Musnah';
				if ($jenissrt == 'MEMO'){
					$getpenerima		= Simpegpegawai::where('id', $idpejabat)->first();
					$namapenerima		= $getpenerima->nama_lengkap;
					$jabpenerima		= $getpenerima->jabatan;
					$fakultas			= $getpenerima->ppabp;
					$ppabp				= $getpenerima->ppabp;
					$nip				= $getpenerima->nip_baru;
					$email				= $getpenerima->email_ub;
					$idpegawai			= $getpenerima->id;	
				} else {
					$getpenerima		= Pejabatsurat::where('id', $idpejabat)->first();
					if (isset($getpenerima->id)){
						$namapenerima		= $getpenerima->pejabat;
						$jabpenerima		= $getpenerima->pejabat;
						$fakultas			= $getpenerima->fakultas;
						$ppabp				= $getpenerima->fakultas;
						$nip				= $getpenerima->nip;
						$email				= $getpenerima->email;
						$idpegawai			= $getpenerima->id;	
						$getidpeg 			= Simpegpegawai::where('email_ub', $email)->where('ppabp', $ppabp)->first();
						if (isset($getidpeg->id)){
							$idpegawai		= $getidpeg->id;
						}
					}
				}
				$emailtembusan			= '';
				if ($tembusan != ''){
					$getdatatembusan	= Pejabatsurat::where('id', $tembusan)->first();
					if (isset($getdatatembusan->id)){
						$tembusan		= $getdatatembusan->pejabat;
						$emailtembusan	= $getdatatembusan->email;
					} else {
						$tembusan		= '';
					}
				} else { $tembusan = ''; }
				$nip				= preg_replace('/\s+/', '', $nip);
				$lebar 				= '40';
				$tgl 				= date("d");
				$bln 				= date("m");
				$thn 				= date("Y");
				$tlsbln				= (int)date("m");
				$tlsbln				= $kalender[$tlsbln];
				$tglsurat			= $tgl.' '.$tlsbln.' '.$thn;
				if ($paraf2 == ''){ $paraf2 = '0'; }
				if ($paraf3 == ''){ $paraf3 = '0'; }
				if ($paraf4 == ''){ $paraf4 = '0'; }
				if ($unit == ''){ $unit = 'PP'; }
				$setview			= 'DOWNLOAD';
				$spasi				= '';
				$ukuranfont			= '12';
				$jenisfontte		= '<font size="7" color="blue">';
				$fontstyle			= 'style="font-family: "Times New Roman", Times, serif; font-size: 12px;"';
				$setttd 			= $konseptor;
				$page_format		= array(
					'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 356),
					'Dur' => 3,
					'PZ' => 1,
				);
				$info = array(
					'Name' 			=> $namaapps,
					'Location' 		=> $swandhanauniv,
					'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
					'ContactInfo' 	=> $homebase,
				);
				$kopsurat		= 	'<img src="http://disaprimamedika.site/images/kopsurat/RSPHMLG.png" width="720" />';
				$generatesurat 	= '
						<table width="720" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
							<tr><th width="20" scope="col">&nbsp;</th><th width="120" scope="col">&nbsp;</th><th width="10" scope="col">&nbsp;</th><th width="270" scope="col">&nbsp;</th><th width="300" scope="col"></th></tr>
							<tr>
								<td colspan="5">
									'.$kopsurat.'
								</td>
							</tr>
							<tr>
							<td scope="row">&nbsp;</td>
							<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="3" align="right">&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4" style="text-align: center;">
									<font style="font-size:24px"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$jenissrt.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></font>
								</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>Yth</td>
								<td>:</td>
								<td colspan="2">'.$namapenerima.'</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>Dari</td>
								<td>:</td>
								<td colspan="2">'.$nmttd.'</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>Hal</td>
								<td>:</td>
								<td colspan="2">'.$perihal.'</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4" style="text-align: justify;">'.$isi_surat.'</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>'.$swandhanakota.' '.$tglsurat.'</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>'.$nmttd.',</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><font color="blue">Ditandatangani Secara Elektronik Pada :<br />'.date("Y-m-d H:i:s").'</font></td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td scope="row">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>'.$konseptor.'</td>
							</tr>
						</table>';
						
				if ($idsurat == 'new'){
					$getnoagenda 	= Suratmasuk::where('fakultas', Session('fakultas'))->where('yersrt', $thn)->orderBy('noagenda', 'DESC')->first();
					if (isset($getnoagenda->noagenda)){
						$noagenda 	= $getnoagenda->noagenda;
						$noagenda	= $noagenda + 1;
					} else { $noagenda = 1; }
					$marking 		= Session('fakultas').'-'.$thn.$noagenda;
					$alamatweb		= $homebase.'/trackingid/srtklr-'.$marking;
					$bgbssn			= '';
					SendMail::genQRCodefile($marking,$nmttd,$konseptor,$tanggalesign, $alamatweb);
					if (File::exists(base_path() ."public/scan/generate/bg-". $marking.".png")) {
						$bgbssn 	= base_path('public/scan/generate/bg-'.$marking.'.png');
					}
					if (File::exists(public_path() ."/scan/generate/bg-". $marking.".png")) {
						$bgbssn 	= public_path('/scan/generate/bg-'.$marking.'.png');
					}
					if ($bgbssn != '') {
						$serttte 				= md5(Session('email'));
						$ceksertifikatpribadi 	= $serttte.'.crt';
						$sertifikatpribadi 		= $serttte.'.csr';
						$certificate			= '';
						if (file_exists(base_path().'public/tte/'.$ceksertifikatpribadi)){
							$certificate 	= 'file://'.base_path().'public/tte/'.$ceksertifikatpribadi;
						}
						if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
							$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
						}
						if ($certificate == ''){
							$dn = array(
								"countryName" 			=> "IN",
								"stateOrProvinceName" 	=> "East Java Indonesia",
								"localityName" 			=> $swandhanakota,
								"organizationName" 		=> $swandhanauniv,
								"organizationalUnitName"=> $swandhanafak,
								"commonName" 			=> $konseptor,
								"emailAddress" 			=> Session('email')
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
							Storage::disk('local')->put('/tte/'.$serttte.'.crt', $pkeyout);
	            			file_put_contents(public_path()."/tte/".$serttte.".crt", $certout, FILE_APPEND | LOCK_EX);
							if (file_exists(base_path().'public/tte/'.$ceksertifikatpribadi)){
								$certificate 	= 'file://'.base_path().'public/tte/'.$ceksertifikatpribadi;
							}
							if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
								$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
							}
						}
						if ($certificate != ''){
							PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
							PDFCREATOR::SetProtection(array('modify', 'copy'), '', null, 0, null);
							PDFCREATOR::SetCreator(Session('nama'));
							PDFCREATOR::SetAuthor(Session('previlage'));
							PDFCREATOR::SetTitle($perihal);
							PDFCREATOR::SetSubject($namapenerima);
							PDFCREATOR::SetKeywords($jenissrt);
							PDFCREATOR::setPrintHeader(false);
							PDFCREATOR::setPrintFooter(false);
							PDFCREATOR::SetMargins(5, 0, 5);
							PDFCREATOR::setFontSubsetting(true);
							PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($bgbssn, 0, 0, 215, 340, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($generatesurat, false);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
							if (file_exists(public_path('scan/files/'.$marking.'.pdf'))){
								$kerjanya 		= Suratmasuk::insertGetId([
									'marking' 		=>  $marking,
									'noagenda' 		=>  $noagenda,
									'tglmasuk' 		=>  date("Y-m-d"),
									'tglsurat' 		=>  date("Y-m-d"),
									'daysrt' 		=>  date("d"),
									'monsrt' 		=>  date("m"),
									'yersrt' 		=>  date("Y"),
									'jenissurat' 	=>  'MO',
									'nosurat' 		=>  '',
									'asalsurat' 	=>  $nmttd,
									'kepada' 		=>  $namapenerima.' '.$tembusan,
									'perihal' 		=>  $perihal,
									'subyek' 		=>  'TU',
									'ringkasan' 	=>  '',
									'ringkasan2' 	=>  $isi_surat,
									'lampiran' 		=>  '',
									'scansurat' 	=>  $marking.'.pdf',
									'sifat' 		=>  '4',
									'bentuk' 		=>  'Surat Elektronik',
									'klasifikasi' 	=>  'Biasa',
									'pembuat' 		=>  Session('email'),
									'status' 		=>  '',
									'disposisi' 	=>  '',
									'arsip' 		=>  '',
									'ruangarsip' 	=>  '',
									'ordnerarsip' 	=>  '',
									'lemariarsip' 	=>  '',
									'faskode' 		=>  $kodefas,
									'fasmasa' 		=>  '1',
									'fasket' 		=>  $klasket,
									'subkode' 		=>  $idpejabat,
									'submasa' 		=>  '',
									'subket' 		=>  '',
									'fakultas' 		=>  Session('fakultas'),
								]);
								if ($kerjanya){
									if ($request->hasFile('id_filelampiran')) {
										$namafilelampiran 	= $kerjanya.'-LampiranMO-'.$marking;
										$namafilelampiran	= $namafilelampiran.'.'.$request->file('id_filelampiran')->getClientOriginalExtension();
										$request->file('id_filelampiran')->move(public_path('scan/files'), $namafilelampiran);
										Inboxsurat::insert([
											'marking'  		=> $marking,
											'pengirim'  	=> Session('jabatan'),
											'penerima'		=> $namapenerima,
											'email'			=> $email,
											'sifat'			=> 5,
											'status'		=> 'send',
											'jenis'			=> 'MASUK',
											'kerja'			=> 'DISPOSISI',
											'catatan'		=> '',
											'tandatangan'	=> '',
											'tanggal'		=> '',
											'idsurat' 		=> $kerjanya,
											'noagenda' 		=> $noagenda,
											'tglsurat' 		=> date("Y-m-d"),
											'jenissrt' 		=> $jenissrt,
											'nosurat' 		=> '',
											'kepada' 		=> $namapenerima,
											'perihal' 		=> $perihal,
											'alamat' 		=> '',
											'lampiran' 		=> $namafilelampiran,
											'kodefak' 		=> '',
											'klasifikasi' 	=> '',
											'pembuat' 		=> $konseptor,
											'unit' 			=> $nmttd,
											'tabel' 		=> $fakultas,
											'footnote'		=> $isi_surat
										]);
										Suratmasuk::where('marking', $marking)->update([
											'lampiran' 		=>  $namafilelampiran,
										]);
										if ($tembusan != ''){
											Inboxsurat::insert([
												'marking'  		=> $marking,
												'pengirim'  	=> Session('jabatan'),
												'penerima'		=> $tembusan,
												'email'			=> $emailtembusan,
												'sifat'			=> 5,
												'status'		=> 'send',
												'jenis'			=> 'MASUK',
												'kerja'			=> 'DISPOSISI',
												'catatan'		=> '',
												'tandatangan'	=> '',
												'tanggal'		=> '',
												'idsurat' 		=> $kerjanya,
												'noagenda' 		=> $noagenda,
												'tglsurat' 		=> date("Y-m-d"),
												'jenissrt' 		=> $jenissrt,
												'nosurat' 		=> '',
												'kepada' 		=> 'Tembusan : '.$tembusan,
												'perihal' 		=> $perihal,
												'alamat' 		=> '',
												'lampiran' 		=> $namafilelampiran,
												'kodefak' 		=> '',
												'klasifikasi' 	=> '',
												'pembuat' 		=> $konseptor,
												'unit' 			=> $nmttd,
												'tabel' 		=> $fakultas,
												'footnote'		=> $isi_surat
											]);
										}
									} else {
										Inboxsurat::insert([
											'marking'  		=> $marking,
											'pengirim'  	=> Session('jabatan'),
											'penerima'		=> $namapenerima,
											'email'			=> $email,
											'sifat'			=> 5,
											'status'		=> 'send',
											'jenis'			=> 'MASUK',
											'kerja'			=> 'DISPOSISI',
											'catatan'		=> '',
											'tandatangan'	=> '',
											'tanggal'		=> '',
											'idsurat' 		=> $kerjanya,
											'noagenda' 		=> $noagenda,
											'tglsurat' 		=> date("Y-m-d"),
											'jenissrt' 		=> $jenissrt,
											'nosurat' 		=> '',
											'kepada' 		=> $namapenerima,
											'perihal' 		=> $perihal,
											'alamat' 		=> '',
											'lampiran' 		=> '',
											'kodefak' 		=> '',
											'klasifikasi' 	=> '',
											'pembuat' 		=> $konseptor,
											'unit' 			=> $nmttd,
											'tabel' 		=> $fakultas,
											'footnote'		=> $isi_surat
										]);
										if ($tembusan != ''){
											Inboxsurat::insert([
												'marking'  		=> $marking,
												'pengirim'  	=> Session('jabatan'),
												'penerima'		=> $tembusan,
												'email'			=> $emailtembusan,
												'sifat'			=> 5,
												'status'		=> 'send',
												'jenis'			=> 'MASUK',
												'kerja'			=> 'DISPOSISI',
												'catatan'		=> '',
												'tandatangan'	=> '',
												'tanggal'		=> '',
												'idsurat' 		=> $kerjanya,
												'noagenda' 		=> $noagenda,
												'tglsurat' 		=> date("Y-m-d"),
												'jenissrt' 		=> $jenissrt,
												'nosurat' 		=> '',
												'kepada' 		=> 'Tembusan : '.$tembusan,
												'perihal' 		=> $perihal,
												'alamat' 		=> '',
												'lampiran' 		=> '',
												'kodefak' 		=> '',
												'klasifikasi' 	=> '',
												'pembuat' 		=> $konseptor,
												'unit' 			=> $nmttd,
												'tabel' 		=> $fakultas,
												'footnote'		=> $isi_surat
											]);
										}
									}
									SendMail::notif($namapenerima,$email,'Surat Dari '.$konseptor,'Mohon Periksa Di Aplikasi');
									$file1 			=  'scan/generate/bg-'.$marking.'.png';
									$file2 			=  'scan/generate/qrimg-'.$marking.'.png';
									$file3 			=  'scan/generate/qrimg-'.$marking.'.pdf';
									Storage::disk('local')->delete($file1);
									Storage::disk('local')->delete($file2);
									Storage::disk('local')->delete($file3);
									if ($tembusan != ''){
										SendMail::notif($tembusan,$emailtembusan,'Surat Dari '.$konseptor,'Mohon Periksa Di Aplikasi');
									}
									return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses..!!!', 'message' => 'Surat Telah Kami Kirimkan ke '.$namapenerima]);
									return back();
								} else{
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Gagal Terhubung dengan Database, Silahkan ulangi beberapa saat lagi']);
									return back();
								}
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Generate '.$jenissrt.' Gagal, Ulangi Beberapa Saat Lagi']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Generate Sertifikat TTE Gagal, Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Generate BG TTE Gagal, Ulangi Beberapa Saat Lagi']);
						return back();
					}
				} else {
					$getdata = Suratmasuk::where('id', $idsurat)->first();
					if (isset($getdata->id)){
						$marking		= $getdata->marking;
						$alamatweb		= $homebase.'/downloaddocbyname/'.$getdata->marking.'.pdf';
						$bgbssn			= '';
						SendMail::genQRCodefile($getdata->marking,$getdata->asalsurat,$konseptor,$tanggalesign,$alamatweb);
						if (File::exists(base_path() ."public/scan/generate/bg-". $marking.".png")) {
							$bgbssn 	= base_path('public/scan/generate/bg-'.$marking.'.png');
						}
						if (File::exists(public_path() ."/scan/generate/bg-". $marking.".png")) {
							$bgbssn 	= public_path('/scan/generate/bg-'.$marking.'.png');
						}
						if ($bgbssn != '') {
							if (file_exists(public_path('scan/files/'.$marking.'.pdf'))){
								$file 			=  'scan/files/'.$marking.'.pdf';
								Storage::disk('local')->delete($file);
							}
							$certificate 	= 'file://'.public_path().'/tte/'.$serttte.'.crt';
							PDFCREATOR::setSignature($certificate, $certificate, $marking, '', 2, $info, 'A');
							PDFCREATOR::SetProtection(array('modify', 'copy'), '', null, 0, null);
							PDFCREATOR::SetCreator(Session('nama'));
							PDFCREATOR::SetAuthor(Session('previlage'));
							PDFCREATOR::SetTitle($perihal);
							PDFCREATOR::SetSubject($namapenerima);
							PDFCREATOR::SetKeywords($jenissrt);
							PDFCREATOR::setPrintHeader(false);
							PDFCREATOR::setPrintFooter(false);
							PDFCREATOR::SetMargins(5, 0, 5);
							PDFCREATOR::setFontSubsetting(true);
							PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($bgbssn, 0, 0, 215, 340, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($generatesurat, false);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
							if (file_exists(public_path('scan/files/'.$marking.'.pdf'))){
								$update = Suratmasuk::where('id', $idsurat)->update([
									'noagenda' 		=>  $noagenda,
									'tglmasuk' 		=>  date("Y-m-d"),
									'tglsurat' 		=>  date("Y-m-d"),
									'daysrt' 		=>  date("d"),
									'monsrt' 		=>  date("m"),
									'yersrt' 		=>  date("Y"),
									'asalsurat' 	=>  $nmttd,
									'kepada' 		=>  $namapenerima,
									'perihal' 		=>  $perihal,
									'subyek' 		=>  'TU',
									'ringkasan2' 	=>  $isi_surat,
									'scansurat' 	=>  $marking.'.pdf',
									'pembuat' 		=>  Session('email'),
									'updated_at'	=>	date('Y-m-d H:i:s')
								]);
								if ($update){
									if ($request->hasFile('id_filelampiran')) {
										$namafilelampiran 	= $idsurat.'-LampiranMO-'.$marking;
										$namafilelampiran	= $namafilelampiran.'.'.$request->file('id_filelampiran')->getClientOriginalExtension();
										$request->file('id_filelampiran')->move(public_path('scan/files'), $namafilelampiran);
										Inboxsurat::insert([
											'marking'  		=> $marking,
											'pengirim'  	=> Session('jabatan'),
											'penerima'		=> $namapenerima,
											'email'			=> $email,
											'sifat'			=> 5,
											'status'		=> 'send',
											'jenis'			=> 'MASUK',
											'kerja'			=> 'DISPOSISI',
											'catatan'		=> '',
											'tandatangan'	=> '',
											'tanggal'		=> '',
											'idsurat' 		=> $kerjanya,
											'noagenda' 		=> $noagenda,
											'tglsurat' 		=> date("Y-m-d"),
											'jenissrt' 		=> $jenissrt,
											'nosurat' 		=> '',
											'kepada' 		=> $namapenerima,
											'perihal' 		=> $perihal,
											'alamat' 		=> '',
											'lampiran' 		=> $namafilelampiran,
											'kodefak' 		=> '',
											'klasifikasi' 	=> '',
											'pembuat' 		=> $konseptor,
											'unit' 			=> $nmttd,
											'tabel' 		=> $fakultas,
											'footnote'		=> $isi_surat
										]);
										Suratmasuk::where('marking', $marking)->update([
											'lampiran' 		=>  $namafilelampiran,
										]);
										if ($tembusan != ''){
											Inboxsurat::insert([
												'marking'  		=> $marking,
												'pengirim'  	=> Session('jabatan'),
												'penerima'		=> $tembusan,
												'email'			=> $emailtembusan,
												'sifat'			=> 5,
												'status'		=> 'send',
												'jenis'			=> 'MASUK',
												'kerja'			=> 'DISPOSISI',
												'catatan'		=> '',
												'tandatangan'	=> '',
												'tanggal'		=> '',
												'idsurat' 		=> $kerjanya,
												'noagenda' 		=> $noagenda,
												'tglsurat' 		=> date("Y-m-d"),
												'jenissrt' 		=> $jenissrt,
												'nosurat' 		=> '',
												'kepada' 		=> 'Tembusan : '.$tembusan,
												'perihal' 		=> $perihal,
												'alamat' 		=> '',
												'lampiran' 		=> $namafilelampiran,
												'kodefak' 		=> '',
												'klasifikasi' 	=> '',
												'pembuat' 		=> $konseptor,
												'unit' 			=> $nmttd,
												'tabel' 		=> $fakultas,
												'footnote'		=> $isi_surat
											]);
										}
									} else {
										Inboxsurat::insert([
											'marking'  		=> $marking,
											'pengirim'  	=> Session('jabatan'),
											'penerima'		=> $namapenerima,
											'email'			=> $email,
											'sifat'			=> 5,
											'status'		=> 'send',
											'jenis'			=> 'MASUK',
											'kerja'			=> 'DISPOSISI',
											'catatan'		=> '',
											'tandatangan'	=> '',
											'tanggal'		=> '',
											'idsurat' 		=> $kerjanya,
											'noagenda' 		=> $noagenda,
											'tglsurat' 		=> date("Y-m-d"),
											'jenissrt' 		=> $jenissrt,
											'nosurat' 		=> '',
											'kepada' 		=> $namapenerima,
											'perihal' 		=> $perihal,
											'alamat' 		=> '',
											'lampiran' 		=> '',
											'kodefak' 		=> '',
											'klasifikasi' 	=> '',
											'pembuat' 		=> $konseptor,
											'unit' 			=> $nmttd,
											'tabel' 		=> $fakultas,
											'footnote'		=> $isi_surat
										]);
										if ($tembusan != ''){
											Inboxsurat::insert([
												'marking'  		=> $marking,
												'pengirim'  	=> Session('jabatan'),
												'penerima'		=> $tembusan,
												'email'			=> $emailtembusan,
												'sifat'			=> 5,
												'status'		=> 'send',
												'jenis'			=> 'MASUK',
												'kerja'			=> 'DISPOSISI',
												'catatan'		=> '',
												'tandatangan'	=> '',
												'tanggal'		=> '',
												'idsurat' 		=> $kerjanya,
												'noagenda' 		=> $noagenda,
												'tglsurat' 		=> date("Y-m-d"),
												'jenissrt' 		=> $jenissrt,
												'nosurat' 		=> '',
												'kepada' 		=> 'Tembusan : '.$tembusan,
												'perihal' 		=> $perihal,
												'alamat' 		=> '',
												'lampiran' 		=> '',
												'kodefak' 		=> '',
												'klasifikasi' 	=> '',
												'pembuat' 		=> $konseptor,
												'unit' 			=> $nmttd,
												'tabel' 		=> $fakultas,
												'footnote'		=> $isi_surat
											]);
										}
									}
									SendMail::notif($namapenerima,$email,'Surat Dari '.$konseptor,'Mohon Periksa Surat Di Aplikasi');
									$file1 			=  'scan/generate/bg-'.$marking.'.png';
									$file2 			=  'scan/generate/qrimg-'.$marking.'.png';
									$file3 			=  'scan/generate/qrimg-'.$marking.'.pdf';
									Storage::disk('local')->delete($file1);
									Storage::disk('local')->delete($file2);
									Storage::disk('local')->delete($file3);
									if ($tembusan != ''){
										SendMail::notif($tembusan,$emailtembusan,'Surat Dari '.$konseptor,'Mohon Periksa Di Aplikasi');
									}
									return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses..!!!', 'message' => 'Surat Telah Kami Kirimkan ke '.$namapenerima]);
									return back();
								} else{
									return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Gagal Terhubung dengan Database, Silahkan ulangi beberapa saat lagi']);
									return back();
								}
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Generate '.$jenissrt.' Gagal, Ulangi Beberapa Saat Lagi']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Generate BG TTE Gagal, Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'ID Surat '.$idsurat.' Tidak Valid']);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Password Salah']);
				return back();
			}
		}
    }
	public function exSuratWithTemplate(Request $request) {
		$homebase			= url("/");
		$fakultas			= Session('fakultas');
		$masterkelompok		= $request->input('masterkelompok');
		$masterjenissurat	= $request->input('masterjenissurat');
		$masterpetugas		= $request->input('masterpetugas');
		$idpeg				= $request->input('idpegawai');
		$nip				= $request->input('nipbaru');
		$jabatan			= $request->input('jabatan');
		$unitkerja			= $request->input('unitkerja');
		$nohape				= $request->input('nohape');
		$alamat				= $request->input('alamat');
		$marking			= '';
		if ($masterjenissurat == 'Cuti Tahunan' OR $masterjenissurat == 'Cuti Keagamaan'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$jenis				= $request->input('cuti_jenis');
			$tandatangan		= '';
			$hari				= $request->input('cuti_hari');
			$mulai				= $request->input('cuti_mulai');
			$akhir				= $request->input('cuti_akhir');
			$alasan				= $request->input('cuti_alasan');
			$idne				= $request->input('cuti_id');
			$fakultas			= Session('fakultas');
			$nip 			= preg_replace('/\s+/', '', $nip);
			if ($jabatan != ''){
				Simpegpegawai::where('id', $idpeg)->update([
					'jabatan'		=> $jabatan, 
				]);
			}
			if ($unitkerja != ''){
				Simpegpegawai::where('id', $idpeg)->update([
					'unit_kerja'	=> $unitkerja, 
				]);
			}
			if ($alamat != ''){
				Simpegpegawai::where('id', $idpeg)->update([
					'alamat'		=> $alamat, 
				]);
			}
			if ($nohape != ''){
				Simpegpegawai::where('id', $idpeg)->update([
					'no_hp'			=> $nohape,
				]);
			}
			$getpegawai		= Simpegpegawai::where('id', $idpeg)->first();
			if ($idne == 'new'){
				$ceksurat =  Suratkeluartnpnomor::where('tglbuat', $mulai)->where('kepada', $getpegawai->nama_lengkap)->where('jenissrt', $jenis)->where('alamat', $getpegawai->email)->count();
			} else {
				$ceksurat =  Suratkeluartnpnomor::where('id', $idne)->where('tglbuat', $mulai)->where('kepada', $getpegawai->nama_lengkap)->where('jenissrt', $jenis)->where('alamat', $getpegawai->email)->count();
			}
			if ($ceksurat == 0){
				if ($idne == 'new'){
					$dd 	  			= date("d");
					$mm 	  			= date("m");
					$yy 	  			= date("Y");
					$getid 				= Suratkeluartnpnomor::orderBy('id', 'DESC')->first();
					if (isset($getid)){
						$idnomor		= $getid->id;
						$idnomor		= $idnomor + 1;	
					} else {
						$idnomor		= 1;
					}
					$getpejabat			= Pejabatsurat::where('fakultas', Session('fakultas'))->orderBy('id', 'DESC')->first();
					if (isset($getpejabat->id)){
						$idpejabat		= $getpejabat->id;
						$penandatangan	= $getpejabat->pejabat;
						$setttd			= $getpejabat->nama;
						$kodepjbt		= $getpejabat->kode;	
					} else {
						$idpejabat		= 0;
						$penandatangan	= '';
						$setttd			= '';
						$kodepjbt		= '';
					}
					$marking 			= $fakultas.'-NON-'.$yy.$idnomor;
					if ($jenis == 'Cuti Tahunan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan'; }
					else if ($jenis == 'Cuti Besar'){ $kodeklasifikasi = 'KP.10.00.1'; $masa = '2'; $fasket = 'Masuk berkas perseorangan';}
					else if ($jenis == 'Cuti Sakit'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
					else if ($jenis == 'Cuti Melahirkan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
					else if ($jenis == 'Cuti Karena Alasan Penting' OR $jenis == 'Cuti Keagamaan'){ $kodeklasifikasi = 'KP.10.02.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
					else { $kodeklasifikasi = 'KP.10.03.1'; $masa = '3'; $fasket = 'Masuk berkas perseorangan';}
					$input 			= Suratkeluartnpnomor::create([
						'id' 			=>  $idnomor,
						'marking' 		=>  $marking,
						'jenissrt' 		=>  $masterjenissurat,
						'kodefak' 		=>  $kodepjbt,
						'unit' 			=>  'KP',
						'tglbuat' 		=>  $mulai,
						'yersrt' 		=>  $yy,
						'dasarsurat' 	=>  $akhir,
						'kepada' 		=>  $getpegawai->nama_lengkap,
						'alamat' 		=>  $getpegawai->email,
						'perihal' 		=>  $jenis,
						'lampiran' 		=>  $nip,
						'isisurat' 		=>  $tandatangan,
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $jabatan,
						'namapejabat' 	=>  $unitkerja,
						'tembusan' 		=>  $alamat,
						'sifat' 		=>  'Biasa',
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('email'),
						'kelompok' 		=>  $hari,
						'status' 		=>  'NEW',
						'arsip' 		=>  '',
						'footnote' 		=>  $alasan,
						'tandatangan' 	=>  '',
						'paraf1' 		=>  'SELF',
						'paraf2' 		=>  '0',
						'paraf3' 		=>  '0',
						'paraf4' 		=>  '0',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
						'faskode' 		=>  $kodeklasifikasi,
						'fasmasa' 		=>  $masa,
						'fasket' 		=>  $fasket,
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  $idpeg,
						'font' 			=>  'ARL',
						'ukuran' 		=>  $nohape,
						'lebarttd' 		=>  '50',
						'fakultas' 		=>  $fakultas,
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $textinput.' Sukses di Proses']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses']);
						return back();
					}
				} else {
					$cekdatalm			= Suratkeluartnpnomor::where('id', $idne)->first();
					$marking			= $cekdatalm->marking;
					$status				= $cekdatalm->status;
					if ($status == 'NEW' OR $status == 'ATASAN'){
						$getpejabat			= Pejabatsurat::where('fakultas', Session('fakultas'))->orderBy('id', 'DESC')->first();
						if (isset($getpejabat->id)){
							$idpejabat		= $getpejabat->id;
							$penandatangan	= $getpejabat->pejabat;
							$setttd			= $getpejabat->nama;
							$kodepjbt		= $getpejabat->kode;	
						} else {
							$idpejabat		= 0;
							$penandatangan	= '';
							$setttd			= '';
							$kodepjbt		= '';
						}
						if ($jenis == 'Cuti Tahunan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan'; }
						else if ($jenis == 'Cuti Besar'){ $kodeklasifikasi = 'KP.10.00.1'; $masa = '2'; $fasket = 'Masuk berkas perseorangan';}
						else if ($jenis == 'Cuti Sakit'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
						else if ($jenis == 'Cuti Melahirkan'){ $kodeklasifikasi = 'KP.10.01.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
						else if ($jenis == 'Cuti Karena Alasan Penting' OR $jenis == 'Cuti Keagamaan'){ $kodeklasifikasi = 'KP.10.02.1'; $masa = '1'; $fasket = 'Masuk berkas perseorangan';}
						else { $kodeklasifikasi = 'KP.10.03.1'; $masa = '3'; $fasket = 'Masuk berkas perseorangan';}
						$input 			= Suratkeluartnpnomor::where('id', $idne)->update([
							'jenissrt' 		=>  $masterjenissurat,
							'kodefak' 		=>  $kodepjbt,
							'tglbuat' 		=>  $mulai,
							'dasarsurat' 	=>  $akhir,
							'kepada' 		=>  $getpegawai->nama_lengkap,
							'alamat' 		=>  $getpegawai->email,
							'perihal' 		=>  $jenis,
							'lampiran' 		=>  $nip,
							'isisurat' 		=>  $tandatangan,
							'idpejabat' 	=>  $request->input('val14'),
							'paraf1' 		=>  $getpegawai->nama_lengkap,
							'status' 		=>  'NEW',
							'pejabat' 		=>  $jabatan,
							'namapejabat' 	=>  $unitkerja,
							'tembusan' 		=>  $alamat,
							'kelompok' 		=>  $hari,
							'footnote' 		=>  $alasan,
							'faskode' 		=>  $kodeklasifikasi,
							'fasmasa' 		=>  $masa,
							'fasket' 		=>  $fasket,
							'ukuran' 		=>  $nohape,
							'subket' 		=>  $idpeg,
							'updated_at'	=> 	date("Y-m-d H:i:s")
						]);
						if ($input){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $textinput.' Sukses di Proses']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses, data yang sudah selesai proses tidak bisa diubah kembali']);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses, Mohon Ulangi Beberapa Saat Lagi']);
				return back();
			}
		}
		if ($masterjenissurat == 'PKWT Dokter Manajemen Perpanjangan' OR $masterjenissurat == 'PKWT Staf Klinis Lain dan Non Klinis Perpanjangan' OR $masterjenissurat == 'PKWT Staf Klinis Perpanjangan' OR $masterjenissurat == 'PKWT Dokter Manajemen Baru' OR $masterjenissurat == 'PKWT Dokter Umum (PART TIME)' OR $masterjenissurat == 'PKWT Dokter Spesialis' OR $masterjenissurat == 'PKWT Staf Klinis Lain dan Non Klinis Baru' OR $masterjenissurat == 'PKWT Staf Klinis Baru' OR $masterjenissurat == 'Perjanjian Orientasi Kerja NON-NAKES' OR $masterjenissurat == 'Perjanjian Orientasi Kerja NAKES' OR $masterjenissurat == 'Perjanjian Orientasi Kerja' OR $masterjenissurat == 'PKWT' OR $masterjenissurat == 'PKWTT' OR $masterjenissurat == 'PKWT Dokter Klinik'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpegawai 			= $request->input('idpegawai') != null ? $request->input('idpegawai') : '0';
			$ppabp 				= $request->input('ppabp') != null ? $request->input('ppabp') : Session('fakpanjang');
			$alamatpenempatan 	= $request->input('alamatpenempatan') != null ? $request->input('alamatpenempatan') : '';
			$unitkerja 			= $request->input('unitkerja') != null ? $request->input('unitkerja') : '';
			$jabatan 			= $request->input('jabatan') != null ? $request->input('jabatan') : '';
			$tmpt_lahir 		= $request->input('tmpt_lahir') != null ? $request->input('tmpt_lahir') : '';
			$tgl_lahir 			= $request->input('tgl_lahir') != null ? $request->input('tgl_lahir') : '';
			$cpns 				= $request->input('cpns') != null ? $request->input('cpns') : '';
			$alamat 			= $request->input('alamat') != null ? $request->input('alamat') : '';
			$nik 				= $request->input('nik') != null ? $request->input('nik') : '';
			$kelamin 			= $request->input('kelamin') != null ? $request->input('kelamin') : '';
			$kontrak_lamanya 	= $request->input('kontrak_lamanya') != null ? $request->input('kontrak_lamanya') : '';
			$satuan 			= $request->input('satuan') != null ? $request->input('satuan') : '';
			$tmt_jabatan 		= $request->input('tmt_jabatan') != null ? $request->input('tmt_jabatan') : '';
			$tmt_pensiun 		= $request->input('tmt_pensiun') != null ? $request->input('tmt_pensiun') : '';
			$gajisesuaisk 		= $request->input('gajisesuaisk') != null ? $request->input('gajisesuaisk') : '';
			$tanggal 			= $request->input('tanggal') != null ? $request->input('tanggal') : '';
			$kontrak_jenis 		= $request->input('kontrak_jenis') != null ? $request->input('kontrak_jenis') : '';
			$kontrak_id 		= $request->input('kontrak_id') != null ? $request->input('kontrak_id') : '';
			$jenispeg 			= $request->input('jenispeg') != null ? $request->input('jenispeg') : '';
			$uraiantugas 		= $request->input('kepdir_uraiantugas') != null ? $request->input('kepdir_uraiantugas') : '';
			$uraiantugas2 		= $request->input('kepdir_uraiantugas2') != null ? $request->input('kepdir_uraiantugas2') : '';
			$uraiantugas3 		= $request->input('kepdir_uraiantugas3') != null ? $request->input('kepdir_uraiantugas3') : '';
			$getpegawai 		= Simpegpegawai::where('id', $idpegawai)->first();
			if (isset($getpegawai->id)){
			    $ppabp 			= $getpegawai->ppabp;
				$getfakultas 	= User::where('fakpanjang', $ppabp)->first();
				if (isset($getfakultas->fakultas)){
					$fakultas 	= $getfakultas->fakultas;
				} else {
					$fakultas	= Session('fakultas');
				}
				if ($jenispeg == '' OR $alamatpenempatan == '' OR $unitkerja == '' OR $jabatan == '' OR $tmpt_lahir == '' OR $tgl_lahir == '' OR $cpns == '' OR $alamat == '' OR $nik == '' OR $kelamin == '' OR $kontrak_lamanya == '' OR $satuan == '' OR $tmt_jabatan == '' OR $tmt_pensiun == '' OR $gajisesuaisk == '' OR $tanggal == '' OR $kontrak_jenis == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) ']);
					return back();
				} else {
					if ($kontrak_id == 'new'){
						$postrek		= SendMail::genQRSatuNomor('1');
						$getnomor		= $postrek->getData();
						$idsurat		= $getnomor->idsurat;
						$keterangan		= $getnomor->keterangan;
						$status 		= $getnomor->status;
						$textinput 		= 'Input Data '.$masterjenissurat;
					} else {
						$idsurat 		= $kontrak_id;
						$keterangan		= '';
						$status 		= '';
						$textinput 		= 'Update Data '.$masterjenissurat;
					}
					if ($idsurat != 0){
						$isisurat			= $idpegawai.'[psh]'.$ppabp.'[psh]'.$alamatpenempatan.'[psh]'.$unitkerja.'[psh]'.$jabatan.'[psh]'.$tmpt_lahir.'[psh]'.$tgl_lahir.'[psh]'.$cpns.'[psh]'.$alamat.'[psh]'.$nik.'[psh]'.$kelamin.'[psh]'.$kontrak_lamanya.'[psh]'.$satuan.'[psh]'.$tmt_jabatan.'[psh]'.$tmt_pensiun.'[psh]'.$gajisesuaisk.'[psh]'.$tanggal.'[psh]'.$kontrak_jenis.'[psh]'.$jenispeg;
						$gajisesuaisk		= str_replace(',','',$gajisesuaisk);
						Simpegpegawai::where('id', $idpegawai)->update([
							'ppabp' 			=> $ppabp,
							'unit_kerja' 		=> $unitkerja,
							'jabatan' 			=> $jabatan,
							'tmpt_lahir' 		=> $tmpt_lahir,
							'tgl_lahir' 		=> $tgl_lahir,
							'cpns' 				=> $cpns,
							'alamat' 			=> $alamat,
							'nik' 				=> $nik,
							'jenis_kelamin' 	=> $kelamin,
							'tmt_jabatan' 		=> $tmt_jabatan,
							'tmt_pensiun' 		=> $tmt_pensiun,
							'gajisesuaisk' 		=> $gajisesuaisk,
							'jenispeg' 			=> $jenispeg,
							'status_pegawai'	=> '1', //active
							'status_jabatan'	=> $kontrak_jenis
						]);
						Detailpegawai::where('no', $idpegawai)->update([
							'ktp'			=> $nik, 
							'alamatmlg'		=> $alamat, 
						]);
						Suratkeluar::where('id', $idsurat)->update([
						    'kodefak'		=> $fakultas,
							'unit'			=> 'TU',
							'isisurat'		=> $isisurat,
							'jenissrt'		=> $masterjenissurat,
							'kepada' 		=> $getpegawai->nama_lengkap,
							'alamat' 		=> $getpegawai->email,
							'perihal' 		=> $kontrak_jenis,
							'sifat'			=> '4',
							'klasifikasi'	=> 'Biasa',
							'faskode'		=> 'TU.00.1',
							'uraian1' 		=> $uraiantugas,
							'uraian2' 		=> $uraiantugas2,
							'uraian3' 		=> $uraiantugas3,
							'pembuat'		=> Session('email'),
							'kelompok'		=> Session('jabatan')
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $textinput.' Sukses di Proses']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pegawai Tidak ditemukan']);
				return back();
			}
		}
		if ($masterjenissurat == 'Penerimaan Staf'){
			$textinput 					= 'Input Data '.$masterjenissurat;
			$textupdate 				= 'Update Data '.$masterjenissurat;
			$nama_lengkap 				= $request->input('kepdir_nama') != null ? $request->input('kepdir_nama') : '';
			$nip 						= $request->input('kepdir_nip') != null ? $request->input('kepdir_nip') : '';
			$email 						= $request->input('kepdir_email') != null ? $request->input('kepdir_email') : '';
			$ppabp 						= $request->input('kepdir_ppabp') != null ? $request->input('kepdir_ppabp') : Session('fakpanjang');
			$tmpt_lahir 				= $request->input('kepdir_tmpt_lahir') != null ? $request->input('kepdir_tmpt_lahir') : '-';
			$tgl_lahir 					= $request->input('kepdir_tgl_lahir') != null ? $request->input('kepdir_tgl_lahir') : date('Y-m-d');
			$kelamin 					= $request->input('kepdir_kelamin') != null ? $request->input('kepdir_kelamin') : 'Laki-laki';
			$nik 						= $request->input('kepdir_nik') != null ? $request->input('kepdir_nik') : '0';
			$kepdir_nomor 				= $request->input('kepdir_nomor') != null ? $request->input('kepdir_nomor') : '';
			$tmt_golongan 				= $request->input('kepdir_tmt_golongan') != null ? $request->input('kepdir_tmt_golongan') : '';
			$tmt_fungsional 			= $request->input('kepdir_tmt_fungsional') != null ? $request->input('kepdir_tmt_fungsional') : '';
			$kepdir_pemeriksa 			= $request->input('kepdir_pemeriksa') != null ? $request->input('kepdir_pemeriksa') : 'SELF';
			$kepdir_penandatangan		= $request->input('kepdir_penandatangan') != null ? $request->input('kepdir_penandatangan') : '';
			$keputusandirektur_jenis	= $request->input('keputusandirektur_jenis') != null ? $request->input('keputusandirektur_jenis') : '';
			$keputusandirektur_id		= $request->input('keputusandirektur_id') != null ? $request->input('keputusandirektur_id') : '';
			$idpeg 						= $request->input('keputusandirektur_idpeg') != null ? $request->input('keputusandirektur_idpeg') : '0';
			$kepdir_jenispeg			= $request->input('kepdir_jenispeg') != null ? $request->input('kepdir_jenispeg') : 'NON NAKES';
			$kepdir_jabatan 			= $request->input('kepdir_jabatan') != null ? $request->input('kepdir_jabatan') : '';
			$kepdir_pend_akhir 			= $request->input('kepdir_pend_akhir') != null ? $request->input('kepdir_pend_akhir') : '';
			$kepdir_bidang_ilmu 		= $request->input('kepdir_bidang_ilmu') != null ? $request->input('kepdir_bidang_ilmu') : '';
			$kepdir_unitkerja 			= $request->input('kepdir_unitkerja') != null ? $request->input('kepdir_unitkerja') : Session('fakpanjang');
			$kepdir_uraiantugas 		= $request->input('kepdir_uraiantugas') != null ? $request->input('kepdir_uraiantugas') : '';
			$kepdir_uraiantugas2 		= $request->input('kepdir_uraiantugas2') != null ? $request->input('kepdir_uraiantugas2') : '';
			$kepdir_uraiantugas3 		= $request->input('kepdir_uraiantugas3') != null ? $request->input('kepdir_uraiantugas3') : '';
			if ($keputusandirektur_id == Session('email')){ $keputusandirektur_id = 'new'; }
			if ($idpeg == ''){ $idpeg = '0'; }
			if ($kepdir_nomor == '0' OR $kepdir_nomor == ''){
				$kepdir_nomor 			= 1;
				$nomorsklast 			= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
				if (isset($nomorsklast->id)){
					$kepdir_nomor		= $nomorsklast->nomor;
					$kepdir_nomor++;
				}
			}
			$kode 			= 'PS';
			$gettahun 		= explode('-', $tmt_golongan);
			if (isset($gettahun[2])){
				$tahun 		= $gettahun[0];
			} else { $tahun = date('Y'); }
			
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpegawai->id)){
				$marking 		= $kode.'-'.$tahun.'-'.$getpegawai->id;
			} else {
				$ceksudah 		= Simpegpegawai::where('email', $email)->first();
				if (isset($ceksudah->id) AND $email != ''){
					$getpegawai 	= Simpegpegawai::where('email', $email)->first();
					$marking 		= $kode.'-'.$tahun.'-'.$ceksudah->id;
				} else {
					$ceksudahnik 	= Simpegpegawai::where('nik', $nik)->first();
					if (isset($ceksudahnik->id) AND $nik != ''){
						$getpegawai	= Simpegpegawai::where('nik', $nik)->first();
						$marking 	= $kode.'-'.$tahun.'-'.$ceksudahnik->id;
					} else {
						$ceknipsudah= Simpegpegawai::where('nip_baru', $nip)->first();
						if (isset($ceknipsudah->id) AND $nip != ''){
							$getpegawai	= Simpegpegawai::where('nip_baru', $nip_baru)->first();
							$marking	= $kode.'-'.$tahun.'-'.$ceknipsudah->id;
						} else {
							if ($keputusandirektur_id == 'new'){
								if ($nip != '' AND $email != '' AND $nik != ''){
									$idpeg 	= Simpegpegawai::insertGetId([
										'idpeg'						=> 0,
										'jenispeg'					=> $kepdir_jenispeg, 
										'fungsional'				=> '', 
										'nik'						=> $nik, 
										'nokk'						=> '', 
										'nama_lengkap'				=> $nama_lengkap, 
										'nama'						=> $nama_lengkap, 
										'nip_lama'					=> '', 
										'nip_baru'					=> $nip,
										'nidn'						=> '', 
										'jenis_kelamin'				=> $kelamin,
										'tmpt_lahir'				=> $tmpt_lahir, 
										'tgl_lahir'					=> $tgl_lahir, 
										'usia'						=> '', 
										'pangkat'					=> '', 
										'golongan'					=> '', 
										'namabank'					=> '', 
										'norek'						=> '', 
										'namapdrekening'			=> $nama_lengkap, 
										'gajisesuaisk'				=> '', 
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
										'keterangan'				=> 'Inputor '.Session('nama').' pada '.date('Y-m-d H:i:s'), 
										'tmt_golongan'				=> $tmt_golongan, 
										'jab_fungsional'			=> '', 
										'tmt_fungsional'			=> $tmt_fungsional,
										'tmt_pensiun'				=> '', 
										'thn_pensiun'				=> '', 
										'tmt_cpns'					=> '', 
										'tmt_pns'					=> '', 
										'thn_masuk'					=> '', 
										'unit_kerja'				=> $kepdir_unitkerja, 
										'bidang_ilmu'				=> $kepdir_bidang_ilmu,
										'lab'						=> '', 
										'program_studi'				=> '', 
										'sertifikasi'				=> '', 
										'pend_akhir'				=> $kepdir_pend_akhir,
										'ijasah_diakui'				=> '', 
										'status_pegawai'			=> '1',
										'masa_kerja'				=> '',
										'pns'						=> '', 
										'status_jabatan'			=> $masterjenissurat,
										'karpeg'					=> '', 
										'agama'						=> '', 
										'alamat'					=> '', 
										'no_hp'						=> 0,
										'kode'						=> '', 
										'foto'						=> '', 
										'tmtgaji'					=> '', 
										'tmtpangkat'				=> '', 
										'ppabp'						=> $ppabp, 
										'jabatan'					=> $kepdir_jabatan, 
										'proses_pangkat'			=> '', 
										'angka_kredit'				=> '', 
										'email_ub'					=> $email,
										'email'						=> $email, 
										'lama_tubel'				=> '', 
										'lama_kenaikan_pangkat'		=> '', 
										'tmt_tubel'					=> ''
									]);
									$marking= $kode.'-'.$tahun.'-'.$idpeg;
								} else {
									$nama_lengkap	= '';
								}
							} else {
								$cekneh 		= Tabelskdanperaturan::where('id', $keputusandirektur_id)->first();
								if (isset($cekneh->id)){
									$marking 	= $cekneh->marking;
									$arrmarking	= explode('-', $marking);
									if (isset($arrmarking[2])){
										$idpeg					= $arrmarking[2];
										$getpegawai 			= Simpegpegawai::where('id', $idpeg)->first();
										if (isset($getpegawai->id)){
											$cekneh 			= Tabelskdanperaturan::where('marking', $marking)->first();
											if (isset($cekneh->id)){
												$kepdir_nomor 	= $cekneh->nomor;
											}
										} else {
											$nama_lengkap		= '';
										}
									} else {
										$nama_lengkap			= '';
									}
								} else {
									$nama_lengkap				= '';
								}
							}
						}
					}
				}
			}
			if ($email == '' OR $nip == '' OR $nama_lengkap == '' OR $kepdir_nomor == '' OR $kepdir_penandatangan == '' OR $tmt_golongan == '' OR $tmt_fungsional == ''){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) ']);
				return back();
			} else {
				if ($marking != ''){
					$getbymarking = Tabelskdanperaturan::where('marking', $marking)->first();
					if (isset($getbymarking->id)){
						$keputusandirektur_id	= $getbymarking->id;
						$kepdir_nomor			= $getbymarking->nomor;
					}
				}
				if ($keputusandirektur_id == 'new'){
					$ceknomor 		= Tabelskdanperaturan::where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
					$textinput 		= 'Input Data '.$masterjenissurat;
				} else {
					$ceknomor 		= Tabelskdanperaturan::where('id', '!=', $keputusandirektur_id)->where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
					$textinput 		= 'Update Data '.$masterjenissurat;
				}
				if ($ceknomor == 0){
					$isisurat		= $nama_lengkap.'[psh]'.$ppabp.'[psh]'.$tmpt_lahir.'[psh]'.$tgl_lahir.'[psh]'.$kelamin.'[psh]'.$nik.'[psh]'.$kepdir_nomor.'[psh]'.$tmt_golongan.'[psh]'.$tmt_fungsional.'[psh]'.$kepdir_pemeriksa.'[psh]'.$kepdir_penandatangan.'[psh]'.$keputusandirektur_jenis.'[psh]'.$kepdir_jenispeg.'[psh]'.$kepdir_jabatan.'[psh]'.$kepdir_pend_akhir.'[psh]'.$kepdir_bidang_ilmu.'[psh]'.$kepdir_unitkerja.'[psh]'.$kepdir_uraiantugas;
					$getpejabat 	= Pejabatsurat::where('pejabat', $kepdir_penandatangan)->first();
					if (isset($getpejabat->id)){
						$idpejabat	= $getpejabat->id;
						$nmpejabat	= $getpejabat->nama;
						$nippejabat	= $getpejabat->nip;
					} else {
						$nmpejabat	= '';
						$nippejabat	= '';
						$idpejabat	= 0;
					}
					if ($keputusandirektur_id == 'new'){
						$input = Tabelskdanperaturan::create([
							'kelompok'			=> 	$masterjenissurat,
							'marking'			=> 	$marking,
							'nomor' 			=>  $kepdir_nomor,
							'tahun' 			=>  $tahun,
							'tanggal' 			=>  $tmt_golongan,
							'penandatangan' 	=>  $kepdir_penandatangan,
							'nmpejabat' 		=>  $nmpejabat,
							'nippejabat' 		=>  $nippejabat,
							'idpejabat' 		=>  $idpejabat,
							'pjbtperundang' 	=>  '',
							'idpjbperundang' 	=>  '',
							'nmpjbtperundang' 	=>  '',
							'nippjbperundang' 	=>  '',
							'tglpjbperundang' 	=>  $tmt_fungsional,
							'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
							'scansurat' 		=>  $isisurat,
							'uraian1' 			=>  $kepdir_uraiantugas,
							'uraian2' 			=>  $kepdir_uraiantugas2,
							'uraian3' 			=>  $kepdir_uraiantugas3,
							'kodefas' 			=>  'HK.04.03',
							'kodesub' 			=>  'TD.06.01',
							'paraf1' 			=>  $kepdir_pemeriksa,
							'paraf2' 			=>  0,
							'paraf3' 			=>  0,
							'paraf4' 			=>  0,
							'sparaf4' 			=>  $getpegawai->email,
							'namaparaf4' 		=>  $getpegawai->nama_lengkap,
							'tandatangan'		=> 	'Auto',
							'arsip'				=> 	'',
							'catatan'			=> 	'',
							'fakultas' 			=>  Session('fakultas'),
							'inputor' 			=>  Session('email'),
							'updated_at'		=>	date("Y-m-d H:i:s")
						]);
						$keputusandirektur_id = $input->id;
					} else {
						$input = Tabelskdanperaturan::where('id', $keputusandirektur_id)->update([
							'kelompok'			=> 	$masterjenissurat,
							'marking'			=> 	$marking,
							'nomor' 			=>  $kepdir_nomor,
							'tahun' 			=>  $tahun,
							'tanggal' 			=>  $tmt_fungsional,
							'penandatangan' 	=>  $kepdir_penandatangan,
							'nmpejabat' 		=>  $nmpejabat,
							'nippejabat' 		=>  $nippejabat,
							'idpejabat' 		=>  $idpejabat,
							'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
							'scansurat' 		=>  $isisurat,
							'uraian1' 			=>  $kepdir_uraiantugas,
							'uraian2' 			=>  $kepdir_uraiantugas2,
							'uraian3' 			=>  $kepdir_uraiantugas3,
							'paraf1' 			=>  $kepdir_pemeriksa,
							'sparaf4' 			=>  $email,
							'namaparaf4' 		=>  $nama_lengkap,
							'tandatangan'		=> 	'Auto',
							'updated_at'		=> 	date('Y-m-d H:i:s')
						]);
					}
					if ($input){
						$input 		= Detailidentitas::create([
							'no'		=> $getpegawai->id,
							'aktif'		=> $tmt_fungsional,
							'jenisid'	=> $masterjenissurat,
							'nomer'		=> $kepdir_nomor.' Tahun '.$tahun,
							'bukti'		=> '/viewsurat/SKPP-'.$keputusandirektur_id,
							'timestamp'	=> date("Y-m-d H:i:s")
						]);
						Simpegpegawai::where('id', $getpegawai->id)->update([
							'pend_akhir' 		=> $kepdir_pend_akhir,
							'bidang_ilmu' 		=> $kepdir_bidang_ilmu,
							'jabatan' 			=> $kepdir_jabatan,
							'jenispeg' 			=> $kepdir_jenispeg,
							'ppabp' 			=> $ppabp,
							'tmpt_lahir' 		=> $tmpt_lahir,
							'tgl_lahir' 		=> $tgl_lahir,
							'jenis_kelamin' 	=> $kelamin,
							'tmt_golongan' 		=> $tmt_golongan,
							'tmt_fungsional' 	=> $tmt_fungsional,
							'tmt_jabatan' 		=> $tmt_golongan,
							'tmt_pensiun' 		=> $tmt_golongan,
							'thn_pensiun' 		=> $tahun,
							'unit_kerja'		=> 'Belum di Tentukan',
							'status_jabatan'	=> $masterjenissurat,
							'status_pegawai'	=> '1', //active
						]);
						Detailpegawai::where('no', $getpegawai->id)->update([
							'ktp'			=> $nik, 
						]);
						$rsurat  	= Filess::where('size', $getpegawai->id)->where('description', '!=', '')->get();
						if (!empty($rsurat)){
							foreach ($rsurat as $rows){
								$name = $rows->name;
								if ($rows->description == 'REKRUTMEN') { $name = ''; }
								if ($name == 'Scan Ijazah terakhir' AND File::exists(public_path() .$rows->description)){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										Detailpendidikan::create([
											'no'		=> $getpegawai->id,
											'jenjang'	=> '',
											'sekolah'	=> 'Scan Ijazah terakhir',
											'negara'	=> '',
											'minat'		=> '',
											'tahunmsk'	=> '',
											'status'	=> '',
											'tmtlulus'	=> '',
											'noijasah'	=> '',
											'tglijasah'	=> '',
											'keterangan'=> '',
											'bukti'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'	=> date("Y-m-d H:i:s")
										]);
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
								if ($name == 'Scan Curriculum Vitae (Daftar Riwayat Hidup)' AND File::exists(public_path() .$rows->description)){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										Detailpendidikan::create([
											'no'		=> $getpegawai->id,
											'jenjang'	=> '',
											'sekolah'	=> 'Scan Curriculum Vitae (Daftar Riwayat Hidup)',
											'negara'	=> '',
											'minat'		=> '',
											'tahunmsk'	=> '',
											'status'	=> '',
											'tmtlulus'	=> '',
											'noijasah'	=> '',
											'tglijasah'	=> '',
											'keterangan'=> '',
											'bukti'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'	=> date("Y-m-d H:i:s")
										]);
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
								if ($name == 'Scan Surat Lamaran Kerja' AND File::exists(public_path() .$rows->description)){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										$input 		= Detailidentitas::create([
											'no'		=> $getpegawai->id,
											'aktif'		=> '',
											'jenisid'	=> 'Scan Surat Lamaran Kerja',
											'nomer'		=> '',
											'bukti'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'	=> date("Y-m-d H:i:s")
										]);
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
								if ($name == 'Scan / Foto KTP' AND File::exists(public_path() .$rows->description)){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										$input 		= Detailidentitas::create([
											'no'		=> $getpegawai->id,
											'aktif'		=> '',
											'jenisid'	=> 'KTP',
											'nomer'		=> '',
											'bukti'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'	=> date("Y-m-d H:i:s")
										]);
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
								if ($name == 'Pas Foto Berwarna (Ukuran Bebas)' AND File::exists(public_path() .$rows->description)){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										$input 		= Detailidentitas::create([
											'no'		=> $getpegawai->id,
											'aktif'		=> '',
											'jenisid'	=> 'FOTO',
											'nomer'		=> '',
											'bukti'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'	=> date("Y-m-d H:i:s")
										]);
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
								if ($name == 'Scan STR' AND File::exists(public_path() .$rows->description)){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										$input 		= Detailidentitas::create([
											'no'		=> $getpegawai->id,
											'aktif'		=> '',
											'jenisid'	=> 'STR',
											'nomer'		=> '',
											'bukti'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'	=> date("Y-m-d H:i:s")
										]);
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
								if ($name == 'Scan Sertifikat Ukom' OR $name == 'Scan Naskah Sumpah' OR $name  == 'Scan Sertifikat Pendukung Lainnya'){
									try {
										File::move(public_path().$rows->description, public_path().'images/'.$getpegawai->id.'/'.$rows->description);
										$input 		= Detailsertifikat::create([
											'no'			=> $getpegawai->id,
											'jenis'			=> 'Sertifikat',
											'tahun'			=> '',
											'nama'			=> $name,
											'pemberi'		=> '',
											'negara'		=> '',
											'nmfile'		=> 'images/'.$getpegawai->id.'/'.$rows->description,
											'timestamp'		=> date("Y-m-d H:i:s")
										]);		
									} catch (\Exception $e) {
									}
									if (File::exists(public_path() .'images/'.$getpegawai->id.'/'.$rows->name)) {
										Filess::where('size', $rows->id)->where('name', $rows->name)->delete();
									}
								}
							}
						}
						$cekfakultas = User::where('fakpanjang', $ppabp)->first();
						if (isset($cekfakultas->fakultas)){
							User::where('email', $getpegawai->email_ub)->update([
								'fakultas'		=> $cekfakultas->fakultas,
								'fakpanjang'	=> $cekfakultas->fakpanjang
							]);
						}
						
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $textinput.' Sukses di Proses']);
						return back();
					} else {
						$keterangan = ', Unkown Error';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				} else {
					$keterangan = 'Nomor Terdeteksi Kembar, Cek Kembali Nomor Anda di Master Penomoran Surat Keputusan Direktur';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			}
		}
		if ($masterjenissurat == 'Mutasi'){
			$textinput 					= 'Input Data '.$masterjenissurat;
			$textupdate 				= 'Update Data '.$masterjenissurat;
			$nama_lengkap 				= $request->input('kepdirmutasi_nama') != null ? $request->input('kepdirmutasi_nama') : '';
			$jabatan 					= $request->input('kepdirmutasi_jabatan') != null ? $request->input('kepdirmutasi_jabatan') : '';
			$ppabp 						= $request->input('kepdirmutasi_ppabp') != null ? $request->input('kepdirmutasi_ppabp') : Session('fakpanjang');
			$ppabptujuan 				= $request->input('kepdirmutasi_ppabptujuan') != null ? $request->input('kepdirmutasi_ppabptujuan') : $ppabp;
			$kepdir_nomor 				= $request->input('kepdirmutasi_nomor') != null ? $request->input('kepdirmutasi_nomor') : '';
			$tmt 						= $request->input('kepdirmutasi_tmt') != null ? $request->input('kepdirmutasi_tmt') : '';
			$tanggal 					= $request->input('kepdirmutasi_tanggal') != null ? $request->input('kepdirmutasi_tanggal') : '';
			$kepdir_pemeriksa 			= $request->input('kepdirmutasi_pemeriksa') != null ? $request->input('kepdirmutasi_pemeriksa') : 'SELF';
			$kepdir_penandatangan		= $request->input('kepdirmutasi_penandatangan') != null ? $request->input('kepdirmutasi_penandatangan') : '';
			$keputusandirektur_jenis	= $request->input('keputusandirektur_jenis') != null ? $request->input('keputusandirektur_jenis') : '';
			$keputusandirektur_id		= $request->input('keputusandirektur_id') != null ? $request->input('keputusandirektur_id') : '';
			$idpeg 						= $request->input('keputusandirektur_idpeg') != null ? $request->input('keputusandirektur_idpeg') : '0';
			if ($kepdir_nomor == '0' OR $kepdir_nomor == ''){
				$kepdir_nomor 			= 1;
				$nomorsklast 			= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
				if (isset($nomorsklast->id)){
					$kepdir_nomor		= $nomorsklast->nomor;
					$kepdir_nomor++;
				}
			}
			$isisurat					= $nama_lengkap.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$ppabptujuan.'[psh]'.$kepdir_nomor.'[psh]'.$tmt.'[psh]'.$tanggal.'[psh]'.$idpeg.'[psh]'.$keputusandirektur_jenis;
			$getpegawai 				= Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpegawai->id)){
				if ($nama_lengkap == '' OR $kepdir_nomor == '' OR $kepdir_penandatangan == '' OR $tmt == '' OR $tanggal == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) ']);
					return back();
				} else {
					$kode 			= 'MTS';
					$gettahun 		= explode('-', $tmt);
					if (isset($gettahun[2])){
						$tahun 		= $gettahun[0];
					} else { $tahun = date('Y'); }
					$marking 		= $kode.'-'.$tahun.'-'.$getpegawai->id;
					$cekneh 		= Tabelskdanperaturan::where('marking', $marking)->first();
					if (isset($cekneh->id)){
						$keputusandirektur_id 	= $cekneh->id;
						if ($cekneh->tanggal == $tmt){
							$kepdir_nomor 		= $cekneh->nomor;
						} else {
							$marking 			= $kode.'-'.$tahun.'-'.$cekneh->id.'-'.$getpegawai->id;
						}
					}
					if ($keputusandirektur_id == 'new'){
						$ceknomor 		= Tabelskdanperaturan::where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Input Data '.$masterjenissurat;
					} else {
						$ceknomor 		= Tabelskdanperaturan::where('id', '!=', $keputusandirektur_id)->where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Update Data '.$masterjenissurat;
					}
					if ($ceknomor == 0){
						$getpejabat 	= Pejabatsurat::where('pejabat', $kepdir_penandatangan)->first();
						if (isset($getpejabat->id)){
							$idpejabat	= $getpejabat->id;
							$nmpejabat	= $getpejabat->nama;
							$nippejabat	= $getpejabat->nip;
						} else {
							$nmpejabat	= '';
							$nippejabat	= '';
							$idpejabat	= 0;
						}
						if ($keputusandirektur_id == 'new'){
							$input = Tabelskdanperaturan::create([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'pjbtperundang' 	=>  $jabatan,
								'idpjbperundang' 	=>  '',
								'nmpjbtperundang' 	=>  '',
								'nippjbperundang' 	=>  '',
								'tglpjbperundang' 	=>  $tanggal,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'scansurat' 		=>  $isisurat,
								'kodefas' 			=>  'HK.04.03',
								'kodesub' 			=>  'TD.06.01',
								'paraf1' 			=>  $kepdir_pemeriksa,
								'paraf2' 			=>  0,
								'paraf3' 			=>  0,
								'paraf4' 			=>  0,
								'sparaf4' 			=>  $getpegawai->email_ub,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'arsip'				=> 	'',
								'catatan'			=> 	'',
								'fakultas' 			=>  Session('fakultas'),
								'inputor' 			=>  Session('email'),
								'updated_at'		=>	date("Y-m-d H:i:s")
							]);
							$keputusandirektur_id = $input->id;
						} else {
							$input = Tabelskdanperaturan::where('id', $keputusandirektur_id)->update([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'pjbtperundang' 	=>  $jabatan,
								'scansurat' 		=>  $isisurat,
								'paraf1' 			=>  $kepdir_pemeriksa,
								'sparaf4' 			=>  $getpegawai->email_ub,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'updated_at'		=> 	date('Y-m-d H:i:s')
							]);
						}
						if ($input){
							if ($kepdir_pemeriksa != ''){
								$kirimke 	= $kepdir_pemeriksa;
								$paraf1		= 'SELF';
								$jenis 		= 'PARAF';
							} else {
								$kirimke 	= $kepdir_penandatangan;
								$paraf1		= $kepdir_pemeriksa;
								$jenis 		= 'Mohon TTD';
							}
							$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
							if (isset($getpejabat->id)){
								SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'SKDANPERATURAN','1');
								$pesan = 'Data Sudah Terkirim Ke '.$kirimke;
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
								return back();
							} else {
								$gagal = 'Data Pejabat : '.$kirimke.' Tidak di Valid';
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
								return back();
							}
						} else {
							$keterangan = ', Unkown Error';
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
							return back();
						}
					} else {
						$keterangan = 'Nomor Terdeteksi Kembar, Cek Kembali Nomor Anda di Master Penomoran Surat Keputusan Direktur';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pegawai dengan ID '.$idpeg.' Tidak ditemukan, Mohon Untuk NIK tidak diubah. Anda bisa mengubahnya setelah di tempatkan ke Unit yang dituju']);
				return back();
			}
		}
		if ($masterjenissurat == 'Pengangkatan Jabatan'){
			$textinput 					= 'Input Data '.$masterjenissurat;
			$textupdate 				= 'Update Data '.$masterjenissurat;
			$nama_lengkap 				= $request->input('kepdirangkat_nama') != null ? $request->input('kepdirangkat_nama') : '';
			$jabatan 					= $request->input('kepdirangkat_jabatan') != null ? $request->input('kepdirangkat_jabatan') : '';
			$ppabp 						= $request->input('kepdirangkat_ppabp') != null ? $request->input('kepdirangkat_ppabp') : Session('fakpanjang');
			$sifat 						= $request->input('kepdirangkat_sifat') != null ? $request->input('kepdirangkat_sifat') : 'Normal';
			$kepdir_nomor 				= $request->input('kepdirangkat_nomor') != null ? $request->input('kepdirangkat_nomor') : '';
			$tmt 						= $request->input('kepdirangkat_tmt') != null ? $request->input('kepdirangkat_tmt') : '';
			$mulai 						= $request->input('kepdirangkat_mulai') != null ? $request->input('kepdirangkat_mulai') : '';
			$akhir 						= $request->input('kepdirangkat_akhir') != null ? $request->input('kepdirangkat_akhir') : '';
			$tanggal 					= $request->input('kepdirangkat_tanggal') != null ? $request->input('kepdirangkat_tanggal') : '';
			$uraiantugas				= $request->input('kepdirangkat_uraiantugas') != null ? $request->input('kepdirangkat_uraiantugas') : '-';
			$kepdir_pemeriksa 			= $request->input('kepdirangkat_pemeriksa') != null ? $request->input('kepdirangkat_pemeriksa') : 'SELF';
			$kepdir_penandatangan		= $request->input('kepdirangkat_penandatangan') != null ? $request->input('kepdirangkat_penandatangan') : '';
			$keputusandirektur_jenis	= $request->input('keputusandirektur_jenis') != null ? $request->input('keputusandirektur_jenis') : '';
			$keputusandirektur_id		= $request->input('keputusandirektur_id') != null ? $request->input('keputusandirektur_id') : '';
			$idpeg 						= $request->input('keputusandirektur_idpeg') != null ? $request->input('keputusandirektur_idpeg') : '0';
			if ($kepdir_nomor == '0' OR $kepdir_nomor == ''){
				$kepdir_nomor 			= 1;
				$nomorsklast 			= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
				if (isset($nomorsklast->id)){
					$kepdir_nomor		= $nomorsklast->nomor;
					$kepdir_nomor++;
				}
			}
			$isisurat					= $nama_lengkap.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$sifat.'[psh]'.$kepdir_nomor.'[psh]'.$tmt.'[psh]'.$mulai.'[psh]'.$akhir.'[psh]'.$tanggal.'[psh]'.$idpeg.'[psh]'.$keputusandirektur_jenis.'[psh]'.$uraiantugas;
			$getpegawai 				= Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpegawai->id)){
				if ($nama_lengkap == '' OR $kepdir_nomor == '' OR $kepdir_penandatangan == '' OR $tmt == '' OR $tanggal == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) ']);
					return back();
				} else {
					$kode 			= 'PJ';
					$gettahun 		= explode('-', $tmt);
					if (isset($gettahun[2])){
						$tahun 		= $gettahun[0];
					} else { $tahun = date('Y'); }
					$marking 		= $kode.'-'.$tahun.'-'.$getpegawai->id;
					$cekneh 		= Tabelskdanperaturan::where('marking', $marking)->first();
					if (isset($cekneh->id)){
						$keputusandirektur_id 	= $cekneh->id;
						if ($cekneh->tanggal == $tmt){
							$kepdir_nomor 		= $cekneh->nomor;
						} else {
							$marking 			= $kode.'-'.$tahun.'-'.$cekneh->id.'-'.$getpegawai->id;
						}
					}
					if ($keputusandirektur_id == 'new'){
						$ceknomor 		= Tabelskdanperaturan::where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Input Data '.$masterjenissurat;
					} else {
						$ceknomor 		= Tabelskdanperaturan::where('id', '!=', $keputusandirektur_id)->where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Update Data '.$masterjenissurat;
					}
					if ($ceknomor == 0){
						$getpejabat 	= Pejabatsurat::where('pejabat', $kepdir_penandatangan)->first();
						if (isset($getpejabat->id)){
							$idpejabat	= $getpejabat->id;
							$nmpejabat	= $getpejabat->nama;
							$nippejabat	= $getpejabat->nip;
						} else {
							$nmpejabat	= '';
							$nippejabat	= '';
							$idpejabat	= 0;
						}
						if ($keputusandirektur_id == 'new'){
							$input = Tabelskdanperaturan::create([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'pjbtperundang' 	=>  $jabatan,
								'idpjbperundang' 	=>  '',
								'nmpjbtperundang' 	=>  '',
								'nippjbperundang' 	=>  '',
								'tglpjbperundang' 	=>  $tanggal,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'scansurat' 		=>  $isisurat,
								'kodefas' 			=>  'HK.04.03',
								'kodesub' 			=>  'TD.06.01',
								'paraf1' 			=>  $kepdir_pemeriksa,
								'paraf2' 			=>  0,
								'paraf3' 			=>  0,
								'paraf4' 			=>  0,
								'sparaf4' 			=>  $getpegawai->email_ub,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'arsip'				=> 	'',
								'catatan'			=> 	'',
								'fakultas' 			=>  Session('fakultas'),
								'inputor' 			=>  Session('email'),
								'updated_at'		=>	date("Y-m-d H:i:s")
							]);
							$keputusandirektur_id = $input->id;
						} else {
							$input = Tabelskdanperaturan::where('id', $keputusandirektur_id)->update([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'pjbtperundang' 	=>  $jabatan,
								'scansurat' 		=>  $isisurat,
								'paraf1' 			=>  $kepdir_pemeriksa,
								'sparaf4' 			=>  $getpegawai->email_ub,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'updated_at'		=> 	date('Y-m-d H:i:s')
							]);
						}
						if ($input){
							if ($kepdir_pemeriksa != ''){
								$kirimke 	= $kepdir_pemeriksa;
								$paraf1		= 'SELF';
								$jenis 		= 'PARAF';
							} else {
								$kirimke 	= $kepdir_penandatangan;
								$paraf1		= $kepdir_pemeriksa;
								$jenis 		= 'Mohon TTD';
							}
							$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
							if (isset($getpejabat->id)){
								SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'SKDANPERATURAN','1');
								$pesan = 'Data Sudah Terkirim Ke '.$kirimke;
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
								return back();
							} else {
								$gagal = 'Data Pejabat : '.$kirimke.' Tidak di Valid';
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
								return back();
							}
						} else {
							$keterangan = ', Unkown Error';
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
							return back();
						}
					} else {
						$keterangan = 'Nomor Terdeteksi Kembar, Cek Kembali Nomor Anda di Master Penomoran Surat Keputusan Direktur';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pegawai Tidak ditemukan, Mohon Untuk NIK tidak diubah. Anda bisa mengubahnya setelah di tempatkan ke Unit yang dituju']);
				return back();
			}
		}
		if ($masterjenissurat == 'Pemberhentian Jabatan'){
			$textinput 					= 'Input Data '.$masterjenissurat;
			$textupdate 				= 'Update Data '.$masterjenissurat;
			$nama_lengkap 				= $request->input('kepdirpemberhentian_nama') != null ? $request->input('kepdirpemberhentian_nama') : '';
			$jabatan 					= $request->input('kepdirpemberhentian_jabatan') != null ? $request->input('kepdirpemberhentian_jabatan') : '';
			$ppabp 						= $request->input('kepdirpemberhentian_ppabp') != null ? $request->input('kepdirpemberhentian_ppabp') : Session('fakpanjang');
			$kepdir_nomor 				= $request->input('kepdirpemberhentian_nomor') != null ? $request->input('kepdirpemberhentian_nomor') : '';
			$tmt 						= $request->input('kepdirpemberhentian_tmt') != null ? $request->input('kepdirpemberhentian_tmt') : '';
			$tanggal 					= $request->input('kepdirpemberhentian_tanggal') != null ? $request->input('kepdirpemberhentian_tanggal') : '';
			$kepdir_pemeriksa 			= $request->input('kepdirpemberhentian_pemeriksa') != null ? $request->input('kepdirpemberhentian_pemeriksa') : 'SELF';
			$kepdir_penandatangan		= $request->input('kepdirpemberhentian_penandatangan') != null ? $request->input('kepdirpemberhentian_penandatangan') : '';
			$keputusandirektur_jenis	= $request->input('keputusandirektur_jenis') != null ? $request->input('keputusandirektur_jenis') : '';
			$keputusandirektur_id		= $request->input('keputusandirektur_id') != null ? $request->input('keputusandirektur_id') : '';
			$idpeg 						= $request->input('keputusandirektur_idpeg') != null ? $request->input('keputusandirektur_idpeg') : '0';
			if ($kepdir_nomor == '0' OR $kepdir_nomor == ''){
				$kepdir_nomor 			= 1;
				$nomorsklast 			= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
				if (isset($nomorsklast->id)){
					$kepdir_nomor		= $nomorsklast->nomor;
					$kepdir_nomor++;
				}
			}
			$isisurat					= $nama_lengkap.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$kepdir_nomor.'[psh]'.$tmt.'[psh]'.$tanggal.'[psh]'.$idpeg.'[psh]'.$keputusandirektur_jenis;
			$getpegawai 				= Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpegawai->id)){
				if ($nama_lengkap == '' OR $kepdir_nomor == '' OR $kepdir_penandatangan == '' OR $tmt == '' OR $tanggal == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) ']);
					return back();
				} else {
					$kode 			= 'PembJ';
					$gettahun 		= explode('-', $tmt);
					if (isset($gettahun[2])){
						$tahun 		= $gettahun[0];
					} else { $tahun = date('Y'); }
					$marking 		= $kode.'-'.$tahun.'-'.$getpegawai->id;
					$cekneh 		= Tabelskdanperaturan::where('marking', $marking)->first();
					if (isset($cekneh->id)){
						$keputusandirektur_id 	= $cekneh->id;
						if ($cekneh->tanggal == $tmt){
							$kepdir_nomor 		= $cekneh->nomor;
						} else {
							$marking 			= $kode.'-'.$tahun.'-'.$cekneh->id.'-'.$getpegawai->id;
						}
					}
					if ($keputusandirektur_id == 'new'){
						$ceknomor 		= Tabelskdanperaturan::where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Input Data '.$masterjenissurat;
					} else {
						$ceknomor 		= Tabelskdanperaturan::where('id', '!=', $keputusandirektur_id)->where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Update Data '.$masterjenissurat;
					}
					if ($ceknomor == 0){
						$getpejabat 	= Pejabatsurat::where('pejabat', $kepdir_penandatangan)->first();
						if (isset($getpejabat->id)){
							$idpejabat	= $getpejabat->id;
							$nmpejabat	= $getpejabat->nama;
							$nippejabat	= $getpejabat->nip;
						} else {
							$nmpejabat	= '';
							$nippejabat	= '';
							$idpejabat	= 0;
						}
						if ($keputusandirektur_id == 'new'){
							$input = Tabelskdanperaturan::create([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'pjbtperundang' 	=>  $jabatan,
								'idpjbperundang' 	=>  '',
								'nmpjbtperundang' 	=>  '',
								'nippjbperundang' 	=>  '',
								'tglpjbperundang' 	=>  $tanggal,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'scansurat' 		=>  $isisurat,
								'kodefas' 			=>  'HK.04.03',
								'kodesub' 			=>  'TD.06.01',
								'paraf1' 			=>  $kepdir_pemeriksa,
								'paraf2' 			=>  0,
								'paraf3' 			=>  0,
								'paraf4' 			=>  0,
								'sparaf4' 			=>  $getpegawai->email,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'arsip'				=> 	'',
								'catatan'			=> 	'',
								'fakultas' 			=>  Session('fakultas'),
								'inputor' 			=>  Session('email'),
								'updated_at'		=>	date("Y-m-d H:i:s")
							]);
							$keputusandirektur_id = $input->id;
						} else {
							$input = Tabelskdanperaturan::where('id', $keputusandirektur_id)->update([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'pjbtperundang' 	=>  $jabatan,
								'scansurat' 		=>  $isisurat,
								'paraf1' 			=>  $kepdir_pemeriksa,
								'sparaf4' 			=>  $getpegawai->email,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'updated_at'		=> 	date('Y-m-d H:i:s')
							]);
						}
						if ($input){
							if ($kepdir_pemeriksa != ''){
								$kirimke 	= $kepdir_pemeriksa;
								$paraf1		= 'SELF';
								$jenis 		= 'PARAF';
							} else {
								$kirimke 	= $kepdir_penandatangan;
								$paraf1		= $kepdir_pemeriksa;
								$jenis 		= 'Mohon TTD';
							}
							$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
							if (isset($getpejabat->id)){
								SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'SKDANPERATURAN','1');
								$pesan = 'Data Sudah Terkirim Ke '.$kirimke;
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
								return back();
							} else {
								$gagal = 'Data Pejabat : '.$kirimke.' Tidak di Valid';
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
								return back();
							}
						} else {
							$keterangan = ', Unkown Error';
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
							return back();
						}
					} else {
						$keterangan = 'Nomor Terdeteksi Kembar, Cek Kembali Nomor Anda di Master Penomoran Surat Keputusan Direktur';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pegawai Tidak ditemukan, Mohon Untuk NIK tidak diubah. Anda bisa mengubahnya setelah di tempatkan ke Unit yang dituju']);
				return back();
			}
		}
		if ($masterjenissurat == 'Dokter Tetap' OR $masterjenissurat == 'Pegawai Tetap'){
			$textinput 					= 'Input Data '.$masterjenissurat;
			$textupdate 				= 'Update Data '.$masterjenissurat;
			$nama_lengkap 				= $request->input('kepdirpegtetap_nama') != null ? $request->input('kepdirpegtetap_nama') : '';
			$jabatan 					= $request->input('kepdirpegtetap_jabatan') != null ? $request->input('kepdirpegtetap_jabatan') : '';
			$ppabp 						= $request->input('kepdirpegtetap_ppabp') != null ? $request->input('kepdirpegtetap_ppabp') : Session('fakpanjang');
			$status_jabatan 			= $request->input('kepdirpegtetap_status_jabatan') != null ? $request->input('kepdirpegtetap_status_jabatan') : '';
			$kepdir_nomor 				= $request->input('kepdirpegtetap_nomor') != null ? $request->input('kepdirpegtetap_nomor') : '';
			$tmt 						= $request->input('kepdirpegtetap_tmt') != null ? $request->input('kepdirpegtetap_tmt') : '';
			$tanggal 					= $request->input('kepdirpegtetap_tanggal') != null ? $request->input('kepdirpegtetap_tanggal') : '';
			$kepdir_pemeriksa 			= $request->input('kepdirpegtetap_pemeriksa') != null ? $request->input('kepdirpegtetap_pemeriksa') : 'SELF';
			$kepdir_penandatangan		= $request->input('kepdirpegtetap_penandatangan') != null ? $request->input('kepdirpegtetap_penandatangan') : '';
			$keputusandirektur_jenis	= $status_jabatan;
			$keputusandirektur_id		= $request->input('keputusandirektur_id') != null ? $request->input('keputusandirektur_id') : '';
			$idpeg 						= $request->input('keputusandirektur_idpeg') != null ? $request->input('keputusandirektur_idpeg') : '0';
			if ($kepdir_nomor == '0' OR $kepdir_nomor == ''){
				$kepdir_nomor 			= 1;
				$nomorsklast 			= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
				if (isset($nomorsklast->id)){
					$kepdir_nomor		= $nomorsklast->nomor;
					$kepdir_nomor++;
				}
			}
			$isisurat					= $nama_lengkap.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$kepdir_nomor.'[psh]'.$tmt.'[psh]'.$tanggal.'[psh]'.$status_jabatan.'[psh]'.$idpeg.'[psh]'.$keputusandirektur_jenis;
			$getpegawai 				= Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpegawai->id)){
				if ($nama_lengkap == '' OR $kepdir_nomor == '' OR $kepdir_penandatangan == '' OR $tmt == '' OR $tanggal == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) ']);
					return back();
				} else {
					if ($masterjenissurat == 'Dokter Tetap'){
						$kode = 'DT';
					} else {
						$kode = 'PT';
					}
					$gettahun 		= explode('-', $tmt);
					if (isset($gettahun[2])){
						$tahun 		= $gettahun[0];
					} else { $tahun = date('Y'); }
					$marking 		= $kode.'-'.$tahun.'-'.$getpegawai->id;
					$cekneh 		= Tabelskdanperaturan::where('marking', $marking)->first();
					if (isset($cekneh->id)){
						$keputusandirektur_id 	= $cekneh->id;
						if ($cekneh->tanggal == $tmt){
							$kepdir_nomor 		= $cekneh->nomor;
						} else {
							$marking 			= $kode.'-'.$tahun.'-'.$cekneh->id.'-'.$getpegawai->id;
						}
					}
					if ($keputusandirektur_id == 'new'){
						$ceknomor 		= Tabelskdanperaturan::where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Input Data '.$masterjenissurat;
					} else {
						$ceknomor 		= Tabelskdanperaturan::where('id', '!=', $keputusandirektur_id)->where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Update Data '.$masterjenissurat;
					}
					if ($ceknomor == 0){
						$getpejabat 	= Pejabatsurat::where('pejabat', $kepdir_penandatangan)->first();
						if (isset($getpejabat->id)){
							$idpejabat	= $getpejabat->id;
							$nmpejabat	= $getpejabat->nama;
							$nippejabat	= $getpejabat->nip;
						} else {
							$nmpejabat	= '';
							$nippejabat	= '';
							$idpejabat	= 0;
						}
						if ($keputusandirektur_id == 'new'){
							$input = Tabelskdanperaturan::create([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'pjbtperundang' 	=>  $jabatan,
								'idpjbperundang' 	=>  '',
								'nmpjbtperundang' 	=>  '',
								'nippjbperundang' 	=>  '',
								'tglpjbperundang' 	=>  $tanggal,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'scansurat' 		=>  $isisurat,
								'kodefas' 			=>  'HK.04.03',
								'kodesub' 			=>  'TD.06.01',
								'paraf1' 			=>  $kepdir_pemeriksa,
								'paraf2' 			=>  0,
								'paraf3' 			=>  0,
								'paraf4' 			=>  0,
								'sparaf4' 			=>  $getpegawai->email,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'arsip'				=> 	'',
								'catatan'			=> 	'',
								'fakultas' 			=>  Session('fakultas'),
								'inputor' 			=>  Session('email'),
								'updated_at'		=>	date("Y-m-d H:i:s")
							]);
							$keputusandirektur_id = $input->id;
						} else {
							$input = Tabelskdanperaturan::where('id', $keputusandirektur_id)->update([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'pjbtperundang' 	=>  $jabatan,
								'scansurat' 		=>  $isisurat,
								'paraf1' 			=>  $kepdir_pemeriksa,
								'sparaf4' 			=>  $getpegawai->email,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'updated_at'		=> 	date('Y-m-d H:i:s')
							]);
						}
						if ($input){
							if ($kepdir_pemeriksa != ''){
								$kirimke 	= $kepdir_pemeriksa;
								$paraf1		= 'SELF';
								$jenis 		= 'PARAF';
							} else {
								$kirimke 	= $kepdir_penandatangan;
								$paraf1		= $kepdir_pemeriksa;
								$jenis 		= 'Mohon TTD';
							}
							$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
							if (isset($getpejabat->id)){
								SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'SKDANPERATURAN','1');
								$pesan = 'Data Sudah Terkirim Ke '.$kirimke;
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
								return back();
							} else {
								$gagal = 'Data Pejabat : '.$kirimke.' Tidak di Valid';
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
								return back();
							}
						} else {
							$keterangan = ', Unkown Error';
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
							return back();
						}
					} else {
						$keterangan = 'Nomor Terdeteksi Kembar, Cek Kembali Nomor Anda di Master Penomoran Surat Keputusan Direktur';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pegawai Tidak ditemukan, Mohon Untuk NIK tidak diubah. Anda bisa mengubahnya setelah di tempatkan ke Unit yang dituju']);
				return back();
			}
		}
		if ($masterjenissurat == 'Penonaktifan Staf' OR $masterjenissurat == 'Pengaktifan Staf' OR $masterjenissurat == 'Penonaktifan Dokter Tetap' OR $masterjenissurat == 'Penempatan Administrasi Pendaftaran' OR $masterjenissurat == 'Penempatan Analis Kesehatan' OR $masterjenissurat == 'Penempatan Perawat' OR $masterjenissurat == 'Penempatan Perekam Medik' OR $masterjenissurat == 'Penempatan Security'){
			$textinput 					= 'Input Data '.$masterjenissurat;
			$textupdate 				= 'Update Data '.$masterjenissurat;
			$nama_lengkap 				= $request->input('kepdiraktivasi_nama') != null ? $request->input('kepdiraktivasi_nama') : '';
			$jabatan 					= $request->input('kepdiraktivasi_jabatan') != null ? $request->input('kepdiraktivasi_jabatan') : '';
			$ppabp 						= $request->input('kepdiraktivasi_ppabp') != null ? $request->input('kepdiraktivasi_ppabp') : Session('fakpanjang');
			$status_jabatan 			= $request->input('kepdiraktivas_status_jabatan') != null ? $request->input('kepdiraktivas_status_jabatan') : '';
			$kepdir_nomor 				= $request->input('kepdiraktivasi_nomor') != null ? $request->input('kepdiraktivasi_nomor') : '';
			$tmt 						= $request->input('kepdiraktivasi_tmt') != null ? $request->input('kepdiraktivasi_tmt') : '';
			$tanggal 					= $request->input('kepdiraktivasi_tanggal') != null ? $request->input('kepdiraktivasi_tanggal') : '';
			$kepdir_pemeriksa 			= $request->input('kepdiraktivasi_pemeriksa') != null ? $request->input('kepdiraktivasi_pemeriksa') : 'SELF';
			$kepdir_penandatangan		= $request->input('kepdiraktivasi_penandatangan') != null ? $request->input('kepdiraktivasi_penandatangan') : '';
			$keputusandirektur_jenis	= $status_jabatan;
			$keputusandirektur_id		= $request->input('keputusandirektur_id') != null ? $request->input('keputusandirektur_id') : '';
			$idpeg 						= $request->input('keputusandirektur_idpeg') != null ? $request->input('keputusandirektur_idpeg') : '0';
			if ($kepdir_nomor == '0' OR $kepdir_nomor == ''){
				$kepdir_nomor 			= 1;
				$nomorsklast 			= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
				if (isset($nomorsklast->id)){
					$kepdir_nomor		= $nomorsklast->nomor;
					$kepdir_nomor++;
				}
			}
			$isisurat					= $nama_lengkap.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$kepdir_nomor.'[psh]'.$tmt.'[psh]'.$tanggal.'[psh]'.$status_jabatan.'[psh]'.$idpeg.'[psh]'.$keputusandirektur_jenis;
			$getpegawai 				= Simpegpegawai::where('id', $idpeg)->first();
			if (isset($getpegawai->id)){
				if ($nama_lengkap == '' OR $kepdir_nomor == '' OR $kepdir_penandatangan == '' OR $tmt == '' OR $tanggal == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi, Apabila tidak diketahui mohon memberi tanda strip (-) atau angka 0 (nol) '.$nama_lengkap.'/'.$kepdir_nomor.'/'.$kepdir_penandatangan.'/'.$tmt_golongan.'/'.$tmt_fungsional]);
					return back();
				} else {
					if ($masterjenissurat == 'Penonaktifan Staf'){
						$kode = 'PenonS';
					} else if ($masterjenissurat == 'Pengaktifan Staf'){
						$kode = 'PengS';
					} else {
						$kode = 'PenonD';
					}
					$gettahun 		= explode('-', $tmt);
					if (isset($gettahun[2])){
						$tahun 		= $gettahun[0];
					} else { $tahun = date('Y'); }
					$marking 		= $kode.'-'.$tahun.'-'.$getpegawai->id;
					$cekneh 		= Tabelskdanperaturan::where('marking', $marking)->first();
					if (isset($cekneh->id)){
						$keputusandirektur_id 	= $cekneh->id;
						if ($cekneh->tanggal == $tmt){
							$kepdir_nomor 		= $cekneh->nomor;
						} else {
							$marking 			= $kode.'-'.$tahun.'-'.$cekneh->id.'-'.$getpegawai->id;
						}
					}
					if ($keputusandirektur_id == 'new'){
						$ceknomor 		= Tabelskdanperaturan::where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Input Data '.$masterjenissurat;
					} else {
						$ceknomor 		= Tabelskdanperaturan::where('id', '!=', $keputusandirektur_id)->where('nomor', $kepdir_nomor)->where('tahun', $tahun)->where('fakultas', Session('fakultas'))->count();
						$textinput 		= 'Update Data '.$masterjenissurat;
					}
					if ($ceknomor == 0){
						$getpejabat 	= Pejabatsurat::where('pejabat', $kepdir_penandatangan)->first();
						if (isset($getpejabat->id)){
							$idpejabat	= $getpejabat->id;
							$nmpejabat	= $getpejabat->nama;
							$nippejabat	= $getpejabat->nip;
						} else {
							$nmpejabat	= '';
							$nippejabat	= '';
							$idpejabat	= 0;
						}
						if ($keputusandirektur_id == 'new'){
							$input = Tabelskdanperaturan::create([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'pjbtperundang' 	=>  $jabatan,
								'idpjbperundang' 	=>  '',
								'nmpjbtperundang' 	=>  '',
								'nippjbperundang' 	=>  '',
								'tglpjbperundang' 	=>  $tanggal,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'scansurat' 		=>  $isisurat,
								'kodefas' 			=>  'HK.04.03',
								'kodesub' 			=>  'TD.06.01',
								'paraf1' 			=>  $kepdir_pemeriksa,
								'paraf2' 			=>  0,
								'paraf3' 			=>  0,
								'paraf4' 			=>  0,
								'sparaf4' 			=>  $getpegawai->email,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'arsip'				=> 	'',
								'catatan'			=> 	'',
								'fakultas' 			=>  Session('fakultas'),
								'inputor' 			=>  Session('email'),
								'updated_at'		=>	date("Y-m-d H:i:s")
							]);
							$keputusandirektur_id = $input->id;
						} else {
							$input = Tabelskdanperaturan::where('id', $keputusandirektur_id)->update([
								'kelompok'			=> 	$masterjenissurat,
								'marking'			=> 	$marking,
								'nomor' 			=>  $kepdir_nomor,
								'tahun' 			=>  $tahun,
								'tanggal' 			=>  $tmt,
								'penandatangan' 	=>  $kepdir_penandatangan,
								'nmpejabat' 		=>  $nmpejabat,
								'nippejabat' 		=>  $nippejabat,
								'idpejabat' 		=>  $idpejabat,
								'judul' 			=>  $masterjenissurat.' an. '.$nama_lengkap,
								'pjbtperundang' 	=>  $jabatan,
								'scansurat' 		=>  $isisurat,
								'paraf1' 			=>  $kepdir_pemeriksa,
								'sparaf4' 			=>  $getpegawai->email,
								'namaparaf4' 		=>  $getpegawai->nama_lengkap,
								'tandatangan'		=> 	'Proses',
								'updated_at'		=> 	date('Y-m-d H:i:s')
							]);
						}
						if ($input){
							if ($kepdir_pemeriksa != ''){
								$kirimke 	= $kepdir_pemeriksa;
								$paraf1		= 'SELF';
								$jenis 		= 'PARAF';
							} else {
								$kirimke 	= $kepdir_penandatangan;
								$paraf1		= $kepdir_pemeriksa;
								$jenis 		= 'Mohon TTD';
							}
							$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
							if (isset($getpejabat->id)){
								SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'SKDANPERATURAN','1');
								$pesan = 'Data Sudah Terkirim Ke '.$kirimke;
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
								return back();
							} else {
								$gagal = 'Data Pejabat : '.$kirimke.' Tidak di Valid';
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
								return back();
							}
						} else {
							$keterangan = ', Unkown Error';
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
							return back();
						}
					} else {
						$keterangan = 'Nomor Terdeteksi Kembar, Cek Kembali Nomor Anda di Master Penomoran Surat Keputusan Direktur';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Pegawai Tidak ditemukan, Mohon Untuk NIK tidak diubah. Anda bisa mengubahnya setelah di tempatkan ke Unit yang dituju']);
				return back();
			}
		}
		if ($masterjenissurat == 'Referensi Kerja'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpeg				= $request->input('val01');
			$jabatan			= $request->input('val02');
			$ppabp				= $request->input('val03');
			$alamat				= $request->input('val04');
			$mulai				= $request->input('val05');
			$akhir				= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $idpeg.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$alamat.'[psh]'.$mulai.'[psh]'.$akhir.'[psh]'.$penandatangan;
			Simpegpegawai::where('id', $idpeg)->update([
				'jabatan'			=> $jabatan,
				'unit_kerja'		=> $ppabp,
				'alamat'			=> $alamat,
				'tmt_pensiun'		=> $akhir,
				'status_pegawai'	=> '0',
				'status_jabatan'	=> $masterjenissurat
			]);
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'RK-'.date('Y-m-d').'-'.$idpeg;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Permohonan' OR $masterjenissurat == 'Pemberitahuan Sekretaris'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$tekstujuan			= $request->input('val03');
			$idtujuan			= $request->input('val04');
			$judul				= $request->input('val02');
			$isi				= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$jabkepada			= '';
			$namakepada			= '';
			$emailkepada		= '';
			$cekpenerima 		= explode(';', $idtujuan);
			if (isset($cekpenerima[1])){
				foreach($cekpenerima as $rid){
					$idtujuan	= $rid;
					$gettujuan	= Pejabatsurat::where('pejabat', $idtujuan)->first();
					if (isset($gettujuan->id)){
						if ($jabkepada == ''){
							$jabkepada		= $gettujuan->pejabat;
							$namakepada		= $gettujuan->nama;
							$emailkepada	= $gettujuan->email;
						} else {
							$jabkepada		= $jabkepada.';'.$gettujuan->pejabat;
							$namakepada		= $namakepada.';'.$gettujuan->nama;
							$emailkepada	= $emailkepada.';'.$gettujuan->email;
						}
					}
				}
			} else {
				$gettujuan			= Pejabatsurat::where('pejabat', $idtujuan)->first();
				if (isset($gettujuan->id)){
					$jabkepada		= $gettujuan->pejabat;
					$namakepada		= $gettujuan->nama;
					$emailkepada	= $gettujuan->email;
				}
			}
			$isisurat			= $tekstujuan.'[psh]'.$judul.'[psh]'.$isi.'[psh]'.$pemeriksa.'[psh]'.$penandatangan;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$getpemeriksa	= Pejabatsurat::where('pejabat', $pemeriksa)->first();
				if (isset($getpemeriksa->id)){
					$pemeriksa		= $getpemeriksa->pejabat;
					$namapemeriksa	= $getpemeriksa->nama;
				} else {
					$pemeriksa		= '';
					$namapemeriksa	= '';
				}
				$kirimke 	= $pemeriksa;
				$paraf1		= $pemeriksa;
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= 'SELF';
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'SPEMB-'.date('Y-m-d').'-'.$idtujuan;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $tekstujuan,
						'alamat' 		=> $emailkepada,
						'perihal' 		=> $judul,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $tekstujuan,
					'alamat' 		=> $emailkepada,
					'perihal' 		=> $judul,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				}
			}
		}
		if ($masterjenissurat == 'Edaran'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$set_kepada			= $request->input('set_kepada');
			$kepada   			= json_decode($set_kepada['0']);
			$tlskepada 			= '';
			foreach ( $kepada as $tujuan )
			{
				$tujuanne 	= $tujuan->id;
				if ($tlskepada == '') {$tlskepada = $tujuanne;}
				else {$tlskepada = $tlskepada.'-'.$tujuanne; }
			}
			
			$isiedaran			= $request->input('val02');
			$judul				= $request->input('val03');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $tlskepada.'[psh]'.$isiedaran.'[psh]'.$judul;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'ED-'.date('Y-m-d').'-'.date('H:i:s');
			if ($request->hasFile('file')) {
				$lampiran		= 'LAMP-'.$marking.'.'.$request->file->getClientOriginalExtension();
				$uploadedFile 	= $request->file('file');
				$uploadedFile->move(public_path('scan/files'), $lampiran);
			} else {
				$lampiran		= '';
			}
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $tlskepada,
						'lampiran'		=> $lampiran,
						'alamat' 		=> Session('fakpanjang'),
						'perihal' 		=> $masterjenissurat,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$ceklampiran 	= Suratkeluar::where('marking', $marking)->first();
				if (isset($ceklampiran->lampiran)){
					if (File::exists(base_path() ."/public/scan/files/". $ceklampiran->lampiran)) {
						File::delete(base_path() ."/public/scan/files/". $ceklampiran->lampiran);
					}
				}
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $tlskepada,
					'lampiran'		=> $lampiran,
					'alamat' 		=> Session('fakpanjang'),
					'perihal' 		=> $masterjenissurat,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Undangan'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$set_kepada			= $request->input('set_kepada');
			$kepada   			= json_decode($set_kepada['0']);
			$tlskepada 			= '';
			foreach ( $kepada as $tujuan )
			{
				$tujuanne 	= $tujuan->id;
				if ($tlskepada == '') {$tlskepada = $tujuanne;}
				else {$tlskepada = $tlskepada.'-'.$tujuanne; }
			}
			
			$judul				= $request->input('val02');
			$mulai				= $request->input('val03');
			$waktu				= $request->input('val04');
			$tempat				= $request->input('val05');
			$kepada2			= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $tlskepada.'[psh]'.$judul.'[psh]'.$mulai.'[psh]'.$waktu.'[psh]'.$tempat.'[psh]'.$kepada2;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'UDG-'.date('Y-m-d').'-'.date('H:i:s');
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $tlskepada,
						'alamat' 		=> Session('fakpanjang'),
						'perihal' 		=> $masterjenissurat,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $tlskepada,
					'alamat' 		=> Session('fakpanjang'),
					'perihal' 		=> $masterjenissurat,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				}
			}
		}
		if ($masterjenissurat == 'Peringatan'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpeg				= $request->input('val01');
			$ppabp				= $request->input('val02');
			$jabatan			= $request->input('val03');
			$mulai				= $request->input('val04');
			$tempat				= $request->input('val05');
			$isisurat			= $request->input('val06');
			$jenisperingatan	= $request->input('val07');
			$sanksi				= $request->input('val08');
			$pemeriksa			= $request->input('val09');
			$penandatangan		= $request->input('val10');
			$isisurat			= $idpeg.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$mulai.'[psh]'.$tempat.'[psh]'.$isisurat.'[psh]'.$jenisperingatan.'[psh]'.$sanksi.'[psh]'.$pemeriksa.'[psh]'.$penandatangan;
			Simpegpegawai::where('id', $idpeg)->update([
				'status_jabatan'=> $jenisperingatan
			]);
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'PRT-'.date('Y-m-d').'-'.$idpeg;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Balasan Penambahan Staf'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$kepada				= $request->input('val01');
			$nomorlama			= $request->input('val02');
			$tanggallama		= $request->input('val03');
			$isisurat			= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $kepada.'[psh]'.$nomorlama.'[psh]'.$tanggallama.'[psh]'.$isisurat;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'BLS-'.date('Y-m-d').'-'.md5($kepada);
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $kepada,
						'alamat' 		=> Session('fakpanjang'),
						'perihal' 		=> $masterjenissurat,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $kepada,
					'alamat' 		=> Session('fakpanjang'),
					'perihal' 		=> $masterjenissurat,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Tugas'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$set_kepada			= $request->input('set_kepada');
			$tlskepada 			= $request->input('val06');
			$judul				= $request->input('val02');
			$mulai				= $request->input('val03');
			$waktu				= $request->input('val04');
			$tempat				= $request->input('val05');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $tlskepada.'[psh]'.$judul.'[psh]'.$mulai.'[psh]'.$waktu.'[psh]'.$tempat;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'TGS-'.date('Y-m-d').'-'.md5($set_kepada);
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $set_kepada,
						'alamat' 		=> Session('fakpanjang'),
						'perihal' 		=> $masterjenissurat,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $tlskepada,
					'alamat' 		=> Session('fakpanjang'),
					'perihal' 		=> $masterjenissurat,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Pemberitahuan Mutasi'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$set_kepada			= $request->input('set_kepada');
			$kepada   			= json_decode($set_kepada['0']);
			$tlskepada 			= '';
			foreach ( $kepada as $tujuan )
			{
				$tujuanne 	= $tujuan->id;
				if ($tlskepada == '') {$tlskepada = $tujuanne;}
				else {$tlskepada = $tlskepada.'-'.$tujuanne; }
			}
			
			$set_pegawai		= $request->input('set_pegawai');
			$arrpeg   			= json_decode($set_pegawai['0']);
			$tlspegawai 		= '';
			foreach ( $arrpeg as $tujuan )
			{
				$tujuanne 	= $tujuan->id;
				if ($tlspegawai == '') {$tlspegawai = $tujuanne;}
				else {$tlspegawai = $tlspegawai.'-'.$tujuanne; }
			}
			$isisrt				= $request->input('val03');
			$asal				= $request->input('val04');
			$tujuan				= $request->input('val05');
			$tanggal			= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $tlskepada.'[psh]'.$tlspegawai.'[psh]'.$isisrt.'[psh]'.$asal.'[psh]'.$tujuan.'[psh]'.$tanggal;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'TGS-'.date('Y-m-d').'-'.md5($tlspegawai);
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $request->input('val07'),
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $tlspegawai,
						'alamat' 		=> $tlskepada,
						'perihal' 		=> $masterjenissurat,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $tlspegawai,
					'alamat' 		=> $tlskepada,
					'perihal' 		=> $masterjenissurat,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Pemberitahuan Tidak Memperpanjang Kontrak'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpeg				= $request->input('val01');
			$ppabp				= $request->input('val02');
			$jabatan			= $request->input('val03');
			$tanggal			= $request->input('val04');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $idpeg.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$tanggal;
			Simpegpegawai::where('id', $idpeg)->update([
				'status_jabatan'=> $masterjenissurat
			]);
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'TDKPK-'.date('Y-m-d').'-'.$idpeg;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Tanggapan Pengunduran Diri Masa Orientasi' OR $masterjenissurat == 'Tanggapan Permohonan Tidak Memperpanjang Kontrak' OR $masterjenissurat == 'Tanggapan Pengunduran Diri Pegawai Tetap' OR $masterjenissurat == 'Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak' OR $masterjenissurat == 'Tanggapan Pengunduran Diri' OR $masterjenissurat == 'Tanggapan Pengunduran Diri Dokter Umum/Spesialis'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpeg				= $request->input('val01');
			$ppabp				= $request->input('val02');
			$jabatan			= $request->input('val03');
			$tanggal			= $request->input('val04');
			$tmt_pensiun		= $request->input('val05');
			$keputusan			= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $idpeg.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$tanggal.'[psh]'.$tmt_pensiun.'[psh]'.$keputusan;
			Simpegpegawai::where('id', $idpeg)->update([
				'status_jabatan'=> $masterjenissurat
			]);
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'RSG-'.date('Y-m-d').'-'.$idpeg;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Keterangan Aktif Bekerja'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpeg				= $request->input('val01');
			$ppabp				= $request->input('val02');
			$jabatan			= $request->input('val03');
			$unitkerja			= $request->input('val04');
			$mulai				= $request->input('val05');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $idpeg.'[psh]'.$jabatan.'[psh]'.$ppabp.'[psh]'.$unitkerja.'[psh]'.$mulai;
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'KTA-'.date('Y-m-d').'-'.$idpeg;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Keterangan Tidak Bekerja'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$idpeg				= $request->input('val01');
			$unitkerja			= $request->input('val02');
			$jabatan			= $request->input('val03');
			$mulai				= $request->input('val04');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$isisurat			= $idpeg.'[psh]'.$unitkerja.'[psh]'.$jabatan.'[psh]'.$mulai;
			$getpegawai 		= Simpegpegawai::where('id', $idpeg)->first();
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			$marking 		= 'KTA-'.date('Y-m-d').'-'.$idpeg;
			$ceksek 		= Suratkeluar::where('marking', $marking)->count();
			if ($ceksek == 0){
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('marking', $marking)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				
				}
			}
			
		}
		if ($masterjenissurat == 'Pemanggilan KIE Staf'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$email				= $request->input('val01');
			$mulai				= $request->input('val02');
			$waktu				= $request->input('val03');
			$tempat				= $request->input('val04');
			$hasil				= $request->input('val05');
			$idne				= $request->input('val06');
			$pemeriksa			= $request->input('val07');
			$penandatangan		= $request->input('val08');
			$getpegawai 		= Simpegpegawai::where('email_ub', $email)->first();
			$idpeg				= $getpegawai->id;
			$isisurat			= $idpeg.'[psh]'.$mulai.'[psh]'.$waktu.'[psh]'.$tempat.'[psh]'.$hasil;
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;	
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			if ($pemeriksa != ''){
				$kirimke 	= $pemeriksa;
				$paraf1		= 'SELF';
				$jenis 		= 'PARAF';
			} else {
				$kirimke 	= $penandatangan;
				$paraf1		= $pemeriksa;
				$jenis 		= 'Mohon TTD';
			}
			$pesan			= '';
			if ($idne == 'new'){
				$marking 		= 'KIE-'.date('Y-m-d').'-'.$idpeg;
				$postrek		= SendMail::genQRSatuNomor('1');
				$getnomor		= $postrek->getData();
				$idsurat		= $getnomor->idsurat;
				$keterangan		= $getnomor->keterangan;
				$status 		= $getnomor->status;
				$textinput 		= 'Input Data '.$masterjenissurat;
				if ($idsurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'idpejabat'		=> $idpejabat,
						'pejabat'		=> $penandatangan,
						'namapejabat'	=> $setttd,
						'paraf1'		=> $paraf1,
						'marking'		=> $marking,
						'isisurat'		=> $isisurat,
						'jenissrt'		=> $masterjenissurat,
						'kepada' 		=> $getpegawai->nama_lengkap,
						'alamat' 		=> $getpegawai->email,
						'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
						'pembuat'		=> Session('email'),
						'kelompok'		=> Session('jabatan')
					]);
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses '.$keterangan]);
					return back();
				}
			} else {
				$input = Suratkeluar::where('id', $idne)->update([
					'idpejabat'		=> $idpejabat,
					'pejabat'		=> $penandatangan,
					'namapejabat'	=> $setttd,
					'paraf1'		=> $paraf1,
					'isisurat'		=> $isisurat,
					'jenissrt'		=> $masterjenissurat,
					'kepada' 		=> $getpegawai->nama_lengkap,
					'alamat' 		=> $getpegawai->email,
					'perihal' 		=> $masterjenissurat.' an. '.$getpegawai->nama_lengkap,
					'pembuat'		=> Session('email'),
					'kelompok'		=> Session('jabatan'),
					'updated_at'	=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getpejabat = Pejabatsurat::where('pejabat', $kirimke)->first();
					if (isset($getpejabat->id)){
						$ceksudah = Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
						if ($ceksudah != 0){
							Inboxsurat::where('marking', $marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
						}
						$kirim = SendMail::kiriminbox($marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'','1');
						$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$kirimke;
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
						return back();
					} else {
						$gagal = $pesan.'<br />Data Pejabat : '.$kirimke.' Tidak di Valid';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses ']);
					return back();
				}
			}
		}
		if ($masterjenissurat == 'SPO'){
			$textinput 			= 'Input Data '.$masterjenissurat;
			$textupdate 		= 'Update Data '.$masterjenissurat;
			$nomor				= $request->input('val01');
			$revisi				= $request->input('val02');
			$tanggal			= $request->input('val03');
			$judul				= $request->input('val04');
			$penandatangan		= $request->input('val08');
			$arrakhir			= explode('-', $tanggal);
			$yy					= $arrakhir[0];
			$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
			if (isset($getpejabat->id)){
				$idpejabat		= $getpejabat->id;
				$penandatangan	= $getpejabat->pejabat;
				$setttd			= $getpejabat->nama;
				$kodepjbt		= $getpejabat->kode;
			} else {
				$idpejabat		= 0;
				$penandatangan	= '';
				$setttd			= '';
				$kodepjbt		= '';
			}
			$pesan			= '';
			$marking 		= 'SPO-'.time();
			$textinput 		= 'Input Data '.$masterjenissurat;
				
			$ceksek 		= Suratkeluartnpnomor::where('jenissrt', $masterjenissurat)->where('kepada', $nomor)->where('alamat', $revisi)->where('perihal', $judul)->count();
			if ($ceksek == 0){
				$input 		= Suratkeluartnpnomor::create([
					'marking' 		=>  $marking,
					'jenissrt' 		=>  $masterjenissurat,
					'kodefak' 		=>  $kodepjbt,
					'unit' 			=>  'KP',
					'tglbuat' 		=>  $tanggal,
					'yersrt' 		=>  $yy,
					'dasarsurat' 	=>  '',
					'kepada' 		=>  $nomor,
					'alamat' 		=>  $revisi,
					'perihal' 		=>  $judul,
					'lampiran' 		=>  '',
					'isisurat' 		=>  '',
					'idpejabat' 	=>  $idpejabat,
					'pejabat' 		=>  $penandatangan,
					'namapejabat' 	=>  $setttd,
					'tembusan' 		=>  '',
					'sifat' 		=>  'Biasa',
					'klasifikasi' 	=>  'Biasa',
					'pembuat' 		=>  Session('email'),
					'kelompok' 		=>  Session('jabatan'),
					'status' 		=>  'NEW',
					'arsip' 		=>  '',
					'footnote' 		=>  '',
					'tandatangan' 	=>  '',
					'paraf1' 		=>  'SELF',
					'paraf2' 		=>  '0',
					'paraf3' 		=>  '0',
					'paraf4' 		=>  '0',
					'ruangarsip' 	=>  '',
					'ordnerarsip' 	=>  '',
					'lemariarsip' 	=>  '',
					'faskode' 		=>  '',
					'fasmasa' 		=>  '',
					'fasket' 		=>  '',
					'subkode' 		=>  '',
					'submasa' 		=>  '',
					'subket' 		=>  '',
					'font' 			=>  'ARL',
					'ukuran' 		=>  '',
					'lebarttd' 		=>  '50',
					'fakultas' 		=>  Session('fakultas'),
				]);
				if ($input){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $textinput]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses Silahkan Ulangi Beberapa Tahun Lagi']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $textinput.' Gagal di Proses Periksa Kembali Nomor Dokumen, Nomor Revisi dan Judul Dokumen tidak boleh Kembar']);
				return back();
			}
		}
	}
}
