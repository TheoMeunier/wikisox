<?php

if (! function_exists('numberFormat')) {
    /**
     * @param float $number
     * @return string
     */
    function numberFormat(float $number): string
    {
        return number_format($number, 0, ',', ' ');
    }
}

if (! function_exists('recursive_array_replace')) {
    /**
     * @param string $find
     * @param string $replace
     * @param $array
     * @param bool $inKey
     * @return array|string
     */
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
     * @param array $info
     * @return string|null
     */
    function pathinfo_dirname(array $info): ?string
    {
        $dirname = $info['dirname'] ?? null;

        return $dirname === '.' ? null : $dirname;
    }
}
