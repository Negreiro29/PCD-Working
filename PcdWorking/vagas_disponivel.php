<?php

  session_start();

  $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
  if (!isset($_SESSION['email'])) {
    header('Location: index.php?error=1');
  }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/tamanho_fonte.js"></script>
    <script type="text/javascript" src="js/comando_voz.js"></script>
    <script type="text/javascript">
      
      $(document).ready(function(){
        /*$('#vagas').click(function(){

          $.ajax({
            url: 'criar_vagas.php',
            method: 'post',
          });
        });*/
        function atualizaVagas(){
          $.ajax({
            url: 'get_vaga.php',
            success: function(data){
              $('#vagas_disp').html(data);

              $('.btn_vincular').click(function(){
                var id_vaga = $(this).data('id_vaga');
                $('#btn_vincular_'+id_vaga).hide();
                $('#btn_desvincular_'+id_vaga).show();
                $.ajax({
                  url: 'vincular.php',
                  method: 'post',
                  data: {vinculado_id_vaga: id_vaga},
                  success: function(data){
                    alert('Candidatura feita com sucesso! Boa sorte!');
                  }
                });
              });

              $('.btn_desvincular').click(function(){
                var id_vaga = $(this).data('id_vaga');
                $('#btn_vincular_'+id_vaga).show();
                $('#btn_desvincular_'+id_vaga).hide();
                $.ajax({
                  url: 'desvincular.php',
                  method: 'post',
                  data: {desvinculado_id_vaga: id_vaga},
                  success: function(data){
                    alert('Candidatura retirada com sucesso!');
                  }
                });
              });
            }
          });
        }

        atualizaVagas();
      });

    </script>

    <title>PCD Working - Vagas para PCD em Petrolina!</title>
    <link rel="shortcut icon" type="images/icon" href="imagens/PCD_Working_01_16x16_px.ico">
  </head>
  <body>

   <!-- Barra topo -->
   <nav class="navbar navbar-fixed-top top-bar">
      <div class="navbar-header">
       <div class="container">
           <div class="row align-items-center">

               <div class="col-md-12">
                   <a href="home.php"><img class="logo" src="imagens/PCD_Working_01.png"></a>
                   <ul class="top-menu">
                       <li><a href="home.php">Início</a></li>
                       <li>|</li>
                       <li><a href="vagas_disponivel.php">Vagas</a></li>
                       <li>|</li>
                       <li><a href="perfil.php">Perfil</a></li>
                       <li>|</li>
                       <li><a href="sair.php">Sair</a></li>
                   </ul>

                   <ul class="acess-menu">
                     <li>
                      <a id="fontmais" onclick="tamanhofonte()" title="Aumentar fonte">A+</a>
                     </li>
                     <li>|</li>
                     <li>
                      <a id="fontmenos" onclick="tamanhofonte()" href="#" title="Diminuir fonte">A-</a>
                     </li>
                     <li>|</li>
                     <li>
                      <a title="Contraste" id="autocontraste" onclick="contraste()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-circle-half" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                        </svg>
                      </a>
                     </li>
                     <li>|</li>
                     <li>
                      <a href="https://www.vlibras.gov.br">
                        <img title="vlibras" src="imagens/vlibras_1.png">
                      </a>
                     </li>
                     <li>|</li>
                     <li>
                       <a href="#" title="Ativar Voz" id="speakbt">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
                            <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"/>
                            <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"/>
                            <path d="M8.707 11.182A4.486 4.486 0 0 0 10.025 8a4.486 4.486 0 0 0-1.318-3.182L8 5.525A3.489 3.489 0 0 1 9.025 8 3.49 3.49 0 0 1 8 10.475l.707.707zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06z"/>
                          </svg>
                       </a>
                       <div id="resultspeak"></div>
                     </li>
                     <li>|</li>
                     <li>
                       <form class="d-flex">
                         <input class="form-control me-2" type="search" placeholder="Pesquisar">
                         <button class="btn btn-outline-info" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                          </svg>
                         </button>
                       </form>
                     </li>
                   </ul>
               </div>
           </div>
       </div>
      </div>
   </nav>

   <!-- Conteudo -->
   <section>
       <div class="container">
           <div class="row">
               <div class="col-md-4"></div>
               <div class="col-md-4 conteudo">

                    <div id="saudacoes">
                        <h1>Vagas Disponiveis</h1>
                    </div>

                    <div class="list-group" id="vagas_disp"  style="border: 2px solid #003399; border-radius: 10px; max-width: 60%; margin-left: 20%; margin-bottom: 10%;" >
                                
                    </div>
               </div>
               <div class="col-md-4"></div>
           </div>
       </div>
   </section>

   <!-- Rodapé -->
   <footer class="footer navbar-fixed-bottom rodape">
       <div class="container" id="links-rodape">
           <div class="row">
               <div class="col-md-6">
                   <h6>Navegação</h6>
                   <ul>
                       <li><a href="vagas_disponivel.php">Vagas</a></li>
                       <li><a href="home.php">Inicio</a></li>
                       <li><a href="sair.php">Sair</a></li>
                   </ul>
               </div>

               <div class="col-md-6" id="outros-links">
                    <h6>Outros Links</h6>
                    <ul>
                        <li><a href="">Intragram</a></li>
                        <li><a href="https://petrolina.pe.gov.br/">Prefeitura de Petrolina</a></li>
                    </ul>
               </div>

               <div id="direitos">
                   <h6>
                     Todos os direitos reservados.
                     <br/>
                     2022
                   </h6>
               </div>
           </div>
       </div>
   </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>