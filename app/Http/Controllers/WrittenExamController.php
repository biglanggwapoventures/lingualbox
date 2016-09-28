<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\WrittenExam AS Question;

use Validator;

class WrittenExamController extends Controller
{
    function storeQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'limit' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        $question = Question::create($request->only(['body', 'limit']));

        return response()->json([
            'result' => TRUE,
            'next_url' => route('written.questions.update', ['id' => $question->id]),
        ]);
    }

    function createQuestion()
    {
        $placeholder =  new Question;
        $placeholder->fill(['body' => '', 'limit' => '']);

        return view('exams.written-exam-questions', [
            'questions' => Question::all(),
            'action' => route('written.questions.store'),
            'title' => 'Create new written exam question',
            'question' => $placeholder,
        ]);
    }

    function updateQuestion($id, Request $request)
    {
        $question = Question::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'limit' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
           return response()->json([
               'result' => FALSE,
               'errors' => $validator->errors()
           ]);
        }

        $question->update($request->only(['body', 'limit']));

        return response()->json([
            'result' => TRUE
        ]);
    }

    function editQuestion($id, Request $request)
    {
        $question =  Question::findOrFail($id);
        return view('exams.written-exam-questions', [
            'questions' => Question::all(),
            'action' => route('written.questions.update', ['id' => $id]),
            'title' => 'Update question',
            'question' => $question
        ]);
    }

    function deleteQuestion(Request $request)
    {
        Question::destroy($request->input('id'));
        return response()->json([
            'result' => true,
            'next_url' => route('written.questions.create')
        ]);
    }
}
