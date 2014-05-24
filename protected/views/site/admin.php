<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>Pagina di ADMIN</div>
<div>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('users/admin'); ?>">Utenti</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('userWithdraw/admin'); ?>">Richieste prelievo</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('lotteryPaymentRequest/admin'); ?>">Pagamenti lotterie</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('userSpecialOffers/admin'); ?>">Promozioni</a>
</div>