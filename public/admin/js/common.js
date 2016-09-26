var url = {};
//--------------------------------------------------------------------------------
// 加载
//--------------------------------------------------------------------------------
$(function () {
	var loading;
	var ajaxflag = 0;
	var loadingStatus = function (status) {
		if (true === status) {
			ajaxflag++;
		} else {
			ajaxflag--;
		}
		if (ajaxflag > 0) {
			loading = layer.load(0, {
				shade: [0.1, '#fff'] //0.1透明度的白色背景
			});
		} else {
			layer.close(loading);
		}
	};
	$(document).ajaxSend(function () {
		loadingStatus(true);
	}).ajaxComplete(function () {
		loadingStatus(false);
	});
});

$.ajaxSetup({
	headers: {
		'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')
	}
});
//--------------------------------------------------------------------------------
// 全局事件
//--------------------------------------------------------------------------------
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
