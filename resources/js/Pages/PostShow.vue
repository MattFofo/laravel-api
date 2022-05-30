<template>
    <div class="container">
        <Page404 v-if="is404" />
        <div class="row">
            <div class="col">
                <div class="post" v-if="post">
                    <div class="">
                        <img :src="post.image" :alt="post.title" v-if="post.image">
                        <img src="https://picsum.photos/200/300" alt="post.title" v-else>
                    </div>

                    <h1>{{ post.title }}</h1>
                    <b>By {{ post.user.name }}</b>
                    <div class="tags">
                        <span class="badge bg-primary" v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</span>
                    </div>
                    <b>{{ post.category.name }}</b>
                    <p>{{ post.content }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Page404 from "./Page404.vue";

export default {
    name: 'PostShow',
    props: ['slug'],
    components: {
        Page404
    },
    data() {
        return {
            baseURL: 'http://127.0.0.1:8000/api/v1/posts',
            post: null,
            is404: false,
        }
    },
    created() {
        Axios.get(this.baseURL + '/' + this.slug)
            .then(res => {
                if (res.data.success) {
                    this.post = res.data.response.data;
                } else {
                    //this.$router.push({name: 'page404'});
                    this.is404 = true;
                }
            });
    }
}
</script>

<style>

</style>
