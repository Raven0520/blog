/**
 * Created by raven on 2017/5/23.
 */

function message(title,text,status) {
    var type;
    1 != status ? title = 'There is a error !' : title = 'Good Jop !';
    1 == status ? type  = 'success' : '';
    swal({
        title : title,
        text  : text,
        type  : type
    })
}