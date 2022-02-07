<?php

require_once('../vendor/autoload.php');
class MenuSidebar
{
    public function Display($current_menu)
    {
        include('config.php');

        $menu = '<div class="menu-sidebar-wrap">
                        <a href="' . $root . '/pages/sale.php" class="menu-a-link ' . ($current_menu == "sale" ? 'active' : '') . '">
                            <i class="fas fa-cart-plus"></i>
                            <li>
                                Orders
                            </li>
                        </a>
                        <a href="' . $root . '/pages/product.php" class="menu-a-link ' . ($current_menu == "product" ? 'active' : '') . '">
<i class="fas fa-database"></i>
<li>
    Products
</li>
</a>
<a href="' . $root . '/pages/report.php" class="menu-a-link ' . ($current_menu == "report" ? 'active' : '') . '">
    <i class="fas fa-file-alt"></i>
    <li>
        Reports
    </li>
</a>
<a href="' . $root . '/pages/user.php" class="menu-a-link ' . ($current_menu == "user" ? 'active' : '') . '">
    <i class="fas fa-users"></i>
    <li>
        Users
    </li>
</a>
<a href="' . $root . '/pages/setting.php" class="menu-a-link ' . ($current_menu == "setting" ? 'active' : '') . '">
    <i class="fas fa-sliders-h"></i>
    <li>
        Setting
    </li>
</a>
</div>';
        echo $menu;
    }
}