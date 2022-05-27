<template>
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div  v-for="post in posts" :key="post.id" class="carousel-item" :class="(post == posts[0]) ? 'active' : '' ">
                <div class="">
                    <div class="card h-100 p-5">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text">{{ post.content }}</p>
                            <!-- <a :href="'/posts/' + post.slug" class="btn btn-primary mt-auto">Mooore</a> -->
                            <router-link :to="{name: 'show', params: {slug: post.slug}}" class="btn btn-primary mt-auto">Read More</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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
    created() {
        Axios.get(this.baseURL + 'api/posts?home')
            .then(res => this.posts = res.data.response.data)
    }
}
</script>

<style lang="scss" scoped>
    #carouselExampleControls {
        .carousel-control:hover  .carousel-control-next-icon, .carousel-control:hover .carousel-control-prev-icon{
            opacity: 1;
        }

        .carousel-control-next-icon {
            position: absolute;
            top: 50%;
            right: 20px;
            filter: invert(100);
            opacity: .5;
            &:hover {
                opacity: 1;
            }
        }
        .carousel-control-prev-icon {
            position: absolute;
            top: 50%;
            left: 20px;
            filter: invert(100);
            opacity: .5;
            &:hover {
                opacity: 1;
            }
        }
    }

</style>
