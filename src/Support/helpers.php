<?php

/**
 * Get the concrete classname for an abstract binding
 *
 * @param $abstract
 *
 * @return string
 */
if (!function_exists('resolve_class')) {
    function resolve_class($abstract)
    {
        return get_class(app($abstract));
    }
}
