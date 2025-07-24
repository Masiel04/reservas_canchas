<?php

namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        return view('inicio');  // Aquí carga la vista plantilla.php
    }
}
