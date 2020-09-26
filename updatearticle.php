<?php require 'include/header.php'; ?>

<?php
require 'connexion.php';




if (isset($_GET['edit'])) {
    $stmt = $conn->prepare('SELECT * from article where idArt=:num limit 1');
    $stmt->bindValue(':num', $_GET["edit"], PDO::PARAM_INT);
    $stmt->execute();
    $singleArticle = $stmt->fetchAll();
    // print_r($singleArticle);
}


?>


<body>
   

    ​
    <main>
        ​
        <div class="container">
            <div class="row ">

                <form class="col-4 mx-auto" method="POST" action="fonc-art.php" enctype="multipart/form-data">
                    <h1>Article</h1>
                    <input hidden type="text" class="form-control" name="id" value="<?= $singleArticle[0]['idArt'] ?>">

                    <div class="form-group">
                        <label for="inputTitle">title</label>
                        <input type="text" class="form-control" name="title" value="<?= $singleArticle[0]['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputContenu">contenu</label>
                        <textarea id="story" name="contenu" rows="10" cols="50"><?= $singleArticle[0]['contenu'] ?></textarea>

                    </div>
                    <div class="form-group">
                        <input hidden type="text" name="old-imgArt" id="" value="<?= $singleArticle[0]['imageArt']; ?>">
                        <div style="height:100px;width:100px;"> <img class="h-100" src="imgs/art/<?php echo $singleArticle[0]['imageArt'] ?>" alt="">
                        </div>
                        <label for="inputImage">image</label>
                        <input type="file" class="form-control-file" name="img-art" value="<?= $singleArticle[0]['imageArt'] ?>">
                    </div>
                    ​
                    ​
                    <div class="form-group">
                        <label for="inputDate">date</label>
                        <input type="date" class="form-control" name="date" value="<?= $singleArticle[0]['dateArt'] ?>">
                    </div>
                    ​
                    ​
                    <div class="form-group">
                        <label for="inputCategorie">categorie</label>
                        <select name="articleCategory">
                            <?php

                            require 'connexion.php';

                            $stmt = $conn->prepare("SELECT id, nomCategorie FROM categorie");
                            $stmt->execute();
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $cat_id=$_GET['edit'];
                            $stmt2 = $conn->prepare("SELECT idCategorie FROM article WHERE idArt=$cat_id");
                            $stmt2->execute();
                            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                            foreach ($stmt->fetchAll() as $k => $v) : 
                              if ($v['id'] ==  $result2["idCategorie"]):
                            ?>
                                <option value="<?php echo  $v['id']; ?>" selected> <?php echo  $v['nomCategorie']; ?> </option>;
                              <?php else: ?>
                                <option value="<?php echo  $v['id']; ?>"> <?php echo  $v['nomCategorie']; ?> </option>;


                            <?php 
                        endif;    
                        endforeach;
                            ?>
                        </select> <br>
                    </div>
                    <div class="form-group">
                        <label for="inputAuteur">auteur</label>
                        <select name="articleAuteur">
                            <?php

                            require 'connexion.php';

                            $stmt = $conn->prepare("SELECT idAuteur, fullName FROM auteur");
                            $stmt->execute();
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $cat_id=$_GET['edit'];
                            $stmt2 = $conn->prepare("SELECT idAuteur FROM article WHERE idArt=$cat_id");
                            $stmt2->execute();
                            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                            foreach ($stmt->fetchAll() as $k => $v) : 
                            if ($v['id'] ==  $result2["idCategorie"]):
                            ?>
                                <option value="<?php echo  $v['idAuteur']; ?>" selected> <?php echo  $v['fullName']; ?> </option>;
                              <?php else: ?>
                                <option value="<?php echo  $v['idAuteur']; ?>"> <?php echo  $v['fullName']; ?> </option>";


                            <?php 
                             endif;  
                            endforeach;
                            ?>
                        </select> <br>
                    </div>
                    ​
                    <button type="submit" name="update" class="btn btn-primary">Confimer</button>
                </form>
            </div>
        </div>
    </main>
</body>
​

</html>