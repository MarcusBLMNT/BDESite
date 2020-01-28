<?php
include('../includes/bddConnect.php');
$bdd = bddConnect();
/* Traitement du formulaire de création de Topic */
if(isset($_SESSION['id'])) {
   if(isset($_POST['tsubmit'])) {
      if(isset($_POST['tsujet'],$_POST['tcontenu'])) {
         $sujet = htmlspecialchars($_POST['tsujet']);
         $contenu = htmlspecialchars($_POST['tcontenu']);
         if(!empty($sujet) AND !empty($contenu)) {
            if(strlen($sujet) <= 70) {
                 if(isset($_POST['tpublic'])) {
                  $public = 1;
               } else {
                  $public = 0;
               }
               $ins = $bdd->prepare('INSERT INTO post (sujet, text, date, public, id_utilisateur) VALUES(?,?,NOW(),?,?)');
               $ins->execute(array($sujet,$contenu,$public,$_SESSION['id'],));
            } else {
               $terror = "Votre sujet ne peut pas dépasser 70 caractères";
            }
         } else {
            $terror = "Veuillez compléter tous les champs";
         }
      }
   }
} else {
   $terror = "Veuillez vous connecter pour poster un nouveau topic";
}
?>

<form method="POST">
   <table>
      <tr>
         <th colspan="2">Nouveau Topic</th>
      </tr>
      <tr>
         <td>Sujet</td>
         <td><input type="text" name="tsujet" size="70" maxlength="70" /></td>
      </tr>
      <tr>
         <td>Catégorie</td>
         <td>
            <select>
               <option>Catégorie 1</option>
               <option>Catégorie 2</option>
               <option>Catégorie 3</option>
               <option>Catégorie 1</option>
            </select>
         </td>
      </tr>
      <tr>
         <td>Message</td>
         <td><textarea name="tcontenu"></textarea></td>
      </tr>
      <tr>
         <td>Privé</td>
         <td><input type="checkbox" name="tpublic" /></td>
      </tr>
      <tr>
         <td colspan="2"><input type="submit" name="tsubmit" value="Poster le Topic" /></td>
      </tr>
      <?php if(isset($terror)) { ?>
      <tr>
         <td colspan="2"><?= $terror ?></td>
      </tr>
      <?php } ?>
   </table>
</form>
