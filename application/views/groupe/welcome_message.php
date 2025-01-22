<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Facebook ads manager</title>

        <meta name="viewport" content="width=device-width, initial-scal=1, shrink-to-fit=no">

        <meta property="og:url" content="<?php /* echo $fb_url; */ ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="<?php /* echo $fb_titre; */ ?>"/>
        <meta property="og:description" content="<?php /* echo $fb_description; */ ?>"/>
        <meta property="og:image" content="<?php /* echo $fb_image; */ ?>"/>

        <link rel="stylesheet" href= '<?php echo base_url() . "assets/bootstrap/css/bootstrap.min.css" ?> '>
        <link rel="stylesheet" href= '<?php echo base_url() . "assets/css/mycss/mycss.css" ?> '>
        <link rel="stylesheet" href= '<?php echo base_url() . "assets/css/mycss/monStyle.css" ?> '>
        <link rel="stylesheet" href='<?php echo base_url() . "assets/font-awesome/css/font-awesome.css" ?>'>
        <script src= '<?php echo base_url() . "assets/bootstrap/js/jquery-3.3.1.min.js" ?>'></script>
        <script src= '<?php echo base_url() . "assets/bootstrap/js/bootstrap.min.js" ?>'></script>
        <script src= '<?php echo base_url() . "assets/js/my_script.js" ?>'></script>
    </head>
    <body>

        <div id="container">
            <h1>Welcome to Facebook ads manager!</h1>
            <div class="col-lg-12">
                <div class="form-group form-inline">
                    <button class="btn btn-success glyphicon glyphicon-plus"> Creer</button>
                    <input class="form-control" type="text" placeholder="rechecher" name="recherche">
                    <select class="form-control" id="tri_statut">
                        <option>Tous les statuts</option>
                        <option>En cours d'examen</option>
                        <option>Active</option>
                        <option>Bloqué</option>

                    </select>
                </div>
                <table class="table table-bordered table-striped table-condensed">
                    <caption>
                        <h4>Liste des boost d'aujourd'huit</h4>
                    </caption>
                    <thead>
                        <tr>
                            <th>Pages</th>
                            <th>personnes</th>
                            <th>budget</th>
                            <th>Nombre jours</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Page 1 </td>
                            <td>Prsonne 1</td>
                            <td>5$ </td>
                            <td>5jours</td>
                            <td>30 000Ar</td>
                            <td>En cours d'examen</td>
                            <td>Non payé</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </body>
</html>