<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <router-link :to="{ name: 'main' }" class="btn btn-md btn-secondary mr-3">Back</router-link>
                        LIST RENTAL
                    </div>

                    <div class="card-body">
                        <router-link :to="{ name: 'create-rental' }" class="btn btn-md btn-success">TAMBAH RENTAL</router-link>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>NAMA PENYEWA</th>
                                    <th>NOMOR HP</th>
                                    <th>MODEL TRUK</th>
                                    <th>DURASI (Hari)</th>
                                    <th>TANGGAL PEMINJAMAN</th>
                                    <th>AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(rental) in rentals" :key="rental.id">
                                    <td>{{ rental.nama_penyewa }}</td>
                                    <td>{{ rental.nomor }}</td>
                                    <td>{{ rental.model_truk }}</td>
                                    <td>{{ rental.durasi }}</td>
                                    <td>{{ rental.created_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'detail-rental', params: { id: rental.id }}" class="btn btn-sm btn-primary">DETAIL</router-link>
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
</template>


<script>
    export default {
        data() {
            return {
                rentals: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/rentals`;
            this.axios.get(uri).then(response => {
                this.rentals = response.data.data;
            });
        }
    }
</script>