<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span style="margin-right: 1em;">
                            Пересчитать рейтинг
                        </span>
                    </div>

                    <div class="card-body">
                        <button :disabled="loading" @click="recalculate();" style="font-size: 2em;" class="button is-primary">Пересчитать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RecalculateRating",
        props: [

        ],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                loading: false,
            }
        },
        methods: {
            recalculate() {
                axios
                    .post('/adminRecalculateRatingAction')
                    .then(response => {
                    });
            },
        },
        mounted() {
        },
        computed: {
        }
    }
</script>

<style scoped>

</style>
