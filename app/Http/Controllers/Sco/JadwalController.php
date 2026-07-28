<?php

namespace App\Http\Controllers\Sco;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Gedung;
use App\Ruang;
use App\Fasruang;
use App\Pejabatsurat;
use App\User;
use App\Jadwal;
use App\Kendaraan;
use App\Histories;
use App\Bukutamu;
use App\Suratmasuk;
use App\Inboxsurat;
use App\Firebasebank;
use App\Models\Jadwalsatpam;
use App\Models\Antrian;
use App\Models\AntrianUjian;
use App\Simpegpegawai;
use App\Models\Dosen;
use App\Models\Jadwalkuliah;
use App\WebinarEventlist;
use App\Penerimasurat;

use QrCode;
use Validator;
use Session;
use Google_Client;
use Google_Service_Calendar;
use Carbon\Carbon;
define( 'API_ACCESS_KEY3', 'AAAA6YBXh1k:APA91bFL0q7QAXQGohXMpTwHco79f13C8PFk1Oo8kKhg1JerOulT9-37dxyP8X5ibABI0NuQ4ZsVxKQKCt7HuR7lUdJJuB-hTVnBmOUIBYfBlHb-Lcp6aGkj4erfF7J__A5hufXjF8Vt' );

class JadwalController extends Controller
{
    public function index() {
		$fakultas				= Session('fakultas');
    	$ruangs 				= Ruang::where('fakultas', $fakultas)->orderBy('namarg', 'ASC')->get();
    	$mobils 				= Kendaraan::where('fakultas', $fakultas)->orderBy('merek', 'ASC')->get();
    	$gedungs 				= Gedung::where('fakultas', $fakultas)->orderBy('namagd', 'ASC')->get();
    	$data 					= [];
    	$data['countruang'] 	= Jadwal::where('jenisjadwal', '1')->where('fakultas', $fakultas)->count();
		$data['countgedung'] 	= Jadwal::where('jenisjadwal', '3')->where('fakultas', $fakultas)->count();
		$data['countmobil'] 	= Jadwal::where('jenisjadwal', '2')->where('fakultas', $fakultas)->count();
		$data['tahunne'] 		= date("Y");
		$data['ruangs'] 		= $ruangs;
		$data['kendaraans'] 	= $mobils;
		$data['gedungs'] 		= $gedungs;
		$status 				= '';
		if (Session('spesial') == 'Admin Peminjaman') { $status = 'Admin'; }
    	if (Session('idjabatan') == '575' OR Session('idjabatan') == '965' OR Session('idjabatan') == '63') { $status = 'Admin'; }
    	if (Session('id') == '2') { $status = 'Admin'; }
    	if (Session('keljabatan') == 'KASUB UMUM FAK' OR Session('keljabatan') == 'KASUB UMUMKEU FAK') { $status = 'Admin'; }
		if ($status == 'Admin'){
			return view('simpen.dashboardadmin', $data);
		} else {
			return redirect('simpen'); 
		}
    }
	public function rentkendaraan() {
    	$ruangs 			= 	Kendaraan::where('marking', 'OK')->get();
    	$data 				= 	[];
    	$data['ruangs'] 	= 	$ruangs;
    	return view('admin.jadwal', $data);
    }
	public function getlist(Request $request) {
		$arrayjadwal 	= [];
		$fakpanjang		= Session('fakpanjang');
		$fakultas 		= Session('fakultas');
		$nip 			= '';
		if (Session('previlage') == 'PEJABAT'){
			$mkelompok		= Session('jabatan');
		} else {
			$mkelompok		= Session('previlage');		
		}
		if ($mkelompok == 'Sekretaris Ka.Biro Keuangan'){
			//previlage = 'Direktur Direktorat Anggaran dan Perbendaharaan';
			$idpejabat 	= 8;
		} else if ($mkelompok == 'Sekretaris Ka.Biro Umum dan Kepegawaian'){
			//previlage = 'Direktur Direktorat Aset';
			$idpejabat 	= 7;
		} else if ($mkelompok == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan'){
			//previlage = 'Direktur Direktorat Administrasi dan Layanan Akademik';
			$idpejabat 	= 6;
		} else if ($mkelompok == 'Sekretaris Wakil Rektor Bidang Akademik'){
			$idpejabat 	= 2;
		} else if ($mkelompok == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan'){
			$idpejabat 	= 3;
		} else if ($mkelompok == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan'){
			$idpejabat 	= 4;
		} else if ($mkelompok == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasaman'){
			$idpejabat 	= 5;
		} else if ($mkelompok == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi'){
			$idpejabat 	= 951;
		} else if ($mkelompok == 'Sekretaris Rektor'){
			$idpejabat 	= 1;
		} else if ($mkelompok == 'Sekretaris Dekan'){
			$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->where('view', 'Semua Dekan')->first();
			if (isset($getpejabatid->id)){
				$idpejabat	= $getpejabatid->id;
			} else {
				$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->orderBy('kode', 'ASC')->first();
				if (isset($getpejabatid->id)){
					$idpejabat	= $getpejabatid->id;
				} else {
					$idpejabat	= 0;
				}
			}
		} else if ($mkelompok == 'Sekretaris WD I'){
			$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->where('view', 'WD1')->first();
			if (isset($getpejabatid->id)){
				$idpejabat	= $getpejabatid->id;
			} else {
				$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->orderBy('kode', 'ASC')->first();
				if (isset($getpejabatid->id)){
					$idpejabat	= $getpejabatid->id;
				} else {
					$idpejabat	= 0;
				}
			}
		} else if ($mkelompok == 'Sekretaris WD II'){
			$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->where('view', 'WD2')->first();
			if (isset($getpejabatid->id)){
				$idpejabat	= $getpejabatid->id;
			} else {
				$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->orderBy('kode', 'ASC')->first();
				if (isset($getpejabatid->id)){
					$idpejabat	= $getpejabatid->id;
				} else {
					$idpejabat	= 0;
				}
			}
		} else if ($mkelompok == 'Sekretaris'){
			$idpejabat	= 0;
		} else if ($mkelompok == 'Sekretaris WD III'){
			$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->where('view', 'WD3')->first();
			if (isset($getpejabatid->id)){
				$idpejabat	= $getpejabatid->id;
			} else {
				$getpejabatid 	= Pejabatsurat::where('fakultas', Session('fakultas'))->orderBy('kode', 'ASC')->first();
				if (isset($getpejabatid->id)){
					$idpejabat	= $getpejabatid->id;
				} else {
					$idpejabat	= 0;
				}
			}
		} else {
			$idpejabat	= 0;
		}
		if ($mkelompok == 'Sekretaris'){
			$jadwals   	= Jadwal::where('mulai', '>=', Carbon::yesterday())
			->where('fakultas', Session('fakultas'))
			->orderBy('mulai', 'DESC')
			->orderBy('gedung', 'ASC')
			->orderBy('ruang', 'ASC')
			->limit(200)
			->get();
		} else {
			if ($idpejabat == 0){
				$mnama		= Session('nama');
				$jadwals   	= Jadwal::where('mulai', '>=', Carbon::now()->subDays(1)->toDateTimeString())
							->where('peminjam', 'LIKE', $mnama)
							->orderBy('mulai', 'DESC')
							->orderBy('gedung', 'ASC')
							->orderBy('ruang', 'ASC')
							->get();
			} else {
				$getpejabat = Pejabatsurat::where('id', $idpejabat)->first();
				if (isset($getpjbt->pejabat)){
					$pimpinan 	= $getpjbt->pejabat;
					$nmpimpinan	= $getpjbt->nama;
					$nip		= $getpjbt->nip;
					$nip		= preg_replace('/\s+/', '', $nip);
					$jadwals 	= Jadwal::whereIn('inputor', [ Session('nama'), $nmpimpinan])->orWhere('peminjam', 'LIKE', $nmpimpinan)->where('created_at', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->get();
				} else {
					$jadwals   	= Jadwal::where('mulai', '>=', Carbon::now()->subDays(1)->toDateTimeString())
							->whereIn('inputor', [ Session('nama'), Session('previlage')])
							->orderBy('mulai', 'DESC')
							->orderBy('gedung', 'ASC')
							->orderBy('ruang', 'ASC')
							->get();
				}
			}
		}
        foreach ($jadwals as $rjadwal) {
			$scan_surat	= $rjadwal->suratpermohonan;

            if ($scan_surat == ''){
				$scan_surat = 'Belum Upload File';
			}
            $arrayjadwal[] = array(
                'idne'		=> $rjadwal->id,
                'ruang'     => $rjadwal->ruang,
                'gedung'  	=> $rjadwal->gedung,
                'mulai'  	=> $rjadwal->mulai,
                'akhir'     => $rjadwal->akhir,
                'peminjam'	=> $rjadwal->peminjam,
                'keperluan' => addslashes($rjadwal->keperluan),
                'keterangan'=> addslashes($rjadwal->keterangan),
                'inputor' 	=> $rjadwal->inputor,
				'biaya' 	=> $rjadwal->biaya,
                'lampiran'  => $scan_surat,
            );
        }
        echo json_encode($arrayjadwal);
    }
	public function getlistPenjadwalan(Request $request) {
		$arrayjadwal 	= array();		
		$mnama			= Session('nama');
		$jadwals   		= Jadwal::where('mulai', '>=', Carbon::yesterday())
						->where('gedung', '!=', 'Garasi')
						->where('ruang', '!=', '')
						->orderBy('mulai', 'DESC')
						->orderBy('gedung', 'ASC')
						->orderBy('ruang', 'ASC')
						->get();
		
        foreach ($jadwals as $rjadwal) {
			$scan_surat	= $rjadwal->suratpermohonan;

            if ($scan_surat == ''){
				$scan_surat = 'Belum Upload File';
			}
            $arrayjadwal[] = array(
                'idne'		=> $rjadwal->id,
                'ruang'     => $rjadwal->ruang,
                'gedung'  	=> $rjadwal->gedung,
                'mulai'  	=> $rjadwal->mulai,
                'akhir'     => $rjadwal->akhir,
                'peminjam'	=> $rjadwal->peminjam,
                'keperluan' => addslashes($rjadwal->keperluan),
                'keterangan'=> addslashes($rjadwal->keterangan),
                'inputor' 	=> $rjadwal->inputor,
				'biaya' 	=> $rjadwal->biaya,
                'lampiran'  => $scan_surat,
            );
        }
		
        echo json_encode($arrayjadwal);
    }
	public function getKalenderlist(Request $request) {
		$data       =   [];
		$idne		= 	'';
		$homebase	= 	url("/");
		$jenis   	=   $request->val01;
		$lokasi   	=   $request->val02;
		$nama   	=   $request->val03;
		$tmulai   	=   $request->val04;
		$tselesai  	=   $request->val05;
		$mulai 		= 	date("Y-m-d H:i:s");
		$tambah		= 	' + 360 second';
		$akhir		= 	date('Y-m-d H:i:s',strtotime($tambah,strtotime($mulai)));
		$email		= 	'';
		$nip		= 	'';
		$tglskrg	=	date("Y-m-d");
		$tglskrg	= 	strtotime($tglskrg);
		$cekpeg		= Simpegpegawai::where('email', Session('email'))->orWhere('email_ub', Session('email'))->first();
		if (isset($cekpeg->id)){
			$nip	= $cekpeg->nip_baru;
			$nip	= preg_replace('/\s+/', '', $nip);
			$email 	= $cekpeg->email;
			$emailub= $cekpeg->email_ub;
			if (is_null($email) OR $email == ''){
				$email 		= $emailub;
			}
		}
		if ($jenis == 'Admin Peminjaman' OR $jenis == 'SIMPEN'){
			$jadwals 	= Jadwal::whereIn('jenisjadwal', ['1','2','3'])->where('status', '!=', 'ARSIP')->where('fakultas', Session('fakultas'))->orderBy('jenisjadwal', 'ASC')->orderBy('ruang', 'ASC')->orderBy('mulai', 'ASC')->get();
			if (!empty($jadwals)){
				foreach ($jadwals as $hcari) {
					if ($idne == ''){ $idne = 'id1'; }
					else { $idne = $hcari->id; }
					$keperluan	= $hcari->keperluan;
					$mulai		= $hcari->mulai;
					$akhir		= $hcari->akhir;
					$filter		= $hcari->jenisjadwal;
					$nmruang	= $hcari->nmruang;
					if (is_null($hcari->idsurat) OR $hcari->idsurat == ''){
						$alamatweb	= '<span class="btn btn-lg badge badge-success">Di Input Oleh '.$hcari->inputor.'</span>';
					} else {
						$alamatweb	= '<a href="'.$homebase.'/viewsurat/7a07275b47504815818abc970da769fc-'.$hcari->idsurat.'">'.$homebase.'/viewsurat/7a07275b47504815818abc970da769fc-'.$hcari->idsurat.'</a>';
					}
					if ($filter == '1'){
						if (is_null($nmruang) OR $nmruang == ''){
							$filter = 'Ruang';
						} else { $filter = $nmruang.'-'.$hcari->nmgedung.' ('.$hcari->fakultas.')'; }
						if ($jenis == 'Admin Peminjaman'){
							$tombol = '
										<div class="row">
											<div class="col-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Ruang</td><td colspan="2">'.$filter.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$keperluan.' ('.$hcari->keterangan.')</td></tr>
													<tr><td>Lembar Disposisi</td><td colspan="2">'.$alamatweb.'</td></tr>
													<tr><td>Edit Permohonan </td><td colspan="2">
														<a href="'.$homebase.'/editpeminjaman/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-info"><i class="fa fa-edit"></i> '.$homebase.'/editpeminjaman/'.$hcari->id.'</span>
														</a>
													</td></tr>
													<tr><td>Pembatalan Permohonan </td><td colspan="2">
														<a href="'.$homebase.'/batalpermohonan/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-warning"><i class="fa fa-legal"></i> '.$homebase.'/batalpermohonan/'.$hcari->id.'</span>
														</a>
													</td></tr>
													<tr><td>Akhiri Kegiatan </td><td colspan="2">
														<a href="'.$homebase.'/akhirkegiatan/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-danger"><i class="fa fa-flag-checkered"></i> '.$homebase.'/akhirkegiatan/'.$hcari->id.'</span>
														</a>
													</td></tr>
												</table>
											</div>
										</div>';
						} else {
							$tombol = '
										<div class="row">
											<div class="col-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Ruang</td><td colspan="2">'.$filter.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$keperluan.' ('.$hcari->keterangan.')</td></tr>
												</table>
											</div>
										</div>';
						}
					} else if ($filter == '2'){
						if (is_null($nmruang) OR $nmruang == ''){
							$filter = 'Kendaraan';
						} else { $filter = $nmruang.'-'.$hcari->nmgedung.' ('.$hcari->fakultas.')'; }
						if ($jenis == 'Admin Peminjaman'){
							$tombol = '
										<div class="row">
											<div class="col-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Kendaraan</td><td colspan="2">'.$filter.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$hcari->keterangan.'</td></tr>
													<tr><td>Lembar Disposisi</td><td colspan="2">'.$alamatweb.'</td></tr>
													<tr><td>Edit Permohonan </td><td colspan="2">
														<a href="'.$homebase.'/editpeminjaman/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-info"><i class="fa fa-edit"></i> '.$homebase.'/editpeminjaman/'.$hcari->id.'</span>
														</a>
													</td></tr>
													<tr><td>Pembatalan Permohonan </td><td colspan="2">
														<a href="'.$homebase.'/batalpermohonan/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-warning"><i class="fa fa-legal"></i> '.$homebase.'/batalpermohonan/'.$hcari->id.'</span>
														</a>
													</td></tr>
													<tr><td>Akhiri Kegiatan </td><td colspan="2">
														<a href="'.$homebase.'/akhirkegiatan/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-danger"><i class="fa fa-flag-checkered"></i> '.$homebase.'/akhirkegiatan/'.$hcari->id.'</span>
														</a>
													</td></tr>
												</table>
											</div>
										</div>';
						} else {
							$tombol = '
										<div class="row">
											<div class="col-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Kendaraan</td><td colspan="2">'.$filter.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$hcari->keterangan.'</td></tr>
												</table>
											</div>
										</div>';
						}
					} else if ($filter == '3'){
						if (is_null($nmruang) OR $nmruang == ''){
							$filter = 'Gedung';
						} else { $filter = $nmruang.'-'.$hcari->nmgedung.' ('.$hcari->fakultas.')'; }
						if ($jenis == 'Admin Peminjaman'){
							$tombol = '
										<div class="row">
											<div class="col-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Gedung</td><td colspan="2">'.$filter.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$hcari->keterangan.'</td></tr>
													<tr><td>Lembar Disposisi</td><td colspan="2">'.$alamatweb.'</td></tr>
													<tr><td>Edit Permohonan </td><td colspan="2">
														<a href="'.$homebase.'/editpeminjaman/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-info"><i class="fa fa-edit"></i> '.$homebase.'/editpeminjaman/'.$hcari->id.'</span>
														</a>
													</td></tr>
													<tr><td>Pembatalan Permohonan </td><td colspan="2">
														<a href="'.$homebase.'/batalpermohonan/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-warning"><i class="fa fa-legal"></i> '.$homebase.'/batalpermohonan/'.$hcari->id.'</span>
														</a>
													</td></tr>
													<tr><td>Akhiri Kegiatan </td><td colspan="2">
														<a href="'.$homebase.'/akhirkegiatan/'.$hcari->id.'">
															<span class="btn btn-lg badge badge-danger"><i class="fa fa-flag-checkered"></i> '.$homebase.'/akhirkegiatan/'.$hcari->id.'</span>
														</a>
													</td></tr>
												</table>
											</div>
										</div>';
						} else {
							$tombol = '
										<div class="row">
											<div class="col-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Gedung</td><td colspan="2">'.$filter.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$hcari->keterangan.'</td></tr>
												</table>
											</div>
										</div>';
						}
					} else {
						$tombol = '';
					}
					if ($mulai == '0000-00-00 00:00:00' OR is_null($mulai)){ $mulai = $hcari->created_at; }
					if ($akhir == '0000-00-00 00:00:00' OR is_null($akhir)){ $akhir = $hcari->updated_at; }
					$mulai		= strtotime($mulai);
					if ($akhir == '0000-00-00 00:00:00' OR is_null($akhir)){
						$mulai		= $hcari->mulai;
						$tambah		= ' + 360 second';
						$akhir		= date('Y-m-d H:i:s',strtotime($tambah,strtotime($mulai)));
						Jadwal::where('id', $hcari->id)->update([
							'mulai'		=> $mulai,
							'akhir'		=> $akhir
						]);
					}
					$data[] 	= array(
						'id' 			=> $idne,
						'description' 	=> $hcari->keterangan,
						'location' 		=> $hcari->gedung,
						'subject' 		=> $filter.'<br />'.$tombol,
						'calendar' 		=> $filter,
						'start' 		=> $hcari->mulai,
						'end'			=> $akhir,
					);
				}
			}		
		} else if ($jenis == 'Siklus GJM'){
			$jadwals 	= Jadwal::where('jenisjadwal', '4')->where('status', '!=', 'ARSIP')->where('fakultas', Session('fakultas'))->orderBy('jenisjadwal', 'ASC')->orderBy('ruang', 'ASC')->orderBy('mulai', 'ASC')->get();
			if (!empty($jadwals)){
				foreach ($jadwals as $hcari) {
					if ($idne == ''){ $idne = 'id1'; }
					else { $idne = $hcari->id; }
					$mulai				= $hcari->mulai;
					$akhir				= $hcari->akhir;
					$suratpermohonan	= $hcari->suratpermohonan;
					if ($mulai == '0000-00-00 00:00:00' OR is_null($mulai)){ $mulai = $hcari->created_at; }
					if ($akhir == '0000-00-00 00:00:00' OR is_null($akhir)){ $akhir = $hcari->updated_at; }
					if ($suratpermohonan == ''){
						$alamatweb	= '<span class="btn btn-lg badge badge-info">Tanpa File Upload</span>';
					} else {
						$alamatweb	= '<a href="'.$suratpermohonan.'" target="_blank"><span class="btn btn-lg badge badge-success">Download</span></a>';
					}
					$tombol 		= '
										<div class="row">
											<div class="col-lg-12">
												<table>
													<tr><td>Waktu Mulai / AKhir</td><td>'.$mulai.'</td><td>'.$akhir.'</td></tr>
													<tr><td>Ruang</td><td colspan="2">'.$hcari->ruang.'</td></tr>
													<tr><td>Agenda</td><td colspan="2">'.$hcari->keperluan.'</td></tr>
													<tr><td>Keterangan</td><td colspan="2">'.$hcari->keterangan.'</td></tr>
													<tr><td colspan="3">'.$alamatweb.'</td></tr>
												</table>
											</div>
										</div>';
					if ($akhir == '0000-00-00 00:00:00' OR is_null($akhir)){
						$mulai		= strtotime($mulai);
						$mulai		= $hcari->mulai;
						$tambah		= ' + 360 second';
						$akhir		= date('Y-m-d H:i:s',strtotime($tambah,strtotime($mulai)));
						Jadwal::where('id', $hcari->id)->update([
							'mulai'		=> $mulai,
							'akhir'		=> $akhir
						]);
					}
					$data[] 	= array(
						'id' 			=> $idne,
						'description' 	=> $hcari->keterangan,
						'location' 		=> $hcari->gedung,
						'subject' 		=> $filter.'<br />'.$tombol,
						'calendar' 		=> $filter,
						'start' 		=> $hcari->mulai,
						'end'			=> $akhir,
					);
				}
			}		
		} else {
			if ($tmulai == 'now'){
				$jadwals   	= Jadwal::where('mulai', '>=', Carbon::yesterday())
								->where('jenisjadwal', '!=', '0')
								->orderBy('mulai', 'DESC')
								->orderBy('gedung', 'ASC')
								->orderBy('ruang', 'ASC')
								->get();
			} else {
				if ($jenis == 'Pimpinan'){
					$nip		= $request->val03;
					$nip		= preg_replace('/\s+/', '', $nip);
					$getpjbt	= Pejabatsurat::where('nip', $nip)->orderBy('updated_at', 'DESC')->first();
					if (isset($getpjbt->pejabat)){
						$pimpinan 	= $getpjbt->pejabat;
						$nmpimpinan	= $getpjbt->nama;
						$jadwals 	= Jadwal::whereIn('inputor', [ Session('nama'), $nmpimpinan])->orWhere('peminjam', 'LIKE', $pimpinan)->where('created_at', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->get();
					} else {
						$pimpinan = '';
						$jadwals 	= Jadwal::where('inputor', 'LIKE', Session('nama'))->orWhere('peminjam', 'LIKE', Session('jabatan'))->where('created_at', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->get();
					}
					$idne 		= 'id1';
				} else if ($jenis == 'Pribadi'){
					$mnama		= Session('nama');
					$jadwals 	= Jadwal::WhereIn('peminjam', [Session('jabatan'), Session('nama')])->where('mulai', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->get();
					$idne 		= 'id1';
				} else {
					$arraymulai		= explode(" ", $tmulai);
					$dmulai 		= $arraymulai[0];
					if (isset($arraymulai[2])){
						$jmulai 		= $arraymulai[1];
						$cmulai 		= $arraymulai[2];
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
							$hhmulai 	= $hhmulai + 12;
							$mulai 		= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
						}
					}
					$arrayselesai	= explode(" ", $tselesai);
					if (isset($arrayselesai[2])){
						$dselesai 		= $arrayselesai[0];
						$jselesai 		= $arrayselesai[1];
						$cselesai 		= $arrayselesai[2];
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
							$hhselesai 	= $hhselesai + 12;
							$akhir 		= $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
						}
					}
					if ($jenis == 'Ruang'){
						if ($lokasi == 'All'){
							if ($nama == 'All'){
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '1')
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							} else {
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '1')
									->where('ruang', 'LIKE', $nama)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							}
						} else {
							if ($nama == 'All'){
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '1')
									->where('gedung', 'LIKE', $lokasi)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							} else {
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '1')
									->where('gedung', 'LIKE', $lokasi)
									->where('ruang', 'LIKE', $nama)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							}
						}
					} else if ($jenis == 'Kendaraan'){
						if ($lokasi == 'All'){
							if ($nama == 'All'){
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '2')
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							} else {
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '2')
									->where('ruang', 'LIKE', $nama)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							}
						} else {
							if ($nama == 'All'){
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '2')
									->where('gedung', 'LIKE', $lokasi)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							} else {
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '2')
									->where('gedung', 'LIKE', $lokasi)
									->where('ruang', 'LIKE', $nama)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							}
						}
					} else {
						if ($lokasi == 'All'){
							if ($nama == 'All'){
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '!=', '0')
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							} else {
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '!=', '0')
									->where('ruang', 'LIKE', $nama)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							}
						} else {
							if ($nama == 'All'){
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '!=', '0')
									->where('gedung', 'LIKE', $lokasi)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							} else {
								$jadwals   	= Jadwal::where('mulai', '>', $mulai)
									->where('akhir', '<', $akhir)
									->where('jenisjadwal', '!=', '0')
									->where('gedung', 'LIKE', $lokasi)
									->where('ruang', 'LIKE', $nama)
									->orderBy('mulai', 'DESC')
									->orderBy('gedung', 'ASC')
									->orderBy('ruang', 'ASC')
									->get();
							}
						}
					}
				}
			}
			if (!empty($jadwals)){
				foreach ($jadwals as $hcari) {
					if ($jenis == 'Pribadi' OR $jenis == 'Pimpinan'){
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$keperluan	= $hcari->keperluan;
						$mulai		= $hcari->mulai;
						$akhir		= $hcari->akhir;
						$filter		= $hcari->jenisjadwal;
						if ($filter == '1'){
							$filter = 'Peminjaman Ruang';
							$tombol = '<br /><a href="'.$homebase.'/batalpermohonan/'.$hcari->id.'" target="_blank"><span class="badge badge-danger">Link Pembatalan Peminjaman Ruang</span></a><br /><a href="'.$homebase.'/akhirkegiatan/'.$hcari->id.'" target="_blank"><span class="badge badge-success">Akhiri Kegiatan</span></a>';
						} else if ($filter == '2'){
							$filter = 'Peminjaman Kendaraan';	
							$tombol = '<br /><a href="'.$homebase.'/batalpermohonan/'.$hcari->id.'" target="_blank"><span class="badge badge-danger">Link Pembatalan Peminjaman Kendaraan</span></a><br /><a href="'.$homebase.'/akhirkegiatan/'.$hcari->id.'" target="_blank"><span class="badge badge-success">Akhiri Kegiatan</span></a>';
						} else if ($filter == '3'){
							$filter = 'Peminjaman Gedung / Lapangan';	
							$tombol = '<br /><a href="'.$homebase.'/batalpermohonan/'.$hcari->id.'" target="_blank"><span class="badge badge-danger">Link Pembatalan Peminjaman Gedung/Lapangan</span></a><br /><a href="'.$homebase.'/akhirkegiatan/'.$hcari->id.'" target="_blank"><span class="badge badge-success">Akhiri Kegiatan</span></a>';
						} else {
							$filter = 'Tamu';
							$tombol = '';
						}
						if ($mulai == '0000-00-00 00:00:00'){ $mulai = $hcari->created_at; }
						if ($akhir == '0000-00-00 00:00:00'){ $akhir = $hcari->updated_at; }
						$mulai		= strtotime($mulai);
						if ($akhir == '0000-00-00 00:00:00' OR is_null($akhir)){
							$mulai		= $hcari->mulai;
							$tambah		= ' + 360 second';
							$akhir		= date('Y-m-d H:i:s',strtotime($tambah,strtotime($mulai)));
						}
										
						$keperluan	= str_replace('Tamu dari','<br />Tamu dari :',$keperluan);
						$keperluan	= str_replace('Bernama','<br />Nama :',$keperluan);
						$keperluan	= str_replace('ingin menemui anda, dengan keperluan','<br />Keperluan :',$keperluan);
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->keterangan,
							'location' 		=> $hcari->gedung,
							'subject' 		=> $keperluan.'<br />'.$tombol,
							'calendar' 		=> $filter,
							'start' 		=> $hcari->mulai,
							'end'			=> $akhir,
						);
						
					} else {
						$gedung 	= $hcari->gedung;
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->ruang,
							'location' 		=> $hcari->gedung,
							'subject' 		=> $hcari->keperluan.'<br /> PJ : '.$hcari->peminjam.'<br /> Lokasi : '.$hcari->ruang.' ( '.$hcari->gedung.' )<br />Keterangan : '.$hcari->keterangan,
							'calendar' 		=> $hcari->ruang,
							'start' 		=> $hcari->mulai,
							'end'			=> $hcari->akhir,
						);
					}
				}
			}
			if ($nip != ''){
				$getjadwal = Antrian::where('dos2', $nip)->whereIn('kodjenis', ['Nilai Ujian', 'Persetujuan Komisi Pembimbing Skripsi', 'Persetujuan Komisi Pembimbing Tesis', 'Persetujuan Komisi Pembimbing Disertasi', 'Persetujuan'])->orderBy('bulan', 'ASC')->get();
				if (!empty($getjadwal)){
					foreach ($getjadwal as $jadwals){
						$idujian 		= $jadwals->ket;
						$cekkeberadaan 	= AntrianUjian::where('id', $idujian)->first();
						if (isset($cekkeberadaan->id)){
							//$tanggal	= $cekkeberadaan->bulan;
							$tanggal 	= date("Y-m-d");
							if ($jadwals->kodjenis == 'Nilai Ujian'){
								$cekujian	= AntrianUjian::where('id', $jadwals->ket)->first();
								if (isset($cekujian->id)){
									$predikat 	= $cekujian->predikat;
									if ($predikat == 'Lulus' OR $cekujian->marking == 'arsip'){

									} else {
										$keperluan 	= $jadwals->kodjenis.' '.$cekkeberadaan->jenis.' an. '.$cekkeberadaan->nama.' <br />Prodi/Jenjang : '.$cekkeberadaan->pees.'/'.$cekkeberadaan->jenjang.'<br />Pelaksanaan : '.$jadwals->bulan.' '.$jadwals->pada;
										$datadukung = '<br /><a href="'.$homebase.'/penilaianujian/'.$jadwals->id.'" target="_blank"><span class="label bg-blue">CLICK TOMBOL BERIKUT UNTUK LEBIH DETAIL</span></a>';
										$keperluan	= $keperluan.$datadukung;
										$data[] 	= array(
											'id' 			=> $cekujian->id,
											'calendar' 		=> $cekkeberadaan->jenjang.' '.$cekkeberadaan->pees,
											'location' 		=> $cekkeberadaan->fakultas,
											'subject' 		=> $keperluan,
											'description' 	=> $jadwals->kodjenis,
											'start' 		=> $tanggal.' 08:00:00',
											'end'			=> $tanggal.' 09:00:00',
										);
									}
								}
							} else {
								if ($jadwals->whatfor2 == null OR $jadwals->whatfor2 == ''){
									$keperluan 	= $jadwals->kodjenis.' '.$cekkeberadaan->jenis.' an. '.$cekkeberadaan->nama.' <br />Prodi/Jenjang : '.$cekkeberadaan->pees.'/'.$cekkeberadaan->jenjang.'<br />Pelaksanaan : '.$jadwals->bulan.' '.$jadwals->pada;
									$datadukung = '<br /><a href="'.$homebase.'/pleasesign/'.$jadwals->id.'" target="_blank"><span class="label bg-green">CLICK TOMBOL BERIKUT UNTUK LEBIH DETAIL</span></a>';
									$keperluan	= $keperluan.$datadukung;
									$data[] 	= array(
										'id' 			=> $cekkeberadaan->id,
										'calendar' 		=> $cekkeberadaan->jenjang.' '.$cekkeberadaan->pees,
										'location' 		=> $cekkeberadaan->fakultas,
										'subject' 		=> $keperluan,
										'description' 	=> $jadwals->kodjenis,
										'start' 		=> $tanggal.' 08:00:00',
										'end'			=> $tanggal.' 09:00:00',
									);
									
								}
							}
						}
					}
				}
				$getkuliah = Dosen::where('nip', $nip)->get();
				if (!empty($getkuliah)){
					foreach ($getkuliah as $rdosen){
						$iddosen 		= $rdosen->id;
						$getkuliahs   	= Jadwalkuliah::where('mulai', '>=', Carbon::yesterday())->where('iddosen', $iddosen)->get();
						if (!empty($getkuliahs)){
							foreach ($getkuliahs as $rkampus){
								$data[] 	= array(
									'id' 			=> $rkampus->id,
									'description' 	=> 'Perkuliahan '.$rkampus->fakultas,
									'location' 		=> $rkampus->ruang,
									'subject' 		=> 'Perkuliahan Matakuliah : '.$rkampus->namamk.' <br />Kelas : '.$rkampus->siam.' <br />Ruang : '.$rkampus->ruang.'<br />Fakultas '.$rkampus->fakultas,
									'calendar' 		=> 'Perkuliahan '.$rkampus->fakultas,
									'start' 		=> $rkampus->mulai,
									'end'			=> $rkampus->akhir,
								);
							}
						}
					}
				}
				if (is_null($email) OR $email == ''){
					$email 	= Session('email');
				}
				$jadwals 	= Jadwal::where('peminjam', $email)->where('mulai', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->get();
				if (!empty($jadwals)){
					foreach ($jadwals as $hcari) {
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$keperluan	= $hcari->keperluan;
						$mulai		= $hcari->mulai;
						$akhir		= $hcari->akhir;
						if ($mulai == '0000-00-00 00:00:00'){ 
							$mulai = $hcari->created_at;
							Jadwal::where('id', $hcari->id)->update([
								'mulai'	=> $mulai,
							]);
						}
						if ($akhir == '0000-00-00 00:00:00'){ $akhir = $hcari->updated_at; }
						$mulai		= strtotime($mulai);
						if ($akhir == '0000-00-00 00:00:00' OR is_null($akhir)){
							$tambah		= ' + 360 second';
							$akhir		= date('Y-m-d H:i:s',strtotime($tambah,$mulai));
							Jadwal::where('id', $hcari->id)->update([
								'akhir'	=> $akhir,
							]);
						}
						if ($hcari->keterangan == 'Meeting' OR $hcari->keterangan == 'Undangan Elektronik'){
							$url2 = $homebase.'/presentform/'.$hcari->inputor;
							$keperluan = $keperluan.'<p> </p><a href="'.$url2.'"><span class="pull-right badge bg-green">Link Presensi</span></a>';
						}
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->keterangan,
							'location' 		=> $hcari->instansi,
							'subject' 		=> $keperluan,
							'calendar' 		=> $hcari->gedung,
							'start' 		=> $hcari->mulai,
							'end'			=> $akhir,
						);
						
					
					}
				}
			}
			if ($idne == ''){
				if ($jenis == 'Ruang'){
					if ($lokasi == 'All'){
						if ($nama == 'All'){
							$jadwals   	= Ruang::where('pinjam', 'Umum')->orderBy('namagd', 'ASC')->orderBy('namarg', 'ASC')->get();
						} else {
							$jadwals   	= Ruang::where('pinjam', 'Umum')->where('namagd', 'LIKE', $lokasi)->orderBy('namagd', 'ASC')->orderBy('namarg', 'ASC')->get();
						}
					} else {
						if ($nama == 'All'){
							$jadwals   	= Ruang::where('pinjam', 'Umum')->where('namagd', 'LIKE', $lokasi)->orderBy('namagd', 'ASC')->orderBy('namarg', 'ASC')->get();
						} else {
							$jadwals   	= Ruang::where('pinjam', 'Umum')->where('namagd', 'LIKE', $lokasi)->where('namarg', 'LIKE', $nama)->orderBy('namagd', 'ASC')->orderBy('namarg', 'ASC')->get();
						}
					}
					foreach ($jadwals as $hcari) {
						$mulai		= date('Y-m-d H:i:s');
						$tambah		= ' + 360 second';
						$akhir		= date('Y-m-d H:i:s',strtotime($tambah,strtotime($mulai)));
						$tulis 		= 'No Activity On '.$hcari->namarg.' ( '.$hcari->namagd.' )';
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->namarg,
							'location' 		=> $hcari->namagd,
							'subject' 		=> $tulis,
							'calendar' 		=> $hcari->namarg,
							'start' 		=> $mulai,
							'end'			=> $akhir,
						);
					}
				} else if ($jenis == 'Kendaraan'){
					if ($lokasi == 'All'){
						if ($nama == 'All'){
							$jadwals   	= Kendaraan::where('pinjam', 'Umum')->orderBy('garasi', 'ASC')->orderBy('merek', 'ASC')->get();
						} else {
							$jadwals   	= Kendaraan::where('pinjam', 'Umum')->where('garasi', 'LIKE', $lokasi)->orderBy('garasi', 'ASC')->orderBy('merek', 'ASC')->get();
						}
					} else {
						if ($nama == 'All'){
							$jadwals   	= Kendaraan::where('pinjam', 'Umum')->where('garasi', 'LIKE', $lokasi)->orderBy('garasi', 'ASC')->orderBy('merek', 'ASC')->get();
						} else {
							$jadwals   	= Kendaraan::where('pinjam', 'Umum')->where('garasi', 'LIKE', $lokasi)->where('merek', 'LIKE', $nama)->orderBy('garasi', 'ASC')->orderBy('merek', 'ASC')->get();
						}
					}
					foreach ($jadwals as $hcari) {
						$mulai		= date('Y-m-d H:i:s');
						$tambah		= ' + 360 second';
						$akhir		= date('Y-m-d h:i:s',strtotime($tambah,strtotime($mulai)));
						$tulis 		= 'No Activity On '.$hcari->merek.' ( '.$hcari->garasi.' )';
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->merek,
							'location' 		=> $hcari->garasi,
							'subject' 		=> $tulis,
							'calendar' 		=> $hcari->merek,
							'start' 		=> $mulai,
							'end'			=> $akhir,
						);
					}
				} else {
					$jadwals   	= Ruang::where('pinjam', 'Umum')->orderBy('namagd', 'ASC')->orderBy('namarg', 'ASC')->get();
					foreach ($jadwals as $hcari) {
						$mulai		= date('Y-m-d H:i:s');
						$tambah		= ' + 360 second';
						$akhir		= date('Y-m-d h:i:s',strtotime($tambah,strtotime($mulai)));
						$tulis 		= 'No Activity On '.$hcari->namarg.' ( '.$hcari->namagd.' )';
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->namarg,
							'location' 		=> $hcari->namagd,
							'subject' 		=> $tulis,
							'calendar' 		=> $hcari->namarg,
							'start' 		=> $mulai,
							'end'			=> $akhir,
						);
					}
					$jadwals   	= Kendaraan::where('pinjam', 'Umum')->orderBy('garasi', 'ASC')->orderBy('merek', 'ASC')->get();
					foreach ($jadwals as $hcari) {
						$mulai		= date('Y-m-d H:i:s');
						$tambah		= ' + 360 second';
						$akhir		= date('Y-m-d H:i:s',strtotime($tambah,strtotime($mulai)));
						$tulis 		= 'No Activity On '.$hcari->merek.' ( '.$hcari->garasi.' )';
						if ($idne == ''){ $idne = 'id1'; }
						else { $idne = $hcari->id; }
						$data[] 	= array(
							'id' 			=> $idne,
							'description' 	=> $hcari->merek,
							'location' 		=> $hcari->garasi,
							'subject' 		=> $tulis,
							'calendar' 		=> $hcari->merek,
							'start' 		=> $mulai,
							'end'			=> $akhir,
						);
					}
				}
			}
			$jadwals 	= WebinarEventlist::where('pembicara', 'UNDANGANDIGITAL')->where('created_by', Session('email'))->where('mulai', '>=', Carbon::now()->subDays(1)->toDateTimeString())->orderBy('mulai', 'ASC')->get();
			if (!empty($jadwals)){
				foreach ($jadwals as $hcari) {
					$start 		= date("Y-m-d H:i",strtotime($hcari->mulai));
					$end 		= date("Y-m-d H:i",strtotime($hcari->akhir));
					if ($idne == ''){ $idne = 'id1'; }
					else { $idne = $hcari->id; }
					$urle		= $homebase.'/register/'.$hcari->id;
					$url2		= $homebase.'/hadir/'.$hcari->id;
					$url3		= $homebase.'/cetaklinkpresensi/'.$hcari->id;
					$tulisan 	= '<table  cellspacing="3" cellpadding="3"><tr><td colspan="2">'.$hcari->nama.'</td></tr><tr><td>Tempat</td><td>'.$hcari->tempat.'</td></tr><tr><td>Link Registrasi</td><td><a href="'.$urle.'"><span class="pull-right badge bg-red">REGISTER NOW</span></a></td></tr><tr><td>Link Presensi</td><td><a href="'.$url2.'"><span class="pull-right badge bg-green">Click and Share</span></a></td></tr><tr><td>Cetak QrCode Link Presensi</td><td><a href="'.$url3.'" target="_blank"><span class="pull-right badge bg-magenta">Click and Print</span></a></td></tr></table>';
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
			}
			if ($idne == '' OR $idne == 0 OR $idne == 'id1'){
				$idne = 0;
			}
		}
		$tanggal 	= date("Y-m-d");
		$mulai		= date("Y-m-d H:i:s");
		$mulai		= strtotime($mulai);
		$tambah		= ' + 3600 second';
		$akhir		= date('Y-m-d H:i:s',strtotime($tambah,$mulai));
				
		$getpermohonan = Penerimasurat::where('jenis', 'KONTRAK')->where('penulisan', Session('email'))->where('status', 'SEND')->get();
		if (!empty($getpermohonan)){
			foreach($getpermohonan as $hcari){
				$url	 	= $homebase.'/ttdberkas/keluar-'.$hcari->idsurat;
				$keperluan 	= '<p> </p><a href="'.$url.'"><span class="pull-right badge bg-green">'.$hcari->keterangan.'</span></a>';
				$data[] 	= array(
					'id' 			=> $idne,
					'description' 	=> $hcari->perihal,
					'location' 		=> $hcari->asalsurat,
					'subject' 		=> $keperluan,
					'calendar' 		=> $hcari->jenis,
					'start' 		=> date("Y-m-d H:i:s"),
					'end'			=> $akhir,
				);
				if ($idne == '' OR $idne == 0 OR $idne == 'id1'){
					$idne = 1;
				} else {
					$idne++;
				}
			}
		}
		$data[] 	= array(
			'id' 			=> 'id1',
			'description' 	=> Session('email'),
			'location' 		=> 'Welcome',
			'subject' 		=> '-',
			'calendar' 		=> 'Welcome Note',
			'start' 		=> date("Y-m-d H:i:s"),
			'end'			=> $akhir,
		);
    	echo json_encode($data);
	}
    public function store(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'id_ruang'    		=>  'required', 
            'id_namapeminjam'  	=>  'required',
			'id_kegiatan'  		=>  'required',
			'id_tglmulai'  		=>  'required',
            'id_tglselesai'    	=>  'required',
			'id_jammulai'    	=>  'required',
			'id_jamselesai'    	=>  'required',
        ]);

        if ($validator->fails()) {
            Session::flash('status', 'Error');
            Session::flash('message', 'Form harap diisi semua'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $idruang    	= $request->input('id_ruang');
            $peminjam  		= $request->input('id_namapeminjam');
			$keperluan  	= $request->input('id_kegiatan');
			$dmulai  		= $request->input('id_tglmulai');
            $dselesai    	= $request->input('id_tglselesai');
			$tmulai  		= $request->input('id_jammulai');
            $tselesai    	= $request->input('id_jamselesai');
            $keterangan		= $request->input('id_sarpras');
			$idne  			= $request->input('id_idne');
			$biaya 			= $request->input('id_biaya');
			if ($biaya != ''){ $biaya = str_replace(',','',$biaya); }
			else { $biaya = 0; }
			$arraymulai		= explode(" ", $tmulai);
			$jmulai 		= $arraymulai[0];
			$cmulai 		= $arraymulai[1];
			$arrayjmulai	= explode(":", $jmulai);
			$hhmulai		= (int)$arrayjmulai[0];
			$mmmulai		= $arrayjmulai[1];
			if ($cmulai == 'AM'){
				if ($hhmulai < 10){
					$mulai = $dmulai.' 0'.$hhmulai.':'.$mmmulai.':00';
				}else {
					$mulai = $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
				}
			} else {
				$hhmulai 	= $hhmulai + 12;
				$mulai 		= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
			}
			if ($tselesai == $tmulai AND $dmulai == $dselesai){
				$akhir			= $dmulai.' 23:59:00';
			} else {
				$arrayselesai	= explode(" ", $tselesai);
				$jselesai 		= $arrayselesai[0];
				$cselesai 		= $arrayselesai[1];
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
					$hhselesai 	= $hhselesai + 12;
					$akhir 		= $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
				}
			}
			if ($keterangan == ''){ $keterangan = '-'; }
			$fakpanjang	= Session('fakpanjang');
			if ($idne == 'new'){
				if ($idruang == '-'){
					Jadwal::create([
						'jenisjadwal'      	=>  '0',
						'ruang'         	=>  '',
						'gedung'         	=>  '',
						'mulai'    			=>  $mulai,
						'akhir'     		=>  $akhir,
						'peminjam'      	=>  $peminjam,
						'keperluan'     	=>  $keperluan,
						'keterangan'		=>  $keterangan,
						'suratpermohonan'	=>  '',
						'inputor' 			=>  Session('nama'),
						'biaya' 			=>  $biaya,
						'fakultas'			=> 	Session('fakultas'),
						'fakpanjang'		=> 	Session('fakpanjang')
					]);
					$tuliskirim = 'Schedule Add at '.$mulai.', '.$keperluan.' Created By '.Session('nama');
					$jtokencari	= Firebasebank::where('jabatan', $peminjam)->get();
					if (!empty($jtokencari)){
						foreach ( $jtokencari as $rtokencari ){
							$firebaseid = $rtokencari->firebase;
							$msg = array (
								'message' 	=> $tuliskirim,
								'title'		=> 'SCO',
								'subtitle'	=> 'Universitas Brawijaya',
								'tickerText'=> 'Schedule',
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
								'Authorization: key=' . API_ACCESS_KEY3,
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
					Session::flash('status', 'Success');
					Session::flash('message', 'Scheduling Saved..!!'); 
					Session::flash('alert-class', 'alert-success');
				}else {
					$data   		= Ruang::where('id', $idruang)->first();
					$namarg 		= $data->namarg;
					$namagd 		= $data->namagd;
					$sudahblm   	= Jadwal::where('ruang', $namarg)
									->where(function ($query) use ($mulai, $akhir) {
										$query->where(function ($q) use ($mulai, $akhir) {
											$q->where('mulai', '>=', $mulai)
											   ->where('mulai', '<', $akhir);
										})->orWhere(function ($q) use ($mulai, $akhir) {
											$q->where('mulai', '<=', $mulai)
											   ->where('akhir', '>', $akhir);
										})->orWhere(function ($q) use ($mulai, $akhir) {
											$q->where('akhir', '>', $mulai)
											   ->where('akhir', '<=', $akhir);
										})->orWhere(function ($q) use ($mulai, $akhir) {
											$q->where('mulai', '>=', $mulai)
											   ->where('akhir', '<=', $akhir);
										});
									})->count();
					if ($sudahblm != 0) {
						Session::flash('status', 'Crash');
						Session::flash('message', 'Rooms : '.$namarg.' is Reserved on range, Please select another rooms or date.'); 
						Session::flash('alert-class', 'alert-danger');

						return back();
					} else {
						if ($request->hasFile('file')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:jpeg,jpg,pdf|max:5000'
							]);

							if ($validator->fails()) {
								Session::flash('status', 'Error');
								Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 5mb.'); 
								Session::flash('alert-class', 'alert-danger');

								return back();
							} else {
								$namafile 		= $mulai.$namarg.$peminjam;
								$namafile		= md5($namafile);
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								$request->file->move(public_path('scan/files'), $namafile);
								$inputor		= Session('nama');
								
								Jadwal::create([
									'jenisjadwal'      	=>  '1',
									'ruang'         	=>  $namarg,
									'gedung'         	=>  $namagd,
									'mulai'    			=>  $mulai,
									'akhir'     		=>  $akhir,
									'peminjam'      	=>  $request->input('id_namapeminjam'),
									'keperluan'     	=>  $keperluan,
									'keterangan'		=>  $keterangan,
									'suratpermohonan'	=>  $namafile,
									'inputor' 			=>  $inputor,
									'biaya' 			=>  $biaya,
									'fakultas'			=> 	Session('fakultas'),
									'fakpanjang'		=> 	Session('fakpanjang')
								]);
								
							}
							Session::flash('status', 'Success');
							Session::flash('message', 'Scheduling Saved..!!'); 
							Session::flash('alert-class', 'alert-success');
						} else {
							$inputor	= 	Session('nama');
							Jadwal::create([
								'jenisjadwal'      	=>  '1',
								'ruang'         	=>  $namarg,
								'gedung'         	=>  $namagd,
								'mulai'    			=>  $mulai,
								'akhir'     		=>  $akhir,
								'peminjam'      	=>  $request->input('id_namapeminjam'),
								'keperluan'     	=>  $keperluan,
								'keterangan'		=>  $keterangan,
								'suratpermohonan'	=>  '',
								'inputor' 			=>  $inputor,
								'biaya' 			=>  $biaya,
								'fakultas'			=> 	Session('fakultas'),
								'fakpanjang'		=> 	Session('fakpanjang')
							]);

							Session::flash('status', 'Success');
							Session::flash('message', 'Scheduling Saved..!!'); 
							Session::flash('alert-class', 'alert-success');
						}
					}
				}
			} else {
				$data   		= Ruang::where('id', $idruang)->first();
				$namarg 		= $data->namarg;
				$namagd 		= $data->namagd;
				$sudahblm   	= Jadwal::where('ruang', $namarg)
								->where('id', '!=', $idne)
								->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('mulai', '>=', $mulai)
										   ->where('mulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('mulai', '<=', $mulai)
										   ->where('akhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('akhir', '>', $mulai)
										   ->where('akhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('mulai', '>=', $mulai)
										   ->where('akhir', '<=', $akhir);
									});
								})->count();
				if ($sudahblm != 0) {
					Session::flash('status', 'Crash');
					Session::flash('message', 'Rooms : '.$namarg.' is Reserved on range, Please select another rooms or date.'); 
					Session::flash('alert-class', 'alert-danger');

					return back();
				} else {
					$datalm   		= Jadwal::where('id', $idne)->first();
					$nmfilelm		= $datalm->suratpermohonan;
					if ($nmfilelm != ''){
						if (File::exists(base_path()) ."/public/scan/files/". $datalm->suratpermohonan) {
						  File::delete(base_path() ."/public/scan/files/". $datalm->suratpermohonan);
						}
					}
					if ($request->hasFile('file')) {
						$validator = Validator::make($request->all(), [
							'file' =>  'mimes:jpeg,jpg,pdf|max:5000'
						]);

						if ($validator->fails()) {
							Session::flash('status', 'Error');
							Session::flash('message', 'File harus sesuai format dan tidak melebihi dari 5mb.'); 
							Session::flash('alert-class', 'alert-danger');

							return back();
						} else {
							$namafile 		= $mulai.$namarg.$peminjam;
							$namafile		= md5($namafile);
							$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
							$request->file->move(public_path('scan/files'), $namafile);
							$inputor	= 	Session('nama');
							Jadwal::where('id', $idne)->update([
								'ruang'         	=>  $namarg,
								'gedung'         	=>  $namagd,
								'mulai'    			=>  $mulai,
								'akhir'     		=>  $akhir,
								'peminjam'      	=>  $request->input('id_namapeminjam'),
								'keperluan'     	=>  $keperluan,
								'keterangan'		=>  $keterangan,
								'suratpermohonan'	=>  $namafile,
								'inputor' 			=>  $inputor,
								'biaya' 			=>  $biaya,
								'fakultas'			=> 	Session('fakultas'),
								'fakpanjang'		=> 	Session('fakpanjang')
							]);
							
						}
						Session::flash('status', 'Success');
						Session::flash('message', 'Scheduling Updated..!!'); 
						Session::flash('alert-class', 'alert-success');
					} else {
						$inputor	= 	Session('nama');
						Jadwal::where('id', $idne)->update([
							'ruang'         	=>  $namarg,
							'gedung'         	=>  $namagd,
							'mulai'    			=>  $mulai,
							'akhir'     		=>  $akhir,
							'peminjam'      	=>  $request->input('id_namapeminjam'),
							'keperluan'     	=>  $keperluan,
							'keterangan'		=>  $keterangan,
							'suratpermohonan'	=>  '',
							'inputor' 			=>  $inputor,
							'biaya' 			=>  $biaya,
							'fakultas'			=> 	Session('fakultas'),
							'fakpanjang'		=> 	Session('fakpanjang')
						]);

						Session::flash('status', 'Success');
						Session::flash('message', 'Scheduling Updated..!!'); 
						Session::flash('alert-class', 'alert-success');
					}
				}
			}
            return back();
        }
    }
    public function hapus(Request $request) {
    	$idne       = $request->id;
		$jenis      = $request->jenis;
		if (isset($jenis) AND $jenis == 'akhiri'){
			$update   	= Jadwal::where('id', $idne)->update([
				'tglakhir'		=> date("Y-m-d"),
				'jamakhir'		=> date("H:i:s"),
				'akhir'			=> date("Y-m-d H:i:s"),
				'keterangan'	=> $request->pesan,
				'status'		=> 'ARSIP'
			]);
			if ($update){
				$datalm   	= Jadwal::where('id', $idne)->first();
				$nmfilelm	= $datalm->suratpermohonan;
				$buktibayar	= $datalm->buktibayar;
				if ($nmfilelm != ''){
					if (File::exists(base_path()) ."/public/scan/files/". $datalm->suratpermohonan) {
						File::delete(base_path() ."/public/scan/files/". $datalm->suratpermohonan);
					}
				}
				if ($buktibayar != ''){
					if (File::exists(base_path()) ."/public/scan/files/". $datalm->buktibayar) {
						File::delete(base_path() ."/public/scan/files/". $datalm->buktibayar);
					}
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Jadwal di Ruang '.$datalm->ruang.' Tanggal '.$datalm->mulai.' Berhasil di Arsipkan']);
			
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' => 'Data Tidak Valid']);
			}
		} else {
			$datalm   	= Jadwal::where('id', $idne)->first();
			$nmfilelm	= $datalm->suratpermohonan;
			$buktibayar	= $datalm->buktibayar;
			$getmarking = explode(".", $nmfilelm);
			$marking	= $getmarking[0];
			if ($nmfilelm != ''){
				if (File::exists(base_path()) ."/public/scan/files/". $datalm->suratpermohonan) {
				File::delete(base_path() ."/public/scan/files/". $datalm->suratpermohonan);
				}
			}
			if ($buktibayar != ''){
				if (File::exists(base_path()) ."/public/scan/files/". $datalm->buktibayar) {
				File::delete(base_path() ."/public/scan/files/". $datalm->buktibayar);
				}
			}
			$deldata   	= Jadwal::where('id', $idne)->delete();
			if ($deldata){
				Suratmasuk::where('marking', $marking)->delete();
				Inboxsurat::insert([
					'marking'  		=>  $marking,
					'pengirim'  	=>  \Request::ip(),
					'penerima'		=>  'Kotak Sampah',
					'status'		=>  'reply',
					'sifat'			=>  5,
					'jenis'			=>  'MASUK',
					'kerja'			=>  'DISPOSISI',
					'catatan'		=>  'Di Batalkan Pada '.date("Y-m-d H:i:s"),
					'tandatangan'	=>  '',
					'tanggal'		=>  '',
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Jadwal di Ruang '.$datalm->ruang.' Tanggal '.$datalm->mulai.' Berhasil di Hapus']);
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' => 'Data Tidak Valid']);
			}
		}
    }
	public function exArsippeminjaman(Request $request) {
    	$idne       = $request->val01;
		$update   	= Jadwal::where('id', $idne)->update([
			'status' => 'ARSIP'
		]);
        if ($update){
			$datalm   = Jadwal::where('id', $idne)->first();
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Jadwal di Ruang '.$datalm->ruang.' Tanggal '.$datalm->mulai.' Berhasil di Arsipkan']);
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' => 'Data Tidak Valid']);
		}
    }
	public function expinjamTamu(Request $request) {
        $idygdipinjem   = $request->input('val02');
		$peminjam  		= $request->input('val03');
		$unitkerja  	= $request->input('val04');
		$email  		= $request->input('val05');
		$hape    		= $request->input('val06');
		$dmulai  		= $request->input('val07');
		$tmulai    		= $request->input('val08');
		$dselesai		= $request->input('val09');
		$tselesai  		= $request->input('val10');
		$keterangan 	= $request->input('val11');
		$jenis 			= $request->input('val12');
		$idne 			= $request->input('val13');	
		$keperluan		= $request->input('val14');
		$biaya			= 0;
		$pjgedung 		= ''; 
		$viewruang 		= $idygdipinjem;
		$viewgedung		= $jenis;
		$arraymulai		= explode(" ", $tmulai);
		$jmulai 		= $arraymulai[0];
		$cmulai 		= $arraymulai[1];
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
		$cselesai 		= $arrayselesai[1];
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
		$from     		=   Carbon::createFromFormat('Y-m-d H:s:i', $mulai);
		$to     		=   Carbon::createFromFormat('Y-m-d H:s:i', $akhir);
		$hari 			= 	$from->diffInDays($to);
		if ($hari == 0){ $hari = 1; }
		if ($keterangan == ''){ $keterangan = '-'; }
		$perihal		= 'Permohonan Peminjaman '.$jenis.' oleh '.$peminjam;
		if (Session('nama') !== null){
			$inputor 	= Session('nama');
		} else {
			$inputor 	= $peminjam;
		}
		if ($idne == 'new'){
			if ($jenis == 'ruang'){
				$jenisjadwal= '1';
				$getgedung	= Ruang::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= $getgedung->namarg;
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('jenisjadwal', $jenisjadwal)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else if ($jenis == 'mobil'){
				$jenisjadwal= '2';
				$getgedung	= Kendaraan::where('id', $idygdipinjem)->first();
				if (isset($getgedung->garasi)){
					$viewruang 	= $getgedung->merek;
					$viewgedung	= $getgedung->nopol;
					$gedung 	= $getgedung->garasi;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('jenisjadwal', $jenisjadwal)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else {
				$jenisjadwal= '3';
				$getgedung	= Gedung::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= 'ALL';
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= 'ALL';
				$gedung		= $idygdipinjem;
				$sudahblm   = Jadwal::where('gedung', $idygdipinjem)
					->where('ruang', 'ALL')
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			}
			if ($sudahblm != 0) {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Crash Jadwal Untuk '.$viewruang.' '.$viewgedung.' Pada '.$mulai.' s/d '.$akhir.', untuk mengetahui jadwal yang sudah masuk, mohon klik "Lihat Jadwal" di kolom Ruang/Kendaraan/Gedung yang akan anda pilih terlebih dahulu</h1>']);
				return back();
			}else {
				$input = Jadwal::insertGetId([
					'jenisjadwal'      	=>  $jenisjadwal,
					'nmgedung'         	=>  $viewgedung,
					'nmruang'         	=>  $viewruang,
					'ruang'         	=>  $ruang,
					'gedung'         	=>  $gedung,
					'email'         	=>  $email,
					'hape'         		=>  $hape,
					'tglmulai'         	=>  $dmulai,
					'tglakhir'         	=>  $dselesai,
					'jammulai'         	=>  $tmulai,
					'jamakhir'         	=>  $tselesai,
					'mulai'    			=>  $mulai,
					'akhir'     		=>  $akhir,
					'peminjam'      	=>  $peminjam,
					'instansi'      	=>  $unitkerja,
					'keperluan'     	=>  $keperluan,
					'keterangan'		=>  $keterangan,
					'suratpermohonan'	=>  '',
					'inputor' 			=>  $inputor,
					'biaya' 			=>  $biaya,
					'status' 			=>  'new',
					'fakultas' 			=>  $fakultas,
					'fakpanjang' 		=>  $fakpanjang
				]);
				if ($input){
					$perihal		= 'Permohonan Peminjaman '.$viewruang.' '.$viewgedung.' Untuk '.$mulai.' s/d '.$akhir;
					$cekpjgedung	= Pejabatsurat::where('id', $pjgedung)->first();
					if (isset($cekpjgedung->pejabat)){
						$pjgedung	= $cekpjgedung->pejabat;
					}
					$marking 		= $fakultas.'-RENT-'.$input;
					if ($request->hasFile('file')) {
						$namafile		= $marking.'.'.$request->file->getClientOriginalExtension();
						$request->file->move(public_path('scan/files'), $namafile);
						Jadwal::where('id', $input)->update([
							'suratpermohonan'	=>  $namafile,
						]);
					}
					if ($pjgedung != ''){
						$inputsrtpermohonan = Suratmasuk::create([
							'marking' 		=>  $marking,
							'noagenda' 		=>  $input,
							'tglmasuk' 		=>  date('Y-m-d'),
							'tglsurat' 		=>  $dmulai,
							'daysrt' 		=>  date('d'),
							'monsrt' 		=>  date('m'),
							'yersrt' 		=>  date('Y'),
							'jenissurat' 	=>  'PERM',
							'nosurat' 		=>  '-',
							'asalsurat' 	=>  $unitkerja,
							'kepada' 		=>  $pjgedung,
							'perihal' 		=>  $keperluan,
							'subyek' 		=>  'RT',
							'ringkasan' 	=>  'Input dari Permohonan Online',
							'ringkasan2' 	=>  $keperluan,
							'lampiran' 		=>  '-',
							'scansurat' 	=>  $namafile,
							'sifat' 		=>  5,
							'bentuk' 		=>  'Surat Asli',
							'klasifikasi' 	=>  'Biasa',
							'pembuat' 		=>  $peminjam,
							'status' 		=>  '',
							'disposisi' 	=>  '',
							'arsip' 		=>  '',
							'ruangarsip' 	=>  '',
							'ordnerarsip' 	=>  '',
							'lemariarsip' 	=>  '',
							'faskode' 		=>  'RT.02.1',
							'fasmasa' 		=>  '1',
							'fasket' 		=>  '1',
							'subkode' 		=>  '',
							'submasa' 		=>  '',
							'subket' 		=>  '',
							'fakultas' 		=>  $fakultas.'-RENT',
						]);
						$idsurat = $inputsrtpermohonan->id;
						Jadwal::where('id', $input)->update([
							'marking'	=>  $marking,
							'idsurat'	=> 	$idsurat
						]);
						Inboxsurat::insert([
							'marking'  		=>  $marking,
							'pengirim'  	=>  $peminjam,
							'penerima'		=>  $pjgedung,
							'status'		=>  'send',
							'sifat'			=>  '5',
							'jenis'			=>  'MASUK',
							'kerja'			=>  'DISPOSISI',
							'catatan'		=>  '',
							'tandatangan'	=>  '',
							'tanggal'		=>  '',
							'idsurat'		=> $idsurat,
							'noagenda'		=> $input,
							'tglsurat'		=> date('Y-m-d'),
							'jenissrt'		=> 'Permohonan',
							'nosurat'		=> '',
							'kepada'		=> $pjgedung,
							'perihal'		=> $perihal,
							'alamat'		=> '',
							'lampiran'		=> $namafile,
							'kodefak'		=> '',
							'klasifikasi'	=> 'Biasa',
							'pembuat'		=> $peminjam,
							'unit'			=> $unitkerja,
							'tabel'			=> 'MASUK'
						]);
						$idcaritoken		= 0;
						$tuliskirim 		= 'No. Agenda '.$input.' Perihal '.$perihal;
						$cariiduser 		= User::where('fakultas', $fakultas)->where('spesial', 'Admin Peminjaman')->get();
						foreach ($cariiduser as $rows){
							$jtokencari	= Firebasebank::where('userid', $rows->id)->get();
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
									'Authorization: key=' . API_ACCESS_KEY3,
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
					$getfilelm	= Jadwal::where('id', $input)->first();
					$scanlama	= $getfilelm->suratpermohonan;
					$buat		= $getfilelm->created_at;
					$ubah		= $getfilelm->updated_at;
					$homebase	= url("/");
					$alamatweb	= $homebase.'/trackingid/srtmsk-'.$marking;
					$cancelurl	= $homebase.'/batalpermohonan/'.$getfilelm->id;
					$printqrcode= QrCode::size(150)->generate($alamatweb);
					$pesan 		= '<h1>Pengajuan Sukses di Input. Peminjaman ini bisa dialihkan / dibatalkan sesuai dengan arahan pimpinan / penanggung jawab, mohon selalu memantau perkembangannya melalui link tracking dibawah ini atau scan QrCode tertampil</h1>
											<table class="table table-bordered table-stripped">
												<tr><td>Waktu Pemesanan</td><td>'.$buat.'</td></tr>
												<tr><td>Ruang/Kendaraan/Gedung</td><td>'.$viewruang.'</td></tr>
												<tr><td>Gedung / No. Polisi</td><td>'.$viewgedung.'</td></tr>
												<tr><td>Pinjam / Sewa Tanggal</td><td>'.$getfilelm->mulai.'</td></tr>
												<tr><td>Pengembalian Tanggal</td><td>'.$getfilelm->akhir.'</td></tr>
												<tr><td>Kode Tracking</td><td>'.$alamatweb.'</td></tr>
												<tr><td>Pembatalan Permohonan Ini Silahkan Klik Link </td><td><a href="'.$cancelurl.'" target="_blank">LINK PEMBATALAN</a></td></tr>
											</table>';
					try {
						Mail::send('email',
							array(
								'isisurat' => $pesan,
							), function($message) use ($email, $keperluan){
							$message->from('sco@ub.ac.id');
							$message->to($email)->subject($keperluan);
						});
						$sendstatus = 'Email Send';
					} catch (\Exception $e) {
						$sendstatus = $e->getMessage();
					}
					return response()->json(['icon' => $printqrcode, 'warna' => $alamatweb, 'status' => $sendstatus, 'message' => $pesan]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Database Error, silahkan coba beberapa saat lagi</h1>']);
					return back();
				}
			}
		} else {
			if ($jenis == 'ruang'){
				$jenisjadwal= '1';
				$getgedung	= Ruang::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= $getgedung->namarg;
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('jenisjadwal', $jenisjadwal)
					->where('id', '!=', $idne)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else if ($jenis == 'mobil'){
				$jenisjadwal= '2';
				$getgedung	= Kendaraan::where('id', $idygdipinjem)->first();
				if (isset($getgedung->garasi)){
					$viewruang 	= $getgedung->merek;
					$viewgedung	= $getgedung->nopol;
					$gedung 	= $getgedung->garasi;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('jenisjadwal', $jenisjadwal)
					->where('id', '!=', $idne)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else {
				$jenisjadwal= '3';
				$getgedung	= Gedung::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= 'ALL';
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= 'ALL';
				$gedung		= $idygdipinjem;
				$sudahblm   = Jadwal::where('gedung', $idygdipinjem)
					->where('ruang', 'ALL')
					->where('id', '!=', $idne)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			}
			if ($sudahblm != 0) {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Crash Jadwal Untuk '.$viewruang.' '.$viewgedung.' Pada '.$mulai.' s/d '.$akhir.', untuk mengetahui jadwal yang sudah masuk, mohon klik "Lihat Jadwal" di kolom Ruang/Kendaraan/Gedung yang akan anda pilih terlebih dahulu</h1>']);
				return back();
			} else {
				$input = Jadwal::where('id', $idne)->update([
					'nmgedung'         	=>  $viewgedung,
					'nmruang'         	=>  $viewruang,
					'jenisjadwal'      	=>  $jenisjadwal,
					'ruang'         	=>  $ruang,
					'gedung'         	=>  $gedung,
					'email'         	=>  $email,
					'hape'         		=>  $hape,
					'tglmulai'         	=>  $dmulai,
					'tglakhir'         	=>  $dselesai,
					'jammulai'         	=>  $tmulai,
					'jamakhir'         	=>  $tselesai,
					'mulai'    			=>  $mulai,
					'akhir'     		=>  $akhir,
					'peminjam'      	=>  $peminjam,
					'instansi'      	=>  $unitkerja,
					'keperluan'     	=>  $keperluan,
					'keterangan'		=>  $keterangan,
					'inputor' 			=>  $inputor,
					'biaya' 			=>  $biaya,
					'status' 			=>  'update',
					'fakultas' 			=>  $fakultas,
					'fakpanjang' 		=>  $fakpanjang
				]);
				if ($input){
					$getfilelm	= Jadwal::where('id', $idne)->first();
					$scanlama	= $getfilelm->suratpermohonan;
					$buat		= $getfilelm->created_at;
					$ubah		= $getfilelm->updated_at;
					$marking 	= $fakultas.'-RENT-'.$idne;
					$cekpjgedung= Pejabatsurat::where('id', $pjgedung)->first();
					if (isset($cekpjgedung->pejabat)){
						$pjgedung	= $cekpjgedung->pejabat;
					}
					
					if ($request->hasFile('file')) {
						if (File::exists(base_path()) ."/public/scan/files/". $scanlama) {
						  File::delete(base_path() ."/public/scan/files/". $scanlama);
						}
						$namafile		= $marking.'.'.$request->file->getClientOriginalExtension();
						$request->file->move(public_path('scan/files'), $namafile);
						Jadwal::where('id', $idne)->update([
							'suratpermohonan'	=>  $namafile,
						]);
					}
					if ($pjgedung != ''){
						$cekmasuk = Suratmasuk::where('marking', $marking)->count();
						if ($cekmasuk == 0){
							$inputsrtpermohonan = Suratmasuk::create([
								'marking' 		=>  $marking,
								'noagenda' 		=>  $idne,
								'tglmasuk' 		=>  date('Y-m-d'),
								'tglsurat' 		=>  $dmulai,
								'daysrt' 		=>  date('d'),
								'monsrt' 		=>  date('m'),
								'yersrt' 		=>  date('Y'),
								'jenissurat' 	=>  'PERM',
								'nosurat' 		=>  '-',
								'asalsurat' 	=>  $unitkerja,
								'kepada' 		=>  $pjgedung,
								'perihal' 		=>  $keperluan,
								'subyek' 		=>  'RT',
								'ringkasan' 	=>  'Input dari Permohonan Online',
								'ringkasan2' 	=>  $keperluan,
								'lampiran' 		=>  '-',
								'scansurat' 	=>  $namafile,
								'sifat' 		=>  5,
								'bentuk' 		=>  'Surat Asli',
								'klasifikasi' 	=>  'Biasa',
								'pembuat' 		=>  $peminjam,
								'status' 		=>  '',
								'disposisi' 	=>  '',
								'arsip' 		=>  '',
								'ruangarsip' 	=>  '',
								'ordnerarsip' 	=>  '',
								'lemariarsip' 	=>  '',
								'faskode' 		=>  'RT.02.1',
								'fasmasa' 		=>  '1',
								'fasket' 		=>  '1',
								'subkode' 		=>  '',
								'submasa' 		=>  '',
								'subket' 		=>  '',
								'fakultas' 		=>  $fakultas.'-RENT',
							]);
							$idsurat = $inputsrtpermohonan->id;
						} else {
							$getdatasrtmsh 	= Suratmasuk::where('marking', $marking)->first();
							$idsurat 		= $getdatasrtmsh->id;
							Suratmasuk::where('marking', $marking)->update([
								'tglmasuk' 		=>  date('Y-m-d'),
								'tglsurat' 		=>  $dmulai,
								'daysrt' 		=>  date('d'),
								'monsrt' 		=>  date('m'),
								'yersrt' 		=>  date('Y'),
								'asalsurat' 	=>  $unitkerja,
								'kepada' 		=>  $pjgedung,									
								'perihal' 		=>  $keperluan,
								'scansurat' 	=>  $namafile,
								'pembuat' 		=>  $peminjam,
							]);
						}
						Jadwal::where('id', $idne)->update([
							'marking'	=>  $marking,
							'idsurat'	=> 	$idsurat
						]);
						Inboxsurat::where('marking', $marking)->where('jenis', 'MASUK')->delete();
						Inboxsurat::insert([
							'marking'  		=>  $marking,
							'pengirim'  	=>  $peminjam,
							'penerima'		=>  $pjgedung,
							'status'		=>  'send',
							'sifat'			=>  5,
							'jenis'			=>  'MASUK',
							'kerja'			=>  'DISPOSISI',
							'catatan'		=>  '',
							'tandatangan'	=>  '',
							'tanggal'		=>  '',
							'idsurat'		=> $idsurat,
							'noagenda'		=> $idne,
							'tglsurat'		=> date('Y-m-d'),
							'jenissrt'		=> 'Permohonan',
							'nosurat'		=> '',
							'kepada'		=> $pjgedung,
							'perihal'		=> $perihal,
							'alamat'		=> '',
							'lampiran'		=> $namafile,
							'kodefak'		=> '',
							'klasifikasi'	=> 'Biasa',
							'pembuat'		=> $peminjam,
							'unit'			=> $unitkerja,
							'tabel'			=> 'MASUK'
						]);
						$idcaritoken		= 0;
						$perihal			= 'Permohonan Peminjaman '.$viewruang.' '.$viewgedung.' Untuk '.$mulai.' s/d '.$akhir;
						$tuliskirim 		= 'No. Agenda '.$idne.' Perihal '.$perihal;
						$cariiduser 		= User::where('fakultas', $fakultas)->where('spesial', 'Admin Peminjaman')->get();
						foreach ($cariiduser as $rows){
							$jtokencari	= Firebasebank::where('userid', $rows->id)->get();
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
									'Authorization: key=' . API_ACCESS_KEY3,
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
					$homebase		= url("/");
					$alamatweb		= $homebase.'/trackingid/srtmsk-'.$marking;
					$cancelurl		= $homebase.'/batalpermohonan/'.$getfilelm->id;
					$printqrcode 	= QrCode::size(150)->generate($alamatweb);
					$pesan 			= '<h1>Pengajuan Sukses di Update. Peminjaman ini bisa dialihkan / dibatalkan sesuai dengan arahan pimpinan / penanggung jawab, mohon selalu memantau perkembangannya melalui link tracking dibawah ini atau scan QrCode tertampil</h1>
											<table class="table table-bordered table-stripped">
												<tr><td>Waktu Pemesanan</td><td>'.$buat.'</td></tr>
												<tr><td>Waktu Perubahan</td><td>'.$ubah.'</td></tr>
												<tr><td>Ruang/Kendaraan/Gedung</td><td>'.$viewruang.'</td></tr>
												<tr><td>Gedung / No. Polisi</td><td>'.$viewgedung.'</td></tr>
												<tr><td>Pinjam / Sewa Tanggal</td><td>'.$getfilelm->mulai.'</td></tr>
												<tr><td>Pengembalian Tanggal</td><td>'.$getfilelm->akhir.'</td></tr>
												<tr><td>Kode Tracking</td><td>'.$alamatweb.'</td></tr>
												<tr><td>Pembatalan Permohonan Ini Silahkan Klik Link </td><td><a href="'.$cancelurl.'" target="_blank">LINK PEMBATALAN</a></td></tr>
											</table>';
					try {
						Mail::send('email',
							array(
								'isisurat' => $pesan,
							), function($message) use ($email, $keperluan){
							$message->from('sco@ub.ac.id');
							$message->to($email)->subject($keperluan);
						});
						$sendstatus = 'Email Send';
					} catch (\Exception $e) {
						$sendstatus = $e->getMessage();
					}
					return response()->json(['icon' => $printqrcode, 'warna' => $alamatweb, 'status' => $sendstatus, 'message' => $pesan]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Database Error, silahkan coba beberapa saat lagi</h1>']);
					return back();
				}
			}
		}
	}
	public function expinjamAdmin(Request $request) {
        $idygdipinjem   = $request->input('val02');
		$peminjam  		= $request->input('val03');
		$unitkerja  	= $request->input('val04');
		$email  		= $request->input('val05');
		$hape    		= $request->input('val06');
		$dmulai  		= $request->input('val07');
		$tmulai    		= $request->input('val08');
		$dselesai		= $request->input('val09');
		$tselesai  		= $request->input('val10');
		$keterangan 	= $request->input('val11');
		$jenis 			= $request->input('val12');
		$idne 			= $request->input('val13');	
		$keperluan		= $request->input('val14');
		$biaya			= $request->input('val14');
		$pjgedung 		= ''; 
		$viewruang 		= $idygdipinjem;
		$viewgedung		= $jenis;
		$arraymulai		= explode(" ", $tmulai);
		$jmulai 		= $arraymulai[0];
		$cmulai 		= $arraymulai[1];
		$arrayjmulai	= explode(":", $jmulai);
		$hhmulai		= (int)$arrayjmulai[0];
		$mmmulai		= $arrayjmulai[1];
		$perihal		= 'Permohonan Peminjaman '.$jenis.' oleh '.$peminjam;
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
		$cselesai 		= $arrayselesai[1];
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
		$from     		=   Carbon::createFromFormat('Y-m-d H:s:i', $mulai);
		$to     		=   Carbon::createFromFormat('Y-m-d H:s:i', $akhir);
		$hari 			= 	$from->diffInDays($to);
		if ($hari == 0){ $hari = 1; }
		if ($keterangan == ''){ $keterangan = '-'; }
		if ($idne == 'new'){
			if ($jenis == 'ruang'){
				$jenisjadwal= '1';
				$getgedung	= Ruang::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= $getgedung->namarg;
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('jenisjadwal', $jenisjadwal)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else if ($jenis == 'mobil'){
				$jenisjadwal= '2';
				$getgedung	= Kendaraan::where('id', $idygdipinjem)->first();
				if (isset($getgedung->garasi)){
					$viewruang 	= $getgedung->merek;
					$viewgedung	= $getgedung->nopol;
					$gedung 	= $getgedung->garasi;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('jenisjadwal', $jenisjadwal)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else {
				$jenisjadwal= '3';
				$getgedung	= Gedung::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= 'ALL';
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= 'ALL';
				$gedung		= $idygdipinjem;
				$sudahblm   = Jadwal::where('gedung', $idygdipinjem)
					->where('ruang', 'ALL')
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			}
			if ($sudahblm != 0) {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Crash Jadwal Untuk '.$viewruang.' '.$viewgedung.' Pada '.$mulai.' s/d '.$akhir.', untuk mengetahui jadwal yang sudah masuk, mohon klik "Lihat Jadwal" di kolom Ruang/Kendaraan/Gedung yang akan anda pilih terlebih dahulu</h1>']);
				return back();
			}else {				
				$input = Jadwal::insertGetId([
					'nmgedung'         	=>  $viewgedung,
					'nmruang'         	=>  $viewruang,
					'jenisjadwal'      	=>  $jenisjadwal,
					'ruang'         	=>  $ruang,
					'gedung'         	=>  $gedung,
					'email'         	=>  $email,
					'hape'         		=>  $hape,
					'tglmulai'         	=>  $dmulai,
					'tglakhir'         	=>  $dselesai,
					'jammulai'         	=>  $tmulai,
					'jamakhir'         	=>  $tselesai,
					'mulai'    			=>  $mulai,
					'akhir'     		=>  $akhir,
					'peminjam'      	=>  $peminjam,
					'instansi'      	=>  $unitkerja,
					'keperluan'     	=>  $keperluan,
					'keterangan'		=>  $keterangan,
					'suratpermohonan'	=>  '',
					'inputor' 			=>  Session('nama'),
					'biaya' 			=>  $biaya,
					'status' 			=>  'new',
					'fakultas' 			=>  $fakultas,
					'fakpanjang' 		=>  $fakpanjang
				]);
				if ($input){
					$namafile		= '';
					$kwitansi		= '';
					$marking 		= $fakultas.'-RENT-'.$input;
					$cekpjgedung	= Pejabatsurat::where('id', $pjgedung)->first();
					if (isset($cekpjgedung->pejabat)){
						$pjgedung	= $cekpjgedung->pejabat;
					}
					if ($request->hasFile('file')) {
						$namafile		= $marking.'.'.$request->file->getClientOriginalExtension();
						$request->file->move(public_path('scan/files'), $namafile);
						Jadwal::where('id', $input)->update([
							'suratpermohonan'	=>  $namafile,
						]);
					}
					if ($request->hasFile('filebukti')) {
						$kwitansi 		= $fakultas.'-RENTPAY-'.$input;
						$kwitansi		= $kwitansi.'.'.$request->file('filebukti')->getClientOriginalExtension();
						$request->file('filebukti')->move(public_path('scan/files'), $kwitansi);
						Jadwal::where('id', $input)->update([
							'buktibayar'	=>  $kwitansi,
						]);
					}
					$getfilelm	= Jadwal::where('id', $input)->first();
					$scanlama	= $getfilelm->suratpermohonan;
					$buat		= $getfilelm->created_at;
					$ubah		= $getfilelm->updated_at;
					$homebase	= url("/");
					$alamatweb	= $homebase.'/trackingid/srtmsk-'.$marking;
					$cancelurl	= $homebase.'/batalpermohonan/'.$getfilelm->id;
					$printqrcode= QrCode::size(150)->generate($alamatweb);
					$pesan 		= '<h1>Pengajuan Sukses di Input, silahkan gunakan Link di Samping untuk melakukan Tracking status Peminjaman Ruang/Kendaraan/Gedung anda.</h1>
										<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$buat.'</td></tr>
											<tr><td>Ruang/Kendaraan/Gedung</td><td>'.$viewruang.'</td></tr>
											<tr><td>Gedung / No. Polisi</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$getfilelm->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$getfilelm->akhir.'</td></tr>
											<tr><td>Kode Tracking</td><td>'.$alamatweb.'</td></tr>
											<tr><td>Pembatalan Permohonan Ini Silahkan Klik Link </td><td><a href="'.$cancelurl.'" target="_blank">LINK PEMBATALAN</a></td></tr>
										</table>';
					return response()->json(['icon' => $printqrcode, 'warna' => $alamatweb, 'status' => 'Success', 'message' => $pesan]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Database Error, silahkan coba beberapa saat lagi</h1>']);
					return back();
				}
			}
		} else {
			if ($jenis == 'ruang'){
				$jenisjadwal= '1';
				$getgedung	= Ruang::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= $getgedung->namarg;
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('id', '!=', $idne)
					->where('jenisjadwal', $jenisjadwal)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else if ($jenis == 'mobil'){
				$jenisjadwal= '2';
				$getgedung	= Kendaraan::where('id', $idygdipinjem)->first();
				if (isset($getgedung->garasi)){
					$viewruang 	= $getgedung->merek;
					$viewgedung	= $getgedung->nopol;
					$gedung 	= $getgedung->garasi;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= $idygdipinjem;
				$sudahblm   = Jadwal::where('ruang', $idygdipinjem)
					->where('id', '!=', $idne)
					->where('jenisjadwal', $jenisjadwal)
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			} else {
				$jenisjadwal= '3';
				$getgedung	= Gedung::where('id', $idygdipinjem)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= 'ALL';
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					$biaya		= $hari * $biaya;
				} else { $gedung = $jenis.'-'.$idygdipinjem; $fakultas= 'unkown'; $fakpanjang = 'unkown';}
				$ruang		= 'ALL';
				$gedung		= $idygdipinjem;
				$sudahblm   = Jadwal::where('gedung', $idygdipinjem)
					->where('id', '!=', $idne)
					->where('ruang', 'ALL')
					->where('status', '!=', 'ARSIP')
					->where(function ($query) use ($mulai, $akhir) {
						$query->where(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('mulai', '<', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '<=', $mulai)
							   ->where('akhir', '>', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('akhir', '>', $mulai)
							   ->where('akhir', '<=', $akhir);
						})->orWhere(function ($q) use ($mulai, $akhir) {
							$q->where('mulai', '>=', $mulai)
							   ->where('akhir', '<=', $akhir);
						});
					})->count();
			}
			if ($sudahblm != 0) {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Crash Jadwal Untuk '.$viewruang.' '.$viewgedung.' Pada '.$mulai.' s/d '.$akhir.', untuk mengetahui jadwal yang sudah masuk, mohon klik "Lihat Jadwal" di kolom Ruang/Kendaraan/Gedung yang akan anda pilih terlebih dahulu</h1>']);
				return back();
			}else {				
				$input = Jadwal::where('id', $idne)->update([
					'nmgedung'         	=>  $viewgedung,
					'nmruang'         	=>  $viewruang,
					'jenisjadwal'      	=>  $jenisjadwal,
					'ruang'         	=>  $ruang,
					'gedung'         	=>  $gedung,
					'email'         	=>  $email,
					'hape'         		=>  $hape,
					'tglmulai'         	=>  $dmulai,
					'tglakhir'         	=>  $dselesai,
					'jammulai'         	=>  $tmulai,
					'jamakhir'         	=>  $tselesai,
					'mulai'    			=>  $mulai,
					'akhir'     		=>  $akhir,
					'peminjam'      	=>  $peminjam,
					'instansi'      	=>  $unitkerja,
					'keperluan'     	=>  $keperluan,
					'keterangan'		=>  $keterangan,
					'inputor' 			=>  Session('nama'),
					'biaya' 			=>  $biaya,
				]);
				if ($input){
					$getfilelm	= Jadwal::where('id', $idne)->first();
					$scanlama	= $getfilelm->suratpermohonan;
					$buktibayar	= $getfilelm->buktibayar;
					$buat		= $getfilelm->created_at;
					$ubah		= $getfilelm->updated_at;
					$marking 	= $fakultas.'-RENT-'.$idne;
					$namafile	= $scanlama;
					$kwitansi	= $buktibayar;
					if ($request->hasFile('file')) {
						if (File::exists(base_path()) ."/public/scan/files/". $scanlama) {
						  File::delete(base_path() ."/public/scan/files/". $scanlama);
						}
						$namafile		= $marking.'.'.$request->file->getClientOriginalExtension();
						$request->file->move(public_path('scan/files'), $namafile);
						Jadwal::where('id', $idne)->update([
							'suratpermohonan'	=>  $namafile,
						]);
					}
					if ($request->hasFile('filebukti')) {
						if (File::exists(base_path()) ."/public/scan/files/". $buktibayar) {
							File::delete(base_path() ."/public/scan/files/". $buktibayar);
						}
						$kwitansi 		= $fakultas.'-RENTPAY-'.$input;
						$kwitansi		= $kwitansi.'.'.$request->file('filebukti')->getClientOriginalExtension();
						$request->file('filebukti')->move(public_path('scan/files'), $kwitansi);
						Jadwal::where('id', $idne)->update([
							'buktibayar'	=>  $kwitansi,
						]);
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Berhasil di Update']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<h1>Database Error, silahkan coba beberapa saat lagi</h1>']);
					return back();
				}
			}
		}
    }
	public function viewPembatalanPermohonan($id) {
		$data 				= [];
		$cekdata 			= Jadwal::where('id', $id)->first();
		if (isset($cekdata->id)){
			$jenisjadwal	= $cekdata->jenisjadwal;
			$pjgedung		= 0;
			$foto			= '';
			if ($jenisjadwal == '1'){
				$getgedung	= Ruang::where('id', $cekdata->ruang)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= $getgedung->namarg;
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					if (is_null($getgedung->foto)){
						$foto = '';
					} else {
						$foto 			= $getgedung->foto;
						$output_file 	= '/images/ruang/'.$foto;
					}
				} else { $gedung = $jenisjadwal.'-'.$cekdata->ruang; $viewruang= 'unkown'; $viewgedung = 'unkown';}
				$tabelpengajuan 	= '<h1>Review</h1>
									<table class="table table-bordered table-stripped">
										<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
										<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
										<tr><td>Ruang</td><td>'.$viewruang.'</td></tr>
										<tr><td>Gedung</td><td>'.$viewgedung.'</td></tr>
										<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
										<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
									</table>';
			} else if ($jenisjadwal == '2'){
				$getgedung	= Kendaraan::where('id', $cekdata->ruang)->first();
				if (isset($getgedung->garasi)){
					$viewruang 	= $getgedung->merek;
					$viewgedung	= $getgedung->nopol;
					$gedung 	= $getgedung->garasi;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					if (is_null($getgedung->foto)){
						$foto = '';
					} else {
						$foto 			= $getgedung->foto;
						$output_file 	= '/images/gedung/'.$foto;
					}
				} else { $gedung = $jenisjadwal.'-'.$cekdata->ruang; $viewruang= 'unkown'; $viewgedung = 'unkown';}
				$tabelpengajuan 	= '<h1>Review</h1>
									<table class="table table-bordered table-stripped">
										<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
										<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
										<tr><td>Kendaraan</td><td>'.$viewruang.'</td></tr>
										<tr><td>NOPOL</td><td>'.$viewgedung.'</td></tr>
										<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
										<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
									</table>';
			} else {
				$getgedung	= Gedung::where('id', $cekdata->gedung)->first();
				if (isset($getgedung->namagd)){
					$viewruang 	= 'ALL';
					$viewgedung	= $getgedung->namagd;
					$gedung 	= $getgedung->namagd;
					$fakultas 	= $getgedung->fakultas;
					$fakpanjang = $getgedung->fakpanjang;
					$biaya		= $getgedung->tarif;
					$pjgedung	= $getgedung->pjgedung;
					if (is_null($getgedung->foto)){
						$foto = '';
					} else {
						$foto 			= $getgedung->foto;
						$output_file 	= '/images/kendaraan/'.$foto;
					}
				} else { $gedung = $jenisjadwal.'-'.$cekdata->gedung; $viewruang= 'unkown'; $viewgedung = 'unkown';}
				$tabelpengajuan 	= '<h1>Review</h1>
									<table class="table table-bordered table-stripped">
										<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
										<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
										<tr><td>Gedung Yang di Pinjam</td><td>'.$viewgedung.'</td></tr>
										<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
										<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
									</table>';
			}
			$cekpjgedung	= Pejabatsurat::where('id', $pjgedung)->first();
			if (isset($cekpjgedung->pejabat)){
				$pjgedung	= $cekpjgedung->pejabat;
			}
			if ($foto != ''){
				if (file_exists(public_path($output_file))){
					$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="..'.$output_file.'" />';
				} else {
					$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="../logo-ub.png" />';
				}
			} else {
				$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="../logo-ub.png" />';	
			}
			$data['datapeminjaman'] = $cekdata;
			$data['viewruang'] 		= $viewruang;
			$data['viewgedung'] 	= $viewgedung;
			$data['gedung'] 		= $gedung;
			$data['tabelpengajuan'] = $tabelpengajuan;
			$data['foto'] 			= $foto;
			$data['kalimatheader'] 	= 'Form Pembatalan Peminjaman';
			return view('simpen.pembatalan', $data);
		} else {
			$data['judulpesan'] 	= 'Error Page';
			$data['kalimatheader'] 	= 'ID Tidak Valid';
			$data['kalimatbody'] 	= 'Mohon Maaf ID Peminjamana '.$id.' Tidak Di Temukan / Telah Terhapus. Silahkan Ajukan Permohonan Baru / Periksa Kembali Link Pembatalan ini melalui email Bapak/Ibu/Saudara.<p></p><a href="/simpen" class="btn btn-primary">Kembali Ke Permohonan</a>';
			return view('errors.pesanerror', $data);
		}
	}
	public function viewAkhiriKegiatan($id) {
		$data 				= [];
		$cekdata 			= Jadwal::where('id', $id)->first();
		if (isset($cekdata->id)){
			$jenisjadwal	= $cekdata->jenisjadwal;
			$status			= $cekdata->status;
			$pjgedung		= 0;
			$foto			= '';
			if ($status == 'ARSIP'){
				$data['judulpesan'] 	= 'ARSIP';
				$data['kalimatheader'] 	= 'Pengajuan Ini Telah Menjadi Arsip';
				$data['kalimatbody'] 	= 'Terimakasih, Kegiatan '.$cekdata->keperluan.' Telah Berakhir Pesan dan Kesan Yang Tersimpan Untuk Kegiatan Ini : '.$cekdata->keterangan.'.<p></p><a href="/simpen" class="btn btn-primary">Kembali Ke Permohonan</a>';
				return view('errors.pesanerror', $data);
			} else {
				if ($jenisjadwal == '1'){
					$getgedung	= Ruang::where('id', $cekdata->ruang)->first();
					if (isset($getgedung->namagd)){
						$viewruang 	= $getgedung->namarg;
						$viewgedung	= $getgedung->namagd;
						$gedung 	= $getgedung->namagd;
						$fakultas 	= $getgedung->fakultas;
						$fakpanjang = $getgedung->fakpanjang;
						$biaya		= $getgedung->tarif;
						$pjgedung	= $getgedung->pjgedung;
						if (is_null($getgedung->foto)){
							$foto = '';
						} else {
							$foto 			= $getgedung->foto;
							$output_file 	= '/images/ruang/'.$foto;
						}
					} else { $gedung = $jenisjadwal.'-'.$cekdata->ruang; $viewruang= 'unkown'; $viewgedung = 'unkown';}
					$tabelpengajuan 	= '<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
											<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
											<tr><td>Ruang</td><td>'.$viewruang.'</td></tr>
											<tr><td>Gedung</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
										</table>';
				} else if ($jenisjadwal == '2'){
					$getgedung	= Kendaraan::where('id', $cekdata->ruang)->first();
					if (isset($getgedung->garasi)){
						$viewruang 	= $getgedung->merek;
						$viewgedung	= $getgedung->nopol;
						$gedung 	= $getgedung->garasi;
						$fakultas 	= $getgedung->fakultas;
						$fakpanjang = $getgedung->fakpanjang;
						$biaya		= $getgedung->tarif;
						$pjgedung	= $getgedung->pjgedung;
						if (is_null($getgedung->foto)){
							$foto = '';
						} else {
							$foto 			= $getgedung->foto;
							$output_file 	= '/images/gedung/'.$foto;
						}
					} else { $gedung = $jenisjadwal.'-'.$cekdata->ruang; $viewruang= 'unkown'; $viewgedung = 'unkown';}
					$tabelpengajuan 	= '<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
											<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
											<tr><td>Kendaraan</td><td>'.$viewruang.'</td></tr>
											<tr><td>NOPOL</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
										</table>';
				} else {
					$getgedung	= Gedung::where('id', $cekdata->gedung)->first();
					if (isset($getgedung->namagd)){
						$viewruang 	= 'ALL';
						$viewgedung	= $getgedung->namagd;
						$gedung 	= $getgedung->namagd;
						$fakultas 	= $getgedung->fakultas;
						$fakpanjang = $getgedung->fakpanjang;
						$biaya		= $getgedung->tarif;
						$pjgedung	= $getgedung->pjgedung;
						if (is_null($getgedung->foto)){
							$foto = '';
						} else {
							$foto 			= $getgedung->foto;
							$output_file 	= '/images/kendaraan/'.$foto;
						}
					} else { $gedung = $jenisjadwal.'-'.$cekdata->gedung; $viewruang= 'unkown'; $viewgedung = 'unkown';}
					$tabelpengajuan 	= '<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
											<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
											<tr><td>Gedung Yang di Pinjam</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
										</table>';
				}
				$cekpjgedung	= Pejabatsurat::where('id', $pjgedung)->first();
				if (isset($cekpjgedung->pejabat)){
					$pjgedung	= $cekpjgedung->pejabat;
				}
				if ($foto != ''){
					if (file_exists(public_path($output_file))){
						$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="..'.$output_file.'" />';
					} else {
						$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="../logo-ub.png" />';
					}
				} else {
					$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="../logo-ub.png" />';	
				}
				$data['datapeminjaman'] = $cekdata;
				$data['viewruang'] 		= $viewruang;
				$data['viewgedung'] 	= $viewgedung;
				$data['gedung'] 		= $gedung;
				$data['tabelpengajuan'] = $tabelpengajuan;
				$data['foto'] 			= $foto;
				$data['kalimatheader'] 	= 'Form Akhiri Kegiatan';
				return view('simpen.akhiri', $data);
			}
		} else {
			$data['judulpesan'] 	= 'Error Page';
			$data['kalimatheader'] 	= 'ID Tidak Valid';
			$data['kalimatbody'] 	= 'Mohon Maaf ID Peminjaman '.$id.' Tidak Di Temukan / Telah Terhapus. Silahkan Ajukan Permohonan Baru / Periksa Kembali Link Pembatalan ini melalui email Bapak/Ibu/Saudara.<p></p><a href="/simpen" class="btn btn-primary">Kembali Ke Permohonan</a>';
			return view('errors.pesanerror', $data);
		}
	}
	public function viewPerubahanPermohonan($id) {
		$data 				= [];
		$cekdata 			= Jadwal::where('id', $id)->first();
		if (isset($cekdata->id)){
			$jenisjadwal	= $cekdata->jenisjadwal;
			$status			= $cekdata->status;
			$fakultas		= $cekdata->fakultas;
			$pjgedung		= 0;
			$foto			= '';
			
			if ($status == 'ARSIP'){
				$data['judulpesan'] 	= 'ARSIP';
				$data['kalimatheader'] 	= 'Pengajuan Ini Telah Menjadi Arsip';
				$data['kalimatbody'] 	= 'Terimakasih, Kegiatan '.$cekdata->keperluan.' Telah Berakhir Pesan dan Kesan Yang Tersimpan Untuk Kegiatan Ini : '.$cekdata->keterangan.'.<p></p><a href="/simpen" class="btn btn-primary">Kembali Ke Permohonan</a>';
				return view('errors.pesanerror', $data);
			} else {
				if ($jenisjadwal == '1'){
					$tulisjenis = 'ruang';
					$listlokasi = Ruang::where('fakultas', $fakultas)->orderBy('namarg', 'ASC')->get();
					$getgedung	= Ruang::where('id', $cekdata->ruang)->first();
					if (isset($getgedung->namagd)){
						$viewruang 	= $getgedung->namarg;
						$viewgedung	= $getgedung->namagd;
						$gedung 	= $getgedung->namagd;
						$fakultas 	= $getgedung->fakultas;
						$fakpanjang = $getgedung->fakpanjang;
						$biaya		= $getgedung->tarif;
						$pjgedung	= $getgedung->pjgedung;
						if (is_null($getgedung->foto)){
							$foto = '';
						} else {
							$foto 			= $getgedung->foto;
							$output_file 	= '/images/ruang/'.$foto;
						}
					} else { $gedung = $jenisjadwal.'-'.$cekdata->ruang; $viewruang= 'unkown'; $viewgedung = 'unkown';}
					$tabelpengajuan 	= '<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
											<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
											<tr><td>Ruang</td><td>'.$viewruang.'</td></tr>
											<tr><td>Gedung</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
										</table>';
				} else if ($jenisjadwal == '2'){
					$tulisjenis = 'mobil';
					$listlokasi = Kendaraan::where('fakultas', $fakultas)->orderBy('merek', 'ASC')->get();
					$getgedung	= Kendaraan::where('id', $cekdata->ruang)->first();
					if (isset($getgedung->garasi)){
						$viewruang 	= $getgedung->merek;
						$viewgedung	= $getgedung->nopol;
						$gedung 	= $getgedung->garasi;
						$fakultas 	= $getgedung->fakultas;
						$fakpanjang = $getgedung->fakpanjang;
						$biaya		= $getgedung->tarif;
						$pjgedung	= $getgedung->pjgedung;
						if (is_null($getgedung->foto)){
							$foto = '';
						} else {
							$foto 			= $getgedung->foto;
							$output_file 	= '/images/gedung/'.$foto;
						}
					} else { $gedung = $jenisjadwal.'-'.$cekdata->ruang; $viewruang= 'unkown'; $viewgedung = 'unkown';}
					$tabelpengajuan 	= '<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
											<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
											<tr><td>Kendaraan</td><td>'.$viewruang.'</td></tr>
											<tr><td>NOPOL</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
										</table>';
				} else {
					$tulisjenis = 'gedung';
					$listlokasi = Gedung::where('fakultas', $fakultas)->orderBy('namagd', 'ASC')->get();
					$getgedung	= Gedung::where('id', $cekdata->gedung)->first();
					if (isset($getgedung->namagd)){
						$viewruang 	= 'ALL';
						$viewgedung	= $getgedung->namagd;
						$gedung 	= $getgedung->namagd;
						$fakultas 	= $getgedung->fakultas;
						$fakpanjang = $getgedung->fakpanjang;
						$biaya		= $getgedung->tarif;
						$pjgedung	= $getgedung->pjgedung;
						if (is_null($getgedung->foto)){
							$foto = '';
						} else {
							$foto 			= $getgedung->foto;
							$output_file 	= '/images/kendaraan/'.$foto;
						}
					} else { $gedung = $jenisjadwal.'-'.$cekdata->gedung; $viewruang= 'unkown'; $viewgedung = 'unkown';}
					$tabelpengajuan 	= '<table class="table table-bordered table-stripped">
											<tr><td>Waktu Pemesanan</td><td>'.$cekdata->created_at.'</td></tr>
											<tr><td>Waktu Perubahan</td><td>'.$cekdata->updated_at.'</td></tr>
											<tr><td>Gedung Yang di Pinjam</td><td>'.$viewgedung.'</td></tr>
											<tr><td>Pinjam / Sewa Tanggal</td><td>'.$cekdata->mulai.'</td></tr>
											<tr><td>Pengembalian Tanggal</td><td>'.$cekdata->akhir.'</td></tr>
										</table>';
				}
				$cekpjgedung	= Pejabatsurat::where('id', $pjgedung)->first();
				if (isset($cekpjgedung->pejabat)){
					$pjgedung	= $cekpjgedung->pejabat;
				}
				if ($fakultas == 'KP'){
					$fakpanjang = 'Kantor Pusat';
				} else {
					$getfakpanjang = User::where('fakultas', $fakultas)->where('fakpanjang', '!=', '')->first();
					if (isset($getfakpanjang->fakpanjang)){
						$fakpanjang	= $getfakpanjang->fakpanjang;
					} else {
						$fakpanjang	= $fakultas;
					}
				}

				if ($foto != ''){
					if (file_exists(public_path($output_file))){
						$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="..'.$output_file.'" />';
					} else {
						$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="../logo-ub.png" />';
					}
				} else {
					$foto = '<img class="product-image" alt="Profil Image" style="margin:2px; margin-left: 10px;" width="100" height="100" src="../logo-ub.png" />';	
				}
				$data['tulisjenis'] 	= $tulisjenis;
				$data['pjgedung'] 		= $pjgedung;
				$data['fakpanjang'] 	= $fakpanjang;
				$data['listlokasi'] 	= $listlokasi;
				$data['datapeminjaman'] = $cekdata;
				$data['viewruang'] 		= $viewruang;
				$data['viewgedung'] 	= $viewgedung;
				$data['gedung'] 		= $gedung;
				$data['tabelpengajuan'] = $tabelpengajuan;
				$data['foto'] 			= $foto;
				$data['kalimatheader'] 	= 'Form Perubahan Data Peminjaman Ruang';
				return view('simpen.ubah', $data);
			}
		} else {
			$data['judulpesan'] 	= 'Error Page';
			$data['kalimatheader'] 	= 'ID Tidak Valid';
			$data['kalimatbody'] 	= 'Mohon Maaf ID Peminjaman '.$id.' Tidak Di Temukan / Telah Terhapus. Silahkan Ajukan Permohonan Baru / Periksa Kembali Link Pembatalan ini melalui email Bapak/Ibu/Saudara.<p></p><a href="/simpen" class="btn btn-primary">Kembali Ke Permohonan</a>';
			return view('errors.pesanerror', $data);
		}
	}
	public function getKetersediaan(Request $request) {
    	$valcari    = $request->val01;
		$mulai    	= $request->val02;
		$akhir    	= $request->val03;
		$jencari    = $request->val04;
		$arrayruang	= [];
		if ($akhir == ''){
			if ($valcari == 'ALL'){
				if ($jencari == 'ruang'){
					$jruang 	= Ruang::where('pinjam', '!=', 'Tidak di Sewa/Pinjamkan')->where('pjgedung', '!=', '0')->orderBy('kodegd', 'asc')->orderBy('namarg', 'asc')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitasujian;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '1')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '1')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->namarg,
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> $result->koderg,
								'petugas' 		=> $result->petugas,
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->pinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else if ($jencari == 'mobil'){
					$jruang 	= Kendaraan::where('statpinjam', '!=', 'Tidak di Sewa/Pinjamkan')->where('pjgedung', '!=', '0')->orderBy('merek', 'ASC')->orderBy('kodegarasi', 'ASC')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '2')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '2')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->merek,
								'namagd' 		=> $result->garasi,
								'kodegd' 		=> $result->kodegarasi,
								'koderg' 		=> $result->kodekendaraan,
								'petugas' 		=> $result->driver,
								'marking' 		=> $marking,
								'luas' 			=> $result->nopol,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else {
					$jruang 	= Gedung::where('statpinjam', '!=', 'Tidak di Sewa/Pinjamkan')->orderBy('namagd', 'ASC')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$pjgedung 	= $result->pjgedung;
							$namagd 	= $result->namagd;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('gedung', $namagd)->where('mulai', 'LIKE', $mulai.'%')->orderBy('ruang', 'ASC')->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Nama Ruang</b></td><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('gedung', $namagd)->where('mulai', 'LIKE', $mulai.'%')->orderBy('ruang', 'ASC')->get();
								foreach( $getjadwal as $rjadwal ){
									$idruang		= $rjadwal->ruang;
									$getnamaruang	= Ruang::where('id', $idruang)->first();
									if (isset($getnamaruang->namarg)){
										$namarg		= $getnamaruang->namarg;
									} else {
										$namarg		= '';
									}
									$jadwalguna	= $jadwalguna.'<tr><td>'.$namarg.'</td><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $result->id,
								'namarg' 		=> '',
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> '',
								'petugas' 		=> '',
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> '',
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				}
			} else {
				if ($jencari == 'ruang'){
					$jruang 	= Ruang::where('id', $valcari)->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitasujian;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '1')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '1')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->namarg,
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> $result->koderg,
								'petugas' 		=> $result->petugas,
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->pinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else if ($jencari == 'mobil'){
					$jruang 	= Kendaraan::where('id', $valcari)->orderBy('kodegarasi', 'ASC')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '2')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '2')->where('ruang', $idruang)->where('mulai', 'LIKE', $mulai.'%')->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->merek,
								'namagd' 		=> $result->garasi,
								'kodegd' 		=> $result->kodegarasi,
								'koderg' 		=> $result->kodekendaraan,
								'petugas' 		=> $result->driver,
								'marking' 		=> $marking,
								'luas' 			=> $result->nopol,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else {
					$jruang 	= Gedung::where('namagd', $valcari)->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$pjgedung 	= $result->pjgedung;
							$namagd 	= $result->namagd;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('gedung', $namagd)->where('mulai', 'LIKE', $mulai.'%')->orderBy('ruang', 'ASC')->count();
							if ($cekjadwal != 0){	
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Nama Ruang</b></td><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('gedung', $namagd)->where('mulai', 'LIKE', $mulai.'%')->orderBy('ruang', 'ASC')->get();
								foreach( $getjadwal as $rjadwal ){
									$idruang		= $rjadwal->ruang;
									$getnamaruang	= Ruang::where('id', $idruang)->first();
									if (isset($getnamaruang->namarg)){
										$namarg		= $getnamaruang->namarg;
									} else {
										$namarg		= '';
									}
									$jadwalguna	= $jadwalguna.'<tr><td>'.$namarg.'</td><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $result->id,
								'namarg' 		=> '',
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> '',
								'petugas' 		=> '',
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> '',
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				}
			}
		} else {
			$start 		= strtotime(date("Y-m-d",strtotime($mulai)));
			$finish 	= strtotime(date("Y-m-d",strtotime($akhir)));
			if ($start > $finish){
				$mulai2 = $mulai;
				$mulai	= $akhir;
				$akhir	= $mulai2;
			}
			if ($valcari == 'ALL'){
				if ($jencari == 'ruang'){
					$jruang 	= Ruang::where('pinjam', '!=', 'Tidak di Sewa/Pinjamkan')->orderBy('kodegd', 'asc')->orderBy('namarg', 'asc')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitasujian;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.' until '.$akhir.'</small>';
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '1')->where('ruang', $idruang)->where(function ($query) use ($mulai, $akhir) {
								$query->where(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglmulai', '<', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '<=', $mulai)
									   ->where('tglakhir', '>', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglakhir', '>', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								});
							})->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '1')->where('ruang', $idruang)->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglmulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '<=', $mulai)
										   ->where('tglakhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglakhir', '>', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									});
								})->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->namarg,
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> $result->koderg,
								'petugas' 		=> $result->petugas,
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->pinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else if ($jencari == 'mobil'){
					$jruang 	= Kendaraan::where('statpinjam', '!=', 'Tidak di Sewa/Pinjamkan')->orderBy('merek', 'ASC')->orderBy('kodegarasi', 'ASC')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.' until '.$akhir.'</small>';
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '2')->where('ruang', $idruang)->where(function ($query) use ($mulai, $akhir) {
								$query->where(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglmulai', '<', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '<=', $mulai)
									   ->where('tglakhir', '>', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglakhir', '>', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								});
							})->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('jenisjadwal', '2')->where('ruang', $idruang)->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglmulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '<=', $mulai)
										   ->where('tglakhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglakhir', '>', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									});
								})->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->merek,
								'namagd' 		=> $result->garasi,
								'kodegd' 		=> $result->kodegarasi,
								'koderg' 		=> $result->kodekendaraan,
								'petugas' 		=> $result->driver,
								'marking' 		=> $marking,
								'luas' 			=> $result->nopol,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else {
					$jruang 	= Gedung::where('statpinjam', '!=', 'Tidak di Sewa/Pinjamkan')->orderBy('namagd', 'ASC')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$pjgedung 	= $result->pjgedung;
							$namagd 	= $result->namagd;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.' until '.$akhir.'</small>';
							
							$cekjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('gedung', $namagd)->where(function ($query) use ($mulai, $akhir) {
								$query->where(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglmulai', '<', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '<=', $mulai)
									   ->where('tglakhir', '>', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglakhir', '>', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								});
							})->count();
							if ($cekjadwal != 0){	
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Nama Ruang</b></td><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('status', '!=', 'ARSIP')->where('gedung', $namagd)->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglmulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '<=', $mulai)
										   ->where('tglakhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglakhir', '>', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									});
								})->get();
								foreach( $getjadwal as $rjadwal ){
									$idruang		= $rjadwal->ruang;
									$getnamaruang	= Ruang::where('id', $idruang)->first();
									if (isset($getnamaruang->namarg)){
										$namarg		= $getnamaruang->namarg;
									} else {
										$namarg		= '';
									}
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->namarg.'</td><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $result->id,
								'namarg' 		=> '',
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> '',
								'petugas' 		=> '',
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> '',
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				}
			}  else {
				if ($jencari == 'ruang'){
					$jruang 	= Ruang::where('id', $valcari)->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitasujian;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('jenisjadwal', '1')->where('ruang', $idruang)->where('status', '!=', 'ARSIP')->where(function ($query) use ($mulai, $akhir) {
								$query->where(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglmulai', '<', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '<=', $mulai)
									   ->where('tglakhir', '>', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglakhir', '>', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								});
							})->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('jenisjadwal', '1')->where('ruang', $idruang)->where('status', '!=', 'ARSIP')->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglmulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '<=', $mulai)
										   ->where('tglakhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglakhir', '>', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									});
								})->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.' until '.$akhir.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->namarg,
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> $result->koderg,
								'petugas' 		=> $result->petugas,
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->pinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else if ($jencari == 'mobil'){
					$jruang 	= Kendaraan::where('id', $valcari)->orderBy('kodegarasi', 'ASC')->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$marking 	= $result->marking;
							$pjgedung 	= $result->pjgedung;
							$idruang 	= $result->id;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('jenisjadwal', '2')->where('ruang', $idruang)->where('status', '!=', 'ARSIP')->where(function ($query) use ($mulai, $akhir) {
								$query->where(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglmulai', '<', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '<=', $mulai)
									   ->where('tglakhir', '>', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglakhir', '>', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								});
							})->count();
							if ($cekjadwal != 0){
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('jenisjadwal', '2')->where('ruang', $idruang)->where('status', '!=', 'ARSIP')->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglmulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '<=', $mulai)
										   ->where('tglakhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglakhir', '>', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									});
								})->get();
								foreach( $getjadwal as $rjadwal ){
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.' until '.$akhir.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $idruang,
								'namarg' 		=> $result->merek,
								'namagd' 		=> $result->garasi,
								'kodegd' 		=> $result->kodegarasi,
								'koderg' 		=> $result->kodekendaraan,
								'petugas' 		=> $result->driver,
								'marking' 		=> $marking,
								'luas' 			=> $result->nopol,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> $result->utilitas,
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				} else {
					$jruang 	= Gedung::where('namagd', $valcari)->get();
					if (!empty($jruang)){
						foreach ($jruang as $result) {
							$kapasitas 	= $result->kapasitas;
							$pjgedung 	= $result->pjgedung;
							$namagd 	= $result->namagd;
							$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
							if(isset($getpejabat->pejabat)){
								$pejabat= $getpejabat->pejabat;
							} else { $pejabat = ''; }
							
							if ($kapasitas == 0){ 
								$kapasitas 	= '<small class="label bg-red">Not Available</small>'; 
								$marking 	= 'NO'; 
							} else {
								$marking	= 'YES';
							}
							$cekjadwal 	= Jadwal::where('gedung', $namagd)->where('status', '!=', 'ARSIP')->where(function ($query) use ($mulai, $akhir) {
								$query->where(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglmulai', '<', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '<=', $mulai)
									   ->where('tglakhir', '>', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglakhir', '>', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								})->orWhere(function ($q) use ($mulai, $akhir) {
									$q->where('tglmulai', '>=', $mulai)
									   ->where('tglakhir', '<=', $akhir);
								});
							})->count();
							if ($cekjadwal != 0){	
								$jadwalguna = '<table class="table table-stripped table-bordered"><tr><td><b>Nama Ruang</b></td><td><b>Terjadwal</b></td><td><b>Acara</b></td><td><b>Keterangan</b></td></tr>';
								$getjadwal 	= Jadwal::where('gedung', $namagd)->where('status', '!=', 'ARSIP')->where(function ($query) use ($mulai, $akhir) {
									$query->where(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglmulai', '<', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '<=', $mulai)
										   ->where('tglakhir', '>', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglakhir', '>', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									})->orWhere(function ($q) use ($mulai, $akhir) {
										$q->where('tglmulai', '>=', $mulai)
										   ->where('tglakhir', '<=', $akhir);
									});
								})->get();
								foreach( $getjadwal as $rjadwal ){
									$idruang		= $rjadwal->ruang;
									$getnamaruang	= Ruang::where('id', $idruang)->first();
									if (isset($getnamaruang->namarg)){
										$namarg		= $getnamaruang->namarg;
									} else {
										$namarg		= '';
									}
									$jadwalguna	= $jadwalguna.'<tr><td>'.$rjadwal->namarg.'</td><td>'.$rjadwal->mulai.' s/d '.$rjadwal->akhir.'</td><td>'.$rjadwal->keperluan.'</td><td>'.$rjadwal->keterangan.'</td></tr>';
								}
								$jadwalguna	= $jadwalguna.'</table>';
							} else {
								$jadwalguna = '<small class="label bg-green">Full Available on '.$mulai.' until '.$akhir.'</small>';
							}
							if (is_null($result->foto)){
								$foto = '';
							} else {
								$foto = $result->foto;
							}
							$arrayruang[] = array(
								'dot' 			=> $result->id,
								'namarg' 		=> '',
								'namagd' 		=> $result->namagd,
								'kodegd' 		=> $result->kodegd,
								'koderg' 		=> '',
								'petugas' 		=> '',
								'marking' 		=> $marking,
								'luas' 			=> $result->luas,
								'kondisi' 		=> $result->kondisi,
								'utilitas' 		=> '',
								'kapasitas' 	=> $kapasitas,
								'statpinjam' 	=> $result->statpinjam,
								'tarif' 		=> $result->tarif,
								'fakpanjang' 	=> $result->fakpanjang,
								'fakultas' 		=> $result->fakultas,
								'inputor' 		=> $result->inputor,
								'pjgedung' 		=> $pjgedung,
								'pejabat' 		=> $pejabat,
								'jadwalguna' 	=> $jadwalguna,
								'foto' 			=> $foto,
							);
						}
					}
				}
			}
		}
		echo json_encode($arrayruang);
    }
	public function jsonAllpinjam(Request $request) {
    	$jencari    = $request->val01;
		$bulan    	= $request->val02;
		$tahun    	= $request->val03;
		$aktif    	= $request->val04;
		$arrayruang	= [];
		if ($aktif == 'ARSIP'){
			if ($jencari == 'ALL'){
				if ($bulan == 'ALL'){
					if ($tahun == 'ALL'){
						$getjadwal = Jadwal::where('fakultas', Session('fakultas'))->where('status', 'ARSIP')->get();
					} else {						
						$getjadwal = Jadwal::whereYear('mulai', $tahun)->where('fakultas', Session('fakultas'))->where('status', 'ARSIP')->get();
					}
				} else {
					$getjadwal = Jadwal::whereYear('mulai', $tahun)->whereMonth('mulai', $bulan)->where('fakultas', Session('fakultas'))->where('status', 'ARSIP')->get();
				}
			} else {
				if ($bulan == 'ALL'){
					if ($tahun == 'ALL'){
						$getjadwal = Jadwal::where('jenisjadwal', $jencari)->where('fakultas', Session('fakultas'))->where('status', 'ARSIP')->get();
					} else {						
						$getjadwal = Jadwal::where('jenisjadwal', $jencari)->whereYear('mulai', $tahun)->where('fakultas', Session('fakultas'))->where('status', 'ARSIP')->get();
					}
				} else {
					$getjadwal = Jadwal::where('jenisjadwal', $jencari)->whereYear('mulai', $tahun)->whereMonth('mulai', $bulan)->where('fakultas', Session('fakultas'))->where('status', 'ARSIP')->get();
				}
			}
		} else {
			if ($jencari == 'ALL'){
				if ($bulan == 'ALL'){
					if ($tahun == 'ALL'){
						$getjadwal = Jadwal::where('fakultas', Session('fakultas'))->where('status', '!=', 'ARSIP')->get();
					} else {						
						$getjadwal = Jadwal::whereYear('mulai', $tahun)->where('fakultas', Session('fakultas'))->where('status', '!=', 'ARSIP')->get();
					}
				} else {
					$getjadwal = Jadwal::whereYear('mulai', $tahun)->whereMonth('mulai', $bulan)->where('fakultas', Session('fakultas'))->where('status', '!=', 'ARSIP')->get();
				}
			} else {
				if ($bulan == 'ALL'){
					if ($tahun == 'ALL'){
						$getjadwal = Jadwal::where('jenisjadwal', $jencari)->where('fakultas', Session('fakultas'))->where('status', '!=', 'ARSIP')->get();
					} else {						
						$getjadwal = Jadwal::where('jenisjadwal', $jencari)->whereYear('mulai', $tahun)->where('fakultas', Session('fakultas'))->where('status', '!=', 'ARSIP')->get();
					}
				} else {
					$getjadwal = Jadwal::where('jenisjadwal', $jencari)->whereYear('mulai', $tahun)->whereMonth('mulai', $bulan)->where('fakultas', Session('fakultas'))->where('status', '!=', 'ARSIP')->get();
				}
			}			
		}
		if (!empty($getjadwal)){
			foreach($getjadwal as $rjadwal){
				$jenisjadwal 		= $rjadwal->jenisjadwal;
				$ruang 				= $rjadwal->ruang;
				$gedung 			= $rjadwal->gedung;
				$mulai 				= $rjadwal->mulai;
				$akhir 				= $rjadwal->akhir;
				$peminjam 			= $rjadwal->peminjam;
				$instansi 			= $rjadwal->instansi;
				$keperluan 			= $rjadwal->keperluan;
				$keterangan 		= $rjadwal->keterangan;
				$suratpermohonan 	= $rjadwal->suratpermohonan;
				$inputor 			= $rjadwal->inputor;
				$biaya 				= $rjadwal->biaya;
				$status	 			= $rjadwal->status;
				$kapasitas 			= '';
				$marking 			= '';
				$pjgedung 			= '';
				$idruang 			= '';
				$namarg 			= '';
				$namagd 			= '';
				$kodegd 			= '';
				$koderg 			= '';
				$petugas 			= '';
				$luas 				= '';
				$kondisi			= '';
				$utilitas			= '';
				$pinjam				= '';
				$tarif				= '';
				$fakpanjang			= '';
				$fakultas			= '';
				$inputor			= '';
				$foto 				= '';
				$pejabat 			= ''; 
				if ($jenisjadwal == 1){
					$jenisjadwal	= 'RUANG';
					$result = Ruang::where('id', $ruang)->first();
					if (isset($result->id)){
						$kapasitas 	= $result->kapasitasujian;
						$marking 	= $result->marking;
						$pjgedung 	= $result->pjgedung;
						$idruang 	= $result->id;
						$namarg 	= $result->namarg;
						$namagd 	= $result->namagd;
						$kodegd 	= $result->kodegd;
						$koderg 	= $result->koderg;
						$petugas 	= $result->petugas;
						$luas 		= $result->luas;
						$kondisi	= $result->kondisi;
						$utilitas	= $result->utilitas;
						$pinjam		= $result->pinjam;
						$tarif		= $result->tarif;
						$fakpanjang	= $result->fakpanjang;
						$fakultas	= $result->fakultas;
						$inputor	= $result->inputor;
						if (is_null($result->foto)){
							$foto 	= '';
						} else {
							$foto 	= $result->foto;
						}
						$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
						if(isset($getpejabat->pejabat)){
							$pejabat= $getpejabat->pejabat;
						} else { $pejabat = ''; }
						
					}
				} else if ($jenisjadwal == 2){
					$jenisjadwal	= 'KENDARAAN';
					$result = Kendaraan::where('id', $ruang)->first();
					if (isset($result->id)){
						$kapasitas 	= $result->kapasitas;
						$marking 	= $result->marking;
						$pjgedung 	= $result->pjgedung;
						$idruang 	= $result->id;
						$namarg 	= $result->merek.' ( '.$result->nopol.' )';
						$namagd 	= $result->garasi;
						$kodegd 	= $result->kodegarasi;
						$koderg 	= $result->kodekendaraan;
						$petugas 	= $result->driver;
						$luas 		= $result->nopol;
						$kondisi	= $result->kondisi;
						$utilitas	= $result->utilitas;
						$pinjam		= $result->statpinjam;
						$tarif		= $result->tarif;
						$fakpanjang	= $result->fakpanjang;
						$fakultas	= $result->fakultas;
						$inputor	= $result->inputor;
						if (is_null($result->foto)){
							$foto 	= '';
						} else {
							$foto 	= $result->foto;
						}
						$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
						if(isset($getpejabat->pejabat)){
							$pejabat= $getpejabat->pejabat;
						} else { $pejabat = ''; }
						
					}
				} else {
					$jenisjadwal	= 'GEDUNG';
					$result = Gedung::where('id', $ruang)->first();
					if (isset($result->id)){
						$idruang 	= $result->id;
						$kapasitas 	= $result->kapasitas;
						$pjgedung 	= $result->pjgedung;
						$namagd 	= $result->namagd;
						$kodegd 	= $result->kodegd;
						$luas 		= $result->luas;
						$kondisi	= $result->kondisi;
						$pinjam		= $result->statpinjam;
						$tarif		= $result->tarif;
						$fakpanjang	= $result->fakpanjang;
						$fakultas	= $result->fakultas;
						$inputor	= $result->inputor;
						if (is_null($result->foto)){
							$foto 	= '';
						} else {
							$foto 	= $result->foto;
						}
						$getpejabat = Pejabatsurat::where('id', $pjgedung)->first();
						if(isset($getpejabat->pejabat)){
							$pejabat= $getpejabat->pejabat;
						} else { $pejabat = ''; }
						
					}
				}
				$cekdisposisi		= $fakultas.'-RENT-'.$rjadwal->id;
				$getidsurat			= Suratmasuk::where('marking', $cekdisposisi)->first();
				if (isset($getidsurat->id)){
					$idsurat		= $getidsurat->id;
				} else { $idsurat = 0; }
				$arrayruang[] = array(
					'dot' 			=> $rjadwal->id,
					'namarg' 		=> $namarg,
					'namagd' 		=> $namagd,
					'kodegd' 		=> $kodegd,
					'koderg' 		=> $koderg,
					'petugas' 		=> $petugas,
					'marking' 		=> $marking,
					'luas' 			=> $luas,
					'kondisi' 		=> $kondisi,
					'utilitas' 		=> $utilitas,
					'kapasitas' 	=> $kapasitas,
					'statpinjam' 	=> $pinjam,
					'tarif' 		=> $tarif,
					'fakpanjang' 	=> $fakpanjang,
					'fakultas' 		=> $fakultas,
					'pjgedung' 		=> $pjgedung,
					'pejabat' 		=> $pejabat,
					'foto' 			=> $foto,
					'idruang' 		=> $idruang,
					'idgedung' 		=> $rjadwal->gedung,
					'email'         => $rjadwal->email,
					'hape'         	=> $rjadwal->hape,
					'tglmulai'      => $rjadwal->tglmulai,
					'tglakhir'      => $rjadwal->tglakhir,
					'jammulai'      => $rjadwal->jammulai,
					'jamakhir'      => $rjadwal->jamakhir,
					'mulai' 		=> $rjadwal->mulai,
					'akhir'			=> $rjadwal->akhir,
					'peminjam'		=> $rjadwal->peminjam,
					'instansi'		=> $rjadwal->instansi,
					'keperluan'		=> $rjadwal->keperluan,
					'keterangan'	=> $rjadwal->keterangan,
					'surat' 		=> $rjadwal->suratpermohonan,
					'inputor' 		=> $rjadwal->inputor,
					'biaya' 		=> $rjadwal->biaya,
					'status'		=> $rjadwal->status,
					'jenisjadwal'	=> $jenisjadwal,
					'idsurat'		=> $idsurat,
				);
			}
		}
		echo json_encode($arrayruang);
    }
    public function rekapTamu() {
    	$getalldata = Bukutamu::whereDate('created_at', Carbon::today())->groupBy('pejabat')->get();
		$arrrekap	= [];

		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$jumlah 	= Bukutamu::whereDate('created_at', Carbon::today())->where('pejabat', $pejabat)->count();
				$arrrekap[] = array(
					'pejabat' 		=> $pejabat,
					'jumlah' 		=> $jumlah,
				);
			}
		}
		echo json_encode($arrrekap);
    }
    public function bukuTamu() {
    	$getalldata = Bukutamu::whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->get();
		$arrrekap	= [];
		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$arrrekap[] = array(
					'nama' 		=> $rdata->nama,
					'instansi' 	=> $rdata->instansi,
					'keperluan' => $rdata->keperluan,
					'hape' 		=> $rdata->hape,
					'email' 	=> $rdata->email,
					'pejabat' 	=> $rdata->pejabat,
					'foto' 		=> $rdata->foto,
					'tanggal' 	=> $rdata->created_at,
				);
			}
		}
		echo json_encode($arrrekap);
    }
    public function exbukuTamu(Request $request) {
        $nama   	= $request->input('val02');
		$instansi  	= $request->input('val03');
		$idpejabat  = $request->input('val04');
		$keperluan  = $request->input('val05');
		$email  	= $request->input('val06');
		$hape  		= $request->input('val07');
		$foto		= '';
		if($request->hasFile('file')) {
			$ImageExt	= $request->file('file')->getClientOriginalExtension();
			$file_tmp	= $request->file('file');
			$data 		= file_get_contents($file_tmp);
			$foto 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
		}
		$iduser		= 0;
		$getnama 	= User::where('id', $idpejabat)->first();
		if (isset($getnama->id)){
			$iduser		= $getnama->id;
			$pejabat	= $getnama->nama;
		} else {
			$pejabat 	= $idpejabat;
		}
		$input = Bukutamu::create([
			'nama'			=> $nama,
			'instansi'		=> $instansi,
			'keperluan'		=> $keperluan,
			'hape'			=> $hape,
			'email'			=> $email,
			'pejabat'		=> $pejabat,
			'foto'			=> $foto
		]);
		if ($input){
			if ($foto != ''){
				$foto = '<img src="'.$foto.'" width="100" />';
			}
			if ($iduser != 0){
				$tanggal 	= date("d M Y");
				$tuliskirim = 'Yth.'.$pejabat.' Ada Tamu Buat Anda, dengan keperluan '.$keperluan;
				$keperluan 	= 'Pada '.$tanggal.' Tamu dari '.$instansi.' Bernama '.$nama.' ingin menemui anda, dengan keperluan '.$keperluan.$foto;
				Jadwal::create([
					'jenisjadwal'      	=>  '0',
					'ruang'         	=>  '',
					'gedung'         	=>  'Loby',
					'mulai'    			=>  Carbon::now(),
					'akhir'     		=>  Carbon::now()->addHour(),
					'peminjam'      	=>  $pejabat,
					'keperluan'     	=>  $keperluan,
					'keterangan'		=>  'Tamu Tanggal '.$tanggal,
					'suratpermohonan'	=>  '',
					'inputor' 			=>  $pejabat,
					'biaya' 			=>  ''
				]);
				$caritoken 		= Firebasebank::where('userid', $idpejabat)->count();
				if ($caritoken != 0){
					$jtokencari	= Firebasebank::where('userid', $idpejabat)->get();
					foreach ( $jtokencari as $rtokencari ){
						$firebaseid = $rtokencari->firebase;
						$msg = array (
							'message' 	=> $tuliskirim,
							'title'		=> 'SCO',
							'subtitle'	=> 'Universitas Brawijaya',
							'tickerText'=> 'Ada Tamu',
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
							'Authorization: key=' . API_ACCESS_KEY3,
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
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Welcome '.$nama]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
			return back();
		}		
    }
    public function exTamucari(Request $request) {
        $tahun   	= $request->input('val01');
		$bulan  	= $request->input('val02');
		if ($tahun == ''){ $tahun = date("Y"); }
		if ($bulan == 'ALL'){
			$getalldata = Bukutamu::whereDate('created_at', 'LIKE', $tahun.'%')->get();
		} else {
			$getalldata = Bukutamu::whereDate('created_at', 'LIKE', $tahun.'-'.$bulan.'%')->get();
		}
		
		$arrrekap	= [];
		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$arrrekap[] = array(
					'nama' 		=> $rdata->nama,
					'instansi' 	=> $rdata->instansi,
					'keperluan' => $rdata->keperluan,
					'hape' 		=> $rdata->hape,
					'email' 	=> $rdata->email,
					'pejabat' 	=> $rdata->pejabat,
					'foto' 		=> $rdata->foto,
					'tanggal' 	=> $rdata->created_at,
				);
			}
		}
		echo json_encode($arrrekap);
	}
	public function viewJadwalsatpam() {
		$data 				= [];
		$gedungs			= [];
		$fakultas			= Session('fakultas');
		$gedungs 			= Gedung::where('fakultas', $fakultas)->orderBy('namagd', 'ASC')->get();
    	$pegawai 			= User::where('fakultas', $fakultas)->orderBy('nama', 'ASC')->get();
    	$data['tahunne']	= date("Y");
    	$data['gedungs']	= $gedungs;
    	$data['pegawai']	= $pegawai;
    	$data['sidebar']	= 'jadwalsatpam';
    	return view('admin.jadwalsatpam', $data);
	}
	public function jsonTabelsatpam(Request $request) {
		$arrayjadwal 	= array();		
		$bulan    		= $request->input('val01');
		$tahun  		= $request->input('val02');
		if ($bulan == 'ALL'){
			$jadwals   	= Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'%')
			->where('fakultas', Session('fakultas'))
			->get();
		} else {
			$jadwals   	= Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'-%')
			->where('fakultas', Session('fakultas'))
			->get();
		}
        foreach ($jadwals as $rjadwal) {
			$arrayjadwal[] = array(
                'idne'		=> $rjadwal->id,
                'tanggal' 	=> $rjadwal->tanggal,
                'shift1'    => $rjadwal->shift1,
                'shift2'  	=> $rjadwal->shift2,
                'shift3'  	=> $rjadwal->shift3,
                'shift4'  	=> $rjadwal->shift4,
              	'fakultas' 	=> $rjadwal->fakultas,
            );
        }
		
        echo json_encode($arrayjadwal);
	}
	public function jsonRekapsatpam(Request $request) {
		$arrayjadwal 	= array();		
		$bulan    		= $request->input('val01');
		$tahun  		= $request->input('val02');
		$jadwals 		= User::where('fakultas', Session('fakultas'))->get();
		if (!empty($jadwals)){
			foreach ($jadwals as $rjadwal) {
				$satpam 	= $rjadwal->nama;
				$shift1		= 0;
				$shift2		= 0;
				$shift3		= 0;
				$shift4		= 0;
				
				if ($bulan == 'ALL'){
					$shift1 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'%')
								->where('fakultas', Session('fakultas'))
								->where('shift1', $satpam)
								->count();
					$shift2 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'%')
								->where('fakultas', Session('fakultas'))
								->where('shift2', $satpam)
								->count();
					$shift3 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'%')
								->where('fakultas', Session('fakultas'))
								->where('shift3', $satpam)
								->count();
					$shift4 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'%')
								->where('fakultas', Session('fakultas'))
								->where('shift4', $satpam)
								->count();
				} else {
					$shift1 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'-%')
								->where('fakultas', Session('fakultas'))
								->where('shift1', $satpam)
								->count();
					$shift2 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'-%')
								->where('fakultas', Session('fakultas'))
								->where('shift2', $satpam)
								->count();
					$shift3 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'-%')
								->where('fakultas', Session('fakultas'))
								->where('shift3', $satpam)
								->count();
					$shift4 = Jadwalsatpam::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'-%')
								->where('fakultas', Session('fakultas'))
								->where('shift4', $satpam)
								->count();
				}
				$total = $shift1 + $shift2 + $shift3 + $shift4;
				if ($total != 0){
					$arrayjadwal[] = array(
						'satpam'		=> $satpam,
						'shift1'		=> $shift1,
						'shift2'		=> $shift2,
						'shift3'		=> $shift3,
						'shift4'		=> $shift4,
						'total'			=> $total,
					
					);
				}
				
			}
		}
        echo json_encode($arrayjadwal);
	}
	public function exJadsatpam(Request $request) {
    	$tanggal    = $request->set01;
		$shift1     = $request->set02;
		$shift2     = $request->set03;
		$shift3     = $request->set04;
		$shift4     = $request->set05;
		$idne       = $request->set06;
		$ceksudah 	= Jadwalsatpam::where('tanggal', $tanggal)->where('fakultas', Session('fakultas'))->count();
		if ($ceksudah != 0){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' => 'Jadwal Tanggal '.$tanggal.' Sudah Ada. Gunakan Fasilitas Edit Bila Ingin Mengubah']);
		} else {
			$double 	= '';
			if ($shift1 == $shift2){ $double = 'Shift1 dan Shift 2 Tidak Boleh Orang yang Sama'; }
			if ($shift1 == $shift3){ $double = 'Shift1 dan Shift 3 Tidak Boleh Orang yang Sama'; }
			if ($shift1 == $shift4){ $double = 'Shift1 dan Shift 4 Tidak Boleh Orang yang Sama'; }
			if ($shift2 == $shift3){ $double = 'Shift2 dan Shift 3 Tidak Boleh Orang yang Sama'; }
			if ($shift2 == $shift4){ $double = 'Shift2 dan Shift 4 Tidak Boleh Orang yang Sama'; }
			if ($shift3 == $shift4){ $double = 'Shift3 dan Shift 4 Tidak Boleh Orang yang Sama'; }
			if ($double == ''){
				$input = Jadwalsatpam::create([
					'tanggal'	=> $tanggal,
					'shift1'	=> $shift1,
					'shift2'	=> $shift2,
					'shift3'	=> $shift3,
					'shift4'	=> $shift4,
					'fakultas'	=> Session('fakultas'),
				]);
				if ($input){
					if ($shift1 != ''){
						$mulai = $tanggal.' 06:00:00';
						$akhir = $tanggal.' 14:00:00';
						Jadwal::create([
							'jenisjadwal'      	=>  '0',
							'ruang'         	=>  Session('fakultas'),
							'gedung'         	=>  Session('fakpanjang'),
							'tglmulai'      	=>  $tanggal,
							'tglakhir'      	=>  $tanggal,
							'jammulai'      	=>  '06:00:00',
							'jamakhir'      	=>  '14:00:00',
							'mulai'    			=>  $mulai,
							'akhir'     		=>  $akhir,
							'peminjam'      	=>  $shift1,
							'keperluan'     	=>  'JADWAL SECURITY',
							'keterangan'		=>  'shift1',
							'suratpermohonan'	=>  '',
							'inputor' 			=>  Session('nama'),
							'fakultas' 			=>  Session('fakultas')
						]);
					}
					if ($shift2 != ''){
						$mulai = $tanggal.' 14:00:00';
						$akhir = $tanggal.' 22:00:00';
						Jadwal::create([
							'jenisjadwal'      	=>  '0',
							'ruang'         	=>  Session('fakultas'),
							'gedung'         	=>  Session('fakpanjang'),
							'tglmulai'      	=>  $tanggal,
							'tglakhir'      	=>  $tanggal,
							'jammulai'      	=>  '14:00:00',
							'jamakhir'      	=>  '22:00:00',
							'mulai'    			=>  $mulai,
							'akhir'     		=>  $akhir,
							'peminjam'      	=>  $shift2,
							'keperluan'     	=>  'JADWAL SECURITY',
							'keterangan'		=>  'shift2',
							'suratpermohonan'	=>  '',
							'inputor' 			=>  Session('nama'),
							'fakultas' 			=>  Session('fakultas')
						]);
					}
					if ($shift3 != ''){
						$nextday =date('Y-m-d',strtotime('+1 days',strtotime($tanggal)));
						$mulai = $tanggal.' 22:00:00';
						$akhir = $nextday.' 06:00:00';
						Jadwal::create([
							'jenisjadwal'      	=>  '0',
							'ruang'         	=>  Session('fakultas'),
							'gedung'         	=>  Session('fakpanjang'),
							'tglmulai'      	=>  $tanggal,
							'tglakhir'      	=>  $nextday,
							'jammulai'      	=>  '22:00:00',
							'jamakhir'      	=>  '06:00:00',
							'mulai'    			=>  $mulai,
							'akhir'     		=>  $akhir,
							'peminjam'      	=>  $shift3,
							'keperluan'     	=>  'JADWAL SECURITY',
							'keterangan'		=>  'shift3',
							'suratpermohonan'	=>  '',
							'inputor' 			=>  Session('nama'),
							'fakultas' 			=>  Session('fakultas')
						]);
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Jadwal di Untuk  Tanggal '.$tanggal.' Berhasil di Input']);
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' =>  'Jadwal di Untuk  Tanggal '.$tanggal.' Gagal di Input']);
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' => $double]);
			}
		}
		
	}
	public function exHapusjadwalSaptam(Request $request) {
    	$idne       = $request->val01;
		$datalm   	= Jadwalsatpam::where('id', $idne)->first();
		$deldata   	= Jadwalsatpam::where('id', $idne)->delete();
        if ($deldata){
			Jadwal::where('fakultas', Session('fakultas'))->where('tglmulai', $datalm->tanggal)->where('keperluan', 'JADWAL SECURITY')->delete();
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Jadwal di Untuk  Tanggal '.$datalm->mulai.' Berhasil di Hapus']);
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Error', 'message' => 'Data Tidak Valid']);
		}
		
	}
	public function getKalSatpamlist(Request $request) {
    	$data       =   [];
		$idne		= 	'';
		$bulan   	=   $request->val01;
		$tahun   	=   $request->val02;
		if ($bulan == 'ALL'){
			$jadwals   		= Jadwal::where('mulai', 'LIKE', $tahun.'%')
			->where('fakultas', Session('fakultas'))
			->where('keperluan', 'JADWAL SECURITY')
			->orderBy('mulai', 'DESC')
			->get();
		} else {
			$jadwals   		= Jadwal::where('mulai', 'LIKE', $tahun.'-'.$bulan.'-%')
			->where('fakultas', Session('fakultas'))
			->where('keperluan', 'JADWAL SECURITY')
			->orderBy('mulai', 'DESC')
			->get();
		}
		$idne = '';
		if (!empty($jadwals)){
			foreach($jadwals as $hcari) {
				$gedung     = $hcari->gedung;
				$mulai    	= $hcari->mulai;
				$akhir    	= $hcari->akhir;
				$peminjam   = $hcari->semester;
				$jenis   	= $hcari->jenis;
				if ($idne == ''){ $idne = 'id1'; }
				else { $idne = $hcari->id; }
				$data[] 	= array(
					'id' 			=> $idne,
					'description' 	=> $gedung,
					'location' 		=> $gedung,
					'subject' 		=> $hcari->peminjam,
					'calendar' 		=> $hcari->peminjam,
					'start' 		=> $mulai,
					'end'			=> $akhir,
				);
			}
			if ($idne == ''){
				$mulai		= date('Y-m-d H:i:s');
				$tambah		= ' + 360 second';
				$akhir		= date('Y-m-d h:i:s',strtotime($tambah,strtotime($mulai)));
				$data[] 	= array(
					'id' 			=> 'id1',
					'description' 	=> '',
					'location' 		=> '',
					'subject' 		=> 'No Activity Scheduled',
					'calendar' 		=> '',
					'start' 		=> $mulai,
					'end'			=> $akhir,
				);
			}
		}
		echo json_encode($data);
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
	
}
