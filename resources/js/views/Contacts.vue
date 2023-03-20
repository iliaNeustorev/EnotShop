<template>
    <div class="container content box">
        <h1 class="has-text-success">О нас</h1>
        <p>
            Наш интернет-магазин создан специально для продажи товаров для
            пушистых енотов. В нем вы найдете различный аксессуары и
            принадлежности что скрасит жизнь ваших пушистых друзей и наполнить
            ее радостью
        </p>
        <blockquote
            class="column is-half is-offset-one-quarter has-text-centered content is-medium"
            :class="$style.link"
        >
            <router-link :to="{ name: 'catalog' }">
                Перейти в каталог</router-link
            >
        </blockquote>
        <figure>
            <img :class="$style['img-radius']" src="@/assets/enot1.jpg" />
            <figcaption>Удачных покупок!!!</figcaption>
        </figure>
    </div>
</template>

<script>
export default {};
</script>

<style module>
.link {
    border-radius: 10px;
}
.img-radius {
    border-radius: 20px;
}
</style>
