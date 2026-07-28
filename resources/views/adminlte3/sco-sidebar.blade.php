@if(Session('id') !== null)
    @if(Session('previlage') == 'developer')
        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('antritte') }}">
            <i class="nav-icon fa fa-dashboard text-success"></i> <p>TTE Queue
                @if(isset($countantritte))
                    @if($countantritte != 0)
                        <span class="right badge badge-danger">{{ $countantritte }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'sigap' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-calculator text-warning"></i>
            <p>
                SIGAP
                <i class="fa fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gpp') }}">Data GPP</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-envelope-o  text-info"></i> <p>Persuratan
            <i class="fa fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'dashboardpimpinan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardpimpinan') }}">Dashboard Pimpinan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashbordsurat') }}">Dashboard Sekpim</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardagendaris') }}">Dashboard Agendaris</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'controlsekpim' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('controlsekpim') }}">Kontrol Sekpim</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'controltu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('controltu') }}">Kontrol TU</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'controlekspedisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('controlekspedisi') }}">Kontrol Sekpim</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('insurat') }}">Surat Masuk</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('notadinas') }}">Nota Dinas</a>
                    @if(isset($countsendnd))
                        @if($countsendnd != 0)
                                <span class="right badge badge-danger">{{ $countsendnd }}</span>
                        @endif
                    @endif
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('disposisi') }}">Disposisi</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('tandatangan') }}">Tanda Tangan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ekspedisi') }}">Ekspedisi Surat Keluar</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'suratlabklinik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratlabklinik') }}"><i class="nav-icon fa fa-flask text-success"></i>Surat Hasil Lab </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('statistik') }}">Statistik</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-black-tie text-yellow"></i> <p>Bantuan Studi dan Publikasi
            <i class="fa fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanadmin') }}">Admin Bantuan Studi</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan Publikasi</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanadminriset') }}">Penerima Dana Riset dan PKM</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanuser' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanuser') }}">Bantuan Model User</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-street-view text-aqua"></i> <p>Perjalanan Dinas
            <i class="fa fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'dokar' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-users text-magenta"></i> <p>DIKTENDIK<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">EWS UB</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('inpassinggaji') }}">SK Penyesuain Gaji</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('udin') }}">Ujian Dinas</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('latsaradmin') }}">LATSAR</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('skkontrak') }}">Draft SK Kontrak</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('verifikatorkgb') }}">Verifikasi KGB</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dokarsetting') }}">Setting</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('verfikasicuti') }}/all">Cuti Pegawai</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i> <i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'ecek' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-credit-card text-danger"></i> <p>E-Cek<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'ecekadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ecekadmin') }}">E-Cek Admin</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ecekverfikasi') }}">E-Cek Verifikasi</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'simpukjadmin' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'simpukjadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simpukjadmin') }}">Setting Layanan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'simpukjapengajuan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simpukjapengajuan') }}">Pengajuan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-bank text-yellow"></i> <p>SI FAKULTAS<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Pelaporan Deteksi Plagiasi</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('ruangbaca') }}">
                    <i class="nav-icon fa fa-book text-yellow"></i> <p>Ruang Baca</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('jadwalsatpam') }}">
                    <i class="nav-icon fa fa-drupal text-yellow"></i> <p>Jadwal Satpam</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('simbhp') }}">
                    <i class="nav-icon fa fa-shopping-cart text-yellow"></i> <p>SIMBHP</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-globe text-yellow"></i> <p>Swakelola</p>
                    </a>
                </li>
                <li class="nav-item"> <!--Pelayanan Akademik-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Program Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Akademik<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('skl') }}">Laporan SKL</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Semester Antara<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapakadsp') }}">Pendaftaran</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pesertakelassa') }}">Peserta Kelas</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <!--Jadwal-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <!--Pelayanan Prodi-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Diploma/Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <!--Pelayanan Kemahasiswaan-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                    </ul>
                </li>
                <li class="nav-item"><!--CAMABA-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user-plus text-yellow"></i> <p>Reg. CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                <li class="nav-item"> <!--SIPAGU-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                    </ul>
                </li>
                <li class="nav-item"> <!--Keuangan Jurusan-->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money text-yellow"></i> <p>Keuangan Jurusan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'simba' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>SI Akreditasi<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Kegiatan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li title="Data Akademik Lain" class="{{ isset($sidebar) && $sidebar == 'akademik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akademik') }}">Pendidikan</a></li>
                        <li title="Data Penelitan dan Publikasi Ilmiah"  class="{{ isset($sidebar) && $sidebar == 'penelitian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitian') }}">Penelitian</a></li>
                        <li title="Data Pengabdian" class="{{ isset($sidebar) && $sidebar == 'pengabdian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengabdian') }}">PkM</a></li>
                        <li title="Data Penunjang, Luaran HAKI" class="{{ isset($sidebar) && $sidebar == 'penunjangdosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penunjangdosen') }}">Penunjang</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-fonticons text-danger"></i> <p>Penilaian<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'bkd' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bkd') }}">BKD</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pak') }}">PAK</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpakbkd' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpakbkd') }}">Setting Rubrik BKD</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingbkd' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingbkd') }}">Setting Rubrik PAK</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-trophy text-primary"></i> <p>Tambahan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-area-chart text-success"></i> <p>Laporan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-gears text-danger"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Control Keuangan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('masterlab') }}">Master Laboratorium</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-header">==========================</li>
        <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('user') }}">
            <i class="nav-icon fa fa-user-plus text-aqua"></i> <p>Setting</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('lembaga') }}">
            <i class="nav-icon fa fa-bank text-danger"></i> <p>Setting Unit Kerja</p>
            </a>
        </li>
    @elseif(Session('previlage') == 'admin')
        <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('user') }}">
            <i class="nav-icon fa fa-user-plus text-success"></i> <p>Setting</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('kategori12') }}">
            <i class="nav-icon fa fa-bank text-info"></i> <p>Setting Prodi</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardagendaris') }}">
            <i class="nav-icon fa fa-qrcode text-danger"></i> <p>Penomoran Surat</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('settingpejabat') }}">
            <i class="nav-icon fa fa-mortar-board text-danger"></i> <p>TTD dan Paraf Pimpinan</p>
            </a>
        </li>
        @if(Session('fakultas') == 'FMIPA' OR Session('fakultas') == 'FP')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan (SEMUA JURUSAN)<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Setting Ruang</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Jurusan Biologi<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>ALL Jurusan<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA MAGISTER<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2biologi') }}"> Biologi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2fisika') }}"> Fisika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2matematika') }}"> Matematika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2kimia') }}"> Kimia</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2statistika') }}"> Statistika</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA DOKTOR<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3biologi') }}">Biologi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3fisika') }}">Fisika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3matematika') }}">Matematika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3kimia') }}">Kimia</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3statistika') }}">Statistika</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
    @elseif(Session('previlage') == 'Sekretaris' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Akademik' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR Session('previlage') == 'Sekretaris Rektor' OR Session('previlage') == 'Sekretaris Dekan' OR Session('previlage') == 'Sekretaris WD I' OR Session('previlage') == 'Sekretaris WD II' OR Session('previlage') == 'Sekretaris WD III')
        <li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashbordsurat') }}">
            <i class="nav-icon fa fa-dashboard text-primary"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('bukutamuadmin') }}">
            <i class="nav-icon fa fa-book"></i> <p>Buku Tamu</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('insurat') }}">
            <i class="nav-icon fa fa-briefcase text-success"></i> <p>Surat Masuk</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
        <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}"><i class="nav-icon fa fa-graduation-cap text-danger"></i> Direktori Jabatan </a></li>
        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outperaturan') }}">
            <i class="nav-icon fa fa-book text-warning"></i> <p>SK dan Peraturan</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardagendaris') }}">
            <i class="nav-icon fa fa-qrcode text-danger"></i> <p>Penomoran Surat</p>
            </a>
        </li>
        @if (Session('fakultas') == 'FIKES')
            <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('simpukjaverifikasi') }}">
                    <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK
                    @if(isset($countsimpro))
                        @if($countsimpro != 0)
                            <span class="right badge badge-danger"> {{ $countsimpro }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
		@endif
        @if(Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan')
            <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('user') }}">
                <i class="nav-icon fa fa-user-plus text-success"></i> <p>Setting</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('lembaga') }}">
                <i class="nav-icon fa fa-bank text-danger"></i> <p>Admin Fakultas/Lembaga</p>
                </a>
            </li>
        @endif
    @elseif(Session('previlage') == 'Sekretaris Senat UB')
        <li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashbordsurat') }}">
            <i class="nav-icon fa fa-dashboard"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('bukutamuadmin') }}">
            <i class="nav-icon fa fa-book"></i> <p>Buku Tamu</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @elseif(Session('previlage') == 'Agendaris Umum' OR Session('previlage') == 'Agendaris')
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardagendaris') }}">
            <i class="nav-icon fa fa-dashboard"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('ekspedisi') }}">
            <i class="nav-icon fa fa-paper-plane-o text-success"></i> <p>Ekpedisi Surat</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @elseif(Session('previlage') == 'Arsiparis Umum' OR Session('previlage') == 'Arsiparis')
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsiparis' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardarsiparis') }}">
            <i class="nav-icon fa fa-dashboard text-danger"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'settingsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('settingsurat') }}">
            <i class="nav-icon fa fa-gears text-success"></i> <p>Setting</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @elseif(Session('previlage') == 'Tata Usaha')
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardagendaris') }}">
            <i class="nav-icon fa fa-dashboard"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-primary"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('ekspedisi') }}">
            <i class="nav-icon fa fa-paper-plane-o text-success"></i> <p>Ekpedisi Surat</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('insurat') }}">
            <i class="nav-icon fa fa-briefcase text-success"></i> <p>Surat Masuk</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o text-warning"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @elseif(Session('previlage') == 'Frontoffice' OR Session('previlage') == 'frontoffice')
        <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('bukutamuadmin') }}">
            <i class="nav-icon fa fa-book"></i> <p>Buku Tamu</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-primary"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o text-warning"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @elseif(Session('previlage') == 'Sekretaris Ka.Biro Keuangan' OR Session('previlage') == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR Session('previlage') == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR Session('previlage') == 'Sekretaris Bagian Akutansi')
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardsekbiro' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardsekbiro') }}">
            <i class="nav-icon fa fa-dashboard text-danger"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('bukutamuadmin') }}">
            <i class="nav-icon fa fa-book text-success"></i> <p>Buku Tamu</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-warning"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardagendaris') }}">
            <i class="nav-icon fa fa-qrcode text-info"></i> <p>Penomoran Surat</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o text-aqua"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @elseif(Session('previlage') == 'PEJABAT')
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardpimpinan' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardpimpinan') }}">
            <i class="nav-icon fa fa-dashboard"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('disposisi') }}">
            <i class="nav-icon fa fa-briefcase"></i> 
                <p>Surat Masuk
                @if(isset($countinboxmasuk))
                    @if($countinboxmasuk != 0)
                        <span class="right badge badge-danger">{{ $countinboxmasuk }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('tandatangan') }}">
            <i class="nav-icon fa fa-pencil-square-o"></i> 
                <p>Mohon Paraf/Ttd
                @if(isset($countinboxkeluar))
                    @if($countinboxkeluar != 0)
                        <span class="label pull-right bg-yellow">{{ $countinboxkeluar }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('notadinas') }}">
            <i class="nav-icon fa fa-file-text"></i> 
                <p>Nota Dinas
                @if(isset($countsendnd))
                    @if($countsendnd != 0)
                            <span class="right badge badge-danger">{{ $countsendnd }}</span>
                    @endif
                @endif
                </p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'memo' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('memo') }}">
            <i class="nav-icon fa fa-file-text"></i> 
                <p>Memo</p>
            </a>
        </li>		
        @if(Session('idjabatan') == '3')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadmin') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Biaya Studi Lanjut</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminpublikasi') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Publikasi</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminriset') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Penerima Dana Riset dan PKM</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('simprokja') }}">
                <i class="nav-icon fa fa-mortar-board text-green"></i> 
                    <p>SIMPRO-KJA</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('ecekverfikasi') }}">
                <i class="nav-icon fa fa-money text-red"></i> 
                    <p>E-Cek</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('antritte') }}">
                <i class="nav-icon fa fa-dashboard text-success"></i> <p>TTE Report
                    @if(isset($countantritte))
                        @if($countantritte != 0)
                            <span class="right badge badge-danger">{{ $countantritte }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Management Assets<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Assets <i class="nav-icon fa fa-building"></i> dan <i class="nav-icon fa fa-taxi"></i></a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Assets Kendaraan</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('masterlab') }}">Assets Laboratorium</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-gears text-primary"></i> <p>Developing<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'DataInduk' ? 'active' : '' }} nav-item">
                        <a class="nav-link" href="/datainduk/Dosen-{{Session('nim')}}">
                        <i class="nav-icon fa fa-newspaper-o"></i> <p>Profile Lengkap</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-area-chart text-success"></i> <p>Tabel SAPTO Akreditasi<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-trophy text-primary"></i> <p>Data Tambahan Akreditasi<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-danger"></i> <p>Manual Input<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-bank text-yellow"></i> <p>SI FAKULTAS<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                                <a class="nav-link" href="{{ url('adminplagiasi') }}">
                                <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Pelaporan Deteksi Plagiasi</p>
                                </a>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                                <a class="nav-link" href="{{ url('ruangbaca') }}">
                                <i class="nav-icon fa fa-book text-yellow"></i> <p>Ruang Baca</p>
                                </a>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item">
                                <a class="nav-link" href="{{ url('jadwalsatpam') }}">
                                <i class="nav-icon fa fa-drupal text-yellow"></i> <p>Jadwal Satpam</p>
                                </a>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item">
                                <a class="nav-link" href="{{ url('simbhp') }}">
                                <i class="nav-icon fa fa-shopping-cart text-yellow"></i> <p>SIMBHP</p>
                                </a>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                                <a class="nav-link" href="{{ url('swakelola') }}">
                                <i class="nav-icon fa fa-globe text-yellow"></i> <p>Swakelola</p>
                                </a>
                            </li>
                            <li class="nav-item"> <!--Pelayanan Akademik-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Program Studi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Akademik<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('skl') }}">Laporan SKL</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Semester Antara<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapakadsp') }}">Pendaftaran</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pesertakelassa') }}">Peserta Kelas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"> <!--Jadwal-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"> <!--Pelayanan Prodi-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-briefcase text-green"></i> <p>Diploma/Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"> <!--Pelayanan Kemahasiswaan-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><!--CAMABA-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-user-plus text-yellow"></i> <p>Reg. CAMABA<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"> <!--SIPAGU-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"> <!--Keuangan Jurusan-->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-money text-yellow"></i> <p>Keuangan Jurusan<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '436')
            <li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('simprokja') }}">
                <i class="nav-icon fa fa-mortar-board text-green"></i> 
                    <p>SIMPRO-KJA</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
        @endif
        @if(Session('idjabatan') == '1')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadmin') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Biaya Studi Lanjut</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminpublikasi') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Publikasi</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminriset') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Penerima Dana Riset dan PKM</p>
                </a>
            </li>
        @endif
        @if(Session('idjabatan') == '2')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadmin') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Biaya Studi Lanjut</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminpublikasi') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Publikasi</p>
                </a>
            </li>
            
        @endif
        @if(Session('idjabatan') == '35')
            <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('antritte') }}">
                <i class="nav-icon fa fa-dashboard text-success"></i> <p>TTE Report</p>
                    @if(isset($countantritte))
                        @if($countantritte != 0)
                            <span class="right badge badge-danger">{{ $countantritte }}</span>
                        @endif
                    @endif
                </a>
            </li>
        @endif
        @if(Session('idjabatan') == '8')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadmin') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Studi dan Publikasi</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('ecekverfikasi') }}">
                <i class="nav-icon fa fa-money text-red"></i> 
                    <p>E-Cek</p>
                    @if(isset($countvercek))
                        @if($countvercek != 0)
                            <span class="right badge badge-danger">{{ $countvercek }}</span>
                        @endif
                    @endif
                </a>
            </li>
        @endif
        @if(Session('idjabatan') == '15')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadmin') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Bantuan Studi dan Publikasi</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('ecekverfikasi') }}">
                <i class="nav-icon fa fa-money text-red"></i> 
                    <p>E-Cek
                    @if(isset($countvercek))
                        @if($countvercek != 0)
                            <span class="right badge badge-danger">{{ $countvercek }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi Vokasi<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Master Program Studi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Jadwal Vokasi<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                            <li><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                            <li><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                            <li><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                            <li><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Vokasi<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Laporan Adm. Deteksi Plagiasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                            <li><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-green"></i> <p>Ujian<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Publikasi Jurnal (S2)</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Kemahasiswaan Vokasi<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '965')
            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Administrasi <i class="nav-icon fa fa-building"></i> dan <i class="nav-icon fa fa-taxi"></i><i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '53')
            <li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('ecekverfikasi') }}">
                <i class="nav-icon fa fa-money text-red"></i> 
                    <p>E-Cek
                    @if(isset($countvercek))
                        @if($countvercek != 0)
                            <span class="right badge badge-danger">{{ $countvercek }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
        @endif
        @if(Session('idjabatan') == '63')
            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Administrasi <i class="nav-icon fa fa-building"></i> dan <i class="nav-icon fa fa-taxi"></i><i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                </ul>
            </li>
        @endif
        @if(Session('idjabatan') == '64')
            <li class="{{ isset($sidebar) && $sidebar == 'controlsekpim' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('controlsekpim') }}">
                <i class="nav-icon fa fa-black-tie text-yellow"></i> <p>Kontrol Sekpim</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'controltu' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('controltu') }}">
                <i class="nav-icon fa fa-newspaper-o text-yellow"></i> <p>Kontrol Tata Usaha</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('dashboardagendaris') }}">
                <i class="nav-icon fa fa-pencil text-yellow"></i> <p>Kontrol Agendaris</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'controlekspedisi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('controlekspedisi') }}">
                <i class="nav-icon fa fa-map-signs text-yellow"></i> <p>Kontrol Ekspedisi</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('insurat') }}">
                <i class="nav-icon fa fa-briefcase text-success"></i> <p>Surat Masuk</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('suratkeluar') }}">
                <i class="nav-icon fa fa-envelope text-yellow"></i> <p>Surat Keluar</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
        @endif
        @if(Session('idjabatan') == '1005')
            <li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('dashboardagendaris') }}">
                <i class="nav-icon fa fa-pencil text-yellow"></i> <p>Kontrol Surat Keluar</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('outperaturan') }}">
                <i class="nav-icon fa fa-pencil text-yellow"></i> <p>Kontrol SK dan Peraturan</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('insurat') }}">
                <i class="nav-icon fa fa-briefcase text-success"></i> <p>Kontrol Surat Masuk</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('suratkeluar') }}">
                <i class="nav-icon fa fa-envelope text-yellow"></i> <p>Surat Keluar</p>
                </a>
            </li>
        @endif
        @if(Session('idjabatan') == '924' OR Session('idjabatan') == '833' OR Session('idjabatan') == '1024' OR Session('idjabatan') == '958' OR Session('idjabatan') == '973')
            <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('suratkeluar') }}">
                <i class="nav-icon fa fa-envelope text-yellow"></i> <p>Surat Keluar</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
        @endif
        @if(Session('idjabatan') == '61' OR Session('idjabatan') == '65' OR Session('idjabatan') == '11' OR Session('idjabatan') == '970' OR Session('idjabatan') == '973')
			<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}"><i class="nav-icon fa fa-list"></i> Direktori Pejabat</a></li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanadmin') }}"><i class="nav-icon fa fa-money"></i> Bantuan Biaya Studi Lanjut</a></li>
            <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
        @endif
        @if(Session('idjabatan') == '10')
			<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
        @endif
        @if(Session('fakultas') == 'FMIPA')
            <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item">
                <a href="{{ url('dosenpenguji') }}" class="nav-link">
                    <i class="nav-icon fa fa-th"></i>
                    <p>
                        HR Dosen Penguji
                        {{ isset($notifdosenpenguji) ? $notifdosenpenguji : '' }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan (SEMUA JURUSAN)<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Setting Ruang</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                        @if(Session('jabatan') == 'Ketua Jurusan Biologi' OR Session('jabatan') == 'Sekretaris Jurusan Biologi' OR Session('jabatan') == 'Ketua Program Studi S1 Biologi' OR Session('jabatan') == 'Ketua Program Studi S2 Biologi' OR Session('jabatan') == 'Ketua Program Studi S3 Biologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Dasar' OR Session('jabatan') == 'Kepala Laboratorium Mikrobiologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Seluler dan Molekuler')
                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                        @else
                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                        @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA MAGISTER<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2biologi') }}"> Biologi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2fisika') }}"> Fisika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2matematika') }}"> Matematika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2kimia') }}"> Kimia</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2statistika') }}"> Statistika</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA DOKTOR<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3biologi') }}">Biologi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3fisika') }}">Fisika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3matematika') }}">Matematika</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3kimia') }}">Kimia</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3statistika') }}">Statistika</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            @if (Session('keljabatan') == 'KASUB KEPEG FAK' OR Session('keljabatan') == 'KASUB AKAD FAK' OR Session('keljabatan') == 'KASUB UMUM FAK' OR Session('keljabatan') == 'KASUB KEU FAK' OR Session('keljabatan') == 'KASUB UMUMKEU FAK' OR Session('keljabatan') == 'KASUB KEUKEPEG FAK')
                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item">
                    <a href="{{ url('alihstatus') }}" class="nav-link">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>Promosi Tendik Kontrak</p>
                    </a>
                </li>
            @endif
        @elseif(Session('fakultas') == 'PASCAUB')
            @if(Session('idjabatan') == '31')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>1. Sistem Pelayanan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money text-aqua"></i> <p>2. Keuangan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bank text-aqua"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>3. Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building text-primary"></i> <p>4. Umum<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>5. Jurnal</span>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('ruangbaca') }}">
                    <i class="nav-icon fa fa-book text-yellow"></i> <p>6. Ruang Baca</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>7. CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>8. BPPM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>9. GJM</p>
                    </a>
                </li>
            @elseif(Session('idjabatan') == '573' OR Session('idjabatan') == '831')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Akademik<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Jurnal</span>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '703')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money text-aqua"></i> <p>Keuangan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bank text-aqua"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building text-primary"></i> <p>Umum<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
            @elseif(Session('idjabatan') == '575')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money text-aqua"></i> <p>Keuangan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bank text-aqua"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building text-primary"></i> <p>Umum<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                @if (Session('keljabatan') == 'KASUB KEPEG FAK')
                    <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item">
                        <a href="{{ url('alihstatus') }}" class="nav-link">
                            <i class="nav-icon fa fa-gift"></i>
                            <p>Promosi Tendik Kontrak</p>
                        </a>
                    </li>
                @endif
            @elseif(Session('idjabatan') == '576')
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
            @elseif(Session('idjabatan') == '577')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Akademik<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Master Program Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    </ul>
                </li>
            @elseif(Session('idjabatan') == '578')
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Jurnal</span>
                    </a>
                </li>
            @elseif(Session('idjabatan') == '579')
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
            @else
                <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('suratkeluar') }}">
                    <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
        
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Akademik<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
        @elseif (Session('fakultas') == 'FAPET' OR Session('fakultas') == 'FEB' OR Session('fakultas') == 'FH' OR Session('fakultas') == 'FIA' OR Session('fakultas') == 'FIB' OR Session('fakultas') == 'FIKES' OR Session('fakultas') == 'FILKOM' OR Session('fakultas') == 'FISIP' OR Session('fakultas') == 'FK' OR Session('fakultas') == 'FKG' OR Session('fakultas') == 'FKH' OR Session('fakultas') == 'FMIPA' OR Session('fakultas') == 'FP' OR Session('fakultas') == 'FPIK' OR Session('fakultas') == 'FT' OR Session('fakultas') == 'FTP' OR Session('fakultas') == 'FV' OR Session('fakultas') == 'PSDKUJAKARTA' OR Session('fakultas') == 'PSLKU')
            @if(Session('keljabatan') == 'KABAG FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Akademik -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Akademik dan Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('ruangbaca') }}">
                                            <i class="nav-icon fa fa-book text-yellow"></i> <p>Ruang Baca</p>
                                            </a>
                                        </li>
                                        <li class="treeview nav-item">
                                            <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-buysellads text-yellow"></i><p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Setting<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                                    </ul>
                                                </li>
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="treeview nav-item">
                                            <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-cubes text-yellow"></i><p>Persuratan Mahasiswa<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Persurat Mahasiswa</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                    <i class="nav-icon fa fa-briefcase text-green"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                    <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><!-- Kepegawaian -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Kepegawaian <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('simpukjaverifikasi') }}">
                                                <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK
                                                @if(isset($countsimpro))
                                                    @if($countsimpro != 0)
                                                        <span class="right badge badge-danger"> {{ $countsimpro }}</span>
                                                    @endif
                                                @endif
                                                </p>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('verfikasicuti') }}/all">
                                                <i class="fa fa-users text-warning"></i> Cuti Pegawai
                                                @if(isset($countcuti))
                                                    @if($countcuti != 0)
                                                        <span class="right badge badge-danger"> {{ $countcuti }}</span>
                                                    @endif
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('listsurattugas') }}">
                                                <i class="nav-icon fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('user') }}">User Management</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><!-- Keuangan -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Keuangan <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Akreditasi</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><!-- Umum -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Umum <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('jadwalsatpam') }}">
                                            <i class="nav-icon fa fa-drupal text-yellow"></i> <p>Jadwal Satpam</p>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('simbhp') }}">
                                            <i class="nav-icon fa fa-shopping-cart text-yellow"></i> <p>SIMBHP</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB AKAD FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Akademik -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Akademik dan Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('ruangbaca') }}">
                                            <i class="nav-icon fa fa-book text-yellow"></i> <p>Ruang Baca</p>
                                            </a>
                                        </li>
                                        <li class="treeview nav-item">
                                            <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-buysellads text-yellow"></i><p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Setting<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                                    </ul>
                                                </li>
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="treeview nav-item">
                                            <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-cubes text-yellow"></i><p>Pelayanan Mahasiswa<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Persurat Mahasiswa</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                    <i class="nav-icon fa fa-briefcase text-green"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                    <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KAJUR')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                        <li class="treeview nav-item">
                                            <a class="nav-link" href="#">
                                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KPSS1')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                <li class="treeview nav-item">
                                    <a class="nav-link" href="#">
                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-briefcase text-green"></i> <p>Sarjana<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Dosen Pembimbing</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('pengumuman') }}">
                            <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                            </a>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KPSS2')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('pengumuman') }}">
                            <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                            </a>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KPSS3')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('pengumuman') }}">
                            <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                            </a>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB UMUM FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Umum -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Umum <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('jadwalsatpam') }}">
                                            <i class="nav-icon fa fa-drupal text-yellow"></i> <p>Jadwal Satpam</p>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('simbhp') }}">
                                            <i class="nav-icon fa fa-shopping-cart text-yellow"></i> <p>SIMBHP</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB KEU FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Keuangan -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Keuangan <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                            
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB KEPEG FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Kepegawaian -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Kepegawaian <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('simpukjaverifikasi') }}">
                                                <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK
                                                @if(isset($countsimpro))
                                                    @if($countsimpro != 0)
                                                        <span class="right badge badge-danger"> {{ $countsimpro }}</span>
                                                    @endif
                                                @endif
                                                </p>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('verfikasicuti') }}/all">
                                                <i class="fa fa-users text-warning"></i> Cuti Pegawai
                                                @if(isset($countcuti))
                                                    @if($countcuti != 0)
                                                        <span class="right badge badge-danger"> {{ $countcuti }}</span>
                                                    @endif
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('listsurattugas') }}">
                                                <i class="nav-icon fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('user') }}">User Management</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB UMUMKEU FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Keuangan -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Keuangan <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                            
                                    </ul>
                                </li>
                                <li class="nav-item"><!-- Umum -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Umum <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('jadwalsatpam') }}">
                                            <i class="nav-icon fa fa-drupal text-yellow"></i> <p>Jadwal Satpam</p>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('simbhp') }}">
                                            <i class="nav-icon fa fa-shopping-cart text-yellow"></i> <p>SIMBHP</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'KASUB KEUKEPEG FAK')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outsurat') }}">Surat Keluar</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Keuangan -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Keuangan <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><!-- Kepegawaian -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Kepegawaian <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('simpukjaverifikasi') }}">
                                                <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK
                                                @if(isset($countsimpro))
                                                    @if($countsimpro != 0)
                                                        <span class="right badge badge-danger"> {{ $countsimpro }}</span>
                                                    @endif
                                                @endif
                                                </p>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('verfikasicuti') }}/all">
                                                <i class="fa fa-users text-warning"></i> Cuti Pegawai
                                                @if(isset($countcuti))
                                                    @if($countcuti != 0)
                                                        <span class="right badge badge-danger"> {{ $countcuti }}</span>
                                                    @endif
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }} nav-item">
                                            <a class="nav-link" href="{{ url('listsurattugas') }}">
                                                <i class="nav-icon fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
                                            </a>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('user') }}">User Management</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Session('keljabatan') == 'BPPM')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('pengumuman') }}">
                            <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                            </a>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data BPPM<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Data Penelitian / Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @else
                @if (Session('keljabatan') == 'ATASANLANGSUNG')
                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
                @endif
            @endif
        @else
            @if (Session('keljabatan') == 'ATASANLANGSUNG')
                <li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }} nav-item"><a href="{{ url('alihstatus') }}" class="nav-link"><i class="nav-icon fa fa-gift"></i>Promosi Tendik Kontrak</a></li>
            @endif
        @endif
    @elseif(Session('previlage') == 'mahasiswa' OR Session('previlage') == 'mahasiswa magister' OR Session('previlage') == 'mahasiswa doktoral')
        @if(Session('previlage') == 'mahasiswa doktoral')
            <li class="nav-item">
                <a href="{{ url('biodatadoktoral') }}" class="nav-link {{ isset($sidebar) && $sidebar == 'biodatapasca' ? 'active' : '' }}">
                    <i class="nav-icon fa fa-users text-aqua" ></i>
                    <p>Biodata</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bank text-yellow"></i> <p>Tahapan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                @if (Session('fakultas') == 'PASCAUB')
                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                @else
                    @if(Session('jurusan') !== null)
                        @if (Session('jurusan') == 'Jurusan Biologi')
                            <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Usulan Tim Promotor</a></li>
                            <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                            <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                            <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                            <li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                            <li><a class="nav-link" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                            <li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3seminter') }}">Penilaian Seminar Internasional</a></li>
                            <li><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                            <li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                            <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            <li><a class="nav-link" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li><a class="nav-link" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        @elseif (Session('jurusan') == 'Jurusan Matematika')
                            <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
                            <li><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                            <li><a class="nav-link" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                            <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
                            <li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
                            <li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                            <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            <li><a class="nav-link" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li><a class="nav-link" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        @else
                            <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                            <li><a class="nav-link" href="{{ url('s3seminter') }}">Penilaian Seminar Ilmiah Internasional</a></li>
                            <li><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah Bereputasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskah Setelah SEMHAS</a></li>
                            <li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                            <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            <li><a class="nav-link" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                            <li><a class="nav-link" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                        @endif
                    @else
                        <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                        <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                        <li><a class="nav-link" href="{{ url('s3seminter') }}">Penilaian Seminar Ilmiah Internasional</a></li>
                        <li><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah Bereputasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskah Setelah SEMHAS</a></li>
                        <li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                        <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                        <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                        <li><a class="nav-link" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                        <li><a class="nav-link" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                    @endif
                @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li><a class="nav-link" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                    <li><a class="nav-link" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                    <li><a class="nav-link" href="{{ url('smknon') }}">Keterangan Aktif Kuliah</a></li>
                    <li><a class="nav-link" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                    <li><a class="nav-link" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                    <li><a class="nav-link" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                    <li><a class="nav-link" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                </ul>
            </li>
        @elseif(Session('previlage') == 'mahasiswa magister')
            <li class="nav-item">
                <a href="{{ url('biodatapasca') }}" class="nav-link {{ isset($sidebar) && $sidebar == 'biodatapasca' ? 'active' : '' }}">
                    <i class="nav-icon fa fa-users text-aqua" ></i>
                    <p>Biodata</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bank text-yellow"></i> <p>Tahapan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    @if (Session('fakultas') == 'PASCAUB')
                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Ujian Proposal</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Tesis</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                    @elseif (Session('fakultas') == 'FMIPA')
                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                    @else
                        <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                    @endif
                    <li><a class="nav-link" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                    <li><a class="nav-link" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li><a class="nav-link" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                    <li><a class="nav-link" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                    <li><a class="nav-link" href="{{ url('smknon') }}">Keterangan Aktif Kuliah</a></li>
                    <li><a class="nav-link" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                    <li><a class="nav-link" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                    <li><a class="nav-link" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                    <li><a class="nav-link" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ url('biodata') }}" class="nav-link {{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}">
                    <i class="nav-icon fa fa-users text-aqua" ></i>
                    <p>Biodata</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-subway text-primary"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li><a class="nav-link" href="{{ url('srtpendalamanmateri') }}">Pendalaman Materi Praktis (Magang)</a></li>
                    <li><a class="nav-link" href="{{ url('logbook') }}">Logbook Magang</a></li>
                    <li><a class="nav-link" href="{{ url('ujianmagang') }}">Ujian Magang</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-buysellads text-success"></i> <p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li><a class="nav-link" href="{{ url('dispenmhs') }}">Dispensasi</a></li>
                    <li><a class="nav-link" href="{{ url('sktmb') }}">Surat Keterangan Tidak Menerima Beasiswa</a></li>
                    <li><a class="nav-link" href="{{ url('peminatanmaba') }}">Penjaringan UKM</a></li>
                    <li><a class="nav-link" href="{{ url('ikutkegiatan') }}">Surat Keterangan Mengikuti Kegiatan</a></li>
                    <li><a class="nav-link" href="{{ url('daftarpkm') }}">Pendaftaran PKM</a></li>
                    <li><a class="nav-link" href="{{ url('prestasi') }}">Tambah Prestasi</a></li>
                    <li><a class="nav-link" href="{{ url('beasiswa') }}">Tambah Beasiswa</a></li>
                    <li><a class="nav-link" href="{{ url('kegiatan') }}">E-LPJ Kegiatan</a></li>
                    <li><a class="nav-link" href="{{ url('komplain') }}">E-Complain</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bank text-warning"></i> <p>Tahapan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                    <li><a class="nav-link" href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
                    <li><a class="nav-link" href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-envelope text-info"></i> <p>Persuratan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li><a class="nav-link" href="{{ url('srtpenelitian') }}">Ijin Penelitian</a></li>
                    <li><a class="nav-link" href="{{ url('srtanalisislab') }}">Permohonan Analisis Lab</a></li>
                    <li><a class="nav-link" href="{{ url('smkpns') }}">Keterangan Aktif Kuliah</a></li>
                    <li><a class="nav-link" href="{{ url('smkterdaftar') }}">Keterangan Terdaftar (Bagi Yang Tidak Aktif Kuliah)</a></li>
                    <li><a class="nav-link" href="{{ url('transkrip') }}">Transkrip Sementara</a></li>
                    <li><a class="nav-link" href="{{ url('srtijinpinjamalat') }}">Surat Izin Pemakaian Alat Laboratorium</a></li>
                    <li><a class="nav-link" href="{{ url('evaluasi') }}">Surat Open Blokir</a></li>
                </ul>
            </li>
        @endif
    @else
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardstaf' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardstaf') }}">
            <i class="nav-icon fa fa-dashboard"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('mailbox') }}">
            <i class="nav-icon fa fa-envelope text-danger"></i> 
                <p>Mailbox</p>
                @if(isset($countmailbox))
                    @if($countmailbox != 0)
                        <span class="right badge badge-danger">{{ $countmailbox }}</span>
                    @endif
                @endif
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('outsurat') }}">
            <i class="nav-icon fa fa-pencil-square-o"></i> <p>Surat Keluar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('suratkeluar') }}">
            <i class="nav-icon fa fa-pencil-square-o text-info"></i> <p>Surat Keluar dengan TTE</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('serfitikatwithtte') }}"><i class="nav-icon fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
    @endif
    @if(Session('previlage') == 'mahasiswa' OR Session('previlage') == 'mahasiswa magister' OR Session('previlage') == 'mahasiswa doktoral')
        <li class="nav-header">==========================</li>
        <li class="{{ isset($sidebar) && $sidebar == 'buatqr' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('buatqr') }}">
            <i class="nav-icon fa fa-qrcode text-warning"></i> <p>QrCode Creator</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('logout') }}">
            <i class="nav-icon fa fa-power-off text-primary"></i> <p>Logout</p>
            </a>
        </li>
    @else
        @if(Session('fakultas') == 'FV')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Master Program Studi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                </ul>
            </li>
            @if(Session('previlage') == 'Staf Kemahasiswaan')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                    </ul>
                </li>
            @elseif(Session('previlage') == 'Staf Akademik')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Pelaporan Deteksi Plagiasi</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-green"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Setting Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Ujian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Session('previlage') == 'Staf Keuangan')
                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('presensidosen') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Rekap Presensi Dosen</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'PEJABAT' OR Session('previlage') == 'pejabat')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Setting<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                                <li><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                <li><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                <li><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                <li><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Laporan Adm. Deteksi Plagiasi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Ujian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                    </ul>
                </li>
            @endif
        @endif
        @if(Session('fakultas') == 'PASCAUB')
            <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
            @if(Session('previlage') == 'Staf Sub.Bag.Akademik dan Kemahasiswaan')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Master Program Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Sistem Pelayanan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
            @elseif(Session('previlage') == 'Staf Sub.Bag.Umum dan Keuangan')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Gaji<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
            @elseif(Session('previlage') == 'Tim Jurnal')
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Jurnal</span>
                    </a>
                </li>
            @elseif(Session('previlage') == 'Tim Umum')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building text-primary"></i> <p>Umum<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                    </ul>
                </li>
            @elseif(Session('previlage') == 'Tim Pendaftaran')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
            @elseif(Session('previlage') == 'Tim Ruang Baca')
                <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('ruangbaca') }}">
                    <i class="nav-icon fa fa-book text-yellow"></i> <p>Ruang Baca</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'Tim Pendaftaran GJM BPPM')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'Tim Beasiswa, BPPM, GJM, Pendaftaran')
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'Tim Beasiswa, Akademik, GJM, BPPM, Pendaftaran')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Master Program Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Sistem Pelayanan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'Tim Umum, GJM, BPPM')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building text-primary"></i> <p>Umum<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>BPPM</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'Sekretaris GJM')
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>GJM</p>
                    </a>
                </li>
            @elseif(Session('previlage') == 'admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cubes text-yellow"></i> <p>1. Sistem Pelayanan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money text-aqua"></i> <p>2. Keuangan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bank text-aqua"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>3. Beasiswa<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li><a class="nav-link" href="{{ url('databeasiswa') }}"><i class="nav-icon fa fa-address-card"></i> Database Beasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building text-primary"></i> <p>4. Umum<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('adminplagiasi') }}">
                    <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>5. Jurnal</span>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('ruangbaca') }}">
                    <i class="nav-icon fa fa-book text-yellow"></i> <p>6. Ruang Baca</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>7. CAMABA<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2') }}">Magister</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3') }}">Doktor</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('swakelola') }}">
                    <i class="nav-icon fa fa-building text-yellow"></i> <p>8. BPPM</p>
                    </a>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('lapkuisioner') }}">
                    <i class="nav-icon fa fa-pencil text-yellow"></i> <p>9. GJM</p>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bank text-yellow"></i> <p>Administrasi<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Master Program Studi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    </ul>
                </li>
            @endif
        @endif
        @if(Session('spesial') == 'Admin Bantuan Studi')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Bantuan Studi dan Publikasi<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanadmin') }}">Admin Bantuan</a></li>
            </ul>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminriset') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Penerima Dana Riset dan PKM</p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Bantuan Publikasi')
            <li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>Bantuan Publikasi<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan</a></li>
            </ul>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('bantuanadminriset') }}">
                <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                    <p>Penerima Dana Riset dan PKM</p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Peminjaman')
            <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Administrasi <i class="nav-icon fa fa-building"></i> dan <i class="nav-icon fa fa-taxi"></i><i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
            </ul>
            </li>
        @else
            <li class="{{ isset($sidebar) && $sidebar == 'simpen' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('simpen') }}">
                <i class="nav-icon fa fa-building text-danger"></i> <p>SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin SPD')
            <li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-calendar-plus-o text-aqua"></i> <p>SI PD<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
            </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Admin SK')
            <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('outperaturan') }}">
                <i class="nav-icon fa fa-book text-warning"></i> <p>SK dan Peraturan</p>
                </a>
            </li>
            @if (Session('fakultas') == 'KP')
                <li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }} nav-item">
                    <a class="nav-link" href="{{ url('bantuanadminriset') }}">
                    <i class="nav-icon fa fa-mortar-board text-yellow"></i> 
                        <p>Penerima Dana Riset dan PKM</p>
                    </a>
                </li>
            @endif
            <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
            <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
        @endif
        @if(Session('spesial') == 'Admin Ecek')
            <li class="{{ isset($sidebar) && $sidebar == 'ecek' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-credit-card text-danger"></i> <p>E-Cek<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'ecekadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ecekadmin') }}">E-Cek Admin</a></li>
            </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Bendahara Gaji')
            @if (Session('fakultas') == 'FIKES')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <!-- Pelayanan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><!-- Keuangan -->
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Keuangan <i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-calendar-plus-o text-primary"></i> <p>Sistem Penggajian<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-credit-card text-aqua"></i> <p>SPD Online<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdadmin') }}">Admin SPD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sppdsetting') }}">Setting</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-money text-yellow"></i> <p>SIPAGU<i class="fa fa-angle-left right"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagu') }}">Set Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pagugu') }}">Set Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
                                                <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporankeuhpt') }}">Laporan</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
                                            
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                    <a class="nav-link" href="{{ url('pengumuman') }}">
                                    <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Data Tambahan -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('keucontrol') }}">Data Keuangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Report -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"> <!-- Arsiparis -->
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsiparis Dinamis<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                                    </ul>
                                </li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
                            </ul>
                        </li>
                        <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                            <a class="nav-link" href="{{ url('antritte') }}">
                            <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item">
                    <a href="{{ url('dosenpenguji') }}" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Dosen Penguji
                            {{ isset($notifdosenpenguji) ? $notifdosenpenguji : '' }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calculator text-warning"></i> <p>SIGAP<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('karyawan') }}">Penerima Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gaji') }}">Laporan Gaji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('gajisetting') }}">Setting</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('espete') }}">SPT Tahunan</a></li>
                    </ul>
                </li>
            @endif
            <li class="{{ isset($sidebar) && $sidebar == 'ujiandinas' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('ujiandinas') }}">
                <i class="nav-icon fa fa-pencil text-danger"></i> 
                    <p>UJIAN</p>
                </a>
            </li>
        @else
            <li class="{{ isset($sidebar) && $sidebar == 'gajiuser' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('gajiuser') }}">
                <i class="nav-icon fa fa-money text-danger"></i> 
                    <p>SIGAP</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'ujiandinas' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('ujiandinas') }}">
                <i class="nav-icon fa fa-pencil text-danger"></i> 
                    <p>UJIAN</p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Bendahara Jurusan')
            <li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('datakeuhptmasuk') }}">
                <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Data Masuk</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('laporankeuhpt') }}">
                <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Laporan</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'settingkeuhpt' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('settingkeuhpt') }}">
                <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Setting</p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin SIDOKAR' OR Session('spesial') == 'Admin DISTENDIK')
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-users text-aqua"></i> <p>SI DIKTENDIK
                @if(isset($countsidokar))
                    @if($countsidokar != 0)
                    <span class="right badge badge-danger"> {{ $countsidokar }}</span>
                    @endif
                @endif
                <i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboarddokar') }}">Dashboard</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('outperaturan') }}">SK dan Peraturan</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
                @if(Session('fakultas') == 'KP')
                    <li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }} nav-item">
                        <a class="nav-link" href="{{ url('verifikatorkgb') }}">
                            Verifikasi KGB
                            @if(isset($countsidokar))
                                @if($countsidokar != 0)
                                    <span class="right badge badge-danger"> {{ $countsidokar }}</span>
                                @endif
                            @endif
                        </a>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('inpassinggaji') }}">SK Penyesuain Gaji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('skkontrak') }}">Draft SK Kontrak</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('udin') }}">Ujian Dinas</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('latsaradmin') }}">LATSAR</a></li>
					<li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Berkas PAK<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">Usul Penilaian Angka Kredit Kenaikan Jabatan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">SK Tunjangan Fungsional Dosen</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">SK Pengangkatan Pertama kali dalam Jabatan Akademik</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">SURAT PERNYATAAN MELAKSANAKAN TUGAS</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">Pengantar dari Fakultas ke KP</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">Pengantar Revisi Usulan/Pengembalian/Penolakan ke Fakultas</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">Nota Dinas Usul Pertimbangan / Persetujuan Senat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">Permintaan Kuisioner (Dari Senat)</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('berkaspak') }}">DUPAK</a></li>
                        </ul>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dokarsetting') }}">Setting</a></li>
                @endif
                    <li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }} nav-item">
                        <a class="nav-link" href="{{ url('verfikasicuti') }}/all">
                            <i class="fa fa-users text-warning"></i> Cuti Pegawai
                            @if(isset($countcuti))
                                @if($countcuti != 0)
                                    <span class="right badge badge-danger"> {{ $countcuti }}</span>
                                @endif
                            @endif
                        </a>
                    </li>
                    <li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('user') }}">Setting Pejabat</a></li>
                </ul>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('simpukjaverifikasi') }}">
                    <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK
                    @if(isset($countsimpro))
                        @if($countsimpro != 0)
                            <span class="right badge badge-danger"> {{ $countsimpro }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin SIMPRO-SENAT')
            <li class="{{ isset($sidebar) && $sidebar == 'simprosenat' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('simprosenat') }}">
                    <i class="nav-icon fa fa-search text-primary"></i> <p>SIMPRO-PAK
                    @if(isset($countsimprosenat))
                        @if($countsimprosenat != 0)
                            <span class="right badge badge-danger"> {{ $countsimprosenat }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Operator Prodi S1')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i>
                    <p>Administrasi dan Persuratan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Setting Prodi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                </ul>
            </li>
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                </ul>
            </li>
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i><p>Tahapan Prodi S1<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Operator Prodi S2')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i><p>Administrasi dan Persuratan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Setting Prodi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                </ul>
            </li>
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i><p>Tahapan Prodi S2<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Operator Prodi S3')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i><p>Administrasi dan Persuratan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Setting Prodi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                </ul>
            </li>
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i><p>Tahapan Prodi S3<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Pramu Kelas')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-cubes text-yellow"></i><p>Jadwal Perkuliahan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">Jadwal Mahasiswa</a></li>
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Akademik')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-buysellads text-yellow"></i><p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="treeview nav-item">
                        <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Setting<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                        </ul>
                    </li>
                    <li class="treeview nav-item">
                        <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                        </ul>
                    </li>
                    <li class="treeview nav-item">
                        <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            @if(Session('fakultas') == 'FMIPA')
                <li class="treeview nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-cubes text-yellow"></i><p>Pelayanan (SEMUA JURUSAN)<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                            </ul>
                        </li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="treeview nav-item">
                                    <a class="nav-link" href="#">
                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Jurusan Biologi<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="treeview nav-item">
                                    <a class="nav-link" href="#">
                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Jurusan Matematika<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                        <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
                                        <li><a class="nav-link" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
                                        <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                                        <li><a class="nav-link" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                                        <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
										<li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
										<li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
										<li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                        <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                                <li class="treeview nav-item">
                                    <a class="nav-link" href="#">
                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>ALL Jurusan<i class="fa fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i><p>CAMABA MAGISTER<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2biologi') }}"> Biologi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2fisika') }}"> Fisika</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2matematika') }}"> Matematika</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2kimia') }}"> Kimia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2statistika') }}"> Statistika</a></li>
                            </ul>
                        </li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i><p>CAMABA DOKTOR<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3biologi') }}">Biologi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3fisika') }}">Fisika</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3matematika') }}">Matematika</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3kimia') }}">Kimia</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3statistika') }}">Statistika</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @else 
                <li class="treeview nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-cubes text-yellow"></i><p>Administrasi dan Persuratan<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">Setting Prodi</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                    </ul>
                </li>
                <li class="treeview nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-cubes text-yellow"></i><p>Pelayanan JURUSAN<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                            </ul>
                        </li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="treeview nav-item">
                            <a class="nav-link" href="#">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
        @endif
        @if(Session('spesial') == 'Admin Kemahasiswaan')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i><p>Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Admin AkaddanKmh')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-gears text-yellow"></i> <p>SIFAKULTAS <i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"> <!-- Pelayanan -->
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Pelayanan<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><!-- Akademik -->
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-buysellads text-yellow"></i> <p>Akademik dan Kemahasiswaan<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }} nav-item">
                                        <a class="nav-link" href="{{ url('ruangbaca') }}">
                                        <i class="nav-icon fa fa-book text-yellow"></i> <p>Ruang Baca</p>
                                        </a>
                                    </li>
                                    <li class="treeview nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="nav-icon fa fa-buysellads text-yellow"></i><p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="treeview nav-item">
                                                <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Setting<i class="fa fa-angle-left right"></i></p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Ruang</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('settingjadwal') }}">Setting</a></li>
                                                </ul>
                                            </li>
                                            <li class="treeview nav-item">
                                                <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadharian') }}">View Harian</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                                                </ul>
                                            </li>
                                            <li class="treeview nav-item">
                                                <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Jadwal Ujian<i class="fa fa-angle-left right"></i></p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="treeview nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="nav-icon fa fa-cubes text-yellow"></i><p>Pelayanan Mahasiswa<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Persurat Mahasiswa</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakegiatan') }}">E-LPJ</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datapkm') }}">Laporan PKM</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
                                            <li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Prodi<i class="fa fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                                            <li class="treeview nav-item">
                                                <a class="nav-link" href="#">
                                                <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Magang<i class="fa fa-angle-left right"></i></p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="nav-icon fa fa-briefcase text-green"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Seminar Proposal</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                    <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                                                </ul>
                                            </li>
                                            @if(Session('fakultas') == 'FMIPA')
                                                <li class="treeview nav-item">
                                                    <a class="nav-link" href="#">
                                                    <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Doktor<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="treeview nav-item">
                                                            <a class="nav-link" href="#">
                                                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Jurusan Biologi<i class="fa fa-angle-left right"></i></p>
                                                            </a>
                                                            <ul class="nav nav-treeview">
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="treeview nav-item">
                                                            <a class="nav-link" href="#">
                                                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>Jurusan Matematika<i class="fa fa-angle-left right"></i></p>
                                                            </a>
                                                            <ul class="nav nav-treeview">
                                                                <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                                                <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="treeview nav-item">
                                                            <a class="nav-link" href="#">
                                                            <i class="nav-icon fa fa-briefcase text-yellow"></i><p>ALL Jurusan<i class="fa fa-angle-left right"></i></p>
                                                            </a>
                                                            <ul class="nav nav-treeview">
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                    <i class="nav-icon fa fa-briefcase text-green"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi</a></li>
                                                        <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                                    </ul>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
            
                                </ul>
                            </li>
                            <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item">
                                <a class="nav-link" href="{{ url('pengumuman') }}">
                                <i class="nav-icon fa fa-bullhorn text-success"></i> <p>Pengumuman</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"> <!-- Data Tambahan -->
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Data Tambahan<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('swakelola') }}">Swakelola</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"> <!-- Report -->
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Report (Under Construction)<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('datakeluhan') }}">E-Complain</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori6') }}">6. Pendidikan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori7') }}">7. Penelitian</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Jurusan Biologi' OR Session('spesial') == 'Admin Jurusan Fisika' OR Session('spesial') == 'Admin Jurusan Matematika' OR Session('spesial') == 'Admin Jurusan Kimia' OR Session('spesial') == 'Admin Jurusan Statistika')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Jurusan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangan') }}">Setting Ruang Ujian</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                        </ul>
                    </li>
                    @if(Session('spesial') == 'Admin Jurusan Biologi')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Jurusan Biologi<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA <i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2biologi') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3biologi') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('spesial') == 'Admin Jurusan Fisika')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2fisika') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3fisika') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('spesial') == 'Admin Jurusan Matematika')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
                                <li><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
                                <li><a class="nav-link" href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
                                <li><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
                                <li><a class="nav-link" href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
                                <li><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
                                <li><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                <li><a class="nav-link" href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
                                <li><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
                                <li><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                <li><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                <li><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2matematika') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3matematika') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('spesial') == 'Admin Jurusan Statistika')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2statistika') }}"> Magister</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3statistika') }}"> Doktor</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2kimia') }}"> Magister</a></li>
                                    <li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3kimia') }}"> Doktor</a></li>
                                </ul>
                            </li>
                        @endif
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Jurusan Sosial Ekonomi Pertanian' OR Session('spesial') == 'Admin Jurusan Budidaya Pertanian' OR Session('spesial') == 'Admin Jurusan Tanah' OR Session('spesial') == 'Admin Jurusan Hama dan Penyakit Tumbuhan' OR Session('spesial') == 'Admin Ilmu Pertanian')
            <li class="treeview nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-buysellads text-yellow"></i><p>Jadwal Kuliah<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="treeview nav-item">
                        <a class="nav-link" href="#">
                        <i class="nav-icon fa fa-calendar-plus-o text-info"></i><p>Penjadwalan<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cubes text-yellow"></i> <p>Pelayanan Jurusan<i class="fa fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('pengumuman') }}">Pengumuman</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
                    <li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Magang<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Sarjana/Magister<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('judul') }}">Pengajuan Judul</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('sempro') }}">Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('ujian') }}">Ujian Akhir</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('yudisium') }}">Yudisium</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-briefcase text-yellow"></i> <p>Doktor<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3sempeng' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3sempeng') }}">Seminar Pengajuan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3seminter') }}">Seminar Internasional</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3publikasi') }}">Publikasi Ilmiah</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3yudisium') }}">Yudisium</a></li>
                            <li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('s3wisuda') }}">Wisuda</a></li>
                        </ul>
                    </li>
                    @if(Session('spesial') == 'Admin Jurusan Sosial Ekonomi Pertanian')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2se' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2se') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3se' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3se') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('spesial') == 'Admin Jurusan Budidaya Pertanian')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2bp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2bp') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3bp' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3bp') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('spesial') == 'Admin Jurusan Tanah')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2tanah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2tanah') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3tanah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3tanah') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @elseif(Session('spesial') == 'Admin Jurusan Hama dan Penyakit Tumbuhan')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas2hpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas2hpt') }}"> Magister</a></li>
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3hpt' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3hpt') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-calendar-plus-o text-yellow"></i> <p>CAMABA<i class="fa fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="{{ isset($sidebar) && $sidebar == 'camabas3pertanian' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('camabas3pertanian') }}"> Doktor</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(Session('spesial') == 'esign')
            <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('antritte') }}">
                <i class="nav-icon fa fa-dashboard text-success"></i> <p>TTE Report
                    @if(isset($countantritte))
                        @if($countantritte != 0)
                            <span class="right badge badge-danger">{{ $countantritte }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Hasil LAB Klinik UB')
            <li class="{{ isset($sidebar) && $sidebar == 'suratlabklinik' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('suratlabklinik') }}">
                <i class="nav-icon fa fa-flask text-success"></i> <p>Hasil Lab</p>
                </a>
            </li>
        @endif
        @if(Session('spesial') == 'Admin Akademik KP')
		    <li class="{{ isset($sidebar) && $sidebar == 'suratakademikkp' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('suratakademikkp') }}">
                <i class="nav-icon fa fa-flask text-success"></i> <p>Terminal Kuliah</p>
                </a>
            </li>
        @endif
        @if(Session('previlage') == 'developer' OR Session('previlage') == 'Arsiparis Umum' OR Session('previlage') == 'Sekretaris Ka.Biro Keuangan' OR Session('previlage') == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR Session('previlage') == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR Session('previlage') == 'Sekretaris Bagian Akutansi' OR Session('previlage') == 'Sekretaris Senat UB' OR Session('previlage') == 'Sekretaris' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Akademik' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR Session('previlage') == 'Sekretaris Rektor' OR Session('previlage') == 'Sekretaris Dekan' OR Session('previlage') == 'Sekretaris WD I' OR Session('previlage') == 'Sekretaris WD II' OR Session('previlage') == 'Sekretaris WD III' OR Session('previlage') == 'Tata Usaha' OR Session('previlage') == 'Kepala Subbagian Kearsipan dan Hubungan Masyarakat')
            <li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('antritte') }}">
                <i class="nav-icon fa fa-black-tie text-success"></i> <p>TTE Admin</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Arsip Dinamis<i class="fa fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Substantif<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubaktif') }}">Aktif</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar-plus-o text-info"></i> <p>Arsip Fasilitatif<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasaktif') }}">Aktif</a></li>
                        <li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
                    </ul>
                </li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsippermanen') }}">Permanen</a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ url('arsipmusnah') }}">Musnah</a></li>
            </ul>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('statistik') }}">
                <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Statistik</p>
                </a>
            </li>
        @else
            <li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('arsipmasuk') }}">
                <i class="nav-icon fa fa-folder  text-aqua"></i> <p>Arsip Surat Masuk</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('arsipkeluar') }}">
                <i class="nav-icon fa fa-envelope  text-magenta"></i> <p>Arsip Surat Keluar</p>
                </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('statistik') }}">
                <i class="nav-icon fa fa-line-chart text-yellow"></i> <p>Statistik</p>
                </a>
            </li>
        @endif
        <li class="nav-header">==========================</li>
        @if (Session('previlage') != 'developer' AND Session('id') == 2)
            <li class="{{ isset($sidebar) && $sidebar == 'developing' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{ url('developing') }}">
                <i class="nav-icon fa fa-dashboard text-primary"></i> <p>Developing
                    @if(isset($counttugas))
                        @if($counttugas != 0)
                            <span class="right badge badge-danger">{{ $counttugas }}</span>
                        @endif
                    @endif
                    </p>
                </a>
            </li>
        @endif	
        <li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('bpjsadmin') }}">
            <i class="nav-icon fa fa-medkit text-green"></i> <p>Data BPJS</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('dashboardwebinar') }}">
            <i class="nav-icon fa fa-cloud-upload text-green"></i> <p>Rapat/Webinar</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'todolist' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('todolist') }}">
            <i class="nav-icon fa fa-calendar-check-o text-info"></i> <p>To Do List</p>
            </a>
        </li>
        <li class="{{ isset($sidebar) && $sidebar == 'buatqr' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{ url('buatqr') }}">
            <i class="nav-icon fa fa-qrcode text-warning"></i> <p>QrCode Creator</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{ url('manualbook') }}">
            <i class="nav-icon fa fa-book text-danger"></i> <p>Manual Book</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('logout') }}">
            <i class="nav-icon fa fa-power-off text-primary"></i> <p>Logout</p>
            </a>
        </li>
    @endif
