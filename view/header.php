<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Musicazil</title>
    
    <link rel="stylesheet" href="./css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fundo hdr_fonte">
        <div class="container-fluid">
            <a class="navbar-brand hdr_fonte" href="index.php">Musicazil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active hdr_fonte" aria-current="page" href="index.php">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hdr_fonte" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuário
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="viewUser.php">Pesquisar usuário</a></li>
                        <li><a class="dropdown-item" href="viewTudoUser.php">Todos usuários</a></li>
                        <li><hr class="dropdown-divider"></li> 
                        <li><a class="dropdown-item" href="cadUser.php">Cadastrar usuário</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hdr_fonte" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cliente
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="viewClient.php">Pesquisar cliente</a></li>
                        <li><a class="dropdown-item" href="viewTudoClient.php">Todos clientes</a></li>
                        <li><hr class="dropdown-divider"></li> 
                        <li><a class="dropdown-item" href="cadUser.php">Cadastrar cliente</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hdr_fonte" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Música
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="viewMusica.php">Pesquisar música</a></li>
                        <li><a class="dropdown-item" href="viewTudoMusica.php">Todas músicas</a></li>
                        <li><hr class="dropdown-divider"></li> 
                        <li><a class="dropdown-item" href="cadMusica.php">Nova música</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Faça uma pesquisa!" aria-label="Search">
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
            </div>
        </div>
    </nav>