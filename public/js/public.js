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
                console.log(data);
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
    });

    var files;

    $('input[type=file]').on('change', function(){
        files = this.files;

        if ($(this).hasClass('editlogo')) {
            $(this).parent('.logo-form').submit();
        }
    });

    var addForm = $('#add_form');
    addForm.on('submit', function (e){
        e.preventDefault();
        var formData  = new FormData();
        formData.append('formData', addForm.serialize());
        $.each( files, function( key, value ){
            formData.append( key, value );
        });
        $.ajax({
            url: 'addUser',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(jsonData) {
                $('#add_form').toggleClass('hidden');
                iterator = $('#add_contact').data('iterator');
                $('#userlist tbody').append('<tr>'
                    + '<th><a href="contact/' + jsonData.lastId +'">' + iterator + '</a></th>'
                    +'<th><div class="logoblock">' +
                        '<img class="logo-img" src="' + jsonData.logopath +'">' +
                    '</div>' +
                    '<form class="logo-form" data-userId="<?= $user->id?>" enctype="multipart/form-data" action="#">\n' +
                    '<label for="logofile<?=$user->id?>">Change Logo</label>' +
                    '<input id="logofile<?=$user->id?>" name="logofile" type="file" class="editlogo hidden">' +
                    '<input name=""type="submit" class="hidden">' +
                    '</form></th>'
                    + '<th class="firstname" data-property="firstname"><span>'+ jsonData.firstname + '</span>'
                    + '<input class="hidden" type="text"></th>'
                    + '<th class="lastname" data-property="lastname"><span>' + jsonData.lastname + '</span>'
                    + '<input class="hidden" type="text"></th>'
                    + '<th class="email" data-property="email"><span>' + jsonData.email +'</span>'
                    + '<input class="hidden" type="text"></th>'
                    + '<th class="phone" data-property="phone"><span>' + jsonData.phone + '</span>'
                    + '<input class="hidden" type="text"></th>'
                    + '</tr>'
                )
            },
            fail: function(textStatus){
                console.log(textStatus);
            }
        });
    });

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



    $('.logo-form').on('submit',function (e){
        e.preventDefault();
        e.stopPropagation();
        var img_block = $(this).prev('.logoblock');
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
            success: function(data) {
                img_block.html('<img class="logo-img" src=' + data +'>');
            },
            fail: function(textStatus){
                console.log(textStatus);
            }
        });
    })

})
