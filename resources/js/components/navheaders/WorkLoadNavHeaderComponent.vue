<template>
<div id="header-project-option-navigator" class="w-100">
    <div class="row justify-content-center">
        <div class="col-3 col-xs-6">
          <div class="card border-info mx-sm-1 p-3">
            <a href="/gestionar-parametros">
              <div class="card border-info shadow text-info p-3 my-card" ><span class="fas fa-tasks" aria-hidden="true"></span></div>
              <div class="text-info text-center mt-3"><h4> </h4></div>
              <div class="text-info text-center mt-2 d-none d-md-block"><h5>Catálogos</h5></div>
            </a>
          </div>
        </div>
        <div class="col-3 col-xs-6">
          <div class="card border-info mx-sm-1 p-3">
            <a href="/parametrizar-ineficiencia">
              <div class="card border-info shadow text-info p-3 my-card" ><span class="fas fa-tasks" aria-hidden="true"></span></div>
              <div class="text-info text-center mt-3"><h4> </h4></div>
              <div class="text-info text-center mt-2 d-none d-md-block"><h5>Ineficiencia</h5></div>
            </a>
          </div>
        </div>
        <div class="col-3 col-xs-6">
          <div class="card border-success mx-sm-1 p-3">
            <a href="/gestionar-plantillas-parametros">
              <div class="card border-success shadow text-success p-3 my-card"><span class="fas fa-project-diagram" aria-hidden="true"></span></div>
              <div class="text-info text-center mt-3"><h4> </h4></div>
              <div class="text-success text-center mt-2 d-none d-md-block"><h5>Plantillas</h5></div>
            </a>
          </div>
        </div>
    </div>
 </div>
</template>
<style media="screen" scoped>
#header-project-option-navigator{
  margin-bottom: 50px;
}
.my-card
{
    position:absolute;
    left:40%;
    top:-20px;
    border-radius:65%;
}
</style>
