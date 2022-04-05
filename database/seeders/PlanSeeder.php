<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Lecture;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    private $groups;
    private $lectures;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->groups = Group::get('id')->all();
        $this->lectures= Lecture::get('id')->all();

        foreach ($this->groups as $group){
            if (rand(0,4)>0){
                foreach ($this->lectures as $lecture){
                    if(rand(0,4)>1){
                        Plan::updateOrCreate(
                            [
                                'group_id' => $group['id'],
                                'lecture_id' => $lecture['id'],

                            ]);

                    }
                }
            }
        }
    }
}
