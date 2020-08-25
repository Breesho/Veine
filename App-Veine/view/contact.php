<?php

require_once '../controller/ContactController.php';

var_dump($_POST);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <?php include '../include/include_navbar.php' ?>



    <div class="containerglobal-contact">

        <div class="logo">
            <figure></figure>
        </div>
      
        <form action="" method="post">
            
            <div id="container-contactPending">
              
                <div class="container-input">

                    <input type="text" id="searchInput" name="searchInput" value="" placeholder="Recherche Contact">
                    <button type="submit" id="searchBtn" name="searchBtn" value=""><i class="fas fa-search"></i></button>

                </div>
            </div>
            <?php if (!isset($_POST['searchBtn'])) { ?>
            <div id="container-contactPending">
                <div class="title">
                    <h3>Contact(s) en attente</h3>
                </div>
                <ul>
                    <?php if (!empty($waitingContactsArray)) {
                        foreach ($waitingContactsArray as $contact) { ?>
                           

                            <li class="contact-center">
                                <div class="pseudo-contact">
                                    <h4><?= $contact['contact_pseudo'] ?> </h4>
                                </div>
                                <div class="container-btn">
                                    <button type="submit" name="accepted" value="<?= $contact['contact_id'] ?>"><i class="fas fa-check"></i>
                                    </button> <button type="submit" name="refused" value="<?= $contact['contact_id'] ?>"><i class="fas fa-times"></i></button>
                                </div>
                            </li>

                      
                   <?php }} else { ?>

                        <li class="contact-center">
                            <h4>Pas de nouvelle demande</h4>
                        </li>

                    <?php } ?>
                </ul>
            </div>

            <div id="container-contacts">
                <div class="title">
                    <h3>Contact(s)</h3>
                </div>
                <ul>
                    <?php if (!empty($contactsArray)) {
                        foreach ($contactsArray as $contact) { ?>
                           

                            <li class="contact-center">
                                <div class="pseudo-contact">
                                    <h4><?= $contact['contact_pseudo'] ?> </h4>
                                </div>
                                <div class="container-btn">
                                    <button type="submit" name="delete" value="<?= $contact['contact_id'] ?>"><i class="fas fa-trash-alt"></i></button>
                                    <?php if ($contact['contacts_bookmark'] == 0) { ?>
                                        <button type="submit" name="bookmarked" value="<?= $contact['contact_id'] ?>"><i class="far fa-star"></i></button>
                                    <?php   } else { ?>

                                        <button type="submit" name="unmarked" value="<?= $contact['contact_id'] ?>"><i class="fas fa-star"></i></button>
                                <?php } ?>
                                </div>
                            </li>
                  
                               
                             <?php }} else { ?>

                    <li class="contact-center">
                        <h4>Votre liste de contact est vide </h4>
                    </li>


                <?php } ?>

                </ul>
            </div>
            <?php } else { ?>
                <div>
                <div id="container-contacts">
                    <ul>
                    <?php if (!empty($UsersArray)) {
                        foreach ($UsersArray as $Users) { ?>
                           
                            <li class="contact-center">
                                <div class="pseudo-contact">
                                    <h4><?= $Users['contact_pseudo'] ?> </h4>
                                </div>
                                <div class="container-btn">
                                    
                                    <?php if ($Users['authorized'] == null) { ?>
                                        <button type="submit" name="add" value="<?= $Users['table_contact_id'] ?>"><i class="fas fa-plus"></i></button>
                                    <?php   } elseif ($Users['authorized'] == 1) { ?>
                                        <button type="submit" name="delete" value="<?= $Users['table_contact_id'] ?>"><i class="fas fa-trash-alt"></i></button>
                                
                                        <?php } elseif ($Users['authorized'] == 0) { ?>
                                            <button type="submit" name="accepted" value="<?= $Users['table_contact_id'] ?>"><i class="fas fa-check"></i>
                                            </button> <button type="submit" name="refused" value="<?= $Users['table_contact_id'] ?>"><i class="fas fa-times" id="testtesmort"></i></button>
                                       <?php } ?>
                                </div>
                            </li>
                  
                               
                             <?php }} else { ?>

                    <li class="contact-center">
                        <h4>Votre liste de contact est vide </h4>
                    </li>


                <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </form>

    </div>


    <script src="https://kit.fontawesome.com/2edc250389.js" crossorigin="anonymous"></script>
</body>

</html>