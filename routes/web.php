<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebinarController;
// use App\Http\Controllers\Page;
// use App\Http\Controllers\KomplainController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\GuruController;
// use App\Http\Controllers\OrtuController;
// use App\Http\Controllers\HatiraController;
use App\Http\Controllers\AIPKIController;
// use App\Http\Controllers\LeapNetworkController;
use App\Http\Controllers\RecruitmentController;
// use App\Http\Controllers\SendMail;
// use App\Http\Controllers\ProjectRITA;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\AlQalamController;
use App\Http\Controllers\BankSoalController;
// use App\Http\Controllers\ArsipdinamisController;
// use App\Http\Controllers\PDSRPPRPIController;
// use App\Http\Controllers\Sco\SCOUserController;
// use App\Http\Controllers\Sco\LayananMahasiswaController;
// use App\Http\Controllers\Api\Config_Controller;
// use App\Http\Controllers\Api\Master_Controller;
// use App\Http\Controllers\Api\Tr_Berita;
// use App\Http\Controllers\Api\Tr_Hewan;
// use App\Http\Controllers\Api\Tr_Manusia;
// use App\Http\Controllers\Api\Tr_Print;
// use App\Http\Controllers\Auth_User_Role\Auth_Controller;

///////////////// NON LOGIN PAGE ////////////////////////

Route::get('/', [AuthController::class, 'viewAuth']);
Route::get('landingpage', [AuthController::class, 'viewAuth']);
// Route::get('frontpage', [FrontpageController::class, 'FrontPageindex']);
// Route::get('landingapps/{id}', [FrontpageController::class, 'viewLandingApps']);
// Route::get('allportal/{id}', [FrontpageController::class, 'AllPortal']);
// Route::get('cekandroid/{id}', [FrontpageController::class, 'getFirebaseaccount']);
// Route::get('siap', [FrontpageController::class, 'SiapdokIndex'])->name('siap');
// Route::get('login', [FrontpageController::class, 'login'])->name('login');
// Route::get('/forgotpass',[FrontpageController::class, 'forgotpass'])->name('forgotpass');
// Route::get('portalris/{id}', [FrontpageController::class, 'risPortal']);
// Route::get('bukutamu', [FrontpageController::class, 'bukuTamu']);
// Route::get('tracerstudy', [FrontpageController::class, 'viewTracerstudy']);
// Route::get('simpen', [FrontpageController::class, 'eRental']);
// Route::get('tracking', [FrontpageController::class, 'viewTrackinguser']);
// Route::get('vokasi', [FrontpageController::class, 'viewVokasi']);
// Route::get('sivoka', [FrontpageController::class, 'viewVokasi']);
// Route::get('pps', [FrontpageController::class, 'viewPpsUB']);
// Route::get('evaluasiperkuliahanvokasi', [FrontpageController::class, 'viewEvaluasiperkuliahanvokasi']);
// Route::get('evaluasiperkuliahanpps', [FrontpageController::class, 'viewEvaluasiperkuliahanpps']);
// Route::get('mipa', [FrontpageController::class, 'viewMipa']);
// Route::get('fp', [FrontpageController::class, 'viewPertanian']);
// Route::get('ft', [FrontpageController::class, 'viewTeknik']);
// Route::get('filkom', [FrontpageController::class, 'viewFilkom']);
// Route::get('fh', [FrontpageController::class, 'viewHukum']);
// Route::get('fia', [FrontpageController::class, 'viewFadministrasi']);
// Route::get('fk', [FrontpageController::class, 'viewKedokteran']);
// Route::get('fib', [FrontpageController::class, 'viewBudaya']);
// Route::get('fpik', [FrontpageController::class, 'viewPerikanan']);
// Route::get('feb', [FrontpageController::class, 'viewEkonomi']);
// Route::get('fkg', [FrontpageController::class, 'viewKedokteranGigi']);
// Route::get('fapet', [FrontpageController::class, 'viewPeternakan']);
// Route::get('fisip', [FrontpageController::class, 'viewPsikologi']);
// Route::get('fkh', [FrontpageController::class, 'viewKedokteranHewan']);
// Route::get('ftp', [FrontpageController::class, 'viewTeknologiPertanian']);
// Route::get('fikes', [FrontpageController::class, 'viewFikes']);
// Route::get('ubkediri', [FrontpageController::class, 'viewUBKediri']);
// Route::get('ubjakarta', [FrontpageController::class, 'viewUBJakarta']);
// Route::get('/registerFT', [FrontpageController::class, 'viewRegMHSFT'])->name('viewregmhs01');
// Route::get('/registerFILKOM', [FrontpageController::class, 'viewRegMHSFILKOM'])->name('viewregmhs02');
// Route::get('/registerFIA', [FrontpageController::class, 'viewRegMHSFIA'])->name('viewregmhs03');
// Route::get('/registerFK', [FrontpageController::class, 'viewRegMHSFK'])->name('viewregmhs04');
// Route::get('/registerFIB', [FrontpageController::class, 'viewRegMHSFIB'])->name('viewregmhs05');
// Route::get('/registerFPIK', [FrontpageController::class, 'viewRegMHSFPIK'])->name('viewregmhs06');
// Route::get('/registerFEB', [FrontpageController::class, 'viewRegMHSFEB'])->name('viewregmhs07');
// Route::get('/registerFKG', [FrontpageController::class, 'viewRegMHSFKG'])->name('viewregmhs08');
// Route::get('/registerFAPET', [FrontpageController::class, 'viewRegMHSFAPET'])->name('viewregmhs09');
// Route::get('/registerFISIP', [FrontpageController::class, 'viewRegMHSFISIP'])->name('viewregmhs10');
// Route::get('/registerFKH', [FrontpageController::class, 'viewRegMHSFKH'])->name('viewregmhs11');
// Route::get('/registerFTP', [FrontpageController::class, 'viewRegMHSFTP'])->name('viewregmhs12');
// Route::get('/registerFH', [FrontpageController::class, 'viewRegMHSFH'])->name('viewregmhs13');
// Route::get('/registerFMIPA', [FrontpageController::class, 'viewRegMHSFMIPA'])->name('registerFMIPA');
// Route::get('/registerFP', [FrontpageController::class, 'viewRegMHSFP'])->name('registerFP');
// Route::get('/registerPPS', [FrontpageController::class, 'viewRegMHSPPS'])->name('viewregmhs16');
// Route::get('/registerPASCAUB', [FrontpageController::class, 'viewRegMHSPPS'])->name('viewregmhs16');
// Route::get('/registerVokasi', [FrontpageController::class, 'viewRegMHSVokasi'])->name('viewregmhs17');
// Route::get('/registerFIKES', [FrontpageController::class, 'viewRegMHSFIKES'])->name('viewregmhs18');
// Route::get('/registerPSLKU', [FrontpageController::class, 'viewRegMHSPSLKU'])->name('viewregmhs19');
// Route::get('/registerPSDKUJAKARTA', [FrontpageController::class, 'viewRegMHSPSDKUJAKARTA'])->name('viewregmhs20');

