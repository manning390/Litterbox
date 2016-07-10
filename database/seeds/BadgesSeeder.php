<?php

use App\Badge;
use Illuminate\Database\Seeder;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate
        DB::table('badge_user')->truncate();
        DB::table('badges')->truncate();

        $badges = [
            [
                'name' => 'accomplished_artist',
                'label' => 'Accomplished Artist',
                'path' => 'accomplished artist.png'
            ],
            [
                'name' => 'alc',
                'label' => 'Alc',
                'path' => 'alc.png'
            ],
            [
                'name' => 'amvc1_1',
                'label' => 'Amvc1-1',
                'path' => 'amvc1-1.png'
            ],
            [
                'name' => 'amvc1_2',
                'label' => 'Amvc1-2',
                'path' => 'amvc1-2.png'
            ],
            [
                'name' => 'amvc1_3',
                'label' => 'Amvc1-3',
                'path' => 'amvc1-3.png'
            ],
            [
                'name' => 'amvc1_par',
                'label' => 'Amvc1-par',
                'path' => 'amvc1-par.png'
            ],
            [
                'name' => 'amvc2_1',
                'label' => 'Amvc2-1',
                'path' => 'amvc2-1.png'
            ],
            [
                'name' => 'amvc2_2',
                'label' => 'Amvc2-2',
                'path' => 'amvc2-2.png'
            ],
            [
                'name' => 'amvc2_3',
                'label' => 'Amvc2-3',
                'path' => 'amvc2-3.png'
            ],
            [
                'name' => 'amvc2_par',
                'label' => 'Amvc2-par',
                'path' => 'amvc2-par.png'
            ],
            [
                'name' => 'aspiring_writer',
                'label' => 'Aspiring Writer',
                'path' => 'aspiring writer.png'
            ],
            [
                'name' => 'awesomenauts',
                'label' => 'Awesomenauts',
                'path' => 'awesomenauts.png'
            ],
            [
                'name' => 'bani',
                'label' => 'Bani',
                'path' => 'bani.png'
            ],
            [
                'name' => 'base',
                'label' => 'Base',
                'path' => 'base.png'
            ],
            [
                'name' => 'benefactor',
                'label' => 'Benefactor',
                'path' => 'benefactor.png'
            ],
            [
                'name' => 'brainiac',
                'label' => 'Brainiac',
                'path' => 'brainiac.png'
            ],
            [
                'name' => 'brain',
                'label' => 'Brain',
                'path' => 'brain.png'
            ],
            [
                'name' => 'cancer',
                'label' => 'Cancer',
                'path' => 'cancer.png'
            ],
            [
                'name' => 'certified_idiot',
                'label' => 'Certified Idiot',
                'path' => 'certified idiot.png'
            ],
            [
                'name' => 'chorus_enthusiast',
                'label' => 'Chorus Enthusiast',
                'path' => 'chorus enthusiast.png'
            ],
            [
                'name' => 'cl_savior',
                'label' => 'Cl Savior',
                'path' => 'cl savior.png'
            ],
            [
                'name' => 'corgi',
                'label' => 'Corgi',
                'path' => 'corgi.png'
            ],
            [
                'name' => 'duck',
                'label' => 'Duck',
                'path' => 'duck.png'
            ],
            [
                'name' => 'eternal_flame',
                'label' => 'Eternal-flame',
                'path' => 'eternal-flame.png'
            ],
            [
                'name' => 'ex_mod',
                'label' => 'Ex-mod',
                'path' => 'ex-mod.png'
            ],
            [
                'name' => 'generous',
                'label' => 'Generous',
                'path' => 'generous.png'
            ],
            [
                'name' => 'god',
                'label' => 'God',
                'path' => 'god.png'
            ],
            [
                'name' => 'grandmaster',
                'label' => 'Grandmaster',
                'path' => 'grandmaster.png'
            ],
            [
                'name' => 'guillotine',
                'label' => 'Guillotine',
                'path' => 'guillotine.png'
            ],
            [
                'name' => 'halloween',
                'label' => 'Halloween',
                'path' => 'halloween.png'
            ],
            [
                'name' => 'handcuffs',
                'label' => 'Handcuffs',
                'path' => 'handcuffs.png'
            ],
            [
                'name' => 'letter',
                'label' => 'Letter',
                'path' => 'letter.png'
            ],
            [
                'name' => 'lurk',
                'label' => 'Lurk',
                'path' => 'lurk.png'
            ],
            [
                'name' => 'mentlegen',
                'label' => 'Mentlegen',
                'path' => 'mentlegen.png'
            ],
            [
                'name' => 'mmmmmm_beeeeer',
                'label' => 'Mmmmmm, Beeeeer',
                'path' => 'mmmmmm, beeeeer.png'
            ],
            [
                'name' => 'modold',
                'label' => 'Modold',
                'path' => 'modold.png'
            ],
            [
                'name' => 'mod',
                'label' => 'Mod',
                'path' => 'mod.png'
            ],
            [
                'name' => 'mpd',
                'label' => 'Mpd',
                'path' => 'mpd.png'
            ],
            [
                'name' => 'narcissus',
                'label' => 'Narcissus',
                'path' => 'narcissus.png'
            ],
            [
                'name' => 'newfag',
                'label' => 'Newfag',
                'path' => 'newfag.png'
            ],
            [
                'name' => 'news',
                'label' => 'News',
                'path' => 'news.png'
            ],
            [
                'name' => 'old_chap',
                'label' => 'Old-chap',
                'path' => 'old-chap.png'
            ],
            [
                'name' => 'pokemon_champion_casual',
                'label' => 'Pokemon Champion Casual',
                'path' => 'pokemon champion casual.png'
            ],
            [
                'name' => 'pokemon_champion',
                'label' => 'Pokemon Champion',
                'path' => 'pokemon champion.png'
            ],
            [
                'name' => 'pokemon_master',
                'label' => 'Pokemon Master',
                'path' => 'pokemon master.png'
            ],
            [
                'name' => 'rabu',
                'label' => 'Rabu',
                'path' => 'rabu.png'
            ],
            [
                'name' => 'radio',
                'label' => 'Radio',
                'path' => 'radio.png'
            ],
            [
                'name' => 'ranger',
                'label' => 'Ranger',
                'path' => 'ranger.png'
            ],
            [
                'name' => 'reformed',
                'label' => 'Reformed',
                'path' => 'reformed.png'
            ],
            [
                'name' => 'rep1',
                'label' => 'Rep1',
                'path' => 'rep1.png'
            ],
            [
                'name' => 'rep',
                'label' => 'Rep',
                'path' => 'rep.png'
            ],
            [
                'name' => 'stalker',
                'label' => 'Stalker',
                'path' => 'stalker.png'
            ],
            [
                'name' => 'stocks',
                'label' => 'Stocks',
                'path' => 'stocks.png'
            ],
            [
                'name' => 'strategist',
                'label' => 'Strategist',
                'path' => 'strategist.png'
            ],
            [
                'name' => 'timey_wimey',
                'label' => 'Timey Wimey',
                'path' => 'timey wimey.png'
            ],
            [
                'name' => 'treasure_hunter',
                'label' => 'Treasure Hunter',
                'path' => 'treasure hunter.png'
            ],
            [
                'name' => 'what_a_nerd',
                'label' => 'What A Nerd!',
                'path' => 'what a nerd!.png'
            ],
            [
                'name' => 'writer',
                'label' => 'Writer',
                'path' => 'writer.png'
            ],
            [
                'name' => 'writers',
                'label' => 'Writers',
                'path' => 'writers.png'
            ]
        ];

        foreach($badges as $badge)
            Badge::create($badge);

    }
}
