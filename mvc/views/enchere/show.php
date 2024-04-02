{{ include('layouts/header.php', {title: 'Enchère'}) }}

<main class="main-produit">
    <div class="page-produit">
        <div class="timbre">
            <div class="timbre-photo">
                <i class="fa-solid fa-chevron-left"></i>
                <div class="photo-produit-g">
                    <img src="{{base}}/uploads/{{image}}" alt="timbre Senna F1" />
                </div>
                <i class="fa-solid fa-chevron-right"></i>
            </div>

            <div>
                <div class="icon-produit">
                    <div class="btn-jaime">
                        J'aime
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="partager">
                        Partager
                        <i class="fa-regular fa-share-from-square"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail-produit">
            <div class="section-detail">
                <h3> {{product.nom}}</h3>
                <p>
                    {{product.description}}
                </p>

                <div class="prix">
                    <p>$ {{product.prix}}</p>
                </div>

                <div class="btn btn-produit">Misez</div>

            </div>

            {{ include('layouts/produitsimilaires.php') }}

        </div>

        {{ include('layouts/footer.php') }}