@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_items_id">
	<h1>{{$country['countries_name']}}</h1>
	<div class="hot_prew">
		<div class="country_foto">{!!$country['countries_img']!!}</div>
		<div class="country_r">
			<h2>Новые описания отелей</h2>
			@if (!empty ($hotels))
				@foreach ($hotels as $item)
					<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_hotel'] + 10)}}px;">
						<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}" class="prew">
						<img title="{{$item['hotels_name']}}" alt="{{$item['hotels_name']}}" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_hotel']}}" height="{{$boardConfig['foto_height_hotel']}}">
						</a>
						<h3 class="tit_hot" style="margin-left:{{($boardConfig['foto_width_hotel'] + 10)}}px;"><a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}">{{App\Helpers\Helper::cutText($item['hotels_name'],40)}} {!!$item['starsStr']!!}</a></h3>
						<p>{{App\Helpers\Helper::cutText($item['hotels_description'],300)}}<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}"> »»</a></p>
					</div>
  				@endforeach
			@endif
		</div>
		<p>{!!$country['description']!!}</p>
	</div>
</div>
@overwrite