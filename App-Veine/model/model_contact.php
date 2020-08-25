<?php

class Contacts
{
    private $bdd;

    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=veine;charset=utf8', 'root', '');
            // Activation des erreurs PDO
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
            $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Méthode pour récuperer les contacts 
     * @param type integer
     * 
     */
    public function getContacts($userId)
    {
        $query = 'SELECT have_contacts.users_id, users_pseudo as contact_pseudo, lhp4_contacts.users_id as contactPseudo_id, lhp4_contacts.contacts_id as contact_id, contacts_authorized, contacts_bookmark
        FROM veine.have_contacts
        INNER JOIN lhp4_contacts
        ON lhp4_contacts.contacts_id = have_contacts.contacts_id
        INNER JOIN lhp4_users
        ON lhp4_users.users_id = lhp4_contacts.users_id
        WHERE have_contacts.users_id = :users_id AND contacts_authorized = 1';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':users_id', $userId);
            $resultQuery->execute();

            $resultContacts = $resultQuery->fetchAll();

            if ($resultContacts) {

                return $resultContacts;
            } else {

                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function getWaitingContacts($userId)
    {
        $query = 'SELECT have_contacts.users_id, users_pseudo as contact_pseudo, lhp4_contacts.users_id as contactPseudo_id, lhp4_contacts.contacts_id as contact_id, contacts_authorized, contacts_bookmark
        FROM veine.have_contacts
        INNER JOIN lhp4_contacts
        ON lhp4_contacts.contacts_id = have_contacts.contacts_id
        INNER JOIN lhp4_users
        ON lhp4_users.users_id = lhp4_contacts.users_id
        WHERE have_contacts.users_id = :users_id AND contacts_authorized = 0';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':users_id', $userId);
            $resultQuery->execute();

            $resultContacts = $resultQuery->fetchAll();

            if ($resultContacts) {

                return $resultContacts;
            } else {

                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Méthode pour valider un contact de la liste d'attente
     * @param type integer
     * 
     */
    public function validateContacts($contactId)
    {
        $query = 'UPDATE lhp4_contacts SET contacts_authorized = 1 WHERE contacts_id = :contact_id ';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':contact_id', $contactId);

            if ($resultQuery->execute()) {

                return true;
            } else {

                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Méthode pour Ajouter un contact au favoris
     * @param type integer
     * 
     */
    public function bookmarkedContacts($contactId)
    {
        $query = 'UPDATE lhp4_contacts SET contacts_bookmark = 1 WHERE contacts_id = :contact_id ';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':contact_id', $contactId);

            if ($resultQuery->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Méthode pour supprimer un contact des favoris
     * @param type integer
     * 
     */
    public function unmarkedContacts($contactId)
    {
        $query = 'UPDATE lhp4_contacts SET contacts_bookmark = 0 WHERE contacts_id = :contact_id ';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':contact_id', $contactId);

            if ($resultQuery->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Méthode pour supprimer un contact des contacts
     * @param type integer
     * 
     */
    public function deleteContact($contactId)
    {
        $query = 'DELETE FROM lhp4_contacts WHERE contacts_id = :contact_id';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':contact_id', $contactId);

            if ($resultQuery->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Méthode pour supprimer une demande de contact en attentes
     * @param type integer
     * 
     */
    public function refusedContact($contactId)
    {
        $query = 'DELETE FROM lhp4_contacts WHERE contacts_id = :contact_id';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':contact_id', $contactId);

            if ($resultQuery->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function SearchContact($contactId)
    {
        $query = 'SELECT lhp4_users.users_id AS contact_id, have_contacts.users_id, users_pseudo as contact_pseudo, lhp4_contacts.contacts_id AS table_contact_id,
        CASE 
            WHEN `lhp4_contacts`.`contacts_bookmark` = 1 AND have_contacts.users_id = :contact_id THEN 1
            ELSE 0
        END AS `bookmarked`,
        CASE 
            WHEN `lhp4_contacts`.`contacts_authorized` = 1 AND have_contacts.users_id = :contact_id THEN 1
            WHEN `lhp4_contacts`.`contacts_authorized` IS NOT NULL AND have_contacts.users_id = :contact_id THEN 0
        END AS `authorized`
        FROM veine.lhp4_users
        LEFT JOIN `lhp4_contacts`
        ON `lhp4_contacts`.users_id = lhp4_users.users_id
        LEFT JOIN have_contacts
        ON lhp4_contacts.contacts_id = have_contacts.contacts_id
        WHERE lhp4_users.users_id != :contact_id';

        try {

            $resultQuery = $this->bdd->prepare($query);
            $resultQuery->bindValue(':contact_id', $contactId);
            
            
            
            if ($resultQuery->execute()) {
                return $resultQuery->fetchAll();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
