<template>
    <div>
        <HeaderGuest />
        <ContainerPosts />
    </div>
</template>

<script>
import HeaderGuest from "../components/HeaderGuest";
import ContainerPosts from "../components/ContainerPosts";

export default {
    name: 'App',
    components: {
        HeaderGuest,
        ContainerPosts,
    }
}
</script>

<style>

</style>