///////////////// END NON LOGIN PAGE ////////////////////////
// Route::get('logkhusus/{id}', [AuthController::class, 'authenticatekhusus'])->name('logkhusus');
// Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
// Route::post('authenticatesiapdok', [AuthController::class, 'authenticateSIAPDOK'])->name('authenticateSIAPDOK');
// Route::post('exsimpanpendaftaran', [AuthController::class, 'exSimpanpendaftaran'])->name('exsimpanpendaftaran');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('trackingid/{id}', [AuthController::class, 'viewTrackingbyid']);
// Route::get('zis', [AuthController::class, 'zis'])->name('zis');
// Route::get('ppdb', [AuthController::class, 'ppdb'])->name('ppdb');
// Route::get('pip', [AuthController::class, 'pip'])->name('pip');
// Route::get('ceking/{id}', [AuthController::class, 'cekingPembayaran']);
// Route::get('karpes/{id}', [AuthController::class, 'viewKarpes']);
// Route::get('observasi/{id}', [AuthController::class, 'viewObservasi']);
// Route::get('biodatapsb/{id}', [AuthController::class, 'viewBiodatapsb']);
// Route::get('qrbgimage/{id}', [AuthController::class, 'viewQRBGImage']);
// Route::get('raport/{id}', [AuthController::class, 'viewRaport']);
// Route::get('verifikasi/{id}', [AuthController::class, 'verifikasiPembayaran']);
// Route::get('kwitansi/{id}', [AuthController::class, 'ctkKwitansi']);
// Route::get('ctkkwt/{id}', [AdminController::class, 'exKwitansiByID']);
// Route::get('ttdkwitansi/{id}', [AuthController::class, 'TtdKwitansi']);
// Route::get('formkesanggupan/{id}', [AuthController::class, 'ctkFormkesanggupan']);
// Route::post('ppdb/daftar', [AuthController::class, 'exPpdb'])->name('exPpdb');
// Route::post('ppdb/savefileppdb', [AuthController::class, 'exSavefileppdb'])->name('exSavefileppdb');
// Route::post('ppdb/saveberkasppdb', [AuthController::class, 'exSaveberkasppdb'])->name('exSaveberkasppdb');
// Route::post('ppdb/ceknikppdb', [AuthController::class, 'exCeknikppdb'])->name('exCeknikppdb');
// Route::post('ppdb/getkodependaf', [AuthController::class, 'exGetkodependaf'])->name('exGetkodependaf');
// Route::post('ppdb/datacalonsiswa', [AuthController::class, 'jsonDatacalonsiswa'])->name('jsonDatacalonsiswa');
// Route::post('pip/saveabsen', [AuthController::class, 'exPresensiviewPIP'])->name('exPresensiviewPIP');
// Route::post('kwitansi/expersetujuanberkas', [AuthController::class, 'expersetujuanBerkas'])->name('expersetujuanBerkas');
// Route::post('rapot/getstatkd', [AuthController::class, 'jsonStatistikkd'])->name('jsonStatistikkd');
// Route::post('rapot/getstatpermuatan', [AuthController::class, 'jsonStatpermuatan'])->name('jsonStatpermuatan');

// Route::post('tamu/exbukutamu', [AdminController::class, 'exbukuTamu'])->name('exbukutamu');
// Route::post('tamu/bukutamu', [AdminController::class, 'bukuTamu'])->name('bukuTamu');
// Route::post('tamu/rekaptamu', [AdminController::class, 'rekapTamu'])->name('rekapTamu');
// Route::post('tamu/carilaptamu', [AdminController::class, 'exTamucari'])->name('exTamucari');
// ///////////////E-COMPLAIN////////////////////////
// Route::get('datakeluhan', [KomplainController::class, 'viewLapKomplain']);
// Route::get('komplain', [LayananMahasiswaController::class, 'viewKomplain']);
// Route::post('komplain/savekomplain', [KomplainController::class, 'saveKomplain'])->name('savekomplain');
// Route::post('komplain/savetanggapan', [KomplainController::class, 'saveTanggapan'])->name('savetanggapan');
// Route::post('komplain/saverating', [KomplainController::class, 'saveRating'])->name('saverating');
// Route::get('komplain/getkomplainpribadi', [KomplainController::class, 'getKomplainpribadi'])->name('getkomplainpribadi');
// Route::post('komplain/getdatakeluhan', [KomplainController::class, 'getdataKeluhan'])->name('getdatakeluhan');
// Route::get('komplain/statjrating', [KomplainController::class, 'statjRating'])->name('statjrating');
// Route::get('komplain/statunitkerja', [KomplainController::class, 'statUnitkerja'])->name('statunitkerja');

