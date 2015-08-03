<?php
function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}

$now = date('Y-m-d');
$path = 'public/uploads';
foreach (new DirectoryIterator($path) as $file) {
    if ($file->isDot()) continue;
    if ($file->isDir()) {
        $datemodified = strtotime(date('Y-m-d', $file->getMTime()));
        $dateNow = strtotime($now);
        $seconds_diff = $dateNow - $datemodified;
        $daysDiff = floor($seconds_diff/3600/24);
        if($daysDiff >= 15)
        {
        	echo "Deleting ".$file->getFilename()." ...";
        	Delete($path."/".$file->getFilename());
        }
    }
}
