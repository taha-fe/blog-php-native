
<?php 
require 'include/header.php';
include('connexion.php');
$id = $Article = $title =  $img = $contenu = $idCategorie = "";
if (isset($_GET['id'])) {
         
        $stmt = $conn->prepare('SELECT * from article Where idCategorie = ?');

        $stmt->execute([$_GET['id']]);
        $Articles = $stmt->fetchAll();
      

        

}
?>
<main>
<section class="col-12  bg-light">
                <div class=" py-5">

                    <div class="row col-9 m-auto">
                        <?php foreach ($Articles as $article) : ?>
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <h1 style="text-align: center"><?= $article['title']; ?></h1>
                                    <div style="height:400px;width:90%;margin:0 auto;"> <img style="width:100%;" class="h-100" src="imgs/art/<?= $article['imageArt']; ?>" alt=""></div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?= substr($article['contenu'], 0, 100) . " ..."; ?> </font>
                                            </font>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <font style="vertical-align: inherit;">
                                                        <a href="art.php?vue=<?= $article['idArt'];  ?>" name="vue">
                                                            <font style="vertical-align: inherit;">Vue</font>
                                                        </a>
                                                    </font>
                                                </button>
                                            </div>
                                            <small class="text-muted">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;"><?= $article['dateArt']; ?></font>
                                                </font>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

            </section>
</main>
</body>

</html>