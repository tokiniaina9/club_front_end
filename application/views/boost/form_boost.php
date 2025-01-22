<div class="modal-dialog">
    <form method="post" action="" id="form_voir_boost" role="form" enctype="multipart/form-data">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Information de la boost</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div id="ref_boost" val="<?php echo ($un_boost != null) ? $un_boost->ID_PROMOTE : '0'; ?>"></div>
                    <label for="phone">Client propriétaire</label>
                    <select class="form-control " id="select_client" name="select_client">

                    </select>
                    <div id="select_client_err"  style="color: red;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Page à booster</label>
                    <select class="form-control " id="select_page" name="select_page">

                    </select>
                    <div id="select_page_err"  style="color: red;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Lien sur Facebook</label>
                    <input type="url" class="form-control" id="lien" name="lien" 
                           value="<?php echo ($un_boost != null) ? $un_boost->LIEN : ''; ?>">
                    <div id="lien_err"  style="color: red;">
                    </div>
                </div>
                <div class="row" >
                    <div class="form-group col-md-6" >
                        <label for="date_fin">Tarif du jour</label>
                        <input type="number" class="form-control text-right" id="tarif" name="tarif"
                               value="<?php echo ($un_boost != null) ? $un_boost->TARIF_JOUR : ''; ?>">
                        <div id="tarif_err"  style="color: red;">
                        </div>
                    </div>
                    <div class="form-group col-md-3" >
                        <label for="paiement">Paiement</label>
                        <select class="form-control " id="paiement" name="paiement"
                                value="<?php echo ($un_boost != null) ? $un_boost->PAYEE : ''; ?>">
                            <option value="0">Non payé</option>
                            <option value="1">Payé</option>
                        </select>
                        <div id="paiement_err"  style="color: red;">
                        </div>
                    </div>
                    <div class="form-group col-md-3" >
                        <label for="paiement">Devise</label>
                        <select class="form-control " id="devise" name="devise"
                                value="<?php echo ($un_boost != null) ? $un_boost->DEVISE : ''; ?>">
                            <option value="$">$</option>
                            <option value="€">€</option>
                            <option value="£">£</option>
                        </select>
                        <div id="devise_err"  style="color: red;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="budget">Budget</label>
                        <input type="number" class="form-control text-right" id="budget" name="budget"
                               value="<?php echo ($un_boost != null) ? $un_boost->BUDGET : '1'; ?>">
                        <div id="budget_err"  style="color: red;">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="jours">Nombre de jour</label>
                        <input type="number" class="form-control text-right" id="jours" name="jours"
                               value="<?php echo ($un_boost != null) ? $un_boost->JOURS : '1'; ?>">
                        <div id="jours_err"  style="color: red;">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="depense">Budget depensé</label>
                        <input type="number" class="form-control text-right" id="depense" name="depense" 
                               value="<?php echo ($un_boost != null) ? $un_boost->MONTANT_DEPENSE : '0'; ?>">
                        <div id="depense_err"  style="color: red;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_debut">Date début</label>
                    <input type="datetime-local" class="form-control" id="date_debut" name="date_debut"
                           value="<?php echo ($un_boost != null) ? $un_boost->DATE_DEBUT : ''; ?>">
                    <div id="date_debut_err"  style="color: red;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="diffusion">Diffusion</label>
                    <select class="form-control " id="diffusion" name="diffusion"
                            value="<?php echo ($un_boost != null) ? $un_boost->STATUT : ''; ?>">
                        <option value="0">En creation de pub</option>
                        <option value="1">En cours d'examen</option>
                        <option value="2">Activé</option>
                        <option value="3">En pause</option>
                        <option value="4">Bloqué</option>
                        <option value="5">Rejeté</option>
                        <option value="6">Terminé</option>
                    </select>
                    <div id="diffusion_err"  style="color: red;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_enreg_boost">Enregistrer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        remplirComboCl("#select_client", "<?php echo base_url() . 'client/remplirCombo/' . (($un_page != null) ? $un_page->ID_CLIENT : '0'); ?>");
        reff = <?php echo ($un_page != null) ? $un_boost->ID_CLIENT : $client->ID_CLIENT; ?>;
        console.log($("#select_client").prop("selected"));

        remplirComboPg("#select_page", "<?php echo base_url() . "page/remplirCombo/"; ?>" + reff + "<?php echo (($un_page != null) ? '/' . $un_page->ID_PG : '/0') ?>");

        $(document).on('change', '#select_client', function () {
            reff = $("#select_client").val();
            remplirComboPg("#select_page", "<?php echo base_url() . "page/remplirCombo/"; ?>" + reff + "<?php echo (($un_page != null) ? '/' . $un_page->ID_PG : '/0') ?>");
            $("#tarif").val($("#select_client option[value='" + $(this).val() + "']").attr("pr"));
        });



        remplirPaiement();
        remplirDiffusion();
        //selectionnClient();

        function selectionnClient() {
            $("#select_client option[value=" +<?php echo ($un_page != null) ? $un_page->ID_CLIENT : 0; ?> + "]").prop('selected', true);
            remplirComboPg("#select_page", "<?php echo base_url() . "page/remplirCombo/"; ?>" + reff + "<?php echo (($un_page != null) ? '/' . $un_page->ID_PG : '/0') ?>");
        }


        function remplirPaiement() {
            $("#paiement option[value=" +<?php echo ($un_boost != null) ? $un_boost->PAYEE : 0; ?> + "]").prop('selected', true);
        }

        function remplirDiffusion() {
            $("#diffusion option[value=" +<?php echo ($un_boost != null) ? $un_boost->STATUT : 0; ?> + "]").prop('selected', true);
        }

        function remplirComboPg(cbl, url) {
            $.ajax({
                url: url,
                method: "post",
                data: {

                },
                beforeSend: function (xhr) {

                },
                success: function (data) {
                    $(cbl).html(data);
                }
            });
        }

        function remplirComboCl(cbl, url) {
            $.ajax({
                url: url,
                method: "post",
                data: {

                },
                beforeSend: function (xhr) {

                },
                success: function (data) {
                    $(cbl).html(data);
                }
            });
        }



        $('#form_voir_boost').on('submit', function (evt) {
            evt.preventDefault();
            ajoutBoost(evt, '#form_voir_boost', '#btn_enreg_boost', '<?php echo base_url() ?>', $('#ref_boost').attr('val'));
        });

    });
</script>