<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
        
        <link href="<?php echo Yii::app()->params['baseUrl']; ?>css/mail.css" rel="stylesheet" media="screen"  />
</head>
<table cellspacing="0" cellpadding="10" class="main-table">
    <tbody>
        <tr class="logo-row">
            <td>
                <a href="<?php echo Yii::app()->params['baseUrl']; ?>"><img src="<?php echo Yii::app()->params['baseUrl']; ?>images/site/logo.png" alt="WonLot"></a>
            </td>
        </tr>
        <tr class="body-row">
            <td>
                <div class="mail-body">
                    <?php echo $content ?>
                </div>
            </td>
        </tr>
        <tr class="footer-row">
            <td>
                FOOTER
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>