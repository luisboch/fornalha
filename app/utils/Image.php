<?php

/**
 * Image.php
 */

/**
 * @author luis
 * @since Jul 26, 2012
 */
class Image {

    /**
     *
     * @var File
     */
    private $file;
    private $imageSample;
    private $simpleType;
    private $link;

    function __construct($file = NULL) {
        if ($file !== NULL) {
            if ($file instanceof File) {
                $this->setFile($file);
            } else {
                $this->setLink($file);
            }
        }
    }

    /**
     *
     * @return File
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file) {
        $this->imageSample = '';
        $this->file = $file;
        $this->loadFile();
    }

    /**
     * @param File $file
     */
    public function setLink($link) {
        $this->imageSample = '';
        $link = str_replace(IMAGE_DIR, '', $link);
        $this->link = $link;
        $this->loadFile();
    }

    public function createImageSample() {
        if ($this->simpleType == '') {
            $this->loadFile();
        }
        if ($this->imageSample == '') {

            switch ($this->simpleType) {
                case 'JPG':
                    $this->imageSample = imagecreatefromjpeg($this->file->getFullPath());
                    break;
                case 'PNG':
                    $this->imageSample = imagecreatefrompng($this->file->getFullPath());
                    break;
                case 'GIF':
                    $this->imageSample = imagecreatefromgif($this->file->getFullPath());
                    break;
            }
        }
    }

    public function loadFile() {
        if ($this->file != '') {
            $this->link = str_replace(IMAGE_DIR, '', $this->file->getFullPath());
        } else if ($this->link != '') {
            $this->file = new File(IMAGE_DIR . $this->link);
        } else {
            throw new InvalidArgumentException("file or link need be defined!");
        }

        $list = getimagesize($this->file->getFullPath());
        if ($list === false) {
            throw new IllegalStateException("Failed to get image size of file: " . $this->file->getFullPath());
        }
        if ($list[2] == IMAGETYPE_JPEG) {
            $this->simpleType = 'JPG';
        } else if ($list[2] == IMAGETYPE_GIF) {
            $this->simpleType = 'GIF';
        } else if ($list[2] == IMAGETYPE_PNG) {
            $this->simpleType = 'PNG';
        }
    }

    function getWidth() {
        $this->createImageSample();
        $w = imagesx($this->imageSample);
        if ($w === false) {
            throw new IllegalStateException("Failed to get width of file: \n" . $this->file->getFullPath());
        }
        return $w;
    }

    function getHeight() {
        $this->createImageSample();
        $y = imagesy($this->imageSample);

        if ($y === false) {
            throw new IllegalStateException("Failed to get height of file: " . $this->file->getFullPath());
        }

        return $y;
    }

    public function getImageSample() {
        $this->createImageSample();
        return $this->imageSample;
    }

    public function getSimpleType() {
        return $this->simpleType;
    }

    public function setImageSample($imageSample) {
        $this->imageSample = $imageSample;
    }

    public function getFullPath() {
        return $this->file->getFullPath();
    }

    public function getLink() {
        return $this->link;
    }

}
