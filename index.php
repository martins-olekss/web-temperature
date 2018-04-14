<?php
$debug = array('default_timezone' => date_default_timezone_get());
?>
<html>
    <head>
        <meta charset="UTF-8">
        <script
                src="https://code.jquery.com/jquery-3.1.1.js"
                integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
                crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style.css" media="screen">
    </head>
    <body>
    <div id="wrapper">
        <div id="content">
            <p>Temperatūra (C)<span id="temperature-value"></span></p>
            <p>Mērijuma laiks: <span id="temperature-time"></p>
            <p><span id="temperature-id"></p>
        </div>

        <div id="debug">
            <pre><?php print_r($debug); ?></pre>
        </div>
    </div>

        <script type="text/javascript">
            setInterval(function(){ ajaxRequest(); }, 1000);

            // Variable to hold request
            function ajaxRequest() {
                // Prevent default posting of form - put here to work in case of errors
                //event.preventDefault();

                // Abort any pending request
                if (typeof request != 'undefined') {
                    request.abort();
                }

                // Fire off the request to /form.php
                request = $.ajax({
                    url: "get.php",
                    type: "post",
                    data: "sensor=1"
                });


                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    jQuery('#temperature-value').text(JSON.parse(response).value);
                    jQuery('#temperature-time').text(JSON.parse(response).time);
                    jQuery('#temperature-id').text(JSON.parse(response).id);
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // Log the error to the console
                    jQuery('#temperature-value').text("Kļūda!");
                    console.error(
                        "The following error occurred: "+
                        textStatus, errorThrown
                    );
                });
            }
        </script>
    </body>
</html>