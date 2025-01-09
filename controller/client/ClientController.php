<?php
// controller/client/ClientController.php

require_once 'core/BaseController.php';

class ClientController extends BaseController {
    public function index() {
        // Render trang chủ cho client
        $this->render('client/home');
    }

    // Các hành động khác của client...
}
