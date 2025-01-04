<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
class OrderItemController extends Controller {
    public function admin(){
        $this->setLayout('admin');
        return $this->render('admin/order');
    }
}