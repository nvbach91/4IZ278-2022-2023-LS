<?php

require_once 'DatabaseOperations.php';

abstract class Database implements DatabaseOperations {
    protected $dataFolderPath;
    protected $dataFileExtension;
    protected $dataDelimiter;

    public function __construct($dataFolderPath, $dataFileExtension, $dataDelimiter) {
        $this->dataFolderPath = $dataFolderPath;
        $this->dataFileExtension = $dataFileExtension;
        $this->dataDelimiter = $dataDelimiter;
        echo "Instance of " . get_class($this) . " has been created.\n";
    }

    public function __toString() {
        return "Configuration:\n- Data folder path: " . $this->dataFolderPath . "\n- Data file extension: " . $this->dataFileExtension . "\n- Data delimiter: " . $this->dataDelimiter . "\n";
    }
}
