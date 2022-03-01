<template>
  <section class="mt-5 max-w-screen-md mx-auto">
    <div
        class="
            relative mx-auto max-w-sm mb-5
            px-3 py-2
            border border-gray-400 focus:border-cyan-500 rounded-full
            outline outline-transparent
        "
    >
      <div class="absolute pointer-events-auto">
        <svg class="absolute text-gray-400 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
      </div>

      <input type="text" placeholder="Search" class="outline-0 pl-7" v-model="search" @keyup="updateMaterialList(search)">
    </div>

    <MaterialItem
        v-for="material in materials"
        :name="material.name"
        :route="material.route"
    />
  </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import MaterialItem from "./MaterialItem";
import axios from 'axios';

const materialList = document.getElementById('material-list');
const route = materialList.dataset.route;

const materials = ref([]);
const search = ref('');
const timeout = ref(500);

const fetchMaterial = async (search) => {
  materials.value = (await axios.get(route, { params: {search: search }})).data;
};

const updateMaterialList = (search) => {
  clearTimeout(timeout.value);
  timeout.value = setTimeout(() => {
    fetchMaterial(search)
  }, 500);
}

onMounted( () => fetchMaterial());
</script>
