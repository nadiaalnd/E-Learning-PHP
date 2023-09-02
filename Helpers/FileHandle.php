<?php

class FileHandle
{
    public function upload($file, $path)
    {
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));

        $allowedExt = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

        if (in_array($fileExt, $allowedExt)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    $fileNameNew = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = $path . $fileNameNew;
                    move_uploaded_file($fileTmp, $fileDestination);

                    return $fileNameNew;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete($path)
    {
        unlink($path);
    }

    public function download($path)
    {
        if (!file_exists($path)) echo "404 Not Found";
        else {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header("Content-Length: " . filesize($path));
            readfile($path);
        }
    }
}
