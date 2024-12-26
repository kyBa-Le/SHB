<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
class PaymentController extends Controller {
    
    public function show() {
        $data = Application::$app->request->getBody();
        if (is_array($data)) {
            $isArray = false;
            foreach ($data as $item) {
                if (is_array($item) && count(array_filter(array_keys($item), 'is_string')) > 0) {
                    $isArray = true;
                    break;
                }
            }
            if ($isArray) {
                $totalPrice = $this->totalPrice($data);
            } else {
                $totalPrice = (int) $data['unitPrice'] * (int) $data['quantity'];
            }
        } else {
            $totalPrice = 0;
        }
        return $this->render('payment', ['orderItems' => $data, 'totalPrice' => $totalPrice, 'isArray' => $isArray]);
    }
    


    private function totalPrice($array) {
        $totalPrice = 0;
        for ($i = 0; $i<count($array); $i++) {
            var_dump($array[$i]);
            $totalPrice += (int) $array[$i]['quantity'] * (int) $array[$i]['unitPrice'];
        }
        return $totalPrice;
    }
}
?>