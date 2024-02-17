<?php
header('Content-type: text/plain; charset= UTF-8');
if(!empty($_POST['answer'])){
    $answer = $_POST['answer'];
    if($answer == '小松菜奈'){
        $result = $answer."は世界一美しい";
    }else{
        $result = $answer."は世界一美しいわけではない";
    }
    echo $result;
}else{
    echo '文字を入力してください';
}
?>
