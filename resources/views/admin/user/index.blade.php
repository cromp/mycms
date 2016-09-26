@extends('admin.layouts.base')

@section('title', '用户列表')

@section('main')
	<div class="container-fluid">
		<!-- 标题 -->
		<div class="page-header">
			<div class="row">
				<h3 class="col-md-6">@yield('title')</h3>
				<div class="col-md-6 vmc-text-right">
					@include('admin.user.index.action')
				</div>
			</div>
		</div>
		<!-- 按钮 -->
		<div class="well">
			<!-- 搜索框 -->
			@include('admin.user.index.search')
			<hr>
			<!-- 批量操作块 -->
			@include('admin.user.index.batch')
		<!-- 表格 -->
			<div class="table-responsive" id="table-content"></div>
			<!-- 列表底部分页 -->
			@include('admin.inc.pageFooter')
		</div>
	</div>
@endsection

@section('ext')
	@include('admin.inc.pageConfig')
@endsection

@section('head')
	<script type="text/javascript">
		url.table = "{{ URL::asset('/user/table') }}";
	</script>
	<script type="text/javascript" src="{{ URL::asset(config('custom.src_url').'/admin/js/common.table.js') }}"></script>
@endsection

@section('script')
	<script type="text/javascript">
		$(function () {
			search.execute('page', 'auto');
		});
	</script>
@endsection