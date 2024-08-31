<template></template>

<script>
import { watch } from "vue";
import { useToast } from "vue-toastification";
export default {
  props: {
    showToast: Boolean,
    hasError: Boolean,
    message: String,
  },
  setup(props) {
    const toast = useToast();
    const configToast = {
      position: "top-right",
      timeout: 2000,
      closeOnClick: true,
      pauseOnFocusLoss: true,
      pauseOnHover: true,
      draggable: true,
      draggablePercent: 0.6,
      showCloseButtonOnHover: false,
      hideProgressBar: true,
      closeButton: "button",
      rtl: false,
    };
    watch(
      () => props.showToast,
      (shouldShowToast) => {
        if (shouldShowToast) {
          triggerToast();
        }
      }
    );
    const triggerToast = () => {
      if (props.hasError) {
        toast.error(props.message, configToast);
      } else {
        toast.success(props.message, configToast);
      }
    };
    return {
      toast,
      configToast,
      triggerToast,
    };
  },
};
</script>

<style>
</style>