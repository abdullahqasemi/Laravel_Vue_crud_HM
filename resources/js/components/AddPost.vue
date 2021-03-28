<template>
    <div>
        <h4 class="text-center">Add Post</h4>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="addPost">
                    <div class="form-group">
                        <label>Title</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="post.title"
                        />
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <!-- <input
                            type="textarea"
                            class="form-control"
                            v-model="post.content"
                        /> -->
                        <textarea
                            class="form-control"
                            v-model="post.content"
                            cols="30"
                            rows="10"
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-dark btn-block text-uppercase font-weight-bold"
                    >
                        Add Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {},
        };
    },
    methods: {
        addPost() {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post("/api/posts/add", this.post)
                    .then((response) => {
                        this.$router.push({ name: "posts" });
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
