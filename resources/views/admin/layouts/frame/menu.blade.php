<div class="side" id="vmc-menu">
	<div class="panel">
		<a href="{:U('Index/main')}" class="panel-heading single" target="mainframe">欢迎页</a>
	</div>
	<div class="panel">
		<div class="panel-heading" data-toggle="collapse" data-target="#vmc-menu-user" data-parent="#vmc-menu">用户管理 <span class="caret"></span></div>
		<div class="list-group collapse" id="vmc-menu-user">
			<a href="{{ url('user/create') }}" class="list-group-item" target="mainframe">新增用户</a>
			<a href="{{ url('user') }}" class="list-group-item" target="mainframe">用户列表</a>
			<a href="#" class="list-group-item" target="mainframe">权限</a>
			<a href="#" class="list-group-item" target="mainframe">角色</a>
			<a href="#" class="list-group-item" target="mainframe">已删除用户</a>
		</div>
	</div>
	<div class="panel">
		<div class="panel-heading" data-toggle="collapse" data-target="#vmc-menu-article" data-parent="#vmc-menu">文章管理 <span class="caret"></span></div>
		<div class="list-group collapse" id="vmc-menu-article">
			<a href="#" class="list-group-item" target="mainframe">新增文章</a>
			<a href="#" class="list-group-item" target="mainframe">文章列表</a>
			<a href="#" class="list-group-item" target="mainframe">栏目</a>
			<a href="#" class="list-group-item" target="mainframe">展板</a>
			<a href="#" class="list-group-item" target="mainframe">标签</a>
		</div>
	</div>
</div>