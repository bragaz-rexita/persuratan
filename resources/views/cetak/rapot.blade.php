<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title></title>
	<meta name="generator" content="LibreOffice 5.4.7.2 (Linux)"/>
	<meta name="author" content="Microsoft Office User"/>
	<meta name="created" content="2020-10-23T01:29:33"/>
	<meta name="changedby" content="Microsoft Office User"/>
	<meta name="changed" content="2020-10-23T06:10:46"/>
	<meta name="AppVersion" content="16.0300"/>
	<meta name="DocSecurity" content="0"/>
	<meta name="HyperlinksChanged" content="false"/>
	<meta name="LinksUpToDate" content="false"/>
	<meta name="ScaleCrop" content="false"/>
	<meta name="ShareDoc" content="false"/>
	
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Times"; font-size:small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
	
</head>

<body>
<table cellspacing="0" border="0" style="background-image: url('{{asset('dist/img/logo-gray.jpg')}}'); background-repeat: no-repeat; background-position: center;">
	<colgroup width="85"></colgroup>
	<colgroup width="329"></colgroup>
	<colgroup width="87"></colgroup>
	<colgroup span="2" width="85"></colgroup>
	<colgroup width="112"></colgroup>
	<colgroup width="61"></colgroup>
	<colgroup width="146"></colgroup>
	<tr>
		<td colspan="8">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td colspan="3" rowspan="7" align="center" valign="middle" style="border-bottom:double"><img src="{!!$logo!!}" width="75" /></td>
			<td colspan="8"><b>{!! $yayasan !!}</b></td>
		  </tr>
		  <tr>
			<td colspan="8"><b>{!! $sekolah !!}</b></td>
		  </tr>
		  <tr>
			<td colspan="8"><b>Terakreditasi A</b></td>
		  </tr>
		  <tr>
			<td colspan="8">{!! config('global.nomerinduksekolah') !!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!!$alamat!!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!! config('global.email') !!}</td>
		  </tr>
		  <tr>
			<td width="157" style="border-bottom:double">&nbsp;</td>
			<td width="26" style="border-bottom:double">&nbsp;</td>
			<td width="87" style="border-bottom:double">&nbsp;</td>
			<td width="22" style="border-bottom:double">&nbsp;</td>
			<td width="25" style="border-bottom:double">&nbsp;</td>
			<td width="198" style="border-bottom:double">&nbsp;</td>
			<td width="39" style="border-bottom:double">&nbsp;</td>
			<td width="129" style="border-bottom:double">&nbsp;</td>
		  </tr>
        </table>
        </td>
	</tr>
    <tr>
		<td colspan=8 height="24" align="center" valign=middle><b>RAPOR DAN PROFIL PESERTA DIDIK</b></td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>Nama </td>
		<td colspan=4 align="left" valign=middle><b> : {!! $rapot->NAMA !!}</b></td>
		<td align="left" valign=middle>Kelas</td>
		<td align="left" valign=middle>:</td>
		<td align="left" valign=middle>{!! $rapot->KELAS !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>NISN/NIS</td>
		<td colspan=4 align="left" valign=middle>: {!! $rapot->NISN !!}</td>
		<td align="left" valign=middle>Semester</td>
		<td align="left" valign=middle>:</td>
		<td align="left" valign=middle>{!! $rapot->SEMESTER !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>Nama Sekolah</td>
		<td colspan=4 align="left" valign=middle>: {!! $rapot->NAMASD !!}</td>
		<td align="left" valign=middle>Tahun Pelajaran</td>
		<td align="left" valign=middle>:</td>
		<td align="left" valign=middle>{!! $rapot->TAPEL !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>Alamat Sekolah</td>
		<td colspan=7 align="left" valign=middle>: {!! $rapot->ALAMAT !!}</td>
		</tr>
	<tr>
		<td height="21" align="justify" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=8 height="21" align="left" valign=middle><b>A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kompetensi Sikap</b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="21" align="center" valign=middle bgcolor="#F2F2F2"><b>Aspek</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Predikat</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle bgcolor="#F2F2F2"><b>Deskripsi</b></td>
		</tr>
	<tr>
		<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="39" align="left" valign=middle>1.&nbsp;&nbsp; Sikap Spiritual</td>
		<td style="border-right: 1px solid #000000" colspan=2 align="center" valign=middle>{!! $rapot->SSP !!}</td>
		<td style="border-right: 1px solid #000000" colspan=4 align="left" valign=middle>{!! $rapot->DES !!}</td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="39" align="left" valign=middle>2.&nbsp;&nbsp; Sikap Sosial</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>{!! $rapot->SS !!}</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="left" valign=middle>{!! $rapot->DES2 !!}</td>
		</tr>
	<tr>
		<td height="21" align="left" valign=middle><b>&nbsp;</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=8 height="23" align="left" valign=middle><b>B.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kompetensi Pengetahuan dan Keterampilan</b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="45" align="center" valign=middle bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Muatan Pelajaran</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#F2F2F2"><b>Pengetahuan</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#F2F2F2"><b>Keterampilan</b></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" height="47" align="center" valign=middle sdval="1" >1</td>
		<td style="border-right: 1px solid #000000" align="left" valign=middle>Pendidikan Agama Islam dan Budi Pekerti</td>
		<td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PAI3 !!}</td>
		<td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H !!}</td>
		<td style="border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D !!}</td>
		<td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PAI4 !!}</td>
		<td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H2 !!}</td>
		<td style="border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D2 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >2</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Pendidikan Pancasila dan Kewarganegaraan</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PPKN3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PPKN4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D4 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >3</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Bahasa Indonesia</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BI3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H5 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D5 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BI4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H6 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D6 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >4</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Matematika</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->MAT3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H7 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D7 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->MAT4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H8 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D8 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >5</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Ilmu Pengetahuan Alam</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPA3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H9 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D9 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPA4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H10 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D10 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >6</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Ilmu Pengetahuan Sosial</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPS3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H11 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D11 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPS4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H12 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D12 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >7</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Seni Budaya dan Prakarya</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->SBDP3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H13 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D13 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->SBDP4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H14 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D14 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >8</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PJOK3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H15 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D15 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PJOK4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H16 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D16 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle bgcolor="#F2F2F2" >9</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F2F2F2">Muatan Lokal</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>a. Bahasa Jawa</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BJ3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H17 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D17 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BJ4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H18 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D18 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign=middle >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>b. Bahasa Inggris</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BING3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H19 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D19 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BING4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H20 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D20 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>c. Bahasa Arab</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BA3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H21 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D21 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BA4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H22 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D22 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign=middle >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>d. Teknologi </td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->TIK3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H23 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D23 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->TIK4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H24 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D24 !!}</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle >&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle >&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=3 height="21" align="left" valign=middle><b>C.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ekstra Kurikuler</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="51" align="center" valign=middle bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Kegiatan Ekstrakurikuler</b></td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" colspan=6 rowspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Keterangan</b></td>
		</tr>
	<tr>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >1</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->EKS !!}</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" colspan=6 align="left" valign=middle>{!! $rapot->K !!}</td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >2</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->EKS2 !!}</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" colspan=6 align="left" valign=middle>{!! $rapot->K2 !!}</td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle>3</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->EKS3 !!}</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" colspan=6 align="left" valign=middle>{!! $rapot->K3 !!}</td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle>4</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->EKS4 !!}</td>
		<td style="border-top: 1px solid #000000;border-right: 1px solid #000000" colspan=6 align="left" valign=middle>{!! $rapot->K4 !!}</td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle>5</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->EKS5 !!}</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align="left" valign=middle>{!! $rapot->K5 !!}</td>
		</tr>
	<tr>
		<td height="21" align="justify" valign=middle><b>&nbsp;</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=8 height="21" align="left" valign=middle><b>D.&nbsp;&nbsp;&nbsp;&nbsp; Saran-saran</b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 height="21" align="left" valign=middle><i>{!! $rapot->SARAN !!}</i></td>
		</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000" colspan=4 height="23" align="left" valign=middle><b>E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tinggi dan Berat Badan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style=" border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="45" align="center" valign=middle bgcolor="#F2F2F2"><b>No</b></td>
		<td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Kegiatan Fisik</b></td>
		<td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Semester</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2" sdval="1" sdnum="1033;"><b>1</b></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2" sdval="2" sdnum="1033;"><b>2</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Tinggi Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->TBS1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->TBS2 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Berat Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BBS1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BBS2 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="justify" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="justify" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=4 height="23" align="left" valign=middle><b>F.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kondisi Kesehatan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2"><b>Aspek Kesehatan</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle bgcolor="#F2F2F2"><b>Keterangan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Pendengaran</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KETPD !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Penglihatan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KETPL !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle>3</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Gigi</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KETGG !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle>4</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Lainnya</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KETL !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=4 height="23" align="left" valign=middle><b>G.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prestasi</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign=middle bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2"><b>Jenis Prestasi</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle bgcolor="#F2F2F2"><b>Keterangan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->PRETASI1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KET !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->PRETASI2 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KET2 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle>3</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->PRETASI3 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KET3 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle>4</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->PRETASI4 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>{!! $rapot->KET4 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=middle>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=4 height="23" align="left" valign=middle><b>H.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ketidakhadiran</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="23" align="center" valign=middle bgcolor="#F2F2F2"><b>Ketidakhadiran</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="37" align="left" valign=middle>Sakit</td>
		<td style="border-right: 1px solid #000000" align="left" valign=middle>:  {!! $rapot->SAKIT !!}  hari</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="37" align="left" valign=middle>Izin</td>
		<td style="border-right: 1px solid #000000" align="left" valign=middle>:  {!! $rapot->IZIN !!}  hari</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="57" align="left" valign=middle>Tanpa Keterangan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>:  {!! $rapot->TANPA !!}  hari</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=middle>Mengetahui :</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=middle>Orang Tua / Wali</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td colspan=3 align="center" valign=bottom>Guru Kelas</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" colspan=3 align="center" valign=bottom>{!! $rapot->GURUKLS !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="center" valign=bottom>(Tanda tangan dan Nama Terang)</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td style="border-top: 1px solid #000000" colspan=3 align="center" valign=bottom>NIY. {{$rapot->NIPGURU}}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom>{!! $rapot->TGLRAPOR !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom>Kepala Sekolah</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom><u>{!! $rapot->KASEK !!}</u></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom>{!! $rapot->NIPKASEK !!} </td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
</table>
</body>

</html>
