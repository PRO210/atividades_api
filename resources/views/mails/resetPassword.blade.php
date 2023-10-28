<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Recuperação de Senha</title>

  <link rel="stylesheet" href="{{ asset('css/mail.css') }}">
</head>


<body>

  <div class="body">

    <h2>Atividades por Página</h2>
    <div class="corpo">
      <div class="div-paragrafo">
        <h3>Olá!</h3>
        <p>Você está recebendo este e-mail porque recebemos uma solicitação
          de redefinição de
          senha para sua conta.</p>
      </div>

      <div class="div-botao">
        <button class="botao">
          <a class="link" href="{{$url ?? ''}}" target="_blank">Atualizar a Senha </a>
        </button>
      </div>

      <div class="div-paragrafo">
        <p>Se você não solicitou a redefinição de senha, nenhuma ação
          adicional será necessária.</p>
      </div>

      <div class="div-paragrafo">
        <h4>Saudações,</h4>
        <h4 style="margin-top: -12px">Atividades por Página</h4>
      </div>
      <hr>

      <div class="div-paragrafo">
        <p>Caso o botão acima não funcione, copia e cole essa URL em seu
          navegador:&nbsp;&nbsp; {{$url ?? ''}}
        </p>
      </div>

    </div>

    <div class="footer">
      <span>© 2023 NGB. Todos os direitos reservados.</span>
    </div>

  </div>

</body>

</html>