Route::group(['middleware' => 'project.simaster'], function() {
	Route::get('dashbord', [FrontpageController::class, 'index']);
	Route::post('surat/chatgetlist', [FrontpageController::class, 'chatGetlist'])->name('chatGetlist');
	Route::post('surat/catting', [FrontpageController::class, 'cattingSurat'])->name('cattingSurat');
	
	Route::get('jrekapthnini', [AdminController::class, 'jrekapthnini']);
	Route::get('lapamil', [AdminController::class, 'viewAmilZIS']);
	Route::post('jalldata', [AdminController::class, 'jallData'])->name('jallData');
	Route::post('exverifikasi', [AdminController::class, 'exVerifikasi'])->name('exVerifikasi');
	
	Route::get('datainduk', [AdminController::class, 'viewDatainduk']);
	Route::post('admin/datainduk', [AdminController::class, 'exDatainduk'])->name('exDatainduk');
	Route::post('admin/upddatainduk', [AdminController::class, 'exupdDatainduk'])->name('exupdDatainduk');
	Route::post('excutor/simpanmutasi', [AdminController::class, 'exSimpanmutasi'])->name('exSimpanmutasi');
	Route::get('json/datainduk', [AdminController::class, 'jsonDatainduk'])->name('jsonDatainduk');
	Route::post('json/caridatainduk', [AdminController::class, 'jsonCariDatainduk'])->name('jsonCariDatainduk');
	
	Route::get('dataindukstaff', [AdminController::class, 'viewDataindukstaff']);
	Route::post('admin/dataindukstaff', [AdminController::class, 'exDataindukstaf'])->name('exDataindukstaf');
	Route::post('admin/upddataindukstaf', [AdminController::class, 'exupdDataindukstaff'])->name('exupdDataindukstaff');
	Route::get('json/dataindukstaf', [AdminController::class, 'jsonDataindukstaff'])->name('jsonDataindukstaff');
	
	Route::get('setkeuangan', [AdminController::class, 'viewSetkeuangan']);
	Route::get('json/setinsidental', [AdminController::class, 'jsonSetinsidental'])->name('jsonSetinsidental');
	Route::get('json/ekskul', [AdminController::class, 'jsonEkskul'])->name('jsonEkskul');
	Route::post('admin/simpaninsidental', [AdminController::class, 'exInsidental'])->name('exInsidental');
	Route::post('admin/saveekskul', [AdminController::class, 'exEkskul'])->name('exEkskul');
	Route::post('json/setkeuangan', [AdminController::class, 'jsonSetkeuangan'])->name('jsonSetkeuangan');
	Route::post('admin/simpansetkeuangan', [AdminController::class, 'exSetkeuangan'])->name('exSetkeuangan');
	
	Route::get('lapbayar', [AdminController::class, 'viewLapbayar']);
	Route::post('cetak/kwitansimulti', [AdminController::class, 'ctkKwitansimulti'])->name('ctkKwitansimulti');
	Route::post('cetak/viewdetailtu', [AdminController::class, 'ctkViewdetailtu'])->name('ctkViewdetailtu');
	Route::post('admin/exmultiverified', [AdminController::class, 'exMultiverified'])->name('exMultiverified');
	Route::post('admin/exrekaptunggakankelas', [AdminController::class, 'exRekaptunggakankelas'])->name('exRekaptunggakankelas');
	Route::post('json/lapinsidental', [AdminController::class, 'jsonLapinsidental'])->name('jsonLapinsidental');
	Route::post('json/lapbulanan', [AdminController::class, 'jsonLapbulanan'])->name('jsonLapbulanan');
	Route::post('json/laplengkap', [AdminController::class, 'jsonLaplengkap'])->name('jsonLaplengkap');
	Route::post('json/laplengkapperjenis', [AdminController::class, 'jsonLaplengkapperjenis'])->name('jsonLaplengkapperjenis');
	Route::post('json/rekapharian', [AdminController::class, 'jsoRekapharian'])->name('jsoRekapharian');
	Route::post('json/rincianharian', [AdminController::class, 'jsoRincianharian'])->name('jsoRincianharian');
	Route::post('json/rincianlastortu', [AdminController::class, 'jsonRincianlastortu'])->name('jsonRincianlastortu');
	Route::post('json/rincianbyrortu', [AdminController::class, 'jsonRincianbyrortu'])->name('jsonRincianbyrortu');
	Route::post('admin/manualbyr', [AdminController::class, 'exManualbyr'])->name('exManualbyr');
	Route::post('admin/editorbyr', [AdminController::class, 'exEditorbyr'])->name('exEditorbyr');
	Route::get('json/databayar', [AdminController::class, 'jsonDatabayar'])->name('jsonDatabayar');
	Route::post('admin/verifiedpembayaran', [AdminController::class, 'exvVerifiedpembayaran'])->name('exvVerifiedpembayaran');
	
	Route::get('laptabungan', [AdminController::class, 'viewLaptabungan']);
	Route::post('json/laptabunganharian', [AdminController::class, 'jsonLaptabunganharian'])->name('jsonLaptabunganharian');
	Route::post('json/caritabungan', [AdminController::class, 'jsonCaritabungan'])->name('jsonCaritabungan');
	Route::post('admin/tabung', [AdminController::class, 'exTabung'])->name('exTabung');
	Route::post('json/byrmanual', [AdminController::class, 'jsonByrmanual'])->name('jsonByrmanual');
	Route::get('json/tabungan', [AdminController::class, 'jsonTabungan'])->name('jsonTabungan');
	
	Route::get('logkeuangan', [AdminController::class, 'viewLogkeuangan']);
	Route::get('programpip', [AdminController::class, 'viewProgrampip']);
	Route::post('admin/exsimpandatapip', [AdminController::class, 'exSimpandataPIP'])->name('exSimpandataPIP');
	Route::post('admin/jsonpresensipipview', [AdminController::class, 'jsonPresensiPIPview'])->name('jsonPresensiPIPview');
	Route::get('json/dataprogrampip', [AdminController::class, 'jsonDataprogramPIP'])->name('jsonDataprogramPIP');
	
	Route::get('lapppdb', [AdminController::class, 'viewLapppdb']);
	Route::post('admin/uploadkeuanganppdb', [AdminController::class, 'exUploadkeuanganppdb'])->name('exUploadkeuanganppdb');
	Route::post('admin/exsimpandataujian', [AdminController::class, 'exSimpandataujian'])->name('exSimpandataujian');
	Route::post('admin/simpanhasilppdb', [AdminController::class, 'exSimpanhasilppdb'])->name('exSimpanhasilppdb');
	Route::post('admin/saveupdateppdb', [AdminController::class, 'exSaveupdateppdb'])->name('exSaveupdateppdb');
	Route::post('cetak/kwitansipsb', [AdminController::class, 'ctkKwitansipsb'])->name('ctkKwitansipsb');
	Route::post('admin/savearsipppdb', [AdminController::class, 'exSavearsipppdb'])->name('exSavearsipppdb');
	Route::post('admin/saveverifikasipsb', [AdminController::class, 'exSaveverifikasipsb'])->name('exSaveverifikasipsb');
	Route::post('admin/savesettingssppdpp', [AdminController::class, 'exSavesettingssppdpp'])->name('exSavesettingssppdpp');
	Route::post('admin/savesettingppdb', [AdminController::class, 'exSavesettingppdb'])->name('exSavesettingppdb');
	Route::post('admin/savenilaippdb', [AdminController::class, 'exSavenilaippdb'])->name('exSavenilaippdb');
	Route::get('json/jjadwalujianppdb', [AdminController::class, 'jsonJadwalujianppdb'])->name('jsonJadwalujianppdb');
	Route::get('json/datapembelianform', [AdminController::class, 'jsonDatapembelianform'])->name('jsonDatapembelianform');
	Route::post('json/detailpembeli', [AdminController::class, 'jsonDetailpembeli'])->name('jsonDetailpembeli');
	Route::get('json/datappdb', [AdminController::class, 'jsonDatappdb'])->name('jsonDatappdb');
	
	
	Route::get('minimi', [AdminController::class, 'viewMinimi']);
	Route::post('admin/exsavebuku', [AdminController::class, 'exSavebuku'])->name('exSavebuku');
	Route::post('admin/expeminjaman', [AdminController::class, 'exPeminjaman'])->name('exPeminjaman');
	Route::get('json/jsonbuku', [AdminController::class, 'jsonBuku'])->name('jsonBuku');
	Route::post('json/jsonbukucari', [AdminController::class, 'jsonBukucari'])->name('jsonBukucari');
	Route::post('json/jsonpeminjamanbuku', [AdminController::class, 'jsonPeminjaman'])->name('jsonPeminjaman');
	Route::post('admin/destroyer', [AdminController::class, 'exDestroyer'])->name('exDestroyer');
	
	Route::get('pengumuman', [AdminController::class, 'viewPengumuman']);
	Route::post('admin/pengumuman', [AdminController::class, 'exPengumuman'])->name('exPengumuman');
	
	Route::get('setting', [AdminController::class, 'viewSetting']);	
	Route::get('sekolah', [AdminController::class, 'viewSekolah']);	
	Route::get('json/datasekolah', [AdminController::class, 'jsonDatasekolah'])->name('jsonDatasekolah');
	Route::post('admin/uploaddatainduk', [AdminController::class, 'exUploaddatainduk'])->name('exUploaddatainduk');
	Route::post('admin/uploadkeuangan', [AdminController::class, 'exUploadkeuangan'])->name('exUploadkeuangan');
	Route::post('admin/savesetting', [AdminController::class, 'exSavesetting'])->name('exSavesetting');
	Route::post('admin/savesekolah', [AdminController::class, 'exSavesekolah'])->name('exSavesekolah');
	Route::post('admin/updatesekolah', [AdminController::class, 'exUpdatesekolah'])->name('exUpdatesekolah');
	Route::post('admin/onofflayanan', [AdminController::class, 'exOnofflayanan'])->name('exOnofflayanan');
	Route::post('admin/exprofilesekolah', [AdminController::class, 'exProfilesekolah'])->name('exProfilesekolah');
	
	Route::get('prestasisiswa', [AdminController::class, 'viewPrestasisiswa']);	
	Route::get('jrekapprestasithniniperbidang', [AdminController::class, 'jsonPrestasithniniperbidang']);	
	Route::get('jrekapprestasithnini', [AdminController::class, 'jsonPrestasithnini']);	
	Route::post('admin/exsimpanprestasi', [AdminController::class, 'exSimpanprestasi'])->name('exSimpanprestasi');
	Route::post('admin/jalldataprestasi', [AdminController::class, 'jsonAlldataprestasi'])->name('jsonAlldataprestasi');
	
	Route::get('sarpras', [AdminController::class, 'viewSarpras']);
	Route::get('umum/allkendaraan', [AdminController::class, 'getallkendaraan']);
	Route::get('umum/allgarasi', [AdminController::class, 'getallgarasi']);
	Route::post('umum/exkendaraan', [AdminController::class, 'exKendaraan'])->name('exkendaraan');
	Route::post('umum/storepinjamkendaraan', [AdminController::class, 'storepinjamkendaraan']);
	Route::post('umum/hapuspinjamkendaraan', [AdminController::class, 'hapuspinjamkendaraan']);
	Route::post('umum/getaktifitaskendaraan', [AdminController::class, 'getAktifitaskendaraan'])->name('getAktifitaskendaraan');
	Route::get('umum/getlistkendaraan', [AdminController::class, 'getlistKendaraan'])->name('getlistkendaraan');
	
	Route::post('umum/ctkdir', [AdminController::class, 'ctkdir'])->name('ctkdir');
	Route::get('umum/allruang', [AdminController::class, 'getallruang']);
    Route::get('umum/allgedung', [AdminController::class, 'getallgedung']);
	Route::post('umum/getrekapdetailruang', [AdminController::class, 'getrekapdetailruang']);
	Route::post('umum/getdetailruang', [AdminController::class, 'getdetailruang']);
	Route::post('umum/exfasruang', [AdminController::class, 'exfasruang'])->name('exfasruang');
	Route::post('umum/exruang', [AdminController::class, 'exruang'])->name('exruang');
	
	Route::get('datakeuhptmasuk', [AdminController::class, 'viewDatamasuk']);
	Route::get('laporankeuhpt', [AdminController::class, 'viewLaporan']);
	Route::post('json/laporanbulanan', [AdminController::class, 'getLaporanbulanan'])->name('getLaporanbulanan');	
	Route::post('cetak/laporanbulanan', [AdminController::class, 'exLaporanbulanan'])->name('exLaporanbulanan');
	Route::get('json/keuangan', [AdminController::class, 'getDatakeuangan'])->name('getDatakeuangan');
	Route::post('json/keuanganeo', [AdminController::class, 'getDatakeuanganEO'])->name('getDatakeuanganEO');
    Route::post('cetak/kwitansi', [AdminController::class, 'exKwitansi'])->name('exKwitansi');
	Route::get('json/rekapsaldo', [AdminController::class, 'getRekapsaldo'])->name('getRekapsaldo');
    Route::get('json/rekaphutang', [AdminController::class, 'getrekapHutang'])->name('getrekapHutang');
	Route::post('excutor/simpantransaksi', [AdminController::class, 'simpanTransaksi'])->name('simpanTransaksi');
	Route::post('excutor/exvalidasikwitansi', [AdminController::class, 'exValidasiKwitansi'])->name('exValidasiKwitansi');
	

	// Route::get('lapekskul', [GuruController::class, 'viewLapekskul']);
	// Route::get('penilaianekskul', [GuruController::class, 'viewNilekskul']);
	// Route::post('json/rincianekskul', [GuruController::class, 'jsonRincianekskul'])->name('jsonRincianekskul');
	// Route::get('nilekskul/{id}', [GuruController::class, 'viewPenEkskul']);
	
	// Route::get('lapabsen', [GuruController::class, 'viewLapabsen']);
	// Route::get('json/presensiadmin', [GuruController::class, 'jsonPresensi'])->name('jsonPresensi');
	
	// Route::get('settema', [GuruController::class, 'viewSettema']);
	// Route::post('json/jsontema', [GuruController::class, 'jsonTema'])->name('jsonTema');
	// Route::post('guru/simpandatatema', [GuruController::class, 'exSimpandatatema'])->name('exSimpandatatema');
	// Route::post('guru/ubahdatatema', [GuruController::class, 'exUbahdatatema'])->name('exUbahdatatema');
	
	// Route::get('setkkm', [GuruController::class, 'viewSetkkm']);
	// Route::post('json/datakkm', [GuruController::class, 'jsonDatakkm'])->name('jsonDatakkm');
	// Route::post('guru/exdatakkm', [GuruController::class, 'exDatakkm'])->name('exDatakkm');
	
	// Route::get('kodekd', [GuruController::class, 'viewKodekd']);
	// Route::post('json/jsdatakd', [GuruController::class, 'jsonDatakd'])->name('jsonDatakd');
	// Route::post('guru/exdatakodekd', [GuruController::class, 'exDatakodekd'])->name('exDatakodekd');
	
	// Route::get('lognilai', [GuruController::class, 'viewLognilai'])->name('lognilai');
	// Route::get('kelas/{id}', [GuruController::class, 'viewGradeperkelas']);
	// Route::get('jilid/{id}', [GuruController::class, 'viewNgaji']);
	
	// Route::post('guru/uploadnilai', [GuruController::class, 'exUploadnilai'])->name('exUploadnilai');
	// Route::post('guru/uploaddatakd', [GuruController::class, 'exUploaddatakd'])->name('exUploaddatakd');
	// Route::post('guru/uploaddatakkm', [GuruController::class, 'exUploaddatakkm'])->name('exUploaddatakkm');
	// Route::post('guru/inputnilai', [GuruController::class, 'exInputnilai'])->name('exInputnilai');
	// Route::post('guru/inputdatadirisiswa', [GuruController::class, 'exInputdatadiri'])->name('exInputdatadiri');
	// Route::post('guru/inputabsenekskul', [GuruController::class, 'exInputabsenekskul'])->name('exInputabsenekskul');
	// Route::post('guru/inputnilaiekskul', [GuruController::class, 'exInputnilaiekskul'])->name('exInputnilaiekskul');
	// Route::get('json/lognilai', [GuruController::class, 'jsonLognilai'])->name('jsonLognilai');
	// Route::post('json/rinciannilai', [GuruController::class, 'jsonRinciannilai'])->name('jsonRinciannilai');
	// Route::post('guru/exverpresensi', [GuruController::class, 'exVerpresensi'])->name('exVerpresensi');
	// Route::post('guru/saveabsenall', [GuruController::class, 'exSaveabsenall'])->name('exSaveabsenall');
	// Route::post('guru/saveditnilai', [GuruController::class, 'exSaveditnilai'])->name('exSaveditnilai');
	// Route::post('guru/exmultinaikkls', [GuruController::class, 'exMultinaikkls'])->name('exMultinaikkls');
	// Route::post('guru/savesetguru', [GuruController::class, 'exSavesetguru'])->name('exSavesetguru');
	// Route::post('guru/savenaikkelas', [GuruController::class, 'exSavenaikkelas'])->name('exSavenaikkelas');
	// Route::post('json/datakurikulumkelas', [GuruController::class, 'jsonDatakurikulumkelas'])->name('jsonDatakurikulumkelas');
	// Route::post('json/jsonformatupload', [GuruController::class, 'jsonFormatupload'])->name('jsonFormatupload');
	// Route::post('cetak/biodatarapot', [GuruController::class, 'ctkBiodatarapot'])->name('ctkBiodatarapot');
	// Route::post('json/datanilaikelas', [GuruController::class, 'jsonDatanilaikelas'])->name('jsonDatanilaikelas');
	// Route::post('json/dataabsenkelas', [GuruController::class, 'jsonDataabsenkelas'])->name('jsonDataabsenkelas');
	// Route::post('json/presensicari', [GuruController::class, 'jsonPresensicari'])->name('jsonPresensicari');
	// Route::post('json/genrapot', [GuruController::class, 'jsonGenrapot'])->name('jsonGenrapot');
	
	// Route::post('json/dataabsenekskul', [GuruController::class, 'jsonDataabsenekskul'])->name('jsonDataabsenekskul');
	// Route::post('json/presensiekskulcari', [GuruController::class, 'jsonPresensiekskulcari'])->name('jsonPresensiekskulcari');
	
	// Route::post('json/datasetorantahfid', [GuruController::class, 'jsonSetoranTahfid'])->name('jsonSetoranTahfid');
	// Route::post('exinputsetoranhafid', [GuruController::class, 'exInputsetoran'])->name('exInputsetoran');
	
	// Route::get('konseling', [GuruController::class, 'viewKonseling']);
	// Route::get('jrekapkonselingperjenis', [GuruController::class, 'jsonKonselingperbidang']);	
	// Route::get('jrekapkonselingthnini', [GuruController::class, 'jsonKonselingthnini']);	
	// Route::post('guru/exsimpankonseling', [GuruController::class, 'exSimpankonseling'])->name('exSimpankonseling');
	// Route::post('guru/jalldatakonseling', [GuruController::class, 'jsonAlldatakonseling'])->name('jsonAlldatakonseling');
	
	
	// Route::get('biodata', [OrtuController::class, 'index']);
	// Route::get('ijinortu', [OrtuController::class, 'viewIjin']);
	// Route::post('ortu/exsimpanijin', [OrtuController::class, 'exSimpanijin'])->name('exSimpanijin');
	
	// Route::get('lapnilaiortu', [OrtuController::class, 'viewLapnilaiortu']);
	// Route::get('ortu/nilaisiswa', [OrtuController::class, 'jsonNilaisiswa'])->name('jsonNilaisiswa');
	// Route::post('ortu/exsimpanmhnremidi', [OrtuController::class, 'exSimpanmhnremidi'])->name('exSimpanmhnremidi');
	
	
	// Route::get('tagihanrutin', [OrtuController::class, 'viewTagihanrutin']);
	// Route::post('ortu/exuploadbuktibyr', [OrtuController::class, 'exUploadbuktibyr'])->name('exUploadbuktibyr');
	// Route::post('ortu/bayariuran', [OrtuController::class, 'exBayariuran'])->name('exBayariuran');
	// Route::post('ortu/bayariuranins', [OrtuController::class, 'exBayariuranins'])->name('exBayariuranins');
	// Route::get('json/insidental', [OrtuController::class, 'jsonInsidental'])->name('jsonInsidental');
	// Route::get('json/databayarortu', [OrtuController::class, 'jsonDatabayarortu'])->name('jsonDatabayarortu');
	
	// Route::get('tabungan', [OrtuController::class, 'viewTabungan']);
	// Route::get('daftarekskul', [OrtuController::class, 'viewDaftarekskul']);
	// Route::post('json/daftarekskul', [OrtuController::class, 'jsonDaftarekskul'])->name('jsonDaftarekskul');
	// Route::post('ortu/daftarekskul', [OrtuController::class, 'exDaftarekskul'])->name('exDaftarekskul');
	
	// Route::get('faqihkecil', [OrtuController::class, 'viewFaqihKecil']);
	
	Route::get('useranyar', [UserController::class, 'viewUser']);
	Route::get('profile', [UserController::class, 'viewProfile']);
	Route::post('exusername', [UserController::class, 'exUsername'])->name('exusername');
	Route::post('exdaftarortu', [UserController::class, 'exDaftarortu'])->name('exDaftarortu');
	Route::post('user/anyaridata', [UserController::class, 'exProfileupdate'])->name('exProfileupdate');
	Route::get('getallusername', [UserController::class, 'getAllusername'])->name('getallusername');
	
    
	// Account Managemen
	Route::get('usersadmin',[UserController::class, 'viewUserAdmin'])->name('viewUserAdmin');
    Route::get('argonuseradmin',[UserController::class, 'viewUserAdminArgonThem'])->name('argonuseradmin');
    Route::get('datauserall', [UserController::class, 'dataUserAll'])->name('dataUserAll');
	Route::get('/berkaspelamar',[UserController::class, 'viewBerkasPelamar'])->name('viewBerkasPelamar');
    Route::get('/profiluser',[UserController::class, 'viewDataInduk'])->name('viewDataInduk');
    Route::get('/argonprofil',[UserController::class, 'viewDataIndukArgonThem'])->name('argonprofil');
    Route::post('getnotifcount', [UserController::class, 'cekNotifikasi'])->name('cekNotifikasi');
	Route::post('dokar/exbiodatadiri', [UserController::class, 'simpanDatadiri'])->name('simpanDatadiri');

	// Route::get('user', [SCOUserController::class, 'index']);
	// Route::get('settingsurat', [SCOUserController::class, 'settingsurat']);
	// Route::get('lembaga', [SCOUserController::class, 'lembaga']);
	// Route::post('user/store', [SCOUserController::class, 'store']);
	// Route::post('user/getUser', [SCOUserController::class, 'getUser'])->name('getUser');
	// Route::post('user/extambahdatauser', [SCOUserController::class, 'exTambahdatauser'])->name('extambahdatauser');
	// Route::post('user/exubahjabatan', [SCOUserController::class, 'exUbahjabatan'])->name('exubahjabatan');
	// Route::post('user/exhapususer', [SCOUserController::class, 'exHapususer'])->name('exhapususer');
	// Route::post('user/jalluser', [SCOUserController::class, 'jAlluser'])->name('jalluser');
	// Route::post('user/jklasifikasi', [SCOUserController::class, 'jKlasifikasi'])->name('jklasifikasi');
	// Route::post('user/jklasifikasicari', [SCOUserController::class, 'jklasifikasiCari'])->name('jklasifikasicari');
	// Route::post('user/jdisposisi', [SCOUserController::class, 'jDisposisi'])->name('jdisposisi');
	// Route::post('user/jjenissurat', [SCOUserController::class, 'jJenissurat'])->name('jjenissurat');
	// Route::post('user/junitsrt', [SCOUserController::class, 'jUnitsrt'])->name('junitsrt');
	// Route::post('user/jnonpejabat', [SCOUserController::class, 'jNonpejabat'])->name('jnonpejabat');
	// Route::post('user/jpejabat', [SCOUserController::class, 'jPejabat'])->name('jpejabat');
	// Route::post('user/exdisposisi', [SCOUserController::class, 'exDisposisi'])->name('exdisposisi');
	// Route::post('user/exjenis', [SCOUserController::class, 'exJenis'])->name('exjenis');
	// Route::post('user/exunit', [SCOUserController::class, 'exUnit'])->name('exunit');
	// Route::post('user/exnonpejabat', [SCOUserController::class, 'exNonpejabat'])->name('exnonpejabat');
	// Route::post('user/expejabat', [SCOUserController::class, 'exPejabat'])->name('expejabat');
	// Route::post('user/detaildispos', [SCOUserController::class, 'detailDispos'])->name('detaildispos');
	// Route::post('user/exklasifikasi', [SCOUserController::class, 'exKlasifikasi'])->name('exklasifikasi');
	// Route::post('user/exlinkkan', [SCOUserController::class, 'exLinkkan'])->name('exlinkkan');
	// Route::post('user/exmenus', [SCOUserController::class, 'exMenus'])->name('exmenus');
	// Route::post('user/updatepass', [SCOUserController::class, 'updatePass'])->name('updatepass');
	// Route::post('user/uploadphoto', [SCOUserController::class, 'uploadPhoto'])->name('uploadphoto');
    // Route::post('user/exlembaga', [SCOUserController::class, 'exLembaga'])->name('exlembaga');
	// Route::post('user/anyaridata', [SCOUserController::class, 'anyariData'])->name('anyaridata');
	// Route::post('user/exsynclembaga', [SCOUserController::class, 'exSynclembaga'])->name('exSynclembaga');
    // Route::get('user/jalllembaga', [SCOUserController::class, 'jAlllembaga'])->name('jalllembaga');
	// Route::post('user/exsetpejabat', [SCOUserController::class, 'exsetPejabat'])->name('exsetpejabat');
    
});
// Route::get('sch/{id}', [AlQalamController::class, 'viewLandingSCH']);

