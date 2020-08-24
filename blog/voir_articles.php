<?php
try{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=site;charset=utf8', 'root', '');
}
catch (Exeption $e){
    die('Erreur:'.$e->getMessage());    
}
$req = $bdd->query("SELECT b.*,u.prenom, u.nom, c.titre as titre_cat, b.text FROM blog b LEFT JOIN utilisateur u ON u.id = b.id_user LEFT JOIN catégorie_blog c ON c.id_categorie =b.id_categorie ORDER BY b.date_creation DESC");

$req= $req->fetch();
?>
<html>
<head>
<meta charset="utf-8"> 
    <title>blog</title>
<link rel="stylesheet" media="screen" type="text/css" href="feuille de style general.php">

</head>
<body>
<?php 
    require_once('../menu.php');
    
    ?>

     <div class="container">
    <div class="row" style="margin-top: 20px">  
        <div class="col-sm-12 col-md-12 col-lg-12">                 
          <a class="btn btn-primary" href="articles.php" role="button">Retour</a>
          <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
            <h1 style="color: #666; text-decoration: none; font-size: 28px;"><? $req['titre'] ?></h1>
            <div style="border-top: 2px solid #EEE; padding: 15px 0">
              <?= nl2br($req['text']); ?>
            </div>
            <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
              Fait par  <?= $req['nom'] . " " . $req['prenom'] ?> le <?= date_format(date_create($req['date_creation']), 'D d M Y à H:i'); ?> dans le thème <?= $req['titre_cat'] ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>