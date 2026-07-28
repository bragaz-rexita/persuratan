<!DOCTYPE HTML>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css" media="print">
	.isi {
		font-family: "Comic Sans MS", cursive;
		font-size: 14px;
	}
	</style>
	</head>
	<body>
		<table width="720" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="100" style="border-bottom:double" colspan="2" rowspan="3" align="center" valign="middle" style="border-bottom:double">
				<img src="{!!$logo!!}" width="100" />
			</td>
			<td colspan="8" width="620">{!! $yayasan !!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!! $sekolah !!}</td>
		  </tr>
		  <tr>
			<td colspan="8" style="border-bottom:double">{!! $alamat !!}</td>
		  </tr>
		  <tr height="20">
			<td colspan="3" width="210"><span class="isi">Sudah terima dari</span></td>
			<td colspan="6" width="290" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;"><span class="isi">: {!! $nama !!}</span></td>
			<td width="100"><span class="isi">Kelas</span></td>
			<td width="120" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;"><span class="isi">: {{$kelas}}</span></td>
		  </tr>
		  <tr height="20">
			<td colspan="3"><span class="isi">Uang Sebesar</span></td>
			<td colspan="8" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;"><span class="isi">: {!!$y!!}</span></td>
		  </tr>
		  <tr height="20">
			<td colspan="3"><span class="isi">Untuk Pembayaran</span></td>
			<td colspan="8" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;"><span class="isi">: {!! $tlsbulan !!}</span></td>
		  </tr>
		  <tr height="20">
			<td width="20"><span class="isi">1.</span></td>
			<td width="240" colspan="3" align="left"><span class="isi">SPP</span></td>
			<td width="30"><span class="isi">Rp.</span></td>
			<td width="120" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tbiayaspp !!}</td>
			<td width="40">&nbsp;</td>
			<td width="20"><span class="isi">5.</span></td>
			<td width="100"><span class="isi">Buku Tulis</span></td>
			<td width="30"><span class="isi">Rp.</span></td>
			<td width="120" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tbukutulis !!}</td>
		  </tr>
		  <tr height="20">
			<td><span class="isi">2.</span></td>
			<td colspan="3" align="left"><span class="isi">Kegiatan</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tkegiatan !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">6.</span></td>
			<td><span class="isi">Buku Paket</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tbukupaket !!}</td>
		  </tr>
		  <tr height="20">
			<td><span class="isi">3.</span></td>
			<td colspan="3" align="left"><span class="isi">DPP ke</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tbiayadpp !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">7.</span></td>
			<td><span class="isi">Paguyuban</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tpaguyuban !!}</td>
		  </tr>
		  <tr height="20">
			<td width="20"><span class="isi">4.</span></td>
			<td width="50" align="left"><span class="isi">Ekskul</span></td>
			<td width="20"><span class="isi">a.</span></td>
			<td width="170" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;"><span class="isi">{!! $ekskula !!}</span></td>
			<td width="30"><span class="isi">Rp.</span></td>
			<td width="120" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tekskula2 !!}</td>
			<td width="40">&nbsp;</td>
			<td width="20"><span class="isi">8.</span></td>
			<td width="100"><span class="isi">{!! $lain1 !!}</span></td>
			<td width="30"><span class="isi">Rp.</span></td>
			<td width="120" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tlain1a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">b.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;"><span class="isi">{!! $ekskulb !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tekskulb2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">9.</span></td>
			<td><span class="isi">{!! $lain2 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tlain2a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">c.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" ><span class="isi">{!! $ekskulc !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tekskulc2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">10.</span></td>
			<td ><span class="isi">{!! $lain3 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tlain3a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">d.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" ><span class="isi">{!! $ekskuld !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tekskuld2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">11.</span></td>
			<td ><span class="isi">{!! $lain4 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tlain4a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">e.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" ><span class="isi">{!! $ekskule !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="right">{!! $tekskule2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">&nbsp;</span></td>
			<td ><span class="isi">&nbsp;</span></td>
			<td><span class="isi">&nbsp;</span></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td width="20">&nbsp;</td>
			<td width="50">&nbsp;</td>
			<td width="20">&nbsp;</td>
			<td width="100">&nbsp;</td>
			<td width="30">&nbsp;</td>
			<td width="120">&nbsp;</td>
			<td width="230" colspan="3" rowspan="4" align="center" valign="middle">
				&nbsp;<br />
				<img src="{!! $qrcode !!}" width="80"/>
			</td>
			<td width="150" colspan="2" align="center"><span class="isi">{!! $tanggalctk !!}</span></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" align="center"><span class="isi">Penerima</span></td>
		  </tr>
		  <tr>
			<td width="20">&nbsp;</td>
			<td width="170" colspan="3" rowspan="2" style="border-bottom:double; border-top:double; border-left:double; border-right:double;" valign="middle" align="center"><b>Rp. <u>{!! $tulisan !!}</u></b></td>
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
		  </tr>
		  <tr>
			<td  width="570" colspan="8"><span class="isi">{!! $mutiara !!}</span></td>
			<td  width="150" colspan="2" style="border-bottom:dotted; border-bottom-width:thin; border-bottom-color:Black;" align="center"><span class="isi">{!! $asline !!}</span></td>
		  </tr>
		  <tr>
			<td colspan="10"><span class="isi">Mohon Simpan Kwitansi Ini, Sebagai Bukti Fisik Pembayaran.</span></td>
		  </tr>
		</table>
	</body>
</html>