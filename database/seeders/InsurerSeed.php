<?php

namespace Database\Seeders;

use App\Models\Insurer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class InsurerSeed extends Seeder
{


    public function run()
    {

        $insurereArr = [
            [ 'name' => 'Acko General Insurance Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Aditya Birla Health Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Bajaj Allianz General Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Care Health Insurance Ltd. (Religare Health Insurance Co. Ltd.)', 'type' => 'TPA' ],
            [ 'name' => 'Cholamandalam MS General Insurance Co Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Edelweiss General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Future Generali India Insurance Co Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Go Digit General Insurance Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'HDFC ERGO General Insurance Co.Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'ICICI LOMBARD General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'IFFCO TOKIO General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Kotak Mahindra General Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Liberty General Insurance Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Magma HDI General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Manipal Cigna Health Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'National Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Navi General Insurance Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Niva Bupa Health Insurance Co Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Raheja QBE General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Reliance General Insurance Co.Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Royal Sundaram General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'SBI General Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Shriram General Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Star Health & Allied Insurance Co.Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Tata AIG General Insurance Co. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'The New India Assurance Co. Ltd', 'type' => 'TPA' ],
            [ 'name' => 'The Oriental Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'United India Insurance Company Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Universal Sompo General Insurance Co. Ltd.', 'type' => 'TPA' ],
           
        ];

        foreach ($insurereArr as $key => $insurere) {
            Insurer::create([
                'name' => $insurere['name'],
                'type' => $insurere['type'],
            ]);
        }
    }
}
