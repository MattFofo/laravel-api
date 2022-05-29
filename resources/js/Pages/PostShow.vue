<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ post.title }}</h1>
                <p>{{ post.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostShow',
    props: ['slug'],
    data() {
        return {
            baseURL: 'http://127.0.0.1:8000/api/v1/posts',
            post: '',
        }
    },
    mounted() {
        Axios.get(this.baseURL + '/' + this.slug)
            .then(res => this.post = res.data.response.data);
    }
}
</script>

<style>

</style>
