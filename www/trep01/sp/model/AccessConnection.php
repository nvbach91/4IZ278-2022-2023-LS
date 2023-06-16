<?php

class AccessConnection
{
    private $access_server;
    private $access_username;
    private $access_password;
    private $connection;
    private $output;

    public function __construct($server, $username, $password)
    {
        $this->access_server = $server;
        $this->access_username = $username;
        $this->access_password = $password;

        $this->connection = @ftp_connect($this->access_server);

        if ($this->connection === false) {
            $this->output[] = "Nepodařilo se připojit k serveru $this->access_server";
            $this->connection = null;
        } else if (!@ftp_login($this->connection, $this->access_username, $this->access_password)) {
            $this->output[] = "Nepodařilo se připojit jako $this->access_username";
            $this->connection = null;
        } else {
            $this->output[] = "Podařilo se připojit k serveru $this->access_server jako $this->access_username";
            ftp_pasv($this->connection, true);
        }


    }

    public function isConnected()
    {
        return $this->connection !== null;
    }

    public function isDirectory($directory)
    {
        $original_directory = ftp_pwd($this->connection);

        if (@ftp_chdir($this->connection, $directory)) {
            ftp_chdir($this->connection, $original_directory); // Return to the original directory
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentDirectory()
    {
        if ($this->connection) {
            $directory = ftp_pwd($this->connection);

            if ($directory !== false) {
                $this->output[] = "Aktuální adresář je: $directory";
                return $directory;
            } else {
                $this->output[] = "Nepodařilo se zjistit aktuální adresář";
                return false;
            }
        } else {
            $this->output[] = "Nepodařilo se zjistit aktuální adresář - není otevřené FTP spojení";
            return false;
        }
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function uploadFileOld($file, $remote_file)
    {
        if ($this->connection && ftp_put($this->connection, $remote_file, $file, FTP_BINARY)) {
            $this->output[] = "Soubor $file byl úspěšně nahrán na $this->access_server";
        } else {
            $this->output[] = "Nepodařilo se nahrát soubor $file na $this->access_server";
        }
    }

    public function uploadFile($localFile, $remoteFile)
    {
        $handle = fopen($localFile, 'r');

        if ($handle === false) {
            $this->output[] = "Nepodařilo se otevřít lokální soubor $localFile";
            return false;
        }

        if (!ftp_alloc($this->connection, filesize($localFile))) {
            $this->output[] = "Nepodařilo se alokovat dostatek místa na serveru pro soubor $remoteFile";
            return false;
        }

        $upload = ftp_nb_fput($this->connection, $remoteFile, $handle, FTP_BINARY);

        while ($upload == FTP_MOREDATA) {
            $upload = ftp_nb_continue($this->connection);
        }

        if ($upload != FTP_FINISHED) {
            $this->output[] = "Nepodařilo se nahrát soubor $remoteFile na $this->access_server";
            return false;
        }

        $this->output[] = "Soubor $remoteFile byl úspěšně nahrán na $this->access_server";
        return true;
    }


    public function downloadFile($remote_file, $local_file)
    {
        if ($this->connection) {
            if (ftp_get($this->connection, $local_file, $remote_file, FTP_BINARY)) {
                $this->output[] = "Soubor $remote_file byl úspěšně stáhnut z $this->access_server";
                return $local_file; // return the local path of the downloaded file
            } else {
                $this->output[] = "Nepodařilo se stáhnout soubor $remote_file z $this->access_server";
                throw new Exception("Nepodařilo se stáhnout soubor $remote_file z $this->access_server");
            }
        }
    }


    public function deleteLocalFile($file)
    {
        if (file_exists($file)) {
            if (unlink($file)) {
                $this->output[] = "Soubor $file byl úspěšně smazán.";
            } else {
                $this->output[] = "Nepodařilo se smazat soubor $file.";
            }
        }
    }


    public function isDirectoryEmpty($directory) {
        if ($this->connection) {
            $file_list = ftp_nlist($this->connection, $directory);

            if (empty($file_list)) {
                $this->output[] = "Adresář $directory je prázdný";
                return true;
            } else {
                $this->output[] = "Adresář $directory není prázdný";
                return false;
            }
        } else {
            $this->output[] = "Nepodařilo se získat informace o adresáři $directory";
            return false;
        }
    }




    public function deleteFile($remote_file)
    {
        if ($this->connection && ftp_delete($this->connection, $remote_file)) {
            $this->output[] = "Soubor $remote_file byl úspěšně smazán na $this->access_server";
        } else {
            $this->output[] = "Nepodařilo se smazat soubor $remote_file na $this->access_server";
        }
    }

    public function deleteDirectory($directory) {
        if ($this->connection && ftp_rmdir($this->connection, $directory)) {
            $this->output[] = "Adresář $directory byl úspěšně smazán na $this->access_server";
        } else {
            $this->output[] = "Nepodařilo se smazat adresář $directory na $this->access_server";
        }
    }


    public function closeConnection()
    {
        if ($this->connection) {
            ftp_close($this->connection);
            $this->output[] = "Spojení na $this->access_server bylo ukončeno";
        } else {
            $this->output[] = "Není co ukončit, spojení nebylo navázáno";
        }
    }

    public function changeDirectory($directory)
    {
        if ($this->connection && ftp_chdir($this->connection, $directory)) {
            $this->output[] = "Aktuální adresář byl změněn na $directory";
        } else {
            $this->output[] = "Nepodařilo se změnit adresář na $directory";
        }
    }

    public function changeToParentDirectory()
    {
        if ($this->connection && ftp_cdup($this->connection)) {
            $this->output[] = "Přechod do nadřazeného adresáře byl úspěšný";
        } else {
            $this->output[] = "Nepodařilo se přejít do nadřazeného adresáře";
        }
    }


    public function listFiles($directory = ".")
    {
        $files = [];

        if ($this->connection) {
            $fileNames = ftp_nlist($this->connection, $directory);

            if (is_array($fileNames)) {
                foreach ($fileNames as $fileName) {
                    $files[] = [
                        'name' => $fileName,
                        'isDirectory' => $this->isDirectory($fileName),
                    ];
                }
                $this->output[] = "Podařilo se načíst seznam souborů z $directory";
            } else {
                $this->output[] = "Nepodařilo se načíst seznam souborů z $directory";
            }
        }

        return $files;
    }


    public function fileSize($file)
    {
        if ($this->connection) {
            $size = ftp_size($this->connection, $file);

            if ($size != -1) {
                $this->output[] = "Velikost souboru $file je $size bytes";
            } else {
                $this->output[] = "Nepodařilo se zjistit velikost souboru $file";
            }
        }
    }

    public function fileExists($file)
    {
        if ($this->connection) {
            $size = ftp_size($this->connection, $file);

            if ($size != -1) {
                $this->output[] = "Soubor $file existuje";
            } else {
                $this->output[] = "Soubor $file neexistuje";
            }
        }
    }

    public function renameFile($oldName, $newName)
    {
        if ($this->connection && ftp_rename($this->connection, $oldName, $newName)) {
            $this->output[] = "Soubor $oldName byl úspěšně přejmenován na $newName";
        } else {
            $this->output[] = "Nepodařilo se přejmenovat soubor $oldName na $newName";
        }
    }
}


