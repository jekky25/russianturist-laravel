@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_countries"><h1>Отели</h1>
@if (!empty ($hotels))
	@foreach ($hotels as $item)
<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_town'] + 10) }}px;">
<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" alt="{{$item['hotels_name']}}" title="{{$item['hotels_name']}}" class="prew">
	<img title="{{$item['hotels_name']}}" alt="{{$item['hotels_name']}}'" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_town']}}" height="{{$boardConfig['foto_height_town']}}">
</a>
<h3 class="tit_hot" style="margin-left:{{ ($boardConfig['foto_width_town'] + 10) }}px;">
<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" alt="{{$item['hotels_name']}}" title="{{$item['hotels_name']}}">{{$item['hotels_name']}} {!!$item['stars']!!}</a>
</h3>
<p>{!!App\Helpers\Helper::cutText($item['hotels_description'], 300)!!}<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}"> »»</a></p>
</div>
	@endforeach
@endif
</div>
@overwrite