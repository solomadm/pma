<?php

namespace App\Helpers;

trait CSVExporter
{

    /**
     * Proceed generate CSV data
     *
     * @param $data
     * @param $filename
     *
     * @return bool|mixed
     */
    protected function exportCSV($data, $filename = 'data')
    {

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename.csv",
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        if (!empty($data)) {
            # add headers for each column in the CSV download
            array_unshift($data, array_keys($data[0]));
        }

        $callback = function () use ($data) {
            $FH = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

}
