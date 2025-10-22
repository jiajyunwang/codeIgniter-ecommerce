<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="header-inner">
    <div class="items left">
        <a href="{{route('home')}}">首頁</a>
    </div>
    <div class="items right">
    <?php if ($this->session->userdata('user')): ?>
        <!-- @php
            $count = count(Helper::getAllProductFromCart());
        @endphp -->
        <a href="{{route('cart')}}">
            <i class="ti-shopping-cart-full"></i>
            <p class="text-transparent" >購物車(<span class="count">{{$count}}</span>)</p>
        </a>&emsp;
        <ul class="dropdown">    
            <li><a><?= $this->session->userdata('user') ?></a>
                <ul>
                    <li><a href="{{route('account.form')}}">我的帳戶</a></li>
                    <li><a href="{{route('user.order')}}">訂單查詢</a></li>
                    <li><a href="<?= base_url('user/logout') ?>">登出</a></li>
                </ul>
            </li>
        </ul>
    <?php else: ?>
        <a href="<?= base_url('user/login') ?>">登入</a> 
        <nobr>︱</nobr>
        <a href="<?= base_url('user/register') ?>">註冊</a>
    <?php endif; ?>
    </div>
</div>