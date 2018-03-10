<?php
require_once('config.php');
require_once('actions.php');

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

try {
	$pdo = new PDO(DSN, DB_USER, DB_PASS);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql_result = $pdo->query("select * from users order by id desc limit 5");
	$post = $pdo->query("select * from users");
	$posts = $post->fetchAll();
	$post_num = count($posts);
	$i = -1;
} catch (Exception $e) {
	echo $e->getMessage() . PHP_EOL;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$message = $_POST;
	$ptm = new PostTheMessage();
	$ptm->post($message);
}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>掲示板</title>
		<link rel="stylesheet" href="/css/sanitize.css">
		<link rel="stylesheet" href="/css/styles.css">
	</head>
	<body>
		<div id="header">
			<h1>掲示板</h1>
			<p>現在の投稿<span>0</span>件</p>
		</div><!-- header -->
		<div id="main">
			<div id ="modal" class ="hidden">
				<form action="" method="post">
					<label for="name">名前</label>
					<input type="text" name="name" value="" id="name"><br>
					<label for="password">削除用パスワード</label>
					<input type="password" name="password" value=""><br>
					<textarea name="body" rows="8" cols="40" placeholder="ここにコメントを記入してください。"></textarea><br>
					<button type="submit" name="submit" id="submit">書き込む</button>
				</form>
				<p id ="close_modal">Close</p>
			</div><!-- modal -->
			<div id="mask" class="hidden"></div>
			<div id ="open_modal">
				<h2>投稿する</h2>
			</div>
			<div id="posts">
				<?php if ($post_num == 0): ?>
				<p>まだ投稿はありません。</p>
				<?php endif; ?>
				<dl>
					<?php foreach ($sql_result as $row) : ?>
					<?php $i++ ?>
					<dt>
						<span style="color: #e67e22; margin-right:10px;"><?= $post_num - $i; ?></span><span style="color: #e67e22;">名前：<?= h($row["name"]) ?></span>
						<span style ="font-size: 15px; color: #a0a0a0;"><?= h($row["created"])?> ID:qwertyuio</span><br>
					</dt>
					<dd>
						<?=  nl2br(h($row["body"])) ?>
						<a href="">削除</a>
					</dd>
					<?php endforeach; ?>
				</dl>
				<div id="load_result"></div>
				<button id="load_more">全件表示</button>
			</div><!-- posts -->
		</div><!-- main -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="actions.js"></script>
	</body>
</html>
