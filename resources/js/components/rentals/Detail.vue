<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <router-link :to="{ name: 'list-rental' }" class="btn btn-md btn-secondary mr-3">Back</router-link>
                        DETAIL RENTAL
                        </div>

                    <div class="card-body">

                        <form>
                            <div class="row">

                                <div class="form-group col-6">
                                    <label>NAMA PENYEWA</label>
                                    <input type="text" class="form-control" v-model="rental.nama_penyewa" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label>NOMOR HP</label>
                                    <input type="number" class="form-control" v-model="rental.nomor" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label>MODEL TRUK</label>
                                    <input type="text" class="form-control" v-model="rental.model_truk" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label>DURASI PENYEWAAN (Hari)</label>
                                    <input type="number" class="form-control" v-model="rental.durasi" readonly>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div class="container mt-3 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        LIST BARANG
                                    </div>

                                    <div class="card-body">
                                        <router-link :to="{ name: 'create-cargo', params: { id: rental.id } }" class="btn btn-md btn-success">TAMBAH BARANG</router-link>

                                        <div class="table-responsive mt-2">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>NAMA BARANG</th>
                                                    <th>AKSI</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="cargo in cargos" :key="cargo.id">
                                                    <td>{{ cargo.nama_item }}</td>
                                                    <td class="text-center">
                                                        <button @click.prevent="itemDelete(cargo.id, index)" class="btn btn-sm btn-danger">HAPUS</button>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
                rental: {},
                cargos: {}
            }
        },
        created() {
            let uri = `http://localhost:8000/api/rentals/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.rental = response.data.data;
            });

            let uri2 = `http://localhost:8000/api/cargos/${this.$route.params.id}`;
            this.axios.get(uri2).then(response => {
                this.cargos = response.data.data;
            });
        },
        methods: {
            itemDelete(id, index)
            {
                this.axios.delete(`http://localhost:8000/api/cargos/${id}`)
                    .then(response => {
                        this.cargos.splice(index, 1);
                    }).catch(error => {
                    alert('system error!');
                });
            }
        }
    }
</script>