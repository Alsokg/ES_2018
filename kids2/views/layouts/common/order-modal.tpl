<div class="order-modal" id="order-modal">
    <div class="modal-content">
        <div class="scrolable">
            <form id="kids-order" method="POST">
                <div class="product">
                    <div class="product-img">
                    
                    </div>
                    <div class="form-group">
                        <input type="text" name="qty" id="qty">
                    </div>                
                    <div class="price">
                        <span><?php echo $PRICE_KIDS; ?>грн</span>
                    </div>
                    <div class="price-total">
                        <span><?php echo $PRICE_KIDS; ?>грн</span>
                    </div>
                </div>
                <div class="order-detail">
                    <div class="form-group">
                        <input type="text" name="name" id="name">
                        <label for="name"></label>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email">
                        <label for="email"></label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" id="phone">
                        <label for="phone"></label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="delivery" id="delivery">
                        <label for="delivery"></label>
                    </div>
                    <div class="form-group">
                        <button type="submit">Замовити</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>