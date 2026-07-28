<!DOCTYPE HTML>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css" media="print">
        .isi {
            font-family: "Comic Sans MS", cursive;
            font-size: 14px;
        }
        .kotak {
            border: thin solid #000;
        }
	</style>
	</head>
	<body>
		<table width="800" border="0" cellpadding="0" cellspacing="0" id="printiki" style="background-color: #D6EEEE;">
            <tr>
                <td colspan="8" align="left" valign="middle"><font size="+2" color="#0000FF">e-Test Result</font></td>
                <td>&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td rowspan="8" align="left" valign="middle"><img src="@if (isset($foto) AND $foto != '') {!! $foto !!} @else {!! $logo !!} @endif" width="100%"/></td>
            </tr>
            <tr>
                <td colspan="8" align="left" valign="middle">{{$namaapps01}}</td>
                <td>&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" align="left" valign="middle">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" align="left" valign="middle"><b>{!! $subsubdomainapps01 !!}</b></td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" align="left" valign="middle"><strong>{{$datanya->namaujian}}</strong></td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" rowspan="3" align="center" valign="middle"><img src="{!! $logofrontapps01 !!}" width="340" height="70" /></td>
                <td colspan="4" align="center"><strong><font color="#0000FF">{!! $datanya->namapeserta !!}</font></strong></td>
            </tr>
            <tr>
                <td colspan="4" align="center">No. Peserta</td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong><font color="#0000FF">{!! $datanya->nomorpeserta !!}</font></strong></td>
            </tr>
            <tr>
                <td colspan="3" align="center" valign="middle"><strong>{!! $datanya->tanggal !!}</strong></td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td colspan="4" align="center" valign="middle">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="center" valign="middle">{!! $datanya->kode !!}</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td colspan="4" align="center" valign="middle">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="4" align="center" valign="middle">{!! $qrcode !!}</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td colspan="4" align="center" valign="middle">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="3" align="center" style="border-bottom:double; border-top:double; border-left:double; border-right:double;">SKORE :<br/><font size="+2">{{$datanya->nilai}}</font></td>
                <td align="center">&nbsp;</td>
                <td colspan="2" rowspan="3" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="center" valign="middle" style="border-bottom:double">&nbsp;</td>
                <td width="21" style="border-bottom:double">&nbsp;</td>
                <td width="33" style="border-bottom:double">&nbsp;</td>
                <td width="17" style="border-bottom:double">&nbsp;</td>
                <td width="61" style="border-bottom:double">&nbsp;</td>
                <td width="60" style="border-bottom:double">&nbsp;</td>
                <td width="92" style="border-bottom:double">&nbsp;</td>
                <td width="79" style="border-bottom:double">&nbsp;</td>
                <td width="160" style="border-bottom:double">&nbsp;</td>
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
		</table>
	</body>
</html>