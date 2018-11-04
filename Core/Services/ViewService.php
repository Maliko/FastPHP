<?php


namespace FastPHP\Core\Services;

class ViewService {

    private $_module;

    public function __construct($sModule)
    {
        $this->_module = $sModule;
    }

    public function render($sTemplatePath, $aTemplateData = null, $bRenderDirect = true) {
        $sFilePath = dirname($_SERVER['SCRIPT_FILENAME']) . '/Modules/' . $this->_module . '/Views/' . $sTemplatePath . '.php';

        $template = file_get_contents($sFilePath);

        if(!empty($aTemplateData)) {
            extract($aTemplateData, EXTR_SKIP);
        }


        if($bRenderDirect) {
            include $sFilePath;
        } else {
            return $template;
        }

        return null;

    }
}