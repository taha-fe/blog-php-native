<?php require 'include/header.php'; ?>

<?php require 'connexion.php';




if (isset($_GET['updateCat'])) {
    $stmt = $conn->prepare('SELECT * from categorie where id=:num limit 1' );
    $stmt->bindValue(':num', $_GET["updateCat"], PDO::PARAM_INT);
    $stmt->execute();
    $singleCategorie = $stmt->fetchAll();
    // print_r($singleCategorie);
}

?>

<body>
    
    ​
    <main>
        ​
        <div class="container">
            <div class="row ">
                <form class="col-4 mx-auto" method="POST" action="fonc-cat.php" enctype="multipart/form-data">
                    <h1>Categorie</h1>
                    <div class="form-group">
                        <input hidden type="text" name="id-categorie" id="" value="<?= $singleCategorie[0]['id']; ?>">
                        <label for="inputTitle">nomCategorie</label>
                        <input type="text" class="form-control" name="cat-name" value="<?= $singleCategorie[0]['nomCategorie']; ?>">
                    </div>



                    <div class="form-group">
                        <input hidden type="text" name="old-imgCat" id="" value="<?= $singleCategorie[0]['imgCat']; ?>">
                        <div style="height:100px;width:100px;"> <img class="h-100" src="imgs/cat/<?php echo $singleCategorie[0]['imgCat'] ?>" alt="">
                        </div>
                        <label for="inputImage">image</label>
                        <input type="file" class="form-control-file" name="cat-img" value="<?= $singleCategorie[0]['imgCat']; ?>">
                    </div>
                        <button type="submit" name="update" class="btn btn-primary">Confirmer</button>
                </form>
            </div>
        </div>



    </main>
</body>
​

</html>