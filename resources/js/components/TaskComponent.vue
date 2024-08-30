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
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
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
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="button" class="btn btn-danger" @click="saveTask">
            Create
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import { ref, onMounted } from "vue";
import { Modal } from "bootstrap";
export default {
  props: {
    projects: {
      type: Object,
      required: true,
    },
  },
  setup(props, { emit, expose }) {
    const project_id = ref(null);
    const task_name = ref(null);
    let taskModalInstance = null;
    onMounted(async () => {
      const taskModalEl = document.getElementById("modal_task");
      taskModalInstance = new Modal(taskModalEl);
    });
    const saveTask = async () => {
      const params = {
        project_id: project_id.value,
        name: task_name.value,
      };
      emit("createUpdateTask", params);
    };
    const hideModal = () => {
      taskModalInstance.hide();
    };
    expose({ hideModal });
    return {
      project_id,
      task_name,
      saveTask,
      hideModal,
    };
  },
};
</script>
  
  <style>
</style>