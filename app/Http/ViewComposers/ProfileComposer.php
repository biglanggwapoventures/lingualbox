<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\WrittenExamResult AS WrittenExam;
use App\NeededTeacher;
use DB;

class ProfileComposer
{
    public function __construct()
    {
       $this->user = Auth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if($this->user->isAdmin() || $this->user->isHR()){

            $uncheckedWrittenExams = WrittenExam::whereNull('result')->count();
            
            // $hiring = NeededTeacher::select(['morning', 'midnight', 'evening', 'afternoon'])->orderBy('id', 'DESC')->first()->toArray();
            // $isHiring = array_sum(array_values($hiring)) > 0;

            $isHiring = false;

            $view->with(compact('uncheckedWrittenExams', 'isHiring'));

        }
    }
}