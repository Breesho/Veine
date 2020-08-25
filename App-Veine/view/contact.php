<?php

require_once '../controller/ContactController.php';


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
                <div class="title">
                    <h3>Contact en attente</h3>
                </div>
                <ul>
                <?php if (!empty($contactsArray)) {
                   foreach ($contactsArray as $contact) {
                        if ($contact['contacts_authorized'] == 1) {
                            continue;
                        } ?>

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

<p>caca</p>
                    <?php } ?>
                </ul>
            </div>

            <div id="container-contacts">
                <div class="title">
                    <h3>Contact</h3>
                </div>
                <ul>
                <?php if (!empty($contactsArray)) {
                    foreach ($contactsArray as $contact) {
                        if ($contact['contacts_authorized'] == 0) {
                            continue;
                        } ?>

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
     
                                </div>
                        </li>
                            <?php }}} else { ?>

                            <p>pipi</p>
                            <?php } ?>
                    
                </ul>
            </div>

        </form>

    </div>


    <script src="https://kit.fontawesome.com/2edc250389.js" crossorigin="anonymous"></script>
</body>

</html>