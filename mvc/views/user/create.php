{{ include('layouts/header.php', {title: 'Inscription'})}}
<div class="container">
    {% if errors is defined %}
    <div class="error">
        <ul>
            {% for error in errors %}
            <li>{{ error }}</li>
            {% endfor %}
        </ul>
    </div>
    {% endif %}
    <form method="post" class="form-login">
        <h2>Inscription</h2>
        <label>Nom
            <input type="text" name="nom">
        </label>
        <label>Adresse
            <input type="text" name="adresse">
        </label>
        <label>Zip code
            <input type="text" name="zipcode">
        </label>
        <label>Phone
            <input type="phone" name="phone">
        </label>
        <label>Password
            <input type="password" name="password">
        </label>
        <label>Email
            <input type="email" name="email">
        </label>

        <input type="hidden" name="stampee_privilege_id" value="2">
        <input type="submit" class="btn" value="Save">
    </form>
</div>
{{ include('layouts/footer.php')}}