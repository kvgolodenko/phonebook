$(document).ready(function () {
    var regForm = $('#reg_form');
    regForm.on('submit', function (e){
        e.preventDefault();
        data = regForm.serialize();
        $.post("register",
            {
                data: data
            },
            function(data, status){
            });
    })

    var loginForm = $('#login_form');
    loginForm.on('submit', function (e){
       e.preventDefault();
       data = loginForm.serialize();
       $.post("loginCheck",
           {
               data: data
           },
           function (data) {
           var json = JSON.parse(data);
               if (json.status == 1) {
                   window.location.replace('/homepage');
               }
           });
    });

    $('#add_contact').on("click", function (e){
        e.preventDefault();
        $('#add_form').toggleClass('hidden');
    })

    var addForm = $('#add_form');
    addForm.on('submit', function (e){
        e.preventDefault();
        data = addForm.serialize();
        $.post("addUser",
            {
                data: data
            }, function (data) {
                jsonData = JSON.parse(data);
                $('#add_form').toggleClass('hidden');
                iterator = $('#add_contact').data('iterator');
                $('#userlist tbody').append('<tr>'
                    + '<th>' + iterator + '</th>'
                    + '<th>'+ jsonData.firstname + '</th>'
                    + '<th>' + jsonData.lastname + '</th>'
                    + '<th>' + jsonData.email + '</th>'
                    + '<th>' + jsonData.phone + '</th>'
                    + '</tr>'
                )
            }
        );
    })

    $('th').on('click', function (e){
        var span = $(this).children('span');
        var input = $(this).children('input');
        span.toggleClass('hidden');
        input.toggleClass('hidden');
        input.val(span.html());
        input.focus();
    });

    $('#userlist th input').on('keyup', function (e){
        key = e.originalEvent.key;
        value = $(this).val();
        id = $(this).parent().parent().data('userid');
        property = $(this).parent().data('property');
        span = $(this).prev('span');
        if (key == 'Enter') {
            $(this).toggleClass('hidden');
            span.toggleClass('hidden');
            $.post("editUser",
                {
                    input: value,
                    property: property,
                    id: id
                }, function (data) {
                    span.html(value);
                }
            );
        }
    });

    var files;

    $('input[type=file]').on('change', function(){
        files = this.files;
    });

    $('.logo-form').on('submit',function (e){
        e.preventDefault();
        e.stopPropagation();
        var data = new FormData();
        data.append('userId',$(this).data('userid'));
        $.each( files, function( key, value ){
            data.append( key, value );
        });

        $.ajax({
            url: 'editUserLogo',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(respond) {
            },
            fail: function(textStatus){
                console.log(textStatus);
            }
        });
    })

})
