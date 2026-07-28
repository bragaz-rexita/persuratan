<style type="text/css">
/*
 * Component: Timeline
 * -------------------
 */
.timeline {
  position: relative;
  margin: 0 0 30px 0;
  padding: 0;
  list-style: none;
}
.timeline:before {
  content: '';
  position: absolute;
  top: 0px;
  bottom: 0;
  width: 4px;
  background: #ddd;
  left: 31px;
  margin: 0;
  border-radius: 2px;
}
.timeline > li {
  position: relative;
  margin-right: 10px;
  margin-bottom: 15px;
}
.timeline > li:before,
.timeline > li:after {
  content: " ";
  display: table;
}
.timeline > li:after {
  clear: both;
}
.timeline > li > .timeline-item {
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  border-radius: 3px;
  margin-top: 0px;
  background: #fff;
  color: #444;
  margin-left: 60px;
  margin-right: 15px;
  padding: 0;
  position: relative;
}
.timeline > li > .timeline-item > .time {
  color: #999;
  float: right;
  padding: 10px;
  font-size: 12px;
}
.timeline > li > .timeline-item > .timeline-header {
  margin: 0;
  color: #555;
  border-bottom: 1px solid #f4f4f4;
  padding: 10px;
  font-size: 16px;
  line-height: 1.1;
}
.timeline > li > .timeline-item > .timeline-header > a {
  font-weight: 600;
}
.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
  padding: 10px;
}
.timeline > li.time-label > span {
  font-weight: 600;
  padding: 5px;
  display: inline-block;
  background-color: #fff;
  border-radius: 4px;
}
.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
  width: 30px;
  height: 30px;
  font-size: 15px;
  line-height: 30px;
  position: absolute;
  color: #666;
  background: #d2d6de;
  border-radius: 50%;
  text-align: center;
  left: 18px;
  top: 0;
}

.pojokkananatas {
	border-top-width: thin;
	border-left-width: thin;	
	border-top-style: solid;
	border-left-style: solid;		
	border-top-color: #000;
	border-left-color: #000;	
}
.atas {
	border-top-width: thin;
	border-top-style: solid;
	border-top-color: #000;
}
.pojokkanan {
	border-top-width: thin;
	border-right-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-top-color: #000;
	border-right-color: #000;
}
.fullkotak {
	border: thin solid #000;
}
.kiri {
	border-left-width: thin;
	border-left-style: solid;
	border-left-color: #000;
}
.kanan {
	border-right-width: thin;
	border-right-style: solid;
	border-right-color: #000;
}
.bawah {
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000;
}
</style>
<table id="printiki" width="100%" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="171" rowspan="4" align="center" class="pojokkananatas bawah"><img src="@if (isset($logo01))
                            {{ asset($logo01) }}
                            @elseif (Session('logo01') !== null)
                            {{ Session('logo01') }}
                            @else
                            {{ asset('duidev-softwarehouse.png') }}
                            @endif" width="102" height="96" alt=""/></td>
	<td colspan="8" class="atas kanan"><b>@if (isset($namaapps01))
                        {{ $namaapps01 }}
                        @elseif (Session('namaapps01') !== null)
                        {{ Session('namaapps01') }}
                        @else
                        {{ config('global.Title') }}
                        @endif</b></td>
    </tr>
    <tr>
      <td colspan="8" class="kanan"><b>@if (isset($domainapps01))
                                    {{ $domainapps01 }}
                                    @elseif (Session('domainapps01') !== null)
                                    {{ Session('domainapps01') }}
                                    @else
                                    {{ config('global.swandhanauniv') }}
                                    @endif</b></td>
    </tr>
	<tr>
      <td colspan="8" class="kanan"><b>@if (isset($subdomainapps01))
                                    {{ $subdomainapps01 }}
                                    @elseif (Session('subdomainapps01') !== null)
                                    {{ Session('subdomainapps01') }}
                                    @else
                                    {{ config('global.swandhanakemen') }}
                                    @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
    </tr>
    <tr>
      <td colspan="8" class="kanan bawah"><strong>KARTU KENDALI</strong></td>
    </tr>
