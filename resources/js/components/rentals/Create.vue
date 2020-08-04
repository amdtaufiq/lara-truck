<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">TAMBAH RENTAL</div>

                    <div class="card-body">

                        <form @submit.prevent="rentalStore">

                            <div class="form-group">
                                <label>NAMA PENYEWA</label>
                                <input type="text" class="form-control" v-model="rental.nama_penyewa"
                                       placeholder="Masukkan Nama Penyewa">
                                <div v-if="validation.nama_penyewa">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.nama_penyewa[0] }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>NOMOR HP</label>
                                <input type="number" class="form-control" v-model="rental.nomor" rows="5"
                                          placeholder="Masukkan Nomor HP">
                                <div v-if="validation.nomor">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.nomor[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>MODEL TRUK</label>
                                <select class="form-control" v-model="rental.truk_id">
                                    <option v-for="truk in truks" :value="truk.id" :key="truk.id"> {{ truk.model_truk }}</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>DURASI PENYEWAAN (Hari)</label>
                                <input type="number" class="form-control" v-model="rental.durasi" rows="5"
                                          placeholder="Masukkan Durasi Penyewaan">
                                <div v-if="validation.durasi">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.durasi[0] }}
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
                truks: {},
                rental: {},
                validation: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/truks`;
            this.axios.get(uri).then(response => {
                this.truks = response.data.data;
            });
        },
        methods: {
            rentalStore() {
                let uri = 'http://localhost:8000/api/rentals/store';
                this.axios.post(uri, this.rental)
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