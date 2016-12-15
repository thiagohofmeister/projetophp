<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Equipe;

class EquipeController extends Controller
{
    private $Equipe;

	public function __construct(Equipe $Equipe)
	{
		$this->Equipe = $Equipe;
	}
}
