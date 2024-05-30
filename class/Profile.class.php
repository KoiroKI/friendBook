<?php
class Profile {
    private int $_id;
    private int $_userID;
    private string $_firstName;
    private string $_lastName;
    private int $_profilePhotoID;

    public function __construct(int $id, int $userID, string $firstName, string $lastName, int $profilePhotoID)
    {
        $this->_id = $id;
        $this->_userID = $userID;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_profilePhotoID = $profilePhotoID;
    }

    static function Get($id) : ?Profile {
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        $sql = "SELECT * FROM profile WHERE ID=? LIMIT 1";
        $q = $db->prepare($sql);
        $q->bind_param("i", $id);
        $q->execute();
        $result = $q->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new Profile($row['ID'], $row['userID'], $row['firstName'], $row['lastName'], $row['profilePhotoID']);
        } else {
            return null;
        }
    }

    static function GetAll() : array {
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        $sql = "SELECT * FROM profile LIMIT 500";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->get_result();
        $profiles = array();

        while ($row = $result->fetch_assoc()) {
            $profiles[] = new Profile($row['ID'], $row['userID'], $row['firstName'], $row['lastName'], $row['profilePhotoID']);
        }

        return $profiles;
    }

    static function GetUserProfile($userID) : ?Profile {
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        $sql = "SELECT * FROM profile WHERE userID=? LIMIT 1";
        $q = $db->prepare($sql);
        $q->bind_param("i", $userID);
        $q->execute();
        $result = $q->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new Profile($row['ID'], $row['userID'], $row['firstName'], $row['lastName'], $row['profilePhotoID']);
        } else {
            return null;
        }
    }

    function getFullName() : string {
        return $this->_firstName . ' ' . $this->_lastName;
    }

    function getProfilePhotoURL() : string {
        return 'https://picsum.photos/600/600
        ';
    }
}
?>
