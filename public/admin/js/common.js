var url = {};
var thisWindowIndex = parent.layer.getFrameIndex(window.name) || null;
/**
 * 为AJAX表单提交添加CSRF
 */
$.ajaxSetup({
	headers: {
		'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')
	}
});
/**
 * 加载动画
 */
$(function () {
	var loadingIndex,
		ajaxFlag = 0,
		dialogStatus = 0,
		loadingToggle = function (status) {
			if (true === status) {
				ajaxFlag++;
			} else {
				ajaxFlag--;
			}
			if (ajaxFlag > 0) {
				if (dialogStatus == 0) {
					loadingIndex = layer.load(0, {
						shade: [0.1, '#FFF'] //0.1透明度的白色背景
					});
					dialogStatus = 1;
				}
			} else {
				layer.close(loadingIndex);
				dialogStatus = 0;
			}
		};
	$(document).ajaxSend(function () {
		loadingToggle(true);
	}).ajaxComplete(function () {
		loadingToggle(false);
	});
});
/**
 * 全局事件委派
 */
$(function () {
	// 点击
	$(document).on('click', '.vmc-open', function (e) {
		e.preventDefault();
		var url, the = $(this),
			that = this;
		if ((url = the.attr('href')) || (url = the.data('url'))) {
			var title = the.data('title');
			title = title ? title : '新建窗口';
			layer.open({
				type: 2,
				title: 0,
				closeBtn: 0,
				shadeClose: false,
				shade: 0.8,
				scrollbar: false,
				move: false,
				//offset: ['auto','100px'],
				area: ['100%', '100%'],
				content: url,
				end: function () {
					var endfunc = the.data('end');
					if ($.type(endfunc) == 'function') {
						endfunc.call(that);
					}
				}
			});
		} else {
			layer.alert('未指定窗口链接！');
		}
		return false;
	}).on('click', '.vmc-ajax', function (e) {
		e.preventDefault();
		var url, the = $(this),
			that = this;
		var success = function (msg, status, xhr) {
			if (msg.url) {
				window.location.href = msg.url;
			} else {
				var endfunc = the.data('end');
				if ($.type(endfunc) == 'function') {
					endfunc.call(that, msg, status, xhr);
				}
			}
		};
		var request = function (url) {
			$.get(url, function (msg, status, xhr) {
				if (msg.status == 1) {
					if (the.hasClass('vmc-noAlert')) {
						success(msg, status, xhr);
					} else {
						layer.msg(msg.info, {
							shade: 0.1,
							shadeClose: true
						}, function (index) {
							layer.close(index);
							success(msg, status, xhr);
						});
					}
				} else {
					layer.alert(msg.info, function (index) {
						layer.close(index);
						if (msg.url) {
							window.location.href = msg.url;
						}
					});
				}
			});
		};
		if ((url = the.attr('href')) || (url = the.data('url'))) {
			if (the.hasClass('vmc-confirm')) {
				layer.confirm('确定执行该操作？', function (index) {
					layer.close(index);
					request(url);
				});
			} else {
				request(url);
			}
		}
		;
	}).on('click', '.vmc-refresh', function (e) {
		e.preventDefault();
		window.location.reload();
	}).on('keyup paste', '.vmc-onlyNumber', function () {
		var value = $(this).val();
		value = value.replace(/\D/g, '');
		value = value == '' ? '' : parseInt(value, 10);
		$(this).val(value);
	});
});
/**
 * 将自动采集数据的字段注册到submit对象
 * @param elem dom对象范围，在此范围采集数据
 * @param submit submit实例化对象
 * @param group 返回到submit中的分组名称
 * @param className 自动采集时查询到class名称
 */
var autoReg = function (elem, submit, group, className) {
	// 原生通用的
	(function () {
		var tag = ['select', 'textarea', 'input:text', 'input:password', 'input:hidden'];
		for (var i = 0; i < tag.length; i++) {
			tag[i] += '.' + className;
		}
		var selector = tag.join();
		elem.find(selector).each(function () {
			var the = $(this);
			submit.reg({
				group: group,
				name: the.attr('name'),
				get: function (name) {
					return the.val();
				},
				set: function (name, value, data) {
					the.val(value);
				}
			});
		});
	})();
	// 自动采集单选框
	(function () {
		var names = elem.find('input:radio.' + className).map(function () {
			return $(this).attr('name');
		}).toArray();
		$.unique(names);
		$.each(names, function (i, name) {
			submit.reg({
				group: group,
				name: name,
				get: function (name) {
					return elem.find('input:radio[name="' + name + '"]:checked:last').attr('value') || '';
				},
				set: function (name, value, data) {
					elem.find('input:radio[name="' + name + '"]').each(function () {
						var the = $(this);
						the.prop('checked', the.attr('value') == value);
					});
				}
			});
		});
	})();
	// 自动采集复选框
	(function () {
		var names = elem.find('input:checkbox.' + className).map(function () {
			return $(this).attr('name');
		}).toArray();
		$.unique(names);
		$.each(names, function (i, name) {
			submit.reg({
				group: group,
				name: name,
				get: function (name) {
					return elem.find('input:checkbox[name="' + name + '"]:checked').map(function () {
						return $(this).attr('value');
					}).toArray();
				},
				set: function (name, value, data) {
					elem.find('input:checkbox[name="' + name + '"]').each(function () {
						var the = $(this);
						the.prop('checked', $.inArray(the.attr('value'), value) >= 0);
					});
				}
			});
		});
	})();
};
