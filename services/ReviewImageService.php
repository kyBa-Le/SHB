<?php

namespace app\services;

use app\models\ReviewImagesModel;
use Cloudinary\Cloudinary;
use Exception;

class ReviewImageService
{
    private $reviewImagesModel;
    private $cloudinary;

    public function __construct()
    {
        $this->reviewImagesModel = new ReviewImagesModel();

        // Cấu hình Cloudinary
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
            ],
        ]);
    }

    // Tạo ảnh review
    public function createReviewImage($data) {
        $reviewId = (int) $data['review_id'];
        $imageLink = $this->saveImage('images', 'images-review');
        if ($imageLink !== false) {
            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            return $this->reviewImagesModel->saveImage($imageLink, $reviewId);
        }
        return false;
    }

    // Lưu ảnh lên Cloudinary
    private function saveImage($fieldName, $uploadPreset) {
        // Kiểm tra xem file đã được upload chưa
        if (isset($_FILES[$fieldName])) {

            $fileTmpPath = $_FILES[$fieldName]['tmp_name'];

            // Upload file lên Cloudinary với upload preset
            try {
                $result = $this->cloudinary->uploadApi()->upload($fileTmpPath, [
                    'upload_preset' => $uploadPreset, // Tên upload preset đã tạo trên Cloudinary
                ]);

                // Trả về URL của ảnh đã upload
                return $result['secure_url'];
            } catch (Exception $e) {
                $this->log("Cloudinary upload failed: " . $e->getMessage());
                return false;
            }
        }
        return false;
    }

    // Log lỗi
    private function log($message) {
        error_log("[ReviewImageService] " . $message);
    }

    // Lấy ảnh của review theo review_id
    public function getReviewImagesByReviewId($id)
    {
        $id = (int) $id;
        return $this->reviewImagesModel->getReviewImagesByReviewId($id);
    }
}