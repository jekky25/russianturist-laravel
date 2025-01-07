@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_items_id">
<h1>{{$hotel->hotels_name}} (<a href="{{route('city_name',$hotel->city['slug'])}}">{{$hotel->city['name']}}</a>)</h1>
<div class="hot_prew">
<div class="pr_fot_hotel" style="width:150px;">
			<h2><a href="{{route('hotel_name',$hotel->hotels_eng_name)}}" alt="{{$hotel->hotels_name}}" title="{{$hotel->hotels_name}}">Описание отеля</a></h2>
			@if (!empty ($hotel->pictures))
				@foreach ($hotel->pictures as $item)
					<div class="picture1" style="height:{{$boardConfig['picture_height_hotel_prew']}}px;">
						<div style="width:{{$boardConfig['picture_width_hotel_prew']}}px; padding:0;">
							<a href="{{route('hotel_pictures_id',[$hotel->hotels_eng_name, '_picture_',$item['id']])}}" alt="{{$hotel['hotels_name']}}" title="{{$hotel['hotels_name']}}" class="prew">
								<img title="{{$hotel['hotels_name']}}" alt="{{$hotel['hotels_name']}}" src="{{$item['picture_out']}}" width="{{$boardConfig['picture_width_hotel_prew']}}" height="{{$boardConfig['picture_height_hotel_prew']}}" {!!$item['f_act']!!}>
							</a>
						</div>
					</div>
  				@endforeach
			@endif
</div>
<div class="picture_big">
<div style="width:{{$resultX_im}}px;">
		<img title="{{$hotel['hotels_name']}}" alt="{{$hotel['hotels_name']}}" src="{{asset('/fotos/hotels/' . $hotel->selPicture['id'] . '.jpg')}}" width="{{$resultX_im}} " height="{{$resultY_im}}">
		@if (!empty ($hotel->prevPicture))
		<a href="{{route('hotel_pictures_id',[$hotel->hotels_eng_name, '_picture_',$hotel->prevPicture['id']])}}" class="no_dec left"><< предыдущее</a>
		@endif
		@if (!empty ($hotel->nextPicture))
		<a href="{{route('hotel_pictures_id',[$hotel->hotels_eng_name, '_picture_',$hotel->nextPicture['id']])}}" class="no_dec right">следуюее >></a>
		@endif
		{{$hotel->positionPicture}} /{{$hotel->countPicture}} </div>
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
<script type="text/javascript" async src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script></div>
</div>
</div>
@overwrite