<?php
namespace App\Controller;
use App\Model\PollModel;


class PollController{
    private $model;

    public static function fieldvalue( $fields, $field=false ){
        return ( $field && !empty( $field ) && isset( $_SESSION[ $fields ] ) && array_key_exists( $field, $_SESSION[ $fields ] ) ) ? $_SESSION[ $fields ][ $field ] : '';
    }

    private static function saveErrors($errorArray) {
        foreach($errorArray as $errorName => $value) {
            $_SESSION['errors'][$errorName] = $value;
        }
    }

    public function __construct()
    {
        $this->model = new PollModel();
        // $this->model = new PollModel($reponse);
    }

    public function newPoll() {
        $question = $this->model->question = htmlspecialchars($_POST["question_sondage"]);
        $deadline = $this->model->deadline = $_POST["sondage_deadline"];
        $reponse1 = array(
            'intitule' => htmlspecialchars($_POST["reponse_sondage1"]),
            'isTrue' => $_POST["is-correct"] == 'is_correct_1',
        );
        $reponse2 = array(
            'intitule' => htmlspecialchars($_POST["reponse_sondage2"]),
            'isTrue' => $_POST["is-correct"] == 'is_correct_2',
        );
        //Verification qu'aucun champ n'est vide
        if(!empty($_POST["question_sondage"]) && !empty($_POST["sondage_deadline"]) && !empty($_POST["reponse_sondage1"]) && !empty($_POST["reponse_sondage2"])) {
            $isSuccessful = $this->model->prepare("INSERT INTO poll(creator_id, title, deadline) VALUES (:sondagecreator, :question, :deadline);", array(':sondagecreator' => $_SESSION['id'], ':question' => $question, ':deadline' => $deadline));
            $lastId = $this->model->getLastInsertId();
            $isSuccessful = $this->model->prepare("INSERT INTO poll_answer(poll_id, title, is_correct)
            VALUES (:lastinsertid, :reponse1, :reponse1Statut);", array(':lastinsertid' => $lastId,':reponse1' => $reponse1['intitule'], ':reponse1Statut' => $reponse1['isTrue'] ? "1" : "0"));
            $isSuccessful = $this->model->prepare("INSERT INTO poll_answer(poll_id, title, is_correct) VALUES (:lastinsertid, :reponse2, :reponse2Statut);", array(':lastinsertid' => $lastId, ':reponse2' => $reponse2['intitule'], ':reponse2Statut' => $reponse2['isTrue'] ? "1" : "0"));
        }else {
            //Erreur si champ vide
            $questionError = $deadlineError = $reponse1Error = $reponse2Error = '';

            if (empty($_POST["question_sondage"])) {
                $questionError = "Champ de question vide. Veuillez renseigner une question";
            }
            if (empty($_POST["sondage_deadline"])) {
                $deadlineError = "Date de fin de sondage vide. Veuillez renseigner une deadline";
            }
            if (empty($_POST["reponse_sondage1"])) {
                $reponse1Error = "Champ de la réponse 1 vide, renseignez une réponse";
            }
            if (empty($_POST["reponse_sondage2"])){
                $reponse2Error = "Champ de la réponse 2 vide, renseignez une réponse";
            }
            PollController::saveErrors(array('questionError' => $questionError, 'deadlineError' => $deadlineError, 'reponse1Error' => $reponse1Error, 'reponse2Error' => $reponse2Error));
        }
    }
}