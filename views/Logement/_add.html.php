<div class="col-4 d-flex flex-column border p-3">

    <h1><?= $h1_tag ?></h1>

    <form action="/createlogement" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column mb-3">

            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" id="titre">

            <label for="description" class="form-label">Description</label>
            <textarea name="description" rows="5" cols="72" ></textarea>

            <label for="pays" class="form-label">Pays</label>
            <input type="text" name="pays" class="form-control" id="pays">

            <label for="ville" class="form-label">Ville</label>
            <input type="text" name="ville" class="form-control" id="ville">

            <label for="prix" class="form-label">Prix</label>
            <input type="number" name="prix" class="form-control" id="prix">

            <label for="taille" class="form-label">Taille</label>
            <input type="number" name="taille" class="form-control" id="taille">

            <label for="couchages" class="form-label">Couchages</label>
            <input type="number" name="couchages" class="form-control" id="couchages">

            <input type="hidden" name="user_id" value="<?php echo $user -> id ?>">
        </div>
        <div class=" d-flex flex-column mb-3">
            <label for="Type">Choisir le type de logement</label>
            <select name="type_logement_id" id="type_logement_id">
                <?php foreach ($type_logement as $type_logements): ?>
                    <option value="<?php echo $type_logements->id ?>"><?php echo $type_logements->label ?></option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class=" d-flex flex-column mb-3">
            <input type="file" name="image" value=""/>

        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>