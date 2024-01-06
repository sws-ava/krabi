
<div class="localesHolder">
    <div >
        <nuxt-link :to="switchLocalePath('ru')">RU</nuxt-link>
        <nuxt-link :to="switchLocalePath('ua')">UA</nuxt-link>
    </div>
</div>


<style>
    .localesHolder {
        margin-top: 10px;
        text-align: revert;
        display: flex;
        justify-content: flex-end;
        gap: 6px;
    }
    .localesHolder a + a {
        margin-left: 20px;
    }
</style>
