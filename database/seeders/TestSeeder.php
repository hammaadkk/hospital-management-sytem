<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = [
            ['test_name' => 'Rhinoscopy', 'charges' => 3500.00],
            ['test_name' => 'Nasal Endoscopy', 'charges' => 1500.00],
            ['test_name' => 'Nasal Cytology', 'charges' => 500.00],
            ['test_name' => 'Nasal Culture', 'charges' => 500.00],
            ['test_name' => 'Anterior Rhinomanometry', 'charges' => 5000.00],
            ['test_name' => 'Acoustic Rhinometry', 'charges' => 4000.00],
            ['test_name' => 'Nasal Airflow Test', 'charges' => 800.00],
            ['test_name' => 'Nasal Provocation Test', 'charges' => 1000.00],
            ['test_name' => 'Nasal Smear', 'charges' => 1500.00],
            ['test_name' => 'Nasal Biopsy', 'charges' => 2500.00],
            ['test_name' => 'Throat Swab Culture', 'charges' => 3000.00],
            ['test_name' => 'Throat Swab for Rapid Strep Test', 'charges' => 3500.00],
            ['test_name' => 'Throat Culture for Bacterial Infections', 'charges' => 1000.00],
            ['test_name' => 'Throat Viral Culture', 'charges' => 1500.00],
            ['test_name' => 'Throat X-ray (Radiography)', 'charges' => 1000.00],
            ['test_name' => 'Throat CT Scan (Computed Tomography)', 'charges' => 6000.00],
            ['test_name' => 'Throat MRI (Magnetic Resonance Imaging)', 'charges' => 7000.00],
            ['test_name' => 'Throat Endoscopy (Laryngoscopy)', 'charges' => 9000.00],
            ['test_name' => 'Throat Biopsy', 'charges' => 6500.00],
            ['test_name' => 'Throat Vocal Cord Function Test', 'charges' => 2500.00],
            ['test_name' => 'Skin Biopsy', 'charges' => 3500.00],
            ['test_name' => 'Patch Testing (Allergy Testing)', 'charges' => 1500.00],
            ['test_name' => 'Skin Culture for Bacterial Infections', 'charges' => 500.00],
            ['test_name' => 'Skin Scraping for Fungal Infections', 'charges' => 1500.00],
            ['test_name' => 'Skin Smear for Parasitic Infections', 'charges' => 500.00],
            ['test_name' => 'Skin Prick Test (Allergy Testing)', 'charges' => 400.00],
            ['test_name' => 'Skin Patch Test (Allergy Testing)', 'charges' => 500.00],
            ['test_name' => 'Skin Allergen-Specific IgE Blood Test', 'charges' => 300.00],
            ['test_name' => 'Skin Gram Stain', 'charges' => 1000.00],
            ['test_name' => 'Skin Punch Biopsy', 'charges' => 900.00],
            ['test_name' => 'Visual Acuity Test (Snellen Eye Chart Test)', 'charges' => 1200.00],
            ['test_name' => 'Refraction Test (Determination of Eyeglass Prescription)', 'charges' => 1100.00],
            ['test_name' => 'Slit-Lamp Examination (Biomicroscopy)', 'charges' => 3800.00],
            ['test_name' => 'Tonometry (Measurement of Intraocular Pressure)', 'charges' => 1500.00],
            ['test_name' => 'Dilated Fundus Examination (Ophthalmoscopy)', 'charges' => 1800.00],
            ['test_name' => 'Fluorescein Angiography (FA)', 'charges' => 4700.00],
            ['test_name' => 'Optical Coherence Tomography (OCT)', 'charges' => 5300.00],
            ['test_name' => 'Gonioscopy (Examination of the Anterior Chamber Angle)', 'charges' => 500.00],
            ['test_name' => 'Color Vision Test', 'charges' => 500.00],
            ['test_name' => 'Visual Field Test (Perimetry)', 'charges' => 700.00],
            ['test_name' => 'Pure Tone Audiometry (PTA)', 'charges' => 1500.00],
            ['test_name' => 'Tympanometry', 'charges' => 700.00],
            ['test_name' => 'Otoacoustic Emissions (OAE) Test', 'charges' => 5200.00],
            ['test_name' => 'Auditory Brainstem Response (ABR) Test', 'charges' => 9400.00],
            ['test_name' => 'Audiogram', 'charges' => 3550.00],
            ['test_name' => 'Speech Audiometry', 'charges' => 3800.00],
            ['test_name' => 'Acoustic Reflex Testing', 'charges' => 1400.00],
            ['test_name' => 'High-Frequency Audiometry', 'charges' => 2200.00],
            ['test_name' => 'Middle Ear Muscle Reflex (MEMR) Test', 'charges' => 500.00],
            ['test_name' => 'Electrocochleography (ECoG)', 'charges' => 5700.00]
            
            
           
           
        ];

        Test::insert($tests);
    
    }
}
