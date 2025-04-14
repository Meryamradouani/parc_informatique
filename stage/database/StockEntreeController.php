<?php

namespace App\Http\Controllers;

use App\Models\StockEntrer;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class StockEntreeController extends Controller
{
    public function index()
    {
        $stockEntrees = StockEntrer::with(['recepteur', 'emetteur', 'article'])->get();
        return view('stockentree.index', compact('stockEntrees'));
    }
}
