<?php

namespace App\Http\Controllers\Sco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMail;
use App\User;
use App\Penerimasurat;
use App\Simpegpegawai;
use App\Pejabatsurat;
use App\Inboxsurat;
use App\Suratkeluar;
use App\Firebasebank;
use App\Detailpegawai;
use App\Tujuandisposisi;
use App\Histories;
use App\Suratkeluartnpnomor;
use App\AntrianTTE;
use App\Banksoal;
use App\Banksoaltest;
use App\Banksoalujian;
use App\JadwalPiket;
use App\RekapPresensi;
use App\WebinarEventlist;
use App\Models\Golongan;
use App\Models\AreaKerja;
use App\Models\RiwayatGaji;
use App\Models\Ppabp;
use App\Models\PegawaiKeuangan;
use App\Models\Kelasremun;
use App\Models\Dokarkgb;
use App\Models\Dokarnaikpangkat;
use App\Models\TblGaji;
use App\Models\TblGajiPNS;
use App\Models\Templateskpp;
use App\Models\KodeTanggunganPajak;
use App\Models\Unitsurat;
use App\Models\Jenissurat;
use App\Models\Draftsk;
use App\Models\DraftRemunerasi;
use App\Models\DraftKenaikanpangkat;
use App\Models\Draftjabakad;
use App\Models\Draftpemberhentian;
use App\Models\Draftjabpelaksana;
use App\Models\Hakaksess;
use App\Models\Dosen;
use App\Models\Detailidentitas;
use App\Models\Kelompoklain;
use App\Models\Pengajuansimpukja;
use App\Models\Tblemailkepegkeu;
use App\Models\Drafttubel;
use App\Models\Antrian;
use App\Models\AntrianMagang;
use App\Models\Biodata;
use App\Models\MasterPS;
use App\Models\DraftpengangkatanPNS;
use App\Models\Draftpenyesuaiangaji;
use App\Models\DraftUjiandinas;
use App\Models\DraftKontrak;
use App\Models\Pesennomor;
use App\Models\AntrianUjian;
use App\Models\Detailnilujian;
use App\Models\Tabelskdanperaturan;
use App\Models\DataBPJS;
use App\Models\DppsasAnggota;
use App\Models\Nomor;
use App\Models\DataFaskes;
use App\Models\Files;
use App\Models\Aktifitas;
use App\Models\KLasifikasikepakaran;
use App\Models\DataLATSAR;
use App\Models\DataPelanggaranLATSAR;
use App\Models\MateriLATSAR;
use App\Models\DataKeaktifanLATSAR;
use Carbon\Carbon;
use GuzzleHttp\Client;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use DateTime;
use PDF;
use App;
use QrCode;
use Validator;
use Session;
use Auth;
use PDFCREATOR;
use Hash;
define( 'API_ACCESS_KP', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );

