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
            });
    })

})
