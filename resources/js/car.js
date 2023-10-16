$(document).ready(function() {
    $('body').on('click','.delete-icon', function(e){
        e.preventDefault();

        var id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "/car-delete",
            data: { 'id' : id },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        }).done(function (response) {
            console.log('success');
            window.location.href = '/dashboard';
        }).fail(function (error) { console.log(error); });

    });
    function initMap() {
        const myLatLng = { lat: 0, lng: 0 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Your Location",
        });
    }
    window.onload = initMap();
});
