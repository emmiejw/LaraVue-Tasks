<template >
  <div class="app-component " >
      <div>
        <loading :active.sync="isLoading"></loading>
            <table class="table">
            <thead>
                <tr>
                <th>Task</th>
                <th>Priority</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <task-component v-for="task in tasks" :key="task.id" :task="task" @delete="remove"></task-component>
                <tr>
                <td class>
                    <input v-model="task.title" type="text" id="task" class="shadow appearance-none border rounded w-full py-2 px-3 m-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </td>
                <td>
                    
                    <select v-model="task.priority" id="select" class="block w-full bg-white border border-gray-400 hover:border-gray-500  m-3 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" style="margin-left: 20px;">
                        <option>Low</option>
                        <option>High</option>
                    </select>
                       
                </td>
                </tr>
                <tr>
                    <td>
                    <button @click="store" class="btn btn-purple" style="margin-left: 7rem;">Add</button>
                    </td>
                </tr>
            </tbody>
            </table>
      </div>
  </div>
</template>

<script>
import TaskComponent from "./Task.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  data() {
    return {
      isLoading: false,
      tasks: [],
      task: { title: "", priority: "" }
    };
  },

  methods: {
    getTasks() {
      window.axios.get("/api/tasks").then(({ data }) => {
        data.forEach(task => {
          this.tasks.push(task);
        });
      });
    },
    store() {
      if (this.checkInputs()) {
        this.isLoading = true;
        window.axios.post("/api/tasks", this.task).then(savedTask => {
          this.tasks.push(savedTask.data);
          this.task.title = "";
          this.task.priority = "";
          this.isLoading = false;
        });
      }
    },
    checkInputs() {
      if (this.task.title && this.task.priority) return true;
    },
    remove(id) {
      this.isLoading = true;
      window.axios.delete(`/api/tasks/${id}`).then(() => {
        let index = this.tasks.findIndex(task => task.id === id);
        this.tasks.splice(index, 1);
        this.isLoading = false;
      });
      console.log(`Deleted ${id}`);
    }
  },
  created() {
    this.getTasks();
  },

  components: {
    TaskComponent,
    Loading
  }
};
</script>
<style>
.app-component{
    background-color: aliceblue;
    padding: 0.5em;
    border: 1px solid aquamarine;
}
</style>
