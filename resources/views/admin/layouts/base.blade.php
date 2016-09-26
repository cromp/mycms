<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
	<meta http-equiv="Content-Style-Type" content="text/css"/>
	<meta http-equiv="Content-Script-Type" content="text/javascript"/>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset(config('custom.src_url').'/common/bootstrap/css/bootstrap.min.css') }}"/>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/jquery/html5shiv.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/jquery/respond.min.js') }}"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset(config('custom.src_url').'/admin/css/common.css') }}"/>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/jquery/jquery-1.11.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/jquery/jquery.cookie.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/layer/layer.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/jquery/vmc.submit.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/admin/js/common.js') }}"></script>
	@yield('head')
</head>
<body>
@yield('main')
@yield('ext')
<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/common/bootstrap/js/bootstrap.min.js') }}"></script>
@yield('script')
</body>
</html>
