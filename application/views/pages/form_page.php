<div class="modal-dialog">
    <form  method="post" action="" id="form_voir_page" role="form" enctype="multipart/form-data">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Information de la page</h4>
            </div>
            <div class="modal-body">
                <div id="ref_page" val="<?php echo ($une_page != null) ? $une_page->ID_PG : '0'; ?>"></div>
                <div class="form-group">
                    <label for="nom">Nom de la page</label>
                        <input type="text" class="form-control" id="nom_page" name="nom_page" value="<?php echo ($une_page != null) ? $une_page->NOM_PG : ''; ?>">
                    <div id="nom_err"  style="color: red;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Lien sur facebook </label>
                    <input type="tel" class="form-control" id="lien_page" name="lien_page" value="<?php echo ($une_page != null) ? $une_page->LIEN : ''; ?>">
                    <div id="lien_err"  style="color: red;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Client propriétaire</label>
                    <select class="form-control " id="select_client" name="select_client" value="<?php echo ($une_page != null) ? $une_page->ID_CLIENT : ''; ?>">

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_sauver_page">Enregistrer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        remplirComboCl("#select_client", "<?php echo base_url() . "client/remplirCombo/" . (($une_page != null) ? $une_page->ID_CLIENT : "0" ); ?>");
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

        function choisirClient(val) {
            $("#select_client").val(val);
        }
        $('#form_voir_page').on('submit', function (evt) {
            evt.preventDefault();
            ajoutPage('#form_voir_page', '#btn_sauver_page', '<?php echo base_url() ?>', $('#ref_page').attr('val'));
        });

        function ajoutPage(id_form, btn_ok, base_url, id_page) {
            $.ajax({
                url: base_url + "page/sauver/" + id_page,
                method: "POST",
                enctype: 'multipart/form-data',
                data: $(id_form).serialize(),
                datatype: 'json',
                beforeSend: function () {
                    $('#nom_err').html('');
                    $(btn_ok).attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (!data.success) {
                        if (data.nom_error != '') {
                            $('#nom_err').html(data.nom_error);
                        }
                    } else {
                        $('.modal-body').html('<div class="text-center"><h4> Merci,Page sauvegardé</h4></div>');
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