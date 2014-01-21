<?php

require_once 'File.php';
require_once 'exceptions/FileUploadException.php';

/**
 * Description of Upload
 *
 * @author luis
 * @since Jul 28, 2012
 */
class Upload {
    
    private $path;

    function __construct() {
        $this->path = UPLOAD_DIR.'/';
        if (!file_exists($this->path) || !is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }
        $this->listeners = array();
    }

    /**
     *
     * @return string path of uploads
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param string $str is key of var $_FILES
     * @return File the uploaded file
     */
    public function upload($str = NULL) {
        
        $file = $_FILES[$str];
        
        if (!is_array($file['name'])) {
            return array($this->_upload($file));
        } else {
            $files = array();
            for ($i = 0; $i < count($file['name']); $i++) {
                if ($file['name'][$i] != '') {
                    $f = array();
                    foreach ($file as $k => $v) {
                        $f[$k] = $file[$k][$i];
                    }
                    $files[$i] = $this->_upload($f);
                }
            }
            return $files;
        }
    }

    private function getExtension($string) {
        $exp = explode('.', $string);
        return '.' . $exp[count($exp) - 1];
    }

    private function _upload($file) {
        if ($file == null || $file['error'] != '') {
            throw new FileUploadException("Houve um erro ao fazer o upload!");
        }
        
        $time = time();
        
        $i = 0;
        
        $ext = $this->getExtension($file['name']);
        
        $destination = $this->path . $time . 't_' . $i . $ext;
        
        while (file_exists($destination)) {
            $i++;
            $destination = $this->path . $time . 't_' . $i . $ext;
        }
        
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new FileUploadException(
            "Não foi possível realizar o upload [Mover para pasta específicada]");
        }

        return new File($destination);
    }

}

?>