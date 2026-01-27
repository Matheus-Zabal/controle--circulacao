<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
  <a class="navbar-brand" href="#"><!-- <img src="imagens/io48.png" width="48" height="48" alt="">--><B>CONTROLE DE CIRCULAÇÃO</B></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link active" href="index.php">
        Início <span class="sr-only">(página atual)</span>
        </a>
      </li>
      <!--Menu Entrada e Saída -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Registrar Entrada e Saída
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php">Civis/veículos</a>
          <a class="dropdown-item" href="index1.php">Militares</a>
          <a class="dropdown-item" href="index2.php">Permissionários</a>
      </li>
      <!--Fim Dropdown Entrada e Saída -->
      
      <!--Menu Cadastrados -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastrados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="mil_cad.php">Militares</a>
          <a class="dropdown-item" href="perm_cad.php">Permissionários</a>
          <a class="dropdown-item" href="civis_cad.php">Civis</a>
          <a class="dropdown-item" href="vei_cad.php">Veículos</a>
        </div>
      </li>
      <!--Fim Dropdown Entrada e Saída -->
       <li class="nav-item">
        <a class="nav-link" href="pesquisa.php">Pesquisar Entrada e Saída</a>
      </li>
      
       <!--Menu Cadastrados -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastrar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_mil.php">Militares</a>
          <a class="dropdown-item" href="cad_perm.php">Permissionários</a>
          <a class="dropdown-item" href="cad_civis.php">Visitantes</a>
          <a class="dropdown-item" href="cad_vei.php">Veículos</a>
        </div>
      </li>
      <!--Fim Dropdown Cadastrados -->

      <!--Menu Entregas-->
     <!--Menu Entregas-->
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownEntrega" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Entregas
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdownEntrega">
    <a class="dropdown-item" href="cadastro_entrega.php">Cadastrar Entrega</a>
    <a class="dropdown-item" href="listar_entregas.php">Listar Entregas</a>
  </div>
</li>
     
      <!--Menu Gerenciar -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Gerenciar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="todos.php">Militares Ativos</a>
          <a class="dropdown-item" href="todos1.php">Militares Inativos</a>
          <a class="dropdown-item" href="perm_cad1.php">Permissonários Ativos</a>
          <a class="dropdown-item" href="perm_cad2.php">Permissonários Inativos</a>
           <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="usuarios.php">Usuários</a>
          <a class="dropdown-item" href="inserir_usuario.php">Inserir Usuários</a>
          <a class="dropdown-item" href="insere_su.php">Inserir SU</a>
        </div>
        
      </li>
      <!--Fim Dropdown Gerenciar -->
      <li class="nav-item">
        <a class="nav-link" href="altera_senha.php">Alterar Senha</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Sair</a>
      </li>
      
    </ul>
    </div>
</nav>