// Route::group(['middleware' => 'project.alqalam'], function() {
// 	Route::get('alqalam', [AlQalamController::class, 'viewIndex']);
// 	Route::get('dashboardpaguyuban', [AlQalamController::class, 'viewDataPaguyuban']);
// 	Route::get('berandaanak', [AlQalamController::class, 'viewBerandaanak']);
// 	Route::get('perpustakaan', [AlQalamController::class, 'viewPerpustakaan']);
// 	Route::get('perizinansiswa', [AlQalamController::class, 'viewPerizinan']);
// 	Route::get('hariansiswa', [AlQalamController::class, 'viewPenilaianHarian']);
// 	Route::get('keuangansiswa', [AlQalamController::class, 'viewKeuangansiswa']);
// 	Route::get('studentsaving', [AlQalamController::class, 'viewTabungan']);
// 	Route::get('ekstrakulikuler', [AlQalamController::class, 'viewDaftarekskul']);
// 	Route::get('ruangbaca', [AlQalamController::class, 'viewPerpustakaan']);
	
// 	Route::get('signout', [AlQalamController::class, 'exLogout'])->name('signout');
// 	Route::post('json/viewdatainduk', [AlQalamController::class, 'jsonViewDatainduk'])->name('jsonViewDatainduk');
// 	Route::post('json/getstatdatakd', [AlQalamController::class, 'jsonStatistikDatakd'])->name('jsonStatistikDatakd');
// 	Route::post('json/getstatdatapermuatan', [AlQalamController::class, 'jsonStatDatapermuatan'])->name('jsonStatDatapermuatan');
// 	Route::post('json/getstatdatakehadiran', [AlQalamController::class, 'jsonStatDatakehadiran'])->name('jsonStatDatakehadiran');

