<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\WebinarController;
// use App\Http\Controllers\Page;
use App\Http\Controllers\FrontpageController;
// use App\Http\Controllers\SendMail;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\ArsipdinamisController;
// use App\Http\Controllers\BankSoalController;
// use App\Http\Controllers\AlQalamController;
use App\Http\Controllers\RecruitmentController;
// use App\Http\Controllers\Sco\AdminAkademikController;
// use App\Http\Controllers\Sco\AdminJurusanController;
// use App\Http\Controllers\Sco\AdminKemahasiswaanController;
use App\Http\Controllers\Sco\AdminKeuanganController;
// use App\Http\Controllers\Sco\AllAboutJadwalController;
use App\Http\Controllers\Sco\BantuanController;
// use App\Http\Controllers\Sco\BazisController;
use App\Http\Controllers\Sco\DashbordsuratController;
// use App\Http\Controllers\Sco\DosenpengujiController;
// use App\Http\Controllers\Sco\EcekController;
// use App\Http\Controllers\Sco\HPTController;
use App\Http\Controllers\Sco\JadwalController;
use App\Http\Controllers\Sco\KegepawaianController;
// use App\Http\Controllers\Sco\KendaraanController;
// use App\Http\Controllers\Sco\LayananMahasiswaController;
// use App\Http\Controllers\Sco\MipaController;
use App\Http\Controllers\Sco\NotifikasiController;
// use App\Http\Controllers\Sco\PascasarjanaController;
// use App\Http\Controllers\Sco\PerpusController;
// use App\Http\Controllers\Sco\PertanianController;
// use App\Http\Controllers\Sco\PpsController;
// use App\Http\Controllers\Sco\ReportController;
// use App\Http\Controllers\Sco\RuanganController;
// use App\Http\Controllers\Sco\SafehouseController;
use App\Http\Controllers\Sco\SimbaController;
// use App\Http\Controllers\Sco\SIMBHPController;
// use App\Http\Controllers\Sco\SimpukjaController;
// use App\Http\Controllers\Sco\SIQuasController;
// use App\Http\Controllers\Sco\SppdController;
// use App\Http\Controllers\Sco\SwakelolaController;
// use App\Http\Controllers\Sco\VokasiController;

Route::get('safehousehome', function () {
    return view('safehouse');
});
Route::get('/perruang', function () {
    return view('perruang');
});
Route::get('/daftars3mipa', function () {
    return view('mipa.allcamabas3');
});
Route::get('/daftars2mipa', function () {
    return view('mipa.allcamabas2');
});
Route::get('/studilanjut', function () {
    return view('bantuan.inputbebas');
});
Route::post('getpegawaitubel', [BantuanController::class, 'getPegawaiTUBEL'])->name('getPegawaiTUBEL');

Route::get('newlook', [AuthController::class, 'viewNewlook']);
Route::post('authenticatenew', [AuthController::class, 'authenticateNEW'])->name('authenticatenew');
Route::get('/register',[AuthController::class, 'viewRegMHSALL'])->name('register');
Route::post('/exregister', [AuthController::class, 'exRegisterMHS'])->name('exregister');
Route::post('/proses_forget', [AuthController::class, 'proses_forget']);
    
Route::get('editpeminjaman/{id}', [JadwalController::class, 'viewPerubahanPermohonan']);
Route::get('batalpermohonan/{id}', [JadwalController::class, 'viewPembatalanPermohonan']);
Route::get('akhirkegiatan/{id}', [JadwalController::class, 'viewAkhiriKegiatan']);
Route::post('cek/trackingcode', [AuthController::class, 'cekTrackingcode'])->name('cekTrackingcode');
Route::post('cek/trackingnimcode', [AuthController::class, 'cekTrackingNIM'])->name('trackingnimcode');
Route::post('verifikasicek', [AuthController::class, 'exVerifikasicek'])->name('exVerifikasicek');
    
Route::get('/laravelview/{all?}', array('as' => 'pdfViewer', 'uses' => [DashbordsuratController::class, 'pdfViewer']));
// Route::post('authenticatevokasi', [VokasiController::class, 'authenticate'])->name('authenticatevokasi');
Route::post('autandroid', [AuthController::class, 'authenticate'])->name('andoidlogin');
// Route::post('perruang/getreportperruang', [ReportController::class, 'getJadwal'])->name('getJadwal');
Route::get('viewdocbyname/{id}', [DashbordsuratController::class, 'viewbyName']);
Route::get('downloaddocbyname/{id}', [DashbordsuratController::class, 'savebyName']);
Route::get('downloadqr/{id}', [DashbordsuratController::class, 'getQRCodefile']);
Route::get('pdftohtml/{id}', [DashbordsuratController::class, 'pdfTohtml']);
Route::get('sertifikat/{id}', [DashbordsuratController::class, 'viewSertifikat']);
Route::get('view-document/{id}', [DashbordsuratController::class, 'view']);
Route::post('getkalenderlist', [JadwalController::class, 'getKalenderlist'])->name('getkalenderlist');
Route::post('expinjamtamu', [JadwalController::class, 'expinjamTamu'])->name('expinjamtamu');
Route::post('expinjamadmin', [JadwalController::class, 'expinjamAdmin'])->name('expinjamadmin');
Route::post('jadwal/getketersediaan', [JadwalController::class, 'getKetersediaan'])->name('getKetersediaan');
Route::get('hpt', [AuthController::class, 'viewKeuHPT']);
Route::post('sampaikantracestudy', [AuthController::class, 'exTracestudy'])->name('sampaikantracestudy');
Route::post('getevaluasiobject', [AuthController::class, 'getEvaluasiobject'])->name('getEvaluasiobject');
Route::post('exevaluasiobject', [AuthController::class, 'exeValuasiobject'])->name('exeValuasiobject');

// Route::get('skpi/{id}', [VokasiController::class, 'viewSertifikat']);
// Route::get('pleasesign/{id}', [VokasiController::class, 'pleaseSign']);
// Route::post('sign/expersetujuan', [VokasiController::class, 'exPersetujuan'])->name('expersetujuan');
// Route::get('penilaianujian/{id}', [AdminJurusanController::class, 'penilaianUjian']);
// Route::get('audiensiujian/{id}', [AdminJurusanController::class, 'audiensiUjian']);
// Route::get('viewberkasdospenguji/{id}', [PascasarjanaController::class, 'viewBerkasUjian']);
// Route::post('ujian/savepenilaian', [PascasarjanaController::class, 'saveEditsempro'])->name('savepenilaian');
// Route::post('ujian/savepenilaiandetail', [PascasarjanaController::class, 'savePenilaiandetail'])->name('savepenilaiandetail');
// Route::post('laporansempro/saveeditsempro', [PascasarjanaController::class, 'saveEditsempro'])->name('saveeditsempro');
// Route::post('berkas/getberkasupload', [LayananMahasiswaController::class, 'getBerkasupload'])->name('getberkasupload');
// Route::post('berkas/getberkasdgnnomor', [LayananMahasiswaController::class, 'getBerkasDgnnomor'])->name('getBerkasDgnnomor');
// Route::post('berkas/getberkastnpnomor', [LayananMahasiswaController::class, 'getBerkasTnpnomor'])->name('getBerkasTnpnomor');
// Route::post('berkas/getberkasnilai', [LayananMahasiswaController::class, 'getBerkasPenilaian'])->name('getBerkasPenilaian');
// Route::post('berkas/getberkasnilaipromotor', [LayananMahasiswaController::class, 'getBerkasPenilaianpromotor'])->name('getBerkasPenilaianpromotor');
// Route::post('berkas/getberkasnilaipublikasi', [LayananMahasiswaController::class, 'getBerkasPenilaianpublikasi'])->name('getBerkasPenilaianpublikasi');
// Route::post('berkas/getberkasnilaiseminter', [LayananMahasiswaController::class, 'getBerkasPenilaiansemInter'])->name('getBerkasPenilaiansemInter');

// Route::get('formplagiasi', [PpsController::class, 'viewFormplagiasi']);
// Route::get('daftars2', [PpsController::class, 'viewDaftarS2']);
// Route::get('daftars3', [PpsController::class, 'viewDaftarS3']);
// Route::post('actsaveplagiasi', [PpsController::class, 'actSaveplagiasi'])->name('actSaveplagiasi');
// Route::get('plagiarism/{id}', [PpsController::class, 'ctkFormplagiasi']);
// Route::get('regcamabas2/{id}', [PpsController::class, 'viewRegCamabaS2']);
// Route::get('regcamabas3/{id}', [PpsController::class, 'viewRegCamabaS3']);
// Route::get('fomrcamaba/{id}', [PpsController::class, 'viewBiodataCamaba']);
// Route::post('findstatplagiasi', [PpsController::class, 'findStatplagiasi'])->name('findstatplagiasi');
// Route::post('authenticatepps', [PpsController::class, 'authenticate'])->name('authenticatepps');
// Route::post('actverplagiasi', [PpsController::class, 'actVerplagiasi'])->name('actVerplagiasi');
// Route::post('camaba/uploadberkascamaba', [PpsController::class, 'uploadBerkascamaba'])->name('uploadberkascamaba');
// Route::post('camaba/jsonberkascamaba', [PpsController::class, 'jsonBerkascamaba'])->name('berkascamaba');
// Route::post('camaba/jsontemplatecamaba', [PpsController::class, 'jsonTemplatecamaba'])->name('templatecamaba');
// Route::post('camaba/exsavecamaba', [PpsController::class, 'exSavecamaba'])->name('exsavecamaba');

// Route::post('authenticatemipa', [MipaController::class, 'authenticate'])->name('authenticatemipa');
// Route::get('daftars2biologi', [MipaController::class, 'viewDaftarS2biologi']);
// Route::get('daftars2matematika', [MipaController::class, 'viewDaftarS2matematika']);
// Route::get('daftars2fisika', [MipaController::class, 'viewDaftarS2fisika']);
// Route::get('daftars2kimia', [MipaController::class, 'viewDaftarS2kimia']);
// Route::get('daftars2statistika', [MipaController::class, 'viewDaftarS2statistika']);
// Route::get('daftars3biologi', [MipaController::class, 'viewDaftarS3biologi']);
// Route::get('daftars3matematika', [MipaController::class, 'viewDaftarS3matematika']);
// Route::get('daftars3fisika', [MipaController::class, 'viewDaftarS3fisika']);
// Route::get('daftars3kimia', [MipaController::class, 'viewDaftarS3kimia']);
// Route::get('daftars3statistika', [MipaController::class, 'viewDaftarS3statistika']);

// Route::get('regcamabas2mipa/{id}', [MipaController::class, 'viewRegCamabaS2']);
// Route::get('regcamabas3mipa/{id}', [MipaController::class, 'viewRegCamabaS3']);

// Route::post('authenticatefp', [PertanianController::class, 'authenticate'])->name('authenticatefp');

Route::post('authenticatemhs', [AuthController::class, 'authenticatemhs'])->name('loginmhs');
Route::post('/exregisterall', [AuthController::class, 'exRegisterMHSALL'])->name('exregistermhsall');

// Route::get('jadwalsivoka', [AllAboutJadwalController::class, 'jadwalkuliahvokasi']);
// Route::post('jadwal/exupdatepresensi', [AllAboutJadwalController::class, 'exupdatePresensi'])->name('exupdatepresensi');
// Route::post('jadwal/jsonviewjadwaldosen', [AllAboutJadwalController::class, 'jsonviewjadwalDosen'])->name('jsonviewjadwaldosen');
// Route::post('jadwal/jsonviewpesertakelas', [AllAboutJadwalController::class, 'jsonviewPesertakelas'])->name('jsonviewPesertakelas');
// Route::get('pesertakelas/{id}', [AllAboutJadwalController::class, 'jsonCetakpesertakelas']);
// Route::get('templatepesertakelas/{id}', [AllAboutJadwalController::class, 'jsonCetakTemplatepesertakelas']);
// Route::get('jadwalkuliahmhs/{fakultas}', [AllAboutJadwalController::class, 'jadwalkuliahmhs']);
// Route::post('jadwal/jsonviewpersesi', [AllAboutJadwalController::class, 'jsonviewperSesi'])->name('jsonviewpersesi');
// Route::post('jadwal/cektanggal', [AllAboutJadwalController::class, 'cekTanggal'])->name('cektanggal');
// Route::post('jadwal/jsonviewjadwalmk', [AllAboutJadwalController::class, 'jsonviewjadwalMk'])->name('jsonviewjadwalmk');
// Route::post('jadwal/jsonviewjadwalangkatan', [AllAboutJadwalController::class, 'jsonviewjadwalAngkatan'])->name('jsonviewjadwalangkatan');
// Route::post('jadwal/cetakpengampu', [AllAboutJadwalController::class, 'cetakPengampu'])->name('cetakpengampu');

Route::get('viewsurat/{id}', [NotifikasiController::class, 'viewsuratuser']);
Route::get('suratkmh/{id}', [NotifikasiController::class, 'viewSuratkmh']);
Route::get('2ea2aa47b5cbf1f95b9dd18c1bf8dd4c/{id}', [NotifikasiController::class, 'verifikatorSifia']);
Route::get('e8759f5f7f445841bb9b25c5df54b180/{id}', [NotifikasiController::class, 'cekingSifia']);
Route::get('transkripsementara/{id}', [NotifikasiController::class, 'viewTranskripmhs']);
Route::get('viewkgb/{id}', [NotifikasiController::class, 'viewKgb']);
Route::get('prosestte', [NotifikasiController::class, 'exProsesTTE']);
Route::post('bantuan/exaddnewpenerima', [BantuanController::class, 'exaddnewPenerima'])->name('exaddnewpenerima');
Route::get('ttdkp/{id}', [KegepawaianController::class, 'pleaseSignberkasKepegawain']);
Route::get('ttdsptjm/{id}', [BantuanController::class, 'pleaseSignberkasSPTJM']);
Route::get('sptjm/{id}', [BantuanController::class, 'viewSptjm']);

