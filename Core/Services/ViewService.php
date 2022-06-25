<?php


namespace FastPHP\Core\Services;

class ViewService {

    private $_module;
    private $_templateData;

    public function __construct($sModule)
    {
        $this->_module = $sModule;
    }

    public function render($sTemplatePath, $aTemplateData = null, $bRenderDirect = true) {        
        $sFilePath = dirname($_SERVER['SCRIPT_FILENAME']) . '/Modules/' . $this->_module . '/Views/' . $sTemplatePath . '.php';

        $template = file_get_contents($sFilePath);

        if(!empty($aTemplateData)) {
            $this->_templateData = $aTemplateData;
            extract($aTemplateData, EXTR_SKIP);
        }


        if($bRenderDirect) {
            include $sFilePath;
        } else {
            return $template;
        }

        return null;

    }
    
    public function import($sTemplatePath) {
        $this->render($sTemplatePath, $this->_templateData);
    }
}