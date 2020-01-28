<table class="forum">
   <tr class="header">
      <th class="main">Catégories</th>
      <th class="sub-info">Auteur</th>
      <th class="sub-info">Date de création</th>
      <th class="sub-info">Réponses</th>
      <th class="sub-info">Dernier message</th>
      <th class="sub-info">Auteur</th>
      <th class="sub-info">Date de réponses</th>
      
   </tr>
   <?php
   while($c = $categories->fetch()) {
   ?>
   <tr>
      <td class="main">
         <h4><a href=""><?= $c['nom'] ?></a></h4>
      </td>
      <td class="sub-info">4083495</td>
      <td class="sub-info">04.12.2015 à 14h52<br />de PrimFX</td>
      <td class="sub-info">4083495</td>
      <td class="sub-info">4083495</td>
      <td class="sub-info">4083495</td>
   </tr>
   <?php } ?>
</table>