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
		<div class="well" id="table-default">
			<!-- 搜索框 -->
			@include('admin.user.index.search')
			<hr>
			<!-- 批量操作块 -->
			@include('admin.user.index.batch')
		<!-- 表格 -->
			<div class="table-responsive vmc-table"></div>
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
	@include('admin.inc.headList')
@endsection

@section('script')
	<script type="text/javascript">
		var block = $('#table-default');
		var search = new vmcList(block, url.table);






		search.init();
		search.submit.execute('page', 'auto');
	</script>
@endsection