<?php

use Symfony\Component\Yaml\Yaml;

if (! function_exists('xeno_clean')) {
    /**
     * Powerful XenoPHP Sanitizer
     *
     * A robust helper to sanitize input, inspired by CodeIgniter's security practices.
     * Prevents XSS and common injection attacks.
     *
     * @param string|array $data
     * @return string|array
     */
    function xeno_clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[xeno_clean($key)] = xeno_clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }
}

if (! function_exists('xeno_humanize')) {
    /**
     * Humanize String
     *
     * Makes slug or variable names human readable.
     *
     * @param string $str
     * @return string
     */
    function xeno_humanize($str)
    {
        return ucwords(preg_replace('/[_]+/', ' ', strtolower(trim($str))));
    }
}

if (! function_exists('xeno_config')) {
    /**
     * Get XenoPHP YAML Config
     *
     * Reads from config/xeno.yaml using Symfony Component.
     *
     * @param string $key Dot notation key (e.g. 'app.name')
     * @param mixed $default
     * @return mixed
     */
    function xeno_config($key = null, $default = null)
    {
        $path = base_path('config/xeno.yaml');
        if (! file_exists($path)) {
            return $default;
        }

        $yaml = Yaml::parseFile($path);

        if (is_null($key)) {
            return $yaml;
        }

        // Simple dot notation support
        $array = $yaml;
        foreach (explode('.', $key) as $segment) {
            if (isset($array[$segment])) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }
}
