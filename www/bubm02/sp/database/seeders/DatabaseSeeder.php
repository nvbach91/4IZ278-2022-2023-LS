<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
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
        $this->createItems();
    }

    public function createGuitarCategory() {

        DB::table('categories')->insert([
            'name' => 'Guitars',
        ]);
        $guitarsId = DB::table('categories')->select('id')->where('name', 'Guitars')->get(0)->get(0)->id;
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

    public function createBassCategory() {


        DB::table('categories')->insert([
            'name' => 'Bass guitars',
        ]);
        $bassGuitarsId = DB::table('categories')->select('id')->where('name', 'Bass guitars')->get(0)->get(0)->id;
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
    public function createKeysCategory() {
        DB::table('categories')->insert([
            'name' => 'Keys',
        ]);
        $keysId = DB::table('categories')->select('id')->where('name', 'Keys')->get(0)->get(0)->id;
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
    public function createItems() {
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Cort Little CJ Walnut Open Pore',
            'image' => 'https://thumbs.static-thomann.de/thumb/thumb220x220/pics/prod/219218.jpg',
            'description' => '
Řada Discovery značky Tanglewood představuje cenově dostupné modely akustických kytar s výraznou kresbou exotických dřev.
Tanglewood Discovery DBT PE HR je elektroakustická kytara s kompaktním tělem typu Parlor. Přední deska kytary je zhotovena z laminovaného himalájského smrku, luby z překližovaného ořechu a zadní deska z laminovaného materiálu označeného výrobcem jako Hawaiian Rainwood/Rain Tree, jehož kresba poskytuje kytaře luxusní vzhled. Krk je k tělu připevněn na dvanáctém pražci, plochu hmatníku z kompozitního materiálu v dekoru ebenu rozděluje dvacet pražců a orientační poziční tečky.
Možnost ozvučení nabízí firemní preamp TW EX-4 s čtyřpásmovým ekvalizérem a integrovanou ladičkou. Struny jsou uchyceny v chromovaných Die-Cast mechanikách a kobylce z kompozitu.
Parametry',
            'price' => 6000,
            'discount_price' => 9000,
            'stock' => 6000,
            'rating' => 5,
            'category_id' => 1,
        ]);
    }



}
