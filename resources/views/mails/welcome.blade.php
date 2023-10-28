<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seja Bem vindo</title>
</head>

<style>
  .body {
    background: rgba(237, 242, 247, 1);
    min-height: 100vh;
    min-width: 100%;
    position: relative;
  }
  .corpo {
    width: 90%;
    background-color: white;
    position: absolute;
    top: 100px;
    margin-left: 5%
  }
</style>

<body>

  <div class="body">
    <h2 style="text-align: center; padding: 2rem">Atividades por Página</h2>
    <div class="corpo">
      <div style="margin-left: 36px; margin-right: 12px">
        <h3>Olá! &nbsp; {{$user->name}}</h3>
        <p style="font-size: 18px; text-align: justify">.</p>
      </div>

      <div style="margin-left: 36px; margin-right: 12px">
        <p>Esperamos que faça bom uso da nossa aplicação. </p>
      </div>

      <div style="margin-left: 36px; margin-right: 12px">
        <p>Que a criatividades esteja com vosco :)</p>
      </div>

      <div style="margin-left: 36px; margin-right: 12px">
        <h4>Saudações,</h4>
        <h4 style="margin-top: -12px">Atividades por Página</h4>
      </div>

    </div>

    <div style="margin-top: 500px; text-align: center; color: gray">
      <span>© 2023 NGB. Todos os direitos reservados.</span>
    </div>

  </div>

</body>

</html>
