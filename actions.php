<?php
class PostTheMessage {

  public function post($message){
    try {
      // error check
      $validated_message = $this->_validatePost($message);
      // save
      $this->_save($validated_message);
      // redirect
      header('Location:http://192.168.33.10:8000/');
      exit;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  private function _validatePost($post) {
    if (mb_strlen(trim($post["password"])) === 4) {
      $post["password"] = password_hash(trim($post["password"]), PASSWORD_DEFAULT);
      var_dump($post["password"]);
    } else {
      throw new \Exception('Error');
    }
    if(empty(trim($post["name"])) || mb_strlen($post["name"]) > 15){
      throw new \Exception('Error!');
    }
    if (empty(trim($post["body"])) || mb_strlen($post["body"]) > 255) {
    throw new \Exception('Error!');
    }
    return $post;
  }

  public function _save($v_message) {
    try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $pdo->prepare("insert into users(name, body, password) values(?, ?, ?)");
      $stmt->execute([$v_message["name"], $v_message["body"], $v_message["password"]]);
      header("Location: http://192.168.33.10:8000/");
      exit;
    } catch (Exception $e) {
      echo $e->getMessage() . PHP_EOL;
      exit;
    }
  }

}
