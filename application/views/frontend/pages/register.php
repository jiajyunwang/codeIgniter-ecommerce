<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="title">
    <p>註冊</p>
</div>
<div class="form">
    <?= form_open('frontend/register'); ?>
        <label>暱稱<span>*</span></label>
        <input type="text" name="nickname" value="<?= set_value('nickname'); ?>" required="required">
        <?php if (form_error('nickname')): ?>
            <span class="error"><?= form_error('nickname'); ?></span>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <label>Email<span>*</span></label>
        <input type="text" name="email" value="<?= set_value('email'); ?>" required="required">
        <?php if (form_error('email')): ?>
            <span class="error"><?= form_error('email'); ?></span>
        <?php endif; ?>

        <label>密碼<span>*</span></label>
        <input type="password" name="password" required="required">
        <?php if (form_error('password')): ?>
            <span class="error"><?= form_error('password'); ?></span>
        <?php endif; ?>

        <label>再次輸入密碼<span>*</span></label>
        <input type="password" name="password_confirmation" required="required">
        <?php if (form_error('password_confirmation')): ?>
            <span class="error"><?= form_error('password_confirmation'); ?></span>
        <?php endif; ?>

        <button type="submit">註冊</button>
    <?= form_close(); ?>
</div>