<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\ReadingQuestion AS Question;

class ReadingQuestionsComposer
{
    public function __construct()
    {
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $questions = Question::select('id')->orderBy('id', 'ASC')->get();
        $view->with('questions', $questions);
    }
}