// });
///////////////// WEBINAR ////////////////////////
// Route::get('webinar', [WebinarController::class, 'viewWebinar']);
// Route::get('loginwebinar', [WebinarController::class, 'loginwebinar'])->name('loginwebinar');
// Route::get('logoutwebinar', [WebinarController::class, 'logoutwebinar'])->name('logoutwebinar');
// Route::post('authenticatewebinar', [WebinarController::class, 'authenticatewebinar'])->name('loginwebinar');
// Route::get('register/{id}', [WebinarController::class, 'goRegister']);
// Route::get('info/{id}', [WebinarController::class, 'goLinkinfo']);
// Route::get('presentform/{id}', [WebinarController::class, 'goAbsen']);
// Route::get('hadir/{id}', [WebinarController::class, 'goAbsenall']);
// Route::get('evaluasi/{id}', [WebinarController::class, 'goQuisionerall']);
// Route::get('evform/{id}', [WebinarController::class, 'goQuisioner']);
// Route::get('certificate/{id}', [WebinarController::class, 'goSertifikat']);
// Route::get('cetaklinkpresensi/{id}', [WebinarController::class, 'goAbsenCetak']);
// Route::get('cetakpresensi/{id}', [WebinarController::class, 'ctkPresensiWebinar']);
// Route::get('contohkuis/{id}', [WebinarController::class, 'gocontohQuisioner']);
// Route::post('webinar/expresensi', [WebinarController::class, 'exPresensi'])->name('exPresensiwebinar');
Route::post('webinar/exkuisioner', [WebinarController::class, 'exKuisioner'])->name('exKuisionerwebinar');
Route::post('getkalenderlistwebinar', [WebinarController::class, 'getKalenderlistwebinar'])->name('getKalenderlistwebinar');
Route::post('webinar/getpegawairapat', [WebinarController::class, 'getPegawaiWebinar'])->name('getPegawaiWebinar');
Route::get('eomode/{id}', [WebinarController::class, 'viewEOMode']);

