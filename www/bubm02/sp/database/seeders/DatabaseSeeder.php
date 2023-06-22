<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'first_name' => 'User',
            'last_name' => 'Test',
            'email' => 'user@test.test',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'email' => 'admin@test.test',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $this->createGuitarCategory();
        $this->createBassCategory();
        $this->createKeysCategory();
        $this->addAcousticGuitars();
    }

    public function createGuitarCategory() : void {
        DB::table('categories')->insert([
            'name' => 'Guitars',
        ]);
        $guitarsId = $this->getCategoryId('Guitars');
        DB::table('categories')->insert([
            'name' => 'Acoustic guitars',
            'category_id' => $guitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Classic guitars',
            'category_id' => $guitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Electric guitars',
            'category_id' => $guitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Electroacoustic guitars',
            'category_id' => $guitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Effects',
            'category_id' => $guitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Amps',
            'category_id' => $guitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Combos',
            'category_id' => $guitarsId,
        ]);
    }

    public function createBassCategory() : void {


        DB::table('categories')->insert([
            'name' => 'Bass guitars',
        ]);
        $bassGuitarsId = $this->getCategoryId('Bass guitars');
        DB::table('categories')->insert([
            'name' => 'Electric bases',
            'category_id' => $bassGuitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Effects',
            'category_id' => $bassGuitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Amps',
            'category_id' => $bassGuitarsId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Combos',
            'category_id' => $bassGuitarsId,
        ]);
    }
    public function createKeysCategory() : void {
        DB::table('categories')->insert([
            'name' => 'Keys',
        ]);
        $keysId = $this->getCategoryId('Keys');
        DB::table('categories')->insert([
            'name' => 'Keyboards',
            'category_id' => $keysId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Synthesizers',
            'category_id' => $keysId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Pianos',
            'category_id' => $keysId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Effects',
            'category_id' => $keysId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Amps',
            'category_id' => $keysId,
        ]);
        DB::table('categories')->insert([
            'name' => 'Combos',
            'category_id' => $keysId,
        ]);
    }
    public function addAcousticGuitars() : void {
        $guitarsId = $this->getCategoryId('Acoustic guitars');
        DB::table('items')->insert([
            'name' => 'Harley Benton CLA-15M SolidWood',
            'image' => 'https://images.static-thomann.de/pics/bdb/505980/16405376_800.jpg',
            'description' => 'Custom Line Solid Wood Series
                Style: Auditorium
                Top: solid okoume
                Back and sides: solid okoume
                Neck: Okoume
                Fingerboard: Pau Ferro
                SnowFlake fingerboard inlays
                Neck profile: Oval C
                Scale: 643 mm (25.3")
                Nut width: 43 mm (1.69")
                Bone nut
                20 frets
                Pau Ferro bridge with bone saddle
                Deluxe Antique Copper open tuners
                Factory strings: D\'Addarío XTAPB1253 .012 - .053 (Art. 471307)
                Colour: Natural matte',
            'price' => 7099,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $guitarsId,
        ]);
        DB::table('items')->insert([
            'name' => 'Harley Benton Custom Line CLA-15MCE NS',
            'image' => 'https://images.static-thomann.de/pics/bdb/333967/13547336_800.jpg',
            'description' => 'Steel-String Guitar with Pickup
                Design: Auditorium 000-14 with cutaway
                Dovetail construction
                Top: Gabon mahogany top (Aucoumea klaineana)
                Scalloped X-bracing
                Body: Gabon mahogany (Aucoumea klaineana)
                Neck: Gabon mahogany (Aucoumea klaineana)
                Fretboard: Ovangkol
                Snowflake inlays
                Dovetail construction
                Neck profile: Modified oval C
                Body binding: Wooden
                Scale: 643 mm
                Nut width: 43 mm
                20 Frets
                Nut: Bone
                Compensated saddle
                Pau Ferro bridge
                Chrome-plated DLX DieCast machine heads
                Strings: Daddario XTAPB Light .012 - .053 (Art.471307)
                Pickup: Fishman Presys-II Preamp System with integrated tuner
                Dimensions: 103 x 38 x 10 cm
                Colour: Natural matt
                Suitable case: Art.208576 (not included)',
            'price' => 5699,
            'discount_price' => 4999,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $guitarsId,
        ]);
        DB::table('items')->insert([
            'name' => 'Martin Guitars 000JR-10E Shawn Mendes',
            'image' => 'https://images.static-thomann.de/pics/bdb/556095/18200871_800.jpg',
            'description' => 'Martin Guitars 000JR-10E, Spruce, Sapele Shawn Mendes; Shape: 000 Junior 14 Fret; Acoustic guitar; Top: Spruce; Back & sides: Sapele; Bracing: X-Brace 1/4" Spruce; Neck: Sipo; Fingerboard: Ebony; Inlays: Custom Shawn Mendes, MOP Pattern, white; 20 frets; Nut: White Corian; Nut width: 44.5 mm (1.75"); fretboard radius: 16"; bridge inlay: Compensated White Tusq; scale length: 610 mm (24"); rosette: Mother-of-Pearl Pattern with Multi-Stripe; bridge string spacing: 54.8 mm (2.16"); bridge material: ebony; binding: black; Pickup: Fishman; tuners: Small Chrome Enclosed Gear; includes. Gig Bag; Color: Natural',
            'price' => 23390,
            'discount_price' => 22990,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $guitarsId,
        ]);
        DB::table('items')->insert([
            'name' => 'Martin Guitars 000-18',
            'image' => 'https://images.static-thomann.de/pics/bdb/556071/18317048_800.jpg',
            'description' => 'Martin Guitars 000-18; Shape: 000 - Auditorium Acoustic Guitar; Top: Solid Spruce; Back & Sides: Solid Mahogany; Neck: Mahogany; Fingerboard: Ebony (Diospyros Crassiflora); Inlays: White Abalone Dots; 20 Frets; Nut: Bone; Nut Width: 44,5 mm (1,75"); Scale: 632 mm (24,9"); Bridge Material: Ebenholz (Diospyros Crassiflora); Saddle: Bone; Pickguard: Tortoise; Binding: Tortoise; Tuners: Nickel Open Gear; Incl. Case; Colour: Natural; Stock Strings: Martin Guitars MA540T Authentic Treated Light (469771); Made In USA',
            'price' => 81900,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $guitarsId,
        ]);
        DB::table('items')->insert([
            'name' => 'Harley Benton Custom Line CLA-15M',
            'image' => 'https://images.static-thomann.de/pics/bdb/318348/14965075_800.jpg',
            'description' => '
                Steel-String Guitar

                    Auditorium 000-14 design
                    Dovetail construction
                    Solid gaboon mahagony top (Aucoumea klaineana)
                    Scalloped X-bracing
                    Gaboon mahagony body (Aucoumea klaineana)
                    Gaboon mahagony neck (Aucoumea klaineana)
                    Pau Ferro fretboard
                    Modified oval C neck profile
                    Snowflake fretboard inlays
                    Wooden body binding
                    Scale: 643 mm
                    Nut width: 43 mm
                    20 Frets
                    Bone nut
                    Compensated bone saddle
                    Pau Ferro bridge
                    Chrome-plated diecast DLX machine heads
                    D\'Addario XTAPB1253 Light strings, .012 - .053 (Article Nr 471307)
                    Colour: Natural matte

            ',
            'price' => 4290,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $guitarsId,
        ]);
    }

    public function addClassicalGuitars() {
        $categoryId = $this->getCategoryId('Classic guitars');
        DB::table('items')->insert([
            'name' => 'Thomann Classic Guitar S 4/4',
            'image' => 'https://images.static-thomann.de/pics/bdb/130180/17136473_800.jpg',
            'description' => '
            Classical Guitar

                Size: 4/4
                Solid, tinted spruce top
                Back and sides: Solid maple, walnut stained
                Neck: Maple, walnut stained
                Fretboard: Acacia
                Bridge: Acacia
                Black top and back binding
                Walnut coloured neck finish
                Nut width: 52 mm
                Scale length: 650 mm
                Total length: 98 cm
                Nickel-plated Van Gent tuners
                Round, warm, differentiated sound
                Strings: Hannabach 815 (Art.122784)
                Colour: Natural high gloss
                Made in Europe
                Matching strap buttons: Art.213102 (not included)'
            ,
            'price' => 4699,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $categoryId,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort AC75 Open Pore',
            'image' => 'https://images.static-thomann.de/pics/bdb/566036/18265556_800.jpg',
            'description' => 'google translate
            Acoustic Guitar

                Size: 3/4
                Top: Spruce
                Back & sides: Mahogany
                Neck: Mahogany
                Fingerboard: Merbau
                Scale: 578 mm (22.8")
                Nut width: 45 mm (1 3/4")
                18 Frets
                Bridge material: Merbau
                Finish: Open Pore
                Colour: Natural

            ',
            'price' => 2099,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $categoryId,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort CEC5 Natural Glossy',
            'image' => 'https://images.static-thomann.de/pics/bdb/566030/18338883_800.jpg',
            'description' => 'google translate
            Acoustic Guitar

            Top: Spruce
            Back and sides: Okoume
            Neck: Mahogany
            Fingerboard: Merbau
            Scale: 650 mm (25.6")
            19 Frets
            Bridge: Merbau
            Colour: Natural open pore

            ',
            'price' => 2099,
            'discount_price' => 1999,
            'stock' => 5,
            'rating' => 5,
            'category_id' => $categoryId,
        ]);
    }

//    public function a() {
//        DB::table('items')->insert([
//            'name' => '',
//            'image' => '',
//            'description' => '',
//            'price' => ,
//            'stock' => 5,
//            'rating' => 5,
//            'category_id' => $categoryId,
//        ]);
//    }



    public function getCategoryId($name) : int
    {
        return DB::table('categories')->select('id')->where('name', $name)->get(0)->get(0)->id;
    }



}
