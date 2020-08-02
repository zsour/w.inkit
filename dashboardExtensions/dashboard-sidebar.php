<div class="side-bar">
            <div class="top-part">
                <div class="top-part-name"><?= $user->data()->username; ?></div>
                <div class="top-part-spec">Admin</div>
                <div></div>
            </div>

            <div class="menu-field" id="prod-btn">
                <div class="title">Produkter <span class="display-arrow" id="prod-btn-arrow"></span></div>
            </div>
           
            <div class="alternatives" id="prod-alt">
                    <div class="alt" onclick="Navigation.loadComponents('add-products.php');">
                        <div class="alt-text">Lägg till Produkt</div>
                    </div>
                    <div class="alt" onclick="Navigation.loadComponents('all-products.php');">
                        <div class="alt-text">Alla Produkter</div>
                    </div>
            </div>

            <div class="menu-field" id="order-btn">
                <div class="title">Ordrar <span class="display-arrow" id="order-btn-arrow"></span></div>
                <div class="alternatives"></div>
            </div>   
            
            <div class="alternatives" id="order-alt">
                    <div class="alt" onclick="Navigation.loadComponents('all-orders.php');">
                        <div class="alt-text">Alla Ordrar</div>
                    </div>
    
                    <div class="alt" onclick="Navigation.loadComponents('archived-orders.php');">
                        <div class="alt-text">Arkiverade Ordrar</div>
                    </div>
            </div>

    
            <div class="menu-field" id="user-btn">
                <div class="title">Användare <span class="display-arrow" id="user-btn-arrow"></span></div>
                <div class="alternatives"></div>
            </div>

            <div class="alternatives" id="user-alt">
                    <div class="alt" onclick="Navigation.loadComponents('all-users.php');">
                        <div class="alt-text">Alla Användare</div>
                    </div>
                    <div class="alt" onclick="Navigation.loadComponents('register-user.php');">
                        <div class="alt-text">Lägg Till Användare</div>
                    </div>
            </div>


            <div class="menu-field" id="cms-btn">
                <div class="title">CMS<span class="display-arrow" id="cms-btn-arrow"></span></div>
                <div class="alternatives"></div>
            </div>

            <div class="alternatives" id="cms-alt">
                    <div class="alt" onclick="Navigation.loadComponents('create-terms-and-conditions.php');">
                        <div class="alt-text">Terms and Conditions</div>
                    </div>
                    <div class="alt" onclick="Navigation.loadComponents('about-page-edit.php');">
                        <div class="alt-text">About</div>
                    </div>
                    <div class="alt" onclick="Navigation.loadComponents('add-company-information.php');">
                        <div class="alt-text">Company Information</div>
                    </div>
            </div>

            <div class="menu-field" onclick="document.location.href='logout.php';">
                <div class="title">Log out <span class="display-arrow"></span></div>
                <div class="alternatives"></div>
            </div>

        </div>