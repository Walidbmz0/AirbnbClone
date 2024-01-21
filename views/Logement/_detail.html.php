<div class="Logement-title">
    <h1><?= $title_tag ?></h1>
</div>
        <div class="Logement">
            <img src="/img/<?= $logement->image ?>"
                 alt="<?= $logement->titre ?>"
            >

        </div>
        <div class="description">
            <p>
                <?= $logement->description ?>
            </p>

        </div>
        <div class="prix btn btn-danger">
            <p>
                <?= $logement->prix ?>€
            </p>
        </div>
    </div>

