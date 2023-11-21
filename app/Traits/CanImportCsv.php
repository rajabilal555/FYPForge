<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait CanImportCsv
{
    protected function getCSVData(string $data): Collection
    {
        $rawData = str_getcsv($data, "\n");
        $rawData = array_map('str_getcsv', $rawData);

        $header = collect(array_shift($rawData));

        $data = collect($rawData);

        $csvData = $data->map(function ($row) use ($header) {
            return $header->combine($row);
        });

        return $csvData;
    }
}
