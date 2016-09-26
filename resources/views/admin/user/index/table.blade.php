<table class="table table-striped table-bordered table-hover" id="table" data-totalrows="{{ $users->total() }}" data-totalpage="{{ $users->lastPage() }}" data-nowpage="{{ $users->currentPage() }}">
	<thead>
	<tr>
		<th class="text-center" width="40">
			<input type="checkbox" name="selectall">
		</th>
		<th class="text-center" width="60">#</th>
		<th>帐号</th>
		<th width="160">姓名/昵称</th>
		<th width="160">校园信息</th>
		<th width="360">最后登录</th>
		<th width="80">登录次数</th>
		<th width="80">邮箱验证</th>
		<th width="80">身份认证</th>
		<th width="80">锁定</th>
		<th width="120">操作</th>
	</tr>
	</thead>
	<tbody>
	@foreach ($users as $user)



		<tr>
			<td class="text-center">
				<input type="checkbox" name="selectone" value="{{ $user->id }}">
			</td>
			<td class="text-center">{{ $user->id }}</td>
			<td><a href="{:U('edit?tpl=detail&id='.$vo['id'])}" class="vmc-open">{{ $user->username }}</a></td>
			<td>
				{{ $user->truename }}
			</td>
			<td>
				{{ $user->email }}
			</td>
			<td>
				{{ $user->last_login_at }}
			</td>
			<td>{{ $user->login_count }}</td>
			<td>

			</td>
			<td>

			</td>
			<td>

			</td>

			<td>
				<eq name="vo.status" value="1">
					<a href="{:U('forbid?id='.$vo['id'])}" class="vmc-ajax">锁定</a>
					<else/>
					<a href="{:U('resume?id='.$vo['id'])}" class="vmc-ajax">启用</a>
				</eq>
				<a href="{:U('edit?id='.$vo['id'])}" class="vmc-open">编辑</a>
				<a href="{:U('delete?id='.$vo['id'])}" class="vmc-ajax vmc-confirm">删除</a>
			</td>
		</tr>

	@endforeach
	</tbody>
</table>
