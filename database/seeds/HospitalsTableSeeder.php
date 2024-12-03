<?php

use Illuminate\Database\Seeder;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 DB::table('hospitals')->insert([
            'name' => 'Lokanthali Welness Clinic',
            'slogan' => 'Enhancing Life, Excelling Incase...',
            'logo' => 'uploads/logo.png',
            'address' => 'Lokanthali-1, Madhyapur Thimi, Bhaktpur,Nepal ',
            'contact' => '+9779860479432 ,+9779846288255',
            'email' => 'lwc2074@gmail.com',
            'pan_no' => '123',
            'registration_no' => '12345',
            'website' => 'lwc.health.com',
            'description' => 'Our moto healty life.',
            'tax_type' => 'Health Tax',
            'tax_percent' => 5,
            'invoice_prefix'=>'LWC-',
            'patient_prefix' => 'LWC-',
            'invoice_message'=> 'Invoice',
        ]);

    }
}
