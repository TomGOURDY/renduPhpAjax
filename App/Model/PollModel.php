<?php
namespace App\Model;

use Core\Database;

class PollModel extends Database {
    /**
     * question sondage
     *
     * @var string
     */
    public $question;

    /**
     * deadline du sondage
     *
     * @var datetime
     */
    public $deadline;

    /**
     * réponse possible
     * 
     * @var array
     */
    public $reponse;

    public function __construct($reponse)
    {
        $this->reponse = $reponse;
    }
}