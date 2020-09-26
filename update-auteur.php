<?php require 'include/header.php'; ?>

<?php require 'connexion.php';
if (isset($_GET['edit'])) {
    $stmt = $conn->prepare('SELECT * from auteur where idAuteur=:num');
    $stmt->bindValue(':num', $_GET["edit"], PDO::PARAM_INT);
    $stmt->execute();
    $singleAuteur = $stmt->fetchAll();
    // print_r($singleAuteur);
}

?>


<!DOCTYPE html>


<body>
   
    ​
    <main>

        <div class="container">
            <div class="row ">
                <form class="col-4 mx-auto  " method="POST" action="foncAut.php" enctype="multipart/form-data">
                    <h1>auteurs</h1>
                    <div class="form-group">
                        <input hidden type="text" name="id-auteur" id="" value="<?= $singleAuteur[0]['idAuteur']; ?>">
                        <label for="inputTitle">Full-name</label>
                        <input type="text" class="form-control" name="aut-name" value="<?= $singleAuteur[0]['fullName']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="inputTitle">Email</label>
                        <input type="email" class="form-control" name="aut-email" value="<?= $singleAuteur[0]['email']; ?>">
                    </div>



                    <div class="form-group">
                        <input hidden type="text" name="old-avatar" id="" value="<?= $singleAuteur[0]['avatar']; ?>">
                        <div style="height:100px;width:100px;"> <img class="h-100" src="imgs/aut/<?php echo $singleAuteur[0]['avatar'] ?>" alt=""></div>
                        <label for="inputImage">image</label>
                        <input type="file" class="form-control-file" name="aut-imag" value="<?= $singleAuteur[0]['avatar']; ?>">
                    </div>
            
            ​
                    <button type="submit" name="update" class="btn btn-primary">Confirmer</button>
            </form>
        </div>
        </div>
    </main>
</body>
​

</html>