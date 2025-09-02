<?php
/**
 * Compatibility shims for PHP 8.x and legacy code.
 * NOTE: These are safe for trusted, theme-bundled code only.
 */

// Reintroduce get_magic_quotes_gpc (removed in PHP 8)
if (!function_exists('get_magic_quotes_gpc')) {
    function get_magic_quotes_gpc() { return false; }
}

// Reintroduce each() (removed in PHP 8).
// Emulates the old behavior using array pointers.
if (!function_exists('each')) {
    function each(&$array) {
        $key = key($array);
        if ($key === null) {
            return false;
        }
        $value = current($array);
        next($array);
        return array(
            1 => $value,
            '1' => $value,
            0 => $key,
            'key' => $key,
            'value' => $value
        );
    }
}

// Reintroduce create_function() (removed in PHP 8).
// Wraps body into an anonymous function using eval().
if (!function_exists('create_function')) {
    function create_function($args, $code) {
        $args = trim($args);
        if ($args === '') { $args = ''; }
        // Very basic safety: no closing PHP tags allowed
        if (strpos($code, '?>') !== false) {
            throw new \Exception('Invalid code for create_function shim');
        }
        $lambda = 'return function(' . $args . '){' . $code . '};';
        $f = eval($lambda);
        if (!$f) {
            throw new \Exception('Failed to create function via eval');
        }
        return $f;
    }
}

// Map split()/spliti() to preg_split with case sensitivity behavior.
if (!function_exists('split')) {
    function split($pattern, $string, $limit = -1) {
        $delim = '/' . str_replace('/', '\/', $pattern) . '/';
        return preg_split($delim, $string, $limit);
    }
}
if (!function_exists('spliti')) {
    function spliti($pattern, $string, $limit = -1) {
        $delim = '/' . str_replace('/', '\/', $pattern) . '/i';
        return preg_split($delim, $string, $limit);
    }
}

// Map ereg* to preg_* equivalents (best-effort).
if (!function_exists('ereg')) {
    function ereg($pattern, $string, &$regs = null) {
        $delim = '/' . str_replace('/', '\/', $pattern) . '/';
        $res = preg_match($delim, $string, $m);
        if ($res && $regs !== null) { $regs = $m; }
        return $res;
    }
}
if (!function_exists('eregi')) {
    function eregi($pattern, $string, &$regs = null) {
        $delim = '/' . str_replace('/', '\/', $pattern) . '/i';
        $res = preg_match($delim, $string, $m);
        if ($res && $regs !== null) { $regs = $m; }
        return $res;
    }
}
if (!function_exists('ereg_replace')) {
    function ereg_replace($pattern, $replacement, $string) {
        $delim = '/' . str_replace('/', '\/', $pattern) . '/';
        return preg_replace($delim, $replacement, $string);
    }
}
if (!function_exists('eregi_replace')) {
    function eregi_replace($pattern, $replacement, $string) {
        $delim = '/' . str_replace('/', '\/', $pattern) . '/i';
        return preg_replace($delim, $replacement, $string);
    }
}
