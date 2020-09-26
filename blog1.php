<?php require 'include/header.php';
include('connexion.php');
$req = $conn->prepare('SELECT * FROM article ORDER BY dateArt desc LIMIT 10 ');
$req->execute([]);
$articles = $req->fetchAll();

$req = $conn->prepare('SELECT * FROM categorie LIMIT 10');
$req->execute([]);
$categories = $req->fetchAll();

$req = $conn->prepare('SELECT * FROM auteur LIMIT 10');
$req->execute([]);
$Auteurs = $req->fetchAll();


?>

<main style="">
    <div class="container-fluid px-5">
        <div class="row">
            <section class="col-8  bg-light">
                <div class=" py-5">

                    <div class="row">
                        <?php foreach ($articles as $article) : ?>
                            <div class="col-md-6">
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

            <div class="col-4 mt-5">
                <div class="card">
                    <h3 class="card-header text-center text-danger">
                        Categories
                    </h3>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($categories as $categorie) : ?>
                            <li class="list-group-item">
                                <a href="artcat.php?id=<?= $categorie['id']; ?>"><?= $categorie['nomCategorie'];  ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>


                <div class="card mt-5">
                    <h3 class="card-header text-center text-warning">
                        Auteurs
                    </h3>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($Auteurs as $Auteur) : ?>
                            <li class="list-group-item">
                                <a href="artAut.php?idAuteur=<?= $Auteur['idAuteur']; ?>"><?= $Auteur['fullName'];  ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>
        </div>
    </div>
</main>
</body>

</html>