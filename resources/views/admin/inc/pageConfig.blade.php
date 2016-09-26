<div class="modal" id="page-config" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">分页设置</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<select class="form-control auto-gather" name="page_rows">
						<volist name="pageRows" id="vo">
							<option value="{$key}" <eq name="pageConfig.rows" value="$key">selected="selected"</eq>>{$vo}</option>
						</volist>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control auto-gather" name="page_field">
						<volist name="pageOrderFields" id="vo">
							<option value="{$key}" <eq name="pageConfig.field" value="$key">selected="selected"</eq>>按{$vo.0}</option>
						</volist>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control auto-gather" name="page_sort">
						<volist name="pageSort" id="vo">
							<option value="{$key}" <eq name="pageConfig.sort" value="$key">selected="selected"</eq>>{$vo}</option>
						</volist>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="auto-gather" name="page_name" value="{$pageConfigName}">
				<button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
			</div>
		</div>
	</div>
</div>
