<header>
    <nav class="nav-list">
        <a class="<?php if ($currentPage == "main"){ echo "nav-item-current";} else { echo "nav-item"; }?>" href="/">
            <p>Staromor</p>
        </a>
        <a class="<?php if ($currentPage == "store"){ echo "nav-item-current";} else { echo "nav-item"; }?>" href="/store">
            <p>Obchod</p>
        </a>
        <a class="<?php if ($currentPage == "account"){ echo "nav-item-current";} else { echo "nav-item"; }?>" href="/account">
            <p>Uživatelský účet</p>
        </a>
        <a class="<?php if ($currentPage == "cart"){ echo "nav-item-current";} else { echo "nav-item"; }?>" href="/cart">
            <p>Nákupní košík</p>
        </a>
    </nav>
</header>