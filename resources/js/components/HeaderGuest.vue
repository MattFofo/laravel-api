<template>
    <header>
        <div class="container">

            <nav>
                <router-link :to="{name: 'home'}" class="">Home</router-link>
                <router-link :to="{name: 'index'}" class="">Blog</router-link>
                <router-link :to="{name: 'about'}" class="">About</router-link>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: 'HeaderGuest'
}
</script>

<style>

</style>
