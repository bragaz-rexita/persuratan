<?php

namespace App\Http\Controllers\Sco;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Pejabatsurat;
use App\User;
use App\Filess;
use App\Histories;
use App\Firebasebank;
use App\Macamdisposisi;
use App\Tujuandisposisi;
use App\Simpegpegawai;
use App\Penerimasurat;
use App\Suratmasuk;
use App\Suratkeluar;
use App\Suratkeluartnpnomor;
use App\Models\Kelompoklain;
use App\Models\Jenissurat;
use App\Models\Unitsurat;
use App\Models\Klasifikasi;
use App\Models\Hakaksess;
use App\Models\Matkul;
use App\Models\Ppabp;
use App\Models\SettingKeuangan;
use App\Models\Tabelskdanperaturan;
use App\Models\Draftsk;
use App\Models\Bantuanstudi;
use App\Models\Bantuanpublikasi;
use App\Models\Simsppdspt;
use App\Models\Pendidikan;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Penunjang;
use App\Models\Report;
use App\Models\KategoriPAK;
use App\Models\KategoriBKD;
use App\Models\RubriknonDosen;
use App\Models\PerolehanKeu;
use App\Models\Aktifitas;
use App\Models\Serapankeu;
use App\Models\MasterPS;
use App\Models\Golongan;
use App\Models\AjarFeeder;
use App\Models\Detailpendidikan;
use App\Models\Detaildiklat;
use App\Models\Detailasesor;
use App\Models\Detailorganisasi;
use App\Models\Detailseminar;
use App\Models\Detailanggotakeluarga;
use App\Models\Detailmutasi;
use App\Models\Detailsertifikat;
use App\Models\Detailidentitas;
use App\Models\Detailsertifikasi;
use App\Models\Detailpangkat;
use App\Models\Detailfungsional;
use App\Models\Detailgaji;
use App\Models\Detailpenghargaan;
use App\Detailpegawai;
use App\Models\Mappingdosen;
use App\Gedung;
use App\Models\KLasifikasikepakaran;
use App\Models\KLasifikasipenelitian;
use App\Models\KLasifikasise;
use App\Models\Rumpunilmu;
use App\Models\Dataajar;
use App\Models\Dosenpraktisiajar;
use App\Models\Dosen;
use App\Models\Kontrakkerja;
use App\Models\AuditEksternal;
use App\Models\AuditInternal;
use App\Models\Lulusan;
use App\Models\Biodata;
use App\Models\Unitpendukung;
use App\Models\Unitbisnis;
use App\Models\Penelitiasing;
use App\Models\Bidangilmu;
use Validator;
use Session;

