@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_countries"><h1>Страны</h1>
@if (!empty ($countries))
	@foreach ($countries as $item)
<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_country'] + 10) }}px;">
<a href="/countries/{{$item['countries_eng_name']}}'.html" alt="{{$item['countries_name']}}" title="{{$item['countries_name']}}" class="prew">
	<img title="{{$item['countries_name']}}" alt="{{$item['countries_name']}}'" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_country']}}" height="{{$boardConfig['foto_height_country']}}">
</a>
<h3 class="tit_hot" style="margin-left:{{ ($boardConfig['foto_width_country'] + 10) }}px;">
<a href="/countries/{{$item['countries_eng_name']}}.html" alt="{{$item['countries_name']}}" title="{{$item['countries_name']}}">{{$item['countries_name']}}</a>
</h3>
<p>{!!cutText($item['countries_description'], 300)!!}<a href="/countries/{{$item['countries_eng_name']}}.html" title="{{$item['countries_name']}}"> »»</a></p>
</div>
	@endforeach
@endif
</div>
@overwrite