<?php

namespace App\Services;


class SanitizerService {

    public function sanitize($value) : string {

        return htmlspecialchars(trim($value));

    }

}