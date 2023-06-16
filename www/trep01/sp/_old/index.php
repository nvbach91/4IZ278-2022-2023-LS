<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nahrát soubor</title>
</head>
<body>
<h1>Nahrát soubor na FTP server</h1>
<form action="ftp_upload.php" method="post" enctype="multipart/form-data">
    Vyberte soubor k nahrání:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Nahrát soubor" name="submit">
</form>
</body>
</html>
