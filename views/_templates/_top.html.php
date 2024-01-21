<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php use App\AppRepoManager;
        use App\Session;

        echo $title_tag ?></title>
    <!-- import bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link
            rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
            crossorigin="anonymous"
    >
    <!--    import cdn icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/style.css">

</head>
<body>

<div id="container">
    
<header>
    

<div>
    <a href="/">
        <img src="/img/logo.png" style="width:10%; margin-left: 3%; margin-top: 1%; margin-bottom:1%">
    </a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-danger" style="margin-left:10%;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bienvenue</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Accueil</a>
        </li>
        
      

        <li class="nav-item">
          <a class="nav-link" href="/addlogement">Ajouter un logement</a>
        </li>
        
        
        <li class="nav-item">
          
          <a class="nav-link" href="/connexion">Connexion</a>

        </li>
        


        <li class="nav-item">
          <a class="nav-link" href="/inscription">Inscription</a>
          
        </li> 
        
       
        
        

        <li class="nav-item">
          <a class="nav-link" href="/logout">Deconnexion</a>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

    </header>
    