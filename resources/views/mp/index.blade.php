<!DOCTYPE html>
<html>

<head>
    <title>Template Code - Checkout Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    {{-- <script type="text/javascript" src="js/index.js" defer></script> --}}
    {{-- <script src="{{ url('js/mp.js') }}" type="text/javascript" defer></script> --}}

    {{--  SDK MercadoPago.js --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body>
  {{-- <div id="wallet_container"></div> --}}

    {{-- <script>
        const mp = new MercadoPago('TEST-de8311a0-69d0-4399-a644-1424fb49f008');
        const bricksBuilder = mp.bricks();

        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: "<PREFERENCE_ID>",
            },
            customization: {
                texts: {
                    valueProp: 'smart_option',
                },
            },
        });
    </script> --}}

    <div>
      Resposta MP
    </div>

</body>

</html>
