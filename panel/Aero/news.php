<?
if(isset($_POST['submit'])){
    $title = clean_sql($_POST['title']);
    $type = clean_sql($_POST['type']);
    $text = clean_sql($_POST['text']);
    $user = $_SESSION['UserID'];
    mssql_query_logged("INSERT INTO IndexContent ([Type], [User], [Date], [Text], [Title])VALUES($type, '$user', GETDATE(), '$text', '$title')");
	
	

    $date = date("d-m-y - H:i:s");
    $logfile = fopen("logs/log.txt","a+");
    $logtext = "Tiempo: $date IPStaff: {$_SERVER['REMOTE_ADDR']} - UserID: $user  Text: $title $log\r\n";
    fputs($logfile, $logtext);
	fclose($logfile);
	
	
    msgbox("Su Noticia fue agregado con exito!","index.php?do=news");
}else{
?>
		<article class="module width_full">
		<form method="POST" action="index.php?do=news">
			<header><h3>Post New Article</h3></header>
				<div class="module_content">
						<fieldset>
							<label>Post Title</label>
							<input type="text" name="title" size="40" required maxlength="14" />
						</fieldset>
						<fieldset>
							<label>Content</label>
							<textarea rows="12" name="text" cols="35" required maxlength="14"></textarea>
						</fieldset>
				</div>
			<footer>
				<div class="submit_link">
					<select size="1" name="type">
						<option selected value="1">WebSites</option>
						<option value="2">Forum</option>
					</select>
					<input type="submit" value="Publish" name="submit" class="alt_btn">
					<input type="submit" value="Reset">
				</div>
			</footer>
			</form>
		</article>
<?
}
?>