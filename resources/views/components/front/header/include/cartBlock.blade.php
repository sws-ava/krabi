
<a
    href="/cart"
    class="cartBlock"
>
    <i
        style="width: 20px; height: 20px;"
        class="fa-icon fa fa-cart-plus"
        aria-hidden="true">
    </i>
    <div class="nums">
        <div><span>123</span> грн</div>
    </div>
</a>


<style>
    .cartBlock {
        background-color: #ffcb1f;
        width: 145px;
        border-radius: 5px;
        color: #000;
        padding: 10px;
        position: fixed;
        right: 20px;
        top: 102px;
        z-index: 10;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }
    .cartBlock .nums {
        margin-left: 10px;
    }
    .cartBlock .nums span {
        font-weight: 700;
    }
    @media (max-width: 700px) {
        .cartBlock {
            left: 50%;
            transform: translateX(-50%);
            bottom: 20px;
            top: auto;
        }
    }

</style>
