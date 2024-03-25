{{ include('layouts/header.php', {title: 'Mes produits'}) }}

<div class="container-mes-produits">
    <h1>Mes produits</h1>
    <table class="table-mes-produits">

        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Année</th>
            <th>Pays</th>
            <th>Certifié</th>
            <th>Condition</th>
            <th>Prix</th>
        </tr>

        {% for product in product%}
        <tr>
            <td><a href="{{BASE}}show?id={{product.id}}">{{ product.nom }}</a></td>
            <td>{{ product['description'] }}</td>
            <td>{{ product['annee'] }}</td>
            <td>{{ product['pays'] }}</td>
            <td>{{ product['certifie'] }}</td>
            <td>{{ product['condition_timbre'] }}</td>
            <td>{{ product['prix'] }}</td>
        </tr>
        {% endfor %}

    </table>
    <a href="{{BASE}}create" class="btn">Ajouter un nouveau timbre</a>
</div>

{{ include('layouts/footer.php') }}