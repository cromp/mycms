<div class="m-search" id="search">
	<div class="row">
		<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">用户名</span>
				<input type="text" class="form-control search-auto" name="condition_username">
			</div>
		</div>
		<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">姓名</span>
				<input type="text" class="form-control search-auto" name="condition_truename">
			</div>
		</div>
		<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">昵称</span>
				<input type="text" class="form-control search-auto" name="condition_nickname">
			</div>
		</div>
		<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">邮箱</span>
				<input type="text" class="form-control search-auto" name="condition_email">
			</div>
		</div>
		<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">手机号</span>
				<input type="text" class="form-control search-auto" name="condition_mobile">
			</div>
		</div>
		<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<select class="form-control search-auto" name="condition_status">
				<option value="">-- 状态 --</option>
				<option value="1">正常</option>
				<option value="0">禁用</option>
			</select>
		</div>
	</div>
	<div>
		<button type="button" class="btn btn-primary" id="search-submit"><span class="glyphicon glyphicon-search"></span> 查询</button>
		<button type="button" class="btn btn-default" id="search-reset"><span class="glyphicon glyphicon-repeat"></span> 重置</button>
	</div>
</div>