Route::group(['middleware' => 'project.webinar'], function() {
	// Route::get('dashboardwebinar', [WebinarController::class, 'index']);
	// Route::get('dashboarduser', [WebinarController::class, 'profile']);
	// Route::get('webinarrekaponline/{id}', [WebinarController::class, 'goRekap']);
	// Route::post('webinar/exregisterevent', [WebinarController::class, 'exRegisterevent'])->name('exRegisterevent');
	Route::post('webinar/saveevent', [WebinarController::class, 'exSaveevent'])->name('exSaveevent');
	Route::post('webinar/eventlist', [WebinarController::class, 'geteventList'])->name('geteventList');
	// Route::post('webinar/useradminlist', [WebinarController::class, 'getuserAdminlist'])->name('getuserAdminlist');
	Route::post('webinar/listpartisipan', [WebinarController::class, 'getListpartisipan'])->name('getList5partisipan');
	// Route::post('webinar/exmailer', [WebinarController::class, 'exMailer'])->name('exMailer');
	// Route::post('webinar/listpartisipanonline', [WebinarController::class, 'getListpartisipanok'])->name('getListpartisipanok');
	// Route::post('webinar/listhasilevent', [WebinarController::class, 'getListhasilevent'])->name('getListhasilevent');
	// Route::post('webinar/exaddakun', [WebinarController::class, 'exAddAkun'])->name('exAddAkun');
	// Route::post('webinar/saveeditemail', [WebinarController::class, 'saveEditemail'])->name('saveEditemail');    
});
///////////////// IPG ////////////////////////
// Route::get('pasangkayu', [FrontpageController::class, 'pasangkayuindex']);
Route::get('dashboardppp', [FrontpageController::class, 'lamonganindex']);
Route::post('exdaftarbaru', [AuthController::class, 'exDaftarBaru'])->name('exDaftarBaru');
Route::post('exresetpassword', [AuthController::class, 'exResetPassword'])->name('exResetPassword');
Route::get('verifikasiemail',[AuthController::class, 'verifikasi'])->name('verifikasiemail');
Route::post('exlogin', [AuthController::class, 'exLogin'])->name('exLogin');
// Route::post('login-rita', [AuthController::class, 'exLogin'])->name('exLogin');
Route::get('logoutlt3', [AuthController::class, 'exLogout'])->name('logoutlt3');
	
// Route::get('jsonmapdesa', [ProjectRITA::class, 'jsonMAPDesa'])->name('jsonMAPDesa');

