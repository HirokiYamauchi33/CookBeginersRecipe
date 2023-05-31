<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelectSequence;
use App\Providers\RouteServiceProvider;

class SelectSequenceController extends Controller
{
    //

    private $SelectSequence;

    public function __construct() {
        // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->SelectSequence = new SelectSequence();
    }

    public function getSequence(){
        $sequence = $this->SelectSequence->getSequence();
    }

}
