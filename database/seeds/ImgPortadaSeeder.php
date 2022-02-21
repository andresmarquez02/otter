<?php

use App\ImagePortada;
use Illuminate\Database\Seeder;

class ImgPortadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagePortada::create(["img" => "img_portada/portada1.jpg"]);
        ImagePortada::create(["img" => "img_portada/portada2.jpg"]);
        ImagePortada::create(["img" => "img_portada/portada3.jpg"]);
        ImagePortada::create(["img" => "img_portada/portada4.jpg"]);
    }
}
