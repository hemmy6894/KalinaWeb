<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class New_excel
{
    public function __construct()
    {
        require_once APPPATH.'third_party/Classes/PHPExcel.php';
        require_once APPPATH.'third_party/Classes/PHPExcel/IOFactory.php';
    }
}