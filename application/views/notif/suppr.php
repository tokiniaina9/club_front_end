<div class="modal-dialog">
    <form  method="post" action="" id="form_suppression" role="form" enctype="multipart/form-data">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Suppression</h4>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Voullez-vous bien supprimer  
                    
                    <?php echo (($cible == 0) ? "ce boost" : (($cible == 1) ? "ce client" : "cette page")); ?>?</h3>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="btn_supprimer">OUI</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
            </div>
        </div>
    </form>
</div>
<script>

    $(document).ready(function () {

        $('#btn_supprimer').on('click', function (evt) {
            evt.preventDefault();
            suppr('#btn_supprimer', '<?php echo base_url() ?>', <?php echo $objet;?>,<?php echo $cible; ?>);
        });
        
         function suppr(btn_ok, bu,id_obj,cible) {
            $.ajax({
                url: bu + "outils/supprimer/",
                method: "POST",
                enctype: 'multipart/form-data',
                data: {
                    cbl: cible,
                    obj: id_obj
                },
                datatype: 'json',
                beforeSend: function () {
                    $(btn_ok).attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (!data.success) {
                        $('.modal-body').html('<div class="text-center"><h4> '+data.statut+'</h4></div>');
                        $('.modal-title').text('Opération non terminée');
                        $('.modal-footer').html('');
                    } else {
                        $('.modal-body').html('<div class="text-center"><h4>  '+data.statut+'</h4></div>');
                        $('.modal-title').text('Opération succès');
                        $('.modal-footer').html('');
                    }
                    $(btn_ok).attr('disabled', false);
                }
            });
        }
    });
    
    
</script>