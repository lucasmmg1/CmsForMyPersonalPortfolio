<?php
    #[AllowDynamicProperties]
    class connection
    {
        public $pdo, $error;

        public function __construct(readonly string $hostname, readonly string $dbname, readonly string $username, readonly string $password, readonly string $port, readonly string $charset)
        {
            $dsn = "mysql:host=$hostname:$port;dbname=$dbname;charset=$charset";

            $options =
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ];

            try
            {
                $this->pdo = new PDO($dsn, $username, $password, $options);
            }
            catch (PDOException $e)
            {
                die("Error {$e->getCode()}: {$e->getMessage()}");
            }
        }

        public function Login() : void
        {
            if (isset($_POST['username'], $_POST['password']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (empty($username) || empty($password))
                {
                    $this->error = "All fields are required!";
                }
                else
                {
                    $usernameQuery = $this->pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                    $usernameQuery->bindValue(1, $username);
                    $usernameQuery->bindValue(2, $password);
                    $usernameQuery->execute();
                    $foundWithUsername = $usernameQuery->rowCount();

                    $emailQuery = $this->pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
                    $emailQuery->bindValue(1, $username);
                    $emailQuery->bindValue(2, $password);
                    $emailQuery->execute();
                    $foundWithEmail = $emailQuery->rowCount();

                    if ($foundWithUsername > 0 || $foundWithEmail > 0)
                    {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $this->pdo->query("SELECT username FROM users WHERE username = '$username' OR email = '$username'" )->fetch()["username"];
                        header("Location: index.php");
                        exit();
                    }
                    else
                    {
                        $this->error = "Incorrect details!";
                    }
                }
            }
        }
        public function Logout() : void
        {
            session_destroy();
            header("Location: index.php");
            exit();
        }

        public function Query(string $query)
        {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>