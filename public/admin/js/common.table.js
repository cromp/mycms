var search;
var page = {
    totalrows: 0,
    totalpage: 1,
    nowpage: 1
};
//--------------------------------------------------------------------------------
// 全局搜索
//--------------------------------------------------------------------------------
$(function() {
    search = $.vmcSubmit();
    // 发送POST请求
    search.success = function(data) {
        // console.log(data);
        $('#table-content').load(url.table, data, function(response, status, xhr) {
            var $table = $(this).find('#table');
            page.totalrows = $table.data('totalrows');
            page.totalpage = $table.data('totalpage');
            page.nowpage = $table.data('nowpage');
            // 更新分页信息
            $('.page-first,.page-prev').prop('disabled', page.nowpage <= 1);
            $('.page-next,.page-last').prop('disabled', page.nowpage >= page.totalpage);
            $('#page-nowpage').text(page.nowpage);
            $('#page-totalpage').text(page.totalpage);
            $('#page-totalrows').text(page.totalrows);
            $('#search-page').val(page.nowpage).attr('max', page.totalpage);
        });
    };
    // 分页配置
    $('#page-config').find('.auto-gather').each(function() {
        var the = $(this);
        search.reg({
            group: 'auto',
            name: the.attr('name'),
            get: function(name) {
                return the.val();
            },
            set: function(name, value, data) {
                the.val(value);
            }
        });
    });
    // 自动注册搜索条件
    $('#search').find('.search-auto').each(function() {
        var the = $(this);
        search.reg({
            group: 'condition',
            name: the.attr('name'),
            get: function(name) {
                return the.val();
            },
            set: function(name, value, data) {
                the.val(value);
            }
        });
    });
    var pageTip;
    // 注册分页输入框
    search.reg({
        group: 'page',
        name: 'page',
        get: function(name) {
            return $('#search-page').val();
        },
        set: function(name, value, data) {
            $('#search-page').val(value);
        }

    });
    // 第一页
    $('.page-first:enabled').on('click', function() {
        $('#search-page').val(1);
        search.execute('page');
    });
    // 最后一页
    $('.page-last:enabled').on('click', function() {
        $('#search-page').val(page.totalpage);
        search.execute('page');
    });
    // 上一页    
    $('.page-prev:enabled').on('click', function() {
        $('#search-page').val(page.nowpage - 1);
        search.execute('page');
    });
    // 下一页
    $('.page-next:enabled').on('click', function() {
        $('#search-page').val(page.nowpage + 1);
        search.execute('page');
    });
    // 当分页配置界面关闭
    $('#page-config').on('hide.bs.modal', function() {
        search.reset('page', function() {
            search.execute('page', 'auto');
        });
    });
    // 当点击跳转按钮
    $('#search-jump').on('click', function() {
        search.execute('page');
    });
    // 点击搜索按钮
    $('#search-submit').on('click', function() {
        search.reset('page', function() {
            search.execute('page', 'condition');
        });
    });
    // 点击重置按钮
    $('#search-reset').on('click', function() {
        search.reset('page', 'condition', function() {
            search.execute('page', 'condition');
        });
    });
    // 跳转分页输入框只允许输入数字以及在分页输入框按回车键执行跳转
    $('#search-page').on('keyup paste', function() {
        $(this).val($(this).val().replace(/\D|^0/g, ''));
    }).on('keypress', function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == 13) {
            search.execute('page');
        }
    });
});
//--------------------------------------------------------------------------------
// 全选/全不选/行效果
//--------------------------------------------------------------------------------
$(function() {
    var $table = $('#table-content');
    $table.on('click', 'input:checkbox[name="selectall"]', function() {
        var checked = $(this).prop('checked');
        $table.find('input:checkbox[name="selectone"]:enabled').prop('checked', checked).closest('tr').toggleClass('warning', checked);
    }).on('click', 'input:checkbox[name="selectone"]:enabled', function() {
        var totallength = $table.find('input:checkbox[name="selectone"]:enabled').length;
        var checkedlength = $table.find('input:checkbox[name="selectone"]:enabled:checked').length;
        $table.find('input:checkbox[name="selectall"]').prop('checked', totallength <= checkedlength);
        $(this).closest('tr').toggleClass('warning', $(this).prop('checked'));
    });
});
