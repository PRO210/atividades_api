<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Recuperação de Senha</title>
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

  .botao {
    border: solid green thin;
    padding: 8px;
    border-radius: 12px;
    background-color: white;
    cursor: pointer;
    transition: 0.30s ease;
  }

  :hover.botao {
    background-color: green;
  }

  /* @media (max-width: 768px) {
    #div-botao{
      background: red;
    }
  } */

  .link {
    color: green;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    padding: 8px;

  }

  :hover.link {
    color: white
  }
</style>

<body>

  <div class="body">
    <h2 style="text-align: center; padding: 2rem">Atividades por Página</h2>
    <div class="corpo">
      <div style="margin-left: 36px; margin-right: 12px">
        <h3>Olá!</h3>
        <p style="font-size: 18px; text-align: justify">Você está recebendo este e-mail porque recebemos uma solicitação
          de redefinição de
          senha para sua conta.</p>
      </div>

      <div style=" margin-top: 24px; margin-bottom: 24px; text-align: center" id="div-botao">
        <button class="botao">
          <a class="link" href="{{$url}}" target="_blank">Atualizar a Senha </a>
        </button>
      </div>

      <div style="margin-left: 36px; margin-right: 12px">
        <p style="font-size: 18px; text-align: justify">Se você não solicitou a redefinição de senha, nenhuma ação
          adicional será necessária.</p>
      </div>

      <div style="margin-left: 36px; margin-right: 12px">
        <h4>Saudações,</h4>
        <h4 style="margin-top: -12px">Atividades por Página</h4>
      </div>
      <hr>

      <div style="margin-left: 36px; margin-right: 12px">
        <p style="font-size: 14px; text-align: justify">Caso o botão acima não funcione, copia e cole essa URL em seu
          navegador:&nbsp;&nbsp; {{$url}}
        </p>
      </div>

    </div>

    <div style="margin-top: 500px; text-align: center; color: gray">
      <span>© 2023 NGB. Todos os direitos reservados.</span>
    </div>

  </div>

</body>

</html>
