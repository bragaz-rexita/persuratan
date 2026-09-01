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
use App\Models\Kelompoklain;
use App\Pejabatsurat;
use App\Models\Jenissurat;
use App\Models\Unitsurat;
use App\Suratmasuk;
use App\Suratkeluar;
use App\Suratkeluartnpnomor;
use App\Inboxsurat;
use App\Disposisi;
use App\Macamdisposisi;
use App\Tujuandisposisi;
use App\Chatting;
use App\Models\Tabelskdanperaturan;
use App\User;
use App\Jadwal;
use App\Models\Klasifikasi;
use App\Histories;
use App\Models\Hakaksess;
use App\Firebasebank;
use App\Simpegpegawai;
use App\Models\Simsppdpengikut;
use App\Models\Simsppdbiayaperjalanan;
use App\Penerimasurat;
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
use App\Models\Draftjabpelaksana;
use App\Models\Tblemailkepegkeu;
use App\Models\Ecekdata;
use App\Models\Antrian;
use App\Models\AntrianUjian;
use App\Models\AntrianMagang;
use App\Files;
use App\Jadwalkuliah;
use App\Models\Biodata;
use App\Pengumuman;
use App\Models\Pesennomor;
use App\Models\Ekspedisi;
use App\Models\Penerimabeasiswa;
use App\Models\Pengajuansimpukja;
use App\Models\KegiatanUkm;
use App\Models\Anggotasurat;
use App\Models\PegawaiKeuangan;
use App\Models\Ppabp;
use App\Models\SettingKeuangan;
use App\Setting;
use App\Models\JenisPenelitian;
use App\Models\RekapPrestasi;
use App\Models\Transkrip;
use App\Models\Doktorujian;
use App\Models\Kopdar;
use App\Models\MasterPS;
use App\Models\LogSkripsi;
use App\Models\AntriTranskrip;
use App\Models\AntrianTTE;
use App\Models\Tugasdeveloper;
use App\Models\Dosen;
use App\Models\Detailnilujian;
use App\Models\Settingcuti;
use App\Models\Draftpenyesuaiangaji;
use App\Models\DraftUjiandinas;
use App\Models\DraftKontrak;
use App\Banksoalujian;
use App\RekapPresensi;
use Gufy\PdfToHtml\Html;
use Gufy\PdfToHtml\Pdf;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Tcpdf\Fpdi;
use App\WebinarEventlist;
use App\WebinarPartisipan;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Browser;
use Validator;
use Session;
use Notification;
use QrCode;
use Response;
Use Exception;
use Hash;
use PDFCREATOR;
use DateTime;

