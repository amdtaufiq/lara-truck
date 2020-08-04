<template>
  <div class="container-fluid">
    <h2 class="text-center">PT. JAYA ABADI</h2>
    <div class="row">
      <router-link :to="{ name: 'list-truk' }" class="card card-widget col-6">
        <div class="card-body bg-primary text-center">
            <a class="text-white">LIST TRUK</a>
        </div>
      </router-link>
      <router-link :to="{ name: 'list-item' }" class="card card-widget col-6">
        <div class="card-body bg-primary text-center">
            <a class="text-white">LIST BARANG</a>
        </div>
      </router-link>
      <router-link :to="{ name: 'list-rental' }" class="card card-widget col-6 mt-3">
        <div class="card-body bg-primary text-center">
             <a class="text-white">RENTAL TRUK</a>
        </div>
      </router-link>
      <!-- <router-link :to="{ name: 'list-value' }" class="card card-widget col-6 mt-3">
        <div class="card-body bg-primary text-center">
             <a class="text-white">MUATAN</a>
        </div>
      </router-link> -->
    </div>
  </div>
</template>