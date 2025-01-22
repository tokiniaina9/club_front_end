<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Facebook ads manager</title>

        <meta name="viewport" content="width=device-width, initial-scal=1, shrink-to-fit=no" />

        <link rel="stylesheet" href= '<?php echo base_url() . "assets/bootstrap/css/bootstrap.min.css"; ?> '/>
        <link rel="stylesheet" href= '<?php echo base_url() . "assets/font-awesome/css/font-awesome.css"; ?>'/>
        <link rel="stylesheet" href= '<?php echo base_url() . "assets/css/mycss/mycss.css"; ?> '/>
        <script src= '<?php echo base_url() . "assets/bootstrap/js/jquery-3.3.1.min.js"; ?>'></script>
        <script src= '<?php echo base_url() . "assets/bootstrap/js/bootstrap.min.js"; ?>'></script>
        <script src= '<?php echo base_url() . "assets/js/my_script1.js"; ?>' ></script>
    </head>
    <body>
        <div id="notif_principale">
        </div>
        <div id="myModal" class="modal fade" role="dialog">
        </div>
        <div id="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Boost</a></li>
                <li><a data-toggle="tab" href="#menu1">Client</a></li>
                <li><a data-toggle="tab" href="#menu2">Pages</a></li>
            </ul>

            <div class="tab-content" style="margin-top: 40px;" >
                <div id="home" class="tab-pane fade in active"  >
                    <div class="menu_divers"  >  
                        <div class="col-md-2 btn_ctrl">
                            <button id="btn_new_boost" class="btn btn-primary glyphicon glyphicon-plus"></button>
                            <button id="btn_ref_boost" class="btn btn-default glyphicon glyphicon-refresh"></button>
                        </div>
                        <div class="col-md-3 ">
                            <div class="col-sm-12">
                                <input class="form-control " onkeyup="filtreBoost()" type="text" placeholder="rechecher" id="champ_rech_boost" name="champ_rech_boost">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 col-md-3">
                                <select class="form-control  " id="tri_statut">
                                    <option value="7">Tous</option>
                                    <option value="0">En creation de pub</option>
                                    <option value="1">Activé</option>
                                    <option value="2">Bloqué</option>
                                    <option value="3">En cours d'examen</option>
                                    <option value="4">En pause</option>
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
                                    <option value="PAYEE">Paiement</option>
                                    <option value="DATE_DEBUT">Date debut</option>
                                    <option value="DATE_FIN">Date fin</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <input class="form-control " type="datetime-local" placeholder="date" id="filtre_date" name="filtre_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" style=" overflow: auto; max-height: 450px; margin-top: 20px;">
                        <table class="table table-bordered table-striped table-condensed" id="table_boost">
                            <thead>
                                <tr >
                                    <th class="text-center">Pages</th>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">Tarif du jour</th>                                    
                                    <th class="text-center">Budget</th>
                                    <th class="text-center">Nbr jour</th>
                                    <th class="text-center">Montant</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Payé</th>
                                    <th class="text-center">Début</th>
                                    <th class="text-center">Fin</th>
                                </tr>
                            </thead>
                            <tbody id="liste_boost">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="menu_divers col-lg-12">
                        <div class="form-group form-inline btn_ctrl">
                            <button id="btn_creer_client" class="btn btn-primary glyphicon glyphicon-plus"></button>
                            <button id="btn_ref_client" class="btn btn-default glyphicon glyphicon-refresh"></button>
                            <input class="form-control" id="champ_rech_client" onkeyup="filtreClient()" type="text" placeholder="rechecher" name="champ_rech_client">
                        </div>
                    </div>                        
                    <div class="col-lg-12" style=" overflow: auto; max-height: 450px; margin-top: 10px;">
                        <table class="table table-bordered table-striped table-condensed" id="table_client" >
                            <thead>
                                <tr>
                                    <th>Nom sur facebook</th>
                                    <th>telephone</th>
                                    <th>nom sur Mvola</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="liste_client">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div class="menu_divers col-lg-12">
                        <div class="form-group form-inline btn_ctrl">
                            <button id="btn_creer_pages" class="btn btn-primary glyphicon glyphicon-plus"></button>
                            <button id="btn_ref_pages" class="btn btn-default glyphicon glyphicon-refresh"></button>
                            <input class="form-control" type="text" onkeyup="filtrePage()" placeholder="rechecher" id="champ_rech_page" name="champ_rech_page">
                        </div>
                    </div>
                    <div class="col-xs-12" style=" overflow: auto; max-height: 450px; margin-top: 10px;">
                        <table class="table table-bordered table-striped table-condensed" id="table_pages">
                            <thead>
                                <tr>
                                    <th>nom de la page</th>
                                    <th>client associé</th>
                                </tr>
                            </thead>
                            <tbody id="liste_pages">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
