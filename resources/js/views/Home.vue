<template>
  <div class="container-fluid">
    <div class="row">
      <HeaderComponent />
    </div>
    <div class="row">
      <div class="container">
        <div class="col-md-12" style="padding: 45px">
          <table id="task_table" class="table table-bordered">
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
                  <PencilSquareIcon class="table-icon" />
                  <TrashIcon class="ms-4 table-icon" />
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>ABC-2</td>
                <td>Create Modal</td>
                <td>Medium</td>
                <td>29-08-2024 13:45</td>
                <td>
                  <PencilSquareIcon class="table-icon" />
                  <TrashIcon class="ms-4 table-icon" />
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
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
export default {
  components: {
    HeaderComponent,
    PencilSquareIcon,
    TrashIcon,
  },
};
</script>

<style scoped>
.table-icon {
  width: 25px;
  height: 25px;
}
</style>