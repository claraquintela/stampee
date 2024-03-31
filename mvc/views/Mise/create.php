{{ include('layouts/header.php', {title: 'Miser'}) }}
<main>
    <div class="container-form-create-produit">

        <form method="post" class="form-activer-enchere">
            <h2>{{ product.nom }}</h2>
            <label>Durée de l'enchère
                <div class="dure-enchere">
                    3 jours <input type="radio" name="duree-enchere" value="3" checked>
                    7 jours <input type="radio" name="duree-enchere" value="7">
                    15 jours <input type="radio" name="duree-enchere" value="15">
                    30 jours <input type="radio" name="duree-enchere" value="30">
                </div>
            </label>

            <input type="hidden" value="{{product.id}}" name="stampee_produit_id">
            <input type="hidden" value="1" name="status">
            <input type="hidden" value="{{product.prix}}" name="prix">

            <input type="submit" value="Activer enchère" class="btn">
        </form>

    </div>

    {{ include('layouts/footer.php') }}