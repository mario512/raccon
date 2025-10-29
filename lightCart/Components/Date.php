<?php
class Date
{
    public static function getTime($dateTime = '')
    {
        if (empty($dateTime)) {
            return date("H:i");
        } else {
            return date_create($dateTime)->Format("H:i");
        }
    }

    public static function getDate($dateTime = '', $format = '')
    {
        if (empty($dateTime)) {
            return date("d.m.Y");
        } else {
            if (empty($format)) {
                return date_create($dateTime)->Format("d.m.Y");
            } else {
                return date_create($dateTime)->Format($format);
            }
        }
    }

    public static function getDateTime($dateTime = '', $format = '')
    {
        if (empty($dateTime)) {
            return date("Y-m-d H:i:s");
        } else {
            if (empty($format)) {
                return date_create($dateTime)->Format("Y-m-d H:i:s");
            } else {
                return DateTime::createFromFormat($format, $dateTime);;
            }
        }
    }
}
