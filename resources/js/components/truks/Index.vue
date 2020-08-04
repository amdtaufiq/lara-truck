<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <router-link :to="{ name: 'main' }" class="btn btn-md btn-secondary mr-3">Back</router-link>
                        LIST TRUK
                    </div>

                    <div class="card-body">
                        <router-link :to="{ name: 'create-truk' }" class="btn btn-md btn-success">TAMBAH TRUK</router-link>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>MODEL TRUK</th>
                                    <th>PLAT NOMOR</th>
                                    <th>AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(truk, index) in truks" :key="truk.id">
                                    <td>{{ truk.model_truk }}</td>
                                    <td>{{ truk.plat_nomor }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'edit-truk', params: { id: truk.id }}" class="btn btn-sm btn-primary">EDIT</router-link>
                                        <button @click.prevent="trukDelete(truk.id, index)" class="btn btn-sm btn-danger">HAPUS</button>
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
                truks: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/truks`;
            this.axios.get(uri).then(response => {
                this.truks = response.data.data;
            });
        },
        methods: {
            trukDelete(id, index)
            {
                this.axios.delete(`http://localhost:8000/api/truks/${id}`)
                    .then(response => {
                        this.truks.splice(index, 1);
                    }).catch(error => {
                    alert('system error!');
                });
            }
        }
    }
</script>