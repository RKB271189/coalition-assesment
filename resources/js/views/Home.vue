<template>
  <div class="container-fluid">
    <LoaderComponent v-if="loading" />
    <ToastComponent
      :showToast="showToast"
      :message="message"
      :hasError="hasError"
    />
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
            <select class="form-control" @change="filterByProject($event)">
              <option :value="0">Select Project</option>
              <option
                v-for="project in projects"
                :key="project.id"
                :value="project.id"
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
      <!-- <div class="row">
        <div class="col-md-12">
          <TableComponent :tasks="tasks" />
        </div>
      </div> -->
      <div class="row mt-3" v-if="tasks.length === 0 && !loading">
        <div class="col-md-12">
          <div class="alert alert-warning" role="alert">No Tasks found</div>
        </div>
      </div>
      <div class="row mt-3" v-else>
        <Container
          :get-ghost-parent="getGhostParent"
          :get-child-payload="getChildPayload"
          @drop="onDrop"
          @drop-ready="onDropReady"
          @drop-not-allowed="dropNotAllowed"
        >
          <Draggable v-for="task in tasks" :key="task.id" class="row">
            <div class="draggable-item">
              <div class="alert alert-primary" role="alert">
                <button class="btn btn-success ms-2">
                  TaskID {{ task.id }}
                </button>
                <button class="btn btn-success ms-2">
                  Priority {{ task.priority }}
                </button>
                <button class="btn btn-success ms-2">
                  Project {{ task.project_name }}
                </button>
                <button class="btn btn-success ms-2">
                  Task {{ task.task_name }}
                </button>
                <button class="btn btn-success ms-2">
                  Created {{ task.created_at }}
                </button>
                <button class="btn btn-success ms-2">
                  Updated {{ task.updated_at }}
                </button>
                <button class="ms-2 btn btn-info">
                  <PencilSquareIcon
                    @click="editTask(task.id)"
                    class="inside-icon"
                  />
                  Edit
                </button>
                <button class="ms-2 btn btn-danger">
                  <TrashIcon
                    @click="deleteTask(task.id)"
                    class="ms-4 inside-icon"
                  />
                  Delete
                </button>
              </div>
            </div>
          </Draggable>
        </Container>
      </div>
    </div>
  </div>
</template>

<script>
import LoaderComponent from "../components/LoaderComponent.vue";
import ToastComponent from "../components/ToastComponent.vue";
import HeaderComponent from "../components/HeaderComponent.vue";
import TaskComponent from "../components/TaskComponent.vue";
import TableComponent from "../components/TableComponent.vue";
import {
  PencilSquareIcon,
  TrashIcon,
  PlusCircleIcon,
} from "@heroicons/vue/24/outline";
import { ref, onMounted, computed } from "vue";
import { useStore } from "vuex";
import useAPIRequest from "../services/api-request";
import { Container, Draggable } from "vue-dndrop";
import helperFunctions from "../services/helper";

export default {
  components: {
    LoaderComponent,
    ToastComponent,
    HeaderComponent,
    TaskComponent,
    TableComponent,
    PencilSquareIcon,
    TrashIcon,
    PlusCircleIcon,
    Container,
    Draggable,
  },
  setup() {
    const store = useStore();
    const { hasError, message, loading, showToast, handleAPIRequest } =
      useAPIRequest();
    const { applyDrag, generateItems } = helperFunctions();
    const projects = computed(() => store.state.Task.projects);
    const tasks = ref(computed(() => store.state.Task.tasks));
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
      if (params.id) {
        await handleAPIRequest("Task", "Task/UPDATE_TASK", params);
      } else {
        await handleAPIRequest("Task", "Task/CREATE_TASK", params);
      }
      if (!hasError.value) {
        modalTask.value.hideModal();
        getTaskDetails();
      }
    };
    const editTask = async (id) => {
      loading.value = true;
      modalTask.value.showModal(id);
      loading.value = false;
    };

    const deleteTask = async (id) => {
      await handleAPIRequest("Task", "Task/DELETE_TASK", { id: id });
      getTaskDetails();
    };

    const filterByProject = async (event) => {
      if (parseInt(event.target.value) === 0) {
        getTaskDetails();
      } else {
        await handleAPIRequest("Task", "Task/GET_TASK_DETAILS_BY_PROJECT", {
          project_id: event.target.value,
        });
      }
    };
    const onDrop = (dropResult) => {
      const reorderValue = applyDrag(tasks.value, dropResult);
      const { addedIndex, payload } = dropResult;
      const params = {
        reorderTasks: reorderValue,
        newIndex: addedIndex,
        orderTask: payload,
      };
      handleAPIRequest("Task", "Task/REORDER_TASK_PRIORITY", params);
    };
    const getGhostParent = () => {
      return document.body;
    };
    const onDropReady = (dropResult) => {};
    const dropNotAllowed = ({ payload, container }) => {};
    const getChildPayload = (index) => {
      return tasks.value[index];
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
      editTask,
      deleteTask,
      filterByProject,
      onDrop,
      getGhostParent,
      onDropReady,
      dropNotAllowed,
      getChildPayload,
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