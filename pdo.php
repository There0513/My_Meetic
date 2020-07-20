<?php
try {
    $user = 'Theresa';
    $password = "mysql123";
    $pdo = new PDO(
        'mysql:host=localhost;dbname=meetic',
        $user,
        $password
    );

    if ($get_values == 'go') {
        $mail = $_GET['mail'];
        foreach ($pdo->query("SELECT id_perso, nom, prenom, anniv, genre, ville, mail, mdp, active  FROM fiche_personne WHERE mail='$mail'") as $result) {
            $id_perso = $result['id_perso'];
            echo '<form action="" methode="POST" id="modif">';
            echo '<br>' . "Nom : " . $result['nom'] . " " .
                '<input class="input" type=text id="nom" value="' . $result['nom'] . '">' .
                '<br><br><br>';
            echo "Prénom : " . $result['prenom'] . " " .
                '<input class="input" type=text id="prenom" value="' . $result['prenom'] . '">' .
                '<br><br><br>';
            echo "Date de naissance : " . $result['anniv'] .
                '<br><br><br>';
            echo "Genre : " . $result['genre'] .
                '<br><br><br>';
            echo "Ville : " . $result['ville'] . " " .
                '<input class="input" type=text id="ville" value="' . $result['ville'] . '">' .
                '<br><br><br>';
            echo "E-mail : " . $result['mail'] . " " .
                '<input class="input" type=email id="newmail" value="' . $result['mail'] . '">' .
                '<input class="input" type=hidden id="mail" value="' . $result['mail']  . '">' .
                '<br><br>';

            $active = $result['active'];
            if ($active == 'N') {
                $pdo->query("UPDATE fiche_personne SET active='Y' WHERE mail='$mail'");
            }
        }
        foreach ($pdo->query("SELECT hobby1 FROM loisir WHERE id_perso='$id_perso'") as $loisir) {
            echo '<br>' . "Loisir : " . $loisir['hobby1'] . " " .
                '<input class="input" type=text id="hobby1" value="' . $loisir['hobby1'] . '">' .
                '<br><br>';
        }
        // <input type="submit" id="subscribe" name="subscribe" value="Subscribe">

        echo '<input type="submit" id="save" onclick="reload();" style="display: none;" value="SAVE">';
        echo '</form>';
        return;
    }

    $nom = mysqli_real_escape_string($pdo, $_POST['nom']);
    $prenom = mysqli_real_escape_string($pdo, $_POST['prenom']);
    $date = mysqli_real_escape_string($pdo, $_POST['date']);
    $email = mysqli_real_escape_string($pdo, $_POST['email']);
    $genre = mysqli_real_escape_string($pdo, $_POST['genre']);
    $mdp = mysqli_real_escape_string($pdo, $_POST['mdp']);
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $loisir = mysqli_real_escape_string($pdo, $_POST['loisir']);
    // echo "echo mdp :" . $mdp . PHP_EOL;

    class Member
    {
        public $answer;
        public $name;
        public $surname;
        public $date;
        public $genre;
        public $ville;
        public $email;
        public $pw;
        public $loisir;

        //constructor
        function my_constructor()
        {
            $this->name = $_POST['nom'];
            $this->surname = $_POST['prenom'];
            $this->date = $_POST['date'];
            $this->genre = $$_POST['genre'];
            $this->ville = $_POST['ville'];
            $this->email = $_POST['email'];
            $this->pw = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $this->loisir = $_POST['loisir'];
        }

        //set all
        function set_name($new_name)
        {
            $this->name = $new_name;
        }
        function set_surname($new_surname)
        {
            $this->surname = $new_surname;
        }
        function set_date($new_date)
        {
            $this->date = $new_date;
        }
        function set_genre($new_genre)
        {
            $this->genre = $new_genre;
        }
        function set_ville($new_ville)
        {
            $this->ville = $new_ville;
        }
        function set_email($new_email)
        {
            $this->email = $new_email;
        }
        function set_pw($pdo, $new_pw)
        {
            $this->pw = $new_pw;

            $get_mail = $_POST['get_mail'];
            $mdp_old = $_POST['mdp_old'];
            $mdp_new = $_POST['mdp_new'];
            $mdp_new_2 = $_POST['mdp_new_2'];
            $mdp_db = $pdo->query("SELECT mdp FROM fiche_personne WHERE mail='$get_mail'");
            $val_mdp = $mdp_db->fetchColumn();

            if (password_verify($mdp_old, $val_mdp) == true) { //mdp_old matching with DB
                //hash pw:
                $mdp_new = password_hash($mdp_new, PASSWORD_DEFAULT);
                $pdo->query("UPDATE fiche_personne SET mdp='$mdp_new' WHERE mail='$get_mail'");

                echo "pw_changed";
            } else {
                echo "wrong_pw";
            }
        }
        function set_loisir($new_loisir)
        {
            $this->loisir = $new_loisir;
        }
        //get all
        function get_name()
        {
            return $this->name;
        }
        function get_surname()
        {
            return $this->surname;
        }
        function get_date()
        {
            return $this->date;
        }
        function get_genre()
        {
            return $this->genre;
        }
        function get_ville()
        {
            return $this->ville;
        }
        function get_email()
        {
            return $this->email;
        }
        function get_pw()
        {
            return $this->pw;
        }
        function get_loisir()
        {
            return $this->loisir;
        }
        function insert($pdo, $name, $surname, $date, $genre, $ville, $email, $pw, $loisir)
        {
            if (
                $pdo->query("INSERT INTO fiche_personne (nom, prenom, anniv, genre, ville, mail, mdp, active)
             VALUES ('$name', '$surname', '$date','$genre', '$ville', '$email', '$pw', 'Y')")
            ) {
                $pdo->query("INSERT INTO loisir (hobby1) VALUES ('$loisir')");
            } else {
                echo 'already_exist';
            }
        }
        function check_login($pdo)
        {
            $user = $_POST['username'];
            $password = $_POST['password'];
            $check = $pdo->query("SELECT * FROM fiche_personne WHERE mail='$user'");
            $value = $check->fetchColumn();
            // SELECT EXISTS(SELECT * FROM fiche_personne WHERE xy);
            if ($value > 0) { //->check mdp + active 'Y/N':
                $mdp_db = $pdo->query("SELECT mdp FROM fiche_personne WHERE mail='$user'");
                $val_mdp = $mdp_db->fetchColumn();
                if (password_verify($password, $val_mdp) == true) { //passwords matching
                    $active_db = $pdo->query("SELECT active FROM fiche_personne WHERE mail='$user'");
                    $val_active = $active_db->fetchColumn();
                    if ($val_active == 'Y') { //active user
                        $_SESSION['username'] = $user; // Initializing Session
                        echo "session_start";
                        // header("location: mon_compte.php"); // Redirecting To Other Page
                        return;
                    }
                    if ($val_active == 'N') { //INactive user
                        echo 'inactive';
                        return;
                    }
                }
                if (password_verify($password, $val_mdp) == false) { //passwords NOT matching
                    echo 'wrong_pw';
                    return;
                }
            } else if ($value == 0) {
                echo 'not_in_DB';
            }
        }
        function my_research($pdo)
        {
            $get_mail = $_POST['get_mail'];
            $autre = $_POST['autre'];
            $femme = $_POST['femme'];
            $homme = $_POST['homme'];
            $paris = $_POST['paris'];
            $marseille = $_POST['marseille'];
            $lyon = $_POST['lyon'];
            $coder = $_POST['coder'];
            $danser = $_POST['danser'];
            $lecture = $_POST['lecture'];
            $cinema = $_POST['cinema'];
            $age1 = $_POST['age1'];
            $age2 = $_POST['age2'];
            $age3 = $_POST['age3'];
            $age4 = $_POST['age4'];
            //| id_perso | nom   | prenom  | anniv      | genre | ville | mail| mdp| active |
            $query = "SELECT nom, prenom, anniv, genre, ville, hobby1 FROM fiche_personne f INNER JOIN loisir l ON f.id_perso=l.id_perso";
            // mysql> SELECT nom, prenom FROM fiche_personne f INNER JOIN loisir l ON f.id_perso=l.id_perso WHERE f.ville='paris' AND l.hobby1='danser';

            $conditions = array();

            if (!empty($autre)) {
                $conditions[] = "f.genre='$autre'";
            }
            if (!empty($femme)) {
                $conditions[] = "f.genre='$femme'";
            }
            if (!empty($homme)) {
                $conditions[] = "f.genre='$homme'";
            }
            if (!empty($paris)) {
                $conditions[] = "f.ville='$paris'";
            }
            if (!empty($marseille)) {
                $conditions[] = "f.ville='$marseille'";
            }
            if (!empty($lyon)) {
                $conditions[] = "f.ville='$lyon'";
            }
            if (!empty($coder)) {
                $conditions[] = "l.hobby1='$coder'";
            }
            if (!empty($danser)) {
                $conditions[] = "l.hobby1='$danser'";
            }
            if (!empty($lecture)) {
                $conditions[] = "l.hobby1='$lecture'";
            }
            if (!empty($cinema)) {
                $conditions[] = "l.hobby1='$cinema'";
            }
            // if (!empty($age1)) {
            //     $conditions[] = "<'$age1'";
            // }
            $sql = $query;
            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }
            $count = 1;
            //nom, prenom, anniv, genre, ville 
            // echo "echo sql : " . $sql; working->SELECT * FROM fiche_personne WHERE genre='Femme' AND ville='Paris'
            foreach ($pdo->query($sql) as $find) {
                echo '<div class="slide'.$count.'">';
                echo "Nom : " . $find['nom'] . "<br>" . "Prenom : " . $find['prenom'] . "<br>" . "Date de naissance : " . $find['anniv'] . "<br>" . 
                "Genre : " . $find['genre'] . "<br>" . "Ville : " . $find['ville'] . "<br>" . "Hobby : " . $find['hobby1'] . "<br>";
                echo '<button onclick="messages();" id="'.$find['mail'].'" value="contacter">contacter  '.$find['prenom'].'</button><br><br>';
                echo '</div><br>';
                $count++;
            }
            echo '<script src="modify_compte.js"></script>';
        }
        // function get_datas($pdo, $mail) // ?
        // {
        //     $query = $pdo->query("SELECT * FROM fiche_personne WHERE mail='$mail'");
        //     $result = array();
        //     while ($record = $pdo->fetch_array($query)) {
        //         $result[] = $record;
        //     }
        //     return $result;
        // }
    }
} catch (PDOException $error) {
    echo "Error : " . $error->getMessage() . PHP_EOL;
}
