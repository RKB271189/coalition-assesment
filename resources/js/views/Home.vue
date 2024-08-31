<template>
  <div class="container-fluid">
    <TaskComponent
      :projects="projects"
      @createUpdateTask="createUpdateTask"
      ref="modalTask"
    />
    <div class="row">
      <HeaderComponent />
    </div>
    <div class="row">
      <div class="container">
        <div class="row mt-4">
          <div class="col-md-8">
            <h4>Task List</h4>
          </div>
          <div class="col-md-2">
            <select class="form-control">
              <option>Select Project</option>
              <option
                v-for="project in projects"
                :key="project.id"
                :value="project.name"
              >
                {{ project.name }}
              </option>
            </select>
          </div>
          <div class="col-md-2">
            <button
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#modal_task"
            >
              <PlusCircleIcon class="inside-icon" /> Create New
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table id="task_table" class="table table-bordered mt-2">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Project</th>
                <th scope="col">Name</th>
                <th scope="col">Priority</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(task, index) in tasks" :key="task.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ task.project_name }}</td>
                <td>{{ task.task_name }}</td>
                <td>{{ task.priority }}</td>
                <td>{{ task.created_at }}</td>
                <td>{{ task.updated_at }}</td>
                <td>
                  <PencilSquareIcon class="inside-icon" />
                  <TrashIcon class="ms-4 inside-icon" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderComponent from "../components/HeaderComponent.vue";
import TaskComponent from "../components/TaskComponent.vue";
import {
  PencilSquareIcon,
  TrashIcon,
  PlusCircleIcon,
} from "@heroicons/vue/24/outline";
import { ref, onMounted, computed } from "vue";
import { useStore } from "vuex";
import useAPIRequest from "../services/api-request";
export default {
  components: {
    HeaderComponent,
    TaskComponent,
    PencilSquareIcon,
    TrashIcon,
    PlusCircleIcon,
  },
  setup() {
    const store = useStore();
    const { hasError, message, loading, showToast, handleAPIRequest } =
      useAPIRequest();
    const projects = computed(() => store.state.Task.projects);
    const tasks = computed(() => store.state.Task.tasks);
    const modalTask = ref(null);
    onMounted(async () => {
      await getProjectDetails();
      await getTaskDetails();
    });
    const getProjectDetails = async () => {
      await handleAPIRequest("Task", "Task/GET_PROJECT_DETAILS");
    };
    const getTaskDetails = async () => {
      await handleAPIRequest("Task", "Task/GET_TASK_DETAILS");
    };
    const createUpdateTask = async (params) => {
      await handleAPIRequest("Task", "Task/CREATE_TASK", params);
      if (!hasError.value) {
        modalTask.value.hideModal();
      }
    };
    return {
      hasError,
      message,
      loading,
      showToast,
      projects,
      tasks,
      createUpdateTask,
      modalTask,
    };
  },
};
</script>

<style scoped>
.inside-icon {
  width: 25px;
  height: 25px;
}
</style>