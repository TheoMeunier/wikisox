<?php

if (! function_exists('numberFormat')) {
    /**
     * Format the number with the passed value.
     *
     * @return string
     */
    function numberFormat(float $number)
    {
        return number_format($number, 0, ',', ' ');
    }
}

if (! function_exists('recursive_array_replace')) {
    function recursive_array_replace(string $find, string $replace, array $array, bool $inKey = false): array|string
    {
        if (! is_array($array)) {
            if ($inKey) {
                return $array;
            }

            return str_replace($find, $replace, $array);
        }

        $newArray = [];

        foreach ($array as $key => $value) {
            if (
                $inKey &&
                'integer' !== gettype($key)
            ) {
                /** @var string $key */
                $key = $key;

                $key = str_replace($find, $replace, $key);
            }

            $newArray[$key] = recursive_array_replace($find, $replace, $value, $inKey);
        }

        return $newArray;
    }
}

if (! function_exists('pathinfo_dirname')) {
    /**
     * pathinfo_dirname.
     *
     * @param    $array
     */
    function pathinfo_dirname(array $info): ?string
    {
        $dirname = $info['dirname'] ?? null;

        return $dirname === '.' ? null : $dirname;
    }
}
