<?php

namespace App\Services\Reference;

class ReferenceService
{
    public function getReference()
    {
        $agora = new \DateTime();
        $reference = $random = time() . rand(10*45, 100*98);

        return $reference;
    }
}
