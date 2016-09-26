@extends('admin.layouts.base')

@section('title','新增用户')

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
			<div class="form-group">
				<label class="control-label" for="f-username">用户名</label>
				<input type="text" name="username" id="f-username" class="form-control auto-gather" maxlength="20">
				<span class="help-block" style="display: none;"></span>
			</div>
			<div class="form-group">
				<label class="control-label" for="f-password">密码</label>
				<input type="password" name="password" id="f-password" class="form-control auto-gather" maxlength="16">
				<span class="help-block" style="display: none;"></span>
			</div>


			<div>
				<button class="btn btn-primary" id="submit">提交</button>
				<button class="btn btn-warning" id="reset">重置</button>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		var url = "{{ url('user/insert') }}";
		$(function () {
			var submit = $.vmcSubmit();
			$('.auto-gather').each(function () {
				var the = $(this);
				submit.reg({
					name: the.attr('name'),
					get: function (name) {
						return the.val();
					},
					set: function (name, value, data) {
						the.val(value);
					}
				});
			});
			submit.success = function (data) {
				$.ajax({
					url: url,
					type: 'POST',
					data: data,
					success: function (data) {
						$('.form-group').removeClass('has-error');
						$('.help-block').empty().hide();
						layer.msg(data, {
							shadeClose: true,
							shade: 0.01
						}, function (index) {
							layer.close(index);
							submit.reset();
						});
					},
					error: function (data) {
						$('.form-group').removeClass('has-error');
						$('.help-block').empty().hide();
						if (data.status === 422) {
							$.each(data.responseJSON, function (name, notice) {
								$('#f-' + name).closest('.form-group').addClass('has-error');
								$('#f-' + name).next('.help-block').text(notice.join('；')).show();
							});
						} else {
							layer.alert('错误');
						}
					}
				});
			};
			$('#submit').on('click', function () {
				submit.execute();
			});
			$('#reset').on('click', function () {
				$('.form-group').removeClass('has-error');
				$('.help-block').empty().hide();
				submit.reset();
			});
			$('.form-control').on('focus', function () {
				$(this).closest('.form-group').removeClass('has-error');
				$(this).next('.help-block').empty().hide();
			});
		});
	</script>
@endsection