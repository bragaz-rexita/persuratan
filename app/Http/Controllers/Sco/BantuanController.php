<?php

namespace App\Http\Controllers\Sco;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Simpegpegawai;
use App\Models\Bantuanstudi;
use App\Models\Bantuanpublikasi;
use App\Models\Bantuanriset;
use App\Models\Bantuanpenerima;
use App\Models\Bantuansyarat;
use App\Models\Golongan;
use App\User;
use App\Histories;
use App\Models\Sktarif;
use App\Models\SettingKeuangan;
use App\Models\Ppabp;
use App\Models\Penerimasurat;
use App\Suratmasuk;
use App\Pejabatsurat;
use App\Models\KategoriPAK;
use App\Models\Penelitian;
use App\Models\Aktifitas;
use App\Models\Filess;
use App\Models\KLasifikasikepakaran;
use App\Models\KLasifikasipenelitian;
use App\Models\KLasifikasise;
use App\Models\Rumpunilmu;
use App\Models\Drafttubel;
use App\Models\Draftsk;
use App\Suratkeluar;
use App\Inboxsurat;
use App\Suratkeluartnpnomor;
use App\Models\DraftKontrak;
use App\Models\Templateskpp;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Validator;
use Session;
use DateTime;
use QrCode;
use PDFCREATOR;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class BantuanController extends Controller
{
    public function index() {
		$iduser			= Session('id');
		$fakpanjang		= Session('fakpanjang');
		$cceknip		= User::where('username', Session('username'))->count();
		if ($cceknip != 0){
			$ceknip		= User::where('username', Session('username'))->first();
			$nip		= $ceknip->nip;
		} else { $nip = ''; }
		
		$spesial		= Session('spesial');
		$mkelompok		= Session('jabatan');
		$mjabatan		= Session('previlage');
		$boleh 			= 'NO';
		if ($spesial == 'Admin DISTENDIK' OR $spesial == 'Admin SIDOKAR' OR $spesial == 'Admin Bantuan Studi' OR $spesial == 'Admin Bantuan Publikasi' OR $spesial == 'Admin Bantuan Riset' OR $spesial == 'Admin SK'){
			$boleh = 'YES';
		} else {
			if ($mkelompok == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' OR $mkelompok == 'Rektor' OR $mkelompok == 'Wakil Rektor Bidang Akademik'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Sekretaris Direktorat Sumber Daya Manusia'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Kepala Biro Keuangan'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Koordinator Bagian Akuntansi'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Koordinator Bagian Anggaran dan Perbendaharaan'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Subkoordinator Subbagian PNBP'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Subkoordinator Subbagian NON PNBP'){
				$boleh = 'YES';
			}
			if ($mjabatan == 'developer'){
				$boleh = 'YES';
			}
			if (Session('fakultas') == 'PASCAUB'){
				$boleh = 'YES';
			}
			if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$boleh = 'YES';
			}
		}
		if ($boleh == 'NO'){
			$data['sidebar'] = $mkelompok;
			return view('gakboleh', $data);
		} else {
			$tahun			 		= date("Y");
			$jpegawai 		 		= Simpegpegawai::all();
			$jpenerima 		 		= Bantuanpenerima::where('inputor', Session('fakultas'))->get();
			$cekdatask				= Sktarif::where('fakultas', Session('fakultas'))->count();
			$getjumlahthnini 		= Bantuanstudi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('created_at', 'LIKE', $tahun.'%')->groupBy('inputor')->count();
			if ($getjumlahthnini != 0){
				$jjumlahthnini 		= Bantuanstudi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('created_at', 'LIKE', $tahun.'%')->groupBy('inputor')->first();
				$sumbantuanstudi 	= $jjumlahthnini->jumlah;
				$sumbantuanstudi	= number_format( $sumbantuanstudi, 0 , '.' , ',' );
			}else { $sumbantuanstudi 	= 0; }
			
			$getjumlahthnini2 		= Bantuanpublikasi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('created_at', 'LIKE', $tahun.'%')->groupBy('inputor')->count();
			if ($getjumlahthnini2 != 0){
				$jjumlahthnini2 	= Bantuanpublikasi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('created_at', 'LIKE', $tahun.'%')->groupBy('inputor')->first();
				$sumbantuanpublikasi= $jjumlahthnini2->jumlah;
				$sumbantuanpublikasi= number_format( $sumbantuanpublikasi, 0 , '.' , ',' );
			}else { $sumbantuanpublikasi 	= 0; }
			if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
			$cekbpp						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->count();
			if ($cekbpp != 0){
				$jcekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->first();
				$idbpp					= $jcekbpp->isi1;
			}else {
				$idbpp					= 0;
			}
			$cekppk						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->count();
			if ($cekppk != 0){
				$jcekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->first();
				$idppk					= $jcekppk->isi1;
			}else {
				$idppk					= 0;
			}
			$data 						= [];
			
			$iduser						= Session('id');
			$cceknip					= User::where('username', Session('username'))->count();
			if ($cceknip != 0){
				$ceknip					= User::where('username', Session('username'))->first();
				$idpeg					= $ceknip->nip;
			} else { $idpeg = 0; }
			$ppabp 						= Ppabp::where('nama', 'LIKE', '%Fakultas%')->orderBy('nama', 'ASC')->get();
			$data['ppabp'] 				= $ppabp;
			$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$data['datask']      		= Sktarif::where('fakultas', Session('fakultas'))->get();
			$data['countmailbox']      	= $countmailbox;
			$data['idppk']				= $idppk;
			$data['fakpanjang']			= $fakpanjang;
			$data['idbpp']				= $idbpp;
			$data['pegawaine']			= $jpegawai;
			$data['sumbantuanstudi']	= $sumbantuanstudi;
			$data['sumbantuanpublikasi']= $sumbantuanpublikasi;
			$data['countdatask']		= $cekdatask;
			$data['penerimane']			= $jpenerima;
			$data['tahunne']			= date("Y");
			$data['sidebar']			= 'bantuan';
			$cekpejabat					= Pejabatsurat::where('pejabat', Session('jabatan'))->count();
			if ($cekpejabat != 0){
				return view('bantuan.reportbantuan', $data);
			} else {
				return view('bantuan.adminbantuanstudi', $data);
			}
			
		}
    }
	public function viewAdminPublikasi() {
		$iduser			= Session('id');
		$fakpanjang		= Session('fakpanjang');
		$cceknip		= User::where('username', Session('username'))->count();
		if ($cceknip != 0){
			$ceknip		= User::where('username', Session('username'))->first();
			$nip		= $ceknip->nip;
		} else { $nip = ''; }
		
		$spesial		= Session('spesial');
		$mkelompok		= Session('jabatan');
		$mjabatan		= Session('previlage');
		$boleh 			= 'NO';
		if ($spesial == 'Admin Bantuan Studi' OR $spesial == 'Admin Bantuan Publikasi' OR $spesial == 'Admin Bantuan Riset' OR $spesial == 'Admin SK'){
			$boleh = 'YES';
		} else {
			if ($mkelompok == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' OR $mkelompok == 'Rektor' OR $mkelompok == 'Wakil Rektor Bidang Akademik'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Sekretaris Direktorat Sumber Daya Manusia'){
				$boleh = 'YES';
			}
			
			if ($mkelompok == 'Kepala Biro Keuangan'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Koordinator Bagian Akuntansi'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Koordinator Bagian Anggaran dan Perbendaharaan'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Subkoordinator Subbagian PNBP'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Subkoordinator Subbagian NON PNBP'){
				$boleh = 'YES';
			}
			if ($mjabatan == 'developer'){
				$boleh = 'YES';
			}
			if (Session('fakultas') == 'PASCAUB'){
				$boleh = 'YES';
			}
			if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$boleh = 'YES';
			}
		}
		if ($boleh == 'NO'){
			$data['sidebar'] = $mkelompok;
			return view('gakboleh', $data);
		} else {
			$tahun			 		= date("Y");
			$jpegawai 		 		= Simpegpegawai::all();
			$jpenerima 		 		= Bantuanpenerima::where('inputor', Session('fakultas'))->get();
			$cekdatask				= Sktarif::where('fakultas', Session('fakultas'))->count();
			$getjumlahthnini 		= Bantuanstudi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('tahun', $tahun)->groupBy('tahun')->count();
			if ($getjumlahthnini != 0){
				$jjumlahthnini 		= Bantuanstudi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('tahun', $tahun)->groupBy('tahun')->first();
				$sumbantuanstudi 	= $jjumlahthnini->jumlah;
				$sumbantuanstudi	= number_format( $sumbantuanstudi, 0 , '.' , ',' );
			}else { $sumbantuanstudi 	= 0; }
			
			$getjumlahthnini2 		= Bantuanpublikasi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('tahun', $tahun)->groupBy('tahun')->count();
			if ($getjumlahthnini2 != 0){
				$jjumlahthnini2 	= Bantuanpublikasi::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('tahun', $tahun)->groupBy('tahun')->first();
				$sumbantuanpublikasi= $jjumlahthnini2->jumlah;
				$sumbantuanpublikasi= number_format( $sumbantuanpublikasi, 0 , '.' , ',' );
			}else { $sumbantuanpublikasi 	= 0; }
			if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
			$cekbpp						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Publikasi')->count();
			if ($cekbpp != 0){
				$jcekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Publikasi')->first();
				$idbpp					= $jcekbpp->isi1;
			}else {
				$idbpp					= 0;
			}
			$cekppk						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Publikasi')->count();
			if ($cekppk != 0){
				$jcekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Publikasi')->first();
				$idppk					= $jcekppk->isi1;
			}else {
				$idppk					= 0;
			}
			$data 						= [];
			$iduser						= Session('id');
			$cceknip					= User::where('username', Session('username'))->count();
			if ($cceknip != 0){
				$ceknip					= User::where('username', Session('username'))->first();
				$idpeg					= $ceknip->nip;
			} else { $idpeg = 0; }
			$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$data['countmailbox']      	= $countmailbox;
			$data['idppk']				= $idppk;
			$data['fakpanjang']			= $fakpanjang;
			$data['idbpp']				= $idbpp;
			$data['pegawaine']			= $jpegawai;
			$data['sumbantuanstudi']	= $sumbantuanstudi;
			$data['sumbantuanpublikasi']= $sumbantuanpublikasi;
			$data['countdatask']		= $cekdatask;
			$data['penerimane']			= $jpenerima;
			$data['tahunne']			= date("Y");
			$data['sidebar']			= 'bantuanadminpublikasi';
			$cekpejabat					= Pejabatsurat::where('pejabat', Session('jabatan'))->count();
			if ($cekpejabat != 0){
				return view('bantuan.reportbantuanpublikasi', $data);
			} else {
				return view('bantuan.adminbantuanpublikasi', $data);
			}
			
		}
    }
	public function viewAdminRiset() {
		$iduser			= Session('id');
		$fakpanjang		= Session('fakpanjang');
		$cceknip		= User::where('username', Session('username'))->count();
		if ($cceknip != 0){
			$ceknip		= User::where('username', Session('username'))->first();
			$nip		= $ceknip->nip;
		} else { $nip = ''; }
		
		$spesial		= Session('spesial');
		$mkelompok		= Session('jabatan');
		$mjabatan		= Session('previlage');
		$boleh 			= 'NO';
		if ($spesial == 'Admin Bantuan Studi' OR $spesial == 'Admin Bantuan Publikasi' OR $spesial == 'Admin Bantuan Riset' OR $spesial == 'Admin SK'){
			$boleh = 'YES';
		} else {
			if ($mkelompok == 'Wakil Rektor Bidang Keuangan dan Sumber Daya' OR $mkelompok == 'Rektor' OR $mkelompok == 'Wakil Rektor Bidang Akademik'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Sekretaris Direktorat Sumber Daya Manusia'){
				$boleh = 'YES';
			}
			
			if ($mjabatan == 'developer'){
				$boleh = 'YES';
			}
			if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$boleh = 'YES';
			}
		}
		if ($boleh == 'NO'){
			$data['sidebar'] = $mkelompok;
			return view('gakboleh', $data);
		} else {
			$tahun			 		= date("Y");
			$jpegawai 		 		= Simpegpegawai::all();
			$jpenerima 		 		= Bantuanpenerima::where('inputor', Session('fakultas'))->get();
			$cekdatask				= Sktarif::where('fakultas', Session('fakultas'))->count();
			
			$getjumlahthnini2 		= Bantuanriset::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('tahun', $tahun)->groupBy('tahun')->count();
			if ($getjumlahthnini2 != 0){
				$jjumlahthnini2 	= Bantuanriset::where('inputor', Session('fakultas'))->select(DB::raw("SUM(nominal) as jumlah"))->where('tahun', $tahun)->groupBy('tahun')->first();
				$sumbantuanpublikasi= $jjumlahthnini2->jumlah;
				$sumbantuanpublikasi= number_format( $sumbantuanpublikasi, 0 , '.' , ',' );
			}else { $sumbantuanpublikasi 	= 0; }
			if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
			$cekbpp						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Riset')->count();
			if ($cekbpp != 0){
				$jcekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Riset')->first();
				$idbpp					= $jcekbpp->isi1;
			}else {
				$idbpp					= 0;
			}
			$cekppk						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Riset')->count();
			if ($cekppk != 0){
				$jcekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Riset')->first();
				$idppk					= $jcekppk->isi1;
			}else {
				$idppk					= 0;
			}
			$data 						= [];
			$iduser						= Session('id');
			$cceknip					= User::where('username', Session('username'))->count();
			if ($cceknip != 0){
				$ceknip					= User::where('username', Session('username'))->first();
				$idpeg					= $ceknip->nip;
			} else { $idpeg = 0; }
			$jgrouppsk	= KLasifikasipenelitian::groupBy('bidang')->select('bidang')->orderBy('bidang')->get();
			$k			= 0;
			foreach ($jgrouppsk as $rgrouppsk) {
				$l  		= 0;
				$bidang		= $rgrouppsk->bidang;
				$jklasmk  	= KLasifikasipenelitian::where('bidang', $bidang)->orderBy('kode', 'ASC')->get();
				foreach ($jklasmk as $rklasmk) {
					$id 		= $rklasmk->id;
					$kode 		= $rklasmk->kode;
					$kelompok 	= $rklasmk->kelompok;
					$tulisanne 	= $kode.' - '.$kelompok;
					
					$data['listklspenelitian'][$k][$l]['nama']	= $tulisanne;
					$data['listklspenelitian'][$k][$l]['id']	= $rklasmk->kelompok;
					$l++;
				}
				$k++;
			}
			$y  		= 0;
			foreach ($jgrouppsk as $kgrouppsk) {
				$data['groupklspen'][$y]  =   $kgrouppsk->bidang;
				$y++;
			}
			
			$jgrouppsk	= KLasifikasise::groupBy('bidang')->select('bidang')->orderBy('bidang')->get();
			$k			= 0;
			foreach ($jgrouppsk as $rgrouppsk) {
				$l  		= 0;
				$bidang		= $rgrouppsk->bidang;
				$jklasmk  	= KLasifikasise::where('bidang', $bidang)->orderBy('kode', 'ASC')->get();
				foreach ($jklasmk as $rklasmk) {
					$id 		= $rklasmk->id;
					$kode 		= $rklasmk->kode;
					$kelompok 	= $rklasmk->kelompok;
					$tulisanne 	= $kode.' - '.$kelompok;
					
					$data['listklsse'][$k][$l]['nama']	= $tulisanne;
					$data['listklsse'][$k][$l]['id']	= $rklasmk->kelompok;
					$l++;
				}
				$k++;
			}
			$y  		= 0;
			foreach ($jgrouppsk as $kgrouppsk) {
				$data['groupklsse'][$y]  =   $kgrouppsk->bidang;
				$y++;
			}
			$jgroupprmn	= Rumpunilmu::groupBy('kelompok')->select('kelompok')->orderBy('kelompok')->get();
			$k			= 0;
			foreach ($jgroupprmn as $rgroupprmp) {
				$l  		= 0;
				$kelompok	= $rgroupprmp->kelompok;
				$jklasmk  	= Rumpunilmu::where('kelompok', $kelompok)->orderBy('kode', 'ASC')->get();
				foreach ($jklasmk as $rklasmk) {
					$id 		= $rklasmk->id;
					$kode 		= $rklasmk->kode;
					$rumpun 	= $rklasmk->rumpun;
					$tulisanne 	= $kode.' - '.$rumpun;
					$data['listrumpunilmu'][$k][$l]['nama']	= $tulisanne;
					$data['listrumpunilmu'][$k][$l]['id']	= $rklasmk->rumpun;
					$l++;
				}
				$k++;
			}
			$y  		= 0;
			foreach ($jgroupprmn as $kgrouppsk) {
				$data['grouprumpunilmu'][$y]  =   $kgrouppsk->kelompok;
				$y++;
			}
		
			$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$data['countmailbox']      	= $countmailbox;
			$data['idppk']				= $idppk;
			$data['fakpanjang']			= $fakpanjang;
			$data['idbpp']				= $idbpp;
			$data['pegawaine']			= $jpegawai;
			$data['sumbantuanpublikasi']= $sumbantuanpublikasi;
			$data['countdatask']		= $cekdatask;
			$data['penerimane']			= $jpenerima;
			$data['tahunne']			= date("Y");
			$data['sidebar']			= 'bantuanadminriset';
			$cekpejabat					= Pejabatsurat::where('pejabat', Session('jabatan'))->count();
			if ($cekpejabat != 0){
				return view('bantuan.reportbantuanriset', $data);
			} else {
				return view('bantuan.adminbantuanriset', $data);
			}
		}
    }
	public function daftarbantuanadmin() {
		$iduser			= Session('id');
		$fakpanjang		= Session('fakpanjang');
		$ceknip			= User::where('username', Session('username'))->first();
		if (isset($ceknip->nip)){
			$nip		= $ceknip->nip;
		} else {
			$nip		= 0;
		}
		$golongan 		= Golongan::orderBy('id', 'ASC')->get();
		$spesial		= Session('spesial');
		$mkelompok		= Session('jabatan');
		$mjabatan		= Session('previlage');
		$boleh 			= 'NO';
		if ($spesial == 'Admin DISTENDIK' OR $spesial == 'Admin SIDOKAR' OR $spesial == 'Admin Bantuan Studi' OR $spesial == 'Admin Bantuan Publikasi' OR $spesial == 'Admin Bantuan Riset' OR $spesial == 'Admin SK'){
			$boleh = 'YES';
		} else {
			if ($mkelompok == 'Sekretaris Direktorat Sumber Daya Manusia'){
				$boleh = 'YES';
			}
			if ($mkelompok == 'Kepala Sub Bagian PNBP'){
				$boleh = 'YES';
			}
			if ($mjabatan == 'developer'){
				$boleh = 'YES';
			}
			if (Session('fakultas') == 'PASCAUB'){
				$boleh = 'YES';
			}
			if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				$boleh = 'YES';
			}
		}
		
		if ($boleh == 'NO'){
			$data['sidebar'] = $mkelompok;
			return view('gakboleh', $data);
		} else {
			$tahun			 		= date("Y");
			$jpenerima 		 		= Bantuanpenerima::where('inputor', Session('fakultas'))->get();
			$jpegawai 		 		= Simpegpegawai::all();
			if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
			$cekbpp						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->count();
			if ($cekbpp != 0){
				$jcekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->first();
				$idbpp					= $jcekbpp->isi1;
			}else {
				$idbpp					= 0;
			}
			$cekppk						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->count();
			if ($cekppk != 0){
				$jcekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->first();
				$idppk					= $jcekppk->isi1;
			}else {
				$idppk					= 0;
			}
			
			$ppabp 						= Ppabp::where('nama', 'LIKE', '%Fakultas%')->orderBy('nama', 'ASC')->get();
			$data 						= [];
			$iduser						= Session('id');
			$cceknip					= User::where('username', Session('username'))->count();
			if ($cceknip != 0){
				$ceknip					= User::where('username', Session('username'))->first();
				$idpeg					= $ceknip->nip;
			} else { $idpeg = 0; }
			$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$data['pejabats']      		= Pejabatsurat::where('fakultas', Session('fakultas'))->get();
			$data['datask']      		= Sktarif::where('fakultas', Session('fakultas'))->get();
			$data['countmailbox']      	= $countmailbox;
			$data['ppabp'] 				= $ppabp;
			$data['golongan'] 			= $golongan;
			$data['idppk']				= $idppk;
			$data['fakpanjang']			= $fakpanjang;
			$data['idbpp']				= $idbpp;
			$data['pegawaine']			= $jpegawai;
			$data['penerimane']			= $jpenerima;
			$data['tahunne']			= date("Y");
			$data['sidebar']			= 'daftarbantuanadmin';
			if (Session('fakultas') == 'KP'){
				return view('bantuan.daftarbantuanadmin', $data);
				//return view('bantuan.daftarbantuanadmfakultas', $data);
			} else {
				return view('bantuan.daftarbantuanadmfakultas', $data);		
			}
		}
    }
	public function bantuanUser() {
		$iduser			= Session('id');
		$fakpanjang		= Session('fakpanjang');
		$ceknip			= User::where('username', Session('username'))->first();
		$nip			= $ceknip->nip;
		if ($nip == ''){
			$golongan 			= Golongan::orderBy('id', 'ASC')->get();
			$data['golongan'] 	= $golongan;
			$data['fakultass'] 	= User::whereNotIn('fakultas', ['KP', 'XX', 'Safehouse'])->orderBy('fakpanjang', 'ASC')->groupBy('fakultas')->get();
			$data['semula'] 	= 'bantuanadmin';
			return view('anyari', $data);
		}else {
			//seksalah kudune daftar sek
			if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
			$cdatane1					= Bantuanstudi::where('idpegawai', $nip)->count();
			$cdatane2					= Bantuanpublikasi::where('idpegawai', $nip)->count();
			$cekdatask					= Sktarif::count();
			$data 						= [];
			$iduser						= Session('id');
			$cceknip					= User::where('username', Session('username'))->count();
			if ($cceknip != 0){
				$ceknip					= User::where('username', Session('username'))->first();
				$idpeg					= $ceknip->nip;
			} else { $idpeg = 0; }
			$countmailbox 				= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$data['countmailbox']      	= $countmailbox;
			$data['cbantuanstudi']		= $cdatane1;
			$data['cpublikasi']			= $cdatane2;
			$data['idpegawai']			= 0; //ikisengdiganti
			$data['countdatask']		= $cekdatask;
			$data['fakpanjang']			= $fakpanjang;
			$data['tahunne']			= date("Y");
			$data['sidebar']			= 'bantuanuser';
			return view('bantuan.userbantuan', $data);
		}
    }
	public function rekapallBantuan(Request $request) {
		$arrayrekapbantuan 	= [];
		$fakultas			= Session('fakultas');
		$jencari    		= $request->input('val01');
		$bulan    			= $request->input('val02');
		$tahun    			= $request->input('val03');
		if ($jencari == 'All'){
			$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tanggalterima', '0000-00-00')->groupBy('scankhs')->orderBy('created_at', 'DESC')->get();
			if (!empty($jdatane)){
				foreach ($jdatane as $rdatane) {
					$idpegawai		= $rdatane->idpegawai;
					$scankhs		= $rdatane->scankhs;
					$noagenda		= $rdatane->noagenda;
					$thnagenda		= $rdatane->thnagenda;
					$idsuratmasuk	= '';
					$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
					if ($ceksuratmasuk != 0){
						$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
						$idsuratmasuk = $getdatasrt->id;
					}
					$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
					$namapegawai	= $getpegawai->nama;
					$jenispeg		= $getpegawai->nip;
					$spp 			= 0;
					$hidup			= 0;
					$buku			= 0;
					$akhir			= 0;
					$penelitian		= 0;
					$kursus			= 0;
					$budal			= 0;
					$mulih			= 0;
					
					$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tanggalterima', '0000-00-00')->where('scankhs', $scankhs)->get();
					foreach ($getalljenis as $rjenis) {
						$jenis 		= $rjenis->jenis;
						$nominal	= $rjenis->nominal;
						if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
						else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
						else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
						else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
						else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
						else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
						else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
						else { $penelitian = $penelitian + $nominal; }
					}
					$total = $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
					$arrayrekapbantuan[] = array(
						'idne'				=> $rdatane->id, 
						'idpegawai'			=> $idpegawai,
						'namapegawai'		=> $namapegawai, 
						'jenispeg'			=> $jenispeg, 
						'ppabp'				=> $rdatane->ppabp, 
						'universitas'		=> $rdatane->universitas, 
						'fakultas'			=> $rdatane->fakultas, 
						'prodi'				=> $rdatane->prodi, 
						'jenjang'			=> $rdatane->jenjang, 
						'jenis'				=> $rdatane->jenis, 
						'nomspp'			=> $spp,
						'nomhidup'			=> $hidup,
						'nombuku'			=> $buku,
						'nomakhir'			=> $akhir,
						'nompenelitian'		=> $penelitian,
						'nomkursus'			=> $kursus,
						'nombudal'			=> $budal,
						'nommulih'			=> $mulih,
						'bantuan'			=> $rdatane->bantuan, 
						'nominal'			=> $total, 
						'semester'			=> $rdatane->semester, 
						'tahun'				=> $rdatane->tahun, 
						'scanloa'			=> $rdatane->scanloa,
						'sktarif'			=> $rdatane->sktarif, 
						'scantandaterima'	=> $rdatane->scantandaterima, 
						'tanggalterima'		=> '',
						'tulisjenis'		=> 'Bantuan Studi',
						'tabel'				=> 'studi',
						'noagenda'			=> $noagenda,
						'thnagenda'			=> $thnagenda,
						'idsuratmasuk'		=> $idsuratmasuk,
					);
				}
			}
			$cdatanepublikasi		= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('tanggalterima', '0000-00-00')->orderBy('created_at', 'DESC')->get();
			if (!empty($cdatanepublikasi)){
				foreach ($cdatanepublikasi as $rdatane) {
					$idpegawai		= $rdatane->idpegawai;
					$kategori		= $rdatane->kategori;
					$idsuratmasuk	= '';
					if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
					if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
					if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
					if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
					if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
					if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
					if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
					if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
					if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
					if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
					if (isset($getpegawai->id)){
						$namapegawai	= $getpegawai->nama_lengkap;
						$jenispeg		= $getpegawai->jenispeg;
					} else {
						$namapegawai	= '';
						$jenispeg		= '';
					}
					$arrayrekapbantuan[] = array(
						'idne'				=> $rdatane->id, 
						'idpegawai'			=> $idpegawai,
						'namapegawai'		=> $namapegawai, 
						'jenispeg'			=> $jenispeg, 
						'ppabp'				=> $rdatane->ppabp, 
						'universitas'		=> $rdatane->namajurnal, 
						'fakultas'			=> $kategori, 
						'prodi'				=> $rdatane->judul, 
						'jenjang'			=> $rdatane->issn, 
						'jenis'				=> $rdatane->jenis,
						'nomspp'			=> '',
						'nomhidup'			=> '',
						'nombuku'			=> '',
						'nomakhir'			=> '',
						'nompenelitian'		=> '',
						'nomkursus'			=> '',
						'nombudal'			=> '',
						'nommulih'			=> '',
						'bantuan'			=> $rdatane->laman, 
						'nominal'			=> (int)$rdatane->nominal, 
						'semester'			=> $rdatane->semester, 
						'tahun'				=> $rdatane->tahun, 
						'scanloa'			=> $rdatane->scanloa,
						'sktarif'			=> $rdatane->voljurnal, 
						'scantandaterima'	=> $rdatane->scantandaterima, 
						'tanggalterima'		=> $rdatane->halaman,
						'tulisjenis'		=> $tulisjenis,
						'tabel'				=> 'publikasi',
						'noagenda'			=> '',
						'thnagenda'			=> '',
						'idsuratmasuk'		=> '',
					);
				}
			}
		} else if ($jencari == 'Bantuan Publikasi'){
			if ($bulan == 'All'){
				$cdatanepublikasi		= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('tanggalterima', '0000-00-00')->orderBy('created_at', 'DESC')->get();
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$kategori		= $rdatane->kategori;
						$idsuratmasuk	= '';
						if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
						if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
						if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
						if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
						if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
						if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
						if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
						if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
						if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
						if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
						if (isset($getpegawai->id)){
							$namapegawai	= $getpegawai->nama_lengkap;
							$jenispeg		= $getpegawai->jenispeg;
							$nip			= $getpegawai->nip_baru;
						} else {
							$namapegawai	= '';
							$jenispeg		= '';
							$nip			= '';
						}
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'nip'				=> $nip, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'namajurnal'		=> $rdatane->namajurnal, 
							'kategori'			=> $kategori, 
							'judul'				=> $rdatane->judul, 
							'issn'				=> $rdatane->issn, 
							'laman'				=> $rdatane->laman,
							'voljurnal'			=> $rdatane->voljurnal,
							'halaman'			=> $rdatane->halaman, 
							'jurusan'			=> $rdatane->jurusan, 
							'prodi'				=> $rdatane->prodi, 
							'bidangilmu'		=> $rdatane->bidangilmu,
							'sjr'				=> $rdatane->sjr, 
							'indeks'			=> $rdatane->indeks, 
							'status'			=> $rdatane->status, 
							'nominal'			=> $rdatane->nominal, 
							'biaya'				=> $rdatane->biaya, 
							'rekomendasi'		=> $rdatane->rekomendasi, 
							'pajak'				=> $rdatane->pajak, 
							'tahun'				=> $rdatane->tahun, 
							'keterangan'		=> $rdatane->keterangan, 
							'tanggalterima'		=> $rdatane->tanggalterima, 
							'scandisposisi'		=> $rdatane->scandisposisi, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'scanloa'			=> $rdatane->scanloa, 
							'jenis'				=> $rdatane->jenis, 
							'tulisjenis'		=> $tulisjenis,
							'tabel'				=> 'publikasi',
						);
					}
				}
			} else if ($bulan == 'INI'){
				$tahun = date("Y");
				$cdatanepublikasi		= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->get();
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$kategori		= $rdatane->kategori;
						if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
						if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
						if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
						if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
						if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
						if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
						if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
						if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
						if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
						if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
						if (isset($getpegawai->id)){
							$namapegawai	= $getpegawai->nama_lengkap;
							$jenispeg		= $getpegawai->jenispeg;
							$nip			= $getpegawai->nip_baru;
						} else {
							$namapegawai	= '';
							$jenispeg		= '';
							$nip			= '';
						}
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'nip'				=> $nip, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'namajurnal'		=> $rdatane->namajurnal, 
							'kategori'			=> $kategori, 
							'judul'				=> $rdatane->judul, 
							'issn'				=> $rdatane->issn, 
							'laman'				=> $rdatane->laman,
							'voljurnal'			=> $rdatane->voljurnal,
							'halaman'			=> $rdatane->halaman, 
							'jurusan'			=> $rdatane->jurusan, 
							'prodi'				=> $rdatane->prodi, 
							'bidangilmu'		=> $rdatane->bidangilmu,
							'sjr'				=> $rdatane->sjr, 
							'indeks'			=> $rdatane->indeks, 
							'status'			=> $rdatane->status, 
							'nominal'			=> $rdatane->nominal, 
							'biaya'				=> $rdatane->biaya, 
							'rekomendasi'		=> $rdatane->rekomendasi, 
							'pajak'				=> $rdatane->pajak, 
							'tahun'				=> $rdatane->tahun, 
							'keterangan'		=> $rdatane->keterangan, 
							'tanggalterima'		=> $rdatane->tanggalterima, 
							'scandisposisi'		=> $rdatane->scandisposisi, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'scanloa'			=> $rdatane->scanloa, 
							'jenis'				=> $rdatane->jenis, 
							'tulisjenis'		=> $tulisjenis,
							'tabel'				=> 'publikasi',
						);
					}
				}
			} else {
				if ($tahun == 'all' OR $tahun == 'ALL'){
					$cdatanepublikasi		= Bantuanpublikasi::where('inputor', Session('fakultas'))->orderBy('created_at', 'DESC')->get();
				} else {
					$cdatanepublikasi		= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->get();
				}
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$kategori		= $rdatane->kategori;
						if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
						if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
						if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
						if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
						if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
						if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
						if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
						if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
						if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
						if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
						if (isset($getpegawai->id)){
							$namapegawai	= $getpegawai->nama_lengkap;
							$jenispeg		= $getpegawai->jenispeg;
							$nip			= $getpegawai->nip_baru;
						} else {
							$namapegawai	= '';
							$jenispeg		= '';
							$nip			= '';
						}
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'nip'				=> $nip, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'namajurnal'		=> $rdatane->namajurnal, 
							'kategori'			=> $kategori, 
							'judul'				=> $rdatane->judul, 
							'issn'				=> $rdatane->issn, 
							'laman'				=> $rdatane->laman,
							'voljurnal'			=> $rdatane->voljurnal,
							'halaman'			=> $rdatane->halaman, 
							'jurusan'			=> $rdatane->jurusan, 
							'prodi'				=> $rdatane->prodi, 
							'bidangilmu'		=> $rdatane->bidangilmu,
							'sjr'				=> $rdatane->sjr, 
							'indeks'			=> $rdatane->indeks, 
							'status'			=> $rdatane->status, 
							'nominal'			=> $rdatane->nominal, 
							'biaya'				=> $rdatane->biaya, 
							'rekomendasi'		=> $rdatane->rekomendasi, 
							'pajak'				=> $rdatane->pajak, 
							'tahun'				=> $rdatane->tahun, 
							'keterangan'		=> $rdatane->keterangan, 
							'tanggalterima'		=> $rdatane->tanggalterima, 
							'scandisposisi'		=> $rdatane->scandisposisi, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'scanloa'			=> $rdatane->scanloa, 
							'jenis'				=> $rdatane->jenis, 
							'tulisjenis'		=> $tulisjenis,
							'tabel'				=> 'publikasi',
						);
					}
				}
			}
		} else if ($jencari == 'Bantuan Riset'){
			if ($bulan == 'INI'){
				$tahun = date("Y");
				$cdatanepublikasi		= Bantuanriset::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->get();
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$kategori		= $rdatane->kategori;
						$tulisjenis		= $rdatane->jenis;
						$ppabp			= $rdatane->ppabp;
						$carifakultas	= User::where('fakpanjang', $ppabp)->where('fakultas', '!=', '')->first();
						if (isset($carifakultas->id)){
							$fakultas	= $carifakultas->fakultas;
						} else {
							$fakultas	= $ppabp;
						}
						$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
						if (isset($getpegawai->id)){
							$namapegawai	= $getpegawai->nama_lengkap;
							$jenispeg		= $getpegawai->jenispeg;
							$nip			= $getpegawai->nip_baru;
						} else {
							$namapegawai	= '';
							$jenispeg		= '';
							$nip			= '';
						}
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'nip'				=> $nip, 
							'jenispeg'			=> $jenispeg, 
							'fakultas'			=> $fakultas, 
							'ppabp'				=> $rdatane->ppabp, 
							'namajurnal'		=> $rdatane->namajurnal, 
							'kategori'			=> $kategori, 
							'judul'				=> $rdatane->judul, 
							'issn'				=> $rdatane->issn, 
							'laman'				=> $rdatane->laman,
							'voljurnal'			=> $rdatane->voljurnal,
							'halaman'			=> $rdatane->halaman, 
							'jurusan'			=> $rdatane->jurusan, 
							'prodi'				=> $rdatane->prodi, 
							'bidangilmu'		=> $rdatane->bidangilmu,
							'sjr'				=> $rdatane->sjr, 
							'indeks'			=> $rdatane->indeks, 
							'status'			=> $rdatane->status, 
							'nominal'			=> $rdatane->nominal, 
							'biaya'				=> $rdatane->biaya, 
							'rekomendasi'		=> $rdatane->rekomendasi, 
							'pajak'				=> $rdatane->pajak, 
							'tahun'				=> $rdatane->tahun, 
							'keterangan'		=> $rdatane->keterangan, 
							'tanggalterima'		=> $rdatane->tanggalterima, 
							'scandisposisi'		=> $rdatane->scandisposisi, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'scanloa'			=> $rdatane->scanloa, 
							'jenis'				=> $rdatane->jenis, 
							'tulisjenis'		=> $tulisjenis,
							'tabel'				=> 'riset',
						);
					}
				}
			} else {
				if ($tahun == 'all' OR $tahun == 'ALL'){
					$cdatanepublikasi		= Bantuanriset::where('inputor', Session('fakultas'))->orderBy('created_at', 'DESC')->get();
				} else {
					$cdatanepublikasi		= Bantuanriset::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->get();
				}
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$kategori		= $rdatane->kategori;
						$ppabp			= $rdatane->ppabp;
						$carifakultas	= User::where('fakpanjang', $ppabp)->where('fakultas', '!=', '')->first();
						if (isset($carifakultas->id)){
							$fakultas	= $carifakultas->fakultas;
						} else {
							$fakultas	= $ppabp;
						}
						$tulisjenis		= $kategori;
						if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
						if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
						if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
						if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
						if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
						if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
						if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
						if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
						if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
						if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
						$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
						if (isset($getpegawai->id)){
							$namapegawai	= $getpegawai->nama_lengkap;
							$jenispeg		= $getpegawai->jenispeg;
							$nip			= $getpegawai->nip_baru;
						} else {
							$namapegawai	= '';
							$jenispeg		= '';
							$nip			= '';
						}
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'nip'				=> $nip, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'fakultas'			=> $fakultas, 
							'namajurnal'		=> $rdatane->namajurnal, 
							'kategori'			=> $kategori, 
							'judul'				=> $rdatane->judul, 
							'issn'				=> $rdatane->issn, 
							'laman'				=> $rdatane->laman,
							'voljurnal'			=> $rdatane->voljurnal,
							'halaman'			=> $rdatane->halaman, 
							'jurusan'			=> $rdatane->jurusan, 
							'prodi'				=> $rdatane->prodi, 
							'bidangilmu'		=> $rdatane->bidangilmu,
							'sjr'				=> $rdatane->sjr, 
							'indeks'			=> $rdatane->indeks, 
							'status'			=> $rdatane->status, 
							'nominal'			=> $rdatane->nominal, 
							'biaya'				=> $rdatane->biaya, 
							'rekomendasi'		=> $rdatane->rekomendasi, 
							'pajak'				=> $rdatane->pajak, 
							'tahun'				=> $rdatane->tahun, 
							'keterangan'		=> $rdatane->keterangan, 
							'tanggalterima'		=> $rdatane->tanggalterima, 
							'scandisposisi'		=> $rdatane->scandisposisi, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'scanloa'			=> $rdatane->scanloa, 
							'jenis'				=> $rdatane->jenis, 
							'tulisjenis'		=> $tulisjenis,
							'tabel'				=> 'riset',
						);
					}
				}
			}
		} else if ($jencari == 'Bantuan Studi'){
			if ($bulan == 'All'){
				$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tanggalterima', '0000-00-00')->groupBy('scankhs')->orderBy('created_at', 'DESC')->get();
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$scankhs		= $rdatane->scankhs;
						$noagenda		= $rdatane->noagenda;
						$thnagenda		= $rdatane->thnagenda;
						$sptjm			= $rdatane->sptjm;
						if ($sptjm == '' OR is_null($sptjm)){
							Bantuanstudi::where('scankhs', $rdatane->scankhs)->update([
								'sptjm' => $rdatane->scankhs
							]);
						}
						
						$idsuratmasuk	= '';
						//$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
						//if ($ceksuratmasuk != 0){
						//	$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
						//	$idsuratmasuk = $getdatasrt->id;
						//}
						$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
						if (isset($getpegawai->id)){
							$namapegawai	= $getpegawai->nama;
							$jenispeg		= $getpegawai->nip;
							$negara			= $getpegawai->negara;
							$namapt			= $getpegawai->namapt;
							$jenjang		= $getpegawai->jenjang;
							$mulaistudi		= $getpegawai->mulaistudi;
							$jenis			= $getpegawai->jenis;
							$sumberbiaya	= $getpegawai->sumberbiaya;
							$tahunsls		= $getpegawai->tahunsls;
							$hape			= $getpegawai->hape;
							if ($hape == '-' OR $hape == '0'){ $hape = ''; }
							if ($hape != ''){
								$arrhpdosen = str_split($hape);
								$hape	= '';
								foreach($arrhpdosen as $rhape){
									if ($rhape == '-'){ $rhape = ''; }
									if ($rhape != ''){
										if ($hape == ''){
											if ($rhape == '0'){
												$hape = '62';
											}else {
												$hape = $rhape;
											}
										} else {
											$hape = $hape.$rhape;
										}
									}
								}
							}
							$spp 			= 0;
							$hidup			= 0;
							$buku			= 0;
							$akhir			= 0;
							$penelitian		= 0;
							$kursus			= 0;
							$budal			= 0;
							$mulih			= 0;
							$karantina		= 0;
							$tambahanbiaya	= 0;
							
							$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tanggalterima', '0000-00-00')->where('scankhs', $scankhs)->get();
							foreach ($getalljenis as $rjenis) {
								$jenis 		= $rjenis->jenis;
								$nominal	= $rjenis->nominal;
								if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
								else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
								else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
								else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
								else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
								else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
								else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
								else if ($jenis == 'Tambahan Biaya Hidup'){ $tambahanbiaya = $tambahanbiaya + $nominal; }
								else if ($jenis == 'Karantina'){ $karantina = $karantina + $nominal; }
								else { $penelitian = $penelitian + $nominal; }
							}
							$total = $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
							$arrayrekapbantuan[] = array(
								'idne'				=> $rdatane->id, 
								'idpegawai'			=> $idpegawai,
								'namapegawai'		=> $namapegawai, 
								'jenispeg'			=> $jenispeg, 
								'ppabp'				=> $rdatane->ppabp, 
								'universitas'		=> $rdatane->universitas, 
								'fakultas'			=> $rdatane->fakultas, 
								'prodi'				=> $rdatane->prodi, 
								'jenjang'			=> $rdatane->jenjang, 
								'jenis'				=> $rdatane->jenis, 
								'hape'				=> $hape,
								'nomspp'			=> $spp,
								'nomhidup'			=> $hidup,
								'nombuku'			=> $buku,
								'nomakhir'			=> $akhir,
								'nompenelitian'		=> $penelitian,
								'nomkursus'			=> $kursus,
								'nombudal'			=> $budal,
								'nommulih'			=> $mulih,
								'nomtambahanbiaya'	=> $tambahanbiaya,
								'nomkarantina'		=> $karantina,
								'bantuan'			=> $rdatane->bantuan, 
								'nominal'			=> $total, 
								'semester'			=> $rdatane->semester, 
								'tahun'				=> $rdatane->tahun, 
								'scanloa'			=> $rdatane->scanloa,
								'sktarif'			=> $rdatane->sktarif, 
								'scantandaterima'	=> $rdatane->scantandaterima, 
								'tanggalterima'		=> '',
								'tulisjenis'		=> 'Bantuan Studi',
								'tabel'				=> 'studi',
								'noagenda'			=> $noagenda,
								'thnagenda'			=> $thnagenda,
								'idsuratmasuk'		=> $idsuratmasuk,
								'negara'			=> $getpegawai->negara,
								'namapt'			=> $getpegawai->namapt,
								'mulaistudi'		=> $getpegawai->mulaistudi,
								'jenis'				=> $getpegawai->jenis,
								'sumberbiaya'		=> $getpegawai->sumberbiaya,
								'tahunsls'			=> $getpegawai->tahunsls,
							);
						}
					}
				}
			} else if ($bulan == 'INI'){
				$tahun = date("Y");
				$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('created_at', 'LIKE', $tahun.'%')->orderBy('created_at', 'DESC')->groupBy('scankhs')->get();
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$scankhs		= $rdatane->scankhs;
						$noagenda		= $rdatane->noagenda;
						$thnagenda		= $rdatane->thnagenda;
						$idsuratmasuk	= '';
						//$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
						//if ($ceksuratmasuk != 0){
						//	$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
						//	$idsuratmasuk = $getdatasrt->id;
						//}
						$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
						$namapegawai	= $getpegawai->nama;
						$jenispeg		= $getpegawai->nip;
						$hape			= $getpegawai->hape;
						if ($hape == '-' OR $hape == '0'){ $hape = ''; }
						if ($hape != ''){
							$arrhpdosen = str_split($hape);
							$hape	= '';
							foreach($arrhpdosen as $rhape){
								if ($rhape == '-'){ $rhape = ''; }
								if ($rhape != ''){
									if ($hape == ''){
										if ($rhape == '0'){
											$hape = '62';
										}else {
											$hape = $rhape;
										}
									} else {
										$hape = $hape.$rhape;
									}
								}
							}
						}
						$spp 			= 0;
						$hidup			= 0;
						$buku			= 0;
						$akhir			= 0;
						$penelitian		= 0;
						$kursus			= 0;
						$budal			= 0;
						$mulih			= 0;
						$karantina		= 0;
						$tambahanbiaya	= 0;
							
						$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('scankhs', $scankhs)->get();
						foreach ($getalljenis as $rjenis) {
							$jenis 		= $rjenis->jenis;
							$nominal	= $rjenis->nominal;
							if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
							else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
							else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
							else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
							else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
							else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
							else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
							else if ($jenis == 'Tambahan Biaya Hidup'){ $tambahanbiaya = $tambahanbiaya + $nominal; }
							else if ($jenis == 'Karantina'){ $karantina = $karantina + $nominal; }
							else { $penelitian = $penelitian + $nominal; }
						}
						$total = $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'universitas'		=> $rdatane->universitas, 
							'fakultas'			=> $rdatane->fakultas, 
							'prodi'				=> $rdatane->prodi, 
							'jenjang'			=> $rdatane->jenjang, 
							'jenis'				=> $rdatane->jenis, 
							'hape'				=> $hape,
							'nomspp'			=> $spp,
							'nomhidup'			=> $hidup,
							'nombuku'			=> $buku,
							'nomakhir'			=> $akhir,
							'nompenelitian'		=> $penelitian,
							'nomkursus'			=> $kursus,
							'nombudal'			=> $budal,
							'nommulih'			=> $mulih,
							'nomtambahanbiaya'	=> $tambahanbiaya,
							'nomkarantina'		=> $karantina,
							'bantuan'			=> $rdatane->bantuan, 
							'nominal'			=> $total, 
							'semester'			=> $rdatane->semester, 
							'tahun'				=> $rdatane->tahun, 
							'scanloa'			=> $rdatane->scanloa, 
							'sktarif'			=> $rdatane->sktarif, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'tanggalterima'		=> '',
							'tulisjenis'		=> 'Bantuan Studi',
							'tabel'				=> 'studi',
							'noagenda'			=> $noagenda,
							'thnagenda'			=> $thnagenda,
							'idsuratmasuk'		=> $idsuratmasuk,
						);
					}
				}
			} else {
				if ($tahun == 'all' OR $tahun == 'ALL'){
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->orderBy('created_at', 'DESC')->groupBy('scankhs')->get();
				} else {
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->groupBy('scankhs')->get();
				}
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$scankhs		= $rdatane->scankhs;
						$noagenda		= $rdatane->noagenda;
						$thnagenda		= $rdatane->thnagenda;
						$idsuratmasuk	= '';
						//$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
						//if ($ceksuratmasuk != 0){
						//	$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
						//	$idsuratmasuk = $getdatasrt->id;
						//}
						$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
						$namapegawai	= $getpegawai->nama;
						$jenispeg		= $getpegawai->nip;
						$spp 			= 0;
						$hidup			= 0;
						$buku			= 0;
						$akhir			= 0;
						$penelitian		= 0;
						$kursus			= 0;
						$budal			= 0;
						$mulih			= 0;
						$karantina		= 0;
						$tambahanbiaya	= 0;
						$hape			= $getpegawai->hape;
						if ($hape == '-' OR $hape == '0'){ $hape = ''; }
						if ($hape != ''){
							$arrhpdosen = str_split($hape);
							$hape	= '';
							foreach($arrhpdosen as $rhape){
								if ($rhape == '-'){ $rhape = ''; }
								if ($rhape != ''){
									if ($hape == ''){
										if ($rhape == '0'){
											$hape = '62';
										}else {
											$hape = $rhape;
										}
									} else {
										$hape = $hape.$rhape;
									}
								}
							}
						}
						$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('scankhs', $scankhs)->get();
						foreach ($getalljenis as $rjenis) {
							$jenis 		= $rjenis->jenis;
							$nominal	= $rjenis->nominal;
							if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
							else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
							else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
							else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
							else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
							else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
							else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
							else if ($jenis == 'Tambahan Biaya Hidup'){ $tambahanbiaya = $tambahanbiaya + $nominal; }
							else if ($jenis == 'Karantina'){ $karantina = $karantina + $nominal; }
							else { $penelitian = $penelitian + $nominal; }
						}
						$total = $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'universitas'		=> $rdatane->universitas, 
							'fakultas'			=> $rdatane->fakultas, 
							'prodi'				=> $rdatane->prodi, 
							'jenjang'			=> $rdatane->jenjang, 
							'jenis'				=> $rdatane->jenis,
							'hape'				=> $hape,
							'nomspp'			=> $spp,
							'nomhidup'			=> $hidup,
							'nombuku'			=> $buku,
							'nomakhir'			=> $akhir,
							'nompenelitian'		=> $penelitian,
							'nomkursus'			=> $kursus,
							'nombudal'			=> $budal,
							'nommulih'			=> $mulih,
							'nomkarantina'		=> $karantina,
							'nomtambahanbiaya'	=> $tambahanbiaya,
							'bantuan'			=> $rdatane->bantuan, 
							'nominal'			=> $total, 
							'semester'			=> $rdatane->semester, 
							'tahun'				=> $rdatane->tahun, 
							'scanloa'			=> $rdatane->scanloa, 
							'sktarif'			=> $rdatane->sktarif, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'tanggalterima'		=> '',
							'tulisjenis'		=> 'Bantuan Studi',
							'tabel'				=> 'studi',
							'noagenda'			=> $noagenda,
							'thnagenda'			=> $thnagenda,
							'idsuratmasuk'		=> $idsuratmasuk,
						);
					}
				}
			}
		} else if ($jencari == 'rekappenerima'){
			if ($bulan == 'INI'){
				$tahun = date("Y");
				$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->groupBy('scankhs')->get();
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$scankhs		= $rdatane->scankhs;
						$noagenda		= $rdatane->noagenda;
						$thnagenda		= $rdatane->thnagenda;
						$idsuratmasuk	= '';
						$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
						if ($ceksuratmasuk != 0){
							$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
							$idsuratmasuk = $getdatasrt->id;
						}
						$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
						$namapegawai	= $getpegawai->nama;
						$jenispeg		= $getpegawai->nip;
						$cekpegawai		= Simpegpegawai::where('nip_baru', $getpegawai->nip)->first();
						if (isset($cekpegawai->id)){
							$tgllahir	= $cekpegawai->tgl_lahir;
							$nidn		= $cekpegawai->nidn;
						} else {
							$tgllahir	= '-';
							$nidn		= '-';
						}
						$spp 			= 0;
						$hidup			= 0;
						$buku			= 0;
						$akhir			= 0;
						$penelitian		= 0;
						$kursus			= 0;
						$budal			= 0;
						$mulih			= 0;
						$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('scankhs', $scankhs)->get();
						foreach ($getalljenis as $rjenis) {
							$jenis 		= $rjenis->jenis;
							$nominal	= $rjenis->nominal;
							if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
							else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
							else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
							else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
							else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
							else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
							else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
							else { $penelitian = $penelitian + $nominal; }
						}
						
						$total 			= $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'universitas'		=> $rdatane->universitas, 
							'fakultas'			=> $rdatane->fakultas, 
							'prodi'				=> $rdatane->prodi, 
							'jenjang'			=> $rdatane->jenjang, 
							'jenis'				=> $rdatane->jenis, 
							'nomspp'			=> $spp,
							'nomhidup'			=> $hidup,
							'nombuku'			=> $buku,
							'nomakhir'			=> $akhir,
							'nompenelitian'		=> $penelitian,
							'nomkursus'			=> $kursus,
							'nombudal'			=> $budal,
							'nommulih'			=> $mulih,
							'bantuan'			=> $rdatane->bantuan, 
							'nominal'			=> $total, 
							'semester'			=> $rdatane->semester, 
							'tahun'				=> $rdatane->tahun, 
							'scanloa'			=> $rdatane->scanloa, 
							'sktarif'			=> $rdatane->sktarif, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'tanggalterima'		=> '',
							'tulisjenis'		=> 'Bantuan Studi',
							'tabel'				=> 'studi',
							'tgllahir'			=> $tgllahir,
							'nidn'				=> $nidn,
							'noagenda'			=> $noagenda,
							'thnagenda'			=> $thnagenda,
							'idsuratmasuk'		=> $idsuratmasuk,
						);
					}
				}
			} else {
				if ($tahun == 'all' OR $tahun == 'ALL'){
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->orderBy('created_at', 'DESC')->groupBy('idpegawai')->get();
				} else {
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('tahun', $tahun)->orderBy('created_at', 'DESC')->groupBy('scankhs')->get();
				}
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$idpegawai		= $rdatane->idpegawai;
						$scankhs		= $rdatane->scankhs;
						$noagenda		= $rdatane->noagenda;
						$thnagenda		= $rdatane->thnagenda;
						$idsuratmasuk	= '';
						if ($tahun == 'all' OR $tahun == 'ALL'){
							//none
						} else {
							$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
							if ($ceksuratmasuk != 0){
								$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
								$idsuratmasuk = $getdatasrt->id;
							}
						}
						$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
						$namapegawai	= $getpegawai->nama;
						$nip			= $getpegawai->nip;
						$jenispeg		= $getpegawai->jenispeg;
						$spp 			= 0;
						$hidup			= 0;
						$buku			= 0;
						$akhir			= 0;
						$penelitian		= 0;
						$kursus			= 0;
						$budal			= 0;
						$mulih			= 0;
						$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('scankhs', $scankhs)->get();
						foreach ($getalljenis as $rjenis) {
							$jenis 		= $rjenis->jenis;
							$nominal	= $rjenis->nominal;
							if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
							else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
							else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
							else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
							else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
							else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
							else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
							else { $penelitian = $penelitian + $nominal; }
						}
						$total = $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
						$cekpegawai		= Simpegpegawai::where('nip_baru', $getpegawai->nip)->first();
						if (isset($cekpegawai->id)){
							$tgllahir	= $cekpegawai->tgl_lahir;
							$nidn		= $cekpegawai->nidn;
						} else {
							$tgllahir	= '-';
							$nidn		= '-';
						}
						
						$arrayrekapbantuan[] = array(
							'idne'				=> $rdatane->id, 
							'idpegawai'			=> $idpegawai,
							'namapegawai'		=> $namapegawai, 
							'nip'				=> $nip, 
							'jenispeg'			=> $jenispeg, 
							'ppabp'				=> $rdatane->ppabp, 
							'universitas'		=> $rdatane->universitas, 
							'fakultas'			=> $rdatane->fakultas, 
							'prodi'				=> $rdatane->prodi, 
							'jenjang'			=> $rdatane->jenjang, 
							'jenis'				=> $rdatane->jenis,
							'nomspp'			=> $spp,
							'nomhidup'			=> $hidup,
							'nombuku'			=> $buku,
							'nomakhir'			=> $akhir,
							'nompenelitian'		=> $penelitian,
							'nomkursus'			=> $kursus,
							'nombudal'			=> $budal,
							'nommulih'			=> $mulih,
							'bantuan'			=> $rdatane->bantuan, 
							'nominal'			=> $total, 
							'semester'			=> $rdatane->semester, 
							'tahun'				=> $rdatane->tahun, 
							'scanloa'			=> $rdatane->scanloa, 
							'sktarif'			=> $rdatane->sktarif, 
							'scantandaterima'	=> $rdatane->scantandaterima, 
							'tanggalterima'		=> '',
							'tulisjenis'		=> 'Bantuan Studi',
							'tabel'				=> 'studi',
							'tgllahir'			=> $tgllahir,
							'nidn'				=> $nidn,
							'noagenda'			=> $noagenda,
							'thnagenda'			=> $thnagenda,
							'idsuratmasuk'		=> $idsuratmasuk,
						);
					}
				}
			}
		} else if ($jencari == 'perjenis'){
			if ($bulan == 'ALL'){
				$valcari = $tahun.'-%';
			} else {
				$valcari = $tahun.'-'.$bulan.'-%';
			}
			if ($tahun == 'all' OR $tahun == 'ALL'){
				$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->orderBy('idpegawai', 'ASC')->get();
			} else {
				$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('created_at', 'LIKE', $valcari)->orderBy('idpegawai', 'ASC')->get();
			}
			if (!empty($jdatane)){
				foreach ($jdatane as $rdatane) {
					$idpegawai		= $rdatane->idpegawai;
					$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
					if (isset($getpegawai->nama)){
						$namapegawai= $getpegawai->nama;
						$jenispeg	= $getpegawai->nip;
					} else {
						$namapegawai= 'Deleted Data';
						$jenispeg	= 'Deleted Data';
					}
					$arrayrekapbantuan[] = array(
						'idne'				=> $rdatane->id, 
						'idpegawai'			=> $idpegawai,
						'namapegawai'		=> $namapegawai, 
						'jenispeg'			=> $jenispeg, 
						'ppabp'				=> $rdatane->ppabp, 
						'universitas'		=> $rdatane->universitas, 
						'fakultas'			=> $rdatane->fakultas, 
						'prodi'				=> $rdatane->prodi, 
						'jenjang'			=> $rdatane->jenjang, 
						'jenis'				=> $rdatane->jenis, 
						'bantuan'			=> $rdatane->bantuan, 
						'nominal'			=> $rdatane->nominal, 
						'semester'			=> $rdatane->semester, 
						'tahun'				=> $rdatane->tahun, 
						'keterangan'		=> $rdatane->keterangan, 
					);
				}
			}
		} else {
			$jdatane			= Bantuanstudi::where('tanggalterima', '0000-00-00')->where('idpegawai', $jencari)->orderBy('created_at', 'DESC')->groupBy('scankhs')->get();
			if (!empty($jdatane)){
				foreach ($jdatane as $rdatane) {
					$idpegawai		= $rdatane->idpegawai;
					$scankhs		= $rdatane->scankhs;
					$noagenda		= $rdatane->noagenda;
					$thnagenda		= $rdatane->thnagenda;
					$fakultas		= $rdatane->fakultas;
					$ppabp			= $rdatane->ppabp;
					$sptjm			= $rdatane->sptjm;
					$idsuratmasuk	= '';
					/*
					$ceksuratmasuk	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->count();
					if ($ceksuratmasuk != 0){
						$getdatasrt	= Suratmasuk::where('noagenda', $noagenda)->where('tglmasuk', 'LIKE', '%'.$thnagenda.'%')->where('fakultas', $fakultas)->first();
						$idsuratmasuk = $getdatasrt->id;
					}
					*/
					$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
					$namapegawai	= $getpegawai->nama;
					$jenispeg		= $getpegawai->nip;
					$fakpenerima	= $getpegawai->fakultas;
					$negara			= $getpegawai->negara;
					$spp 			= 0;
					$hidup			= 0;
					$buku			= 0;
					$akhir			= 0;
					$penelitian		= 0;
					$kursus			= 0;
					$budal			= 0;
					$mulih			= 0;
					if ($ppabp == '' OR is_null($ppabp)){
						$ppabp 		= $fakpenerima;
					}
					if ($fakultas == '' OR is_null($fakultas)){
						$fakultas 	= $fakpenerima;
					}
					$getalljenis	= Bantuanstudi::where('inputor', Session('fakultas'))->where('scankhs', $scankhs)->get();
					foreach ($getalljenis as $rjenis) {
						$jenis 		= $rjenis->jenis;
						$nominal	= $rjenis->nominal;
						if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
						else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
						else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
						else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
						else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
						else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
						else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
						else { $penelitian = $penelitian + $nominal; }
					}
					$total = $spp + $buku + $hidup + $akhir + $penelitian + $kursus + $budal + $mulih;
					$arrayrekapbantuan[] = array(
						'idne'				=> $rdatane->id, 
						'idpegawai'			=> $idpegawai,
						'namapegawai'		=> $namapegawai, 
						'jenispeg'			=> $jenispeg, 
						'ppabp'				=> $ppabp, 
						'universitas'		=> $rdatane->universitas, 
						'fakultas'			=> $fakultas, 
						'prodi'				=> $rdatane->prodi, 
						'jenjang'			=> $rdatane->jenjang, 
						'negara'			=> $negara, 
						'jenis'				=> $rdatane->jenis,
						'nomspp'			=> $spp,
						'nomhidup'			=> $hidup,
						'nombuku'			=> $buku,
						'nomakhir'			=> $akhir,
						'nompenelitian'		=> $penelitian,
						'nomkursus'			=> $kursus,
						'nombudal'			=> $budal,
						'nommulih'			=> $mulih,
						'bantuan'			=> $rdatane->bantuan, 
						'nominal'			=> $total, 
						'semester'			=> $rdatane->semester, 
						'tahun'				=> $rdatane->tahun, 
						'scanloa'			=> $rdatane->scanloa, 
						'sktarif'			=> $rdatane->sktarif, 
						'scantandaterima'	=> $rdatane->scantandaterima, 
						'tanggalterima'		=> '',
						'tulisjenis'		=> 'Bantuan Studi',
						'tabel'				=> 'studi',
						'noagenda'			=> $noagenda,
						'thnagenda'			=> $thnagenda,
						'idsuratmasuk'		=> $idsuratmasuk,
					);
				}
			}
			$cdatanepublikasi	= Bantuanpublikasi::where('tanggalterima', '0000-00-00')->where('idpegawai', $jencari)->orderBy('created_at', 'DESC')->get();
			if (!empty($cdatanepublikasi)){
				foreach ($cdatanepublikasi as $rdatane) {
					$idpegawai		= $rdatane->idpegawai;
					$kategori		= $rdatane->kategori;
					if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
					if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
					if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
					if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
					if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
					if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
					if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
					if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
					if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
					if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
					if (isset($getpegawai->id)){
						$namapegawai	= $getpegawai->nama_lengkap;
						$jenispeg		= $getpegawai->jenispeg;
					} else {
						$namapegawai	= '';
						$jenispeg		= '';
					}
					$arrayrekapbantuan[] = array(
						'idne'				=> $rdatane->id, 
						'idpegawai'			=> $idpegawai,
						'namapegawai'		=> $namapegawai, 
						'jenispeg'			=> $jenispeg, 
						'ppabp'				=> $rdatane->ppabp, 
						'universitas'		=> $rdatane->namajurnal, 
						'fakultas'			=> $kategori, 
						'prodi'				=> $rdatane->judul, 
						'jenjang'			=> $rdatane->issn, 
						'jenis'				=> $rdatane->jenis,
						'nomspp'			=> '',
						'nomhidup'			=> '',
						'nombuku'			=> '',
						'nomakhir'			=> '',
						'nompenelitian'		=> '',
						'nomkursus'			=> '',
						'nombudal'			=> '',
						'nommulih'			=> '',
						'bantuan'			=> $rdatane->laman, 
						'nominal'			=> (int)$rdatane->nominal, 
						'semester'			=> $rdatane->semester, 
						'tahun'				=> $rdatane->tahun, 
						'scanloa'			=> $rdatane->scanloa,
						'sktarif'			=> $rdatane->voljurnal, 
						'scantandaterima'	=> $rdatane->scantandaterima, 
						'tanggalterima'		=> $rdatane->halaman,
						'tulisjenis'		=> $tulisjenis,
						'tabel'				=> 'publikasi'
					);
				}
			}
			$cdataneriset		= Bantuanriset::where('tanggalterima', '0000-00-00')->where('idpegawai', $jencari)->orderBy('created_at', 'DESC')->get();
			if (!empty($cdataneriset)){
				foreach ($cdataneriset as $rdatane) {
					$idpegawai		= $rdatane->idpegawai;
					$kategori		= $rdatane->kategori;
					$tulisjenis		= $rdatane->kategori;
					if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
					if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
					if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
					if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
					if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
					if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
					if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
					if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
					if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
					if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
					if (isset($getpegawai->id)){
						$namapegawai	= $getpegawai->nama_lengkap;
						$jenispeg		= $getpegawai->jenispeg;
					} else {
						$namapegawai	= '';
						$jenispeg		= '';
					}
					$arrayrekapbantuan[] = array(
						'idne'				=> $rdatane->id, 
						'idpegawai'			=> $idpegawai,
						'namapegawai'		=> $namapegawai, 
						'jenispeg'			=> $jenispeg, 
						'ppabp'				=> $rdatane->ppabp, 
						'universitas'		=> $rdatane->namajurnal, 
						'fakultas'			=> $kategori, 
						'prodi'				=> $rdatane->judul, 
						'jenjang'			=> $rdatane->issn, 
						'jenis'				=> $rdatane->jenis,
						'nomspp'			=> '',
						'nomhidup'			=> '',
						'nombuku'			=> '',
						'nomakhir'			=> '',
						'nompenelitian'		=> '',
						'nomkursus'			=> '',
						'nombudal'			=> '',
						'nommulih'			=> '',
						'bantuan'			=> $rdatane->laman, 
						'nominal'			=> (int)$rdatane->nominal, 
						'semester'			=> $rdatane->semester, 
						'tahun'				=> $rdatane->tahun, 
						'scanloa'			=> $rdatane->scanloa,
						'sktarif'			=> $rdatane->voljurnal, 
						'scantandaterima'	=> $rdatane->scantandaterima, 
						'tanggalterima'		=> $rdatane->halaman,
						'tulisjenis'		=> $tulisjenis,
						'tabel'				=> 'riset'
					);
				}
			}
		}
    	echo json_encode($arrayrekapbantuan);	
    }
	public function jrekapbantuanPpabp(Request $request) {
		$arrayrekapppabp 	= [];
		$jencari    		= $request->input('val01');
		$bulan    			= $request->input('val02');
		$tahun    			= $request->input('val03');
		if ($jencari == 'All'){
			$getallppabp = Bantuanpenerima::where('inputor', Session('fakultas'))->groupBy('fakultas')->get();
			foreach ($getallppabp as $rallppabp) {
				$ppabp 			= $rallppabp->fakultas;
				$cgetsingkatan	= User::where('fakpanjang', $ppabp)->count();
				if ($cgetsingkatan != 0){
					$getsingkatan	= User::where('fakpanjang', $ppabp)->first();
					$fakultas		= $getsingkatan->fakultas;
				} else { $fakultas =  $ppabp; }
				$spp 			= 0;
				$hidup 			= 0;
				$buku 			= 0;
				$penelitian 	= 0;
				$kursus			= 0;
				$budal			= 0;
				$mulih			= 0;
				$akhir 			= 0;
				$semnas 		= 0;
				$semin 			= 0;
				$publikasi 		= 0;
				$jumlah			= 0;
				$total			= 0;
				if ($bulan == 'ALL'){
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-%')->orderBy('created_at', 'DESC')->get();
				}else {
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-'.$bulan.'-%')->orderBy('created_at', 'DESC')->get();
				}
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$jumlah++;
						$nominal	= $rdatane->nominal;
						$jenis		= $rdatane->jenis;
						$total		= $total + $nominal;
						if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
						else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
						else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
						else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
						else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
						else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
						else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
						else { $penelitian = $penelitian + $nominal; }
					}
				}
				if ($bulan == 'ALL'){
					$cdatanepublikasi	= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-%')->orderBy('created_at', 'DESC')->get();
				}else {
					$cdatanepublikasi	= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-'.$bulan.'-%')->orderBy('created_at', 'DESC')->get();
				}
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$jenis 		= $rdatane->jenis;
						$nominal 	= $rdatane->nominal;
						$jumlah++;
						if ($jenis == 'NASIONAL TER-AKREDITASI'){ $semnas = $semnas + $nominal; }
						else if ($jenis == 'NASIONAL TIDAK TER-AKREDITASI'){ $semnas = $semnas + $nominal; }
						else if ($jenis == 'INTER-NASIONAL'){ $semin = $semin + $nominal; }
						else { $publikasi = $publikasi + $nominal; }
						$total = $total + $nominal;
					}
				}
				$arrayrekapppabp[] = array(
					'bulan' 		=> $bulan,
					'tahun'			=> $tahun, 
					'spp'			=> $spp, 
					'hidup'			=> $hidup, 
					'buku'			=> $buku,
					'penelitian'	=> $penelitian,
					'kursus'		=> $kursus,
					'budal'			=> $budal,
					'mulih'			=> $mulih,
					'akhir'			=> $akhir,
					'ppabp'			=> $fakultas, 
					'semnas'		=> $semnas, 
					'semin'			=> $semin, 
					'publikasi'		=> $publikasi, 
					'jumlah'		=> $jumlah, 
					'total'			=> $total, 
				);
			}
		} else if ($jencari == 'Bantuan Publikasi'){
			$getallppabp = Bantuanpenerima::where('inputor', Session('fakultas'))->groupBy('inputor')->get();
			foreach ($getallppabp as $rallppabp) {
				$ppabp 			= $rallppabp->inputor;
				$cgetsingkatan	= User::where('fakpanjang', $ppabp)->count();
				if ($cgetsingkatan != 0){
					$getsingkatan	= User::where('fakpanjang', $ppabp)->first();
					$fakultas		= $getsingkatan->fakultas;
				} else { $fakultas =  $ppabp; }
				$spp 			= 0;
				$hidup 			= 0;
				$buku 			= 0;
				$penelitian 	= 0;
				$akhir 			= 0;
				$kursus			= 0;
				$budal			= 0;
				$mulih			= 0;
				$semnas 		= 0;
				$semin 			= 0;
				$publikasi 		= 0;
				$jumlah			= 0;
				$total			= 0;
				if ($bulan == 'ALL'){
					$cdatanepublikasi	= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('inputor', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-%')->orderBy('created_at', 'DESC')->get();
				}else {
					$cdatanepublikasi	= Bantuanpublikasi::where('inputor', Session('fakultas'))->where('inputor', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-'.$bulan.'-%')->orderBy('created_at', 'DESC')->get();
				}
				if (!empty($cdatanepublikasi)){
					foreach ($cdatanepublikasi as $rdatane) {
						$jenis 		= $rdatane->jenis;
						$nominal 	= $rdatane->nominal;
						$jumlah++;
						if ($jenis == 'NASIONAL TER-AKREDITASI'){ $semnas = $semnas + $nominal; }
						else if ($jenis == 'NASIONAL TIDAK TER-AKREDITASI'){ $semnas = $semnas + $nominal; }
						else if ($jenis == 'INTER-NASIONAL'){ $semin = $semin + $nominal; }
						else { $publikasi = $publikasi + $nominal; }
						$total = $total + $nominal;
					}
				}
				$arrayrekapppabp[] = array(
					'bulan' 		=> $bulan,
					'tahun'			=> $tahun, 
					'spp'			=> $spp, 
					'hidup'			=> $hidup, 
					'buku'			=> $buku, 
					'penelitian'	=> $penelitian,
					'kursus'		=> $kursus,
					'budal'			=> $budal,
					'mulih'			=> $mulih,
					'akhir'			=> $akhir,
					'ppabp'			=> $fakultas, 
					'semnas'		=> $semnas, 
					'semin'			=> $semin, 
					'publikasi'		=> $publikasi, 
					'jumlah'		=> $jumlah, 
					'total'			=> $total, 
				);
			}
		} else if ($jencari == 'Bantuan Riset'){
			if ($bulan == 'ALL'){
				$cdatanepublikasi	= Bantuanriset::where('inputor', Session('fakultas'))->where('tahun', $tahun)->groupBy('ppabp')->orderBy('idpegawai', 'ASC')->get();
			}else {
				$cdatanepublikasi	= Bantuanriset::where('inputor', Session('fakultas'))->where('tahun', $tahun)->groupBy('ppabp')->orderBy('idpegawai', 'ASC')->get();
			}
			if (!empty($cdatanepublikasi)){
				foreach ($cdatanepublikasi as $rdatane) {
					$jumlah 			= 0;
					$nominal 			= 0;
					$jjumlahthnini2 	= Bantuanriset::where('inputor', Session('fakultas'))->where('ppabp', $rdatane->ppabp)->where('tahun', $tahun)->select(DB::raw("SUM(nominal) as jumlah"))->groupBy('tahun')->first();
					$nominal			= $jjumlahthnini2->jumlah;
					$jumlah				= Bantuanriset::where('inputor', Session('fakultas'))->where('ppabp', $rdatane->ppabp)->where('tahun', $tahun)->count();
					$arrayrekapppabp[] = array(
						'bulan' 		=> $bulan,
						'tahun'			=> $tahun, 
						'ppabp'			=> $rdatane->ppabp, 
						'jumlah'		=> $jumlah,
						'nominal'		=> $nominal, 
					);
				}
			}
			
		} else if ($jencari == 'Bantuan Studi'){
			$getallppabp = Bantuanpenerima::where('inputor', Session('fakultas'))->groupBy('fakultas')->get();
			foreach ($getallppabp as $rallppabp) {
				$ppabp 			= $rallppabp->fakultas;
				$cgetsingkatan	= User::where('fakpanjang', $ppabp)->count();
				if ($cgetsingkatan != 0){
					$getsingkatan	= User::where('fakpanjang', $ppabp)->first();
					$fakultas		= $getsingkatan->fakultas;
				} else { $fakultas =  $ppabp; }
				$spp 			= 0;
				$hidup 			= 0;
				$buku 			= 0;
				$penelitian 	= 0;
				$akhir 			= 0;
				$kursus			= 0;
				$budal			= 0;
				$mulih			= 0;
				$semnas 		= 0;
				$semin 			= 0;
				$publikasi 		= 0;
				$jumlah			= 0;
				$total			= 0;
				if ($tahun == 'all' OR $tahun == 'ALL'){
					$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->orderBy('created_at', 'DESC')->get();
				} else {
					if ($bulan == 'ALL'){
						$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-%')->orderBy('created_at', 'DESC')->get();
					}else {
						$jdatane	= Bantuanstudi::where('inputor', Session('fakultas'))->where('ppabp', $ppabp)->where('tanggalterima', 'LIKE', $tahun.'-'.$bulan.'-%')->orderBy('created_at', 'DESC')->get();
					}
				}
				if (!empty($jdatane)){
					foreach ($jdatane as $rdatane) {
						$jumlah++;
						$nominal	= $rdatane->nominal;
						$jenis		= $rdatane->jenis;
						$total		= $total + $nominal;
						if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
						else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
						else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
						else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
						else if ($jenis == 'Tes Kursus'){ $kursus = $kursus + $nominal; }
						else if ($jenis == 'Tiket Keberangkatan'){ $budal = $budal + $nominal; }
						else if ($jenis == 'Tiket Pulang'){ $mulih = $mulih + $nominal; }
						else { $penelitian = $penelitian + $nominal; }
					}
				}
				$arrayrekapppabp[] = array(
					'bulan' 		=> $bulan,
					'tahun'			=> $tahun, 
					'spp'			=> $spp, 
					'hidup'			=> $hidup, 
					'buku'			=> $buku, 
					'penelitian'	=> $penelitian,
					'kursus'		=> $kursus,
					'budal'			=> $budal,
					'mulih'			=> $mulih,
					'akhir'			=> $akhir,
					'ppabp'			=> $fakultas, 
					'semnas'		=> $semnas, 
					'semin'			=> $semin, 
					'publikasi'		=> $publikasi, 
					'jumlah'		=> $jumlah, 
					'total'			=> $total, 
				);
			}
		}
    	echo json_encode($arrayrekapppabp);	
    }
	public function jSktarif() {
		$arrayasktarif 		= [];
		$arrayasktarif[] = array(
			'idne' 			=> 'new',
			'deskripsi' 	=> '<span class="label bg-green">Tambah Data Baru</span>',
			'nomor'			=> '',
			'tahun' 		=> '',
			'namafile'		=> '',
		);
		$cdatane			= Sktarif::where('fakultas', Session('fakultas'))->count();
		if ($cdatane != 0){
			$jdatane	= Sktarif::where('fakultas', Session('fakultas'))->get();
			foreach ($jdatane as $rdatane) {
				$arrayasktarif[] = array(
					'idne' 			=> $rdatane->id,
					'deskripsi' 	=> $rdatane->deskripsi,
					'nomor'			=> $rdatane->nomor,
					'tahun' 		=> $rdatane->tahun,
					'namafile'		=> $rdatane->namafile,
				);
			}
		}
    	echo json_encode($arrayasktarif);	
    }
	public function jallData() {
		$arrayalldata 		= [];
		$homebase			= url("/");
		if (Session('idjabatan') == '3'){
			$cdatane			= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->orderBy('fakultas', 'ASC')->orderBy('nip', 'ASC')->get();
		} else {
			$cdatane			= Bantuanpenerima::where('inputor', Session('fakultas'))->orWhere('created_by', Session('nama'))->orderBy('id', 'DESC')->get();
		}
		if (!empty($cdatane)){
			foreach ($cdatane as $rdatane) {
				$idne 			= $rdatane->id;
				$nip 			= $rdatane->nip;
				$idpeg 			= $rdatane->idpeg;
				$jabfung 		= $rdatane->jabfung;
				$email 			= $rdatane->email;
				$sptjm 			= $rdatane->sptjm;
				$jstudi 	 	= 0;
				$jpublikasi		= 0;
				$cstudi			= 0;
				$cpublikasi		= 0;
				if ($idpeg == 0 OR is_null($idpeg)){
					$getidpeg		= Simpegpegawai::where('nip_baru', $nip)->first();
					if (isset($getidpeg->id)){
						$idpeg		= $getidpeg->id;
						Bantuanpenerima::where('id', $idne)->update([
							'idpeg' => $idpeg
						]);
					}
				}
				if ($jabfung == '' OR is_null($jabfung)){
					$cekjabfung = Drafttubel::where('nip', $nip)->orderBy('id', 'DESC')->first();
					if (isset($cekjabfung->id)){
						Bantuanpenerima::where('id', $idne)->update([
							'golongan'			=> $cekjabfung->golongan,
							'jabfung'			=> $cekjabfung->jabfung,
							'created_by'		=> Session('nama'),
							'negara'			=> $cekjabfung->tempatstudi,
							'namapt'			=> $cekjabfung->tempatstudi,
							'jenjang'			=> $cekjabfung->jenjang,
							'mulaistudi'		=> $cekjabfung->mulai,
							'jenis'				=> $cekjabfung->jenis,
							'sumberbiaya'		=> $cekjabfung->biaya,
							'tahunsls'			=> $cekjabfung->akhir,
						]);
					}
					$ceksurat = Draftsk::where('marking', 'LIKE', 'TUBEL%')->where('nip', $nip)->get();
					if (!empty($ceksurat)){
						foreach ($ceksurat as $rows){
							$ceksek = Bantuansyarat::where('idpegawai', $nip)->where('jenis', 'SK Nomor '.$rows->nomor.' Tahun '.$rows->tahun)->count();
							if ($ceksek == 0){
								Bantuansyarat::create([
									'idpegawai' 		=> $rows->nip, 
									'jenis'				=> 'SK Nomor '.$rows->nomor.' Tahun '.$rows->tahun, 
									'jenfile'			=> 'SCO',
									'namafile'			=> $homebase.'/viewsurat/954db2a8075c782c586e33e36ed2cc8c-'.$rows->id, 
									'keterangan'		=> $rows->jenissk
								]);
							}
						}
					}
				}
				/*
				if ($rdatane->created_by == 'Import From SIMPEG V.2'){
					$client 	= new Client();
					$res 		= $client->request('GET', 'https://pegsvc.ub.ac.id/pegawai-service/api/v2/sco/pegawai?cons_id=sco-app&signature=KkhKSF/o4XEd6kUNlkiux96gyyNFFWs79/UoeLWnYCA=&nama=&nip='.$nip);
					$status		= (string)$res->getStatusCode();
					if ($status == '200'){
						$stream = json_decode($res->getBody());
						if (isset($stream[0])){
							$hasil	= $stream[0];
							Bantuanpenerima::where('id', $idne)->update([
								'golongan'			=> $hasil->golongan,
								'jabfung'			=> $hasil->jabatan_fungsional,
								'created_by'		=> 'Update Using SIMPEG',
								'fakultas'			=> $hasil->unit_homebase,
								'hape'				=> $hasil->nomor_hp,
								'email'				=> $hasil->email,
							]);
						}
					}
				}
				*/
				/*
				$cstudi			= Bantuanstudi::where('idpegawai', $idne)->count();
				if ($cstudi != 0){
					$getstudi	 = Bantuanstudi::select(DB::raw('SUM(nominal) as total'))->where('idpegawai', $idne)->groupBy('idpegawai')->first();
					$jstudi		 = $getstudi->total;
					
				}
				$cpublikasi		 = Bantuanpublikasi::where('idpegawai', $idpeg)->count();
				if ($cstudi != 0){
					$getpublikasi= Bantuanpublikasi::select(DB::raw('SUM(nominal) as total'))->where('idpegawai', $idpeg)->groupBy('idpegawai')->count();
					if ($getpublikasi != 0){
						$getpublikasi= Bantuanpublikasi::select(DB::raw('SUM(nominal) as total'))->where('idpegawai', $idpeg)->groupBy('idpegawai')->first();
						$jpublikasi	 = $getpublikasi->total;
					} else { $jpublikasi = 0; }
					
				}
				*/
				$ceksyarat		= Bantuansyarat::where('idpegawai', $idne)->whereNotNull('namafile')->count();
				$ceksyarat2		= Bantuansyarat::where('idpegawai', $nip)->whereNotNull('namafile')->count();
				$ceksyarat		= $ceksyarat + $ceksyarat2;
				if ($ceksyarat < 3){
					$syarat 	 = '<span class="label label-warning">'.$ceksyarat.' Terupload</small>';
				} else {
					$syarat 	 = '<span class="label label-success">'.$ceksyarat.' Terupload</small>';
				}
				$jenjang = $rdatane->jenjang;
				
				if (Session('idjabatan') == '3'){
					if ($jenjang == 'Sp (Spesialis)'){
						$jenjang = 'Sp 1 (Spesialis 1)';
					}
					if ($jenjang == 'Sp1 (Spesialis)'){
						$jenjang = 'Sp 1 (Spesialis 1)';
					}
					if ($jenjang == 'Sp2 (Subspesialis)'){
						$jenjang = 'Sp 2 (Spesialis 2)';
					}
				}
				$arrayalldata[] = array(
					'id' 				=> $idne,
					'nama' 				=> $rdatane->nama,
					'nip'				=> $rdatane->nip,
					'fakultas'			=> $rdatane->fakultas,
					'email'				=> $rdatane->email,
					'hape'				=> $rdatane->hape,
					'golongan'			=> $rdatane->golongan,
					'jenispeg'			=> $rdatane->jenispeg,
					'negara'			=> $rdatane->negara,
					'namapt'			=> $rdatane->namapt,
					'jenjang'			=> $jenjang,
					'prodi'				=> $rdatane->prodi,
					'fakstudi'			=> $rdatane->fakstudi,
					'mulaistudi'		=> $rdatane->mulaistudi,
					'jenis'				=> $rdatane->jenis,
					'sumberbiaya'		=> $rdatane->sumberbiaya,
					'tahunsls'			=> $rdatane->tahunsls,
					'jabfung'			=> $rdatane->jabfung,
					'startsmt'			=> $rdatane->startsmt,
					'startgangen'		=> $rdatane->startgangen,
					'startthnakad'		=> $rdatane->startthnakad,
					'endsmt'			=> $rdatane->endsmt,
					'endgangen'			=> $rdatane->endgangen,
					'endthnakad'		=> $rdatane->endthnakad,
					'judul'				=> $rdatane->judul,
					'updated_at'		=> $rdatane->updated_at,
					'idpeg'				=> $idpeg,
					'bantuanjstudi'		=> $jstudi,
					'bantuanjpublikasi'	=> $jpublikasi,
					'bantuancstudi'		=> $cstudi,
					'bantuancpublikasi'	=> $cpublikasi,
					'syarat'			=> $syarat,
				);
			}
		}
		if (Session('fakultas') == 'KP'){
			$qdatasrt	= Drafttubel::whereNull('movetobantuan')->orWhere('movetobantuan', '0')->get();
			if (!empty($qdatasrt)){
				foreach ($qdatasrt as $getdatasrt) {
					if ($getdatasrt->jabfung == 'Tenaga Pengajar' OR $getdatasrt->jabfung == 'Asisten Ahli' OR $getdatasrt->jabfung == 'Lektor' OR $getdatasrt->jabfung == 'Lektor Kepala' OR $getdatasrt->jabfung == 'Guru Besar'){
						$jenispeg = 'Dosen';
					} else {
						$jenispeg = 'Tendik';
					}
					$ceksek = Bantuanpenerima::where('nip', $getdatasrt->nip)->count();
					if ($ceksek == 0){
						Bantuanpenerima::create([
							'nama' 				=> $getdatasrt->nama,
							'nip'				=> $getdatasrt->nip,
							'fakultas'			=> $getdatasrt->unitkerja,
							'email'				=> '',
							'hape'				=> '',
							'golongan'			=> $getdatasrt->golongan,
							'jabfung'			=> $getdatasrt->jabfung,
							'jenispeg'			=> $jenispeg,
							'inputor'			=> 'KP',
							'created_by'		=> Session('nama'),
							'negara'			=> $getdatasrt->tempatstudi,
							'namapt'			=> $getdatasrt->tempatstudi,
							'jenjang'			=> $getdatasrt->jenjang,
							'mulaistudi'		=> $getdatasrt->mulai,
							'jenis'				=> $getdatasrt->jenis,
							'sumberbiaya'		=> $getdatasrt->biaya,
							'tahunsls'			=> $getdatasrt->akhir,
							'idpeg'				=> 0,
						]);
					}
					$ceksurat = Draftsk::where('marking', 'LIKE', 'TUBEL%')->where('nip', $getdatasrt->nip)->get();
					if (!empty($ceksurat)){
						foreach ($ceksurat as $rows){
							$ceksek = Bantuansyarat::where('idpegawai', $getdatasrt->nip)->where('jenis', 'SK Nomor '.$rows->nomor.' Tahun '.$rows->tahun)->count();
							if ($ceksek == 0){
								Bantuansyarat::create([
									'idpegawai' 		=> $rows->nip, 
									'jenis'				=> 'SK Nomor '.$rows->nomor.' Tahun '.$rows->tahun, 
									'jenfile'			=> 'SCO',
									'namafile'			=> $homebase.'/viewsurat/954db2a8075c782c586e33e36ed2cc8c-'.$rows->id, 
									'keterangan'		=> $rows->jenissk
								]);
							}
						}
					}
					Drafttubel::where('id', $getdatasrt->id)->update([
						'movetobantuan'		=> '1'
					]);
					
				}
			} 
		}
    	echo json_encode($arrayalldata);	
    }
	public function jalldataPegawai() {
		$arrayalldatapeg	= [];
		$cdatane			= Simpegpegawai::orderBy('ppabp', 'ASC')->orderBy('nama', 'ASC')->get();
		if (!empty($cdatane)){
			foreach ($cdatane as $rdatane) {
				$arrayalldatapeg[] = array(
					'id' 				=> $rdatane->id,
					'nama' 				=> $rdatane->nama_lengkap,
					'nip'				=> $rdatane->nip_baru,
					'fakultas'			=> $rdatane->ppabp,
					'golongan'			=> $rdatane->golongan,
					'jenispeg'			=> $rdatane->status_jabatan,
				);
			}
		}
    	echo json_encode($arrayalldatapeg);	
    }
	public function settingMaksbantuan() {
		$arrayasettingmak 		= [];
		
		$cdatane			= SettingKeuangan::where('jenis', 'LIKE', 'Bantuan%')->get();
		if (!empty($cdatane)){
			foreach ($cdatane as $rdatane) {
				$arrayasettingmak[] = array(
					'id' 			=> $rdatane->id,
					'deskripsi' 	=> $rdatane->jenis,
					'maksimal'		=> $rdatane->isi1,
				);
			}
		}
    	echo json_encode($arrayasettingmak);	
    }
	public function jcekuserStudi(Request $request) {
		$arrayacekperuserstudi 	= [];
		$idpegawai    	= $request->input('val01');
		$cdatane		= Bantuanstudi::where('idpegawai', $idpegawai)->count();
		$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
		$namapegawai	= $getpegawai->nama;
		$nip			= $getpegawai->nip;
		$ppabp			= $getpegawai->fakultas;
		$spp 			= 0;
		$hidup 			= 0;
		$buku 			= 0;
		$penelitian 	= 0;
		$akhir 			= 0;
		$jumlah			= 0;
		$total			= 0;
		if ($cdatane != 0){
			$jdatane	= Bantuanstudi::where('idpegawai', $idpegawai)->get();
			foreach ($jdatane as $rdatane) {
				$jenis 		= $rdatane->jenis;
				$nominal 	= $rdatane->nominal;
				$jumlah++;
				if ($jenis == 'SPP'){ $spp = $spp + $nominal; }
				else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nominal; }
				else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nominal; }
				else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nominal; }
				else { $penelitian = $penelitian + $nominal; }
				$total = $total + $nominal;
			}
		}
		$arrayacekperuserstudi[] = array(
			'idpegawai' 	=> $idpegawai,
			'namapegawai'	=> $namapegawai, 
			'nip'			=> $nip, 
			'ppabp'			=> $ppabp, 
			'spp'			=> $spp, 
			'hidup'			=> $hidup, 
			'buku'			=> $buku, 
			'penelitian'	=> $penelitian, 
			'akhir'			=> $akhir,
			'jumlah'		=> $jumlah, 
			'total'			=> $total, 
		);
    	echo json_encode($arrayacekperuserstudi);	
    }
	public function jcekuserPublikasi(Request $request) {
		$arrayacekperuserpub 	= [];
		$idpegawai    			= $request->input('val01');
		$cdatane				= Bantuanpublikasi::where('idpegawai', $idpegawai)->count();
		$getpegawai				= Simpegpegawai::where('id', $idpegawai)->first();
		if (isset($getpegawai->id)){
			$namapegawai		= $getpegawai->nama_lengkap;
			$jenispeg			= $getpegawai->jenispeg;
			$nip				= $getpegawai->nip_baru;
			$ppabp				= $getpegawai->ppabp;
		} else {
			$namapegawai		= '';
			$jenispeg			= '';
			$nip				= '';
			$ppabp				= '';
		}
		$semnas 				= 0;
		$semin 					= 0;
		$publikasi 				= 0;
		$jumlah					= 0;
		$total					= 0;
		if ($cdatane != 0){
			$jdatane	= Bantuanpublikasi::where('idpegawai', $idpegawai)->get();
			foreach ($jdatane as $rdatane) {
				$jenis 		= $rdatane->jenis;
				$nominal 	= $rdatane->nominal;
				$jumlah++;
				if ($jenis == 'NASIONAL TER-AKREDITASI'){ $semnas = $semnas + $nominal; }
				else if ($jenis == 'NASIONAL TIDAK TER-AKREDITASI'){ $semnas = $semnas + $nominal; }
				else if ($jenis == 'INTER-NASIONAL'){ $semin = $semin + $nominal; }
				else { $publikasi = $publikasi + $nominal; }
				$total = $total + $nominal;
			}
		}
		$arrayacekperuserpub[] = array(
			'idpegawai' 	=> $idpegawai,
			'namapegawai'	=> $namapegawai, 
			'nip'			=> $nip, 
			'ppabp'			=> $ppabp, 
			'semnas'		=> $semnas, 
			'semin'			=> $semin, 
			'publikasi'		=> $publikasi, 
			'jumlah'		=> $jumlah, 
			'total'			=> $total, 
		);
    	echo json_encode($arrayacekperuserpub);	
    }
	public function exsktarif(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'sk_keterangan'    	=>  'required', 
            'sk_nomor'  		=>  'required',
			'sk_tahun'  		=>  'required',
        ]);

        if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $keterangan    	= $request->input('sk_keterangan');
            $nomor  		= $request->input('sk_nomor');
			$tahun  		= $request->input('sk_tahun');
			$idne  			= $request->input('sk_idne');
			if ($idne == 'new'){
				$cekdatask		= Sktarif::where('nomor', $nomor)->where('tahun', $tahun)->count();
				if ($cekdatask != 0){
					Session::flash('status', 'Error');
					Session::flash('message', 'File SK Tarif Nomor '.$nomor.' Tahun '.$tahun.' Sudah Ada'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				}else {
					if ($request->hasFile('sk_scanfile')) {
						$validator = Validator::make($request->all(), [
							'file' =>  'mimes:pdf,PDF|max:20000'
						]);
						if ($validator->fails()) {
							Session::flash('status', 'Error');
							Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						} else {
							$newnomor		= preg_replace('/\s/', '', $nomor);
							$newnomor		= str_replace('/', '', $newnomor);
							$namafile		= 'SK_Tarif_Nomor_'.$newnomor.'_Tahun_'.$tahun;
							$namafile		= $namafile.'.'.$request->file('sk_scanfile')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('sk_scanfile');
							$uploadedFile->move(public_path('scan/sktarif'), $namafile);
							Sktarif::create([
								'deskripsi'	=> $keterangan, 
								'nomor'		=> $nomor, 
								'tahun'		=> $tahun, 
								'namafile'	=> $namafile,
								'fakultas'	=> Session('fakultas')
							]);
							Session::flash('status', 'Success');
							Session::flash('message', 'SK Tarif Tersimpan'); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					} else {
						Session::flash('status', 'Error');
						Session::flash('message', 'File SK Tarif Wajib Ada'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				}
			}else {
				$cekdatask		= Sktarif::where('nomor', $nomor)->where('tahun', $tahun)->where('id', '!=', $idne)->count();
				if ($cekdatask != 0){
					Session::flash('status', 'Error');
					Session::flash('message', 'File SK Tarif Nomor '.$nomor.' Tahun '.$tahun.' Sudah Ada'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				}else {
					if ($request->hasFile('sk_scanfile')) {
						$validator = Validator::make($request->all(), [
							'file' =>  'mimes:pdf,PDF|max:20000'
						]);
						if ($validator->fails()) {
							Session::flash('status', 'Error');
							Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						} else {
							$qdislws		= Sktarif::where('id', $idne)->first();
							$namafile 		= $qdislws->namafile;
							if ($namafile != ''){
								if (File::exists(base_path()) ."/public/scan/sktarif/". $namafile) {
								  File::delete(base_path() ."/public/scan/sktarif/". $namafile);
								}
							}
							$namafile		= $namafile.'.'.$request->file('sk_scanfile')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('sk_scanfile');
							$uploadedFile->move(public_path('scan/sktarif'), $namafile);
							
							Sktarif::where('id', $idne)->update([
								'deskripsi'	=> $keterangan, 
								'nomor'		=> $nomor, 
								'tahun'		=> $tahun, 
								'namafile'	=> $namafile,
							]);
							Session::flash('status', 'Success');
							Session::flash('message', 'SK Tarif Terupdate'); 
							Session::flash('alert-class', 'alert-info');
							return back();
						}
					} else {
						Session::flash('status', 'Error');
						Session::flash('message', 'File SK Tarif Wajib Ada'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				}
			}
        }
    }
	public function exbantuanstudi(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'studi_nama'    	=>  'required', 
            'studi_jenjang'  	=>  'required',
			'studi_tempat'  	=>  'required',
			'studi_pees'  		=>  'required',
			'studi_status'  	=>  'required',
			'studi_mulai'  		=>  'required',
			'studi_tahun'  		=>  'required',
        ]);
		if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $idpegawai    	= $request->input('studi_nama');
            $jenjang  		= $request->input('studi_jenjang');
			$universitas	= $request->input('studi_tempat');
			$fakstudi		= $request->input('studi_fakultas');
			$pees  			= $request->input('studi_pees');
			$status			= $request->input('studi_status');
			$jenis  		= $request->input('studi_jenis');
			$semester  		= $request->input('studi_mulai');
			$tahun 			= $request->input('studi_tahun');
			$idne 			= $request->input('studi_idne');
			$sktarif 		= $request->input('studi_sktarif');
			$spp  			= $request->input('studi_jenisspp');
			$hidup  		= $request->input('studi_jenishidup');
			$skripsi  		= $request->input('studi_jenisskripsi');
			$penelitian		= $request->input('studi_jenispenelitian');
			$buku			= $request->input('studi_jenisbuku');
			$kursus			= $request->input('studi_jeniskursus');
			$budal			= $request->input('studi_jenisberangkat');
			$mulih			= $request->input('studi_jenispulang');
			$noagenda		= $request->input('studi_agenda');
			$thnagenda		= $request->input('studi_thnagenda');
			$karantina		= $request->input('studi_jeniskarantina');
			$tambahanbiaya	= $request->input('studi_tambahanbiaya');
			$negara			= $request->input('add_negara');
			$fakultas		= $request->input('surat_fakultas');
			$jenispeg		= $request->input('surat_jenis');
			if ($tambahanbiaya != ''){
				$tambahanbiaya 	= str_replace(',','',$tambahanbiaya);
			}
			if ($karantina != ''){
				$karantina 	= str_replace(',','',$karantina);
			}
			if ($spp != ''){
				$spp 		= str_replace(',','',$spp);
			}
			if ($hidup != ''){
				$hidup 		= str_replace(',','',$hidup);
			}
			if ($skripsi != ''){
				$skripsi 	= str_replace(',','',$skripsi);
			}
			if ($penelitian != ''){
				$penelitian = str_replace(',','',$penelitian);
			}
			if ($buku != ''){
				$buku = str_replace(',','',$buku);
			}
			if ($kursus != ''){
				$kursus = str_replace(',','',$kursus);
			}
			if ($budal != ''){
				$budal = str_replace(',','',$budal);
			}
			if ($mulih != ''){
				$mulih = str_replace(',','',$mulih);
			}
			$total 			= $spp + $hidup + $skripsi + $penelitian + $buku + $kursus + $budal + $mulih + $karantina + $tambahanbiaya;
			if ($total == 0){
				Session::flash('status', 'Error');
				Session::flash('message', 'Mohon Bantuan Dana Yang di Ajukan di isi minimal salah satu'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			} else {
				$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
				$namapegawai	= $getpegawai->nama;
				$ppabp			= $getpegawai->fakultas;
				Bantuanpenerima::where('id', $idpegawai)->update([
					'prodi'		=> $pees,
					'fakultas'	=> $fakultas,
					'fakstudi'	=> $fakstudi,
					'namapt'	=> $universitas,
					'negara'	=> $negara,
					'jenjang'	=> $jenjang,
					'jenispeg'	=> $jenispeg,
					'jenis'		=> $status
				]);
				if ($ppabp == ''){ $ppabp = Session('fakultas'); }
				if ($idne == 'new'){
					if ($tambahanbiaya != 0){
						$cekdatatambahanbiaya		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Tambahan Biaya Hidup')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatatambahanbiaya = 0; }
					if ($spp != 0){
						$cekdataspp		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'SPP')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdataspp = 0; }
					if ($hidup != 0){
						$cekdatahidup		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Biaya Hidup')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatahidup = 0; }
					if ($skripsi != 0){
						$cekdataskripsi		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Ujian Akhir')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdataskripsi = 0; }
					if ($penelitian != 0){
						$cekdatapenelitian		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Penelitian')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatapenelitian = 0; }
					if ($buku != 0){
						$cekdatabuku		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Biaya Buku')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatabuku = 0; }
					if ($kursus != 0){
						$cekdatakursus		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Tes Kursus')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatakursus = 0; }
					if ($budal != 0){
						$cekdatabudal		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Tiket Keberangkatan')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatabudal = 0; }
					if ($mulih != 0){
						$cekdatamulih		= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Tiket Pulang')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatamulih = 0; }
					if ($karantina != 0){
						$cekdatakarantina	= Bantuanstudi::where('idpegawai', $idpegawai)->where('jenis', 'Karantina')->where('semester', $semester)->where('tahun', $tahun)->count();
					} else { $cekdatakarantina = 0; }
					if ($cekdataspp != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan SPP Semester '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatatambahanbiaya != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Tambahan Biaya Hidup '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatakarantina != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Biaya Karantina '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatamulih != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Biaya Tiket Kepulangan '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatabudal != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Biaya Tiket Keberangkatan '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatahidup != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Biaya Hidup Semester '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdataskripsi != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Ujian Akhir Semester '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatapenelitian != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Penelitian Semester '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatakursus != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Biaya Tes Kursus Semester '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else if ($cekdatabuku != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan Biaya Buku Semester '.$semester.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai an.'.$namapegawai); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					} else {
						if ($request->hasFile('id_scankhs')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:pdf,PDF|max:20000'
							]);
							if ($validator->fails()) {
								Session::flash('status', 'Error');
								Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							} else {
								$namafilekhs 	= $ppabp.'-BANTUANSTUDI-KHS'.$tahun.$semester.$idpegawai;
								$namafilekhs	= md5($namafilekhs);
								$namafilekhs	= $namafilekhs.'.'.$request->file('id_scankhs')->getClientOriginalExtension();
								$uploadedFile 	= $request->file('id_scankhs');
								$uploadedFile->move(public_path('scan/bantuan'), $namafilekhs);
								if ($spp != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'SPP', 
										'bantuan'		=> $status, 
										'nominal'		=> $spp, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($karantina != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Karantina', 
										'bantuan'		=> $status, 
										'nominal'		=> $karantina, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($tambahanbiaya != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tambahan Biaya Hidup', 
										'bantuan'		=> $status, 
										'nominal'		=> $tambahanbiaya, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($buku != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Biaya Buku', 
										'bantuan'		=> $status, 
										'nominal'		=> $buku, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda, 
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($hidup != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Biaya Hidup', 
										'bantuan'		=> $status, 
										'nominal'		=> $hidup, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda, 
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($skripsi != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Ujian Akhir', 
										'bantuan'		=> $status, 
										'nominal'		=> $skripsi, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas') 
									]);
								}
								if ($penelitian != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Penelitian', 
										'bantuan'		=> $status, 
										'nominal'		=> $penelitian, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda, 
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($kursus != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tes Kursus', 
										'bantuan'		=> $status, 
										'nominal'		=> $kursus, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda, 
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($budal != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tiket Keberangkatan', 
										'bantuan'		=> $status, 
										'nominal'		=> $budal, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs, 
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda, 
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($mulih != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tiket Pulang', 
										'bantuan'		=> $status, 
										'nominal'		=> $mulih, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs, 
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda, 
										'inputor'		=> Session('fakultas')
									]);
								}
								$total = number_format( $total , 0 , '.' , ',' );
								Session::flash('status', 'Success');
								Session::flash('message', 'Data Bantuan Studi Telah Tersimpan Sejumlah Rp. '.$total.' an. '.$namapegawai); 
								Session::flash('alert-class', 'alert-success');
								return back();
							
							}
						} else {
							$namafilekhs = $idpegawai.'-'.time();
							if ($spp != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'SPP', 
									'bantuan'		=> $status, 
									'nominal'		=> $spp, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($tambahanbiaya != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tambahan Biaya Hidup', 
									'bantuan'		=> $status, 
									'nominal'		=> $tambahanbiaya, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($karantina != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Karantina', 
									'bantuan'		=> $status, 
									'nominal'		=> $karantina, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($buku != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Biaya Buku', 
									'bantuan'		=> $status, 
									'nominal'		=> $buku, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($hidup != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Biaya Hidup', 
									'bantuan'		=> $status, 
									'nominal'		=> $hidup, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($skripsi != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Ujian Akhir', 
									'bantuan'		=> $status, 
									'nominal'		=> $skripsi, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($penelitian != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Penelitian', 
									'bantuan'		=> $status, 
									'nominal'		=> $penelitian, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($kursus != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tes Kursus', 
									'bantuan'		=> $status, 
									'nominal'		=> $kursus, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($budal != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tiket Keberangkatan', 
									'bantuan'		=> $status, 
									'nominal'		=> $budal, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($mulih != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tiket Pulang', 
									'bantuan'		=> $status, 
									'nominal'		=> $mulih, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							$total = number_format( $total , 0 , '.' , ',' );
							Session::flash('status', 'Success');
							Session::flash('message', 'Data Bantuan Studi Telah Tersimpan Sejumlah Rp. '.$total.' an. '.$namapegawai); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					}
				} else {
					$getmarking		= Bantuanstudi::where('id', $idne)->first();
					if(isset($getmarking->scankhs)){
						$scankhs		= $getmarking->scankhs;
						if ($request->hasFile('id_scankhs')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:pdf,PDF|max:20000'
							]);
							if ($validator->fails()) {
								Session::flash('status', 'Error');
								Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							} else {
								if (File::exists(base_path()) ."/public/scan/bantuan/". $scankhs) {
									File::delete(base_path() ."/public/scan/bantuan/". $scankhs);
								}
								$namafilekhs 	= $ppabp.'-BANTUANSTUDI-KHS'.$tahun.$semester.$idpegawai;
								$namafilekhs	= md5($namafilekhs);
								$namafilekhs	= $namafilekhs.'.'.$request->file('id_scankhs')->getClientOriginalExtension();
								$uploadedFile 	= $request->file('id_scankhs');
								$uploadedFile->move(public_path('scan/bantuan'), $namafilekhs);
								$getalljenis	= Bantuanstudi::where('scankhs', $scankhs)->delete();
								if ($spp != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'SPP', 
										'bantuan'		=> $status, 
										'nominal'		=> $spp, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($karantina != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Karantina', 
										'bantuan'		=> $status, 
										'nominal'		=> $karantina, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($tambahanbiaya != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tambahan Biaya Hidup', 
										'bantuan'		=> $status, 
										'nominal'		=> $tambahanbiaya, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($buku != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Biaya Buku', 
										'bantuan'		=> $status, 
										'nominal'		=> $buku, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($hidup != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Biaya Hidup', 
										'bantuan'		=> $status, 
										'nominal'		=> $hidup, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($skripsi != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Ujian Akhir', 
										'bantuan'		=> $status, 
										'nominal'		=> $skripsi, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($penelitian != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Penelitian', 
										'bantuan'		=> $status, 
										'nominal'		=> $penelitian, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($kursus != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tes Kursus', 
										'bantuan'		=> $status, 
										'nominal'		=> $kursus, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs,
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($budal != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tiket Keberangkatan', 
										'bantuan'		=> $status, 
										'nominal'		=> $budal, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs, 
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								if ($mulih != 0){
									Bantuanstudi::create([
										'idpegawai'		=> $idpegawai, 
										'ppabp'			=> $fakultas, 
										'universitas'	=> $universitas, 
										'fakultas'		=> $fakstudi, 
										'prodi'			=> $pees, 
										'jenjang'		=> $jenjang, 
										'jenis'			=> 'Tiket Pulang', 
										'bantuan'		=> $status, 
										'nominal'		=> $mulih, 
										'semester'		=> $semester, 
										'tahun'			=> $tahun,
										'scankhs'		=> $namafilekhs, 
										'scanloa'		=> '', 
										'sktarif'		=> $sktarif, 
										'scantandaterima'=> '',
										'tanggalterima'	=> '',
										'noagenda'		=> $noagenda,
										'thnagenda'		=> $thnagenda,
										'inputor'		=> Session('fakultas')
									]);
								}
								$total = number_format( $total , 0 , '.' , ',' );
								Session::flash('status', 'Success');
								Session::flash('message', 'Data Bantuan Studi Telah Terupdate Sejumlah Rp. '.$total.' an. '.$namapegawai); 
								Session::flash('alert-class', 'alert-success');
								return back();
							}
						} else {
							$getalljenis	= Bantuanstudi::where('scankhs', $scankhs)->delete();
							if ($spp != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'SPP', 
									'bantuan'		=> $status, 
									'nominal'		=> $spp, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda, 
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($tambahanbiaya != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tambahan Biaya Hidup', 
									'bantuan'		=> $status, 
									'nominal'		=> $tambahanbiaya, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($karantina != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Karantina', 
									'bantuan'		=> $status, 
									'nominal'		=> $karantina, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $namafilekhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($buku != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Biaya Buku', 
									'bantuan'		=> $status, 
									'nominal'		=> $buku, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($hidup != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Biaya Hidup', 
									'bantuan'		=> $status, 
									'nominal'		=> $hidup, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($skripsi != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Ujian Akhir', 
									'bantuan'		=> $status, 
									'nominal'		=> $skripsi, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($penelitian != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Penelitian', 
									'bantuan'		=> $status, 
									'nominal'		=> $penelitian, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($kursus != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tes Kursus', 
									'bantuan'		=> $status, 
									'nominal'		=> $kursus, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs,
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($budal != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tiket Keberangkatan', 
									'bantuan'		=> $status, 
									'nominal'		=> $budal, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							if ($mulih != 0){
								Bantuanstudi::create([
									'idpegawai'		=> $idpegawai, 
									'ppabp'			=> $fakultas, 
									'universitas'	=> $universitas, 
									'fakultas'		=> $fakstudi, 
									'prodi'			=> $pees, 
									'jenjang'		=> $jenjang, 
									'jenis'			=> 'Tiket Pulang', 
									'bantuan'		=> $status, 
									'nominal'		=> $mulih, 
									'semester'		=> $semester, 
									'tahun'			=> $tahun,
									'scankhs'		=> $scankhs, 
									'scanloa'		=> '', 
									'sktarif'		=> $sktarif, 
									'scantandaterima'=> '',
									'tanggalterima'	=> '',
									'noagenda'		=> $noagenda,
									'thnagenda'		=> $thnagenda,
									'inputor'		=> Session('fakultas')
								]);
							}
							$total = number_format( $total , 0 , '.' , ',' );
							Session::flash('status', 'Success');
							Session::flash('message', 'Data Bantuan Studi Telah Terupdate Sejumlah Rp. '.$total.' an. '.$namapegawai); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					} else {
						Session::flash('status', 'Gagal');
						Session::flash('message', 'ID Tidak Valid'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				}
			}
        }
    }
	public function exuploadbukti(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'upload_tanggal'   =>  'required', 
        ]);

        if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $tanggal   	= $request->input('upload_tanggal');
			$idne    	= $request->input('upload_idne');
			$tabel    	= $request->input('upload_tabel');
			if ($request->hasFile('upload_scanid')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:pdf,PDF,JPG,jpg,JPEG,jpeg,png,PNG|max:20000'
				]);
				if ($validator->fails()) {
					Session::flash('status', 'Error');
					Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				} else {
					$namafilekwt 	= $tabel.'-BUKTI'.$idne.$tanggal;
					$namafilekwt	= md5($namafilekwt);
					$namafilekwt	= $namafilekwt.'.'.$request->file('upload_scanid')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('upload_scanid');
					$uploadedFile->move(public_path('scan/kwitansi'), $namafilekwt);
					if ($tabel == 'bantuanpublikasi'){
						Bantuanpublikasi::where('id', $idne)->update([
							'scantandaterima'	=> $namafilekwt,
							'tanggalterima'		=> $tanggal
						]);
						Session::flash('status', 'Success');
						Session::flash('message', 'Upload Kwitansi Bantuan Publikasi Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					} else if ($tabel == 'riset'){
						Bantuanriset::where('id', $idne)->update([
							'scantandaterima'	=> $namafilekwt,
							'tanggalterima'		=> $tanggal
						]);
						Session::flash('status', 'Success');
						Session::flash('message', 'Upload Kwitansi Bantuan Riset dan PKM Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					} else if ($tabel == 'dispokhususbantuan'){
						$getdata 	= Bantuanstudi::where('id', $idne)->first();
						$scankhs	= $getdata->scankhs;
						Bantuanstudi::where('scankhs', $scankhs)->update([
							'scandisposisi'	=> $namafilekwt
						]);
						Session::flash('status', 'Success');
						Session::flash('message', 'Upload Disposisi Khusus Bantuan Studi Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					} else if ($tabel == 'dispokhususpublikasi'){
						Bantuanstudi::where('id', $idne)->update([
							'scandisposisi'	=> $namafilekwt
						]);
						Session::flash('status', 'Success');
						Session::flash('message', 'Upload Disposisi Khusus Bantuan Publikasi Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					} else {
						$getdata 	= Bantuanstudi::where('id', $idne)->first();
						$scankhs	= $getdata->scankhs;
						Bantuanstudi::where('scankhs', $scankhs)->update([
							'scantandaterima'	=> $namafilekwt,
							'tanggalterima'		=> $tanggal
						]);
						
						Session::flash('status', 'Success');
						Session::flash('message', 'Upload Kwitansi Bantuan Studi Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					}
				}
			} else {
				if ($tabel == 'bantuanpublikasi'){
					Bantuanpublikasi::where('id', $idne)->update([
						'tanggalterima'		=> $tanggal
					]);
					Session::flash('status', 'Success');
					Session::flash('message', 'Tanggal Kwitansi Bantuan Publikasi Telah Tersimpan'); 
					Session::flash('alert-class', 'alert-success');
					return back();
				} else {
					Bantuanstudi::where('id', $idne)->update([
						'tanggalterima'		=> $tanggal
					]);
					Session::flash('status', 'Success');
					Session::flash('message', 'Tanggal Kwitansi Bantuan Studi Telah Tersimpan'); 
					Session::flash('alert-class', 'alert-success');
					return back();
				}
			}
        }
    }
	public function exbantuanpublikasi(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'publikasi_nama'    	=>  'required', 
            'publikasi_jenis'  		=>  'required',
			'publikasi_nominal'  	=>  'required',
			'publikasi_tahun'  		=>  'required',
			'publikasi_kategori'  	=>  'required',
			'publikasi_judul'  		=>  'required',
        ]);

        if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $idpegawai    	= $request->input('publikasi_nama');
            $jenis  		= $request->input('publikasi_jenis');
			$nominal		= $request->input('publikasi_nominal');
			$kategori		= $request->input('publikasi_kategori');
			$judul			= $request->input('publikasi_judul');
			$namajurnal		= $request->input('publikasi_mjurnal');
			$issn			= $request->input('publikasi_issn');
			$lamanurl		= $request->input('publikasi_urljurnal');
			$voljurnal		= $request->input('publikasi_volume');
			$halaman		= $request->input('publikasi_halaman');
			$tahun			= $request->input('publikasi_tahun');
			$biaya 			= $request->input('publikasi_biaya');
			$rekomendasi 	= $request->input('publikasi_rekomendasi');
			$pajak 			= $request->input('publikasi_pajak');
			$idne 			= $request->input('publikasi_idne');
			$rekomendasi 	= str_replace(',','',$rekomendasi);
			$biaya 			= str_replace(',','',$biaya);
			$pajak 			= str_replace(',','',$pajak);
			$nominal 		= str_replace(',','',$nominal);
			$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
			$namapegawai	= $getpegawai->nama_lengkap;
			$nip			= $getpegawai->nip_baru;
			$golongan		= $getpegawai->golongan;
			$email			= $getpegawai->email_ub;
			$ppabp			= $getpegawai->ppabp;
			$status			= $getpegawai->status_jabatan;
			$ceksudah		= Bantuanpenerima::where('nip', $nip)->count();
			if ($ceksudah == 0){
				$cekpanjang		= User::where('fakultas', $ppabp)->where('fakpanjang', '!=', '')->count();
				if($cekpanjang != 0){
					$getpanjang = User::where('fakultas', $ppabp)->where('fakpanjang', '!=', '')->first();
					$fakpanjang = $getpanjang->fakpanjang;
				} else { $fakpanjang = $ppabp; }
				if ($fakpanjang == ''){ $fakpanjang = $ppabp; }
				if ($status != 'Dosen'){ $status = 'Tendik'; }
				Bantuanpenerima::create([
					'nama' 				=> $namapegawai,
					'nip'				=> $nip,
					'fakultas'			=> $fakpanjang,
					'email'				=> $email,
					'hape'				=> $getpegawai->no_hp,
					'golongan'			=> $golongan,
					'jenispeg'			=> $status,
					'inputor'			=> Session('fakultas')
				]);
			}
			if ($ppabp == ''){ $ppabp = Session('fakultas'); }
			$rkatebkd		= KategoriPAK::where('kode', $kategori)->first();
			if (isset($rkatebkd->id)){
				$penjabaran 	= $rkatebkd->penjabaran;
				$subpenjabaran 	= $rkatebkd->subpenjabaran;
				$id1			= $rkatebkd->id;
				$id2			= $rkatebkd->penjabaran;
				$id3			= $rkatebkd->subpenjabaran;
				$id4			= $rkatebkd->subsubpenjabaran;
				$id5			= $rkatebkd->subsubsubpenjabaran;
				$id6			= $rkatebkd->buktidukung;
				$id7			= $rkatebkd->maksimal;
				$id8			= $rkatebkd->satuan;
				$angka			= $rkatebkd->pak;
			} else {
				$penjabaran 	= '';
				$subpenjabaran 	= '';
				$id1			= 0;
				$id2			= $penjabaran;
				$id3			= $subpenjabaran;
				$id4			= '';
				$id5			= '';
				$id6			= '';
				$id7			= '';
				$id8			= '';
				$angka			= 0;
			}
			$ceksek = Penelitian::where('kodedosen', $idpegawai)->where('judul', 'LIKE', $judul)->count();
			if ($ceksek == 0){
				$idsimba = Penelitian::insertGetId([
					'kodedosen'			=> $idpegawai,
					'kepakaran'			=> $request->input('publikasi_bidangilmu'),
					'judul'				=> $judul,
					'jenis'				=> $jenis,
					'kodebidang'		=> '',
					'kodetujuan'		=> '',
					'sumberdana'		=> 'Perguruan Tinggi atau mandiri',
					'institusipendana'	=> 'Pemerintah',
					'jumlahdana'		=> $nominal,
					'inputor'			=> Session('nama'),
					'kodejenis'			=> $kategori,
					'hasilluaran'		=> 'Tanpa Luaran',
					'deskripsi'			=> $request->input('publikasi_sjr').', '.$request->input('publikasi_indeks').', '.$request->input('publikasi_status'),
					'penerbit'			=> '',
					'isbn'				=> '',
					'issn'				=> $issn,
					'halaman'			=> $halaman,
					'volume'			=> $voljurnal,
					'nmjurnal'			=> $namajurnal,
					'urljurnal'			=> $lamanurl,
					'tahun'				=> $tahun,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
					'verifikator'		=> '',
					'status'			=> 'Aktif',
					'fakultas'			=> $ppabp,
				]);
			} else {
				$getidsimba = Penelitian::where('kodedosen', $idpegawai)->where('judul', 'LIKE', $judul)->first();
				$idsimba	= $getidsimba->id;
				Penelitian::where('id', $idsimba)->update([
					'kodedosen'			=> $idpegawai,
					'kepakaran'			=> $request->input('publikasi_bidangilmu'),
					'judul'				=> $judul,
					'jenis'				=> $jenis,
					'jumlahdana'		=> $nominal,
					'inputor'			=> Session('nama'),
					'kodejenis'			=> $kategori,
					'deskripsi'			=> $request->input('publikasi_sjr').', '.$request->input('publikasi_indeks').', '.$request->input('publikasi_status'),
					'issn'				=> $issn,
					'halaman'			=> $halaman,
					'volume'			=> $voljurnal,
					'nmjurnal'			=> $namajurnal,
					'urljurnal'			=> $lamanurl,
					'tahun'				=> $tahun,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
					'fakultas'			=> $ppabp,
				]);
			}
			Aktifitas::create([
				'unique_id'		=> $idpegawai,
				'kelompok'		=> Session('previlage'), 
				'keterangan'	=> 'Tambah Data '.$jenis, 
				'verifikator'	=> ''
			]);
			
			if ($idne == 'new'){
				$cekdata		= Bantuanpublikasi::where('idpegawai', $idpegawai)->where('judul', $judul)->count();
				if ($cekdata != 0){
					Session::flash('status', 'Error');
					Session::flash('message', 'Bantuan Publikasi Berjudul '.$judul.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai Ybs.'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				}else {
					if ($request->hasFile('publikasi_file')) {
						$validator = Validator::make($request->all(), [
							'file' =>  'mimes:pdf,PDF|max:20000'
						]);
						if ($validator->fails()) {
							Session::flash('status', 'Error');
							Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						} else {
							$namafile 		= $ppabp.'-PUBLIKASI-'.$idpegawai.'-'.$judul;
							$namafile		= md5($namafile);
							$namafile		= $namafile.'.'.$request->file('publikasi_file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('publikasi_file');
							$uploadedFile->move(public_path('scan/publikasi'), $namafile);
							Filess::create([
								'url'			=> $idsimba,
								'title'			=> 'penelitian',
								'description'	=> 'Bukti Dukung '.$penjabaran,
								'name'			=> $namafile,
							]);
							Bantuanpublikasi::create([
								'idpegawai'			=> $idpegawai, 
								'ppabp'				=> $ppabp, 
								'namajurnal'		=> $namajurnal, 
								'jenis'				=> $jenis, 
								'kategori'			=> $kategori, 
								'judul'				=> $judul, 
								'issn'				=> $issn, 
								'laman'				=> $lamanurl, 
								'voljurnal'			=> $voljurnal, 
								'halaman'			=> $halaman, 
								'jurusan'			=> $request->input('publikasi_jurusan'), 
								'prodi'				=> $request->input('publikasi_prodi'), 
								'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
								'sjr'				=> $request->input('publikasi_sjr'), 
								'indeks'			=> $request->input('publikasi_indeks'), 
								'status'			=> $request->input('publikasi_status'), 
								'nominal'			=> $nominal, 
								'biaya'				=> $biaya, 
								'rekomendasi'		=> $rekomendasi, 
								'pajak'				=> $pajak, 
								'diterima'			=> $nominal, 
								'tahun'				=> $tahun, 
								'scanloa'			=> $namafile, 
								'sktarif'			=> '', 
								'scantandaterima'	=> '', 
								'tanggalterima'		=> '',
								'inputor'			=> Session('fakultas')
							]);
							Session::flash('status', 'Success');
							Session::flash('message', 'Data Bantuan Publikasi Telah Tersimpan'); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					} else {
						Bantuanpublikasi::create([
							'idpegawai'			=> $idpegawai, 
							'ppabp'				=> $ppabp, 
							'namajurnal'		=> $namajurnal, 
							'jenis'				=> $jenis, 
							'kategori'			=> $kategori, 
							'judul'				=> $judul, 
							'issn'				=> $issn, 
							'laman'				=> $lamanurl, 
							'voljurnal'			=> $voljurnal, 
							'halaman'			=> $halaman, 
							'jurusan'			=> $request->input('publikasi_jurusan'), 
							'prodi'				=> $request->input('publikasi_prodi'), 
							'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
							'sjr'				=> $request->input('publikasi_sjr'), 
							'indeks'			=> $request->input('publikasi_indeks'), 
							'status'			=> $request->input('publikasi_status'), 
							'nominal'			=> $nominal, 
							'biaya'				=> $biaya, 
							'rekomendasi'		=> $rekomendasi, 
							'pajak'				=> $pajak, 
							'diterima'			=> $nominal, 
							'tahun'				=> $tahun, 
							'scanloa'			=> '', 
							'sktarif'			=> '', 
							'scantandaterima'	=> '', 
							'tanggalterima'		=> '',
							'inputor'			=> Session('fakultas')
						]);
						Session::flash('status', 'Success');
						Session::flash('message', 'Data Bantuan Publikasi Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					}
				}
			}else {
				$cekstatus 			= Bantuanpublikasi::where('id', $idne)->first();
				if (isset($cekstatus->tanggalterima)){
					$tanggalterima	= $cekstatus->tanggalterima;
				} else {
					$tanggalterima 	= '0000-00-00';
				}
				if ($tanggalterima != '0000-00-00'){
					Session::flash('status', 'Error');
					Session::flash('message', 'Bantuan '.$jenis.' Tahun '.$tahun.' Sudah di Verifikasi, Sehingga, Hanya Admin Yang Bisa Mengubah Data'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				} else {
					$cekdata		= Bantuanpublikasi::where('idpegawai', $idpegawai)->where('judul', $judul)->where('id', '!=', $idne)->count();
					if ($cekdata != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan '.$jenis.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai Ybs.'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}else {
						
						if ($request->hasFile('publikasi_file')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:pdf,PDF|max:20000'
							]);
							if ($validator->fails()) {
								Session::flash('status', 'Error');
								Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							} else {
								$qdislws		= Bantuanpublikasi::where('id', $idne)->first();
								$namafile 		= $qdislws->scanloa;
								if ($namafile != ''){
									if (File::exists(base_path()) ."/public/scan/publikasi/". $namafile) {
									  File::delete(base_path() ."/public/scan/publikasi/". $namafile);
									}
								} else {
									$namafile 		= $ppabp.'-PUBLIKASI-'.$idpegawai.'-'.$judul;
									$namafile		= md5($namafile);
									$namafile		= $namafile.'.'.$request->file('publikasi_file')->getClientOriginalExtension();
								}
								$uploadedFile 	= $request->file('publikasi_file');
								$uploadedFile->move(public_path('scan/publikasi'), $namafile);
								Filess::create([
									'url'			=> $idsimba,
									'title'			=> 'penelitian',
									'description'	=> 'Bukti Dukung '.$penjabaran,
									'name'			=> $namafile,
								]);
								
								
								Bantuanpublikasi::where('id', $idne)->update([
									'idpegawai'			=> $idpegawai, 
									'ppabp'				=> $ppabp, 
									'namajurnal'		=> $namajurnal, 
									'jenis'				=> $jenis, 
									'kategori'			=> $kategori, 
									'judul'				=> $judul, 
									'issn'				=> $issn, 
									'laman'				=> $lamanurl, 
									'voljurnal'			=> $voljurnal, 
									'halaman'			=> $halaman, 
									'jurusan'			=> $request->input('publikasi_jurusan'), 
									'prodi'				=> $request->input('publikasi_prodi'), 
									'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
									'sjr'				=> $request->input('publikasi_sjr'), 
									'indeks'			=> $request->input('publikasi_indeks'), 
									'status'			=> $request->input('publikasi_status'), 
									'nominal'			=> $nominal, 
									'biaya'				=> $biaya, 
									'rekomendasi'		=> $rekomendasi, 
									'pajak'				=> $pajak, 
									'diterima'			=> $nominal, 
									'tahun'				=> $tahun, 
									'scanloa'			=> $namafile, 
								]);
								Session::flash('status', 'Success');
								Session::flash('message', 'Data Bantuan Publikasi Telah Terupdate'); 
								Session::flash('alert-class', 'alert-success');
								return back();
							}
						} else {
							Bantuanpublikasi::where('id', $idne)->update([
								'idpegawai'			=> $idpegawai, 
								'ppabp'				=> $ppabp, 
								'namajurnal'		=> $namajurnal, 
								'jenis'				=> $jenis, 
								'kategori'			=> $kategori, 
								'judul'				=> $judul, 
								'issn'				=> $issn, 
								'laman'				=> $lamanurl, 
								'voljurnal'			=> $voljurnal, 
								'halaman'			=> $halaman, 
								'jurusan'			=> $request->input('publikasi_jurusan'), 
								'prodi'				=> $request->input('publikasi_prodi'), 
								'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
								'sjr'				=> $request->input('publikasi_sjr'), 
								'indeks'			=> $request->input('publikasi_indeks'), 
								'status'			=> $request->input('publikasi_status'), 
								'nominal'			=> $nominal, 
								'biaya'				=> $biaya, 
								'rekomendasi'		=> $rekomendasi, 
								'pajak'				=> $pajak, 
								'diterima'			=> $nominal, 
								'nominal'			=> $nominal, 
								'tahun'				=> $tahun, 
							]);
							Session::flash('status', 'Success');
							Session::flash('message', 'Data Bantuan Publikasi Telah Terupdate'); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					}
				}
			}
        }
    }
	public function exBantuanriset(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'publikasi_nama'    =>  'required', 
            'id_jenis'  		=>  'required',
			'id_sumberdana'  	=>  'required',
			'id_instudana'  	=>  'required',
			'id_tahundana'  	=>  'required',
			'id_jumlah'  		=>  'required',
        ]);

        if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua (Nama, Kategori, Sumber dan Institusi Pendana, Nominal, Tahun)'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $idpegawai    	= $request->input('publikasi_nama');
            $prodi  		= $request->input('publikasi_prodi');
			$jurusan		= $request->input('publikasi_jurusan');
			$bidangilmu		= $request->input('publikasi_bidangilmu');
			$judul			= $request->input('publikasi_judul');
			$jenis			= $request->input('id_jenis');
			$bidang			= $request->input('id_bidang');
			$tujuan			= $request->input('id_tujuan');
			$sumberdana		= $request->input('id_sumberdana');
			$institusi		= $request->input('id_instudana');
			$tahun			= $request->input('id_tahundana');
			$nominal 		= $request->input('id_jumlah');
			$luaran 		= $request->input('id_hasilluaran');
			$idne 			= $request->input('publikasi_idne');
			$nominal 		= str_replace(',','',$nominal);
			$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
			$namapegawai	= $getpegawai->nama_lengkap;
			$nip			= $getpegawai->nip_baru;
			$golongan		= $getpegawai->golongan;
			$email			= $getpegawai->email_ub;
			$ppabp			= $getpegawai->ppabp;
			$status			= $getpegawai->status_jabatan;
			$ceksudah		= Bantuanpenerima::where('nip', $nip)->count();
			if ($ceksudah == 0){
				$cekpanjang		= User::where('fakultas', $ppabp)->where('fakpanjang', '!=', '')->count();
				if($cekpanjang != 0){
					$getpanjang = User::where('fakultas', $ppabp)->where('fakpanjang', '!=', '')->first();
					$fakpanjang = $getpanjang->fakpanjang;
				} else { $fakpanjang = $ppabp; }
				if ($fakpanjang == ''){ $fakpanjang = $ppabp; }
				if ($status != 'Dosen'){ $status = 'Tendik'; }
				Bantuanpenerima::create([
					'nama' 				=> $namapegawai,
					'nip'				=> $nip,
					'fakultas'			=> $fakpanjang,
					'email'				=> $email,
					'hape'				=> $getpegawai->no_hp,
					'golongan'			=> $golongan,
					'jenispeg'			=> $status,
					'inputor'			=> Session('fakultas')
				]);
			}
			if ($ppabp == ''){ $ppabp = Session('fakultas'); }
			$ceksek 	= Penelitian::where('kodedosen', $idpegawai)->where('judul', 'LIKE', $judul)->count();
			if ($ceksek == 0){
				$idsimba = Penelitian::insertGetId([
					'kodedosen'			=> $idpegawai,
					'kepakaran'			=> $request->input('publikasi_bidangilmu'),
					'judul'				=> $judul,
					'jenis'				=> $jenis,
					'kodebidang'		=> $request->input('id_bidang'),
					'kodetujuan'		=> $request->input('id_tujuan'),
					'sumberdana'		=> $request->input('id_sumberdana'),
					'institusipendana'	=> $request->input('id_instudana'),
					'jumlahdana'		=> $nominal,
					'inputor'			=> Session('nama'),
					'kodejenis'			=> '301124',
					'hasilluaran'		=> $request->input('id_hasilluaran'),
					'deskripsi'			=> '',
					'penerbit'			=> '',
					'isbn'				=> '',
					'issn'				=> '',
					'halaman'			=> '',
					'volume'			=> '',
					'nmjurnal'			=> '',
					'urljurnal'			=> '',
					'tahun'				=> $request->input('id_tahundana'),
					'satuan'			=> '',
					'kegiatan'			=> '',
					'angka'				=> '',
					'bukti'				=> '',
					'verifikator'		=> '',
					'status'			=> 'Aktif',
					'fakultas'			=> $ppabp,
				]);
			} else {
				$getidsimba = Penelitian::where('kodedosen', $idpegawai)->where('judul', 'LIKE', $judul)->first();
				$idsimba	= $getidsimba->id;
				Penelitian::where('id', $idsimba)->update([
					'kepakaran'			=> $request->input('publikasi_bidangilmu'),
					'kodebidang'		=> $request->input('id_bidang'),
					'kodetujuan'		=> $request->input('id_tujuan'),
					'sumberdana'		=> $request->input('id_sumberdana'),
					'institusipendana'	=> $request->input('id_instudana'),
					'tahun'				=> $request->input('id_tahundana'),
					'hasilluaran'		=> $request->input('id_hasilluaran'),
				]);
			}
			Aktifitas::create([
				'unique_id'		=> $idpegawai,
				'kelompok'		=> Session('previlage'), 
				'keterangan'	=> 'Tambah Data '.$jenis, 
				'verifikator'	=> ''
			]);
			
			if ($idne == 'new'){
				$cekdata		= Bantuanriset::where('idpegawai', $idpegawai)->where('judul', $judul)->count();
				if ($cekdata != 0){
					Session::flash('status', 'Error');
					Session::flash('message', 'Bantuan Publikasi Berjudul '.$judul.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai Ybs.'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				} else {
					if ($request->hasFile('publikasi_file')) {
						$validator = Validator::make($request->all(), [
							'file' =>  'mimes:pdf,PDF|max:20000'
						]);
						if ($validator->fails()) {
							Session::flash('status', 'Error');
							Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
							Session::flash('alert-class', 'alert-danger');
							return back();
						} else {
							$namafile 		= $ppabp.'-RISET-'.$idpegawai.'-'.$judul;
							$namafile		= md5($namafile);
							$namafile		= $namafile.'.'.$request->file('publikasi_file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('publikasi_file');
							$uploadedFile->move(public_path('scan/publikasi'), $namafile);
							Filess::create([
								'url'			=> $idsimba,
								'title'			=> 'penelitian',
								'description'	=> 'Bukti Dukung '.$penjabaran,
								'name'			=> $namafile,
							]);
							Bantuanriset::create([
								'idpegawai'			=> $idpegawai, 
								'ppabp'				=> $ppabp, 
								'namajurnal'		=> $request->input('id_tujuan'),
								'jenis'				=> $request->input('id_jenis'),
								'kategori'			=> $request->input('id_bidang'),
								'judul'				=> $request->input('publikasi_judul'),
								'issn'				=> '', 
								'laman'				=> '', 
								'voljurnal'			=> '', 
								'halaman'			=> '', 
								'jurusan'			=> $request->input('publikasi_jurusan'), 
								'prodi'				=> $request->input('publikasi_prodi'), 
								'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
								'sjr'				=> $request->input('id_sumberdana'), 
								'indeks'			=> $request->input('id_instudana'), 
								'status'			=> $request->input('id_hasilluaran'), 
								'nominal'			=> $nominal, 
								'biaya'				=> '', 
								'rekomendasi'		=> '', 
								'pajak'				=> '', 
								'diterima'			=> '', 
								'tahun'				=> $request->input('id_tahundana'),
								'scanloa'			=> $namafile, 
								'sktarif'			=> '', 
								'scantandaterima'	=> '', 
								'tanggalterima'		=> '',
								'inputor'			=> Session('fakultas')
							]);
							Session::flash('status', 'Success');
							Session::flash('message', 'Data Bantuan Riset Telah Tersimpan'); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					} else {
						Bantuanriset::create([
							'idpegawai'			=> $idpegawai, 
							'ppabp'				=> $ppabp, 
							'namajurnal'		=> $request->input('id_tujuan'),
							'jenis'				=> $request->input('id_jenis'),
							'kategori'			=> $request->input('id_bidang'),
							'judul'				=> $request->input('publikasi_judul'),
							'issn'				=> '', 
							'laman'				=> '', 
							'voljurnal'			=> '', 
							'halaman'			=> '', 
							'jurusan'			=> $request->input('publikasi_jurusan'), 
							'prodi'				=> $request->input('publikasi_prodi'), 
							'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
							'sjr'				=> $request->input('id_sumberdana'), 
							'indeks'			=> $request->input('id_instudana'), 
							'status'			=> $request->input('id_hasilluaran'), 
							'nominal'			=> $nominal, 
							'biaya'				=> '', 
							'rekomendasi'		=> '', 
							'pajak'				=> '', 
							'diterima'			=> '', 
							'tahun'				=> $request->input('id_tahundana'),
							'scanloa'			=> '', 
							'sktarif'			=> '', 
							'scantandaterima'	=> '', 
							'tanggalterima'		=> '',
							'inputor'			=> Session('fakultas')
						]);
						Session::flash('status', 'Success');
						Session::flash('message', 'Data Bantuan Riset Telah Tersimpan'); 
						Session::flash('alert-class', 'alert-success');
						return back();
					}
				}
			}else {
				$cekstatus 			= Bantuanriset::where('id', $idne)->first();
				if (isset($cekstatus->tanggalterima)){
					$tanggalterima	= $cekstatus->tanggalterima;
				} else {
					$tanggalterima 	= '0000-00-00';
				}
				if ($tanggalterima != '0000-00-00'){
					Session::flash('status', 'Error');
					Session::flash('message', 'Bantuan '.$jenis.' Tahun '.$tahun.' Sudah di Verifikasi, Sehingga, Hanya Admin Yang Bisa Mengubah Data'); 
					Session::flash('alert-class', 'alert-danger');
					return back();
				} else {
					$cekdata		= Bantuanriset::where('idpegawai', $idpegawai)->where('judul', $judul)->where('id', '!=', $idne)->count();
					if ($cekdata != 0){
						Session::flash('status', 'Error');
						Session::flash('message', 'Bantuan '.$jenis.' Tahun '.$tahun.' Sudah Ada Untuk Pegawai Ybs.'); 
						Session::flash('alert-class', 'alert-danger');
						return back();
					}else {
						if ($request->hasFile('publikasi_file')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:pdf,PDF|max:20000'
							]);
							if ($validator->fails()) {
								Session::flash('status', 'Error');
								Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 20mb.'); 
								Session::flash('alert-class', 'alert-danger');
								return back();
							} else {
								$qdislws		= Bantuanriset::where('id', $idne)->first();
								$namafile 		= $qdislws->scanloa;
								if ($namafile != ''){
									if (File::exists(base_path()) ."/public/scan/publikasi/". $namafile) {
									  File::delete(base_path() ."/public/scan/publikasi/". $namafile);
									}
								} else {
									$namafile 		= $ppabp.'-RISET-'.$idpegawai.'-'.$judul;
									$namafile		= md5($namafile);
									$namafile		= $namafile.'.'.$request->file('publikasi_file')->getClientOriginalExtension();
								}
								$uploadedFile 	= $request->file('publikasi_file');
								$uploadedFile->move(public_path('scan/publikasi'), $namafile);
								Filess::create([
									'url'			=> $idsimba,
									'title'			=> 'penelitian',
									'description'	=> 'Bukti Dukung '.$penjabaran,
									'name'			=> $namafile,
								]);
								Bantuanriset::where('id', $idne)->update([
									'namajurnal'		=> $request->input('id_tujuan'),
									'jenis'				=> $request->input('id_jenis'),
									'kategori'			=> $request->input('id_bidang'),
									'judul'				=> $request->input('publikasi_judul'),
									'jurusan'			=> $request->input('publikasi_jurusan'), 
									'prodi'				=> $request->input('publikasi_prodi'), 
									'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
									'sjr'				=> $request->input('id_sumberdana'), 
									'indeks'			=> $request->input('id_instudana'), 
									'status'			=> $request->input('id_hasilluaran'), 
									'nominal'			=> $nominal, 
									'tahun'				=> $request->input('id_tahundana'),
									'scanloa'			=> $namafile, 
								]);
								Session::flash('status', 'Success');
								Session::flash('message', 'Data Bantuan Riset Telah Terupdate'); 
								Session::flash('alert-class', 'alert-success');
								return back();
							}
						} else {
							Bantuanriset::where('id', $idne)->update([
								'namajurnal'		=> $request->input('id_tujuan'),
								'jenis'				=> $request->input('id_jenis'),
								'kategori'			=> $request->input('id_bidang'),
								'judul'				=> $request->input('publikasi_judul'),
								'jurusan'			=> $request->input('publikasi_jurusan'), 
								'prodi'				=> $request->input('publikasi_prodi'), 
								'bidangilmu'		=> $request->input('publikasi_bidangilmu'), 
								'sjr'				=> $request->input('id_sumberdana'), 
								'indeks'			=> $request->input('id_instudana'), 
								'status'			=> $request->input('id_hasilluaran'), 
								'nominal'			=> $nominal, 
								'tahun'				=> $request->input('id_tahundana'),
							]);
							Session::flash('status', 'Success');
							Session::flash('message', 'Data Bantuan Riset Telah Terupdate'); 
							Session::flash('alert-class', 'alert-success');
							return back();
						}
					}
				}
			}
        }
    }
	public function exsettingppatk(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'setting_ppk'    	=>  'required', 
            'setting_bpp'  		=>  'required',
        ]);

        if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
			$fakpanjang		= Session('fakpanjang');
			if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
            $idppk    		= $request->input('setting_ppk');
            $idbpp  		= $request->input('setting_bpp');
			$jenppk  		= $request->input('setting_ppkjenis');
			$jenbpp  		= $request->input('setting_bppjenis');
			$cekbpp			= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', $jenbpp)->count();
			if ($cekbpp != 0){
				$update		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', $jenbpp)->update([
					'isi1'	=> $idbpp
				]);
			}else {
				$update 	= SettingKeuangan::create([
						'ppabp' =>  $fakpanjang,
						'jenis' =>  $jenbpp,
						'isi1' 	=>  $idbpp,
						'isi2' 	=>  '',
					]);
			}
			$cekppk						= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', $jenppk)->count();
			if ($cekppk != 0){
				$update		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', $jenppk)->update([
						'isi1'	=> $idppk
				]);
			}else {
				$update 	= SettingKeuangan::create([
						'ppabp' =>  $fakpanjang,
						'jenis' =>  $jenppk,
						'isi1' 	=>  $idppk,
						'isi2' 	=>  '',
					]);
			}
			if ($update){
				Session::flash('status', 'Success');
				Session::flash('message', 'Setting Telah Tersimpan'); 
				Session::flash('alert-class', 'alert-success');
				return back();
			}else {
				Session::flash('status', 'Error');
				Session::flash('message', 'Setting Gagal Tersimpan, Silahkan Refresh Halaman Anda'); 
				Session::flash('alert-class', 'alert-danger');
				return back();
			}
        }
    }
	public function ctkKwtbantuan(Request $request) {
		$fakpanjang		= Session('fakpanjang');
		$idne			= $request->input('val01');
		$tabel			= $request->input('val02');
		$jenisnip		= 'NIP';
		if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
		function Terbilang($x){
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
		if ($tabel == 'publikasi'){
			$cekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Publikasi')->count();
			if ($cekbpp != 0){
				$jcekbpp		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Publikasi')->first();
				$idbpp			= $jcekbpp->isi1;
				$getbpp			= Simpegpegawai::where('id', $idbpp)->first();
				$bpp			= $getbpp->nama_lengkap;
				$nipbpp			= $getbpp->nip_baru;
			}else {
				$bpp			= '';
				$nipbpp			= '';
			}
			$cekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Publikasi')->count();
			if ($cekppk != 0){
				$jcekppk		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Publikasi')->first();
				$idppk			= $jcekppk->isi1;
				$getppk			= Simpegpegawai::where('id', $idppk)->first();
				$ppk			= $getppk->nama_lengkap;
				$nipppk			= $getppk->nip_baru;
			}else {
				$ppk			= '';
				$nipppk			= '';
			}
			$cekstatus 		= Bantuanpublikasi::where('id', $idne)->first();
			$tanggalterima	= $cekstatus->tanggalterima;
			$idpegawai		= $cekstatus->idpegawai; 
			$ppabp			= $cekstatus->ppabp; 
			$namajurnal		= $cekstatus->namajurnal; 
			$jenis			= $cekstatus->jenis; 
			$kategori		= $cekstatus->kategori; 
			$judul			= $cekstatus->judul; 
			$issn			= $cekstatus->issn; 
			$laman			= $cekstatus->laman; 
			$voljurnal		= $cekstatus->voljurnal; 
			$halaman		= $cekstatus->halaman; 
			$nominal		= $cekstatus->nominal; 
			$tahun			= $cekstatus->tahun;
			$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
			if (isset($getpegawai->id)){
				$penerima	= $getpegawai->nama_lengkap;
				$nippenerima= $getpegawai->nip_baru;
				$jenisnip	= $getpegawai->jenisnip;
			} else {
				$penerima	= '';
				$nippenerima= '';
			}
			if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
			if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
			if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
			if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
			if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
			if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
			if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
			if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
			if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
			if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
			if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
			if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
			if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
			if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
			if ($judul != '' AND $namajurnal != ''){
				$deskripsi = 'Bantuan insentif publikasi artikel pada '.$namajurnal.', '.$voljurnal.', '.$halaman.', '.$tahun.', ISSN : '.$issn.' dengan judul '.$judul;
			} else {
				$deskripsi = 'Bantuan insentif '.$tulisjenis.', Tahun '.$tahun.', dengan judul '.$judul;
			}
			$banyakuang		= Terbilang($nominal);
			$banyakuang		= $banyakuang.' rupiah';
			$banyakuang		= ucwords($banyakuang);
			$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
			$tlsnominal		= 'Rp. '.$tlsnominal.',-';
			if ($tanggalterima == '0000-00-00'){ $tanggalterima = ''; }
		} else if ($tabel == 'riset'){
			$cekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Riset')->count();
			if ($cekbpp != 0){
				$jcekbpp		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP Riset')->first();
				$idbpp			= $jcekbpp->isi1;
				$getbpp			= Simpegpegawai::where('id', $idbpp)->first();
				$bpp			= $getbpp->nama_lengkap;
				$nipbpp			= $getbpp->nip_baru;
			}else {
				$bpp			= '';
				$nipbpp			= '';
			}
			$cekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Riset')->count();
			if ($cekppk != 0){
				$jcekppk		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK Riset')->first();
				$idppk			= $jcekppk->isi1;
				$getppk			= Simpegpegawai::where('id', $idppk)->first();
				$ppk			= $getppk->nama_lengkap;
				$nipppk			= $getppk->nip_baru;
				$jenisnip		= $getpegawai->jenisnip;
			}else {
				$ppk			= '';
				$nipppk			= '';
			}
			$cekstatus 		= Bantuanriset::where('id', $idne)->first();
			$tanggalterima	= $cekstatus->tanggalterima;
			$idpegawai		= $cekstatus->idpegawai; 
			$ppabp			= $cekstatus->ppabp; 
			$namajurnal		= $cekstatus->namajurnal; 
			$jenis			= $cekstatus->jenis; 
			$kategori		= $cekstatus->kategori; 
			$judul			= $cekstatus->judul; 
			$issn			= $cekstatus->issn; 
			$laman			= $cekstatus->laman; 
			$voljurnal		= $cekstatus->voljurnal; 
			$halaman		= $cekstatus->halaman; 
			$nominal		= $cekstatus->nominal; 
			$tahun			= $cekstatus->tahun;
			$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
			if (isset($getpegawai->id)){
				$penerima	= $getpegawai->nama_lengkap;
				$nippenerima= $getpegawai->nip_baru;
				$jenisnip	= $getpegawai->jenisnip;
			} else {
				$penerima	= '';
				$nippenerima= '';
			}
			$deskripsi 		= 'Bantuan insentif Riset Penelitan dan PKM Tahun '.$tahun.', dengan judul '.$judul;
			$banyakuang		= Terbilang($nominal);
			$banyakuang		= $banyakuang.' rupiah';
			$banyakuang		= ucwords($banyakuang);
			$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
			$tlsnominal		= 'Rp. '.$tlsnominal.',-';
			if ($tanggalterima == '0000-00-00'){ $tanggalterima = ''; }
		} else {
			$cekbpp				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->count();
			if ($cekbpp != 0){
				$jcekbpp		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->first();
				$idbpp			= $jcekbpp->isi1;
				$getbpp			= Simpegpegawai::where('id', $idbpp)->first();
				$bpp			= $getbpp->nama_lengkap;
				$nipbpp			= $getbpp->nip_baru;
			}else {
				$bpp			= '';
				$nipbpp			= '';
			}
			$cekppk				= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->count();
			if ($cekppk != 0){
				$jcekppk		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->first();
				$idppk			= $jcekppk->isi1;
				$getppk			= Simpegpegawai::where('id', $idppk)->first();
				$ppk			= $getppk->nama_lengkap;
				$nipppk			= $getppk->nip_baru;
			}else {
				$ppk			= '';
				$nipppk			= '';
			}
			$cekstatus 		= Bantuanstudi::where('id', $idne)->first();
			$tanggalterima	= $cekstatus->tanggalterima;
			$idpegawai		= $cekstatus->idpegawai; 
			$scankhs		= $cekstatus->scankhs; 
			$tahun			= $cekstatus->tahun;
			$semester		= $cekstatus->semester;
			$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
			$penerima		= $getpegawai->nama;
			$nippenerima	= $getpegawai->nip;
			$fakpenerima	= $getpegawai->fakultas;
			$jenispeg		= $getpegawai->jenispeg;
			$deskripsi 		= '';
			$spp 			= 0;
			$hidup			= 0;
			$buku			= 0;
			$akhir			= 0;
			$penelitian		= 0;
			$hitung			= 0;
			$hitung			= Bantuanstudi::where('scankhs', $scankhs)->count();
			$getalljenis	= Bantuanstudi::where('scankhs', $scankhs)->get();
			$tabelawal 		= '<table cellspacing="0" cellpadding="0" border="0><tr><td colspan="5">';
			$listbantuan	= '';
			$tlsbantuan		= '';
			$fakultasstudi	= '';
			if ($fakpenerima != ''){
				$fakpenerima = '( '.$jenispeg.' pada '.$fakpenerima.' )';
			}
			$fakultas 		= $getpegawai->fakultas;
			foreach ($getalljenis as $rjenis) {
				$jenis 			= $rjenis->jenis;
				$nomjenis		= $rjenis->nominal;
				$jenjang		= $rjenis->jenjang;
				$fakultas		= $rjenis->fakultas;
				$universitas	= $rjenis->universitas;
				$prodi			= $rjenis->prodi;
				$tlsnomjenis= number_format( $nomjenis, 0 , '.' , ',' );
				if ($hitung == 1){
					if ($getpegawai->fakultas == $rjenis->fakultas){
						$fakpenerima = '';
					} else {
						$fakpenerima = '( '.$jenispeg.' '.$getpegawai->fakultas.' )';
					}
					if ($jenis == 'Tes Kursus'){
						$deskripsi 	= $deskripsi.'Bantuan '.$jenis.' dalam rangka studi '.$jenjang.' '.$prodi.' di '.$rjenis->fakultas.' '.$universitas.' '.$fakpenerima;
					} else {
						$deskripsi 	= $deskripsi.'Bantuan '.$jenis.' Semester '.$semester.' Tahun '.$tahun.' dalam rangka studi '.$jenjang.' '.$prodi.' di '.$rjenis->fakultas.' '.$universitas.' '.$fakpenerima;
					}
				} else {
					if ($listbantuan == ''){
						$tlsbantuan = $tlsbantuan.' Bantuan '.$jenis;
					} else {
						$tlsbantuan = $tlsbantuan.', Bantuan '.$jenis;
					}
					$listbantuan = $listbantuan.'<tr><td width="20">-</td><td>Bantuan '.$jenis.'</td><td  width="40" align="right">:</td><td width="60" align="center">Rp.</td><td align="right">'.$tlsnomjenis.'</td></tr>';
				}
				
				if ($jenis == 'SPP'){ $spp = $spp + $nomjenis; }
				else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nomjenis; }
				else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nomjenis; }
				else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nomjenis; }
				else { $penelitian = $penelitian + $nomjenis; }
			}
			if ($getpegawai->fakultas == $fakultas){
				$fakpenerima = '';
			} else {
				if ($getpegawai->fakultas != ''){
					$fakpenerima = '( '.$jenispeg.' pada '.$getpegawai->fakultas.' )';
				} else {
					$fakpenerima = '';		
				}
			}
		
			if ($tlsbantuan != ''){
				$deskripsi = $tabelawal.$tlsbantuan.' Semester '.$semester.' Tahun '.$tahun.' dalam rangka studi '.$jenjang.' '.$prodi.' di '.$fakultasstudi.' '.$universitas.' '.$fakpenerima.'</td></tr>'.$listbantuan.'</table>';
			}
			
			$nominal 		= $spp + $hidup + $buku + $akhir + $penelitian;
			$banyakuang		= Terbilang($nominal);
			$banyakuang		= $banyakuang.' rupiah';
			$banyakuang		= ucwords($banyakuang);
			$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
			$tlsnominal		= 'Rp. '.$tlsnominal.',-';
			if ($tanggalterima == '0000-00-00'){ $tanggalterima = ''; }
		}
		$ceksek = Simpegpegawai::where('nip_baru', $nippenerima)->first();
		if (isset($ceksek->pns)){
			$jenisnip = $ceksek->pns;
			if ($jenisnip == 'PNS'){
				$jenisnip = 'NIP';
			} else {
				$jenisnip = 'NIK';
			}
		}
		if ($jenisnip == ''){
			$jenisnip				= 'NIK';
		}
		$data['universitas']   		= config('global.swandhanauniv');
		$data['kementerian']   		= config('global.swandhanakemen');
		$data['fakultas']   		= $fakpanjang;
		$data['jenisnip']   		= $jenisnip;
		$data['swandhanaalamat']   	= config('global.swandhanaalamat');
		$data['swandhanaemail']   	= config('global.swandhanaemail');
		$data['tahun']   			= $tahun;
		$data['banyakuang']			= $banyakuang;
		$data['deskripsi']			= $deskripsi;
		$data['ppk']				= $ppk;
		$data['nipppk']				= $nipppk;
		$data['bpp']				= $bpp;
		$data['nipbpp']				= $nipbpp;
		$data['penerima']			= $penerima;
		$data['nippenerima']		= $nippenerima;
		$data['nominal']			= $tlsnominal;
		$data['tanggalterima']		= $tanggalterima;
		return view('cetak.keuangan.kwitansibantuan', $data);
    }
	public function viewSptjm($id) {
		$fakpanjang			= Session('fakpanjang');
		$kementerian		= strtoupper(config('global.swandhanakemen'));
		$kota 				= strtoupper(config('global.swandhanakota'));
		$universitas 		= config('global.swandhanauniv');
		$namaapp 			= strtoupper(config('global.swandhananama'));	
		$swandhanafak   	= strtoupper(config('global.swandhanafak'));
		$swandhanaalamat	= strtoupper(config('global.swandhanaalamat'));
		$swandhanakemen 	= $kementerian;
		$swandhanauniv  	= strtoupper($universitas);
		$swandhanatelpon	= config('global.swandhanatelpon');
		$swandhanaemail 	= config('global.swandhanaemail');
		$swandhanakota		= config('global.swandhanakota');
		$mons 				= array(0 => "", 1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
		$kalender			= array(0 => "", 1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$homebase			= url("/");
		if ($fakpanjang	== ''){ $fakpanjang = 'Kantor Pusat'; }
		function Terbilang($x){
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
		$cekbpp			= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->count();
		if ($cekbpp != 0){
			$jcekbpp		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'BPP')->first();
			$idbpp			= $jcekbpp->isi1;
			$getbpp			= Simpegpegawai::where('id', $idbpp)->first();
			$bpp			= $getbpp->nama_lengkap;
			$nipbpp			= $getbpp->nip_baru;
		}else {
			$bpp			= '';
			$nipbpp			= '';
		}
		$cekppk			= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->count();
		if ($cekppk != 0){
			$jcekppk		= SettingKeuangan::where('ppabp', $fakpanjang)->where('jenis', 'PPK')->first();
			$idppk			= $jcekppk->isi1;
			$getppk			= Simpegpegawai::where('id', $idppk)->first();
			$ppk			= $getppk->nama_lengkap;
			$nipppk			= $getppk->nip_baru;
		}else {
			$ppk			= '';
			$nipppk			= '';
		}
		$cekstatus 		= Bantuanstudi::where('id', $id)->first();
		$tanggalterima	= $cekstatus->tanggalterima;
		$idpegawai		= $cekstatus->idpegawai; 
		$scankhs		= $cekstatus->scankhs; 
		$tahun			= $cekstatus->tahun;
		$semester		= $cekstatus->semester;
		$sptjm			= $cekstatus->sptjm;
		$created_at		= $cekstatus->created_at;
		$cekcreated		= explode(" ", $created_at);
		$created_at		= $cekcreated[0];
		$arrtglcreate	= explode("-", $created_at);
		$yycreate		= $arrtglcreate[0];
		$mmcreate		= $arrtglcreate[1];
		$ddcreate		= $arrtglcreate[2];
		if (is_null($sptjm) OR $sptjm == ''){
			$sptjm		= $scankhs;
			Bantuanstudi::where('id', $id)->update([
				'sptjm'	=> $cekstatus->scankhs
			]);
		}
		$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
		$penerima		= $getpegawai->nama;
		$nippenerima	= $getpegawai->nip;
		$fakpenerima	= $getpegawai->fakultas;
		$jenispeg		= $getpegawai->jenispeg;
		$deskripsi 		= '';
		$spp 			= 0;
		$hidup			= 0;
		$buku			= 0;
		$akhir			= 0;
		$penelitian		= 0;
		$hitung			= 0;
		$hitung			= Bantuanstudi::where('scankhs', $scankhs)->count();
		$getalljenis	= Bantuanstudi::where('scankhs', $scankhs)->get();
		$tabelawal 		= '<table cellspacing="0" cellpadding="0" border="0><tr><td colspan="5">';
		$listbantuan	= '';
		$tlsbantuan		= '';
		$fakstudi		= '';
		foreach ($getalljenis as $rjenis) {
			$jenis 		= $rjenis->jenis;
			$nomjenis	= $rjenis->nominal;
			$jenjang	= $rjenis->jenjang;
			$fakultas	= $rjenis->fakultas;
			$universitas= $rjenis->universitas;
			$prodi		= $rjenis->prodi;
			if ($fakstudi == ''){
				$fakstudi = $rjenis->fakultas;
			}
			//if ($jenis == 'Penelitian'){
			//	$jenis 	= 'Penelitian dan Ujian Akhir';
			//}
			
			$tlsnomjenis= number_format( $nomjenis, 0 , '.' , ',' );
			if ($hitung == 1){
				$banyakuang	= Terbilang($nomjenis);
				if ($jenis == 'Tes Kursus'){
					$deskripsi 	= $deskripsi.'Bantuan '.$jenis.' dalam rangka studi '.$jenjang.' '.$prodi.' di '.$rjenis->fakultas.' '.$universitas.' ( '.$jenispeg.' pada '.$rjenis->ppabp.' ) sebesar '.$tlsnomjenis.' ( '.$banyakuang.' )';
				} else {
					$deskripsi 	= $deskripsi.'Bantuan '.$jenis.' Semester '.$semester.' Tahun '.$tahun.' dalam rangka studi '.$jenjang.' '.$prodi.' di '.$rjenis->fakultas.' '.$universitas.' ( '.$jenispeg.' pada '.$rjenis->ppabp.' ) sebesar '.$tlsnomjenis.' ( '.$banyakuang.' )';
				}
			} else {
				if ($listbantuan == ''){
					$tlsbantuan = $tlsbantuan.' Bantuan '.$jenis;
				} else {
					$tlsbantuan = $tlsbantuan.', Bantuan '.$jenis;
				}
				$listbantuan = $listbantuan.'<tr><td width="20">-</td><td>Bantuan '.$jenis.' Semester '.$semester.' Tahun '.$tahun.'</td><td  width="40" align="right">:</td><td width="60" align="center">Rp.</td><td align="right">'.$tlsnomjenis.'</td></tr>';
			}
			
			if ($jenis == 'SPP'){ $spp = $spp + $nomjenis; }
			else if ($jenis == 'Biaya Hidup'){ $hidup = $hidup + $nomjenis; }
			else if ($jenis == 'Biaya Buku'){ $buku = $buku + $nomjenis; }
			else if ($jenis == 'Ujian Akhir'){ $akhir = $akhir + $nomjenis; }
			else { $penelitian = $penelitian + $nomjenis; }
		}
		$nominal 		= $spp + $hidup + $buku + $akhir + $penelitian;
		$banyakuang		= Terbilang($nominal);
		$banyakuang		= $banyakuang.' rupiah';
		$banyakuang		= ucwords($banyakuang);
		$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
		$tlsnominal		= 'Rp. '.$tlsnominal.',-';
		if ($tanggalterima == '0000-00-00'){ $tanggalterima = ''; }
		if ($tlsbantuan != ''){
			$deskripsi = $tlsbantuan.' Semester '.$semester.' Tahun '.$tahun.' dalam rangka studi '.$jenjang.' '.$prodi.' di '.$fakstudi.' '.$universitas.' ( '.$jenispeg.' pada '.$fakpenerima.' ) sebesar '.$tlsnominal.' ( '.$banyakuang.' )';
		}
		
		$ukuranfont		= '14';
		$spasi			= '&nbsp;';
		$jenisfontte	= '<font size="1" color="blue">';
		$fontstyle		= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;"';
		$jenisfontte	= '<font size="1" color="blue">';
		$ukuranfontplus1= '+2';
		$ukuranfontplus2= '+1';
		if (Session('fakultas') == 'KP'){ 
			$tlsfakultas = '<font size="'.$ukuranfontplus2.'"><strong>'.$swandhanauniv.'</strong></font>'; 
		} else {
			$getpanjang = User::where('fakultas', Session('fakultas'))->where('fakpanjang', '!=', '')->first();
			if (isset($getpanjang->fakpanjang)){
				$fakpanjang	 = $getpanjang->fakpanjang;
				if ($fakultas == 'PASCAUB'){
					$fakpanjang = 'PASCASARJANA';
				}
				$tlsfakultas = '<br /><strong><font size="'.$ukuranfontplus2.'">'.$fakpanjang.'</font></strong>';
				$tlsfakultas = '<font size="'.$ukuranfontplus1.'">'.$swandhanauniv.'</font>'.$tlsfakultas; 
			} else { $tlsfakultas = '<font size="'.$ukuranfontplus1.'"><strong>'.$swandhanauniv.'</strong></font>'; }
		}
		if (file_exists(public_path('images/kopsurat/'.Session('fakultas').'.png'))){
			$kopsurat = '<img src="'.$homebase.'/images/kopsurat/'.Session('fakultas').'.png" width="720" />';
		} else {
			$kopsurat = '<table width="690" cellpadding="0" cellspacing="0" border="0"  style="font-family: "Times New Roman", Times, serif;">
							<col width="20" />
							<col width="70" />
							<col width="20" />
							<col width="250" />
							<col width="40" />
							<col width="80" />
							<col width="40" />
							<col width="80" />
							<tr>
								<td colspan="2" rowspan="5" align="center" valign="top"><img src="'.$homebase.'/logo-ub.png" alt="" width="100" /></td>
								<td colspan="6" align="center" style="font-family: "Times New Roman", Times, serif;"><font size="'.$ukuranfontplus1.'">'.$swandhanakemen.'</font></td>
							</tr>
							<tr>
								<td colspan="6" align="center" style="font-family: "Times New Roman", Times, serif;"  height="50">'.$tlsfakultas.'</td>
							</tr>
							<tr>
								<td colspan="6" align="center" valign="midlle" style="font-family: "Times New Roman", Times, serif;">'.$swandhanaalamat.'</td>
							</tr>
							<tr>
								<td colspan="6" align="center" valign="midlle" style="font-family: "Times New Roman", Times, serif;">'.$swandhanatelpon.'</td>
							</tr>
							<tr>
								<td colspan="6" align="center" valign="midlle" style="font-family: "Times New Roman", Times, serif;">'.$swandhanaemail.'</td>
							</tr>
							<tr>
								<td colspan="8" align="center" valign="top" style="border-bottom: 1px double black;">&nbsp;</td>
							</tr>
						</table>';
		}
		$generatesurat		= '
				<table width="720" border="0" cellpadding="0" cellspacing="0" id="printiki" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
					<tr>
						<th width="20" scope="col">&nbsp;</th>
						<th width="170" scope="col">&nbsp;</th>
						<th width="10" scope="col">&nbsp;</th>
						<th width="200" scope="col">&nbsp;</th>
						<th width="300" scope="col"></th>
					</tr>
					<tr>
						<td colspan="5">'.$kopsurat.'</td>
					</tr>
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify"><td colspan="5" align="center"><font size="+1"><strong>SURAT PERNYATAAN<br />TANGGUNG JAWAB MUTLAK</strong></font></td></tr>		
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify">
						<td>&nbsp;</td>
						<td colspan="4">Yang bertanda tangan di bawah ini :</td>
					</tr>
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify">
						<td>&nbsp;</td>
						<td align="left" valign="top">Nama</td>
						<td valign="top">:</td>
						<td colspan="2" valign="top">'.$penerima.'</td>
					</tr>
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify">
						<td>&nbsp;</td>
						<td colspan="4">Menyatakan dengan sesungguhnya bahwa '.$deskripsi.' telah dihitung dengan benar serta dilaksanakan sesuai ketentuan yang berlaku.</td>
					</tr>
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify">
						<td>&nbsp;</td>
						<td colspan="4">Apabila dikemudian hari terdapat kekeliruan atas pembayaran tersebut kami bersedia untuk menyetor kelebihan tersebut kepada Kuasa Pengguna Anggaran Universitas Brawijaya.</td>
					</tr>
					<tr style="text-align: justify">
						<td>&nbsp;</td>
						<td colspan="4">Demikian Surat Pernyataan ini dibuat dengan sebenar - benarnya.</td>
					</tr>
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
					<tr style="text-align: justify">
						<td colspan="4">&nbsp;</td>
						<td>Malang, '.$tanggalterima.'<br />Penerima Bantuan Dana,</td>
					</tr>
					[sptjm]
					<tr style="text-align: justify">
						<td colspan="4">&nbsp;</td>
						<td>'.$penerima.'</td>
					</tr>
				</table>';
		$cektandatangan 	= Suratkeluartnpnomor::where('marking', $sptjm)->count();
		if ($cektandatangan == 0){
			$idttd 			= Suratkeluartnpnomor::insertGetId([
				'marking' 		=>  $sptjm,
				'jenissrt' 		=>  'SPTJM',
				'kodefak' 		=>  '',
				'unit' 			=>  'KP',
				'tglbuat' 		=>  $created_at,
				'yersrt' 		=>  $yycreate,
				'dasarsurat' 	=>  $cekstatus->scankhs,
				'kepada' 		=>  $penerima,
				'alamat' 		=>  $fakpenerima,
				'perihal' 		=>  'SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK',
				'lampiran' 		=>  $nippenerima,
				'isisurat' 		=>  $generatesurat,
				'idpejabat' 	=>  $idpegawai,
				'pejabat' 		=>  $getpegawai->jabfung,
				'namapejabat' 	=>  $fakpenerima,
				'tembusan' 		=>  '',
				'sifat' 		=>  'Biasa',
				'klasifikasi' 	=>  'Biasa',
				'pembuat' 		=>  Session('nama'),
				'kelompok' 		=>  Session('jabatan'),
				'status' 		=>  'NEW',
				'arsip' 		=>  '',
				'footnote' 		=>  '',
				'tandatangan' 	=>  '',
				'paraf1' 		=>  '',
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
			$sptjm 	= '	<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
					 	<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
					 	<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
						<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
						<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
						<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>';
			$generatesurat	= str_replace("[sptjm]", $sptjm, $generatesurat);
		} else {
			$getfirst = Suratkeluartnpnomor::where('marking', $sptjm)->first();
			if (isset($getfirst->tandatangan)){
				$sptjm = $getfirst->tandatangan;
			} else {
				$sptjm = '';
			}
			if ($sptjm != ''){ 
				$sptjm 	= '	<tr style="text-align: justify"><td colspan="4">&nbsp;</td><td><img src="'.$sptjm.'" width="80" /></td></tr>';
			} else {
				$sptjm 	= '	<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
							<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
							<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
							<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
							<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>
							<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>';
			}
			$generatesurat	= str_replace("[sptjm]", $sptjm, $generatesurat);
		}
		$data           		= [];
		$data['perihal']   		= $penerima;
		$data['surate']   		= $generatesurat;
		$data['catatankaki']   	= '';
		return view('cetak.suratkeluar', $data);
	}
	public function verifikasiBantuan(Request $request) {
		$idne			= $request->input('val01');
		$tabel			= $request->input('val02');
		$homebase		= url("/");
		if ($tabel == 'publikasi' OR $tabel == 'riset'){
			if ($tabel == 'publikasi'){
				$cekstatus 		= Bantuanpublikasi::where('id', $idne)->first();
			} else {
				$cekstatus 		= Bantuanriset::where('id', $idne)->first();
			}
			$idpegawai		= $cekstatus->idpegawai; 
			$buktidukung	= $cekstatus->scanloa;
			$ppabp			= $cekstatus->ppabp;
			$scandisposisi	= $cekstatus->scandisposisi;
			$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
			if (isset($getpegawai->id)){
				$penerima		= $getpegawai->nama_lengkap;
				$nippenerima	= $getpegawai->nip;
			} else {
				$penerima		= '';
				$nippenerima	= '';
			}
			$tabel			= '
			<h1>Verifikasi Bantuan Publikasi Ilmiah, Riset dan Pengabdian Kpd Masyarakat</h1>
			<table width="100%">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>'.$penerima.'</td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td>'.$nippenerima.'</td>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td>:</td>
					<td>'.$ppabp.'</td>
				</tr>
				<tr>
					<td>Riwayat Bantuan</td>
					<td>:</td>
					<td>(bila ada)</td>
				</tr>
			';
			$cekdatalama	= Bantuanpublikasi::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				$nomer = 1;
				$tabel = $tabel.'<tr><td colspan="3">Riwayat Data Bantuan Publikasi<br /><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>NO</td><td>JUDUL PUBLIKASI</td><td>TAHUN</td><td>NOMINAL</td><td>TANGGAL TERIMA</td><td>KWITANSI</td></tr>';
				foreach ($cekdatalama as $rdatane) {
					$tanggalterima	= $rdatane->tanggalterima;
					$idpegawai		= $rdatane->idpegawai; 
					$ppabp			= $rdatane->ppabp; 
					$namajurnal		= $rdatane->namajurnal; 
					$jenis			= $rdatane->jenis; 
					$kategori		= $rdatane->kategori; 
					$judul			= $rdatane->judul; 
					$issn			= $rdatane->issn; 
					$laman			= $rdatane->laman; 
					$voljurnal		= $rdatane->voljurnal; 
					$halaman		= $rdatane->halaman; 
					$nominal		= $rdatane->nominal; 
					$tahun			= $rdatane->tahun;
					$scanloa		= $rdatane->scanloa;
					$kwitansi		= $rdatane->scantandaterima;
					$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
					if ($idne == $rdatane->id){
						$tanggalterima = '<strong>Current Data</strong>';
					}
					$kwitansibantuan= '';
					if ($kwitansi != ''){
						if (File::exists(base_path()) ."/public/scan/kwitansi/". $kwitansi) {
							$kwitansibantuan = '<a href="'.$homebase.'/scan/kwitansi/'.$kwitansi.'" target="_blank">DOWNLOAD</a>';
						}
					}
					if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
					if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
					if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
					if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
					if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
					if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
					if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
					if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
					if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
					if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$judul.'</td><td>'.$tahun.'</td><td align="right">'.$tlsnominal.'</td><td>'.$tanggalterima.'</td><td>'.$kwitansibantuan.'</td></tr>';
					$nomer++;
				}
				$tabel = $tabel.'</table></td></tr>';
			}
			$cekdatalama	= Bantuanriset::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				$nomer = 1;
				$tabel = $tabel.'<tr><td colspan="3">Riwayat Data Bantuan Riset dan PKM<br /><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>NO</td><td>JUDUL RISET / PKM</td><td>TAHUN</td><td>NOMINAL</td><td>TANGGAL TERIMA</td><td>KWITANSI</td></tr>';
				foreach ($cekdatalama as $rdatane) {
					$tanggalterima	= $rdatane->tanggalterima;
					$idpegawai		= $rdatane->idpegawai; 
					$ppabp			= $rdatane->ppabp; 
					$namajurnal		= $rdatane->namajurnal; 
					$jenis			= $rdatane->jenis; 
					$kategori		= $rdatane->kategori; 
					$judul			= $rdatane->judul; 
					$issn			= $rdatane->issn; 
					$laman			= $rdatane->laman; 
					$voljurnal		= $rdatane->voljurnal; 
					$halaman		= $rdatane->halaman; 
					$nominal		= $rdatane->nominal; 
					$tahun			= $rdatane->tahun;
					$scanloa		= $rdatane->scanloa;
					$kwitansi		= $rdatane->scantandaterima;
					$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
					if ($idne == $rdatane->id){
						$tanggalterima = '<strong>Current Data</strong>';
					}
					$kwitansibantuan= '';
					if ($kwitansi != ''){
						if (File::exists(base_path()) ."/public/scan/kwitansi/". $kwitansi) {
							$kwitansibantuan = '<a href="'.$homebase.'/scan/kwitansi/'.$kwitansi.'" target="_blank">DOWNLOAD</a>';
						}
					}
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$judul.'</td><td>'.$tahun.'</td><td align="right">'.$tlsnominal.'</td><td>'.$tanggalterima.'</td><td>'.$kwitansibantuan.'</td></tr>';
					$nomer++;
				}
				$tabel = $tabel.'</table></td></tr>';
			}
			$datadukung1 = '';
			$datadukung2 = '';
			if ($buktidukung != ''){
				if (File::exists(base_path()) ."/public/scan/publikasi/". $buktidukung) {
					$datadukung1 = '<iframe src="'.$homebase.'/scan/publikasi/'.$buktidukung.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
				}
			}
			if ($scandisposisi != ''){
				if (File::exists(base_path()) ."/public/scan/publikasi/". $scandisposisi) {
					$datadukung2 = '<iframe src="'.$homebase.'/scan/publikasi/'.$scandisposisi.'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
				}
			}
			$tabel = $tabel.'<tr><td colspan="3"> SCAN DATA DUKUNG </td></tr>';
			$tabel = $tabel.'<tr><td colspan="3">'.$datadukung1.'</td></tr>';
			if ($scandisposisi != ''){
				$tabel = $tabel.'<tr><td colspan="3"> SCAN DISPOSISI </td></tr>';
				$tabel = $tabel.'<tr><td colspan="3">'.$datadukung2.'</td></tr>';
			}			
			$tabel = $tabel.'</table>';
		} else if ($tabel == 'pribadi'){
			$getpegawai		= Bantuanpenerima::where('id', $idne)->first();
			$penerima		= $getpegawai->nama;
			$nippenerima	= $getpegawai->nip;
			$idpegawai		= $getpegawai->id;
			$ppabp			= $getpegawai->fakultas;
			$tabel			= '
			<h1>Riwayat Bantuan Yang Pernah di Terima</h1>
			<table width="100%">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>'.$penerima.'</td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td>'.$nippenerima.'</td>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td>:</td>
					<td>'.$ppabp.'</td>
				</tr>
				<tr>
					<td>Sekolah/Universitas, Negara</td>
					<td>:</td>
					<td>'.$getpegawai->namapt.', '.$getpegawai->negara.'</td>
				</tr>
				<tr>
					<td>Fakultas / Departemen</td>
					<td>:</td>
					<td>'.$getpegawai->fakstudi.', '.$getpegawai->prodi.'</td>
				</tr>
				<tr>
					<td>Judul Tesis / Disertasi</td>
					<td>:</td>
					<td>'.$getpegawai->judul.'</td>
				</tr>
				<tr>
					<td>Mulai Studi, Tahun Akademik</td>
					<td>:</td>
					<td>'.$getpegawai->mulaistudi.', '.$getpegawai->startthnakad.'</td>
				</tr>
				<tr>
					<td>Perkiraan Selesai</td>
					<td>:</td>
					<td>'.$getpegawai->endthnakad.'</td>
				</tr>
				<tr>
					<td>Riwayat Bantuan</td>
					<td>:</td>
					<td>(bila ada)<p></p></td>
				</tr>
			';
			$cekdatalama	= Bantuanstudi::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				$nomer 	= 1;
				$total	= 0;
				$tabel 	= $tabel.'<tr><td colspan="3"><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>NO</td><td>BANTUAN</td><td>TAHUN/SEMESTER</td><td>NOMINAL</td><td>TANGGAL TERIMA</td><td>KWITANSI</td></tr>';
				foreach ($cekdatalama as $rdatane) {
					$tanggalterima	= $rdatane->tanggalterima;
					$idpegawai		= $rdatane->idpegawai; 
					$ppabp			= $rdatane->ppabp; 
					$jenis			= $rdatane->jenis; 
					$nominal		= $rdatane->nominal; 
					$tahun			= $rdatane->tahun;
					$semester		= $rdatane->semester;
					$kwitansi		= $rdatane->scantandaterima;
					$total			= $total + $nominal;
					$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
					$kwitansibantuan= '';
					if ($kwitansi != ''){
						if (File::exists(base_path()) ."/public/scan/kwitansi/". $kwitansi) {
							$kwitansibantuan = '<a href="'.$homebase.'/scan/kwitansi/'.$kwitansi.'" target="_blank">DOWNLOAD</a>';
						}
					}
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$jenis.'</td><td>'.$tahun.'.'.$semester.'</td><td align="right">'.$tlsnominal.'</td><td>'.$tanggalterima.'</td><td>'.$kwitansibantuan.'</td></tr>';
					$nomer++;
				}
				$tlsnominal		= number_format( $total, 0 , '.' , ',' );
				$tabel = $tabel.'<tr><td colspan="3"><b>TOTAL</b></td><td align="right">'.$tlsnominal.'</td><td colspan="2">,-</td></tr>';
				$tabel = $tabel.'</table></td></tr>';
			}
			$cekdatalama	= Bantuanpublikasi::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				$nomer 	= 1;
				$total	= 0;
				$tabel 	= $tabel.'<tr><td colspan="3">Riwayat Data Bantuan Publikasi<br /><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>NO</td><td>JUDUL PUBLIKASI</td><td>TAHUN</td><td>NOMINAL</td><td>TANGGAL TERIMA</td><td>KWITANSI</td></tr>';
				foreach ($cekdatalama as $rdatane) {
					$tanggalterima	= $rdatane->tanggalterima;
					$idpegawai		= $rdatane->idpegawai; 
					$ppabp			= $rdatane->ppabp; 
					$namajurnal		= $rdatane->namajurnal; 
					$jenis			= $rdatane->jenis; 
					$kategori		= $rdatane->kategori; 
					$judul			= $rdatane->judul; 
					$issn			= $rdatane->issn; 
					$laman			= $rdatane->laman; 
					$voljurnal		= $rdatane->voljurnal; 
					$halaman		= $rdatane->halaman; 
					$nominal		= $rdatane->nominal; 
					$tahun			= $rdatane->tahun;
					$scanloa		= $rdatane->scanloa;
					$kwitansi		= $rdatane->scantandaterima;
					$total			= $total + $nominal;
					$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
					$kwitansibantuan= '';
					if ($kwitansi != ''){
						if (File::exists(base_path()) ."/public/scan/kwitansi/". $kwitansi) {
							$kwitansibantuan = '<a href="'.$homebase.'/scan/kwitansi/'.$kwitansi.'" target="_blank">DOWNLOAD</a>';
						}
					}
					if ($kategori == '301111'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Monograf'; }
					if ($kategori == '301112'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam bentuk Buku referensi'; }
					if ($kategori == '301121'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional'; }
					if ($kategori == '301122'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Nasional terakreditasi'; }
					if ($kategori == '301123'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Tidak terakreditasi'; }
					if ($kategori == '301124'){ $tulisjenis = 'Menghasilkan Jurnal ilmiah Internasional Bereputasi'; }
					if ($kategori == '301131'){ $tulisjenis = 'Seminar Internasional'; }
					if ($kategori == '301132'){ $tulisjenis = 'Seminar Nasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301134'){ $tulisjenis = 'Poster Nasional'; }
					if ($kategori == '301141'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Nasional'; }
					if ($kategori == '301142'){ $tulisjenis = 'Menghasilkan karya ilmiah Dalam koran/majalah populer/umum Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					if ($kategori == '301133'){ $tulisjenis = 'Poster Internasional'; }
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$judul.'</td><td>'.$tahun.'</td><td align="right">'.$tlsnominal.'</td><td>'.$tanggalterima.'</td><td>'.$kwitansibantuan.'</td></tr>';
					$nomer++;
				}
				$tlsnominal		= number_format( $total, 0 , '.' , ',' );
				$tabel = $tabel.'<tr><td colspan="3"><b>TOTAL</b></td><td align="right">'.$tlsnominal.'</td><td colspan="2">,-</td></tr>';
				
				$tabel = $tabel.'</table></td></tr>';
			}
			$cekdatalama	= Bantuanriset::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				$nomer 	= 1;
				$total	= 0;
				$tabel 	= $tabel.'<tr><td colspan="3">Riwayat Data Bantuan Riset dan PKM<br /><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>NO</td><td>JUDUL RISET / PKM</td><td>TAHUN</td><td>NOMINAL</td><td>TANGGAL TERIMA</td><td>KWITANSI</td></tr>';
				foreach ($cekdatalama as $rdatane) {
					$tanggalterima	= $rdatane->tanggalterima;
					$idpegawai		= $rdatane->idpegawai; 
					$ppabp			= $rdatane->ppabp; 
					$namajurnal		= $rdatane->namajurnal; 
					$jenis			= $rdatane->jenis; 
					$kategori		= $rdatane->kategori; 
					$judul			= $rdatane->judul; 
					$issn			= $rdatane->issn; 
					$laman			= $rdatane->laman; 
					$voljurnal		= $rdatane->voljurnal; 
					$halaman		= $rdatane->halaman; 
					$nominal		= $rdatane->nominal; 
					$tahun			= $rdatane->tahun;
					$scanloa		= $rdatane->scanloa;
					$kwitansi		= $rdatane->scantandaterima;
					$total			= $total + $nominal;
					$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
					if ($idne == $rdatane->id){
						$tanggalterima = '<strong>Current Data</strong>';
					}
					$kwitansibantuan= '';
					if ($kwitansi != ''){
						if (File::exists(base_path()) ."/public/scan/kwitansi/". $kwitansi) {
							$kwitansibantuan = '<a href="'.$homebase.'/scan/kwitansi/'.$kwitansi.'" target="_blank">DOWNLOAD</a>';
						}
					}
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$judul.'</td><td>'.$tahun.'</td><td align="right">'.$tlsnominal.'</td><td>'.$tanggalterima.'</td><td>'.$kwitansibantuan.'</td></tr>';
					$nomer++;
				}
				$tlsnominal		= number_format( $total, 0 , '.' , ',' );
				$tabel = $tabel.'<tr><td colspan="3"><b>TOTAL</b></td><td align="right">'.$tlsnominal.'</td><td colspan="2">,-</td></tr>';
				$tabel = $tabel.'</table></td></tr>';
			}
			$nomer 			= 1;
			$tabel 			= $tabel.'<tr><td colspan="3">Persyaratan<br /><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>No</td><td>Link</td><td>File</td></tr>';
			$cekdatalama	= Bantuansyarat::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				foreach ($cekdatalama as $rdatane) {
					$namafile 	= $rdatane->namafile;
					if($rdatane->jenfile == 'pdf') {
						$namafile = '<a target="_blank" href="'.$homebase.'/scan/syarat/'.$rdatane->namafile.'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="'.$homebase.'/dist/img/pdf.png"></a>';
					} else if($rdatane->jenfile == 'SCO') {
						$namafile = '<a target="_blank" href="'.$rdatane->namafile.'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="'.$homebase.'/dist/img/pdf.png"></a>';
					} else {
						$namafile = '<a target="_blank" href="'.$homebase.'/scan/syarat/'.$rdatane->namafile.'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="'.$homebase.'/scan/syarat/'.$rdatane->namafile.'"></a>';
					}
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$namafile.'</td><td>'.$rdatane->jenis.'</td></tr>';
					$nomer++;
				}
			}
			$cekdatalama	= Bantuansyarat::where('idpegawai', $nippenerima)->get();
			if (!empty($cekdatalama)){
				foreach ($cekdatalama as $rdatane) {
					$namafile 	= $rdatane->namafile;
					if($rdatane->jenfile == 'pdf') {
						$namafile = '<a target="_blank" href="'.$homebase.'/scan/syarat/'.$rdatane->namafile.'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="'.$homebase.'/dist/img/pdf.png"></a>';
					} else if($rdatane->jenfile == 'SCO') {
						$namafile = '<a target="_blank" href="'.$rdatane->namafile.'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="'.$homebase.'/dist/img/pdf.png"></a>';
					} else {
						$namafile = '<a target="_blank" href="'.$homebase.'/scan/syarat/'.$rdatane->namafile.'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="'.$homebase.'/scan/syarat/'.$rdatane->namafile.'"></a>';
					}
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$namafile.'</td><td>'.$rdatane->jenis.' '.$rdatane->keterangan.'</td></tr>';
					$nomer++;
				}
			}
			$tabel = $tabel.'</table></td></tr></table>';
		} else {
			$cekstatus 		= Bantuanstudi::where('id', $idne)->first();
			$idpegawai		= $cekstatus->idpegawai; 
			$buktidukung1	= $cekstatus->scanloa;
			$buktidukung2	= $cekstatus->scankhs;
			$buktidukung3	= $cekstatus->sktarif;
			$ppabp			= $cekstatus->ppabp;
			$scandisposisi	= $cekstatus->scandisposisi;
			$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
			$penerima		= $getpegawai->nama;
			$nippenerima	= $getpegawai->nip;
			$tabel			= '
			<h1>Verifikasi Bantuan Studi</h1>
			<table width="100%">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>'.$penerima.'</td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td>'.$nippenerima.'</td>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td>:</td>
					<td>'.$ppabp.'</td>
				</tr>
				<tr>
					<td>Riwayat Bantuan</td>
					<td>:</td>
					<td>(bila ada)</td>
				</tr>
			';
			
			$cekdatalama	= Bantuanstudi::where('idpegawai', $idpegawai)->get();
			if (!empty($cekdatalama)){
				$nomer = 1;
				$tabel = $tabel.'<tr><td colspan="3"><table border="1" width="100%" class="table table-bordered table-striped"><tr><td>NO</td><td>BANTUAN</td><td>TAHUN/SEMESTER</td><td>NOMINAL</td><td>TANGGAL TERIMA</td><td>KWITANSI</td></tr>';
				foreach ($cekdatalama as $rdatane) {
					$tanggalterima	= $rdatane->tanggalterima;
					$idpegawai		= $rdatane->idpegawai; 
					$ppabp			= $rdatane->ppabp; 
					$jenis			= $rdatane->jenis; 
					$nominal		= $rdatane->nominal; 
					$tahun			= $rdatane->tahun;
					$semester		= $rdatane->semester;
					$kwitansi		= $rdatane->scantandaterima;
					$tlsnominal		= number_format( $nominal, 0 , '.' , ',' );
					$kwitansibantuan= '';
					if ($idne == $rdatane->id){
						$tanggalterima = '<strong>Current Data</strong>';
					}
					if ($kwitansi != ''){
						if (File::exists(base_path()) ."/public/scan/kwitansi/". $kwitansi) {
							$kwitansibantuan = '<a href="'.$homebase.'/scan/kwitansi/'.$kwitansi.'" target="_blank">DOWNLOAD</a>';
						}
					}
					$tabel = $tabel.'<tr><td>'.$nomer.'</td><td>'.$jenis.'</td><td>'.$tahun.'.'.$semester.'</td><td align="right">'.$tlsnominal.'</td><td>'.$tanggalterima.'</td><td>'.$kwitansibantuan.'</td></tr>';
					$nomer++;
				}
				$tabel = $tabel.'</table></td></tr>';
			}
			if (is_null($buktidukung1)){ $buktidukung1 = ''; }
			if (is_null($buktidukung2)){ $buktidukung2 = ''; }
			if (is_null($buktidukung3)){ $buktidukung3 = ''; }
			if (is_null($scandisposisi)){ $scandisposisi = ''; }
			if ($buktidukung2 != '' ){
				$tabel = $tabel.'<tr><td colspan="3"> SCAN KHS/TRANSKRIP</td></tr>';
				if (File::exists(base_path()) ."scan/publikasi/". $buktidukung2) {
					$tabel = $tabel.'<tr><td colspan="3"><iframe src="'.$homebase.'/scan/publikasi/'.$buktidukung2.'" width="100%" height="300" style="border: none;" id="document-preview"></iframe></td></tr>';
				}
			}
			if ($buktidukung1 != ''){
				$tabel = $tabel.'<tr><td colspan="3"> SCAN LOA </td></tr>';
				if (File::exists(public_path()) ."scan/publikasi/". $buktidukung1) {
					$tabel = $tabel.'<tr><td colspan="3"><iframe src="'.$homebase.'/scan/publikasi/'.$buktidukung1.'" width="100%" height="300" style="border: none;" id="document-preview"></iframe></td></tr>';
				}
			}
			if ($buktidukung3 != ''){
				$tabel = $tabel.'<tr><td colspan="3"> SCAN SK TARIF </td></tr>';
				if (File::exists(public_path()) ."scan/publikasi/". $buktidukung3) {
					$tabel = $tabel.'<tr><td colspan="3"><iframe src="'.$homebase.'/scan/publikasi/'.$buktidukung3.'" width="100%" height="300" style="border: none;" id="document-preview"></iframe></td></tr>';
				}
			}
			if ($scandisposisi != ''){
				$tabel = $tabel.'<tr><td colspan="3"> SCAN DISPOSISI </td></tr>';
				if (File::exists(public_path()) ."scan/publikasi/". $scandisposisi) {
					$tabel = $tabel.'<tr><td colspan="3"><iframe src="'.$homebase.'/scan/publikasi/'.$scandisposisi.'" width="100%" height="300" style="border: none;" id="document-preview"></iframe></td></tr>';
				}
			}	
			$tabel = $tabel.'</table>';
		}
		echo $tabel;
    }
	public function exsetMaksimal(Request $request) {
		$idne			= $request->input('set01');
		$jumlah			= $request->input('set02');
		$keterangan		= $request->input('set03');
		$jenis			= $request->input('set04');
		if ($jenis == 'batas'){
			SettingKeuangan::where('id', $idne)->update([
				'isi1' => $jumlah
			]);
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses.!', 'message' => 'Jumlah Terupdate']);
			return back();
		} else {
			$getdata 		= Bantuanstudi::where('id', $idne)->first();
			$keteranganlm	= $getdata->keterangan;
			$nominallm		= $getdata->nominal;
			$nominallm 		= number_format( $nominallm , 0 , '.' , ',' );
			$keterangan		= $keteranganlm.' Diubah Oleh '.Session('nama').' Pada '.date("Y-m-d H:i:s").' Dengan Nominal Lama Sebesar '.$nominallm.' Dan Nominal Baru '.$jumlah.' Dengan Alasan '.$keterangan.'<br />';
			$jumlah			= str_replace(',','',$jumlah);
			$input 			= Bantuanstudi::where('id', $idne)->update([
				'nominal' 	=> $jumlah,
				'keterangan'=> $keterangan,
			]);
			
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $keterangan]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
				return back();
			}
		}
    }
	public function exaddnewPenerima(Request $request) {
		$idne			= $request->input('set01');
		$nama			= $request->input('set02');
		$nip			= $request->input('set03');
		$email			= $request->input('set04');
		$fakultas		= $request->input('set05');
		$golongan		= $request->input('set06');
		$hape			= $request->input('set07');
		$jenis			= $request->input('set08');
		if ($nip == '' AND $nama == '' AND $fakultas == '' AND $golongan == '' AND $jenis != 'Tabel Pegawai'){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Pastikan NAMA, NIP, Jenis Pegawai, Golongan dan Fakultas Telah terisi']);
			return back();
		} else {
			$nip = preg_replace('/\s+/', '', $nip);
			if ($idne == 'new' OR $idne == 'newpublic'){
				$ceknip 		= Bantuanpenerima::where('nip', $nip)->count();
				if ($ceknip != 0){
					if ($email != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'email'	=> $email
						]);
					}
					if ($hape != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'hape'	=> $hape
						]);
					}
					if ($golongan != '' AND $idne == 'new'){
						Bantuanpenerima::where('nip', $nip)->update([
							'golongan'	=> $golongan
						]);
					}
					if ($golongan != '' AND $idne == 'newpublic'){
						Bantuanpenerima::where('nip', $nip)->update([
							'jabfung'	=> $golongan
						]);
					}
					if ($jenis != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'jenispeg'	=> $jenis
						]);
					}
					if ($request->input('set09') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'jenjang'	=> $request->input('set09')
						]);
					}
					if ($request->input('set10') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'namapt'	=> $request->input('set10')
						]);
					}
					if ($request->input('set11') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'negara'	=> $request->input('set11')
						]);
					}
					if ($request->input('set12') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'mulaistudi'	=> $request->input('set12')
						]);
					}
					if ($request->input('set13') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'tahunsls'	=> $request->input('set13')
						]);
					}
					if ($request->input('set14') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'jenis'	=> $request->input('set14')
						]);
					}
					if ($request->input('set15') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'sumberbiaya'	=> $request->input('set15')
						]);
					}
					if ($request->input('set17') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'fakstudi'	=> $request->input('set17')
						]);
					}
					if ($request->input('set18') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'prodi'	=> $request->input('set18')
						]);
					}
					if ($request->input('set19') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'judul'	=> $request->input('set19')
						]);
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$nama.' Telah Tersimpan Sebagai '.$jenis.' Yang Sedang Studi Lanjut']);
					return back();
				} else {
					if ($idne == 'newpublic'){
						$jabfung 	= $golongan;
						$golongan 	= '';
					} else {
						$jabfung 	= '';
					}
					$ceksudahada = Simpegpegawai::where('nip_baru', $nip)->first();
					if (isset($ceksudahada->id)){
						$idpeg 		= $ceksudahada->id;
						if ($golongan == '' OR is_null($golongan)){
							$golongan = $ceksudahada->golongan;
						}
						if ($jabfung == '' OR is_null($jabfung)){
							$jabfung = $ceksudahada->jab_fungsional;
						}
					} else {
						$inputpeg 	= Simpegpegawai::create([
							'jenispeg'					=> $jenis, 
							'fungsional'				=> 'Dosen', 
							'nik'						=> '', 
							'nokk'						=> '', 
							'nama_lengkap'				=> $nama, 
							'nama'						=> $nama, 
							'nip_lama'					=> '', 
							'nip_baru'					=> $nip, 
							'nidn'						=> '', 
							'jenis_kelamin'				=> '', 
							'tmpt_lahir'				=> '', 
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
							'status_pegawai'			=> 'Dosen', 
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
							'ppabp'						=> $fakultas, 
							'jabatan'					=> '', 
							'proses_pangkat'			=> '', 
							'angka_kredit'				=> '', 
							'email_ub'					=> $email, 
							'lama_tubel'				=> '', 
							'lama_kenaikan_pangkat'		=> '', 
							'tmt_tubel'					=> ''
						]);
						$idpeg		= $inputpeg->id;
					}
					if ($idne == 'new'){
						$inputor 		= Session('fakultas');
						$namainputor 	= Session('nama');
					} else {
						$inputor 		= 'KP';
						$namainputor 	= $nama;
					}
					if ($request->input('set15') !== null){
						$sumberbiaya 	= $request->input('set15');
						if ($sumberbiaya == 'Lain-Lain' AND $request->input('set16') !== null){
							$sumberbiaya = $request->input('set16');
						}
					} else {
						$sumberbiaya	= '';
					}
					if ($nip != ''){
						$input = Bantuanpenerima::create([
							'nama' 				=> $nama,
							'nip'				=> $nip,
							'fakultas'			=> $fakultas,
							'email'				=> $email,
							'hape'				=> $hape,
							'golongan'			=> $golongan,
							'jabfung'			=> $jabfung,
							'jenispeg'			=> $jenis,
							'inputor'			=> $inputor,
							'created_by'		=> $namainputor,
							'negara'			=> $request->input('set11'),
							'namapt'			=> $request->input('set10'),
							'jenjang'			=> $request->input('set09'),
							'mulaistudi'		=> $request->input('set12'),
							'jenis'				=> $request->input('set14'),
							'sumberbiaya'		=> $sumberbiaya,
							'tahunsls'			=> $request->input('set13'),
							'fakstudi'			=> $request->input('set17'),
							'prodi'				=> $request->input('set18'),
							'judul'				=> $request->input('set19'),
							'idpeg'				=> $idpeg,
						]);
						if ($input){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$nama.' Telah Tersimpan Sebagai '.$jenis.' Yang Sedang Studi Lanjut']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Pastikan NAMA, NIP, Jenis Pegawai, Golongan dan Fakultas Telah terisi']);
						return back();
					}
				}
			} else {
				if ($jenis == 'Tabel Pegawai'){
					$getpegawai		= Simpegpegawai::where('id', $idne)->first();
					$nama			= $getpegawai->nama_lengkap;
					$nip			= $getpegawai->nip_baru;
					$golongan		= $getpegawai->golongan;
					$email			= $getpegawai->email_ub;
					$fakultas		= $getpegawai->ppabp;
					$status			= $getpegawai->status_jabatan;
					$hape			= $getpegawai->no_hp;
					$cekpanjang		= User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->count();
					if($cekpanjang != 0){
						$getpanjang = User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
						$fakpanjang = $getpanjang->fakpanjang;
					} else { $fakpanjang = $fakultas; }
					if ($fakpanjang == ''){ $fakpanjang = $fakultas; }
					if ($status != 'Dosen'){ $status = 'Tendik'; }
					$input 			= Bantuanpenerima::create([
						'nama' 				=> $nama,
						'nip'				=> $nip,
						'fakultas'			=> $fakpanjang,
						'email'				=> $email,
						'hape'				=> $hape,
						'golongan'			=> $golongan,
						'jenispeg'			=> $status,
						'inputor'			=> Session('fakultas')
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Penerima Bantuan Telah Terdaftarkan dari Tabel Pegawai']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
						return back();
					}
				} else {
					if ($email != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'email'			=> $email
						]);
					}
					if ($hape != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'hape'			=> $hape
						]);
					}
					if ($golongan != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'golongan'		=> $golongan
						]);
					}
					if ($jenis != ''){
						Bantuanpenerima::where('nip', $nip)->update([
							'jenispeg'		=> $jenis
						]);
					}
					if ($request->input('set09') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'jenjang'		=> $request->input('set09')
						]);
					}
					if ($request->input('set10') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'namapt'		=> $request->input('set10')
						]);
					}
					if ($request->input('set11') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'negara'		=> $request->input('set11')
						]);
					}
					if ($request->input('set12') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'mulaistudi'	=> $request->input('set12')
						]);
					}
					if ($request->input('set13') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'tahunsls'		=> $request->input('set13')
						]);
					}
					if ($request->input('set14') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'jenis'			=> $request->input('set14')
						]);
					}
					if ($request->input('set15') !== null){
						Bantuanpenerima::where('nip', $nip)->update([
							'sumberbiaya'	=> $request->input('set15')
						]);
					}
					$input = Bantuanpenerima::where('nip', $nip)->update([
						'created_by'		=> Session('nama'),
						'updated_at'		=> date("Y-m-d H:i:s")
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Penerima Bantuan Telah Terupdate']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
						return back();
					}
				}
			}
		}
    }
	public function jcekFileupload(Request $request) {
		$arrayaceksyarat= [];
		$idpegawai    	= $request->input('val01');
		$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
		$namapegawai	= $getpegawai->nama;
		$nip			= $getpegawai->nip;
		$ppabp			= $getpegawai->fakultas;
		$cdatane		= Bantuansyarat::where('idpegawai', $idpegawai)->count();
		if ($cdatane != 0){
			$jdatane	= Bantuansyarat::where('idpegawai', $idpegawai)->get();
			foreach ($jdatane as $rdatane) {
				$jenis 		= $rdatane->jenis;
				$namafile 	= $rdatane->namafile;
				$arrayaceksyarat[] = array(
					'idne' 			=> $rdatane->id,
					'idpegawai' 	=> $idpegawai,
					'namapegawai'	=> $namapegawai, 
					'nip'			=> $nip, 
					'ppabp'			=> $ppabp, 
					'jenis'			=> $jenis,
					'email'			=> '',
					'hape'			=> '',
					'emailbody'		=> '',
					'status'		=> '',
					'jenfile'		=> $rdatane->jenfile,
					'namafile'		=> $namafile,
					'keterangan'	=> $rdatane->keterangan,
				);
			}
		}
		$cdatane		= Bantuansyarat::where('idpegawai', $nip)->count();
		if ($cdatane != 0){
			$jdatane	= Bantuansyarat::where('idpegawai', $nip)->get();
			foreach ($jdatane as $rdatane) {
				$jenis 		= $rdatane->jenis;
				$namafile 	= $rdatane->namafile;
				$keterangan = $rdatane->keterangan;
				$status 	= $rdatane->statuskirim;
				$getbiodata	= Simpegpegawai::where('nip_baru', $nip)->first();
				if (isset($getbiodata->id)){
					$email	= $getbiodata->email_ub;
					$hape	= $getbiodata->no_hp;
				} else{
					$email	= '';
					$hape	= '';
				}
				$namafile		= str_replace("viewsurat", 'ttdberkas', $namafile);
					
				$emailbody 	= '
					<p>Yth. '.$namapegawai.'</p>
					<p>&nbsp;</p>
					<p>Dengan hormat kami sampaikan bahwa, pengajuan bantuan studi Bapak/Ibu membutuhkan tandatangan Bapak/Ibu :</p>
					<p>&nbsp;</p>
					<p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p>
					<p>&nbsp;</p>
					<div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$namafile.'" target="_blank">'.$namafile.'</a></div>
					<p>&nbsp;</p>
					<p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>Demikian pemberitahuan ini kami sampaikan. Terima kasih</p>
					<p>[Email ini digenerate secara otomatis, dimohon tidak membalas email ini]</p>';
				$arrayaceksyarat[] = array(
					'idne' 			=> $rdatane->id,
					'idpegawai' 	=> $idpegawai,
					'namapegawai'	=> $namapegawai, 
					'email'			=> $email,
					'hape'			=> $hape,
					'emailbody'		=> $emailbody,
					'status'		=> $status,
					'nip'			=> $nip, 
					'ppabp'			=> $ppabp, 
					'jenis'			=> $jenis,
					'jenfile'		=> $rdatane->jenfile,
					'namafile'		=> $rdatane->namafile,
					'keterangan'	=> $rdatane->keterangan,
				);
			}
		}
    	echo json_encode($arrayaceksyarat);	
    }
	public function uploadSyaratbantuan(Request $request) {
		$idpegawai 	=   $request->input('set01');
		$jenis 		=   $request->input('set02');
		$keterangan =   $request->input('set03');
		$idne 		=   $request->input('set04');
		if ($idpegawai == '' OR $jenis == ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon isi semua form']);
			return back();
		} else {
			if ($keterangan == ''){ $keterangan = '-'; }
			if ($idne == 'new'){
				$jenfile= $request->file->getClientOriginalExtension();
				$file   = time().'.'.$request->file->getClientOriginalExtension();
				$request->file->move(public_path('scan/syarat'), $file);
				$input 	= Bantuansyarat::create([
					'idpegawai' => $idpegawai, 
					'jenis'		=> $jenis, 
					'jenfile'	=> $jenfile,
					'namafile'	=> $file, 
					'keterangan'=> $keterangan
				]);
			}
			else {
				$getsyarat   =   Bantuansyarat::where('id', $idne)->first();
				if (File::exists(base_path()) ."/public/scan/syarat/". $getsyarat->namafile) {
					File::delete(base_path() ."/public/scan/syarat/". $getsyarat->namafile);
				}
				$jenfile= $request->file->getClientOriginalExtension();
				$file   =   time().'.'.$request->file->getClientOriginalExtension();
				$request->file->move(public_path('scan/syarat'), $file);
				$input 	= Bantuansyarat::where('id', $idne)->update([
					'idpegawai' => $idpegawai, 
					'jenis'		=> $jenis,
					'jenfile'	=> $jenfile,
					'namafile'	=> $file, 
					'keterangan'=> $keterangan
				]);
			}
		}
        if ($input){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'File Uploaded']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
			return back();
		}
	}
	public function exhapusdataBantuan(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'set01' =>  'required',
			'set02' =>  'required',
			'set03' =>  'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi']);
			return back();
        } else {
			$idne 		= $request->input('set01');
			$verifikasi = $request->input('set02');
			$tabel 		= $request->input('set03');
			$spesial	= Session('spesial');
		
			if ($tabel == 'arsipdatapnerima'){
				$update = Bantuanpenerima::where('id', $idne)->update([
					'arsip' => $verifikasi
				]);
				if ($update){
					return response()->json(['status' => 'Sukses.!', 'message' => 'Data Penerima Bantuan Di arsipkan']);
					return back();
				}else {
					return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
					return back();
				}
			} else {
				if ($verifikasi != 'SAYA YAKIN'){
					return response()->json(['status' => 'Error.!', 'message' => 'Sepertinya anda kurang yakin']);
					return back();
				}else {
					$nama		= Session('nama');
					$jabatan	= Session('jabatan');
					if ($idne == 'new'){
						return response()->json(['status' => 'Gagal.!', 'message' => 'Tidak Ada Data Untuk di Hapus']);
						return back();
					}else {
						if ($tabel == 'sktarif'){
							$qdislws		= Sktarif::where('id', $idne)->first();
							$deskripsi 		= $qdislws->deskripsi;
							$namafile 		= $qdislws->namafile;
							$kelakuan 		= 'Delete File SK Tarif '.$deskripsi.' Oleh '.$nama.' Jabatan '.$jabatan;
							if ($namafile != ''){
								if (File::exists(base_path()) ."/public/scan/sktarif/". $namafile) {
								  File::delete(base_path() ."/public/scan/sktarif/". $namafile);
								  $busek = Sktarif::where('id', $idne)->delete();
								}
							}else {
								$busek = Sktarif::where('id', $idne)->delete();
							}
							if ($busek){
								Histories::insert([
									'siapa'		=> $nama,
									'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
								]);
								
								return response()->json(['status' => 'Sukses.!', 'message' => 'Data SK Tarif '.$deskripsi.', File Name '.$namafile.' Deleted']);
								return back();
							}else {
								return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
								return back();
							}
						} else if ($tabel == 'bantuanstudi'){
							$qdislws		= Bantuanstudi::where('id', $idne)->first();
							$idpegawai 		= $qdislws->idpegawai;
							$scankhs 		= $qdislws->scankhs;
							$jenis 			= $qdislws->jenis;
							$semester 		= $qdislws->semester;
							$tahun 			= $qdislws->tahun;
							$tanggalterima	= $qdislws->tanggalterima;
							if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
								$tanggalterima = '0000-00-00';
							}
							if (Session('previlage') == 'developer'){
								$tanggalterima = '0000-00-00';
							}
							
							if ($tanggalterima == '0000-00-00'){
								$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
								$namapegawai	= $getpegawai->nama;
								$jenispeg		= $getpegawai->nip;
								$kelakuan 		= 'Delete Data Bantuan '.$jenis.' '.$namapegawai.' Semester '.$semester.' Tahun '.$tahun.' Oleh '.$nama.' Jabatan '.$jabatan;
								if ($scankhs != ''){
									if (File::exists(base_path()) ."/public/scan/bantuan/". $scankhs) {
										File::delete(base_path() ."/public/scan/bantuan/". $scankhs);
										$getalljenis	= Bantuanstudi::where('scankhs', $scankhs)->get();
										foreach ($getalljenis as $rjenis) {
											$iddel 		= $rjenis->id;
											$busek 		= Bantuanstudi::where('id', $iddel)->delete();
										}
									}
								}else {
									$busek = Bantuanstudi::where('id', $idne)->delete();
								}
								if ($busek){
									Histories::insert([
										'siapa'		=> $nama,
										'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
									]);
									return response()->json(['status' => 'Sukses.!', 'message' => 'Delete Data Bantuan '.$jenis.' '.$namapegawai.' Semester '.$semester.' Tahun '.$tahun.' Oleh '.$nama.' Jabatan '.$jabatan]);
									return back();
								}else {
									return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
									return back();
								}
							}else {
								return response()->json(['status' => 'Gagal.!', 'message' => 'Data Yang Memiliki Tanggal Terima Uang Tidak Dapat di Hapus']);
								return back();
							}
						} else if ($tabel == 'penerima'){
							$qdislws	= Bantuanpenerima::where('id', $idne)->first();
							$nama 		= $qdislws->nama;
							$nip 		= $qdislws->nip;
							$fakultas	= $qdislws->fakultas;
							$cstudi		= Bantuanstudi::where('idpegawai', $idne)->count();
							if ($cstudi != 0){
								return response()->json(['status' => 'Gagal.!', 'message' => 'Data bantuan studi ybs harus di hapus terlebih dahulu']);
								return back();
							} else {
								$ceksyarat	= Bantuansyarat::where('idpegawai', $idne)->whereNotNull('namafile')->count();
								if ($ceksyarat != 0){
									$getsyarat	= Bantuansyarat::where('idpegawai', $idne)->whereNotNull('namafile')->get();
									foreach ($cdatane as $rdatane) {
										$idfile 	= $rdatane->id;
										$namafile 	= $rdatane->namafile;
										if (File::exists(base_path()) ."/public/scan/syarat/". $namafile) {
											File::delete(base_path() ."/public/scan/syarat/". $namafile);
											Bantuansyarat::where('id', $idfile)->delete();
										}
									}
								}
								$delete 	= Bantuanpenerima::where('id', $idne)->delete();
								$kelakuan 	= 'Delete Data Penerima Bantuan an. '.$nama.' NIP '.$nip.' Fakultas '.$fakultas.' Oleh '.$nama.' Jabatan '.$jabatan;
								if ($delete){
									Histories::insert([
										'siapa'		=> $nama,
										'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
									]);
									return response()->json(['status' => 'Sukses.!', 'message' => $kelakuan]);
									return back();
								}else {
									return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
									return back();
								}
							}
						} else if ($tabel == 'filesyarat'){
							$qdislws		= Bantuansyarat::where('id', $idne)->first();
							$namafile 		= $qdislws->namafile;
							$jenis 			= $qdislws->jenis;
							$idpegawai		= $qdislws->idpegawai;
							$getpegawai		= Bantuanpenerima::where('id', $idpegawai)->first();
							if (isset($getpegawai->nama)){
								$namapegawai	= $getpegawai->nama;
								$jenispeg		= $getpegawai->nip;
							} else {
								$namapegawai= $idpegawai;
								$jenispeg	= '';
							}
							$kelakuan 		= 'Delete Data File Syarat '.$jenis.' '.$namapegawai;
							if ($namafile != ''){
								if (File::exists(base_path()) ."/public/scan/syarat/". $namafile) {
								  File::delete(base_path() ."/public/scan/syarat/". $namafile);
								  $busek = Bantuansyarat::where('id', $idne)->delete();
								}
							}else {
								$busek = Bantuansyarat::where('id', $idne)->delete();
							}
							if ($busek){
								Histories::insert([
									'siapa'		=> $nama,
									'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
								]);
								$getarrsurat= explode("/viewsurat/",$namafile);
								if (isset($getarrsurat[1])){
									$getidsurat = explode('-', $getarrsurat[1]);
									if (isset($getidsurat[1])){
										$getsurat = Suratkeluar::where('id', $getidsurat[1])->first();
										if (isset($getsurat->id)){
											$marking 	= $getsurat->marking;
											$perihal 	= $getsurat->perihal;
											$nomor 		= $getsurat->nomor;
											$nomorlanjut= $nomor + 1;
											if ($perihal == 'SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR' OR $perihal == 'PERPANJANGAN SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR' OR $perihal =='SURAT KETERANGAN JAMINAN PEMBIAYAAN STUDI'){
												if (File::exists(base_path()) ."/public/scan/files/". $marking.'.pdf') {
													File::delete(base_path() ."/public/scan/files/". $marking.'.pdf');
												}
												if (File::exists(base_path()) ."/public/scan/asli/". $marking.'.pdf') {
													File::delete(base_path() ."/public/scan/asli/". $marking.'.pdf');
												}
												if (File::exists(base_path()) ."/public/scan/generate/". $marking.'.png') {
													File::delete(base_path() ."/public/scan/generate/". $marking.'.png');
												}
												$ceksek = Suratkeluar::where('fakultas', $getsurat->fakultas)->where('nomor', $nomorlanjut)->where('yersrt', $getsurat->yersrt)->count();
												if ($ceksek == 0){
													Suratkeluar::where('id', $getsurat->id)->delete();
												} else {
													Suratkeluar::where('id', $getsurat->id)->update([
														'jenissrt' 		=>  'UPLOAD',
														'perihal'		=> 'Slot Nomor Mundur',
														'paraf1'		=> '',
														'paraf2'		=> '',
														'paraf3'		=> '',
														'paraf4'		=> '',
														'tandatangan'	=> '',
														'status'		=> 'NEW',
														'filelampiran'	=> '',
														'isisurat'		=> '',
														'dasarsurat'	=> ''
													]);
												}
												Inboxsurat::where('marking', $marking)->where('jenis', 'KELUAR')->delete();
											}
										}
									}
								}
								return response()->json(['status' => 'Sukses.!', 'message' => $kelakuan]);
								return back();
							}else {
								return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
								return back();
							}
							
						} else if ($tabel == 'bantuanriset'){
							$qdislws		= Bantuanriset::where('id', $idne)->first();
							$idpegawai 		= $qdislws->idpegawai;
							$jenis 			= $qdislws->jenis;
							$judul 			= $qdislws->judul;
							$tahun 			= $qdislws->tahun;
							$buktidukung 	= $qdislws->scantandaterima;
							$tanggalterima	= $qdislws->tanggalterima;
							if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
								$tanggalterima = '0000-00-00';
							}
							if (Session('previlage') == 'developer'){
								$tanggalterima = '0000-00-00';
							}
							if ($tanggalterima == '0000-00-00'){
								$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
								$namapegawai	= $getpegawai->nama_lengkap;
								$jenispeg		= $getpegawai->nip_baru;
								$kelakuan 		= 'Delete Data Bantuan RISET dan PKM '.$jenis.' '.$namapegawai.' Judul '.$judul.' Tahun '.$tahun.' Oleh '.$nama.' Jabatan '.$jabatan;
								if ($buktidukung != ''){
									if (File::exists(base_path()) ."/public/scan/publikasi/". $buktidukung) {
									  File::delete(base_path() ."/public/scan/publikasi/". $buktidukung);
									  $busek = Bantuanriset::where('id', $idne)->delete();
									}
								}else {
									$busek = Bantuanriset::where('id', $idne)->delete();
								}
								if ($busek){
									Histories::insert([
										'siapa'		=> $nama,
										'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
									]);
									return response()->json(['status' => 'Sukses.!', 'message' => $kelakuan.' Berhasil di Lakukan']);
									return back();
								}else {
									return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
									return back();
								}
							}else {
								return response()->json(['status' => 'Gagal.!', 'message' => 'Data Yang Memiliki Tanggal Terima Uang Tidak Dapat di Hapus']);
								return back();
							}
						} else {
							$qdislws		= Bantuanpublikasi::where('id', $idne)->first();
							$idpegawai 		= $qdislws->idpegawai;
							$buktidukung	= $qdislws->scanloa;
							$jenis 			= $qdislws->jenis;
							$judul 			= $qdislws->judul;
							$tahun 			= $qdislws->tahun;
							$tanggalterima	= $qdislws->tanggalterima;
							if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
								$tanggalterima = '0000-00-00';
							}
							if (Session('previlage') == 'developer'){
								$tanggalterima = '0000-00-00';
							}
							
							if ($tanggalterima == '0000-00-00'){
								$getpegawai		= Simpegpegawai::where('id', $idpegawai)->first();
								$namapegawai	= $getpegawai->nama_lengkap;
								$jenispeg		= $getpegawai->nip_baru;
								$kelakuan 		= 'Delete Data Bantuan '.$jenis.' '.$namapegawai.' Judul '.$judul.' Tahun '.$tahun.' Oleh '.$nama.' Jabatan '.$jabatan;
								if ($buktidukung != ''){
									if (File::exists(base_path()) ."/public/scan/publikasi/". $buktidukung) {
									  File::delete(base_path() ."/public/scan/publikasi/". $buktidukung);
									  $busek = Bantuanpublikasi::where('id', $idne)->delete();
									}
								}else {
									$busek = Bantuanpublikasi::where('id', $idne)->delete();
								}
								if ($busek){
									Histories::insert([
										'siapa'		=> $nama,
										'kelakuan'	=> Session('fakultas').'=>'.$kelakuan
									]);
									return response()->json(['status' => 'Sukses.!', 'message' => 'Delete Data Bantuan '.$jenis.' '.$namapegawai.' SJudul '.$judul.' Tahun '.$tahun.' Oleh '.$nama.' Jabatan '.$jabatan]);
									return back();
								}else {
									return response()->json(['status' => 'Gagal.!', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
									return back();
								}
							}else {
								return response()->json(['status' => 'Gagal.!', 'message' => 'Data Yang Memiliki Tanggal Terima Uang Tidak Dapat di Hapus']);
								return back();
							}
						}
					}
				}
			}
        }
    }
	public function exUploadPublikasi(Request $request) {
    	if ($request->hasFile('upload_file')) {
    		$path 			= $_FILES['upload_file']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				$namalengkap	= $val['B'];
				$jenispeg		= $val['C'];
				$nip			= $val['D'];
				$kelamin		= $val['E'];
				$golongan		= $val['F'];
				$fungsional		= $val['G'];
				$ppabp			= $val['H'];
				$jurusan		= $val['I'];
				$prodi			= $val['J'];
				$namajurnal		= $val['K'];
				$judul			= $val['L'];
				$tahunterbit	= $val['M'];
				$issn			= $val['N'];
				$indeks			= $val['O'];
				$sjr			= $val['P'];
				$status			= $val['Q'];
				$bidangilmu		= $val['R'];
				$biaya			= $val['S'];
				$rekomendasi	= $val['T'];
				$pajak			= $val['U'];
				$nominal		= $val['V'];
				$keterangan		= $val['W'];
				//$namafile 	= $ppabp.'-PUBLIKASI'.$kategori.'-'.$tahun.$idpegawai;
				if ($ppabp != 'Fakultas'){
					$cekpegawai		= Simpegpegawai::where('nip_baru', $nip)->first();
					if (isset($cekpegawai->id)){
						$idpegawai	= $cekpegawai->id;
						Simpegpegawai::where('nip_baru', $nip)->update([
							'nama_lengkap'				=> $namalengkap, 
							'jenis_kelamin'				=> $kelamin, 
							'golongan'					=> $golongan, 
							'jab_fungsional'			=> $fungsional, 
							'lab'						=> $jurusan, 
							'bidang_ilmu'				=> $bidangilmu, 
							'program_studi'				=> $prodi, 
						]);
					} else {
						$idpegawai = Simpegpegawai::insertGetId([
							'idpeg'						=> '',
							'jenispeg'					=> $jenispeg, 
							'fungsional'				=> 'Dosen', 
							'nik'						=> '', 
							'nokk'						=> '', 
							'nama_lengkap'				=> $namalengkap, 
							'nama'						=> $namalengkap, 
							'nip_lama'					=> '', 
							'nip_baru'					=> $nip, 
							'nidn'						=> '', 
							'jenis_kelamin'				=> $kelamin, 
							'tmpt_lahir'				=> '', 
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
							'keterangan'				=> 'Created from SCO', 
							'tmt_golongan'				=> '', 
							'jab_fungsional'			=> $fungsional, 
							'tmt_fungsional'			=> '', 
							'tmt_pensiun'				=> '', 
							'thn_pensiun'				=> '', 
							'tmt_cpns'					=> '', 
							'tmt_pns'					=> '', 
							'thn_masuk'					=> '', 
							'unit_kerja'				=> $jurusan, 
							'bidang_ilmu'				=> $bidangilmu, 
							'lab'						=> $jurusan, 
							'program_studi'				=> $prodi, 
							'sertifikasi'				=> '', 
							'pend_akhir'				=> '', 
							'ijasah_diakui'				=> '', 
							'status_pegawai'			=> 'Aktif', 
							'masa_kerja'				=> '', 
							'pns'						=> $jenispeg, 
							'status_jabatan'			=> 'Dosen', 
							'karpeg'					=> '', 
							'agama'						=> '', 
							'alamat'					=> '', 
							'no_hp'						=> '', 
							'kode'						=> '', 
							'foto'						=> '', 
							'tmtgaji'					=> '', 
							'tmtpangkat'				=> '', 
							'ppabp'						=> $ppabp, 
							'jabatan'					=> '', 
							'proses_pangkat'			=> '', 
							'angka_kredit'				=> '', 
							'email_ub'					=> '', 
							'lama_tubel'				=> '', 
							'lama_kenaikan_pangkat'		=> '', 
							'tmt_tubel'					=> ''
						]);
					}
					$cek 		= Bantuanpublikasi::where('idpegawai', $idpegawai)->where('judul', $judul)->count();
					if ($cek == 0){
						$input 		= Bantuanpublikasi::create([
							'idpegawai'			=> $idpegawai, 
							'ppabp'				=> $ppabp, 
							'namajurnal'		=> $namajurnal, 
							'jenis'				=> 'Publikasi Ilmiah', 
							'kategori'			=> '301124', 
							'judul'				=> $judul, 
							'issn'				=> $issn, 
							'laman'				=> '', 
							'voljurnal'			=> '', 
							'halaman'			=> '1', 
							'jurusan'			=> $jurusan, 
							'prodi'				=> $prodi, 
							'bidangilmu'		=> $bidangilmu, 
							'sjr'				=> $sjr, 
							'indeks'			=> $indeks, 
							'status'			=> $status, 
							'nominal'			=> $nominal, 
							'biaya'				=> $biaya, 
							'rekomendasi'		=> $rekomendasi, 
							'pajak'				=> $pajak, 
							'diterima'			=> $nominal, 
							'tahun'				=> $tahunterbit, 
							'scanloa'			=> '', 
							'sktarif'			=> '', 
							'scantandaterima'	=> '', 
							'tanggalterima'		=> '',
							'inputor'			=> Session('fakultas')
						]);
						if($input){
							$sukses++;
						} else {
							$error = $error.' Gagal Tambah Data an. '.$namalengkap.' dari '.$ppabp.' Gagal di Inputkan Karena Kesalah Sistem<br />';
						}
					} else {
						$error = $error.' Gagal Tambah Data an. '.$namalengkap.' dari '.$ppabp.' Sudah Ada dan Tidak Berubah<br />';
					}
				}
			}
			
			Session::flash('status', 'Success');
            Session::flash('message', 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$error); 
            Session::flash('alert-class', 'alert-success');
			return back();
    	} else {
    		Session::flash('status', 'Error');
            Session::flash('message', 'Harap masukkan file terlebih dahulu'); 
            Session::flash('alert-class', 'alert-danger');

            return back();
    	}
    }
	public function statjenispegawai() {
		$arrjenispeg 	= [];
		$alldata		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->count();
		$getallpeg		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->groupBy('jenispeg')->get();
		foreach($getallpeg as $rpegawai){
			$jenispeg 		= $rpegawai->jenispeg;
			$prosentase		= 0;
			$jumlah 		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->where('jenispeg', $jenispeg)->count();
			$prosentase 	= ($jumlah / $alldata)*100;
			if (is_null($jenispeg) OR $jenispeg == ''){
				$jenispeg	= 'Unkown';
			}
			$arrjenispeg[] 	= array(
				'jenispeg' 	=> $jenispeg.' Sejumlah '.$jumlah.' Pegawai',
				'jumlah' 	=> $prosentase,
			);
		}
		echo json_encode($arrjenispeg);
	}
	public function statpendidikan() {
		$arrjenisgol 	= [];
		$alldata		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->count();
		$getallpeg		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->groupBy('jenjang')->get();
		foreach($getallpeg as $rpegawai){
			$jenjang 		= $rpegawai->jenjang;
			$prosentase		= 0;
			$jumlah 		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->where('jenjang', $jenjang)->count();
			$prosentase 	= ($jumlah / $alldata)*100;
			if (is_null($jenjang) OR $jenjang == ''){
				$jenjang	= 'Unkown';
			}
			if (Session('idjabatan') == '3'){
				if ($jenjang == 'Sp (Spesialis)'){
					$jenjang = 'Sp 1 (Spesialis 1)';
				}
				if ($jenjang == 'Sp1 (Spesialis)'){
					$jenjang = 'Sp 1 (Spesialis 1)';
				}
				if ($jenjang == 'Sp2 (Subspesialis)'){
					$jenjang = 'Sp 2 (Spesialis 2)';
				}
			}
			
			$arrjenisgol[] 	= array(
				'pendidikan' 	=> $jenjang.' Sejumlah '.$jumlah.' Pegawai',
				'jumlah' 		=> $prosentase,
			);
		}
		echo json_encode($arrjenisgol);
	}
	public function statgolongan() {
		$arrjenisgol	= [];
		$alldata		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->count();
		$getallpeg		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->groupBy('sumberbiaya')->get();
		$persen			= 0;
		foreach($getallpeg as $rpegawai){
			$sumberbiaya 	= $rpegawai->sumberbiaya;
			$prosentase		= 0;
			$jumlah 		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->where('sumberbiaya', $sumberbiaya)->count();
			$prosentase 	= ($jumlah / $alldata)*100;
			$persen			= $persen + $prosentase;
			if (is_null($sumberbiaya) OR $sumberbiaya == ''){
				$sumberbiaya= 'Unkown';
			}
			$arrjenisgol[] 	= array(
				'jenisgolongan' 	=> $sumberbiaya,
				'jumlah' 			=> $jumlah,
				'prosentase' 		=> $prosentase,
			);
		}
		echo json_encode($arrjenisgol);
	}
	public function statnegara() {
		$arrjenisgol	= [];
		$alldata		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->count();
		$getallpeg		= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->groupBy('negara')->get();
		$persen			= 0;
		foreach($getallpeg as $rpegawai){
			$negara 	= $rpegawai->negara;
			$prosentase	= 0;
			$jumlah 	= Bantuanpenerima::whereNull('arsip')->whereNotNull('jenis')->where('negara', $negara)->count();
			$prosentase = ($jumlah / $alldata)*100;
			$persen		= $persen + $prosentase;
			if (is_null($negara) OR $negara == ''){
				$negara= 'Unkown';
			}
			$arrjenisgol[] 	= array(
				'jenisgolongan' 	=> $negara,
				'jumlah' 			=> $jumlah,
				'prosentase' 		=> $prosentase,
			);
		}
		echo json_encode($arrjenisgol);
	}
	public function statrekaptahunan() {
		$arrjenisgol	= [];
		$tahunini 		= date("Y");
		$tahunini		= $tahunini + 1;
		$tahunhitung	= $tahunini - 5;
		while ($tahunhitung != $tahunini){
			$jumlahtotal		= 0;
			$jumlahtendik		= 0;
			$jumlahdosendalam	= 0;
			$jumlahdosenluar	= 0;
			$jjumlahthnini 		= Bantuanstudi::where('inputor', Session('fakultas'))->where('created_at', 'LIKE', $tahunhitung.'%')->get();
			if (!empty($jjumlahthnini)){
				foreach ($jjumlahthnini as $rows){
					$jumlahtotal = $jumlahtotal + $rows->nominal;
					$idpeg 		= $rows->idpegawai;
					$getuser 	= Bantuanpenerima::where('id', $idpeg)->first();
					if (isset($getuser->jenispeg)){
						if ($getuser->jenispeg == 'Tendik'){
							$jumlahtendik = $jumlahtendik + $rows->nominal;
						} else {
							if ($getuser->negara == 'Indonesia'){
								$jumlahdosendalam = $jumlahdosendalam + $rows->nominal;
							} else {
								$jumlahdosenluar 	= $jumlahdosenluar + $rows->nominal;
							}
						}
					}
				}
			}
			$tlsjumlahtotal			= 'Total Bantuan Tahun '.$tahunhitung.' : '.number_format( $jumlahtotal, 0 , '.' , ',' );
			$tlsjumlahtendik		= 'Total Bantuan Tendik Tahun '.$tahunhitung.' : '.number_format( $jumlahtendik, 0 , '.' , ',' );
			$tlsjumlahdosendalam	= 'Total Bantuan Dosen Tubel Dalam Negeri Tahun '.$tahunhitung.' : '.number_format( $jumlahdosendalam, 0 , '.' , ',' );
			$tlsjumlahdosenluar		= 'Total Bantuan Dosen Tubel Luar Negeri Tahun '.$tahunhitung.' : '.number_format( $jumlahdosenluar, 0 , '.' , ',' );
			
			$arrjenisgol[] 	= array(
				'tahun' 				=> $tahunhitung,
				'tendik' 				=> $jumlahtendik,
				'dosendalamnegeri' 		=> $jumlahdosendalam,
				'dosenluarnegeri' 		=> $jumlahdosenluar,
				'jumlahtotal' 			=> $jumlahtotal,
				'tlstendik' 			=> $tlsjumlahtendik,
				'tlsdosendalamnegeri' 	=> $tlsjumlahdosendalam,
				'tlsdosenluarnegeri' 	=> $tlsjumlahdosenluar,
				'tlsjumlahtotal' 		=> $tlsjumlahtotal,
			);
			$tahunhitung++;
		}
		echo json_encode($arrjenisgol);
	}
	public function exSuratbantuan(Request $request) {
    	$faskode			= 'KP.06.00.4';
		$idpejabat 			= 3;
		$idkabirokeua		= 8;
		$idkabirosdm		= 970;
		$unit				= 'KP';
		$fakultas			= 'KP';
		$homebase			= url("/");
		$swandhanafak       = config('global.swandhanafak');
		$swandhanaalamat    = config('global.swandhanaalamat');
		$swandhanakemen     = config('global.swandhanakemen');
		$swandhanauniv      = config('global.swandhanauniv');
		$swandhanatelpon    = config('global.swandhanatelpon');
		$swandhanaemail		= config('global.swandhanaemail');
		$swandhanakota		= config('global.swandhanakota');
		$kemenbesar			= strtoupper($swandhanakemen);
		$univbesar			= strtoupper($swandhanauniv);
		$fakpanjang			= Session('fakpanjang');
		function Terbilang($x)
		{
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
		$kalender 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$rnamapjbt			= Pejabatsurat::where('id', $idpejabat)->first();
		$pejabat 			= $rnamapjbt->pejabat;
		$namapjbt 			= $rnamapjbt->nama;
		$nippjbt 			= $rnamapjbt->nip;
		$kodefakultas 		= $rnamapjbt->kode;
		$jenisnip 			= $rnamapjbt->jenis;
		$pangkat 			= $rnamapjbt->pangkat;
		$golongan 			= $rnamapjbt->golongan;
		$pangkatpejabat 	= $pangkat.', '.$golongan;
		$setttd 			= $namapjbt.'<br />NIP '.$nippjbt;
		$kabirokeuangan		= 'Direktur Direktorat Anggaran';
		$kabirosdm			= 'Direktur Direktorat SDM';
		$rnamapjbt			= Pejabatsurat::where('id', $idkabirokeua)->first();
		if (isset($rnamapjbt->pejabat)){
			$kabirokeuangan 	= $rnamapjbt->pejabat;
		}
		$rnamapjbt			= Pejabatsurat::where('id', $idkabirosdm)->first();
		if (isset($rnamapjbt->pejabat)){
			$kabirosdm 		= $rnamapjbt->pejabat;
		}
		
		$getkode			= Golongan::where('pangkat', 'LIKE', $pangkat)->first();
		if (isset($getkode->id)){
			$golongan		= $getkode->golongan;
			$pangkat		= $getkode->pangkat;
			$pangkatpejabat = $pangkat.', '.$golongan;
		} else {
			$getkode		= Golongan::where('kode', $golongan)->first();
			if (isset($getkode->id)){
				$golongan		= $getkode->golongan;
				$pangkat		= $getkode->pangkat;
				$pangkatpejabat = $pangkat.', '.$golongan;
			}	
		}
		$setttd 		= $namapjbt.'<br />NIP. '.$nippjbt;
		$getnama 		= Simpegpegawai::where('nip_baru', $nippjbt)->first();
		if (isset($getnama->nama)){
			$namasaja		= $getnama->nama;
			$emailpejabat	= $getnama->email_ub;
		} else { $namasaja = $namapjbt; $emailpejabat = $nippjbt.'@ub.ac.id'; }
		$jenispeg		= 'Tendik';
		$fontstyle		= 'style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"';
		$jenisfontte	= '<font size="7" color="blue">';
		$tgl 			= date("d");
		$bln 			= date("m");
		$thn 			= date("Y");
		$tlsbln			= (int)date("m");
		$tlsbln			= $kalender[$tlsbln];
		$tglsurat		= $tgl.' '.$tlsbln.' '.$thn;
		$idne 			= $request->input('set01');
		$nama 			= $request->input('set02');
		$nip 			= $request->input('set03');
		$jabpenerima 	= $request->input('set04');
		$jenis 			= $request->input('set05');
		$pertor 		= $request->input('set06');
		$val14 			= $request->input('set14');
		$prodi 			= $request->input('set15');
		$fakstudi 		= $request->input('set16');
		$negara 		= $request->input('set17');
		$namapt 		= $request->input('set18');
		$sumberbiaya 	= $request->input('set19');
		$kdgol 			= $request->input('set20');
		$jenispeg 		= $request->input('set21');
		$fakpenerima 	= $request->input('set22');
		Bantuanpenerima::where('id', $idne)->update([
			'golongan'		=> $kdgol,
			'fakultas'		=> $fakpenerima,
			'jenispeg'		=> $jenispeg,
			'negara'		=> $negara,
			'namapt'		=> $namapt,
			'fakstudi'		=> $fakstudi,
			'prodi'			=> $prodi,
			'sumberbiaya'	=> $sumberbiaya,
			'jabfung'		=> $jabpenerima,
		]);
		if ($negara == 'Indonesia'){
			$ikatandinas = '1n+1';
		} else {
			$ikatandinas = '2n+1';
		}
		$getpegawai		= Bantuanpenerima::where('id', $idne)->first();
		if (isset($getpegawai->id)){
			$penerima	= $getpegawai->nama;
			$nippenerima= $getpegawai->nip;
			$jenjang	= $getpegawai->jenjang;
			$getkodegol	= Golongan::where('kode', $kdgol)->first();
			if (isset($getkodegol->id)){
				$golongan	= $getkodegol->golongan;
				$pangkat	= $getkodegol->pangkat;
				$kdgol 		= $pangkat.', '.$golongan;
			}
			if ($jenispeg == 'Tendik'){
				$paraf1 = 65;
			} else {
				$paraf1 = 61;
			}
			$paraf1		= 973; //buatcontoh
			$paraf2 	= 11;
			$paraf3 	= 970;
			$getnomorsk	= Sktarif::where('id', $pertor)->first();
			if (isset($getnomorsk->id)){
				$sknomor	= $getnomorsk->nomor;
				$sktahun	= $getnomorsk->tahun;
			} else {
				$sknomor	= $pertor;
				$sktahun 	= '';
			}
			if ($sknomor == '11'){
				$pasalkhs = 'Pasal 23 ayat 2';
			} else {
				$pasalkhs = 'Pasal 23 ayat 3';
			}
			$cekmarking	= Suratkeluar::orderBy('id', 'DESC')->first();
			if (isset($cekmarking->id)){
				$lastid		= $cekmarking->id;
				$nomarking 	= $lastid+1;
				$marking 	= $fakultas.'-OUT-'.$thn.$nomarking;
			} else {
				$nomarking 	= 1;
				$marking 	= $fakultas.'-OUT-'.$thn.$nomarking;
			}
			$ceknomorsrt	= Suratkeluar::where('yersrt', $thn)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->count();
			if ($ceknomorsrt == 0){
				$nomor 		= 1;
			} else {
				$ceknomorsrt= Suratkeluar::where('yersrt', $thn)->orderBy('nomor', 'DESC')->where('fakultas', $fakultas)->first();
				$lastno		= $ceknomorsrt->nomor;
				$nomor 		= $lastno+1;
			}
			$alamatweb		= $homebase.'/downloaddocbyname/'.$marking.'.pdf';
			$qrcode 		= QrCode::format('png')->merge('https://sco.ub.ac.id/logo-ub.png', 0.1, true)->size(150)->generate($alamatweb);
			$output_file 	= 'scan/generate/qrimg-'. $marking.'.png';
			Storage::disk('local')->put($output_file, $qrcode);
			$jamtte			= date("H:m");
			$lebarttd 		= '50%';
			
			if (file_exists(public_path('images/kopsurat/'.$fakultas.'.png'))){
				$kopsurat		= 	'<img src="'.$homebase.'/images/kopsurat/'.$fakultas.'.png" width="720" />';
			} else {
				$kopsurat   	= 	'
				<table width="720" cellpadding="0" cellspacing="0" border="0"  style="font-family: "Times New Roman", Times, serif;">
					<col width="20" />
					<col width="70" />
					<col width="19" />
					<col width="354" />
					<col width="40" />
					<col width="88" />
					<col width="40" />
					<col width="89" />
					<tr>
						<td colspan="2" rowspan="5" align="center" valign="top"><img src="'.$homebase.'/logo-ub.png" alt="" width="100" /></td>
						<td colspan="6" align="center" style="font-family: "Times New Roman", Times, serif;"><font size="18px">'.$swandhanakemen.'</font></td>
					</tr>
					<tr>
						<td colspan="6" align="center" style="font-family: "Times New Roman", Times, serif;"  height="50">'.$univbesar.'</td>
					</tr>
					<tr>
						<td colspan="6" align="center" valign="midlle" style="font-family: "Times New Roman", Times, serif;">'.$swandhanaalamat.'</td>
					</tr>
					<tr>
						<td colspan="6" align="center" valign="midlle" style="font-family: "Times New Roman", Times, serif;">'.$swandhanatelpon.'</td>
					</tr>
					<tr>
						<td colspan="6" align="center" valign="midlle" style="font-family: "Times New Roman", Times, serif;">'.$swandhanaemail.'</td>
					</tr>
					<tr>
						<td colspan="8" align="center" valign="top" style="border-bottom: 1px double black;">&nbsp;</td>
					</tr>
				</table>';	
			}
			$tulisnomor = $nomor.'/'.$kodefakultas.'/'.$faskode.'/'.$thn;
			$tembusan 	= '';
			if ($val14 == 'DRAFTSURAT1'){
				$mulai 			= $request->input('set07');
				$tahun1 		= $request->input('set08');
				$akhir 			= $request->input('set09');
				$tahun2 		= $request->input('set10');
				$konversi 		= $request->input('set11');
				$val12 			= $request->input('set12');
				$val13 			= $request->input('set13');
				$val23 			= $request->input('set23');
				$input 			= Bantuanpenerima::where('id', $idne)->update([
					'startsmt'		=> $val12,
					'startgangen'	=> $mulai,
					'startthnakad'	=> $tahun1,
					'endsmt'		=> $val13,
					'endgangen'		=> $akhir,
					'endthnakad'	=> $tahun2,
					'jenjang'		=> $val23,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($input){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft Tersimpan']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Drafting Surat Gagal dilakukan, Silahkan Hubungi Tim IT Anda']);
					return back();
				}
			} else if ($val14 == 'DRAFTSURAT2'){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft Tersimpan']);
				return back();
			} else {
				if ($val14 == 'SKJPS' OR $val14 == 'SKJPSPERPANJANGAN'){
					$tulisttd = '
								<table width="300" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'> 
									<tr><td colspan="2" align="left">Malang, '.$tglsurat.'<br />Yang membuat pernyataan<br />'.$pejabat.',</td></tr>
									<tr>
										<td width="100"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="80" /></td>
										<td width="150" align="left" valign="center">
											'.$jenisfontte.'
												&nbsp;<br />TTE oleh :<br />
												<strong>'.$namasaja.'</strong><br />
												'.$tglsurat.' '.$jamtte.'<br /><br />
												Verifikasi melalui<br /> https://sco.ub.ac.id
											</font>
										</td>
									</tr>
									<tr><td colspan="2" align="left">'.$setttd.'</td></tr>
								</table>';
					$mulai 			= $request->input('set07');
					$tahun1 		= $request->input('set08');
					$akhir 			= $request->input('set09');
					$tahun2 		= $request->input('set10');
					$konversi 		= $request->input('set11');
					$val12 			= $request->input('set12');
					$val13 			= $request->input('set13');
					$val23 			= $request->input('set23');
					$terbilangkvr	= Terbilang($konversi);
					Bantuanpenerima::where('id', $idne)->update([
						'startsmt'		=> $val12,
						'startgangen'	=> $mulai,
						'startthnakad'	=> $tahun1,
						'endsmt'		=> $val13,
						'endgangen'		=> $akhir,
						'endthnakad'	=> $tahun2,
						'jenjang'		=> $val23,
					]);
					if ($val14 == 'SKJPSPERPANJANGAN'){
						$perihal		= 'SURAT JAMINAN PEMBIAYAAN PERPANJANGAN MASA STUDI';
					} else {
						$perihal		= 'SURAT KETERANGAN JAMINAN PEMBIAYAAN STUDI';
					}
					if ($fakpenerima == 'KP' OR $fakpenerima == 'Kantor Pusat'){
						$tembusan	= 'Tembusan yth :<br />
						1. Rektor<br />
						2. Wakil Rektor Bidang Akademik <br />
						3. '.$kabirokeuangan.'<br />
						4. '.$kabirosdm;
						$unitpenempatan = '<tr style="text-align: justify">
												<td>&nbsp;</td>
												<td align="left" valign="top">Unit Kerja</td>
												<td valign="top">:</td>
												<td colspan="2" valign="top">Kantor Pusat</td>
											</tr>';
					} else {
						$tembusan	= 'Tembusan yth :<br />
						1. Rektor<br />
						2. Wakil Rektor Bidang Akademik <br />
						3. Dekan '.$fakpenerima.'<br />
						4. '.$kabirokeuangan.'<br />
						5. '.$kabirosdm;
						$unitpenempatan = '<tr style="text-align: justify">
												<td>&nbsp;</td>
												<td align="left" valign="top">Unit Kerja</td>
												<td valign="top">:</td>
												<td colspan="2" valign="top">'.$getpegawai->fakultas.'</td>
											</tr>';
					}
					$ceknomor = Suratkeluar::where('perihal', $perihal)->where('isisurat', 'LIKE', '%'.$nippenerima.'%')->first();
					if (isset($ceknomor->nomor)){
						$tulisnomor = $ceknomor->nomor.'/'.$ceknomor->kodefak.'/'.$ceknomor->faskode.'/'.$ceknomor->yersrt;
						$marking 	= $ceknomor->marking;
					}
					$isi_surat 	= 	'<table width="720" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
										<tr><th width="20" scope="col">&nbsp;</th><th width="120" scope="col">&nbsp;</th><th width="10" scope="col">&nbsp;</th><th width="220" scope="col">&nbsp;</th><th width="300" scope="col"></th></tr>
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
											<td scope="row">&nbsp;</td>
											<td colspan="4" style="text-align: center;">
												<font style="font-size:18px">'.$perihal.'</font><br />
												Nomor : '.$tulisnomor.'
											</td>
										</tr>
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
											<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="4">Yang bertandatangan dibawah ini :</td>
										</tr>
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
											<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">nama</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$namapjbt.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">NIP</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$nippjbt.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">pangkat dan golongan</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$pangkatpejabat.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">jabatan</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$pejabat.'</td>
										</tr>
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="4">dengan ini menerangkan bahwa :</td>
										</tr>
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
											<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">nama</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$penerima.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">NIP</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$nippenerima.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">pangkat dan golongan</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$kdgol.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td align="left" valign="top">jabatan</td>
											<td valign="top">:</td>
											<td colspan="2" valign="top">'.$jabpenerima.'</td>
										</tr>
										'.$unitpenempatan.'
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="4">diberikan jaminan pembiayaan selama menempuh pendidikan Program '.$jenjang.' Bidang '.$prodi.' di '.$namapt.', sesuai dengan Peraturan Rektor Nomor '.$sknomor.' Tahun '.$sktahun.' tentang Tugas Belajar dan Izin Belajar.</td>
										</tr>
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="4">Biaya Tugas/Ijin Belajar tersebut diberikan selama '.$konversi.' ('.$terbilangkvr.' ) tahun terhitung mulai Semester '.$mulai.' Tahun Akademik '.$tahun1.' sampai dengan Semester '.$akhir.' '.$tahun2.', dan apabila sudah mendapatkan beasiswa/pembiayaan dari sumber yang lain maka pembiayaan studi dari Universitas Brawijaya dihentikan.</td>
										</tr>
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify"><td colspan="5">&nbsp;</td></tr>		
										<tr style="text-align: justify">
											<td colspan="4">&nbsp;</td>
											<td>'.$tulisttd.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="4">
												'.$tembusan.'
											</td>
										</tr>
									</table>';
				} else {
					$tulisttd = '
								<table width="300" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'> 
									<tr><td colspan="2" align="left">Pihak Pertama<br />a.n. Rektor,<br />'.$pejabat.',</td></tr>
									<tr>
										<td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="80" /></td>
										<td width="150" align="left" valign="center">&nbsp;</td>
									</tr>
									<tr><td colspan="2" align="left">'.$setttd.'</td></tr>
								</table>';
					$tulisttd1 = '
								<table width="300" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'> 
									<tr><td colspan="2" align="left">Pihak Kedua,</td></tr>
									<tr>
										<td width="100" align="center"><img src="'.$homebase.'/scan/generate/qrimg-'.$marking.'.png" width="80" /></td>
										<td width="150" align="left" valign="center">&nbsp;</td>
									</tr>
									<tr><td colspan="2" align="left">'.$penerima.'<br />NIP. '.$nippenerima.'</td></tr>
								</table>';
					$spp 		= $request->input('set07');
					$hidup 		= $request->input('set08');
					$buku 		= $request->input('set09');
					$penelitian = $request->input('set10');
					$kursus 	= $request->input('set11');
					$berangkat 	= $request->input('set12');
					$pulang 	= $request->input('set13');
					$perihal 	= $request->input('set14');
					$cekhari1	= date("Y-m-d");
					$cekhari 	= DateTime::createFromFormat('Y-m-d', $cekhari1);
					$harittd 	= $cekhari->format('D');
					if ($harittd == 'Mon'){ $harittd = 'Senin'; }
					if ($harittd == 'Tue'){ $harittd = 'Selasa'; }
					if ($harittd == 'Wed'){ $harittd = 'Rabu'; }
					if ($harittd == 'Thu'){ $harittd = 'Kamis'; }
					if ($harittd == 'Fri'){ $harittd = 'Jumat'; }
					if ($harittd == 'Sat'){ $harittd = 'Sabtu'; }
					if ($harittd == 'Sun'){ $harittd = 'Minggu'; }
					$tertanggung= '';
					$abjat		= 'a';
					$ayat3a 	= '';
					if ($spp != ''){
						$ayat3a 	= 'Memberikan bukti pembayaran semester sebelumnya.';
						$ayat3a		= '<tr style="text-align: justify"><td>&nbsp;</td><td>&nbsp;</td><td valign="top">b.</td><td colspan="3" valign="top">'.$ayat3a.'</td></tr>';
						if ($spp == 0){
							$spp = '(<strong>at Cost</strong>) per semester';
						} else {
							$spp		= (int)$spp;
							$tlspp		= number_format( $spp, 0 , '.' , ',' );
							$spp		= Terbilang($spp);
							$banyakuang	= $spp.' rupiah';
							$banyakuang	= ucwords($banyakuang);
							$spp		= $tlspp.',- ('.$banyakuang.') per semester';
						}
						$tertanggung	= '<tr style="text-align: justify"><td>&nbsp;</td><td>&nbsp;</td><td colspan="2" valign="top">'.$abjat.'. Biaya Studi</td><td valign="top">Rp.</td><td valign="top">'.$spp.'</td></tr>';
						$abjat			= 'b';
					} else {
						$abjat			= 'a';
					}
					if ($hidup != ''){
						if ($hidup == 0){
							$hidup = '(<strong>at Cost</strong>) per semester';
						} else {
							$hidup		= (int)$hidup;
							$tlhidup	= number_format( $hidup, 0 , '.' , ',' );
							$hidup		= Terbilang($hidup);
							$banyakuang	= $hidup.' rupiah';
							$banyakuang	= ucwords($banyakuang);
							$hidup		= $tlhidup.',- ('.$banyakuang.') per semester';
						}
						$tertanggung	= $tertanggung.'<tr style="text-align: justify"><td>&nbsp;</td><td>&nbsp;</td><td colspan="2" valign="top">'.$abjat.'. Bantuan Biaya Hidup</td><td valign="top">Rp.</td><td valign="top">'.$hidup.'</td></tr>';
						if ($abjat == 'a'){
							$abjat		= 'b';
						} else {
							$abjat		= 'c';
						}
					}
					if ($buku != ''){
						if ($buku == 0){
							$buku = '(<strong>at Cost</strong>) per semester';
						} else {
							$buku		= (int)$buku;
							$tlbuku		= number_format( $buku, 0 , '.' , ',' );
							$buku		= Terbilang($buku);
							$banyakuang	= $buku.' rupiah';
							$banyakuang	= ucwords($banyakuang);
							$buku		= $tlbuku.',- ('.$banyakuang.') per semester';
						}
						$tertanggung	= $tertanggung.'<tr style="text-align: justify"><td>&nbsp;</td><td>&nbsp;</td><td colspan="2" valign="top">'.$abjat.'. Biaya Buku</td><td valign="top">Rp.</td><td valign="top">'.$buku.'</td></tr>';
						if ($abjat == 'a'){
							$abjat		= 'b';
						} else if ($abjat == 'b'){
							$abjat		= 'c';
						} else {
							$abjat		= 'd';
						}
					}
					$ceknomor = Suratkeluar::where('perihal', $perihal)->where('isisurat', 'LIKE', '%'.$nippenerima.'%')->first();
					if (isset($ceknomor->nomor)){
						$tulisnomor = $ceknomor->nomor.'/'.$ceknomor->kodefak.'/'.$ceknomor->faskode.'/'.$ceknomor->yersrt;
						$marking 	= $ceknomor->marking;
					}
					if ($getpegawai->jenis == 'Ijin Belajar' OR $getpegawai->jenis == 'IZIN BELAJAR TENDIK NON PNS' OR $getpegawai->jenis == 'IZIN BELAJAR TENDIK PNS' OR $getpegawai->jenis == 'IZIN BELAJAR DOSEN PNS' OR $getpegawai->jenis == 'IZIN BELAJAR DOSEN NON PNS'){
						$setjenis 		= 'Ijin';
						$setjeniskecil 	= 'ijin';
						$pasalkhs		= 'Pasal 50';
						if ($perihal == 'SURAT PERJANJIAN BANTUAN BIAYA IJIN BELAJAR' OR $perihal == 'SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR'){
							$tlsperihal = 'SURAT PERJANJIAN BANTUAN BIAYA IJIN BELAJAR';
						} else {
							$tlsperihal = 'SURAT PERJANJIAN PERPANJANGAN BANTUAN BIAYA IJIN BELAJAR';
						}
					} else {
						$setjenis 		= 'Tugas';
						$setjeniskecil 	= 'tugas';
						if ($perihal == 'SURAT PERJANJIAN BANTUAN BIAYA IJIN BELAJAR' OR $perihal == 'SURAT PERJANJIAN BANTUAN BIAYA TUGAS/IJIN BELAJAR'){
							$tlsperihal = 'SURAT PERJANJIAN BANTUAN BIAYA TUGAS BELAJAR';
						} else {
							$tlsperihal = 'SURAT PERJANJIAN PERPANJANGAN BANTUAN BIAYA TUGAS BELAJAR';
						}	
					}
					if ( $getpegawai->jenispeg == 'Tendik' AND $setjenis == 'Ijin'){
						$isi_surat 	= 	'<table width="720" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
								<tr><th width="20" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="120" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="500" scope="col"></th></tr>
								<tr>
									<td colspan="6">
										'.$kopsurat.'
									</td>
								</tr>
									<tr>
									<td scope="row">&nbsp;</td>
									<td colspan="5">&nbsp;</td>
								</tr>
								<tr>
									<td scope="row">&nbsp;</td>
									<td colspan="5" style="text-align: center;">
										<font style="font-size:12px">'.$tlsperihal.'</font><br />
										Nomor : '.$tulisnomor.'
									</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
									<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Yang bertandatangan dibawah ini :</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
									<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Nama</td>
									<td valign="top">:</td>
									<td valign="top">'.$namapjbt.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">NIP</td>
									<td valign="top">:</td>
									<td valign="top">'.$nippjbt.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Jabatan</td>
									<td valign="top">:</td>
									<td valign="top">'.$pejabat.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Selanjutnya disebut pihak pertama :</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
									<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Nama</td>
									<td valign="top">:</td>
									<td valign="top">'.$penerima.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">NIP/NIK</td>
									<td valign="top">:</td>
									<td valign="top">'.$nippenerima.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">jabatan</td>
									<td valign="top">:</td>
									<td valign="top">'.$jabpenerima.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Unit Kerja</td>
									<td valign="top">:</td>
									<td valign="top">'.$getpegawai->fakultas.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Selanjutnya disebut pihak kedua :</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Masing - masing dalam kedudukan sebagaimana tersebut diatas, bersepakat mengadakan Perjanjian Bantuan Biaya Ijin Belajar dengan ketentuan sebagai berikut:</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">1.</td>
									<td colspan="4" valign="top">Pihak Pertama menyetujui Pihak Kedua untuk melanjutkan studi Program '.$jenjang.' Bidang '.$prodi.' di '.$namapt.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">2.</td>
									<td colspan="4" valign="top">Guna menunjang keberhasilan studi Pihak Kedua, sesuai dengan Pertor '.$sknomor.' Tahun '.$sktahun.' Pihak Pertama menyediakan dana untuk Semester '.$getpegawai->startsmt.' s/d '.$getpegawai->endsmt.' '.$getpegawai->startgangen.' '.$getpegawai->startthnakad.' - '.$getpegawai->endgangen.' '.$getpegawai->endthnakad.' berupa:</td>
								</tr>
								'.$tertanggung.'
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">3.</td>
									<td colspan="4" valign="top">Apabila surat perjanjian bantuan ini masih berlaku, untuk pencairan dana selanjutnya, Pihak Kedua berkewajiban:</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td valign="top">a.</td>
									<td colspan="3" valign="top">Memberikan hasil perkembangan studi sesuai Pertor '.$sknomor.' Pasal 50 yang telah direview oleh Pimpinan Unit Kerja</td>
								</tr>
								'.$ayat3a.'
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Surat perjanjian Bantuan Biaya Ijin Belajar ini berlaku terhitung mulai dibuat dan ditanda tangani bersama oleh kedua belah pihak di Malang pada hari [tanggalttd].</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td colspan="6" valign="top">
										<table width="700" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
											<tr><td width="40">&nbsp;</td><td width="300">[ttdpihak1]</td><td width="350">[ttdpihak2]</td></tr>
										</table>
									</td>
								</tr>
							</table>';
					} else if ( $getpegawai->jenispeg == 'Tendik' AND $setjenis == 'Tugas'){
						$isi_surat 	= 	'<table width="720" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
								<tr><th width="20" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="120" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="500" scope="col"></th></tr>
								<tr>
									<td colspan="6">
										'.$kopsurat.'
									</td>
								</tr>
									<tr>
									<td scope="row">&nbsp;</td>
									<td colspan="5">&nbsp;</td>
								</tr>
								<tr>
									<td scope="row">&nbsp;</td>
									<td colspan="5" style="text-align: center;">
										<font style="font-size:12px">'.$tlsperihal.'</font><br />
										Nomor : '.$tulisnomor.'
									</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
									<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Yang bertandatangan dibawah ini :</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
									<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Nama</td>
									<td valign="top">:</td>
									<td valign="top">'.$namapjbt.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">NIP</td>
									<td valign="top">:</td>
									<td valign="top">'.$nippjbt.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Jabatan</td>
									<td valign="top">:</td>
									<td valign="top">'.$pejabat.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Selanjutnya disebut pihak pertama :</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
									<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Nama</td>
									<td valign="top">:</td>
									<td valign="top">'.$penerima.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">NIP/NIK</td>
									<td valign="top">:</td>
									<td valign="top">'.$nippenerima.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">jabatan</td>
									<td valign="top">:</td>
									<td valign="top">'.$jabpenerima.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="3" align="left" valign="top">Unit Kerja</td>
									<td valign="top">:</td>
									<td valign="top">'.$getpegawai->fakultas.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Selanjutnya disebut pihak kedua :</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Masing - masing dalam kedudukan sebagaimana tersebut diatas, bersepakat mengadakan Perjanjian Bantuan Biaya Tugas Belajar dengan ketentuan sebagai berikut:</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">1.</td>
									<td colspan="4" valign="top">Pihak Pertama menyetujui Pihak Kedua untuk melanjutkan studi Program '.$jenjang.' Bidang '.$prodi.' di '.$namapt.'</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">2.</td>
									<td colspan="4" valign="top">Guna menunjang keberhasilan studi Pihak Kedua, sesuai dengan Pertor '.$sknomor.' Tahun '.$sktahun.' Pihak Pertama menyediakan dana untuk Semester '.$getpegawai->startsmt.' s/d '.$getpegawai->endsmt.' '.$getpegawai->startgangen.' '.$getpegawai->startthnakad.' - '.$getpegawai->endgangen.' '.$getpegawai->endthnakad.' berupa:</td>
								</tr>
								'.$tertanggung.'
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">3.</td>
									<td colspan="4" valign="top">Apabila surat perjanjian bantuan ini masih berlaku, untuk pencairan dana selanjutnya, Pihak Kedua berkewajiban:</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td valign="top">a.</td>
									<td colspan="3" valign="top">Memberikan hasil perkembangan studi sesuai Pertor '.$sknomor.' '.$pasalkhs.' yang telah direview oleh Pimpinan Unit Kerja</td>
								</tr>
								'.$ayat3a.'
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">4.</td>
									<td colspan="4" valign="top">Apabila Pihak Kedua dalam masa studinya mendapatkan bantuan beasiswa dari instansi lain, maka wajib melaporkan kepada Pihak Pertama dan berlaku aturan sesuai Pertor '.$sknomor.' Tahun '.$sktahun.' pasal 25.</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">5.</td>
									<td colspan="4" valign="top">Setelah selesai studi Pihak Kedua wajib menyerahkan laporan selesai studi dan melaksanakan ikatan dinas di Universitas Brawijaya selama '.$ikatandinas.' dari waktu masa studi.</td>
								</tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td valign="top">6.</td>
									<td colspan="4" valign="top">Pihak Kedua bersedia membayar sejumlah ganti rugi atas biaya pendidikan yang telah dikeluarkan kepada Negara apabila membatalkan secara sepihak tugas belajar yang harus dilaksanakannya, membatalkan perjalanannya ke tempat belajar, tidak mendapat hasil yang sewajarnya dalam waktu yang telah ditetapkan karena kelalaiannya, tidak melaksanakan ikatan dinas untuk seluruhnya maupun untuk sebagian masa ikatan dinas yang telah ditentukan sesuai dengan Peraturan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi Nomor 27 Tahun 2022 Pasal 34.</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td>&nbsp;</td>
									<td colspan="5" valign="top">Surat perjanjian Bantuan Biaya Tugas Belajar ini berlaku terhitung mulai dibuat dan ditanda tangani bersama oleh kedua belah pihak di Malang pada hari [tanggalttd].</td>
								</tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
								<tr style="text-align: justify">
									<td colspan="6" valign="top">
										<table width="700" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
											<tr><td width="40">&nbsp;</td><td width="300">[ttdpihak1]</td><td width="350">[ttdpihak2]</td></tr>
										</table>
									</td>
								</tr>
							</table>';
					} else {
						$isi_surat 	= 	'<table width="720" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
										<tr><th width="20" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="120" scope="col">&nbsp;</th><th width="20" scope="col">&nbsp;</th><th width="500" scope="col"></th></tr>
										<tr>
											<td colspan="6">
												'.$kopsurat.'
											</td>
										</tr>
											<tr>
											<td scope="row">&nbsp;</td>
											<td colspan="5">&nbsp;</td>
										</tr>
										<tr>
											<td scope="row">&nbsp;</td>
											<td colspan="5" style="text-align: center;">
												<font style="font-size:12px">'.$tlsperihal.'</font><br />
												Nomor : '.$tulisnomor.'
											</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
											<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="5" valign="top">Yang bertandatangan dibawah ini :</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
											<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">Nama</td>
											<td valign="top">:</td>
											<td valign="top">'.$namapjbt.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">NIP</td>
											<td valign="top">:</td>
											<td valign="top">'.$nippjbt.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">Jabatan</td>
											<td valign="top">:</td>
											<td valign="top">'.$pejabat.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="5" valign="top">Selanjutnya disebut pihak pertama :</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
											<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">Nama</td>
											<td valign="top">:</td>
											<td valign="top">'.$penerima.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">NIP/NIK</td>
											<td valign="top">:</td>
											<td valign="top">'.$nippenerima.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">jabatan</td>
											<td valign="top">:</td>
											<td valign="top">'.$jabpenerima.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="3" align="left" valign="top">Unit Kerja</td>
											<td valign="top">:</td>
											<td valign="top">'.$getpegawai->fakultas.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="5" valign="top">Selanjutnya disebut pihak kedua :</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="5" valign="top">Masing - masing dalam kedudukan sebagaimana tersebut diatas, bersepakat mengadakan Perjanjian Bantuan Biaya '.$setjenis.' Belajar dengan ketentuan sebagai berikut:</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td valign="top">1.</td>
											<td colspan="4" valign="top">Pihak Pertama menyetujui Pihak Kedua untuk melanjutkan studi Program '.$jenjang.' Bidang '.$prodi.' di '.$namapt.'</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td valign="top">2.</td>
											<td colspan="4" valign="top">Guna menunjang keberhasilan studi Pihak Kedua, sesuai dengan Pertor '.$sknomor.' Tahun '.$sktahun.' Pihak Pertama menyediakan dana untuk Semester '.$getpegawai->startsmt.' s/d '.$getpegawai->endsmt.' '.$getpegawai->startgangen.' '.$getpegawai->startthnakad.' - '.$getpegawai->endgangen.' '.$getpegawai->endthnakad.' berupa:</td>
										</tr>
										'.$tertanggung.'
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td valign="top">3.</td>
											<td colspan="4" valign="top">Apabila surat perjanjian bantuan ini masih berlaku, untuk pencairan dana selanjutnya, Pihak Kedua berkewajiban:</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td valign="top">a.</td>
											<td colspan="3" valign="top">Memberikan hasil perkembangan studi sesuai Pertor '.$sknomor.' '.$pasalkhs.' yang telah direview oleh Kepala Departemen/Fakultas</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td valign="top">b.</td>
											<td colspan="3" valign="top">Memberikan bukti pembayaran semester sebelumnya.</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td valign="top">4.</td>
											<td colspan="4" valign="top">Apabila Pihak Kedua dalam masa studinya mendapatkan bantuan beasiswa dari instansi lain, maka wajib melaporkan kepada Pihak Pertama dan berlaku aturan sesuai Pertor '.$sknomor.' Tahun '.$sktahun.' pasal 25.</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td valign="top">5.</td>
											<td colspan="4" valign="top">Setelah selesai studi Pihak Kedua wajib menyerahkan laporan selesai studi dan melaksanakan ikatan dinas di Universitas Brawijaya selama '.$ikatandinas.' dari waktu masa studi.</td>
										</tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td valign="top">6.</td>
											<td colspan="4" valign="top">Pihak Kedua bersedia membayar sejumlah ganti rugi atas biaya pendidikan yang telah dikeluarkan kepada Negara apabila membatalkan secara sepihak '.$setjeniskecil.' belajar yang harus dilaksanakannya, membatalkan perjalanannya ke tempat belajar, tidak mendapat hasil yang sewajarnya dalam waktu yang telah ditetapkan karena kelalaiannya, tidak melaksanakan ikatan dinas untuk seluruhnya maupun untuk sebagian masa ikatan dinas yang telah ditentukan sesuai dengan Peraturan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi Nomor 27 Tahun 2022 Pasal 34.</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify">
											<td>&nbsp;</td>
											<td colspan="5" valign="top">Surat perjanjian Bantuan Biaya Tugas/Ijin Belajar ini berlaku terhitung mulai dibuat dan ditanda tangani bersama oleh kedua belah pihak di Malang pada hari [tanggalttd].</td>
										</tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify"><td colspan="6">&nbsp;</td></tr>
										<tr style="text-align: justify">
											<td colspan="6" valign="top">
												<table width="700" border="0" cellpadding="0" cellspacing="0" '.$fontstyle.'>
													<tr><td width="40">&nbsp;</td><td width="300">[ttdpihak1]</td><td width="350">[ttdpihak2]</td></tr>
												</table>
											</td>
										</tr>
									</table>';
					}
				}
				$page_format = array(
					'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
					'Dur' => 3,
					'PZ' => 1,
				);
				$ceksek = Suratkeluar::where('perihal', $perihal)->where('isisurat', 'LIKE', '%'.$nippenerima.'%')->count();
				if ($ceksek == 0){
					PDFCREATOR::SetCreator('Smart and Collaborative Office');
					PDFCREATOR::SetAuthor(Session('nama'));
					PDFCREATOR::SetTitle($perihal);
					PDFCREATOR::SetSubject('Persyratan, Bantuan, Studi');
					PDFCREATOR::SetKeywords($nippenerima);
					PDFCREATOR::setPrintHeader(false);
					PDFCREATOR::setPrintFooter(false);
					PDFCREATOR::SetMargins(5, 0, 5);
					PDFCREATOR::setFontSubsetting(true);
					PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
					PDFCREATOR::AddPage('P', $page_format, false, false);
					$bMargin = PDFCREATOR::getBreakMargin();
					$auto_page_break = PDFCREATOR::getAutoPageBreak();
					PDFCREATOR::SetAutoPageBreak(false, 0);
					$img_file = 'bgbssnpluskop.png';
					PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
					PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
					PDFCREATOR::setPageMark();
					PDFCREATOR::writeHTML($isi_surat, true, 0, true, 0);
					PDFCREATOR::setFooterMargin(0);
					$pdfdoc = PDFCREATOR::Output('', 'S');
					PDFCREATOR::reset();
					Storage::disk('local')->put('/scan/asli/'.$marking.'.pdf', $pdfdoc);
					$kerjanya 		= Suratkeluar::insertGetId([
						'id' 			=>  $nomarking,
						'marking' 		=>  $marking,
						'jenissrt' 		=>  'UPLOAD',
						'nomor' 		=>  $nomor,
						'anakno' 		=>  '',
						'kodefak' 		=>  $kodefakultas,
						'unit' 			=>  $unit,
						'tglsurat' 		=>  date("Y-m-d"),
						'daysrt' 		=>  date("d"),
						'monsrt' 		=>  date("m"),
						'yersrt' 		=>  $thn,
						'dasarsurat' 	=>  '',
						'kepada' 		=>  $penerima,
						'alamat' 		=>  $fakpenerima,
						'perihal' 		=>  $perihal,
						'lampiran' 		=>  $penerima.'<br />NIP. '.$nippenerima,
						'isisurat' 		=>  $isi_surat,
						'idpejabat' 	=>  $idpejabat,
						'pejabat' 		=>  $pejabat,
						'namapejabat' 	=>  $setttd,
						'tembusan' 		=>  $tembusan,
						'sifat' 		=>  4,
						'klasifikasi' 	=>  'Biasa',
						'pembuat' 		=>  Session('nama'),
						'kelompok' 		=>  Session('previlage'),
						'status' 		=>  'NEW',
						'arsip' 		=>  '',
						'footnote' 		=>  '',
						'tandatangan' 	=>  '',
						'paraf1' 		=>  $paraf1,
						'paraf2' 		=>  $paraf2,
						'paraf3' 		=>  $paraf3,
						'paraf4' 		=>  '',
						'paraf5' 		=>  '',
						'ruangarsip' 	=>  '',
						'ordnerarsip' 	=>  '',
						'lemariarsip' 	=>  '',
						'faskode' 		=>  $faskode,
						'fasmasa' 		=>  '',
						'fasket' 		=>  '',
						'subkode' 		=>  '',
						'submasa' 		=>  '',
						'subket' 		=>  '',
						'font' 			=>  'TNR',
						'ukuran' 		=>  '14',
						'lebarttd' 		=>  50,
						'filelampiran' 	=>  '',
						'fakultas' 		=>  $fakultas
					]);
					if ($kerjanya){
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
						$publicfolder	= public_path();
						$command		= '/usr/local/bin/markpdf '.$publicfolder.'/scan/asli/'.$marking.'.pdf '.$publicfolder.'/draft.png '.$publicfolder.'/scan/files/'.$marking.'.pdf';
						shell_exec($command);
						Bantuansyarat::create([
							'idpegawai' => $nippenerima, 
							'jenis'		=> $perihal, 
							'jenfile'	=> 'SCO',
							'namafile'	=> $homebase.'/viewsurat/keluar-'.$kerjanya, 
							'keterangan'=> $perihal
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft Terkirim ke '.$pejabat.' Tracking Surat Bisa di Cek di Laman Surat Keluar TTE']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Drafting Surat Gagal dilakukan, Silahkan Hubungi Tim IT Anda']);
						return back();
					}
				} else {
					$getdata = Suratkeluar::where('perihal', $perihal)->where('isisurat', 'LIKE', '%'.$nippenerima.'%')->orderBy('id', 'DESC')->first();
					if ($getdata->tandatangan != ''){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Drafting Surat sudah ada dengan link surat <a href="'.$homebase.'/viewsurat/keluar-'.$getdata->id.'">'.$homebase.'/viewsurat/keluar-'.$getdata->id.'</a>']);
						return back();	
					} else {
						if (file_exists(public_path('scan/files/'.$getdata->marking.'.pdf'))){
							$filedelete =  'scan/files/'.$getdata->marking.'.pdf';
							Storage::disk('local')->delete($filedelete);
						}
						if (file_exists(public_path('scan/asli/'.$getdata->marking.'.pdf'))){
							$filedelete =  'scan/asli/'.$getdata->marking.'.pdf';
							Storage::disk('local')->delete($filedelete);
						}
						if ($getdata->footnote != ''){
							$statuse = 'NEW';
						} else {
							$statuse = 'PEMBAHARUAN';
						}
						PDFCREATOR::SetCreator('Smart and Collaborative Office');
						PDFCREATOR::SetAuthor(Session('nama'));
						PDFCREATOR::SetTitle($perihal);
						PDFCREATOR::SetSubject('Persyratan, Bantuan, Studi');
						PDFCREATOR::SetKeywords($nippenerima);
						PDFCREATOR::setPrintHeader(false);
						PDFCREATOR::setPrintFooter(false);
						PDFCREATOR::SetMargins(5, 0, 5);
						PDFCREATOR::setFontSubsetting(true);
						PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
						PDFCREATOR::AddPage('P', $page_format, false, false);
						$bMargin = PDFCREATOR::getBreakMargin();
						$auto_page_break = PDFCREATOR::getAutoPageBreak();
						PDFCREATOR::SetAutoPageBreak(false, 0);
						$img_file = 'bgbssnpluskop.png';
						PDFCREATOR::Image($img_file, 0, 0, 210, 330, '', '', '', false, 300, '', false, false, 0);
						PDFCREATOR::SetAutoPageBreak($auto_page_break, $bMargin);
						PDFCREATOR::setPageMark();
						PDFCREATOR::writeHTML($isi_surat, true, 0, true, 0);
						PDFCREATOR::setFooterMargin(0);
						$pdfdoc = PDFCREATOR::Output('', 'S');
						PDFCREATOR::reset();
						Storage::disk('local')->put('/scan/asli/'.$getdata->marking.'.pdf', $pdfdoc);
						$kerjanya 		= Suratkeluar::where('id', $getdata->id)->update([
							'kepada' 		=>  $penerima,
							'alamat' 		=>  $fakpenerima,
							'perihal' 		=>  $perihal,
							'lampiran' 		=>  $penerima.'<br />NIP. '.$nippenerima,
							'isisurat' 		=>  $isi_surat,
							'idpejabat' 	=>  $idpejabat,
							'pejabat' 		=>  $pejabat,
							'namapejabat' 	=>  $setttd,
							'tembusan' 		=>  $tembusan,
							'pembuat' 		=>  Session('nama'),
							'kelompok' 		=>  Session('previlage'),
							'paraf1' 		=>  $paraf1,
							'paraf2' 		=>  $paraf2,
							'paraf3' 		=>  $paraf3,
							'paraf4' 		=>  '',
							'footnote' 		=>  '',
							'tandatangan' 	=>  '',
							'updated_at'	=> 	date("Y-m-d H:i:s")
						]);
						if ($kerjanya){
							$publicfolder	= public_path();
							$command		= '/usr/local/bin/markpdf '.$publicfolder.'/scan/asli/'.$getdata->marking.'.pdf '.$publicfolder.'/draft.png '.$publicfolder.'/scan/files/'.$getdata->marking.'.pdf';
							shell_exec($command);
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Draft Updated']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Drafting Surat Gagal dilakukan, Silahkan Hubungi Tim IT Anda']);
							return back();
						}
					}
				}
			}
		}
    }
	public function pleaseSignberkasSPTJM($id){
		$homebase		= url("/");
		$alamatweb		= $homebase.'/sptjm/'.$id;
		$kalender   	= array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd         	= date("d");
		$mm         	= (int)date("m");
		$mm				= $kalender[$mm];
		$tahuniki   	= date("Y");
		$tglsurat		= date("Y-m-d");
		$sakniki		= $dd.' '.$mm.' '.$tahuniki;
		$cekstatus 		= Bantuanstudi::where('id', $id)->first();
		if (isset($cekstatus->sptjm)){
			$tanggalterima	= $cekstatus->tanggalterima;
			$idpegawai		= $cekstatus->idpegawai; 
			$scankhs		= $cekstatus->scankhs; 
			$tahun			= $cekstatus->tahun;
			$semester		= $cekstatus->semester;
			$sptjm			= $cekstatus->sptjm;
			$rom  			= Suratkeluartnpnomor::where('marking', $sptjm)->first();
			if (isset($rom->id)){
				$status 	= $rom->status;
				$nip		= $rom->lampiran;
				$tandatangan= '';
				$cekidpeg	= Simpegpegawai::where('nip_baru', $nip)->first();
				if (isset($cekidpeg->id)){
					$cekdata= User::where('nip', $cekidpeg->id)->where('tandatangan','!=', '')->first();
					if (isset($cekdata->tandatangan)){
						$tandatangan = $cekdata->tandatangan;
					}	
				}
				if ($status != 'NEW'){
					$url 	= $homebase.'/sptjm/'.$id;
					return redirect($url);
				} else {
					$data           		=   [];
					$data['jenissurat'] 	= 	'Surat Keluar Tanpa Nomor';
					$data['tandatangan'] 	= 	$tandatangan;
					$data['idsurat'] 	    = 	$id;
					$data['sakniki']       	=   $sakniki;
					$data['alamatweb']    	=   $alamatweb;
					$data['surat']     		=   $rom;
					return view('bantuan.formttd', $data);
				}
			} else {
				return view('vokasi.hilang');
			}
		} else {
			return view('vokasi.hilang');
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
			if ($jenissurat == 'Surat Keluar Tanpa Nomor'){
				$rom  		= Suratkeluartnpnomor::where('id', $id)->first();
				if (isset($rom->id)){
					if ($alasan == 'SETUJU'){
						$update = Suratkeluartnpnomor::where('id', $id)->update([
							'status'		=> 'Sign',
							'tandatangan'	=> $ttd,
							'arsip'			=> date("Y-m-d H:i:s"),
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					} else {
						$update = Suratkeluar::where('id', $id)->update([
							'status'		=> 'Tidak Setuju',
							'footnote'		=> $alasan,
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
			} else if ($jenissurat == 'Surat Kontrak'){
				$rom  		= DraftKontrak::where('id', $id)->first();
				if (isset($rom->id)){
					if ($alasan == 'SETUJU'){
						$update = DraftKontrak::where('id', $id)->update([
							'status'		=> 'Sign',
							'tandatangan'	=> $ttd,
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					} else {
						$update = DraftKontrak::where('id', $id)->update([
							'status'		=> 'Tidak Setuju dengan alasan '.$alasan,
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
			} else {
				$rom  		= Suratkeluar::where('id', $id)->first();
				if (isset($rom->id)){
					if ($alasan == 'SETUJU'){
						$update = Suratkeluar::where('id', $id)->update([
							'status'		=> 'Sign',
							'filelampiran'	=> $ttd,
							'arsip'			=> date("Y-m-d H:i:s"),
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					} else {
						$update = Suratkeluar::where('id', $id)->update([
							'status'		=> 'Tidak Setuju',
							'footnote'		=> $alasan,
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					}
					if ($update){
						Bantuansyarat::where('namafile', $alamatweb)->update([
							'statusttd'	=> $alasan
						]);
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
			}
        }
    }
	public function getPegawaiTUBEL(Request $request) {
    	$valcari		= $request->input('set01');
		$jeniscari		= $request->input('set02');
		$nama			= '';
		$hape 			= '';
		$jabfung		= '';
		$fakultas		= '';
		$namapt 		= '';
		$namafakultas	= '';
		$namaprodi		= '';
		$jenjang		= '';
    	$negara			= '';
    	$jenisstudi		= '';
    	$sumberdana		= '';
    	$sumberdanalain	= '';
    	$mulai			= '';
		$email 			= '';
		$golongan 		= '';
		$jenispeg 		= '';
		$valcari		= preg_replace('/\s/', '', $valcari);
							
		if ($jeniscari == 'nip'){
			$nip 		= $valcari;
			$cekjabfung = Drafttubel::where('nip', $valcari)->orderBy('id', 'DESC')->first();
			$cekpenerima= Bantuanpenerima::where('nip', $valcari)->orderBy('id', 'DESC')->first();
		} else {
			$email		= $valcari;
			$getpegawai	= Simpegpegawai::where('email_ub', 'LIKE', $valcari.'%')->first();
			if (isset($getpegawai->id)){
				$nip	= $getpegawai->nip_baru;
				$email	= $getpegawai->email_ub;
			} else {
				$nip	= '';
			}
			$cekjabfung = Drafttubel::where('nip', $nip)->orderBy('id', 'DESC')->first();
			$cekpenerima= Bantuanpenerima::where('nip', $nip)->orderBy('id', 'DESC')->first();
		}
		if (isset($cekjabfung->id)){
			$nama 			= $cekjabfung->nama;
			$jabfung		= $cekjabfung->jabfung;
			$fakultas		= $cekjabfung->unitkerja;
			$namapt 		= $cekjabfung->tempatstudi;
			$namaprodi		= $cekjabfung->bidangstudi;
			$jenjang		= $cekjabfung->jenjang;
			$jenisstudi		= $cekjabfung->jenis;
			$sumberdana		= $cekjabfung->biaya;
			$mulai			= $cekjabfung->mulai;
		}
		if (isset($cekpenerima->id)){
			if ($jenispeg == ''){ $jenispeg = $cekpenerima->jenispeg; }
			if ($golongan == ''){ $golongan = $cekpenerima->golongan; }
			if ($email == ''){ $email = $cekpenerima->email; }
			if ($nama == ''){ $nama = $cekpenerima->nama; }
			if ($hape == ''){ $hape = $cekpenerima->hape; }
			if ($jabfung == ''){ $jabfung = $cekpenerima->jabfung; }
			if ($fakultas == ''){ $fakultas	= $cekpenerima->fakultas; }
			if ($namapt == ''){ $namapt = $cekpenerima->namapt; }
			if ($namafakultas == ''){ $namafakultas	= $cekpenerima->fakstudi; }
			if ($namaprodi == ''){ $namaprodi = $cekpenerima->prodi; }
			if ($jenjang == ''){ $jenjang = $cekpenerima->jenjang; }
			if ($negara == ''){ $negara	= $cekpenerima->negara; }
			if ($jenisstudi == ''){ $jenisstudi	= $cekpenerima->jenis; }
			if ($sumberdana == ''){ $sumberdana	= $cekpenerima->sumberbiaya; }
			if ($sumberdanalain == ''){ $sumberdanalain	= $cekpenerima->sumberbiaya; }
			if ($mulai == ''){ $mulai = $cekpenerima->mulaistudi; }
		}
		if ($nip != '' AND $nama != '' AND $fakultas != '' AND $email != '' AND $jenisstudi != '' AND $namapt != ''){
			$cekdata = Bantuanpenerima::where('nip', $nip)->count();
			if ($cekdata == 0){
				Bantuanpenerima::create([
					'nama' 				=> $nama,
					'nip'				=> $nip,
					'fakultas'			=> $fakultas,
					'email'				=> $email,
					'hape'				=> $hape,
					'golongan'			=> $golongan,
					'jabfung'			=> $jabfung,
					'jenispeg'			=> $jenispeg,
					'inputor'			=> 'KP',
					'created_by'		=> $nama,
					'negara'			=> $negara,
					'namapt'			=> $namapt,
					'jenjang'			=> $jenjang,
					'mulaistudi'		=> $mulai,
					'jenis'				=> $jenisstudi,
					'sumberbiaya'		=> $sumberdana,
					'tahunsls'			=> null,
					'idpeg'				=> 0,
				]);
			}
		}
    	return response()->json([
			'email' 		=> $email, 
			'nip' 			=> $nip, 
			'nama' 			=> $nama, 
			'hape' 			=> $hape, 
			'jabfung' 		=> $jabfung, 
			'fakultas' 		=> $fakultas, 
			'namapt' 		=> $namapt, 
			'namafakultas' 	=> $namafakultas, 
			'namaprodi' 	=> $namaprodi,
			'jenjang' 		=> $jenjang,
			'negara' 		=> $negara,
			'jenisstudi' 	=> $jenisstudi,
			'sumberdana' 	=> $sumberdana,
			'sumberdanalain'=> $sumberdanalain,
			'mulai' 		=> $mulai,
		]);
		return back();
	}
}