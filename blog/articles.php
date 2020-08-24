<?php
try{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=site;charset=utf8', 'root', '');
}
catch (Exeption $e){
    die('Erreur:'.$e->getMessage());    
}
$req = $bdd->query("SELECT b.*,u.prenom, u.nom, c.titre as titre_cat FROM blog b LEFT JOIN utilisateur u ON u.id = b.id_user LEFT JOIN catégorie_blog c ON c.id_categorie =b.id_categorie ORDER BY b.date_creation DESC");

$req= $req->fetchAll();
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
      <div class="row">   
  
        <div class="col-sm-0 col-md-0 col-lg-0"></div>
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 style="text-align: center">Mon blog</h1>
  
          <?php
            if(isset($_SESSION['id']) && $_SESSION['role'] == 1){
          ?>
              <a href="blog/creer-mon-article" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Créer un article</a>
            <?php
              }
            ?>
            <?php
              foreach($req as $r){ 
              ?>  
                <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                  <a href="blog/<?= $r['id'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $r['titre'] ?></a>
                  <div style="border-top: 2px solid #EEE; padding: 15px 0">
                    <?= nl2br($r['text']); ?>
                  </div>
                  <a href="post_article./<?= $r['id'] ?>">Voir plus</a> 
                  <div style="padding-top: 15px; color: black; font-style: italic; text-align: right;font-size: 12px;">
                    Fait par  <?= $r['nom'] . " " . $r['prenom'] ?> le <?= date_format(date_create($r['date_creation']), 'D d M Y à H:i'); ?> dans le thème <?= $r['titre_cat'] ?>
                  </div>
                </div>  
              <?php
              }
            ?>              
        </div>
      </div>
    </div>
    </body>
</html>