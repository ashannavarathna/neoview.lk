<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrLog
 *
 * @author ashan nawarathna
 */
class ErrLog {

    function writeError_log($data) {
        $file = '';
        if (file_exists("./log.txt")) {
            $file = "./log.txt";
        } else {
            echo 'no file found!';
        }
        try {

            // wrtie data
            if (file_put_contents($file, "fuck", FILE_APPEND)) {
                echo 'data successfully puts';
            } else {
                echo 'unable to write data';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