Route::group(['middleware' => 'project.ipg'], function() {
	Route::post('exeditprofil', [AuthController::class, 'exEditProfil'])->name('exEditProfil');
    // Route::get('frontpageipm',[ProjectRITA::class, 'viewFrontpage'])->name('viewFrontpage');
    // Route::get('ahh',[ProjectRITA::class, 'viewAHH'])->name('viewAHH');
    // Route::get('hls',[ProjectRITA::class, 'viewHLS'])->name('viewHLS');
    // Route::get('rls',[ProjectRITA::class, 'viewRLS'])->name('viewRLS');
    // Route::get('ppp',[ProjectRITA::class, 'viewPPP'])->name('viewPPP');
    // Route::get('ipm',[ProjectRITA::class, 'viewIPM'])->name('viewIPM');
    // Route::get('ipg',[ProjectRITA::class, 'viewIPG'])->name('viewIPG');
    
    // Route::get('jsondatadesa', [ProjectRITA::class, 'jsonDataDesa'])->name('jsonDataDesa');
    // Route::get('jsondatadesaall', [ProjectRITA::class, 'jsonDataDesaAll'])->name('jsonDataDesaAll');
    // Route::post('jsondatadesahitung', [ProjectRITA::class, 'jsonDataDesaHitung'])->name('jsonDataDesaHitung');
    // Route::get('jsonrekapsebaranpendidikan', [ProjectRITA::class, 'jsonRekapSebaranPendidikan'])->name('jsonRekapSebaranPendidikan');
    // Route::get('jsonrekapsebaranpekerjaan', [ProjectRITA::class, 'jsonRekapSebaranPekerjaan'])->name('jsonRekapSebaranPekerjaan');
    
    // Route::post('exadddesa', [ProjectRITA::class, 'exAddDesa'])->name('exAddDesa');
	
});
///////////////// SIKEP ////////////////////////
// Route::get('/loginsikep', [Auth_Controller::class, 'index'])->name('loginsikep');
// Route::post('/login_app', [Auth_Controller::class, 'signin']);
// Route::get('/logoutsikep', [Auth_Controller::class, 'logout_web'])->name('logoutsikep');
// Route::get('/forgotpass', [Auth_Controller::class, 'forgotpass'])->name('forgotpass');
// Route::get('/ubah_pass', [Auth_Controller::class, 'ubah_pass'])->name('ubah_pass');
// Route::get('sikep', [Page::class, 'landing'])->name('landing'); 
// Route::get('/registersikep', [Page::class, 'register'])->name('register');
// Route::get('/file/{folder}/{file}', [Tr_Berita::class, 'show_file'])->name('berita.show_file');
// Route::get('/berita/view/{id}', [Page::class, 'berita_view'])->name('berita.view');
// Route::get('/accessdenied', [Page::class, 'error'])->name('accessdenied');
// Route::group(['middleware' => 'check.user'], function() {
// 	Route::get('/dashboard', [Page::class, 'dashboard'])->name('dashboard');
//     Route::get('/arsip', [Page::class, 'arsip'])->name('arsip');
//     Route::get('/arsip_hewan/{id}', [Page::class, 'arsip_view_hewan'])->name('arsip.hewan');
//     Route::get('/arsip_manusia/{id}', [Page::class, 'arsip_view_manusia'])->name('arsip.manusia');
//     Route::get('/permohonan/hewan', [Page::class, 'permohonan_hewan'])->name('permohonan.hewan');
//     Route::get('/permohonan/hewan/{id}', [Page::class, 'permohonan_hewan_edit'])->name('permohonan.hewan.edit');
//     Route::get('/permohonan/hewan/view/{id}', [Page::class, 'view_permohonan_hewan'])->name('permohonan.hewan.view');
//     Route::get('/permohonan/hewan/review/{id}', [Page::class, 'review_permohonan_hewan'])->name('permohonan.hewan.review');
//     Route::get('/permohonan/manusia', [Page::class, 'permohonan_manusia'])->name('permohonan.manusia');
//     Route::get('/permohonan/manusia/{id}', [Page::class, 'permohonan_manusia_edit'])->name('permohonan.manusia.edit');
//     Route::get('/permohonan/manusia/view/{id}', [Page::class, 'view_permohonan_manusia'])->name('permohonan.manusia.view');
//     Route::get('/permohonan/manusia/review/{id}', [Page::class, 'review_permohonan_manusia'])->name('permohonan.manusia.review');
//     Route::get('/users', [Page::class, 'users'])->name('users');
//     Route::get('/print_undangan', [Page::class, 'print_undangan'])->name('print_undangan');
//     Route::get('/formuser', [Page::class, 'formuser'])->name('formuser');
//     Route::get('/formuser/{id}', [Page::class, 'edituser'])->name('edituser');
//     Route::get('/sikepprofile', [Page::class, 'profile'])->name('profile');
//     Route::get('/berita', [Page::class, 'berita'])->name('berita');
//     Route::get('/berita/form', [Page::class, 'berita_add'])->name('berita.add');
//     Route::get('/berita/form/{id}', [Page::class, 'berita_edit'])->name('berita.edit');
//     Route::get('/config_app', [Page::class, 'config'])->name('config');
// });
///////////////// LEAP ////////////////////////

// Route::get('leap', [LeapNetworkController::class, 'index']);
// Route::get('leap-uae', [LeapNetworkController::class, 'indexUAE']);
// Route::post('leapdetaildata', [LeapNetworkController::class, 'postLeapdetaildata'])->name('postLeapdetaildata');
// Route::post('leapdetaildatarekap', [LeapNetworkController::class, 'postLeapRekap'])->name('postLeapRekap');
// Route::post('inputleapdata', [LeapNetworkController::class, 'postInputleapData'])->name('postInputleapData');
// Route::post('statistikleap', [LeapNetworkController::class, 'postStatistikleap'])->name('postStatistikleap');
// Route::get('/leaplog/{id}', [LeapNetworkController::class, 'getLogLeapData'])->name('getLogLeapData');
// Route::get('/leapuaelog/{id}', [LeapNetworkController::class, 'getLogLeapUAEData'])->name('getLogLeapUAEData');

///////////////// AIPKI ////////////////////////
Route::get('/test-asset', function () {
    dd([
        'app_url' => config('app.url'),
        'url' => url('/'),
        'asset' => asset('adminlte3/dist/css/adminlte.min.css'),
    ]);
});
Route::get('/server-test', function () {
    dd([
        'REQUEST_URI'      => request()->server('REQUEST_URI'),
        'SCRIPT_NAME'      => request()->server('SCRIPT_NAME'),
        'PHP_SELF'         => request()->server('PHP_SELF'),
        'DOCUMENT_ROOT'    => request()->server('DOCUMENT_ROOT'),
        'REQUEST_SCHEME'   => request()->server('REQUEST_SCHEME'),
        'HTTP_HOST'        => request()->server('HTTP_HOST'),
        'root'             => request()->root(),
        'fullUrl'          => request()->fullUrl(),
    ]);
});

Route::get('/aipkiportal', [AIPKIController::class, 'viewIndex']);
Route::get('/rsphportal', [AIPKIController::class, 'viewIndexRSPH'])->name('ptdpm');
// PERSURATAN NEW ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/e-office/rsphportal', [AIPKIController::class, 'viewIndexRSPH'])->name('ptdpm');
Route::get('/ptdpm', [AIPKIController::class, 'viewIndexRSPH'])->name('ptdpm');
Route::get('/rsphm', [AIPKIController::class, 'viewIndexRSPH'])->name('rsphm');
Route::get('/rsphs', [AIPKIController::class, 'viewIndexRSPH'])->name('rsphs');
Route::get('/rsdh', [AIPKIController::class, 'viewIndexRSPH'])->name('rsdh');
Route::get('/rsck', [AIPKIController::class, 'viewIndexRSPH'])->name('rsck');
// PERSURATAN NEW ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => 'project.aipki'], function() {
	Route::get('dashboardagendaris', [AIPKIController::class, 'dashboardagendaris'])->name('dashboardagendaris');
	Route::get('dashboardpimpinan', [AIPKIController::class, 'dashboardpimpinan'])->name('dashboardpimpinan');
	Route::get('dashboardstaf', [AIPKIController::class, 'dashboardstaf'])->name('dashboardstaf');
	Route::get('dashboardsdm', [AIPKIController::class, 'dashboardsdm'])->name('dashboardsdm');
	Route::get('settingpejabat', [AIPKIController::class, 'settingpejabat'])->name('settingpejabat');
	Route::get('persuratanpt', [AIPKIController::class, 'viewPersuratanPT'])->name('viewPersuratanPT');
	Route::get('persuratanrs', [AIPKIController::class, 'viewPersuratanRS'])->name('viewPersuratanRS');
	Route::get('ttdberkas/{id}', [AIPKIController::class, 'pleaseSignberkas'])->name('pleaseSignberkas');
});

