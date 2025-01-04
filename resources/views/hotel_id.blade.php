@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_items_id">
	<h1>{{$hotel->hotels_name}} (<a href="{{route('city_name',$hotel->city['slug'])}}">{{$hotel->city['name']}}</a>)</h1>
	<div class="hot_prew">
		<div class="pr_fot_hotel" style="width:150px;">
			<h2>{!!$hotel->hotel_fotos_enter!!}</h2>
			@if (!empty ($hotel->fotos))
				@foreach ($hotel->fotos as $item)
					<div class="foto1" style="height:{{$boardConfig['foto_height_hotel_prew']}}px;">
						<div style="width:{{$boardConfig['foto_width_hotel_prew']}}px; padding:0;">
							<a href="{{route('hotel_fotos_id',[$hotel['hotels_eng_name'],'_foto_',$item['id']])}}" alt="{{$hotel['hotels_name']}}" title="{{$hotel['hotels_name']}}" class="prew">
								<img title="{{$hotel['hotels_name']}}" alt="{{$hotel['hotels_name']}}" src="{{$item['foto_out']}}" width="{{$boardConfig['foto_width_hotel_prew']}}" height="{{$boardConfig['foto_height_hotel_prew']}}" {!!$item['f_act']!!}>
							</a>
						</div>
					</div>
  				@endforeach
			@endif
		</div>
		<p>{!!$hotel->hotels_description!!}</p>
	</div>
	<div class="banner_gog2">
<script type="text/javascript"><!--
google_ad_client = "pub-6379140164632940";
/* 468x60, создано 23.04.10 */
google_ad_slot = "3625968731";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript" async src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
	</div>
</div>
@overwrite