function TerbilangKP($x){
	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($x < 12)
	  return " " . $abil[$x];
	elseif ($x < 20)
	  return TerbilangKP($x - 10) . " belas";
	elseif ($x < 100)
	  return TerbilangKP($x / 10) . " puluh" . TerbilangKP($x % 10);
	elseif ($x < 200)
	  return " seratus" . TerbilangKP($x - 100);
	elseif ($x < 1000)
	  return TerbilangKP($x / 100) . " ratus" . TerbilangKP($x % 100);
	elseif ($x < 2000)
	  return " seribu" . TerbilangKP($x - 1000);
	elseif ($x < 1000000)
	  return TerbilangKP($x / 1000) . " ribu" . TerbilangKP($x % 1000);
	elseif ($x < 1000000000)
	  return TerbilangKP($x / 1000000) . " juta" . TerbilangKP($x % 1000000);
	elseif ($x < 1000000000000)
	  return TerbilangKP($x / 1000000000) . " milyar" . TerbilangKP($x % 1000000000);
	elseif ($x < 1000000000000000)
	  return TerbilangKP($x / 1000000000000) . " trilyun" . TerbilangKP($x % 1000000000000);
}
class KegepawaianController extends Controller
{
//DASHBOARD + SETTING + VERIFIKATOR DOKAR
	public function index() {
        $tasks				= [];
		$golongans 			= Golongan::orderBy('id', 'ASC')->get();
		$kodepajak 			= KodeTanggunganPajak::orderBy('kode', 'ASC')->get();
		$mkgthnlist			= TblGajiPNS::groupBy('masakerja')->orderBy('masakerja', 'ASC')->get();
		$fakultas			= Session('fakpanjang');
		if ($fakultas == ''){ $fakultas = 'Kantor Pusat'; }
		$mkelompok			= Session('previlage');
		$ppabp 				= Simpegpegawai::groupBy('ppabp')->get();
		$pejabats			= Pejabatsurat::where('fakultas', 'LIKE', '%'.Session('fakultas').'%')->orderBy('id', 'ASC')->get();
		$jgrpremun			= Kelasremun::groupBy('bidang')->select('bidang')->orderBy('id')->get();
		$jgrptblgaji		= TblGajiPNS::groupBy('kode')->select('kode')->orderBy('kode')->get();
		$i					= 0;
        foreach ($jgrptblgaji as $rtblgaji) {
            $j  				= 0;
            $kode				= $rtblgaji->kode;
			$getdatapangkaat	= Golongan::where('kode', $kode)->first();
			if (isset($getdatapangkaat->id)){
				$pangkat		= $getdatapangkaat->pangkat;
				$golongan		= $getdatapangkaat->golongan;
				$pangkat		= $pangkat.', '.$golongan;
			} else {
				$pangkat		= '';
				$golongan 		= '';
			}
            $jtabel  			= TblGajiPNS::where('kode', $kode)->get();
            foreach ($jtabel as $rtabel) {
				$gapok 	= $rtabel->nominal;
				$gapok	= number_format( $gapok, 0 , '.' , ',' );
				$tasks['tabelgaji'][$i][$j]['idne']			=   $rtabel->id;
                $tasks['tabelgaji'][$i][$j]['kode']			=   $kode;
                $tasks['tabelgaji'][$i][$j]['masakerja']	=   $rtabel->masakerja;
				$tasks['tabelgaji'][$i][$j]['gapok']		=   $gapok;
				$tasks['tabelgaji'][$i][$j]['pangkat']		=   $pangkat;
                $j++;
            }
            $i++;
        }
		$x  = 0;
        foreach ($jgrptblgaji as $rtblgaji) {
			$kode				= $rtblgaji->kode;
			$getdatapangkaat	= Golongan::where('kode', $kode)->first();
			if (isset($getdatapangkaat->id)){
				$pangkat		= $getdatapangkaat->pangkat;
				$golongan		= $getdatapangkaat->golongan;
				$pangkat		= $pangkat.', '.$golongan;
			} else {
				$pangkat		= '';
				$golongan 		= '';
			}
            $tasks['grouptabelgaji'][$x] = $pangkat;
            $x++;
        }
		$jgrptblgajipns		= TblGajiPNS::groupBy('kode')->select('kode')->orderBy('kode')->get();
		$i					= 0;
        foreach ($jgrptblgajipns as $rtblgajipns) {
            $j  				= 0;
            $kode				= $rtblgajipns->kode;
			$getdatapangkaat	= Golongan::where('kode', $kode)->first();
			if (isset($getdatapangkaat->id)){
				$pangkat		= $getdatapangkaat->pangkat;
				$golongan		= $getdatapangkaat->golongan;
				$pangkat		= $pangkat.', '.$golongan;
			} else {
				$pangkat		= '';
				$golongan 		= '';
			}
            $jtabel  			= TblGajiPNS::where('kode', $kode)->get();
            foreach ($jtabel as $rtabel) {
				$gapok 	= $rtabel->nominal;
				$gapok	= number_format( $gapok, 0 , '.' , ',' );
				$tasks['tabelgajipns'][$i][$j]['idne']		=   $rtabel->id;
                $tasks['tabelgajipns'][$i][$j]['kode']		=   $kode;
                $tasks['tabelgajipns'][$i][$j]['masakerja']	=   $rtabel->masakerja;
				$tasks['tabelgajipns'][$i][$j]['gapok']		=   $gapok;
				$tasks['tabelgajipns'][$i][$j]['pangkat']	=   $pangkat;
                $j++;
            }
            $i++;
        }
		$x  = 0;
        foreach ($jgrptblgajipns as $rtblgajipns) {
			$kode				= $rtblgajipns->kode;
			$getdatapangkaat	= Golongan::where('kode', $kode)->first();
			if (isset($getdatapangkaat->id)){
				$pangkat		= $getdatapangkaat->pangkat;
				$golongan		= $getdatapangkaat->golongan;
				$pangkat		= $pangkat.', '.$golongan;
			} else {
				$pangkat		= '';
				$golongan 		= '';
			}
            $tasks['grouptabelgajipns'][$x] = $pangkat;
            $x++;
        }
		$i					= 0;
        foreach ($jgrpremun as $rgrpremun) {
            $j  		= 0;
            $bidang		= $rgrpremun->bidang;
            $jklas  	= Kelasremun::where('bidang', $bidang)->get();
            foreach ($jklas as $rklas) {
                $tasks['klsremun'][$i][$j]['idkelas']	=   $rklas->id;
                $tasks['klsremun'][$i][$j]['jabatan']	=   $rklas->jabatan;
				$tasks['klsremun'][$i][$j]['kelas']		=   $rklas->kelas;
				$tasks['klsremun'][$i][$j]['point']		=   $rklas->point;
				$tasks['klsremun'][$i][$j]['tgp']		=   $rklas->tgp;
				$tasks['klsremun'][$i][$j]['insentif']	=   $rklas->insentif;
                $j++;
            }
            $i++;
        }
		$x  = 0;
        foreach ($jgrpremun as $kgrpklasremun) {
            $tasks['klasifikasiremun'][$x]  =   $kgrpklasremun->bidang;
            $x++;
        }
		if ($fakultas == 'Kantor Pusat'){
			$cekpengajuankgb	= Dokarkgb::where('status', '!=', 'Arsip')->count();
			$cekpengajuanpkt	= Dokarnaikpangkat::where('status', '!=', 'Arsip')->count();
			
		} else {
			$cekpengajuankgb	= Dokarkgb::where('status', '!=', 'Arsip')->where('fakultas', $fakultas)->count();
			$cekpengajuanpkt	= Dokarnaikpangkat::where('status', '!=', 'Arsip')->where('unitkonseptor', $fakultas)->count();
		}
		if ($cekpengajuankgb == 0){
			$tlspengajuankgb = 'Buat Draft KGB Baru';
		} else {
			$tlspengajuankgb = $cekpengajuankgb.' Draft KGB Belum Terselesaikan';
		}
		if ($cekpengajuanpkt == 0){
			$tlspengajuanpkt = 'Buat Draft SK Kenaikan Pangkat Baru';
		} else {
			$tlspengajuanpkt = $cekpengajuanpkt.' Draft SK Kenaikan Pangkat Belum Terselesaikan';
		}
		$cekketerangan 				= Dokarkgb::orderBy('id', 'DESC')->count();
		if ($cekketerangan == 0){ $keterangankgb = 'Diharap agar sesuai dengan Peraturan Rektor Nomor 74 Tahun 2016 kepada Pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok yang baru'; }
		else {
			$getketerangankgb		= Dokarkgb::orderBy('id', 'DESC')->first();
			$keterangankgb			= $getketerangankgb->penutup;
		}
		$menimbangpangkatnon		= '<table width="800" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;"><tr><td valign="top">Menimbang</td><td valign="top">:</td><td valign="top">a.</td><td colspan="4" valign="top">bahwa saudara sebagaimana dimaksud dalam Keputusan Rektor ini memenuhi syarat dan dipandang cakap untuk diberikan kenaikan pangkat;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">b.</td><td colspan="4" valign="top">bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, perlu menetapkan Keputusan Rektor tentang Kenaikan Pangkat Tenaga Kependidikan Tetap Non PNS;</td></tr><tr><td colspan="7">&nbsp;</td></tr></table>';
		$mengingatpangkatnon		= '<table width="800" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;"><tr><td valign="top">Mengingat</td><td valign="top">:</td><td valign="top">1.</td><td colspan="4" valign="top">Undang - Undang Nomor 12 Tahun 2012;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">2.</td><td colspan="4" valign="top">Peraturan Pemerintah Nomor 99 Tahun 2000 sebagaimana diubah dengan Peraturan Pemerintah Nomor 12 Tahun 2002;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">3.</td><td colspan="4" valign="top">Peraturan Pemerintah Nomor 11 Tahun 2017;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">4.</td><td colspan="4" valign="top">Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor 4 Tahun 2016 sebagaimana telah diubah dengan Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor 34 Tahun 2016;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">5.</td><td colspan="4" valign="top">Keputusan Menteri Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor 98 Tahun 2016;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">6.</td><td colspan="4" valign="top">Keputusan Menteri Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor 58 Tahun 2018;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">7.</td><td colspan="4" valign="top">Peraturan Rektor Universitas Brawijaya Nomor 20 Tahun 2016 sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Rektor Universitas Brawijaya Nomor 18 Tahun 2019;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">8.</td><td colspan="4" valign="top">Peraturan Rektor Universitas Brawijaya Nomor 74 Tahun 2016 sebagaimana telah diubah dengan Peraturan Rektor Universitas Brawijaya Nomor 8 Tahun 2018;</td></tr><tr><td colspan="7">&nbsp;</td></tr></table>';
		$menetapkanpangkatnon		= 'KEPUTUSAN REKTOR TENTANG KENAIKAN PANGKAT TENAGA KEPENDIDIKAN TETAP NON-PNS.';
		$gettemplate				= Templateskpp::where('inputor', $mkelompok)->get();
		foreach( $gettemplate as $rtemplate ){
			$jenissk				= $rtemplate->jenissk;
			if ($jenissk == 'Pangkat NON-PNS'){
				$menimbangpangkatnon		= $rtemplate->menimbang;
				$mengingatpangkatnon		= $rtemplate->mengingat;
				$menetapkanpangkatnon		= $rtemplate->menetapkan;
			}
		}
		$pejabatsawal					= User::where('fakultas', Session('fakultas'))->whereIn('previlage', ['Subkoordinator Subbagian Tenaga Kependidikan', 'Subkoordinator Subbagian Pendidik', 'Kepala Subdit Manajemen Dosen', 'Kepala Subdit Manajemen Tenaga Kependidikan'])->orderBy('id', 'ASC')->get();
		$tasks['kodepajak'] 			= $kodepajak;
		$tasks['pejabatsawal'] 			= $pejabatsawal;
		$tasks['pejabats'] 				= $pejabats;
		$tasks['pengajuanpangkat'] 		= $tlspengajuanpkt;
		$tasks['pengajuankgb'] 			= $tlspengajuankgb;
		$tasks['keterangankgb'] 		= $keterangankgb;
		$tasks['golongan'] 				= $golongans;
		$tasks['mkgthnlist'] 			= $mkgthnlist;
		$tasks['fakultas']				= $fakultas;
		$tasks['ppabp'] 				= $ppabp;
		$tasks['menimbangpangkatnon']   = $menimbangpangkatnon;
		$tasks['mengingatpangkatnon']   = $mengingatpangkatnon;
		$tasks['menetapkanpangkatnon']  = $menetapkanpangkatnon;
		$tasks['mkelompok']      		= $mkelompok;
		$tasks['sidebar']				= 'dashboarddokar';
    	return view('dokar.dashbord', $tasks);
	}
	public function dokarsetting() {
        $tasks						= [];
		$golongans 					= Golongan::orderBy('id', 'ASC')->get();
		$mkgthnlist					= TblGajiPNS::groupBy('masakerja')->orderBy('masakerja', 'ASC')->get();
		$fakultas					= Session('fakpanjang');
		if ($fakultas == ''){ $fakultas = 'Kantor Pusat'; }
		$ppabp 						= Simpegpegawai::groupBy('ppabp')->get();
		$pejabats					= Pejabatsurat::where('fakultas', 'LIKE', '%'.Session('fakultas').'%')->orderBy('id', 'ASC')->get();
		$tasks['pejabats'] 			= $pejabats;
		$tasks['golongan'] 			= $golongans;
		$tasks['mkgthnlist'] 		= $mkgthnlist;
		$tasks['fakultas']			= $fakultas;
		$tasks['ppabp'] 			= $ppabp;
		$tasks['sidebar']			= 'dokarsetting';
    	return view('dokar.settingkepeg', $tasks);
	}
	public function getValredaksi(Request $request) {
		$jenis  		= $request->input('set01');
		$gettemplate	= Templateskpp::where('namask', $jenis)->where('fakultas', Session('fakultas'))->first();
		if (isset($gettemplate->mengingat)){
			$nama		= $gettemplate->inputor;
			$judul		= $gettemplate->judul;
			$menimbang	= $gettemplate->menimbang;
			$mengingat	= $gettemplate->mengingat;
			$menetapkan	= $gettemplate->menetapkan;
			$memutuskan	= $gettemplate->memutuskan;
			$tembusan	= $gettemplate->tembusan;
			$kapan		= $gettemplate->updated_at->tostring();
		} else {
			$nama		= 'Belum Ada';
			$judul		= '
			<table width="640" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Bookman Old Style;">
				<tr><td height="45" colspan="7" align="center">KEPUTUSAN REKTOR UNIVERSITAS BRAWIJAYA</td></tr>
				<tr><td height="22" colspan="7" align="center">NOMOR [nomor] TAHUN [tahun]</td></tr>
				<tr><td height="22" colspan="7" align="center">TENTANG</td></tr>
				<tr><td height="22" colspan="7" align="center">.........................</td></tr>
				<tr><td height="22" colspan="7" align="center">REKTOR UNIVERSITAS BRAWIJAYA</td></tr></table>
			';
			$mengingat	= '<table width="640" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Bookman Old Style;"><tr><td valign="top">Mengingat</td><td valign="top">:</td><td valign="top">1.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">2.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">3.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">4.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">5.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">6.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">7.</td><td colspan="4" valign="top">...</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">8.</td><td colspan="4" valign="top">...</td></tr><tr><td colspan="7">&nbsp;</td></tr></table>';
			$tembusan	= '';
			$kapan		= 'New';
			$menimbang	= '<table width="800" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Bookman Old Style;"><tr><td valign="top">Menimbang</td><td valign="top">:</td><td valign="top">a.</td><td colspan="4" valign="top">bahwa saudara sebagaimana dimaksud dalam Keputusan Rektor ini memenuhi syarat dan dipandang cakap untuk ................;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">b.</td><td colspan="4" valign="top">bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, perlu menetapkan Keputusan Rektor tentang ......................;</td></tr><tr><td colspan="7">&nbsp;</td></tr></table>';
			$menetapkan	= 'KEPUTUSAN REKTOR TENTANG ...........';
			$memutuskan	= '
			<table width="640" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Bookman Old Style;">
				<tr><td valign="top">KESATU</td><td valign="top">:</td><td colspan="5" valign="top" height="35" >Terhitung mulai tanggal [tmtsk] pegawai sebagai berikut :</td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td><td>1.</td><td>Nama</td><td valign="top">:</td><td colspan="2" valign="top">[nama_lengkap]</td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">2.</td><td valign="top">NIP / NIK</td><td valign="top">:</td><td colspan="2" valign="top">[nip]</td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top">3.</td><td valign="top">Pangkat, Golongan</td><td valign="top">:</td><td colspan="2" valign="top">[pangkat], Gol. [golongan]</td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td><td valign="top" height="35" >6.</td><td valign="top">Unit Kerja</td><td valign="top">:</td><td colspan="2" valign="top">[unitkerja]</td></tr>
				<tr><td valign="top">KEDUA</td><td  valign="top">:</td><td colspan="5" valign="top">................</td></tr>
				<tr><td valign="top">KETIGA</td><td valign="top">:</td><td colspan="5" valign="top">................</td></tr>
				<tr><td valign="top">KEEMPAT</td><td valign="top">:</td><td colspan="5" valign="top">Asli keputusan ini diberikan kepada pegawai yang bersangkutan untuk dipergunakan sebagaimana mestinya</td></tr>
				<tr>
					<td width="97">&nbsp;</td>
					<td width="27">&nbsp;</td>
					<td width="27">&nbsp;</td>
					<td width="148">&nbsp;</td>
					<td width="27">&nbsp;</td>
					<td width="141">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			';
		}
		return response()->json([
				'nama' 			=> $nama, 
				'kapan' 		=> $kapan, 
				'jenis' 		=> $jenis, 
				'judul' 		=> $judul, 
				'menetapkan' 	=> $menetapkan, 
				'menimbang' 	=> $menimbang, 
				'memutuskan' 	=> $memutuskan, 
				'tembusan' 		=> $tembusan, 
				'text' 			=> $mengingat
		]);
		return back();
		
	}
	public function exTesemail(Request $request) {
		$tesemail1  = $request->input('set01');
		$tesemail2  = $request->input('set02');
		$getdata	= Tblemailkepegkeu::where('id', '1')->first();
		$emailkepeg	= $getdata->emailkepeg;
		$emailpass	= $getdata->emailkeu;
		if($tesemail1 == '-'){ $tesemail1 = ''; }
		if($tesemail2 == '-'){ $tesemail2 = ''; }
		$teserror	= '';
		$perihal 	= 'Tes Send Email';
		$emailbody	= 'Tes Send Email';
		$contactName= 'SCO Email Service';
		$data 		= array('name'=>'SCO Email Service', 'email'=>$emailkepeg, 'isisurat'=>$emailbody);
		if ($tesemail1 != ''){
			try {
				Mail::send('email', $data, function($message)use ($tesemail1, $perihal){
					$message->to($tesemail1, 'sco@ub.ac.id')->subject($perihal);			
				});
			} catch (\Exception $e) {
				$teserror = $teserror.' Gagal Kirim ke '.$tesemail1;
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $e]);
				return back();
			}
		}
		if ($tesemail2 != ''){
			try {
				Mail::send('email', $data, function($message)use ($tesemail2, $perihal){
					$message->to($tesemail2, 'myName')->subject($perihal);			
				});
			} catch (\Exception $e) {
				$teserror = $teserror.' Gagal Kirim ke '.$tesemail2;
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $e]);
				return back();
			}
		}
		if($teserror == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tes Send Ke Email '.$tesemail1.' dan '.$tesemail2.' Sukses']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $teserror]);
			return back();
		}
	}
	public function statjenispegawai() {
		$arrjenispeg 	= [];
		$fakultas 		= Session('fakpanjang');
		$homebase		= url("/");
		$alldata		= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->orWhere('status_pegawai', 'Aktif')->groupBy('jenispeg')->count();
		$getallpeg		= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->orWhere('status_pegawai', 'Aktif')->groupBy('jenispeg')->get();
		foreach($getallpeg as $rpegawai){
			$jenispeg 		= $rpegawai->jenispeg;
			$jumlah			= 0;
			$jumlah 		= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->where('jenispeg', $jenispeg)->count();
			$prosentase 	= ($jumlah / $alldata)*100;
			$arrjenispeg[] 	= array(
				'jenispeg' 	=> $jenispeg.' Sejumlah '.$jumlah.' Pegawai',
				'jumlah' 	=> $prosentase,
			);
		}
		echo json_encode($arrjenispeg);
	}
	public function statgolongan() {
		$arrjenisgol 		= [];
		$fakultas 	= Session('fakpanjang');
		$alldata	= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->orWhere('status_pegawai', 'Aktif')->count();
		
		$getallpeg	= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->orWhere('status_pegawai', 'Aktif')->groupBy('golongan')->get();
		foreach($getallpeg as $rpegawai){
			$golongan 		= $rpegawai->golongan;
			$getpangkat		= Golongan::where('kode', $golongan)->count();
			if ($getpangkat != 0){
				$getpangkat	= Golongan::where('kode', $golongan)->first();
				$gol 		= $getpangkat->golongan;
				$pangkat	= $getpangkat->pangkat;
				$tulis		= $gol;
			} else { $tulis = $golongan; }
			$jumlah			= 0;
			$jumlah 		= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->where('golongan', $golongan)->count();
			$prosentase 	= ($jumlah / $alldata)*100;
			$arrjenisgol[] 	= array(
				'jenisgolongan' 	=> $tulis,
				'jumlah' 			=> $jumlah,
			);
		}
		echo json_encode($arrjenisgol);
	}
	public function statpendidikan() {
		$arrpendidikan	= [];
		$fakultas 		= Session('fakpanjang');
		$alldata		= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->orWhere('status_pegawai', 'Aktif')->count();
		$getallpeg		= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->orWhere('status_pegawai', 'Aktif')->groupBy('pend_akhir')->get();
		foreach($getallpeg as $rpegawai){
			$pendidikan			= $rpegawai->pend_akhir;
			$jumlah				= 0;
			$jumlah 			= Simpegpegawai::where('ppabp', $fakultas)->where('status_pegawai', '1')->where('pend_akhir', $pendidikan)->count();
			$prosentase 		= ($jumlah / $alldata)*100;
			if ($pendidikan == ''){ $pendidikan = 'Unknown'; }
			$arrpendidikan[] 	= array(
				'pendidikan' 	=> $pendidikan.' Sejumlah '.$jumlah,
				'jumlah' 		=> $prosentase,
			);
		}
		echo json_encode($arrpendidikan);
	}
	public function jstatpensiun(Request $request) {
		$arrpensiun			= [];
		$fakultas 			= Session('fakpanjang');
		$sortdatafield		= 'tmt_pensiun';
		$sortorder			= 'DESC';
        $jenis				= '';
		$pagesize			= 10;
        $pagesize      		= ($request->input('pagesize') == null ? $pagesize : $request->input('pagesize'));
		$pagenum    		= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  		= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  	= ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  		= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
		$jenis  			= ($request->input('jenis') == null ? $jenis : $request->input('jenis'));
		if (Session('fakultas') == 'DPM' AND Session('previlage') == 'Admin SDM'){
			$data			= Simpegpegawai::whereIn('status_pegawai', ['1', 'Aktif']);
		} else {
			$data			= Simpegpegawai::where('ppabp', $fakultas)->whereIn('status_pegawai', ['1', 'Aktif']);
		}
		if ($filterscount > 0){
			for ($i = 0; $i < $filterscount; $i++){
				$filtervalue		= $request->input('filtervalue'.$i);
				$filterdatafield  	= $request->input('filterdatafield'.$i);
				$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
			}
		} else {
			if ($jenis == 'kontrak'){
				$data 			= $data->where('jenispeg', 'LIKE', '%kontrak%')->orWhere('status_jabatan', 'Penerimaan Staf');
			}
		}
		$pagenum++;
		$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($pagesize, ['*'], 'page', $pagenum);
		$totaldata	= $data->total();
		if (!empty($data)){
			foreach($data as $rpegawai){
				$idne		= $rpegawai->id;
				$tanggal	= $rpegawai->tmt_pensiun;
				if ($rpegawai->tmt_pensiun == '1900-01-00' OR is_null($rpegawai->tmt_pensiun)){
					if ($rpegawai->tmt_jabatan == '1900-01-00' OR is_null($rpegawai->tmt_jabatan)){
						if ($rpegawai->tmt_golongan == '1900-01-00' OR is_null($rpegawai->tmt_golongan)){
							if ($rpegawai->tmt_fungsional == '1900-01-00' OR is_null($rpegawai->tmt_fungsional)){
								$tanggal = date("Y-m-d");
							} else {
								$tanggal = $rpegawai->tmt_fungsional;
							}
						} else {
							$tanggal = $rpegawai->tmt_golongan;
						}
					} else {
						$tanggal = $rpegawai->tmt_jabatan;
					}
					Simpegpegawai::where('id', $rpegawai->id)->update([
						'tmt_pensiun'	=> $tanggal
					]);
				}
				$arrpensiun[] 	= array(
					'id' 				=> $idne,
					'nama_lengkap' 		=> $rpegawai->nama_lengkap,
					'ppabp'				=> $rpegawai->ppabp,
					'unit_kerja'		=> $rpegawai->unit_kerja,
					'tmt_pensiun'		=> $tanggal,
				);
			}
		}
		$response = [
            'message'   => 'List Laporan',
            'data'      => $arrpensiun,
            'total'     => $totaldata
        ];
        return response()->json($response, 200);
	}
	public function jstatpangkat() {
		$getallpeg		= Simpegpegawai::where('ppabp', Session('fakpanjang'))->where('status_pegawai', '1')->whereNotNull('tmt_cpns')->whereNotIn('tmt_cpns', ['0000-00-00', '1900-01-00'])->orderBy('tmt_cpns', 'ASC')->get();
		echo json_encode($getallpeg);
	}
	public function jstatgaji() {
		$arrgaji	= [];
		$fromDate 		= Carbon::today()->subDays(600);
		$todate 		= Carbon::today()->addDay(90);
		$fromDate		= $fromDate->toDateString();	
		$todate			= $todate->toDateString();
		//$getallpeg	= Dokarkgb::whereBetween('tmtgapokbaru', [$date, $to])->get();
		//DB::enableQueryLog();
		//$getallpeg 		=  DB::select('SELECT * FROM db_simpeg.kp_kgb WHERE tmtgapokbaru BETWEEN 2017-01-01 AND 2020-01-01');
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Dokarkgb::whereBetween('tmtgapokbaru', [$fromDate, $todate])->get();
		} else {
			$getallpeg	= Dokarkgb::where('fakultas', Session('fakpanjang'))->whereBetween('tmtgapokbaru', [$fromDate, $todate])->get();
			
		}
		//dd(DB::getQueryLog());
		
		if (!empty($getallpeg)){
			foreach($getallpeg as $rpegawai){
				if (isset($rpegawai->nama)){
					$arrgaji[] 	= array(
						'nama' 			=> $rpegawai->nama,
						'nip'			=> $rpegawai->nik,
						'jenispeg' 		=> $rpegawai->jenispeg,
						'unitkerja'		=> $rpegawai->unitkerja,
						'tmtgapokbaru'	=> $rpegawai->tmtgapokbaru,
						'status'		=> $rpegawai->status,
						'golgajibaru'	=> $rpegawai->golgajibaru,
						'gapokbaru'		=> $rpegawai->gapokbaru,
					);
				}
			}
		}
		echo json_encode($arrgaji);
	}
	public function statLamajabatan() {
		$arrstatistik	= [];
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Pejabatsurat::groupBy('fakreal')->orderBy('fakreal', 'ASC')->orderBy('kode', 'ASC')->get();
			if (!empty($getallpeg)){
				foreach($getallpeg as $rpegawai){
					$val01 		= Pejabatsurat::where('fakreal', $rpegawai->fakreal)->count();
					$val02 		= Pejabatsurat::where('fakreal', $rpegawai->fakreal)->where('created_at', '<=', Carbon::now()->subDays(356)->toDateTimeString())->count();
					$val03 		= Pejabatsurat::where('fakreal', $rpegawai->fakreal)->where('created_at', '<=', Carbon::now()->subDays(712)->toDateTimeString())->count();
					if ($val01 != 0){
						$total 	= $val01;
						$val02	= $val02 - $val03;
						$val01	= $total - $val02 - $val03;
						$val01	= round((($val01/$total) * 100), 0);
						$val02	= round((($val02/$total) * 100), 0);
						$val03	= round((($val03/$total) * 100), 0);
					}
					$arrstatistik[] 	= array(
						'fakultas'	=> $rpegawai->fakreal,
						'val01'		=> $val01,
						'val02'		=> $val02,
						'val03'		=> $val03,
					);
				}
			}
		} else {
			$getallpeg	= Pejabatsurat::where('fakreal', 'LIKE', '%'.Session('fakultas').'%')->get();
			if (!empty($getallpeg)){
				foreach($getallpeg as $rpegawai){
					$val01 		= $rpegawai->created_at;
					$val01 		= Carbon::parse($val01)->age;
					$val02		= 0;
					$val03		= 0;
					$arrstatistik[] 	= array(
						'fakultas'	=> $rpegawai->pejabat,
						'val01'		=> $val01,
						'val02'		=> $val02,
						'val03'		=> $val03,
					);
				}
			}
		}
		echo json_encode($arrstatistik);
		
	}
	public function jsonPejabat() {
		$arrgaji	= [];
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Pejabatsurat::orderBy('fakreal', 'ASC')->orderBy('kode', 'ASC')->get();
		} else {
			$getallpeg	= Pejabatsurat::whereIn('fakultas', [Session('fakultas'), 'KP-'.Session('fakultas')])->orderBy('kode', 'ASC')->get();
		}
		if (!empty($getallpeg)){
			foreach($getallpeg as $rpegawai){
				$golongan 	= $rpegawai->golongan;
				$nip 		= $rpegawai->nip;
				$nama		= $rpegawai->nama;
				$fungsional	= $rpegawai->pangkat;
				$email		= $rpegawai->email;
				$nik		= $rpegawai->nik;
				$npwp		= $rpegawai->npwp;
				$no_hp		= $rpegawai->nohape;
				$pejabat	= $rpegawai->pejabat;
				$fakultas	= $rpegawai->fakultas;
				$kode		= $rpegawai->kode;
				if ($kode == '-' OR $kode  == '-' OR $kode == '--' OR $kode == '----' OR $kode == '-----' OR $kode == '-------'){

				} else {
					$getnama	= Simpegpegawai::where('nip_baru', $nip)->first();
					if (isset($getnama->nama)){
						$nama 	= $getnama->nama;
					}
					/*
					if (is_null($rpegawai->email) OR $rpegawai->email == ''){
						$getnama	= Simpegpegawai::where('nip_baru', $nip)->first();
						if (isset($getnama->nama)){
							$nama 		= $getnama->nama;
							$fungsional	= $getnama->jab_fungsional;
							$golongan	= $getnama->golongan;
							$email		= $getnama->email_ub;
							$nik		= $getnama->nik;
							$npwp		= $getnama->npwp;
							$no_hp		= $getnama->no_hp;
							Pejabatsurat::where('id', $rpegawai->id)->update([
								'email'		=> $email,
								'nik'		=> $nik,
								'npwp'		=> $npwp,
								'nohape'	=> $no_hp,
							]);
						}
					}
					if ($fakultas == 'KP'){
						User::where('previlage', $pejabat)->update([
							'fakultas' => $fakultas,
							'fakpanjang' => ''
							]);
					} else {
						$getfakpanjang = User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
						if (isset($getfakpanjang->id)){
							User::where('previlage', $pejabat)->update([
								'fakultas' 		=> $fakultas,
								'fakpanjang' 	=> $getfakpanjang->fakpanjang
							]);
						}
					}
					Tujuandisposisi::where('tabel', 'Pejabat')->where('idtujuan', $rpegawai->id)->update([
						'kodeunit' => $rpegawai->kode
					]);
					*/
					$arrgaji[] 	= array(
						'idne' 			=> $rpegawai->id,
						'pejabat' 		=> $pejabat,
						'kode' 			=> $rpegawai->kode,
						'namalengkap' 	=> $rpegawai->nama,
						'jenis' 		=> $rpegawai->jenis,
						'nip'			=> $rpegawai->nip,
						'nama' 			=> $nama,
						'golongan' 		=> $golongan,
						'fungsional' 	=> $fungsional,
						'email' 		=> $email,
						'nik' 			=> $nik,
						'no_hp' 		=> $no_hp,
						'npwp' 			=> $npwp,
						'pangkat'		=> $rpegawai->pangkat,
						'penandatangan'	=> $rpegawai->penandatangan,
						'nomersk'		=> $rpegawai->nomersk,
						'tglsk'			=> $rpegawai->tglsk,
						'view'			=> $rpegawai->view,
						'periode'		=> $rpegawai->periode,
						'awalberlaku'	=> $rpegawai->awalberlaku,
						'akhirberlaku'	=> $rpegawai->akhirberlaku,
						'tglpelantikan'	=> $rpegawai->tglpelantikan,
						'nomorfile'		=> $rpegawai->nomorfile,
						'keterangan'	=> $rpegawai->keterangan,
						'fakreal'		=> $rpegawai->fakreal,
						'statmenjabat'	=> $rpegawai->statmenjabat
					);
				}
			}
		}
		/*
			$getuser = User::where('previlage', 'LIKE', '2022-02-17%')->where('fakultas', 'FAPET')->get();
			if (!empty($getuser)){
				foreach ($getuser as $rows){
					$iduser 	= $rows->id;
					$username 	= $rows->username;
					$cekprevilage = DB::table('db_swakelola.users')->where('username', $username)->first();
					if (isset($cekprevilage->previlage)){
						User::where('id', $rows->id)->update([
							'previlage' => $cekprevilage->previlage
						]);
					}
				}
			}
		*/
		echo json_encode($arrgaji);
	}
	public function jsonPejabat2() {
		$arrgaji	= [];
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '<=', Carbon::now()->subDays(180)->toDateTimeString())->orderBy('fakreal', 'ASC')->orderBy('kode', 'ASC')->get();
		} else {
			$getallpeg	= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '<=', Carbon::now()->subDays(180)->toDateTimeString())->where('fakreal', 'LIKE', '%'.Session('fakultas').'%')->get();
		}
		if (!empty($getallpeg)){
			foreach($getallpeg as $rpegawai){
				$golongan 		= $rpegawai->golongan;
				$nip 			= $rpegawai->nip;
				$nama 			= $rpegawai->nama;
				$start 			= $rpegawai->akhirberlaku;
				$ceksek 		= explode("; ", $start);
				$start 			= $ceksek[0];
				$start			= str_replace(";", "", $start);
				$datework 		= new Carbon($start);
				$now 			= Carbon::now();
				$diff       	= $now->diff($datework);
				$tahun      	= $diff->y;
				$bulan      	= $diff->m;
				if ($tahun ==0) {
					$diff   = $bulan." Bulan";
				} else {
					$diff   = $tahun." Tahun, ". $bulan. " Bulan";
				}
				$arrgaji[] 	= array(
					'idne' 			=> $rpegawai->id,
					'pejabat' 		=> $rpegawai->pejabat,
					'kode' 			=> $rpegawai->kode,
					'namalengkap' 	=> $rpegawai->nama,
					'jenis' 		=> $rpegawai->jenis,
					'nip'			=> $rpegawai->nip,
					'nama' 			=> '',
					'golongan' 		=> $golongan,
					'fungsional' 	=> '',
					'pangkat'		=> $rpegawai->pangkat,
					'penandatangan'	=> $rpegawai->penandatangan,
					'nomersk'		=> $rpegawai->nomersk,
					'tglsk'			=> $rpegawai->tglsk,
					'view'			=> $rpegawai->view,
					'periode'		=> $rpegawai->periode,
					'awalberlaku'	=> $diff,
					'akhirberlaku'	=> $rpegawai->akhirberlaku,
					'tglpelantikan'	=> $rpegawai->tglpelantikan,
					'nomorfile'		=> $rpegawai->nomorfile,
					'keterangan'	=> $rpegawai->keterangan,
					'fakreal'		=> $rpegawai->fakreal,
				);
			}
		}
		echo json_encode($arrgaji);
	}
	public function jsonPejabat3() {
		$arrgaji	= [];
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '>', Carbon::now()->toDateTimeString())->orderBy('fakreal', 'ASC')->orderBy('kode', 'ASC')->get();
		} else {
			$getallpeg	= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '>', Carbon::now()->toDateTimeString())->where('fakreal', 'LIKE', '%'.Session('fakultas').'%')->get();
		}
		if (!empty($getallpeg)){
			foreach($getallpeg as $rpegawai){
				$golongan 		= $rpegawai->golongan;
				$nip 			= $rpegawai->nip;
				$nama 			= $rpegawai->nama;
				$start 			= $rpegawai->akhirberlaku;
				$ceksek 		= explode("; ", $start);
				$start 			= $ceksek[0];
				$datework 		= new Carbon($start);
				$now 			= Carbon::now();
				$diff       	= $now->diff($datework);
				$tahun      	= $diff->y;
				$bulan      	= $diff->m;
				if ($tahun == 0) {
					$diff   = $bulan." Bulan";
					$arrgaji[] 	= array(
						'idne' 			=> $rpegawai->id,
						'pejabat' 		=> $rpegawai->pejabat,
						'kode' 			=> $rpegawai->kode,
						'namalengkap' 	=> $rpegawai->nama,
						'jenis' 		=> $rpegawai->jenis,
						'nip'			=> $rpegawai->nip,
						'nama' 			=> '',
						'golongan' 		=> $golongan,
						'fungsional' 	=> '',
						'pangkat'		=> $rpegawai->pangkat,
						'penandatangan'	=> $rpegawai->penandatangan,
						'nomersk'		=> $rpegawai->nomersk,
						'tglsk'			=> $rpegawai->tglsk,
						'view'			=> $rpegawai->view,
						'periode'		=> $rpegawai->periode,
						'awalberlaku'	=> $diff,
						'akhirberlaku'	=> $start,
						'tglpelantikan'	=> $rpegawai->tglpelantikan,
						'nomorfile'		=> $rpegawai->nomorfile,
						'keterangan'	=> $rpegawai->keterangan,
						'fakreal'		=> $rpegawai->fakreal,
					);
				}
			}
		}
		echo json_encode($arrgaji);
	}
	public function jsonPejabat4() {
		$arrgaji	= [];
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Pejabatsurat::whereIn('akhirberlaku', ['Definitif', null, 'tidak ada masa habis'])->orderBy('fakreal', 'ASC')->orderBy('kode', 'ASC')->get();
		} else {
			$getallpeg	= Pejabatsurat::whereIn('akhirberlaku', ['Definitif', null, 'tidak ada masa habis'])->where('fakreal', 'LIKE', '%'.Session('fakultas').'%')->get();
		}
		if (!empty($getallpeg)){
			foreach($getallpeg as $rpegawai){
				$golongan 		= $rpegawai->golongan;
				$nip 			= $rpegawai->nip;
				$nama 			= $rpegawai->nama;
				$start 			= $rpegawai->created_at;
				$akhirberlaku	= Carbon::parse($start)->age;;
				$arrgaji[] 	= array(
					'idne' 			=> $rpegawai->id,
					'pejabat' 		=> $rpegawai->pejabat,
					'kode' 			=> $rpegawai->kode,
					'namalengkap' 	=> $rpegawai->nama,
					'jenis' 		=> $rpegawai->jenis,
					'nip'			=> $rpegawai->nip,
					'nama' 			=> '',
					'golongan' 		=> $golongan,
					'fungsional' 	=> '',
					'pangkat'		=> $rpegawai->pangkat,
					'penandatangan'	=> $rpegawai->penandatangan,
					'nomersk'		=> $rpegawai->nomersk,
					'tglsk'			=> $rpegawai->tglsk,
					'view'			=> $rpegawai->view,
					'periode'		=> $rpegawai->periode,
					'awalberlaku'	=> $rpegawai->awalberlaku,
					'akhirberlaku'	=> $akhirberlaku,
					'tglpelantikan'	=> $rpegawai->tglpelantikan,
					'nomorfile'		=> $rpegawai->nomorfile,
					'keterangan'	=> $rpegawai->keterangan,
					'fakreal'		=> $rpegawai->fakreal,
				);
			}
		}
		echo json_encode($arrgaji);
	}
	public function jsonPejabat5() {
		$arrgaji	= [];
		if (Session('fakultas') == 'KP'){
			$getallpeg	= Pejabatsurat::whereIn('statmenjabat', ['PLT', 'PLW'])->orderBy('fakreal', 'ASC')->orderBy('kode', 'ASC')->get();
		} else {
			$getallpeg	= Pejabatsurat::whereIn('statmenjabat', ['PLT', 'PLW'])->where('fakreal', Session('fakultas'))->get();
		}
		if (!empty($getallpeg)){
			foreach($getallpeg as $rpegawai){
				$golongan 		= $rpegawai->golongan;
				$nip 			= $rpegawai->nip;
				$nama 			= $rpegawai->nama;
				$start 			= $rpegawai->created_at;
				$akhirberlaku	= Carbon::parse($start)->age;;
				$arrgaji[] 	= array(
					'idne' 			=> $rpegawai->id,
					'pejabat' 		=> $rpegawai->pejabat,
					'kode' 			=> $rpegawai->kode,
					'namalengkap' 	=> $rpegawai->nama,
					'jenis' 		=> $rpegawai->jenis,
					'nip'			=> $rpegawai->nip,
					'nama' 			=> '',
					'golongan' 		=> $golongan,
					'fungsional' 	=> '',
					'pangkat'		=> $rpegawai->pangkat,
					'penandatangan'	=> $rpegawai->penandatangan,
					'nomersk'		=> $rpegawai->nomersk,
					'tglsk'			=> $rpegawai->tglsk,
					'view'			=> $rpegawai->view,
					'periode'		=> $rpegawai->periode,
					'awalberlaku'	=> $rpegawai->awalberlaku,
					'akhirberlaku'	=> $akhirberlaku,
					'tglpelantikan'	=> $rpegawai->tglpelantikan,
					'nomorfile'		=> $rpegawai->nomorfile,
					'keterangan'	=> $rpegawai->statmenjabat,
					'fakreal'		=> $rpegawai->fakreal,
				);
			}
		}
		echo json_encode($arrgaji);
	}
    public function getValpeg(Request $request) {
		$idpeg    	= $request->input('val01');
		if ($idpeg != ''){
			$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			$ceksek			= Detailpegawai::where('no', $idpeg)->count();
			if ($ceksek == 0){
				Detailpegawai::create([
					'no'			=> $idpeg, 
					'ktp'			=> '', 
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
					'tinggibdn'		=> '', 
					'beratbdn'		=> '', 
					'bentukrambut'	=> '', 
					'bentukmuka'	=> '', 
					'warnakulit'	=> '', 
					'cirikusus'		=> '', 
					'cacattubuh'	=> '', 
					'hobi'			=> '', 
					'timestamp'		=> date('Y-m-d H:i')
				]);
			}
			$getpegawai		= DB::table('kp_pegawai')
								->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
								->where('kp_pegawai.id', $idpeg)
								->first();
		
			$nama			= $getpegawai->nama_lengkap;
			$jenisnip		= $getpegawai->jenisnip;
			$nip_baru		= $getpegawai->nip_baru;
			$golongan		= $getpegawai->golongan;
			$statjabatan	= $getpegawai->status_jabatan;
			$pns			= $getpegawai->pns;
			$ppabp			= $getpegawai->ppabp;
			$unitkerja		= $getpegawai->unit_kerja;
			$jabatan		= $getpegawai->jabatan;
			$tgllhari		= $getpegawai->tgl_lahir;
			$tmptlahir		= $getpegawai->tmpt_lahir;
			if ($golongan == '14' OR $golongan == '24' OR $golongan == '34'){
				if ($golongan == '14'){ $golbaru = '21'; }
				else if ($golongan == '24'){ $golbaru = '31'; }
				else { $golbaru = '41'; }
			} else {
				$gollama		= (int)$golongan;
				$golbaru		= $gollama + 1;
			}			
			if ($tgllhari != '0000-00-00' AND !is_null($tgllhari)){
				$arrdate	= explode('-', $tgllhari);
				$yy 		= $arrdate[0];
				$mm 		= (int)$arrdate[1];
				$dd 		= $arrdate[2];
				$mm 		= $arrbulan[$mm];
				$ttl		= $tmptlahir.', '.$dd.' '.$mm.' '.$yy;
			} else {
				$ttl 		= '';
			}
			$getdata 		= TblGajiPNS::where('kode', $golbaru)->orderBy('masakerja', 'ASC')->count();
			if($getdata != 0){
				$getdata 	= TblGajiPNS::where('kode', $golbaru)->orderBy('masakerja', 'ASC')->first();
				$masakerja		= $getdata->masakerja;
				$gapok 			= $getdata->nominal;
				$gapok			= number_format( $gapok, 0 , '.' , ',' );
			} else {
				$masakerja		= '';
				$gapok 			= '';
			}
			$nomorsk 			= 1;
			$nomorsklast 		= Tabelskdanperaturan::where('tahun', date('Y'))->where('fakultas', Session('fakultas'))->orderBy('nomor', 'DESC')->first();
			if (isset($nomorsklast->id)){
				$nomorsk		= $nomorsklast->nomor;
				$nomorsk++;
			}
			return response()->json([ 
				'statpencarian'	=> 'sukses', 
				'nomorsk'		=> $nomorsk, 
				'nama'			=> $nama, 
				'jenisnip'		=> $jenisnip, 
				'nip'			=> $nip_baru, 
				'golongan'		=> $golongan, 
				'statjabatan'	=> $statjabatan, 
				'pns'			=> $pns,
				'ppabp'			=> $ppabp,
				'unitkerja'		=> $unitkerja,
				'jabatan'		=> $jabatan,
				'golbaru'		=> $golbaru,
				'ttl'			=> $ttl,
				'masakerja'		=> $masakerja,
				'gapok'			=> $gapok,
				'getpegawai'	=> $getpegawai,
			]);
		} else {
			$nama			= '';
			$jenisnip		= '';
			$nip_baru		= '';
			$golongan		= '';
			$statjabatan	= '';
			$pns			= '';
			$ppabp			= '';
			$unitkerja		= '';
			$jabatan		= '';
			$golbaru		= '';
			$tgllhari		= '';
			$tmptlahir		= '';
			$ttl 			= '';
			$masakerja		= '';
			$gapok 			= '';
			return response()->json([ 
				'statpencarian'	=> 'gagal', 
				'nama'			=> $nama, 
				'jenisnip'		=> $jenisnip, 
				'nip'			=> $nip_baru, 
				'golongan'		=> $golongan, 
				'statjabatan'	=> $statjabatan, 
				'pns'			=> $pns,
				'ppabp'			=> $ppabp,
				'unitkerja'		=> $unitkerja,
				'jabatan'		=> $jabatan,
				'golbaru'		=> $golbaru,
				'ttl'			=> $ttl,
				'masakerja'		=> $masakerja,
				'gapok'			=> $gapok,
			]);
		}
		
		return back();
	}
	public function exBlankocv(Request $request) {
		//$idpeg    	= $request->input('val01');
		$data	= [];
		return view('cetak.blankocv', $data);
	}
	public function exBiodatapeg(Request $request) {
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
		$status_jbtn	= $request->input('val19');
		$hape    		= $request->input('val20');
		$emailub    	= $request->input('val21');
		$keterangan    	= $request->input('val22');
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
		$jabfungsional  = $request->input('val42');
		$golongan    	= $request->input('val43');
		$tmtgolongan    = $request->input('val44');
		$tmtjabatan    	= $request->input('val45');
		$fungsional    	= $request->input('val46');
		$tmtfungsional  = $request->input('val47');
		$kode    		= $request->input('val48');
		$tinggibdn    	= $request->input('val49');
		$beratbdn    	= $request->input('val50');
		$warnakulit    	= $request->input('val51');
		$rambut    		= $request->input('val52');
		$muka    		= $request->input('val53');
		$cirikusus    	= $request->input('val54');
		$cacattubuh    	= $request->input('val55');
		$hobi    		= $request->input('val56');
		$nokk    		= $request->input('val57');
		$bidangilmu2   	= $request->input('val58');
		$bidangilmu3   	= $request->input('val59');
		$idne    		= $request->input('val60');
		$kelas    		= $request->input('val61');
		$gaji    		= $request->input('val62');
		$tmtgaji    	= $request->input('val63');
		$ppabp    		= $request->input('val64');
		if ($golongan !=  ''){
			$pangkat 	= $golongan;
			$getpangkat	= Golongan::where('kode', $golongan)->first();
			if (isset($getpangkat->golongan)){
				$pangkat	= $getpangkat->pangkat;
			}
			$getpangkat	= Golongan::where('golongan', $golongan)->first();
			if (isset($getpangkat->kode)){
				$golongan 	= $getpangkat->kode;
				$pangkat	= $getpangkat->pangkat;
			}
		} else { $pangkat = ''; }
		if (is_null($glrdepan2) OR $glrdepan2 == ''){
			if (is_null($glrblakang2) OR $glrblakang2 == ''){
				$namal	= $nama;
			} else {
				$namal	= $nama.', '.$glrblakang2;
			}
		} else {
			if (is_null($glrblakang2) OR $glrblakang2 == ''){
				$namal	= $glrdepan2.' '.$nama;
			} else {
				$namal	= $glrdepan2.' '.$nama.', '.$glrblakang2;
			}
		}
		if ($status == '' OR $status == null){ $status = 'Aktif'; }
		if ($idne == 'UDIN'){
			$masterno	= $request->input('val01');
			$update 	= Simpegpegawai::where('id', $masterno)->update([
				'nik'						=> $ktp,
				'nama_lengkap'				=> $namal, 
				'nama'						=> $nama,
				'depan'						=> $glrdepan, 
				'belakang'					=> $glrblakang,
				'jenis_kelamin'				=> $kelamin,
				'tmpt_lahir'				=> $tmplhr,
				'tgl_lahir'					=> $tgllhr,
				'npwp'						=> $npwp,
				'bpjskes'					=> $bpjs,
				'agama'						=> $agama,
				'alamat'					=> $alamatasal,
				'no_hp'						=> $hape,
				'email'						=> $keterangan,
				'email_ub'					=> $emailub,
				'bidang_ilmu3'				=> $bidangilmu3, 
				'tinggibdn'					=> $tinggibdn,
				'beratbdn'					=> $beratbdn,
				'rambut'					=> $rambut,
				'muka'						=> $muka,
				'warnakulit'				=> $warnakulit,
				'cirikusus'					=> $cirikusus,
				'cacattubuh'				=> $cacattubuh,
				'hobi'						=> $hobi,
				'updated_at'				=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$emaillain		= $request->input('val22');
				$cekdatalama 	= Detailpegawai::where('no', $masterno)->count();
				if ($cekdatalama == 0){
					Detailpegawai::create([
						'no'				=> $masterno, 
						'ktp'				=> $ktp, 
						'gelardepan'		=> $glrdepan, 
						'gelarblakang'		=> $glrblakang, 
						'gelardepan2'		=> $glrdepan2, 
						'gelarblakang2'		=> $glrblakang2, 
						'bidangilmu'		=> $bidangilmu, 
						'alamatmlg'			=> $alamatmlg, 
						'kelurahan'			=> $kelurahan, 
						'kecamatan'			=> $kecamatan, 
						'propinsi'			=> $propinsi, 
						'kota'				=> $kota, 
						'kawin'				=> $kawin, 
						'emailub'			=> $emailub, 
						'emaillain'			=> $emaillain, 
						'npwp'				=> $npwp, 
						'bpjs'				=> $bpjs, 
						'tinggibdn'			=> $tinggibdn, 
						'beratbdn'			=> $beratbdn, 
						'bentukrambut'		=> $rambut, 
						'bentukmuka'		=> $muka, 
						'warnakulit'		=> $warnakulit, 
						'cirikusus'			=> $cirikusus, 
						'cacattubuh'		=> $cacattubuh, 
						'hobi'				=> $hobi, 
						'nomoridi'			=> $request->input('val60'), 
						'keanggotaanprofesi'=> $request->input('val61'), 
						'nomorstr'			=> $request->input('val62'), 
						'nomorsip1'			=> $request->input('val63'), 
						'nomorsip2'			=> $request->input('val64'), 
						'nomorsip3'			=> $request->input('val65'), 
						'google'			=> $request->input('val66'), 
						'shinta'			=> $request->input('val67'), 
						'scopus'			=> $request->input('val68'), 
						'orcid'				=> $request->input('val69'), 
						'timestamp'			=> date('Y-m-d H:i')
					]);
				} else {
					Detailpegawai::where('no', $masterno)->update([
						'ktp'				=> $ktp, 
						'gelardepan'		=> $glrdepan, 
						'gelarblakang'		=> $glrblakang, 
						'gelardepan2'		=> $glrdepan2, 
						'gelarblakang2'		=> $glrblakang2, 
						'bidangilmu'		=> $bidangilmu, 
						'alamatmlg'			=> $alamatmlg, 
						'kelurahan'			=> $kelurahan, 
						'kecamatan'			=> $kecamatan, 
						'propinsi'			=> $propinsi, 
						'kota'				=> $kota, 
						'kawin'				=> $kawin, 
						'emailub'			=> $emailub, 
						'emaillain'			=> $emaillain, 
						'skcpns'			=> $cpns, 
						'tmtcpns'			=> $tmtcpns, 
						'npwp'				=> $npwp, 
						'bpjs'				=> $bpjs, 
						'tinggibdn'			=> $tinggibdn, 
						'beratbdn'			=> $beratbdn, 
						'bentukrambut'		=> $rambut, 
						'bentukmuka'		=> $muka,  
						'warnakulit'		=> $warnakulit, 
						'cirikusus'			=> $cirikusus, 
						'cacattubuh'		=> $cacattubuh, 
						'hobi'				=> $hobi, 
						'nomoridi'			=> $request->input('val60'), 
						'keanggotaanprofesi'=> $request->input('val61'), 
						'nomorstr'			=> $request->input('val62'), 
						'nomorsip1'			=> $request->input('val63'), 
						'nomorsip2'			=> $request->input('val64'), 
						'nomorsip3'			=> $request->input('val65'), 
						'google'			=> $request->input('val66'), 
						'shinta'			=> $request->input('val67'), 
						'scopus'			=> $request->input('val68'), 
						'orcid'				=> $request->input('val69'), 
						'timestamp'			=> date('Y-m-d H:i')
					]);					
				}
				
				$getfotolama 	= Simpegpegawai::where('nip_baru', $nip)->first();
				if (isset($getfotolama->foto)){
					$fotolama		= $getfotolama->foto;
					$tandatanganlm	= $getfotolama->tandatangan;
				}
				if($request->hasFile('file')) {
					if (File::exists(base_path()) ."/public/images/pegawai/". $fotolama) {
						File::delete(base_path() ."/public/images/pegawai/". $fotolama);
					}
					$file = time().'.'.$request->file->getClientOriginalExtension();
					$request->file->move(public_path('images/pegawai'), $file);
					Simpegpegawai::where('nip_baru', $nip)->update([
						'foto'  =>  $file
					]);
				}
				if($request->hasFile('tandatangan')) {
					if (File::exists(base_path()) ."/public/images/pegawai/". $tandatanganlm) {
						File::delete(base_path() ."/public/images/pegawai/". $tandatanganlm);
					}
					$file = time().'.'.$request->tandatangan->getClientOriginalExtension();
					$request->tandatangan->move(public_path('images/pegawai'), $file);
					Simpegpegawai::where('nip_baru', $nip)->update([
						'tandatangan'  =>  $file
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Pegawai Tersimpan Dengan NIP '.$nip]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else {
			if ($idne == 'new' OR $idne == '' OR is_null($idne)){
				$ceknip = Simpegpegawai::where('nip_baru', $nip)->count();
				if ($nama == '' OR $nip == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'NIP, NAMA dan UNIT KERJA WAJIB DI ISI..!!!']);
					return back();
				} else {
					if ($status_jbtn == 'Dosen'){
						$tlsfungsional = 'Dosen';
					} else if ($status_jbtn == 'Tendik'){
						$tlsfungsional = 'Tenaga Kependidikan';
					} else {
						$tlsfungsional = $status_jbtn;
					}
					if ($ceknip == 0){
						$idne 	= Simpegpegawai::insertGetId([
							'jenispeg'					=> $jenispeg,
							'fungsional'				=> $tlsfungsional,
							'nik'						=> $ktp,
							'nokk'						=> $nokk, 
							'nama_lengkap'				=> $namal, 
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
							'usia'						=> null,
							'pangkat'					=> $pangkat,
							'golongan'					=> $golongan, 
							'namabank'					=> '', 
							'norek'						=> '', 
							'namapdrekening'			=> $nama, 
							'gajisesuaisk'				=> $gaji,
							'gajibarublmmsk'			=> 0, 
							'kategorigaji'				=> '1000', 
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
							'status'					=> '1', //100% atau 80%
							'keterangan'				=> $keterangan, 
							'tmt_golongan'				=> $tmtgolongan,
							'jab_fungsional'			=> $fungsional,
							'tmt_fungsional'			=> $tmtfungsional, 
							//'tmt_pensiun'				=> '', 
							//'thn_pensiun'				=> '', 
							'cpns'						=> $cpns,
							'pns'						=> $pns,
							'tmt_cpns'					=> $tmtcpns,
							'tmt_pns'					=> $tmtpns,
							'thn_masuk'					=> $tahunmsk,
							'unit_kerja'				=> $unitkerja,
							'bidang_ilmu'				=> $bidangilmu,
							'lab'						=> $laborat,
							'program_studi'				=> $homebase,
							//'sertifikasi'				=> '', 
							//'pend_akhir'				=> '', 
							//'ijasah_diakui'			=> '',
							'status_pegawai'			=> $status, 
							//'masa_kerja'				=> '', 
							'status_jabatan'			=> $status_jbtn, 
							'karpeg'					=> $karpeg,
							'agama'						=> $agama,
							'alamat'					=> $alamatasal,
							'no_hp'						=> $hape,
							'kode'						=> $kode, 
							//'foto'					=> '', 
							'tmtgaji'					=> $tmtgaji,
							'tmtpangkat'				=> $tmtjabatan, 
							'ppabp'						=> $ppabp, 
							'jabatan'					=> $jabfungsional, 
							//'proses_pangkat'			=> '', 
							//'angka_kredit'			=> '', 
							'email_ub'					=> $emailub,
							//'lama_tubel'				=> '', 
							//'lama_kenaikan_pangkat'	=> '', 
							//'tmt_tubel'				=> '',
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
					} else {
						$getid 	= Simpegpegawai::where('nip_baru', $nip)->first();
						$idne	= $getid->id;
						$update = Simpegpegawai::where('id', $idne)->update([
							'jenispeg'					=> $jenispeg,
							'fungsional'				=> $tlsfungsional,
							'nik'						=> $ktp,
							'nokk'						=> $nokk, 
							'nama_lengkap'				=> $namal, 
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
							'usia'						=> null,
							'pangkat'					=> $pangkat,
							'golongan'					=> $golongan, 
							'npwp'						=> $npwp, 
							'statusnpwp'				=> $kawin, 
							'keterangan'				=> $keterangan, 
							'tmt_golongan'				=> $tmtgolongan,
							'jab_fungsional'			=> $fungsional,
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
							'status_jabatan'			=> $status_jbtn, 
							'karpeg'					=> $karpeg,
							'agama'						=> $agama,
							'alamat'					=> $alamatasal,
							'no_hp'						=> $hape,
							'kode'						=> $kode, 
							'tmtpangkat'				=> $tmtjabatan, 
							'ppabp'						=> $ppabp, 
							'jabatan'					=> $jabfungsional, 
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
							'tmtgaji'					=> $tmtgaji,
							'gajisesuaisk'				=> $gaji,
							'updated_at'				=> date("Y-m-d H:i:s")
						]);
					}
				}
			} else {
				$ceknip = Simpegpegawai::where('nip_baru', $nip)->where('id', '!=', $idne)->count();
				if ($ceknip != 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'NIP Terdeteksi Double, Periksa Isian NIP/NIK Anda']);
					return back();
				} else if ($nama == '' OR $nip == '' OR $unitkerja == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'NIP, NAMA dan UNIT KERJA WAJIB DI ISI..!!!']);
					return back();
				} else {
					if ($status_jbtn == 'Dosen'){
						$tlsfungsional = 'Dosen';
					} else if ($status_jbtn == 'Tendik'){
						$tlsfungsional = 'KEPENDIDIKAN TETAP';
					} else {
						$tlsfungsional = $status_jbtn;
					}
					
					$namal		= $glrdepan2.' '.$nama.', '.$glrblakang2;
					$update		= Simpegpegawai::where('id', $idne)->update([
						'jenispeg'					=> $jenispeg,
						'fungsional'				=> $tlsfungsional,
						'nik'						=> $ktp,
						'nokk'						=> $nokk, 
						'nama_lengkap'				=> $namal, 
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
						'npwp'						=> $npwp, 
						'statusnpwp'				=> $kawin, 
						'keterangan'				=> $keterangan, 
						'tmt_golongan'				=> $tmtgolongan,
						'jab_fungsional'			=> $fungsional,
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
						'status_jabatan'			=> $status_jbtn, 
						'karpeg'					=> $karpeg,
						'agama'						=> $agama,
						'alamat'					=> $alamatasal,
						'no_hp'						=> $hape,
						'kode'						=> $kode,
						'tmtpangkat'				=> $tmtjabatan, 
						'ppabp'						=> $ppabp, 
						'jabatan'					=> $jabfungsional, 
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
						'tmtgaji'					=> $tmtgaji,
						'gajisesuaisk'				=> $gaji,
						'updated_at'				=> 	date("Y-m-d H:i:s")
					]);
				}
			}
			if($idne != 0){
				$cekpejabat = Pejabatsurat::where('nip', $nip)->count();
				if ($cekpejabat != 0){
					Pejabatsurat::where('nip', $nip)->update([
						'nama'		=> $namal,
						'golongan'	=> $golongan,
						'pangkat'	=> $pangkat,
						'email'		=> $emailub,
						'nik'		=> $ktp,
						'npwp'		=> $npwp,
						'nohape'	=> $hape
					]);
					$getprevilage 	= Pejabatsurat::where('nip', $nip)->first();
					$pejabat 		= $getprevilage->pejabat;
					User::where('previlage', $pejabat)->update([
						'nama'		=> $namal,
						'email'		=> $emailub,
						'nip'		=> $idne,
						'golongan'	=> $golongan
					]);
				}
				if($request->hasFile('val01')) {
					$getfotolama 	= Simpegpegawai::where('id', $masterno)->first();
					if (isset($getfotolama->foto)){
						$fotolama		= $getfotolama->foto;
						if (File::exists(base_path()) ."/public/images/pegawai/". $fotolama) {
						  File::delete(base_path() ."/public/images/pegawai/". $fotolama);
						}
					}
					$ImageExt	= $request->file('val01')->getClientOriginalExtension();
					$file_tmp	= $request->file('val01');
					$file 		= time().'.'.$request->file('val01')->getClientOriginalExtension();
					$request->file->move(public_path('images/pegawai'), $file);
					$update 	= Simpegpegawai::where('id', $idne)->update([
						'foto'	=> $file, 
					]);
					User::where('id', Session('id'))->update([
						'photo'  =>  $file
					]);
					Aktifitas::create([
						'unique_id'		=> Session('id'), 
						'kelompok'		=> Session('email'), 
						'keterangan'	=> 'images/pegawai/'.$file,
						'verifikator'	=> ''
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Pegawai Tersimpan Dengan ID '.$idne]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		}
	}
	public function deletePegawai(Request $request) {
		$idpeg    	= $request->input('val01');
		$update		= Simpegpegawai::where('id', $idpeg)->update([
			'status' => '0'
		]);
		if($update){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Pegawai Telah di Set Menjadi Pegawai Non Aktif']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
			return back();
		}
	}
	public function jgetAllpegawai(Request $request) {
		$ppabp    	= $request->input('val01');
		$status    	= $request->input('val02');
		if ($ppabp == 'REKRUTMEN PT DISA PRIMA MEDIKA'){ 
		if ($status == '0'){
				$arraysurat = Simpegpegawai::where('ppabp', 'Rekrutmen PT DPM')->whereNotIn('status_pegawai', ['Diterima', 'Terverifikasi', 'Lolos Tahap Wawancara'])->get();
			} else {
				$arraysurat = Simpegpegawai::where('ppabp', 'Rekrutmen PT DPM')->whereIn('status_pegawai', ['Diterima', 'Terverifikasi', 'Lolos Tahap Wawancara'])->get();
			}
		    
		} else {
			if ($ppabp == 'ALLPPABP'){
				if ($status == '1'){
					$arraysurat = Simpegpegawai::where('ppabp', '!=', 'Rekrutmen PT DPM')->whereIn('status_pegawai', ['1', 'Aktif'])->get();
				} else {
					$arraysurat = Simpegpegawai::where('ppabp', '!=', 'Rekrutmen PT DPM')->whereNotIn('status_pegawai', ['1', 'Aktif'])->get();
				}
			} else {
				if ($status == '1'){
					$arraysurat = Simpegpegawai::where('ppabp', $ppabp)->whereIn('status_pegawai', ['1', 'Aktif'])->get();
				} else {
					$arraysurat = Simpegpegawai::where('ppabp', $ppabp)->whereNotIn('status_pegawai', ['1', 'Aktif'])->get();
				}
			}
		}
		echo json_encode($arraysurat);
    }
	public function tblSettingdokar(Request $request) {
		$arraysurat	= [];
		$jenis    	= $request->input('jenis');
		if ($jenis == 'gajipns'){
			$sql = TblGajiPNS::orderBy('kode', 'ASC')->orderBy('masakerja', 'ASC')->get();
			foreach ($sql as $rval) {
				$golongan 		= $rval->kode;
				$getpangkat		= Golongan::where('kode', $golongan)->count();
				if ($getpangkat != 0){
					$getpangkat	= Golongan::where('kode', $golongan)->first();
					$gol 		= $getpangkat->golongan;
					$pangkat	= $getpangkat->pangkat;
					$tulis		= $pangkat.', '.$gol;
				} else { $tulis = $golongan; }
				$arraysurat[] 	= array(
					'idne' 		=> $rval->id,
					'penulisan' => $tulis,
					'kode' 		=> $rval->kode,
					'masakerja' => $rval->masakerja,
					'nominal' 	=> $rval->nominal,
				);
			}
		} else if ($jenis == 'gajinonpns'){
			$sql = TblGajiPNS::orderBy('kode', 'ASC')->orderBy('masakerja', 'ASC')->get();
			foreach ($sql as $rval) {
				$golongan 		= $rval->kode;
				$getpangkat		= Golongan::where('kode', $golongan)->count();
				if ($getpangkat != 0){
					$getpangkat	= Golongan::where('kode', $golongan)->first();
					$gol 		= $getpangkat->golongan;
					$pangkat	= $getpangkat->pangkat;
					$tulis		= $pangkat.', '.$gol;
				} else { $tulis = $golongan; }
				$arraysurat[] 	= array(
					'idne' 		=> $rval->id,
					'penulisan' => $tulis,
					'kode' 		=> $rval->kode,
					'masakerja' => $rval->masakerja,
					'nominal' 	=> $rval->nominal,
				);
			}
		} else if ($jenis == 'email'){
			$getmaster = Tblemailkepegkeu::where('id', '1')->first();
			if (isset($getmaster->id)){
				$arraysurat[] 	= array(
					'idne' 		=> '1',
					'kelompok'	=> 'PENGIRIM', 
					'pjkepeg'	=> $getmaster->pjkepeg, 
					'pjkeu'		=> '', 
					'emailkepeg'=> $getmaster->emailkepeg,
					'emailkeu'	=> '', 
				);
			}
			$sql = Tblemailkepegkeu::where('id', '!=',  '1')->orderBy('kelompok', 'ASC')->get();
			foreach ($sql as $rval) {
				$idne 		= $rval->id;
				$pjkepeg 	= $rval->pjkepeg;
				$pjkeu		= $rval->pjkeu;
				$emailkepeg	= $rval->emailkepeg;
				$emailkeu	= $rval->emailkeu;
				$arraysurat[] 	= array(
					'idne' 		=> $idne,
					'kelompok'	=> $rval->kelompok, 
					'kelompoksk'=> $rval->kelompoksk, 
					'namakepeg'	=> $pjkepeg, 
					'namakeu'	=> $pjkeu, 
					'emailkepeg'=> $emailkepeg,
					'emailkeu'	=> $emailkeu, 
				);
			}
		} else {
			$val02 				= $jenis;
			$ukuranfont			= '12';
			$ukuranfontplus1	= '18px';
			$ukuranfontplus2	= '12px';
			$jenisfontte		= '<font size="7" color="blue">';
			$cekada 			= Templateskpp::where('namask', $jenis)->where('fakultas', Session('fakultas'))->count();
			if ($cekada == 0){
				$master01 		= 'PKWT Dokter Umum (PART TIME)'; //bentuk SK
				$master02 		= 'Undangan'; //bentuk Surat Pernyataan
				$sql 			= Templateskpp::where('namask', $master01)->where('fakultas', Session('fakultas'))->orderBy('urutan','ASC')->get();
				foreach ($sql as $rtempl){
					$inout = Templateskpp::create([
						'urutan' 	=> $rtempl->urutan, 
						'menimbang' => $rtempl->menimbang, 
						'mengingat' => $rtempl->mengingat, 
						'menetapkan'=> $rtempl->menetapkan, 
						'memutuskan'=> $rtempl->memutuskan, 
						'tembusan' 	=> $rtempl->tembusan, 
						'fakultas' 	=> Session('fakultas'), 
						'posisi' 	=> $rtempl->posisi, 
						'leter' 	=> $rtempl->leter, 
						'namask' 	=> $jenis, 
						'inputor' 	=> Session('email'), 
						'judul' 	=> $rtempl->judul
					]);
				}
			}
			
			$sql = Templateskpp::where('namask', $jenis)->where('fakultas', Session('fakultas'))->orderBy('urutan', 'ASC')->get();
			if (!empty($sql)){
				foreach ($sql as $rval){
					$menimbang 	= $rval->menimbang;
					$mengingat 	= $rval->mengingat;
					$menetapkan = $rval->menetapkan;
					$posisi		= $rval->posisi;
					$merge 		= 7 - $posisi;
					$arraysurat[] 	= array(
						'id' 			=> $rval->id,
						'urutan' 		=> $rval->urutan,
						'memutuskan' 	=> $merge,
						'menimbang' 	=> $menimbang,
						'mengingat' 	=> $mengingat,
						'menetapkan' 	=> $menetapkan,
						'namask' 		=> $rval->namask,
						'judul' 		=> $rval->judul,
						'posisi' 		=> $rval->posisi,
						'leter' 		=> $rval->leter,
					);
				}
			} else {
				$sql = Kelasremun::orderBy('kelas', 'DESC')->orderBy('bidang', 'ASC')->get();
				foreach ($sql as $rval) {
					$arraysurat[] 	= array(
						'idne' 		=> $rval->id,
						'bidang' 	=> $rval->bidang,
						'jabatan' 	=> $rval->jabatan,
						'kelas' 	=> $rval->kelas,
						'point' 	=> $rval->point,
						'tgp' 		=> $rval->tgp,
						'insentif' 	=> $rval->insentif,
					);
				}
			}
		}
		echo json_encode($arraysurat);
    }
	public function exSettingkepeg(Request $request) {
		$idne  	= $request->input('set01');
		$val02  = $request->input('set02');
		$val03  = $request->input('set03');
		$val04  = $request->input('set04');
		$tabel 	= $request->input('set05');
		$val06  = $request->input('set06');
		$val07  = $request->input('set07');
		if ($tabel == 'emailunit'){
			if ($val02 == ''){ $val02 = '-'; }
			if ($val03 == ''){ $val03 = '-'; }
			if ($val04 == ''){ $val04 = '-'; }
			if ($val06 == ''){ $val06 = '-'; }
		}
		if ($tabel == 'skdirektur'){
			if ($val02 == ''){ $val02 = '-'; }
			if ($val03 == ''){ $val03 = '-'; }
			if ($val04 == ''){ $val04 = '-'; }
			if ($val06 == ''){ $val06 = '-'; }
			if ($val07 == ''){ $val07 = '-'; }
		}
		if ($idne == '' OR $val02 == '' OR $val03 == '' OR $val04 == '' OR $tabel == '' OR $val06 == '' OR $val07 == ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Lengkapi Semua Form Isian']);
			return back();
		} else {
			if ($tabel == 'Tabel Gaji NON PNS'){
				$nominal= str_replace(',','',$val03);
				$update = TblGaji::where('id', $idne)->update([
					'kode' 		=> $val02,
					'masakerja' => $val04,
					'nominal' 	=> $nominal,
				]);
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $tabel.' Untuk Kode Gol. '.$val02.' Diubah Menjadi Rp. '.$val03.',-']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update '.$tabel.' Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else if ($tabel == 'Tabel Gaji PNS'){
				$nominal= str_replace(',','',$val03);
				$update	= TblGajiPNS::where('id', $idne)->update([
					'kode' 		=> $val02,
					'masakerja' => $val04,
					'nominal' 	=> $nominal,
				]);
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $tabel.' Untuk Kode Gol. '.$val02.' Diubah Menjadi Rp. '.$val03.',-']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update '.$tabel.' Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else if ($tabel == 'emailmaster'){
				if ($idne != '' AND $val02 != ''){
					$arremail 	= explode('@', $idne);
					$email		= $arremail[0];
					$hosting	= '';
					if (isset($arremail[1])){
						$hosting = $arremail[1];
					}
					if ($hosting == 'ub.ac.id'){
						$update		= Tblemailkepegkeu::where('id', '1')->update([
							'emailkepeg'=> $idne,
							'emailkeu'	=> $val02, 
						]);
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ubah Email Pengirim Sukses dilakukan']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Email Master Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Wajib menggunakan Email ub.ac.id']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email dan Password Wajib di Isi']);
					return back();
				}
			} else if ($tabel == 'emailunit'){
				$getidne 	= explode('-pisah-', $idne);
				$idne 		= $getidne[0];
				if (isset($getidne[1])){
					$unitkerja 	= $getidne[1];
				} else { $unitkerja = ''; }
				if ($unitkerja != ''){
					$getlama	= Tblemailkepegkeu::where('id', $idne)->first();
					$unitlama	= $getlama->kelompok;
					$unitsklama	= $getlama->kelompoksk;
					
					$update	= Tblemailkepegkeu::where('id', $idne)->update([
						'kelompok'	=> $unitkerja, 
						'kelompoksk'=> $val07,
						'pjkepeg'	=> $val02, 
						'pjkeu'		=> $val04, 
						'emailkepeg'=> $val03,
						'emailkeu'	=> $val06,
					]);
					
					if ($update){
						if ($val07 != $unitsklama){
							DraftKenaikanpangkat::where('unitkerja', $unitsklama)->update([
								'unitkerja'	=> $val07
							]);
							DraftRemunerasi::where('unit', $unitsklama)->update([
								'unit'	=> $val07
							]);
						}
						if ($unitkerja != $unitlama){
							Dokarkgb::where('unitkerja', $unitlama)->update([
								'unitkerja'	=> $unitkerja
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ubah Email Penerima Sukses dilakukan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Email Penerima Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Email Penerima Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else if ($tabel == 'redaksi'){
				$ceksudah	= Templateskpp::where('namask', $idne)->where('fakultas', Session('fakultas'))->count();
				if ($ceksudah == 0){
					$update	= Templateskpp::create([
						'namask'	=> $idne, 
						'inputor'	=> Session('nama'),
						'menimbang'	=> '', 
						'mengingat'	=> $val02, 
						'menetapkan'=> '',
						'fakultas'	=> Session('fakultas'),
					]);
				} else {
					$update	= Templateskpp::where('namask', $idne)->where('fakultas', Session('fakultas'))->update([
						'inputor'	=> Session('nama'),
						'mengingat'	=> $val02, 
					]);
				}
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ubah '.$idne.'  Sukses dilakukan']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Redaksi Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else if ($tabel == 'skdirektur'){
				$idne  	= $request->input('set01');
				$val02  = $request->input('set02');
				$val03  = $request->input('set03');
				$val04  = $request->input('set04');
				$tabel 	= $request->input('set05');
				$val06  = $request->input('set06');
				$val07  = $request->input('set07');
				if ($val07 == '0' OR $val07 == '' OR $val07 == null){
					if ($idne == 'new'){
						$update	= Templateskpp::create([
							'posisi'	=> $val04,
							'leter'		=> $val03,
							'namask'	=> $val02,
							'inputor'	=> Session('email'),
							'judul'		=> $val06, 
							'menimbang'	=> $request->input('set08'), 
							'mengingat'	=> $request->input('set09'), 
							'menetapkan'=> '',
							'memutuskan'=> '',
							'tembusan'=> '',
							'fakultas'	=> Session('fakultas'),
						]);
					} else {
						if ($val06 == ''){
							$update	= Templateskpp::where('id', $idne)->where('fakultas', Session('fakultas'))->delete();
						} else {
							$update	= Templateskpp::where('id', $idne)->where('fakultas', Session('fakultas'))->update([
								'posisi'	=> $val04, 
								'leter'		=> $val03, 
								'namask'	=> $val02, 
								'inputor'	=> Session('email'),
								'judul'		=> $val06,
								'menimbang'	=> $request->input('set08'), 
								'mengingat'	=> $request->input('set09'), 
								'updated_at'=> date('Y-m-d H:i:s')
							]);
						}
					}
				} else {
					if ($idne == 'new'){
						$update	= Templateskpp::create([
							'posisi'	=> $val04, 
							'leter'		=> $val03, 
							'namask'	=> $val02, 
							'inputor'	=> Session('email'),
							'judul'		=> $val06, 
							'menimbang'	=> $request->input('set08'), 
							'mengingat'	=> $request->input('set09'), 
							'menetapkan'=> '',
							'memutuskan'=> '',
							'tembusan'	=> '',
							'urutan'	=> 0,
							'fakultas'	=> Session('fakultas'),
						]);
						$idne = $update->id;
					} else {
						if ($val06 == ''){
							$update	= Templateskpp::where('id', $idne)->delete();
						} else {
							$update	= Templateskpp::where('id', $idne)->update([
								'posisi'	=> $val04, 
								'leter'		=> $val03, 
								'namask'	=> $val02, 
								'inputor'	=> Session('email'),
								'judul'		=> $val06,
								'urutan'	=> 0,
								'menimbang'	=> $request->input('set08'), 
								'mengingat'	=> $request->input('set09'), 
								'updated_at'=> date('Y-m-d H:i:s')
							]);
						}
					}
					$urutan 		= 1;
					$urutankanlagi 	= Templateskpp::where('urutan', '!=', '0')->where('fakultas', Session('fakultas'))->where('namask', $val02)->orderBy('urutan', 'ASC')->get();
					foreach ($urutankanlagi as $rows){
						if ($val07 == $urutan){
							if ($rows->id != $idne){
								Templateskpp::where('id', $idne)->update([
									'urutan'	=> $urutan
								]);
								$urutan++;
								Templateskpp::where('id', $rows->id)->update([
									'urutan'	=> $urutan
								]);
							} else {
								Templateskpp::where('id', $idne)->update([
									'urutan'	=> $urutan
								]);
							}
						} else {
							Templateskpp::where('id', $rows->id)->update([
								'urutan'	=> $urutan
							]);	
						}
						$urutan++;
					}
					$urutankanlagi 	= Templateskpp::where('urutan', '0')->where('fakultas', Session('fakultas'))->where('namask', $val02)->orderBy('urutan', 'ASC')->get();
					if (!empty($urutankanlagi)){
						foreach($urutankanlagi as $rows){
							Templateskpp::where('id', $rows->id)->update([
								'urutan'	=> $urutan
							]);
							$urutan++;
						}
					}
				}
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Update Template '.$val02.'  Sukses dilakukan']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Redaksi Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				$tgp 		= str_replace(',','',$val06);
				$insentif 	= str_replace(',','',$val07);
				$update		= Kelasremun::where('id', $idne)->update([
					'bidang' 	=> $val03,
					'jabatan' 	=> $val04,
					'kelas' 	=> $val02,
					'point' 	=> $tabel,
					'tgp' 		=> $tgp,
					'insentif' 	=> $insentif,
				]);
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Kelas Remunerasi Untuk Jabatan. '.$val04.' Diubah Menjadi TGP : Rp. '.$val06.',- dan Insentif : Rp. '.$val07.',-']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update '.$tabel.' Gagal, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			}
		}
	}
	public function exdraftskGlobal(Request $request) {
    	$validator = Validator::make($request->all(), [
		  'val01' 		=>  'required',
		  'val02' 		=>  'required',
          'val03' 		=> 	'required',
          'val04' 		=> 	'required',
		  'val05' 		=> 	'required',
          'val09' 		=> 	'required',
          'val11' 		=> 	'required',
          'val15' 		=> 	'required',
          'val19' 		=> 	'required',
		  'val20' 		=> 	'required',
		]);
		if($validator->fails()) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Form Anda']);
			return back();
        }else {
			$swandhanafak       = config('global.swandhanafak');
			$swandhanaalamat    = config('global.swandhanaalamat');
			$swandhanakemen     = config('global.swandhanakemen');
			$swandhanauniv      = config('global.swandhanauniv');
			$swandhanatelpon    = config('global.swandhanatelpon');
			$swandhanaemail     = config('global.swandhanaemail');
			$swandhanakota		= config('global.swandhanakota');
			$konseptor			= Session('jabatan');
			$fakultas			= Session('fakultas');
			$mkelompok			= Session('previlage');
			$idne				= $request->input('val01');
			$judul				= $request->input('val02');
			$menimbang			= $request->input('val03');
			$mengingat			= $request->input('val04');
			$menetapkan			= $request->input('val05');
			$memutuskan			= $request->input('val06');			
			$tembusan			= $request->input('val07');			
			$logo				= $request->input('val08');			
			$nomor				= $request->input('val17');			
			$tanggal			= $request->input('val18');			
			$tmt				= $request->input('val19');			
			$penandatangan		= $request->input('val20');			
			$paraf1				= $request->input('val21');
			$paraf2				= $request->input('val22');
			$paraf3				= $request->input('val23');
			$paraf4				= $request->input('val24');
			$jenis				= $request->input('val25');
			if ($jenis == ''){ $jenis = 'DRAFTSK'; }
			if($validator->fails()) {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Lengkapi Data Wajibnya (Bintang Merah)']);
				return back();
			} else {
				$arrtgl 			= explode('-', $tanggal);
				$tahun 				= $arrtgl[0];
				$mm 				= (int)$arrtgl[1];
				$dd 				= $arrtgl[2];
				$getpejabat			= Pejabatsurat::where('pejabat', $penandatangan)->first();
				$pejabat 			= $getpejabat->pejabat;
				$penandatangan 		= $getpejabat->nama;
				$nippenandatangan 	= $getpejabat->nip;
				
				$heder 				= '<table border="0" cellpadding="0" cellspacing="0" style="width:640px">';
				$hederbaru			= '<table width="800" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px; font-family: Bookman Old Style;"><tr><td width="99">&nbsp;</td><td width="28">&nbsp;</td><td width="27">&nbsp;</td><td width="148">&nbsp;</td><td width="27">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
				$menimbang			= str_replace($heder, $hederbaru, $menimbang);
				$mengingat			= str_replace($heder, $hederbaru, $mengingat);
				$memutuskan			= str_replace($heder, $hederbaru, $memutuskan);
				$cektemplate		= Templateskpp::where('namask', $jenis)->where('fakultas', Session('fakultas'))->count();
				if ($cektemplate == 0){
					Templateskpp::create([
						'namask'		=> $jenis, 
						'inputor'		=> Session('nama'), 
						'fakultas'		=> Session('fakultas'), 
						'judul' 		=> $judul, 
						'menetapkan' 	=> $menetapkan, 
						'menimbang' 	=> $menimbang, 
						'memutuskan' 	=> $memutuskan, 
						'tembusan' 		=> $tembusan, 
					]);
				} else {
					$gettemplate	= Templateskpp::where('namask', $jenis)->where('fakultas', Session('fakultas'))->first();
					$idtemplate		= $gettemplate->judul;
					$lmjudul		= $gettemplate->judul;
					$lmmenimbang	= $gettemplate->menimbang;
					$lmmengingat	= $gettemplate->mengingat;
					$lmmenetapkan	= $gettemplate->menetapkan;
					$lmmemutuskan	= $gettemplate->memutuskan;
					$lmtembusan		= $gettemplate->tembusan;
					if (is_null ($lmjudul) OR $lmjudul == ''){
						Templateskpp::where('id', $idtemplate)->update([						
							'inputor'		=> Session('nama'), 
							'judul'			=> $judul, 
						]);
					}
					if (is_null ($lmmenimbang) OR $lmmenimbang == ''){
						Templateskpp::where('id', $idtemplate)->update([						
							'inputor'		=> Session('nama'), 
							'menimbang'		=> $menimbang, 
						]);
					}
					if (is_null ($lmmengingat) OR $lmmengingat == ''){
						Templateskpp::where('id', $idtemplate)->update([						
							'inputor'		=> Session('nama'), 
							'mengingat'		=> $mengingat, 
						]);
					}
					if (is_null ($lmmenetapkan) OR $lmmenetapkan == ''){
						Templateskpp::where('id', $idtemplate)->update([						
							'inputor'		=> Session('nama'), 
							'menetapkan'	=> $menetapkan, 
						]);
					}
					if (is_null ($lmmemutuskan) OR $lmmemutuskan == ''){
						Templateskpp::where('id', $idtemplate)->update([						
							'inputor'		=> Session('nama'), 
							'memutuskan'	=> $memutuskan, 
						]);
					}
					if (is_null ($lmtembusan) OR $lmtembusan == ''){
						Templateskpp::where('id', $idtemplate)->update([						
							'inputor'		=> Session('nama'), 
							'memutuskan'	=> $tembusan, 
						]);
					}
				}
				//if ($jenis == 'REMUNERASI'){ $kodemarking = 'REMUNERASI'; }
				//else if ($jenis == 'PangkatNONPNS'){ $kodemarking = 'PangkatNONPNS'; }
				//else if ($jenis == 'IZIN BELAJAR DOSEN NON PNS' OR $jenis == 'IZIN BELAJAR DOSEN PNS' OR $jenis == 'TUGAS BELAJAR DOSEN NON PNS' OR $jenis == 'PERPANJANGAN TUBEL DOSEN NON PNS' OR $jenis == 'IZIN BELAJAR TENDIK NON PNS' OR $jenis == 'IZIN BELAJAR TENDIK PNS' OR $jenis == 'TUGAS BELAJAR TENDIK NON PNS'){ $kodemarking = 'TUBEL'; }
				//else if ($jenis == 'PEMBERHENTIAN JABATAN AKADEMIK DOSEN NON PNS' OR $jenis == 'PENGANGKATAN KEMBALI DALAM JABATAN AKADEMIK DOSEN NON PNS'){ $kodemarking = 'JABAKAD'; }
				//else if ($jenis == 'BUP Tetap Non PNS' OR $jenis == 'Pengunduran Diri' OR $jenis == 'PDD Tetap Non PNS' OR $jenis  == 'Meninggal Dunia'){ $kodemarking = 'BERHENTI'; }
				//else if ($jenis == 'Pengangkatan PNS'){ $kodemarking = 'PENGPNS'; }
				//else { $kodemarking = $jenis; }
				if ($jenis == 'PERATURAN REKTOR' OR $jenis == 'PERATURAN UNIVERSITAS' OR $jenis == 'PERATURAN SENAT' OR $jenis == 'PERATURAN DEKAN' ){
					if (Session('fakultas') == 'KP'){
						$unitkerja			= 'Kantor Pusat';
					} else {
						$unitkerja			= Session('fakpanjang');
					}
					$pengundang			= $request->input('val09');			
					$statuspeg			= '-';			
					$jenispeg			= '-';			
					$getppengundang		= Pejabatsurat::where('pejabat', $pengundang)->first();
					$idpeg				= $getppengundang->id;
					$pangkat			= $getppengundang->pangkat;
					$jabatan 			= $getppengundang->pejabat;
					$penandatangan 		= $getppengundang->nama;
					$nip 				= $getppengundang->nip;
					if ($idne == 'new'){
						$ceksudah 	= Draftsk::where('jenissk', $jenis)->where('nip', $nip)->where('tmt', $tmt)->count();
						if ($ceksudah == 0){
							$input = Draftsk::create([
								'jenissk' 			=> $jenis,
								'nomor' 			=> $nomor,
								'tahun' 			=> $tahun,
								'tanggalsk' 		=> $tanggal,
								'judulsk' 			=> $judul,
								'menimbang' 		=> $menimbang,
								'mengingat' 		=> $mengingat,
								'menetapkan' 		=> $menetapkan,
								'memutuskan' 		=> $memutuskan,
								'tembusan' 			=> $tembusan,
								'tmt' 				=> $tmt,
								'idpeg' 			=> $idpeg,
								'nama' 				=> $nama,
								'nip' 				=> $nip,
								'golongan' 			=> $pangkat,
								'statuspeg' 		=> $statuspeg,
								'jenispeg' 			=> $jenispeg,
								'unitkerjapeg' 		=> $unitkerja,
								'jabatanpeg' 		=> $jabatan,
								'kelas' 			=> 0,
								'nilai' 			=> 0,
								'tgp' 				=> 0,
								'insentif' 			=> 0,
								'konseptor' 		=> Session('jabatan'),
								'unitkonseptor' 	=> Session('fakultas'),
								'paraf1' 			=> $paraf1,
								'paraf2' 			=> $paraf2,
								'paraf3' 			=> $paraf3,
								'paraf4' 			=> $paraf4,
								'penandatangan' 	=> $pejabat,
								'namapenandatangan' => $penandatangan,
								'nippenandatangan' 	=> $nippenandatangan,
								'arsip' 			=> '0',
								'marking' 			=> '0'
							]);
							$id 		= $input->id;
							$marking 	= 'DRAFTSK-'.$id;
							if ($input){
								if ($request->hasFile('file')) {
									$namafile		= Session('fakultas').'-'.$marking;
									$namafile		= $namafile.'.'.$request->file('file')->getClientOriginalExtension();
									$uploadedFile 	= $request->file('file');
									$request->file('file')->move(public_path('scan/files'), $namafile);
									Draftsk::where('id', $id)->update([
										'lampiran' 	=> $namafile,
										'marking' 	=> $marking
									]);
								} else {
									Draftsk::where('id', $id)->update([
										'marking' 	=> $marking
									]);
								}
								Inboxsurat::insert([
									'marking'  		=>  $marking,
									'pengirim'  	=>  $konseptor,
									'penerima'		=>  $paraf1,
									'status'		=>  'send',
									'sifat'			=>  '1',
									'jenis'			=>  'KELUAR',
									'kerja'			=>  'PARAF',
									'catatan'		=>  'DRAFTSK',
									'tandatangan'	=>  '',
									'tanggal'		=>  '1',
								]);
								$idcaritoken	= 0;
								$cariiduser 	= User::where('previlage', $paraf1)->orderBy('id', 'DESC')->get();
								if (!empty($cariiduser)){
									foreach ( $cariiduser as $rididuser ){
										$idcaritoken	= $rididuser->id;
										$caritoken 		= Firebasebank::where('userid', $idcaritoken)->count();
										if ($caritoken != 0){
											$tuliskirim = 'Draft SK telah dibuat dan siap diperiksa';
											$jtokencari	= Firebasebank::where('userid', $idcaritoken)->get();
											foreach ( $jtokencari as $rtokencari ){
												$firebaseid = $rtokencari->firebase;
												$msg = array (
													'message' 	=> $tuliskirim,
													'title'		=> 'SCO',
													'subtitle'	=> 'Universitas Brawijaya',
													'tickerText'=> 'PARAF',
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
													'Authorization: key=AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt',
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
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sukses di Input..!!']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada yang diupdate, Exiting']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sudah ada']);
							return back();
						}
					} else {
						$ceksudah 	= Draftsk::where('id', '!=', $idne)->where('jenissk', $jenis)->where('nip', $nip)->where('tmt', $tmt)->count();
						if ($ceksudah == 0){
							$input = Draftsk::where('id', $idne)->update([
								'jenissk' 			=> $jenis,
								'nomor' 			=> $nomor,
								'tahun' 			=> $tahun,
								'tanggalsk' 		=> $tanggal,
								'judulsk' 			=> $judul,
								'menimbang' 		=> $menimbang,
								'mengingat' 		=> $mengingat,
								'menetapkan' 		=> $menetapkan,
								'memutuskan' 		=> $memutuskan,
								'tembusan' 			=> $tembusan,
								'tmt' 				=> $tmt,
								'idpeg' 			=> $idpeg,
								'nama' 				=> $nama,
								'nip' 				=> $nip,
								'golongan' 			=> $pangkat,
								'statuspeg' 		=> $statuspeg,
								'jenispeg' 			=> $jenispeg,
								'unitkerjapeg' 		=> $unitkerja,
								'konseptor' 		=> Session('jabatan'),
								'unitkonseptor' 	=> Session('fakultas'),
								'paraf1' 			=> $paraf1,
								'paraf2' 			=> $paraf2,
								'paraf3' 			=> $paraf3,
								'paraf4' 			=> $paraf4,
								'penandatangan' 	=> $pejabat,
								'namapenandatangan' => $penandatangan,
								'nippenandatangan' 	=> $nippenandatangan,
								'updated_at' 		=> date("Y-m-d H:i:s")
							]);
							$marking 	= 'DRAFTSK-'.$idne;
							if ($input){
								if ($request->hasFile('file')) {
									$getdatalama = Draftsk::where('id', $idne)->first();
									if (isset($getdatalama->lampiran)){
										if (File::exists(base_path()) ."/public/scan/files/". $getdatalama->lampiran) {
										  File::delete(base_path() ."/public/scan/files/". $getdatalama->lampiran);
										}
									}
									$namafile		= Session('fakultas').'-'.$marking;
									$namafile		= $namafile.'.'.$request->file('file')->getClientOriginalExtension();
									$uploadedFile 	= $request->file('file');
									$request->file('file')->move(public_path('scan/files'), $namafile);
									Draftsk::where('id', $idne)->update([
										'lampiran' 	=> $namafile,
									]);
								}
								Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
								Inboxsurat::insert([
									'marking'  		=>  $marking,
									'pengirim'  	=>  $konseptor,
									'penerima'		=>  $paraf1,
									'status'		=>  'send',
									'sifat'			=>  '1',
									'jenis'			=>  'KELUAR',
									'kerja'			=>  'PARAF',
									'catatan'		=>  'DRAFTSK',
									'tandatangan'	=>  '',
									'tanggal'		=>  '1',
								]);
								$idcaritoken	= 0;
								$cariiduser 	= User::where('previlage', $paraf1)->orderBy('id', 'DESC')->get();
								if (!empty($cariiduser)){
									foreach ( $cariiduser as $rididuser ){
										$idcaritoken	= $rididuser->id;
										$caritoken 		= Firebasebank::where('userid', $idcaritoken)->count();
										if ($caritoken != 0){
											$tuliskirim = 'Draft SK telah dibuat dan siap diperiksa';
											$jtokencari	= Firebasebank::where('userid', $idcaritoken)->get();
											foreach ( $jtokencari as $rtokencari ){
												$firebaseid = $rtokencari->firebase;
												$msg = array (
													'message' 	=> $tuliskirim,
													'title'		=> 'SCO',
													'subtitle'	=> 'Universitas Brawijaya',
													'tickerText'=> 'PARAF',
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
													'Authorization: key=AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt',
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
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sukses di Update..!!']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada yang diupdate, Exiting']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sudah ada']);
							return back();
						}
					}
				} else {
					$nama				= $request->input('val09');			
					$idpeg				= $request->input('val10');			
					$nip				= $request->input('val11');			
					$statuspeg			= $request->input('val12');			
					$jenispeg			= $request->input('val13');			
					$pangkat			= $request->input('val14');			
					$unitkerja			= $request->input('val15');			
					$jabatan			= $request->input('val16');			
					$nip				= preg_replace('/\s+/', '', $nip);
					
					if ($idpeg == '0'){
						$cekpegawai		= Simpegpegawai::where('nip_baru', $nip)->first();
						if (isset($cekpegawai->id)){
							$idpeg	= $cekpegawai->id;
						} else {
							$idpeg = Simpegpegawai::insertGetId([
								'idpeg'						=> null,
								'jenispeg'					=> $jenispeg, 
								'fungsional'				=> $statuspeg, 
								'nik'						=> '', 
								'nokk'						=> '', 
								'nama_lengkap'				=> $nama, 
								'nama'						=> $nama, 
								'nip_lama'					=> '', 
								'nip_baru'					=> $nip, 
								'nidn'						=> '', 
								'jenis_kelamin'				=> '', 
								'tmpt_lahir'				=> '', 
								'tgl_lahir'					=> '', 
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
								'keterangan'				=> 'Created from SCO', 
								'tmt_golongan'				=> '', 
								'jab_fungsional'			=> '', 
								'tmt_fungsional'			=> '', 
								'tmt_pensiun'				=> '', 
								'thn_pensiun'				=> '', 
								'tmt_cpns'					=> '', 
								'tmt_pns'					=> '', 
								'thn_masuk'					=> '', 
								'unit_kerja'				=> $unitkerja, 
								'bidang_ilmu'				=> '', 
								'lab'						=> '', 
								'program_studi'				=> '', 
								'sertifikasi'				=> '', 
								'pend_akhir'				=> '', 
								'ijasah_diakui'				=> '', 
								'status_pegawai'			=> 'Aktif', 
								'masa_kerja'				=> '', 
								'pns'						=> '', 
								'status_jabatan'			=> '', 
								'karpeg'					=> '', 
								'agama'						=> '', 
								'alamat'					=> '', 
								'no_hp'						=> '', 
								'kode'						=> '', 
								'foto'						=> '', 
								'tmtgaji'					=> '', 
								'tmtpangkat'				=> '', 
								'ppabp'						=> $unitkerja, 
								'jabatan'					=> $jabatan, 
								'proses_pangkat'			=> '', 
								'angka_kredit'				=> '', 
								'email_ub'					=> '', 
								'lama_tubel'				=> '', 
								'lama_kenaikan_pangkat'		=> '', 
								'tmt_tubel'					=> ''
							]);
						}
					}
					if ($idne == 'new'){
						$ceksudah 	= Draftsk::where('jenissk', $jenis)->where('nip', $nip)->where('tmt', $tmt)->count();
						if ($ceksudah == 0){
							$input = Draftsk::create([
								'jenissk' 			=> 'DRAFTSK',
								'nomor' 			=> $nomor,
								'tahun' 			=> $tahun,
								'tanggalsk' 		=> $tanggal,
								'judulsk' 			=> $judul,
								'menimbang' 		=> $menimbang,
								'mengingat' 		=> $mengingat,
								'menetapkan' 		=> $menetapkan,
								'memutuskan' 		=> $memutuskan,
								'tembusan' 			=> $tembusan,
								'tmt' 				=> $tmt,
								'idpeg' 			=> $idpeg,
								'nama' 				=> $nama,
								'nip' 				=> $nip,
								'golongan' 			=> $pangkat,
								'statuspeg' 		=> $statuspeg,
								'jenispeg' 			=> $jenispeg,
								'unitkerjapeg' 		=> $unitkerja,
								'jabatanpeg' 		=> $jabatan,
								'kelas' 			=> 0,
								'nilai' 			=> 0,
								'tgp' 				=> 0,
								'insentif' 			=> 0,
								'konseptor' 		=> Session('jabatan'),
								'unitkonseptor' 	=> Session('fakultas'),
								'paraf1' 			=> $paraf1,
								'paraf2' 			=> $paraf2,
								'paraf3' 			=> $paraf3,
								'paraf4' 			=> $paraf4,
								'penandatangan' 	=> $pejabat,
								'namapenandatangan' => $penandatangan,
								'nippenandatangan' 	=> $nippenandatangan,
								'arsip' 			=> '0',
								'marking' 			=> '0'
							]);
							$id 		= $input->id;
							$marking 	= 'DRAFTSK-'.$id;
							$input 		= Draftsk::where('id', $id)->update([
								'marking' => $marking
							]);
							if ($input){
								Inboxsurat::insert([
									'marking'  		=>  $marking,
									'pengirim'  	=>  $konseptor,
									'penerima'		=>  $paraf1,
									'status'		=>  'send',
									'sifat'			=>  '1',
									'jenis'			=>  'KELUAR',
									'kerja'			=>  'PARAF',
									'catatan'		=>  'DRAFTSK',
									'tandatangan'	=>  '',
									'tanggal'		=>  '1',
								]);
								$idcaritoken	= 0;
								$cariiduser 	= User::where('previlage', $paraf1)->orderBy('id', 'DESC')->get();
								if (!empty($cariiduser)){
									foreach ( $cariiduser as $rididuser ){
										$idcaritoken	= $rididuser->id;
										$caritoken 		= Firebasebank::where('userid', $idcaritoken)->count();
										if ($caritoken != 0){
											$tuliskirim = 'Draft SK telah dibuat dan siap diperiksa';
											$jtokencari	= Firebasebank::where('userid', $idcaritoken)->get();
											foreach ( $jtokencari as $rtokencari ){
												$firebaseid = $rtokencari->firebase;
												$msg = array (
													'message' 	=> $tuliskirim,
													'title'		=> 'SCO',
													'subtitle'	=> 'Universitas Brawijaya',
													'tickerText'=> 'PARAF',
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
													'Authorization: key=AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt',
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
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sukses di Input..!!']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada yang diupdate, Exiting']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sudah ada']);
							return back();
						}
					} else {
						$ceksudah 	= Draftsk::where('id', '!=', $idne)->where('jenissk', $jenis)->where('nip', $nip)->where('tmt', $tmt)->count();
						if ($ceksudah == 0){
							$input = Draftsk::where('id', $idne)->update([
								'jenissk' 			=> $jenis,
								'nomor' 			=> $nomor,
								'tahun' 			=> $tahun,
								'tanggalsk' 		=> $tanggal,
								'judulsk' 			=> $judul,
								'menimbang' 		=> $menimbang,
								'mengingat' 		=> $mengingat,
								'menetapkan' 		=> $menetapkan,
								'memutuskan' 		=> $memutuskan,
								'tembusan' 			=> $tembusan,
								'tmt' 				=> $tmt,
								'idpeg' 			=> $idpeg,
								'nama' 				=> $nama,
								'nip' 				=> $nip,
								'golongan' 			=> $pangkat,
								'statuspeg' 		=> $statuspeg,
								'jenispeg' 			=> $jenispeg,
								'unitkerjapeg' 		=> $unitkerja,
								'konseptor' 		=> Session('jabatan'),
								'unitkonseptor' 	=> Session('fakultas'),
								'paraf1' 			=> $paraf1,
								'paraf2' 			=> $paraf2,
								'paraf3' 			=> $paraf3,
								'paraf4' 			=> $paraf4,
								'penandatangan' 	=> $pejabat,
								'namapenandatangan' => $penandatangan,
								'nippenandatangan' 	=> $nippenandatangan,
								'updated_at' 		=> date("Y-m-d H:i:s")
							]);
							$marking 	= 'DRAFTSK-'.$idne;
							if ($input){
								Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
								Inboxsurat::insert([
									'marking'  		=>  $marking,
									'pengirim'  	=>  $konseptor,
									'penerima'		=>  $paraf1,
									'status'		=>  'send',
									'sifat'			=>  '1',
									'jenis'			=>  'KELUAR',
									'kerja'			=>  'PARAF',
									'catatan'		=>  'DRAFTSK',
									'tandatangan'	=>  '',
									'tanggal'		=>  '1',
								]);
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sukses di Update..!!']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada yang diupdate, Exiting']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Draft SK '.$jenis.' an. '.$nama.' Sudah ada']);
							return back();
						}
					}
				}
			}
		}
    }
//BLOK_KONTRAK_PEGAWAI
	public function exKirimdraftSKkontrak(Request $request) {
		$idsurat  			= $request->input('val01');
		$homebase			= url("/");
		if ($idsurat == 'kontrakfromsuratkeluar'){
			$idsurat  		= $request->input('val02');
			$pemeriksa  	= $request->input('val03');
			$penandatangan  = $request->input('val04');
			$getsuratkeluar = Suratkeluar::where('id', $idsurat)->first();
			if (isset($getsuratkeluar->id)){
				$getpjbttte = Pejabatsurat::where('pejabat', $penandatangan)->first();
				if (isset($getpjbttte->id)){
					Suratkeluar::where('id', $getsuratkeluar->id)->update([
						'idpejabat' 	=>  $getpjbttte->id,
						'pejabat' 		=>  $getpjbttte->pejabat,
						'namapejabat' 	=>  $getpjbttte->nama,
						'kodefak' 		=>  $getpjbttte->kode,
						'tembusan'		=> 	$pemeriksa,
						'status'		=> 	'Proses',
						'paraf1'		=>	'SELF',
						'filelampiran'	=> 	''
					]);
				}
				
				if ($pemeriksa != ''){
					$pejabat 	= $pemeriksa;
					$jenis 		= 'PARAF';
				} else {
					$pejabat 	= $penandatangan;
					$jenis 		= 'Mohon TTD';
				}
				$kirim 			= null;
				$ceksudah 		= Penerimasurat::where('jenis', 'KELUAR')->where('idsurat', $getsuratkeluar->id)->where('penulisan', $getsuratkeluar->alamat)->count();
				if ($ceksudah == 0){
					$generatesurat 	= '<iframe src="'.$homebase.'/ttdberkas/keluar-'.$getsuratkeluar->id.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
					$getpegawai 	= Simpegpegawai::where('email_ub', $getsuratkeluar->alamat)->orWhere('email', $getsuratkeluar->alamat)->first();
					if (isset($getpegawai->id)){
						$kirim = Penerimasurat::insert([
							'asalsurat' => Session('previlage'), 
							'perihal' 	=> $getsuratkeluar->perihal, 
							'idsurat' 	=> $getsuratkeluar->id, 
							'jenis'		=> 'KONTRAK', 
							'keterangan'=> 'Penandatanganan Perjanjian Kerja',
							'idpegawai'	=> $getpegawai->id, 
							'nama'		=> $getsuratkeluar->kepada, 
							'jabatan'	=> $getpegawai->jabatan, 
							'penulisan'	=> $getsuratkeluar->alamat,
							'tabel'		=> $generatesurat,
							'status'	=> 'SEND',
							'fakultas'	=> Session('fakultas'),
							'created_by'=> Session('nama'),
							'updated_by'=> Session('nama'),
						]);
						if ($kirim){
							$pesan = 'Terkirim ke inbox '.$getpegawai->nama_lengkap;
						} else {
							$pesan = 'Gagal kirim ke inbox '.$getpegawai->nama_lengkap;
						}
					} else {
						$pesan = 'Gagal Mencari email '.$getsuratkeluar->kepada;
					}
				} else {
					$pesan = 'Data Pengiriman Sudah ada dan terkirim '.$getsuratkeluar->kepada;
				}
				
				$getpejabat = Pejabatsurat::where('pejabat', $pejabat)->first();
				if (isset($getpejabat->id)){
					$ceksudah = Inboxsurat::where('marking', $getsuratkeluar->marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
					if ($ceksudah != 0){
						Inboxsurat::where('marking', $getsuratkeluar->marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
					}
					$kirim = SendMail::kiriminbox($getsuratkeluar->marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,'KONTRAK','1');
					$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$pejabat;
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
					return back();
				} else {
					$gagal = $pesan.'<br />Data Pejabat : '.$pejabat.' Tidak di Valid';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
					return back();
				}
			} else {
				$gagal = $pesan.'<br />Data dengan ID '.$idsurat.' Tidak di Temukan';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
				return back();
			}
		} else if ($idsurat == 'skeputusandirektur'){
			$idsurat  		= $request->input('val02');
			$pemeriksa  	= $request->input('val03');
			$penandatangan  = $request->input('val04');
			if ($pemeriksa == ''){ $pemeriksa = 'SELF'; }
			$getsuratkeluar = Tabelskdanperaturan::where('id', $idsurat)->first();
			if (isset($getsuratkeluar->id)){
				$getpjbttte = Pejabatsurat::where('pejabat', $penandatangan)->first();
				if (isset($getpjbttte->id)){
					Tabelskdanperaturan::where('id', $getsuratkeluar->id)->update([
						'sparaf1'		=> 	'Proses',
						'paraf1'		=>	$pemeriksa,
						'idpejabat' 	=>  $getpjbttte->id,
						'penandatangan' =>  $getpjbttte->pejabat,
						'nmpejabat' 	=>  $getpjbttte->nama,
					]);
				} else {
					$penandatangan 	= $getsuratkeluar->penandatangan;
					$pemeriksa 		= $getsuratkeluar->paraf1;
				}
				if ($pemeriksa != 'SELF'){
					$pejabat 	= $pemeriksa;
					$jenis 		= 'PARAF';
				} else {
					$pejabat 	= $penandatangan;
					$jenis 		= 'Mohon TTD';
				}
				$kirim 			= null;
				$ceksudah 		= Penerimasurat::where('jenis', 'SK')->where('idsurat', $getsuratkeluar->id)->where('penulisan', $getsuratkeluar->sparaf4)->count();
				if ($ceksudah == 0){
					$generatesurat 	= '<iframe src="'.$homebase.'/viewsurat/SKPP-'.$getsuratkeluar->id.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
					$getpegawai 	= Simpegpegawai::where('email_ub', $getsuratkeluar->sparaf4)->orWhere('email', $getsuratkeluar->sparaf4)->first();
					if (isset($getpegawai->id)){
						$kirim = Penerimasurat::insert([
							'asalsurat' => Session('previlage'), 
							'perihal' 	=> $getsuratkeluar->judul, 
							'idsurat' 	=> $getsuratkeluar->id, 
							'jenis'		=> 'SK', 
							'keterangan'=> $getsuratkeluar->kelompok,
							'idpegawai'	=> $getpegawai->id, 
							'nama'		=> $getpegawai->nama_lengkap, 
							'jabatan'	=> $getpegawai->jabatan, 
							'penulisan'	=> $getsuratkeluar->sparaf4,
							'tabel'		=> $generatesurat,
							'status'	=> 'SEND',
							'fakultas'	=> Session('fakultas'),
							'created_by'=> Session('nama'),
							'updated_by'=> Session('nama'),
						]);
						if ($kirim){
							$pesan = 'Terkirim ke inbox '.$getpegawai->nama_lengkap;
						} else {
							$pesan = 'Gagal kirim ke inbox '.$getpegawai->nama_lengkap;
						}
					} else {
						$pesan = 'Gagal Mencari email '.$getsuratkeluar->sparaf4;
					}
				} else {
					$pesan = 'Data Pengiriman Sudah ada dan terkirim '.$getsuratkeluar->namaparaf4;
				}
				$getpejabat = Pejabatsurat::where('pejabat', $pejabat)->first();
				if (isset($getpejabat->id)){
					$ceksudah = Inboxsurat::where('marking', $getsuratkeluar->marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->count();
					if ($ceksudah != 0){
						Inboxsurat::where('marking', $getsuratkeluar->marking)->where('penerima', $getpejabat->pejabat)->where('jenis', 'KELUAR')->delete();
					}
					$kirim = SendMail::kiriminbox($getsuratkeluar->marking,Session('nama'),$getpejabat->pejabat,$getpejabat->email,'KELUAR',$jenis,$getsuratkeluar->kelompok,'1');
					$pesan = $pesan.'<br />Data Sudah Terkirim Ke '.$pejabat;
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $pesan]);
					return back();
				} else {
					$gagal = $pesan.'<br />Data Pejabat : '.$pejabat.' Tidak di Valid';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
					return back();
				}
			} else {
				$gagal = $pesan.'<br />Data dengan ID '.$idsurat.' Tidak di Temukan';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
				return back();
			}
		}
	}
	public function jgetdetailPangkat(Request $request) {
		$idpeg  	= $request->input('val01');
		$marking  	= $request->input('val02');
		$jenis  	= $request->input('val03');
		$homebase	= url("/");
		$arraysurat	= [];
		$bulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		if ($jenis == 'caripangkat'){
			if ($idpeg == 'Aktif'){
				$qdatasrt	= Draftsk::whereIn('jenissk', ['PangkatNONPNS', 'PangkatPNS'])
								->where('status', '!=', 'ARSIP')
								->orderBy('id', 'ASC')->get();
			} else {
				$qdatasrt	= Draftsk::whereIn('jenissk', ['PangkatNONPNS', 'PangkatPNS'])
								->where('idpeg', $idpeg)
								->orderBy('id', 'ASC')->get();
			}
		} else if ($jenis == 'caritubel'){
			$qdatasrt	= Draftsk::whereIn('jenissk', ['IZIN BELAJAR DOSEN NON PNS', 'IZIN BELAJAR DOSEN PNS', 'TUGAS BELAJAR DOSEN NON PNS', 'PERPANJANGAN TUBEL DOSEN NON PNS'])
							->where('idpeg', $idpeg)
							->orderBy('id', 'ASC')->get();
		} else if ($jenis == 'caripangkatakad'){
			$qdatasrt	= Draftsk::whereIn('jenissk', ['PEMBERHENTIAN JABATAN AKADEMIK DOSEN NON PNS', 'PENGANGKATAN KEMBALI DALAM JABATAN AKADEMIK DOSEN NON PNS'])
							->where('idpeg', $idpeg)
							->orderBy('id', 'ASC')->get();
		} else if ($jenis == 'caripemberhentian'){
			$qdatasrt	= Draftsk::whereIn('jenissk', ['BUP Tetap Non PNS', 'Pengunduran Diri', 'Meninggal Dunia'])
							->where('idpeg', $idpeg)
							->orderBy('id', 'ASC')->get();
		} else if ($jenis == 'cariall'){
			$qdatasrt	= Draftsk::where('idpeg', $idpeg)->orderBy('id', 'ASC')->get();
		} else {
			$qdatasrt	= [];
		}
		if (!empty($qdatasrt)){
			foreach ($qdatasrt as $getdatasrt) {
				$idne			= $getdatasrt->id;
				$jenissk		= $getdatasrt->jenissk;
				$paraf1			= $getdatasrt->paraf1;
				$paraf2			= $getdatasrt->paraf2;
				$paraf3			= $getdatasrt->paraf3;
				$paraf4			= $getdatasrt->paraf4;
				$penandatangan	= $getdatasrt->penandatangan;
				$marking		= $getdatasrt->marking;
				$nomor			= $getdatasrt->nomor;
				$anakno			= $getdatasrt->anakno;
				$tahun			= $getdatasrt->tahun;
				$tanggalsk		= '';
				if ($request->input('val02') == 'cariperid'){
					$sparaf1 = '';
					$sparaf2 = '';
					$sparaf3 = '';
					$sparaf4 = '';
					$spenandatangan = '';
					if ($nomor != ''){
						if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
						$nomor 		= $nomor.' Tahun '.$tahun;
						$tanggalsk	= $getdatasrt->tanggalsk;
						$arrtanggal	= explode('-', $tanggalsk);
						$yy 		= $arrtanggal[0];
						$mm 		= (int)$arrtanggal[1];
						$dd 		= $arrtanggal[2];
						$mm			= $bulan[$mm];
						$tanggalsk	= $dd.' '.$mm.' '.$yy;
					} else { $nomor = '<font color=green>SIAP DINOMORI</font>'; }
				} else {
					if ($paraf1 != ''){
						$cek1		= Inboxsurat::where('penerima', $paraf1)->where('marking', $marking)->where('tandatangan', '!=', '')->count();
						if ($cek1 != 0){
							$sparaf1 = '<font color=green>'.$paraf1.'</font>';
						} else { $sparaf1 = '<font color=grey>'.$paraf1.'</font>'; }
					} else { $sparaf1 = ''; }
					if ($paraf2 != ''){
						$cek2		= Inboxsurat::where('penerima', $paraf2)->where('marking', $marking)->where('tandatangan', '!=', '')->count();
						if ($cek2 != 0){
							$sparaf2 = '<font color=green>'.$paraf2.'</font>';
						} else { $sparaf2 = '<font color=grey>'.$paraf2.'</font>'; }
					} else { $sparaf2 = ''; }
					if ($paraf3 != ''){
						$cek3		= Inboxsurat::where('penerima', $paraf3)->where('marking', $marking)->where('tandatangan', '!=', '')->count();
						if ($cek3 != 0){
							$sparaf3 = '<font color=green>'.$paraf3.'</font>';
						} else { $sparaf3 = '<font color=grey>'.$paraf3.'</font>'; }
					} else { $sparaf3 = ''; }
					if ($paraf4 != ''){
						$cek4		= Inboxsurat::where('penerima', $paraf4)->where('marking', $marking)->where('tandatangan', '!=', '')->count();
						if ($cek4 != 0){
							$sparaf4 = '<font color=green>'.$paraf4.'</font>';
						} else { $sparaf4 = '<font color=grey>'.$paraf4.'</font>'; }
					} else { $sparaf4 = ''; }
					if ($penandatangan != ''){
						$cek5		= Inboxsurat::where('penerima', $penandatangan)->where('marking', $marking)->where('tandatangan', '!=', '')->count();
						if ($cek5 != 0){
							$spenandatangan = '<font color=green>'.$penandatangan.'</font>';
							if ($nomor != ''){
								if ($anakno != ''){ $nomor = $nomor.'.'.$anakno; }
								$nomor 		= $nomor.' Tahun '.$tahun;
								$tanggalsk	= $getdatasrt->tanggalsk;
								$arrtanggal	= explode('-', $tanggalsk);
								$yy 		= $arrtanggal[0];
								$mm 		= (int)$arrtanggal[1];
								$dd 		= $arrtanggal[2];
								$mm			= $bulan[$mm];
								$tanggalsk	= $dd.' '.$mm.' '.$yy;
							} else { $nomor = '<font color=green>SIAP DINOMORI</font>'; }
						} else { $spenandatangan = '<font color=grey>'.$penandatangan.'</font>'; $nomor = '<font color=red>On Progress</font>';}
					} else { $spenandatangan = ''; $nomor = '<font color=red>On Progress</font>';}
				}
				$arraysurat[] 	= array(
					'idsurat' 		=> $getdatasrt->id,
					'jenissk' 		=> $jenissk,
					'paraf1' 		=> $paraf1,
					'paraf2' 		=> $paraf2,
					'paraf3' 		=> $paraf3,
					'paraf4' 		=> $paraf4,
					'penandatangan' => $penandatangan,
					'sparaf1' 		=> $sparaf1,
					'sparaf2' 		=> $sparaf2,
					'sparaf3' 		=> $sparaf3,
					'sparaf4' 		=> $sparaf4,
					'spenandatangan'=> $spenandatangan,
					'menimbang' 	=> $getdatasrt->menimbang,
					'mengingat' 	=> $getdatasrt->mengingat,
					'menetapkan' 	=> $getdatasrt->menetapkan,
					'tmt' 			=> $getdatasrt->tmt,
					'idpeg' 		=> $getdatasrt->idpeg,
					'nama' 			=> $getdatasrt->nama,
					'nip' 			=> $getdatasrt->nip,
					'golongan' 		=> $getdatasrt->golongan,
					'statuspeg' 	=> $getdatasrt->statuspeg,
					'jenispeg' 		=> $getdatasrt->jenispeg,
					'unitkerjapeg' 	=> $getdatasrt->unitkerjapeg,
					'jabatanpeg' 	=> $getdatasrt->jabatanpeg,
					'kelas' 		=> $getdatasrt->kelas,
					'nilai' 		=> $getdatasrt->nilai,
					'tgp' 			=> $getdatasrt->tgp,
					'insentif' 		=> $getdatasrt->insentif,
					'konseptor' 	=> $getdatasrt->konseptor,
					'unitkonseptor' => $getdatasrt->unitkonseptor,
					'nomor' 		=> $nomor,					
					'tanggal' 		=> $tanggalsk,
				);
			}
		}
    	echo json_encode($arraysurat);
	}
//END_BLOK_KONTRAK_PEGAWAI
	public function pleaseSignberkasKepegawain($id){
		$homebase	= url("/");
		$getjenid	= explode('-', $id);
		if (isset($getjenid[1])){
			$id 	= $getjenid[1];
			$jenis 	= $getjenid[0];
		} else {
			$jenis 	= '';
		}
		$alamatweb	= '';
		$rom		= null;
		if ($jenis == 'skkontrak'){
			$alamatweb	= $homebase.'/viewsurat/1b8a4d4791bd4b1b030db52b115e99b0-skkontrak='.$id;
			$rom  		= DraftKontrak::where('id', $id)->first();
		}
		$qrcode 	= QrCode::size(80)->generate($alamatweb);
		$kalender   = array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd         = date("d");
		$mm         = (int)date("m");
		$mm			= $kalender[$mm];
		$tahuniki   = date("Y");
		$tglsurat	= date("Y-m-d");
		$sakniki	= $dd.' '.$mm.' '.$tahuniki;
		if (isset($rom->id)){
			$status 		= $rom->status;
			$tandatangan 	= $rom->tandatangan;
			if ($tandatangan == '' OR is_null($tandatangan)){
				$data           		=   [];
				$data['jenissurat'] 	= 	'Surat Kontrak';
				$data['tandatangan'] 	= 	$tandatangan;
				$data['idsurat'] 	    = 	$id;
				$data['sakniki']       	=   $sakniki;
				$data['alamatweb']    	=   $alamatweb;
				$data['surat']     		=   $rom;
				return view('dokar.formttd', $data);
			} else {
				return redirect($alamatweb);
			}
		} else {
			return view('vokasi.hilang');
		}
	}
	public function exUploadSuratKepegawaian(Request $request) {
		$homebase		= url("/");
		$certificate 	= 'file://'.base_path().'/public/sco.crt';
		$tugas			= $request->input('val01');
		$nmttd			= $request->input('val05');
		$paraf1			= $request->input('val06');
		$paraf2			= $request->input('val07');
		$paraf3			= $request->input('val08');
		$paraf4			= $request->input('val09');
		$marking		= $request->input('val10');
		$idsurat		= $request->input('val11');
		if ($paraf2 == ''){ $paraf2 = '0'; }
		if ($paraf3 == ''){ $paraf3 = '0'; }
		if ($paraf4 == ''){ $paraf4 = '0'; }
		$paraf5 		= 0;
		$info 				= array(
			'Name' 			=> 'Smart and Collaborative Office',
			'Location' 		=> config('global.swandhanauniv'),
			'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
			'ContactInfo' 	=> $homebase,
		);
		$page_format 		= array(
			'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
			'Dur' 			=> 3,
			'PZ' 			=> 1,
		);
		if ($tugas == 'kontrakpegawai'){
			$ceksek 		= DraftKontrak::where('id', $idsurat)->first();
			if (isset($ceksek->id)){
				DraftKontrak::where('id', $idsurat)->update([
					'penandatangan'	=> $nmttd,
					'paraf1'		=> $paraf1,
					'paraf2'		=> $paraf2,
					'paraf3'		=> $paraf3,
					'paraf4'		=> $paraf4
				]);
				$idpejabat	= $nmttd;
				$text		= genTextKepegawaian('skkontrak='.$idsurat);
				$file		= '';
				$nip 		= $ceksek->nip;
				$email 		= $ceksek->email;
				$nama 		= $ceksek->nama;
				$tahun 		= $ceksek->tahun;
				$fakultas 	= $ceksek->fakultas;
				$tanggalsk 	= $ceksek->tanggalsk;
				$arrtanggal	= explode("-", $tanggalsk);

				$marking 	= $fakultas.'-KONTRAK-'.$tahun.'-'.$idsurat;
				$nip		= preg_replace('/\s+/', '', $nip);
				$ceksertifikatpribadi 	= $nip.'.crt';
				$sertifikatpribadi 		= $nip.'.csr';
				if (file_exists(public_path('tte/'.$ceksertifikatpribadi))){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
				} else {
					if ($email == ''){ $email = $nip.'@ub.ac.id';}
					$dn = array(
						"countryName" 			=> "IN",
						"stateOrProvinceName" 	=> "East Java Indonesia",
						"localityName" 			=> "Malang",
						"organizationName" 		=> "Universitas Brawijaya",
						"organizationalUnitName"=> Session('jabatan'),
						"commonName" 			=> $nama,
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
					file_put_contents(base_path()."/public/tte/".$nippjbt.".crt", $pkeyout);
					file_put_contents(base_path()."/public/tte/".$nippjbt.".crt", $certout, FILE_APPEND | LOCK_EX);
				}
				$certificate= $nip.'.crt';
				if (file_exists(public_path('tte/'.$certificate))){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$nip.'.crt';
				}
				$titel 		= 'Draft Kontrak Kerja';
				PDFCREATOR::setSignature($certificate, $certificate, $nip, '', 2, $info, 'A');
				PDFCREATOR::SetCreator('Smart and Collaborative Office');
				PDFCREATOR::SetAuthor(Session('nama'));
				PDFCREATOR::SetTitle($ceksek->jenispegawai.' '.$ceksek->kontrak);
				PDFCREATOR::SetSubject($ceksek->nama);
				PDFCREATOR::SetKeywords($ceksek->nip);
				PDFCREATOR::setPrintHeader(false);
				PDFCREATOR::setPrintFooter(false);
				PDFCREATOR::SetMargins(5, 0, 5);
				PDFCREATOR::setFontSubsetting(true);
				PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
				PDFCREATOR::AddPage('P', $page_format, false, false);
				$bMargin = PDFCREATOR::getBreakMargin();
				$auto_page_break = PDFCREATOR::getAutoPageBreak();
				PDFCREATOR::SetAutoPageBreak(false, 0);
				$img_file = public_path('bgbssn.png');
				PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
				PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
				PDFCREATOR::setPageMark();
				PDFCREATOR::writeHTML($text, true, 0, true, 0);
				PDFCREATOR::setFooterMargin(0);
				$pdfdoc = PDFCREATOR::Output('', 'S');
				PDFCREATOR::reset();
				Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
				$file =  public_path('scan/files/'.$marking.'.pdf');
				DraftKontrak::where('id', $idsurat)->update([
					'marking'	=> $marking,
					'status'	=> 'Proses TTE'
				]);
				$dd 	  		= $arrtanggal[2];
				$mm 	  		= $arrtanggal[1];
				$yy 	  		= $arrtanggal[0];
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
				$getpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
				if (isset($getpejabat->id)){
					$kodepjbt		= $getpejabat->kode;
					$penandatangan	= $getpejabat->pejabat;
					$setttd			= $getpejabat->nama;	
				} else {
					$kodepjbt		= '0';
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
				$ceknomorsrt	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
				if ($ceknomorsrt == 0){
					$nomor 		= 1;
				} else {
					$ceknomorsrt= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
					$lastno		= $ceknomorsrt->nomor;
					$nomor 		= $lastno+1;
				}
				$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
				$idnomor		= $getid->id;
				$idnomor		= $idnomor + 1;
				$ceksek			= Suratkeluar::where('nomor', $nomor)->where('yersrt', $yy)->count();
				if ($ceksek != 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Generate Nomor Gagal, Silahkan Coba Beberapa Saat Lagi (Double Detected)']);
					return back();
				} else {
					$sendstatus		= 'Generate Nomor Gagal, Silahkan Coba Beberapa Saat Lagi';
					$datasurat 		= DraftKontrak::where('id', $idsurat)->first();
					try {
						$kerjanya 	= Suratkeluar::insertGetId([
							'id' 			=>  $idnomor,
							'marking' 		=>  $datasurat->marking,
							'jenissrt' 		=>  'UPLOAD',
							'nomor' 		=>  $nomor,
							'anakno' 		=>  '',
							'kodefak' 		=>  $kodepjbt,
							'unit' 			=>  'KP',
							'tglsurat' 		=>  $datasurat->tanggalsk,
							'daysrt' 		=>  $dd,
							'monsrt' 		=>  $mm,
							'yersrt' 		=>  $yy,
							'dasarsurat' 	=>  '',
							'kepada' 		=>  '',
							'alamat' 		=>  '',
							'perihal' 		=>  'Surat Perjanjian Kerja '.$datasurat->jenispegawai.' '.$datasurat->kontrak.' Tahun '.$datasurat->tahun,
							'lampiran' 		=>  '',
							'isisurat' 		=>  $datasurat->id,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $penandatangan,
							'namapejabat' 	=>  $setttd,
							'tembusan' 		=>  '',
							'sifat' 		=>  '4',
							'klasifikasi' 	=>  'Biasa',
							'pembuat' 		=>  Session('nama'),
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
							'faskode' 		=>  'KP.05.01.2',
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
						$sendstatus = $e->getMessage();
					}
					if ($kerjanya != 0){
						Inboxsurat::where('marking', $datasurat->marking)->where('jenis', 'KELUAR')->delete();
						$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
						$pejabat 	= $qnamapjbt->pejabat;
						Inboxsurat::insert([
							'marking'  		=>  $marking,
							'pengirim'  	=>  Session('nama'),
							'penerima'		=>  $pejabat,
							'status'		=>  'send',
							'sifat'			=>  5,
							'jenis'			=>  'KELUAR',
							'kerja'			=>  'PARAF',
							'catatan'		=>  '',
							'tandatangan'	=>  '',
							'tanggal'		=>  '1',
						]);
						$cariiduser 		= User::where('previlage', $pejabat)->where('fakultas', $fakultas)->get();
						if (!empty($cariiduser)){
							foreach ($cariiduser as $rid){
								$idcaritoken	= $rid->id;
								$caritoken 		= Firebasebank::where('userid', $idcaritoken)->count();
								if ($caritoken != 0){
									$tuliskirim = Session('nama').' Tengah membuat konsep surat mohon dijadikan periksa';
									$jtokencari	= Firebasebank::where('userid', $idcaritoken)->get();
									foreach ( $jtokencari as $rtokencari ){
										$firebaseid = $rtokencari->firebase;
										$msg = array (
											'message' 	=> $tuliskirim,
											'title'		=> 'SCO',
											'subtitle'	=> 'Universitas Brawijaya',
											'tickerText'=> 'Mohon diperiksa',
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
											'Authorization: key=' . API_ACCESS_KP,
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
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Surat Perjanjian Kerja '.$datasurat->jenispegawai.' '.$datasurat->kontrak.' Tahun '.$datasurat->tahun.' Telah Kami Kirim ke '.$pejabat.' Untuk di Paraf/ditandatangani']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $sendstatus]);
						return back();
					}
				}
			}
		} else if ($tugas == 'alihstatus'){
			$ceksek 		= Antrian::where('id', $idsurat)->first();
			if (isset($ceksek->id)){
				Antrian::where('ket', $ceksek->ket)->update([
					'penandatangan'	=> $nmttd,
					'paraf1'		=> $paraf1,
					'paraf2'		=> $paraf2,
					'paraf3'		=> $paraf3,
					'paraf4'		=> $paraf4
				]);
				$idpejabat	= $nmttd;
				$text		= genTextKepegawaian('alihstatus='.$idsurat);
				$file		= '';
				$fakultas 	= $ceksek->fakultas;
				$tanggalsk 	= date("Y-m-d");
				$arrtanggal	= explode("-", $tanggalsk);
				$dd 	  	= $arrtanggal[2];
				$mm 	  	= $arrtanggal[1];
				$yy 	  	= $arrtanggal[0];
				$thncari	= $yy.'-%';
				$tlstgl		= $yy.'-'.$mm.'-'.$dd;
				$nip 		= Session('id');
				$email 		= $nip.'@ub.ac.id';
				$getusers 	= User::where('username', Session('username'))->first();
				if (isset($getuser->previlage)){
					$previlage 	= $getuser->previlage;
					$idpeg 		= $getuser->nip;
					$nama 		= $getuser->nama;
					if ($idpeg != ''){
						$getnip = Simpegpegawai::where('id', $idpeg)->first();
						if (isset($getnip->nip_baru)){
							$nip 	= $getnip->nip_baru;
							$email 	= $getnip->emailub;
							$nip	= preg_replace('/\s+/', '', $nip);
						}
					} else {
						$getnip = Pejabatsurat::where('pejabat', $previlage)->first();
						if (isset($getnip->nip)){
							$nip 	= $getnip->nip;
							$email 	= $getnip->email;
							$nip	= preg_replace('/\s+/', '', $nip);
						}
					}
				} else {
					$nama 			= Session('nama');
				}
				$marking 				= $fakultas.'-ALIHSTATUS-'.$yy.'-'.$idsurat;
				$ceksertifikatpribadi 	= $nip.'.crt';
				$sertifikatpribadi 		= $nip.'.csr';
				if (file_exists(public_path('tte/'.$ceksertifikatpribadi))){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
				} else {
					if ($email == ''){ $email = $nip.'@ub.ac.id';}
					$dn = array(
						"countryName" 			=> "IN",
						"stateOrProvinceName" 	=> "East Java Indonesia",
						"localityName" 			=> "Malang",
						"organizationName" 		=> "Universitas Brawijaya",
						"organizationalUnitName"=> Session('jabatan'),
						"commonName" 			=> $nama,
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
					file_put_contents(base_path()."/public/tte/".$nip.".crt", $pkeyout);
					file_put_contents(base_path()."/public/tte/".$nip.".crt", $certout, FILE_APPEND | LOCK_EX);
				}
				$certificate= $nip.'.crt';
				if (file_exists(public_path('tte/'.$certificate))){
					$certificate 	= 'file://'.base_path().'/public/tte/'.$nip.'.crt';
				}
				$titel 			= 'Promosi Tenaga Kependidikan Tahun '.$yy;
				$getpejabat		= Pejabatsurat::where('id', $idpejabat)->first();
				if (isset($getpejabat->id)){
					$kodepjbt		= $getpejabat->kode;
					$penandatangan	= $getpejabat->pejabat;
					$setttd			= $getpejabat->nama;
				} else {
					$kodepjbt		= '0';
					$penandatangan	= '-';
					$setttd			= '-';
				}
				if ($ceksek->asal == '' OR is_null($ceksek->asal)){
					$ceknomorsrt	= Suratkeluar::where('yersrt', date("Y"))->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
					if ($ceknomorsrt == 0){
						$nomor 		= 1;
					}else {
						$ceknomorsrt= Suratkeluar::where('yersrt', date("Y"))->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
						$lastno		= $ceknomorsrt->nomor;
						$nomor 		= $lastno+1;
					}
					$ceknomormaju	= Suratkeluar::where('tglsurat', date("Y-m-d"))->orderBy('nomor', 'ASC')->where('fakultas', 'ODR-'.$fakultas)->first();
					if (isset($ceknomormaju->nomor)){
						$nomormsdepan	= $ceknomormaju->nomor;
						if ($nomormsdepan == $nomor){
							Suratkeluar::where('tglsurat', date("Y-m-d"))->where('fakultas', 'ODR-'.$fakultas)->update([
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
									'tglsurat' 		=>  date("Y-m-d"),
									'daysrt' 		=>  date("d"),
									'monsrt' 		=>  date("m"),
									'yersrt' 		=>  date("Y"),
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
							Suratkeluar::where('tglsurat', date("Y-m-d"))->where('fakultas', 'ODR-'.$fakultas)->update([
								'fakultas'	=> $fakultas
							]);
						}
						$ceknomorsrt	= Suratkeluar::where('yersrt', date("Y"))->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
						if ($ceknomorsrt == 0){
							$nomor 		= 1;
						}else {
							$ceknomorsrt= Suratkeluar::where('yersrt', date("Y"))->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
							$lastno		= $ceknomorsrt->nomor;
							$nomor 		= $lastno+1;
						}
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
					$ceknomorsrt	= Suratkeluar::where('yersrt', date("Y"))->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
					if ($ceknomorsrt == 0){
						$nomor 		= 1;
					} else {
						$ceknomorsrt= Suratkeluar::where('yersrt', date("Y"))->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
						$lastno		= $ceknomorsrt->nomor;
						$nomor 		= $lastno+1;
					}
					$getid 			= Suratkeluar::orderBy('id', 'DESC')->first();
					$idnomor		= $getid->id;
					$idnomor		= $idnomor + 1;
					$ceksudahada	= Suratkeluar::where('nomor', $nomor)->where('yersrt', date("Y"))->count();
					if ($ceksudahada != 0){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Generate Nomor Gagal, Silahkan Coba Beberapa Saat Lagi (Double Detected)']);
						return back();
					} else {
						$sendstatus		= 'Generate Nomor Gagal, Silahkan Coba Beberapa Saat Lagi';
						try {
							$kerjanya 	= Suratkeluar::insertGetId([
								'id' 			=>  $idnomor,
								'marking' 		=>  $marking,
								'jenissrt' 		=>  'UPLOAD',
								'nomor' 		=>  $nomor,
								'anakno' 		=>  '',
								'kodefak' 		=>  $kodepjbt,
								'unit' 			=>  'KP',
								'tglsurat' 		=>  date("Y-m-d"),
								'daysrt' 		=>  date("d"),
								'monsrt' 		=>  date("m"),
								'yersrt' 		=>  date("Y"),
								'dasarsurat' 	=>  '',
								'kepada' 		=>  '',
								'alamat' 		=>  '',
								'perihal' 		=>  $titel,
								'lampiran' 		=>  '',
								'isisurat' 		=>  $text,
								'idpejabat' 	=>  $idpejabat,
								'pejabat' 		=>  $penandatangan,
								'namapejabat' 	=>  $setttd,
								'tembusan' 		=>  $ceksek->fakultas,
								'sifat' 		=>  '4',
								'klasifikasi' 	=>  'Biasa',
								'pembuat' 		=>  Session('nama'),
								'kelompok' 		=>  Session('previlage'),
								'status' 		=>  'NEW',
								'arsip' 		=>  '',
								'footnote' 		=>  '',
								'tandatangan' 	=>  '',
								'paraf1'		=> $paraf1,
								'paraf2'		=> $paraf2,
								'paraf3'		=> $paraf3,
								'paraf4'		=> $paraf4,
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',
								'faskode' 		=>  'KP.09.05.1',
								'fasmasa' 		=>  '',
								'fasket' 		=>  '',
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'font' 			=>  '',
								'ukuran' 		=>  '',
								'lebarttd' 		=>  '',
								'filelampiran' 	=>  $ceksek->ket,
								'fakultas' 		=>  $fakultas
							]);
							Antrian::where('ket', $ceksek->ket)->update([
								'asal'		=> $kerjanya,
								'pada'		=> $marking,
								'whatfor'	=> date("Y-m-d"),
								'whatfor2'	=> $nomor.'/'.$kodepjbt.'/KP.09.05.1/'.date("Y"),
								'tembusan1'	=> 'Proses TTE'
							]);
						} catch (\Exception $e) {
							$kerjanya = 0;
							$sendstatus = $e->getMessage();
						}
						if ($kerjanya != 0){
							PDFCREATOR::setSignature($certificate, $certificate, $nip, '', 2, $info, 'A');
							PDFCREATOR::SetCreator('Smart and Collaborative Office');
							PDFCREATOR::SetAuthor(Session('nama'));
							PDFCREATOR::SetTitle($titel);
							PDFCREATOR::SetSubject($ceksek->nama);
							PDFCREATOR::SetKeywords($ceksek->nip);
							PDFCREATOR::setPrintHeader(false);
							PDFCREATOR::setPrintFooter(false);
							PDFCREATOR::SetMargins(5, 0, 5);
							PDFCREATOR::setFontSubsetting(true);
							PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							$img_file = public_path('bgbssn.png');
							PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/files/'.$marking.'.pdf', $pdfdoc);
							$file =  public_path('scan/files/'.$marking.'.pdf');
							Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
							$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
							$pejabat 	= $qnamapjbt->pejabat;
							Inboxsurat::insert([
								'marking'  		=>  $marking,
								'pengirim'  	=>  Session('nama'),
								'penerima'		=>  $pejabat,
								'status'		=>  'send',
								'sifat'			=>  5,
								'jenis'			=>  'KELUAR',
								'kerja'			=>  'PARAF',
								'catatan'		=>  '',
								'tandatangan'	=>  '',
								'tanggal'		=>  '1',
								'idsurat'		=> $kerjanya,
								'noagenda'		=> 0,
								'tglsurat'		=> date("Y-m-d"),
								'jenissrt'		=> 'UPLOAD',
								'nosurat'		=> $nomor.'/'.$kodepjbt.'/KP.09.05.1/'.date("Y"),
								'kepada'		=> '',
								'perihal'		=> $titel,
								'alamat'		=> '',
								'lampiran'		=> '',
								'kodefak'		=> $kodepjbt,
								'klasifikasi'	=> 'Biasa',
								'pembuat'		=> Session('nama'),
								'unit'			=> Session('previlage'),
								'tabel'			=> 'ALIHSTATUS'
							]);
							$cariiduser 		= User::where('previlage', $pejabat)->where('fakultas', $fakultas)->get();
							if (!empty($cariiduser)){
								foreach ($cariiduser as $rid){
									$idcaritoken	= $rid->id;
									$caritoken 		= Firebasebank::where('userid', $idcaritoken)->count();
									if ($caritoken != 0){
										$tuliskirim = Session('nama').' Tengah membuat konsep surat mohon dijadikan periksa';
										$jtokencari	= Firebasebank::where('userid', $idcaritoken)->get();
										foreach ( $jtokencari as $rtokencari ){
											$firebaseid = $rtokencari->firebase;
											$msg = array (
												'message' 	=> $tuliskirim,
												'title'		=> 'SCO',
												'subtitle'	=> 'Universitas Brawijaya',
												'tickerText'=> 'Mohon diperiksa',
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
												'Authorization: key=' . API_ACCESS_KP,
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
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Drafting surat siap di Paraf/ditandatangani']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => $sendstatus]);
							return back();
						}
					}
				} else {
					if ($ceksek->tembusan1 == 'Proses TTE'){
						$kerjanya 	= Suratkeluar::where('id', $ceksek->asal)->where('filelampiran', $ceksek->ket)->update([
							'perihal' 		=>  $titel,
							'isisurat' 		=>  $text,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $penandatangan,
							'namapejabat' 	=>  $setttd,
							'tembusan' 		=>  $ceksek->fakultas,
							'sifat' 		=>  '4',
							'klasifikasi' 	=>  'Biasa',
							'pembuat' 		=>  Session('nama'),
							'kelompok' 		=>  Session('previlage'),
							'status' 		=>  'NEW',
							'paraf1'		=> 	$paraf1,
							'paraf2'		=> 	$paraf2,
							'paraf3'		=> 	$paraf3,
							'paraf4'		=> 	$paraf4,
							'updated_at' 	=>  date("Y-m-d H:i:s")
						]);
						if ($kerjanya){
							$getdata 	= Suratkeluar::where('id', $ceksek->asal)->where('filelampiran', $ceksek->ket)->first();
							if (file_exists(public_path('scan/files/'.$getdata->marking.'.pdf'))){
								$file 	= 'scan/files/'.$getdata->marking.'.pdf';
								Storage::disk('local')->delete($file);
							}
							PDFCREATOR::setSignature($certificate, $certificate, $nip, '', 2, $info, 'A');
							PDFCREATOR::SetCreator('Smart and Collaborative Office');
							PDFCREATOR::SetAuthor(Session('nama'));
							PDFCREATOR::SetTitle($titel);
							PDFCREATOR::SetSubject($ceksek->nama);
							PDFCREATOR::SetKeywords($ceksek->nip);
							PDFCREATOR::setPrintHeader(false);
							PDFCREATOR::setPrintFooter(false);
							PDFCREATOR::SetMargins(5, 0, 5);
							PDFCREATOR::setFontSubsetting(true);
							PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
							PDFCREATOR::AddPage('P', $page_format, false, false);
							$bMargin = PDFCREATOR::getBreakMargin();
							$auto_page_break = PDFCREATOR::getAutoPageBreak();
							PDFCREATOR::SetAutoPageBreak(false, 0);
							$img_file = public_path('bgbssn.png');
							PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
							PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
							PDFCREATOR::setPageMark();
							PDFCREATOR::writeHTML($text, true, 0, true, 0);
							PDFCREATOR::setFooterMargin(0);
							$pdfdoc = PDFCREATOR::Output('', 'S');
							PDFCREATOR::reset();
							Storage::disk('local')->put('/scan/files/'.$getdata->marking.'.pdf', $pdfdoc);
							$file =  public_path('scan/files/'.$getdata->marking.'.pdf');
					
							Inboxsurat::where('marking', $getdata->marking)->where('jenis', 'KELUAR')->delete();
							$qnamapjbt	= Pejabatsurat::where('id', $paraf1)->first();
							$pejabat 	= $qnamapjbt->pejabat;
							Inboxsurat::insert([
								'marking'  		=> $getdata->marking,
								'pengirim'  	=> Session('nama'),
								'penerima'		=> $pejabat,
								'status'		=> 'send',
								'sifat'			=> 5,
								'jenis'			=> 'KELUAR',
								'kerja'			=> 'PARAF',
								'catatan'		=> '',
								'tandatangan'	=> '',
								'tanggal'		=> '1',
								'idsurat'		=> $getdata->id,
								'noagenda'		=> 0,
								'tglsurat'		=> date("Y-m-d"),
								'jenissrt'		=> 'UPLOAD',
								'nosurat'		=> $getdata->nomor.'/'.$getdata->kodefak.'/KP.09.05.1/'.$getdata->yersrt,
								'kepada'		=> '',
								'perihal'		=> $getdata->perihal,
								'alamat'		=> '',
								'lampiran'		=> '',
								'kodefak'		=> $getdata->kodefak,
								'klasifikasi'	=> 'Biasa',
								'pembuat'		=> Session('nama'),
								'unit'			=> Session('previlage'),
								'tabel'			=> 'ALIHSTATUS'
							]);
							$cariiduser 		= User::where('previlage', $pejabat)->where('fakultas', $fakultas)->get();
							if (!empty($cariiduser)){
								foreach ($cariiduser as $rid){
									$idcaritoken	= $rid->id;
									$caritoken 		= Firebasebank::where('userid', $idcaritoken)->count();
									if ($caritoken != 0){
										$tuliskirim = Session('nama').' Tengah membuat konsep surat mohon dijadikan periksa';
										$jtokencari	= Firebasebank::where('userid', $idcaritoken)->get();
										foreach ( $jtokencari as $rtokencari ){
											$firebaseid = $rtokencari->firebase;
											$msg = array (
												'message' 	=> $tuliskirim,
												'title'		=> 'SCO',
												'subtitle'	=> 'Universitas Brawijaya',
												'tickerText'=> 'Mohon diperiksa',
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
												'Authorization: key=' . API_ACCESS_KP,
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
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses with notice', 'message' => 'Drafting surat siap di Paraf/ditandatangani']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Update Gagal, Silahkan Coba Beberapa Saat Lagi']);
							return back();
						} 
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'Data Yang Sudah Di Tandatangani Tidak Bisa di Ubah Kembali, Untuk Merubah Data silahkan hapus pengajuan awal (Surat Keluar TTE) dan mengisi kembali dari awal']);
						return back();
					}
				}
			}
		} else if ($tugas == 'fileexcelalihstatus'){
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
				if(is_null($val['B']) OR $val['B'] == 'NAMA'){
					//
				} else {
					$ceksudah 	= Antrian::where('nim', $val['F'])->where('kodjenis', 'Alih Status')->count();
					if ($ceksudah == 0){
						$id	= Antrian::insertGetId([
							'jenis'         =>  $val['I'],
							'instansi'      =>  '',
							'alamat'        =>  '',
							'kota'          =>  '',
							'nama'          =>  $val['B'],
							'nim'           =>  $val['F'],
							'smt'           =>  $val['E'],
							'hape'          =>  $xx,
							'jurusan'       =>  $val['J'],
							'ps'       		=>  $xx,
							'judul'         =>  $val['V'],
							'dos1'          =>  $val['C'],
							'dos2'          =>  $val['D'],
							'golortu'       =>  $xx,
							'niportu'       =>  $xx,
							'jabortu'       =>  $xx,
							'tmpkrjortu'    =>  $xx,
							'tmplahir' 		=> 	$val['G'],
							'tgllahir' 		=> 	$val['H'],
							'bulan'         =>  '',
							'pada'         	=>  $xx,
							'whatfor'       =>  '',
							'kodjenis'      =>  'Alih Status',
							'aktife'        =>  'ARSIP',
							'nosurat'		=>	$val['K'],
							'tglsurat'		=>	$val['L'],
							'pejabat'		=> 	Session('jabatan'),
							'nmpejabat'		=> 	Session('nama'),
							'ket'			=> 	$marking,
							'tembusan1'     =>  '',
							'tembusan2'     =>  '',
							'tembusan3'     =>  '',
							'tembusan4'     =>  '',
							'tembusan5'     =>  'Tanpa Nomor',
							'fakultas'		=> 	Session('fakultas')
						]);
						if ($id){
							$nilai01	= $val['M'];
							$nilai02	= $val['N'];
							$nilai03	= $val['O'];
							$nilai04	= $val['P'];
							$nilai05	= $val['Q'];
							$nilai06	= $val['R'];
							$nilai07	= $val['S'];
							$nilai08	= $val['T'];
							$nilai09	= $val['U'];
							$idsurat	= $id;
							$new		= 0;
							$cek01 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai01')->count();
							if ($cek01 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai01',
									'nilai'		=> $nilai01
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai01')->update([
									'nilai'		=> $nilai01	
								]);
								$update++;
							}
							$cek02 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai02')->count();
							if ($cek02 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai02',
									'nilai'		=> $nilai02
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai02')->update([
									'nilai'		=> $nilai02
								]);
								$update++;
							}
							$cek03 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai03')->count();
							if ($cek03 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai03',
									'nilai'		=> $nilai03
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai03')->update([
									'nilai'		=> $nilai03
								]);
								$update++;
							}
							$cek04 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai04')->count();
							if ($cek04 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai04',
									'nilai'		=> $nilai04
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai04')->update([
									'nilai'		=> $nilai04
								]);
								$update++;
							}
							$cek05 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai05')->count();
							if ($cek05 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai05',
									'nilai'		=> $nilai05
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai05')->update([
									'nilai'		=> $nilai05
								]);
								$update++;
							}
							$cek06 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai06')->count();
							if ($cek06 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai06',
									'nilai'		=> $nilai06
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai06')->update([
									'nilai'		=> $nilai06
								]);
								$update++;
							}
							$cek07 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai07')->count();
							if ($cek07 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai07',
									'nilai'		=> $nilai07
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai07')->update([
									'nilai'		=> $nilai07
								]);
								$update++;
							}
							$cek08 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai08')->count();
							if ($cek08 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai08',
									'nilai'		=> $nilai08
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai08')->update([
									'nilai'		=> $nilai08
								]);
								$update++;
							}
							$cek09 		= Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai09')->count();
							if ($cek09 == 0){
								Detailnilujian::create([
									'idsurat'	=> $idsurat,
									'jenis'		=> 'nilai09',
									'nilai'		=> $nilai09
								]);
								$new++;
							} else {
								Detailnilujian::where('idsurat', $idsurat)->where('jenis', 'nilai09')->update([
									'nilai'		=> $nilai09
								]);
								$update++;
							}
							
						} else {
							$error = $error.'Data Gagal di Simpan an. '.$val['B'].' dengan Nomor NIK '.$val['F'].'<br />';
						}
					} else {
						$error = $error.'Data Sudah Ada an. '.$val['B'].' dengan Nomor NIK '.$val['F'].'<br />';
					}
				}
			}
			return response()->json(['icon' => 'warning', 'warna' => '#bf441d', 'status' => 'Info', 'message' => 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$error]);
			return back();
		} else if ($tugas == 'fileexcelbpjs'){
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
				if(is_null($val['B']) OR $val['B'] == 'NAMA'){
					//
				} else {
					$cekjabatan = $val['I'];
					if ($cekjabatan == 'Peserta'){
						$jabatan 	= $val['Z'];
						$tmtberlaku = $val['AA'];
						$kodepangkat= $val['AB'];
						$gajipokok	= $val['AC'];
						$sutri		= $val['AD'];
						$fungsional	= $val['AE'];
						$profesi	= $val['AF'];
						$kinerja	= $val['AG'];
					} else {
						$jabatan 	= 'Keluarga';
						$tmtberlaku = date("Y-m-d");
						$kodepangkat='';
						$gajipokok	= 0;
						$sutri		= 0;
						$fungsional	= 0;
						$profesi	= 0;
						$kinerja	= 0;
					}
					$cek 	= DataBPJS::where('nik', $val['B'])->count();
					if ($cek == 0){
						$input = DataBPJS::create([
							'status'		=> $val['B'],
							'jenis'			=> $val['C'],
							'nomorbpjs'		=> $val['D'],
							'bpjsket'		=> $val['E'],
							'nomorkk'		=> $val['F'],
							'nik'			=> $val['G'],
							'nama'			=> $val['H'],
							'hubungan'		=> $val['I'],
							'tempatlhr'		=> $val['J'],
							'tgllahir'		=> $val['K'],
							'kelamin'		=> $val['L'],
							'kawin'			=> $val['M'],
							'alamat'		=> $val['N'],
							'erte'			=> $val['O'],
							'erwe'			=> $val['P'],
							'kota'			=> $val['T'],
							'kodepos'		=> $val['Q'],
							'kecamatan'		=> $val['R'],
							'kelurahan'		=> $val['S'],
							'faskes'		=> $val['U'],
							'faksesgigi'	=> $val['V'],
							'nohape'		=> $val['W'],
							'email'			=> $val['X'],
							'nip'			=> $val['Y'],
							'jabatan'		=> $jabatan,
							'tmtberlaku'	=> $tmtberlaku,
							'kodepangkat'	=> $kodepangkat,
							'gajipokok'		=> $gajipokok,
							'sutri'			=> $sutri,
							'fungsional'	=> $fungsional,
							'profesi'		=> $profesi,
							'kinerja'		=> $kinerja,
							'nmsatker'		=> $val['AH'],
							'unitkerja'		=> $val['AI'],
						]);
					} else {
						$input = DataBPJS::where('nik', $nik)->update([
							'status'		=> $val['B'],
							'jenis'			=> $val['C'],
							'nomorbpjs'		=> $val['D'],
							'bpjsket'		=> $val['E'],
							'nomorkk'		=> $val['F'],
							'nik'			=> $val['G'],
							'nama'			=> $val['H'],
							'hubungan'		=> $val['I'],
							'tempatlhr'		=> $val['J'],
							'tgllahir'		=> $val['K'],
							'kelamin'		=> $val['L'],
							'kawin'			=> $val['M'],
							'alamat'		=> $val['N'],
							'erte'			=> $val['O'],
							'erwe'			=> $val['P'],
							'kota'			=> $val['T'],
							'kodepos'		=> $val['Q'],
							'kecamatan'		=> $val['R'],
							'kelurahan'		=> $val['S'],
							'faskes'		=> $val['U'],
							'faksesgigi'	=> $val['V'],
							'nohape'		=> $val['W'],
							'email'			=> $val['X'],
							'nip'			=> $val['Y'],
							'jabatan'		=> $jabatan,
							'tmtberlaku'	=> $tmtberlaku,
							'kodepangkat'	=> $kodepangkat,
							'gajipokok'		=> $gajipokok,
							'sutri'			=> $sutri,
							'fungsional'	=> $fungsional,
							'profesi'		=> $profesi,
							'kinerja'		=> $kinerja,
							'nmsatker'		=> $val['AH'],
							'unitkerja'		=> $val['AI'],
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					}
					if ($input){
						$sukses++;
					} else {
						$error = $error.'Data Gagal di Simpan an. '.$val['B'].' dengan Nomor NIK '.$val['F'].'<br />';
					}
				}
			}
			return response()->json(['icon' => 'warning', 'warna' => '#bf441d', 'status' => 'Info', 'message' => 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$error]);
			return back();
		} else if ($tugas == 'uploadpegawai'){
			$path 			= $_FILES['file']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$i 				= 0;
			$marking 		= date("y").'-'.Session('nim');
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			$arraysurat		= [];
			foreach($getalldata as $val){
				if(is_null($val['B']) OR $val['B'] == 'Nomor Kepegawaian' ){
					$arraysurat[] = array(
						'nama' 			=> $val['E'],
						'nip' 			=> $val['B'],
						'email' 		=> $val['U'],	
						'deskripsi' 	=> '<font color="red">Data Wajib Tidak Lengkap</font>',
					);
				} else {
					$nip_baru 		= $val['B'] != null ?$val['B'] : '';
					$kode 			= $val['C'] != null ?$val['C'] : '';
					$tmt_golongan 	= $val['D'] != null ?$val['D'] : '';
					$nama 			= $val['E'] != null ?$val['E'] : '';
					$depan 			= $val['F'] != null ?$val['F'] : '';
					$belakang 		= $val['G'] != null ?$val['G'] : '';
					$nokk 			= $val['H'] != null ?$val['H'] : '';
					$nik 			= $val['I'] != null ?$val['I'] : '';
					$tmpt_lahir 	= $val['J'] != null ?$val['J'] : '';
					$tgl_lahir 		= $val['K'] != null ?$val['K'] : date("Y-m-d");
					$jenis_kelamin 	= $val['L'] != null ?$val['L'] : '';
					$alamat 		= $val['M'] != null ?$val['M'] : '';
					$kelurahan 		= $val['N'] != null ?$val['N'] : '';
					$kecamatan 		= $val['O'] != null ?$val['O'] : '';
					$kota 			= $val['P'] != null ?$val['P'] : '';
					$provinsi 		= $val['Q'] != null ?$val['Q'] : '';
					$agama 			= $val['R'] != null ?$val['R'] : '';
					$kawin 			= $val['S'] != null ?$val['S'] : '';
					$no_hp 			= $val['T'] != null ?$val['T'] : '';
					$email 			= $val['U'] != null ?$val['U'] : time().'@'.Session('domainapps01');
					$jabatan 		= $val['V'] != null ?$val['V'] : '';
					$jenispeg 		= $val['W'] != null ?$val['W'] : '';
					$unitkerja 		= $val['X'] != null ?$val['X'] : '';
					$status_jabatan = $val['Y'] != null ?$val['Y'] : 'Kontrak';
					$status_pegawai = $val['Z'] != null ?$val['Z'] : '1';
					$str 			= $val['AA'] != null ?$val['AA'] : '';
					$sip 			= $val['AB'] != null ?$val['AB'] : '';
					$masaberlaku 	= $val['AC'] != null ?$val['AC'] : '';
					if ($depan == '' OR $depan == '-' OR $depan == null){
						if ($belakang == '' OR $belakang == '-' OR $belakang == null){
							$namal	= $nama;
						} else {
							$namal	= $nama.', '.$belakang;
						}
					} else {
						if ($belakang == '' OR $belakang == '-' OR $belakang == null){
							$namal	= $depan.' '.$nama;
						} else {
							$namal	= $depan.' '.$nama.', '.$belakang;
						}
					}
					$cekemail		= Simpegpegawai::where('email', $email)->orWhere('email_ub', $email)->count();
					if ($cekemail == 0){
						$ceknip 	= Simpegpegawai::where('nip_baru', $nip_baru)->count();
						if ($ceknip == 0){
							$idpegawai 	= Simpegpegawai::insertGetId([
								'idpeg'						=> '',
								'jenispeg'					=> $jenispeg,
								'fungsional'				=> '',
								'nik'						=> $nik,
								'nokk'						=> $nokk,
								'nama_lengkap'				=> $namal, 
								'nama'						=> $nama,
								'depan'						=> $depan, 
								'belakang'					=> $belakang,
								'depandinilai'				=> $depan,
								'belakangdinilai'			=> $belakang,
								'jenisnip'					=> 'NIK',
								'nip_lama'					=> '',
								'nip_baru'					=> $nip_baru, 
								'nidn'						=> '',
								'jenis_kelamin'				=> $jenis_kelamin,
								'tmpt_lahir'				=> $tmpt_lahir,
								'tgl_lahir'					=> $tgl_lahir,
								'usia'						=> '0',
								'pangkat'					=> '',
								'golongan'					=> '', 
								'namabank'					=> '', 
								'norek'						=> '', 
								'namapdrekening'			=> $nama,
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
								'npwp'						=> '',
								'statusnpwp'				=> $kawin,
								'status'					=> '1', 
								'keterangan'				=> 'Uploaded File', 
								'tmt_golongan'				=> $tmt_golongan,
								'tmt_fungsional'			=> $tmt_golongan, 
								'jab_fungsional'			=> $tmt_golongan,
								'tmt_pensiun'				=> '',
								'thn_pensiun'				=> '',
								'tmt_cpns'					=> '',
								'tmt_pns'					=> '',
								'thn_masuk'					=> '',
								'cpns'						=> $str,
								'pns'						=> $sip,
								'unit_kerja'				=> $unitkerja,
								'bidang_ilmu'				=> '',
								'lab'						=> '',
								'program_studi'				=> '',
								'sertifikasi'				=> '',
								'pend_akhir'				=> '',
								'ijasah_diakui'				=> '',
								'status_pegawai'			=> $status_pegawai, 
								'status_jabatan'			=> $status_jabatan,
								'masa_kerja'				=> '',
								'karpeg'					=> '',
								'agama'						=> $agama,
								'alamat'					=> $alamat,
								'no_hp'						=> $no_hp,
								'kode'						=> $kode,
								'foto'						=> '',
								'tmtgaji'					=> '',
								'tmtpangkat'				=> '',
								'ppabp'						=> Session('fakpanjang'), 
								'jabatan'					=> $jabatan,
								'proses_pangkat'			=> '',
								'angka_kredit'				=> '',
								'email_ub'					=> $email,
								'email'						=> $email,
								'lama_tubel'				=> '',
								'lama_kenaikan_pangkat'		=> '',
								'tmt_tubel'					=> ''
							]);
							if ($idpegawai){
								$cekdatalama 	= Detailpegawai::where('no', $idpegawai)->count();
								if ($cekdatalama == 0){
									Detailpegawai::create([
										'no'				=> $idpegawai, 
										'ktp'				=> $nik, 
										'gelardepan'		=> $depan, 
										'gelarblakang'		=> $belakang, 
										'gelardepan2'		=> $depan, 
										'gelarblakang2'		=> $belakang, 
										'bidangilmu'		=> '', 
										'alamatmlg'			=> $alamat, 
										'kelurahan'			=> $kelurahan, 
										'kecamatan'			=> $kecamatan, 
										'propinsi'			=> $provinsi, 
										'kota'				=> $kota, 
										'kawin'				=> $kawin, 
										'emailub'			=> $email, 
										'emaillain'			=> $email, 
										'skcpns'			=> $str, 
										'tmtcpns'			=> $masaberlaku, 
										'skpns'				=> $sip, 
										'tmtpns'			=> $masaberlaku, 
										'nira'				=> '', 
										'npwp'				=> '', 
										'bpjs'				=> '', 
										'tinggibdn'			=> 0, 
										'beratbdn'			=> 0, 
										'bentukrambut'		=> '', 
										'bentukmuka'		=> '', 
										'warnakulit'		=> '', 
										'cirikusus'			=> '', 
										'cacattubuh'		=> '', 
										'hobi'				=> '', 
										'nomoridi'			=> '', 
										'keanggotaanprofesi'=> '', 
										'nomorstr'			=> '', 
										'nomorsip1'			=> '', 
										'nomorsip2'			=> '', 
										'nomorsip3'			=> '', 
										'google'			=> '', 
										'shinta'			=> '', 
										'scopus'			=> '', 
										'orcid'				=> '', 
										'timestamp'			=> date('Y-m-d H:i')
									]);
								}
							}
							$arraysurat[] = array(
								'nip_baru' 			=> $nip_baru,
								'kode' 				=> $kode,
								'tmt_golongan' 		=> $tmt_golongan,
								'nama' 				=> $nama,
								'depan' 			=> $depan,
								'belakang' 			=> $belakang,
								'nokk' 				=> $nokk,
								'nik' 				=> $nik,
								'tmpt_lahir' 		=> $tmpt_lahir,
								'tgl_lahir' 		=> $tgl_lahir,
								'jenis_kelamin' 	=> $jenis_kelamin,
								'alamat' 			=> $alamat,
								'kelurahan' 		=> $kelurahan,
								'kecamatan' 		=> $kecamatan,
								'kota' 				=> $kota,
								'provinsi' 			=> $provinsi,
								'agama' 			=> $agama,
								'kawin' 			=> $kawin,
								'no_hp' 			=> $no_hp,
								'email' 			=> $email,
								'jabatan' 			=> $jabatan,
								'jenispeg' 			=> $jenispeg,
								'unitkerja' 		=> $unitkerja,
								'status_jabatan' 	=> $status_jabatan,
								'status_pegawai' 	=> $status_pegawai,
								'str' 				=> $str,
								'sip' 				=> $sip,
								'masaberlaku' 		=> $masaberlaku,
								'status' 			=> 'sukses',
								'keterangan' 		=> '<font color="green">Imported</font>',
							);
						} else {
							$arraysurat[] = array(
								'nip_baru' 			=> $nip_baru,
								'kode' 				=> $kode,
								'tmt_golongan' 		=> $tmt_golongan,
								'nama' 				=> $nama,
								'depan' 			=> $depan,
								'belakang' 			=> $belakang,
								'nokk' 				=> $nokk,
								'nik' 				=> $nik,
								'tmpt_lahir' 		=> $tmpt_lahir,
								'tgl_lahir' 		=> $tgl_lahir,
								'jenis_kelamin' 	=> $jenis_kelamin,
								'alamat' 			=> $alamat,
								'kelurahan' 		=> $kelurahan,
								'kecamatan' 		=> $kecamatan,
								'kota' 				=> $kota,
								'provinsi' 			=> $provinsi,
								'agama' 			=> $agama,
								'kawin' 			=> $kawin,
								'no_hp' 			=> $no_hp,
								'email' 			=> $email,
								'jabatan' 			=> $jabatan,
								'jenispeg' 			=> $jenispeg,
								'unitkerja' 		=> $unitkerja,
								'status_jabatan' 	=> $status_jabatan,
								'status_pegawai' 	=> $status_pegawai,
								'str' 				=> $str,
								'sip' 				=> $sip,
								'masaberlaku' 		=> $masaberlaku,
								'status' 			=> 'gagal',
								'keterangan' 		=> '<font color="red">Nomor Pegawai Terdeteksi Double</font>',
							);
						}
					} else {
						$arraysurat[] = array(
							'nip_baru' 			=> $nip_baru,
							'kode' 				=> $kode,
							'tmt_golongan' 		=> $tmt_golongan,
							'nama' 				=> $nama,
							'depan' 			=> $depan,
							'belakang' 			=> $belakang,
							'nokk' 				=> $nokk,
							'nik' 				=> $nik,
							'tmpt_lahir' 		=> $tmpt_lahir,
							'tgl_lahir' 		=> $tgl_lahir,
							'jenis_kelamin' 	=> $jenis_kelamin,
							'alamat' 			=> $alamat,
							'kelurahan' 		=> $kelurahan,
							'kecamatan' 		=> $kecamatan,
							'kota' 				=> $kota,
							'provinsi' 			=> $provinsi,
							'agama' 			=> $agama,
							'kawin' 			=> $kawin,
							'no_hp' 			=> $no_hp,
							'email' 			=> $email,
							'jabatan' 			=> $jabatan,
							'jenispeg' 			=> $jenispeg,
							'unitkerja' 		=> $unitkerja,
							'status_jabatan' 	=> $status_jabatan,
							'status_pegawai' 	=> $status_pegawai,
							'str' 				=> $str,
							'sip' 				=> $sip,
							'masaberlaku' 		=> $masaberlaku,
							'status' 			=> 'gagal',
							'keterangan' 		=> '<font color="red">Email Terdeteksi Double</font>',
						);
					}
				}
			}
			echo json_encode($arraysurat);
		} else {
			if ($request->hasFile('file')) {
				$output_file 	= '/scan/files/'. $marking.'.pdf';
				try {
					Storage::disk('local')->delete($output_file);
				} catch (\Exception $e) {
					
				}
				$request->file('file')->move(public_path('scan/files'), $marking.'.pdf');
				if (file_exists(public_path($output_file))){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'File Uploaded']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'File Tidak di Terupload']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error.!', 'message' => 'File Tidak di Pilih']);
				return back();
			}
		}
	}
	public function biodataDosen(Request $request) {
		$nopeg					= $request->input('val01');
		$hasil					= Dosen::where('id', $nopeg)->first();
		if (isset($hasil->nip)){
			$nip					= $hasil->nip;
			$data					= [];
			$foto 					= 'mascot.png';
			$mahasiswas1			= [];
			$mahasiswas2			= [];
			$mahasiswas3			= [];
			$getallmahasiswa 		= Biodata::where('bimbing1', $nopeg)->orwhere('bimbing2', $nopeg)->orwhere('bimbing3', $nopeg)->where('tglyudisium', '0000-00-00')->orderBy('nimmhs', 'ASC')->get();
			if(!empty($getallmahasiswa)){
				foreach($getallmahasiswa as $rmhs){
					$jenjang 	= $rmhs->jenjang;
					$nimmhs 	= $rmhs->nimmhs;
					$cekst 		= Antrian::where('kodjenis', 'Surat Tugas Komisi Pembimbing Skripsi')->where('nim', $nimmhs)->where('dos2', $nopeg)->orderBy('id', 'DESC')->first();
					if (isset($cekst->tglsurat)){
						$tglst 	= $cekst->tglsurat;
					} else { $tglst = ''; }
					if ($jenjang == 'Sarjana S1'){
						$mahasiswas1[] = array(
							'nama'		=> $rmhs->nama,
							'nim'		=> $rmhs->nimmhs,
							'jurusan'	=> $rmhs->jurusan,
							'pees'		=> $rmhs->pees,
							'tglst'		=> $tglst,
						);
					} else if ($jenjang == 'Magister S2'){
						$mahasiswas2[] = array(
							'nama'		=> $rmhs->nama,
							'nim'		=> $rmhs->nimmhs,
							'jurusan'	=> $rmhs->jurusan,
							'pees'		=> $rmhs->pees,
							'tglst'		=> $tglst,
						);
					} else {
						$mahasiswas3[] = array(
							'nama'		=> $rmhs->nama,
							'nim'		=> $rmhs->nimmhs,
							'jurusan'	=> $rmhs->jurusan,
							'pees'		=> $rmhs->pees,
							'tglst'		=> $tglst,
						);
					}
				}
			}
			$bimmagang				= [];
			$getallbimmagang 		= AntrianMagang::where('kodedosen', $nopeg)->whereNotIn('marking', ['arsip'])->get();
			if(!empty($getallbimmagang)){
				foreach($getallbimmagang as $rbimmagang){
					$bimmagang[] = array(
						'nama'		=> $rmhs->nama,
						'nim'		=> $rmhs->nim,
						'jurusan'	=> $rmhs->minat,
						'pees'		=> $rmhs->pees,
					);
				}
			}
			$data['nama']  			= $hasil->gelar;
			$data['nip'] 			= $hasil->nip;
			$data['pangkat']       	= $hasil->pangkat;
			$data['unit_kerja']    	= $hasil->unitkerja;
			$data['bidang_ilmu']   	= '';
			$data['program_studi'] 	= $hasil->unitkerja;
			$data['minat'] 			= '';
			$data['foto'] 			= $foto;
			$data['mahasiswas1'] 	= $mahasiswas1;
			$data['mahasiswas2'] 	= $mahasiswas2;
			$data['mahasiswas3'] 	= $mahasiswas3;
			$data['bimmagang'] 		= $bimmagang;
			return view('vokasi.cetak.kepegawaian.biodatadosen', $data);
		} else {
			echo 'ID Dosen '.$nopeg.' Tidak di Temukan, Silahkan Hubungi Admin Untuk Info Lebih Lanjut';
		}
	}
	public function exPejabatSK(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'val01' =>  'required',
			'val02' =>  'required',
			'val03' =>  'required',
        	'val05' =>  'required',
        	'val06' =>  'required',
        ]);
        if($validator->fails()) {
        	return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon data isian dilengkapi']);
			return back();
		} else {
			$fakultas		= Session('fakultas');
			$fakpanjang		= Session('fakpanjang');
			$nama_lengkap 	= $request->input('val01');
			$nama 			= $request->input('val02');
			$nip			= $request->input('val03');
			$pangkat 		= $request->input('val04');
			$kode 			= $request->input('val05');
			$pejabat 		= $request->input('val06');
			$penandatangan 	= $request->input('val07');
			$nomorsk 		= $request->input('val08');
			$idne 			= $request->input('val09');
			if ($pangkat == '' OR is_null($pangkat)){ $pangkat = 'Tidak Punya'; }
			$golongan 		= $pangkat;
			$update			= null;
			$nip			= preg_replace('/\s+/', '', $nip);
			if ($idne == 'hapusdata'){
				$idne 		= $request->input('val18');
				$update 	= Pejabatsurat::where('id', $idne)->update([
					'nama' 			=> '',
					'nip' 			=> '',
					'golongan' 		=> '',
					'pangkat' 		=> '',
					'updated_at' 	=> date("Y-m-d H:i:s"),
				]);
				if ($update){
					return response()->json(['status' => 'Success.!', 'message' => 'Pejabat Sukses di kosongkan']);
					return back();
				} else {
					return response()->json(['status' => 'Error.!', 'message' => 'Gagal Update, Mohon Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				$getdatapangkaat	= Golongan::where('kode', $pangkat)->first();
				if (isset($getdatapangkaat->id)){
					$pangkat		= $getdatapangkaat->pangkat;
					$golongan 		= $getdatapangkaat->golongan;
				}
				if ($idne == 'alldata'){
					$jabfung 		= $request->input('val10');
					$tglsk 			= $request->input('val11');
					$periode 		= $request->input('val12');
					$tglpelantikan 	= $request->input('val13');
					$awalberlaku 	= $request->input('val14');
					$akhirberlaku 	= $request->input('val15');
					$nomorfile 		= $request->input('val16');
					$keterangan 	= $request->input('val17');
					$idne 			= $request->input('val18');
					$email 			= $request->input('val19');
					$statmenjabat 	= $request->input('val20');
					$kerja			= 'ALL';
					if ($idne == 'new'){
						$cekkode 		= explode(".", $kode);
						if (isset($cekkode[1])){
							$kodecari 	= $cekkode[0].'.'.$cekkode[1];
						} else {
							$kodecari	= $kode;
						}
						$getfakpanjang = Pejabatsurat::where('kode', 'LIKE', $kodecari.'%')->first();
						if (isset($getfakpanjang->id)){
							$fakultas		= $getfakpanjang->fakultas;
							$fakreal		= $getfakpanjang->fakreal;
						} else {
							$fakreal		= 'OTHER';
						}
						if ($awalberlaku == '0000-00-00'){ $awalberlaku = ''; }
						if ($awalberlaku != ''){
							$tglberlaku = $awalberlaku.' '.date("H:i:s");
							$ceksek 	= explode("-", $awalberlaku);
							if (isset($ceksek[2])){
								$cekthn	= $ceksek[0];
								$cekbln	= $ceksek[1];
								$cektgl	= $ceksek[2];
							} else {
								$cekthn	= date("Y");
								$cekbln	= date("m");
								$cektgl	= date("d");
							}
							if ($akhirberlaku == ''){
								$akhirberlaku == 'Definitif';
							}
						}
						$ceksudah 		= Pejabatsurat::where('pejabat', $pejabat)->count();
						if ($ceksudah == 0){
							$update 		= Pejabatsurat::create([
								'pejabat' 		=> $pejabat,
								'kode' 			=> $kode,
								'nama' 			=> $nama_lengkap,
								'nip' 			=> $nip,
								'email' 		=> $email,
								'golongan' 		=> $golongan,
								'pangkat' 		=> $pangkat,
								'penandatangan' => $penandatangan,
								'nomersk' 		=> $nomorsk,
								'tglsk' 		=> $tglsk,
								'periode' 		=> $periode,
								'awalberlaku' 	=> $awalberlaku,
								'akhirberlaku' 	=> $akhirberlaku,
								'tglpelantikan'	=> $tglpelantikan,
								'nomorfile' 	=> $nomorfile,
								'keterangan' 	=> $keterangan,
								'created_at' 	=> date("Y-m-d H:i:s"),
								'statmenjabat'	=> $statmenjabat,
								'fakultas'		=> $fakultas,
								'fakreal'		=> $fakreal,
							]);
							$idne = $update->id;
						}
					}
				} else {
					$kerja 			= 'SEBAGIAN';
					$jabfung		= '';
					$email			= '';
					$statmenjabat	= '';
				}
				$getdatalama 		= Pejabatsurat::where('id', $idne)->first();
				$pejabatlama		= $getdatalama->pejabat;
				$tglberlaku			= $getdatalama->created_at;
				$golongan			= $pangkat;	
				
				if ($kerja == 'ALL'){
					if ($awalberlaku == '0000-00-00'){ $awalberlaku = ''; }
					if ($awalberlaku != ''){
						$tglberlaku = $awalberlaku.' '.date("H:i:s");
						$ceksek 	= explode("-", $awalberlaku);
						if (isset($ceksek[2])){
							$cekthn	= $ceksek[0];
							$cekbln	= $ceksek[1];
							$cektgl	= $ceksek[2];
						} else {
							$cekthn	= date("Y");
							$cekbln	= date("m");
							$cektgl	= date("d");
						}
						if ($akhirberlaku == ''){
							$akhirberlaku == 'Definitif';
						}
					}
					$ceksudah 		= Pejabatsurat::where('id', '!=', $idne)->where('pejabat', $pejabat)->count();
					if ($ceksudah == 0){
						$update 		= Pejabatsurat::where('id', $idne)->update([
							'pejabat' 		=> $pejabat,
							'kode' 			=> $kode,
							'nama' 			=> $nama_lengkap,
							'nip' 			=> $nip,
							'email' 		=> $email,
							'golongan' 		=> $golongan,
							'pangkat' 		=> $pangkat,
							'penandatangan' => $penandatangan,
							'nomersk' 		=> $nomorsk,
							'tglsk' 		=> $tglsk,
							'periode' 		=> $periode,
							'awalberlaku' 	=> $awalberlaku,
							'akhirberlaku' 	=> $akhirberlaku,
							'tglpelantikan'	=> $tglpelantikan,
							'nomorfile' 	=> $nomorfile,
							'keterangan' 	=> $keterangan,
							'created_at' 	=> $tglberlaku,
							'statmenjabat'	=> $statmenjabat,
							'updated_at' 	=> date("Y-m-d H:i:s"),
						]);
					}
				} else {
					$ceksudah 		= Pejabatsurat::where('id', '!=', $idne)->where('pejabat', $pejabat)->count();
					if ($ceksudah == 0){
						$update 		= Pejabatsurat::where('id', $idne)->update([
							'pejabat' 		=> $pejabat,
							'kode' 			=> $kode,
							'nama' 			=> $nama_lengkap,
							'nip' 			=> $nip,
							'golongan' 		=> $golongan,
							'pangkat' 		=> $pangkat,
							'penandatangan' => $penandatangan,
							'nomersk' 		=> $nomorsk,
							'updated_at' 	=> date("Y-m-d H:i:s"),
						]);
					}
				}
				if ($update){
					$getfakpanjang = User::where('fakultas', $getdatalama->fakultas)->where('fakpanjang', '!=', '')->first();
					if (isset($getfakpanjang->fakpanjang)){
						$fakpanjang = $getfakpanjang->fakpanjang;
					} else { $fakpanjang = Session('fakpanjang'); }
					$cekdata	= Simpegpegawai::where('nip_baru', $nip)->count();
					if ($cekdata == 0){
						$inputpeg = Simpegpegawai::create([
							'idpeg'						=> 0,
							'jenispeg'					=> '', 
							'fungsional'				=> '', 
							'nik'						=> '', 
							'nokk'						=> '', 
							'nama_lengkap'				=> $nama_lengkap, 
							'nama'						=> $nama, 
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
							'keterangan'				=> 'Created from SCO', 
							'tmt_golongan'				=> '', 
							'jab_fungsional'			=> $jabfung, 
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
							'status_pegawai'			=> 'Aktif', 
							'masa_kerja'				=> '', 
							'pns'						=> '', 
							'status_jabatan'			=> '', 
							'karpeg'					=> '', 
							'agama'						=> '', 
							'alamat'					=> '', 
							'no_hp'						=> '', 
							'kode'						=> '', 
							'foto'						=> '', 
							'tmtgaji'					=> '', 
							'tmtpangkat'				=> '', 
							'ppabp'						=> $fakpanjang,
							'jabatan'					=> $pejabat, 
							'proses_pangkat'			=> '', 
							'angka_kredit'				=> '', 
							'email_ub'					=> $email, 
							'lama_tubel'				=> '', 
							'lama_kenaikan_pangkat'		=> '', 
							'tmt_tubel'					=> ''
						]);
						$idpeg		= $inputpeg->id;
					} else {
						$cekdata	= Simpegpegawai::where('nip_baru', $nip)->first();
						$idpeg		= $cekdata->id;
						if ($email == '' OR is_null($email)){
							$email	= $cekdata->email_ub;
						}
						Simpegpegawai::where('id', $idpeg)->update([
							'nama'			=> $nama,
							'nama_lengkap'	=> $nama_lengkap,
							'nip_baru'		=> $nip,
							'golongan'		=> $golongan,
							'pangkat'		=> $pangkat,
							'jabatan'		=> $pejabat,
							'jab_fungsional'=> $jabfung,
							'email_ub'		=> $email,
							'ppabp'			=> $fakpanjang
						]);
					}
					$ceksudah 		= User::where('email', $email)->count();
					if ($ceksudah == 0){
						User::create([
							'nama'      => $nama_lengkap,
							'username'  => $nip,
							'email'     => $email,
							'nip'     	=> $idpeg,
							'nik'     	=> 0,
							'firebaseid'=> '',
							'password'  => bcrypt(time()),
							'fakultas'  => $fakultas,
							'fakpanjang'=> $fakpanjang,
							'previlage' => $pejabat,
							'merangkap' => '',
							'status'	=> 0,
							'id_sekolah'=> null
						]);
					} else {
						User::where('email', $email)->update([
							'nama'      => $nama_lengkap,
							'nip'     	=> $idpeg,
							'fakultas'  => $fakultas,
							'fakpanjang'=> $fakpanjang,
							'previlage' => $pejabat,
						]);
					}
					if ($penandatangan != '' AND $nomorsk != ''){
						Detailidentitas::create([
							'no'		=> $idpeg,
							'aktif'		=> '',
							'jenisid'	=> $pejabat,
							'nomer'		=> $penandatangan.' Nomor '.$nomorsk,
							'bukti'		=> '',
						]);
					}
					User::where('previlage', $pejabatlama)->update([
						'previlage' 	=> '('.$pejabatlama.')',
					]);
					User::where('merangkap', $pejabatlama)->update([
						'merangkap' 	=> null,
					]);
					Firebasebank::where('jabatan', $pejabatlama)->update([
						'jabatan' 	=> 	'('.$pejabatlama.')',
					]);
					if ($pejabat != $pejabatlama){
						Inboxsurat::where('penerima', $pejabatlama)->update([
							'penerima' 	=> 	$pejabat
						]);
						Inboxsurat::where('pengirim', $pejabatlama)->update([
							'pengirim' 	=> 	$pejabat
						]);
						Tujuandisposisi::where('kelompok', $pejabatlama)->update([
							'kelompok' 	=> 	$pejabat
						]);
						$nmlengkap	= Session('nama');
						$kelakuan 	= 'Ubah Seluruh Data Kelompok dari '.$pejabatlama.' Menjadi. '.$pejabat;
						Histories::insert([
							'siapa'		=> $nmlengkap,
							'kelakuan'	=> $kelakuan
						]);
					}
					if ($idpeg != 0){
						$getdatabyidpeg = User::where('nip', $idpeg)->get();
						if (!empty($getdatabyidpeg)){
							foreach ($getdatabyidpeg as $rows){
								User::where('id', $rows->id)->update([
									'nama' 		=> $nama_lengkap,
									'previlage' => $pejabat,
									'fakultas'  => $getdatalama->fakultas,
									'fakpanjang'=> $fakpanjang
								]);
								Firebasebank::where('userid', $rows->id)->update([
									'jabatan' 	=> 	$pejabat,
								]);
								
							}
						}
					}
					$ceksek = explode("@", $email);
					if (isset($ceksek[1])){
						$getdatabyemail = User::where('username', $email)->orWhere('email', $email)->get();
						if (!empty($getdatabyemail)){
							foreach ($getdatabyemail as $rows){
								User::where('id', $rows->id)->update([
									'nama' 		=> $nama_lengkap,
									'email' 	=> $email,
									'nip'		=> $idpeg,
									'golongan'	=> $golongan,
									'previlage' => $pejabat,
									'fakultas'  => $getdatalama->fakultas,
									'fakpanjang'=> $fakpanjang
								]);
								Firebasebank::where('userid', $rows->id)->update([
									'jabatan' 	=> 	$pejabat,
								]);
								
							}
						}
						$nippjbt 				= md5($email);
						$ceksertifikatpribadi 	= $nippjbt.'.crt';
						if (file_exists(public_path('tte/'.$ceksertifikatpribadi))){
							$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
						} else {
							$dn = array(
								"countryName" 			=> "IN",
								"stateOrProvinceName" 	=> "East Java Indonesia",
								"localityName" 			=> Session('kota01'),
								"organizationName" 		=> Session('fakultas'),
								"organizationalUnitName"=> Session('fakpanjang'),
								"commonName" 			=> $nama,
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
							file_put_contents(base_path()."/public/tte/".$nippjbt.".crt", $pkeyout);
							file_put_contents(base_path()."/public/tte/".$nippjbt.".crt", $certout, FILE_APPEND | LOCK_EX);
						}
					}
					return response()->json(['status' => 'Success.!', 'message' => 'Ubah Pejabat an. '.$nama_lengkap.' Dengan Jabatan '.$pejabat.' Sukses..!']);
					return back();
				} else {
					return response()->json(['status' => 'Error.!', 'message' => 'Gagal Update, Mohon Ulangi Beberapa Saat Lagi']);
					return back();
				}
			}
        }
	}
	public function viewEws() {
		$i 			= 0;
		$fakultas	= Session('fakultas');
		$mkelompok	= Session('previlage');
		$data		= [];

		$units		= Tblemailkepegkeu::where('id', '!=', '1')->get();
		$golongans	= Golongan::all();
		$allpeg		= Simpegpegawai::all();
		$pejabats	= Pejabatsurat::where('kode', '!=', '')->where('fakultas', 'LIKE', '%'.Session('fakultas').'%')->groupBy('kode')->orderBy('id')->get();
		
		$iduser						= Session('id');
		$cceknip					= User::where('id', $iduser)->count();
		if ($cceknip != 0){
			$ceknip					= User::where('id', $iduser)->first();
			$idpeg					= $ceknip->nip;
		} else { $idpeg = 0; }
		$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
		
		$data['sebulan']      		= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '<=', Carbon::now()->subDays(30)->toDateTimeString())->where('fakreal', Session('fakultas'))->count();
		$data['tigabulan']      	= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '<=', Carbon::now()->subDays(90)->toDateTimeString())->where('fakreal', Session('fakultas'))->count();
		$data['enambulan']      	= Pejabatsurat::where('akhirberlaku', 'LIKE', '%-%')->where('akhirberlaku', '<=', Carbon::now()->subDays(180)->toDateTimeString())->where('fakreal', Session('fakultas'))->count();
		$data['countmailbox']      	= $countmailbox;
		$data['nmpeg']      		= Session('nama');
		$data['tahunini']      		= date("Y");
		$data['arrallpeg']      	= $allpeg;
		$data['golongans']      	= $golongans;
		$data['jabfungs']      		= Draftsk::where('jabatanpeg', '!=', '')->groupBy('jabatanpeg')->orderBy('jabatanpeg', 'ASC')->get();
		$data['units']      		= $units;
		$data['pejabats']   		= $pejabats;
		$data['sidebar']			= 'ewsub';
		if (Session('previlage') == 'PEJABAT' AND Session('idjabatan') != 833){
			return view('dokar.ewsubpejabat', $data);
		} else {
			return view('dokar.ewsub', $data);
		}
	}
	public function cekUserOther(Request $request){
        $token  = $request->bearerToken();
        $user   = User::where('api_token', $token)->first();
        if (isset($user->id)){
            $email 		= $request->input('email') != null ? $request->input('email') : 'noone@local.host';
            $password 	= $request->input('password') != null ? $request->input('password') : 'none';
            $user 		= User::where('email', $email)->first();
        	if ($user) {
				if (!Hash::check($password, $user->password)) {
					$response = [
						'message'       => 'Password yang dimasukkan salah',
						'status'        => 'GAGAL',
						'data'          => []
					];
					return response()->json($response, 500);
				} else {
					$response = [
						'message'       => 'Sukses',
						'status'        => 'Sukses',
						'data'          => $user
					];
					return response()->json($response, 200);
				}
			} else {
				$response = [
					'message'       => 'Email Tidak di Temukan',
					'status'        => 'GAGAL',
					'data'          => []
				];
				return response()->json($response, 500);
			}
        } else {
            $response = [
                'message'       => 'Token Invalid',
                'status'        => 'GAGAL',
                'data'          => []
            ];
            return response()->json($response, 500);
        }
    }
	public function getAllPegMlg(Request $request){
        $token  = $request->bearerToken();
        $user   = User::where('api_token', $token)->first();
        if (isset($user->id)){
            $sql = Simpegpegawai::whereIn('ppabp', ['PT Disa Prima Medika', 'RS Prima Husada Malang'])->whereIn('status_pegawai', ['1', 'Aktif'])->get();
        	if (!empty($sql)) {
				$response = [
					'message'       => 'Sukses',
					'status'        => 'Sukses',
					'data'          => $sql
				];
				return response()->json($response, 200);
			} else {
				$response = [
					'message'       => 'Empty Data',
					'status'        => 'GAGAL',
					'data'          => []
				];
				return response()->json($response, 500);
			}
        } else {
            $response = [
                'message'       => 'Token Invalid',
                'status'        => 'GAGAL',
                'data'          => []
            ];
            return response()->json($response, 500);
        }
    }
	public function getAllPegSkr(Request $request){
        $token  = $request->bearerToken();
        $user   = User::where('api_token', $token)->first();
        if (isset($user->id)){
            $sql = Simpegpegawai::where('ppabp', 'RS Prima Husada Sukorejo')->whereIn('status_pegawai', ['1', 'Aktif'])->get();
        	if (!empty($sql)) {
				$response = [
					'message'       => 'Sukses',
					'status'        => 'Sukses',
					'data'          => $sql
				];
				return response()->json($response, 200);
			} else {
				$response = [
					'message'       => 'Empty Data',
					'status'        => 'GAGAL',
					'data'          => []
				];
				return response()->json($response, 500);
			}
        } else {
            $response = [
                'message'       => 'Token Invalid',
                'status'        => 'GAGAL',
                'data'          => []
            ];
            return response()->json($response, 500);
        }
    }
	public function exKirimJadwal(Request $request){
        $token  	= $request->bearerToken();
		$homebase	= url("/");
        $user   	= User::where('api_token', $token)->first();
        if (isset($user->id)){
			DB::table('logapi')->insert([
				'jsonkode'	=> json_encode(dump($request->input()))
			]);
			if ($request->input('paraf1') !== null){
				$paraf1 	= $request->input('paraf1');
			} else {
				$paraf1 	= '';
			}
			if ($request->input('paraf2') !== null){
				$paraf2 	= $request->input('paraf2');
			} else {
				$paraf2 	= '';
			}
			if ($request->input('paraf3') !== null){
				$paraf3 	= $request->input('paraf3');
			} else {
				$paraf3 	= '';
			}
			if ($request->input('paraf4') !== null){
				$paraf4 	= $request->input('paraf4');
			} else {
				$paraf4 	= '';
			}
			if ($request->input('range') !== null){
				$range 	= $request->input('range');
			} else {
				$range 	= '';
			}
			if ($request->input('email') !== null){
				$email 	= $request->input('email');
			} else {
				$email 	= 'sistem@disaprimamedika.site';
			}
			if ($request->input('datarekap') !== null){
				$datarekap 	= $request->input('datarekap');
			} else {
				$datarekap 	= [];
			}
			if ($request->input('datadetail') !== null){
				$datadetail 	= $request->input('datadetail');
			} else {
				$datadetail 	= [];
			}
			if ($range != ''){
				$getakhr 	= explode(' s/d ', $range);
				$mulai 		= $getakhr[0];
				$akhir 		= $getakhr[1];
				$ceksudah 	= AreaKerja::where('penulisan', $range)->count();
				if ($ceksudah == 0){
					AreaKerja::create([
						'mulai'			=> $mulai,
						'akhir'			=> $akhir,
						'penulisan'		=> $range,
						'created_by'	=> $email,
					]);
				}
			}
			$pengirim		= $email;
			$getfakultas 	= User::where('email', $email)->first();
			if (isset($getfakultas->fakultas)){
				$fakultas 	= $getfakultas->fakultas;
			} else {
				$fakultas 	= 'UNK';
			}
			$datadetail 	= json_decode($datadetail, true);
			if (!empty($datadetail)){
				foreach($datadetail as $rows){
					$pengirim= $rows['created_by'];
					$cekdulu = JadwalPiket::where('pin', $rows['pin'])->where('rangepresensi', $rows['rangepresensi'])->where('nama', $rows['nama'])->count();
					if ($cekdulu == 0){
						JadwalPiket::create([
							'pin'			=> $rows['pin'] != null ? $rows['pin'] : '-',
							'nama'			=> $rows['nama'] != null ? $rows['nama'] : '-',
							'tanggal'		=> $rows['tanggal'] != null ? $rows['tanggal'] : '0000-00-00',
							'rangepresensi'	=> $rows['rangepresensi'] != null ? $rows['rangepresensi'] : $range,
							'unit'			=> $rows['unit'] != null ? $rows['unit'] : '-',
							'jabatan'		=> $rows['jabatan'] != null ? $rows['jabatan'] : '-',
							'shift'			=> $rows['shift'] != null ? $rows['shift'] : '-',
							'mulaikerja'	=> $rows['mulaikerja'] != null ? $rows['mulaikerja'] : '0000-00-00',
							'akhirkerja'	=> $rows['akhirkerja'] != null ? $rows['akhirkerja'] : '0000-00-00',
							'presensimulai'	=> $rows['presensimulai'] != null ? $rows['presensimulai'] : '0000-00-00 00:00:00',
							'presensiakhir'	=> $rows['presensiakhir'] != null ? $rows['presensiakhir'] : '0000-00-00 00:00:00',
							'created_by'	=> $rows['created_by'] != null ? $rows['created_by'] :$email,
							'updated_by'	=> $rows['updated_by'] != null ? $rows['updated_by'] : $email,
							'fakultas'		=> $fakultas
						]);
					} else {
						JadwalPiket::where('pin', $rows['pin'])->where('rangepresensi', $rows['rangepresensi'])->where('nama', $rows['nama'])->update([
							'tanggal'		=> $rows['tanggal'] != null ? $rows['tanggal'] : '0000-00-00',
							'unit'			=> $rows['unit'] != null ? $rows['unit'] : '-',
							'jabatan'		=> $rows['jabatan'] != null ? $rows['jabatan'] : '-',
							'shift'			=> $rows['shift'] != null ? $rows['shift'] : '-',
							'mulaikerja'	=> $rows['mulaikerja'] != null ? $rows['mulaikerja'] : '0000-00-00',
							'akhirkerja'	=> $rows['akhirkerja'] != null ? $rows['akhirkerja'] : '0000-00-00',
							'presensimulai'	=> $rows['presensimulai'] != null ? $rows['presensimulai'] : '0000-00-00 00:00:00',
							'presensiakhir'	=> $rows['presensiakhir'] != null ? $rows['presensiakhir'] : '0000-00-00 00:00:00',
							'created_by'	=> $rows['created_by'] != null ? $rows['created_by'] :$email,
							'updated_by'	=> $rows['updated_by'] != null ? $rows['updated_by'] : $email,
							'fakultas'		=> $fakultas
						]);
					}
				}
			}
			$datarekap 		= json_decode($datarekap, true);
			if (!empty($datarekap)){
				foreach($datarekap as $rows){
					$cekdulu = RekapPresensi::where('pin', $rows['pin'])->where('rangepresensi', $rows['rangepresensi'])->where('nama', $rows['nama'])->count();
					if ($cekdulu == 0){
						RekapPresensi::insertGetId([
							'pin'				=> $rows['pin'] != null ? $rows['pin'] : '-',
							'nama'				=> $rows['nama'] != null ? $rows['nama'] : '-',
							'unit'				=> $rows['unit'] != null ? $rows['unit'] : '-',
							'jabatan'			=> $rows['jabatan'] != null ? $rows['jabatan'] : '-',
							'rangepresensi'		=> $rows['rangepresensi'] != null ? $rows['rangepresensi'] : $range,
							'day01'				=> $rows['day01'] != null ? $rows['day01'] : '',
							'day02'				=> $rows['day02'] != null ? $rows['day02'] : '',
							'day03'				=> $rows['day03'] != null ? $rows['day03'] : '',
							'day04'				=> $rows['day04'] != null ? $rows['day04'] : '',
							'day05'				=> $rows['day05'] != null ? $rows['day05'] : '',
							'day06'				=> $rows['day06'] != null ? $rows['day06'] : '',
							'day07'				=> $rows['day07'] != null ? $rows['day07'] : '',
							'day08'				=> $rows['day08'] != null ? $rows['day08'] : '',
							'day09'				=> $rows['day09'] != null ? $rows['day09'] : '',
							'day10'				=> $rows['day10'] != null ? $rows['day10'] : '',
							'day11'				=> $rows['day11'] != null ? $rows['day11'] : '',
							'day12'				=> $rows['day12'] != null ? $rows['day12'] : '',
							'day13'				=> $rows['day13'] != null ? $rows['day13'] : '',
							'day14'				=> $rows['day14'] != null ? $rows['day14'] : '',
							'day15'				=> $rows['day15'] != null ? $rows['day15'] : '',
							'day16'				=> $rows['day16'] != null ? $rows['day16'] : '',
							'day17'				=> $rows['day17'] != null ? $rows['day17'] : '',
							'day18'				=> $rows['day18'] != null ? $rows['day18'] : '',
							'day19'				=> $rows['day19'] != null ? $rows['day19'] : '',
							'day20'				=> $rows['day20'] != null ? $rows['day20'] : '',
							'day21'				=> $rows['day21'] != null ? $rows['day21'] : '',
							'day22'				=> $rows['day22'] != null ? $rows['day22'] : '',
							'day23'				=> $rows['day23'] != null ? $rows['day23'] : '',
							'day24'				=> $rows['day24'] != null ? $rows['day24'] : '',
							'day25'				=> $rows['day25'] != null ? $rows['day25'] : '',
							'day26'				=> $rows['day26'] != null ? $rows['day26'] : '',
							'day27'				=> $rows['day27'] != null ? $rows['day27'] : '',
							'day28'				=> $rows['day28'] != null ? $rows['day28'] : '',
							'day29'				=> $rows['day29'] != null ? $rows['day29'] : '',
							'day30'				=> $rows['day30'] != null ? $rows['day30'] : '',
							'day31'				=> $rows['day31'] != null ? $rows['day31'] : '',
							'day32'				=> $rows['day32'] != null ? $rows['day32'] : '',
							'day33'				=> $rows['day33'] != null ? $rows['day33'] : '',
							'day34'				=> $rows['day34'] != null ? $rows['day34'] : '',
							'day35'				=> $rows['day35'] != null ? $rows['day35'] : '',
							'fakultas'			=> $fakultas,
							'created_by'		=> $rows['created_by'] != null ? $rows['created_by'] : $email,
						]);
					} else {
						RekapPresensi::where('pin', $rows['pin'])->where('rangepresensi', $rows['rangepresensi'])->where('nama', $rows['nama'])->update([
							'unit'				=> $rows['unit'] != null ? $rows['unit'] : '-',
							'jabatan'			=> $rows['jabatan'] != null ? $rows['jabatan'] : '-',
							'day01'				=> $rows['day01'] != null ? $rows['day01'] : '',
							'day02'				=> $rows['day02'] != null ? $rows['day02'] : '',
							'day03'				=> $rows['day03'] != null ? $rows['day03'] : '',
							'day04'				=> $rows['day04'] != null ? $rows['day04'] : '',
							'day05'				=> $rows['day05'] != null ? $rows['day05'] : '',
							'day06'				=> $rows['day06'] != null ? $rows['day06'] : '',
							'day07'				=> $rows['day07'] != null ? $rows['day07'] : '',
							'day08'				=> $rows['day08'] != null ? $rows['day08'] : '',
							'day09'				=> $rows['day09'] != null ? $rows['day09'] : '',
							'day10'				=> $rows['day10'] != null ? $rows['day10'] : '',
							'day11'				=> $rows['day11'] != null ? $rows['day11'] : '',
							'day12'				=> $rows['day12'] != null ? $rows['day12'] : '',
							'day13'				=> $rows['day13'] != null ? $rows['day13'] : '',
							'day14'				=> $rows['day14'] != null ? $rows['day14'] : '',
							'day15'				=> $rows['day15'] != null ? $rows['day15'] : '',
							'day16'				=> $rows['day16'] != null ? $rows['day16'] : '',
							'day17'				=> $rows['day17'] != null ? $rows['day17'] : '',
							'day18'				=> $rows['day18'] != null ? $rows['day18'] : '',
							'day19'				=> $rows['day19'] != null ? $rows['day19'] : '',
							'day20'				=> $rows['day20'] != null ? $rows['day20'] : '',
							'day21'				=> $rows['day21'] != null ? $rows['day21'] : '',
							'day22'				=> $rows['day22'] != null ? $rows['day22'] : '',
							'day23'				=> $rows['day23'] != null ? $rows['day23'] : '',
							'day24'				=> $rows['day24'] != null ? $rows['day24'] : '',
							'day25'				=> $rows['day25'] != null ? $rows['day25'] : '',
							'day26'				=> $rows['day26'] != null ? $rows['day26'] : '',
							'day27'				=> $rows['day27'] != null ? $rows['day27'] : '',
							'day28'				=> $rows['day28'] != null ? $rows['day28'] : '',
							'day29'				=> $rows['day29'] != null ? $rows['day29'] : '',
							'day30'				=> $rows['day30'] != null ? $rows['day30'] : '',
							'day31'				=> $rows['day31'] != null ? $rows['day31'] : '',
							'day32'				=> $rows['day32'] != null ? $rows['day32'] : '',
							'day33'				=> $rows['day33'] != null ? $rows['day33'] : '',
							'day34'				=> $rows['day34'] != null ? $rows['day34'] : '',
							'day35'				=> $rows['day35'] != null ? $rows['day35'] : '',
							'fakultas'			=> $fakultas,
							'created_by'		=> $rows['created_by'] != null ? $rows['created_by'] : $email,
						]);
					}
				}
			}
			$marking 		= md5($email.'-'.$range);
			$ceksudah 		= Suratkeluartnpnomor::where('marking', $marking)->count();
			if ($ceksudah == 0){
				$getpejabat		= Pejabatsurat::where('id', $paraf4)->first();
				if (isset($getpejabat->id)){
					$kodepjbt		= $getpejabat->kode;
					$penandatangan	= $getpejabat->pejabat;
					$setttd			= $getpejabat->nama;
					$fakultas		= $getpejabat->fakultas;
				} else {
					$kodepjbt		= '0';
					$penandatangan	= '-';
					$setttd			= '-';
					$fakultas 		= 'DPM';
				}
				$input 			= Suratkeluartnpnomor::create([
					'marking' 		=>  $marking,
					'jenissrt' 		=>  'Jadwal Sif',
					'kodefak' 		=>  $kodepjbt,
					'unit' 			=>  'KP',
					'tglbuat' 		=>  date('Y-m-d'),
					'yersrt' 		=>  date('Y'),
					'dasarsurat' 	=>  '',
					'kepada' 		=>  $setttd,
					'alamat' 		=>  $email,
					'perihal' 		=>  'Jadwal Sif periode '.$range,
					'lampiran' 		=>  '-',
					'isisurat' 		=>  $range,
					'idpejabat' 	=>  $paraf4,
					'pejabat' 		=>  $penandatangan,
					'namapejabat' 	=>  $setttd,
					'tembusan' 		=>  '',
					'sifat' 		=>  'Biasa',
					'klasifikasi' 	=>  'Biasa',
					'pembuat' 		=>  $email,
					'kelompok' 		=>  'Siapiket',
					'status' 		=>  'NEW',
					'arsip' 		=>  '',
					'footnote' 		=>  '',
					'tandatangan' 	=>  '',
					'paraf1' 		=>  $paraf1,
					'paraf2' 		=>  $paraf2,
					'paraf3' 		=>  $paraf3,
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
					'fakultas' 		=>  $fakultas,
				]);
				if ($input){
					$getemail 	= Pejabatsurat::where('id', $paraf1)->first();
					if (isset($getemail->id)){
						$penandatangan = $getemail->pejabat;
						SendMail::kiriminbox($marking,$pengirim,$getemail->pejabat,$getemail->email,'KELUARNONOMER','PARAF','','1');
					}
					$pesan = 'Surat Jadwal Sif Sukses di Antrikan ke '.$penandatangan.' Untuk di Periksa<br />Tracking Paraf / TTE Bisa di cek di laman :<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$homebase.'/trackingid/srtklr-'.$marking.'" target="_blank">VIEW SURAT</a></div></p>';
				} else {
					$pesan = 'Surat Jadwal Sif Gagal di Kirim ke Pemeriksa I<br />Tracking Paraf / TTE Bisa di cek di laman :<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$homebase.'/trackingid/srtklr-'.$marking.'" target="_blank">VIEW SURAT</a></div></p>';
				}
			} else {
				$pesan = 'Surat Jadwal Sif periode '.$range.' Sudah Terkirim sebelumnya<br />Tracking Paraf / TTE Bisa di cek di laman :<p><div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$homebase.'/trackingid/srtklr-'.$marking.'" target="_blank">VIEW SURAT</a></div></p>';
			}
			SendMail::notif('Inputor Data SIAPIKET', $email, 'Status Pengiriman Jadwal', $pesan);
			$response 	= [
                'message'       => $pesan,
                'status'        => 'Suksess',
                'data'          => []
            ];
			
            return response()->json($response, 200);
        } else {
            $response = [
                'message'       => 'Token Invalid',
                'status'        => 'GAGAL',
                'data'          => []
            ];
            return response()->json($response, 500);
        }
    }
    public function exAutoSaveSIAPIKET(Request $request){
        $token  	= $request->bearerToken();
		$homebase	= url("/");
		$i          = 0;
        $user   	= User::where('api_token', $token)->first();
        if (isset($user->id)){
			if ($request->input('datadetail') !== null){
				$datadetail = $request->input('datadetail');
			} else {
				$datadetail = [];
			}
			if ($request->input('email') !== null){
				$fakultas = $request->input('email');
			} else {
				$fakultas = '';
			}
			$email 			= 'sistem@disaprimamedika.site';
			$range			= '';
			$datadetail 	= json_decode($datadetail, true);
			if (!empty($datadetail)){
				foreach($datadetail as $rows){
					$pengirim= $rows['created_by'];
					$cekdulu = JadwalPiket::where('pin', $rows['pin'])->where('rangepresensi', $rows['rangepresensi'])->where('nama', $rows['nama'])->count();
					if ($cekdulu == 0){
						JadwalPiket::create([
							'pin'			=> $rows['pin'] != null ? $rows['pin'] : '-',
							'nama'			=> $rows['nama'] != null ? $rows['nama'] : '-',
							'tanggal'		=> $rows['tanggal'] != null ? $rows['tanggal'] : '0000-00-00',
							'rangepresensi'	=> $rows['rangepresensi'] != null ? $rows['rangepresensi'] : $range,
							'unit'			=> $rows['unit'] != null ? $rows['unit'] : '-',
							'jabatan'		=> $rows['jabatan'] != null ? $rows['jabatan'] : '-',
							'shift'			=> $rows['shift'] != null ? $rows['shift'] : '-',
							'mulaikerja'	=> $rows['mulaikerja'] != null ? $rows['mulaikerja'] : '0000-00-00',
							'akhirkerja'	=> $rows['akhirkerja'] != null ? $rows['akhirkerja'] : '0000-00-00',
							'presensimulai'	=> $rows['presensimulai'] != null ? $rows['presensimulai'] : '0000-00-00 00:00:00',
							'presensiakhir'	=> $rows['presensiakhir'] != null ? $rows['presensiakhir'] : '0000-00-00 00:00:00',
							'created_by'	=> $rows['created_by'] != null ? $rows['created_by'] :$email,
							'updated_by'	=> $rows['updated_by'] != null ? $rows['updated_by'] : $email,
							'fakultas'		=> $fakultas
						]);
						$i++;
					} else {
						JadwalPiket::where('pin', $rows['pin'])->where('rangepresensi', $rows['rangepresensi'])->where('nama', $rows['nama'])->update([
							'tanggal'		=> $rows['tanggal'] != null ? $rows['tanggal'] : '0000-00-00',
							'unit'			=> $rows['unit'] != null ? $rows['unit'] : '-',
							'jabatan'		=> $rows['jabatan'] != null ? $rows['jabatan'] : '-',
							'shift'			=> $rows['shift'] != null ? $rows['shift'] : '-',
							'mulaikerja'	=> $rows['mulaikerja'] != null ? $rows['mulaikerja'] : '0000-00-00',
							'akhirkerja'	=> $rows['akhirkerja'] != null ? $rows['akhirkerja'] : '0000-00-00',
							'presensimulai'	=> $rows['presensimulai'] != null ? $rows['presensimulai'] : '0000-00-00 00:00:00',
							'presensiakhir'	=> $rows['presensiakhir'] != null ? $rows['presensiakhir'] : '0000-00-00 00:00:00',
							'created_by'	=> $rows['created_by'] != null ? $rows['created_by'] :$email,
							'updated_by'	=> $rows['updated_by'] != null ? $rows['updated_by'] : $email,
							'fakultas'		=> $fakultas
						]);
						$i++;
					}
				}
			}
			$pesan 		= 'Sync Data '.$i;
			$response 	= [
                'message'       => $pesan,
                'status'        => 'Suksess',
                'data'          => []
            ];
			
            return response()->json($response, 200);
        } else {
            $response = [
                'message'       => 'Token Invalid',
                'status'        => 'GAGAL',
                'data'          => []
            ];
            return response()->json($response, 500);
        }
    }
    public function siapiketIndex() {
		$data		= [];
		$data['pejabats']   		= Pejabatsurat::orderBy('kode', 'ASC')->get();
		$data['sidebar']			= 'siapiket';
		return view('dokar.siapiket', $data);
	}
	public function getJadwalSIAPIKET() {
		$arraysurat		= DB::table('kp_pegawai')->join('tbl_suratkeluartnpnomor', 'kp_pegawai.email', 'tbl_suratkeluartnpnomor.pembuat')->select('tbl_suratkeluartnpnomor.*', 'kp_pegawai.nama_lengkap', 'kp_pegawai.jabatan')->where('tbl_suratkeluartnpnomor.jenissrt', 'Jadwal Sif')->get();
		echo json_encode($arraysurat);
    }
	public function detailSIAPiket(Request $request) {
		$arraysurat		= JadwalPiket::where('rangepresensi', $request->input('val01'))->where('updated_by', $request->input('val02'))->get();
		echo json_encode($arraysurat);
    }
    public function viewKomiteMedik($id){
		$data           		= [];
		$homebase	= url("/");
		$surat 					= WebinarEventlist::where('id', $id)->first();
		if (isset($surat->id)){
			$nama_lengkap		= '';
			$email_ub			= '';
			$fakpanjang			= '';
			$tandatangan		= '';
			$setttd				= '';
			$norek				= '';
			$bank				= '';
			$namasaja 			= '';
			$previlage  		= Session('previlage');
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
			$data['idne']			= 'ALL';
			$data['presensi']		= '';
			$data['namasaja']		= $namasaja;
			$data['pengumumans']	= $surat->pengumumans;
			$data['bank']			= $bank;
			$data['norek']			= $norek;
			$data['setttd']			= $setttd;
			$data['fakpanjang']		= $fakpanjang;
			$data['nama_lengkap']	= $nama_lengkap;
			$data['email_ub']		= $email_ub;
			$data['idevent']		= $id;
			$data['nama']			= $surat->nama;
			$data['tandatangan']	= $tandatangan;
			$data['sidebar']		= 'absenall';
			$data['datane']     	= $surat;
			$data['pejabats']     	= Pejabatsurat::orderBy('kode', 'ASC')->get();
			return view('dokar.etikkesehatan', $data);
		} else {
			$data['judulpesan'] 	= 'ID INVALID';
			$data['kalimatheader'] 	= 'Data Tidak di Temukan';
			$data['kalimatbody'] 	= 'ID '.$id.' Tidak ditemukan, Periksa Kembali URL anda atau hubungi tim IT terkait';
			return view('errors.pesanerror');
		}
	}
}