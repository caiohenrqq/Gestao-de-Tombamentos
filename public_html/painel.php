<?php
include('src\protecao.php');
include('src\conexao.php');

function adicionar() {
}

function atualizar() {

}

function remover() {

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>tombamentos | painel</title>
    <link rel="stylesheet" href="style.php" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>    
  </head>
  <body>
    <section class="painel-section bg-dark">
      <div class="bem-vindo">
        <div>
          bem-vindo ao painel de tombamentos,
          <?php echo $_SESSION['username'];?>.
          <hr class="linhaMaiorIndependente" />
        </div>

        <!-- tabela -->
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Secretaria</th>
              <th scope="col">Técnico</th>
              <th scope="col">Entrada</th>
              <th scope="col">Saída</th>
              <th scope="col">Prioridade</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <th scope="row">1</th>
              <td>Secretaria</td>
              <td>Técnico</td>
              <td>Entrada</td>
              <td>Saída</td>
              <td>Prioridade</td>
              <td>Status</td>
            </tr>
          </tbody>
        </table>
        <!-- logout, add e refresh -->
        <div class="icons">
          <div class="cadastrar">
            <a href="javascript:void(0);" onclick="cadastrar()">
              <img class="icon" src="/icons/add.svg" alt="adicionar" />
            </a>
          </div>

          <div class="refresh">
            <a href="../src/logout.php">
              <img class="icon" src="/icons/refresh.svg" alt="atualizar" />
            </a>
          </div>

          <div class="remover">
            <a href="../src/logout.php">
              <img class="icon" src="/icons/remove.svg" alt="remover" />
            </a>
          </div>

          <div class="logout">
            <a href="../src/logout.php">
              <img class="icon" src="/icons/logout.svg" alt="deslogar" />
            </a>
          </div>
        </div>

        <!-- sessão adicionar -->

        <!-- nesta sessão, irá aparecer uma caixa que possibilitará a inserção de tombamentos -->
        <div class="janelaCadastrar" id="janelaCadastrar">
          <form action="" method="POST">
            <div class="campoEntrada">
              <label for="">ID</label>
              <input type="text" id="..." name="..." />
            </div>
            <div class="campoEntrada">
              <label for="">Secretaria</label>
              <input placeholder="SEMURFH, SEMAD..." type="text" id="..." name="..." />
            </div>
            <div class="campoEntrada">
              <label for="">Técnico</label>
              <input type="text" id="..." name="..." />
            </div>
            <div class="campoEntrada">
              <label for="">Entrada (DD-MM-YYYY)</label>
              <input class="dataHora" type="datetime-local" id="dataHora" name="dataHora" />
            </div>

            <div class="campoEntrada">
              <label for="">Prioridade:</label>
              <select id="my-single-select" multiple>
                <option value="1">Miníma</option>
                <option value="2">Moderada</option>
                <option value="3">Máxima</option>
              </select>
            </div>

            <div class="campoEntrada">
              <label for="">Descrição</label>
              <input placeholder="Computador Lenovo com problema no HD..." type="text" id="..." name="..." />
            </div>
            
            <div class="btns">
              <button
                type="submit"
                onclick="cadastrar()"
                class="btn btn-outline-dark"
                name="cadastrar"
                value="cadastrar"
              >
                cadastrar
              </button>
              <button onclick="cadastrar()" class="btn btn-outline-dark">
                retornar
                <!-- esse botão irá fazer desaparecer a caixa de criação de novos tombamentos -->
              </button>
            </div>
          </form>
        </div>

        <hr class="linha" />
      </div>
    </section>
    <script>
      var dataHora  = document.querySelector(".dataHora");   
      
      const element = document.getElementById('my-single-select'); // Choices.js
      const choices = new Choices(element, {
        removeItemButton: true,
        placeholderValue: "Priodade",
        addItemText: (value) => `Você só pode selecionar "${value}"`,  // Personaliza a mensagem
        maxItemText: () => 'Apenas uma opção pode ser selecionada!',
        maxItemCount: 1,
        shouldSort: false,
      });
      function dataHoraAtual() {
            const data = new Date();
            const ano = data.getFullYear();
            const mes = String(data.getMonth() + 1).padStart(2, '0');
            const dia = String(data.getDate()).padStart(2, '0');
            const horas = String(data.getHours()).padStart(2, '0');
            const minutos = String(data.getMinutes()).padStart(2, '0');
        
            return `${ano}-${mes}-${dia}T${horas}:${minutos}`;
          }
  
      function cadastrar() {
        let janelaCadastrar = document.querySelector(".janelaCadastrar"); // pega elemento janelaCadastrar
        
        dataHora.value = dataHoraAtual();
        // se janelaCadastrar for TRUE, isto é, se ela existir, utiliza o elemento toggle para alternar entre ativo e desabilitado.
        if (janelaCadastrar) {
        janelaCadastrar.classList.toggle("janelaCadastrar"); // on
        janelaCadastrar.classList.toggle("janelaCadastrarAtivo"); // off
        
        } else {
          console.error("janelaCadastrar não encontrada.")
        }
      }
    </script>
  </body>
</html>