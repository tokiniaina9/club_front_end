<div id="formulaire_login" class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" >
    <form  method="post" action="<?php echo base_url() . 'user/login/' ?>" id="form_login" role="form" enctype="multipart/form-data">
        <h2 class="text-center" > Veuillez-vous connecter </h2>
        <div class="form-group">
            <label for="nom">Login</label>
            <input type="text" class="form-control input-lg" id="login" name="login" >
            <div id="login_error"  style="color: red;">
                <?php
                echo ($err_login != "") ? $err_login : "";
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="nom">Mot de passe</label>
            <input type="password" class="form-control input-lg" id="mdp" name="mdp" >
            <div id="mdp_error"  style="color: red;">
                <?php
                echo ($err_mdp != "") ? $err_mdp : "";
                ?>
            </div>
        </div>
        <div id="notif"  style="color: red;">
            <?php
            echo ($notif != "") ? $notif : "";
            ?>
        </div>
        <input type="submit" id="btn_ok" class="btn btn-primary btn-block btn-lg" value="Connexion" />
    </form>
    <div>
        <br>
        <p class="text-center">
            Creer votre compte en nous contactant sur notre page facebook
            <a href="https://m.facebook.com/Game-Pay-MG-2188405827917280/?__tn__=C-R" target="_blank"> Game Pay MG</a>
            ou 
            <a href="http://www.facebook.com/PentaDev-Mada-104182167857455/" target="_blank"> PentaDev Mada</a>
        </p>
    </div>
    <br>
    <div class="text-center">
        <a data-toggle="tooltip" title="Partager sur facebook" href="https://web.facebook.com/sharer.php?u=<?php echo base_url(); ?>" target="_blank" class="fa fa-facebook" style="margin-right: 25px; font-size: 25px;"></a>
        <a data-toggle="tooltip" title="Partager sur twitter" href="http://twitter.com/share?text=Ads_manager&<?php echo base_url(); ?>" target="_blank" class="fa fa-twitter" style="margin-right: 25px; font-size: 25px;"></a>
        <a data-toggle="tooltip" title="Partager sur linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>&title=Ads_manager" class="fa fa-linkedin-square" target="_blank" style="margin-right: 25px; font-size: 25px;"></a>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        bu = '<?php echo base_url() ?>';
    });
</script>