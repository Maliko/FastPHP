<?php

namespace FastPHP\Core\Elementary;

class ConfigFileReader
{
    private $_sXmlPath = '';

    public function __construct($sXmlPath)
    {
        $this->_sXmlPath = $sXmlPath;
    }

    public function getConfig() {
        try {
            $xmlFile = fopen($this->_sXmlPath, 'r');
            $data = fread($xmlFile, filesize($this->_sXmlPath));
            fclose($xmlFile);

            $aData = simplexml_load_string($data);

            return $aData;
        } catch (\Exception $e) {
            return null;
        }
    }
}