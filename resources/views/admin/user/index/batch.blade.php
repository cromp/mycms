<div class="row m-tool">
	<div class="col-md-8 col-sm-12">
		<div class="row">
			<div class="col-sm-4">
				<select class="item form-control" id="batch-action">
					<option value="">-- 批量操作 --</option>
					<option value="delete">删除</option>
					<option value="forbid">禁用</option>
					<option value="resume">启用</option>
				</select>
			</div>
			<div class="col-sm-4">
				<button type="button" class="item btn btn-primary" id="batch-submit"><span class="glyphicon glyphicon-play"></span> 执行</button>
			</div>
		</div>
	</div>
	<div class="item col-md-4 col-sm-12 vmc-text-right">
		<!-- 列表顶部分页块 -->
		<include file="Inc/pageButton"/>
	</div>
</div>