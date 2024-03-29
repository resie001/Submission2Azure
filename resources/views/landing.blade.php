<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submission 2 Microsoft Azure</title>
    <script src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            padding: 16px;
            margin: 16px;
        }
        .preview {
            width: 250px;
            height: 250px;
            border: 1px solid black;
            margin: 0 auto;
            background: white;
        }
        .preview img{
            display: none;
        }
    </style>
</head>
<body>
    <p>Pilih gambar yang akan di Analisa</p>
    <form action="" method="POST">
        <input type="file" name="image" id="image"><br><br>
        <input type="submit" value="Upload" name="upload" class="btn btn-primary">
    </form>

    <div class="preview">
        <img src="" id="img" alt="your image" width="250px" height="250px">
    </div>
<?php
require_once 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

$connectionString = "DefaultEndpointsProtocol=https;AccountName=".getenv('account_name').";AccountKey=".getenv('account_key');
$blobClient = BlobRestProxy::createBlobService($connectionString);

$createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

$createContainerOptions->addMetaData("key1", "value1");
$createContainerOptions->addMetaData("key2", "value2");

$container = "submissioncontainer";

if (isset($_POST['upload'])) {
    
    $uploadOk = 1;
    $fileName = $_FILES['file']['name'];
    $imageFileType = pathinfo($fileName,PATHINFO_EXTENSION);
    $validExtension = array("jpg","jpeg","png");

    if ($_FILES["image"]["size"] > 4000000) {
        echo "<p>Size Gambar tidak boleh melebihi 4 mb</p>";
        $uploadOk = 0;
    }

    if (!in_array(strtolower($imageFileType),$validExtension)) {
        $uploadOk = 0;
    }

    if ($uploadOK == 0) {
        echo 0;
    } else {
        $targetDir = "upload/";
        $targetFile = $targetDir.basename($_FILES['image']['name']);
        $file = $_FILES['image']['name'];
        move_uploaded_file($file,$targetFile);
        $fileToUpload = "upload/".$files.".".$imageFileType;
        $content = fopen($fileToUpload,"r");
        $blobClient->createBlockBlob($container, $file, $content);
    }

}

?>
</body>
</html>