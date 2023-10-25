export default {
    watch: {
        $route(to, from) {
            if (to.name === from.name) {
                this.paginate.page = +this.$route.params.page
            }
        },
    }
}
