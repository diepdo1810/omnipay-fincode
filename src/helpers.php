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

if (!function_exists('createEnv')) {
    /**
     * Create .env file.
     *
     * @param array $data
     */
    function createEnv(array $data)
    {
        $env = '';
        foreach ($data as $key => $value) {
            $env .= "$key=$value\n";
        }

        file_put_contents(__DIR__ . '/../.env', $env);
    }
}

if (!function_exists('getEnv')) {
    /**
     * Get .env file.
     *
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    function getEnv(string $key, string $default = ''): string
    {
        return file_get_contents(__DIR__ . '/../.env')[$key] ?? $default;
    }
}