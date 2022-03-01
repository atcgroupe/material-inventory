<template>
  <a
      :href="route"
      class="
          flex justify-between items-center
          mb-3 px-5 py-3
          text-gray-500 hover:text-gray-700
          border-b border-gray-400 hover:border-cyan-400
          hover:shadow-md
          hover:-translate-y-1
          transition ease-in-out duration-200
      "
  >
    {{ name }}
  </a>
</template>

<script>
export default {
  props: {
    name: String,
    tags: Array,
    route: String,
  }
}
</script>