</thead>
<tbody>
    <tr>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="348">&nbsp;</td>
      <td width="80">&nbsp;</td>
      <td width="134">&nbsp;</td>
      <td width="77">&nbsp;</td>
      <td width="25">&nbsp;</td>
      <td width="217">&nbsp;</td>
      <td width="57">&nbsp;</td>
    </tr>
    <tr>
      <td rowspan="2" align="left" class="pojokkananatas" valign="middle">&nbsp;Indeks/Subyek</td>
      <td rowspan="2" align="left" class="atas" valign="middle">: </td>
      <td rowspan="2" colspan="2" align="left" valign="middle" class="atas"><b>{{ $kodesubdeskripsi }}</b></td>
      <td rowspan="2" align="left" valign="middle" class="atas kiri kanan">KODE: {{ $subyek }}</td>
      <td align="left" class="atas" valign="top">Tanggal </td>
      <td align="left" class="atas" valign="top">:</td>
      <td colspan="2" align="left" valign="top" class="atas kanan">{{ $tglmasuk }}</td>
    </tr>
    <tr>
      <td align="left"><strong>No. Urut</strong></td>
      <td align="left">:</td>
      <td colspan="2" align="left" class="kanan">{{ $noagenda }}</td>
    </tr>
    <tr>
      <td height="35" align="left" class="pojokkananatas">&nbsp;Perihal</td>
      <td width="20" align="left" class="atas">:</td>
      <td colspan="7" align="left" class="pojokkanan">{{ $perihal }}</td>
    </tr>
	<tr>
      <td height="35" align="left" class="pojokkananatas">&nbsp;Ringkasan Surat</td>
      <td width="20" align="left" class="atas">:</td>
      <td colspan="7" align="left" class="pojokkanan">{!! $ringkasan2 !!}</td>
    </tr>	
    <tr>
      <td height="35" align="left" class="pojokkananatas">&nbsp;Dari</td>
      <td align="left" class="atas">:</td>
      <td colspan="2" align="left" class="pojokkanan">{{ $asalsurat }}</td>
      <td colspan="5" align="left" class="pojokkanan">&nbsp;Kepada : {{ $kepada }}</td>
    </tr>
    <tr>
      <td height="35" align="left" class="pojokkananatas">&nbsp;Tanggal Surat</td>
      <td align="left" class="atas">:</td>
      <td colspan="2" align="left" class="pojokkanan">{{ $tglsurat }}</td>
      <td colspan="5" align="left" class="pojokkanan">&nbsp;No. Surat : {{ $nosurat }}</td>
    </tr>
	<tr>
      <td height="35" align="left" class="pojokkananatas">&nbsp;Keterangan</td>
      <td width="20" align="left" class="atas">:</td>
      <td colspan="7" align="left" class="pojokkanan">{!! $ringkasan !!}</td>
    </tr>
	<tr>
      <td width="100" align="center" class="kiri atas kanan"><strong>Tanggal Masuk</strong></td>
      <td width="100" align="center" class="kanan atas"><strong>Tanggal Proses</strong></td>
      <td colspan="2" align="center" class="kanan atas"><strong>Isi Disposisi</strong></td>
      <td colspan="3" align="center" class="kanan atas"><strong>Dari</strong></td>
      <td align="center" class="kanan atas" colspan="2"><strong>Kepada Yth.</strong></td>
    </tr>	
	{!! $tulisdisposisi !!}
	    <tr>
      <td align="left" class="atas">&nbsp;</td>
      <td colspan="8" align="left" class="atas">&nbsp;</td>
    </tr>    
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td colspan="7" align="left">&nbsp;</td>
    </tr>
	<tr>
      <td align="left"><strong>Keterangan</strong></td>
      <td align="left">:</td>
      <td colspan="7" align="left">&nbsp;</td>
    </tr>
   {!! $macamdisposisi !!}
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td colspan="7" align="left">&nbsp;</td>
    </tr>
    {!! $tuliscatatan !!}
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td colspan="7" align="left">&nbsp;</td>
    </tr>
	<tr>
		<td colspan="3" align="right">&nbsp;</td>
		<td colspan="3">{!! $printqrcode !!}</td>
		<td align="center" valign="top" colspan="3">
			Tanda Tangan
		</td>
	  </tr>
</tbody>
</table>
{!! $scanfile !!}