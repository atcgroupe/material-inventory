<template>
  <a
      :href="route"
      class="
          flex justify-between items-center flex-col sm:flex-row
          mb-3 px-5 py-3
          text-gray-500 hover:text-gray-700
          border-b border-gray-400 hover:border-cyan-400
          hover:shadow-md
          hover:-translate-y-1
          transition ease-in-out duration-200
      "
  >
    <div class="mb-3 sm:mb-0">
      <span class="mr-2 px-2 py-0.5 rounded-full bg-cyan-200">{{ reservation.jobId }}</span>
      <span class="hidden lg:inline-block">{{ reservation.jobCustomer }}</span>
    </div>

    <div>
      {{ reservation.userIdentifier }}
      <span class="mx-1 px-2 py-0.5 rounded-full bg-gray-200 sm:bg-blue-200">{{ reservation.deliveryDate }}</span>
      <span :class="statusBgColor" class="mx-1 px-2 py-0.5 rounded-full">{{ reservation.status }}</span>
    </div>
  </a>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
  reservation: Object,
})

const statusBgColor = computed(() => {
  const status = props.reservation.status;
  switch (props.reservation.status) {
    case 'VALIDÉE':
      return 'bg-green-200';
    case 'REJETÉE':
      return 'bg-red-200';
    default:
      return 'bg-gray-200';
  }
})
</script>
