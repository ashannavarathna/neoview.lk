<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Common
 *
 * @author ashan nawarathna
 */
class Common {

    //search spec word location at string
    public static function searchspecwordlocationinstring($fullstring, $searchtext) {
        $start_index = 0;
        $end_index = 0;
        //fing location of string code
        for ($index = 0; $index < strlen($fullstring); $index++) {
            if ($fullstring[$index] == $searchtext[0]) {
                $start_index = $index;
                $temp_index = $index;
                for ($index_x = 0; $index_x < strlen($searchtext); $index_x++) {
                    if ($fullstring[$temp_index] != $searchtext[$index_x]) {
                        break;
                    } else {
                        $end_index = $temp_index;
                    }$temp_index++;
                }
            }
        }
        return Array($start_index, $end_index);
    }

    //remove unwanted chars -> loop back
    public static function removeunwantedcahrbackword($dataarray, $char, $count, $start_index) {
        $removedcount = 0;
        for ($index = $start_index; $index >= 0; $index--) {
            if ($dataarray[$index] == $char && $removedcount !== $count) {
                unset($dataarray[$index]);
                $removedcount++;
            }
        }
        return implode($dataarray);
    }

    //remove unwanted chars -> loop forward
    public static function removeunwantedcahrupword($dataarray, $char, $count, $start_index, $end_index) {
        $removedcount = 0;
        for ($index = $start_index; $index < $end_index; $index++) {
            if ($dataarray[$index] == $char && $removedcount !== $count) {
                unset($dataarray[$index]);
                $removedcount++;
            }
        }
        return implode($dataarray);
    }

}
?>