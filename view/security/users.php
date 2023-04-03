<?php 
$users = $result["data"]['users'];
?>
<div class = "user-list-page">

<h1 class = "titre-page">Liste des utilisateurs</h1>

<div class = "contenu-user-list">

<div class ="ban-level-legend">
<p class ="ban-level-title"> Niveau des bans : </p>

<ul>
    <li> <i class="fa-regular fa-circle-check"></i> : rien a signaler </li>
    <li> <i class="fa-solid fa-circle-half-stroke"></i> : plus le droit de poster de topics. </li>
    <li> <i class="fa-solid fa-circle"></i> : plus le droit de poster de topics ni de messages. </li>
    <li><i class="fa-solid fa-circle-xmark"></i> : plus le droit de se connecter. </li>
</ul>
</div>

<div class = "topic-list-details">
<table>
        <thead>
            <tr>
                <th class="th-topic-details"> Pseudo </th>
                <th class="th-topic-details"> Date d'inscription</th>
                <th class="th-topic-details">Email</th>
                <th class="th-topic-details">Statut</th>
                <th class="th-topic-details">Gerer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($users as $user ){?>
            <tr>
                
                    <td class="td-topic-details"><?=$user->getPseudo()?></td>
                    <td class="td-topic-details"><?=$user->getDateInscription()?></td> 
                    <td class="td-topic-details"><?=$user->getEmail()?></td>
                    <td class="td-topic-details">                
                <?php 
                // Afficher le statut de l'user
                switch($user->getBanStatus())
                {
                    case 1:
                        ?> <i class="fa-regular fa-circle-check"></i><?php
                        break;

                    case 2: 
                        ?><i class="fa-solid fa-circle-half-stroke"></i> <?php
                        break;
                    
                    case 3: 
                        ?> <i class="fa-solid fa-circle"></i><?php
                        break;
                    
                    case 4:
                        ?><i class="fa-solid fa-circle-xmark"></i> <?php
                        break;
                }
                
                ?>
                </td>
            
    
    <!-- Formulaire de banissement -->
    <td class="td-topic-details"><form action="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>" method = "post" > 
        <select name="level" class = "form-select-category">
                    <option value="2">Ban leger</option>
                    <option value="3">Ban moyen</option>
                    <option value="4">Ban lourd</option>
                    <option value="1">Débannir</option>
        </select>
        <input type="submit" name = "submitBan" value="OK" class = "form-add-topic-submit">
    </form> </td>

    
    <?php
}

?> 
            </tr>
            </tbody>
            </table> 
        </div>    
    </div>
</div>