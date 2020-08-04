<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">TAMBAH BARANG</div>

                    <div class="card-body">

                        <form @submit.prevent="cargoStore">

                            <div class="form-group">
                                <label>MODEL TRUK</label>
                                <select class="form-control" v-model="cargo.rental_id">
                                    <option 
                                    v-for="rental in rentals" 
                                    :value="rental.id" 
                                    :key="rental.id">
                                     {{ rental.model_truk }} ({{ rental.plat_nomor }})</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>NAMA BARANG</label>
                                <select class="form-control" v-model="cargo.item_id">
                                    <option v-for="item in items" :value="item.id" :key="item.id"> {{ item.nama_item }}</option>
                                </select>
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
                rentals: {},
                items: {},
                cargo: {},
                validation: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/rentals`;
            this.axios.get(uri).then(response => {
                this.rentals = response.data.data;
            });

            let uri2 = `http://localhost:8000/api/items`;
            this.axios.get(uri2).then(response => {
                this.items = response.data.data;
            });
        },
        methods: {
            cargoStore() {
                let uri = 'http://localhost:8000/api/cargos/store';
                this.axios.post(uri, this.cargo)
                    .then((response) => {
                        this.$router.push({
                            name: 'list-rental'
                        });
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        }
    }
</script>