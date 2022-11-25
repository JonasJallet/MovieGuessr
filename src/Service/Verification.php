<?php

namespace App\Service;

use App\Model\LocationManager;

class Verification
{
    protected array $errors = [];

    public function verification(array $data)
    {
        $this->nameVerification($data);
        $this->tagVerification($data);
        $this->urlVerification($data);

        return $this->errors;
    }

    public function nameVerification(array $data): void
    {
        if (!isset($data['movieName']) || empty($data['movieName'])) {
            $this->errors[] = "The movie name is needed";
        }
        if (strlen($data['movieName']) > 255) {
            $this->errors[] = 'The movie name must be less than 255 characters';
        }
    }

    public function tagVerification(array $data): void
    {
        if (!isset($data['movieTag']) || empty($data['movieTag'])) {
            $this->errors[] = "The movie tag is needed";
        }
        if (strlen($data['movieTag']) > 100) {
            $this->errors[] = 'The movie tag must be less than 100 characters';
        }
    }

    public function urlVerification(array $data): void
    {
        if (!isset($data['url']) || empty($data['url'])) {
            $this->errors[] = "The url is needed";
        }
        if (strlen($data['url']) > 1000) {
            $this->errors[] = 'The url must be less than 100 characters';
        }
        if (!empty($data['url']) && !filter_var($data['url'], FILTER_VALIDATE_URL)) {
            $this->errors[] = 'The URL is not valid';
        }
    }
}
