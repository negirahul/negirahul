<?php

namespace Database\Seeders;

  use Illuminate\Database\Seeder;
  use App\Models\IcdCode;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\LazyCollection;

class IcdCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('icd_codes')->truncate();
        
        LazyCollection::make(function () {
          $handle = fopen(public_path("ic_data.csv"), 'r');

          while (($line = fgetcsv($handle, 4096)) !== false) {
            yield $line;
        }

        fclose($handle);
    })
        ->skip(1)
        ->chunk(1000)
        ->each(function (LazyCollection $chunk) {
          $records = $chunk->map(function ($row) {
            return [
                "level4_code" => $row[0],
                "level3_code" => $row[1],
                "level2_code" => $row[2],
                "level1_code" => $row[3],
                "level4" => $row[4],
                "level3" => $row[5],
                "level2" => $row[6],
                "level1" => $row[7],
            ];
        })->toArray();

          DB::table('icd_codes')->insert($records);
      });
    }
}