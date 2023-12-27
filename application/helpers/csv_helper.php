<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('array_to_csv')) {
    /**
     * Convert an array to a CSV string
     *
     * @param array $array The input array
     * @param string $delimiter The delimiter character
     * @param string $enclosure The enclosure character
     * @param string $newline The newline character
     * @return string The CSV string
     */
    function array_to_csv($array, $delimiter = ',', $enclosure = '"', $newline = "\n") {
        $output = '';

        foreach ($array as $row) {
            $output .= implode($delimiter, array_map(function ($item) use ($enclosure) {
                return $enclosure . str_replace($enclosure, $enclosure . $enclosure, $item) . $enclosure;
            }, $row));
            $output .= $newline;
        }

        return $output;
    }
}

if (!function_exists('csv_to_array')) {
    /**
     * Convert a CSV file to an array
     *
     * @param string $file_path The path to the CSV file
     * @param string $delimiter The delimiter character
     * @param string $enclosure The enclosure character
     * @param string $newline The newline character
     * @return array The CSV data as an array
     */
    function csv_to_array($file_path, $delimiter = ',', $enclosure = '"', $newline = "\n") {
        $csv_data = array();

        if (($handle = fopen($file_path, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter, $enclosure)) !== FALSE) {
                $csv_data[] = $row;
            }
            fclose($handle);
        }

        return $csv_data;
    }
}