<script>
    $(document).ready(function () {
//        load_data_bt('',$("#tri_statut").val(),$("#order").val(),$("#filtre_date").val(),$("#tri_paye").val());
        load_data_bt('', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val());
        //load_data_bt("");
        load_data_cl("");
        load_data_pg("");

        $(document).on('change', '#tri_statut', function () {
            load_data_bt('', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val());
        });

        $(document).on('change', '#order', function () {
            load_data_bt('', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val());
        });

        $(document).on('change', '#filtre_date', function () {
            load_data_bt('', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val());
        });

        $(document).on('change', '#tri_paye', function () {
            load_data_bt('', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val());
        });

        $(document).on('click', '#btn_creer_client', function () {
            $('#myModal').load('<?php echo base_url() . "client/form_creer/0"; ?>');
            $('#myModal').modal('show');
        });

        $(document).on('click', '#btn_creer_pages', function () {
            $('#myModal').load('<?php echo base_url() . "page/form_creer/0"; ?>');
            $('#myModal').modal('show');
        });

        $(document).on('click', '#btn_new_boost', function () {
            loader('#myModal', '<?php echo base_url() ?>', 'boost/form_creer/0');
            $('#myModal').modal('show');
        });

        $(document).on('click', '#btn_ref_client', function () {
            load_data_cl("");
        });

        $(document).on('click', '#btn_ref_pages', function () {
            load_data_pg("");
        });

        $(document).on('click', '#btn_ref_boost', function () {
            load_data_bt('', $("#tri_statut").val(), $("#order").val(), $("#filtre_date").val(), $("#tri_paye").val());
        });

        $(document).on('click', '.btn_modif_bt', function () {
            loader('#myModal', '<?php echo base_url() ?>', 'boost/form_creer/' + $(this).attr('id_bt'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_modif_cl', function () {
            $('#myModal').load('<?php echo base_url() . "client/form_creer/"; ?>' + $(this).attr('id_cl'));
            $('#myModal').modal('show');
        });

        $(document).on('click', '.btn_modif_pg', function () {
            $('#myModal').load('<?php echo base_url() . "page/form_creer/"; ?>' + $(this).attr('id_pg'));
            $('#myModal').modal('show');
        });

        function load_data_bt(query, statut, group, date, paye)
        {
            $.ajax({
                url: "<?php echo base_url(); ?>boost/liste",
                method: "POST",
                data: {query: query,
                    statut: statut,
                    group: group,
                    date: date,
                    paye: paye
                },
                success: function (data) {
                    $('#liste_boost').html(data);
                    if (query != null)
                        $('#label_boost').text('Recherche de ' + query);
                    else
                        $('#label_boost').text('Toutes les boosts');
                }
            });
        }

        function load_data_bt1(query)
        {
            $.ajax({
                url: "<?php echo base_url(); ?>boost/liste",
                method: "POST",
                data: {query: query},
                success: function (data) {
                    $('#liste_boost').html(data);
                    if (query != null)
                        $('#label_boost').text('Recherche de ' + query);
                    else
                        $('#label_boost').text('Toutes les boosts');
                }
            });
        }

        function load_data_pg(query)
        {
            $.ajax({
                url: "<?php echo base_url(); ?>page/liste",
                method: "POST",
                data: {query: query},
                success: function (data) {
                    $('#liste_pages').html(data);
                    if (query != null)
                        $('#label_pages').text('Recherche de ' + query);
                    else
                        $('#label_pages').text('Toutes les pages');
                }
            });
        }

        function load_data_cl(query)
        {
            $.ajax({
                url: "<?php echo base_url(); ?>client/liste",
                method: "POST",
                data: {query: query},
                success: function (data) {
                    $('#liste_client').html(data);
                    if (query != null)
                        $('#label_client').text('Recherche de ' + query);
                    else
                        $('#label_client').text('Tous les clients');
                }
            });
        }

       

    });

    function filtreClient() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("champ_rech_client");
        filter = input.value.toUpperCase();
        table = document.getElementById("table_client");
        tr = table.getElementsByTagName("tr");
        if (tr.length > 0) {

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        } else {
            $("#liste_client").html('<div id="notif_art" class="alert alert-danger text-center alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Désolé, echec de modification!</div>');
        }
    }

    function filtrePage() {
        var input, filter, table, tr, td, td1, i, txtValue1, txtValue2;
        input = document.getElementById("champ_rech_page");
        filter = input.value.toUpperCase();
        table = document.getElementById("table_pages");
        tr = table.getElementsByTagName("tr");
        if (tr.length > 0) {

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td1 = tr[i].getElementsByTagName("td")[1];
                if (td || td1) {
                    txtValue1 = (td.textContent || td.innerText);
                    txtValue2 = (td1.textContent || td1.innerText);
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        } else {
            $("#liste_client").html('<div id="notif_art" class="alert alert-danger text-center alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Désolé, echec de modification!</div>');
        }
    }

    function filtreBoost() {
        var input, filter, table, tr, td, td1, i, txtValue1, txtValue2;
        input = document.getElementById("champ_rech_boost");
        filter = input.value.toUpperCase();
        table = document.getElementById("table_boost");
        tr = table.getElementsByTagName("tr");
        if (tr.length > 0) {

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td1 = tr[i].getElementsByTagName("td")[1];
                if (td || td1) {
                    txtValue1 = (td.textContent || td.innerText);
                    txtValue2 = (td1.textContent || td1.innerText);
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        } else {
            $("#liste_client").html('<div id="notif_art" class="alert alert-danger text-center alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Désolé, echec de modification!</div>');
        }

        //fonction forme boost
       
        


    }
</script>