$(document).ready(function () {
    refresh = setInterval(function () {
        refreshNotifications();

    }, 1000);


    function refreshNotifications() {
        $.ajax({
            url: './php/refreshNotifications.php',
            dataType: "json",
            success: function (data) {
                if (!data.error) { // this sort of json accessing data only works in ajax
                    if (data.unread != 0) { // wont display notifications label if none exist
                        $('#unreadNotifications').html(data.unread);
                        $('#notifications').html(data.notifications);
                    } else {
                        $('#unreadNotifications').html('');
                        $('#notifications').html(data.notifications);
                    }



                }
            }
        });
    }

    $('#readNotifications').click(function (evt) {
        $(document).click(function () {
            $.ajax({
                url: './php/readNotifications.php',
                success: function (data) {}
            });


        });

    });
});
