<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Connexion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="/style.css">
</head>

<?php if ($auth::isRegister())
  $auth::redirect('/connexion'); ?>
<div class="d-flex flex-column border rounded-end p-5 bg-light bg-danger justify-content-center">
  <h1>Inscription</h1>
  <?php if ($form_result && $form_result->hasError()) : ?> <div class="p-15 bg-danger"> <?= $form_result->getError()[0]->getMessage() ?> </div> <?php endif ?> <form action='/register' method="post"> <!-- Email input -->
    <div class="form-outline mb-4"> <label class="form-label">Nom</label> <input class="form-control" type="nom" name="nom" /> </div>
    <div class="form-outline mb-4"> <label class="form-label">Prenom</label> <input class="form-control" type="prenom" name="prenom" /> </div>
    <div class="form-outline mb-4"> <label class="form-label">Adresse mail</label> <input class="form-control" type="email" name="email" /> </div>
    <div class="form-outline mb-4"> <label class="form-label">Mot de passe</label> <input class="form-control" type="password" name="password" /> </div>
    <div class="mb-4"> <label class="form-label">Choix du role</label> <select class="form-select" aria-label="Default select example" name="is_host">
        <option value="0">Standard</option>
        <option value="1">Annonceur</option>
      </select> </div>
    <!-- Submit button --> <button type="submit" class="btn btn-outline-danger btn-block mb-4">Inscription</button>
  </form>
</div>
</div>