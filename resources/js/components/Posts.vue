<template>
    <div>
        <h4 class="text-center mb-0">All posts</h4>
        <br />
        <table class="table table-bordered text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(post, index) in posts" :key="post.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.content }}</td>
                    <td>{{ post.created_at }}</td>
                    <td>{{ post.updated_at }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link
                                :to="{
                                    name: 'editpost',
                                    params: { id: post.id },
                                }"
                                class="btn-action bg-dark"
                            >
                                <svg
                                    viewBox="0 0 477.873 477.873"
                                    width="18px"
                                    fill="currentColor"
                                >
                                    <g>
                                        <g>
                                            <path
                                                d="M392.533,238.937c-9.426,0-17.067,7.641-17.067,17.067V426.67c0,9.426-7.641,17.067-17.067,17.067H51.2
			c-9.426,0-17.067-7.641-17.067-17.067V85.337c0-9.426,7.641-17.067,17.067-17.067H256c9.426,0,17.067-7.641,17.067-17.067
			S265.426,34.137,256,34.137H51.2C22.923,34.137,0,57.06,0,85.337V426.67c0,28.277,22.923,51.2,51.2,51.2h307.2
			c28.277,0,51.2-22.923,51.2-51.2V256.003C409.6,246.578,401.959,238.937,392.533,238.937z"
                                            />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M458.742,19.142c-12.254-12.256-28.875-19.14-46.206-19.138c-17.341-0.05-33.979,6.846-46.199,19.149L141.534,243.937
			c-1.865,1.879-3.272,4.163-4.113,6.673l-34.133,102.4c-2.979,8.943,1.856,18.607,10.799,21.585
			c1.735,0.578,3.552,0.873,5.38,0.875c1.832-0.003,3.653-0.297,5.393-0.87l102.4-34.133c2.515-0.84,4.8-2.254,6.673-4.13
			l224.802-224.802C484.25,86.023,484.253,44.657,458.742,19.142z"
                                            />
                                        </g>
                                    </g>
                                </svg>
                            </router-link>
                            <button
                                class="btn-action bg-dark"
                                @click="deletepost(post.id)"
                            >
                                <svg
                                    viewBox="0 0 512 512"
                                    width="18px"
                                    fill="currentColor"
                                >
                                    <g>
                                        <path
                                            d="m424 64h-88v-16c0-26.51-21.49-48-48-48h-64c-26.51 0-48 21.49-48 48v16h-88c-22.091 0-40 17.909-40 40v32c0 8.837 7.163 16 16 16h384c8.837 0 16-7.163 16-16v-32c0-22.091-17.909-40-40-40zm-216-16c0-8.82 7.18-16 16-16h64c8.82 0 16 7.18 16 16v16h-96z"
                                        />
                                        <path
                                            d="m78.364 184c-2.855 0-5.13 2.386-4.994 5.238l13.2 277.042c1.22 25.64 22.28 45.72 47.94 45.72h242.98c25.66 0 46.72-20.08 47.94-45.72l13.2-277.042c.136-2.852-2.139-5.238-4.994-5.238zm241.636 40c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16zm-80 0c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16zm-80 0c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16z"
                                        />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <button
            type="button"
            class="btn btn-dark text-uppercase font-weight-bold"
            @click="this.$router.push('/posts/add')"
        >
            Add new post
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
        };
    },
    created() {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            this.$axios
                .get("/api/posts")
                .then((response) => {
                    this.posts = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    },
    methods: {
        deletepost(id) {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .delete(`/api/posts/delete/${id}`)
                    .then((response) => {
                        let i = this.posts.map((item) => item.id).indexOf(id); // find index of your object
                        this.posts.splice(i, 1);
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
};
</script>
