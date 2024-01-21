<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body class="d-flex justify-content-center">
<div class="col-4 d-flex flex-column border p-3">
    <?php if ($auth::isAuth()) $auth::redirect('/'); ?>

    <h1>Connexion</h1>

    <?php if ($form_result && $form_result->hasError()) : ?>
        <div class="error">
            <?php echo $form_result->getError()[0]->getMessage() ?>
        </div>
    <?php endif ?>

    <form action="/login" method="post">
        <div class="mb-3">
            <label class="form-label">Email: </label>
            <input class="form-control" type="email" name="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe: </label>
            <input class="form-control" type="password" name="password">
        </div>
        <button type="submit" class="btn btn-danger">Se connecter</button>
    </form>
</div>
</body>
</html>



