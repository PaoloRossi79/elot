<!--<div><img class="socialcooking-logo" src="img/logo-sc.png"></div>-->
<!--<div><?php echo $content ?></div>-->

<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
</head>
<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">
	<tbody>
		<tr>
            <td style="color:#4D90FE;font-size:22px;border-bottom: 2px solid #4D90FE;">
				<?php echo CHtml::encode(Yii::app()->name); ?>
            </td>
		</tr>
		<tr>
            <td>
				<?php echo $content ?>
            </td>
		</tr>
		<tr>
		</tr>
	</tbody>
</table>
</body>
</html>