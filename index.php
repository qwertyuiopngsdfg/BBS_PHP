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
				<form action="actions.php" method="post">
					<label for="name">名前</label>
					<input type="text" name="name" value="" id="name"><br>
					<label for="password">削除用パスワード</label>
					<input type="password" name="password" value=""><br>
					<textarea name="text" rows="8" cols="40" placeholder="ここにコメントを記入してください。"></textarea><br>
					<button type="submit" name="submit" id="submit">書き込む</button>
				</form>
				<p id ="close_modal">Close</p>
			</div><!-- modal -->
			<div id="mask" class="hidden"></div>
			<div id ="open_modal">
				<h2>投稿する</h2>
			</div>
			<div id="posts">
				<p>まだ投稿はありません..(p_q)</p>
				<dl>
					<dt>
						<span style="color: #e67e22; margin-right:10px;">1</span><span style="color: #e67e22;">名前：名無し</span> <span style ="font-size: 15px; color: #a0a0a0;">2017/03/09 ID:qwertyuio</span><br>
					</dt>
					<dd>
						こんにちわ
						<a href="">削除</a>
					</dd>
				</dl>
				<div id="load_result"></div>
				<button id="load_more">全件表示</button>
			</div><!-- posts -->
		</div><!-- main -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="actions.js"></script>
	</body>
</html>
