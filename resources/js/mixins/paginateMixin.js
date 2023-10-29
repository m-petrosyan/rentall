export default {
    methods: {},
    watch: {
        $route(to, from) {
            if (to.params.page && to.params.page !== from.params.page) {
                this.paginate.page = this.$route.params?.page ?? 1
                this.loading = true
                this.getData().then(() => {
                    this.loading = false
                })
            }
        },
    }
}
