{{ include('layouts/header.php', {title: 'Enchères'}) }}


{{ include('layouts/aside.php') }}

<main class="container-main">

    <div class="main-grid">

        {% for item in data %}

        <div class="main-grid__tuile">
            <div>
                <img src="{{base}}/uploads/{{item['image']}}" alt="" class="main-grid__image" />

                <h3>{{item['product']['nom']}} </h3>
                <div class="countdown">
                    <h4>Temps restant:</h4>

                    <div>
                        <p data-js-productId="{{item['product']['id']}}"></p>
                        <script>
                            countdown(`{{item['dateFinal']}}`, `{{item['product']['id']}}`);
                        </script>
                    </div>
                </div>

            </div>
            <a href="{{BASE}}mise/create?id={{item['id']}}" class="btn">Miser</a>
            <a href="{{BASE}}enchere/show?id={{item['product']['id']}}" class="btn">En savoir plus</a>
        </div>

        {% endfor %}
    </div>

    </section>
    {{ include('layouts/footer.php') }}