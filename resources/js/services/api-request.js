import { ref } from "vue";
import { useStore } from "vuex";
const useAPIRequest = () => {
    const status = ref(null);
    const hasError = ref(false);
    const message = ref("");
    const loading = ref(false);
    const showToast = ref(false);
    const store = useStore();
    const handleAPIRequest = async (
        module,
        dispatchAction,
        params = String | {}
    ) => {
        loading.value = true;
        showToast.value = false;
        await store.dispatch(dispatchAction, params);
        loading.value = false;
        hasError.value = store.getters[`${module}/hasError`];
        message.value = store.getters[`${module}/message`];
        status.value = store.getters[`${module}/status`];
        if (message.value) {
            showToast.value = true;
        }
    };

    return {
        hasError,
        message,
        loading,
        showToast,
        status,
        handleAPIRequest,
    };
};
export default useAPIRequest;
