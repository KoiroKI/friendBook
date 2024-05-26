<?php
class User {     private int $_id;
    private string $_email;


    public function __construct(int $id, $email)
    {
        $this->_id = $id;
        $this->_email = $email;
    }
    static function Register(string $email, string $password) : bool {

        $passwordHash = password_hash($password, PASSWORD_ARGON2I);

        $db = new mysqli('localhost', 'root', '', 'friendbook');

        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";

        $q = $db->prepare($sql);

        $q->bind_param("ss", $email, $passwordHash);

        $result = $q->execute();
//   /ᐠ｡ꞈ｡ᐟ\
        return $result;
    }
    static function Login(string $email, string $password) : bool {
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        $sql = "SELECT * FROM user WHERE email = ?";
        $q = $db->prepare($sql);
        $q->bind_param("s", $email);
        $result = $q->execute();
        if(!$result)
            return false;
        $row = $q->get_result()->fetch_assoc();
        if(password_verify($password, $row['password']));
        {
            $u = new User($row['ID'], $row['email']);
            $_SESSION['user'] = $u;
            return true;
        }
        else 
            return false;
        else 
            return false;
        else 
            return false;
    }
}
?>