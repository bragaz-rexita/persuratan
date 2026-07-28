@if(Session('id') !== null)
    @if(Session('previlage') == 'developer')
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardpimpinan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardpimpinan') }}">Dashboard Pimpinan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashbordsurat') }}">Dashboard Sekpim</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardagendaris') }}">Dashboard Agendaris</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'controlsekpim' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('controlsekpim') }}">Kontrol Sekpim</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'controltu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('controltu') }}">Kontrol TU</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'controlekspedisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('controlekspedisi') }}">Kontrol Sekpim</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Surat Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('notadinas') }}">Nota Dinas</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('disposisi') }}">Disposisi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('tandatangan') }}">Tanda Tangan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ekspedisi') }}">Ekspedisi Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratakademikkp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratakademikkp') }}"> Terminal Kuliah </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratlabklinik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratlabklinik') }}"> Surat Hasil Lab </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                            <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                            <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="simbantuanmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Bantuan Studi,Publikasi</a>
                    <ul aria-labelledby="simbantuanmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Admin Bantuan Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan Publikasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Penerima Dana Riset dan PKM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'bantuanuser' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanuser') }}">Bantuan Model User</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="diktendikmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">DIKTENDIK</a>
                    <ul aria-labelledby="diktendikmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">EWS UB</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('inpassinggaji') }}">Draft SK Penyesuain Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('udin') }}">Ujian Dinas</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('latsaradmin') }}">LATSAR</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skkontrak') }}">Draft SK Kontrak</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verifikatorkgb') }}">Verifikasi KGB</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verfikasicuti') }}/all">Cuti Pegawai</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dokarsetting') }}">Setting</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="simasetmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a>
                    <ul aria-labelledby="simasetmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="ecekmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">e-Cek</a>
                    <ul aria-labelledby="ecekmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'ecekadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ecekadmin') }}">E-Cek Admin</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ecekverfikasi') }}">E-Cek Verifikasi</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="simpropakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIMPRO-PAK</a>
                    <ul aria-labelledby="simpropakmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'simpukjadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjadmin') }}">Setting Layanan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simpukjapengajuan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjapengajuan') }}">Pengajuan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                    <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Pelaporan Deteksi Plagiasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">SIMBHP</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Swakelola</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AKADEMIK</a>
                            <ul aria-labelledby="sifakmenu01" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skl') }}">Laporan SKL</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapakadsp') }}">Pendaftaran SA</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pesertakelassa') }}">Peserta Kelas SA</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                    <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                    <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                    <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                            <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                    <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                    <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                    <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                            <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA</a>
                            <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                            <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu12" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan Jurusan</a>
                            <ul aria-labelledby="sifakmenu12" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="siakreditasi" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI Akreditasi</a>
                    <ul aria-labelledby="siakreditasi" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kegiatan</a>
                            <ul aria-labelledby="siakreditasi01" class="dropdown-menu border-0 shadow">
                                <li title="Data Akademik Lain" class="{{ isset($sidebar) && $sidebar == 'akademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akademik') }}">Pendidikan</a></li>
                                <li title="Data Penelitan dan Publikasi Ilmiah"  class="{{ isset($sidebar) && $sidebar == 'penelitian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitian') }}">Penelitian</a></li>
                                <li title="Data Pengabdian" class="{{ isset($sidebar) && $sidebar == 'pengabdian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengabdian') }}">PkM</a></li>
                                <li title="Data Penunjang, Luaran HAKI" class="{{ isset($sidebar) && $sidebar == 'penunjangdosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penunjangdosen') }}">Penunjang</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Penilaian</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'bkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bkd') }}">BKD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pak') }}">PAK</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'settingpakbkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpakbkd') }}">Setting Rubrik BKD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'settingbkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingbkd') }}">Setting Rubrik PAK</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tambahan</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Control Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Developer Menu</a>
            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('user') }}">Setting</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lembaga') }}">Setting Unit Kerja</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'developing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('developing') }}">Developemet</a></li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'admin')
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'user' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Account Management</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Setting Program Studi</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                @if(Session('fakultas') == 'FMIPA' OR Session('fakultas') == 'FP')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Surat Masuk </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="simasetmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a>
                        <ul aria-labelledby="simasetmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Pelaporan Deteksi Plagiasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">SIMBHP</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Swakelola</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AKADEMIK</a>
                                <ul aria-labelledby="sifakmenu01" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skl') }}">Laporan SKL</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapakadsp') }}">Pendaftaran SA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pesertakelassa') }}">Peserta Kelas SA</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                        <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                        <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                        <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                        <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                        <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                        <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                                <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu12" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan Jurusan</a>
                                <ul aria-labelledby="sifakmenu12" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="siakreditasi" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI Akreditasi</a>
                        <ul aria-labelledby="siakreditasi" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kegiatan</a>
                                <ul aria-labelledby="siakreditasi01" class="dropdown-menu border-0 shadow">
                                    <li title="Data Akademik Lain" class="{{ isset($sidebar) && $sidebar == 'akademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akademik') }}">Pendidikan</a></li>
                                    <li title="Data Penelitan dan Publikasi Ilmiah"  class="{{ isset($sidebar) && $sidebar == 'penelitian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitian') }}">Penelitian</a></li>
                                    <li title="Data Pengabdian" class="{{ isset($sidebar) && $sidebar == 'pengabdian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengabdian') }}">PkM</a></li>
                                    <li title="Data Penunjang, Luaran HAKI" class="{{ isset($sidebar) && $sidebar == 'penunjangdosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penunjangdosen') }}">Penunjang</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Penilaian</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'bkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bkd') }}">BKD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pak') }}">PAK</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'settingpakbkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpakbkd') }}">Setting Rubrik BKD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'settingbkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingbkd') }}">Setting Rubrik PAK</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tambahan</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Control Keuangan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @elseif (Session('fakultas') == 'PASCAUB')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">1. Pelayanan</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                        <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                        <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">2. Keuangan</a>
                        <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Gaji Pegawai</a>
                                <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                </ul>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">3. Beasiswa</a>
                        <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">4. Umum</a>
                        <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">5. Jurnal</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">6. Ruang Baca</a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">7. CAMABA</a>
                        <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">8. BPPM</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">9. GJM</a></li>
                @else
                @endif
            </ul>
        </li>
    @elseif(Session('previlage') == 'Sekretaris' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Akademik' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR Session('previlage') == 'Sekretaris Rektor' OR Session('previlage') == 'Sekretaris Dekan' OR Session('previlage') == 'Sekretaris WD I' OR Session('previlage') == 'Sekretaris WD II' OR Session('previlage') == 'Sekretaris WD III')
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bukutamuadmin') }}">Buku Tamu </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}"> Direktori Jabatan</a></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Surat Masuk </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardagendaris') }}"> Nomor Mundur / Maju </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}"> SK dan Peraturan </a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                            <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                            <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                    </ul>
                </li>
                @if (Session('fakultas') != 'KP')
                <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}"> SIMPRO-PAK</a></li>
                @endif
                <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
            </ul>
        </li>
        @if(Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Setting</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('user') }}">Setting</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lembaga') }}">Setting Unit Kerja</a></li>
                </ul>
            </li>
        @endif
    @elseif(Session('previlage') == 'Sekretaris Senat UB')
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Surat Masuk </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardagendaris') }}"> Nomor Surat Keluar </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bukutamuadmin') }}">Buku Tamu </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'Agendaris Umum' OR Session('previlage') == 'Agendaris')
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ekspedisi') }}">Ekpedisi Surat</a></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                                    <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                                    <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'Arsiparis Umum' OR Session('previlage') == 'Arsiparis')
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                            <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                            <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'settingsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingsurat') }}">Control Surat</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'Tata Usaha')
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ekspedisi') }}">Ekpedisi Surat</a></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Surat Masuk </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                            <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                            <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'Frontoffice' OR Session('previlage') == 'frontoffice')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('bukutamuadmin') }}" role="button"><i class="fa fa-book"></i> Buku Tamu</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'Sekretaris Ka.Biro Keuangan' OR Session('previlage') == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR Session('previlage') == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR Session('previlage') == 'Sekretaris Bagian Akutansi')
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bukutamuadmin') }}">Buku Tamu </a></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardagendaris') }}"> Nomor Surat Keluar </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    @elseif(Session('previlage') == 'PEJABAT')
        <li class="nav-item dropdown">
            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Persuratan</a>
            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                @if(Session('fakultas') == 'FKH' OR Session('fakultas') == 'FIKES')
                    <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
                @endif
                <li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('notadinas') }}">Nota Dinas</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'memo' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('memo') }}">Memo</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('disposisi') }}"> Disposisi</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('tandatangan') }}"> Permohonan Paraf/TTD</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
            </ul>
        </li>
        @if(Session('idjabatan') == '3')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Bantuan Studi/Publikasi/Riset</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Bantuan Biaya Studi Lanjut </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Bantuan Publikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Bantuan Riset </a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simprokja') }}">SIMPRO-KJA </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ecekverfikasi') }}">e-Cek </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Report </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="simasetmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a>
                        <ul aria-labelledby="simasetmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                        <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                        <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="diktendikmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">DIKTENDIK</a>
                        <ul aria-labelledby="diktendikmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">EWS UB</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verifikatorkgb') }}">Verifikasi KGB</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dokarsetting') }}">Setting</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Pelaporan Deteksi Plagiasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">SIMBHP</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Swakelola</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AKADEMIK</a>
                                <ul aria-labelledby="sifakmenu01" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skl') }}">Laporan SKL</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapakadsp') }}">Pendaftaran SA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pesertakelassa') }}">Peserta Kelas SA</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                        <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                        <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                        <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                        <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                        <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                        <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                                <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu12" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan Jurusan</a>
                                <ul aria-labelledby="sifakmenu12" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="siakreditasi" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI Akreditasi</a>
                        <ul aria-labelledby="siakreditasi" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kegiatan</a>
                                <ul aria-labelledby="siakreditasi01" class="dropdown-menu border-0 shadow">
                                    <li title="Data Akademik Lain" class="{{ isset($sidebar) && $sidebar == 'akademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akademik') }}">Pendidikan</a></li>
                                    <li title="Data Penelitan dan Publikasi Ilmiah"  class="{{ isset($sidebar) && $sidebar == 'penelitian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitian') }}">Penelitian</a></li>
                                    <li title="Data Pengabdian" class="{{ isset($sidebar) && $sidebar == 'pengabdian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengabdian') }}">PkM</a></li>
                                    <li title="Data Penunjang, Luaran HAKI" class="{{ isset($sidebar) && $sidebar == 'penunjangdosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penunjangdosen') }}">Penunjang</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Penilaian</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'bkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bkd') }}">BKD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pak') }}">PAK</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'settingpakbkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpakbkd') }}">Setting Rubrik BKD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'settingbkd' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingbkd') }}">Setting Rubrik PAK</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tambahan</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Control Keuangan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sapto 9 Kriteria</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lembaga') }}">Statistik Unit Kerja</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'developing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('developing') }}">Developemet</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '436')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simprokja') }}">SIMPRO-KJA </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '1' OR Session('idjabatan') == '2')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Bantuan Studi/Publikasi/Riset</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Bantuan Biaya Studi Lanjut </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Bantuan Publikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Bantuan Riset </a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simprokja') }}">SIMPRO-KJA </a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '35')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '8')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Bantuan Studi/Riset/Publikasi</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Bantuan Biaya Studi Lanjut </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Bantuan Publikasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Bantuan Riset </a></li>
                </ul>
            </li>
            <li class="nav-item d-none d-sm-inline-block {{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}"><a href="{{ url('ecekverfikasi') }}" class="dropdown-item">E-Cek</a></li>
        @endif
        @if(Session('idjabatan') == '15')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Bantuan Studi/Publikasi/Riset</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Bantuan Biaya Studi Lanjut </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Bantuan Publikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Bantuan Riset </a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIVOKASI</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Pelaporan Deteksi Plagiasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">SIMBHP</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                        <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                        <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                        <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                        <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana</a>
                                        <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item d-none d-sm-inline-block {{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}"><a href="{{ url('ecekverfikasi') }}" class="dropdown-item">E-Cek</a></li>
        @endif
        @if(Session('idjabatan') == '965')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                        <a id="simasetmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a>
                        <ul aria-labelledby="simasetmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '53')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Bantuan Studi/Riset/Publikasi</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Bantuan Biaya Studi Lanjut </a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Bantuan Publikasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Bantuan Riset </a></li>
                </ul>
            </li>
            <li class="nav-item d-none d-sm-inline-block {{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}"><a href="{{ url('ecekverfikasi') }}" class="dropdown-item">E-Cek</a></li>
        @endif
        @if(Session('idjabatan') == '63')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                        <a id="simasetmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a>
                        <ul aria-labelledby="simasetmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '64')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">Daftar Pejabat UB</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'controlsekpim' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('controlsekpim') }}">Kontrol Sekpim</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'controltu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('controltu') }}">Kontrol TU</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'controlekspedisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('controlekspedisi') }}">Kontrol Sekpim</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Surat Masuk</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                                <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                                <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                </ul>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                        </ul>
                    </li>
                    
                    <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '60')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsiparis Dinamis</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="arsipsubstantifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Substantif</a>
                                <ul aria-labelledby="arsipsubstantifmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="arsipfasilitatifmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Arsip Fasilitatif</a>
                                <ul aria-labelledby="arsipfasilitatifmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                </ul>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsippermanen') }}">Permanen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '1005')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('insurat') }}">Kontrol Surat Masuk</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardagendaris') }}">Kontrol Surat Keluar</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Kontrol Peraturan dan Keputusan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('notadinas') }}">Nota Dinas</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('disposisi') }}">Disposisi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('tandatangan') }}">Tanda Tangan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('statistik') }}">Statistik</a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '924' OR Session('idjabatan') == '833' OR Session('idjabatan') == '1024' OR Session('idjabatan') == '958'  OR Session('idjabatan') == '973')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '61' OR Session('idjabatan') == '65' OR Session('idjabatan') == '11' OR Session('idjabatan') == '970'  OR Session('idjabatan') == '973')
		    <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Direktorat SDM</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">Direktori Jabatan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Bantuan Biaya Studi Lanjut</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '10')
		    <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Direktorat SDM</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">Direktori Jabatan</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('fakultas') == 'FMIPA')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AKADEMIK</a>
                                <ul aria-labelledby="sifakmenu01" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skl') }}">Laporan SKL</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapakadsp') }}">Pendaftaran SA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pesertakelassa') }}">Peserta Kelas SA</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                        <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                        <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                        <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                        <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sarjana/Magister</a>
                                        <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                        <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                        @if(Session('jabatan') == 'Ketua Jurusan Biologi' OR Session('jabatan') == 'Sekretaris Jurusan Biologi' OR Session('jabatan') == 'Ketua Program Studi S1 Biologi' OR Session('jabatan') == 'Ketua Program Studi S2 Biologi' OR Session('jabatan') == 'Ketua Program Studi S3 Biologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Dasar' OR Session('jabatan') == 'Kepala Laboratorium Mikrobiologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Seluler dan Molekuler')
                                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        @else
                                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA Magister</a>
                                <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2biologi') }}"> Biologi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2fisika') }}"> Fisika</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2matematika') }}"> Matematika</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2kimia') }}"> Kimia</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2statistika') }}"> Statistika</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA Doktor</a>
                                <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3biologi') }}">Biologi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3fisika') }}">Fisika</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3matematika') }}">Matematika</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3kimia') }}">Kimia</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3statistika') }}">Statistika</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @if (Session('keljabatan') == 'KASUB KEPEG FAK' OR Session('keljabatan') == 'KASUB AKAD FAK' OR Session('keljabatan') == 'KASUB UMUM FAK' OR Session('keljabatan') == 'KASUB KEU FAK' OR Session('keljabatan') == 'KASUB UMUMKEU FAK' OR Session('keljabatan') == 'KASUB KEUKEPEG FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownpenghargaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Promosi</a>
                    <ul aria-labelledby="dropdownpenghargaan" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
            @endif
        @elseif(Session('fakultas') == 'PASCAUB')
            @if(Session('idjabatan') == '31' OR Session('idjabatan') == '577')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">1. Pelayanan</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Reg. CAMABA</a>
                                    <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">2. Keuangan</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Gaji Pegawai</a>
                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">3. Beasiswa</a>
                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">4. Umum</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">5. Jurnal</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">6. Ruang Baca</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">7. CAMABA</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">8. BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">9. GJM</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '573' OR Session('idjabatan') == '831')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Beasiswa</a>
                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Jurnal</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '703')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Gaji Pegawai</a>
                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Beasiswa</a>
                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Umum</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '575')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Gaji Pegawai</a>
                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Beasiswa</a>
                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Umum</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '576')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '577')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            
            
            @elseif(Session('idjabatan') == '578')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Jurnal</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '579')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
        @elseif (Session('fakultas') == 'FAPET' OR Session('fakultas') == 'FEB' OR Session('fakultas') == 'FH' OR Session('fakultas') == 'FIA' OR Session('fakultas') == 'FIB' OR Session('fakultas') == 'FIKES' OR Session('fakultas') == 'FILKOM' OR Session('fakultas') == 'FISIP' OR Session('fakultas') == 'FK' OR Session('fakultas') == 'FKG' OR Session('fakultas') == 'FKH' OR Session('fakultas') == 'FMIPA' OR Session('fakultas') == 'FP' OR Session('fakultas') == 'FPIK' OR Session('fakultas') == 'FT' OR Session('fakultas') == 'FTP' OR Session('fakultas') == 'FV' OR Session('fakultas') == 'PSDKUJAKARTA' OR Session('fakultas') == 'PSLKU')
            @if(Session('keljabatan') == 'KABAG FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenuakademik" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Akademik dan Kemahasiswaan</a>
                                            <ul aria-labelledby="sifakultasmenuakademik" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                                    <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                                            <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan Mahasiswa</a>
                                                    <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Persurat Mahasiswa</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                                            <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenukepegawaian" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kepegawaian</a>
                                            <ul aria-labelledby="sifakultasmenukepegawaian" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">EWS UB</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verfikasicuti') }}/all">Cuti Pegawai</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('listsurattugas') }}">Management Surat Tugas</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('user') }}">User Management</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenukeuangan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                                            <ul aria-labelledby="sifakultasmenukeuangan" class="dropdown-menu border-0 shadow">
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                                                    <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Data Akreditasi</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Umum</a>
                                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB AKAD FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenuakademik" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Akademik dan Kemahasiswaan</a>
                                            <ul aria-labelledby="sifakultasmenuakademik" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                                    <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                                            <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan Mahasiswa</a>
                                                    <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Persurat Mahasiswa</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                                            <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KAJUR')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenuakademik" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Akademik dan Kemahasiswaan</a>
                                            <ul aria-labelledby="sifakultasmenuakademik" class="dropdown-menu border-0 shadow">
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                                            <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="dropdown-submenu dropdown-hover">
                                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KPSS1')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                            <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sarjana</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Dosen Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KPSS2')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Tesis</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KPSS3')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB UMUM FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Umum</a>
                                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB KEU FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenukeuangan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                                            <ul aria-labelledby="sifakultasmenukeuangan" class="dropdown-menu border-0 shadow">
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                                                    <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Data Akreditasi</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB KEPEG FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenukepegawaian" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kepegawaian</a>
                            <ul aria-labelledby="sifakultasmenukepegawaian" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">EWS UB</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verfikasicuti') }}/all">Cuti Pegawai</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('listsurattugas') }}">Management Surat Tugas</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('user') }}">User Management</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB UMUMKEU FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenukeuangan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                                            <ul aria-labelledby="sifakultasmenukeuangan" class="dropdown-menu border-0 shadow">
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                                                    <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Data Akreditasi</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Umum</a>
                                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB KEUKEPEG FAK')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan </a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenukepegawaian" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kepegawaian</a>
                            <ul aria-labelledby="sifakultasmenukepegawaian" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">EWS UB</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verfikasicuti') }}/all">Cuti Pegawai</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('listsurattugas') }}">Management Surat Tugas</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('user') }}">User Management</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                            <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                            <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                            <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                            <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Data Akreditasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'BPPM')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data BPPM</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian / Swakelola</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @else
                @if (Session('keljabatan') == 'ATASANLANGSUNG')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Promosi</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                        </ul>
                    </li>
				@endif
            @endif
        @else
            @if (Session('keljabatan') == 'ATASANLANGSUNG')
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Promosi</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
            @endif
        @endif
    @elseif(Session('previlage') == 'mahasiswa' OR Session('previlage') == 'mahasiswa magister' OR Session('previlage') == 'mahasiswa doktoral')
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @if (Session('fakultas') == 'FIKES')
                @if(Session('previlage') == 'mahasiswa doktoral')
                    <li class="{{ isset($sidebar) && $sidebar == 'biodatadoktoral' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodatadoktoral') }}">Biodata </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="tahapandoktormenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan</a>
                        <ul aria-labelledby="tahapandoktormenu" class="dropdown-menu border-0 shadow">
                        @if (Session('fakultas') == 'PASCAUB')
                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                        @else
                            @if(Session('jurusan') !== null)
                                @if (Session('jurusan') == 'Jurusan Biologi')
                                    <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Usulan Tim Promotor</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Penilaian Seminar Internasional</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Penilaian Seminar Ilmiah Internasional</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah Bereputasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Revisi Naskah Setelah SEMHAS</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                                @endif
                            @else
                                <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Penilaian Seminar Ilmiah Internasional</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah Bereputasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Revisi Naskah Setelah SEMHAS</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                                <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                            @endif
                        @endif
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                            <li><a class="dropdown-item" href="{{ url('smknon') }}">Keterangan Aktif Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                            <li><a class="dropdown-item" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                        </ul>
                    </li>
                @elseif(Session('previlage') == 'mahasiswa magister')
                    <li class="{{ isset($sidebar) && $sidebar == 'biodatapasca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodatapasca') }}">Biodata </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="tahapanmagistermenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan</a>
                        <ul aria-labelledby="tahapanmagistermenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'formbebaspinjam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'formplagiasivokasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                            <li><a class="dropdown-item" href="{{ url('smknon') }}">Keterangan Aktif Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                            <li><a class="dropdown-item" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                        </ul>
                    </li>
                @else
                    <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Biodata </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Akademik</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="magangmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                <ul aria-labelledby="magangmenu" class="dropdown-menu border-0 shadow">
                                    <li><a class="dropdown-item" href="{{ url('srtpendalamanmateri') }}">Pendalaman Materi Praktis (Magang)</a></li>
                                    <li><a class="dropdown-item" href="{{ url('logbook') }}">Logbook Magang</a></li>
                                    <li><a class="dropdown-item" href="{{ url('ujianmagang') }}">Ujian Magang</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkpns') }}">Keterangan Aktif Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                            <li><a class="dropdown-item" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="kemahasiswaanmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                        <ul aria-labelledby="kemahasiswaanmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('dispenmhs') }}">Dispensasi</a></li>
                            <li><a class="dropdown-item" href="{{ url('sktmb') }}">Surat Keterangan Tidak Menerima Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{ url('peminatanmaba') }}">Penjaringan UKM</a></li>
                            <li><a class="dropdown-item" href="{{ url('ikutkegiatan') }}">Surat Keterangan Mengikuti Kegiatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('daftarpkm') }}">Pendaftaran PKM</a></li>
                            <li><a class="dropdown-item" href="{{ url('prestasi') }}">Tambah Prestasi</a></li>
                            <li><a class="dropdown-item" href="{{ url('beasiswa') }}">Tambah Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{ url('kegiatan') }}">E-LPJ Kegiatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('komplain') }}">E-Complain</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="tahapansarjanamenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA</a>
                        <ul aria-labelledby="tahapansarjanamenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        </ul>
                    </li>
                @endif
            @else
                @if(Session('previlage') == 'mahasiswa doktoral')
                    <li class="{{ isset($sidebar) && $sidebar == 'biodatadoktoral' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodatadoktoral') }}">Biodata </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="tahapandoktormenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan</a>
                        <ul aria-labelledby="tahapandoktormenu" class="dropdown-menu border-0 shadow">
                        @if (Session('fakultas') == 'PASCAUB')
                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                        @else
                            @if(Session('jurusan') !== null)
                                @if (Session('jurusan') == 'Jurusan Biologi')
                                    <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Usulan Tim Promotor</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Penilaian Seminar Internasional</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                                @elseif (Session('jurusan') == 'Jurusan Matematika')
                                    <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
									<li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
									<li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
									<li><a class="dropdown-item" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
									<li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
									<li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
									<li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
									<li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
									<li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
									<li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
									<li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
								@else
                                    <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Penilaian Seminar Ilmiah Internasional</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah Bereputasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Revisi Naskah Setelah SEMHAS</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                                    <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                                @endif
                            @else
                                <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Penilaian Seminar Ilmiah Internasional</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah Bereputasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Revisi Naskah Setelah SEMHAS</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                                <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                            @endif
                        @endif
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                            <li><a class="dropdown-item" href="{{ url('smknon') }}">Keterangan Aktif Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                            <li><a class="dropdown-item" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                        </ul>
                    </li>
                @elseif(Session('previlage') == 'mahasiswa magister')
                    <li class="{{ isset($sidebar) && $sidebar == 'biodatapasca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodatapasca') }}">Biodata </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="tahapanmagistermenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan</a>
                        <ul aria-labelledby="tahapanmagistermenu" class="dropdown-menu border-0 shadow">
                            @if (Session('fakultas') == 'PASCAUB')
                                <li><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li><a class="dropdown-item" href="{{ url('sempro') }}">Ujian Proposal</a></li>
                                <li><a class="dropdown-item" href="{{ url('semhas') }}">Semhas</a></li>
                                <li><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Tesis</a></li>
                                <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            @elseif (Session('fakultas') == 'FMIPA')
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            @else
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                            <li><a class="dropdown-item" href="{{ url('smknon') }}">Keterangan Aktif Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                            <li><a class="dropdown-item" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                        </ul>
                    </li>
                @else
                    <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Biodata </a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="magangmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                        <ul aria-labelledby="magangmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('srtpendalamanmateri') }}">Pendalaman Materi Praktis (Magang)</a></li>
                            <li><a class="dropdown-item" href="{{ url('logbook') }}">Logbook Magang</a></li>
                            <li><a class="dropdown-item" href="{{ url('ujianmagang') }}">Ujian Magang</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="kemahasiswaanmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                        <ul aria-labelledby="kemahasiswaanmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('dispenmhs') }}">Dispensasi</a></li>
                            <li><a class="dropdown-item" href="{{ url('sktmb') }}">Surat Keterangan Tidak Menerima Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{ url('peminatanmaba') }}">Penjaringan UKM</a></li>
                            <li><a class="dropdown-item" href="{{ url('ikutkegiatan') }}">Surat Keterangan Mengikuti Kegiatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('daftarpkm') }}">Pendaftaran PKM</a></li>
                            <li><a class="dropdown-item" href="{{ url('prestasi') }}">Tambah Prestasi</a></li>
                            <li><a class="dropdown-item" href="{{ url('beasiswa') }}">Tambah Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{ url('kegiatan') }}">E-LPJ Kegiatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('komplain') }}">E-Complain</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="tahapansarjanamenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan</a>
                        <ul aria-labelledby="tahapansarjanamenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                            <li><a class="dropdown-item" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li><a class="dropdown-item" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkpns') }}">Keterangan Aktif Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                            <li><a class="dropdown-item" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                            <li><a class="dropdown-item" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                        </ul>
                    </li>
                @endif
            @endif
            </ul>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> <i class="fa fa-gears"></i> Application</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li class="dropdown-submenu dropdown-hover">
                    <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                    <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                        @if(Session('fakultas') == 'FKH' OR Session('fakultas') == 'FIKES')
                            <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
                        @endif
                        @if(Session('spesial') == 'Admin SIDOKAR' OR Session('spesial') == 'Admin DISTENDIK')
                            @if(Session('fakultas') == 'KP')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dirsdmmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Dir. SDM</a>
                                    <ul aria-labelledby="dirsdmmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('inpassinggaji') }}">Draft SK Penyesuain Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skkontrak') }}">Draft SK Kontrak</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('udin') }}">Ujian Dinas</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('latsaradmin') }}">LATSAR</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">Usul Penilaian Angka Kredit Kenaikan Jabatan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">SK Tunjangan Fungsional Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">SK Pengangkatan Pertama kali dalam Jabatan Akademik</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">SURAT PERNYATAAN MELAKSANAKAN TUGAS</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">Pengantar dari Fakultas ke KP</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">Pengantar Revisi Usulan/Pengembalian/Penolakan ke Fakultas</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">Nota Dinas Usul Pertimbangan / Persetujuan Senat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">Permintaan Kuisioner (Dari Senat)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('berkaspak') }}">DUPAK</a></li>
                                    </ul>
                                </li>
                            @elseif(Session('fakultas') == 'FKH' OR Session('fakultas') == 'FIKES')

                            @else
                                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
                            @endif
                            <li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
                        @endif
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboardwebinar') }}">Rapat/Webinar</a></li>
                    </ul>
                </li>
                @if(Session('fakultas') == 'FV')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIVOKA</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">Setting Pejabat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                            @if(Session('previlage') == 'Staf Kemahasiswaan')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                                    <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                    </ul>
                                </li>
                            @elseif(Session('previlage') == 'Staf Akademik')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                    <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                            <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Pelaporan Deteksi Plagiasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                            <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @elseif(Session('previlage') == 'Staf Keuangan')
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Rekap Presensi Dosen</a></li>
                            @else
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Session('fakultas') == 'PASCAUB')
                    <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                    @if(Session('previlage') == 'Staf Sub.Bag.Akademik dan Kemahasiswaan')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sistem Pelayanan</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @elseif(Session('previlage') == 'Staf Sub.Bag.Umum dan Keuangan')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">2. Keuangan</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Gaji Pegawai</a>
                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                            </ul>
                        </li>
                    @elseif(Session('previlage') == 'Tim Jurnal')
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('adminplagiasi') }}">Jurnal</a></li>
                    @elseif(Session('previlage') == 'Tim Umum')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">4. Umum</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            </ul>
                        </li>
                    @elseif(Session('previlage') == 'Tim Pendaftaran')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('previlage') == 'Tim Ruang Baca')
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                    @elseif(Session('previlage') == 'Tim Pendaftaran GJM BPPM')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    @elseif(Session('previlage') == 'Tim Beasiswa, BPPM, GJM, Pendaftaran')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Beasiswa</a>
                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    @elseif(Session('previlage') == 'Tim Beasiswa, Akademik, GJM, BPPM, Pendaftaran')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sistem Pelayanan</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                    <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magister</a>
                                            <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                            <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Beasiswa</a>
                            <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2') }}">Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3') }}">Doktor</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    @elseif(Session('previlage') == 'Tim Umum, GJM, BPPM')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">4. Umum</a>
                            <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">BPPM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>
                    @elseif(Session('previlage') == 'Sekretaris GJM')
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">GJM</a></li>    
                    @else
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sistem Pelayanan</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
                @if(Session('spesial') == 'Admin Bantuan Studi')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="simbantuanmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Bantuan Studi,Publikasi</a>
                                <ul aria-labelledby="simbantuanmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadmin') }}">Admin Bantuan Studi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan Publikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Penerima Dana Riset dan PKM</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanuser' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanuser') }}">Bantuan Model User</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin Bantuan Publikasi')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="simbantuanmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Bantuan Studi,Publikasi</a>
                                <ul aria-labelledby="simbantuanmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan Publikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Penerima Dana Riset dan PKM</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin Peminjaman')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="simasetmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a>
                                <ul aria-labelledby="simasetmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="{{ isset($sidebar) && $sidebar == 'simpen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpen') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                @endif
                @if(Session('spesial') == 'Admin SPD')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin SK')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="suratmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persuratan</a>
                                <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
                                </ul>
                            </li>
                            @if (Session('fakultas') == 'KP')
                                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('bantuanadminriset') }}">Penerima Dana Riset dan PKM</a></li>
                            @else
                                <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
                            @endif
                            <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">EWS UB</a></li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin Ecek')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="ecekmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">e-Cek</a>
                                <ul aria-labelledby="ecekmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ecekadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ecekadmin') }}">E-Cek Admin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Bendahara Jurusan')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="keujurmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan Jurusan</a>
                                <ul aria-labelledby="keujurmenu" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'settingkeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingkeuhpt') }}">Setting</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin SIDOKAR' OR Session('spesial') == 'Admin DISTENDIK')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="diktendikmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">DIKTENDIK</a>
                        <ul aria-labelledby="diktendikmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ewsub') }}">DirJab UB</a></li>
                            @if(Session('fakultas') == 'KP')
                                <li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verifikatorkgb') }}">Verifikasi KGB</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dokarsetting') }}">Template SK</a></li>
                            @endif
                            <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('simpukjaverifikasi') }}"> SIMPRO-PAK</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('verfikasicuti') }}/all"> Cuti Pegawai</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('listsurattugas') }}"> Manajemen Surat Tugas</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('user') }}"> Manajemen User/Pengguna</a></li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin SIMPRO-SENAT')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Application</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="nav-item {{ isset($sidebar) && $sidebar == 'simprosenat' ? 'active' : '' }}"><a href="{{ url('simprosenat') }}"><i class="fa fa-envelope text-danger"></i> SIMPRO-PAK</a></li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Operator Prodi S1')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                        <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan Prodi S1</a>
                                <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Operator Prodi S2')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                        <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Tahapan Prodi S2</a>
                                <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Operator Prodi S3')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                        <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Pramu Kelas')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Perkuliahan</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">Jadwal Mahasiswa</a></li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin Akademik')
                    @if(Session('fakultas') == 'FMIPA')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AKADEMIK</a>
                            <ul aria-labelledby="sifakmenu01" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skl') }}">Laporan SKL</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapakadsp') }}">Pendaftaran SA</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pesertakelassa') }}">Peserta Kelas SA</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                    <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                    <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                    <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                            <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                    <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                    <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor (Biologi)</a>
                                    <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09b" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor (Matematika)</a>
                                    <ul aria-labelledby="sifakmenu09b" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor (All)</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                            <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AKADEMIK</a>
                            <ul aria-labelledby="sifakmenu01" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('skl') }}">Laporan SKL</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapakadsp') }}">Pendaftaran SA</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pesertakelassa') }}">Peserta Kelas SA</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                            <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                    <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                    <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                    <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                            <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                    <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                    <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                    <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
                @if(Session('spesial') == 'Admin Kemahasiswaan')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kemahasiswaan</a>
                        <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin AkaddanKmh')
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">SIFAKULTAS</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakultasmenuakademik" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Akademik dan Kemahasiswaan</a>
                                <ul aria-labelledby="sifakultasmenuakademik" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangbaca') }}">Ruang Baca</a></li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                        <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="sifakmenu03" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Setting</a>
                                                <ul aria-labelledby="sifakmenu03" class="dropdown-menu border-0 shadow">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                                <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="sifakmenu05" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Ujian</a>
                                                <ul aria-labelledby="sifakmenu05" class="dropdown-menu border-0 shadow">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan Mahasiswa</a>
                                        <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Persurat Mahasiswa</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                                        <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                                <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                                <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                                <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('swakelola') }}">Data Penelitian</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                </ul>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin Jurusan Biologi' OR Session('spesial') == 'Admin Jurusan Fisika' OR Session('spesial') == 'Admin Jurusan Matematika' OR Session('spesial') == 'Admin Jurusan Kimia' OR Session('spesial') == 'Admin Jurusan Statistika')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                        <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                            @if(Session('spesial') == 'Admin Jurusan Biologi')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                    <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2biologi') }}"> Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3biologi') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @elseif(Session('spesial') == 'Admin Jurusan Matematika')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                    <ul aria-labelledby="sifakmenu09" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2matematika') }}"> Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3matematika') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                    </ul>
                                </li>
                                @if(Session('spesial') == 'Admin Jurusan Fisika')
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                        <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2fisika') }}"> Magister</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3fisika') }}"> Doktor</a></li>
                                        </ul>
                                    </li>
                                @elseif(Session('spesial') == 'Admin Jurusan Statistika')
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                        <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2statistika') }}"> Magister</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3statistika') }}"> Doktor</a></li>
                                        </ul>
                                    </li>
                                @else 
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="sifakmenu10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                        <ul aria-labelledby="sifakmenu10" class="dropdown-menu border-0 shadow">
                                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2kimia') }}"> Magister</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3kimia') }}"> Doktor</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'Admin Jurusan Sosial Ekonomi Pertanian' OR Session('spesial') == 'Admin Jurusan Budidaya Pertanian' OR Session('spesial') == 'Admin Jurusan Tanah' OR Session('spesial') == 'Admin Jurusan Hama dan Penyakit Tumbuhan' OR Session('spesial') == 'Admin Ilmu Pertanian')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SI FAKULTAS</a>
                        <ul aria-labelledby="sifakmenu" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">Program Studi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                        <ul aria-labelledby="sifakmenu02" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu04" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Jadwal Kuliah</a>
                                <ul aria-labelledby="sifakmenu04" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="sifakmenu06" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan PRODI</a>
                        <ul aria-labelledby="sifakmenu06" class="dropdown-menu border-0 shadow">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu07" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Magang</a>
                                <ul aria-labelledby="sifakmenu07" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu08" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Diploma/Sarjana/Magister</a>
                                <ul aria-labelledby="sifakmenu08" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sempro') }}">Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Doktor</a>
                                <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                </ul>
                            </li>
                            @if(Session('spesial') == 'Admin Jurusan Sosial Ekonomi Pertanian')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2se' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2se') }}"> Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3se' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3se') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @elseif(Session('spesial') == 'Admin Jurusan Budidaya Pertanian')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2bp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2bp') }}"> Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3bp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3bp') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @elseif(Session('spesial') == 'Admin Jurusan Tanah')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2tanah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2tanah') }}"> Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3tanah' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3tanah') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @elseif(Session('spesial') == 'Admin Jurusan Hama dan Penyakit Tumbuhan')
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2hpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas2hpt') }}"> Magister</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3hpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3hpt') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakmenu09a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">CAMABA</a>
                                    <ul aria-labelledby="sifakmenu09a" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3pertanian' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('camabas3pertanian') }}"> Doktor</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Session('spesial') == 'esign')
                    <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('antritte') }}">TTE Admin</a></li>
                @endif
                @if(Session('spesial') == 'Admin Hasil LAB Klinik UB')
                    <li class="{{ isset($sidebar) && $sidebar == 'suratlabklinik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratlabklinik') }}">Hasil Lab</a></li>
                @endif
                @if(Session('spesial') == 'Admin Akademik KP')
		            <li class="{{ isset($sidebar) && $sidebar == 'suratakademikkp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('suratakademikkp') }}">Terminal Kuliah</a></li>
                @endif
                @if(Session('spesial') == 'Bendahara Gaji')
                    @if (Session('fakultas') == 'FIKES')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sifakultasmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIFAKULTAS</a>
                            <ul aria-labelledby="sifakultasmenu" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="sifakultasmenupelayanan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pelayanan</a>
                                    <ul aria-labelledby="sifakultasmenupelayanan" class="dropdown-menu border-0 shadow">
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="sifakultasmenukeuangan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                                            <ul aria-labelledby="sifakultasmenukeuangan" class="dropdown-menu border-0 shadow">
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                                                    <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="simspdmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIM SPD</a>
                                                    <ul aria-labelledby="simspdmenu" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('sppdsetting') }}">Setting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu dropdown-hover">
                                                    <a id="sifakmenu11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIPAGU</a>
                                                    <ul aria-labelledby="sifakmenu11" class="dropdown-menu border-0 shadow">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                                    </ul>
                                                </li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('keucontrol') }}">Data Akreditasi</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Data Tambahan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="siakreditasi02" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Laporan</a>
                                    <ul aria-labelledby="siakreditasi02" class="dropdown-menu border-0 shadow">
                                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="sigapmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SIGAP</a>
                            <ul aria-labelledby="sigapmenu" class="dropdown-menu border-0 shadow">
                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gpp') }}">Data GPP</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajisetting') }}">Setting</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('espete') }}">SPT Tahunan</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="{{ isset($sidebar) && $sidebar == 'ujiandinas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujiandinas') }}">UJIAN</a></li>
                @else
                    <li class="{{ isset($sidebar) && $sidebar == 'gajiuser' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('gajiuser') }}">SIGAP</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ujiandinas' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('ujiandinas') }}">UJIAN</a></li>
                @endif
            </ul>
        </li>
    @endif
    @if (Session('id') == 2)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('developing') }}" role="button"><i class="fa fa-user-secret"></i></a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ url('ujiandinas') }}" role="button"><i class="fa fa-pencil"></i> Ujian</a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ url('manualbook') }}" role="button"><i class="fa fa-book"></i> Manual Book</a>
    </li>
@else
    @php
        $servername = $_SERVER['SERVER_NAME'];
        if ($servername == 'https://fikes.ub.ac.id' OR $servername == 'http://fikes.ub.ac.id' OR $servername == 'fikes.ub.ac.id'){
    @endphp
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">All Menu</a>
        </li>
    @php
        }
    @endphp
    <li class="nav-item"><a href="{{ url('/') }}"  class="nav-link"><i class="fa fa-dashboard"></i></a></li>
@endif
