<!DOCTYPE html>
<html>
<head>
<title>Riwayat Penanganan Mesin</title>
<style>
/* --------------------------------------------------------------
Hartija Css Print Framework
* Version: 1.0
-------------------------------------------------------------- */
body {
width:100% !important;
margin:0 !important;
padding:0 !important;
line-height: 1.45;
font-family: Garamond,"Times New Roman", serif;
color: #000;
background: none;
font-size: 14pt; }
/* Headings */
h1,h2,h3,h4,h5,h6 { page-break-after:avoid; }
h1{font-size:19pt;}
h2{font-size:17pt;}
h3{font-size:15pt;}
h4,h5,h6{font-size:14pt;}
p, h2, h3 { orphans: 3; widows: 3; }
code { font: 12pt Courier, monospace; }
blockquote { margin: 1.2em; padding: 1em; font-size: 12pt; }
hr { background-color: #ccc; }
/* Images */
img { float: left; margin: 1em 1.5em 1.5em 0; max-width: 100% !important; }
a img { border: none; }
/* Links */
a:link, a:visited { background: transparent; font-weight: 700; text-decoration: underline;col\
or:#333; }
a:link[href^="http://"]:after, a[href^="http://"]:visited:after { content: " (" attr(href) ")\
"; font-size: 90%; }
abbr[title]:after { content: " (" attr(title) ")"; }
/* Don't show linked images */
a[href^="http://"] {color:#000; }
a[href$=".jpg"]:after, a[href$=".jpeg"]:after, a[href$=".gif"]:after, a[href$=".png"]:after {\
content: " (" attr(href) ") "; display:none; }
/* Don't show links that are fragment identifiers, or use the `javascript:` pseudo protocol .\
. taken from html5boilerplate */
a[href^="#"]:after, a[href^="javascript:"]:after {content: "";}
/* Table */
table { margin: 1px; text-align:left; }
th { border-bottom: 1px solid #333; font-weight: bold; }
td { border-bottom: 1px solid #333; }
th,td { padding: 4px 10px 4px 0; }
tfoot { font-style: italic; }
caption { background: #fff; margin-bottom:2em; text-align:left; }
thead {display: table-header-group;}
img,tr {page-break-inside: avoid;}
.qr{
	position: absolute; bottom: 200; left: 0;
}
/* Hide various parts from the site
#header, #footer, #navigation, #rightSideBar, #leftSideBar
{display:none;}
*/
</style>
</head>
<body>
	@foreach ($pengaduan as $log)
	<h2><center>INFORMASI PENGADUAN</center></h2>
	<table width="100%" border="1" class="table-responsive">
		<tr>
			<td rowspan="7" width="20%" align="center" style="justify-content: center; vertical-align: middle; text-align: center;">
				@if (isset($log) && $log->foto)
				
              <img align="middle" class="img-rounded img-responsive " style="width: 10rem; margin-left: auto; margin-right: auto; height: 10rem" src="{{ public_path("/img/".$log->foto) }}">
                  @else
		             Foto belum di upload
		          @endif
			</td>
			<td width="40%">No Pengaduan : {{ $log->no_pengaduan }}</td>
			<td width="40%">Diketahui oleh : @if (!is_null($log->konfirmasi))
				{{ $log->konfirmasi->user->name }}
			@endif </td>
			<tr>
				<td>Pengadu : {{ $log->user->name }}</td>
				<td>Tanggal : @if (!is_null($log->konfirmasi)){{ $log->konfirmasi->created_at }}@endif</td>
			</tr>
			<tr>
				<td>Lokasi : {{ $log->lokasi->nama }}</td>
				<td>Status : @if ($log->status < 0)
					Ditolak
					@elseif($log->status == 0)
					Menunggu Konfirmasi AS
					@elseif($log->status > 0)
					Telah diperiksa AS
				@endif</td>
			</tr>
			<tr>
				<td>Mesin : {{ $log->mesin->nama }}</td>
				<td rowspan="3" style="vertical-align: text-top;">Keterangan : @if (!is_null($log->konfirmasi)){{ $log->konfirmasi->keterangan }}@endif</td>
			</tr>
			<tr>
				<td>Tanggal : {{ $log->created_at }}</td>
				
			</tr>
			<tr>
				<td>Keterangan : {{ $log->keterangan }}</td>
			</tr>
		</tr>
	</table>
		
	@if ($log->status > 1)
	<h2><center>RIWAYAT PENANGANAN</center></h2>
	<table width="100%" border="1">
			{{-- expr --}}
		@foreach ($log->penanganan->riwayats as $el)
		<tr>
			<td rowspan="5" width="20%">@if (isset($el) && $el->foto)
				<center>
              <img class="img-rounded img-responsive " style=" width: 10rem; margin-left: auto; margin-right: auto; height: 10rem" src="{{ public_path("/img/".$el->foto) }}">
              </center>
		          @else
		             Foto belum di upload
		          @endif</td>
			<td>No Pengaduan : {{ $log->no_pengaduan }}</td>
			<tr>
				<td>PIC : {{ $el->penanganan->user->name }}</td>
			</tr>
			<tr>
				@if ($el->status == 0)
				<td>Status : Menunggu</td>
				@elseif ($el->status == 1)
				<td>Status : Selesai</td>
				@elseif ($el->status == 2)
				<td>Status : Tarik HO</td>
				@endif
			</tr>
			<tr>
				<td>Tanggal : {{ $el->created_at }}</td>
			</tr>
			<tr>
				<td>Keterangan : {{ $el->keterangan }}</td>
			</tr>
		</tr>
		@endforeach
	</table>
		@endif
	<p style="page-break-before: always">
	@endforeach
	
</body>
</html>