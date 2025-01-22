function loader(cbl, bu, url) {
            $.ajax({
                url: bu + url,
                method: "post",
                data: {

                },
                beforeSend: function (xhr) {
                    $(cbl).html(
                            '<div class="modal-dialog col-xs-12 text-center" style="height: 45%;">\n\
                            <div class="modal-content">\n\
                            <div class="modal-header">\n\
                            <button type="button" class="close" data-dismiss="modal">&times;</button>\n\
                            <h4 class="modal-title">Chargement</h4></div>\n\
                            <div class="modal-body text-center">'
                            + '<div class="form-group col-xs-12 text-center" >'
                            + '<img src="' + bu + 'assets/img/wait/spinner.gif">'
                            + '</div></div></div>');
                },
                success: function (data) {
                    $(cbl).html(data);
                    $(cbl).modal('show');
                }
            });
        }

       function ajoutBoost(evt,id_form, btn_ok, base_url, id_boost) {
           evt.preventDefault();
            $.ajax({
                url: base_url + "boost/sauver/" + id_boost,
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
                            $('#select_client_err').html(data.select_client_error);
                            $('#select_page_err').html(data.select_page_error);
                            $('#budget_err').html(data.budget_error);
                            $('#jours_err').html(data.jours_error);
                            $('#date_debut_err').html(data.date_debut_error);
                            $('#diffusion_err').html(data.diffusion_error);
                            $('#devise_err').html(data.devise_error);
                            $('#tarif_err').html(data.tarif_error);  
                    } else {
                        $('.modal-body').html('<div class="text-center"><h4> Merci, Boost sauvegardé</h4></div>');
                        $('.modal-title').text('Opération succès');
                        $('.modal-footer').html('');
                        //load_data_bt("");
                    }
                    //$('#notif_principale').html(data.statut);
                    $(btn_ok).attr('disabled', false);
                }
            });
        }
        
         function load_data_bt(bu, query, statut, group, date, paye, m_bst)
        {
            $.ajax({
                url: bu + "boost/liste",
                method: "POST",
                data: {query: query,
                    statut: statut,
                    group: group,
                    date: date,
                    paye: paye,
                    mes_boosts: m_bst
                },
                success: function (data) {
                    $('#liste_boost').html(data);
                    if (query != null)
                        $('#label_boost').text('Recherche de ' + query);
                    else
                        $('#label_boost').text('Toutes les boosts');
                    filtreBoost();
                }
            });
        }

        function load_data_bt1(bu,query)
        {
            $.ajax({
                url: bu +"boost/liste",
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

        function load_data_pg(bu,query)
        {
            $.ajax({
                url: bu +"page/liste",
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

        function load_data_cl(bu,query)
        {
            $.ajax({
                url: bu+"client/liste",
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
    
    function entrer(btn_ok, base_url, id_form) {
            $.ajax({
                url: base_url + "user/login/",
                method: "POST",
                enctype: 'multipart/form-data',
                data: $(id_form).serialize(),
                datatype: 'json',
                beforeSend: function () {
                    $('#login_error').html('');
                    $('#mdp_error').html('');
                    $(btn_ok).attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (!data.success) {
                        if (data.login_error != '') {
                            $('#login_error').html(data.login_error);
                        }
                        if (data.mdp_error != '') {
                            $('#mdp_error').html(data.mdp_error);
                        }
                        
                        if(data.statut !=''){
                            $('#notif').html(data.statut);
                        }
                    } else {
                        $('html').load(data.content);
                    }
                    //$('#notif_principale').html(data.statut);
                    $(btn_ok).attr('disabled', false);
                }
            });
        }