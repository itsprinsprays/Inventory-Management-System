<?php

require_once "Model/Archive.php";

class ArchiveController {
    private $archive;

    public function __construct($db) {
        $this->archive = new Archive($db);
    }

    public function getAllArchive() {
        return $this->archive->getProductArchive();
    }

}


?>