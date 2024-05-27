<?php

use Ramsey\Uuid\Uuid;

if (!function_exists('generateCustomId')) {
    /**
     * Generate custom id.
     *
     * @param int $length
     *
     * @return string
     */
    function generateCustomId(int $length = 12): string
    {
        $uuid = Uuid::uuid4()->toString();

        $uuid = str_replace('-', '', $uuid);

        $customId = rtrim(strtr(base64_encode(hex2bin($uuid)), '+/', '-_'), '=');

        return $customId;
    }
}