class SimbaController extends Controller
{
//PENGISIAN
	//yang ini beda dengan di SITU
	public function viewRiwayat($id) {
		$previlage  = Session('previlage');
		$arrid		= explode("-", $id);
		if (isset($arrid[1])){
			$id 	= $arrid[1];
			$jenis	= $arrid[0];	
		}
		$idpeg		= $id;
		$ceksek		= Detailpegawai::where('no', $idpeg)->count();
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
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $idpeg)
					->first();
		if (isset($hasil->nama_lengkap)){
			$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
			$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;	
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
			$homebase		= url("/");
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
			if ($dosten == ''){
				$kelompok = 'DOSEN';
			} else {
				$kelompok = $dosten;
			}
			if(isset($arrjabatan[1])){
				$dosten		= $arrjabatan[0];
				$idne 		= $arrjabatan[1];
				if ($dosten == 'TENDIK'){
					$getklm	= Kelompoklain::where('id', $idne)->first();
					if (isset($getklm->tulisan)){
						$kelompok = $getklm->tulisan;
					} else {
						$kelompok = 'DOSEN';
					}
				} else {
					$getklm	= Pejabatsurat::where('id', $idne)->first();
					if (isset($getklm->pejabat)){
						$kelompok = $getklm->pejabat;
					} else {
						$kelompok = 'DOSEN';
					}
				}
			}
			$tasks			= [];
			if (Session('fakultas') == 'KP'){
				$jgroupps		= MasterPS::groupBy('jenjang')->select('jenjang')->orderBy('jenjang', 'ASC')->get();
				$i				= 0;
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$tasks['klasifps'][$i][$j]['nama']	=   $rklas->nama;
						$tasks['klasifps'][$i][$j]['id']	=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  			= 0;
				foreach ($jgroupps as $kgrpklas) {
					$tasks['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
				$jgrouppsk	= Matkul::groupBy('jenjang')->select('jenjang')->orderBy('jenjang', 'ASC')->get();
				$k			= 0;
				foreach ($jgrouppsk as $rgrouppsk) {
					$l  		= 0;
					$jenjang	= $rgrouppsk->jenjang;
					$jklasmk  	= Matkul::where('jenjang', $jenjang)->orderBy('kurikulum', 'ASC')->orderBy('pees', 'ASC')->orderBy('kodemk', 'ASC')->get();
					foreach ($jklasmk as $rklasmk) {
						$kodemk 		= $rklasmk->kodemk;
						$namamk 		= $rklasmk->namamk;
						$kurikulum 		= $rklasmk->kurikulum;
						$tulisanne 		= '('.$kodemk.') '.$namamk.' - Kurikulum '.$kurikulum;
						
						$tasks['listmk'][$k][$l]['tulisanne']= $tulisanne;
						$tasks['listmk'][$k][$l]['namamk']	= $rklasmk->namamk;
						$l++;
					}
					$k++;
				}
				$y  = 0;
				foreach ($jgrouppsk as $kgrouppsk) {
					$tasks['groupmk'][$y]  =   $kgrouppsk->jenjang;
					$y++;
				}
				
			} else {
				$jgroupps		= MasterPS::where('namafak', Session('fakpanjang'))->groupBy('jenjang')->select('jenjang')->orderBy('jenjang', 'ASC')->get();
				$i				= 0;
				foreach ($jgroupps as $rgrpklas) {
					$j  		= 0;
					$jenjang	= $rgrpklas->jenjang;
					$jklas  	= MasterPS::where('namafak', Session('fakpanjang'))->where('jenjang', $jenjang)->get();
					foreach ($jklas as $rklas) {
						$tasks['klasifps'][$i][$j]['nama']	=   $rklas->nama;
						$tasks['klasifps'][$i][$j]['id']	=   $rklas->id;
						$j++;
					}
					$i++;
				}
				$x  			= 0;
				foreach ($jgroupps as $kgrpklas) {
					$tasks['klasifikasips'][$x]  =   $kgrpklas->jenjang;
					$x++;
				}
				$jgrouppsk	= Matkul::where('fakultas', Session('fakultas'))->groupBy('jenjang')->select('jenjang')->orderBy('jenjang', 'ASC')->get();
				$k			= 0;
				foreach ($jgrouppsk as $rgrouppsk) {
					$l  		= 0;
					$jenjang	= $rgrouppsk->jenjang;
					$jklasmk  	= Matkul::where('fakultas', Session('fakultas'))->where('jenjang', $jenjang)->orderBy('kurikulum', 'ASC')->orderBy('pees', 'ASC')->orderBy('kodemk', 'ASC')->get();
					foreach ($jklasmk as $rklasmk) {
						$kodemk 		= $rklasmk->kodemk;
						$namamk 		= $rklasmk->namamk;
						$kurikulum 		= $rklasmk->kurikulum;
						$tulisanne 		= '('.$kodemk.') '.$namamk.' - Kurikulum '.$kurikulum;
						
						$tasks['listmk'][$k][$l]['tulisanne']= $tulisanne;
						$tasks['listmk'][$k][$l]['namamk']	= $rklasmk->namamk;
						$l++;
					}
					$k++;
				}
				$y  = 0;
				foreach ($jgrouppsk as $kgrouppsk) {
					$tasks['groupmk'][$y]  =   $kgrouppsk->jenjang;
					$y++;
				}
			
			}
			if ($i == 0){
				$tasks['klasifps'][0][0]['nama']	=   'No Data';
				$tasks['klasifps'][0][0]['id']		=   '0';
				$tasks['klasifikasips'][0] 			=   'No Data';
			}
			if ($k == 0){
				$tasks['listmk'][0][0]['tulisanne']	=   'No Data';
				$tasks['listmk'][0][0]['namamk']	=   '0';
				$tasks['groupmk'][0] 				=   'No Data';
			}
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
			$i 				= 0;
			$jkajur			= Pejabatsurat::where('pejabat', 'LIKE', '%Ketua Jurusan%')->orWhere('pejabat', 'LIKE', '%Kepala Departemen%')->get();
			if(!empty($jkajur)){
				foreach ($jkajur as $rkajur){
					$pejabat				= $rkajur->pejabat;
					$kode					= $rkajur->kode;
					$pejabat				= str_replace('Ketua ', '', $pejabat);
					$pejabat				= str_replace('KETUA ', '', $pejabat);
					$pejabat				= str_replace('Kepala ', '', $pejabat);
					$pejabat				= str_replace('KEPALA ', '', $pejabat);
					$tasks['jjurusan'][$i]  = $pejabat;
					$j  					= 0;
					$jdepartemen			= Pejabatsurat::where('kode', 'LIKE', $kode.'%')->get();
					if (!empty($jdepartemen)){
						foreach ($jdepartemen as $rdep){
							$pjbdpt	= $rdep->pejabat;
							$pjbdpt = str_replace('KETUA ', '', $pjbdpt);
							$pjbdpt = str_replace('Ketua ', '', $pjbdpt);
							$pjbdpt = str_replace('Kepala ', '', $pjbdpt);
							$pjbdpt = str_replace('KEPALA ', '', $pjbdpt);
							$tasks['jjdepartemen'][$i][$j]['nama']	=   $pjbdpt;
							$j++;
						}
					}
					$i++;
				}
			}
			$tasks['jjurusan'][$i]  = 'Subbagian Akademik';
			$i++;
			$tasks['jjurusan'][$i]  = 'Subbagian Umum dan Barang Milik Negara';
			$i++;
			$tasks['jjurusan'][$i]  = 'Subbagian Keuangan dan Kepegawaian';
			$i++;
			$tasks['jjurusan'][$i]  = 'Subbagian Kemahasiswaan dan Alumni';
			$i++;
			$tasks['jjurusan'][$i]  = 'Subbagian Akademik, Kemahasiswaan dan Alumni';
			$i++;
			$tasks['jjurusan'][$i]  = 'Subbagian Umum, Keuangan dan Kepegawaian';
			$i++;
			$tasks['jjurusan'][$i]  = 'Administrasi';
			$i++;
			$y 					= 0;
			$jjabatan			= Pejabatsurat::orderBy('kode', 'ASC')->get();
			if(!empty($jjabatan)){
				foreach ($jjabatan as $rkajur){
					if ($rkajur->pejabat != ''){
						$tasks['jabatan'][$y]['kode']	= 'PEJABAT-'.$rkajur->id;
						$tasks['jabatan'][$y]['nama']	= $rkajur->pejabat;
						$y++;
					}
				}
			}
			$jjabatanlain		= Kelompoklain::orderBy('tulisan', 'ASC')->groupBy('tulisan')->get();
			if(!empty($jjabatanlain)){
				foreach ($jjabatanlain as $rkajur){
					if ($rkajur->tulisan != ''){
						$tasks['jabatan'][$y]['kode']	= 'TENDIK-'.$rkajur->id;
						$tasks['jabatan'][$y]['nama']	= $rkajur->tulisan;
						$y++;
					}
				}
			}
			
			$grouptombol = '
				<a href="'.$homebase.'/setpendidikan/'.$idpeg.'" class="btn btn-app bg-red">
					<i class="fa fa-usd"></i> Pendidikan
				</a>
				<a href="'.$homebase.'/setpenelitian/'.$idpeg.'" class="btn btn-app bg-green">
					<i class="fa fa-text-width"></i> Penelitian
				</a>
				<a href="'.$homebase.'/setpenngabdian/'.$idpeg.'" class="btn btn-app bg-blue">
					<i class="fa fa-wordpress"></i> Pengabdian
				</a>
				<a href="'.$homebase.'/setpenunjang/'.$idpeg.'" class="btn btn-app bg-orange">
					<i class="fa fa-text-width"></i> Penunjang
				</a>';
			
			$thniki 						= (int)date("Y");
			$blniki 						= date("m");
			$thnlalu						= $thniki - 1;
			$thnakad						= $thnlalu.'/'.$thniki;
			$koderumpunilmu					= Rumpunilmu::orderBy('kode', 'ASC')->get();
			$kodebidangilmu					= Bidangilmu::orderBy('bidangilmu', 'ASC')->get();
			$golongan 						= Golongan::orderBy('id', 'ASC')->get();
			$tasks['grouptombol'] 			= $grouptombol;
			$tasks['foto'] 					= $foto;
			$tasks['tlsprodi'] 				= $tlsprodi;
			$tasks['golongan'] 				= $golongan;
			$tasks['tlsjabatan'] 			= $tlsjabatan;
			$tasks['kelompok'] 				= $kelompok;
			$tasks['masagolongan'] 			= '';
			$tasks['masakerja'] 			= '';
			$tasks['thniki'] 				= $thniki;
			$tasks['thnakad'] 				= $thnakad;
			$tasks['biodata'] 				= $hasil;
			$tasks['koderumpunilmu'] 		= $koderumpunilmu;
			$tasks['kodebidangilmu'] 		= $kodebidangilmu;
			$tasks['sidebar'] 				= 'DataInduk';
			if (Session('fakultas') == 'DPM' OR Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'RSPHMLG' OR Session('fakultas') == 'PDP'){
				$tasks['pejabats'] 			= Pejabatsurat::orderBy('kode', 'ASC')->get();
				return view('users.riwayat', $tasks);
			} else {
				return view('simba.riwayat', $tasks);
			}
		} else {
			$nip 				= $idpeg;
			$data				= [];
			$golongan 			= Golongan::orderBy('id', 'ASC')->get();
			$data['nip'] 		= $nip;
			$data['golongan'] 	= $golongan;
			$data['semula'] 	= 'dashboarddokar';
			$data['fakultass'] 	= User::whereNotIn('fakultas', ['KP', 'XX', 'Safehouse'])->orderBy('fakpanjang', 'ASC')->groupBy('fakultas')->get();
			return view('anyari', $data);
		}
		
	}
	public function exdataKegiatandosen(Request $request) {
		$kodejenis	= $request->input('val01');
		$masterno	= $request->input('val02');
		$idne		= $request->input('val03');
		$set04		= $request->input('val04');
		$set05		= $request->input('val05');
		$set06		= $request->input('val06');
		$set07		= $request->input('val07');
		$set08		= $request->input('val08');
		$set09		= $request->input('val09');
		$set10		= $request->input('val10');
		$set11		= $request->input('val11');
		$set12		= $request->input('val12');
		$set13		= $request->input('val13');
		$set14		= $request->input('val14');
		$set15		= $request->input('val15');
		$set16		= $request->input('val16');
		$set17		= $request->input('val17');
		$set18		= $request->input('val18');
		$set19		= $request->input('val19');
		$set20		= $request->input('val20');
		$set21		= $request->input('val21');
		$set22		= $request->input('val22');		
		$tabel		= $request->input('val23');
		$deskripsi	= '';
		$cekpak		= KategoriPAK::where('kode', $kodejenis)->count();
		$cekbkd		= KategoriBKD::where('kode', $kodejenis)->count();
		if($cekpak != 0){
			$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
			$penjabaran 	= $rkatebkd->penjabaran;
			$subpenjabaran 	= $rkatebkd->subpenjabaran;
			$id1			= $rkatebkd->id;
			$id2			= $penjabaran;
			$id3			= $subpenjabaran;
			$id4			= $rkatebkd->subsubpenjabaran;
			$id5			= $rkatebkd->subsubsubpenjabaran;
			$id6			= $rkatebkd->buktidukung;
			$id7			= $rkatebkd->maksimal;
			$id8			= $rkatebkd->satuan;
			$angka			= $rkatebkd->pak;
		} else if($cekbkd != 0){
			$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
			$penjabaran 	= $rkatebkd->penjabaran;
			$subpenjabaran 	= $rkatebkd->subpenjabaran;
			$id1			= $rkatebkd->id;
			$id2			= $penjabaran;
			$id3			= $subpenjabaran;
			$id4			= $rkatebkd->subsubpenjabaran;
			$id5			= $rkatebkd->subsubsubpenjabaran;
			$id6			= $rkatebkd->buktidukung;
			$id7			= $rkatebkd->maksimal;
			$id8			= $rkatebkd->satuan;
			$angka			= $rkatebkd->bkd;
		} else {
			$penjabaran 	= '';
			$subpenjabaran 	= '';
			$id1			= '';
			$id2			= '';
			$id3			= '';
			$id4			= '';
			$id5			= '';
			$id6			= '';
			$id7			= '';
			$id8			= '';
			$id9			= '';
			$angka			= '0';
		}
		if ($tabel == 'pengajaran'){
			$klmkerja		= substr($kodejenis, 0, 3);
			if ($klmkerja == '101'){
				$ceksek 	= Detailpendidikan::where('no', $masterno)->where('tahunmsk', $set07)->count();
				if ($ceksek == 0){
					$input = Detailpendidikan::create([
						'no'		=> $masterno,
						'jenjang'	=> $set13,
						'sekolah'	=> $set04,
						'negara'	=> $set05,
						'minat'		=> $set06,
						'tahunmsk'	=> $set07,
						'status'	=> $set08,
						'tmtlulus'	=> $set09,
						'noijasah'	=> $set10,
						'tglijasah'	=> $set11,
						'keterangan'=> $set12,
						'bukti'		=> ''
					]);
					$idinput = $input->id;
				} else {
					Detailpendidikan::where('no', $masterno)->where('tahunmsk', $set07)->update([
						'no'		=> $masterno,
						'jenjang'	=> $set13,
						'sekolah'	=> $set04,
						'negara'	=> $set05,
						'minat'		=> $set06,
						'tahunmsk'	=> $set07,
						'status'	=> $set08,
						'tmtlulus'	=> $set09,
						'noijasah'	=> $set10,
						'tglijasah'	=> $set11,
						'keterangan'=> $set12,
					]);
					$getid 		= Detailpendidikan::where('no', $masterno)->where('tahunmsk', $set07)->first();
					$idinput 	= $getid->id;
				}				
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $penjabaran.' '.$subpenjabaran,
						'sks'			=> 12,
						'namamhs'		=> '',
						'nimmhs'		=> '',
						'semester'		=> '',
						'tanggal'		=> $set09,
						'satuan'		=> 'Ijasah',
						'kegiatan'		=> '1',
						'angka'			=> $angka,
						'bukti'			=> '',
						'marking'		=> $idinput,
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> '',
						'namaps'		=> '',
						'jenjangps'		=> '',
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $penjabaran.' '.$subpenjabaran,
						'tanggal'		=> $set09,
						'angka'			=> $angka,
						'marking'		=> $idinput,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ($klmkerja == '102'){
				$ceksek 	= Detaildiklat::where('no', $masterno)->where('namadiklat', $set08)->count();
				if ($ceksek == 0){
					$input = Detaildiklat::create([
						'no'			=> $masterno,
						'angkatan'		=> $set10,
						'diklat'		=> $set06,
						'jam'			=> $set13,
						'keterangan'	=> $set16,
						'lulus'			=> $set12,
						'mulai'			=> $set11,
						'namadiklat'	=> $set08,
						'negeri'		=> $set15,
						'nodoc'			=> $set04,
						'penyelenggara'	=> $set07,
						'predikat'		=> $set14,
						'tempat'		=> $set09,
						'tgldok'		=> $set05,
						'bukti'			=> '',
					]);
					$idinput = $input->id;
				} else {
					Detaildiklat::where('no', $masterno)->where('namadiklat', $set08)->update([
						'no'			=> $masterno,
						'angkatan'		=> $set10,
						'diklat'		=> $set06,
						'jam'			=> $set13,
						'keterangan'	=> $set16,
						'lulus'			=> $set12,
						'mulai'			=> $set11,
						'negeri'		=> $set15,
						'nodoc'			=> $set04,
						'penyelenggara'	=> $set07,
						'predikat'		=> $set14,
						'tempat'		=> $set09,
						'tgldok'		=> $set05,
					]);
					$getid 		= Detaildiklat::where('no', $masterno)->where('namadiklat', $set08)->first();
					$idinput 	= $getid->id;
				}				
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $penjabaran.' '.$subpenjabaran,
						'sks'			=> 12,
						'namamhs'		=> '',
						'nimmhs'		=> '',
						'semester'		=> '',
						'tanggal'		=> $set09,
						'satuan'		=> 'Sertifikat',
						'kegiatan'		=> '1',
						'angka'			=> $angka,
						'bukti'			=> '',
						'marking'		=> $idinput,
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> '',
						'namaps'		=> '',
						'jenjangps'		=> '',
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $penjabaran.' '.$subpenjabaran,
						'tanggal'		=> $set09,
						'angka'			=> $angka,
						'marking'		=> $idinput,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ( $klmkerja == '201'){
				$getmatkul 	= Matkul::where('id', $set06)->first();
				if (isset($getmatkul->bobot)){
					$sks 		= $getmatkul->bobot;
					$namamk 	= $getmatkul->namamk;
					$jenjang 	= $getmatkul->jenjang;
					$kodemk 	= $getmatkul->kodemk;
					$pees 		= $getmatkul->pees;
					$kurikulum 	= $getmatkul->kurikulum;
				} else {
					$sks 		= '0';
					$namamk 	= 'Unkown';
					$jenjang 	= 'Unkown';
					$kodemk 	= 'Unkown';
					$pees 		= '0';
					$kurikulum 	= '0000';
				}
				$getnamaps 		= MasterPS::where('id', $set05)->first();
				if (isset($getnamaps->nama)){
					$namaps 	= $getnamaps->nama;
					$jenjangps 	= $getnamaps->jenjang;
				} else {
					$namaps 	= 'Unkown';
					$jenjangps 	= 'Unkown';
				}
				$deskripsi 	= $jenjang.' '.$namamk.' ( '.$kodemk.'-'.$sks.')'; 
				$semester 	= $set09.'.'.$set08;
				$kegiatan	= (int)$set10;
				if ($kegiatan > 13){
					if ($set04 == 'TP' OR $set04 == 'AA'){
						$angka = '0.5';
					} else {
						$angka = '1';
					}
				} else {
					if ($sks == 0){
						$angka = 0;
					} else {
						$angka = ($kegiatan / 16) * $sks;
					}					
				}
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'sks'			=> $sks,
						'namamhs'		=> $namamk,
						'nimmhs'		=> $kodemk,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Tatap Muka',
						'kegiatan'		=> $kegiatan,
						'angka'			=> $angka,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> $set04,
						'kodeps'		=> $set05,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> $set07,
						'lingkup'		=> $set11,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'sks'			=> $sks,
						'namamhs'		=> $namamk,
						'nimmhs'		=> $kodemk,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Tatap Muka',
						'kegiatan'		=> $set10,
						'angka'			=> $angka,
						'jabatan'		=> $set04,
						'kodeps'		=> $set05,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> $set07,
						'lingkup'		=> $set11,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ( $klmkerja == '202' or $klmkerja == '203' ){
				$getnamaps 		= MasterPS::where('id', $set06)->first();
				if (isset($getnamaps->nama)){
					$namaps 	= $getnamaps->nama;
					$jenjangps 	= $getnamaps->jenjang;
				} else {
					$namaps 	= 'Unkown';
					$jenjangps 	= 'Unkown';
				}
				if ($kodejenis == '202100'){
					$deskripsi 	= $subpenjabaran;
				} else {
					$deskripsi	= $penjabaran.' '.$subpenjabaran;
				}
				$semester	= $set08.'.'.$set07;
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'sks'			=> '0',
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> '1',
						'angka'			=> 0,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> $set09,
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ( $klmkerja == '204'){
				$getnamaps 		= MasterPS::where('id', $set06)->first();
				if (isset($getnamaps->nama)){
					$namaps 	= $getnamaps->nama;
					$jenjangps 	= $getnamaps->jenjang;
				} else {
					$namaps 	= 'Unkown';
					$jenjangps 	= 'Unkown';
				}
				$cekpak		= KategoriPAK::where('kode', $set07)->count();
				$cekbkd		= KategoriBKD::where('kode', $set07)->count();
				if($cekpak != 0){
					$rkatebkd		= KategoriPAK::where('kode', $set07)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else if($cekbkd != 0){
					$rkatebkd		= KategoriBKD::where('kode', $set07)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else {
					$penjabaran 	= '';
					$subpenjabaran 	= '';
					$id1			= '';
					$id2			= '';
					$id3			= '';
					$id4			= '';
					$id5			= '';
					$id6			= '';
					$id7			= '';
					$id8			= '';
					$id9			= '';
					$id10			= '';
				}
				$deskripsi 	= $subpenjabaran.' '.$id4;
				$semester	= $set09.'.'.$set08;
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $set07,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'sks'			=> '0',
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> '1',
						'angka'			=> 0,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $set07,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> $semester,
						'tanggal'		=> $set09,
						'satuan'		=> 'Mahasiswa',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ( $klmkerja == '205'){
				$getnamaps 		= MasterPS::where('id', $set06)->first();
				if (isset($getnamaps->nama)){
					$namaps 	= $getnamaps->nama;
					$jenjangps 	= $getnamaps->jenjang;
				} else {
					$namaps 	= 'Unkown';
					$jenjangps 	= 'Unkown';
				}
				$deskripsi 	= $subpenjabaran.' '.$id4;
				$semester	= $set08.'.'.$set07;
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'sks'			=> '0',
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> '1',
						'angka'			=> 0,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> $semester,
						'tanggal'		=> $set08,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> '1',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ( $klmkerja == '206'){
				$getnamaps 		= MasterPS::where('id', $set06)->first();
				if (isset($getnamaps->nama)){
					$namaps 	= $getnamaps->nama;
					$jenjangps 	= $getnamaps->jenjang;
				} else {
					$namaps 	= 'Unkown';
					$jenjangps 	= 'Unkown';
				}
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $set07,
						'sks'			=> '0',
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'semester'		=> '',
						'tanggal'		=> $set08,
						'satuan'		=> 'Kegiatan',
						'kegiatan'		=> '1',
						'angka'			=> 0,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $set07,
						'namamhs'		=> $set04,
						'nimmhs'		=> $set05,
						'tanggal'		=> $set08,
						'satuan'		=> 'Kegiatan',
						'kegiatan'		=> '1',
						'kodeps'		=> $set06,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			} else if ( $klmkerja == '208'){
				$cekpak		= KategoriPAK::where('kode', $set04)->count();
				$cekbkd		= KategoriBKD::where('kode', $set04)->count();
				if($cekpak != 0){
					$rkatebkd		= KategoriPAK::where('kode', $set04)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else if($cekbkd != 0){
					$rkatebkd		= KategoriBKD::where('kode', $set04)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else {
					$penjabaran 	= '';
					$subpenjabaran 	= '';
					$id1			= '';
					$id2			= '';
					$id3			= '';
					$id4			= '';
					$id5			= '';
					$id6			= '';
					$id7			= '';
					$id8			= '';
					$id9			= '';
					$id10			= '';
				}
				$deskripsi 	= $subpenjabaran.' '.$id4;
				if ($idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'sks'			=> '0',
						'namamhs'		=> $set05,
						'nimmhs'		=> '',
						'semester'		=> '',
						'tanggal'		=> $set06,
						'satuan'		=> 'Kegiatan',
						'kegiatan'		=> '1',
						'angka'			=> 0,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> '',
						'namaps'		=> '',
						'jenjangps'		=> '',
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $deskripsi,
						'namamhs'		=> $set05,
						'tanggal'		=> $set06,
					]);
				}
			} else {
				if ($set12 == 'new' OR $idne == 'new'){
					$input 		= Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $subpenjabaran,
						'sks'			=> '0',
						'namamhs'		=> $set04,
						'nimmhs'		=> '',
						'semester'		=> '',
						'tanggal'		=> '',
						'satuan'		=> 'Kegiatan',
						'kegiatan'		=> '1',
						'angka'			=> 0,
						'bukti'			=> '',
						'marking'		=> '',
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> '',
						'namaps'		=> '',
						'jenjangps'		=> '',
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idne = $input->id;
				} else {
					$input 		= Pendidikan::where('id', $idne)->update([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $masterno,
						'deskripsi'		=> $subpenjabaran,
						'namamhs'		=> $set04,
						'set04'			=> $set04,
						'set05'			=> $set05,
						'set06'			=> $set06,
						'set07'			=> $set07,
						'set08'			=> $set08,
						'set09'			=> $set09,
						'set10'			=> $set10,
						'set11'			=> $set11,
						'set12'			=> $set12,
						'set13'			=> $set13,
						'set14'			=> $set14,
						'set15'			=> $set15,
						'set16'			=> $set16,
						'set17'			=> $set17,
						'set18'			=> $set18,
						'set19'			=> $set19,
						'set20'			=> $set20,
						'set21'			=> $set21,
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
				
					]);
				}
			}
		} else if ($tabel == 'penelitian'){
			if ($idne == 'new'){
				$input 		= Penelitian::create([
					'kodedosen'			=> $masterno,
					'kepakaran'			=> '',
					'judul'				=> $set04,
					'jenis'				=> $set06,
					'kodebidang'		=> $set07,
					'kodetujuan'		=> $set08,
					'sumberdana'		=> $set09,
					'institusipendana'	=> $set11,
					'jumlahdana'		=> $set12,
					'inputor'			=> Session('nama'),
					'kodejenis'			=> $kodejenis,
					'hasilluaran'		=> $set13,
					'deskripsi'			=> $set15,
					'penerbit'			=> $set16,
					'isbn'				=> $set17,
					'issn'				=> $set20,
					'halaman'			=> $set18,
					'volume'			=> $request->input('val24'),
					'nmjurnal'			=> $set19,
					'urljurnal'			=> $set14,
					'tahun'				=> $set10,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
					'verifikator'		=> '',
					'status'			=> $set05,
					'fakultas'			=> Session('fakultas'),
				]);
				$idne = $input->id;
			} else {
				$input 		= Penelitian::where('id', $idne)->update([
					'kodedosen'			=> $masterno,
					'kepakaran'			=> '',
					'judul'				=> $set04,
					'jenis'				=> $set06,
					'kodebidang'		=> $set07,
					'kodetujuan'		=> $set08,
					'sumberdana'		=> $set09,
					'institusipendana'	=> $set11,
					'jumlahdana'		=> $set12,
					'inputor'			=> Session('nama'),
					'kodejenis'			=> $kodejenis,
					'hasilluaran'		=> $set13,
					'deskripsi'			=> $set15,
					'penerbit'			=> $set16,
					'isbn'				=> $set17,
					'issn'				=> $set20,
					'halaman'			=> $set18,
					'volume'			=> $request->input('val24'),
					'nmjurnal'			=> $set19,
					'urljurnal'			=> $set14,
					'tahun'				=> $set10,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
					'status'			=> $set05,
				]);
			}
		} else if ($tabel == 'pengabdian'){
			if ($idne == 'new'){
				$input 		= Pengabdian::create([
					'kodedosen'			=> $masterno,
					'judul'				=> $set04,
					'keterangan'		=> $set05,
					'mulai'				=> $set06,
					'akhir'				=> $set07,
					'kodejenis'			=> $kodejenis,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
					'verifikator'		=> '',
					'status'			=> '',
					'fakultas'			=> Session('fakultas'),
				]);
				$idne = $input->id;
			} else {
				$input 		= Pengabdian::where('id', $idne)->update([
					'judul'				=> $set04,
					'keterangan'		=> $set05,
					'mulai'				=> $set06,
					'akhir'				=> $set07,
					'kodejenis'			=> $kodejenis,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
				]);
			}
		} else {
			if ($idne == 'new'){
				$input 		= Penunjang::create([
					'kodedosen'			=> $masterno,
					'judul'				=> $set04,
					'keterangan'		=> $set05,
					'mulai'				=> $set06,
					'akhir'				=> $set07,
					'kodejenis'			=> $kodejenis,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
					'verifikator'		=> '',
					'status'			=> '',
					'fakultas'			=> Session('fakultas'),
				]);
				$idne = $input->id;
			} else {
				$input 		= Penunjang::where('id', $idne)->update([
					'judul'				=> $set04,
					'keterangan'		=> $set05,
					'mulai'				=> $set06,
					'akhir'				=> $set07,
					'kodejenis'			=> $kodejenis,
					'satuan'			=> $id8,
					'kegiatan'			=> $penjabaran.' '.$subpenjabaran,
					'angka'				=> $angka,
					'bukti'				=> $id6,
				]);
			}
	
		}
		if ($input){
			Aktifitas::create([
				'unique_id'		=> $masterno,
				'kelompok'		=> Session('previlage'), 
				'keterangan'	=> 'Tambah Data '.$penjabaran, 
				'verifikator'	=> ''
			]);
			$nmfile 			= time();
			if ($request->hasFile('file1')) {
				$nmfile		= 'SIMBA1-'.$masterno.'-'.$idne.'.'.$request->file('file1')->getClientOriginalExtension();
				Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, $request->file('file1'));
				Filess::create([
					'url'			=> $idne,
					'title'			=> $tabel,
					'description'	=> 'Bukti Dukung '.$penjabaran,
					'name'			=> $nmfile1,
				]);
			}
			if ($request->hasFile('file2')) {
				$nmfile		= 'SIMBA2-'.$masterno.'-'.$idne.'.'.$request->file('file2')->getClientOriginalExtension();
				Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, $request->file('file2'));
				Filess::create([
					'url'			=> $idne,
					'title'			=> $tabel,
					'description'	=> 'Bukti Dukung '.$penjabaran,
					'name'			=> $nmfile2,
				]);
			}
			if ($request->hasFile('file3')) {
				$nmfile		= 'SIMBA3-'.$masterno.'-'.$idne.'.'.$request->file('file3')->getClientOriginalExtension();
				Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, $request->file('file3'));
				Filess::create([
					'url'			=> $idne,
					'title'			=> $tabel,
					'description'	=> 'Bukti Dukung '.$penjabaran,
					'name'			=> $nmfile3,
				]);
			}
			if ($request->hasFile('file4')) {
				$nmfile		= 'SIMBA4-'.$masterno.'-'.$idne.'.'.$request->file('file4')->getClientOriginalExtension();
				Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, $request->file('file4'));
				Filess::create([
					'url'			=> $idne,
					'title'			=> $tabel,
					'description'	=> 'Bukti Dukung '.$penjabaran,
					'name'			=> $nmfile4,
				]);
			}
			$buktidarisuratmasuk 	= $request->input('val21');
			$buktidarisk 			= $request->input('val22');
		
			if ($buktidarisk != ''){
				$getarrsurat		= explode(",", $buktidarisk);
				foreach ( $getarrsurat as $idsk )
				{
					if ($idsk != ''){
						$cekada = Tabelskdanperaturan::where('id', $idsk)->first();
						if (isset($cekada->nomor)){
							$judul 	= 'SK Nomor '.$cekada->nomor.' Tahun '.$cekada->tahun.' Tentang '.$cekada->judul;
							Filess::create([
								'url'			=> $idne,
								'title'			=> $tabel,
								'description'	=> 'Tabelskdanperaturan',
								'name'			=> $idsk,
							]);
						}
					}
				}
			}
			if ($buktidarisuratmasuk != ''){
				$getarrsurat		= explode(",", $buktidarisuratmasuk);
				
				foreach ( $getarrsurat as $idmailbox )
				{
					if ($idmailbox != ''){
						$cekada = Penerimasurat::where('id', $idmailbox)->first();
						if (isset($cekada->jenis)){
							Filess::create([
								'url'			=> $idne,
								'title'			=> $tabel,
								'description'	=> 'Mailbox',
								'name'			=> $idmailbox,
							]);
						}
					}
				}
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $penjabaran.' berhasil di input']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $penjabaran.' Gagal di input']);
			return back();
		}
    }
	public function datadetAktifidosen(Request $request) {
    	$masterno	= $request->input('val01');
		$tabelcari	= $request->input('val02');
		$arraydata	= [];
		if ($masterno == 'AWAL'){
			$masterno = 0;
			$getdpendidikan = Pendidikan::where('namamhs', Session('email'))->where('marking', 'LIKE', 'penugasan%')->where('verifikator', '')->orderBy('id', 'DESC')->get();
			if(!empty($getdpendidikan)){
				foreach($getdpendidikan as $hasil){
					$kodejenis 		= $hasil->kodejenis;
					$deskripsi 		= $hasil->deskripsi;
					$namamhs 		= $hasil->namamhs;
					$nimmhs 		= $hasil->nimmhs;
					$sks 			= $hasil->sks;
					$tanggal 		= $hasil->tanggal;
					$semester 		= $hasil->semester;
					$bukti 			= $hasil->bukti;
					$val17 			= $hasil->set17;
					$nama 			= '';
					$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
					if($getrubrikpak != 0){
						$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
						$penjabaran 	= $rkatebkd->penjabaran;
						$subpenjabaran 	= $rkatebkd->subpenjabaran;
						$id1			= $rkatebkd->id;
						$id2			= $penjabaran;
						$id3			= $subpenjabaran;
						$id4			= $rkatebkd->subsubpenjabaran;
						$id5			= $rkatebkd->subsubsubpenjabaran;
						$id6			= $rkatebkd->buktidukung;
						$id7			= $rkatebkd->maksimal;
						$id8			= $rkatebkd->satuan;
						$id9			= $rkatebkd->pak;
						$id10			= $rkatebkd->bkd;
					} else {
						$penjabaran 	= '';
						$subpenjabaran 	= '';
						$id1			= '';
						$id2			= '';
						$id3			= '';
						$id4			= '';
						$id5			= '';
						$id6			= '';
						$id7			= '';
						$id8			= '';
						$id9			= '';
						$id10			= '';
					}
					if ($bukti != ''){
						$bukti 	= '<a href="'.$homebase.'/scan/files/'.$bukti.'" target="_blank"><span class="label label-success">'.$bukti.'</span></a>';
					}
					if ($val17 != ''){
						$val17 	= '<a href="'.$homebase.'/scan/files/'.$val17.'" target="_blank"><span class="label label-success">'.$val17.'</span></a>';
					}
					$getnamaspv = Simpegpegawai::where('id', $hasil->kodedosen)->first();
					if (isset($getnamaspv->nama_lengkap)){
						$namamhs = $getnamaspv->nama_lengkap;
					}
					$arraydata[]= array(
						'idne' 		=> $hasil->id,		
						'nama' 		=> $nama,
						'kodedosen' => $hasil->kodedosen,
						'kodejenis' => $kodejenis,
						'tulis' 	=> '',
						'deskripsi' => $hasil->deskripsi,
						'sks' 		=> $hasil->sks,
						'namamhs' 	=> $namamhs,
						'nimmhs' 	=> $hasil->nimmhs,
						'semester' 	=> $hasil->semester,
						'tanggal' 	=> $hasil->tanggal,
						'satuan' 	=> $hasil->satuan,
						'kegiatan' 	=> $hasil->kegiatan,
						'angka' 	=> $hasil->angka,
						'bukti' 	=> $bukti,
						'nmfile' 	=> $hasil->nmfile,
						'marking' 	=> $hasil->marking,
						'verifikator'=> $hasil->verifikator,
						'status' 	=> $hasil->status,
						'tabel' 	=> 'akademik',
						'set01' 	=> $id1,
						'set02' 	=> $id2,
						'set03' 	=> $id3,
						'set04' 	=> $id4,
						'set05' 	=> $id5,
						'set06' 	=> $id6,
						'set07' 	=> $id7,
						'set08' 	=> $id8,
						'set09' 	=> $id9,
						'set10' 	=> $id10,
						'val01'		=> $hasil->set01,
						'val02'		=> $hasil->set02,
						'val03'		=> $hasil->set03,
						'val04'		=> $hasil->set04,
						'val05'		=> $hasil->set05,
						'val06'		=> $hasil->set06,
						'val07'		=> $hasil->set07,
						'val08'		=> $hasil->set08,
						'val09'		=> $hasil->set09,
						'val10'		=> $hasil->set10,
						'val11'		=> $hasil->set11,
						'val12'		=> $hasil->set12,
						'val13'		=> $hasil->set13,
						'val14'		=> $hasil->set14,
						'val15'		=> $hasil->set15,
						'val16'		=> $hasil->set16,
						'val17'		=> $val17,
						'val18'		=> $hasil->set18,
						'val19'		=> $hasil->set19,
						'val20'		=> $hasil->set20,
						'val21'		=> $hasil->set21,
						'val22'		=> $hasil->set21,
						'val23'		=> $hasil->set22,
						'val24'		=> $hasil->set24,
				
					);
				}
			}
		} else {
			$getpegawai	= Simpegpegawai::where('id', $masterno)->first();
			if (isset($getpegawai->nama_lengkap)){
				$nama 		= $getpegawai->nama_lengkap;
				$nip_baru 	= $getpegawai->nip_baru;
				$idregptk	= $getpegawai->idregptk;
			} else {
				$nama 		= '';
				$nip_baru 	= '';
				$idregptk	= '';
			}
			if ($tabelcari == 'akademik'){
				if ($idregptk != ''){
					$getdataajar = AjarFeeder::where('id_reg_ptk', $idregptk)->where('ket', '!=', 'sudah')->get();
				}else {
					$getdataajar = AjarFeeder::where('nip', $nip_baru)->where('ket', '!=', 'sudah')->get();
				}
				if(!empty($getdataajar)){
					foreach($getdataajar as $hasil){
						$jenjang 	= $hasil->jenjang;
						$pees 		= $hasil->pees;
						$kelas 		= $hasil->fk__id_kls;
						$kodemk 	= $hasil->kode_mk;
						$nipajar	= $hasil->nip;
						$namamk		= $hasil->nm_mk;
						$sks 		= $hasil->sks_subst_tot;
						$rencana 	= $hasil->jml_tm_renc;
						$realisasi 	= $hasil->jml_tm_real;
						$tahun 		= $hasil->tahun;
						$semester 	= $hasil->semester;
						$tlssemester= $tahun.$semester;
						$valcari	= $kodemk.$kelas.$tlssemester.$jenjang.$pees.$nipajar;
						$deskripsi	= $namamk.' Kelas '.$kelas.' PS. '.$pees.' Jenjang '.$jenjang;
						$cekupload	= Filess::where('title', 'Melaksanakan perkulihan pada mahasiswa')->where('description', $valcari)->groupBy('name')->first();
						if (isset($cekupload->name)){
							$nmfile = $cekupload->name;
						} else { $nmfile = ''; }
						$ceksudah	= Pendidikan::where('kodedosen', $masterno)->where('kodejenis', '201100')->where('deskripsi', $deskripsi)->count();
						if ($ceksudah == 0){
							$input = Pendidikan::create([
								'kodejenis'			=> '201100', 
								'kodedosen'			=> $masterno, 
								'deskripsi'			=> $deskripsi, 
								'sks'				=> $sks, 
								'namamhs'			=> '', 
								'nimmhs'			=> '', 
								'semester'			=> $tlssemester, 
								'tanggal'			=> '', 
								'satuan'			=> '', 
								'kegiatan'			=> '', 
								'angka'				=> '', 
								'bukti'				=> $nmfile, 
								'marking'			=> $hasil->id, 
								'verifikator'		=> '', 
								'status'			=> ''
							]);
							if ($input){
								AjarFeeder::where('id', $hasil->id)->update([
									'ket' => 'sudah'
								]);
							}
						}
					}
				}
				$getdpendidikan = Pendidikan::where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
				if(!empty($getdpendidikan)){
					foreach($getdpendidikan as $hasil){
						$kodejenis 		= $hasil->kodejenis;
						$deskripsi 		= $hasil->deskripsi;
						$namamhs 		= $hasil->namamhs;
						$nimmhs 		= $hasil->nimmhs;
						$sks 			= $hasil->sks;
						$tanggal 		= $hasil->tanggal;
						$semester 		= $hasil->semester;
						$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
						$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
						if($getrubrikpak != 0){
							$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else if($getrubrikbkd != 0){
							$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else {
							$penjabaran 	= '';
							$subpenjabaran 	= '';
							$id1			= '';
							$id2			= '';
							$id3			= '';
							$id4			= '';
							$id5			= '';
							$id6			= '';
							$id7			= '';
							$id8			= '';
							$id9			= '';
							$id10			= '';
						}
						if ($id5 != ''){
							$deskripsi = $id3.' '.$id4.' '.$id5;
						} else {
							if ($id4 != ''){
								$deskripsi = $id3.' '.$id4;
							} else {
								$deskripsi = $id3;
							}
						}
						if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
							else { $tulis = $penjabaran; }
						if ( $kodejenis == '204130' or $kodejenis == '204230' ){ 
							$deskripsi 	= $deskripsi.' '.$namamhs.'('.$nimmhs.')'; 
						}
						if ( $kodejenis == '205100' or $kodejenis == '205200' ){ 
							$deskripsi 	= $deskripsi.' '.$namamhs.'('.$nimmhs.')';
							$tanggal 	= $semester;
						}
						if ($kodejenis == '201100'){ 
							$deskripsi 	= $deskripsi.' ('.$sks.')'; 
							$tanggal 	= $semester;
						}
						$arraydata[] = array(
							'idne' 		=> $hasil->id,		
							'nama' 		=> $nama,
							'kodedosen' => $masterno,
							'kodejenis' => $kodejenis,
							'tulis' 	=> $tulis,
							'deskripsi' => $deskripsi,
							'sks' 		=> $hasil->sks,
							'namamhs' 	=> $hasil->namamhs,
							'nimmhs' 	=> $hasil->nimmhs,
							'semester' 	=> $hasil->semester,
							'tanggal' 	=> $tanggal,
							'satuan' 	=> $hasil->satuan,
							'kegiatan' 	=> $hasil->kegiatan,
							'angka' 	=> $hasil->angka,
							'bukti' 	=> $hasil->bukti,
							'nmfile' 	=> $hasil->nmfile,
							'marking' 	=> $hasil->marking,
							'tabel' 	=> 'akademik',
							'set01' 	=> $id1,
							'set02' 	=> $id2,
							'set03' 	=> $id3,
							'set04' 	=> $id4,
							'set05' 	=> $id5,
							'set06' 	=> $id6,
							'set07' 	=> $id7,
							'set08' 	=> $id8,
							'set09' 	=> $id9,
							'set10' 	=> $id10,
							'val04'		=> $hasil->set04,
							'val05'		=> $hasil->set05,
							'val06'		=> $hasil->set06,
							'val07'		=> $hasil->set07,
							'val08'		=> $hasil->set08,
							'val09'		=> $hasil->set09,
							'val10'		=> $hasil->set10,
							'val11'		=> $hasil->set11,
							'val12'		=> $hasil->set12,
							'val13'		=> $hasil->set13,
							'val14'		=> $hasil->set14,
							'val15'		=> $hasil->set15,
							'val16'		=> $hasil->set16,
							'val17'		=> $hasil->set17,
							'val18'		=> $hasil->set18,
							'val19'		=> $hasil->set19,
							'val20'		=> $hasil->set20,
							'val21'		=> $hasil->set21,
							'val22'		=> $hasil->set21,
							'val23'		=> $hasil->set22,
					
						);
					}
				}
			}
			else if ($tabelcari == 'penelitian'){
				$getdpenelitian = Penelitian::where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
				if(!empty($getdpenelitian)){
					foreach($getdpenelitian as $hasil){
						$kodejenis 		= $hasil->kodejenis;
						$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
						$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
						if($getrubrikpak != 0){
							$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else if($getrubrikbkd != 0){
							$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else {
							$penjabaran 	= '';
							$subpenjabaran 	= '';
							$id1			= '';
							$id2			= '';
							$id3			= '';
							$id4			= '';
							$id5			= '';
							$id6			= '';
							$id7			= '';
							$id8			= '';
							$id9			= '';
							$id10			= '';
						}
						if ($id5 != ''){
							$deskripsi = $id3.' '.$id4.' '.$id5;
						} else {
							if ($id4 != ''){
								$deskripsi = $id3.' '.$id4;
							} else {
								$deskripsi = $id3;
							}
						}
						if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
						else { $tulis = $penjabaran; }
						
						$arraydata[] = array(
							'idne' 				=> $hasil->id,		
							'nama' 				=> $nama,
							'kodedosen' 		=> $masterno,
							'kodejenis' 		=> $kodejenis,
							'kepakaran' 		=> $hasil->kepakaran,
							'judul' 			=> $hasil->judul,
							'jenis' 			=> $hasil->jenis,
							'kodebidang' 		=> $hasil->kodebidang,
							'kodetujuan' 		=> $hasil->kodetujuan,
							'sumberdana' 		=> $hasil->sumberdana,
							'institusipendana' 	=> $hasil->institusipendana,
							'jumlahdana' 		=> $hasil->jumlahdana,
							'inputor' 			=> $hasil->inputor,
							'hasilluaran' 		=> $hasil->hasilluaran,
							'deskripsi' 		=> $hasil->deskripsi,
							'penerbit' 			=> $hasil->penerbit,
							'isbn' 				=> $hasil->isbn,
							'issn' 				=> $hasil->issn,
							'halaman' 			=> $hasil->halaman,
							'volume' 			=> $hasil->volume,
							'nmjurnal' 			=> $hasil->nmjurnal,
							'urljurnal' 		=> $hasil->urljurnal,
							'tahun' 			=> $hasil->tahun,
							'satuan' 			=> $hasil->satuan,
							'kegiatan' 			=> $hasil->kegiatan,
							'angka' 			=> $hasil->angka,
							'bukti' 			=> $hasil->bukti,
							'status' 			=> $hasil->status,
							'fakultas' 			=> $hasil->fakultas,
							'tabel' 			=> 'penelitian',
							'set01' 			=> $id1,
							'set02' 			=> $id2,
							'set03' 			=> $id3,
							'set04' 			=> $id4,
							'set05' 			=> $id5,
							'set06' 			=> $id6,
							'set07' 			=> $id7,
							'set08' 			=> $id8,
							'set09' 			=> $id9,
							'set10' 			=> $id10,
						);
					}
				}
			}
			else if ($tabelcari == 'pengabdian'){
				$getdpengabdian = Pengabdian::where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
				if(!empty($getdpengabdian)){
					foreach($getdpengabdian as $hasil){
						$kodejenis 		= $hasil->kodejenis;
						$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
						$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
						if($getrubrikpak != 0){
							$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else if($getrubrikbkd != 0){
							$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else {
							$penjabaran 	= '';
							$subpenjabaran 	= '';
							$id1			= '';
							$id2			= '';
							$id3			= '';
							$id4			= '';
							$id5			= '';
							$id6			= '';
							$id7			= '';
							$id8			= '';
							$id9			= '';
							$id10			= '';
						}
						if ($id5 != ''){
							$deskripsi = $id3.' '.$id4.' '.$id5;
						} else {
							if ($id4 != ''){
								$deskripsi = $id3.' '.$id4;
							} else {
								$deskripsi = $id3;
							}
						}
						if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
						else { $tulis = $penjabaran; }
						
						$arraydata[] = array(
							'idne' 		=> $hasil->id,		
							'nama' 		=> $nama,
							'kodedosen' => $masterno,
							'kodejenis' => $kodejenis,
							'judul' 	=> $hasil->judul,
							'keterangan'=> $hasil->keterangan,
							'mulai' 	=> $hasil->mulai,
							'akhir' 	=> $hasil->akhir,
							'inputor' 	=> $hasil->inputor,
							'satuan' 	=> $hasil->satuan,
							'kegiatan' 	=> $hasil->kegiatan,
							'angka' 	=> $hasil->angka,
							'bukti' 	=> $hasil->bukti,
							'status' 	=> $hasil->status,
							'verifikator'=> $hasil->verifikator,
							'fakultas' 	=> $hasil->fakultas,
							'tabel' 	=> 'pengabdian',
							'set01' 	=> $id1,
							'set02' 	=> $id2,
							'set03' 	=> $id3,
							'set04' 	=> $id4,
							'set05' 	=> $id5,
							'set06' 	=> $id6,
							'set07' 	=> $id7,
							'set08' 	=> $id8,
							'set09' 	=> $id9,
							'set10' 	=> $id10,
							'val04'		=> $hasil->set04,
							'val05'		=> $hasil->set05,
							'val06'		=> $hasil->set06,
							'val07'		=> $hasil->set07,
							'val08'		=> $hasil->set08,
							'val09'		=> $hasil->set09,
							'val10'		=> $hasil->set10,
							'val11'		=> $hasil->set11,
							'val12'		=> $hasil->set12,
							'val13'		=> $hasil->set13,
							'val14'		=> $hasil->set14,
							'val15'		=> $hasil->set15,
							'val16'		=> $hasil->set16,
							'val17'		=> $hasil->set17,
							'val18'		=> $hasil->set18,
							'val19'		=> $hasil->set19,
							'val20'		=> $hasil->set20,
							'val21'		=> $hasil->set21,
							'val22'		=> $hasil->set21,
							'val23'		=> $hasil->set22,
					
						);
					}
				}
			}		
			else {
				$getdpengabdian = Penunjang::where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
				if(!empty($getdpengabdian)){
					foreach($getdpengabdian as $hasil){
						$kodejenis 		= $hasil->kodejenis;
						$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
						$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
						if($getrubrikpak != 0){
							$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else if($getrubrikbkd != 0){
							$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
							$penjabaran 	= $rkatebkd->penjabaran;
							$subpenjabaran 	= $rkatebkd->subpenjabaran;
							$id1			= $rkatebkd->id;
							$id2			= $penjabaran;
							$id3			= $subpenjabaran;
							$id4			= $rkatebkd->subsubpenjabaran;
							$id5			= $rkatebkd->subsubsubpenjabaran;
							$id6			= $rkatebkd->buktidukung;
							$id7			= $rkatebkd->maksimal;
							$id8			= $rkatebkd->satuan;
							$id9			= $rkatebkd->pak;
							$id10			= $rkatebkd->bkd;
						} else {
							$penjabaran 	= '';
							$subpenjabaran 	= '';
							$id1			= '';
							$id2			= '';
							$id3			= '';
							$id4			= '';
							$id5			= '';
							$id6			= '';
							$id7			= '';
							$id8			= '';
							$id9			= '';
							$id10			= '';
						}
						if ($id5 != ''){
							$deskripsi = $id3.' '.$id4.' '.$id5;
						} else {
							if ($id4 != ''){
								$deskripsi = $id3.' '.$id4;
							} else {
								$deskripsi = $id3;
							}
						}
						if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
						else { $tulis = $penjabaran; }
						
						$arraydata[] = array(
							'idne' 		=> $hasil->id,		
							'nama' 		=> $nama,
							'kodedosen' => $masterno,
							'kodejenis' => $kodejenis,
							'judul' 	=> $hasil->judul,
							'keterangan'=> $hasil->keterangan,
							'mulai' 	=> $hasil->mulai,
							'akhir' 	=> $hasil->akhir,
							'inputor' 	=> $hasil->inputor,
							'satuan' 	=> $hasil->satuan,
							'kegiatan' 	=> $hasil->kegiatan,
							'angka' 	=> $hasil->angka,
							'bukti' 	=> $hasil->bukti,
							'status' 	=> $hasil->status,
							'verifikator'=> $hasil->verifikator,
							'fakultas' 	=> $hasil->fakultas,
							'tabel' 	=> 'penunjang',
							'set01' 	=> $id1,
							'set02' 	=> $id2,
							'set03' 	=> $id3,
							'set04' 	=> $id4,
							'set05' 	=> $id5,
							'set06' 	=> $id6,
							'set07' 	=> $id7,
							'set08' 	=> $id8,
							'set09' 	=> $id9,
							'set10' 	=> $id10,
							'val04'		=> $hasil->set04,
							'val05'		=> $hasil->set05,
							'val06'		=> $hasil->set06,
							'val07'		=> $hasil->set07,
							'val08'		=> $hasil->set08,
							'val09'		=> $hasil->set09,
							'val10'		=> $hasil->set10,
							'val11'		=> $hasil->set11,
							'val12'		=> $hasil->set12,
							'val13'		=> $hasil->set13,
							'val14'		=> $hasil->set14,
							'val15'		=> $hasil->set15,
							'val16'		=> $hasil->set16,
							'val17'		=> $hasil->set17,
							'val18'		=> $hasil->set18,
							'val19'		=> $hasil->set19,
							'val20'		=> $hasil->set20,
							'val21'		=> $hasil->set21,
							'val22'		=> $hasil->set21,
							'val23'		=> $hasil->set22,
					
						);
					}
				}
			}
		}
    	echo json_encode($arraydata);	
	}
	public function datadetFileupload(Request $request) {
    	$idne		= $request->input('val01');
		$tabel		= $request->input('val02');
		$arraydata	= [];
		$homebase	= url("/");
		
		$getfiless	= Filess::where('url', $idne)->where('title', $tabel)->get();
		if (!empty($getfiless)){
			foreach($getfiless as $row){
				$title 		= $row->title;
				$name 		= $row->name;
				$description= $row->description;
				if ($description == 'Tabelskdanperaturan'){
					if ($name != ''){
						$cekada = Tabelskdanperaturan::where('id', $name)->first();
						if (isset($cekada->scansurat)){
							$name = '<a href="'.$homebase.'/scan/files/'.$cekada->scansurat.'" target="_blank">'.$row->description.'</a>';
						}
					}
				} else {
					if ($name != ''){
						if (File::exists(base_path()) ."/public/scan/files/". $name) {
							$name = '<a href="'.$homebase.'/scan/files/'.$name.'" target="_blank">'.$row->description.'</a>';
						}
					}
				}
				$arraydata[] = array(
					'idfile' 		=> $row->id,		
					'name' 			=> $name,
					'size' 			=> $row->size,
					'type' 			=> $row->type,
					'url' 			=> $row->url,
					'title' 		=> $title,
					'description' 	=> $row->description,
				);
			}
		}
    	echo json_encode($arraydata);	
	}
	public function exDatapenugasan(Request $request) {
        $validator  =   Validator::make($request->all(), [
            'val01'	=>  'required',
            'val03' =>  'required',
            'val04' =>  'required',
            'val05' =>  'required',
            'val06' =>  'required',
            'val07' =>  'required',
            'val08' =>  'required',
            'val09' =>  'required',
        ]);
        if($validator->fails()) {
        	return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Lengkapi Data Anda']);
			return back();
		} else {
            $email			= $request->input('val01');
			$idps			= $request->input('val02');
			$tanggal		= $request->input('val03');
			$waktu			= $request->input('val04');
			$topik			= $request->input('val05');
			$masterno		= $request->input('val06');
			$deskripsi		= $request->input('val07');
			$kodejenis		= $request->input('val08');
			$durasi			= $request->input('val09');
			$rumahsakit		= $request->input('val10');
			$rumahsakitnama	= $request->input('val11');
			$idne			= $request->input('val12');
			$laborat		= $request->input('val13');
			$spvlain		= $request->input('val14');
			$jumlah			= $request->input('val15');
			$spv2			= $request->input('val16');
			$spv3			= $request->input('val17');
			$role			= $request->input('val18');
			$role2			= $request->input('val19');
			$semester		= $request->input('val20');
			$junior 		= 0;
			$middle			= 0;
			$senior 		= 0;
			$nama 			= $email;
			$nim 			= $email;

			if ($kodejenis != '204309' AND $role2 != ''){
				$role		= $role2;
			}
			if ($idps == '' OR is_null($idps)){
				$golekidps		= Simpegpegawai::where('email', $email)->first();
				if (isset($golekidps->id)){
					$masterno	= $golekidps->id;
					$nim		= $golekidps->nip_baru;
					$jenjangps	= $golekidps->jenjanghomebase;
					$namaps		= $golekidps->prodihomebase;
					$idps		= $golekidps->program_studi;
					$nama		= $golekidps->nama_lengkap;
				} else { $jenjangps = ''; $namaps = ''; }
			} else {
				$golekidps		= MasterPS::where('id', $idps)->first();
				if (isset($golekidps->id)){
					$jenjangps	= $golekidps->jenjang;
					$namaps		= $golekidps->nama;
				} else { $jenjangps = ''; $namaps = ''; }
			}
			$klmkerja		= substr($kodejenis, 0, 3);
			$subpenjabaran	= '';
			$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
			if (isset($rkatebkd->id)){
				$penjabaran 	= $rkatebkd->penjabaran;
				$subpenjabaran 	= $rkatebkd->subpenjabaran;
				$id1			= $rkatebkd->id;
				$id2			= $penjabaran;
				$id4			= $rkatebkd->subsubpenjabaran;
				$id5			= $rkatebkd->subsubsubpenjabaran;
				$id6			= $rkatebkd->buktidukung;
				$id7			= $rkatebkd->maksimal;
				$id8			= $rkatebkd->satuan;
				$angka			= $rkatebkd->pak;
				$tabel			= $rkatebkd->jenis;
			} else {
				$penjabaran 	= '';
				$subpenjabaran 	= $kodejenis;
				$id1			= '';
				$id2			= '';
				$id3			= '';
				$id4			= '';
				$id5			= '';
				$id6			= '';
				$id7			= '';
				$id8			= '';
				$id9			= '';
				$angka			= '0';
				$tabel			= 'akademik';
				$kodejenis		= $request->input('val05');
			}
			$id3 = $subpenjabaran;
			if ($idne == 'new'){
				$getidpenug		= Pendidikan::orderBy('id', 'DESC')->first();
				$golekid		= $getidpenug->id;
				$golekid		= $golekid++;
			} else {
				$golekid		= $idne;
				if ($request->hasFile('file') OR $request->hasFile('file2')) {
					$getfiless		= Filess::where('url', $idne)->where('title', $tabel)->get();
					if (!empty($getfiless)){
						foreach($getfiless as $row){
							$title 		= $row->title;
							$name 		= $row->name;
							if ($name != ''){
								if (File::exists(base_path()) ."/public/scan/files/". $name) {
									File::delete(base_path() ."/public/scan/files/". $name);
								}
							}
						}
					}
				}
			}
			$nmfile 		= time();
			if ($request->hasFile('file')) {
				$nmfile1			= 'SIMBA-'.$masterno.'-'.$golekid.'-'.$nmfile.'.'.$request->file('file')->getClientOriginalExtension();
				$request->file('file')->move(public_path('scan/files'), $nmfile1);
				Filess::create([
					'url'			=> $golekid,
					'title'			=> $tabel,
					'description'	=> 'Bukti Dukung '.$penjabaran,
					'name'			=> $nmfile1,
				]);
				$bukti = $nmfile1;
			} else { $bukti = ''; }
			if ($request->hasFile('file2')) {
				$nmfile2			= 'SIMBA-'.$masterno.'-'.$golekid.'-2-'.$nmfile.'.'.$request->file('file2')->getClientOriginalExtension();
				$request->file('file2')->move(public_path('scan/files'), $nmfile2);
				Filess::create([
					'url'			=> $golekid,
					'title'			=> $tabel,
					'description'	=> 'Bukti Dukung '.$penjabaran,
					'name'			=> $nmfile2,
				]);
				$set17 	= $nmfile2;
			} else { $set17 = ''; }
			if ($idne == 'new'){
				$input 		= Pendidikan::create([
					'kodejenis'		=> $kodejenis,
					'kodedosen'		=> $masterno,
					'deskripsi'		=> $subpenjabaran,
					'sks'			=> 0,
					'namamhs'		=> $nama,
					'nimmhs'		=> $nim,
					'semester'		=> $semester,
					'tanggal'		=> $tanggal,
					'satuan'		=> 'Mahasiswa',
					'kegiatan'		=> '1',
					'angka'			=> $angka,
					'bukti'			=> $bukti,
					'marking'		=> 'penugasan-'.$golekid,
					'verifikator'	=> '',
					'status'		=> '',
					'jabatan'		=> '',
					'kodeps'		=> $idps,
					'namaps'		=> $namaps,
					'jenjangps'		=> $jenjangps,
					'kesesuaian'	=> '',
					'lingkup'		=> '',
					'set04'			=> $deskripsi,
					'set05'			=> $topik,
					'set06'			=> $waktu,
					'set07'			=> $penjabaran,
					'set08'			=> $durasi,
					'set09'			=> $rumahsakit,
					'set10'			=> $rumahsakitnama,
					'set11'			=> $laborat,
					'set12'			=> $request->input('val14'),
					'set13'			=> $request->input('val15'),
					'set14'			=> $request->input('val16'),
					'set15'			=> $request->input('val17'),
					'set16'			=> $role,
					'set17'			=> $set17,
					'set18'			=> $junior,
					'set19'			=> $request->input('val05'),
					'set20'			=> $senior,
					'set21'			=> $request->input('val21'),
					'set22'			=> Session('fakultas'),
					'set23'			=> $klmkerja,
				]);
				$idinput 	= $input->id;
				if ($bukti != ''){
					Filess::where('name', $bukti)->update([
						'url'			=> $idinput,
					]);
				}
				if ($set17 != ''){
					Filess::where('name', $set17)->update([
						'url'			=> $idinput,
					]);
				}
				$tuliskirim 	= 'Topik Kegiatan '.$topik.' Tanggal '.$tanggal.' Dari '.$nama.' Menunggu Verifikasi';
				$golekemail		= Simpegpegawai::where('id', $masterno)->first();
				if (isset($golekemail->email)){
					$emailub	= $golekemail->email;
					$cariiduser = User::where('email', 'LIKE', $emailub)->get();
					if (!empty($cariiduser)){
						foreach ($cariiduser as $rowid){
							$idcaritoken	= $rowid->id;
							$jtokencari		= Firebasebank::where('userid', $idcaritoken)->get();
							if (!empty($jtokencari)){
								foreach ( $jtokencari as $rtokencari ){
									$firebaseid = $rtokencari->firebase;
									$msg = array (
										'message' 	=> $tuliskirim,
										'title'		=> 'SIAPDOK',
										'subtitle'	=> 'Universitas Brawijaya',
										'tickerText'=> 'Verifikasi',
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
											"title" => 'INSITU FK UB',
											"sound" => "default",
											"body" 	=> $tuliskirim
										],
										'data'			=> $msg
										
									);
									$headers = array
									(
										'Authorization: key=' . API_ACCESS_KEY,
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
				}
				if ($spv2 != ''){
					$input2 = Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $spv2,
						'deskripsi'		=> $subpenjabaran,
						'sks'			=> 0,
						'namamhs'		=> $nama,
						'nimmhs'		=> $nim,
						'semester'		=> $semester,
						'tanggal'		=> $tanggal,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> '1',
						'angka'			=> $angka,
						'bukti'			=> $bukti,
						'marking'		=> 'penugasan-'.$golekid,
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> $idps,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $deskripsi,
						'set05'			=> $topik,
						'set06'			=> $waktu,
						'set07'			=> $penjabaran,
						'set08'			=> $durasi,
						'set09'			=> $rumahsakit,
						'set10'			=> $rumahsakitnama,
						'set11'			=> $laborat,
						'set12'			=> $request->input('val14'),
						'set13'			=> $request->input('val15'),
						'set14'			=> $request->input('val16'),
						'set15'			=> $request->input('val17'),
						'set16'			=> $role,
						'set17'			=> $set17,
						'set18'			=> $junior,
						'set19'			=> $request->input('val05'),
						'set20'			=> $senior,
						'set21'			=> $request->input('val21'),
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idinput2 	= $input2->id;
					if ($bukti != ''){
						Filess::create([
							'url'			=> $idinput2,
							'title'			=> $tabel,
							'description'	=> 'Bukti Dukung '.$penjabaran,
							'name'			=> $bukti,
						]);
					}
					if ($set17 != ''){
						Filess::create([
							'url'			=> $idinput2,
							'title'			=> $tabel,
							'description'	=> 'Bukti Dukung '.$penjabaran,
							'name'			=> $set17,
						]);
					}
					$tuliskirim 	= 'Topik Kegiatan '.$topik.' Tanggal '.$tanggal.' Dari '.$nama.' Menunggu Verifikasi';
					$golekemail		= Simpegpegawai::where('id', $spv2)->first();
					if (isset($golekemail->email)){
						$emailub	= $golekemail->email;
						$cariiduser = User::where('email', 'LIKE', $emailub)->get();
						if (!empty($cariiduser)){
							foreach ($cariiduser as $rowid){
								$idcaritoken	= $rowid->id;
								$jtokencari		= Firebasebank::where('userid', $idcaritoken)->get();
								if (!empty($jtokencari)){
									foreach ( $jtokencari as $rtokencari ){
										$firebaseid = $rtokencari->firebase;
										$msg = array (
											'message' 	=> $tuliskirim,
											'title'		=> 'SIAPDOK',
											'subtitle'	=> 'Universitas Brawijaya',
											'tickerText'=> 'Verifikasi',
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
												"title" => 'INSITU FK UB',
												"sound" => "default",
												"body" 	=> $tuliskirim
											],
											'data'			=> $msg
											
										);
										$headers = array
										(
											'Authorization: key=' . API_ACCESS_KEY,
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
					}
				}
				if ($spv3 != ''){
					$input3 = Pendidikan::create([
						'kodejenis'		=> $kodejenis,
						'kodedosen'		=> $spv3,
						'deskripsi'		=> $subpenjabaran,
						'sks'			=> 0,
						'namamhs'		=> $nama,
						'nimmhs'		=> $nim,
						'semester'		=> $semester,
						'tanggal'		=> $tanggal,
						'satuan'		=> 'Mahasiswa',
						'kegiatan'		=> '1',
						'angka'			=> $angka,
						'bukti'			=> $bukti,
						'marking'		=> 'penugasan-'.$golekid,
						'verifikator'	=> '',
						'status'		=> '',
						'jabatan'		=> '',
						'kodeps'		=> $idps,
						'namaps'		=> $namaps,
						'jenjangps'		=> $jenjangps,
						'kesesuaian'	=> '',
						'lingkup'		=> '',
						'set04'			=> $deskripsi,
						'set05'			=> $topik,
						'set06'			=> $waktu,
						'set07'			=> $penjabaran,
						'set08'			=> $durasi,
						'set09'			=> $rumahsakit,
						'set10'			=> $rumahsakitnama,
						'set11'			=> $laborat,
						'set12'			=> $request->input('val14'),
						'set13'			=> $request->input('val15'),
						'set14'			=> $request->input('val16'),
						'set15'			=> $request->input('val17'),
						'set16'			=> $role,
						'set17'			=> $set17,
						'set18'			=> $junior,
						'set19'			=> $request->input('val05'),
						'set20'			=> $senior,
						'set21'			=> $request->input('val21'),
						'set22'			=> Session('fakultas'),
						'set23'			=> $klmkerja,
					]);
					$idinput3 	= $input3->id;
					if ($bukti != ''){
						Filess::create([
							'url'			=> $idinput3,
							'title'			=> $tabel,
							'description'	=> 'Bukti Dukung '.$penjabaran,
							'name'			=> $bukti,
						]);
					}
					if ($set17 != ''){
						Filess::create([
							'url'			=> $idinput3,
							'title'			=> $tabel,
							'description'	=> 'Bukti Dukung '.$penjabaran,
							'name'			=> $set17,
						]);
					}
					$tuliskirim 	= 'Topik Kegiatan '.$topik.' Tanggal '.$tanggal.' Dari '.$nama.' Menunggu Verifikasi';
					$golekemail		= Pegawai::where('no', $spv3)->first();
					if (isset($golekemail->email)){
						$emailub	= $golekemail->email;
						$cariiduser = User::where('email', 'LIKE', $emailub)->get();
						if (!empty($cariiduser)){
							foreach ($cariiduser as $rowid){
								$idcaritoken	= $rowid->id;
								$jtokencari		= Firebasebank::where('userid', $idcaritoken)->get();
								if (!empty($jtokencari)){
									foreach ( $jtokencari as $rtokencari ){
										$firebaseid = $rtokencari->firebase;
										$msg = array (
											'message' 	=> $tuliskirim,
											'title'		=> 'SIAPDOK',
											'subtitle'	=> 'Universitas Brawijaya',
											'tickerText'=> 'Verifikasi',
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
												"title" => 'INSITU FK UB',
												"sound" => "default",
												"body" 	=> $tuliskirim
											],
											'data'			=> $msg
											
										);
										$headers = array
										(
											'Authorization: key=' . API_ACCESS_KEY,
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
					}
				}
			} else {
				$getawal	= Pendidikan::where('id', $idne)->first();
				$buktiawal	= $getawal->bukti;
				$set17awal	= $getawal->set17;
				if ($set17 == ''){ $set17 =  $set17awal; }
				if ($bukti == ''){ $bukti =  $buktiawal; }
				$input 		= Pendidikan::where('id', $idne)->update([
					'kodejenis'		=> $kodejenis,
					'kodedosen'		=> $masterno,
					'deskripsi'		=> $subpenjabaran,
					'namamhs'		=> $nama,
					'nimmhs'		=> $nim,
					'semester'		=> $semester,
					'tanggal'		=> $tanggal,
					'angka'			=> $angka,
					'kodeps'		=> $idps,
					'namaps'		=> $namaps,
					'jenjangps'		=> $jenjangps,
					'set04'			=> $deskripsi,
					'set05'			=> $topik,
					'set06'			=> $waktu,
					'set07'			=> $penjabaran,
					'set08'			=> $durasi,
					'set09'			=> $rumahsakit,
					'set10'			=> $rumahsakitnama,
					'set11'			=> $laborat,
					'set12'			=> $request->input('val14'),
					'set13'			=> $request->input('val15'),
					'set14'			=> $request->input('val16'),
					'set15'			=> $request->input('val17'),
					'set16'			=> $role,
					'set17'			=> $set17,
					'set18'			=> $junior,
					'set19'			=> $request->input('val05'),
					'set20'			=> $senior,
					'set21'			=> $request->input('val21'),
					'bukti'			=> $bukti,
					'set23'			=> $klmkerja,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			}
			if ($input){
				Aktifitas::create([
					'unique_id'		=> $masterno,
					'kelompok'		=> Session('previlage'), 
					'keterangan'	=> 'Tambah Data '.$penjabaran, 
					'verifikator'	=> ''
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $penjabaran.' berhasil di input']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Input Mohon Ulangi Beberapa Saat Lagi']);
				return back();
			}
		}
    }
//END PENGISIAN
	public function exDestroyer(Request $request) {
		$idne	= $request->input('set01');
		$tabel	= $request->input('set02');
		if (null !== $request->input('set03')){
			$jenis = $request->input('set03');
		} else { $jenis = ''; }
		if ($tabel == 'gambar'){
			$getfiless	= Filess::where('id', $idne)->first();
			$name 		= $getfiless->name;
			if ($name != ''){
				if (File::exists(base_path()) ."/public/scan/files/". $name) {
					File::delete(base_path() ."/public/scan/files/". $name);
				}
				if (File::exists(base_path()) ."/public/". $name) {
					File::delete(base_path() ."/public/". $name);
				}
			}
			$hapus = Filess::where('id', $idne)->delete();
			if ($hapus){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$tabel.' Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Verifikasi Gagal, Silahkan Hubungi Tim TI Terkait Error ini. Kode Error : '.$tabel.'-'.$idne]);
				return back();
			}
		}
		else if ($tabel == 'penelitian'){
			$rmaster 	= Penelitian::where('id', $idne)->first();
			$getfiless	= Filess::where('url', $idne)->where('title', $tabel)->get();
			if (!empty($getfiless)){
				foreach($getfiless as $row){
					$title 		= $row->title;
					$name 		= $row->name;
					if ($name != ''){
						if (File::exists(base_path()) ."/public/scan/files/". $name) {
							File::delete(base_path() ."/public/scan/files/". $name);
						}
						if (File::exists(base_path()) ."/public/". $name) {
							File::delete(base_path() ."/public/". $name);
						}
					}
					
				}
			}
			$hapus = Penelitian::where('id', $idne)->delete();
			if ($hapus){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$tabel.' '.$jenis.' Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Verifikasi Gagal, Silahkan Hubungi Tim TI Terkait Error ini. Kode Error : '.$tabel.'-'.$idne]);
				return back();
			}
		}
		else if ($tabel == 'pengajaran'){
			$rmaster 	= Pendidikan::where('id', $idne)->first();
			$getfiless	= Filess::where('url', $idne)->where('title', $tabel)->get();
			if (!empty($getfiless)){
				foreach($getfiless as $row){
					$title 		= $row->title;
					$name 		= $row->name;
					if ($name != ''){
						if (File::exists(base_path()) ."/public/scan/files/". $name) {
							File::delete(base_path() ."/public/scan/files/". $name);
						}
						if (File::exists(base_path()) ."/public/". $name) {
							File::delete(base_path() ."/public/". $name);
						}
					}
					
				}
			}
			$hapus = Pendidikan::where('id', $idne)->delete();
			if ($hapus){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$tabel.' '.$jenis.' Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Verifikasi Gagal, Silahkan Hubungi Tim TI Terkait Error ini. Kode Error : '.$tabel.'-'.$idne]);
				return back();
			}
		}
		else if ($tabel == 'pengabdian'){
			$rmaster 	= Pengabdian::where('id', $idne)->first();
			$getfiless	= Filess::where('url', $idne)->where('title', $tabel)->get();
			if (!empty($getfiless)){
				foreach($getfiless as $row){
					$title 		= $row->title;
					$name 		= $row->name;
					if ($name != ''){
						if (File::exists(base_path()) ."/public/scan/files/". $name) {
							File::delete(base_path() ."/public/scan/files/". $name);
						}
						if (File::exists(base_path()) ."/public/". $name) {
							File::delete(base_path() ."/public/". $name);
						}
					}
					
				}
			}
			$hapus = Pengabdian::where('id', $idne)->delete();
			if ($hapus){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$tabel.' '.$jenis.' Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Verifikasi Gagal, Silahkan Hubungi Tim TI Terkait Error ini. Kode Error : '.$tabel.'-'.$idne]);
				return back();
			}
		}
		else if ($tabel == 'penunjang'){
			$rmaster 	= Penunjang::where('id', $idne)->first();
			$getfiless	= Filess::where('url', $idne)->where('title', $tabel)->get();
			if (!empty($getfiless)){
				foreach($getfiless as $row){
					$title 		= $row->title;
					$name 		= $row->name;
					if ($name != ''){
						if (File::exists(base_path()) ."/public/scan/files/". $name) {
							File::delete(base_path() ."/public/scan/files/". $name);
						}
						if (File::exists(base_path()) ."/public/". $name) {
							File::delete(base_path() ."/public/". $name);
						}
					}
					
				}
			}
			$hapus = Penunjang::where('id', $idne)->delete();
			if ($hapus){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data '.$tabel.' '.$jenis.' Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Verifikasi Gagal, Silahkan Hubungi Tim TI Terkait Error ini. Kode Error : '.$tabel.'-'.$idne]);
				return back();
			}
		}
		else if ($tabel == 'kerjasama'){
			$rmaster1 	= Kontrakkerja::where('id', $idne)->first();
			$link 		= $rmaster1->link;
			$outputdir1	= "../scan/files/";
			$outputdir2	= "../scan/files/thumbnail/";
			if ($link != ''){
				unlink($outputdir1.$link);
				unlink($outputdir2.$link);
			}
			$input = Kontrakkerja::where('id', $idne)->delete();
		}
		else {
			$outputdir1	= "../scan/files/";
			$outputdir2	= "../scan/files/thumbnail/";
		}
	}
	public function viewCV($id){
		$data		= [];
		$idpeg		= $id;
		$biodata	= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $idpeg)
					->first();
		$foto			= $biodata->foto;
		$getjabatan	= User::where('nip', $idpeg)->first();
		if (isset($getjabatan->tandatangan)){
			$jabatan	= $getjabatan->privilage;
			$tandatangan= $getjabatan->tandatangan;
		} else {
			$gettandatangan	= Pejabatsurat::where('nip', $biodata->nip_baru)->first();
			if (isset($gettandatangan->pejabat)){
				$jabatan	= $gettandatangan->pejabat;
				$tandatangan= $gettandatangan->tandatangan;
			} else {
				$jabatan	= '';
				$tandatangan= '';
			}
		}
					
		$homebase			= 	url("/");
		if ($foto != ''){
			$foto	= str_replace('photo/', '', $foto);
		} else { $foto 	= '1578499052.jpg'; }
		$foto				= 	$homebase.'/images/pegawai/'.$foto;
		$tahunlulussma 		= 	date("Y");
		$tahunluluskuliah 	= 	date("Y-m-d");
		
		$getpendidikan      =   Detailpendidikan::where('no', $id)->orderBy('tahunmsk', 'ASC')->get();
		$pendidikan         =   [];
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
		$kalender   				= 	array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd            				=   date("d");
		$mm            				=   (int)date("m");
		$mm							= 	$kalender[$mm];
		$tahuniki           		=   date("Y");
		$tglcetak					= 	$dd.' '.$mm.' '.$tahuniki;
		$cekgolongan 		= Golongan::where('kode', $biodata->golongan)->first();
		if (isset($cekgolongan->pangkat)){
			$data['tulispangkat']	= $cekgolongan->pangkat;
			$data['tulisgolongan']	= $cekgolongan->golongan;
		} else {
			$data['tulispangkat']	= $biodata->pangkat;
			$data['tulisgolongan']	= $biodata->golongan;	
		}
		$data['tandatangan']= $tandatangan;
		$data['jabatan']	= $jabatan;
		$data['tglcetak']	= $tglcetak;
		$data['biodata']	= $biodata;
		$data['tglcetak']	= $tglcetak;
		$data['pendidikan']	= $pendidikan;
		$data['diklat']		= $diklat;
		$data['pangkat']	= $pangkat;
		$data['fungsional']	= $fungsional;
		$data['penghargaan']= $penghargaan;
		$data['sutri']		= $sutri;
		$data['ortu']		= $ortu;
		$data['anak']		= $anak;
		$data['mertua']		= $mertua;
		$data['saudara']	= $saudara;
		$data['kursus']		= [];
		$data['foto']		= $foto;
		return view('cetak.cv', $data);
	}
	public function jsonDatadetaktifidosen(Request $request) {
    	$masterno	= $request->input('val01');
		$tahun		= $request->input('val02');
		$arraydata	= [];
		$getpegawai	= Simpegpegawai::where('id', $masterno)->first();
		if (isset($getpegawai->nama_lengkap)){
			$nama 		= $getpegawai->nama_lengkap;
			$nip_baru 	= $getpegawai->nip_baru;
			$idregptk	= $getpegawai->idregptk;
		} else {
			$nama 		= '';
			$nip_baru 	= '';
			$idregptk	= '';
		}
		if ($idregptk != ''){
			$getdataajar = AjarFeeder::where('tahun', $tahun)->where('id_reg_ptk', $idregptk)->where('ket', '!=', 'sudah')->get();
		}else {
			$getdataajar = AjarFeeder::where('tahun', $tahun)->where('nip', $nip_baru)->where('ket', '!=', 'sudah')->get();
		}
		if(!empty($getdataajar)){
			foreach($getdataajar as $hasil){
				$jenjang 	= $hasil->jenjang;
				$pees 		= $hasil->pees;
				$kelas 		= $hasil->fk__id_kls;
				$kodemk 	= $hasil->kode_mk;
				$nipajar	= $hasil->nip;
				$namamk		= $hasil->nm_mk;
				$sks 		= $hasil->sks_subst_tot;
				$rencana 	= $hasil->jml_tm_renc;
				$realisasi 	= $hasil->jml_tm_real;
				$tahun 		= $hasil->tahun;
				$semester 	= $hasil->semester;
				$tlssemester= $tahun.$semester;
				$valcari	= $kodemk.$kelas.$tlssemester.$jenjang.$pees.$nipajar;
				$deskripsi	= $namamk.' Kelas '.$kelas.' PS. '.$pees.' Jenjang '.$jenjang;
				$cekupload	= Filess::where('title', 'Melaksanakan perkulihan pada mahasiswa')->where('description', $valcari)->groupBy('name')->first();
				if (isset($cekupload->name)){
					$nmfile = $cekupload->name;
				} else { $nmfile = ''; }
				$ceksudah	= Pendidikan::where('kodedosen', $masterno)->where('kodejenis', '201100')->where('deskripsi', $deskripsi)->count();
				if ($ceksudah == 0){
					$input = Pendidikan::create([
						'kodejenis'			=> '201100', 
						'kodedosen'			=> $masterno, 
						'deskripsi'			=> $deskripsi, 
						'sks'				=> $sks, 
						'namamhs'			=> '', 
						'nimmhs'			=> '', 
						'semester'			=> $tlssemester, 
						'tanggal'			=> '', 
						'satuan'			=> '', 
						'kegiatan'			=> '', 
						'angka'				=> '', 
						'bukti'				=> $nmfile, 
						'marking'			=> $hasil->id, 
						'verifikator'		=> '', 
						'status'			=> ''
					]);
					if ($input){
						AjarFeeder::where('id', $hasil->id)->update([
							'ket' => 'sudah'
						]);
					}
				}
			}
		}
		$getdpendidikan = Pendidikan::where('semester', 'LIKE', '%'.$tahun.'%')->orWhere('tanggal', 'LIKE', '%'.$tahun.'%')->where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
		if(!empty($getdpendidikan)){
			foreach($getdpendidikan as $hasil){
				$kodejenis 		= $hasil->kodejenis;
				$deskripsi 		= $hasil->deskripsi;
				$namamhs 		= $hasil->namamhs;
				$nimmhs 		= $hasil->nimmhs;
				$sks 			= $hasil->sks;
				$tanggal 		= $hasil->tanggal;
				$semester 		= $hasil->semester;
				$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
				$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
				if($getrubrikpak != 0){
					$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else if($getrubrikbkd != 0){
					$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else {
					$penjabaran 	= '';
					$subpenjabaran 	= '';
					$id1			= '';
					$id2			= '';
					$id3			= '';
					$id4			= '';
					$id5			= '';
					$id6			= '';
					$id7			= '';
					$id8			= '';
					$id9			= '';
					$id10			= '';
				}
				if ($id5 != ''){
					$deskripsi = $id3.' '.$id4.' '.$id5;
				} else {
					if ($id4 != ''){
						$deskripsi = $id3.' '.$id4;
					} else {
						$deskripsi = $id3;
					}
				}
				if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
					else { $tulis = $penjabaran; }
				if ( $kodejenis == '204130' or $kodejenis == '204230' ){ 
					$deskripsi 	= $deskripsi.' '.$namamhs.'('.$nimmhs.')'; 
				}
				if ( $kodejenis == '205100' or $kodejenis == '205200' ){ 
					$deskripsi 	= $deskripsi.' '.$namamhs.'('.$nimmhs.')';
					$tanggal 	= $semester;
				}
				if ($kodejenis == '201100'){ 
					$deskripsi 	= $deskripsi.' ('.$sks.')'; 
					$tanggal 	= $semester;
				}
				$arraydata[] = array(
					'idne' 		=> $hasil->id,		
					'nama' 		=> $nama,
					'kodedosen' => $masterno,
					'kodejenis' => $kodejenis,
					'tulis' 	=> $tulis,
					'deskripsi' => $deskripsi,
					'sks' 		=> $hasil->sks,
					'namamhs' 	=> $hasil->namamhs,
					'nimmhs' 	=> $hasil->nimmhs,
					'semester' 	=> $hasil->semester,
					'tanggal' 	=> $tanggal,
					'satuan' 	=> $hasil->satuan,
					'kegiatan' 	=> $hasil->kegiatan,
					'angka' 	=> $hasil->angka,
					'bukti' 	=> $hasil->bukti,
					'nmfile' 	=> $hasil->nmfile,
					'marking' 	=> $hasil->marking,
					'tabel' 	=> 'akademik',
					'set01' 	=> $id1,
					'set02' 	=> $id2,
					'set03' 	=> $id3,
					'set04' 	=> $id4,
					'set05' 	=> $id5,
					'set06' 	=> $id6,
					'set07' 	=> $id7,
					'set08' 	=> $id8,
					'set09' 	=> $id9,
					'set10' 	=> $id10,
				);
			}
		}
		$getdpenelitian = Penelitian::where('tahun', $tahun)->where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
		if(!empty($getdpenelitian)){
			foreach($getdpenelitian as $hasil){
				$kodejenis 		= $hasil->kodejenis;
				$deskripsi 		= $hasil->deskripsi;
				$namamhs 		= $hasil->namamhs;
				$nimmhs 		= $hasil->nimmhs;
				$sks 			= $hasil->sks;
				$tanggal 		= $hasil->tanggal;
				$semester 		= $hasil->semester;
				$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
				$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
				if($getrubrikpak != 0){
					$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else if($getrubrikbkd != 0){
					$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else {
					$penjabaran 	= '';
					$subpenjabaran 	= '';
					$id1			= '';
					$id2			= '';
					$id3			= '';
					$id4			= '';
					$id5			= '';
					$id6			= '';
					$id7			= '';
					$id8			= '';
					$id9			= '';
					$id10			= '';
				}
				if ($id5 != ''){
					$deskripsi = $id3.' '.$id4.' '.$id5;
				} else {
					if ($id4 != ''){
						$deskripsi = $id3.' '.$id4;
					} else {
						$deskripsi = $id3;
					}
				}
				if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
				else { $tulis = $penjabaran; }
				
				$arraydata[] = array(
					'idne' 		=> $hasil->id,		
					'nama' 		=> $nama,
					'kodedosen' => $masterno,
					'kodejenis' => $kodejenis,
					'tulis' 	=> $tulis,
					'deskripsi' => $deskripsi,
					'sks' 		=> $hasil->sks,
					'namamhs' 	=> $hasil->namamhs,
					'nimmhs' 	=> $hasil->nimmhs,
					'semester' 	=> $hasil->semester,
					'tanggal' 	=> $tanggal,
					'satuan' 	=> $hasil->satuan,
					'kegiatan' 	=> $hasil->kegiatan,
					'angka' 	=> $hasil->angka,
					'bukti' 	=> $hasil->bukti,
					'nmfile' 	=> $hasil->nmfile,
					'marking' 	=> $hasil->marking,
					'tabel' 	=> 'penelitian',
					'set01' 	=> $id1,
					'set02' 	=> $id2,
					'set03' 	=> $id3,
					'set04' 	=> $id4,
					'set05' 	=> $id5,
					'set06' 	=> $id6,
					'set07' 	=> $id7,
					'set08' 	=> $id8,
					'set09' 	=> $id9,
					'set10' 	=> $id10,
				);
			}
		}
		$getdpengabdian = Pengabdian::where('tahun', $tahun)->where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
		if(!empty($getdpengabdian)){
			foreach($getdpengabdian as $hasil){
				$kodejenis 		= $hasil->kodejenis;
				$deskripsi 		= $hasil->deskripsi;
				$namamhs 		= $hasil->namamhs;
				$nimmhs 		= $hasil->nimmhs;
				$sks 			= $hasil->sks;
				$tanggal 		= $hasil->tanggal;
				$semester 		= $hasil->semester;
				$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
				$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
				if($getrubrikpak != 0){
					$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else if($getrubrikbkd != 0){
					$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else {
					$penjabaran 	= '';
					$subpenjabaran 	= '';
					$id1			= '';
					$id2			= '';
					$id3			= '';
					$id4			= '';
					$id5			= '';
					$id6			= '';
					$id7			= '';
					$id8			= '';
					$id9			= '';
					$id10			= '';
				}
				if ($id5 != ''){
					$deskripsi = $id3.' '.$id4.' '.$id5;
				} else {
					if ($id4 != ''){
						$deskripsi = $id3.' '.$id4;
					} else {
						$deskripsi = $id3;
					}
				}
				if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
				else { $tulis = $penjabaran; }
				
				$arraydata[] = array(
					'idne' 		=> $hasil->id,		
					'nama' 		=> $nama,
					'kodedosen' => $masterno,
					'kodejenis' => $kodejenis,
					'tulis' 	=> $tulis,
					'deskripsi' => $deskripsi,
					'sks' 		=> $hasil->sks,
					'namamhs' 	=> $hasil->namamhs,
					'nimmhs' 	=> $hasil->nimmhs,
					'semester' 	=> $hasil->semester,
					'tanggal' 	=> $tanggal,
					'satuan' 	=> $hasil->satuan,
					'kegiatan' 	=> $hasil->kegiatan,
					'angka' 	=> $hasil->angka,
					'bukti' 	=> $hasil->bukti,
					'nmfile' 	=> $hasil->nmfile,
					'marking' 	=> $hasil->marking,
					'tabel' 	=> 'pengabdian',
					'set01' 	=> $id1,
					'set02' 	=> $id2,
					'set03' 	=> $id3,
					'set04' 	=> $id4,
					'set05' 	=> $id5,
					'set06' 	=> $id6,
					'set07' 	=> $id7,
					'set08' 	=> $id8,
					'set09' 	=> $id9,
					'set10' 	=> $id10,
				);
			}
		}
		$getdpenunjang = Penunjang::where('tahun', $tahun)->where('kodedosen', $masterno)->orderBy('kodejenis', 'ASC')->get();
		if(!empty($getdpenunjang)){
			foreach($getdpenunjang as $hasil){
				$kodejenis 		= $hasil->kodejenis;
				$deskripsi 		= $hasil->deskripsi;
				$namamhs 		= $hasil->namamhs;
				$nimmhs 		= $hasil->nimmhs;
				$sks 			= $hasil->sks;
				$tanggal 		= $hasil->tanggal;
				$semester 		= $hasil->semester;
				$getrubrikpak	= KategoriPAK::where('kode', $kodejenis)->count();
				$getrubrikbkd	= KategoriBKD::where('kode', $kodejenis)->count();
				if($getrubrikpak != 0){
					$rkatebkd		= KategoriPAK::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else if($getrubrikbkd != 0){
					$rkatebkd		= KategoriBKD::where('kode', $kodejenis)->first();
					$penjabaran 	= $rkatebkd->penjabaran;
					$subpenjabaran 	= $rkatebkd->subpenjabaran;
					$id1			= $rkatebkd->id;
					$id2			= $penjabaran;
					$id3			= $subpenjabaran;
					$id4			= $rkatebkd->subsubpenjabaran;
					$id5			= $rkatebkd->subsubsubpenjabaran;
					$id6			= $rkatebkd->buktidukung;
					$id7			= $rkatebkd->maksimal;
					$id8			= $rkatebkd->satuan;
					$id9			= $rkatebkd->pak;
					$id10			= $rkatebkd->bkd;
				} else {
					$penjabaran 	= '';
					$subpenjabaran 	= '';
					$id1			= '';
					$id2			= '';
					$id3			= '';
					$id4			= '';
					$id5			= '';
					$id6			= '';
					$id7			= '';
					$id8			= '';
					$id9			= '';
					$id10			= '';
				}
				if ($id5 != ''){
					$deskripsi = $id3.' '.$id4.' '.$id5;
				} else {
					if ($id4 != ''){
						$deskripsi = $id3.' '.$id4;
					} else {
						$deskripsi = $id3;
					}
				}
				if ($subpenjabaran != ''){ $tulis = $penjabaran.' - '.$subpenjabaran; }
				else { $tulis = $penjabaran; }
				
				$arraydata[] = array(
					'idne' 		=> $hasil->id,		
					'nama' 		=> $nama,
					'kodedosen' => $masterno,
					'kodejenis' => $kodejenis,
					'tulis' 	=> $tulis,
					'deskripsi' => $deskripsi,
					'sks' 		=> $hasil->sks,
					'namamhs' 	=> $hasil->namamhs,
					'nimmhs' 	=> $hasil->nimmhs,
					'semester' 	=> $hasil->semester,
					'tanggal' 	=> $tanggal,
					'satuan' 	=> $hasil->satuan,
					'kegiatan' 	=> $hasil->kegiatan,
					'angka' 	=> $hasil->angka,
					'bukti' 	=> $hasil->bukti,
					'nmfile' 	=> $hasil->nmfile,
					'marking' 	=> $hasil->marking,
					'tabel' 	=> 'penunjang',
					'set01' 	=> $id1,
					'set02' 	=> $id2,
					'set03' 	=> $id3,
					'set04' 	=> $id4,
					'set05' 	=> $id5,
					'set06' 	=> $id6,
					'set07' 	=> $id7,
					'set08' 	=> $id8,
					'set09' 	=> $id9,
					'set10' 	=> $id10,
				);
			}
		}
    	echo json_encode($arraydata);	
	}
	public function exUploader(Request $request) {
		$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');
		$homebase	= url("/");
		$idne		= $request->input('val01');
		$nmfile		= $request->input('val02');
		$datane		= $request->input('val03');
		$nmtabel	= $request->input('val04');
		$masterno	= $request->input('val06');
		$urfile		= $request->input('val07');
		$gagal		= '';
		if ($urfile == '' OR is_null($urfile)){
			if ($nmfile == ''){ $nmfile = time(); }
			$validator 	= Validator::make($request->all(), [
				'val05' =>  'mimes:jpeg,jpg,png,pdf|max:3000',
			]);
			if ($request->hasFile('val05')) {
				if($validator->fails()) {
					$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
				} else {
					$nmfile			= 'SIMBA-'.$idne.'-'.$nmfile.'.'.$request->file('val05')->getClientOriginalExtension();
					Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, $request->file('val05'));
					if ($nmtabel == 'Filess'){
						$nmfile		= $homebase.'/images/'.$masterno.'/'.$nmfile;
					}
				}
			}
		} else {
			$nmfile	= $urfile;
		}
		$keterangan = 'Upload Data Dukung '.$nmtabel;
		
		Aktifitas::create([
			'unique_id'	=> Session('id'),
			'kelompok'	=> Session('previlage'),
			'keterangan'=> $keterangan
		]);
		
		if ($nmtabel == 'DATAKEGIATAN'){
			Filess::create([
				'url'			=> $idne,
				'title'			=> $request->input('val02'),
				'description'	=> 'Bukti Dukung '.$datane,
				'name'			=> $nmfile,
			]);
		} else if ($nmtabel == 'Filess'){
			$update 	= Filess::where('id', $idne)->update([
				'description'	=> $nmfile
			]);
		} else if ($nmtabel == 'Biodata'){
			$input 	= Simpegpegawai::where('id', $idne)->update([
				'foto'	=> $nmfile
			]);
			if ($input){
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Pas Foto Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Pas Foto Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Ajar'){
			$input 	= Dataajar::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Sertifikat'){
			$input 	= Detailsertifikat::where('id', $idne)->update([
				'nmfile'	=> $nmfile
			]);	
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Asesor'){
			$input 	= Detailasesor::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);		
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Organisasi'){
			$input 	= Detailorganisasi::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);	
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Seminar'){
			$input 	= Detailseminar::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);	
			if ($input){
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Anggota Keluarga'){
			$input 	= Detailanggotakeluarga::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);	
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Mutasi'){
			$input 	= Detailmutasi::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);	

			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Identitas'){
			$datalm 	= Detailidentitas::where('id', $idne)->first();
			$buktilama 	= $datalm->bukti;
			$input 		= Detailidentitas::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			if ($input){
				if ($buktilama != ''){
					$buktilama	= 'images/'.$masterno.'/'.$buktilama;
					if (File::exists(public_path()."/".$buktilama)) {
						File::delete(public_path()."/".$buktilama);
					}
				}
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Pendidikan'){
			$input 	= Detailpendidikan::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Pangkat'){
			$input 	= Detailpangkat::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Fungsional'){
			$input 	= Detailfungsional::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Sertifikasi'){
			$input 	= Detailsertifikasi::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Gaji'){
			$input 	= Detailgaji::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Diklat'){
			$input 	= Detaildiklat::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'Data Penghargaan'){
			$input 	= Detailpenghargaan::where('id', $idne)->update([
				'bukti'	=> $nmfile
			]);
			
			if ($input){
				
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						Bukti Untuk '.$datane.' Berhasil Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'pelaksanaanakademik'){
			if ($datane == 'Melaksanakan perkulihan pada mahasiswa'){
				$qgetdata	= $pdo->prepare("SELECT * FROM db_AjarFeeder WHERE id = ?;");
				$qgetdata->execute(array($idne));
				$hasil  	= $qgetdata->fetch(PDO::FETCH_ASSOC);
				$jenjang 	= $hasil->jenjang;
				$pees 		= $hasil->pees;
				$kelas 		= $hasil->fk__id_kls;
				$kodemk 	= $hasil->kode_mk;
				$nipajar	= $hasil->nip;
				$namamk		= $hasil->nm_mk;
				$sks 		= $hasil->sks_subst_tot;
				$rencana 	= $hasil->jml_tm_renc;
				$realisasi 	= $hasil->jml_tm_real;
				$tahun 		= $hasil->tahun;
				$semester 	= $hasil->semester;
				$tlssemester= $tahun.$semester;
				$valcari	= $kodemk.$kelas.$tlssemester.$jenjang.$pees.$nipajar;
				$input 		= Filess::create([
					'url'			=> $idne,
					'title'			=> $datane,
					'description'	=> $valcari,
					'name'			=> $nmfile,
				]);
			}else {
				$input = Pendidikan::where('id', $idne)->update([
					'nmfile'	=> $nmfile
				]);
				Filess::create([
					'url'			=> $idne,
					'title'			=> $datane,
					'description'	=> '',
					'name'			=> $nmfile,
				]);
			}
			if ($input){
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						'.$datane.' Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else if ($nmtabel == 'datapenunjang'){
			$input = Penunjang::where('id', $idne)->update([
				'nmfile'	=> $nmfile
			]);
			if ($input){		
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Success 
						</strong>
						'.$datane.' Tersimpan
					</div>';
			}
			else {
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<strong>
							<i class="ace-icon fa fa-times"></i>
							Gagal 
						</strong>
						Upload Gagal, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		} else {
			$input 	= Mappingdosen::create([
				'idpees'	=> $nmfile,
				'no'		=> $idne,
				'status'	=> $datane,
				'fungsional'=> $nmtabel,
			]);
			
		}
	}
	public function exDataajardosen(Request $request) {
		$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');

		$masterno	= $request->input('val01');
		$jabatan	= $request->input('val02');
		$kodeps		= $request->input('val03');
		$matakuliah	= $request->input('val04');
		$sesuai		= $request->input('val05');
		$lingkup	= $request->input('val06');
		$jenis		= $request->input('val07');
		$idne		= $request->input('val08');
		$sukses		= '';
		$gagal		= '';

		if ($jenis == 'tambahpraktisi'){
			if ($masterno != '' AND $jabatan != '' AND $kodeps != '' AND $matakuliah != ''){
				$nidn		= $request->input('val09');
				$sekolah	= $request->input('val10');
				$rmaster 	= Matkul::where('namamk', $matakuliah)->first();
				if (isset($rmaster->bobot)){
					$bobot 		= $rmaster->bobot;
				} else { $bobot = 0; }
				$count 		= Dosen::where('nama', $masterno)->where('nidn', $nidn)->where('pendidikan', $lingkup)->where('bidang', $sesuai)->where('struktural', 'PRAKTISI')->count();
				if ($count == 0){
					$getid 		= Dosen::orderBy('id', 'DESC')->first();
					if (isset($getid->id)){
						$idlawas	= $getid->id;
					} else { $idlawas = 0; }

					$idbaru		= $idlawas + 1;
					$input 		= Dosen::create([
						'id'			=> $idbaru, 
						'nama'			=> $masterno, 
						'nidn'			=> $nidn, 
						'pendidikan'	=> $lingkup, 
						'bidang'		=> $sesuai, 
						'gelar'			=> $masterno, 
						'sekolah'		=> $sekolah,
						'nip'			=> '', 
						'kode'			=> '', 
						'pangkat'		=> '', 
						'fungsional'	=> '', 
						'struktural'	=> 'PRAKTISI',
						'unitkerja'		=> Session('fakultas'), 
						'id_sms'		=> '',
						'id_reg_ptk'	=> '',
						'ctkmarking'	=> ''
					]);		
				}
				else {
					$rmaster 	= Dosen::where('nama', $masterno)->where('nidn', $nidn)->where('pendidikan', $lingkup)->where('bidang', $sesuai)->where('struktural', 'PRAKTISI')->first();
					$idbaru		= $rmaster->id;
					$input 		= Dosen::where('id', $idbaru)->update([
						'sekolah'		=> $sekolah,
						'ctkmarking'	=> date('Y-m-d H:i:s')
					]);		
				}
				if ($input){
					
					$keterangan = 'Input Data Dosen Praktisi';
					Aktifitas::create([
						'unique_id'	=> Session('id'),
						'kelompok'	=> Session('previlage'),
						'keterangan'=> $keterangan
					]);
					if ($idne == 'new'){
						$simpan = Dosenpraktisiajar::create([
							'no'			=> $idbaru,
							'matakuliah'	=> $matakuliah,
							'sks'			=> $bobot,
							'kodeps'		=> $kodeps,
							'sesuai'		=> '1',
							'lingkup'		=> '1',
							'timestamp'		=> date('Y-m-d H:i:s')
						]);
					}
					else {
						$simpan = Dosenpraktisiajar::where('id', $idne)->update([
							'no'			=> $idbaru,
							'matakuliah'	=> $matakuliah,
							'sks'			=> $bobot,
							'kodeps'		=> $kodeps,
							'timestamp'		=> date('Y-m-d H:i:s')
						]);
						
					}
					if ($simpan){
						echo '<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							Data Dosen Ajar Praktisi berhasil di simpan
						</div>';
					}
					else {
						echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						System down, please try again in a few years....!!!
					</div>';
					}
				}
				else {
					echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						System down, please try again in a few years....!!!
					</div>';
				}
				
			}
			else {
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				</div>';
			}
		}
		else if ($jenis == 'hapuspraktisi'){
			if ($idne == 'new'){
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Tidak ada data yang perlu di hapus
				</div>';
			}
			else {
				$input = Dosenpraktisiajar::where('id', $idne)->delete();
				if ($input) { 
					echo '<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Data Dosen Ajar Praktisi berhasil di hapus
					</div>';
				}
				else { 
					echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						System down, please try again in a few years....!!!
					</div>';
				}
			}
		}
		else {
			if ($jabatan != '' AND $kodeps != '' AND $matakuliah != '' AND $sesuai != ''){
				$rmaster 	= Matkul::where('namamk', $matakuliah)->first();
				if (isset($rmaster->bobot)){
					$bobot 		= $rmaster->bobot;
				} else { $bobot = 0; }
				
				if ($jenis == 'tambah'){	
					$input 		= Dataajar::create([
						'no'				=> $masterno,
						'rekappendidikan'	=> '',
						'rekapkeahlian'		=> '',
						'jabatanakad'		=> $jabatan,
						'rekapserpro'		=> '',
						'rekapserkompro'	=> '',
						'matakuliah'		=> $matakuliah,
						'sks'				=> $bobot,
						'kodeps'			=> $kodeps,
						'sesuai'			=> $sesuai,
						'lingkup'			=> $lingkup,
						'bukti'				=> '',
						'timestamp'			=> date("Y-m-d H:i:s")
					]);	
					if ($input) { $sukses = 'Sukses Menambahkan Data'; }
					else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
				}
				if ($jenis == 'ubah'){
					$input 		= Dataajar::where('id', $idne)->update([
						'jabatanakad'		=> $jabatan,
						'matakuliah'		=> $matakuliah,
						'sks'				=> $bobot,
						'kodeps'			=> $kodeps,
						'sesuai'			=> $sesuai,
						'lingkup'			=> $lingkup,
						'timestamp'			=> date("Y-m-d H:i:s")
					]);	
					
					if ($input) { $sukses = 'Sukses Mengubah Data'; }
					else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
				}
				if ($jenis == 'hapus'){	
					$input 	= Dataajar::where('id', $idne)->delete();
					if ($input) { $sukses = 'Sukses Menghapus Data'; }
					else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
				}
				if ($sukses != ''){
					$keterangan = 'Update Data Ajar';
					Aktifitas::create([
						'unique_id'	=> Session('id'),
						'kelompok'	=> Session('previlage'),
						'keterangan'=> $keterangan
					]);
					Aktifitas::create([
						'unique_id'	=> $masterno,
						'kelompok'	=> 'Dosen',
						'keterangan'=> $keterangan
					]);			
					echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						'.$sukses.'
					</div>';
				}
				else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						'.$gagal.'
					</div>';
				}
			}
			else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Pastikan Semua Isian Terisi Dengan Benar
					</div>';
			}
		}
	}
	public function jsonDatajdataajar(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$ceksek		= Detailpegawai::where('no', $masterno)->count();
		if ($ceksek == 0){
			Detailpegawai::create([
				'no'			=> $masterno, 
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
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$rsurat			= Dataajar::where('no', $masterno)->get();
		$arraydata		= [];
		
		if (!empty($rsurat)){ 
			foreach ($rsurat as $hasil) {
				$kodeps = $hasil->kodeps;
				$sesuai = $hasil->sesuai;
				$sesuaia= '';
				$sesuaib= '';
				if ($sesuai == 1){ $sesuaia = '&radic;'; }
				else { $sesuaib = '&radic;'; }
				$qpses		= MasterPS::where('id', $kodeps)->first();
				if (isset($qpses->nama)){
					$namaps		= $qpses->nama;
					$jenjang 	= $qpses->jenjang;
					$tulis		= $namaps.' '.$jenjang;	
				} else {
					$namaps		= 'Deleted Data PS';
					$jenjang 	= 'Deleted Data PS';
					$tulis		= $namaps.' '.$jenjang;
				}
				
				$arraydata[] = array(
					'id' 			=> $hasil->id,
					'no' 			=> $hasil->no,
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'jabatanakad' 	=> $hasil->jabatanakad,
					'matakuliah' 	=> $hasil->matakuliah,
					'sks' 			=> $hasil->sks,
					'sesuai' 		=> $hasil->sesuai,
					'tulis'			=> $tulis,
					'kodeps'		=> $kodeps,
					'sesuaia'		=> $sesuaia,
					'sesuaib'		=> $sesuaib,
					'bukti' 		=> $hasil->bukti,
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exDatasertifikat(Request $request) {
    	$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');
		$masterno	= $request->input('val01');
		$jenissert	= $request->input('val02');
		$negara		= $request->input('val03');
		$pemberi	= $request->input('val04');
		$tahun		= $request->input('val05');
		$namasert	= $request->input('val06');
		$jenis		= $request->input('val07');
		$idne		= $request->input('val08');
		$sukses		= '';
		$gagal		= '';

		if ($jenissert != '' AND $namasert != '' AND $tahun != '' AND $pemberi != '' AND $negara != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailsertifikat::create([
					'no'			=> $masterno,
					'jenis'			=> $jenissert,
					'tahun'			=> $tahun,
					'nama'			=> $namasert,
					'pemberi'		=> $pemberi,
					'negara'		=> $negara,
					'nmfile'		=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);		
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailsertifikat::where('id', $idne)->update([
					'no'			=> $masterno,
					'jenis'			=> $jenissert,
					'tahun'			=> $tahun,
					'nama'			=> $namasert,
					'pemberi'		=> $pemberi,
					'negara'		=> $negara,
					'timestamp'		=> date("Y-m-d H:i:s")
				]);		
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailsertifikat::where('id', $idne)->first();
				$nmfile			= $rmaster->nmfile;
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
					Aktifitas::create([
						'unique_id'	=> $masterno,
						'kelompok'	=> 'Delete',
						'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
					]);
				}
				$input 		= Detailsertifikat::where('id', $idne)->delete();	
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Sertifikat';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);
						
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					'.$sukses.'
				</div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				</div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				</div>';
		}
	}
	public function jsondatajdataSertifikat(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailsertifikat::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> $hasil->id,
					'no' 			=> $hasil->no,
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'jenis' 		=> $hasil->jenis,
					'tahun' 		=> $hasil->tahun,
					'namasertifikat'=> $hasil->nama,
					'instansi' 		=> $hasil->pemberi,
					'negara' 		=> $hasil->negara,
					'nmfile' 		=> $hasil->nmfile,
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exDataasesor(Request $request) {
		$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');

		$masterno	= $request->input('val01');
		$dosen1		= $request->input('val02');
		$dosen2		= $request->input('val03');
		$keterangan	= $request->input('val04');
		$semester	= $request->input('val05');
		$thnakad	= $request->input('val06');
		$jenis		= $request->input('val07');
		$idne		= $request->input('val08');
		$sukses		= '';
		$gagal		= '';
		if ($keterangan == ''){ $keterangan = '-'; }
		if ($semester != '' AND $thnakad != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailasesor::create([
					'no'			=> $masterno,
					'dosen1'		=> $dosen1,
					'dosen2'		=> $dosen2,
					'keterangan'	=> $keterangan,
					'semester'		=> $semester,
					'tahunakad'		=> $thnakad,
					'bukti'			=> '',
					'timestamp'		=> date('Y-m-d H:i:s')
				]);
				
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailasesor::where('id', $idne)->update([
					'no'			=> $masterno,
					'dosen1'		=> $dosen1,
					'dosen2'		=> $dosen2,
					'keterangan'	=> $keterangan,
					'semester'		=> $semester,
					'tahunakad'		=> $thnakad,
					'timestamp'		=> date('Y-m-d H:i:s')
				]);
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailasesor::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
					Aktifitas::create([
						'unique_id'	=> $masterno,
						'kelompok'	=> 'Delete',
						'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
					]);
				}
				$input 		= Detailasesor::where('id', $idne)->delete();	
				
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Asesor';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					'.$sukses.'
				</div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				</div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				</div>';
		}
	}
	public function jsonDataasesor(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailasesor::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> $hasil->id,
					'no' 			=> $hasil->no,
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'dosen1' 		=> $hasil->dosen1,
					'dosen2' 		=> $hasil->dosen2,
					'keterangan' 	=> $hasil->keterangan,
					'semester'		=> $hasil->semester,
					'tahunakad'		=> $hasil->tahunakad,
					'bukti'			=> $hasil->bukti,
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exDataorganisasi(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$jabpejabat		= $request->input('val02');
		$kedudukan		= $request->input('val03');
		$mulai			= $request->input('val04');
		$nama			= $request->input('val05');
		$namapejabat	= $request->input('val06');
		$nippejabat		= $request->input('val07');
		$nosk			= $request->input('val08');
		$selesai		= $request->input('val09');
		$jenis			= $request->input('val10');
		$idne			= $request->input('val11');
		$sukses			= '';
		$gagal			= '';
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($kedudukan != '' AND $nama != ''){
			if ($jenis == 'tambah'){
				if ($request->input('val12') == null OR $request->input('val12') == ''){
					$input 		= Detailorganisasi::create([
						'no'			=> $masterno,
						'nama'			=> $nama,
						'kedudukan'		=> $kedudukan,
						'nosk'			=> $nosk,
						'mulai'			=> $mulai,
						'selesai'		=> $selesai,
						'namapejabat'	=> $namapejabat,
						'jabpejabat'	=> $jabpejabat,
						'nippejabat'	=> $nippejabat,
						'bukti'			=> '',
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				} else {
					$input 		= Detailorganisasi::create([
						'no'			=> $masterno,
						'nama'			=> $nama,
						'kedudukan'		=> $kedudukan,
						'nosk'			=> $nosk,
						'mulai'			=> $mulai,
						'selesai'		=> $selesai,
						'namapejabat'	=> $namapejabat,
						'jabpejabat'	=> $jabpejabat,
						'nippejabat'	=> $nippejabat,
						'bukti'			=> $request->input('val12'),
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				}
				$idne				= $input->id;
				$nmfile 			= time();
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$nmfile			= 'ORG-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailorganisasi::where('id', $idne)->update([
							'bukti'			=> $nmfile,
						]);
					}
				}
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			} else if ($jenis == 'hapus'){
				$rmaster 		= Detailorganisasi::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailorganisasi::where('id', $idne)->delete();
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			} else {
				if ($request->input('val12') == null OR $request->input('val12') == ''){
					$input 		= Detailorganisasi::where('id', $idne)->update([
						'no'			=> $masterno,
						'nama'			=> $nama,
						'kedudukan'		=> $kedudukan,
						'nosk'			=> $nosk,
						'mulai'			=> $mulai,
						'selesai'		=> $selesai,
						'namapejabat'	=> $namapejabat,
						'jabpejabat'	=> $jabpejabat,
						'nippejabat'	=> $nippejabat,
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				} else {
					$input 		= Detailorganisasi::where('id', $idne)->update([
						'no'			=> $masterno,
						'nama'			=> $nama,
						'kedudukan'		=> $kedudukan,
						'nosk'			=> $nosk,
						'mulai'			=> $mulai,
						'selesai'		=> $selesai,
						'namapejabat'	=> $namapejabat,
						'jabpejabat'	=> $jabpejabat,
						'nippejabat'	=> $nippejabat,
						'bukti'			=> $request->input('val12'),
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				}
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$rmaster 		= Detailorganisasi::where('id', $idne)->first();
						if (isset($rmaster->bukti)){
							$nmfile		= $rmaster->bukti;
							if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
								File::delete(public_path() ."/images/".$masterno."/". $nmfile);
							}
						}
						$nmfile		= 'ORG-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailorganisasi::where('id', $idne)->update([
							'bukti'			=> $nmfile,
						]);
					}
				}
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			
			if ($sukses != ''){
				$keterangan = $sukses.' Organisasi';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						'.$sukses.'
					</div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				</div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				</div>';
		}
	}
	public function jsonDataorganisasi(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailorganisasi::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$bukti 		= $hasil->bukti;
				$cekbentuk 	= explode('://', $bukti);
				if (isset($cekbentuk[1])){

				} else {
					$bukti	= $homebase.'/images/'.$hasil->no.'/'.$bukti;
					Detailorganisasi::where('id', $hasil->id)->update([
						'bukti'	=> $bukti
					]);
				}
				$arraydata[] = array(
					'id' 			=> $hasil->id,
					'no' 			=> $hasil->no,
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'kedudukan' 	=> $hasil->kedudukan,
					'namaorganisasi'=> $hasil->nama,
					'nosk' 			=> $hasil->nosk,
					'mulai'			=> $hasil->mulai,
					'selesai'		=> $hasil->selesai,
					'namapejabat'	=> $hasil->namapejabat,
					'jabpejabat'	=> $hasil->jabpejabat,
					'nippejabat'	=> $hasil->nippejabat,
					'bukti'			=> '<a href="'.$bukti.'" target="_blank">'.$bukti.'</a>',
				);
			}
		}
		
		echo json_encode($arraydata);
	}
	public function exDataseminar(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$kedudukan		= $request->input('val02');
		$lokasi			= $request->input('val03');
		$namaacara		= $request->input('val04');
		$penyelenggara	= $request->input('val05');
		$tahun			= $request->input('val06');
		$tingkat		= $request->input('val07');
		$jenis			= $request->input('val08');
		$idne			= $request->input('val09');
		$sukses			= '';
		$gagal			= '';
		if ($kedudukan != '' AND $lokasi != '' AND $namaacara != '' AND $tahun != '' AND $penyelenggara != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailseminar::create([
					'no'			=> $masterno,
					'kedudukan'		=> $kedudukan,
					'lokasi'		=> $lokasi,
					'namaacara'		=> $namaacara,
					'penyelenggara'	=> $penyelenggara,
					'tahun'			=> $tahun,
					'tingkat'		=> $tingkat,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailseminar::where('id', $idne)->update([
					'no'			=> $masterno,
					'kedudukan'		=> $kedudukan,
					'lokasi'		=> $lokasi,
					'namaacara'		=> $namaacara,
					'penyelenggara'	=> $penyelenggara,
					'tahun'			=> $tahun,
					'tingkat'		=> $tingkat,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailseminar::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailseminar::where('id', $idne)->delete();	
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Seminar';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);	
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					'.$sukses.'
				  </div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				  </div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				  </div>';
		}
	}
	public function jsondataSeminar(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$cekawal	= Simpegpegawai::where('nip_baru', $masterno)->first();
		if (isset($cekawal->id)){
			$masterno = $cekawal->id;
		}
		$hasil			= Simpegpegawai::where('id', $masterno)->first();
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailseminar::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> $hasil->id,
					'no' 			=> $hasil->no,
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'kedudukan' 	=> $hasil->kedudukan,
					'lokasi' 		=> $hasil->lokasi,
					'namaacara' 	=> $hasil->namaacara,
					'penyelenggara' => $hasil->penyelenggara,
					'tahun'			=> $hasil->tahun,
					'tingkat'		=> $hasil->tingkat,
					'bukti'			=> $hasil->bukti,
				);
			}
		}
		
		echo json_encode($arraydata);
	}
	public function exDatakeluarga(Request $request) {
    	$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');
		$masterno	= $request->input('val01');
		$alamat 	= '';
		if(null !== $request->input('val02')){
		$alamat	= $request->input('val02');
		}
		$hubklg 	= '';
		if(null !== $request->input('val03')){
			$hubklg	= $request->input('val03');
		}
		$jenjang 	= '';
		if(null !== $request->input('val04')){
			$jenjang	= $request->input('val04');
		}
		$nama 	= '';
		if(null !== $request->input('val05')){
			$nama	= $request->input('val05');
		}
		$pekerjaan 	= '';
		if(null !== $request->input('val06')){
			$pekerjaan	= $request->input('val06');
		}
		$status 	= '';
		if(null !== $request->input('val07')){
			$status	= $request->input('val07');
		}
		$tempatlahir 	= '';
		if(null !== $request->input('val08')){
			$tempatlahir	= $request->input('val08');
		}
		$tgllahir 	= '';
		if(null !== $request->input('val09')){
			$tgllahir	= $request->input('val09');
		}
		$jenis		= $request->input('val10');
		$idne 	= '';
		if(null !== $request->input('val11')){
			$idne	= $request->input('val11');
		}
		$kelamin 	= '';
		if(null !== $request->input('val12')){
			$kelamin	= $request->input('val12');
		}
		$tglmenikah 	= '';
		if(null !== $request->input('val13')){
			$tglmenikah	= $request->input('val13');
		}
		$bukti 		= '';
		if(null !== $request->input('val16')){
			$bukti	= $request->input('val16');
		}
		$sukses		= '';
		$gagal		= '';
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($jenis == 'tambah'){
			$input 	= Detailanggotakeluarga::create([
				'no'			=> $masterno,
				'nama'			=> $nama,
				'hubklg'		=> $hubklg,
				'kelamin'		=> $kelamin,
				'tglmenikah'	=> $tglmenikah,
				'alamat'		=> $alamat,
				'jenjang'		=> $jenjang,
				'pekerjaan'		=> $pekerjaan,
				'status'		=> $status,
				'tgllahir'		=> $tgllahir,
				'tmplahir'		=> $tempatlahir,
				'bukti'			=> $bukti,
				'timestamp'		=> date("Y-m-d H:i:s")
			]);
			$idne				= $input->id;
			$nmfile 			= time();
			if ($request->hasFile('file')) {
				if($validator->fails()) {
					$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
				} else {
					$nmfile			= 'KLG-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
					Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
					Detailanggotakeluarga::where('id', $idne)->update([
						'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
					]);
				}
			}
			if ($input) { $sukses = 'Sukses Menambahkan Data'; }
			else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else if ($jenis == 'hapus'){
			$rmaster 		= Detailanggotakeluarga::where('id', $idne)->first();
			if (isset($rmaster->bukti)){
				$nmfile		= $rmaster->bukti;
			} else { $nmfile = ''; }
			if ($nmfile != ''){
				if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
					File::delete(public_path() ."/images/".$masterno."/". $nmfile);
				}
			}
			$input 		= Detailanggotakeluarga::where('id', $idne)->delete();	
			Aktifitas::create([
				'unique_id'	=> $masterno,
				'kelompok'	=> 'Delete',
				'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
			]);
			if ($input) { $sukses = 'Sukses Menghapus Data'; }
			else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else {
			$input 	= Detailanggotakeluarga::where('id', $idne)->update([
				'no'			=> $masterno,
				'nama'			=> $nama,
				'kelamin'		=> $kelamin,
				'tglmenikah'	=> $tglmenikah,
				'hubklg'		=> $hubklg,
				'alamat'		=> $alamat,
				'jenjang'		=> $jenjang,
				'pekerjaan'		=> $pekerjaan,
				'status'		=> $status,
				'tgllahir'		=> $tgllahir,
				'tmplahir'		=> $tempatlahir,
				'timestamp'		=> date("Y-m-d H:i:s")
			]);
			if ($request->hasFile('file')) {
				if($validator->fails()) {
					$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
				} else {
					$rmaster 		= Detailanggotakeluarga::where('id', $idne)->first();
					if (isset($rmaster->bukti)){
						$nmfile		= $rmaster->bukti;
						if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
							File::delete(public_path() ."/images/".$masterno."/". $nmfile);
						}
					}
					$nmfile		= 'KLG-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
					Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
					Detailanggotakeluarga::where('id', $idne)->update([
						'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
					]);
				}
			} else {
				$rmaster 		= Detailanggotakeluarga::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				Detailanggotakeluarga::where('id', $idne)->update([
					'bukti'	=> $bukti,
				]);
			}
			if ($input) { $sukses = 'Sukses Mengubah Data'; }
			else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
		}
		$keterangan = $sukses.' Keluarga';
		Aktifitas::create([
			'unique_id'	=> $masterno,
			'kelompok'	=> 'Dosen',
			'keterangan'=> $keterangan
		]);
		if ($gagal != ''){
			echo $gagal;
		} else {
			echo $sukses;
		}
	}
	public function jsonDatakeluarga(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$cekawal	= Simpegpegawai::where('nip_baru', $masterno)->first();
		if (isset($cekawal->id)){
			$masterno = $cekawal->id;
		}
		$hasil			= Simpegpegawai::where('id', $masterno)->first();
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailanggotakeluarga::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$bukti 		= $hasil->bukti;
				$cekbentuk 	= explode('://', $bukti);
				if (isset($cekbentuk[1])){

				} else {
					$bukti	= $homebase.'/images/'.$hasil->no.'/'.$bukti;
					Detailidentitas::where('id', $hasil->id)->update([
						'bukti'	=> $bukti
					]);
				}
				$arraydata[] = array(
					'id' 		=> $hasil->id,		
					'no' 		=> $hasil->no,
					'nama' 		=> $hasil->nama,
					'kelamin' 	=> $hasil->kelamin,
					'tglmenikah'=> $hasil->tglmenikah,
					'hubklg' 	=> $hasil->hubklg,
					'alamat' 	=> $hasil->alamat,
					'jenjang' 	=> $hasil->jenjang,
					'pekerjaan' => $hasil->pekerjaan,
					'status' 	=> $hasil->status,
					'tgllahir' 	=> $hasil->tgllahir,
					'tmplahir' 	=> $hasil->tmplahir,
					'bukti'		=> '<a href="'.$bukti.'" target="_blank">'.$bukti.'</a>',
				);
			}
		}
		
		echo json_encode($arraydata);
	}
	public function exdataMutasi(Request $request) {
    	$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');
		$masterno	= $request->input('val01');
		$keterangan	= $request->input('val02');
		$nosk		= $request->input('val03');
		$status		= $request->input('val04');
		$tanggal	= $request->input('val05');
		$jenis		= $request->input('val06');
		$idne		= $request->input('val07');
		$sukses		= '';
		$gagal		= '';
		if ($keterangan == ''){ $keterangan = '-'; }
		
		if ($jenis == 'hapus'){ $nosk = '-'; $status = '-'; $tanggal = '-'; }
		if ($nosk != '' or $status != '' or $tanggal != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailmutasi::create([
					'no'		=> $masterno,
					'nosk'		=> $nosk,
					'status'	=> $status,
					'tanggal'	=> $tanggal,
					'keterangan'=> $keterangan,
					'bukti'		=> '',
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailmutasi::where('id', $idne)->update([
					'no'		=> $masterno,
					'nosk'		=> $nosk,
					'status'	=> $status,
					'tanggal'	=> $tanggal,
					'keterangan'=> $keterangan,
					'bukti'		=> '',
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailmutasi::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailmutasi::where('id', $idne)->delete();	
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			$keterangan = $sukses.' Mutasi';
			Aktifitas::create([
				'unique_id'	=> $masterno,
				'kelompok'	=> 'Dosen',
				'keterangan'=> $keterangan
			]);	
			if ($gagal != ''){
				echo $gagal;
			} else {
				echo $sukses;
			}
		}
		else {
			echo 'Pastikan Semua Isian Terisi Dengan Benar';
		}
	}
	public function jsondataMutasi(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailmutasi::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 		=> $hasil->id,
					'no' 		=> $hasil->no,
					'nosk' 		=> $hasil->nosk,
					'nama' 		=> $nama,
					'nip' 		=> $nip,
					'status' 	=> $hasil->status,
					'tanggal' 	=> $hasil->tanggal,
					'keterangan'=> $hasil->keterangan,
					'bukti'		=> $hasil->bukti,
				);
			}
		}
		$rsurat  		= Draftsk::where('idpeg', $masterno)->whereIn('jenissk', ['PERPANJANGAN TUBEL DOSEN NON PNS', 'TUGAS BELAJAR DOSEN NON PNS', 'IZIN BELAJAR DOSEN PNS', 'IZIN BELAJAR DOSEN NON PNS', 'BUP Tetap Non PNS', 'Pengunduran Diri', 'Meninggal Dunia', 'PDD Tetap Non PNS', 'Pengangkatan PNS', 'TUGAS BELAJAR TENDIK NON PNS', 'IZIN BELAJAR TENDIK PNS', 'IZIN BELAJAR TENDIK NON PNS'])->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 		=> '',
					'no' 		=> '',
					'nosk' 		=> $hasil->nomor.' Tahun '.$hasil->tahun,
					'nama' 		=> $nama,
					'nip' 		=> $nip,
					'status' 	=> $hasil->status,
					'tanggal' 	=> $hasil->tanggalsk,
					'keterangan'=> $hasil->jenissk,
					'bukti'		=> $hasil->marking.'.pdf',
				);
			}
		}
		
		echo json_encode($arraydata);
	}
	public function exdataIdentitas(Request $request) {
    	$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');
		$masterno	= $request->input('val01');
		$aktif		= $request->input('val02');
		$jenisid	= $request->input('val03');
		$nomer		= $request->input('val04');
		$jenis		= $request->input('val05');
		$idne		= $request->input('val06');
		$sukses		= '';
		$gagal		= '';
		$homebase	= url("/");
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($jenis == 'tambah'){
			if ($request->input('val07') == null OR $request->input('val07') == ''){
				$input	= Detailidentitas::create([
					'no'		=> $masterno,
					'aktif'		=> $aktif,
					'jenisid'	=> $jenisid,
					'nomer'		=> $nomer,
					'bukti'		=> '',
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
				$idne	= $input->id;
				$nmfile	= time();
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$nmfile			= 'IDD-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailidentitas::where('id', $idne)->update([
							'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
						]);
					}
				}
			} else {
				$input 		= Detailidentitas::create([
					'no'		=> $masterno,
					'aktif'		=> $aktif,
					'jenisid'	=> $jenisid,
					'nomer'		=> $nomer,
					'bukti'		=> $request->input('val07'),
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			}
			if ($input) { $sukses = 'Sukses Menambahkan Data'; }
			else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else if ($jenis == 'hapus'){
			$rmaster 		= Detailidentitas::where('id', $idne)->first();
			if (isset($rmaster->bukti)){
				$nmfile		= $rmaster->bukti;
			} else { $nmfile = ''; }
			if ($nmfile != ''){
				if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
					File::delete(public_path() ."/images/".$masterno."/". $nmfile);
				}
			}
			$input 		= Detailidentitas::where('id', $idne)->delete();	
			Aktifitas::create([
				'unique_id'	=> $masterno,
				'kelompok'	=> 'Delete',
				'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
			]);
			if ($input) { $sukses = 'Sukses Menghapus Data'; }
			else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else {
			if ($request->input('val07') == null OR $request->input('val07') == ''){
				$input 		= Detailidentitas::where('id', $idne)->update([
					'no'		=> $masterno,
					'aktif'		=> $aktif,
					'jenisid'	=> $jenisid,
					'nomer'		=> $nomer,
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			} else {
				$input 		= Detailidentitas::where('id', $idne)->update([
					'no'		=> $masterno,
					'aktif'		=> $aktif,
					'jenisid'	=> $jenisid,
					'nomer'		=> $nomer,
					'bukti'		=> $request->input('val07'),
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			}
			if ($input) { 
				$sukses = 'Sukses Mengubah Data';
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$rmaster 		= Detailidentitas::where('id', $idne)->first();
						if (isset($rmaster->bukti)){
							$nmfile		= $rmaster->bukti;
							if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
								File::delete(public_path() ."/images/".$masterno."/". $nmfile);
							}
						}
						$nmfile		= 'IDD-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailidentitas::where('id', $idne)->update([
							'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
						]);
					}
				}
			} else { 
				$gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi';
			}
		}
		$keterangan = $sukses.' Identitas';
		Aktifitas::create([
			'unique_id'	=> $masterno,
			'kelompok'	=> 'Dosen',
			'keterangan'=> $keterangan
		]);
		if ($aktif == 'STR'){
			Simpegpegawai::where('id', $masterno)->update([
				'cpns'		=> $nomer,
				'tmt_cpns'	=> $jenisid
			]);
		}
		if ($aktif == 'Surat Ijin Praktek'){
			Simpegpegawai::where('id', $masterno)->update([
				'pns'		=> $nomer,
				'tmt_pns'	=> $jenisid
			]);
		}
		if ($gagal != ''){
			echo $gagal;
		} else {
			echo $sukses;
		}
	}
	public function jsondataIdentitas(Request $request) {
    	$masterno   = $request->input('val01');
		$jenisfile  = $request->input('val02');
		$homebase	= url("/");
		$cekawal	= Simpegpegawai::where('nip_baru', $masterno)->first();
		if (isset($cekawal->id)){
			$masterno = $cekawal->id;
		}
		$hasil			= Simpegpegawai::where('id', $masterno)->first();
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		if ($jenisfile == 'Psikologi'){
			$rsurat  	= Detailidentitas::where('aktif', 'Psikologi')->where('no', $masterno)->get();
		} else if ($jenisfile == 'Kesehatan'){
			$rsurat  	= Detailidentitas::whereIn('aktif', ['Mepthapetamine', 'HbsAg Kualitatif', 'HIV-Aids', 'Thorax', 'es Buta Warna dan Pemeriksaan Fisik', 'Kesehatan Lain', 'Covid 1', 'Covid 2', 'Covid 3'])->where('no', $masterno)->get();
		} else if ($jenisfile == 'Kredential'){
			$rsurat  	= Detailidentitas::whereIn('aktif', ['Ijasah', 'STR', 'Surat Ijin Praktek', 'RKK', 'SPK'])->where('no', $masterno)->get();
		} else {
			$rsurat  	= Detailidentitas::where('no', $masterno)->get();
		}
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$bukti 		= $hasil->bukti;
				$cekbentuk 	= explode('://', $bukti);
				if (isset($cekbentuk[1])){

				} else {
					$bukti	= $homebase.'/images/'.$hasil->no.'/'.$bukti;
					Detailidentitas::where('id', $hasil->id)->update([
						'bukti'	=> $bukti
					]);
				}
				$arraydata[] = array(
					'id' 		=> $hasil->id,
					'no' 		=> $hasil->no,
					'aktif' 	=> $hasil->aktif,
					'nama' 		=> $nama,
					'nip' 		=> $nip,
					'jenisid' 	=> $hasil->jenisid,
					'nomer' 	=> $hasil->nomer,
					'keterangan'=> $hasil->keterangan,
					'bukti'		=> '<a href="'.$bukti.'" target="_blank">'.$bukti.'</a>',
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exdataPendidikan(Request $request) {
    	$midpeg 	= Session('id');
		$mkelompok	= Session('previlage');
		$masterno	= $request->input('val01');
		$jenjang	= $request->input('val02');
		$keterangan	= $request->input('val03');
		$lulus		= $request->input('val04');
		$minat		= $request->input('val05');
		$negara		= $request->input('val06');
		$noijasah	= $request->input('val07');
		$sekolah	= $request->input('val08');
		$status		= $request->input('val09');
		$tahun		= $request->input('val10');
		$tglijasah	= $request->input('val11');
		$jenis		= $request->input('val12');
		$idne		= $request->input('val13');
		$sukses		= '';
		$gagal		= '';
		$homebase	= url("/");
		
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($lulus == '' OR is_null($lulus)){ $lulus = '0000-00-00'; }
		if ($keterangan == ''){ $keterangan = '-'; }
		if ($jenis == 'new' OR $jenis == 'tambah'){
			if ($request->input('val14') == '' OR $request->input('val14') == null){
				$input 		= Detailpendidikan::create([
					'no'		=> $masterno,
					'jenjang'	=> $jenjang,
					'sekolah'	=> $sekolah,
					'negara'	=> $negara,
					'minat'		=> $minat,
					'tahunmsk'	=> $tahun,
					'status'	=> $status,
					'tmtlulus'	=> $lulus,
					'noijasah'	=> $noijasah,
					'tglijasah'	=> $tglijasah,
					'keterangan'=> $keterangan,
					'bukti'		=> '',
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			} else {
				$input 		= Detailpendidikan::create([
					'no'		=> $masterno,
					'jenjang'	=> $jenjang,
					'sekolah'	=> $sekolah,
					'negara'	=> $negara,
					'minat'		=> $minat,
					'tahunmsk'	=> $tahun,
					'status'	=> $status,
					'tmtlulus'	=> $lulus,
					'noijasah'	=> $noijasah,
					'tglijasah'	=> $tglijasah,
					'keterangan'=> $keterangan,
					'bukti'		=> $request->input('val14'),
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			}
			if ($input) {
				$idne				= $input->id;
				$nmfile 			= time();
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$nmfile			= 'PDD-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailpendidikan::where('id', $idne)->update([
							'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
						]);
					}
				}
				Simpegpegawai::where('id', $masterno)->update([
					'pend_akhir'	=> $jenjang,
					'ijasah_diakui'	=> $jenjang,
					'bidang_ilmu'	=> $minat
				]);
				$tulisrekappendidikan 	= '<ul>';
				$tulisrekapkeahlian 	= '<ul>';
				$jpendidikan			=  Detailpendidikan::where('no', $masterno)->get();
				if (!empty($jpendidikan)){
					foreach ($jpendidikan as $rpendidikan) {
						$jenjang = $rpendidikan->jenjang;
						if ($jenjang == 'S1' OR $jenjang == 'Profesi' OR $jenjang == 'S2' OR $jenjang == 'S3' OR $jenjang == 'Spesialis 1' OR $jenjang == 'Spesialis 2'){
							$tulisrekapkeahlian = $tulisrekapkeahlian.'<li>'.$rpendidikan->minat.'</li>';
							$tulisrekappendidikan = $tulisrekappendidikan.'<li>'.$rpendidikan->jenjang.'-'.$rpendidikan->sekolah.' '.$rpendidikan->negara.'</li>';
						}
					}
				}
				$tulisrekappendidikan 	= $tulisrekappendidikan.'</ul>';
				$tulisrekapkeahlian 	= $tulisrekapkeahlian.'</ul>';
				$caridatalama 	= Dataajar::where('no', $masterno)->count();
				if ($caridatalama == 0){
					$getdatadiri = Simpegpegawai::where('id', $masterno)->first();
					$jabatanakad = $getdatadiri->jab_fungsional;
					if ($jabatanakad == 'Guru Besar'){ $jabatanakad = 'GB'; }
					else if ($jabatanakad == 'Lektor Kepala'){ $jabatanakad = 'LK'; }
					else if ($jabatanakad == 'Lektor'){ $jabatanakad = 'LL'; }
					else if ($jabatanakad == 'Asisten Ahli'){ $jabatanakad = 'AA'; }
					else { $jabatanakad = 'TP'; }
					Dataajar::create([
						'no'				=> $masterno,
						'rekappendidikan'	=> $tulisrekappendidikan,
						'rekapkeahlian'		=> $tulisrekapkeahlian,
						'jabatanakad'		=> $jabatanakad,
						'rekapserpro'		=> '',
						'rekapserkompro'	=> '',
						'matakuliah'		=> '',
						'sks'				=> '',
						'kodeps'			=> $getdatadiri->program_studi,
						'sesuai'			=> 1,
						'lingkup'			=> 1,
						'bukti'				=> '',
						'timestamp'			=> date("Y-m-d H:i:s")
					]);	
				}
				else {
					Dataajar::where('no', $masterno)->update([
						'rekappendidikan'	=> $tulisrekappendidikan,
						'rekapkeahlian'		=> $tulisrekapkeahlian,
						'timestamp'			=> date("Y-m-d H:i:s")
					]);
				}
				$sukses = 'Sukses Menambahkan Data';
			}
			else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else if ($jenis == 'hapus'){
			$rmaster 		= Detailpendidikan::where('id', $idne)->first();
			if (isset($rmaster->bukti)){
				$nmfile		= $rmaster->bukti;
			} else { $nmfile = ''; }
			if ($nmfile != ''){
				if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
					File::delete(public_path() ."/images/".$masterno."/". $nmfile);
				}
			}
			$input 		= Detailpendidikan::where('id', $idne)->delete();
			Aktifitas::create([
				'unique_id'	=> $masterno,
				'kelompok'	=> 'Delete',
				'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
			]);
			if ($input) { 
				$sukses = 'Sukses Menghapus Data';
				Simpegpegawai::where('id', $masterno)->update([
					'pend_akhir'	=> '',
					'ijasah_diakui'	=> '',
					'bidang_ilmu'	=> ''
				]);
			}
			else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else {
			if ($request->input('val14') == '' OR $request->input('val14') == null){
				$input 		= Detailpendidikan::where('id', $idne)->update([
					'no'		=> $masterno,
					'jenjang'	=> $jenjang,
					'sekolah'	=> $sekolah,
					'negara'	=> $negara,
					'minat'		=> $minat,
					'tahunmsk'	=> $tahun,
					'status'	=> $status,
					'tmtlulus'	=> $lulus,
					'noijasah'	=> $noijasah,
					'tglijasah'	=> $tglijasah,
					'keterangan'=> $keterangan,
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			} else {
				$input 		= Detailpendidikan::where('id', $idne)->update([
					'no'		=> $masterno,
					'jenjang'	=> $jenjang,
					'sekolah'	=> $sekolah,
					'negara'	=> $negara,
					'minat'		=> $minat,
					'tahunmsk'	=> $tahun,
					'status'	=> $status,
					'tmtlulus'	=> $lulus,
					'noijasah'	=> $noijasah,
					'tglijasah'	=> $tglijasah,
					'keterangan'=> $keterangan,
					'bukti'		=> $request->input('val14'),
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
			}
			
			if ($input) {
				//$idne				= $input->id;
				$nmfile 			= time();
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$rmaster 		= Detailpendidikan::where('id', $idne)->first();
						if (isset($rmaster->bukti)){
							$nmfile		= $rmaster->bukti;
							if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
								File::delete(public_path() ."/images/".$masterno."/". $nmfile);
							}
						}
						$nmfile		= 'PDD-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailpendidikan::where('id', $idne)->update([
							'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
						]);
					}
				}
				Simpegpegawai::where('id', $masterno)->update([
					'pend_akhir'	=> $jenjang,
					'ijasah_diakui'	=> $jenjang,
					'bidang_ilmu'	=> $minat
				]);
				$tulisrekappendidikan 	= '<ul>';
				$tulisrekapkeahlian 	= '<ul>';
				$jpendidikan			=  Detailpendidikan::where('no', $masterno)->get();
				if (!empty($jpendidikan)){
					foreach ($jpendidikan as $rpendidikan) {
						$jenjang = $rpendidikan->jenjang;
						if ($jenjang == 'S1' OR $jenjang == 'Profesi' OR $jenjang == 'S2' OR $jenjang == 'S3' OR $jenjang == 'Spesialis 1' OR $jenjang == 'Spesialis 2'){
							$tulisrekapkeahlian = $tulisrekapkeahlian.'<li>'.$rpendidikan->minat.'</li>';
							$tulisrekappendidikan = $tulisrekappendidikan.'<li>'.$rpendidikan->jenjang.'-'.$rpendidikan->sekolah.' '.$rpendidikan->negara.'</li>';
						}
					}
				}
				$tulisrekappendidikan 	= $tulisrekappendidikan.'</ul>';
				$tulisrekapkeahlian 	= $tulisrekapkeahlian.'</ul>';
				
				$caridatalama 	= Dataajar::where('no', $masterno)->count();
				if ($caridatalama == 0){
					$getdatadiri = Simpegpegawai::where('id', $masterno)->first();
					$jabatanakad = $getdatadiri->jab_fungsional;
					if ($jabatanakad == 'Guru Besar'){ $jabatanakad = 'GB'; }
					else if ($jabatanakad == 'Lektor Kepala'){ $jabatanakad = 'LK'; }
					else if ($jabatanakad == 'Lektor'){ $jabatanakad = 'LL'; }
					else if ($jabatanakad == 'Asisten Ahli'){ $jabatanakad = 'AA'; }
					else { $jabatanakad = 'TP'; }
					Dataajar::create([
						'no'				=> $masterno,
						'rekappendidikan'	=> $tulisrekappendidikan,
						'rekapkeahlian'		=> $tulisrekapkeahlian,
						'jabatanakad'		=> $jabatanakad,
						'rekapserpro'		=> '',
						'rekapserkompro'	=> '',
						'matakuliah'		=> '',
						'sks'				=> '',
						'kodeps'			=> $getdatadiri->program_studi,
						'sesuai'			=> 1,
						'lingkup'			=> 1,
						'bukti'				=> '',
						'timestamp'			=> date("Y-m-d H:i:s")
					]);	
				}
				else {
					Dataajar::where('no', $masterno)->update([
						'rekappendidikan'	=> $tulisrekappendidikan,
						'rekapkeahlian'		=> $tulisrekapkeahlian,
						'timestamp'			=> date("Y-m-d H:i:s")
					]);
				}
				
				$sukses = 'Sukses Mengubah Data '.$nmfile;
				}
			else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
		}
		$keterangan = $sukses.' Pendidikan';
		Aktifitas::create([
			'unique_id'	=> $masterno,
			'kelompok'	=> 'Dosen',
			'keterangan'=> $keterangan
		]);	
		if ($gagal != ''){
			echo $gagal;
		} else {
			echo $sukses;
		}
	}
	public function jsondatPpendidikan(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$cekawal		= Simpegpegawai::where('nip_baru', $masterno)->first();
		if (isset($cekawal->id)){
			$masterno 	= $cekawal->id;
		}
		$hasil			= Simpegpegawai::where('id', $masterno)->first();
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailpendidikan::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$bukti 		= $hasil->bukti;
				$cekbentuk 	= explode('://', $bukti);
				if (isset($cekbentuk[1])){

				} else {
					$bukti	= $homebase.'/images/'.$hasil->no.'/'.$bukti;
					Detailpendidikan::where('id', $hasil->id)->update([
						'bukti'	=> $bukti
					]);
				}
				$arraydata[] = array(
					'id' 		=> $hasil->id,		
					'nama' 		=> $nama,
					'nip' 		=> $nip,
					'no' 		=> $hasil->no,
					'jenjang' 	=> $hasil->jenjang,
					'sekolah' 	=> $hasil->sekolah,
					'negara' 	=> $hasil->negara,
					'minat' 	=> $hasil->minat,
					'tahunmsk' 	=> $hasil->tahunmsk,
					'status' 	=> $hasil->status,
					'tmtlulus' 	=> $hasil->tmtlulus,
					'noijasah' 	=> $hasil->noijasah,
					'tglijasah' => $hasil->tglijasah,
					'keterangan'=> $hasil->keterangan,
					'bukti'		=> '<a href="'.$bukti.'" target="_blank">'.$bukti.'</a>',
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exdataPangkat(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$asalsk			= $request->input('val02');
		$bulankurang	= $request->input('val03');
		$bulantambah	= $request->input('val04');
		$gaji			= $request->input('val05');
		$golongan		= $request->input('val06');
		$keterangan		= $request->input('val07');
		$nosk			= $request->input('val08');
		$penandatangan	= $request->input('val09');
		$penjelasan		= $request->input('val10');
		$tahunkurang	= $request->input('val11');
		$tahuntambah	= $request->input('val12');
		$tmtpangkat		= $request->input('val13');
		$tglsk			= $request->input('val14');
		$jenis			= $request->input('val15');
		$idne			= $request->input('val16');
		$sukses			= '';
		$gagal			= '';
		if ($keterangan == ''){ $keterangan = '-'; }
		
		if ($jenis == 'hapus'){ $asalsk = '-'; $gaji = '-'; $tmtpangkat = '-'; }
		if ($asalsk != '' or $gaji != '' or $tmtpangkat != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailpangkat::create([
					'no'			=> $masterno,
					'nosk'			=> $nosk,
					'tglsk'			=> $tglsk,
					'asalsk'		=> $asalsk,
					'penjelasan'	=> $penjelasan,
					'golongan'		=> $golongan,
					'tmtpangkat'	=> $tmtpangkat,
					'gajipokok'		=> $gaji,
					'penandatangan'	=> $penandatangan,
					'tahuntambah'	=> $tahuntambah,
					'bulantambah'	=> $bulantambah,
					'tahunkurang'	=> $tahunkurang,
					'bulankurang'	=> $bulankurang,
					'keterangan'	=> $keterangan,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailpangkat::where('id', $idne)->update([
					'no'			=> $masterno,
					'nosk'			=> $nosk,
					'tglsk'			=> $tglsk,
					'asalsk'		=> $asalsk,
					'penjelasan'	=> $penjelasan,
					'golongan'		=> $golongan,
					'tmtpangkat'	=> $tmtpangkat,
					'gajipokok'		=> $gaji,
					'penandatangan'	=> $penandatangan,
					'tahuntambah'	=> $tahuntambah,
					'bulantambah'	=> $bulantambah,
					'tahunkurang'	=> $tahunkurang,
					'bulankurang'	=> $bulankurang,
					'keterangan'	=> $keterangan,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailpangkat::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				$input 		= Detailpangkat::where('id', $idne)->delete();
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Pangkat';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);	
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						'.$sukses.'
					  </div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				  </div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				  </div>';
		}
	}
	public function jsondataPangkat(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailpangkat::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> $hasil->id,		
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'no' 			=> $hasil->no,
					'nosk' 			=> $hasil->nosk,
					'tglsk' 		=> $hasil->tglsk,
					'asalsk' 		=> $hasil->asalsk,
					'penjelasan' 	=> $hasil->penjelasan,
					'golongan' 		=> $hasil->golongan,
					'tmtpangkat' 	=> $hasil->tmtpangkat,
					'gajipokok' 	=> $hasil->gajipokok,
					'penandatangan' => $hasil->penandatangan,
					'tahuntambah'	=> $hasil->tahuntambah,
					'bulantambah'	=> $hasil->bulantambah,
					'tahunkurang'	=> $hasil->tahunkurang,
					'bulankurang'	=> $hasil->bulankurang,
					'keterangan'	=> $hasil->keterangan,
					'bukti'			=> $hasil->bukti,
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exdataFungsional(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$angkakredit	= $request->input('val02');
		$asalsk			= $request->input('val03');
		$fungsional		= $request->input('val04');
		$keterangan		= $request->input('val05');
		$namaunitkerja	= $request->input('val06');
		$nosk			= $request->input('val07');
		$penandatangan	= $request->input('val08');
		$tglsk			= $request->input('val09');
		$tmt			= $request->input('val10');
		$tunjangan		= $request->input('val11');
		$unitkerja		= $request->input('val12');
		$jenis			= $request->input('val13');
		$idne			= $request->input('val14');
		$sukses			= '';
		$gagal			= '';
		if ($keterangan == ''){ $keterangan = '-'; }
		
		if ($jenis == 'hapus'){ $fungsional = '-'; $nosk = '-'; $tglsk = '-'; }
		if ($fungsional != '' or $nosk != '' or $tglsk != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailfungsional::create([
					'no'			=> $masterno,
					'nosk'			=> $nosk,
					'tglsk'			=> $tglsk,
					'asalsk'		=> $asalsk,
					'tmt'			=> $tmt,
					'unit'			=> $unitkerja,
					'namaunit'		=> $namaunitkerja,
					'jabatan'		=> $fungsional,
					'penandatangan'	=> $penandatangan,
					'tunjangan'		=> $tunjangan,
					'angkakredit'	=> $angkakredit, 
					'keterangan'	=> $keterangan,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailfungsional::where('no', $masterno)->update([
					'nosk'			=> $nosk,
					'tglsk'			=> $tglsk,
					'asalsk'		=> $asalsk,
					'tmt'			=> $tmt,
					'unit'			=> $unitkerja,
					'namaunit'		=> $namaunitkerja,
					'jabatan'		=> $fungsional,
					'penandatangan'	=> $penandatangan,
					'tunjangan'		=> $tunjangan,
					'angkakredit'	=> $angkakredit, 
					'keterangan'	=> $keterangan,
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailfungsional::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailfungsional::where('id', $idne)->delete();
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Fungsional';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					'.$sukses.'
				  </div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				  </div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				  </div>';
		}
	}
	public function jsondataFungsional(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailfungsional::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> $hasil->id,		
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'no' 			=> $hasil->no,
					'nosk' 			=> $hasil->nosk,
					'tglsk' 		=> $hasil->tglsk,
					'asalsk' 		=> $hasil->asalsk,
					'tmt' 			=> $hasil->tmt,
					'unit' 			=> $hasil->unit,
					'namaunit' 		=> $hasil->namaunit,
					'jabatan' 		=> $hasil->jabatan,
					'penandatangan' => $hasil->penandatangan,
					'tunjangan'		=> $hasil->tunjangan,
					'angkakredit'	=> $hasil->angkakredit,
					'keterangan'	=> $hasil->keterangan,
					'bukti'			=> $hasil->bukti,
				);
			}
		}
		$rsurat  		= Draftsk::where('idpeg', $masterno)->whereIn('jenissk', ['PERPANJANGAN TUBEL DOSEN NON PNS', 'TUGAS BELAJAR DOSEN NON PNS', 'IZIN BELAJAR DOSEN PNS', 'IZIN BELAJAR DOSEN NON PNS', 'BUP Tetap Non PNS', 'Pengunduran Diri', 'Meninggal Dunia', 'PDD Tetap Non PNS', 'Pengangkatan PNS', 'TUGAS BELAJAR TENDIK NON PNS', 'IZIN BELAJAR TENDIK PNS', 'IZIN BELAJAR TENDIK NON PNS'])->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> '',
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'no' 			=> '',
					'nosk' 			=> $hasil->nomor.' Tahun '.$hasil->tahun,
					'tglsk' 		=> $hasil->tanggalsk,
					'asalsk' 		=> $hasil->asalsk,
					'tmt' 			=> $hasil->tmt,
					'unit' 			=> $hasil->unit,
					'namaunit' 		=> $hasil->namaunit,
					'jabatan' 		=> $hasil->jabatan,
					'penandatangan' => $hasil->penandatangan,
					'tunjangan'		=> $hasil->tunjangan,
					'angkakredit'	=> $hasil->angkakredit,
					'keterangan'	=> $hasil->jenissk,
					'bukti'			=> $hasil->marking.'.pdf',
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exdataSertifikasi(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$bidang			= $request->input('val02');
		$keterangan		= $request->input('val03');
		$nopes			= $request->input('val04');
		$noreg			= $request->input('val05');
		$penandatangan	= $request->input('val06');
		$ptp			= $request->input('val07');
		$tgl			= $request->input('val08');
		$jenis			= $request->input('val09');
		$idne			= $request->input('val10');
		$sukses			= '';
		$gagal			= '';
		if ($keterangan == ''){ $keterangan = '-'; }
		if ($jenis == 'hapus'){ $nopes = '-'; $tgl = '-'; $noreg = '-'; }
		if ($nopes != '' or $noreg != '' or $tgl != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailsertifikasi::create([
					'no'			=> $masterno,
					'bidang'		=> $bidang,
					'keterangan'	=> $keterangan,
					'nopes'			=> $nopes,
					'noreg'			=> $noreg,
					'penandatangan'	=> $penandatangan,
					'ptp'			=> $ptp,
					'tgl'			=> $tgl,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailsertifikasi::where('id', $idne)->update([
					'no'			=> $masterno,
					'bidang'		=> $bidang,
					'keterangan'	=> $keterangan,
					'nopes'			=> $nopes,
					'noreg'			=> $noreg,
					'penandatangan'	=> $penandatangan,
					'ptp'			=> $ptp,
					'tgl'			=> $tgl,
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailsertifikasi::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailsertifikasi::where('id', $idne)->delete();
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Sertifikasi';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					'.$sukses.'
				  </div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				  </div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				  </div>';
		}
	}
	public function jsondataSertifikasi(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailsertifikasi::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 			=> $hasil->id,		
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'no' 			=> $hasil->no,
					'bidang' 		=> $hasil->bidang,
					'keterangan' 	=> $hasil->keterangan,
					'nopes' 		=> $hasil->nopes,
					'noreg' 		=> $hasil->noreg,
					'penandatangan' => $hasil->penandatangan,
					'ptp' 			=> $hasil->ptp,
					'tgl' 			=> $hasil->tgl,
					'bukti' 		=> $hasil->bukti,
				);
			}
		}
		
		echo json_encode($arraydata);
	}
	public function exdataGaji(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$gaji			= $request->input('val02');
		$perubahan		= $request->input('val03');
		$nosk			= $request->input('val04');
		$tmt			= $request->input('val05');
		$jenis			= $request->input('val06');
		$idne			= $request->input('val07');
		$sukses			= '';
		$gagal			= '';
		
		if ($gaji != '' or $nosk != '' or $tmt != ''){
			if ($jenis == 'tambah'){
				$input 		= Detailgaji::create([
					'no'		=> $masterno,
					'gaji'		=> $gaji,
					'perubahan'	=> $perubahan,
					'nosk'		=> $nosk,
					'tmt'		=> $tmt,
					'bukti'		=> '',
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'ubah'){
				$input 		= Detailgaji::where('no', $masterno)->update([
					'no'		=> $masterno,
					'gaji'		=> $gaji,
					'perubahan'	=> $perubahan,
					'nosk'		=> $nosk,
					'tmt'		=> $tmt,
					'timestamp'	=> date("Y-m-d H:i:s")
				]);
				
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($jenis == 'hapus'){
				$rmaster 		= Detailgaji::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailgaji::where('id', $idne)->delete();
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			if ($sukses != ''){
				$keterangan = $sukses.' Gaji';
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Dosen',
					'keterangan'=> $keterangan
				]);
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					'.$sukses.'
				  </div>';
			}
			else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					'.$gagal.'
				  </div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Semua Isian Terisi Dengan Benar
				  </div>';
		}
	}
	public function jsondtaGaji(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailgaji::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$arraydata[] = array(
					'id' 		=> $hasil->id,		
					'nama' 		=> $nama,
					'nip' 		=> $nip,
					'no' 		=> $hasil->no,
					'gaji' 		=> $hasil->gaji,
					'perubahan' => $hasil->perubahan,
					'nosk' 		=> $hasil->nosk,
					'tmt' 		=> $hasil->tmt,
					'bukti' 	=> $hasil->bukti,
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exdataDiklat(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$angkatan		= $request->input('val02');
		$diklat			= $request->input('val03');
		$jam			= $request->input('val04');
		$keterangan		= $request->input('val05');
		$lulus			= $request->input('val06');
		$mulai			= $request->input('val07');
		$nama			= $request->input('val08');
		$negeri			= $request->input('val09');
		$nodoc			= $request->input('val10');
		$penyelenggara	= $request->input('val11');
		$predikat		= $request->input('val12');
		$tempat			= $request->input('val13');
		$tgldok			= $request->input('val14');
		$jenis			= $request->input('val15');
		$idne			= $request->input('val16');
		$sukses			= '';
		$gagal			= '';
		$homebase		= url("/");
		if ($keterangan == ''){ $keterangan = '-'; }
		if ($diklat == ''){ $diklat = 'UMUM'; }
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($jenis == 'tambah'){
			if ($request->input('val17') == '' OR $request->input('val17') == null){
				$input  	= Detaildiklat::create([
					'no'			=> $masterno,
					'angkatan'		=> $angkatan,
					'diklat'		=> $diklat,
					'jam'			=> $jam,
					'keterangan'	=> $keterangan,
					'lulus'			=> $lulus,
					'mulai'			=> $mulai,
					'namadiklat'	=> $nama,
					'negeri'		=> $negeri,
					'nodoc'			=> $nodoc,
					'penyelenggara'	=> $penyelenggara,
					'predikat'		=> $predikat,
					'tempat'		=> $tempat,
					'tgldok'		=> $tgldok,
					'bukti'			=> '',
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
			} else {
				$input  	= Detaildiklat::create([
					'no'			=> $masterno,
					'angkatan'		=> $angkatan,
					'diklat'		=> $diklat,
					'jam'			=> $jam,
					'keterangan'	=> $keterangan,
					'lulus'			=> $lulus,
					'mulai'			=> $mulai,
					'namadiklat'	=> $nama,
					'negeri'		=> $negeri,
					'nodoc'			=> $nodoc,
					'penyelenggara'	=> $penyelenggara,
					'predikat'		=> $predikat,
					'tempat'		=> $tempat,
					'tgldok'		=> $tgldok,
					'bukti'			=> $request->input('val17'),
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
			}
			$idne				= $input->id;
			$nmfile 			= time();
			if ($request->hasFile('file')) {
				if($validator->fails()) {
					$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
				} else {
					$nmfile		= 'DKL-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
					Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
					Detaildiklat::where('id', $idne)->update([
						'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
					]);
				}
			}
			if ($input) { $sukses = 'Sukses Menambahkan Data'; }
			else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else if ($jenis == 'hapus'){
			$rmaster 		= Detaildiklat::where('id', $idne)->first();
			if (isset($rmaster->bukti)){
				$nmfile		= $rmaster->bukti;
			} else { $nmfile = ''; }
			if ($nmfile != ''){
				if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
					File::delete(public_path() ."/images/".$masterno."/". $nmfile);
				}
			}
			$input 		= Detaildiklat::where('id', $idne)->delete();
			Aktifitas::create([
				'unique_id'	=> $masterno,
				'kelompok'	=> 'Delete',
				'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
			]);
			if ($input) { $sukses = 'Sukses Menghapus Data'; }
			else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
		} else {
			if ($request->input('val17') == '' OR $request->input('val17') == null){
				$input  	= Detaildiklat::where('id', $idne)->update([
					'angkatan'		=> $angkatan,
					'diklat'		=> $diklat,
					'jam'			=> $jam,
					'keterangan'	=> $keterangan,
					'lulus'			=> $lulus,
					'mulai'			=> $mulai,
					'namadiklat'	=> $nama,
					'negeri'		=> $negeri,
					'nodoc'			=> $nodoc,
					'penyelenggara'	=> $penyelenggara,
					'predikat'		=> $predikat,
					'tempat'		=> $tempat,
					'tgldok'		=> $tgldok,
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
			} else {
				$input  	= Detaildiklat::where('id', $idne)->update([
					'angkatan'		=> $angkatan,
					'diklat'		=> $diklat,
					'jam'			=> $jam,
					'keterangan'	=> $keterangan,
					'lulus'			=> $lulus,
					'mulai'			=> $mulai,
					'namadiklat'	=> $nama,
					'negeri'		=> $negeri,
					'nodoc'			=> $nodoc,
					'penyelenggara'	=> $penyelenggara,
					'predikat'		=> $predikat,
					'tempat'		=> $tempat,
					'tgldok'		=> $tgldok,
					'bukti'			=> $request->input('val17'),
					'timestamp'		=> date("Y-m-d H:i:s")
				]);
			}
			if ($request->hasFile('file')) {
				if($validator->fails()) {
					$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
				} else {
					$rmaster 		= Detaildiklat::where('id', $idne)->first();
					if (isset($rmaster->bukti)){
						$nmfile		= $rmaster->bukti;
						if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
							File::delete(public_path() ."/images/".$masterno."/". $nmfile);
						}
					}
					$nmfile		= 'DKL-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
					Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
					Detaildiklat::where('id', $idne)->update([
						'bukti'	=> $homebase.'/images/'.$masterno.'/'.$nmfile,
					]);
				}
			}
			if ($input) { $sukses = 'Sukses Mengubah Data'; }
			else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
		}
		$keterangan = $sukses.' Diklat';
		Aktifitas::create([
			'unique_id'	=> $masterno,
			'kelompok'	=> 'Dosen',
			'keterangan'=> $keterangan
		]);	
		if ($gagal != ''){
			echo $gagal;
		} else {
			echo $sukses;
		}
	}
	public function jsondataDiklat(Request $request) {
    	$masterno   = $request->input('val01');
		$homebase	= url("/");
		$cekawal	= Simpegpegawai::where('nip_baru', $masterno)->first();
		if (isset($cekawal->id)){
			$masterno = $cekawal->id;
		}
		$hasil			= Simpegpegawai::where('id', $masterno)->first();
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detaildiklat::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$bukti 		= $hasil->bukti;
				$cekbentuk 	= explode('://', $bukti);
				if (isset($cekbentuk[1])){

				} else {
					$bukti	= $homebase.'/images/'.$hasil->no.'/'.$bukti;
					Detaildiklat::where('id', $hasil->id)->update([
						'bukti'	=> $bukti
					]);
				}
				$arraydata[] = array(
					'id' 			=> $hasil->id,		
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'no' 			=> $hasil->no,
					'angkatan' 		=> $hasil->angkatan,
					'diklat' 		=> $hasil->diklat,
					'jam' 			=> $hasil->jam,
					'keterangan' 	=> $hasil->keterangan,
					'lulus' 		=> $hasil->lulus,
					'mulai' 		=> $hasil->mulai,
					'namadiklat' 	=> $hasil->namadiklat,
					'negeri' 		=> $hasil->negeri,
					'nodoc' 		=> $hasil->nodoc,
					'penyelenggara' => $hasil->penyelenggara,
					'predikat' 		=> $hasil->predikat,
					'tempat' 		=> $hasil->tempat,
					'tgldok' 		=> $hasil->tgldok,
					'bukti'			=> '<a href="'.$bukti.'" target="_blank">'.$bukti.'</a>',
				);
			}
		}
		echo json_encode($arraydata);
	}
	public function exdataPenghargaan(Request $request) {
    	$midpeg 		= Session('id');
		$mkelompok		= Session('previlage');
		$masterno		= $request->input('val01');
		$keterangan		= $request->input('val02');
		$namapenghargaan= $request->input('val03');
		$nosk			= $request->input('val04');
		$pejabat		= $request->input('val05');
		$pemberi		= $request->input('val06');
		$tanggal		= $request->input('val07');
		$jenis			= $request->input('val12');
		$idne			= $request->input('val13');
		$sukses			= '';
		$gagal			= '';
		$homebase		= url("/");
		if ($keterangan == ''){ $keterangan = '-'; }
		$validator 	= Validator::make($request->all(), [
			'file'     	=>  'mimes:jpeg,jpg,png,pdf|max:3000'
		]);
		if ($nosk != '' or $tanggal != '' or $namapenghargaan != ''){
			if ($jenis == 'tambah'){
				if ($request->input('val14') == '' OR $request->input('val14') == null){
					$input 		= Detailpenghargaan::create([
						'no'			=> $masterno,
						'penghargaan'	=> $namapenghargaan,
						'nosk'			=> $nosk,
						'tanggal'		=> $tanggal,
						'pemberi'		=> $pemberi,
						'pejabat'		=> $pejabat,
						'keterangan'	=> $keterangan,
						'bukti'			=> '',
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				} else {
					$input 		= Detailpenghargaan::create([
						'no'			=> $masterno,
						'penghargaan'	=> $namapenghargaan,
						'nosk'			=> $nosk,
						'tanggal'		=> $tanggal,
						'pemberi'		=> $pemberi,
						'pejabat'		=> $pejabat,
						'keterangan'	=> $keterangan,
						'bukti'			=> $request->input('val14'),
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				}
				
				$idne				= $input->id;
				$nmfile 			= time();
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$nmfile		= 'PGH-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailpenghargaan::where('id', $idne)->update([
							'bukti'			=> $homebase.'/images/'.$masterno.'/'.$nmfile,
						]);
					}
				}
				if ($input) { $sukses = 'Sukses Menambahkan Data'; }
				else { $gagal = 'Gagal Tambah Data, Silahkan Coba Beberapa Saat Lagi'; }
			} else if ($jenis == 'hapus'){
				$rmaster 		= Detailpenghargaan::where('id', $idne)->first();
				if (isset($rmaster->bukti)){
					$nmfile		= $rmaster->bukti;
				} else { $nmfile = ''; }
				if ($nmfile != ''){
					if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
						File::delete(public_path() ."/images/".$masterno."/". $nmfile);
					}
				}
				$input 		= Detailpenghargaan::where('id', $idne)->delete();
				Aktifitas::create([
					'unique_id'	=> $masterno,
					'kelompok'	=> 'Delete',
					'keterangan'=> 'Sukses Menghapus Data '.$nmfile.' Pada '.date('Y-m-d H:i:s').' Oleh '.Session('email')
				]);
				if ($input) { $sukses = 'Sukses Menghapus Data'; }
				else { $gagal = 'Gagal Menghapus Data, Silahkan Coba Beberapa Saat Lagi'; }
			} else {
				if ($request->input('val14') == '' OR $request->input('val14') == null){
					$input 		= Detailpenghargaan::where('id', $idne)->update([
						'penghargaan'	=> $namapenghargaan,
						'nosk'			=> $nosk,
						'tanggal'		=> $tanggal,
						'pemberi'		=> $pemberi,
						'pejabat'		=> $pejabat,
						'keterangan'	=> $keterangan,
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				} else {
					$input 		= Detailpenghargaan::where('id', $idne)->update([
						'penghargaan'	=> $namapenghargaan,
						'nosk'			=> $nosk,
						'tanggal'		=> $tanggal,
						'pemberi'		=> $pemberi,
						'pejabat'		=> $pejabat,
						'keterangan'	=> $keterangan,
						'bukti'			=> $request->input('val14'),
						'timestamp'		=> date("Y-m-d H:i:s")
					]);
				}
				
				if ($request->hasFile('file')) {
					if($validator->fails()) {
						$gagal = 'Pastikan File Upload Berekstensi JPG / PNG / PDF maksimal 3 Mb'.$validator->errors();
					} else {
						$rmaster 		= Detailpenghargaan::where('id', $idne)->first();
						if (isset($rmaster->bukti)){
							$nmfile		= $rmaster->bukti;
							if (File::exists(public_path() ."/images/".$masterno."/". $nmfile)) {
								File::delete(public_path() ."/images/".$masterno."/". $nmfile);
							}
						}
						$nmfile		= 'PGH-'.$masterno.'-'.$idne.'.'.$request->file('file')->getClientOriginalExtension();
						Storage::disk('local')->put('images/'.$masterno.'/'.$nmfile, file_get_contents($request->file('file')));
						Detailpenghargaan::where('id', $idne)->update([
							'bukti'			=> $nmfile,
						]);
					}
				}
				if ($input) { $sukses = 'Sukses Mengubah Data'; }
				else { $gagal = 'Gagal Mengubah Data, Silahkan Coba Beberapa Saat Lagi'; }
			}
			$keterangan = $sukses.' Penghargaan';
			Aktifitas::create([
				'unique_id'	=> $masterno,
				'kelompok'	=> 'Dosen',
				'keterangan'=> $keterangan
			]);	
			if ($gagal != ''){
				echo $gagal;
			} else {
				echo $sukses;
			}
		}
		else {
			echo 'Pastikan Semua Isian Terisi Dengan Benar';
		}
	}
	public function jsondataPenghargaan(Request $request) {
    	$masterno    	= $request->input('val01');
		$homebase		= url("/");
		$hasil		= DB::table('kp_pegawai')
					->join('db_detailpegawai', 'kp_pegawai.id', 'db_detailpegawai.no')
					->where('kp_pegawai.id', $masterno)
					->first();
		$tlsjabatan 	= $hasil->status_jabatan.' '.$hasil->pns;
		$tlsprodi 		= $hasil->prodihomebase.' '.$hasil->jenjanghomebase;
		$setnama 		= $hasil->nama;
		$nama 			= $hasil->nama_lengkap;
		$jenisnip 		= $hasil->jenisnip;
		$nip 			= $hasil->nip_baru;
		$arraydata		= [];
		$rsurat  		= Detailpenghargaan::where('no', $masterno)->get();
		if (!empty($rsurat)){
			foreach ($rsurat as $hasil) {
				$bukti 		= $hasil->bukti;
				$cekbentuk 	= explode('://', $bukti);
				if (isset($cekbentuk[1])){

				} else {
					$bukti	= $homebase.'/images/'.$hasil->no.'/'.$bukti;
					Detailpenghargaan::where('id', $hasil->id)->update([
						'bukti'	=> $bukti
					]);
				}
				$arraydata[] = array(
					'id' 			=> $hasil->id,		
					'nama' 			=> $nama,
					'nip' 			=> $nip,
					'no' 			=> $hasil->no,
					'penghargaan' 	=> $hasil->penghargaan,
					'nosk' 			=> $hasil->nosk,
					'tanggal' 		=> $hasil->tanggal,
					'keterangan' 	=> $hasil->keterangan,
					'pemberi' 		=> $hasil->pemberi,
					'pejabat' 		=> $hasil->pejabat,
					'bukti' 		=> '<a href="'.$bukti.'" target="_blank">'.$bukti.'</a>',
				);
			}
		}
		echo json_encode($arraydata);
	}
//END BLOK RIWAYAT DOSEN
}