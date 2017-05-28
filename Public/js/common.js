/**
 * Created by raven on 2017/5/23.
 */

var clean = {

    clean_by_id : function (tag,type) {
        $.each(tag,function (i,v) {
            if (type == 1){
                $('#'+v).val('');
            }
            if (type == 2){
                $('#'+v).html('');
            }
        })
    }
};

var set = {
    set_by_id : function (tag,data,type) {
        var k;
        $.each(tag,function (i,v) {
            '' == v ? k = i : k = v;
            if (type == 1){
                $('#'+i).val(data[k]);
            }else if(type == 2){
                $('#'+i).html(data[k]);
            }
        })
    }
};

var submit = {
    submit : function (url,data) {
        if (!data){
            data = $('#submitForm').serialize();
        }
        $.post(url,data,function (res) {
            message.message(res);
        })
    }
};

var message = {
    message : function (info) {
        if (info.status == 1 && info.url){
            return swal({
                title : info.info,
                timer : 1500,
                type  : 'success',
                showConfirmButton : false
            },function () {
                window.location.href = info.url;
            })
        }
        if (info.status == 1){
            return swal(info.info,'','success');
        }else {
            return swal(info.info,'','error');
        }
    }
};