
<?php require 'connexion.php';?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}
$articleTitle = $auteurEmail = $articleContenu =  $articleDate =  $articleCategorie =  $articleAuteur =  $articleImage= '';
if(isset($_POST['submit'])) {
    // uploading category image 
        $myFile = $_FILES['img-art'];
        $myFileName = $_FILES['img-art']['name'];
        $myFileTmpName = $_FILES['img-art']['tmp_name'];
        $myFileSize = $_FILES['img-art']['size'];
        $myFileError = $_FILES['img-art']['error'];
        $myFileType = $_FILES['img-art']['type'];
        global $myFileNewName;
        global $myFileDestination;
        $fileExt = explode('.', $myFileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowedExt)) {
            if($myFileError === 0) {
                if($myFileSize < 5000000) {
                    $myFileNewName = "ImgArt_" . uniqid('', true) . "." . $fileActualExt;
                    $myFileDestination = 'imgs/art/' . $myFileNewName;
                    move_uploaded_file($myFileTmpName, $myFileDestination);
                  
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "there was an error uploading your file";
            }
        } else {
            echo "this file type is not allowed !";
        }
        $articleImage = $myFileNewName;
        $articleTitle = test_input($_POST['title']);
        $articleContenu = test_input($_POST['contenu']);
        $articleDate = test_input($_POST['date']);
        $articleCategorie = test_input($_POST['articleCategory']);
        $articleAuteur = test_input($_POST['articleAuteur']);
        // echo $articleAuteur;
        // echo $articleCategorie;


        $insertArticleQuery = "INSERT INTO article (title, contenu, imageArt, dateArt, idCategorie, idAuteur) 
        VALUES (\"$articleTitle\", \" $articleContenu\", \"$articleImage\" ,now(), \"$articleCategorie\", \" $articleAuteur\" );";
        $prp = $conn-> prepare($insertArticleQuery);
        $prp->execute();
           
      
        echo "Ok";
        header('refresh:1 url=article.php');


   
}

//**********************update*********************/
if(isset($_POST['update'])) {
    // uploading category image 
        $myFile = $_FILES['img-art'];
        $myFileName = $_FILES['img-art']['name'];
        $myFileTmpName = $_FILES['img-art']['tmp_name'];
        $myFileSize = $_FILES['img-art']['size'];
        $myFileError = $_FILES['img-art']['error'];
        $myFileType = $_FILES['img-art']['type'];
        global $myFileNewName;
        global $myFileDestination;
        $fileExt = explode('.', $myFileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowedExt)) {
            if($myFileError === 0) {
                if($myFileSize < 5000000) {
                    $myFileNewName = "ImgArt_" . uniqid('', true) . "." . $fileActualExt;
                    $myFileDestination = 'imgs/art/' . $myFileNewName;
                    move_uploaded_file($myFileTmpName, $myFileDestination);
                   
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "there was an error uploading your file";
            }
        } else {
            echo "this file type is not allowed !";
        }
        $articleImage = $myFileNewName;
        $articleTitle = test_input($_POST['title']);
        $articleContenu = test_input($_POST['contenu']);
        $articleDate = test_input($_POST['date']);
        $articleCategorie = test_input($_POST['articleCategory']);

        $articleAuteur = test_input($_POST['articleAuteur']);
        $oldimgArt= test_input($_POST['old-imgArt']);
        $id= test_input($_POST['id']);


        if ($myFileError){
            $articleImage= $oldimgArt;
        }else{
            $articleImage =$myFileNewName;
        // echo $articleAuteur;
        // echo $articleCategorie;
        }
        $insertArticleQuery = "UPDATE article SET title=?, contenu=?, imageArt=?, dateArt=?, idCategorie=?, idAuteur=? WHERE idArt= ?";
        $prp = $conn-> prepare(  $insertArticleQuery);
        $prp->execute([$articleTitle, $articleContenu, $articleImage, $articleDate, $articleCategorie, $articleAuteur,  $id]);
        echo "New record created successfully";
        header('Location: article.php');


}
// READ auteurs FROM DATA BASE 
//*************delete ****************************/

if (isset($_GET['danger'])) {
    $id = $_GET['danger'];
    try{
    $sql=("DELETE FROM `article` WHERE idArt=$id");
    echo $sql;
    $conn->exec($sql);
        
    echo "deleted";
    
    }catch(PDOException $e){
        echo $e;
    } 
     header('refresh:1 url=article.php');
}

?>
 
