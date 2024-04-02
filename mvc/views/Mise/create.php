{{ include('layouts/header.php', {title: 'Miser'}) }}
<main>
    <div class="container-form-create-produit">

        <form method="post" class="form-activer-enchere">
            <h2>{{ product.nom }}</h2>

            {% if enchere.prixActuel %}
            <label>Offre actuel: {{enchere.prixActuel }}</label>

            <label>Faites votre offre *
                <br><br>
                CAD$ <input type="number" name="offre" min="{{enchere.prixActuel}}" step="0.01" placeholder="{{enchere.prixActuel}}">
                <p>Format correct pour mille dollars et cinquante-trois cents : 1,000.53</p>
            </label>

            <input type="hidden" value="{{enchere.prixActuel}}" name="prix">

            {% else %}

            <label>Offre actuel: {{enchere.prix}}</label>
            <label>Faites votre offre *
                <br><br>
                CAD$ <input type="number" name="offre" min="{{enchere.prixActuel}}" step="0.01" placeholder="{{enchere.prix}}">
                <p>Format correct pour mille dollars et cinquante-trois cents : 1,000.53</p>
            </label>
            <input type="hidden" value="{{enchere.prix}}" name="prix">

            {% endif %}
            <input type="hidden" value="{{enchere.id}}" name="encheres_id">
            <input type="hidden" value="{{session.user_id}}" name="stampee_users_id">



            <input type="submit" value="Miser" class="btn">

            <p>* Votre offre doit être plus grand que l'Offre actuel</p>
        </form>

    </div>

    {{ include('layouts/footer.php') }}