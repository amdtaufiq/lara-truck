<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">TAMBAH BARANG</div>

                    <div class="card-body">

                        <form @submit.prevent="itemUpdate">

                            <div class="form-group">
                                <label>NAMA BARANG</label>
                                <input type="text" class="form-control" v-model="item.nama_item"
                                       placeholder="Masukkan Nama Barang">
                                <div v-if="validation.nama_item">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.nama_item[0] }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>BERAT</label>
                                <input type="number" class="form-control" v-model="item.berat" rows="5"
                                          placeholder="Masukkan Berat Barang">
                                <div v-if="validation.berat">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.berat[0] }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>JUMLAH</label>
                                <input type="number" class="form-control" v-model="item.jumlah" rows="5"
                                          placeholder="Masukkan Jumlah Barang">
                                <div v-if="validation.jumlah">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.jumlah[0] }}
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
                item: {},
                validation: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/items/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.item = response.data.data;
            });
        },
        methods: {
            itemUpdate() {
                let uri = `http://localhost:8000/api/items/update/${this.$route.params.id}`;
                this.axios.post(uri, this.item)
                    .then((response) => {
                        this.$router.push({name: 'list-item'});
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        }
    }
</script>