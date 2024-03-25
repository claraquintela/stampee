{{ include('layouts/header.php', {title: 'Produit'})}}
<div class="container-editer-produit">
    <h2>Produit</h2>
    <div class="box-editer-produit">
        <p><span class="p-strong">Nom:</span> {{ product.nom }}</p>
        <p><span class="p-strong">Description:</span> {{ product.description }}</p>
        <p><span class="p-strong">Pays:</span> {{ product.pays }}</p>
        <p><span class="p-strong">Année:</span> {{ product.annee }}</p>
        <p><span class="p-strong">Condition:</span> {{ product.condition_timbre }}</p>
        <p><span class="p-strong">Certifié:</span> {{ product.certifie }}</p>
        <p><span class="p-strong">Prix:</span> {{ product.prix }}</p>

        <img src="{{base}}/uploads/{{image}}">

        <div class="btns-editer-produit">
            <a href="{{base}}/product/edit?id={{product.id}}" class="btn block">Edit</a>
            <form action="{{base}}/product/delete" method="post">
                <input type="hidden" name="id" value="{{ product.id }}">
                <button class="btn block red">Delete</button>
            </form>
        </div>
    </div>
</div>
{{ include('layouts/footer.php') }}