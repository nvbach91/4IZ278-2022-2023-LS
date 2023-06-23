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

        DB::table('users')->insert([
            'name' => 'test',
            'surname' => 'test',
            'email' => 'test@vse.cz',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'surname' => 'test',
            'email' => 'admin@vse.cz',
            'is_admin' => '1',
            'password' => Hash::make('password'),
        ]);
        $this->createCategories();
        $this->createProducts();
        $this->createAddresses();
    }
    public function createAddresses(){
        DB::table('addresses')->insert([
            'user_id' => 1,
            'country' => 'CZ',
            'city' => 'Prague',
            'street' => 'Vltavská',
            'home' => '954',
            'postcode' => '14800',
        ]);
    }

    public function createCategories() {

        DB::table('categories')->insert([
            'name' => 'Overdrive',
        ]);
        DB::table('categories')->insert([
            'name' => 'Distortion',
        ]);
        DB::table('categories')->insert([
            'name' => 'Delay',
        ]);
        DB::table('categories')->insert([
            'name' => 'Tuner',
        ]);
        DB::table('categories')->insert([
            'name' => 'Wah-Wah',
        ]);
        DB::table('categories')->insert([
            'name' => 'Looper',
        ]);
        DB::table('categories')->insert([
            'name' => 'Reverb',
        ]);

    }

    public function createProducts() {
        //distortion
        DB::table('products')->insert([
            'name' => 'ODB-3',
            'brand' => 'Boss',
            'description' => "As the first bass overdrive in the BOSS Compact Effects series, the ODB-3 has been specifically tailored to the needs of today's bass players. It delivers everything, from slightly tweaked sounds to massive overdrive in excellent, impressive quality. The ODB-3 covers the entire frequency range of the bass - down to the deep B on a 5-string - so you always have a first class distortion with a clear, transparent sound. With the BALANCE control you can mix the bass and the effect signal to get the brilliance and the pressure of the original sound fully, even in heavy distortion. The ODB-3 overdrive pedal can also be used as a 2-band equaliser (low / high).",
            'price' => 130,
            'thumbnail' => 'boss-overdrive.png',
            'code'=> '103970',
            'stock' => 7,
            'category_id' => 1,
        ]);
        //overdrive
        DB::table('products')->insert([
            'name' => 'Rat 2 Distortion',
            'brand' => 'Proco',
            'description' => "
            Legendary distortion pedal
            Used on thousands of recordings in the last three decades
            Very versatile as a distortion for arena-rock rhythm tones and soaring leads, as a crunch channel for loud amps, or as a boost for solos, and you can still maintain your amplifiers sound at the same time",
            'price' => 105,
            'thumbnail' => 'rat2-distortion.jpg',
            'code'=> '185691',
            'stock' => 15,
            'category_id' => 2,
            'discount' => 10,
        ]);
        DB::table('products')->insert([
            'name' => 'BD-2',
            'brand' => 'Boss',
            'description' => "Tube amplifiers enable a wide range of awesome sounds: from soft jazz over the hardest rock all the way to melancholic blues. A tube amp enhances the power of expression of a guitar by highlighting the fine nuances of different guitars, pickups and playing styles. With this pedal, you come very close to the sound of a real tube amp. The BD-2 is also ideal for practising at home as it creates the necessary tube distortion even at lower volumes. That will be a relief for your neighbours.",
            'price' => 120,
            'thumbnail' => 'bd-2.jpg',
            'code'=> '103955',
            'stock' => 100,
            'category_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => 'Bluesbreaker',
            'brand' => 'Marshall',
            'description' => "Authentic reissue of the legendary original pedal",
            'price' => 199,
            'thumbnail' => 'bluesbreaker.jpg',
            'code'=> '538026',
            'stock' => 100,
            'category_id' => 2,
        ]);
        //delay
        DB::table('products')->insert([
            'name' => 'SDE-3000 Dual Delay',
            'brand' => 'Boss',
            'description' => "Dual Delay;
            Warm vintage digital delay sound;
            Sound, retro display and controls based on the SDE-3000 rackmount digital delay.",
            'price' => 580,
            'thumbnail' => 'sde-3000.jpg',
            'code'=> '567398',
            'stock' => 3,
            'category_id' => 3,
        ]);
        //tuner
        DB::table('products')->insert([
            'name' => 'TU-3',
            'brand' => 'Boss',
            'description' => "The world's top-selling stage tuner, the BOSS TU-2, evolves and improves with the debut of the new TU-3. Housed in a tank-tough BOSS stompbox body, the TU-3 features a smooth 21-segment LED meter with a High-Brightness mode that cuts through the harshest outdoor glare. Choose between Chromatic or Guitar/Bass tuning modes, and enjoy visual pinpoint tuning verification with the Accu-Pitch Sign function. The TU-3 incorporates a convenient Note Name Indicator that can display notes of 7-string guitars and 6-string basses, while the Flat-Tuning mode can support up to six half-steps. It's the new-standard tuner that no guitarist or bass player should be without!",
            'price' => 105,
            'thumbnail' => 'tu-3.jpg',
            'code'=> '238909',
            'stock' => 9,
            'category_id' => 4,
        ]);
        //wah-wah
        DB::table('products')->insert([
            'name' => 'Crybaby GCB95',
            'brand' => 'Dunlop',
            'description' => "You've seen it. You've heard it. But do you have one? This is the original Dunlop Cry Baby wah pedal. It's the one that's joined legions of legendary guitarists onstage since the dawn of rock... from Hendrix to Clapton and far, far beyond. Mount this one on your pedalboard and you'll never regret the decision: this is the one and only wah you need to conjure up classic tones or dive in a new direction of your own. Featuring a heavy-duty die-cast construction for years of stomping, rocking, and tear-shedding (and sometimes shredding) the Dunlop Cry Baby Standard Wah pedal is a pedalboard classic.",
            'price' => 130,
            'thumbnail' => 'crybaby.jpg',
            'code'=> '2103985',
            'stock' => 30,
            'category_id' => 5,
        ]);
        DB::table('products')->insert([
            'name' => 'SW-95 Slash Signature Wah-Wah',
            'brand' => 'Dunlop',
            'description' => "Like the man himself, the Slash Wah from Dunlop is both revolutionary and classic, right down to its hot rod metallic red finish and cutting edge circuit design. The Slash Wah deploys a searing high gain distortion coupled with the Fasel-loaded Classic circuit for instant lead tone that not only cuts through, but sings with a sweet and lush top end. Convenient LEDs indicate distortion on/off and wah on/off modes, so there's no more guessing game every time you put your foot down. And with the batteries readily accessible from the top of the rocker pedal, you don't have to fumble with a screwdriver when it's time to re-power. So get your boot on a Dunlop Slash Wah. Top hat not included.",
            'price' => 290,
            'thumbnail' => 'DunlopSW95SlashSignatureCryBabyWah.webp',
            'code'=> '192439',
            'stock' => 1,
            'category_id' => 5,
            'discount' => 23,
        ]);
        DB::table('products')->insert([
            'name' => 'V846HW Wah Wah',
            'brand' => 'Vox',
            'description' => "Hand-wired, free - wired turret board, true bypass, low noise carbon resistors, switchcraft jacks and Carling footswitch, new Vox potentiometer",
            'price' => 220,
            'thumbnail' => 'Vox-V846HW.jpg',
            'code'=> '270585',
            'stock' => 5,
            'category_id' => 5,
        ]);
        //looper
        DB::table('products')->insert([
            'name' => 'Cosmos',
            'brand' => 'SOMA',
            'description' => "Creative looper and performance effects unit for meditative soundscapes. Audio is recorded into a network of multiple delay lines, modulated by LFO",
            'price' => 765,
            'thumbnail' => 'soma-cosmos.jpg',
            'code'=> '516978',
            'stock' => 3,
            'category_id' => 6,
        ]);
        //reverb
    }




}
