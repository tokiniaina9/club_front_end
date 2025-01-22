<div class="modal-dialog">
    <form  method="post" action="" id="form_voir_client" role="form" enctype="multipart/form-data">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Information du client</h4>
            </div>
            <div class="modal-body">
                <div>
                    <div id="ref_cli" val="<?php echo ($un_client != null) ? $un_client->ID_CLIENT : '0'; ?>"></div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo ($un_client != null) ? $un_client->NOM : ''; ?>">
                        <div id="nom_err"  style="color: red;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo ($un_client != null) ? $un_client->PHONE : ''; ?>">
                        <div id="phone_err"  style="color: red;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Lien Facebook</label>
                        <input type="text" class="form-control" id="lien" name="lien" value="<?php echo ($un_client != null) ? $un_client->LIEN_FB : ''; ?>">
                    </div>
                </div>
                <div class="">
                    <caption>
                        <h4>Pages assicés à ce client</h4>
                    </caption>
                    <div class="form-group form-inline">
                        <button id="btn_creer_pages" class="btn btn-primary btn-sm glyphicon glyphicon-plus"></button>
                        <button id="btn_modif_pages" class="btn btn-success btn-sm glyphicon glyphicon-pencil"></button>
                        <button id="btn_del_pages" class="btn btn-danger btn-sm glyphicon glyphicon-trash"></button>
                        <button id="btn_ref_pages" class="btn btn-default btn-sm glyphicon glyphicon-refresh"></button>
                    </div>
                    <div class="" style=" overflow: auto; max-height: 150px; margin-top: 10px;">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>nom de la page</th>
                                </tr>
                            </thead>
                            <tbody id="liste_pages_pc">
                                <tr>
                                    <td>Tia mihaingo </td>
                                    <td>sain</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <label for="phone" style="color: white">_</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_submit" class="btn btn-primary">Enregistrer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        load_data_pg_par_client("");
        
        $('#form_voir_client').on('submit',function (evt) {
            evt.preventDefault();
            ajoutClient('#form_voir_client', '#btn_submit', '<?php echo base_url() ?>', $('#ref_cli').attr('val'));
        });

        $(document).on('click', '#btn_ref_pages', function (evt) {
            evt.preventDefault();
            load_data_pg_par_client("");
        });

        function load_data_pg_par_client(query)
        {
            $.ajax({
                url: "<?php echo base_url(); ?>page/listeParClient/" + $('#ref_cli').attr('val'),
                method: "POST",
                data: {query: query},
                success: function (data) {
                    $('#liste_pages_pc').html(data);
                }
            });
        }

        //function ajoutClient(id_form,btn_ok,base_url, groupe, ref, nom, phone, lien) {
        function ajoutClient(id_form, btn_ok, base_url, id_cli) {
            $.ajax({
                url: base_url + "client/sauver/" + id_cli,
                method: "POST",
                enctype: 'multipart/form-data',
                data: $(id_form).serialize(),
                datatype: 'json',
                beforeSend: function () {
                    $('#phone_err').html('');
                    $('#nom_err').html('');
                    $(btn_ok).attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (!data.success) {
                        if (data.nom_error != '') {
                            $('#nom_err').html(data.nom_error);
                        }
                        if (data.phone_error != '') {
                            $('#phone_err').html(data.phone_error);
                        }
                    } else {
                        $('.modal-body').html('<div class="text-center"><h4> Merci,client sauvegardé</h4></div>');
                        $('.modal-title').text('Opération succès');
                        $('.modal-footer').html('');
                    }
                    //$('#notif_principale').html(data.statut);
                    $(btn_ok).attr('disabled', false);
                }
            });
        }
    });
</script>