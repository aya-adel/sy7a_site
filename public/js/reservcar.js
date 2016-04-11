$(function () { // to check that the document laoded
    var city_id = $("#city_id").val();
    var user_id = $("#user_id").val();
    $('#start').datepicker();
    $('#end').datepicker();
    $("#Search-element").on('click', "#btn", function () {
        var today = new Date();
        var from = $("#start").val();
        var to = $("#end").val();
        var d1 = new Date(from);
        var d2 = new Date(to);
        if (from == '' || to == '')
        {
            alert("Please Fill All Fields");
        } else if (d1 < today)
        {
            alert("From date Is Before Today");
        } else if (d2 <= d1)
        {
            alert("Day From Must Be Before Day To");
        } else {
                $.ajax({
                'url': '/reserv/getcars',
                //dataType: "json",
                'data': {city_id: city_id},
                success: function (response) {
                    var temp = JSON.parse(response);
                    for(i=0; i<temp.length; i++)
                    {
                        $("#rmdata").append(" <tr> "+
                                "<td>"+temp[i][0]['id']+
                                "</td><td>"+
                                temp[i][0]['location_id']+
                                "</td><td>"+temp[i][0]['price']+
                                "<td><input type='button' value='Book' id='"+temp[i][0]['id']+"'></td></tr>");
                    }
                    
                },
            });
        }
    });
});