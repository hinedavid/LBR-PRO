<template>
<div>
  <loader :active="loadingPage" spinner="bar-fade-scale" size="90"/>
  <div class="container container-project">
    <div class="col-12">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label class="bmd-label-floating">Proyecto</label>
            <select @change="selectedProject" v-model="projectPickedId" class=" form-control">
              <option v-for="p in Projects.data" :value="p.id">{{ p.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4" v-if="showOptions">
          <div class="lbpradio">
            <div class="lbpradio-danger">
                <input @click="showUsers" type="radio" name="radio" id="radio1" v-model="checks[0]" value="1" />
                <label for="radio1">Usuario</label>
            </div>
          </div>
        </div>
        <div class="col-md-4" v-if="showUserType">
          <div class="row">
            <div class="col-12">
              <div class="card card-plain">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> Identificación </th>
                          <th> Nombre </th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr  v-for="user in Users.data" :key="user.id">
                            <td @click="getUserData(user)" v-text="user.identification"></td>
                            <td @click="getUserData(user)" v-text="user.name"></td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                  <pagination :data="Users" @pagination-change-page="loadUsers"></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12" v-if="showNodata">
      <h2 class="text-center">No hay datos para presentar</h2>
    </div>
    <div class="col-12" v-if="showData">
      <datatable
      	:title="tableTasksName"
        :printable="false"
      	:columns="tableTasksColumns"
      	:rows="tableTasksRows"
        :perPage="[10,15,20,25]"
        locale="es"
      />
    </div>
    <div class="col-12" v-if="showData">
      <datatable
      	:title="tableTimeName"
        :printable="false"
      	:columns="tableTimeColumns"
      	:rows="tableTimeRows"
        :perPage="[10,15,20,25]"
        locale="es"
      />
    </div>
  </div>
</div>
</template>

<script>
import DataTable from 'vue-materialize-datatable'
import VueElementLoading from 'vue-element-loading'
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'

export default {
  components: {
    'datatable': DataTable,
    'loader': VueElementLoading
  },
  data() {
    return{
      dataToShowInGraph:{},
      datos:[],
      checks:[],
      Projects:{},
      Users:{},
      tipo:"",
      projectPickedId:0,
      showOptions:false,
      showUserType:false,
      showGraphics:true,
      showUser:false,
      showData:false,
      showNodata:false,
      loadingPage:true,
      ready: false,
      tableTasksName:'',
      tableTasksColumns:[],
		  tableTasksRows:[],
      tableTimeName:'',
      tableTimeColumns:[],
		  tableTimeRows:[]
    }    
  },
  methods:{
    loadAllProjects(){
      axios.get('/todos-los-proyectos')
      .then(response => {
        this.Projects=response
        this.loadingPage = false
      });
    },
    selectedProject(){
      this.checks=[]
      this.showOptions = true
      this.showProductType=false
      this.showGraphics=false
      this.showData=false
    },
    showStrutureInformation(){
      this.loadLevelsOfStructure()
      this.showProductType=true
      this.showFrecuencyType=false
      this.showUserType=false
    },
    showUsers(){
      this.loadUsers()
      this.showUserType=true
      this.showFrecuencyType=false
      this.showProductType=false
    },
    loadUsers(page = 1) {
      let me =this
      axios.get('/usuarios-del-proyecto-con-tareas/',{
        params: {
          project_id: me.projectPickedId,
          page: page
        }
      })
      .then(response => {
        me.Users = response.data;
      });
    },
    getUserData(user){
      let me = this
      axios.get('/grafica/workFlow', {
        params: {
          user_id: user.id
        }
      })
      .then(response => {
        if(Object.keys(response.data.tasks).length > 0){
          this.showNodata=false
          this.tableTasksName = "Tiempo registrado de tareas"
          this.tableTasksColumns = response.data.titleTasks
          this.tableTasksRows =response.data.tasks
          this.showData=true
        }else{
          this.showNodata=true
          this.showData=false
        }
        if(Object.keys(response.data.times).length > 0){
          this.showNodata=false
          this.tableTimeName = "Tiempo registrado de cargas de trabajo"
          this.tableTimeColumns = response.data.titleTimes
          this.tableTimeRows =response.data.times
          this.showData=true
        }else{
          this.showNodata=true
          this.showData=false
        }
      });
    },
  },
  mounted(){
    this.loadAllProjects()
  }
}
</script>

 <style scoped>
@import url(http://fonts.googleapis.com/icon?family=Material+Icons);
 .chart{
   width: 100%
 }

 .lbpradio div {
  clear: both;
  overflow: hidden;
}

.lbpradio label {
  width: 100%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

.lbpradio input[type="radio"]:empty,
.lbpradio input[type="checkbox"]:empty {
  display: none;
}

.lbpradio input[type="radio"]:empty ~ label,
.lbpradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 2.5em;
  text-indent: 3.25em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.lbpradio input[type="radio"]:empty ~ label:before,
.lbpradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.lbpradio input[type="radio"]:hover:not(:checked) ~ label,
.lbpradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.lbpradio input[type="radio"]:hover:not(:checked) ~ label:before,
.lbpradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.lbpradio input[type="radio"]:checked ~ label,
.lbpradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.lbpradio input[type="radio"]:checked ~ label:before,
.lbpradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.lbpradio input[type="radio"]:focus ~ label:before,
.lbpradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.lbpradio-default input[type="radio"]:checked ~ label:before,
.lbpradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.lbpradio-primary input[type="radio"]:checked ~ label:before,
.lbpradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.lbpradio-success input[type="radio"]:checked ~ label:before,
.lbpradio-success input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5cb85c;
}

.lbpradio-danger input[type="radio"]:checked ~ label:before,
.lbpradio-danger input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #d9534f;
}

.lbpradio-warning input[type="radio"]:checked ~ label:before,
.lbpradio-warning input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #f0ad4e;
}

.lbpradio-info input[type="radio"]:checked ~ label:before,
.lbpradio-info input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5bc0de;
}

 </style>
