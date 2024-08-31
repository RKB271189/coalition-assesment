<template>
  <div
    class="modal fade"
    id="modal_task"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="modal_task_label"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_task_label">Create/Update Task</h5>
          <button type="button" class="btn-close" @click="closeModal"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="project" class="form-label">Project</label>
              <select id="project" class="form-control" v-model="project_id">
                <option
                  v-for="project in projects"
                  :key="project.id"
                  :value="project.id"
                >
                  {{ project.name }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="task_name" class="form-label">Name</label>
              <input
                type="text"
                class="form-control"
                id="task_name"
                v-model="task_name"
                required
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeModal">
            Close
          </button>
          <button type="button" class="btn btn-danger" @click="saveTask">
            {{ task_id === null ? "Create" : "Update" }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import { ref, onMounted, computed } from "vue";
import { Modal } from "bootstrap";
import useAPIRequest from "../services/api-request";
import { useStore } from "vuex";
export default {
  props: {
    projects: {
      type: Object,
      required: true,
    },
  },
  setup(props, { emit, expose }) {
    const store = useStore();
    const task_id = ref(null);
    const project_id = ref(null);
    const task_name = ref(null);
    let taskModalInstance = null;
    const { handleAPIRequest } = useAPIRequest();
    onMounted(async () => {
      const taskModalEl = document.getElementById("modal_task");
      taskModalInstance = new Modal(taskModalEl);
    });
    const showModal = async (id) => {
      task_id.value = id;
      await handleAPIRequest("Task", "Task/GET_SINGLE_TASK", { id: id });
      const task = computed(() => store.state.Task.task);
      project_id.value = task.value.project_id;
      task_name.value = task.value.name;
      taskModalInstance.show();
    };
    const closeModal = async () => {
      project_id.value = "";
      task_name.value = "";
      taskModalInstance.hide();
    };
    const hideModal = () => {
      taskModalInstance.hide();
    };
    const saveTask = async () => {
      let params = {
        id: null,
        project_id: project_id.value,
        name: task_name.value,
      };
      if (task_id.value) {
        params.id = task_id.value;
      }
      task_id.value = null;
      emit("createUpdateTask", params);
    };
    expose({ hideModal, showModal });
    return {
      project_id,
      task_name,
      saveTask,
      closeModal,
      task_id,
    };
  },
};
</script>
  
  <style>
</style>