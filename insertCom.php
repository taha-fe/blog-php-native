<?php 
require 'connexion.php';
function test_input($data) {
    $data = trim($data); 
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}
if(isset($_POST['commentaire'])) {


$commentaireName=test_input($_POST['nickName']);
$commentaireContenu=$_POST['contenu'];
$ArticleId=test_input($_POST['id']);

// $insertCommentaireleQuery = "INSERT INTO commentaire (NickName, contenuCom, idArticle) 
// VALUES (\"$commentaireName\", \" $commentaireContenu\", \"$ArticleId\");";
// $prp = $conn->prepare($insertCommentaireleQuery);
// $prp->execute();
$req = $conn->prepare('INSERT INTO commentaire SET NickName = ? , contenuCom = ? , idArticle = ?');
$req->execute([$commentaireName,$commentaireContenu,$ArticleId]);
echo('insert');
// header('url=art.php?vue='.$ArticleId);
header("location: art.php?vue=$ArticleId");
}
// READ auteurs FROM DATA BASE 
//*************delete ****************************/

if (isset($_GET['danger'])) {
    $id = $_GET['danger'];
    
    $id_articles = $_GET['idarticle'];
    try{
    $sql=("DELETE FROM `commentaire` WHERE idCom=$id");
    echo $sql;
    $conn->exec($sql);
        
    echo "deleted";
    
    }catch(PDOException $e){
        echo $e;
    } 
    header("location: art.php?vue=$id_articles");
}

?>

