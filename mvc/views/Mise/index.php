{{ include('layouts/header.php', {title: 'Mises'}) }}

<main>

    {% if mise %}
    <div class="container-mes-produits">
        <h1>Mes mises</h1>
        <table class="table-mes-produits">

            <tr>
                <th>Enchère</th>
                <th>Nom</th>
                <th>Offre</th>
                <th>Date</th>
            </tr>

            {% for mise in mise%}
            <tr>
                <td><a href="{{BASE}}enchere/show?id={{mise.product_id}}">{{ mise.encheres_id }}</a></td>
                <td>{{ mise['nom'] }}</td>
                <td>{{ mise['offre'] }}</td>
                <td>{{ mise['date'] }}</td>
            </tr>
            {% endfor %}
        </table>
    </div>
    {% else %}
    <p> Vous n'avez pas encore faite une mise </p>
    {% endif %}

    {{ include('layouts/footer.php') }}