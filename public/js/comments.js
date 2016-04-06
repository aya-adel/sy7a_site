if (window.XMLHttpRequest)
{
    var xhr = new XMLHttpRequest();
} else
{
    var xhr = new ActiveXObject('Microsoft.XMLHTTP');
}
function edit(post_id)
{
    var btn = document.getElementById("postedit" + post_id.valueOf());
    var textarea = document.getElementById("post" + post_id.valueOf());
    if (btn.value === "edit")
    {
        btn.value = "save";
        textarea.removeAttribute("disabled");
    } else
    {
        btn.value = "edit";
        textarea.setAttribute("disabled", "disabled");
        var params = "id=" + post_id + "&content=" + textarea.value;
        xhr.open('POST', "/fas7ny/editpost/", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
    }
}
function del(post_id)
{
    var btn = document.getElementById("postdel" + post_id.valueOf());
    var textarea = document.getElementById("post" + post_id.valueOf());
    var params = "id=" + post_id;
    xhr.open('POST', "/fas7ny/deletepost/", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
    var parent = textarea.parentNode;
    parent.parentNode.removeChild(parent);
}


function editcom(comment_id)
{
    var btn = document.getElementById("comedit" + comment_id.valueOf());
    var textarea = document.getElementById("com" + comment_id.valueOf());
    if (btn.value === "edit")
    {
        btn.value = "save";
        textarea.removeAttribute("disabled");
    } else
    {
        btn.value = "edit";
        textarea.setAttribute("disabled", "disabled");
        var params = "id=" + comment_id + "&content=" + textarea.value;
        xhr.open('POST', "/fas7ny/editcomment/", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
    }
}
function delcom(comment_id)
{
    var btn = document.getElementById("comdel" + comment_id.valueOf());
    var textarea = document.getElementById("com" + comment_id.valueOf());
    var params = "id=" + comment_id;
    xhr.open('POST', "/fas7ny/deletecomment/", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
    var parent = textarea.parentNode;
    parent.parentNode.removeChild(parent);
}
function add(city_id, user_id, user_name, user_image)
{
    if (window.XMLHttpRequest) {
        var xhr1 = new XMLHttpRequest();
    } else
    {
        var xhr1 = new ActiveXObject('Microsoft.XMLHTTP');
    }
    var textarea = document.getElementById("addpost");
    //var textarea = document.getElementById("post"+post_id.valueOf());

    var content = textarea.value;
    
    xhr1.onreadystatechange = function () {
        if (xhr1.readyState === 4 && xhr1.status === 200)
        {
            var response = xhr1.responseText;
            var id = new Number(response);
            
            $('#posts').append(
                    "<div id='post-details" + id + "'>"
                    + "<label>" + user_name + "</label>"
                    + "<img src='" + user_image + "' width='50' height='50'>"
                    + "<textarea id ='post" + id + "' rows='20' cols='100' disabled='disabled'>" + content + "</textarea>"
                    + "<input type = 'button' id='postedit" + id + "'value='edit' onclick='edit(" + id + ")'/>"
                    + "<input type = 'button' id='postdel" + id + "'value='delete' onclick='del(" + id + ")'/>"
                    + "</div>"

                    + "<div>"
                    + "<label>Add New Comment : </label>"
                    + "<textarea id ='addcom"+id+"' rows='3' cols='100'></textarea>"
                    + "<input type='button' value='Add' onclick='addcom("+id+ ","+user_id+",\""+user_name+"\",\""+user_image+"\")'>"
                    +"</div> "

                    + "<hr>");
        }

    };
    var params = "user_id=" + user_id + "&city_id=" + city_id + "&content=" + textarea.value;
    xhr1.open('POST', "/fas7ny/addpost/", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send(params);

    textarea.value = '';
}

function addcom(post_id, user_id, user_name, user_image)
{
   if (window.XMLHttpRequest) {
        var xhr2 = new XMLHttpRequest();
    } else
    {
        var xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
    }
    var textarea = document.getElementById("addcom" + post_id.valueOf());
    //var textarea = document.getElementById("post"+post_id.valueOf());

    var content = textarea.value;

    xhr2.onreadystatechange = function () {
        if (xhr2.readyState === 4 && xhr2.status === 200)
        {
            var response = xhr2.responseText;
            var id = new Number(response);
            $("#post-details" + post_id).append(
                    "<div id='comment-details' style='margin-left: 50px;'>"
                    + "<label>" + user_name + "</label>"
                    + "<img src='" + user_image + "' width='50' height='50'>"
                    + "<textarea id ='com" + id + "' rows='3' cols='100' disabled='disabled'>" + content + "</textarea>"
                    + "<input type = 'button' id='comedit" + id + "'value='edit' onclick='editcom(" + id + ")'/>"
                    + "<input type = 'button' id='comdel" + id + "'value='delete' onclick='delcom(" + id + ")'/>"
                    + "</div><hr>");
        }
//   
    };
    var params = "user_id=" + user_id + "&post_id=" + post_id + "&content=" + textarea.value;
    xhr2.open('POST', "/fas7ny/addcomment/", true);
    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr2.send(params);
    textarea.value = '';
}
