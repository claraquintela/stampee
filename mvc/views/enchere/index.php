{{ include('layouts/header.php', {title: 'Enchères'}) }}


{{ include('layouts/aside.php') }}

<main class="main-grid">

    {% for product in product%}

    <div class="main-grid__tuile">
        <div>
            <img src="../assets/img/timbres/timbre6.webp" alt="Canada timbre" />
            <h4>Stampee Senna</h4>
        </div>
        <a href="./produit.html" class="btn">Miser</a>
        <a href="./produit.html" class="btn">En savoir plus</a>
    </div>

    {% endfor %}


    {{ include('layouts/footer.php') }}