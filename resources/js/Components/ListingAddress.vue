<template>
  <span>
    {{ listing.city }}
    ,{{ listing.street }}
    ,{{ listing.street_nr }}
    ,for{{ listing.price }}
  </span>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>
