@extends('app')
@section('content')
<div class="panel">
	<div class="heading">
		<span class="title">
<span class="class .header">Create New Post</span>
		</span>
	</div>
<div class="content">
	<form method="POST" action="{{ url('artikel/save') }}" enctype="multipart/form-data">
	<table style="width:100%">
<tr>
<td>Judul</td>
<td>
<div class="input-control text full-size">
	<input type="text" name="judul"> 
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</div>
</td>
</tr>
<tr>
<td>Isi<td>
	<div class="input-control textarea full-size">
	<textarea name="isi"></textarea>
	</div>
		</td>
	</tr>
	<tr>
		<td>Tag</td>
		<td>
		<div class="input-control text full-size">
			<input type="text" name="tag">
		</div>
		</td>
	</tr>
	<tr>
		<td>Sampul</td>
		<td>
			<div class="input-control file full-size" data-role="input">
				<input type="file" name="sampul">
				<button class="button"><span class="mif-folder"></span></button>
			</div>
		</td>
		</tr>
		<tr>
		<td></td>
		<td>
		<button class="button info block-shadow-info text-shadow" type="submit"> Submit
		</button>	
		</td>
		</tr>
	</table>
	</form>
</div>
</div>

@endsection