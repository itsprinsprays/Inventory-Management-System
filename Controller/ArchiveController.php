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

    public function activateProduct($product_id) {
        return $this->archive->activateProduct($product_id);
    }

    public function countArchivedProduct() {
        return $this->archive->countArchive();
    }

    public function stockAverage() {
        return $this->archive->stockAverage();
    }

}


?>