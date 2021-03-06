/**
 * Created by raven on 2017/5/23.
 */

var clean = {

    clean_by_id : function (tag, type) {
        $.each(tag, function (i, v) {
            if (type == 1) {
                $('#' + v).val('');
            }
            if (type == 2) {
                $('#' + v).html('');
            }
        })
    }
};

var fill = {
    fill_by_id : function (tag, data, type) {
        var k;
        $.each(tag, function (i, v) {
            '' == v ? k = i : k = v;
            if (type == 1) {
                $('#' + i).val(data[k]);
            } else if (type == 2) {
                $('#' + i).html(data[k]);
            }
        })
    }
};

/**
 * 提交表单
 * @type {{submit: submit.submit}}
 */

var submit = {
    submit : function (url, data) {
        if (!data) {
            data = $('#submitForm').serialize();
        }

        $.post(url, data, function (res) {
            message.message(res);
        }, "JSON");
    }
};

/**
 * 获取数据
 * @type {{message: message.message}}
 */
var getInfo = {

    getToken : function (url, set, type) {
        var data = $('form').serialize();
        $.post(url, data, function (res) {
            if (res.status == 1) {
                return fill.fill_by_id(set, res, type);
            } else {
                message.message({info : res.info, status : res.status});
            }
        }, "JSON");
    },

    getInfo : function (url, data, set) {
        $.post(url, data, function (res) {
            if (res.status == 1) {
                $.each(set, function (i, v) {
                    fill.fill_by_id(v.set, res, v.type);
                });
                return;
            } else {
                message.message({info : res.info, status : res.status});
            }
        }, "JSON");
    },
    
    getSelect : function (url,where,id,value) {
        var option;
        $.post(url,where,function (res) {
            $.each(res,function (i,v) {
                option = '<option value="'+ v.id +'">' + v[value] + '</option>';
                $('#'+id).append(option);
            });
        },"JSON")
    }
};

var check = {

    Auth : function (id,data) {
        var group_url = '/AuthGroup/Edit';
        var rules_url = '/AuthRule/edit_';
        $.post(group_url,{id:id},function (res) {
            var rules = res.rules.split(',');
            console.log(rules);
            $.each(data,function (i,v) {
                $.post(rules_url,{id:v,name:'name'},function (result) {
                    if ($.inArray(result.id,rules) == -1){
                        $('#'+i).hide();
                    }
                },"JSON");
            });
        },"JSON");
    }
};

var message = {
    message : function (info) {
        if (info.status == 1) {
            return swal({
                title             : info.info,
                timer             : 1500,
                type              : 'success',
                showConfirmButton : false
            }, function () {
                if (info.url) {
                    window.location.href = info.url;
                }else {
                    swal.close();
                }
            })
        } else if (info.status == 2) {
            return swal({
                title             : info.info,
                timer             : 1500,
                type              : 'error',
                showConfirmButton : false
            }, function () {
                if (info.url) {
                    window.location.href = info.url;
                }else {
                    swal.close();
                }
            })
        } else if (info.status == 9) {
            return swal({
                title             : '您没有权限进行该操作',
                timer             : 1500,
                type              : 'error',
                showConfirmButton : false
            }, function () {
                if (info.url) {
                    window.location.href = info.url;
                }else {
                    swal.close();
                }
            })
        } else {
            return swal(info.info, '', 'error');
        }
    },

    //未开发的功能
    undo : function () {
        message.message({info : 'Coding', status : 0});
    }
};