<?php
//Script création du zip des images 
// Get real path for our folder
$rootPath = realpath('images');
echo $rootPath;
// Initialize archive object    
$zip = new ZipArchive();
$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create r ecursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    //$rootPath,
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file) {
    // Skip directories (they would be added automatically)
    if (!$file->isDir()) {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
?>

<!DOCTYPE html>
<html lang="fr">

<!-- téléchargement du zip avec les images -->

<head>
</head>

<body>
    <!---- lancement du download du .zip---->
    <form action="file.zip" method="post">
        <input type="submit" name="submit" value="Download File" />
    </form>

</body>