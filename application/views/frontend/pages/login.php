<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="title">
    <p>登入</p>
</div>
<div class="form">
    <?= form_open('frontend/login'); ?>
        <label>Email</label>
        <input type="text" name="email" required="required" value="<?= set_value('email'); ?>">
        <?php if (form_error('email')): ?>
            <span class="error"><?= form_error('email'); ?></span>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <label>密碼</label>
        <input type="password" name="password" required="required"><br>
        <?php if (form_error('password')): ?>
            <span class="error"><?= form_error('password'); ?></span>
        <?php endif; ?>

        <button type="submit">登入</button>
    <?= form_close(); ?>
</div>