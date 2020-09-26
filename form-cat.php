<?php require 'include/header.php'; ?>


<body>

    ​
    <main>
        ​
        <div class="container">
            <div class="row ">
                <form class="col-4 mx-auto" method="POST" action="fonc-cat.php" enctype="multipart/form-data">
                    <h1>Categorie</h1>
                    <div class="form-group">
                        <label for="inputTitle">title</label>
                        <input type="text" class="form-control" name="cat-title">
                    </div>
                   

                    </div>
                    <div class="form-group">
                        <label for="inputImage">image</label>
                        <input type="file" class="form-control-file" name="cat-img">
                    </div>
                    ​
                    <button type="submit" name="ajouter" class="btn btn-primary">Confirmer</button>
                </form>
            </div>
        </div>
    </main>
</body>
​

</html>