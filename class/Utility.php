<?php

class Utility
{
    public function jqueryDate2MysqlDate($string)
    {
        $formatedDate = '0000-00-00 00:00:00';
        if($date = DateTime::createFromFormat('d/m/Y', $string)) {
            $formatedDate = $date->format("Y-m-d 00:00:00");
        }
        return $formatedDate;
    }
}