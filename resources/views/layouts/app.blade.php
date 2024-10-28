<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>@yield('title')</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="yandex-verification" content="fe6c88b999494404" />
<meta content="Туризм и путешествия" name="classification">
<?/*=$CODE_INPUT['META']*/?>
<link href="{{ asset("css/site.css?t=3") }}" type="text/css" rel="stylesheet">
</head>
<body>
<div class="overhtm">
<div class="header">
	<div class="head_l"><a href="{{route('home')}}" title="Русский турист"><img alt="Русский турист" title="Русский турист" src="{{ asset("image/logo.jpg") }}"></a></div>
	<div class="head_c"></div>
	<div class="head_r"></div>
</div>
<div class="main">
	<table><tr class="hh1">
		<td class="l_main">
			@if (!empty ($countries))
			<div class="lm_head"><a href="{{route('countries')}}" title="Страны">Страны</a></div>
			<div class="lm_countr">
				<div class="lm_c1">
					<div>
						<ul>
						@foreach ($countries as $item)
						<li><a href="{{route('country_name',$item['countries_eng_name'])}}" title="{{$item['countries_name']}}">{{$item['countries_name']}}</a></li>
						@endforeach
						</ul>
					</div>
				</div>
			</div>
			@endif
			@if (!empty ($outSape))
			<div class="lm_fri_h">Наши друзья</div>
			<div class="lm_fri_b">
				<div class="lm_fri1">
					<div>
						<ul>
							@foreach ($outSape as $item)
							<li>{!! $item !!}</li>
							@endforeach
						</ul><br>
					</div>
				</div>
			</div>
			@endif
			<div class="lm_foot"></div>
		</td>
		<td class="c_main">
			<table>
				<tr>
					<td>
						<table>
							<tr>
							<td class="vert_pm"><div class="rm_head1"></div></td>
							<td class="vert_pm1"><a href="{{route('home')}}" title="Главная">Главная</a></td>
							<td class="vert_pm"></td>
							<td class="vert_pm1"><a href="{{route('towns')}}" title="Города">Города</a></td>
							<td class="vert_pm"></td>
							<td class="vert_pm1"><a href="{{route('hotels')}}" title="Отели">Отели</a></td>
							<td class="vert_pm"></td>
							<td class="vert_pm1"><a href="{{route('items')}}" title="Статьи">Статьи</a></td>
						</tr>
					</table>
				</td>
				</tr>
				<tr>
					<td colspan="9" class="main_tab">
					<!--centr_begin-->
<div id="app">
		@yield('main_body')
</div>
<!--centr_end-->
<div class="predupr">При републикации материалов гиперссылка на сайт по туризму www.russianturist.ru обязательна!</div>
					</td>
				</tr>
			</table>
		</td>
		<td class="r_main" style="width:19px;">
			<div>
				<div class="rm_head1"></div>
				<div class="rm_head"></div>
				<div class="rm_cent"></div>
				<div class="rm_foot"></div>
			</div>
		</td>
	</tr></table>
</div>
<div class="footer">
	<div class="foot_l">
		<div><img src="{{ asset("image/kompas.jpg") }}" alt="Компас" title="Компас"></div>
	</div>
	<div class="foot_c">
	  <div class="foot_c2">
			<span>
				<noindex>
    <!-- begin of Top100 logo -->
<a href="http://top100.rambler.ru/home?id=1530445" target="_blank"><img src="http://top100-images.rambler.ru/top100/banner-88x31-rambler-blue3.gif" alt="Rambler's Top100" width="88" height="31" border="0" ></a>
<!-- end of Top100 logo -->
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='http://counter.yadro.ru/hit?t11.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border=0 width=88 height=31><\/a>")//--></script><!--/LiveInternet-->
<br><!--Rating@Mail.ru COUNTER--><script language="JavaScript" type="text/javascript"><!--
d=document;var a='';a+=';r='+escape(d.referrer)
js=10//--></script><script language="JavaScript1.1" type="text/javascript"><!--
a+=';j='+navigator.javaEnabled()
js=11//--></script><script language="JavaScript1.2" type="text/javascript"><!--
s=screen;a+=';s='+s.width+'*'+s.height
a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth)
js=12//--></script><script language="JavaScript1.3" type="text/javascript"><!--
js=13//--></script><script language="JavaScript" type="text/javascript"><!--
d.write('<a href="http://top.mail.ru/jump?from=1519290"'+
' target="_top"><img src="http://de.c2.b7.a1.top.mail.ru/counter'+
'?id=1519290;t=130;js='+js+a+';rand='+Math.random()+
'" alt="Рейтинг@Mail.ru"'+' border="0" height="40" width="88"/><\/a>')
if(11<js)d.write('<'+'!-- ')//--></script><noscript><a
target="_top" href="http://top.mail.ru/jump?from=1519290"><img
src="http://de.c2.b7.a1.top.mail.ru/counter?js=na;id=1519290;t=130"
border="0" height="40" width="88"
alt="Рейтинг@Mail.ru"/></a></noscript><script language="JavaScript" type="text/javascript"><!--
if(11<js)d.write('--'+'>')//--></script><!--/COUNTER--></noindex>
			</span>
	  </div>
	  <div class="foot_c1">
			<div class="hh2"><div>2009 Сайт про Российский Туризм и отдых <a href="{{route('home')}}" title="Российский турист">www.russianturist.ru</a></div></div>
	  </div>
	</div>
</div>
</div>
</body>
</html>