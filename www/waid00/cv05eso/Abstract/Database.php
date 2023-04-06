<?php
abstract class Database{
    protected $folderPath;
    protected $fileExtension;
    protected $fieldSeparator;

    public function __construct() {
        echo "<strong>Constructing " . get_class($this) . "...</strong>";
    }

    public function __toString() {
        return "<br><strong>Database configuration:</strong><br>Folder path: " . $this->folderPath . "<br>File extension: " . $this->fileExtension . "<br>Field separator: " . $this->fieldSeparator . "<br>";
    }
}