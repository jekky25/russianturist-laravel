@extends('layouts.app')
@section('title', $arMeta['title'])
@section('main_body')
<div class="main_l">
Здравствуйте! Вы попали на сайт <a href="{{route('home')}}">www.russianturist.ru</a>. Все самое интересное для русского туриста. Статьи, информация о странах, отелях.<br>
Слово турист возникло от французского слова tourisme, что означает поездка или путешествие. Еще издревна людей манили разные экзотические страны. Многие из-них открывали новые моря, острова и целые континенты. Многие погибали от рук туземцев. Но это в прошлом.<br>
Сейчас же туризм вырос в целую отдельную область. Теперишние туристы желают прежде всего отдохнуть под лучами жаркого южного солнца, поплавать с аквалангом в Красном море или пройтись с рюкзаком по каким-нибудь горным хребтам.<br>
 Различные туроператоры сейчас предлагают огромное количество всевозможных путевок и туристических маршрутов. Очень востребованными являются сейчас горящие путевки.<br>
Наша задача, как сайта, посвященного прежде всего русским, а точнее русскоязычным, туристам, рассказать вам про ньюансы, касающиеся туризма, про страны, про отели. А может и наоборот вы были в каком-нибудь интересном месте и желаете об этом рассказать, тогда можете воспользоваться обратной связью для этого.<br>
В общем удачи вам - пусть в ваших поездках будет меньше проблем и больше позитива.<br />
<br /><br />
<p align="center"><script type="text/javascript"><!--
google_ad_client = "pub-6379140164632940";
/* 300x250, создано 23.04.10 */
google_ad_slot = "7541803651";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript" async src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script></p>
					  </div>
						<div class="main_r">
							<h1 >Новые описания отелей</h1>
							@if (!empty ($hotels))
							@foreach ($hotels as $item)
							<div class="hot_prew" style="height:{{ ($boardConfig['foto_height_hotel'] + 10)}}px;">
							<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}" class="prew">
								<img title="{{$item['hotels_name']}}" alt="{{$item['hotels_name']}}" src="{{$item['fotoStr']}}" width="{{$boardConfig['foto_width_hotel']}}" height="{{$boardConfig['foto_height_hotel']}}">
							</a>
							<h3 class="tit_hot" style="margin-left:{{($boardConfig['foto_width_hotel'] + 10)}}px;"><a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}">{{cutText($item['hotels_name'],40)}} {!!$item['starsStr']!!}</a></h3>
							<p>{{cutText($item['hotels_description'],300)}}<a href="{{route('hotel_name',$item['hotels_eng_name'])}}" title="{{$item['hotels_name']}}"> »»</a></p>
						</div>
  							@endforeach
							@endif
							<?/*$CODE_INPUT['hotels_list']*/?>
							<div class="hot_prew"><?/*=$sape->return_links();*/?></div>
						</div>

@overwrite