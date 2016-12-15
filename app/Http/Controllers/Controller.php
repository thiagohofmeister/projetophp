<?php

namespace forum\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Método Genérico para Upload de arquivos
     *
     * @param File $file
     * @param string $path
     * @param string $name
     */
    public function upload($file, $path, $name)
    {
        $file->move($path, $name);
    }

    /**
     * Cria um slug através de um texto
     *
     * @param string $text
     * @return string
     */
    public function makeSlug($text)
    {
        return $this->removeSpecialCharacters($text, true);
    }

    /**
     * Remove os caractéres especiais e cria slug
     * 
     * @param string $string
     * @param boolean $slug
     * @return string
     */
    public function removeSpecialCharacters($string, $slug = false) {
        $string = strtolower($string);

        // Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);

        foreach ($ascii as $key=>$item) {
            $acentos = '';
            foreach ($item AS $codigo) $acentos .= chr($codigo);
            $troca[$key] = '/['.$acentos.']/i';
        }

        $string = preg_replace(array_values($troca), array_keys($troca), $string);

        // Slug?
        if ($slug) {
            $charNew = '-';
            // Troca tudo que não for letra ou número por um caractere (-)
            $string = preg_replace('/[^a-z0-9]/i', $charNew, $string);
            // Tira os caracteres (-) repetidos
            $string = preg_replace('/' . $charNew . '{2,}/i', $charNew, $string);
            $string = trim($string, $charNew);
        }

        return $string;
    }

    public function makeFileName($file, $name = null)
    {       
        if ($name != null) {
            $file_name = $this->makeSlug($name);
            $file_name .= '.' . $file->getClientOriginalExtension();

            return $file_name;
        }
        
        $file_name = $file->getClientOriginalName();        
        
        return $file_name;
    }


    public function setDatas(&$req, $datas = [], $sem_hora = false)
    {
        foreach ($datas as $key => $date) {

            if (is_array($req)) {
                if (!empty($req[$date])) {
                    $req[$date] = $this->arrumarDatas($req[$date], $sem_hora);
                } else {
                    $req[$key][$date] = $this->arrumarDatas($req[$key][$date], $sem_hora);
                }
            } else {
                if (!empty($req->$date)) {
                    $req->$date = $this->arrumarDatas($req->$date, $sem_hora);
                } else {
                    $req[$key]->$date = $this->arrumarDatas($req[$key]->$date, $sem_hora);
                }
            }
            
        }
    }

    public function arrumarDatas($data, $sem_hora = false) {
        if ($sem_hora) {
            if (count(explode("/",$data)) > 1) {
                return date('Y-m-d', strtotime(str_replace('/', '-', $data)));
            } else {
                return date('d/m/Y', strtotime(str_replace('/', '-', $data)));
            }
        }
        if (count(explode("/",$data)) > 1) {
            return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data)));
        } else {
            return date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $data)));
        }
    }
}
