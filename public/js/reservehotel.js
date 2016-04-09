$(function () { // to check that the document laoded

    var city_id = $("#city_id").val();
    var user_id = $("#user_id").val();

    $('#start').datepicker();
    $('#end').datepicker();
    $('#name').autocomplete({
        source: function (request, response) {
            var name = $("#name").val();

            $.ajax({
                'url': '/reserv/getallhotels',
                dataType: "json",
                'data': {name: name, city_id: city_id},
                success: function (data) {
                    $("#name").autocomplete({
                        source: data,
                    }
                    );
                },
            });
        }
    });

    $("#Search-element").on('click', "#btn", function () {
        //alert("Search");
        //alert(new Date("y-m-d"));
        var today = new Date();


        //d1.
        var from = $("#start").val();
        var to = $("#end").val();
        var d1 = new Date(from);
        var d2 = new Date(to);
        var room_type = $("#room_type").val();
        var hotelname = $("#name").val();
        if (from == '' || to == '' || hotelname == '')
        {
            alert("Please Fill All Fields");
        } else if (d1 < today)
        {
            alert("From date Is Before Today");
        } else if (d2 <= d1)
        {
            alert("Day From Must Be Before Day To");
        } else if (room_type === '0')
        {
            alert("Please Select Room Type");
        } else {
                var hotelname = $("#name").val();
                $.ajax({
                'url': '/reserv/getrooms',
                //dataType: "json",
                'data': {hotelname: hotelname, roomtype: room_type},
                success: function (response) {
                    var temp = JSON.parse(response);
                   
                    //alert(temp[0]['price']);
                    $("#rmdata").append(" <h1> "+hotelname+" Rooms </h1>");
                    
                    
                },
            });
        }
    });
});