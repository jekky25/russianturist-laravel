@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_items_id">
							<h1>{{$city->name}} (<a href="{{route('country_name',$city->country['slug'])}}">{{$city->country['name']}}</a>)</h1>
<div class="hot_prew">
<div class="country_picture">{!!$city->cities_img!!}</div>
	<div class="country_r">
				<h2>Новые описания отелей</h2>
				@if (!empty ($hotels))
				@foreach ($hotels as $item)
					<div class="hot_prew" style="height:{{ ($boardConfig['picture_height_hotel'] + 10) }}px;">
						<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}" class="prew">
						<img title="{{$item['hotels_name']}}" alt="{{$item['hotels_name']}}" src="{{$item['pictureStr']}}" width="{{$boardConfig['picture_width_hotel']}}" height="{{$boardConfig['picture_height_hotel']}}">
						</a>
						<h3 class="tit_hot" style="margin-left:{{($boardConfig['picture_width_hotel'] + 10)}}px;"><a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}">{{App\Helpers\Helper::cutText($item['hotels_name'],40)}} {!!$item['starsStr']!!}</a></h3>
						<p>{!!App\Helpers\Helper::cutText($item['hotels_description'],300)!!}<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}"> »»</a></p>
					</div>
  				@endforeach
			@endif
</div>

<p>{!!$city->description!!}</p>
</div>
</div>
@overwrite