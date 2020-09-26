<?php require 'include/header.php'; ?>


<body>


    ​
    <main>
        ​
        <div class="container">
            <div class="row ">
                    
                <form class="col-4 mx-auto" method="POST" action="fonc-art.php" enctype="multipart/form-data">
                    <h1>Article</h1>
                    <div class="form-group">
                        <label for="inputTitle">title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="inputContenu">contenu</label>
                        <textarea id="story" name="contenu"
                        rows="10" cols="50"></textarea>

                    </div>
                    <div class="form-group">
                        <label for="inputImage">image</label>
                        <input type="file" class="form-control-file" name="img-art">
                    </div>
                    ​
                    ​
                    <div class="form-group">
                        <label for="inputDate">date</label>
                        <input type="date" class="form-control" name="date">
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
                            
                            foreach($stmt->fetchAll() as $k=>$v): ?>
                                <option value="<?php echo  $v['id'];?>"> <?php echo  $v['nomCategorie'];?> </option>";
                              
                                
                            <?php endforeach;
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
                            
                            foreach($stmt->fetchAll() as $k=>$v): ?>
                                <option value="<?php echo  $v['idAuteur'];?>"> <?php echo  $v['fullName'];?> </option>";
                              
                                
                            <?php endforeach;
                             ?>
                        </select> <br>
                    </div>
                    ​
                    <button type="submit" name="submit" class="btn btn-primary">Confimer</button>
                </form>
            </div>
        </div>
    </main>
</body>
​

</html>