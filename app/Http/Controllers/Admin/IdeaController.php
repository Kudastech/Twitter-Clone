<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        $ideas = Idea::latest()->paginate(5);

        return view('admin.ideas.index', compact('ideas'));
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $data = Idea::select("content as value", "id")
                    ->where('content', 'LIKE', '%'. $request->get('search'). '%')
                    ->take(10)
                    ->get();

        return response()->json($data);
    }
}
