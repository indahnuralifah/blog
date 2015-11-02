@extends('app')
@section('content')


@foreach($data as $artikel)
<div class="panel">
		<div class="heading">
			<div class="icon mif-file-text"></div>
			<div class="title">{{ $artikel->judul }}</div>
		</div>
		<div class="content">
			{{ $artikel->isi }}

			<hr>
			<a href="{{ $artikel->slug }}">Read More</a>

			<div class="place-right">

		@if(Auth::check())	
		<span class="mif-mail"></span>
		<a href="{{ url('mail/'.$artikel->slug) }}">
			Send Me E-mail
		</a>
		@endif
		<span class="mif-file-pdf"></span>
		<a target="blank" href="{{ url('pdf/'.$artikel->slug) }}">
			View PDF
		</a>

				<span class="mif-calender"></span>
				{{ date_format(date_create($artikel->created_at),"D, d M Y H:i:s") }}
				<span class="mif-user"></span>
				{{ App\User::find($artikel->idpengguna)['nama'] }}
			</div>
		</div>
	</div>
@endforeach

<hr>
<span class="place-right">
{!! $data->render() !!}
</span>
@endsection