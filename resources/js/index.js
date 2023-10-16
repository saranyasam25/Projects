$(document).ready(function() {
    // Show Password
    $('body').on('click','#login', function(e){
        e.preventDefault();
        var x = document.getElementById("my_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });
    $('body').on('click','#myfunction', function(e){
        e.preventDefault();
        var x = document.getElementById("my_password");
        var y = document.getElementById("confirm_password");
        if ((x.type && y.type) === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    });

    // Logout
    $('body').on('click','.post-logout', function(e){
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/userlogout",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        }).done(function (response) {
            window.location.href = '/';
        }).fail(function (error) { console.log(error); });
    })

    // Data Table
    $('#example').DataTable();
});

