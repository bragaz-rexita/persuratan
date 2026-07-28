<?php

namespace App\Http\Controllers;

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
use App\QrCodeDatabase;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Gufy\PdfToHtml\Html;
use Gufy\PdfToHtml\Pdf;
use Gufy\PdfToHtml\Config;
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

class ArsipdinamisController extends Controller
{
	public function dashboardarsiparis() {
		$i 								= 0;
		$fakultas						= Session('fakultas');
		$nmlengkap						= Session('nama');
		$mkelompok						= Session('spesial');
		$data							= [];
		$units							= Unitsurat::all();
		$countkeluar					= Suratkeluar::where('fakultas', $fakultas)->count();
		$countkeluartnpno				= Suratkeluartnpnomor::where('fakultas', $fakultas)->count();
		$countmasuk						= Suratmasuk::where('fakultas', $fakultas)->count();
		$countsk						= Tabelskdanperaturan::where('fakultas', $fakultas)->count();
		$countriwayat					= Arsipsurat::where('fakultas', $fakultas)->where('arsiparis', 'LIKE', $nmlengkap)->whereYear('created_at', date('Y'))->count();
       	$data['countarsipsk']  			= $countsk;
		$data['fakultass']  			= User::groupBy('fakultas')->get();
		$data['countarsipout']  		= $countkeluar;
		$data['countarsipin']   		= $countmasuk;
		$data['countarsipoutnonomer']   = $countkeluartnpno;
		$data['countriwayatarsip']      = $countriwayat;
		$data['units']      			= $units;
		$data['sidebar']				= 'dashboardarsiparis';
		return view('surat.dashboardarsiparislt3', $data);
    }
	public function dashboardarsip() {
		$i 								= 0;
		$fakultas						= Session('fakultas');
		$nmlengkap						= Session('nama');
		$mkelompok						= Session('spesial');
		$data							= [];
		$units							= Unitsurat::all();
		$countkeluar					= Suratkeluar::where('fakultas', $fakultas)->count();
		$countkeluartnpno				= Suratkeluartnpnomor::where('fakultas', $fakultas)->count();
		$countmasuk						= Suratmasuk::where('fakultas', $fakultas)->count();
		$countsk						= Tabelskdanperaturan::where('fakultas', $fakultas)->count();
		$countriwayat					= Arsipsurat::where('fakultas', $fakultas)->where('arsiparis', 'LIKE', $nmlengkap)->whereYear('created_at', date('Y'))->count();
       	$data['countarsipsk']  			= $countsk;
		$data['fakultass']  			= User::groupBy('fakultas')->get();
		$data['countarsipout']  		= $countkeluar;
		$data['countarsipin']   		= $countmasuk;
		$data['countarsipoutnonomer']   = $countkeluartnpno;
		$data['countriwayatarsip']      = $countriwayat;
		$data['units']      			= $units;
		$data['sidebar']				= 'dashboardarsiparis';
		return view('surat.dashboardarsiparislt3', $data);
    }
    public function arsipinsurat() {
		$i 			= 0;
		$data		= [];
		$tahunini	= date("Y");
		$tahunlalu	= $tahunini - 1;
		
		$data['bulancari'][0]['isi']	=   $tahunlalu.'-10-';
		$data['bulancari'][0]['tulis']	=   'Oct '.$tahunlalu;
		
		$data['bulancari'][1]['isi']	=   $tahunlalu.'-10-';
		$data['bulancari'][1]['tulis']	=   'Nov '.$tahunlalu;
		
		$data['bulancari'][2]['isi']	=   $tahunlalu.'-10-';
		$data['bulancari'][2]['tulis']	=   'Dec '.$tahunlalu;
		
		$data['bulancari'][3]['isi']	=   $tahunlalu;
		$data['bulancari'][3]['tulis']	=   'Seluruh Thn. '.$tahunlalu;
		
		$data['bulancari'][4]['isi']	=   $tahunini.'-01-';
		$data['bulancari'][4]['tulis']	=   'Jan '.$tahunini;
		
		$data['bulancari'][5]['isi']	=   $tahunini.'-02-';
		$data['bulancari'][5]['tulis']	=   'Feb '.$tahunini;
		
		$data['bulancari'][6]['isi']	=   $tahunini.'-03-';
		$data['bulancari'][6]['tulis']	=   'Mar '.$tahunini;
		
		$data['bulancari'][7]['isi']	=   $tahunini.'-04-';
		$data['bulancari'][7]['tulis']	=   'Apr '.$tahunini;
		
		$data['bulancari'][8]['isi']	=   $tahunini.'-05-';
		$data['bulancari'][8]['tulis']	=   'May '.$tahunini;
		
		$data['bulancari'][9]['isi']	=   $tahunini.'-06-';
		$data['bulancari'][9]['tulis']	=   'Jun '.$tahunini;
		
		$data['bulancari'][10]['isi']	=   $tahunini.'-07-';
		$data['bulancari'][10]['tulis']	=   'Jul '.$tahunini;
		
		$data['bulancari'][11]['isi']	=   $tahunini.'-08-';
		$data['bulancari'][11]['tulis']	=   'Aug '.$tahunini;
		
		$data['bulancari'][12]['isi']	=   $tahunini.'-09-';
		$data['bulancari'][12]['tulis']	=   'Sep '.$tahunini;
		
		$data['bulancari'][13]['isi']	=   $tahunini.'-10-';
		$data['bulancari'][13]['tulis']	=   'Oct '.$tahunini;
		
		$data['bulancari'][14]['isi']	=   $tahunini.'-11-';
		$data['bulancari'][14]['tulis']	=   'Nov '.$tahunini;
		
		$data['bulancari'][15]['isi']	=   $tahunini.'-12-';
		$data['bulancari'][15]['tulis']	=   'Dec '.$tahunini;
		
		$data['bulancari'][16]['isi']	=   $tahunini;
		$data['bulancari'][16]['tulis']	=   'Seluruh Thn. '.$tahunini;
		$mkelompok 			= Session('jabatan');
		$idusername			= Session('id');
		$iduser				= $idusername;
		$jmerangkap			= User::where('id', $iduser)->first();
		if (isset($jmerangkap->merangkap)){
			$merangkap		= $jmerangkap->merangkap;
			$idpeg			= $jmerangkap->nip;
		} else { $merangkap = '';  $idpeg = 0; }
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
			$cinbox	= Inboxsurat::where('penerima', $mkelompok)
								->where('jenis', 'MASUK')
								->where('status', '!=', 'reply')
								->groupBy('marking')
								->count();
			$coutbox	= Inboxsurat::where('penerima', $mkelompok)
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->count();
		}
		
		
		$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
		$data['countmailbox']      	= $countmailbox;
		$data['countinboxmasuk']    = $cinbox;
		$data['countinboxkeluar']   = $coutbox;
		$data['sidebar']			= 'arsipmasuk';
    	return view('surat.arsipsuratmasuk', $data);
    }
	public function arsipsubaktif() {
		$i 			= 0;
		$data		= [];
		$data['sidebar']			= 'arsipsubaktif';
    	return view('surat.arsipsubaktif', $data);
    }
	public function arsipsubinakti() {
		$i 			= 0;
		$data		= [];
		$data['sidebar']			= 'arsipsubinakti';
    	return view('surat.arsipsubinakti', $data);
    }
	public function arsipfasaktif() {
		$i 			= 0;
		$data		= [];
		$data['sidebar']			= 'arsipfasaktif';
    	return view('surat.arsipfasaktif', $data);
    }
	public function arsipfasinakti() {
		$i 			= 0;
		$data		= [];
		$data['sidebar']			= 'arsipfasinakti';
    	return view('surat.arsipfasinakti', $data);
    }
	public function arsipnilai() {
		$i 					= 0;
		$data				= [];
		$getpegawai			= Simpegpegawai::all();
		$data['arrallpeg']  = $getpegawai;
		$data['sidebar']	= 'arsipnilai';
    	$data['setjenis']	= 'Dinilai kembali';
    	$data['jenisarsip']	= 'Arsip Yang Harus di Nilai Kembali';
    	return view('surat.tindaklanjutarsip', $data);
    }
	public function arsipperorang() {
		$i 					= 0;
		$data				= [];
		$getpegawai			= Simpegpegawai::all();
		$data['arrallpeg']  = $getpegawai;
		$data['sidebar']	= 'arsipperorang';
    	$data['setjenis']	= 'Masuk berkas perseorangan';
    	$data['jenisarsip']	= 'Arsip Yang Harus di Kirim ke Berkas Perseorangan';
    	return view('surat.tindaklanjutarsip', $data);
    }
	public function arsippermanen() {
		$i 					= 0;
		$data				= [];
		$getpegawai			= Simpegpegawai::all();
		$data['arrallpeg']  = $getpegawai;
		$data['sidebar']	= 'arsippermanen';
    	$data['setjenis']	= 'Permanen';
    	$data['jenisarsip']	= 'Arsip Yang Harus di Kirim ke Record Center';
    	return view('surat.tindaklanjutarsip', $data);
    }
	public function arsipmusnah() {
		$i 					= 0;
		$data				= [];
		$getpegawai			= Simpegpegawai::all();
		$data['arrallpeg']  = $getpegawai;
		$data['sidebar']	= 'arsipmusnah';
    	$data['setjenis']	= 'Musnah';
    	$data['jenisarsip']	= 'Arsip Yang Harus di Musnahkan';
    	return view('surat.tindaklanjutarsip', $data);
    }
	public function arsipoutsurat() {
		$i 			= 0;
		$data		= [];
		$tahunini	= date("Y");
		$tahunlalu	= $tahunini - 1;
		
		$data['bulancari'][0]['isi']	=   $tahunlalu.'-10-';
		$data['bulancari'][0]['tulis']	=   'Oct '.$tahunlalu;
		
		$data['bulancari'][1]['isi']	=   $tahunlalu.'-10-';
		$data['bulancari'][1]['tulis']	=   'Nov '.$tahunlalu;
		
		$data['bulancari'][2]['isi']	=   $tahunlalu.'-10-';
		$data['bulancari'][2]['tulis']	=   'Dec '.$tahunlalu;
		
		$data['bulancari'][3]['isi']	=   $tahunlalu;
		$data['bulancari'][3]['tulis']	=   'Seluruh Thn. '.$tahunlalu;
		
		$data['bulancari'][4]['isi']	=   $tahunini.'-01-';
		$data['bulancari'][4]['tulis']	=   'Jan '.$tahunini;
		
		$data['bulancari'][5]['isi']	=   $tahunini.'-02-';
		$data['bulancari'][5]['tulis']	=   'Feb '.$tahunini;
		
		$data['bulancari'][6]['isi']	=   $tahunini.'-03-';
		$data['bulancari'][6]['tulis']	=   'Mar '.$tahunini;
		
		$data['bulancari'][7]['isi']	=   $tahunini.'-04-';
		$data['bulancari'][7]['tulis']	=   'Apr '.$tahunini;
		
		$data['bulancari'][8]['isi']	=   $tahunini.'-05-';
		$data['bulancari'][8]['tulis']	=   'May '.$tahunini;
		
		$data['bulancari'][9]['isi']	=   $tahunini.'-06-';
		$data['bulancari'][9]['tulis']	=   'Jun '.$tahunini;
		
		$data['bulancari'][10]['isi']	=   $tahunini.'-07-';
		$data['bulancari'][10]['tulis']	=   'Jul '.$tahunini;
		
		$data['bulancari'][11]['isi']	=   $tahunini.'-08-';
		$data['bulancari'][11]['tulis']	=   'Aug '.$tahunini;
		
		$data['bulancari'][12]['isi']	=   $tahunini.'-09-';
		$data['bulancari'][12]['tulis']	=   'Sep '.$tahunini;
		
		$data['bulancari'][13]['isi']	=   $tahunini.'-10-';
		$data['bulancari'][13]['tulis']	=   'Oct '.$tahunini;
		
		$data['bulancari'][14]['isi']	=   $tahunini.'-11-';
		$data['bulancari'][14]['tulis']	=   'Nov '.$tahunini;
		
		$data['bulancari'][15]['isi']	=   $tahunini.'-12-';
		$data['bulancari'][15]['tulis']	=   'Dec '.$tahunini;
		
		$data['bulancari'][16]['isi']	=   $tahunini;
		$data['bulancari'][16]['tulis']	=   'Seluruh Thn. '.$tahunini;
		$mkelompok 			= Session('jabatan');
		$idusername			= Session('id');
		$iduser				= $idusername;
		$jmerangkap			= User::where('id', $iduser)->first();
		if (isset($jmerangkap->merangkap)){
			$merangkap		= $jmerangkap->merangkap;
			$idpeg			= $jmerangkap->nip;
		} else { $merangkap = '';  $idpeg = 0; }
        
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
			$cinbox	= Inboxsurat::where('penerima', $mkelompok)
								->where('jenis', 'MASUK')
								->where('status', '!=', 'reply')
								->groupBy('marking')
								->count();
			$coutbox	= Inboxsurat::where('penerima', $mkelompok)
								->whereIn('jenis', ['KELUAR', 'KELUARNONOMER'])
								->where('status', 'send')
								->groupBy('marking')
								->count();
		}
		
		$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
		$data['countmailbox']      	= $countmailbox;
		$data['countinboxmasuk']    = $cinbox;
		$data['countinboxkeluar']   = $coutbox;
		$data['sidebar']	= 'arsipkeluar';
    	return view('surat.arsipsuratkeluar', $data);
    }
	public function jsonArsip(Request $request) {
		$arrayarsip = [];
		$tahun		= date("Y");
		$homebase	= url("/");
		$kerja 		= $request->input('jenis');
		$fakultas	= Session('fakultas');
		$fakpanjang	= Session('fakpanjang');
		$arsiparis	= Session('nama');
		$mkelompok	= Session('jabatan');
		if ($kerja == 'masuk'){
			if ($request->input('satker') !== null){
				$fakultas 	= $request->input('satker');
			}
			if ($request->input('bulan') !== null){
				$bulan 	= $request->input('bulan');
			} else {
				$bulan 	= 'ALL';
			}
			if ($request->input('tahun') !== null){
				$tahun 	= $request->input('tahun');
			} else {
				$tahun 	= date('Y');
			}
			if ($request->input('status') !== null){
				$status = $request->input('status');
			} else {
				$status = '';
			}
			if ($fakultas == ''){ $fakultas = Session('fakultas'); }
			
			if ($bulan == 'ALL'){
				if ($status == ''){
					$arrayarsip = Suratmasuk::select('id', 'marking', 'noagenda', 'tglmasuk', 'tglsurat', 'kepada', 'perihal', 'asalsurat', 'nosurat', 'scansurat', 'arsip', 'status', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode', 'pembuat')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where(function ($query) {$query->where('ruangarsip', '')->orWhereNull('ruangarsip');})->orderBy('noagenda', 'ASC')->get();
				} else {
					$arrayarsip = Suratmasuk::select('id', 'marking', 'noagenda', 'tglmasuk', 'tglsurat', 'kepada', 'perihal', 'asalsurat', 'nosurat', 'scansurat', 'arsip', 'status', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode', 'pembuat')->where('fakultas', $fakultas)->where('yersrt', $tahun)->orderBy('noagenda', 'ASC')->get();
				}
			} else {
				if ($status == ''){
					$arrayarsip = Suratmasuk::select('id', 'marking', 'noagenda', 'tglmasuk', 'tglsurat', 'kepada', 'perihal', 'asalsurat', 'nosurat', 'scansurat', 'arsip', 'status', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode', 'pembuat')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where('monsrt', $bulan)->where(function ($query) {$query->where('ruangarsip', '')->orWhereNull('ruangarsip');})->orderBy('noagenda', 'ASC')->get();
				} else {
					$arrayarsip = Suratmasuk::select('id', 'marking', 'noagenda', 'tglmasuk', 'tglsurat', 'kepada', 'perihal', 'asalsurat', 'nosurat', 'scansurat', 'arsip', 'status', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode', 'pembuat')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where('monsrt', $bulan)->orderBy('noagenda', 'ASC')->get();
				}
			}
		
			echo json_encode($arrayarsip);
		} else if ($kerja == 'keluar'){
			if ($request->input('satker') !== null){
				$fakultas 	= $request->input('satker');
			}
			if ($request->input('bulan') !== null){
				$bulan 	= $request->input('bulan');
			} else {
				$bulan 	= 'ALL';
			}
			if ($request->input('tahun') !== null){
				$tahun 	= $request->input('tahun');
			} else {
				$tahun 	= date('Y');
			}
			if ($request->input('status') !== null){
				$status = $request->input('status');
			} else {
				$status = '';
			}
			if ($fakultas == ''){ $fakultas = Session('fakultas'); }
			if ($bulan == 'ALL'){
				if ($status == ''){
					$arrayarsip = Suratkeluar::select('id', 'marking', 'jenissrt', 'nomor', 'anakno', 'tglsurat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where(function ($query) {$query->where('ruangarsip', '')->orWhereNull('ruangarsip');})->orderBy('nomor', 'ASC')->get();
				} else {
					$arrayarsip = Suratkeluar::select('id', 'marking', 'jenissrt', 'nomor', 'anakno', 'tglsurat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('yersrt', $tahun)->orderBy('nomor', 'ASC')->get();
				}
			} else {
				if ($status == ''){
					$arrayarsip = Suratkeluar::select('id', 'marking', 'jenissrt', 'nomor', 'anakno', 'tglsurat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where('monsrt', $bulan)->where(function ($query) {$query->where('ruangarsip', '')->orWhereNull('ruangarsip');})->orderBy('nomor', 'ASC')->get();
				} else {
					$arrayarsip = Suratkeluar::select('id', 'marking', 'jenissrt', 'nomor', 'anakno', 'tglsurat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where('monsrt', $bulan)->orderBy('nomor', 'ASC')->get();
				}
			}
			echo json_encode($arrayarsip);
		} else if ($kerja == 'keluarnon'){
			if ($request->input('satker') !== null){
				$fakultas 	= $request->input('satker');
			}
			if ($request->input('bulan') !== null){
				$bulan 	= $request->input('bulan');
			} else {
				$bulan 	= 'ALL';
			}
			if ($request->input('tahun') !== null){
				$tahun 	= $request->input('tahun');
			} else {
				$tahun 	= date('Y');
			}
			if ($request->input('status') !== null){
				$status = $request->input('status');
			} else {
				$status = '';
			}
			if ($fakultas == ''){ $fakultas = Session('fakultas'); }
			if ($bulan == 'ALL'){
				if ($status == ''){
					$arrayarsip = Suratkeluartnpnomor::select('id', 'marking', 'jenissrt', 'isisurat', 'tglbuat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('yersrt', $tahun)->where(function ($query) {$query->where('ruangarsip', '')->orWhereNull('ruangarsip');})->orderBy('id', 'ASC')->get();
				} else {
					$arrayarsip = Suratkeluartnpnomor::select('id', 'marking', 'jenissrt', 'isisurat', 'tglbuat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('yersrt', $tahun)->orderBy('id', 'ASC')->get();
				}
			} else {
				$valcari = $tahun.'-'.$bulan;
				if ($status == ''){
					$arrayarsip = Suratkeluartnpnomor::select('id', 'marking', 'jenissrt', 'isisurat', 'tglbuat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('tglbuat', 'LIKE', $valcari.'%')->where(function ($query) {$query->where('ruangarsip', '')->orWhereNull('ruangarsip');})->orderBy('id', 'ASC')->get();
				} else {
					$arrayarsip = Suratkeluartnpnomor::select('id', 'marking', 'jenissrt', 'isisurat', 'tglbuat', 'kepada', 'perihal', 'pembuat', 'kelompok', 'status', 'arsip', 'footnote', 'ruangarsip', 'ordnerarsip', 'lemariarsip', 'faskode')->where('fakultas', $fakultas)->where('tglbuat', 'LIKE', $valcari.'%')->orderBy('id', 'ASC')->get();
				}
			}
			echo json_encode($arrayarsip);
		} else if ($kerja == 'skdanperaturan'){
			if ($request->input('satker') !== null){
				$fakultas 	= $request->input('satker');
			}
			if ($request->input('bulan') !== null){
				$bulan 	= $request->input('bulan');
			} else {
				$bulan 	= 'ALL';
			}
			if ($request->input('tahun') !== null){
				$tahun 	= $request->input('tahun');
			} else {
				$tahun 	= date('Y');
			}
			if ($request->input('status') !== null){
				$status = $request->input('status');
			} else {
				$status = '';
			}
			if ($fakultas == ''){ $fakultas = Session('fakultas'); }
			if ($bulan == 'ALL'){
				if ($status == ''){
					$arrayarsip = Tabelskdanperaturan::select('id', 'marking', 'kelompok', 'nomor', 'tahun', 'tanggal', 'penandatangan', 'pjbtperundang', 'judul', 'kodefas', 'inputor', 'arsip', 'catatan', 'ruangarsip', 'ordnerarsip', 'lemariarsip')->where('fakultas', $fakultas)->where('tahun', $tahun)->whereNull('ruangarsip')->orderByRaw('nomor * 1 ASC')->get();
				} else {
					$arrayarsip = Tabelskdanperaturan::select('id', 'marking', 'kelompok', 'nomor', 'tahun', 'tanggal', 'penandatangan', 'pjbtperundang', 'judul', 'kodefas', 'inputor', 'arsip', 'catatan', 'ruangarsip', 'ordnerarsip', 'lemariarsip')->where('fakultas', $fakultas)->where('tahun', $tahun)->orderByRaw('nomor * 1 ASC')->get();
				}
			} else {
				$valcari = $tahun.'-'.$bulan;
				if ($status == ''){
					$arrayarsip = Tabelskdanperaturan::select('id', 'marking', 'kelompok', 'nomor', 'tahun', 'tanggal', 'penandatangan', 'pjbtperundang', 'judul', 'kodefas', 'inputor', 'arsip', 'catatan', 'ruangarsip', 'ordnerarsip', 'lemariarsip')->where('fakultas', $fakultas)->where('tanggal', 'LIKE', $valcari.'%')->whereNull('ruangarsip')->orderByRaw('nomor * 1 ASC')->get();
				} else {
					$arrayarsip = Tabelskdanperaturan::select('id', 'marking', 'kelompok', 'nomor', 'tahun', 'tanggal', 'penandatangan', 'pjbtperundang', 'judul', 'kodefas', 'inputor', 'arsip', 'catatan', 'ruangarsip', 'ordnerarsip', 'lemariarsip')->where('fakultas', $fakultas)->where('tanggal', 'LIKE', $valcari.'%')->orderByRaw('nomor * 1 ASC')->get();
				}
			}
			echo json_encode($arrayarsip);
		} else if ($kerja == 'riwayatpribadi'){
			$cceknip		= User::where('username', Session('username'))->count();
			if ($cceknip != 0){
				$ceknip		= User::where('username', Session('username'))->first();
				$idpeg		= $ceknip->nip;
				$getkepeg	= Simpegpegawai::where('id', $idpeg)->first();
				if (isset($getkepeg->id)){
					$nik		= $getkepeg->nik;
					$nip_baru	= $getkepeg->nip_baru;
					$nip_baru 	= preg_replace('/\s+/', '', $nip_baru);
					$nik 		= preg_replace('/\s+/', '', $nik);
					$rsurat 	= Suratkeluar::where('isisurat', 'LIKE', '%'.$nip_baru.'%')->orWhere('paraf5', $nip_baru)->get();
					if (!empty($rsurat)) {
						foreach ($rsurat as $result) {
							$marking	= $result->marking;
							$klasifikasi= $result->klasifikasi;
							$nomor		= $result->nomor;
							$anakno		= $result->anakno;
							$status 	= $result->status;
							if ($status == 'MANUAL'){ $tabel = 'MANUAL'; }
							else { $tabel = 'KELUAR'; }
							if ($anakno != ''){ $tulisnomor = $nomor.'.'.$anakno; }
							else { $tulisnomor = $nomor; }
							$terakhir 	= '';
							$selesai 	= 'SELESAI';
							$boleh 		= 'IYA';
							$perihal 	= $result->perihal;
							$klasifikasi= $klasifikasi;
						
							$arrayarsip[] = array(
								'idsurat' 		=> $result->id,
								'marking' 		=> $result->marking,
								'nomor' 		=> $tulisnomor,
								'tglmasuk' 		=> '',
								'tglsurat' 		=> $result->tglsurat,
								'kepada' 		=> $result->kepada,
								'nosurat' 		=> '',
								'asalsurat' 	=> $result->unit,
								'perihal' 		=> $perihal,
								'klasifikasi' 	=> $klasifikasi,
								'bentuk' 		=> $result->status,
								'pembuat' 		=> $result->pembuat,
								'status' 		=> $result->status,
								'scansurat' 	=> $result->isisurat,						
								'faskode' 		=> $result->faskode,
								'subkode' 		=> $result->subkode,
								'ruangarsip' 	=> $result->ruangarsip,
								'ordnerarsip' 	=> $result->ordnerarsip,
								'lemariarsip' 	=> $result->lemariarsip,
								'boleh' 		=> $boleh,
								'selesai' 		=> $selesai,
								'terakhir' 		=> $tabel,
							);
						}
					}
				}
			}
			echo json_encode($arrayarsip);
		} else {
			return $this->jarsiparisPaged($request);
		}
    }
    public function jarsiparisPaged(Request $request) {
		$arrayarsip 	= [];
		$homebase		= url("/");
		$tahun			= date("Y");
		$kerja 			= $request->input('jenis');
		$val02 			= $request->input('val02');
		$fakultas		= Session('fakultas');
		$fakpanjang		= Session('fakpanjang');
		$arsiparis		= Session('nama');
		$mkelompok		= Session('jabatan');
		$totaldata  	= 0;
        $filterscount	= 0;
		$limit         	= 10;
		$pagenum		= 0;
		$pimpinan 		= '';
		$sortdatafield	= 'id';
		$sortorder		= 'DESC';
		$boleh 			= 'IYA';
		$limit      	= ($request->input('pagesize') == null ? $limit : $request->input('pagesize'));
		$pagenum      	= ($request->input('pagenum') == null ? $pagenum : $request->input('pagenum'));
		$filterscount  	= ($request->input('filterscount') == null ? $filterscount : $request->input('filterscount'));
		$sortdatafield  = ($request->input('sortdatafield') == null ? $sortdatafield : $request->input('sortdatafield'));
		$sortorder  	= ($request->input('sortorder') == null ? $sortorder : $request->input('sortorder'));
		$skrg			= date("Y-m-d h:i:sa");
		$skrg2			= date("Y-m-d");
		$arsipkan		= 'Diarsip '.$arsiparis.' Tgl : '.$skrg;
		if ($kerja == 'masuk'){
			$data		= Suratmasuk::where('fakultas', $fakultas);
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'nomor') { $filterdatafield = 'noagenda'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)) {
				foreach ($data as $result) {
					$marking	= $result->marking;
					$klasifikasi= $result->klasifikasi;
					$faskode	= $result->faskode;
					$submasa	= $result->submasa;
					
					if ($klasifikasi == 'Rahasia' or $klasifikasi == 'Sangat Rahasia'){
						$perihal	= 'Dirahasiakan';
						$klasifikasi= 'Rahasia';
					} else {
						$perihal 	= $result->perihal;
						$klasifikasi= $klasifikasi;
					}
					$ceksudah 	= Inboxsurat::where('marking', $marking)->where('penerima', 'LIKE', '%Arsiparis%')->where('jenis', 'MASUK')->count();
					if ($ceksudah == 0){
						$ceksudah 	= Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->orderBy('id', 'DESC')->first();
						if (isset($ceksudah->id)){
							$terakhir	= $ceksudah->penerima.' ('.$ceksudah->status.' at '.$ceksudah->created_at.')';
							$selesai	= 'Proses';	
						} else {
							$terakhir 	= '';
							$selesai 	= 'NEW';
						}
					} else {
						if ($result->status != 'arsip'){
							Suratmasuk::where('id', $result->id)->update([
								'status' 		=>  'arsip',
								'arsip' 		=>  $arsipkan,
								'ruangarsip' 	=>  'Cloud',
								'ordnerarsip' 	=>  'Cloud',
								'lemariarsip' 	=>  'Cloud',
							]);
						}
						$terakhir 	= '';
						$selesai 	= 'SELESAI';
					}
					$arrayarsip[] 	= array(
						'idsurat' 		=> $result->id,
						'marking' 		=> $result->marking,
						'nomor' 		=> $result->noagenda,
						'noagenda' 		=> $result->noagenda,
						'tglmasuk' 		=> $result->tglmasuk,
						'tglsurat' 		=> $result->tglsurat,
						'kepada' 		=> $result->kepada,
						'nosurat' 		=> $result->nosurat,
						'asalsurat' 	=> $result->asalsurat,
						'perihal' 		=> $perihal,
						'klasifikasi' 	=> $klasifikasi,
						'bentuk' 		=> 'MASUK',
						'pembuat' 		=> $result->pembuat,
						'status' 		=> $result->status,
						'scansurat' 	=> $result->scansurat,						
						'faskode' 		=> $result->faskode,
						'subkode' 		=> $result->subkode,
						'ruangarsip' 	=> $result->ruangarsip,
						'ordnerarsip' 	=> $result->ordnerarsip,
						'lemariarsip' 	=> $result->lemariarsip,
						'boleh' 		=> $boleh,
						'selesai' 		=> $selesai,
						'terakhir' 		=> $terakhir,
					);
				}
			}
		} else if ($kerja == 'keluar'){
			$data = Suratkeluar::where('fakultas', $fakultas);
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'selesai'){ $filterdatafield = 'status'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)) {
				foreach ($data as $result) {
					$marking	= $result->marking;
					$klasifikasi= $result->klasifikasi;
					$nomor		= $result->nomor;
					$anakno		= $result->anakno;
					$status 	= $result->status;
					$faskode	= $result->faskode;
					$tglsurat	= $result->tglsurat;
					$paraf1		= $result->paraf1;
					if ($klasifikasi == 'Rahasia' or $klasifikasi == 'Sangat Rahasia'){
						$perihal	= 'Dirahasiakan';
						$klasifikasi= 'Rahasia';
					} else {
						$perihal 	= $result->perihal;
						$klasifikasi= $klasifikasi;
					}
					if ($result->tandatangan == ''){
						$ceksudah 	= Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->orderBy('id', 'DESC')->first();
						if (isset($ceksudah->id)){
							$terakhir	= $ceksudah->penerima.' ('.$ceksudah->status.' at '.$ceksudah->created_at.')';
							$selesai	= 'Proses';	
						} else {
							$terakhir 	= '';
							$selesai 	= 'NEW';
						}
					} else {
						if ($result->arsip == ''){
							Suratkeluar::where('id', $result->id)->update([
								'arsip' 		=>  $arsipkan,
								'ruangarsip' 	=>  'Cloud',
								'ordnerarsip' 	=>  'Cloud',
								'lemariarsip' 	=>  'Cloud',
							]);
						}
						$terakhir 	= '';
						$selesai 	= 'SELESAI';
					}
					$arrayarsip[] = array(
						'idsurat' 		=> $result->id,
						'marking' 		=> $result->marking,
						'nomor' 		=> $result->nomor,
						'tglmasuk' 		=> '',
						'tglsurat' 		=> $result->tglsurat,
						'kepada' 		=> $result->kepada,
						'nosurat' 		=> $result->nomor.'/'.$result->kodefak.'/'.$result->monsrt.'/'.$result->yersrt,
						'asalsurat' 	=> $result->unit,
						'perihal' 		=> $perihal,
						'klasifikasi' 	=> $klasifikasi,
						'bentuk' 		=> 'KELUAR',
						'pembuat' 		=> $result->pembuat,
						'status' 		=> $result->status,
						'scansurat' 	=> $result->isisurat,
						'faskode' 		=> $result->faskode,
						'subkode' 		=> $result->subkode,
						'ruangarsip' 	=> $result->ruangarsip,
						'ordnerarsip' 	=> $result->ordnerarsip,
						'lemariarsip' 	=> $result->lemariarsip,
						'boleh' 		=> $boleh,
						'selesai' 		=> $selesai,
						'terakhir' 		=> $terakhir,
					);
				}
			}
		} else if ($kerja == 'keluarnon'){
			$data = Suratkeluartnpnomor::where('fakultas', $fakultas);
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			
			if (!empty($data)) {
				foreach ($data as $result) {
					$marking	= $result->marking;
					$klasifikasi= $result->klasifikasi;
					$jenissrt	= $result->jenissrt;
					$status		= $result->status;
					$faskode	= $result->faskode;
					if ($klasifikasi == 'Rahasia' or $klasifikasi == 'Sangat Rahasia'){
						$perihal	= 'Dirahasiakan';
						$klasifikasi= 'Rahasia';
					} else {
						$perihal 	= $result->perihal;
						$klasifikasi= $klasifikasi;
					}
					if ($result->tandatangan == ''){
						$ceksudah 	= Inboxsurat::where('marking', $marking)->where('jenis', 'KELUARNONOMER')->orderBy('id', 'DESC')->first();
						if (isset($ceksudah->id)){
							$terakhir	= $ceksudah->penerima.' ('.$ceksudah->status.' at '.$ceksudah->created_at.')';
							$selesai	= 'Proses';	
						} else {
							$terakhir 	= '';
							$selesai 	= 'NEW';
						}
					} else {
						if ($result->arsip == ''){
							Suratkeluartnpnomor::where('id', $result->id)->update([
								'arsip' 		=>  $arsipkan,
								'ruangarsip' 	=>  'Cloud',
								'ordnerarsip' 	=>  'Cloud',
								'lemariarsip' 	=>  'Cloud',
							]);
						}
						$terakhir 	= '';
						$selesai 	= 'SELESAI';
					}
					$arrayarsip[] = array(
						'idsurat' 		=> $result->id,
						'marking' 		=> $result->marking,
						'nomor' 		=> '',
						'tglmasuk' 		=> '',
						'tglsurat' 		=> $result->tglbuat,
						'kepada' 		=> $result->kepada,
						'nosurat' 		=> '',
						'asalsurat' 	=> $result->unit,
						'perihal' 		=> $perihal,
						'klasifikasi' 	=> $klasifikasi,
						'bentuk' 		=> 'KELUARNONOMER',
						'pembuat' 		=> $result->pembuat,
						'status' 		=> $result->status,
						'scansurat' 	=> $result->isisurat,
						'faskode' 		=> $result->faskode,
						'subkode' 		=> $result->subkode,
						'ruangarsip' 	=> $result->ruangarsip,
						'ordnerarsip' 	=> $result->ordnerarsip,
						'lemariarsip' 	=> $result->lemariarsip,
						'boleh' 		=> $boleh,
						'selesai' 		=> $selesai,
						'terakhir' 		=> $terakhir,
					);
				}
			}
		} else if ($kerja == 'skdanperaturan'){
			$data = Tabelskdanperaturan::where('fakultas', $fakultas);
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'perihal'){ $filterdatafield = 'judul'; }
					if ($filterdatafield == 'pembuat') { $filterdatafield = 'inputor'; }
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)){
				foreach ($data as $getdatasrt) {
					$idne		= $getdatasrt->id;
					$marking	= $getdatasrt->marking;
					$dasarsurat	= $getdatasrt->dasarsurat;
					$nomor		= $getdatasrt->nomor;
					$noanak		= $getdatasrt->noanak;
					$tanggal 	= $getdatasrt->tanggal;
					$tahunsk 	= $getdatasrt->tahun;
					$faskode	= $getdatasrt->kodefas;
					if ($getdatasrt->tandatangan == '' OR $getdatasrt->tandatangan == 'Auto' OR $getdatasrt->tandatangan == 'Proses'){
						$ceksudah 	= Inboxsurat::where('marking', $marking)->orderBy('id', 'DESC')->first();
						if (isset($ceksudah->id)){
							$terakhir	= $ceksudah->penerima.' ('.$ceksudah->status.' at '.$ceksudah->created_at.')';
							$selesai	= 'Proses';	
						} else {
							$terakhir 	= '';
							$selesai 	= 'NEW';
						}
					} else {
						if ($getdatasrt->arsip == ''){
							Tabelskdanperaturan::where('id', $getdatasrt->id)->update([
								'arsip' =>  $arsipkan,
							]);
						}
						$terakhir 	= '';
						$selesai 	= 'SELESAI';
					}
					$arrayarsip[] = array(
						'idsurat' 		=> $getdatasrt->id,
						'marking' 		=> $getdatasrt->marking,
						'nomor' 		=> $getdatasrt->nomor,
						'tglmasuk' 		=> '',
						'tglsurat' 		=> $getdatasrt->tanggal,
						'kepada' 		=> '',
						'nosurat' 		=> $getdatasrt->nomor.' Tahun '.$getdatasrt->tahun,
						'asalsurat' 	=> $getdatasrt->fakultas,
						'perihal' 		=> $getdatasrt->judul,
						'klasifikasi' 	=> '',
						'bentuk' 		=> 'SKDANPERATURAN',
						'pembuat' 		=> $getdatasrt->inputor,
						'status' 		=> $getdatasrt->catatan,
						'scansurat' 	=> $getdatasrt->scansurat,
						'faskode' 		=> $getdatasrt->kodefas,
						'subkode' 		=> $getdatasrt->kodesub,
						'ruangarsip' 	=> '',
						'ordnerarsip' 	=> '',
						'lemariarsip' 	=> '',
						'boleh' 		=> $boleh,
						'selesai' 		=> $selesai,
						'terakhir' 		=> $terakhir,
					);
				}
			}
		} else if ($kerja == 'cekmari' OR $kerja == 'cekrungmari'){
			$data	= DB::table('tbl_inbox')->join('tbl_suratmasuk', 'tbl_inbox.marking', 'tbl_suratmasuk.marking')->select('tbl_suratmasuk.*', 'tbl_inbox.pengirim')->where('tbl_inbox.email', Session('email'))->whereYear('tbl_suratmasuk.tglmasuk', date("Y"));
			if ($kerja == 'cekmari'){
				$data 	= $data->where('tbl_suratmasuk.status', 'LIKE', '%'.'arsip'.'%');
			} else {
				$data 	= $data->where('tbl_suratmasuk.status', '!=', 'arsip');
			}
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					if ($filterdatafield == 'nomor') { $filterdatafield = 'tbl_suratmasuk.noagenda'; }
					else {
						$filterdatafield = 'tbl_suratmasuk.'.$filterdatafield;
					}
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)) {
				foreach ($data as $result) {
					$marking	= $result->marking;
					$klasifikasi= $result->klasifikasi;
					$faskode	= $result->faskode;
					$submasa	= $result->submasa;
					if ($skrg2 != $submasa){
						$cakhir 	= Inboxsurat::where('marking', $marking)->where('status', '!=', 'reply')->where('penerima', 'NOT LIKE', 'Arsiparis%')->where('jenis', 'MASUK')->count();
						if ($cakhir != 0){
							$terakhir = '';
							$jcakhir 	= Inboxsurat::where('marking', $marking)->where('status', '!=', 'reply')->where('penerima', 'NOT LIKE', 'Arsiparis%')->where('jenis', 'MASUK')->get();
							foreach ($jcakhir as $v){
								$val01		= $v->pengirim;
								$val02		= $v->penerima;
								$val03		= $v->status;
								$val04		= $v->updated_at;
								$terakhir 	= $val02.' ('.$val03.' on '.$val04.')';
							}
							$selesai 	= 'BELUM';
							$terakhir 	= 'Terakhir di '.$terakhir;
						} else {
							$terakhir 	= '';
							$selesai 	= 'SELESAI';
						}
						Suratmasuk::where('id', $result->id)->update([
							'subkode' 		=>  $selesai,
							'submasa' 		=>  $skrg2,
							'subket' 		=>  $terakhir,
						]);
					} else {
						$selesai 	= $result->subkode;
						$terakhir 	= $result->subket;
					}
					$perihal 	= $result->perihal;
					$klasifikasi= $klasifikasi;
					$boleh 		= 'IYA';
					$arrayarsip[] 	= array(
						'idsurat' 		=> $result->id,
						'marking' 		=> $result->marking,
						'nomor' 		=> $result->noagenda,
						'noagenda' 		=> $result->noagenda,
						'tglmasuk' 		=> $result->tglmasuk,
						'tglsurat' 		=> $result->tglsurat,
						'kepada' 		=> $result->kepada,
						'nosurat' 		=> $result->nosurat,
						'asalsurat' 	=> $result->asalsurat,
						'perihal' 		=> $perihal,
						'klasifikasi' 	=> $klasifikasi,
						'bentuk' 		=> 'MASUK',
						'pembuat' 		=> $result->pembuat,
						'status' 		=> $result->status,
						'scansurat' 	=> $result->scansurat,						
						'faskode' 		=> $result->faskode,
						'subkode' 		=> $result->subkode,
						'ruangarsip' 	=> $result->ruangarsip,
						'ordnerarsip' 	=> $result->ordnerarsip,
						'lemariarsip' 	=> $result->lemariarsip,
						'boleh' 		=> $boleh,
						'selesai' 		=> $selesai,
						'terakhir' 		=> $terakhir,
					);
				}
			}
		} else if ($kerja == 'inboxpimpinanin' OR $kerja == 'inboxpimpinanout'){
			$getjabatan 	= Pejabatsurat::where('nama', 'LIKE', $val02)->first();
			if (isset($getjabatan->pejabat)){
				$nmjabatan 	= $getjabatan->pejabat;
			} else {
				$getpejabat = Pejabatsurat::where('id', $idpejabat)->first();
				if (isset($getpjbt->pejabat)){
					$nmjabatan 	= $getpjbt->pejabat;
				}
			}
			if ($kerja == 'inboxpimpinanout'){
				$data	= DB::table('tbl_inbox')->where('tbl_inbox.jenis', '!=', 'MASUK')->where('tbl_inbox.penerima', $nmjabatan)->whereIn('tbl_inbox.status', ['send', 'read']);
			} else {
				$data	= DB::table('tbl_inbox')->where('tbl_inbox.jenis', 'MASUK')->where('tbl_inbox.penerima', $nmjabatan)->whereIn('tbl_inbox.status', ['send', 'read']);
			}
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)) {
				foreach ($data as $result) {
					if ($kerja == 'inboxpimpinanout'){
						$selesai	= '<a target="_blank" href="'.$homebase.'/trackingid/srtklr-'.$result->marking.'">'.$result->kerja.'</a>';
					} else {
						$selesai	= '<a target="_blank" href="'.$homebase.'/trackingid/srtmsk-'.$result->marking.'">'.$result->kerja.'</a>';
					}
					$arrayarsip[] 	= array(
						'idinbox' 		=> $result->id,
						'idsurat' 		=> $result->idsurat,
						'marking' 		=> $result->marking,
						'nomor' 		=> $result->noagenda,
						'noagenda' 		=> $result->noagenda,
						'tglmasuk' 		=> $result->created_at,
						'tglsurat' 		=> $result->tglsurat,
						'kepada' 		=> $result->kepada,
						'nosurat' 		=> $result->nosurat,
						'asalsurat' 	=> $result->alamat,
						'perihal' 		=> $result->perihal,
						'klasifikasi' 	=> $result->klasifikasi,
						'bentuk' 		=> $result->tabel,
						'pembuat' 		=> $result->pembuat,
						'status' 		=> $result->status,
						'scansurat' 	=> '',						
						'faskode' 		=> '',
						'subkode' 		=> '',
						'ruangarsip' 	=> '',
						'ordnerarsip' 	=> '',
						'lemariarsip' 	=> '',
						'boleh' 		=> 'IYA',
						'selesai' 		=> $selesai,
						'terakhir' 		=> '',
					);
				}
			}
		} else {
			$data	= Arsipsurat::where('arsiparis', $arsiparis);
			if ($filterscount > 0){
				for ($i = 0; $i < $filterscount; $i++){
					$filtervalue		= $request->input('filtervalue'.$i);
					$filterdatafield  	= $request->input('filterdatafield'.$i);
					$data 				= $data->where($filterdatafield, 'LIKE', '%'.$filtervalue.'%');
				}
			}
			$pagenum++;
			$data       = $data->orderByRaw($sortdatafield.' '.$sortorder)->paginate($limit, ['*'], 'page', $pagenum);
			$totaldata	= $data->total();
			if (!empty($data)) {
				foreach ($data as $result) {
					$tabel	= $result->tabel;
					$idne	= $result->idne;
					$perihal= $result->perihal;
					$marking= $result->marking;
					if (is_null($marking) OR $marking == ''){
						if ($tabel == 'Surat Keluar'){
							$jsurat = Suratkeluar::where('id', $idne)->first();
							if (isset($jsurat->id)){
								$perihal= $jsurat->perihal;
								$marking= $jsurat->marking;
							}
						} else if ($tabel == 'Surat Keluar Tanpa Nomor'){
							$jsurat = Suratkeluartnpnomor::where('id', $idne)->first();
							if (isset($jsurat->id)){
								$perihal= $jsurat->perihal;
								$marking= $jsurat->marking;
							}
						} else if ($tabel == 'Draft SK'){
							$jsurat = Draftsk::where('id', $idne)->first();
							if (isset($jsurat->id)){
								$perihal= $jsurat->jenissk;
								$marking= $jsurat->marking;
							}
						} else if ($tabel == 'SK dan Peraturan'){
							$jsurat 	= Tabelskdanperaturan::where('id', $idne)->first();
							if (isset($jsurat->marking)){
								$perihal = $jsurat->judul;
								$marking = $jsurat->marking;
							}
						} else {
							$jsurat = Suratmasuk::where('id', $idne)->first();
							if (isset($jsurat->id)){
								$perihal= $jsurat->perihal;
								$marking= $jsurat->marking;
							}
						}
						Arsipsurat::where('id', $result->id)->update([
							'marking'	=> $marking,
							'perihal'	=> $perihal,
						]);
					}
					if ($tabel == 'Surat Keluar'){
						$tabel = '<a href="'.$homebase.'/viewsurat/keluar-'.$idne.'" target="_blank"><span class="badge badge-success">'.$tabel.'</span></a>';
					} else if ($tabel == 'Surat Keluar Tanpa Nomor'){
						$tabel = '<a href="'.$homebase.'/viewsurat/31a6c48f03aaf7ab8085cc6b5bd34990-'.$idne.'" target="_blank"><span class="badge badge-info">'.$tabel.'</span></a>';
					} else if ($tabel == 'Draft SK'){
						$tabel = '<a href="'.$homebase.'/viewsurat/954db2a8075c782c586e33e36ed2cc8c-'.$idne.'" target="_blank"><span class="badge badge-warning">'.$tabel.'</span></a>';
					} else if ($tabel == 'SK dan Peraturan'){
						$tabel = '<a href="'.$homebase.'/viewsurat/SKPP-'.$idne.'" target="_blank"><span class="badge badge-danger">'.$tabel.'</span></a>';
					} else {
						$tabel = '<a href="'.$homebase.'/viewsurat/7a07275b47504815818abc970da769fc-'.$idne.'" target="_blank"><span class="badge badge-primary">'.$tabel.'</span></a>';
					}
					
					$arrayarsip[] = array(
						'idarsip' 		=> $result->id,
						'idsurat' 		=> $idne,
						'tabel' 		=> $tabel,
						'perihal' 		=> $perihal,
						'jenis' 		=> $result->jenis,
						'kode' 			=> $result->kode,
						'durasi' 		=> $result->durasi,
						'keterangan' 	=> $result->keterangan,
						'ruang' 		=> $result->ruang,
						'ordner' 		=> $result->ordner,
						'lemari' 		=> $result->lemari,
						'arsiparis' 	=> $result->arsiparis,						
						'fakultas' 		=> $result->fakultas,
					);
				}
			}
		}
    	$response = [
			'message'   => 'List Laporan',
			'data'      => $arrayarsip,
			'total'     => $totaldata
		];
        return response()->json($response, 200);
    }
	public function datasuratSkcari(Request $request) {
		$arrayarsipsk 	= [];
		$tahun			= date("Y");
		$fakultas		= Session('fakultas');
		$cekdaftar		= Tabelskdanperaturan::where('fakultas', $fakultas)->where('tahun', $tahun)->count();
		if ($cekdaftar != 0){
			$cekdaftar	= Tabelskdanperaturan::where('fakultas', $fakultas)->where('tahun', $tahun)->get();
			foreach ($cekdaftar as $hasil) {
				$nomor		= $hasil->nomor;
				$tahun		= $hasil->tahun;
				$scansurat	= $hasil->scansurat;
				$tlsnomor = $nomor.' Tahun '.$tahun;
				if ($scansurat == ''){ $scansurat = 'hilang.png'; }
				$arrayarsipsk[] = array(
					'id' 			=> $hasil->id,	
					'nomor' 		=> $nomor,
					'noanak' 		=> $noanak,
					'tlsnomor' 		=> $tlsnomor,
					'tanggal' 		=> $hasil->tanggal,
					'tahun' 		=> $hasil->tahun,
					'judul' 		=> $hasil->judul,
					'link' 			=> $scansurat,
				);
			}
		}
    	echo json_encode($arrayarsipsk);	
    }
	public function jsonarsipsrtKeluar(Request $request) {
		$arrayarsipklr 	= [];
		$tahun			= date("Y");
		$bulan 			= $request->input('val01');
		$tahun 			= $request->input('val02');
		$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$mnama 			= Session('nama');
		$mjabatan 		= Session('jabatan');
		$fakultas		= Session('fakultas');
		$previlage		= Session('previlage');
		$mkelompok		= $previlage;
		if ($bulan == 'cariperbulan'){
			$valcari 	= date("Y").'-'.$tahun;
			$rsurat 	= Inboxsurat::where('penerima', 'LIKE', Session('jabatan'))->where('jenis', '!=', 'MASUK')->where('created_at', 'LIKE', $valcari.'%')->get();
			if (!empty($rsurat)){
				foreach ($rsurat as $rows){
					$marking 		= $rows->marking;
					$idsurat		= '';
					$nomor			= '';
					$anakno			= '';
					$tlsnomor		= '';
					$kodefak		= '';
					$jenissrt		= '';
					$pembuat		= '';
					$unit			= '';
					$dasarsurat		= '';
					$perihal		= '';
					$isisurat		= '';
					$tabel			= '';
					$tanggal		= $rows->created_at;
					$tglsurat		= $rows->updated_at;
					$hasil			= Suratkeluar::where('marking', $marking)->first();
					if (isset($hasil->id)){
						$idsurat 	= $hasil->id;
						$tanggal 	= $hasil->tglsurat;
						$nomor 		= $hasil->nomor;
						$anakno 	= $hasil->anakno;
						$status 	= $hasil->status;
						$pembuat 	= $hasil->pembuat;
						$kelompok 	= $hasil->kelompok;
						$kodefak 	= $hasil->kodefak;
						$jenissrt 	= $hasil->jenissrt;
						$pembuat 	= $hasil->pembuat;
						$unit 		= $hasil->unit;
						$dasarsurat = $hasil->dasarsurat;
						$perihal 	= $hasil->perihal;
						$isisurat 	= $hasil->isisurat;
						$tabel 		= $hasil->tabel;
						if ($status == 'MANUAL'){ $tabel = 'MANUAL'; }
						else { $tabel = 'KELUAR'; }
						if ($anakno != 0){ $tlsnomor = $nomor.'.'.$anakno; }
						else { $tlsnomor = $nomor; }
						$ahrf 		= explode("-", $tanggal);
						$yersrt		= $ahrf[0];
						$monsrt		= (int)$ahrf[1];
						$daysrt		= $ahrf[2];
						$bulane		= $arrbulan[$monsrt];
						$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
						
					} else {
						$hasil		= Suratkeluartnpnomor::where('marking', $marking)->first();
						if (isset($hasil->id)){
							$idsurat 	= $hasil->id;
							$tanggal 	= $hasil->tglbuat;
							$marking 	= $hasil->marking;
							$kodefak 	= $hasil->kodefak;
							$jenissrt 	= $hasil->jenissrt;
							$pembuat 	= $hasil->pembuat;
							$unit 		= $hasil->unit;
							$dasarsurat = $hasil->dasarsurat;
							$perihal 	= $hasil->perihal;
							$nomor 		= '0';
							$anakno 	= '0';
							
							if ($anakno != 0){ $tlsnomor = $nomor.'.'.$anakno; }
							else { $tlsnomor = $nomor; }
							$ahrf 		= explode("-", $tanggal);
							$yersrt		= $ahrf[0];
							$monsrt		= (int)$ahrf[1];
							$daysrt		= $ahrf[2];
							$bulane		= $arrbulan[$monsrt];
							$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
							$tabel		= 'KELUARNONOMER';
						}	
					}
					$arrayarsipklr[] = array(
						'id' 			=> $idsurat,
						'marking' 		=> $marking,
						'tanggal' 		=> $tanggal,
						'tlstgl' 		=> $tglsurat,
						'nomor' 		=> $nomor,
						'anakno' 		=> $anakno,
						'tlsnomor' 		=> $tlsnomor,
						'kodesurat' 	=> $kodefak,
						'jenissurat' 	=> $jenissrt,
						'namapemroses' 	=> $pembuat,
						'unitpemroses' 	=> $unit,
						'dasarsurat' 	=> $dasarsurat,
						'perihal' 		=> $perihal,
						'isisurat' 		=> $isisurat,
						'tabel' 		=> $tabel,
						'boleh' 		=> 'IYA',
					);
				}
			}
			
		} else {
			if ($tahun == ''){ $tahun = date("Y"); }
			if ($bulan == 'ALL'){$setcari = $tahun.'-%';}
			else {$setcari = $tahun.'-'.$bulan.'-%';}
			$cekprevilage	= Pejabatsurat::where('fakultas', $fakultas)->where('pejabat', $previlage)->count();
			if ($cekprevilage != 0){ $jbtcari = $mjabatan; }
			else { $jbtcari = $mnama; }
			$cekdaftar		= Suratkeluar::where('fakultas', $fakultas)->where('tglsurat', 'LIKE', $setcari)->count();
			if ($cekdaftar != 0){
				$rsurat		= Suratkeluar::where('fakultas', $fakultas)->where('tglsurat', 'LIKE', $setcari)->get();
				foreach ($rsurat as $hasil) {
					$marking 	= $hasil->marking;
					$tanggal 	= $hasil->tglsurat;
					$nomor 		= $hasil->nomor;
					$anakno 	= $hasil->anakno;
					$status 	= $hasil->status;
					$pembuat 	= $hasil->pembuat;
					$kelompok 	= $hasil->kelompok;
					if ($status == 'MANUAL'){ $tabel = 'MANUAL'; }
					else { $tabel = 'KELUAR'; }
					if ($anakno != 0){ $tlsnomor = $nomor.'.'.$anakno; }
					else { $tlsnomor = $nomor; }
					$ahrf 		= explode("-", $tanggal);
					$yersrt		= $ahrf[0];
					$monsrt		= (int)$ahrf[1];
					$daysrt		= $ahrf[2];
					$bulane		= $arrbulan[$monsrt];
					$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
					$jceksrtinbox	= Inboxsurat::where('pengirim', 'LIKE', $jbtcari)
										->where('marking', $marking)
										->where('jenis', 'KELUAR')
										->count();
					if ($mkelompok == 'Sekretaris' OR $mkelompok == 'Sekretaris Dekan' OR $mkelompok == 'Sekretaris WD I' OR $mkelompok == 'Sekretaris WD II' OR $mkelompok == 'Sekretaris WD III' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR $mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR $mkelompok == 'Sekretaris Rektor' OR $previlage == 'Arsiparis Umum'){ $boleh = 'IYA'; }
					else if ($pembuat == $mnama){ $boleh = 'IYA'; }
					else if ($kelompok == $previlage){ $boleh = 'IYA'; }
					else if ($jceksrtinbox == 0){ $boleh = 'Tidak'; }
					else { $boleh = 'IYA'; }
					$arrayarsipklr[] = array(
						'id' 			=> $hasil->id,
						'marking' 		=> $hasil->marking,
						'tanggal' 		=> $tanggal,
						'tlstgl' 		=> $tglsurat,
						'nomor' 		=> $nomor,
						'anakno' 		=> $anakno,
						'tlsnomor' 		=> $tlsnomor,
						'kodesurat' 	=> $hasil->kodefak,
						'jenissurat' 	=> $hasil->jenissrt,
						'namapemroses' 	=> $hasil->pembuat,
						'unitpemroses' 	=> $hasil->unit,
						'dasarsurat' 	=> $hasil->dasarsurat,
						'perihal' 		=> $hasil->perihal,
						'isisurat' 		=> $hasil->isisurat,
						'tabel' 		=> $tabel,
						'boleh' 		=> $boleh,
					);
				}
			}
			$cekdaftar2		= Suratkeluartnpnomor::where('fakultas', $fakultas)->where('tglbuat', 'LIKE', $setcari)->count();
			if ($cekdaftar2 != 0){
				$rsurat2		= Suratkeluartnpnomor::where('fakultas', $fakultas)->where('tglbuat', 'LIKE', $setcari)->get();
				foreach ($rsurat2 as $hasil) {
					$tanggal 	= $hasil->tglbuat;
					$marking 	= $hasil->marking;
					$nomor 		= '0';
					$anakno 	= '0';
					
					if ($anakno != 0){ $tlsnomor = $nomor.'.'.$anakno; }
					else { $tlsnomor = $nomor; }
					$ahrf 		= explode("-", $tanggal);
					$yersrt		= $ahrf[0];
					$monsrt		= (int)$ahrf[1];
					$daysrt		= $ahrf[2];
					$bulane		= $arrbulan[$monsrt];
					$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
					$jceksrtinbox	= Inboxsurat::where('pengirim', 'LIKE', $jbtcari)
										->where('marking', $marking)
										->where('jenis', 'KELUAR')
										->count();
					
					if ($jceksrtinbox == 0){ $boleh = 'Tidak'; }
					else if ($mkelompok == 'Arsiparis Umum'){ $boleh = 'IYA'; }
					else { $boleh = 'IYA'; }
					$arrayarsipklr[] = array(
						'id' 			=> $hasil->id,
						'tanggal' 		=> $tanggal,
						'tlstgl' 		=> $tglsurat,
						'nomor' 		=> $nomor,
						'anakno' 		=> $anakno,
						'tlsnomor' 		=> $tlsnomor,
						'kodesurat' 	=> $hasil->kodefak,
						'jenissurat' 	=> $hasil->jenissrt,
						'namapemroses' 	=> $hasil->pembuat,
						'unitpemroses' 	=> $hasil->unit,
						'dasarsurat' 	=> $hasil->dasarsurat,
						'perihal' 		=> $hasil->perihal,
						'tabel' 		=> 'KELUARNONOMER',
						'boleh' 		=> $boleh,
					);
				}
			}
		}
    	echo json_encode($arrayarsipklr);	
    }
    public function jsonarsipsrtTugas(Request $request) {
		$arrayarsipklr 	= [];
		$tahun			= date("Y");
		$bulan 			= $request->input('val01');
		$tahun 			= $request->input('val02');
		$jencari 		= $request->input('val03');
		$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$mnama 			= Session('nama');
		$mjabatan 		= Session('jabatan');
		$fakultas		= Session('fakultas');
		$previlage		= Session('previlage');
		
		if ($tahun == ''){ $tahun = date("Y"); }
		if ($bulan == 'ALL'){$setcari = $tahun.'-%';}
		else {$setcari = $tahun.'-'.$bulan.'-%';}
		if ($jencari == 'PERORANG'){
			$sql 		= Penerimasurat::where('fakultas', Session('fakultas'))->where('penulisanbulan', 'LIKE', '%'.$setcari.'%')->groupBy('idpegawai')->orderBy('idpegawai', 'ASC')->get();
		} else if ($jencari == 'PERSURAT') {
			$sql 		= Penerimasurat::where('fakultas', Session('fakultas'))->where('penulisanbulan', 'LIKE', '%'.$setcari.'%')->groupBy('idsurat')->orderBy('idsurat', 'ASC')->get();
		} else {
			$sql 		= Penerimasurat::where('fakultas', Session('fakultas'))->where('penulisanbulan', 'LIKE', '%'.$setcari.'%')->where('idpegawai', $jencari)->orderBy('idsurat', 'ASC')->get();
		}
		if (!empty($sql)){
			foreach ($sql as $rows){
				$idsurat 	= $rows->idsurat;
				$idpegawai	= $rows->idpegawai;
				if ($jencari == 'PERORANG'){
					$poin = Penerimasurat::where('penulisanbulan', 'LIKE', '%'.$setcari.'%')->where('idpegawai', $idpegawai)->where('statusremunerasi', 'Point Remunerasi')->count();
					$koin = Penerimasurat::where('penulisanbulan', 'LIKE', '%'.$setcari.'%')->where('idpegawai', $idpegawai)->where('statusremunerasi', 'Koin')->count();
		
					$arrayarsipklr[] = array(
						'idne' 				=> $rows->id,
						'idsurat' 			=> $idsurat,
						'idpegawai' 		=> $idpegawai,
						'pejabat' 			=> $rows->nama,
						'jabatan' 			=> $rows->jabatan,
						'fakultas' 			=> $rows->penulisan,
						'keterangan'		=> $rows->keterangan,
						'statusremunerasi'	=> $rows->statusremunerasi,
						'bulanstart'		=> $rows->bulanstart,
						'tahunstart'		=> $rows->tahunstart,
						'bulanend'			=> $rows->bulanend,
						'tahunend'			=> $rows->tahunend,
						'penulisanbulan'	=> $rows->penulisanbulan,
						'created_unit'		=> $rows->fakultas,
						'created_by'		=> $rows->created_by,
						'updated_by'		=> $rows->updated_by,
						'status'			=> $rows->status.' On '.$rows->updated_at,
						'koin' 				=> $koin,
						'poin' 				=> $poin,
					);
				} else if ($jencari == 'PERSURAT') {
					$hasil		= Suratkeluar::where('id', $idsurat)->first();
					$penerima 	= Penerimasurat::where('idsurat', $idsurat)->count();
		
					if (isset($hasil->id)){
						$marking 	= $hasil->marking;
						$tanggal 	= $hasil->tglsurat;
						$nomor 		= $hasil->nomor;
						$anakno 	= $hasil->anakno;
						$status 	= $hasil->status;
						$pembuat 	= $hasil->pembuat;
						$kelompok 	= $hasil->kelompok;
						if ($status == 'MANUAL'){ $tabel = 'MANUAL'; }
						else { $tabel = 'KELUAR'; }
						if ($anakno != 0){ $tlsnomor = $nomor.'.'.$anakno; }
						else { $tlsnomor = $nomor; }
						$ahrf 		= explode("-", $tanggal);
						$yersrt		= $ahrf[0];
						$monsrt		= (int)$ahrf[1];
						$daysrt		= $ahrf[2];
						$bulane		= $arrbulan[$monsrt];
						$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
						$boleh 		= 'IYA';
						$arrayarsipklr[] = array(
							'id' 			=> $hasil->id,
							'marking' 		=> $hasil->marking,
							'penerima' 		=> $penerima,
							'tanggal' 		=> $tanggal,
							'tlstgl' 		=> $tglsurat,
							'nomor' 		=> $nomor,
							'anakno' 		=> $anakno,
							'tlsnomor' 		=> $tlsnomor,
							'kodesurat' 	=> $hasil->kodefak,
							'jenissurat' 	=> $hasil->jenissrt,
							'namapemroses' 	=> $hasil->pembuat,
							'unitpemroses' 	=> $hasil->unit,
							'dasarsurat' 	=> $hasil->dasarsurat,
							'perihal' 		=> $hasil->perihal,
							'isisurat' 		=> $hasil->isisurat,
							'tabel' 		=> $tabel,
							'boleh' 		=> $boleh,
						);
					}
				} else {
					$hasil		= Suratkeluar::where('id', $idsurat)->first();
					$penerima 	= Penerimasurat::where('idsurat', $idsurat)->count();
		
					if (isset($hasil->id)){
						$marking 	= $hasil->marking;
						$tanggal 	= $hasil->tglsurat;
						$nomor 		= $hasil->nomor;
						$anakno 	= $hasil->anakno;
						$status 	= $hasil->status;
						$pembuat 	= $hasil->pembuat;
						$kelompok 	= $hasil->kelompok;
						if ($status == 'MANUAL'){ $tabel = 'MANUAL'; }
						else { $tabel = 'KELUAR'; }
						if ($anakno != 0){ $tlsnomor = $nomor.'.'.$anakno; }
						else { $tlsnomor = $nomor; }
						$ahrf 		= explode("-", $tanggal);
						$yersrt		= $ahrf[0];
						$monsrt		= (int)$ahrf[1];
						$daysrt		= $ahrf[2];
						$bulane		= $arrbulan[$monsrt];
						$tglsurat	= $daysrt.' '.$bulane.' '.$yersrt;
						$boleh 		= 'IYA';
						$arrayarsipklr[] = array(
							'id' 			=> $hasil->id,
							'marking' 		=> $hasil->marking,
							'penerima' 		=> $penerima,
							'tanggal' 		=> $tanggal,
							'tlstgl' 		=> $tglsurat,
							'nomor' 		=> $nomor,
							'anakno' 		=> $anakno,
							'tlsnomor' 		=> $tlsnomor,
							'kodesurat' 	=> $hasil->kodefak,
							'jenissurat' 	=> $hasil->jenissrt,
							'namapemroses' 	=> $hasil->pembuat,
							'unitpemroses' 	=> $hasil->unit,
							'dasarsurat' 	=> $hasil->dasarsurat,
							'perihal' 		=> $hasil->perihal,
							'isisurat' 		=> $hasil->isisurat,
							'tabel' 		=> $tabel,
							'boleh' 		=> $boleh,
						);
					}
				} 
			}
		}
		
    	echo json_encode($arrayarsipklr);	
    }
    public function arsipkansrtKeluar(Request $request) {
		$idsurat 	= $request->input('val01');
		$iddispos 	= $request->input('val02');
		$nmlengkap	= Session('nama');
		$dd 	  	= date("d");
		$mm 	  	= date("m");
		$yy 	  	= date("Y");
		$tlstgl		= $yy.'-'.$mm.'-'.$dd;
		Disposisi::where('id', $iddispos)->update([
			'ordner' =>  $tlstgl
		]);
		$cekmarking	= Suratkeluar::where('yersrt', $yy)->orderBy('nomor', 'DESC')->first();
		$marking	= $cekmarking->marking;
		$count	= Inboxsurat::where('marking', $marking)
					->where('penerima', 'Arsiparis Umum')
					->where('jenis', 'KELUAR')
					->count();
		if ($count == 0){
			Inboxsurat::insert([
				'marking'  		=>  $marking,
				'pengirim'  	=>  $nmlengkap,
				'penerima'		=>  'Arsiparis Umum',
				'status'		=>  'send',
				'jenis'			=>  'KELUAR',
				'kerja'			=>  '',
			]);
		}
		if (File::exists(base_path()) ."/public/scan/asli/".$marking.'.pdf') {
			File::delete(base_path() ."/public/scan/asli/".$marking.'.pdf');
		}
		return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Surat di Kirim ke Arsiparis']);
		return back();
    }
	public function arsipfoKerja(Request $request) {
		$homebase		= url("/");
		$kelompok		= Session('jabatan');
		$nmlengkap		= Session('nama');
		$pejabat		= Session('jabatan');
		$kepada   		= '';
		$keterangan 	= '';
		$disposisi 		= '';
		$cekkembar		= '';
		$setdisposisi 	= '';
		$tulisanpenerima= '';
		$idinbox		= $request->input('kerja_idsurat');
		$arrkepada 		= explode(',',$request->input('kepada'));
		if (isset($arrkepada[1])){
			$penerimatunggal = 'no';
		} else {
			$penerimatunggal = 'yes';
		}
		$formDoor 		= $request->input('formDoor');
		$sifatdispo		= $request->input('id_sifatdiposisi');
		$disposisi 		= $request->input('id_disposisi');
		$keterangan		= $request->input('id_catatan');
		
		if ($penerimatunggal == 'yes'){
			$kepada		= $request->input('kepada');
			$getnama 	= Simpegpegawai::where('email_ub', $kepada)->first();
			if (isset($getnama->id)){
				$kepada	= $getnama->nama_lengkap;
			}
			$getnama 	= Pejabatsurat::where('kode', $kepada)->first();
			if (isset($getnama->id)){
				$kepada	= $getnama->pejabat;
			}
		} else {
			if (!empty($arrkepada)){
				foreach ( $arrkepada as $tujuan )
				{
					if ($kepada == ''){ $kepada = $tujuan; }
					else { 
						if ($tujuan == $pejabat OR $tujuan == $kelompok){ 
							$cekkembar = 'Ada';
						} else {
							$getnama 	= Simpegpegawai::where('email_ub', $tujuan)->first();
							if (isset($getnama->id)){
								$tujuan	= $getnama->nama_lengkap;
								$kepada = $kepada.'-'.$tujuan;
							}
							$getnama 	= Pejabatsurat::where('kode', $kepada)->first();
							if (isset($getnama->id)){
								$kepada	= $getnama->pejabat;
								$kepada = $kepada.'-'.$tujuan;
							}
						}
					}
				}
			}
		}

		if (is_array($formDoor)){
			foreach ( $formDoor as $valket )
			{
				if ($valket != ''){
					if ($keterangan == '') {$keterangan = '<ul><li>'.$valket.'</li>';}
					else {$keterangan = $keterangan.'<li>'.$valket.'</li>'; }
				}
			}
			$keterangan = $keterangan.'</ul>';
		} else {
			$keterangan	= $keterangan.'<br />'.$formDoor;
		}
		$namafile 		= '';
		$oklanjut 		= 'NO';
		if ($disposisi == '' and $keterangan != ''){ 
			$setdisposisi = $keterangan; 
		} else if ($disposisi != '' and $keterangan == ''){ 
			$setdisposisi = $disposisi; 
		} else if ($disposisi != '' and $keterangan != ''){ 
			$setdisposisi = $keterangan.'<br />Catatan : '.$disposisi; 
		} else {
			$setdisposisi = $disposisi.$keterangan;
		}
		
		$tanggal	= date("Y-m-d");
		$oklanjut	= '';
		$namafile	= '';
		$fakultas	= Session('fakultas');
		if (Session('fakultas') == null){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Errors!!', 'message' => 'Session Expired']);
			return back();
		} else {
			$kelompok	= $request->input('kelompok');
			if ($request->input('kelompok') == 'Penerima Surat'){
				$update 	= Penerimasurat::where('id', $idinbox)->update([
					'status'			=> $setdisposisi,
					'penulisanbulan'	=> $kepada,
					'updated_at'		=> date("Y-m-d H:i:s")	
				]);
				if ($request->input('tanggal') == 'Pimpinan' OR $kepada != ''){
					$getmailbox 	= Penerimasurat::where('id', $idinbox)->first();
					$jenissrt 		= $getmailbox->jenis;
					$idsurat 		= $getmailbox->idsurat;
					$pembuat 		= $getmailbox->asalsurat;
					$isisrt 		= $getmailbox->tabel;
					$marking 		= '';
					$nomor 			= '';
					$tahunsk 		= date("Y");
					$tglsurat		= $tanggal;
					$perihal		= $getmailbox->perihal;
					$klasifikasi 	= 'Biasa';
					$tulisnomor 	= '';
					$gettanggal 	= explode("-", $tanggal);
					$daysrt			= $gettanggal[2];
					$monsrt			= $gettanggal[1];
					$tahun			= $gettanggal[0];
					$subyek			= '';
					$lampiran		= '';
					$filelampiran	= '';
					$faskode		= '';
					$fasmasa		= '';
					if ($jenissrt == 'KELUAR'){
						$gceksrtklr = Suratkeluar::where('id', $getmailbox->idsurat)->first();
						if (isset($gceksrtklr->marking)){
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
								$tulisnomor = $nomor.'/'.$kodefak.'/'.$unit.'/'.$yersrt;
							} else {
								$tulisnomor = $nomor.'/'.$kodefak.'/'.$faskode.'/'.$yersrt;
							}
						}
					} else if ($jenissrt == 'SKDANPERATURAN'){
						$gceksrtklr = Tabelskdanperaturan::where('id', $getmailbox->idsurat)->first();
						if (isset($gceksrtklr->marking)){
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
						$gceksrtklr = Suratkeluartnpnomor::where('id', $getmailbox->idsurat)->first();
						if (isset($gceksrtklr->marking)){
							$nomor 				= 0;
							$anakno				= 0;
							$kodefak			= $gceksrtklr->kodefak;
							$jenissrt			= $gceksrtklr->jenissrt;
							$unit 				= $gceksrtklr->unit;
							$tglsurat			= $gceksrtklr->tglbuat;
							$klasifikasi 		= $gceksrtklr->klasifikasi;
							$pembuat			= $gceksrtklr->pembuat;
							$perihal 			= $gceksrtklr->perihal;
							$subyek 			= $gceksrtklr->unit;
							$filelampiran		= '';
							$lampiran 			= $gceksrtklr->lampiran;
							$daysrt 			= '';
							$monsrt 			= '';
							$yersrt 			= $gceksrtklr->yersrt;
							$faskode			= $gceksrtklr->faskode;
							$fasmasa			= $gceksrtklr->fasmasa;
							$marking 			= $gceksrtklr->marking;
							$tulisnomor			= $gceksrtklr->id;
						}
					}
					if ($setdisposisi != '' and $idsurat != ''  and $kepada != '') {
						if ($marking == ''){
							if ($penerimatunggal == 'yes'){
								$tujuan		= $request->input('kepada');
								if ($tujuan == 'Arsiparis Umum'){
									//SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
								} else {
									$cekpejabat 	= Pejabatsurat::where('pejabat', $tujuan)->first();
									$cekpejabat2 	= Pejabatsurat::where('id', $tujuan)->first();
									$cekpejabat3 	= Pejabatsurat::where('kode', $tujuan)->first();
									if (isset($cekpejabat->id)){
										$email 			= $cekpejabat->email;
										$namapenerima	= $cekpejabat->nama;
										$jabatan		= $cekpejabat->pejabat;
										$idpenerima		= $cekpejabat->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else if (isset($cekpejabat2->id)){
										$email 			= $cekpejabat2->email;
										$namapenerima	= $cekpejabat2->nama;
										$jabatan		= $cekpejabat2->pejabat;
										$idpenerima		= $cekpejabat2->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else if (isset($cekpejabat3->id)){
										$email 			= $cekpejabat3->email;
										$namapenerima	= $cekpejabat3->nama;
										$jabatan		= $cekpejabat3->pejabat;
										$idpenerima		= $cekpejabat3->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else {
										$getidpeg		= Simpegpegawai::where('email_ub', $tujuan)->orwhere('email', $tujuan)->first();
										if (isset($getidpeg->id)){
											$idpenerima 	= $getidpeg->id;
											$email 			= $getidpeg->email_ub;
											$email2 		= $getidpeg->email;
											$namapenerima	= $getidpeg->nama_lengkap;
											$jabatan		= $getidpeg->jabatan;
											if (is_null($email) OR $email == ''){ $email = $email2; }
										} else {
											$idpenerima 	= 0;
											$email 			= '';
											$namapenerima	= '';
											$jabatan		= '';
										}
									}
									Penerimasurat::insert([
										'asalsurat' => $getmailbox->asalsurat,
										'perihal' 	=> $getmailbox->perihal,
										'idsurat' 	=> $getmailbox->idsurat,
										'jenis'		=> $getmailbox->jenis,
										'keterangan'=> $getmailbox->keterangan,
										'idpegawai'	=> $idpenerima,
										'nama'		=> $namapenerima,
										'jabatan'	=> $jabatan,
										'penulisan'	=> $email,
										'tabel'		=> $getmailbox->tabel,
										'status'	=> 'SEND',
										'fakultas'	=> $getmailbox->fakultas,
										'created_by'=> Session('nama'),
										'updated_by'=> Session('nama'),
									]);
									SendMail::notif($namapenerima,$email,'Surat Dari '.$getmailbox->asalsurat,'Mohon Periksa Di Aplikasi');
								}
							} else {
								foreach ( $arrkepada as $tujuan ){
									if ($tujuan != '' AND $tujuan != $pejabat){
										if ($tujuan == 'Arsiparis Umum'){
											//gakngapa-ngapain
										} else {
											$cekpejabat 	= Pejabatsurat::where('pejabat', $tujuan)->first();
											$cekpejabat2 	= Pejabatsurat::where('id', $tujuan)->first();
											$cekpejabat3 	= Pejabatsurat::where('kode', $tujuan)->first();
											if (isset($cekpejabat->id)){
												$email 			= $cekpejabat->email;
												$namapenerima	= $cekpejabat->nama;
												$jabatan		= $cekpejabat->pejabat;
												$idpenerima		= $cekpejabat->id;
												$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
												if (isset($getidpeg->id)){
													$idpenerima = $getidpeg->id;
												}
											} else if (isset($cekpejabat2->id)){
												$email 			= $cekpejabat2->email;
												$namapenerima	= $cekpejabat2->nama;
												$jabatan		= $cekpejabat2->pejabat;
												$idpenerima		= $cekpejabat2->id;
												$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
												if (isset($getidpeg->id)){
													$idpenerima = $getidpeg->id;
												}
											} else if (isset($cekpejabat3->id)){
												$email 			= $cekpejabat3->email;
												$namapenerima	= $cekpejabat3->nama;
												$jabatan		= $cekpejabat3->pejabat;
												$idpenerima		= $cekpejabat3->id;
												$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
												if (isset($getidpeg->id)){
													$idpenerima = $getidpeg->id;
												}
											} else {
												$getidpeg		= Simpegpegawai::where('email_ub', $tujuan)->orwhere('email', $tujuan)->first();
												if (isset($getidpeg->id)){
													$idpenerima 	= $getidpeg->id;
													$email 			= $getidpeg->email_ub;
													$email2 		= $getidpeg->email;
													$namapenerima	= $getidpeg->nama_lengkap;
													$jabatan		= $getidpeg->jabatan;
													if (is_null($email) OR $email == ''){ $email = $email2; }
												} else {
													$idpenerima 	= 0;
													$email 			= '';
													$namapenerima	= '';
													$jabatan		= '';
												}
											}
											Penerimasurat::insert([
												'asalsurat' => $getmailbox->asalsurat,
												'perihal' 	=> $getmailbox->perihal,
												'idsurat' 	=> $getmailbox->idsurat,
												'jenis'		=> $getmailbox->jenis,
												'keterangan'=> $getmailbox->keterangan,
												'idpegawai'	=> $idpenerima,
												'nama'		=> $namapenerima,
												'jabatan'	=> $jabatan,
												'penulisan'	=> $email,
												'tabel'		=> $getmailbox->tabel,
												'status'	=> 'SEND',
												'fakultas'	=> $getmailbox->fakultas,
												'created_by'=> Session('nama'),
												'updated_by'=> Session('nama'),
											]);
											SendMail::notif($namapenerima,$email,'Surat Dari '.$getmailbox->asalsurat,'Mohon Periksa Di Aplikasi');
										}
									}
								}
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses!!', 'message' => 'Surat Telah Kami Sampaikan Kepada '.$kepada]);
							return back();
						} else {
							$ceksek = Suratmasuk::where('marking', Session('fakultas').'-'.$marking)->count();
							if ($ceksek == 0){
								$getnoagenda 	= Suratmasuk::where('fakultas', Session('fakultas'))->where('yersrt', date("Y"))->orderBy('noagenda', 'DESC')->first();
								if (isset($getnoagenda->noagenda)){
									$noagenda 	= $getnoagenda->noagenda;
									$noagenda	= $noagenda + 1;
								} else { $noagenda = 1; }
								$idne 		= Suratmasuk::insertGetId([
									'marking' 		=>  Session('fakultas').'-'.$marking,
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
									'scansurat' 	=>  $marking.'.pdf',
									'sifat' 		=>  'Biasa',
									'bentuk' 		=>  Session('namaapps01'),
									'klasifikasi' 	=>  'Biasa',
									'pembuat' 		=>  Session('email'),
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
								$marking 		= Session('fakultas').'-'.$marking;
							} else {
								$getidsrtmasuk 	= Suratmasuk::where('marking', 'LIKE', Session('fakultas').'-'.$marking)->first();
								$idne 			= $getidsrtmasuk->id;
								$marking 		= $getidsrtmasuk->marking;
							}
							if ($request->hasFile('file')) {
								$namafile		= $idne.'-'.time().'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								$uploadedFile->move(public_path('scan/files'), $namafile);
								if ($lampiran == ''){
									Suratmasuk::where('marking', $marking)->update([
										'lampiran' => $namafile
									]);
								}
							}
							
							if ($penerimatunggal == 'yes'){
								$tujuan		= $request->input('kepada');
								if ($tujuan == 'Arsiparis Umum'){
									$tulisanpenerima = 'Arsiparis';
									SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
								} else {
									$cekpejabat 	= Pejabatsurat::where('pejabat', $tujuan)->first();
									$cekpejabat2 	= Pejabatsurat::where('id', $tujuan)->first();
									$cekpejabat3 	= Pejabatsurat::where('kode', $tujuan)->first();
									if (isset($cekpejabat->id)){
										$email 			= $cekpejabat->email;
										$namapenerima	= $cekpejabat->nama;
										$jabatan		= $cekpejabat->pejabat;
										$idpenerima		= $cekpejabat->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else if (isset($cekpejabat2->id)){
										$email 			= $cekpejabat2->email;
										$namapenerima	= $cekpejabat2->nama;
										$jabatan		= $cekpejabat2->pejabat;
										$idpenerima		= $cekpejabat2->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else if (isset($cekpejabat3->id)){
										$email 			= $cekpejabat3->email;
										$namapenerima	= $cekpejabat3->nama;
										$jabatan		= $cekpejabat3->pejabat;
										$idpenerima		= $cekpejabat3->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else {
										$getidpeg		= Simpegpegawai::where('email_ub', $tujuan)->orwhere('email', $tujuan)->first();
										if (isset($getidpeg->id)){
											$idpenerima 	= $getidpeg->id;
											$email 			= $getidpeg->email_ub;
											$email2 		= $getidpeg->email;
											$namapenerima	= $getidpeg->nama_lengkap;
											$jabatan		= $getidpeg->jabatan;
											if (is_null($email) OR $email == ''){ $email = $email2; }
										} else {
											$idpenerima 	= 0;
											$email 			= '';
											$namapenerima	= '';
											$jabatan		= '';
										}
									}
									$tulisanpenerima= $namapenerima;
									if ($email != ''){
										SendMail::kiriminbox($marking,$nmlengkap,$jabatan,$email,'MASUK','DISPOSISI',$setdisposisi,'0');
									} else {
										SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
									}
								}
							} else {
								foreach ( $arrkepada as $tujuan ){
									if ($tujuan != '' AND $tujuan != $pejabat){
										if ($tujuan == 'Arsiparis Umum'){
											$tulisanpenerima= $tulisanpenerima.' Arsiparis;';
											SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
										} else {
											$cekpejabat 	= Pejabatsurat::where('pejabat', $tujuan)->first();
											$cekpejabat2 	= Pejabatsurat::where('id', $tujuan)->first();
											$cekpejabat3 	= Pejabatsurat::where('kode', $tujuan)->first();
											if (isset($cekpejabat->id)){
												$email 			= $cekpejabat->email;
												$namapenerima	= $cekpejabat->nama;
												$jabatan		= $cekpejabat->pejabat;
												$idpenerima		= $cekpejabat->id;
												$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
												if (isset($getidpeg->id)){
													$idpenerima = $getidpeg->id;
												}
											} else if (isset($cekpejabat2->id)){
												$email 			= $cekpejabat2->email;
												$namapenerima	= $cekpejabat2->nama;
												$jabatan		= $cekpejabat2->pejabat;
												$idpenerima		= $cekpejabat2->id;
												$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
												if (isset($getidpeg->id)){
													$idpenerima = $getidpeg->id;
												}
											} else if (isset($cekpejabat3->id)){
												$email 			= $cekpejabat3->email;
												$namapenerima	= $cekpejabat3->nama;
												$jabatan		= $cekpejabat3->pejabat;
												$idpenerima		= $cekpejabat3->id;
												$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
												if (isset($getidpeg->id)){
													$idpenerima = $getidpeg->id;
												}
											} else {
												$getidpeg		= Simpegpegawai::where('email_ub', $tujuan)->orwhere('email', $tujuan)->first();
												if (isset($getidpeg->id)){
													$idpenerima 	= $getidpeg->id;
													$email 			= $getidpeg->email_ub;
													$email2 		= $getidpeg->email;
													$namapenerima	= $getidpeg->nama_lengkap;
													$jabatan		= $getidpeg->jabatan;
													if (is_null($email) OR $email == ''){ $email = $email2; }
												} else {
													$idpenerima 	= 0;
													$email 			= '';
													$namapenerima	= '';
													$jabatan		= '';
												}
											}
											$tulisanpenerima= $tulisanpenerima.' '.$namapenerima.';';
											if ($email != ''){
												SendMail::kiriminbox($marking,$nmlengkap,$jabatan,$email,'MASUK','DISPOSISI',$setdisposisi,'0');
											} else {
												SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
											}
										}
									}
								}
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses!!', 'message' => 'Disposisi Telah Kami Sampaikan Kepada '.$tulisanpenerima]);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Errors!!', 'message' => 'Mohon Mengisi Form Disposisi Secara Lengkap, Pastikan Tujuan ('.$kepada.') dan Isi disposisi ('.$setdisposisi.') sudah terisi '.$idsurat]);
						return back();
					}
				}
			} else {
				$getdata 	= Inboxsurat::where('id', $idinbox)->first();
				if (isset($getdata->id)){
					$update 	= Inboxsurat::where('email', $getdata->email)->where('marking', $getdata->marking)->update([
						'status'	=> 'reply',
						'kepada'	=> $kepada,
						'updated_at'=> date("Y-m-d H:i:s")
					]);
					$jceksrtmsk		= Suratmasuk::where('marking', $getdata->marking)->first();
					if ($setdisposisi != '' and $kelompok != '') {
						if ($request->hasFile('file')) {
							$namafile		= $idinbox.'-'.time().'.'.$request->file->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							$uploadedFile->move(public_path('scan/files'), $namafile);
							Inboxsurat::where('id', $idinbox)->update([
								'lampiran' 	=> $namafile,
							]);
							$setdisposisi 	= $setdisposisi.'<blockquote><p>Lampiran File :</p><a href="'.$homebase.'/scan/files/'.$namafile.'" target="_blank">Download File Lampiran</a></blockquote>';
						}
						$marking = $getdata->marking;
						if ($penerimatunggal == 'yes'){
							$tujuan		= $request->input('kepada');
							if ($tujuan != '' AND $tujuan != $pejabat){
								if ($tujuan == 'Arsiparis Umum'){
									$tulisanpenerima = 'Arsiparis';
									SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
								} else {
									$cekpejabat 	= Pejabatsurat::where('pejabat', $tujuan)->first();
									$cekpejabat2 	= Pejabatsurat::where('id', $tujuan)->first();
									$cekpejabat3 	= Pejabatsurat::where('kode', $tujuan)->first();
									if (isset($cekpejabat->id)){
										$email 			= $cekpejabat->email;
										$namapenerima	= $cekpejabat->nama;
										$jabatan		= $cekpejabat->pejabat;
										$idpenerima		= $cekpejabat->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else if (isset($cekpejabat2->id)){
										$email 			= $cekpejabat2->email;
										$namapenerima	= $cekpejabat2->nama;
										$jabatan		= $cekpejabat2->pejabat;
										$idpenerima		= $cekpejabat2->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else if (isset($cekpejabat3->id)){
										$email 			= $cekpejabat3->email;
										$namapenerima	= $cekpejabat3->nama;
										$jabatan		= $cekpejabat3->pejabat;
										$idpenerima		= $cekpejabat3->id;
										$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
										if (isset($getidpeg->id)){
											$idpenerima = $getidpeg->id;
										}
									} else {
										$getidpeg		= Simpegpegawai::where('email_ub', $tujuan)->orwhere('email', $tujuan)->first();
										if (isset($getidpeg->id)){
											$idpenerima 	= $getidpeg->id;
											$email 			= $getidpeg->email_ub;
											$email2 		= $getidpeg->email;
											$namapenerima	= $getidpeg->nama_lengkap;
											$jabatan		= $getidpeg->jabatan;
											if (is_null($email) OR $email == ''){ $email = $email2; }
										} else {
											$idpenerima 	= 0;
											$email 			= '';
											$namapenerima	= '';
											$jabatan		= '';
										}
									}
									$tulisanpenerima = $namapenerima;
									if ($email != ''){
										SendMail::kiriminbox($marking,$getdata->penerima,$jabatan,$email,'MASUK','DISPOSISI',$setdisposisi,$idinbox);
									} else {
										SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
									}
								}
							}
						} else {
							foreach ( $arrkepada as $tujuan ){
								if ($tujuan != '' AND $tujuan != $pejabat){
									if ($tujuan == 'Arsiparis Umum'){
										$tulisanpenerima = $tulisanpenerima.' Arsiparis;';
										SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
									} else {
										$cekpejabat 	= Pejabatsurat::where('pejabat', $tujuan)->first();
										$cekpejabat2 	= Pejabatsurat::where('id', $tujuan)->first();
										$cekpejabat3 	= Pejabatsurat::where('kode', $tujuan)->first();
										if (isset($cekpejabat->id)){
											$email 			= $cekpejabat->email;
											$namapenerima	= $cekpejabat->nama;
											$jabatan		= $cekpejabat->pejabat;
											$idpenerima		= $cekpejabat->id;
											$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
											if (isset($getidpeg->id)){
												$idpenerima = $getidpeg->id;
											}
										} else if (isset($cekpejabat2->id)){
											$email 			= $cekpejabat2->email;
											$namapenerima	= $cekpejabat2->nama;
											$jabatan		= $cekpejabat2->pejabat;
											$idpenerima		= $cekpejabat2->id;
											$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
											if (isset($getidpeg->id)){
												$idpenerima = $getidpeg->id;
											}
										} else if (isset($cekpejabat3->id)){
											$email 			= $cekpejabat3->email;
											$namapenerima	= $cekpejabat3->nama;
											$jabatan		= $cekpejabat3->pejabat;
											$idpenerima		= $cekpejabat3->id;
											$getidpeg		= Simpegpegawai::where('email_ub', $email)->orwhere('email', $email)->first();
											if (isset($getidpeg->id)){
												$idpenerima = $getidpeg->id;
											}
										} else {
											$getidpeg		= Simpegpegawai::where('email_ub', $tujuan)->orwhere('email', $tujuan)->first();
											if (isset($getidpeg->id)){
												$idpenerima 	= $getidpeg->id;
												$email 			= $getidpeg->email_ub;
												$email2 		= $getidpeg->email;
												$namapenerima	= $getidpeg->nama_lengkap;
												$jabatan		= $getidpeg->jabatan;
												if (is_null($email) OR $email == ''){ $email = $email2; }
											} else {
												$idpenerima 	= 0;
												$email 			= '';
												$namapenerima	= '';
												$jabatan		= '';
											}
										}
										$tulisanpenerima = $tulisanpenerima.' '.$namapenerima.';';
										if ($email != ''){
											SendMail::kiriminbox($marking,$getdata->penerima,$jabatan,$email,'MASUK','DISPOSISI',$setdisposisi,$idinbox);
										} else {
											SendMail::kiriminbox($marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
										}
									}
								}
							}
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses!!', 'message' => 'Disposisi Telah Kami Sampaikan Kepada '.$tulisanpenerima]);
						return back();
					} else {
						if (isset($jceksrtmsk->id)){
							$noagenda		= $jceksrtmsk->marking;
							$tglmasuk		= $jceksrtmsk->tglmasuk;
							SendMail::kiriminbox($jceksrtmsk->marking,Session('nama'),'Arsiparis','arsiparis@localhost.com','MASUK','DISPOSISI',$setdisposisi,'0');
						}
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses!!', 'message' => 'Mailbox Telah kami arsipkan']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Errors!!', 'message' => 'Sistem Down, Please Try Again After Refresh This Pages']);
							return back();
						}
					}
				} else {
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses!!', 'message' => 'Mailbox Telah kami arsipkan']);
					return back();
				}
			}
		}
    }
	public function arsipFo(Request $request) {
		$kelompok	= Session('jabatan');
		$nmlengkap	= Session('nama');
		$idinbox	= $request->input('val01');
		$tanggal	= $request->input('val02');
		$keterangan	= $request->input('val03');
		if ($keterangan == 'arsipsuratkeluar'){
			if ($tanggal == 'KELUAR'){
				$update 	= Suratkeluar::where('id', $idinbox)->update([
					'status' 	=> 'arsip',
					'arsip' 	=>  date("Y-m-d"),
				]);
			} else if ($tanggal == 'skdanperaturan'){
				$update 		= Tabelskdanperaturan::where('id', $idinbox)->update([
					'inputor' 	=> Session('nama'),
					'catatan'	=> 'arsip',
					'updated_at'=> date("Y-m-d H:i:s")
				]);
			} else {
				$update 	= Suratkeluartnpnomor::where('id', $idinbox)->update([
					'status' 		=> 'arsip',
					'arsip' 		=>  date("Y-m-d"),
					'updated_at' 	=>  date("Y-m-d H:i:s"),
				]);
				$getsurat = Suratkeluartnpnomor::where('id', $idinbox)->first();
				if (isset($getsurat->marking)){
					Inboxsurat::where('marking', $getsurat->marking)->update([
						'status'	=> 'reply'
					]);
				}
			}
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Archieved']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
				return back();
			}
		} else {
			$jinboxsrt	= Inboxsurat::where('id', $idinbox)->first();
			if (isset($jinboxsrt->marking)){
				$marking	= $jinboxsrt->marking;
				$jenis		= $jinboxsrt->jenis;
				$penerima	= $jinboxsrt->penerima;
				$update 	= Inboxsurat::where('penerima', $penerima)->where('marking', $marking)->update([
					'status' =>  'reply',
					'tanggal' =>  $tanggal
				]);
				if (File::exists(base_path()) ."/public/scan/asli/".$marking.'.pdf') {
					File::delete(base_path() ."/public/scan/asli/".$marking.'.pdf');
				}
				if ($update){
					if ($keterangan != ''){			
						if ($jenis == 'MASUK'){
							$jsrtmasuk	= Suratmasuk::where('marking', $marking)->first();
							$idne		= $jsrtmasuk->id;
							$subyek		= $jsrtmasuk->status;
							Disposisi::insert([
								'idsurat'  		=>  $idne,
								'pemberi'  		=>  $nmlengkap,
								'isidisposisi'	=>  $keterangan,
								'kepada'		=>  'Arsiparis',
								'keterangan'	=>  'Surat Masuk',
							]);
							
							$count	= Inboxsurat::where('marking', $marking)
										->where('penerima', 'Arsiparis Umum')
										->where('jenis', 'MASUK')
										->count();
							if ($count == 0){
								Inboxsurat::insert([
									'marking'  		=>  $marking,
									'pengirim'  	=>  $penerima,
									'penerima'		=>  'Arsiparis Umum',
									'status'		=>  'send',
									'jenis'			=>  'MASUK',
									'kerja'			=>  'DISPOSISI',
								]);
							}
							Suratmasuk::where('id', $idne)->update([
								'status' 	=> 'arsip'
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Marking Terlaksana, Sukses diberikan']);
						return back();
					} else {
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Marking Terlaksana, Sukses diberikan']);
						return back();
					}
				}
			} else {
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'ID '.$idinbox.' Tidak ditemukan']);
				return back();
			}
		}
    }
	public function exArsiparis(Request $request) {
		$kelompok	= Session('jabatan');
		$nmlengkap	= Session('nama');
		$jenis		= $request->input('val01');
		$idne		= $request->input('val02');
		$ruang		= $request->input('val03');
		$ordner		= $request->input('val04');
		$lemari		= $request->input('val05');
		$kerja		= $request->input('val06');
		$ket		= $request->input('val07');
		$kodefas	= $request->input('val08');
		$dasarsurat	= '';
		$skrg		= date("Y-m-d h:i:sa");
		$arsipka	= 'Diarsip '.$nmlengkap.' Tgl : '.$skrg;
		if ($ket != ''){ $arsipka = $arsipka.' Ket. : '.$ket; }
		$getklasifikasi = Klasifikasi::where('kodesurat', 'LIKE', $kodefas.'%')->first();
		if (isset($getklasifikasi->kodesurat)){
			$kode			= $getklasifikasi->kodesurat;
			$klasifikasi	= $getklasifikasi->klasifikasi;
			$aktif			= $getklasifikasi->aktif;
			$keterangan		= $getklasifikasi->keterangan;
		} else {
			$kode			= '';
		}
		if ($kode != '' AND $ruang != '' AND $lemari != '' AND $ordner != ''){
			if ($idne == 'multi'){
				$arridsrt 	= $request->input('val09');
				$sukses 	= 0;
				$error 		= '';
				if ($jenis == 'KELUAR'){
					foreach ( $arridsrt as $idne ){
						$update = Suratkeluar::where('id', $idne)->update([
							'arsip' 		=>  $arsipka,
							'ruangarsip' 	=>  $ruang,
							'ordnerarsip' 	=>  $ordner,
							'lemariarsip' 	=>  $lemari,
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  $aktif,
							'fasket' 		=>  $keterangan,
						]);
						if ($update){
							$getolddata	= Suratkeluar::where('id', $idne)->first();
							$tglbuat 	= $getolddata->created_at;
							$tglubah	= $getolddata->updated_at;					
							Arsipsurat::create([
								'tabel'			=> 'Surat Keluar', 
								'idne'			=> $idne, 
								'jenis'			=> $klasifikasi, 
								'kode'			=> $kode, 
								'durasi'		=> $aktif,
								'ruang' 		=> $ruang,
								'ordner' 		=> $ordner,
								'lemari' 		=> $lemari,
								'keterangan'	=> 'Aktif',
								'arsiparis' 	=> Session('nama'), 
								'fakultas'		=> Session('fakultas'),
								'created_at'	=> $tglbuat,
								'updated_at'	=> $tglubah
							]);
							$sukses++;
						} else{
							$error = $error.' ID '.$idne.' Gagal di Update<br />';
						}
					}
				} else if ($jenis == 'KELUARNONOMER'){
					foreach ( $arridsrt as $idne ){
						$update = Suratkeluartnpnomor::where('id', $idne)->update([
							'arsip' 		=>  $arsipka,
							'ruangarsip' 	=>  $ruang,
							'ordnerarsip' 	=>  $ordner,
							'lemariarsip' 	=>  $lemari,
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  $aktif,
							'fasket' 		=>  $keterangan,
						]);
						if ($update){
							$getolddata	= Suratkeluartnpnomor::where('id', $idne)->first();
							$tglbuat 	= $getolddata->created_at;
							$tglubah	= $getolddata->updated_at;
							Arsipsurat::create([
								'tabel'			=> 'Surat Keluar Tanpa Nomor', 
								'idne'			=> $idne, 
								'jenis'			=> $klasifikasi, 
								'kode'			=> $kode, 
								'durasi'		=> $aktif,
								'ruang' 		=> $ruang,
								'ordner' 		=> $ordner,
								'lemari' 		=> $lemari,
								'keterangan'	=> 'Aktif',
								'arsiparis' 	=> Session('nama'), 
								'fakultas'		=> Session('fakultas'),
								'created_at'	=> $tglbuat,
								'updated_at'	=> $tglubah
								
							]);
							$sukses++;
						} else{
							$error = $error.' ID '.$idne.' Gagal di Update<br />';
						}
					}
				} else if ($jenis == 'SKPP'){
					foreach ( $arridsrt as $idne ){
						$update = Tabelskdanperaturan::where('id', $idne)->update([
							'kodefas' 		=>  $kodefas,
							'arsip' 		=> 'arsip'
						]);
						if ($update){
							$getolddata	= Tabelskdanperaturan::where('id', $idne)->first();
							$tglbuat 	= $getolddata->created_at;
							$tglubah	= $getolddata->updated_at;
							Arsipsurat::create([
								'tabel'			=> 'SK dan Peraturan', 
								'idne'			=> $idne, 
								'jenis'			=> $klasifikasi, 
								'kode'			=> $kode, 
								'durasi'		=> $aktif,
								'ruang' 		=> $ruang,
								'ordner' 		=> $ordner,
								'lemari' 		=> $lemari,
								'keterangan'	=> 'Aktif',
								'arsiparis' 	=> Session('nama'), 
								'fakultas'		=> Session('fakultas'),
								'created_at'	=> $tglbuat,
								'updated_at'	=> $tglubah
							]);
							$sukses++;
						} else{
							$error = $error.' ID '.$idne.' Gagal di Update<br />';
						}
					}
				} else {
					foreach ( $arridsrt as $idne ){
						$update = Suratmasuk::where('id', $idne)->update([
								'arsip' 		=>  $arsipka,
								'ruangarsip' 	=>  $ruang,
								'ordnerarsip' 	=>  $ordner,
								'lemariarsip' 	=>  $lemari,
								'faskode' 		=>  $kodefas,
								'fasmasa' 		=>  $aktif,
								'fasket' 		=>  $keterangan,
							]);
						if ($update){
							$getolddata	= Suratmasuk::where('id', $idne)->first();
							$tglbuat 	= $getolddata->created_at;
							$tglubah	= $getolddata->updated_at;
							$marking	= $getolddata->marking;
							Arsipsurat::create([
								'tabel'			=> 'Surat Masuk', 
								'idne'			=> $idne, 
								'jenis'			=> $klasifikasi, 
								'kode'			=> $kode, 
								'durasi'		=> $aktif,
								'ruang' 		=> $ruang,
								'ordner' 		=> $ordner,
								'lemari' 		=> $lemari,
								'keterangan'	=> 'Aktif',
								'arsiparis' 	=> Session('nama'), 
								'fakultas'		=> Session('fakultas'),
								'created_at'	=> $tglbuat,
								'updated_at'	=> $tglubah
							]);
							$sukses++;
						} else{
							$error = $error.' ID '.$idne.' Gagal di Update<br />';
						}
					}
				}
				return response()->json(['status' => 'Info', 'message' => 'Sukses Update Sejumlah '.$sukses.'<br />'.$error]);
				return back();
			} else {
				$nomoragenda	= $request->input('val06');
				$tahunagenda	= $request->input('val09');
				$ceksek 		= Suratmasuk::where('fakultas', Session('fakultas'))->where('noagenda', $nomoragenda)->where('yersrt', $tahunagenda)->first();
				if (isset($ceksek->scansurat)){
					$dasarsurat = $ceksek->scansurat;
				}
				if ($jenis == 'keluar' OR $jenis == 'KELUAR'){
					if ($dasarsurat == ''){
						$update = Suratkeluar::where('id', $idne)->update([
							'arsip' 		=>  $arsipka,
							'ruangarsip' 	=>  $ruang,
							'ordnerarsip' 	=>  $ordner,
							'lemariarsip' 	=>  $lemari,
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  $aktif,
							'fasket' 		=>  $keterangan,
						]);
					} else {
						$update = Suratkeluar::where('id', $idne)->update([
							'dasarsurat'	=> 	$dasarsurat,
							'arsip' 		=>  $arsipka,
							'ruangarsip' 	=>  $ruang,
							'ordnerarsip' 	=>  $ordner,
							'lemariarsip' 	=>  $lemari,
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  $aktif,
							'fasket' 		=>  $keterangan,
						]);
					}
					if ($update){
						$getolddata	= Suratkeluar::where('id', $idne)->first();
						$tglbuat 	= $getolddata->created_at;
						$tglubah	= $getolddata->updated_at;					
						Arsipsurat::create([
							'tabel'			=> 'Surat Keluar', 
							'idne'			=> $idne, 
							'jenis'			=> $klasifikasi, 
							'kode'			=> $kode, 
							'durasi'		=> $aktif,
							'ruang' 		=> $ruang,
							'ordner' 		=> $ordner,
							'lemari' 		=> $lemari,
							'keterangan'	=> 'Aktif',
							'arsiparis' 	=> Session('nama'), 
							'fakultas'		=> Session('fakultas'),
							'created_at'	=> $tglbuat,
							'updated_at'	=> $tglubah
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
						return back();
					}
					else{
						return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
						return back();
					}
				} else if ($jenis == 'keluarnonomor' OR $jenis == 'KELUARNONOMER'){
					if ($dasarsurat == ''){
						$update = Suratkeluartnpnomor::where('id', $idne)->update([
							'arsip' 		=>  $arsipka,
							'ruangarsip' 	=>  $ruang,
							'ordnerarsip' 	=>  $ordner,
							'lemariarsip' 	=>  $lemari,
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  $aktif,
							'fasket' 		=>  $keterangan,
						]);
					} else {
						$update = Suratkeluartnpnomor::where('id', $idne)->update([
							'dasarsurat'	=> 	$dasarsurat,
							'arsip' 		=>  $arsipka,
							'ruangarsip' 	=>  $ruang,
							'ordnerarsip' 	=>  $ordner,
							'lemariarsip' 	=>  $lemari,
							'faskode' 		=>  $kodefas,
							'fasmasa' 		=>  $aktif,
							'fasket' 		=>  $keterangan,
						]);
					}
					if ($update){
						$getolddata	= Suratkeluartnpnomor::where('id', $idne)->first();
						$tglbuat 	= $getolddata->created_at;
						$tglubah	= $getolddata->updated_at;
						
						Arsipsurat::create([
							'tabel'			=> 'Surat Keluar Tanpa Nomor', 
							'idne'			=> $idne, 
							'jenis'			=> $klasifikasi, 
							'kode'			=> $kode, 
							'durasi'		=> $aktif,
							'ruang' 		=> $ruang,
							'ordner' 		=> $ordner,
							'lemari' 		=> $lemari,
							'keterangan'	=> 'Aktif',
							'arsiparis' 	=> Session('nama'), 
							'fakultas'		=> Session('fakultas'),
							'created_at'	=> $tglbuat,
							'updated_at'	=> $tglubah
							
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
						return back();
					}
					else{
						return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
						return back();
					}
				} else if ($jenis == 'draftsk'){
					$update = Draftsk::where('id', $idne)->update([
						'arsip' 		=>  '1',
					]);
					if ($update){
						$getolddata	= Draftsk::where('id', $idne)->first();
						$tglbuat 	= $getolddata->created_at;
						$tglubah	= $getolddata->updated_at;
						
						Arsipsurat::create([
							'tabel'			=> 'Draft SK', 
							'idne'			=> $idne, 
							'jenis'			=> $klasifikasi, 
							'kode'			=> $kode, 
							'durasi'		=> $aktif,
							'ruang' 		=> $ruang,
							'ordner' 		=> $ordner,
							'lemari' 		=> $lemari,
							'keterangan'	=> 'Aktif',
							'arsiparis' 	=> Session('nama'), 
							'fakultas'		=> Session('fakultas'),
							'created_at'	=> $tglbuat,
							'updated_at'	=> $tglubah
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
						return back();
					}
					else{
						return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
						return back();
					}
				} else if ($jenis == 'skdanperaturan' OR $jenis == 'SKPP'){
					if ($dasarsurat == ''){
						$update = Tabelskdanperaturan::where('id', $idne)->update([
							'kodefas' 		=>  $kodefas,
							'arsip' 		=> 'arsip'
						]);
					} else {
						$update = Tabelskdanperaturan::where('id', $idne)->update([
							'dasarsurat'	=> 	$dasarsurat,
							'kodefas' 		=>  $kodefas,
							'arsip' 		=> 'arsip'
						]);	
					}
					if ($update){
						$getolddata	= Tabelskdanperaturan::where('id', $idne)->first();
						$tglbuat 	= $getolddata->created_at;
						$tglubah	= $getolddata->updated_at;
						
						Arsipsurat::create([
							'tabel'			=> 'SK dan Peraturan', 
							'idne'			=> $idne, 
							'jenis'			=> $klasifikasi, 
							'kode'			=> $kode, 
							'durasi'		=> $aktif,
							'ruang' 		=> $ruang,
							'ordner' 		=> $ordner,
							'lemari' 		=> $lemari,
							'keterangan'	=> 'Aktif',
							'arsiparis' 	=> Session('nama'), 
							'fakultas'		=> Session('fakultas'),
							'created_at'	=> $tglbuat,
							'updated_at'	=> $tglubah
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
						return back();
					}
					else{
						return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
						return back();
					}
				} else if ($jenis == 'oper'){
					$jinboxsrt	= Inboxsurat::where('id', $idinbox)->first();
					$marking	= $jinboxsrt->marking;
					$jenis		= $jinboxsrt->jenis;
					$penerimalws= $jinboxsrt->penerima;
					$operkan 	= Inboxsurat::where('id', $idinbox)->update([
									'penerima' 	=>  $kode,
									'catatan' 	=>  $ordner,
								]);
					
					if ($operkan){
						Disposisi::where('idsurat', $idne)->where('kepada', $penerimalws)->update(['kepada'	=> $kode]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Operkan Kepada '.$kode.' Dengan Catatan '.$ordner]);
						return back();

					}
					else{
						return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
						return back();
					}
				} else {
					if ($kerja == 'editorarsip'){
						$update = Arsipsurat::where('id', $jenis)->update([
							'jenis'			=> $ket,
							'kode'			=> $kode, 
							'durasi'		=> $aktif,
							'ruang' 		=> $ruang,
							'ordner' 		=> $ordner,
							'lemari' 		=> $lemari,
						]);
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Updated ID '.$jenis]);
							return back();
						}
						else{
							return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
							return back();
						}
					} else {
						$update = Suratmasuk::where('id', $idne)->update([
								'arsip' 		=>  $arsipka,
								'ruangarsip' 	=>  $ruang,
								'ordnerarsip' 	=>  $ordner,
								'lemariarsip' 	=>  $lemari,
								'faskode' 		=>  $kodefas,
								'fasmasa' 		=>  $aktif,
								'fasket' 		=>  $keterangan,
							]);
						if ($update){
							$getolddata	= Suratmasuk::where('id', $idne)->first();
							$tglbuat 	= $getolddata->created_at;
							$tglubah	= $getolddata->updated_at;
							$marking	= $getolddata->marking;
							
							Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->update([
								'status' 	=>  'reply',
							]);
							
							
							Arsipsurat::create([
								'tabel'			=> 'Surat Masuk', 
								'idne'			=> $idne, 
								'jenis'			=> $klasifikasi, 
								'kode'			=> $kode, 
								'durasi'		=> $aktif,
								'ruang' 		=> $ruang,
								'ordner' 		=> $ordner,
								'lemari' 		=> $lemari,
								'keterangan'	=> 'Aktif',
								'arsiparis' 	=> Session('nama'), 
								'fakultas'		=> Session('fakultas'),
								'created_at'	=> $tglbuat,
								'updated_at'	=> $tglubah
							]);
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
							return back();
						}
						else{
							return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
							return back();
						}
					}
				}
			}
		} else {
			return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi ']);
			return back();
		}
    }
	public function exAddArsipManual(Request $request) {
		$kelompok	= Session('jabatan');
		$nmlengkap	= Session('nama');
		$fakultas	= Session('fakultas');
		$jenis		= $request->input('val01');
		$nomor		= $request->input('val02');
		$ruang		= $request->input('val03');
		$ordner		= $request->input('val04');
		$lemari		= $request->input('val05');
		$tanggal	= $request->input('val06');
		$perihal	= $request->input('val07');
		$kodefas	= $request->input('val08');
		$ket		= $request->input('val09');
		$ceksek 	= explode(".", $nomor);
		$cektgl 	= explode("-", $tanggal);
		if (isset($ceksek[1])){
			$anakno = $ceksek[1];
			$nomor 	= (int)$ceksek[0];
		} else {
			$nomor 	= (int)$nomor;
			$anakno	= '';
		}
		if (isset($cektgl[2])){
			$yersrt = $cektgl[0];
			$monsrt = $cektgl[1];
			$daysrt = $cektgl[2];
		} else {
			$yersrt = date("Y");
			$monsrt = date("m");
			$daysrt = date("d");
		}
		$skrg		= date("Y-m-d h:i:sa");
		$tglbuat 	= $tanggal.' '.date("H:i:s");
		$tglubah	= $tanggal.' '.date("H:i:s");
		$arsipka	= 'Diarsip '.$nmlengkap.' Tgl : '.$skrg;
		if ($ket != ''){ $arsipka = $arsipka.' Ket. : '.$ket; }
		$getklasifikasi = Klasifikasi::where('kodesurat', 'LIKE', $kodefas.'%')->first();
		if (isset($getklasifikasi->kodesurat)){
			$kode			= $getklasifikasi->kodesurat;
			$klasifikasi	= $getklasifikasi->klasifikasi;
			$aktif			= $getklasifikasi->aktif;
			$keterangan		= $getklasifikasi->keterangan;
		} else {
			$kode			= '';
		}
		$getkodefak = Pejabatsurat::where('fakultas', $fakultas)->orderBy('kode', 'ASC')->first();
		if (isset($getkodefak->kode)){
			$kodefak 	= $getkodefak->kode;
			$idpejabat	= $getkodefak->id;
			$pejabat	= $getkodefak->pejabat;
			$namapejabat= $getkodefak->nama;
			$nippejabat	= $getkodefak->nip;
		} else {
			$kodefak 	= 'UN10';
			$idpejabat	= '1';
			$pejabat	= 'Rektor';
			$namapejabat= '';
			$nippejabat	= '';
		}
		if ($kode != '' AND $ruang != '' AND $lemari != '' AND $ordner != ''){
			if ($jenis == 'keluar' OR $jenis == 'KELUAR'){
				if ($anakno == ''){
					$ceksek = Suratkeluar::where('fakultas', $fakultas)->where('nomor', $nomor)->where('yersrt', $yersrt)->first();
				} else {
					$ceksek = Suratkeluar::where('fakultas', $fakultas)->where('nomor', $nomor)->where('anakno', $anakno)->where('yersrt', $yersrt)->first();
				}
				if (isset($ceksek->id)){
					$idne			= $ceksek->id;
					$marking		= $ceksek->marking;
					$uploadedFile 	= $request->file('file');
					$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
					$update = Suratkeluar::where('id', $ceksek->id)->update([
						'jenissrt' 		=>  'MANUAL',
						'tglsurat' 		=>  $tanggal,
						'daysrt' 		=>  $daysrt,
						'monsrt' 		=>  $monsrt,
						'yersrt' 		=>  $yersrt,
						'perihal' 		=>  $perihal,
						'isisurat' 		=>  $marking.'.pdf',
						'pembuat' 		=>  Session('nama'),
						'kelompok' 		=>  Session('previlage'),
						'status' 		=>  'arsip',
						'arsip' 		=>  $arsipka,
						'ruangarsip' 	=>  $ruang,
						'ordnerarsip' 	=>  $ordner,
						'lemariarsip' 	=>  $lemari,
						'faskode' 		=>  $kode,
						'fasmasa' 		=>  $aktif,
						'fasket' 		=>  $keterangan,
						'fakultas' 		=>  $fakultas,
						'created_at' 	=>  $tglbuat,
						'updated_at' 	=>  $tglubah
					]);
				} else {
					$marking 		= $fakultas.'-MAN-'.$yersrt.'-'.time();
					$uploadedFile 	= $request->file('file');
					$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
					$update  = Suratkeluar::create([
						'marking' 		=>  $marking,
						'jenissrt' 		=>  'MANUAL',
						'nomor' 		=>  $nomor,
						'anakno' 		=>  $anakno,
						'kodefak' 		=>  $kodefak,
						'unit' 			=>  'TU',
						'tglsurat' 		=>  $tanggal,
						'daysrt' 		=>  $daysrt,
						'monsrt' 		=>  $monsrt,
						'yersrt' 		=>  $yersrt,
						'dasarsurat' 	=>  '',
						'kepada' 		=>  '',
						'alamat' 		=>  '',
						'perihal' 		=>  $perihal,
						'lampiran' 		=>  '',
						'isisurat' 		=>  $marking.'.pdf',
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $pejabat,
						'namapejabat' 	=>  $namapejabat,
						'tembusan' 		=>  '',
						'sifat' 		=>  '4',
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('nama'),
						'kelompok' 		=>  Session('previlage'),
						'status' 		=>  'arsip',
						'arsip' 		=>  $arsipka,
						'ruangarsip' 	=>  $ruang,
						'ordnerarsip' 	=>  $ordner,
						'lemariarsip' 	=>  $lemari,
						'faskode' 		=>  $kode,
						'fasmasa' 		=>  $aktif,
						'fasket' 		=>  $keterangan,
						'footnote' 		=>  '',
						'tandatangan' 	=>  '',
						'paraf1' 		=>  '',
						'paraf2' 		=>  '',
						'paraf3' 		=>  '',
						'paraf4' 		=>  '',
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  '',
						'font' 			=>  '',
						'ukuran' 		=>  '',
						'lebarttd' 		=>  '',
						'filelampiran' 	=>  '',
						'fakultas' 		=>  $fakultas,
						'created_at' 	=>  $tglbuat,
						'updated_at' 	=>  $tglubah
					]);
					$idne    = $update->id;
				}
				if ($update){
					Arsipsurat::create([
						'tabel'			=> 'Surat Keluar', 
						'idne'			=> $idne, 
						'jenis'			=> $klasifikasi, 
						'kode'			=> $kode, 
						'durasi'		=> $aktif,
						'ruang' 		=> $ruang,
						'ordner' 		=> $ordner,
						'lemari' 		=> $lemari,
						'keterangan'	=> 'Aktif',
						'arsiparis' 	=> Session('nama'), 
						'fakultas'		=> Session('fakultas'),
						'created_at'	=> $tglbuat,
						'updated_at'	=> $tglubah
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
					return back();
				} else{
					return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
					return back();
				}
			} else if ($jenis == 'keluarnonomor' OR $jenis == 'KELUARNONOMER' OR $jenis == 'keluarnon'){
				$marking = $fakultas.'-'.$yersrt.'-'.time();
				$uploadedFile 	= $request->file('file');
				$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
				$update  = Suratkeluartnpnomor::create([
					'marking' 		=>  $marking,
					'jenissrt' 		=>  'MANUAL',
					'kodefak' 		=>  $kodefak,
					'unit' 			=>  'TU',
					'tglbuat' 		=>  $tanggal,
					'yersrt' 		=>  $yersrt,
					'dasarsurat' 	=>  '',
					'kepada' 		=>  $request->input('val02'),
					'alamat' 		=>  '',
					'perihal' 		=>  $request->input('val07'),
					'lampiran' 		=>  '',
					'isisurat' 		=>  $marking.'.pdf',
					'idpejabat' 	=>  $idpejabat,
					'pejabat' 		=>  $pejabat,
					'namapejabat' 	=>  $namapejabat,
					'tembusan' 		=>  '',
					'status' 		=>  'MANUAL',
					'sifat' 		=>  '',
					'klasifikasi' 	=>  '',
					'pembuat' 		=>  Session('nama'),
					'kelompok' 		=>  Session('previlage'),
					'arsip' 		=>  $arsipka,
					'ruangarsip' 	=>  $ruang,
					'ordnerarsip' 	=>  $ordner,
					'lemariarsip' 	=>  $lemari,
					'faskode' 		=>  $kode,
					'fasmasa' 		=>  $aktif,
					'fasket' 		=>  $keterangan,
					'footnote' 		=>  '',
					'tandatangan' 	=>  '',
					'paraf1' 		=>  '',
					'paraf2' 		=>  '',
					'paraf3' 		=>  '',
					'paraf4' 		=>  '',
					'font' 			=>  '',
					'ukuran' 		=>  '',
					'lebarttd' 		=>  '',
					'fakultas'		=>  $fakultas,
					'created_at' 	=>  $tglbuat,
					'updated_at' 	=>  $tglubah
				]);
				$idne    = $update->id;
				if ($update){
					Arsipsurat::create([
						'tabel'			=> 'Surat Keluar Tanpa Nomor', 
						'idne'			=> $idne, 
						'jenis'			=> $klasifikasi, 
						'kode'			=> $kode, 
						'durasi'		=> $aktif,
						'ruang' 		=> $ruang,
						'ordner' 		=> $ordner,
						'lemari' 		=> $lemari,
						'keterangan'	=> 'Aktif',
						'arsiparis' 	=> Session('nama'), 
						'fakultas'		=> Session('fakultas'),
						'created_at'	=> $tglbuat,
						'updated_at'	=> $tglubah
						
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
					return back();
				} else{
					return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
					return back();
				}
			} else if ($jenis == 'skdanperaturan' OR $jenis == 'SKPP'){
				if ($anakno == ''){
					$ceksek = Tabelskdanperaturan::where('fakultas', $fakultas)->where('nomor', $nomor)->where('tahun', $yersrt)->first();
				} else {
					$nomor 	= $nomor.'.'.$anakno;
					$ceksek = Tabelskdanperaturan::where('fakultas', $fakultas)->where('nomor', $nomor)->where('tahun', $yersrt)->first();
				}
				if (isset($ceksek->id)){
					$idne			= $ceksek->id;
					$marking		= $ceksek->marking;
					$uploadedFile 	= $request->file('file');
					$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
					$update = Tabelskdanperaturan::where('id', $idne)->update([
						'scansurat'			=> 	$marking.'.pdf',
						'tanggal' 			=>  $tanggal,
						'penandatangan' 	=>  $pejabat,
						'nmpejabat' 		=>  $namapejabat,
						'nippejabat' 		=>  $nippejabat,
						'judul' 			=>  $perihal,
						'kodefas' 			=>  $kode,
						'arsip'				=> 	'arsip',
						'fakultas' 			=>  $fakultas,
						'inputor' 			=>  Session('nama'),
						'created_at' 		=>  $tglbuat,
						'updated_at' 		=>  $tglubah
					]);
				} else {
					$marking 		= $fakultas.'-SKPP-'.$yersrt.'-'.time();
					$uploadedFile 	= $request->file('file');
					$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
					$update 	= Tabelskdanperaturan::create([
						'kelompok'			=> 	'KEPUTUSAN',
						'marking'			=> 	$marking,
						'nomor' 			=>  $nomor,
						'tahun' 			=>  $yersrt,
						'tanggal' 			=>  $tanggal,
						'penandatangan' 	=>  $pejabat,
						'nmpejabat' 		=>  $nmpejabat,
						'nippejabat' 		=>  $nippejabat,
						'judul' 			=>  $perihal,
						'kodefas' 			=>  $kode,
						'scansurat' 		=>  $marking.'.pdf',
						'kodesub' 			=>  '',
						'paraf1' 			=>  '',
						'paraf2' 			=>  '',
						'paraf3' 			=>  '',
						'paraf4' 			=>  '',
						'arsip'				=> 	'arsip',
						'fakultas' 			=>  $fakultas,
						'inputor' 			=>  Session('nama'),
						'created_at' 		=>  $tglbuat,
						'updated_at' 		=>  $tglubah
					]);
					$idne    = $update->id;
				}
				if ($update){
					Arsipsurat::create([
						'tabel'			=> 'SK dan Peraturan', 
						'idne'			=> $idne, 
						'jenis'			=> $klasifikasi, 
						'kode'			=> $kode, 
						'durasi'		=> $aktif,
						'ruang' 		=> $ruang,
						'ordner' 		=> $ordner,
						'lemari' 		=> $lemari,
						'keterangan'	=> 'Aktif',
						'arsiparis' 	=> Session('nama'), 
						'fakultas'		=> Session('fakultas'),
						'created_at'	=> $tglbuat,
						'updated_at'	=> $tglubah
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
					return back();
				}
				else{
					return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
					return back();
				}
			} else {
				if ($anakno == ''){
					$ceksek = Suratmasuk::where('fakultas', $fakultas)->where('noagenda', $nomor)->where('yersrt', $yersrt)->first();
				} else {
					$nomor 	= $nomor.'.'.$anakno;
					$ceksek = Suratmasuk::where('fakultas', $fakultas)->where('noagenda', $nomor)->where('yersrt', $yersrt)->first();
				}
				if (isset($ceksek->id)){
					$idne			= $ceksek->id;
					$marking		= $ceksek->marking;
					$uploadedFile 	= $request->file('file');
					$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
					$update = Suratmasuk::where('id', $idne)->update([
						'perihal' 		=>  $perihal,
						'pembuat' 		=>  Session('nama'),
						'scansurat' 	=>  $marking.'.pdf',
						'status' 		=>  'arsip',
						'arsip' 		=>  $arsipka,
						'ruangarsip' 	=>  $ruang,
						'ordnerarsip' 	=>  $ordner,
						'lemariarsip' 	=>  $lemari,
						'faskode' 		=>  $kode,
						'fasmasa' 		=>  $aktif,
						'fasket' 		=>  $keterangan,
						'created_at' 	=>  $tglbuat,
						'updated_at' 	=>  $tglubah
					]);
				} else {
					$marking 		= $fakultas.'-'.$yersrt.'-'.time();
					$uploadedFile 	= $request->file('file');
					$uploadedFile->move(public_path('scan/files'), $marking.'.pdf');
					$update 	= Suratmasuk::insertGetId([
						'marking' 		=>  $marking,
						'noagenda' 		=>  $nomor,
						'tglmasuk' 		=>  $tanggal,
						'tglsurat' 		=>  date("Y-m-d"),
						'daysrt' 		=>  $daysrt,
						'monsrt' 		=>  $monsrt,
						'yersrt' 		=>  $yersrt,
						'jenissurat' 	=>  'S',
						'nosurat' 		=>  $nomor,
						'asalsurat' 	=>  Session('nama'),
						'kepada' 		=>  '',
						'perihal' 		=>  $perihal,
						'subyek' 		=>  'TU',
						'ringkasan' 	=>  'Manual Input dari Arsiparis',
						'ringkasan2' 	=>  '',
						'lampiran' 		=>  '-',
						'scansurat' 	=>  $marking.'.pdf',
						'sifat' 		=>  '4',
						'bentuk' 		=>  'Biasa',
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('nama'),
						'status' 		=>  'arsip',
						'disposisi' 	=>  '',
						'arsip' 		=>  $arsipka,
						'ruangarsip' 	=>  $ruang,
						'ordnerarsip' 	=>  $ordner,
						'lemariarsip' 	=>  $lemari,
						'faskode' 		=>  $kode,
						'fasmasa' 		=>  $aktif,
						'fasket' 		=>  $keterangan,
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  '',
						'fakultas' 		=>  $fakultas,
						'created_at' 	=>  $tglbuat,
						'updated_at' 	=>  $tglubah
					]);
					$idne    = $update;
				}
				if ($update){
					Arsipsurat::create([
						'tabel'			=> 'Surat Masuk', 
						'idne'			=> $idne, 
						'jenis'			=> $klasifikasi, 
						'kode'			=> $kode, 
						'durasi'		=> $aktif,
						'ruang' 		=> $ruang,
						'ordner' 		=> $ordner,
						'lemari' 		=> $lemari,
						'keterangan'	=> 'Aktif',
						'arsiparis' 	=> Session('nama'), 
						'fakultas'		=> Session('fakultas'),
						'created_at'	=> $tglbuat,
						'updated_at'	=> $tglubah
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sukses di Arsipkan Surat ID '.$idne]);
					return back();
				} else{
					return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi']);
					return back();
				}
			}
		}
		else {
			return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Kode, No. Lemari dan No. Order Telah di isi ']);
			return back();
		}
    }
    public function undoArsip(Request $request) {
    	$idarsip    = $request->input('val01');
		$idsurat    = $request->input('val02');
		$tabel      = $request->input('val03');
		
		$kerjanya	= Arsipsurat::where('id', $idarsip)->delete();
		
		if ($kerjanya){
			if ($tabel == 'Surat Keluar'){
				$csurat = Suratkeluar::where('id', $idsurat)->count();
				if ($csurat != 0){
					Suratkeluar::where('id', $idsurat)->update([
						'arsip' 		=>  '',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
					]);
				}
			}
			else if ($tabel == 'Surat Keluar Tanpa Nomor'){
				$csurat = Suratkeluartnpnomor::where('id', $idsurat)->count();
				if ($csurat != 0){
					Suratkeluartnpnomor::where('id', $idsurat)->update([
						'arsip' 		=>  '',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
					]);
				}
			}
			else if ($tabel == 'Draft SK'){
				$csurat = Draftsk::where('id', $idsurat)->count();
				if ($csurat != 0){
					Draftsk::where('id', $idsurat)->update([
						'arsip' 		=>  '0',
					]);
				}
			}
			else if ($tabel == 'SK dan Peraturan'){
				$jsurat 	= Tabelskdanperaturan::where('id', $idsurat)->first();
				if (isset($jsurat->marking)){
					Tabelskdanperaturan::where('id', $idsurat)->update([
						'arsip' 		=>  null,
					]);
				}
			}
			else {
				$csurat 	= Suratmasuk::where('id', $idsurat)->count();
				if ($csurat != 0){
					Suratmasuk::where('id', $idsurat)->update([
						'arsip' 		=>  '',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
					]);
				}
			}
			return response()->json(['status' => 'Success', 'message' => 'Surat telah dikembalikan ke inbox']);
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem error, coba beberapa saat lagi']);
		}		
    }
    public function jsonviewarsipbyKlasifikasi(Request $request) {
		$status				= $request->input('val01');
		$jenis				= $request->input('val02');
		$fakultas			= Session('fakultas');
		$arrayklasifikasi 	= [];
		$mcmklasifikasi		= Klasifikasi::where('klasifikasi', $jenis)->orderBy('kodesurat', 'ASC')->get();
		foreach ($mcmklasifikasi as $result) {
			$kodesurat 		= $result->kodesurat;
			$getcount		= Arsipsurat::where('jenis', $jenis)->where('kode', $kodesurat)->where('keterangan', $status)->where('fakultas', $fakultas)->count();
			$arrayklasifikasi[] = array(
				'idne' 				=> $result->id,
				'klasifikasi' 		=> $result->klasifikasi,
				'kodeklasifikasi' 	=> $result->kodeklasifikasi,
				'kodesurat' 		=> $result->kodesurat,
				'primer' 			=> $result->primer,
				'sekunder' 			=> $result->sekunder,
				'tersier' 			=> $result->tersier,
				'series' 			=> $result->series,
				'aktif' 			=> $result->aktif,
				'inaktif' 			=> $result->inaktif,
				'keterangan' 		=> $result->keterangan,
				'getcount' 			=> $getcount,
			);
		}
    	echo json_encode($arrayklasifikasi);	
    }
	public function detailtraktingArsip(Request $request) {
		$status				= $request->input('val01');
		$jenis				= $request->input('val02');
		$kodesurat			= $request->input('val03');
		$fakultas			= Session('fakultas');
		$arrayarsip 		= [];
		$rsurat				= Arsipsurat::where('fakultas', $fakultas)->where('jenis', $jenis)->where('keterangan', $status)->where('kode', $kodesurat)->get();
		if (!empty($rsurat)) {
			foreach ($rsurat as $result) {
				$tabel	= $result->tabel;
				$idne	= $result->idne;
				if ($tabel == 'Surat Keluar'){
					$marking 	= 'f6610debaf1712366d1a5e77dcb6672d-'.$idne;
					$csurat 	= Suratkeluar::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluar::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}
				else if ($tabel == 'Surat Keluar Tanpa Nomor'){
					$marking 	= '31a6c48f03aaf7ab8085cc6b5bd34990-'.$idne;
					$csurat 	= Suratkeluartnpnomor::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluartnpnomor::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}
				else if ($tabel == 'Draft SK'){
					$marking 	= '58ddd975e88084b35fc973ab7518d4ba-'.$idne;
					$csurat = Draftsk::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Draftsk::where('id', $idne)->first();
						$perihal= $jsurat->jenissk;
					}
				}
				else if ($tabel == 'SK dan Peraturan'){
					$marking 	= 'SKPP-'.$idne;
					$jsurat 	= Tabelskdanperaturan::where('id', $idne)->first();
					if (isset($jsurat->marking)){
						$perihal = $jsurat->judul;
					} else {
						$perihal = '';
					}
				} 
				else {
					$marking 	= '7a07275b47504815818abc970da769fc-'.$idne;
					$csurat 	= Suratmasuk::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal= '';
					} else {
						$jsurat = Suratmasuk::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}			
				$arrayarsip[] = array(
					'idarsip' 		=> $result->id,
					'idsurat' 		=> $idne,
					'tabel' 		=> $tabel,
					'perihal' 		=> $perihal,
					'jenis' 		=> $result->jenis,
					'kode' 			=> $result->kode,
					'durasi' 		=> $result->durasi,
					'keterangan' 	=> $result->keterangan,
					'ruang' 		=> $result->ruang,
					'ordner' 		=> $result->ordner,
					'lemari' 		=> $result->lemari,
					'arsiparis' 	=> $result->arsiparis,						
					'fakultas' 		=> $result->fakultas,
					'marking' 		=> $marking,
				);
			}
		}
    	echo json_encode($arrayarsip);	
    }
	public function jsonviewarsipuk1() {
		$arrayarsip 		= [];
		$rsurat				= Arsipsurat::where('fakultas', 'UK1')->where('arsiparis', '=', '')->orderBy('kode', 'ASC')->get();
		if (!empty($rsurat)) {
			foreach ($rsurat as $result) {
				$tabel	= $result->tabel;
				$idne	= $result->idne;
				$durasi	= $result->durasi;
				if ($tabel == 'Surat Keluar'){
					$marking = 'f6610debaf1712366d1a5e77dcb6672d-'.$idne;
					$csurat 	= Suratkeluar::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';						
					} else {
						$jsurat = Suratkeluar::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}
				else if ($tabel == 'Surat Keluar Tanpa Nomor'){
					$marking 	= '31a6c48f03aaf7ab8085cc6b5bd34990-'.$idne;
					$csurat 	= Suratkeluartnpnomor::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';						
					} else {
						$jsurat = Suratkeluartnpnomor::where('id', $idne)->first();
						$perihal= $jsurat->perihal;						
					}
				}
				else if ($tabel == 'Draft SK'){
					$marking 	= '58ddd975e88084b35fc973ab7518d4ba-'.$idne;
					$csurat 	= Draftsk::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Draftsk::where('id', $idne)->first();
						$perihal= $jsurat->jenissk;
					}
				}
				else if ($tabel == 'SK dan Peraturan'){
					$marking 	= 'SKPP-'.$idne;
					$jsurat 	= Tabelskdanperaturan::where('id', $idne)->first();
					if (isset($jsurat->marking)){
						$perihal = $jsurat->judul;
					} else {
						$perihal = '';
					}
				}
				else {
					$marking 	= '7a07275b47504815818abc970da769fc-'.$idne;
					$csurat 	= Suratmasuk::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal= '';
					} else {
						$jsurat = Suratmasuk::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}
				$cgetsurat 	  = Penerimasurat::where('id', $durasi)->count();
				if ($cgetsurat == 0){
					$surate = '<strong>Surat Pemindahan Arsip Tidak di Temukan</strong>';
				} else {
					$getsurat 	= Penerimasurat::where('id', $durasi)->first();
					$surate		= $getsurat->tabel;
				}
				$arrayarsip[] = array(
					'idarsip' 		=> $result->id,
					'idsurat' 		=> $idne,
					'tabel' 		=> $tabel,
					'perihal' 		=> $perihal,
					'jenis' 		=> $result->jenis,
					'kode' 			=> $result->kode,
					'durasi' 		=> $result->durasi,
					'keterangan' 	=> $result->keterangan,
					'ruang' 		=> $result->ruang,
					'ordner' 		=> $result->ordner,
					'lemari' 		=> $result->lemari,
					'arsiparis' 	=> $result->arsiparis,						
					'fakultas' 		=> $result->fakultas,
					'marking' 		=> $marking,
					'surate' 		=> $surate,
				);
			}
		}
    	echo json_encode($arrayarsip);	
    }
	public function jsonviewrekaparsip() {
		$arrayarsip 		= [];
		$getjenis 			= Arsipsurat::groupBy('keterangan')->get();
		if (!empty($getjenis)){
			foreach ($getjenis as $rows){
				$jenis 	= $rows->keterangan;
				$jumlah = Arsipsurat::where('fakultas', Session('fakultas'))->where('keterangan', $jenis)->count();
				$arrayarsip[] = array(
					'jenis' 		=> $jenis,
					'jumlah' 		=> $jumlah,
				);
			}
		}
    	echo json_encode($arrayarsip);	
    }
	public function jsonarsipberitAacara(Request $request) {
		$jenis				= $request->input('val01');
		$fakultas			= Session('fakultas');
		$arrayarsip 		= [];
		$rsurat				= Penerimasurat::where('status', $fakultas)->where('jenis', $jenis)->orderBy('created_at', 'DESC')->limit(200)->get();
		if (!empty($rsurat)) {
			foreach ($rsurat as $result) {
				$arrayarsip[] = array(
					'idne' 		=> $result->id,
					'nomor' 	=> $result->idsurat,
					'tanggal' 	=> $result->keterangan,
					'tabel' 	=> $result->tabel,
				);
			}
		}
    	echo json_encode($arrayarsip);	
    }
	public function jsonviewarsipbyKeterangan(Request $request) {
		$keterangan			= $request->input('val01');
		$fakultas			= Session('fakultas');
		$arrayarsip 		= [];
		$rsurat				= Arsipsurat::where('keterangan', $keterangan)->where('fakultas', $fakultas)->get();
		if (!empty($rsurat)) {
			foreach ($rsurat as $result) {
				$tabel	= $result->tabel;
				$idne	= $result->idne;
				$tgl	= $result->created_at;
				$umur	= Carbon::parse($tgl)->age;
				
				if ($tabel == 'Surat Keluar'){
					$marking 	= 'f6610debaf1712366d1a5e77dcb6672d-'.$idne;
					$csurat 	= Suratkeluar::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluar::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}
				else if ($tabel == 'Surat Keluar Tanpa Nomor'){
					$marking 	= '31a6c48f03aaf7ab8085cc6b5bd34990-'.$idne;
					$csurat 	= Suratkeluartnpnomor::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluartnpnomor::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}
				else if ($tabel == 'Draft SK'){
					$marking 	= '58ddd975e88084b35fc973ab7518d4ba-'.$idne;
					$csurat = Draftsk::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Draftsk::where('id', $idne)->first();
						$perihal= $jsurat->jenissk;
					}
				}
				else if ($tabel == 'SK dan Peraturan'){
					$marking 	= 'SKPP-'.$idne;
					$jsurat 	= Tabelskdanperaturan::where('id', $idne)->first();
					if (isset($jsurat->marking)){
						$perihal = $jsurat->judul;
					} else {
						$perihal = '';
					}
				}
				else {
					$marking 	= '7a07275b47504815818abc970da769fc-'.$idne;
					$csurat 	= Suratmasuk::where('id', $idne)->count();
					if ($csurat == 0){
						$perihal= '';
					} else {
						$jsurat = Suratmasuk::where('id', $idne)->first();
						$perihal= $jsurat->perihal;
					}
				}			
				$arrayarsip[] = array(
					'idarsip' 		=> $result->id,
					'idsurat' 		=> $idne,
					'tabel' 		=> $tabel,
					'perihal' 		=> $perihal,
					'jenis' 		=> $result->jenis,
					'kode' 			=> $result->kode,
					'umur' 			=> $umur.' Thn',
					'keterangan' 	=> $result->keterangan,
					'ruang' 		=> $result->ruang,
					'ordner' 		=> $result->ordner,
					'lemari' 		=> $result->lemari,
					'arsiparis' 	=> $result->arsiparis,
					'fakultas' 		=> $result->fakultas,
					'marking' 		=> $marking,
				);
			}
		}
    	echo json_encode($arrayarsip);	
    }
	public function detailpenerimaArsip(Request $request) {
		$idarsip		= $request->input('val01');
		$arraypenerimaarsip 	= [];
		$getdataarsip	= Arsipsurat::where('id', $idarsip)->get();
		$tabel 			= $getdataarsip->tabel;
		$jenis			= $getdataarsip->jenis;
		$idsurat		= $getdataarsip->idsurat;
		if ($tabel == 'Surat Keluar'){
			$marking 	= 'f6610debaf1712366d1a5e77dcb6672d-'.$idsurat;
			$csurat 	= Suratkeluar::where('id', $idsurat)->count();
			if ($csurat == 0){
				$perihal = '';
			} else {
				$jsurat = Suratkeluar::where('id', $idsurat)->first();
				$perihal= $jsurat->perihal;
			}
		}
		else if ($tabel == 'Surat Keluar Tanpa Nomor'){
			$marking 	= '31a6c48f03aaf7ab8085cc6b5bd34990-'.$idsurat;
			$csurat 	= Suratkeluartnpnomor::where('id', $idsurat)->count();
			if ($csurat == 0){
				$perihal = '';
			} else {
				$jsurat = Suratkeluartnpnomor::where('id', $idsurat)->first();
				$perihal= $jsurat->perihal;
			}
		}
		else if ($tabel == 'Draft SK'){
			$marking 	= '58ddd975e88084b35fc973ab7518d4ba-'.$idsurat;
			$csurat = Draftsk::where('id', $idsurat)->count();
			if ($csurat == 0){
				$perihal = '';
			} else {
				$jsurat = Draftsk::where('id', $idsurat)->first();
				$perihal= $jsurat->jenissk;
			}
		}
		else if ($tabel == 'SK dan Peraturan'){
			$marking 	= 'SKPP-'.$idsurat;
			$jsurat 	= Tabelskdanperaturan::where('id', $idsurat)->first();
			if (isset($jsurat->marking)){
				$perihal = $jsurat->judul;
			} else {
				$perihal = '';
			}
		}
		else {
			$marking 	= '7a07275b47504815818abc970da769fc-'.$idsurat;
			$csurat 	= Suratmasuk::where('id', $idsurat)->count();
			if ($csurat == 0){
				$perihal= '';
			} else {
				$jsurat = Suratmasuk::where('id', $idsurat)->first();
				$perihal= $jsurat->perihal;
			}
		}	
		$rsurat				= Penerimasurat::where('jenis', 'ARSIP')->where('marking', $marking)->get();
		if (!empty($rsurat)) {
			foreach ($rsurat as $result) {
				$idpegawai 		= $result->idpegawai;
				$pengikut		= Simsppdpengikut::where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
				$qnamapjbt		= Simpegpegawai::where('id', $idpegawai)->first();
				$nmpejabat 		= $qnamapjbt->nama_lengkap;
				$jabatan 		= $qnamapjbt->jab_fungsional;
				$fakultas 		= $qnamapjbt->ppabp;
				$cekdatane		= Simsppdbiayaperjalanan::where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->count();
				if ($cekdatane != 0){
					$getnominal 	= Simsppdbiayaperjalanan::select(DB::raw("SUM(usulan) as jumlah"))->where('idsurat', $idsurat)->where('idpegawai', $idpegawai)->groupBy('idsurat')->first();
					$nominalusulan	= $getnominal->jumlah;
				}else {
					$nominalusulan	= 0;
				}
				$arraypenerimaarsip[] = array(
					'idne' 			=> $result->id,
					'idsurat' 		=> $idsurat,
					'pejabat' 		=> $nmpejabat,
					'jabatan' 		=> $jabatan,
					'fakultas' 		=> $fakultas,
					'status' 		=> $result->status,
					'keterangan' 	=> $result->keterangan,
					
				);
			}
		}
    	echo json_encode($arraypenerimaarsip);	
    }
    public function exsetstatusArsip(Request $request) {
		$idne			= $request->input('val01');
		$keterangan		= $request->input('val02');
		$input 			= Arsipsurat::where('id', $idne)->update([
			'keterangan' => $keterangan
		]);
		if ($input) {
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Status Arsip Telah di ubah menjadi : '.$keterangan]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak dapat terhubung dengan database, silahkan ulangi beberapa saat lagi']);
			return back();
		}
    }
	public function exsesuaiBeritaacara(Request $request) {
		$idne			= $request->input('val01');
		$keterangan		= $request->input('val02');
		$fakultas		= Session('fakultas');
		if ($keterangan == 'Fix Pindah'){
			$cdataarsip	= Arsipsurat::where('durasi', $idne)->where('keterangan', 'Permanen')->where('fakultas', $fakultas)->count();
			if ($cdataarsip == 0){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Arsip Surat Belum Terpilih dengan Benar']);
				return back();
			}else {
				$sukses 	= 0;
				$gagal		= '';
				$dataarsip	= Arsipsurat::where('durasi', $idne)->where('keterangan', 'Permanen')->where('fakultas', $fakultas)->get();
				foreach($dataarsip as $rarsip){
					$idarsip 	= $rarsip->id;
					$update 	= Arsipsurat::where('id', $idarsip)->update([
						'ruang' 	=> '',
						'ordner'	=> '',
						'lemari'	=> '',
						'arsiparis'	=> '',
						'fakultas'	=> 'UK1'
					]);
					if ($update){ $sukses++; }
					else {
						$gagal = $gagal.'Error Update Arsip Surat dengan ID '.$idarsip.'<br />';
					}
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Status Arsip Telah di pindah ke akun UK 1 sebanyak : '.$sukses.' <br />'.$gagal]);
				return back();
			}
		} else if ($keterangan == 'Fix Musnah'){
			$cdataarsip	= Arsipsurat::where('durasi', $idne)->where('keterangan', 'Musnah')->where('fakultas', $fakultas)->count();
			if ($cdataarsip == 0){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Arsip Surat Belum Terpilih dengan Benar']);
				return back();
			}else {
				$sukses 	= 0;
				$gagal		= '';
				$dataarsip	= Arsipsurat::where('durasi', $idne)->where('keterangan', 'Musnah')->where('fakultas', $fakultas)->get();
				foreach($dataarsip as $rarsip){
					$idarsip 		= $rarsip->id;
					$tabel 			= $rarsip->tabel;
					$letaklampiran	= '';
					$marking 		= '';
					if ($tabel == 'Surat Keluar'){
						$jsurat 	= Suratkeluar::where('id', $idsurat)->first();
						if (isset($jsurat->marking)){
							$marking = $jsurat->marking;
							$letakfile 	= public_path('scan/files/'.$jsurat->marking.'.pdf');
							if ($jsurat->lampiran != ''){
								$letaklampiran 	= public_path('scan/files/'.$jsurat->lampiran);
								Storage::disk('local')->delete($letaklampiran);
							}
							Storage::disk('local')->delete($letakfile);
							Suratkeluar::where('id', $idsurat)->delete();
						}
					} else if ($tabel == 'Surat Keluar Tanpa Nomor'){
						$jsurat 	= Suratkeluartnpnomor::where('id', $idsurat)->first();
						if (isset($jsurat->marking)){
							$marking 	= $jsurat->marking;
							$letakfile 	= public_path('scan/files/'.$jsurat->marking.'.pdf');
							if ($jsurat->lampiran != ''){
								$letaklampiran 	= public_path('scan/files/'.$jsurat->lampiran);
								Storage::disk('local')->delete($letaklampiran);
							}
							Storage::disk('local')->delete($letakfile);
							Suratkeluartnpnomor::where('id', $idsurat)->delete();
						}
					} else if ($tabel == 'Draft SK'){
						$jsurat 	= Draftsk::where('id', $idsurat)->first();
						if (isset($jsurat->marking)){
							$marking 	= $jsurat->marking;
							$letakfile 	= public_path('scan/files/'.$jsurat->marking.'.pdf');
							Storage::disk('local')->delete($letakfile);
							Draftsk::where('id', $idsurat)->delete();
						}
					} else if ($tabel == 'SK dan Peraturan'){
						$jsurat 	= Tabelskdanperaturan::where('id', $idsurat)->first();
						if (isset($jsurat->marking)){
							$marking 	= $jsurat->marking;
							$letakfile 	= public_path('scan/files/'.$jsurat->marking.'.pdf');
							Storage::disk('local')->delete($letakfile);
							Tabelskdanperaturan::where('id', $idsurat)->delete();
						}
					} else {
						$jsurat 	= Suratmasuk::where('id', $idsurat)->first();
						if (isset($jsurat->scansurat)){
							$marking 	= $jsurat->marking;
							if ($jsurat->scansurat != ''){
								$letakfile 	= public_path('scan/files/'.$jsurat->scansurat);
								Storage::disk('local')->delete($letakfile);	
							} else {
								$letakfile 	= public_path('scan/files/'.$jsurat->marking.'.pdf');
								Storage::disk('local')->delete($letakfile);
							}
							Suratmasuk::where('id', $idsurat)->delete();
						}
					}
					Arsipsurat::where('id', $idarsip)->update([
						'catatan'		=> 'Pemusnahan File '.$letakfile.' '.$letaklampiran.' Oleh '.Session('nama').' Pada '.date("Y-m-d H:i:s"),
						'marking'		=> $marking,
						'keterangan'	=> Session('fakultas'),
						'fakultas'		=> 'Musnah',
						'lastcheck'		=> date("Y-m-d"),
						'arsiparis'		=> Session('nama')
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Status Arsip Telah di pindah ke akun UK 1 sebanyak : '.$sukses.' <br />'.$gagal]);
				return back();
			}
		} else if ($keterangan == 'Batal Pindah'){
			$hapus 	= Penerimasurat::where('id', $idne)->delete();
			if ($hapus){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Status Arsip Telah di berhasil di hapus']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Arsip Surat Gagal di Hapus, Ulangi Beberapa Saat Lagi.']);
				return back();
			}
		}
    }
	public function exberitaPemindahanarsip(Request $request) {
		$pihak1			= $request->input('val01');
		$pihak2			= $request->input('val02');
		$pimpinan1		= $request->input('val03');
		$pimpinan2		= $request->input('val04');
		$nomor			= $request->input('val05');
		$tanggal		= $request->input('val06');
		$arridarsip		= $request->input('val07');
		$countarr 		= count($arridarsip);
		if (!empty($arridarsip)){
			if ($pihak1 == ''){
				$nama1 		= '';
				$nip1 		= '';
				$jabatan1	= '';
			} else {
				$cgetpegawai = Simpegpegawai::where('id', $pihak1)->count();
				if ($cgetpegawai != 0){
					$getpegawai = Simpegpegawai::where('id', $pihak1)->first();
					$nama1 		= $getpegawai->nama_lengkap;
					$nip1 		= $getpegawai->nip_baru;
					$jabatan1	= $getpegawai->jabatan;
				}
			}
			if ($pihak2 == ''){
				$nama2 		= '';
				$nip2 		= '';
				$jabatan2	= '';
			} else {
				$cgetpegawai = Simpegpegawai::where('id', $pihak2)->count();
				if ($cgetpegawai != 0){
					$getpegawai = Simpegpegawai::where('id', $pihak2)->first();
					$nama2 		= $getpegawai->nama_lengkap;
					$nip2 		= $getpegawai->nip_baru;
					$jabatan2	= $getpegawai->jabatan;
				}
			}
			if ($tanggal != ''){
				$arrtgl			= explode('-', $tanggal);
				$dd 			= $arrtgl[2];
				$mm 			= (int)$arrtgl[1];
				$yy 			= $arrtgl[0];
				$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
				$mm				= $arrbulan[$mm];
			} else {
				$dd 			= '.........';
				$mm 			= '.........';
				$yy 			= '.........';
			}
			$fakultas			= Session('fakultas');
			$generatesurat 		= '<table width="800" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="71">&nbsp;</td>
							<td width="178">&nbsp;</td>
							<td width="28">&nbsp;</td>
							<td width="192">&nbsp;</td>
							<td width="317">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="center"><strong>BERITA ACARA PEMINDAHAN ARSIP</strong></td>
						  </tr>
						  <tr>
							<td colspan="5" align="center">NOMOR : '.$nomor.' </td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">Pada hari ini tanggal '.$dd.' bulan '.$mm.' tahun '.$yy.', yang bertandatangan di bawah ini</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center">1.</td>
							<td>Nama</td>
							<td>:</td>
							<td colspan="2">'.$nama1.'</td>
						  </tr>
						  <tr>
							<td align="center">2.</td>
							<td>NIP</td>
							<td>:</td>
							<td colspan="2">'.$nip1.'</td>
						  </tr>
						  <tr>
							<td align="center">3.</td>
							<td>Jabatan</td>
							<td>:</td>
							<td colspan="2">'.$jabatan1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">Dalam hal ini bertindak untuk dan atas nama '.$pimpinan1.' yang selanjutnya disebut PIHAK PERTAMA</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center">1.</td>
							<td>Nama</td>
							<td>:</td>
							<td colspan="2">'.$nama2.'</td>
						  </tr>
						  <tr>
							<td align="center">2.</td>
							<td>NIP</td>
							<td>:</td>
							<td colspan="2">'.$nip2.'</td>
						  </tr>
						  <tr>
							<td align="center">3.</td>
							<td>Jabatan</td>
							<td>:</td>
							<td colspan="2">'.$jabatan2.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dalam hal ini bertindak untuk dan atas nama '.$pimpinan2.' yang selanjutnya disebut PIHAK KEDUA.</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK PERTAMA memindahkan arsip statis kepada PIHAK KEDUA, dalam keadaan baik / rusak*) sebanyak '.$countarr.' surat sesuai dengan daftar pertelaannya</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berita Acara ini dibuat dalam rangkap 2 (dua) masing-masing diperuntukan bagi PIHAK KESATU dan PIHAK KEDUA</td>
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">PIHAK KEDUA</td>
							<td>PIHAK PERTAMA</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">'.$pimpinan2.'</td>
							<td>'.$pimpinan1.'</td>
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">'.$nama2.'</td>
							<td>'.$nama1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">NIP '.$nip2.'</td>
							<td>NIP '.$nip1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						</table>
						<div style="page-break-before: always">
						<table width="800" border="0" cellspacing="0" cellpadding="0" >
						  <tr>
							<td width="71">&nbsp;</td>
							<td width="178">&nbsp;</td>
							<td width="28">&nbsp;</td>
							<td width="192">&nbsp;</td>
							<td width="317">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="center"><strong>DAFTAR ARSIP YANG DIPINDAHKAN</strong></td>
						  </tr>
						  <tr>
							<td colspan="5" align="center">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="center">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="left">Unit Pengolah : '.$fakultas.'</td>
						  </tr>
						</table>
						<table width="800" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center">No. Urut</td>
							<td align="center">Indeks</td>
							<td align="center">Uraian Masalah</td>
							<td align="center">Kode Klasifikasi</td>
							<td align="center">Tahun Penciptaan</td>
							<td align="center">Jumlah Kotak/ Karung / dll</td>
							<td align="center">Ket</td>
						</tr>
						<tr>
							<td align="center">1</td>
							<td align="center">2</td>
							<td align="center">3</td>
							<td align="center">4</td>
							<td align="center">5</td>
							<td align="center">6</td>
							<td align="center">7</td>
						</tr>
						';
			$i 				= 1;
			if ($nomor != ''){
				$ceknomor = Penerimasurat::where('jenis', 'Berita Acara Pemindahan Arsip Statis')->where('idsurat', $nomor)->where('status', $fakultas)->count();
				if ($ceknomor != 0){
					$getnomor	= Penerimasurat::where('jenis', 'Berita Acara Pemindahan Arsip Statis')->where('idsurat', $nomor)->where('status', $fakultas)->first();
					$idriwayat 	= $getnomor->id;
				} else {
					$idriwayat = 0;
				}
			} else { $idriwayat = 0; }
			if ($idriwayat == 0){
				$idriwayat 		= Penerimasurat::insertGetId([
					'idsurat' 	=> $nomor, 
					'jenis'		=> 'Berita Acara Pemindahan Arsip Statis', 
					'keterangan'=> $tanggal,
					'idpegawai'	=> '0', 
					'tabel'		=> $generatesurat,
					'status'	=> $fakultas,
					'fakultas'	=> Session('fakultas')
				]);
			}
			foreach($arridarsip as $idarsip){
				$getdataarsip	= Arsipsurat::where('id', $idarsip)->first();
				$tabel 			= $getdataarsip->tabel;
				$kode			= $getdataarsip->kode;
				$idsurat		= $getdataarsip->idne;
				$pembuatan		= $getdataarsip->created_at;
				$marking 		= '';
				$tahun			= Carbon::parse($pembuatan)->year;
				if ($tabel == 'Surat Keluar'){
					$marking 	= 'keluar-'.$idsurat;
					$csurat 	= Suratkeluar::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluar::where('id', $idsurat)->first();
						$perihal= $jsurat->perihal;
						$marking= $jsurat->marking;
					}
				}
				else if ($tabel == 'Surat Keluar Tanpa Nomor'){
					$marking 	= 'keluarnonomer-'.$idsurat;
					$csurat 	= Suratkeluartnpnomor::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluartnpnomor::where('id', $idsurat)->first();
						$perihal= $jsurat->perihal;
						$marking= $jsurat->marking;
					}
				}
				else if ($tabel == 'Draft SK'){
					$marking 	= 'draftsk-'.$idsurat;
					$csurat = Draftsk::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Draftsk::where('id', $idsurat)->first();
						$perihal= $jsurat->jenissk;
						$marking= $jsurat->marking;
					}
				}
				else if ($tabel == 'SK dan Peraturan'){
					$marking 	= 'SKPP-'.$idsurat;
					$jsurat 	= Tabelskdanperaturan::where('id', $idsurat)->first();
					if (isset($jsurat->marking)){
						$perihal = $jsurat->judul;
						$marking = $jsurat->marking;
					} else {
						$perihal = '';
					}
				} 
				else {
					$marking 	= 'masuk-'.$idsurat;
					$csurat 	= Suratmasuk::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal= '';
					} else {
						$jsurat = Suratmasuk::where('id', $idsurat)->first();
						$perihal= $jsurat->perihal;
						$marking= $jsurat->marking;
					}
				}
				Arsipsurat::where('id', $idarsip)->update([
					'marking' 	=> $marking,
					'durasi' 	=> $idriwayat
				]);
				$generatesurat = $generatesurat.'
					<tr>
						<td align="center" valign="top">'.$i.'</td>
						<td align="center" valign="top">'.$idarsip.'</td>
						<td valign="top">'.$tabel.' Perihal '.$perihal.'</td>
						<td align="center" valign="top">'.$kode.'</td>
						<td align="center" valign="top">'.$tahun.'</td>
						<td valign="top">&nbsp;</td>
						<td valign="top">&nbsp;</td>
					</tr>
				';
				$i++;
			}
			$generatesurat 	= $generatesurat.'</table>
						<table width="800" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>Malang, '.$dd.' '.$mm.' '.$yy.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">PIHAK KEDUA</td>
							<td>PIHAK PERTAMA</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">'.$pimpinan2.'</td>
							<td>'.$pimpinan1.'</td>
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">'.$nama2.'</td>
							<td>'.$nama1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">NIP. '.$nip2.'</td>
							<td>NIP. '.$nip1.'</td>
						  </tr></table>';
			Penerimasurat::where('id', $idriwayat)->update([
				'tabel'		=> $generatesurat,
			]);
			echo $generatesurat;
		} else {
			echo 'Belum memilih surat yang akan dipindahkan';
		}
    }
	public function exberitaMusnaharsip(Request $request) {
		$pihak1		= $request->input('val01');
		$pimpinan1	= $request->input('val02');
		$kotak		= $request->input('val03');
		$nomor		= $request->input('val04');
		$tanggal	= $request->input('val05');
		$setuju		= $request->input('val06');
		$saksi1		= $request->input('val07');
		$saksi2		= $request->input('val08');
		$saksi3		= $request->input('val09');
		$arridarsip	= $request->input('val10');
		$countarr 	= count($arridarsip);
		if (!empty($arridarsip)){
			if ($pihak1 == ''){
				$nama1 		= '';
				$jabatan1	= '';
				$golongan1	= '';
			} else {
				$cgetpegawai = Simpegpegawai::where('id', $pihak1)->count();
				if ($cgetpegawai != 0){
					$getpegawai = Simpegpegawai::where('id', $pihak1)->first();
					$nama1 		= $getpegawai->nama_lengkap;
					$nip1 		= $getpegawai->nip_baru;
					$jabatan1	= $getpegawai->jabatan;
					$golongan	= $getpegawai->golongan;
					if ($golongan == 11){ $golongan1 = 'Juru Muda, I/A'; }
					if ($golongan == 12){ $golongan1 = 'Juru Muda Tingkat 1, I/B'; }
					if ($golongan == 13){ $golongan1 = 'Juru, I/C'; }
					if ($golongan == 14){ $golongan1 = 'Juru Tingkat 1, I/D'; }
					if ($golongan == 21){ $golongan1 = 'Pengatur Muda, II/A'; }
					if ($golongan == 22){ $golongan1 = 'Pengatur Muda Tingkat 1, II/B'; }
					if ($golongan == 23){ $golongan1 = 'Pengatur, II/C'; }
					if ($golongan == 24){ $golongan1 = 'Pengatur Tingkat 1, II/D'; }
					if ($golongan == 31){ $golongan1 = 'Penata Muda, III/A'; }
					if ($golongan == 32){ $golongan1 = 'Penata Muda Tingkat 1, III/B'; }
					if ($golongan == 33){ $golongan1 = 'Penata, III/C'; }
					if ($golongan == 34){ $golongan1 = 'Penata Tingkat 1, III/D'; }
					if ($golongan == 41){ $golongan1 = 'Pembina, IV/A'; }
					if ($golongan == 42){ $golongan1 = 'Pembina Tingkat 1, IV/B'; }
					if ($golongan == 43){ $golongan1 = 'Pembina Utama Muda, IV/C'; }
					if ($golongan == 44){ $golongan1 = 'Pembina Utama Madya, IV/D'; }
					if ($golongan == 45){ $golongan1 = 'Pembina Utama, IV/E'; }
				}
			}
			if ($tanggal != ''){
				$arrtgl			= explode('-', $tanggal);
				$dd 			= $arrtgl[2];
				$mm 			= (int)$arrtgl[1];
				$yy 			= $arrtgl[0];
				$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
				$mm				= $arrbulan[$mm];
			} else {
				$dd 			= '.........';
				$mm 			= '.........';
				$yy 			= '.........';
			}
			$fakultas			= Session('fakultas');
			$generatesurat 		= '<table width="800" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="71">&nbsp;</td>
							<td width="178">&nbsp;</td>
							<td width="28">&nbsp;</td>
							<td width="192">&nbsp;</td>
							<td width="317">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="center"><strong>BERITA ACARA PEMUSNAHAN ARSIP</strong></td>
						  </tr>
						  <tr>
							<td colspan="5" align="center">NOMOR : '.$nomor.' </td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada hari ini tanggal '.$dd.' bulan '.$mm.' tahun '.$yy.', yang bertandatangan di bawah ini</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center">&nbsp;</td>
							<td>Nama</td>
							<td>:</td>
							<td colspan="2">'.$nama1.'</td>
						  </tr>
						  <tr>
							<td align="center">&nbsp;</td>
							<td>Pangkat/gol</td>
							<td>:</td>
							<td colspan="2">'.$golongan1.'</td>
						  </tr>
						  <tr>
							<td align="center">&nbsp;</td>
							<td>Jabatan</td>
							<td>:</td>
							<td colspan="2">'.$jabatan1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">Dalam hal ini bertindak untuk dan atas nama '.$pimpinan1.' Tanggal '.$dd.' '.$mm.' '.$yy.' Nomor '.$nomor.' telah melakukan pemusnahan berkas arsip/ duplikasi sebanyak '.$kotak.' kotak sesuai dengan daftar pertelaan terlampir dengan cara dibakar/ dicercah/ dilebur secara kimiawi*)</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">Pemusnahan arsip dan duplikasi tersebut berdasarkan pertimbangan sebagai berikut</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">'.$setuju.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5">Saksi-saksi yang hadir dalam pelaksanaan pemusnahan tersebut terdiri dari Pejabat/ komponen yang seharusnya hadir berdasarkan peraturan perundang-undangan yang berlaku.</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>Malang, '.$dd.' '.$mm.' '.$yy.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>Panitia Penilai dan Pemusnahan Arsip,</td>
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>'.$nama1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>NIP. '.$nip1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>1.</td>
							<td colspan="3">'.$saksi1.'</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>2.</td>
							<td colspan="3">'.$saksi2.'</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>3.</td>
							<td colspan="3">'.$saksi3.'</td>
							<td>&nbsp;</td>
						  </tr>
						</table>
						<div style="page-break-before: always">
						<table width="800" border="0" cellspacing="0" cellpadding="0" >
						  <tr>
							<td width="71">&nbsp;</td>
							<td width="178">&nbsp;</td>
							<td width="28">&nbsp;</td>
							<td width="192">&nbsp;</td>
							<td width="317">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="center"><strong>DAFTAR ARSIP USUL MUSNAH</strong></td>
						  </tr>
						  <tr>
							<td colspan="5" align="center">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="center">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" align="left">Unit Pengolah : '.$fakultas.'</td>
						  </tr>
						</table>
						<table width="800" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center">No. Urut</td>
							<td align="center">Indeks</td>
							<td align="center">Uraian Masalah</td>
							<td align="center">Kode Klasifikasi</td>
							<td align="center">Tahun Penciptaan</td>
							<td align="center">Jumlah Kotak/ Karung / dll</td>
							<td align="center">Ket</td>
						</tr>
						<tr>
							<td align="center">1</td>
							<td align="center">2</td>
							<td align="center">3</td>
							<td align="center">4</td>
							<td align="center">5</td>
							<td align="center">6</td>
							<td align="center">7</td>
						</tr>
						';
			$i 				= 1;
			if ($nomor != ''){
				$ceknomor = Penerimasurat::where('jenis', 'Berita Acara Pemusnahan Arsip')->where('idsurat', $nomor)->where('status', $fakultas)->count();
				if ($ceknomor != 0){
					$getnomor	= Penerimasurat::where('jenis', 'Berita Acara Pemusnahan Arsip')->where('idsurat', $nomor)->where('status', $fakultas)->first();
					$idriwayat 	= $getnomor->id;
				} else {
					$idriwayat = 0;
				}
			} else { $idriwayat = 0; }
			if ($idriwayat == 0){
				$idriwayat 		= Penerimasurat::insertGetId([
					'idsurat' 	=> $nomor, 
					'jenis'		=> 'Berita Acara Pemusnahan Arsip', 
					'keterangan'=> $tanggal,
					'idpegawai'	=> '0', 
					'tabel'		=> $generatesurat,
					'status'	=> $fakultas,
					'fakultas'	=> Session('fakultas')
				]);
			}
			foreach($arridarsip as $idarsip){
				$getdataarsip	= Arsipsurat::where('id', $idarsip)->first();
				$tabel 			= $getdataarsip->tabel;
				$kode			= $getdataarsip->kode;
				$idsurat		= $getdataarsip->idne;
				$pembuatan		= $getdataarsip->created_at;
				$marking 		= '';
				$tahun			= Carbon::parse($pembuatan)->year;
				if ($tabel == 'Surat Keluar'){
					$marking 	= 'keluar-'.$idsurat;
					$csurat 	= Suratkeluar::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluar::where('id', $idsurat)->first();
						$perihal= $jsurat->perihal;
						$marking= $jsurat->marking;
					}
				}
				else if ($tabel == 'Surat Keluar Tanpa Nomor'){
					$marking 	= 'keluarnonomer-'.$idsurat;
					$csurat 	= Suratkeluartnpnomor::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Suratkeluartnpnomor::where('id', $idsurat)->first();
						$perihal= $jsurat->perihal;
						$marking= $jsurat->marking;
					}
				}
				else if ($tabel == 'Draft SK'){
					$marking 	= 'draftsk-'.$idsurat;
					$csurat = Draftsk::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal = '';
					} else {
						$jsurat = Draftsk::where('id', $idsurat)->first();
						$perihal= $jsurat->jenissk;
						$marking= $jsurat->marking;
					}
				}
				else if ($tabel == 'SK dan Peraturan'){
					$marking 	= 'SKPP-'.$idsurat;
					$jsurat 	= Tabelskdanperaturan::where('id', $idsurat)->first();
					if (isset($jsurat->marking)){
						$perihal = $jsurat->judul;
						$marking = $jsurat->marking;
					} else {
						$perihal = '';
					}
				}
				else {
					$marking 	= 'masuk-'.$idsurat;
					$csurat 	= Suratmasuk::where('id', $idsurat)->count();
					if ($csurat == 0){
						$perihal= '';
					} else {
						$jsurat = Suratmasuk::where('id', $idsurat)->first();
						$perihal= $jsurat->perihal;
						$marking= $jsurat->marking;
					}
				}
				Arsipsurat::where('id', $idarsip)->update([
					'durasi' 	=> $idriwayat,
					'marking'	=> $marking
				]);
				$generatesurat = $generatesurat.'
					<tr>
						<td align="center" valign="top">'.$i.'</td>
						<td align="center" valign="top">'.$idarsip.'</td>
						<td valign="top">'.$tabel.' Perihal '.$perihal.'</td>
						<td align="center" valign="top">'.$kode.'</td>
						<td align="center" valign="top">'.$tahun.'</td>
						<td valign="top">&nbsp;</td>
						<td valign="top">&nbsp;</td>
					</tr>
				';
				$i++;
			}
			$generatesurat 	= $generatesurat.'</table>
						<table width="800" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>Malang, '.$dd.' '.$mm.' '.$yy.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">PIHAK KEDUA</td>
							<td>PIHAK PERTAMA</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">'.$pimpinan2.'</td>
							<td>'.$pimpinan1.'</td>
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
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
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">'.$nama2.'</td>
							<td>'.$nama1.'</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="3">NIP. '.$nip2.'</td>
							<td>NIP. '.$nip1.'</td>
						  </tr></table>';
			Penerimasurat::where('id', $idriwayat)->update([
				'tabel'		=> $generatesurat,
			]);
			echo $generatesurat;
		} else {
			echo 'Belum memilih surat yang akan dimusnahakan';
		}
    }
    public function extbhpenerimaArsip(Request $request) {
		$idarsip			= $request->input('set01');
		$idsurat			= $request->input('set02');
		$idpegawai			= $request->input('set03');
		if ($sppd == 'HAPUS'){
			if ($idpegawai == 'SAYA YAKIN'){
				$hapus 	= Penerimasurat::where('id', $idarsip)->delete();
				if ($hapus){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Hapus Data Penerima Sukses']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Ulangi Beberapa Saat Lagi']);
					return back();
				}
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sepertinya anda kurang yakin.!']);
				return back();
			}
		} else {
			$getdataarsip	= Arsipsurat::where('id', $idarsip)->get();
			$tabel 			= $getdataarsip->tabel;
			$jenis			= $getdataarsip->jenis;
			if ($tabel == 'Surat Keluar'){
				$marking 	= 'f6610debaf1712366d1a5e77dcb6672d-'.$idsurat;
				$csurat 	= Suratkeluar::where('id', $idsurat)->count();
				if ($csurat == 0){
					$perihal = '';
				} else {
					$jsurat = Suratkeluar::where('id', $idsurat)->first();
					$perihal= $jsurat->perihal;
				}
			}
			else if ($tabel == 'Surat Keluar Tanpa Nomor'){
				$marking 	= '31a6c48f03aaf7ab8085cc6b5bd34990-'.$idsurat;
				$csurat 	= Suratkeluartnpnomor::where('id', $idsurat)->count();
				if ($csurat == 0){
					$perihal = '';
				} else {
					$jsurat = Suratkeluartnpnomor::where('id', $idsurat)->first();
					$perihal= $jsurat->perihal;
				}
			}
			else if ($tabel == 'Draft SK'){
				$marking 	= '58ddd975e88084b35fc973ab7518d4ba-'.$idsurat;
				$csurat = Draftsk::where('id', $idsurat)->count();
				if ($csurat == 0){
					$perihal = '';
				} else {
					$jsurat = Draftsk::where('id', $idsurat)->first();
					$perihal= $jsurat->jenissk;
				}
			}
			else if ($tabel == 'SK dan Peraturan'){
				$marking 	= 'SKPP-'.$idsurat;
				$jsurat 	= Tabelskdanperaturan::where('id', $idsurat)->first();
				if (isset($jsurat->marking)){
					$perihal = $jsurat->judul;
				} else {
					$perihal = '';
				}
			} 
			else {
				$marking 	= '7a07275b47504815818abc970da769fc-'.$idsurat;
				$csurat 	= Suratmasuk::where('id', $idsurat)->count();
				if ($csurat == 0){
					$perihal= '';
				} else {
					$jsurat = Suratmasuk::where('id', $idsurat)->first();
					$perihal= $jsurat->perihal;
				}
			}			
			$update 		= Penerimasurat::insert([
				'idsurat' 	=> $idsurat, 
				'jenis'		=> 'ARSIP', 
				'keterangan'=> $marking,
				'idpegawai'	=> $idpegawai, 
				'tabel'		=> $tabel,
				'status'	=> 'DRAFT',
				'fakultas'	=> Session('fakultas')
			]);
			if ($update){
				Arsipsurat::where('id', $idarsip)->update([
					'ruang' 	=> 'perorangan',
					'ordner'	=> 'perorangan',
					'lemari' 	=> 'perorangan',
					'fakultas'	=> 'perorangan'
				]);
				
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tambah Data Penerima Sukses']);
				return back();
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		}
    }
	public function getAntrianTTE(Request $request) {
		$arraygambar 	= [];
		$homebase		= url("/");
		$hilangkan 		= array(",", ".", "'");
		$pencarian		= $request->input('val01');
		$jenis			= $request->input('val02');
		if ($jenis == 'cek'){
			$authHeader = [
				'auth'    	=> ['esign', 'qwerty'],
			];
			$fromUrl 	= 'https://esign.ub.ac.id/api/user/status/'.$pencarian;
			$client 	= new Client();
			
			try{
				$response 		= $client->get($fromUrl, $authHeader);
				$response_data 	= json_decode($response->getBody()->getContents());
				$status 		= $response_data->status;
				$message 		= $response_data->message;
				
				$pesan 			= 'Status '.$status.' => '.$message;
			} catch (\GuzzleHttp\Exception\ClientException $e) {
				$response 				= $e->getResponse();
				$responseBodyAsString 	= $response->getBody()->getContents();
				$pesan 					= json_decode($responseBodyAsString);
				$pesan 					= $pesan->error;
			}
			echo $pesan;
		} else if ($jenis == 'kirimkeesign'){
			$cekuser	= Simpegpegawai::where('nik', $pencarian)->first();
			if (isset($cekuser->nip_baru)){
				$nip		= $cekuser->nip_baru;
				$nama		= $cekuser->nama;
				$nik		= $cekuser->nik;
				$email		= $cekuser->email_ub;
				$hape		= $cekuser->no_hp;
				$golongan	= $cekuser->golongan;
				$unitkerja	= $cekuser->unit_kerja;
				$jabatan	= $cekuser->jabatan;
				$nama		= str_replace($hilangkan, " ", $nama);
				$nama 		= substr($nama, 0, 25) . '';
				$nama		= strtoupper($nama);
				$ceksurat =  Suratkeluar::where('isisurat', 'LIKE', '%'.$nik.'%')->orderBy('id', 'DESC')->first();
				if (isset($ceksurat->marking)){
					$file 		= public_path('scan/files/'.$ceksurat->marking.'.pdf');
					$ktp 		= public_path('logo-ub.png');
					$client 	= new Client();
					$authHeader = [
						'auth'    		=> ['esign', 'qwerty'],
						'multipart'    	=> [
							[
								'name'		=> 'email',
								'contents'	=> $email
							],
							[
								'name'		=> 'jabatan',
								'contents'	=> $jabatan
							],
							[
								'name'		=> 'kota',
								'contents'	=> 'Malang'
							],
							[
								'name'		=> 'ktp',
								'contents'	=> fopen($ktp, 'r')
							],
							[
								'name'		=> 'nama',
								'contents'	=> $nama
							],
							[
								'name'		=> 'nik',
								'contents'	=> $nik
							],
							[
								'name'		=> 'nip',
								'contents'	=> $nip
							],
							[
								'name'		=> 'nomor_telepon',
								'contents'	=> $hape
							],
							[
								'name'		=> 'provinsi',
								'contents'	=> 'Jawa Timur'
							],
							[
								'name'		=> 'surat_rekomendasi',
								'contents'	=> fopen($file, 'r')
							],
							[
								'name'		=> 'unit_kerja',
								'contents'	=> 'Universitas Brawijaya'
							],
						],
					];
					try {
						$response 	= $client->post('https://esign.ub.ac.id/api/user/registrasi', $authHeader);
						Suratkeluar::where('id', $ceksurat->id)->update([
							'arsip' 	=>  'Pendaftaran TTE ke eSign Suksess pada '.date("Y-m-d H:i:s"),
						]);
						echo 'Surat dengan NIK => '.$nik.' Sudah Kami Kirim ke eSign Client';
				
					} catch (\GuzzleHttp\Exception\ClientException $e) {
						$response 				= $e->getResponse();
						$responseBodyAsString 	= $response->getBody()->getContents();
						$pesan 					= json_decode($responseBodyAsString);
						$pesan 					= $pesan->error;
						Suratkeluar::where('id', $ceksurat->id)->update([
							'tandatangan' 	=>  $pesan,
						]);
						echo 'Surat dengan NIK => '.$nik.' Gagal ke  eSign Client<br />'.$pesan;
					}
				} else {
					echo 'Surat dengan NIK => '.$nik.' Sudah Ada';
				}
			} else {
				echo 'Data NIK => '.$nik.' Tidak di Temukan';
			}
		} else if ($jenis == 'rekomendasi'){
			$cekuser	= Simpegpegawai::where('nik', $pencarian)->first();
			if (isset($cekuser->nip_baru)){
				$nip		= $cekuser->nip_baru;
				$nama		= $cekuser->nama_lengkap;
				$nik		= $cekuser->nik;
				$email		= $cekuser->email_ub;
				$hape		= $cekuser->no_hp;
				$golongan	= $cekuser->golongan;
				$unitkerja	= $cekuser->unit_kerja;
				$jabatan	= $cekuser->jabatan;
				$getgolongan = Golongan::where('kode', $golongan)->first();
				if (isset($getgolongan->golongan)){ $golongan = $getgolongan->golongan; } else { $golongan = ''; }
				if (isset($getgolongan->pangkat)){ $pangkat = $getgolongan->pangkat; } else { $pangkat = ''; }
				$golongan	= $pangkat.', '.$golongan;
			
				$ceksurat =  Suratkeluar::where('footnote', 'TTE an. '.$pencarian)->count();
				if ($ceksurat == 0){
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
												<td>'.$nama.'</td>
											</tr>
											<tr>
												<td>2.</td>
												<td>NIP</td>
												<td>:</td>
												<td>'.$nip.'</td>
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
					}else {
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
						'footnote' 		=>  'TTE an. '.$pencarian,
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
						$getawal 	= explode(" ", $penandatangan);
						$nama1 		= strtoupper($getawal[0]);
						if ($nama1 == 'KEMENTERIAN'){
							$penandatangan = 'Wakil Rektor Bidang Keuangan dan Sumber Daya';
						}
						Inboxsurat::insert([
							'marking'  		=>  $marking,
							'pengirim'  	=>  Session('nama'),
							'penerima'		=>  $penandatangan,
							'status'		=>  'send',
							'sifat'			=>  '1',
							'jenis'			=>  'KELUAR',
							'kerja'			=>  'TTD',
							'catatan'		=>  '',
							'tandatangan'	=>  '',
							'tanggal'		=>  '',
						]);
						Pejabatsurat::where('nip', $nip)->update([
							'pemaraf' => 'Rekom TTE Done'
						]);
						
						echo 'Surat dengan NIK => '.$nik.' Sukses di Antrikan ke '.$penandatangan.' Untuk di Tanda Tangani';
					} else {
						echo 'Surat dengan NIK => '.$nik.' Gagal di Tambahkan Ulangi Beberapa Saat Lagi';
					}
				} else {
					echo 'Surat dengan NIK => '.$nik.' Sudah Ada';
				}
			} else {
				echo 'Data NIK => '.$nik.' Tidak di Temukan';
			}
		} else if ($jenis == 'NEW'){
			if(Session('previlage') == 'developer' OR Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$getalluser	= Pejabatsurat::where('nip', '!=', '')->where('pemaraf', '!=', 'Rekom TTE Done')->limit(100)->get();
			} else {
				$getalluser	= Pejabatsurat::whereIn('fakultas', ['KP-'.Session('fakultas'), Session('fakultas')])->get();
			}
		
			if (!empty($getalluser)){
				foreach ($getalluser as $result){
					$nip 			= $result->nip;
					$cekuser		= Simpegpegawai::where('nip_baru', $nip)->first();
					if (isset($cekuser->nip_baru)){
						$nik		= $cekuser->nik;
						$email		= $cekuser->email_ub;
						$hape		= $cekuser->no_hp;
						$golongan	= $cekuser->golongan;
						$unitkerja	= $cekuser->unit_kerja;
					} else {
						$nik		= '';
						$email		= '';
						$hape		= '';
						$golongan	= '';
						$unitkerja	= $result->fakultas;
					}
					if ($nik != ''){
						$ceksudah = User::where('nik', $nik)->count();
					} else { $ceksudah = 0; }
					$ceksurat =  Suratkeluar::where('footnote', 'TTE an. '.$nik)->first();
					if (isset($ceksurat->marking)){
						$scansurat	= $ceksurat->marking.'.pdf';
					} else {
						$scansurat	= 'Belum di Antrikan';
					}
					if ($ceksudah == 0){
						$arraygambar[] 	= array(
							'idne' 			=> $result->id,
							'nama'			=> $result->nama,
							'previlage'		=> $result->pejabat,
							'email'			=> $email,
							'nik'			=> $nik,
							'nip'			=> $nip,
							'scansurat'		=> $scansurat,
							'hape'			=> $hape,
							'golongan'		=> $golongan,
							'unitkerja'		=> $unitkerja
						);
					}
				}
			}
			echo json_encode($arraygambar);
		} else if ($jenis == 'ANTRIAN'){
			if(Session('previlage') == 'developer' OR Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$getalluser	= Pejabatsurat::where('nip', '!=', '')->where('pemaraf', 'Rekom TTE Done')->get();
			} else {
				$getalluser	= Pejabatsurat::whereIn('fakultas', ['KP-'.Session('fakultas'), Session('fakultas')])->get();
			}
			if (!empty($getalluser)){
				foreach ($getalluser as $result){
					$nip 			= $result->nip;
					$cekuser		= Simpegpegawai::where('nip_baru', $nip)->first();
					if (isset($cekuser->nip_baru)){
						$nik		= $cekuser->nik;
						$email		= $cekuser->email_ub;
						$hape		= $cekuser->no_hp;
						$golongan	= $cekuser->golongan;
						$unitkerja	= $cekuser->unit_kerja;
						$ceksurat =  Suratkeluar::where('isisurat', 'LIKE', '%'.$nik.'%')->orderBy('id', 'DESC')->first();
						if (isset($ceksurat->marking)){
							$scansurat	= $ceksurat->marking;
							$tandatangan= $ceksurat->tandatangan;
							$footnote	= $ceksurat->footnote;
							if ($footnote == 'Pendaftaran TTE ke eSign Suksess'){
								$keterangan = '<span class="label label-primary">'.$footnote.'</span>';
							} else {
								if (file_exists(public_path('scan/files/'.$scansurat.'.pdf'))){
									$keterangan = '<a href="'.$homebase.'/viewsurat/keluar-'.$ceksurat->id.'" target="_blank"><span class="label label-success">REKOMENDASI SIAP</span></a>';
								} else {
									if ($tandatangan == '' OR is_null($tandatangan)){
										$keterangan = '<a href="'.$homebase.'/viewsurat/keluar-'.$ceksurat->id.'" target="_blank"><span class="label label-danger">BELUM SIAP</span></a>';
									} else {
										$keterangan = '<a href="'.$homebase.'/viewsurat/keluar-'.$ceksurat->id.'" target="_blank"><span class="label label-info">SIAP DOWNLOAD</span></a>';
									}
								}
							}
							$arraygambar[] 	= array(
								'idne' 			=> $result->id,
								'nama'			=> $result->nama,
								'previlage'		=> $result->pejabat,
								'email'			=> $email,
								'nik'			=> $nik,
								'nip'			=> $nip,
								'scansurat'		=> $scansurat,
								'keterangan'	=> $keterangan,
								'hape'			=> $hape,
								'golongan'		=> $golongan,
								'unitkerja'		=> $unitkerja
							);
						}
					}
				}
			}
			echo json_encode($arraygambar);
		} else if ($jenis == 'delete'){
			$delete		= User::where('id', $pencarian)->update([
				'nik'	=> null
			]);
			$getuser	= User::where('id', $pencarian)->first();
			if ($delete){
				echo 'Delete NIK an. '.$getuser->nama.' Sukses';
			} else {
				echo 'Delete NIK an. '.$getuser->nama.' Gagal';
			}
		} else if ($jenis == 'skiprekom'){
			$delete		= Pejabatsurat::where('id', $pencarian)->update([
				'pemaraf' => 'Rekom TTE Done'
			]);
			$getuser		= Pejabatsurat::where('id', $pencarian)->first();
			if ($delete){
				echo 'Skipping Created TTE For '.$getuser->nama.' '.$getuser->pejabat.' Success';
			} else {
				echo 'Delete NIK an. '.$getuser->nama.' Gagal';
			}
		} else if ($jenis == 'reset'){
			$jumlah		= 0;
			$error		= '';
			foreach ($pencarian as $idne){
				$ceksek = AntrianTTE::where('id', $idne)->first();
				if (is_null($ceksek->nonik)){
					AntrianTTE::where('id', $idne)->update([
						'keterangan' => null
					]);
					$jumlah++;
				} else {
					$cekneh = AntrianTTE::where('id', $idne)->where('keterangan', 'LIKE', '%gagal%')->count();
					if ($cekneh == 0){
						$error = $error.'ID '.$idne.' Proses TTE Tidak Perlu di Reset karena tidak mengalami kegagalan<br />';
					} else {
						$jenis 	= $ceksek->jenis;
						$idsurat= $ceksek->idsurat;
						if ($jenis == 'REMUNERASI' OR 
							$jenis == 'TUBEL' OR 
							$jenis == 'JABAKAD' OR 
							$jenis == 'BERHENTI' OR 
							$jenis == 'PENGPNS' OR 
							$jenis == 'JABPELAKSANA' OR 
							$jenis == 'DRAFTSK' OR 
							$jenis == 'PangkatNONPNS'){
							$getmarking	= Draftsk::where('id', $idsurat)->first();
							if (isset($getmarking->marking)){
								$marking 	= $getmarking->marking;
							} else {
								$marking	= '';
							}
							if ($marking != ''){
								$input = Inboxsurat::where('marking', $marking)->where('kerja', 'TTD')->update([
									'status' 		=> 'send',
									'tandatangan' 	=> null
								]);
							}
						} else {
							$getmarking	= Suratkeluar::where('id', $idsurat)->first();
							if (isset($getmarking->marking)){
								$marking 	= $getmarking->marking;
							} else {
								$marking	= '';
							}
							if ($marking != ''){
								$input = Inboxsurat::where('marking', $marking)->where('kerja', 'TTD')->update([
									'status' 		=> 'send',
									'tandatangan' 	=> null
								]);
							}
						}
						if ($input){
							AntrianTTE::where('id', $idne)->delete();
							$jumlah++;
						} else {
							$error = $error.'ID '.$idne.' gagal di reset<br />';
						}
					}
				}
			}
			echo $jumlah.' Terproses. Log Error '.$error;
		} else if ($jenis == 'NIK'){
			if(Session('previlage') == 'developer' OR Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$getalluser	= User::whereNotNull('nik')->groupBy('nik')->get();
			} else {
				$getalluser	= User::where('fakultas', Session('fakultas'))->whereNotNull('nik')->groupBy('nik')->get();
			}
			if (!empty($getalluser)){
				foreach ($getalluser as $result){
					$nik 			= $result->nik;
					$cekuser		= Simpegpegawai::where('nik', $nik)->first();
					if (isset($cekuser->nip_baru)){
						$nip		= $cekuser->nip_baru;
					} else {
						$cekuser	= Simpegpegawai::where('id', $result->nip)->first();
						if (isset($cekuser->nip_baru)){
							$nip	= $cekuser->nip_baru;	
						} else { $nip = ''; }
					}
					$arraygambar[] 	= array(
						'idne' 			=> $result->id,
						'nama'			=> $result->nama,
						'previlage'		=> $result->previlage,
						'email'			=> $result->email,
						'nik'			=> $result->nik,
						'nip'			=> $nip,
					);
				}
			}
			echo json_encode($arraygambar);
		} else {
			if ($jenis == 'ALL'){
				$jpenerima	= AntrianTTE::whereNull('keterangan')->groupBy('idsurat')->get();
				$syncall 	= DB::table('tbl_rekaptte')->where('certificateStatus', 'ISSUE')->get();
				foreach ($syncall as $rsync){
					User::where('email', $rsync->email)->update([
						'nik'	=> $rsync->nik
					]);
				}
			} elseif ($jenis == 'kelompok'){
				if ($pencarian == 'Sertifikat Internal'){
					$jpenerima	= AntrianTTE::whereNull('nonik')->get();
				} else {
					$jpenerima	= AntrianTTE::whereNotNull('nonik')->get();
				}
			} elseif ($jenis == 'pejabat'){
				$jpenerima		= AntrianTTE::where('pejabat', $pencarian)->get();
			} else {
				$jpenerima		= AntrianTTE::where('keterangan', 'LIKE', '%'.$pencarian.'%')->get();
			}
			if (!empty($jpenerima)){
				foreach ($jpenerima as $result) {
					$arraygambar[] = array(
						'idne' 			=> $result->id,
						'pejabat'		=> $result->pejabat,
						'jenis'			=> $result->jenis,
						'idsurat'		=> $result->idsurat,
						'keterangan'	=> $result->keterangan,
						'keteranganlama'=> $result->keteranganlama,
						'created_at'	=> $result->created_at,
					);
				}
			}
			echo json_encode($arraygambar);
		}
	}
}
