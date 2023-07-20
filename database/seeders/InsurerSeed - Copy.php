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
            [ 'name' => 'Anmol Medicare Insurance TPA Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'East West Assist Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Ericson Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Family Health Plan Insurance TPA Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Genins India Insurance TPA Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Good Health Insurance TPA Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Health India Insurance TPA Services Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Health Insurance TPA of India Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Heritage Health Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'MDIndia Health Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Medi Assist Insurance TPA Pvt. Ltd. ', 'type' => 'TPA' ],
            [ 'name' => 'Medsave Health Insurance TPA Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Medvantage Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Paramount Health Services & Insurance TPA Pvt. Ltd. ', 'type' => 'TPA' ],
            [ 'name' => 'Park Mediclaim Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Raksha Health Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Safeway Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Vidal Health Insurance TPA Pvt. Ltd.', 'type' => 'TPA' ],
            [ 'name' => 'Vision Digital Insurance TPA Pvt. Ltd. ', 'type' => 'TPA' ],
            [ 'name' => 'GIPSA PPN', 'type' => 'TPA' ],
            [ 'name' => 'Acko General Insurance Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Aditya Birla Health Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Bajaj Allianz General Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Care Health Insurance Ltd. (Religare Health Insurance Co. Ltd.)', 'type' => 'Insurance Company' ],
            [ 'name' => 'Cholamandalam MS General Insurance Co Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Edelweiss General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Future Generali India Insurance Co Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Go Digit General Insurance Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'HDFC ERGO General Insurance Co.Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'ICICI LOMBARD General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'IFFCO TOKIO General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Kotak Mahindra General Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Liberty General Insurance Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Magma HDI General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Manipal Cigna Health Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'National Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Navi General Insurance Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Niva Bupa Health Insurance Co Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Raheja QBE General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Reliance General Insurance Co.Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Royal Sundaram General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'SBI General Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Shriram General Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Star Health & Allied Insurance Co.Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Tata AIG General Insurance Co. Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'The New India Assurance Co. Ltd', 'type' => 'Insurance Company' ],
            [ 'name' => 'The Oriental Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'United India Insurance Company Ltd.', 'type' => 'Insurance Company' ],
            [ 'name' => 'Universal Sompo General Insurance Co. Ltd.', 'type' => 'Insurance Company' ]
        ];

        foreach ($insurereArr as $key => $insurere) {
            Insurer::create([
                'name' => $insurere['name'],
                'type' => $insurere['type'],
            ]);
        }
    }
}
