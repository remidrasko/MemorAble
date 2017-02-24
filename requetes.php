
<?php

class Database {

    public static function connect() {
        $dsn = 'mysql:dbname=memorable;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }

}

class Utilisateur {

    public $login;
    public $motdepasse;
    public $prenom;
    public $nom;
    public $mail;
    public $naissance;
    public $nbquestions;
    public $nbquestionnaires;
    public $admin;

    public function __toString() {
        $ch = "[$this->login] $this->prenom <b>$this->nom</b>, né le ";
        $tabdate = explode('-', $this->naissance);
        $ch .= "$tabdate[2]/$tabdate[1]/$tabdate[0]";
        $ch .= "<b> $this->mail </b>";

        return $ch;
    }

    public static function getUtilisateur($dbh, $login) {
        $query = "SELECT * FROM `utilisateurs` WHERE `login` = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$login"));
        $user = $sth->fetch();
        $sth->closeCursor();
        if (isset($user)) {
            return $user;
        } else {
            return null;
        }
    }

    public static function insererUtilisateur($dbh, $login, $motdepasse, $prenom, $nom, $mail, $naissance) {
        if (Utilisateur::getUtilisateur($dbh, $login) == null) {
            $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `motdepasse`, `prenom`, `nom`, `mail`, `naissance`, `nbquestions`, `nbquestionnaires`,`admin`) VALUES(?,?,?,?,?,?,'0','0','false')");
            $sth->execute(array($login, sha1($motdepasse), $prenom, $nom, $mail, $naissance));
        }
    }

}

class Questionnaire {

    public $id;
    public $nom;
    public $auteur;
    public $type;
    public $ouverture;
    public $realisations;
    public $nbquestions;
    public $descripton;

    public static function insererQuestionnaire($dbh, $nom, $auteur, $type, $description) {
        $sth = $dbh->prepare("INSERT INTO `questionnaires`(nom, auteur, type, ouverture, realisations, nbquestions, description) VALUES(?, ?, ?, 0, 0, 0, ?)");
        $sth->execute(array($nom, $auteur, $type, $description));
    }

    public static function getQuestionnaire($dbh, $nom, $auteur) {
        $query = "SELECT * FROM `questionnaires` WHERE `auteur` = ? AND nom = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Questionnaire');
        $sth->execute(array("$auteur", "$nom"));
        $questionnaire = $sth->fetch();
        $sth->closeCursor();
        if (isset($questionnaire)) {
            return $questionnaire;
        } else {
            return null;
        }
    }

    public static function getQuestionnaires($dbh, $login) {
        $tab = array();
        $query = "SELECT * FROM `questionnaires` WHERE `auteur` = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Questionnaire');
        $sth->execute(array("$login"));
        while ($questionnaire = $sth->fetch()) {
            $tab[] = $questionnaire;
        }
        return $tab;
    }

    public function getPourcentage($dbh, $login) {
        $query = "SELECT * FROM `utilisateur_question` WHERE `login` = ? AND idquestionnaire = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur_Questionnaire');
        $sth->execute(array("$login", "$this->id"));
        $compteur1 = 0;
        $compteur2 = 0;
        while ($question = $sth->fetch()) {
            $compteur1 += 1;
            $compteur2 += $question->derniere_reponse;
        }
        if ($compteur1 == 0) {
            return 0;
        } else {
            return ceil(100 * $compteur2 / $compteur1);
        }
    }

}

class Question {

    public $question;
    public $reponse;
    public $idquestionnaire;
    public $numeroquestion;
    public $nbposes;
    public $nbcorrect;
    public $idquestion;

    public static function insererQuestion($dbh, $question, $reponse, $idquestionnaire, $numeroquestion) {
        $sth = $dbh->prepare("INSERT INTO `question_reponse`(question, reponse, idquestionnaire, numeroquestion, nbposes, nbcorrect) VALUES(?, ?, ?, ?, 0, 0)");
        $sth->execute(array($question, $reponse, $idquestionnaire, $numeroquestion));
        $sth = $dbh->prepare("UPDATE `questionnaires` SET nbquestions = nbquestions +1 WHERE id = ?");
        $sth->execute(array($idquestionnaire));
    }

    public static function getQuestions($dbh, $idquestionnaire) {
        $tab = array();
        $query = "SELECT * FROM `question_reponse` WHERE `idquestionnaire` = ? ORDER BY numeroquestion";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $sth->execute(array("$idquestionnaire"));
        while ($questionnaire = $sth->fetch()) {
            $tab[] = $questionnaire;
        }
        return $tab;
    }

    public static function getQuestion($dbh, $idquestion) {
        $tab = array();
        $query = "SELECT * FROM `question_reponse` WHERE `idquestion` = ? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $sth->execute(array("$idquestion"));
        $question = $sth->fetch();
        $sth->closeCursor();
        if (isset($question)) {
            return $question;
        } else {
            return null;
        }
    }

}

class Utilisateur_Questionnaire {

    public $login;
    public $type;
    public $idquestionnaire;
    public $nbquestionsrepondues;
    public $pourcentage;
    public $idproduit;

    static function getQuestionnaireProduit($dbh, $login, $idquestionnaire) {
        $query = "SELECT * FROM `utilisateur_questionnaire` WHERE `login` = ? AND idquestionnaire = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur_Questionnaire');
        $sth->execute(array("$login", "$idquestionnaire"));
        $questionnaireproduit = $sth->fetch();
        $sth->closeCursor();

        if (isset($questionnaireproduit) && $questionnaireproduit != null) {
            return $questionnaireproduit;
        } else {
            $sth = $dbh->prepare("INSERT INTO `utilisateur_questionnaire`(login, type, idquestionnaire, nbquestionsrepondues, pourcentage) VALUES(?, 0, ?, 0, 0)");
            $sth->execute(array($login, $idquestionnaire));
            $queprod = self::getQuestionnaireProduit($dbh, $login, $idquestionnaire);
            $tab = Question::getQuestions($dbh, $idquestionnaire);
            foreach ($tab as $question) {
                $sth = $dbh->prepare("INSERT INTO `utilisateur_question`(idquestion, login, nbtentatives, nbsucces, derniere_reponse, idquestionnaire) VALUES(?, ?, 0, 0, false, ?)");
                $sth->execute(array($question->idquestion, $queprod->login, $queprod->idquestionnaire));
            }
            return $queprod;
        }
    }

}

class Utilisateur_Question {

    public $idquestion;
    public $login;
    public $nbtentatives;
    public $nbsucces;
    public $derniere_reponse;
    public $idquestionnaire;

    public static function getQuestionsProduit($dbh, $idquestionnaire, $login) {
        $tab = array();
        $query = "SELECT * FROM `utilisateur_question` WHERE idquestionnaire=? AND login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur_Question');
        $sth->execute(array("$idquestionnaire", "$login"));
        while ($question = $sth->fetch()) {
            $tab[] = $question;
        }
        return $tab;
    }

    public function incrementerUtilisateurQuestion($dbh, $bonnereponse) {
        $sth = $dbh->prepare("UPDATE `utilisateur_question` SET nbtentatives = nbtentatives +1, nbsucces = nbsucces + ?, derniere_reponse = ? WHERE idquestion = ? AND idquestionnaire=? AND login=?");
        $sth->execute(array($bonnereponse, $bonnereponse, $this->idquestion, $this->idquestionnaire, $this->login));
    }

}
