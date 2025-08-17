<?php
require_once '../model/BDConnection/BDConnection.php';
require_once 'userSession.php';

class user {
    private int $userID;
    private string $username;
    private string $password;
    private string $name;
    private string $email;
    private string $role;
    private userSession $userSession;

    /**
     * @param int $userID
     * @param string $username
     * @param string $password
     * @param string $name
     * @param string $email
     * @param string $role
     */
    public function __construct(int $userID, string $username, string $password, string $name, string $email, string $role)
    {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }


    public static function getUser($username, $password) {
        try {
            // Encriptacion de contraseña
            $password = self::cryptconmd5($password);
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }

            $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":username" => $username, ":password" => $password));
            $response = $response->fetch(PDO::FETCH_ASSOC);

            $connection = null;

            if($response) {
                $user = new user($response["userID"], $response["username"], $response["password"], $response["name"], $response["email"], $response["role"]);
                UserSession::newSession("user", $user->getUsername());
                UserSession::newSession("userID", $user->getUserID());
                UserSession::newSession("role", $user->getRole());
                return $user;
            } else {
                return $response = null;
            }
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    public static function newUser($username, $password, $name, $email) {
        try {
            // Encriptacion de contraseña
            $password = self::cryptconmd5($password);
            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }

            $sql = "INSERT INTO users (username, password, name, email, role) VALUES (:username,:password,:name,:email,:role)";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":username" => $username, ":password" => $password, ":role" => "user", ":name" => $name, ":email" => $email));

            $connection = null;
            return  $response;
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    public static function getUserNameByID($userID) {
        try {

            $connection = BDConnection::ConnectBD();

            if (gettype($connection) == "string") {
                return $connection;
            }

            $sql = "SELECT username FROM users WHERE userID = :userID";
            // Control de inyeccion
            $response = $connection->prepare($sql);

            $response->execute(array(":userID" => $userID));
            $response = $response->fetch(PDO::FETCH_ASSOC);

            $connection = null;

            if($response) {
                return $response;
            } else {
                return $response = null;
            }
        } catch (PDOException $e){
            return BDConnection::mensajes($e->getCode());
        }
    }

    public static function cryptconmd5($password)
    {
        $salt = md5($password . "%*4!#$;.k~’(_@");
        $password = md5($salt . $password . $salt);
        return $password;
    }
}