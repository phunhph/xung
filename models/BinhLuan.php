<?php
class BinhLuan
{
    public $id;
    public $nguoi_gui;
    public $san_pham;
    public $mes;
    public $ngay;
    public $danh_gia;
    public function __construct($id, $nguoi_gui, $san_pham, $mes, $ngay, $danh_gia)
    {
        $this->id = $id;
        $this->nguoi_gui = $nguoi_gui;
        $this->san_pham = $san_pham;
        $this->mes = $mes;
        $this->ngay = $ngay;
        $this->danh_gia = $danh_gia;
    }
}
