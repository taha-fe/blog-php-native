<?php require 'include/header.php'; ?>

<main>
    <div   class="container mt-5 mb-5 ">
        <?php if (isset($_GET['vue'])) {
            $stmt = $conn->prepare('SELECT * from article Where idArt = ?');
            // $stmt->bindValue(':num', $_GET["vue"], PDO::PARAM_INT);
            $stmt->execute([$_GET['vue']]);
            $Articles = $stmt->fetchAll();
            foreach ($Articles as $Article) {
                $id = $Article['idArt'];
                $title =  $Article['title'];
                $img = $Article['imageArt'];
                $contenu = $Article['contenu'];
            }
        }
        ?>
        <div style="background-color: #f5f7fa;height:100px" class="row">
            <input hidden type="text" class="form-control" name="id" value="<?= $id ?>">
            <h1 style="color: #217981; font-family: `Criteria CF;    font-style: oblique" class="col-lg-12 text-center m-auto"><?= $title ?></h1>
        </div>
        <div style="height:600px;width:90%;margin: 20px auto;"> <img style="width:100%; " class="h-100" src="imgs/art/<?= $img ?>" alt=""></div>
        <div class="row" style="width: 90%; margin: 0 auto">
            <p style="font-family: 'Lora', 'Times New Roman', serif;font-size:20px"> <?= $contenu ?></p>
        </div>

        <h5 class="m-5">Commentaires: </h5>

        <?php
        $stmt = $conn->prepare('SELECT * from commentaire where idArticle = ? ORDER BY idCom DESC');
        $stmt->execute([$_GET["vue"]]);
        $Commentaires = $stmt->fetchAll();
        ?>

        <?php foreach ($Commentaires as $Commentaire) : ?>
        <div style="width:90%; margin: 0 auto" class="row d-flex m-5 col-8   shadow-lg justify-content-between align-items-center">


                <div class="row col-8 mb-1 p-3 mb-5 mt-3  rounded align-items-center">
                    <!-- <div class="row justify-content-between"> -->
                        <!-- icon+comment -->
                        <div class="col-md-4">

                        <div class="row justify-content-between align-items-center" >
                            
                            <i class="fa fa-user-o  text-secondary rounded-circle col-md-4 " aria-hidden="true" style="font-size: 30px; width: 32px; height: 32px "></i>
                            <!-- class="rounded-circle " style="width: 32px; height: 32px; -->

                          
    
                                        <div class="">  
                                            <input hidden type="text" class="form-control " name="id" value="<?= $Commentaire['idCom']; ?>">
                                            <h5><?= $Commentaire['NickName'] . " :"; ?></h5>
                                            <div>
                                                <p> <?= $Commentaire['contenuCom']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                        </div>
                        <!-- button -->
                           
                        
                        
                    </div>
                            <div >
                             <a href="insertCom.php?danger=<?= $Commentaire['idCom'] ?>&idarticle=<?= $_GET["vue"] ?>" name='danger' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                             </div>
               
                

                             
                            </div>
                            <?php endforeach;  ?>

        <form method="POST" action="insertCom.php" enctype="multipart/form-data">
            <div style="width:90%; margin: 0 auto">
                <input hidden type="text" class="form-control" name="id" value="<?= $id ?>">
                <h5>ajouter un commentaire </h5>
                <div class="form-group col-4">
                    <label for="inputTitle">Nom:</label>
                    <input type="text" class="form-control" name="nickName" required>
                </div>
                <div class="form-group col-4">
                    <label for="inputTitle">Commentaire:</label>
                    <textarea required cols="50" rows="2" class="form-control" name="contenu"></textarea> <br>
                </div>
                
                <input class="btn btn-lg btn-primary mx-2" name="commentaire" type="submit" />
            </div>
        </form>
    </div>
    </div>
</main>

</body>

</html>