@if(Session('fakultas') == 'RSPHMLG' OR Session('fakultas') == 'DPM' OR Session('fakultas') == 'RSPHSKR' OR Session('fakultas') == 'PDP')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="suratmenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Main Menu</a>
        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
            @if(Session('previlage') == 'administrasi')
                @if(Route::current() !== null AND Route::current()->getName() == 'dashboardagendaris')
                    <li><a href="#" class="dropdown-item btnopenmailbox"><i class="fa fa-book"></i> Mailbox</a></li>
                    <li><a href="#" class="dropdown-item btnopensuratmasuk"><i class="fa fa-envelope"></i> Tambah Surat Masuk</a></li>
                    <li><a href="#" class="dropdown-item btnopensuratkeluar"><i class="fa fa-paper-plane-o"></i> Tambah Surat Keluar</a></li>
                    <li><a href="#" class="dropdown-item btnopenskdanperaturan"><i class="fa fa-clone"></i> Tambah SK dan Peraturan</a></li>
                    <li><a href="#" class="dropdown-item btnopendataevent"><i class="fa fa-calendar-plus-o"></i> Event / Organizer</a></li>
                    <li><a href="#" class="dropdown-item btnopendatanotulensi"><i class="fa fa-edit"></i> Notulensi</a></li>
                @else 
                    <li><a class="dropdown-item" href="{{ url('/') }}"><i class="fa fa-envelope"></i>Mailbox</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ url('pengumuman') }}"><i class="fa fa-bullhorn"></i> Pengumuman</a></li>
                <li><a class="dropdown-item" href="{{ url('persuratanpt') }}"><i class="fa fa-user-md"></i> Persuratan PT</a></li>
                <li><a class="dropdown-item" href="{{ url('persuratanrs') }}"><i class="fa fa-stethoscope"></i> Persuratan RS</a></li>
                <li><a class="dropdown-item" href="{{ url('dashboardarsip') }}"><i class="fa fa-database"></i> Arsip</a></li>
            @elseif(Session('previlage') == 'Admin SDM' OR Session('previlage') == 'administarator')
                @if(Route::current() !== null AND Route::current()->getName() == 'dashboardsdm')
                    <li><a href="#" class="dropdown-item btnopenmailbox"><i class="fa fa-book"></i> Mailbox</a></li>
                    <li><a href="#" class="dropdown-item btnopensuratkeluar"><i class="fa fa-paper-plane-o"></i> Tambah Surat Keluar</a></li>
                    <li><a href="#" class="dropdown-item btnopenskdanperaturan"><i class="fa fa-clone"></i> Tambah SK dan Peraturan</a></li>
                    <li><a href="#" class="dropdown-item btnopendataevent"><i class="fa fa-calendar-plus-o"></i> Event / Organizer</a></li>
                    <li><a href="#" class="dropdown-item btnopendatanotulensi"><i class="fa fa-edit"></i> Notulensi</a></li>
                @else 
                    <li><a class="dropdown-item" href="{{ url('/') }}"><i class="fa fa-envelope"></i>Mailbox</a></li>
                @endif
                @if(Route::current() !== null AND Route::current()->getName() == 'viewPersuratanPT')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="listmenuform" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Form</a>
                        <ul aria-labelledby="listmenuform" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item btnopenforma1">Cuti Tahunan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforma2">Cuti Keagamaan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforma3">Ijin Pulang Cepat</a></li>
                            <li><a href="#" class="dropdown-item btnopenforma4">Ijin Keluar Kantor</a></li>
                            <li><a href="#" class="dropdown-item btnopenforma5">Permintaan Pegawai</a></li>
                            <li><a href="#" class="dropdown-item btnopenforma6">Mutasi Rotasi</a></li>
                            <li><a href="#" class="dropdown-item btnopenforma7">Komunikasi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="listmenusk" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keputusan Direktur</a>
                        <ul aria-labelledby="listmenusk" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item btnopenformb1">Pengangkatan Jabatan</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb2">Pemberhentian Jabatan</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb3">Pegawai Tetap</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb4">Dokter Tetap</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb5">Penerimaan Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb6">Penonaktifan Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb7">Pengaktifan Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb8">Mutasi</a></li>
                            <li><a href="#" class="dropdown-item btnopenformb9">Penonaktifan Dokter Tetap</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="listmenukk" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kontrak Kerja</a>
                        <ul aria-labelledby="listmenukk" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item btnopenformc1">Perjanjian Orientasi Kerja</a></li>
                            <li><a href="#" class="dropdown-item btnopenformc2">PKWT</a></li>
                            <li><a href="#" class="dropdown-item btnopenformc3">PKWTT</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="listmenuss" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Surat-Surat</a>
                        <ul aria-labelledby="listmenuss" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item btnopenformd1">SPO</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme1">Edaran</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme2">Peringatan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme3">Balasan Penambahan Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme4">Permohonan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme5">Tugas</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme6">Pemberitahuan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme7">Tanggapan Resign</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme8">Referensi Kerja</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme9">Keterangan Aktif Bekerja</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme10">Pemutusan Hubungan Kerja</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme11">Pemanggilan Calon Karyawan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme12">Pemberitahuan Lolos Seleksi</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme13">Pemberitahuan MCU</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme14">Undangan</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme15">Pemanggilan KIE Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenforme16">Keterangan Tidak Bekerja</a></li>
                        </ul>
                    </li>
                @else 
                    <li><a class="dropdown-item" href="{{ url('persuratanpt') }}"><i class="fa fa-user-md"></i> Persuratan PT</a></li>
                @endif
                @if(Route::current() !== null AND Route::current()->getName() == 'viewPersuratanRS')
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="listmenuformrs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Form</a>
                        <ul aria-labelledby="listmenuformrs" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item btnopenformf1">Tanda Terima Titipan Ijasah</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf2">Visitor Tamu</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf3">Konseling Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf4">Libur Akreditasi</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf5">Serah Terima</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf6">Riwayat Pelatihan</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf7">Pengajuan</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf8">Penyelesaian Kewajiban</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf9">Penggabungan Libur</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf10">Cuti MS</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf11">Infus On Call</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf12">Lembur</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf13">Finger Print</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf14">Perintah On Call</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf15">Ijin Dokter</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf16">Ijin Staf</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf17">Tukar Jadwal</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf18">Pendelegasian Tugas</a></li>
                            <li><a href="#" class="dropdown-item btnopenformf19">Permohonan Karyawan Baru</a></li>
                        </ul>
                    </li>
                @else 
                    <li><a class="dropdown-item" href="{{ url('persuratanrs') }}"><i class="fa fa-stethoscope"></i> Persuratan RS</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ url('siapiket') }}"><i class="fa fa-bullhorn"></i> Presensi</a></li>
                <li><a class="dropdown-item" href="{{ url('pengumuman') }}"><i class="fa fa-bullhorn"></i> Pengumuman</a></li>
                <li><a class="dropdown-item" href="{{ url('settingpejabat') }}"><i class="fa fa-users"></i> Sumberdaya Manusia</a></li>
                <li><a class="dropdown-item" href="{{ url('gaji') }}"><i class="fa fa-money"></i> Payrol</a></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="rekrutmentmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Rekrutmen</a>
                    <ul aria-labelledby="rekrutmentmenu" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('masterformasi') }}">Formasi Lowongan</a></li>
                        <li><a class="dropdown-item" href="{{ url('banksoal') }}">Soal Ujian Kompetensi</a></li>
                    </ul>
                </li>
            @elseif(Session('previlage') == 'PEJABAT')
                @if(Route::current() !== null AND Route::current()->getName() == 'dashboardpimpinan')
                    <li><a href="#" class="dropdown-item btnopenmailbox"><i class="fa fa-book"></i> Mailbox</a></li>
                    <li><a href="#" class="dropdown-item btnopentandatangan"><i class="fa fa-envelope"></i> Mohon Paraf / TTD</a></li>
                    <li><a href="#" class="dropdown-item btnnotadinas"><i class="fa fa-pencil-square-o"></i> Nota Dinas</a></li>
                    <li><a href="#" class="dropdown-item btnmemo"><i class="fa fa-sticky-note-o"></i> Memo</a></li>
                    <li><a href="#" class="dropdown-item btnopendataevent"><i class="fa fa-calendar-plus-o"></i> Event / Organizer</a></li>
                    <li><a href="#" class="dropdown-item btnopendatanotulensi"><i class="fa fa-edit"></i> Notulensi</a></li>
                @else 
                    <li><a class="dropdown-item" href="{{ url('/') }}"><i class="fa fa-envelope"></i>Mailbox</a></li>
                @endif
                @if (Session('idjabatan') == '5' OR Session('idjabatan') == '76' OR Session('idjabatan') == '97'  OR Session('idjabatan') == '100' OR Session('idjabatan') == '114')
                    @if(Route::current() !== null AND Route::current()->getName() == 'viewPersuratanPT')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="listmenuform" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Form</a>
                            <ul aria-labelledby="listmenuform" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item btnopenforma1">Cuti Tahunan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforma2">Cuti Keagamaan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforma3">Ijin Pulang Cepat</a></li>
                                <li><a href="#" class="dropdown-item btnopenforma4">Ijin Keluar Kantor</a></li>
                                <li><a href="#" class="dropdown-item btnopenforma5">Permintaan Pegawai</a></li>
                                <li><a href="#" class="dropdown-item btnopenforma6">Mutasi Rotasi</a></li>
                                <li><a href="#" class="dropdown-item btnopenforma7">Komunikasi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="listmenusk" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keputusan Direktur</a>
                            <ul aria-labelledby="listmenusk" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item btnopenformb1">Pengangkatan Jabatan</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb2">Pemberhentian Jabatan</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb3">Pegawai Tetap</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb4">Dokter Tetap</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb5">Penerimaan Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb6">Penonaktifan Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb7">Pengaktifan Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb8">Mutasi</a></li>
                                <li><a href="#" class="dropdown-item btnopenformb9">Penonaktifan Dokter Tetap</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="listmenukk" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kontrak Kerja</a>
                            <ul aria-labelledby="listmenukk" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item btnopenformc1">Perjanjian Orientasi Kerja</a></li>
                                <li><a href="#" class="dropdown-item btnopenformc2">PKWT</a></li>
                                <li><a href="#" class="dropdown-item btnopenformc3">PKWTT</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="listmenuss" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Surat-Surat</a>
                            <ul aria-labelledby="listmenuss" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item btnopenformd1">SPO</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme1">Edaran</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme2">Peringatan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme3">Balasan Penambahan Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme4">Permohonan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme5">Tugas</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme6">Pemberitahuan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme7">Tanggapan Resign</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme8">Referensi Kerja</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme9">Keterangan Aktif Bekerja</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme10">Pemutusan Hubungan Kerja</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme11">Pemanggilan Calon Karyawan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme12">Pemberitahuan Lolos Seleksi</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme13">Pemberitahuan MCU</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme14">Undangan</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme15">Pemanggilan KIE Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenforme16">Keterangan Tidak Bekerja</a></li>
                            </ul>
                        </li>
                    @else 
                        <li><a class="dropdown-item" href="{{ url('persuratanpt') }}"><i class="fa fa-user-md"></i> Persuratan PT</a></li>
                    @endif
                    @if(Route::current() !== null AND Route::current()->getName() == 'viewPersuratanRS')
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="listmenuformrs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Form</a>
                            <ul aria-labelledby="listmenuformrs" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item btnopenformf1">Tanda Terima Titipan Ijasah</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf2">Visitor Tamu</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf3">Konseling Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf4">Libur Akreditasi</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf5">Serah Terima</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf6">Riwayat Pelatihan</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf7">Pengajuan</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf8">Penyelesaian Kewajiban</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf9">Penggabungan Libur</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf10">Cuti MS</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf11">Infus On Call</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf12">Lembur</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf13">Finger Print</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf14">Perintah On Call</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf15">Ijin Dokter</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf16">Ijin Staf</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf17">Tukar Jadwal</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf18">Pendelegasian Tugas</a></li>
                                <li><a href="#" class="dropdown-item btnopenformf19">Permohonan Karyawan Baru</a></li>
                            </ul>
                        </li>
                    @else 
                        <li><a class="dropdown-item" href="{{ url('persuratanrs') }}"><i class="fa fa-stethoscope"></i> Persuratan RS</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ url('pengumuman') }}"><i class="fa fa-bullhorn"></i> Pengumuman</a></li>
                    <li><a class="dropdown-item" href="{{ url('siapiket') }}"><i class="fa fa-bullhorn"></i> Presensi</a></li>
                    <li><a class="dropdown-item" href="{{ url('settingpejabat') }}"><i class="fa fa-users"></i> Sumberdaya Manusia</a></li>
                    <li><a class="dropdown-item" href="{{ url('gaji') }}"><i class="fa fa-money"></i> Payrol</a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="rekrutmentmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Rekrutmen</a>
                        <ul aria-labelledby="rekrutmentmenu" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('masterformasi') }}">Formasi Lowongan</a></li>
                            <li><a class="dropdown-item" href="{{ url('banksoal') }}">Soal Ujian Kompetensi</a></li>
                        </ul>
                    </li>
                @endif
                <li><a class="dropdown-item" href="{{ url('dashboardarsip') }}"><i class="fa fa-database"></i> Arsip</a></li>
            @else
                @if (Route::current()->getName() !== null AND Route::current()->getName() == 'dashboardstaf')
                    <li><a href="#" class="dropdown-item btnopenmailbox"><i class="fa fa-book"></i> Mailbox</a></li>
                    <li><a href="#" class="dropdown-item btnopendatanotulensi"><i class="fa fa-edit"></i> Notulensi</a></li>
                @else 
                    <li><a class="dropdown-item" href="{{ url('/') }}"><i class="fa fa-envelope"></i>Mailbox</a></li>
                @endif
            @endif
            <li><a class="dropdown-item" href="{{ url('templatesurat') }}"><i class="fa fa-database"></i>Template Surat-Surat</a></li>
            <li><a class="dropdown-item" href="{{ url('manualbook') }}"><i class="fa fa-info"></i>Manual Book</a></li>
        
        </ul>
    </li>
@else    
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
@endif