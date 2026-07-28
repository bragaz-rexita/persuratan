<!DOCTYPE HTML>
<html>
	<head>
        <title>Form Wawancara {!! $biodata->nama_lengkap !!}</title>
	</head>
	<body>
		<div class="portrait">
            <table width="820" border="0" cellpadding="0" cellspacing="0" id="printiki">
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr>
                    <td width="10">&nbsp;</td>
                    <td width="800">
                        <table width="800" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3" align="center" valign="middle">&nbsp;</td>
                                <td width="21">&nbsp;</td>
                                <td width="33">&nbsp;</td>
                                <td width="17">&nbsp;</td>
                                <td width="61">&nbsp;</td>
                                <td width="60">&nbsp;</td>
                                <td width="92">&nbsp;</td>
                                <td width="79">&nbsp;</td>
                                <td width="120">&nbsp;</td>
                            </tr>
                            
                            <tr>
                                <td colspan="8" align="left" valign="middle"><font size="+3">Form Wawancara</font></td>
                                <td>&nbsp;</td>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td rowspan="4" align="left" valign="middle"><img src="{!!$foto!!}" height="80"/></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="left" valign="middle"><font size="+2"><b>{!! config('global.swandhananama') !!}</b></font></td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="8" align="left" valign="middle"><font size="+1"><b>{!! config('global.swandhanauniv') !!}</b></font></td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="8" align="left" valign="middle" style="border-bottom:1px solid black" ><strong>Program Studi {!! $biodata->prodihomebase !!}</strong></td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6" rowspan="3" align="center" valign="middle"><img src="{{ asset('logo-ub-g20.png') }}" height="100" /></td>
                                <td colspan="5" align="center"><strong><font size="+3">{!! $biodata->nama_lengkap !!}</font></strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center">No. Peserta</td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center"><strong><font size="+3">&nbsp;{!! $biodata->kode !!}</font></strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" valign="middle"><strong>{!! $biodata->alamat !!}</strong></td>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td colspan="4" align="center" valign="middle">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" valign="middle">{!! $biodata->no_hp !!}</td>
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
                                <td colspan="5" rowspan="3" align="center"style="border-bottom:1px solid black; border-top:1px solid black; border-left:1px solid black; border-right:1px solid black; background-image: url('{{asset('boxed-bg.png')}}'); background-repeat: repeat; background-position: center;"><font color="#999999">ttd<br />Penguji</font></td>
                                <td align="center">&nbsp;</td>
                                <td colspan="2" rowspan="3" align="center"style="border-bottom:1px solid black; border-top:1px solid black; border-left:1px solid black; border-right:1px solid black; background-image: url('{{asset('boxed-bg.png')}}'); background-repeat: repeat; background-position: center;"><font color="#999999">ttd<br />Peserta</font></td>
                            </tr>
                            <tr>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" valign="middle" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="21" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="33" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="17" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="61" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="60" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="92" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="79" style="border-bottom:1px solid black">&nbsp;</td>
                                <td width="120" style="border-bottom:1px solid black">&nbsp;</td>
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
                            <tr>
                                <td colspan="11" align="center"><strong>Form Wawancara</strong></td>
                            </tr>
                            <tr>
                                <td colspan="11"><p>&nbsp;</p>{!! $formwawancara !!}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="10">&nbsp;</td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
            </table>
        </div>
	</body>
</html>