<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileAccess
 *
 * @author ashan nawarathna
 */
class FileAccess {

    public static function createFile($path, $text) {
        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $text);
        fclose($myfile);
    }

}
