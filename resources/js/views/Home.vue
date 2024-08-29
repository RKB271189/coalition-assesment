<template>
  <div class="container-fluid">
    <TaskComponent />
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
              <option>ABC-1</option>
              <option>ABC-2</option>
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
                <th scope="col">Date & Time</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>ABC-1</td>
                <td>Create table</td>
                <td>High</td>
                <td>29-08-2024 12:55</td>
                <td>
                  <PencilSquareIcon class="inside-icon" />
                  <TrashIcon class="ms-4 inside-icon" />
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>ABC-2</td>
                <td>Create Modal</td>
                <td>Medium</td>
                <td>29-08-2024 13:45</td>
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

export default {
  components: {
    HeaderComponent,
    TaskComponent,
    PencilSquareIcon,
    TrashIcon,
    PlusCircleIcon,
  },
};
</script>

<style scoped>
.inside-icon {
  width: 25px;
  height: 25px;
}
</style>