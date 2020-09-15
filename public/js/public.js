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
                console.log(data);
            });
    })

})
