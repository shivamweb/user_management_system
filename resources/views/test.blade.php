<!DOCTYPE html>
<html>
<link href="{{ asset('/css/main.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ URL::asset('/js/style.js') }}"></script> 
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>

<body>
    <div class="bgimg">
        <div class="middle">
            <div class="fadeIn first">
                <img src="image/logo.png" id="icon" alt="User Icon" style="height: 250px;" />
            </div>
            <h1>Records Management System
                <hr>
            </h1>

            <a href="/login"><button class="button button1" type="button">User Dashboard</button></a>
            <a href="new-record"><button class="button button1" type="button">Create New Entry</button></a>
            <a href="admin-login"><button class="button button1" type="button">Admin Dashboard</button></a>
        </div>
    </div>
</body>

</html>