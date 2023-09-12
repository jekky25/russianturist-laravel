@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_countries"><h1>Города</h1>
@if (!empty ($towns))
	@foreach ($towns as $item)
<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_town'] + 10) }}px;">
<a href="/towns/{{$item['towns_eng_name']}}'.html" alt="{{$item['towns_name']}}" title="{{$item['towns_name']}}" class="prew">
	<img title="{{$item['towns_name']}}" alt="{{$item['towns_name']}}'" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_town']}}" height="{{$boardConfig['foto_height_town']}}">
</a>
<h3 class="tit_hot" style="margin-left:{{ ($boardConfig['foto_width_town'] + 10) }}px;">
<a href="/towns/{{$item['countries_eng_name']}}.html" alt="{{$item['towns_name']}}" title="{{$item['towns_name']}}">{{$item['towns_name']}}</a>
</h3>
<p>{!!cutText($item['towns_description'], 300)!!}<a href="/towns/{{$item['towns_eng_name']}}.html" title="{{$item['towns_name']}}"> »»</a></p>
</div>
	@endforeach
@endif
</div>
@overwrite