<?php

/*
	Contient un registre de toutes les modifications apportées au
	code de base de PHPWord



	PHPWord-master\src\PhpWord\Shared\String.php
	// ********************************************************
    public static function toUTF8($value = '')
    {
        if (!is_null($value) && !self::isUTF8($value)) {
            $value = utf8_encode($value);
        }

        return $value;
    }
    // ********************************************************
    Enlever utf8_encode parce que ça encode de utf8 à something
    et ça scrap les accents
    // ********************************************************
    public static function toUTF8($value = '')
    {
        return $value;
    }
    // ********************************************************

	PHPWord-master\src\PhpWord\TemplateProcessor.php
	protected function setValueForPart($documentPartXML, $search, $replace, $limit)
    {
        if (substr($search, 0, 2) !== '${' && substr($search, -1) !== '}') {
            $search = '${' . $search . '}';
        }
        
        // ********************************************************
        //if (!String::isUTF8($replace)) {
           //$replace = utf8_encode($replace);
        //}
        // ********************************************************
     	
        // Note: we can't use the same function for both cases here, because of performance considerations.
        if (self::MAXIMUM_REPLACEMENTS_DEFAULT === $limit) {
            return str_replace($search, $replace, $documentPartXML);
        } else {
            $regExpDelim = '/';
            $escapedSearch = preg_quote($search, $regExpDelim);
            return preg_replace("{$regExpDelim}{$escapedSearch}{$regExpDelim}u", $replace, $documentPartXML, $limit);
        }
    }


*/