Route::group(['middleware' => 'project.sco'], function() {
	Route::get('developing', [FrontpageController::class, 'viewTugas']);
	Route::get('frontpage2', [FrontpageController::class, 'SCOFrontpage']);
	Route::get('mailbox', [FrontpageController::class, 'mailbox']);
	Route::get('manualbook', [FrontpageController::class, 'manualbook']);
	Route::get('bukutamuadmin', [FrontpageController::class, 'bukutamuadmin']);
	Route::get('templatesurat', [FrontpageController::class, 'viewTemplatesurat']);
	Route::get('todolist', [FrontpageController::class, 'viewTodolist']);
	Route::get('dev/rekaptask', [FrontpageController::class, 'getRekaptask'])->name('getRekaptask');
	Route::post('dev/tasklist', [FrontpageController::class, 'getTasklist'])->name('getTasklist');
	Route::post('dev/taskadd', [FrontpageController::class, 'exTaskadd'])->name('exTaskadd');
	// Persuratan
    Route::get('openinbox',[AuthController::class, 'openInboxFromEmail'])->name('openinbox');

	Route::get('dashboardarsiparis', [ArsipdinamisController::class, 'dashboardarsiparis']);
	Route::get('dashboardarsip', [ArsipdinamisController::class, 'dashboardarsip']);
	Route::get('arsipkeluar', [ArsipdinamisController::class, 'arsipoutsurat']);
	Route::get('arsipmasuk', [ArsipdinamisController::class, 'arsipinsurat']);
	Route::get('arsipsubaktif', [ArsipdinamisController::class, 'arsipsubaktif']);
	Route::get('arsipsubinakti', [ArsipdinamisController::class, 'arsipsubinakti']);
	Route::get('arsipfasaktif', [ArsipdinamisController::class, 'arsipfasaktif']);
	Route::get('arsipfasinakti', [ArsipdinamisController::class, 'arsipfasinakti']);
	Route::get('arsipnilai', [ArsipdinamisController::class, 'arsipnilai']);
	Route::get('arsipperorang', [ArsipdinamisController::class, 'arsipperorang']);
	Route::get('arsippermanen', [ArsipdinamisController::class, 'arsippermanen']);
	Route::get('arsipmusnah', [ArsipdinamisController::class, 'arsipmusnah']);
	Route::get('listsurattugas', [ArsipdinamisController::class, 'viewListsurattugas']);
	Route::post('surat/jsonarsipsuratmasuk', [ArsipdinamisController::class, 'jsonArsipsuratmasuk'])->name('jsonarsipsuratmasuk');
	Route::post('surat/jarsiparis', [ArsipdinamisController::class, 'jsonArsip'])->name('jarsiparis');
	Route::get('surat/jarsiparispaged', [ArsipdinamisController::class, 'jarsiparisPaged'])->name('jarsiparisPaged');
	Route::post('surat/datasuratskcari', [ArsipdinamisController::class, 'datasuratSkcari'])->name('datasuratskcari');
	Route::post('surat/jsonarsipsrtkeluar', [ArsipdinamisController::class, 'jsonarsipsrtKeluar'])->name('jsonarsipsrtkeluar');
	Route::post('surat/jsonarsipsrttugas', [ArsipdinamisController::class, 'jsonarsipsrtTugas'])->name('jsonarsipsrttugas');
	Route::post('surat/arsipkansrtkeluar', [ArsipdinamisController::class, 'arsipkansrtKeluar'])->name('arsipkansrtkeluar');
	Route::post('surat/arsipfokerja', [ArsipdinamisController::class, 'arsipfoKerja'])->name('arsipfokerja');
	Route::post('surat/arsipfo', [ArsipdinamisController::class, 'arsipFo'])->name('arsipfo');
	Route::post('surat/exarsiparis', [ArsipdinamisController::class, 'exArsiparis'])->name('exarsiparis');
	Route::post('surat/undoarsip', [ArsipdinamisController::class, 'undoArsip'])->name('undoarsip');
	Route::get('surat/jsonviewarsipuk1', [ArsipdinamisController::class, 'jsonviewarsipuk1']);
	Route::get('surat/jsonviewrekaparsip', [ArsipdinamisController::class, 'jsonviewrekaparsip']);
	Route::post('surat/jsonviewarsipbyklasifikasi', [ArsipdinamisController::class, 'jsonviewarsipbyKlasifikasi'])->name('jsonviewarsipbyklasifikasi');
	Route::post('surat/detailtraktingarsip', [ArsipdinamisController::class, 'detailtraktingArsip'])->name('detailtraktingarsip');
	Route::post('surat/jsonviewarsipbyketerangan', [ArsipdinamisController::class, 'jsonviewarsipbyKeterangan'])->name('jsonviewarsipbyketerangan');
	Route::post('surat/exsetstatusarsip', [ArsipdinamisController::class, 'exsetstatusArsip'])->name('exsetstatusarsip');
	Route::post('surat/extbhpenerimaarsip', [ArsipdinamisController::class, 'extbhpenerimaArsip'])->name('extbhpenerimaarsip');
	Route::post('surat/detailpenerimaarsip', [ArsipdinamisController::class, 'detailpenerimaArsip'])->name('detailpenerimaarsip');
	Route::post('surat/exberitapemindahanarsip', [ArsipdinamisController::class, 'exberitaPemindahanarsip'])->name('exberitapemindahanarsip');
	Route::post('surat/jsonarsipberitaacara', [ArsipdinamisController::class, 'jsonarsipberitAacara'])->name('jsonarsipberitaacara');
	Route::post('surat/exsesuaiberitaacara', [ArsipdinamisController::class, 'exsesuaiBeritaacara'])->name('exsesuaiberitaacara');
	Route::post('surat/exberitamusnaharsip', [ArsipdinamisController::class, 'exberitaMusnaharsip'])->name('exberitamusnaharsip');
	Route::get('buatqr', [ArsipdinamisController::class, 'viewBuatqr']);
	Route::post('surat/excreateqrcode', [ArsipdinamisController::class, 'exCreateqrcode'])->name('exCreateQR');
	Route::get('dashbordktusekun', [ArsipdinamisController::class, 'viewDashboardKTUSEKUN']);
	Route::get('dashbordsekrektor', [ArsipdinamisController::class, 'viewDashboardSekRektor']);
	Route::post('surat/addarsipmanual', [ArsipdinamisController::class, 'exAddArsipManual'])->name('exAddArsipManual');
	
	Route::get('dashbordsurat', [DashbordsuratController::class, 'index']);
	Route::get('dashboardsekbiro', [DashbordsuratController::class, 'dashboardsekbiro']);
	Route::get('statistik', [DashbordsuratController::class, 'statistik']);
	Route::get('controlsekpim', [DashbordsuratController::class, 'controlSekpim']);
	Route::get('controltu', [DashbordsuratController::class, 'controlTu']);
	Route::get('insurat', [DashbordsuratController::class, 'bsuratmasuk']);
	Route::get('outsurat', [DashbordsuratController::class, 'bsuratkeluar']);
	Route::get('outperaturan', [DashbordsuratController::class, 'boutperaturan']);
	Route::get('skdanperaturan', [DashbordsuratController::class, 'viewSKdanPeraturan']);
	Route::get('tandatangan', [DashbordsuratController::class, 'tandatangan']);
	Route::get('disposisi', [DashbordsuratController::class, 'hdisposisi']);
	Route::get('notadinas', [DashbordsuratController::class, 'viewNotadinas']);
	Route::get('datainduksuratthnini', [DashbordsuratController::class, 'datainduksuratthnini']);
	Route::get('ekspedisi', [DashbordsuratController::class, 'viewEkspedisi']);
	Route::get('controlekspedisi', [DashbordsuratController::class, 'viewControlEkspedisi']);
	Route::get('permohonantte', [DashbordsuratController::class, 'viewPermohonantte']);
	Route::get('serfitikatwithtte', [DashbordsuratController::class, 'viewSerfitikatwithtte']);
	Route::get('serfitikat/{id}', [DashbordsuratController::class, 'viewSerfitikatsetting']);
	Route::get('suratkeluar', [DashbordsuratController::class, 'viewSuratKeluar']);
	Route::post('surat/addmemo', [DashbordsuratController::class, 'exAddmemo'])->name('exAddmemo');
	
	Route::post('surat/updsuratmasuk', [DashbordsuratController::class, 'updsuratmasuk'])->name('exUpdsuratMasuk');
	Route::post('surat/updsuratkeluar', [DashbordsuratController::class, 'updsuratkeluar']);
	Route::post('surat/updsuratsp', [DashbordsuratController::class, 'updsuratsp']);
	Route::post('surat/updsuratst', [DashbordsuratController::class, 'updsuratst']);
	Route::post('surat/experaturansk', [DashbordsuratController::class, 'experaturansk']);
	Route::post('surat/exmanualsrtklrmaju', [DashbordsuratController::class, 'exmanualsrtklrmaju']);
	Route::post('surat/exmanualsrtklrmundur', [DashbordsuratController::class, 'exmanualsrtklrmundur'])->name('exmanualsrtklrmundur');
	Route::post('surat/exmanualsrtklredit', [DashbordsuratController::class, 'exmanualsrtklredit']);
	Route::post('surat/sampaikansrtmsk', [DashbordsuratController::class, 'sampaikanSrtmsk'])->name('sampaikansrtmsk');
	Route::post('surat/exdisposisi', [DashbordsuratController::class, 'exDisposisi'])->name('exdisposisi');
	Route::post('surat/excreatedisposisi', [DashbordsuratController::class, 'exCreatedisposisi'])->name('exCreatedisposisi');
	Route::post('surat/excreatedisposisimulti', [DashbordsuratController::class, 'exCreatedisposisiMulti'])->name('exCreatedisposisiMulti');
	Route::post('surat/exdisposisimulti', [DashbordsuratController::class, 'exdisposisiMulti'])->name('exdisposisimulti');
	Route::post('surat/exdisposisireminder', [DashbordsuratController::class, 'exdisposisiReminder'])->name('exdisposisireminder');
	Route::post('surat/viewdisposisi', [DashbordsuratController::class, 'viewDisposisi'])->name('viewdisposisi');
	Route::get('surat/jskdanperaturan', [DashbordsuratController::class, 'jskDanperaturan'])->name('jskdanperaturan');
	Route::get('surat/inboxsuratmasuk', [DashbordsuratController::class, 'inboxSuratmasuk'])->name('inboxsuratmasuk');
	Route::post('surat/inboxsuratmasukpaginated', [DashbordsuratController::class, 'inboxSuratmasukPaged'])->name('inboxSuratmasukPaged');
	Route::post('surat/cariinboxsuratmasuk', [DashbordsuratController::class, 'cariInboxsuratmasuk'])->name('cariinboxsuratmasuk');
	Route::post('surat/pinginbox', [DashbordsuratController::class, 'pingInbox'])->name('pinginbox');
	Route::get('surat/inboxuser', [DashbordsuratController::class, 'inboxUser'])->name('inboxuser');
	Route::get('surat/inboxuserpaginated', [DashbordsuratController::class, 'inboxUserpaginated'])->name('inboxUserpaginated');
	Route::get('surat/mailboxrekap', [DashbordsuratController::class, 'mailboxRekap'])->name('mailboxrekap');
	Route::post('surat/mailbox', [DashbordsuratController::class, 'mailBox'])->name('mailbox');
	Route::get('surat/mailboxpaged', [DashbordsuratController::class, 'mailBoxPaged'])->name('mailBoxPaged');
	Route::post('surat/setfolder', [DashbordsuratController::class, 'setFolder'])->name('setfolder');
	Route::get('surat/inboxperiksa', [DashbordsuratController::class, 'inboxPeriksa'])->name('inboxperiksa');
	Route::get('surat/inboxpimpinan', [DashbordsuratController::class, 'inboxPimpinan'])->name('inboxpimpinan');
	Route::get('surat/inboxoutuser', [DashbordsuratController::class, 'inboxOutuser'])->name('inboxoutuser');
	Route::get('surat/inboxoutuserpaged', [DashbordsuratController::class, 'inboxOutuserPaged'])->name('inboxOutuserPaged');
	Route::get('surat/jnomorkeluar', [DashbordsuratController::class, 'jnomorKeluar'])->name('jnomorkeluar');
	Route::post('surat/jlatestnumber', [DashbordsuratController::class, 'jlatestNumber'])->name('jlatestnumber');
	Route::post('surat/ctkdisposisi', [DashbordsuratController::class, 'ctkDisposisi'])->name('ctkdisposisi');
	Route::post('surat/ctkkendaliarsip', [DashbordsuratController::class, 'ctkKendaliarsip'])->name('ctkkendaliarsip');
	Route::get('surat/listasalsurat', [DashbordsuratController::class, 'listAsalsurat'])->name('listasalsurat');
	Route::get('surat/listlampiran', [DashbordsuratController::class, 'listLampiran'])->name('listlampiran');
	Route::get('surat/lastnumsrtmasuk', [DashbordsuratController::class, 'lastNumsrtmasuk'])->name('lastnumsrtmasuk');
	Route::post('surat/jsontraking', [DashbordsuratController::class, 'jsonTraking'])->name('jsontraking');
	Route::post('surat/detailtrakting', [DashbordsuratController::class, 'detailTrakting'])->name('detailtrakting');
	Route::post('surat/getnoagenda', [DashbordsuratController::class, 'getNoagenda'])->name('getnoagenda');
	Route::post('surat/deletesrtmasuk', [DashbordsuratController::class, 'deleteSrtmasuk'])->name('deletesrtmasuk');
	Route::post('surat/deleteinbox', [DashbordsuratController::class, 'deleteInbox'])->name('deleteinbox');
	Route::post('surat/riwayat', [DashbordsuratController::class, 'listRiwayat'])->name('riwayat');
	Route::post('surat/undodisposisi', [DashbordsuratController::class, 'undoDisposisi'])->name('undodisposisi');
	Route::post('surat/lapsrtmasuktahunan', [DashbordsuratController::class, 'lapSrtmasuktahunan'])->name('lapsrtmasuktahunan');
	Route::get('surat/grafiksuratmasuk', [DashbordsuratController::class, 'grafiksuratMasuk'])->name('grafiksuratmasuk');
	Route::get('surat/grafiksuratkeluar', [DashbordsuratController::class, 'grafiksuratKeluar'])->name('grafiksuratkeluar');
	Route::post('surat/jtabelstatistik', [DashbordsuratController::class, 'jtabelStatistik'])->name('jtabelstatistik');
	Route::post('surat/jgraphstatistik', [DashbordsuratController::class, 'jGraphstatistik'])->name('jGraphstatistik');
	Route::get('surat/datasuratkeluaruser', [DashbordsuratController::class, 'datasuratKeluaruser'])->name('datasuratkeluaruser');
	Route::get('surat/datasuratkeluaruserpaginated', [DashbordsuratController::class, 'datasuratKeluaruserpaged'])->name('datasuratKeluaruserpaged');
	Route::get('surat/datasuratkeputusanuser', [DashbordsuratController::class, 'dataSKuser'])->name('dataSKuser');
	Route::get('surat/datasuratkeputusanuserpaginated', [DashbordsuratController::class, 'dataSKuserpaginated'])->name('dataSKuserpaginated');
	Route::get('surat/datasuratkeluartnpnomor', [DashbordsuratController::class, 'datasuratkeluarTnpnomor'])->name('datasuratkeluartnpnomor');
	Route::post('surat/datapermohonannomor', [DashbordsuratController::class, 'datapermohonanNomor'])->name('datapermohonannomor');
	Route::get('surat/datamhnnomorpaginated', [DashbordsuratController::class, 'datapermohonanNomorPaged'])->name('datapermohonanNomorPaged');
	Route::post('surat/goantrinomor', [DashbordsuratController::class, 'goAntrinomor'])->name('goantrinomor');
	Route::post('surat/exrekuesnomor', [DashbordsuratController::class, 'exRekuesnomor'])->name('exrekuesnomor');
	Route::post('surat/exnomordepan', [DashbordsuratController::class, 'exNomordepan'])->name('exNomordepan');
	Route::post('surat/excekrekuesnomor', [DashbordsuratController::class, 'exCekrekuesnomor'])->name('exCekrekuesnomor');
	Route::post('surat/hapussrtkeluar', [DashbordsuratController::class, 'hapussrtKeluar'])->name('hapussrtkeluar');
	Route::post('surat/cekdasarsurat', [DashbordsuratController::class, 'cekDasarsurat'])->name('cekdasarsurat');
	Route::post('surat/exsimpannomorskmulti', [DashbordsuratController::class, 'exsimpanNomorskmulti'])->name('exsimpannomorskmulti');
	Route::post('surat/gennomorsrtklr', [DashbordsuratController::class, 'genNomorsrtklr'])->name('gennomorsrtklr');
	Route::post('surat/extbhpenerimasurat', [DashbordsuratController::class, 'extbhPenerimasurat'])->name('extbhpenerimasurat');
	Route::post('surat/extbhpenerimask', [DashbordsuratController::class, 'extbhPenerimask'])->name('extbhpenerimask');
	Route::post('surat/extkrmpenerimasurat', [DashbordsuratController::class, 'extKrmpenerimasurat'])->name('extkrmpenerimasurat');
	Route::post('surat/extkrmpenerimasuratremun', [DashbordsuratController::class, 'extKrmpenerimasuratRemun'])->name('extkrmpenerimasuratRemun');
	Route::post('surat/detailpenerimasurat', [DashbordsuratController::class, 'detailPenerimasurat'])->name('detailpenerimasurat');
	Route::post('surat/getskdanperaturan', [DashbordsuratController::class, 'getskDanperaturan'])->name('getskdanperaturan');
	Route::get('surat/jdraftskdanperaturan', [DashbordsuratController::class, 'jDraftskdanperaturan'])->name('jdraftskdanperaturan');
	Route::post('surat/jcaridraftskdanperaturan', [DashbordsuratController::class, 'jCARIDraftskdanperaturan'])->name('jCARIDraftskdanperaturan');
	Route::post('surat/setnomorterbaru', [DashbordsuratController::class, 'exSetnomorterbaru'])->name('setnomorterbaru');
	Route::post('surat/markingmailbox', [DashbordsuratController::class, 'exMarkingmailbox'])->name('exMarkingmailbox');
	Route::post('surat/getekspedisi', [DashbordsuratController::class, 'jsonDataekspedisi'])->name('jsonDataekspedisi');
	Route::post('surat/getstatistik', [DashbordsuratController::class, 'jsonDatstataekspedisi'])->name('jsonDatstataekspedisi');
	Route::post('surat/exekspedisi', [DashbordsuratController::class, 'exEkspedisi'])->name('exEkspedisi');
	Route::post('surat/exuploadsurattte', [DashbordsuratController::class, 'exUploadSuratTTE'])->name('exUploadSuratTTE');
	Route::post('surat/daftartte', [DashbordsuratController::class, 'exDaftarTTE'])->name('exDaftarTTE');
	Route::post('surat/exuploadkopsurat', [DashbordsuratController::class, 'exUploadKopsurat'])->name('exUploadKopsurat');
	Route::post('surat/getvalsrtmsk', [DashbordsuratController::class, 'exValsrtmsk'])->name('exValsrtmsk');
	Route::post('surat/exsetsertifikat', [DashbordsuratController::class, 'exSetSertifikat'])->name('exSetSertifikat');
	Route::post('surat/setnotifemail', [DashbordsuratController::class, 'exSetnotifemail'])->name('exSetnotifemail');
	Route::post('surat/cekstatustte', [DashbordsuratController::class, 'exCekstatusTTE'])->name('exCekstatusTTE');
	Route::post('surat/exsavecuti', [DashbordsuratController::class, 'exsafeCuti'])->name('exsafeCuti');
	Route::get('verfikasicuti/{id}', [DashbordsuratController::class, 'viewsuratCuti']);
	Route::post('surat/datasuratpermohonancuti', [DashbordsuratController::class, 'jPermohonancuti'])->name('jPermohonancuti');
	Route::get('surat/getlistkuotacuti', [DashbordsuratController::class, 'getlistkuotacuti'])->name('getlistkuotacuti');
	
	Route::post('surat/exsuratwithtemplate', [DashbordsuratController::class, 'exSuratWithTemplate'])->name('exSuratWithTemplate');
	
	Route::post('surat/viewsuratkeluar', [NotifikasiController::class, 'viewsuratKeluar'])->name('viewsuratkeluar');
	Route::get('antritte', [NotifikasiController::class, 'viewAntrianTTE']);
	Route::post('dev/queuettelist', [ArsipdinamisController::class, 'getAntrianTTE'])->name('getAntrianTTE');
	Route::get('dev/rekaptte', [NotifikasiController::class, 'getRekapTTE'])->name('getRekapTTE');
	Route::get('dev/rekappenggunatte', [NotifikasiController::class, 'getRekappenggunaTTE'])->name('getRekappenggunaTTE');
	Route::post('dev/exttepejabat', [NotifikasiController::class, 'exaddTTEpejabat'])->name('exaddTTEpejabat');
	Route::post('dokar/jsonprosesremun', [NotifikasiController::class, 'exProsesremun'])->name('exProsesremun');
	Route::post('surat/exsimpanttd', [NotifikasiController::class, 'exsimpanTtd'])->name('exsimpanttd');
	Route::post('surat/exsimpanttdremun', [NotifikasiController::class, 'exsimpanTtdRemun'])->name('exsimpanTtdRemun');
	Route::post('surat/exsimpanttdmulti', [NotifikasiController::class, 'exsimpanttdMulti'])->name('exsimpanttdmulti');
	
	//KEPEGAWAIAN
	Route::get('dokar/jstatpensiun', [KegepawaianController::class, 'jstatpensiun'])->name('jstatpensiun');
	Route::get('dokar/statjenispegawai', [KegepawaianController::class, 'statjenispegawai'])->name('statjenispegawai');
	Route::get('dokar/statpendidikan', [KegepawaianController::class, 'statpendidikan'])->name('statpendidikan');
	Route::get('dokar/statgolongan', [KegepawaianController::class, 'statgolongan'])->name('statgolongan');
	Route::get('dokar/jstatpangkat', [KegepawaianController::class, 'jstatpangkat'])->name('jstatpangkat');
	Route::get('komitemedik/{id}', [KegepawaianController::class, 'viewKomiteMedik']);

	//UNVERIVIED_KEPAKE
	Route::get('dashboarddokar', [KegepawaianController::class, 'index']);
	Route::get('verifikatorkgb', [KegepawaianController::class, 'verifikatorkgb']);
	Route::get('dokarsetting', [KegepawaianController::class, 'dokarsetting']);
	Route::get('ewsub', [KegepawaianController::class, 'viewEws']);
	Route::get('dokar/statlamajabatan', [KegepawaianController::class, 'statLamajabatan']);
	Route::get('dokar/jstatgaji', [KegepawaianController::class, 'jstatgaji']);
	Route::get('dokar/getpejabat', [KegepawaianController::class, 'jsonPejabat'])->name('getpejabat');
	Route::get('dokar/getpejabat2', [KegepawaianController::class, 'jsonPejabat2'])->name('getpejabat2');
	Route::get('dokar/getpejabat3', [KegepawaianController::class, 'jsonPejabat3'])->name('getpejabat3');
	Route::get('dokar/getpejabat4', [KegepawaianController::class, 'jsonPejabat4'])->name('getpejabat4');
	Route::get('dokar/getpejabat5', [KegepawaianController::class, 'jsonPejabat5'])->name('getpejabat5');
	Route::post('dokar/getvalpeg', [KegepawaianController::class, 'getValpeg'])->name('getvalpeg');
	Route::post('dokar/jgetallpegawai', [KegepawaianController::class, 'jgetAllpegawai'])->name('jgetallpegawai');
	Route::post('dokar/deletepegawai', [KegepawaianController::class, 'deletePegawai'])->name('deletepegawai');
	Route::post('dokar/jgetpengajuankgb', [KegepawaianController::class, 'jgetPengajuankgb'])->name('jgetpengajuankgb');
	Route::post('dokar/jgetdetailkgb', [KegepawaianController::class, 'jgetDetailkgb'])->name('jgetdetailkgb');
	Route::post('dokar/jgetdetailpangkat', [KegepawaianController::class, 'jgetdetailPangkat'])->name('jgetdetailPangkat');
	Route::post('dokar/jgetdetailremun', [KegepawaianController::class, 'jgetdetailRemun'])->name('jgetdetailRemun');
	Route::post('dokar/jgetdetailkgbverifikator', [KegepawaianController::class, 'jgetdetailkgbVerifikator'])->name('jgetdetailkgbverifikator');
	Route::post('dokar/exmasukkanclnkgb', [KegepawaianController::class, 'exMasukkanclnkgb'])->name('exmasukkanclnkgb');
	Route::post('dokar/exubahtglclnkgb', [KegepawaianController::class, 'exUbahtglclnkgb'])->name('exubahtglclnkgb');
	Route::post('dokar/exhapusclnkgb', [KegepawaianController::class, 'exHapusclnkgb'])->name('exhapusclnkgb');
	Route::post('dokar/exsavedetpegawaikgb', [KegepawaianController::class, 'exsavedetPegawaikgb'])->name('exsavedetpegawaikgb');
	Route::post('dokar/eximportdatakgb', [KegepawaianController::class, 'exImportdatakgb'])->name('eximportdatakgb');
	Route::post('dokar/expenomorankgb', [KegepawaianController::class, 'exPenomorankgb'])->name('expenomorankgb');
	Route::post('dokar/exbatalpengajuan', [KegepawaianController::class, 'exbatalPengajuan'])->name('exbatalpengajuan');
	Route::post('dokar/exblankocv', [KegepawaianController::class, 'exBlankocv'])->name('exblankocv');
	Route::post('dokar/exbiodatapeg', [KegepawaianController::class, 'exBiodatapeg'])->name('exbiodatapeg');
	Route::post('dokar/jgetpengajuanpangkat', [KegepawaianController::class, 'jgetPengajuanpangkat'])->name('jgetpengajuanpangkat');
	Route::post('dokar/tblsettingdokar', [KegepawaianController::class, 'tblSettingdokar'])->name('tblsettingdokar');
	Route::post('dokar/exsettingkepeg', [KegepawaianController::class, 'exSettingkepeg'])->name('exsettingkepeg');
	Route::post('dokar/expenundaankgb', [KegepawaianController::class, 'exPenundaankgb'])->name('expenundaankgb');
	Route::post('dokar/extesemail', [KegepawaianController::class, 'exTesemail'])->name('extesemail');
	Route::post('dokar/getvalredaksi', [KegepawaianController::class, 'getValredaksi'])->name('getValredaksi');
	Route::post('dokar/expejabatsk', [KegepawaianController::class, 'exPejabatSK'])->name('exPejabatSK');
	
	Route::get('draftremunerasi', [KegepawaianController::class, 'draftRemunerasi']);	
	Route::post('dokar/exmasukkanclnremun', [KegepawaianController::class, 'exmasukkanclnRemun'])->name('exmasukkanclnRemun');
	Route::post('dokar/exuploadremun', [KegepawaianController::class, 'exuploadRemun'])->name('exuploadRemun');
	Route::post('dokar/exdraftskglobal', [KegepawaianController::class, 'exdraftskGlobal'])->name('exdraftskGlobal');
	Route::post('dokar/exdraftskremun', [KegepawaianController::class, 'exdraftskRemun'])->name('exdraftskremun');
	Route::post('dokar/exdraftskremunlama', [KegepawaianController::class, 'exdraftskRemunlama'])->name('exdraftskRemunlama');
	Route::post('dokar/exkirimdraftremun', [KegepawaianController::class, 'exKirimdraftremun'])->name('exKirimdraftremun');
	Route::post('dokar/exdeleteuploadremun', [KegepawaianController::class, 'exDeleteuploadremun'])->name('exDeleteuploadremun');
	Route::post('dokar/exdraftremunmulti', [KegepawaianController::class, 'exKirimdraftremunmulti'])->name('exKirimdraftremunmulti');
	
	Route::get('draftpangkat', [KegepawaianController::class, 'draftPangkat']);	
	Route::post('dokar/exuploadnaikpangkat', [KegepawaianController::class, 'exuploadNaikpangkat'])->name('exuploadNaikpangkat');
	Route::post('dokar/jgetdetailnaikpangkat', [KegepawaianController::class, 'jgetDetailnaikpangkat'])->name('jgetDetailnaikpangkat');
	Route::post('dokar/exmasukkanclnnaikpangkat', [KegepawaianController::class, 'exmasukkanclnNaikpangkat'])->name('exmasukkanclnNaikpangkat');
	Route::post('dokar/exkirimdraftnaikpangkat', [KegepawaianController::class, 'exKirimdraftnaikpangkat'])->name('exKirimdraftnaikpangkat');
	Route::post('dokar/exdeleteuploadnaikpangkat', [KegepawaianController::class, 'exDeleteuploadnaikpangkat'])->name('exDeleteuploadnaikpangkat');
	
	Route::get('drafttubel', [KegepawaianController::class, 'draftTubel']);	
	Route::get('drafttubeltendik', [KegepawaianController::class, 'draftTubelTendik']);
	Route::post('dokar/exuploadtubel', [KegepawaianController::class, 'exuploadTubel'])->name('exuploadTubel');
	Route::post('dokar/exdraftsktubel', [KegepawaianController::class, 'exdraftskTubel'])->name('exdraftskTubel');
	Route::post('dokar/jgetdetailtubel', [KegepawaianController::class, 'jsonDetailtubel'])->name('jsonDetailtubel');
	Route::post('dokar/exkirimdrafttubel', [KegepawaianController::class, 'exKirimdrafttubel'])->name('exKirimdrafttubel');
	Route::post('dokar/exdeleteuploadtubel', [KegepawaianController::class, 'exDeleteuploadtubel'])->name('exDeleteuploadtubel');
	
	Route::get('draftjabakad', [KegepawaianController::class, 'draftJabakad']);	
	Route::post('dokar/exuploadjabakad', [KegepawaianController::class, 'exuploadJabakad'])->name('exuploadJabakad');
	Route::post('dokar/jgetdetailjabakad', [KegepawaianController::class, 'jsonDetailjabakad'])->name('jsonDetailjabakad');
	Route::post('dokar/exkirimdraftjabakad', [KegepawaianController::class, 'exKirimdraftjabakad'])->name('exKirimdraftjabakad');
	Route::post('dokar/exdeleteuploadjabakad', [KegepawaianController::class, 'exDeleteuploadjabakad'])->name('exDeleteuploadjabakad');
	Route::post('dokar/exdraftskjabakad', [KegepawaianController::class, 'exdraftskJabakad'])->name('exdraftskJabakad');
	
	Route::get('draftpemberhentian', [KegepawaianController::class, 'draftPemberhentian']);	
	Route::post('dokar/exuploadpemberhentian', [KegepawaianController::class, 'exuploadPemberhentian'])->name('exuploadPemberhentian');
	Route::post('dokar/jgetdetailpemberhentian', [KegepawaianController::class, 'jgetDetailPemberhentian'])->name('jgetDetailPemberhentian');
	Route::post('dokar/exkirimdraftpemberhentian', [KegepawaianController::class, 'exKirimdraftPemberhentian'])->name('exKirimdraftPemberhentian');
	Route::post('dokar/exdeleteuploadpemberhentian', [KegepawaianController::class, 'exDeleteuploadpemberhentian'])->name('exDeleteuploadpemberhentian');
	Route::post('dokar/exdraftskpemberhentian', [KegepawaianController::class, 'exDraftskPemberhentian'])->name('exDraftskPemberhentian');
	
	Route::get('pengangkatanpns', [KegepawaianController::class, 'draftPengangkatanpns']);	
	Route::post('dokar/exuploadpengangkatan', [KegepawaianController::class, 'exuploadPengangkatan'])->name('exuploadPengangkatan');
	Route::post('dokar/jgetdetailpengangkatanpns', [KegepawaianController::class, 'jgetDetailpengangkatanpns'])->name('jgetDetailpengangkatanpns');
	Route::post('dokar/exkirimdraftpengangkatanpns', [KegepawaianController::class, 'exKirimdraftPengangkatanPNS'])->name('exKirimdraftPengangkatanPNS');
	Route::post('dokar/exDeleteuploadpengangkatpns', [KegepawaianController::class, 'exDeleteuploadpengangkatanPNS'])->name('exDeleteuploadpengangkatanPNS');
	Route::post('dokar/exdraftskpengangkatan', [KegepawaianController::class, 'exdraftskPengangkatanPNS'])->name('exdraftskPengangkatanPNS');
	Route::post('dokar/exuploadberkasdiri', [KegepawaianController::class, 'exUploadberkasDiri'])->name('exUploadberkasDiri');
    Route::post('dokar/exhapusberkasdiri', [KegepawaianController::class, 'exHapusberkasDiri'])->name('exHapusberkasDiri');
    Route::post('kepegawaian/biodatadosen', [KegepawaianController::class, 'biodataDosen'])->name('biodatadosen');
    
	Route::get('jabatanpelaksana', [KegepawaianController::class, 'draftJabatanPelaksana']);	
	Route::post('dokar/exuploadjabatanpelaksana', [KegepawaianController::class, 'exuploadJabPelaksana'])->name('exuploadJabPelaksana');
	Route::post('dokar/jgetdetailjabpelaksana', [KegepawaianController::class, 'jgetDetailJabPelaksana'])->name('jgetDetailJabPelaksana');
	Route::post('dokar/exkirimdraftjabpelaksana', [KegepawaianController::class, 'exKirimdraftJabPelaksana'])->name('exKirimdraftJabPelaksana');
	Route::post('dokar/exdeleteuploadjabpelaksana', [KegepawaianController::class, 'exDeleteuploadJabPelaksana'])->name('exDeleteuploadJabPelaksana');
	Route::post('dokar/exdraftskjabpelaksana', [KegepawaianController::class, 'exDraftskJabPelaksana'])->name('exDraftskJabPelaksana');
	Route::post('dokar/exkirimdraftjabpelaksanamulti', [KegepawaianController::class, 'exDeleteuploadJabPelaksanamulti'])->name('exDeleteuploadJabPelaksanamulti');
	
	Route::get('draftpenempatan', [KegepawaianController::class, 'draftPenempatan']);	
	Route::post('dokar/exuploadpenempatan', [KegepawaianController::class, 'exuploadPenempatan'])->name('exuploadPenempatan');
	Route::post('dokar/exmasukkanclnpenempatan', [KegepawaianController::class, 'exmasukkanclnPenempatan'])->name('exmasukkanclnPenempatan');
	Route::post('dokar/exkirimdraftpenempatan', [KegepawaianController::class, 'exKirimdraftpenempatan'])->name('exKirimdraftpenempatan');
	
	Route::get('inpassinggaji', [KegepawaianController::class, 'draftPenyesuaianGaji']);	
	Route::post('dokar/jgetdetailinpassinggaji', [KegepawaianController::class, 'jgetDetailInpassinggaji'])->name('jgetDetailInpassinggaji');
	Route::post('dokar/exuploadpenyesuaingaji', [KegepawaianController::class, 'exuploadPenyesuaianGaji'])->name('exuploadPenyesuaianGaji');
	Route::post('dokar/exmasukkanclnpenyesuaingaji', [KegepawaianController::class, 'exmasukkanclPenyesuaianGaji'])->name('exmasukkanclPenyesuaianGaji');
	Route::post('dokar/exdeleteuploadinpassinggaji', [KegepawaianController::class, 'exDeleteuploadInpassinGaji'])->name('exDeleteuploadInpassingGaji');
	Route::post('dokar/exkirimdraftpenyesuaingaji', [KegepawaianController::class, 'exKirimdraftPenyesuaianGaji'])->name('exKirimdraftPenyesuaianGaji');
	Route::post('dokar/exkirimdraftpenyesuaingajimany', [KegepawaianController::class, 'exKirimdraftPenyesuaianGajiMany'])->name('exKirimdraftPenyesuaianGajiMany');
	
	Route::get('udin', [KegepawaianController::class, 'draftUdin']);
	Route::get('nilaiujiandinas', [KegepawaianController::class, 'viewNilaiujiandinas']);
	Route::get('ujiandinas', [KegepawaianController::class, 'viewUjianDinas']);
	Route::post('dokar/jgetdetailudin', [KegepawaianController::class, 'jgetdetailUdin'])->name('jgetdetailUdin');
	Route::post('dokar/exuploadudin', [KegepawaianController::class, 'exuploadUdin'])->name('exuploadUdin');
	Route::post('dokar/exmasukkanclnudin', [KegepawaianController::class, 'exmasukkanclnUdin'])->name('exmasukkanclnUdin');
	Route::post('dokar/exdeleteuploadudin', [KegepawaianController::class, 'exdeleteuploadUdin'])->name('exdeleteuploadUdin');
	Route::post('dokar/exkirimdraftudin', [KegepawaianController::class, 'exkirimdraftUdin'])->name('exkirimdraftUdin');
	Route::post('dokar/exloginudin', [KegepawaianController::class, 'exLoginUdin'])->name('exLoginUdin');
	
	Route::get('skkontrak', [KegepawaianController::class, 'draftSKkontrak']);	
	Route::post('dokar/jgetdetailskkontrak', [KegepawaianController::class, 'jgetDetailSKkontrak'])->name('jgetDetailSKkontrak');
	Route::post('dokar/exuploadskkontrak', [KegepawaianController::class, 'exuploadSKkontrak'])->name('exuploadSKkontrak');
	Route::post('dokar/exmasukkanclnskkontrak', [KegepawaianController::class, 'exmasukkanclSKkontrak'])->name('exmasukkanclSKkontrak');
	Route::post('dokar/exdeleteuploadskkontrak', [KegepawaianController::class, 'exDeleteuploadSKkontrak'])->name('exDeleteuploadSKkontrak');
	Route::post('dokar/exkirimdraftskkontrak', [KegepawaianController::class, 'exKirimdraftSKkontrak'])->name('exKirimdraftSKkontrak');
	Route::post('dokar/exkirimdraftskkontrakmany', [KegepawaianController::class, 'exKirimdraftSKkontrakMany'])->name('exKirimdraftSKkontrakMany');
	
	Route::get('bpjsadmin', [KegepawaianController::class, 'viewAdminBPJS']);	
	Route::get('dokar/statbpjsperunit', [KegepawaianController::class, 'getStatistikBPJS'])->name('getStatistikBPJS');	
	Route::get('dokar/rekapdatabpjsperjenis', [KegepawaianController::class, 'rekapDataBPJSperjenis'])->name('rekapDataBPJSperjenis');	
	Route::post('dokar/jsondatabpjs', [KegepawaianController::class, 'jGetDataBPJS'])->name('jGetDataBPJS');
	Route::post('dokar/exdatabpjs', [KegepawaianController::class, 'exInputdataBPJS'])->name('exInputdataBPJS');
	Route::get('dokar/jsonfaskes', [KegepawaianController::class, 'jsonListFaskes'])->name('jsonListFaskes');
	Route::post('dokar/datajanggotabpjs', [KegepawaianController::class, 'getJsonanggotaBPJS'])->name('getJsonanggotaBPJS');	
	
	Route::get('latsaradmin', [KegepawaianController::class, 'viewAdminLATSAR']);	
	Route::post('dokar/jgetdetaillatsar', [KegepawaianController::class, 'jgetdetailLatsar'])->name('jgetdetailLatsar');
	Route::post('dokar/exmasukkanclnlatsar', [KegepawaianController::class, 'exmasukkanclnLatsar'])->name('exmasukkanclnLatsar');
	Route::post('dokar/exkuisionerlatsar', [KegepawaianController::class, 'exQuizionerLatsar'])->name('exQuizionerLatsar');
	
	Route::post('dokar/exprosessrtkp', [KegepawaianController::class, 'exUploadSuratKepegawaian'])->name('exUploadSuratKepegawaian');
	
	#=========== Recruitmen ===========#
	Route::get('alihstatus', [KegepawaianController::class, 'viewAlihStatus']);
	Route::post('dokar/exinputpegalihstatus', [KegepawaianController::class, 'exInputPegAlihStatus'])->name('exInputPegAlihStatus');
	Route::post('dokar/jgetpegalihstatus', [KegepawaianController::class, 'jsonPegalihStatus'])->name('jsonPegalihStatus');
	Route::get('lampiran/{id}', [KegepawaianController::class, 'viewBerkasLampiran']);
	Route::get('verfikasialihstatus/{id}', [KegepawaianController::class, 'viewVerfikasialihStatus']);

	#=========== End Recruitmen ===========#
	//SIAPIKET
	Route::get('siapiket', [KegepawaianController::class, 'siapiketIndex']);
	Route::get('dokar/getsiapiketdata', [KegepawaianController::class, 'getJadwalSIAPIKET'])->name('getJadwalSIAPIKET');
	Route::post('dokar/getsiapiketdetail', [KegepawaianController::class, 'detailSIAPiket'])->name('detailSIAPiket');

	// Bantuan Studi
	Route::get('bantuanadmin', [BantuanController::class, 'index']);
	Route::get('bantuanadminpublikasi', [BantuanController::class, 'viewAdminPublikasi']);
	Route::get('bantuanadminriset', [BantuanController::class, 'viewAdminRiset']);
	Route::get('daftarbantuanadmin', [BantuanController::class, 'daftarbantuanadmin']);
	Route::get('bantuanuser', [BantuanController::class, 'bantuanUser']);

	Route::get('bantuan/statjenispeg', [BantuanController::class, 'statjenispegawai']);
	Route::get('bantuan/statpendidikan', [BantuanController::class, 'statpendidikan']);
	Route::get('bantuan/statgolongan', [BantuanController::class, 'statgolongan']);
	Route::get('bantuan/statnegara', [BantuanController::class, 'statnegara']);
	Route::get('bantuan/statrekaptahunan', [BantuanController::class, 'statrekaptahunan']);
	
	Route::get('bantuan/jalldata', [BantuanController::class, 'jallData'])->name('jalldataBantuan');
	Route::get('bantuan/jalldatapegawai', [BantuanController::class, 'jalldataPegawai'])->name('jalldatapegawai');
	Route::get('bantuan/settingmaksbantuan', [BantuanController::class, 'settingMaksbantuan'])->name('settingmaksbantuan');
	Route::post('bantuan/exsettingppatk', [BantuanController::class, 'exsettingppatk']);
	Route::post('bantuan/exuploadbukti', [BantuanController::class, 'exuploadbukti']);
	Route::post('bantuan/exsktarif', [BantuanController::class, 'exsktarif']);
	Route::post('bantuan/exbantuanstudi', [BantuanController::class, 'exbantuanstudi']);
	Route::post('bantuan/exbantuanpublikasi', [BantuanController::class, 'exbantuanpublikasi']);
	Route::post('bantuan/exbantuanriset', [BantuanController::class, 'exBantuanriset']);
	Route::post('bantuan/jsktarif', [BantuanController::class, 'jSktarif'])->name('jsktarif');
	Route::post('bantuan/jcekuserstudi', [BantuanController::class, 'jcekuserStudi'])->name('jcekuserstudi');
	Route::post('bantuan/jcekuserpublikasi', [BantuanController::class, 'jcekuserPublikasi'])->name('jcekuserpublikasi');
	Route::post('bantuan/rekapallbantuan', [BantuanController::class, 'rekapallBantuan'])->name('rekapallbantuan');
	Route::post('bantuan/ctkkwtbantuan', [BantuanController::class, 'ctkKwtbantuan'])->name('ctkkwtbantuan');
	Route::post('bantuan/exsetmaksimal', [BantuanController::class, 'exsetMaksimal'])->name('exsetmaksimal');
	Route::post('bantuan/exhapusdatabantuan', [BantuanController::class, 'exhapusdataBantuan'])->name('exhapusdatabantuan');
	Route::post('bantuan/verifikasibantuan', [BantuanController::class, 'verifikasiBantuan'])->name('verifikasibantuan');
	Route::post('bantuan/jrekapbantuanppabp', [BantuanController::class, 'jrekapbantuanPpabp'])->name('jrekapbantuanppabp');
	Route::post('bantuan/jcekfileupload', [BantuanController::class, 'jcekFileupload'])->name('jcekfileupload');
	Route::post('bantuan/uploadsyaratbantuan', [BantuanController::class, 'uploadSyaratbantuan'])->name('uploadsyaratbantuan');
	Route::post('bantuan/exuploadpublikasi', [BantuanController::class, 'exUploadPublikasi'])->name('exUploadPublikasi');
	Route::post('bantuan/exaddsuratbantuan', [BantuanController::class, 'exSuratbantuan'])->name('exSuratbantuan');
	
	//SIMPUKJA
	// Route::get('simpukjadmin', [SimpukjaController::class, 'index']);
	// Route::get('simpukjapengajuan', [SimpukjaController::class, 'viewPengajuan']);
	// Route::get('simpukjaverifikasi', [SimpukjaController::class, 'viewVerifikasi']);
	// Route::get('berkaspak', [SimpukjaController::class, 'viewBerkasPAK']);
	// Route::get('simprokja', [SimpukjaController::class, 'viewSimprokja']);
	// Route::get('simpukja/datajpengajuanpak', [SimpukjaController::class, 'getPengajuanpak'])->name('getPengajuanpak');
	// Route::get('simpukja/datajpengajuanpakpaginated', [SimpukjaController::class, 'getPengajuanpakPaginated'])->name('getPengajuanpakPaginated');
	// Route::post('simpukja/datajpengajuanpakarsip', [SimpukjaController::class, 'getPengajuanpakarsip'])->name('getPengajuanpakarsip');
	// Route::post('simpukja/exaddlayanan', [SimpukjaController::class, 'exaddLayanan'])->name('exaddLayanan');
	// Route::post('simpukja/exsavepengajuan', [SimpukjaController::class, 'exSavepengajuan'])->name('exSavepengajuan');
	// Route::post('simpukja/exdeldatasimpukja', [SimpukjaController::class, 'exDeldatasimpukja'])->name('exDeldatasimpukja');
	// Route::post('simpukja/getgambarsimpukja', [SimpukjaController::class, 'getGambarsimpukja'])->name('getGambarsimpukja');
	// Route::post('simpukja/deletegambarsimpukja', [SimpukjaController::class, 'deleteGambarsimpukja'])->name('deleteGambarsimpukja');
	// Route::post('simpukja/savegambarsimpukja', [SimpukjaController::class, 'saveGambarsimpukja'])->name('saveGambarsimpukja');
	// Route::post('simpukja/listlayanan', [SimpukjaController::class, 'jsonListlayanan'])->name('jsonListlayanan');
	// Route::post('simpukja/exupdlayanan', [SimpukjaController::class, 'exUpdlayanan'])->name('exUpdlayanan');
	// Route::post('simpukja/exubahurutanlayanan', [SimpukjaController::class, 'exubahUrutanlayanan'])->name('exubahUrutanlayanan');
	// Route::post('simpukja/exdellayanan', [SimpukjaController::class, 'exDellayanan'])->name('exDellayanan');
	// Route::post('simpukja/exverpengajuan', [SimpukjaController::class, 'exVerpengajuan'])->name('exVerpengajuan');
	// Route::post('simpukja/exkirimsimpukja', [SimpukjaController::class, 'exKirimsimpukja'])->name('exKirimsimpukja');
	// Route::post('simpukja/getpilihlayanan', [SimpukjaController::class, 'jsonPilihlayananPAK'])->name('jsonPilihlayanan');
	// Route::post('simpukja/gettrackinglist', [SimpukjaController::class, 'jsonTrackinglist'])->name('jsonTrackinglist');
	// Route::post('simpukja/getsurat', [SimpukjaController::class, 'jsonTrackinglistsurat'])->name('jsonTrackinglistsurat');
	// Route::post('simpukja/getsuratsk', [SimpukjaController::class, 'jsonTrackinglistsk'])->name('jsonTrackinglistsk');
	// Route::post('simpukja/exsurat', [SimpukjaController::class, 'exSuratSIMPROKJA'])->name('exSuratSIMPROKJA');
	// Route::post('simpukja/getpemohonsimpro', [SimpukjaController::class, 'exPemohonSIMPRO'])->name('exPemohonSIMPRO');
	
	// // E - Cek
	// Route::get('ecekadmin', [EcekController::class, 'index']);
	// Route::get('ecekverfikasi', [EcekController::class, 'ecekVerfikasi']);
	// Route::post('ecek/jsonviewsingkatan', [EcekController::class, 'viewSingkatan'])->name('viewSingkatan');
	// Route::post('ecek/delsingkatanunit', [EcekController::class, 'exDelsingkatanunit'])->name('exDelsingkatanunit');
	// Route::post('ecek/exaddsingkatan', [EcekController::class, 'exAddsingkatan'])->name('exAddsingkatan');
	// Route::post('ecek/exadddataceek', [EcekController::class, 'exDataecek'])->name('exdataecek');
	// Route::post('ecek/jsonviewbukucek', [EcekController::class, 'jsonBukucek'])->name('jsonBukucek');
	// Route::post('ecek/deldatabukucek', [EcekController::class, 'exDeldatabukucek'])->name('exDeldatabukucek');
	// Route::post('ecek/exuploaddatacek', [EcekController::class, 'exUploaddatacek'])->name('exUploaddatacek');
	// Route::post('ecek/exadddataceek', [EcekController::class, 'exDataecek'])->name('exdataecek');
	// Route::post('ecek/rekapbukucek', [EcekController::class, 'rekapBukucek'])->name('rekapBukucek');
	// Route::post('ecek/rekapbukucekbyttd', [EcekController::class, 'rekapbukucekByttd'])->name('rekapbukucekByttd');
	// Route::post('ecek/excetakecek', [EcekController::class, 'exCetakecek'])->name('excetakecek');
	// Route::post('ecek/exaccbukucek', [EcekController::class, 'exACCbukucek'])->name('exACCbukucek');
	// Route::post('ecek/ctkttdcekonly', [EcekController::class, 'ctkTtdcekonly'])->name('ctkTtdcekonly');
	// // SIMSPD
	// Route::get('sppdadmin', [SppdController::class, 'index']);
	// Route::get('sppdkegiatan', [SppdController::class, 'sppdkegiatan']);
	// Route::get('sppdsetting', [SppdController::class, 'sppdsetting']);
	// Route::post('sppd/exsettingpspd', [SppdController::class, 'exsettingpspd']);
	// Route::post('sppd/exarsipspd', [SppdController::class, 'exArsipspd'])->name('exarsipspd');
	// Route::post('sppd/savegambarspd', [SppdController::class, 'saveGambarspd'])->name('savegambarspd');
	// Route::post('sppd/deletegambarspd', [SppdController::class, 'deleteGambarspd'])->name('deletegambarspd');
	// Route::post('sppd/getgambarspd', [SppdController::class, 'getGambarspd'])->name('getgambarspd');
	// Route::post('sppd/jrekapspd', [SppdController::class, 'jRekapspd'])->name('jrekapspd');
	// Route::post('sppd/ctkspddepan', [SppdController::class, 'ctkspdDepan'])->name('ctkspddepan');
	// Route::post('sppd/ctkrincianspd', [SppdController::class, 'ctkRincianspd'])->name('ctkrincianspd');
	// Route::post('sppd/ctkriilspd', [SppdController::class, 'ctkRiilspd'])->name('ctkriilspd');
	// Route::post('sppd/exctkspdbelakangen', [SppdController::class, 'exctkspdBelakangen'])->name('exctkspdbelakangen');
	// Route::post('sppd/exctkspdbelakangid', [SppdController::class, 'exctkspdBelakangid'])->name('exctkspdbelakangid');
	// Route::post('sppd/exctkspddepanen', [SppdController::class, 'exctkspdDepanen'])->name('exctkspddepanen');
	// Route::post('sppd/exctkspddepanid', [SppdController::class, 'exctkspdDepanid'])->name('exctkspddepanid');
	// Route::post('sppd/exctkriilspd', [SppdController::class, 'exctkRiilspd'])->name('exctkriilspd');
	// Route::post('sppd/exctkrincianspd', [SppdController::class, 'exctkRincianspd'])->name('exctkrincianspd');
	// Route::post('sppd/exmultipengajuan', [SppdController::class, 'exMultipengajuan'])->name('exmultipengajuan');
	// Route::post('sppd/jgetspd', [SppdController::class, 'jGetspd'])->name('jgetspd');
	// Route::post('sppd/jpengikutnonpegawai', [SppdController::class, 'jpengikutNonpegawai'])->name('jpengikutnonpegawai');
	// Route::post('sppd/surattugasspd', [SppdController::class, 'suratTugasspd'])->name('surattugasspd');
	// Route::post('sppd/jhrdlmnegeri', [SppdController::class, 'jHrdlmnegeri'])->name('jhrdlmnegeri');
	// Route::post('sppd/jhrluarnegeri', [SppdController::class, 'jhrLuarnegeri'])->name('jhrluarnegeri');
	// Route::post('sppd/inapdlmnegeri', [SppdController::class, 'inapDlmnegeri'])->name('inapdlmnegeri');
	// Route::post('sppd/trfkendaraan', [SppdController::class, 'trfKendaraan'])->name('trfkendaraan');
	// Route::post('sppd/trfrapatdlr', [SppdController::class, 'trfRapatdlr'])->name('trfrapatdlr');
	// Route::post('sppd/trfuhrapatdlr', [SppdController::class, 'trfUhrapatdlr'])->name('trfuhrapatdlr');
	// Route::post('sppd/trftiketpesawatdlmnegeri', [SppdController::class, 'trftiketpesawatDlmnegeri'])->name('trftiketpesawatdlmnegeri');
	// Route::post('sppd/trftiketpesawatluarnegeri', [SppdController::class, 'trftiketpesawatLuarnegeri'])->name('trftiketpesawatluarnegeri');
	// Route::post('sppd/trfrepresentasi', [SppdController::class, 'trfRepresentasi'])->name('trfrepresentasi');
	// Route::post('sppd/trftaksi', [SppdController::class, 'trfTaksi'])->name('trftaksi');
	// Route::post('sppd/jprovinsi', [SppdController::class, 'jProvinsi'])->name('jprovinsi');
	// Route::post('sppd/exhapusdata', [SppdController::class, 'exHapusdatasppd'])->name('exhapusdata');
	// Route::post('sppd/exhapusspd', [SppdController::class, 'exhapusSpd'])->name('exhapusspd');
	// Route::post('sppd/expengikutspd', [SppdController::class, 'exPengikutspd'])->name('expengikutspd');
	// Route::post('sppd/detailpenerimaspd', [SppdController::class, 'detailPenerimaspd'])->name('detailpenerimaspd');
	// Route::post('sppd/exsppd', [SppdController::class, 'exSppd'])->name('exsppd');
	// Route::post('sppd/expengajuanspd', [SppdController::class, 'exPengajuanspd'])->name('expengajuanspd');
	// Route::post('sppd/expengajuanspdnew', [SppdController::class, 'expengajuanspdNew'])->name('expengajuanspdnew');
	// Route::post('sppd/detailpengajuanbiayaspd', [SppdController::class, 'detailpengajuanBiayaspd'])->name('detailpengajuanbiayaspd');
	// Route::post('sppd/store', [SppdController::class, 'store']);
	// Route::post('sppd/exupdatespd', [SppdController::class, 'exupdatespd']);
	
	
	// Peminjaman Ruang dan Kendaraan
	Route::get('jadwal', [JadwalController::class, 'index']);
	Route::get('rentcar', [JadwalController::class, 'rentkendaraan']);
	// Route::get('ruangan', [RuanganController::class, 'index']);
	// Route::get('kendaraan', [KendaraanController::class, 'index']);
	// Route::get('report', [ReportController::class, 'index']);
	// Route::get('masterlab', [RuanganController::class, 'masterLab']);
	
	// Route::get('umum/ruanglab', [RuanganController::class, 'getallRuanglab']);
	// Route::post('umum/jfaslaboratorium', [RuanganController::class, 'jsonFaslaboratorium'])->name('jsonFaslaboratorium');
	// Route::post('umum/exfasilitaslab', [RuanganController::class, 'exFasilitaslab'])->name('exFasilitaslab');
	// Route::post('umum/exruanglab', [RuanganController::class, 'exRuanglab'])->name('exRuanglab');
	
	// Route::post('getreport', [ReportController::class, 'getJadwal'])->name('getjadwal');
    // Route::get('umum/allkendaraan', [KendaraanController::class, 'getallkendaraan']);
	// Route::get('umum/allgarasi', [KendaraanController::class, 'getallgarasi']);
	// Route::post('umum/exkendaraan', [KendaraanController::class, 'exKendaraan'])->name('exkendaraan');
	// Route::post('umum/storepinjamkendaraan', [KendaraanController::class, 'storepinjamkendaraan']);
	// Route::post('umum/hapuspinjamkendaraan', [KendaraanController::class, 'hapuspinjamkendaraan']);
	// Route::post('umum/getaktifitaskendaraan', [KendaraanController::class, 'getAktifitaskendaraan'])->name('getAktifitaskendaraan');
	// Route::get('umum/getlistkendaraan', [KendaraanController::class, 'getlistKendaraan'])->name('getlistkendaraan');
	// Route::get('umum/stajenis', [KendaraanController::class, 'jsonStajenis'])->name('jsonStajenis');
	// Route::get('umum/statthnkendaraan', [KendaraanController::class, 'jsonStatthnkendaraan'])->name('jsonStatthnkendaraan');
	
	// Route::post('umum/ctkdir', [RuanganController::class, 'ctkdir'])->name('ctkdir');
	// Route::get('umum/allruang', [RuanganController::class, 'getallruang']);
    // Route::get('umum/allgedung', [RuanganController::class, 'getallgedung']);
	// Route::post('umum/getrekapdetailruang', [RuanganController::class, 'getrekapdetailruang']);
	// Route::post('umum/getdetailruang', [RuanganController::class, 'getdetailruang']);
	// Route::post('umum/exfasruang', [RuanganController::class, 'exfasruang'])->name('exfasruang');
	// Route::post('umum/exruang', [RuanganController::class, 'exruang'])->name('exruang');
	
	Route::post('jadwal/store', [JadwalController::class, 'store'])->name('exSaveJadwalKegiatan');
	Route::post('jadwal/hapus', [JadwalController::class, 'hapus']);
	Route::get('jadwal/getlist', [JadwalController::class, 'getlist'])->name('getlist');
	Route::get('jadwal/getlistpenjadwalan', [JadwalController::class, 'getlistPenjadwalan'])->name('getlistpenjadwalan');
	Route::post('jadwal/jsongetallpinjam', [JadwalController::class, 'jsonAllpinjam'])->name('jsonAllpinjam');
	Route::post('jadwal/exarsippeminjaman', [JadwalController::class, 'exArsippeminjaman'])->name('exArsippeminjaman');
	
	// ADMIN GAJI
    Route::get('gaji', [AdminKeuanganController::class, 'viewGaji'])->name('gaji');
    Route::post('keuangan/simpandatapegawai', [AdminKeuanganController::class, 'simpanDatapegawai'])->name('updatemstpegawaigaji');
    
	Route::get('karyawan', [AdminKeuanganController::class, 'viewKaryawan']);
    Route::get('pinjaman', [AdminKeuanganController::class, 'viewPinjaman']);
    Route::get('gpp', [AdminKeuanganController::class, 'viewGpp']);
    Route::get('gajidosen', [AdminKeuanganController::class, 'viewDosen']);
    Route::get('gajisetting', [AdminKeuanganController::class, 'viewSetting']);
    Route::get('espete', [AdminKeuanganController::class, 'viewEspete']);
    Route::get('useracc', [AdminKeuanganController::class, 'viewUseracc']);
	Route::get('gajiuser', [AdminKeuanganController::class, 'viewUsergaji']);
	
	
	Route::get('karyawan/getjtblgajipns', [AdminKeuanganController::class, 'getJtblgajipns'])->name('getjtblgajipns');
    Route::get('karyawan/getjtblgajinonpns', [AdminKeuanganController::class, 'getJtblgajinonpns'])->name('getjtblgajinonpns');
    Route::get('karyawan/getmasterpendudukaktif', [AdminKeuanganController::class, 'getMasterpenduduk'])->name('getmasterpendudukaktif');
    Route::post('karyawan/getmasterpendudukinaktif', [AdminKeuanganController::class, 'getmasterpendudukInaktif'])->name('getmasterpendudukinaktif');
    Route::post('karyawan/datajanggotaklg', [AdminKeuanganController::class, 'dataJanggotaklg'])->name('datajanggotaklg');
    Route::post('karyawan/datajriwayat', [AdminKeuanganController::class, 'dataJriwayat'])->name('dataJriwayat');
    Route::post('karyawan/datajriwayatgaji', [AdminKeuanganController::class, 'dataJriwayatgaji'])->name('dataJriwayatgaji');
    Route::post('karyawan/simpandataagtklg', [AdminKeuanganController::class, 'simpanDataagtklg'])->name('simpandataagtklg');
    Route::post('karyawan/simpantambahgaji', [AdminKeuanganController::class, 'simpanTambahgaji'])->name('simpantambahgaji');
    Route::post('karyawan/exprofile', [AdminKeuanganController::class, 'exProfile'])->name('exprofile');

    Route::post('pinjaman/datajnorek', [AdminKeuanganController::class, 'dataJnorek'])->name('datajnorek');
    Route::post('pinjaman/datajpinjaman', [AdminKeuanganController::class, 'dataJpinjaman'])->name('datajpinjaman');
    Route::post('pinjaman/datajdetailpinjaman', [AdminKeuanganController::class, 'dataJdetailpinjaman'])->name('datajdetailpinjaman');
    Route::post('pinjaman/exsimpannorek', [AdminKeuanganController::class, 'exSimpannorek'])->name('exsimpannorek');
    Route::post('pinjaman/exsimpanpinjaman', [AdminKeuanganController::class, 'exSimpanpinjaman'])->name('exsimpanpinjaman');
    Route::post('pinjaman/uploadfilepinjaman', [AdminKeuanganController::class, 'uploadFilepinjaman'])->name('uploadfilepinjaman');

    Route::post('gaji/exgaji', [AdminKeuanganController::class, 'exGaji'])->name('exgaji');
    Route::get('gaji/jdataaktifbku', [AdminKeuanganController::class, 'jdataAktifbku'])->name('jdataaktifbku');
    Route::post('gaji/generatedataawal', [AdminKeuanganController::class, 'generateDataawal'])->name('generatedataawal');
    Route::post('gaji/cetakslipgaji', [AdminKeuanganController::class, 'cetakSlipgaji'])->name('cetakslipgaji');
    Route::post('gaji/cetakslipgajikpri', [AdminKeuanganController::class, 'cetakSlipgajikpri'])->name('cetakslipgajikpri');
    Route::post('gaji/cetakslipgajilengkap', [AdminKeuanganController::class, 'cetakSlipgajilengkap'])->name('cetakslipgajilengkap');
    Route::post('gaji/datajgajian', [AdminKeuanganController::class, 'dataJgajian'])->name('datajgajian');
    Route::post('gaji/detailgajisass', [AdminKeuanganController::class, 'detailGajisass'])->name('detailgajisass');
    Route::post('gaji/uploadfilegaji', [AdminKeuanganController::class, 'uploadFilegaji'])->name('uploadfilegaji');
	Route::post('gaji/exaktivasigaji', [AdminKeuanganController::class, 'exAktivasigaji'])->name('exAktivasigaji');
	Route::get('gaji/datajgajipegawai', [AdminKeuanganController::class, 'datajGajiPegawai'])->name('datajGajiPegawai');
    
    Route::post('gpp/generatedatagpp', [AdminKeuanganController::class, 'generateDatagpp'])->name('generatedatagpp');
    Route::post('gpp/uploadfilegpp', [AdminKeuanganController::class, 'uploadFilegpp'])->name('uploadfilegpp');

    Route::post('gajidosen/uploadfilegajidosen', [AdminKeuanganController::class, 'uploadFilegajidosen'])->name('uploadfilegajidosen');

    Route::post('setting/exsettunjangan', [AdminKeuanganController::class, 'exSettunjangan'])->name('exsettunjangan');
    Route::post('setting/exsetting', [AdminKeuanganController::class, 'exSetting'])->name('exsetting');
    Route::get('setting/getdatajsetting', [AdminKeuanganController::class, 'getDatajsetting'])->name('getdatajsetting');

    Route::post('espete/masterpenduduk', [AdminKeuanganController::class, 'masterPenduduk'])->name('masterpenduduk');
	Route::post('espete/cetakformpajak', [AdminKeuanganController::class, 'cetakFormpajak'])->name('cetakformpajak');
	
	//Keuangan HPT
	// Route::get('dashboardbendaharajurusan', [HPTController::class, 'index']);
	// Route::post('excutor/simpanefikasi', [HPTController::class, 'simpanEfikasi'])->name('simpanEfikasi');
	// Route::post('excutor/simpaneditefikasi', [HPTController::class, 'simpanEditefikasi'])->name('simpanEditefikasi');
	// Route::post('excutor/simpantuntasefikasi', [HPTController::class, 'simpanTuntasefikasi'])->name('simpanTuntasefikasi');
	// Route::get('json/dataefikasi', [HPTController::class, 'getdataEfikasi'])->name('getdataEfikasi');
	// Route::post('json/lapefikasi', [HPTController::class, 'getlapEfikasi'])->name('getlapEfikasi');
	// Route::post('json/rincianefikasi', [HPTController::class, 'getRincianefikasi'])->name('getRincianefikasi');
	
	// VOKASI
	// Route::get('frontpagevokasi', [VokasiController::class, 'index']);
	// Route::get('profileuser', [VokasiController::class, 'viewProfile']);
	// Route::get('accountmanagement', [VokasiController::class, 'viewManagement']);
	// Route::post('accountmanagement/deleteaccount', [VokasiController::class, 'deleteAccount'])->name('deleteaccount');
	// Route::get('accountmanagement/getdatausers', [VokasiController::class, 'getDatausers'])->name('getdatausers');
	// Route::get('accountmanagement/getdatapejabat', [VokasiController::class, 'getdataPejabat'])->name('getdatapejabat');
	// Route::post('accountmanagement/claimnim', [VokasiController::class, 'exClaimNIM'])->name('exClaimNIM');
	
	// Route::post('profile/uploadfoto', [VokasiController::class, 'uploadFotoprofil'])->name('uploadfotoprofil');
	// Route::post('accountmanagement/updatemhs', [VokasiController::class, 'updateMahasiswa'])->name('updatemahasiswa');
    // Route::post('accountmanagement/updatestaff', [VokasiController::class, 'updateStaff'])->name('updatestaff');
    
	// Route::post('pengumuman/store', [VokasiController::class, 'store']);
	// Route::post('pengumuman/destroy', [VokasiController::class, 'destroy']);
	// Route::post('pengumuman/destroychatlist', [VokasiController::class, 'destroychatlist']);
	// Route::get('pengumuman/getchatlist', [VokasiController::class, 'getChatlist']);
    // Route::get('frontpag3/detailbimbingan/{id}', [VokasiController::class, 'detailBimbingan'])->name('detailbimbingan');
    // Route::post('frontpag3/detailbimbingan/getreportmhs', [VokasiController::class, 'getReportmhs'])->name('getreportmhs');
    // Route::post('frontpag3/detailbimbingan/getdatalogskripsi', [VokasiController::class, 'getDatalogskripsi'])->name('getdatalogskripsi');
    // Route::post('frontpag3/detailbimbingan/savebimbingan', [VokasiController::class, 'saveBimbingan'])->name('savebimbingan');
    // Route::post('frontpag3/detailbimbingan/savebimbingankrs', [VokasiController::class, 'saveBimbingankrs'])->name('savebimbingankrs');
    // Route::post('frontpag3/detailbimbingan/savebimbingankprs', [VokasiController::class, 'saveBimbingankprs'])->name('savebimbingankprs');
	// Route::post('frontpag3/exttd', [VokasiController::class, 'exTtd'])->name('exTtd');
	// Route::post('getkalenderlistfakultas', [VokasiController::class, 'getKalenderlist'])->name('getkalenderlistfakultas');
	// Route::get('formplagiasivokasi', [VokasiController::class, 'viewFormplagiasi']);
	// Route::post('getlapmagangvokasi', [VokasiController::class, 'getLapmagangvokasi'])->name('getlapmagangvokasi');
	// Route::get('viewbynim/{id}', [VokasiController::class, 'viewBiodatamhs']);

	// Program PascaSarjana UB
	// Route::get('frontpagepps', [PpsController::class, 'index']);
	// Route::get('admincamaba', [PpsController::class, 'viewAdmincamaba']);
	// Route::get('dashboardpps', [VokasiController::class, 'dashboard']); //dibuatglobal
	// Route::get('lapkuisioner', [PpsController::class, 'viewLapkuisioner']); //dibuatglobal
	
	Route::get('jadwalsatpam', [JadwalController::class, 'viewJadwalsatpam']);
	Route::post('satpam/jsontabelsatpam', [JadwalController::class, 'jsonTabelsatpam'])->name('jsonTabelsatpam');
    Route::post('satpam/exhapusjadwalsaptam', [JadwalController::class, 'exHapusjadwalSaptam'])->name('exHapusjadwalSaptam');
    Route::post('satpam/exjadsatpam', [JadwalController::class, 'exJadsatpam'])->name('exJadsatpam');
    Route::post('satpam/rekapsatpam', [JadwalController::class, 'jsonRekapsatpam'])->name('jsonRekapsatpam');
    Route::post('satpam/getkalsatpamlist', [JadwalController::class, 'getKalSatpamlist'])->name('getKalSatpamlist');
	
	// Route::get('adminplagiasi', [PpsController::class, 'viewAdminplagiasi']);
	// Route::get('camabas2', [PpsController::class, 'viewAdmincamabas2']);
	// Route::get('camabas3', [PpsController::class, 'viewAdmincamabas3']);
	// Route::post('plagiasi/getdataplagiasi', [PpsController::class, 'jsonDataplagiasi'])->name('jsonDataplagiasi');
	// Route::post('plagiasi/getfileplagiasi', [PpsController::class, 'jsonFileplagiasi'])->name('getfileplagiasi');
	// Route::post('plagiasi/exdelhasilplagiasi', [PpsController::class, 'deleteHasilPlagiasi'])->name('deleteHasilPlagiasi');
	
	// Route::post('camaba/jsontemplateberkascamaba', [PpsController::class, 'jsontemplateBerkascamaba'])->name('templateberkascamaba');
	// Route::post('camaba/jjadwalujiancamaba', [PpsController::class, 'jsonJadwalujiancamaba'])->name('jjadwalujiancamaba');
	// Route::post('camaba/datajcamaba', [PpsController::class, 'jsonDatacamaba'])->name('datajcamaba');
	// Route::post('camaba/exsetcamaba', [PpsController::class, 'exSetcamaba'])->name('exsetcamaba');
	
	// Route::post('getevaluasiresult', [PpsController::class, 'getEvaluasiresult'])->name('getEvaluasiresult');
	// Route::get('surat/datasuratbeasiswa', [PpsController::class, 'datasuratBeasiswa'])->name('datasuratBeasiswa');
	// Route::post('bantuan/exbeasiswapps', [PpsController::class, 'exBeasiswapps']);
	// Route::post('beasiswa/uploadpencairan', [PpsController::class, 'uploadFilepencairan'])->name('uploadFilepencairan');
	// Route::get('pencairanbeasiswa', [PpsController::class, 'viewPencairanbeasiswa']);
    // Route::post('surat/updsuratklrbeasiswa', [PpsController::class, 'exSuratklrbeasiswa']);
	// Route::post('surat/jgetpenerimabeasiswa', [PpsController::class, 'getPenerimabeasiswa'])->name('getPenerimabeasiswa');
	// Route::post('surat/expenerimabeasiswa', [PpsController::class, 'exPenerimabeasiswa'])->name('exPenerimabeasiswa');
	
	// // FMIPA
	// Route::get('frontpagemipa', [MipaController::class, 'index']);
	// Route::get('camabas2biologi', [MipaController::class, 'viewAdmincamabas2biologi']);
	// Route::get('camabas2fisika', [MipaController::class, 'viewAdmincamabas2fisika']);
	// Route::get('camabas2matematika', [MipaController::class, 'viewAdmincamabas2matematika']);
	// Route::get('camabas2kimia', [MipaController::class, 'viewAdmincamabas2kimia']);
	// Route::get('camabas2statistika', [MipaController::class, 'viewAdmincamabas2statistika']);
	
	// Route::get('camabas3biologi', [MipaController::class, 'viewAdmincamabas3biologi']);
	// Route::get('camabas3fisika', [MipaController::class, 'viewAdmincamabas3fisika']);
	// Route::get('camabas3matematika', [MipaController::class, 'viewAdmincamabas3matematika']);
	// Route::get('camabas3kimia', [MipaController::class, 'viewAdmincamabas3kimia']);
	// Route::get('camabas3statistika', [MipaController::class, 'viewAdmincamabas3statistika']);
	
	// // FP
	// Route::get('frontpagefp', [PertanianController::class, 'index']);
	
	// // JADWAL
	// Route::get('ruangmhs', [LayananMahasiswaController::class, 'viewruangmhs']);
    // Route::get('ruangseminar', [AdminJurusanController::class, 'viewRuangseminar']);
    // Route::get('pinjamruangstaf', [AdminJurusanController::class, 'viewPinjamruangstaf']);
	
    // Route::get('ruangkuliah', [AllAboutJadwalController::class, 'index']);
    // Route::get('matakuliah', [AllAboutJadwalController::class, 'matakuliah']);
    // Route::get('dosenpengampu', [AllAboutJadwalController::class, 'dosenpengampu']);
    // Route::get('plotingjadwal', [AllAboutJadwalController::class, 'plotingjadwal']);
	// Route::get('uploadjadwal', [AllAboutJadwalController::class, 'uploadjadwal']);
    // Route::get('presensidosen', [AllAboutJadwalController::class, 'presensidosen']);
    // Route::get('settingjadwal', [AllAboutJadwalController::class, 'settingjadwal']);
	// Route::get('vjadharian', [AllAboutJadwalController::class, 'vjadharian']);
	// Route::get('jadwalsiakad', [AllAboutJadwalController::class, 'jadwalsiakad']);
	// Route::get('vjadangkatan', [AllAboutJadwalController::class, 'vjadangkatan']);
	// Route::get('vjaddosen', [AllAboutJadwalController::class, 'vjaddosen']);
	// Route::get('vjadmatakuliah', [AllAboutJadwalController::class, 'vjadmatakuliah']);
	// Route::get('plotingjadwalujian', [AllAboutJadwalController::class, 'plotingjadwalujian']);
	// Route::get('presensipengawas', [AllAboutJadwalController::class, 'presensipengawas']);
	// Route::get('lemburtendik', [AllAboutJadwalController::class, 'viewLemburtendik']);
	// Route::get('jadwal/jsonruangkuliah', [AllAboutJadwalController::class, 'getruangkuliah']);
    // Route::get('jadwal/jsonmatakuliah', [AllAboutJadwalController::class, 'getmatakuliah']);
    // Route::get('jadwal/jsondosenpengampu', [AllAboutJadwalController::class, 'getdosenpengampu']);
    // Route::get('jadwal/jjamkuliah', [AllAboutJadwalController::class, 'jjamkuliah']);
	// Route::get('jadwal/jsemester', [AllAboutJadwalController::class, 'jsemester']);
	// Route::get('jadwal/jsonriwayatsyncjadwal', [AllAboutJadwalController::class, 'jsonRiwayatsyncjadwal']);
    // Route::post('jadwal/exmatkul', [AllAboutJadwalController::class, 'exmatkul'])->name('exmatkul');
    // Route::post('jadwal/exdosenpengampu', [AllAboutJadwalController::class, 'exdosenpengampu'])->name('exdosenpengampu');
    // Route::post('jadwal/jsonviewjadwal', [AllAboutJadwalController::class, 'jsonViewjadwal'])->name('jsonviewjadwal');
	// Route::post('jadwal/jsoncekjadwal', [AllAboutJadwalController::class, 'jsonCekjadwal'])->name('jsoncekjadwal');
    // Route::post('jadwal/jsonviewdetailjadwal', [AllAboutJadwalController::class, 'jsonviewDetailjadwal'])->name('jsonviewdetailjadwal');
	// Route::post('jadwal/exupdatewaktu', [AllAboutJadwalController::class, 'exupdateWaktu'])->name('exupdatewaktu');
    // Route::post('jadwal/exupdatejenis', [AllAboutJadwalController::class, 'exupdateJenis'])->name('exupdatejenis');
    // Route::post('jadwal/exupdatemateri', [AllAboutJadwalController::class, 'exupdateMateri'])->name('exupdatemateri');
    // Route::post('jadwal/exupdatedosen', [AllAboutJadwalController::class, 'exupdateDosen'])->name('exupdatedosen');
    // Route::post('jadwal/exupdatesemester', [AllAboutJadwalController::class, 'exupdateSemester'])->name('exupdateSemester');
    // Route::post('jadwal/cloningjadwal', [AllAboutJadwalController::class, 'exCloningJadwal'])->name('exCloningJadwal');
    // Route::post('jadwal/exaddmatkul', [AllAboutJadwalController::class, 'exaddMatkul'])->name('exaddmatkul');
    // Route::post('jadwal/exhapusjadwal', [AllAboutJadwalController::class, 'exhapusJadwal'])->name('exhapusjadwal');
    // Route::post('jadwal/exsetprodi', [AllAboutJadwalController::class, 'exsetProdi'])->name('exsetprodi');
    // Route::post('jadwal/exsetsemester', [AllAboutJadwalController::class, 'exsetSemester'])->name('exsetsemester');
	// Route::post('jadwal/exupdatejam', [AllAboutJadwalController::class, 'exupdateJam'])->name('exupdatejam');
	// Route::post('jadwal/exupdatewelcome', [AllAboutJadwalController::class, 'exupdateWelcome'])->name('exupdatewelcome');
	// Route::post('jadwal/exsetsemesteraktif', [AllAboutJadwalController::class, 'exsetsemesterAktif'])->name('exsetsemesteraktif');
	// Route::post('jadwal/jsonsiakad', [AllAboutJadwalController::class, 'jsonSiakad'])->name('jsonsiakad');
	// Route::post('jadwal/jsonskngajar', [AllAboutJadwalController::class, 'jsonSkngajar'])->name('jsonskngajar');
	// Route::post('jadwal/jsonjadwalujian', [AllAboutJadwalController::class, 'jsonjadwalUjian'])->name('jsonjadwalujian');
	// Route::post('jadwal/exupdatewaktuujian', [AllAboutJadwalController::class, 'exupdatewaktuUjian'])->name('exupdatewaktuujian');
	// Route::post('jadwal/jsonjadwalpengawas', [AllAboutJadwalController::class, 'jsonjadwalPengawas'])->name('jsonjadwalpengawas');
	// Route::post('jadwal/cetakpengawas', [AllAboutJadwalController::class, 'cetakPengawas'])->name('cetakpengawas');
	// Route::post('jadwal/exupdatepengawasujian', [AllAboutJadwalController::class, 'exupdatePengawasujian'])->name('exupdatepengawasujian');
	// Route::post('jadwal/jsonviewjadwaltersisa', [AllAboutJadwalController::class, 'jsonviewjadwalTersisa'])->name('jsonviewjadwaltersisa');
	// Route::post('jadwal/uploadfilesiakad', [AllAboutJadwalController::class, 'exFilesiakad'])->name('exFilesiakad');
    // Route::post('jadwal/exediteilesiakad', [AllAboutJadwalController::class, 'exeditFilesiakad'])->name('exeditFilesiakad');
	
	// Route::post('jadwal/datalemburan', [AllAboutJadwalController::class, 'jsonDatalemburan'])->name('jsonDatalemburan');
    // Route::post('jadwal/exupdlemburan', [AllAboutJadwalController::class, 'exUpdlemburan'])->name('exUpdlemburan');
    // Route::post('jadwal/dellemburan', [AllAboutJadwalController::class, 'exDellemburan'])->name('dellemburan');
    // Route::post('jadwal/ceklemburan', [AllAboutJadwalController::class, 'exReportlemburan'])->name('exReportlemburan');
    // Route::post('jadwal/exsetalldosen', [AllAboutJadwalController::class, 'exsetAlldosen'])->name('exsetAlldosen');
	// Route::post('jadwal/exsettemplate', [AllAboutJadwalController::class, 'exsetTemplate'])->name('exsetTemplate');
    
	
	// // LAYANAN MAHASISWA
    // Route::get('khs', [LayananMahasiswaController::class, 'viewKhs']);
    // Route::get('dashboardmhs', [LayananMahasiswaController::class, 'viewDashboardmhs']);
	
    // // LAYANAN AKADEMIK ->
	// Route::get('surat', [AdminAkademikController::class, 'viewSurat']);
	// Route::get('suratakademikkp', [AdminAkademikController::class, 'viewSuratKP']);
	// Route::get('arsipnilaiakad', [AdminAkademikController::class, 'viewNilaiakad']);
	// Route::get('surat/arsip', [AdminAkademikController::class, 'viewArsipsurat']);
    // Route::get('lapkrsmanual', [AdminAkademikController::class, 'viewLapkrsmanual']);
    // Route::get('laptranskrip', [AdminAkademikController::class, 'viewLapTranskrip']);
    // Route::get('skl', [AdminAkademikController::class, 'viewSkl']);
	// Route::get('surat/getlatesnomor', [AdminAkademikController::class, 'getLatesnomor'])->name('getLatesnomor');
	// Route::get('surat/getantriantranskrip', [AdminAkademikController::class, 'getantrianTranskrip'])->name('getantrianTranskrip');
	// Route::post('getlapanggotamagangvokasi', [AdminAkademikController::class, 'getLapAnggotamagangvokasi'])->name('getlapanggotamagangvokasi');
	// Route::post('getdbbynim', [AdminAkademikController::class, 'getdbbyNIM'])->name('getdbbyNIM');
	
    // Route::get('ecesp', [LayananMahasiswaController::class, 'viewEcesp']);
    // Route::get('daftarskl', [LayananMahasiswaController::class, 'viewDaftarSkl']);
    // Route::get('arsipijasahmhs', [LayananMahasiswaController::class, 'viewArsipIjasah']);
    // Route::get('smkpns', [LayananMahasiswaController::class, 'viewSmkpns']);
    // Route::get('smknon', [LayananMahasiswaController::class, 'viewSmknon']);
    // Route::get('smkterdaftar', [LayananMahasiswaController::class, 'viewSmkTerdaftar']);
    // Route::get('srtpenelitian', [LayananMahasiswaController::class, 'viewSrtpenelitian']);
    // Route::get('srtanalisislab', [LayananMahasiswaController::class, 'viewSrtanalisislab']);
    // Route::get('srtijinskripsi', [LayananMahasiswaController::class, 'viewSrtijinSkripsi']);
    // Route::get('srtpendalamanmateri', [LayananMahasiswaController::class, 'viewSrtpendalamanmateri']);
    // Route::get('srtobservasi', [LayananMahasiswaController::class, 'viewSrtobservasi']);
    // Route::get('srtijinpinjamalat', [LayananMahasiswaController::class, 'viewSrtijinpinjamalat']);
    // Route::get('srtpengambilandata', [LayananMahasiswaController::class, 'viewSrtpengambilandata']);
    // Route::get('susulan', [LayananMahasiswaController::class, 'viewSusulan']);
    // Route::get('transkrip', [LayananMahasiswaController::class, 'viewTranskrip']);
    // Route::get('cuti', [LayananMahasiswaController::class, 'viewCuti']);
    // Route::get('evaluasi', [LayananMahasiswaController::class, 'viewEvaluasi']);
    // Route::get('krssp', [LayananMahasiswaController::class, 'viewKrsSp']);
    // Route::get('krsmanual', [LayananMahasiswaController::class, 'viewKrsmanual']);
    // Route::get('peminatan', [LayananMahasiswaController::class, 'viewPeminatan']);
    // Route::get('goout', [LayananMahasiswaController::class, 'viewGoout']);
	// Route::get('lapnilaiakad', [LayananMahasiswaController::class, 'viewLapnilaiakad']);
	// Route::get('akadcontrol', [AdminKemahasiswaanController::class, 'viewControl']);
	// Route::post('akadcontrol/uploadnilai', [AdminKemahasiswaanController::class, 'uploadNilai'])->name('uploadnilai');
    // Route::post('akadcontrol/uploaddataajar', [AdminKemahasiswaanController::class, 'uploadDataajar'])->name('uploaddataajar');
    // Route::post('akadcontrol/uploadbimbingan', [AdminKemahasiswaanController::class, 'uploadBimbingan'])->name('uploadbimbingan');
    // Route::post('akadcontrol/uploadlulusan', [AdminKemahasiswaanController::class, 'uploadLulusan'])->name('uploadlulusan');
    // Route::post('akadcontrol/uploadmaba', [AdminKemahasiswaanController::class, 'uploadMaba'])->name('uploadmaba');
    // Route::post('akadcontrol/cekakademik', [AdminKemahasiswaanController::class, 'cekAkademik'])->name('cekakademik');
	// Route::post('akadcontrol/viewperangkatan', [AdminKemahasiswaanController::class, 'viewPerangkatan'])->name('viewperangkatan');
	// Route::post('akadcontrol/newmahasiswa', [AdminKemahasiswaanController::class, 'newMahasiswa'])->name('newmahasiswa');
	// Route::post('akadcontrol/arsipkannilai', [AdminAkademikController::class, 'arsipkaNnilai'])->name('arsipkaNnilai');
    // Route::post('akadcontrol/cariarsipnilaidetail', [AdminAkademikController::class, 'cariArsipnilaidetail'])->name('cariArsipnilaidetail');
    // Route::post('akadcontrol/lihatarsipnilai', [AdminAkademikController::class, 'lihatArsipnilai'])->name('lihatArsipnilai');
   
	// ///////////////UPLOADER////////////////////
	// Route::post('berkas/uploadberkas', [LayananMahasiswaController::class, 'uploadBerkas'])->name('uploadberkas');
	// Route::post('berkas/deleteberkasupload', [LayananMahasiswaController::class, 'deleteBerkasupload'])->name('deleteberkasupload');
	// Route::post('berkas/exuploadklinik', [LayananMahasiswaController::class, 'exUploadKlinik'])->name('exUploadKlinik');
	
	// ///////////////BIODATA////////////////////
	// Route::get('biodatamhs', [LayananMahasiswaController::class, 'viewBiodata']);
	// Route::get('biodatapasca', [LayananMahasiswaController::class, 'viewBiodatapasca']);
	// Route::get('biodatadoktoral', [LayananMahasiswaController::class, 'viewBiodatadoktor']);
    // Route::post('biodata/savebiodatamhs', [LayananMahasiswaController::class, 'saveBiodataMhs'])->name('savebiodatamhs');
    // Route::post('biodata/uploadphoto', [LayananMahasiswaController::class, 'uploadPhoto'])->name('uploadphoto');
    // Route::post('biodata/savelulusan', [LayananMahasiswaController::class, 'saveLulusan'])->name('savelulusan');
    // Route::post('bioodata/savenoakad', [LayananMahasiswaController::class, 'saveNoAkad'])->name('savenoakad');
    // Route::post('biodata/cetakbiodata', [LayananMahasiswaController::class, 'cetakBiodata'])->name('cetakbiodata');
	// Route::post('biodata/getbynim', [LayananMahasiswaController::class, 'getBynim'])->name('getbynim');
	// Route::post('goout/saveundur', [LayananMahasiswaController::class, 'saveUndur'])->name('saveundur');
    // Route::post('goout/cetakundurdiri', [LayananMahasiswaController::class, 'cetakUndur'])->name('cetakundurdiri');
	// Route::post('cetakpernyataan', [LayananMahasiswaController::class, 'cetakPernyataan'])->name('cetakpernyataan');
	
	// ///////////////PERSURATAN////////////////////
    // Route::post('khs/cetakkhs', [LayananMahasiswaController::class, 'cetakKhs'])->name('cetakkhs');
    // Route::get('daftarskl/getdataskpi', [LayananMahasiswaController::class, 'getDataSkpi'])->name('getdataskpi');
    // Route::get('daftarskl/datasyarat', [LayananMahasiswaController::class, 'dataSyarat'])->name('datasyarat');
    // Route::post('daftarskl/daftar', [LayananMahasiswaController::class, 'daftarSkl'])->name('daftarskl');
    // Route::post('daftarskl/uploadberkasskl', [LayananMahasiswaController::class, 'uploadBerkasskl'])->name('uploadberkasskl');
    // Route::post('daftarskpi/delskpi', [LayananMahasiswaController::class, 'deleteSkpi'])->name('delskpi');
    // Route::post('daftarskpi/simpanskpi', [LayananMahasiswaController::class, 'simpanSkpi'])->name('simpanskpi');
    // Route::post('smkpns/simpansmkpns', [LayananMahasiswaController::class, 'simpanSmkpns'])->name('simpansmkpns');
    // Route::get('arsipijasahmhs/getarsip', [LayananMahasiswaController::class, 'getArsipijasah'])->name('getarsipijasah');
    // Route::post('arsipijasahmhs/uploadfile', [LayananMahasiswaController::class, 'uploadFile'])->name('uploadfile');
    // Route::post('arsipijasahmhs/deletearsipijasah', [LayananMahasiswaController::class, 'deletearsipijasah'])->name('deletearsipijasah');
    // Route::post('review/cancelmhs', [LayananMahasiswaController::class, 'cancelMhs'])->name('cancelmhs');
    // Route::post('susulan/savesusulan', [LayananMahasiswaController::class, 'saveSusulan'])->name('savesusulan');
    // Route::post('transkrip/savetranskrip', [LayananMahasiswaController::class, 'saveTranskrip'])->name('savetranskrip');
    // Route::post('transkrip/savetranssemhas', [LayananMahasiswaController::class, 'saveTransSemhas'])->name('savetranssemhas');
    // Route::post('srtpenelitian/savepenelitianmhs', [LayananMahasiswaController::class, 'savePenelitianMhs'])->name('savepenelitianmhs');
    // Route::post('cuti/savecuti', [LayananMahasiswaController::class, 'saveCuti'])->name('savecuti');
    // Route::post('evaluasi/saveevaluasi', [LayananMahasiswaController::class, 'saveEvaluasi'])->name('saveevaluasi');
    // Route::get('krsmanual/getdatakrsmanual', [LayananMahasiswaController::class, 'getDataKrsManual'])->name('getdatakrsmanual');
    // Route::post('krsmanual/savekrsmanual', [LayananMahasiswaController::class, 'saveKrsManual'])->name('savekrsmanual');
    // Route::post('krsmanual/cetakkrsmanual', [LayananMahasiswaController::class, 'cetakKrsManual'])->name('cetakkrsmanual');
    // Route::post('krsmanual/hapuskrsmanual', [LayananMahasiswaController::class, 'deleteKrsManual'])->name('deletekrsmanual');
    // Route::get('krssp/getdatakrssp', [LayananMahasiswaController::class, 'getDataKrsSp'])->name('getdatakrssp');
    // Route::post('krssp/addmatkulsp', [LayananMahasiswaController::class, 'addMatkulSp'])->name('addmatkulsp');
    // Route::post('krssp/deletekrssp', [LayananMahasiswaController::class, 'deleteKrsSp'])->name('deletekrssp');
    // Route::post('krssp/cetakkrssp', [LayananMahasiswaController::class, 'cetakKrsSp'])->name('cetakkrssp');
    // Route::post('smknon/savesmknon', [LayananMahasiswaController::class, 'saveSmknon'])->name('savesmknon');
    // Route::post('surat/savependalamanmateri', [LayananMahasiswaController::class, 'exPendalamanmateri'])->name('exPendalamanmateri');
    // Route::post('surat/bebaspinjam', [LayananMahasiswaController::class, 'exBebaspinjam'])->name('exBebaspinjam');
    
    // ///////////////ASISTEN////////////////////
	// Route::get('asisten', [LayananMahasiswaController::class, 'viewAsisten']);
	// Route::get('labse', [LayananMahasiswaController::class, 'viewLabse']);
    // Route::get('asisten/getlistpendasisten', [LayananMahasiswaController::class, 'getListPendasisten'])->name('getlistpendasisten');
    // Route::post('asisten/daftarasisten', [LayananMahasiswaController::class, 'daftarAsisten'])->name('daftarasisten');

    // // ADMIN JURUSAN
	// /////////////////LOGBOOK MENUJU UJIAN AKHIR////////////////////////
	// Route::get('formbebaspinjam', [LayananMahasiswaController::class, 'viewFormbebaspinjam']);
    // Route::get('logbookskripsi', [LayananMahasiswaController::class, 'viewLogbookskripsi']);
    // Route::get('logbookskripsi/getlogskripsi', [LayananMahasiswaController::class, 'getLogSkripsimhs'])->name('getlogskripsimhs');
    // Route::post('logbookskripsi/saverincianskripsi', [LayananMahasiswaController::class, 'saveRincianSkripsi'])->name('saverincianskripsi');
    
    // Route::get('rekapdosenujian', [AdminJurusanController::class, 'viewRekapdosenujian']);
	// Route::post('laporanujian/getlapalljenis', [AdminJurusanController::class, 'getlapAlljenis'])->name('getlapalljenis');
	// Route::post('laporanujian/getalltranskripdata', [AdminJurusanController::class, 'getallTranskripdata'])->name('getalltranskripdata');
	// Route::post('laporanujian/extranskrip', [AdminJurusanController::class, 'exTranskrip'])->name('extranskrip');
	// ///////////////MAGANG////////////////////
	// Route::get('laporandmagang', [AdminJurusanController::class, 'viewPendosenmagang']);
	// Route::get('laporanmagang', [AdminJurusanController::class, 'viewLaporanmagang']);
	// Route::get('ujianmagang', [LayananMahasiswaController::class, 'ujianMagang']);
	// Route::get('lapujianmagang', [AdminJurusanController::class, 'lapUjianmagang']);
	// Route::get('magang', [LayananMahasiswaController::class, 'viewMagang']);
	// Route::get('logbook', [LayananMahasiswaController::class, 'viewLogbook']);
	// Route::get('daftarmagangkhusus', [AdminJurusanController::class, 'viewDaftarmagangkhusus']);
    // Route::get('settingtempatmagang', [AdminJurusanController::class, 'viewSettingtempatmagang']);
    // Route::get('settingtempatmagang/gettempatmagang', [AdminJurusanController::class, 'getTempatmagang'])->name('gettempatmagang');
	// Route::get('magang/getstatusmagang', [LayananMahasiswaController::class, 'getStatusmagang'])->name('getstatusmagang');
	// Route::get('laporanmagang/getlapujianmagangmhs', [AdminJurusanController::class, 'getlapujianMagangmhs'])->name('getlapujianmagangmhs');
	// Route::post('magang/getbutuhdosenmagang', [AdminJurusanController::class, 'getbutuhDosenmagang'])->name('getbutuhDosenmagang');
	// Route::post('settingtempatmagang/getketuamagang', [AdminJurusanController::class, 'getKetuamagang'])->name('getketuamagang');
    // Route::post('magang/exverifikasidosenmagang', [AdminJurusanController::class, 'exVerifikasidosenmagang'])->name('exVerifikasidosenmagang');
    // Route::post('magang/exubahstatuslayanan', [AdminJurusanController::class, 'exUbahstatuslayanan'])->name('exUbahstatuslayanan');
    // Route::post('laporanmagang/getlapujianmagan', [AdminJurusanController::class, 'getlapUjianmagan'])->name('getlapujianmagan');
    // Route::post('laporanmagang/getanggotamagang', [AdminJurusanController::class, 'getAnggotamagang'])->name('getanggotamagang');
    // Route::post('magang/gettempatmagangmhs', [LayananMahasiswaController::class, 'getTempatMagangmhs'])->name('gettempatmagangmhs');
    // Route::post('magang/savemagang', [LayananMahasiswaController::class, 'saveMagang'])->name('savemagang');
    // Route::post('magang/cetakpenentuan', [LayananMahasiswaController::class, 'cetakPenentuan'])->name('cetakpenentuan');
    // Route::post('magang/cetakdaftarmagang', [LayananMahasiswaController::class, 'cetakDaftarMagang'])->name('cetakdaftarmagang');
    // Route::post('magang/cetakevaluasiMagang', [LayananMahasiswaController::class, 'cetakEvaluasiMagang'])->name('cetakevaluasimagang');
	// Route::post('magang/deleteanggotamagang', [LayananMahasiswaController::class, 'deleteAnggotamagang'])->name('deleteanggotamagang');
	// Route::post('magang/tambahanggotamagang', [LayananMahasiswaController::class, 'tambahAnggotamagang'])->name('tambahanggotamagang');
	// Route::post('settingtempatmagang/extambahtempat', [AdminJurusanController::class, 'exTambahtempat'])->name('extambahtempat');
    // Route::post('settingtempatmagang/exubahtempat', [AdminJurusanController::class, 'exUbahtempat'])->name('exubahtempat');
    // Route::post('settingtempatmagang/exubahtahunmagang', [AdminJurusanController::class, 'exUbahtahunmagang'])->name('exubahtahunmagang');
    // Route::post('daftarmagangkhusus/carimhsvianim', [AdminJurusanController::class, 'cariMhsvianim'])->name('carimhsvianim');
    // Route::post('daftarmagangkhusus/savemagangadmin', [AdminJurusanController::class, 'saveMagangadmin'])->name('savemagangadmin');
    // Route::post('daftarmagangkhusus/cetakpenentuan', [AdminJurusanController::class, 'cetakAdminpenentuan'])->name('cetakadminpenentuan');
    // Route::post('daftarmagangkhusus/cetakadmindaftarmagang', [AdminJurusanController::class, 'cetakAdmindaftarmagang'])->name('cetakadmindaftarmagang');
	// Route::post('magang/cetakformmagang', [LayananMahasiswaController::class, 'cetakFormmagang'])->name('cetakformmagang');
	
	// Route::post('laporanmagang/rekapanmagang', [AdminJurusanController::class, 'rekapanMagang'])->name('rekapanmagang');
    // Route::post('laporanmagang/cetaksuratmagang', [AdminJurusanController::class, 'cetakSuratmagang'])->name('cetaksuratmagang');
	// Route::post('logbook/savekegiatan', [LayananMahasiswaController::class, 'saveKegiatan'])->name('savekegiatan');
    // Route::post('logbook/cetakkartupresensimagang', [LayananMahasiswaController::class, 'cetakKartuPresensiMagang'])->name('cetakkartupresensimagang');
	// Route::post('tahapan/cetak', [PascasarjanaController::class, 'exCtkBerkasdanabsen'])->name('cetakberkasdanabsen');
	
	// ///////////////PENGAJUAN JUDUL////////////////////
	// Route::get('judul', [PascasarjanaController::class, 'viewJudul']);
	// Route::post('pengajuanjudul/getlapjudulmhs', [PascasarjanaController::class, 'getlapJudulmhs'])->name('getlapjudulmhs');
	// Route::get('pengajuanjudul/getlisttopik', [PascasarjanaController::class, 'getlistTopik'])->name('getlistTopik');
	// Route::post('pengajuanjudul/getlapjudul', [PascasarjanaController::class, 'getlapJudul'])->name('getlapjudul');
	// Route::post('pengajuanjudul/getlaparsipjudul', [PascasarjanaController::class, 'getlaparsipJudul'])->name('getlaparsipjudul');
    // Route::post('pengajuanjudul/exverifikasijudul', [PascasarjanaController::class, 'exVerifikasijudul'])->name('exverifikasijudul');
	// Route::post('pengajuanjudul/exaddnewjudul', [PascasarjanaController::class, 'exaddNewjudul'])->name('exaddnewjudul');
	
	// /////////////////SEMPRO////////////////////////
	// Route::get('sempro', [PascasarjanaController::class, 'viewSempro']);
	// Route::get('sempro/getdataanggotasempromhs', [PascasarjanaController::class, 'getDataanggotasempromhs'])->name('getdataanggotasempromhs');
    // Route::post('laporansempro/getlapsempromhs', [PascasarjanaController::class, 'getLapsempromhs'])->name('getlapsempromhs');
    // Route::post('sempro/saveproposal', [PascasarjanaController::class, 'saveProposal'])->name('saveproposal');
    // Route::post('sempro/cetak', [PascasarjanaController::class, 'cetakSempromhs'])->name('cetaksempromhs');
	// Route::post('sempro/saveanggotasempro', [PascasarjanaController::class, 'saveAnggotasempro'])->name('saveanggotasempro');
    // Route::post('laporansempro/munculkanarsip', [PascasarjanaController::class, 'munculkanArsip'])->name('munculkanarsip');
    // Route::post('laporansempro/getlapsempro', [PascasarjanaController::class, 'getLapsempro'])->name('getlapsempro');
	
    // /////////////////SEMHAS////////////////////////
	// Route::get('semhas', [PascasarjanaController::class, 'viewSemhas']);
	// Route::get('laporansemhas', [PascasarjanaController::class, 'viewLaporansemhas']);
	// Route::get('semhas/getlaphasilmhs', [PascasarjanaController::class, 'getlapHasilmhs'])->name('getlapHasilmhs');
	
	// /////////////////UJIAN/////////////////////////
	// Route::get('ujian', [PascasarjanaController::class, 'viewUjian']);
	// Route::get('laporanujian/getlapujianmhs', [PascasarjanaController::class, 'getlapUjianmhs'])->name('getlapujianmhs');
    // Route::get('laporanujian/getlistdosen', [PascasarjanaController::class, 'getListdosen'])->name('getlistdosen');
    // Route::post('laporanujian/savedataujian', [PascasarjanaController::class, 'saveDataujian'])->name('savedataujian');
    // Route::post('laporanujian/batalujian', [PascasarjanaController::class, 'batalUjian'])->name('batalujian');
    // Route::post('laporanujian/arsipujian', [PascasarjanaController::class, 'arsipUjian'])->name('arsipujian');
    
	// //////////////////YUDISIUM/////////////////////////
	// Route::get('yudisium', [PascasarjanaController::class, 'viewYudisiums3']);
    // Route::get('laporanyudisium', [PascasarjanaController::class, 'viewLaporanyudisium']);
	// Route::post('laporanyudisium/getlistyudisium', [PascasarjanaController::class, 'getListyudisium'])->name('getlistyudisium');
    // Route::post('yudisium/daftar', [PascasarjanaController::class, 'daftarYudisium'])->name('daftaryudisium');
	// Route::post('yudisium/batalyudisium', [PascasarjanaController::class, 'batalYudisium'])->name('batalyudisium');
	// Route::post('laporanyudisium/getdetail', [PascasarjanaController::class, 'getDetailyudisium'])->name('getdetailyudisium');
    // Route::post('laporanyudisium/addyudisium', [PascasarjanaController::class, 'addYudisium'])->name('addyudisium');
    // Route::post('laporanyudisium/updateyudisium', [PascasarjanaController::class, 'updateYudisium'])->name('updateyudisium');
    // Route::post('laporanyudisium/deleteyudisium', [PascasarjanaController::class, 'deleteYudisium'])->name('deleteyudisium');
	// Route::post('laporanyudisium/exkirimyudisium', [PascasarjanaController::class, 'exkirimYudisium'])->name('exkirimyudisium');
	// Route::post('laporanyudisium/getsuratyudisium', [PascasarjanaController::class, 'getSuratYudisium'])->name('getSuratYudisium');
	
	// ////////////////// S3 /////////////////////////
	// Route::get('s3pengajuanpromotor', [PascasarjanaController::class, 'viewPengajuanpromotor']);
	// Route::get('s3ujianevaluasi', [PascasarjanaController::class, 'viewUjianevaluasi']);
	// Route::get('s3sidangkomisi', [PascasarjanaController::class, 'viewSidangkomisi']);
	// Route::get('s3ujiankualifikasi', [PascasarjanaController::class, 'viewUjiankualifikasi']);
	// Route::get('s3sidangkomhas', [PascasarjanaController::class, 'viewSidangkomhas']);
	// Route::get('s3sempeng', [PascasarjanaController::class, 'viewSidangPengajuan']);
	// Route::get('s3publikasi', [PascasarjanaController::class, 'viewPenilaianPublikasi']);
	// Route::get('s3seminter', [PascasarjanaController::class, 'viewSidangSemInter']);
	// Route::get('s3semhas', [PascasarjanaController::class, 'viewSemhass3']);
	// Route::get('s3kelayakanuad', [PascasarjanaController::class, 'viewKelayakanuad']);
	// Route::get('s3uad', [PascasarjanaController::class, 'viewUad']);
	// Route::get('s3kompengesahan', [PascasarjanaController::class, 'viewKompengesahan']);
	// Route::get('s3kemajuan2', [PascasarjanaController::class, 'viewKemajuan2']);
	// Route::get('s3yudisium', [PascasarjanaController::class, 'viewYudisiums3']);
	// Route::get('s3wisuda', [PascasarjanaController::class, 'viewWisudas3']);
	// Route::get('publikasijurnal', [PascasarjanaController::class, 'viewPublikasijurnal']);
	// Route::get('penelitiantesis', [PascasarjanaController::class, 'viewPenelitianTesis']);
	// Route::get('penulisantesis', [PascasarjanaController::class, 'viewPenulisanTesis']);
	// Route::post('doktor/getberkasdoktor', [PascasarjanaController::class, 'getBerkasdoktor'])->name('getberkasdoktor');
	// Route::post('doktor/exdoktoral', [PascasarjanaController::class, 'exDoktoral'])->name('exdoktoral');
	// Route::post('doktor/getberkascetakdoktor', [PascasarjanaController::class, 'getberkasCetakdoktor'])->name('getberkasCetakdoktor');
    // Route::post('doktor/getpengumumantahapan', [PascasarjanaController::class, 'getPengumumanTahapan'])->name('getPengumumanTahapan');
    // Route::post('doktor/expengumumantahapan', [PascasarjanaController::class, 'exPengumumanTahapan'])->name('exPengumumanTahapan');
	
    // // ACTION ADMIN AKADEMIK
    // Route::get('surat/getsurat', [AdminAkademikController::class, 'getSurat'])->name('getsurat');
	// Route::get('surat/getsuratpimpinan', [AdminAkademikController::class, 'getsuratPimpinan'])->name('getsuratpimpinan');
	// Route::get('surat/getsurattanpanomor', [AdminAkademikController::class, 'getsuratTanpanomor'])->name('getsurattanpanomor');
    // Route::get('surat/getsurattanpanomorpaged', [AdminAkademikController::class, 'getsuratTanpanomorPaged'])->name('getsuratTanpanomorPaged');
    // Route::get('surat/arsip/getarsipsurat', [AdminAkademikController::class, 'getArsipsurat'])->name('getarsipsurat');
    // Route::post('surat/cetakakademik', [AdminAkademikController::class, 'cetakAkademik'])->name('cetakakademik');
    // Route::post('surat/cetakgennomorsrt', [AdminAkademikController::class, 'cetakGennomorsrt'])->name('cetakgennomorsrt');
    // Route::post('surat/arsip/cetakarsipakademik', [AdminAkademikController::class, 'cetakArsipakademik'])->name('cetakarsipakademik');
    // Route::post('surat/cetakmankhs', [AdminAkademikController::class, 'cetakMankhs'])->name('cetakmankhs');
    // Route::post('surat/cetakmankhsen', [AdminAkademikController::class, 'cetakMankhsen'])->name('cetakmankhsen');
    // Route::post('surat/cetakkhsbilingual', [AdminAkademikController::class, 'cetakKhsbilingual'])->name('cetakkhsbilingual');
    // Route::post('surat/tambahkodesurat', [AdminAkademikController::class, 'tambahKodesurat'])->name('tambahkodesurat');
	// Route::post('surat/editorsurat', [AdminAkademikController::class, 'editorSurat'])->name('editorsurat');
	// Route::post('surat/exttdpimpinan', [AdminAkademikController::class, 'exttdPimpinan'])->name('exttdpimpinan');
	// Route::post('surat/detailtanggungansurat', [AdminAkademikController::class, 'detailTanggungansurat'])->name('detailtanggungansurat');

    // Route::post('lapkrsmanual/getdatakrsmanualmhs', [AdminAkademikController::class, 'getDatakrsmanualmhs'])->name('getdatakrsmanualmhs');
    // Route::post('lapkrsmanual/cetakviewkrsmanual', [AdminAkademikController::class, 'cetakViewkrsmanual'])->name('cetakviewkrsmanual');
    // Route::post('lapkrsmanual/verifikasikrsmanual', [AdminAkademikController::class, 'verifikasiKrsmanual'])->name('verifikasikrsmanual');
    
    // Route::get('skl/getskl', [AdminAkademikController::class, 'getSkl'])->name('getskl');
    // Route::post('skl/cetakviewbiodata', [AdminAkademikController::class, 'cetakViewbiodata'])->name('cetakviewbiodata');
    // Route::post('skl/cetakmodelsky', [AdminAkademikController::class, 'cetakModelsky'])->name('cetakmodelsky');
    // Route::post('skl/kuncidata', [AdminAkademikController::class, 'kunciData'])->name('kuncidata');
    // Route::post('skl/cetaksklakademik', [AdminAkademikController::class, 'cetakSklakademik'])->name('cetaksklakademik');
    // Route::post('skl/saveeditor', [AdminAkademikController::class, 'saveEditor'])->name('saveeditor');
    // Route::post('skl/saveexarsipiskl', [AdminAkademikController::class, 'saveExarsipiskl'])->name('saveexarsipiskl');
    // Route::post('skl/cetakpernyataan', [AdminAkademikController::class, 'cetakPernyataan'])->name('cetakPernyataan');
    // Route::post('skl/ctkskl', [AdminAkademikController::class, 'ctkSKL'])->name('ctkSKL');
	// Route::post('skl/datasyaratcari', [AdminAkademikController::class, 'dataSyaratcari'])->name('dataSyaratcari');
	// Route::post('skl/getreportyudisium', [AdminAkademikController::class, 'getReportYudisium'])->name('getReportYudisium');
    // Route::post('skl/cetakmodel-u10', [AdminAkademikController::class, 'cetakModelu10'])->name('cetakmodelu10');
	// Route::post('surat/getantrianarray', [AdminAkademikController::class, 'exAntrianarray'])->name('exAntrianarray');

    // // ACTION ADMIN JURUSAN
	// Route::get('ruangujian', [AdminJurusanController::class, 'viewRuangujian']);
    // Route::get('ruangujian/getruangujian', [AdminJurusanController::class, 'getRuangujian'])->name('getruangujian');
    // Route::post('ruangujian/create', [AdminJurusanController::class, 'createRuangujian'])->name('createruangujian');
    // Route::post('ruangujian/update', [AdminJurusanController::class, 'updateRuangujian'])->name('updateruangujian');
    // Route::post('ruangujian/delete', [AdminJurusanController::class, 'deleteRuangujian'])->name('deleteruangujian');
	
    
    // Route::post('ruangseminar/exdataruangseminar', [AdminJurusanController::class, 'exDataruangseminar'])->name('exdataruangseminar');
    // Route::get('ruangseminar/getruangseminar', [AdminJurusanController::class, 'getRuangseminar'])->name('getruangseminar');
    // Route::post('ruangseminar/exhapusruangseminar', [AdminJurusanController::class, 'exHapusruangseminar'])->name('exhapusruangseminar');

    // Route::get('pinjamruangstaf/getdatapesanan', [AdminJurusanController::class, 'getDatapesanan'])->name('getdatapesanan');
    // Route::post('pinjamruangstaf/setpesanruang', [AdminJurusanController::class, 'setPesanruang'])->name('setpesanruang');
    // Route::post('pinjamruangstaf/deleterapat', [AdminJurusanController::class, 'deleteRapat'])->name('deleterapat');

    
    // Route::post('rekapdosenujian/getrekapdosenujian', [AdminJurusanController::class, 'getRekapdosenujian'])->name('getrekapdosenujian');
    
    // Route::get('lapasisten', [AdminJurusanController::class, 'viewLapasisten']);
	// Route::get('lapasisten/getsetpendasisten', [AdminJurusanController::class, 'getSetpendasisten'])->name('getsetpendasisten');
    // Route::get('lapasisten/getjpendaftarasistenkpm', [AdminJurusanController::class, 'getJpendaftarasistenkpm'])->name('getjpendaftarasistenkpm');
    
    // /////////////////TRANSKRIP NON AKADEMIK////////////////////////
	
	// Route::get('transkripnonakademik', [AdminKemahasiswaanController::class, 'viewTranskripnonakad']);  

	// /////////////////BEASISWA////////////////////////
	// Route::post('beasiswa/savebeasiswa', [LayananMahasiswaController::class, 'saveBeasiswa'])->name('savebeasiswa');
	// Route::get('beasiswa', [LayananMahasiswaController::class, 'viewBeasiswa']);    
    // Route::get('databeasiswa', [AdminKemahasiswaanController::class, 'viewDatabeasiswa']);
    // Route::post('beasiswa/upload', [AdminKemahasiswaanController::class, 'uploadFilebeasiswa'])->name('uploadfilebeasiswa');
	// Route::post('beasiswa/cekfile', [LayananMahasiswaController::class, 'cekFile'])->name('cekfile');
    // Route::post('databeasiswa/getdatabeasiswa', [AdminKemahasiswaanController::class, 'getDatabeasiswa'])->name('getdatabeasiswa');
    // Route::post('databeasiswa/addimage', [AdminKemahasiswaanController::class, 'addImagebeasiswa'])->name('addimagebeasiswa');
    // /////////////////PRESTASI////////////////////////
	// Route::get('dataprestasi', [AdminKemahasiswaanController::class, 'viewDataprestasi']);
    // Route::post('prestasi/upload', [AdminKemahasiswaanController::class, 'uploadFileprestasi'])->name('uploadfileprestasi');
    // Route::post('dataprestasi/getdataprestasi', [AdminKemahasiswaanController::class, 'getDataprestasi'])->name('getdataprestasi');
	// Route::get('prestasi', [LayananMahasiswaController::class, 'viewPrestasi']);
    // Route::post('prestasi/saveprestasi', [LayananMahasiswaController::class, 'savePrestasi'])->name('saveprestasi');
    // /////////////////E-LPJ////////////////////////
    // Route::get('rekomendasi', [LayananMahasiswaController::class, 'viewRekomendasi']);
    // Route::get('getdataukm', [AdminKemahasiswaanController::class, 'getdataUkm']);
	// Route::get('tugas', [LayananMahasiswaController::class, 'viewTugas']);
	// Route::get('kegiatan', [LayananMahasiswaController::class, 'viewKegiatan']);
	// Route::get('datakegiatan', [AdminKemahasiswaanController::class, 'viewdataKegiatan']);
	// Route::get('dispenmhs', [LayananMahasiswaController::class, 'viewDispensasi']);
	// Route::get('sktmb', [LayananMahasiswaController::class, 'viewFormSKTMB']);
	// Route::get('peminatanmaba', [LayananMahasiswaController::class, 'viewPeminatanmaba']);
	// Route::get('ikutkegiatan', [LayananMahasiswaController::class, 'viewIkutkegiatan']);
	// Route::post('kegiatan/upload', [AdminKemahasiswaanController::class, 'uploadFilekegiatan'])->name('uploadfilekegiatan');
	// Route::post('datakegiatan/getdatakegiatanukm', [AdminKemahasiswaanController::class, 'getdataKegiatanukm'])->name('getdatakegiatanukm');
	// Route::post('datakegiatan/getdataspjkegiatan', [AdminKemahasiswaanController::class, 'getdataSpjkegiatan'])->name('getdataspjkegiatan');
	// Route::post('datakegiatan/delspjkegiatan', [AdminKemahasiswaanController::class, 'delspjKegiatan'])->name('delspjkegiatan');
	// Route::post('datakegiatan/savegambarspj', [AdminKemahasiswaanController::class, 'saveGambarspj'])->name('savegambarspj');
	// Route::post('datakegiatan/savelistukm', [AdminKemahasiswaanController::class, 'saveListukm'])->name('savelistukm');
	// Route::post('tugas/saverekomendasi', [LayananMahasiswaController::class, 'saveRekomendasi'])->name('saverekomendasi');
	// Route::post('kegiatan/saverekegiatanukm', [LayananMahasiswaController::class, 'savereKegiatanUkm'])->name('saverekegiatanukm');
	// Route::post('peminatanmaba/expeminatkmh', [LayananMahasiswaController::class, 'exPeminatkmh'])->name('exPeminatkmh');
	// Route::post('peminatanmaba/excetakminatkmh', [LayananMahasiswaController::class, 'exCetakminatkmh'])->name('exCetakminatkmh');
	// Route::post('peminatanmaba/exbatalminatkmh', [LayananMahasiswaController::class, 'exBatalminatkmh'])->name('exBatalminatkmh');
	// Route::get('peminatanmaba/jsonminatkmhpengalaman', [LayananMahasiswaController::class, 'jsonMinatkmhpengalaman'])->name('jsonMinatkmhpengalaman');
	// Route::get('peminatanmaba/jsonminatkmhprestasi', [LayananMahasiswaController::class, 'jsonMinatkmhprestasi'])->name('jsonMinatkmhprestasi');
	// Route::get('peminatanmaba/jsonminatkmhorganisasi', [LayananMahasiswaController::class, 'jsonMinatkmhorganisasi'])->name('jsonMinatkmhorganisasi');
	// Route::get('peminatanmaba/jsonminatkmh', [LayananMahasiswaController::class, 'jsonMinatkmh'])->name('jsonMinatkmh');
	// /////////////////TRACERSTUDI////////////////////////
    // Route::get('datatracerstudy', [AdminKemahasiswaanController::class, 'viewDatatracerstudy']);    
    // Route::post('datatracerstudy/getchartts1', [AdminKemahasiswaanController::class, 'getChartts1'])->name('getchartts1');
    // Route::post('datatracerstudy/getchartts2', [AdminKemahasiswaanController::class, 'getChartts2'])->name('getchartts2');
    // Route::post('datatracerstudy/getchartts3', [AdminKemahasiswaanController::class, 'getChartts3'])->name('getchartts3');
    // Route::post('datatracerstudy/getchartts4', [AdminKemahasiswaanController::class, 'getChartts4'])->name('getchartts4');
    // Route::get('datatracerstudy/gettracerstudy', [AdminKemahasiswaanController::class, 'getTracerstudy'])->name('gettracerstudy');
    // Route::post('datatracerstudy/tbltracestudi', [AdminKemahasiswaanController::class, 'tblTracestudi'])->name('tbltracestudi');
	// /////////////////PKM////////////////////////
	// Route::get('daftarpkm', [LayananMahasiswaController::class, 'viewDaftarpkm']);
    // Route::get('datapkm', [AdminKemahasiswaanController::class, 'viewDatapkm']);
	// Route::get('daftarpkm/getanggotapkm', [LayananMahasiswaController::class, 'getAnggotapkm'])->name('getanggotapkm');
    // Route::post('daftarpkm/tambahanggotapkm', [LayananMahasiswaController::class, 'tambahAnggotapkm'])->name('tambahanggotapkm');
    // Route::post('daftarpkm/tambahanggotapkmluar', [LayananMahasiswaController::class, 'tambahAnggotapkmluar'])->name('tambahanggotapkmluar');
    // Route::post('daftarpkm/simpandatapkm', [LayananMahasiswaController::class, 'simpanDatapkm'])->name('simpandatapkm');
    // Route::post('daftarpkm/batalpkm', [LayananMahasiswaController::class, 'batalPkm'])->name('batalpkm');
	// Route::post('kemahasiswaan/lappkm', [AdminKemahasiswaanController::class, 'tahunPkmcari'])->name('lappkm');
    // Route::post('datapkm/update', [AdminKemahasiswaanController::class, 'updateStatuspkm'])->name('updatestatuspkm');
    // Route::post('datapkm/upload', [AdminKemahasiswaanController::class, 'uploadFilepkm'])->name('uploadfilepkm');

    // Route::post('/fileupload', [LayananMahasiswaController::class, 'fileUpload'])->name('fileupload');
    // Route::post('surat/cetakkmh', [AdminKemahasiswaanController::class, 'cetakKmh'])->name('cetakkmh');
   
   
	// //SIMBHP
	// Route::get('simbhp', [SIMBHPController::class, 'index']);
	// Route::get('simbhp/rekapbhp', [SIMBHPController::class, 'jsonRekapbhp'])->name('jsonRekapbhp');
	// Route::post('simbhp/exaddbarang', [SIMBHPController::class, 'exAddbarang'])->name('exAddbarang');
	// Route::post('simbhp/reportbhp', [SIMBHPController::class, 'jsonReportbhp'])->name('jsonReportbhp');
	// Route::post('simbhp/kwitansi', [SIMBHPController::class, 'exKwitansi'])->name('exKwitansiSIMBHP');
	// Route::get('simbhp/reportbhppaginated', [SIMBHPController::class, 'jsonReportbhpPaginated'])->name('jsonReportbhpPaginated');
	// //Swakelola
	// Route::get('swakelola', [SwakelolaController::class, 'index']);
	// //Route::get('publikasijurnal', [SwakelolaController::class, 'viewPublikasijurnal'); tidak dipakai
	// Route::post('swakelola/jsonproposal', [SwakelolaController::class, 'jsonProposal'])->name('jsonProposal');
	// Route::post('swakelola/exswakelola', [SwakelolaController::class, 'exSwakelola'])->name('exSwakelola');
	// Route::post('swakelola/exdelswakelola', [SwakelolaController::class, 'exDelswakelola'])->name('exDelswakelola');
	// Route::post('swakelola/jsondoseninternal', [SwakelolaController::class, 'jsondosenInternal'])->name('jsondosenInternal');
	// Route::post('swakelola/jsondoseneksternal', [SwakelolaController::class, 'jsondosenEksternal'])->name('jsondosenEksternal');
	// Route::post('swakelola/jsonmahasiswa', [SwakelolaController::class, 'jsonMahasiswa'])->name('jsonMahasiswa');
	// Route::post('swakelola/jsontendik', [SwakelolaController::class, 'jsonTendik'])->name('jsonTendik');
	// Route::post('swakelola/jsonluaran', [SwakelolaController::class, 'jsonLuaran'])->name('jsonLuaran');
	// Route::post('swakelola/jsonanggaran', [SwakelolaController::class, 'jsonAnggaran'])->name('jsonAnggaran');
	// Route::post('swakelola/jsonjadwal', [SwakelolaController::class, 'jsonJadwalswakelola'])->name('jsonJadwalswakelola');
	// Route::post('swakelola/linimasa', [SwakelolaController::class, 'jsonLinimasa'])->name('jsonLinimasa');
	// Route::post('swakelola/jsonkelengkapan', [SwakelolaController::class, 'jsonKelengkapan'])->name('jsonKelengkapan');
	// Route::post('swakelola/jsondanamitra', [SwakelolaController::class, 'jsonDanamitra'])->name('jsonDanamitra');
	// Route::post('swakelola/jsondanatambahan', [SwakelolaController::class, 'jsondanaTambahan'])->name('jsondanaTambahan');
	// Route::post('swakelola/jsondokumen', [SwakelolaController::class, 'jsonDokumen'])->name('jsonDokumen');
	// Route::post('swakelola/exuploader', [SwakelolaController::class, 'exuploaderSwakelola'])->name('exuploaderSwakelola');
	// Route::post('swakelola/jsonatribut', [SwakelolaController::class, 'jsonAtribut'])->name('jsonAtribut');
	
	//SIMBA
	Route::get('viewbiodata/{id}', [SimbaController::class, 'viewRiwayat']);
	Route::get('analiskepegawaian/{id}', [SimbaController::class, 'getDataAnaliskepegawaian']);
	Route::get('setpendidikan/{id}', [SimbaController::class, 'getDataAkademik']);
	Route::get('setpenelitian/{id}', [SimbaController::class, 'getDatapenelitian']);
	Route::get('setpenngabdian/{id}', [SimbaController::class, 'getDatapengabdian']);
	Route::get('setpenunjang/{id}', [SimbaController::class, 'getDatapenunjangdosen']);
	Route::get('setpak/{id}', [SimbaController::class, 'getviewPAK']);
	Route::get('setbkd/{id}', [SimbaController::class, 'getviewBKD']);
	Route::get('cv/{id}', [SimbaController::class, 'viewCV']);

	Route::get('akademik', [SimbaController::class, 'inputDataAkademik']);
	Route::get('penelitian', [SimbaController::class, 'inputDatapenelitian']);
	Route::get('pengabdian', [SimbaController::class, 'inputDatapengabdian']);
	Route::get('penunjangdosen', [SimbaController::class, 'inputDatapenunjangdosen']);
	Route::get('keucontrol', [SimbaController::class, 'keuControl']);
	Route::get('bkd', [SimbaController::class, 'viewBKD']);
	Route::get('pak', [SimbaController::class, 'viewPAK']);
	Route::get('kategori12', [SimbaController::class, 'viewKategori12']);
	Route::get('kategori3', [SimbaController::class, 'viewKategori3']);
	Route::get('kategori4', [SimbaController::class, 'viewKategori4']);
	Route::get('kategori5', [SimbaController::class, 'viewKategori5']);
	Route::get('kategori6', [SimbaController::class, 'viewKategori6']);
	Route::get('kategori7', [SimbaController::class, 'viewKategori7']);
	Route::get('kategori8', [SimbaController::class, 'viewKategori8']);
	Route::get('kategori9', [SimbaController::class, 'viewKategori9']);
	Route::post('simba/reportjdosen', [SimbaController::class, 'reportJdosen'])->name('reportJdosen');
	Route::post('simba/exdatamasukan', [SimbaController::class, 'exDataMasukan'])->name('exDataMasukan');
	Route::post('simba/exdataserapan', [SimbaController::class, 'exdataSerapan'])->name('exdataSerapan');
	Route::post('simba/cekdataperolehan', [SimbaController::class, 'cekDataperolehan'])->name('cekDataperolehan');
	Route::post('simba/datajdetailpenerimaankeu', [SimbaController::class, 'dataJdetailpenerimaankeu'])->name('dataJdetailpenerimaankeu');
	Route::post('simba/cekdataserapan', [SimbaController::class, 'cekdataSerapan'])->name('cekdataSerapan');
	Route::post('simba/exverifikasikeg', [SimbaController::class, 'exVerifikasikeg'])->name('exVerifikasikeg');
	Route::post('simba/exverifikasimultikeg', [SimbaController::class, 'exVerifikasiMultikeg'])->name('exVerifikasiMultikeg');
	Route::post('simba/datadetaktifidosen', [SimbaController::class, 'datadetAktifidosen'])->name('datadetAktifidosen');
	Route::post('simba/exdatakegiatandosen', [SimbaController::class, 'exdataKegiatandosen'])->name('exdataKegiatandosen');
	
	Route::post('simba/destroyer', [SimbaController::class, 'exDestroyer'])->name('exDestroyer');
	Route::get('simba/jsondatapees', [SimbaController::class, 'jsonDatapees'])->name('jsonDatapees');
	Route::post('simba/golekdatakegiatandosen', [SimbaController::class, 'getDatakegiatandosen'])->name('getDatakegiatandosen');
	Route::post('simba/datadetaktifidosenthn', [SimbaController::class, 'jsonDatadetaktifidosen'])->name('jsonDatadetaktifidosen');
	Route::post('simba/datadetfileupload', [SimbaController::class, 'datadetFileupload'])->name('datadetFileupload');
	
	Route::post('simba/ctkpendidikan', [SimbaController::class, 'ctkPendidikan'])->name('ctkPendidikan');
	Route::post('simba/ctkpenelitian', [SimbaController::class, 'ctkPenelitian'])->name('ctkPenelitian');
	Route::post('simba/ctkpengabdian', [SimbaController::class, 'ctkPengabdian'])->name('ctkPengabdian');
	Route::post('simba/ctkpenunjang', [SimbaController::class, 'ctkPenunjang'])->name('ctkPenunjang');
	Route::post('simba/ctkmukaak', [SimbaController::class, 'ctkMukaak'])->name('ctkMukaak');
	Route::post('simba/rekapak', [SimbaController::class, 'ctkRekapak'])->name('ctkRekapak');
	Route::post('simba/exuploader', [SimbaController::class, 'exUploader'])->name('exUploader');
	Route::post('simba/exdataajardosen', [SimbaController::class, 'exDataajardosen'])->name('exDataajardosen');
	Route::post('simba/jsondatajdataajar', [SimbaController::class, 'jsonDatajdataajar'])->name('jsonDatajdataajar');
	Route::post('simba/exdatasertifikat', [SimbaController::class, 'exDatasertifikat'])->name('exDatasertifikat');
	Route::post('simba/jsondatajdatasertifikat', [SimbaController::class, 'jsondatajdataSertifikat'])->name('jsondatajdataSertifikat');
	Route::post('simba/exdataasesor', [SimbaController::class, 'exDataasesor'])->name('exDataasesor');
	Route::post('simba/jsondataasesor', [SimbaController::class, 'jsonDataasesor'])->name('jsonDataasesor');
	Route::post('simba/exdataorganisasi', [SimbaController::class, 'exDataorganisasi'])->name('exDataorganisasi');
	Route::post('simba/jsondataorganisasi', [SimbaController::class, 'jsonDataorganisasi'])->name('jsonDataorganisasi');
	Route::post('simba/exdataseminar', [SimbaController::class, 'exDataseminar'])->name('exDataseminar');
	Route::post('simba/jsondataseminar', [SimbaController::class, 'jsondataSeminar'])->name('jsondataSeminar');
	Route::post('simba/exdatakeluarga', [SimbaController::class, 'exDatakeluarga'])->name('exDatakeluarga');
	Route::post('simba/jsondatakeluarga', [SimbaController::class, 'jsonDatakeluarga'])->name('jsonDatakeluarga');
	Route::post('simba/exdatamutasi', [SimbaController::class, 'exdataMutasi'])->name('exdataMutasi');
	Route::post('simba/jsondatamutasi', [SimbaController::class, 'jsondataMutasi'])->name('jsondataMutasi');
	Route::post('simba/exdataidentitas', [SimbaController::class, 'exdataIdentitas'])->name('exdataIdentitas');
	Route::post('simba/jsondataidentitas', [SimbaController::class, 'jsondataIdentitas'])->name('jsondataIdentitas');
	Route::post('simba/exdatapendidikan', [SimbaController::class, 'exdataPendidikan'])->name('exdataPendidikan');
	Route::post('simba/jsondatapendidikan', [SimbaController::class, 'jsondatPpendidikan'])->name('jsondatPpendidikan');
	Route::post('simba/exdatapangkat', [SimbaController::class, 'exdataPangkat'])->name('exdataPangkat');
	Route::post('simba/jsondatapangkat', [SimbaController::class, 'jsondataPangkat'])->name('jsondataPangkat');
	Route::post('simba/exdatafungsional', [SimbaController::class, 'exdataFungsional'])->name('exdataFungsional');
	Route::post('simba/jsondatafungsional', [SimbaController::class, 'jsondataFungsional'])->name('jsondataFungsional');
	Route::post('simba/exdatasertifikasi', [SimbaController::class, 'exdataSertifikasi'])->name('exdataSertifikasi');
	Route::post('simba/jsondatasertifikasi', [SimbaController::class, 'jsondataSertifikasi'])->name('jsondataSertifikasi');
	Route::post('simba/exdatagaji', [SimbaController::class, 'exdataGaji'])->name('exdataGaji');
	Route::post('simba/jsondatagaji', [SimbaController::class, 'jsondtaGaji'])->name('jsondtaGaji');
	Route::post('simba/exdatadiklat', [SimbaController::class, 'exdataDiklat'])->name('exdataDiklat');
	Route::post('simba/jsondatadiklat', [SimbaController::class, 'jsondataDiklat'])->name('jsondataDiklat');
	Route::post('simba/exdatapenghargaan', [SimbaController::class, 'exdataPenghargaan'])->name('exdataPenghargaan');
	Route::post('simba/jsondatapenghargaan', [SimbaController::class, 'jsondataPenghargaan'])->name('jsondataPenghargaan');
	
	/////////////////FASILITAS PENDUKUNG////////////////////////
    Route::get('faspendukung', [SimbaController::class, 'viewFaspendukung']);    
    Route::get('penelitiasing', [SimbaController::class, 'viewPenelitiasing']);    
    Route::get('unitbisnis', [SimbaController::class, 'viewUnitbisnis']);    
    Route::post('simba/jsonfaspendukung', [SimbaController::class, 'jsonFaspendukung'])->name('jsonFaspendukung');
	Route::post('simba/jsonpeneliti', [SimbaController::class, 'jsonPeneliti'])->name('jsonPeneliti');
	Route::post('simba/jsonunitbisnis', [SimbaController::class, 'jsonUnitbisnis'])->name('jsonUnitbisnis');
	Route::post('simba/simpandatapeneliti', [SimbaController::class, 'exDatapeneliti'])->name('exDatapeneliti');
	Route::post('simba/simpanunitbisnis', [SimbaController::class, 'exUnitbisnis'])->name('exUnitbisnis');
	Route::post('simba/simpandatafaspendukung', [SimbaController::class, 'exDatafaspendukung'])->name('exDatafaspendukung');
	
	
	//KATEGORI 1 dan 2
	Route::post('simba/reportkat1', [SimbaController::class, 'ctkReportkat1'])->name('ctkReportkat1');
	Route::post('simba/exeditorpees', [SimbaController::class, 'exEditorpees'])->name('exEditorpees');
	Route::post('simba/uploadkontrakkerja', [SimbaController::class, 'uploadKontrakkerja'])->name('uploadKontrakkerja');
	Route::post('simba/exauditinternal', [SimbaController::class, 'exAuditinternal'])->name('exAuditinternal');
	Route::post('simba/exauditexternal', [SimbaController::class, 'exauditExternal'])->name('exauditExternal');
	Route::get('simba/jsonkontrakkerja', [SimbaController::class, 'jsonKontrakkerja'])->name('jsonKontrakkerja');
	Route::post('simba/jsonauditinternal', [SimbaController::class, 'jsonauditInternal'])->name('jsonauditInternal');
	Route::post('simba/jsonauditeksternal', [SimbaController::class, 'jsonauditEksternal'])->name('jsonauditEksternal');
	
	//DOSEN PENGUJI
	// Route::get('dosenpenguji', [DosenpengujiController::class, 'index']);
	// Route::get('datalistdosenpenguji', [DosenpengujiController::class, 'dataListdosenPenguji'])->name('dataListdosenPenguji');
	// Route::post('dosenpenguji/getpengdosenpenguji', [DosenpengujiController::class, 'getPengajuanDosPenguji'])->name('getPengajuanDosPenguji');
	// Route::post('dosenpenguji/exsetpengajuandospeng', [DosenpengujiController::class, 'exSetPengajuandospeng'])->name('exSetPengajuandospeng');
	
});

Route::group(['middleware' => 'project.udin'], function() {
	Route::get('portaludin', [RecruitmentController::class, 'viewPortalUjian'])->name('viewPortalUjian');
});
	
