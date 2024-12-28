<?php

namespace app\services;

use app\models\ReviewImagesModel;

class ReviewImageService
{
    private $reviewImagesModel;
    public function __construct()
    {
        $this->reviewImagesModel = new ReviewImagesModel();
    }

    public function createReviewImage($data) {
        $reviewId = (int) $data['review_id'];
        $imageLink = $this->saveImage('images', 'images/reviews/');
        if ($imageLink !==  false) {
            return $this->reviewImagesModel->saveImage($imageLink, $reviewId);
        }
        return false;
    }
    private function log($message) {
        error_log("[ReviewImageService] " . $message);
    }
    private function saveImage($fieldName, $path) {
        $this->log("Current working directory: " . getcwd());
        if (!isset($_FILES[$fieldName])) {
            $this->log("No file uploaded with the field name: $fieldName");
            return false;
        }
        $fileTmpPath = $_FILES[$fieldName]['tmp_name'];
        $originalFileName = $_FILES[$fieldName]['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $newFileName = uniqid('file_', true) . '.' . $fileExtension;
        $uploadFolder =  $path;
        $this->log("Resolved upload folder: $uploadFolder");
        if (!is_dir($uploadFolder)) {
            $this->log("Upload folder does not exist: $uploadFolder");
            return false;
        }
        if (!is_writable($uploadFolder)) {
            $this->log("Upload folder is not writable: $uploadFolder");
            return false;
        }
        $destinationPath = $uploadFolder . $newFileName;
        if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            $this->log("File moved successfully to: $destinationPath");
            return $destinationPath;
        } else {
            $this->log("Failed to move file from $fileTmpPath to $destinationPath");
            return false;
        }
    }

    public function getReviewImagesByReviewId($id)
    {
        $id = (int) $id;
        return $this->reviewImagesModel->getReviewImagesByReviewId($id);
    }
}