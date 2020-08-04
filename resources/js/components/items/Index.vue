<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <router-link :to="{ name: 'main' }" class="btn btn-md btn-secondary mr-3">Back</router-link>
                        LIST BARANG
                    </div>

                    <div class="card-body">
                        <router-link :to="{ name: 'create-item' }" class="btn btn-md btn-success">TAMBAH BARANG</router-link>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered table-list">
                                <thead>
                                <tr>
                                    <th>NAMA BARANG</th>
                                    <th>BERAT</th>
                                    <th>JUMLAH</th>
                                    <th>AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in items" :key="item.id">
                                    <td>{{ item.nama_item }}</td>
                                    <td>{{ item.berat }}</td>
                                    <td>{{ item.jumlah }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'edit-item', params: { id: item.id }}" class="btn btn-sm btn-primary">EDIT</router-link>
                                        <button @click.prevent="itemDelete(item.id, index)" class="btn btn-sm btn-danger">HAPUS</button>
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
                items: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/items`;
            this.axios.get(uri).then(response => {
                this.items = response.data.data;
            });
        },
        methods: {
            itemDelete(id, index)
            {
                this.axios.delete(`http://localhost:8000/api/items/${id}`)
                    .then(response => {
                        this.items.splice(index, 1);
                    }).catch(error => {
                    alert('system error!');
                });
            }
        }
    }
</script>