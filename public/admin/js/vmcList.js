/**
 * 列表查询
 * @param elem
 * @param url
 */
var vmcList = function (elem, url) {
	this.elem = elem;
	this.submit = $.vmcSubmit();
	this.url = url;
	this.pageInfo = {
		totalRow: 0,
		totalPage: 1,
		nowPage: 1,
		pageRow: 0
	};
};
/**
 * 初始化
 */
vmcList.prototype.init = function () {
	var that = this,
		elem = that.elem,
		submit = that.submit,
		url = that.url,
		pageInfo = that.pageInfo,
		pageConfigMenuElem = elem.find('.ui.dropdown.vmc-pg-config');
	// 请求服务器
	submit.success = function (data) {
		elem.find('.vmc-table').load(url, data, function () {
			that.loadListCallback(arguments);
		});
	};
	// 注册跳转页面数值
	autoReg(elem, submit, 'page', 'vmc-pg-page');
	// 注册搜索数据
	autoReg(elem, submit, 'condition', 'vmc-auto');
	// 点击上一页下一页按钮事件
	elem.find('.vmc-pg-btn-prev,.vmc-pg-btn-next').on('click', function () {
		var the = $(this);
		if (the.hasClass('disabled')) {
			return false;
		}
		var page = the.hasClass('vmc-pg-btn-prev') ? pageInfo.nowPage - 1 : pageInfo.nowPage + 1;
		if (page < 1) {
			page = 1;
		} else if (page > pageInfo.totalPage) {
			page = pageInfo.totalPage;
		}
		elem.find('.vmc-pg-page').val(page);
		submit.execute('page');
	});
	// 点击跳转按钮事件
	elem.find('.vmc-pg-jump').on('click', function () {
		if (the.hasClass('disabled')) {
			return false;
		}
		submit.execute('page');
	});
	// 分页输入框按回车键执行跳转
	elem.find('.vmc-pg-page').on('keypress', function (e) {
		var keycode = (e.keyCode ? e.keyCode : e.which);
		if (keycode == 13) {
			submit.execute('page');
		}
	});
	// 点击搜索按钮事件
	elem.find('.vmc-search-submit').on('click', function () {
		submit.reset('page', function () {
			submit.execute('page', 'condition');
		});
	});
	// 点击重置按钮事件
	elem.find('.vmc-search-reset').on('click', function () {
		submit.reset('page', 'condition', function () {
			submit.execute('page', 'condition');
		});
	});
	// 初始化分页渲染
	this.setPageInfo();
};
/**
 * 渲染分页数据到界面
 */
vmcList.prototype.setPageInfo = function () {
	var elem = this.elem,
		pageInfo = this.pageInfo;
	elem.find('.vmc-pg-total').text(pageInfo.totalRow);
	elem.find('.vmc-pg-lastpage').text(pageInfo.totalPage);
	elem.find('.vmc-pg-perpage').text(pageInfo.pageRow);
	elem.find('.vmc-pg-currentpage').text(pageInfo.nowPage);
	elem.find('.vmc-pg-page').val(pageInfo.nowPage);
	elem.find('.vmc-pg-btn-first,.vmc-pg-btn-prev').prop('disabled', pageInfo.nowPage <= 1);
	elem.find('.vmc-pg-btn-last,.vmc-pg-btn-next').prop('disabled', pageInfo.nowPage >= pageInfo.totalPage);
	elem.find('.vmc-pg-page,.vmc-pg-jump').prop('disabled', pageInfo.totalPage <= 1)
};
/**
 * 全选/全不选解决方案
 * @param elem
 */
vmcList.prototype.setSelectAll = function (elem) {


	// 全选/全不选
	elem.find('.vmc-select-all').on('click',function () {
		var checked = $(this).prop('checked');
		elem.find('.vmc-select-one').prop('checked', checked);
	});





};
/**
 * 读取列表数据后回调方法
 * 自定义此方法需要在执行init()前重写
 * @param response
 * @param status
 * @param xhr
 */
vmcList.prototype.loadListCallback = function (response, status, xhr) {
	// 加载的节点
	var elem = this.elem.find('.vmc-table').children();
	// 设置全选
	this.setSelectAll(elem);
	// 更新分页信息
	this.pageInfo = $.extend(this.pageInfo, {
		totalRow: elem.data('total'),
		totalPage: elem.data('lastpage'),
		nowPage: elem.data('currentpage'),
		pageRow: elem.data('perpage')
	});
	// 渲染
	this.setPageInfo();
};