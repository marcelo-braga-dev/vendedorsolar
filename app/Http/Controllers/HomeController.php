<?php

namespace App\Http\Controllers;

use App\Models\UserMeta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

    public function updateTipoAcesso($id, $tipo)
    {
        (new UserMeta())->updateMeta($id, 'tipo_atual', $tipo);
        modalSucesso('Tipo de acesso alterado!');
        return redirect()->route('home');
    }
}