function TerbilangN($x){
	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($x < 12)
	  return " " . $abil[$x];
	elseif ($x < 20)
	  return TerbilangN($x - 10) . " belas";
	elseif ($x < 100)
	  return TerbilangN($x / 10) . " puluh" . TerbilangN($x % 10);
	elseif ($x < 200)
	  return " seratus" . TerbilangN($x - 100);
	elseif ($x < 1000)
	  return TerbilangN($x / 100) . " ratus" . TerbilangN($x % 100);
	elseif ($x < 2000)
	  return " seribu" . TerbilangN($x - 1000);
	elseif ($x < 1000000)
	  return TerbilangN($x / 1000) . " ribu" . TerbilangN($x % 1000);
	elseif ($x < 1000000000)
	  return TerbilangN($x / 1000000) . " juta" . TerbilangN($x % 1000000);
	elseif ($x < 1000000000000)
	  return TerbilangN($x / 1000000000) . " milyar" . TerbilangN($x % 1000000000);
	elseif ($x < 1000000000000000)
	  return TerbilangN($x / 1000000000000) . " trilyun" . TerbilangN($x % 1000000000000);
}
function perbesarawal($string){
	$a_split = str_split($string);
	$sudah = '';
	$tulis = '';
	foreach($a_split as $rstring){
		if ($sudah == ''){
			$rstring 	= strtoupper($rstring);
			$tulis 		= $tulis.$rstring;
			if ($rstring != ''){
				$sudah 		= 'IYA';
			}
		} else {
			$tulis = $tulis.$rstring;
		}
	}
	return $tulis;
}
function getTextKepegawaian($id){
	$cekjenis			= explode("=", $id);
	$homebase			= url("/");
	if (isset($cekjenis[1])){
		$id 			= $cekjenis[1];
		$setview		= $cekjenis[0];
		$fontstyle		= 'style="font-family: "Times New Roman", Times, serif; font-size: 14px;"';
	} else {
		$fontstyle		= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-style: normal; font-weight: normal; font-variant: normal;"';
		$setview		= 'HTML';
	}
	$kalender 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$arrromawi 			= array("Bulan", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	$swandhanafak   	= strtoupper(config('global.swandhanafak'));
	$swandhanaalamat	= strtoupper(config('global.swandhanaalamat'));
	$swandhanakemen 	= strtoupper(config('global.swandhanakemen'));
	$swandhanauniv  	= strtoupper(config('global.swandhanauniv'));
	$swandhanatelpon	= config('global.swandhanatelpon');
	$swandhanaemail 	= config('global.swandhanaemail');
	$swandhanakota		= strtoupper(config('global.swandhanakota'));
	$universitas		= strtoupper($swandhanauniv);
	$kementerian		= strtoupper($swandhanakemen);
	$kota				= config('global.swandhanakota');
	$baris 				= 1;
	$halaman 			= 1;
	$ukuranfont			= '12';
	$ukuranfontplus1	= '18px';
	$ukuranfontplus2	= '12px';
	$ukuranfont			= '12';
	$ukuranfontplus1	= '18px';
	$ukuranfontplus2	= '12px';
	$tanggallama		= '';
	$tanggal			= '';
	$tmt_pensiun		= '';
	$keputusan			= '';
	$unitkerja			= '';
	$tmt_pensiun		= '';
	$tlskepada			= '';
	$tlspegawai			= '';
	$judul				= '';
	$tempat				= '';
	$nomorlama			= '';
	$waktu				= '';
	$isisurat			= '';
	$sanksi				= '';
	$jenisperingatan	= '';
	$hilangkan 			= array("<p>", "</p>");
	$hari				= 'unk';

	$mulai 				= date('Y-m-d');
	$arrakhir			= explode('-', $mulai);
	$yysk				= $arrakhir[0];
	$mmsk				= (int)$arrakhir[1];
	$ddsk				= $arrakhir[2];
	$mmsk				= $kalender[$mmsk];
	$tglsp				= $ddsk.' '.$mmsk.' '.$yysk;
	$gambarqrcode 		= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
	$jenisfontte		= '<font size="10" color="blue">';
	$pembatas 			= '<div style="page-break-before: always"></div>';
	$kopsurat 			= $homebase.'/images/kopsurat/DPM.png';
	if (Session('fakultas') == 'DPM'){
		$header 		= '<table width="700" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;">
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr>
									<td width="250" valign="top" colspan="3" style="border-bottom: 1px double black;">
										<img src="'.$homebase.'/logofront.png" width="250" />
									</td>
									<td width="450" align="right" valign="top" colspan="4" style="border-bottom: 1px double black;">
										Banjararum Selatan No. 3B Mondoroko<br />
										Singosari - Malang<br />
										Telp. (0341) 458679, Fax. (0341) 441874
									</td>
								</tr>';
	} else {
		$header 		= '<table width="700" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;">
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr>
									<td width="350" valign="top" colspan="3" style="border-bottom: 1px double black;">
										<img src="'.$homebase.'/dist/img/logorsph.png" width="250" />
									</td>
									<td width="350" valign="top" colspan="3" style="border-bottom: 1px double black;">
										<img src="'.$homebase.'/logofront.png" width="250" />
									</td>
								</tr>';
	}
	//test_pakai_bg_kop
	$header 			= '<table width="700" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;">
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr><td colspan="7" width="700">&nbsp;</td></tr>
								<tr><td colspan="7" width="700">&nbsp;</td></tr>';
	$generatesurat		= $setview.' Empty Data With ID : '.$id;
	$alamatfooter 		= Session('addressapps01').'<br />'.Session('kota01').'<br />'.Session('emailapps01');
	$alamatpejabat		= Session('fakpanjang');
	$info 				= array(
		'Name' 			=> 'Duidev Software House',
		'Location' 		=> $swandhanaalamat,
		'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
		'ContactInfo' 	=> $homebase,
	);
	$page_format		= array(
		'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 330),
		'Dur' 			=> 3,
		'PZ' 			=> 1,
	);
	if ($setview == 'formb'){
		$getdatasrt	= Tabelskdanperaturan::where('id', $id)->first();
		if(isset($getdatasrt->id)){
			$tandatangan= $getdatasrt->tandatangan;
			$kelompok	= $getdatasrt->kelompok;
			$nomor		= $getdatasrt->nomor;
			$tahun		= $getdatasrt->tahun;
			$tanggal	= $getdatasrt->tanggal;
			$uraian1	= $getdatasrt->uraian1;
			$uraian2	= $getdatasrt->uraian2;
			$uraian3	= $getdatasrt->uraian3;
			$created_at	= $getdatasrt->created_at;
			$klmbesar	= strtoupper($kelompok);
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
			$teks		= '';
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
			$pejabat		= 1;
			$cekpejabat		= Pejabatsurat::where('pejabat', $getdatasrt->penandatangan)->first();
			if (isset($cekpejabat->pejabat)){
				$pejabat 			= $cekpejabat->pejabat;
				$rektor 			= $cekpejabat->nama;
				$niprektor			= $cekpejabat->nip;
				$golonganrektor		= $cekpejabat->golongan;
				$pangkatrektor		= $cekpejabat->pangkat;
				$pangkatrektor		= $pangkatrektor.', '.$golonganrektor;
			} else {
				$pejabat			= 'ID 1 Not Found';
				$rektor				= 'ID 1 Not Found';
				$niprektor			= 'ID 1 Not Found';
				$pangkatrektor		= '';
			}
			$pejabatbesar	= strtoupper($pejabat);
			$niprektor 		= preg_replace('/\s+/', '', $niprektor);
			$rektor2		= $rektor;
			$alamatpejabat	= '';
			$getnamasaja	= Simpegpegawai::where('nip_baru', $niprektor)->first();
			if (isset($getnamasaja->nama)){
				$rektor2		= $getnamasaja->nama;
				$alamatpejabat	= $getnamasaja->alamat;
			}
			
			if ($kelompok == 'Penerimaan Staf'){
				$harine						= '';
				$nama_lengkap 				= $setval01;
				$ppabp 						= $setval02;
				$tmpt_lahir 				= $setval03;
				$tgl_lahir 					= $setval04;
				$kelamin 					= $setval05;
				$nik 						= $setval06;
				$kepdir_nomor 				= $setval07;
				$tmt_golongan 				= $setval08;
				$tmt_fungsional 			= $setval09;
				$kepdir_pemeriksa 			= $setval10;
				$kepdir_penandatangan 		= $setval11;
				$keputusandirektur_jenis 	= $setval12;
				$jenispeg 					= $setval13;
				$jabatan 					= $setval14;
				$jenjang 					= $setval15;
				$bidangilmu 				= $setval16;
				$unitkerja 					= $setval17;
				$uraiantugas 				= $setval18;
				$tanggalsk					= $tmt_fungsional;
				$pendidikan					= $jenjang.' '.$bidangilmu;
				$unitkerjabesar				= strtoupper($ppabp);
				if ($tgl_lahir == '' OR $tgl_lahir == '0000-00-00'){
					$tgl_lahir 		= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				} else {
					$arrtanggal		= explode('-', $tgl_lahir);
					if (isset($arrtanggal[2])){
						$yysk			= $arrtanggal[0];
						$mmsk			= (int)$arrtanggal[1];
						$ddsk			= $arrtanggal[2];
						$mmsk			= $kalender[$mmsk];
						$tgl_lahir		= $ddsk.' '.$mmsk.' '.$yysk;	
					}
				}
				if ($tmt_golongan == '' OR $tmt_golongan == '0000-00-00'){
					$tmt_golongan = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				} else {
					$arrtmtpgkt		= explode('-', $tmt_golongan);
					if (isset($arrtmtpgkt[2])){
						$yysk			= $arrtmtpgkt[0];
						$mmsk			= (int)$arrtmtpgkt[1];
						$ddsk			= $arrtmtpgkt[2];
						$mmsk			= $kalender[$mmsk];
						$tmt_golongan	= $ddsk.' '.$mmsk.' '.$yysk;
					}
				}
				$romawi = '';
				if ($tmt_fungsional == '' OR $tmt_fungsional == '0000-00-00'){
					$tmt_fungsional = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				} else {
					$arrmulai		= explode('-', $tmt_fungsional);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$romawi			= $arrromawi[$mmsk];
						$mmsk			= $kalender[$mmsk];
						$tmt_fungsional	= $ddsk.' '.$mmsk.' '.$yysk;
						$romawi			= $romawi.'/';
					}
				}
				$tulisnomor		= $nomor.'/DPM/I-KEP/DIR/'.$romawi.$yysk;
				$getpegawai		= Simpegpegawai::where('nik', $nik)->first();
				if (isset($getpegawai->nama)){
					$pendidikan		= $getpegawai->pend_akhir;
					$bidang_ilmu	= $getpegawai->bidang_ilmu;
					$jabatan		= $getpegawai->jabatan;
					$jenjanghomebase= $getpegawai->jenjanghomebase;
					if ($jabatan == '' OR $jabatan == 'warga'){ $jabatan = $jenjanghomebase; }
					$pendidikan		= $pendidikan.' '.$bidang_ilmu;
				}
			}
			if ($tandatangan == 'Auto' OR $tandatangan == 'Proses' OR $tandatangan == '' OR is_null($tandatangan)){
				$tandatangan	= $gambarqrcode;
			} else {
				$getjam 		= explode(" ", $getdatasrt->created_at);
				if (isset($getjam[1])){
					$jamtte		= $getjam[1];
				} else {
					$jamtte		= date("H:i");
				}
				$alamatweb		= $homebase.'/trackingid/srtklr-'.$getdatasrt->marking;
				if (Session('fakultas') == 'DPM'){
					$qrcode = QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pt.png', 0.2, true)->size(150)->generate($alamatweb);
				} else if (Session('fakultas') == 'PDP'){
					$qrcode = QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pdp.png', 0.2, true)->size(150)->generate($alamatweb);
				} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
					$qrcode = QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/rs.png', 0.2, true)->size(150)->generate($alamatweb);
				} else {
					$qrcode = QrCode::format('png')->size(150)->generate($alamatweb);
				}
				$output_file 	= '/scan/generate/qrimage-'.$getdatasrt->id.'.png';
				Storage::disk('local')->put($output_file, $qrcode);
				$tandatangan	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
									<tr>
										<td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$getdatasrt->id.'.png" width="100" /></td>
										<td width="150" align="left" valign="center">
											'.$jenisfontte.'
												&nbsp;<br />TTE oleh :<br />
												<strong>'.$rektor2.'</strong><br />
												'.$tanggalsk.' '.$jamtte.'<br />
											</font>
										</td>
									</tr>
								</table>';
				$gambarqrcode	= '<img src="'.$homebase.'/scan/generate/qrimage-'.$getdatasrt->id.'.png" width="100" />';
			}
			$generatesurat 		= $header;
			$sql 				= Templateskpp::where('namask', $getdatasrt->kelompok)->where('fakultas', Session('fakultas'))->orderBy('urutan','ASC')->get();
			foreach($sql as $rows){
				if ($rows->judul == '-space-'){
					$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700">&nbsp;</td></tr>';
				} else if ($rows->judul == '-footer-'){
					$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700" align="center" style="border-top: 1px solid #000000;">'.$alamatfooter.'</td></tr>';
				} else if ($rows->judul == '-page2optional-'){
					$generatesurat	= $generatesurat.'[page2optional]';
				} else if ($rows->judul == '-page3optional-'){
					$generatesurat	= $generatesurat.'[page3optional]';
				} else if ($rows->judul == '-pagebreak-'){
					$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="center" width="680" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
					$halaman++;
				} else {
					if ($rows->leter == 'judul'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td height="22" colspan="6" align="center" width="680">'.$rows->judul.'</td></tr>';
					} else if ($rows->leter == 'RL'){
						if ($rows->posisi == '2'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td>'.$rows->judul;
						} else {
							$generatesurat	= $generatesurat.'<tr><td width="20" colspan="2">&nbsp;</td>'.$rows->judul;
						}
					} else if ($rows->leter == 'RA'){
						$generatesurat	= $generatesurat.$rows->judul;
					} else {
						if ($rows->posisi == '5'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '6'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">'.$rows->mengingat.'</td><td width="20" align="center">'.$rows->menimbang.'</td><td align="justify" valign="top" colspan="2" width="490">'.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '8'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td width="200" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="310">: '.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '7'){
							$generatesurat	= $generatesurat.'<tr><td width="400" colspan="4">&nbsp;</td><td colspan="3" align="justify" valign="top" width="300">'.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '9'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '0'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '1'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="4" width="640">'.$rows->judul.'</td></tr>';
						} else if ($rows->posisi == '2'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="3" width="620">'.$rows->judul.'</td></tr>';
						} else {
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="600">'.$rows->judul.'</td></tr>';
						}
					}
				}
			}
			$generatesurat	= $generatesurat.'</table>';
			if ($kelompok == 'Penerimaan Staf'){
				if ($getdatasrt->uraian2 == null OR $getdatasrt->uraian2 == ''){
					$tambahan 	= 'TDKADA';
					$uraian2	= '';
				} else { $tambahan = 'ADA'; }
				if ($getdatasrt->uraian3 == null OR $getdatasrt->uraian3 == ''){
					$tambahan 	= 'TDKADA';
					$uraian3	= '';
				} else { $tambahan = 'ADA'; }
				if ($tambahan == 'ADA'){
					$generatesurat 		= $header;
					$sql 				= Templateskpp::where('namask', $getdatasrt->kelompok)->where('fakultas', Session('fakultas'))->orderBy('urutan','ASC')->get();
					foreach($sql as $rows){
						if ($rows->judul == '-space-'){
							$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700">&nbsp;</td></tr>';
						} else if ($rows->judul == '-page2optional-'){
							if ($uraian2 != ''){
								$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="center" width="680" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
								$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$uraian2.'</td></tr>';
								$halaman++;
							}
						} else if ($rows->judul == '-page3optional-'){
							if ($uraian3 != ''){
								$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="center" width="680" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
								$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$uraian3.'</td></tr>';
								$halaman++;
							}
						} else if ($rows->judul == '-pagebreak-'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="center" width="680" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
							$halaman++;
						} else {
							if ($rows->leter == 'judul'){
								$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td height="22" colspan="6" align="center" width="680">'.$rows->judul.'</td></tr>';
							} else if ($rows->leter == 'RL'){
								if ($rows->posisi == '2'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td>'.$rows->judul;
								} else {
									$generatesurat	= $generatesurat.'<tr><td width="20" colspan="2">&nbsp;</td>'.$rows->judul;
								}
							} else if ($rows->leter == 'RA'){
								$generatesurat	= $generatesurat.$rows->judul;
							} else {
								if ($rows->posisi == '5'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '6'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">'.$rows->mengingat.'</td><td width="20" align="center">'.$rows->menimbang.'</td><td align="justify" valign="top" colspan="2" width="490">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '8'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td width="200" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="310">: '.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '7'){
									$generatesurat	= $generatesurat.'<tr><td width="400" colspan="4">&nbsp;</td><td colspan="3" align="justify" valign="top" width="300">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '9'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '0'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '1'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="4" width="640">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '2'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="3" width="620">'.$rows->judul.'</td></tr>';
								} else {
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="600">'.$rows->judul.'</td></tr>';
								}
							}
						}
					}
					$generatesurat	= $generatesurat.'</table>';
				}
				$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
				$generatesurat	= str_replace('[unitkerja]', $unitkerja, $generatesurat);
				$generatesurat	= str_replace('[pendidikan]', $pendidikan, $generatesurat);
				$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
				$generatesurat	= str_replace('[teks]', $klmbesar, $generatesurat);
				$generatesurat	= str_replace('[tmt]', $tmt_golongan, $generatesurat);
				$generatesurat	= str_replace('[nama]', $nama_lengkap, $generatesurat);
				$generatesurat	= str_replace('[jenispeg]', '<strong>Karyawan Tetap</strong>', $generatesurat);
				$generatesurat	= str_replace('[tglsp]', $tmt_fungsional, $generatesurat);
				$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
				$generatesurat	= str_replace('[tandatangan1]', $tandatangan, $generatesurat);
				$generatesurat	= str_replace('[namapejabat]', $rektor, $generatesurat);
				$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
				$generatesurat	= str_replace('[uraiantugas]', $uraiantugas, $generatesurat);
			} else if ($kelompok == 'Mutasi'){
				$nama_lengkap 				= $setval01;
				$jabatan 					= $setval02;
				$ppabp 						= $setval03;
				$ppabptujuan 				= $setval04;
				$kepdir_nomor 				= $setval05;
				$tmt 						= $setval06;
				$tanggal 					= $setval07;
				$idpeg 						= $setval08;
				$keputusandirektur_jenis 	= $setval09;
				$romawi 					= '';
				if ($tanggal == '' OR $tanggal == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tanggal);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$romawi			= $arrromawi[$mmsk];
						$mmsk			= $kalender[$mmsk];
						$tanggal		= $ddsk.' '.$mmsk.' '.$yysk;
						$romawi			= $romawi.'/';
					}
				}
				if ($tmt == '' OR $tmt == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tmt);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$mmsk			= $kalender[$mmsk];
						$tmt			= $ddsk.' '.$mmsk.' '.$yysk;
					}
				}
				$tulisnomor		= $nomor.'/DPM/I-KEP/DIR/'.$romawi.$yysk;
				$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
				$generatesurat	= str_replace('[nama]', $nama_lengkap, $generatesurat);
				$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
				$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
				$generatesurat	= str_replace('[ppabpbaru]', $ppabptujuan, $generatesurat);
				$generatesurat	= str_replace('[tmt]', $tmt, $generatesurat);
				$generatesurat	= str_replace('[tglsp]', $tanggal, $generatesurat);
				$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
				$generatesurat	= str_replace('[tandatangan1]', $tandatangan, $generatesurat);
				$generatesurat	= str_replace('[namapejabat]', $rektor, $generatesurat);
			} else if ($kelompok == 'Pengangkatan Jabatan'){
				$nama_lengkap 				= $setval01;
				$jabatan 					= $setval02;
				$ppabp 						= $setval03;
				$sifat 						= $setval04;
				$kepdir_nomor 				= $setval05;
				$tmt 						= $setval06;
				$mulai 						= $setval07;
				$akhir 						= $setval08;
				$tanggal 					= $setval09;
				$idpeg 						= $setval10;
				$keputusandirektur_jenis 	= $setval11;
				$uraiantugas 				= $setval12;
				$romawi 					= '';
				if ($mulai == '' OR $mulai == '0000-00-00'){
					$yystart		= date('Y');
				} else {
					$arrmulai		= explode('-', $mulai);
					if (isset($arrmulai[2])){
						$yystart		= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$mmsk			= $kalender[$mmsk];
						$mulai			= $ddsk.' '.$mmsk.' '.$yystart;
					}
				}
				if ($akhir == '' OR $akhir == '0000-00-00'){
					$yyend			= date('Y');
				} else {
					$arrmulai		= explode('-', $akhir);
					if (isset($arrmulai[2])){
						$yyend			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$mmsk			= $kalender[$mmsk];
						$akhir			= $ddsk.' '.$mmsk.' '.$yyend;
					}
				}
				if ($tanggal == '' OR $tanggal == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tanggal);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$romawi			= $arrromawi[$mmsk];
						$mmsk			= $kalender[$mmsk];
						$tanggal		= $ddsk.' '.$mmsk.' '.$yysk;
						$romawi			= $romawi.'/';
					}
					
				}
				if ($tmt == '' OR $tmt == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tmt);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$mmsk			= $kalender[$mmsk];
						$tmt			= $ddsk.' '.$mmsk.' '.$yysk;
					}
				}
				$jabatanbesar	= strtoupper($jabatan);
				$periode		= $yystart.' - '.$yyend;
				$tulisnomor		= $nomor.'/DPM/I-KEP/DIR/'.$romawi.$yysk;
				$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
				$generatesurat	= str_replace('[jabatanbesar]', $jabatanbesar, $generatesurat);
				$generatesurat	= str_replace('[periode]', $periode, $generatesurat);
				$generatesurat	= str_replace('[nama]', $nama_lengkap, $generatesurat);
				$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
				$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
				$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
				$generatesurat	= str_replace('[akhir]', $akhir, $generatesurat);
				$generatesurat	= str_replace('[tmt]', $tmt, $generatesurat);
				$generatesurat	= str_replace('[tglsp]', $tanggal, $generatesurat);
				$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
				$generatesurat	= str_replace('[tandatangan1]', $tandatangan, $generatesurat);
				$generatesurat	= str_replace('[namapejabat]', $rektor, $generatesurat);
				$generatesurat	= str_replace('[uraiantugas]', $uraiantugas, $generatesurat);
			} else if ($kelompok == 'Pemberhentian Jabatan'){
				$nama_lengkap 				= $setval01;
				$jabatan 					= $setval02;
				$ppabp 						= $setval03;
				$kepdir_nomor 				= $setval04;
				$tmt 						= $setval05;
				$tanggal 					= $setval06;
				$idpeg 						= $setval07;
				$keputusandirektur_jenis 	= $setval08;
				$romawi 					= '';
				if ($tanggal == '' OR $tanggal == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tanggal);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$romawi			= $arrromawi[$mmsk];
						$mmsk			= $kalender[$mmsk];
						$tanggal		= $ddsk.' '.$mmsk.' '.$yysk;
						$romawi			= $romawi.'/';
					}
					
				}
				if ($tmt == '' OR $tmt == '0000-00-00'){
				} else {
					$arrmulai	= explode('-', $tmt);
					if (isset($arrmulai[2])){
						$yysk	= $arrmulai[0];
						$mmsk	= (int)$arrmulai[1];
						$ddsk	= $arrmulai[2];
						$mmsk	= $kalender[$mmsk];
						$tmt	= $ddsk.' '.$mmsk.' '.$yysk;
					}
				}
				$tulisnomor		= $nomor.'/DPM/I-KEP/DIR/'.$romawi.$yysk;
				$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
				$generatesurat	= str_replace('[nama]', $nama_lengkap, $generatesurat);
				$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
				$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
				$generatesurat	= str_replace('[tmt]', $tmt, $generatesurat);
				$generatesurat	= str_replace('[tglsp]', $tanggal, $generatesurat);
				$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
				$generatesurat	= str_replace('[tandatangan1]', $tandatangan, $generatesurat);
				$generatesurat	= str_replace('[namapejabat]', $rektor, $generatesurat);
			} else {
				$nama_lengkap 				= $setval01;
				$jabatan 					= $setval02;
				$ppabp 						= $setval03;
				$kepdir_nomor 				= $setval04;
				$tmt 						= $setval05;
				$tanggal 					= $setval06;
				$status_jabatan 			= $setval07;
				$idpeg 						= $setval08;
				$keputusandirektur_jenis 	= $setval09;
				$jenispeg					= $status_jabatan;
				if ($keputusandirektur_jenis == 'Pegawai Tetap'){ $teks = 'PENETAPAN KARYAWAN'; $jenispeg = 'Karyawan Tetap'; }
				if ($keputusandirektur_jenis == 'Dokter Tetap'){ $teks = 'PENETAPAN DOKTER TETAP'; $jenispeg = 'Dokter Tetap'; }
				$alamatunit					= Session('addressapps01');
				$getalamatunit 				= DB::table('app_menu')->where('subsubdomainapps', $ppabp)->first();
				if (isset($getalamatunit->id)){
					$alamatunit				= $getalamatunit->addressapps;
				}
				$romawi 					= '';
				if ($tanggal == '' OR $tanggal == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tanggal);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$romawi			= $arrromawi[$mmsk];
						$mmsk			= $kalender[$mmsk];
						$tanggal		= $ddsk.' '.$mmsk.' '.$yysk;
						$romawi			= $romawi.'/';
					}
				}
				if ($tmt == '' OR $tmt == '0000-00-00'){
				} else {
					$arrmulai		= explode('-', $tmt);
					if (isset($arrmulai[2])){
						$yysk			= $arrmulai[0];
						$mmsk			= (int)$arrmulai[1];
						$ddsk			= $arrmulai[2];
						$mmsk			= $kalender[$mmsk];
						$tmt			= $ddsk.' '.$mmsk.' '.$yysk;
					}
				}
				$tulisnomor		= $nomor.'/DPM/I-KEP/DIR/'.$romawi.$yysk;
				$generatesurat	= str_replace('[teks]', $teks, $generatesurat);
				$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
				$generatesurat	= str_replace('[nama]', $nama_lengkap, $generatesurat);
				$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
				$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
				$generatesurat	= str_replace('[jenispeg]', $jenispeg, $generatesurat);
				$generatesurat	= str_replace('[alamatunit]', $alamatunit, $generatesurat);
				$generatesurat	= str_replace('[tmt]', $tmt, $generatesurat);
				$generatesurat	= str_replace('[tglsp]', $tanggal, $generatesurat);
				$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
				$generatesurat	= str_replace('[tandatangan1]', $tandatangan, $generatesurat);
				$generatesurat	= str_replace('[namapejabat]', $rektor, $generatesurat);
			}
			$generatesurat	= str_replace('[page2optional]', '', $generatesurat);
			$generatesurat	= str_replace('[page3optional]', '', $generatesurat);
		} else {
			$generatesurat = 'Unkown Error';
		}
	} else if ($setview == 'formc' OR $setview == 'forme'){
		$getdatasrt		= Suratkeluar::where('id', $id)->first();
		$marking 		= $getdatasrt->marking;
		$namask 		= $getdatasrt->jenissrt;
		$tglsp 			= $getdatasrt->tglsurat;
		$isisurat 		= $getdatasrt->isisurat;
		$nama 			= $getdatasrt->kepada;
		$email 			= $getdatasrt->alamat;
		$idpejabat		= $getdatasrt->idpejabat;
		$tandatangan	= $getdatasrt->tandatangan;
		$fakultas		= $getdatasrt->fakultas;
		$updated_at		= $getdatasrt->updated_at;
		$lampiran		= $getdatasrt->lampiran;
		$paraf1			= $getdatasrt->paraf1;
		$uraiantugas	= $getdatasrt->uraian1;
		$uraian2		= $getdatasrt->uraian2;
		$uraian3		= $getdatasrt->uraian3;
		$penandatangan	= $getdatasrt->pejabat;
		$created_at		= $getdatasrt->created_at;
		$jabatan		= '';
		$romawi 		= (int)$getdatasrt->monsrt;
		$romawi 		= $arrromawi[$romawi];
		$tulisnomor	    = $getdatasrt->nomor.'/'.$fakultas.'/'.$getdatasrt->monsrt.'/'.$getdatasrt->yersrt;
		if ($lampiran != '' AND !is_null($lampiran)){
			$lampiran = '<a href="'.$homebase.'/scan/files/'.$lampiran.'" target="_blank">Lampiran Surat Nomor : '.$tulisnomor.'</a>';
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
		$kepada2	= '';
		$arrisine 	= explode('[psh]', $isisurat);
		$alamat		= Session('fakpanjang');
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
		if ($namask == 'Perjanjian Orientasi Kerja' OR
			$namask == 'Perjanjian Orientasi Kerja NAKES' OR
			$namask == 'Perjanjian Orientasi Kerja NON-NAKES' OR
			$namask == 'PKWT Staf Klinis Baru' OR
			$namask == 'PKWT Staf Klinis Lain dan Non Klinis Baru' OR
			$namask == 'PKWT Dokter Spesialis' OR
			$namask == 'PKWT Dokter Umum (PART TIME)' OR
			$namask == 'PKWT Dokter Manajemen Baru' OR
			$namask == 'PKWT Dokter Klinik' OR
			$namask == 'PKWT Staf Klinis Perpanjangan' OR
			$namask == 'PKWT Dokter Manajemen Perpanjangan' OR
			$namask == 'PKWT' OR
			$namask == 'PKWTT' OR
			$namask == 'PKWT Staf Klinis Lain dan Non Klinis Perpanjangan'){
			
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-KK/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$unitkerja 		= $setval02;
			$alamatunit 	= $setval03;
			$penempatan 	= $setval04;
			$jabatan 		= $setval05;
			$tempatlahir 	= $setval06;
			$tgllahir 		= $setval07;
			$nomorstr 		= $setval08;
			$alamatpegawai 	= $setval09;
			$noktp 			= $setval10;
			$kelamin 		= $setval11;
			$kontrak 		= $setval12;
			$satuan 		= $setval13;
			$mulai 			= $setval14;
			$akhir 			= $setval15;
			$honorarium 	= $setval16;
			$tglsp 			= $setval17;
			$jenis 			= $setval18;
			$status_jabatan	= $setval19;
	
			$kontrak		= preg_replace('/\s+/', '', $kontrak);
			try {
				$terbilkontrak 	= TerbilangN($kontrak);
			} catch (\Exception $e) {
				$terbilkontrak = '';
			}
			$harine				= '';
			$alamatpejabat		= $unitkerja;
			$unitkerjabesar		= strtoupper($unitkerja);
			if ($tgllahir == '' OR $tgllahir == '0000-00-00'){
				$tgllahir 		= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			} else {
				$arrtanggal		= explode('-', $tgllahir);
				if (isset($arrtanggal[2])){
					$yysk			= $arrtanggal[0];
					$mmsk			= (int)$arrtanggal[1];
					$ddsk			= $arrtanggal[2];
					$mmsk			= $kalender[$mmsk];
					$tgllahir		= $ddsk.' '.$mmsk.' '.$yysk;
				}
			}
			if ($mulai == '' OR $mulai == '0000-00-00'){
				$mulai = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			} else {
				$arrtmtpgkt		= explode('-', $mulai);
				if (isset($arrtmtpgkt[2])){
					$yysk			= $arrtmtpgkt[0];
					$mmsk			= (int)$arrtmtpgkt[1];
					$ddsk			= $arrtmtpgkt[2];
					$mmsk			= $kalender[$mmsk];
					$mulai			= $ddsk.' '.$mmsk.' '.$yysk;
				}
			}
			if ($akhir == '' OR $akhir == '0000-00-00'){
				$akhir = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			} else {
				$arrmulai		= explode('-', $akhir);
				if (isset($arrmulai[2])){
					$yysk			= $arrmulai[0];
					$mmsk			= (int)$arrmulai[1];
					$ddsk			= $arrmulai[2];
					$mmsk			= $kalender[$mmsk];
					$akhir			= $ddsk.' '.$mmsk.' '.$yysk;
				}
			}
			
			if ($idpejabat == '' OR $idpejabat == 0 OR $idpejabat == null){
				$idpejabat 	= 3;
			}
			$alamatweb		= $homebase.'/viewsurat/1b8a4d4791bd4b1b030db52b115e99b0-formc='.$id;
			$cekpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
			if (isset($cekpejabat->pejabat)){
				$pejabat 			= $cekpejabat->pejabat;
				$rektor 			= $cekpejabat->nama;
				$niprektor			= $cekpejabat->nip;
				$golonganrektor		= $cekpejabat->golongan;
				$pangkatrektor		= $cekpejabat->pangkat;
				$pangkatrektor		= $pangkatrektor.', '.$golonganrektor;
			} else {
				$pejabat			= 'ID 1 Not Found';
				$rektor				= 'ID 1 Not Found';
				$niprektor			= 'ID 1 Not Found';
				$pangkatrektor		= '';
			}
			$niprektor 		= preg_replace('/\s+/', '', $niprektor);
			$rektor2		= $rektor;
			$getnamasaja	= Simpegpegawai::where('nip_baru', $niprektor)->first();
			if (isset($getnamasaja->nama)){
				$rektor2		= $getnamasaja->nama;
				$alamatpejabat	= $getnamasaja->alamat;
			}
			if ($tandatangan == '' OR is_null($tandatangan)){
				$tandatangan1	= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
			} else {
				$getjam 		= explode(" ", $created_at);
				if (isset($getjam[1])){
					$jamtte		= $getjam[1];
				} else {
					$jamtte		= date("H:i");
				}
				$alamatweb		= $homebase.'/trackingid/srtklr-'.$getdatasrt->marking;
				$qrcode 		= QrCode::format('png')->size(100)->generate($alamatweb);
				$output_file 	= '/scan/generate/qrimage-'.$getdatasrt->id.'.png';
				Storage::disk('local')->put($output_file, $qrcode);
				$tandatangan1	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
									<tr>
										<td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$getdatasrt->id.'.png" width="100" /></td>
										<td width="150" align="left" valign="center">
											'.$jenisfontte.'
												&nbsp;<br />TTE oleh :<br />
												<strong>'.$rektor2.'</strong><br />
												'.$tglsp.' '.$jamtte.'<br />
											</font>
										</td>
									</tr>
								</table>';
				
			}
			if ($getdatasrt->filelampiran == '' OR is_null($getdatasrt->filelampiran)){
				$tandatangan2	= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
			} else {
				$tandatangan2	= '&nbsp;<br />'.$jenisfontte.'<br />Ditandatangani secara elektronik <br />'.$getdatasrt->filelampiran.'<br /></font>';
			}
			$namask = $getdatasrt->perihal;
		}
		if ($namask == 'Referensi Kerja'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 			= $setval01;
			$jabatan 		= $setval02;
			$unitkerja 		= $setval03;
			$alamat 		= $setval04;
			$mulai 			= $setval05;
			$akhir 			= $setval06;
			$ppabp			= $unitkerja;
			$cekmodel 		= explode('-', $akhir);
			if (isset($cekmodel[2])){
				$yysk		= $cekmodel[0];
				$mmsk		= (int)$cekmodel[1];
				$ddsk		= $cekmodel[2];
				$mmsk		= $kalender[$mmsk];
				$akhir		= $ddsk.' '.$mmsk.' '.$yysk;
				$cekmodel2 	= explode('-', $mulai);
				if (isset($cekmodel2[2])){
					$yysk	= $cekmodel2[0];
					$mmsk	= (int)$cekmodel2[1];
					$ddsk	= $cekmodel2[2];
					$mmsk	= $kalender[$mmsk];
					$mulai	= $ddsk.' '.$mmsk.' '.$yysk;
				}
				$tulistgl 	= 'sejak tanggal '.$mulai.' hingga tanggal '.$akhir;
			} else {
				$tulistgl 	= '';
			}
		}
		if ($namask == 'Keterangan Tidak Bekerja'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/E-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 			= $setval01;
			$unitkerja 		= $setval02;
			$jabatan 		= $setval03;
			$mulai 			= $setval04;
		}
		if ($namask == 'Keterangan Aktif Bekerja'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/E-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 			= $setval01;
			$jabatan 		= $setval02;
			$ppabp 			= $setval03;
			$unitkerja 		= $setval04;
			$mulai 			= $setval05;
		}
		if ($namask == 'Tanggapan Pengunduran Diri Masa Orientasi' OR $namask == 'Tanggapan Permohonan Tidak Memperpanjang Kontrak' OR $namask == 'Tanggapan Pengunduran Diri Pegawai Tetap' OR $namask == 'Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak' OR $namask == 'Tanggapan Pengunduran Diri' OR $namask == 'Tanggapan Pengunduran Diri Dokter Umum/Spesialis'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 			= $setval01;
			$jabatan 		= $setval02;
			$ppabp 			= $setval03;
			$tanggal 		= $setval04;
			$tmt_pensiun 	= $setval05;
			$keputusan 		= $setval06;
		}
		if ($namask == 'Pemberitahuan Tidak Memperpanjang Kontrak'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/E-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 		 	= $setval01;
			$jabatan 		= $setval02;
			$ppabp 			= $setval03;
			$tanggal 		= $setval04;
		}
		if ($namask == 'Pemberitahuan Mutasi'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$tlskepada 		= $setval01;
			$tlspegawai 	= $setval02;
			$isisrt 		= $setval03;
			$asal 			= $setval04;
			$tujuan 		= $setval05;
			$tanggal 		= $setval06;
		}
		if ($namask == 'Undangan'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-UND/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$tlskepada 		= $setval01;
			$judul 			= $setval02;
			$mulai 			= $setval03;
			$waktu 			= $setval04;
			$tempat 		= $setval05;
			$kepada2 		= $setval06;
		}
		if ($namask == 'Permohonan' OR $namask == 'Pemberitahuan Sekretaris'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-PEMB/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idtujuan 		= $setval01;
			$judul 			= $setval02;
			$isisurat 		= $setval03;
			$pemeriksa 		= $setval04;
			$penandatangan 	= $setval05;
			$lampiran		= '-';
		}
		if ($namask == 'Tugas'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-ST/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$tlskepada 		= $setval01;
			$judul 			= $setval02;
			$mulai 			= $setval03;
			$waktu 			= $setval04;
			$tempat 		= $setval05;
		}
		if ($namask == 'Balasan Penambahan Staf'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SKT/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$kepada 		= $setval01;
			$nomorlama 		= $setval02;
			$tanggallama 	= $setval03;
			$isisurat 		= $setval04;
		}
		if ($namask == 'Peringatan'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SP/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 		 	= $setval01;
			$jabatan 		= $setval02;
			$ppabp 			= $setval03;
			$mulai 			= $setval04;
			$tempat 		= $setval05;
			$isisurat 		= $setval06;
			$jenisperingatan= $setval07;
			$sanksi 		= $setval08;
			$pemeriksa 		= $setval09;
			$penandatangan 	= $setval10;
		}
		if ($namask == 'Edaran'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SE/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$tlskepada 		= $setval01;
			$isisurat 		= $setval02;
			$judul 			= $setval03;
		}
		if ($namask == 'Pemanggilan KIE Staf'){
			$tulisnomor		= $getdatasrt->nomor.'/'.$fakultas.'/I-SPG/DIR/'.$romawi.'/'.$getdatasrt->yersrt;
			$idpeg 		 	= $setval01;
			$mulai 			= $setval02;
			$waktu 			= $setval03;
			$tempat 		= $setval04;
			if ($getdatasrt->filelampiran == '' OR is_null($getdatasrt->filelampiran)){
				$tandatangan2	= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
			} else {
				$tandatangan2	= '&nbsp;<br />'.$jenisfontte.'<br />Ditandatangani secara elektronik <br />'.$getdatasrt->filelampiran.'<br /></font>';
			}
		}
		$getalamat		= Simpegpegawai::where('email', $email)->orWhere('email_ub', $email)->first();
		if (isset($getalamat->alamat)){
			$alamat		= $getalamat->alamat;
			$ppabp		= $getalamat->ppabp;
			$pend_akhir	= $getalamat->pend_akhir;
			$kelamin	= $getalamat->jenis_kelamin;
		} else {
			$pend_akhir	= '';
			$kelamin	= '';
		}
		if ($alamat == '' OR $alamat == '-' OR $alamat == null){ $alamat =  Session('fakpanjang'); }
		if ($tanggallama == '' OR $tanggallama == '0000-00-00'){
			$tanggallama = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		} else {
			$arrtgllm		= explode('-', $tanggallama);
			if (isset($arrtgllm[2])){
				$yysk		= $arrtgllm[0];
				$mmsk		= (int)$arrtgllm[1];
				$ddsk		= $arrtgllm[2];
				$mmsk		= $kalender[$mmsk];
				$tanggallama= $ddsk.' '.$mmsk.' '.$yysk;
			}
		}
		if ($tanggal == '' OR $tanggal == '0000-00-00'){
			$tanggal = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		} else {
			$arrtgl		= explode('-', $tanggal);
			if (isset($arrtgl[2])){
				$yysk		= $arrtgl[0];
				$mmsk		= (int)$arrtgl[1];
				$ddsk		= $arrtgl[2];
				$mmsk		= $kalender[$mmsk];
				$tanggal	= $ddsk.' '.$mmsk.' '.$yysk;
			}
		}
		if ($mulai == '' OR $mulai == '0000-00-00'){
			$mulai = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		} else {
			$arrmulai		= explode('-', $mulai);
			if (isset($arrmulai[2])){
				$cekhari2 	= DateTime::createFromFormat('Y-m-d', $mulai);
				$hari 		= $cekhari2->format('D');
				if ($hari == 'Mon'){ $hari = 'Senin'; }
				if ($hari == 'Tue'){ $hari = 'Selasa'; }
				if ($hari == 'Wed'){ $hari = 'Rabu'; }
				if ($hari == 'Thu'){ $hari = 'Kamis'; }
				if ($hari == 'Fri'){ $hari = 'Jumat'; }
				if ($hari == 'Sat'){ $hari = 'Sabtu'; }
				if ($hari == 'Sun'){ $hari = 'Minggu'; }
				$yysk		= $arrmulai[0];
				$mmsk		= (int)$arrmulai[1];
				$ddsk		= $arrmulai[2];
				$mmsk		= $kalender[$mmsk];
				$mulai		= $ddsk.' '.$mmsk.' '.$yysk;
			}
		}
		if ($tmt_pensiun == '' OR $tmt_pensiun == '0000-00-00'){
			$tmt_pensiun = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		} else {
			$arrakhir		= explode('-', $tmt_pensiun);
			if (isset($arrakhir[2])){
				$yysk		= $arrakhir[0];
				$mmsk		= (int)$arrakhir[1];
				$ddsk		= $arrakhir[2];
				$mmsk		= $kalender[$mmsk];
				$tmt_pensiun= $ddsk.' '.$mmsk.' '.$yysk;
			}
		}
		if ($tglsp == '' OR $tglsp == '0000-00-00'){
			$tglsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		} else {
			$arrakhir			= explode('-', $tglsp);
			if (isset($arrakhir[2])){
				try {
					$cekhari2 	= DateTime::createFromFormat('Y-m-d', $tglsp);
					$harine 	= $cekhari2->format('D');
					if ($harine == 'Mon'){ $harine = 'Senin'; }
					if ($harine == 'Tue'){ $harine = 'Selasa'; }
					if ($harine == 'Wed'){ $harine = 'Rabu'; }
					if ($harine == 'Thu'){ $harine = 'Kamis'; }
					if ($harine == 'Fri'){ $harine = 'Jumat'; }
					if ($harine == 'Sat'){ $harine = 'Sabtu'; }
					if ($harine == 'Sun'){ $harine = 'Minggu'; }
				} catch (\Exception $e) {
					$harine 	= 'Unkown';
				}
				$yysk			= $arrakhir[0];
				$mmsk			= (int)$arrakhir[1];
				$ddsk			= $arrakhir[2];
				$mmsk			= $kalender[$mmsk];
				$tglsp			= $ddsk.' '.$mmsk.' '.$yysk;
			} else {
				$tglsp			= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$harine 		= 'Unkown';
			}
		}
		$alamatweb		= $homebase.'/viewsurat/1b8a4d4791bd4b1b030db52b115e99b0-formc='.$id;
		$cekpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
		if (isset($cekpejabat->pejabat)){
			$pejabat 			= $cekpejabat->pejabat;
			$rektor 			= $cekpejabat->nama;
			$niprektor			= $cekpejabat->nip;
			$golonganrektor		= $cekpejabat->golongan;
			$pangkatrektor		= $cekpejabat->pangkat;
			$pangkatrektor		= $pangkatrektor.', '.$golonganrektor;
		} else {
			$pejabat			= $idpejabat;
			$rektor				= 'ID 1 Not Found';
			$niprektor			= 'ID 1 Not Found';
			$pangkatrektor		= '';
		}
		$niprektor 				= preg_replace('/\s+/', '', $niprektor);
		$rektor2				= $rektor;
		$getnamasaja			= Simpegpegawai::where('nip_baru', $niprektor)->first();
		if (isset($getnamasaja->nama)){
			$rektor2		= $getnamasaja->nama;
			$alamatpejabat	= $getnamasaja->alamat;
		}
		if ($alamatpejabat == '' OR $alamatpejabat == '-' OR $alamatpejabat == null){ $alamatpejabat =  Session('fakpanjang'); }
		if ($tandatangan == '' OR is_null($tandatangan)){
			if ($namask == 'Permohonan' OR $namask == 'Pemberitahuan Sekretaris'){
				$tandatangan1	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
										<tr><td width="300" colspan="2">Mengetahui,</td></tr>
										<tr><td width="300" colspan="2">'.$pejabat.'</td></tr>
										<tr>
											<td width="100" align="center">'.$gambarqrcode.'</td>
											<td width="200" align="left" valign="center">&nbsp;</td>
										</tr>
										<tr><td width="300" colspan="2">'.$rektor.'</td></tr>
									</table>';
			} else if ($namask == 'Peringatan'){
				$tandatangan1	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
										<tr><td width="300" colspan="2">Malang, '.$tglsp.'</td></tr>
										<tr><td width="300" colspan="2">'.$pejabat.'</td></tr>
										<tr>
											<td width="100" align="center">'.$gambarqrcode.'</td>
											<td width="200" align="left" valign="center">&nbsp;</td>
										</tr>
										<tr><td width="300" colspan="2">'.$rektor.'</td></tr>
									</table>';
			} else {
				$tandatangan1	= $gambarqrcode;
			}
		} else {
			$getjam 		= explode(" ", $updated_at);
			if (isset($getjam[1])){
				$jamtte		= $getjam[1];
			} else {
				$jamtte		= date("H:i");
			}
			$alamatweb		= $homebase.'/trackingid/srtklr-'.$getdatasrt->marking;
			if (Session('fakultas') == 'DPM'){
				$qrcode 	= QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pt.png', 0.2, true)->size(150)->generate($alamatweb);
			} else if (Session('fakultas') == 'PDP'){
				$qrcode 	= QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pdp.png', 0.2, true)->size(150)->generate($alamatweb);
			} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
				$qrcode 	= QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/rs.png', 0.2, true)->size(150)->generate($alamatweb);
			} else {
				$qrcode 	= QrCode::format('png')->size(150)->generate($alamatweb);
			}
			$output_file 	= '/scan/generate/qrimage-'.$getdatasrt->id.'.png';
			Storage::disk('local')->put($output_file, $qrcode);
			if ($namask == 'Permohonan' OR $namask == 'Pemberitahuan Sekretaris'){
				$tandatangan1	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
									<tr><td width="300" colspan="2">Mengetahui,</td></tr>
									<tr><td width="300" colspan="2">'.$pejabat.'</td></tr>
									<tr>
										<td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$getdatasrt->id.'.png" width="100" /></td>
										<td width="150" align="left" valign="center">
											'.$jenisfontte.'
												&nbsp;<br />TTE oleh :<br />
												<strong>'.$rektor2.'</strong><br />
												'.$getdatasrt->tglsurat.' '.$jamtte.'<br />
											</font>
										</td>
									</tr>
									<tr><td width="300" colspan="2">'.$rektor.'</td></tr>
								</table>';
			} else if ($namask == 'Peringatan'){
				$tandatangan1	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
										<tr><td width="300" colspan="2">Malang, '.$tglsp.'</td></tr>
										<tr><td width="300" colspan="2">'.$pejabat.'</td></tr>
										<tr>
											<td width="100" align="center">'.$gambarqrcode.'</td>
											<td width="150" align="left" valign="center">
												'.$jenisfontte.'
													&nbsp;<br />TTE oleh :<br />
													<strong>'.$rektor2.'</strong><br />
													'.$getdatasrt->tglsurat.' '.$jamtte.'<br />
												</font>
											</td>
										</tr>
										<tr><td width="300" colspan="2">'.$rektor.'</td></tr>
									</table>';
			} else {
				$tandatangan1	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
									<tr>
										<td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$getdatasrt->id.'.png" width="100" /></td>
										<td width="150" align="left" valign="center">
											'.$jenisfontte.'
												&nbsp;<br />TTE oleh :<br />
												<strong>'.$rektor2.'</strong><br />
												'.$getdatasrt->tglsurat.' '.$jamtte.'<br />
											</font>
										</td>
									</tr>
								</table>';
			}
			
			$gambarqrcode	= '<img src="'.$homebase.'/scan/generate/qrimage-'.$getdatasrt->id.'.png" width="100" />';
		}
		$generatesurat 	= $header;
		$baris 			= 0;
		$sql 			= Templateskpp::where('namask', $namask)->orderBy('urutan','ASC')->get();
		foreach($sql as $rows){
			$baris++;
			if ($rows->judul == '-space-'){
				$generatesurat	= $generatesurat.'<tr><td colspan="7">&nbsp;</td></tr>';
			} else if ($rows->judul == '-footer-'){
				$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700" align="center" style="border-top: 1px solid #000000;">'.$alamatfooter.'</td></tr>';
			} else if ($rows->judul == '-page2optional-'){
				if ($uraian2 == null OR $uraian2 == '' OR $uraian2 == '-'){
				} else {
					$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td align="center" width="620" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
					$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td height="22" colspan="6" align="center" width="650">'.$uraian2.'</td></tr>';
					$halaman++;
				}
			} else if ($rows->judul == '-page3optional-'){
				if ($uraian3 == null OR $uraian3 == '' OR $uraian3 == '-'){
				} else {
					$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td align="center" width="620" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
					$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td height="22" colspan="6" align="center" width="650">'.$uraian3.'</td></tr>';
					$halaman++;
				}
			} else if ($rows->judul == '-pagebreak-'){
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td align="center" width="620" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
				$halaman++;
			} else {
				if ($rows->leter == 'judul'){
					$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td height="22" colspan="6" align="center" width="650">'.$rows->judul.'</td></tr>';
				} else if ($rows->leter == 'RL'){
					if ($rows->posisi == '2'){
						$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td>'.$rows->judul;
					} else {
						$generatesurat	= $generatesurat.'<tr><td width="70" colspan="2">&nbsp;</td>'.$rows->judul;
					}
				} else if ($rows->leter == 'RA'){
					$generatesurat	= $generatesurat.$rows->judul;
				} else {
					if ($rows->posisi == '5'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '6'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">'.$rows->mengingat.'</td><td width="20" align="center">'.$rows->menimbang.'</td><td align="justify" valign="top" colspan="2" width="490">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '8'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td width="200" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="310">: '.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '10'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20">&nbsp;</td><td width="130" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td width="510" align="left" valign="top" colspan="3">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '7'){
						$generatesurat	= $generatesurat.'<tr><td width="400" colspan="4">&nbsp;</td><td colspan="3" align="justify" valign="top" width="300">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '9'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '0'){
						$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '1'){
						$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="25" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="4" width="580">'.$rows->judul.'</td></tr>';
					} else if ($rows->posisi == '2'){
						$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="3" width="540">'.$rows->judul.'</td></tr>';
					} else {
						$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="520">'.$rows->judul.'</td></tr>';
					}
				}
			}
		}
		$generatesurat	= $generatesurat.'</table>';
		if ($baris == 0){
		    $generatesurat	= $generatesurat.'Unkown Data '.$namask;
		}
		if ($namask == 'Perjanjian Orientasi Kerja' OR
			$namask == 'Perjanjian Orientasi Kerja NAKES' OR
			$namask == 'Perjanjian Orientasi Kerja NON-NAKES' OR
			$namask == 'PKWT Staf Klinis Baru' OR
			$namask == 'PKWT Staf Klinis Lain dan Non Klinis Baru' OR
			$namask == 'PKWT Dokter Spesialis' OR
			$namask == 'PKWT Dokter Klinik' OR
			$namask == 'PKWT Dokter Umum (PART TIME)' OR
			$namask == 'PKWT Dokter Manajemen Baru' OR
			$namask == 'PKWT Staf Klinis Perpanjangan' OR
			$namask == 'PKWT Dokter Manajemen Perpanjangan' OR
			$namask == 'PKWTT' OR
			$namask == 'PKWT' OR
			$namask == 'PKWT Staf Klinis Lain dan Non Klinis Perpanjangan'){
			$generatesurat	= str_replace('[mmsk]', $mmsk, $generatesurat);
			$generatesurat	= str_replace('[yysk]', $yysk, $generatesurat);
			$generatesurat	= str_replace('[ddsk]', $ddsk, $generatesurat);
			$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
			$generatesurat	= str_replace('[nama]', $nama, $generatesurat);
			$generatesurat	= str_replace('[tandatangan2]', $tandatangan2, $generatesurat);
			$generatesurat	= str_replace('[tandatangan1]', $tandatangan1, $generatesurat);
			$generatesurat	= str_replace('[alamatpejabat]', $alamatpejabat, $generatesurat);
			$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
			$generatesurat	= str_replace('[rektor]', $rektor, $generatesurat);
			$generatesurat	= str_replace('[tglsp]', $tglsp, $generatesurat);
			$generatesurat	= str_replace('[akhir]', $akhir, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
			$generatesurat	= str_replace('[tgllahir]', $tgllahir, $generatesurat);
			$generatesurat	= str_replace('[unitkerja]', $unitkerja, $generatesurat);
			$generatesurat	= str_replace('[alamatunit]', $alamatunit, $generatesurat);
			$generatesurat	= str_replace('[penempatan]', $penempatan, $generatesurat);
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[tempatlahir]', $tempatlahir, $generatesurat);
			$generatesurat	= str_replace('[nomorstr]', $nomorstr, $generatesurat);
			$generatesurat	= str_replace('[alamatpegawai]', $alamatpegawai, $generatesurat);
			$generatesurat	= str_replace('[noktp]', $noktp, $generatesurat);
			$generatesurat	= str_replace('[kelamin]', $kelamin, $generatesurat);
			$generatesurat	= str_replace('[kontrak]', $kontrak, $generatesurat);
			$generatesurat	= str_replace('[satuan]', $satuan, $generatesurat);
			$generatesurat	= str_replace('[terbilkontrak]', $terbilkontrak, $generatesurat);
			$generatesurat	= str_replace('[honorarium]', $honorarium, $generatesurat);
			$generatesurat	= str_replace('[harine]', $harine, $generatesurat);
			$generatesurat	= str_replace('[unitkerjabesar]', $unitkerjabesar, $generatesurat);
			$generatesurat	= str_replace('[uraiantugas]', $uraiantugas, $generatesurat);
			$generatesurat	= str_replace('[pend_akhir]', $pend_akhir, $generatesurat);
			$generatesurat	= str_replace('[program_studi]', $pend_akhir, $generatesurat);
		}
		if ($namask == 'Referensi Kerja'){
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[unitkerja]', $unitkerja, $generatesurat);
			$generatesurat	= str_replace('[alamat]', $alamat, $generatesurat);
			$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
			if ($tulistgl != ''){
				$generatesurat	= str_replace('dan selama bekerja', $tulistgl.' dan selama bekerja', $generatesurat);
			}
		}
		if ($namask == 'Keterangan Tidak Bekerja'){
			$generatesurat	= str_replace('[unitkerja]', $unitkerja, $generatesurat);
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
			$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
			$generatesurat	= str_replace('[fakpanjang]', $alamatpejabat, $generatesurat);
		}
		if ($namask == 'Keterangan Aktif Bekerja'){
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
			$generatesurat	= str_replace('[unitkerja]', $unitkerja, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
		}
		if ($namask == 'Tanggapan Pengunduran Diri Masa Orientasi' OR $namask == 'Tanggapan Permohonan Tidak Memperpanjang Kontrak' OR $namask == 'Tanggapan Pengunduran Diri Pegawai Tetap' OR $namask == 'Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak' OR $namask == 'Tanggapan Pengunduran Diri' OR $namask == 'Tanggapan Pengunduran Diri Dokter Umum/Spesialis'){
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
			$generatesurat	= str_replace('[tanggal]', $tanggal, $generatesurat);
			$generatesurat	= str_replace('[tmt_pensiun]', $tmt_pensiun, $generatesurat);
			$generatesurat	= str_replace('[keputusan]', $keputusan, $generatesurat);
		}
		if ($namask == 'Pemberitahuan Tidak Memperpanjang Kontrak'){
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
			$generatesurat	= str_replace('[tanggal]', $tanggal, $generatesurat);
		}
		if ($namask == 'Pemberitahuan Mutasi'){
			$tulisnomor	= $getdatasrt->nomor.'/DPM/I-PB/DIR/'.$getdatasrt->monsrt.'/'.$getdatasrt->yersrt;
		
			$kepada 	= '';
			$nomor 		= 1;
			$arrkepada	= explode('-', $tlskepada);
			foreach($arrkepada as $rkpd){
				if ($kepada == ''){
					$kepada = $rkpd;
				} else {
					if ($nomor == 1){
						$nomor++;
						$kepada = '1. '.$kepada.'<br />'.$nomor.'. '.$rkpd;
					} else {
						$kepada = $kepada.'<br />'.$nomor.'. '.$rkpd;
						$nomor++;
					}
				}
			}
			$nomor 		= 1;
			$pegawai 	= '<table widht="640" border="1" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"><tr><td width="30" align="center"><strong>No</strong></td><td width="310" align="center"><strong>Nama Lengkap</strong></td><td width="300" align="center"><strong>Unit</strong></td></tr>';
			$arrpegawai	= explode('-', $tlspegawai);
			foreach($arrpegawai as $idpeg){
				$getpegawai = Simpegpegawai::where('id', $idpeg)->first();
				if (isset($getpegawai->id)){
					$pegawai = $pegawai.'<tr><td>'.$nomor.'</td><td>'.$getpegawai->nama_lengkap.'</td><td>'.$getpegawai->unit_kerja.'</td></tr>';
					$nomor++;
				}
			}
			$pegawai 		= $pegawai.'</table>';
			$tandatangan2	= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
			$cekpejabat		= Pejabatsurat::where('pejabat', $paraf1)->first();
			if (isset($cekpejabat->pejabat)){
				$pemeriksa 			= $cekpejabat->pejabat;
				$namapemeriksa 		= $cekpejabat->nama;
				$cekparaf 			= Inboxsurat::where('marking', $marking)->where('penerima', $paraf1)->orderBy('id', 'DESC')->first();
				if (isset($cekparaf->id)){
					$paraf			= $cekparaf->status;
					if ($paraf == 'Signed'){
						$tandatangan2 = 'Ditandatangani Secara Elektronik pada '.$cekparaf->updated_at;
					}
				}
			} else {
				$pemeriksa 			= $paraf1;
				$namapemeriksa 		= 'Unkown';
			}
			
			$isisrt			= str_replace($hilangkan, '', $isisrt);
			$generatesurat	= str_replace('[pemeriksa]', $pemeriksa, $generatesurat);
			$generatesurat	= str_replace('[namapemeriksa]', $namapemeriksa, $generatesurat);
			$generatesurat	= str_replace('[tandatangan2]', $tandatangan2, $generatesurat);
			$generatesurat	= str_replace('[tlskepada]', $kepada, $generatesurat);
			$generatesurat	= str_replace('[tlspegawai]', $pegawai, $generatesurat);
			$generatesurat	= str_replace('[isisrt]', $isisrt, $generatesurat);
			$generatesurat	= str_replace('[asal]', $asal, $generatesurat);
			$generatesurat	= str_replace('[tujuan]', $tujuan, $generatesurat);
			$generatesurat	= str_replace('[tanggal]', $tanggal, $generatesurat);
		}
		if ($namask == 'Tugas'){
			$generatesurat	= str_replace('[tlskepada]', $tlskepada, $generatesurat);
			$generatesurat	= str_replace('[lampiran]', '-', $generatesurat);
			$generatesurat	= str_replace('[judul]', $judul, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
			$generatesurat	= str_replace('[waktu]', $waktu, $generatesurat);
			$generatesurat	= str_replace('[tempat]', $tempat, $generatesurat);
		}
		if ($namask == 'Undangan'){
			$kepada 	= '';
			$arrkepada	= explode('-', $tlskepada);
			foreach($arrkepada as $rkpd){
				$getnama = Simpegpegawai::where('id', $rkpd)->first();
				if (isset($getnama->id)){
					$rkpd = $getnama->nama_lengkap.' - '.$getnama->unit_kerja;
				}
				if ($kepada == ''){
					$kepada = $rkpd;
				} else {
					$kepada = $kepada.'<br />'.$rkpd;
				}
			}
			if ($kepada2 != ''){
				$getkepada2= explode(';', $kepada2);
				if (isset($getkepada2[1])){
					foreach($getkepada2 as $rkpd2){
						$kepada = $kepada.'<br />'.$rkpd2;
					}
				} else {
					$kepada = $kepada.'<br />'.$kepada2;
				}
			}
			$mulai 			= $hari.' / '.$mulai;
			$generatesurat	= str_replace('[kepada]', $kepada, $generatesurat);
			$generatesurat	= str_replace('[lampiran]', '-', $generatesurat);
			$generatesurat	= str_replace('[judul]', $judul, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
			$generatesurat	= str_replace('[waktu]', $waktu, $generatesurat);
			$generatesurat	= str_replace('[tempat]', $tempat, $generatesurat);
		}
		if ($namask == 'Balasan Penambahan Staf'){
			$kepada 		= $setval01;
			$generatesurat	= str_replace('[nomorlama]', $nomorlama, $generatesurat);
			$generatesurat	= str_replace('[tanggallama]', $tanggallama, $generatesurat);
			$generatesurat	= str_replace('[isisurat]', $isisurat, $generatesurat);
		}
		if ($namask == 'Permohonan' OR $namask == 'Pemberitahuan Sekretaris'){
			$getpemeriksa	= Pejabatsurat::where('pejabat', $pemeriksa)->first();
			if (isset($getpemeriksa->id)){
				$pemeriksa		= $getpemeriksa->pejabat;
				$namapemeriksa	= $getpemeriksa->nama;
			} else {
				$pemeriksa		= '';
				$namapemeriksa	= '';
			}
			if ($namapemeriksa == ''){
				$pejabatformat2	= '<table width="600" border="0" cellpadding="2" cellspacing="0"><tr><td width="300" valign="top" align="center">&nbsp;</td><td align="center" valign="top" width="300">'.$tandatangan1.'</td></tr></table>';
			} else {
				if ($tandatangan == '' OR is_null($tandatangan)){
					$tandatangan2	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
											<tr><td width="300" colspan="2">Menyetujui,</td></tr>
											<tr><td width="300" colspan="2">'.$pemeriksa.'</td></tr>
											<tr>
												<td width="150" align="center">'.$gambarqrcode.'</td>
												<td width="150" align="left" valign="center">&nbsp;</td>
											</tr>
											<tr><td width="300" colspan="2">'.$namapemeriksa.'</td></tr>
										</table>';
				} else {
					$tandatangan2	= '<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
											<tr><td width="300" colspan="2">Menyetujui,</td></tr>
											<tr><td width="300" colspan="2">'.$pemeriksa.'</td></tr>
											<tr>
												<td width="150" align="center">'.$gambarqrcode.'</td>
												<td width="150" align="left" valign="center">
													'.$jenisfontte.'
														&nbsp;<br />Ditandatangani secara elektronik :<br />
													</font>
												</td>
											</tr>
											<tr><td width="300" colspan="2">'.$namapemeriksa.'</td></tr>
										</table>';
				}
				$pejabatformat2	= '<table width="600" border="0" cellpadding="2" cellspacing="0"><tr><td width="300" valign="top" align="center">'.$tandatangan1.'</td><td align="center" valign="top" width="300">'.$tandatangan2.'</td></tr></table>';
			}
					
			$generatesurat	= str_replace('[lampiran]', $lampiran, $generatesurat);
			$generatesurat	= str_replace('[kepada]', $idtujuan, $generatesurat);
			$generatesurat	= str_replace('[pejabatformat2]', $pejabatformat2, $generatesurat);
			$generatesurat	= str_replace('[perihal]', $judul, $generatesurat);
			$generatesurat	= str_replace('[isisurat]', $isisurat, $generatesurat);
		}
		if ($namask == 'Peringatan'){
			$generatesurat	= str_replace('[jabatan]', $jabatan, $generatesurat);
			$generatesurat	= str_replace('[ppabp]', $ppabp, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
			$generatesurat	= str_replace('[tempat]', $tempat, $generatesurat);
			$generatesurat	= str_replace('[isisurat]', $isisurat, $generatesurat);
			$generatesurat	= str_replace('[jenisperingatan]', $jenisperingatan, $generatesurat);
			$generatesurat	= str_replace('[sanksi]', $sanksi, $generatesurat);
			$generatesurat	= str_replace('[kelamin]', $kelamin, $generatesurat);
			$generatesurat	= str_replace('[pendidikan]', $pend_akhir, $generatesurat);
			$generatesurat	= str_replace('[unitkerja]', $ppabp, $generatesurat);
			$getpemeriksa	= Pejabatsurat::where('pejabat', $pemeriksa)->first();
			if (isset($getpemeriksa->id)){
				$pemeriksa		= $getpemeriksa->pejabat;
				$namapemeriksa	= $getpemeriksa->nama;
			} else {
				$pemeriksa		= '';
				$namapemeriksa	= '';
			}
			if ($namapemeriksa == ''){
				$pejabatformat3	= '<table width="700" border="0" cellpadding="2" cellspacing="0">
									<tr>
										<td width="350" valign="top" align="center">
											<table width="300" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
												<tr><td width="300">&nbsp;</td></tr>
												<tr><td width="300">Yang Bersangkutan</td></tr>
												<tr><td><img src="'.$homebase.'/boxed-bg.png" width="95" /></td></tr>
												<tr><td>'.$nama.'</td></tr>
											</table>
										</td>
										<td width="350">'.$tandatangan1.'</td>
									</tr>
								</table>';
			} else {
				if ($tandatangan == '' OR is_null($tandatangan)){
					$tandatangan2	= '<table width="200" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
											<tr><td width="200">&nbsp;</td></tr>
											<tr><td width="200" colspan="2">'.$pemeriksa.'</td></tr>
											<tr>
												<td width="100" align="center">'.$gambarqrcode.'</td>
												<td width="100" align="left" valign="center">&nbsp;</td>
											</tr>
											<tr><td width="200" colspan="2">'.$namapemeriksa.'</td></tr>
										</table>';
				} else {
					$tandatangan2	= '<table width="200" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
											<tr><td width="200">&nbsp;</td></tr>
											<tr><td width="200" colspan="2">'.$pemeriksa.'</td></tr>
											<tr>
												<td width="100" align="center">'.$gambarqrcode.'</td>
												<td width="100" align="left" valign="center">
													'.$jenisfontte.'
														&nbsp;<br />Ditandatangani secara elektronik :<br />
													</font>
												</td>
											</tr>
											<tr><td width="200" colspan="2">'.$namapemeriksa.'</td></tr>
										</table>';
				}
				$pejabatformat3	= '<table width="700" border="0" cellpadding="2" cellspacing="0">
									<tr>
										<td width="200" valign="top" align="center">
											<table width="200" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"> 
												<tr><td width="200">&nbsp;</td></tr>
												<tr><td width="200">Yang Bersangkutan</td></tr>
												<tr><td><img src="'.$homebase.'/boxed-bg.png" width="95" /></td></tr>
												<tr><td>'.$nama.'</td></tr>
											</table>
										</td>
										<td width="200">'.$tandatangan2.'</td>
										<td width="300">'.$tandatangan1.'</td>
									</tr>
								</table>';
			}
			$generatesurat	= str_replace('[pejabatformat3]', $pejabatformat3, $generatesurat);
			
		}
		if ($namask == 'Edaran'){
			$kepada 	= '';
			$arrkepada	= explode('-', $tlskepada);
			foreach($arrkepada as $rkpd){
				if ($kepada == ''){
					$kepada = $rkpd;
				} else {
					$kepada = $kepada.'<br />'.$rkpd;
				}
			}
			$generatesurat	= str_replace('[kepada]', $kepada, $generatesurat);
			$generatesurat	= str_replace('[isisurat]', $isisurat, $generatesurat);
			$generatesurat	= str_replace('[judul]', $judul, $generatesurat);
			$generatesurat	= str_replace('[lampiran]', $lampiran, $generatesurat);
		}
		if ($namask == 'Pemanggilan KIE Staf'){
			$generatesurat	= str_replace('[kepada]', $getdatasrt->kepada, $generatesurat);
			$generatesurat	= str_replace('[mulai]', $mulai, $generatesurat);
			$generatesurat	= str_replace('[waktu]', $waktu, $generatesurat);
			$generatesurat	= str_replace('[tempat]', $tempat, $generatesurat);
			$generatesurat	= str_replace('[perihal]', $getdatasrt->perihal, $generatesurat);
			$generatesurat	= str_replace('[hasil]', $setval05, $generatesurat);
			$generatesurat	= str_replace('[tandatangan2]', $tandatangan2, $generatesurat);
		}
		$generatesurat	= str_replace('[tulisnomor]', $tulisnomor, $generatesurat);
		$generatesurat	= str_replace('[pejabat]', $pejabat, $generatesurat);
		$generatesurat	= str_replace('[namapejabat]', $rektor, $generatesurat);
		$generatesurat	= str_replace('[alamatpejabat]', $alamatpejabat, $generatesurat);
		$generatesurat	= str_replace('[nama]', $nama, $generatesurat);
		$generatesurat	= str_replace('>Malang, [tglsp]', 'align="right">Malang, '.$tglsp, $generatesurat);
		$generatesurat	= str_replace('[tglsp]', $tglsp, $generatesurat);
		$generatesurat	= str_replace('[jab_fungsional]', $jabatan, $generatesurat);
		$generatesurat	= str_replace('[tandatangan1]', $tandatangan1, $generatesurat);
	} else {
		$gceksrtklr			= Suratkeluartnpnomor::where('id', $id)->first();
		$idsurat 			= $gceksrtklr->id;
		$marking 			= $gceksrtklr->marking;
		$tglbuat 			= $gceksrtklr->tglbuat;
		$yersrt				= $gceksrtklr->yersrt;
		$nomor 				= $gceksrtklr->nomor;
		$anakno				= $gceksrtklr->anakno;
		$kodefak			= $gceksrtklr->kodefak;
		$jenissrt			= $gceksrtklr->jenissrt;
		$dasarsurat			= $gceksrtklr->dasarsurat;
		$unit 				= $gceksrtklr->unit;
		$tglsurat			= $gceksrtklr->tglsurat;
		$kepada 			= $gceksrtklr->kepada;
		$perihal 			= $gceksrtklr->perihal;
		$alamat 			= $gceksrtklr->alamat;
		$lampiran 			= $gceksrtklr->lampiran;
		$klasifikasi 		= $gceksrtklr->klasifikasi;
		$pembuat			= $gceksrtklr->pembuat;
		$unit 				= $gceksrtklr->unit;
		$isisurat 			= $gceksrtklr->isisurat;
		$idpejabat 			= $gceksrtklr->idpejabat;
		$pejabat 			= $gceksrtklr->pejabat;
		$namapejabat		= $gceksrtklr->namapejabat;
		$tembusan 			= $gceksrtklr->tembusan;
		$status 			= $gceksrtklr->status;
		$tandatangan		= $gceksrtklr->tandatangan;
		$footnote			= $gceksrtklr->footnote;
		$lebarttd			= $gceksrtklr->lebarttd;
		$fakultas			= $gceksrtklr->fakultas;
		$created_at			= $gceksrtklr->created_at;
		$tte1				= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
		$tte2				= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
		$tte3				= '<img src="'.$homebase.'/boxed-bg.png" width="100" />';
		$getpembuat 		= Simpegpegawai::where('email', $pembuat)->first();
		if (isset($getpembuat->id)){
			$nmpembuat 		= $getpembuat->nama_lengkap;
			$jabpembuat 	= $getpembuat->jabatan;
		} else {
			$nmpembuat		= $pembuat;
			$jabpembuat		= '';
		}
		$getparaf1 			= Pejabatsurat::where('id', $gceksrtklr->paraf1)->first();
		if (isset($getparaf1->id)){
			$nmparaf1 		= $getparaf1->nama;
			$jabparaf1 		= $getparaf1->pejabat;
		} else {
			$nmparaf1		= $gceksrtklr->paraf1;
			$jabparaf1		= '';
		}
		$getparaf2 			= Pejabatsurat::where('id', $gceksrtklr->paraf2)->first();
		if (isset($getparaf2->id)){
			$nmparaf2 		= $getparaf2->nama;
			$jabparaf2 		= $getparaf2->pejabat;
		} else {
			$nmparaf2		= $gceksrtklr->paraf2;
			$jabparaf2		= '';
		}
		$getparaf3			= Pejabatsurat::where('id', $gceksrtklr->paraf3)->first();
		if (isset($getparaf3->id)){
			$nmparaf3 		= $getparaf3->nama;
			$jabparaf3 		= $getparaf3->pejabat;
		} else {
			$nmparaf3		= $gceksrtklr->paraf3;
			$jabparaf3		= '';
		}
		if ($jenissrt == 'Jadwal Sif'){
			$generatesurat 	= '<table width="700" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"><tr><td colspan="7" width="700">&nbsp;</td></tr><tr><td colspan="7" width="700">&nbsp;</td></tr><tr><td colspan="7" width="700">&nbsp;</td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">&nbsp;</td><td width="10">&nbsp;</td><td width="250">&nbsp;</td><td width="300"></td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">Hal</td><td width="10">:</td><td width="500" colspan="2">'.$gceksrtklr->perihal.'</td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">Yth.</td><td width="10">:</td><td width="250">'.$gceksrtklr->namapejabat.'</td><td width="300"></td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">&nbsp;</td><td width="10">&nbsp;</td><td width="250">'.$gceksrtklr->pejabat.'</td><td width="300"></td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">Pengirim</td><td width="10">:</td><td width="250">'.$nmpembuat.'</td><td width="300"></td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">&nbsp;</td><td width="10">&nbsp;</td><td width="250">'.$jabpembuat.'</td><td width="300"></td></tr>';
			$generatesurat	= $generatesurat.'<tr><td colspan="5" width="720">';
			$getakhr 		= explode(' s/d ', $isisurat);
			$kolomatas 		= '';
			if (isset($getakhr[1])){
				$mulai 			= $getakhr[0];
				$akhir 			= $getakhr[1];
				$start_time 	= strtotime($mulai);
				$from     		= Carbon::createFromFormat('Y-m-d', $mulai);
				$to     		= Carbon::createFromFormat('Y-m-d', $akhir);
				$diff_in_days 	= $from->diffInDays($to);
				$diff_in_days++;
				$end_time 		= strtotime("+".$diff_in_days." days", $start_time);
				for($i=$start_time; $i<$end_time; $i+=86400) {
					$list[] = date('Y-m-d', $i);
				}
				$generatesurat	= $generatesurat.'<table border="1" cellpadding="0" cellspacing="0"><thead><tr style="line-height: 5px; height: 5px;"><th width="25" align="center"><strong><p>NO</p></strong></th><th width="150" align="center"><strong><p>NAMA</p></strong></th>';
				$nomor 			= 1;
				$kolomatas		= '<table border="1" cellpadding="0" cellspacing="0"><thead><tr style="line-height: 5px; height: 5px;"><th width="25" align="center"><strong><p>NO</p></strong></th><th width="150" align="center"><strong>KELOMPOK</strong></th>';
				foreach($list as $arrtgl){
					$gettanggal 	= explode('-', $arrtgl);
					$generatesurat	= $generatesurat.'<th width="30" align="center"><strong><p>'.$gettanggal[2].'</p></strong></th>';
					$kolomatas		= $kolomatas.'<th width="30" align="center"><strong><p>'.$gettanggal[2].'</p></strong></th>';
					$nomor++;
				}
				if ($nomor != 35){
					for($i=$nomor; $i<36; $i++) {
						$generatesurat	= $generatesurat.'<th width="30" align="center"><p>-</p></th>';
						$kolomatas		= $kolomatas.'<th width="30" align="center"><p>-</p></th>';
					}
				}
				$generatesurat	= $generatesurat.'</tr></thead><tbody>';
				$kolomatas		= $kolomatas.'</tr></thead><tbody>';
				$nomor 			= 1;
				$sif 			= 0;
				
				$jumlah1_p 		= 0;
				$jumlah1_s 		= 0;
				$jumlah1_m 		= 0;
				$jumlah1_ms 	= 0;
				$jumlah1_pd 	= 0;
				$jumlah1_sd 	= 0;
				$jumlah1_md 	= 0;
				$jumlah1_mp 	= 0;
				$jumlah1_m2 	= 0;
				$jumlah1_m3 	= 0;
				$jumlah1_n 		= 0;
				$jumlah1_off 	= 0;
				$jumlah1_cuti 	= 0;
				$jumlah1_ll 	= 0;
				$jumlah1_dl 	= 0;

				$jumlah2_p 		= 0;
				$jumlah2_s 		= 0;
				$jumlah2_m 		= 0;
				$jumlah2_ms 	= 0;
				$jumlah2_pd 	= 0;
				$jumlah2_sd 	= 0;
				$jumlah2_md 	= 0;
				$jumlah2_mp 	= 0;
				$jumlah2_m2 	= 0;
				$jumlah2_m3 	= 0;
				$jumlah2_n 		= 0;
				$jumlah2_off 	= 0;
				$jumlah2_cuti 	= 0;
				$jumlah2_ll 	= 0;
				$jumlah2_dl 	= 0;

				$jumlah3_p 		= 0;
				$jumlah3_s 		= 0;
				$jumlah3_m 		= 0;
				$jumlah3_ms 	= 0;
				$jumlah3_pd 	= 0;
				$jumlah3_sd 	= 0;
				$jumlah3_md 	= 0;
				$jumlah3_mp 	= 0;
				$jumlah3_m2 	= 0;
				$jumlah3_m3 	= 0;
				$jumlah3_n 		= 0;
				$jumlah3_off 	= 0;
				$jumlah3_cuti 	= 0;
				$jumlah3_ll 	= 0;
				$jumlah3_dl 	= 0;

				$jumlah4_p 		= 0;
				$jumlah4_s 		= 0;
				$jumlah4_m 		= 0;
				$jumlah4_ms 	= 0;
				$jumlah4_pd 	= 0;
				$jumlah4_sd 	= 0;
				$jumlah4_md 	= 0;
				$jumlah4_mp 	= 0;
				$jumlah4_m2 	= 0;
				$jumlah4_m3 	= 0;
				$jumlah4_n 		= 0;
				$jumlah4_off 	= 0;
				$jumlah4_cuti 	= 0;
				$jumlah4_ll 	= 0;
				$jumlah4_dl 	= 0;

				$jumlah5_p 		= 0;
				$jumlah5_s 		= 0;
				$jumlah5_m 		= 0;
				$jumlah5_ms 	= 0;
				$jumlah5_pd 	= 0;
				$jumlah5_sd 	= 0;
				$jumlah5_md 	= 0;
				$jumlah5_mp 	= 0;
				$jumlah5_m2 	= 0;
				$jumlah5_m3 	= 0;
				$jumlah5_n 		= 0;
				$jumlah5_off 	= 0;
				$jumlah5_cuti 	= 0;
				$jumlah5_ll 	= 0;
				$jumlah5_dl 	= 0;

				$jumlah6_p 		= 0;
				$jumlah6_s 		= 0;
				$jumlah6_m 		= 0;
				$jumlah6_ms 	= 0;
				$jumlah6_pd 	= 0;
				$jumlah6_sd 	= 0;
				$jumlah6_md 	= 0;
				$jumlah6_mp 	= 0;
				$jumlah6_m2 	= 0;
				$jumlah6_m3 	= 0;
				$jumlah6_n 		= 0;
				$jumlah6_off 	= 0;
				$jumlah6_cuti 	= 0;
				$jumlah6_ll 	= 0;
				$jumlah6_dl 	= 0;

				$jumlah7_p 		= 0;
				$jumlah7_s 		= 0;
				$jumlah7_m 		= 0;
				$jumlah7_ms 	= 0;
				$jumlah7_pd 	= 0;
				$jumlah7_sd 	= 0;
				$jumlah7_md 	= 0;
				$jumlah7_mp 	= 0;
				$jumlah7_m2 	= 0;
				$jumlah7_m3 	= 0;
				$jumlah7_n 		= 0;
				$jumlah7_off 	= 0;
				$jumlah7_cuti 	= 0;
				$jumlah7_ll 	= 0;
				$jumlah7_dl 	= 0;

				$jumlah8_p 		= 0;
				$jumlah8_s 		= 0;
				$jumlah8_m 		= 0;
				$jumlah8_ms 	= 0;
				$jumlah8_pd 	= 0;
				$jumlah8_sd 	= 0;
				$jumlah8_md 	= 0;
				$jumlah8_mp 	= 0;
				$jumlah8_m2 	= 0;
				$jumlah8_m3 	= 0;
				$jumlah8_n 		= 0;
				$jumlah8_off 	= 0;
				$jumlah8_cuti 	= 0;
				$jumlah8_ll 	= 0;
				$jumlah8_dl 	= 0;

				$jumlah9_p 		= 0;
				$jumlah9_s 		= 0;
				$jumlah9_m 		= 0;
				$jumlah9_ms 	= 0;
				$jumlah9_pd 	= 0;
				$jumlah9_sd 	= 0;
				$jumlah9_md 	= 0;
				$jumlah9_mp 	= 0;
				$jumlah9_m2 	= 0;
				$jumlah9_m3 	= 0;
				$jumlah9_n 		= 0;
				$jumlah9_off 	= 0;
				$jumlah9_cuti 	= 0;
				$jumlah9_ll 	= 0;
				$jumlah9_dl 	= 0;

				$jumlah10_p 	= 0;
				$jumlah10_s 	= 0;
				$jumlah10_m 	= 0;
				$jumlah10_ms 	= 0;
				$jumlah10_pd 	= 0;
				$jumlah10_sd 	= 0;
				$jumlah10_md 	= 0;
				$jumlah10_mp 	= 0;
				$jumlah10_m2 	= 0;
				$jumlah10_m3 	= 0;
				$jumlah10_n 	= 0;
				$jumlah10_off 	= 0;
				$jumlah10_cuti 	= 0;
				$jumlah10_ll 	= 0;
				$jumlah10_dl 	= 0;

				$jumlah11_p 	= 0;
				$jumlah11_s 	= 0;
				$jumlah11_m 	= 0;
				$jumlah11_ms 	= 0;
				$jumlah11_pd 	= 0;
				$jumlah11_sd 	= 0;
				$jumlah11_md 	= 0;
				$jumlah11_mp 	= 0;
				$jumlah11_m2 	= 0;
				$jumlah11_m3 	= 0;
				$jumlah11_n 	= 0;
				$jumlah11_off 	= 0;
				$jumlah11_cuti 	= 0;
				$jumlah11_ll 	= 0;
				$jumlah11_dl 	= 0;

				$jumlah12_p 	= 0;
				$jumlah12_s 	= 0;
				$jumlah12_m 	= 0;
				$jumlah12_ms 	= 0;
				$jumlah12_pd 	= 0;
				$jumlah12_sd 	= 0;
				$jumlah12_md 	= 0;
				$jumlah12_mp 	= 0;
				$jumlah12_m2 	= 0;
				$jumlah12_m3 	= 0;
				$jumlah12_n 	= 0;
				$jumlah12_off 	= 0;
				$jumlah12_cuti 	= 0;
				$jumlah12_ll 	= 0;
				$jumlah12_dl 	= 0;

				$jumlah13_p 	= 0;
				$jumlah13_s 	= 0;
				$jumlah13_m 	= 0;
				$jumlah13_ms 	= 0;
				$jumlah13_pd 	= 0;
				$jumlah13_sd 	= 0;
				$jumlah13_md 	= 0;
				$jumlah13_mp 	= 0;
				$jumlah13_m2 	= 0;
				$jumlah13_m3 	= 0;
				$jumlah13_n 	= 0;
				$jumlah13_off 	= 0;
				$jumlah13_cuti 	= 0;
				$jumlah13_ll 	= 0;
				$jumlah13_dl 	= 0;

				$jumlah14_p 	= 0;
				$jumlah14_s 	= 0;
				$jumlah14_m 	= 0;
				$jumlah14_ms 	= 0;
				$jumlah14_pd 	= 0;
				$jumlah14_sd 	= 0;
				$jumlah14_md 	= 0;
				$jumlah14_mp 	= 0;
				$jumlah14_m2 	= 0;
				$jumlah14_m3 	= 0;
				$jumlah14_n 	= 0;
				$jumlah14_off 	= 0;
				$jumlah14_cuti 	= 0;
				$jumlah14_ll 	= 0;
				$jumlah14_dl 	= 0;

				$jumlah15_p 	= 0;
				$jumlah15_s 	= 0;
				$jumlah15_m 	= 0;
				$jumlah15_ms 	= 0;
				$jumlah15_pd 	= 0;
				$jumlah15_sd 	= 0;
				$jumlah15_md 	= 0;
				$jumlah15_mp 	= 0;
				$jumlah15_m2 	= 0;
				$jumlah15_m3 	= 0;
				$jumlah15_n 	= 0;
				$jumlah15_off 	= 0;
				$jumlah15_cuti 	= 0;
				$jumlah15_ll 	= 0;
				$jumlah15_dl 	= 0;

				$jumlah16_p 	= 0;
				$jumlah16_s 	= 0;
				$jumlah16_m 	= 0;
				$jumlah16_ms 	= 0;
				$jumlah16_pd 	= 0;
				$jumlah16_sd 	= 0;
				$jumlah16_md 	= 0;
				$jumlah16_mp 	= 0;
				$jumlah16_m2 	= 0;
				$jumlah16_m3 	= 0;
				$jumlah16_n 	= 0;
				$jumlah16_off 	= 0;
				$jumlah16_cuti 	= 0;
				$jumlah16_ll 	= 0;
				$jumlah16_dl 	= 0;

				$jumlah17_p 	= 0;
				$jumlah17_s 	= 0;
				$jumlah17_m 	= 0;
				$jumlah17_ms 	= 0;
				$jumlah17_pd 	= 0;
				$jumlah17_sd 	= 0;
				$jumlah17_md 	= 0;
				$jumlah17_mp 	= 0;
				$jumlah17_m2 	= 0;
				$jumlah17_m3 	= 0;
				$jumlah17_n 	= 0;
				$jumlah17_off 	= 0;
				$jumlah17_cuti 	= 0;
				$jumlah17_ll 	= 0;
				$jumlah17_dl 	= 0;

				$jumlah18_p 	= 0;
				$jumlah18_s 	= 0;
				$jumlah18_m 	= 0;
				$jumlah18_ms 	= 0;
				$jumlah18_pd 	= 0;
				$jumlah18_sd 	= 0;
				$jumlah18_md 	= 0;
				$jumlah18_mp 	= 0;
				$jumlah18_m2 	= 0;
				$jumlah18_m3 	= 0;
				$jumlah18_n 	= 0;
				$jumlah18_off 	= 0;
				$jumlah18_cuti 	= 0;
				$jumlah18_ll 	= 0;
				$jumlah18_dl 	= 0;

				$jumlah19_p 	= 0;
				$jumlah19_s 	= 0;
				$jumlah19_m 	= 0;
				$jumlah19_ms 	= 0;
				$jumlah19_pd 	= 0;
				$jumlah19_sd 	= 0;
				$jumlah19_md 	= 0;
				$jumlah19_mp 	= 0;
				$jumlah19_m2 	= 0;
				$jumlah19_m3 	= 0;
				$jumlah19_n 	= 0;
				$jumlah19_off 	= 0;
				$jumlah19_cuti 	= 0;
				$jumlah19_ll 	= 0;
				$jumlah19_dl 	= 0;

				$jumlah20_p 	= 0;
				$jumlah20_s 	= 0;
				$jumlah20_m 	= 0;
				$jumlah20_ms 	= 0;
				$jumlah20_pd 	= 0;
				$jumlah20_sd 	= 0;
				$jumlah20_md 	= 0;
				$jumlah20_mp 	= 0;
				$jumlah20_m2 	= 0;
				$jumlah20_m3 	= 0;
				$jumlah20_n 	= 0;
				$jumlah20_off 	= 0;
				$jumlah20_cuti 	= 0;
				$jumlah20_ll 	= 0;
				$jumlah20_dl 	= 0;

				$jumlah21_p 	= 0;
				$jumlah21_s 	= 0;
				$jumlah21_m 	= 0;
				$jumlah21_ms 	= 0;
				$jumlah21_pd 	= 0;
				$jumlah21_sd 	= 0;
				$jumlah21_md 	= 0;
				$jumlah21_mp 	= 0;
				$jumlah21_m2 	= 0;
				$jumlah21_m3 	= 0;
				$jumlah21_n 	= 0;
				$jumlah21_off 	= 0;
				$jumlah21_cuti 	= 0;
				$jumlah21_ll 	= 0;
				$jumlah21_dl 	= 0;

				$jumlah22_p 	= 0;
				$jumlah22_s 	= 0;
				$jumlah22_m 	= 0;
				$jumlah22_ms 	= 0;
				$jumlah22_pd 	= 0;
				$jumlah22_sd 	= 0;
				$jumlah22_md 	= 0;
				$jumlah22_mp 	= 0;
				$jumlah22_m2 	= 0;
				$jumlah22_m3 	= 0;
				$jumlah22_n 	= 0;
				$jumlah22_off 	= 0;
				$jumlah22_cuti 	= 0;
				$jumlah22_ll 	= 0;
				$jumlah22_dl 	= 0;

				$jumlah23_p 	= 0;
				$jumlah23_s 	= 0;
				$jumlah23_m 	= 0;
				$jumlah23_ms 	= 0;
				$jumlah23_pd 	= 0;
				$jumlah23_sd 	= 0;
				$jumlah23_md 	= 0;
				$jumlah23_mp 	= 0;
				$jumlah23_m2 	= 0;
				$jumlah23_m3 	= 0;
				$jumlah23_n 	= 0;
				$jumlah23_off 	= 0;
				$jumlah23_cuti 	= 0;
				$jumlah23_ll 	= 0;
				$jumlah23_dl 	= 0;

				$jumlah24_p 	= 0;
				$jumlah24_s 	= 0;
				$jumlah24_m 	= 0;
				$jumlah24_ms 	= 0;
				$jumlah24_pd 	= 0;
				$jumlah24_sd 	= 0;
				$jumlah24_md 	= 0;
				$jumlah24_mp 	= 0;
				$jumlah24_m2 	= 0;
				$jumlah24_m3 	= 0;
				$jumlah24_n 	= 0;
				$jumlah24_off 	= 0;
				$jumlah24_cuti 	= 0;
				$jumlah24_ll 	= 0;
				$jumlah24_dl 	= 0;

				$jumlah25_p 	= 0;
				$jumlah25_s 	= 0;
				$jumlah25_m 	= 0;
				$jumlah25_ms 	= 0;
				$jumlah25_pd 	= 0;
				$jumlah25_sd 	= 0;
				$jumlah25_md 	= 0;
				$jumlah25_mp 	= 0;
				$jumlah25_m2 	= 0;
				$jumlah25_m3 	= 0;
				$jumlah25_n 	= 0;
				$jumlah25_off 	= 0;
				$jumlah25_cuti 	= 0;
				$jumlah25_ll 	= 0;
				$jumlah25_dl 	= 0;

				$jumlah26_p 	= 0;
				$jumlah26_s 	= 0;
				$jumlah26_m 	= 0;
				$jumlah26_ms 	= 0;
				$jumlah26_pd 	= 0;
				$jumlah26_sd 	= 0;
				$jumlah26_md 	= 0;
				$jumlah26_mp 	= 0;
				$jumlah26_m2 	= 0;
				$jumlah26_m3 	= 0;
				$jumlah26_n 	= 0;
				$jumlah26_off 	= 0;
				$jumlah26_cuti 	= 0;
				$jumlah26_ll 	= 0;
				$jumlah26_dl 	= 0;

				$jumlah27_p 	= 0;
				$jumlah27_s 	= 0;
				$jumlah27_m 	= 0;
				$jumlah27_ms 	= 0;
				$jumlah27_pd 	= 0;
				$jumlah27_sd 	= 0;
				$jumlah27_md 	= 0;
				$jumlah27_mp 	= 0;
				$jumlah27_m2 	= 0;
				$jumlah27_m3 	= 0;
				$jumlah27_n 	= 0;
				$jumlah27_off 	= 0;
				$jumlah27_cuti 	= 0;
				$jumlah27_ll 	= 0;
				$jumlah27_dl 	= 0;

				$jumlah28_p 	= 0;
				$jumlah28_s 	= 0;
				$jumlah28_m 	= 0;
				$jumlah28_ms 	= 0;
				$jumlah28_pd 	= 0;
				$jumlah28_sd 	= 0;
				$jumlah28_md 	= 0;
				$jumlah28_mp 	= 0;
				$jumlah28_m2 	= 0;
				$jumlah28_m3 	= 0;
				$jumlah28_n 	= 0;
				$jumlah28_off 	= 0;
				$jumlah28_cuti 	= 0;
				$jumlah28_ll 	= 0;
				$jumlah28_dl 	= 0;

				$jumlah29_p 	= 0;
				$jumlah29_s 	= 0;
				$jumlah29_m 	= 0;
				$jumlah29_ms 	= 0;
				$jumlah29_pd 	= 0;
				$jumlah29_sd 	= 0;
				$jumlah29_md 	= 0;
				$jumlah29_mp 	= 0;
				$jumlah29_m2 	= 0;
				$jumlah29_m3 	= 0;
				$jumlah29_n 	= 0;
				$jumlah29_off 	= 0;
				$jumlah29_cuti 	= 0;
				$jumlah29_ll 	= 0;
				$jumlah29_dl 	= 0;

				$jumlah30_p 	= 0;
				$jumlah30_s 	= 0;
				$jumlah30_m 	= 0;
				$jumlah30_ms 	= 0;
				$jumlah30_pd 	= 0;
				$jumlah30_sd 	= 0;
				$jumlah30_md 	= 0;
				$jumlah30_mp 	= 0;
				$jumlah30_m2 	= 0;
				$jumlah30_m3 	= 0;
				$jumlah30_n 	= 0;
				$jumlah30_off 	= 0;
				$jumlah30_cuti 	= 0;
				$jumlah30_ll 	= 0;
				$jumlah30_dl 	= 0;

				$jumlah31_p 	= 0;
				$jumlah31_s 	= 0;
				$jumlah31_m 	= 0;
				$jumlah31_ms 	= 0;
				$jumlah31_pd 	= 0;
				$jumlah31_sd 	= 0;
				$jumlah31_md 	= 0;
				$jumlah31_mp 	= 0;
				$jumlah31_m2 	= 0;
				$jumlah31_m3 	= 0;
				$jumlah31_n 	= 0;
				$jumlah31_off 	= 0;
				$jumlah31_cuti 	= 0;
				$jumlah31_ll 	= 0;
				$jumlah31_dl 	= 0;

				$jumlah32_p 	= 0;
				$jumlah32_s 	= 0;
				$jumlah32_m 	= 0;
				$jumlah32_ms 	= 0;
				$jumlah32_pd 	= 0;
				$jumlah32_sd 	= 0;
				$jumlah32_md 	= 0;
				$jumlah32_mp 	= 0;
				$jumlah32_m2 	= 0;
				$jumlah32_m3 	= 0;
				$jumlah32_n 	= 0;
				$jumlah32_off 	= 0;
				$jumlah32_cuti 	= 0;
				$jumlah32_ll 	= 0;
				$jumlah32_dl 	= 0;

				$jumlah33_p 	= 0;
				$jumlah33_s 	= 0;
				$jumlah33_m 	= 0;
				$jumlah33_ms 	= 0;
				$jumlah33_pd 	= 0;
				$jumlah33_sd 	= 0;
				$jumlah33_md 	= 0;
				$jumlah33_mp 	= 0;
				$jumlah33_m2 	= 0;
				$jumlah33_m3 	= 0;
				$jumlah33_n 	= 0;
				$jumlah33_off 	= 0;
				$jumlah33_cuti 	= 0;
				$jumlah33_ll 	= 0;
				$jumlah33_dl 	= 0;

				$jumlah34_p 	= 0;
				$jumlah34_s 	= 0;
				$jumlah34_m 	= 0;
				$jumlah34_ms 	= 0;
				$jumlah34_pd 	= 0;
				$jumlah34_sd 	= 0;
				$jumlah34_md 	= 0;
				$jumlah34_mp 	= 0;
				$jumlah34_m2 	= 0;
				$jumlah34_m3 	= 0;
				$jumlah34_n 	= 0;
				$jumlah34_off 	= 0;
				$jumlah34_cuti 	= 0;
				$jumlah34_ll 	= 0;
				$jumlah34_dl 	= 0;

				$jumlah35_p 	= 0;
				$jumlah35_s 	= 0;
				$jumlah35_m 	= 0;
				$jumlah35_ms 	= 0;
				$jumlah35_pd 	= 0;
				$jumlah35_sd 	= 0;
				$jumlah35_md 	= 0;
				$jumlah35_mp 	= 0;
				$jumlah35_m2 	= 0;
				$jumlah35_m3 	= 0;
				$jumlah35_n 	= 0;
				$jumlah35_off 	= 0;
				$jumlah35_cuti 	= 0;
				$jumlah35_ll 	= 0;
				$jumlah35_dl 	= 0;
				$getalllist 	= RekapPresensi::where('rangepresensi', $gceksrtklr->isisurat)->where('created_by', $gceksrtklr->pembuat)->get();
				foreach($getalllist as $rlist){
					$pegawai 	= substr($rlist->nama, 0, 25) . '.';
					$cekdidb 	= DB::table('db_hitungpresensi')->where('nama', $rlist->nama)->where('pin', $rlist->pin)->where('fakultas', $rlist->fakultas)->where('marking', $rlist->rangepresensi)->count();
					if ($cekdidb == 0){
						DB::table('db_hitungpresensi')->insert([
							'nama'			=> $rlist->nama,
							'pin'			=> $rlist->pin,
							'marking'		=> $rlist->rangepresensi,
							'jumlahktl'		=> 0,
							'jumlahpws'		=> 0,
							'total'			=> 0,
							'menit'			=> 0,
							'jabatan'		=> $rlist->jabatan,
							'unitkerja'		=> $rlist->unit,
							'fakultas'		=> $rlist->fakultas,
						]);
					}
					if ($rlist->day01 == 'P'){ $jumlah1_p++; }
					if ($rlist->day01 == 'S'){ $jumlah1_s++; }
					if ($rlist->day01 == 'M'){ $jumlah1_m++; }
					if ($rlist->day01 == 'MS'){ $jumlah1_ms++; }
					if ($rlist->day01 == 'PD'){ $jumlah1_pd++; }
					if ($rlist->day01 == 'SD'){ $jumlah1_sd++; }
					if ($rlist->day01 == 'MD'){ $jumlah1_md++; }
					if ($rlist->day01 == 'MP'){ $jumlah1_mp++; }
					if ($rlist->day01 == 'M2'){ $jumlah1_m2++; }
					if ($rlist->day01 == 'M3'){ $jumlah1_m3++; }
					if ($rlist->day01 == 'N'){ $jumlah1_n++; }
					if ($rlist->day01 == 'OFF'){ $jumlah1_off++; }
					if ($rlist->day01 == 'Cuti'){ $jumlah1_cuti++; }
					if ($rlist->day01 == 'LL'){ $jumlah1_ll++; }
					if ($rlist->day01 == 'DL'){ $jumlah1_dl++; }

					if ($rlist->day02 == 'P'){ $jumlah2_p++; }
					if ($rlist->day02 == 'S'){ $jumlah2_s++; }
					if ($rlist->day02 == 'M'){ $jumlah2_m++; }
					if ($rlist->day02 == 'MS'){ $jumlah2_ms++; }
					if ($rlist->day02 == 'PD'){ $jumlah2_pd++; }
					if ($rlist->day02 == 'SD'){ $jumlah2_sd++; }
					if ($rlist->day02 == 'MD'){ $jumlah2_md++; }
					if ($rlist->day02 == 'MP'){ $jumlah2_mp++; }
					if ($rlist->day02 == 'M2'){ $jumlah2_m2++; }
					if ($rlist->day02 == 'M3'){ $jumlah2_m3++; }
					if ($rlist->day02 == 'N'){ $jumlah2_n++; }
					if ($rlist->day02 == 'OFF'){ $jumlah2_off++; }
					if ($rlist->day02 == 'Cuti'){ $jumlah2_cuti++; }
					if ($rlist->day02 == 'LL'){ $jumlah2_ll++; }
					if ($rlist->day02 == 'DL'){ $jumlah2_dl++; }

					if ($rlist->day03 == 'P'){ $jumlah3_p++; }
					if ($rlist->day03 == 'S'){ $jumlah3_s++; }
					if ($rlist->day03 == 'M'){ $jumlah3_m++; }
					if ($rlist->day03 == 'MS'){ $jumlah3_ms++; }
					if ($rlist->day03 == 'PD'){ $jumlah3_pd++; }
					if ($rlist->day03 == 'SD'){ $jumlah3_sd++; }
					if ($rlist->day03 == 'MD'){ $jumlah3_md++; }
					if ($rlist->day03 == 'MP'){ $jumlah3_mp++; }
					if ($rlist->day03 == 'M2'){ $jumlah3_m2++; }
					if ($rlist->day03 == 'M3'){ $jumlah3_m3++; }
					if ($rlist->day03 == 'N'){ $jumlah3_n++; }
					if ($rlist->day03 == 'OFF'){ $jumlah3_off++; }
					if ($rlist->day03 == 'Cuti'){ $jumlah3_cuti++; }
					if ($rlist->day03 == 'LL'){ $jumlah3_ll++; }
					if ($rlist->day03 == 'DL'){ $jumlah3_dl++; }

					if ($rlist->day04 == 'P'){ $jumlah4_p++; }
					if ($rlist->day04 == 'S'){ $jumlah4_s++; }
					if ($rlist->day04 == 'M'){ $jumlah4_m++; }
					if ($rlist->day04 == 'MS'){ $jumlah4_ms++; }
					if ($rlist->day04 == 'PD'){ $jumlah4_pd++; }
					if ($rlist->day04 == 'SD'){ $jumlah4_sd++; }
					if ($rlist->day04 == 'MD'){ $jumlah4_md++; }
					if ($rlist->day04 == 'MP'){ $jumlah4_mp++; }
					if ($rlist->day04 == 'M2'){ $jumlah4_m2++; }
					if ($rlist->day04 == 'M3'){ $jumlah4_m3++; }
					if ($rlist->day04 == 'N'){ $jumlah4_n++; }
					if ($rlist->day04 == 'OFF'){ $jumlah4_off++; }
					if ($rlist->day04 == 'Cuti'){ $jumlah4_cuti++; }
					if ($rlist->day04 == 'LL'){ $jumlah4_ll++; }
					if ($rlist->day04 == 'DL'){ $jumlah4_dl++; }

					if ($rlist->day05 == 'P'){ $jumlah5_p++; }
					if ($rlist->day05 == 'S'){ $jumlah5_s++; }
					if ($rlist->day05 == 'M'){ $jumlah5_m++; }
					if ($rlist->day05 == 'MS'){ $jumlah5_ms++; }
					if ($rlist->day05 == 'PD'){ $jumlah5_pd++; }
					if ($rlist->day05 == 'SD'){ $jumlah5_sd++; }
					if ($rlist->day05 == 'MD'){ $jumlah5_md++; }
					if ($rlist->day05 == 'MP'){ $jumlah5_mp++; }
					if ($rlist->day05 == 'M2'){ $jumlah5_m2++; }
					if ($rlist->day05 == 'M3'){ $jumlah5_m3++; }
					if ($rlist->day05 == 'N'){ $jumlah5_n++; }
					if ($rlist->day05 == 'OFF'){ $jumlah5_off++; }
					if ($rlist->day05 == 'Cuti'){ $jumlah5_cuti++; }
					if ($rlist->day05 == 'LL'){ $jumlah5_ll++; }
					if ($rlist->day05 == 'DL'){ $jumlah5_dl++; }

					if ($rlist->day06 == 'P'){ $jumlah6_p++; }
					if ($rlist->day06 == 'S'){ $jumlah6_s++; }
					if ($rlist->day06 == 'M'){ $jumlah6_m++; }
					if ($rlist->day06 == 'MS'){ $jumlah6_ms++; }
					if ($rlist->day06 == 'PD'){ $jumlah6_pd++; }
					if ($rlist->day06 == 'SD'){ $jumlah6_sd++; }
					if ($rlist->day06 == 'MD'){ $jumlah6_md++; }
					if ($rlist->day06 == 'MP'){ $jumlah6_mp++; }
					if ($rlist->day06 == 'M2'){ $jumlah6_m2++; }
					if ($rlist->day06 == 'M3'){ $jumlah6_m3++; }
					if ($rlist->day06 == 'N'){ $jumlah6_n++; }
					if ($rlist->day06 == 'OFF'){ $jumlah6_off++; }
					if ($rlist->day06 == 'Cuti'){ $jumlah6_cuti++; }
					if ($rlist->day06 == 'LL'){ $jumlah6_ll++; }
					if ($rlist->day06 == 'DL'){ $jumlah6_dl++; }

					if ($rlist->day07 == 'P'){ $jumlah7_p++; }
					if ($rlist->day07 == 'S'){ $jumlah7_s++; }
					if ($rlist->day07 == 'M'){ $jumlah7_m++; }
					if ($rlist->day07 == 'MS'){ $jumlah7_ms++; }
					if ($rlist->day07 == 'PD'){ $jumlah7_pd++; }
					if ($rlist->day07 == 'SD'){ $jumlah7_sd++; }
					if ($rlist->day07 == 'MD'){ $jumlah7_md++; }
					if ($rlist->day07 == 'MP'){ $jumlah7_mp++; }
					if ($rlist->day07 == 'M2'){ $jumlah7_m2++; }
					if ($rlist->day07 == 'M3'){ $jumlah7_m3++; }
					if ($rlist->day07 == 'N'){ $jumlah7_n++; }
					if ($rlist->day07 == 'OFF'){ $jumlah7_off++; }
					if ($rlist->day07 == 'Cuti'){ $jumlah7_cuti++; }
					if ($rlist->day07 == 'LL'){ $jumlah7_ll++; }
					if ($rlist->day07 == 'DL'){ $jumlah7_dl++; }

					if ($rlist->day08 == 'P'){ $jumlah8_p++; }
					if ($rlist->day08 == 'S'){ $jumlah8_s++; }
					if ($rlist->day08 == 'M'){ $jumlah8_m++; }
					if ($rlist->day08 == 'MS'){ $jumlah8_ms++; }
					if ($rlist->day08 == 'PD'){ $jumlah8_pd++; }
					if ($rlist->day08 == 'SD'){ $jumlah8_sd++; }
					if ($rlist->day08 == 'MD'){ $jumlah8_md++; }
					if ($rlist->day08 == 'MP'){ $jumlah8_mp++; }
					if ($rlist->day08 == 'M2'){ $jumlah8_m2++; }
					if ($rlist->day08 == 'M3'){ $jumlah8_m3++; }
					if ($rlist->day08 == 'N'){ $jumlah8_n++; }
					if ($rlist->day08 == 'OFF'){ $jumlah8_off++; }
					if ($rlist->day08 == 'Cuti'){ $jumlah8_cuti++; }
					if ($rlist->day08 == 'LL'){ $jumlah8_ll++; }
					if ($rlist->day08 == 'DL'){ $jumlah8_dl++; }

					if ($rlist->day09 == 'P'){ $jumlah9_p++; }
					if ($rlist->day09 == 'S'){ $jumlah9_s++; }
					if ($rlist->day09 == 'M'){ $jumlah9_m++; }
					if ($rlist->day09 == 'MS'){ $jumlah9_ms++; }
					if ($rlist->day09 == 'PD'){ $jumlah9_pd++; }
					if ($rlist->day09 == 'SD'){ $jumlah9_sd++; }
					if ($rlist->day09 == 'MD'){ $jumlah9_md++; }
					if ($rlist->day09 == 'MP'){ $jumlah9_mp++; }
					if ($rlist->day09 == 'M2'){ $jumlah9_m2++; }
					if ($rlist->day09 == 'M3'){ $jumlah9_m3++; }
					if ($rlist->day09 == 'N'){ $jumlah9_n++; }
					if ($rlist->day09 == 'OFF'){ $jumlah9_off++; }
					if ($rlist->day09 == 'Cuti'){ $jumlah9_cuti++; }
					if ($rlist->day09 == 'LL'){ $jumlah9_ll++; }
					if ($rlist->day09 == 'DL'){ $jumlah9_dl++; }

					if ($rlist->day10 == 'P'){ $jumlah10_p++; }
					if ($rlist->day10 == 'S'){ $jumlah10_s++; }
					if ($rlist->day10 == 'M'){ $jumlah10_m++; }
					if ($rlist->day10 == 'MS'){ $jumlah10_ms++; }
					if ($rlist->day10 == 'PD'){ $jumlah10_pd++; }
					if ($rlist->day10 == 'SD'){ $jumlah10_sd++; }
					if ($rlist->day10 == 'MD'){ $jumlah10_md++; }
					if ($rlist->day10 == 'MP'){ $jumlah10_mp++; }
					if ($rlist->day10 == 'M2'){ $jumlah10_m2++; }
					if ($rlist->day10 == 'M3'){ $jumlah10_m3++; }
					if ($rlist->day10 == 'N'){ $jumlah10_n++; }
					if ($rlist->day10 == 'OFF'){ $jumlah10_off++; }
					if ($rlist->day10 == 'Cuti'){ $jumlah10_cuti++; }
					if ($rlist->day10 == 'LL'){ $jumlah10_ll++; }
					if ($rlist->day10 == 'DL'){ $jumlah10_dl++; }

					if ($rlist->day11 == 'P'){ $jumlah11_p++; }
					if ($rlist->day11 == 'S'){ $jumlah11_s++; }
					if ($rlist->day11 == 'M'){ $jumlah11_m++; }
					if ($rlist->day11 == 'MS'){ $jumlah11_ms++; }
					if ($rlist->day11 == 'PD'){ $jumlah11_pd++; }
					if ($rlist->day11 == 'SD'){ $jumlah11_sd++; }
					if ($rlist->day11 == 'MD'){ $jumlah11_md++; }
					if ($rlist->day11 == 'MP'){ $jumlah11_mp++; }
					if ($rlist->day11 == 'M2'){ $jumlah11_m2++; }
					if ($rlist->day11 == 'M3'){ $jumlah11_m3++; }
					if ($rlist->day11 == 'N'){ $jumlah11_n++; }
					if ($rlist->day11 == 'OFF'){ $jumlah11_off++; }
					if ($rlist->day11 == 'Cuti'){ $jumlah11_cuti++; }
					if ($rlist->day11 == 'LL'){ $jumlah11_ll++; }
					if ($rlist->day11 == 'DL'){ $jumlah11_dl++; }

					if ($rlist->day12 == 'P'){ $jumlah12_p++; }
					if ($rlist->day12 == 'S'){ $jumlah12_s++; }
					if ($rlist->day12 == 'M'){ $jumlah12_m++; }
					if ($rlist->day12 == 'MS'){ $jumlah12_ms++; }
					if ($rlist->day12 == 'PD'){ $jumlah12_pd++; }
					if ($rlist->day12 == 'SD'){ $jumlah12_sd++; }
					if ($rlist->day12 == 'MD'){ $jumlah12_md++; }
					if ($rlist->day12 == 'MP'){ $jumlah12_mp++; }
					if ($rlist->day12 == 'M2'){ $jumlah12_m2++; }
					if ($rlist->day12 == 'M3'){ $jumlah12_m3++; }
					if ($rlist->day12 == 'N'){ $jumlah12_n++; }
					if ($rlist->day12 == 'OFF'){ $jumlah12_off++; }
					if ($rlist->day12 == 'Cuti'){ $jumlah12_cuti++; }
					if ($rlist->day12 == 'LL'){ $jumlah12_ll++; }
					if ($rlist->day12 == 'DL'){ $jumlah12_dl++; }

					if ($rlist->day13 == 'P'){ $jumlah13_p++; }
					if ($rlist->day13 == 'S'){ $jumlah13_s++; }
					if ($rlist->day13 == 'M'){ $jumlah13_m++; }
					if ($rlist->day13 == 'MS'){ $jumlah13_ms++; }
					if ($rlist->day13 == 'PD'){ $jumlah13_pd++; }
					if ($rlist->day13 == 'SD'){ $jumlah13_sd++; }
					if ($rlist->day13 == 'MD'){ $jumlah13_md++; }
					if ($rlist->day13 == 'MP'){ $jumlah13_mp++; }
					if ($rlist->day13 == 'M2'){ $jumlah13_m2++; }
					if ($rlist->day13 == 'M3'){ $jumlah13_m3++; }
					if ($rlist->day13 == 'N'){ $jumlah13_n++; }
					if ($rlist->day13 == 'OFF'){ $jumlah13_off++; }
					if ($rlist->day13 == 'Cuti'){ $jumlah13_cuti++; }
					if ($rlist->day13 == 'LL'){ $jumlah13_ll++; }
					if ($rlist->day13 == 'DL'){ $jumlah13_dl++; }

					if ($rlist->day14 == 'P'){ $jumlah14_p++; }
					if ($rlist->day14 == 'S'){ $jumlah14_s++; }
					if ($rlist->day14 == 'M'){ $jumlah14_m++; }
					if ($rlist->day14 == 'MS'){ $jumlah14_ms++; }
					if ($rlist->day14 == 'PD'){ $jumlah14_pd++; }
					if ($rlist->day14 == 'SD'){ $jumlah14_sd++; }
					if ($rlist->day14 == 'MD'){ $jumlah14_md++; }
					if ($rlist->day14 == 'MP'){ $jumlah14_mp++; }
					if ($rlist->day14 == 'M2'){ $jumlah14_m2++; }
					if ($rlist->day14 == 'M3'){ $jumlah14_m3++; }
					if ($rlist->day14 == 'N'){ $jumlah14_n++; }
					if ($rlist->day14 == 'OFF'){ $jumlah14_off++; }
					if ($rlist->day14 == 'Cuti'){ $jumlah14_cuti++; }
					if ($rlist->day14 == 'LL'){ $jumlah14_ll++; }
					if ($rlist->day14 == 'DL'){ $jumlah14_dl++; }

					if ($rlist->day15 == 'P'){ $jumlah15_p++; }
					if ($rlist->day15 == 'S'){ $jumlah15_s++; }
					if ($rlist->day15 == 'M'){ $jumlah15_m++; }
					if ($rlist->day15 == 'MS'){ $jumlah15_ms++; }
					if ($rlist->day15 == 'PD'){ $jumlah15_pd++; }
					if ($rlist->day15 == 'SD'){ $jumlah15_sd++; }
					if ($rlist->day15 == 'MD'){ $jumlah15_md++; }
					if ($rlist->day15 == 'MP'){ $jumlah15_mp++; }
					if ($rlist->day15 == 'M2'){ $jumlah15_m2++; }
					if ($rlist->day15 == 'M3'){ $jumlah15_m3++; }
					if ($rlist->day15 == 'N'){ $jumlah15_n++; }
					if ($rlist->day15 == 'OFF'){ $jumlah15_off++; }
					if ($rlist->day15 == 'Cuti'){ $jumlah15_cuti++; }
					if ($rlist->day15 == 'LL'){ $jumlah15_ll++; }
					if ($rlist->day15 == 'DL'){ $jumlah15_dl++; }

					if ($rlist->day16 == 'P'){ $jumlah16_p++; }
					if ($rlist->day16 == 'S'){ $jumlah16_s++; }
					if ($rlist->day16 == 'M'){ $jumlah16_m++; }
					if ($rlist->day16 == 'MS'){ $jumlah16_ms++; }
					if ($rlist->day16 == 'PD'){ $jumlah16_pd++; }
					if ($rlist->day16 == 'SD'){ $jumlah16_sd++; }
					if ($rlist->day16 == 'MD'){ $jumlah16_md++; }
					if ($rlist->day16 == 'MP'){ $jumlah16_mp++; }
					if ($rlist->day16 == 'M2'){ $jumlah16_m2++; }
					if ($rlist->day16 == 'M3'){ $jumlah16_m3++; }
					if ($rlist->day16 == 'N'){ $jumlah16_n++; }
					if ($rlist->day16 == 'OFF'){ $jumlah16_off++; }
					if ($rlist->day16 == 'Cuti'){ $jumlah16_cuti++; }
					if ($rlist->day16 == 'LL'){ $jumlah16_ll++; }
					if ($rlist->day16 == 'DL'){ $jumlah16_dl++; }

					if ($rlist->day17 == 'P'){ $jumlah17_p++; }
					if ($rlist->day17 == 'S'){ $jumlah17_s++; }
					if ($rlist->day17 == 'M'){ $jumlah17_m++; }
					if ($rlist->day17 == 'MS'){ $jumlah17_ms++; }
					if ($rlist->day17 == 'PD'){ $jumlah17_pd++; }
					if ($rlist->day17 == 'SD'){ $jumlah17_sd++; }
					if ($rlist->day17 == 'MD'){ $jumlah17_md++; }
					if ($rlist->day17 == 'MP'){ $jumlah17_mp++; }
					if ($rlist->day17 == 'M2'){ $jumlah17_m2++; }
					if ($rlist->day17 == 'M3'){ $jumlah17_m3++; }
					if ($rlist->day17 == 'N'){ $jumlah17_n++; }
					if ($rlist->day17 == 'OFF'){ $jumlah17_off++; }
					if ($rlist->day17 == 'Cuti'){ $jumlah17_cuti++; }
					if ($rlist->day17 == 'LL'){ $jumlah17_ll++; }
					if ($rlist->day17 == 'DL'){ $jumlah17_dl++; }

					if ($rlist->day18 == 'P'){ $jumlah18_p++; }
					if ($rlist->day18 == 'S'){ $jumlah18_s++; }
					if ($rlist->day18 == 'M'){ $jumlah18_m++; }
					if ($rlist->day18 == 'MS'){ $jumlah18_ms++; }
					if ($rlist->day18 == 'PD'){ $jumlah18_pd++; }
					if ($rlist->day18 == 'SD'){ $jumlah18_sd++; }
					if ($rlist->day18 == 'MD'){ $jumlah18_md++; }
					if ($rlist->day18 == 'MP'){ $jumlah18_mp++; }
					if ($rlist->day18 == 'M2'){ $jumlah18_m2++; }
					if ($rlist->day18 == 'M3'){ $jumlah18_m3++; }
					if ($rlist->day18 == 'N'){ $jumlah18_n++; }
					if ($rlist->day18 == 'OFF'){ $jumlah18_off++; }
					if ($rlist->day18 == 'Cuti'){ $jumlah18_cuti++; }
					if ($rlist->day18 == 'LL'){ $jumlah18_ll++; }
					if ($rlist->day18 == 'DL'){ $jumlah18_dl++; }

					if ($rlist->day19 == 'P'){ $jumlah19_p++; }
					if ($rlist->day19 == 'S'){ $jumlah19_s++; }
					if ($rlist->day19 == 'M'){ $jumlah19_m++; }
					if ($rlist->day19 == 'MS'){ $jumlah19_ms++; }
					if ($rlist->day19 == 'PD'){ $jumlah19_pd++; }
					if ($rlist->day19 == 'SD'){ $jumlah19_sd++; }
					if ($rlist->day19 == 'MD'){ $jumlah19_md++; }
					if ($rlist->day19 == 'MP'){ $jumlah19_mp++; }
					if ($rlist->day19 == 'M2'){ $jumlah19_m2++; }
					if ($rlist->day19 == 'M3'){ $jumlah19_m3++; }
					if ($rlist->day19 == 'N'){ $jumlah19_n++; }
					if ($rlist->day19 == 'OFF'){ $jumlah19_off++; }
					if ($rlist->day19 == 'Cuti'){ $jumlah19_cuti++; }
					if ($rlist->day19 == 'LL'){ $jumlah19_ll++; }
					if ($rlist->day19 == 'DL'){ $jumlah19_dl++; }

					if ($rlist->day20 == 'P'){ $jumlah20_p++; }
					if ($rlist->day20 == 'S'){ $jumlah20_s++; }
					if ($rlist->day20 == 'M'){ $jumlah20_m++; }
					if ($rlist->day20 == 'MS'){ $jumlah20_ms++; }
					if ($rlist->day20 == 'PD'){ $jumlah20_pd++; }
					if ($rlist->day20 == 'SD'){ $jumlah20_sd++; }
					if ($rlist->day20 == 'MD'){ $jumlah20_md++; }
					if ($rlist->day20 == 'MP'){ $jumlah20_mp++; }
					if ($rlist->day20 == 'M2'){ $jumlah20_m2++; }
					if ($rlist->day20 == 'M3'){ $jumlah20_m3++; }
					if ($rlist->day20 == 'N'){ $jumlah20_n++; }
					if ($rlist->day20 == 'OFF'){ $jumlah20_off++; }
					if ($rlist->day20 == 'Cuti'){ $jumlah20_cuti++; }
					if ($rlist->day20 == 'LL'){ $jumlah20_ll++; }
					if ($rlist->day20 == 'DL'){ $jumlah20_dl++; }

					if ($rlist->day21 == 'P'){ $jumlah21_p++; }
					if ($rlist->day21 == 'S'){ $jumlah21_s++; }
					if ($rlist->day21 == 'M'){ $jumlah21_m++; }
					if ($rlist->day21 == 'MS'){ $jumlah21_ms++; }
					if ($rlist->day21 == 'PD'){ $jumlah21_pd++; }
					if ($rlist->day21 == 'SD'){ $jumlah21_sd++; }
					if ($rlist->day21 == 'MD'){ $jumlah21_md++; }
					if ($rlist->day21 == 'MP'){ $jumlah21_mp++; }
					if ($rlist->day21 == 'M2'){ $jumlah21_m2++; }
					if ($rlist->day21 == 'M3'){ $jumlah21_m3++; }
					if ($rlist->day21 == 'N'){ $jumlah21_n++; }
					if ($rlist->day21 == 'OFF'){ $jumlah21_off++; }
					if ($rlist->day21 == 'Cuti'){ $jumlah21_cuti++; }
					if ($rlist->day21 == 'LL'){ $jumlah21_ll++; }
					if ($rlist->day21 == 'DL'){ $jumlah21_dl++; }

					if ($rlist->day22 == 'P'){ $jumlah22_p++; }
					if ($rlist->day22 == 'S'){ $jumlah22_s++; }
					if ($rlist->day22 == 'M'){ $jumlah22_m++; }
					if ($rlist->day22 == 'MS'){ $jumlah22_ms++; }
					if ($rlist->day22 == 'PD'){ $jumlah22_pd++; }
					if ($rlist->day22 == 'SD'){ $jumlah22_sd++; }
					if ($rlist->day22 == 'MD'){ $jumlah22_md++; }
					if ($rlist->day22 == 'MP'){ $jumlah22_mp++; }
					if ($rlist->day22 == 'M2'){ $jumlah22_m2++; }
					if ($rlist->day22 == 'M3'){ $jumlah22_m3++; }
					if ($rlist->day22 == 'N'){ $jumlah22_n++; }
					if ($rlist->day22 == 'OFF'){ $jumlah22_off++; }
					if ($rlist->day22 == 'Cuti'){ $jumlah22_cuti++; }
					if ($rlist->day22 == 'LL'){ $jumlah22_ll++; }
					if ($rlist->day22 == 'DL'){ $jumlah22_dl++; }

					if ($rlist->day23 == 'P'){ $jumlah23_p++; }
					if ($rlist->day23 == 'S'){ $jumlah23_s++; }
					if ($rlist->day23 == 'M'){ $jumlah23_m++; }
					if ($rlist->day23 == 'MS'){ $jumlah23_ms++; }
					if ($rlist->day23 == 'PD'){ $jumlah23_pd++; }
					if ($rlist->day23 == 'SD'){ $jumlah23_sd++; }
					if ($rlist->day23 == 'MD'){ $jumlah23_md++; }
					if ($rlist->day23 == 'MP'){ $jumlah23_mp++; }
					if ($rlist->day23 == 'M2'){ $jumlah23_m2++; }
					if ($rlist->day23 == 'M3'){ $jumlah23_m3++; }
					if ($rlist->day23 == 'N'){ $jumlah23_n++; }
					if ($rlist->day23 == 'OFF'){ $jumlah23_off++; }
					if ($rlist->day23 == 'Cuti'){ $jumlah23_cuti++; }
					if ($rlist->day23 == 'LL'){ $jumlah23_ll++; }
					if ($rlist->day23 == 'DL'){ $jumlah23_dl++; }

					if ($rlist->day24 == 'P'){ $jumlah24_p++; }
					if ($rlist->day24 == 'S'){ $jumlah24_s++; }
					if ($rlist->day24 == 'M'){ $jumlah24_m++; }
					if ($rlist->day24 == 'MS'){ $jumlah24_ms++; }
					if ($rlist->day24 == 'PD'){ $jumlah24_pd++; }
					if ($rlist->day24 == 'SD'){ $jumlah24_sd++; }
					if ($rlist->day24 == 'MD'){ $jumlah24_md++; }
					if ($rlist->day24 == 'MP'){ $jumlah24_mp++; }
					if ($rlist->day24 == 'M2'){ $jumlah24_m2++; }
					if ($rlist->day24 == 'M3'){ $jumlah24_m3++; }
					if ($rlist->day24 == 'N'){ $jumlah24_n++; }
					if ($rlist->day24 == 'OFF'){ $jumlah24_off++; }
					if ($rlist->day24 == 'Cuti'){ $jumlah24_cuti++; }
					if ($rlist->day24 == 'LL'){ $jumlah24_ll++; }
					if ($rlist->day24 == 'DL'){ $jumlah24_dl++; }

					if ($rlist->day25 == 'P'){ $jumlah25_p++; }
					if ($rlist->day25 == 'S'){ $jumlah25_s++; }
					if ($rlist->day25 == 'M'){ $jumlah25_m++; }
					if ($rlist->day25 == 'MS'){ $jumlah25_ms++; }
					if ($rlist->day25 == 'PD'){ $jumlah25_pd++; }
					if ($rlist->day25 == 'SD'){ $jumlah25_sd++; }
					if ($rlist->day25 == 'MD'){ $jumlah25_md++; }
					if ($rlist->day25 == 'MP'){ $jumlah25_mp++; }
					if ($rlist->day25 == 'M2'){ $jumlah25_m2++; }
					if ($rlist->day25 == 'M3'){ $jumlah25_m3++; }
					if ($rlist->day25 == 'N'){ $jumlah25_n++; }
					if ($rlist->day25 == 'OFF'){ $jumlah25_off++; }
					if ($rlist->day25 == 'Cuti'){ $jumlah25_cuti++; }
					if ($rlist->day25 == 'LL'){ $jumlah25_ll++; }
					if ($rlist->day25 == 'DL'){ $jumlah25_dl++; }

					if ($rlist->day26 == 'P'){ $jumlah26_p++; }
					if ($rlist->day26 == 'S'){ $jumlah26_s++; }
					if ($rlist->day26 == 'M'){ $jumlah26_m++; }
					if ($rlist->day26 == 'MS'){ $jumlah26_ms++; }
					if ($rlist->day26 == 'PD'){ $jumlah26_pd++; }
					if ($rlist->day26 == 'SD'){ $jumlah26_sd++; }
					if ($rlist->day26 == 'MD'){ $jumlah26_md++; }
					if ($rlist->day26 == 'MP'){ $jumlah26_mp++; }
					if ($rlist->day26 == 'M2'){ $jumlah26_m2++; }
					if ($rlist->day26 == 'M3'){ $jumlah26_m3++; }
					if ($rlist->day26 == 'N'){ $jumlah26_n++; }
					if ($rlist->day26 == 'OFF'){ $jumlah26_off++; }
					if ($rlist->day26 == 'Cuti'){ $jumlah26_cuti++; }
					if ($rlist->day26 == 'LL'){ $jumlah26_ll++; }
					if ($rlist->day26 == 'DL'){ $jumlah26_dl++; }

					if ($rlist->day27 == 'P'){ $jumlah27_p++; }
					if ($rlist->day27 == 'S'){ $jumlah27_s++; }
					if ($rlist->day27 == 'M'){ $jumlah27_m++; }
					if ($rlist->day27 == 'MS'){ $jumlah27_ms++; }
					if ($rlist->day27 == 'PD'){ $jumlah27_pd++; }
					if ($rlist->day27 == 'SD'){ $jumlah27_sd++; }
					if ($rlist->day27 == 'MD'){ $jumlah27_md++; }
					if ($rlist->day27 == 'MP'){ $jumlah27_mp++; }
					if ($rlist->day27 == 'M2'){ $jumlah27_m2++; }
					if ($rlist->day27 == 'M3'){ $jumlah27_m3++; }
					if ($rlist->day27 == 'N'){ $jumlah27_n++; }
					if ($rlist->day27 == 'OFF'){ $jumlah27_off++; }
					if ($rlist->day27 == 'Cuti'){ $jumlah27_cuti++; }
					if ($rlist->day27 == 'LL'){ $jumlah27_ll++; }
					if ($rlist->day27 == 'DL'){ $jumlah27_dl++; }

					if ($rlist->day28 == 'P'){ $jumlah28_p++; }
					if ($rlist->day28 == 'S'){ $jumlah28_s++; }
					if ($rlist->day28 == 'M'){ $jumlah28_m++; }
					if ($rlist->day28 == 'MS'){ $jumlah28_ms++; }
					if ($rlist->day28 == 'PD'){ $jumlah28_pd++; }
					if ($rlist->day28 == 'SD'){ $jumlah28_sd++; }
					if ($rlist->day28 == 'MD'){ $jumlah28_md++; }
					if ($rlist->day28 == 'MP'){ $jumlah28_mp++; }
					if ($rlist->day28 == 'M2'){ $jumlah28_m2++; }
					if ($rlist->day28 == 'M3'){ $jumlah28_m3++; }
					if ($rlist->day28 == 'N'){ $jumlah28_n++; }
					if ($rlist->day28 == 'OFF'){ $jumlah28_off++; }
					if ($rlist->day28 == 'Cuti'){ $jumlah28_cuti++; }
					if ($rlist->day28 == 'LL'){ $jumlah28_ll++; }
					if ($rlist->day28 == 'DL'){ $jumlah28_dl++; }

					if ($rlist->day29 == 'P'){ $jumlah29_p++; }
					if ($rlist->day29 == 'S'){ $jumlah29_s++; }
					if ($rlist->day29 == 'M'){ $jumlah29_m++; }
					if ($rlist->day29 == 'MS'){ $jumlah29_ms++; }
					if ($rlist->day29 == 'PD'){ $jumlah29_pd++; }
					if ($rlist->day29 == 'SD'){ $jumlah29_sd++; }
					if ($rlist->day29 == 'MD'){ $jumlah29_md++; }
					if ($rlist->day29 == 'MP'){ $jumlah29_mp++; }
					if ($rlist->day29 == 'M2'){ $jumlah29_m2++; }
					if ($rlist->day29 == 'M3'){ $jumlah29_m3++; }
					if ($rlist->day29 == 'N'){ $jumlah29_n++; }
					if ($rlist->day29 == 'OFF'){ $jumlah29_off++; }
					if ($rlist->day29 == 'Cuti'){ $jumlah29_cuti++; }
					if ($rlist->day29 == 'LL'){ $jumlah29_ll++; }
					if ($rlist->day29 == 'DL'){ $jumlah29_dl++; }

					if ($rlist->day30 == 'P'){ $jumlah30_p++; }
					if ($rlist->day30 == 'S'){ $jumlah30_s++; }
					if ($rlist->day30 == 'M'){ $jumlah30_m++; }
					if ($rlist->day30 == 'MS'){ $jumlah30_ms++; }
					if ($rlist->day30 == 'PD'){ $jumlah30_pd++; }
					if ($rlist->day30 == 'SD'){ $jumlah30_sd++; }
					if ($rlist->day30 == 'MD'){ $jumlah30_md++; }
					if ($rlist->day30 == 'MP'){ $jumlah30_mp++; }
					if ($rlist->day30 == 'M2'){ $jumlah30_m2++; }
					if ($rlist->day30 == 'M3'){ $jumlah30_m3++; }
					if ($rlist->day30 == 'N'){ $jumlah30_n++; }
					if ($rlist->day30 == 'OFF'){ $jumlah30_off++; }
					if ($rlist->day30 == 'Cuti'){ $jumlah30_cuti++; }
					if ($rlist->day30 == 'LL'){ $jumlah30_ll++; }
					if ($rlist->day30 == 'DL'){ $jumlah30_dl++; }

					if ($rlist->day31 == 'P'){ $jumlah31_p++; }
					if ($rlist->day31 == 'S'){ $jumlah31_s++; }
					if ($rlist->day31 == 'M'){ $jumlah31_m++; }
					if ($rlist->day31 == 'MS'){ $jumlah31_ms++; }
					if ($rlist->day31 == 'PD'){ $jumlah31_pd++; }
					if ($rlist->day31 == 'SD'){ $jumlah31_sd++; }
					if ($rlist->day31 == 'MD'){ $jumlah31_md++; }
					if ($rlist->day31 == 'MP'){ $jumlah31_mp++; }
					if ($rlist->day31 == 'M2'){ $jumlah31_m2++; }
					if ($rlist->day31 == 'M3'){ $jumlah31_m3++; }
					if ($rlist->day31 == 'N'){ $jumlah31_n++; }
					if ($rlist->day31 == 'OFF'){ $jumlah31_off++; }
					if ($rlist->day31 == 'Cuti'){ $jumlah31_cuti++; }
					if ($rlist->day31 == 'LL'){ $jumlah31_ll++; }
					if ($rlist->day31 == 'DL'){ $jumlah31_dl++; }

					if ($rlist->day32 == 'P'){ $jumlah32_p++; }
					if ($rlist->day32 == 'S'){ $jumlah32_s++; }
					if ($rlist->day32 == 'M'){ $jumlah32_m++; }
					if ($rlist->day32 == 'MS'){ $jumlah32_ms++; }
					if ($rlist->day32 == 'PD'){ $jumlah32_pd++; }
					if ($rlist->day32 == 'SD'){ $jumlah32_sd++; }
					if ($rlist->day32 == 'MD'){ $jumlah32_md++; }
					if ($rlist->day32 == 'MP'){ $jumlah32_mp++; }
					if ($rlist->day32 == 'M2'){ $jumlah32_m2++; }
					if ($rlist->day32 == 'M3'){ $jumlah32_m3++; }
					if ($rlist->day32 == 'N'){ $jumlah32_n++; }
					if ($rlist->day32 == 'OFF'){ $jumlah32_off++; }
					if ($rlist->day32 == 'Cuti'){ $jumlah32_cuti++; }
					if ($rlist->day32 == 'LL'){ $jumlah32_ll++; }
					if ($rlist->day32 == 'DL'){ $jumlah32_dl++; }

					if ($rlist->day33 == 'P'){ $jumlah33_p++; }
					if ($rlist->day33 == 'S'){ $jumlah33_s++; }
					if ($rlist->day33 == 'M'){ $jumlah33_m++; }
					if ($rlist->day33 == 'MS'){ $jumlah33_ms++; }
					if ($rlist->day33 == 'PD'){ $jumlah33_pd++; }
					if ($rlist->day33 == 'SD'){ $jumlah33_sd++; }
					if ($rlist->day33 == 'MD'){ $jumlah33_md++; }
					if ($rlist->day33 == 'MP'){ $jumlah33_mp++; }
					if ($rlist->day33 == 'M2'){ $jumlah33_m2++; }
					if ($rlist->day33 == 'M3'){ $jumlah33_m3++; }
					if ($rlist->day33 == 'N'){ $jumlah33_n++; }
					if ($rlist->day33 == 'OFF'){ $jumlah33_off++; }
					if ($rlist->day33 == 'Cuti'){ $jumlah33_cuti++; }
					if ($rlist->day33 == 'LL'){ $jumlah33_ll++; }
					if ($rlist->day33 == 'DL'){ $jumlah33_dl++; }

					if ($rlist->day34 == 'P'){ $jumlah34_p++; }
					if ($rlist->day34 == 'S'){ $jumlah34_s++; }
					if ($rlist->day34 == 'M'){ $jumlah34_m++; }
					if ($rlist->day34 == 'MS'){ $jumlah34_ms++; }
					if ($rlist->day34 == 'PD'){ $jumlah34_pd++; }
					if ($rlist->day34 == 'SD'){ $jumlah34_sd++; }
					if ($rlist->day34 == 'MD'){ $jumlah34_md++; }
					if ($rlist->day34 == 'MP'){ $jumlah34_mp++; }
					if ($rlist->day34 == 'M2'){ $jumlah34_m2++; }
					if ($rlist->day34 == 'M3'){ $jumlah34_m3++; }
					if ($rlist->day34 == 'N'){ $jumlah34_n++; }
					if ($rlist->day34 == 'OFF'){ $jumlah34_off++; }
					if ($rlist->day34 == 'Cuti'){ $jumlah34_cuti++; }
					if ($rlist->day34 == 'LL'){ $jumlah34_ll++; }
					if ($rlist->day34 == 'DL'){ $jumlah34_dl++; }

					if ($rlist->day35 == 'P'){ $jumlah35_p++; }
					if ($rlist->day35 == 'S'){ $jumlah35_s++; }
					if ($rlist->day35 == 'M'){ $jumlah35_m++; }
					if ($rlist->day35 == 'MS'){ $jumlah35_ms++; }
					if ($rlist->day35 == 'PD'){ $jumlah35_pd++; }
					if ($rlist->day35 == 'SD'){ $jumlah35_sd++; }
					if ($rlist->day35 == 'MD'){ $jumlah35_md++; }
					if ($rlist->day35 == 'MP'){ $jumlah35_mp++; }
					if ($rlist->day35 == 'M2'){ $jumlah35_m2++; }
					if ($rlist->day35 == 'M3'){ $jumlah35_m3++; }
					if ($rlist->day35 == 'N'){ $jumlah35_n++; }
					if ($rlist->day35 == 'OFF'){ $jumlah35_off++; }
					if ($rlist->day35 == 'Cuti'){ $jumlah35_cuti++; }
					if ($rlist->day35 == 'LL'){ $jumlah35_ll++; }
					if ($rlist->day35 == 'DL'){ $jumlah35_dl++; }
					
					$generatesurat	= $generatesurat.'<tr><td width="25" align="center">'.$nomor.'</td><td width="150" style="white-space: nowrap;"><span style="font-stretch:95%;">'.$pegawai.'</span></td>
						<td width="30" align="center">'.$rlist->day01.'</td>
						<td width="30" align="center">'.$rlist->day02.'</td>
						<td width="30" align="center">'.$rlist->day03.'</td>
						<td width="30" align="center">'.$rlist->day04.'</td>
						<td width="30" align="center">'.$rlist->day05.'</td>
						<td width="30" align="center">'.$rlist->day06.'</td>
						<td width="30" align="center">'.$rlist->day07.'</td>
						<td width="30" align="center">'.$rlist->day08.'</td>
						<td width="30" align="center">'.$rlist->day09.'</td>
						<td width="30" align="center">'.$rlist->day10.'</td>
						<td width="30" align="center">'.$rlist->day11.'</td>
						<td width="30" align="center">'.$rlist->day12.'</td>
						<td width="30" align="center">'.$rlist->day13.'</td>
						<td width="30" align="center">'.$rlist->day14.'</td>
						<td width="30" align="center">'.$rlist->day15.'</td>
						<td width="30" align="center">'.$rlist->day16.'</td>
						<td width="30" align="center">'.$rlist->day17.'</td>
						<td width="30" align="center">'.$rlist->day18.'</td>
						<td width="30" align="center">'.$rlist->day19.'</td>
						<td width="30" align="center">'.$rlist->day20.'</td>
						<td width="30" align="center">'.$rlist->day21.'</td>
						<td width="30" align="center">'.$rlist->day22.'</td>
						<td width="30" align="center">'.$rlist->day23.'</td>
						<td width="30" align="center">'.$rlist->day24.'</td>
						<td width="30" align="center">'.$rlist->day25.'</td>
						<td width="30" align="center">'.$rlist->day26.'</td>
						<td width="30" align="center">'.$rlist->day27.'</td>
						<td width="30" align="center">'.$rlist->day28.'</td>
						<td width="30" align="center">'.$rlist->day29.'</td>
						<td width="30" align="center">'.$rlist->day30.'</td>
						<td width="30" align="center">'.$rlist->day31.'</td>
						<td width="30" align="center">'.$rlist->day32.'</td>
						<td width="30" align="center">'.$rlist->day33.'</td>
						<td width="30" align="center">'.$rlist->day34.'</td>
						<td width="30" align="center">'.$rlist->day35.'</td>
					</tr>';
					$nomor++;
				}
				$generatesurat	= $generatesurat.'</tbody></table></td></tr></table><div style="page-break-before: always"></div><table width="700" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;">';
				$generatesurat	= $generatesurat.'<tr><td colspan="5" width="720">';
				$generatesurat	= $generatesurat.$kolomatas;
				
				$generatesurat	= $generatesurat.'<tr><td align="center">.</td>
						<td>
							Jumlah P:<br />
							Jumlah S:<br />
							Jumlah M:<br />
							Jumlah MS:<br />
							Jumlah PD:<br />
							Jumlah SD:<br />
							Jumlah MD:<br />
							Jumlah MP:<br />
							Jumlah M2:<br />
							Jumlah M3:<br />
							Jumlah N:<br />
							Jumlah Off:<br />
							Jumlah Cuti:<br />
							Jumlah LL:<br />
							Jumlah DL:<br />
						</td>
						<td  align="center">
							'.$jumlah1_p.'<br />
							'.$jumlah1_s.'<br />
							'.$jumlah1_m.'<br />
							'.$jumlah1_ms.'<br />
							'.$jumlah1_pd.'<br />
							'.$jumlah1_sd.'<br />
							'.$jumlah1_md.'<br />
							'.$jumlah1_mp.'<br />
							'.$jumlah1_m2.'<br />
							'.$jumlah1_m3.'<br />
							'.$jumlah1_n.'<br />
							'.$jumlah1_off.'<br />
							'.$jumlah1_cuti.'<br />
							'.$jumlah1_ll.'<br />
							'.$jumlah1_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah2_p.'<br />
							'.$jumlah2_s.'<br />
							'.$jumlah2_m.'<br />
							'.$jumlah2_ms.'<br />
							'.$jumlah2_pd.'<br />
							'.$jumlah2_sd.'<br />
							'.$jumlah2_md.'<br />
							'.$jumlah2_mp.'<br />
							'.$jumlah2_m2.'<br />
							'.$jumlah2_m3.'<br />
							'.$jumlah2_n.'<br />
							'.$jumlah2_off.'<br />
							'.$jumlah2_cuti.'<br />
							'.$jumlah2_ll.'<br />
							'.$jumlah2_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah3_p.'<br />
							'.$jumlah3_s.'<br />
							'.$jumlah3_m.'<br />
							'.$jumlah3_ms.'<br />
							'.$jumlah3_pd.'<br />
							'.$jumlah3_sd.'<br />
							'.$jumlah3_md.'<br />
							'.$jumlah3_mp.'<br />
							'.$jumlah3_m2.'<br />
							'.$jumlah3_m3.'<br />
							'.$jumlah3_n.'<br />
							'.$jumlah3_off.'<br />
							'.$jumlah3_cuti.'<br />
							'.$jumlah3_ll.'<br />
							'.$jumlah3_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah4_p.'<br />
							'.$jumlah4_s.'<br />
							'.$jumlah4_m.'<br />
							'.$jumlah4_ms.'<br />
							'.$jumlah4_pd.'<br />
							'.$jumlah4_sd.'<br />
							'.$jumlah4_md.'<br />
							'.$jumlah4_mp.'<br />
							'.$jumlah4_m2.'<br />
							'.$jumlah4_m3.'<br />
							'.$jumlah4_n.'<br />
							'.$jumlah4_off.'<br />
							'.$jumlah4_cuti.'<br />
							'.$jumlah4_ll.'<br />
							'.$jumlah4_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah5_p.'<br />
							'.$jumlah5_s.'<br />
							'.$jumlah5_m.'<br />
							'.$jumlah5_ms.'<br />
							'.$jumlah5_pd.'<br />
							'.$jumlah5_sd.'<br />
							'.$jumlah5_md.'<br />
							'.$jumlah5_mp.'<br />
							'.$jumlah5_m2.'<br />
							'.$jumlah5_m3.'<br />
							'.$jumlah5_n.'<br />
							'.$jumlah5_off.'<br />
							'.$jumlah5_cuti.'<br />
							'.$jumlah5_ll.'<br />
							'.$jumlah5_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah6_p.'<br />
							'.$jumlah6_s.'<br />
							'.$jumlah6_m.'<br />
							'.$jumlah6_ms.'<br />
							'.$jumlah6_pd.'<br />
							'.$jumlah6_sd.'<br />
							'.$jumlah6_md.'<br />
							'.$jumlah6_mp.'<br />
							'.$jumlah6_m2.'<br />
							'.$jumlah6_m3.'<br />
							'.$jumlah6_n.'<br />
							'.$jumlah6_off.'<br />
							'.$jumlah6_cuti.'<br />
							'.$jumlah6_ll.'<br />
							'.$jumlah6_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah7_p.'<br />
							'.$jumlah7_s.'<br />
							'.$jumlah7_m.'<br />
							'.$jumlah7_ms.'<br />
							'.$jumlah7_pd.'<br />
							'.$jumlah7_sd.'<br />
							'.$jumlah7_md.'<br />
							'.$jumlah7_mp.'<br />
							'.$jumlah7_m2.'<br />
							'.$jumlah7_m3.'<br />
							'.$jumlah7_n.'<br />
							'.$jumlah7_off.'<br />
							'.$jumlah7_cuti.'<br />
							'.$jumlah7_ll.'<br />
							'.$jumlah7_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah8_p.'<br />
							'.$jumlah8_s.'<br />
							'.$jumlah8_m.'<br />
							'.$jumlah8_ms.'<br />
							'.$jumlah8_pd.'<br />
							'.$jumlah8_sd.'<br />
							'.$jumlah8_md.'<br />
							'.$jumlah8_mp.'<br />
							'.$jumlah8_m2.'<br />
							'.$jumlah8_m3.'<br />
							'.$jumlah8_n.'<br />
							'.$jumlah8_off.'<br />
							'.$jumlah8_cuti.'<br />
							'.$jumlah8_ll.'<br />
							'.$jumlah8_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah9_p.'<br />
							'.$jumlah9_s.'<br />
							'.$jumlah9_m.'<br />
							'.$jumlah9_ms.'<br />
							'.$jumlah9_pd.'<br />
							'.$jumlah9_sd.'<br />
							'.$jumlah9_md.'<br />
							'.$jumlah9_mp.'<br />
							'.$jumlah9_m2.'<br />
							'.$jumlah9_m3.'<br />
							'.$jumlah9_n.'<br />
							'.$jumlah9_off.'<br />
							'.$jumlah9_cuti.'<br />
							'.$jumlah9_ll.'<br />
							'.$jumlah9_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah10_p.'<br />
							'.$jumlah10_s.'<br />
							'.$jumlah10_m.'<br />
							'.$jumlah10_ms.'<br />
							'.$jumlah10_pd.'<br />
							'.$jumlah10_sd.'<br />
							'.$jumlah10_md.'<br />
							'.$jumlah10_mp.'<br />
							'.$jumlah10_m2.'<br />
							'.$jumlah10_m3.'<br />
							'.$jumlah10_n.'<br />
							'.$jumlah10_off.'<br />
							'.$jumlah10_cuti.'<br />
							'.$jumlah10_ll.'<br />
							'.$jumlah10_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah11_p.'<br />
							'.$jumlah11_s.'<br />
							'.$jumlah11_m.'<br />
							'.$jumlah11_ms.'<br />
							'.$jumlah11_pd.'<br />
							'.$jumlah11_sd.'<br />
							'.$jumlah11_md.'<br />
							'.$jumlah11_mp.'<br />
							'.$jumlah11_m2.'<br />
							'.$jumlah11_m3.'<br />
							'.$jumlah11_n.'<br />
							'.$jumlah11_off.'<br />
							'.$jumlah11_cuti.'<br />
							'.$jumlah11_ll.'<br />
							'.$jumlah11_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah12_p.'<br />
							'.$jumlah12_s.'<br />
							'.$jumlah12_m.'<br />
							'.$jumlah12_ms.'<br />
							'.$jumlah12_pd.'<br />
							'.$jumlah12_sd.'<br />
							'.$jumlah12_md.'<br />
							'.$jumlah12_mp.'<br />
							'.$jumlah12_m2.'<br />
							'.$jumlah12_m3.'<br />
							'.$jumlah12_n.'<br />
							'.$jumlah12_off.'<br />
							'.$jumlah12_cuti.'<br />
							'.$jumlah12_ll.'<br />
							'.$jumlah12_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah13_p.'<br />
							'.$jumlah13_s.'<br />
							'.$jumlah13_m.'<br />
							'.$jumlah13_ms.'<br />
							'.$jumlah13_pd.'<br />
							'.$jumlah13_sd.'<br />
							'.$jumlah13_md.'<br />
							'.$jumlah13_mp.'<br />
							'.$jumlah13_m2.'<br />
							'.$jumlah13_m3.'<br />
							'.$jumlah13_n.'<br />
							'.$jumlah13_off.'<br />
							'.$jumlah13_cuti.'<br />
							'.$jumlah13_ll.'<br />
							'.$jumlah13_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah14_p.'<br />
							'.$jumlah14_s.'<br />
							'.$jumlah14_m.'<br />
							'.$jumlah14_ms.'<br />
							'.$jumlah14_pd.'<br />
							'.$jumlah14_sd.'<br />
							'.$jumlah14_md.'<br />
							'.$jumlah14_mp.'<br />
							'.$jumlah14_m2.'<br />
							'.$jumlah14_m3.'<br />
							'.$jumlah14_n.'<br />
							'.$jumlah14_off.'<br />
							'.$jumlah14_cuti.'<br />
							'.$jumlah14_ll.'<br />
							'.$jumlah14_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah15_p.'<br />
							'.$jumlah15_s.'<br />
							'.$jumlah15_m.'<br />
							'.$jumlah15_ms.'<br />
							'.$jumlah15_pd.'<br />
							'.$jumlah15_sd.'<br />
							'.$jumlah15_md.'<br />
							'.$jumlah15_mp.'<br />
							'.$jumlah15_m2.'<br />
							'.$jumlah15_m3.'<br />
							'.$jumlah15_n.'<br />
							'.$jumlah15_off.'<br />
							'.$jumlah15_cuti.'<br />
							'.$jumlah15_ll.'<br />
							'.$jumlah15_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah16_p.'<br />
							'.$jumlah16_s.'<br />
							'.$jumlah16_m.'<br />
							'.$jumlah16_ms.'<br />
							'.$jumlah16_pd.'<br />
							'.$jumlah16_sd.'<br />
							'.$jumlah16_md.'<br />
							'.$jumlah16_mp.'<br />
							'.$jumlah16_m2.'<br />
							'.$jumlah16_m3.'<br />
							'.$jumlah16_n.'<br />
							'.$jumlah16_off.'<br />
							'.$jumlah16_cuti.'<br />
							'.$jumlah16_ll.'<br />
							'.$jumlah16_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah17_p.'<br />
							'.$jumlah17_s.'<br />
							'.$jumlah17_m.'<br />
							'.$jumlah17_ms.'<br />
							'.$jumlah17_pd.'<br />
							'.$jumlah17_sd.'<br />
							'.$jumlah17_md.'<br />
							'.$jumlah17_mp.'<br />
							'.$jumlah17_m2.'<br />
							'.$jumlah17_m3.'<br />
							'.$jumlah17_n.'<br />
							'.$jumlah17_off.'<br />
							'.$jumlah17_cuti.'<br />
							'.$jumlah17_ll.'<br />
							'.$jumlah17_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah18_p.'<br />
							'.$jumlah18_s.'<br />
							'.$jumlah18_m.'<br />
							'.$jumlah18_ms.'<br />
							'.$jumlah18_pd.'<br />
							'.$jumlah18_sd.'<br />
							'.$jumlah18_md.'<br />
							'.$jumlah18_mp.'<br />
							'.$jumlah18_m2.'<br />
							'.$jumlah18_m3.'<br />
							'.$jumlah18_n.'<br />
							'.$jumlah18_off.'<br />
							'.$jumlah18_cuti.'<br />
							'.$jumlah18_ll.'<br />
							'.$jumlah18_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah19_p.'<br />
							'.$jumlah19_s.'<br />
							'.$jumlah19_m.'<br />
							'.$jumlah19_ms.'<br />
							'.$jumlah19_pd.'<br />
							'.$jumlah19_sd.'<br />
							'.$jumlah19_md.'<br />
							'.$jumlah19_mp.'<br />
							'.$jumlah19_m2.'<br />
							'.$jumlah19_m3.'<br />
							'.$jumlah19_n.'<br />
							'.$jumlah19_off.'<br />
							'.$jumlah19_cuti.'<br />
							'.$jumlah19_ll.'<br />
							'.$jumlah19_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah20_p.'<br />
							'.$jumlah20_s.'<br />
							'.$jumlah20_m.'<br />
							'.$jumlah20_ms.'<br />
							'.$jumlah20_pd.'<br />
							'.$jumlah20_sd.'<br />
							'.$jumlah20_md.'<br />
							'.$jumlah20_mp.'<br />
							'.$jumlah20_m2.'<br />
							'.$jumlah20_m3.'<br />
							'.$jumlah20_n.'<br />
							'.$jumlah20_off.'<br />
							'.$jumlah20_cuti.'<br />
							'.$jumlah20_ll.'<br />
							'.$jumlah20_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah21_p.'<br />
							'.$jumlah21_s.'<br />
							'.$jumlah21_m.'<br />
							'.$jumlah21_ms.'<br />
							'.$jumlah21_pd.'<br />
							'.$jumlah21_sd.'<br />
							'.$jumlah21_md.'<br />
							'.$jumlah21_mp.'<br />
							'.$jumlah21_m2.'<br />
							'.$jumlah21_m3.'<br />
							'.$jumlah21_n.'<br />
							'.$jumlah21_off.'<br />
							'.$jumlah21_cuti.'<br />
							'.$jumlah21_ll.'<br />
							'.$jumlah21_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah22_p.'<br />
							'.$jumlah22_s.'<br />
							'.$jumlah22_m.'<br />
							'.$jumlah22_ms.'<br />
							'.$jumlah22_pd.'<br />
							'.$jumlah22_sd.'<br />
							'.$jumlah22_md.'<br />
							'.$jumlah22_mp.'<br />
							'.$jumlah22_m2.'<br />
							'.$jumlah22_m3.'<br />
							'.$jumlah22_n.'<br />
							'.$jumlah22_off.'<br />
							'.$jumlah22_cuti.'<br />
							'.$jumlah22_ll.'<br />
							'.$jumlah22_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah23_p.'<br />
							'.$jumlah23_s.'<br />
							'.$jumlah23_m.'<br />
							'.$jumlah23_ms.'<br />
							'.$jumlah23_pd.'<br />
							'.$jumlah23_sd.'<br />
							'.$jumlah23_md.'<br />
							'.$jumlah23_mp.'<br />
							'.$jumlah23_m2.'<br />
							'.$jumlah23_m3.'<br />
							'.$jumlah23_n.'<br />
							'.$jumlah23_off.'<br />
							'.$jumlah23_cuti.'<br />
							'.$jumlah23_ll.'<br />
							'.$jumlah23_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah24_p.'<br />
							'.$jumlah24_s.'<br />
							'.$jumlah24_m.'<br />
							'.$jumlah24_ms.'<br />
							'.$jumlah24_pd.'<br />
							'.$jumlah24_sd.'<br />
							'.$jumlah24_md.'<br />
							'.$jumlah24_mp.'<br />
							'.$jumlah24_m2.'<br />
							'.$jumlah24_m3.'<br />
							'.$jumlah24_n.'<br />
							'.$jumlah24_off.'<br />
							'.$jumlah24_cuti.'<br />
							'.$jumlah24_ll.'<br />
							'.$jumlah24_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah25_p.'<br />
							'.$jumlah25_s.'<br />
							'.$jumlah25_m.'<br />
							'.$jumlah25_ms.'<br />
							'.$jumlah25_pd.'<br />
							'.$jumlah25_sd.'<br />
							'.$jumlah25_md.'<br />
							'.$jumlah25_mp.'<br />
							'.$jumlah25_m2.'<br />
							'.$jumlah25_m3.'<br />
							'.$jumlah25_n.'<br />
							'.$jumlah25_off.'<br />
							'.$jumlah25_cuti.'<br />
							'.$jumlah25_ll.'<br />
							'.$jumlah25_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah26_p.'<br />
							'.$jumlah26_s.'<br />
							'.$jumlah26_m.'<br />
							'.$jumlah26_ms.'<br />
							'.$jumlah26_pd.'<br />
							'.$jumlah26_sd.'<br />
							'.$jumlah26_md.'<br />
							'.$jumlah26_mp.'<br />
							'.$jumlah26_m2.'<br />
							'.$jumlah26_m3.'<br />
							'.$jumlah26_n.'<br />
							'.$jumlah26_off.'<br />
							'.$jumlah26_cuti.'<br />
							'.$jumlah26_ll.'<br />
							'.$jumlah26_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah27_p.'<br />
							'.$jumlah27_s.'<br />
							'.$jumlah27_m.'<br />
							'.$jumlah27_ms.'<br />
							'.$jumlah27_pd.'<br />
							'.$jumlah27_sd.'<br />
							'.$jumlah27_md.'<br />
							'.$jumlah27_mp.'<br />
							'.$jumlah27_m2.'<br />
							'.$jumlah27_m3.'<br />
							'.$jumlah27_n.'<br />
							'.$jumlah27_off.'<br />
							'.$jumlah27_cuti.'<br />
							'.$jumlah27_ll.'<br />
							'.$jumlah27_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah28_p.'<br />
							'.$jumlah28_s.'<br />
							'.$jumlah28_m.'<br />
							'.$jumlah28_ms.'<br />
							'.$jumlah28_pd.'<br />
							'.$jumlah28_sd.'<br />
							'.$jumlah28_md.'<br />
							'.$jumlah28_mp.'<br />
							'.$jumlah28_m2.'<br />
							'.$jumlah28_m3.'<br />
							'.$jumlah28_n.'<br />
							'.$jumlah28_off.'<br />
							'.$jumlah28_cuti.'<br />
							'.$jumlah28_ll.'<br />
							'.$jumlah28_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah29_p.'<br />
							'.$jumlah29_s.'<br />
							'.$jumlah29_m.'<br />
							'.$jumlah29_ms.'<br />
							'.$jumlah29_pd.'<br />
							'.$jumlah29_sd.'<br />
							'.$jumlah29_md.'<br />
							'.$jumlah29_mp.'<br />
							'.$jumlah29_m2.'<br />
							'.$jumlah29_m3.'<br />
							'.$jumlah29_n.'<br />
							'.$jumlah29_off.'<br />
							'.$jumlah29_cuti.'<br />
							'.$jumlah29_ll.'<br />
							'.$jumlah29_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah30_p.'<br />
							'.$jumlah30_s.'<br />
							'.$jumlah30_m.'<br />
							'.$jumlah30_ms.'<br />
							'.$jumlah30_pd.'<br />
							'.$jumlah30_sd.'<br />
							'.$jumlah30_md.'<br />
							'.$jumlah30_mp.'<br />
							'.$jumlah30_m2.'<br />
							'.$jumlah30_m3.'<br />
							'.$jumlah30_n.'<br />
							'.$jumlah30_off.'<br />
							'.$jumlah30_cuti.'<br />
							'.$jumlah30_ll.'<br />
							'.$jumlah30_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah31_p.'<br />
							'.$jumlah31_s.'<br />
							'.$jumlah31_m.'<br />
							'.$jumlah31_ms.'<br />
							'.$jumlah31_pd.'<br />
							'.$jumlah31_sd.'<br />
							'.$jumlah31_md.'<br />
							'.$jumlah31_mp.'<br />
							'.$jumlah31_m2.'<br />
							'.$jumlah31_m3.'<br />
							'.$jumlah31_n.'<br />
							'.$jumlah31_off.'<br />
							'.$jumlah31_cuti.'<br />
							'.$jumlah31_ll.'<br />
							'.$jumlah31_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah32_p.'<br />
							'.$jumlah32_s.'<br />
							'.$jumlah32_m.'<br />
							'.$jumlah32_ms.'<br />
							'.$jumlah32_pd.'<br />
							'.$jumlah32_sd.'<br />
							'.$jumlah32_md.'<br />
							'.$jumlah32_mp.'<br />
							'.$jumlah32_m2.'<br />
							'.$jumlah32_m3.'<br />
							'.$jumlah32_n.'<br />
							'.$jumlah32_off.'<br />
							'.$jumlah32_cuti.'<br />
							'.$jumlah32_ll.'<br />
							'.$jumlah32_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah33_p.'<br />
							'.$jumlah33_s.'<br />
							'.$jumlah33_m.'<br />
							'.$jumlah33_ms.'<br />
							'.$jumlah33_pd.'<br />
							'.$jumlah33_sd.'<br />
							'.$jumlah33_md.'<br />
							'.$jumlah33_mp.'<br />
							'.$jumlah33_m2.'<br />
							'.$jumlah33_m3.'<br />
							'.$jumlah33_n.'<br />
							'.$jumlah33_off.'<br />
							'.$jumlah33_cuti.'<br />
							'.$jumlah33_ll.'<br />
							'.$jumlah33_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah34_p.'<br />
							'.$jumlah34_s.'<br />
							'.$jumlah34_m.'<br />
							'.$jumlah34_ms.'<br />
							'.$jumlah34_pd.'<br />
							'.$jumlah34_sd.'<br />
							'.$jumlah34_md.'<br />
							'.$jumlah34_mp.'<br />
							'.$jumlah34_m2.'<br />
							'.$jumlah34_m3.'<br />
							'.$jumlah34_n.'<br />
							'.$jumlah34_off.'<br />
							'.$jumlah34_cuti.'<br />
							'.$jumlah34_ll.'<br />
							'.$jumlah34_dl.'<br />
						</td>
						<td  align="center">
							'.$jumlah35_p.'<br />
							'.$jumlah35_s.'<br />
							'.$jumlah35_m.'<br />
							'.$jumlah35_ms.'<br />
							'.$jumlah35_pd.'<br />
							'.$jumlah35_sd.'<br />
							'.$jumlah35_md.'<br />
							'.$jumlah35_mp.'<br />
							'.$jumlah35_m2.'<br />
							'.$jumlah35_m3.'<br />
							'.$jumlah35_n.'<br />
							'.$jumlah35_off.'<br />
							'.$jumlah35_cuti.'<br />
							'.$jumlah35_ll.'<br />
							'.$jumlah35_dl.'<br />
						</td>
					</tr>';
				$generatesurat	= $generatesurat.'</tbody></table></td></tr>';
			}
			if ($tandatangan != ''){
				$alamatweb		= $homebase.'/trackingid/srtklr-'.$gceksrtklr->marking;
				if (Session('fakultas') == 'DPM'){
					$qrcode 	= QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pt.png', 0.2, true)->size(150)->generate($alamatweb);
				} else if (Session('fakultas') == 'PDP'){
					$qrcode 	= QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pdp.png', 0.2, true)->size(150)->generate($alamatweb);
				} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
					$qrcode 	= QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/rs.png', 0.2, true)->size(150)->generate($alamatweb);
				} else {
					$qrcode 	= QrCode::format('png')->size(150)->generate($alamatweb);
				}
				$output_file 	= '/scan/generate/qrimage-'.$gceksrtklr->id.'.png';
				Storage::disk('local')->put($output_file, $qrcode);
			
				if ($nmparaf1 != 0){
					$tte1 	= '<table width="240" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"><tr><td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$gceksrtklr->id.'.png" width="100" /></td><td width="140" align="left" valign="center">'.$jenisfontte.'&nbsp;<br />Ditandatangani secara elektronik</font></td></tr></table>';
				}
				if ($nmparaf2 != 0){
					$tte2 	= '<table width="240" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"><tr><td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$gceksrtklr->id.'.png" width="100" /></td><td width="140" align="left" valign="center">'.$jenisfontte.'&nbsp;<br />Ditandatangani secara elektronik</font></td></tr></table>';
				}
				if ($nmparaf3 != 0){
					$tte3 	= '<table width="240" border="0" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"><tr><td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimage-'.$gceksrtklr->id.'.png" width="100" /></td><td width="140" align="left" valign="center">'.$jenisfontte.'&nbsp;<br />Ditandatangani secara elektronik</font></td></tr></table>';
				}
			}
			$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">&nbsp;</td><td width="10">&nbsp;</td><td width="250">&nbsp;</td><td width="300"></td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">'.$jabparaf1.'</td><td width="240" colspan="2">'.$jabparaf2.'</td><td width="240">'.$jabparaf2.'</td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">'.$tte1.'</td><td width="240" colspan="2">'.$tte2.'</td><td width="240">'.$tte3.'</td></tr>';
			$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">'.$nmparaf1.'</td><td width="240" colspan="2">'.$nmparaf2.'</td><td width="240">'.$nmparaf3.'</td></tr>';
			
			$generatesurat	= $generatesurat.'</tbody></table>';
		} else if ($jenissrt == 'CUTI'){
			$nip 					= $lampiran;
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
			$mulai 			= $tglbuat;
			$akhir 			= $dasarsurat;
			$arrmulai		= explode('-', $mulai);
			$arrakhir		= explode('-', $akhir);
			if (isset($arrmulai[2])){
				$yy			= $arrmulai[0];
				$mm			= (int)$arrmulai[1];
				$dd			= $arrmulai[2];
				$mm			= $bulan[$mm];
				$mulai		= $dd.' '.$mm.' '.$yy;
			}
			if (isset($arrakhir[2])){
				$yy			= $arrakhir[0];
				$mm			= (int)$arrakhir[1];
				$dd			= $arrakhir[2];
				$mm			= $bulan[$mm];
				$akhir		= $dd.' '.$mm.' '.$yy;
			}
			$tanggal				= $mulai.' s/d '.$akhir;
			$idatasanlangsung		= $gceksrtklr->alamat;
			$idpejabat				= $gceksrtklr->idpejabat;
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
			$counttahunini			= Suratkeluartnpnomor::whereYear('tglbuat', $tahunini)->where('lampiran', $gceksrtklr->lampiran)->where('perihal', 'Cuti Tahunan')->where('jenissrt', 'CUTI')->count();
			$counttahunlalu			= Suratkeluartnpnomor::whereYear('tglbuat', $tahunlalu)->where('lampiran', $gceksrtklr->lampiran)->where('perihal', 'Cuti Tahunan')->where('jenissrt', 'CUTI')->count();
			$countduatahunlalu		= Suratkeluartnpnomor::whereYear('tglbuat', $duatahunlalu)->where('lampiran', $gceksrtklr->lampiran)->where('perihal', 'Cuti Tahunan')->where('jenissrt', 'CUTI')->count();
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
			if ($status == 'NEW'){
				$verifikatortext					= 'VII. PERTIMBANGAN ATASAN LANGSUNG';
				$verifikatorid						= $idatasanlangsung;
				$verifikatornama					= $namatasanlangsung;
				$verifikatorjabatan					= $jabatasanlangsung;
				$verifikatornip						= $nipatasanlangsung;
				$verifikatorselanjutnya				= $idpejabat;
				$persetujuanatasanlangsung			= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
				$persetujuanpejabat					= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
			} else if ($status == 'ATASAN'){
				$cekinboxatasan						= Inboxsurat::where('marking', $gceksrtklr->marking)->where('penerima', $jabatasanlangsung)->first();
				if (isset($cekinboxatasan->id)){
					if ($cekinboxatasan->catatan == 'DISETUJUI'){ $statverifikator1a = '&radic;'; }
					if ($cekinboxatasan->catatan == 'PERUBAHAN'){ $statverifikator1a = '&radic;'; }
					if ($cekinboxatasan->catatan == 'DITANGGUHKAN'){ $statverifikator1a = '&radic;'; }
					if ($cekinboxatasan->catatan == 'TIDAK DISETUJUI'){ $statverifikator1a = '&radic;'; }
					$statverifikator1alasan = $cekinboxatasan->tandatangan;
					$persetujuan1					= $cekinboxatasan->catatan.' Oleh '.$jabatasanlangsung.' Pada '.$cekinboxatasan->created_at;
					if (Session('fakultas') == 'DPM'){
						$qrcode1 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pt.png', 0.1, true)->size(150)->generate($persetujuan1));
					} else if (Session('fakultas') == 'PDP'){
						$qrcode1 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pdp.png', 0.1, true)->size(150)->generate($persetujuan1));
					} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
						$qrcode1 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/rs.png', 0.1, true)->size(150)->generate($persetujuan1));
					} else {
						$qrcode1 	= base64_encode(QrCode::format('png')->size(150)->generate($persetujuan1));
					}
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
			} else {
				$cekinboxatasan						= Inboxsurat::where('marking', $gceksrtklr->marking)->where('penerima', $jabatasanlangsung)->first();
				if (isset($cekinboxatasan->id)){
					if ($cekinboxatasan->catatan == 'DISETUJUI'){ $statverifikator1a = '&radic;'; }
					if ($cekinboxatasan->catatan == 'PERUBAHAN'){ $statverifikator1a = '&radic;'; }
					if ($cekinboxatasan->catatan == 'DITANGGUHKAN'){ $statverifikator1a = '&radic;'; }
					if ($cekinboxatasan->catatan == 'TIDAK DISETUJUI'){ $statverifikator1a = '&radic;'; }
					$statverifikator1alasan = $cekinboxatasan->tandatangan;
					$persetujuan1					= $cekinboxatasan->catatan.' Oleh '.$jabatasanlangsung.' Pada '.$cekinboxatasan->created_at;
					if (Session('fakultas') == 'DPM'){
						$qrcode1 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pt.png', 0.1, true)->size(150)->generate($persetujuan1));
					} else if (Session('fakultas') == 'PDP'){
						$qrcode1 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pdp.png', 0.1, true)->size(150)->generate($persetujuan1));
					} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
						$qrcode1 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/rs.png', 0.1, true)->size(150)->generate($persetujuan1));
					} else {
						$qrcode1 	= base64_encode(QrCode::format('png')->size(150)->generate($persetujuan1));
					}
					$persetujuanatasanlangsung		= '<img src="data:image/png;base64,'.$qrcode1.'" width="100" height="100"/>';
				} else {
					$persetujuanatasanlangsung		= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';
				}
				$cekinboxpejabat					= Inboxsurat::where('marking', $gceksrtklr->marking)->where('penerima', $jabpejabat)->first();
				if (isset($cekinboxpejabat->id)){
					if ($cekinboxpejabat->catatan == 'DISETUJUI'){ $statverifikator2a = '&radic;'; }
					if ($cekinboxpejabat->catatan == 'PERUBAHAN'){ $statverifikator2b = '&radic;'; }
					if ($cekinboxpejabat->catatan == 'DITANGGUHKAN'){ $statverifikator2c = '&radic;'; }
					if ($cekinboxpejabat->catatan == 'TIDAK DISETUJUI'){ $statverifikator2d = '&radic;'; }
					$statverifikator2alasan = $cekinboxpejabat->tandatangan;
					$persetujuan2					= $cekinboxatasan->catatan.' Oleh '.$jabpejabat.' Pada '.$cekinboxatasan->created_at;
					if (Session('fakultas') == 'DPM'){
						$qrcode2 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pt.png', 0.1, true)->size(150)->generate($persetujuan2));
					} else if (Session('fakultas') == 'PDP'){
						$qrcode2 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/pdp.png', 0.1, true)->size(150)->generate($persetujuan2));
					} else if (Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG'){
						$qrcode2 	= base64_encode(QrCode::format('png')->merge('http://surat-ptdpm.rs-primahusada.id/dist/img/rs.png', 0.1, true)->size(150)->generate($persetujuan2));
					} else {
						$qrcode2 	= base64_encode(QrCode::format('png')->size(150)->generate($persetujuan2));
					}
					$persetujuanpejabat				= '<img src="data:image/png;base64,'.$qrcode2.'" width="100" height="100"/>';
				} else {
					$persetujuanpejabat				= '<img src="'.$homebase.'/dist/img/boxed-bg.jpg" width="100" height="100"/>';	
				}
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
			$data['jatahtahunini']  			= $jatahtahunini;
			$data['jatahduatahunlalu']  		= $jatahduatahunlalu;
			$data['jatahtahunlalu']  			= $jatahtahunlalu;
			$data['counttahunini']  			= $counttahunini;
			$data['counttahunlalu']  			= $counttahunlalu;
			$data['countduatahunlalu']  		= $countduatahunlalu;
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
			$data['perihal']   					= $jenissrt;
			$data['surate']   					= $gceksrtklr;
			$generatesurat  					= view('cetak.cuti', $data);
		} else if ($jenissrt == 'NOTULENSI'){
			$idparticipan 	= (int)$gceksrtklr->isisurat;
			$getevenid		= WebinarPartisipan::where('id', $idparticipan)->first();
			if (isset($getevenid->id)){
				$idevent		= $getevenid->idevent;
				$namapeserta	= $getevenid->nama;
				$presensi		= $getevenid->presensi;
				$negara			= $getevenid->negara;
				$cekgambar 		= explode(';', $negara);
				if (isset($cekgambar[5])){
					$namafile1 		= '<img src="'.$homebase.'/images/notulensi/'.$cekgambar[0].'" width="650" />';
					$namafile2 		= '<img src="'.$homebase.'/images/notulensi/'.$cekgambar[1].'" width="650" />';
					$namafile3 		= '<img src="'.$homebase.'/images/notulensi/'.$cekgambar[2].'" width="650" />';
					$namafile4 		= '<img src="'.$homebase.'/images/notulensi/'.$cekgambar[3].'" width="650" />';
					$namafile5 		= '<img src="'.$homebase.'/images/notulensi/'.$cekgambar[4].'" width="650" />';
					$namafile6 		= '<img src="'.$homebase.'/images/notulensi/'.$cekgambar[5].'" width="650" />';
				} else {
					$namafile1 		= '&nbsp;';
					$namafile2 		= '&nbsp;';
					$namafile3 		= '&nbsp;';
					$namafile4 		= '&nbsp;';
					$namafile5 		= '&nbsp;';
					$namafile6 		= '&nbsp;';
				}
				$getnamaevent 		= WebinarEventlist::where('id', $idevent)->first();
				if (isset($getnamaevent->id)){
					$namaevent 		= $getnamaevent->nama;
					$tempatevent 	= $getnamaevent->tempat;
					$tanggalevent 	= $getnamaevent->tanggal;
					$mulaievent 	= $getnamaevent->mulai;
					$arrmulai		= explode(' ', $mulaievent);
					if (isset($arrmulai[1])){
						$jammulai 	= $arrmulai[1];
					} else {
						$jammulai	= '';
					}
					$arrakhir		= explode('-', $tanggalevent);
					$yysk			= $arrakhir[0];
					$mmsk			= (int)$arrakhir[1];
					$ddsk			= $arrakhir[2];
					$mmsk			= $kalender[$mmsk];
					$tanggalevent	= $ddsk.' '.$mmsk.' '.$yysk;
				} else { 
					$namaevent 		= '';
					$tempatevent 	= '';
					$tanggalevent 	= '';
					$jammulai 		= '';
				}
				$notulensi		= $getevenid->notulensi;
				$notulensi		= str_replace('class="MsoNormalTable"', '', $notulensi);
				$notulensi		= str_replace('class="MsoNormal"', '', $notulensi);
				$notulensi		= str_replace('class="MsoListParagraphCxSpFirst"', '', $notulensi);
				$notulensi		= str_replace('class="MsoListParagraphCxSpMiddle"', '', $notulensi);
				$notulensi		= str_replace('class="MsoListParagraphCxSpLast"', '', $notulensi);
				$notulensi		= str_replace('class="MsoListParagraph"', '', $notulensi);
				$notulensi		= str_replace('margin-bottom:0cm;', '', $notulensi);
				$notulensi		= str_replace('margin-top:0cm;', '', $notulensi);
				$notulensi		= str_replace('margin-right:0cm;', '', $notulensi);
				$notulensi		= str_replace('margin-left:21.5pt;', '', $notulensi);
				$notulensi		= str_replace('margin-left:-22.75pt;', '', $notulensi);
				$notulensi		= str_replace('margin-left:23.3pt;', '', $notulensi);
				$notulensi		= str_replace('margin-left:23.15pt;', '', $notulensi);
				$notulensi		= str_replace('margin-left:22.75pt;', '', $notulensi);
				$notulensi		= str_replace('border-collapse:collapse;', '', $notulensi);
				$notulensi		= str_replace('border:none;', '', $notulensi);
				$notulensi		= str_replace('border-top:none;', '', $notulensi);
				$notulensi		= str_replace('border-left:none;', '', $notulensi);
				$notulensi		= str_replace('border:solid black 1.0pt;', '', $notulensi);
				$notulensi		= str_replace('border-bottom:solid black 1.0pt;', '', $notulensi);
				$notulensi		= str_replace('border-right:solid black 1.0pt;', '', $notulensi);
				$notulensi		= str_replace('border-left:none;', '', $notulensi);
				$notulensi		= str_replace('<b style="mso-bidi-font-weight:normal">', '<strong>', $notulensi);
				$notulensi		= str_replace('</b>', '</strong>', $notulensi);
				$notulensi		= str_replace('font-family:', '', $notulensi);
				$notulensi		= str_replace('font:7.0pt', '', $notulensi);
				$notulensi		= str_replace('font-size:11.0pt;', '', $notulensi);
				$notulensi		= str_replace('lang="IN"', '', $notulensi);
				$notulensi		= str_replace('lang="EN-US"', '', $notulensi);
				$notulensi		= str_replace('&quot;Times New Roman&quot;', '', $notulensi);
				$notulensi		= str_replace('&quot;Arial&quot;,sans-serif;', '', $notulensi);
				$notulensi		= str_replace('Calibri;', '', $notulensi);
				$notulensi		= str_replace('Arial;', '', $notulensi);
				$notulensi		= str_replace('auto;', '', $notulensi);
				$notulensi		= str_replace('color:black', '', $notulensi);
				$notulensi		= str_replace('mso-font-kerning:', '', $notulensi);
				$notulensi		= str_replace('mso-ansi-language:EN-ID', '', $notulensi);
				$notulensi		= str_replace('mso-table-layout-alt:', '', $notulensi);
				$notulensi		= str_replace('mso-border-insideh:.5pt solid black;', '', $notulensi);
				$notulensi		= str_replace('mso-fareast-language:EN-US;', '', $notulensi);
				$notulensi		= str_replace('mso-bidi-language:AR-SA', '', $notulensi);
				$notulensi		= str_replace('mso-ligatures:none;', '', $notulensi);
				$notulensi		= str_replace('mso-list:Ignore', '', $notulensi);
				$notulensi		= str_replace('mso-list:l17 level1 lfo33', '', $notulensi);
				$notulensi		= str_replace('mso-list:l32 level1 lfo18', '', $notulensi);
				$notulensi		= str_replace('mso-list:l23 level1 lfo19', '', $notulensi);
				$notulensi		= str_replace('mso-list:l29 level1 lfo22', '', $notulensi);
				$notulensi		= str_replace('mso-list:l31 level1 lfo23', '', $notulensi);
				$notulensi		= str_replace('mso-list:l4 level1 lfo1', '', $notulensi);
				$notulensi		= str_replace('mso-list:l5 level1 lfo2', '', $notulensi);
				$notulensi		= str_replace('mso-add-space:auto;', '', $notulensi);
				$notulensi		= str_replace('mso-spacerun:yes', '', $notulensi);
				$notulensi		= str_replace('mso-fareast-font-family:', '', $notulensi);
				$notulensi		= str_replace('mso-ansi-language:IN', '', $notulensi);
				$notulensi		= str_replace('mso-border-top-alt:', '', $notulensi);
				$notulensi		= str_replace('solid black .5pt;', '', $notulensi);
				$notulensi		= str_replace('mso-border-left-alt:solid black .5pt;', '', $notulensi);
				$notulensi		= str_replace('mso-border-insidev:.5pt solid black', '', $notulensi);
				$notulensi		= str_replace('mso-border-alt:solid black .5pt;', '', $notulensi);
				$notulensi		= str_replace('mso-table-layout-alt:fixed;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-tbllook:1184;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-firstrow:yes;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:0;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:1;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:2;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:3;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:4;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:5;', '', $notulensi);
				$notulensi		= str_replace('mso-yfti-irow:6;', '', $notulensi);
				$notulensi		= str_replace('mso-padding-alt:0cm 5.4pt 0cm 5.4pt;', '', $notulensi);
				$notulensi		= str_replace('mso-ansi-language:EN-US', '', $notulensi);
				$notulensi		= str_replace('mso-add-space:', '', $notulensi);
				$notulensi		= str_replace('mso-list:l10 level1 lfo5', '', $notulensi);
				$notulensi		= str_replace('padding:0cm 5.4pt 0cm 5.4pt;', '', $notulensi);
				$notulensi		= str_replace('padding:0cm 5.4pt 0cm 5.4pt;height:25.9pt"', '', $notulensi);
				$notulensi		= str_replace('text-indent:-21.25pt;', '', $notulensi);
				$notulensi		= str_replace('text-indent:-21.5pt;', '', $notulensi);
				$notulensi		= str_replace('text-indent:-18.0pt;', '', $notulensi);
				$notulensi		= str_replace('text-indent:-23.15pt;', '', $notulensi);
				$notulensi		= str_replace('text-indent:-22.5pt;', '', $notulensi);
				$notulensi		= str_replace('width="729"', 'width="600"', $notulensi);
				$notulensi		= str_replace('width="68"', 'width="50"', $notulensi);
				$notulensi		= str_replace('width="197"', 'width="150"', $notulensi);
				$notulensi		= str_replace('width="180"', 'width="200"', $notulensi);
				$notulensi		= str_replace('width="194"', 'width="200"', $notulensi);
				$notulensi		= str_replace('width="91"', 'width="100"', $notulensi);
				$notulensi		= str_replace('width="50"', 'width="30"', $notulensi);
				$notulensi		= str_replace('width:145.55pt;', '', $notulensi);
				$notulensi		= str_replace('width:147.5pt;', '', $notulensi);
				$notulensi		= str_replace('width:134.65pt;', '', $notulensi);
				$notulensi		= str_replace('width:147.5pt;', '', $notulensi);
				$notulensi		= str_replace('width:134.65pt;', '', $notulensi);
				$notulensi		= str_replace('width:145.55pt;', '', $notulensi);
				$notulensi		= str_replace('width:68.3pt;', '', $notulensi);
				$notulensi		= str_replace('width:50.85pt;', '', $notulensi);
				$notulensi		= str_replace('height:25.9pt', '', $notulensi);
				$notulensi		= str_replace('height:19.1pt', '', $notulensi);
				$notulensi		= str_replace('height:19.7pt', '', $notulensi);
				$notulensi		= str_replace('height:14.1pt', '', $notulensi);
				$notulensi		= str_replace('line-height:', '', $notulensi);
				$notulensi		= str_replace('115%', '', $notulensi);
				$notulensi		= str_replace('107%', '', $notulensi);
				$notulensi		= str_replace('<div style="text-align: center; margin-left: 25px;">', '', $notulensi);
				$notulensi		= str_replace('<br></div>', '', $notulensi);
				$notulensi		= str_replace('<tr style="">', '', $notulensi);
				$notulensi		= str_replace('class="table table-bordered"', 'cellspacing="2" cellpadding="2" border="1"', $notulensi);
				$notulensi		= str_replace('cellspacing="0" cellpadding="0"', 'cellspacing="2" cellpadding="2"', $notulensi);
				$notulensi		= str_replace(';;', ';', $notulensi);
				$notulensi		= str_replace('0pt;', '', $notulensi);
				$notulensi		= str_replace('width:50.85pt"', '" width="30"', $notulensi);
				$notulensi		= str_replace('width:147.5pt"', '" width="150"', $notulensi);
				$notulensi		= str_replace('width:134.65pt"', '" width="200"', $notulensi);
				$notulensi		= str_replace('width:145.55pt"', '" width="200"', $notulensi);
				$notulensi		= str_replace('width:68.3pt""', '" width="100"', $notulensi);
				$notulensi		= str_replace('style=" ; vertical-align:top; "', '', $notulensi);
				$notulensi		= str_replace('border-;', '', $notulensi);
				$notulensi		= str_replace('style="width:729px"', 'width="600"', $notulensi);
				$notulensi		= str_replace('<span style="">&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style=" ">&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style=" ">&nbsp;&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style=" ">&nbsp;&nbsp;&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style=" ">&nbsp;&nbsp;&nbsp;&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>', '', $notulensi);
				$notulensi		= str_replace('<span style="">', '', $notulensi);
				
				WebinarPartisipan::where('id', $idparticipan)->update([
					'notulensi'	=> $notulensi
				]);
				$generatesurat 	= $header;
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center"><br /><strong>'.$jenissrt.'</strong><br /></td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">HARI / TANGGAL </td><td width="10">:</td><td width="500" colspan="2">'.$tanggalevent.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">PUKUL</td><td width="10">:</td><td width="250">'.$jammulai.'</td><td width="300">&nbsp;</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">JENIS MEETING</td><td width="10">&nbsp;</td><td width="550" colspan="2">'.$namaevent.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">TEMPAT</td><td width="10">:</td><td width="550" colspan="2">'.$tempatevent.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">Berikut hasil notulen </td><td width="10">&nbsp;</td><td width="550" colspan="2">&nbsp;</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="justify">'.$notulensi.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="110">&nbsp;</td><td width="10">&nbsp;</td><td width="250">&nbsp;</td><td width="300"></td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">Pemimpin Rapat</td><td width="240" colspan="2">&nbsp;</td><td width="240">'.Session('kota01').', '.$tglsp.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">'.$tte2.'</td><td width="240" colspan="2">&nbsp;</td><td width="240">'.$tte1.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">'.$namapejabat.'</td><td width="240" colspan="2">&nbsp;</td><td width="240">'.$namapeserta.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">&nbsp;</td><td width="240" colspan="2">Mengetahui</td><td width="240">&nbsp;</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">&nbsp;</td><td width="240" colspan="2">'.$jabparaf1.'</td><td width="240">&nbsp;</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">&nbsp;</td><td width="240" colspan="2">'.$tte3.'</td><td width="240">&nbsp;</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="240" colspan="2">&nbsp;</td><td width="240" colspan="2">'.$nmparaf2.'</td><td width="240">&nbsp;</td></tr>';
				$generatesurat	= $generatesurat.'</table>'.$pembatas.$header;
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center"><br /><strong>DOKUMENTASI</strong><br /></td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center">'.$namafile1.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center">'.$namafile2.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center">'.$namafile3.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center">'.$namafile4.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center">'.$namafile5.'</td></tr>';
				$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="650" align="center">'.$namafile6.'</td></tr>';
				
				$generatesurat	= $generatesurat.'</table>';
			}
		} else {

		}
	
	}
	return $generatesurat;
}
class NotifikasiController extends Controller
{
	public function viewsuratuser($id){
		$masterid 			= $id;
		$masterid 			= str_replace('srtklr-', '', $id);
		$masterid 			= str_replace('siapiket-', '', $masterid);
		$certificate 		= 'file://'.base_path().'/public/sco.crt';
		$ahrf 				= explode("-", $id);
		$headers 			= ['application/pdf'];
		if (isset($ahrf[1])){
			$keterangan  	= $ahrf[0];
			$idsurat		= $ahrf[1];
		} else {
			$keterangan		= '';
			$idsurat 		= $id;
		}
		$tabelbssn 			= '';
		$ringkasan2			= '';
		$formview 			= '';
		if (Session('fakultas') == 'RSPHSKR'){
			$img_file = public_path('kopfooterrsphs.png');
		} else if (Session('fakultas') == 'RSPHMLG'){
			$img_file = public_path('kopfooterrsphm.png');
		} else if (Session('fakultas') == 'PDP'){
			$img_file = public_path('kopfooterpdp.png');
		} else {
			$img_file = public_path('kopfooterdpm.png');
		}
		$cekjenis			= explode("=", $idsurat);
		$alamatfooter 		= Session('addressapps01').'<br />'.Session('kota01').'<br />'.Session('emailapps01');
		if (isset($cekjenis[1])){
			$formview		= $cekjenis[0];
			$idsurat		= $cekjenis[1];
			if ($idsurat == ''){
				$idsurat	= $cekjenis[0];
			}
			$setview		= 'VIEWONLY';
			$ukuranfont		= '14';
			$spasi			= '&nbsp;';
			$ukuranfontplus1= '+2';
			$ukuranfontplus2= '+1';
			$jenisfontte	= '<font size="1" color="blue">';
			$tabelbg		= 'background-image: url("'.asset('bgbssn.png').'"); background-repeat:no-repeat;background-size:100% 100%;';
		} else {
			if ($keterangan == 'draftsk' OR $keterangan == '58ddd975e88084b35fc973ab7518d4ba'){
				$setview		= 'VIEWONLY';
				$ukuranfont		= '14';
				$spasi			= '&nbsp;';
				$jenisfontte	= '<font size="1" color="blue">';
				$ukuranfontplus1= '+2';
				$ukuranfontplus2= '+1';
				$tabelbg		= 'background-image: url("'.asset('bgbssn.png').'"); background-repeat:no-repeat;background-size:100% 100%;';
			} else {
				$tabelbg		= '';
				$setview		= 'DOWNLOAD';
				$spasi			= '';
				$ukuranfont		= '12';
				$ukuranfontplus1= '14px';
				$ukuranfontplus2= '12px';
				$jenisfontte	= '<font size="7" color="blue">';
			}
		}
		$idsurat 			= preg_replace("/[^0-9]/", "", $idsurat);
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
		$info 				= array(
			'Name' 			=> config('global.namaapps'),
			'Location' 		=> config('global.Title'),
			'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
			'ContactInfo' 	=> $homebase,
		);
		$page_format 		= array(
			'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 356),
			'Dur' 			=> 3,
			'PZ' 			=> 1,
		);
		$universitas		= strtoupper($swandhanauniv);
		$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$kalender 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		if ($keterangan == '1b8a4d4791bd4b1b030db52b115e99b0'){
			$text			= getTextKepegawaian($formview.'='.$idsurat);
			$file			= '';
			if ($text == ''){
				$data['judulpesan']			= 'Unkown Errors';
				$data['kalimatheader']		= 'Render File Failded';
				$data['kalimatbody']		= 'Jenis '.$formview.' Dengan ID '.$idsurat.' Belum ada Tempalatnya. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
				return view('errors.pesanerror', $data);
			} else {
				if ($formview == 'formc' OR $formview == 'forme'){
					$ceksek 	= Suratkeluar::where('id', $idsurat)->first();
				} else {
					$ceksek 	= Tabelskdanperaturan::where('id', $idsurat)->first();
				}
				if (isset($ceksek->marking)){
					$marking 	= $ceksek->marking;
					$pembuat 	= Session('nama');
					$kelompok 	= Session('previlage');
					$jenissrt 	= Session('jabatan');
					$perihal 	= Session('id');
					$kepada		= Session('fakultas');
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
					
					if ($ceksek->tandatangan != '' AND file_exists(public_path('scan/files/'.$marking.'.pdf'))){
						$alamatweb		= $homebase.'/trackingid/srtklr-'.$ceksek->marking;
						$gethalaman 	= explode('<div style="page-break-before: always"></div>', $text);
						$cekttdneh			= Inboxsurat::where('marking', $marking)->where('status', 'SIgned With TTE')->where('terjadwal', '!=', '1')->first();
						if (isset($cekttdneh->marking)){
							$serttte 				= md5($cekttdneh->email);
							$ceksertifikatpribadi 	= $serttte.'.crt';
							$sertifikatpribadi 		= $serttte.'.csr';
							if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
								$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
							} elseif (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
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
									"localityName" 			=> $rinbox->penerima,
									"organizationName" 		=> $swandhanauniv,
									"organizationalUnitName"=> $swandhanafak,
									"commonName" 			=> $namapejabat,
									"emailAddress" 			=> $rinbox->email
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
								if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
									$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
								}
								if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
									$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
								}
							}
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
									PDFCREATOR::Image($img_file, 0, 0, 210, 356, '', '', '', false, 300, '', false, false, 0);
									PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
									PDFCREATOR::setPageMark();
									PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
									PDFCREATOR::setFooterMargin(0);
								}
								
								$pdfdoc = PDFCREATOR::Output('', 'S');
								PDFCREATOR::reset();
								Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
								$file =  public_path('scan/files/'.$marking.'.pdf');
								return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
							} catch (\Exception $e) {
								$data['perihal']   		= $perihal;
								$data['surate']   		= $text;
								$data['catatankaki']   	= $e->getMessage();
								return view('cetak.suratkeluar', $data);
							}
						} else {
							$file = public_path('scan/files/'.$marking.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						}
					} else {
						$alamatweb		= $homebase.'/trackingid/srtklr-'.$ceksek->marking;
						$gethalaman 	= explode('<div style="page-break-before: always"></div>', $text);
						try {
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
								PDFCREATOR::Image($img_file, 0, 0, 210, 356, '', '', '', false, 300, '', false, false, 0);
								PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
								PDFCREATOR::setPageMark();
								PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
								PDFCREATOR::setFooterMargin(0);
							}
							
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$idsurat.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						} catch (\Exception $e) {
							$data['perihal']   		= $perihal;
							$data['surate']   		= $text;
							$data['catatankaki']   	= $e->getMessage();
							return view('cetak.suratkeluar', $data);
						}
					}
				} else {
					$alamatweb					= $homebase.'/trackingid/srtklr-'.$masterid;
					$data['judulpesan']			= 'Unkown Errors';
					$data['kalimatheader']		= 'ID '.$idsurat.' / '.$masterid.' Tidak di Temukan';
					$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="'.$alamatweb.'">Tracking URL</a>';
					return view('errors.pesanerror', $data);
				}
			}
		} else if ($keterangan == 'siapiket' OR $keterangan == 'keluarnonomer' OR $keterangan == '31a6c48f03aaf7ab8085cc6b5bd34990'){
			if ($keterangan == '31a6c48f03aaf7ab8085cc6b5bd34990'){
				$gceksrtklr	= Suratkeluartnpnomor::where('id', $idsurat)->first();
			} else {
				$gceksrtklr	= Suratkeluartnpnomor::where('marking', $masterid)->first();
			}
			if (isset($gceksrtklr->id)){
				$idsurat 	= $gceksrtklr->id;
				$jenissrt	= $gceksrtklr->jenissrt;
				$status 	= $gceksrtklr->status;
				$marking 	= $gceksrtklr->marking;
				$perihal 	= $gceksrtklr->perihal;
				$kelompok 	= $gceksrtklr->kelompok;
				if ($gceksrtklr->jenissrt == 'MANUAL' OR $gceksrtklr->jenissrt == 'SPO'){
					if ($gceksrtklr->isisurat == '' OR $gceksrtklr->isisurat == null){
						$url = $homebase.'/trackingid/srtklr-'.$masterid;
					} else {
						$url = $homebase.'/viewdocbyname/'.$gceksrtklr->isisurat;
					}
					return redirect($url);
				} else {
					$text	= getTextKepegawaian('srtklrtnpnomor='.$gceksrtklr->id);
					try {
						if ($jenissrt == 'NOTULENSI'){
							$page_format 		= array(
								'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 356),
								'Dur' 			=> 3,
								'PZ' 			=> 1,
							);
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
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($img_file, 0, 0, 210, 356, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, false, true, false, '');
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$idsurat.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						} else if ($jenissrt == 'Jadwal Sif'){
							$page_format 		= array(
								'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 356),
								'Dur' 			=> 3,
								'PZ' 			=> 1,
							);
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
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($img_file, 0, 0, 356, 210, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, false, true, false, '');
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$idsurat.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						} else {
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
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($img_file, 0, 0, 210, 356, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, false, true, false, '');
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$idsurat.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						}
					} catch (\Exception $e) {
						$data['perihal']   		= $perihal;
						$data['surate']   		= $text;
						$data['catatankaki']   	= $e->getMessage();
						return view('cetak.suratkeluar', $data);
					}
				}
			} else {
				$url = $homebase.'/trackingid/srtklr-'.$masterid;
				return redirect($url);
			}
		} else if ($keterangan == 'disposisi' OR $keterangan == '94db1c8fae5b94957265aa3a335dfd3d' OR $keterangan == 'masuk' OR $keterangan == '7a07275b47504815818abc970da769fc'){
			$alamatweb		= $homebase.'/viewsurat/94db1c8fae5b94957265aa3a335dfd3d-'.$idsurat;
			$jinboxsrt		= Suratmasuk::where('id', $idsurat)->first();
            // dd($jinboxsrt);
			if (isset($jinboxsrt->id)){
				$marking		= $jinboxsrt->marking;
				$noagenda		= $jinboxsrt->noagenda;
				$tglmasuk		= $jinboxsrt->tglmasuk;
				$jenissurat		= $jinboxsrt->jenissurat;
				$nosurat		= $jinboxsrt->nosurat;
				$asalsurat		= $jinboxsrt->asalsurat;
				$kepada			= $jinboxsrt->kepada;
				$perihal		= $jinboxsrt->perihal;
				$subyek			= $jinboxsrt->subyek;
				$ringkasan		= $jinboxsrt->ringkasan;
				$lampiran		= $jinboxsrt->lampiran;
				$sifat			= $jinboxsrt->sifat;
				$bentuk			= $jinboxsrt->bentuk;
				$klasifikasi	= $jinboxsrt->klasifikasi;
				$pembuat		= $jinboxsrt->pembuat;
				$disposisi		= $jinboxsrt->disposisi;
				$tglsurat		= $jinboxsrt->tglsurat;
				$scanfile		= $jinboxsrt->scansurat;
				$ringkasan2		= $jinboxsrt->ringkasan2;
				$jjensurat		= Unitsurat::where('kode', $subyek)->first();
				if (isset($jjensurat->deskripsi)){
					$kodesubdeskripsi= $jjensurat->deskripsi;
				} else {
					$kodesubdeskripsi= $subyek;
				}
				
				$isidispoakhir	= '';
				$tulisdisposisi	= '';
				$mkelompok		= Session('jabatan');
				$cekprevilage	= Pejabatsurat::where('pejabat', $mkelompok)->count();
				if ($cekprevilage == 0){ 
					$mkelompok = $pembuat;
				}
				$cekdisposisi	= Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->orderby('id', 'ASC')->count();
				if ($cekdisposisi != 0){
					$getdisposisi	= Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->orderby('id', 'ASC')->get();
					foreach($getdisposisi as $rdisposisi) {
						$pemberi			= $rdisposisi->pengirim;
						$isidisposisi		= $rdisposisi->footnote;
						$disposisikpd		= $rdisposisi->penerima.'<br />('.$rdisposisi->email.')';
						$lampiran			= $rdisposisi->lampiran;
						$timeterima			= $rdisposisi->created_at;
						$timestamp			= $rdisposisi->updated_at;
						$sifat				= $rdisposisi->klasifikasi;
						if ($timestamp == $timeterima){
							$timestamp		= '';
						}
						//if ($lampiran != '' AND $lampiran != '-'){
						//	$isidisposisi 	= $isidisposisi.'<blockquote><p>Lampiran File :</p><a href="'.$homebase.'/scan/files/'.$lampiran.'" target="_blank">Download File Lampiran</a></blockquote>';
						//}
						if ($sifat == 'Rahasia'){
							$cekorange = Inboxsurat::where('pengirim', $pemberi)
											->where('penerima', $mkelompok)
											->count();
							if ($cekorange == 0){
								$tulisdisposisi		= $tulisdisposisi.'
								<tr>
									<td align="left" class="kiri atas kanan">'.$timeterima.'</td>
									<td align="left" class="kanan atas">'.$timestamp.'</td>
									<td colspan="2" align="left" class="kanan atas">Rahasia</td>
									<td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
									<td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
								</tr>';
							}else {
								$tulisdisposisi		= $tulisdisposisi.'
								<tr>
									<td align="left" class="kiri atas kanan">'.$timeterima.'</td>
									<td align="left" class="kanan atas">'.$timestamp.'</td>
									<td colspan="2" align="left" class="kanan atas">'.$isidisposisi.'</td>
									<td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
									<td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
								</tr>';
							}
						}else {
							$tulisdisposisi		= $tulisdisposisi.'
							<tr>
								<td align="left" class="kiri atas kanan">'.$timeterima.'</td>
								<td align="left" class="kanan atas">'.$timestamp.'</td>
								<td colspan="2" align="left" class="kanan atas">'.$isidisposisi.'</td>
								<td colspan="3" align="left" class="kanan atas">'.$pemberi.'</td>
								<td align="left" class="kanan atas" colspan="2">'.$disposisikpd.'</td>
							</tr>';
						}
					}
				} else{
					$tulisdisposisi	= '
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>
					<tr><td align="left" class="kiri atas kanan">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td colspan="2" align="left" class="kanan atas">&nbsp;</td><td colspan="3" align="left" class="kanan atas">&nbsp;</td><td align="left" class="kanan atas">&nbsp;</td><td align="center" class="kanan atas">&nbsp;</td></tr>';
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
				$printqrcode 				= QrCode::size(150)->generate($alamatweb);
				if ($scanfile != ''){
					$cekhasilkeluar 			= Suratkeluar::where('dasarsurat', $scanfile)->count();
					$cekhasilkeluartnpnomor		= Suratkeluartnpnomor::where('dasarsurat', $scanfile)->count();
					$cekhasilsk 				= Tabelskdanperaturan::where('dasarsurat', $scanfile)->count();
					$totalcek					= $cekhasilkeluar + $cekhasilkeluartnpnomor + $cekhasilsk;
				} else {
					$totalcek					= 0;
				}
				if ($totalcek == 0){
					$tuliscatatan 			= '<tr><td align="left"><strong>Catatan</strong></td><td align="left">:</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>
												<tr><td align="left">&nbsp;</td><td align="left">&nbsp;</td><td colspan="7" align="left" style="border-bottom-color: #000; border-bottom-style: dotted; border-bottom-width: medium;">&nbsp;</td></tr>';
				}  else {
					$i 						= 1;
					$tuliscatatan 			= '<tr><td align="left"><strong>Catatan</strong></td><td align="left">:</td><td colspan="7" align="left"><strong>Surat Balasan / Tindak Lanjut</strong></td></tr>';
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
							$tuliscatatan	= $tuliscatatan.'<tr><td align="left">&nbsp;</td><td align="left" valign="top">'.$i.'. </td><td colspan="7" align="left" valign="top">Surat No. '.$tlsnomor.' Tanggal '.$tlstanggal.' Perihal : '.$perihal.'</td></tr>';
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
							$tuliscatatan	= $tuliscatatan.'<tr><td align="left">&nbsp;</td><td align="left" valign="top">'.$i.'. </td><td colspan="7" align="left" valign="top">SK No. '.$nomor.' Tahun '.$tahunsk.' Tanggal '.$tlstanggal.' Tentang '.$judul.'</td></tr>';
							$i++;
						}
					}
					if ($cekhasilkeluartnpnomor != 0){
						$jsonsrttnpno		= Suratkeluartnpnomor::where('dasarsurat', $scanfile)->get();
						foreach($jsonsrttnpno as $rhasil3){
							$jenissrt 		= $rhasil3->jenissrt;
							$perihal 		= $rhasil3->perihal;
							$tuliscatatan	= $tuliscatatan.'<tr><td align="left">&nbsp;</td><td align="left" valign="top">'.$i.'. </td><td colspan="7" align="left" valign="top">Surat Dinas Tanpa Nomor Perihal '.$perihal.'</td></tr>';
							$i++;
						}
					}
				}
				if ($bentuk == 'SCO'){
					$scanfile 	= $jinboxsrt->ringkasan2;
					$ringkasan 	= '';
					$ringkasan2 = '';
				} else {
					$scanfile = $homebase.'/viewdocbyname/'.$jinboxsrt->scansurat;
					$cekjenis = explode("iframe", $ringkasan2);
					if (isset($cekjenis[1])){
						$scanfile	= $ringkasan2;
						$ringkasan 	= '';
						$ringkasan2 = '';
					}
					$cekjenis = explode("iframe", $ringkasan);
					if (isset($cekjenis[1])){
						$scanfile	= $ringkasan;
						$ringkasan 	= '';
						$ringkasan2 = '';
					}
				}
				
				
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
				if ($keterangan == 'masuk' OR $keterangan == '7a07275b47504815818abc970da769fc'){
					if ($bentuk == 'SCO'){
						$data['scanfile']   	= $scanfile;
					} else {
                        $scanfile 				= $homebase.'/viewdocbyname/'.$jinboxsrt->scansurat;
						$data['scanfile']   	= '<iframe src="'.$scanfile.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
						$cekjenis = explode("iframe", $jinboxsrt->ringkasan2);
						if (isset($cekjenis[1])){
							$data['scanfile']   	= $jinboxsrt->ringkasan2;
						}
						$cekjenis = explode("iframe", $jinboxsrt->ringkasan);
						if (isset($cekjenis[1])){
							$data['scanfile']   	= $jinboxsrt->ringkasan;
						}
					}
				} else {
					$data['scanfile']   	= '';
				}
				$data['tuliscatatan']   	= $tuliscatatan;
				return view('cetak.templatedisposisi', $data);
			} else {
				echo 'ID Surat '.$idsurat.' Tidak di Temukan, Silahkan Hubungi Admin Untuk Info Lebih Lanjut';
			}
		} else if ($keterangan == 'SKPP'){
			$ceksek				= Tabelskdanperaturan::where('id', $idsurat)->first();
			if (isset($ceksek->id)){
				$masterjenissurat 	= $ceksek->kelompok;
				$marking 			= $ceksek->marking;
				if ($masterjenissurat == 'Pegawai Tetap' OR $masterjenissurat == 'Pengangkatan Jabatan' OR $masterjenissurat == 'Pemberhentian Jabatan' OR $masterjenissurat == 'Dokter Tetap' OR $masterjenissurat == 'Penerimaan Staf' OR $masterjenissurat == 'Penonaktifan Staf' OR $masterjenissurat == 'Pengaktifan Staf' OR $masterjenissurat == 'Mutasi' OR $masterjenissurat == 'Penonaktifan Dokter Tetap'){
					$text		= getTextKepegawaian('formb='.$ceksek->id);
					$marking 	= $ceksek->marking;
					$pembuat 	= Session('nama');
					$kelompok 	= Session('previlage');
					$jenissrt 	= Session('jabatan');
					$perihal 	= Session('id');
					$kepada		= Session('fakultas');
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
					
					if ($ceksek->tandatangan != '' AND file_exists(public_path('scan/files/'.$marking.'.pdf'))){
						$file =  public_path('scan/files/'.$marking.'.pdf');
						return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					} else {
						try {
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
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($img_file, 0, 0, 210, 356, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$idsurat.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
							//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$idsurat.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						} catch (\Exception $e) {
							$data['perihal']   		= $perihal;
							$data['surate']   		= $text;
							$data['catatankaki']   	= $e->getMessage();
							return view('cetak.suratkeluar', $data);
						}
					}
				} else {
					echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
				}
			} else {
				echo 'ID SK '.$idsurat.' Tidak di Temukan, Silahkan Hubungi Admin Untuk Info Lebih Lanjut';
			}
		} else {
			$gceksrtklr			= Suratkeluar::where('marking', $idsurat)->orWhere('marking', $masterid)->orWhere('id', $masterid)->orWhere('id', $idsurat)->first();
			if (isset($gceksrtklr->marking)){
				$marking 		= $gceksrtklr->marking;
				$jenissrt		= $gceksrtklr->jenissrt;
				$kepada 		= $gceksrtklr->kepada;
				$alamat 		= $gceksrtklr->alamat;
				$perihal 		= $gceksrtklr->perihal;
				$pembuat		= $gceksrtklr->pembuat;
				$kelompok		= $gceksrtklr->kelompok;
				$isisurat 		= $gceksrtklr->isisurat;
				$isundangan 	= WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $gceksrtklr->id)->count();
				if ($isundangan == 0){
					if ($gceksrtklr->tandatangan != '' AND file_exists(public_path('scan/files/'.$marking.'.pdf'))){
						$file =  public_path('scan/files/'.$marking.'.pdf');
						return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					} else if ($gceksrtklr->jenissrt == 'UPLOAD' AND file_exists(public_path('scan/files/'.$marking.'.pdf'))){
						$file =  public_path('scan/files/'.$marking.'.pdf');
						return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
						//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					} else {
						if ($jenissrt == 'Tugas' OR 
							$jenissrt == 'Undangan' OR 
							$jenissrt == 'Edaran' OR 
							$jenissrt == 'Referensi Kerja' OR 
							$jenissrt == 'Perjanjian Orientasi Kerja' OR 
							$jenissrt == 'Perjanjian Orientasi Kerja NAKES' OR
							$jenissrt == 'Perjanjian Orientasi Kerja NON-NAKES' OR
							$jenissrt == 'PKWT Staf Klinis Baru' OR
							$jenissrt == 'PKWT Staf Klinis Lain dan Non Klinis Baru' OR
							$jenissrt == 'PKWT Dokter Spesialis' OR
							$jenissrt == 'PKWT Dokter Umum (PART TIME)' OR
							$jenissrt == 'PKWT Dokter Manajemen Baru' OR
							$jenissrt == 'PKWT Staf Klinis Perpanjangan' OR
							$jenissrt == 'PKWT Dokter Manajemen Perpanjangan' OR
							$jenissrt == 'PKWT Dokter Klinik' OR
							$jenissrt == 'PKWTT' OR
							$jenissrt == 'PKWT' OR
							$jenissrt == 'PKWT Staf Klinis Lain dan Non Klinis Perpanjangan' OR
							$jenissrt == 'Keterangan Tidak Bekerja' OR 
							$jenissrt == 'Keterangan Aktif Bekerja' OR 
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
							$jenissrt == 'Mutasi' OR 
							$jenissrt == 'Penonaktifan Dokter Tetap'){
							if ($jenissrt == 'Referensi Kerja'){
								$text			= getTextKepegawaian('forme='.$gceksrtklr->id);
							} else {
								$text			= getTextKepegawaian('formc='.$gceksrtklr->id);
								if ($jenissrt == 'PKWT Staf Klinis Baru' OR $jenissrt == 'PKWT Staf Klinis Lain dan Non Klinis Baru' OR $jenissrt == 'PKWT Dokter Spesialis' OR $jenissrt == 'PKWT Dokter Umum (PART TIME)' OR $jenissrt == 'PKWT Dokter Manajemen Baru' OR $jenissrt == 'PKWT Staf Klinis Perpanjangan' OR $jenissrt == 'PKWT Dokter Manajemen Perpanjangan' OR $jenissrt == 'PKWTT' OR $jenissrt == 'PKWT' OR $jenissrt == 'PKWT Staf Klinis Lain dan Non Klinis Perpanjangan'  OR $jenissrt == 'PKWT Dokter Klinik'){
									$img_file = public_path('kopfooterdpm.png');
								}
							}
							$bgbssn				= '';
							$page_format 		= array(
								'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
								'Dur' 			=> 3,
								'PZ' 			=> 1,
							);
							$gethalaman 	= explode('<div style="page-break-before: always"></div>', $text);
							try {
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
									PDFCREATOR::Image($img_file, 0, 0, 210, 356, '', '', '', false, 300, '', false, false, 0);
									PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
									PDFCREATOR::setPageMark();
									PDFCREATOR::writeHTML($halaman, true, 0, true, 0);
									PDFCREATOR::setFooterMargin(0);
								}
								$pdfdoc = PDFCREATOR::Output('', 'S');
								PDFCREATOR::reset();
								Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
								$file =  public_path('scan/generate/'.$idsurat.'.pdf');
								return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
								//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$idsurat.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
							} catch (\Exception $e) {
								$data['perihal']   		= $perihal;
								$data['surate']   		= $text;
								$data['catatankaki']   	= $e->getMessage();
							    return view('cetak.suratkeluar', $data);
							}
						} else {
							if (File::exists(public_path() ."/scan/files/". $gceksrtklr->marking.'.pdf') OR File::exists(base_path() ."/public/scan/files/".$gceksrtklr->marking.'.pdf') OR File::exists(base_path() ."/public/scan/files/".$gceksrtklr->marking.'.pdf')) {
								$file =  public_path('scan/files/'.$gceksrtklr->marking.'.pdf');
								return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
								//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$gceksrtklr->marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
							} else {
								echo '<iframe src="'.$homebase.'/trackingid/srtklr-'.$gceksrtklr->marking.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
							}
						}
					}
				} else {
					$getid 	= WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('kontak', $gceksrtklr->id)->first();
					return redirect($homebase.'/info/'.$getid->id); 
				}
			} else {
				$ceksek				= Tabelskdanperaturan::where('marking', $idsurat)->orWhere('marking', $masterid)->orWhere('id', $masterid)->orWhere('id', $idsurat)->first();
				if (isset($ceksek->paraf1)){
					$masterjenissurat 	= $ceksek->kelompok;
					$marking 			= $ceksek->marking;
					if ($masterjenissurat == 'Pegawai Tetap' OR $masterjenissurat == 'Pengangkatan Jabatan' OR $masterjenissurat == 'Pemberhentian Jabatan' OR $masterjenissurat == 'Dokter Tetap' OR $masterjenissurat == 'Penerimaan Staf' OR $masterjenissurat == 'Penonaktifan Staf' OR $masterjenissurat == 'Pengaktifan Staf' OR $masterjenissurat == 'Mutasi' OR $masterjenissurat == 'Penonaktifan Dokter Tetap'){
						$text		= getTextKepegawaian('formb='.$ceksek->id);
						$marking 	= $ceksek->marking;
						$pembuat 	= Session('nama');
						$kelompok 	= Session('previlage');
						$jenissrt 	= Session('jabatan');
						$perihal 	= Session('id');
						$kepada		= Session('fakultas');
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
						
						if ($ceksek->tandatangan != '' AND file_exists(public_path('scan/files/'.$marking.'.pdf'))){
							echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						} else {
							$alamatweb		= $homebase.'/trackingid/srtklr-'.$ceksek->marking;
							$bgbssn			= '';
							$page_format 		= array(
								'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
								'Dur' 			=> 3,
								'PZ' 			=> 1,
							);
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
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/generate/'.$idsurat.'.pdf', $pdfdoc);
							$file =  public_path('scan/generate/'.$idsurat.'.pdf');
							return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
							//echo '<iframe src="'.$homebase.'/viewdocbyname/'.$idsurat.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						}
					} else {
						echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					}
				} else {
					$gceksrtklr			= Suratkeluartnpnomor::where('marking', $idsurat)->orWhere('marking', $masterid)->orWhere('id', $masterid)->orWhere('id', $idsurat)->first();
					if (isset($gceksrtklr->marking)){
						$marking 		= $gceksrtklr->marking;
						$jenissrt 		= $gceksrtklr->jenissrt;
						echo '<iframe src="'.$homebase.'/viewdocbyname/'.$marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					} else {
						echo '<iframe src="'.$homebase.'/trackingid/srtklr-'.$masterid.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					}
				}
			}
		}
    }
    public function viewsuratKeluar(Request $request) {
		$swandhanafak       = config('global.swandhanafak');
        $swandhanaalamat    = config('global.swandhanaalamat');
        $swandhanakemen     = config('global.swandhanakemen');
        $swandhanauniv      = config('global.swandhanauniv');
		$swandhanatelpon    = config('global.swandhanatelpon');
		$swandhanaemail     = config('global.swandhanaemail');
		$swandhanakota		= config('global.swandhanakota');
		$homebase			= url("/");
		$lampiranpenerima	= '';
		$marking			= $request->input('val01');
		$keterangan			= $request->input('val02');
		$universitas		= strtoupper($swandhanauniv);
		$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		if ($keterangan == 'REMUNERASI' OR 
			$keterangan == 'TUBEL' OR 
			$keterangan == 'JABAKAD' OR 
			$keterangan == 'BERHENTI' OR
			$keterangan == 'DRAFTSK' OR
			$keterangan == 'PENGPNS' OR
			$keterangan == 'JABPELAKSANA' OR 
			$keterangan == 'PangkatNONPNS'){
			$getid 		= Draftsk::where('id', $marking)->count();
			if ($getid != 0){
				echo '<iframe src="'.$homebase.'/viewsurat/954db2a8075c782c586e33e36ed2cc8c-view='.$marking.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
			} else {
				$getid = Draftsk::where('marking', $marking)->first();
				if (isset($getid->id)){
					echo '<iframe src="'.$homebase.'/viewsurat/954db2a8075c782c586e33e36ed2cc8c-view='.$getid->id.'" width="100%" height="780" style="border: none;" id="previewbyid"></iframe>';
				} else {
					echo 'Draft SK Tidak ditemukan / Telah di Hapus oleh konseptor';
				}
			}
		} else if ($keterangan == 'undo'){
			$getid 		= Inboxsurat::where('idsurat', $marking)->where('catatan', 'undo')->first();
			if (isset($getid->marking)){
				$cekdatalama = Inboxsurat::where('id', '!=', $getid->id)->where('marking', $getid->marking)->first();
				if (isset($cekdatalama->id)){
					Inboxsurat::where('idsurat', $marking)->where('catatan', 'undo')->update([
						'catatan'	=> $cekdatalama->catatan
					]);
				}
				echo '<iframe src="'.$homebase.'/viewdocbyname/'.$getid->marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
			} else {
				echo 'ID '.$marking.' Tidak ditemukan';
			}
		} else if ($keterangan == 'SIMULASISK'){
			$ceksudahada = Templateskpp::where('namask', $marking)->where('fakultas', Session('fakultas'))->count();
			if ($ceksudahada == 0){
				echo 'ID '.$marking.' Surat Tidak ada Settingnya';
			} else {
				$namafile 			= md5($marking);
				$ukuranfont			= '12';
				$ukuranfontplus1	= '18px';
				$ukuranfontplus2	= '12px';
				$jenisfontte		= '<font size="7" color="blue">';
				$pembatas 			= '<div style="page-break-before: always">';
				$baris 				= 1;
				$halaman 			= 1;
				//$kopsurat 		= '<img src="'.$homebase.'/images/kopsurat/DPM.png" width="650" />';
				$kopsurat 			= '<table width="650" border="0" cellpadding="2" cellspacing="0"><tr><td width="650">&nbsp;</td></tr><tr><td">&nbsp;</td></tr><tr><td">&nbsp;</td></tr><tr><td">&nbsp;</td></tr><tr><td">&nbsp;</td></tr><tr><td">&nbsp;</td></tr><tr><td">&nbsp;</td></tr><tr><td">&nbsp;</td></tr></table>';
				$header 			= '<table width="700" border="1" cellpadding="2" cellspacing="0" style="font-size: '.$ukuranfont.'px; font-family: Bookman Old Style;"><tr><td width="50" style="border-bottom: 1px double black;">&nbsp;</td><td width="650" valign="top" colspan="6" style="border-bottom: 1px double black;">'.$kopsurat.'</td></tr>';
				$generatesurat 		= $header;
				$masterjenissurat	= $marking;
				if ($masterjenissurat == 'Pegawai Tetap' OR $masterjenissurat == 'Pengangkatan Jabatan' OR $masterjenissurat == 'Pemberhentian Jabatan' OR $masterjenissurat == 'Dokter Tetap' OR $masterjenissurat == 'Penerimaan Staf' OR $masterjenissurat == 'Penonaktifan Staf' OR $masterjenissurat == 'Pengaktifan Staf' OR $masterjenissurat == 'Mutasi' OR $masterjenissurat == 'Penonaktifan Dokter Tetap'){
					$sql 			= Templateskpp::where('namask', $masterjenissurat)->where('fakultas', Session('fakultas'))->orderBy('urutan','ASC')->get();
					foreach($sql as $rows){
						if ($rows->judul == '-space-'){
							$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700">&nbsp;</td></tr>';
						} else if ($rows->judul == '-footer-'){
							$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700" align="center" style="border-top: 1px solid #000000;">'.$alamatfooter.'</td></tr>';
						} else if ($rows->judul == '-pagebreak-'){
							$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="center" width="680" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
							$halaman++;
						} else {
							if ($rows->leter == 'judul'){
								$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td height="22" colspan="6" align="center" width="680">'.$rows->judul.'</td></tr>';
							} else if ($rows->leter == 'RL'){
								if ($rows->posisi == '2'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td>'.$rows->judul;
								} else {
									$generatesurat	= $generatesurat.'<tr><td width="20" colspan="2">&nbsp;</td>'.$rows->judul;
								}
							} else if ($rows->leter == 'RA'){
								$generatesurat	= $generatesurat.$rows->judul;
							} else {
								if ($rows->posisi == '5'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '6'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">'.$rows->mengingat.'</td><td width="20" align="center">'.$rows->menimbang.'</td><td align="justify" valign="top" colspan="2" width="490">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '8'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td width="200" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="310">: '.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '10'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20">&nbsp;</td><td width="130" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td width="510" align="left" valign="top" colspan="3">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '7'){
									$generatesurat	= $generatesurat.'<tr><td width="400" colspan="4">&nbsp;</td><td colspan="3" align="justify" valign="top" width="300">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '9'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '0'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '1'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="4" width="640">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '2'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="3" width="620">'.$rows->judul.'</td></tr>';
								} else {
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="600">'.$rows->judul.'</td></tr>';
								}
							}
						}
					}
				} else {
					$sql 			= Templateskpp::where('namask', $marking)->where('fakultas', Session('fakultas'))->orderBy('urutan','ASC')->get();
					foreach($sql as $rows){
						if ($rows->urutan  == '0' OR $rows->urutan == '' OR $rows->urutan == null){
							Templateskpp::where('id', $rows->id)->update([
								'urutan'	=> $baris
							]);
						}
						if ($rows->judul == '-space-'){
							$generatesurat	= $generatesurat.'<tr><td colspan="7">&nbsp;</td></tr>';
						} else if ($rows->judul == '-footer-'){
							$generatesurat	= $generatesurat.'<tr><td colspan="7" width="700" align="center" style="border-top: 1px solid #000000;">'.$alamatfooter.'</td></tr>';
						} else if ($rows->judul == '-pagebreak-'){
							$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td align="center" width="620" colspan="6"><font color="grey">'.$halaman.'</font></td></tr></table>'.$pembatas.$header;
							$halaman++;
						} else {
							if ($rows->leter == 'judul'){
								$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td height="22" colspan="6" align="center" width="650">'.$rows->judul.'</td></tr>';
							} else if ($rows->leter == 'RL'){
								if ($rows->posisi == '2'){
									$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td>'.$rows->judul;
								} else {
									$generatesurat	= $generatesurat.'<tr><td width="70" colspan="2">&nbsp;</td>'.$rows->judul;
								}
							} else if ($rows->leter == 'RA'){
								$generatesurat	= $generatesurat.$rows->judul;
							} else {
								if ($rows->posisi == '5'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td align="justify" valign="top" colspan="3" width="680">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '6'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">'.$rows->leter.'</td><td width="20" align="center">'.$rows->mengingat.'</td><td width="20" align="center">'.$rows->menimbang.'</td><td align="justify" valign="top" colspan="2" width="490">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '8'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td width="200" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="310">: '.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '10'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td width="20">&nbsp;</td><td width="130" align="left">'.$rows->leter.'</td><td width="20" align="center">:</td><td width="510" align="left" valign="top" colspan="3">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '7'){
									$generatesurat	= $generatesurat.'<tr><td width="400" colspan="4">&nbsp;</td><td colspan="3" align="justify" valign="top" width="300">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '9'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td colspan="2" width="150" align="left">&nbsp;</td><td width="20" align="center">&nbsp;</td><td align="justify" valign="top" colspan="3" width="510">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '0'){
									$generatesurat	= $generatesurat.'<tr><td width="20">&nbsp;</td><td align="justify" valign="top" colspan="6" width="680">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '1'){
									$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="25" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="4" width="580">'.$rows->judul.'</td></tr>';
								} else if ($rows->posisi == '2'){
									$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="3" width="540">'.$rows->judul.'</td></tr>';
								} else {
									$generatesurat	= $generatesurat.'<tr><td width="50">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="25" align="left">&nbsp;</td><td width="20" align="left">&nbsp;</td><td width="20" align="left">'.$rows->leter.'</td><td align="justify" valign="top" colspan="2" width="520">'.$rows->judul.'</td></tr>';
								}
							}
						}
						$baris++;
					}
				}
				$generatesurat	= $generatesurat.'</table>';
				$page_format 		= array(
					'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
					'Dur' 			=> 3,
					'PZ' 			=> 1,
				);
				if (Session('fakultas') == 'RSPHSKR'){
					$img_file = public_path('kopfooterrsphs.png');
				} else if (Session('fakultas') == 'RSPHMLG'){
					$img_file = public_path('kopfooterrsphm.png');
				} else if (Session('fakultas') == 'PDP'){
					$img_file = public_path('kopfooterpdp.png');
				} else {
					$img_file = public_path('kopfooterdpm.png');
				}
				$gethalaman 	= explode('<div style="page-break-before: always"></div>', $generatesurat);
				try {
					PDFCREATOR::SetCreator('Creator');
					PDFCREATOR::SetAuthor('Author');
					PDFCREATOR::SetTitle($marking);
					PDFCREATOR::SetSubject('Subject');
					PDFCREATOR::SetKeywords('Keyword');
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
					Storage::disk('local')->put('/scan/generate/'.$namafile.'.pdf', $pdfdoc);
					$file =  public_path('scan/generate/'.$namafile.'.pdf');
				    return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
					//echo '<iframe src="'.$homebase.'/scan/generate/'.$namafile.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
				} catch (\Exception $e) {
					echo $generatesurat;
				}
			}
		} else {
			if ($keterangan == 'KELUARNONOMER'){
				$gceksrtklr = Suratkeluartnpnomor::where('id', $marking)->first();
				if ($gceksrtklr->jenissrt == 'SCO'){
					echo '<iframe src="'.$homebase.'/2ea2aa47b5cbf1f95b9dd18c1bf8dd4c/'.$gceksrtklr->isisurat.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
				} else {
					echo '<iframe src="'.$homebase.'/viewsurat/31a6c48f03aaf7ab8085cc6b5bd34990-'.$marking.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
				}
			} else if ($keterangan == 'SKDANPERATURAN'){
				$gceksrtklr = Tabelskdanperaturan::where('id', $marking)->first();
				if (isset($gceksrtklr->marking)){
					echo '<iframe src="'.$homebase.'/viewdocbyname/'.$gceksrtklr->marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
				} else {
					echo 'ID '.$marking.' Surat Tidak valid';
				}
			} else if ($keterangan == 'ANTRIAN'){
				echo '<iframe src="'.$homebase.'/2ea2aa47b5cbf1f95b9dd18c1bf8dd4c/'.$marking.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
			} else {
				$gceksrtklr = Suratkeluar::where('id', $marking)->first();
				if (isset($gceksrtklr->id)){
					if ($gceksrtklr->perihal == 'SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR' OR $gceksrtklr->perihal == 'PERPANJANGAN SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR'){
						echo '<iframe src="'.$homebase.'/ttdberkas/keluar-'.$gceksrtklr->id.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
					} else {
						if ($gceksrtklr->jenissrt == 'SCO'){
							echo '<iframe src="'.$homebase.'/2ea2aa47b5cbf1f95b9dd18c1bf8dd4c/'.$gceksrtklr->isisurat.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						} elseif ($gceksrtklr->jenissrt == 'UPLOAD'){
							echo '<iframe src="'.$homebase.'/viewdocbyname/'.$gceksrtklr->marking.'.pdf" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						} elseif ($gceksrtklr->jenissrt == 'SERTIFIKATTTE'){
							echo '<iframe src="'.$homebase.'/sertifikat/'.$gceksrtklr->id.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						} else {
							echo '<iframe src="'.$homebase.'/viewsurat/keluar-view='.$marking.'" width="100%" height="780" style="border: none;" id="previewbymarking"></iframe>';
						}
					}
				} else {
					echo 'ID Surat Tidak valid';
				}
			}
		}
    }
	public function exsimpanTtd(Request $request) {
		$password			= $request->input('val01');
		$idne 				= $request->input('val02');
		$footnote 			= $request->input('val03');
		$tabele 			= $request->input('val04');
		$nonik 				= $request->input('val05');
		$brwoseragen		= Browser::userAgent();
		$browsertipe		= Browser::deviceType();
		$browsername 		= Browser::browserName();
		$browserplatform	= Browser::platformName();
		$komputer 			= $brwoseragen.' '.$browsertipe.' '.$browsername.' '.$browserplatform;
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
		$userid				= Session('id');
		$unitkonseptor		= $fakultas;
		$error				= '';
		$info 				= array(
			'Name' 			=> $namaapps,
			'Location' 		=> $swandhanauniv,
			'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
			'ContactInfo' 	=> $homebase,
		);
		$page_format 		= array(
			'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
			'Dur' 			=> 3,
			'PZ' 			=> 1,
		);
		if ($password == 'kembalikan'){
			$rinbox		= Inboxsurat::where('id', $idne)->first();
			if (isset($rinbox->marking)){
				$marking 	= $rinbox->marking;
				$kerjalm	= $rinbox->kerja;
				$kerja		= $rinbox->kerja;
				$penerima	= $rinbox->penerima;
				$catatan	= $rinbox->catatan;
				$tabele		= $rinbox->jenis;
				$ctanggal	= $rinbox->tanggal;
				$perihal	= $tabele;
				Inboxsurat::where('id', $idne)->update([
					'status'       	=>  'Ditolak',
					'footnote'		=> 	$request->input('val03'),
					'komputer'		=> 	$komputer
				]);
				$ceksurat 	= Suratkeluar::where('marking', $marking)->count();
				if ($ceksurat == 0){
					$ceksurat 	= Tabelskdanperaturan::where('marking', $marking)->count();
					if ($ceksurat == 0){
						$ceksurat 	= Draftsk::where('marking', $marking)->count();
						if ($ceksurat == 0){
							Suratkeluartnpnomor::where('marking', $marking)->update([
								'status'	=> 'Ditolak',
								'footnote'	=> 'Ditolak Oleh '.Session('jabatan')
							]);
						} else {
							Draftsk::where('marking', $marking)->update([
								'status'	=> 'Ditolak',
								'catatan'	=> 'Ditolak Oleh '.Session('jabatan')
							]);
						}	
					} else {
						Tabelskdanperaturan::where('marking', $marking)->update([
							'catatan'	=> 'Ditolak Oleh '.Session('jabatan')
						]);
					}
				} else {
					Suratkeluar::where('marking', $marking)->update([
						'status'	=> 'Ditolak Oleh '.Session('jabatan')
					]);
				}
				SendMail::notif($rinbox->pembuat,$rinbox->pembuat,'Surat '.$rinbox->perihal,' di Tolak Oleh '.Session('jabatan').' Dengan Catatan <p>'.$request->input('val03').'</p>');
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Pesan anda sudah kami sampaikan ke konseptor untuk diperbaiki']);
				return back();
			}
		} else {
			$rinbox						= Inboxsurat::where('id', $idne)->first();
			if (isset($rinbox->marking)){
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
				$tabel 					= $rinbox->tabel;
				$serttte 				= md5($rinbox->email);
				$ceksertifikatpribadi 	= $serttte.'.crt';
				$sertifikatpribadi 		= $serttte.'.csr';
				if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
				} elseif (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
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
						"localityName" 			=> $rinbox->penerima,
						"organizationName" 		=> $swandhanauniv,
						"organizationalUnitName"=> $swandhanafak,
						"commonName" 			=> $namapejabat,
						"emailAddress" 			=> $rinbox->email
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
					if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
						$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
					}
					if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
						$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
					}
				}
				$tanggalesign			= date('Y-m-d H:i:s');
				if ($ctanggal == ''){
					$ctanggal	= 0;
				} else {
					$ctanggal	= (int)$ctanggal;
				}
				$noselanjutnya	= $ctanggal++;
				$ttd 			= 'SIgned With TTE';
				$encoded_image 	= 'SIgned With TTE';
				$pesanok		= '';
				$benergak		= 'TIDAK';
				$textsamplesalah= 'Password Anda Salah';
				$user 			= User::find($userid);
				if (Hash::check($password, $user->password)) {
					if ($rinbox->kerja == 'PARAF'){
						$noselanjutnya = 2;
						if ($rinbox->tanggal == '1'){ $penandatangan = $paraf2; $noselanjutnya = 2; }
						if ($rinbox->tanggal == '2'){ $penandatangan = $paraf3; $noselanjutnya = 3; }
						if ($rinbox->tanggal == '3'){ $penandatangan = $paraf4; $noselanjutnya = 4; }
						if ($rinbox->tanggal == '4'){ $noselanjutnya = 5; }
						if ($penandatangan == 0){ $penandatangan = $rinbox->penandatangan; }
						$getpejabat = Pejabatsurat::where('id', $penandatangan)->first();
						if (isset($getpejabat->id)){
							SendMail::kiriminbox($rinbox->marking,$rinbox->penerima,$getpejabat->pejabat,$getpejabat->email,'KELUAR','PARAF',$footnote,$noselanjutnya);
							Inboxsurat::where('id', $rinbox->id)->update([
								'status'       	=>  'Signed',
								'footnote'		=> 	$request->input('val03'),
								'komputer'		=> 	$komputer
							]);
							return response()->json(['icon' => 'success', 'warna' => '#bf441d', 'status' => 'Succes..!!!', 'message' => 'Surat di Pemaraf Berikutnya : '.$getpejabat->pejabat]);
							return back();
						} else {
							$getpejabat = Pejabatsurat::where('pejabat', 'LIKE', $penandatangan)->first();
							if (isset($getpejabat->id)){
								SendMail::kiriminbox($rinbox->marking,$rinbox->penerima,$getpejabat->pejabat,$getpejabat->email,'KELUAR','TTD',$footnote,$noselanjutnya);
								Inboxsurat::where('id', $rinbox->id)->update([
									'status'       	=>  'Signed',
									'footnote'		=> 	$request->input('val03'),
									'komputer'		=> 	$komputer,
									'terjadwal'		=> 	1
								]);
								return response()->json(['icon' => 'success', 'warna' => '#bf441d', 'status' => 'Succes..!!!', 'message' => 'Surat di Pemaraf Berikutnya : '.$getpejabat->pejabat]);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Gagal Proses ke '.$penandatangan.', Ulangi Beberapa Saat Lagi']);
								return back();
							}
						}
					} else {
						$input = Inboxsurat::where('id', $idne)->update([
							'status'       	=>  $ttd,
							'footnote'		=> 	$request->input('val03'),
							'komputer'		=> 	$komputer,
							'terjadwal'		=> 	1,
							'updated_at'	=> date('Y-m-d H:i:s')
						]);
						if ($input){
							return response()->json(['icon' => 'success', 'warna' => '#bf441d', 'status' => 'Succes..!!!', 'message' => 'Terimakasih '.$penerima]);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'GAGAL..!!!', 'message' => 'Gagal Proses Penandatanganan, Ulangi Beberapa Saat Lagi']);
							return back();
						}
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Passphare Salah, Mohon Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				$textsamplesalah = 'ID '.$idne.' Tidak di Temukan, Periksa Kembali Surat Ini. Dan Hubungi Admin Pengirim Surat';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $textsamplesalah]);
				return back();
			}
		}
    }
	public function exsimpanttdMulti(Request $request) {
		$password			= $request->input('val01');
		$footnote			= $request->input('val02');
		$arridinbox			= $request->input('val03');
		$nonik				= $request->input('val04');
		$userid				= Session('id');
		$fakultas			= Session('fakultas');
		$brwoseragen		= Browser::userAgent();
		$browsertipe		= Browser::deviceType();
		$browsername 		= Browser::browserName();
		$browserplatform	= Browser::platformName();
		$komputer 			= $brwoseragen.' '.$browsertipe.' '.$browsername.' '.$browserplatform;
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
		$userid				= Session('id');
		$unitkonseptor		= $fakultas;
		$error				= '';
		$pesanok 			= 0;
		$page_format 		= array(
			'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
			'Dur' 			=> 3,
			'PZ' 			=> 1,
		);
		if ($password == 'PENOLAKAN'){
			foreach ($arridinbox as $idne){
				$rinbox		= Inboxsurat::where('id', $idne)->first();
				if (isset($rinbox->marking)){
					$marking 	= $rinbox->marking;
					$kerjalm	= $rinbox->kerja;
					$kerja		= $rinbox->kerja;
					$penerima	= $rinbox->penerima;
					$catatan	= $rinbox->catatan;
					$tabele		= $rinbox->jenis;
					$ctanggal	= $rinbox->tanggal;
					$perihal	= $tabele;
					Inboxsurat::where('id', $idne)->update([
						'status'       	=>  'Ditolak',
						'footnote'      =>  $request->input('val02'),
						'komputer'		=> 	$komputer
					]);
					$ceksurat 	= Suratkeluar::where('marking', $marking)->count();
					if ($ceksurat == 0){
						$ceksurat 	= Tabelskdanperaturan::where('marking', $marking)->count();
						if ($ceksurat == 0){
							$ceksurat 	= Draftsk::where('marking', $marking)->count();
							if ($ceksurat == 0){
								Suratkeluartnpnomor::where('marking', $marking)->update([
									'status'	=> 'Ditolak',
									'footnote'	=> 'Ditolak Oleh '.Session('jabatan')
								]);
							} else {
								Draftsk::where('marking', $marking)->update([
									'status'	=> 'Ditolak',
									'catatan'	=> 'Ditolak Oleh '.Session('jabatan')
								]);
							}	
						} else {
							Tabelskdanperaturan::where('marking', $marking)->update([
								'catatan'	=> 'Ditolak Oleh '.Session('jabatan')
							]);
						}
					} else {
						Suratkeluar::where('marking', $marking)->update([
							'status'	=> 'Ditolak Oleh '.Session('jabatan')
						]);
					}
					$pesanok++;
				}
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Inbox Sejumlah '.$pesanok.' Sudah Kami Kembalikan ke Konseptor']);
			return back();
		} else {
			$ttd 					= 'SIgned With TTE'; 
			$encoded_image 			= 'SIgned With TTE';
			$benergak				= 'TIDAK';
			$textsamplesalah		= 'Password Anda Salah';
			$serttte 				= md5(Session('email'));
			$ceksertifikatpribadi 	= $serttte.'.crt';
			$sertifikatpribadi 		= $serttte.'.csr';
			$certificate			= '';
			if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
				$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
			}
			if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
				$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
			}
			if ($certificate == ''){
				$dn = array(
					"countryName" 			=> "IN",
					"stateOrProvinceName" 	=> "East Java Indonesia",
					"localityName" 			=> $swandhanakota,
					"organizationName" 		=> Session('jabatan'),
					"organizationalUnitName"=> $swandhanafak,
					"commonName" 			=> Session('nama'),
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
				if (file_exists(base_path().'/public/tte/'.$ceksertifikatpribadi)){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
				}
				if (file_exists(public_path().'/tte/'.$ceksertifikatpribadi)){
					$certificate 	= 'file://'.public_path().'/tte/'.$ceksertifikatpribadi;
				}
			}
			$user 				= User::find($userid);
			$info 				= array(
				'Name' 			=> $namaapps,
				'Location' 		=> $swandhanauniv,
				'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
				'ContactInfo' 	=> $homebase,
			);
			if (Hash::check($password, $user->password) AND $certificate != '') {
				foreach ($arridinbox as $idne){
					Inboxsurat::where('id', $idne)->update([
						'status'       	=>  $ttd,
						'footnote'		=> 	$request->input('val02'),
						'komputer'		=> 	$komputer,
						'terjadwal'		=> 	1
					]);
					$pesanok++;
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tandatangan Surat Sejumlah '.$pesanok.' '.$error]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Passphare Salah, Mohon Ulangi Beberapa Saat Lagi']);
				return back();
			}
		}
	}
	public static function getTextExternal($jenis, $id){
        $text = getTextKepegawaian($jenis.'='.$id);
		echo $text;
    }
}