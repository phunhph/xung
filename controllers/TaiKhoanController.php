<?php
include('DAO/TaiKhoanDAO.php');
class TaiKhoanController
{
    // danh sách tài khoản
    public function index()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $TaiKhoanDAO = new TaiKhoanDAO();
                $list = $TaiKhoanDAO->show();
                include "views/taikhoan/admin/list.php";
            } else {
                include('views/home/user/Home.php');
            }
        } else {
            header("Location: index.php?controller=login");
        }
    }
    // thêm mới tài khoản
    public function add()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                if (isset($_POST['email'])) {
                    $TaiKhoanDAO = new TaiKhoanDAO();
                    $TaiKhoanDAO->add($_POST['ten'], $_POST['email'], $_POST['password'], $_POST['quyen']);
                    $_SESSION['error'] = 'thêm mới thành công';
                    header("Location: index.php?controller=taiKhoan");
                    exit();
                } else {
                    $TaiKhoanDAO = new TaiKhoanDAO();
                    $roles = $TaiKhoanDAO->showRole();
                    include('views/taikhoan/admin/add.php');
                }
            } else {
                include('views/home/user/Home.php');
            }
        } else {
            header("Location: index.php?controller=login");
        }
    }
    // xoá tài khoản
    public function delete()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                if ($_SESSION['id'] == $_GET['id']) {
                    $_SESSION['error'] = 'không thể tự xoá tài khoản của bản thân';
                    header("Location: index.php?controller=taiKhoan");
                    exit();
                } else {
                    $TaiKhoanDAO = new TaiKhoanDAO();
                    $TaiKhoanDAO->delete($_GET['id']);
                    $_SESSION['error'] = 'Xoá thành công';
                    header("Location: index.php?controller=taiKhoan");
                    exit();
                }
            } else {
                include('views/home/user/Home.php');
            }
        } else {
            header("Location: index.php?controller=login");
        }
    }
    // sửa tài khoản
    public function fix()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {

                if (isset($_POST['email'])) {
                    $TaiKhoanDAO = new TaiKhoanDAO();
                    $TaiKhoanDAO->fix($_POST['id'], $_POST['ten'], $_POST['email'], $_POST['quyen'], $_POST['trang_thai']);
                    $_SESSION['error'] = 'Sửa thông tin thành công';
                    header("Location: index.php?controller=taiKhoan");
                    exit();
                } else {
                    if (isset($_GET['id'])) {
                        $TaiKhoanDAO = new TaiKhoanDAO();
                        $list = $TaiKhoanDAO->showOne($_GET['id']);
                        $roles = $TaiKhoanDAO->showRole();
                        include('views/taikhoan/admin/fix.php');
                    } else {
                        header("Location: index.php?controller=taiKhoan");
                    }
                }
            } else {
                include('views/home/user/Home.php');
            }
        } else {
            header("Location: index.php?controller=login");
        }
    }
}
