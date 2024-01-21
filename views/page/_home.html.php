<!-- Carte qui se génére selon le nombre de logements -->

<div class="container" style="text-align:center;">
<h1><?php echo $h1_tag ?> </h1>
<?php if (empty($logements)) : ?>
    <div>Aucun logements en ce moment</div>
    <?php else : ?>
        <div class="d-flex flex-row flex-wrap justify-content-center col-10">
            <?php foreach ($logements as $logement): ?>
                
            <div class="card m-2" style="width: 22rem;">
                <img src="/img/<?php echo $logement->image ?>"
                     class="card-img-top img-fluid p-3"
                     alt="<?php echo $logement->titre ?>"
                />
                <div class="card-body">
                    <h3 class="card-title"><?php echo $logement->titre ?></h3>
                    <p class="card-text"><?php echo $logement->description ?></p>
                    <p class="card-text"><?php echo $logement->prix ?>€</p>
                    <a href="/logement/<?= $logement->id ?>" class="btn btn-danger">voir détail</a>
                    <a href="/logement/delete/<?= $logement->id ?>" class="btn btn-warning">supprimer</a>
                    
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
            </div>
<?php endif; ?>

