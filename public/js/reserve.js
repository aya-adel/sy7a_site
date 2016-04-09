$(function () { // to check that the document laoded
   $('#hotel').autocomplete({
        source: function (request, response) {
                        var name = $("#hotel").val();

            $.ajax({
                
                    'url': '/reserv/getallhotels',
                     dataType: "json",
                    'data': { name: name },
                    success: function (data) {
                    $("#hotel").autocomplete({
                        source: data,
                    }
                    );
                },
                
		autoFocus: true,	      	
		minLength: 0,
		appendTo: "#imp",
            });
        }
});

/*    $("#hotel").autocomplete({
        source: function (request, response) {
            var name = $("#hotel").val();
            $.ajax({
                url: "/reserv/getallhotels",
                data: {name: name},
                dataType: "json",
                success: function (data) {
                    $("#hotel").autocomplete({
                        source: data,
                    }
                    );
                }
            })
        },
        minLength: 0
    });

*/
});