<div id="notif_principale">
</div>
<div id="myModal" class="modal fade" role="dialog">
</div>
<div id="container" class="">
    <ul class="nav nav-tabs menu_pple">
        <li class="active"><a data-toggle="tab" href="#home" class="fa fa-calendar"> Boost</a></li>
        <li><a data-toggle="tab" href="#menu1" class="fa fa-users"> Client</a></li>
        <li><a data-toggle="tab" href="#menu2" class="fa fa-pagelines"> Pages</a></li>
        <li><a data-toggle="tab" href="#menu3" class="fa fa-user-secret"> Moi</a></li>
    </ul>

    <div class="tab-content" style="margin-top: 10px;" >
        <div id="home" class="tab-pane fade in active"  >
            <div class="menu_divers"  >  
                <div class="container">
                    <div class="col-md-2 btn_ctrl text-center">
                        <button id="btn_new_boost" class="btn btn-primary fa fa-plus"> </button>
                        <button id="btn_ref_boost" class="btn btn-default fa fa-refresh"></button>
                    </div>
                    <div class="col-md-3 ">
                        <div class=" input-group">
                            <span class="input-group-addon input-sm glyphicon glyphicon-search"></span>
                            <input class="form-control " onkeyup="filtreBoost()" type="text" placeholder="Rechecher" id="champ_rech_boost" name="champ_rech_boost">
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-xs-6 col-md-3">
                                <select class="form-control" id="tri_statut">
                                    <option value="7">Tous</option>
                                    <option value="0">En creation</option>
                                    <option value="1">En cours d'examen</option>
                                    <option value="2">Activé</option>
                                    <option value="3">En pause</option>
                                    <option value="4">Bloqué</option>
                                    <option value="5">Rejeté</option>
                                    <option value="6">Terminé</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <select class="form-control  " id="tri_paye">
                                    <option value="2">Tous</option>
                                    <option value="1">Payé</option>
                                    <option value="0">Non payé</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <select class="form-control  " id="order">
                                    <option value="TOUT">Ordonné par</option>         
                                    <option value="PAYEE">Paiement</option>
                                    <option value="DATE_DEBUT">Date debut</option>
                                    <option value="DATE_FIN">Date fin</option>
                                    <option value="STATUT">Statut</option>     
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <input class="form-control " type="datetime-local" placeholder="date" id="filtre_date" name="filtre_date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 cont_table" style="overflow: auto; max-height: 450px; margin-top: 10px;">
                <table class="table table-striped table-condensed" id="table_boost" >
                    <thead>
                        <tr >
                        </tr>
                    </thead>
                    <tbody id="liste_boost">
                    </tbody>
                </table>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <div class="container">
                <div class="menu_divers col-lg-12">
                    <div class=" btn_ctrl text-center col-sm-3">
                        <button id="btn_creer_client" class="btn btn-primary fa fa-plus"></button>
                        <button id="btn_ref_client" class="btn btn-default fa fa-refresh"></button>
                    </div>
                    <div class=" input-group col-sm-6">
                        <span class="input-group-addon input-sm glyphicon glyphicon-search"></span>
                        <input class="form-control" id="champ_rech_client" onkeyup="filtreClient()" type="text" placeholder="Rechecher" name="champ_rech_client">
                    </div>

                </div> 
            </div>                       
            <div class="col-lg-12 cont_table" style="overflow: auto; max-height: 450px; margin-top: 10px;">
                <table class="table  table-striped table-condensed" id="table_client" >
                    <thead>
                    </thead>
                    <tbody id="liste_client">
                    </tbody>
                </table>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <div class="container">
                <div class="menu_divers col-lg-12">
                    <div class="btn_ctrl text-center col-sm-3">
                        <button id="btn_creer_pages" class="btn btn-primary fa fa-plus"></button>
                        <button id="btn_ref_pages" class="btn btn-default fa fa-refresh"></button>
                    </div>
                    <div class=" input-group col-sm-6">
                        <span class="input-group-addon input-sm glyphicon glyphicon-search"></span>
                        <input class="form-control" type="text" onkeyup="filtrePage()" placeholder="Rechecher" id="champ_rech_page" name="champ_rech_page">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 cont_table" style="overflow: auto; max-height: 450px; margin-top: 10px;" >
                <table class="table table-striped table-condensed" id="table_pages">
                    <thead>
                    </thead>
                    <tbody id="liste_pages">
                    </tbody>
                </table>
            </div>
        </div>
        <div id="menu3" class="tab-pane fade">
            <div class="col-md-8 col-md-offset-2">
                <div class=" col-lg-12 div_compte_titre ">
                    <h2>Mon compte</h2>
                    <button class="btn btn-default btn-sm pull-right">
                        <a href="<?php echo base_url() . 'user/logout'; ?>">
                            Déconnexion
                        </a>
                    </button>
                </div>
                <div class=" col-md-6 div_compte">
                    <h4>Nom et prenoms</h4>
                    <p class="val_info text-capitalize"><?php echo $moi->NOM; ?></p>
                </div>
                <div class=" col-md-6 div_compte">
                    <h4>Login</h4>
                    <p class="val_info "><?php echo $moi->LOGIN; ?></p>
                </div>
                <div class=" col-md-6 div_compte">
                    <h4>Téléphone</h4>
                    <p class="val_info "><?php echo $moi->PHONE; ?></p>
                </div>
                <div class=" col-md-6 div_compte">
                    <h4>E-mail</h4>
                    <p class="val_info "><?php echo $moi->EMAIL; ?></p>
                </div>

                <div class="col-xs-12" >
                    <div class="">
                        <div class="form-group mt-4" bis_skin_checked="1">
                            <input class="form-check-input" type="checkbox" id="mes_boosts" name="mes_boosts" >
                            <label for="check_remember" class=" text-muted form-check-label">Afficher seulement mes boosts</label>
                        </div>
                        <div>
                            <p class="text-center">
                                Contacter-nous sur notre page facebook
                                <a href="https://m.facebook.com/Game-Pay-MG-2188405827917280/?__tn__=C-R" target="_blank"> Game Pay MG</a>
                                ou 
                                <a href="http://www.facebook.com/PentaDev-Mada-104182167857455/" target="_blank"> PentaDev Mada</a>
                            </p>
                        </div>
                        <div class="text-center">
                            <a data-toggle="tooltip" title="Partager sur facebook" href="https://web.facebook.com/sharer.php?u=<?php echo base_url(); ?>" target="_blank" class="fa fa-facebook" style="margin-right: 25px; font-size: 25px;"></a>
                            <a data-toggle="tooltip" title="Partager sur twitter" href="http://twitter.com/share?text=Ads_manager&<?php echo base_url(); ?>" target="_blank" class="fa fa-twitter" style="margin-right: 25px; font-size: 25px;"></a>
                            <a data-toggle="tooltip" title="Partager sur linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>&title=Ads_manager" class="fa fa-linkedin-square" target="_blank" style="margin-right: 25px; font-size: 25px;"></a>
                        </div>
                    </div>
                    <div class="" style="display: none;">
                        <div class="form-inline text-center">
                            <button class="btn btn-default">
                                <a href="<?php echo base_url() . 'user/logout'; ?>">
                                    Modifier information
                                </a>
                            </button>
                            <button class="btn btn-default ">
                                <a href="<?php echo base_url() . 'user/logout'; ?>">
                                    Modifier mot de passe
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        var miens = null;
        var bu = '<?php echo base_url(); ?>';
        $("#mes_boosts").on('change', function () {
            miens = ($("#mes_boosts").prop("checked")) ? <?php echo $moi->ID_USER; ?> : null;
            load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
        });

        load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
        load_data_cl(bu, "");
        load_data_pg(bu, "");

        $(document).on('change', '#tri_statut', function () {
            load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
        });

        $(document).on('change', '#order', function () {
            load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
        });

        $(document).on('change', '#filtre_date', function () {
            load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
        });

        $(document).on('change', '#tri_paye', function () {
            load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
        });

        $(document).on('click', '#btn_creer_client', function () {
            //$('#myModal').load('<?php //echo base_url() . "client/form_creer/0"; ?>');
            loader('#myModal', '<?php echo base_url() ?>', 'client/form_creer/0');
            $('#myModal').modal('show');
        });

        $(document).on('click', '#btn_creer_pages', function () {
            //$('#myModal').load('<?php //echo base_url() . "page/form_creer/0";  ?>');
            loader('#myModal', '<?php echo base_url() ?>', 'page/form_creer/0');
            $('#myModal').modal('show');
        });

        $(document).on('click', '#btn_new_boost', function () {
            loader('#myModal', '<?php echo base_url() ?>', 'boost/form_creer/0');
            $('#myModal').modal('show');
        });

        $(document).on('click', '#btn_ref_client', function () {
            load_data_cl(bu, "");
            $('#champ_rech_client').val('');
        });

        $(document).on('click', '#btn_ref_pages', function () {
            load_data_pg(bu, "");
            $('#champ_rech_page').val('');
        });

        $(document).on('click', '#btn_ref_boost', function () {
            load_data_bt(bu, '', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val(), miens);
            $('#champ_rech_boost').val('');
        });

        $(document).on('click', '.btn_modif_bt', function () {
            loader('#myModal', bu, 'boost/form_creer/' + $(this).attr('id_bt'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_modif_cl', function () {
            //$('#myModal').load('<?php //echo base_url() . "client/form_creer/";  ?>' + $(this).attr('id_cl'));
            loader('#myModal', '<?php echo base_url() ?>', 'client/form_creer/' + $(this).attr('id_cl'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_modif_pg', function () {
            //$('#myModal').load('<?php //echo base_url() . "page/form_creer/";  ?>' + $(this).attr('id_pg'));
            loader('#myModal', '<?php echo base_url() ?>', 'page/form_creer/' + $(this).attr('id_pg'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_del_bt', function () {
            //$('#myModal').load('<?php //echo base_url() . "outils/form_suppr/0/";  ?>' + $(this).attr('id_bt'));
            loader('#myModal', '<?php echo base_url() ?>', "outils/form_suppr/0/" + $(this).attr('id_bt'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_del_cl', function () {
            //$('#myModal').load('<?php //echo base_url() . "outils/form_suppr/1/";  ?>' + $(this).attr('id_cl'));
            loader('#myModal', '<?php echo base_url() ?>', "outils/form_suppr/1/" + $(this).attr('id_cl'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_del_pg', function () {
            //$('#myModal').load('<?php //echo base_url() . "outils/form_suppr/2/";  ?>' + $(this).attr('id_pg'));
            loader('#myModal', '<?php echo base_url() ?>', "outils/form_suppr/2/" + $(this).attr('id_pg'));
            $('#myModal').modal('show');
        });
    });


</script>
