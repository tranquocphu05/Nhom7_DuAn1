<?php
// core/BaseController.php

class BaseController {
    protected function render($view, $data = []) {
        extract($data); // Chuyển các biến trong mảng thành các biến độc lập
        require_once "view/{$view}.php";
    }
}
