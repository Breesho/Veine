<?php
session_start();

if (!isset($_SESSION['User'])) {
    header('Location: index.php');
}
require_once '../model/model_contact.php';

$contacts = new Contacts();

// var_dump($contacts->SearchContact('13'));



if (isset($_POST['accepted'])) {
    $contactId = $_POST['accepted'];
    $contacts->validateContacts($contactId);
    var_dump($_POST);
}

if (isset($_POST['bookmarked'])) {
    $contactId = $_POST['bookmarked'];
    $contacts->bookmarkedContacts($contactId);
}

if (isset($_POST['unmarked'])) {
    $contactId = $_POST['unmarked'];
    $contacts->unmarkedContacts($contactId);
}

if (isset($_POST['delete'])) {
    $contactId = $_POST['delete'];
    $contacts->deleteContact($contactId);
}

if (isset($_POST['refused'])) {
    $contactId = $_POST['refused'];
    $contacts->refusedContact($contactId);
}




$UsersArray = $contacts->SearchContact($_SESSION['User']['users_id']);
$contactsArray = $contacts->getContacts($_SESSION['User']['users_id']);
$waitingContactsArray = $contacts->getWaitingContacts($_SESSION['User']['users_id']);
