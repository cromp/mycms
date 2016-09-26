@extends('admin.layouts.base')

@section('title', '管理平台')

@section('main')
	@include('admin.index.frame.topbar')
	<div class="container-fluid">
		<div class="row wrap">
			@include('admin.index.frame.menu')
			<div class="main">
				<iframe src="{{ url('/home') }}" name="mainframe" id="mainframe" frameborder="no" scrolling="yes"></iframe>
			</div>
		</div>
	</div>
@endsection

@section('head')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset(config('custom.src_url').'/admin/css/frame.css') }}"/>
@endsection

@section('script')
	<script type="text/javascript">
		$(function () {
			// 布局尺寸
			$(window).on('resize load', function () {
				var wrapHeight = $(window).height() - $('#topbar').outerHeight(true);
				$('.wrap').height(wrapHeight);
			});
			// 导航
			$('#vmc-menu').find('.single').on('click', function () {
				$('#vmc-menu').find('.collapse').collapse('hide');
			});
		});
	</script>
@endsection
