<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\RequestStatus;
use App\Models\RequestTypes;
use App\Models\DocumentTypes;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // DB::unprepared(file_get_contents(base_path('/database/seeders/colleges.sql')));
        // DB::unprepared(file_get_contents(base_path('/database/seeders/departments.sql')));
        // DB::unprepared(file_get_contents(base_path('/database/seeders/disciplines.sql')));

        // Role::create(['name' => 'Student']);
        // Role::create(['name' => 'Guide']);

        // $r=new RequestStatus();
        // $r->status="Not Approved";
        // $r->save();
        // $r=new RequestStatus();
        // $r->status="Approved";
        // $r->save();
        // $r=new RequestStatus();
        // $r->status="Rejected";
        // $r->save();
        
        // $r=new RequestTypes();
        // $r->type="Team Registration Request";
        // $r->save();


        $tsk=new Task();
        $tsk->name="Task 1";
        $tsk->deadline='2023-03-31';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 2";
        $tsk->desc='Problem Defination/Project title';
        $tsk->deadline='2023-03-31';
        $tsk->save();   
        $tsk=new Task();
        $tsk->name="Task 3";
        $tsk->desc='Monthly Assesment - 1';
        $tsk->deadline='2023-03-31';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 4";
        $tsk->desc='Ideation (Canvas, PAS)';
        $tsk->deadline='2023-04-10';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 5";
        $tsk->desc='Product Development Canvas (PDC) & User Feedback';
        $tsk->deadline='2023-04-10';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 6";
        $tsk->desc='Monthly Assesment - 2';
        $tsk->deadline='2023-05-10';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 7";
        $tsk->desc='Rough Prototyping & lteration';
        $tsk->deadline='2023-05-10';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 8";
        $tsk->desc='Monthly Assesment - 3 (Design Demo Day)';
        $tsk->deadline='2023-05-10';
        $tsk->save();
        $tsk=new Task();
        $tsk->name="Task 9";
        $tsk->desc='Report Submission, Generation ofthe project certificate';
        $tsk->deadline='2023-05-25';
        $tsk->save();


        // $d=new DocumentTypes();
        // $d->type="AEIOU Canvas";
        // $d->task_id=2;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Empathy Canvas";
        // $d->task_id=2;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Mind Map";
        // $d->task_id=2;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Monthly Assesment 1";
        // $d->task_id=3;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Product Developemnt Canvas";
        // $d->task_id=5;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Ideation Canvas";
        // $d->task_id=4;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="LNM Canvas";
        // $d->task_id=5;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Monthy Assesment 2";
        // $d->task_id=6;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Prototype";
        // $d->task_id=7;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Monthly Assesment 3";
        // $d->task_id=8;
        // $d->save();
        // $d=new DocumentTypes();
        // $d->type="Report";
        // $d->task_id=9;
        // $d->save();
    }
}
