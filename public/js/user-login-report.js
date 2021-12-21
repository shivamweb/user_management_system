function user_history() {
    var id = document.getElementById('user_list').value;
    if (id == "") {
        alert("no data");
    } else {
        jQuery.ajax({
            type: 'get',
            url: 'user-login-history',
            data: "id=" + id,
            success: function (result) {

                var data = JSON.parse(result);
                var logout_status = "";
                var duration = "";
                var list = "<table class=\"table table-striped table-bordered\">";
                list += "<tr><th>Sr.No</th> <th>IP Address</th> <th>Login Time</th> <th>Logout Time</th></tr>";
                for (var i = 0; i < data.length; i++) {
                    list += "<tr>";
                    list += "<td>" + (i + 1) + "</td>";
                    list += "<td>" + data[i].ip_address + "</td>";
                    list += "<td>" + data[i].created_at + "</td>";
                    list += "<td>" + (data[i].status == 0 ? 'Active' : data[i].updated_at) + "</td>"; 
                    list += "</tr>";
                }
                list += "</table>";
                document.getElementById("user_history_list").innerHTML = list;
            }
        });
    }
}