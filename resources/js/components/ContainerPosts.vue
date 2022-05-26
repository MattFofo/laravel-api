<template>
    <div class="row g-3">
        <div class="col-4" v-for="post in posts" :key="post.id">
            <div class="card h-100">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <!-- <p class="card-text">{{ post.content }}</p> -->
                    <a :href="'/posts/' + post.slug" class="btn btn-primary">Mooore</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ContainerPosts',
    data() {
        return {
            baseURL: 'http://127.0.0.1:8000/',
            posts: [],
        }
    },
    mounted() {
        Axios.get(this.baseURL + 'api/posts')
            .then(res => this.posts = res.data.response.data)
    }
}
</script>

<style>

</style>
