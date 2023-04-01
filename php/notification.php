
<style type="text/css">
	.notification{
		position: absolute;
		left:10px;
		bottom: 30px;
		background-color: #202020;
		color: white;
		max-width:400px;
		height: auto;
		border-radius: 10px;
		padding: 0px 30px;
		z-index: 1000;
	}
	#p{
		margin-top: 15px;
	}
</style>
<script type="text/javascript">
	function hidenotification(){
		var x = document.getElementsByClassName("notification");
		x[0].style.display="none";
	}
	setTimeout("hidenotification()",3500);
</script>

<div class="notification" id="notification" onclick="hidenotification()">
<p id="p"><?php echo $_SESSION['notification']; ?><p>
</div>
