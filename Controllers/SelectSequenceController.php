<?php
require_once(ROOT_PATH .'/Models/SelectSequence.php');

class SelectSequenceController {

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
        return $sequence;
    }

}