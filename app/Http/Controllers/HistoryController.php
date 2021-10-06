<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function ultimos_fallecidos(){
        $fallecidos = History::take(10)->orderBy('date_of_death', 'desc')->get();
        return response()->json($fallecidos, 200);
    }
}
