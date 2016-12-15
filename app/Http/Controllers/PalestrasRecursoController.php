<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;

class PalestrasRecursoController extends Controller
{
    private $PalestrasRecurso;

	public function __construct(PalestrasRecurso $PalestrasRecurso)
	{
		$this->PalestrasRecurso = $PalestrasRecurso;
	}
}
