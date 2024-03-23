{{ include('layouts/header.php', {title: 'Ajouter un produit'}) }}

<div class="container">

    <div class="container-form-create-produit">
        <h2>Ajouter un produit</h2>
        <form method="post" class="form-create-product">

            <div>
                <label>Nom du produit* :
                    <input type="text" name="nom" value="{{ product.name }}" required>
                </label>
                {% if errors.nom is defined %}
                <span class="error">{{ errors.nom }}</span>
                {% endif %}
            </div>
            <div>
                <label>Identifiant* :
                    <input type="text" name="identifiant" required>{{ product.identifiant }}</input>
                </label>
                {% if errors.identifiant is defined %}
                <span class="error">{{ errors.identifiant }}</span>
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
                <label>Condition du timbre* :</label>
                <select name="condition" required>
                    <option>Sélectionner une option</option>
                    <option value="nouveau">Nouveau</option>
                    <option value="excellent">Excellent</option>
                    <option value="endommagé">Légèrement endommagé</option>
                    <option value="abîmé">Abîmé</option>
                </select>
            </div>
            <div>
                <label for="certifie">Ce timbre est certifié?
                    <input type="checkbox" id="certifie" name="certifie" value="Oui" required>OUI
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
</div>

{{ include('layouts/footer.php') }}