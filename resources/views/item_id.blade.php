@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_items_id">
	<h1>{{$item['items_name']}}</h1>
<div class="hot_prew">
<div class="banner_gog">
<script type="text/javascript"><!--
google_ad_client = "pub-6379140164632940";
/* 300x250, создано 23.04.10 */
google_ad_slot = "4449299960";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript" async src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<div class="item_foto">{!!$item['items_img']!!}</div>
<p>{!!$item['items_description']!!}</p>
</div>
</div>
@overwrite