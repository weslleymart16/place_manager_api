<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlacesRequest;
use App\Models\Places;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index(Request $request)
    {
        $query = Places::query();

        if ($request->has('name')) {
            $query->where('name', 'ilike', '%' . $request->input('name') . '%');
        }

        $places = $query->get();

        return response()->json($places);
    }

    public function store(PlacesRequest $request)
    {
        $place = Places::create($request->all());

        return response()->json($place, 201);
    }

    public function show(string $id)
    {
        $place = Places::findOrFail($id);

        return response()->json($place);
    }

    public function update(PlacesRequest $request, string $id)
    {
        $place = Places::findOrFail($id);

        $place->update($request->all());

        return response()->json($place);
    }
}
