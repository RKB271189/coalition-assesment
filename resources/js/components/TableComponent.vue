<template>
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
          <PencilSquareIcon @click="editTask(task.id)" class="inside-icon" />
          <TrashIcon @click="deleteTask(task.id)" class="ms-4 inside-icon" />
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    tasks: {
      type: Array,
    },
  },
};
</script>

<style>
</style>