<?php

namespace App\Http\Controllers\Sco;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\DaftarAkunPengeluaran;
use App\Models\AnggaranTahunan;
use App\Models\Perbelanjaan;
use App\Simpegpegawai;
use App\Models\LogDataPengeluaran;
use App\Models\PaguJurusan;
use App\Models\BelanjaJurusan;
use App\Setting;
use App\Models\BekasPelaporan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\DaftarAkunPenerimaan;
use App\Models\SaldoTahunan;
use App\User;
use App\Models\RekapPinjaman;
use App\Models\Upah;
use App\Models\TblGaji;
use App\Models\TblGajiPNS;
use App\Models\DppsasAnggota;
use App\Models\Riwayat;
use App\Models\RiwayatGaji;
use App\Models\Ppabp;
use App\Models\Golongan;
use App\Models\KodeTanggunganPajak;
use App\Models\KodeKPRI;
use App\Models\PegawaiKeuangan;
use App\Models\Nomor;
use App\Models\PotonganRutin;
use App\Models\UserKeuangan;
use App\Models\Pinjaman;
use App\Models\SettingKeuangan;
use App\Models\Report;
use App\Models\LampiranSpm;
use App\Models\Sass;
use App\Models\Penerimasurat;
use App\Models\Draftjabpelaksana;
use Carbon\Carbon;
use Validator;
use Session;
use DateTime;
use QrCode;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AdminKeuanganController extends Controller
{
	public function simpanDatapegawai(Request $request) {
		$idne		= $request->input('val01');
		$gaji		= $request->input('val18');
		$tjberas	= $request->input('val20');
		$tjfung		= $request->input('val21');
		$tjupns		= $request->input('val22');
		$tjstruk 	= $request->input('val23');
		$tjlain 	= $request->input('val24');
		$gaji 		= str_replace(',','',$gaji);
		$tjberas 	= str_replace(',','',$tjberas);
		$tjfung 	= str_replace(',','',$tjfung);
		$tjupns 	= str_replace(',','',$tjupns);
		$tjstruk 	= str_replace(',','',$tjstruk);
		$tjlain 	= str_replace(',','',$tjlain);
		$idpangkat 	= $request->input('val04');
		$cekada 	= Simpegpegawai::where('id', $request->input('val01'))->first();
		if (isset($cekada->id)){
			$golongan 	= $cekada->golongan;
			$pangkat 	= $cekada->pangkat;
			$fungsional = $cekada->fungsional;
			$cekpangkat	= Golongan::where('id', $idpangkat)->first();
			if (isset($cekpangkat->id)){
				$golongan 	= $cekpangkat->kode;
				$pangkat 	= $cekpangkat->golongan;
				$fungsional = $cekpangkat->pangkat;
			}
			$update 	= Simpegpegawai::where('id', $request->input('val01'))->update([
				'nip_baru'					=> $request->input('val02'),
				'tmt_golongan'				=> $request->input('val03'),
				'pangkat'					=> $pangkat,
				'golongan'					=> $golongan,
				'fungsional'				=> $fungsional,
				'nama'						=> $request->input('val05'),
				'depan'						=> $request->input('val06'),
				'belakang'					=> $request->input('val07'),
				'norek'						=> $request->input('val08'),
				'namabank'					=> $request->input('val25'),
				'unit_kerja'				=> $request->input('val09'),
				'lab'						=> $request->input('val10'),
				'statusnpwp'				=> $request->input('val11'),
				'status_jabatan'			=> $request->input('val12'),
				'jenispeg'					=> $request->input('val13'),
				'status'					=> $request->input('val14'),
				'npwp'						=> $request->input('val15'),
				'lama_kenaikan_pangkat'		=> $request->input('val16'),
				'karpeg'					=> $request->input('val17'),
				'gajisesuaisk'				=> $gaji,
				'tmtgaji'					=> $request->input('val19'),
				'tjberas'					=> $tjberas,
				'tjfungs'					=> $tjfung,
				'tjupns'					=> $tjupns,
				'tjstruk'					=> $tjstruk,
				'tjlain'					=> $tjlain,
				'kelasjabatan'				=> $idpangkat,
				'pend_akhir'				=> $request->input('val26'),
			]);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Dasar Berhasil di Update']);
				return back();	
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal Hubungi Tim TI Terkait']);
				return back();	
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Pegawai Tidak Valid, Hubungi Tim TI Terkait']);
			return back();	
		}
	}
   	public function getJtblgajipns() {
		$arraysurat = [];
   		$sql 		= TblGajiPNS::orderBy('kode', 'ASC')->orderBy('masakerja', 'ASC')->get();
		foreach ($sql as $hasil) {
			$kode				= $hasil->kode;
			$getdatapangkaat	= Golongan::where('kode', $kode)->first();
			if (isset($getdatapangkaat->pangkat)){
				$pangkat		= $getdatapangkaat->pangkat;
				$golongan		= $getdatapangkaat->golongan;
				$pangkat		= $pangkat.', '.$golongan;
			} else {
				$pangkat		= $hasil->pangkat;
			}
			$arraysurat[] = array(
				'idne' 		=> $hasil->id,
				'kode' 		=> $hasil->kode,
				'masakerja' => $hasil->masakerja,
				'nominal' 	=> $hasil->nominal,
				'golongan' 	=> $hasil->golongan,
				'pangkat' 	=> $pangkat,
		    );
		}
		
		echo json_encode($arraysurat);
   	}
	public function getJtblgajinonpns() {
		$arraysurat = [];
		$sql 		= TblGajiPNS::orderBy('kode', 'ASC')->orderBy('masakerja', 'ASC')->get();
	 	foreach ($sql as $hasil) {
			$kode				= $hasil->kode;
			$getdatapangkaat	= Golongan::where('kode', $kode)->first();
			if (isset($getdatapangkaat->pangkat)){
				$pangkat		= $getdatapangkaat->pangkat;
				$golongan		= $getdatapangkaat->golongan;
				$pangkat		= $pangkat.', '.$golongan;
			} else {
				$pangkat		= $hasil->pangkat;
			}
			$arraysurat[] = array(
				'idne' 		=> $hasil->id,
				'kode' 		=> $hasil->kode,
				'masakerja' => $hasil->masakerja,
				'nominal' 	=> $hasil->nominal,
				'golongan' 	=> $hasil->golongan,
				'pangkat' 	=> $pangkat,
		    );
		}
		
		echo json_encode($arraysurat);
   	}
	public function viewPinjaman() {
		$data 			= [];
		if (Session('spesial') == 'Bendahara Gaji' OR Session('previlage') == 'developer'){
			return view('admin.keuangan.pinjaman', $data);
		} else {
			if (Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
				return view('admin.keuangan.pinjaman', $data);
			} else {
				$data['alasan'] = 'Aksess Denied';
				return view('gakboleh', $data);	
			}
		}
	}
	public function dataJnorek(Request $request) {
		$idpeg		= $request->input('val01');
		$rmaster  	= PegawaiKeuangan::where('idpeg', $idpeg)->first();
		$jenispeg	= $rmaster->jenispeg;
		$nip		= $rmaster->nip;
		$nmpegawai	= $rmaster->nama;
		$golongan	= $rmaster->golongan;
		$npwp		= $rmaster->npwp;

		$count 		= Nomor::where('idpeg', $idpeg)->count();
		if ($count != 0){
			$rpotongan  	= Nomor::where('idpeg', $idpeg)->get();
			foreach ($rpotongan as $jpotongan) {
				$gaji	= $jpotongan->gaji;
				if ($gaji == 1){
					$tlsgaji = '<span class="badge badge-info">No.Rek Gaji</span>'; 
				}
				else { $tlsgaji = ''; }
				$arrpotongan[] = array(
					'idne' 		=> $jpotongan->id,
					'idpeg' 	=> $idpeg,
					'bank'		=> $jpotongan->deskripsi,
					'nama'		=> $jpotongan->namapdrekening,
					'norek'		=> $jpotongan->nomor,
					'tlsgaji' 	=> $tlsgaji,
			);
			}
		}
		$arrpotongan[] = array(
			'idne' 		=> 'new',
			'idpeg' 	=> $idpeg,
			'bank'		=> '<span class="badge badge-danger">Tambah No.Rek</span>', 
			'nama'		=> '',
			'norek'		=> '',
			'tlsgaji' 	=> '',
		);

		echo json_encode($arrpotongan);
	}
	public function dataJpinjaman(Request $request) {
		$idpeg		= $request->input('val01');
		$rmaster  	= PegawaiKeuangan::where('idpeg', $idpeg)->first();
		$jenispeg	= $rmaster->jenispeg;
		$nip		= $rmaster->nip;
		$nmpegawai	= $rmaster->nama;
		$golongan	= $rmaster->golongan;
		$npwp		= $rmaster->npwp;

		$count 		= RekapPinjaman::where('idpeg', $idpeg)->count();
		if ($count != 0){
			$rpotongan  	= RekapPinjaman::where('idpeg', $idpeg)->get();
			foreach ($rpotongan as $jpotongan) {
				$nominal	= number_format( $jpotongan->nominal , 0 , '.' , ',' );
				$arrpotongan[] = array(
					'idne' 		=> $jpotongan->kodepinjaman,
					'nama' 		=> $nmpegawai,
					'idpeg' 	=> $idpeg,
					'nip'		=> $nip,
					'jenispeg'	=> $jenispeg,
					'bank'		=> $jpotongan->nmbank,
					'awalbln'	=> $jpotongan->mulaibln,
					'awalthn'	=> $jpotongan->mulaithn,
					'selama'	=> $jpotongan->sebanyak,
					'timestamp'	=> $jpotongan->created_at,
					'nominal' 	=> $nominal,
			);
			}
		}
		$arrpotongan[] = array(
			'idne' 		=> 'new',
			'nama' 		=> '',
			'idpeg' 	=> $idpeg,
			'nip' 		=> $nip,
			'jenispeg'	=> $jenispeg,
			'bank'		=> '<span class="label label-danger label-block">Tambah Data Pinjaman</span>',
			'awalbln'	=> '',
			'awalthn'	=> '',
			'selama'	=> '',
			'nominal' 	=> '',
			'bulan' 	=> '',
		);

		echo json_encode($arrpotongan);
	}
	public function dataJdetailpinjaman(Request $request) {
		$marking			= $request->input('val01');
		$arrdetpinjaman 	= 	[];

		$jcicilan  	= Pinjaman::where('kodepinjaman', $marking)->orderBy('cicilanke', 'ASC')->get();
		foreach ($jcicilan as $rcicilan) {
			$ceksek = Report::where('bulan', $rcicilan->bulan)->where('tahun', $rcicilan->tahun)->where('idpeg', $rcicilan->idpeg)->where('open', '1')->count();
			if ($ceksek != 0){
				Pinjaman::where('id', $rcicilan->id)->update([
					'status' => 'Masuk Tagihan '.$rcicilan->bulan.$rcicilan->tahun
				]);
			}
			$arrdetpinjaman[] = array(
				'idne' 		=> $rcicilan->id,
				'kec' 		=> $rcicilan->cicilanke,
				'bank'		=> $rcicilan->bank,
				'bulan' 	=> $rcicilan->bulan,
				'tahun' 	=> $rcicilan->tahun,
				'nominal'	=> number_format( $rcicilan->nominal , 0 , '.' , ',' ),
				'status'	=> $rcicilan->status,
			);
		}
		
		echo json_encode($arrdetpinjaman);
	}
	public function exSimpannorek(Request $request) {
		$idne		= $request->input('val01');
		$idpegawai	= $request->input('val02');
		$bank		= $request->input('val03');
		$nama		= $request->input('val04');
		$nomor		= $request->input('val05');
		$jenis		= $request->input('val06');
		if (is_null($jenis)) {
			$jenis 	= 	'';
		}

		if ($idne == 'new'){
			Nomor::create([
				'idpeg' 			=> 	$idpegawai,
				'deskripsi' 		=> 	$bank,
				'namapdrekening' 	=> 	$nama,
				'nomor' 			=> 	$nomor,
				'gaji' 				=> 	$jenis
			]);

			return response()->json(['status' => 'success', 'message' => 'Data Berhasil Ditambahkan']);
		}
		else {
			Nomor::where('id', $idne)->update([
				'deskripsi' 		=> 	$bank,
				'namapdrekening' 	=> 	$nama,
				'nomor' 			=> 	$nomor,
				'gaji' 				=> 	$jenis
			]);

			return response()->json(['status' => 'success', 'message' => 'Data Berhasil Diupdate']);
		}

	}
	public function exSimpanpinjaman(Request $request) {
		$idpegawai	= $request->input('val01');
		$marking	= $request->input('val02');
		$pelaku		= $request->input('val03');
		$thnawal	= $request->input('val04');
		$slmawal	= $request->input('val05');
		$bulan		= (int)$request->input('val06');
		$tahun		= (int)$request->input('val07');
		$selama		= $request->input('val08');
		$bank		= $request->input('val09');
		$tlsnominal	= $request->input('val10');
		$alasan		= $request->input('val11');
		$noloan		= $request->input('val12');

		if ($marking == 'editdetail'){
			if ($alasan == 'KOMPEN'){
				$rcekmarking 	= Pinjaman::where('id', $idpegawai)->first();
				$kodepinjaman	= $rcekmarking->kodepinjaman;
				$jcekcicilan  = Pinjaman::where('kodepinjaman', $kodepinjaman)->where('status', '')->get();
				foreach ($jcekcicilan as $rcekcicilan) {
					$idcicilian = $rcekcicilan->id;
					Pinjaman::where('id', $idcicilian)->update(['status' => 'KOMPEN']);
				}
			} else if ($alasan == 'UBAH1'){
				Pinjaman::where('id', $idpegawai)->update(['nominal' => $pelaku]);
			} else if ($alasan == 'UBAHALL'){
				$rcekmarking 	= Pinjaman::where('id', $idpegawai)->first();
				$kodepinjaman	= $rcekmarking->kodepinjaman;
				Pinjaman::where('kodepinjaman', $kodepinjaman)->where('status', '')->update(['nominal' => $pelaku]);
			} else {
				Pinjaman::where('id', $idpegawai)->update(['status' => $alasan]);
			}
		}
		else {
			$norek		= '';
			if ($bank == 'MANDIRI'){$bankcari = 'PT. BANK MANDIRI (PERSERO) TBK.';}
			else if ($bank == 'BNI'){$bankcari = 'PT. BANK NEGARA INDONESIA(PERSERO) TBK.';}
			else { $bankcari = $bank; }

			$ceknorek 	= Nomor::where('idpeg', $idpegawai)->where('deskripsi', $bankcari)->count();
			if ($ceknorek != 0){
				$rceknorek 	= Nomor::where('idpeg', $idpegawai)->where('deskripsi', $bankcari)->first();
				$norek 		= $rceknorek->nomor;
			}
			if ($marking == 'new'){
				if ($bulan != '' AND $tahun != '' AND $selama != '' AND $tlsnominal != '' AND $bank != ''){
					$nominal 	= str_replace(',','',$tlsnominal);
					$kodepjm	= $idpegawai.'-'.$tahun.'-'.$bulan.'-'.$bank.'-'.$nominal.'-'.$marking;
					$kodepjm	= md5($kodepjm);
					if ($noloan != ''){ $kodepjm = $noloan; }

					$cekdatalm 	= RekapPinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $kodepjm)->count();
					if ($cekdatalm == 0){
						RekapPinjaman::create([
							'idpeg' 		=> 	$idpegawai,
							'kodepinjaman' 	=> 	$kodepjm,
							'nmbank' 		=> 	$bank,
							'norek' 		=> 	$norek,
							'mulaibln' 		=> 	$bulan,
							'mulaithn' 		=> 	$tahun,
							'sebanyak' 		=> 	$selama,
							'nominal' 		=> 	$nominal,
							'marking' 		=> 	1
						]);

						if ($selama != 0){
							$cekcicilan	= Pinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $kodepjm)->orderBy('cicilanke', 'ASC')->count();
							if ($cekcicilan == 0){
								$start = $selama;
								$cicil = 1;
								while ($start != 0){
									$marking= $bulan.$tahun.$idpegawai.$kodepjm;
									Pinjaman::create([
										'idpeg' 		=> 	$idpegawai,
										'kodepinjaman' 	=> 	$kodepjm,
										'bank' 			=> 	$bank,
										'norek' 		=> 	$norek,
										'bulan' 		=> 	$bulan,
										'tahun' 		=> 	$tahun,
										'nominal' 		=> 	$nominal,
										'cicilanke' 	=> 	$cicil,
										'marking' 		=> 	$marking
									]);
									if ($bulan == 12){
										$bulan = 1;
										$tahun = $tahun + 1;
									}
									else {
										$bulan = $bulan + 1;
									}
									$cicil++;
									$start = $start - 1;
								}
							}
							else {
								if ($cekcicilan == $selama){
									$jcekcicilan  = Pinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $kodepjm)->orderBy('cicilanke', 'ASC')->get();
									foreach ($jcekcicilan as $rcekcicilan) {
										$idne 	= $rcekcicilan->id;
										Pinjaman::where('id', $idne)->update([
											'bank' 		=> 	$bank,
											'norek' 	=> 	$norek,
											'bulan' 	=> 	$bulan,
											'tahun' 	=> 	$tahun,
										]);
										if ($bulan == 12){
											$bulan = 1;
											$tahun = $tahun + 1;
										}
										else {
											$bulan = $bulan + 1;
										}
									}
								}
								if ($cekcicilan > $selama){
									$start 		= $cekcicilan;
									$cicil 		= 1;
									while ($start != 0){
										if ($cicil > $selama){
											Pinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $kodepjm)->where('cicilanke', $cicil)->delete();
										}
										if ($bulan == 12){
											$bulan = 1;
											$tahun = $tahun + 1;
										}
										else {
											$bulan = $bulan + 1;
										}
										$cicil++;
										$start = $start - 1;
									}
								}
								else {
									$start 		= $selama;
									$cicil 		= 1;
									while ($start != 0){
										if ($cicil > $cekcicilan){
											$marking= $bulan.$tahun.$idpegawai.$kodepjm;
											Pinjaman::create([
												'idpeg' 		=> 	$idpegawai,
												'kodepinjaman' 	=> 	$kodepjm,
												'bank' 			=> 	$bank,
												'norek' 		=> 	$norek,
												'bulan' 		=> 	$bulan,
												'tahun' 		=> 	$tahun,
												'nominal' 		=> 	$nominal,
												'cicil' 		=> 	$cicil,
												'marking' 		=> 	$marking
											]);
										}
										if ($bulan == 12){
											$bulan = 1;
											$tahun = $tahun + 1;
										}
										else {
											$bulan = $bulan + 1;
										}
										$cicil++;
										$start = $start - 1;
									}
								}
							}
						}

						return response()->json(['status' => 'success', 'message' => 'Input Pinjaman Bank '.$bank.' Sebesar '.$tlsnominal.' Selama '.$selama.' kali. Sukses di Lakukan']);
					}
					else {

						return response()->json(['status' => 'error', 'message' => 'Sistem Error, Kode Akun Terdeteksi Double. Jika ingin merubah data lama, silahkan gunakan menu edit.!']);
					}
				}
				else {

					return response()->json(['status' => 'error', 'message' => 'Mohon mengisi semua form yang disebutkan']);
				}
			}
			else {
				$nominal 	= str_replace(',','',$tlsnominal);
				$rmaster1  	= RekapPinjaman::where('kodepinjaman', $marking)->first();
				$nmbanklm	= $rmaster1->nmbank;
				$mulaiblnlm	= $rmaster1->mulaibln;
				$mulaithnlm	= $rmaster1->mulaithn;
				$sebanyaklm	= $rmaster1->sebanyak;
				$nominallm	= $rmaster1->nominal;
				$nominallm	= number_format( $nominallm , 0 , '.' , ',' );
				RekapPinjaman::where('kodepinjaman', $marking)->update([
					'nmbank' 		=> 	$bank,
					'norek' 		=> 	$norek,
					'mulaibln' 		=> 	$bulan,
					'mulaithn' 		=> 	$tahun,
					'sebanyak' 		=> 	$selama,
					'nominal' 		=> 	$nominal
				]);
				
				$datalama 	= '
					<table class="table table-bordered table-stripped">
						<tr><td>Deskripsi</td><td>Value</td></tr>
						<tr><td>Pinjaman Bank</td><td>'.$nmbanklm.'</td></tr>
						<tr><td>Mulai Bln / Thn</td><td>'.$mulaiblnlm.' / '.$mulaithnlm.'</td></tr>
						<tr><td>Selama</td><td>'.$sebanyaklm.'</td></tr>
						<tr><td>Nominal</td><td>'.$nominallm.'</td></tr>
					</table>
				';
				
				$dataupdate = '
					<table class="table table-bordered table-stripped">
						<tr><td>Deskripsi</td><td>Value</td></tr>
						<tr><td>Pinjaman Bank</td><td>'.$bank.'</td></tr>
						<tr><td>Mulai Bln / Thn</td><td>'.$bulan.' / '.$tahun.'</td></tr>
						<tr><td>Selama</td><td>'.$selama.'</td></tr>
						<tr><td>Nominal</td><td>'.$tlsnominal.'</td></tr>
					</table>
				';

				Riwayat::create([
					'pelaku' 		=> 	$pelaku,
					'korban' 		=> 	$idpegawai,
					'tabel' 		=> 	'Pinjaman',
					'datawal' 		=> 	$datalama,
					'dataupdate' 	=> 	$dataupdate,
					'alasan' 		=> 	$alasan
				]);
				if ($selama != 0){
					$cekcicilan	= Pinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $marking)->orderBy('cicilanke', 'ASC')->count();
					if ($cekcicilan == 0){
						$start = $selama;
						$cicil = 1;
						while ($start != 0){
							Pinjaman::create([
								'idpeg' 		=> 	$idpegawai,
								'kodepinjaman' 	=> 	$marking,
								'bank' 			=> 	$bank,
								'norek' 		=>	$norek,
								'bulan' 		=> 	$bulan,
								'tahun' 		=> 	$tahun,
								'nominal' 		=> 	$nominal,
								'cicilanke' 	=> 	$cicil
							]);
							if ($bulan == 12){
								$bulan = 1;
								$tahun = $tahun + 1;
							}
							else {
								$bulan = $bulan + 1;
							}
							$cicil++;
							$start = $start - 1;
						}
					}
					else {
						if ($cekcicilan == $selama){
							$jcekcicilan  = Pinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $marking)->orderBy('cicilanke', 'ASC')->get();
							foreach ($jcekcicilan as $rcekcicilan) {
								$idne 	= $rcekcicilan->id;
								Pinjaman::where('id', $idne)->update([
									'bank' 		=> 	$bank,
									'norek' 	=> 	$norek,
									'bulan' 	=> 	$bulan,
									'tahun' 	=> 	$tahun,
								]);
								if ($bulan == 12){
									$bulan = 1;
									$tahun = $tahun + 1;
								}
								else {
									$bulan = $bulan + 1;
								}
							}
						}
						if ($cekcicilan > $selama){
							$start 		= $cekcicilan;
							$cicil 		= 1;
							while ($start != 0){
								if ($cicil > $selama){
									Pinjaman::where('idpeg', $idpegawai)->where('kodepinjaman', $marking)->where('cicilanke', $cicil)->delete();
								}
								if ($bulan == 12){
									$bulan = 1;
									$tahun = $tahun + 1;
								}
								else {
									$bulan = $bulan + 1;
								}
								$cicil++;
								$start = $start - 1;
							}
						}
						else {
							$start 		= $selama;
							$cicil 		= 1;
							while ($start != 0){
								if ($cicil > $cekcicilan){
									Pinjaman::create([
										'idpeg' 		=> 	$idpegawai,
										'kodepinjaman' 	=> 	$kodepinjaman,
										'bank' 			=> 	$bank,
										'norek' 		=> 	$norek,
										'bulan' 		=>	$bulan,
										'tahun' 		=> 	$tahun,
										'nominal' 		=> 	$nominal,
										'cicilanke' 	=> 	$cicil
									]);
								}
								if ($bulan == 12){
									$bulan = 1;
									$tahun = $tahun + 1;
								}
								else {
									$bulan = $bulan + 1;
								}
								$cicil++;
								$start = $start - 1;
							}
						}
					}
				}

				return response()->json(['status' => 'success', 'message' => 'Update Pinjaman Bank '.$bank.' Sebesar '.$tlsnominal.' Selama '.$selama.' kali. Sukses di Lakukan']);
			}
		}
	}
	public function viewGaji() {
		$data = [];
		if (Session('previlage') == 'Admin SDM' OR Session('idjabatan') == '5' OR Session('idjabatan') == '76'){
			$data['arrsdomain']  	= DB::table('app_menu')->where('subdomainapps', '!=', 'RKTDPM')->get();
			$data['golongan']  		= Golongan::all();
			return view('admin.keuangan.gajilt3', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
            $data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
		}
	}
	public function exGaji(Request $request) {
		$idne		= $request->input('val01');
		$tambahan	= $request->input('val02');
		$honor		= $request->input('val03');
		$makan		= $request->input('val04');
		$insentif	= $request->input('val05');
		$tambahan 	= str_replace(',','',$tambahan);
		$honor 		= str_replace(',','',$honor);
		$makan 		= str_replace(',','',$makan);
		$insentif 	= str_replace(',','',$insentif);

		Report::where('id', $idne)->update([
			'insentif' 		=> 	$insentif,
			'uangmakan' 	=> 	$makan,
			'honor'			=> 	$honor,
			'tambahangaji' 	=> 	$tambahan,
		]);

		return response()->json(['status' => 'success', 'message' => 'Update Data Gaji Pegawai Sukses']);
	}
	public function generateDataawal(Request $request) {
		$mppabp 	= Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		ini_set('max_execution_time', 700);
		$sberas 	= 0;
		$sutri		= 0;
		$anak1		= 0;
		$anak2		= 0;
		$umr		= 0;
		$setbpjs1	= 0;
		$setbpjs2	= 0;
		$sql 	= SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hinboxread){
			$jenis = $hinboxread->jenis;
			if ($jenis == 'sutri'){ $sutri = $hinboxread->isi1; $idsutri = $hinboxread->id; }
			if ($jenis == 'beras'){ $beras = $hinboxread->isi1; $idberas = $hinboxread->id; }
			if ($jenis == '1anak'){ $anak1 = $hinboxread->isi1; $idanak1 = $hinboxread->id; }
			if ($jenis == '2anak'){ $anak2 = $hinboxread->isi1; $idanak2 = $hinboxread->id; }
			if ($jenis == 'Upah BPJS Ketenagakerjaan (Minimum)'){ $umr = $hinboxread['isi1']; }
			if ($jenis == 'Pungut BPJS Ket Minimum'){ $setbpjs2 = $hinboxread['isi1'];  }
			if ($jenis == 'BPJS Kesehatan (Persen)'){ $setbpjs1 = $hinboxread['isi1'];  }
		}
		$bulan		= (int)$request->input('val01');
		$tahun		= $request->input('val02');
		$arrgaji	= [];
		$nomspm		= 0;
		$dataspm	= 0;
		$ketspm		= '';
		if ($bulan == 1){ $tulisbln = 'Januari'; }
		if ($bulan == 2){ $tulisbln = 'Februari'; }
		if ($bulan == 3){ $tulisbln = 'Maret'; }
		if ($bulan == 4){ $tulisbln = 'April'; }
		if ($bulan == 5){ $tulisbln = 'Mei'; }
		if ($bulan == 6){ $tulisbln = 'Juni'; }
		if ($bulan == 7){ $tulisbln = 'Juli'; }
		if ($bulan == 8){ $tulisbln = 'Agustus'; }
		if ($bulan == 9){ $tulisbln = 'September'; }
		if ($bulan == 10){ $tulisbln = 'Oktober'; }
		if ($bulan == 11){ $tulisbln = 'November'; }
		if ($bulan == 12){ $tulisbln = 'Desember'; }
		$isigak		= '';

		$cekgaji	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->count();
		$nomer		= 1;
		if ($cekgaji != 0){
			$jcekgaji  	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->get();
			foreach ($jcekgaji as $hasil) {
				$master		= $hasil->id;
				$idpeg		= $hasil->idpeg;
				$jenispeg	= $hasil->jenispeg;
				$kdgol		= $hasil->golongan;
				$nip		= $hasil->nip;
				$nama		= $hasil->nama;
				$keterangan	= $hasil->keterangan;
				$fungsional	= $hasil->fungsional;
				$sberas		= $hasil->sberas;
				$bank 		= $hasil->namabank;
				$norek 		= $hasil->norek;
				$nmrek 		= $hasil->namapdrekening;
				$nomgaji	= $hasil->gajisesuaisk;
				$cekstat	= $hasil->statuspegawai;	
				$katgaji	= $hasil->kategorigaji;		
				$tunjsutri	= $hasil->tjistri;
				$tunjanak	= $hasil->tjanak;
				$tunjupns	= $hasil->tjupns;
				$tunjstruk	= $hasil->tjstruk;		
				$tunjfung	= $hasil->tjfungs;
				$tjdaerah	= $hasil->tjdaerah;
				$tjpencil	= $hasil->tjpencil;
				$tjlain		= $hasil->tjlain;
				$tjkompen	= $hasil->tjkompen;
				$pembul		= $hasil->pembul;
				$tunjberas	= $hasil->tjberas;
				$tjpph		= $hasil->tjpph;		
				$potpfkbul	= $hasil->potpfkbul;
				$potpfk2	= $hasil->potpfk2;
				$potpfk10	= $hasil->potpfk10;
				$potpph		= $hasil->potpph;
				$potswrum	= $hasil->potswrum;
				$potkelbtj	= $hasil->potkelbtj;
				$potlain	= $hasil->potlain;
				$pottabrum	= $hasil->pottabrum;
				$bankkpri	= $hasil->bankkpri;
				$bankukp	= $hasil->bankukp;
				$tabukp		= $hasil->tabukp;
				$bni		= $hasil->bni;
				$mandiri	= $hasil->mandiri;
				$brisuhat	= $hasil->brisuhat;
				$briub		= $hasil->briub;
				$jatim		= $hasil->jatim;
				$btpn		= $hasil->btpn;
				$btn 		= $hasil->btn;
				$kpri 		= $hasil->kpri;
				$arisan 	= $hasil->arisan;
				$sumbangan 	= $hasil->sumbangan;
				$bpjsbpu 	= $hasil->bpjsbpu;
				$bpjskes 	= $hasil->bpjskes;
				$bpjsket 	= $hasil->bpjsket;
				$korpri 	= $hasil->korpri;
				$dewe 		= $hasil->dewe;
				$marking	= $hasil->marking;
				$ppabp		= $hasil->ppabp;
				$insentif	= $hasil->insentif;
				$uangmakan	= $hasil->uangmakan;
				$potinsentif	= $hasil->potinsentif;
				$potuangmakan	= $hasil->potuangmakan;
				
				
				$tottunjangan	= $tunjsutri + $tunjanak + $tunjupns + $tunjstruk + $tunjfung + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph + $tunjberas;
				$kotor			= $nomgaji + $tottunjangan;
				$totpotongan	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $bpjsbpu + $bpjskes + $bpjsket + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum + $tabukp;
				$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
				$totpinjaman	= $bankkpri + $bankukp + $pinjbank;
				$totbayar		= $kotor - $totpinjaman - $totpotongan;
				if ($totbayar < 0) { $hutang = $totbayar; $totbayar = 0; }
				else { $hutang = ''; }
				
				$arrgaji[] = array(
					'nomer' 			=> $nomer,
					'idne' 				=> $master,
					'idpeg' 			=> $idpeg,
					'bulan' 			=> $bulan,
					'tahun' 			=> $tahun,
					'nip' 				=> $nip,
					'nama' 				=> $nama,
					'bank' 				=> $bank,
					'namapdbank' 		=> $nmrek,
					'kdgol' 			=> $kdgol,
					'norek' 			=> $norek,
					'jenispeg' 			=> $jenispeg,
					'statpeg' 			=> $cekstat,
					'kdkawin' 			=> $katgaji,
					'keterangan' 		=> $keterangan,
					'fungsional' 		=> $fungsional,
					'gapok' 			=> $nomgaji,
					'sutri' 			=> $tunjsutri,
					'anak' 				=> $tunjanak,
					'beras' 			=> $tunjberas,
					'sberas' 			=> $sberas,
					'tjupns' 			=> $tunjupns,
					'tjstruk' 			=> $tunjstruk,
					'tjfungs' 			=> $tunjfung,
					'tjdaerah' 			=> $tjdaerah,
					'tjpencil' 			=> $tjpencil,
					'tjkompen' 			=> $tjkompen,
					'pembul' 			=> $pembul,
					'tjpph' 			=> $tjpph,
					'tjlain' 			=> $tjlain,
					'tottunjangan' 		=> $tottunjangan,
					'gajikotor' 		=> $kotor,
					'kpri' 				=> $kpri,
					'korpri' 			=> $korpri,
					'arisan' 			=> $arisan,
					'idewe' 			=> $dewe,
					'sumbangan' 		=> $sumbangan,
					'potpfkbul' 		=> $potpfkbul,
					'potpfk2' 			=> $potpfk2,
					'potpfk10' 			=> $potpfk10,
					'potpph' 			=> $potpph,
					'potswrum' 			=> $potswrum,
					'potkelbtj' 		=> $potkelbtj,
					'potlain' 			=> $potlain,
					'pottabrum' 		=> $pottabrum,
					'tabukp' 			=> $tabukp,
					'bpjsbu' 			=> $bpjsbpu,
					'bpjsket' 			=> $bpjsket,
					'bpjskes' 			=> $bpjskes,
					'totpotongan' 		=> $totpotongan,
					'pinjkpri' 			=> $bankkpri,
					'pinjukp' 			=> $bankukp,
					'pinjbank' 			=> $pinjbank,
					'totpinjaman' 		=> $totpinjaman,
					'totbayar' 			=> $totbayar,
					'hutang' 			=> $hutang,
					'makan' 			=> $uangmakan,
					'insentif' 			=> $insentif,			
					'honor' 			=> $hasil->honor,
					'tambahangaji' 		=> $hasil->tambahangaji,
				);
				$nomer++;
			}
		} else {
			$sql    = DB::table('duidevco_masjid.pegawai as pegawai')
					->leftJoin('duidevco_masjid.potonganrutin as potonganrutin', 'duidevco_masjid.pegawai.idpeg', 'duidevco_masjid.potonganrutin.idpeg')
					->select('duidevco_masjid.pegawai.*', 'duidevco_masjid.potonganrutin.kpri', 'duidevco_masjid.potonganrutin.ukp', 'duidevco_masjid.potonganrutin.korpri', 'duidevco_masjid.potonganrutin.arisan', 'duidevco_masjid.potonganrutin.idw', 'duidevco_masjid.potonganrutin.sumbangan', 'duidevco_masjid.potonganrutin.bpjsbpu', 'duidevco_masjid.potonganrutin.bpjsketenagakerjaan', 'duidevco_masjid.potonganrutin.bpjsppnpn')
					->where('duidevco_masjid.pegawai.ppabp', $mppabp)
					->where('duidevco_masjid.pegawai.status', 1)
					->orderBy('duidevco_masjid.pegawai.jenispeg', 'DESC')
					->orderBy('duidevco_masjid.pegawai.nama', 'ASC')
					->get();
			foreach ($sql as $hasil) {
				$idpeg		= $hasil->idpeg;
				$nip		= $hasil->nip;
				$nama		= $hasil->nama;
				$keterangan	= $hasil->keterangan;
				$fungsional	= $hasil->fungsional;
				$jenispeg	= $hasil->jenispeg;
				$bank 		= $hasil->namabank;
				$norek 		= $hasil->norek;
				$nmrek 		= $hasil->namapdrekening;
				$nomgaji	= $hasil->gajisesuaisk;
				$cekstat	= $hasil->statuspegawai;	
				$katgaji	= $hasil->kategorigaji;
				$tunjberas	= $hasil->tjberas;
				$tunjsutri	= $hasil->tjistri;
				$tunjanak	= $hasil->tjanak;
				$tunjstruk	= $hasil->tjstruk;
				$tunjupns	= $hasil->tjupns;
				$tunjfung	= $hasil->tjfungs;
				$tjdaerah	= $hasil->tjdaerah;
				$tjpencil	= $hasil->tjpencil;
				$tjlain		= $hasil->tjlain;
				$tjkompen	= $hasil->tjkompen;
				$pembul		= $hasil->pembul;
				$tjpph		= $hasil->tjpph;
				$potpfkbul	= $hasil->potpfkbul;
				$potpfk2	= $hasil->potpfk2;
				$potpfk10	= $hasil->potpfk10;
				$potpph		= $hasil->potpph;
				$potswrum	= $hasil->potswrum;
				$potkelbtj	= $hasil->potkelbtj;
				$potlain	= $hasil->potlain;
				$pottabrum	= $hasil->pottabrum;	
				$status		= $hasil->status;
				$kdgol		= $hasil->golongan;
				$ppabp		= $hasil->ppabp;
				if (isset($hasil->id)){
					$idpotongan = $hasil->id;
				} else { $idpotongan = 0; }
				if (isset($hasil->kpri)){
					$kpri = $hasil->kpri;
				} else { $kpri = 0; }
				if (isset($hasil->arisan)){
					$arisan = $hasil->arisan;
				} else { $arisan = 0; }
				if (isset($hasil->sumbangan)){
					$sumbangan = $hasil->sumbangan;
				} else { $sumbangan = 0; }
				if (isset($hasil->bpjsbpu)){
					$bpjsbpu = $hasil->bpjsbpu;
				} else { $bpjsbpu = 0; }
				if (isset($hasil->bpjsppnpn)){
					$bpjskes = $hasil->bpjsppnpn;
				} else { $bpjskes = 0; }
				if (isset($hasil->bpjsketenagakerjaan)){
					$bpjsket = $hasil->bpjsketenagakerjaan;
				} else { $bpjsket = 0; }
				if ($jenispeg == 'PNPN_BOPTN' OR $jenispeg == 'PNS'){
					if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $korpri = 4000; }
					else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $korpri = 3000; }
					else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $korpri = 2000; }
					else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $korpri = 1000; }
					else { $korpri = 1000; }
				}else { $korpri = 1000; }
				if ($jenispeg == 'PNS'){
					if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $dewe = 4000; }
					else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $dewe = 3000; }
					else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $dewe = 2000; }
					else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $dewe = 1000; }
					else { $dewe = 1000; }
				}else { $dewe = 0; }
				if ($jenispeg == 'PNPN_BOPTN'){ $jenis = 'Gaji PNPN PNBP'; }
				else if ($jenispeg == 'PNPN_PNBP'){ $jenis = 'Gaji PNPN BOPTN'; }
				else if ($jenispeg == 'KONTRAK_PNBP'){ $jenis = 'Gaji Kontrak PNBP'; }
				else if ($jenispeg == 'KONTRAK_BOPTN'){ $jenis = 'Gaji Kontrak BOPTN'; }
				else { $jenis = 'Gaji PNS'; }
				$bankkpri	= 0;
				$bankukp	= 0;
				$tabukp		= 0;
				$bni		= 0;
				$mandiri	= 0;
				$brisuhat	= 0;
				$briub		= 0;
				$jatim		= 0;
				$btpn		= 0;
				$btn 		= 0;

				$jcekhutang  		=	Pinjaman::where('idpeg', $idpeg)->where('bulan', $bulan)->where('tahun', $tahun)->where('status', '!=', 'KOMPEN')->get();
				foreach ($jcekhutang as $rcekhutang) {
					$bankutang	= $rcekhutang->bank;
					$utange		= $rcekhutang->nominal;
					if ($bankutang == 'KPRI'){ $bankkpri = $bankkpri + $utange; }
					if ($bankutang == 'UKP'){ $bankukp = $bankukp + $utange; }
					if ($bankutang == 'BNI'){ $bni = $bni + $utange; }
					if ($bankutang == 'MANDIRI'){ $mandiri = $mandiri + $utange; }
					if ($bankutang == 'BRI UB'){ $briub = $briub + $utange; }
					if ($bankutang == 'BRI Soehat'){ $brisuhat = $brisuhat + $utange; }
					if ($bankutang == 'JATIM'){ $jatim = $jatim + $utange; }
					if ($bankutang == 'BPTN'){ $btpn = $btpn + $utange; }
					if ($bankutang == 'BTN'){ $btn = $btn + $utange; }
					if ($bankutang == 'TABUKP'){ $tabukp = $tabukp + $utange; }
				}

				$jcekhutang2  		= RekapPinjaman::where('idpeg', $idpeg)->where('sebanyak', 0)->where('marking', 1)->get();
				foreach ($jcekhutang2 as $rcekhutang2) {
					$bankutang	= $rcekhutang2->nmbank;
					$utange		= $rcekhutang2->nominal;
					if ($bankutang == 'KPRI'){ $bankkpri = $bankkpri + $utange; }
					if ($bankutang == 'UKP'){ $bankukp = $bankukp + $utange; }
					if ($bankutang == 'BNI'){ $bni = $bni + $utange; }
					if ($bankutang == 'MANDIRI'){ $mandiri = $mandiri + $utange; }
					if ($bankutang == 'BRI UB'){ $briub = $briub + $utange; }
					if ($bankutang == 'BRI Soehat'){ $brisuhat = $brisuhat + $utange; }
					if ($bankutang == 'JATIM'){ $jatim = $jatim + $utange; }
					if ($bankutang == 'BPTN'){ $btpn = $btpn + $utange; }
					if ($bankutang == 'BTN'){ $btn = $btn + $utange; }
					if ($bankutang == 'TABUKP'){ $tabukp = $tabukp + $utange; }
				}
				$marking 		= $tahun.$bulan.'-'.$norek;
				$tottunjangan	= $tunjsutri + $tunjanak + $tunjupns + $tunjstruk + $tunjfung + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph + $tunjberas;
				$potonganspm	= $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum;
				//$kotor		= $nomgaji + $tottunjangan + $tgp;
				$kotor			= $nomgaji + $tottunjangan;
				$totalnonbpjs	= $kotor - $potonganspm;
				//$qmaster		= $pdo->prepare("SELECT * FROM potonganrutin WHERE idpeg = ?;");
				//$qmaster->execute(array($idpeg));
				//$cek 			= $qmaster->rowCount();
				
				//if ($bpjskes != 0 AND $jenispeg != 'PNS'){
				//	$bpjskes 	= round((($kotor * $setbpjs1)/100),0);
				//	if ($cek == 0){
				//		$stmt 		= $pdo->prepare("INSERT INTO `potonganrutin` (`id`, `idpeg`, `kpri`, `ukp`, `korpri`, `arisan`, `idw`, `sumbangan`, `bpjsbpu`, `bpjsketenagakerjaan`, `bpjsppnpn`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?);"); 
				//		$stmt->execute(array($idpeg, $kpri, $tabukp, $korpri, $arisan, $dewe, $sumbangan, $bpjsbpu, $bpjsket, $bpjskes));
				//		Database::disconnect();
				//	} else {
				//		$stmt 		= $pdo->prepare("UPDATE `potonganrutin` SET `bpjsppnpn` = ? WHERE `idpeg` = ?;");
				//		$kerja 		= $stmt->execute(array($bpjskes, $idpeg));
				//		Database::disconnect();
				//	}
				//}
				//if ($bpjsket != 0){
				//	if ($kotor <= $umr){
				//		$upahjkn 	= $umr;
				//	} else {
				//		$upahjkn 	= $kotor;
				//	}
				//	$bpjsket 	= round((($upahjkn*3)/100),0);
				//	if ($cek == 0){
				//		$stmt 		= $pdo->prepare("INSERT INTO `potonganrutin` (`id`, `idpeg`, `kpri`, `ukp`, `korpri`, `arisan`, `idw`, `sumbangan`, `bpjsbpu`, `bpjsketenagakerjaan`, `bpjsppnpn`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?);"); 
				//		$stmt->execute(array($idpeg, $kpri, $tabukp, $korpri, $arisan, $dewe, $sumbangan, $bpjsbpu, $bpjsket, $bpjskes));
				//		Database::disconnect();
				//	} else {
				//		$stmt 		= $pdo->prepare("UPDATE `potonganrutin` SET `bpjsketenagakerjaan` = ? WHERE `idpeg` = ?;");
				//		$kerja 		= $stmt->execute(array($bpjsket, $idpeg));
				//		Database::disconnect();
				//	}
				//}
				if ($jenispeg == 'PNS'){
					$ceklampiranspm = LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->first();
					if (isset($ceklampiranspm->bersih)){
						$bersihversispm	= $ceklampiranspm->bersih;
						$bpjskes		= $ceklampiranspm->bpjs;
						if (is_null($bpjskes) OR $bpjskes == 0 OR $bpjskes == ''){
							$bpjskes	= $totalnonbpjs - $bersihversispm;
						}
						$cekpotongan 	= PotonganRutin::where('idpeg', $idpeg)->count();
						if ($cekpotongan == 0){
							PotonganRutin::create([
								'idpeg'					=> $idpeg,
								'kpri'					=> $kpri,
								'ukp'					=> $tabukp,
								'korpri'				=> $korpri,
								'arisan'				=> $arisan,
								'idw'					=> $dewe,
								'sumbangan'				=> $sumbangan,
								'bpjsbpu'				=> $bpjsbpu,
								'bpjsketenagakerjaan'	=> $bpjsket,
								'bpjsppnpn'				=> $bpjskes,
							]);
						} else {
							PotonganRutin::where('idpeg', $idpeg)->update([
								'kpri'					=> $kpri,
								'ukp'					=> $tabukp,
								'korpri'				=> $korpri,
								'arisan'				=> $arisan,
								'idw'					=> $dewe,
								'sumbangan'				=> $sumbangan,
								'bpjsbpu'				=> $bpjsbpu,
								'bpjsketenagakerjaan'	=> $bpjsket,
								'bpjsppnpn'				=> $bpjskes,
							]);
						}
					}
				}
				$totpotongan	= $potonganspm + $kpri + $korpri + $arisan + $dewe + $sumbangan + $bpjsbpu + $bpjskes + $bpjsket + $tabukp;
				$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
				$totpinjaman	= $bankkpri + $bankukp + $pinjbank;
				$totbayar		= $kotor - $totpinjaman - $totpotongan;
				if ($totbayar < 0) { $hutang = $totbayar; $totbayar = 0; }
				else { $hutang = ''; }
				$master 		= '';
				$save 			= Report::create([
								'bulan' 			=> 	$bulan,
								'tahun' 			=> 	$tahun,
								'idpeg' 			=> 	$idpeg,
								'jenispeg' 			=> 	$jenispeg,
								'golongan' 			=> 	$kdgol,
								'nip' 				=> 	$nip,
								'nama' 				=> 	$nama,
								'keterangan' 		=> 	$keterangan,
								'fungsional' 		=> 	$fungsional,
								'sberas' 			=> 	$sberas,
								'namabank' 			=> 	$norek,
								'namapdrekening' 	=> 	$nmrek,
								'gajisesuaisk' 		=> 	$nomgaji,
								'statuspegawai' 	=> 	$cekstat,
								'kategorigaji' 		=> 	$katgaji,
								'tjistri' 			=> 	$tunjsutri,
								'tjanak' 			=> 	$tunjanak,
								'tjupns' 			=> 	$tunjupns,
								'tjstruk' 			=> 	$tunjstruk,
								'tjfungs' 			=> 	$tunjfung,
								'tjdaerah' 			=> 	$tjdaerah,
								'tjpencil' 			=> 	$tjpencil,
								'tjlain' 			=> 	$tjlain,
								'tjkompen' 			=> 	$tjkompen,
								'pembul' 			=> 	$pembul,
								'tjberas' 			=> 	$tunjberas,
								'tjpph' 			=> 	$tjpph,
								'potpfkbul' 		=> 	$potpfkbul,
								'potpfk2' 			=> 	$potpfk2,
								'potpfk10' 			=> 	$potpfk2,
								'potpph' 			=> 	$potpph,
								'potswrum' 			=> 	$potswrum,
								'potkelbtj' 		=> 	$potkelbtj,
								'potlain' 			=> 	$potlain,
								'pottabrum' 		=> 	$pottabrum,
								'bankkpri' 			=> 	$bankkpri,
								'bankukp' 			=> 	$bankukp,
								'tabukp' 			=> 	$tabukp,
								'bni' 				=> 	$bni,
								'mandiri' 			=> 	$mandiri,
								'brisuhat' 			=> 	$brisuhat,
								'briub' 			=> 	$briub,
								'jatim' 			=> 	$jatim,
								'btpn' 				=> 	$btpn,
								'btn' 				=> 	$btn,
								'kpri' 				=> 	$kpri,
								'arisan' 			=> 	$arisan,
								'sumbangan' 		=> 	$sumbangan,
								'bpjsbpu' 			=> 	$bpjsbpu,
								'bpjskes' 			=> 	$bpjskes,
								'bpjsket' 			=> 	$bpjsket,
								'korpri' 			=> 	$korpri,
								'dewe' 				=> 	$dewe,
								'marking'			=> 	$marking,
								'ppabp' 			=> 	$mppabp
							]);

				$master 		= $save->id;
				$arrgaji[] = array(
					'nomer' 			=> $nomer,
					'idne' 				=> $master,
					'idpeg' 			=> $idpeg,
					'bulan' 			=> $bulan,
					'tahun' 			=> $tahun,
					'nip' 				=> $nip,
					'nama' 				=> $nama,
					'bank' 				=> $bank,
					'namapdbank' 		=> $nmrek,
					'kdgol' 			=> $kdgol,
					'norek' 			=> $norek,
					'jenispeg' 			=> $jenispeg,
					'statpeg' 			=> $cekstat,
					'kdkawin' 			=> $katgaji,
					'keterangan' 		=> $keterangan,
					'fungsional' 		=> $fungsional,
					'gapok' 			=> $nomgaji,
					'sutri' 			=> $tunjsutri,
					'anak' 				=> $tunjanak,
					'beras' 			=> $tunjberas,
					'sberas' 			=> $sberas,
					'tjupns' 			=> $tunjupns,
					'tjstruk' 			=> $tunjstruk,
					'tjfungs' 			=> $tunjfung,
					'tjdaerah' 			=> $tjdaerah,
					'tjpencil' 			=> $tjpencil,
					'tjkompen' 			=> $tjkompen,
					'pembul' 			=> $pembul,
					'tjpph' 			=> $tjpph,
					'tjlain' 			=> $tjlain,
					'tottunjangan' 		=> $tottunjangan,
					'gajikotor' 		=> $kotor,
					'kpri' 				=> $kpri,
					'korpri' 			=> $korpri,
					'arisan' 			=> $arisan,
					'idewe' 			=> $dewe,
					'sumbangan' 		=> $sumbangan,
					'potpfkbul' 		=> $potpfkbul,
					'potpfk2' 			=> $potpfk2,
					'potpfk10' 			=> $potpfk10,
					'potpph' 			=> $potpph,
					'potswrum' 			=> $potswrum,
					'potkelbtj' 		=> $potkelbtj,
					'potlain' 			=> $potlain,
					'pottabrum' 		=> $pottabrum,
					'tabukp' 			=> $tabukp,
					'bpjsbu' 			=> $bpjsbpu,
					'bpjsket' 			=> $bpjsket,
					'bpjskes' 			=> $bpjskes,
					'totpotongan' 		=> $totpotongan,
					'pinjkpri' 			=> $bankkpri,
					'pinjukp' 			=> $bankukp,
					'pinjbank' 			=> $pinjbank,
					'totpinjaman' 		=> $totpinjaman,
					'totbayar' 			=> $totbayar,
					'hutang' 			=> $hutang,
					'uangmakan' 		=> $hasil->uangmakan,
					'insentif' 			=> $hasil->insentif,			
					'honor' 			=> $hasil->honor,
					'tambahangaji' 		=> $hasil->tambahangaji,
				);
				$cekgaji++;
				$nomer++;
			}
		}
		echo json_encode($arrgaji);
	}
	public function detailGajisass(Request $request) {
		$mppabp 	= Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		ini_set('max_execution_time', 700);
		$sberas 	= 0;
		$sutri		= 0;
		$anak1		= 0;
		$anak2		= 0;
		$umr		= 0;
		$setbpjs1	= 0;
		$setbpjs2	= 0;
		
		$sql 	= SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hinboxread){
			$jenis = $hinboxread->jenis;
			if ($jenis == 'sutri'){ $sutri = $hinboxread->isi1; $idsutri = $hinboxread->id; }
			if ($jenis == 'beras'){ $beras = $hinboxread->isi1; $idberas = $hinboxread->id; }
			if ($jenis == '1anak'){ $anak1 = $hinboxread->isi1; $idanak1 = $hinboxread->id; }
			if ($jenis == '2anak'){ $anak2 = $hinboxread->isi1; $idanak2 = $hinboxread->id; }
			if ($jenis == 'Upah BPJS Ketenagakerjaan (Minimum)'){ $umr = $hinboxread['isi1']; }
			if ($jenis == 'Pungut BPJS Ket Minimum'){ $setbpjs2 = $hinboxread['isi1'];  }
			if ($jenis == 'BPJS Kesehatan (Persen)'){ $setbpjs1 = $hinboxread['isi1'];  }		
		}
		$bulan		= (int)$request->input('val01');
		$tahun		= $request->input('val02');
		$jenis		= $request->input('val03');
		$nomer		= 1;
		$arrayttl 	= explode(" ", $jenis);
		$jenis1 	= $arrayttl[0];
		if (isset($arrayttl[1])){
			$jenis2 = $arrayttl[1];
		}
		if (isset($arrayttl[2])){
			$jenis3 = $arrayttl[2];
		}
		if (isset($arrayttl[3])){
			$jenis4 = $arrayttl[3];
		}
		$arrpotongan= [];
		if ($jenis1 == 'Pinjaman'){
			$bankcari 		= $jenis3;
			$count			= 0;
			if ($bankcari ==  'UKP'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bankukp', '!=', '0')->get();
				$valbank 	= $bankcari;
			} else if ($bankcari ==  'KPRI'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bankkpri', '!=', '0')->get();
				$valbank 	= $bankcari;
			} else if ($bankcari ==  'BNI'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bni', '!=', '0')->get();
				$valbank 	= 'BNI';
			} else if ($bankcari ==  'MANDIRI'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('mandiri', '!=', '0')->get();
				$valbank 	= $bankcari;
			} else if ($bankcari ==  'BRI'){
				if ($jenis4 == 'UB'){
					$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('briub', '!=', '0')->get();
					$valbank 	= 'BRI UB';
				} else {
					$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('brisuhat', '!=', '0')->get();
					$valbank 	= 'BRI Soehat';
				}
			} else if ($bankcari ==  'JATIM'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('jatim', '!=', '0')->get();
				$valbank 	= $bankcari;
			} else if ($bankcari ==  'BPTN'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('btpn', '!=', '0')->get();
				$valbank 	= $bankcari;
			} else {
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('btn', '!=', '0')->get();
				$valbank 	= $bankcari;
			}
			if (!empty($count)){
				foreach ($count as $rpinjaman) {
					$idne		= $rpinjaman->id;
					$idpeg		= $rpinjaman->idpeg;
					$nip		= $rpinjaman->nip;
					$jenispeg	= $rpinjaman->jenispeg;
					$kdgol		= $rpinjaman->golongan;
					$kdkawin	= $rpinjaman->kategorigaji;
					$namapdbank	= $rpinjaman->namapdrekening;
					$penempatan	= $rpinjaman->keterangan;
					$nama		= $rpinjaman->nama;
					$statpeg	= $rpinjaman->statuspegawai;
					$jcekhutang = Pinjaman::select(DB::raw('SUM(nominal) as totpinjaman'))->where('idpeg', $idpeg)->where('tahun', $tahun)->where('bulan', $bulan)->where('bank', $valbank)->where('status', '!=', 'KOMPEN')->groupBy('norek')->get();
					if (!empty($jcekhutang)){
						foreach ($jcekhutang as $rcekhutang) {
							$bankutang		= $rcekhutang->bank;
							$nominal		= $rcekhutang->totpinjaman;
							$kodepinjaman	= $rcekhutang->kodepinjaman;
							$norek			= $rcekhutang->norek;
							$sudahbyr		= 0;
							$belumbyr		= 0;
							$totalhtg		= 0;
							$cicilanke		= 0;
							$nominal		= round($nominal, 0);
							$jenpinjaman	= '';
							$jcekhtg		= Pinjaman::where('idpeg', $idpeg)->where('kodepinjaman', $kodepinjaman)->get();
							if (!empty($jcekhtg)){
								foreach ($jcekhtg as $rcekhtg) {
									$htgbulan = $rcekhtg->bulan;
									$htgtahun = $rcekhtg->tahun;
									if ($cicilanke == 0){
										$sudahbyr++;
									}else { $belumbyr++; }
									if ($htgbulan == $bulan AND $htgtahun == $tahun){
										$cicilanke 		= $rcekhtg->cicilanke;
										$jenpinjaman 	= $rcekhtg->kodepinjaman;
									}
									$totalhtg++;
								}
							}
							if ($jenpinjaman != '' AND $bankcari == 'KPRI'){
								$arrayttl 		= explode("-", $jenpinjaman);
								$kodecari		= $arrayttl[0];
								$cekkode 		= KodeKPRI::where('kode', $kodecari)->first();
								if (isset($cekkode->kepanjangan)){
									$jenpinjaman= $cekkode->kepanjangan;
								}
							}
							$arrpotongan[] = array(
								'nomer' 		=> $nomer,
								'idne' 			=> $idne,
								'idpeg' 		=> $idpeg,
								'bulan' 		=> $bulan,
								'tahun' 		=> $tahun,
								'nip' 			=> $nip,
								'nama' 			=> $nama,
								'namapdbank' 	=> $namapdbank,
								'bank' 			=> $valbank,
								'kdgol' 		=> $kdgol,
								'norek' 		=> $norek,
								'statpeg' 		=> $statpeg,
								'sudahbyr' 		=> $sudahbyr,
								'belumbyr' 		=> $belumbyr,
								'totalhtg' 		=> $totalhtg,
								'cicilanke' 	=> $cicilanke,
								'nominal' 		=> $nominal,
								'jenpinjaman' 	=> $jenpinjaman,
							);
							$nomer++;
						}
					}
					$jcekhutang  		= RekapPinjaman::where('idpeg', $idpeg)->where('nmbank', $bankcari)->where('sebanyak', '!=', '0')->where('marking', '1')->get();
					if (!empty($jcekhutang)){
						foreach ($jcekhutang as $rcekhutang) {
							$nominal		= $rcekhutang->nominal;
							$norek			= $rcekhutang->norek;
							$kodepinjaman	= $rcekhutang->kodepinjaman;
							$sudahbyr		= 0;
							$belumbyr		= 0;
							$totalhtg		= 0;
							$cicilanke		= 0;
							
							$arrpotongan[] = array(
								'nomer' 		=> $nomer,
								'idne' 			=> $idne,
								'idpeg' 		=> $idpeg,
								'bulan' 		=> $bulan,
								'tahun' 		=> $tahun,
								'nip' 			=> $nip,
								'nama' 			=> $nama,
								'namapdbank' 	=> $namapdbank,
								'bank' 			=> $bankcari,
								'kdgol' 		=> $kdgol,
								'norek' 		=> $norek,
								'statpeg' 		=> $statpeg,
								'sudahbyr' 		=> $sudahbyr,
								'belumbyr' 		=> $belumbyr,
								'totalhtg' 		=> $totalhtg,
								'cicilanke' 	=> $cicilanke,
								'nominal' 		=> $nominal,
							);
							$nomer++;
						}
					}			
				}
			}
		} else if ($jenis1 == 'BPJS'){
			if ($jenis == 'BPJS Ketenagakerjaan'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bpjsket', '!=', '0')->get();
			} else if ($jenis == 'BPJS BPU'){
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bpjsbpu', '!=', '0')->get();
			} else {
				$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bpjskes', '!=', '0')->get();
			}
			$nomer = 1;
			if (!empty($count)){
				foreach ($count as $rbulanan) {
					$idpeg			= $rbulanan->idpeg;
					$nomgaji		= $rbulanan->gajisesuaisk;
					$kdgol			= $rbulanan->golongan;
					$tjberas		= $rbulanan->tjberas;
					$tjistri		= $rbulanan->tjistri;
					$tjanak			= $rbulanan->tjanak;
					$tjupns			= $rbulanan->tjupns;
					$tjstruk		= $rbulanan->tjstruk;
					$tjfungs		= $rbulanan->tjfungs;
					$tjdaerah		= $rbulanan->tjdaerah;
					$tjpencil		= $rbulanan->tjpencil;
					$tjlain			= $rbulanan->tjlain;
					$tjkompen		= $rbulanan->tjkompen;
					$tjpph			= $rbulanan->tjpph;
					$pembul			= $rbulanan->pembul;

					$tabukp			= $rbulanan->tabukp;
					$potpfkbul		= $rbulanan->potpfkbul;
					$potpfk2		= $rbulanan->potpfk2;
					$potpfk10		= $rbulanan->potpfk10;
					$potpph			= $rbulanan->potpph;
					$potswrum		= $rbulanan->potswrum;
					$potkelbtj		= $rbulanan->potkelbtj;
					$potlain		= $rbulanan->potlain;
					$pottabrum		= $rbulanan->pottabrum;
					$kpri			= $rbulanan->kpri;
					$arisan			= $rbulanan->arisan;
					$sumbangan		= $rbulanan->sumbangan;
					$bpjsbpu		= $rbulanan->bpjsbpu;
					$bpjskes		= $rbulanan->bpjskes;
					$bpjsket		= $rbulanan->bpjsket;
					$korpri			= $rbulanan->korpri;
					$dewe			= $rbulanan->dewe;

					$bankkpri		= $rbulanan->bankkpri;
					$bankukp		= $rbulanan->bankukp;
					$bni			= $rbulanan->bni;
					$mandiri		= $rbulanan->mandiri;
					$brisuhat		= $rbulanan->brisuhat;
					$briub			= $rbulanan->briub;
					$jatim			= $rbulanan->jatim;
					$btpn			= $rbulanan->btpn;
					$btn			= $rbulanan->btn;
					
					$uangmakan		= $rbulanan->uangmakan;
					$insentif		= $rbulanan->insentif;
					$potuangmakan	= $rbulanan->potuangmakan;
					$potinsentif	= $rbulanan->potinsentif;
					$terimainsentif	= $insentif - $potinsentif;
					$terimauangmakan= $uangmakan - $potuangmakan;
					
					$tottunjangan	= $tjberas + $tjistri + $tjanak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
					$gajikotor		= $nomgaji + $tottunjangan;
					
					$totpotrutin	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum + $tabukp;
					$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
					$totpotbpjs		= $bpjsbpu + $bpjskes + $bpjsket;
					$totpinjaman	= $pinjbank + $bankkpri + $bankukp;
					
					$gajidlmdft		= $gajikotor - $totpotbpjs;
					$totpotongan	= $totpotrutin + $totpinjaman;
					$totbayar		= $gajidlmdft - $totpinjaman - $totpotongan;
					if ($totbayar < 0) { $hutang = $totbayar; $totbayar = 0; }
					else { $hutang = ''; }
					
					if ($jenis == 'BPJS Ketenagakerjaan'){
						if ($gajikotor <= $umr){
							$upahjkn 	= (int)$umr;
						} else {
							$upahjkn 	= (int)$gajikotor;
						}
						$iuranjknket	= round((($upahjkn * 6.24)/100),0);
						
						$totaljknket 	= $bpjsket + $iuranjknket;
						$ceknomor 		= Nomor::where('idpeg', $idpeg)->where('deskripsi', 'BPJSTEN')->first();
						if (isset($ceknomor->nomor)){
							$noangbpsjket	= $ceknomor->nomor;
						} else { $noangbpsjket = ''; }
						
						$noangbpsjkes	= '';
						$noangbpsjrsub	= '';
					}
					else if ($jenis == 'BPJS BPU'){
						$iuranjknket 	= '';
						$totaljknket 	= '';
						$ceknomor 		= Nomor::where('idpeg', $idpeg)->where('deskripsi', 'BPJSBU')->first();
						if (isset($ceknomor->nomor)){
							$noangbpsjrsub	= $ceknomor->nomor;
						} else { $noangbpsjrsub = ''; }
						
						$noangbpsjket	= '';
						$noangbpsjkes	= '';
						$upahjkn		= '';
					}
					else {
						$iuranjknket 	= '';
						$totaljknket 	= '';
						$ceknomor 		= Nomor::where('idpeg', $idpeg)->where('deskripsi', 'BPJSKES')->first();
						if (isset($ceknomor->nomor)){
							$noangbpsjkes	= $ceknomor->nomor;
						} else { $noangbpsjkes = ''; }
						
						$noangbpsjket	= '';
						$noangbpsjrsub	= '';
						$upahjkn		= '';
					}
					
					$iuranbpsjrsub	= $bpjsbpu;
					
			
					$arrpotongan[] = array(
						'nomer' 		=> $nomer,
						'idne' 			=> $rbulanan->id,
						'idpeg' 		=> $rbulanan->idpeg,
						'bulan' 		=> $rbulanan->bulan,
						'tahun' 		=> $rbulanan->tahun,
						'nip' 			=> $rbulanan->nip,
						'nama' 			=> $rbulanan->nama,
						'bank' 			=> $rbulanan->namabank,
						'namapdbank' 	=> $rbulanan->namapdrekening,
						'kdgol' 		=> $rbulanan->golongan,
						'norek' 		=> $rbulanan->norek,
						'jenispeg' 		=> $rbulanan->jenispeg,
						'statpeg' 		=> $rbulanan->statuspegawai,
						'kdkawin' 		=> $rbulanan->kategorigaji,
						'keterangan' 	=> $rbulanan->keterangan,
						'fungsional' 	=> $rbulanan->fungsional,
						'gajikotor' 	=> $gajikotor,
						'noangbpsjkes' 	=> $noangbpsjkes,
						'bpjskes' 		=> $bpjskes,
						'bpjsbu' 		=> $bpjsbpu,
						'iuranbpsjrsub' => $iuranbpsjrsub,
						'noangbpsjrsub' => $noangbpsjrsub,
						'upahjkn' 		=> $upahjkn,
						'bayarjknket' 	=> $bpjsket,
						'iuranjknket' 	=> $iuranjknket,
						'totaljknket' 	=> $totaljknket,
						'noangbpsjket' 	=> $noangbpsjket,
					);
					$nomer++;
				}
			}
		} else if ($jenis1 == 'Template'){
			$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('bpjsket', '!=', '0')->get();
			if (!empty($count)){
				foreach ($count as $rbulanan) {
					$idpeg			= $rbulanan->idpeg;
					$nomgaji		= $rbulanan->gajisesuaisk;
					$kdgol			= $rbulanan->golongan;
					$tjberas		= $rbulanan->tjberas;
					$tjistri		= $rbulanan->tjistri;
					$tjanak			= $rbulanan->tjanak;
					$tjupns			= $rbulanan->tjupns;
					$tjstruk		= $rbulanan->tjstruk;
					$tjfungs		= $rbulanan->tjfungs;
					$tjdaerah		= $rbulanan->tjdaerah;
					$tjpencil		= $rbulanan->tjpencil;
					$tjlain			= $rbulanan->tjlain;
					$tjkompen		= $rbulanan->tjkompen;
					$tjpph			= $rbulanan->tjpph;
					$pembul			= $rbulanan->pembul;

					$tabukp			= $rbulanan->tabukp;
					$potpfkbul		= $rbulanan->potpfkbul;
					$potpfk2		= $rbulanan->potpfk2;
					$potpfk10		= $rbulanan->potpfk10;
					$potpph			= $rbulanan->potpph;
					$potswrum		= $rbulanan->potswrum;
					$potkelbtj		= $rbulanan->potkelbtj;
					$potlain		= $rbulanan->potlain;
					$pottabrum		= $rbulanan->pottabrum;
					$kpri			= $rbulanan->kpri;
					$arisan			= $rbulanan->arisan;
					$sumbangan		= $rbulanan->sumbangan;
					$bpjsbpu		= $rbulanan->bpjsbpu;
					$bpjskes		= $rbulanan->bpjskes;
					$bpjsket		= $rbulanan->bpjsket;
					$korpri			= $rbulanan->korpri;
					$dewe			= $rbulanan->dewe;

					$bankkpri		= $rbulanan->bankkpri;
					$bankukp		= $rbulanan->bankukp;
					$bni			= $rbulanan->bni;
					$mandiri		= $rbulanan->mandiri;
					$brisuhat		= $rbulanan->brisuhat;
					$briub			= $rbulanan->briub;
					$jatim			= $rbulanan->jatim;
					$btpn			= $rbulanan->btpn;
					$btn			= $rbulanan->btn;
					
					$uangmakan		= $rbulanan->uangmakan;
					$insentif		= $rbulanan->insentif;
					$potuangmakan	= $rbulanan->potuangmakan;
					$potinsentif	= $rbulanan->potinsentif;
					$terimainsentif	= $insentif - $potinsentif;
					$terimauangmakan= $uangmakan - $potuangmakan;
					
					$tottunjangan	= $tjberas + $tjistri + $tjanak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
					
					$totpotrutin	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum + $tabukp + $bpjsbpu + $bpjsket;
					$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
					$totpotbpjs		= $bpjskes;
					$totpinjaman	= $pinjbank + $bankkpri + $bankukp;
					$gajikotor		= $nomgaji + $tottunjangan;
					$gajidlmdft		= $gajikotor - $totpotbpjs;
					$totpotongan	= $totpotrutin + $totpinjaman;
					$totbayar		= $gajidlmdft - $totpinjaman - $totpotongan;
					$getdatapeg 	= PegawaiKeuangan::where('idpeg', $idpeg)->first();
					if (isset($getdatapeg->nik)){
						$nik 		= $getdatapeg->nik;
						$tgllahir	= $getdatapeg->tgllahir;
					} else {
						$nik 		= 'Unkown';
						$tgllahir	= date("Y-m-d");
					}
					$blntls			= sprintf("% 02s", $bulan);
					$blth			= '01-'.$blntls.'-'.$tahun;
					$getdataupah 	= Upah::where('nik', $nik)->first();
					if (isset($getdataupah->kodetk)){
						$kpj 		= $getdataupah->kpj;
						$kodetk		= $getdataupah->kodetk;
						$npp		= $getdataupah->npp;
					} else {
						$kpj 		= 'Unkown';
						$kodetk		= '';
						$npp		= '';
					}
					$arrayttl 	= explode("-", $tgllahir);
					$yy 		= $arrayttl[0];
					if (isset($arrayttl[1])){
						$mm = $arrayttl[1];
					}
					if (isset($arrayttl[2])){
						$dd = $arrayttl[2];
					}
					$tgllahir	= $dd.'-'.$mm.'-'.$yy;
					
					$arrpotongan[] = array(
						'nomer' 		=> $nomer,
						'nik' 			=> $nik,
						'nip' 			=> $rbulanan->nip,
						'kpj' 			=> $kpj,
						'kodetk' 		=> $kodetk,			
						'nama' 			=> $rbulanan->nama,
						'tgllahir' 		=> $tgllahir,
						'gajikotor' 	=> $gajikotor,
						'rapel' 		=> '0',
						'blth' 			=> $blth,
						'npp' 			=> $npp,
					);
					$nomer++;
				}
			}
		} else if ($jenis1 == 'Rekapitulasi'){
			$gajibersihpns		= 0;
			$gajibersihpnpn		= 0;
			$gajibersihkontrak	= 0;
			$bankkpripns		= 0;
			$bankkpripnpn		= 0;
			$bankkprikontrak	= 0;
			$bankukppns			= 0;
			$bankukppnpn		= 0;
			$bankukpkontrak		= 0;
			$tabukppns			= 0;
			$tabukppnpn			= 0;
			$tabukpkontrak		= 0;
			$btnpns				= 0;
			$btnpnpn			= 0;
			$btnkontrak			= 0;
			$kpripns			= 0;
			$kpripnpn			= 0;
			$kprikontrk			= 0;
			$arisanpns			= 0;
			$arisanpnpn			= 0;
			$arisankontrak		= 0;
			$sumbanganpns		= 0;
			$sumbanganpnpn		= 0;
			$sumbangankontrak	= 0;
			$bpjsbpupns			= 0;
			$bpjsbpupnpn		= 0;
			$bpjsbpukontrak		= 0;
			$bpjskespns			= 0;
			$bpjskespnpn		= 0;
			$bpjskeskontrak		= 0;
			$bpjsketpns			= 0;
			$bpjsketpnpn		= 0;
			$bpjsketkontrak		= 0;
			$korpripns			= 0;
			$korpripnpn			= 0;
			$korprikontrak		= 0;
			$dewepns			= 0;
			$dewepnpn			= 0;
			$dewekontrak		= 0;
			$bnipns				= 0;
			$bnipnpn			= 0;
			$bnikontrak			= 0;
			$mandiripns			= 0;
			$mandiripnpn		= 0;
			$mandirikontrak		= 0;
			$brisuhatpns		= 0;
			$brisuhatpnpn		= 0;
			$brisuhatkontrak	= 0;
			$briubpns			= 0;
			$briubpnpn			= 0;
			$briubkontrak		= 0;
			$jatimpns			= 0;
			$jatimpnpn			= 0;
			$jatimkontrak		= 0;
			$btpnpns			= 0;
			$btpnpnpn			= 0;
			$btpnkontrak		= 0;
			$count 				= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->get();
			if (!empty($count)){
				foreach ($count as $rbulanan) {
					$idpeg			= $rbulanan->idpeg;
					$jenispeg		= $rbulanan->jenispeg;
					$nomgaji		= $rbulanan->gajisesuaisk;
					$kdgol			= $rbulanan->golongan;
					$tjberas		= $rbulanan->tjberas;
					$tjistri		= $rbulanan->tjistri;
					$tjanak			= $rbulanan->tjanak;
					$tjupns			= $rbulanan->tjupns;
					$tjstruk		= $rbulanan->tjstruk;
					$tjfungs		= $rbulanan->tjfungs;
					$tjdaerah		= $rbulanan->tjdaerah;
					$tjpencil		= $rbulanan->tjpencil;
					$tjlain			= $rbulanan->tjlain;
					$tjkompen		= $rbulanan->tjkompen;
					$tjpph			= $rbulanan->tjpph;
					$pembul			= $rbulanan->pembul;
					$tabukp			= $rbulanan->tabukp;
					$potpfkbul		= $rbulanan->potpfkbul;
					$potpfk2		= $rbulanan->potpfk2;
					$potpfk10		= $rbulanan->potpfk10;
					$potpph			= $rbulanan->potpph;
					$potswrum		= $rbulanan->potswrum;
					$potkelbtj		= $rbulanan->potkelbtj;
					$potlain		= $rbulanan->potlain;
					$pottabrum		= $rbulanan->pottabrum;
					$kpri			= $rbulanan->kpri;
					$arisan			= $rbulanan->arisan;
					$sumbangan		= $rbulanan->sumbangan;
					$bpjsbpu		= $rbulanan->bpjsbpu;
					$bpjskes		= $rbulanan->bpjskes;
					$bpjsket		= $rbulanan->bpjsket;
					$korpri			= $rbulanan->korpri;
					$dewe			= $rbulanan->dewe;
					$bankkpri		= $rbulanan->bankkpri;
					$bankukp		= $rbulanan->bankukp;
					$bni			= $rbulanan->bni;
					$mandiri		= $rbulanan->mandiri;
					$brisuhat		= $rbulanan->brisuhat;
					$briub			= $rbulanan->briub;
					$jatim			= $rbulanan->jatim;
					$btpn			= $rbulanan->btpn;
					$btn			= $rbulanan->btn;
					$tottunjangan	= $tjberas + $tjistri + $tjanak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
					$totpotrutin	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum + $tabukp + $bpjsbpu + $bpjsket;
					$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
					$totpotbpjs		= $bpjskes;
					$totpinjaman	= $pinjbank + $bankkpri + $bankukp;
					$gajikotor		= $nomgaji + $tottunjangan;
					$gajidlmdft		= $gajikotor - $totpotbpjs;
					$totpotongan	= $totpotrutin + $totpinjaman;
					$totbayar		= $gajidlmdft - $totpinjaman - $totpotongan;
					if ($jenispeg == 'PNS'){
						$gajibersihpns		= $gajibersihpns + $gajidlmdft;
						$bankkpripns		= $bankkpripns + $bankkpri;
						$bankukppns			= $bankukppns + $bankukp;
						$tabukppns			= $tabukppns + $tabukp;
						$btnpns				= $btnpns + $btn;
						$kpripns			= $kpripns + $kpri;
						$arisanpns			= $arisanpns + $arisan;
						$sumbanganpns		= $sumbanganpns + $sumbangan;
						$bpjsbpupns			= $bpjsbpupns + $bpjsbpu;
						$bpjskespns			= $bpjskespns + $bpjskes;
						$bpjsketpns			= $bpjsketpns + $bpjsket;
						$korpripns			= $korpripns + $korpri;
						$dewepns			= $dewepns + $dewe;
						$bnipns				= $bnipns + $bni;
						$mandiripns			= $mandiripns + $mandiri;
						$brisuhatpns		= $brisuhatpns + $brisuhat;
						$briubpns			= $briubpns + $briub;
						$jatimpns			= $jatimpns + $jatim;
						$btpnpns			= $btpnpns + $btpn;
					} else if ($jenispeg == 'PNPN_BOPTN' OR $jenispeg == 'PNPN_PNBP'){
						$gajibersihpnpn		= $gajibersihpnpn + $gajidlmdft;
						$bankkpripnpn		= $bankkpripnpn + $bankkpri;
						$bankukppnpn		= $bankukppnpn + $bankukp;
						$tabukppnpn			= $tabukppnpn + $tabukp;
						$btnpnpn			= $btnpnpn + $btn;
						$kpripnpn			= $kpripnpn + $kpri;
						$arisanpnpn			= $arisanpnpn + $arisan;
						$sumbanganpnpn		= $sumbanganpnpn + $sumbangan;
						$bpjsbpupnpn		= $bpjsbpupnpn + $bpjsbpu;
						$bpjskespnpn		= $bpjskespnpn + $bpjskes;
						$bpjsketpnpn		= $bpjsketpnpn + $bpjsket;
						$korpripnpn			= $korpripnpn + $korpri;
						$dewepnpn			= $dewepnpn + $dewe;
						$bnipnpn			= $bnipnpn + $bni;
						$mandiripnpn		= $mandiripnpn + $mandiri;
						$brisuhatpnpn		= $brisuhatpnpn + $brisuhat;
						$briubpnpn			= $briubpnpn + $briub;
						$jatimpnpn			= $jatimpnpn + $jatim;
						$btpnpnpn			= $btpnpnpn + $btpn;
					} else {
						$gajibersihkontrak	= $gajibersihkontrak + $gajidlmdft;
						$bankkprikontrak	= $bankkprikontrak + $bankkpri;
						$bankukpkontrak		= $bankukpkontrak + $bankukp;
						$tabukpkontrak		= $tabukpkontrak + $tabukp;
						$btnkontrak			= $btnkontrak + $btn;
						$kprikontrk			= $kprikontrk + $kpri;
						$arisankontrak		= $arisankontrak + $arisan;
						$sumbangankontrak	= $sumbangankontrak + $sumbangan;
						$bpjsbpukontrak		= $bpjsbpukontrak + $bpjsbpu;
						$bpjskeskontrak		= $bpjskeskontrak + $bpjskes;
						$bpjsketkontrak		= $bpjsketkontrak + $bpjsket;
						$korprikontrak		= $korprikontrak + $korpri;
						$dewekontrak		= $dewekontrak + $dewe;
						$bnikontrak			= $bnikontrak + $bni;
						$mandirikontrak		= $mandirikontrak + $mandiri;
						$brisuhatkontrak	= $brisuhatkontrak + $brisuhat;
						$briubkontrak		= $briubkontrak + $briub;
						$jatimkontrak		= $jatimkontrak + $jatim;
						$btpnkontrak		= $btpnkontrak + $btpn;
					}
				}
			}
			$gajibersihall	= $gajibersihkontrak + $gajibersihpnpn + $gajibersihpns;
			$bankkpriall	= $bankkprikontrak + $bankkpripnpn + $bankkpripns;
			$bankukpall		= $bankukpkontrak + $bankukppnpn + $bankukppns;
			$tabukpall		= $tabukpkontrak + $tabukppnpn + $tabukppns;
			$btnall			= $btnkontrak + $btnpnpn + $btnpns;
			$kpriall		= $kprikontrk + $kpripnpn + $kpripns;
			$arisanall		= $arisankontrak + $arisanpnpn + $arisanpns;
			$sumbanganall	= $sumbangankontrak + $sumbanganpnpn + $sumbanganpns;
			$bpjsbpuall		= $bpjsbpukontrak + $bpjsbpupnpn + $bpjsbpupns;
			$bpjsketall		= $bpjsketkontrak + $bpjsketpnpn + $bpjsketpns;
			$bpjskesall		= $bpjskeskontrak + $bpjskespnpn + $bpjskespns;
			$korpriall		= $korprikontrak + $korpripnpn + $korpripns;
			$deweall		= $dewekontrak + $dewepnpn + $dewepns;
			$bniall			= $bnikontrak + $bnipnpn + $bnipns;
			$mandiriall		= $mandirikontrak + $mandiripnpn + $mandiripns;
			$brisuhatall	= $brisuhatkontrak + $brisuhatpnpn + $brisuhatpns;
			$briuball		= $briubkontrak + $briubpnpn + $briubpns;
			$jatimall		= $jatimkontrak + $jatimpnpn + $jatimpns;
			$btpnall		= $btpnkontrak + $btpnpnpn + $btpnpns;
			$potongankontrak= $bpjskeskontrak + $bankkprikontrak + $bankukpkontrak + $tabukpkontrak + $btnkontrak + $kprikontrk + $arisankontrak + $sumbangankontrak + $bpjsbpukontrak + $bpjsketkontrak + $korprikontrak + $dewekontrak + $bnikontrak + $mandirikontrak + $brisuhatkontrak + $briubkontrak + $jatimkontrak + $btpnkontrak;
			$potonganpnpn	= $bpjskespnpn + $bankkpripnpn + $bankukppnpn + $tabukppnpn + $btnpnpn + $kpripnpn + $arisanpnpn + $sumbanganpnpn + $bpjsbpupnpn + $bpjsketpnpn + $korpripnpn + $dewepnpn + $bnipnpn + $mandiripnpn + $brisuhatpnpn + $briubpnpn + $jatimpnpn + $btpnpnpn;
			$potonganpns	= $bpjskespns + $bankkpripns + $bankukppns + $tabukppns + $btnpns + $kpripns + $arisanpns + $sumbanganpns + $bpjsbpupns + $bpjsketpns + $korpripns + $dewepns + $bnipns + $mandiripns + $brisuhatpns + $briubpns + $jatimpns + $btpnpns;
			$terimapns		= $gajibersihpns - $potonganpns;
			$terimapnpn		= $gajibersihpnpn - $potonganpnpn;
			$terimakontrak	= $gajibersihkontrak - $potongankontrak;
			
			$arrpotongan[] = array(
				'nomer' 		=> '1',
				'uraian'		=> 'Gaji Bersih Dalam Daftar',
				'pns' 			=> $gajibersihpns,
				'pnpn' 			=> $gajibersihpnpn,
				'kontrak' 		=> $gajibersihkontrak,
				'jumlah' 		=> $gajibersihall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '2',
				'uraian'		=> 'KPRI',
				'pns' 			=> $bankkpripns,
				'pnpn' 			=> $bankkpripnpn,
				'kontrak' 		=> $bankkprikontrak,
				'jumlah' 		=> $bankkpriall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '3',
				'uraian'		=> 'UKP',
				'pns' 			=> $bankukppns,
				'pnpn' 			=> $bankukppnpn,
				'kontrak' 		=> $bankukpkontrak,
				'jumlah' 		=> $bankukpall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '4',
				'uraian'		=> 'BANK BTN',
				'pns' 			=> $btnpns,
				'pnpn' 			=> $btnpnpn,
				'kontrak' 		=> $btnkontrak,
				'jumlah' 		=> $btnall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '5',
				'uraian'		=> 'BANK JATIM',
				'pns' 			=> $jatimpns,
				'pnpn' 			=> $jatimpnpn,
				'kontrak' 		=> $jatimkontrak,
				'jumlah' 		=> $jatimall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '6',
				'uraian'		=> 'BANK BRI SOEHAT',
				'pns' 			=> $brisuhatpns,
				'pnpn' 			=> $brisuhatpnpn,
				'kontrak' 		=> $brisuhatkontrak,
				'jumlah' 		=> $brisuhatall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '7',
				'uraian'		=> 'BANK BRI UB',
				'pns' 			=> $briubpns,
				'pnpn' 			=> $briubpnpn,
				'kontrak' 		=> $briubkontrak,
				'jumlah' 		=> $briuball
			);
			$arrpotongan[] = array(
				'nomer' 		=> '8',
				'uraian'		=> 'BANK BTPN',
				'pns' 			=> $btpnpns,
				'pnpn' 			=> $btpnpnpn,
				'kontrak' 		=> $btpnkontrak,
				'jumlah' 		=> $btpnall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '9',
				'uraian'		=> 'BANK MANDIRI UB',
				'pns' 			=> $mandiripns,
				'pnpn' 			=> $mandiripnpn,
				'kontrak' 		=> $mandirikontrak,
				'jumlah' 		=> $mandiriall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '10',
				'uraian'		=> 'Potongan Simpanan Wajib KPRI',
				'pns' 			=> $kpripns,
				'pnpn' 			=> $kpripnpn,
				'kontrak' 		=> $kprikontrk,
				'jumlah' 		=> $kpriall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '11',
				'uraian'		=> 'Potongan UKP',
				'pns' 			=> $tabukppns,
				'pnpn' 			=> $tabukppnpn,
				'kontrak' 		=> $tabukpkontrak,
				'jumlah' 		=> $tabukpall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '12',
				'uraian'		=> 'Potongan KORPRI',
				'pns' 			=> $korpripns,
				'pnpn' 			=> $korpripnpn,
				'kontrak' 		=> $korprikontrak,
				'jumlah' 		=> $korpriall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '13',
				'uraian'		=> 'Potongan Arisan',
				'pns' 			=> $arisanpns,
				'pnpn' 			=> $arisanpnpn,
				'kontrak' 		=> $arisankontrak,
				'jumlah' 		=> $arisanall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '14',
				'uraian'		=> 'Potongan Ikatan Dharma Wanita',
				'pns' 			=> $dewepns,
				'pnpn' 			=> $dewepnpn,
				'kontrak' 		=> $dewekontrak,
				'jumlah' 		=> $deweall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '15',
				'uraian'		=> 'Sumbangan',
				'pns' 			=> $sumbanganpns,
				'pnpn' 			=> $sumbanganpnpn,
				'kontrak' 		=> $sumbangankontrak,
				'jumlah' 		=> $sumbanganall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '16',
				'uraian'		=> 'Potogan BPJS Kesehatan',
				'pns' 			=> $bpjskespns,
				'pnpn' 			=> $bpjskespnpn,
				'kontrak' 		=> $bpjskeskontrak,
				'jumlah' 		=> $bpjskesall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '17',
				'uraian'		=> 'Potogan BPJS PSU',
				'pns' 			=> $bpjsbpupns,
				'pnpn' 			=> $bpjsbpupnpn,
				'kontrak' 		=> $bpjsbpukontrak,
				'jumlah' 		=> $bpjsbpuall
			);
			$arrpotongan[] = array(
				'nomer' 		=> '18',
				'uraian'		=> 'Potogan BPJS Ketenagakerjaan',
				'pns' 			=> $bpjsketpns,
				'pnpn' 			=> $bpjsketpnpn,
				'kontrak' 		=> $bpjsketkontrak,
				'jumlah' 		=> $bpjsketall
			);
			$arrpotongan[] = array(
				'nomer' 		=> ' ',
				'uraian'		=> '<strong>JUMLAH POTONGAN</strong>',
				'pns' 			=> $potonganpns,
				'pnpn' 			=> $potonganpnpn,
				'kontrak' 		=> $potongankontrak,
				'jumlah' 		=> ''
			);
			$arrpotongan[] = array(
				'nomer' 		=> ' ',
				'uraian'		=> '<strong>GAJI YANG DITERIMA BERSIH</strong>',
				'pns' 			=> $terimapns,
				'pnpn' 			=> $terimapnpn,
				'kontrak' 		=> $terimakontrak,
				'jumlah' 		=> ''
			);
		} else if ($jenis1 == 'Potongan'){
			if ($jenis3 == 'ARISAN'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('arisan', '!=', '0')->get();
			} else if($jenis3 == 'IDW'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('dewe', '!=', '0')->get();
			} else if($jenis3 == 'KORPRI'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('korpri', '!=', '0')->get();
			} else if($jenis3 == 'KPRI'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('kpri', '!=', '0')->get();
			} else if($jenis3 == 'SUMBANGAN'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('sumbangan', '!=', '0')->get();
			} else if($jenis3 == 'UKP'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('tabukp', '!=', '0')->get();
			} else {
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->get();
			} 
			if (!empty($count)){
				foreach ($count as $rbulanan) {
					$idpeg			= $rbulanan->idpeg;
					$jenispeg		= $rbulanan->jenispeg;
					$norek			= $rbulanan->norek;
					$nomgaji		= $rbulanan->gajisesuaisk;
					$tjberas		= $rbulanan->tjberas;
					$tjistri		= $rbulanan->tjistri;
					$tjanak			= $rbulanan->tjanak;
					$tjupns			= $rbulanan->tjupns;
					$tjstruk		= $rbulanan->tjstruk;
					$tjfungs		= $rbulanan->tjfungs;
					$tjdaerah		= $rbulanan->tjdaerah;
					$tjpencil		= $rbulanan->tjpencil;
					$tjlain			= $rbulanan->tjlain;
					$tjkompen		= $rbulanan->tjkompen;
					$tjpph			= $rbulanan->tjpph;
					$pembul			= $rbulanan->pembul;
					$tabukp			= $rbulanan->tabukp;
					$potpfkbul		= $rbulanan->potpfkbul;
					$potpfk2		= $rbulanan->potpfk2;
					$potpfk10		= $rbulanan->potpfk10;
					$potpph			= $rbulanan->potpph;
					$potswrum		= $rbulanan->potswrum;
					$potkelbtj		= $rbulanan->potkelbtj;
					$potlain		= $rbulanan->potlain;
					$pottabrum		= $rbulanan->pottabrum;
					$kpri			= $rbulanan->kpri;
					$arisan			= $rbulanan->arisan;
					$sumbangan		= $rbulanan->sumbangan;
					$bpjsbpu		= $rbulanan->bpjsbpu;
					$bpjskes		= $rbulanan->bpjskes;
					$bpjsket		= $rbulanan->bpjsket;
					$korpri			= $rbulanan->korpri;
					$dewe			= $rbulanan->dewe;
					$bankkpri		= $rbulanan->bankkpri;
					$bankukp		= $rbulanan->bankukp;
					$bni			= $rbulanan->bni;
					$mandiri		= $rbulanan->mandiri;
					$brisuhat		= $rbulanan->brisuhat;
					$briub			= $rbulanan->briub;
					$jatim			= $rbulanan->jatim;
					$btpn			= $rbulanan->btpn;
					$btn			= $rbulanan->btn;
					$uangmakan		= $rbulanan->uangmakan;
					$insentif		= $rbulanan->insentif;
					$potuangmakan	= $rbulanan->potuangmakan;
					$potinsentif	= $rbulanan->potinsentif;
					$terimainsentif	= $insentif - $potinsentif;
					$terimauangmakan= $uangmakan - $potuangmakan;
					$tottunjangan	= $tjberas + $tjistri + $tjanak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
					$totpotwjb		= $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum;
					$totpotrutin	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $tabukp + $bpjsbpu + $bpjsket;
					$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
					$pinjbank		= round($pinjbank, 0);
					$totpotbpjs		= $bpjskes;
					$totpinjaman	= $pinjbank + $bankkpri + $bankukp;
					$gajikotor		= $nomgaji + $tottunjangan;
					$gajidlmdft		= $gajikotor - $totpotbpjs;
					$gajigpp		= $gajikotor - $totpotwjb;
					$totpotongan	= $totpotrutin + $totpinjaman;
					if ($jenispeg == 'PNS'){
						$totbayar		= $gajigpp - $totpotongan;
					}else {
						$totbayar		= $gajigpp - $totpotongan - $totpotbpjs;
					}
					
					if ($totbayar < 0) { $hutang = $totbayar; $totbayar = 0; }
					else { $hutang = ''; }
					if ($jenis3 == 'UKP'){
						$tabukp 	= number_format( $tabukp , 0 , '.' , ',' );
						$ceknomor 	= Nomor::where('idpeg', $idpeg)->where('deskripsi', 'UKP')->first();
						if (isset($ceknomor->nomor)){
							$norek	= $ceknomor->nomor;
						} else { $norek = ''; }
						
					}
					if ($jenis3 == 'KPRI'){
						$ceknomor 	= Nomor::where('idpeg', $idpeg)->where('deskripsi', 'KPRI')->first();
						if (isset($ceknomor->nomor)){
							$norek	= $ceknomor->nomor;
						} else { $norek = ''; }
					}
					$arrpotongan[] = array(
						'nomer' 			=> $nomer,
						'idne' 				=> $rbulanan->id,
						'idpeg' 			=> $idpeg,
						'bulan' 			=> $rbulanan->bulan,
						'tahun' 			=> $rbulanan->tahun,
						'nip' 				=> $rbulanan->nip,
						'nama' 				=> $rbulanan->nama,
						'namapdbank' 		=> $rbulanan->namapdrekening,
						'kdgol' 			=> $rbulanan->golongan,
						'norek' 			=> $norek,
						'jenispeg' 			=> $rbulanan->jenispeg,
						'statpeg' 			=> $rbulanan->statuspegawai,
						'kdkawin' 			=> $rbulanan->kategorigaji,
						'keterangan' 		=> $rbulanan->keterangan,
						'fungsional' 		=> $rbulanan->fungsional,
						'gapok' 			=> $nomgaji,
						'sutri' 			=> $tjistri,
						'anak' 				=> $tjanak,
						'beras' 			=> $tjberas,
						'tjupns' 			=> $tjupns,
						'tjstruk' 			=> $tjstruk,
						'tjfungs' 			=> $tjfungs,
						'tjdaerah' 			=> $tjdaerah,
						'tjpencil' 			=> $tjpencil,
						'tjkompen' 			=> $tjkompen,
						'pembul' 			=> $pembul,
						'tjpph' 			=> $tjpph,
						'tjlain' 			=> $tjlain,
						'tottunjangan' 		=> $tottunjangan,
						'potwajib' 			=> $totpotwjb,
						'potrutin' 			=> $totpotrutin,
						'potbpjs' 			=> $totpotbpjs,
						'gajikotor' 		=> $gajikotor,
						'gajibersih' 		=> $totbayar,
						'bpjskes' 			=> $bpjskes,
						'bpjsbu' 			=> $bpjsbpu,
						'bpjsket' 			=> $bpjsket,
						'gajidlmdft' 		=> $gajidlmdft,
						'gajigpp' 			=> $gajigpp,
						'pinjkpri' 			=> $bankkpri,
						'pinjukp' 			=> $bankukp,
						'pinjbank' 			=> $pinjbank,
						'totpinjaman' 		=> $totpinjaman,
						'kpri' 				=> $kpri,
						'korpri' 			=> $korpri,
						'arisan' 			=> $arisan,
						'idewe' 			=> $dewe,
						'sumbangan' 		=> $sumbangan,
						'potpfkbul' 		=> $potpfkbul,
						'potpfk2' 			=> $potpfk2,
						'potpfk10' 			=> $potpfk10,
						'potpph' 			=> $potpph,
						'potswrum' 			=> $potswrum,
						'potkelbtj' 		=> $potkelbtj,
						'potlain' 			=> $potlain,
						'pottabrum' 		=> $pottabrum,
						'tabukp' 			=> $tabukp,
						'potrutin' 			=> $totpotrutin,
						'totpotongan' 		=> $totpotongan,
						'totbayar' 			=> $totbayar,
						'hutang' 			=> $hutang,
						'makan' 			=> $uangmakan,
						'insentif' 			=> $insentif,
						'potuangmakan' 		=> $potuangmakan,
						'potinsentif' 		=> $potinsentif,
						'terimainsentif'	=> $terimainsentif,
						'terimauangmakan' 	=> $terimauangmakan,
						'honor' 			=> $rbulanan->honor,
						'tambahangaji' 		=> $rbulanan->tambahangaji
					);
					$nomer++;
				}
			}
		} else {
			if ($jenis == 'Gaji Bersih PNS'){
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('jenispeg', 'PNS')->get();
			} else if ($jenis == 'Gaji PNPN'){
				$valcari = '%'.'PNPN'.'%';
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('jenispeg', 'LIKE', $valcari)->get();
			} else if ($jenis == 'Gaji Pegawai Kontrak'){
				$valcari = '%'.'Kontrak'.'%';
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->where('jenispeg', 'LIKE', $valcari)->get();
			}
			else {
				$count 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->get();
			}
			if (!empty($count)){
				foreach ($count as $rbulanan) {
					$jenispeg		= $rbulanan->jenispeg;
					$nomgaji		= $rbulanan->gajisesuaisk;
					$tjberas		= $rbulanan->tjberas;
					$tjistri		= $rbulanan->tjistri;
					$tjanak			= $rbulanan->tjanak;
					$tjupns			= $rbulanan->tjupns;
					$tjstruk		= $rbulanan->tjstruk;
					$tjfungs		= $rbulanan->tjfungs;
					$tjdaerah		= $rbulanan->tjdaerah;
					$tjpencil		= $rbulanan->tjpencil;
					$tjlain			= $rbulanan->tjlain;
					$tjkompen		= $rbulanan->tjkompen;
					$tjpph			= $rbulanan->tjpph;
					$pembul			= $rbulanan->pembul;
					$tabukp			= $rbulanan->tabukp;
					$potpfkbul		= $rbulanan->potpfkbul;
					$potpfk2		= $rbulanan->potpfk2;
					$potpfk10		= $rbulanan->potpfk10;
					$potpph			= $rbulanan->potpph;
					$potswrum		= $rbulanan->potswrum;
					$potkelbtj		= $rbulanan->potkelbtj;
					$potlain		= $rbulanan->potlain;
					$pottabrum		= $rbulanan->pottabrum;
					$kpri			= $rbulanan->kpri;
					$arisan			= $rbulanan->arisan;
					$sumbangan		= $rbulanan->sumbangan;
					$bpjsbpu		= $rbulanan->bpjsbpu;
					$bpjskes		= $rbulanan->bpjskes;
					$bpjsket		= $rbulanan->bpjsket;
					$korpri			= $rbulanan->korpri;
					$dewe			= $rbulanan->dewe;
					$bankkpri		= $rbulanan->bankkpri;
					$bankukp		= $rbulanan->bankukp;
					$bni			= $rbulanan->bni;
					$mandiri		= $rbulanan->mandiri;
					$brisuhat		= $rbulanan->brisuhat;
					$briub			= $rbulanan->briub;
					$jatim			= $rbulanan->jatim;
					$btpn			= $rbulanan->btpn;
					$btn			= $rbulanan->btn;
					$uangmakan		= $rbulanan->uangmakan;
					$insentif		= $rbulanan->insentif;
					$potuangmakan	= $rbulanan->potuangmakan;
					$potinsentif	= $rbulanan->potinsentif;
					$terimainsentif	= $insentif - $potinsentif;
					$terimauangmakan= $uangmakan - $potuangmakan;
					$tottunjangan	= $tjberas + $tjistri + $tjanak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
					$totpotwjb		= $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum;
					$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
					$pinjbank		= round($pinjbank, 0);
					$totpotbpjs		= $bpjskes;
					$totpinjaman	= $pinjbank + $bankkpri + $bankukp;
					$gajikotor		= $nomgaji + $tottunjangan;
					if ($gajikotor <= $umr){
						$iuranjknket= 180679;
						$upahjkn 	= $umr;
					} else {
						$upahjkn 	= $gajikotor;
						$iuranjknket= round((($gajikotor * 6.24)/100),0);
					}
					//if ($bpjsket != 0){
					//	$bpjsket = round((($upahjkn * 3)/100),0);
					//}
					$totpotrutin	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $tabukp + $bpjsbpu + $bpjsket;
					
					$gajidlmdft		= $gajikotor - $totpotbpjs;
					$gajigpp		= $gajikotor - $totpotwjb;
					$totpotongan	= $totpotrutin + $totpinjaman;
					if ($jenispeg == 'PNS'){
						$totbayar		= $gajigpp - $totpotongan;
					}else {
						$totbayar		= $gajigpp - $totpotongan - $totpotbpjs;
					}
					if ($totbayar < 0) { $hutang = $totbayar; $totbayar = 0; }
					else { $hutang = ''; }
					
					$arrpotongan[] = array(
						'nomer' 		=> $nomer,
						'idne' 			=> $rbulanan->id,
						'idpeg' 		=> $rbulanan->idpeg,
						'bulan' 		=> $rbulanan->bulan,
						'tahun' 		=> $rbulanan->tahun,
						'nip' 			=> $rbulanan->nip,
						'nama' 			=> $rbulanan->nama,
						'namapdbank' 	=> $rbulanan->namapdrekening,
						'kdgol' 		=> $rbulanan->golongan,
						'norek' 		=> $rbulanan->norek,
						'jenispeg' 		=> $rbulanan->jenispeg,
						'statpeg' 		=> $rbulanan->statuspegawai,
						'kdkawin' 		=> $rbulanan->kategorigaji,
						'keterangan' 	=> $rbulanan->keterangan,
						'fungsional' 	=> $rbulanan->fungsional,
						'gapok' 		=> $nomgaji,
						'sutri' 		=> $tjistri,
						'anak' 			=> $tjanak,
						'beras' 		=> $tjberas,
						'tjupns' 		=> $tjupns,
						'tjstruk' 		=> $tjstruk,
						'tjfungs' 		=> $tjfungs,
						'tjdaerah' 		=> $tjdaerah,
						'tjpencil' 		=> $tjpencil,
						'tjkompen' 		=> $tjkompen,
						'pembul' 		=> $pembul,
						'tjpph' 		=> $tjpph,
						'tjlain' 		=> $tjlain,
						'tottunjangan' 	=> $tottunjangan,
						'potwajib' 		=> $totpotwjb,
						'potrutin' 		=> $totpotrutin,
						'potbpjs' 		=> $totpotbpjs,
						'gajikotor' 	=> $gajikotor,
						'gajibersih' 	=> $totbayar,
						'bpjskes' 		=> $bpjskes,
						'bpjsbu' 		=> $bpjsbpu,
						'bpjsket' 		=> $bpjsket,
						'gajidlmdft' 	=> $gajidlmdft,
						'gajigpp' 		=> $gajigpp,
						'pinjkpri' 		=> $bankkpri,
						'pinjukp' 		=> $bankukp,
						'pinjbank' 		=> $pinjbank,
						'totpinjaman' 	=> $totpinjaman,
						'kpri' 			=> $kpri,
						'korpri' 		=> $korpri,
						'arisan' 		=> $arisan,
						'idewe' 		=> $dewe,
						'sumbangan' 	=> $sumbangan,
						'potpfkbul' 	=> $potpfkbul,
						'potpfk2' 		=> $potpfk2,
						'potpfk10' 		=> $potpfk10,
						'potpph' 		=> $potpph,
						'potswrum' 		=> $potswrum,
						'potkelbtj' 	=> $potkelbtj,
						'potlain' 		=> $potlain,
						'pottabrum' 	=> $pottabrum,
						'tabukp' 		=> $tabukp,
						'potrutin' 		=> $totpotrutin,
						'totpotongan' 	=> $totpotongan,
						'totbayar' 		=> $totbayar,
						'hutang' 		=> $hutang,
						'makan' 		=> $uangmakan,
						'insentif' 		=> $insentif,
						'potuangmakan' 	=> $potuangmakan,
						'potinsentif' 	=> $potinsentif,
						'terimainsentif'=> $terimainsentif,
						'terimauangmakan' 	=> $terimauangmakan,
						'honor' 		=> $rbulanan->honor,
						'tambahangaji' 	=> $rbulanan->tambahangaji
					);
					$nomer++;
				}
			}
		}
		echo json_encode($arrpotongan);
	}
	public function jdataAktifbku() {
		$bulanlist 	= array(1 => "01", 2 => "02", 3 => "03", 4 => "04", 5 => "05", 6 => "06", 7 => "07", 8 => "08", 9 => "09", 10 => "10", 11 => "11", 12 => "12");
		$tahun		= date("Y");
		$thnlalu	= $tahun - 1;
		$thndepan	= $tahun + 1;
		$hasil 		= array();
		$finis 		= 13;
		$mulai 		= 1;
		$mppabp = Session('fakpanjang');
		if ($mppabp == ''){ $mppabp = 'Kantor Pusat'; }
		$getlast  	= Report::where('bulan', '12')->where('tahun', $thnlalu)->where('ppabp', $mppabp)->first();
		if (isset($getlast->open)){
			$status = $getlast->open;
			if ($status == 1){
				$tlsstatus 		= '<span class="label label-success label-block">AKTIF</span>';
			}else {
				$tlsstatus 		= '<span class="label label-info label-block">HIDDEN</span>';
			}
		} else {
			$status 	= '';
			$tlsstatus 	= '<span class="label label-danger label-block">No Data</span>';
		}
		$arrgaji[] = array(	
			'bulan'		=> '12',
			'tahun'		=> $thnlalu,
			'status'	=> $status,
			'tlsstatus'	=> $tlsstatus,
		);
		while ($mulai != $finis){
			$bulan 		= $bulanlist[$mulai];
			$blncari	= (int)$bulan;
			$jcekgaji  	= Report::where('bulan', $blncari)->where('tahun', $tahun)->where('ppabp', $mppabp)->groupBy('open')->first();
			if (isset($jcekgaji->open)){
				$status = $jcekgaji->open;
				if ($status == 1){
					$tlsstatus 		= '<span class="badge bg-success">AKTIF</span>';
				}else {
					$tlsstatus 		= '<span class="badge bg-info">HIDDEN</span>';
				}
			} else {
				$status 	= '';
				$tlsstatus 	= '<span class="badge bg-danger">No Data</span>';
			}
			$arrgaji[] = array(	
				'bulan'		=>$bulan,
				'tahun'		=>$tahun,
				'status'	=>$status,
				'tlsstatus'	=>$tlsstatus,
			);
			$mulai++;
		}
		$getlast  	= Report::where('bulan', '01')->where('tahun', $thndepan)->where('ppabp', $mppabp)->first();
		if (isset($getlast->open)){
			$status = $getlast->open;
			if ($status == 1){
				$tlsstatus 		= '<span class="label label-success label-block">AKTIF</span>';
			}else {
				$tlsstatus 		= '<span class="label label-info label-block">HIDDEN</span>';
			}
		} else {
			$status 	= '';
			$tlsstatus 	= '<span class="label label-danger label-block">No Data</span>';
		}
		$arrgaji[] = array(	
			'bulan'		=> '01',
			'tahun'		=> $thndepan,
			'status'	=> $status,
			'tlsstatus'	=> $tlsstatus,
		);
		
		echo json_encode($arrgaji);
	}
	public function cetakSlipgaji(Request $request) {
		$mppabp 	= Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		$tglcetak 		= Carbon::now()->toDateTimeString();
		$dd 			= date("d");
		$mm 			= date("m");
		$yy 			= date("Y");
		$jam			= date("hh:mm");
		$mthiki 		= (int)date("m");
		$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$blniki 		= $bulanlist[$mthiki];
		$sakiki 		= $dd.' '.$blniki.' '.$yy;
		$bulan			= $request->input('val02');
		$tahun			= $request->input('val03');
		$idpeg			= $request->input('val01');

		$rbulanan  		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('idpeg', $idpeg)->first();
		$gapok			= $rbulanan->gajisesuaisk;
		$nip			= $rbulanan->nip;
		$nama			= $rbulanan->nama;
		$keterangan		= $rbulanan->keterangan;
		$fungsional		= $rbulanan->fungsional;
		$jenispeg		= $rbulanan->jenispeg;
		$bank 			= $rbulanan->namabank;
		$norek 			= $rbulanan->norek;
		$nmrek 			= $rbulanan->namapdrekening;
		$cekstat		= $rbulanan->statuspegawai;	
		$katgaji		= $rbulanan->kategorigaji;
		$kdgol			= $rbulanan->golongan;
		$beras			= $rbulanan->tjberas;
		$sutri			= $rbulanan->tjistri;
		$anak			= $rbulanan->tjanak;
		$tjupns			= $rbulanan->tjupns;
		$tjstruk		= $rbulanan->tjstruk;
		$tjfungs		= $rbulanan->tjfungs;
		$tjdaerah		= $rbulanan->tjdaerah;
		$tjpencil		= $rbulanan->tjpencil;
		$tjlain			= $rbulanan->tjlain;
		$tjkompen		= $rbulanan->tjkompen;
		$tjpph			= $rbulanan->tjpph;
		$pembul			= $rbulanan->pembul;
		
		$tabukp			= $rbulanan->tabukp;
		$potpfkbul		= $rbulanan->potpfkbul;
		$potpfk2		= $rbulanan->potpfk2;
		$potpfk10		= $rbulanan->potpfk10;
		$potpph			= $rbulanan->potpph;
		$potswrum		= $rbulanan->potswrum;
		$potkelbtj		= $rbulanan->potkelbtj;
		$potlain		= $rbulanan->potlain;
		$pottabrum		= $rbulanan->pottabrum;
		$kpri			= $rbulanan->kpri;
		$arisan			= $rbulanan->arisan;
		$sumbangan		= $rbulanan->sumbangan;
		$bpjsbu			= $rbulanan->bpjsbpu;
		$bpjskes		= $rbulanan->bpjskes;
		$bpjsket		= $rbulanan->bpjsket;
		$korpri			= $rbulanan->korpri;
		$idewe			= $rbulanan->dewe;
		
		$pinjkpri		= $rbulanan->bankkpri;
		$pinjukp		= $rbulanan->bankukp;
		$bni			= $rbulanan->bni;
		$mandiri		= $rbulanan->mandiri;
		$brisuhat		= $rbulanan->brisuhat;
		$briub			= $rbulanan->briub;
		$jatim			= $rbulanan->jatim;
		$btpn			= $rbulanan->btpn;
		$btn			= $rbulanan->btn;
		
		$uangmakan		= $rbulanan->uangmakan;
		$insentif		= $rbulanan->insentif;
		$potuangmakan	= $rbulanan->potuangmakan;
		$potinsentif	= $rbulanan->potinsentif;
		$honor			= $rbulanan->honor;
		$tambahangaji	= $rbulanan->tambahangaji;
		
		$terimainsentif	= $insentif - $potinsentif;
		$terimauangmakan= $uangmakan - $potuangmakan;

		$golongan		= '';
		$pangkat		= '';
		$cek1 			= Golongan::where('kode', $kdgol)->count();
		if ($cek1 > 0) {
			$rcekjabatan	= Golongan::where('kode', $kdgol)->first();
			$golongan		= $rcekjabatan->golongan;
			$pangkat		= $rcekjabatan->pangkat;
		}
		
		$tottunjangan	= $beras + $sutri + $anak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph + $terimainsentif + $terimauangmakan + $honor + $tambahangaji;
		
		
		$potlainnya		= $potpfkbul + $potpfk2 + $potpfk10 + $potswrum + $potkelbtj;
		$totalpotpegawai= $potlainnya + $potpph + $potlain + $bpjskes + $pottabrum;
		
		$totpotrutin	= $kpri + $korpri + $arisan + $idewe + $sumbangan + $tabukp + $bpjsbu + $bpjsket;
		$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
		$gajikotor		= $gapok + $tottunjangan;
		
		$gajitanpapinjam= $gajikotor - $totpotrutin - $totalpotpegawai;
		
		
		$gapok			= number_format( $gapok, 0 , '.' , ',' );
		$sutri			= number_format( $sutri, 0 , '.' , ',' );
		$anak			= number_format( $anak, 0 , '.' , ',' );
		$tjfungs		= number_format( $tjfungs, 0 , '.' , ',' );
		$tjstruk		= number_format( $tjstruk, 0 , '.' , ',' );
		$tjupns			= number_format( $tjupns, 0 , '.' , ',' );
		$beras			= number_format( $beras, 0 , '.' , ',' );
		$tjpph			= number_format( $tjpph, 0 , '.' , ',' );
		$pembul			= number_format( $pembul, 0 , '.' , ',' );
		$gajikotor		= number_format( $gajikotor, 0 , '.' , ',' );
		$potlain		= number_format( $potlain, 0 , '.' , ',' );
		$potlainnya		= number_format( $potlainnya, 0 , '.' , ',' );
		$potpph			= number_format( $potpph, 0 , '.' , ',' );
		$pottabrum		= number_format( $pottabrum, 0 , '.' , ',' );
		$bpjskes		= number_format( $bpjskes, 0 , '.' , ',' );
		$totalpotpegawai= number_format( $totalpotpegawai, 0 , '.' , ',' );
		$korpri			= number_format( $korpri, 0 , '.' , ',' );
		$tabukp			= number_format( $tabukp, 0 , '.' , ',' );
		$arisan			= number_format( $arisan, 0 , '.' , ',' );
		$kpri			= number_format( $kpri, 0 , '.' , ',' );
		$sumbangan		= number_format( $sumbangan, 0 , '.' , ',' );
		$idewe			= number_format( $idewe, 0 , '.' , ',' );
		$bpjsbpu		= number_format( $bpjsbu, 0 , '.' , ',' );
		$bpjsket		= number_format( $bpjsket, 0 , '.' , ',' );
		$totpotrutin	= number_format( $totpotrutin, 0 , '.' , ',' );
		$gajibersih		= number_format( $gajitanpapinjam, 0 , '.' , ',' );
		
		$terimauangmakan= number_format( $terimauangmakan, 0 , '.' , ',' );
		$terimainsentif	= number_format( $terimainsentif, 0 , '.' , ',' );
		$honor			= number_format( $honor, 0 , '.' , ',' );
		$tambahangaji	= number_format( $tambahangaji, 0 , '.' , ',' );
		
		
		if ($bulan == 1){ $tlsbln = 'JANUARI'; }
		if ($bulan == 2){ $tlsbln = 'FEBRUARI'; }
		if ($bulan == 3){ $tlsbln = 'MARET'; }
		if ($bulan == 4){ $tlsbln = 'APRIL'; }
		if ($bulan == 5){ $tlsbln = 'MEI'; }
		if ($bulan == 6){ $tlsbln = 'JUNI'; }
		if ($bulan == 7){ $tlsbln = 'JULI'; }
		if ($bulan == 8){ $tlsbln = 'AGUSTUS'; }
		if ($bulan == 9){ $tlsbln = 'SEPTEMBER'; }
		if ($bulan == 10){ $tlsbln = 'OKTOBER'; }
		if ($bulan == 11){ $tlsbln = 'NOVEMBER'; }
		if ($bulan == 12){ $tlsbln = 'DESEMBER'; }
		$valset1	= '';
		$valset2	= '';
		$sql 	= SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hinboxread){
			$idsetting = $hinboxread->jenis;
			if ($idsetting == 'Bendahara Gaji'){ $valset1 = $hinboxread->isi1; }
			if ($idsetting == 'NIP Bendahara Gaji'){ $valset2 = $hinboxread->isi1; }
		}
		$idpeg		= sprintf("% 03s", $idpeg);
		$tlsnomor 	= $idpeg.'/UN10.B20/KU/'.$tahun;
		$tulisdiqrcode	= 'An. '.$nama.' Nomor : '.$tlsnomor.' Bulan '.$tlsbln.' Tahun '.$tahun.' Nominal : '.$gajibersih;
		$qrcode 		= base64_encode(QrCode::format('png')->size(100)->generate($tulisdiqrcode));
		
		$data 						= 	[];
		$data['qrcode'] 			= 	$qrcode;
		$data['valset1'] 			= 	$valset1;
		$data['valset2'] 			= 	$valset2;
		$data['tlsnomor'] 			= 	$tlsnomor;
		$data['tlsbln'] 			= 	$tlsbln;
		$data['tahun'] 				= 	$tahun;
		$data['nama'] 				= 	$nama;
		$data['nip'] 				= 	$nip;
		$data['golongan'] 			= 	$golongan;
		$data['pangkat'] 			= 	$pangkat;
		$data['gapok'] 				= 	$gapok;
		$data['sutri'] 				= 	$sutri;
		$data['anak'] 				= 	$anak;
		$data['tjfungs'] 			= 	$tjfungs;
		$data['tjstruk'] 			= 	$tjstruk;
		$data['tjupns'] 			= 	$tjupns;
		$data['beras'] 				= 	$beras;
		$data['tjpph'] 				= 	$tjpph;
		$data['pembul'] 			= 	$pembul;
		$data['tambahangaji'] 		= 	$tambahangaji;
		$data['terimainsentif'] 	= 	$terimainsentif;
		$data['honor'] 				= 	$honor;
		$data['terimauangmakan'] 	= 	$terimauangmakan;
		$data['gajikotor'] 			= 	$gajikotor;
		$data['potlainnya'] 		= 	$potlainnya;
		$data['potpph'] 			= 	$potpph;
		$data['pottabrum'] 			= 	$pottabrum;
		$data['potlain'] 			= 	$potlain;
		$data['bpjskes'] 			= 	$bpjskes;
		$data['totalpotpegawai'] 	= 	$totalpotpegawai;
		$data['korpri'] 			= 	$korpri;
		$data['tabukp'] 			= 	$tabukp;
		$data['arisan'] 			= 	$arisan;
		$data['bpjsbpu'] 			= 	$bpjsbpu;
		$data['bpjsket'] 			= 	$bpjsket;
		$data['sumbangan'] 			= 	$sumbangan;
		$data['idewe'] 				= 	$idewe;
		$data['kpri'] 				= 	$kpri;
		$data['totpotrutin'] 		= 	$totpotrutin;
		$data['gajibersih'] 		= 	$gajibersih;
		$data['sakiki'] 			= 	$sakiki;
		$data['tglcetak'] 			= Carbon::now()->toDateTimeString();
		
		return view('cetak.keuangan.slipgaji', $data);
	}
	public function cetakSlipgajilengkap(Request $request) {
		$mppabp 	= Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		$homebase		= url("/");
		$tglcetak 		= Carbon::now()->toDateTimeString();
		$dd 			= date("d");
		$mm 			= date("m");
		$yy 			= date("Y");
		$jam			= date("hh:mm");
		$mthiki 		= (int)date("m");
		$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$blniki 		= $bulanlist[$mthiki];
		$sakiki 		= $dd.' '.$blniki.' '.$yy;
		$bulan			= $request->input('val02');
		$tahun			= $request->input('val03');
		$idpeg			= $request->input('val01');

		$rbulanan  		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('idpeg', $idpeg)->first();
		$gapok			= $rbulanan->gajisesuaisk;
		$nip			= $rbulanan->nip;
		$nama			= $rbulanan->nama;
		$keterangan		= $rbulanan->keterangan;
		$fungsional		= $rbulanan->fungsional;
		$jenispeg		= $rbulanan->jenispeg;
		$bank 			= $rbulanan->namabank;
		$norek 			= $rbulanan->norek;
		$nmrek 			= $rbulanan->namapdrekening;
		$cekstat		= $rbulanan->statuspegawai;	
		$katgaji		= $rbulanan->kategorigaji;
		$kdgol			= $rbulanan->golongan;
		$beras			= $rbulanan->tjberas;
		$sutri			= $rbulanan->tjistri;
		$anak			= $rbulanan->tjanak;
		$tjupns			= $rbulanan->tjupns;
		$tjstruk		= $rbulanan->tjstruk;
		$tjfungs		= $rbulanan->tjfungs;
		$tjdaerah		= $rbulanan->tjdaerah;
		$tjpencil		= $rbulanan->tjpencil;
		$tjlain			= $rbulanan->tjlain;
		$tjkompen		= $rbulanan->tjkompen;
		$tjpph			= $rbulanan->tjpph;
		$pembul			= $rbulanan->pembul;
		
		$tabukp			= $rbulanan->tabukp;
		$potpfkbul		= $rbulanan->potpfkbul;
		$potpfk2		= $rbulanan->potpfk2;
		$potpfk10		= $rbulanan->potpfk10;
		$potpph			= $rbulanan->potpph;
		$potswrum		= $rbulanan->potswrum;
		$potkelbtj		= $rbulanan->potkelbtj;
		$potlain		= $rbulanan->potlain;
		$pottabrum		= $rbulanan->pottabrum;
		$kpri			= $rbulanan->kpri;
		$arisan			= $rbulanan->arisan;
		$sumbangan		= $rbulanan->sumbangan;
		$bpjsbu			= $rbulanan->bpjsbpu;
		$bpjskes		= $rbulanan->bpjskes;
		$bpjsket		= $rbulanan->bpjsket;
		$korpri			= $rbulanan->korpri;
		$idewe			= $rbulanan->dewe;
		
		$pinjkpri		= $rbulanan->bankkpri;
		$pinjukp		= $rbulanan->bankukp;
		$bni			= $rbulanan->bni;
		$mandiri		= $rbulanan->mandiri;
		$brisuhat		= $rbulanan->brisuhat;
		$briub			= $rbulanan->briub;
		$jatim			= $rbulanan->jatim;
		$btpn			= $rbulanan->btpn;
		$btn			= $rbulanan->btn;
		
		$uangmakan		= $rbulanan->uangmakan;
		$insentif		= $rbulanan->insentif;
		$potuangmakan	= $rbulanan->potuangmakan;
		$potinsentif	= $rbulanan->potinsentif;
		$honor			= $rbulanan->honor;
		$tambahangaji	= $rbulanan->tambahangaji;
		
		$terimainsentif	= $insentif - $potinsentif;
		$terimauangmakan= $uangmakan - $potuangmakan;
		
		$golongan		= '';
		$pangkat		= '';
		$cek1 			= Golongan::where('kode', $kdgol)->count();
		if ($cek1 > 0) {
			$rcekjabatan	= Golongan::where('kode', $kdgol)->first();
			$golongan		= $rcekjabatan->golongan;
			$pangkat		= $rcekjabatan->pangkat;
		}
		
		$tottunjangan	= $beras + $sutri + $anak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph + $terimainsentif + $terimauangmakan + $honor + $tambahangaji;
		$potlainnya		= $potpfkbul + $potpfk2 + $potpfk10 + $potswrum + $potkelbtj;
		$totalpotpegawai= $potlainnya + $potpph + $potlain + $bpjskes + $pottabrum;
		$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
		$gajikotor		= $gapok + $tottunjangan;

		$totpotrutin	= $kpri + $korpri + $arisan + $idewe + $sumbangan + $tabukp + $bpjsbu + $bpjsket;
		$gajitanpapinjam= $gajikotor - $totpotrutin - $totalpotpegawai;
		$gapok			= number_format( $gapok, 0 , '.' , ',' );
		$sutri			= number_format( $sutri, 0 , '.' , ',' );
		$anak			= number_format( $anak, 0 , '.' , ',' );
		$tjfungs		= number_format( $tjfungs, 0 , '.' , ',' );
		$tjstruk		= number_format( $tjstruk, 0 , '.' , ',' );
		$tjupns			= number_format( $tjupns, 0 , '.' , ',' );
		$beras			= number_format( $beras, 0 , '.' , ',' );
		$tjpph			= number_format( $tjpph, 0 , '.' , ',' );
		$pembul			= number_format( $pembul, 0 , '.' , ',' );
		$gajikotor		= number_format( $gajikotor, 0 , '.' , ',' );
		$potlain		= number_format( $potlain, 0 , '.' , ',' );
		$potlainnya		= number_format( $potlainnya, 0 , '.' , ',' );
		$potpph			= number_format( $potpph, 0 , '.' , ',' );
		$pottabrum		= number_format( $pottabrum, 0 , '.' , ',' );
		$bpjskes		= number_format( $bpjskes, 0 , '.' , ',' );
		$totalpotpegawai= number_format( $totalpotpegawai, 0 , '.' , ',' );
		$korpri			= number_format( $korpri, 0 , '.' , ',' );
		$tabukp			= number_format( $tabukp, 0 , '.' , ',' );
		$arisan			= number_format( $arisan, 0 , '.' , ',' );
		$kpri			= number_format( $kpri, 0 , '.' , ',' );
		$sumbangan		= number_format( $sumbangan, 0 , '.' , ',' );
		$idewe			= number_format( $idewe, 0 , '.' , ',' );
		$bpjsbpu		= number_format( $bpjsbu, 0 , '.' , ',' );
		$bpjsket		= number_format( $bpjsket, 0 , '.' , ',' );
		$totpotrutin	= number_format( $totpotrutin, 0 , '.' , ',' );
		$gajibersih		= number_format( $gajitanpapinjam, 0 , '.' , ',' );

		$terimauangmakan= number_format( $terimauangmakan, 0 , '.' , ',' );
		$terimainsentif	= number_format( $terimainsentif, 0 , '.' , ',' );
		$honor			= number_format( $honor, 0 , '.' , ',' );
		$tambahangaji	= number_format( $tambahangaji, 0 , '.' , ',' );
		$idpeg			= sprintf("% 03s", $idpeg);
		$tlsnomor 		= $rbulanan->id.'/UN10.B20/KU/'.$tahun;
		$kodependaf		= $idpeg.$bulan.$tahun.$mppabp;
		$tlstahun     	= $tahun;
		if($jenispeg == 'PNS'){
			if ($bulan == 1){ $tlsbln = 'JANUARI'; }
			if ($bulan == 2){ $tlsbln = 'FEBRUARI'; }
			if ($bulan == 3){ $tlsbln = 'MARET'; }
			if ($bulan == 4){ $tlsbln = 'APRIL'; }
			if ($bulan == 5){ $tlsbln = 'MEI'; }
			if ($bulan == 6){ $tlsbln = 'JUNI'; }
			if ($bulan == 7){ $tlsbln = 'JULI'; }
			if ($bulan == 8){ $tlsbln = 'AGUSTUS'; }
			if ($bulan == 9){ $tlsbln = 'SEPTEMBER'; }
			if ($bulan == 10){ $tlsbln = 'OKTOBER'; }
			if ($bulan == 11){ $tlsbln = 'NOVEMBER'; }
			if ($bulan == 12){ $tlsbln = 'DESEMBER'; }
		}else {
			if ($bulan == 1){ $tlsbln = 'DESEMBER'; $tlstahun = $tahun - 1; }
			if ($bulan == 2){ $tlsbln = 'JANUARI'; }
			if ($bulan == 3){ $tlsbln = 'FEBRUARI'; }
			if ($bulan == 4){ $tlsbln = 'MARET'; }
			if ($bulan == 5){ $tlsbln = 'APRIL'; }
			if ($bulan == 6){ $tlsbln = 'MEI'; }
			if ($bulan == 7){ $tlsbln = 'JUNI'; }
			if ($bulan == 8){ $tlsbln = 'JULI'; }
			if ($bulan == 9){ $tlsbln = 'AGUSTUS'; }
			if ($bulan == 10){ $tlsbln = 'SEPTEMBER'; }
			if ($bulan == 11){ $tlsbln = 'OKTOBER'; }
			if ($bulan == 12){ $tlsbln = 'NOVEMBER'; }
		}
		$valset1	= '';
		$valset2	= '';
		$valset1	= '';
		$valset2	= '';
		$sql 	= SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hinboxread){
			$idsetting = $hinboxread->jenis;
			if ($idsetting == 'Bendahara Gaji'){ $valset1 = $hinboxread->isi1; }
			if ($idsetting == 'NIP Bendahara Gaji'){ $valset2 = $hinboxread->isi1; }
		}
		$idpeg			= sprintf("% 03s", $idpeg);
		$kementerian	= strtoupper(config('global.swandhanakemen'));
		$kota 			= strtoupper(config('global.swandhanakota'));
		$universitas 	= strtoupper(config('global.swandhanauniv'));
		$namaapp 		= strtoupper(config('global.swandhananama'));
		$alamat 		= config('global.swandhanaalamat');
		$email 			= config('global.swandhanaemail');
		$telpon 		= config('global.swandhanatelpon');
		$logo 			= $homebase.'/logo-ub.png';
		echo <<<EOM
			<table width="753" cellpadding="0" cellspacing="0" border="0">
			<col width="40" />
			<col width="117" />
			<col width="19" />
			<col width="200" />
			<col width="40" />
			<col width="88" />
			<col width="40" />
			<col width="89" />
			<tr>
				<td colspan="2" rowspan="6" align=" center" valign="top"><img src="$logo" alt="" width="100"/></td>
				<td colspan="6" align=" center">$kementerian</td>
			</tr>
			<tr>
				<td colspan="6" align=" center"><font size="+2"><strong>$universitas</strong></font></td>
			</tr>
			<tr>
				<td width="23"></td>
				<td width="182"></td>
				<td width="46"></td>
				<td width="130"></td>
				<td width="61"></td>
				<td width="144"></td>
			</tr>
			<tr>
				<td colspan="6" align=" center" valign="midlle">$alamat</td>
			</tr>
			<tr>
				<td colspan="6" align=" center" valign="midlle">$telpon</td>
			</tr>
			<tr>
				<td colspan="6" align=" center" valign="midlle">$email</td>
			</tr>
			<tr>
				<td colspan="8" align=" center" valign="top" style="border-bottom: 1px solid;">&nbsp;</td>
			</tr>
			<tr>
				<td width="46">&nbsp;</td>
				<td width="166">&nbsp;</td>
				<td width="23">&nbsp;</td>
				<td width="182">&nbsp;</td>
				<td width="46">&nbsp;</td>
				<td width="130">&nbsp;</td>
				<td width="61">&nbsp;</td>
				<td width="144">&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td width="46" >Nomor</td>
				<td width="166" colspan="7" >: $tlsnomor</td>
			</tr>
			<tr class="textclass">
				<td colspan="8" align="center" ><u><strong>DAFTAR PERINCIAN GAJI</strong></u></td>
			</tr>
			<tr class="textclass">
				<td colspan="8" align="center" ><strong>BULAN : $tlsbln $tahun</strong></td>
			</tr>
			<tr>
				<td colspan="6" class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td colspan="8" >Pembuat daftar gaji $mppabp Universitas Brawijaya menerangkan bahwa :</td>
			</tr>
			<tr class="textclass">
				<td >&nbsp;</td>
				<td >&nbsp;</td>
				<td >&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Nama </td>
				<td >:</td>
				<td  colspan="5">$nama</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >N I P / N I K</td>
				<td >:</td>
				<td  colspan="5">$nip</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Gol Ruang </td>
				<td >: </td>
				<td  colspan="5">$golongan</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Pangkat</td>
				<td >:</td>
				<td  colspan="5">$pangkat</td>
			</tr>
			<tr>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td class="textclass">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td  colspan="8">menerangkan penghasilan sehubungan dengan pangkat/jabatan sebagaimana terinci di bawah ini :</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td ><strong>I.</strong></td>
				<td  colspan="7"><strong>PENGHASILAN</strong></td>
			</tr>
			<tr class="textclass">
				<td >&nbsp;</td>
				<td >Gaji Pokok </td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td >Rp</td>
				<td  align="right">$gapok</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Tunjangan Keluarga</td>
				<td >:</td>
				<td >Istri/Suami</td>
				<td >Rp</td>
				<td  align="right">$sutri</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td >Anak</td>
				<td >Rp</td>
				<td  align="right">$anak</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Tunjangan Jabatan</td>
				<td >:</td>
				<td >Fungsional</td>
				<td >Rp</td>
				<td  align="right">$tjfungs</td>
				<td >&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td >Struktural</td>
				<td >Rp</td>
				<td  align="right">$tjstruk</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td >Umum</td>
				<td >Rp</td>
				<td  align="right">$tjupns</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Tunjangan Pangan</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td >Rp</td>
				<td  align="right">$beras</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Tunjangan Khusus Perpajakan</td>
				<td >Rp</td>
				<td  align="right">$tjpph</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td >Pembulatan</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td >Rp</td>
				<td  align="right">$pembul</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td ><strong>II.</strong></td>
				<td  colspan="3"><strong>PENGHASILAN LAIN - LAIN</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Tambahan Gaji</td>
				<td >Rp.</td>
				<td  align="right">$tambahangaji</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Insentif</td>
				<td >Rp.</td>
				<td  align="right">$terimainsentif</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Honorarium Lain-lain</td>
				<td >Rp.</td>
				<td  align="right">$honor</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Uang makan</td>
				<td >Rp.</td>
				<td  align="right">$terimauangmakan</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td  colspan="2"><strong>Jumlah Penerimaan Kotor</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td > Rp. </td>
				<td  align="right">$gajikotor</td>
			</tr>
			<tr class="textclass">
				<td ><strong>III.</strong></td>
				<td  colspan="3"><strong>POTONGAN PEGAWAI</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Iuran Wajib Pegawai (IWP) 10%</td>
				<td >Rp.</td>
				<td  align="right">$potlainnya</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Pajak Penghasilan</td>
				<td >Rp.</td>
				<td  align="right">$potpph</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Potongan Tabungan Rumah Pegawai</td>
				<td >Rp.</td>
				<td  align="right">$pottabrum</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Potongan Lain-lain</td>
				<td >Rp.</td>
				<td  align="right">$potlain</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">BPJS Kesehatan</td>
				<td >Rp.</td>
				<td  align="right">$bpjskes</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td  colspan="2"><strong>Jumlah Potongan</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td > Rp. </td>
				<td  align="right">$totalpotpegawai</td>
			</tr>
			<tr class="textclass">
				<td ><strong>IV.</strong></td>
				<td  colspan="3"><strong>POTONGAN RUTIN</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Iuran KORPRI</td>
				<td >Rp.</td>
				<td  align="right">$korpri</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Tabungan UKP</td>
				<td >Rp.</td>	
				<td  align="right">$tabukp</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Arisan</td>
				<td >Rp.</td>
				<td  align="right">$arisan</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">BPJS Kesehatan BPU</td>
				<td >Rp.</td>
				<td  align="right">$bpjsbpu</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">BPJS Ketenagakerjaan</td>
				<td >Rp.</td>
				<td  align="right">$bpjsket</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Sumbangan</td>
				<td >Rp.</td>
				<td  align="right">$sumbangan</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Iuran Dharmawanita</td>
				<td >Rp.</td>
				<td  align="right">$idewe</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3">Simpanan Wajib KPRI</td>
				<td >Rp.</td>
				<td  align="right">$kpri</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td  colspan="3"><strong>Jumlah Potongan Rutin</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td> Rp. </td>
				<td  align="right">$totpotrutin</td>
			</tr>
			<tr class="textclass">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td  colspan="2"><strong>Jumlah Gaji Bersih</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td > Rp. </td>
				<td  align="right">$gajibersih</td>
			</tr>
			<tr class="textclass">
				<td ><strong>V.</strong></td>
				<td  colspan="3"><strong>PINJAMAN</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
