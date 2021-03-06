<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        return Idea::all();
    }

    public function show($id)
    {
        $idea = Idea::findOrFail($id);
        return new JsonResponse($idea, 200);
    }
    public function store(Request $request)
    {
        $new_idea = Idea::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 0
        ]);
        return new JsonResponse($new_idea, 201);
    }
    public function update($id, Request $request)
    {
        $get_idea_to_update = Idea::find($id);
        $message = '';
        $status = 0;
        if (is_null($get_idea_to_update)) {
            $message = "L'identifiant de l idee que vous chercher n existe pas";
            $status = 404;
        } else {
            $get_idea_to_update->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => 0
            ]);
            $message = $get_idea_to_update;
            $status = 200;
        }
        return new JsonResponse($message, $status);
    }
    public function delete($id, Request $request)
    {
        $get_idea_to_delete = Idea::find($id);
        $message = '';
        $status = 0;
        if (is_null($get_idea_to_delete)) {
            $message = "Attention DreamTeam indique que cette page n existe pas";
            $status = 404;
        } else {
            $title_idea = $get_idea_to_delete->title;
            $message = "DreamTeam a bien suprimmé  $title_idea !!";
            $get_idea_to_delete->delete();
            $status = 200;
        }
        return new JsonResponse($message, $status);
    }
    public function channge_status($id)
    {
        $get_idea_to_change = Idea::find($id);
        $message = '';
        $status = 0;
        if (is_null($get_idea_to_change)) {
            $message = "Attention ce que vous voullez modifier n existe pas ";
            $status = 404;
        } else {
            if ($get_idea_to_change->status == 1) {
                $get_idea_to_change->update([
                    'status' => 0
                ]);
            } else {
                $get_idea_to_change->update([
                    'status' => 1
                ]);
            }
            $message = "Le statut de l'idée a bien changé";
            $status = 200;
        }
        return new JsonResponse($message, $status);
    }
}
