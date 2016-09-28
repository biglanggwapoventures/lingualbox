<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ReadingStoryboard AS Story;
use App\ReadingQuestion AS Question;

use Validator;

class ReadingExamController extends Controller
{
    function editStoryboard(Request $request)
    {
        $story = Story::orderBy('created_at', 'DESC')->first() ?: new Story;
        return view('exams.storyboard', compact('story'));
    }

    function saveStoryboard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'limit' => 'required|numeric|min:1',
            'passing_score' => 'required|numeric'
        ]);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        Story::create($request->only(['title', 'body', 'limit', 'passing_score']));

        return response()->json([
            'result' => TRUE,
        ]);
    }

    function editQuestions()
    {

        return view('exams.questions');
    }

    function addQuestion()
    {
        $title = 'Create new question';
        $question = new Question;
        $question->fill([
            'body' => '',
            'wrong_answers' => [''],
            'correct_answers' => [''],
        ]);
        $action = route('reading.questions.store');
        return view('exams.questions', compact(['action', 'question', 'title']));
    }

    function storeQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'correct_answers' => 'array',
            'correct_answers.*' => 'required',
            'wrong_answers' => 'array',
            'wrong_answers.*' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        $question = Question::create($request->only(['body', 'correct_answers', 'wrong_answers']));

        return response()->json([
            'result' => TRUE,
             'next_url' => route('reading.questions.update', ['id' => $question->id]),
        ]);
    }


    function editQuestion($id)
    {
        $title = 'Update question';
        $question = Question::find($id);
        $action = route('reading.questions.update', ['id' => $id]);
        return view('exams.questions', compact(['action', 'question', 'title']));
    }

    function updateQuestion($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'correct_answers' => 'array',
            'correct_answers.*' => 'required',
            'wrong_answers' => 'array',
            'wrong_answers.*' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        $question = Question::find($id);
        $question->fill($request->only(['body', 'correct_answers', 'wrong_answers']));
        $question->save();

        return response()->json([
            'result' => TRUE
        ]);
    }

    function deleteQuestion(Request $request)
    {
        Question::destroy($request->input('id'));
        return response()->json([
            'result' => true,
            'next_url' => route('reading.questions.create')
        ]);
    }
}
