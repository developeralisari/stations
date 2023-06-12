<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('routes')->delete();
        
        \DB::table('routes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Adalar',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Arnavutköy',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ataşehir',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Avcılar',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Bağcılar',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Bahçelievler',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Bakırköy',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Başakşehir',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Bayrampaşa',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Beşiktaş',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Beykoz',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Beylikdüzü',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Beyoğlu',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Büyükçekmece',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Çatalca',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Çekmeköy',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Esenler',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Esenyurt',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Eyüpsultan',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Fatih',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Gaziosmanpaşa',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Güngören',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Kadıköy',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Kağıthane',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Kartal',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Küçükçekmece',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Maltepe',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Pendik',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Sancaktepe',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Sarıyer',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Silivri',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Sultanbeyli',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Sultangazi',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Şile',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Şişli',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Tuzla',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Ümraniye',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Üsküdar',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Zeytinburnu',
                'created_at' => '2022-11-17 09:48:32',
                'updated_at' => '2022-11-17 09:48:32',
            ),
        ));
        
        
    }
}