///////////////// HATIRA ////////////////////////
// Route::get('/goodlist', [HatiraController::class, 'viewIndex']);
// Route::group(['middleware' => 'project.hatira'], function() {

// });
///////////////// BANKSOAL ////////////////////////
// Route::get('welcometobanksoal', [BankSoalController::class, 'index']);

// Route::get('pdsrpprpi', [PDSRPPRPIController::class, 'viewPortalpdsrpprpi'])->name('pdsrpprpi');
// Route::get('pdsrpprpipendidikan', [PDSRPPRPIController::class, 'viewPortalpdsrpprpipendidikan'])->name('pdsrpprpipendidikan');
// Route::get('pdsrpprpisertifikasi', [PDSRPPRPIController::class, 'viewPortalpdsrpprpisertifikasi'])->name('pdsrpprpisertifikasi');
// Route::get('pdsrpprpiseminar', [PDSRPPRPIController::class, 'viewPortalpdsrpprpiseminar'])->name('pdsrpprpiseminar');
// Route::get('pdsrpprpikasus', [PDSRPPRPIController::class, 'viewPortalpdsrpprpikasus'])->name('pdsrpprpikasus');
// Route::get('pdsrpprpilogin', [PDSRPPRPIController::class, 'viewPortalpdsrpprpilogin'])->name('pdsrpprpilogin');
// Route::get('pdsrpprpiregister', [PDSRPPRPIController::class, 'viewPortalpdsrpprpiregister'])->name('pdsrpprpiregister');

Route::group(['middleware' => 'project.banksoal'], function() {
	// Route::get('argonkonten', [PDSRPPRPIController::class, 'viewKontenSetting'])->name('argonkonten');
	// Route::post('argoneditor', [PDSRPPRPIController::class, 'exArgonEditor'])->name('argoneditor');
	// Route::get('argonkontenlist', [PDSRPPRPIController::class, 'viewKontenSettingList'])->name('argonkontenlist');
	
	// Route::get('test', [BankSoalController::class, 'viewUjianKompetensi'])->name('viewUjianKompetensi');
	// Route::get('ujiankompetensi',[BankSoalController::class, 'viewUjianKompetensi'])->name('viewUjianKompetensi');
    // Route::get('tryout', [BankSoalController::class, 'viewTryOut'])->name('viewTryOut');
	// Route::post('exfirstsoal', [BankSoalController::class, 'getFirstSoal'])->name('getFirstSoal');
	// Route::post('exfirstdataujian', [BankSoalController::class, 'getFirstDataUjian'])->name('getFirstDataUjian');
	Route::post('exinputbanksoal', [BankSoalController::class, 'exInputBankSoal'])->name('exInputBankSoal');
	// Route::post('exceksoalkembar', [BankSoalController::class, 'exCeksoalkembar'])->name('exCeksoalkembar');
	// Route::post('exsimpanjawaban', [BankSoalController::class, 'exSimpanJawaban'])->name('exSimpanJawaban');
	Route::post('jsonaktiftest', [BankSoalController::class, 'dataJsonaktiftest'])->name('jsonaktiftest');
	// Route::get('getbanksoal', [BankSoalController::class, 'getBankSoal'])->name('getBankSoal');
	// Route::get('jsongetsoalaktif', [BankSoalController::class, 'jsonGetSoalAktif'])->name('jsonGetSoalAktif');
	// Route::post('exaddtest', [BankSoalController::class, 'exAddTest'])->name('exAddTest');
	// Route::post('exaddpesertatest', [BankSoalController::class, 'exAddPesertaTest'])->name('exAddPesertaTest');
	// Route::post('exhitungnilai', [BankSoalController::class, 'exHitungNilai'])->name('exHitungNilai');
	// Route::post('exaddtotxt', [BankSoalController::class, 'exAddtoTXT'])->name('exaddtotxt');
	// Route::post('jsonallcase', [BankSoalController::class, 'jsonallcase'])->name('jsonallcase');
	// Route::post('aktifet', [BankSoalController::class, 'aktifet'])->name('aktifet');
	// Route::post('jsonallinterviewer', [BankSoalController::class, 'jsonallInterviewer'])->name('jsonallinterviewer');
	// Route::post('jsonrekapsoal', [BankSoalController::class, 'jsonRekapSoal'])->name('jsonRekapSoal');
    // Route::post('getdetailsoal', [BankSoalController::class, 'getDetailSoal'])->name('getDetailSoal');
	// Route::post('exsetsoalprodi', [BankSoalController::class, 'exSetSoalProdi'])->name('exSetSoalProdi');
	// Route::get('startujianrekrutmen',[BankSoalController::class, 'exStartUjianRekrutmen'])->name('exStartUjianRekrutmen');
});

///////////////// REKRUITMEN ////////////////////////
Route::get('rekrutmen', [RecruitmentController::class, 'index']);

Route::group(['middleware' => 'project.rekrutmen'], function() {
	Route::get('banksoal',[BankSoalController::class, 'viewBankSoal'])->name('viewBankSoal');
    
	Route::get('masterformasi',[RecruitmentController::class, 'viewMasterProdi'])->name('viewMasterProdi');
    
	Route::get('/resetprodi',[RecruitmentController::class, 'exResetPerProdi'])->name('exResetPerProdi');
    Route::get('/pengumumanverifikasi',[RecruitmentController::class, 'viewPengumumanVerifikasi'])->name('viewPengumumanVerifikasi');
    Route::get('/pengumumanhasil',[RecruitmentController::class, 'viewPengumumanHasil'])->name('viewPengumumanHasil');
    Route::get('/teskompetensi',[RecruitmentController::class, 'viewPortalUjian'])->name('viewPortalUjian');
    Route::get('/hasilujian/{id}',[RecruitmentController::class, 'viewHasilUjianKompetensi'])->name('viewHasilUjianKompetensi');
    Route::get('/wawancara',[RecruitmentController::class, 'viewWawancara'])->name('viewWawancara');
    Route::get('/skpegawai',[RecruitmentController::class, 'viewSKPegawai'])->name('viewSKPegawai');
    Route::post('exdaftarkandiri', [RecruitmentController::class, 'exDaftarkanDiri'])->name('exDaftarkanDiri');

	Route::get('datapengumuman', [RecruitmentController::class, 'dataPengumuman'])->name('dataPengumuman');
    Route::post('exinputpengumuman', [RecruitmentController::class, 'exInputPengumuman'])->name('exInputPengumuman');
    Route::post('exfirstpengumuman', [RecruitmentController::class, 'getFirstPengumuman'])->name('getFirstPengumuman');
    Route::post('jsondatapeminat', [RecruitmentController::class, 'jsonDataPeminat'])->name('jsonDataPeminat');
    
	Route::post('exsettingprodi', [RecruitmentController::class, 'exInputSetting'])->name('exInputSetting');
    Route::post('jsonsetting', [RecruitmentController::class, 'jsonSetting'])->name('jsonSetting');
    Route::post('exfirstpeminat', [RecruitmentController::class, 'getFirstPeminat'])->name('getFirstPeminat');
	Route::post('exinputberkaspelamar', [RecruitmentController::class, 'exInputBerkasPelamar'])->name('exInputBerkasPelamar');

	Route::post('jsondatasyaratpelamar', [RecruitmentController::class, 'jsonDataSyaratPelamar'])->name('jsonDataSyaratPelamar');

});
///////////////// SCO ////////////////////////
include dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'web-sco.php';