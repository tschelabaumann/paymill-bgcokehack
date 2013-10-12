<!DOCTYPE html>
<html>
    <head>
        <title>Berlin Geekettes Hackathon | PAYMILL Live Demo</title>
        <meta http-equiv="content-type"
              content="text/html; charset=utf-8"/>
        <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
        <?php

        //
        // Please download the Paymill PHP Wrapper at
        // https://github.com/Paymill/Paymill-PHP
        // and put the containing "lib" folder into your project
        //

        define('PAYMILL_API_HOST', 'https://api.paymill.com/v2/');


        //
        // PAYMILL private API key (Cockpit -> Settings -> API-Keys)
        //

        define('PAYMILL_API_KEY', '<YOUR-PRIVATE-KEY>');


        //
        // Include PHP Wrapper
        //

        set_include_path(
            implode(PATH_SEPARATOR, array(
                realpath(realpath(dirname(__FILE__)).'/lib'),
                get_include_path())
            )
        );

        if ($token = $_POST['paymillToken']) {
            require "Services/Paymill/Transactions.php";

            $transactionsObject = new Services_Paymill_Transactions(PAYMILL_API_KEY, PAYMILL_API_HOST);

            $params = array(
            'amount'        => '15',   // E.g. "15" for 0.15 EUR!
            'currency'      => 'EUR',  // ISO 4217
            'token'         => $token,
            'description'   => 'ShoppingCartID 12345'
            );

            $transaction = $transactionsObject->create($params);
         }
        ?>
    </head>
    <body style="background-color: #ec4f00; padding: 15px 40px; color: #fff; font-family: Arial;">
        <img src="img/glogo.png" style="margin-bottom: 30px; height: 120px;">
        <img src="img/logo.png" style="margin: 30px 15px; height: 50px;">
        <br>
        <div class="container">
            <h2>We appreciate your first successful transaction!</h2>

            <h4>Transaction:</h4>
            <pre>
               <?php print_r($transaction); ?>
            </pre>
        </div>
        <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
    </body>
</html>