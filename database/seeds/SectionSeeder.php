<?php

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'name'  => 'دكتور',
                'alias' => "doctor",
            ],
            [
                'name'  => 'عيادة',
                'alias' => 'clinic',
            ],
            [
                'name'  => 'مستشفي',
                'alias' => 'hospital',
            ],
            [
                'name'  => 'مجمع عيادات',
                'alias' => 'medicalCenter',
            ],
            [
                'name'  => 'مركز اشعة',
                'alias' => 'radiologyCenter',
            ],
            [
                'name'  => 'معمل تحاليل',
                'alias' => 'laboratory',
            ],
            [
                'name'  => 'صيدلية',
                'alias' => 'pharmacy',
            ],
        ];
        Section::insert($sections);
    }
}
