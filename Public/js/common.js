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