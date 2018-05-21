<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel', 'slug' => str_slug('Laravel')];
        $channel2 = ['title' => 'Sport', 'slug' => str_slug('Sport')];
        $channel3 = ['title' => 'FortniteBR', 'slug' => str_slug('FortniteBR')];
        $channel4 = ['title' => 'Subreddit', 'slug' => str_slug('Subreddit')];
        $channel5 = ['title' => 'Osijek i Okolica', 'slug' => str_slug('Osijek i Okolica')];

        App\Channel::create($channel1);
        App\Channel::create($channel2);
        App\Channel::create($channel3);
        App\Channel::create($channel4);
        App\Channel::create($channel5);
    }
}
