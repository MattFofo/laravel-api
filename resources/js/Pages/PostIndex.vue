<template>
    <div class="container">
        <div class="row g-3">
            <div class="col-4" v-for="post in posts" :key="post.id">
                <div class="card h-100">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">{{ post.title }}</h2>
                        <div>By <b>{{ post.user.name }}</b></div>
                        <div class="category">
                            <span class="badge bg-primary">{{ post.category.name }}</span>
                        </div>
                        <div class="tags">
                            <span class="badge bg-secondary" v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</span>
                        </div>
                        <p class="card-text">{{ getExcerpt(post.content) }}</p>
                        <router-link :to="{name: 'show', params: {slug: post.slug}}" class="btn btn-primary mt-auto">Read More</router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGINATION -->
        <div class="row">
            <div class="text-center">
                Page {{ nCurrentPage }} of {{ nLastPage }}
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{disabled: nCurrentPage == 1}" @click="getData(firstPageUrl)">
                        <a class="page-link">First</a>
                    </li>

                    <!-- link previous page -->
                    <li class="page-item" :class="{disabled: !prevPageUrl}" @click="getData(prevPageUrl)">
                        <a class="page-link">Previous</a>
                    </li>

                    <!-- vai direttamente alla pagina n -->
                    <li class="page-item">
                        <form @submit.prevent="getData(baseUrl + '/?page=' + nNewPage)">
                            <input type="text" name="" id="" v-model="nNewPage">
                        </form>
                    </li>

                    <!-- link next page -->
                    <li class="page-item" :class="{disabled: !nextPageUrl}" @click="getData(nextPageUrl)">
                        <a class="page-link">Next</a>
                    </li>
                    <li class="page-item" :class="{disabled: nCurrentPage == nLastPage}" @click="getData(lastPageUrl)">
                        <a class="page-link">Last</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            baseUrl: 'http://127.0.0.1:8000/api/v1/posts',
            posts: [],
            maxContent: 250,

            nNewPage: null,
            prevPageUrl: null,
            nextPageUrl: null,
            firstPageUrl: null,
            lastPageUrl: null,
            nCurrentPage: null,
            nLastPage: null,
        }
    },
    created() {
        this.getData(this.baseUrl);
    },
    methods: {
        getData(url) {
            if (url) {
                Axios.get(url)
                .then(res => {
                    this.posts =  res.data.response.data;

                    this.prevPageUrl = res.data.response.prev_page_url;
                    this.nextPageUrl = res.data.response.next_page_url;
                    this.firstPageUrl = res.data.response.first_page_url;
                    this.lastPageUrl = res.data.response.last_page_url;
                    this.nCurrentPage = res.data.response.current_page;
                    this.nLastPage = res.data.response.last_page;
                    this.nNewPage = null;
                });
            }
        },
        // getExcerpt(strContent) {
        //     if (strContent.lenght > this.maxContent) {
        //         return strContent.substring(0, this.maxContent) + ' ...'; TODO: non funziona anche se mi sembra identico al metodo sotto
        //     } else {
        //         return strContent;
        //     }
        // },
        getExcerpt(content) {
            if (content.length > this.maxContent) {
                return content.substring(0, this.maxContent) + ' . . .';
            } else {
                return content;
            }
        }
    }
}
</script>

<style>

</style>
