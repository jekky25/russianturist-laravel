<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="yandex-verification" content="fe6c88b999494404" />
<meta content="Туризм и путешествия" name="classification">
<?/*=$CODE_INPUT['META']*/?>
<link href="{{ asset("css/site.css?t=8") }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="app" class="overhtm">
		@yield('main_body')
</div>
<script src="{{ asset("js/app.js") }}"></script>
</body>
</html>