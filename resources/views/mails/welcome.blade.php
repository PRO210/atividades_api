<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/mail.css') }}">

  <title>Seja Bem vindo</title>
</head>

<body>

  <div class="body">
    <h2>Atividades por Página</h2>
    <div class="corpo">
      <div class="div-paragrafo">
        <h3>Olá! &nbsp; {{$user->name}}</h3>
        <p style="font-size: 18px; text-align: justify">.</p>
      </div>

      <div class="div-paragrafo">
        <p>Esperamos que faça bom uso da nossa aplicação. </p>
      </div>

      <div class="div-paragrafo">
        <p>Que a criatividades esteja convosco :)</p>
      </div>

      <div class="div-paragrafo">
        <h4>Saudações,</h4>
        <h4 style="margin-top: -12px">Atividades por Página</h4>
      </div>

    </div>

    <div class="footer">
      <span>© 2023 NGB. Todos os direitos reservados.</span>
    </div>

  </div>

</body>

</html>
