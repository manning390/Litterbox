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
                'filename' => 'accomplished artist.png'
            ],
            [
                'name' => 'alc',
                'label' => 'Alc',
                'filename' => 'alc.png'
            ],
            [
                'name' => 'amvc1_1',
                'label' => 'Amvc1-1',
                'filename' => 'amvc1-1.png'
            ],
            [
                'name' => 'amvc1_2',
                'label' => 'Amvc1-2',
                'filename' => 'amvc1-2.png'
            ],
            [
                'name' => 'amvc1_3',
                'label' => 'Amvc1-3',
                'filename' => 'amvc1-3.png'
            ],
            [
                'name' => 'amvc1_par',
                'label' => 'Amvc1-par',
                'filename' => 'amvc1-par.png'
            ],
            [
                'name' => 'amvc2_1',
                'label' => 'Amvc2-1',
                'filename' => 'amvc2-1.png'
            ],
            [
                'name' => 'amvc2_2',
                'label' => 'Amvc2-2',
                'filename' => 'amvc2-2.png'
            ],
            [
                'name' => 'amvc2_3',
                'label' => 'Amvc2-3',
                'filename' => 'amvc2-3.png'
            ],
            [
                'name' => 'amvc2_par',
                'label' => 'Amvc2-par',
                'filename' => 'amvc2-par.png'
            ],
            [
                'name' => 'aspiring_writer',
                'label' => 'Aspiring Writer',
                'filename' => 'aspiring writer.png'
            ],
            [
                'name' => 'awesomenauts',
                'label' => 'Awesomenauts',
                'filename' => 'awesomenauts.png'
            ],
            [
                'name' => 'bani',
                'label' => 'Bani',
                'filename' => 'bani.png'
            ],
            [
                'name' => 'base',
                'label' => 'Base',
                'filename' => 'base.png'
            ],
            [
                'name' => 'benefactor',
                'label' => 'Benefactor',
                'filename' => 'benefactor.png'
            ],
            [
                'name' => 'brainiac',
                'label' => 'Brainiac',
                'filename' => 'brainiac.png'
            ],
            [
                'name' => 'brain',
                'label' => 'Brain',
                'filename' => 'brain.png'
            ],
            [
                'name' => 'cancer',
                'label' => 'Cancer',
                'filename' => 'cancer.png'
            ],
            [
                'name' => 'certified_idiot',
                'label' => 'Certified Idiot',
                'filename' => 'certified idiot.png'
            ],
            [
                'name' => 'chorus_enthusiast',
                'label' => 'Chorus Enthusiast',
                'filename' => 'chorus enthusiast.png'
            ],
            [
                'name' => 'cl_savior',
                'label' => 'Cl Savior',
                'filename' => 'cl savior.png'
            ],
            [
                'name' => 'corgi',
                'label' => 'Corgi',
                'filename' => 'corgi.png'
            ],
            [
                'name' => 'duck',
                'label' => 'Duck',
                'filename' => 'duck.png'
            ],
            [
                'name' => 'eternal_flame',
                'label' => 'Eternal-flame',
                'filename' => 'eternal-flame.png'
            ],
            [
                'name' => 'ex_mod',
                'label' => 'Ex-mod',
                'filename' => 'ex-mod.png'
            ],
            [
                'name' => 'generous',
                'label' => 'Generous',
                'filename' => 'generous.png'
            ],
            [
                'name' => 'god',
                'label' => 'God',
                'filename' => 'god.png'
            ],
            [
                'name' => 'grandmaster',
                'label' => 'Grandmaster',
                'filename' => 'grandmaster.png'
            ],
            [
                'name' => 'guillotine',
                'label' => 'Guillotine',
                'filename' => 'guillotine.png'
            ],
            [
                'name' => 'halloween',
                'label' => 'Halloween',
                'filename' => 'halloween.png'
            ],
            [
                'name' => 'handcuffs',
                'label' => 'Handcuffs',
                'filename' => 'handcuffs.png'
            ],
            [
                'name' => 'letter',
                'label' => 'Letter',
                'filename' => 'letter.png'
            ],
            [
                'name' => 'lurk',
                'label' => 'Lurk',
                'filename' => 'lurk.png'
            ],
            [
                'name' => 'mentlegen',
                'label' => 'Mentlegen',
                'filename' => 'mentlegen.png'
            ],
            [
                'name' => 'mmmmmm_beeeeer',
                'label' => 'Mmmmmm, Beeeeer',
                'filename' => 'mmmmmm, beeeeer.png'
            ],
            [
                'name' => 'modold',
                'label' => 'Modold',
                'filename' => 'modold.png'
            ],
            [
                'name' => 'mod',
                'label' => 'Mod',
                'filename' => 'mod.png'
            ],
            [
                'name' => 'mpd',
                'label' => 'Mpd',
                'filename' => 'mpd.png'
            ],
            [
                'name' => 'narcissus',
                'label' => 'Narcissus',
                'filename' => 'narcissus.png'
            ],
            [
                'name' => 'newfag',
                'label' => 'Newfag',
                'filename' => 'newfag.png'
            ],
            [
                'name' => 'news',
                'label' => 'News',
                'filename' => 'news.png'
            ],
            [
                'name' => 'old_chap',
                'label' => 'Old-chap',
                'filename' => 'old-chap.png'
            ],
            [
                'name' => 'pokemon_champion_casual',
                'label' => 'Pokemon Champion Casual',
                'filename' => 'pokemon champion casual.png'
            ],
            [
                'name' => 'pokemon_champion',
                'label' => 'Pokemon Champion',
                'filename' => 'pokemon champion.png'
            ],
            [
                'name' => 'pokemon_master',
                'label' => 'Pokemon Master',
                'filename' => 'pokemon master.png'
            ],
            [
                'name' => 'rabu',
                'label' => 'Rabu',
                'filename' => 'rabu.png'
            ],
            [
                'name' => 'radio',
                'label' => 'Radio',
                'filename' => 'radio.png'
            ],
            [
                'name' => 'ranger',
                'label' => 'Ranger',
                'filename' => 'ranger.png'
            ],
            [
                'name' => 'reformed',
                'label' => 'Reformed',
                'filename' => 'reformed.png'
            ],
            [
                'name' => 'rep1',
                'label' => 'Rep1',
                'filename' => 'rep1.png'
            ],
            [
                'name' => 'rep',
                'label' => 'Rep',
                'filename' => 'rep.png'
            ],
            [
                'name' => 'stalker',
                'label' => 'Stalker',
                'filename' => 'stalker.png'
            ],
            [
                'name' => 'stocks',
                'label' => 'Stocks',
                'filename' => 'stocks.png'
            ],
            [
                'name' => 'strategist',
                'label' => 'Strategist',
                'filename' => 'strategist.png'
            ],
            [
                'name' => 'timey_wimey',
                'label' => 'Timey Wimey',
                'filename' => 'timey wimey.png'
            ],
            [
                'name' => 'treasure_hunter',
                'label' => 'Treasure Hunter',
                'filename' => 'treasure hunter.png'
            ],
            [
                'name' => 'what_a_nerd',
                'label' => 'What A Nerd!',
                'filename' => 'what a nerd!.png'
            ],
            [
                'name' => 'writer',
                'label' => 'Writer',
                'filename' => 'writer.png'
            ],
            [
                'name' => 'writers',
                'label' => 'Writers',
                'filename' => 'writers.png'
            ]
        ];

        foreach($badges as $badge)
            Badge::create($badge);

    }
}
