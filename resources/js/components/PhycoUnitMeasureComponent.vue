<template>
  <div class="container-elements mp-1 mp-1">
	  <div class="card-body">

		<div class="row">
		  <div class="col-md-8 text-center">
			<button type="button" class="btn btn-outline-info btn-lg " disabled>{{category.variable}}</button>
		  </div>
		  <br>
		  <div class="col-md-4">
			<div class="form-group">
			  <label class="bmd-label-floating">Criterio</label>
			<div class="row mb-2">
	<div v-for=" criterio in category.criterio" :key="criterio.code">
              <input type="radio" v-model="measure" name="category.name" :value="category.measure"
					 @click="showSave" :checked="criterio.measure">{{criterio.name}}
  </div>
			</div>

			</div>
		  </div>
		</div>
		<br>
		<div class="row mb-2">
		  <div class="col-12 text-center">
			<button v-if="showSaveButton" @click="saveCategory(category)" class="btn btn-success"> Guardar</button>
		  </div>
		</div>
	  </div>
  </div>
</template>
<script>
 export default {
  props: ['category'],
  data(){
    return{
      form: new Form ({
        id:"",
        category_id:"",
        variable:"",
        measure:0,
        project_id:"",
        user_id:""
      }),
	  measure:0,
      showSaveButton:false,
      currentUser:"",
      currentProject:"",
	  criterios:[]
    }
  },
  methods:{
    showSave(){
      this.showSaveButton=true
    },
    saveCategory(category){
      this.showSaveButton=false
      this.updateMeasure(category)
    },
	getCurrentProject(){
      let me =this;
      axios.get('/proyecto/actual')
      .then(response => {
        me.currentProject = response.data.id
        me.getCurrentUser()
      });
    },
	 getCurrentUser(){
      let me =this;
      axios.get('/usuario')
      .then(response => {
        me.currentUser = response.data.id
		me.measure = me.category.measure
      });
    },
    updateMeasure(category){
      let me = this
	  if(me.measure != ""){
		  me.form.measure= me.measure
		  me.form.category_id= category.id
		  me.form.variable= category.variable
		  me.form.project_id= me.currentProject
		  me.form.user_id= me.currentUser
		  me.form.put('/parameters_measures/actualizar')
		  .then(function (response) {
			 toast.fire({
			  type: 'success',
			  title: 'Elementos de la tarea agregados con éxito'
			 });
		  })
	  }else{
			swal.fire(
				  'Datos incompletos',
				  'Agregue tiempo myor a 10 minutos',
				  'warning'
        )
      }
    },
  },
  created(){
    let me = this
  // me.criterios = me.category.criterio
   me.form.measure= me.category.measure
   me.getCurrentProject()
  }
}
</script>
