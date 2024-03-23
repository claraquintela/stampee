{{ include('layouts/header.php', {title: 'Login'})}}
<main class="main-login">
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

        <div class="form-form-login">
            <h2>Bienvenu.e!</h2>
            <form class="form-login" method="POST">
                <label for="email">Votre e-mail:</label>
                <input type="email" id="email" name="email" class="form-login_input" value="exemple@exemple.com" />

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" class="form-login_input" placeholder="Enter your password" />

                <button type="submit" class="btn">Se connecter</button>

                <!-- <div class="inscription-social-midia">
                    <p>Complétez votre inscription avec :</p>
                    <div class="login-icons">
                        <i class="fa-brands fa-facebook" aria-label="Connect with Facebook"></i>
                        <i class="fa-brands fa-google-plus-g" aria-label="Connect with Google"></i>
                    </div>
                </div> -->
            </form>

        </div>
    </div>
    {{ include('layouts/footer.php')}}