@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_countries"><h1>Города</h1>
@if (!empty ($cities))
	@foreach ($cities as $item)
<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_city'] + 10) }}px;">
<a href="{{route('city_name',$item['slug'])}}" alt="{{$item['name']}}" title="{{$item['name']}}" class="prew">
	<img title="{{$item['name']}}" alt="{{$item['name']}}'" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_city']}}" height="{{$boardConfig['foto_height_city']}}">
</a>
<h3 class="tit_hot" style="margin-left:{{ ($boardConfig['foto_width_city'] + 10) }}px;">
<a href="{{route('city_name',$item['slug'])}}" alt="{{$item['name']}}" title="{{$item['name']}}">{{$item['name']}}</a>
</h3>
<p>{!!App\Helpers\Helper::cutText($item['description'], 300)!!}<a href="{{route('city_name',$item['slug'])}}" title="{{$item['name']}}"> »»</a></p>
</div>
	@endforeach
@endif
</div>
@overwrite