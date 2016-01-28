<div>
    <fieldset class="fieldset_default"><legend class="legend_default"> &nbsp Connexion : &nbsp </legend>
    <form action="<?php echo BASE_PATH . "/" . "utilisateurs" . "/" . "connexion"; ?>" method="post">
        <div>
            <label> Nom d'utilisateur : </label>
            <input id="nom_utilisateur" name="nom_utilisateur" type="text"
                   required
                   /> 
        </div>
        <div>
            <label> Mot de passe : </label>
            <input id="mot_passe" name="mot_passe" type="password"
                   required
                   /> 
        </div>
        <input type="submit" class="btn"
               value="Valider">
    </form>
    </fieldset>
    <br>
</div>
    