EOM;

		$totalpinjaman 	= 0;
		$count 		= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('idpeg', $idpeg)->count();

		if ($count != 0){
			$jpinjaman  	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('idpeg', $idpeg)->get();
			foreach ($jpinjaman as $rpinjaman) {
				$idne		= $rpinjaman->id;
				$idpeg		= $rpinjaman->idpeg;
				$nip		= $rpinjaman->nip;
				$jenispeg	= $rpinjaman->jenispeg;
				$kdgol		= $rpinjaman->golongan;
				$kdkawin	= $rpinjaman->kategorigaji;
				$namapdbank	= $rpinjaman->namapdrekening;
				$penempatan	= $rpinjaman->keterangan;
				$nama		= $rpinjaman->nama;
				$statpeg	= $rpinjaman->statuspegawai;
				
				$jcekhutang  		= Pinjaman::where('idpeg', $idpeg)->where('bulan', $bulan)->where('tahun', $tahun)->where('bank', '!=', 'TABUKP')->where('status', '!=', 'KOMPEN')->get();
				foreach ($jcekhutang as $rcekhutang) {
					$bankutang		= $rcekhutang->bank;
					$nominal		= $rcekhutang->nominal;
					$kodepinjaman	= $rcekhutang->kodepinjaman;
					$norek			= $rcekhutang->norek;
					$sudahbyr		= 0;
					$belumbyr		= 0;
					$totalhtg		= 0;
					$cicilanke		= 0;

					$jcekhtg  	= Pinjaman::where('idpeg', $idpeg)->where('kodepinjaman', $kodepinjaman)->get();
					foreach ($jcekhtg as $rcekhtg) {
						$htgbulan = $rcekhtg->bulan;
						$htgtahun = $rcekhtg->tahun;
						$htgstatus= $rcekhtg->status;
						if ($cicilanke == 0){
							$sudahbyr++;
						}else { $belumbyr++; }
						if ($htgbulan == $bulan AND $htgtahun == $tahun){
							$cicilanke 		= $rcekhtg->cicilanke;
							$jenpinjaman 	= $rcekhtg->kodepinjaman;
						}
						$totalhtg++;
					}
					if ($jenpinjaman != '' AND $bankutang == 'KPRI'){
						$arrayttl 	    = explode("-", $jenpinjaman);
						$kodecari	    = $arrayttl[0];
						$cekkode 		= DB::table('duidevco_masjid.ku_kodekpri')
											->where('ku_kodekpri.kode', $kodecari)
											->first();
						if (isset($cekkode->kepanjangan)){
							$jenpinjaman  = $cekkode->kepanjangan;
							$tlsbank 	  = $jenpinjaman.'('.$bankutang.')';
						} else{
							$tlsbank 	    = 'Pinjaman KPRI';
						}
					} else {
						$tlsbank 	= 'Pinjaman '.$bankutang;
					}
					
					$totalpinjaman 	= $totalpinjaman + $nominal;
					$nominal		= number_format( $nominal, 0 , '.' , ',' );
					if ($bankutang == 'KPRI' OR $bankutang == 'UKP'){
						echo '
					<tr class="textclass">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&#9755;</td>
						<td class="textclass">'.$tlsbank.'</td>
						<td class="textclass">&nbsp; ke &nbsp;</td>
						<td class="textclass">&nbsp; '.$cicilanke.'&nbsp;</td>
						<td class="textclass">&nbsp;Rp.</td>
						<td class="textclass" align="right">'.$nominal.'</td>
					</tr>';
					}else {
						echo '
					<tr class="textclass">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&#9755;</td>
						<td class="textclass">'.$tlsbank.'</td>
						<td class="textclass">&nbsp; ke &nbsp;</td>
						<td class="textclass">&nbsp; '.$cicilanke.' / '.$totalhtg.'&nbsp;</td>
						<td class="textclass">&nbsp;Rp.</td>
						<td class="textclass" align="right">'.$nominal.'</td>
					</tr>';
					}
				}

				$jcekhutang  		= RekapPinjaman::where('idpeg', $idpeg)->where('sebanyak', 0)->where('nmbank', '!=', 'TABUKP')->where('marking', 1)->get();
				foreach ($jcekhutang as $rcekhutang) {
					$bankutang		= $rcekhutang->nmbank;
					$nominal		= $rcekhutang->nominal;
					$norek			= $rcekhutang->norek;
					$kodepinjaman	= $rcekhutang->kodepinjaman;
					$sudahbyr		= 0;
					$belumbyr		= 0;
					$totalhtg		= 0;
					$cicilanke		= 0;
					$totalpinjaman 	= $totalpinjaman + $nominal;
					$nominal		= number_format( $nominal, 0 , '.' , ',' );
					echo '
					<tr class="textclass">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&#9755;</td>
						<td class="textclass">Pinjaman '.$bankutang.'</td>
						<td class="textclass">&nbsp; ke &nbsp;</td>
						<td class="textclass">&nbsp; '.$cicilanke.' / '.$totalhtg.'&nbsp;</td>
						<td class="textclass">&nbsp;Rp.</td>
						<td class="textclass" align="right">'.$nominal.'</td>
					</tr>';
					$nomer++;
				}			
			}
		}
		$bayar 			= $gajitanpapinjam - $totalpinjaman;
		$totalpinjaman	= number_format( $totalpinjaman, 0 , '.' , ',' );
		$bayar			= number_format( $bayar, 0 , '.' , ',' );
		$tulisdiqrcode	= 'An. '.$nama.' Nomor : '.$tlsnomor.' Bulan '.$tlsbln.' Tahun '.$tahun.' Nominal : '.$bayar;
		$qrcode 		= base64_encode(QrCode::format('png')->size(100)->generate($tulisdiqrcode));
			
		echo <<<EOM
			<tr class="textclass">
			<td>&nbsp;</td>
			<td class="textclass" colspan="3"><strong>Jumlah Pinjaman</strong></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="textclass"> Rp. </td>
			<td class="textclass" align="right">$totalpinjaman</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="textclass" colspan="2"><strong>SISA GAJI</strong></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="textclass"><strong>&nbsp;Rp.</strong></td>
			<td class="textclass" align="right"><strong>$bayar</strong></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			<tr class="textclass">
			<td class="textclass" colspan="8">Jumlah gaji tersebut dibayarkan kepada pegawai yang bersangkutan pada bulan tersebut.</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
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
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			
EOM;
			echo '
			<tr>
			<td colspan="3"><img src="data:image/png;base64, '.$qrcode.' "></td>
			<td colspan="5">
				<table border="0">
					<tr class="textclass">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="textclass" colspan="3">Malang, '.$sakiki.'</td>
					</tr>
					<tr class="textclass">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="textclass" colspan="3">PPABP</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr class="textclass">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="textclass" colspan="3">ttd</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr class="textclass">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="textclass" colspan="3">'.$valset1.'</td>
					</tr>
					<tr class="textclass">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="textclass" colspan="3">'.$valset2.'</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr class="textclass">
			<td class="textclass" colspan="4">'.$tglcetak.'</td>
			<td class="textclass" colspan="4">&nbsp;</td>
			</tr>
			</table>';
	}
	public function dataJgajian(Request $request) {
		$mppabp 	= 	Session('fakultas');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		ini_set('max_execution_time', 700);
		$sberas 	= 0;
		$sutri		= 0;
		$anak1		= 0;
		$anak2		= 0;
		$umr		= 0;
		$setbpjs1	= 0;
		$setbpjs2	= 0;
		$ctunj		= 0;
		$cpbni		= 0;
		$cpmandiri 	= 0;
		$cpkpri		= 0;
		$cpukp		= 0;
		$cpbptn		= 0;
		$cpbrish	= 0;
		$cpbriub	= 0;
		$cpbtn		= 0;
		$cpjatim	= 0;
		$carisan	= 0;
		$cidw		= 0;
		$cpotkorpri	= 0;
		$cpotkpri	= 0;
		$csumbangan	= 0;
		$cpotukp	= 0;
		$cbpjsrsub	= 0;
		$cbpjskes	= 0;
		$cbpjsket	= 0;
		$cuangmakan	= 0;
		$cinsentif	= 0;
		$jpns		= 0;
		$jpns 		= 0;
		$jpnpn 		= 0;
		$jkontrak 	= 0;
		$bankkpri	= 0;
		$bankukp	= 0;
		$tabukp		= 0;
		$bni		= 0;
		$mandiri	= 0;
		$brisuhat	= 0;
		$briub		= 0;
		$jatim		= 0;
		$btpn		= 0;
		$btn 		= 0;
		$arisan		= 0;
		$dewe		= 0;
		$korpri		= 0;
		$kpri		= 0;
		$sumbangan	= 0;
		$tabukp		= 0;
		$potongan	= 0;
		$bpjsbpu	= 0;
		$bpjskes	= 0;
		$bpjsket	= 0;
		$nomgaji	= 0;
		$uangmakan	= 0;
		$insentif	= 0;
		$sql 		= SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hinboxread){
			$jenis = $hinboxread->jenis;
			if ($jenis == 'sutri'){ $sutri = $hinboxread->isi1; $idsutri = $hinboxread->id; }
			if ($jenis == 'beras'){ $beras = $hinboxread->isi1; $idberas = $hinboxread->id; }
			if ($jenis == '1anak'){ $anak1 = $hinboxread->isi1; $idanak1 = $hinboxread->id; }
			if ($jenis == '2anak'){ $anak2 = $hinboxread->isi1; $idanak2 = $hinboxread->id; }
			if ($jenis == 'Upah BPJS Ketenagakerjaan (Minimum)'){ $umr = $hinboxread['isi1']; }
			if ($jenis == 'Pungut BPJS Ket Minimum'){ $setbpjs2 = $hinboxread['isi1'];  }
			if ($jenis == 'BPJS Kesehatan (Persen)'){ $setbpjs1 = $hinboxread['isi1'];  }
		}
		$bulan				= (int)$request->input('val01');
		$tahun				= $request->input('val02');
		$nomspm				= 0;
		$dataspm			= 0;
		$ketspm				= '';
		$jall				= 0;
		$gajibersihpns		= 0;
		$gajibersihpnpn		= 0;
		$gajibersihkontrak	= 0;
		$bankkpripns		= 0;
		$bankkpripnpn		= 0;
		$bankkprikontrak	= 0;
		$bankukppns			= 0;
		$bankukppnpn		= 0;
		$bankukpkontrak		= 0;
		$tabukppns			= 0;
		$tabukppnpn			= 0;
		$tabukpkontrak		= 0;
		$btnpns				= 0;
		$btnpnpn			= 0;
		$btnkontrak			= 0;
		$kpripns			= 0;
		$kpripnpn			= 0;
		$kprikontrk			= 0;
		$arisanpns			= 0;
		$arisanpnpn			= 0;
		$arisankontrak		= 0;
		$sumbanganpns		= 0;
		$sumbanganpnpn		= 0;
		$sumbangankontrak	= 0;
		$bpjsbpupns			= 0;
		$bpjsbpupnpn		= 0;
		$bpjsbpukontrak		= 0;
		$bpjskespns			= 0;
		$bpjskespnpn		= 0;
		$bpjskeskontrak		= 0;
		$bpjsketpns			= 0;
		$bpjsketpnpn		= 0;
		$bpjsketkontrak		= 0;
		$korpripns			= 0;
		$korpripnpn			= 0;
		$korprikontrak		= 0;
		$dewepns			= 0;
		$dewepnpn			= 0;
		$dewekontrak		= 0;
		$bnipns				= 0;
		$bnipnpn			= 0;
		$bnikontrak			= 0;
		$mandiripns			= 0;
		$mandiripnpn		= 0;
		$mandirikontrak		= 0;
		$brisuhatpns		= 0;
		$brisuhatpnpn		= 0;
		$brisuhatkontrak	= 0;
		$briubpns			= 0;
		$briubpnpn			= 0;
		$briubkontrak		= 0;
		$jatimpns			= 0;
		$jatimpnpn			= 0;
		$jatimkontrak		= 0;
		$btpnpns			= 0;
		$btpnpnpn			= 0;
		$btpnkontrak		= 0;
		Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->delete();
		$sql    = DB::table('duidevco_masjid.pegawai as pegawai')
					->leftJoin('duidevco_masjid.potonganrutin as potonganrutin', 'duidevco_masjid.pegawai.idpeg', 'duidevco_masjid.potonganrutin.idpeg')
					->select('duidevco_masjid.pegawai.*', 'duidevco_masjid.potonganrutin.kpri', 'duidevco_masjid.potonganrutin.ukp', 'duidevco_masjid.potonganrutin.korpri', 'duidevco_masjid.potonganrutin.arisan', 'duidevco_masjid.potonganrutin.idw', 'duidevco_masjid.potonganrutin.sumbangan', 'duidevco_masjid.potonganrutin.bpjsbpu', 'duidevco_masjid.potonganrutin.bpjsketenagakerjaan', 'duidevco_masjid.potonganrutin.bpjsppnpn')
					->where('duidevco_masjid.pegawai.ppabp', $mppabp)
					->where('duidevco_masjid.pegawai.status', 1)
					->orderBy('duidevco_masjid.pegawai.jenispeg', 'DESC')
					->orderBy('duidevco_masjid.pegawai.nama', 'ASC')
					->get();
		
		foreach ($sql as $hasil) {
			$jall++;
			$idpeg		= $hasil->idpeg;
			$nip		= $hasil->nip;
			$nama		= $hasil->nama;
			$keterangan	= $hasil->keterangan;
			$fungsional	= $hasil->fungsional;
			$jenispeg	= $hasil->jenispeg;
			$bank 		= $hasil->namabank;
			$norek 		= $hasil->norek;
			$nmrek 		= $hasil->namapdrekening;
			$nomgaji	= $hasil->gajisesuaisk;
			$cekstat	= $hasil->statuspegawai;	
			$katgaji	= $hasil->kategorigaji;
			$tunjberas	= $hasil->tjberas;
			$tunjsutri	= $hasil->tjistri;
			$tunjanak	= $hasil->tjanak;
			$tunjstruk	= $hasil->tjstruk;
			$tunjupns	= $hasil->tjupns;
			$tunjfung	= $hasil->tjfungs;
			$tjdaerah	= $hasil->tjdaerah;
			$tjpencil	= $hasil->tjpencil;
			$tjlain		= $hasil->tjlain;
			$tjkompen	= $hasil->tjkompen;
			$pembul		= $hasil->pembul;
			$tjpph		= $hasil->tjpph;
			$potpfkbul	= $hasil->potpfkbul;
			$potpfk2	= $hasil->potpfk2;
			$potpfk10	= $hasil->potpfk10;
			$potpph		= $hasil->potpph;
			$potswrum	= $hasil->potswrum;
			$potkelbtj	= $hasil->potkelbtj;
			$potlain	= $hasil->potlain;
			$pottabrum	= $hasil->pottabrum;	
			$status		= $hasil->status;
			$kdgol		= $hasil->golongan;
			$ppabp		= $hasil->ppabp;
			if (isset($hasil->id)){
				$idpotongan = $hasil->id;
			} else { $idpotongan = 0; }
			if (isset($hasil->kpri)){
				$kpri = $hasil->kpri;
			} else { $kpri = 0; }
			if (isset($hasil->arisan)){
				$arisan = $hasil->arisan;
			} else { $arisan = 0; }
			if (isset($hasil->sumbangan)){
				$sumbangan = $hasil->sumbangan;
			} else { $sumbangan = 0; }
			if (isset($hasil->bpjsbpu)){
				$bpjsbpu = $hasil->bpjsbpu;
			} else { $bpjsbpu = 0; }
			if (isset($hasil->bpjsppnpn)){
				$bpjskes = $hasil->bpjsppnpn;
			} else { $bpjskes = 0; }
			if (isset($hasil->bpjsketenagakerjaan)){
				$bpjsket = $hasil->bpjsketenagakerjaan;
			} else { $bpjsket = 0; }
			if ($jenispeg == 'PNPN_BOPTN' OR $jenispeg == 'PNS'){
				if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $korpri = 4000; }
				else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $korpri = 3000; }
				else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $korpri = 2000; }
				else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $korpri = 1000; }
				else { $korpri = 1000; }
			}else { $korpri = 1000; }
			if ($jenispeg == 'PNS'){
				if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $dewe = 4000; }
				else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $dewe = 3000; }
				else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $dewe = 2000; }
				else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $dewe = 1000; }
				else { $dewe = 1000; }
			}else { $dewe = 0; }
			if ($jenispeg == 'PNPN_BOPTN'){ $jenis = 'Gaji PNPN PNBP'; }
			else if ($jenispeg == 'PNPN_PNBP'){ $jenis = 'Gaji PNPN BOPTN'; }
			else if ($jenispeg == 'KONTRAK_PNBP'){ $jenis = 'Gaji Kontrak PNBP'; }
			else if ($jenispeg == 'KONTRAK_BOPTN'){ $jenis = 'Gaji Kontrak BOPTN'; }
			else { $jenis = 'Gaji PNS'; }
			$bankkpri	= 0;
			$bankukp	= 0;
			$tabukp		= 0;
			$bni		= 0;
			$mandiri	= 0;
			$brisuhat	= 0;
			$briub		= 0;
			$jatim		= 0;
			$btpn		= 0;
			$btn 		= 0;

			$jcekhutang  		=	Pinjaman::where('idpeg', $idpeg)->where('bulan', $bulan)->where('tahun', $tahun)->where('status', '!=', 'KOMPEN')->get();
			foreach ($jcekhutang as $rcekhutang) {
				$bankutang	= $rcekhutang->bank;
				$utange		= $rcekhutang->nominal;
				if ($bankutang == 'KPRI'){ $bankkpri = $bankkpri + $utange; }
				if ($bankutang == 'UKP'){ $bankukp = $bankukp + $utange; }
				if ($bankutang == 'BNI'){ $bni = $bni + $utange; }
				if ($bankutang == 'MANDIRI'){ $mandiri = $mandiri + $utange; }
				if ($bankutang == 'BRI UB'){ $briub = $briub + $utange; }
				if ($bankutang == 'BRI Soehat'){ $brisuhat = $brisuhat + $utange; }
				if ($bankutang == 'JATIM'){ $jatim = $jatim + $utange; }
				if ($bankutang == 'BPTN'){ $btpn = $btpn + $utange; }
				if ($bankutang == 'BTN'){ $btn = $btn + $utange; }
				if ($bankutang == 'TABUKP'){ $tabukp = $tabukp + $utange; }
			}

			$jcekhutang2  		= RekapPinjaman::where('idpeg', $idpeg)->where('sebanyak', 0)->where('marking', 1)->get();
			foreach ($jcekhutang2 as $rcekhutang2) {
				$bankutang	= $rcekhutang2->nmbank;
				$utange		= $rcekhutang2->nominal;
				if ($bankutang == 'KPRI'){ $bankkpri = $bankkpri + $utange; }
				if ($bankutang == 'UKP'){ $bankukp = $bankukp + $utange; }
				if ($bankutang == 'BNI'){ $bni = $bni + $utange; }
				if ($bankutang == 'MANDIRI'){ $mandiri = $mandiri + $utange; }
				if ($bankutang == 'BRI UB'){ $briub = $briub + $utange; }
				if ($bankutang == 'BRI Soehat'){ $brisuhat = $brisuhat + $utange; }
				if ($bankutang == 'JATIM'){ $jatim = $jatim + $utange; }
				if ($bankutang == 'BPTN'){ $btpn = $btpn + $utange; }
				if ($bankutang == 'BTN'){ $btn = $btn + $utange; }
				if ($bankutang == 'TABUKP'){ $tabukp = $tabukp + $utange; }
			}
			$marking 		= $tahun.$bulan.'-'.$norek;
			$tottunjangan	= $tunjsutri + $tunjanak + $tunjupns + $tunjstruk + $tunjfung + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph + $tunjberas;
			$potonganspm	= $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum;
			$kotor			= $nomgaji + $tottunjangan;
			$totalnonbpjs	= $kotor - $potonganspm;
		
			if ($jenispeg == 'PNS'){
				$ceklampiranspm = LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->first();
				if (isset($ceklampiranspm->bersih)){
					$bersihversispm	= $ceklampiranspm->bersih;
					$bpjskes		= $ceklampiranspm->bpjs;
					if (is_null($bpjskes) OR $bpjskes == 0 OR $bpjskes == ''){
						$bpjskes	= $totalnonbpjs - $bersihversispm;
					}
					$cekpotongan 	= PotonganRutin::where('idpeg', $idpeg)->count();
					if ($cekpotongan == 0){
						PotonganRutin::create([
							'idpeg'					=> $idpeg,
							'kpri'					=> $kpri,
							'ukp'					=> $tabukp,
							'korpri'				=> $korpri,
							'arisan'				=> $arisan,
							'idw'					=> $dewe,
							'sumbangan'				=> $sumbangan,
							'bpjsbpu'				=> $bpjsbpu,
							'bpjsketenagakerjaan'	=> $bpjsket,
							'bpjsppnpn'				=> $bpjskes,
						]);
					} else {
						PotonganRutin::where('idpeg', $idpeg)->update([
							'kpri'					=> $kpri,
							'ukp'					=> $tabukp,
							'korpri'				=> $korpri,
							'arisan'				=> $arisan,
							'idw'					=> $dewe,
							'sumbangan'				=> $sumbangan,
							'bpjsbpu'				=> $bpjsbpu,
							'bpjsketenagakerjaan'	=> $bpjsket,
							'bpjsppnpn'				=> $bpjskes,
						]);
					}
				}
			}
			$totpotongan	= $potonganspm + $kpri + $korpri + $arisan + $dewe + $sumbangan + $bpjsbpu + $bpjskes + $bpjsket + $tabukp;
			$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
			$totpinjaman	= $bankkpri + $bankukp + $pinjbank;
			$gajidlmdft		= $kotor - $totpinjaman - $totpotongan;
			$master 		= '';
			$input 			= Report::create([
				'bulan' 			=> 	$bulan,
				'tahun' 			=> 	$tahun,
				'idpeg' 			=> 	$idpeg,
				'jenispeg' 			=> 	$jenispeg,
				'golongan' 			=> 	$kdgol,
				'nip' 				=> 	$nip,
				'nama' 				=> 	$nama,
				'keterangan' 		=> 	$keterangan,
				'fungsional' 		=> 	$fungsional,
				'sberas' 			=> 	$sberas,
				'namabank' 			=> 	$norek,
				'namapdrekening' 	=> 	$nmrek,
				'gajisesuaisk' 		=> 	$nomgaji,
				'statuspegawai' 	=> 	$cekstat,
				'kategorigaji' 		=> 	$katgaji,
				'tjistri' 			=> 	$tunjsutri,
				'tjanak' 			=> 	$tunjanak,
				'tjupns' 			=> 	$tunjupns,
				'tjstruk' 			=> 	$tunjstruk,
				'tjfungs' 			=> 	$tunjfung,
				'tjdaerah' 			=> 	$tjdaerah,
				'tjpencil' 			=> 	$tjpencil,
				'tjlain' 			=> 	$tjlain,
				'tjkompen' 			=> 	$tjkompen,
				'pembul' 			=> 	$pembul,
				'tjberas' 			=> 	$tunjberas,
				'tjpph' 			=> 	$tjpph,
				'potpfkbul' 		=> 	$potpfkbul,
				'potpfk2' 			=> 	$potpfk2,
				'potpfk10' 			=> 	$potpfk10,
				'potpph' 			=> 	$potpph,
				'potswrum' 			=> 	$potswrum,
				'potkelbtj' 		=> 	$potkelbtj,
				'potlain' 			=> 	$potlain,
				'pottabrum' 		=> 	$pottabrum,
				'bankkpri' 			=> 	$bankkpri,
				'bankukp' 			=> 	$bankukp,
				'tabukp' 			=> 	$tabukp,
				'bni' 				=> 	$bni,
				'mandiri' 			=> 	$mandiri,
				'brisuhat' 			=> 	$brisuhat,
				'briub' 			=> 	$briub,
				'jatim' 			=> 	$jatim,
				'btpn' 				=> 	$btpn,
				'btn' 				=> 	$btn,
				'kpri' 				=> 	$kpri,
				'arisan' 			=> 	$arisan,
				'sumbangan' 		=> 	$sumbangan,
				'bpjsbpu' 			=> 	$bpjsbpu,
				'bpjskes' 			=> 	$bpjskes,
				'bpjsket' 			=> 	$bpjsket,
				'korpri' 			=> 	$korpri,
				'dewe' 				=> 	$dewe,
				'marking'			=> 	$marking,
				'ppabp' 			=> 	$mppabp
			]);
			if ($input){
				if ($jenispeg == 'PNS'){
					$gajibersihpns		= $gajibersihpns + $gajidlmdft;
					$bankkpripns		= $bankkpripns + $bankkpri;
					$bankukppns			= $bankukppns + $bankukp;
					$tabukppns			= $tabukppns + $tabukp;
					$btnpns				= $btnpns + $btn;
					$kpripns			= $kpripns + $kpri;
					$arisanpns			= $arisanpns + $arisan;
					$sumbanganpns		= $sumbanganpns + $sumbangan;
					$bpjsbpupns			= $bpjsbpupns + $bpjsbpu;
					$bpjskespns			= $bpjskespns + $bpjskes;
					$bpjsketpns			= $bpjsketpns + $bpjsket;
					$korpripns			= $korpripns + $korpri;
					$dewepns			= $dewepns + $dewe;
					$bnipns				= $bnipns + $bni;
					$mandiripns			= $mandiripns + $mandiri;
					$brisuhatpns		= $brisuhatpns + $brisuhat;
					$briubpns			= $briubpns + $briub;
					$jatimpns			= $jatimpns + $jatim;
					$btpnpns			= $btpnpns + $btpn;
				} else if ($jenispeg == 'PNPN_BOPTN' OR $jenispeg == 'PNPN_PNBP'){
					$gajibersihpnpn		= $gajibersihpnpn + $gajidlmdft;
					$bankkpripnpn		= $bankkpripnpn + $bankkpri;
					$bankukppnpn		= $bankukppnpn + $bankukp;
					$tabukppnpn			= $tabukppnpn + $tabukp;
					$btnpnpn			= $btnpnpn + $btn;
					$kpripnpn			= $kpripnpn + $kpri;
					$arisanpnpn			= $arisanpnpn + $arisan;
					$sumbanganpnpn		= $sumbanganpnpn + $sumbangan;
					$bpjsbpupnpn		= $bpjsbpupnpn + $bpjsbpu;
					$bpjskespnpn		= $bpjskespnpn + $bpjskes;
					$bpjsketpnpn		= $bpjsketpnpn + $bpjsket;
					$korpripnpn			= $korpripnpn + $korpri;
					$dewepnpn			= $dewepnpn + $dewe;
					$bnipnpn			= $bnipnpn + $bni;
					$mandiripnpn		= $mandiripnpn + $mandiri;
					$brisuhatpnpn		= $brisuhatpnpn + $brisuhat;
					$briubpnpn			= $briubpnpn + $briub;
					$jatimpnpn			= $jatimpnpn + $jatim;
					$btpnpnpn			= $btpnpnpn + $btpn;
				} else {
					$gajibersihkontrak	= $gajibersihkontrak + $gajidlmdft;
					$bankkprikontrak	= $bankkprikontrak + $bankkpri;
					$bankukpkontrak		= $bankukpkontrak + $bankukp;
					$tabukpkontrak		= $tabukpkontrak + $tabukp;
					$btnkontrak			= $btnkontrak + $btn;
					$kprikontrk			= $kprikontrk + $kpri;
					$arisankontrak		= $arisankontrak + $arisan;
					$sumbangankontrak	= $sumbangankontrak + $sumbangan;
					$bpjsbpukontrak		= $bpjsbpukontrak + $bpjsbpu;
					$bpjskeskontrak		= $bpjskeskontrak + $bpjskes;
					$bpjsketkontrak		= $bpjsketkontrak + $bpjsket;
					$korprikontrak		= $korprikontrak + $korpri;
					$dewekontrak		= $dewekontrak + $dewe;
					$bnikontrak			= $bnikontrak + $bni;
					$mandirikontrak		= $mandirikontrak + $mandiri;
					$brisuhatkontrak	= $brisuhatkontrak + $brisuhat;
					$briubkontrak		= $briubkontrak + $briub;
					$jatimkontrak		= $jatimkontrak + $jatim;
					$btpnkontrak		= $btpnkontrak + $btpn;
				}
			}
		}
		if ($bulan == 1){ $tulisbln = 'Januari'; }
		if ($bulan == 2){ $tulisbln = 'Februari'; }
		if ($bulan == 3){ $tulisbln = 'Maret'; }
		if ($bulan == 4){ $tulisbln = 'April'; }
		if ($bulan == 5){ $tulisbln = 'Mei'; }
		if ($bulan == 6){ $tulisbln = 'Juni'; }
		if ($bulan == 7){ $tulisbln = 'Juli'; }
		if ($bulan == 8){ $tulisbln = 'Agustus'; }
		if ($bulan == 9){ $tulisbln = 'September'; }
		if ($bulan == 10){ $tulisbln = 'Oktober'; }
		if ($bulan == 11){ $tulisbln = 'November'; }
		if ($bulan == 12){ $tulisbln = 'Desember'; }
		$gajibersihall	= $gajibersihkontrak + $gajibersihpnpn + $gajibersihpns;
		$bankkpriall	= $bankkprikontrak + $bankkpripnpn + $bankkpripns;
		$bankukpall		= $bankukpkontrak + $bankukppnpn + $bankukppns;
		$tabukpall		= $tabukpkontrak + $tabukppnpn + $tabukppns;
		$btnall			= $btnkontrak + $btnpnpn + $btnpns;
		$kpriall		= $kprikontrk + $kpripnpn + $kpripns;
		$arisanall		= $arisankontrak + $arisanpnpn + $arisanpns;
		$sumbanganall	= $sumbangankontrak + $sumbanganpnpn + $sumbanganpns;
		$bpjsbpuall		= $bpjsbpukontrak + $bpjsbpupnpn + $bpjsbpupns;
		$bpjsketall		= $bpjsketkontrak + $bpjsketpnpn + $bpjsketpns;
		$bpjskesall		= $bpjskeskontrak + $bpjskespnpn + $bpjskespns;
		$korpriall		= $korprikontrak + $korpripnpn + $korpripns;
		$deweall		= $dewekontrak + $dewepnpn + $dewepns;
		$bniall			= $bnikontrak + $bnipnpn + $bnipns;
		$mandiriall		= $mandirikontrak + $mandiripnpn + $mandiripns;
		$brisuhatall	= $brisuhatkontrak + $brisuhatpnpn + $brisuhatpns;
		$briuball		= $briubkontrak + $briubpnpn + $briubpns;
		$jatimall		= $jatimkontrak + $jatimpnpn + $jatimpns;
		$btpnall		= $btpnkontrak + $btpnpnpn + $btpnpns;
		$potongankontrak= $bpjskeskontrak + $bankkprikontrak + $bankukpkontrak + $tabukpkontrak + $btnkontrak + $kprikontrk + $arisankontrak + $sumbangankontrak + $bpjsbpukontrak + $bpjsketkontrak + $korprikontrak + $dewekontrak + $bnikontrak + $mandirikontrak + $brisuhatkontrak + $briubkontrak + $jatimkontrak + $btpnkontrak;
		$potonganpnpn	= $bpjskespnpn + $bankkpripnpn + $bankukppnpn + $tabukppnpn + $btnpnpn + $kpripnpn + $arisanpnpn + $sumbanganpnpn + $bpjsbpupnpn + $bpjsketpnpn + $korpripnpn + $dewepnpn + $bnipnpn + $mandiripnpn + $brisuhatpnpn + $briubpnpn + $jatimpnpn + $btpnpnpn;
		$potonganpns	= $bpjskespns + $bankkpripns + $bankukppns + $tabukppns + $btnpns + $kpripns + $arisanpns + $sumbanganpns + $bpjsbpupns + $bpjsketpns + $korpripns + $dewepns + $bnipns + $mandiripns + $brisuhatpns + $briubpns + $jatimpns + $btpnpns;
		$terimapns		= $gajibersihpns - $potonganpns;
		$terimapnpn		= $gajibersihpnpn - $potonganpnpn;
		$terimakontrak	= $gajibersihkontrak - $potongankontrak;
		
		$arrpotongan[] = array(
			'nomer' 		=> '1',
			'uraian'		=> 'Gaji Bersih Dalam Daftar',
			'pns' 			=> $gajibersihpns,
			'pnpn' 			=> $gajibersihpnpn,
			'kontrak' 		=> $gajibersihkontrak,
			'jumlah' 		=> $gajibersihall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '2',
			'uraian'		=> 'KPRI',
			'pns' 			=> $bankkpripns,
			'pnpn' 			=> $bankkpripnpn,
			'kontrak' 		=> $bankkprikontrak,
			'jumlah' 		=> $bankkpriall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '3',
			'uraian'		=> 'UKP',
			'pns' 			=> $bankukppns,
			'pnpn' 			=> $bankukppnpn,
			'kontrak' 		=> $bankukpkontrak,
			'jumlah' 		=> $bankukpall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '4',
			'uraian'		=> 'BANK BTN',
			'pns' 			=> $btnpns,
			'pnpn' 			=> $btnpnpn,
			'kontrak' 		=> $btnkontrak,
			'jumlah' 		=> $btnall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '5',
			'uraian'		=> 'BANK JATIM',
			'pns' 			=> $jatimpns,
			'pnpn' 			=> $jatimpnpn,
			'kontrak' 		=> $jatimkontrak,
			'jumlah' 		=> $jatimall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '6',
			'uraian'		=> 'BANK BRI SOEHAT',
			'pns' 			=> $brisuhatpns,
			'pnpn' 			=> $brisuhatpnpn,
			'kontrak' 		=> $brisuhatkontrak,
			'jumlah' 		=> $brisuhatall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '7',
			'uraian'		=> 'BANK BRI UB',
			'pns' 			=> $briubpns,
			'pnpn' 			=> $briubpnpn,
			'kontrak' 		=> $briubkontrak,
			'jumlah' 		=> $briuball
		);
		$arrpotongan[] = array(
			'nomer' 		=> '8',
			'uraian'		=> 'BANK BTPN',
			'pns' 			=> $btpnpns,
			'pnpn' 			=> $btpnpnpn,
			'kontrak' 		=> $btpnkontrak,
			'jumlah' 		=> $btpnall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '9',
			'uraian'		=> 'BANK MANDIRI UB',
			'pns' 			=> $mandiripns,
			'pnpn' 			=> $mandiripnpn,
			'kontrak' 		=> $mandirikontrak,
			'jumlah' 		=> $mandiriall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '10',
			'uraian'		=> 'Potongan Simpanan Wajib KPRI',
			'pns' 			=> $kpripns,
			'pnpn' 			=> $kpripnpn,
			'kontrak' 		=> $kprikontrk,
			'jumlah' 		=> $kpriall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '11',
			'uraian'		=> 'Potongan UKP',
			'pns' 			=> $tabukppns,
			'pnpn' 			=> $tabukppnpn,
			'kontrak' 		=> $tabukpkontrak,
			'jumlah' 		=> $tabukpall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '12',
			'uraian'		=> 'Potongan KORPRI',
			'pns' 			=> $korpripns,
			'pnpn' 			=> $korpripnpn,
			'kontrak' 		=> $korprikontrak,
			'jumlah' 		=> $korpriall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '13',
			'uraian'		=> 'Potongan Arisan',
			'pns' 			=> $arisanpns,
			'pnpn' 			=> $arisanpnpn,
			'kontrak' 		=> $arisankontrak,
			'jumlah' 		=> $arisanall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '14',
			'uraian'		=> 'Potongan Ikatan Dharma Wanita',
			'pns' 			=> $dewepns,
			'pnpn' 			=> $dewepnpn,
			'kontrak' 		=> $dewekontrak,
			'jumlah' 		=> $deweall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '15',
			'uraian'		=> 'Sumbangan',
			'pns' 			=> $sumbanganpns,
			'pnpn' 			=> $sumbanganpnpn,
			'kontrak' 		=> $sumbangankontrak,
			'jumlah' 		=> $sumbanganall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '16',
			'uraian'		=> 'Potogan BPJS Kesehatan',
			'pns' 			=> $bpjskespns,
			'pnpn' 			=> $bpjskespnpn,
			'kontrak' 		=> $bpjskeskontrak,
			'jumlah' 		=> $bpjskesall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '17',
			'uraian'		=> 'Potogan BPJS PSU',
			'pns' 			=> $bpjsbpupns,
			'pnpn' 			=> $bpjsbpupnpn,
			'kontrak' 		=> $bpjsbpukontrak,
			'jumlah' 		=> $bpjsbpuall
		);
		$arrpotongan[] = array(
			'nomer' 		=> '18',
			'uraian'		=> 'Potogan BPJS Ketenagakerjaan',
			'pns' 			=> $bpjsketpns,
			'pnpn' 			=> $bpjsketpnpn,
			'kontrak' 		=> $bpjsketkontrak,
			'jumlah' 		=> $bpjsketall
		);
		$arrpotongan[] = array(
			'nomer' 		=> ' ',
			'uraian'		=> '<strong>JUMLAH POTONGAN</strong>',
			'pns' 			=> $potonganpns,
			'pnpn' 			=> $potonganpnpn,
			'kontrak' 		=> $potongankontrak,
			'jumlah' 		=> ''
		);
		$arrpotongan[] = array(
			'nomer' 		=> ' ',
			'uraian'		=> '<strong>GAJI YANG DITERIMA BERSIH</strong>',
			'pns' 			=> $terimapns,
			'pnpn' 			=> $terimapnpn,
			'kontrak' 		=> $terimakontrak,
			'jumlah' 		=> ''
		);
		
		echo json_encode($arrpotongan);
	}
	public function viewGpp() {
		$ppabp 	= 	Ppabp::orderBy('id')->get();

		$data 	= 	[];
		$data['ppabp'] 		= 	$ppabp;

		return view('admin.keuangan.gpp', $data);
	}
	public function generateDatagpp(Request $request) {
		$bulan		= (int)$request->input('val01');
		$tahun		= $request->input('val02');
		$ppabp		= $request->input('val03');
		$arrgaji	= array();
		$nomspm		= 0;
		$dataspm	= 0;
		$ketspm		= '';
		if ($bulan == 1){ $tulisbln = 'Januari'; }
		if ($bulan == 2){ $tulisbln = 'Februari'; }
		if ($bulan == 3){ $tulisbln = 'Maret'; }
		if ($bulan == 4){ $tulisbln = 'April'; }
		if ($bulan == 5){ $tulisbln = 'Mei'; }
		if ($bulan == 6){ $tulisbln = 'Juni'; }
		if ($bulan == 7){ $tulisbln = 'Juli'; }
		if ($bulan == 8){ $tulisbln = 'Agustus'; }
		if ($bulan == 9){ $tulisbln = 'September'; }
		if ($bulan == 10){ $tulisbln = 'Oktober'; }
		if ($bulan == 11){ $tulisbln = 'November'; }
		if ($bulan == 12){ $tulisbln = 'Desember'; }
		$isigak		= '';

		$cekgaji	= LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $ppabp)->count();
		$nomer		= 1;
		if ($cekgaji != 0){
			$jcekgaji  	= LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $ppabp)->get();
			foreach ($jcekgaji as $hasil) {
				$master			= $hasil->id;
				$kdsatker		= $hasil->kdsatker;
				$kdanak			= $hasil->kdanak;
				$kdsubanak		= $hasil->kdsubanak;
				$bulan			= $hasil->bulan;
				$tahun			= $hasil->tahun;
				$nogaji			= $hasil->nogaji;
				$kdjns			= $hasil->kdjns;
				$nip			= $hasil->nip;
				$nmpeg 			= $hasil->nmpeg;
				$kdduduk 		= $hasil->kdduduk;
				$kdgol 			= $hasil->kdgol;
				$npwp			= $hasil->npwp;
				$nmrek			= $hasil->nmrek;	
				$nm_bank		= $hasil->nm_bank;		
				$rekening		= $hasil->rekening;
				$kdbankspan		= $hasil->kdbankspan;
				$nmbankspan		= $hasil->nmbankspan;
				$kdpos			= $hasil->kdpos;		
				$kdnegara		= $hasil->kdnegara;
				$kdkppn			= $hasil->kdkppn;
				$tipesup		= $hasil->tipesup;
				$gjpokok		= $hasil->gjpokok;
				$tjistri		= $hasil->tjistri;
				$tjanak			= $hasil->tjanak;
				$tjupns			= $hasil->tjupns;
				$tjstruk		= $hasil->tjstruk;		
				$tjfungs		= $hasil->tjfungs;
				$tjdaerah		= $hasil->tjdaerah;
				$tjpencil		= $hasil->tjpencil;
				$tjlain			= $hasil->tjlain;
				$tjkompen		= $hasil->tjkompen;
				$pembul			= $hasil->pembul;
				$tjberas		= $hasil->tjberas;
				$tjpph			= $hasil->tjpph;
				$potpfkbul		= $hasil->potpfkbul;
				$potpfk2		= $hasil->potpfk2;
				$potpfk10		= $hasil->potpfk10;
				$potpph			= $hasil->potpph;
				$potswrum		= $hasil->potswrum;
				$potkelbtj		= $hasil->potkelbtj;
				$potlain		= $hasil->potlain;
				$pottabrum		= $hasil->pottabrum;
				$bersih			= $hasil->bersih;
				$sandi 			= $hasil->sandi;
				$kdkawin 		= $hasil->kdkawin;
				$kdjab 			= $hasil->kdjab;
				if ($kdgol != ''){
					$rcekjabatan	= Golongan::where('kode', $kdgol)->first();
					$golongan		= $rcekjabatan->golongan;
					$pangkat		= $rcekjabatan->pangkat;
				}else { $pangkat = ''; $golongan = '';}
				$arrgaji[] = array(
					'nomer' 			=> $nomer,
					'idne' 				=> $master,
					'kdsatker' 			=> $kdsatker,
					'kdanak' 			=> $kdanak,
					'kdsubanak' 		=> $kdsubanak,
					'bulan' 			=> $bulan,
					'tahun' 			=> $tahun,
					'nogaji' 			=> $nogaji,
					'kdjns' 			=> $kdjns,
					'nip' 				=> $nip,
					'nmpeg' 			=> $nmpeg,
					'kdduduk' 			=> $kdduduk,
					'golongan' 			=> $golongan,
					'kdgol' 			=> $kdgol,
					'pangkat' 			=> $pangkat,
					'npwp' 				=> $npwp,
					'nmrek' 			=> $nmrek,
					'nm_bank' 			=> $nm_bank,
					'rekening' 			=> $rekening,
					'kdbankspan' 		=> $kdbankspan,
					'nmbankspan' 		=> $nmbankspan,
					'kdpos' 			=> $kdpos,
					'kdnegara' 			=> $kdnegara,
					'kdkppn' 			=> $kdkppn,
					'tipesup' 			=> $tipesup,
					'gjpokok' 			=> $gjpokok,
					'tjistri' 			=> $tjistri,
					'tjanak' 			=> $tjanak,
					'tjupns' 			=> $tjupns,
					'tjstruk' 			=> $tjstruk,
					'tjfungs' 			=> $tjfungs,
					'tjdaerah' 			=> $tjdaerah,
					'tjpencil' 			=> $tjpencil,
					'tjlain' 			=> $tjlain,
					'tjkompen' 			=> $tjkompen,
					'pembul' 			=> $pembul,
					'tjberas' 			=> $tjberas,
					'tjpph' 			=> $tjpph,
					'potpfkbul' 		=> $potpfkbul,
					'potpfk2' 			=> $potpfk2,
					'potpfk10' 			=> $potpfk10,
					'potpph' 			=> $potpph,
					'potswrum' 			=> $potswrum,
					'potkelbtj' 		=> $potkelbtj,
					'potlain' 			=> $potlain,
					'pottabrum' 		=> $pottabrum,
					'bersih' 			=> $bersih,
					'sandi' 			=> $sandi,
					'kdkawin' 			=> $kdkawin,
					'kdjab' 			=> $kdjab,
				);
				$nomer++;
			}
		}
		
		echo json_encode($arrgaji);
	}
	public function viewDosen() {
		$ppabp 	= 	Ppabp::orderBy('id')->get();

		$data 	= 	[];
		$data['ppabp'] 		= 	$ppabp;

		return view('admin.keuangan.dosen', $data);
	}
	public function viewUsergaji() {
		$norek			= '';
		$idpeg			= 0;
		$cceknip		= User::where('username', Session('username'))->first();
		if (isset($cceknip->nip)){
			$getdatapeg			= Simpegpegawai::where('id', $cceknip->nip)->first();
			if (isset($getdatapeg->nip_baru)){ $nip = $getdatapeg->nip_baru; } else { $nip = time(); }
			if (isset($getdatapeg->unit_kerja)){ $unitkerja = $getdatapeg->unit_kerja; } else { $unitkerja = ''; }
			if (isset($getdatapeg->jabatan)){ $jabatan = $getdatapeg->jabatan; } else { $jabatan = ''; }
			if (isset($getdatapeg->golongan)){ $golongan = $getdatapeg->golongan; } else { $golongan = ''; }
			$ceknip 			= PegawaiKeuangan::where('nip', $nip)->first();
			if (isset($ceknip->idpeg)){
				$idpeg			= $ceknip->idpeg;
			} else {
				$nip_baru = $nip;
				if (isset($getdatapeg->norek)){
					$norek = $getdatapeg->norek;
				} else { $norek = ''; }
				if (isset($getdatapeg->jenis_kelamin)){
					$jenis_kelamin = $getdatapeg->jenis_kelamin;
				} else { $jenis_kelamin = ''; }
				if (isset($getdatapeg->nik)){
					$nik = $getdatapeg->nik;
				} else { $nik = ''; }
				if (isset($getdatapeg->nokk)){
					$nokk = $getdatapeg->nokk;
				} else { $nokk = ''; }
				if (isset($getdatapeg->nama_lengkap)){
					$nama_lengkap = $getdatapeg->nama_lengkap;
				} else { $nama_lengkap = $cceknip->nama; }
				if (isset($getdatapeg->gajisesuaisk)){
					$gajisesuaisk = $getdatapeg->gajisesuaisk;
				} else { $gajisesuaisk = ''; }
				if (isset($getdatapeg->ppabp)){
					$ppabp = $getdatapeg->ppabp;
				} else { $ppabp = ''; }
				
				if (is_null($norek) OR $norek == ''){
					$norek = time();
				}
				if ($jenis_kelamin != '' AND $nik != '' AND $nokk != '' AND $nama_lengkap != '' and $nip_baru != '' and $gajisesuaisk != '' and $norek != '' and $ppabp != ''){
					$mekso = PegawaiKeuangan::create([
						'jenispeg' 			=> 	$getdatapeg->jenispeg,
						'fungsional' 		=> 	$getdatapeg->fungsional,
						'nik' 				=> 	$nik,
						'nokk' 				=> 	$nokk,
						'nip' 				=> 	$nip_baru,
						'nama' 				=> 	$nama_lengkap,
						'tgllahir' 			=> 	$getdatapeg->tgl_lahir,
						'kelamin' 			=> 	$jenis_kelamin,
						'golongan' 			=> 	$getdatapeg->golongan,
						'namabank' 			=> 	$getdatapeg->namabank,
						'norek' 			=> 	$norek,
						'namapdrekening' 	=> 	$getdatapeg->namapdrekening,
						'gajisesuaisk' 		=> 	$gajisesuaisk,
						'gajibarublmsk' 	=> 	$getdatapeg->gajibarublmmsk,
						'statuspegawai' 	=> 	$getdatapeg->status_pegawai,
						'kategorigaji' 		=> 	$getdatapeg->kategorigaji,
						'tjistri' 			=> 	$getdatapeg->tjistri,
						'tjanak' 			=> 	$getdatapeg->tjanak,
						'tjupns' 			=> 	$getdatapeg->tjupns,
						'tjstruk' 			=> 	$getdatapeg->tjstruk,
						'tjfungs' 			=> 	$getdatapeg->tjfungs,
						'tjdaerah' 			=> 	$getdatapeg->tjdaerah,
						'tjpencil' 			=> 	$getdatapeg->tjpencil,
						'tjlain' 			=> 	$getdatapeg->tjlain,
						'tjkompen' 			=> 	$getdatapeg->tjkompen,
						'pembul' 			=> 	$getdatapeg->pembul,
						'tjberas' 			=> 	$getdatapeg->tjberas,
						'tjpph' 			=> 	$getdatapeg->tjpph,
						'potpfkbul' 		=> 	$getdatapeg->potpfkbul,
						'potpfk2' 			=> 	$getdatapeg->potpfk2,
						'potpfk10' 			=> 	$getdatapeg->potpfk10,
						'potpph' 			=> 	$getdatapeg->potpph,
						'potswrum' 			=> 	$getdatapeg->potswrum,
						'potkelbtj' 		=> 	$getdatapeg->potkelbtj,
						'potlain' 			=> 	$getdatapeg->potlain,
						'pottabrum' 		=> 	$getdatapeg->pottabrum,
						'npwp' 				=> 	$getdatapeg->npwp,
						'statusnpwp' 		=> 	'1100',
						'status' 			=> 	$getdatapeg->status_jabatan,
						'keterangan' 		=> 	$getdatapeg->unit_kerja,
						'alamat' 			=> 	$getdatapeg->alamat,
						'foto' 				=> 	$getdatapeg->foto,
						'tmtgaji' 			=> 	$getdatapeg->tmtgaji,
						'tmtpangkat' 		=> 	$getdatapeg->tmtpangkat,
						'ppabp' 			=> 	$ppabp
					]);
					$idpeg = $mekso->id;
				}
			}
			$data 					= [];
			$countmailbox 			= Penerimasurat::where('idpegawai', $idpeg)->where('status', 'send')->count();
			$data['countmailbox']   = $countmailbox;
			$data['iduser']			= $idpeg;
			$data['alltahun'] 		= Report::orderBy('tahun')->groupBy('tahun')->get();
			return view('admin.keuangan.gajiuser', $data);	
		} else {
			$nip 				= '';
			$data				= [];
			$golongan 			= Golongan::orderBy('id', 'ASC')->get();
			$data['fakultass'] 	= User::whereNotIn('fakultas', ['KP', 'XX', 'Safehouse'])->orderBy('fakpanjang', 'ASC')->groupBy('fakultas')->get();
			$data['golongan'] 	= $golongan;
			$data['semula'] 	= 'gajiuser';
			return view('anyari', $data);
		}
	}
	public function viewSetting() {
		if (Session('spesial') == 'Bendahara Gaji' OR Session('previlage') == 'developer' OR Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik'){
			$mppabp 	= Session('fakpanjang');
			if ($mppabp == '' OR Session('fakpanjang') == null){
				$mppabp = Session('subsubdomainapps01');
			}
			$beras 		= 0;
			$sutri		= 0;
			$anak1		= 0;
			$anak2		= 0;
			$idberas 	= 0;
			$idsutri	= 0;
			$idanak1	= 0;
			$idanak2	= 0;
			$sql 	= SettingKeuangan::where('ppabp', $mppabp)->get();
			foreach ($sql as $hinboxread){
				$jenis = $hinboxread['jenis'];
				if ($jenis == 'sutri'){ $sutri = $hinboxread->isi1; $idsutri = $hinboxread->id; }
				if ($jenis == 'beras'){ $beras = $hinboxread->isi1; $idberas = $hinboxread->id; }
				if ($jenis == '1anak'){ $anak1 = $hinboxread->isi1; $idanak1 = $hinboxread->id; }
				if ($jenis == '2anak'){ $anak2 = $hinboxread->isi1; $idanak2 = $hinboxread->id; }
			}
	
			$data 				= 	[];
			$data['sutri'] 		= 	$sutri;
			$data['beras'] 		= 	$beras;
			$data['anak1'] 		= 	$anak1;
			$data['anak2'] 		= 	$anak2;
			$data['idsutri'] 	= 	$idsutri;
			$data['idberas'] 	= 	$idberas;
			$data['idanak1'] 	= 	$idanak1;
			$data['idanak2'] 	= 	$idanak2;
	
			return view('admin.keuangan.setting', $data);
		} else {
			$data['alasan'] = 'Mohon Menghubungi PSIK untuk menambah hak akses ke halaman ini';
			return view('gakboleh', $data);	
		}
	}
	public function datajGajiPegawai() {
		$cceknip		= User::where('username', Session('username'))->first();
		if (isset($cceknip->nip)){
			$getdatapeg			= Simpegpegawai::where('id', $cceknip->nip)->first();
			if (isset($getdatapeg->nip_baru)){ $nip = $getdatapeg->nip_baru; } else { $nip = ''; }
			if (isset($getdatapeg->unit_kerja)){ $unitkerja = $getdatapeg->unit_kerja; } else { $unitkerja = ''; }
			if (isset($getdatapeg->jabatan)){ $jabatan = $getdatapeg->jabatan; } else { $jabatan = ''; }
			if (isset($getdatapeg->golongan)){ $golongan = $getdatapeg->golongan; } else { $golongan = ''; }
			$ceknip 			= PegawaiKeuangan::where('nip', $nip)->first();
			if (isset($ceknip->idpeg)){
				$idpeg			= $ceknip->idpeg;
			} else { $idpeg = 0; }
		} else { $idpeg = 0; }
		$arrgaji = [];
		$qdatablnan = 	Report::where('idpeg', $idpeg)->where('open', '1')->orderBy('tahun', 'DESC')->orderBy('bulan', 'DESC')->get();
		if (!empty($qdatablnan)){
			foreach ($qdatablnan as $rbulanan) {
				$bulan			= $rbulanan->bulan;
				$tahun			= $rbulanan->tahun;
				$jenispeg		= $rbulanan->jenispeg;
				$idpeg			= $rbulanan->idpeg;
				$nomgaji		= $rbulanan->gajisesuaisk;
				$kdgol			= $rbulanan->golongan;
				$tjberas		= $rbulanan->tjberas;
				$tjistri		= $rbulanan->tjistri;
				$tjanak			= $rbulanan->tjanak;
				$tjupns			= $rbulanan->tjupns;
				$tjstruk		= $rbulanan->tjstruk;
				$tjfungs		= $rbulanan->tjfungs;
				$tjdaerah		= $rbulanan->tjdaerah;
				$tjpencil		= $rbulanan->tjpencil;
				$tjlain			= $rbulanan->tjlain;
				$tjkompen		= $rbulanan->tjkompen;
				$tjpph			= $rbulanan->tjpph;
				$pembul			= $rbulanan->pembul;

				$tabukp			= $rbulanan->tabukp;
				$potpfkbul		= $rbulanan->potpfkbul;
				$potpfk2		= $rbulanan->potpfk2;
				$potpfk10		= $rbulanan->potpfk10;
				$potpph			= $rbulanan->potpph;
				$potswrum		= $rbulanan->potswrum;
				$potkelbtj		= $rbulanan->potkelbtj;
				$potlain		= $rbulanan->potlain;
				$pottabrum		= $rbulanan->pottabrum;
				$kpri			= $rbulanan->kpri;
				$arisan			= $rbulanan->arisan;
				$sumbangan		= $rbulanan->sumbangan;
				$bpjsbpu		= $rbulanan->bpjsbpu;
				$bpjskes		= $rbulanan->bpjskes;
				$bpjsket		= $rbulanan->bpjsket;
				$korpri			= $rbulanan->korpri;
				$dewe			= $rbulanan->dewe;

				$bankkpri		= $rbulanan->bankkpri;
				$bankukp		= $rbulanan->bankukp;
				$bni			= $rbulanan->bni;
				$mandiri		= $rbulanan->mandiri;
				$brisuhat		= $rbulanan->brisuhat;
				$briub			= $rbulanan->briub;
				$jatim			= $rbulanan->jatim;
				$btpn			= $rbulanan->btpn;
				$btn			= $rbulanan->btn;
				$uangmakan		= $rbulanan->uangmakan;
				$insentif		= $rbulanan->insentif;
				$potuangmakan	= $rbulanan->potuangmakan;
				$potinsentif	= $rbulanan->potinsentif;
				
				$terimainsentif	= $insentif - $potinsentif;
				$terimauangmakan= $uangmakan - $potuangmakan;
				
				$tottunjangan	= $tjberas + $tjistri + $tjanak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
				$totpotwjb		= $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum;
				$totpotrutin	= $kpri + $korpri + $arisan + $dewe + $sumbangan + $tabukp + $bpjsbpu + $bpjsket;
				$pinjbank		= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn;
				$pinjbank		= round($pinjbank, 0);
				$totpotbpjs		= $bpjskes;
				$totpinjaman	= $pinjbank + $bankkpri + $bankukp;
				$gajikotor		= $nomgaji + $tottunjangan;
				$gajidlmdft		= $gajikotor - $totpotbpjs;
				$gajigpp		= $gajikotor - $totpotwjb;
				$totpotongan	= $totpotrutin + $totpinjaman + $totpotwjb;
				$totbayar		= $gajidlmdft - $totpotongan;
				if ($totbayar < 0) { $hutang = $totbayar; $totbayar = 0; }
				else { $hutang = ''; }
				$tlsbln			= $bulan;
				$tlstahun 		= $tahun;
				
				$arrgaji[] = array(
					'idpeg' 		=> $rbulanan->idpeg,
					'bulan' 		=> $tlsbln,
					'tahun' 		=> $tlstahun,
					'gaji'			=> $totbayar
				);
			}
		}
		echo json_encode($arrgaji);
	}
	public function getDatajsetting() {
		$mppabp 	= Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		$arraysurat = [];
		$sql        = SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hasil) {
			$arraysurat[] = array(
				'id' 		=> $hasil->id,	
				'jenis' 	=> $hasil->jenis,		
				'isi1' 		=> $hasil->isi1,
				'isi2' 		=> $hasil->isi2,
			);
		}
		
		echo json_encode($arraysurat);
	}
	public function exSettunjangan(Request $request) {
		$anak1	= (int)$request->input('val01');
		$anak2	= (int)$request->input('val02');
		$beras	= $request->input('val03');
		$sutri	= (int)$request->input('val04');
		$beras 	= str_replace(',','',$beras);
		$beras	= (int)$beras;
		$idberas= $request->input('val05');
		$idsutri= $request->input('val06');
		$idanak1= $request->input('val07');
		$idanak2= $request->input('val08');

		SettingKeuangan::where('id', $idsutri)->update(['isi1' => $sutri]);
		SettingKeuangan::where('id', $idberas)->update(['isi1' => $beras]);
		SettingKeuangan::where('id', $idanak1)->update(['isi1' => $anak1]);
		SettingKeuangan::where('id', $idanak2)->update(['isi1' => $anak2]);

		return response()->json(['status' => 'success', 'message' => 'Set Tunjangan Berhasil']);
	}
	public function exSetting(Request $request) {
		$idne	= $request->input('val01');
		$value	= $request->input('val02');

		SettingKeuangan::where('id', $idne)->update(['isi1' => $value]);

		return response()->json(['status' => 'success', 'message' => 'Update Tunjangan Berhasil']);
	}
	public function viewEspete() {
		return view('admin.keuangan.espete');
	}
	public function masterPenduduk(Request $request) {
		$mppabp 	= 	Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		$arraysurat	= [];
		$sql    = DB::table('duidevco_masjid.pegawai as pegawai')
						->leftJoin('duidevco_masjid.potonganrutin as potonganrutin', 'pegawai.idpeg', 'potonganrutin.idpeg')
						->select('pegawai.*', 'potonganrutin.kpri', 'potonganrutin.ukp', 'potonganrutin.korpri', 'potonganrutin.arisan', 'potonganrutin.idw', 'potonganrutin.sumbangan', 'potonganrutin.bpjsbpu', 'potonganrutin.bpjsketenagakerjaan', 'potonganrutin.bpjsppnpn')
						->where('pegawai.ppabp', $mppabp)
						->orderBy('pegawai.jenispeg', 'ASC')
						->orderBy('pegawai.nama', 'ASC')
						->get();
						
		foreach ($sql as $hasil) {
			$idpeg		= $hasil->idpeg;
			$nik		= $hasil->nik;
			$jenispeg	= $hasil->jenispeg;
			$nomgaji	= $hasil->gajisesuaisk;
			$cekstat	= $hasil->statuspegawai;	
			$katgaji	= $hasil->kategorigaji;
			$tunjberas	= $hasil->tjberas;
			$tunjsutri	= $hasil->tjistri;
			$tunjanak	= $hasil->tjanak;
			$tunjstruk	= $hasil->tjstruk;
			$tunjupns	= $hasil->tjupns;
			$tunjfung	= $hasil->tjfungs;
			$tjdaerah	= $hasil->tjdaerah;
			$tjpencil	= $hasil->tjpencil;
			$tjlain		= $hasil->tjlain;
			$tjkompen	= $hasil->tjkompen;
			$pembul		= $hasil->pembul;
			$tjpph		= $hasil->tjpph;
			$potpfkbul	= $hasil->potpfkbul;
			$potpfk2	= $hasil->potpfk2;
			$potpfk10	= $hasil->potpfk10;
			$potpph		= $hasil->potpph;
			$potswrum	= $hasil->potswrum;
			$potkelbtj	= $hasil->potkelbtj;
			$potlain	= $hasil->potlain;
			$pottabrum	= $hasil->pottabrum;	
			$status		= $hasil->status;
			$kdgol		= $hasil->golongan;
			$ppabp		= $hasil->ppabp;
			if (is_null($hasil->nrk)){
				PegawaiKeuangan::where('id', $hasil->id)->update([
					'nrk'	=> $hasil->nip
				]);
			}
			if (isset($hasil->ukp)){
				$ukp = $hasil->ukp;
			} else { $ukp = 0; }
			if (isset($hasil->kpri)){
				$kpri = $hasil->kpri;
			} else { $kpri = 0; }
			if (isset($hasil->arisan)){
				$arisan = $hasil->arisan;
			} else { $arisan = 0; }
			if (isset($hasil->sumbangan)){
				$sumbangan = $hasil->sumbangan;
			} else { $sumbangan = 0; }
			if (isset($hasil->bpjsbpu)){
				$bpjsbpu = $hasil->bpjsbpu;
			} else { $bpjsbpu = 0; }
			if (isset($hasil->bpjsppnpn)){
				$bpjskes = $hasil->bpjsppnpn;
			} else { $bpjskes = 0; }
			if (isset($hasil->bpjsketenagakerjaan)){
				$bpjsket = $hasil->bpjsketenagakerjaan;
			} else { $bpjsket = 0; }
			if ($jenispeg == 'PNPN_BOPTN' OR $jenispeg == 'PNS'){
				if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $korpri = 4000; }
				else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $korpri = 3000; }
				else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $korpri = 2000; }
				else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $korpri = 1000; }
				else { $korpri = 1000; }
			}else { $korpri = 1000; }
			if ($jenispeg == 'PNS'){
				if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $dewe = 4000; }
				else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $dewe = 3000; }
				else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $dewe = 2000; }
				else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $dewe = 1000; }
				else { $dewe = 1000; }
			}else { $dewe = 0; }
			
			if ($status == 1){ 
				$tlsstatus = 'Aktif'; 
			} else { $tlsstatus = '<span class="label label-danger label-block">Tidak Aktif</span>'; }
		
			$tothutang	= 0;
			$cek 	= 	RekapPinjaman::select(DB::Raw('SUM(nominal) as nominal'))->where('idpeg', $idpeg)->groupBy('idpeg')->count();
			if ($cek > 0) {
				$jcekhutang	= 	RekapPinjaman::select(DB::Raw('SUM(nominal) as nominal'))->where('idpeg', $idpeg)->groupBy('idpeg')->first();
				$tothutang	= 	$jcekhutang->nominal;
			}
			
			$tottunjangan 	= $tunjberas + $tunjsutri + $tunjanak + $tunjupns + $tunjstruk + $tunjfung + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
			$kotor 			= $nomgaji + $tottunjangan;
			$totpotongan	= $kpri + $ukp + $korpri + $arisan + $dewe + $sumbangan + $bpjsbpu + $bpjskes + $bpjsket + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum;
			$gajibersih		= $kotor - $totpotongan - $tothutang;

			$cek 	= Upah::where('nik', $nik)->count();
			if ($cek != 0){
				$jbpjsket	= Upah::where('nik', $nik)->first();
				$kpj	= $jbpjsket->kpj;
				$kodetk	= $jbpjsket->kodetk;
				$npp	= $jbpjsket->npp;
			}else {
				$kpj	= '';
				$kodetk	= '';
				$npp	= '';
			}
			$arraysurat[] = array(
				'id' 			=> $idpeg,	
				'jenispeg' 		=> $hasil->jenispeg,
				'fungsional' 	=> $hasil->fungsional,
				'jabfungsional' => $hasil->jabfungsional,
				'nik' 			=> $hasil->nik,
				'nokk' 			=> $hasil->nokk,
				'nip' 			=> $hasil->nip,
				'nama' 			=> $hasil->nama,
				'kelamin' 		=> $hasil->kelamin,
				'tgllahir' 		=> $hasil->tgllahir,
				'golongan' 		=> $kdgol,
				'namabank' 		=> $hasil->namabank,
				'norek' 		=> $hasil->norek,
				'namapdrekening'=> $hasil->namapdrekening,
				'gaji' 			=> $nomgaji,		
				'statuspegawai'	=> $hasil->statuspegawai,
				'kategorigaji' 	=> $hasil->kategorigaji,		
				'npwp' 			=> $hasil->npwp,
				'statusnpwp' 	=> $hasil->statusnpwp,
				'status' 		=> $hasil->status,
				'tlsstatus' 	=> $tlsstatus,
				'keterangan' 	=> $hasil->keterangan,
				'alamat' 		=> $hasil->alamat,
				'foto' 			=> $hasil->foto,
				'tunjberas' 	=> $tunjberas,
				'tunjsutri' 	=> $tunjsutri,
				'tunjanak' 		=> $tunjanak,
				'tunjupns' 		=> $tunjupns,
				'tunjstruk' 	=> $tunjstruk,
				'tunjfung' 		=> $tunjfung,
				'tjdaerah' 		=> $tjdaerah,
				'tjpencil' 		=> $tjpencil,
				'tjlain' 		=> $tjlain,
				'tjkompen' 		=> $tjkompen,
				'pembul' 		=> $pembul,
				'tjpph' 		=> $tjpph,
				'tottunjangan' 	=> $tottunjangan,
				'kotor' 		=> $kotor,
				'kpri' 			=> $kpri,
				'ukp' 			=> $ukp,
				'korpri' 		=> $korpri,
				'arisan' 		=> $arisan,
				'dewe' 			=> $dewe,
				'sumbangan' 	=> $sumbangan,
				'bpjskes' 		=> $bpjskes,
				'bpjsbu' 		=> $bpjsbpu,
				'bpjsket' 		=> $bpjsket,
				'potpfkbul' 	=> $potpfkbul,
				'potpfk2' 		=> $potpfk2,
				'potpfk10' 		=> $potpfk10,
				'potpph' 		=> $potpph,
				'potswrum' 		=> $potswrum,
				'potkelbtj' 	=> $potkelbtj,
				'potlain' 		=> $potlain,
				'pottabrum' 	=> $pottabrum,
				'totpotongan' 	=> $totpotongan,
				'tothutang' 	=> $tothutang,
				'gajibersih' 	=> $gajibersih,
				'ppabp' 		=> $ppabp,
				'kodetk' 		=> $kodetk,
				'kpj' 			=> $kpj,
				'npp' 			=> $npp,
			);
		}
		echo json_encode($arraysurat);
	}
	public function cetakFormpajak(Request $request) {
		$mppabp 	= 	Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		$valset1	= '';
		$valset2	= '';
		$valset3	= '';
		$valset4	= '';
		$valset5	= '';
		$valset6	= 0;
		$valset7	= 0;
		$valset8	= 0;
		$valset9	= 0;
		$valset10	= 0;
		$valset11	= 0;
		$valset12	= 0;
		$valset13	= 0;
		$sberas		= 0;
		$sql 		= SettingKeuangan::where('ppabp', $mppabp)->get();
		foreach ($sql as $hinboxread) {
			$idsetting = $hinboxread->jenis;
			if ($idsetting == 'beras'){ $sberas = $hinboxread->isi1; }
			if ($idsetting == 'NAMA INSTANSI'){ $valset1 = $hinboxread->isi1; }
			if ($idsetting == 'NPWP BENDAHARA'){ $valset2 = $hinboxread->isi1; }
			if ($idsetting == 'NAMA BENDAHARA'){ $valset3 = $hinboxread->isi1; }
			if ($idsetting == 'ALAMAT BENDAHARA'){ $valset4 = $hinboxread->isi1; }
			if ($idsetting == 'NIP BENDAHARA'){ $valset5 = $hinboxread->isi1; }
			if ($idsetting == 'TIDAK KAWIN'){ $valset6 = $hinboxread->isi1; }
			if ($idsetting == 'JANDA/DUDA 1 ANAK'){ $valset7 = $hinboxread->isi1; }
			if ($idsetting == 'JANDA/DUDA 2 ANAK'){ $valset8 = $hinboxread->isi1; }
			if ($idsetting == 'JANDA/DUDA 3 ANAK'){ $valset9 = $hinboxread->isi1; }
			if ($idsetting == 'KAWIN TANPA ANAK'){ $valset10 = $hinboxread->isi1; }
			if ($idsetting == 'KAWIN 1 ANAK'){ $valset11 = $hinboxread->isi1; }
			if ($idsetting == 'KAWIN 2 ANAK'){ $valset12 = $hinboxread->isi1; }
			if ($idsetting == 'KAWIN 3 ANAK'){ $valset13 = $hinboxread->isi1; }
		}
			
		$arrvalset2	= str_split($valset2);
		$dd 		= date("d");
		$mm 		= date("m");
		$yy 		= date("Y");
		$mthiki 	= (int)date("m");
		$tglcetak 	= $yy.'-'.$mm.'-'.$dd;
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$blniki 	= $bulanlist[$mthiki];
		$sakiki 	= $dd.' '.$blniki.' '.$yy;
		$gajikotor	= $request->input('val02');
		$tahun		= $request->input('val03');
		$idpeg		= $request->input('val01');
		
		$rcekidpeg  = PegawaiKeuangan::where('idpeg', $idpeg)->first();
		if (isset($rcekidpeg->nama)){
			$nama		= $rcekidpeg->nama;
			$nip		= $rcekidpeg->nip;
			$statpeg	= $rcekidpeg->statuspegawai;
			$penempatan	= $rcekidpeg->keterangan;
			$npwp		= $rcekidpeg->npwp;
			$alamat		= $rcekidpeg->alamat;
			$fungsional	= $rcekidpeg->fungsional;
			$kelamin	= $rcekidpeg->kelamin;
			$jenispeg	= $rcekidpeg->jenispeg;
			$kdgol		= $rcekidpeg->golongan;
			$kdkawin	= $rcekidpeg->kategorigaji;
			$bank		= $rcekidpeg->namabank;
			$norek		= $rcekidpeg->norek;
			$namapdbank	= $rcekidpeg->namapdrekening;
			$keterangan	= $rcekidpeg->keterangan;
			$golongan	= '-';
			$pangkat	= '-';
			$arrkatgj 	= str_split($kdkawin);
			if (isset($arrkatgj[1])){
				$ceknikah	= $arrkatgj[0].$arrkatgj[1];
			} else {
				$ceknikah	= '10';
			}
			$setanak1	= '';
			$setanak2	= '';
			$setanak3	= '';
			if ($ceknikah == '11'){
				$setkawin1	= 'X';
				$setkawin2 	= '&nbsp;';
				if ($arrkatgj[3] == 0){
					$ptkp 	= $valset10;
				}
				else {
					if ($arrkatgj[3] == 1){ $ptkp = $valset11; }
					else if ($arrkatgj[3] == 2){ $ptkp = $valset12; }
					else { $ptkp = $valset13; }
					$setanak1	= $arrkatgj[3];
					$setanak2	= '';
					$setanak3	= '';
				}
			}
			else {
				$setkawin2 = 'X';
				$setkawin1 = '&nbsp;';
				if (isset($arrkatgj[3])){
					if ($arrkatgj[3] == 0){
						$ptkp 	 = $valset6;
					} else {
						if ($arrkatgj[3] == 1){ $ptkp = $valset7; }
						else if ($arrkatgj[3] == 2){ $ptkp = $valset8; }
						else { $ptkp = $valset9; }
						$setanak2	= $arrkatgj[3];
						$setanak1	= '';
						$setanak3	= '';
					}
				} else {
					$ptkp 	= $valset6;
				}
			}

			if ($kelamin == 'Laki-Laki'){
				$setkelamin1 = 'X';
				$setkelamin2 = '&nbsp;';
			}
			else {
				$setkelamin2 = 'X';
				$setkelamin1 = '&nbsp;';
			}
			$rcekjabatan= Golongan::where('kode', $kdgol)->first();
			if (isset($rcekjabatan->golongan)) {
				$golongan	= $rcekjabatan->golongan;
				$pangkat	= $rcekjabatan->pangkat;
			}
			
			$sutri		= 0;
			$anak		= 0;
			$beras		= 0;
			$kpri		= 0;
			$korpri		= 0;
			$tabukp		= 0;
			$bank		= 0;
			$arisan		= 0;
			$idewe		= 0;
			$sumbangan	= 0;
			$bpjskes	= 0;
			$bpjsbu		= 0;
			$bpjsket	= 0;
			$pinjkpri	= 0;
			$pinjukp	= 0;
			$pinjbank	= 0;
			$uangmakan	= 0;
			$bulamulai	= 0;
			$bulanakhir	= 0;
			$jumlahbln	= 0;
			$netsetahun	= 0;
			$totpotrutin= 0;
			$setbruto	= 0;
			$tjupns		= 0;
			$tjstruk	= 0;
			$tjfungs	= 0;
			$tjdaerah	= 0;
			$tjpencil	= 0;
			$tjlain		= 0;
			$tjkhusus	= 0;
			$setprofesi	= 0;
			$tjkompen	= 0;
			$pembul		= 0;
			$tjberas	= 0;
			$tjpph		= 0;
			$potlain	= 0;
			// tambahan
			$gapok 			= 0;
			$potpfkbul		= 0;
			$potpfk2		= 0;
			$potpfk10		= 0;
			$potpph			= 0;
			$potswrum		= 0;
			$potkelbtj		= 0;
			$potlain		= 0;
			$pottabrum		= 0;
			$ptkp 			= 0;
			$gajibersih		= 0;
			$jdetail  	= Report::where('tahun', $tahun)->where('idpeg', $idpeg)->orderBy('bulan', 'ASC')->get();
			foreach ($jdetail as $rbulanan) {
				$bulanakhir 	= $rbulanan->bulan;
				if ($bulamulai == ''){ $bulamulai = $bulanakhir; }
				$jumlahbln++;
				$gapok			= $rbulanan->gajisesuaisk;
				$beras			= $rbulanan->tjberas;
				$sutri			= $rbulanan->tjistri;
				$anak			= $rbulanan->tjanak;
				$tjupns			= $rbulanan->tjupns;
				$tjstruk		= $rbulanan->tjstruk;
				$tjfungs		= $rbulanan->tjfungs;
				$tjdaerah		= $rbulanan->tjdaerah;
				$tjpencil		= $rbulanan->tjpencil;
				$tjlain			= $rbulanan->tjlain;
				$tjkompen		= $rbulanan->tjkompen;
				$tjpph			= $rbulanan->tjpph;
				$pembul			= $rbulanan->pembul;
			
				$tabukp			= $rbulanan->tabukp;
				$potpfkbul		= $rbulanan->potpfkbul;
				$potpfk2		= $rbulanan->potpfk2;
				$potpfk10		= $rbulanan->potpfk10;
				$potpph			= $rbulanan->potpph;
				$potswrum		= $rbulanan->potswrum;
				$potkelbtj		= $rbulanan->potkelbtj;
				$potlain		= $rbulanan->potlain;
				$pottabrum		= $rbulanan->pottabrum;
				$kpri			= $rbulanan->kpri;
				$arisan			= $rbulanan->arisan;
				$sumbangan		= $rbulanan->sumbangan;
				$bpjsbu			= $rbulanan->bpjsbpu;
				$bpjskes		= $rbulanan->bpjskes;
				$bpjsket		= $rbulanan->bpjsket;
				$korpri			= $rbulanan->korpri;
				$idewe			= $rbulanan->dewe;
			
				$pinjkpri		= $rbulanan->bankkpri;
				$pinjukp		= $rbulanan->bankukp;
				$bni			= $rbulanan->bni;
				$mandiri		= $rbulanan->mandiri;
				$brisuhat		= $rbulanan->brisuhat;
				$briub			= $rbulanan->briub;
				$jatim			= $rbulanan->jatim;
				$btpn			= $rbulanan->btpn;
				$btn			= $rbulanan->btn;
				
				$uangmakan		= $rbulanan->uangmakan;
				$insentif		= $rbulanan->insentif;
				$potuangmakan	= $rbulanan->potuangmakan;
				$potinsentif	= $rbulanan->potinsentif;
			
				$totpotrutin	= $kpri + $korpri + $arisan + $idewe + $sumbangan + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $potlain + $pottabrum + $tabukp + $bpjsbu + $bpjskes + $bpjsket;
				$totpinjaman	= $bni + $mandiri + $brisuhat + $briub + $jatim + $btpn + $btn + $pinjkpri + $pinjukp;
				$tottunjangan	= $beras + $sutri + $anak + $tjupns + $tjstruk + $tjfungs + $tjdaerah + $tjpencil + $tjlain + $tjkompen + $pembul + $tjpph;
				$gajikotor		= $gapok + $tottunjangan;	
				$gajibersih		= $gajikotor - $totpinjaman - $totpotrutin;
				$netsetahun		= $netsetahun + $gajibersih;
				$setbruto		= $setbruto + $gajikotor;
			}
			
			$totgajitunj	= $gapok + $sutri + $anak;
			$setprofesi		= $tjfungs + $tjstruk;
			$tjkhusus		= $tjdaerah + $tjpencil + $tjkompen;
			$setbruto		= $totgajitunj + $tjpph + $setprofesi + $beras + $tjkhusus + $tjlain;

			$biayajabatan	= $potlain + $potpfkbul + $potpfk2 + $potpfk10 + $potpph + $potswrum + $potkelbtj + $pottabrum;
			$biayapensiun	= 0;
			$totalbiaya		= $biayajabatan + $biayapensiun;
			$setnetto		= $setbruto - $totalbiaya;
			$netsetahun		= $setnetto * 12;

			if ($netsetahun < $ptkp){
				$selisihpajak 	= $ptkp - $netsetahun;
				$pajakthnan		= ($selisihpajak * 5)/100;
				$selisihpajak	= number_format( $selisihpajak, 0 , '.' , ',' );
				$selisihpajak	= '('.$selisihpajak.')';
				$pajakthnan		= number_format( $pajakthnan, 0 , '.' , ',' );
				$pajakthnan		= '('.$pajakthnan.')';
			}
			else {
				$selisihpajak 	= $netsetahun - $ptkp;
				$pajakthnan		= ($selisihpajak * 5)/100;
				$pajakthnan		= number_format( $pajakthnan, 0 , '.' , ',' );
				$selisihpajak	= number_format( $selisihpajak, 0 , '.' , ',' );
			}
			$gapok 			= $gapok * 12;
			$sutri 			= $sutri * 12;
			$anak			= $anak * 12;
			$totgajitunj 	= $totgajitunj * 12;
			$tjpph			= $tjpph * 12;
			$setprofesi		= $setprofesi * 12;
			$beras			= $beras * 12;
			$tjkhusus		= $tjkhusus * 12;
			$tjlain			= $tjlain * 12;
			$setbruto		= $setbruto * 12;
			$biayajabatan	= $biayajabatan * 12;
			$biayapensiun	= $biayapensiun * 12;
			$totalbiaya		= $totalbiaya * 12;
			$setnetto		= $setnetto * 12;
			
			$potlain		= number_format( $potlain, 0 , '.' , ',' );
			$setprofesi		= number_format( $setprofesi, 0 , '.' , ',' );
			$tjlain			= number_format( $tjlain, 0 , '.' , ',' );
			$tjpph			= number_format( $tjpph, 0 , '.' , ',' );
			$tjkhusus		= number_format( $tjkhusus, 0 , '.' , ',' );
			$setbruto		= number_format( $setbruto, 0 , '.' , ',' );
			$netsetahun		= number_format( $netsetahun, 0 , '.' , ',' );
			$totgajitunj	= number_format( $totgajitunj, 0 , '.' , ',' );
			$gapok			= number_format( $gapok, 0 , '.' , ',' );
			$totpotrutin	= number_format( $totpotrutin, 0 , '.' , ',' );
			$gajibersih		= number_format( $gajibersih, 0 , '.' , ',' );
			$sutri			= number_format( $sutri, 0 , '.' , ',' );
			$anak			= number_format( $anak, 0 , '.' , ',' );
			$beras			= number_format( $beras, 0 , '.' , ',' );
			$bpjskes		= number_format( $bpjskes, 0 , '.' , ',' );
			$bpjsbu			= number_format( $bpjsbu, 0 , '.' , ',' );
			$bpjsket		= number_format( $bpjsket, 0 , '.' , ',' );
			$korpri			= number_format( $korpri, 0 , '.' , ',' );
			$tabukp			= number_format( $tabukp, 0 , '.' , ',' );
			$arisan			= number_format( $arisan, 0 , '.' , ',' );
			$kpri			= number_format( $kpri, 0 , '.' , ',' );
			$sumbangan		= number_format( $sumbangan, 0 , '.' , ',' );
			$idewe			= number_format( $idewe, 0 , '.' , ',' );
			$gajikotor		= number_format( $gajikotor, 0 , '.' , ',' );
			$uangmakan		= number_format( $uangmakan, 0 , '.' , ',' );
			$ptkp			= number_format( $ptkp, 0 , '.' , ',' );
			$biayajabatan	= number_format( $biayajabatan, 0 , '.' , ',' );
			$biayapensiun	= number_format( $biayapensiun, 0 , '.' , ',' );
			$totalbiaya		= number_format( $totalbiaya, 0 , '.' , ',' );
			$setnetto		= number_format( $setnetto, 0 , '.' , ',' );
			if ($bulamulai == 1){ $bulamulai = 'JANUARI'; }
			if ($bulamulai == 2){ $bulamulai = 'FEBRUARI'; }
			if ($bulamulai == 3){ $bulamulai = 'MARET'; }
			if ($bulamulai == 4){ $bulamulai = 'APRIL'; }
			if ($bulamulai == 5){ $bulamulai = 'MEI'; }
			if ($bulamulai == 6){ $bulamulai = 'JUNI'; }
			if ($bulamulai == 7){ $bulamulai = 'JULI'; }
			if ($bulamulai == 8){ $bulamulai = 'AGUSTUS'; }
			if ($bulamulai == 9){ $bulamulai = 'SEPTEMBER'; }
			if ($bulamulai == 10){ $bulamulai = 'OKTOBER'; }
			if ($bulamulai == 11){ $bulamulai = 'NOVEMBER'; }
			if ($bulamulai == 12){ $bulamulai = 'DESEMBER'; }
			
			if ($bulanakhir == 1){ $bulanakhir = 'JANUARI'; }
			if ($bulanakhir == 2){ $bulanakhir = 'FEBRUARI'; }
			if ($bulanakhir == 3){ $bulanakhir = 'MARET'; }
			if ($bulanakhir == 4){ $bulanakhir = 'APRIL'; }
			if ($bulanakhir == 5){ $bulanakhir = 'MEI'; }
			if ($bulanakhir == 6){ $bulanakhir = 'JUNI'; }
			if ($bulanakhir == 7){ $bulanakhir = 'JULI'; }
			if ($bulanakhir == 8){ $bulanakhir = 'AGUSTUS'; }
			if ($bulanakhir == 9){ $bulanakhir = 'SEPTEMBER'; }
			if ($bulanakhir == 10){ $bulanakhir = 'OKTOBER'; }
			if ($bulanakhir == 11){ $bulanakhir = 'NOVEMBER'; }
			if ($bulanakhir == 12){ $bulanakhir = 'DESEMBER'; }
			$arrtahun 	= str_split($tahun);
			if (isset($arrtahun[3])){
				$thn1 		= $arrtahun[0];
				$thn2 		= $arrtahun[1];
				$thn3 		= $arrtahun[2];
				$thn4 		= $arrtahun[3];
			} else {
				$thn1 		= 0;
				$thn2 		= 0;
				$thn3 		= 0;
				$thn4 		= 0;
			}
			
			$data 						= 	[];
			$data['arrtahun'] 			= 	$arrtahun;
			$data['valset1'] 			= 	$valset1;
			$data['arrvalset2'] 		= 	$arrvalset2;
			$data['valset3'] 			= 	$valset3;
			$data['valset4'] 			= 	$valset4;
			$data['valset5'] 			= 	$valset5;
			$data['nama'] 				= 	$nama;
			$data['nip'] 				= 	$nip;
			$data['npwp'] 				= 	$npwp;
			$data['alamat'] 			= 	$alamat;
			$data['pangkat'] 			= 	$pangkat;
			$data['golongan'] 			= 	$golongan;
			$data['fungsional'] 		= 	$fungsional;
			$data['setkawin1'] 			= 	$setkawin1;
			$data['setkawin2'] 			= 	$setkawin2;
			$data['setkelamin1'] 		= 	$setkelamin1;
			$data['setkelamin2'] 		= 	$setkelamin2;
			$data['setanak1'] 			= 	$setanak1;
			$data['setanak2'] 			= 	$setanak2;
			$data['setanak3'] 			= 	$setanak3;
			$data['bulamulai'] 			= 	$bulamulai;
			$data['bulanakhir'] 		= 	$bulanakhir;
			$data['tahun'] 				= 	$tahun;
			$data['gapok'] 				= 	$gapok;
			$data['sutri'] 				= 	$sutri;
			$data['anak'] 				= 	$anak;
			$data['totgajitunj'] 		= 	$totgajitunj;
			$data['tjpph'] 				= 	$tjpph;
			$data['setprofesi'] 		= 	$setprofesi;
			$data['beras'] 				=  	$beras;
			$data['tjkhusus'] 			= 	$tjkhusus;
			$data['tjlain'] 			= 	$tjlain;
			$data['biayajabatan'] 		= 	$biayajabatan;
			$data['biayapensiun'] 		= 	$biayapensiun;
			$data['totalbiaya'] 		= 	$totalbiaya;
			$data['setnetto'] 			= 	$setnetto;
			$data['setbruto'] 			= 	$setbruto;
			$data['netsetahun'] 		= 	$netsetahun;
			$data['ptkp'] 				= 	$ptkp;
			$data['selisihpajak'] 		= 	$selisihpajak;
			$data['pajakthnan'] 		= 	$pajakthnan;
			$data['dd'] 				=  	$dd;
			$data['blniki'] 			= 	$blniki;
			$data['yy'] 				= 	$yy;
			
			return view('cetak.keuangan.formpajak', $data);
		} else {
			echo 'Mohon Maaf Fitur Ini Hanya Berlaku Untuk Pegawai Yang Telah Tercatat di SIGAP';
		}
	}
	public function uploadFilegaji(Request $request) {
		$jenis 		= $request->input('jenis');
		$ppabp 		= Session('fakultas');
		if ($ppabp == '' OR Session('fakpanjang') == null){
			$ppabp = Session('subsubdomainapps01');
		}
		$mppabp		= $ppabp;
		$hilangkan 	= array(",", ".", " ");
		if ($jenis == 'spm') {
			$path 			= $_FILES['sheeta']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$setsmt 		= '';
			$setthn			= '';
			$setjen			= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			foreach($getalldata as $val){
				if (isset($val['A'])){$no 			= $val['A'];}else{$no = '';}
				if (isset($val['B'])){$kdsatker  	= $val['B'];}else{$kdsatker = '';}
				if (isset($val['C'])){$kdanak		= $val['C'];}else{$kdanak = '';}
				if (isset($val['D'])){$kdsubanak	= $val['D'];}else{$kdsubanak = '';}
				if (isset($val['E'])){$bulan		= $val['E'];}else{$bulan = '';}
				if (isset($val['F'])){$tahun		= $val['F'];}else{$tahun = '';}
				if (isset($val['G'])){$nogaji		= $val['G'];}else{$nogaji = '';}
				if (isset($val['H'])){$kdjns		= $val['H'];}else{$kdjns = '';}
				if (isset($val['I'])){$nip			= $val['I'];}else{$nip = '';}
				if (isset($val['J'])){$nmpeg		= $val['J'];}else{$nmpeg = '';}
				if (isset($val['K'])){$kdduduk		= $val['K'];}else{$kdduduk = '';}
				if (isset($val['L'])){$kdgol		= $val['L'];}else{$kdgol = '';}
				if (isset($val['M'])){$npwp			= $val['M'];}else{$npwp = '';}
				if (isset($val['N'])){$nmrek		= $val['N'];}else{$nmrek = '';}
				if (isset($val['O'])){$nm_bank		= $val['O'];}else{$nm_bank = '';}
				if (isset($val['P'])){$rekening		= $val['P'];}else{$rekening = '';}
				if (isset($val['Q'])){$kdbankspan	= $val['Q'];}else{$kdbankspan = '';}
				if (isset($val['R'])){$nmbankspan	= $val['R'];}else{$nmbankspan = '';}
				if (isset($val['S'])){$kdpos		= $val['S'];}else{$kdpos = '';}
				if (isset($val['T'])){$kdnegara		= $val['T'];}else{$kdnegara = '';}
				if (isset($val['U'])){$kdkppn		= $val['U'];}else{$kdkppn = '';}
				if (isset($val['V'])){$tipesup		= $val['V'];}else{$tipesup = '';}
				if (isset($val['W'])){$gjpokok		= $val['W'];}else{$gjpokok = '';}
				if (isset($val['X'])){$tjistri		= $val['X'];}else{$tjistri = '';}
				if (isset($val['Y'])){$tjanak		= $val['Y'];}else{$tjanak = '';}
				if (isset($val['Z'])){$tjupns		= $val['Z'];}else{$tjupns = '';}
				if (isset($val['AA'])){$tjstruk		= $val['AA'];}else{$tjstruk = '';}
				if (isset($val['AB'])){$tjfungs		= $val['AB'];}else{$tjfungs = '';}
				if (isset($val['AC'])){$tjdaerah	= $val['AC'];}else{$tjdaerah = '';}
				if (isset($val['AD'])){$tjpencil	= $val['AD'];}else{$tjpencil = '';}
				if (isset($val['AE'])){$tjlain		= $val['AE'];}else{$tjlain = '';}
				if (isset($val['AF'])){$tjkompen	= $val['AF'];}else{$tjkompen = '';}
				if (isset($val['AG'])){$pembul		= $val['AG'];}else{$pembul = '';}
				if (isset($val['AH'])){$tjberas		= $val['AH'];}else{$tjberas = '';}
				if (isset($val['AI'])){$tjpph		= $val['AI'];}else{$tjpph = '';}
				if (isset($val['AJ'])){$potpfkbul	= $val['AJ'];}else{$potpfkbul = '';}
				if (isset($val['AK'])){$potpfk2		= $val['AK'];}else{$potpfk2 = '';}
				if (isset($val['AL'])){$potpfk10	= $val['AL'];}else{$potpfk10 = '';}
				if (isset($val['AM'])){$potpph		= $val['AM'];}else{$potpph = '';}
				if (isset($val['AN'])){$potswrum	= $val['AN'];}else{$potswrum = '';}
				if (isset($val['AO'])){$potkelbtj	= $val['AO'];}else{$potkelbtj = '';}
				if (isset($val['AP'])){$potlain		= $val['AP'];}else{$potlain = '';}
				if (isset($val['AQ'])){$pottabrum	= $val['AQ'];}else{$pottabrum = '';}
				if (isset($val['AR'])){$bersih		= $val['AR'];}else{$bersih = '';}
				if (isset($val['AS'])){$sandi		= $val['AS'];}else{$sandi = '';}
				if (isset($val['AT'])){$kdkawin		= $val['AT'];}else{$kdkawin = '';}
				if (isset($val['AU'])){$kdjab		= $val['AU'];}else{$kdjab = '';}
				if (isset($val['AV'])){$thngj		= $val['AV'];}else{$thngj = '';}
				if (isset($val['AW'])){$kdgapok		= $val['AW'];}else{$kdgapok = '';}
				if (isset($val['AX'])){$bpjs		= $val['AX'];}else{$bpjs = '0';}
				if (isset($val['AY'])){$bpjs2		= $val['AY'];}else{$bpjs2 = '0';}
				if ($no == 'no' OR $no == ''){

				} else {
					$cekmasuk 	= LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->first();
					if (isset($cekmasuk->id)){
						LampiranSpm::where('id', $cekmasuk->id)->delete();
					}
					$input = LampiranSpm::insert([
						'kdsatker' 			=> 	$kdsatker,
						'kdanak' 			=> 	$kdanak,
						'kdsubanak' 		=> 	$kdsubanak,
						'bulan' 			=> 	$bulan,
						'tahun' 			=> 	$tahun,
						'nogaji' 			=> 	$nogaji,
						'kdjns' 			=> 	$kdjns,
						'nip' 				=> 	$nip,
						'nmpeg' 			=> 	$nmpeg,
						'kdduduk' 			=> 	$kdduduk,
						'kdgol' 			=> 	$kdgol,
						'npwp' 				=> 	$npwp,
						'nmrek' 			=> 	$nmrek,
						'nm_bank' 			=> 	$nm_bank,
						'rekening' 			=> 	$rekening,
						'kdbankspan' 		=> 	$kdbankspan,
						'nmbankspan' 		=> 	$nmbankspan,
						'kdpos' 			=> 	$kdpos,
						'kdnegara' 			=> 	$kdnegara,
						'kdkppn' 			=> 	$kdkppn,
						'tipesup' 			=> 	$tipesup,
						'gjpokok' 			=> 	$gjpokok,
						'tjistri' 			=> 	$tjistri,
						'tjanak' 			=> 	$tjanak,
						'tjupns' 			=> 	$tjupns,
						'tjstruk' 			=> 	$tjstruk,
						'tjfungs' 			=> 	$tjfungs,
						'tjdaerah' 			=> 	$tjdaerah,
						'tjpencil' 			=> 	$tjpencil,
						'tjlain' 			=> 	$tjlain,
						'tjkompen' 			=> 	$tjkompen,
						'pembul' 			=> 	$pembul,
						'tjberas' 			=> 	$tjberas,
						'tjpph' 			=> 	$tjpph,
						'potpfkbul' 		=> 	$potpfkbul,
						'potpfk2' 			=> 	$potpfk2,
						'potpfk10' 			=> 	$potpfk10,
						'potpph' 			=> 	$potpph,
						'potswrum' 			=> 	$potswrum,
						'potkelbtj' 		=> 	$potkelbtj,
						'potlain' 			=> 	$potlain,
						'pottabrum' 		=> 	$pottabrum,
						'bersih' 			=> 	$bersih,
						'sandi' 			=> 	$sandi,
						'kdkawin' 			=> 	$kdkawin,
						'kdjab' 			=> 	$kdjab,
						'thngj' 			=> 	$thngj,
						'bpjs' 				=> 	$bpjs,
						'bpjs2' 			=> 	$bpjs2,
						'ppabp' 			=> 	$ppabp,
					]);
					if ($input){ 
						$sukses++;
						$cek 	= PegawaiKeuangan::where('norek', $rekening)->orWhere('nip', $nip)->first();
						if (isset($cek->nama)){
							PegawaiKeuangan::where('nip', $nip)->update([
								'nama' 				=> 	$nmpeg,
								'nip' 				=> 	$nip,
								'golongan' 			=> 	$kdgol,
								'namabank' 			=> 	$nm_bank,
								'norek' 			=> 	$rekening,
								'namapdrekening' 	=> 	$nmrek,
								'gajisesuaisk' 		=> 	$gjpokok,
								'kategorigaji' 		=> 	$kdkawin,
								'tjistri' 			=> 	$tjistri,
								'tjanak' 			=> 	$tjanak,
								'tjupns' 			=> 	$tjupns,
								'tjstruk' 			=> 	$tjstruk,
								'tjfungs' 			=> 	$tjfungs,
								'tjdaerah' 			=> 	$tjdaerah,
								'tjpencil' 			=> 	$tjpencil,
								'tjlain' 			=> 	$tjlain,
								'tjkompen' 			=> 	$tjkompen,
								'pembul' 			=> 	$pembul,
								'tjberas' 			=> 	$tjberas,
								'tjpph' 			=> 	$tjpph,
								'potpfkbul' 		=> 	$potpfkbul,
								'potpfk2' 			=> 	$potpfk2,
								'potpfk10' 			=> 	$potpfk10,
								'potpph' 			=> 	$potpph,
								'potswrum' 			=> 	$potswrum,
								'potkelbtj' 		=> 	$potkelbtj,
								'potlain' 			=> 	$potlain,
								'pottabrum' 		=> 	$pottabrum,
								'npwp' 				=> 	$npwp,
								'statusnpwp' 		=> 	$kdkawin,
								'ppabp' 			=> 	$ppabp
							]);
						} else {
							$idpot2		= 0;
							$kpri		= 0;
							$ukp		= 0;
							$arisan		= 0;
							$sumbangan	= 0;
							$bpjsbu		= 0;
							$bpjskes	= 0;
							$bpjsten	= 0;
							$beras 		= 1;
							$kodetgg	= $kdkawin;
							$aktif		= 1;
							$keterangan = 'Input Otomatis';
							$foto		= '';
							$nik		= '';
							$nokk		= '';
							$statpeg	= '1.0';
							$jenpeg		= 'PNS';
							$npwp 		= '';
							$tgllhari 	= '0000-00-00';
							$fungsional	= 'KEPENDIDIKAN TETAP';
							$kelamin	= '';
							$alamat		= '';
							$foto		= '';
							$status		= '1';
							$mekso 		= PegawaiKeuangan::create([
											'jenispeg' 			=> 	$jenpeg,
											'fungsional' 		=> 	$fungsional,
											'nik' 				=> 	$nik,
											'nokk' 				=> 	$nokk,
											'nip' 				=> 	$nip,
											'nama' 				=> 	$nmpeg,
											'tgllahir' 			=> 	$tgllhari,
											'kelamin' 			=> 	$kelamin,
											'golongan' 			=> 	$kdgol,
											'namabank' 			=> 	$nm_bank,
											'norek' 			=> 	$rekening,
											'namapdrekening' 	=> 	$nmrek,
											'gajisesuaisk' 		=> 	$gjpokok,
											'statuspegawai' 	=> 	$statpeg,
											'kategorigaji' 		=> 	$kdkawin,
											'tjistri' 			=> 	$tjistri,
											'tjanak' 			=> 	$tjanak,
											'tjupns' 			=> 	$tjupns,
											'tjstruk' 			=> 	$tjstruk,
											'tjfungs' 			=> 	$tjfungs,
											'tjdaerah' 			=> 	$tjdaerah,
											'tjpencil' 			=> 	$tjpencil,
											'tjlain' 			=> 	$tjlain,
											'tjkompen' 			=> 	$tjkompen,
											'pembul' 			=> 	$pembul,
											'tjberas' 			=> 	$tjberas,
											'tjpph' 			=> 	$tjpph,
											'potpfkbul' 		=> 	$potpfkbul,
											'potpfk2' 			=> 	$potpfk2,
											'potpfk10' 			=> 	$potpfk10,
											'potpph' 			=> 	$potpph,
											'potswrum' 			=> 	$potswrum,
											'potkelbtj' 		=> 	$potkelbtj,
											'potlain' 			=> 	$potlain,
											'pottabrum' 		=> 	$pottabrum,
											'npwp' 				=> 	$npwp,
											'statusnpwp' 		=> 	$kdkawin,
											'status' 			=> 	$aktif,
											'keterangan' 		=> 	$keterangan,
											'alamat' 			=> 	$alamat,
											'foto' 				=> 	$foto,
											'tmtgaji' 			=> 	'',
											'tmtpangkat' 		=> 	'',
											'ppabp' 			=> 	$ppabp
										]);

							$master 	= $mekso->id;
							if ($master != 0){
								$error 	= $error.'an. '.$nmrek.' NIP.'.$nip.' Dimasukkan Secara Otomatis<br />';
								if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $korpri = 4000; }
								else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $korpri = 3000; }
								else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $korpri = 2000; }
								else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $korpri = 1000; }
								else { $korpri = 1000; }


								if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $dewe = 4000; }
								else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $dewe = 3000; }
								else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $dewe = 2000; }
								else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $dewe = 1000; }
								else { $dewe = 1000; }

								$cek 	= PotonganRutin::where('idpeg', $master)->count();
								if ($cek == 0){
									PotonganRutin::create([
										'idpeg' 				=> 	$master,
										'kpri' 					=> 	$kpri,
										'ukp' 					=> 	$ukp,
										'korpri' 				=> 	$korpri,
										'arisan' 				=> 	$arisan,
										'idw' 					=> 	$dewe,
										'sumbangan' 			=> 	$sumbangan,
										'bpjsbpu' 				=> 	$bpjsbpu,
										'bpjsketenagakerjaan' 	=> 	$bpjsten,
										'bpjsppnpn' 			=> 	$bpjskes
									]);
								}
							}else {
								$error 	= $error.'an. '.$namapdrekening.' NIP.'.$nip.' Gagal di Masukkan Otomatis<br />';
							}
						} 
					} else { $error =  $error.' Baris ke '.$row.' (kesalahan string)<br />'; }
				}
			}
			if ($error == ''){ $error = ''; }
			else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}
			Session::flash('status', 'Status');
			Session::flash('message', 'Import Data Lampiran SPM Berhasil Sejumlah  : '.$sukses.'<br />'.$error.''); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} elseif ($jenis == 'kpri') {
			$path 			= $_FILES['sheete']['tmp_name'];
			$sukses = 0;
			$error  = '<br />';
			$tahun 	= $request->input('kpri_tahun');
			$bulan 	= $request->input('kpri_bulan');

			Pinjaman::where('bulan', $bulan)->where('tahun', $tahun)->where('bank', 'KPRI')->delete();
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			foreach($getalldata as $val){
				if (isset($val['A'])){$no 			= $val['A'];}else{$no = '';}
				if (isset($val['B'])){$nip  		= $val['B'];}else{$nip = '';}
				if (isset($val['C'])){$norek		= $val['C'];}else{$norek = '';}
				if (isset($val['D'])){$nama			= $val['D'];}else{$nama = '';}
				if (isset($val['E'])){$pinjaman		= $val['E'];}else{$pinjaman = '';}
				if (isset($val['F'])){$nopinjaman	= $val['F'];}else{$nopinjaman = '';}
				if (isset($val['G'])){$pokok		= $val['G'];}else{$pokok = '';}
				if (isset($val['H'])){$jasa			= $val['H'];}else{$jasa = '';}
				if (isset($val['I'])){$nominal		= $val['I'];}else{$nominal = '';}
				if (isset($val['J'])){$jmlhcicil	= $val['J'];}else{$jmlhcicil = '';}
				if (isset($val['K'])){$total		= $val['K'];}else{$total = '';}
				if (isset($val['L'])){$minus		= $val['L'];}else{$minus = '';}
				if (isset($val['M'])){$ditagih		= $val['M'];}else{$ditagih = '';}
				if ($no == 'no' OR $no == ''){
				} else {
					$arraymulai		= explode(" - ", $nama);
					$nama 			= $arraymulai[0];
					$cicilanke 		= $arraymulai[1];
					if ($nominal != '' OR $nominal != 0){
						$cekmasuk 	= DB::table('duidevco_masjid.pegawai as pegawai')
										->leftJoin('duidevco_masjid.db_nomor as nomor', 'pegawai.idpeg', 'nomor.idpeg')
										->where('nomor.deskripsi', 'KPRI')
										->where('nomor.nomor', $norek)
										->count();
						if ($cekmasuk != 0){
							$bank		= 'KPRI';
							$rmaster1  	= DB::table('duidevco_masjid.pegawai as pegawai')
											->leftJoin('duidevco_masjid.db_nomor as nomor', 'pegawai.idpeg', 'nomor.idpeg')
											->where('nomor.deskripsi', 'KPRI')
											->where('nomor.nomor', $norek)
											->first();
							$idpeg 		= $rmaster1->idpeg;
							$jenispeg	= $rmaster1->jenispeg;
							$kdkawin	= $rmaster1->kategorigaji;
							$kdgol		= $rmaster1->golongan;
							$kodepjm	= $idpeg.'-'.$tahun.'-'.$bulan.'-'.$bank.'-'.$nominal.'-'.$nopinjaman;
							$kodepjm	= md5($kodepjm);
							$jenis		= 'Pinjaman Bank';
							$tandai		= 'Masuk Tagihan '.$bulan.$tahun;
							$jmlhcicil	= (int)(str_replace($jmlhcicil, "x", " "));
							$marking 	= $bulan.$tahun.$idpeg.$kodepjm;
							$tandai		= 'Masuk Tagihan '.$bulan.$tahun; 
							$input 		= Pinjaman::create([
												'idpeg' 			=> 	$idpeg,
												'kodepinjaman' 		=> 	$kodepjm,
												'bank' 				=> 	$bank,
												'noanggota' 		=> 	$norek,
												'bulan' 			=> 	$bulan,
												'tahun' 			=> 	$tahun,
												'nominal' 			=> 	$nominal,
												'cicilanke' 		=> 	$cicilanke,
												'status' 			=> 	$jmlhcicil,
												'marking' 			=> 	$marking
											]);
							
							if ($input){
								$sukses++;										
							}
							else { 
								$error =  $error.'An. '.$nama.' NIP/NIK '.$nip.' Kode Pinjaman '.$nopinjaman.' Gagal Di Masukkan<br />';
							}
						} else {
							$bank		= 'KPRI';
							$ceknik 	= PegawaiKeuangan::where('nip', $nip)->count();
							if ($ceknik != 0){
								$rmaster1  	= PegawaiKeuangan::where('nip', $nip)->first();
								$idpeg 		= $rmaster1->idpeg;
								$jenispeg	= $rmaster1->jenispeg;
								$kdkawin	= $rmaster1->kategorigaji;
								$kdgol		= $rmaster1->golongan;
								$kodepjm	= $idpeg.'-'.$tahun.'-'.$bulan.'-'.$bank.'-'.$nominal.'-'.$nopinjaman;
								$kodepjm	= md5($kodepjm);
								$jenis		= 'Pinjaman Bank';
								$tandai		= 'Masuk Tagihan '.$bulan.$tahun;
								$jmlhcicil	= (int)(str_replace($jmlhcicil, "x", " "));
								$marking 	= $bulan.$tahun.$idpeg.$kodepjm;
								$tandai		= 'Masuk Tagihan '.$bulan.$tahun;
								$cek1 		= Pinjaman::where('marking', $marking)->count();
								$cek2 		= Nomor::where('nomor', $norek)->count();
								if ($cek1 > 0) {
									Pinjaman::where('marking', $marking)->delete();
								}
								if ($cek2 > 0) {
									Nomor::where('nomor', $norek)->delete();
								}

								$input 	= 	Pinjaman::create([
												'idpeg' 			=> 	$idpeg,
												'kodepinjaman' 		=> 	$kodepjm,
												'bank' 				=> 	$bank,
												'noanggota' 		=> 	$norek,
												'bulan' 			=> 	$bulan,
												'tahun' 			=> 	$tahun,
												'nominal' 			=> 	$nominal,
												'cicilanke' 		=> 	$cicilanke,
												'status' 			=> 	$jmlhcicil,
												'marking' 			=> 	$marking
											]);
								Nomor::create([
									'idpeg' 			=> 	$idpeg,
									'deskripsi' 		=> 	$bank,
									'namapdrekening' 	=> 	$nama,
									'nomor' 			=> 	$norek,
									'gaji' 				=> 	0
								]);

								if ($input){
									$sukses++;
								}
								else { 
									$error =  $error.'An. '.$nama.' NIP/NIK '.$nip.' Kode Pinjaman '.$nopinjaman.' Gagal Di Masukkan<br />';
								}
							}
							else {
								$error = $error.'An. '.$nama.' No. Anggota '.$norek.' Belum Masuk di Data Pegawai<br />';
							}						
						}
					}
				}
			}
			if ($error == ''){ $error = ''; }
			else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}
			Session::flash('status', 'Status');
			Session::flash('message', 'Input Data Pinjaman KPRI Untuk Bulan '.$bulan.' Tahun '.$tahun.' Berhasil Sejumlah  : '.$sukses.'<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} elseif ($jenis == 'ukp') {
			$path 		= $_FILES['sheetd']['tmp_name'];
			$ssukarela 	= 0;
			$swajib		= 0;
			$sangsuran	= 0;
			$error  	= '<br />';
			$tahun 		= $request->input('ukp_tahun');
			$bulan 		= $request->input('ukp_bulan');

			Pinjaman::where('bulan', $bulan)->where('tahun', $tahun)->where('bank', 'UKP')->delete();
			Pinjaman::where('bulan', $bulan)->where('tahun', $tahun)->where('bank', 'TABUKP')->delete();
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			foreach($getalldata as $val){
				if (isset($val['A'])){$nomer 		= $val['A'];}else{$nomer = '';}
				if (isset($val['B'])){$noanggota  	= $val['B'];}else{$noanggota = '';}
				if (isset($val['C'])){$nama			= $val['C'];}else{$nama = '';}
				if (isset($val['D'])){$nik			= $val['D'];}else{$nik = '';}
				if (isset($val['E'])){$jenis		= $val['E'];}else{$jenis = '';}
				if (isset($val['F'])){$sukarela		= (int)$val['F'];}else{$sukarela = 0;}
				if (isset($val['G'])){$wajib		= $val['G'];}else{$wajib = 0;}
				if (isset($val['H'])){$cicilanke	= $val['H'];}else{$cicilanke = 0;}
				if (isset($val['I'])){$angsuran		= $val['I'];}else{$angsuran = 0;}
				if (isset($val['J'])){$total		= $val['J'];}else{$total = 0;}
				if ($noanggota != ''){
					$cekmasuk 	= DB::table('duidevco_masjid.pegawai as pegawai')
									->leftJoin('duidevco_masjid.db_nomor as nomor', 'pegawai.idpeg', 'nomor.idpeg')
									->where('nomor.deskripsi', 'UKP')
									->where('nomor.nomor', $noanggota)
									->count();
					if ($cekmasuk != 0){
						$bank 		= 'UKP';
						$jenis		= 0;
						$rmaster1  	= DB::table('duidevco_masjid.pegawai as pegawai')
										->leftJoin('duidevco_masjid.db_nomor as nomor', 'pegawai.idpeg', 'nomor.idpeg')
										->where('nomor.deskripsi', 'UKP')
										->where('nomor.nomor', $noanggota)
										->first();
						$idpeg 		= $rmaster1->idpeg;
						$jenispeg	= $rmaster1->jenispeg;
						$kdkawin	= $rmaster1->kategorigaji;
						$kdgol		= $rmaster1->golongan;
						$kodepjm	= $idpeg.'-'.$tahun.'-'.$bulan.'-'.$bank.'-'.$angsuran.'-'.$noanggota;
						$kodepjm	= md5($kodepjm);
						
						$tandai		= 'Masuk Tagihan '.$bulan.$tahun;
						$idpotongan	= 0;
						
						$tabungan	= 0;
						
						if ($sukarela != 0 OR $sukarela != ''){
							$tabungan = $tabungan + $sukarela;
						}
						if ($wajib != 0 OR $wajib != ''){
							$tabungan = $tabungan + $wajib;
						}
						if ($angsuran != 0 OR $angsuran != ''){
							$jenis		= 'Pinjaman Bank';
							$tandai		= 'Masuk Tagihan '.$bulan.$tahun;
							$cek1 		= 	Pinjaman::where('marking', $kodepjm)->count();
							if ($cek1 > 0) {
								Pinjaman::where('marking', $kodepjm)->delete();
							}
							
							$input		= 	Pinjaman::create([
												'idpeg' 			=> 	$idpeg,
												'kodepinjaman' 		=> 	$kodepjm,
												'bank' 				=> 	$bank,
												'noanggota' 		=> 	$noanggota,
												'bulan' 			=> 	$bulan,
												'tahun' 			=> 	$tahun,
												'nominal' 			=> 	$angsuran,
												'cicilanke' 		=> 	$cicilanke,
												'status' 			=> 	$tandai,
												'marking' 			=> 	$kodepjm
											]);
							if ($input){
								$sangsuran++;
							}
							else {
								$error =  $error.'Angsuran An. '.$nama.' No. Anggota '.$noanggota.' Gagal Di Masukkan<br />';
							}
						}
						if ($tabungan != 0){
							$kodepjm	= $idpeg.'-'.$tahun.'-'.$bulan.'-'.$bank.'-TABUNGAN-'.$noanggota;
							$kodepjm	= md5($kodepjm);
							$jenis		= 'Potongan Rutin';
							$nominal	= $tabungan;
							$tlsbank	= 'TABUKP';
							$tandai		= 'Masuk Tagihan '.$bulan.$tahun;
							$cek2 		= Pinjaman::where('marking', $kodepjm)->count();
							if ($cek2 > 0) {
								Pinjaman::where('marking', $kodepjm)->delete();
							}

							$input 		= Pinjaman::create([
												'idpeg' 			=> 	$idpeg,
												'kodepinjaman' 		=> 	$kodepjm,
												'bank' 				=> 	$tlsbank,
												'noanggota' 		=> 	$noanggota,
												'bulan' 			=> 	$bulan,
												'tahun' 			=> 	$tahun,
												'nominal' 			=> 	$nominal,
												'cicilanke' 		=> 	$cicilanke,
												'status' 			=> 	$tandai,
												'marking' 			=> 	$kodepjm
											]);
							
							if ($input){
								$ssukarela++;
							}
							else {
								$error =  $error.'Tabungan An. '.$nama.' No. Anggota '.$noanggota.' Gagal Di Masukkan<br />';
							}
						}
					}
					else {
						$error = $error.'An. '.$nama.' No. Anggota '.$noanggota.' Belum Masuk di Data Pegawai<br />';
					}
				}
			}
			if ($error == ''){ $error = ''; }
			else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}
			Session::flash('status', 'Status');
			Session::flash('message', 'Input Data Potongan UKP Untuk Bulan '.$bulan.' Tahun '.$tahun.' Angsuran  : '.$sangsuran.'<br />Tabungan : '.$ssukarela.'<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} elseif ($jenis == 'um') {
			$path 		= $_FILES['sheetc']['tmp_name'];
			$tahun 		= $request->input('um_tahun');
			$bulan 		= $request->input('um_bulan');
			$suksesum 	= 0;
			$suksesit 	= 0;
			$error  	= '';
			$cekmasuk 	= Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->count();
			if ($cekmasuk != 0){
				$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$spreadsheet 	= $reader->load($path);
				$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				foreach($getalldata as $val){
					$no  		= $val['A'];
					$nama  		= $val['B'];
					$nip		= $val['C'];
					$unit		= $val['D'];
					$insentif	= $val['E'];
					$uangmkn	= $val['F'];
					$bayar		= $val['G'];

					$cekmasuk 	= PegawaiKeuangan::where('nip', $nip)->count();
					if ($cekmasuk != 0){
						$rmaster1  	= PegawaiKeuangan::where('nip', $nip)->first();
						$idpeg 		= $rmaster1->idpeg;
						$jenispeg 	= $rmaster1->jenispeg;
						$kdgol 		= $rmaster1->golongan;
						$kdkawin 	= $rmaster1->kategorigaji;
						$norek 		= $rmaster1->norek;
						$bank 		= $rmaster1->namabank;
						$namapdrek	= $rmaster1->namapdrekening;
						if ($uangmkn != 0 OR $uangmkn != ''){
							$jenis	= 'Uang Makan';
							$potum	= 0;
							$input = Report::where('idpeg', $idpeg)->where('bulan', $bulan)->where('tahun', $tahun)->update(['uangmakan' => $uangmkn, 'potuangmakan' => $potum]);
							if ($input){ $suksesum++; }
							else { $error =  $error.' Baris ke '.$row.' (kesalahan string)<br />'; }
						}
						if ($insentif != 0 OR $insentif != ''){
							$potin	= 0;
							$input = Report::where('idpeg', $idpeg)->where('bulan', $bulan)->where('tahun', $tahun)->update(['insentif' => $insentif, 'potinsentif' => $potin]);
							if ($input){ $suksesit++; }
							else { $error =  $error.' Baris ke '.$row.' (kesalahan string)<br />'; }
						}
					} else {
						$error =  $error.' Nama '.$nama.' NIP. '.$nip.' Belum Masuk Database<br />';
					}
				}
			}else {$error =  $error.' Anda Belum Generate Laporan Gaji Bulan '.$bulan.' '.$tahun.'<br />'; }
			if ($error == ''){ $error = ''; }
			else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}
			Session::flash('status', 'Status');
			Session::flash('message', 'Import Data Lampiran Uang Makan dan Insentif Berhasil<br /> Sejumlah  : '.$suksesum.' Data Uang Makan<br />Sejumlah :'.$suksesit.' Data Insentif<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} elseif ($jenis == 'sass') {
			$path 			= $_FILES['sheetb']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$tahun 			= $request->input('sas_tahun');
			$bulan 			= $request->input('sas_bulan');
			Sass::where('bulan', $bulan)->where('tahun', $tahun)->delete();
			
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			foreach($getalldata as $val){		
				$no  		= $val['A'];
				$nama  		= $val['B'];
				$anggota	= $val['C'];
				$hubungan	= $val['D'];
				$nik		= $val['E'];
				$nokk		= $val['F'];
				$npwp		= $val['G'];
				$status  	= $val['H'];
				$penghasilan= $val['I'];
				$pph  		= $val['J'];
				$iuran  	= $val['K'];
				$potongan  	= $val['L'];
				$bersih		= $val['M'];
				$kodeklg	= $val['N'];
				$level		= $val['O'];
				$norek		= $val['P'];
				$nmpdrek	= $val['Q'];
				$kodebank  	= $val['R'];
				$nmbank  	= $val['S'];
				if ($no != ''){
					Sass::create([
						'bulan' 		=> 	$bulan,
						'tahun' 		=> 	$tahun,
						'noorut' 		=> 	$no,
						'nama_pegawai' 	=> 	$nama,
						'nik' 			=> 	$nik,
						'no_kk' 		=> 	$nokk,
						'npwp' 			=> 	$npwp,
						'status' 		=> 	$status,
						'penghasilan' 	=> 	$penghasilan,
						'pph' 			=> 	$pph,
						'iuran' 		=> 	$iuran,
						'jml_potongan' 	=> 	$potongan,
						'jml_bersih' 	=> 	$bersih,
						'kdkeluarga' 	=> 	$kodeklg,
						'level' 		=> 	$level,
						'rekening' 		=> 	$norek,
						'nama_rek' 		=> 	$nmpdrek,
						'kdbank' 		=> 	$kodebank,
						'nmbank' 		=> 	$nmbank,
					]);
				}
				if ($input){ $sukses++; }
				else { $error =  $error.' Baris ke '.$row.' (kesalahan string)<br />'; }
			}
			
			if ($error == ''){ $error = ''; }
			else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}
			Session::flash('status', 'Status');
			Session::flash('message', 'Input Data SASS Berhasil Sejumlah  : '.$sukses.'<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} else {
			Session::flash('status', 'Unkown Error');
			Session::flash('message', 'Jenis Data Tidak Ditemukan'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
		}
	}
	public function uploadFilegpp(Request $request) {
		$path 			= $_FILES['sheeta']['tmp_name'];
		$sukses 		= 0;
		$error  		= '';
		$setsmt 		= '';
		$setthn			= '';
		$setjen			= '';
		$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet 	= $reader->load($path);
		$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		foreach($getalldata as $val){		
			if (isset($val['A'])){$no 			= $val['A'];}else{$no = '';}
			if (isset($val['B'])){$kdsatker  	= $val['B'];}else{$kdsatker = '';}
			if (isset($val['C'])){$kdanak		= $val['C'];}else{$kdanak = '';}
			if (isset($val['D'])){$kdsubanak	= $val['D'];}else{$kdsubanak = '';}
			if (isset($val['E'])){$bulan		= $val['E'];}else{$bulan = '';}
			if (isset($val['F'])){$tahun		= $val['F'];}else{$tahun = '';}
			if (isset($val['G'])){$nogaji		= $val['G'];}else{$nogaji = '';}
			if (isset($val['H'])){$kdjns		= $val['H'];}else{$kdjns = '';}
			if (isset($val['I'])){$nip			= $val['I'];}else{$nip = '';}
			if (isset($val['J'])){$nmpeg		= $val['J'];}else{$nmpeg = '';}
			if (isset($val['K'])){$kdduduk		= $val['K'];}else{$kdduduk = '';}
			if (isset($val['L'])){$kdgol		= $val['L'];}else{$kdgol = '';}
			if (isset($val['M'])){$npwp			= $val['M'];}else{$npwp = '';}
			if (isset($val['N'])){$nmrek		= $val['N'];}else{$nmrek = '';}
			if (isset($val['O'])){$nm_bank		= $val['O'];}else{$nm_bank = '';}
			if (isset($val['P'])){$rekening		= $val['P'];}else{$rekening = '';}
			if (isset($val['Q'])){$kdbankspan	= $val['Q'];}else{$kdbankspan = '';}
			if (isset($val['R'])){$nmbankspan	= $val['R'];}else{$nmbankspan = '';}
			if (isset($val['S'])){$kdpos		= $val['S'];}else{$kdpos = '';}
			if (isset($val['T'])){$kdnegara		= $val['T'];}else{$kdnegara = '';}
			if (isset($val['U'])){$kdkppn		= $val['U'];}else{$kdkppn = '';}
			if (isset($val['V'])){$tipesup		= $val['V'];}else{$tipesup = '';}
			if (isset($val['W'])){$gjpokok		= $val['W'];}else{$gjpokok = '';}
			if (isset($val['X'])){$tjistri		= $val['X'];}else{$tjistri = '';}
			if (isset($val['Y'])){$tjanak		= $val['Y'];}else{$tjanak = '';}
			if (isset($val['Z'])){$tjupns		= $val['Z'];}else{$tjupns = '';}
			if (isset($val['AA'])){$tjstruk		= $val['AA'];}else{$tjstruk = '';}
			if (isset($val['AB'])){$tjfungs		= $val['AB'];}else{$tjfungs = '';}
			if (isset($val['AC'])){$tjdaerah	= $val['AC'];}else{$tjdaerah = '';}
			if (isset($val['AD'])){$tjpencil	= $val['AD'];}else{$tjpencil = '';}
			if (isset($val['AE'])){$tjlain		= $val['AE'];}else{$tjlain = '';}
			if (isset($val['AF'])){$tjkompen	= $val['AF'];}else{$tjkompen = '';}
			if (isset($val['AG'])){$pembul		= $val['AG'];}else{$pembul = '';}
			if (isset($val['AH'])){$tjberas		= $val['AH'];}else{$tjberas = '';}
			if (isset($val['AI'])){$tjpph		= $val['AI'];}else{$tjpph = '';}
			if (isset($val['AJ'])){$potpfkbul	= $val['AJ'];}else{$potpfkbul = '';}
			if (isset($val['AK'])){$potpfk2		= $val['AK'];}else{$potpfk2 = '';}
			if (isset($val['AL'])){$potpfk10	= $val['AL'];}else{$potpfk10 = '';}
			if (isset($val['AM'])){$potpph		= $val['AM'];}else{$potpph = '';}
			if (isset($val['AN'])){$potswrum	= $val['AN'];}else{$potswrum = '';}
			if (isset($val['AO'])){$potkelbtj	= $val['AO'];}else{$potkelbtj = '';}
			if (isset($val['AP'])){$potlain		= $val['AP'];}else{$potlain = '';}
			if (isset($val['AQ'])){$pottabrum	= $val['AQ'];}else{$pottabrum = '';}
			if (isset($val['AR'])){$bersih		= $val['AR'];}else{$bersih = '';}
			if (isset($val['AS'])){$sandi		= $val['AS'];}else{$sandi = '';}
			if (isset($val['AT'])){$kdkawin		= $val['AT'];}else{$kdkawin = '';}
			if (isset($val['AU'])){$kdjab		= $val['AU'];}else{$kdjab = '';}
			if (isset($val['AV'])){$thngj		= $val['AV'];}else{$thngj = '';}
			if (isset($val['AW'])){$kdgapok		= $val['AW'];}else{$kdgapok = '';}
			if (isset($val['AX'])){$bpjs		= $val['AX'];}else{$bpjs = '0';}
			if (isset($val['AY'])){$bpjs2		= $val['AY'];}else{$bpjs2 = '0';}
			if ($no == 'no' OR $no == ''){

			} else {
				$cekmasuk 	= LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->first();
				if (isset($cekmasuk->id)){
					LampiranSpm::where('id', $cekmasuk->id)->delete();
				}
				$input 	= 	LampiranSpm::create([
					'kdsatker' 			=> 	$kdsatker,
					'kdanak' 			=> 	$kdanak,
					'kdsubanak' 		=> 	$kdsubanak,
					'bulan' 			=> 	$bulan,
					'tahun' 			=> 	$tahun,
					'nogaji' 			=> 	$nogaji,
					'kdjns' 			=> 	$kdjns,
					'nip' 				=> 	$nip,
					'nmpeg' 			=> 	$nmpeg,
					'kdduduk' 			=> 	$kdduduk,
					'kdgol' 			=> 	$kdgol,
					'npwp' 				=> 	$npwp,
					'nmrek' 			=> 	$nmrek,
					'nm_bank' 			=> 	$nm_bank,
					'rekening' 			=> 	$rekening,
					'kdbankspan' 		=> 	$kdbankspan,
					'nmbankspan' 		=> 	$nmbankspan,
					'kdpos' 			=> 	$kdpos,
					'kdnegara' 			=> 	$kdnegara,
					'kdkppn' 			=> 	$kdkppn,
					'tipesup' 			=> 	$tipesup,
					'gjpokok' 			=> 	$gjpokok,
					'tjistri' 			=> 	$tjistri,
					'tjanak' 			=> 	$tjanak,
					'tjupns' 			=> 	$tjupns,
					'tjstruk' 			=> 	$tjstruk,
					'tjfungs' 			=> 	$tjfungs,
					'tjdaerah' 			=> 	$tjdaerah,
					'tjpencil' 			=> 	$tjpencil,
					'tjlain' 			=> 	$tjlain,
					'tjkompen' 			=> 	$tjkompen,
					'pembul' 			=> 	$pembul,
					'tjberas' 			=> 	$tjberas,
					'tjpph' 			=> 	$tjpph,
					'potpfkbul' 		=> 	$potpfkbul,
					'potpfk2' 			=> 	$potpfk2,
					'potpfk10' 			=> 	$potpfk10,
					'potpph' 			=> 	$potpph,
					'potswrum' 			=> 	$potswrum,
					'potkelbtj' 		=> 	$potkelbtj,
					'potlain' 			=> 	$potlain,
					'pottabrum' 		=> 	$pottabrum,
					'bersih' 			=> 	$bersih,
					'sandi' 			=> 	$sandi,
					'kdkawin' 			=> 	$kdkawin,
					'kdjab' 			=> 	$kdjab,
					'thngj' 			=> 	$thngj,
					'bpjs' 				=> 	$bpjs,
					'bpjs2' 			=> 	$bpjs2,
					'ppabp' 			=> 	$ppabp,
				]);
				if ($input){ 
					$sukses++;
					$cek 	= PegawaiKeuangan::where('norek', $rekening)->count();
					if ($cek == 0){
						$idpot2		= 0;
						$kpri		= 0;
						$ukp		= 0;
						$arisan		= 0;
						$sumbangan	= 0;
						$bpjsbu		= 0;
						$bpjskes	= 0;
						$bpjsten	= 0;
						$beras 		= 1;
						$kodetgg	= $kdkawin;
						$aktif		= 1;
						$keterangan = 'Input Otomatis';
						$foto		= '';
						$nik		= '';
						$nokk		= '';
						$statpeg	= '1.0';
						$jenpeg		= 'PNS';
						$npwp 		= '';
						$tgllhari 	= '0000-00-00';
						$fungsional	= 'KEPENDIDIKAN TETAP';
						$kelamin	= '';
						$alamat		= '';
						$foto		= '';
						$status		= '1';
						$mekso = PegawaiKeuangan::create([
									'jenispeg' 			=> 	$jenpeg,
									'fungsional' 		=> 	$fungsional,
									'nik' 				=> 	$nik,
									'nokk' 				=> 	$nokk,
									'nip' 				=> 	$nip,
									'nama' 				=> 	$nmpeg,
									'tgllahir' 			=> 	$tgllhari,
									'kelamin' 			=> 	$kelamin,
									'golongan' 			=> 	$kdgol,
									'namabank' 			=> 	$nm_bank,
									'norek' 			=> 	$rekening,
									'namapdrekening' 	=> 	$nmrek,
									'gajisesuaisk' 		=> 	$gjpokok,
									'gajibarublmsk' 	=> 	$gjpokok,
									'statuspegawai' 	=> 	$statpeg,
									'kategorigaji' 		=> 	$kdkawin,
									'tjistri' 			=> 	$tjistri,
									'tjanak' 			=> 	$tjanak,
									'tjupns' 			=> 	$tjupns,
									'tjstruk' 			=> 	$tjstruk,
									'tjfungs' 			=> 	$tjfungs,
									'tjdaerah' 			=> 	$tjdaerah,
									'tjpencil' 			=> 	$tjpencil,
									'tjlain' 			=> 	$tjlain,
									'tjkompen' 			=> 	$tjkompen,
									'pembul' 			=> 	$pembul,
									'tjberas' 			=> 	$tjberas,
									'tjpph' 			=> 	$tjpph,
									'potpfkbul' 		=> 	$potpfkbul,
									'potpfk2' 			=> 	$potpfk2,
									'potpfk10' 			=> 	$potpfk10,
									'potpph' 			=> 	$potpph,
									'potswrum' 			=> 	$potswrum,
									'potkelbtj' 		=> 	$potkelbtj,
									'potlain' 			=> 	$potlain,
									'pottabrum' 		=> 	$pottabrum,
									'npwp' 				=> 	$npwp,
									'statusnpwp' 		=> 	$kdkawin,
									'status' 			=> 	$aktif,
									'keterangan' 		=> 	$keterangan,
									'alamat' 			=> 	$alamat,
									'foto' 				=> 	$foto,
									'tmtgaji' 			=> 	'',
									'tmtpangkat' 		=> 	'',
									'ppabp' 			=> 	$ppabp
								]);
						
						$master = $mekso->id;
						if ($mekso != 0){
							$error 	= $error.'an. '.$nmrek.' NIP.'.$nip.' Dimasukkan Secara Otomatis<br />';
							if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $korpri = 4000; }
							else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $korpri = 3000; }
							else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $korpri = 2000; }
							else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $korpri = 1000; }
							else { $korpri = 1000; }


							if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $dewe = 4000; }
							else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $dewe = 3000; }
							else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $dewe = 2000; }
							else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $dewe = 1000; }
							else { $dewe = 1000; }

							$cek 	= PotonganRutin::where('idpeg', $master)->count();
							if ($cek == 0){
								PotonganRutin::create([
									'idpeg' 				=> 	$master,
									'kpri' 					=> 	$kpri,
									'ukp' 					=> 	$ukp,
									'korpri' 				=> 	$korpri,
									'arisan' 				=>	$arisan,
									'idw' 					=> 	$dewe,
									'sumbangan' 			=> 	$sumbangan,
									'bpjsbpu' 				=>	$bpjsbpu,
									'bpjsketenagakerjaan' 	=> 	$bpjsten,
									'bpjsppnpn' 			=> 	$bpjskes
								]);
							}
						} else {
							$error 	= $error.'an. '.$namapdrekening.' NIP.'.$nip.' Gagal di Masukkan Otomatis<br />';
						}
					} else {
						PegawaiKeuangan::where('nip', $nip)->update([
							'nama' 				=> 	$nmpeg,
							'golongan' 			=> 	$kdgol,
							'namabank' 			=> 	$nm_bank,
							'norek' 			=> 	$rekening,
							'namapdrekening' 	=> 	$nmrek,
							'gajisesuaisk' 		=> 	$gjpokok,
							'kategorigaji' 		=> 	$kdkawin,
							'tjistri' 			=> 	$tjistri,
							'tjanak' 			=> 	$tjanak,
							'tjupns' 			=> 	$tjupns,
							'tjstruk' 			=> 	$tjstruk,
							'tjfungs' 			=> 	$tjfungs,
							'tjdaerah' 			=> 	$tjdaerah,
							'tjpencil' 			=> 	$tjpencil,
							'tjlain' 			=> 	$tjlain,
							'tjkompen' 			=> 	$tjkompen,
							'pembul' 			=> 	$pembul,
							'tjberas' 			=> 	$tjberas,
							'tjpph' 			=> 	$tjpph,
							'potpfkbul' 		=> 	$potpfkbul,
							'potpfk2' 			=> 	$potpfk2,
							'potpfk10' 			=> 	$potpfk10,
							'potpph' 			=> 	$potpph,
							'potswrum' 			=> 	$potswrum,
							'potkelbtj' 		=> 	$potkelbtj,
							'potlain' 			=> 	$potlain,
							'pottabrum' 		=> 	$pottabrum,
							'npwp' 				=> 	$npwp,
							'statusnpwp' 		=> 	$kdkawin,
							'ppabp' 			=> 	$ppabp
						]);
					}
				}
				else { $error =  $error.' Baris ke '.$row.' (kesalahan string)<br />'; }
			}
		}
		
		if ($error == ''){ $error = ''; }
		else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}
		Session::flash('status', 'Status');
		Session::flash('message', 'Import Data Lampiran SPM Berhasil Sejumlah  : '.$sukses.'<br />'.$error.''); 
		Session::flash('alert-class', 'alert-success');

		return back();
	}
	public function uploadFilegajidosen(Request $request) {
		$path 			= $_FILES['sheeta']['tmp_name'];
		$sukses 		= 0;
		$error  		= '';
		$setsmt 		= '';
		$setthn			= '';
		$setjen			= '';
		$objPHPExcel	= IOFactory::load($path);
		$inputFileType 	= IOFactory::identify($objPHPExcel);
		$reader 		= IOFactory::createReader($inputFileType);
		$chunkSize 		= 2048;
		$chunkFilter 	= new ChunkReadFilter2();
		$reader->setReadFilter($chunkFilter);
		for ($startRow = 2; $startRow <= 65536; $startRow += $chunkSize) {
				$chunkFilter->setRows($startRow, $chunkSize);
				$spreadsheet 	= $reader->load($inputFileName);
				$val 			= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				if (isset($val[0])){$no 		= $val[0];}else{$no = '';}
				if (isset($val[1])){$kdsatker  	= $val[1];}else{$kdsatker = '';}
				if (isset($val[2])){$kdanak		= $val[2];}else{$kdanak = '';}
				if (isset($val[3])){$kdsubanak	= $val[3];}else{$kdsubanak = '';}
				if (isset($val[4])){$bulan		= $val[4];}else{$bulan = '';}
				if (isset($val[5])){$tahun		= $val[5];}else{$tahun = '';}
				if (isset($val[6])){$nogaji		= $val[6];}else{$nogaji = '';}
				if (isset($val[7])){$kdjns		= $val[7];}else{$kdjns = '';}
				if (isset($val[8])){$nip		= $val[8];}else{$nip = '';}
				if (isset($val[9])){$nmpeg		= $val[9];}else{$nmpeg = '';}
				if (isset($val[10])){$kdduduk	= $val[10];}else{$kdduduk = '';}
				if (isset($val[11])){$kdgol		= $val[11];}else{$kdgol = '';}
				if (isset($val[12])){$npwp		= $val[12];}else{$npwp = '';}
				if (isset($val[13])){$nmrek		= $val[13];}else{$nmrek = '';}
				if (isset($val[14])){$nm_bank	= $val[14];}else{$nm_bank = '';}
				if (isset($val[15])){$rekening	= $val[15];}else{$rekening = '';}
				if (isset($val[16])){$kdbankspan= $val[16];}else{$kdbankspan = '';}
				if (isset($val[17])){$nmbankspan= $val[17];}else{$nmbankspan = '';}
				if (isset($val[18])){$kdpos		= $val[18];}else{$kdpos = '';}
				if (isset($val[19])){$kdnegara	= $val[19];}else{$kdnegara = '';}
				if (isset($val[20])){$kdkppn	= $val[20];}else{$kdkppn = '';}
				if (isset($val[21])){$tipesup	= $val[21];}else{$tipesup = '';}
				if (isset($val[22])){$gjpokok	= $val[22];}else{$gjpokok = '';}
				if (isset($val[23])){$tjistri	= $val[23];}else{$tjistri = '';}
				if (isset($val[24])){$tjanak	= $val[24];}else{$tjanak = '';}
				if (isset($val[25])){$tjupns	= $val[25];}else{$tjupns = '';}
				if (isset($val[26])){$tjstruk	= $val[26];}else{$tjstruk = '';}
				if (isset($val[27])){$tjfungs	= $val[27];}else{$tjfungs = '';}
				if (isset($val[28])){$tjdaerah	= $val[28];}else{$tjdaerah = '';}
				if (isset($val[29])){$tjpencil	= $val[29];}else{$tjpencil = '';}
				if (isset($val[30])){$tjlain	= $val[30];}else{$tjlain = '';}
				if (isset($val[31])){$tjkompen	= $val[31];}else{$tjkompen = '';}
				if (isset($val[32])){$pembul	= $val[32];}else{$pembul = '';}
				if (isset($val[33])){$tjberas	= $val[33];}else{$tjberas = '';}
				if (isset($val[34])){$tjpph		= $val[34];}else{$tjpph = '';}
				if (isset($val[35])){$potpfkbul	= $val[35];}else{$potpfkbul = '';}
				if (isset($val[36])){$potpfk2	= $val[36];}else{$potpfk2 = '';}
				if (isset($val[37])){$potpfk10	= $val[37];}else{$potpfk10 = '';}
				if (isset($val[38])){$potpph	= $val[38];}else{$potpph = '';}
				if (isset($val[39])){$potswrum	= $val[39];}else{$potswrum = '';}
				if (isset($val[40])){$potkelbtj	= $val[40];}else{$potkelbtj = '';}
				if (isset($val[41])){$potlain	= $val[41];}else{$potlain = '';}
				if (isset($val[42])){$pottabrum	= $val[42];}else{$pottabrum = '';}
				if (isset($val[43])){$bersih	= $val[43];}else{$bersih = '';}
				if (isset($val[44])){$sandi		= $val[44];}else{$sandi = '';}
				if (isset($val[45])){$kdkawin	= $val[45];}else{$kdkawin = '';}
				if (isset($val[46])){$kdjab		= $val[46];}else{$kdjab = '';}
				if (isset($val[47])){$thngj		= $val[47];}else{$thngj = '';}

				$cekmasuk 	= LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->count();
				if ($cekmasuk != 0){
					$rmaster1  	= LampiranSpm::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->first();
					$idne 	= $rmaster1->id;
					LampiranSpm::where('id', $idne)->delete();
				}

				$input 	= 	LampiranSpm::create([
					'kdsatker' 			=> 	$kdsatker,
					'kdanak' 			=> 	$kdanak,
					'kdsubanak' 		=> 	$kdsubanak,
					'bulan' 			=> 	$bulan,
					'tahun' 			=> 	$tahun,
					'nogaji' 			=> 	$nogaji,
					'kdjns' 			=> 	$kdjns,
					'nip' 				=> 	$nip,
					'nmpeg' 			=> 	$nmpeg,
					'kdduduk' 			=> 	$kdduduk,
					'kdgol' 			=> 	$kdgol,
					'npwp' 				=> 	$npwp,
					'nmrek' 			=> 	$nmrek,
					'nm_bank' 			=> 	$nm_bank,
					'rekening' 			=> 	$rekening,
					'kdbankspan' 		=> 	$kdbankspan,
					'nmbankspan' 		=> 	$nmbankspan,
					'kdpos' 			=> 	$kdpos,
					'kdnegara' 			=> 	$kdnegara,
					'kdkppn' 			=> 	$kdkppn,
					'tipesup' 			=> 	$tipesup,
					'gjpokok' 			=> 	$gjpokok,
					'tjistri' 			=> 	$tjistri,
					'tjanak' 			=> 	$tjanak,
					'tjupns' 			=> 	$tjupns,
					'tjstruk' 			=> 	$tjstruk,
					'tjfungs' 			=> 	$tjfungs,
					'tjdaerah' 			=> 	$tjdaerah,
					'tjpencil' 			=> 	$tjpencil,
					'tjlain' 			=> 	$tjlain,
					'tjkompen' 			=> 	$tjkompen,
					'pembul' 			=> 	$pembul,
					'tjberas' 			=> 	$tjberas,
					'tjpph' 			=> 	$tjpph,
					'potpfkbul' 		=> 	$potpfkbul,
					'potpfk2' 			=> 	$potpfk2,
					'potpfk10' 			=> 	$potpfk10,
					'potpph' 			=> 	$potpph,
					'potswrum' 			=> 	$potswrum,
					'potkelbtj' 		=> 	$potkelbtj,
					'potlain' 			=> 	$potlain,
					'pottabrum' 		=> 	$pottabrum,
					'bersih' 			=> 	$bersih,
					'sandi' 			=> 	$sandi,
					'kdkawin' 			=> 	$kdkawin,
					'kdjab' 			=> 	$kdjab,
					'thngj' 			=> 	$thngj,
					'ppabp' 			=> 	'',
				]);
				if ($input){ 
					$sukses++;
					$cek 	= PegawaiKeuangan::where('norek', $rekening)->count();
					if ($cek == 0){
						$idpot2		= 0;
						$kpri		= 0;
						$ukp		= 0;
						$arisan		= 0;
						$sumbangan	= 0;
						$bpjsbu		= 0;
						$bpjskes	= 0;
						$bpjsten	= 0;
						$beras 		= 1;
						$kodetgg	= $kdkawin;
						$aktif		= 1;
						$keterangan = 'Input Otomatis';
						$foto		= '';
						$nik		= '';
						$nokk		= '';
						$statpeg	= '1.0';
						$jenpeg		= 'PNS';
						$npwp 		= '';
						$tgllhari 	= '0000-00-00';
						$fungsional	= 'KEPENDIDIKAN TETAP';
						$kelamin	= '';
						$alamat		= '';
						$foto		= '';
						$status		= '1';
						$mekso = PegawaiKeuangan::create([
									'jenispeg' 			=> 	$jenispeg,
									'fungsional' 		=> 	$fungsional,
									'nik' 				=> 	$nik,
									'nokk' 				=> 	$nokk,
									'nip' 				=> 	$nip,
									'nama' 				=> 	$nmpeg,
									'tgllahir' 			=> 	$tgllhari,
									'kelamin' 			=> 	$kelamin,
									'golongan' 			=> 	$kdgol,
									'namabank' 			=> 	$nm_bank,
									'norek' 			=> 	$rekening,
									'namapdrekening' 	=> 	$nmrek,
									'gajisesuaisk' 		=> 	$gjpokok,
									'gajibarublmk' 		=> 	$gjpokok,
									'statuspegawai' 	=> 	$statpeg,
									'kategorigaji' 		=> 	$kdkawin,
									'tjistri' 			=> 	$tjistri,
									'tjanak' 			=> 	$tjanak,
									'tjupns' 			=> 	$tjupns,
									'tjstruk' 			=> 	$tjstruk,
									'tjfungs' 			=> 	$tjfungs,
									'tjdaerah' 			=> 	$tjdaerah,
									'tjpencil' 			=> 	$tjpencil,
									'tjlain' 			=> 	$tjlain,
									'tjkompen' 			=> 	$tjkompen,
									'pembul' 			=> 	$pembul,
									'tjberas' 			=> 	$tjberas,
									'tjpph' 			=> 	$tjpph,
									'potpfkbul' 		=> 	$potpfkbul,
									'potpfk2' 			=> 	$potpfk2,
									'potpfk10' 			=> 	$potpfk10,
									'potpph' 			=> 	$potpph,
									'potswrum' 			=> 	$potswrum,
									'potkelbtj' 		=> 	$potkelbtj,
									'potlain' 			=> 	$potlain,
									'pottabrum' 		=> 	$pottabrum,
									'npwp' 				=> 	$npwp,
									'statusnpwp' 		=> 	$kdkawin,
									'status' 			=> 	$aktif,
									'keterangan' 		=> 	$keterangan,
									'alamat' 			=> 	$alamat,
									'foto' 				=> 	$foto,
									'tmtgaji' 			=> 	'',
									'tmtpangkat' 		=> 	'',
									'ppabp' 			=> 	$mppabp
								]);
						$master = $mekso->id;
						if ($mekso){
							$error 	= $error.'an. '.$nmrek.' NIP.'.$nip.' Dimasukkan Secara Otomatis<br />';
							if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $korpri = 4000; }
							else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $korpri = 3000; }
							else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $korpri = 2000; }
							else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $korpri = 1000; }
							else { $korpri = 1000; }


							if ($kdgol == 45 OR $kdgol == 44 OR $kdgol == 43 OR $kdgol == 42 OR $kdgol == 41 OR $kdgol == 40){ $dewe = 4000; }
							else if ($kdgol == 34 OR $kdgol == 33 OR $kdgol == 32 OR $kdgol == 31 OR $kdgol == 30) { $dewe = 3000; }
							else if ($kdgol == 24 OR $kdgol == 23 OR $kdgol == 22 OR $kdgol == 21 OR $kdgol == 20) { $dewe = 2000; }
							else if ($kdgol == 14 OR $kdgol == 13 OR $kdgol == 12 OR $kdgol == 11 OR $kdgol == 10) { $dewe = 1000; }
							else { $dewe = 1000; }

							$cek 	= PotonganRutin::where('idpeg', $master)->count();
							if ($cek == 0){
								PotonganRutin::create([
									'idpeg' 		=> 	$master,
									'kpri' 			=> 	$kpri,
									'ukp' 			=> 	$ukp,
									'korpri' 		=> 	$korpri,
									'arisan' 		=>	$arisan,
									'idw' 			=> 	$dewe,
									'sumbangan' 	=> 	$sumbangan,
									'bpjsbpu' 		=>	$bpjsbpu,
									'bpjsketenagakerjaan' 	=> 	$bpjsten,
									'bpjsppnpn' 			=> 	$bpjskes
								]);
								
							}
						}else {
							$error 	= $error.'an. '.$namapdrekening.' NIP.'.$nip.' Gagal di Masukkan Otomatis<br />';
						}
					}else {
						PegawaiKeuangan::where('nip', $nip)->update([
							'nama' 				=> 	$nmpeg,
							'golongan' 			=> 	$kdgol,
							'namabank' 			=> 	$nm_bank,
							'norek' 			=> 	$rekening,
							'namapdrekening' 	=> 	$nmrek,
							'gajisesuaisk' 		=> 	$gjpokok,
							'kategorigaji' 		=> 	$kdkawin,
							'tjistri' 			=> 	$tjistri,
							'tjanak' 			=> 	$tjanak,
							'tjupns' 			=> 	$tjupns,
							'tjstruk' 			=> 	$tjstruk,
							'tjfungs' 			=> 	$tjfungs,
							'tjdaerah' 			=> 	$tjdaerah,
							'tjpencil' 			=> 	$tjpencil,
							'tjlain' 			=> 	$tjlain,
							'tjkompen' 			=> 	$tjkompen,
							'pembul' 			=> 	$pembul,
							'tjberas' 			=> 	$tjberas,
							'tjpph' 			=> 	$tjpph,
							'potpfkbul' 		=> 	$potpfkbul,
							'potpfk2' 			=> 	$potpfk2,
							'potpfk10' 			=> 	$potpfk10,
							'potpph' 			=> 	$potpph,
							'potswrum' 			=> 	$potswrum,
							'potkelbtj' 		=> 	$potkelbtj,
							'potlain' 			=> 	$potlain,
							'pottabrum' 		=> 	$pottabrum,
							'npwp' 				=> 	$npwp,
							'statusnpwp' 		=> 	$kdkawin,
							'ppabp' 			=> 	$mppabp
						]);
					}
				}
				else { $error =  $error.' Baris ke '.$row.' (kesalahan string)<br />'; }
			}
		
		if ($error == ''){ $error = ''; }
		else { $error = 'Yang Gagal dimasukkan Baris Ke : '.$error;}

		return response()->json(['status' => 'success', 'message' => 'Import Data Lampiran SPM Berhasil Sejumlah  : '.$sukses.'<br />'.$error.'']);
	}
	public function exAktivasigaji(Request $request) {
		$bulan		= $request->input('val01');
		$tahun		= $request->input('val02');
		$status		= $request->input('val03');
		$mppabp 	= Session('fakpanjang');
		if ($mppabp == '' OR Session('fakpanjang') == null){
			$mppabp = Session('subsubdomainapps01');
		}
		if ($status == '1'){
			$update  = Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->update([
				'open' => 0
			]);
		} else {
			$update  = Report::where('bulan', $bulan)->where('tahun', $tahun)->where('ppabp', $mppabp)->update([
				'open' => 1
			]);
		}
		if ($update){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Aktivasi Berhasil ']);
			return back();	
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Aktivasi Gagal Silahkan Hubungi Tim TI Terkait']);
			return back();	
		}
		
		
	}
}
