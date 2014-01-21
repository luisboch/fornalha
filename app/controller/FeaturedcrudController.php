<?php

require_once 'CrudBase.php';
require_once SERVICE_DIR . 'FeaturedService.php';
require_once APP_DIR . 'utils/ImageUpload.php';

/**
 * Description of FeaturedController
 * @author luis
 * @property FeaturedService $service
 */
class FeaturedcrudController extends CrudBase {

    public function initialize() {
        parent::initialize(new FeaturedService());
        $this->setTitle("Destaques");
    }

    protected function createNewInstance() {
        return new Featured();
    }

    protected function getSearchParams() {
        return array(
            'search' => $this->request->getQuery('search'));
    }

    protected function isValid($instance) {
        return true;
    }

    /**
     * 
     * @param Featured $instance
     */
    protected function populatePostData($instance) {
        $instance->setTitle($this->request->getPost('title'));
        $instance->setSubtitle($this->request->getPost('subtitle'));
        $instance->setLink($this->request->getPost('link'));

        if ($this->request->hasFiles()) {
            try {
                $this->uploadImage($instance);
            } catch (InvalidTypeException $ex) {
                $this->error("Falha no upload: o arquivo não é uma imagem válida");
            } catch (FileUploadException $ex) {
                $this->logger->error($ex->getMessage());
                $this->logger->error($ex->getTraceAsString());
                $this->error("Houve um problema ao realizar o upload, contate suporte");
            }
        }
    }

    private function uploadImage(Featured $f) {
        $imgUpload = new ImageUpload('featured');

        $files = $imgUpload->upload('image', 900, 498);

        if (count($files) == 1) {
            $old = $f->getImage();
            
            $oldFile = new File(IMAGE_DIR . $old);
            
            if($oldFile->exists()){
                $oldFile->delete();
            }
            
            $f->setImage($files[0]->getLink());
        }
    }

}
