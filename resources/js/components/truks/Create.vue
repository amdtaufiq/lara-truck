<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">TAMBAH TRUK</div>

                    <div class="card-body">

                        <form @submit.prevent="trukStore">

                            <div class="form-group">
                                <label>MODEL TRUK</label>
                                <input type="text" class="form-control" v-model="truk.model_truk"
                                       placeholder="Masukkan Model Truk">
                                <div v-if="validation.model_truk">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.model_truk[0] }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>PLAT NOMOR</label>
                                <input type="text" class="form-control" v-model="truk.plat_nomor" rows="5"
                                          placeholder="Masukkan Plat Nomor">
                                <div v-if="validation.plat_nomor">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.plat_nomor[0] }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-danger">RESET</button>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                truk: {},
                validation: []
            }
        },
        methods: {
            trukStore() {
                let uri = 'http://localhost:8000/api/truks/store';
                this.axios.post(uri, this.truk)
                    .then((response) => {
                        this.$router.push({
                            name: 'list-truk'
                        });
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        }
    }
</script>