<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EldeltecController extends Controller
{
    public function index()
    {
        return view('pages.admin.integracoes.eldeltec.index');
    }
}
