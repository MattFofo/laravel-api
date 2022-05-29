<template>
    <div class="container">
        <div class="row">
            <div class="col">
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
    created() {
        Axios.get(this.baseURL + '/' + this.slug)
            .then(res => {
                if (res.data.success) {
                    this.post = res.data.response.data;
                } else {
                    this.$router.push({name: 'page404'});
                }
            });
    }
}
</script>

<style>

</style>
