@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_items"><h1>Статьи</h1>
@if (!empty ($items))
	@foreach ($items as $item)
<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_item'] + 10) }}px;">
<a href="{{route('item_id',$item['items_id'])}}" alt="{{$item['items_name']}}" title="{{$item['items_name']}}" class="prew">
	<img title="{{$item['items_name']}}" alt="{{$item['items_name']}}'" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_item']}}" height="{{$boardConfig['foto_height_item']}}">
</a>
<h3 class="tit_hot" style="margin-left:{{ ($boardConfig['foto_width_item'] + 10) }}px;">
<a href="{{route('item_id',$item['items_id'])}}" alt="{{$item['items_name']}}" title="{{$item['items_name']}}">{{$item['items_name']}}</a>
</h3>
<p>{!!cutText(strip_tags($item['items_description'],"<b><strong><i>"), 300)!!}<a href="{{route('item_id',$item['items_id'])}}" title="{{$item['items_name']}}"> »»</a></p>
</div>
	@endforeach
@endif
</div>
<div class="clear"></div>
@if (!empty ($pagination) && count ($pagination) > 3)
	<div class="pagination">
	@foreach ($pagination as $_pagination)
		<a href="{{$_pagination['url']}}" @if ($_pagination['active'] == 1)class="active name_my_mess"@else class="name_my_mess"@endif>{!!$_pagination['label']!!}</a>
	@endforeach
	</div>
@endif
@overwrite