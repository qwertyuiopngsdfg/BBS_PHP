<?php

require_once('config.php');

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function e($word, &$previous = null) {
    return new Exception($word, 0, $previous);
}

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

class PostTheMessage {

  public function post($message){
    try {
      // error check
      $validated_message = $this->_validatePost($message);
      // save
      $this->_save($validated_message);
      // redirect
      header('Location:http://192.168.33.10:8000/');//ホームに戻る。
      exit;
    } catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
  }

  private function _validatePost($post) {
    try {
      if (mb_strlen($post["password"]) > 7 ) {
        $post["password"] = password_hash($post["password"], PASSWORD_DEFAULT);
      } else {
        $e = e('8文字以上のパスワードを設定してね。', $e);
      }
      if(mb_strlen($post["name"]) > 15){
        $e = e('名前が長すぎるよ', $e);
      }
      if (empty(trim($post["body"])) || mb_strlen($post["body"]) > 255) {
        $e = e('文章長すぎるか入力してないよ。', $e);
      }

      if ($e) {
        throw $e;
      }

      return $post;
    } catch (\Exception $e) {
      die(implode("<br />\n", $this->_exceptionToArray($e) ));
    }
  }

  private function _save($v_message) {
    try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if (empty($v_message['name'])) { //名無しの場合
        $stmt = $pdo->prepare("insert into users(body, password) values(?, ?)");
        $stmt->execute([$v_message["body"], $v_message["password"]]);
      }else{ //名前が入力されている場合
        $stmt = $pdo->prepare("insert into users(name, body, password) values(?, ?, ?)");
        $stmt->execute([$v_message["name"], $v_message["body"], $v_message["password"]]);
      }
    } catch (Exception $e) {
      echo $e->getMessage() . PHP_EOL;
      exit;
    }
  }

  private function _exceptionToArray(Exception $e) {
    do {
        $errors[] = $e->getMessage();
    } while ($e = $e->getPrevious());
    return array_reverse($errors);
  }
}
