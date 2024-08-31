<template>
  <div class="loader-overlay">
    <div class="loader-container">
      <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
</template>
  
  <script>
export default {};
</script>
  
  <style scoped>
.loader-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #00000026;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10000;
}

.loader-container {
  text-align: center;
}
</style>