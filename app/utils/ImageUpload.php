<?php

/**
 * ImageUpload.php
 */
require_once 'StringUtil.php';
require_once 'Image.php';
require_once 'Upload.php';
require_once 'ImageManipulation.php';
require_once 'exceptions/InvalidTypeException.php';

/**
 * Class used to integrate uploads to a dinamic file upload
 *
 * @author luis
 * @since Jul 28, 2012
 */
class ImageUpload {

    private $path;

    /**
     *
     * @var Upload
     */
    private $upload;

    /**
     *
     * @var ImageManipulation
     */
    private $imageManipulation;

    function __construct($librarie) {
        $this->listeners = array();
        $this->upload = new Upload();

        if (!StringUtil::startsWith($librarie, '/')) {
            $librarie = '/' . $librarie;
        }

        if (!StringUtil::endsWith($librarie, '/')) {
            $librarie = $librarie . '/';
        }

        $this->imageManipulation = new ImageManipulation();

        $this->path = IMAGE_DIR . $librarie;

        @mkdir($this->path);
    }

    /**
     *
     * @param string $fileName
     * @return Image[] Image uploaded
     */
    public function upload($fileName = NULL, $width = 1024, $height = 768) {

        $files = $this->upload->upload($fileName);

        if (!is_array($files)) {
            $files[0] = $files;
        }

        $images = array();

        foreach ($files as $file) {

            if ($file->isImage()) {

                if (!$file->moveTo($this->path)) {
                    $file->delete();
                    throw new FileUploadException(
                    "Não foi possível realizar o upload [Mover para pasta especificada]");
                }

                $img = new Image($file);

                $img = $this->imageManipulation
                        ->setImage($img)->resize(array('width' => $width))
                        ->crop(0, 0, $width, $height)
                        ->save(array('copy' => true));

                $images[] = $img;
            } else {
                throw new InvalidTypeException("The file is not an image");
            }

            $file->delete();
        }

        return $images;
    }

}