@else
    <li><a class="nav-link" href="{{ url('/') }}"><i class="nav-icon fa fa-power-on text-primary"></i> <p>Home</p></a></li>
    @php
        $servername = $_SERVER['SERVER_NAME'];
        if ($servername == 'https://fikes.ub.ac.id' OR $servername == 'http://fikes.ub.ac.id' OR $servername == 'fikes.ub.ac.id'){
    @endphp
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Profil<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Sekilas </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Sejarah </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Struktur Organisasi </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Visi, Misi dan Tujuan </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Profil Dosen </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Profil Tendik </a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Program Studi<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">S1 Ilmu Gizi </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">S1 Keperawatan </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Profesi Dietisien </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Profesi Ners </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">S2 Keperawatan </a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Akademik dan Kemahasiswaan<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Kalender Akademik </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Jadwal Perkuliahan </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Pendaftaran </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Prestasi </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Beasiswa </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Alumni </a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Penelitian, Publikasi dan Kerjasama<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Penelitian </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Publikasi </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Kerjasama </a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Layanan<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li><a class="dropdown-item" href="https://sco.ub.ac.id/fikes/">Administrasi </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">KEPK </a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-paper-plane-o text-info"></i> <p>Penjaminan Mutu<i class="fa fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">SPME </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">SPMI </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Tracestudy </a></li>
                <li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('biodata') }}">Survey </a></li>
            </ul>
        </li>
    @php
        }
    @endphp
    
@endif
