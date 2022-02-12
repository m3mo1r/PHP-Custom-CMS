//$(document).ready(function() {
//    CKEditor
//    ClassicEditor
//    .create( document.querySelector('#content'))
//    .catch( error => {
//        console.error( error);
//    } );
    
//    Summernote
    
//});

$(document).ready(function() {
    // check all boxes
    $('#checkAllBoxes').click(function () {
        if(this.checked) {
            $('.checkBox').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBox').each(function () {
                this.checked = false;
            });
        }
    });
    
    // wysiwyg editor not working with html tag
    $('.content').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold','underline', 'italic', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul','ol','paragraph']],
            ['table', ['table']],
            ['insert', ['link','picture','video']]
        ]
    });
    
    // loader
    var divLoader = '<div id="load-screen"><div id="loading"></div></div>';
    $('body').prepend(divLoader);
    $('#load-screen').delay(700).fadeOut(600, function () {
        $(this).remove();
    });
    
    
});

function LoadUsersOnline() {
    $.get('../includes/functions.php?onl_users=result', function (data) {
        $('.users_online').text(data);
    });
}

setInterval(function () {
    LoadUsersOnline();
}, 500);