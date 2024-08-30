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
              <select id="project" class="form-control">
                <option v-for="project in projects" :key="project.id">
                  {{ project.name }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="role_name" class="form-label">Name</label>
              <input
                type="text"
                class="form-control"
                id="name"
                v-model="name"
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
          <button type="button" class="btn btn-danger">Create</button>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
export default {
  props: {
    projects: {
      type: Object,
      required: true,
    },
  },
};
</script>
  
  <style>
</style>