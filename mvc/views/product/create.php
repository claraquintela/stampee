{{ include('layouts/header.php', {title: 'Ajouter un produit'}) }}

<div class="container">
    {% if !session.user_id %}

    <p>Vous devez faire votre loggin</p>

    {% else %}
    <div class="container-form-create-produit">
        <h2>Ajouter un produit</h2>
        <form method="post" class="form-create-product" enctype="multipart/form-data">

            <div>
                <label>Nom du produit* :
                    <input type="text" name="nom" value="{{ product.name }}" required>
                </label>
                {% if errors.nom is defined %}
                <span class="error">{{ errors.nom }}</span>
                {% endif %}
            </div>
            <div>
                <label>Description* :
                    <textarea name="description" required> {{ product.description }}</textarea>
                </label>
                {% if errors.description is defined %}
                <span class="error">{{ errors.description }}</span>
                {% endif %}
            </div>

            <div>
                <label>Prix de départ* :
                    <input type="number" name="prix" value="{{ product.prix }}" required>
                </label>
                {% if errors.prix is defined %}
                <span class="error">{{ errors.prix }}</span>
                {% endif %}
            </div>
            <div>
                <label>Pays* :
                    <input type="text" name="pays" value="{{ product.pays }}" required>
                </label>
                {% if errors.pays is defined %}
                <span class="error">{{ errors.pays }}</span>
                {% endif %}
            </div>

            <div>
                <label>Année* :
                    <input type="text" name="annee" value="{{ product.annee }}" required>
                </label>
                {% if errors.annee is defined %}
                <span class="error">{{ errors.annee }}</span>
                {% endif %}
            </div>
            <div>
                <label>Condition du timbre* :</label>
                <select name="condition_timbre" required>
                    <option>Sélectionner une option</option>
                    <option value="Excellent">Excellent</option>
                    <option value="Bon">Bon</option>
                    <option value="Endommagé">Légèrement endommagé</option>
                    <option value="Abîmé">Abîmé</option>
                </select>
            </div>
            <div>
                <label for="certifie">Ce timbre est certifié?
                    <input type="checkbox" id="certifie" name="certifie" value="Oui">OUI
                    <input type="checkbox" id="certifie" name="certifie" value="Non">NON
                </label>
            </div>

            <div>
                <label>
                    Sélectionnez une image:
                    <input type="file" name="image" required>
                </label>
            </div>

            <input type="hidden" name="stampee_users_id" value="{{session.user_id}}">


            <input type="submit" class="btn" value="Enregistrer">

            <p>*Tous les champs marqués avec un * sont obligatoires</p>
        </form>
    </div>

    {% endif %}
</div>

{{ include('layouts/footer.php') }}